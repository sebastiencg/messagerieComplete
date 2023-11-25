<?php

namespace App\Entity;

use App\Repository\GroupMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: GroupMessageRepository::class)]
class GroupMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['GroupMessage:read-message','responseMessage:read-response','responseMessage:all-response'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['GroupMessage:read-message','responseMessage:read-response','responseMessage:all-response'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'groupMessages')]
    #[Groups(['GroupMessage:read-message'])]

    private ?Profile $author = null;

    #[ORM\ManyToOne(inversedBy: 'groupMessages')]
    #[Groups(['GroupMessage:read-message'])]

    private ?Group $ofGroup = null;

    #[ORM\Column]
    #[Groups(['GroupMessage:read-message'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'ofGroupMessage', targetEntity: ResponseMessageGroup::class ,orphanRemoval: true)]
    #[Groups(['GroupMessage:read-message','responseMessage:all-response'])]
    private Collection $responseMessageGroups;

    #[ORM\OneToMany(mappedBy: 'groupMessage', targetEntity: Image::class)]
    private Collection $images;
    private ?array $associatedImages = null;

    #[SerializedName(serializedName: 'images')]
    #[Groups(['privateMessage:read-message'])]
    private ArrayCollection $imagesUrls;

    public function __construct()
    {
        $this->responseMessageGroups = new ArrayCollection();
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

    public function getOfGroup(): ?Group
    {
        return $this->ofGroup;
    }

    public function setOfGroup(?Group $ofGroup): static
    {
        $this->ofGroup = $ofGroup;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, ResponseMessageGroup>
     */
    public function getResponseMessageGroups(): Collection
    {
        return $this->responseMessageGroups;
    }

    public function addResponseMessageGroup(ResponseMessageGroup $responseMessageGroup): static
    {
        if (!$this->responseMessageGroups->contains($responseMessageGroup)) {
            $this->responseMessageGroups->add($responseMessageGroup);
            $responseMessageGroup->setOfGroupMessage($this);
        }

        return $this;
    }

    public function removeResponseMessageGroup(ResponseMessageGroup $responseMessageGroup): static
    {
        if ($this->responseMessageGroups->removeElement($responseMessageGroup)) {
            // set the owning side to null (unless already changed)
            if ($responseMessageGroup->getOfGroupMessage() === $this) {
                $responseMessageGroup->setOfGroupMessage(null);
            }
        }

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
            $image->setGroupMessage($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getGroupMessage() === $this) {
                $image->setGroupMessage(null);
            }
        }

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
}
