
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
  `code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_phone_unique` (`phone`),
  UNIQUE KEY `admins_code_unique` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,NULL,'Developer','dev@dev.loc','055555555',1,4,'$2y$10$TRhlT00iAMKmgFNjmn7omebe4J9vEcZPYJHloVEUTifozPFhQkTxm',NULL,'2019-10-04 16:49:11','2019-10-11 12:57:53'),(2,NULL,'Administrator','admin@dev.loc','8799999999',1,3,'$2y$10$uNf.p3QYG8joLxREyiLTteYPdJXc5ueXhg.w4saBewY1xJrhi1SgS',NULL,'2019-10-04 16:49:11','2019-10-11 13:21:18'),(3,'4286921','Manager','manager@dev.loc','899999999',1,2,'$2y$10$vznTQeQ5g8M8W6D2gvaFUu/YTPgVrslPL2Tp3p/vVJrMxLWo0VWBC',NULL,'2019-10-04 16:49:11','2019-10-16 13:52:17'),(4,NULL,'Operator','operator@dev.loc','8799999997',1,1,'$2y$10$eD2pYhjIYMLaW7TLD0J1y.otxOlfTbBMjEMXyyxYHeHK2/n0encma',NULL,'2019-10-04 16:49:11','2019-10-11 13:19:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'info','data','{\"logo\":\"Pm0K0wbmC4dq8RUtFD.png\",\"logo_footer\":\"Jn5ScwuggUbIRk5naD.png\",\"email\":\"info@bauten.kz\",\"seo_suffix\":\"Bauten\"}'),(2,'info','requisites','{\"address\":\"Алматы Казахстан, с. Мадениет уч. 383\",\"phone\":\"8 (777) 619 1747\",\"email\":\"info@bauten.kz\"}'),(3,'info','requisites','{\"address\":null,\"phone\":\"8 (707) 173 7656\",\"email\":null}'),(4,'info','requisites','{\"address\":null,\"phone\":\"8 (775) 996 1880\",\"email\":null}'),(5,'info','requisites','{\"address\":null,\"phone\":null,\"email\":null}'),(6,'info','socials','{\"icon\":\"r7TaX4Uwv46Rv8PhsZ.svg\",\"title\":\"Bautenautoparts\",\"url\":\"\\/\\/facebook.com\",\"active\":true}'),(7,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(8,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(9,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(10,'info','payment_logos','{\"logo\":\"VBwbBXfryteVdrgiAq.png\",\"title\":\"Visa\",\"alt\":\"Visa\",\"active\":true}'),(11,'info','payment_logos','{\"logo\":\"BVrxvSJCU8GMBef54i.png\",\"title\":\"Mastercard\",\"alt\":\"Mastercard\",\"active\":true}'),(12,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(13,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(14,'home','block_titles','{\"catalogue\":\"Каталог автозапчастей\",\"parts\":\"Запчасти по маркам\",\"brands\":\"Каталог брендов\",\"news\":\"Новости\"}'),(15,'home','banners','{\"image\":\"CJeBy3AZ2QcNXTSJ4M.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(16,'home','banners','{\"image\":\"bEoplwqXfw3F78LViZ.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(17,'contacts','data','{\"requisites_title\":\"Контактные данные\",\"form_title\":\"Связаться с нами\",\"iframe\":\"https:\\/\\/yandex.ru\\/map-widget\\/v1\\/-\\/CGs8zXLJ\"}'),(18,'about','data','{\"banner\":\"2jIEDChPa3U629Yi2V.jpg\",\"banner_alt\":\"Alt\",\"banner_title\":\"Title\",\"banner_show\":true,\"content\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus nulla sit amet ultrices tincidunt. Integer bibendum dui ac ipsum scelerisque aliquet tempus at ipsum. Etiam imperdiet sit amet urna nec molestie. Nulla et urna odio. Sed sodales mauris justo, sed gravida elit scelerisque ut. Quisque imperdiet turpis pellentesque, egestas est nec, suscipit sem. Integer sagittis tortor in sem tempus bibendum. Donec nec volutpat erat. Integer diam libero, rhoncus molestie imperdiet eu, blandit in sem. Aliquam vehicula diam vitae nisl hendrerit, vel pellentesque felis varius. Fusce et felis neque. Nunc vitae interdum augue.<\\/p>\\r\\n\\r\\n<p>Integer in iaculis nisl. Aliquam non nisi hendrerit, maximus turpis pharetra, finibus diam. Nunc sit amet turpis vulputate, bibendum diam eu, lacinia ipsum. Cras id enim id velit laoreet bibendum sit amet in justo. Donec eu facilisis lectus, et pellentesque augue. Ut porta, odio eu eleifend suscipit, diam massa hendrerit neque, at molestie sapien sapien non urna. Etiam placerat molestie nibh quis imperdiet. Etiam laoreet mauris ex, ut vestibulum sem molestie eget. Praesent placerat, ex id tristique vehicula, odio ex scelerisque nibh, ut fringilla nisi leo id metus. Vivamus gravida hendrerit nisl ut porttitor. Aenean sagittis lorem eget massa tempor, quis ultricies eros accumsan.<\\/p>\\r\\n\\r\\n<p>Proin consequat egestas faucibus. Curabitur neque nulla, gravida at leo et, eleifend sollicitudin dolor. Cras lacinia eleifend ipsum et commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lorem diam, ullamcorper a sem eu, fermentum lobortis quam. Nam blandit non diam at semper. Maecenas consequat, orci ac sodales ornare, justo ipsum iaculis quam, eleifend convallis nulla arcu eget ex. Aenean quis augue urna. Suspendisse elementum lacinia est, eget varius orci dapibus ut. Donec condimentum libero sed purus dignissim, vel aliquet sem molestie.<\\/p>\"}'),(19,'images','data','{\"marks\":\"Rep1Qldt1IorvMSBMy.png\"}');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_home` tinyint(1) NOT NULL DEFAULT '0',
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'1','A-One','VblwLcqn5sxlxmVI8W.png',NULL,NULL,'a-one',1,2,1,'2019-10-04 17:07:27','2019-10-18 14:34:49'),(2,'2','Agp','qa3EyHS2FMzDg06llo.png','2','3','agp',1,3,1,'2019-10-07 14:59:42','2019-10-18 14:34:49'),(3,'3','Bauten','r1od7JHxVQMsEzlupL.png',NULL,NULL,'bauten',1,4,1,'2019-10-07 15:12:52','2019-10-18 14:34:49'),(4,'4','Baw','eBe3R3uICS0eVLAcIf.png',NULL,NULL,'baw',1,1,1,'2019-10-07 15:14:32','2019-10-18 14:34:49'),(5,'5','Camellia','cR0lJW3KoV8kI6LJTA.png',NULL,NULL,'camellia',1,5,1,'2019-10-07 15:14:44','2019-10-18 14:34:49'),(6,'6','Casp','WWEtCaBnPPkoWfX8wJ.png',NULL,NULL,'casp',1,6,1,'2019-10-07 15:14:55','2019-10-18 14:34:49'),(7,'7','Cft','t8cHK1jUiNbuFs9p1n.png',NULL,NULL,'cft',1,7,1,'2019-10-07 15:15:07','2019-10-18 14:34:49'),(8,'8','Depo','yRtTjuk2klx7iwF4oO.png',NULL,NULL,'depo',1,8,1,'2019-10-07 15:15:19','2019-10-18 14:34:49'),(9,'9','Visa','L7obyzDUkyl0JEXlxl.png',NULL,NULL,'visa',1,9,1,'2019-10-07 15:15:39','2019-10-18 14:34:49'),(11,'10','Deye','6OT8Pnkarj28bTUWEz.png',NULL,NULL,'deye',1,10,1,'2019-10-07 15:17:14','2019-10-18 14:34:49'),(12,'11','Did','xHSHWZHIhy3MJXZ6D3.png',NULL,NULL,'did',1,11,1,'2019-10-07 15:17:25','2019-10-18 14:34:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Казахстан',0,1,'2019-10-04 16:58:38','2019-10-04 16:58:38'),(2,'Россия',0,1,'2019-10-04 16:58:45','2019-10-04 16:58:45'),(3,'Армения',0,1,'2019-10-04 16:58:49','2019-10-04 16:58:49');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteria` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filter_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `criteria_filter_id_foreign` (`filter_id`),
  CONSTRAINT `criteria_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `criteria` WRITE;
/*!40000 ALTER TABLE `criteria` DISABLE KEYS */;
INSERT INTO `criteria` VALUES (1,1,'Criterion 1',0,'2019-10-08 16:42:13','2019-10-08 16:42:13'),(2,1,'Criterion 2',0,'2019-10-08 16:42:17','2019-10-08 16:42:17'),(3,1,'Criterion 3',0,'2019-10-08 16:42:22','2019-10-08 16:42:22'),(4,4,'Criterion 1',2,'2019-10-08 16:42:34','2019-10-09 14:45:52'),(5,4,'Criterion 2',1,'2019-10-08 16:42:38','2019-10-09 14:45:52'),(6,5,'Crit',0,'2019-10-08 17:25:05','2019-10-08 17:25:05');
/*!40000 ALTER TABLE `criteria` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `criterion_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterion_part` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `criterion_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `criterion_part_criterion_id_foreign` (`criterion_id`),
  KEY `criterion_part_part_id_foreign` (`part_id`),
  CONSTRAINT `criterion_part_criterion_id_foreign` FOREIGN KEY (`criterion_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE,
  CONSTRAINT `criterion_part_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `criterion_part` WRITE;
/*!40000 ALTER TABLE `criterion_part` DISABLE KEYS */;
INSERT INTO `criterion_part` VALUES (8,6,4),(9,1,4),(10,2,4),(11,3,4),(12,4,4),(13,5,4),(14,1,5),(15,2,5),(16,3,5),(17,4,5),(18,5,5),(19,6,5);
/*!40000 ALTER TABLE `criterion_part` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `engine_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_criteria` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `engine_filter_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `engine_criteria_engine_filter_id_foreign` (`engine_filter_id`),
  CONSTRAINT `engine_criteria_engine_filter_id_foreign` FOREIGN KEY (`engine_filter_id`) REFERENCES `engine_filters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engine_criteria` WRITE;
/*!40000 ALTER TABLE `engine_criteria` DISABLE KEYS */;
INSERT INTO `engine_criteria` VALUES (1,1,'Дизельный',0,'2019-10-11 11:10:14','2019-10-11 11:10:14'),(2,1,'Бензиновый',0,'2019-10-11 11:10:36','2019-10-11 11:10:36');
/*!40000 ALTER TABLE `engine_criteria` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `engine_filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engine_filters` WRITE;
/*!40000 ALTER TABLE `engine_filters` DISABLE KEYS */;
INSERT INTO `engine_filters` VALUES (1,'Тип',0,'2019-10-11 11:08:24','2019-10-11 11:08:29');
/*!40000 ALTER TABLE `engine_filters` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filters_group_id_foreign` (`group_id`),
  CONSTRAINT `filters_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `filters` WRITE;
/*!40000 ALTER TABLE `filters` DISABLE KEYS */;
INSERT INTO `filters` VALUES (1,'Filter 1',NULL,1,1,'2019-10-08 15:26:34','2019-10-10 15:50:55'),(4,'Filter 2',NULL,3,1,'2019-10-08 16:42:28','2019-10-10 15:50:55'),(5,'Filter 5',1,1,1,'2019-10-08 17:12:56','2019-10-08 17:20:34'),(6,'Filter 3',NULL,2,1,'2019-10-08 17:16:36','2019-10-10 15:50:55'),(7,'Filter 6',1,2,1,'2019-10-08 17:20:27','2019-10-08 17:20:34');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `generations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `generations_model_id_foreign` (`model_id`),
  CONSTRAINT `generations_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `generations` WRITE;
/*!40000 ALTER TABLE `generations` DISABLE KEYS */;
/*!40000 ALTER TABLE `generations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Группа 1','gruppa-1',1,'2019-10-08 13:11:48','2019-10-18 14:06:31'),(2,'Группа 2','gruppa-2',2,'2019-10-08 13:11:53','2019-10-18 14:06:31'),(3,'Группа 3','gruppa-3',3,'2019-10-08 13:12:29','2019-10-18 14:06:31');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
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
INSERT INTO `home_slider` VALUES (1,'9s2dEtftXKoVRSWygR.png','Автозапчасти вовремя','47 млн. предложений автозапчастей по актуальным ценам, которые привезем в наш офис или доставим курьером.',0,1,'2019-09-30 14:04:23','2019-09-30 14:04:23');
/*!40000 ALTER TABLE `home_slider` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_image` tinyint(1) NOT NULL DEFAULT '1',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_home` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `marks_cid_unique` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (1,'0','TOYOTA',NULL,NULL,NULL,1,'toyota',0,1),(2,'1','SUBARU',NULL,NULL,NULL,1,'subaru',0,1),(3,'2','SUZUKI',NULL,NULL,NULL,1,'suzuki',0,1),(4,'3','MAZDA',NULL,NULL,NULL,1,'mazda',0,1),(5,'4','MERCEDES-BENZ',NULL,NULL,NULL,1,'mercedes-benz',0,1),(6,'5','MITSUBISHI',NULL,NULL,NULL,1,'mitsubishi',0,1),(7,'6','NISSAN',NULL,NULL,NULL,1,'nissan',0,1),(8,'7','DAIHATSU',NULL,NULL,NULL,1,'daihatsu',0,1),(9,'8','HONDA',NULL,NULL,NULL,1,'honda',0,1),(10,'9','ISUZU',NULL,NULL,NULL,1,'isuzu',0,1),(11,'10','OPEL',NULL,NULL,NULL,1,'opel',0,1),(12,'11','CHEVROLET',NULL,NULL,NULL,1,'chevrolet',0,1),(13,'12','LEXUS',NULL,NULL,NULL,1,'lexus',0,1),(14,'13','SSANGYONG',NULL,NULL,NULL,1,'ssangyong',0,1),(15,'14','HYUNDAI',NULL,NULL,NULL,1,'hyundai',0,1),(16,'15','KIA',NULL,NULL,NULL,1,'kia',0,1),(17,'16','DAEWOO',NULL,NULL,NULL,1,'daewoo',0,1),(18,'17','INFINITI',NULL,NULL,NULL,1,'infiniti',0,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mark_id` int(10) unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `models_name_mark_id_unique` (`name`,`mark_id`),
  KEY `models_mark_id_foreign` (`mark_id`),
  CONSTRAINT `models_mark_id_foreign` FOREIGN KEY (`mark_id`) REFERENCES `marks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,8,'CHARADE',1),(2,8,'CUORE',1),(3,8,'FEROZA',1),(4,8,'ROCKY',1),(5,8,'CHARMANT',1),(6,8,'GRAN MOVE',1),(7,8,'WILDCAT',1),(8,8,'TERIOS',1),(9,8,'HIJET',1),(10,8,'SIRION',1),(11,8,'APPLAUSE',1),(12,8,'TAFT',1),(13,8,'SPARCAR',1),(14,8,'YRV',1),(15,8,'COPEN',1),(16,8,'MATERIA',1),(17,8,'TREVIS',1),(18,8,'XENIA',1),(19,8,'DELTA WIDE',1),(20,8,'EXTOL',1),(21,9,'CIVIC',1),(22,9,'ACCORD',1),(23,9,'LEGEND',1),(24,9,'PRELUDE',1),(25,9,'CR-X',1),(26,9,'NSX',1),(27,9,'JAZZ',1),(28,9,'QUINTET',1),(29,9,'CONCERTO',1),(30,9,'SHUTTLE',1),(31,9,'CR-V',1),(32,9,'INTEGRA',1),(33,9,'HR-V',1),(34,9,'LOGO',1),(35,9,'INSIGHT',1),(36,9,'FR-V',1),(37,9,'ODYSSEY',1),(38,9,'PILOT',1),(39,10,'TROOPER',1),(40,10,'GEMINI',1),(41,10,'CAMPO',1),(42,10,'PIAZZA',1),(43,10,'MIDI',1),(44,10,'IMPULSE',1),(45,10,'D-MAX',1),(46,10,'ASCENDER',1),(47,10,'ELF',1),(48,10,'TFR/TFS',1),(49,10,'WFR',1),(50,10,'GRAFTER',1),(51,4,'XEDOS',1),(52,4,'121',1),(53,4,'929',1),(54,4,'RX 7',1),(55,4,'323',1),(56,4,'MX-3',1),(57,4,'MX-5',1),(58,4,'MX-6',1),(59,4,'626',1),(60,4,'MPV',1),(61,4,'DEMIO',1),(62,4,'PREMACY',1),(63,4,'TRIBUTE',1),(64,4,'6',1),(65,4,'RX 5',1),(66,4,'2',1),(67,4,'RX 8',1),(68,4,'3',1),(69,4,'5',1),(70,4,'SPECTRON',1),(71,4,'CX-7',1),(72,4,'CX-9',1),(73,4,'CX-5',1),(74,4,'VERISA',1),(75,4,'AZOFFROAD',1),(76,4,'CX-3',1),(77,4,'LANTIS',1),(78,4,'CAPELLA',1),(79,4,'CRONUS',1),(80,5,'COUPE',1),(81,5,'KOMBI',1),(82,5,'S-CLASS',1),(83,5,'190',1),(84,5,'G-CLASS',1),(85,5,'CABRIOLET',1),(86,5,'E-CLASS',1),(87,5,'C-CLASS',1),(88,5,'PAGODE',1),(89,5,'PONTON',1),(90,5,'VITO',1),(91,5,'TOURISMO',1),(92,5,'SLK',1),(93,5,'ACTROS',1),(94,5,'170',1),(95,5,'CLK',1),(96,5,'A-CLASS',1),(97,5,'M-CLASS',1),(98,5,'ATEGO',1),(99,5,'CITARO',1),(100,5,'SL',1),(101,5,'GULLWING',1),(102,5,'LP',1),(103,5,'LK/LN2',1),(104,5,'MK',1),(105,5,'SK',1),(106,5,'V-CLASS',1),(107,5,'TRAVEGO',1),(108,5,'ECONIC',1),(109,5,'UNIMOG',1),(110,5,'VANEO',1),(111,5,'CLS',1),(112,5,'SLR',1),(113,5,'R-CLASS',1),(114,5,'AMG',1),(115,6,'COLT',1),(116,6,'CORDIA',1),(117,6,'LANCER',1),(118,6,'SAPPORO',1),(119,6,'SIGMA',1),(120,6,'SPACE WAGON',1),(121,6,'STARION',1),(122,6,'ECLIPSE',1),(123,6,'PAJERO',1),(124,6,'GALANT',1),(125,6,'TREDIA',1),(126,6,'CELESTE',1),(127,6,'CARISMA',1),(128,6,'L 200',1),(129,6,'L 300',1),(130,6,'SPACE RUNNER',1),(131,6,'SANTAMO',1),(132,6,'L 400',1),(133,6,'PROUDIA',1),(134,6,'AIRTREK',1),(135,6,'GRANDIS',1),(136,6,'OUTLANDER',1),(137,6,'DIAMANTE',1),(138,6,'MIRAGE',1),(139,6,'GTO',1),(140,6,'LANCER SPORTBACK (CX_A)',1),(141,6,'ASX',1),(142,6,'DELICA',1),(143,6,'LEGNUM',1),(144,7,'CABSTAR',1),(145,7,'LAUREL',1),(146,7,'MICRA',1),(147,7,'SUNNY',1),(148,7,'MAXIMA',1),(149,7,'280 ZX',1),(150,7,'200 SX',1),(151,7,'100 NX',1),(152,7,'CHERRY',1),(153,7,'PRAIRIE',1),(154,7,'PRIMERA',1),(155,7,'BLUEBIRD',1),(156,7,'STANZA',1),(157,7,'TERRANO',1),(158,7,'URVAN',1),(159,7,'300 ZX (Z32)',1),(160,7,'PATROL',1),(161,7,'SERENA',1),(162,7,'VANETTE',1),(163,7,'ALMERA',1),(164,7,'SILVIA',1),(165,7,'DATSUN',1),(166,7,'X-TRAIL',1),(167,7,'350 Z',1),(168,7,'ATLEON',1),(169,7,'KUBISTAR',1),(170,7,'MURANO',1),(171,7,'PATHFINDER',1),(172,7,'NAVARA',1),(173,7,'QASHQAI',1),(174,7,'CEDRIC',1),(175,7,'TIIDA',1),(176,7,'AVENIR',1),(177,7,'CEFIRO',1),(178,7,'CIMA',1),(179,7,'GT-R',1),(180,7,'370 Z',1),(181,7,'PIXO',1),(182,7,'TEANA',1),(183,7,'NV200',1),(184,7,'NT500',1),(185,7,'SKYLINE',1),(186,7,'QX4',1),(187,7,'ELGRAND',1),(188,7,'ARMADA',1),(189,7,'JUKE',1),(190,7,'PRESAGE',1),(191,7,'PULSAR',1),(192,7,'X-TERRA',1),(193,11,'ADAM',1),(194,11,'ADMIRAL',1),(195,11,'AGILA',1),(196,11,'AMPERA',1),(197,11,'ANTARA',1),(198,11,'ARENA',1),(199,11,'ASCONA',1),(200,11,'ASTRA',1),(201,11,'CALIBRA',1),(202,11,'CAMPO',1),(203,11,'CASCADA',1),(204,11,'COMBO',1),(205,11,'COMMODORE',1),(206,11,'CORSA',1),(207,11,'CROSSLAND',1),(208,11,'DIPLOMAT',1),(209,11,'FRONTERA',1),(210,11,'GRANDLAND',1),(211,11,'GT',1),(212,11,'INSIGNIA',1),(213,11,'KADETT',1),(214,11,'KAPITÄN',1),(215,11,'KARL',1),(216,11,'MANTA',1),(217,11,'MERIVA',1),(218,11,'MOKKA',1),(219,11,'MONTEREY',1),(220,11,'MONZA',1),(221,11,'MOVANO',1),(222,11,'OLYMPIA',1),(223,11,'OMEGA',1),(224,11,'REKORD',1),(225,11,'SENATOR',1),(226,11,'SIGNUM',1),(227,11,'SINTRA',1),(228,11,'SPEEDSTER',1),(229,11,'TIGRA',1),(230,11,'VECTRA',1),(231,11,'VIVARO',1),(232,11,'ZAFIRA',1),(233,2,'LEONE',1),(234,2,'LEGACY',1),(235,2,'XT',1),(236,2,'JUSTY',1),(237,2,'LIBERO',1),(238,2,'IMPREZA',1),(239,2,'FORESTER',1),(240,2,'VIVIO',1),(241,2,'SVX',1),(242,2,'REX',1),(243,2,'OUTBACK',1),(244,2,'TRIBECA',1),(245,2,'MV',1),(246,2,'TREZIA',1),(247,2,'XV',1),(248,2,'BRZ',1),(249,2,'LEVORG',1),(250,2,'WRX',1),(251,3,'SWIFT',1),(252,3,'ALTO',1),(253,3,'CARRY',1),(254,3,'LJ 80',1),(255,3,'VITARA',1),(256,3,'SJ 410',1),(257,3,'SAMURAI',1),(258,3,'SJ 413',1),(259,3,'BALENO',1),(260,3,'X-90',1),(261,3,'WAGON R+',1),(262,3,'JIMNY',1),(263,3,'CAPPUCINO',1),(264,3,'IGNIS',1),(265,3,'LIANA',1),(266,3,'SX4',1),(267,3,'SPLASH',1),(268,3,'KIZASHI',1),(269,3,'CELERIO',1),(270,3,'XL-7',1),(271,12,'TRANS SPORT',1),(272,12,'LUMINA',1),(273,12,'BLAZER',1),(274,12,'CORVETTE',1),(275,12,'BERETTA',1),(276,12,'CORSICA',1),(277,12,'CAMARO',1),(278,12,'CAPRICE',1),(279,12,'MALIBU',1),(280,12,'IMPALA',1),(281,12,'ALERO',1),(282,12,'TAHOE',1),(283,12,'TRAIL',1),(284,12,'MATIZ',1),(285,12,'KALOS',1),(286,12,'LACETTI',1),(287,12,'NUBIRA',1),(288,12,'REZZO',1),(289,12,'EVANDA',1),(290,12,'AVEO',1),(291,12,'EPICA',1),(292,12,'CAPTIVA',1),(293,12,'ASTRO',1),(294,12,'CAVALIER',1),(295,12,'CORSA',1),(296,12,'SPARK',1),(297,12,'SUBURBAN',1),(298,12,'VECTRA',1),(299,12,'ZAFIRA',1),(300,12,'EQUINOX',1),(301,12,'TRACKER',1),(302,12,'VENTURE',1),(303,12,'VIVA',1),(304,12,'AVALANCHE',1),(305,12,'ORLANDO',1),(306,12,'NIVA',1),(307,12,'SENS',1),(308,12,'SILVERADO',1),(309,12,'COBALT',1),(310,12,'MW',1),(311,15,'ACCENT',1),(312,15,'COUPE',1),(313,15,'SONATA',1),(314,15,'LANTRA',1),(315,15,'H-1',1),(316,15,'PONY',1),(317,15,'XG',1),(318,15,'TRAJET',1),(319,15,'ELANTRA',1),(320,15,'GALLOPER',1),(321,15,'SANTA FÉ',1),(322,15,'SANTAMO',1),(323,15,'MATRIX',1),(324,15,'TERRACAN',1),(325,15,'GETZ',1),(326,15,'TUCSON',1),(327,15,'GRANDEUR',1),(328,15,'EQUUS',1),(329,15,'i10',1),(330,15,'i20',1),(331,15,'i30',1),(332,15,'i35',1),(333,15,'i40',1),(334,15,'i55',1),(335,15,'PORTER',1),(336,15,'AERO',1),(337,15,'UNIVERSE',1),(338,15,'HD',1),(339,15,'COUNTY',1),(340,15,'GENESIS',1),(341,15,'CENTENNIAL',1),(342,15,'SOLARIS',1),(343,15,'VELOSTER',1),(344,15,'GRACE',1),(345,15,'MARCIA',1),(346,16,'SEPHIA',1),(347,16,'SPORTAGE',1),(348,16,'PRIDE',1),(349,16,'CLARUS',1),(350,16,'BESTA',1),(351,16,'PREGIO',1),(352,16,'CARNIVAL',1),(353,16,'ROADSTER',1),(354,16,'RETONA',1),(355,16,'JOICE',1),(356,16,'RIO',1),(357,16,'CARENS',1),(358,16,'MAGENTIS',1),(359,16,'SHUMA',1),(360,16,'SORENTO',1),(361,16,'OPIRUS',1),(362,16,'SPECTRA',1),(363,16,'CERATO',1),(364,16,'PICANTO',1),(365,16,'CEE\'D',1),(366,16,'AVELLA',1),(367,16,'BONGO',1),(368,16,'CERES',1),(369,16,'SOUL',1),(370,16,'CAPITAL',1),(371,16,'VENGA',1),(372,16,'OPTIMA',1),(373,16,'CADENZA',1),(374,16,'QUORIS',1),(375,16,'ENTERPRISE',1),(376,17,'ESPERO',1),(377,17,'CIELO',1),(378,17,'TICO',1),(379,17,'ORION',1),(380,17,'KONDOR',1),(381,17,'LANOS',1),(382,17,'NUBIRA',1),(383,17,'MATIZ',1),(384,17,'LUBLIN II',1),(385,17,'MUSSO',1),(386,17,'KORANDO',1),(387,17,'REZZO',1),(388,17,'REXTON',1),(389,17,'KALOS',1),(390,17,'EVANDA',1),(391,17,'LACETTI',1),(392,17,'PRINCE',1),(393,17,'ADVENTRA',1),(394,17,'DAMAS',1),(395,17,'LABO',1),(396,17,'LEMANS',1),(397,17,'MAGNUS',1),(398,17,'TOSCA',1),(399,17,'NOVUS',1),(400,17,'PRIMA',1),(401,17,'BROUGHAM',1),(402,17,'GENTRA',1),(403,17,'LEGANZA',1),(404,13,'ES',1),(405,13,'GS',1),(406,13,'IS',1),(407,13,'LS',1),(408,13,'RX',1),(409,13,'SC',1),(410,13,'LFA',1),(411,13,'CT',1),(412,13,'LX',1),(413,13,'GX',1),(414,13,'RC',1),(415,13,'NX',1),(416,18,'G20',1),(417,18,'I30',1),(418,18,'J30',1),(419,18,'M30',1),(420,18,'Q45',1),(421,18,'QX4',1),(422,18,'FX',1),(423,18,'M35',1),(424,18,'EX',1),(425,18,'G',1),(426,18,'M',1),(427,18,'M37',1),(428,18,'QX56',1),(429,18,'JX',1),(430,18,'Q50',1),(431,18,'Q60',1),(432,18,'QX70',1),(433,18,'QX50',1),(434,18,'QX60',1),(435,18,'Q70',1),(436,18,'QX80',1),(437,18,'Q30',1),(438,18,'QX30',1),(439,18,'G35',1),(440,18,'G37',1),(441,1,'RAV 4',1),(442,1,'COROLLA',1),(443,1,'CORONA',1),(444,1,'LAND CRUISER',1),(445,1,'CRESSIDA',1),(446,1,'LITEACE',1),(447,1,'SUPRA',1),(448,1,'4 RUNNER',1),(449,1,'CAMRY',1),(450,1,'CARINA',1),(451,1,'CELICA',1),(452,1,'HILUX',1),(453,1,'AVENSIS',1),(454,1,'YARIS',1),(455,1,'FORTUNER',1),(456,1,'HIGHLANDER',1),(457,1,'NOAH',1),(458,1,'MARK II',1),(459,1,'AVALON',1),(460,1,'LAND CRUISER PRADO',1),(461,1,'ALPHARD',1),(462,1,'SEQUOIA',1),(463,1,'TUNDRA',1),(464,1,'ESTIMA',1),(465,1,'TOWN ACE',1);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Чинить автомобили по ОСАГО предложили старыми деталями','chinit-avtomobili-po-osago-predlozhili-starymi-detalyami-2','pIU8yiOEqb4xrSOOPU.png',NULL,NULL,'В России могут разрешить использование старых деталей при ремонте автомобиля в рамках ОСАГО наравне с новыми. При этом согласие владельца машины на это не потребуется.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed libero vitae arcu pulvinar laoreet. Sed pellentesque velit tincidunt, tincidunt lorem id, mollis odio. Mauris auctor nunc eget eleifend pretium. Morbi bibendum tempor eros ac pretium. Donec et turpis pellentesque, molestie ligula sed, finibus ligula. Nullam dolor ipsum, faucibus id tincidunt sed, sollicitudin ultrices nisi. Nunc tempus fringilla libero eu convallis. Duis pretium maximus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent iaculis aliquet libero, tempor dignissim ex facilisis in.</p>\r\n\r\n<p>Mauris pulvinar bibendum eros id eleifend. Donec lobortis augue enim, a varius nulla posuere ac. Sed est mi, luctus sed ipsum nec, pellentesque luctus ligula. Aliquam erat volutpat. Nam in ultrices diam. Fusce venenatis mi eget rhoncus porttitor. Aenean convallis elementum neque, ut feugiat justo luctus ut. Donec metus odio, finibus quis facilisis vitae, dignissim eget erat. Vestibulum odio nibh, laoreet non ipsum ac, blandit vulputate lacus. Donec fringilla tempus finibus.</p>\r\n\r\n<p>Cras vehicula mattis erat, in condimentum elit efficitur non. Vivamus et molestie nibh. Quisque et risus in lacus maximus tempor. Morbi non dignissim diam. Ut pellentesque ornare ligula eu laoreet. Curabitur congue ante et ipsum euismod ornare. Fusce venenatis mollis sollicitudin. Vestibulum erat dolor, fringilla ac semper luctus, euismod at nulla.</p>\r\n\r\n<p>Nullam posuere varius orci a dapibus. Cras porttitor ex ac libero pharetra, ullamcorper accumsan diam dapibus. Praesent in interdum arcu, aliquet bibendum sapien. Etiam tristique purus quis velit hendrerit, egestas volutpat nunc scelerisque. Duis ac lobortis augue. Morbi a interdum nisi. Cras venenatis rhoncus maximus. Nulla eu enim vel magna lacinia faucibus ut sed metus. Cras placerat venenatis aliquet. Nulla facilisis metus non nisi venenatis, ut fringilla nibh egestas. Duis sit amet metus quis neque scelerisque sodales vitae nec leo. Aliquam porta metus in metus ornare blandit. In congue sit amet nisi non tempor. Vestibulum malesuada justo ut mauris mattis faucibus at nec lacus. Aenean facilisis eros sed odio maximus, et rutrum felis placerat.</p>','3','5','4',1,'2019-10-07 11:50:25','2019-10-07 11:59:48'),(2,'Чинить автомобили по ОСАГО предложили старыми деталями','chinit-avtomobili-po-osago-predlozhili-starymi-detalyami','qt2ZJv8Xlam5CujC0U.png','alt','title','В России могут разрешить использование старых деталей при ремонте автомобиля в рамках ОСАГО наравне с новыми. При этом согласие владельца машины на это не потребуется.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed libero vitae arcu pulvinar laoreet. Sed pellentesque velit tincidunt, tincidunt lorem id, mollis odio. Mauris auctor nunc eget eleifend pretium. Morbi bibendum tempor eros ac pretium. Donec et turpis pellentesque, molestie ligula sed, finibus ligula. Nullam dolor ipsum, faucibus id tincidunt sed, sollicitudin ultrices nisi. Nunc tempus fringilla libero eu convallis. Duis pretium maximus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent iaculis aliquet libero, tempor dignissim ex facilisis in.</p>\r\n\r\n<p>Mauris pulvinar bibendum eros id eleifend. Donec lobortis augue enim, a varius nulla posuere ac. Sed est mi, luctus sed ipsum nec, pellentesque luctus ligula. Aliquam erat volutpat. Nam in ultrices diam. Fusce venenatis mi eget rhoncus porttitor. Aenean convallis elementum neque, ut feugiat justo luctus ut. Donec metus odio, finibus quis facilisis vitae, dignissim eget erat. Vestibulum odio nibh, laoreet non ipsum ac, blandit vulputate lacus. Donec fringilla tempus finibus.</p>\r\n\r\n<p>Cras vehicula mattis erat, in condimentum elit efficitur non. Vivamus et molestie nibh. Quisque et risus in lacus maximus tempor. Morbi non dignissim diam. Ut pellentesque ornare ligula eu laoreet. Curabitur congue ante et ipsum euismod ornare. Fusce venenatis mollis sollicitudin. Vestibulum erat dolor, fringilla ac semper luctus, euismod at nulla.</p>\r\n\r\n<p>Nullam posuere varius orci a dapibus. Cras porttitor ex ac libero pharetra, ullamcorper accumsan diam dapibus. Praesent in interdum arcu, aliquet bibendum sapien. Etiam tristique purus quis velit hendrerit, egestas volutpat nunc scelerisque. Duis ac lobortis augue. Morbi a interdum nisi. Cras venenatis rhoncus maximus. Nulla eu enim vel magna lacinia faucibus ut sed metus. Cras placerat venenatis aliquet. Nulla facilisis metus non nisi venenatis, ut fringilla nibh egestas. Duis sit amet metus quis neque scelerisque sodales vitae nec leo. Aliquam porta metus in metus ornare blandit. In congue sit amet nisi non tempor. Vestibulum malesuada justo ut mauris mattis faucibus at nec lacus. Aenean facilisis eros sed odio maximus, et rutrum felis placerat.</p>',NULL,NULL,NULL,1,'2019-10-07 11:50:45','2019-10-06 20:00:00'),(3,'Чинить автомобили по ОСАГО предложили старыми деталями','chinit-avtomobili-po-osago-predlozhili-starymi-detalyami-3','30dCiMMJVxnqvzSa3c.png',NULL,NULL,'В России могут разрешить использование старых деталей при ремонте автомобиля в рамках ОСАГО наравне с новыми. При этом согласие владельца машины на это не потребуется.','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed libero vitae arcu pulvinar laoreet. Sed pellentesque velit tincidunt, tincidunt lorem id, mollis odio. Mauris auctor nunc eget eleifend pretium. Morbi bibendum tempor eros ac pretium. Donec et turpis pellentesque, molestie ligula sed, finibus ligula. Nullam dolor ipsum, faucibus id tincidunt sed, sollicitudin ultrices nisi. Nunc tempus fringilla libero eu convallis. Duis pretium maximus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent iaculis aliquet libero, tempor dignissim ex facilisis in.</p>\r\n\r\n<p>Mauris pulvinar bibendum eros id eleifend. Donec lobortis augue enim, a varius nulla posuere ac. Sed est mi, luctus sed ipsum nec, pellentesque luctus ligula. Aliquam erat volutpat. Nam in ultrices diam. Fusce venenatis mi eget rhoncus porttitor. Aenean convallis elementum neque, ut feugiat justo luctus ut. Donec metus odio, finibus quis facilisis vitae, dignissim eget erat. Vestibulum odio nibh, laoreet non ipsum ac, blandit vulputate lacus. Donec fringilla tempus finibus.</p>\r\n\r\n<p>Cras vehicula mattis erat, in condimentum elit efficitur non. Vivamus et molestie nibh. Quisque et risus in lacus maximus tempor. Morbi non dignissim diam. Ut pellentesque ornare ligula eu laoreet. Curabitur congue ante et ipsum euismod ornare. Fusce venenatis mollis sollicitudin. Vestibulum erat dolor, fringilla ac semper luctus, euismod at nulla.</p>\r\n\r\n<p>Nullam posuere varius orci a dapibus. Cras porttitor ex ac libero pharetra, ullamcorper accumsan diam dapibus. Praesent in interdum arcu, aliquet bibendum sapien. Etiam tristique purus quis velit hendrerit, egestas volutpat nunc scelerisque. Duis ac lobortis augue. Morbi a interdum nisi. Cras venenatis rhoncus maximus. Nulla eu enim vel magna lacinia faucibus ut sed metus. Cras placerat venenatis aliquet. Nulla facilisis metus non nisi venenatis, ut fringilla nibh egestas. Duis sit amet metus quis neque scelerisque sodales vitae nec leo. Aliquam porta metus in metus ornare blandit. In congue sit amet nisi non tempor. Vestibulum malesuada justo ut mauris mattis faucibus at nec lacus. Aenean facilisis eros sed odio maximus, et rutrum felis placerat.</p>',NULL,NULL,NULL,1,'2019-10-07 11:53:55','2019-10-07 12:49:11');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `static` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_image` tinyint(1) NOT NULL DEFAULT '1',
  `content` text COLLATE utf8mb4_unicode_ci,
  `on_menu` tinyint(1) NOT NULL DEFAULT '1',
  `on_footer` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','Главная','home',NULL,NULL,NULL,1,NULL,1,0,1,1,NULL,NULL,NULL,'2019-10-04 16:49:11','2019-10-07 14:38:56'),(2,'store','Интернет магазин','catalogs',NULL,NULL,NULL,1,NULL,1,0,1,2,NULL,NULL,NULL,'2019-10-04 16:49:11','2019-10-07 14:39:09'),(3,'marks','Марки','marks',NULL,NULL,NULL,1,NULL,1,0,1,3,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(4,'brands','Бренды','brands',NULL,NULL,NULL,1,NULL,1,0,1,4,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(5,'terms','Условия','terms',NULL,NULL,NULL,1,NULL,1,1,1,5,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 18:11:41'),(6,'contacts','Контакты','contacts',NULL,NULL,NULL,1,NULL,1,0,1,8,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(7,'news','Новости','news',NULL,NULL,NULL,1,NULL,1,0,1,7,NULL,NULL,NULL,NULL,'2019-10-07 12:15:38'),(8,'about','О компании',NULL,'kwEXA6FGegF0R9uSbi.jpg','Alt','Title',1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus nulla sit amet ultrices tincidunt. Integer bibendum dui ac ipsum scelerisque aliquet tempus at ipsum. Etiam imperdiet sit amet urna nec molestie. Nulla et urna odio. Sed sodales mauris justo, sed gravida elit scelerisque ut. Quisque imperdiet turpis pellentesque, egestas est nec, suscipit sem. Integer sagittis tortor in sem tempus bibendum. Donec nec volutpat erat. Integer diam libero, rhoncus molestie imperdiet eu, blandit in sem. Aliquam vehicula diam vitae nisl hendrerit, vel pellentesque felis varius. Fusce et felis neque. Nunc vitae interdum augue.</p>\r\n\r\n<p>Integer in iaculis nisl. Aliquam non nisi hendrerit, maximus turpis pharetra, finibus diam. Nunc sit amet turpis vulputate, bibendum diam eu, lacinia ipsum. Cras id enim id velit laoreet bibendum sit amet in justo. Donec eu facilisis lectus, et pellentesque augue. Ut porta, odio eu eleifend suscipit, diam massa hendrerit neque, at molestie sapien sapien non urna. Etiam placerat molestie nibh quis imperdiet. Etiam laoreet mauris ex, ut vestibulum sem molestie eget. Praesent placerat, ex id tristique vehicula, odio ex scelerisque nibh, ut fringilla nisi leo id metus. Vivamus gravida hendrerit nisl ut porttitor. Aenean sagittis lorem eget massa tempor, quis ultricies eros accumsan.</p>\r\n\r\n<p>Proin consequat egestas faucibus. Curabitur neque nulla, gravida at leo et, eleifend sollicitudin dolor. Cras lacinia eleifend ipsum et commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lorem diam, ullamcorper a sem eu, fermentum lobortis quam. Nam blandit non diam at semper. Maecenas consequat, orci ac sodales ornare, justo ipsum iaculis quam, eleifend convallis nulla arcu eget ex. Aenean quis augue urna. Suspendisse elementum lacinia est, eget varius orci dapibus ut. Donec condimentum libero sed purus dignissim, vel aliquet sem molestie.</p>',1,0,1,6,NULL,NULL,NULL,'2019-10-07 10:56:05','2019-10-07 11:00:19'),(9,'public-offer','Публичная оферта',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:13:24','2019-10-07 18:16:27'),(10,'confidentiality','Конфиденциальность',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:16:03','2019-10-07 18:16:33'),(11,'payment-and-delivery','Оплата и доставка',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:16:52','2019-10-07 18:17:14'),(12,'for-corporative-clients','Корпоративным клиентам',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:18:00','2019-10-07 18:19:02'),(13,'loyalty-program','Программа лояльности',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:18:52','2019-10-07 18:18:52'),(14,'jobs','Вакансии',NULL,'TZdOFLrPZ5yQvm8hyb.jpg',NULL,NULL,0,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:19:32','2019-10-07 18:26:25');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `part_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) unsigned NOT NULL,
  `mark_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `generation_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `part_cars_part_id_foreign` (`part_id`),
  KEY `part_cars_mark_id_foreign` (`mark_id`),
  KEY `part_cars_model_id_foreign` (`model_id`),
  KEY `part_cars_generation_id_foreign` (`generation_id`),
  CONSTRAINT `part_cars_generation_id_foreign` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `part_cars_mark_id_foreign` FOREIGN KEY (`mark_id`) REFERENCES `marks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `part_cars_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE,
  CONSTRAINT `part_cars_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_cars` WRITE;
/*!40000 ALTER TABLE `part_cars` DISABLE KEYS */;
/*!40000 ALTER TABLE `part_cars` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `part_catalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_catalogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_home` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part_catalogs_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_catalogs` WRITE;
/*!40000 ALTER TABLE `part_catalogs` DISABLE KEYS */;
INSERT INTO `part_catalogs` VALUES (4,'Шины',3,'shiny','9VBa7s6yHD7sUwpLrR.png',NULL,'1',NULL,'2019-10-07 18:41:16','2019-10-08 18:01:30'),(5,'Диски',2,'diski','eTEqO7stV9xI0qthHE.png',NULL,'1',NULL,'2019-10-07 18:41:50','2019-10-08 18:01:04'),(6,'Щетки стеклоочистеля',2,'shchetki-stekloochistelya','0EohB4wCR5TSsih1Eh.png',NULL,'1',NULL,'2019-10-07 18:42:01','2019-10-08 18:01:37'),(7,'Масла',3,'masla','j61YUR3R5ear6bsSZ4.png',NULL,'1',NULL,'2019-10-07 18:42:13','2019-10-08 18:01:21'),(8,'Аксессуары',1,'aksessuary','jpGKULOG3YogIUpg2w.png',NULL,'1',NULL,'2019-10-07 18:52:07','2019-10-08 18:00:56'),(9,'Электро - оборудование',3,'elektro-oborudovanie','GaxRfJt2hZvEn04JXT.png',NULL,'1',NULL,'2019-10-07 18:52:22','2019-10-08 18:01:45'),(10,'Автохимия',1,'avtokhimiya','FH7cX9ngr78FrmymwO.png',NULL,'1',NULL,'2019-10-07 18:52:44','2019-10-08 18:00:48'),(11,'Инструменты',2,'instrumenty','GlMShV93KyOLSNwtlE.png',NULL,'1',NULL,'2019-10-07 18:53:01','2019-10-08 18:01:12');
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
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (4,'1','Test',2000,'zv2fO311QF7mF3j0C7.png','2000','2',NULL,'test',10,1,1,'2019-10-07 18:54:45','2019-10-07 18:54:45'),(5,'ap0453','Test',6500,'BbIcD2DxcT7F4MMkxe.png','111','111',NULL,'test-2',8,1,1,'2019-10-07 18:55:13','2019-10-07 18:55:13'),(6,'5100','Test',8500,'0oZYpAOG3dArg8pvZ7.png','1500250','1500250',NULL,'test-3',5,1,1,'2019-10-07 18:55:42','2019-10-07 18:57:09'),(7,'ap04531','Test',6500,'OU1ehxchs1PFo8AjrB.png','15002502','1113',NULL,'test-4',11,4,1,'2019-10-07 18:56:09','2019-10-07 18:57:19'),(8,'ap04534','Test',1000,'AyS0YgwVMZPHHl1Z3Q.png','11122','111es',NULL,'test-5',7,1,1,'2019-10-07 18:56:36','2019-10-07 18:57:26'),(9,'Code2','Test',9500,'qdYU185I9Qymtl3CIZ.png','150025034','11122',NULL,'test-6',4,1,1,'2019-10-07 18:57:52','2019-10-07 18:57:52'),(10,'94122','Test',1300,'HB2KSUKdLtFlJkwSFZ.png','1231541','32115124',NULL,'test-7',6,1,1,'2019-10-07 18:58:16','2019-10-07 18:58:16'),(11,'testasa','Test',7800,'JrAoE1pLhJycJKY9BO.png','2000dasd','1500250ass',NULL,'test-8',9,1,1,'2019-10-07 18:58:48','2019-10-07 18:58:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,1,'Астана',1,0,'2019-10-04 16:58:55','2019-10-04 16:58:55'),(2,1,'Алматы',1,0,'2019-10-04 16:59:00','2019-10-04 16:59:00'),(3,2,'Москва',1,0,'2019-10-04 17:01:25','2019-10-04 17:01:25'),(4,3,'Ереван',1,0,'2019-10-04 17:01:33','2019-10-04 17:01:33');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,'It is a long established','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>',2,1,'2019-10-06 14:02:40','2019-10-06 14:04:17'),(2,'Lorem Ipsum is','<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',1,1,'2019-10-06 14:03:49','2019-10-06 14:07:45'),(3,'There are many variations','<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',2,1,'2019-10-06 14:05:19','2019-10-06 14:05:19');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `manager_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(10) unsigned DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '-1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,3,'Айк','Закарян',4,'Казахстан','Астана','Ереван','+37455325665',NULL,NULL,'zakhayko@gmail.com','$2y$10$2zOXfCV1WgBBN8CwYmwIQ.1GWWuqkYhhJluhZAvPNJ1qpAfTOkWEu',NULL,1,'LLgIR2SHnxQSmjMxwWQ0kDlwNiWjOKtwgvea6ahE17Cd890QXyPM0U14ULvC','2019-10-18 19:26:21','2019-10-15 15:59:56','2019-10-18 19:26:21'),(2,2,NULL,'Test','Test',1,'Казахстан','Астана','Tera','+444444444','Test','Test','hayko2000@mail.ru','$2y$10$yFSwRaqyA4B3Oi9er1SXaOxWnUSww5iEA7C8RF8BeX5DNILGo2.ca',NULL,-1,NULL,NULL,'2019-10-15 17:40:38','2019-10-15 17:40:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `years` WRITE;
/*!40000 ALTER TABLE `years` DISABLE KEYS */;
INSERT INTO `years` VALUES (1,2019,'2019-10-09 19:46:26','2019-10-09 19:46:26'),(2,2012,'2019-10-09 19:46:32','2019-10-09 19:46:32'),(3,2015,'2019-10-09 19:46:36','2019-10-09 19:46:36');
/*!40000 ALTER TABLE `years` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
