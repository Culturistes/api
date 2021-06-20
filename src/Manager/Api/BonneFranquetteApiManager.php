<?php

namespace App\Manager\Api;

use App\Repository\FunCityNameRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Doctrine\Common\Collections\ArrayCollection;

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
  "name": "Ti-punch",
  "possibleIngredients": [
    { "name": "Rhum blanc", "img": "rbl" },
    { "name": "Citron vert", "img": "ctv" },
    { "name": "Cognac", "img": "cog" },
    { "name": "Citron jaune", "img": "ctj" },
    { "name": "Gingembre", "img": "gin" },
    { "name": "Orange", "img": "ora" },
    { "name": "Ananas", "img": "ana" },
    { "name": "Menthe", "img": "men" }
  ],
  "ingredients": [
    { "name": "Rhum blanc", "img": "rbl", "caught": false },
    { "name": "Citron vert", "img": "ctv", "caught": false },
    { "name": "Sirop de sucre de canne", "img": "sdc", "caught": false }
  ]
}
';

$finalString = '[';

for ($i=0; $i < $number; $i++) { 
    $finalString = $finalString . $jsonContent;
    if ($i < $number - 1) {
        $finalString = $finalString . ',';
    }
}

$finalString = $finalString . ']';
            return $finalString;

    }
}