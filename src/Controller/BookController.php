<?php

namespace App\Controller;

use App\Model\Followup;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    public function __construct(
        private BookRepository $bookRepository
    ) {
    }

    #[Route('/books', name: 'books_list')]
    public function listMovies(): Response
    {

        $sections = array_map(
            function ($state) {
                $books = $this->bookRepository->findByFollowUp($state);
                foreach($books as $book){
                    dump($book->getMovies());
                }
                return $books;
            },
            array_column(Followup::cases(), 'value', 'value')
        );

        return $this->render('book/books.html.twig',
        ['sections' => $sections]);
    }
}
