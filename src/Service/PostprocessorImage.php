<?php

namespace App\Service;

use App\Entity\ConversationMessage;
use App\Entity\PrivateMessage;
use App\Entity\User;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\SecurityBundle\Security;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class PostprocessorImage
{
    private ImageRepository $imageRepository;
    private Security $security;
    private UploaderHelper $uploaderHelper;

    private CacheManager $cacheManager;


    public function __construct(ImageRepository $imageRepository,Security $security, UploaderHelper $uploaderHelper, CacheManager $cacheManager)
    {
        $this->imageRepository = $imageRepository;
        $this->security = $security;
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function findImageById(array $associatedImages )
    {
        $images=[];

        $profile=$this->security->getUser()->getProfile();
        foreach ($associatedImages as $imageId){
            $image= $this->imageRepository->findOneBy(["id"=>$imageId]);
            if ($image->getAuthor() !==$profile ){
                return $this->json("you are not author of image");
            }
            $images[] = $image;

        }
        return $images;

    }
    public function getImagesUrlFromPrivateMessage(PrivateMessage $privateMessage): PrivateMessage
    {

        $imageUrls = new ArrayCollection();


        foreach ($privateMessage->getImages() as $image) {
            $imageFind = $this->imageRepository->find($image);
            if ($imageFind){
                $newImageURL = ["id"=>$imageFind->getId(), "url"=>$this->cacheManager->getBrowserPath($this->uploaderHelper->asset($imageFind),"my_thumb")];
                $imageUrls->add($newImageURL);
            }
        }
        $privateMessage->setImagesUrls($imageUrls);

        return $privateMessage;
    }
    public function getImagesUrlFromConversationMessage(ConversationMessage $conversationMessage): ConversationMessage
    {

        $imageUrls = new ArrayCollection();


        foreach ($conversationMessage->getImages() as $image) {
            $imageFind = $this->imageRepository->find($image);
            if ($imageFind){
                $newImageURL = ["id"=>$imageFind->getId(), "url"=>$this->cacheManager->getBrowserPath($this->uploaderHelper->asset($imageFind),"my_thumb")];
                $imageUrls->add($newImageURL);
            }
        }
        $conversationMessage->setImagesUrls($imageUrls);

        return $conversationMessage;
    }

}