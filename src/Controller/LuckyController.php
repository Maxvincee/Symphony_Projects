<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//route globale au controlleur
#[Route('/lucky')]
class LuckyController extends AbstractController {
    // Route de la fonction
    #[Route('/number', 'lucky_number', methods: ['GET', 'POST'])]
    public function number(): Response {
        $number = random_int(0, 100);
        return $this->render('lucky/number.html.twig', [
                'number' => $number,
        ]);
    }
}
