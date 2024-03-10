<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
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
    private ?string $projectName = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        max: 200,
    )]
    private ?string $projectThumbnail = null;

    #[ORM\Column(length: 1500, nullable: true)]
    #[Assert\Length(
        max: 1500,
        maxMessage: 'Le champ ne doir pas dépasser {{ limit }} caractères',
    )]
    private ?string $projectDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 100,
        maxMessage: 'Le champ ne doir pas dépasser {{ limit }} caractères',
    )]
    private ?string $projectLink = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $projectStartDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $projectEndDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $projectCreationDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $projectModificationDate = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $Category = null;

    #[ORM\ManyToMany(targetEntity: Technology::class, inversedBy: 'projects')]
    private Collection $technologies;

    public function __construct()
    {
        $this->technologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): static
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function getProjectThumbnail(): ?string
    {
        return $this->projectThumbnail;
    }

    public function setProjectThumbnail(string $projectThumbnail): static
    {
        $this->projectThumbnail = $projectThumbnail;

        return $this;
    }

    public function getProjectDescription(): ?string
    {
        return $this->projectDescription;
    }

    public function setProjectDescription(?string $projectDescription): static
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    public function getProjectLink(): ?string
    {
        return $this->projectLink;
    }

    public function setProjectLink(?string $projectLink): static
    {
        $this->projectLink = $projectLink;

        return $this;
    }

    public function getProjectStartDate(): ?\DateTimeInterface
    {
        return $this->projectStartDate;
    }

    public function setProjectStartDate(\DateTimeInterface $projectStartDate): static
    {
        $this->projectStartDate = $projectStartDate;

        return $this;
    }

    public function getProjectEndDate(): ?\DateTimeInterface
    {
        return $this->projectEndDate;
    }

    public function setProjectEndDate(?\DateTimeInterface $projectEndDate): static
    {
        $this->projectEndDate = $projectEndDate;

        return $this;
    }

    public function getProjectCreationDate(): ?\DateTimeInterface
    {
        return $this->projectCreationDate;
    }

    public function setProjectCreationDate(\DateTimeInterface $projectCreationDate): static
    {
        $this->projectCreationDate = $projectCreationDate;

        return $this;
    }

    public function getProjectModificationDate(): ?\DateTimeInterface
    {
        return $this->projectModificationDate;
    }

    public function setProjectModificationDate(?\DateTimeInterface $projectModificationDate): static
    {
        $this->projectModificationDate = $projectModificationDate;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * @return Collection<int, Technology>
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technology $technology): self
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies->add($technology);
        }

        return $this;
    }

    //public function addTechnology($technology): static
    //{
    //if (is_int($technology)) {
        // If $technology is an integer, assume it's a Technology ID
        // Retrieve the corresponding Technology entity from the database
    //    $technology = $this->entityManager->getRepository(Technology::class)->find($technology);
    //    if ($technology !== null) {
    //        $technology = $technology;
    //    }
    //  }
    //    if ($technology instanceof Technology && !$this->technologies->contains($technology)) {
    //        $this->technologies->add($technology);
    //    }

    //    return $this;
    //}
    

    public function removeTechnology(Technology $technology): self
    {
        $this->technologies->removeElement($technology);

        return $this;
    }
}
