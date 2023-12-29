<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 60)]
    private ?string $Place = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column]
    private ?bool $isPublic = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $nbr_participants = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator_user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->Place;
    }

    public function setPlace(string $Place): static
    {
        $this->Place = $Place;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function isIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): static
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getNbrParticipants(): ?int
    {
        return $this->nbr_participants;
    }

    public function setNbrParticipants(?int $nbr_participants): static
    {
        $this->nbr_participants = $nbr_participants;

        return $this;
    }

    public function getCreatorUserId(): ?User
    {
        return $this->creator_user_id;
    }

    public function setCreatorUserId(?User $creator_user_id): static
    {
        $this->creator_user_id = $creator_user_id;

        return $this;
    }
}
