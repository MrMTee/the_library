<?php

namespace App\Api\Model;

use App\Entity\Movie as MovieEntity;
use App\Repository\MovieRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class DatabaseImporter
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MovieRepository $movieRepository
    ) {
    }

    public function import(Movie $movie): MovieEntity
    {
        return $this->save(new MovieEntity(), $movie);
    }

    public function update(Movie $movie, string $imdbID){
        return $this->save($this->movieRepository->findOneBy(['imdbID' => $imdbID]), $movie);
    }

    public function save(MovieEntity $entity, Movie $omdbData){

        $entity->setTitle($omdbData->Title)
        ->setImdbID($omdbData->imdbID)
        ->setPoster($omdbData->Poster)
        ->setPlot($omdbData->Plot)
        ->setDirector($omdbData->Director)
        ->setYear(new DateTimeImmutable($omdbData->Year));
        
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

}
