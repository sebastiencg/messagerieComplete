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

    #[Route('/update/', name: 'app_updateProfile', methods: ['PATCH'])]
    public function updateProfile(ProfileRepository $profileRepository ,Profile $profilet, Request $request ,SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        $json = $request->getContent();
        $update = $serializer->deserialize($json,Profile::class,'json');
        $profilet->setVisibility($update->isVisibility());


        $profile=$this->getUser()->getProfile();
        $profile->setUsername($update->getUsername());
        $entityManager->persist($profile);
        $entityManager->flush();

        return $this->json($profile,200,[],['groups'=>'profile:read-all']);
    }
    #[Route('/allProfile/', name: 'app_relation_index_all', methods: ['GET'])]
    public function allProfile(ProfileRepository $profileRepository): Response
    {
        return $this->json($profileRepository->findBy(["visibility"=>true]),200,[],['groups'=>'relation:read-one']);
    }

    #[Route('/searchProfile/', name: 'app_relation_searchProfile', methods: ['POST'])]
    public function searchProfile(ProfileRepository $profileRepository, Request $request ,SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $profile = $serializer->deserialize($json,Profile::class,'json');

        return $this->json($profileRepository->findBy(["username"=>$profile->getUsername()]),200,[],['groups'=>'profile:read-one']);
    }
}
