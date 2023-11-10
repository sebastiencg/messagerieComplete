<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Repository\GroupeRepository;
use App\Repository\RelationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api/groupe')]
class GroupeController extends AbstractController
{
    #[Route('/', name: 'app_groupe', methods: ["GET"])]
    public function index(GroupeRepository $groupeRepository): Response
    {
        return $this->json($groupeRepository->findBy(["visibility"=>true]),200,[],['groups'=>'groupe:read-onlyGroupe']);

    }
    #[Route('/searchGroupe/', name: 'app_groupe_searchGroupe', methods: ['POST'])]
    public function searchGroupe(Request $request ,SerializerInterface $serializer,GroupeRepository $groupeRepository): Response
    {
        $json = $request->getContent();
        $groupe = $serializer->deserialize($json,Groupe::class,'json');

        return $this->json($groupeRepository->findBy(["name"=>$groupe->getUsername(),"visibility"=>true]),200,[],['groups'=>'groupe:read-onlyGroupe']);
    }

    #[Route('/new/', name: 'app_groupe_new', methods: ['POST'])]
    public function new(Request $request ,EntityManagerInterface $entityManager,SerializerInterface $serializer): Response
    {

        $json = $request->getContent();
        $groupe = $serializer->deserialize($json,Groupe::class,'json');
        if ($groupe->getName()==null){
            return $this->json('error de data');
        }

        $groupe->setMaster($this->getUser()->getProfile());
        $groupe->setVisibility(false);
        $entityManager->persist($groupe);
        $entityManager->flush();
        return $this->json('groupe ajouté');
    }

}
