
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Developer','dev@dev.loc',1,4,'$2y$10$yqRS9OpuIA0gcsyi/zl/IegfvfOf.wIWlYoCHoqSviji71bi3QNYW',NULL,'2019-07-16 17:34:38','2019-07-16 17:34:38'),(2,'Manager','manager@bauten.loc',1,2,'$2y$10$4WDH57IEzMiaUUnfOvQNJumSQhd51XnaCR4XNTAmjfXYk0PWcIe7i',NULL,'2019-08-13 13:39:58','2019-08-13 18:33:30'),(4,'Администратор','admin@bauten.loc',1,3,'$2y$10$vygMi8dSzR2tKvkVrRMcUeizG9A3BEGP.SSpmUM8ozF4vsfF/YuV2',NULL,'2019-08-13 14:13:40','2019-08-13 18:17:20'),(6,'Operator','operator@bauten.loc',1,1,'$2y$10$BtG/JopWGZikak700YN2UOkoy60npVcyGPA8HUqM0E28S0X6pH3y6',NULL,'2019-08-13 18:09:32','2019-08-13 18:09:32');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'info','data','{\"logo\":\"Pm0K0wbmC4dq8RUtFD.png\",\"logo_footer\":\"Jn5ScwuggUbIRk5naD.png\",\"email\":\"info@bauten.kz\",\"seo_suffix\":\"Bauten\"}'),(2,'info','requisites','{\"address\":\"Алматы Казахстан, с. Мадениет уч. 383\",\"phone\":\"8 (777) 619 1747\",\"email\":\"info@bauten.kz\"}'),(3,'info','requisites','{\"address\":null,\"phone\":\"8 (707) 173 7656\",\"email\":null}'),(4,'info','requisites','{\"address\":null,\"phone\":\"8 (775) 996 1880\",\"email\":null}'),(5,'info','requisites','{\"address\":null,\"phone\":null,\"email\":null}'),(6,'info','socials','{\"icon\":\"r7TaX4Uwv46Rv8PhsZ.svg\",\"title\":\"Bautenautoparts\",\"url\":\"\\/\\/facebook.com\",\"active\":true}'),(7,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(8,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(9,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(10,'info','payment_logos','{\"logo\":\"VBwbBXfryteVdrgiAq.png\",\"title\":\"Visa\",\"alt\":\"Visa\",\"active\":true}'),(11,'info','payment_logos','{\"logo\":\"BVrxvSJCU8GMBef54i.png\",\"title\":\"Mastercard\",\"alt\":\"Mastercard\",\"active\":true}'),(12,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(13,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(14,'home','block_titles','{\"catalogue\":\"Каталог автозапчастей\",\"parts\":\"Запчасти по моделям\",\"brands\":\"Каталог брендов\",\"news\":\"Новости\"}'),(15,'home','banners','{\"image\":\"CJeBy3AZ2QcNXTSJ4M.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(16,'home','banners','{\"image\":\"bEoplwqXfw3F78LViZ.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Codeսադ55','Brand`',NULL,0,1,'2019-09-02 17:45:16','2019-09-02 17:46:22'),(2,'asdasd','Бранд2',NULL,0,1,'2019-09-02 18:08:10','2019-09-02 18:08:10');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (4,'Армения',1,1,'2019-08-15 10:07:44','2019-08-15 11:03:34'),(5,'Россия',2,1,'2019-08-15 11:03:21','2019-08-15 11:03:34'),(6,'Казахстан',0,1,'2019-08-15 11:03:25','2019-08-15 11:03:34');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `filter_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` int(11) NOT NULL,
  `filter_id` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filter_values_filter_id_foreign` (`filter_id`),
  CONSTRAINT `filter_values_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `filter_values` WRITE;
/*!40000 ALTER TABLE `filter_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `filter_values` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `is_global` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `filters` WRITE;
/*!40000 ALTER TABLE `filters` DISABLE KEYS */;
/*!40000 ALTER TABLE `filters` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` int(10) unsigned DEFAULT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (2,'parts',2,'bGWuKmYua2LQ4n7WB8.png',NULL,NULL,0),(3,'parts',2,'K9ZltFrRXKlm1PyjR8.png',NULL,NULL,0),(4,'parts',2,'ApfRQ8xDzSahxc5a1g.png',NULL,NULL,0);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `generations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `generations` WRITE;
/*!40000 ALTER TABLE `generations` DISABLE KEYS */;
INSERT INTO `generations` VALUES (1,7,'C 180',2,1,'2019-08-14 16:49:29','2019-08-14 16:56:14');
/*!40000 ALTER TABLE `generations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `home_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `home_slider` WRITE;
/*!40000 ALTER TABLE `home_slider` DISABLE KEYS */;
INSERT INTO `home_slider` VALUES (1,'9s2dEtftXKoVRSWygR.png','Автозапчасти вовремя','47 млн. предложений автозапчастей по актуальным ценам, которые привезем в наш офис или доставим курьером.',0,1,'2019-09-30 18:04:23','2019-09-30 18:04:23');
/*!40000 ALTER TABLE `home_slider` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (1,'Toyota',1,1,'2019-08-14 13:23:18','2019-08-14 14:42:11'),(2,'Bmw',2,1,'2019-08-14 13:23:22','2019-08-14 14:42:11'),(3,'Lexus',3,1,'2019-08-14 13:23:27','2019-08-14 14:42:11'),(4,'Mercedes-Benz',4,1,'2019-08-14 13:23:34','2019-08-14 14:42:11'),(5,'Suzuki',5,1,'2019-08-14 13:23:39','2019-08-14 14:42:11'),(6,'Volvo',6,1,'2019-08-14 13:23:43','2019-08-14 14:42:11'),(7,'Nissan',7,1,'2019-08-14 13:23:48','2019-08-14 14:42:11'),(8,'Jaguar',8,1,'2019-08-14 13:23:57','2019-08-14 14:42:11'),(9,'Land Rover',9,1,'2019-08-14 13:24:03','2019-08-14 14:42:11'),(10,'Renault',10,1,'2019-08-14 13:24:10','2019-08-14 14:42:11');
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_07_10_171502_create_admins_table',1),(2,'2019_07_12_204343_create_password_resets_table',1),(3,'2019_07_12_232636_create_pages_table',1),(5,'2019_08_12_192243_add_role_to_admins_table',2),(15,'2019_08_14_161704_create_marks_table',3),(16,'2019_08_14_161725_create_models_table',3),(18,'2019_08_14_161756_create_generations_table',3),(27,'2019_08_14_221246_create_countries_table',4),(28,'2019_08_14_221310_create_regions_table',4),(31,'2019_08_19_142314_create_parts_table',5),(32,'2019_08_19_165244_create_brands_table',6),(36,'2019_09_02_210329_create_part_catalogs_table',7),(37,'2019_09_02_214401_add_data_to_parts_table',7),(39,'2019_09_06_194022_create_part_cars_table',8),(40,'2019_07_23_000000_create_zakhayko_banners_table',9),(43,'2019_09_30_183624_create_home_slider_table',10),(44,'2019_10_01_205044_add_url_to_part_catalogs_table',11),(45,'2019_10_02_165526_add_price_and_url_to_parts_table',12),(47,'2019_10_02_181915_add_articule_to_parts_table',13),(49,'2019_10_02_183143_create_galleries_table',14),(52,'2019_10_02_204629_create_filters_table',15),(53,'2019_10_02_214520_create_filter_values_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mark_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (6,4,'B Class',2,1,'2019-08-14 14:40:39','2019-08-14 16:56:46'),(7,4,'C Class',3,1,'2019-08-14 14:40:46','2019-08-14 16:56:46'),(8,4,'E Class',4,1,'2019-08-14 14:40:53','2019-08-14 16:56:46'),(9,4,'S Class',5,1,'2019-08-14 14:40:58','2019-08-14 16:56:46'),(10,4,'ML Class',6,1,'2019-08-14 14:41:04','2019-08-14 16:56:46'),(11,4,'GLE Class',7,1,'2019-08-14 14:41:12','2019-08-14 16:56:46'),(13,4,'A Class',1,1,'2019-08-14 16:56:43','2019-08-14 16:56:46');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `static` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_menu` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','Главная','home',1,1,0,NULL,NULL,NULL,'2019-07-16 17:34:38','2019-07-16 17:34:38'),(2,'catalogue','Каталогы','catalogs',1,1,0,NULL,NULL,NULL,'2019-07-16 17:34:38','2019-07-16 17:34:38');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `part_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) unsigned NOT NULL,
  `mark_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL DEFAULT '0',
  `generation_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_cars` WRITE;
/*!40000 ALTER TABLE `part_cars` DISABLE KEYS */;
INSERT INTO `part_cars` VALUES (1,2,4,7,1),(2,2,1,0,0),(3,2,4,13,0);
/*!40000 ALTER TABLE `part_cars` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `part_catalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_catalogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part_catalogs_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_catalogs` WRITE;
/*!40000 ALTER TABLE `part_catalogs` DISABLE KEYS */;
INSERT INTO `part_catalogs` VALUES (1,'Каталог1','katalog1','2019-09-02 18:06:13','2019-10-01 17:09:09'),(2,'Каталог2','katalog2','2019-09-02 18:06:19','2019-10-01 17:09:15'),(3,'Каталог3','katalog3','2019-09-02 18:06:24','2019-10-01 17:09:22'),(4,'Амстердам','amsterdam','2019-09-02 18:06:31','2019-10-01 17:08:30'),(5,'Бесшовное покрытие SBR 10','besshovnoe-pokrytie-sbr-10','2019-09-30 18:35:39','2019-10-01 17:08:40'),(6,'Васдасса','vasdassa','2019-09-30 18:35:45','2019-10-01 17:08:48'),(7,'Гвеасд','gveasd','2019-09-30 18:35:50','2019-10-01 17:08:54'),(8,'Дасдасдас','dasdasdas','2019-09-30 18:35:55','2019-10-01 17:09:02');
/*!40000 ALTER TABLE `part_catalogs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `articule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_catalog_id` bigint(20) unsigned NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parts_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (2,'Code','Ремкомплект бескамерных шин \"AUTOPROFI\"',10000,'ZNZVqfeCj5GsKvxvpO.png','1500250','1500250','<p>Соответствие современным допускам автопроизводителей США, Евросоюза и Японии, что особенно ценно для смешанных автопарков и авторемонтных центров ∙ Соответствие требованиям стандарта удиненной замены ALLISON TES-295, позволяющее гарантировать пробег 100 000 км. ∙ Улучшенные показатели антивибрационной устойчивости ∙ Плавное и четкое переключение передач в течение всего срока службы жидкости ∙ Надежную защиту деталей</p>','remkomplekt-beskamernykh-shin-autoprofi',2,2,1,'2019-09-09 15:14:13','2019-10-02 15:18:24');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regions_country_id_title_unique` (`country_id`,`title`),
  CONSTRAINT `regions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (3,6,'Алматы',1,0,'2019-08-15 11:03:39','2019-08-15 11:03:39'),(4,6,'Астана',1,0,'2019-08-15 11:03:44','2019-08-15 11:03:44'),(5,4,'Yerevan',1,0,'2019-08-29 15:05:21','2019-08-29 15:05:21'),(6,4,'Abovyan',1,0,'2019-08-29 15:05:28','2019-08-29 15:05:28'),(7,4,'Masis',1,0,'2019-08-29 15:05:33','2019-08-29 15:05:33'),(8,4,'Ashtarak',1,0,'2019-08-29 15:05:37','2019-08-29 15:05:37'),(9,5,'Moskva',1,0,'2019-08-29 15:05:46','2019-08-29 15:05:46'),(10,5,'Voronej',1,0,'2019-08-29 15:05:51','2019-08-29 15:05:51'),(11,5,'Sankt Peterburg',1,0,'2019-08-29 15:06:01','2019-08-29 15:06:01');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

