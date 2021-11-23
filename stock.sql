-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour stocks
CREATE DATABASE IF NOT EXISTS `stocks` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `stocks`;

-- Listage de la structure de la table stocks. articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `code_reference_materielle_SORTIES` varchar(50) NOT NULL,
  `nom_article_ARTICLES` varchar(100) NOT NULL,
  `designation_ARTICLES` varchar(100) NOT NULL,
  `remplacees_ARTICLES` varchar(50) NOT NULL,
  `quantite_Article` int(11) NOT NULL,
  `date_Entree_Articles` varchar(50) NOT NULL,
  `lieu_stocks` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_reference_materielle_SORTIES` (`code_reference_materielle_SORTIES`),
  KEY `FK_articles_categories` (`categorie_id`),
  KEY `FK_articles_stocks` (`lieu_stocks`),
  CONSTRAINT `FK_articles_categories` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_articles_stocks` FOREIGN KEY (`lieu_stocks`) REFERENCES `stocks` (`lieu_STOCK`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.articles : ~3 rows (environ)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `categorie_id`, `code_reference_materielle_SORTIES`, `nom_article_ARTICLES`, `designation_ARTICLES`, `remplacees_ARTICLES`, `quantite_Article`, `date_Entree_Articles`, `lieu_stocks`, `created_at`, `updated_at`) VALUES
	(4, 1, 'art-01', 'Marteau', 'Marteau INGCO', 'KILL', 10, '2021-11-22', 'Tiroir 21', '2021-11-20 01:23:18', '2021-11-22 00:00:28'),
	(5, 1, 'art-02', 'Pneu', 'Pneu Gol', 'die', 275, '2021-11-20', 'Tiroir 21', '2021-11-20 02:14:35', '2021-11-20 02:14:35'),
	(6, 3, 'art-03', 'Tournevis', 'Tour-05', 'loki', 28, '2021-11-22', 'Tiroir 21', '2021-11-22 00:08:21', '2021-11-22 00:08:21');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Listage de la structure de la table stocks. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie_CATEGORIES_ARTICLES` varchar(50) NOT NULL,
  `libelle_categorie_CATEGORIES_ARTICLES` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_categorie_CATEGORIES_ARTICLES` (`nom_categorie_CATEGORIES_ARTICLES`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.categories : ~1 rows (environ)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `nom_categorie_CATEGORIES_ARTICLES`, `libelle_categorie_CATEGORIES_ARTICLES`, `created_at`, `updated_at`) VALUES
	(1, 'Lourde', 'Poids lourd', '2021-11-14 15:26:07', '2021-11-14 15:29:04'),
	(2, 'Leger', 'Poids leger', '2021-11-15 10:11:46', '2021-11-15 10:11:46'),
	(3, 'Plume', 'poids plume', '2021-11-21 01:31:28', '2021-11-21 01:31:28');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Listage de la structure de la table stocks. commandes
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule_RESPONSABLES` int(11) NOT NULL,
  `email_fournisseur_FOURNISSEURS` varchar(255) NOT NULL,
  `code_reference_materielle_SORTIES` varchar(50) NOT NULL DEFAULT '',
  `date_commande_PASSER_COMMANDE` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `quantite_commande_PASSER_COMMANDE` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_matricule_RESPONSABLES` (`matricule_RESPONSABLES`),
  KEY `fk_email` (`email_fournisseur_FOURNISSEURS`),
  KEY `Fk_codereff` (`code_reference_materielle_SORTIES`),
  CONSTRAINT `Fk_codereff` FOREIGN KEY (`code_reference_materielle_SORTIES`) REFERENCES `articles` (`code_reference_materielle_SORTIES`),
  CONSTRAINT `fk_email` FOREIGN KEY (`email_fournisseur_FOURNISSEURS`) REFERENCES `fournisseurs` (`email_fournisseur_FOURNISSEURS`),
  CONSTRAINT `fk_matricule_RESPONSABLES` FOREIGN KEY (`matricule_RESPONSABLES`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.commandes : ~0 rows (environ)
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;

-- Listage de la structure de la table stocks. conservers
CREATE TABLE IF NOT EXISTS `conservers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_reference_materielle_SORTIES` varchar(50) NOT NULL DEFAULT '',
  `duree_CONSERVER` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_code_ar` (`code_reference_materielle_SORTIES`),
  CONSTRAINT `fk_code_ar` FOREIGN KEY (`code_reference_materielle_SORTIES`) REFERENCES `articles` (`code_reference_materielle_SORTIES`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.conservers : ~22 rows (environ)
/*!40000 ALTER TABLE `conservers` DISABLE KEYS */;
INSERT INTO `conservers` (`id`, `code_reference_materielle_SORTIES`, `duree_CONSERVER`) VALUES
	(1, 'art-01', '0 Année, 0 mois and 0 jour'),
	(2, 'art-02', '0 Année, 0 mois and 2 jour'),
	(3, 'art-03', '0 Année, 0 mois and 0 jour'),
	(4, 'art-01', '0 Année, 0 mois and 0 jour'),
	(5, 'art-02', '0 Année, 0 mois and 2 jour'),
	(6, 'art-03', '0 Année, 0 mois and 0 jour'),
	(7, 'art-01', '0 Année, 0 mois and 0 jour'),
	(8, 'art-02', '0 Année, 0 mois and 2 jour'),
	(9, 'art-03', '0 Année, 0 mois and 0 jour'),
	(10, 'art-01', '0 Année, 0 mois and 0 jour'),
	(11, 'art-02', '0 Année, 0 mois and 2 jour'),
	(12, 'art-03', '0 Année, 0 mois and 0 jour'),
	(13, 'art-01', '0 Année, 0 mois and 0 jour'),
	(14, 'art-02', '0 Année, 0 mois and 2 jour'),
	(15, 'art-03', '0 Année, 0 mois and 0 jour'),
	(16, 'art-01', '0 Année, 0 mois and 0 jour'),
	(17, 'art-02', '0 Année, 0 mois and 2 jour'),
	(18, 'art-03', '0 Année, 0 mois and 0 jour'),
	(19, 'art-01', '0 Année, 0 mois and 0 jour'),
	(20, 'art-02', '0 Année, 0 mois and 2 jour'),
	(21, 'art-03', '0 Année, 0 mois and 0 jour'),
	(22, 'art-01', '0 Année, 0 mois and 0 jour'),
	(23, 'art-02', '0 Année, 0 mois and 2 jour'),
	(24, 'art-03', '0 Année, 0 mois and 0 jour');
/*!40000 ALTER TABLE `conservers` ENABLE KEYS */;

-- Listage de la structure de la table stocks. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table stocks.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table stocks. fournisseurs
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur_FOURNISSEURS` varchar(255) NOT NULL,
  `prenom_fournisseur_FOURNISSEURS` varchar(255) NOT NULL,
  `adresse_fournisseur_FOURNISSEURS` varchar(100) NOT NULL,
  `email_fournisseur_FOURNISSEURS` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_fournisseur_FOURNISSEURS` (`email_fournisseur_FOURNISSEURS`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.fournisseurs : ~2 rows (environ)
/*!40000 ALTER TABLE `fournisseurs` DISABLE KEYS */;
INSERT INTO `fournisseurs` (`id`, `nom_fournisseur_FOURNISSEURS`, `prenom_fournisseur_FOURNISSEURS`, `adresse_fournisseur_FOURNISSEURS`, `email_fournisseur_FOURNISSEURS`, `updated_at`, `created_at`) VALUES
	(1, 'Diop', 'Modou', 'Hann Maristes 2 villa R04', 'mouodu@gamil.com', '2021-11-14 17:33:21', '2021-11-14 17:31:10'),
	(2, 'Pape', 'Aita', 'Hann Mariste', 'aita@gmail.com', '2021-11-20 02:48:45', '2021-11-20 02:45:48');
/*!40000 ALTER TABLE `fournisseurs` ENABLE KEYS */;

-- Listage de la structure de la table stocks. livrers
CREATE TABLE IF NOT EXISTS `livrers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_fournisseur_FOURNISSEURS` varchar(255) NOT NULL,
  `code_reference_materielle_SORTIES` varchar(50) NOT NULL,
  `prix_LIVRER` float NOT NULL,
  `quantite_livraison_LIVRER` int(11) NOT NULL,
  `condition_payement_LIVRER` varchar(50) NOT NULL DEFAULT '',
  `code_TVA_LIVRER` float NOT NULL,
  `taux_remise_LIVRER` float NOT NULL,
  `date_livraison_LIVRER` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_code_ref` (`code_reference_materielle_SORTIES`),
  KEY `fk_email_fournisseurs` (`email_fournisseur_FOURNISSEURS`),
  CONSTRAINT `fk_code_ref` FOREIGN KEY (`code_reference_materielle_SORTIES`) REFERENCES `articles` (`code_reference_materielle_SORTIES`),
  CONSTRAINT `fk_email_fournisseurs` FOREIGN KEY (`email_fournisseur_FOURNISSEURS`) REFERENCES `fournisseurs` (`email_fournisseur_FOURNISSEURS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.livrers : ~1 rows (environ)
/*!40000 ALTER TABLE `livrers` DISABLE KEYS */;
/*!40000 ALTER TABLE `livrers` ENABLE KEYS */;

-- Listage de la structure de la table stocks. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table stocks.migrations : ~4 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2021_11_20_160747_create_notifications_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table stocks. notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table stocks.notifications : ~0 rows (environ)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Listage de la structure de la table stocks. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table stocks.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('bachir@gmail.com', '$2y$10$m.Qd8XtmI.NejogokIz.C.jZevq3yt.QlGEQTceI33UObzoXaudAu', '2021-11-09 18:06:12');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table stocks. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table stocks.personal_access_tokens : ~0 rows (environ)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Listage de la structure de la table stocks. sorties
CREATE TABLE IF NOT EXISTS `sorties` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code_reference_materielle_SORTIES` varchar(50) NOT NULL,
  `date_sortie_SORTIES` varchar(50) NOT NULL,
  `heure_sortie_SORTIES` varchar(50) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '0',
  `email_users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_code_reference_materielle_SORTIESarticles` (`code_reference_materielle_SORTIES`),
  KEY `fk_code_email` (`email_users`),
  CONSTRAINT `fk_code_email` FOREIGN KEY (`email_users`) REFERENCES `users` (`email`),
  CONSTRAINT `fk_code_reference_materielle_SORTIESarticles` FOREIGN KEY (`code_reference_materielle_SORTIES`) REFERENCES `articles` (`code_reference_materielle_SORTIES`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.sorties : ~2 rows (environ)
/*!40000 ALTER TABLE `sorties` DISABLE KEYS */;
INSERT INTO `sorties` (`id`, `code_reference_materielle_SORTIES`, `date_sortie_SORTIES`, `heure_sortie_SORTIES`, `quantite`, `email_users`, `updated_at`, `created_at`) VALUES
	(1, 'art-02', '2021-11-20', '12:27:48', 10, 'bachir@gmail.com', '2021-11-20 12:28:14', '2021-11-20 10:40:59'),
	(20, 'art-01', '2021-11-21', '23:41:56', 6, 'Mousa@gmail.com', '2021-11-21 23:42:55', '2021-11-21 03:01:47'),
	(22, 'art-02', '2021-11-21', '23:50:41', 4, 'Mousa@gmail.com', '2021-11-21 23:51:07', '2021-11-21 23:48:04');
/*!40000 ALTER TABLE `sorties` ENABLE KEYS */;

-- Listage de la structure de la table stocks. sorts
CREATE TABLE IF NOT EXISTS `sorts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code_reference_materielle_SORTIES` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date_sortie_SORTIES` varchar(50) CHARACTER SET latin1 NOT NULL,
  `heure_sortie_SORTIES` varchar(50) CHARACTER SET latin1 NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '0',
  `email_users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_coderefe` (`code_reference_materielle_SORTIES`),
  KEY `FK_sors` (`email_users`),
  CONSTRAINT `FK_coderefe` FOREIGN KEY (`code_reference_materielle_SORTIES`) REFERENCES `articles` (`code_reference_materielle_SORTIES`),
  CONSTRAINT `FK_sors` FOREIGN KEY (`email_users`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table stocks.sorts : ~17 rows (environ)
/*!40000 ALTER TABLE `sorts` DISABLE KEYS */;
INSERT INTO `sorts` (`id`, `code_reference_materielle_SORTIES`, `date_sortie_SORTIES`, `heure_sortie_SORTIES`, `quantite`, `email_users`, `updated_at`, `created_at`) VALUES
	(1, 'art-02', '2021-11-20', '12:27:48', 10, 'bachir@gmail.com', '2021-11-20 12:28:14', '2021-11-20 10:40:59'),
	(2, 'art-01', '2021-11-21', '01:31:38', 11, 'Mousa@gmail.com', '2021-11-21 01:33:31', '2021-11-21 01:33:31'),
	(3, 'art-01', '2021-11-21', '01:34:07', 11, 'Mousa@gmail.com', '2021-11-21 01:34:29', '2021-11-21 01:34:29'),
	(4, 'art-02', '2021-11-21', '01:34:30', 15, 'Mousa@gmail.com', '2021-11-21 01:41:09', '2021-11-21 01:41:09'),
	(5, 'art-02', '2021-11-21', '01:34:30', 15, 'Mousa@gmail.com', '2021-11-21 01:48:40', '2021-11-21 01:48:40'),
	(6, 'art-02', '2021-11-21', '01:34:30', 15, 'Mousa@gmail.com', '2021-11-21 01:53:10', '2021-11-21 01:53:10'),
	(7, 'art-02', '2021-11-21', '01:34:30', 15, 'Mousa@gmail.com', '2021-11-21 02:07:15', '2021-11-21 02:07:15'),
	(8, 'art-01', '2021-11-21', '02:07:32', 11, 'Mousa@gmail.com', '2021-11-21 02:09:31', '2021-11-21 02:09:31'),
	(9, 'art-01', '2021-11-21', '02:07:32', 11, 'Mousa@gmail.com', '2021-11-21 02:10:28', '2021-11-21 02:10:28'),
	(10, 'art-01', '2021-11-21', '02:07:32', 11, 'Mousa@gmail.com', '2021-11-21 02:10:35', '2021-11-21 02:10:35'),
	(11, 'art-01', '2021-11-21', '02:07:32', 11, 'Mousa@gmail.com', '2021-11-21 02:15:16', '2021-11-21 02:15:16'),
	(12, 'art-02', '2021-11-21', '02:15:37', 15, 'Mousa@gmail.com', '2021-11-21 02:16:41', '2021-11-21 02:16:41'),
	(13, 'art-02', '2021-11-21', '02:15:37', 15, 'Mousa@gmail.com', '2021-11-21 02:34:43', '2021-11-21 02:34:43'),
	(14, 'art-02', '2021-11-21', '02:15:37', 15, 'Mousa@gmail.com', '2021-11-21 02:37:46', '2021-11-21 02:37:46'),
	(15, 'art-02', '2021-11-21', '02:15:37', 15, 'Mousa@gmail.com', '2021-11-21 02:48:21', '2021-11-21 02:48:21'),
	(16, 'art-02', '2021-11-21', '02:48:24', 15, 'Mousa@gmail.com', '2021-11-21 02:51:00', '2021-11-21 02:51:00'),
	(17, 'art-02', '2021-11-21', '02:48:24', 15, 'Mousa@gmail.com', '2021-11-21 02:51:01', '2021-11-21 02:51:01'),
	(18, 'art-01', '2021-11-21', '02:58:26', 11, 'Mousa@gmail.com', '2021-11-21 02:58:52', '2021-11-21 02:58:52'),
	(19, 'art-01', '2021-11-21', '02:58:26', 11, 'Mousa@gmail.com', '2021-11-21 02:59:48', '2021-11-21 02:59:48'),
	(20, 'art-01', '2021-11-21', '23:41:56', 6, 'Mousa@gmail.com', '2021-11-21 23:42:55', '2021-11-21 03:01:47'),
	(21, 'art-01', '2021-11-21', '23:30:20', 4, 'Mousa@gmail.com', '2021-11-21 23:33:08', '2021-11-21 23:33:08'),
	(22, 'art-02', '2021-11-21', '23:50:41', 4, 'Mousa@gmail.com', '2021-11-21 23:51:07', '2021-11-21 23:48:05');
/*!40000 ALTER TABLE `sorts` ENABLE KEYS */;

-- Listage de la structure de la table stocks. stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu_STOCK` varchar(100) NOT NULL,
  `emplacement_STOCK` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lieu_STOCK` (`lieu_STOCK`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.stocks : ~1 rows (environ)
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`id`, `lieu_STOCK`, `emplacement_STOCK`, `created_at`, `updated_at`) VALUES
	(1, 'Tiroir 21', 'Gauche', '2021-11-20 01:10:52', '2021-11-20 01:14:53');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- Listage de la structure de la table stocks. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_responsable_RESPONSABLES` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_responsable_RESPONSABLES` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance_RESPONSABLES` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_responsable_RESPONSABLES` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table stocks.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nom_responsable_RESPONSABLES`, `prenom_responsable_RESPONSABLES`, `date_naissance_RESPONSABLES`, `adresse_responsable_RESPONSABLES`, `role`, `email`, `email_verified_at`, `valid`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Dieng', 'Bachir', '2021-11-08', 'Hann bel', 'user', 'bachir@gmail.com', '2021-11-09 18:03:45', 0, '$2y$10$i1eqUl4/8sJ6asjdlmhwSeNA5nFgtwRffETFVOtMaZdhFn1cxmBf.', NULL, '2021-11-13 13:01:40', '2021-11-19 20:57:49'),
	(2, 'Diop', 'Moussa', '2021-11-08', 'HANN', 'admin', 'Mousa@gmail.com', '2021-11-13 13:06:57', 0, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2021-11-13 13:07:26', '2021-11-13 13:07:27'),
	(3, 'Dieng', 'Tidiane', '2021-11-04', 'Hann Maristes 2 villa R04', 'user', 'tidiane@gmail.com', NULL, 0, '$2y$10$38mW1lO8D/Djv7W96O4JBe1ifBaKxHHOZfaIDSWYz5AevSRr4sc6y', NULL, '2021-11-22 00:10:51', '2021-11-22 00:10:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table stocks. utilisers
CREATE TABLE IF NOT EXISTS `utilisers` (
  `numero_BENEFICIAIRE` int(11) NOT NULL AUTO_INCREMENT,
  `code_article_ARTICLES` int(11) NOT NULL,
  PRIMARY KEY (`numero_BENEFICIAIRE`,`code_article_ARTICLES`),
  KEY `FK_UTILISER_code_article_ARTICLES` (`code_article_ARTICLES`),
  CONSTRAINT `FK_UTILISER_code_article_ARTICLES` FOREIGN KEY (`code_article_ARTICLES`) REFERENCES `articles` (`id`),
  CONSTRAINT `FK_UTILISER_numero_BENEFICIAIRE` FOREIGN KEY (`numero_BENEFICIAIRE`) REFERENCES `beneficiaires` (`numero_BENEFICIAIRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table stocks.utilisers : ~0 rows (environ)
/*!40000 ALTER TABLE `utilisers` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilisers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
