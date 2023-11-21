<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InvitationRepository::class)]
class Invitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['invitation:read-all'])]

    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['invitation:read-all'])]

    private ?bool $validity = null;

    #[ORM\ManyToOne(inversedBy: 'invitationGroup')]

    private ?Profile $profile = null;

    #[ORM\ManyToOne(inversedBy: 'invitations')]
    #[Groups(['invitation:read-all'])]
    private ?Group $ofGroup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isValidity(): ?bool
    {
        return $this->validity;
    }

    public function setValidity(bool $validity): static
    {
        $this->validity = $validity;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): static
    {
        $this->profile = $profile;

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
}
