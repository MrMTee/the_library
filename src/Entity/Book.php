<?php

namespace App\Entity;

use App\Model\Followup;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'books')]
    private Collection $Movies;

    #[ORM\Column(length: 255, enumType: Followup::class, options: ['default' => 'Todo'], nullable: true)]
    private ?Followup $FollowUp = null;

    public function __construct()
    {
        $this->Movies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Title;   
    }

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

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->Movies;
    }

    public function addMovie(Movie $movie): static
    {
        if (!$this->Movies->contains($movie)) {
            $this->Movies->add($movie);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): static
    {
        $this->Movies->removeElement($movie);

        return $this;
    }

    public function getFollowUp(): ?Followup
    {
        return $this->FollowUp;
    }

    public function setFollowUp(?Followup $FollowUp): static
    {
        $this->FollowUp = $FollowUp;

        return $this;
    }
}
