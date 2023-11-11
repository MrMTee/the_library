<?php

namespace App\Controller;

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
        return $this->render('book/books.html.twig', [
            'books' => $this->bookRepository->findAll(),
        ]);
    }
}
