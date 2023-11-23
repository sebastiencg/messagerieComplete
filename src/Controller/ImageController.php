<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Liip\ImagineBundle\LiipImagineBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/api')]
class ImageController extends AbstractController
{
    #[Route('/image/upload', name: 'app_image' ,methods: ['POST'])]
    public function imageFriend(UploaderHelper $helper,Request $request, EntityManagerInterface $manager ):Response
    {

        $image = new Image();
        $file = $request->files->get('image');
        $image->setImageFile($file);
        $image->setAuthor($this->getUser()->getProfile());
        $manager->persist($image);
        $manager->flush();
        $response = [
            "message" => "bravo pour ton upload tu peux maintenant ajouter ton message",
            "idImage" => $image->getId(),
            //"url" => "https://messagerie.api.miantsebastien.com/" . $helper->asset($image)
        ];
        return $this->json($response, 200);
    }
}
