<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SerializerInterface $serializer,UserRepository $userRepository): Response
    {
        $json = $request->getContent();
        $user = $serializer->deserialize($json,User::class,'json');

        if ($user) {
            $check= $userRepository->findBy(["email"=>$user->getEmail()]);
            if($check){
                return $this->json("email ". $user->getEmail() ." est deja pris");
            }
            $user->setPassword(
                $userPasswordHasher->hashPassword($user,$user->getPassword())
            );

            if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $profile= new Profile();
                $profile->setOfUser($user);
                $profile->setUsername("username");
                $entityManager->persist($profile);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->json("user ajouter");
            }
            else {
                return $this->json( $user->getEmail() ." est pas un mail valable");
            }



        }

        return $this->json("error");
    }
}
