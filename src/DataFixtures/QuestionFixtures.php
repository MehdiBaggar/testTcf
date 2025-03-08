<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'une entité Test exemple pour associer avec les questions
        

        // Création des questions en français
        $questionsData =[
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "L\'équipe de football a montré une grande cohésion lors de la dernière rencontre."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'L\'équipe a bien travaillé ensemble.',
                    'reponses' => ['L\'équipe a bien travaillé ensemble.', 'L\'équipe a perdu son match.', 'L\'équipe a joué avec de nombreux remplaçants.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la forme correcte du verbe : "Il _____ à la bibliothèque tous les jours."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'A1',
                    'reponseCorrecte' => 'va',
                    'reponses' => ['va', 'allait', 'ira'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "La pluie a cessé, mais le ciel reste nuageux."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'Le temps est encore nuageux malgré l\'arrêt de la pluie.',
                    'reponses' => ['Le temps est encore nuageux malgré l\'arrêt de la pluie.', 'Il fait beau maintenant.', 'Il pleut encore.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la bonne préposition : "Je vais _____ école."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'A1',
                    'reponseCorrecte' => 'à',
                    'reponses' => ['à', 'en', 'dans'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Les étudiants ont étudié les différents types de texte : narratif, descriptif et argumentatif."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'Les étudiants ont étudié trois types de texte.',
                    'reponses' => ['Les étudiants ont étudié trois types de texte.', 'Les étudiants ont étudié uniquement le texte narratif.', 'Les étudiants ont écrit un texte argumentatif.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la forme correcte de l\'adjectif : "Ce film est _____ que l\'autre."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'meilleur',
                    'reponses' => ['meilleur', 'plus bien', 'mieux'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "La France a une riche histoire culturelle qui influence encore aujourd\'hui les arts, la mode et la cuisine."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C1',
                    'reponseCorrecte' => 'La culture française continue d\'avoir un impact sur de nombreux domaines.',
                    'reponses' => ['La culture française continue d\'avoir un impact sur de nombreux domaines.', 'La France a perdu son influence culturelle.', 'La France se concentre uniquement sur la mode.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon pronom relatif : "Voici le livre _____ je t\'ai parlé."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'dont',
                    'reponses' => ['dont', 'que', 'qui'],

                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Les réformes économiques proposées ont pour but de stimuler la croissance et de réduire le chômage."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'Les réformes visent à améliorer l\'économie et l\'emploi.',
                    'reponses' => ['Les réformes visent à améliorer l\'économie et l\'emploi.', 'Les réformes sont principalement axées sur l\'éducation.', 'Les réformes vont aggraver la situation économique.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon mode : "Il est important que vous _____ à l\'heure."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'soyez',
                    'reponses' => ['soyez', 'êtes', 'seriez'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "La croissance rapide de la population urbaine pose des défis majeurs pour les infrastructures et les services publics."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C1',
                    'reponseCorrecte' => 'L\'augmentation de la population urbaine nécessite des adaptations dans les infrastructures.',
                    'reponses' => ['L\'augmentation de la population urbaine nécessite des adaptations dans les infrastructures.', 'La population urbaine a diminué.', 'Les infrastructures sont prêtes à accueillir plus de gens.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon temps verbal : "Elle _____ (travailler) à l\'hôpital depuis 10 ans."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'travaille',
                    'reponses' => ['travaille', 'travaillait', 'a travaillé'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Le développement durable est un objectif crucial pour assurer l\'avenir de notre planète."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'Le développement durable est essentiel pour l\'avenir.',
                    'reponses' => ['Le développement durable est essentiel pour l\'avenir.', 'Le développement durable n\'est pas une priorité.', 'Le développement durable concerne uniquement l\'économie.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la bonne conjugaison : "Si j\'_____ plus de temps, je voyagerais plus."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'avais',
                    'reponses' => ['avais', 'ai', 'aura'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "L\'économie mondiale a été fortement affectée par la pandémie, mais commence lentement à se stabiliser."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'L\'économie mondiale se remet lentement des effets de la pandémie.',
                    'reponses' => ['L\'économie mondiale se remet lentement des effets de la pandémie.', 'L\'économie mondiale est encore en crise.', 'La pandémie a eu peu d\'effet sur l\'économie.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon verbe : "Ils _____ le projet demain."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'A2',
                    'reponseCorrecte' => 'présenteront',
                    'reponses' => ['présenteront', 'présentent', 'présenteraient'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Le changement climatique est un problème mondial qui nécessite une action collective urgente."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C1',
                    'reponseCorrecte' => 'Le changement climatique nécessite une action urgente et collective.',
                    'reponses' => ['Le changement climatique nécessite une action urgente et collective.', 'Le changement climatique est une question locale.', 'Le changement climatique est un problème résolu.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la bonne forme du pronom : "_____ a été difficile à résoudre."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'Cela',
                    'reponses' => ['Cela', 'Il', 'C\'est'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "L\'éducation est un droit fondamental pour tous les enfants, quel que soit leur milieu social."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B1',
                    'reponseCorrecte' => 'L\'éducation est un droit pour tous les enfants.',
                    'reponses' => ['L\'éducation est un droit pour tous les enfants.', 'L\'éducation est réservée aux enfants riches.', 'Seuls les enfants des grandes villes ont accès à l\'éducation.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon temps : "Si nous _____ plus d\'efforts, nous aurions réussi."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'avions fait',
                    'reponses' => ['avions fait', 'faisons', 'ferons'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Les avancées technologiques récentes ont radicalement transformé notre manière de travailler et de communiquer."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C1',
                    'reponseCorrecte' => 'Les technologies récentes ont profondément changé notre vie professionnelle et sociale.',
                    'reponses' => ['Les technologies récentes ont profondément changé notre vie professionnelle et sociale.', 'Les avancées technologiques n\'ont eu aucun impact.', 'Les technologies récentes n\'ont affecté que les loisirs.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon pronom : "____ a décidé de partir en vacances."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'A2',
                    'reponseCorrecte' => 'Il',
                    'reponses' => ['Il', 'Elle', 'Nous'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Les inégalités sociales sont un défi majeur dans la société actuelle."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'B2',
                    'reponseCorrecte' => 'Les inégalités sociales sont un problème important.',
                    'reponses' => ['Les inégalités sociales sont un problème important.', 'Les inégalités sociales n\'existent pas.', 'Les inégalités sociales sont en diminution.'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Dans le contexte actuel, la question de la souveraineté alimentaire soulève des débats philosophiques et économiques complexes, notamment sur la capacité des nations à garantir leur indépendance face aux fluctuations mondiales des marchés."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'Le débat porte sur l\'indépendance des nations face aux fluctuations économiques mondiales.',
                    'reponses' => ['Le débat porte sur l\'indépendance des nations face aux fluctuations économiques mondiales.', 'Le texte parle uniquement des conséquences de la crise alimentaire.', 'Les nations sont entièrement autonomes face aux fluctuations des marchés mondiaux.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la forme correcte du verbe : "Il est peu probable que cette proposition _____ un consensus parmi les experts."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'remporte',
                    'reponses' => ['remporte', 'remportait', 'a remporté'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "La pertinence de cette politique est remise en question par plusieurs analystes qui soulignent la contradiction entre les objectifs affichés et les mesures réellement mises en œuvre."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'Les analystes dénoncent l\'écart entre les objectifs et les mesures concrètes.',
                    'reponses' => ['Les analystes dénoncent l\'écart entre les objectifs et les mesures concrètes.', 'Les analystes soutiennent que la politique est efficace.', 'Les objectifs et les mesures sont parfaitement alignés.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la bonne préposition : "L\'augmentation des tensions géopolitiques a conduit à un renforcement des mesures de sécurité _____ frontière."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'à',
                    'reponses' => ['à', 'de', 'sur'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "Bien que la solution proposée présente des avantages indéniables, elle ne prend pas en compte certains paramètres essentiels, tels que l\'impact à long terme sur les ressources naturelles et la durabilité du projet."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'La solution ne prend pas en compte les conséquences à long terme sur l\'environnement.',
                    'reponses' => ['La solution ne prend pas en compte les conséquences à long terme sur l\'environnement.', 'La solution est totalement écologique et durable.', 'Les avantages de la solution sont inexploités.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la bonne forme du verbe : "Si le gouvernement _____ les préoccupations des citoyens, il aurait pu éviter la crise actuelle."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'avait pris en compte',
                    'reponses' => ['avait pris en compte', 'prend en compte', 'avait pris'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "En dépit de l\'envergure du projet, plusieurs experts estiment qu\'il est trop ambitieux pour être mené à bien dans les délais impartis, et que des ajustements sont indispensables."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'Le projet est trop ambitieux pour être terminé à temps sans modifications.',
                    'reponses' => ['Le projet est trop ambitieux pour être terminé à temps sans modifications.', 'Le projet est parfaitement dans les délais.', 'Les experts pensent que le projet est déjà un succès.'],
                ],
                [
                    'question' => 'Complétez la phrase avec le bon pronom relatif : "C\'est une problématique _____ il est difficile d\'apporter une solution rapide et efficace."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'dont',
                    'reponses' => ['dont', 'que', 'qui'],
                ],
                [
                    'question' => 'Lisez le texte suivant et choisissez la bonne réponse. "L\'émergence des technologies de l\'information et de la communication a bouleversé les pratiques sociales, offrant de nouvelles perspectives tout en soulevant des défis éthiques majeurs."',
                    'type' => 'Compréhension de la langue écrite',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'Les nouvelles technologies ont apporté des avantages et des défis éthiques.',
                    'reponses' => ['Les nouvelles technologies ont apporté des avantages et des défis éthiques.', 'Les technologies n\'ont pas modifié les pratiques sociales.', 'Les défis éthiques sont secondaires par rapport aux avantages des technologies.'],
                ],
                [
                    'question' => 'Complétez la phrase avec la bonne forme du verbe : "Si les propositions _____ mises en œuvre, nous aurions pu observer des résultats tangibles."',
                    'type' => 'Maîtrise des structures de la langue',
                    'difficulteeeee' => 'C2',
                    'reponseCorrecte' => 'avaient été',
                    'reponses' => ['avaient été', 'ont été', 'sont'],
                ],
            //Comprehension orale
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "Dans cet extrait, le conférencier aborde l\'impact des nouvelles technologies sur le marché de l\'emploi. Il explique que certaines professions vont disparaître, tandis que de nouvelles opportunités apparaîtront."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'Le conférencier parle de la disparition de certaines professions et de la création de nouvelles opportunités.',
                'reponses' => ['Le conférencier parle de la disparition de certaines professions et de la création de nouvelles opportunités.', 'Le conférencier parle uniquement des technologies de communication.', 'Le conférencier affirme que toutes les professions vont disparaître.'],
                'audio' => '/audio/conference_technologies_emploi.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "L\'interviewé explique que la crise climatique nécessite une action immédiate de la part des gouvernements, soulignant les risques graves pour l\'environnement si des mesures concrètes ne sont pas prises."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'L\'interviewé met en garde contre les risques environnementaux dus à l\'inaction face à la crise climatique.',
                'reponses' => ['L\'interviewé met en garde contre les risques environnementaux dus à l\'inaction face à la crise climatique.', 'L\'interviewé dit que la crise climatique n\'est pas urgente.', 'L\'interviewé parle des avantages économiques de la crise climatique.'],
                'audio' => '/audio/interview_crise_climatique.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "Dans cette conférence, le chercheur présente les résultats d\'une étude approfondie sur l\'intelligence artificielle et ses applications dans le domaine de la santé. Il explique comment l\'IA aide à la détection précoce des maladies."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'Le chercheur explique comment l\'IA améliore la détection des maladies dans le domaine de la santé.',
                'reponses' => ['Le chercheur explique comment l\'IA améliore la détection des maladies dans le domaine de la santé.', 'Le chercheur parle des inconvénients de l\'IA dans la santé.', 'Le chercheur affirme que l\'IA ne peut pas être utilisée dans le domaine médical.'],
                'audio' => '/audio/conference_ia_sante.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "L\'exposé traite des défis économiques auxquels les pays en développement font face, notamment les inégalités croissantes, le chômage et les difficultés d\'accès à l\'éducation."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'L\'exposé aborde les défis économiques, notamment les inégalités et le chômage dans les pays en développement.',
                'reponses' => ['L\'exposé aborde les défis économiques notamment les inégalités et le chômage dans les pays en développement.', 'L\'exposé parle de la croissance économique dans les pays en développement.', 'L\'exposé discute des avantages de la mondialisation pour les pays en développement.'],
                'audio' => '/audio/expose_defis_economiques.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "L\'invité évoque les évolutions récentes du marché du travail, en mettant l\'accent sur les nouvelles formes de travail à distance et la flexibilité des horaires."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'L\'invité parle des changements dans le marché du travail, y compris le travail à distance et la flexibilité des horaires.',
                'reponses' => ['L\'invité parle des changements dans le marché du travail, y compris le travail à distance et la flexibilité des horaires.', 'L\'invité explique les difficultés du travail en présentiel.', 'L\'invité défend la suppression du télétravail.'],
                'audio' => '/audio/interview_marche_travail.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "Lors de cette émission, les invités débattent des réformes nécessaires dans le système éducatif, notamment la mise en place de programmes plus flexibles et adaptés aux besoins des étudiants."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'Les invités discutent de réformes nécessaires dans le système éducatif, notamment des programmes plus flexibles.',
                'reponses' => ['Les invités discutent de réformes nécessaires dans le système éducatif, notamment des programmes plus flexibles.', 'Les invités défendent le système éducatif actuel sans modifications.', 'Les invités suggèrent de supprimer l\'éducation supérieure.'],
                'audio' => '/audio/emission_reformes_educatives.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "Le politicien explique les enjeux de la politique migratoire, en soulignant l\'importance de l\'intégration des migrants dans la société et les défis liés à la gestion des flux migratoires."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'Le politicien parle de l\'intégration des migrants et des défis de la politique migratoire.',
                'reponses' => ['Le politicien parle de l\'intégration des migrants et des défis de la politique migratoire.', 'Le politicien critique les politiques anti-migrants.', 'Le politicien propose de limiter les flux migratoires à zéro.'],
                'audio' => '/audio/interview_politique_migratoire.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "Dans son allocution, le président a souligné l\'importance de la solidarité internationale pour résoudre les crises humanitaires, notamment la famine et les conflits armés."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'Le président met l\'accent sur la solidarité internationale face aux crises humanitaires.',
                'reponses' => ['Le président met l\'accent sur la solidarité internationale face aux crises humanitaires.', 'Le président parle des bienfaits du nationalisme dans la résolution des crises.', 'Le président minimise l\'importance des crises humanitaires.'],
                'audio' => '/audio/allocution_president_crises_humanitaires.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "L\'expert en santé publique explique les avantages et les inconvénients des vaccins dans la lutte contre les maladies infectieuses, tout en abordant les préoccupations liées aux effets secondaires."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'L\'expert discute des avantages des vaccins et des préoccupations liées aux effets secondaires.',
                'reponses' => ['L\'expert discute des avantages des vaccins et des préoccupations liées aux effets secondaires.', 'L\'expert défend l\'idée de supprimer les vaccins.', 'L\'expert ne mentionne pas les effets secondaires des vaccins.'],
                'audio' => '/audio/expert_vaccins_sante_publique.m4a',
            ],
            [
                'question' => 'Écoutez l\'extrait audio suivant et choisissez la bonne réponse. "Dans cette interview, l\'économiste analyse les causes profondes de la crise financière mondiale, en mettant l\'accent sur la spéculation excessive et l\'instabilité des marchés financiers."',
                'type' => 'Compréhension orale',
                'difficulteeeee' => 'C2',
                'reponseCorrecte' => 'L\'économiste explique les causes profondes de la crise, notamment la spéculation excessive et l\'instabilité des marchés.',
                'reponses' => ['L\'économiste explique les causes profondes de la crise, notamment la spéculation excessive et l\'instabilité des marchés.', 'L\'économiste ne discute pas de la spéculation dans la crise financière.', 'L\'économiste propose des solutions immédiates à la crise sans analyse approfondie.'],
                'audio' => '/audio/interview_economiste_crise_financiere.m4a',
            ],

            ];

        // Création et persistance des questions
        foreach ($questionsData as $data) {
            $question = new Question();
            $question->setQuestion($data['question'])
                ->setType($data['type'])
                ->setDifficulteeeee($data['difficulteeeee'])
                ->setReponseCorrecte($data['reponseCorrecte'])
                ->setReponses($data['reponses'])
                ;

            if (isset($data['audio'])) {
                $question->setAudio($data['audio']);
            }
            // Persiste chaque question dans la base de données
            $manager->persist($question);
        }

        // Effectuer un flush pour sauvegarder toutes les entités
        $manager->flush();
    }
}
