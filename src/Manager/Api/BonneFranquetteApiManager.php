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
  "name": "",
  "possibleIngredients": [
    { "name": "Carotte", "img": "#ff0000" }
  ],
  "ingredients": [
    { "name": "Carotte", "img": "#ff0000", "caught": false }
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
dump($finalString);
            return $finalString;

    }
}