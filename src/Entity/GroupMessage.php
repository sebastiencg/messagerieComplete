<?php

namespace App\Entity;

use App\Repository\GroupMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GroupMessageRepository::class)]
class GroupMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['GroupMessage:read-message'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['GroupMessage:read-message'])]
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

    #[ORM\OneToMany(mappedBy: 'ofGroupMessage', targetEntity: ResponseMessageGroup::class)]
    #[Groups(['GroupMessage:read-message'])]
    private Collection $responseMessageGroups;

    public function __construct()
    {
        $this->responseMessageGroups = new ArrayCollection();
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
}
