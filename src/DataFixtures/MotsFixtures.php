<?php

 namespace App\DataFixtures;

 use Doctrine\Bundle\FixturesBundle\Fixture;
 use Doctrine\Persistence\ObjectManager;
 use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
 use App\Repository\QuestionRepository;
 use App\Repository\RegionRepository;
 use App\Repository\MinigameRepository;
 use App\Repository\CategoryRepository;
 use App\Entity\Question;

 class MotsFixtures extends Fixture implements FixtureGroupInterface
 {
     private $questionRepository;
     private $regionRepository;
     private $minigameRepository;
     private $categoryRepository;

     public function __construct(QuestionRepository $questionRepository, RegionRepository $regionRepository, MinigameRepository $minigameRepository, CategoryRepository $categoryRepository)
     {
         $this->questionRepository = $questionRepository;
         $this->regionRepository = $regionRepository;
         $this->minigameRepository = $minigameRepository;
         $this->categoryRepository = $categoryRepository;
     }

     public function load(ObjectManager $manager)
     {
        $row = 1;
        $minigame = $this->minigameRepository->findOneBy(["tag" => 'quiz']);
        $category = $this->categoryRepository->findOneBy(["tag" => 'lang']);

        if (($handle = fopen("assets/import/mots.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row !== 1) {
                    if ($data[0] !== '') {
                        $question = new Question();
    
                        //question
                        $question->setTitle($data[1]);
    
                        //minigame
                        $question->setMinigame($minigame);
    
                        //categorie
                        $question->setCategory($category);

                        //region
                        $dbRegion = $this->regionRepository->findOneBy(["name" => $data[0]]);

                        if ($dbRegion !== null) {
                            $question->addRegion($dbRegion);
                        }
    
                        // question
                        $question->setAnswers(['$' . $data[2], $data[3], $data[4], $data[5]]);
    
                        $manager->persist($question);
                    }
                }

                $row++;
            }
            fclose($handle);
        }

        $manager->flush();
     }

     public static function getGroups(): array
     {
         return ['mots'];
     }
 }
