# ************************************************************
# Sequel Ace SQL dump
# Version 20090
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.0.33)
# Database: cms_filament
# Generation Time: 2025-04-18 21:32:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table agenda
# ------------------------------------------------------------

DROP TABLE IF EXISTS `agenda`;

CREATE TABLE `agenda` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time NOT NULL,
  `time_end` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table banner_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner_link`;

CREATE TABLE `banner_link` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache_locks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table hit_visits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hit_visits`;

CREATE TABLE `hit_visits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `hit_visits` WRITE;
/*!40000 ALTER TABLE `hit_visits` DISABLE KEYS */;

INSERT INTO `hit_visits` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'hit_visit',NULL,NULL);

/*!40000 ALTER TABLE `hit_visits` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table innovations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `innovations`;

CREATE TABLE `innovations` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `article` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '0',
  `is_application` tinyint(1) NOT NULL DEFAULT '0',
  `playstore_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appstore_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table job_batches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT '-1',
  `page_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_page_id_foreign` (`page_id`),
  KEY `menu_order_index` (`order`),
  CONSTRAINT `menu_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`id`, `parent_id`, `page_id`, `url`, `path`, `order`, `title`, `type`, `created_at`, `updated_at`)
VALUES
	(1,-1,NULL,NULL,'/',1,'Beranda','url_internal','2025-03-17 11:03:53','2025-03-17 11:03:53'),
	(2,-1,NULL,NULL,NULL,2,'Profil','dropdown','2025-03-17 11:04:12','2025-03-17 11:04:12'),
	(3,2,'0195a209-636e-71fd-bfd1-eab25916d4f9',NULL,NULL,1,'Visi Misi','page','2025-03-17 11:07:00','2025-03-26 00:51:02'),
	(6,8,NULL,NULL,'posts/latest',2,'Berita Terbaru','url_internal','2025-04-03 01:00:02','2025-04-03 13:32:51'),
	(7,8,NULL,NULL,'posts/popular',1,'Berita Terpopuler','url_internal','2025-04-03 01:00:26','2025-04-03 13:32:55'),
	(8,-1,NULL,NULL,NULL,3,'Berita','dropdown','2025-04-03 01:00:35','2025-04-03 01:01:06'),
	(9,-1,NULL,NULL,'agendas',5,'Agenda','url_internal','2025-04-03 01:02:38','2025-04-03 01:04:54'),
	(10,-1,NULL,NULL,'videos',4,'Video Kegiatan','url_internal','2025-04-03 01:04:30','2025-04-03 01:04:54'),
	(12,2,'0195fc5f-7c01-7001-b346-e67504b7d824',NULL,NULL,3,'Struktur Organisasi','page','2025-04-10 15:47:12','2025-04-10 15:47:12');

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'0001_01_01_000000_create_users_table',1),
	(2,'0001_01_01_000001_create_cache_table',1),
	(3,'0001_01_01_000002_create_jobs_table',1),
	(4,'2022_12_14_083707_create_settings_table',1),
	(6,'2025_03_12_112226_create_general_settings',1),
	(15,'2025_03_16_021614_create_post_categories_table',3),
	(16,'2025_03_15_110706_create_permission_tables',4),
	(22,'2025_03_16_025226_create_posts_table',5),
	(23,'2025_03_16_125101_create_social_media_table',6),
	(24,'2025_03_16_142619_create_banner_link_table',7),
	(27,'2025_03_16_004607_create_sliders_table',9),
	(28,'2025_03_16_144848_create_inovasis_table',10),
	(31,'2025_03_17_001530_add_thumbnail_to_posts_table',13),
	(36,'2025_03_11_072642_create_agendas_table',15),
	(37,'2025_03_12_123158_create_halaman_table',16),
	(38,'2025_03_14_181756_create_menu_table',16),
	(42,'2025_03_16_230202_add_tahun_and_bulan_to_halaman_table',17),
	(43,'2025_03_16_233136_add_tahun_dan_bulan_to_post_table',17),
	(45,'2025_03_17_122838_add_avatar_url_to_users_table',18),
	(46,'2025_03_17_003510_create_kontaks_table',19),
	(47,'2025_03_17_131925_rename_inovasi_to_innovation_table',20),
	(48,'2025_03_17_134329_create_youtube_videos_table',21),
	(49,'2025_03_17_173442_add_has_change_password_to_users_table',22),
	(50,'2025_03_30_124351_add_visited_to_posts_table',23),
	(51,'2025_04_02_232845_create_visits_table',24),
	(52,'2025_04_02_235115_create_hit_visits_table',25),
	(53,'2025_04_09_143415_add_article_to_innovations_table',26),
	(54,'2025_04_11_013834_create_notifications_table',27);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table model_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table model_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES
	(1,'App\\Models\\User',1),
	(3,'App\\Models\\User',2),
	(3,'App\\Models\\User',4);

/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;

INSERT INTO `page` (`id`, `title`, `year`, `month`, `slug`, `content`, `is_publish`, `created_at`, `updated_at`)
VALUES
	('0195a209-636e-71fd-bfd1-eab25916d4f9','Visi Misi','2025','03','visi-misi','<p style=\"text-align: center; ;\"></p><p style=\"text-align: center; ;\"><img src=\"@storage/096bc756-8bbb-48e8-a87a-1457ff005507.png\" width=\"100%\" height=\"100%\"></p><p style=\"text-align: center; ;\"></p><p style=\"text-align: center; ;\">Magna non commodo quis qui incididunt nostrud sunt reprehenderit sint sit esse consequat eu. Tempor adipisicing sunt cupidatat sit tempor excepteur aute velit duis. Commodo nisi commodo exercitation deserunt magna occaecat officia proident sit eiusmod dolor cupidatat. Ipsum commodo aliquip laboris cillum nisi Lorem mollit eu consequat excepteur laboris proident. Excepteur Lorem id excepteur officia eiusmod occaecat excepteur consectetur sint est aliquip nostrud et Lorem. Sint officia sunt enim Lorem non id incididunt est eu ea reprehenderit consequat minim.</p><p>Tempor labore enim Lorem ullamco duis. Est ullamco sit velit excepteur officia commodo elit veniam. Ullamco reprehenderit proident voluptate commodo voluptate eu sit deserunt incididunt. Ut pariatur excepteur sint nulla ullamco cupidatat. Excepteur irure adipisicing aliqua esse ex dolore excepteur eu irure exercitation incididunt ut. Culpa duis labore duis pariatur laboris. Voluptate ea exercitation consectetur cillum consequat laboris. Deserunt irure mollit dolor nulla adipisicing nisi cupidatat.</p><p>Officia in voluptate tempor sunt do excepteur tempor ullamco ut commodo id proident. Dolor deserunt consequat laborum cupidatat sunt ut in excepteur eu nulla laborum. Adipisicing consectetur culpa ex ea eiusmod consequat Lorem qui. Eu exercitation aute eiusmod minim Lorem excepteur excepteur anim sit sunt sint cupidatat. Cillum enim quis incididunt proident nisi non ex amet fugiat mollit. Quis do velit ex ex laborum fugiat.</p><p>Deserunt quis exercitation eu labore. In irure ipsum aliqua nisi Lorem reprehenderit commodo id veniam duis laborum est et. Non non reprehenderit enim velit eiusmod proident est pariatur quis deserunt officia id do. Exercitation id laboris fugiat velit esse. Nostrud labore quis voluptate aliquip ex Lorem. Et veniam laboris non proident aliqua. Elit quis ad laboris eiusmod dolore pariatur fugiat consectetur nisi enim consectetur culpa.</p><p>Eu aliquip aute tempor enim Lorem non fugiat nostrud in eiusmod ullamco aute quis duis fugiat. Non eu voluptate nulla in dolore. Tempor duis ad nostrud consectetur quis in Lorem laboris voluptate ea reprehenderit pariatur pariatur. Tempor non elit in est ipsum aute do consequat et do incididunt. Proident ullamco et veniam magna tempor esse proident elit exercitation ex eu cupidatat laboris tempor. Cillum occaecat ullamco non.</p><p>Aliqua proident in velit veniam consequat quis dolor veniam non quis. Esse id pariatur consectetur proident enim cupidatat non deserunt ea. Duis ipsum Lorem adipisicing. Exercitation dolore occaecat ullamco quis do officia do amet pariatur nulla veniam.</p><p>Laborum aliqua Lorem sunt. Ullamco eiusmod est elit. Veniam labore cillum irure occaecat elit elit dolore aute sit anim Lorem ullamco. Dolore cupidatat labore sunt culpa officia adipisicing mollit est officia sint ullamco amet. Culpa excepteur aute cupidatat. Enim tempor anim sint nisi officia est adipisicing non ullamco proident aliquip laboris. Nisi laboris aute est enim id proident qui reprehenderit.</p><p>Cillum nisi laboris Lorem et. Cillum id et ullamco excepteur tempor dolore et. Enim cupidatat eiusmod dolore. Deserunt fugiat minim aute consectetur aliquip sunt do ex minim. Sit ea id nostrud reprehenderit occaecat aute.</p><p>Do aliqua deserunt elit. Ut pariatur do occaecat amet. Sunt ex elit officia ea id labore. Laborum sit nulla cupidatat ullamco aliquip nisi nostrud sit do cillum reprehenderit in ea aute tempor. Consequat voluptate qui consequat amet excepteur nostrud anim ea pariatur do.</p><p>Amet voluptate aliqua qui elit nulla magna elit commodo reprehenderit aliquip id non in. Sint in sit enim cupidatat dolor pariatur consequat sunt dolor dolore consequat laboris fugiat officia ex. Magna reprehenderit irure laboris nulla ea in velit veniam aute eu incididunt minim velit. Veniam minim pariatur tempor exercitation eu do culpa nisi eiusmod eiusmod.</p>',1,'2025-03-17 10:57:59','2025-04-10 15:54:58'),
	('0195fc5f-7c01-7001-b346-e67504b7d824','Struktur Organisasi','2025','04','struktur-organisasi','<p><img src=\"@storage/10af4bd1-63e8-44a7-9f61-3d3558e6908a.png\" width=\"100%\" height=\"100%\"></p><p>Cillum veniam exercitation enim dolor ullamco commodo reprehenderit dolore proident. Eiusmod dolore est aute in. Nisi id incididunt qui aliqua ut amet. Incididunt occaecat sit in consectetur ad do magna cupidatat aliqua sint velit eu elit proident cupidatat. Fugiat eiusmod ea dolore. Veniam excepteur sint proident aliqua reprehenderit fugiat tempor voluptate quis nisi duis nisi laborum minim ad. Sint aute non laborum laboris proident quis cupidatat occaecat exercitation duis.</p><p></p><p>Cillum veniam exercitation enim dolor ullamco commodo reprehenderit dolore proident. Eiusmod dolore est aute in. Nisi id incididunt qui aliqua ut amet. Incididunt occaecat sit in consectetur ad do magna cupidatat aliqua sint velit eu elit proident cupidatat. Fugiat eiusmod ea dolore. Veniam excepteur sint proident aliqua reprehenderit fugiat tempor voluptate quis nisi duis nisi laborum minim ad. Sint aute non laborum laboris proident quis cupidatat occaecat exercitation duis.</p><p></p><p>Cillum veniam exercitation enim dolor ullamco commodo reprehenderit dolore proident. Eiusmod dolore est aute in. Nisi id incididunt qui aliqua ut amet. Incididunt occaecat sit in consectetur ad do magna cupidatat aliqua sint velit eu elit proident cupidatat. Fugiat eiusmod ea dolore. Veniam excepteur sint proident aliqua reprehenderit fugiat tempor voluptate quis nisi duis nisi laborum minim ad. Sint aute non laborum laboris proident quis cupidatat occaecat exercitation duis.</p>',1,'2025-04-03 23:57:50','2025-04-10 15:48:21');

/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`)
VALUES
	('hafiznugrahaindonesia@gmail.com','$2y$12$1uklgL4d0kyxfTERi7cmlesewGpjQgK5t8p9k7FFGS14xGmtI8pua','2025-04-11 01:59:19');

