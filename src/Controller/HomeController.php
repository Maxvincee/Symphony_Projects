<?php

namespace App\Controller;

use App\Repository\JeuVideoRepository;
use App\Repository\GenreRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\CollectRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        JeuVideoRepository $jeuVideoRepository,
        GenreRepository $genreRepository,
        UtilisateurRepository $utilisateurRepository,
        CollectRepository $collectRepository,
        LoggerInterface $logger
    ): Response {
        $logger->info('Accès à la page d\'accueil');

        // Statistiques
        $totalJeux = count($jeuVideoRepository->findAll());
        $totalGenres = count($genreRepository->findAll());
        $totalUtilisateurs = count($utilisateurRepository->findAll());
        $totalCollections = count($collectRepository->findAll());

        // Derniers jeux ajoutés (3 derniers)
        $derniersJeux = $jeuVideoRepository->findBy([], ['createdAt' => 'DESC'], 3);

        return $this->render('home/index.html.twig', [
            'totalJeux' => $totalJeux,
            'totalGenres' => $totalGenres,
            'totalUtilisateurs' => $totalUtilisateurs,
            'totalCollections' => $totalCollections,
            'derniersJeux' => $derniersJeux,
        ]);
    }
}
