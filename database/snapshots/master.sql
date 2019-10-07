
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
INSERT INTO `banners` VALUES (1,'info','data','{\"logo\":\"Pm0K0wbmC4dq8RUtFD.png\",\"logo_footer\":\"Jn5ScwuggUbIRk5naD.png\",\"email\":\"info@bauten.kz\",\"seo_suffix\":\"Bauten\"}'),(2,'info','requisites','{\"address\":\"Алматы Казахстан, с. Мадениет уч. 383\",\"phone\":\"8 (777) 619 1747\",\"email\":\"info@bauten.kz\"}'),(3,'info','requisites','{\"address\":null,\"phone\":\"8 (707) 173 7656\",\"email\":null}'),(4,'info','requisites','{\"address\":null,\"phone\":\"8 (775) 996 1880\",\"email\":null}'),(5,'info','requisites','{\"address\":null,\"phone\":null,\"email\":null}'),(6,'info','socials','{\"icon\":\"r7TaX4Uwv46Rv8PhsZ.svg\",\"title\":\"Bautenautoparts\",\"url\":\"\\/\\/facebook.com\",\"active\":true}'),(7,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(8,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(9,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(10,'info','payment_logos','{\"logo\":\"VBwbBXfryteVdrgiAq.png\",\"title\":\"Visa\",\"alt\":\"Visa\",\"active\":true}'),(11,'info','payment_logos','{\"logo\":\"BVrxvSJCU8GMBef54i.png\",\"title\":\"Mastercard\",\"alt\":\"Mastercard\",\"active\":true}'),(12,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(13,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(14,'home','block_titles','{\"catalogue\":\"Каталог автозапчастей\",\"parts\":\"Запчасти по моделям\",\"brands\":\"Каталог брендов\",\"news\":\"Новости\"}'),(15,'home','banners','{\"image\":\"CJeBy3AZ2QcNXTSJ4M.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(16,'home','banners','{\"image\":\"bEoplwqXfw3F78LViZ.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(17,'contacts','data','{\"requisites_title\":\"Контактные данные\",\"form_title\":\"Связаться с нами\",\"iframe\":\"https:\\/\\/yandex.ru\\/map-widget\\/v1\\/-\\/CGs8zXLJ\"}'),(18,'about','data','{\"banner\":\"2jIEDChPa3U629Yi2V.jpg\",\"banner_alt\":\"Alt\",\"banner_title\":\"Title\",\"banner_show\":true,\"content\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus nulla sit amet ultrices tincidunt. Integer bibendum dui ac ipsum scelerisque aliquet tempus at ipsum. Etiam imperdiet sit amet urna nec molestie. Nulla et urna odio. Sed sodales mauris justo, sed gravida elit scelerisque ut. Quisque imperdiet turpis pellentesque, egestas est nec, suscipit sem. Integer sagittis tortor in sem tempus bibendum. Donec nec volutpat erat. Integer diam libero, rhoncus molestie imperdiet eu, blandit in sem. Aliquam vehicula diam vitae nisl hendrerit, vel pellentesque felis varius. Fusce et felis neque. Nunc vitae interdum augue.<\\/p>\\r\\n\\r\\n<p>Integer in iaculis nisl. Aliquam non nisi hendrerit, maximus turpis pharetra, finibus diam. Nunc sit amet turpis vulputate, bibendum diam eu, lacinia ipsum. Cras id enim id velit laoreet bibendum sit amet in justo. Donec eu facilisis lectus, et pellentesque augue. Ut porta, odio eu eleifend suscipit, diam massa hendrerit neque, at molestie sapien sapien non urna. Etiam placerat molestie nibh quis imperdiet. Etiam laoreet mauris ex, ut vestibulum sem molestie eget. Praesent placerat, ex id tristique vehicula, odio ex scelerisque nibh, ut fringilla nisi leo id metus. Vivamus gravida hendrerit nisl ut porttitor. Aenean sagittis lorem eget massa tempor, quis ultricies eros accumsan.<\\/p>\\r\\n\\r\\n<p>Proin consequat egestas faucibus. Curabitur neque nulla, gravida at leo et, eleifend sollicitudin dolor. Cras lacinia eleifend ipsum et commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lorem diam, ullamcorper a sem eu, fermentum lobortis quam. Nam blandit non diam at semper. Maecenas consequat, orci ac sodales ornare, justo ipsum iaculis quam, eleifend convallis nulla arcu eget ex. Aenean quis augue urna. Suspendisse elementum lacinia est, eget varius orci dapibus ut. Donec condimentum libero sed purus dignissim, vel aliquet sem molestie.<\\/p>\"}');
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
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'55020502','Brand1','fEbivzk2YQcu7wyoJU.jpeg',0,1,'2019-10-04 17:07:27','2019-10-04 17:07:27');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (4,'parts',1,'3k1c9riX06qDwsiOV8.jpg',NULL,NULL,0),(5,'parts',1,'hWOzkIXXtdHMSVBnuy.jpg',NULL,NULL,0);
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
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (1,'Audi','UDs9MqR9xPThoXyJgc.png','Audi','Audi',0,1,'2019-10-04 16:54:59','2019-10-04 16:54:59'),(2,'BMW','KWsJW7vbswgUECZnkU.png','BMW','BMW',0,1,'2019-10-04 16:55:15','2019-10-04 16:55:15'),(3,'Chrysler','RPSTHh9uLO97p0lGyI.png','Chrysler','Chrysler',0,1,'2019-10-04 16:55:41','2019-10-04 16:55:41'),(4,'Citroen','gxPkJWpfpVU8eCFPBv.png','Citroen','Citroen',0,1,'2019-10-04 16:55:53','2019-10-04 16:55:53'),(5,'Daewoo','UnuYkii5mEtrL3BJVD.png','Daewoo','Daewoo',0,1,'2019-10-04 16:56:05','2019-10-04 16:56:05'),(6,'Ford','2RUXJC3Qt7XvaFFJla.png','Ford','Ford',0,1,'2019-10-04 16:56:15','2019-10-04 16:56:15'),(7,'Honda','6xyhupCIiUldwuBmxi.png','Honda','Honda',0,1,'2019-10-04 16:56:27','2019-10-04 16:56:27'),(8,'Hyundai','vnwSMyPBCP4euuUNQl.png','Hyundai','Hyundai',0,1,'2019-10-04 16:56:48','2019-10-04 16:56:48'),(9,'Isuzu','r0fiw7gCTZfY37BPyx.png','Isuzu','Isuzu',0,1,'2019-10-04 16:57:21','2019-10-04 16:57:21'),(10,'Kia','Yxjrqo0bzPLn1RnDtM.png','Kia','Kia',0,1,'2019-10-04 16:57:38','2019-10-04 16:57:38'),(11,'Lexus','SKWeGkRlY10mT75jUj.png','Lexus','Lexus',0,1,'2019-10-04 16:57:51','2019-10-04 16:57:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_07_10_171502_create_admins_table',1),(2,'2019_07_12_204343_create_password_resets_table',1),(3,'2019_07_12_232636_create_pages_table',1),(4,'2019_07_23_000000_create_zakhayko_banners_table',1),(5,'2019_08_14_161704_create_marks_table',1),(6,'2019_08_14_161725_create_models_table',1),(7,'2019_08_14_161756_create_generations_table',1),(8,'2019_08_14_221246_create_countries_table',1),(9,'2019_08_14_221310_create_regions_table',1),(10,'2019_08_19_142314_create_parts_table',1),(11,'2019_08_19_165244_create_brands_table',1),(12,'2019_09_02_210329_create_part_catalogs_table',1),(13,'2019_09_06_194022_create_part_cars_table',1),(14,'2019_09_30_183624_create_home_slider_table',1),(15,'2019_10_02_183143_create_galleries_table',1),(16,'2019_10_02_204629_create_filters_table',1),(17,'2019_10_02_214520_create_filter_values_table',1),(18,'2019_10_06_173451_create_terms_table',2),(19,'2019_10_07_143850_add_content_to_pages_table',3),(22,'2019_10_07_150146_create_news_table',4);
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
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','Главная','home',NULL,NULL,NULL,1,NULL,1,1,1,NULL,NULL,NULL,'2019-10-04 16:49:11','2019-10-07 11:00:19'),(2,'store','Интернет магазин','catalogs',NULL,NULL,NULL,1,NULL,1,1,2,NULL,NULL,NULL,'2019-10-04 16:49:11','2019-10-07 12:17:47'),(3,'marks','Марки','marks',NULL,NULL,NULL,1,NULL,1,1,3,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(4,'brands','Бренды','brands',NULL,NULL,NULL,1,NULL,1,1,4,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(5,'terms','Условия','terms',NULL,NULL,NULL,1,NULL,1,1,5,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(6,'contacts','Контакты','contacts',NULL,NULL,NULL,1,NULL,1,1,8,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(7,'news','Новости','news',NULL,NULL,NULL,1,NULL,1,1,7,NULL,NULL,NULL,NULL,'2019-10-07 12:15:38'),(8,'about','О компании',NULL,'kwEXA6FGegF0R9uSbi.jpg','Alt','Title',1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tempus nulla sit amet ultrices tincidunt. Integer bibendum dui ac ipsum scelerisque aliquet tempus at ipsum. Etiam imperdiet sit amet urna nec molestie. Nulla et urna odio. Sed sodales mauris justo, sed gravida elit scelerisque ut. Quisque imperdiet turpis pellentesque, egestas est nec, suscipit sem. Integer sagittis tortor in sem tempus bibendum. Donec nec volutpat erat. Integer diam libero, rhoncus molestie imperdiet eu, blandit in sem. Aliquam vehicula diam vitae nisl hendrerit, vel pellentesque felis varius. Fusce et felis neque. Nunc vitae interdum augue.</p>\r\n\r\n<p>Integer in iaculis nisl. Aliquam non nisi hendrerit, maximus turpis pharetra, finibus diam. Nunc sit amet turpis vulputate, bibendum diam eu, lacinia ipsum. Cras id enim id velit laoreet bibendum sit amet in justo. Donec eu facilisis lectus, et pellentesque augue. Ut porta, odio eu eleifend suscipit, diam massa hendrerit neque, at molestie sapien sapien non urna. Etiam placerat molestie nibh quis imperdiet. Etiam laoreet mauris ex, ut vestibulum sem molestie eget. Praesent placerat, ex id tristique vehicula, odio ex scelerisque nibh, ut fringilla nisi leo id metus. Vivamus gravida hendrerit nisl ut porttitor. Aenean sagittis lorem eget massa tempor, quis ultricies eros accumsan.</p>\r\n\r\n<p>Proin consequat egestas faucibus. Curabitur neque nulla, gravida at leo et, eleifend sollicitudin dolor. Cras lacinia eleifend ipsum et commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lorem diam, ullamcorper a sem eu, fermentum lobortis quam. Nam blandit non diam at semper. Maecenas consequat, orci ac sodales ornare, justo ipsum iaculis quam, eleifend convallis nulla arcu eget ex. Aenean quis augue urna. Suspendisse elementum lacinia est, eget varius orci dapibus ut. Donec condimentum libero sed purus dignissim, vel aliquet sem molestie.</p>',1,1,6,NULL,NULL,NULL,'2019-10-07 10:56:05','2019-10-07 11:00:19');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_cars` WRITE;
/*!40000 ALTER TABLE `part_cars` DISABLE KEYS */;
INSERT INTO `part_cars` VALUES (1,3,3,NULL,NULL),(2,3,1,1,2),(3,3,1,3,NULL),(4,3,5,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_catalogs` WRITE;
/*!40000 ALTER TABLE `part_catalogs` DISABLE KEYS */;
INSERT INTO `part_catalogs` VALUES (1,'Cat1','cat1','2019-10-04 17:08:07','2019-10-04 17:08:07'),(2,'Cat2','cat2','2019-10-04 17:08:12','2019-10-04 17:08:12'),(3,'ASdsadasd','asdsadasd','2019-10-05 11:28:59','2019-10-05 11:28:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'123456','Ремкомплект бескамерных шин \"AUTOPROFI\"',10000,'S5OI1FAysvLIXsMI00.jpeg','1500250','1500250','<p>Соответствие современным допускам автопроизводителей США, Евросоюза и Японии, что особенно ценно для смешанных автопарков и авторемонтных центров ∙ Соответствие требованиям стандарта удиненной замены ALLISON TES-295, позволяющее гарантировать пробег 100 000 км. ∙ Улучшенные показатели антивибрационной устойчивости ∙ Плавное и четкое переключение передач в течение всего срока службы жидкости ∙ Надежную защиту деталей</p>','remkomplekt-beskamernykh-shin-autoprofi',1,1,1,'2019-09-09 11:14:13','2019-10-04 17:14:08'),(3,'test','Test',111,'I7Z5at7GUSUCYWfYmr.jpeg','111','111',NULL,'test',1,1,1,'2019-10-04 17:59:39','2019-10-04 18:40:36');
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