/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(300,'view_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(301,'view_any_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(302,'create_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(303,'update_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(304,'reorder_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(305,'delete_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(306,'delete_any_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(307,'lock_agenda','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(308,'view_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(309,'view_any_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(310,'create_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(311,'update_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(312,'reorder_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(313,'delete_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(314,'delete_any_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(315,'lock_banner::link','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(324,'view_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(325,'view_any_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(326,'create_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(327,'update_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(328,'reorder_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(329,'delete_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(330,'delete_any_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(331,'lock_inovasi','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(332,'view_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(333,'view_any_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(334,'create_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(335,'update_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(336,'reorder_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(337,'delete_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(338,'delete_any_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(339,'lock_menu','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(340,'view_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(341,'view_any_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(342,'create_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(343,'update_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(344,'reorder_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(345,'delete_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(346,'delete_any_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(347,'lock_post','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(348,'view_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(349,'view_any_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(350,'create_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(351,'update_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(352,'reorder_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(353,'delete_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(354,'delete_any_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(355,'lock_post::category','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(356,'view_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(357,'view_any_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(358,'create_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(359,'update_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(360,'reorder_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(361,'delete_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(362,'delete_any_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(363,'lock_role','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(364,'view_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(365,'view_any_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(366,'create_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(367,'update_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(368,'reorder_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(369,'delete_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(370,'delete_any_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(371,'lock_slider','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(372,'view_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(373,'view_any_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(374,'create_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(375,'update_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(376,'reorder_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(377,'delete_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(378,'delete_any_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(379,'lock_social::media','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(380,'view_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(381,'view_any_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(382,'create_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(383,'update_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(384,'reorder_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(385,'delete_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(386,'delete_any_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(387,'lock_user','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(388,'page_PengaturanPimpinan','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(389,'page_GeneralSetting','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(390,'page_Logs','web','2025-03-16 16:09:41','2025-03-16 16:09:41'),
	(391,'view_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(392,'view_any_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(393,'create_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(394,'update_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(395,'reorder_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(396,'delete_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(397,'delete_any_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(398,'lock_kontak','web','2025-03-17 00:40:58','2025-03-17 00:40:58'),
	(399,'page_PengaturanLokasi','web','2025-03-17 10:25:07','2025-03-17 10:25:07'),
	(400,'widget_PostsChartYearly','web','2025-03-17 10:25:07','2025-03-17 10:25:07'),
	(401,'widget_PostsChartMonthly','web','2025-03-17 10:25:07','2025-03-17 10:25:07'),
	(402,'view_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(403,'view_any_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(404,'create_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(405,'update_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(406,'reorder_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(407,'delete_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(408,'delete_any_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(409,'lock_page','web','2025-03-17 10:46:24','2025-03-17 10:46:24'),
	(410,'view_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(411,'view_any_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(412,'create_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(413,'update_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(414,'reorder_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(415,'delete_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(416,'delete_any_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(417,'lock_contact','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(418,'page_EditProfilePage','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(419,'widget_VisitorChartMonthly','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(420,'widget_VisitorChartYearly','web','2025-03-17 13:08:11','2025-03-17 13:08:11'),
	(421,'view_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(422,'view_any_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(423,'create_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(424,'update_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(425,'reorder_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(426,'delete_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(427,'delete_any_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(428,'lock_innovation','web','2025-03-17 13:47:58','2025-03-17 13:47:58'),
	(429,'view_youtube::video','web','2025-03-17 17:18:38','2025-03-17 17:18:38'),
	(430,'view_any_youtube::video','web','2025-03-17 17:18:38','2025-03-17 17:18:38'),
	(431,'create_youtube::video','web','2025-03-17 17:18:38','2025-03-17 17:18:38'),
	(432,'update_youtube::video','web','2025-03-17 17:18:38','2025-03-17 17:18:38'),
	(433,'delete_youtube::video','web','2025-03-17 17:18:38','2025-03-17 17:18:38'),
	(434,'reorder_youtube::video','web','2025-03-17 17:18:38','2025-03-17 17:18:38'),
	(435,'delete_any_youtube::video','web','2025-03-17 17:18:40','2025-03-17 17:18:40'),
	(436,'lock_youtube::video','web','2025-03-17 17:19:07','2025-03-17 17:19:07'),
	(437,'page_ChangePassword','web','2025-03-30 12:44:26','2025-03-30 12:44:26'),
	(438,'page_PengaturanTema','web','2025-04-09 15:29:05','2025-04-09 15:29:05'),
	(439,'widget_VisitorCounterWidget','web','2025-04-11 01:38:38','2025-04-11 01:38:38'),
	(440,'page_Profile','web','2025-04-19 05:30:21','2025-04-19 05:30:21'),
	(441,'widget_SeeWebsiteWidget','web','2025-04-19 05:30:21','2025-04-19 05:30:21');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_categories`;

CREATE TABLE `post_categories` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;

INSERT INTO `post_categories` (`id`, `name`, `active`, `sort`, `created_at`, `updated_at`)
VALUES
	('79090fb4-8b47-46b0-9103-d1d05be7a72f','Berita Daerah',1,2,NULL,'2025-04-09 08:57:56'),
	('f7a9820d-d8c6-40c4-a568-50c4e07a126f','Informasi OPD',1,3,NULL,'2025-04-09 08:58:10');

/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_publish` tinyint(1) NOT NULL DEFAULT '1',
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visited` int NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
	(300,1),
	(301,1),
	(302,1),
	(303,1),
	(304,1),
	(305,1),
	(306,1),
	(307,1),
	(308,1),
	(309,1),
	(310,1),
	(311,1),
	(312,1),
	(313,1),
	(314,1),
	(315,1),
	(332,1),
	(333,1),
	(334,1),
	(335,1),
	(336,1),
	(337,1),
	(338,1),
	(339,1),
	(340,1),
	(341,1),
	(342,1),
	(343,1),
	(344,1),
	(345,1),
	(346,1),
	(347,1),
	(348,1),
	(349,1),
	(350,1),
	(351,1),
	(352,1),
	(353,1),
	(354,1),
	(355,1),
	(356,1),
	(357,1),
	(358,1),
	(359,1),
	(360,1),
	(361,1),
	(362,1),
	(363,1),
	(364,1),
	(365,1),
	(366,1),
	(367,1),
	(368,1),
	(369,1),
	(370,1),
	(371,1),
	(372,1),
	(373,1),
	(374,1),
	(375,1),
	(376,1),
	(377,1),
	(378,1),
	(379,1),
	(380,1),
	(381,1),
	(382,1),
	(383,1),
	(384,1),
	(385,1),
	(386,1),
	(387,1),
	(388,1),
	(389,1),
	(399,1),
	(401,1),
	(402,1),
	(403,1),
	(404,1),
	(405,1),
	(406,1),
	(407,1),
	(408,1),
	(409,1),
	(410,1),
	(411,1),
	(412,1),
	(413,1),
	(414,1),
	(415,1),
	(416,1),
	(417,1),
	(421,1),
	(422,1),
	(423,1),
	(424,1),
	(425,1),
	(426,1),
	(427,1),
	(428,1),
	(429,1),
	(430,1),
	(431,1),
	(432,1),
	(433,1),
	(434,1),
	(435,1),
	(436,1),
	(437,1),
	(438,1),
	(439,1),
	(440,1),
	(441,1),
	(300,3),
	(301,3),
	(302,3),
	(303,3),
	(304,3),
	(305,3),
	(306,3),
	(307,3),
	(308,3),
	(309,3),
	(310,3),
	(311,3),
	(312,3),
	(313,3),
	(314,3),
	(315,3),
	(332,3),
	(333,3),
	(334,3),
	(335,3),
	(336,3),
	(337,3),
	(338,3),
	(339,3),
	(340,3),
	(341,3),
	(342,3),
	(343,3),
	(344,3),
	(345,3),
	(346,3),
	(347,3),
	(348,3),
	(349,3),
	(350,3),
	(351,3),
	(352,3),
	(353,3),
	(354,3),
	(355,3),
	(364,3),
	(365,3),
	(366,3),
	(367,3),
	(368,3),
	(369,3),
	(370,3),
	(371,3),
	(372,3),
	(373,3),
	(374,3),
	(375,3),
	(376,3),
	(377,3),
	(378,3),
	(379,3),
	(388,3),
	(389,3),
	(399,3),
	(401,3),
	(402,3),
	(403,3),
	(404,3),
	(405,3),
	(406,3),
	(407,3),
	(408,3),
	(409,3),
	(410,3),
	(411,3),
	(412,3),
	(413,3),
	(414,3),
	(415,3),
	(416,3),
	(417,3),
	(421,3),
	(422,3),
	(423,3),
	(424,3),
	(425,3),
	(426,3),
	(427,3),
	(428,3),
	(429,3),
	(430,3),
	(431,3),
	(432,3),
	(433,3),
	(434,3),
	(435,3),
	(436,3),
	(437,3),
	(439,3),
	(440,3),
	(441,3);

/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(1,'Super Admin','web','2025-03-16 02:35:39','2025-03-17 17:21:49'),
	(3,'Admin','web','2025-03-16 16:00:51','2025-03-17 17:22:00');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `payload` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_group_name_unique` (`group`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `group`, `name`, `locked`, `payload`, `created_at`, `updated_at`) VALUES
(2, 'pengaturan-umum', 'nama_situs', 0, '\"CMS Tabalong\"', '2025-03-15 10:10:19', '2025-04-10 01:12:31'),
(3, 'pengaturan-umum', 'alamat', 0, '\"\"', '2025-03-15 10:10:19', '2025-03-15 23:27:48'),
(5, 'pengaturan-umum', 'logo', 0, '\"tabalong_xs.png\"', '2025-03-15 10:10:19', '2025-04-10 01:12:31'),
(6, 'pengaturan-umum', 'favicon', 0, '\"tabalong_xs.png\"', '2025-03-15 10:10:19', '2025-04-10 01:12:31'),
(7, 'pengaturan-pimpinan', 'nama_pimpinan', 0, '\"\"', '2025-03-15 10:10:47', '2025-04-01 10:21:46'),
(8, 'pengaturan-pimpinan', 'gambar_pimpinan', 0, '\"\"', '2025-03-15 10:10:47', '2025-04-01 10:21:46'),
(9, 'pengaturan-pimpinan', 'jabatan_pimpinan', 0, '\"\"', '2025-03-15 10:12:01', '2025-04-01 10:21:46'),
(10, 'pengaturan-lokasi', 'cari_lokasi', 0, '\"\"', '2025-03-16 09:16:23', '2025-04-01 09:48:26'),
(11, 'pengaturan-lokasi', 'latitude', 0, '-2.164137875624416', '2025-03-16 09:16:23', '2025-04-01 09:48:26'),
(12, 'pengaturan-lokasi', 'longitude', 0, '115.38259953260422', '2025-03-16 09:16:23', '2025-04-01 09:48:26'),
(13, 'pengaturan-lokasi', 'alamat', 0, '\"\"', '2025-04-01 08:42:12', '2025-04-01 09:48:26'),
(14, 'pengaturan-tema', 'primaryColor', 0, '\"#2091c2\"', '2025-04-08 23:33:48', '2025-04-10 00:11:17'),
(15, 'pengaturan-tema', 'secondaryColor', 0, '\"#fac369\"', '2025-04-08 23:33:48', '2025-04-10 00:11:17'),
(16, 'pengaturan-umum', 'logo_dinas', 0, '\"\"', '2025-04-09 22:58:35', '2025-04-10 01:12:31'),
(17, 'pengaturan-umum', 'nama_singkat', 0, '\"\"', '2025-04-09 23:05:58', '2025-04-10 01:12:31'),
(18	, 'pengaturan-umum', 'pengumuman', 0, '\"\"', '2025-04-09 23:05:58', '2025-04-10 01:12:31');


# Dump of table sliders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int NOT NULL DEFAULT '0',
  `hyperlink` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table social_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_media`;

CREATE TABLE `social_media` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_change_password` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `has_change_password`, `remember_token`, `created_at`, `updated_at`, `avatar_url`)
VALUES
	(1,'Super Admin','manusiakemos@gmail.com','2025-03-16 01:04:30','$2y$12$m6emY2MifR.dHjpXQR.8g.R10tNf0UB1NmcTrlqikBLESzit6nIie',1,'7iLTZkLPJDLJNq0KypUXtSVHMNQlauNO506NLTqJXqsTuDAANyn1TsxZqQY1','2025-03-16 01:04:30','2025-04-11 02:25:06',null),
	(4,'admin','hafiznugrahaindonesia@gmail.com','2025-04-11 01:30:21','$2y$12$rqgk3wq5k5prBjgw5t10m.d/fmk4773OgfMLSzaBwcyvx5pRk6Beq',0,NULL,'2025-04-11 01:30:22','2025-04-11 01:30:22',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table visits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `visits`;

CREATE TABLE `visits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `primary_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` bigint unsigned NOT NULL,
  `list` json DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `visits_primary_key_secondary_key_unique` (`primary_key`,`secondary_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table youtube_videos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `youtube_videos`;

CREATE TABLE `youtube_videos` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
