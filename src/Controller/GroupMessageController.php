<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\GroupMessage;
use App\Repository\GroupMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/group')]
class GroupMessageController extends AbstractController
{
    #[Route('/{id}/messages', name: 'app_conversation_message_index', methods: ['GET'])]
    public function indexMessage(Group $group): Response
    {
        if (in_array($this->getUser()->getProfile(),$group->getMember()->getValues() )) {
            return $this->json($group->getGroupMessages()->getValues(),200,[],['groups'=>'GroupMessage:read-message']);
        }
        return $this->json('error tu ne fais pas parti du groupe ');
    }

    #[Route('/{id}/message/delete', name: 'app_conversation_message_delete', methods: ['DELETE'])]
    public function deleteMessage(Group $group,Request $request, GroupMessageRepository $groupMessageRepository, EntityManagerInterface $entityManager): Response
    {
        $json = $request->getContent();
        $datas = json_decode($json, true);
        foreach ($datas as $data) {
            $messageId=$data["message"];
            $message=$groupMessageRepository->findOneBy(["id"=>$messageId]);
            if(!$message){
                return $this->json("error de ID");
            }
            if(!in_array($message,$group->getGroupMessages()->getValues())){
                return $this->json("error of group");
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
    public function createMessage(Group $group,Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
    {
        if (!in_array($this->getUser()->getProfile(), $group->getMember()->getValues())) {
            return $this->json("you are not a member of the group",200);
        }

        $json = $request->getContent();
        $message = $serializer->deserialize($json,GroupMessage::class,'json');

        if($message->getContent()==null){
            return $this->json("error",200);
        }
        $message->setAuthor($this->getUser()->getProfile());
        $message->setOfGroup($group);
        $message->setCreatedAt( new \DateTimeImmutable());
        $entityManager->persist($message);
        $entityManager->flush();
        return $this->json($message,200,[],['groups'=>'GroupMessage:read-message']);

    }
    #[Route('/{id}/message/update', name: 'app_conversation_updateMessage', methods: ['PATCH'])]
    public function updateMessage(Group $group,Request $request , EntityManagerInterface $entityManager, GroupMessageRepository $groupMessageRepository): Response
    {

        $json = $request->getContent();
        $data = json_decode($json, true);
        if($data["content"]==null || $data["id"]<=0 ){
            return $this->json("error content or id",200);
        }
        $message=$groupMessageRepository->findOneBy(["id"=>$data["id"]]);

        if(!$message || $message->getAuthor()!== $this->getUser()->getProfile()){
            return $this->json("error message no find or bad author",200);
        }
        if (!in_array($this->getUser()->getProfile(), $group->getMember()->getValues())) {
            return $this->json("error author no find in group",200);
        }
        $message->setContent($data["content"]);
        $entityManager->persist($message);
        $entityManager->flush();
        return $this->json($message,200,[],['groups'=>'GroupMessage:read-message']);

    }

}
