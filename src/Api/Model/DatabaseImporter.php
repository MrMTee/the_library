<?php

namespace App\Api\Model;

use App\Entity\Movie as MovieEntity;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseImporter
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MovieRepository $movieRepository
    ) {
    }

    public function import(Movie $movie, bool $flush = false): MovieEntity
    {

        $entity = (new MovieEntity())
            ->setTitle($movie->Title)
            ->setImdbID($movie->imdbID);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
