-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
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

-- Dumping structure for table filetracking.attachments
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_id` bigint unsigned DEFAULT NULL,
  `file_log_id` bigint unsigned DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.attachments: ~0 rows (approximately)
INSERT INTO `attachments` (`id`, `file_id`, `file_log_id`, `path`, `source`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 'uploads/attachment/', '1716296579_bg-img.jpg', '2024-05-21 08:02:59', '2024-05-21 08:02:59'),
	(2, 1, NULL, 'uploads/attachment/', '1716296579_WhatsApp Image 2024-05-18 at 22.56.49_936ca2d9.jpg', '2024-05-21 08:02:59', '2024-05-21 08:02:59'),
	(3, 1, NULL, 'uploads/attachment/', '1716296579_hero-image.jpg', '2024-05-21 08:02:59', '2024-05-21 08:02:59');

-- Dumping structure for table filetracking.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.cache: ~2 rows (approximately)

-- Dumping structure for table filetracking.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.cache_locks: ~0 rows (approximately)

-- Dumping structure for table filetracking.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.categories: ~0 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Transfer/Posting from constable to Inspector and Minister staff ', NULL, NULL),
	(2, 'Transfer/Posting of officers from (17 & above)', NULL, NULL),
	(3, 'Maintenance of Seniority lists.', NULL, NULL),
	(4, 'Recruitment of Shuhada / police sons died during service.', NULL, NULL),
	(5, 'Recruitment of Constables through ETEA.', NULL, NULL),
	(6, 'Recruitment of Jr.Clerk/Computer Operators/Steno Typist through ETEA', NULL, NULL),
	(7, 'Recruitment SI/Legal, ASIs and Assistant Grade Clerks through Public Service Commission.', NULL, NULL),
	(8, 'Promotion examination through ETEA', NULL, NULL),
	(9, 'Retirement Cases', NULL, NULL),
	(10, 'Issuance of NOC in service matter', NULL, NULL),
	(11, 'Earned/Ex-Pakistan Leave ', NULL, NULL),
	(12, 'Promotion', NULL, NULL),
	(13, 'Confirmation', NULL, NULL),
	(14, 'Representation', NULL, NULL),
	(15, 'Seniority', NULL, NULL),
	(16, 'ACR/PER of officers/officials', NULL, NULL),
	(17, 'Department appeals ex-employees for re-instatement', NULL, NULL),
	(18, 'Department appeals against adverse remarks in ACR/PER.', NULL, NULL),
	(19, 'Commendation/citation reports of officers/officials showing bravery in line of duty.', NULL, NULL),
	(20, 'Court decisions/judgments', NULL, NULL),
	(21, 'CPLA cases', NULL, NULL),
	(22, 'Court notices/COC notices', NULL, NULL),
	(23, 'Writ petitions of Peshawar High Court', NULL, NULL),
	(24, 'Service appeals in Pakhtunkhwa Service Tribunal', NULL, NULL),
	(25, 'Sports events', NULL, NULL),
	(26, 'Nomination of players for different sport events', NULL, NULL),
	(27, 'Other', NULL, NULL);

-- Dumping structure for table filetracking.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table filetracking.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_section` bigint unsigned DEFAULT NULL,
  `mester_file_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `current_section` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.files: ~0 rows (approximately)
INSERT INTO `files` (`id`, `created_by`, `created_section`, `mester_file_id`, `category_id`, `section_id`, `flag`, `prefix`, `file_type`, `source`, `track_number`, `date`, `subject`, `content`, `current_section`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 1, 'Narmal', 'E1-1', 'File', 'internal', 'E1-2024-05-1', '2024-05-21', 'Deparment / Office Section', '<p>Subject</p>', '2', 'In Transit', '2024-05-21 08:02:59', '2024-05-21 08:02:59');

-- Dumping structure for table filetracking.file_logs
CREATE TABLE IF NOT EXISTS `file_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `last_modified_by` bigint unsigned DEFAULT NULL,
  `file_id` bigint unsigned DEFAULT NULL,
  `from_section` bigint unsigned DEFAULT NULL,
  `to_section` bigint unsigned DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.file_logs: ~0 rows (approximately)
