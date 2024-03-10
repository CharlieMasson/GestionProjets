<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 3,
        max: 75,
        minMessage: 'Le champ ne doir pas être inférieur à {{ limit }} caractères',
        maxMessage: 'Le champ ne doir pas dépasser {{ limit }} caractères',
    )]
    private ?string $categoryLabel = null;

    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'Category')]
    private Collection $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryLabel(): ?string
    {
        return $this->categoryLabel;
    }

    public function setCategoryLabel(string $categoryLabel): static
    {
        $this->categoryLabel = $categoryLabel;

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
            $project->setCategory($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getCategory() === $this) {
                $project->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->categoryLabel ?? '';
    }
}
