<?php

namespace App\Entity;

use App\Repository\PrivateMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PrivateMessageRepository::class)]
class PrivateMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['privateMessage:read-message'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['privateMessage:read-message'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'privateMessagesSend')]
    #[Groups(['privateMessage:read-message'])]
    private ?Profile $author = null;

    #[ORM\ManyToOne(inversedBy: 'privateMessagesReceived')]
    #[Groups(['privateMessage:read-message'])]
    private ?Profile $recipient = null;

    #[ORM\ManyToOne(inversedBy: 'privateMessages')]
    private ?Relation $ralationId = null;

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

    public function getAuthor(): ?Profile
    {
        return $this->author;
    }

    public function setAuthor(?Profile $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getRecipient(): ?Profile
    {
        return $this->recipient;
    }

    public function setRecipient(?Profile $recipient): static
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getRalationId(): ?Relation
    {
        return $this->ralationId;
    }

    public function setRalationId(?Relation $ralationId): static
    {
        $this->ralationId = $ralationId;

        return $this;
    }
}
