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

 class QuizFixtures extends Fixture implements FixtureGroupInterface
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
        $category = $this->categoryRepository->findOneBy(["tag" => 'cult']);

        if (($handle = fopen("assets/import/quiz.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row !== 1) {
                    if ($data[0] !== '') {
                        $question = new Question();
    
                        //question
                        $question->setTitle($data[2]);
    
                        //minigame
                        $question->setMinigame($minigame);
    
                        //categorie
                        $question->setCategory($category);
    
                        // question
                        $question->setAnswers([$data[3], $data[4], $data[5], $data[6]]);
    
                        $question->setDescription($data[7]);
    
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
         return ['quiz'];
     }
 }
