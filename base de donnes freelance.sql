-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour freelance
CREATE DATABASE IF NOT EXISTS `freelance` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `freelance`;

-- Listage de la structure de table freelance. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'categories_default.png',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.categories : ~2 rows (environ)
REPLACE INTO `categories` (`id`, `name`, `image`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Application web', '/categories_images/Capture_1719939215.PNG', 'Application web', 1, '2024-07-02 14:53:35', '2024-07-02 14:53:35'),
	(2, 'Application mobile', '/categories_images/review-01_1719939277.jpg', 'Application mobile', 1, '2024-07-02 14:54:37', '2024-07-02 14:54:37');

-- Listage de la structure de table freelance. contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.contacts : ~0 rows (environ)
REPLACE INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'Byron Torres', 'fuwy@mailinator.com', 'Quae adipisci volupt', '2024-07-01 12:24:31', '2024-07-01 12:24:31');

-- Listage de la structure de table freelance. education
CREATE TABLE IF NOT EXISTS `education` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_of_start` int NOT NULL,
  `year_of_end` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `education_user_id_foreign` (`user_id`),
  CONSTRAINT `education_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.education : ~1 rows (environ)
REPLACE INTO `education` (`id`, `name`, `university`, `year_of_start`, `year_of_end`, `user_id`, `created_at`, `updated_at`) VALUES
	(57, 'N28', 'N28', 2002, 2024, 1, '2024-07-03 13:45:26', '2024-07-03 13:45:26');

