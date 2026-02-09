<?php

namespace App\Entity;

use App\Repository\CardGameResultRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CardGameResultRepository::class)]
#[ApiResource]
class CardGameResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?array $suiteOrder = null;

    #[ORM\Column(nullable: true)]
    private ?array $valueOrder = null;

    #[ORM\Column(nullable: true)]
    private ?array $hand = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuiteOrder(): ?array
    {
        return $this->suiteOrder;
    }

    public function setSuiteOrder(?array $suiteOrder): static
    {
        $this->suiteOrder = $suiteOrder;

        return $this;
    }

    public function getValueOrder(): ?array
    {
        return $this->valueOrder;
    }

    public function setValueOrder(?array $valueOrder): static
    {
        $this->valueOrder = $valueOrder;

        return $this;
    }

    public function getHand(): ?array
    {
        return $this->hand;
    }

    public function setHand(?array $hand): static
    {
        $this->hand = $hand;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
