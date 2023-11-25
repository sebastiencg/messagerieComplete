<?php

namespace App\Controller;

use App\Entity\Community;
use App\Entity\MessageCommunity;
use App\Repository\MessageCommunityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/community')]

class MessageCommunityController extends AbstractController
{
    #[Route('/{id}/messages', name: 'app_community_message_index', methods: ['GET'])]
    public function indexMessage(Community $community): Response
    {
        if (in_array($this->getUser()->getProfile(),$community->getMember()->getValues() )) {
            return $this->json($community->getMessageCommunities(),200,[],['groups'=>'communityMessage:read-message']);
        }
        return $this->json('error tu ne fais pas parti du groupe ');
    }

    #[Route('/{communityId}/message/{messageId}/delete', name: 'app_community_message_delete', methods: ['DELETE'])]
    public function deleteMessage(
        #[MapEntity(id: 'communityId')] Community $community,
        #[MapEntity(id: 'messageId')] MessageCommunity $messageCommunity,
        Request $request, EntityManagerInterface $entityManager): Response{

        if(!in_array($messageCommunity,$community->getMessageCommunities()->getValues())){
            return $this->json("error of group");
        }
        if ($messageCommunity->getAuthor()!==$this->getUser()->getProfile()){
            return $this->json("error vous etes pas l'auteur du message".$messageCommunity->getId());
        }
        $entityManager->remove($messageCommunity);
        $entityManager->flush();
        return $this->json('message delete ');
    }


    #[Route('/{id}/message/create', name: 'app_community_createMessage', methods: ['POST'])]
    public function createMessage(Community $community,Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        if (!in_array($this->getUser()->getProfile(), $community->getMember()->getValues())) {
            return $this->json("you are not a member of the community",200);
        }

        $json = $request->getContent();
        $message = $serializer->deserialize($json,MessageCommunity::class,'json');

        if($message->getContent()==null){
            return $this->json("error content can't be null",200);
        }
        $message->setAuthor($this->getUser()->getProfile());
        $message->setCommunity($community);
        $entityManager->persist($message);
        $entityManager->flush();
        return $this->json($message,200,[],['groups'=>'communityMessage:read-message']);

    }
    #[Route('/{id}/message/update', name: 'app_community_updateMessage', methods: ['PATCH'])]
    public function updateMessage(Community $community,Request $request , EntityManagerInterface $entityManager, MessageCommunityRepository $messageCommunityRepository): Response
    {

        $json = $request->getContent();
        $data = json_decode($json, true);
        if($data["content"]==null || $data["id"]<=0 ){
            return $this->json("error content or id",200);
        }
        $message=$messageCommunityRepository->findOneBy(["id"=>$data["id"]]);

        if(!$message || $message->getAuthor()!== $this->getUser()->getProfile()){
            return $this->json("error message no find or bad author",200);
        }
        if (!in_array($this->getUser()->getProfile(), $community->getMember()->getValues())) {
            return $this->json("error author no find in group",200);
        }
        $message->setContent($data["content"]);
        $entityManager->persist($message);
        $entityManager->flush();
        return $this->json($message,200,[],['groups'=>'communityMessage:read-message']);

    }

}
