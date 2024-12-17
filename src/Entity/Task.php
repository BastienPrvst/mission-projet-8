<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?User $assigned_to = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deadline = null;

    /**
     * @var Collection<int, Timeslot>
     */
    #[ORM\OneToMany(targetEntity: Timeslot::class, mappedBy: 'task_id')]
    private Collection $timeslots;

    /**
     * @var Collection<int, TaskTag>
     */
    #[ORM\OneToMany(targetEntity: TaskTag::class, mappedBy: 'task')]
    private Collection $taskTags;

    public function __construct()
    {
        $this->timeslots = new ArrayCollection();
        $this->taskTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }
    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getAssignedTo(): ?User
    {
        return $this->assigned_to;
    }

    public function setAssignedTo(?User $assigned_to): static
    {
        $this->assigned_to = $assigned_to;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * @return Collection<int, Timeslot>
     */
    public function getTimeslots(): Collection
    {
        return $this->timeslots;
    }

    public function addTimeslot(Timeslot $timeslot): static
    {
        if (!$this->timeslots->contains($timeslot)) {
            $this->timeslots->add($timeslot);
            $timeslot->setTask($this);
        }

        return $this;
    }

    public function removeTimeslot(Timeslot $timeslot): static
    {
        if ($this->timeslots->removeElement($timeslot)) {
            // set the owning side to null (unless already changed)
            if ($timeslot->getTask() === $this) {
                $timeslot->setTask(null);
            }
        }

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
            $taskTag->setTask($this);
        }

        return $this;
    }

    public function removeTaskTag(TaskTag $taskTag): static
    {
        if ($this->taskTags->removeElement($taskTag)) {
            // set the owning side to null (unless already changed)
            if ($taskTag->getTask() === $this) {
                $taskTag->setTask(null);
            }
        }

        return $this;
    }

}
