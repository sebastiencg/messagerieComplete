<?php

namespace App\Entity;

use App\Repository\PrivateMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: PrivateMessageRepository::class)]
class PrivateMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['privateMessage:read-message'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['privateMessage:read-message'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'privateMessagesSend')]
    #[Groups(['privateMessage:read-message'])]
    private ?Profile $author = null;

    #[ORM\ManyToOne(inversedBy: 'privateMessagesReceived')]
    #[Groups(['privateMessage:read-message'])]
    private ?Profile $recipient = null;

    #[ORM\ManyToOne(inversedBy: 'privateMessages')]
    private ?Relation $ralationId = null;

    //#[ORM\Column(type: Types::TEXT)]
    private ?array $associatedImages = null;

    #[SerializedName(serializedName: 'images')]
    #[Groups(['privateMessage:read-message'])]
    private ArrayCollection $imagesUrls;
    //['id'=>imageId,
    //'url'=>urlthum_name
    //]
    #
    #[ORM\OneToMany(mappedBy: 'privateMessage', targetEntity: Image::class)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?Profile
    {
        return $this->author;
    }

    public function setAuthor(?Profile $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getRecipient(): ?Profile
    {
        return $this->recipient;
    }

    public function setRecipient(?Profile $recipient): static
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getRalationId(): ?Relation
    {
        return $this->ralationId;
    }

    public function setRalationId(?Relation $ralationId): static
    {
        $this->ralationId = $ralationId;

        return $this;
    }
    public function getAssociatedImages(): ?array
    {
        return $this->associatedImages;
    }

    public function setAssociatedImages(?array $image): static
    {
        $this->associatedImages = $image;

        return $this;
    }
    public function getImagesUrls(): ArrayCollection
    {
        return $this->imagesUrls;
    }

    public function setImagesUrls($image): static
    {
        $this->imagesUrls = $image;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $privateMessageImage): static
    {
        if (!$this->images->contains($privateMessageImage)) {
            $this->images->add($privateMessageImage);
            $privateMessageImage->setPrivateMessage($this);
        }

        return $this;
    }

    public function removeImage(Image $privateMessageImage): static
    {
        if ($this->images->removeElement($privateMessageImage)) {
            // set the owning side to null (unless already changed)
            if ($privateMessageImage->getPrivateMessage() === $this) {
                $privateMessageImage->setPrivateMessage(null);
            }
        }

        return $this;
    }
}
