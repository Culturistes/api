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
    { "name": "Rhum blanc", "img": "rhum", "isGoodAnswer": true },
    { "name": "Citron vert", "img": "citron_vert", "isGoodAnswer": true },
    { "name": "Sirop de sucre de canne", "img": "sucre_de_canne", "isGoodAnswer": true },
    { "name": "Cognac", "img": "cognac", "isGoodAnswer": false },
    { "name": "Citron jaune", "img": "citron_jaune", "isGoodAnswer": false },
    { "name": "Gingembre", "img": "gingembre", "isGoodAnswer": false },
    { "name": "Orange", "img": "orange", "isGoodAnswer": false },
    { "name": "Ananas", "img": "ananas", "isGoodAnswer": false },
    { "name": "Menthe", "img": "menthe", "isGoodAnswer": false }
  ],
  "ingredients": [
    { "name": "Rhum blanc", "img": "rhum", "caught": false },
    { "name": "Citron vert", "img": "citron_vert", "caught": false },
    { "name": "Sirop de sucre de canne", "img": "sucre_de_canne", "caught": false }
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