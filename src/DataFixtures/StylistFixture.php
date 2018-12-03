<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/11/18
 * Time: 22:35
 */

namespace App\DataFixtures;


use App\Entity\Stylist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class StylistFixture extends Fixture implements DependentFixtureInterface {
    public function load(ObjectManager $manager){
        $faker = Faker\Factory::create();
        for ($i=0 ; $i < 20 ; $i++) {
            $stylist = new Stylist();
            $stylist->setName($faker->firstName);
            $stylist->setSurname($faker->firstName);
            $manager->persist($stylist);
            $this->addReference("stylist_".$i, $stylist);
            $stylist->setSalon($this->getReference('salon_'.rand(0,9)));
            }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SalonFixtures::class];
    }
}