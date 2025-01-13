<?php

namespace App\Entity;

use App\Repository\TimeslotRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeslotRepository::class)]
class Timeslot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'timeslots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'timeslots')]
    private ?Task $task = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_slot = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_slot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): static
    {
        $this->task = $task;

        return $this;
    }

    public function getStartSlot(): ?\DateTimeInterface
    {
        return $this->start_slot;
    }

    public function setStartSlot(\DateTimeInterface $start_slot): static
    {
        $this->start_slot = $start_slot;

        return $this;
    }

    public function getEndSlot(): ?\DateTimeInterface
    {
        return $this->end_slot;
    }

    public function setEndSlot(\DateTimeInterface $end_slot): static
    {
        $this->end_slot = $end_slot;

        return $this;
    }
}
