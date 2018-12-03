<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CityFixtures extends Fixture{
    public function load(ObjectManager $manager){

        $cities = array("Anglet", "Bayonne", "Bidart", "Ustaritz", "Bordeaux", "Lille", "Templeuve", "Paris", "Lyon", "Toulouse");
        $cps= array("64600", "64100", "64210", "64480", "33000", "59000", "59242", "75000", "69001", "31100");
        for($i=0; $i<10 ; $i++){
            $city = new City();
            $city->setName($cities[$i]);
            $city->setCp($cps[$i]);
            $manager->persist($city);
            $this->addReference('city_'.$i, $city);
        }

        $manager->flush();
    }
}