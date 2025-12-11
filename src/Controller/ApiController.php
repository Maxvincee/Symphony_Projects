<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use App\Repository\JeuVideoRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    // ========================================================================
    // 1. LISTE DES JEUX VIDÉO
    // ========================================================================

    #[Route('/jeu_video', name: 'api_jeu_video_list', methods: ['GET'])]
    public function listJeuxVideo(
        JeuVideoRepository $jeuVideoRepository,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: GET /api/jeu_video', [
            'endpoint' => '/api/jeu_video',
            'method' => 'GET'
        ]);

        $jeux = $jeuVideoRepository->findAll();

        $data = [];
        foreach ($jeux as $jeu) {
            $data[] = [
                'id' => $jeu->getId(),
                'titre' => $jeu->getTitre(),
                'description' => $jeu->getDescription(),
                'prix' => $jeu->getPrix(),
                'dateSortie' => $jeu->getDateSortie()?->format('Y-m-d'),
                'imageUrl' => $jeu->getImageUrl(),
                'genre' => $jeu->getGenre() ? [
                    'id' => $jeu->getGenre()->getId(),
                    'nom' => $jeu->getGenre()->getNom()
                ] : null,
                'editeur' => $jeu->getEditeur() ? [
                    'id' => $jeu->getEditeur()->getId(),
                    'nom' => $jeu->getEditeur()->getNom()
                ] : null,
                'developpeur' => $jeu->getDeveloppeur() ? [
                    'id' => $jeu->getDeveloppeur()->getId(),
                    'nom' => $jeu->getDeveloppeur()->getNom()
                ] : null,
            ];
        }

        $logger->info('API Response: GET /api/jeu_video', [
            'response_code' => 200,
            'count' => count($data)
        ]);

        return $this->json($data);
    }

    // ========================================================================
    // 2. JEU VIDÉO PAR ID
    // ========================================================================

    #[Route('/jeu_video/{id}', name: 'api_jeu_video_show', methods: ['GET'])]
    public function getJeuVideo(
        int $id,
        JeuVideoRepository $jeuVideoRepository,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: GET /api/jeu_video/{id}', [
            'endpoint' => "/api/jeu_video/{$id}",
            'method' => 'GET',
            'id' => $id
        ]);

        $jeu = $jeuVideoRepository->find($id);

        if (!$jeu) {
            $logger->warning('API Error: Jeu vidéo non trouvé', [
                'id' => $id,
                'response_code' => 404
            ]);

            return $this->json([
                'error' => true,
                'code' => 404,
                'message' => 'Jeu vidéo non trouvé'
            ], 404);
        }

        $data = [
            'id' => $jeu->getId(),
            'titre' => $jeu->getTitre(),
            'description' => $jeu->getDescription(),
            'prix' => $jeu->getPrix(),
            'dateSortie' => $jeu->getDateSortie()?->format('Y-m-d'),
            'imageUrl' => $jeu->getImageUrl(),
            'genre' => $jeu->getGenre() ? [
                'id' => $jeu->getGenre()->getId(),
                'nom' => $jeu->getGenre()->getNom()
            ] : null,
            'editeur' => $jeu->getEditeur() ? [
                'id' => $jeu->getEditeur()->getId(),
                'nom' => $jeu->getEditeur()->getNom()
            ] : null,
            'developpeur' => $jeu->getDeveloppeur() ? [
                'id' => $jeu->getDeveloppeur()->getId(),
                'nom' => $jeu->getDeveloppeur()->getNom()
            ] : null,
        ];

        $logger->info('API Response: GET /api/jeu_video/{id}', [
            'response_code' => 200,
            'id' => $id
        ]);

        return $this->json($data);
    }

    // ========================================================================
    // 3. LISTE DES GENRES
    // ========================================================================

    #[Route('/genre', name: 'api_genre_list', methods: ['GET'])]
    public function listGenres(
        GenreRepository $genreRepository,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: GET /api/genre', [
            'endpoint' => '/api/genre',
            'method' => 'GET'
        ]);

        $genres = $genreRepository->findAll();

        $data = [];
        foreach ($genres as $genre) {
            $jeux = [];
            foreach ($genre->getJeuVideos() as $jeu) {
                $jeux[] = [
                    'id' => $jeu->getId(),
                    'titre' => $jeu->getTitre(),
                    'prix' => $jeu->getPrix()
                ];
            }

            $data[] = [
                'id' => $genre->getId(),
                'nom' => $genre->getNom(),
                'actif' => $genre->isActif(),
                'jeux' => $jeux
            ];
        }

        $logger->info('API Response: GET /api/genre', [
            'response_code' => 200,
            'count' => count($data)
        ]);

        return $this->json($data);
    }

    // ========================================================================
    // 4. GENRE PAR ID
    // ========================================================================

    #[Route('/genre/{id}', name: 'api_genre_show', methods: ['GET'])]
    public function getGenre(
        int $id,
        GenreRepository $genreRepository,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: GET /api/genre/{id}', [
            'endpoint' => "/api/genre/{$id}",
            'method' => 'GET',
            'id' => $id
        ]);

        $genre = $genreRepository->find($id);

        if (!$genre) {
            $logger->warning('API Error: Genre non trouvé', [
                'id' => $id,
                'response_code' => 404
            ]);

            return $this->json([
                'error' => true,
                'code' => 404,
                'message' => 'Genre non trouvé'
            ], 404);
        }

        $jeux = [];
        foreach ($genre->getJeuVideos() as $jeu) {
            $jeux[] = [
                'id' => $jeu->getId(),
                'titre' => $jeu->getTitre(),
                'prix' => $jeu->getPrix(),
                'dateSortie' => $jeu->getDateSortie()?->format('Y-m-d')
            ];
        }

        $data = [
            'id' => $genre->getId(),
            'nom' => $genre->getNom(),
            'actif' => $genre->isActif(),
            'jeux' => $jeux
        ];

        $logger->info('API Response: GET /api/genre/{id}', [
            'response_code' => 200,
            'id' => $id
        ]);

        return $this->json($data);
    }

    // ========================================================================
    // 5. COLLECTION D'UN UTILISATEUR
    // ========================================================================

    #[Route('/utilisateur/{id}/collection', name: 'api_utilisateur_collection', methods: ['GET'])]
    public function getCollectionUtilisateur(
        int $id,
        UtilisateurRepository $utilisateurRepository,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: GET /api/utilisateur/{id}/collection', [
            'endpoint' => "/api/utilisateur/{$id}/collection",
            'method' => 'GET',
            'id' => $id
        ]);

        $utilisateur = $utilisateurRepository->find($id);

        if (!$utilisateur) {
            $logger->warning('API Error: Utilisateur non trouvé', [
                'id' => $id,
                'response_code' => 404
            ]);

            return $this->json([
                'error' => true,
                'code' => 404,
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }

        $collection = [];
        foreach ($utilisateur->getCollects() as $collect) {
            $collection[] = [
                'id' => $collect->getId(),
                'jeu' => [
                    'id' => $collect->getJeuvideo()->getId(),
                    'titre' => $collect->getJeuvideo()->getTitre(),
                    'genre' => $collect->getJeuvideo()->getGenre()?->getNom()
                ],
                'statut' => [
                    'value' => $collect->getStatut()->value,
                    'label' => $collect->getStatut()->getLabel()
                ],
                'dateModifStatut' => $collect->getDateModifStatut()?->format('Y-m-d'),
                'prixAchat' => $collect->getPrixAchat(),
                'dateAchat' => $collect->getDateAchat()?->format('Y-m-d'),
                'commentaire' => $collect->getCommentaire()
            ];
        }

        $data = [
            'utilisateur' => [
                'id' => $utilisateur->getId(),
                'pseudo' => $utilisateur->getPseudo(),
                'prenom' => $utilisateur->getPrenom(),
                'nom' => $utilisateur->getNom()
            ],
            'collection' => $collection,
            'total' => count($collection)
        ];

        $logger->info('API Response: GET /api/utilisateur/{id}/collection', [
            'response_code' => 200,
            'id' => $id,
            'count' => count($collection)
        ]);

        return $this->json($data);
    }

    // ========================================================================
    // 6. SUPPRIMER UN GENRE
    // ========================================================================

    #[Route('/genre/{id}', name: 'api_genre_delete', methods: ['DELETE'])]
    public function deleteGenre(
        int $id,
        GenreRepository $genreRepository,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: DELETE /api/genre/{id}', [
            'endpoint' => "/api/genre/{$id}",
            'method' => 'DELETE',
            'id' => $id
        ]);

        $genre = $genreRepository->find($id);

        if (!$genre) {
            $logger->warning('API Error: Genre non trouvé', [
                'id' => $id,
                'response_code' => 404
            ]);

            return $this->json([
                'error' => true,
                'code' => 404,
                'message' => 'Genre non trouvé'
            ], 404);
        }

        // Vérifier si le genre a des jeux associés
        if ($genre->getJeuVideos()->count() > 0) {
            $logger->warning('API Error: Impossible de supprimer le genre (jeux associés)', [
                'id' => $id,
                'response_code' => 409,
                'jeux_count' => $genre->getJeuVideos()->count()
            ]);

            return $this->json([
                'error' => true,
                'code' => 409,
                'message' => 'Impossible de supprimer ce genre car il a des jeux associés'
            ], 409);
        }

        $entityManager->remove($genre);
        $entityManager->flush();

        $logger->info('API Response: DELETE /api/genre/{id}', [
            'response_code' => 204,
            'id' => $id,
            'message' => 'Genre supprimé avec succès'
        ]);

        return new JsonResponse(null, 204);
    }

    // ========================================================================
    // 7. PING
    // ========================================================================

    #[Route('/ping', name: 'api_ping', methods: ['GET'])]
    public function ping(LoggerInterface $logger): Response
    {
        $logger->info('API Call: GET /api/ping', [
            'endpoint' => '/api/ping',
            'method' => 'GET'
        ]);

        return new Response('pong', 200);
    }

    // ========================================================================
    // 8. HEALTHCHECK
    // ========================================================================

    #[Route('/healthcheck', name: 'api_healthcheck', methods: ['GET'])]
    public function healthcheck(
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('API Call: GET /api/healthcheck', [
            'endpoint' => '/api/healthcheck',
            'method' => 'GET'
        ]);

        $checks = [];
        $overallStatus = 'healthy';

        // Test de connexion à la base de données
        try {
            $entityManager->getConnection()->executeQuery('SELECT 1');
            $checks['database'] = [
                'status' => 'ok',
                'message' => 'Connected successfully'
            ];
        } catch (\Exception $e) {
            $checks['database'] = [
                'status' => 'error',
                'message' => 'Connection failed: ' . $e->getMessage()
            ];
            $overallStatus = 'unhealthy';
        }

        // Vérification de l'espace disque (optionnel)
        $projectDir = $this->getParameter('kernel.project_dir');
        $diskSpace = disk_free_space($projectDir);
        $diskSpaceGB = round($diskSpace / 1024 / 1024 / 1024, 2);

        $checks['disk_space'] = [
            'status' => $diskSpaceGB > 1 ? 'ok' : 'warning',
            'available' => $diskSpaceGB . ' GB'
        ];

        if ($diskSpaceGB < 1) {
            $overallStatus = 'warning';
        }

        $data = [
            'status' => $overallStatus,
            'timestamp' => (new \DateTime())->format('c'),
            'checks' => $checks
        ];

        $logger->info('API Response: GET /api/healthcheck', [
            'response_code' => 200,
            'status' => $overallStatus
        ]);

        return $this->json($data);
    }
}