-- Listage de la structure de table freelance. etape_cles
CREATE TABLE IF NOT EXISTS `etape_cles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `pay_status` tinyint(1) NOT NULL DEFAULT '0',
  `project_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `status` enum('pending','accepted','in_progress','completed','declined','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `etape_cles_project_id_foreign` (`project_id`),
  KEY `etape_cles_user_id_foreign` (`user_id`),
  CONSTRAINT `etape_cles_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `etape_cles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.etape_cles : ~0 rows (environ)
REPLACE INTO `etape_cles` (`id`, `name`, `price`, `description`, `start_date`, `end_date`, `due_date`, `pay_status`, `project_id`, `user_id`, `freelancer_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Application web', '50000', 'desc', '2024-07-10', '2024-07-11', NULL, 0, 1, 1, 5, 'completed', '2024-07-03 14:46:45', '2024-07-03 14:52:27');

-- Listage de la structure de table freelance. experiences
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_user_id_foreign` (`user_id`),
  CONSTRAINT `experiences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.experiences : ~1 rows (environ)
REPLACE INTO `experiences` (`id`, `company_name`, `position`, `start_date`, `end_date`, `user_id`, `created_at`, `updated_at`) VALUES
	(56, 'salut', 'informaticien', '2002-10-10', '2003-10-10', 1, '2024-07-03 13:45:26', '2024-07-03 13:45:26');

-- Listage de la structure de table freelance. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table freelance. favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_user_id_foreign` (`user_id`),
  KEY `favorites_project_id_foreign` (`project_id`),
  CONSTRAINT `favorites_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.favorites : ~1 rows (environ)
REPLACE INTO `favorites` (`id`, `user_id`, `project_id`, `created_at`, `updated_at`) VALUES
	(22, 2, 1, '2024-07-03 10:07:14', '2024-07-03 10:07:14'),
	(33, 1, 1, '2024-07-03 14:30:36', '2024-07-03 14:30:36');

-- Listage de la structure de table freelance. freelancer_levels
CREATE TABLE IF NOT EXISTS `freelancer_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.freelancer_levels : ~0 rows (environ)
REPLACE INTO `freelancer_levels` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Debutant', 1, NULL, NULL);

-- Listage de la structure de table freelance. freelancer_skills
CREATE TABLE IF NOT EXISTS `freelancer_skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `skill_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.freelancer_skills : ~0 rows (environ)
REPLACE INTO `freelancer_skills` (`id`, `skill_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL);

-- Listage de la structure de table freelance. freelancer_types
CREATE TABLE IF NOT EXISTS `freelancer_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.freelancer_types : ~0 rows (environ)
REPLACE INTO `freelancer_types` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Laouratou', 'Bon', 1, NULL, NULL);

-- Listage de la structure de table freelance. id_verifications
CREATE TABLE IF NOT EXISTS `id_verifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `verified_by_user_id` bigint unsigned DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('id','passport','driving_license') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'id',
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_rejected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_verifications_user_id_foreign` (`user_id`),
  KEY `id_verifications_verified_by_user_id_foreign` (`verified_by_user_id`),
  CONSTRAINT `id_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `id_verifications_verified_by_user_id_foreign` FOREIGN KEY (`verified_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.id_verifications : ~0 rows (environ)

-- Listage de la structure de table freelance. memberships
CREATE TABLE IF NOT EXISTS `memberships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `price` bigint NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodicity` enum('monthly','yearly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `memberships_user_id_foreign` (`user_id`),
  CONSTRAINT `memberships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.memberships : ~0 rows (environ)

-- Listage de la structure de table freelance. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.migrations : ~40 rows (environ)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_02_16_115945_create_categories_table', 1),
	(7, '2024_02_16_135439_create_skills_table', 1),
	(8, '2024_02_18_143051_create_projects_table', 1),
	(9, '2024_02_18_145817_create_project_languages_table', 1),
	(10, '2024_02_18_145950_create_project_language_levels_table', 1),
	(11, '2024_02_18_150214_create_freelancer_types_table', 1),
	(12, '2024_02_18_150656_create_project_durations_table', 1),
	(13, '2024_02_18_150826_create_freelancer_levels_table', 1),
	(14, '2024_02_18_160827_add_field_to_projects_table', 1),
	(15, '2024_02_27_005458_create_project_file_uploadeds_table', 1),
	(16, '2024_04_15_183250_add_en_vedette_to_projects_table', 1),
	(17, '2024_04_18_221101_add_skills_to_projects_table', 1),
	(18, '2024_04_18_222811_add_size_to_project_file_uploadeds_table', 1),
	(19, '2024_04_19_145020_create_proposals_table', 1),
	(20, '2024_04_21_115205_create_profils_table', 1),
	(21, '2024_04_21_123927_add_is_verified_to_profils_table', 1),
	(22, '2024_04_21_132735_add_company_name_to_users_table', 1),
	(23, '2024_04_24_000015_add_is_acticve_to_users_table', 1),
	(24, '2024_04_24_120409_add_pricing_to_profils_table', 1),
	(25, '2024_04_25_170635_create_education_table', 1),
	(26, '2024_04_26_104018_create_experiences_table', 1),
	(27, '2024_04_26_134925_create_freelancer_skills_table', 1),
	(28, '2024_04_27_094818_add_status_field_to_projects_table', 1),
	(29, '2024_04_28_140902_add_hired_on_field_to_projects_table', 1),
	(30, '2024_04_29_114714_create_etape_cles_table', 1),
	(31, '2024_04_29_142748_create_tasks_table', 1),
	(32, '2024_04_29_220342_create_project_files_table', 1),
	(33, '2024_05_01_212252_create_id_verifications_table', 1),
	(34, '2024_05_02_143129_create_memberships_table', 1),
	(35, '2024_05_10_114848_add_is_hidden_to_projects_table', 1),
	(36, '2024_05_11_121452_create_reviews_table', 1),
	(37, '2024_05_26_084519_add_wallet_to_users_table', 1),
	(38, '2024_05_26_090528_create_wallet_transactions_table', 1),
	(39, '2024_05_27_083703_create_user_payments_table', 1),
	(40, '2024_05_27_161314_add_type_to_user_payments_table', 1),
	(41, '2024_07_01_132755_create_contacts_table', 1),
	(42, '2024_07_03_095557_create_favorites_table', 2),
	(43, '2024_07_03_134726_add_working_days_to_profils_table', 3),
	(44, '2024_07_03_145110_add_work_days_to_profils_table', 4);

-- Listage de la structure de table freelance. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.password_resets : ~0 rows (environ)

-- Listage de la structure de table freelance. password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.password_reset_tokens : ~0 rows (environ)

-- Listage de la structure de table freelance. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.personal_access_tokens : ~0 rows (environ)

-- Listage de la structure de table freelance. profils
CREATE TABLE IF NOT EXISTS `profils` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `freelancer_type_id` bigint unsigned DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profil_default.svg',
  `date_naissance` date DEFAULT NULL,
  `fonction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domaine_activite` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apercu` longtext COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `behance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Burkina Faso',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `category_id` bigint unsigned DEFAULT NULL,
  `working_days` json DEFAULT NULL,
  `work_days` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profils_user_id_foreign` (`user_id`),
  KEY `profils_freelancer_type_id_foreign` (`freelancer_type_id`),
  KEY `profils_category_id_foreign` (`category_id`),
  CONSTRAINT `profils_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `profils_freelancer_type_id_foreign` FOREIGN KEY (`freelancer_type_id`) REFERENCES `freelancer_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `profils_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.profils : ~3 rows (environ)
REPLACE INTO `profils` (`id`, `user_id`, `freelancer_type_id`, `photo`, `date_naissance`, `fonction`, `domaine_activite`, `apercu`, `facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `behance`, `website`, `ville`, `province`, `code_postal`, `pays`, `created_at`, `updated_at`, `is_verified`, `username`, `prix`, `category_id`, `working_days`, `work_days`) VALUES
	(1, 2, NULL, 'profil_default.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Burkina Faso', '2024-07-02 12:05:33', '2024-07-02 12:05:33', 0, 'laouratoutraore', '0', NULL, NULL, NULL),
	(2, 3, NULL, 'profil_default.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Burkina Faso', '2024-07-02 14:43:37', '2024-07-02 14:43:37', 0, 'n28n28-n28', '0', NULL, NULL, NULL),
	(3, 1, 1, 'profil_default.svg', '2002-10-10', 'Informaticien', 'informatique', '<p>desc</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ouagadougou', 'ouaga', 'bpouagadougou', '1', '2024-07-03 11:32:20', '2024-07-03 13:45:25', 0, 'n28n28', '5', 1, '[]', '["Sam","Dim"]'),
	(4, 5, NULL, 'profil_default.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Burkina Faso', '2024-07-03 14:35:42', '2024-07-03 14:35:42', 0, 'laouratouapplication-web', '0', NULL, NULL, NULL);

-- Listage de la structure de table freelance. projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'projects_default.png',
  `deadline` date NOT NULL,
  `budget_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `budget` int NOT NULL DEFAULT '0',
  `max_budget` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `freelancer_type_id` bigint unsigned NOT NULL,
  `project_duration_id` bigint unsigned NOT NULL,
  `freelancer_level_id` bigint unsigned NOT NULL,
  `en_vedette` tinyint(1) NOT NULL DEFAULT '0',
  `skills` text COLLATE utf8mb4_unicode_ci,
  `freelancer_id` bigint DEFAULT NULL,
  `status` enum('pending','ongoing','completed','canceled','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `hired_on` timestamp NULL DEFAULT NULL,
  `proposal_id` bigint DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `projects_user_id_foreign` (`user_id`),
  KEY `projects_category_id_foreign` (`category_id`),
  KEY `projects_freelancer_type_id_foreign` (`freelancer_type_id`),
  KEY `projects_project_duration_id_foreign` (`project_duration_id`),
  KEY `projects_freelancer_level_id_foreign` (`freelancer_level_id`),
  CONSTRAINT `projects_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `projects_freelancer_level_id_foreign` FOREIGN KEY (`freelancer_level_id`) REFERENCES `freelancer_levels` (`id`),
  CONSTRAINT `projects_freelancer_type_id_foreign` FOREIGN KEY (`freelancer_type_id`) REFERENCES `freelancer_types` (`id`),
  CONSTRAINT `projects_project_duration_id_foreign` FOREIGN KEY (`project_duration_id`) REFERENCES `project_durations` (`id`),
  CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.projects : ~0 rows (environ)
REPLACE INTO `projects` (`id`, `name`, `description`, `image`, `deadline`, `budget_type`, `budget`, `max_budget`, `is_active`, `created_at`, `updated_at`, `user_id`, `category_id`, `freelancer_type_id`, `project_duration_id`, `freelancer_level_id`, `en_vedette`, `skills`, `freelancer_id`, `status`, `hired_on`, `proposal_id`, `is_hidden`) VALUES
	(1, 'geficfinance', '<p>sesc</p>', 'projects_default.png', '2024-07-04', 'fixed', 150000, NULL, 1, '2024-07-02 15:08:46', '2024-07-03 15:11:41', 1, 1, 1, 1, 1, 0, 'Web Design', 5, 'completed', '2024-07-03 14:44:10', 1, 0);

-- Listage de la structure de table freelance. project_durations
CREATE TABLE IF NOT EXISTS `project_durations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.project_durations : ~2 rows (environ)
REPLACE INTO `project_durations` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, '1semaine', 1, NULL, NULL),
	(2, '2semainees', 1, NULL, NULL);

-- Listage de la structure de table freelance. project_files
CREATE TABLE IF NOT EXISTS `project_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `freelancer_id` bigint unsigned NOT NULL,
  `added_by_user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_files_project_id_foreign` (`project_id`),
  KEY `project_files_user_id_foreign` (`user_id`),
  KEY `project_files_added_by_user_id_foreign` (`added_by_user_id`),
  CONSTRAINT `project_files_added_by_user_id_foreign` FOREIGN KEY (`added_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `project_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.project_files : ~2 rows (environ)
REPLACE INTO `project_files` (`id`, `name`, `description`, `path`, `file_type`, `file_size`, `project_id`, `user_id`, `freelancer_id`, `added_by_user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Application web', 'desc', 'Listes des taches_1720.docx', 'docx', '15921', 1, 1, 5, 5, '2024-07-03 14:50:49', '2024-07-03 14:50:49'),
	(2, 'Application web', 'desc', 'Listes des taches_1720.docx', 'docx', '15921', 1, 1, 5, 5, '2024-07-03 14:50:50', '2024-07-03 14:50:50');

-- Listage de la structure de table freelance. project_file_uploadeds
CREATE TABLE IF NOT EXISTS `project_file_uploadeds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_file_uploadeds_project_id_foreign` (`project_id`),
  KEY `project_file_uploadeds_user_id_foreign` (`user_id`),
  CONSTRAINT `project_file_uploadeds_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `project_file_uploadeds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.project_file_uploadeds : ~0 rows (environ)

-- Listage de la structure de table freelance. project_languages
CREATE TABLE IF NOT EXISTS `project_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fr.png',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.project_languages : ~0 rows (environ)

-- Listage de la structure de table freelance. project_language_levels
CREATE TABLE IF NOT EXISTS `project_language_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.project_language_levels : ~0 rows (environ)

-- Listage de la structure de table freelance. proposals
CREATE TABLE IF NOT EXISTS `proposals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `price` bigint NOT NULL,
  `number_delivery_days` bigint NOT NULL,
  `letter_cover` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `project_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proposals_project_id_foreign` (`project_id`),
  KEY `proposals_user_id_foreign` (`user_id`),
  CONSTRAINT `proposals_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `proposals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.proposals : ~0 rows (environ)
REPLACE INTO `proposals` (`id`, `price`, `number_delivery_days`, `letter_cover`, `is_sticky`, `is_hidden`, `is_active`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 10000, 10, 'desc', 0, 0, 1, 1, 5, '2024-07-03 14:41:21', '2024-07-03 14:41:21');

-- Listage de la structure de table freelance. reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `project_id` bigint unsigned NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  KEY `reviews_project_id_foreign` (`project_id`),
  CONSTRAINT `reviews_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.reviews : ~0 rows (environ)
REPLACE INTO `reviews` (`id`, `user_id`, `freelancer_id`, `project_id`, `comment`, `rate`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, 1, 'cool', 5, 1, '2024-07-03 15:12:21', '2024-07-03 15:12:21');

-- Listage de la structure de table freelance. skills
CREATE TABLE IF NOT EXISTS `skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'skills_default.png',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.skills : ~0 rows (environ)

-- Listage de la structure de table freelance. tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `end_date` date DEFAULT NULL,
  `project_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `etape_cle_id` bigint unsigned NOT NULL,
  `status` enum('pending','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_user_id_foreign` (`user_id`),
  KEY `tasks_etape_cle_id_foreign` (`etape_cle_id`),
  CONSTRAINT `tasks_etape_cle_id_foreign` FOREIGN KEY (`etape_cle_id`) REFERENCES `etape_cles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.tasks : ~0 rows (environ)
REPLACE INTO `tasks` (`id`, `name`, `description`, `end_date`, `project_id`, `user_id`, `freelancer_id`, `etape_cle_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Application web', 'desc', '2000-10-10', 1, 1, 5, 1, 'completed', '2024-07-03 14:49:40', '2024-07-03 14:49:59');

-- Listage de la structure de table freelance. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `wallet` int NOT NULL DEFAULT '0',
  `total_earnings` int NOT NULL DEFAULT '0',
  `total_spent` int NOT NULL DEFAULT '0',
  `total_withdrawn` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.users : ~4 rows (environ)
REPLACE INTO `users` (`id`, `name`, `user_type`, `first_name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `company_name`, `is_active`, `wallet`, `total_earnings`, `total_spent`, `total_withdrawn`) VALUES
	(1, 'N28', 'admin', 'N28', 'traorelaw600@gmail.com', '62909603', NULL, '$2y$12$MqH.V5HyD5bv2VkQ2G/rkeuJunJioHJhZKOK8vl8wfcv3FE/4VnhW', NULL, '2024-07-02 10:22:00', '2024-07-03 11:41:57', NULL, 1, 0, 0, 0, 0),
	(2, 'TRAORE', 'company', 'Laouratou', 'laouratoutraore3@gmail.com', NULL, NULL, '$2y$12$.DODVM8Lri5vC0G/nFM4E.1bblQ0n78nmMHhLxTikede26oVLxUwi', NULL, '2024-07-02 12:05:28', '2024-07-02 12:05:28', 'RESUSOFT', 1, 0, 0, 0, 0),
	(3, 'N28 N28', 'company', 'N28', 'traorelaw687@gmail.com', NULL, NULL, '$2y$12$MIiEntr3/0npyYq7r5m8bOTNNkn8G0ZqEnGOlTSVxeSCkyn/TJBvS', NULL, '2024-07-02 14:43:33', '2024-07-02 14:43:33', 'Resusoft', 1, 0, 0, 0, 0),
	(5, 'Application web', 'freelancer', 'Laouratou', 'admin1@example.com', NULL, NULL, '$2y$12$PPwkT3M8e6bvhInIKR0PiuBmYyn3/HL9tZ6zGUnjO.q7UUsxWc2Uu', NULL, '2024-07-03 14:35:41', '2024-07-03 14:53:50', '', 1, 50000, 0, 0, 0);

-- Listage de la structure de table freelance. user_payments
CREATE TABLE IF NOT EXISTS `user_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `project_id` bigint NOT NULL,
  `etape_cle_id` bigint DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `status` enum('success','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_payments_code_unique` (`code`),
  KEY `user_payments_user_id_foreign` (`user_id`),
  CONSTRAINT `user_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.user_payments : ~0 rows (environ)

-- Listage de la structure de table freelance. wallet_transactions
CREATE TABLE IF NOT EXISTS `wallet_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `type` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'credit',
  `balance` int NOT NULL,
  `amount` int NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallet_transactions_code_unique` (`code`),
  KEY `wallet_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `wallet_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table freelance.wallet_transactions : ~0 rows (environ)
REPLACE INTO `wallet_transactions` (`id`, `code`, `user_id`, `type`, `balance`, `amount`, `payment_method`, `created_at`, `updated_at`) VALUES
	(1, 'WT-5534591-1720', 5, 'credit', 50000, 50000, 'orange_money', '2024-07-03 14:53:53', '2024-07-03 14:53:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
