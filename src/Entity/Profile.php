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
    #[Groups(['relation:read-one','profile:read-all','profile:read-one','relation:read-onlyRelation','groups'=>'groupe:read-onlyGroupe','privateMessage:read-message','conversation:read-conversation','group:read-all'])]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['profile:read-all'])]

    private ?User $ofUser = null;

    #[ORM\Column(length: 255)]
    #[Groups(['relation:read-one','profile:read-one','profile:read-all','relation:read-onlyRelation','groups'=>'groupe:read-onlyGroupe','privateMessage:read-message','conversation:read-conversation','group:read-all'])]

    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'host', targetEntity: RequestRelation::class)]
    private Collection $requestRelations;

    #[ORM\OneToMany(mappedBy: 'profile1', targetEntity: Relation::class)]
    private Collection $relationSend;

    #[ORM\OneToMany(mappedBy: 'profile2', targetEntity: Relation::class)]
    private Collection $relationRequest;

    #[ORM\Column]
    #[Groups(['profile:read-all'])]
    private ?bool $visibility = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: PrivateMessage::class)]
    private Collection $privateMessagesSend;

    #[ORM\OneToMany(mappedBy: 'recipient', targetEntity: PrivateMessage::class)]
    private Collection $privateMessagesReceived;

    #[ORM\ManyToMany(targetEntity: Conversation::class, mappedBy: 'profile')]
    private Collection $conversations;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Conversation::class)]
    private Collection $conversationCreated;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: ConversationMessage::class)]
    private Collection $conversationMessages;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Group::class)]
    private Collection $groupsCreate;

    #[ORM\ManyToMany(targetEntity: Group::class, mappedBy: 'admin')]
    private Collection $groupsAdministrates;

    #[ORM\ManyToMany(targetEntity: Group::class, mappedBy: 'member')]
    private Collection $MyGroups;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: GroupMessage::class)]
    private Collection $groupMessages;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: ResponseMessageGroup::class)]
    private Collection $responseMessageGroups;

    #[ORM\OneToMany(mappedBy: 'profile', targetEntity: Invitation::class)]
    private Collection $invitationGroup;






    public function __construct()
    {
        $this->requestRelations = new ArrayCollection();
        $this->relationSend = new ArrayCollection();
        $this->relationRequest = new ArrayCollection();
        $this->privateMessagesSend = new ArrayCollection();
        $this->privateMessagesReceived = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->conversationCreated = new ArrayCollection();
        $this->conversationMessages = new ArrayCollection();
        $this->groupsCreate = new ArrayCollection();
        $this->groupsAdministrates = new ArrayCollection();
        $this->MyGroups = new ArrayCollection();
        $this->groupMessages = new ArrayCollection();
        $this->responseMessageGroups = new ArrayCollection();
        $this->invitationGroup = new ArrayCollection();


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

    /**
     * @return Collection<int, Conversation>
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): static
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations->add($conversation);
            $conversation->addProfile($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): static
    {
        if ($this->conversations->removeElement($conversation)) {
            $conversation->removeProfile($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Conversation>
     */
    public function getConversationCreated(): Collection
    {
        return $this->conversationCreated;
    }

    public function addConversationCreated(Conversation $conversationCreated): static
    {
        if (!$this->conversationCreated->contains($conversationCreated)) {
            $this->conversationCreated->add($conversationCreated);
            $conversationCreated->setAuthor($this);
        }

        return $this;
    }

    public function removeConversationCreated(Conversation $conversationCreated): static
    {
        if ($this->conversationCreated->removeElement($conversationCreated)) {
            // set the owning side to null (unless already changed)
            if ($conversationCreated->getAuthor() === $this) {
                $conversationCreated->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ConversationMessage>
     */
    public function getConversationMessages(): Collection
    {
        return $this->conversationMessages;
    }

    public function addConversationMessage(ConversationMessage $conversationMessage): static
    {
        if (!$this->conversationMessages->contains($conversationMessage)) {
            $this->conversationMessages->add($conversationMessage);
            $conversationMessage->setAuthor($this);
        }

        return $this;
    }

    public function removeConversationMessage(ConversationMessage $conversationMessage): static
    {
        if ($this->conversationMessages->removeElement($conversationMessage)) {
            // set the owning side to null (unless already changed)
            if ($conversationMessage->getAuthor() === $this) {
                $conversationMessage->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroupsCreate(): Collection
    {
        return $this->groupsCreate;
    }

    public function addGroupsCreate(Group $groupsCreate): static
    {
        if (!$this->groupsCreate->contains($groupsCreate)) {
            $this->groupsCreate->add($groupsCreate);
            $groupsCreate->setAuthor($this);
        }

        return $this;
    }

    public function removeGroupsCreate(Group $groupsCreate): static
    {
        if ($this->groupsCreate->removeElement($groupsCreate)) {
            // set the owning side to null (unless already changed)
            if ($groupsCreate->getAuthor() === $this) {
                $groupsCreate->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroupsAdministrates(): Collection
    {
        return $this->groupsAdministrates;
    }

    public function addGroupsAdministrate(Group $groupsAdministrate): static
    {
        if (!$this->groupsAdministrates->contains($groupsAdministrate)) {
            $this->groupsAdministrates->add($groupsAdministrate);
            $groupsAdministrate->addAdmin($this);
        }

        return $this;
    }

    public function removeGroupsAdministrate(Group $groupsAdministrate): static
    {
        if ($this->groupsAdministrates->removeElement($groupsAdministrate)) {
            $groupsAdministrate->removeAdmin($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getMyGroups(): Collection
    {
        return $this->MyGroups;
    }

    public function addMyGroup(Group $myGroup): static
    {
        if (!$this->MyGroups->contains($myGroup)) {
            $this->MyGroups->add($myGroup);
            $myGroup->addMember($this);
        }

        return $this;
    }

    public function removeMyGroup(Group $myGroup): static
    {
        if ($this->MyGroups->removeElement($myGroup)) {
            $myGroup->removeMember($this);
        }

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
            $groupMessage->setAuthor($this);
        }

        return $this;
    }

    public function removeGroupMessage(GroupMessage $groupMessage): static
    {
        if ($this->groupMessages->removeElement($groupMessage)) {
            // set the owning side to null (unless already changed)
            if ($groupMessage->getAuthor() === $this) {
                $groupMessage->setAuthor(null);
            }
        }

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
            $responseMessageGroup->setAuthor($this);
        }

        return $this;
    }

    public function removeResponseMessageGroup(ResponseMessageGroup $responseMessageGroup): static
    {
        if ($this->responseMessageGroups->removeElement($responseMessageGroup)) {
            // set the owning side to null (unless already changed)
            if ($responseMessageGroup->getAuthor() === $this) {
                $responseMessageGroup->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Invitation>
     */
    public function getInvitationGroup(): Collection
    {
        return $this->invitationGroup;
    }

    public function addInvitationGroup(Invitation $invitationGroup): static
    {
        if (!$this->invitationGroup->contains($invitationGroup)) {
            $this->invitationGroup->add($invitationGroup);
            $invitationGroup->setProfile($this);
        }

        return $this;
    }

    public function removeInvitationGroup(Invitation $invitationGroup): static
    {
        if ($this->invitationGroup->removeElement($invitationGroup)) {
            // set the owning side to null (unless already changed)
            if ($invitationGroup->getProfile() === $this) {
                $invitationGroup->setProfile(null);
            }
        }

        return $this;
    }




}
