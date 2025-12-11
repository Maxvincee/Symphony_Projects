-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           11.8.5-MariaDB - MariaDB Server
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bdd_mon_projet
CREATE DATABASE IF NOT EXISTS `bdd_mon_projet` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `bdd_mon_projet`;

-- Listage de la structure de table bdd_mon_projet. collect
DROP TABLE IF EXISTS `collect`;
CREATE TABLE IF NOT EXISTS `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(20) NOT NULL,
  `date_modif_statut` datetime NOT NULL,
  `prix_achat` decimal(6,2) DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `commentaire` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `jeuvideo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A40662F4FB88E14F` (`utilisateur_id`),
  KEY `IDX_A40662F418E5E9D9` (`jeuvideo_id`),
  CONSTRAINT `FK_A40662F418E5E9D9` FOREIGN KEY (`jeuvideo_id`) REFERENCES `jeu_video` (`id`),
  CONSTRAINT `FK_A40662F4FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.collect : ~36 rows (environ)
INSERT INTO `collect` (`id`, `statut`, `date_modif_statut`, `prix_achat`, `date_achat`, `commentaire`, `created_at`, `updated_at`, `utilisateur_id`, `jeuvideo_id`) VALUES
	(1, 'EN_COURS', '2025-12-10 17:48:38', 49.99, '2023-12-25', 'Cadeau de Noël, super fun !', '2025-12-10 17:48:38', NULL, 1, 32),
	(2, 'TERMINE', '2025-12-10 17:48:38', 29.99, '2020-05-10', 'Un chef-d\'œuvre absolu', '2025-12-10 17:48:38', NULL, 1, 38),
	(3, 'TERMINE', '2025-12-10 17:48:38', 39.99, '2021-06-15', 'Histoire incroyable', '2025-12-10 17:48:38', NULL, 1, 39),
	(4, 'POSSEDE', '2025-12-10 17:48:38', 19.99, '2022-03-20', NULL, '2025-12-10 17:48:38', NULL, 1, 41),
	(5, 'PLATINE', '2025-12-10 17:48:38', 39.99, '2021-01-10', '100% complété !', '2025-12-10 17:48:38', NULL, 1, 45),
	(6, 'POSSEDE', '2025-12-10 17:48:38', 29.99, '2023-08-05', NULL, '2025-12-10 17:48:38', NULL, 1, 49),
	(7, 'SOUHAITE', '2025-12-10 17:48:38', NULL, NULL, 'À acheter pendant les soldes', '2025-12-10 17:48:38', NULL, 1, 33),
	(8, 'ABANDONNE', '2025-12-10 17:48:38', 69.99, '2022-03-01', 'Trop difficile pour moi', '2025-12-10 17:48:38', NULL, 1, 42),
	(9, 'PLATINE', '2025-12-10 17:48:38', 39.99, '2015-06-01', 'Mon jeu préféré de tous les temps', '2025-12-10 17:48:38', NULL, 2, 38),
	(10, 'EN_COURS', '2025-12-10 17:48:38', 59.99, '2021-01-15', 'Magnifique graphiquement', '2025-12-10 17:48:38', NULL, 2, 39),
	(11, 'TERMINE', '2025-12-10 17:48:38', 19.99, '2017-04-10', NULL, '2025-12-10 17:48:38', NULL, 2, 41),
	(12, 'POSSEDE', '2025-12-10 17:48:38', 69.99, '2020-05-20', NULL, '2025-12-10 17:48:38', NULL, 2, 45),
	(13, 'POSSEDE', '2025-12-10 17:48:38', 49.99, '2023-11-30', 'Pour jouer en famille', '2025-12-10 17:48:38', NULL, 2, 32),
	(14, 'TERMINE', '2025-12-10 17:48:38', 69.99, '2022-04-15', 'Incroyable aventure', '2025-12-10 17:48:38', NULL, 2, 42),
	(15, 'POSSEDE', '2025-12-10 17:48:38', 39.99, '2023-10-10', NULL, '2025-12-10 17:48:38', NULL, 3, 33),
	(16, 'EN_COURS', '2025-12-10 17:48:38', 69.99, '2022-11-15', 'Jeu épique', '2025-12-10 17:48:38', NULL, 3, 50),
	(17, 'TERMINE', '2025-12-10 17:48:38', 49.99, '2020-08-01', 'Magnifique', '2025-12-10 17:48:38', NULL, 3, 43),
	(18, 'POSSEDE', '2025-12-10 17:48:38', 39.99, '2018-10-05', NULL, '2025-12-10 17:48:38', NULL, 3, 44),
	(19, 'POSSEDE', '2025-12-10 17:48:38', 29.99, '2023-01-20', 'Addictif', '2025-12-10 17:48:38', NULL, 3, 46),
	(20, 'PRETE', '2025-12-10 17:48:38', 69.99, '2023-09-30', 'Prêté à mon frère', '2025-12-10 17:48:38', NULL, 3, 34),
	(21, 'SOUHAITE', '2025-12-10 17:48:38', NULL, NULL, 'Liste de Noël', '2025-12-10 17:48:38', NULL, 3, 51),
	(22, 'POSSEDE', '2025-12-10 17:48:38', 0.00, '2020-01-01', 'Jeu gratuit', '2025-12-10 17:48:38', NULL, 4, 35),
	(23, 'POSSEDE', '2025-12-10 17:48:38', 49.99, '2020-03-25', 'Relaxant', '2025-12-10 17:48:38', NULL, 4, 51),
	(24, 'POSSEDE', '2025-12-10 17:48:38', 13.99, '2019-05-10', 'Jeu zen', '2025-12-10 17:48:38', NULL, 4, 55),
	(25, 'TERMINE', '2025-12-10 17:48:38', 39.99, '2020-07-01', 'Émotionnellement intense', '2025-12-10 17:48:38', NULL, 4, 36),
	(26, 'POSSEDE', '2025-12-10 17:48:38', 9.99, '2018-12-20', 'Génial', '2025-12-10 17:48:38', NULL, 4, 54),
	(27, 'EN_COURS', '2025-12-10 17:48:38', 24.99, '2021-10-15', NULL, '2025-12-10 17:48:38', NULL, 4, 56),
	(28, 'POSSEDE', '2025-12-10 17:48:38', 49.99, '2022-06-10', NULL, '2025-12-10 17:48:38', NULL, 4, 32),
	(29, 'VENDU', '2025-12-10 17:48:38', 69.99, '2021-11-20', 'Revendu après avoir fini', '2025-12-10 17:48:38', NULL, 4, 47),
	(30, 'POSSEDE', '2025-12-10 17:48:38', 39.99, '2021-06-01', NULL, '2025-12-10 17:48:38', NULL, 4, 48),
	(31, 'POSSEDE', '2025-12-10 17:48:38', 29.99, '2015-01-10', 'Classique', '2025-12-10 17:48:38', NULL, 5, 37),
	(32, 'POSSEDE', '2025-12-10 17:48:38', 59.99, '2018-11-01', 'Monde ouvert incroyable', '2025-12-10 17:48:38', NULL, 5, 40),
	(33, 'POSSEDE', '2025-12-10 17:48:38', 29.99, '2022-05-15', 'Créativité sans limite', '2025-12-10 17:48:38', NULL, 5, 46),
	(34, 'TERMINE', '2025-12-10 17:48:38', 29.99, '2019-02-20', NULL, '2025-12-10 17:48:38', NULL, 5, 49),
	(35, 'SOUHAITE', '2025-12-10 17:48:38', NULL, NULL, 'Envie d\'essayer', '2025-12-10 17:48:38', NULL, 5, 58),
	(36, 'EN_COURS', '2025-12-10 17:48:38', 69.99, '2022-03-10', 'Difficile mais passionnant', '2025-12-10 17:48:38', NULL, 5, 42);

