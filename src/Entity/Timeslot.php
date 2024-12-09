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
    private ?user $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'timeslots')]
    private ?Task $task_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_slot = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_slot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getTaskId(): ?Task
    {
        return $this->task_id;
    }

    public function setTaskId(?Task $task_id): static
    {
        $this->task_id = $task_id;

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
