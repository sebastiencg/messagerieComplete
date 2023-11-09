<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/profile')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile')]
    public function index(): Response
    {
        return $this->json($this->getUser()->getProfile(),200,[],['groups'=>'profile:read-all']);
    }

    #[Route('/update/', name: 'app_updateProfile', methods: ['PUT'])]
    public function updateProfile(ProfileRepository $profileRepository, Request $request ,SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        $json = $request->getContent();
        $update = $serializer->deserialize($json,Profile::class,'json');
        $profile=$this->getUser()->getProfile();
        $profile->setUsername($update->getUsername());
        $entityManager->persist($profile);
        $entityManager->flush();

        return $this->json($profile,200,[],['groups'=>'profile:read-all']);
    }
}
