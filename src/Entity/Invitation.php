<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitationRepository::class)]
class Invitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'invitation', cascade: ['persist', 'remove'])]
    private ?Profile $profile = null;

    #[ORM\OneToOne(inversedBy: 'invitation', cascade: ['persist', 'remove'])]
    private ?Group $ofGroup = null;

    #[ORM\Column]
    private ?bool $validity = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isValidity(): ?bool
    {
        return $this->validity;
    }

    public function setValidity(bool $validity): static
    {
        $this->validity = $validity;

        return $this;
    }
}
