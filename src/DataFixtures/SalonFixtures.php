<?php

/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/11/18
 * Time: 21:41
 */

namespace App\DataFixtures;


use App\Entity\Salon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;

class SalonFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $pass = new Pbkdf2PasswordEncoder();
        for ($i = 0; $i < 10; $i++) {
            $salon = new Salon();
            $salon->setName("salon" . $i);
            $salon->setPhone(0606060606);
            $salon->setPassword($pass->encodePassword('salon', 'password'));
            $salon->setEmail("salon" . $i . "@salon.com");
            $manager->persist($salon);
            $this->addReference('salon_' . $i, $salon);
        }

        $manager->flush();
    }
}