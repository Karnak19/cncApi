<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/11/18
 * Time: 22:54
 */

namespace App\DataFixtures;


use App\Entity\Rdv;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class RdvFixture extends Fixture implements DependentFixtureInterface {
    public function load(ObjectManager $manager){
        $faker = Faker\Factory::create();
        for($i=0 ; $i <= 50 ; $i++){
            $rdv = new Rdv();
            $format = 'Y-m-d H:i:s';
            $stringDate = '2018-'.rand(1,12).'-'.rand(1,29).' '.rand(10,19).':'.rand(10,59).':00';
            $date= \DateTime::createFromFormat($format, $stringDate);
            $dateEnd= \DateTime::createFromFormat($format, $stringDate);
            $dateEnd->modify('+1 hour');
            $rdv->setDateStart($date);
            $rdv->setDateEnd($dateEnd);
            $manager->persist($rdv);
            $rdv->setUserid($this->getReference('userid_'.rand(0,19)));
            $rdv->setStylist($this->getReference('stylist_'.rand(0,19)));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserIdFixture::class, StylistFixture::class];
    }

}