-- Listage de la structure de table bdd_mon_projet. developpeur
DROP TABLE IF EXISTS `developpeur`;
CREATE TABLE IF NOT EXISTS `developpeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.developpeur : ~17 rows (environ)
INSERT INTO `developpeur` (`id`, `nom`, `created_at`, `updated_at`) VALUES
	(18, 'Nintendo EPD', '2025-12-10 17:48:38', NULL),
	(19, 'Ubisoft Bordeaux', '2025-12-10 17:48:38', NULL),
	(20, 'EA Vancouver', '2025-12-10 17:48:38', NULL),
	(21, 'Maxis', '2025-12-10 17:48:38', NULL),
	(22, 'Naughty Dog', '2025-12-10 17:48:38', NULL),
	(23, 'Rockstar North', '2025-12-10 17:48:38', NULL),
	(24, 'CD Projekt Red', '2025-12-10 17:48:38', NULL),
	(25, 'Guerrilla Games', '2025-12-10 17:48:38', NULL),
	(26, 'FromSoftware', '2025-12-10 17:48:38', NULL),
	(27, 'Sucker Punch Productions', '2025-12-10 17:48:38', NULL),
	(28, 'Insomniac Games', '2025-12-10 17:48:38', NULL),
	(29, 'Square Enix', '2025-12-10 17:48:38', NULL),
	(30, 'Mojang Studios', '2025-12-10 17:48:38', NULL),
	(31, 'Playground Games', '2025-12-10 17:48:38', NULL),
	(32, 'Capcom', '2025-12-10 17:48:38', NULL),
	(33, 'Infinity Ward', '2025-12-10 17:48:38', NULL),
	(34, 'Remedy Entertainment', '2025-12-10 17:48:38', NULL);

-- Listage de la structure de table bdd_mon_projet. doctrine_migration_versions
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.doctrine_migration_versions : ~3 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20251120150655', '2025-11-27 15:10:59', 209),
	('DoctrineMigrations\\Version20251120154844', '2025-11-27 15:10:59', 186),
	('DoctrineMigrations\\Version20251210164556', '2025-12-10 17:46:16', 203);

-- Listage de la structure de table bdd_mon_projet. editeur
DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.editeur : ~11 rows (environ)
INSERT INTO `editeur` (`id`, `nom`, `pays`, `site_web`, `description`, `created_at`, `updated_at`) VALUES
	(13, 'Nintendo', 'Japon', 'https://www.nintendo.fr', 'Multinationale japonaise fondée en 1889, Nintendo est l\'un des leaders mondiaux du jeu vidéo, célèbre pour ses franchises Mario, Zelda et Pokémon.', '2025-12-10 17:48:38', NULL),
	(14, 'Ubisoft', 'France', 'https://www.ubisoft.com', 'Entreprise française de développement et d\'édition, connue pour des mondes ouverts immersifs comme Assassin\'s Creed, Far Cry et Watch Dogs.', '2025-12-10 17:48:38', NULL),
	(15, 'Electronic Arts', 'USA', 'https://www.ea.com', 'Leader américain du divertissement interactif, EA est incontournable dans les jeux de sport (EA FC, Madden) et les simulations (Les Sims).', '2025-12-10 17:48:38', NULL),
	(16, 'Sony Interactive Entertainment', 'Japon', 'https://www.sie.com', 'Filiale du groupe Sony, elle gère la marque PlayStation et produit des exclusivités majeures acclamées par la critique.', '2025-12-10 17:48:38', NULL),
	(17, 'Rockstar Games', 'USA', 'https://www.rockstargames.com', 'Célèbre pour ses jeux en monde ouvert provocateurs et détaillés, notamment les séries Grand Theft Auto et Red Dead Redemption.', '2025-12-10 17:48:38', NULL),
	(18, 'CD Projekt', 'Pologne', 'https://en.cdprojektred.com', 'Studio polonais mondialement reconnu pour ses RPG narratifs profonds, en particulier la saga The Witcher et Cyberpunk 2077.', '2025-12-10 17:48:38', NULL),
	(19, 'Square Enix', 'Japon', 'https://www.square-enix-games.com', 'Société japonaise spécialisée dans les jeux de rôle (RPG), célèbre pour les franchises Final Fantasy, Dragon Quest et Kingdom Hearts.', '2025-12-10 17:48:38', NULL),
	(20, 'FromSoftware', 'Japon', 'https://www.fromsoftware.jp', 'Studio japonais réputé pour la difficulté exigeante de ses jeux et ses univers sombres, créateur du genre "Souls-like" (Elden Ring, Dark Souls).', '2025-12-10 17:48:38', NULL),
	(21, 'Xbox Game Studios', 'USA', 'https://www.xbox.com/fr-FR/xbox-game-studios', 'La branche de production de jeux vidéo de Microsoft, regroupant de nombreux studios talentueux pour alimenter l\'écosystème Xbox.', '2025-12-10 17:48:38', NULL),
	(22, 'Capcom', 'Japon', 'https://www.capcom.com', 'Développeur et éditeur japonais historique, créateur de franchises cultes comme Resident Evil, Street Fighter et Monster Hunter.', '2025-12-10 17:48:38', NULL),
	(23, 'Activision', 'USA', 'https://www.activision.com', 'Un des plus grands éditeurs américains, principalement connu pour la franchise de tir à la première personne ultra-populaire Call of Duty.', '2025-12-10 17:48:38', NULL);

-- Listage de la structure de table bdd_mon_projet. genre
DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` longtext DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.genre : ~9 rows (environ)
INSERT INTO `genre` (`id`, `nom`, `description`, `actif`, `created_at`, `updated_at`) VALUES
	(10, 'Action', 'Jeux de plateforme, combat, tir (FPS, TPS...).', 1, '2025-12-10 17:48:38', NULL),
	(11, 'Aventure', 'Jeux d\'aventure narrative, point and click...', 1, '2025-12-10 17:48:38', NULL),
	(12, 'Action-Aventure', 'Infiltration, survival horror...', 1, '2025-12-10 17:48:38', NULL),
	(13, 'RPG', 'Jeux de rôle, MMORPG...', 1, '2025-12-10 17:48:38', NULL),
	(14, 'Stratégie', 'RTS, tour par tour, wargame...', 1, '2025-12-10 17:48:38', NULL),
	(15, 'Simulation', 'Jeux de simulation (vie, véhicule), gestion...', 1, '2025-12-10 17:48:38', NULL),
	(16, 'Sport', 'Jeux de football, basket, tennis...', 1, '2025-12-10 17:48:38', NULL),
	(17, 'Course', 'Compétition automobile, moto, futuriste...', 1, '2025-12-10 17:48:38', NULL),
	(18, 'Réflexion', 'Puzzles, énigmes, casse-tête...', 1, '2025-12-10 17:48:38', NULL);

