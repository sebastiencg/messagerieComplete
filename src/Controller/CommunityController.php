<?php

namespace App\Controller;

use App\Entity\Community;
use App\Entity\Profile;
use App\Repository\CommunityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/community')]

class CommunityController extends AbstractController
{
    #[Route('/all', name: 'app_community_index_all', methods: ['GET'])]
    public function indexAll( CommunityRepository $communityRepository): Response
    {
        return $this->json($communityRepository->findAll(),200,[],['groups'=>'community:read-all']);
    }
    #[Route('/', name: 'app_community_index', methods: ['GET'])]
    public function index( ): Response
    {
        return $this->json($this->getUser()->getProfile()->getMyCommunities()->getValues(),200,[],['groups'=>'community:read-all']);
    }

    #[Route('/create', name: 'app_community_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $community = $serializer->deserialize($json,Community::class,'json');
        $community->setAuthor($this->getUser()->getProfile());
        $community->addMember($this->getUser()->getProfile());
        $entityManager->persist($community);
        $entityManager->flush();
        return $this->json($community,200,[],['groups'=>'community:read-all']);
    }

    #[Route('/{id}', name: 'app_community_show', methods: ['GET'])]
    public function show(Community $community): Response
    {
        return $this->json($community,200,[],['groups'=>'community:read-all']);
    }

    #[Route('/{id}/join', name: 'app_community_join', methods: ['GET'])]
    public function joinCommunity(Community $community ,EntityManagerInterface $entityManager): Response
    {
        $community->addMember($this->getUser()->getProfile());
        $entityManager->persist($community);
        $entityManager->flush();
        return $this->json($community,200,[],['groups'=>'community:read-all']);
    }

    #[Route('/{id}/leave', name: 'app_community_leave', methods: ['DELETE'])]
    public function leaveCommunity(Community $community ,EntityManagerInterface $entityManager): Response
    {
        if (!in_array($this->getUser()->getProfile(),$community->getMember()->getValues())){
            return $this->json('you are not part of the community');
        }
        $community->removeMember($this->getUser()->getProfile());
        $entityManager->persist($community);
        $entityManager->flush();
        return $this->json('you left the community');
    }

    #[Route('/{id}/edit', name: 'app_community_edit', methods: ['PATCH'])]
    public function edit(Request $request, Community $community,SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        if($this->getUser()->getProfile() === $community->getAuthor()){
            $json = $request->getContent();
            $update = $serializer->deserialize($json,Community::class,'json');
            $community->setName($update->getName());
            $entityManager->persist($community);
            $entityManager->flush();
            return $this->json($community,200,[],['groups'=>'community:read-all']);
        }
        return $this->json('error');

    }
    #[Route('/{id}/delete', name: 'app_community_delete', methods: ['DELETE'])]
    public function delete(Community $community, EntityManagerInterface $entityManager): Response
    {
        {
            if ($community->getAuthor() == $this->getUser()->getProfile()) {
                $entityManager->remove($community);
                $entityManager->flush();
            }
            return $this->json('community delete');
        }
    }
}
