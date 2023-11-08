<?php

namespace App\Entity;

use App\Repository\RelationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RelationRepository::class)]
class Relation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['relation:read-one'])]

    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'relations')]
    #[Groups(['relation:read-one'])]

    private ?Profile $profile1 = null;

    #[ORM\ManyToOne(inversedBy: 'relations2')]
    #[Groups(['relation:read-one'])]
    private ?Profile $profile2 = null;

    #[ORM\Column]
    #[Groups(['relation:read-one'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(mappedBy: 'relation', cascade: ['persist', 'remove'])]
    #[Groups(['relation:read-one'])]
    private ?RequestRelation $requestRelation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile1(): ?Profile
    {
        return $this->profile1;
    }

    public function setProfile1(?Profile $profile1): static
    {
        $this->profile1 = $profile1;

        return $this;
    }

    public function getProfile2(): ?Profile
    {
        return $this->profile2;
    }

    public function setProfile2(?Profile $profile2): static
    {
        $this->profile2 = $profile2;

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

    public function getRequestRelation(): ?RequestRelation
    {
        return $this->requestRelation;
    }

    public function setRequestRelation(?RequestRelation $requestRelation): static
    {
        // unset the owning side of the relation if necessary
        if ($requestRelation === null && $this->requestRelation !== null) {
            $this->requestRelation->setRelation(null);
        }

        // set the owning side of the relation if necessary
        if ($requestRelation !== null && $requestRelation->getRelation() !== $this) {
            $requestRelation->setRelation($this);
        }

        $this->requestRelation = $requestRelation;

        return $this;
    }
}
