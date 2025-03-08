<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\ReponseEtudiant;
use App\Entity\Test;
use App\Repository\QuestionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TcfController extends AbstractController
{
    #[Route('/', name: 'app_tcf')]
    public function index(): Response
    {
        return $this->render('tcf/index.html.twig', [
            'controller_name' => 'TcfController',
        ]);
    }
    #[Route('/api/test/questions', name: 'app_question', methods: ['GET'])]
    public function getQuestions(ManagerRegistry $doctrine): JsonResponse
    {
        $questionRepository = $doctrine->getRepository(Question::class);

        // Define types and limits
        $typesWithLimits = [
            'Compréhension orale' => 15,
            'Maîtrise des structures de la langue' => 10,
            'Compréhension de la langue écrite' => 15
        ];

        // Fetch the randomized questions
        $questions = $questionRepository->findRandomQuestionsByTypeAndLimit($typesWithLimits);

        if (empty($questions)) {
            return new JsonResponse(["error" => "Aucune question trouvée"], 404);
        }

        // Convert the question objects into an array of data
        $questionsData = array_map(function ($question) {
            return [
                'id' => $question->getId(),
                'question' => $question->getQuestion(),
                'type' => $question->getType(),
                'difficulte' => $question->getDifficulteeeee(),
                'reponse_correcte' => $question->getReponseCorrecte(),
                'reponses' => $question->getReponses(),
                'audio' => $question->getAudio(),
                'user_reponse' => $question->getUserReponse()
            ];
        }, $questions);

        return new JsonResponse($questionsData);
    }

    #[Route('/api/test/submit', name: 'api_test_submit', methods: ['POST'])]
    public function submitTest(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $manager = $doctrine->getManager();
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser(); // Get the logged-in user
        $test = new Test();
        $test->setUser($user);
        $test->setData(new \DateTime());

        // Check if answers are provided in correct format
        if (!isset($data['answers']) || !is_array($data['answers'])) {
            return new JsonResponse(['error' => 'Invalid data format'], 400);
        }

        $reponseCorrecte = 0;
        $responsesDetails = [];

        foreach ($data['answers'] as $answer) {
            $question = $manager->getRepository(Question::class)->find($answer['questionId']);

            if (!$question) {
                continue; // Skip if the question does not exist
            }

            // Check if the user's answer is correct
            $isCorrect = $question->getReponseCorrecte() === $answer['response'];
            if ($isCorrect) {
                $reponseCorrecte++;
            }

            // Collect the response details
            $responsesDetails[] = [
                'questionId' => $answer['questionId'],
                'isCorrect' => $isCorrect,

            ];

            // Store the response in the ReponseEtudiant table
            $reponseEtudiant = new ReponseEtudiant();
            $reponseEtudiant->setTest($test);
            $reponseEtudiant->setQuestion($question);
            $reponseEtudiant->setUserAnswer($answer['response']);
            $reponseEtudiant->setIsCorrect($isCorrect); // Boolean true/false

            $manager->persist($reponseEtudiant);
        }

        // Save the test and all responses to the database
        $manager->flush();

        // Simplify the response details for the client
        $simplifiedResponsesDetails = array_map(function ($responseDetail) {
            return [
                'questionId' => $responseDetail['questionId'],
                'isCorrect' => $responseDetail['isCorrect'],

            ];
        }, $responsesDetails);

        // Calculate the score and determine the level
        $score = $reponseCorrecte * 17.5;
        $niveau = $this->determineNiveau($score);

        // Store the test details
        $test->setScoreTotal($score);
        $test->setNiveau($niveau);

        $manager->persist($test);
        $manager->flush();

        return new JsonResponse([
            'score' => $score,
            'niveau' => $niveau,
            'responsesDetails' => $simplifiedResponsesDetails
        ]);
    }
    #[Route('/addQuestion', name: 'addQuestion')]
    public function addQuestion(): Response
    {
        return $this->render('tcf/question.html.twig', [
            'controller_name' => 'TcfController',
        ]);
    }
    #[Route('/questions', name: 'add_questionApi', methods: ['POST'])]
    public function addQuestionApi(Request $request, QuestionRepository $questionRepository,ManagerRegistry $doctrine): JsonResponse
    {
        $manager = $doctrine->getManager();
        // Récupérer les données POST (y compris les fichiers)
        $data = $request->request->all();

        // Créer la question
        $question = new Question();
        $question->setQuestion($data['question']);
        $question->setType($data['type']);
        $question->setDifficulteeeee($data['difficulteeeee']);
        $question->setReponseCorrecte($data['reponseCorrecte']);
        $question->setReponses(json_decode($data['reponses'], true)); // Convertir le JSON en tableau

        // Gérer le fichier audio si le type est "Compréhension orale"
        if ($data['type'] === 'Compréhension orale' && $request->files->has('audio')) {
            /** @var UploadedFile $audioFile */
            $audioFile = $request->files->get('audio');
            $audioFileName = uniqid() . '.' . $audioFile->guessExtension();

            try {
                // Déplacer le fichier dans le répertoire public/audio
                $audioFile->move($this->getParameter('kernel.project_dir') . '/public/audio', $audioFileName);
                // Sauvegarder l'URL dans la base de données
                $question->setAudio('/audio/' . $audioFileName);
            } catch (FileException $e) {
                // Gérer l'erreur de téléchargement du fichier
                return new JsonResponse(['status' => 'error', 'message' => 'Erreur lors du téléchargement de l\'audio'], 400);
            }
        }

        // Enregistrer la question dans la base de données

        $manager->persist($question);
        $manager->flush();

        // Retourner une réponse JSON de succès
        return new JsonResponse(['status' => 'success', 'data' => $question], 201);
    }

    private function determineNiveau(int $score): string
    {


        if ($score > 0 && $score < 100) {
            return 'Aucun niveau';
        } elseif ($score >= 100 && $score < 200) {
            return 'A1';
        }
        elseif ($score >= 200 && $score < 300) {
            return 'A2';
        }
        elseif ($score >= 300 && $score < 400) {
            return 'B1';
        }
        elseif ($score >= 400 && $score < 500) {
            return 'B2';
        }
        elseif ($score >= 500 && $score < 600) {
            return 'C1';
        }
        elseif ($score >= 600 && $score < 699) {
            return 'C2';
        }
        else {
            return 'null';
        }
    }
}
