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

    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $em = $this->getDoctrine()->getManager();
        $cityManager = $this->getDoctrine()->getRepository(City::class);
        $user = new UserId();

        $username = $request->request->get('username');
        $password = $request->request->get('password');
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $phone = $request->request->get('phone');
        $sex = $request->request->get('sex');
        $city =$cityManager->findOneBy(['name' => $request->request->get('city')]);

        $user->setSurname($surname)->setName($name)->setCity($city)->setSex($sex)->setPassword($passwordEncoder->encodePassword($user, $password))
            ->setPhone($phone)->setEmail($username);

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function me(){
        return new Response(sprintf('%d', $this->getUser()->getId()));
    }
}