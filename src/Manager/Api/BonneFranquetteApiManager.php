<?php

namespace App\Manager\Api;

use App\Repository\FunCityNameRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class BonneFranquetteApiManager
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

            $jsonContent =
'
{
  "name": "",
  "possibleIngredients": [
    { "name": "Carotte", "img": "#ff0000" }
  ],
  "ingredients": [
    { "name": "Carotte", "img": "#ff0000", "caught": false }
  ]
}
';

            return $jsonContent;

    }
}