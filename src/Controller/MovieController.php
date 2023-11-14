<?php

namespace App\Controller;

use App\Model\Followup;
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
        $sections = array_map(
            function ($state) {
                return $this->movieRepository->findByFollowUp($state);
            },
            array_column(Followup::cases(), 'value', 'value')
        );

        return $this->render(
            'movie/movies.html.twig',
            ['sections' => $sections]
        );
    }

    #[Route('/movie/{id}', name: 'movie_details')]
    public function movieDetails($id)
    {
        return $this->render('movie/movie.html.twig', [
            'movie' => $this->movieRepository->find($id)
        ]);
    }
}
