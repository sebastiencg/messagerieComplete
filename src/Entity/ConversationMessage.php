<?php

namespace App\Entity;

use App\Repository\ConversationMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: ConversationMessageRepository::class)]
class ConversationMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['privateMessage:read-message'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['privateMessage:read-message'])]

    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'conversationMessages')]
    private ?Conversation $conversation = null;

    #[ORM\ManyToOne(inversedBy: 'conversationMessages')]
    #[Groups(['privateMessage:read-message'])]

    private ?Profile $author = null;

    private ?array $associatedImages = null;

    #[SerializedName(serializedName: 'images')]
    #[Groups(['privateMessage:read-message'])]
    private ArrayCollection $imagesUrls;

    #[ORM\OneToMany(mappedBy: 'conversationMessage', targetEntity: Image::class)]

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

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): static
    {
        $this->conversation = $conversation;

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

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setConversationMessage($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getConversationMessage() === $this) {
                $image->setConversationMessage(null);
            }
        }

        return $this;
    }

}
