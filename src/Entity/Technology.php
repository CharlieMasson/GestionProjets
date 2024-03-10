<?php

namespace App\Entity;

use App\Repository\TechnologyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TechnologyRepository::class)]
class Technology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le champ ne doir pas être inférieur à {{ limit }} caractères',
        maxMessage: 'Le champ ne doir pas dépasser {{ limit }} caractères',
    )]
    private ?string $technologyLabel = null;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'technologies')]
    private Collection $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnologyLabel(): ?string
    {
        return $this->technologyLabel;
    }

    public function setTechnologyLabel(string $technologyLabel): static
    {
        $this->technologyLabel = $technologyLabel;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addProjectTechnology($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeProjectTechnology($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->technologyLabel ?? '';
    }
}
