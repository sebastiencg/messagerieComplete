<?php

namespace App\Entity;

use App\Repository\MessageCommunityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageCommunityRepository::class)]
class MessageCommunity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['communityMessage:read-message'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['communityMessage:read-message'])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'messageCommunities')]
    #[Groups(['communityMessage:read-message'])]
    private ?Profile $author = null;

    #[ORM\ManyToOne(inversedBy: 'messageCommunities')]
    #[Groups(['communityMessage:read-message'])]
    private ?Community $community = null;

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

    public function getCommunity(): ?Community
    {
        return $this->community;
    }

    public function setCommunity(?Community $community): static
    {
        $this->community = $community;

        return $this;
    }
}
