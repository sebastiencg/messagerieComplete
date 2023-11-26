<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\Relation;
use App\Entity\RequestRelation;
use App\Repository\ProfileRepository;
use App\Repository\RelationRepository;
use App\Repository\RequestRelationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/relation')]
class RelationController extends AbstractController
{
    #[Route('/', name: 'app_relation_index', methods: ['GET'])]
    public function index(RelationRepository $relationRepository,): Response
    {
        return $this->json($relationRepository->relationCustom2($this->getUser()->getProfile()->getId()),200,[],['groups'=>'relation:read-onlyRelation']);
    }
    #[Route('/new/{id}', name: 'app_relation_new', methods: ['GET', 'POST'])]
    public function new(Request $request,Profile $profile ,EntityManagerInterface $entityManager, RequestRelationRepository $requestRelationRepository): Response
    {
        $data=$requestRelationRepository->requestRelationCustom1($this->getUser()->getProfile()->getId(),$profile->getId());
        if ($data){
            if($data[0]->getStatue()=="on hold"){
                return $this->json('demande deja fait mais  pas encore validé');
            }
            if($data[0]->getStatue()=="refuse"){
                $requestRelation=$data[0];
                $requestRelation->setStatue("on hold");
                $entityManager->persist($requestRelation);
                $entityManager->flush();
                return $this->json('demande renvoyé');
            }
            if($data[0]->getStatue()=="accept"){
                return $this->json('vous etes deja amis');
            }
        }
        $requestRelation = new RequestRelation();
        $requestRelation->setHost($this->getUser()->getProfile());
        $requestRelation->setGuests($profile);
        $requestRelation->setStatue("on hold");
        $entityManager->persist($requestRelation);
        $entityManager->flush();
        return $this->json('demande d\' ami faite');
    }

    #[Route('/requestReceived/', name: 'app_friend_requestReceived', methods: ['GET'])]
    public function requestReceived(RequestRelationRepository $requestRelationRepository): Response
    {
        return $this->json($requestRelationRepository->findBy(["guests"=>$this->getUser()->getProfile()]),200,[],['groups'=>'relation:read-one']);
    }
    #[Route('/requestSend/', name: 'app_friend_requestSend', methods: ['GET'])]
    public function requestSend(RequestRelationRepository $requestRelationRepository): Response
    {
        return $this->json($requestRelationRepository->findBy(["host"=>$this->getUser()->getProfile()]),200,[],['groups'=>'relation:read-one']);
    }

    #[Route('/request/valid/{id}', name: 'app_friend_request_valid', methods: ['GET'])]
    public function requestValid(Profile $profile,RequestRelationRepository $requestRelationRepository, EntityManagerInterface $entityManager): Response
    {
        $requestRelation=$requestRelationRepository->findOneBy(['host'=>$profile,'guests'=>$this->getUser()->getProfile()]);
        if (!$requestRelation){
            return $this->json("error",200);
        }
        if ($requestRelation->getStatue()=="on hold"){
            $requestRelation->setStatue("accept");
            $relation = new Relation();
            $relation->setProfile1($this->getUser()->getProfile());
            $relation->setProfile2($profile);
            $relation->setCreatedAt(new \DateTimeImmutable());
            $relation->setRequestRelation($requestRelation);
            $entityManager->persist($requestRelation);
            $entityManager->persist($relation);
            $entityManager->flush();

            return $this->json("demande accepté");

        }
        if ($requestRelation->getStatue()=="accept"){
            return $this->json("demande deja accepté");

        }
        if ($requestRelation->getStatue()=="refuse"){
            return $this->json("demande deja refuser");

        }

        return $this->json("error",200);
    }

    #[Route('/request/refuse/{id}', name: 'app_friend_request_refuse', methods: ['GET'])]
    public function requestRefuse(Profile $profile,RequestRelationRepository $requestRelationRepository, EntityManagerInterface $entityManager): Response
    {
        $requestRelation=$requestRelationRepository->findOneBy(['host'=>$profile,'guests'=>$this->getUser()->getProfile()]);

        if ($requestRelation->getStatue()=="on hold"){
            $requestRelation->setStatue("refuse");
            $entityManager->persist($requestRelation);
            $entityManager->flush();

            return $this->json("demande refusé");

        }
        if ($requestRelation->getStatue()=="accept"){
            return $this->json("demande deja accepté");

        }
        if ($requestRelation->getStatue()=="refuse"){
            return $this->json("demande deja refuser");

        }

        return $this->json("error",200);
    }

    #[Route('/denied/{id}', name: 'app_relation_denied', methods: ['DELETE'])]
    public function relationDenied(Profile $profile,RelationRepository $relationRepository, EntityManagerInterface $entityManager): Response
    {
        $relation=$relationRepository->relationCustom1($this->getUser()->getProfile()->getId(),$profile);
        if ($relation){
            $relation=$relation[0];
            $requestRelation=$relation->getRequestRelation();
            $entityManager->remove($requestRelation);
            $entityManager->remove($relation);

            $entityManager->flush();

            return $this->json("amie sup");

    }
        return $this->json("error");
    }
}
