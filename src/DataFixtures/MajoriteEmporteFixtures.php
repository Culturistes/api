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

 class MajoriteEmporteFixtures extends Fixture implements FixtureGroupInterface
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
        $minigame = $this->minigameRepository->findOneBy(["tag" => 'lme']);

        if (($handle = fopen("assets/import/majorite-emporte.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row !== 1) { 
                    $question = new Question();

                    //question
                    $question->setTitle($data[1] . ' ou ' . $data[2]);

                    //minigame
                    $question->setMinigame($minigame);

                    //categorie
                    $category = $this->categoryRepository->findOneBy(["name" => $data[0]]);
                    $question->setCategory($category);

                    // question
                    $question->setAnswers([$data[1], $data[2]]);
                    $name = $data[1];

                    $manager->persist($question);
                }

                $row++;
            }
            fclose($handle);
        }

        $manager->flush();
     }

     public static function getGroups(): array
     {
         return ['majoriteEmporte'];
     }
 }
