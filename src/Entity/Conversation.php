<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['privateMessage:read-message','conversation:read-conversation'])]

    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Profile::class, inversedBy: 'conversations')]
    #[Groups(['conversation:read-conversation','privateMessage:read-message',])]

    private Collection $profile;

    #[ORM\OneToMany(mappedBy: 'conversation', targetEntity: ConversationMessage::class ,orphanRemoval: true)]
    #[Groups(['privateMessage:read-message','conversation:read-conversation'])]

    private Collection $conversationMessages;

    #[ORM\ManyToOne(inversedBy: 'conversationCreated')]
    #[Groups(['privateMessage:read-message','conversation:read-conversation'])]
    private ?Profile $author = null;

    public function __construct()
    {
        $this->profile = new ArrayCollection();
        $this->conversationMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return Collection<int, Profile>
     */
    public function getProfile(): Collection
    {
        return $this->profile;
    }

    public function addProfile(Profile $profile): static
    {
        if (!$this->profile->contains($profile)) {
            $this->profile->add($profile);
        }

        return $this;
    }

    public function removeProfile(Profile $profile): static
    {
        $this->profile->removeElement($profile);

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
            $conversationMessage->setConversation($this);
        }

        return $this;
    }

    public function removeConversationMessage(ConversationMessage $conversationMessage): static
    {
        if ($this->conversationMessages->removeElement($conversationMessage)) {
            // set the owning side to null (unless already changed)
            if ($conversationMessage->getConversation() === $this) {
                $conversationMessage->setConversation(null);
            }
        }

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
}