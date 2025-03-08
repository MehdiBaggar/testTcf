<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function findRandomQuestionsByTypeAndLimit(array $typesWithLimits): array
    {
        $questions = [];
        $entityManager = $this->getEntityManager();

        foreach ($typesWithLimits as $type => $limit) {
            // 1. Fetch Question IDs for the given type
            $query = $entityManager->createQueryBuilder()
                ->select('q.id') // Select only the ID
                ->from(Question::class, 'q')
                ->where('q.type = :type')
                ->setParameter('type', $type)
                ->getQuery();

            $questionIds = array_column($query->getArrayResult(), 'id'); // Get an array of IDs

            // 2. Shuffle the Question IDs
            shuffle($questionIds);

            // 3. Limit the shuffled IDs
            $limitedQuestionIds = array_slice($questionIds, 0, $limit);

            // 4. Fetch the Question entities based on the limited and shuffled IDs
            if (!empty($limitedQuestionIds)) {
                $questionsOfType = $this->createQueryBuilder('q')
                    ->andWhere('q.id IN (:ids)')
                    ->setParameter('ids', $limitedQuestionIds)
                    ->getQuery()
                    ->getResult();

                $questions = array_merge($questions, $questionsOfType);

            }

        }

        return $questions;
    }
}