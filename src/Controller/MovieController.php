<?php

namespace App\Controller;

use App\Api\Client\ApiClientInterface;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository
    ) {
    }

    #[Route('/movies', name: 'movies_list')]
    public function listMovies(): Response
    {
        return $this->render('movie/movies.html.twig', [
            'movies' => $this->movieRepository->findAll(),
        ]);
    }
}
