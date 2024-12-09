<?php

namespace App\Entity;

use App\Repository\TaskTagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskTagRepository::class)]
class TaskTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'taskTags')]
    private ?Task $id_task = null;

    #[ORM\ManyToOne(inversedBy: 'taskTags')]
    private ?Tag $id_tag = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTask(): ?Task
    {
        return $this->id_task;
    }

    public function setIdTask(?Task $id_task): static
    {
        $this->id_task = $id_task;

        return $this;
    }

    public function getIdTag(): ?Tag
    {
        return $this->id_tag;
    }

    public function setIdTag(?Tag $id_tag): static
    {
        $this->id_tag = $id_tag;

        return $this;
    }
}
