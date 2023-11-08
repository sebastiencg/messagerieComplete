<?php

namespace App\Entity;

use App\Repository\RequestRelationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RequestRelationRepository::class)]
class RequestRelation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['relation:read-one'])]

    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'requestRelations')]
    #[Groups(['relation:read-one'])]

    private ?Profile $host = null;

    #[ORM\ManyToOne(inversedBy: 'requestRelations')]
    #[Groups(['relation:read-one'])]

    private ?Profile $guests = null;

    #[ORM\Column(length: 10)]
    #[Groups(['relation:read-one'])]

    private ?string $statue = null;

    #[ORM\OneToOne(inversedBy: 'requestRelation', cascade: ['persist', 'remove'])]
    #[Groups(['relation:read-one'])]
    private ?Relation $relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHost(): ?Profile
    {
        return $this->host;
    }

    public function setHost(?Profile $host): static
    {
        $this->host = $host;

        return $this;
    }

    public function getGuests(): ?Profile
    {
        return $this->guests;
    }

    public function setGuests(?Profile $guests): static
    {
        $this->guests = $guests;

        return $this;
    }

    public function getStatue(): ?string
    {
        return $this->statue;
    }

    public function setStatue(string $statue): static
    {
        $this->statue = $statue;

        return $this;
    }

    public function getRelation(): ?Relation
    {
        return $this->relation;
    }

    public function setRelation(?Relation $relation): static
    {
        $this->relation = $relation;

        return $this;
    }
}
