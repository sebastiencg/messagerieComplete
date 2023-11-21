<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Profile;
use App\Repository\GroupRepository;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/group')]
class GroupController extends AbstractController
{

    #[Route('/', name: 'app_group_index', methods: ['GET'])]
    public function index( ): Response
    {
        return $this->json($this->getUser()->getProfile()->getMyGroups()->getValues(),200,[],['groups'=>'group:read-all']);
    }

    #[Route('/new', name: 'app_group_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $group = $serializer->deserialize($json,Group::class,'json');
        $group->setAuthor($this->getUser()->getProfile());
        $group->addMember($this->getUser()->getProfile());
        $group->addAdmin($this->getUser()->getProfile());
        $entityManager->persist($group);
        $entityManager->flush();
        return $this->json($group,200,[],['groups'=>'group:read-all']);
    }

    #[Route('/{id}/member/exclude', name: 'app_group_member_exclude', methods: ['DELETE'])]
    public function excludeMember(Request $request,ProfileRepository $profileRepository, EntityManagerInterface $entityManager,SerializerInterface $serializer,Group $group): Response
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $profile=$profileRepository->findOneBy(["id"=>$data["id"]]);
        if (!$profile){
            return $this->json('profile no find');
        }
        if (!in_array($profile,$group->getMember()->getValues())){
            return $this->json('$profile no member');
        }
        if (!in_array($this->getUser()->getProfile(),$group->getAdmin()->getValues())){
            return $this->json('you are no admin');

        }
        $groupInvitations=$group->getInvitations()->getValues();
        foreach ($groupInvitations as  $groupInvitation){
            if ($groupInvitation->getProfile() === $profile){
               $entityManager->remove($groupInvitation);
            }
        }
        $group->removeMember($profile);
        $entityManager->persist($group);
        $entityManager->flush();
        return $this->json('member exclude');
    }

    #[Route('/{id}/member/promote', name: 'app_group_member_promote', methods: ['POST'])]
    public function promoteMember(Request $request,ProfileRepository $profileRepository, EntityManagerInterface $entityManager,SerializerInterface $serializer,Group $group): Response
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $profile=$profileRepository->findOneBy(["id"=>$data["id"]]);
        if (!$profile){
            return $this->json('profile no find');
        }
        if (!in_array($profile,$group->getMember()->getValues())){
            return $this->json('$profile no member');
        }
        if (!in_array($this->getUser()->getProfile(),$group->getAdmin()->getValues())){
            return $this->json('you are no admin');

        }
        $group->addAdmin($profile);
        $entityManager->persist($group);
        $entityManager->flush();
        return $this->json('member promote');
    }
    #[Route('/{id}/member/demote', name: 'app_group_member_demote', methods: ['POST'])]
    public function demoteMember(Request $request,ProfileRepository $profileRepository, EntityManagerInterface $entityManager,SerializerInterface $serializer,Group $group): Response
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $profile=$profileRepository->findOneBy(["id"=>$data["id"]]);
        if (!$profile){
            return $this->json('profile no find');
        }
        if (!in_array($profile,$group->getMember()->getValues())){
            return $this->json('$profile no member');
        }
        if (!in_array($this->getUser()->getProfile(),$group->getAdmin()->getValues())){
            return $this->json('you are no admin');

        }
        $group->removeAdmin($profile);
        $entityManager->persist($group);
        $entityManager->flush();
        return $this->json('member demote');
    }

    #[Route('/{id}', name: 'app_group_show', methods: ['GET'])]
    public function show(Group $group): Response
    {
        return $this->json($group,200,[],['groups'=>'group:read-all']);

    }

    #[Route('/{id}/edit', name: 'app_group_edit', methods: ['PATCH'])]
    public function edit(Request $request, Group $group,SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        if($this->getUser()->getProfile()=== $group->getAuthor()){
            $json = $request->getContent();
            $update = $serializer->deserialize($json,Group::class,'json');
            $group->setName($update->getName());
            $entityManager->persist($group);
            $entityManager->flush();
            return $this->json($group,200,[],['groups'=>'group:read-all']);
        }
        return $this->json('error');

    }
    #[Route('/{id}/delete', name: 'app_group_delete', methods: ['DELETE'])]
    public function delete(Group $group, EntityManagerInterface $entityManager): Response
    {
        {
            if ($group->getAuthor() ==$this->getUser()->getProfile()) {
                $entityManager->remove($group);
                $entityManager->flush();
            }
            return $this->json('group delete');
        }
    }
}
