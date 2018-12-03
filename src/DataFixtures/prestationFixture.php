<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/11/18
 * Time: 22:48
 */

namespace App\DataFixtures;


use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class prestationFixture extends Fixture implements DependentFixtureInterface {
    public function load(ObjectManager $manager){
        for($i = 0 ; $i < 10 ; $i++){
            $prestation = new Prestation();
            $prestation->setLabel('label'.$i);
            $prestation->setPrice(rand(10,30));
            $manager->persist($prestation);
            $prestation->setSalon($this->getReference('salon_'.rand(0,9), $prestation));
        }
        $manager->flush();
    }

    public function getDependencies(){
        return [SalonFixtures::class];
    }
}