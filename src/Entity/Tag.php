<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tags')]
    private ?Project $project = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, TaskTag>
     */
    #[ORM\OneToMany(targetEntity: TaskTag::class, mappedBy: 'tag')]
    private Collection $taskTags;

    public function __construct()
    {
        $this->taskTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, TaskTag>
     */
    public function getTaskTags(): Collection
    {
        return $this->taskTags;
    }

    public function addTaskTag(TaskTag $taskTag): static
    {
        if (!$this->taskTags->contains($taskTag)) {
            $this->taskTags->add($taskTag);
            $taskTag->setIdTag($this);
        }

        return $this;
    }

    public function removeTaskTag(TaskTag $taskTag): static
    {
        if ($this->taskTags->removeElement($taskTag)) {
            // set the owning side to null (unless already changed)
            if ($taskTag->getIdTag() === $this) {
                $taskTag->setIdTag(null);
            }
        }

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): void
    {
        $this->project = $project;
    }
}
