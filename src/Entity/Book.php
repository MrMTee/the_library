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

    #[ORM\ManyToMany(targetEntity: Person::class)]
    private Collection $Author;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Comment $Comment = null;

    public function __construct()
    {
        $this->Movies = new ArrayCollection();
        $this->Author = new ArrayCollection();
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

    /**
     * @return Collection<int, Person>
     */
    public function getAuthor(): Collection
    {
        return $this->Author;
    }

    public function addAuthor(Person $author): static
    {
        if (!$this->Author->contains($author)) {
            $this->Author->add($author);
        }

        return $this;
    }

    public function removeAuthor(Person $author): static
    {
        $this->Author->removeElement($author);

        return $this;
    }

    public function getComment(): ?Comment
    {
        return $this->Comment;
    }

    public function setComment(?Comment $Comment): static
    {
        $this->Comment = $Comment;

        return $this;
    }
}
