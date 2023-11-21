<?php

namespace App\Entity;

use App\Repository\ConversationMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConversationMessageRepository::class)]
class ConversationMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['privateMessage:read-message'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['privateMessage:read-message'])]

    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'conversationMessages')]
    private ?Conversation $conversation = null;

    #[ORM\ManyToOne(inversedBy: 'conversationMessages')]
    #[Groups(['privateMessage:read-message'])]

    private ?Profile $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): static
    {
        $this->conversation = $conversation;

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
