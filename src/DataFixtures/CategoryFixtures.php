<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $peoples = [
            [
                'name' => 'LINGUISTIQUE',
                'tag' => 'lang'
            ],
            [
                'name' => 'CULTURE, LOISIRS',
                'tag' => 'cult'
            ],
            [
                'name' => 'GÉOGRAPHIE',
                'tag' => 'geog'
            ],
            [
                'name' => 'GASTRONOMIE',
                'tag' => 'gast'
            ],
        ];

        foreach ($peoples as $value){
            $category = new Category();
            $category->setName($value['name']);
            $category->setTag($value['tag']);
    
            $manager->persist($category);
        }
        
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['category'];
    }
}
