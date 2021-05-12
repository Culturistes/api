<?php

 namespace App\DataFixtures;

 use Doctrine\Bundle\FixturesBundle\Fixture;
 use Doctrine\Persistence\ObjectManager;
 use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
 use App\Repository\FunCityNameRepository;
 use App\Repository\RegionRepository;
 use App\Entity\FunCityName;

 class FunCityNameFixtures extends Fixture implements FixtureGroupInterface
 {
     private $funCityNameRepository;
     private $regionRepository;

     public function __construct(FunCityNameRepository $funCityNameRepository, RegionRepository $regionRepository)
     {
         $this->funCityNameRepository = $funCityNameRepository;
         $this->regionRepository = $regionRepository;
     }

     public function load(ObjectManager $manager)
     {
        $row = 1;
        if (($handle = fopen("assets/import/fun-city-name.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row !== 1) { 
                    $funCityName = new FunCityName();

                    // Name
                    $name = $data[0];
                    $n = strpos($name," (");
                    if($n >= 1) {
                        $name = ucfirst(substr($name, 0, $n));
                    } else {
                        $name = ucfirst($name);
                    }
                    $funCityName->setName($name);

                    // Localisation
                    $city = file_get_contents('https://api-adresse.data.gouv.fr/search/?q='.str_replace(' ', '', $name).'&type=municipality');
                    $json = json_decode($city);
                    if (isset($json->features[0])) {
                        $funCityName->setLongitude($json->features[0]->geometry->coordinates[0]);
                        $funCityName->setLatitude($json->features[0]->geometry->coordinates[1]);
                    

                        //region
                        $region = explode(", ", $json->features[0]->properties->context);


                        $dbRegion = $this->regionRepository->findOneBy(["name" => $region]);

                        if ($dbRegion !== null) {
                            $funCityName->addRegion($dbRegion);
                        }
                    }
                    
            
                    // Gentilé
                    $funCityName->setGentileM($data[1]);
                    $funCityName->setGentileF($data[2]);

                    $manager->persist($funCityName);
                }

                $row++;
            }
            fclose($handle);
        }

        $manager->flush();
     }

     public static function getGroups(): array
     {
         return ['funCityName'];
     }
 }
