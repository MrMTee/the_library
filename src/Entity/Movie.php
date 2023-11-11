<?php

namespace App\Entity;

use App\Model\Followup;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 10, options:['default' => ''], unique: true)]
    private ?string $imdbID = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Poster = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Plot = null;

    #[ORM\Column(length: 255)]
    private ?string $Director = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Year = null;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'Movies')]
    private Collection $books;

    #[ORM\Column(length: 255, enumType: Followup::class, options: ['default' => 'Todo'], nullable: true)]
    private ?Followup $FollowUp = null;

    public function __construct()
    {
        $this->books = new ArrayCollection();
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

    public function getImdbID(): ?string
    {
        return $this->imdbID;
    }

    public function setImdbID(string $imdbID): static
    {
        $this->imdbID = $imdbID;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->Poster;
    }

    public function setPoster(?string $Poster): static
    {
        $this->Poster = $Poster;

        return $this;
    }

    public function getPlot(): ?string
    {
        return $this->Plot;
    }

    public function setPlot(?string $Plot): static
    {
        $this->Plot = $Plot;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->Director;
    }

    public function setDirector(string $Director): static
    {
        $this->Director = $Director;

        return $this;
    }

    public function getYear(): ?\DateTimeImmutable
    {
        return $this->Year;
    }

    public function setYear(\DateTimeImmutable $Year): static
    {
        $this->Year = $Year;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->addMovie($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            $book->removeMovie($this);
        }

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
