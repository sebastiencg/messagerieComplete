<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Invitation;
use App\Entity\Profile;
use App\Repository\InvitationRepository;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api/invitation')]
class InvitationController extends AbstractController
{

    #[Route('/', name: 'app_invitation_index', methods: ['GET'])]
    public function index( ): Response
    {

        return $this->json($this->getUser()->getProfile()->getInvitationGroup()->getValues(),200,[],['groups'=>'invitation:read-all']);
    }

    #[Route('/create/group/{id}/', name: 'app_invitation_create', methods: ['POST'])]
    public function newNumber(Group $group,InvitationRepository $invitationRepository,Request $request,ProfileRepository $profileRepository, EntityManagerInterface $entityManager,SerializerInterface $serializer): Response
    {
        if (!$group){
            return $this->json('group no find');
        }

        if (!in_array($this->getUser()->getProfile(),$group->getAdmin()->getValues())){
            return $this->json('your are no admin');
        }
        $json = $request->getContent();
        $datas = json_decode($json, true);
        foreach ($datas as $data) {
            $profileId=$data["profile"];
            $profile=$profileRepository->findOneBy(["id"=>$profileId]);
            if(!$profile){
                return $this->json("error de ID");
            }
            $groupInvitations=$group->getInvitations()->getValues();
            foreach ($groupInvitations as  $groupInvitation){
                if ($groupInvitation->getProfile() === $profile){
                    return $this->json('invitation already exists');
                }
            }
            $invitation = new Invitation();
            $invitation->setProfile($profile);
            $invitation->setOfGroup($group);
            $invitation->setValidity(false);
            $entityManager->persist($invitation);

        }
        $entityManager->flush();
        return $this->json('invitation send ');
    }

    #[Route('/{id}/denied', name: 'app_invitation_denied', methods: ['DELETE'])]
    public function denied(Invitation $invitation,EntityManagerInterface $entityManager): Response
    {
        if (!$invitation){
            return $this->json('invitation no find ');

        }
        if ($invitation->getProfile()==$this->getUser()->getProfile()|| !$invitation->isValidity()){
            $entityManager->remove($invitation);
            $entityManager->flush();
            return $this->json('invitation denied ');

        }
        return $this->json('error ');

    }
    #[Route('/{id}/accepted', name: 'app_invitation_accepted', methods: ['GET'])]
    public function accepted(Invitation $invitation,EntityManagerInterface $entityManager): Response
    {
        if (!$invitation){
            return $this->json('invitation no find ');

        }
        if ($invitation->getProfile()==$this->getUser()->getProfile()|| !$invitation->isValidity()){
            $group=$invitation->getOfGroup();
            $group->addMember($this->getUser()->getProfile());
            $invitation->setValidity(true);
            $entityManager->persist($group);
            $entityManager->persist($invitation);
            $entityManager->flush();
            return $this->json('invitation accepted ');

        }
        return $this->json('error ');

    }

}

