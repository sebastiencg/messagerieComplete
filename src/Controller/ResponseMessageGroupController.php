<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\GroupMessage;
use App\Entity\ResponseMessageGroup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('api/group/{groupId}/message/{messageId}')]
class ResponseMessageGroupController extends AbstractController
{
    #[Route('/', name: 'app_group_index_Response', methods: ['GET'])]
    public function indexResponse(
        #[MapEntity(id: 'groupId')] Group $group,
        #[MapEntity(id: 'messageId')] GroupMessage $groupMessage
    ): Response{

        if (!in_array($this->getUser()->getProfile(),$group->getMember()->getValues())) {
            return $this->json('you are not a member of the group ',403);
        }


        return $this->json($groupMessage,200,[],['groups'=>'responseMessage:all-response']);

    }
    #[Route('/response/create', name: 'app_group_createResponse', methods: ['POST'])]
    public function createResponse(
        #[MapEntity(id: 'groupId')] Group $group,
        #[MapEntity(id: 'messageId')] GroupMessage $groupMessage,
        Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response{

        if (!in_array($this->getUser()->getProfile(),$group->getMember()->getValues())) {
            return $this->json('you are not a member of the group ',403);
        }

        $json = $request->getContent();
        $responseMessage = $serializer->deserialize($json,ResponseMessageGroup::class,'json');

        if($responseMessage->getContent()==null){
            return $this->json("content can't be null",406);
        }
        $responseMessage->setAuthor($this->getUser()->getProfile());
        $responseMessage->setOfGroupMessage($groupMessage);
        $entityManager->persist($responseMessage);
        $entityManager->flush();
        return $this->json($responseMessage,200,[],['groups'=>'responseMessage:read-response']);

    }

    #[Route('/response/{responseId}/update', name: 'app_group_updateResponse', methods: ['POST'])]
    public function updateResponse(
        #[MapEntity(id: 'groupId')] Group $group,
        #[MapEntity(id: 'messageId')] GroupMessage $groupMessage,
        #[MapEntity(id: 'responseId')] ResponseMessageGroup $responseMessageGroup,

        Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response{


        $json = $request->getContent();
        $responseMessageUpdate = $serializer->deserialize($json,ResponseMessageGroup::class,'json');

        if( $responseMessageGroup->getAuthor()!== $this->getUser()->getProfile()){
            return $this->json("error response no find or bad author",200);
        }
        $responseMessageGroup->setContent($responseMessageUpdate->getContent());

        $entityManager->persist($responseMessageGroup);
        $entityManager->flush();
        return $this->json($responseMessageGroup,200,[],['groups'=>'responseMessage:read-response']);


    }

    #[Route('/response/{responseId}/delete', name: 'app_group_deleteResponse', methods: ['DELETE'])]
    public function deleteResponse(
        #[MapEntity(id: 'groupId')] Group $group,
        #[MapEntity(id: 'messageId')] GroupMessage $groupMessage,
        #[MapEntity(id: 'responseId')] ResponseMessageGroup $responseMessageGroup, EntityManagerInterface $entityManager): Response{

        if ($responseMessageGroup->getAuthor()!== $this->getUser()->getProfile()) {
            return $this->json('you are not a author of the response ',403);
        }
        $entityManager->remove($responseMessageGroup);
        $entityManager->flush();
        return $this->json('response delete ',403);

    }
}
