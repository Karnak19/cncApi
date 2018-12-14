<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/11/18
 * Time: 22:14
 */

namespace App\DataFixtures;


use App\Entity\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserIdFixture extends Fixture implements DependentFixtureInterface {

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager){
        $faker = Faker\Factory::create();
        $sex = array("Homme", "Femme");
        $pass = new Pbkdf2PasswordEncoder();
        for ($i = 0 ; $i < 20 ; $i++ ){
            $user = new UserId();
            $user->setName($faker->firstName);
            $user->setSurname(sprintf("user%d",$i));
            $user->setEmail(sprintf("user%d@user.com", $i));
            $user->setPhone('0606060606');
            $user->setPassword($this->encoder->encodePassword($user, 'userid'));
            $user->setSex($sex[$i%2]);
            $manager->persist($user);
            $this->addReference('userid_'.$i, $user);
            $user->setCity($this->getReference('city_'.rand(0,9)));
            if ($i % 5 == 0){
                $user->setSalon($this->getReference('salon_'.$i));
                $user->setRoles(['ROLE_SALON']);
            }
        }
        $user = new UserId();
        $user->setName('admin');
        $user->setSurname('admin');
        $user->setEmail("admin@admin.com");
        $user->setPhone('0606060606');
        $user->setPassword($this->encoder->encodePassword($user, 'admin'));
        $user->setSex('Homme');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $user->setCity($this->getReference('city_'.rand(0,9)));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CityFixtures::class];
    }

}