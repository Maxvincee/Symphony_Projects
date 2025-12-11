<?php

namespace App\Controller;

use App\Entity\Editeur;
use App\Form\EditeurType;
use App\Repository\EditeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/editeur')]
final class EditeurController extends AbstractController
{
    #[Route(name: 'app_editeur_index', methods: ['GET'])]
    public function index(EditeurRepository $editeurRepository, LoggerInterface $logger): Response
    {
        $logger->info('Accès à la liste des éditeurs');

        return $this->render('editeur/index.html.twig', [
            'editeurs' => $editeurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_editeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire d\'ajout d\'un éditeur');

        $editeur = new Editeur();
        $editeur->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(EditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($editeur);
            $entityManager->flush();

            $logger->info('Nouvel éditeur créé', ['id' => $editeur->getId(), 'nom' => $editeur->getNom()]);

            return $this->redirectToRoute('app_editeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('editeur/new.html.twig', [
            'editeur' => $editeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_editeur_show', methods: ['GET'])]
    public function show(Editeur $editeur, LoggerInterface $logger): Response
    {
        $logger->info('Consultation d\'un éditeur', ['id' => $editeur->getId(), 'nom' => $editeur->getNom()]);

        return $this->render('editeur/show.html.twig', [
            'editeur' => $editeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_editeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Editeur $editeur, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $logger->info('Accès au formulaire de modification d\'un éditeur', ['id' => $editeur->getId(), 'nom' => $editeur->getNom()]);

        $form = $this->createForm(EditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editeur->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            $logger->info('Éditeur modifié', ['id' => $editeur->getId(), 'nom' => $editeur->getNom()]);

            return $this->redirectToRoute('app_editeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('editeur/edit.html.twig', [
            'editeur' => $editeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_editeur_delete', methods: ['POST'])]
    public function delete(Request $request, Editeur $editeur, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        if ($this->isCsrfTokenValid('delete' . $editeur->getId(), $request->getPayload()->getString('_token'))) {
            $logger->info('Suppression d\'un éditeur', ['id' => $editeur->getId(), 'nom' => $editeur->getNom()]);

            $entityManager->remove($editeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_editeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
