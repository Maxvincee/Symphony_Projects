<?php

namespace App\Controller;

use App\Entity\Developpeur;
use App\Form\DeveloppeurType;
use App\Repository\DeveloppeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/developpeur')]
final class DeveloppeurController extends AbstractController
{
    #[Route(name: 'app_developpeur_index', methods: ['GET'])]
    public function index(DeveloppeurRepository $developpeurRepository, LoggerInterface $logger): Response
    {
        $logger->info('Accès à la liste des développeurs');

        return $this->render('developpeur/index.html.twig', [
            'developpeurs' => $developpeurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_developpeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire d\'ajout d\'un développeur');

        $developpeur = new Developpeur();
        $developpeur->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(DeveloppeurType::class, $developpeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($developpeur);
            $entityManager->flush();

            $logger->info('Nouveau développeur créé', ['id' => $developpeur->getId(), 'nom' => $developpeur->getNom()]);

            return $this->redirectToRoute('app_developpeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('developpeur/new.html.twig', [
            'developpeur' => $developpeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_developpeur_show', methods: ['GET'])]
    public function show(Developpeur $developpeur, LoggerInterface $logger): Response
    {
        $logger->info('Consultation d\'un développeur', ['id' => $developpeur->getId(), 'nom' => $developpeur->getNom()]);

        return $this->render('developpeur/show.html.twig', [
            'developpeur' => $developpeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_developpeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Developpeur $developpeur, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire de modification d\'un développeur', ['id' => $developpeur->getId(), 'nom' => $developpeur->getNom()]);

        $form = $this->createForm(DeveloppeurType::class, $developpeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $developpeur->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            $logger->info('Développeur modifié', ['id' => $developpeur->getId(), 'nom' => $developpeur->getNom()]);

            return $this->redirectToRoute('app_developpeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('developpeur/edit.html.twig', [
            'developpeur' => $developpeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_developpeur_delete', methods: ['POST'])]
    public function delete(Request $request, Developpeur $developpeur, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        if ($this->isCsrfTokenValid('delete' . $developpeur->getId(), $request->getPayload()->getString('_token'))) {
            $logger->info('Suppression d\'un développeur', ['id' => $developpeur->getId(), 'nom' => $developpeur->getNom()]);

            $entityManager->remove($developpeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_developpeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
