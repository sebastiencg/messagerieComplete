<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class
Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['relation:read-one'])]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]

    private ?User $ofUser = null;

    #[ORM\Column(length: 255)]
    #[Groups(['relation:read-one'])]

    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: RequestRelation::class)]
    private Collection $requestRelations;

    #[ORM\OneToMany(mappedBy: 'profile1', targetEntity: Relation::class)]
    private Collection $relations;

    #[ORM\OneToMany(mappedBy: 'profile2', targetEntity: Relation::class)]
    private Collection $relations2;

    #[ORM\Column]
    private ?bool $visibility = null;

    public function __construct()
    {
        $this->requestRelations = new ArrayCollection();
        $this->relations = new ArrayCollection();
        $this->relations2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfUser(): ?User
    {
        return $this->ofUser;
    }

    public function setOfUser(User $ofUser): static
    {
        $this->ofUser = $ofUser;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, RequestRelation>
     */
    public function getRequestRelations(): Collection
    {
        return $this->requestRelations;
    }

    public function addRequestRelation(RequestRelation $requestRelation): static
    {
        if (!$this->requestRelations->contains($requestRelation)) {
            $this->requestRelations->add($requestRelation);
            $requestRelation->setHost($this);
        }

        return $this;
    }

    public function removeRequestRelation(RequestRelation $requestRelation): static
    {
        if ($this->requestRelations->removeElement($requestRelation)) {
            // set the owning side to null (unless already changed)
            if ($requestRelation->getHost() === $this) {
                $requestRelation->setHost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Relation>
     */
    public function getRelations(): Collection
    {
        return $this->relations;
    }

    public function addRelation(Relation $relation): static
    {
        if (!$this->relations->contains($relation)) {
            $this->relations->add($relation);
            $relation->setProfile1($this);
        }

        return $this;
    }

    public function removeRelation(Relation $relation): static
    {
        if ($this->relations->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getProfile1() === $this) {
                $relation->setProfile1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Relation>
     */
    public function getRelations2(): Collection
    {
        return $this->relations2;
    }

    public function addRelations2(Relation $relations2): static
    {
        if (!$this->relations2->contains($relations2)) {
            $this->relations2->add($relations2);
            $relations2->setProfile2($this);
        }

        return $this;
    }

    public function removeRelations2(Relation $relations2): static
    {
        if ($this->relations2->removeElement($relations2)) {
            // set the owning side to null (unless already changed)
            if ($relations2->getProfile2() === $this) {
                $relations2->setProfile2(null);
            }
        }

        return $this;
    }

    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }
}
