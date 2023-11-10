<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['groups'=>'groupe:read-onlyGroupe'])]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['groups'=>'groupe:read-onlyGroupe'])]

    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'masterGroupes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['groups'=>'groupe:read-onlyGroupe'])]

    private ?Profile $master = null;



    #[ORM\ManyToMany(targetEntity: Profile::class, inversedBy: 'memberGroupes')]
    #[Groups(['groups'=>'groupe:read-onlyGroupe'])]

    private Collection $member;

    #[ORM\Column]
    private ?bool $visibility = null;

    public function __construct()
    {
        $this->member = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMaster(): ?Profile
    {
        return $this->master;
    }

    public function setMaster(?Profile $master): static
    {
        $this->master = $master;

        return $this;
    }

    /**
     * @return Collection<int, Profile>
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(Profile $member): static
    {
        if (!$this->member->contains($member)) {
            $this->member->add($member);
        }

        return $this;
    }

    public function removeMember(Profile $member): static
    {
        $this->member->removeElement($member);

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
