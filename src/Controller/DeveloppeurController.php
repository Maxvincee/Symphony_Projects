<?php

namespace App\Controller;

use App\Entity\Developpeur;
use App\Form\DeveloppeurType;
use App\Repository\DeveloppeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/developpeur')]
final class DeveloppeurController extends AbstractController
{
    #[Route(name: 'app_developpeur_index', methods: ['GET'])]
    public function index(DeveloppeurRepository $developpeurRepository): Response
    {
        return $this->render('developpeur/index.html.twig', [
            'developpeurs' => $developpeurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_developpeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $developpeur = new Developpeur();
        $form = $this->createForm(DeveloppeurType::class, $developpeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($developpeur);
            $entityManager->flush();

            return $this->redirectToRoute('app_developpeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('developpeur/new.html.twig', [
            'developpeur' => $developpeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_developpeur_show', methods: ['GET'])]
    public function show(Developpeur $developpeur): Response
    {
        return $this->render('developpeur/show.html.twig', [
            'developpeur' => $developpeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_developpeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Developpeur $developpeur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeveloppeurType::class, $developpeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_developpeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('developpeur/edit.html.twig', [
            'developpeur' => $developpeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_developpeur_delete', methods: ['POST'])]
    public function delete(Request $request, Developpeur $developpeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$developpeur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($developpeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_developpeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
