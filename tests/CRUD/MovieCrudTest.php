<?php

namespace App\Tests\CRUD;

use App\Controller\Admin\MovieCrudController;
use App\Entity\Book;
use App\Entity\Movie as EntityMovie;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieCrudTest extends WebTestCase
{

    public static function setUpBeforeClass(): void
    {
    }

    public function testSavingRelatedBookWithoutCrud()
    {

        $book = (new Book())
            ->setTitle('Test book');

        dump($book);
        
        $this->entityManager->persist($book);
        $this->entityManager->flush();

        $movie = (new EntityMovie())
            ->setTitle('Test movie')
            ->setDirector('Test director')
            ->setYear(new DateTime())
            ->addBook($book);
        
        dump($movie);
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
        
        dump($movie);
    }
}
