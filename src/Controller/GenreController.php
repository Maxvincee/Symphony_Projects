<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/genre')]
final class GenreController extends AbstractController
{
    #[Route(name: 'app_genre_index', methods: ['GET'])]
    public function index(GenreRepository $genreRepository, LoggerInterface $logger): Response
    {
        $logger->info('Accès à la liste des genres');

        return $this->render('genre/index.html.twig', [
            'genres' => $genreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_genre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire d\'ajout d\'un genre');

        $genre = new Genre();
        $genre->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genre);
            $entityManager->flush();

            $logger->info('Nouveau genre créé', ['id' => $genre->getId(), 'nom' => $genre->getNom()]);

            return $this->redirectToRoute('app_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genre/new.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_show', methods: ['GET'])]
    public function show(Genre $genre, LoggerInterface $logger): Response
    {
        $logger->info('Consultation d\'un genre', ['id' => $genre->getId(), 'nom' => $genre->getNom()]);

        return $this->render('genre/show.html.twig', [
            'genre' => $genre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_genre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Genre $genre, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire de modification d\'un genre', ['id' => $genre->getId(), 'nom' => $genre->getNom()]);

        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $genre->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            $logger->info('Genre modifié', ['id' => $genre->getId(), 'nom' => $genre->getNom()]);

            return $this->redirectToRoute('app_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genre/edit.html.twig', [
            'genre' => $genre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_delete', methods: ['POST'])]
    public function delete(Request $request, Genre $genre, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        if ($this->isCsrfTokenValid('delete' . $genre->getId(), $request->getPayload()->getString('_token'))) {
            $logger->info('Suppression d\'un genre', ['id' => $genre->getId(), 'nom' => $genre->getNom()]);

            $entityManager->remove($genre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_genre_index', [], Response::HTTP_SEE_OTHER);
    }
}
