<?php

namespace App\Entity;

use App\Repository\CommunityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommunityRepository::class)]
class Community
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['community:read-all','communityMessage:read-message'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['community:read-all','communityMessage:read-message'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'authorCommunities')]
    #[Groups(['community:read-all'])]
    private ?Profile $author = null;

    #[ORM\ManyToMany(targetEntity: Profile::class, inversedBy: 'myCommunities')]
    #[Groups(['community:read-all'])]
    private Collection $member;

    #[ORM\OneToMany(mappedBy: 'community', targetEntity: MessageCommunity::class)]
    private Collection $messageCommunities;

    public function __construct()
    {
        $this->member = new ArrayCollection();
        $this->messageCommunities = new ArrayCollection();
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

    public function getAuthor(): ?Profile
    {
        return $this->author;
    }

    public function setAuthor(?Profile $author): static
    {
        $this->author = $author;

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

    /**
     * @return Collection<int, MessageCommunity>
     */
    public function getMessageCommunities(): Collection
    {
        return $this->messageCommunities;
    }

    public function addMessageCommunity(MessageCommunity $messageCommunity): static
    {
        if (!$this->messageCommunities->contains($messageCommunity)) {
            $this->messageCommunities->add($messageCommunity);
            $messageCommunity->setCommunity($this);
        }

        return $this;
    }

    public function removeMessageCommunity(MessageCommunity $messageCommunity): static
    {
        if ($this->messageCommunities->removeElement($messageCommunity)) {
            // set the owning side to null (unless already changed)
            if ($messageCommunity->getCommunity() === $this) {
                $messageCommunity->setCommunity(null);
            }
        }

        return $this;
    }
}
