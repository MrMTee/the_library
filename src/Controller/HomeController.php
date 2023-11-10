<?php

namespace App\Controller;

use App\Api\Client\ApiClientInterface;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private MovieRepository $movieRepository
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'movies' => $this->movieRepository->findAll(),
        ]);
    }

    #[Route('/movies', name: 'movies_list')]
    public function listMovies(): Response
    {
        return $this->render('home/index.html.twig', [
            'movies' => $this->movieRepository->findAll(),
        ]);
    }
}
