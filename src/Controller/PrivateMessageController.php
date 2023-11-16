<?php

namespace App\Controller;

use App\Entity\PrivateMessage;
use App\Entity\Profile;
use App\Repository\PrivateMessageRepository;
use App\Repository\RelationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/message')]
class PrivateMessageController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_message_index', methods: ['GET'])]
    public function index(Profile $profile ,PrivateMessageRepository $privateMessageRepository): Response
    {
        $author=$this->getUser()->getProfile();

        $messages =$privateMessageRepository->findMessage($author,$profile);
        if ($messages){
            return $this->json($messages,200,[],['groups'=>'privateMessage:read-message']);

        }
        return $this->json("error",200);
    }
    #[Route('/{id}', name: 'app_message_show', methods: ['GET'])]
    public function show(PrivateMessage $privateMessage): Response
    {

        if ($privateMessage->getAuthor()==$this->getUser()->getProfile()){
            return $this->json($privateMessage,200,[],['groups'=>'privateMessage:read-message']);

        }
        return $this->json("t'es pas l'auteur ");

    }
    #[Route('/create/{id}', name: 'app_message_create', methods: ['POST'])]
    public function create(Profile $profile , Request $request,SerializerInterface $serializer ,EntityManagerInterface $entityManager,RelationRepository $relationRepository): Response
    {
        $realation=$relationRepository->relationCustom2($this->getUser()->getProfile()->getId());
        if (!$realation){
            return $this->json("vous etes pas ami",200);
        }
        $json = $request->getContent();
        $message = $serializer->deserialize($json,PrivateMessage::class,'json');
        if($message->getContent()==null){
            return $this->json("error",200);
        }
        $message->setAuthor($this->getUser()->getProfile());
        $message->setRalationId($realation[0]);
        $message->setRecipient($profile);
        $entityManager->persist($message);
        $entityManager->flush();

        return $this->json($message,200,[],['groups'=>'privateMessage:read-message']);
    }

    #[Route('/delete/{id}', name: 'app_message_delete', methods: ['DELETE'])]
    public function delete(PrivateMessage $privateMessage, EntityManagerInterface $entityManager): Response
    {

        if ($privateMessage->getAuthor()==$this->getUser()->getProfile()){

            $entityManager->remove($privateMessage);

            $entityManager->flush();

            return $this->json("message sup");

        }
        return $this->json("error");
    }

    #[Route('/update/{id}', name: 'app_message_update', methods: ['PATCH'])]
    public function update(PrivateMessage $privateMessage, EntityManagerInterface $entityManager, Request $request,SerializerInterface $serializer): Response
    {

        if ($privateMessage->getAuthor()==$this->getUser()->getProfile()){

            $json = $request->getContent();
            $message = $serializer->deserialize($json,PrivateMessage::class,'json');
            if($message->getContent()==null){
                return $this->json("error",200);
            }
            $privateMessage->setContent($message->getContent());
            $entityManager->persist($privateMessage);

            $entityManager->flush();

            return $this->json($privateMessage,200,[],['groups'=>'privateMessage:read-message']);

        }
        return $this->json("error");
    }
}
