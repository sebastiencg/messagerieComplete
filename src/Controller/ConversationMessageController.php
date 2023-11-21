<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\ConversationMessage;
use App\Entity\Profile;
use App\Repository\ConversationMessageRepository;
use App\Repository\ProfileRepository;
use App\Repository\RelationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api/conversation')]
class ConversationMessageController extends AbstractController
{
    #[Route('/create', name: 'app_conversation_create',methods: ['GET'])]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $conversation= new Conversation();
        $conversation->setAuthor($this->getUser()->getProfile());
        $conversation->addProfile($this->getUser()->getProfile());
        $entityManager->persist($conversation);
        $entityManager->flush();
        return $this->json($conversation,200,[],['groups'=>'privateMessage:read-message']);
    }
    #[Route('/delete/{id}', name: 'app_conversation_delete',methods: ['DELETE'])]
    public function delete(Conversation $conversation,EntityManagerInterface $entityManager): Response
    {
        if ($conversation->getAuthor()!==$this->getUser()->getProfile()){
            return $this->json("error vous etes pas  author");
        }

        $entityManager->remove($conversation);
        $entityManager->flush();
        return $this->json("conversation delete");
    }
    #[Route('/{id}/messages', name: 'app_conversation_message_index', methods: ['GET'])]
    public function indexMessage(Conversation $conversation,): Response
    {
        if (in_array($this->getUser()->getProfile(), $conversation->getProfile()->getValues())) {
            return $this->json($conversation->getConversationMessages()->getValues(),200,[],['groups'=>'privateMessage:read-message']);
        }
        return $this->json('error tu ne fais pas parti du groupe ');
    }

    #[Route('/{id}/message/delete', name: 'app_conversation_message_delete', methods: ['DELETE'])]
    public function deleteMessage(Conversation $conversation,Request $request, ConversationMessageRepository $messageRepository, EntityManagerInterface $entityManager): Response
    {
        $json = $request->getContent();
        $datas = json_decode($json, true);
        foreach ($datas as $data) {
            $messageId=$data["message"];
            $message=$messageRepository->findOneBy(["id"=>$messageId]);
            if(!$message){
                return $this->json("error de ID");
            }
            if(!in_array($message,$conversation->getConversationMessages()->getValues())){
                return $this->json("error de conversation");
            }
            if ($message->getAuthor()!==$this->getUser()->getProfile()){
                return $this->json("error vous etes pas l'auteur du message".$message->getId());
            }
            $entityManager->remove($message);
        }
        $entityManager->flush();
        return $this->json('message delete ');
    }
    #[Route('/{id}/message/create', name: 'app_conversation_createMessage', methods: ['POST'])]
    public function createMessage(Conversation $conversation,Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        if (!in_array($this->getUser()->getProfile(), $conversation->getProfile()->getValues())) {
            return $this->json($conversation->getConversationMessages()->getValues(),200,[],['groups'=>'privateMessage:read-message']);
        }

        $json = $request->getContent();
        $message = $serializer->deserialize($json,ConversationMessage::class,'json');

        if($message->getContent()==null){
            return $this->json("error",200);
        }
        $message->setAuthor($this->getUser()->getProfile());
        $message->setConversation($conversation);
        $entityManager->persist($message);
        $entityManager->flush();
        return $this->json($message,200,[],['groups'=>'privateMessage:read-message']);

    }
    #[Route('/{id}/message/update', name: 'app_conversation_updateMessage', methods: ['PATCH'])]
    public function updateMessage(Conversation $conversation,Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ConversationMessageRepository $conversationMessageRepository): Response
    {

        $json = $request->getContent();
        $data = json_decode($json, true);
        if($data["content"]==null || $data["id"]<=0 ){
            return $this->json("error content or id",200);
        }
        $message=$conversationMessageRepository->findOneBy(["id"=>$data["id"]]);

        if(!$message || $message->getAuthor()!== $this->getUser()->getProfile()){
            return $this->json("error message no find or bad author",200);
        }
        if (!in_array($this->getUser()->getProfile(), $conversation->getProfile()->getValues())) {
            return $this->json("error author no find in conversation",200);
        }
        $message->setContent($data["content"]);
        $entityManager->persist($message);
        $entityManager->flush();
        return $this->json($message,200,[],['groups'=>'privateMessage:read-message']);

    }
    #[Route('/{id}', name: 'app_conversation_index', methods: ['GET'])]
    public function index(Conversation $conversation,): Response
    {
        if (in_array($this->getUser()->getProfile(), $conversation->getProfile()->getValues())) {
            return $this->json($conversation,200,[],['groups'=>'privateMessage:read-message']);
        }
        return $this->json('error tu ne fais pas parti du groupe ');
    }
    #[Route('/{id}/add', name: 'app_conversation_add', methods: ['POST'])]
    public function addProfile(Conversation $conversation,RelationRepository $relationRepository,Request $request ,ProfileRepository $profileRepository ,EntityManagerInterface $entityManager): Response
    {
        if ($conversation->getAuthor()!==$this->getUser()->getProfile()){
            return $this->json("error vous etes pas  author");
        }
        $json = $request->getContent();
        $datas = json_decode($json, true);
        foreach ($datas as $data) {
            $profileId=$data["profile"];
            $profile=$profileRepository->findOneBy(["id"=>$profileId]);
            if(!$profile){
                return $this->json("error de ID");
            }
            if (!$relationRepository->relationCustom1($profile,$this->getUser()->getProfile())){
                return $this->json("error vous etes pas amis avec " . $profile->getUsername().$profile->getId());
            }
            $conversation->addProfile($profile);
        }
        $entityManager->persist($conversation);
        $entityManager->flush();
        return $this->json($conversation,200,[],['groups'=>'conversation:read-conversation']);
    }
    #[Route('/{id}/remove', name: 'app_conversation_remove', methods: ['DELETE'])]
    public function removeProfile(Conversation $conversation,RelationRepository $relationRepository,Request $request ,ProfileRepository $profileRepository ,EntityManagerInterface $entityManager): Response
    {
        if ($conversation->getAuthor()!==$this->getUser()->getProfile()){
            return $this->json("error vous etes pas  author");
        }
        $json = $request->getContent();
        $datas = json_decode($json, true);
        foreach ($datas as $data) {
            $profileId=$data["profile"];
            $profile=$profileRepository->findOneBy(["id"=>$profileId]);
            if(!$profile){
                return $this->json("error de ID");
            }

            $conversation->removeProfile($profile);
        }
        $entityManager->persist($conversation);
        $entityManager->flush();
        return $this->json($conversation,200,[],['groups'=>'conversation:read-conversation']);
    }



}
