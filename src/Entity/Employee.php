<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    /**
     * @var Collection<int, ProjectOwner>
     */
    #[ORM\ManyToMany(targetEntity: ProjectOwner::class, inversedBy: 'employees')]
    private Collection $projectOwners;

    public function __construct()
    {
        $this->projectOwners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<int, ProjectOwner>
     */
    public function getProjectOwners(): Collection
    {
        return $this->projectOwners;
    }

    public function addProjectOwner(ProjectOwner $projectOwner): static
    {
        if (!$this->projectOwners->contains($projectOwner)) {
            $this->projectOwners->add($projectOwner);
        }

        return $this;
    }

    public function removeProjectOwner(ProjectOwner $projectOwner): static
    {
        $this->projectOwners->removeElement($projectOwner);

        return $this;
    }
}
