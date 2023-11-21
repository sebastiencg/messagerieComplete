<?php

namespace App\Entity;

use App\Repository\ResponseMessageGroupRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseMessageGroupRepository::class)]
class ResponseMessageGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'responseMessageGroups')]
    private ?Profile $author = null;

    #[ORM\ManyToOne(inversedBy: 'responseMessageGroups')]
    private ?GroupMessage $ofGroupMessage = null;

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

    public function getOfGroupMessage(): ?GroupMessage
    {
        return $this->ofGroupMessage;
    }

    public function setOfGroupMessage(?GroupMessage $ofGroupMessage): static
    {
        $this->ofGroupMessage = $ofGroupMessage;

        return $this;
    }
}
