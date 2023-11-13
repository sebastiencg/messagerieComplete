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
    #[Groups(['relation:read-one','profile:read-one','profile:read-all','relation:read-onlyRelation','groups'=>'groupe:read-onlyGroupe','privateMessage:read-message'])]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]

    private ?User $ofUser = null;

    #[ORM\Column(length: 255)]
    #[Groups(['relation:read-one','profile:read-one','profile:read-all','relation:read-onlyRelation','groups'=>'groupe:read-onlyGroupe','privateMessage:read-message'])]

    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: RequestRelation::class)]
    #[Groups(['profile:read-all'])]
    private Collection $requestRelations;

    #[ORM\OneToMany(mappedBy: 'profile1', targetEntity: Relation::class)]
    #[Groups(['profile:read-all'])]
    private Collection $relationSend;

    #[ORM\OneToMany(mappedBy: 'profile2', targetEntity: Relation::class)]
    #[Groups(['profile:read-all'])]
    private Collection $relationRequest;

    #[ORM\Column]
    #[Groups(['profile:read-all'])]
    private ?bool $visibility = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: PrivateMessage::class)]
    private Collection $privateMessagesSend;

    #[ORM\OneToMany(mappedBy: 'recipient', targetEntity: PrivateMessage::class)]
    private Collection $privateMessagesReceived;





    public function __construct()
    {
        $this->requestRelations = new ArrayCollection();
        $this->relationSend = new ArrayCollection();
        $this->relationRequest = new ArrayCollection();
        $this->privateMessagesSend = new ArrayCollection();
        $this->privateMessagesReceived = new ArrayCollection();


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
    public function getRelationSend(): Collection
    {
        return $this->relationSend;
    }

    public function addRelation(Relation $relation): static
    {
        if (!$this->relationSend->contains($relation)) {
            $this->relationSend->add($relation);
            $relation->setProfile1($this);
        }

        return $this;
    }

    public function removeRelation(Relation $relation): static
    {
        if ($this->relationSend->removeElement($relation)) {
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
    public function getRelationRequest(): Collection
    {
        return $this->relationRequest;
    }

    public function addRelations2(Relation $relations2): static
    {
        if (!$this->relationRequest->contains($relations2)) {
            $this->relationRequest->add($relations2);
            $relations2->setProfile2($this);
        }

        return $this;
    }

    public function removeRelations2(Relation $relations2): static
    {
        if ($this->relationRequest->removeElement($relations2)) {
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

    /**
     * @return Collection<int, PrivateMessage>
     */
    public function getPrivateMessagesSend(): Collection
    {
        return $this->privateMessagesSend;
    }

    public function addPrivateMessagesSend(PrivateMessage $privateMessagesSend): static
    {
        if (!$this->privateMessagesSend->contains($privateMessagesSend)) {
            $this->privateMessagesSend->add($privateMessagesSend);
            $privateMessagesSend->setAuthor($this);
        }

        return $this;
    }

    public function removePrivateMessagesSend(PrivateMessage $privateMessagesSend): static
    {
        if ($this->privateMessagesSend->removeElement($privateMessagesSend)) {
            // set the owning side to null (unless already changed)
            if ($privateMessagesSend->getAuthor() === $this) {
                $privateMessagesSend->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PrivateMessage>
     */
    public function getPrivateMessagesReceived(): Collection
    {
        return $this->privateMessagesReceived;
    }

    public function addPrivateMessagesReceived(PrivateMessage $privateMessagesReceived): static
    {
        if (!$this->privateMessagesReceived->contains($privateMessagesReceived)) {
            $this->privateMessagesReceived->add($privateMessagesReceived);
            $privateMessagesReceived->setRecipient($this);
        }

        return $this;
    }

    public function removePrivateMessagesReceived(PrivateMessage $privateMessagesReceived): static
    {
        if ($this->privateMessagesReceived->removeElement($privateMessagesReceived)) {
            // set the owning side to null (unless already changed)
            if ($privateMessagesReceived->getRecipient() === $this) {
                $privateMessagesReceived->setRecipient(null);
            }
        }

        return $this;
    }



}
