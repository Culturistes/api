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
            $jsonContent1 =
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

$jsonContent2 =
'
{
  "name": "Cassoulet",
  "possibleIngredients": [
    { "name": "Haricots blancs", "img": "haricots_blancs", "isGoodAnswer": true },
    { "name": "Jarret de porc", "img": "jarret_de_porc", "isGoodAnswer": true },
    { "name": "Saucisse de Toulouse", "img": "sucre_de_canne", "isGoodAnswer": true },
    { "name": "Tomates", "img": "saucisse", "isGoodAnswer": true },
    { "name": "Carottes", "img": "carotte", "isGoodAnswer": true },
    { "name": "Céleri", "img": "celeri", "isGoodAnswer": true },
    { "name": "Oignons", "img": "oignon", "isGoodAnswer": true },
    { "name": "Ail", "img": "ail", "isGoodAnswer": true },
    { "name": "Sel", "img": "sel", "isGoodAnswer": true },
    { "name": "Poivre", "img": "poivre", "isGoodAnswer": true },
    { "name": "Pomme de terre", "img": "pomme_de_terre", "isGoodAnswer": false },
    { "name": "Lentilles", "img": "lentilles", "isGoodAnswer": false },
    { "name": "Poulet", "img": "poulet", "isGoodAnswer": false },
    { "name": "Potimarron", "img": "potiron", "isGoodAnswer": false },
    { "name": "Champignon", "img": "champignon", "isGoodAnswer": false }
  ],
  "ingredients": [
    { "name": "Haricots blancs", "img": "haricots_blancs", "caught": false },
    { "name": "Jarret de porc", "img": "jarret_de_porc", "caught": false },
    { "name": "Saucisse de Toulouse", "img": "sucre_de_canne", "caught": false },
    { "name": "Tomates", "img": "saucisse", "caught": false },
    { "name": "Carottes", "img": "carotte", "caught": false },
    { "name": "Céleri", "img": "celeri", "caught": false },
    { "name": "Oignons", "img": "oignon", "caught": false },
    { "name": "Ail", "img": "ail", "caught": false },
    { "name": "Sel", "img": "sel", "caught": false },
    { "name": "Poivre", "img": "poivre", "caught": false }
  ]
}
';

$jsonContent3 =
'
{
  "name": "Kouign Amann",
  "possibleIngredients": [
    { "name": "Farine", "img": "farine", "isGoodAnswer": true },
    { "name": "Beurre", "img": "beurre", "isGoodAnswer": true },
    { "name": "Levure de boulanger", "img": "levure", "isGoodAnswer": true },
    { "name": "Eau tiède", "img": "eau", "isGoodAnswer": true },
    { "name": "Sucre", "img": "sucre", "isGoodAnswer": true },
    { "name": "Sel", "img": "sel", "isGoodAnswer": true },
    { "name": "Chocolat", "img": "chocolat", "isGoodAnswer": false },
    { "name": "Citron", "img": "citron_jaune", "isGoodAnswer": false },
    { "name": "Oeufs", "img": "oeuf", "isGoodAnswer": false },
    { "name": "Miel", "img": "miel", "isGoodAnswer": false },
    { "name": "Lait", "img": "lait", "isGoodAnswer": false },
    { "name": "Sirop d\'érable", "img": "sirop_erable", "isGoodAnswer": false },
    { "name": "Vanille", "img": "vanille", "isGoodAnswer": false }
  ],
  "ingredients": [
    { "name": "Farine", "img": "farine", "caught": false },
    { "name": "Beurre", "img": "beurre", "caught": false },
    { "name": "Levure de boulanger", "img": "levure", "caught": false },
    { "name": "Eau tiède", "img": "eau", "caught": false },
    { "name": "Sucre", "img": "sucre", "caught": false },
    { "name": "Sel", "img": "sel", "caught": false }
  ]
}
';

$finalString = '[';

for ($i=0; $i < $number; $i++) { 
  if ($i == 0) {
    $finalString = $finalString . $jsonContent1;
  } else if ($i == 1) {
    $finalString = $finalString . $jsonContent2;
  } else if ($i == 2) {
    $finalString = $finalString . $jsonContent3;
  } else {
    $finalString = $finalString . $jsonContent1;
  }
    
    if ($i < $number - 1) {
        $finalString = $finalString . ',';
    }
}

$finalString = $finalString . ']';
            return $finalString;

    }
}