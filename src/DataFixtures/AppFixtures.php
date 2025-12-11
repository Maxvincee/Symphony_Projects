<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Editeur;
use App\Entity\Developpeur;
use App\Entity\JeuVideo;
use App\Entity\Utilisateur;
use App\Entity\Collect;
use App\Enum\StatutJeuEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ========================================================================= //
        // 1. CRÉATION DES GENRES
        // ========================================================================= //

        $genresData = [
            ['nom' => 'Action', 'description' => 'Jeux de plateforme, combat, tir (FPS, TPS...).'],
            ['nom' => 'Aventure', 'description' => 'Jeux d\'aventure narrative, point and click...'],
            ['nom' => 'Action-Aventure', 'description' => 'Infiltration, survival horror...'],
            ['nom' => 'RPG', 'description' => 'Jeux de rôle, MMORPG...'],
            ['nom' => 'Stratégie', 'description' => 'RTS, tour par tour, wargame...'],
            ['nom' => 'Simulation', 'description' => 'Jeux de simulation (vie, véhicule), gestion...'],
            ['nom' => 'Sport', 'description' => 'Jeux de football, basket, tennis...'],
            ['nom' => 'Course', 'description' => 'Compétition automobile, moto, futuriste...'],
            ['nom' => 'Réflexion', 'description' => 'Puzzles, énigmes, casse-tête...'],
        ];

        $genres = [];
        foreach ($genresData as $data) {
            $genre = new Genre();
            $genre->setNom($data['nom']);
            $genre->setDescription($data['description']);
            $genre->setActif(true);
            $genre->setCreatedAt(new DateTimeImmutable());
            $manager->persist($genre);
            $genres[$data['nom']] = $genre; // On stocke pour réutilisation
        }

        // ========================================================================= //
        // 2. CRÉATION DES ÉDITEURS (AVEC DESCRIPTIONS MAINTENANT !)
        // ========================================================================= //

        $editeursData = [
            [
                'nom' => 'Nintendo',
                'pays' => 'Japon',
                'site' => 'https://www.nintendo.fr',
                'description' => 'Multinationale japonaise fondée en 1889, Nintendo est l\'un des leaders mondiaux du jeu vidéo, célèbre pour ses franchises Mario, Zelda et Pokémon.'
            ],
            [
                'nom' => 'Ubisoft',
                'pays' => 'France',
                'site' => 'https://www.ubisoft.com',
                'description' => 'Entreprise française de développement et d\'édition, connue pour des mondes ouverts immersifs comme Assassin\'s Creed, Far Cry et Watch Dogs.'
            ],
            [
                'nom' => 'Electronic Arts',
                'pays' => 'USA',
                'site' => 'https://www.ea.com',
                'description' => 'Leader américain du divertissement interactif, EA est incontournable dans les jeux de sport (EA FC, Madden) et les simulations (Les Sims).'
            ],
            [
                'nom' => 'Sony Interactive Entertainment',
                'pays' => 'Japon',
                'site' => 'https://www.sie.com',
                'description' => 'Filiale du groupe Sony, elle gère la marque PlayStation et produit des exclusivités majeures acclamées par la critique.'
            ],
            [
                'nom' => 'Rockstar Games',
                'pays' => 'USA',
                'site' => 'https://www.rockstargames.com',
                'description' => 'Célèbre pour ses jeux en monde ouvert provocateurs et détaillés, notamment les séries Grand Theft Auto et Red Dead Redemption.'
            ],
            [
                'nom' => 'CD Projekt',
                'pays' => 'Pologne',
                'site' => 'https://en.cdprojektred.com',
                'description' => 'Studio polonais mondialement reconnu pour ses RPG narratifs profonds, en particulier la saga The Witcher et Cyberpunk 2077.'
            ],
            [
                'nom' => 'Square Enix',
                'pays' => 'Japon',
                'site' => 'https://www.square-enix-games.com',
                'description' => 'Société japonaise spécialisée dans les jeux de rôle (RPG), célèbre pour les franchises Final Fantasy, Dragon Quest et Kingdom Hearts.'
            ],
            [
                'nom' => 'FromSoftware',
                'pays' => 'Japon',
                'site' => 'https://www.fromsoftware.jp',
                'description' => 'Studio japonais réputé pour la difficulté exigeante de ses jeux et ses univers sombres, créateur du genre "Souls-like" (Elden Ring, Dark Souls).'
            ],
            [
                'nom' => 'Xbox Game Studios',
                'pays' => 'USA',
                'site' => 'https://www.xbox.com/fr-FR/xbox-game-studios',
                'description' => 'La branche de production de jeux vidéo de Microsoft, regroupant de nombreux studios talentueux pour alimenter l\'écosystème Xbox.'
            ],
            [
                'nom' => 'Capcom',
                'pays' => 'Japon',
                'site' => 'https://www.capcom.com',
                'description' => 'Développeur et éditeur japonais historique, créateur de franchises cultes comme Resident Evil, Street Fighter et Monster Hunter.'
            ],
            [
                'nom' => 'Activision',
                'pays' => 'USA',
                'site' => 'https://www.activision.com',
                'description' => 'Un des plus grands éditeurs américains, principalement connu pour la franchise de tir à la première personne ultra-populaire Call of Duty.'
            ],
        ];

        $editeurs = [];
        foreach ($editeursData as $data) {
            $editeur = new Editeur();
            $editeur->setNom($data['nom']);
            $editeur->setPays($data['pays']);
            $editeur->setSiteWeb($data['site']);
            // C'est ici qu'on ajoute la description !
            $editeur->setDescription($data['description']);
            $editeur->setCreatedAt(new DateTimeImmutable());
            $manager->persist($editeur);
            $editeurs[$data['nom']] = $editeur;
        }

        // ========================================================================= //
        // 3. CRÉATION DES DÉVELOPPEURS
        // ========================================================================= //

        $developpeursData = [
            ['nom' => 'Nintendo EPD'],
            ['nom' => 'Ubisoft Bordeaux'],
            ['nom' => 'EA Vancouver'],
            ['nom' => 'Maxis'],
            ['nom' => 'Naughty Dog'],
            ['nom' => 'Rockstar North'],
            ['nom' => 'CD Projekt Red'],
            ['nom' => 'Guerrilla Games'],
            ['nom' => 'FromSoftware'],
            ['nom' => 'Sucker Punch Productions'],
            ['nom' => 'Insomniac Games'],
            ['nom' => 'Square Enix'],
            ['nom' => 'Mojang Studios'],
            ['nom' => 'Playground Games'],
            ['nom' => 'Capcom'],
            ['nom' => 'Infinity Ward'],
            ['nom' => 'Remedy Entertainment'],
        ];

        $developpeurs = [];
        foreach ($developpeursData as $data) {
            $dev = new Developpeur();
            $dev->setNom($data['nom']);
            $dev->setCreatedAt(new DateTimeImmutable());
            $manager->persist($dev);
            $developpeurs[$data['nom']] = $dev;
        }

        // ========================================================================= //
        // 4. CRÉATION DES JEUX VIDÉO
        // ========================================================================= //

        $jeuxData = [
            ['titre' => 'Mario Kart 8 Deluxe', 'prix' => 49.99, 'date' => '2017-04-28', 'desc' => 'Le meilleur jeu de course arcade sur Switch.', 'genre' => 'Course', 'editeur' => 'Nintendo', 'dev' => 'Nintendo EPD'],
            ['titre' => 'Assassin\'s Creed Mirage', 'prix' => 39.99, 'date' => '2023-10-05', 'desc' => 'Retour aux sources de l\'infiltration à Bagdad.', 'genre' => 'Action-Aventure', 'editeur' => 'Ubisoft', 'dev' => 'Ubisoft Bordeaux'],
            ['titre' => 'EA Sports FC 24', 'prix' => 69.99, 'date' => '2023-09-29', 'desc' => 'La référence du football, anciennement FIFA.', 'genre' => 'Sport', 'editeur' => 'Electronic Arts', 'dev' => 'EA Vancouver'],
            ['titre' => 'The Legend of Zelda: Breath of the Wild', 'prix' => 59.99, 'date' => '2017-03-03', 'desc' => 'Une aventure épique dans un monde ouvert gigantesque.', 'genre' => 'Aventure', 'editeur' => 'Nintendo', 'dev' => 'Nintendo EPD'],
            ['titre' => 'Les Sims 4', 'prix' => 0.00, 'date' => '2014-09-02', 'desc' => 'Simulation de vie ultime.', 'genre' => 'Simulation', 'editeur' => 'Electronic Arts', 'dev' => 'Maxis'],
            ['titre' => 'The Last of Us Part II', 'prix' => 39.99, 'date' => '2020-06-19', 'desc' => 'Ellie se lance dans une quête de vengeance implacable.', 'genre' => 'Action-Aventure', 'editeur' => 'Sony Interactive Entertainment', 'dev' => 'Naughty Dog'],
            ['titre' => 'Grand Theft Auto V', 'prix' => 29.99, 'date' => '2013-09-17', 'desc' => 'Explorez le monde ouvert de Los Santos et Blaine County.', 'genre' => 'Action-Aventure', 'editeur' => 'Rockstar Games', 'dev' => 'Rockstar North'],
            ['titre' => 'The Witcher 3: Wild Hunt', 'prix' => 39.99, 'date' => '2015-05-19', 'desc' => 'Incarnez Geralt de Riv, un chasseur de monstres.', 'genre' => 'RPG', 'editeur' => 'CD Projekt', 'dev' => 'CD Projekt Red'],
            ['titre' => 'Cyberpunk 2077', 'prix' => 59.99, 'date' => '2020-12-10', 'desc' => 'Une aventure dans la mégalopole de Night City.', 'genre' => 'RPG', 'editeur' => 'CD Projekt', 'dev' => 'CD Projekt Red'],
            ['titre' => 'Red Dead Redemption 2', 'prix' => 59.99, 'date' => '2018-10-26', 'desc' => 'L\'histoire d\'Arthur Morgan et de la bande de Van der Linde.', 'genre' => 'Action-Aventure', 'editeur' => 'Rockstar Games', 'dev' => 'Rockstar North'],
            ['titre' => 'Horizon Zero Dawn', 'prix' => 19.99, 'date' => '2017-02-28', 'desc' => 'Aloy, une jeune chasseuse, explore un monde envahi par les machines.', 'genre' => 'Action-Aventure', 'editeur' => 'Sony Interactive Entertainment', 'dev' => 'Guerrilla Games'],
            ['titre' => 'Elden Ring', 'prix' => 69.99, 'date' => '2022-02-25', 'desc' => 'Un vaste monde fantastique créé par Hidetaka Miyazaki et George R. R. Martin.', 'genre' => 'RPG', 'editeur' => 'FromSoftware', 'dev' => 'FromSoftware'],
            ['titre' => 'Ghost of Tsushima', 'prix' => 49.99, 'date' => '2020-07-17', 'desc' => 'Devenez le "Fantôme" et défendez l\'île de Tsushima.', 'genre' => 'Action-Aventure', 'editeur' => 'Sony Interactive Entertainment', 'dev' => 'Sucker Punch Productions'],
            ['titre' => 'Marvel\'s Spider-Man', 'prix' => 39.99, 'date' => '2018-09-07', 'desc' => 'Incarnez un Spider-Man expérimenté luttant contre le crime à New York.', 'genre' => 'Action-Aventure', 'editeur' => 'Sony Interactive Entertainment', 'dev' => 'Insomniac Games'],
            ['titre' => 'Final Fantasy VII Remake', 'prix' => 69.99, 'date' => '2020-04-10', 'desc' => 'La réimagination du RPG emblématique avec des graphismes modernes.', 'genre' => 'RPG', 'editeur' => 'Square Enix', 'dev' => 'Square Enix'],
            ['titre' => 'Minecraft', 'prix' => 29.99, 'date' => '2011-11-18', 'desc' => 'Un jeu de type bac à sable où vous pouvez construire tout ce que vous imaginez.', 'genre' => 'Simulation', 'editeur' => 'Xbox Game Studios', 'dev' => 'Mojang Studios'],
            ['titre' => 'Forza Horizon 5', 'prix' => 69.99, 'date' => '2021-11-09', 'desc' => 'Explorez les paysages vibrants et évolutifs du Mexique.', 'genre' => 'Course', 'editeur' => 'Xbox Game Studios', 'dev' => 'Playground Games'],
            ['titre' => 'Resident Evil Village', 'prix' => 39.99, 'date' => '2021-05-07', 'desc' => 'Ethan Winters explore un village mystérieux à la recherche de sa fille.', 'genre' => 'Action-Aventure', 'editeur' => 'Capcom', 'dev' => 'Capcom'],
            ['titre' => 'Monster Hunter: World', 'prix' => 29.99, 'date' => '2018-01-26', 'desc' => 'Chassez des monstres gigantesques dans un monde vivant.', 'genre' => 'RPG', 'editeur' => 'Capcom', 'dev' => 'Capcom'],
            ['titre' => 'Call of Duty: Modern Warfare II', 'prix' => 69.99, 'date' => '2022-10-28', 'desc' => 'La Task Force 141 fait face à une nouvelle menace mondiale.', 'genre' => 'Action', 'editeur' => 'Activision', 'dev' => 'Infinity Ward'],
            ['titre' => 'Animal Crossing: New Horizons', 'prix' => 49.99, 'date' => '2020-03-20', 'desc' => 'Créez votre propre paradis insulaire.', 'genre' => 'Simulation', 'editeur' => 'Nintendo', 'dev' => 'Nintendo EPD'],
            ['titre' => 'Super Mario Odyssey', 'prix' => 49.99, 'date' => '2017-10-27', 'desc' => 'Mario explore de vastes royaumes en 3D à bord de l\'Odyssée.', 'genre' => 'Action', 'editeur' => 'Nintendo', 'dev' => 'Nintendo EPD'],
            ['titre' => 'God of War Ragnarök', 'prix' => 79.99, 'date' => '2022-11-09', 'desc' => 'Kratos et Atreus doivent voyager dans les Neuf Royaumes.', 'genre' => 'Action-Aventure', 'editeur' => 'Sony Interactive Entertainment', 'dev' => 'Naughty Dog'],
            ['titre' => 'Star Wars Jedi: Survivor', 'prix' => 69.99, 'date' => '2023-04-28', 'desc' => 'Cal Kestis continue son combat en tant que l\'un des derniers Jedi.', 'genre' => 'Action-Aventure', 'editeur' => 'Electronic Arts', 'dev' => 'Maxis'],
            ['titre' => 'It Takes Two', 'prix' => 39.99, 'date' => '2021-03-26', 'desc' => 'Un jeu d\'aventure et de plateforme exclusivement en coopération.', 'genre' => 'Action-Aventure', 'editeur' => 'Electronic Arts', 'dev' => 'Maxis'],
            ['titre' => 'Portal 2', 'prix' => 9.99, 'date' => '2011-04-19', 'desc' => 'Un jeu de réflexion à la première personne acclamé par la critique.', 'genre' => 'Réflexion', 'editeur' => 'Xbox Game Studios', 'dev' => 'Playground Games'],
            ['titre' => 'Stardew Valley', 'prix' => 13.99, 'date' => '2016-02-26', 'desc' => 'Créez la ferme de vos rêves dans cette simulation de vie rurale.', 'genre' => 'Simulation', 'editeur' => 'CD Projekt', 'dev' => 'CD Projekt Red'],
            ['titre' => 'Hades', 'prix' => 24.99, 'date' => '2020-09-17', 'desc' => 'Défiez le dieu des morts dans ce rogue-like divin.', 'genre' => 'Action', 'editeur' => 'Ubisoft', 'dev' => 'Ubisoft Bordeaux'],
            ['titre' => 'Control', 'prix' => 29.99, 'date' => '2019-08-27', 'desc' => 'Une aventure d\'action à la troisième personne surnaturelle.', 'genre' => 'Action-Aventure', 'editeur' => 'Sony Interactive Entertainment', 'dev' => 'Remedy Entertainment'],
            ['titre' => 'Street Fighter 6', 'prix' => 59.99, 'date' => '2023-06-02', 'desc' => 'Le dernier opus de la série de jeux de combat légendaire.', 'genre' => 'Action', 'editeur' => 'Capcom', 'dev' => 'Capcom'],
        ];

        foreach ($jeuxData as $data) {
            $jeu = new JeuVideo();
            $jeu->setTitre($data['titre']);
            $jeu->setPrix($data['prix']);
            $jeu->setDateSortie(new \DateTime($data['date']));
            $jeu->setDescription($data['desc']);
            $jeu->setCreatedAt(new DateTimeImmutable());
            $jeu->setGenre($genres[$data['genre']]);
            $jeu->setEditeur($editeurs[$data['editeur']]);
            $jeu->setDeveloppeur($developpeurs[$data['dev']]);
            $manager->persist($jeu);
            $jeux[] = $jeu; // Stocker pour les collections
        }

        // ========================================================================= //
        // 5. CRÉATION DES UTILISATEURS
        // ========================================================================= //

        $utilisateursData = [
            [
                'prenom' => 'Denis',
                'nom' => 'DUPONT',
                'pseudo' => 'denis_gamer',
                'mail' => 'denis.dupont@example.com',
                'dateNaissance' => '1995-03-15',
                'imageProfil' => 'https://i.pravatar.cc/150?img=12'
            ],
            [
                'prenom' => 'Marcelle',
                'nom' => 'DUMONT',
                'pseudo' => 'marcelle_rpg',
                'mail' => 'marcelle.dumont@example.com',
                'dateNaissance' => '1988-07-22',
                'imageProfil' => 'https://i.pravatar.cc/150?img=47'
            ],
            [
                'prenom' => 'Thomas',
                'nom' => 'MARTIN',
                'pseudo' => 'thomas_pro',
                'mail' => 'thomas.martin@example.com',
                'dateNaissance' => '2000-11-08',
                'imageProfil' => 'https://i.pravatar.cc/150?img=33'
            ],
            [
                'prenom' => 'Sophie',
                'nom' => 'BERNARD',
                'pseudo' => 'sophie_games',
                'mail' => 'sophie.bernard@example.com',
                'dateNaissance' => '1992-05-30',
                'imageProfil' => 'https://i.pravatar.cc/150?img=44'
            ],
            [
                'prenom' => 'Lucas',
                'nom' => 'PETIT',
                'pseudo' => 'lucas_player',
                'mail' => 'lucas.petit@example.com',
                'dateNaissance' => '1998-09-12',
                'imageProfil' => 'https://i.pravatar.cc/150?img=68'
            ],
            [
                'prenom' => 'Emma',
                'nom' => 'ROBERT',
                'pseudo' => 'emma_casual',
                'mail' => 'emma.robert@example.com',
                'dateNaissance' => '2002-01-25',
                'imageProfil' => null
            ],
        ];

        $utilisateurs = [];
        foreach ($utilisateursData as $data) {
            $user = new Utilisateur();
            $user->setPrenom($data['prenom']);
            $user->setNom($data['nom']);
            $user->setPseudo($data['pseudo']);
            $user->setMail($data['mail']);
            if ($data['dateNaissance']) {
                $user->setDateNaissance(new \DateTime($data['dateNaissance']));
            }
            $user->setImageProfil($data['imageProfil']);
            $manager->persist($user);
            $utilisateurs[] = $user;
        }

        // ========================================================================= //
        // 6. CRÉATION DES COLLECTIONS (COLLECT)
        // ========================================================================= //

        $statuts = [
            StatutJeuEnum::POSSEDE,
            StatutJeuEnum::SOUHAITE,
            StatutJeuEnum::EN_COURS,
            StatutJeuEnum::TERMINE,
            StatutJeuEnum::ABANDONNE,
            StatutJeuEnum::PRETE,
            StatutJeuEnum::VENDU,
            StatutJeuEnum::PLATINE,
        ];

        // Denis DUPONT - 8 jeux (indices 1, 7, 8, 10, 14, 18, 2, 11)
        $denisJeux = [
            ['jeu' => 1, 'statut' => StatutJeuEnum::EN_COURS, 'prix' => 49.99, 'date' => '2023-12-25', 'comment' => 'Cadeau de Noël, super fun !'],
            ['jeu' => 7, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 29.99, 'date' => '2020-05-10', 'comment' => 'Un chef-d\'œuvre absolu'],
            ['jeu' => 8, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 39.99, 'date' => '2021-06-15', 'comment' => 'Histoire incroyable'],
            ['jeu' => 10, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 19.99, 'date' => '2022-03-20', 'comment' => null],
            ['jeu' => 14, 'statut' => StatutJeuEnum::PLATINE, 'prix' => 39.99, 'date' => '2021-01-10', 'comment' => '100% complété !'],
            ['jeu' => 18, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 29.99, 'date' => '2023-08-05', 'comment' => null],
            ['jeu' => 2, 'statut' => StatutJeuEnum::SOUHAITE, 'prix' => null, 'date' => null, 'comment' => 'À acheter pendant les soldes'],
            ['jeu' => 11, 'statut' => StatutJeuEnum::ABANDONNE, 'prix' => 69.99, 'date' => '2022-03-01', 'comment' => 'Trop difficile pour moi'],
        ];

        foreach ($denisJeux as $data) {
            $collect = new Collect();
            $collect->setUtilisateur($utilisateurs[0]); // Denis
            $collect->setJeuvideo($jeux[$data['jeu']]);
            $collect->setStatut($data['statut']);
            if ($data['prix']) {
                $collect->setPrixAchat($data['prix']);
            }
            if ($data['date']) {
                $collect->setDateAchat(new \DateTime($data['date']));
            }
            $collect->setCommentaire($data['comment']);
            $manager->persist($collect);
        }

        // Marcelle DUMONT - 6 jeux (indices 7, 8, 10, 14, 1, 11)
        $marcelleJeux = [
            ['jeu' => 7, 'statut' => StatutJeuEnum::PLATINE, 'prix' => 39.99, 'date' => '2015-06-01', 'comment' => 'Mon jeu préféré de tous les temps'],
            ['jeu' => 8, 'statut' => StatutJeuEnum::EN_COURS, 'prix' => 59.99, 'date' => '2021-01-15', 'comment' => 'Magnifique graphiquement'],
            ['jeu' => 10, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 19.99, 'date' => '2017-04-10', 'comment' => null],
            ['jeu' => 14, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 69.99, 'date' => '2020-05-20', 'comment' => null],
            ['jeu' => 1, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 49.99, 'date' => '2023-11-30', 'comment' => 'Pour jouer en famille'],
            ['jeu' => 11, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 69.99, 'date' => '2022-04-15', 'comment' => 'Incroyable aventure'],
        ];

        foreach ($marcelleJeux as $data) {
            $collect = new Collect();
            $collect->setUtilisateur($utilisateurs[1]); // Marcelle
            $collect->setJeuvideo($jeux[$data['jeu']]);
            $collect->setStatut($data['statut']);
            if ($data['prix']) {
                $collect->setPrixAchat($data['prix']);
            }
            if ($data['date']) {
                $collect->setDateAchat(new \DateTime($data['date']));
            }
            $collect->setCommentaire($data['comment']);
            $manager->persist($collect);
        }

        // Thomas MARTIN - 7 jeux
        $thomasJeux = [
            ['jeu' => 2, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 39.99, 'date' => '2023-10-10', 'comment' => null],
            ['jeu' => 19, 'statut' => StatutJeuEnum::EN_COURS, 'prix' => 69.99, 'date' => '2022-11-15', 'comment' => 'Jeu épique'],
            ['jeu' => 12, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 49.99, 'date' => '2020-08-01', 'comment' => 'Magnifique'],
            ['jeu' => 13, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 39.99, 'date' => '2018-10-05', 'comment' => null],
            ['jeu' => 15, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 29.99, 'date' => '2023-01-20', 'comment' => 'Addictif'],
            ['jeu' => 3, 'statut' => StatutJeuEnum::PRETE, 'prix' => 69.99, 'date' => '2023-09-30', 'comment' => 'Prêté à mon frère'],
            ['jeu' => 20, 'statut' => StatutJeuEnum::SOUHAITE, 'prix' => null, 'date' => null, 'comment' => 'Liste de Noël'],
        ];

        foreach ($thomasJeux as $data) {
            $collect = new Collect();
            $collect->setUtilisateur($utilisateurs[2]); // Thomas
            $collect->setJeuvideo($jeux[$data['jeu']]);
            $collect->setStatut($data['statut']);
            if ($data['prix']) {
                $collect->setPrixAchat($data['prix']);
            }
            if ($data['date']) {
                $collect->setDateAchat(new \DateTime($data['date']));
            }
            $collect->setCommentaire($data['comment']);
            $manager->persist($collect);
        }

        // Sophie BERNARD - 9 jeux
        $sophieJeux = [
            ['jeu' => 4, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 0.00, 'date' => '2020-01-01', 'comment' => 'Jeu gratuit'],
            ['jeu' => 20, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 49.99, 'date' => '2020-03-25', 'comment' => 'Relaxant'],
            ['jeu' => 24, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 13.99, 'date' => '2019-05-10', 'comment' => 'Jeu zen'],
            ['jeu' => 5, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 39.99, 'date' => '2020-07-01', 'comment' => 'Émotionnellement intense'],
            ['jeu' => 23, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 9.99, 'date' => '2018-12-20', 'comment' => 'Génial'],
            ['jeu' => 25, 'statut' => StatutJeuEnum::EN_COURS, 'prix' => 24.99, 'date' => '2021-10-15', 'comment' => null],
            ['jeu' => 1, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 49.99, 'date' => '2022-06-10', 'comment' => null],
            ['jeu' => 16, 'statut' => StatutJeuEnum::VENDU, 'prix' => 69.99, 'date' => '2021-11-20', 'comment' => 'Revendu après avoir fini'],
            ['jeu' => 17, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 39.99, 'date' => '2021-06-01', 'comment' => null],
        ];

        foreach ($sophieJeux as $data) {
            $collect = new Collect();
            $collect->setUtilisateur($utilisateurs[3]); // Sophie
            $collect->setJeuvideo($jeux[$data['jeu']]);
            $collect->setStatut($data['statut']);
            if ($data['prix'] !== null) {
                $collect->setPrixAchat($data['prix']);
            }
            if ($data['date']) {
                $collect->setDateAchat(new \DateTime($data['date']));
            }
            $collect->setCommentaire($data['comment']);
            $manager->persist($collect);
        }

        // Lucas PETIT - 6 jeux
        $lucasJeux = [
            ['jeu' => 6, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 29.99, 'date' => '2015-01-10', 'comment' => 'Classique'],
            ['jeu' => 9, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 59.99, 'date' => '2018-11-01', 'comment' => 'Monde ouvert incroyable'],
            ['jeu' => 15, 'statut' => StatutJeuEnum::POSSEDE, 'prix' => 29.99, 'date' => '2022-05-15', 'comment' => 'Créativité sans limite'],
            ['jeu' => 18, 'statut' => StatutJeuEnum::TERMINE, 'prix' => 29.99, 'date' => '2019-02-20', 'comment' => null],
            ['jeu' => 27, 'statut' => StatutJeuEnum::SOUHAITE, 'prix' => null, 'date' => null, 'comment' => 'Envie d\'essayer'],
            ['jeu' => 11, 'statut' => StatutJeuEnum::EN_COURS, 'prix' => 69.99, 'date' => '2022-03-10', 'comment' => 'Difficile mais passionnant'],
        ];

        foreach ($lucasJeux as $data) {
            $collect = new Collect();
            $collect->setUtilisateur($utilisateurs[4]); // Lucas
            $collect->setJeuvideo($jeux[$data['jeu']]);
            $collect->setStatut($data['statut']);
            if ($data['prix']) {
                $collect->setPrixAchat($data['prix']);
            }
            if ($data['date']) {
                $collect->setDateAchat(new \DateTime($data['date']));
            }
            $collect->setCommentaire($data['comment']);
            $manager->persist($collect);
        }

        // Emma ROBERT - Aucun jeu (utilisateur sans collection)

        // ========================================================================= //
        // 7. ENVOI EN BASE DE DONNÉES
        // ========================================================================= //

        $manager->flush();
    }
}
