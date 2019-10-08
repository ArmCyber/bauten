
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Developer','dev@dev.loc',1,4,'$2y$10$TRhlT00iAMKmgFNjmn7omebe4J9vEcZPYJHloVEUTifozPFhQkTxm',NULL,'2019-10-04 16:49:11','2019-10-04 16:49:11'),(2,'Administrator','admin@dev.loc',1,3,'$2y$10$uNf.p3QYG8joLxREyiLTteYPdJXc5ueXhg.w4saBewY1xJrhi1SgS',NULL,'2019-10-04 16:49:11','2019-10-04 16:49:11'),(3,'Manager','manager@dev.loc',1,2,'$2y$10$vznTQeQ5g8M8W6D2gvaFUu/YTPgVrslPL2Tp3p/vVJrMxLWo0VWBC',NULL,'2019-10-04 16:49:11','2019-10-04 16:49:11'),(4,'Operator','operator@dev.loc',1,1,'$2y$10$eD2pYhjIYMLaW7TLD0J1y.otxOlfTbBMjEMXyyxYHeHK2/n0encma',NULL,'2019-10-04 16:49:11','2019-10-04 16:49:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'info','data','{\"logo\":\"Pm0K0wbmC4dq8RUtFD.png\",\"logo_footer\":\"Jn5ScwuggUbIRk5naD.png\",\"email\":\"info@bauten.kz\",\"seo_suffix\":\"Bauten\"}'),(2,'info','requisites','{\"address\":\"Алматы Казахстан, с. Мадениет уч. 383\",\"phone\":\"8 (777) 619 1747\",\"email\":\"info@bauten.kz\"}'),(3,'info','requisites','{\"address\":null,\"phone\":\"8 (707) 173 7656\",\"email\":null}'),(4,'info','requisites','{\"address\":null,\"phone\":\"8 (775) 996 1880\",\"email\":null}'),(5,'info','requisites','{\"address\":null,\"phone\":null,\"email\":null}'),(6,'info','socials','{\"icon\":\"r7TaX4Uwv46Rv8PhsZ.svg\",\"title\":\"Bautenautoparts\",\"url\":\"\\/\\/facebook.com\",\"active\":true}'),(7,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(8,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(9,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(10,'info','payment_logos','{\"logo\":\"VBwbBXfryteVdrgiAq.png\",\"title\":\"Visa\",\"alt\":\"Visa\",\"active\":true}'),(11,'info','payment_logos','{\"logo\":\"BVrxvSJCU8GMBef54i.png\",\"title\":\"Mastercard\",\"alt\":\"Mastercard\",\"active\":true}'),(12,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(13,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(14,'home','block_titles','{\"catalogue\":\"Каталог автозапчастей\",\"parts\":\"Запчасти по маркам\",\"brands\":\"Каталог брендов\",\"news\":\"Новости\"}'),(15,'home','banners','{\"image\":\"CJeBy3AZ2QcNXTSJ4M.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(16,'home','banners','{\"image\":\"bEoplwqXfw3F78LViZ.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(17,'contacts','data','{\"requisites_title\":\"Контактные данные\",\"form_title\":\"Связаться с нами\",\"iframe\":\"https:\\/\\/yandex.ru\\/map-widget\\/v1\\/-\\/CGs8zXLJ\"}'),(18,'about','data','{\"banner\":\"2jIEDChPa3U629Yi2V.jpg\",\"banner_alt\":\"Alt\",\"banner_title\":\"Title\",\"banner_show\":true,\"content\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus nulla sit amet ultrices tincidunt. Integer bibendum dui ac ipsum scelerisque aliquet tempus at ipsum. Etiam imperdiet sit amet urna nec molestie. Nulla et urna odio. Sed sodales mauris justo, sed gravida elit scelerisque ut. Quisque imperdiet turpis pellentesque, egestas est nec, suscipit sem. Integer sagittis tortor in sem tempus bibendum. Donec nec volutpat erat. Integer diam libero, rhoncus molestie imperdiet eu, blandit in sem. Aliquam vehicula diam vitae nisl hendrerit, vel pellentesque felis varius. Fusce et felis neque. Nunc vitae interdum augue.<\\/p>\\r\\n\\r\\n<p>Integer in iaculis nisl. Aliquam non nisi hendrerit, maximus turpis pharetra, finibus diam. Nunc sit amet turpis vulputate, bibendum diam eu, lacinia ipsum. Cras id enim id velit laoreet bibendum sit amet in justo. Donec eu facilisis lectus, et pellentesque augue. Ut porta, odio eu eleifend suscipit, diam massa hendrerit neque, at molestie sapien sapien non urna. Etiam placerat molestie nibh quis imperdiet. Etiam laoreet mauris ex, ut vestibulum sem molestie eget. Praesent placerat, ex id tristique vehicula, odio ex scelerisque nibh, ut fringilla nisi leo id metus. Vivamus gravida hendrerit nisl ut porttitor. Aenean sagittis lorem eget massa tempor, quis ultricies eros accumsan.<\\/p>\\r\\n\\r\\n<p>Proin consequat egestas faucibus. Curabitur neque nulla, gravida at leo et, eleifend sollicitudin dolor. Cras lacinia eleifend ipsum et commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lorem diam, ullamcorper a sem eu, fermentum lobortis quam. Nam blandit non diam at semper. Maecenas consequat, orci ac sodales ornare, justo ipsum iaculis quam, eleifend convallis nulla arcu eget ex. Aenean quis augue urna. Suspendisse elementum lacinia est, eget varius orci dapibus ut. Donec condimentum libero sed purus dignissim, vel aliquet sem molestie.<\\/p>\"}');
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
INSERT INTO `brands` VALUES (1,'1','A-One','VblwLcqn5sxlxmVI8W.png',NULL,NULL,'a-one',1,0,1,'2019-10-04 17:07:27','2019-10-07 14:59:25'),(2,'2','Agp','qa3EyHS2FMzDg06llo.png','2','3','agp',1,0,1,'2019-10-07 14:59:42','2019-10-07 14:59:42'),(3,'3','Bauten','r1od7JHxVQMsEzlupL.png',NULL,NULL,'bauten',1,0,1,'2019-10-07 15:12:52','2019-10-07 15:12:52'),(4,'4','Baw','eBe3R3uICS0eVLAcIf.png',NULL,NULL,'baw',1,0,1,'2019-10-07 15:14:32','2019-10-07 15:14:32'),(5,'5','Camellia','cR0lJW3KoV8kI6LJTA.png',NULL,NULL,'camellia',1,0,1,'2019-10-07 15:14:44','2019-10-07 15:14:44'),(6,'6','Casp','WWEtCaBnPPkoWfX8wJ.png',NULL,NULL,'casp',1,0,1,'2019-10-07 15:14:55','2019-10-07 15:14:55'),(7,'7','Cft','t8cHK1jUiNbuFs9p1n.png',NULL,NULL,'cft',1,0,1,'2019-10-07 15:15:07','2019-10-07 15:15:07'),(8,'8','Depo','yRtTjuk2klx7iwF4oO.png',NULL,NULL,'depo',1,0,1,'2019-10-07 15:15:19','2019-10-07 15:15:19'),(9,'9','Visa','L7obyzDUkyl0JEXlxl.png',NULL,NULL,'visa',1,0,1,'2019-10-07 15:15:39','2019-10-07 15:15:39'),(11,'10','Deye','6OT8Pnkarj28bTUWEz.png',NULL,NULL,'deye',1,0,1,'2019-10-07 15:17:14','2019-10-07 15:17:49'),(12,'11','Did','xHSHWZHIhy3MJXZ6D3.png',NULL,NULL,'did',1,0,1,'2019-10-07 15:17:25','2019-10-07 15:17:25');
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
INSERT INTO `criteria` VALUES (1,1,'Criterion 1',0,'2019-10-08 16:42:13','2019-10-08 16:42:13'),(2,1,'Criterion 2',0,'2019-10-08 16:42:17','2019-10-08 16:42:17'),(3,1,'Criterion 3',0,'2019-10-08 16:42:22','2019-10-08 16:42:22'),(4,4,'Criterion 1',0,'2019-10-08 16:42:34','2019-10-08 16:42:34'),(5,4,'Criterion 2',0,'2019-10-08 16:42:38','2019-10-08 16:42:38'),(6,5,'Crit',0,'2019-10-08 17:25:05','2019-10-08 17:25:05');
/*!40000 ALTER TABLE `criteria` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `filters` WRITE;
/*!40000 ALTER TABLE `filters` DISABLE KEYS */;
INSERT INTO `filters` VALUES (1,'Filter 1',NULL,1,1,'2019-10-08 15:26:34','2019-10-08 16:30:08'),(4,'Filter 2',NULL,1,1,'2019-10-08 16:42:28','2019-10-08 16:42:28'),(5,'Filter 5',1,1,1,'2019-10-08 17:12:56','2019-10-08 17:20:34'),(6,'Filter 3',NULL,1,1,'2019-10-08 17:16:36','2019-10-08 17:16:36'),(7,'Filter 6',1,2,1,'2019-10-08 17:20:27','2019-10-08 17:20:34');
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
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `generations_model_id_foreign` (`model_id`),
  CONSTRAINT `generations_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `generations` WRITE;
/*!40000 ALTER TABLE `generations` DISABLE KEYS */;
INSERT INTO `generations` VALUES (1,1,'1',0,1,'2019-10-04 17:06:00','2019-10-04 17:06:00'),(2,1,'2',0,1,'2019-10-04 17:06:04','2019-10-04 17:06:04');
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
INSERT INTO `groups` VALUES (1,'Группа 1','gruppa-1',0,'2019-10-08 13:11:48','2019-10-08 13:11:48'),(2,'Группа 2','gruppa-2',0,'2019-10-08 13:11:53','2019-10-08 13:11:53'),(3,'Группа 3','gruppa-3',0,'2019-10-08 13:12:29','2019-10-08 13:12:29');
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_home` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (1,'Audi','UDs9MqR9xPThoXyJgc.png','Audi','Audi','audi',1,0,1,'2019-10-04 16:54:59','2019-10-07 13:06:10'),(2,'BMW','KWsJW7vbswgUECZnkU.png','BMW','BMW','bmw',1,0,1,'2019-10-04 16:55:15','2019-10-07 13:06:19'),(3,'Chrysler','RPSTHh9uLO97p0lGyI.png','Chrysler','Chrysler','chrysler',1,0,1,'2019-10-04 16:55:41','2019-10-04 16:55:41'),(4,'Citroen','gxPkJWpfpVU8eCFPBv.png','Citroen','Citroen','citroen',1,0,1,'2019-10-04 16:55:53','2019-10-04 16:55:53'),(5,'Daewoo','UnuYkii5mEtrL3BJVD.png','Daewoo','Daewoo','daewoo',1,0,1,'2019-10-04 16:56:05','2019-10-04 16:56:05'),(6,'Ford','2RUXJC3Qt7XvaFFJla.png','Ford','Ford','ford',1,0,1,'2019-10-04 16:56:15','2019-10-04 16:56:15'),(7,'Honda','6xyhupCIiUldwuBmxi.png','Honda','Honda','honda',1,0,1,'2019-10-04 16:56:27','2019-10-04 16:56:27'),(8,'Hyundai','vnwSMyPBCP4euuUNQl.png','Hyundai','Hyundai','hyundai',1,0,1,'2019-10-04 16:56:48','2019-10-04 16:56:48'),(9,'Isuzu','r0fiw7gCTZfY37BPyx.png','Isuzu','Isuzu','isuzu',1,0,1,'2019-10-04 16:57:21','2019-10-04 16:57:21'),(10,'Kia','Yxjrqo0bzPLn1RnDtM.png','Kia','Kia','kia',1,0,1,'2019-10-04 16:57:38','2019-10-04 16:57:38'),(11,'Lexus','SKWeGkRlY10mT75jUj.png','Lexus','Lexus','lexus',1,0,1,'2019-10-04 16:57:51','2019-10-04 16:57:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_07_10_171502_create_admins_table',1),(2,'2019_07_12_204343_create_password_resets_table',1),(3,'2019_07_12_232636_create_pages_table',1),(4,'2019_07_23_000000_create_zakhayko_banners_table',1),(5,'2019_08_14_161704_create_marks_table',1),(6,'2019_08_14_161725_create_models_table',1),(7,'2019_08_14_161756_create_generations_table',1),(8,'2019_08_14_221246_create_countries_table',1),(9,'2019_08_14_221310_create_regions_table',1),(10,'2019_08_19_142314_create_parts_table',1),(11,'2019_08_19_165244_create_brands_table',1),(12,'2019_09_02_210329_create_part_catalogs_table',1),(13,'2019_09_06_194022_create_part_cars_table',1),(14,'2019_09_30_183624_create_home_slider_table',1),(15,'2019_10_02_183143_create_galleries_table',1),(18,'2019_10_06_173451_create_terms_table',2),(19,'2019_10_07_143850_add_content_to_pages_table',3),(22,'2019_10_07_150146_create_news_table',4),(24,'2019_10_07_165216_add_url_in_marks_table',5),(25,'2019_10_07_175907_add_url_to_brands_table',6),(26,'2019_10_07_220407_add_on_footer_to_pages_table',7),(28,'2019_10_07_222737_add_image_to_part_catalogs_table',8),(30,'2019_10_08_161153_create_groups_table',9),(31,'2019_10_08_165558_add_group_id_to_part_catalogs_table',10),(32,'2019_10_08_191627_create_filters_table',11),(35,'2019_10_08_193606_create_criteria_table',12);
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
  PRIMARY KEY (`id`),
  KEY `models_mark_id_foreign` (`mark_id`),
  CONSTRAINT `models_mark_id_foreign` FOREIGN KEY (`mark_id`) REFERENCES `marks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,1,'100',0,1,'2019-10-04 17:04:45','2019-10-04 17:04:45'),(3,1,'200',0,1,'2019-10-04 17:05:54','2019-10-04 17:05:54');
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
INSERT INTO `part_catalogs` VALUES (4,'Шины',NULL,'shiny','9VBa7s6yHD7sUwpLrR.png',NULL,'1',NULL,'2019-10-07 18:41:16','2019-10-07 18:50:43'),(5,'Диски',NULL,'diski','eTEqO7stV9xI0qthHE.png',NULL,'1',NULL,'2019-10-07 18:41:50','2019-10-07 18:50:09'),(6,'Щетки стеклоочистеля',NULL,'shchetki-stekloochistelya','0EohB4wCR5TSsih1Eh.png',NULL,'1',NULL,'2019-10-07 18:42:01','2019-10-07 18:52:27'),(7,'Масла',NULL,'masla','j61YUR3R5ear6bsSZ4.png',NULL,'1',NULL,'2019-10-07 18:42:13','2019-10-07 18:49:59'),(8,'Аксессуары',NULL,'aksessuary','jpGKULOG3YogIUpg2w.png',NULL,'1',NULL,'2019-10-07 18:52:07','2019-10-08 13:45:15'),(9,'Электро - оборудование',NULL,'elektro-oborudovanie','GaxRfJt2hZvEn04JXT.png',NULL,'1',NULL,'2019-10-07 18:52:22','2019-10-07 18:52:32'),(10,'Автохимия',NULL,'avtokhimiya','FH7cX9ngr78FrmymwO.png',NULL,'1',NULL,'2019-10-07 18:52:44','2019-10-07 18:52:44'),(11,'Инструменты',NULL,'instrumenty','GlMShV93KyOLSNwtlE.png',NULL,'1',NULL,'2019-10-07 18:53:01','2019-10-07 18:53:01');
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

