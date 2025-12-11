<?php

namespace App\Controller;

use App\Entity\JeuVideo;
use App\Form\JeuVideoType;
use App\Repository\JeuVideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/jeu_video')]
final class JeuVideoController extends AbstractController
{
    #[Route(name: 'app_jeu_video_index', methods: ['GET'])]
    public function index(JeuVideoRepository $jeuVideoRepository, LoggerInterface $logger): Response
    {
        $logger->info('Accès à la liste des jeux vidéo');

        return $this->render('jeu_video/index.html.twig', [
            'jeu_videos' => $jeuVideoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jeu_video_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire d\'ajout d\'un jeu vidéo');

        $jeuVideo = new JeuVideo();
        // On initialise la date de création
        $jeuVideo->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(JeuVideoType::class, $jeuVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère l'image et on l'upload
            $imageFile = $form->get('imageFile')->getData();
            $newFilename = $this->uploadImage($imageFile, $slugger);

            // Si on a récupéré un nom de fichier, on met à jour le jeu
            if ($newFilename) {
                $jeuVideo->setImageUrl($newFilename);
            }

            $entityManager->persist($jeuVideo);
            $entityManager->flush();

            $logger->info('Nouveau jeu vidéo créé', [
                'id' => $jeuVideo->getId(),
                'titre' => $jeuVideo->getTitre()
            ]);

            return $this->redirectToRoute('app_jeu_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeu_video/new.html.twig', [
            'jeu_video' => $jeuVideo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jeu_video_show', methods: ['GET'])]
    public function show(JeuVideo $jeuVideo, LoggerInterface $logger): Response
    {
        $logger->info('Consultation d\'un jeu vidéo', [
            'id' => $jeuVideo->getId(),
            'titre' => $jeuVideo->getTitre()
        ]);

        return $this->render('jeu_video/show.html.twig', [
            'jeu_video' => $jeuVideo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jeu_video_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JeuVideo $jeuVideo, EntityManagerInterface $entityManager, SluggerInterface $slugger, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire de modification d\'un jeu vidéo', [
            'id' => $jeuVideo->getId(),
            'titre' => $jeuVideo->getTitre()
        ]);

        $form = $this->createForm(JeuVideoType::class, $jeuVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('imageFile')->getData();
            $newFilename = $this->uploadImage($imageFile, $slugger);

            if ($newFilename) {
                $jeuVideo->setImageUrl($newFilename);
            }

            // On met à jour la date de modification
            $jeuVideo->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            $logger->info('Jeu vidéo modifié', [
                'id' => $jeuVideo->getId(),
                'titre' => $jeuVideo->getTitre()
            ]);

            return $this->redirectToRoute('app_jeu_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeu_video/edit.html.twig', [
            'jeu_video' => $jeuVideo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jeu_video_delete', methods: ['POST'])]
    public function delete(Request $request, JeuVideo $jeuVideo, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jeuVideo->getId(), $request->getPayload()->getString('_token'))) {
            $logger->info('Suppression d\'un jeu vidéo', [
                'id' => $jeuVideo->getId(),
                'titre' => $jeuVideo->getTitre()
            ]);

            $entityManager->remove($jeuVideo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jeu_video_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Une fonction privée pour gérer l'upload sans répéter le code
     */
    private function uploadImage($imageFile, SluggerInterface $slugger): ?string
    {
        // Si il y a pas d'image, on ne fait rien
        if (!$imageFile) {
            return null;
        }

        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        // On nettoie le nom du fichier (On supprime tout ce qui es accents, espaces, etc)
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

        try {
            $imageFile->move(
                $this->getParameter('kernel.project_dir') . '/public/uploads',
                $newFilename
            );
        } catch (FileException $e) {
            // Gestion des erreurs si nécessaire
            return null;
        }

        return $newFilename;
    }
}
