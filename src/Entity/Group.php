<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
#[ORM\Table(name: '`group`')]
class Group
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['group:read-all'])]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['group:read-all'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'groupsCreate')]
    #[Groups(['group:read-all'])]
    private ?Profile $author = null;

    #[ORM\ManyToMany(targetEntity: Profile::class, inversedBy: 'groupsAdministrates')]
    #[ORM\JoinTable(name:"group_profile_admin")]
    #[Groups(['group:read-all'])]
    private Collection $admin;

    #[ORM\ManyToMany(targetEntity: Profile::class, inversedBy: 'MyGroups')]
    #[ORM\JoinTable(name:"group_profile_member")]
    #[Groups(['group:read-all'])]
    private Collection $member;

    #[ORM\OneToMany(mappedBy: 'ofGroup', targetEntity: GroupMessage::class)]
    #[Groups(['group:read-all'])]
    private Collection $groupMessages;

    #[ORM\OneToOne(mappedBy: 'ofGroup', cascade: ['persist', 'remove'])]
    private ?Invitation $invitation = null;


    public function __construct()
    {
        $this->admin = new ArrayCollection();
        $this->member = new ArrayCollection();
        $this->groupMessages = new ArrayCollection();
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
    public function getAdmin(): Collection
    {
        return $this->admin;
    }

    public function addAdmin(Profile $admin): static
    {
        if (!$this->admin->contains($admin)) {
            $this->admin->add($admin);
        }

        return $this;
    }

    public function removeAdmin(Profile $admin): static
    {
        $this->admin->removeElement($admin);

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
     * @return Collection<int, GroupMessage>
     */
    public function getGroupMessages(): Collection
    {
        return $this->groupMessages;
    }

    public function addGroupMessage(GroupMessage $groupMessage): static
    {
        if (!$this->groupMessages->contains($groupMessage)) {
            $this->groupMessages->add($groupMessage);
            $groupMessage->setOfGroup($this);
        }

        return $this;
    }

    public function removeGroupMessage(GroupMessage $groupMessage): static
    {
        if ($this->groupMessages->removeElement($groupMessage)) {
            // set the owning side to null (unless already changed)
            if ($groupMessage->getOfGroup() === $this) {
                $groupMessage->setOfGroup(null);
            }
        }

        return $this;
    }

    public function getInvitation(): ?Invitation
    {
        return $this->invitation;
    }

    public function setInvitation(?Invitation $invitation): static
    {
        // unset the owning side of the relation if necessary
        if ($invitation === null && $this->invitation !== null) {
            $this->invitation->setOfGroup(null);
        }

        // set the owning side of the relation if necessary
        if ($invitation !== null && $invitation->getOfGroup() !== $this) {
            $invitation->setOfGroup($this);
        }

        $this->invitation = $invitation;

        return $this;
    }

}
