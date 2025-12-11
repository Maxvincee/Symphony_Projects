<?php

namespace App\Controller;

use App\Entity\Collect;
use App\Entity\Utilisateur;
use App\Form\CollectType;
use App\Repository\CollectRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/collect')]
final class CollectController extends AbstractController
{
    #[Route(name: 'app_collect_index', methods: ['GET'])]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        // Récupérer tous les utilisateurs avec leurs collections
        $utilisateurs = $utilisateurRepository->findAll();

        return $this->render('collect/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    #[Route('/utilisateur/{id}', name: 'app_collect_show_user', methods: ['GET'])]
    public function showUserCollection(Utilisateur $utilisateur): Response
    {
        return $this->render('collect/show.html.twig', [
            'utilisateur' => $utilisateur,
            'collects' => $utilisateur->getCollects(),
        ]);
    }

    #[Route('/new', name: 'app_collect_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $collect = new Collect();
        $form = $this->createForm(CollectType::class, $collect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collect->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($collect);
            $entityManager->flush();

            // Rediriger vers la collection de l'utilisateur
            return $this->redirectToRoute('app_collect_show_user', [
                'id' => $collect->getUtilisateur()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collect/new.html.twig', [
            'collect' => $collect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_collect_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collect $collect, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollectType::class, $collect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collect->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            // Rediriger vers la collection de l'utilisateur
            return $this->redirectToRoute('app_collect_show_user', [
                'id' => $collect->getUtilisateur()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collect/edit.html.twig', [
            'collect' => $collect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collect_delete', methods: ['POST'])]
    public function delete(Request $request, Collect $collect, EntityManagerInterface $entityManager): Response
    {
        $utilisateurId = $collect->getUtilisateur()->getId();

        if ($this->isCsrfTokenValid('delete' . $collect->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($collect);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_collect_show_user', [
            'id' => $utilisateurId
        ], Response::HTTP_SEE_OTHER);
    }
}
