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
    { "name": "Sucre de canne", "img": "sucre_de_canne", "isGoodAnswer": true },
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
    { "name": "Sucre de canne", "img": "sucre_de_canne", "caught": false }
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
    { "name": "Saucisse de Toulouse", "img": "saucisse", "isGoodAnswer": true },
    { "name": "Tomates", "img": "tomate", "isGoodAnswer": true },
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
    { "name": "Saucisse de Toulouse", "img": "saucisse", "caught": false },
    { "name": "Tomates", "img": "tomate", "caught": false },
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

$jsonContent4 =
'
{
  "name": "Tapenade",
  "possibleIngredients": [
    { "name": "Olives noires", "img": "olives_noires", "isGoodAnswer": true },
    { "name": "Anchois", "img": "anchois", "isGoodAnswer": true },
    { "name": "Câpres", "img": "capres", "isGoodAnswer": true },
    { "name": "Ail", "img": "ail", "isGoodAnswer": true },
    { "name": "Jus de citron", "img": "citron_jaune", "isGoodAnswer": true },
    { "name": "Poivre", "img": "poivre", "isGoodAnswer": true },
    { "name": "Oignon", "img": "oignon", "isGoodAnswer": false },
    { "name": "Moutarde", "img": "moutarde", "isGoodAnswer": false },
    { "name": "Mayonnaise", "img": "mayo", "isGoodAnswer": false },
    { "name": "Cornichon", "img": "cornichon", "isGoodAnswer": false },
    { "name": "Oeufs", "img": "oeuf", "isGoodAnswer": false }
  ],
  "ingredients": [
    { "name": "Olives noires", "img": "olives_noires", "caught": false },
    { "name": "Anchois", "img": "anchois", "caught": false },
    { "name": "Câpres", "img": "capres", "caught": false },
    { "name": "Ail", "img": "ail", "caught": false },
    { "name": "Jus de citron", "img": "citron_jaune", "caught": false },
    { "name": "Poivre", "img": "poivre", "caught": false }
  ]
}
';

$jsonContent5 =
'
{
  "name": "Quiche lorraine",
  "possibleIngredients": [
    { "name": "Pâte brisée", "img": "pate_brisee", "caught": true },
    { "name": "Lardons", "img": "lardons", "caught": true },
    { "name": "Oeufs", "img": "oeuf", "caught": true },
    { "name": "Crème fraiche", "img": "creme_fraiche", "caught": true },
    { "name": "Lait", "img": "lait", "caught": true },
    { "name": "Poivre", "img": "poivre", "caught": true },
    { "name": "Sel", "img": "sel", "caught": true },
    { "name": "Noix de muscade", "img": "noix_de_musucade", "caught": true },
    { "name": "Gruyère", "img": "gruyere", "isGoodAnswer": false },
    { "name": "Poireaux", "img": "poireau", "isGoodAnswer": false },
    { "name": "Saumon", "img": "saumon", "isGoodAnswer": false },
    { "name": "Tomates", "img": "tomate", "isGoodAnswer": false },
    { "name": "Oignons", "img": "oignon", "isGoodAnswer": false },
    { "name": "Moutarde", "img": "moutarde", "isGoodAnswer": false }
  ],
  "ingredients": [
    { "name": "Pâte brisée", "img": "pate_brisee", "caught": false },
    { "name": "Lardons", "img": "lardons", "caught": false },
    { "name": "Oeufs", "img": "oeuf", "caught": false },
    { "name": "Crème fraiche", "img": "creme_fraiche", "caught": false },
    { "name": "Lait", "img": "lait", "caught": false },
    { "name": "Poivre", "img": "poivre", "caught": false },
    { "name": "Sel", "img": "sel", "caught": false },
    { "name": "Noix de muscade", "img": "noix_de_musucade", "caught": false }
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
  } else if ($i == 3) {
    $finalString = $finalString . $jsonContent4;
  } else if ($i == 4) {
    $finalString = $finalString . $jsonContent5;
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