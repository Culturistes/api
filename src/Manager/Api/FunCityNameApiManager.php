<?php

namespace App\Manager\Api;

use App\Repository\FunCityNameRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class FunCityNameApiManager
{
    private $funCityNameRepository;
    private $serializer;

    public function __construct(FunCityNameRepository $funCityNameRepository, SerializerInterface $serializer)
    {
        $this->funCityNameRepository = $funCityNameRepository;
        $this->serializer = $serializer;
    }

    public function getQuestions($number)
    {
        $results = $this->funCityNameRepository->findRandomFunCityName($number);

        // Vérifie si on a le nombre de questions retournées est bien le même que celui demandé
        if (count($results) == $number) {
            $jsonContent = $this->serializer->serialize($results, 'json', [
                AbstractNormalizer::ATTRIBUTES => ['name', 'latitude', 'longitude', 'description']
            ]);
    
            return $jsonContent;
        } else {
            throw new \Exception('Pas assez de questions');
        }
    }
}