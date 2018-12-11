<?php

/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 30/11/18
 * Time: 01:44
 */

namespace App\Controller;


use App\Entity\City;
use App\Entity\UserId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
   /* public function login_check(Request $request)
    {
       var_dump($request);
       die();
       return $this->getUser();
    }     */

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $cityManager = $this->getDoctrine()->getRepository(City::class);
        $user = new UserId();
        $data = $request->getContent();
        $data = json_decode($data, true);
        $username = $data['username'];
        $password = $data['password'];
        $name = $data['name'];
        $surname = $data['surname'];
        $phone = $data['phone'];
        $sex = $data['sex'];
        $city = $cityManager->findOneBy(['name' => 'Anglet']);

        $user->setEmail($username)->setName($name)->setCity($city)->setSex($sex)->setPassword($passwordEncoder->encodePassword($user, $password))
            ->setPhone($phone)->setSurname($surname);

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function me()
    {
        return new Response(sprintf('%d', $this->getUser()->getId()));
    }
}