INSERT INTO `file_logs` (`id`, `created_by`, `last_modified_by`, `file_id`, `from_section`, `to_section`, `date`, `subject`, `content`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 1, '2024-05-21', NULL, NULL, NULL, '2024-05-21 08:02:59', '2024-05-21 08:02:59'),
	(3, NULL, 1, 1, 2, 5, '2024-05-22', NULL, '<span style="font-size: 24px;">Comments</span>', NULL, '2024-05-21 23:22:16', '2024-05-21 23:22:16');

-- Dumping structure for table filetracking.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.jobs: ~0 rows (approximately)

-- Dumping structure for table filetracking.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.job_batches: ~0 rows (approximately)

-- Dumping structure for table filetracking.mester_files
CREATE TABLE IF NOT EXISTS `mester_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.mester_files: ~0 rows (approximately)
INSERT INTO `mester_files` (`id`, `created_by`, `name`, `description`, `current_status`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Master File 1', NULL, NULL, '2024-05-21 06:28:49', '2024-05-21 06:28:49');

-- Dumping structure for table filetracking.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_05_18_103408_create_permission_tables', 1),
	(5, '2024_05_20_190633_create_sections_table', 2),
	(6, '2024_05_20_191211_create_mester_files_table', 2),
	(8, '2024_05_20_193718_create_attachments_table', 2),
	(9, '2024_05_20_194921_create_file_logs_table', 2),
	(10, '2024_05_21_103924_create_categories_table', 2),
	(13, '2024_05_20_191820_create_files_table', 3);

-- Dumping structure for table filetracking.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table filetracking.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.model_has_roles: ~0 rows (approximately)

-- Dumping structure for table filetracking.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table filetracking.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.permissions: ~0 rows (approximately)

-- Dumping structure for table filetracking.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.roles: ~0 rows (approximately)

-- Dumping structure for table filetracking.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.role_has_permissions: ~0 rows (approximately)

-- Dumping structure for table filetracking.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.sections: ~0 rows (approximately)
INSERT INTO `sections` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
	(1, 'Establishment E-1', 'E1', NULL, NULL),
	(2, 'Director IT', 'IT', NULL, NULL),
	(3, 'Establishment E-2', 'E2', NULL, NULL),
	(4, 'Establishment E-3', 'E3', NULL, NULL),
	(5, 'Establishment E-4', 'E4', NULL, NULL),
	(6, 'Establishment E-5', 'E5', NULL, NULL),
	(7, 'General Branch', 'GB', NULL, NULL),
	(8, 'Registrar Section', 'RG', NULL, NULL),
	(9, 'DIG HQRs', 'HQ', NULL, NULL),
	(10, 'AIG Establishment', 'AG', NULL, NULL),
	(11, 'DIG F&P', 'FP', NULL, NULL),
	(12, 'ADL IGP HQRS', 'ADH', NULL, NULL),
	(13, 'Budget Branch', 'BB', NULL, NULL),
	(14, 'Accounant CPO', 'AB', NULL, NULL),
	(15, 'DIG OPS', 'AOP', NULL, NULL),
	(16, 'DSP OPS', 'DOP', NULL, NULL),
	(17, 'Work Section', 'WS', NULL, NULL),
	(18, 'Enquiry &  Inspection', 'EI', NULL, NULL),
	(19, 'Carrer Planing', 'CP', NULL, NULL),
	(20, 'Audit Cell', 'AC', NULL, NULL),
	(21, 'Secret Branch', 'SB', NULL, NULL),
	(22, 'C Branch', 'CB', NULL, NULL),
	(23, 'Training Branch', 'TB', NULL, NULL),
	(24, 'Sectary Welfare', 'SW', NULL, NULL),
	(25, 'Complaint Cell', 'CC', NULL, NULL),
	(26, 'AIG Legal', 'LG', NULL, NULL),
	(27, 'Operation Branch', 'OB', NULL, NULL),
	(28, 'Research Section', 'RS', NULL, NULL),
	(29, 'AIG Logistic ', 'LO', NULL, NULL),
	(30, 'PSO Section', 'PS', NULL, NULL),
	(31, 'SP Admin', 'AD', NULL, NULL),
	(32, 'Sport', 'SPT', NULL, NULL),
	(33, 'Investigation', 'INV', NULL, NULL),
	(34, 'PRO', 'PRO', NULL, NULL),
	(35, 'PA to IG', 'PA', NULL, NULL),
	(37, 'NGO Desk', 'NGO', NULL, NULL),
	(38, 'DAS', 'DS', NULL, NULL),
	(39, 'Deputy Director IT', 'DIT', NULL, NULL),
	(40, 'Assistant Director IT', 'AIT', NULL, NULL),
	(41, 'PAS', 'PAS', NULL, NULL),
	(42, 'B1', 'B1', NULL, NULL),
	(43, 'B2', 'B2', NULL, NULL),
	(44, 'B3', 'B3', NULL, NULL),
	(45, 'A2', 'A2', NULL, NULL),
	(46, 'A3', 'A3', NULL, NULL),
	(47, 'DSP F&P', 'EF', NULL, NULL),
	(48, 'Other', 'Other', NULL, NULL),
	(51, 'Reconcilation Branch', 'RC', NULL, NULL),
	(52, 'Programmer', 'PG', NULL, NULL),
	(53, 'Accountant Training', 'AT', NULL, NULL),
	(54, 'AIG C&E', 'C&E', NULL, NULL),
	(55, 'Chief of Staff', 'COS', NULL, NULL),
	(56, 'Director PR', 'DPR', NULL, NULL),
	(57, 'DIG Security', 'SEC', NULL, NULL),
	(58, 'PSO To IGP', 'PSO2IGP', NULL, NULL),
	(59, 'CTD HQrs', 'CTDHQrs', NULL, NULL),
	(60, 'Commandant Elite', 'Elite ', NULL, NULL),
	(61, 'Commandant FRP', 'FRP', NULL, NULL),
	(62, 'Commandant SSU', 'SSU', NULL, NULL),
	(63, 'ADD IGP Special Branch', 'ADD IGP SB', NULL, NULL),
	(64, 'DIG Traffic', 'DIGTRF', NULL, NULL),
	(65, 'AIG NMD', 'NMD', NULL, NULL),
	(66, 'DIG Tele', 'DIGTEL', NULL, NULL),
	(67, 'DIG IT', 'DIGIT', NULL, NULL),
	(68, 'AIG Gender', 'AIGGN', NULL, NULL),
	(69, 'RPO Malakand', 'RPOMK', NULL, NULL),
	(70, 'RPO Hazara', 'RPOH', NULL, NULL),
	(71, 'RPO DIKhan', 'RPOD', NULL, NULL),
	(72, 'RPO Bannu', 'RPOB', NULL, NULL),
	(73, 'RPO Kohat', 'RPOK', NULL, NULL),
	(74, 'CCPO', 'CCP', NULL, NULL),
	(75, 'RPO Mardan', 'RPOMR', NULL, NULL),
	(76, 'Home Dept', 'Home Dept', NULL, NULL),
	(77, 'Establishment Dept', 'Estb KP', NULL, NULL),
	(78, 'National Police Bureau', 'NPB', NULL, NULL),
	(79, 'National Police Fundation', 'NPF', NULL, NULL),
	(80, 'NAB', 'NAB', NULL, NULL),
	(81, 'Establishment Division', 'Estb Div', NULL, NULL),
	(82, 'ACR/PER Reporting Officer', 'ACR', NULL, NULL),
	(83, 'IG FC', 'IGFC', NULL, NULL);

-- Dumping structure for table filetracking.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.sessions: ~3 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Kh5mbUK0Fq83mUNUZLxYc9XO1aSN1Vt1nQNw3SLL', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU3JOam5SQ2hzR290OElzbmRnWTA1N1B2Tk11SWZ5Q1VVaWFnbEF1YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9maWxldHJhY2tpbmcudGVzdC9teWRlc2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1716351736);

-- Dumping structure for table filetracking.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table filetracking.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `section`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Junaid Khan', 'junaid@gmail.com', NULL, '$2y$12$wpW0IpcIqowV8s4IAW6wCeazuAN.DWomGRuV2AjtUOX1ahbbLKCse', 'Super Admin', '1', NULL, '2024-05-18 06:54:54', '2024-05-18 06:54:54');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