-- Listage de la structure de table bdd_mon_projet. jeu_video
DROP TABLE IF EXISTS `jeu_video`;
CREATE TABLE IF NOT EXISTS `jeu_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `date_sortie` date DEFAULT NULL,
  `prix` decimal(6,2) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `editeur_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `developpeur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E22D9D43375BD21` (`editeur_id`),
  KEY `IDX_4E22D9D44296D31F` (`genre_id`),
  KEY `IDX_4E22D9D484E66085` (`developpeur_id`),
  CONSTRAINT `FK_4E22D9D43375BD21` FOREIGN KEY (`editeur_id`) REFERENCES `editeur` (`id`),
  CONSTRAINT `FK_4E22D9D44296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`),
  CONSTRAINT `FK_4E22D9D484E66085` FOREIGN KEY (`developpeur_id`) REFERENCES `developpeur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.jeu_video : ~30 rows (environ)
INSERT INTO `jeu_video` (`id`, `titre`, `date_sortie`, `prix`, `description`, `image_url`, `created_at`, `updated_at`, `editeur_id`, `genre_id`, `developpeur_id`) VALUES
	(31, 'Mario Kart 8 Deluxe', '2017-04-28', 49.99, 'Le meilleur jeu de course arcade sur Switch.', '1658494663-368-card-6939bbaea7e1f.webp', '2025-12-10 17:48:38', '2025-12-10 19:27:58', 13, 17, 18),
	(32, 'Assassin\'s Creed Mirage', '2023-10-05', 39.99, 'Retour aux sources de l\'infiltration à Bagdad.', 'assassins-creed-mirage-889x500-6939bb438ae46.jpg', '2025-12-10 17:48:38', '2025-12-10 19:26:11', 14, 12, 19),
	(33, 'EA Sports FC 24', '2023-09-29', 69.99, 'La référence du football, anciennement FIFA.', 'jaquette-jeu-video-FC-24-erling-haaland-ea-sports-6939bb5e3ebe0.png', '2025-12-10 17:48:38', '2025-12-10 19:26:38', 15, 16, 20),
	(34, 'The Legend of Zelda: Breath of the Wild', '2017-03-03', 59.99, 'Une aventure épique dans un monde ouvert gigantesque.', 'TheLegendOfZeldaBreathOfTheWild-6939bc398be26.jpg', '2025-12-10 17:48:38', '2025-12-10 19:30:17', 13, 11, 18),
	(35, 'Les Sims 4', '2014-09-02', 0.00, 'Simulation de vie ultime.', 'Sims4-6939bbf57e636.png', '2025-12-10 17:48:38', '2025-12-10 19:29:09', 15, 15, 21),
	(36, 'The Last of Us Part II', '2020-06-19', 39.99, 'Ellie se lance dans une quête de vengeance implacable.', 'looking-for-the-last-of-us-part-2-remastered-box-art-in-v0-zx0pws3zo8ec1-6939bb7b4161b.webp', '2025-12-10 17:48:38', '2025-12-10 19:27:07', 16, 12, 22),
	(37, 'Grand Theft Auto V', '2013-09-17', 29.99, 'Explorez le monde ouvert de Los Santos et Blaine County.', NULL, '2025-12-10 17:48:38', NULL, 17, 12, 23),
	(38, 'The Witcher 3: Wild Hunt', '2015-05-19', 39.99, 'Incarnez Geralt de Riv, un chasseur de monstres.', NULL, '2025-12-10 17:48:38', NULL, 18, 13, 24),
	(39, 'Cyberpunk 2077', '2020-12-10', 59.99, 'Une aventure dans la mégalopole de Night City.', NULL, '2025-12-10 17:48:38', NULL, 18, 13, 24),
	(40, 'Red Dead Redemption 2', '2018-10-26', 59.99, 'L\'histoire d\'Arthur Morgan et de la bande de Van der Linde.', NULL, '2025-12-10 17:48:38', NULL, 17, 12, 23),
	(41, 'Horizon Zero Dawn', '2017-02-28', 19.99, 'Aloy, une jeune chasseuse, explore un monde envahi par les machines.', NULL, '2025-12-10 17:48:38', NULL, 16, 12, 25),
	(42, 'Elden Ring', '2022-02-25', 69.99, 'Un vaste monde fantastique créé par Hidetaka Miyazaki et George R. R. Martin.', NULL, '2025-12-10 17:48:38', NULL, 20, 13, 26),
	(43, 'Ghost of Tsushima', '2020-07-17', 49.99, 'Devenez le "Fantôme" et défendez l\'île de Tsushima.', NULL, '2025-12-10 17:48:38', NULL, 16, 12, 27),
	(44, 'Marvel\'s Spider-Man', '2018-09-07', 39.99, 'Incarnez un Spider-Man expérimenté luttant contre le crime à New York.', NULL, '2025-12-10 17:48:38', NULL, 16, 12, 28),
	(45, 'Final Fantasy VII Remake', '2020-04-10', 69.99, 'La réimagination du RPG emblématique avec des graphismes modernes.', NULL, '2025-12-10 17:48:38', NULL, 19, 13, 29),
	(46, 'Minecraft', '2011-11-18', 29.99, 'Un jeu de type bac à sable où vous pouvez construire tout ce que vous imaginez.', NULL, '2025-12-10 17:48:38', NULL, 21, 15, 30),
	(47, 'Forza Horizon 5', '2021-11-09', 69.99, 'Explorez les paysages vibrants et évolutifs du Mexique.', NULL, '2025-12-10 17:48:38', NULL, 21, 17, 31),
	(48, 'Resident Evil Village', '2021-05-07', 39.99, 'Ethan Winters explore un village mystérieux à la recherche de sa fille.', NULL, '2025-12-10 17:48:38', NULL, 22, 12, 32),
	(49, 'Monster Hunter: World', '2018-01-26', 29.99, 'Chassez des monstres gigantesques dans un monde vivant.', NULL, '2025-12-10 17:48:38', NULL, 22, 13, 32),
	(50, 'Call of Duty: Modern Warfare II', '2022-10-28', 69.99, 'La Task Force 141 fait face à une nouvelle menace mondiale.', NULL, '2025-12-10 17:48:38', NULL, 23, 10, 33),
	(51, 'Animal Crossing: New Horizons', '2020-03-20', 49.99, 'Créez votre propre paradis insulaire.', NULL, '2025-12-10 17:48:38', NULL, 13, 15, 18),
	(52, 'Super Mario Odyssey', '2017-10-27', 49.99, 'Mario explore de vastes royaumes en 3D à bord de l\'Odyssée.', NULL, '2025-12-10 17:48:38', NULL, 13, 10, 18),
	(53, 'God of War Ragnarök', '2022-11-09', 79.99, 'Kratos et Atreus doivent voyager dans les Neuf Royaumes.', NULL, '2025-12-10 17:48:38', NULL, 16, 12, 22),
	(54, 'Star Wars Jedi: Survivor', '2023-04-28', 69.99, 'Cal Kestis continue son combat en tant que l\'un des derniers Jedi.', NULL, '2025-12-10 17:48:38', NULL, 15, 12, 21),
	(55, 'It Takes Two', '2021-03-26', 39.99, 'Un jeu d\'aventure et de plateforme exclusivement en coopération.', NULL, '2025-12-10 17:48:38', NULL, 15, 12, 21),
	(56, 'Portal 2', '2011-04-19', 9.99, 'Un jeu de réflexion à la première personne acclamé par la critique.', NULL, '2025-12-10 17:48:38', NULL, 21, 18, 31),
	(57, 'Stardew Valley', '2016-02-26', 13.99, 'Créez la ferme de vos rêves dans cette simulation de vie rurale.', NULL, '2025-12-10 17:48:38', NULL, 18, 15, 24),
	(58, 'Hades', '2020-09-17', 24.99, 'Défiez le dieu des morts dans ce rogue-like divin.', NULL, '2025-12-10 17:48:38', NULL, 14, 10, 19),
	(59, 'Control', '2019-08-27', 29.99, 'Une aventure d\'action à la troisième personne surnaturelle.', NULL, '2025-12-10 17:48:38', NULL, 16, 12, 34),
	(60, 'Street Fighter 6', '2023-06-02', 59.99, 'Le dernier opus de la série de jeux de combat légendaire.', NULL, '2025-12-10 17:48:38', NULL, 22, 10, 32);

-- Listage de la structure de table bdd_mon_projet. utilisateur
DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `image_profil` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B386CC499D` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table bdd_mon_projet.utilisateur : ~6 rows (environ)
INSERT INTO `utilisateur` (`id`, `prenom`, `nom`, `pseudo`, `mail`, `date_naissance`, `image_profil`, `created_at`, `updated_at`) VALUES
	(1, 'Denis', 'DUPONT', 'denis_gamer', 'denis.dupont@example.com', '1995-03-15', 'https://i.pravatar.cc/150?img=12', '2025-12-10 17:48:38', NULL),
	(2, 'Marcelle', 'DUMONT', 'marcelle_rpg', 'marcelle.dumont@example.com', '1988-07-22', 'https://i.pravatar.cc/150?img=47', '2025-12-10 17:48:38', NULL),
	(3, 'Thomas', 'MARTIN', 'thomas_pro', 'thomas.martin@example.com', '2000-11-08', 'https://i.pravatar.cc/150?img=33', '2025-12-10 17:48:38', NULL),
	(4, 'Sophie', 'BERNARD', 'sophie_games', 'sophie.bernard@example.com', '1992-05-30', 'https://i.pravatar.cc/150?img=44', '2025-12-10 17:48:38', NULL),
	(5, 'Lucas', 'PETIT', 'lucas_player', 'lucas.petit@example.com', '1998-09-12', 'https://i.pravatar.cc/150?img=68', '2025-12-10 17:48:38', NULL),
	(6, 'Emma', 'ROBERT', 'emma_casual', 'emma.robert@example.com', '2002-01-25', NULL, '2025-12-10 17:48:38', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
