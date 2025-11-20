<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Editeur;
use App\Entity\JeuVideo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ======================================================
        // 1. CRÉATION DES GENRES (La liste demandée dans le TP)
        // ======================================================

        // On crée des variables ($genreAction, $genreRpg...) pour pouvoir s'en servir plus bas

        $genreAction = new Genre();
        $genreAction->setNom('Action');
        $genreAction->setDescription('Jeux de plateforme, combat, tir (FPS, TPS...)');
        $genreAction->setActif(true);
        $genreAction->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreAction);

        $genreAventure = new Genre();
        $genreAventure->setNom('Aventure');
        $genreAventure->setDescription('Jeux d\'aventure narrative, point and click...');
        $genreAventure->setActif(true);
        $genreAventure->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreAventure);

        $genreActionAventure = new Genre();
        $genreActionAventure->setNom('Action-Aventure');
        $genreActionAventure->setDescription('Infiltration, survival horror...');
        $genreActionAventure->setActif(true);
        $genreActionAventure->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreActionAventure);

        $genreRpg = new Genre();
        $genreRpg->setNom('RPG');
        $genreRpg->setDescription('Jeux de rôle, MMORPG...');
        $genreRpg->setActif(true);
        $genreRpg->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreRpg);

        $genreStrategie = new Genre();
        $genreStrategie->setNom('Stratégie');
        $genreStrategie->setDescription('RTS, tour par tour, wargame...');
        $genreStrategie->setActif(true);
        $genreStrategie->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreStrategie);

        $genreSimulation = new Genre();
        $genreSimulation->setNom('Simulation');
        $genreSimulation->setDescription('Jeux de simulation (vie, véhicule), gestion...');
        $genreSimulation->setActif(true);
        $genreSimulation->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreSimulation);

        $genreSport = new Genre();
        $genreSport->setNom('Sport');
        $genreSport->setDescription('Jeux de football, basket, tennis...');
        $genreSport->setActif(true);
        $genreSport->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreSport);

        $genreCourse = new Genre();
        $genreCourse->setNom('Course');
        $genreCourse->setDescription('Compétition automobile, moto, futuriste...');
        $genreCourse->setActif(true);
        $genreCourse->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreCourse);

        $genreReflexion = new Genre();
        $genreReflexion->setNom('Réflexion');
        $genreReflexion->setDescription('Puzzles, énigmes, casse-tête...');
        $genreReflexion->setActif(true);
        $genreReflexion->setCreatedAt(new DateTimeImmutable());
        $manager->persist($genreReflexion);


        // ======================================================
        // 2. CRÉATION DES ÉDITEURS
        // ======================================================

        $editNintendo = new Editeur();
        $editNintendo->setNom('Nintendo');
        $editNintendo->setPays('Japon');
        $editNintendo->setSiteWeb('https://www.nintendo.fr');
        $editNintendo->setDescription('Le papa de Mario et Zelda.');
        $editNintendo->setCreatedAt(new DateTimeImmutable());
        $manager->persist($editNintendo);

        $editUbisoft = new Editeur();
        $editUbisoft->setNom('Ubisoft');
        $editUbisoft->setPays('France');
        $editUbisoft->setSiteWeb('https://www.ubisoft.com');
        $editUbisoft->setCreatedAt(new DateTimeImmutable());
        $manager->persist($editUbisoft);

        $editEA = new Editeur();
        $editEA->setNom('Electronic Arts');
        $editEA->setPays('USA');
        $editEA->setSiteWeb('https://www.ea.com');
        $editEA->setCreatedAt(new DateTimeImmutable());
        $manager->persist($editEA);


        // ======================================================
        // 3. CRÉATION DES JEUX VIDÉO (Reliés aux genres et éditeurs)
        // ======================================================

        // Jeu 1 : Mario Kart (Course / Nintendo)
        $jeu1 = new JeuVideo();
        $jeu1->setTitre('Mario Kart 8 Deluxe');
        $jeu1->setDeveloppeur('Nintendo EPD');
        $jeu1->setPrix(49.99);
        $jeu1->setDateSortie(new \DateTime('2017-04-28'));
        $jeu1->setDescription('Le meilleur jeu de course arcade sur Switch.');
        $jeu1->setCreatedAt(new DateTimeImmutable());
        $jeu1->setGenre($genreCourse);   // On utilise la variable créée plus haut
        $jeu1->setEditeur($editNintendo); // On utilise l'éditeur créé plus haut
        $manager->persist($jeu1);

        // Jeu 2 : Assassin's Creed (Action-Aventure / Ubisoft)
        $jeu2 = new JeuVideo();
        $jeu2->setTitre('Assassin\'s Creed Mirage');
        $jeu2->setDeveloppeur('Ubisoft Bordeaux');
        $jeu2->setPrix(39.99);
        $jeu2->setDateSortie(new \DateTime('2023-10-05'));
        $jeu2->setDescription('Retour aux sources de l\'infiltration à Bagdad.');
        $jeu2->setCreatedAt(new DateTimeImmutable());
        $jeu2->setGenre($genreActionAventure);
        $jeu2->setEditeur($editUbisoft);
        $manager->persist($jeu2);

        // Jeu 3 : FC 24 (Sport / EA)
        $jeu3 = new JeuVideo();
        $jeu3->setTitre('EA Sports FC 24');
        $jeu3->setDeveloppeur('EA Vancouver');
        $jeu3->setPrix(69.99);
        $jeu3->setDateSortie(new \DateTime('2023-09-29'));
        $jeu3->setDescription('La référence du football, anciennement FIFA.');
        $jeu3->setCreatedAt(new DateTimeImmutable());
        $jeu3->setGenre($genreSport);
        $jeu3->setEditeur($editEA);
        $manager->persist($jeu3);

        // Jeu 4 : The Legend of Zelda (Aventure / Nintendo)
        $jeu4 = new JeuVideo();
        $jeu4->setTitre('The Legend of Zelda: Breath of the Wild');
        $jeu4->setDeveloppeur('Nintendo EPD');
        $jeu4->setPrix(59.99);
        $jeu4->setDateSortie(new \DateTime('2017-03-03'));
        $jeu4->setDescription('Une aventure épique dans un monde ouvert gigantesque.');
        $jeu4->setCreatedAt(new DateTimeImmutable());
        $jeu4->setGenre($genreAventure);
        $jeu4->setEditeur($editNintendo);
        $manager->persist($jeu4);

        // Jeu 5 : Les Sims 4 (Simulation / EA)
        $jeu5 = new JeuVideo();
        $jeu5->setTitre('Les Sims 4');
        $jeu5->setDeveloppeur('Maxis');
        $jeu5->setPrix(0.00); // Free to play maintenant
        $jeu5->setDateSortie(new \DateTime('2014-09-02'));
        $jeu5->setDescription('Simulation de vie ultime.');
        $jeu5->setCreatedAt(new DateTimeImmutable());
        $jeu5->setGenre($genreSimulation);
        $jeu5->setEditeur($editEA);
        $manager->persist($jeu5);

        // 4. On envoie tout en BDD
        $manager->flush();
    }
}
