
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,NULL,'Developer','dev@dev.loc','055555555',1,6,'$2y$10$TRhlT00iAMKmgFNjmn7omebe4J9vEcZPYJHloVEUTifozPFhQkTxm',NULL,'2019-10-04 16:49:11','2019-10-11 12:57:53'),(2,NULL,'Administrator','admin@dev.loc','8799999999',1,5,'$2y$10$uNf.p3QYG8joLxREyiLTteYPdJXc5ueXhg.w4saBewY1xJrhi1SgS',NULL,'2019-10-04 16:49:11','2019-10-27 14:51:24'),(3,'4286921','Manager','manager@dev.loc','899999999',1,3,'$2y$10$vznTQeQ5g8M8W6D2gvaFUu/YTPgVrslPL2Tp3p/vVJrMxLWo0VWBC',NULL,'2019-10-04 16:49:11','2019-10-16 13:52:17'),(4,NULL,'Operator','operator@dev.loc','8799999997',1,1,'$2y$10$eD2pYhjIYMLaW7TLD0J1y.otxOlfTbBMjEMXyyxYHeHK2/n0encma',NULL,'2019-10-04 16:49:11','2019-10-11 13:19:20'),(5,NULL,'Старший менеджер','senior_manager@dev.loc','111111111',1,4,'$2y$10$OuwZHTeWAlq8V7LUnfXH4uhsy2K/zgFGIXdmDWIzqHagPbRbyzaH6',NULL,'2019-10-27 14:52:03','2019-10-27 15:00:00'),(6,NULL,'Контент менеджер','content@dev.loc','55555555',1,2,'$2y$10$vCsA.FU5c4AcW9aQT7LRZOf4dfwXBosTKrZOwSnpyPsEw3ssqdZjW',NULL,'2019-11-24 09:01:43','2019-11-24 09:01:56');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(10) unsigned NOT NULL,
  `price` double(8,2) unsigned NOT NULL,
  `real_price` int(10) unsigned DEFAULT NULL,
  `sum` double(8,2) unsigned NOT NULL,
  `real_sum` double(8,2) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,1,'Айк','+374553256655','Ереван','Ереван',8,'Test','2',50,1000.00,1200,25000.00,50000.00,'2019-11-17 13:37:49','2019-11-17 13:37:49'),(2,2,'Test','+444444444','Астана','Tera',5,'Крестовино TO ACV40 07-11 KREACV40','152',1,1.00,NULL,1.00,1.00,'2019-11-24 15:33:39','2019-11-24 15:33:39');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `attached_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attached_parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) unsigned NOT NULL,
  `attached_part_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attached_parts_part_id_foreign` (`part_id`),
  KEY `attached_parts_attached_part_id_foreign` (`attached_part_id`),
  CONSTRAINT `attached_parts_attached_part_id_foreign` FOREIGN KEY (`attached_part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attached_parts_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `attached_parts` WRITE;
/*!40000 ALTER TABLE `attached_parts` DISABLE KEYS */;
/*!40000 ALTER TABLE `attached_parts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'info','data','{\"logo\":\"Pm0K0wbmC4dq8RUtFD.png\",\"logo_footer\":\"Jn5ScwuggUbIRk5naD.png\",\"email\":\"info@bauten.kz\",\"seo_suffix\":\"Bauten\"}'),(2,'info','requisites','{\"address\":\"Алматы Казахстан, с. Мадениет уч. 383\",\"phone\":\"8 (777) 619 1747\",\"email\":\"info@bauten.kz\"}'),(3,'info','requisites','{\"address\":null,\"phone\":\"8 (707) 173 7656\",\"email\":null}'),(4,'info','requisites','{\"address\":null,\"phone\":\"8 (775) 996 1880\",\"email\":null}'),(5,'info','requisites','{\"address\":null,\"phone\":null,\"email\":null}'),(6,'info','socials','{\"icon\":\"r7TaX4Uwv46Rv8PhsZ.svg\",\"title\":\"Bautenautoparts\",\"url\":\"\\/\\/facebook.com\",\"active\":true}'),(7,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(8,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(9,'info','socials','{\"icon\":null,\"title\":null,\"url\":null,\"active\":false}'),(10,'info','payment_logos','{\"logo\":\"VBwbBXfryteVdrgiAq.png\",\"title\":\"Visa\",\"alt\":\"Visa\",\"active\":true}'),(11,'info','payment_logos','{\"logo\":\"BVrxvSJCU8GMBef54i.png\",\"title\":\"Mastercard\",\"alt\":\"Mastercard\",\"active\":true}'),(12,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(13,'info','payment_logos','{\"logo\":null,\"title\":null,\"alt\":null,\"active\":false}'),(14,'home','block_titles','{\"catalogue\":\"Каталог автозапчастей\",\"parts\":\"Запчасти по маркам\",\"brands\":\"Каталог брендов\",\"news\":\"Новости\",\"recommended_parts\":\"Товары для вас\"}'),(15,'home','banners','{\"image\":\"CJeBy3AZ2QcNXTSJ4M.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(16,'home','banners','{\"image\":\"bEoplwqXfw3F78LViZ.png\",\"url\":null,\"alt\":null,\"title\":null,\"active\":true}'),(17,'contacts','data','{\"requisites_title\":\"Контактные данные\",\"form_title\":\"Связаться с нами\",\"iframe\":\"https:\\/\\/yandex.ru\\/map-widget\\/v1\\/-\\/CGs8zXLJ\"}'),(19,'images','data','{\"marks\":\"Rep1Qldt1IorvMSBMy.png\",\"parts\":\"m6Qw2qftapi3fVq8lD.png\"}'),(20,'auth','register','{\"first_title\":\"Регистрация в интернет-магазине\",\"first_text\":\"<p>Для регистрации в интернет-магазине, пожалуйста, заполните данную анкету.<\\/p>\\r\\n\\r\\n<p>Если у вас возникли проблемы с регистрацией, пожалуйста напишите нам на адрес<\\/p>\\r\\n\\r\\n<p><a href=\\\"mailto:zakaz@bauten.kz\\\">zakaz@bauten.kz<\\/a><\\/p>\"}'),(21,'auth','register_right','{\"title\":\"Условия сотрудничества\",\"text\":\"<p>Мы не несём ответственность за применимость заказываемой&nbsp;<br \\/>\\r\\nдетали к автомобилю Вашего клиента<\\/p>\\r\\n\\r\\n<p>Доставка осуществляется силами нашей компании. Способы&nbsp;<br \\/>\\r\\nдоставки и минимальные параметры отправки согласовываются с&nbsp;<br \\/>\\r\\nкаждым клиентом индивидуально.<\\/p>\"}'),(22,'auth','register_right','{\"title\":\"Работа с нами — это\",\"text\":\"<p>Различные формы оплаты: наличный расчет, безналичный расчет,&nbsp;<br \\/>\\r\\nбанковский перевод.<\\/p>\\r\\n\\r\\n<p>Оперативная доставка продукции по всей территории Казахстана&nbsp;<br \\/>\\r\\nи стран СНГ<\\/p>\\r\\n\\r\\n<p>Право на получение специальных цен на товары<\\/p>\"}'),(23,'settings','minimum','{\"shop\":null,\"delivery\":\"20000\"}'),(24,'texts','data','{\"pickup\":\"<p><strong>Lorem Ipsum<\\/strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<\\/p>\",\"delivery\":\"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;,<\\/p>\",\"bank_text\":\"<p>Test1: <strong>12345678<\\/strong><\\/p>\\r\\n\\r\\n<p>Test2: <strong>OK<\\/strong><\\/p>\"}');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basket` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `basket_part_id_foreign` (`part_id`),
  KEY `basket_user_id_foreign` (`user_id`),
  CONSTRAINT `basket_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `basket_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `basket` WRITE;
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_home` tinyint(1) NOT NULL DEFAULT '0',
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'1','A-ONE Taiwan',NULL,'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>','VblwLcqn5sxlxmVI8W.png',NULL,NULL,'a-one',NULL,NULL,NULL,1,1,1,'2019-10-04 17:07:27','2019-11-26 04:31:26'),(2,'2','AGP Malaysia',NULL,NULL,'qa3EyHS2FMzDg06llo.png','2','3','agp',NULL,NULL,NULL,1,2,1,'2019-10-07 14:59:42','2019-11-26 04:31:26'),(3,'3','BAUTEN рулевая рейка реставрация',NULL,NULL,'r1od7JHxVQMsEzlupL.png',NULL,NULL,'bauten',NULL,NULL,NULL,1,3,1,'2019-10-07 15:12:52','2019-11-26 04:31:26'),(4,'4','BAW Taiwan','<p>short</p>','<p>description</p>','eBe3R3uICS0eVLAcIf.png',NULL,NULL,'baw',NULL,NULL,NULL,1,4,1,'2019-10-07 15:14:32','2019-11-26 04:31:26'),(5,'5','CAMELLIA Japan',NULL,NULL,'cR0lJW3KoV8kI6LJTA.png',NULL,NULL,'camellia',NULL,NULL,NULL,1,5,1,'2019-10-07 15:14:44','2019-11-26 04:31:26'),(6,'6','CASP Taiwan',NULL,NULL,'WWEtCaBnPPkoWfX8wJ.png',NULL,NULL,'casp',NULL,NULL,NULL,1,6,1,'2019-10-07 15:14:55','2019-11-26 04:31:26'),(7,'7','CFT PROTECH China',NULL,NULL,'t8cHK1jUiNbuFs9p1n.png',NULL,NULL,'cft',NULL,NULL,NULL,1,7,1,'2019-10-07 15:15:07','2019-11-26 06:37:28'),(8,'8','DEPO Taiwan',NULL,NULL,'yRtTjuk2klx7iwF4oO.png',NULL,NULL,'depo',NULL,NULL,NULL,1,8,1,'2019-10-07 15:15:19','2019-11-26 06:38:12'),(9,'9','VISA China',NULL,NULL,'L7obyzDUkyl0JEXlxl.png',NULL,NULL,'visa',NULL,NULL,NULL,1,9,1,'2019-10-07 15:15:39','2019-11-28 09:50:20'),(11,'10','DEYE China',NULL,NULL,'6OT8Pnkarj28bTUWEz.png',NULL,NULL,'deye',NULL,NULL,NULL,1,10,1,'2019-10-07 15:17:14','2019-11-26 07:42:54'),(12,'11','DID Japan','<p>Компания Daido Kogyo (DID) основана в далеком 1933 году в&nbsp;Японий. С момента своего основания стремление Daido Kogyo к технологиям, создало высокопроизводительные и высококачественные продукты, отвечающие глобальному спросу на транспортировку. Подобного рода производство является результатом развития энтузиазма и человеческих ресурсов.</p>','<p>Приводная цепь&nbsp;DID&nbsp;является первой, кто успешно путешествует по Американскому континенту. Всемирно известный бренд DID является доказательством надежности и превосходной производительности при любых тяжелых условиях. Наши цепи мотоциклов и цепи автомобильных двигателей используются в более чем&nbsp;60 странах мира.</p>','RWVYi8WtmTrHceTyae.png',NULL,NULL,'did',NULL,NULL,NULL,1,11,1,'2019-10-07 15:17:25','2019-11-26 07:36:40'),(13,NULL,'ASHIMORI Malaysia',NULL,NULL,'vDjZ8nslYNDZVBxrlY.png',NULL,NULL,'ashimori-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-26 06:39:33','2019-11-26 06:39:33'),(14,NULL,'SEIWA Japan',NULL,NULL,'8cowpaHKX60T1LAGTm.png',NULL,NULL,'seiwa-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:40:08','2019-11-26 06:40:08'),(15,NULL,'TOKICO Japan',NULL,NULL,'HWej0AJO1hjG9dAN5u.png',NULL,NULL,'tokico-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:40:27','2019-11-26 06:40:27'),(16,NULL,'YSK Taiwan',NULL,NULL,'J6u4ynncMU6Hdu74XI.png',NULL,NULL,'visa-china',NULL,NULL,NULL,0,11,1,'2019-11-26 06:40:50','2019-11-26 06:41:12'),(17,NULL,'TP Japan',NULL,NULL,'vrv5IfJ0zUrxOLlGgZ.png',NULL,NULL,'tp-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:41:39','2019-11-26 06:41:39'),(18,NULL,'QJ Taiwan',NULL,NULL,'ju6TLN5H2Ho7a0Bgjd.png',NULL,NULL,'qj-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:42:00','2019-11-26 06:42:00'),(19,NULL,'NOK Japan',NULL,NULL,'iuOQhiHaKIMBB609jX.png',NULL,NULL,'nok-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:42:36','2019-11-26 06:42:36'),(20,NULL,'NPW Japan',NULL,NULL,'ryFS7147tik1JlIA5B.png',NULL,NULL,'npw-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:42:56','2019-11-26 06:42:56'),(21,NULL,'SONAR Taiwan',NULL,NULL,'LZriPObwd1qlV8FQMT.png',NULL,NULL,'sonar-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:43:22','2019-11-26 06:43:22'),(22,NULL,'AISIN Japan',NULL,NULL,'NTgBNig5Q4JLbA254p.png',NULL,NULL,'aisin-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:43:43','2019-11-26 06:43:43'),(23,NULL,'AISAN Japan',NULL,NULL,'B7Ofc6VXXT13aFr4LD.png',NULL,NULL,'aisan-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:43:57','2019-11-26 06:43:57'),(24,NULL,'ADVICS Japan',NULL,NULL,'FCIDDQHQwlm9ueNsNh.png',NULL,NULL,'advics-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 06:44:17','2019-11-26 06:44:17'),(25,NULL,'KINGA China',NULL,NULL,'K4SNSg0z4PrroLjcpT.png',NULL,NULL,'kinga-china',NULL,NULL,NULL,0,11,1,'2019-11-26 07:30:35','2019-11-26 07:30:35'),(26,NULL,'LFI Taiwan',NULL,NULL,'3KCBe9R30CzPJQTZzq.png',NULL,NULL,'lfi-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:31:33','2019-11-26 07:31:33'),(27,NULL,'DOKURO Japan',NULL,NULL,'trcLMDcOYLKEERiB8k.png',NULL,NULL,'dokuro-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:42:24','2019-11-26 07:42:24'),(28,NULL,'EAGLE EYES Taiwan',NULL,NULL,'zuQPkFJPJCmE1rmGGV.png',NULL,NULL,'eagle-eyes-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:43:23','2019-11-26 07:43:23'),(29,NULL,'EIKO Japan',NULL,NULL,'UPx5UEZZoojrurBHoI.png',NULL,NULL,'eiko-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:43:47','2019-11-26 07:43:47'),(30,NULL,'HARDEX Malaysia',NULL,NULL,'tUgkr808VhGbWA1QPN.png',NULL,NULL,'hardex-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-26 07:44:27','2019-11-26 07:44:27'),(31,NULL,'HASAKI Taiwan',NULL,NULL,'s0IGwlGKKll9ctfUlH.png',NULL,NULL,'hasaki-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:44:43','2019-11-26 07:44:43'),(32,NULL,'MGM China',NULL,NULL,'af9yUOvSmjx9ga222b.png',NULL,NULL,'mgm-china',NULL,NULL,NULL,0,11,1,'2019-11-26 07:45:09','2019-11-26 07:45:09'),(33,NULL,'MOBILETRON Taiwan',NULL,NULL,'VznifYb8j3yS1IlhHN.png',NULL,NULL,'mobiletron-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:45:28','2019-11-26 07:45:28'),(34,NULL,'OKAMI',NULL,NULL,'eZwLerZVys9OqHwoPr.png',NULL,NULL,'okami',NULL,NULL,NULL,0,11,1,'2019-11-26 07:45:58','2019-11-26 07:45:58'),(35,NULL,'OSK Japan',NULL,NULL,'KsnYbdON2HIpgmMz7Q.png',NULL,NULL,'osk-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:46:17','2019-11-26 07:46:17'),(36,NULL,'UNION SANGYO Japan',NULL,NULL,'VsAgFAXcSQWohSCgqa.png',NULL,NULL,'union-sangyo-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:46:47','2019-11-26 07:46:47'),(37,NULL,'SHANGLING China',NULL,NULL,'Of257VP7BXR92wpyTK.png',NULL,NULL,'shangling-china',NULL,NULL,NULL,0,11,1,'2019-11-26 07:47:12','2019-11-26 07:47:12'),(38,NULL,'LONGHO Taiwan',NULL,NULL,'R6L8NymofP8voDya85.png',NULL,NULL,'longho-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:47:34','2019-11-26 07:47:34'),(39,NULL,'TENACITY Taiwan',NULL,NULL,'4Wzml7ZjwnufOwc3vk.png',NULL,NULL,'tenacity-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:47:52','2019-11-26 07:47:52'),(40,NULL,'KYOSAN Japan',NULL,NULL,'HSiz3mOQPQhQovmrsJ.png',NULL,NULL,'kyosan-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:48:11','2019-11-26 07:48:11'),(41,NULL,'BBS China',NULL,NULL,'RXstKOGORC2kkZBzZZ.png',NULL,NULL,'bbs-china',NULL,NULL,NULL,0,11,1,'2019-11-26 07:51:20','2019-11-26 07:51:20'),(42,NULL,'ERISTIC Taiwan',NULL,NULL,'e7ItbhtPI1nz8BFDrE.png',NULL,NULL,'eristic-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 07:51:37','2019-11-26 07:51:37'),(43,NULL,'G-AUTOPARTS China',NULL,NULL,'K6mtqFYsWPLMvSvSrd.png',NULL,NULL,'g-autoparts-china',NULL,NULL,NULL,0,11,1,'2019-11-26 08:50:49','2019-11-26 08:50:49'),(44,NULL,'GCK Taiwan',NULL,NULL,'X7TsSmpFLcm98hWY6X.png',NULL,NULL,'gck-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 08:51:19','2019-11-26 08:51:19'),(45,NULL,'GMB Japan',NULL,NULL,'k6UjMYVg8uLUpwi1KS.png',NULL,NULL,'gmb-japan',NULL,NULL,NULL,0,11,1,'2019-11-26 08:51:34','2019-11-26 08:51:34'),(46,NULL,'VITAL Malaysia',NULL,NULL,'Qmjb4AJuXMTJtU8Agm.png',NULL,NULL,'vital-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-26 08:51:49','2019-11-26 08:51:49'),(47,NULL,'TOYO Taiwan',NULL,NULL,'yInHMOhc8CKPfwCgS6.png',NULL,NULL,'toyo-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-26 08:52:08','2019-11-26 08:52:08'),(48,NULL,'COB WEB Taiwan',NULL,NULL,'xR1jVzEms7i6SOpqBL.png',NULL,NULL,'cob-web-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:38:23','2019-11-28 09:38:23'),(49,NULL,'DENSO',NULL,NULL,'eFESvEB4MWMFfGyyy7.png',NULL,NULL,'denso',NULL,NULL,NULL,0,11,1,'2019-11-28 09:38:49','2019-11-28 09:38:49'),(50,NULL,'DIAMOND China',NULL,NULL,'F12kMDpOQcEFh02zY8.png',NULL,NULL,'diamond-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:39:16','2019-11-28 09:39:16'),(51,NULL,'Diesel Parts',NULL,NULL,'kZYcQN5UD7XRUVUC98.png',NULL,NULL,'diesel-parts',NULL,NULL,NULL,0,11,1,'2019-11-28 09:39:31','2019-11-28 09:39:31'),(52,NULL,'GOODRUBBER Malaysia',NULL,NULL,'c0ORzSgBSiytVMes3y.png',NULL,NULL,'goodrubber-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-28 09:40:04','2019-11-28 09:40:04'),(53,NULL,'GORDON Taiwan',NULL,NULL,'uBX47sq98A2CF7YQ0X.png',NULL,NULL,'gordon-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:40:22','2019-11-28 09:40:22'),(54,NULL,'HCAP China',NULL,NULL,'1pbW8iDKkFdLdHjWu0.png',NULL,NULL,'hcap-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:40:47','2019-11-28 09:40:47'),(55,NULL,'HDK Japan',NULL,NULL,'fNATnmEAoSRzZ18lb4.png',NULL,NULL,'hdk-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:40:56','2019-11-28 09:40:56'),(56,NULL,'HKT Japan',NULL,NULL,'ZQkoAmFBrwmNwgOFuj.png',NULL,NULL,'hkt-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:41:13','2019-11-28 09:41:13'),(57,NULL,'JUNYAN Taiwan',NULL,NULL,'TdnBpGiUFY0wxTCCv3.png',NULL,NULL,'junyan-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:41:28','2019-11-28 09:41:28'),(58,NULL,'KASHIYAMA Japan',NULL,NULL,'p8PNBrGrAGpUUh53aB.png',NULL,NULL,'kashiyama-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:41:46','2019-11-28 09:41:46'),(59,NULL,'KBF Korea',NULL,NULL,'VZpNtj1uJIWVJ0dyQR.png',NULL,NULL,'kbf-korea',NULL,NULL,NULL,0,11,1,'2019-11-28 09:42:08','2019-11-28 09:42:08'),(60,NULL,'KOYO Japan',NULL,NULL,'aDBcNiPlbXxnaDoy7q.png',NULL,NULL,'koyo-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:42:20','2019-11-28 09:42:20'),(61,NULL,'KOYOROKI Malaysia',NULL,NULL,'Oqz1C6PwQpIqKE8pKU.png',NULL,NULL,'koyoroki-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-28 09:42:33','2019-11-28 09:42:33'),(62,NULL,'MAX BELT Indonesia',NULL,NULL,'unHrtscp4iLqv5J8TY.png',NULL,NULL,'max-belt-indonesia',NULL,NULL,NULL,0,11,1,'2019-11-28 09:43:00','2019-11-28 09:43:00'),(63,NULL,'MITHSUBOSHI Japan',NULL,NULL,'luqER7R1Te3BWH0kG7.png',NULL,NULL,'mithsuboshi-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:43:18','2019-11-28 09:43:18'),(64,NULL,'MRK Japan',NULL,NULL,'HYFZ27ypuX9qE8r3uK.png',NULL,NULL,'mrk-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:43:31','2019-11-28 09:43:31'),(65,NULL,'MUSASHI Japan',NULL,NULL,'9cfSBsXPhGBjx58MTQ.png',NULL,NULL,'musashi-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:43:43','2019-11-28 09:43:43'),(66,NULL,'MUSASHI Taiwan',NULL,NULL,'hOV85JQJDx6SesM7uO.png',NULL,NULL,'musashi-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:43:56','2019-11-28 09:43:56'),(67,NULL,'NDC Japan',NULL,NULL,'1JpRRmRABdKmmnQmz2.png',NULL,NULL,'ndc-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:44:24','2019-11-28 09:44:24'),(68,NULL,'NEW ERA Japan',NULL,NULL,'rddSsl9Mu9HREsLRGq.png',NULL,NULL,'new-era-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:44:37','2019-11-28 09:44:37'),(69,NULL,'NOK Corteco',NULL,NULL,'8F1A7YuNpKFRUie9RG.png',NULL,NULL,'nok-corteco',NULL,NULL,NULL,0,11,1,'2019-11-28 09:44:48','2019-11-28 09:44:48'),(70,NULL,'NPR Japan',NULL,NULL,'8VJ4q7wTiuJjGo7UuF.png',NULL,NULL,'npr-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:45:03','2019-11-28 09:45:03'),(71,NULL,'NSK Japan',NULL,NULL,'S9SLQG8wW6SLlt15Jh.png',NULL,NULL,'nsk-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:45:21','2019-11-28 09:45:21'),(72,NULL,'NTN Japan',NULL,NULL,'tP3dJrcqM0UOLmyyYS.png',NULL,NULL,'ntn-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:45:38','2019-11-28 09:45:38'),(73,NULL,'NUK Taiwan',NULL,NULL,'QxMUHSY6VNGJjup7sa.png',NULL,NULL,'nuk-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:45:50','2019-11-28 09:45:50'),(74,NULL,'PHIKA China',NULL,NULL,'CcT3VOO7OwDHdOJeMO.png',NULL,NULL,'okami-2',NULL,NULL,NULL,0,11,1,'2019-11-28 09:46:04','2019-11-28 09:46:46'),(75,NULL,'OSK Japan',NULL,NULL,'AcHsyXQ2tijYWO3nIQ.png',NULL,NULL,'osk-japan-2',NULL,NULL,NULL,0,11,1,'2019-11-28 09:46:15','2019-11-28 09:46:15'),(76,NULL,'PRO FORTUNE Taiwan',NULL,NULL,'RlNHm91Fl0kucIil8q.png',NULL,NULL,'pro-fortune-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:47:06','2019-11-28 09:47:06'),(77,NULL,'PRO MULTI Malaysia',NULL,NULL,'8gNeiAbGVqdi8u8bGY.png',NULL,NULL,'pro-multi-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-28 09:47:22','2019-11-28 09:47:22'),(78,NULL,'PROFIX Japan',NULL,NULL,'PqVkIERAZeJiRTJKyj.png',NULL,NULL,'profix-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:47:41','2019-11-28 09:47:41'),(79,NULL,'ROCKY Japan',NULL,NULL,'bf5VQnOVNSnyffgaD5.png',NULL,NULL,'rocky-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:47:59','2019-11-28 09:47:59'),(80,NULL,'RBI Thailand',NULL,NULL,'WLXYgWTh2MyaEhQZwI.png',NULL,NULL,'rbi-thailand',NULL,NULL,NULL,0,11,1,'2019-11-28 09:48:14','2019-11-28 09:48:14'),(81,NULL,'SL TURBO China',NULL,NULL,'Ti2OIrUamFE7hbNFdQ.png',NULL,NULL,'sl-turbo-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:48:57','2019-11-28 09:48:57'),(82,NULL,'VIDARIR China',NULL,NULL,'QLawTZ8t2rRi6AewtA.png',NULL,NULL,'vidarir-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:49:24','2019-11-28 09:49:24'),(83,NULL,'YAS China',NULL,NULL,'c8VTtW5AUih7PQFxgS.png',NULL,NULL,'yas-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:49:41','2019-11-28 09:49:41'),(84,NULL,'VAPRO Malaysia',NULL,NULL,'4v3fgcoQrEHJ7PqBlj.png',NULL,NULL,'vapro-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-28 09:49:59','2019-11-28 09:49:59'),(85,NULL,'V&V China',NULL,NULL,'2xp9bJlM5m81GWQ9fF.png',NULL,NULL,'vv-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:50:39','2019-11-28 09:50:39'),(86,NULL,'QXP China',NULL,NULL,'q9FKEiBFcctO2WEspu.png',NULL,NULL,'qxp-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:50:56','2019-11-28 09:50:56'),(87,NULL,'QINYUAN China',NULL,NULL,'mDaZRneSHq496kz4Ss.png',NULL,NULL,'qinyuan-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:51:13','2019-11-28 09:51:13'),(88,NULL,'SAP стартер и генератор и ГУР',NULL,NULL,'cBpunA9zTIGLz8ozTK.png',NULL,NULL,'sap-starter-i-generator-i-gur',NULL,NULL,NULL,0,11,1,'2019-11-28 09:51:55','2019-11-28 09:51:55'),(89,NULL,'SEHUN Korea',NULL,NULL,'lLuhmYOmNx84OrYgio.png',NULL,NULL,'sehun-korea',NULL,NULL,NULL,0,11,1,'2019-11-28 09:52:16','2019-11-28 09:52:16'),(90,NULL,'SEIKEN Japan',NULL,NULL,'FKb7Qi3ybzdv3nHQaP.png',NULL,NULL,'seiken-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:52:40','2019-11-28 09:52:40'),(91,NULL,'SH Taiwan',NULL,NULL,'Ge76IHnyuaYxAUxCPJ.png',NULL,NULL,'sh-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:53:34','2019-11-28 09:53:34'),(92,NULL,'SDING YUH Taiwan',NULL,NULL,'ANwOZiRnMjAbIGBRbo.png',NULL,NULL,'sding-yuh-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:53:53','2019-11-28 09:53:53'),(93,NULL,'SANTIAN China',NULL,NULL,'UwJyDsDNsm88xwCdmu.png',NULL,NULL,'santian-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:54:14','2019-11-28 09:54:14'),(94,NULL,'TEIKIN Indonesia',NULL,NULL,'fgR8dylUUQySGE86Vb.png',NULL,NULL,'teikin-indonesia',NULL,NULL,NULL,0,11,1,'2019-11-28 09:54:37','2019-11-28 09:54:37'),(95,NULL,'TONG HONG Taiwan',NULL,NULL,'Vicrfcyfe08TXDexRO.png',NULL,NULL,'tong-hong-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:54:58','2019-11-28 09:54:58'),(96,NULL,'TRW U.S.A',NULL,NULL,'DvhSWjnYMx35OvkRNp.png',NULL,NULL,'trw-usa',NULL,NULL,NULL,0,11,1,'2019-11-28 09:55:14','2019-11-28 09:55:14'),(97,NULL,'TOCEMA China',NULL,NULL,'dJ2iohzXZdpyBk3Yco.png',NULL,NULL,'tocema-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:55:31','2019-11-28 09:55:31'),(98,NULL,'TORCH China',NULL,NULL,'OmT2rQNXwX1QhjqWPd.png',NULL,NULL,'torch-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:55:55','2019-11-28 09:55:55'),(99,NULL,'TIK Taiwan',NULL,NULL,'JDkq9gTu9blhY9lAay.png',NULL,NULL,'tik-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:56:18','2019-11-28 09:56:18'),(100,NULL,'TAMA Japan',NULL,NULL,'BmNPhnJLdjjhwCtQdA.png',NULL,NULL,'tama-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:56:37','2019-11-28 09:56:37'),(101,NULL,'TAIHO Japan',NULL,NULL,'IZd4eXohcj3xtaA0qX.png',NULL,NULL,'taiho-japan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:56:56','2019-11-28 09:56:56'),(102,NULL,'SMK China',NULL,NULL,'kEfQ0nxJ8eS8av1WvI.png',NULL,NULL,'smk-china',NULL,NULL,NULL,0,11,1,'2019-11-28 09:58:16','2019-11-28 09:58:16'),(103,NULL,'VESPARK Taiwan',NULL,NULL,'mtzUSln4NTI5h24ojk.png',NULL,NULL,'vespark-taiwan',NULL,NULL,NULL,0,11,1,'2019-11-28 09:58:44','2019-11-28 09:58:44'),(104,NULL,'PROTECH Malaysia',NULL,NULL,'wvr7aedMu1aB4Genjm.png',NULL,NULL,'protech-malaysia',NULL,NULL,NULL,0,11,1,'2019-11-28 14:45:01','2019-11-28 14:45:01');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `change_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `change_emails` (
  `user_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `verification` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `change_emails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `change_emails` WRITE;
/*!40000 ALTER TABLE `change_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `change_emails` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `count_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `count_sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `sale` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `count_sales_part_id_foreign` (`part_id`),
  CONSTRAINT `count_sales_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `count_sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `count_sales` WRITE;
/*!40000 ALTER TABLE `count_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `count_sales` ENABLE KEYS */;
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
INSERT INTO `criteria` VALUES (1,1,'Руль',0,'2019-10-08 16:42:13','2019-11-25 08:30:43'),(2,1,'Салон',0,'2019-10-08 16:42:17','2019-11-25 08:30:58'),(3,1,'Criterion 3',0,'2019-10-08 16:42:22','2019-10-08 16:42:22'),(4,4,'Criterion 1',2,'2019-10-08 16:42:34','2019-10-09 14:45:52'),(5,4,'Criterion 2',1,'2019-10-08 16:42:38','2019-10-09 14:45:52'),(6,5,'Crit',0,'2019-10-08 17:25:05','2019-10-08 17:25:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `criterion_part` WRITE;
/*!40000 ALTER TABLE `criterion_part` DISABLE KEYS */;
/*!40000 ALTER TABLE `criterion_part` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `delivery_cities_region_id_foreign` (`region_id`),
  CONSTRAINT `delivery_cities_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `delivery_regions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_cities` WRITE;
/*!40000 ALTER TABLE `delivery_cities` DISABLE KEYS */;
INSERT INTO `delivery_cities` VALUES (3,'City 1',4,1000),(4,'City 2',4,2000),(5,'City 3',5,3000),(6,'City 4',5,5000),(7,'efrge',6,25252);
/*!40000 ALTER TABLE `delivery_cities` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `delivery_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `delivery_regions` WRITE;
/*!40000 ALTER TABLE `delivery_regions` DISABLE KEYS */;
INSERT INTO `delivery_regions` VALUES (4,'Region1'),(5,'Region 2'),(6,'vrgvbrgbg');
/*!40000 ALTER TABLE `delivery_regions` ENABLE KEYS */;
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
DROP TABLE IF EXISTS `engine_criterion_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_criterion_part` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `engine_criterion_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `engine_criterion_part_engine_criterion_id_foreign` (`engine_criterion_id`),
  KEY `engine_criterion_part_part_id_foreign` (`part_id`),
  CONSTRAINT `engine_criterion_part_engine_criterion_id_foreign` FOREIGN KEY (`engine_criterion_id`) REFERENCES `engine_criteria` (`id`) ON DELETE CASCADE,
  CONSTRAINT `engine_criterion_part_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engine_criterion_part` WRITE;
/*!40000 ALTER TABLE `engine_criterion_part` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_criterion_part` ENABLE KEYS */;
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
DROP TABLE IF EXISTS `engine_mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_mark` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `engine_id` bigint(20) unsigned NOT NULL,
  `mark_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `engine_mark_engine_id_foreign` (`engine_id`),
  KEY `engine_mark_mark_id_foreign` (`mark_id`),
  CONSTRAINT `engine_mark_engine_id_foreign` FOREIGN KEY (`engine_id`) REFERENCES `engines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `engine_mark_mark_id_foreign` FOREIGN KEY (`mark_id`) REFERENCES `marks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4747 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engine_mark` WRITE;
/*!40000 ALTER TABLE `engine_mark` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine_mark` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `engine_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engine_part` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `engine_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `engine_part_engine_id_foreign` (`engine_id`),
  KEY `engine_part_part_id_foreign` (`part_id`),
  CONSTRAINT `engine_part_engine_id_foreign` FOREIGN KEY (`engine_id`) REFERENCES `engines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `engine_part_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engine_part` WRITE;
/*!40000 ALTER TABLE `engine_part` DISABLE KEYS */;
INSERT INTO `engine_part` VALUES (9,6,1),(10,18,1),(11,64,1),(12,143,1),(13,264,1);
/*!40000 ALTER TABLE `engine_part` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `engines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` smallint(5) unsigned DEFAULT NULL,
  `year_to` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=620 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engines` WRITE;
/*!40000 ALTER TABLE `engines` DISABLE KEYS */;
INSERT INTO `engines` VALUES (2,1,'2AZ-FE 2.4 16v 02-06',2002,2006),(3,2,'2AZ-FE 2.4 16v 07-',2007,NULL),(4,3,'1MZ-FE VVTi 3.0 24v 02-07',2002,2007),(5,4,'2GR-FE 3.5 24v 06-',2006,NULL),(6,5,'1AZ-FE 2.0 16v 01-',2001,NULL),(7,6,'5S-FE 2.2 16v 97-01 катушка',1997,2001),(8,7,'3MZ-FE 3.3 24v 03-10',2003,2010),(9,8,'5S-FE 2.2 16v 90-96 трамблер',1990,1996),(10,9,'3S-FE 2.0 16v 91-96 трамблер',1991,1996),(11,10,'3S-FE 2.0 16v 97-01 катушка',1997,2001),(12,11,'1MZ-FE 3.0 24v 94-01',1994,2001),(13,12,'2AZ-FSE 2.4 16v 03- D4',2003,NULL),(14,13,'2AR-FE 2.5 16v 09-',2009,NULL),(15,14,'2MZ-FE 2.5 24v 98-01',1998,2001),(16,15,'4S-FE 1.8 16v 91-96 трамблер',1991,1996),(17,16,'2UZ-FE VVTi 4.7 32v 02-06',2002,2006),(18,17,'1AZ-FSE 2.0 16v 00- D4',2000,NULL),(19,18,'6G72 3.0 24v 96-02 SOHC вдоль',1996,2002),(20,19,'2UZ-FE 4.7 32v 98-02',1998,2002),(21,20,'2TR-FE 2.7 16v 09-',2009,NULL),(22,21,'2TR-FE 2.7 16v 03-08',2003,2008),(23,22,'4A-FE 1.6 16v 92-96 трамблер',1992,1996),(24,23,'4S-FE 1.8 16v 97-01 катушка',1997,2001),(25,24,'7A-FE 1.8 16v 93-96 трамблер',1993,1996),(26,25,'1ZZ-FE 1.8 16v 97-07',1997,2007),(27,26,'1GR-FE 4.0 24v 02-08',2002,2008),(28,27,'4A-FE 1.6 16v 97-01 катушка',1997,2001),(29,28,'1UZ-FE 4.0 32v 89-02',1989,2002),(30,29,'3MZ-FE 4.0 24v 03-10 HYBRID',2003,2010),(31,30,'7A-FE 1.8 16v 97-01 катушка',1997,2001),(32,31,'3ZZ-FE 1.6 16v 00-',2000,NULL),(33,32,'5A-FE 1.5 16v 91-95',1991,1995),(34,33,'3S-GE 2.0 16v 91-96',1991,1996),(35,34,'6G72 3.0 24v 06- SOHC вдоль',2006,NULL),(36,35,'2JZ-GE VVTi 3.0 24v 96-',1996,NULL),(37,36,'4G63 2.0 16v 92-96 SOHC',1992,1996),(38,37,'1GR-FE DUAL VVTi 4.0 24v 09-',2009,NULL),(39,38,'5VZ-FE 3.4 24v 95-04',1995,2004),(40,39,'4VZ-FE 2.5 24v 93-98',1993,1998),(41,40,'3RZ-FE 2.7 16v 03- катушка',2003,NULL),(42,41,'3VZ-FE 3.0 24v 91-96',1991,1996),(43,42,'1JZ-GE VVTi 2.5 24v 96-',1996,NULL),(44,43,'4ZZ-FE 1.4 16v 00-',2000,NULL),(45,44,'3RZ-FE 2.7 16v 95-02 трамблер',1995,2002),(46,45,'6G75 3.8 24v 03-',2003,NULL),(47,46,'6G74 3.5 24v 06- SOHC вдоль',2006,NULL),(48,47,'2TZ-FE 2.4 16v 90-00',1990,2000),(49,48,'VQ20DE 2.0 24v 94-98',1994,1998),(50,49,'2AR-FXE 2.5 16v 14- HYBRID',2014,NULL),(51,50,'VQ30DE 3.0 24v 94-98',1994,1998),(52,51,'3GR-FSE 3.0 24v 04-',2004,NULL),(53,52,'2GR-FSE 3.5 24v 06-',2006,NULL),(54,53,'3GR-FE 3.0 24v 04-',2004,NULL),(55,54,'4GR-FSE 2.5 24v 06-',2006,NULL),(56,55,'2JZ-GE 3.0 24v 93-95 трамблер',1993,1995),(57,56,'4G63 2.0 16v 97- SOHC',1997,NULL),(58,57,'3UR-FE 5.7 32v 07-',2007,NULL),(59,58,'FS-DE 2.0 16v 93-02',1993,2002),(60,59,'6G72 3.0 24v 96-02 SOHC трамблер',1996,2002),(61,60,'2UZ-FE II VVTi 4.7 32v 07-',2007,NULL),(62,61,'1JZ-GE 2.5 24v 90-96 трамблер',1990,1996),(63,62,'VQ25DE 2.5 24v 94-98',1994,1998),(64,63,'1AR-FE 2.7 16v 09-',2009,NULL),(65,64,'2ZR-FE 1.8 16v 07-',2007,NULL),(66,65,'3S-GE VVTi 2.0 16v 96-01',1996,2001),(67,66,'6G72 3.0 24v 91-96 DOHC',1991,1996),(68,67,'4G93 1.8 16v 92-96 SOHC',1992,1996),(69,68,'1ZR-FE 1.6 16v 07-',2007,NULL),(70,69,'VQ30DE II 3.0 24v 99-03',1999,2003),(71,70,'1JZ-GTE 2.5 24v 90-96 трамблер',1990,1996),(72,71,'3ZR-FE 2.0 16v 08-',2008,NULL),(73,72,'1KZ-TE 3.0 8v 95-03',1995,2003),(74,73,'6G72 3.0 24v 97-04 DOHC',1997,2004),(75,74,'4M40-T 2.8 8v 96-04',1996,2004),(76,75,'3ZR-FAE 2.0 16v 08-',2008,NULL),(77,76,'4G64 2.4 16v 97- SOHC',1997,NULL),(78,77,'3S-FSE 2.0 16v 97-01 D4',1997,2001),(79,78,'6G73 2.5 24v 97-04 DOHC',1997,2004),(80,79,'2ZR-FAE 1.8 16v 08-',2008,NULL),(81,80,'6G73 2.5 24v 91-96 DOHC',1991,1996),(82,81,'VQ20DE NEO 2.0 24v 99-03',1999,2003),(83,82,'1NZ-FE 1.5 16v 97-',1997,NULL),(84,83,'FP-DE 1.8 16v 93-02',1993,2002),(85,84,'2JZ-GTE 3.0 24v 93-95 трамблер',1993,1995),(86,85,'6G74 3.5 24v 91-95 DOHC вдоль',1991,1995),(87,86,'4D56-T 2.5 8v 86-92',1986,1992),(88,87,'4D56-TDi 2.5 8v 96-04',1996,2004),(89,88,'1UR-FSE 4.6 32v 07-',2007,NULL),(90,89,'1KZ-T 3.0 8v 89-95',1989,1995),(91,90,'4A-GE 1.6 20v 92-95',1992,1995),(92,91,'3VZ-E 3.0 12v 87-92',1987,1992),(93,92,'4D56-T 2.5 8v 92-95',1992,1995),(94,93,'6G72 3.0 12v 86-95 SOHC',1986,1995),(95,94,'6G72 3.0 12v 86-99 SOHC вдоль',1986,1999),(96,95,'4G69 2.4 16v 03- MIVEC',2003,NULL),(97,96,'6A13 2.5 98-03 SOHC',2003,NULL),(98,97,'F22B 2.2 16v 94-98',1994,1998),(99,98,'1JZ-FSE VVTi 2.5 24v 01- D4',2001,NULL),(100,99,'4G63 2.0 8v 86-91 вдоль',1986,1991),(101,100,'6G73 2.5 24v 97-04 SOHC трамблер',1997,2004),(102,101,'4G64 2.4 16v 94-98 SOHC',1994,1998),(103,102,'2JZ-FSE VVTi 3.0 24v 01- D4',2001,NULL),(104,103,'VQ25DE NEO 2.5 99-01',1999,2001),(105,104,'3UZ-FE VVTi 4.3 32v 00-14',2000,2014),(106,105,'4G64 2.4 16v 98-03 GDI',1998,2003),(107,106,'4G93 1.8 16v 97- SOHC',1997,NULL),(108,107,'2UR-GSE 5.0 32v 07-',2007,NULL),(109,108,'B20B 2.0 16v 97-01',1997,2001),(110,109,'2E 1.3 12v 85-98',1985,1998),(111,110,'4G63 2.0 16v 92-96 DONC',1992,1996),(112,111,'4G92 1.6 16v 92-96 SOHC',1992,1996),(113,112,'6G74 3.5 24v 03- GDI',2003,NULL),(114,113,'VQ35DE 3.5 24v 01-07',2001,2007),(115,114,'SR20DE 2.0 16v 90-02',1990,2002),(116,115,'4G63 2.0 8v 88-92',1988,1992),(117,116,'6A12 2.0 92-96',1992,1996),(118,117,'4G63-T 2.0 16v 92-96 DOHC',1992,1996),(119,118,'2ZR-FXE 1.8 16v 09- HYBRID',2009,NULL),(120,119,'VQ35DE 3.5 24v 97-02 вдоль',1997,2002),(121,120,'4G63 2.0 16v 97- DOHC',1997,NULL),(122,121,'2GR-FKS 3.5 24v 18-',2018,NULL),(123,122,'4G63-T 2.0 16v 97- DOHC',1997,NULL),(124,123,'3C-TE 2.2 8v 92-96',1992,1996),(125,124,'F23A 2.3 16v 98-02 VTEC',1998,2002),(126,125,'4G63 2.0 16v 88-92 DOHC',1988,1992),(127,126,'4G37 1.8 8v 88-91',1988,1991),(128,127,'6G72 3.0 24v 97-04 GDI',1997,2004),(129,128,'5E-FE 1.5 16v 91-96 трамблер',1991,1996),(130,129,'6G73 2.5 24v 97-04 GDI',1994,2004),(131,130,'2C-T 2.0 8v 92-96',1992,1996),(132,131,'1NR-FE 1.3 16v 08-',2008,NULL),(133,132,'2NZ-FE 1.3 16v 99-',1999,NULL),(134,133,'VQ23DE 2.3 24v 03-08',2003,2008),(135,134,'VQ35DE 3.5 24v 03-07 FX вдоль',2003,2007),(136,135,'1KD-FTV 2.0 16v 00-',2000,NULL),(137,136,'QR25DE 2.5 16v 01-',2001,NULL),(138,137,'1NZ-FXE 1.5 16v 97- HYBRID',1997,NULL),(139,138,'QR20DE 2.0 16v 00-12',2000,2012),(140,139,'6AR-FSE 2.0 16v 14-',2014,NULL),(141,140,'2L-TII 2.4 8v 89-95',1989,1995),(142,141,'2L-TE 2.4 8v 95-02',1995,2002),(143,142,'1FZ-FE 4.5 24v 93-07',1993,2007),(144,143,'VQ35DE II 3.5 24v 08-',2008,NULL),(145,144,'F20A 2.0 16v 92-97',1992,1997),(146,145,'2KD-FTV 2.5 16v 01-',2001,NULL),(147,146,'FE 2.0 8v 88-91 SOHC',1988,1991),(148,147,'4D68-T 2.0 8v 92-96',1992,1996),(149,148,'EJ25D 2.5 16v 96-99 DOHC Phase I',1996,1999),(150,149,'VQ35DE II 3.5 24v 03- вдоль',2003,NULL),(151,150,'1G-FE VVTi 2.0 24v 96-',1996,NULL),(152,151,'3C-E 2.2 8v 92-96',1992,1996),(153,152,'1G-FE 2.0 24v 90-95 трамблер',1990,1995),(154,153,'3L 2.8 8v 91-97',1991,1997),(155,154,'5E-FE 1.5 16v 97-01 катушка',1997,2001),(156,155,'EJ251 2.5 16v 99-05 SOHC Phase II',1999,2005),(157,156,'4G93 1.8 16v 98-05 GDI IO',1998,2005),(158,157,'GA16DE 1.6 16v 93-99',1993,1999),(159,158,'4E-FE 1.3 16v 92-96 трамблер',1992,1996),(160,159,'KL-DE 2.5 24v 93-97',1993,1997),(161,160,'F22B 2.2 16v 94-98 VTEC',1994,1998),(162,161,'EJ20E 2.0 16v 89-99 SOHC Phase I',1989,1999),(163,162,'4D56 2.5 16v CRDi 05-',2005,NULL),(164,163,'KF-DE 2.0 24v 93-99',1993,1999),(165,164,'VQ25DE II 2.5 24v 08-11',2008,2011),(166,165,'GA16DS 1.6 16v 90-93',1990,1993),(167,166,'1UR-FE 4.6 32v 07-',2007,NULL),(168,167,'4G13 1.3 16v 95-07',1995,2007),(169,168,'QG18DE VVT 1.6 16v черный 99-06',1999,2006),(170,169,'VQ40DE 4.0 24v 05-',2005,NULL),(171,170,'EJ253 VVTi 2.5 16v 06- Phase II',2006,NULL),(172,171,'4G93 1.8 16v 97-03 GDI',1997,2003),(173,172,'4G15 1.5 16v 95-07',1995,2007),(174,173,'QR25DE II 2.5 16v 07-',2007,NULL),(175,174,'VQ35DE II 3.5 24v 08- FX вдоль',2008,NULL),(176,175,'MR20DE 2.0 16v 07-',2007,NULL),(177,176,'EJ20D 2.0 16v 94-99 DOHC Phase I',1994,1999),(178,177,'3NR-FE 1.2 16v 08-',2008,NULL),(179,178,'4G18 1.6 16v 95-07',1995,2007),(180,179,'QG18DE VVT 1.8 16v белый 99-06',1999,2006),(181,180,'EJ22E 2.2 16v 90-97 SOHC Phase I',1990,1997),(182,181,'SR20Di 2.0 16v 91-95',1991,1995),(183,182,'4A-GE 1.6 20v 96-02',1996,2002),(184,183,'EJ18E 1.8 16v 91-96 SOHC Phase I',1991,1996),(185,184,'4G94 2.0 16v 98-05 GDI IO',1998,2005),(186,185,'3UR-FBE 5.7 32v 07-',2007,NULL),(187,186,'QG16DE 1.6 16v VVT 99-06',1999,2006),(188,187,'EJ16E 1.6 16v 93-99 SOHC Phase I',1993,1999),(189,188,'SR18DE 1.8 16v 90-02',1990,2002),(190,189,'EJ15E 1.5 16v 93-99 SOHC Phase I',1993,1999),(191,190,'FE 2.0 16v 88- DOHC',1988,NULL),(192,191,'K20A 2.0 16v 01- i-VTEC',2001,NULL),(193,192,'1HZ 4.2 12v 90-',1990,NULL),(194,193,'SR20DET 2.0 16v 90-02',1990,2002),(195,194,'2C-TE 2.0 8v 97-02',1997,2002),(196,195,'QG15DE 1.5 16v 99-03',1999,2003),(197,196,'VG33E 3.3 12v 96-04',1996,2004),(198,197,'4B11 2.0 16v 07-',2007,NULL),(199,198,'F2 2.2 12v 88-92',1988,1992),(200,199,'5L-E 3.0 8v 97-',1997,NULL),(201,200,'EJ201 2.0 16v 00-07 SONC Phase II',2000,2007),(202,201,'EJ203 2.0 16v 00- SONC Phase II',2000,NULL),(203,202,'4E-FE 1.3 16v 97-01 катушка',1997,2001),(204,203,'RD28T 2.8 8v 87-97',1987,1997),(205,204,'EJ255 2.5 16v 04- DONC Turbo Phase II',2004,NULL),(206,205,'EJ257 2.5 16v 04- DONC Turbo Phase II',2004,NULL),(207,206,'1HD-FT 4.2 12v 95-',1995,NULL),(208,207,'EJ204 2.0 16v 03- DONC Phase II',2003,NULL),(209,208,'4M41-T 3.2 16v 99-06',1999,2006),(210,209,'K24A 2.4 16v 02-06 i-VTEC RD',2002,2006),(211,210,'SR20DE 2.0 16v 94-98 вдоль',1994,1998),(212,211,'EJ20G 2.0 16v 94-99 DONC single turbo Phase I',1994,1999),(213,212,'EJ254 2.5 99-03 DOHC Phase II',1999,2003),(214,213,'BP-DE 1.8 16v 94-98',1994,1998),(215,214,'H22A 2.2 16v 92-96 VTEC',1992,1996),(216,215,'GA15DE 1.5 16v 95-99',1995,1999),(217,216,'RD28ETi 2.8 8v 97-',1997,NULL),(218,217,'QG15DE 1.5 16v VVT 03-06',2003,2006),(219,218,'AJ 3.0 24v 01-07',2001,2007),(220,219,'4B12 2.4 16v 07-',2007,NULL),(221,220,'6A13-TT 2.5 98-03 DOHC',1998,2003),(222,221,'H23A 2.3 16v 92-96 VTEC',1992,1996),(223,222,'4B10 1.8 16v 07-',2007,NULL),(224,223,'GA15DS 1.5 16v 90-93',1990,1993),(225,224,'ZL-DE 1.5 16v 99-03',1999,2003),(226,225,'ZD30DDTi 3.0 16v 97-07 Y61',1997,2007),(227,226,'EJ161 1.6 16v 99- SOHC Phase II',1999,NULL),(228,227,'B5-ME 1.5 16v 91-99 SOHC',1991,1999),(229,228,'B3 1.3 16v 91-99 SOHC',1991,1999),(230,229,'KJ-ZEM 2.3 24v 95-98',1995,1998),(231,230,'1HD-FTE 4.2 24v 98-',1998,NULL),(232,231,'EJ181 1.8 16v 99- SOHC Phase II',1999,NULL),(233,232,'B6-DE 1.6 16v 97-03',1997,2003),(234,233,'2ZZ-GE 1.8 16v 99-06',1999,2006),(235,234,'3C-TE 2.2 8v 96-02',1996,2002),(236,235,'4D65-T 1.8 8v 88-92',1988,1992),(237,236,'EJ151 1.5 16v 99- SOHC Phase II',1999,NULL),(238,237,'VK56DE 5.6 32v 04-10',2004,2010),(239,238,'TB42E 4.2 12v 92-',1992,NULL),(240,239,'J30A1 3.0 24v 97-03',1997,2003),(241,240,'LF-DE 2.0 16v 02-',2002,NULL),(242,241,'K24A 2.4 16v 03-08 i-VTEC',2003,2008),(243,242,'VG30E 3.0 12v J30 88-94',1988,1994),(244,243,'VQ37VHR 3.7 24v 08- вдоль',2008,NULL),(245,244,'G25A 2.5 20v 92-97',1992,1997),(246,245,'HR15DE 1.6 16v 06-',2006,NULL),(247,246,'G6BA 2.7 24v 00-06 DELTA',2000,2006),(248,247,'G20A 2.0 20v 93-97',1993,1997),(249,248,'L3-DE 2.3 16v 03-',2003,NULL),(250,249,'YD25DDTi 2.5 05- вдоль',2005,NULL),(251,250,'K24A 2.4 16v 07- i-VTEC RE',2007,NULL),(252,251,'K24Z4 2.4 16v 07- i-VTEC RE',2007,NULL),(253,252,'RD28 2.8 8v 93-96',1993,1996),(254,253,'HR16DE II 1.6 16v 07-',2007,NULL),(255,254,'ZD30DDTi 3.0 16v 97-02 R20',1997,2002),(256,255,'TD27ETi 2.7 8v 95-',1995,NULL),(257,256,'4G15 1.5 12v 89-95',1989,1995),(258,257,'TD27T 2.7 8v 88-95',1988,1995),(259,258,'4G15 1.5 8v 89-95',1989,1995),(260,259,'L3-VE II 2.3 16v 03-',2003,NULL),(261,260,'QR25DE III 2.5 16v 13-',2013,NULL),(262,261,'LF-VE II 2.0 16v 02-',2002,NULL),(263,262,'YD22DDTi 2.2 16v 01-05',2001,2005),(264,263,'1CD-FTV 2.0 16v 00-06',2000,2006),(265,264,'YD25DDTi NEO Di 2.5 16v 98-01',1998,2001),(266,265,'VK45DE 4.5 32v 03-08',2003,2008),(267,266,'D16A 1.6 16v 92-96',1992,1996),(268,267,'J35A 3.5 24v 99-08',1999,2008),(269,268,'1VD-FTV 4.5 32v 07-',2007,NULL),(270,269,'Z5-DE 1.5 16v 95-98',1995,1998),(271,270,'4G13 1.3 8v 88-95',1988,1995),(272,271,'VK56VD 5.6 32v 10-',2010,NULL),(273,272,'D15B 1.5 16v 91-96',1991,1996),(274,273,'MR16DDT 1.6 16v 11-',2011,NULL),(275,274,'HR16DE I 1.6 16v 04-',2004,NULL),(276,275,'YD25DDT 2.5 16v 01- вдоль',2001,NULL),(277,276,'1ND-TV 1.4 16v 01-',2001,NULL),(278,277,'2AD 2.2 16v 05-',2005,NULL),(279,278,'D13B 1.3 16v 91-99',1991,1999),(280,279,'D4BF-T 2.5 8v 97-07',1997,2007),(281,280,'KA24E 2.4 12v 90-96 вдоль',1990,1996),(282,281,'K24Z3 2.4 16v 08-12 i-VTEC',2008,2012),(283,282,'R20A2 2.0 16v 06- i-VTEC',2006,NULL),(284,283,'4ZR-FE 1.6 16v 08-',2008,NULL),(285,284,'J30A5 3.0 24v 03-07',2003,2007),(286,285,'CG13DE 1.3 16v 92-02',1992,2002),(287,286,'CG10DE 1.0 16v 92-02',1992,2002),(288,287,'KA24DE 2.4 16v 97-01',1997,2001),(289,288,'RD28E 2.8 8v 99-01',1999,2001),(290,289,'4G93 1.8 16v 97- SOHС',1997,NULL),(291,290,'QD32ETi 3.2 8v 96-',1996,NULL),(292,291,'CR14DE 1.4 16v 02-',2002,NULL),(293,292,'J32A 3.2 24v 98-08',1998,2008),(294,293,'RF-T 2.0 16v CRDi 98-',1998,NULL),(295,294,'L8-VE II 1.8 16v 02-12',2002,2012),(296,295,'J25A 2.5 24v 98-03',1998,2003),(297,296,'EL15 1.5 16v 06-',2006,NULL),(298,297,'G4FD GDI 1.6 16v 10- GAMMA II',2010,NULL),(299,298,'KA24E 2.4 12v 88-96',1988,1996),(300,299,'8AR-FTS 2.0 16v 15-',2015,NULL),(301,300,'CR12DE 1.2 16v 02-',2002,NULL),(302,301,'G4FC 1.6 16v 10- GAMMA II',2010,NULL),(303,302,'LF-VD 2.0 16v 02-',2002,NULL),(304,303,'K24Z6 2.4 16v 12- i-VTEC RM',2012,NULL),(305,304,'VG30E 3.0 12v 90-95',1990,1995),(306,305,'TD42Ti 4.2 8v 87-97',1987,1997),(307,306,'J35Z1 3.5 24v 06-08',2006,2008),(308,307,'L3-VDT 2.3 06-12',2006,2012),(309,308,'KA24DE 2.4 16v 93-99 вдоль',1993,1999),(310,309,'R18A 1.8 16v 06- i-VTEC',2006,NULL),(311,310,'GY 2.5 24v 99-01',1999,2001),(312,311,'D4BH-T 2.5 8v 97-07',1997,2007),(313,312,'G4FA 1.4 16v 10- GAMMA II',2010,NULL),(314,313,'D17A 1.7 16v 01-05 VTEC',2001,2005),(315,314,'4A91 1.5 16v 04-',2004,NULL),(316,315,'K24W 2.4 16v 13- CR',2013,NULL),(317,316,'R20A9 2.0 16v 12- i-VTEC',2012,NULL),(318,317,'L8-DE 1.8 16v 02-12',2002,2012),(319,318,'L5-VE 2.5 16v 08-12',2008,2012),(320,319,'CD20 2.0 8v 92-95',1992,1995),(321,320,'G4CP 2.0 16v 88-98 DOHC SIRIUS',1988,1998),(322,321,'4A90 1.3 16v 04-',2004,NULL),(323,322,'G4CN 1.8 16v 92-98 DOHC SIRIUS',1992,1998),(324,323,'6B31 3.0 24v 06-',2006,NULL),(325,324,'4A92 1.6 16v 10-',2010,NULL),(326,325,'H27A 2.7 24v 00-08',2000,2008),(327,326,'G4CP 2.0 8v 88-98 SOHC SIRIUS',1988,1998),(328,327,'H25A 2.5 24v 97-05',1997,2005),(329,328,'1GD-FTV 2.8 16v 15-',2015,NULL),(330,329,'G4CN 1.8 8v 92-98 SOHC SIRIUS',1992,1998),(331,330,'G4FG 1.6 16v 10- GAMMA II',2010,NULL),(332,331,'WL-T 2.5 8v 89-',1989,NULL),(333,332,'CA20E 2.0 8v 82-91',1982,1991),(334,333,'RB25DET 2.5 24v 93-02',1993,2002),(335,334,'2GD-FTV 2.4 16v 15-',2015,NULL),(336,335,'RF 2.0 8v 89- BONGO',1989,NULL),(337,336,'CD20T 2.0 8v 96-02',1996,2002),(338,337,'RF-T 2.0 8v 89- BONGO',1989,NULL),(339,338,'EZ30D 3.0 24v 00-03 DOHC aluminium',2000,2003),(340,339,'EZ30D 3.0 24v 03-09 DOHC plastic',2003,2009),(341,340,'RB20DET 2.0 24v 93-02',1993,2002),(342,341,'CD20T 2.0 8v 91-96 вдоль',1991,1996),(343,342,'CD20E 2.0 8v 98-01',1998,2001),(344,343,'R2 2.2 8v 89- BONGO',1989,NULL),(345,344,'CD20ET 2.0 8v 97-99 вдоль',1997,1999),(346,345,'G4KD 2.0 16v 07- THETA II',2007,NULL),(347,346,'G4KE 2.4 16v 07- THETA II',2007,NULL),(348,347,'H20A 2.0 24v 91-99',1991,1999),(349,348,'EZ36D 3.3 24v 10- DOHC',2010,NULL),(350,350,'F16D4 1.6 16v 09-',2009,NULL),(351,352,'F18D4 1.8 16v 09-',2009,NULL),(352,353,'LD20-T II 85-94',1985,1994),(353,354,'ZY-VE 1.5 16v 02-14',2002,2014),(354,355,'LD20 II 85-94',1985,1994),(355,356,'G4NA 2.0 16v 12- NU',2012,NULL),(356,357,'L15A 1.5 8v 01- 4plug',2001,NULL),(357,358,'L13A 1.3 8v 01- 4plug',2001,NULL),(358,359,'Z24i 2.4 8v 86-89',1986,1989),(359,360,'J35Z4 3.5 24v 09-14',2009,2014),(360,361,'TB45E 4.2 12v 97-',1997,NULL),(361,362,'G4NB 1.8 16v 11- NU',2011,NULL),(362,363,'4J11 2.0 16v 13-',2013,NULL),(363,364,'4J12 2.4 16v 13-',2013,NULL),(364,365,'TB48DE 4.2 24v 01-',2001,NULL),(365,366,'TD27ETi 2.7 8v 95-99',1995,1999),(366,367,'RD28E 2.8 8v 95-99',1995,1999),(367,368,'D4CB CRDI EURO4 07-12',2007,2012),(368,369,'ZM-DE 1.6 16v 03-09',2003,2009),(369,370,'ZJ-VE 1.3 16v 03-',2003,NULL),(370,371,'G4FJ-TT GDI 1.6 16v 10- GAMMA II',2010,NULL),(371,372,'G4LC 1.4 16v 17- GAMMA II',2017,NULL),(372,373,'VQ35DE II 3.5 24v 08- вдоль',2008,NULL),(373,375,'K4M 1.6 16v 06- DOHC',2006,NULL),(374,376,'J24B 2.4 16v 06-',2006,NULL),(375,377,'G4KC 2.4 16v 04- THETA I',2004,NULL),(376,378,'YF 2.0 16v 01-05 DONC',2001,2005),(377,379,'G4KA 2.0 16v 04- THETA I',2004,NULL),(378,382,'M113 5.0 18v 98-',1998,NULL),(379,383,'G4KH 2.0 turbo GDI 16v 10- THETA II',2010,NULL),(380,384,'J20B 2.0 16v 10-',2010,NULL),(381,385,'L4KA 2.0 16v 04-10 THETA I',2004,2010),(382,386,'G4KL 2.0 16v 17- THETA II',2017,NULL),(383,387,'G6CT 3.0 24v 99-05 SIGMA',1999,2005),(384,390,'F4R 2.0 16v 07- DONC',2007,NULL),(385,391,'DURATEC 35 /CA 3.7 24v 06- DOHC',2006,NULL),(386,392,'FB25B 2.5 16v 11- DONC',2011,NULL),(387,393,'G4GC 2.0 05- 16v BETA II',2005,NULL),(388,394,'A25A-FKS 2.5 16v 17-',2017,NULL),(389,395,'D4FB 1.6 16v 10- дизель',2010,NULL),(390,396,'D4FC 1.4 16v 10- дизель',2010,NULL),(391,397,'G16B 1.6 16v 98-05',1998,2005),(392,398,'2SZ-FE 1.3 16v 99-05',1999,2005),(393,399,'G4KG 2.4 16v 07- THETA II',2007,NULL),(394,400,'G4KG 2.4 16v 07- THETA II вдоль',2007,NULL),(395,401,'G6DB 3.3 (4 sensor) 24v 06-10 LAMBDA II',2006,2010),(396,402,'G6EA 2.7 24v 07-09 MU',2007,2009),(397,403,'L15A 1.5 16v 01- 8plug',2001,NULL),(398,404,'4JG2-T 3.1 8v 87-98',1987,1998),(399,405,'G4NC 2.0 GDI 16v 12- NU',2012,NULL),(400,406,'G4JS 2.4 16v 98-07 SIRIUS',1998,2007),(401,407,'G4JP 2.0 16v 98-11 SIRIUS',1998,2011),(402,408,'EJ205 2.0 16v 98-07 DOHC',1998,2007),(403,409,'EJ206 2.0 16v 98-03 DOHC TWIN TURBO',1998,2003),(404,410,'EJ208 2.0 16v 98-03 DOHC TWIN TURBO',1998,2003),(405,411,'G4KJ-TT GDI 2.4 16v 09- THETA II',2009,NULL),(406,412,'G6DC 3.5 24v (4 sensor) 10- LAMBDA II',2010,NULL),(407,413,'LD23 2.3 8v 95-',1995,NULL),(408,414,'L13A 1.3 16v 01- 8plug',2001,NULL),(409,416,'M16A 1.6 16v 03- VVT',2003,NULL),(410,417,'M111 2.3 16v 92-',1992,NULL),(411,418,'G16A 1.6 16v 88-94 SOHC трамблер',1988,1994),(412,419,'G4ED 1.6 16v 00-03 PHASE I ALPHA II',2000,2003),(413,421,'DURATEC 35 /CY 3.5 24v 06- DOHC',2006,NULL),(414,424,'G15MF 1.5 8v 94-02 SONC',1994,2002),(415,425,'M111 1.8 16v 92-',1992,NULL),(416,426,'G4ED 1.6 16v 03-06 PHASE II ALPHA II',2003,2006),(417,427,'G4LA 1.4 16v 11- KAPPA II',2011,NULL),(418,428,'PE-VPS 2.0 16v 12-',2012,NULL),(419,430,'1SZ-FE 1.0 16v 99-05',1999,2005),(420,432,'D4FD 1.7 16v 10- дизель',2010,NULL),(421,433,'M111 2.0 16v 92-',1992,NULL),(422,434,'FA20F 2.0 16v 12- DOHC turbo',2012,NULL),(423,435,'G4GF 2.0 16v 96-01 BETA',1996,2001),(424,436,'4G64 2.4 16v 97-02 DONC',1997,2002),(425,437,'D4EA-T 2.0 16v 94- U',1994,NULL),(426,438,'FB16E 1.6 12- DOHC',2012,NULL),(427,439,'G3LA 1.0 12v 11- KAPPA II',2011,NULL),(428,440,'G4LA 1.25 16v 11- KAPPA II',2011,NULL),(429,441,'VQ25HR 2.5 24v 06-',2006,NULL),(430,442,'EE20 2.0 09- дизель',2009,NULL),(431,443,'ZD30DDTi 3.0 16v 99-04 COMMON RAIL Y61',1999,2004),(432,444,'SR20DET 2.0 16v 91-01',1991,2001),(433,445,'4G93 1.8 16v 97- DOHC',1997,NULL),(434,446,'4G64 2.4 8v 86-96',1986,1996),(435,447,'4JX1-T 3.0 16v 98-02 DONC',1998,2002),(436,448,'1UR-GSE 4.6 32v 07-',2007,NULL),(437,449,'G6CU 3.5 24v 01-07 SIGMA',2001,2007),(438,450,'G6AU 3.5 24v 92-07 SIGMA',1992,2007),(439,451,'G6HC 3.5 24v 00-07 SIGMA',2000,2007),(440,452,'G4GB 1.8 16v 00-10 BETA',2000,2010),(441,453,'M15A 1.5 16v 03- VVT',2003,NULL),(442,456,'AGA 2.4 30v 97-',1997,NULL),(443,457,'K4J 1.4 16v 06- DONC',2006,NULL),(444,459,'D4CB CRDI EURO4 12-',2012,NULL),(445,460,'ACK 2.8 30v 96-',1996,NULL),(446,461,'EJ20T 2.0 16v 97-15',1997,2015),(447,462,'M13A 1.3 16v 00- VVT',2000,NULL),(448,463,'6VE1 3.5 24v 98-04 DONC',1998,2004),(449,464,'G6DA 3.8 24v (4 sensor) 09- LAMBDA II',2009,NULL),(450,465,'FB16F 1.6 16v 14- DOHC turbo',2014,NULL),(451,466,'4G92 1.6 16v 97- SOHC',1997,NULL),(452,468,'G4EE 1.4 16v 05-11 ALPHA II',2005,2011),(453,469,'A08S3 0.8 6v S-TEC 05-15',2005,2015),(454,470,'F-P5 1.5 16v 14-',2014,NULL),(455,472,'D15 1.5 8v 84-06',1984,2006),(456,473,'M52 24v 94-01',1994,2001),(457,475,'QG18DD 1.8 16v 99-07',1999,2007),(458,479,'APT 1.8 20v 96-',1996,NULL),(459,480,'AGN 1.8 20v 97-',1997,NULL),(460,481,'4D56-TDi 2.5 8v 86-92',1986,1992),(461,482,'4JK1 2.5 16v 16- DONC',2016,NULL),(462,486,'X25D1 2.5 20v 06-11',2006,2011),(463,487,'AAA 2.8 12v 91-',1991,NULL),(464,488,'TD42Ti 4.2 8v 98-',1998,NULL),(465,489,'4M42-T 3.0 16v 06-',2006,NULL),(466,490,'G4GM 1.8 16v 95-03 BETA',1995,2003),(467,492,'D14Z5 1.4 16v 01-05',2001,2005),(468,494,'C20NED 2.0 16v 97-02 DONC',1997,2002),(469,495,'X20SED 2.0 16v 97-02 DONC',1997,2002),(470,499,'BLF 1.6 16v 00-',2000,NULL),(471,502,'ADR 1.8 20v 96-',1996,NULL),(472,503,'AEB 1.8 20v 99-',1999,NULL),(473,504,'3S-GTE 2.0 16v 91-96',1991,1996),(474,505,'Z22SE 2.2 16v 96-',1996,NULL),(475,506,'G4EA 1.3 16v 94-99 ALPHA II',1994,1999),(476,507,'G4FK 1.5 16v 94-99 ALPHA II',1994,1999),(477,509,'6VD1 3.2 24v 91-98 DOHC',1991,1998),(478,519,'AAR 2.3 10v 88-',1988,NULL),(479,521,'4N15 2.4 16v 10- turbo',2010,NULL),(480,522,'A15SMS 8v E-TEC 08-16 SONC',2008,2016),(481,523,'J3-T Tdi 2.9 16v 98-06',1998,2006),(482,527,'NGA 2.0 16v 93-00',1993,2000),(483,528,'A18DMS 1.8 16v 00-',2000,NULL),(484,530,'CD17 1.7 8v 92-95',1992,1995),(485,531,'A16XER 1.6 16v 08- ECOTEC',2008,NULL),(486,532,'Z18 1.8 16v 99-',1999,NULL),(487,533,'A18 1.8 16v 05-',2005,NULL),(488,534,'G15A 1.5 16v 97- SOHC',1997,NULL),(489,535,'G16A 1.5 16v 97- SOHC',1997,NULL),(490,536,'ZC 1.6 16v 93-',1993,NULL),(491,537,'GA14DS 1.4 16V 80-00',1980,2000),(492,538,'A14XER 1.4 16v 09- ECOTEC',2009,NULL),(493,539,'A14XEL 1.4 16v 10- ECOFLEX',2010,NULL),(494,540,'X20XEV 2.0 16v 94- ECOTEC',1994,NULL),(495,541,'4N13 1.8 16v 10-15',2010,2015),(496,542,'2ZR-FBE 1.8 16v 12-',2012,NULL),(497,543,'3ZR-FBE 2.0 16v 13-',2013,NULL),(498,544,'M20A-FKS 2.0 16v 18-',2018,NULL),(499,545,'G6DG 3.0 24v GDI (4 sensor) 12- LAMBDA II',2012,NULL),(500,546,'G6DH 3.3 24v GDI (4 sensor) 12- LAMBDA II',2012,NULL),(501,547,'G6DJ 3.8 24v GDI (4 sensor) 13- LAMBDA II',2013,NULL),(502,548,'D4FA 1.5 16v 10- дизель',2010,NULL),(503,556,'B15D2 1.5 16v 13- DONC S-TEC III',2013,NULL),(504,557,'LMU 1.2 16v 09- DONC',2009,NULL),(505,560,'M20 12v 83-91',1983,1991),(506,561,'M40 8v 87-93',1987,1993),(507,562,'L4KAA 2.0 16v THETA I',2004,2010),(508,349,'G4FC 1.6 16v 07-09 GAMMA I',2007,2009),(509,351,'J20A 2.0 16v 98-',1998,NULL),(510,374,'JE 3.0 8v 89-98 SOHC',1989,1998),(511,380,'D4CB CRDI EURO3 02-06',2002,2006),(512,388,'FB20B 2.0 16v 11- DONC',2011,NULL),(513,415,'4JB1-T 2.8 8v 87-98',1987,1998),(514,420,'G6DB 3.3 (2 sensor) 24v 05-09 LAMBDA I',2005,2009),(515,423,'1KR-FE 1.0 12v 04-',2004,NULL),(516,429,'PY-VPS 2.5 16v 13-',2013,NULL),(517,454,'HR16DE II 1.6 16v 07- DOHC',2007,NULL),(518,455,'EJ20D 2.0 16v 90-93 DOHC Phase I',1990,1993),(519,458,'QG13DE 1.3 16v 98-12',1998,2012),(520,467,'G6BV 2.5 24v 00-06 DELTA',2000,2006),(521,471,'EJ207 2.0 16v 98- DOHC TURBO',1998,NULL),(522,474,'6VD1 3.2 24v 93-97 SONC',1993,1997),(523,477,'G6DA 3.8 (2 sensor) 24v 06-12 LAMBDA I',2006,2012),(524,483,'C20NE 2.0 8v 89-',1989,NULL),(525,484,'C18NE 1.8 8v 89-',1989,NULL),(526,491,'K5M 2.5 24v 02-05',2002,2005),(527,496,'C18NED 1.8 16v 97-02 DONC',1997,2002),(528,497,'FB20D 2.0 16v 17- DOHC',2017,NULL),(529,501,'C32A 91-98',1991,1998),(530,508,'X18XE 1.8 16v 94- ECOTEC',1994,NULL),(531,511,'20NEJ 2.0 16v 95-98',1995,1998),(532,524,'J3-T CRDi 2.9 16v 06-14',2006,2014),(533,525,'J3-T CRDi 2.9 16v 01-07 вдоль',2001,2007),(534,529,'F18D2 1.8 16v 00-',2000,NULL),(535,549,'G6EN 3.0 24v CRDI S 08-',2008,NULL),(536,550,'FA24F 2.4 16v 19- DOHC turbo',2019,NULL),(537,558,'3C-TE 2.2 8v 93-99',1993,1999),(538,559,'J37A1 3.7 24v 06-13',2006,2013),(539,563,'G6CU 3.5 24v 01-07 SIGMA вдоль',2001,2007),(540,618,'G4JS 2.4 16v 98-07 SIRIUS вдоль',1998,2007),(541,478,'APU 1.8 20v 99-',1999,NULL),(542,493,'AAB 2.4 10v 90-',1990,NULL),(543,498,'CFNA 1.6 16v 10-',2010,NULL),(544,500,'ADZ 1.8 8v 91-',1991,NULL),(545,513,'M50 24v 90-96',1990,1996),(546,514,'M43 8v 93-02',1993,2002),(547,516,'ABC 2.6 12v 91-',1991,NULL),(548,517,'AAH 2.8 12v 91-',1991,NULL),(549,518,'AMX 2.8 30v 00-',2000,NULL),(550,520,'AXB 1.9T 8v 03-',2003,NULL),(551,551,'H4M /HR16DE 1.6 16v 15-',2015,NULL),(552,564,'2E 2.0 8v 91-97',1991,1997),(553,565,'AVU 1.6 8v 97-',1997,NULL),(554,566,'BFQ 1.6 8v 97-',1997,NULL),(555,567,'AUM 1.8 20v 97-',1997,NULL),(556,568,'AZJ 2.0 8v 97-',1997,NULL),(557,569,'APK 2.0 8v 97-',1997,NULL),(558,570,'ALT 2.0 20v 01-',2001,NULL),(559,571,'SF 1.8 8v 86-90',1986,1990),(560,572,'3A 2.0 8v 86-90',1986,1990),(561,573,'ABK 2.0 8v 91-95',1991,1995),(562,574,'ASN 3.0 30v 01-04',2001,2004),(563,575,'BDW 2.4 24v 04-08',2004,2008),(564,576,'AUK 3.2 24v 04-10',2004,2010),(565,577,'CDNB 2.0 16v 10-14',2010,2014),(566,578,'CHVA 2.8 24v 10-14',2010,2014),(567,579,'CGWD 3.0 24v 10-14',2010,2014),(568,580,'AUX 4.2 40v 98-02',1998,2002),(569,581,'BGK 4.2 40v 02-05',2002,2005),(570,582,'ARE 2.7 30v 01-05',2001,2005),(571,583,'BHK 3.6 24v 06-09',2006,2009),(572,584,'BAR 4.2 32v 06-09',2006,2009),(573,585,'M54 24v 00-05',2000,2005),(574,586,'M62 32v 95-04',1995,2004),(575,587,'N52 24v 03-07',2003,2007),(576,588,'N62 32v 03-10',2003,2010),(577,589,'N53 24v 07-10',2007,2010),(578,590,'M60 32v 94-98',1994,1998),(579,591,'N55 24v 09-14',2009,2014),(580,592,'N63 32v 09-14',2009,2014),(581,593,'CJBB 2.0 16v 00-07',2000,2007),(582,605,'BBY 1.4 16v 99-07',1999,2007),(583,606,'BSE 1.6 16v 05-10',2005,2010),(584,607,'AZM 2.0 8v 96-03',1996,2003),(585,608,'AWT 1.8 20v 02-08',2002,2008),(586,609,'CDAB 1.8 16v 08-13',2008,2013),(587,610,'CHHB 2.0 16v 14-',2014,NULL),(588,611,'CAWB 2.0 16v 05-10',2005,2010),(589,612,'CWVA 1.6 16v 12-',2012,NULL),(590,613,'AGG 2.0 8v 96-00',1996,2000),(591,614,'BLK 2.5 10v 02-09',2002,2009),(592,615,'BMX 3.2 24v 02-06',2002,2006),(593,616,'ACU 2.5 10v 90-03',1990,2003),(594,617,'AXE 2.5 10v 03-10',2003,2010),(595,381,'M112 3.2 18v 97-',1997,NULL),(596,389,'M104 24v 89-',1989,NULL),(597,422,'Z24SED 2.4 16v 06-',2006,NULL),(598,431,'F14D4 1.4 16v 07-',2007,NULL),(599,476,'A15MF 1.5 16v E-TEC II 02- DONC',2002,NULL),(600,485,'X20D1 2.0 20v 06-11',2006,2011),(601,510,'F8CV 0.8 6v 97-16',1997,2016),(602,512,'Z24XE 2.4 16v 06-11',2006,2011),(603,515,'F16D3 16v E-TEC II 02- DOHC',2002,NULL),(604,526,'L91 1.6 16v E-TEC II 02-DONC',2002,NULL),(605,552,'LE5 2.4 16v 08-',2008,NULL),(606,553,'LAF 2.4 16v 11-14',2011,2014),(607,554,'LE9 2.4 16v 10-',2010,NULL),(608,555,'LF1 3.0 24v 10-',2010,NULL),(609,594,'M272 3.5 24v 05-11',2005,2011),(610,595,'M273 5.5 32v 05-11',2005,2011),(611,596,'OM601 2.3 8v 96-98',1996,1998),(612,597,'OM611 2.2 16v 98-03',1998,2003),(613,598,'OM646 2.2 16v 03-10',2003,2010),(614,599,'OM651 2.2 16v 10-14',2010,2014),(615,600,'M103 2.6 12v 85-95',1985,1995),(616,601,'M102 2.0 8v 85-92',1985,1992),(617,602,'M119 5.0 32v 92-98',1992,1998),(618,603,'M271 1.8 16v 02-14',2002,2007),(619,604,'X25XE 2.5 24v 94-03',1994,2003);
/*!40000 ALTER TABLE `engines` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `favourites_part_id_foreign` (`part_id`),
  KEY `favourites_user_id_foreign` (`user_id`),
  CONSTRAINT `favourites_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `favourites` WRITE;
/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;
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
INSERT INTO `filters` VALUES (1,'Назначение',NULL,1,1,'2019-10-08 15:26:34','2019-11-25 08:30:26'),(4,'Filter 2',NULL,3,1,'2019-10-08 16:42:28','2019-10-10 15:50:55'),(5,'Filter 5',1,1,1,'2019-10-08 17:12:56','2019-10-08 17:20:34'),(6,'Filter 3',NULL,2,1,'2019-10-08 17:16:36','2019-10-10 15:50:55'),(7,'Filter 6',1,2,1,'2019-10-08 17:20:27','2019-10-08 17:20:34');
/*!40000 ALTER TABLE `filters` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gallery` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` int(10) unsigned DEFAULT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (30,'parts',4,'PPTJkjEw8AAikLuXz5.png',NULL,NULL,0),(31,'parts',11,'rOOpQABFWNaaTFp3mD.png',NULL,NULL,0),(32,'parts',11,'537gokKCapLWBmActH.png',NULL,NULL,0);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `generations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine` mediumint(8) unsigned DEFAULT NULL,
  `year` smallint(5) unsigned DEFAULT NULL,
  `year_to` smallint(5) unsigned DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `generations_cid_unique` (`cid`),
  KEY `generations_model_id_foreign` (`model_id`),
  CONSTRAINT `generations_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=729 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `generations` WRITE;
/*!40000 ALTER TABLE `generations` DISABLE KEYS */;
INSERT INTO `generations` VALUES (1,NULL,1,'C',NULL,2013,NULL,1),(2,NULL,2,'B3',NULL,1986,1991,1),(3,NULL,2,'B4',NULL,1991,1996,1),(4,NULL,3,'C3',NULL,1988,1991,1),(5,NULL,3,'C4',NULL,1991,1994,1),(6,NULL,4,NULL,NULL,1994,2001,1),(7,NULL,5,'C4',NULL,1994,1997,1),(8,NULL,5,'C5',NULL,1997,2004,1),(9,NULL,5,'C6',NULL,2004,2010,1),(10,NULL,5,'C7',NULL,2010,2014,1),(11,NULL,6,'D2',NULL,1994,2002,1),(12,NULL,6,'D3',NULL,2002,2009,1),(13,NULL,7,NULL,NULL,2005,2009,1),(14,NULL,8,'E30',NULL,1982,1994,1),(15,NULL,8,'E36',NULL,1990,2000,1),(16,NULL,8,'E46',NULL,1998,2007,1),(17,NULL,8,'E90',NULL,2004,2014,1),(18,NULL,9,'E34',NULL,1987,1996,1),(19,NULL,9,'E39',NULL,1995,2004,1),(20,NULL,9,'E60',NULL,2003,2010,1),(21,NULL,10,'E38',NULL,1994,2001,1),(22,NULL,10,'E65',NULL,2001,2008,1),(23,NULL,11,'E53',NULL,1999,2006,1),(24,NULL,12,'E71',NULL,2008,2014,1),(25,NULL,13,'T200',NULL,2002,2007,1),(26,NULL,13,'T250',NULL,2007,2011,1),(27,NULL,13,'T300',NULL,2012,NULL,1),(28,NULL,14,NULL,NULL,2006,2018,1),(29,NULL,15,NULL,NULL,2011,NULL,1),(30,NULL,16,'J300',NULL,2008,2016,1),(31,NULL,17,NULL,NULL,2006,2012,1),(32,NULL,18,'J200',NULL,2004,2013,1),(33,NULL,19,NULL,NULL,2011,NULL,1),(34,NULL,20,'J100',NULL,1997,1999,1),(35,NULL,20,'J200',NULL,2002,2005,1),(36,NULL,21,'J309',NULL,2011,2018,1),(37,NULL,22,'M200',NULL,2005,2010,1),(38,NULL,22,'M300',NULL,2009,2015,1),(39,NULL,23,NULL,NULL,2013,NULL,1),(40,NULL,24,NULL,NULL,2013,2016,1),(41,NULL,25,'J200',NULL,2002,2009,1),(42,NULL,26,'V100',NULL,1997,2002,1),(43,NULL,27,'M100',NULL,1998,NULL,1),(44,NULL,28,'I (N100)',NULL,1996,2008,1),(45,NULL,28,'II (N150)',NULL,2008,2016,1),(46,NULL,29,NULL,NULL,2000,2006,1),(47,NULL,30,'II',NULL,1996,2000,1),(48,NULL,30,'III',NULL,2000,2007,1),(49,NULL,31,'CD',NULL,1994,1997,1),(50,NULL,31,'CG CH',NULL,1998,2003,1),(51,NULL,31,'CL',NULL,2003,2007,1),(52,NULL,31,'CR',NULL,2012,2017,1),(53,NULL,31,'CU',NULL,2008,2012,1),(54,NULL,32,'RDX TB1 TB2',NULL,2006,2012,1),(55,NULL,33,'EG',NULL,1992,1995,1),(56,NULL,33,'EJ',NULL,1996,2000,1),(57,NULL,33,'FB',NULL,2012,2015,1),(58,NULL,33,'FD',NULL,2006,2011,1),(59,NULL,33,'VII ES EP EU',NULL,2000,2006,1),(60,NULL,34,'RD1',NULL,1995,2001,1),(61,NULL,34,'RD4',NULL,2002,2006,1),(62,NULL,34,'RE5',NULL,2007,2011,1),(63,NULL,34,'RM',NULL,2012,2016,1),(64,NULL,34,'RW',NULL,2017,NULL,1),(65,NULL,35,'YH',NULL,2002,2011,1),(66,NULL,36,'GD',NULL,2001,2008,1),(67,NULL,36,'GE',NULL,2009,2014,1),(68,NULL,37,'GH',NULL,1999,2006,1),(69,NULL,38,'UA1',NULL,1995,1998,1),(70,NULL,39,'R1',NULL,1994,1999,1),(71,NULL,39,'R6',NULL,1999,2003,1),(72,NULL,39,'RB1 RB2',NULL,2003,2008,1),(73,NULL,39,'RC1 RC2',NULL,2013,NULL,1),(74,NULL,40,'EL1',NULL,1996,2002,1),(75,NULL,41,'YF1',NULL,2003,2008,1),(76,NULL,41,'YF4',NULL,2009,2015,1),(77,NULL,42,'BB',NULL,1996,NULL,1),(78,NULL,42,'BB1',NULL,1991,1996,1),(79,NULL,43,'UA1',NULL,1995,1998,1),(80,NULL,44,'R1',NULL,1994,1999,1),(81,NULL,44,'R6',NULL,1999,2003,1),(82,NULL,44,'RB1',NULL,2003,2008,1),(83,NULL,45,'RF1',NULL,1996,2001,1),(84,NULL,45,'RF3',NULL,2001,2005,1),(85,NULL,45,'RG1',NULL,2005,2009,1),(86,NULL,45,'RK1',NULL,2009,2015,1),(87,NULL,46,'RN1',NULL,2000,2006,1),(88,NULL,47,'HC',NULL,2017,NULL,1),(89,NULL,47,'RB',NULL,2011,2017,1),(90,NULL,48,'HD',NULL,2007,2010,1),(91,NULL,49,'GS',NULL,2015,NULL,1),(92,NULL,50,'AD',NULL,2016,NULL,1),(93,NULL,50,'HD',NULL,2007,2010,1),(94,NULL,50,'MD/UD',NULL,2011,2015,1),(95,NULL,51,'II JK-01',NULL,1998,2003,1),(96,NULL,52,'DH',NULL,2013,NULL,1),(97,NULL,53,'TB',NULL,2002,2011,1),(98,NULL,54,'TQ',NULL,2007,NULL,1),(99,NULL,55,'HG',NULL,2012,2017,1),(100,NULL,55,'TG',NULL,2006,2010,1),(101,NULL,56,'TQ',NULL,2007,NULL,1),(102,NULL,57,'GD',NULL,2011,2017,1),(103,NULL,58,'VF',NULL,2011,NULL,1),(104,NULL,59,'LM',NULL,2009,2015,1),(105,NULL,60,'FC',NULL,2001,2010,1),(106,NULL,61,NULL,NULL,2004,NULL,1),(107,NULL,61,NULL,NULL,1996,2004,1),(108,NULL,62,'CM',NULL,2006,2012,1),(109,NULL,62,'DM NC',NULL,2013,2018,1),(110,NULL,62,'TM',NULL,2019,NULL,1),(111,NULL,62,'SM',NULL,2000,2006,1),(112,NULL,63,'HCR',NULL,2017,NULL,1),(113,NULL,63,'RB',NULL,2010,2017,1),(114,NULL,64,'EF',NULL,1998,2005,1),(115,NULL,64,'LF',NULL,2015,NULL,1),(116,NULL,64,'NF',NULL,2005,2009,1),(117,NULL,64,'Y3',NULL,1996,1998,1),(118,NULL,64,'YF',NULL,2010,2014,1),(119,NULL,65,'A1',NULL,1997,2007,1),(120,NULL,66,'HP',NULL,2001,2007,1),(121,NULL,67,NULL,NULL,1999,2007,1),(122,NULL,68,'JM',NULL,2005,2010,1),(123,NULL,68,'LM',NULL,2010,2015,1),(124,NULL,68,'TL',NULL,2016,NULL,1),(125,NULL,69,'FS',NULL,2011,2014,1),(126,NULL,70,'J50',NULL,2007,2013,1),(127,NULL,71,'S50',NULL,2002,2008,1),(128,NULL,72,'S51',NULL,2008,2013,1),(129,NULL,73,'V35',NULL,2003,2006,1),(130,NULL,74,'A33',NULL,1999,2003,1),(131,NULL,75,'JA60',NULL,2004,2010,1),(132,NULL,76,'Z62',NULL,2013,NULL,1),(133,NULL,77,NULL,NULL,1991,2002,1),(134,NULL,78,'RT50 RT85',NULL,2012,NULL,1),(135,NULL,79,'VG',NULL,2010,2016,1),(136,NULL,79,'YG',NULL,2017,NULL,1),(137,NULL,80,'RP',NULL,2013,NULL,1),(138,NULL,80,'RS',NULL,1999,2006,1),(139,NULL,80,'UN',NULL,2006,2013,1),(140,NULL,81,'GQ',NULL,2002,2005,1),(141,NULL,81,'VQ',NULL,2006,2014,1),(142,NULL,81,'YP',NULL,2015,NULL,1),(143,NULL,82,'ED',NULL,2006,2012,1),(144,NULL,82,'JD',NULL,2012,2018,1),(145,NULL,83,'LD',NULL,2003,2008,1),(146,NULL,83,'TD',NULL,2008,2013,1),(147,NULL,83,'YD',NULL,2013,2018,1),(148,NULL,84,NULL,NULL,2008,NULL,1),(149,NULL,85,'JA',NULL,2017,NULL,1),(150,NULL,85,'TA',NULL,2011,2017,1),(151,NULL,86,'JF',NULL,2015,NULL,1),(152,NULL,86,'TF',NULL,2010,2015,1),(153,NULL,87,'JA',NULL,2017,NULL,1),(154,NULL,87,'TA',NULL,2011,2017,1),(155,NULL,88,'UB',NULL,2012,2017,1),(156,NULL,88,'YB',NULL,2017,NULL,1),(157,NULL,89,'BL',NULL,2002,2009,1),(158,NULL,89,'UM',NULL,2015,NULL,1),(159,NULL,89,'XM',NULL,2010,2014,1),(160,NULL,90,'AM',NULL,2009,2013,1),(161,NULL,90,'PS',NULL,2014,NULL,1),(162,NULL,91,'JE/KM',NULL,2004,2010,1),(163,NULL,91,'QL',NULL,2015,NULL,1),(164,NULL,91,'SL',NULL,2010,2015,1),(165,NULL,92,NULL,NULL,2012,NULL,1),(166,NULL,93,'J150',NULL,2009,NULL,1),(167,NULL,94,'J100',NULL,1998,2007,1),(168,NULL,94,'J120',NULL,2002,2009,1),(169,NULL,95,'J200',NULL,2007,NULL,1),(170,NULL,96,'XV10',NULL,1991,1996,1),(171,NULL,96,'XV20',NULL,1996,2001,1),(172,NULL,96,'XV30',NULL,2002,2006,1),(173,NULL,96,'XV40',NULL,2006,2012,1),(174,NULL,96,'XV60',NULL,2012,2018,1),(175,NULL,97,'210 (2WD)',NULL,2015,NULL,1),(176,NULL,97,'L10',NULL,2011,NULL,1),(177,NULL,97,'S140',NULL,1991,1997,1),(178,NULL,97,'S160',NULL,1997,2005,1),(179,NULL,97,'S190',NULL,2005,2011,1),(180,NULL,98,'XE10',NULL,1998,2005,1),(181,NULL,98,'XE20',NULL,2005,2015,1),(182,NULL,98,'XE30',NULL,2016,NULL,1),(183,NULL,99,'XF30',NULL,2000,2006,1),(184,NULL,99,'XF40',NULL,2006,2017,1),(185,NULL,99,'XF50',NULL,2017,NULL,1),(186,NULL,100,'A210',NULL,2014,NULL,1),(187,NULL,101,'AL10',NULL,2008,2015,1),(188,NULL,101,'AL20',NULL,2015,NULL,1),(189,NULL,101,'XU10',NULL,1998,2003,1),(190,NULL,101,'XU30',NULL,2003,2008,1),(191,NULL,102,'BK',NULL,2003,2009,1),(192,NULL,102,'BL',NULL,2009,2013,1),(193,NULL,102,'BM BN',NULL,2013,2019,1),(194,NULL,103,'BG',NULL,1989,1994,1),(195,NULL,103,'BH',NULL,1994,1998,1),(196,NULL,103,'BJ',NULL,1998,2003,1),(197,NULL,104,'BH',NULL,1994,1998,1),(198,NULL,105,'GG1',NULL,2002,2008,1),(199,NULL,105,'GH1',NULL,2007,2012,1),(200,NULL,105,'GJ1/GL',NULL,2012,NULL,1),(201,NULL,106,'GD GV',NULL,1989,1992,1),(202,NULL,106,'GE',NULL,1991,1997,1),(203,NULL,106,'GF GW',NULL,1997,2005,1),(204,NULL,107,NULL,NULL,1983,1999,1),(205,NULL,108,'GF GW',NULL,1997,2005,1),(206,NULL,109,'GE',NULL,1991,1997,1),(207,NULL,110,'KE',NULL,2012,2017,1),(208,NULL,110,'KF',NULL,2017,NULL,1),(209,NULL,111,'ER',NULL,2006,2012,1),(210,NULL,112,'TB',NULL,2007,2016,1),(211,NULL,112,'TC',NULL,2017,NULL,1),(212,NULL,113,'DW',NULL,1996,2002,1),(213,NULL,113,'DY',NULL,2002,2007,1),(214,NULL,114,'BH',NULL,1994,1998,1),(215,NULL,115,'LV5W',NULL,1990,1999,1),(216,NULL,115,'LW3W',NULL,2006,2016,1),(217,NULL,115,'LW3W',NULL,1999,2006,1),(218,NULL,116,'CP8W',NULL,1999,2004,1),(219,NULL,117,NULL,NULL,2000,2007,1),(220,NULL,118,'6',NULL,1992,1999,1),(221,NULL,118,'9',NULL,1993,2002,1),(222,NULL,119,'W163',NULL,1998,2005,1),(223,NULL,119,'W164',NULL,2005,2011,1),(224,NULL,120,'901',NULL,1995,NULL,1),(225,NULL,120,'906',NULL,2006,NULL,1),(226,NULL,121,'W638',NULL,1996,2003,1),(227,NULL,121,'W639',NULL,2003,2014,1),(228,NULL,122,NULL,NULL,1984,1996,1),(229,NULL,123,NULL,NULL,1991,1998,1),(230,NULL,124,NULL,NULL,1988,1993,1),(231,NULL,125,NULL,NULL,1993,2000,1),(232,NULL,126,NULL,NULL,2000,2007,1),(233,NULL,127,NULL,NULL,2007,2014,1),(234,NULL,128,NULL,NULL,1996,2002,1),(235,NULL,129,NULL,NULL,2003,2009,1),(236,NULL,130,NULL,NULL,1998,2005,1),(237,NULL,131,NULL,NULL,2005,2013,1),(238,NULL,132,NULL,NULL,1997,NULL,1),(239,NULL,133,NULL,NULL,2002,NULL,1),(240,NULL,134,'CU2W',NULL,2001,2005,1),(241,NULL,135,'GA4W',NULL,2010,NULL,1),(242,NULL,136,'D2',NULL,1995,2004,1),(243,NULL,137,'PA',NULL,1996,2008,1),(244,NULL,138,'L300',NULL,1986,1994,1),(245,NULL,138,'L400',NULL,1994,2007,1),(246,NULL,139,'F31A',NULL,1995,2005,1),(247,NULL,140,'2G',NULL,1995,1999,1),(248,NULL,141,'DJ1',NULL,2004,2012,1),(249,NULL,141,'E33',NULL,1988,1992,1),(250,NULL,141,'E52',NULL,1993,1996,1),(251,NULL,141,'EA1',NULL,1996,2005,1),(252,NULL,142,'NA4W',NULL,2004,2009,1),(253,NULL,143,'KB4T',NULL,2005,2016,1),(254,NULL,144,'C61A',NULL,1988,1991,1),(255,NULL,144,'CB',NULL,1992,1996,1),(256,NULL,144,'CK CM',NULL,1997,2001,1),(257,NULL,144,'CS',NULL,2003,2010,1),(258,NULL,144,'CY',NULL,2007,2016,1),(259,NULL,145,'EA1',NULL,1996,2005,1),(260,NULL,146,'PA',NULL,1996,2008,1),(261,NULL,147,'CU0W',NULL,2003,2006,1),(262,NULL,147,'CW0W',NULL,2005,2012,1),(263,NULL,147,'GF0W',NULL,2012,2018,1),(264,NULL,148,'IO H66W',NULL,1998,2000,1),(265,NULL,148,'IO H76W',NULL,2000,2007,1),(266,NULL,148,'L040',NULL,1982,1991,1),(267,NULL,149,'PB PC',NULL,2008,2016,1),(268,NULL,149,'QE',NULL,2015,NULL,1),(269,NULL,148,'V20',NULL,1991,1999,1),(270,NULL,148,'V60',NULL,1999,2006,1),(271,NULL,148,'V80',NULL,2006,NULL,1),(272,NULL,150,'N11W',NULL,1991,1997,1),(273,NULL,150,'N61W',NULL,1997,2002,1),(274,NULL,151,'1991-1996',NULL,NULL,NULL,1),(275,NULL,152,'L400',NULL,1994,2007,1),(276,NULL,153,'N11W',NULL,1991,1997,1),(277,NULL,154,NULL,NULL,1998,2005,1),(278,NULL,155,'UF/N34W',NULL,1991,1997,1),(279,NULL,155,'UG/N84W',NULL,1998,2004,1),(280,NULL,156,'G',NULL,2011,NULL,1),(281,NULL,156,'N15',NULL,1995,2000,1),(282,NULL,156,'N16',NULL,2000,2006,1),(283,NULL,157,'V10',NULL,1998,2006,1),(284,NULL,158,'L31',NULL,2001,2006,1),(285,NULL,158,'L32A',NULL,2007,2013,1),(286,NULL,158,'L33',NULL,2012,2018,1),(287,NULL,159,'WA60',NULL,2004,2016,1),(288,NULL,160,'U14',NULL,1996,2001,1),(289,NULL,161,'Y33',NULL,1995,1999,1),(290,NULL,162,'A32',NULL,1994,1999,1),(291,NULL,162,'A33',NULL,1999,2003,1),(292,NULL,163,'Z10',NULL,1998,2002,1),(293,NULL,164,'E50',NULL,1997,2002,1),(294,NULL,164,'E51',NULL,2002,2010,1),(295,NULL,165,'F15',NULL,2011,NULL,1),(296,NULL,166,'W30',NULL,1992,1998,1),(297,NULL,167,'M12',NULL,1998,2004,1),(298,NULL,168,'K11',NULL,1993,2002,1),(299,NULL,169,'A32',NULL,1994,1999,1),(300,NULL,169,'A33',NULL,1999,2003,1),(301,NULL,169,'A34',NULL,2003,2008,1),(302,NULL,169,'A35',NULL,2008,2014,1),(303,NULL,169,'J30',NULL,1988,1994,1),(304,NULL,170,'K11',NULL,1993,2002,1),(305,NULL,170,'K12',NULL,2002,2007,1),(306,NULL,171,'R20',NULL,1988,2006,1),(307,NULL,172,'Z50',NULL,2003,2007,1),(308,NULL,172,'Z51',NULL,2009,2014,1),(309,NULL,172,'Z52',NULL,2015,NULL,1),(310,NULL,173,'D22',NULL,1997,2004,1),(311,NULL,173,'D40',NULL,2005,NULL,1),(312,NULL,174,'E11',NULL,2004,2013,1),(313,NULL,174,'E12',NULL,2012,NULL,1),(314,NULL,175,'D22',NULL,2008,2015,1),(315,NULL,176,'R50',NULL,1996,2004,1),(316,NULL,176,'R51',NULL,2005,2012,1),(317,NULL,176,'R52',NULL,2013,NULL,1),(318,NULL,177,'Y60',NULL,1987,1997,1),(319,NULL,177,'Y61',NULL,1997,2013,1),(320,NULL,177,'Y62',NULL,2010,NULL,1),(321,NULL,178,'M11',NULL,1988,1998,1),(322,NULL,179,'U30',NULL,1998,2003,1),(323,NULL,180,'P10',NULL,1990,1996,1),(324,NULL,180,'P11',NULL,1995,2002,1),(325,NULL,180,'P12',NULL,2001,2007,1),(326,NULL,181,'N14',NULL,1990,1995,1),(327,NULL,182,'J10',NULL,2006,2013,1),(328,NULL,182,'J11',NULL,2013,NULL,1),(329,NULL,183,NULL,NULL,1993,1999,1),(330,NULL,184,'R50',NULL,1996,2004,1),(331,NULL,185,NULL,NULL,1997,2001,1),(332,NULL,186,'B16',NULL,2006,2012,1),(333,NULL,186,'B17',NULL,2013,NULL,1),(334,NULL,187,'C23',NULL,1991,2000,1),(335,NULL,188,'R33',NULL,1993,1998,1),(336,NULL,188,'R34',NULL,1998,2002,1),(337,NULL,189,'N14',NULL,1990,1995,1),(338,NULL,189,'N17',NULL,2012,2016,1),(339,NULL,190,'J31',NULL,2003,2008,1),(340,NULL,190,'J32',NULL,2008,2013,1),(341,NULL,190,'L33',NULL,2013,NULL,1),(342,NULL,191,'II (R20)',NULL,NULL,NULL,1),(343,NULL,191,'WD21',NULL,1986,1995,1),(344,NULL,192,'C11',NULL,2004,2012,1),(345,NULL,192,'C12',NULL,2011,NULL,1),(346,NULL,193,'C22',NULL,1985,1994,1),(347,NULL,194,'N50',NULL,2005,2015,1),(348,NULL,194,'WD22',NULL,1999,2004,1),(349,NULL,195,'T30',NULL,2000,2007,1),(350,NULL,195,'T31',NULL,2007,2013,1),(351,NULL,195,'T32',NULL,2013,NULL,1),(352,NULL,196,'F',NULL,1994,1998,1),(353,NULL,196,'G',NULL,1998,2010,1),(354,NULL,197,'A',NULL,1992,1998,1),(355,NULL,198,'B',NULL,1994,2003,1),(356,NULL,199,'B',NULL,1995,2003,1),(357,NULL,199,'C',NULL,2002,2008,1),(358,NULL,200,'A',NULL,2002,2008,1),(359,NULL,201,NULL,NULL,2016,NULL,1),(360,NULL,202,NULL,NULL,2010,2015,1),(361,NULL,202,NULL,NULL,2015,2018,1),(362,NULL,203,'I',NULL,1997,2007,1),(363,NULL,204,NULL,NULL,2013,2017,1),(364,NULL,205,'II',NULL,2002,2009,1),(365,NULL,206,NULL,NULL,2009,2014,1),(366,NULL,207,NULL,NULL,2014,2018,1),(367,NULL,208,NULL,NULL,2000,2007,1),(368,NULL,209,'I',NULL,1996,2004,1),(369,NULL,209,'II',NULL,2004,2009,1),(370,NULL,210,'3T4',NULL,2008,2013,1),(371,NULL,210,NULL,NULL,2014,NULL,1),(372,NULL,210,'3U4',NULL,2001,2008,1),(373,NULL,211,'5L7',NULL,2009,2014,1),(374,NULL,212,NULL,NULL,2019,NULL,1),(375,NULL,213,'SF',NULL,1997,2002,1),(376,NULL,213,'SG',NULL,2002,2007,1),(377,NULL,213,'SH',NULL,2008,2012,1),(378,NULL,213,'SJ',NULL,2013,2018,1),(379,NULL,214,'GD',NULL,2000,2007,1),(380,NULL,214,'GE GV GH GR',NULL,2007,2014,1),(381,NULL,214,'GJ GP',NULL,2011,2016,1),(382,NULL,214,'GM GC GF',NULL,1992,2000,1),(383,NULL,215,'BC BF BJ',NULL,1989,1993,1),(384,NULL,215,'BD BG BK',NULL,1993,1999,1),(385,NULL,215,'BE BH BT',NULL,1998,2004,1),(386,NULL,215,'BL BP',NULL,2003,2009,1),(387,NULL,215,'BM BR',NULL,2009,2014,1),(388,NULL,215,'BN BS',NULL,2014,NULL,1),(389,NULL,216,NULL,NULL,2003,2009,1),(390,NULL,216,NULL,NULL,2009,2014,1),(391,NULL,216,NULL,NULL,2014,NULL,1),(392,NULL,216,NULL,NULL,1993,1999,1),(393,NULL,216,NULL,NULL,1999,2004,1),(394,NULL,217,'B9',NULL,2006,2014,1),(395,NULL,218,NULL,NULL,2011,NULL,1),(396,NULL,219,NULL,NULL,2001,2007,1),(397,NULL,220,'ZC72S ZC82S ZC32S',NULL,2010,2017,1),(398,NULL,221,NULL,NULL,2006,2014,1),(399,NULL,222,'ET/TA',NULL,1988,1998,1),(400,NULL,222,'JT',NULL,2005,2017,1),(401,NULL,223,'FT/GT',NULL,1998,2005,1),(402,NULL,224,NULL,NULL,2007,2009,1),(403,NULL,224,NULL,NULL,1998,2006,1),(404,NULL,225,'N130',NULL,1989,1995,1),(405,NULL,225,'N180',NULL,1996,2002,1),(406,NULL,225,'N210',NULL,2002,2009,1),(407,NULL,225,'N280',NULL,2009,NULL,1),(408,NULL,226,'XE10',NULL,1998,2005,1),(409,NULL,227,'S140',NULL,1991,1997,1),(410,NULL,227,'S160',NULL,1997,2005,1),(411,NULL,228,'XX10',NULL,1994,1999,1),(412,NULL,228,'XX20',NULL,1999,2004,1),(413,NULL,228,'XX30',NULL,2004,2012,1),(414,NULL,228,'XX40',NULL,2012,2018,1),(415,NULL,228,'XX50',NULL,2018,NULL,1),(416,NULL,229,'F602',NULL,2006,NULL,1),(417,NULL,230,'T220',NULL,1997,2003,1),(418,NULL,230,'T250',NULL,2003,2009,1),(419,NULL,230,'T270',NULL,2009,2018,1),(420,NULL,231,'T190',NULL,1992,1997,1),(421,NULL,231,'T210',NULL,1997,2002,1),(422,NULL,232,'ACV36',NULL,2002,2006,1),(423,NULL,232,'XV10',NULL,1991,1996,1),(424,NULL,232,'XV20',NULL,1996,2001,1),(425,NULL,232,'XV30',NULL,2002,2006,1),(426,NULL,232,'XV40',NULL,2006,2011,1),(427,NULL,232,'XV50',NULL,2011,2017,1),(428,NULL,232,'XV70',NULL,2018,NULL,1),(429,NULL,233,'E (T190)',NULL,1992,1997,1),(430,NULL,233,'ED (ST200)',NULL,1993,1998,1),(431,NULL,233,'T210',NULL,1996,2001,1),(432,NULL,234,'T200',NULL,1993,1999,1),(433,NULL,235,'X100',NULL,1996,2001,1),(434,NULL,235,'X90',NULL,1992,1996,1),(435,NULL,236,'E100',NULL,1991,2002,1),(436,NULL,236,'E120',NULL,2000,2007,1),(437,NULL,236,'E150',NULL,2006,2013,1),(438,NULL,236,'E170',NULL,2013,NULL,1),(439,NULL,237,'XR10 XR20',NULL,1990,1999,1),(440,NULL,237,'XR30 XR40',NULL,2000,2005,1),(441,NULL,238,'ST200',NULL,1993,1998,1),(442,NULL,239,'SJ15W',NULL,2006,2017,1),(443,NULL,240,'AN160',NULL,2015,NULL,1),(444,NULL,240,'AN50 AN60',NULL,2004,2015,1),(445,NULL,241,'XU10',NULL,1998,2003,1),(446,NULL,242,'H100',NULL,1989,2004,1),(447,NULL,242,'H200',NULL,2004,NULL,1),(448,NULL,243,'XU20',NULL,2000,2007,1),(449,NULL,243,'XU40',NULL,2007,2013,1),(450,NULL,243,'XU50',NULL,2013,NULL,1),(451,NULL,244,'AN10 AN20 AN30',NULL,2004,2015,1),(452,NULL,244,'AN120 AN150',NULL,2015,NULL,1),(453,NULL,244,'N140 N150 N160 N170',NULL,1997,2005,1),(454,NULL,245,'N130',NULL,1989,1995,1),(455,NULL,245,'N180',NULL,1996,2002,1),(456,NULL,246,NULL,NULL,2001,2009,1),(457,NULL,246,NULL,NULL,1995,2001,1),(458,NULL,247,'J100',NULL,1998,2007,1),(459,NULL,247,'J120',NULL,2002,2009,1),(460,NULL,247,'J150',NULL,2009,NULL,1),(461,NULL,247,'J200',NULL,2007,NULL,1),(462,NULL,247,'J70',NULL,1990,1996,1),(463,NULL,247,'J80',NULL,1995,1997,1),(464,NULL,247,'J90',NULL,1996,2002,1),(465,NULL,248,'R40 R50',NULL,1996,2007,1),(466,NULL,249,'X100',NULL,1996,2000,1),(467,NULL,249,'X110',NULL,2000,2007,1),(468,NULL,249,'X90',NULL,1992,1996,1),(469,NULL,250,'E130',NULL,2003,2008,1),(470,NULL,250,'E140',NULL,2009,2014,1),(471,NULL,251,'XN10',NULL,1998,2003,1),(472,NULL,252,NULL,NULL,2001,2009,1),(473,NULL,252,NULL,NULL,1995,2001,1),(474,NULL,253,'XR10 XR20',NULL,1990,1999,1),(475,NULL,253,'XR30 XR40',NULL,2000,2005,1),(476,NULL,253,'XR50',NULL,2006,NULL,1),(477,NULL,254,'XW10',NULL,1997,2003,1),(478,NULL,254,'XW20',NULL,2003,2009,1),(479,NULL,254,'XW30',NULL,2009,2015,1),(480,NULL,254,'XW40',NULL,2015,NULL,1),(481,NULL,255,'Z10',NULL,1997,2003,1),(482,NULL,256,'XA10',NULL,1997,2000,1),(483,NULL,256,'XA20',NULL,2000,2005,1),(484,NULL,256,'XA30',NULL,2005,2012,1),(485,NULL,256,'XA40',NULL,2012,2018,1),(486,NULL,256,'XA50',NULL,2018,NULL,1),(487,NULL,257,NULL,NULL,2000,2007,1),(488,NULL,257,NULL,NULL,2008,NULL,1),(489,NULL,258,'XL10',NULL,1997,2002,1),(490,NULL,258,'XL20',NULL,2003,2009,1),(491,NULL,258,'XL30',NULL,2010,NULL,1),(492,NULL,259,'E110N',NULL,1997,2001,1),(493,NULL,260,NULL,NULL,2005,2015,1),(494,NULL,260,NULL,NULL,1996,2004,1),(495,NULL,261,'R40 R50',NULL,1996,2007,1),(496,NULL,262,NULL,NULL,2000,2006,1),(497,NULL,262,NULL,NULL,2007,NULL,1),(498,NULL,263,'XP110',NULL,2007,2016,1),(499,NULL,264,'GV10',NULL,2008,2016,1),(500,NULL,265,'V40',NULL,1994,1998,1),(501,NULL,266,'V50',NULL,1998,2003,1),(502,NULL,267,'XV10',NULL,1991,1996,1),(503,NULL,267,'XV20',NULL,1996,2001,1),(504,NULL,268,'XP10',NULL,1999,2005,1),(505,NULL,268,'XP130/XP150',NULL,2011,NULL,1),(506,NULL,268,'XP90',NULL,2005,2013,1),(507,NULL,269,NULL,NULL,1995,NULL,1),(508,NULL,270,NULL,NULL,1998,2005,1),(509,NULL,271,'2KA',NULL,2004,2010,1),(510,NULL,272,'III',NULL,1991,1997,1),(511,NULL,272,'IV',NULL,1997,2004,1),(512,NULL,272,'V',NULL,2003,2009,1),(513,NULL,273,'4',NULL,1998,2005,1),(514,NULL,274,'B3',NULL,1988,1993,1),(515,NULL,274,'B4',NULL,1993,1997,1),(516,NULL,274,'B5',NULL,1996,2005,1),(517,NULL,274,'B6',NULL,2005,2010,1),(518,NULL,275,NULL,NULL,2009,2017,1),(519,NULL,275,NULL,NULL,1997,2009,1),(520,NULL,276,'7M8/7M9/7M6',NULL,1995,2010,1),(521,NULL,277,NULL,NULL,2002,2007,1),(522,NULL,278,'T4',NULL,1990,2003,1),(523,NULL,278,'T5',NULL,2003,NULL,1),(524,NULL,279,NULL,NULL,1992,1998,1),(525,NULL,4,NULL,NULL,1994,2001,1),(526,NULL,7,NULL,NULL,2005,2009,1),(527,NULL,14,NULL,NULL,2006,2018,1),(528,NULL,15,NULL,NULL,2011,NULL,1),(529,NULL,17,NULL,NULL,2006,2012,1),(530,NULL,19,NULL,NULL,2011,NULL,1),(531,NULL,23,NULL,NULL,2013,NULL,1),(532,NULL,24,NULL,NULL,2013,2016,1),(533,NULL,29,NULL,NULL,2000,2006,1),(534,NULL,61,NULL,NULL,2004,NULL,1),(535,NULL,61,NULL,NULL,1996,2004,1),(536,NULL,67,NULL,NULL,1999,2007,1),(537,NULL,77,NULL,NULL,1991,2002,1),(538,NULL,84,NULL,NULL,2008,NULL,1),(539,NULL,92,NULL,NULL,2012,NULL,1),(540,NULL,107,NULL,NULL,1983,1999,1),(541,NULL,117,NULL,NULL,2000,2007,1),(542,NULL,118,'6',NULL,1992,1999,1),(543,NULL,122,NULL,NULL,1984,1996,1),(544,NULL,123,NULL,NULL,1991,1998,1),(545,NULL,124,NULL,NULL,1988,1993,1),(546,NULL,125,NULL,NULL,1993,2000,1),(547,NULL,126,NULL,NULL,2000,2007,1),(548,NULL,127,NULL,NULL,2007,2014,1),(549,NULL,128,NULL,NULL,1996,2002,1),(550,NULL,129,NULL,NULL,2003,2009,1),(551,NULL,130,NULL,NULL,1998,2005,1),(552,NULL,131,NULL,NULL,2005,2013,1),(553,NULL,132,NULL,NULL,1997,NULL,1),(554,NULL,133,NULL,NULL,2002,NULL,1),(555,NULL,154,NULL,NULL,1998,2005,1),(556,NULL,183,NULL,NULL,1993,1999,1),(557,NULL,185,NULL,NULL,1997,2001,1),(558,NULL,201,NULL,NULL,2016,NULL,1),(559,NULL,202,NULL,NULL,2010,2015,1),(560,NULL,202,NULL,NULL,2015,2018,1),(561,NULL,204,NULL,NULL,2013,2017,1),(562,NULL,206,NULL,NULL,2009,2014,1),(563,NULL,207,NULL,NULL,2014,2018,1),(564,NULL,208,NULL,NULL,2000,2007,1),(565,NULL,210,NULL,NULL,2014,NULL,1),(566,NULL,212,NULL,NULL,2019,NULL,1),(567,NULL,216,NULL,NULL,2003,2009,1),(568,NULL,216,NULL,NULL,2009,2014,1),(569,NULL,216,NULL,NULL,2014,NULL,1),(570,NULL,216,NULL,NULL,1993,1999,1),(571,NULL,216,NULL,NULL,1999,2004,1),(572,NULL,218,NULL,NULL,2011,NULL,1),(573,NULL,219,NULL,NULL,2001,2007,1),(574,NULL,221,NULL,NULL,2006,2014,1),(575,NULL,224,NULL,NULL,2007,2009,1),(576,NULL,224,NULL,NULL,1998,2006,1),(577,NULL,246,NULL,NULL,2001,2009,1),(578,NULL,246,NULL,NULL,1995,2001,1),(579,NULL,252,NULL,NULL,2001,2009,1),(580,NULL,252,NULL,NULL,1995,2001,1),(581,NULL,257,NULL,NULL,2000,2007,1),(582,NULL,257,NULL,NULL,2008,NULL,1),(583,NULL,260,NULL,NULL,2005,2015,1),(584,NULL,260,NULL,NULL,1996,2004,1),(585,NULL,262,NULL,NULL,2000,2006,1),(586,NULL,262,NULL,NULL,2007,NULL,1),(587,NULL,269,NULL,NULL,1995,NULL,1),(588,NULL,270,NULL,NULL,1998,2005,1),(589,NULL,275,NULL,NULL,2009,2017,1),(590,NULL,275,NULL,NULL,1997,2009,1),(591,NULL,277,NULL,NULL,2002,2007,1),(592,NULL,279,NULL,NULL,1992,1998,1),(593,NULL,4,NULL,NULL,1994,2001,1),(594,NULL,7,NULL,NULL,2005,2009,1),(595,NULL,14,NULL,NULL,2006,2018,1),(596,NULL,15,NULL,NULL,2011,NULL,1),(597,NULL,17,NULL,NULL,2006,2012,1),(598,NULL,19,NULL,NULL,2011,NULL,1),(599,NULL,23,NULL,NULL,2013,NULL,1),(600,NULL,24,NULL,NULL,2013,2016,1),(601,NULL,29,NULL,NULL,2000,2006,1),(602,NULL,61,NULL,NULL,2004,NULL,1),(603,NULL,61,NULL,NULL,1996,2004,1),(604,NULL,67,NULL,NULL,1999,2007,1),(605,NULL,77,NULL,NULL,1991,2002,1),(606,NULL,84,NULL,NULL,2008,NULL,1),(607,NULL,92,NULL,NULL,2012,NULL,1),(608,NULL,107,NULL,NULL,1983,1999,1),(609,NULL,117,NULL,NULL,2000,2007,1),(610,NULL,118,'6',NULL,1992,1999,1),(611,NULL,122,NULL,NULL,1984,1996,1),(612,NULL,123,NULL,NULL,1991,1998,1),(613,NULL,124,NULL,NULL,1988,1993,1),(614,NULL,125,NULL,NULL,1993,2000,1),(615,NULL,126,NULL,NULL,2000,2007,1),(616,NULL,127,NULL,NULL,2007,2014,1),(617,NULL,128,NULL,NULL,1996,2002,1),(618,NULL,129,NULL,NULL,2003,2009,1),(619,NULL,130,NULL,NULL,1998,2005,1),(620,NULL,131,NULL,NULL,2005,2013,1),(621,NULL,132,NULL,NULL,1997,NULL,1),(622,NULL,133,NULL,NULL,2002,NULL,1),(623,NULL,154,NULL,NULL,1998,2005,1),(624,NULL,183,NULL,NULL,1993,1999,1),(625,NULL,185,NULL,NULL,1997,2001,1),(626,NULL,201,NULL,NULL,2016,NULL,1),(627,NULL,202,NULL,NULL,2010,2015,1),(628,NULL,202,NULL,NULL,2015,2018,1),(629,NULL,204,NULL,NULL,2013,2017,1),(630,NULL,206,NULL,NULL,2009,2014,1),(631,NULL,207,NULL,NULL,2014,2018,1),(632,NULL,208,NULL,NULL,2000,2007,1),(633,NULL,210,NULL,NULL,2014,NULL,1),(634,NULL,212,NULL,NULL,2019,NULL,1),(635,NULL,216,NULL,NULL,2003,2009,1),(636,NULL,216,NULL,NULL,2009,2014,1),(637,NULL,216,NULL,NULL,2014,NULL,1),(638,NULL,216,NULL,NULL,1993,1999,1),(639,NULL,216,NULL,NULL,1999,2004,1),(640,NULL,218,NULL,NULL,2011,NULL,1),(641,NULL,219,NULL,NULL,2001,2007,1),(642,NULL,221,NULL,NULL,2006,2014,1),(643,NULL,224,NULL,NULL,2007,2009,1),(644,NULL,224,NULL,NULL,1998,2006,1),(645,NULL,246,NULL,NULL,2001,2009,1),(646,NULL,246,NULL,NULL,1995,2001,1),(647,NULL,252,NULL,NULL,2001,2009,1),(648,NULL,252,NULL,NULL,1995,2001,1),(649,NULL,257,NULL,NULL,2000,2007,1),(650,NULL,257,NULL,NULL,2008,NULL,1),(651,NULL,260,NULL,NULL,2005,2015,1),(652,NULL,260,NULL,NULL,1996,2004,1),(653,NULL,262,NULL,NULL,2000,2006,1),(654,NULL,262,NULL,NULL,2007,NULL,1),(655,NULL,269,NULL,NULL,1995,NULL,1),(656,NULL,270,NULL,NULL,1998,2005,1),(657,NULL,275,NULL,NULL,2009,2017,1),(658,NULL,275,NULL,NULL,1997,2009,1),(659,NULL,277,NULL,NULL,2002,2007,1),(660,NULL,279,NULL,NULL,1992,1998,1),(661,NULL,4,NULL,NULL,1994,2001,1),(662,NULL,7,NULL,NULL,2005,2009,1),(663,NULL,14,NULL,NULL,2006,2018,1),(664,NULL,15,NULL,NULL,2011,NULL,1),(665,NULL,17,NULL,NULL,2006,2012,1),(666,NULL,19,NULL,NULL,2011,NULL,1),(667,NULL,23,NULL,NULL,2013,NULL,1),(668,NULL,24,NULL,NULL,2013,2016,1),(669,NULL,29,NULL,NULL,2000,2006,1),(670,NULL,61,NULL,NULL,2004,NULL,1),(671,NULL,61,NULL,NULL,1996,2004,1),(672,NULL,67,NULL,NULL,1999,2007,1),(673,NULL,77,NULL,NULL,1991,2002,1),(674,NULL,84,NULL,NULL,2008,NULL,1),(675,NULL,92,NULL,NULL,2012,NULL,1),(676,NULL,107,NULL,NULL,1983,1999,1),(677,NULL,117,NULL,NULL,2000,2007,1),(678,NULL,118,'6',NULL,1992,1999,1),(679,NULL,122,NULL,NULL,1984,1996,1),(680,NULL,123,NULL,NULL,1991,1998,1),(681,NULL,124,NULL,NULL,1988,1993,1),(682,NULL,125,NULL,NULL,1993,2000,1),(683,NULL,126,NULL,NULL,2000,2007,1),(684,NULL,127,NULL,NULL,2007,2014,1),(685,NULL,128,NULL,NULL,1996,2002,1),(686,NULL,129,NULL,NULL,2003,2009,1),(687,NULL,130,NULL,NULL,1998,2005,1),(688,NULL,131,NULL,NULL,2005,2013,1),(689,NULL,132,NULL,NULL,1997,NULL,1),(690,NULL,133,NULL,NULL,2002,NULL,1),(691,NULL,154,NULL,NULL,1998,2005,1),(692,NULL,183,NULL,NULL,1993,1999,1),(693,NULL,185,NULL,NULL,1997,2001,1),(694,NULL,201,NULL,NULL,2016,NULL,1),(695,NULL,202,NULL,NULL,2010,2015,1),(696,NULL,202,NULL,NULL,2015,2018,1),(697,NULL,204,NULL,NULL,2013,2017,1),(698,NULL,206,NULL,NULL,2009,2014,1),(699,NULL,207,NULL,NULL,2014,2018,1),(700,NULL,208,NULL,NULL,2000,2007,1),(701,NULL,210,NULL,NULL,2014,NULL,1),(702,NULL,212,NULL,NULL,2019,NULL,1),(703,NULL,216,NULL,NULL,2003,2009,1),(704,NULL,216,NULL,NULL,2009,2014,1),(705,NULL,216,NULL,NULL,2014,NULL,1),(706,NULL,216,NULL,NULL,1993,1999,1),(707,NULL,216,NULL,NULL,1999,2004,1),(708,NULL,218,NULL,NULL,2011,NULL,1),(709,NULL,219,NULL,NULL,2001,2007,1),(710,NULL,221,NULL,NULL,2006,2014,1),(711,NULL,224,NULL,NULL,2007,2009,1),(712,NULL,224,NULL,NULL,1998,2006,1),(713,NULL,246,NULL,NULL,2001,2009,1),(714,NULL,246,NULL,NULL,1995,2001,1),(715,NULL,252,NULL,NULL,2001,2009,1),(716,NULL,252,NULL,NULL,1995,2001,1),(717,NULL,257,NULL,NULL,2000,2007,1),(718,NULL,257,NULL,NULL,2008,NULL,1),(719,NULL,260,NULL,NULL,2005,2015,1),(720,NULL,260,NULL,NULL,1996,2004,1),(721,NULL,262,NULL,NULL,2000,2006,1),(722,NULL,262,NULL,NULL,2007,NULL,1),(723,NULL,269,NULL,NULL,1995,NULL,1),(724,NULL,270,NULL,NULL,1998,2005,1),(725,NULL,275,NULL,NULL,2009,2017,1),(726,NULL,275,NULL,NULL,1997,2009,1),(727,NULL,277,NULL,NULL,2002,2007,1),(728,NULL,279,NULL,NULL,1992,1998,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Ходовая часть','khodovaya-chast',1,'2019-10-08 13:11:48','2019-11-24 16:39:43'),(2,'Электрическая часть','elektricheskaya-chast',3,'2019-10-08 13:11:53','2019-11-24 16:41:46'),(3,'Кузовная часть','kuzovnaya-chast',2,'2019-10-08 13:12:29','2019-11-24 16:41:05'),(4,'Двигательная часть','dvigatelnaya-chast',3,'2019-11-24 16:42:23','2019-11-24 16:42:23'),(5,'Навесная часть','navesnaya-chast',3,'2019-11-24 16:43:01','2019-11-24 16:43:01'),(6,'Автохимия','avtokhimiya',3,'2019-11-24 16:43:37','2019-11-24 16:43:37');
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
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `marks_cid_unique` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (1,'1','ADAM',NULL,NULL,NULL,1,'adam',0,1,0),(2,'2','AUDI',NULL,NULL,NULL,1,'audi',0,1,0),(3,'3','BMW',NULL,NULL,NULL,1,'bmw',0,1,0),(4,'4','CHEVROLET',NULL,NULL,NULL,1,'chevrolet',0,1,0),(5,'5','DEAWOO',NULL,NULL,NULL,1,'deawoo',0,1,0),(6,'6','FORD',NULL,NULL,NULL,1,'ford',0,1,0),(7,'7','HONDA',NULL,NULL,NULL,1,'honda',0,1,0),(8,'8','HYUNDAI',NULL,NULL,NULL,1,'hyundai',0,1,0),(9,'9','INFINITI',NULL,NULL,NULL,1,'infiniti',0,1,0),(10,'10','ISUZU',NULL,NULL,NULL,1,'isuzu',0,1,0),(11,'11','KIA',NULL,NULL,NULL,1,'kia',0,1,0),(12,'12','LADA',NULL,NULL,NULL,1,'lada',0,1,0),(13,'13','LEXUS',NULL,NULL,NULL,1,'lexus',0,1,0),(14,'14','MAZDA',NULL,NULL,NULL,1,'mazda',0,1,0),(15,'15','MERCEDES BENZ',NULL,NULL,NULL,1,'mercedes-benz',0,1,0),(16,'16','MITSUBISHI',NULL,NULL,NULL,1,'mitsubishi',0,1,0),(17,'17','NISSAN',NULL,NULL,NULL,1,'nissan',0,1,0),(18,'18','OPEL',NULL,NULL,NULL,1,'opel',0,1,0),(19,'19','RENAULT',NULL,NULL,NULL,1,'renault',0,1,0),(20,'20','SKODA',NULL,NULL,NULL,1,'skoda',0,1,0),(21,'21','SUBARU',NULL,NULL,NULL,1,'subaru',0,1,0),(22,'22','SUZUKI',NULL,NULL,NULL,1,'suzuki',0,1,0),(23,'23','TOYOTA',NULL,NULL,NULL,1,'toyota',0,1,0),(24,'24','VAZ',NULL,NULL,NULL,1,'vaz',0,1,0),(25,'25','VOLKSWAGEN',NULL,NULL,NULL,1,'volkswagen',0,1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_07_10_171502_create_admins_table',1),(2,'2019_07_12_204343_create_password_resets_table',1),(3,'2019_07_12_232636_create_pages_table',1),(4,'2019_07_23_000000_create_zakhayko_banners_table',1),(5,'2019_08_14_161704_create_marks_table',1),(6,'2019_08_14_161725_create_models_table',1),(7,'2019_08_14_161756_create_generations_table',1),(8,'2019_08_14_221246_create_countries_table',1),(9,'2019_08_14_221310_create_regions_table',1),(10,'2019_08_19_142314_create_parts_table',1),(11,'2019_08_19_165244_create_brands_table',1),(12,'2019_09_02_210329_create_part_catalogs_table',1),(13,'2019_09_06_194022_create_part_cars_table',1),(14,'2019_09_30_183624_create_home_slider_table',1),(15,'2019_10_02_183143_create_galleries_table',1),(16,'2019_10_06_173451_create_terms_table',1),(17,'2019_10_07_150146_create_news_table',1),(18,'2019_10_08_161153_create_groups_table',1),(19,'2019_10_08_165558_add_group_id_to_part_catalogs_table',1),(20,'2019_10_08_191627_create_filters_table',1),(21,'2019_10_08_193606_create_criteria_table',1),(22,'2019_10_09_144929_create_criterion_part_table',1),(23,'2019_10_11_144259_create_engine_filters_table',1),(24,'2019_10_11_144400_create_engine_criteria_table',1),(25,'2019_10_11_151219_create_users_table',1),(26,'2019_10_22_170311_create_partner_groups_table',2),(27,'2019_10_22_170857_add_partner_group_id_to_users_table',2),(28,'2019_10_22_221136_create_favourites_table',3),(29,'2019_10_22_221849_create_basket_table',4),(30,'2019_10_24_170751_create_engine_criterion_part_table',5),(31,'2019_10_27_202229_create_change_emails_table',6),(32,'2019_11_01_192027_create_delivery_regions_table',7),(33,'2019_11_01_192039_create_delivery_cities_table',7),(34,'2019_11_03_153023_create_orders_table',8),(35,'2019_11_03_153143_create_order_part_table',8),(36,'2019_11_06_154011_create_recommended_parts_table',9),(37,'2019_11_06_154327_create_attached_parts_table',10),(38,'2019_11_08_172715_create_count_sales_table',11),(39,'2019_11_16_185627_create_applications_table',12),(40,'2019_11_17_190442_create_engines_table',13),(41,'2019_11_17_201409_create_engine_part_table',13),(42,'2019_11_18_181003_create_engine_mark_table',13),(43,'2019_11_21_214731_create_restricted_brands_table',14),(44,'2019_11_22_212027_create_pickup_points_table',15),(46,'2019_11_29_145036_create_modifications_table',16),(47,'2019_11_29_222911_create_modification_part_table',17),(49,'2019_11_30_220525_create_price_applications_table',18);
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
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,1,'A14XEL',1),(2,2,'80',1),(3,2,'100',1),(4,2,'A4',1),(5,2,'A6',1),(6,2,'A8',1),(7,2,'Q7',1),(8,3,'3\'',1),(9,3,'5\'',1),(10,3,'7\'',1),(11,3,'X5',1),(12,3,'X6',1),(13,4,'AVEO',1),(14,4,'CAPTIVA',1),(15,4,'COBALT',1),(16,4,'CRUZE',1),(17,4,'EPICA',1),(18,4,'LACETTI',1),(19,4,'MALIBU',1),(20,4,'NUBIRA',1),(21,4,'ORLANDO',1),(22,4,'SPARK',1),(23,4,'TRACKER',1),(24,5,'GENTRA',1),(25,5,'LACETTI',1),(26,5,'LEGANZA',1),(27,5,'MATIZ',1),(28,5,'NEXIA',1),(29,6,'ESCAPE',1),(30,6,'MONDEO',1),(31,7,'ACCORD',1),(32,7,'ACURA',1),(33,7,'CIVIC',1),(34,7,'CR-V',1),(35,7,'ELEMENT',1),(36,7,'FIT',1),(37,7,'HR-V',1),(38,7,'INSPIRE',1),(39,7,'ODYSSEY',1),(40,7,'ORTHIA',1),(41,7,'PILOT',1),(42,7,'PRELUDE',1),(43,7,'SABER',1),(44,7,'SHUTTLE',1),(45,7,'STEPWGN',1),(46,7,'STREAM',1),(47,8,'ACCENT',1),(48,8,'AVANTE',1),(49,8,'CRETA',1),(50,8,'ELANTRA',1),(51,8,'GALLOPER',1),(52,8,'GENESIS',1),(53,8,'GETZ',1),(54,8,'GRAND STAREX',1),(55,8,'GRANDEUR',1),(56,8,'H-1',1),(57,8,'I30',1),(58,8,'I40',1),(59,8,'IX35',1),(60,8,'MATRIX',1),(61,8,'PORTER',1),(62,8,'SANTA FE',1),(63,8,'SOLARIS',1),(64,8,'SONATA',1),(65,8,'STAREX',1),(66,8,'TERRACAN',1),(67,8,'TRAJET',1),(68,8,'TUCSON',1),(69,8,'VELOSTER',1),(70,9,'EX/QX50',1),(71,9,'FX',1),(72,9,'FX/QX70',1),(73,9,'G35',1),(74,9,'I30',1),(75,9,'QX56',1),(76,9,'QX80',1),(77,10,'BIGHORN/TROOPER',1),(78,10,'D-MAX',1),(79,11,'CADENZA',1),(80,11,'CARENS',1),(81,11,'CARNIVAL',1),(82,11,'CEED',1),(83,11,'CERATO',1),(84,11,'MOHAVE',1),(85,11,'MORNING',1),(86,11,'OPTIMA',1),(87,11,'PICANTO',1),(88,11,'RIO',1),(89,11,'SORENTO',1),(90,11,'SOUL',1),(91,11,'SPORTAGE',1),(92,12,'LARGUS',1),(93,13,'460',1),(94,13,'470',1),(95,13,'570',1),(96,13,'ES',1),(97,13,'GS',1),(98,13,'IS',1),(99,13,'LS',1),(100,13,'NX',1),(101,13,'RX',1),(102,14,'3',1),(103,14,'323',1),(104,14,'323F',1),(105,14,'6',1),(106,14,'626',1),(107,14,'BONGO',1),(108,14,'CAPELLA',1),(109,14,'CRONUS',1),(110,14,'CX5',1),(111,14,'CX7',1),(112,14,'CX9',1),(113,14,'DEMIO',1),(114,14,'LANTIS',1),(115,14,'MPV',1),(116,14,'PREMACY',1),(117,14,'TRIBUTE',1),(118,14,'XEDOS',1),(119,15,'ML',1),(120,15,'SPRINTER',1),(121,15,'V-CLASS',1),(122,15,'W124',1),(123,15,'W140',1),(124,15,'W201',1),(125,15,'W202',1),(126,15,'W203',1),(127,15,'W204',1),(128,15,'W210',1),(129,15,'W211',1),(130,15,'W220',1),(131,15,'W221',1),(132,15,'W461',1),(133,15,'W463',1),(134,16,'AIRTREK',1),(135,16,'ASX',1),(136,16,'CARISMA',1),(137,16,'CHALLENGER',1),(138,16,'DELICA',1),(139,16,'DIAMANTE',1),(140,16,'ECLIPSE',1),(141,16,'GALANT',1),(142,16,'GRANDIS',1),(143,16,'L200',1),(144,16,'LANCER',1),(145,16,'LEGNUM',1),(146,16,'MONTERA SPORT',1),(147,16,'OUTLANDER',1),(148,16,'PAJERO',1),(149,16,'PAJERO SPORT',1),(150,16,'RVR',1),(151,16,'SIGMA',1),(152,16,'SPACE GEAR',1),(153,16,'SPACE RUNNER',1),(154,16,'SPACE STAR',1),(155,16,'SPACE WAGON',1),(156,17,'ALMERA',1),(157,17,'ALMERA TINO',1),(158,17,'ALTIMA',1),(159,17,'ARMADA',1),(160,17,'BLUEBIRD',1),(161,17,'CEDRIC',1),(162,17,'CEFIRO',1),(163,17,'CUBE',1),(164,17,'ELGRAND',1),(165,17,'JUKE',1),(166,17,'LARGO',1),(167,17,'LIBERTY',1),(168,17,'MARCH',1),(169,17,'MAXIMA',1),(170,17,'MICRA',1),(171,17,'MISTRAL',1),(172,17,'MURANO',1),(173,17,'NAVARA',1),(174,17,'NOTE',1),(175,17,'NP300',1),(176,17,'PATHFINDER',1),(177,17,'PATROL',1),(178,17,'PRAIRIE',1),(179,17,'PRESAGE',1),(180,17,'PRIMERA',1),(181,17,'PULSAR',1),(182,17,'QASHQAI',1),(183,17,'QUEST',1),(184,17,'QX4',1),(185,17,'R\'NESSA',1),(186,17,'SENTRA',1),(187,17,'SERENA',1),(188,17,'SKYLINE',1),(189,17,'SUNNY',1),(190,17,'TEANA',1),(191,17,'TERRANO',1),(192,17,'TIIDA',1),(193,17,'VANETTE',1),(194,17,'XTERRA',1),(195,17,'X-TRAIL',1),(196,18,'ASTRA',1),(197,18,'FRONTERA',1),(198,18,'OMEGA',1),(199,18,'VECTRA',1),(200,18,'ZAFIRA',1),(201,19,'CAPTUR',1),(202,19,'DUSTER',1),(203,19,'KANGOO',1),(204,19,'LOGAN',1),(205,19,'MEGANE',1),(206,19,'SANDERO',1),(207,19,'SANDERO STEPWAY',1),(208,20,'FABIA',1),(209,20,'OCTAVIA',1),(210,20,'SUPERB',1),(211,20,'YETI',1),(212,21,'ASCENT',1),(213,21,'FORESTER',1),(214,21,'IMPREZZA',1),(215,21,'LEGACY',1),(216,21,'OUTBACK',1),(217,21,'TRIBECA',1),(218,21,'XV',1),(219,22,'LIANA',1),(220,22,'SWIFT',1),(221,22,'SX4',1),(222,22,'VITARA/ESCUDO',1),(223,22,'VITARA GRAND',1),(224,22,'XL-7',1),(225,23,'4RUNNER',1),(226,23,'ALTEZZA',1),(227,23,'ARISTO',1),(228,23,'AVALON',1),(229,23,'AVANZA',1),(230,23,'AVENSIS',1),(231,23,'CALDINA',1),(232,23,'CAMRY',1),(233,23,'CARINA',1),(234,23,'CELICA',1),(235,23,'CHASER',1),(236,23,'COROLLA',1),(237,23,'ESTIMA',1),(238,23,'EXIV',1),(239,23,'FJ CRUISER',1),(240,23,'FORTUNER',1),(241,23,'HARRIER',1),(242,23,'HIACE',1),(243,23,'HIGHLANDER',1),(244,23,'HILUX',1),(245,23,'HILUX SURF',1),(246,23,'IPSUM',1),(247,23,'LAND CRUISER',1),(248,23,'LITE ACE',1),(249,23,'MARK II',1),(250,23,'MATRIX',1),(251,23,'NADIA',1),(252,23,'PICNIC',1),(253,23,'PREVIA',1),(254,23,'PRIUS',1),(255,23,'RAUM',1),(256,23,'RAV-4',1),(257,23,'SEQUOIA',1),(258,23,'SIENNA',1),(259,23,'SPACIO',1),(260,23,'TACOMA',1),(261,23,'TOWNACE',1),(262,23,'TUNDRA',1),(263,23,'URBAN CRUISER',1),(264,23,'VENZA',1),(265,23,'VISTA',1),(266,23,'VISTA ARDEO',1),(267,23,'WINDOM',1),(268,23,'YARIS',1),(269,24,'2116',1),(270,25,'BORA',1),(271,25,'CADDY',1),(272,25,'GOLF',1),(273,25,'JETTA',1),(274,25,'PASSAT',1),(275,25,'POLO',1),(276,25,'SHARAN',1),(277,25,'TOUAREG',1),(278,25,'TRANSPORTER',1),(279,25,'VENTO',1);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modification_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modification_part` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `modification_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modification_part_modification_id_foreign` (`modification_id`),
  KEY `modification_part_part_id_foreign` (`part_id`),
  CONSTRAINT `modification_part_modification_id_foreign` FOREIGN KEY (`modification_id`) REFERENCES `modifications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `modification_part_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modification_part` WRITE;
/*!40000 ALTER TABLE `modification_part` DISABLE KEYS */;
INSERT INTO `modification_part` VALUES (1,405,1),(2,407,1);
/*!40000 ALTER TABLE `modification_part` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `modifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `generation_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modifications_cid_unique` (`cid`),
  KEY `modifications_generation_id_foreign` (`generation_id`),
  CONSTRAINT `modifications_generation_id_foreign` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2097 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modifications` WRITE;
/*!40000 ALTER TABLE `modifications` DISABLE KEYS */;
INSERT INTO `modifications` VALUES (1,1022737,1),(2,1022686,2),(3,1022687,3),(4,1022688,4),(5,1022685,5),(6,1022641,661),(7,1022684,7),(8,1022642,8),(9,1022690,9),(10,1022694,10),(11,1022689,11),(12,1022691,12),(13,1022701,662),(14,1022673,14),(15,1022609,15),(16,1022674,16),(17,1022675,17),(18,1022640,18),(19,1022671,19),(20,1022692,20),(21,1022672,21),(22,1022693,22),(23,1022676,23),(24,1022678,24),(25,1022706,25),(26,1020906,26),(27,1020907,27),(28,1020908,663),(29,1020915,664),(30,1020909,30),(31,1020910,665),(32,1022725,32),(33,1020911,666),(34,1022707,34),(35,1022724,35),(36,1020912,36),(37,1022662,37),(38,1020913,38),(39,1020914,667),(40,1020900,668),(41,1020902,41),(42,1022730,42),(43,1022639,43),(44,1020904,44),(45,1020905,45),(46,1022703,669),(47,1022708,47),(48,1022699,48),(49,1020771,49),(50,1020772,50),(51,1020773,51),(52,1020775,52),(53,1020774,53),(54,1022705,54),(55,1020781,55),(56,1020782,56),(57,1020784,57),(58,1020783,58),(59,1022739,59),(60,1020776,60),(61,1020777,61),(62,1020778,62),(63,1020779,63),(64,1020780,64),(65,1022534,65),(66,1020791,66),(67,1020792,67),(68,1020793,68),(69,1020867,69),(70,1020866,70),(71,1020864,71),(72,1020865,72),(73,1022726,73),(74,1020794,74),(75,1020789,75),(76,1020790,76),(77,1022728,77),(78,1020863,78),(79,1020868,79),(80,1020860,80),(81,1020861,81),(82,1020862,82),(83,1020785,83),(84,1020786,84),(85,1020787,85),(86,1020788,86),(87,1022535,87),(88,1020734,88),(89,1020733,89),(90,1020850,90),(91,1020759,91),(92,1020738,92),(93,1020735,93),(94,1020736,94),(95,1022719,95),(96,1020744,96),(97,1020851,97),(98,1022600,98),(99,1020762,99),(100,1022723,100),(101,1020854,101),(102,1020852,102),(103,1020853,103),(104,1022586,104),(105,1020761,105),(106,1020758,670),(107,1020757,671),(108,1020749,108),(109,1020750,109),(110,1020751,110),(111,1020748,111),(112,1020753,112),(113,1020752,113),(114,1020740,114),(115,1020743,115),(116,1020741,116),(117,1020739,117),(118,1020742,118),(119,1020760,119),(120,1020754,120),(121,1020755,672),(122,1020745,122),(123,1020746,123),(124,1020747,124),(125,1020756,125),(126,1022597,126),(127,1022593,127),(128,1022594,128),(129,1022595,129),(130,1022540,130),(131,1022592,131),(132,1022738,132),(133,1022740,673),(134,1022741,134),(135,1020704,135),(136,1020705,136),(137,1020708,137),(138,1020706,138),(139,1020707,139),(140,1020709,140),(141,1020710,141),(142,1020711,142),(143,1020712,143),(144,1020713,144),(145,1020714,145),(146,1020715,146),(147,1020716,147),(148,1020719,674),(149,1022598,149),(150,1022599,150),(151,1020718,151),(152,1020717,152),(153,1020721,153),(154,1020720,154),(155,1020722,155),(156,1020723,156),(157,1020724,157),(158,1020726,158),(159,1020725,159),(160,1020727,160),(161,1020728,161),(162,1020731,162),(163,1020730,163),(164,1020729,164),(165,1020916,675),(166,1022507,166),(167,1022548,167),(168,1022549,168),(169,1022547,169),(170,1020660,170),(171,1020661,171),(172,1020662,172),(173,1020663,173),(174,1020664,174),(175,1022700,175),(176,1020624,176),(177,1020621,177),(178,1020622,178),(179,1020623,179),(180,1020618,180),(181,1020619,181),(182,1020620,182),(183,1020673,183),(184,1020674,184),(185,1020675,185),(186,1022495,186),(187,1020680,187),(188,1020681,188),(189,1020678,189),(190,1020679,190),(191,1020795,191),(192,1020796,192),(193,1020797,193),(194,1020801,194),(195,1020802,195),(196,1020804,196),(197,1022555,197),(198,1020798,198),(199,1020799,199),(200,1020800,200),(201,1020805,201),(202,1020806,202),(203,1020807,203),(204,1022562,676),(205,1022490,205),(206,1022563,206),(207,1022557,207),(208,1022558,208),(209,1022559,209),(210,1022560,210),(211,1022561,211),(212,1020808,212),(213,1020809,213),(214,1020803,214),(215,1020810,215),(216,1020812,216),(217,1020811,217),(218,1022587,218),(219,1022556,677),(220,1020813,678),(221,1020814,221),(222,1022650,222),(223,1022657,223),(224,1022647,224),(225,1022658,225),(226,1022648,226),(227,1022660,227),(228,1022651,679),(229,1022653,680),(230,1022655,681),(231,1022649,682),(232,1022659,683),(233,1022669,684),(234,1022645,685),(235,1022661,686),(236,1022654,687),(237,1022656,688),(238,1022646,689),(239,1022652,690),(240,1020930,240),(241,1022579,241),(242,1020878,242),(243,1020928,243),(244,1020879,244),(245,1020880,245),(246,1020917,246),(247,1020918,247),(248,1020884,248),(249,1020881,249),(250,1020882,250),(251,1020883,251),(252,1022729,252),(253,1022580,253),(254,1022571,254),(255,1022570,255),(256,1022576,256),(257,1022569,257),(258,1022486,258),(259,1022575,259),(260,1020927,260),(261,1020890,261),(262,1020891,262),(263,1020892,263),(264,1020893,264),(265,1020894,265),(266,1020924,266),(267,1020926,267),(268,1020925,268),(269,1020922,269),(270,1020923,270),(271,1020919,271),(272,1022572,272),(273,1020929,273),(274,1022577,274),(275,1022573,275),(276,1022574,276),(277,1022578,691),(278,1020920,278),(279,1020921,279),(280,1022511,280),(281,1020815,281),(282,1020816,282),(283,1022512,283),(284,1020817,284),(285,1020818,285),(286,1020819,286),(287,1022515,287),(288,1022528,288),(289,1022667,289),(290,1022489,290),(291,1022485,291),(292,1022529,292),(293,1022516,293),(294,1022514,294),(295,1022517,295),(296,1020840,296),(297,1022526,297),(298,1022532,298),(299,1020869,299),(300,1020870,300),(301,1020871,301),(302,1020872,302),(303,1020839,303),(304,1022523,304),(305,1022524,305),(306,1022525,306),(307,1020820,307),(308,1020821,308),(309,1020822,309),(310,1022538,310),(311,1022527,311),(312,1022536,312),(313,1022664,313),(314,1022537,314),(315,1020823,315),(316,1020824,316),(317,1020825,317),(318,1020826,318),(319,1020827,319),(320,1020828,320),(321,1022531,321),(322,1022519,322),(323,1020873,323),(324,1020874,324),(325,1020875,325),(326,1022521,326),(327,1022488,327),(328,1022513,328),(329,1022665,692),(330,1022487,330),(331,1022539,693),(332,1022668,332),(333,1022522,333),(334,1022518,334),(335,1020829,335),(336,1020830,336),(337,1022520,337),(338,1022663,338),(339,1020831,339),(340,1020832,340),(341,1020833,341),(342,1022541,342),(343,1022666,343),(344,1020834,344),(345,1020835,345),(346,1022530,346),(347,1022670,347),(348,1022585,348),(349,1020836,349),(350,1020837,350),(351,1020838,351),(352,1022734,352),(353,1022732,353),(354,1022720,354),(355,1022735,355),(356,1022736,356),(357,1022731,357),(358,1022733,358),(359,1022588,694),(360,1020895,695),(361,1020896,696),(362,1022589,362),(363,1020897,697),(364,1022590,364),(365,1020898,698),(366,1022591,699),(367,1022713,700),(368,1022714,368),(369,1022716,369),(370,1022717,370),(371,1022742,701),(372,1022710,372),(373,1022718,373),(374,1022715,702),(375,1020763,375),(376,1020764,376),(377,1020765,377),(378,1020766,378),(379,1020769,379),(380,1022583,380),(381,1022582,381),(382,1020767,382),(383,1020859,383),(384,1020855,384),(385,1022581,385),(386,1020857,386),(387,1020858,387),(388,1020856,388),(389,1022552,703),(390,1022553,704),(391,1022554,705),(392,1022550,706),(393,1022551,707),(394,1020770,394),(395,1022584,708),(396,1020877,709),(397,1022568,397),(398,1022565,710),(399,1022567,399),(400,1020876,400),(401,1022566,401),(402,1022634,711),(403,1022564,712),(404,1020614,404),(405,1020615,405),(406,1020616,406),(407,1020617,407),(408,1022492,408),(409,1022508,409),(410,1022509,410),(411,1020634,411),(412,1020635,412),(413,1020636,413),(414,1020637,414),(415,1020638,415),(416,1022695,416),(417,1020627,417),(418,1020628,418),(419,1020629,419),(420,1020684,420),(421,1020685,421),(422,1022605,422),(423,1020639,423),(424,1020640,424),(425,1020641,425),(426,1020642,426),(427,1020643,427),(428,1020644,428),(429,1020625,429),(430,1020931,430),(431,1020626,431),(432,1020841,432),(433,1020687,433),(434,1020686,434),(435,1020630,435),(436,1020631,436),(437,1020632,437),(438,1020633,438),(439,1020842,439),(440,1020843,440),(441,1022542,441),(442,1022502,442),(443,1022721,443),(444,1020844,444),(445,1020700,445),(446,1020645,446),(447,1020646,447),(448,1020647,448),(449,1020648,449),(450,1020649,450),(451,1020691,451),(452,1020698,452),(453,1020694,453),(454,1022500,454),(455,1022501,455),(456,1022484,713),(457,1022498,714),(458,1020683,458),(459,1020653,459),(460,1020654,460),(461,1020652,461),(462,1020651,462),(463,1020682,463),(464,1020650,464),(465,1022603,465),(466,1020689,466),(467,1020690,467),(468,1020688,468),(469,1020669,469),(470,1020670,470),(471,1022506,471),(472,1022483,715),(473,1022499,716),(474,1022543,474),(475,1022545,475),(476,1020845,476),(477,1020665,477),(478,1020666,478),(479,1020667,479),(480,1020668,480),(481,1022505,481),(482,1020655,482),(483,1020656,483),(484,1020657,484),(485,1020658,485),(486,1020659,486),(487,1022503,717),(488,1022504,718),(489,1020701,489),(490,1020702,490),(491,1020703,491),(492,1022510,492),(493,1020848,719),(494,1020849,720),(495,1022604,495),(496,1020846,721),(497,1020847,722),(498,1022497,498),(499,1022496,499),(500,1022601,500),(501,1022602,501),(502,1022493,502),(503,1022494,503),(504,1020671,504),(505,1020676,505),(506,1020672,506),(507,1022722,723),(508,1022644,724),(509,1022681,509),(510,1022637,510),(511,1022643,511),(512,1022679,512),(513,1022680,513),(514,1022635,514),(515,1022636,515),(516,1022638,516),(517,1022697,517),(518,1022696,725),(519,1022698,726),(520,1022704,520),(521,1022702,727),(522,1022712,522),(523,1022709,523),(524,1022711,728);
/*!40000 ALTER TABLE `modifications` ENABLE KEYS */;
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
DROP TABLE IF EXISTS `order_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_part` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `price` double(8,2) unsigned NOT NULL,
  `real_price` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sum` double(8,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_part_order_id_foreign` (`order_id`),
  CONSTRAINT `order_part_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_part` WRITE;
/*!40000 ALTER TABLE `order_part` DISABLE KEYS */;
INSERT INTO `order_part` VALUES (1,1,14,3,1.00,NULL,'Крестовино TO SXV20 97-01 KRESXV97','156',3.00),(2,1,8,100,1000.00,1200,'Test','2',80000.00),(3,2,8,100,1000.00,1200,'Test','2',80000.00),(4,3,6,4,8500.00,NULL,'Test','5100',34000.00),(5,3,43,1,1.00,NULL,'Натяжитель цепи ГРМ TO COROLLA 1ZZ 3ZZ 01-','748',1.00),(6,4,10,18,1300.00,NULL,'Test','94122',23400.00),(7,5,10,30,1300.00,NULL,'Test','94122',39000.00),(8,6,10,31,1300.00,NULL,'Test','94122',40300.00),(9,7,10,35,1300.00,NULL,'Test','94122',45500.00),(10,7,7,1,6500.00,NULL,'Test','5',6500.00),(11,7,42,3,1.00,NULL,'Натяжитель цепи ГРМ NI PATROL Y61 ZD30 3.0 97-','747',3.00),(12,8,10,17,1300.00,NULL,'Test','94122',22100.00),(13,9,40,6,500.00,NULL,'Натяжитель цепи ГРМ NI A32 A33 VQ20 VQ25 VQ30 PATHFINDER VQ35 01-','744',3000.00),(14,9,9,7,9500.00,NULL,'Test','3',66500.00),(15,9,7,5,6500.00,NULL,'Test','5',26975.00),(16,10,14,13,1.00,NULL,'Крестовино TO SXV20 97-01 KRESXV97','156',13.00),(17,10,15,16,1.00,NULL,'Рулевая рейка оригинал HO CR-V 97-01 HOCV97  53601-S10-A01','158',16.00),(18,10,10,12,45000.00,48500,'Бампер задний 2008-2014','94122',540000.00),(19,10,75,100,4500.00,NULL,'колодки тормозные','A2N104',450000.00),(20,10,7,3,6500.00,NULL,'Test','5',19500.00);
/*!40000 ALTER TABLE `order_part` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(10) unsigned DEFAULT NULL,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_point_id` int(10) unsigned DEFAULT NULL,
  `pickup_point_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `real_sum` double(8,2) unsigned NOT NULL,
  `sum` double(8,2) unsigned NOT NULL DEFAULT '0.00',
  `delivery_price` int(10) unsigned NOT NULL DEFAULT '0',
  `total` double(8,2) unsigned NOT NULL DEFAULT '0.00',
  `payment_method` enum('cash','bank') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `paid_request` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `process` tinyint(4) NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `sale` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'Айк','8182843009',1,'11634 VICTORY BLVD UNIT 1 NORTH',4,'Region1',3,'City 1',NULL,NULL,80003.00,80001.50,1000,81001.50,'cash',0,2,3,1,50,'2019-11-14 13:02:30','2019-11-24 15:37:28'),(2,1,'Айк','+374553256655',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,80000.00,80000.00,0,80000.00,'cash',0,2,3,1,50,'2019-11-15 19:07:50','2019-11-16 12:36:13'),(3,1,'Hayk Zakaryan','+374553256655',1,'54th house',4,'Region1',3,'City 1',NULL,NULL,34001.00,17000.50,1000,18000.50,'cash',0,-1,0,0,0,'2019-11-22 11:15:21','2019-11-24 15:37:39'),(4,1,'Hayk Zakaryan','+374553256655',1,'54th house',4,'Region1',3,'City 1',NULL,NULL,23400.00,11700.00,1000,12700.00,'cash',0,0,0,0,0,'2019-11-22 11:18:25','2019-11-22 11:18:25'),(5,1,'Hayk Zakaryan','+374553256655',1,'54th house',4,'Region1',3,'City 1',NULL,NULL,39000.00,19500.00,1000,20500.00,'cash',0,2,3,1,0,'2019-11-22 11:20:02','2019-11-24 14:56:30'),(6,1,'Hayk Zakaryan','+374553256655',1,'54th house',4,'Region1',4,'City 2',NULL,NULL,40300.00,20150.00,2000,22150.00,'cash',0,2,3,1,0,'2019-11-22 12:27:24','2019-11-22 12:31:07'),(7,1,'Айк','+374553256655',0,NULL,NULL,NULL,NULL,NULL,3,'54th house',52003.00,26001.50,0,26001.50,'bank',1,2,3,1,0,'2019-11-23 11:02:37','2019-11-23 14:28:02'),(8,2,'Test','+444444444',0,NULL,NULL,NULL,NULL,NULL,3,'54th house',22100.00,22100.00,0,22100.00,'bank',0,1,0,0,0,'2019-11-24 15:25:24','2019-11-26 15:18:37'),(9,1,'Айк','+374553256655',1,'yukuki',5,'Region 2',6,'City 4',NULL,NULL,96475.00,61725.00,5000,66725.00,'bank',0,2,3,1,0,'2019-11-25 08:48:21','2019-11-25 08:51:43'),(10,1,'Айк','8182843009',1,'11634 VICTORY BLVD UNIT 1 NORTH',4,'Region1',3,'City 1',NULL,NULL,999999.99,999999.99,1000,999999.99,'bank',1,1,2,1,0,'2019-11-27 09:11:04','2019-11-27 09:12:14');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
INSERT INTO `pages` VALUES (1,'home','Главная','home',NULL,NULL,NULL,0,NULL,1,0,1,1,'Bauten.org',NULL,NULL,'2019-10-04 16:49:11','2019-11-07 11:13:23'),(2,'store','Интернет магазин','catalogs',NULL,NULL,NULL,1,NULL,1,0,1,2,NULL,NULL,NULL,'2019-10-04 16:49:11','2019-10-07 14:39:09'),(3,'marks','Марки','marks',NULL,NULL,NULL,1,NULL,1,0,1,3,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(4,'brands','Бренды','brands',NULL,NULL,NULL,1,NULL,1,0,1,4,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(5,'terms','Условия','terms',NULL,NULL,NULL,1,NULL,1,1,1,5,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 18:11:41'),(6,'contacts','Контакты','contacts',NULL,NULL,NULL,1,NULL,1,0,1,8,NULL,NULL,NULL,'2019-10-05 12:38:09','2019-10-07 11:00:19'),(7,'news','Новости','news',NULL,NULL,NULL,1,NULL,1,0,1,7,NULL,NULL,NULL,NULL,'2019-10-07 12:15:38'),(8,'about','О компании',NULL,'kwEXA6FGegF0R9uSbi.jpg','Alt','Title',1,'<p>Группа компаний&nbsp;<strong>&laquo;BAUTEN&raquo;</strong>&nbsp;является динамично и стабильно развивающейся компанией, которая осуществляет продажу автозапчастей и комплектующих к автомобилям оптом и в розницу на рынке&nbsp;<strong>Казахстана</strong>&nbsp;более&nbsp;<strong>10 лет</strong>. Осуществляя свою деятельность, мы стараемся вбирать в себя только самые лучшие тенденции, тем самым демонстрируя вам, нашим конечным потребителям только качественные товары и услуги по комплексному ремонту&nbsp;<strong>вашего автомобиля</strong>. Сегодня, у нас в наличие&nbsp;<strong>более 15`000 тысяч наименований автозапчастей</strong>&nbsp;на автомобили Японии, стран Европы, Азии.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Каждый автовладелец знает на своем опыте, что порой бывает не просто найти комплектующие детали для ремонта. Автомобильные мастерские не всегда располагают складом, и цены там к тому же обычно завышены. Приходится тратить немало времени на поиск нужных деталей в магазинах и на авторынках, которые не всегда могут быть качественными. Нашей основной целью является обеспечить высококачественными запасными частями для автомобилей по&nbsp;<strong>доступным ценам.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Сотрудничая с нами, вы можете выбрать наиболее удобный вариант доставки либо самостоятельно забрать товар со склада. Мы всегда идем навстречу нашим клиентам, поэтому готовы рассмотреть ваши предложения по вариантам доставки заказа в ваш регион. Индивидуальный подход позволяет нам предлагать каждому покупателю именно тот ассортимент, который ему необходим. Благодаря высокому профессионализму сотрудников и ответственному подходу к работе, мы поставляем нашим клиентам только качественные детали и строго соблюдаем обязательства по логистике.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<hr />\r\n<p>Работать с нами не только&nbsp;<strong>УДОБНО</strong>, но и&nbsp;<strong>ВЫГОДНО!</strong></p>',1,0,1,6,NULL,NULL,NULL,'2019-10-07 10:56:05','2019-11-26 06:46:12'),(9,'public-offer','Публичная оферта',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:13:24','2019-10-07 18:16:27'),(10,'confidentiality','Конфиденциальность',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:16:03','2019-10-07 18:16:33'),(11,'payment-and-delivery','Оплата и доставка',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:16:52','2019-10-07 18:17:14'),(12,'for-corporative-clients','Корпоративным клиентам',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:18:00','2019-10-07 18:19:02'),(13,'loyalty-program','Программа лояльности',NULL,NULL,NULL,NULL,1,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:18:52','2019-10-07 18:18:52'),(14,'jobs','Вакансии',NULL,'TZdOFLrPZ5yQvm8hyb.jpg',NULL,NULL,0,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget varius augue. Curabitur condimentum ligula lectus, sit amet suscipit lorem pretium in. Aenean vestibulum, neque vel venenatis fringilla, ipsum eros dignissim sapien, vitae luctus dolor ligula non nisl. Suspendisse id imperdiet neque. In nec faucibus orci. Fusce tempor suscipit commodo. Integer nec ex eros. Fusce interdum augue in fermentum sodales. Nulla eget mauris in leo accumsan ullamcorper quis pretium magna. Sed a tempus nisi. Cras sit amet sagittis enim, suscipit tincidunt sapien.</p>\r\n\r\n<p>Sed sollicitudin posuere tortor in accumsan. Morbi tincidunt turpis ut condimentum auctor. Maecenas mollis ut lacus semper hendrerit. Nunc et congue arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. In lacinia facilisis varius. Proin hendrerit tellus id elit suscipit dapibus. Fusce vulputate, ipsum eget consectetur fringilla, odio nunc sollicitudin lectus, suscipit ultricies ante leo non massa. Nunc id pulvinar est. Aliquam accumsan congue erat lobortis fringilla. Cras faucibus id sem id posuere. Praesent ullamcorper, arcu at bibendum laoreet, velit purus eleifend dui, ut efficitur ipsum sapien non sem. Duis nec quam dui. Integer in nulla bibendum, gravida metus eu, dapibus tellus.</p>\r\n\r\n<p>Vestibulum aliquet diam sed enim scelerisque sagittis. Nunc id orci et enim rhoncus gravida vel in nibh. Nunc lectus urna, volutpat sed lobortis id, hendrerit vel purus. Ut at tortor iaculis, consequat nisl sed, fringilla mi. Mauris a fringilla mauris. Nullam finibus sagittis tincidunt. Nullam vulputate interdum suscipit. Vestibulum quis ante ut magna pulvinar auctor non in neque. Proin eget eros eu sem laoreet aliquet pellentesque ac ipsum. Sed quis elit augue.</p>\r\n\r\n<p>Integer accumsan, ligula ac maximus rhoncus, leo sapien ornare ante, nec tincidunt sem metus at neque. Aenean non turpis ac tortor varius pulvinar a et metus. Donec ac tincidunt metus. Fusce ut mauris eu tortor varius tempor non id augue. Suspendisse hendrerit erat at felis dictum, eget blandit diam consequat. Nulla id justo interdum, sodales velit ut, sodales nisi. Nulla fermentum ligula et dui interdum aliquet. Cras porttitor hendrerit leo, et convallis erat. Fusce at malesuada metus. Donec ullamcorper maximus imperdiet. Donec euismod, nisl vitae euismod convallis, ipsum arcu faucibus libero, id suscipit quam lacus ut augue. Mauris nec commodo leo. Nunc feugiat felis ut elementum aliquet. Nam in massa eget velit venenatis mollis. Nulla facilisi.</p>\r\n\r\n<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla quis dignissim nulla, id aliquet metus. Aenean et eros ut neque posuere commodo. Morbi ligula dolor, interdum in ligula ac, feugiat mollis erat. Maecenas nisi justo, semper sed arcu non, auctor lobortis ipsum. Cras semper interdum quam imperdiet lobortis. Nunc imperdiet quam vitae iaculis rutrum.</p>',0,1,1,8,NULL,NULL,NULL,'2019-10-07 18:19:32','2019-10-07 18:26:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
  `cid` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_home` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part_catalogs_cid_unique` (`cid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=498 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_catalogs` WRITE;
/*!40000 ALTER TABLE `part_catalogs` DISABLE KEYS */;
INSERT INTO `part_catalogs` VALUES (4,'4','Втулки балансировочного вала',4,'vtulki-balansirovochnogo-vala','9VBa7s6yHD7sUwpLrR.png',NULL,'1',NULL,162,'2019-10-07 18:41:16','2019-11-24 18:11:02'),(5,'5','Полукольца упорные',4,'polukoltsa-upornye','eTEqO7stV9xI0qthHE.png',NULL,'1',NULL,142,'2019-10-07 18:41:50','2019-11-24 18:11:02'),(6,'1','Вкладыши коренные',4,'vkladyshi-korennye','0EohB4wCR5TSsih1Eh.png',NULL,'1',NULL,139,'2019-10-07 18:42:01','2019-11-24 18:11:02'),(7,'7','Втулки шатуна',4,'vtulki-shatuna','j61YUR3R5ear6bsSZ4.png',NULL,'1',NULL,160,'2019-10-07 18:42:13','2019-11-24 18:11:02'),(8,'8','Натяжитель цепи ГРМ',4,'natyazhitel-tsepi-grm','jpGKULOG3YogIUpg2w.png',NULL,'1',NULL,150,'2019-10-07 18:52:07','2019-11-24 18:11:02'),(9,'9','Цепь привода распредвала',4,'tsep-privoda-raspredvala','GaxRfJt2hZvEn04JXT.png',NULL,'1',NULL,167,'2019-10-07 18:52:22','2019-11-24 18:11:02'),(10,'10','Свеча накаливания',4,'svecha-nakalivaniya','FH7cX9ngr78FrmymwO.png',NULL,'1',NULL,144,'2019-10-07 18:52:44','2019-11-24 18:11:02'),(11,'11','Ролик натяжителя ремня ГРМ',4,'rolik-natyazhitelya-remnya-grm','GlMShV93KyOLSNwtlE.png',NULL,'1',NULL,140,'2019-10-07 18:53:01','2019-11-24 18:11:02'),(13,'13','Помпа',4,'pompa',NULL,NULL,NULL,NULL,155,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(14,'14','Вал коленчатый',4,'val-kolenchatyy',NULL,NULL,NULL,NULL,146,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(16,'16','Вентилятор осевой радиатор охлаждения двигателя',4,'ventilyator-osevoy-radiator-okhlazhdeniya-dvigatelya',NULL,NULL,NULL,NULL,148,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(17,'17','Цепь ГРМ комплект',4,'tsep-grm-komplekt',NULL,NULL,NULL,NULL,147,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(20,'20','Ремень поликлиновый',4,'remen-poliklinovyy',NULL,NULL,NULL,NULL,149,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(21,'21','Ремень клиновой',4,'remen-klinovoy',NULL,NULL,NULL,NULL,157,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(22,'22','Свечные провода',2,'svechnye-provoda',NULL,NULL,NULL,NULL,154,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(23,'23','Свечи зажигания',2,'svechi-zazhiganiya',NULL,NULL,NULL,NULL,152,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(24,'24','Поршень',4,'porshen',NULL,NULL,NULL,NULL,164,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(25,'25','Гильза (комплект)',4,'gilza-komplekt',NULL,NULL,NULL,NULL,159,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(26,'26','Ремкомплект',4,'remkomplekt',NULL,NULL,NULL,NULL,163,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(28,'28','Прокладка ГБЦ',4,'prokladka-gbts',NULL,NULL,NULL,NULL,156,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(29,'29','Головка блока',5,'golovka-bloka',NULL,NULL,NULL,NULL,141,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(30,'30','Рулевая рейка',5,'rulevaya-reyka',NULL,NULL,NULL,NULL,143,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(31,'31','Амортизатор',1,'amortizator',NULL,NULL,'1',NULL,153,'2019-10-25 16:47:08','2019-11-29 06:47:36'),(33,'33','Датчик включения стоп-сигнала',2,'datchik-vklyucheniya-stop-signala',NULL,NULL,NULL,NULL,151,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(34,'34','Датчик давления масла',2,'datchik-davleniya-masla',NULL,NULL,NULL,NULL,165,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(35,'35','Датчик детонаций',2,'datchik-detonatsiy',NULL,NULL,NULL,NULL,166,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(36,'36','Датчик скорости',2,'datchik-skorosti',NULL,NULL,NULL,NULL,158,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(37,'37','Датчик спидометра',2,'datchik-spidometra',NULL,NULL,NULL,NULL,145,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(39,'39','Датчик холостого хода',2,'datchik-kholostogo-khoda',NULL,NULL,NULL,NULL,161,'2019-10-25 16:47:08','2019-11-24 18:11:02'),(40,'0','Кольца поршневые для ДВС',4,'koltsa-porshnevye-dlya-dvs',NULL,NULL,NULL,NULL,138,NULL,'2019-11-24 18:11:02'),(41,'2','Вкладыши распредвала',4,'vkladyshi-raspredvala',NULL,NULL,NULL,NULL,137,NULL,'2019-11-24 18:11:02'),(42,'3','Вкладыши шатунные',4,'vkladyshi-shatunnye',NULL,NULL,NULL,NULL,136,NULL,'2019-11-24 18:11:02'),(43,'6','Цепь ГРМ',4,'tsep-grm',NULL,NULL,NULL,NULL,135,NULL,'2019-11-24 18:11:02'),(44,'12','Ролик обводной ремня ГРМ',4,'rolik-obvodnoy-remnya-grm',NULL,NULL,NULL,NULL,134,NULL,'2019-11-24 18:11:02'),(45,'15','Вал распределительный',4,'val-raspredelitelnyy',NULL,NULL,NULL,NULL,133,NULL,'2019-11-24 18:11:02'),(46,'18','Насос масляный',4,'nasos-maslyanyy',NULL,NULL,NULL,NULL,132,NULL,'2019-11-24 18:11:02'),(47,'19','Ротор масляного насоса',4,'rotor-maslyanogo-nasosa',NULL,NULL,NULL,NULL,131,NULL,'2019-11-24 18:11:02'),(48,'27','Колпачки маслосъемные',4,'kolpachki-maslosemnye',NULL,NULL,NULL,NULL,130,NULL,'2019-11-24 18:11:02'),(49,'32','Турбокомпрессор',5,'turbokompressor',NULL,NULL,NULL,NULL,129,NULL,'2019-11-24 18:11:02'),(50,'38','Датчик темп. охлаждающей жидкости',2,'datchik-temp-okhlazhdayushchey-zhidkosti',NULL,NULL,NULL,NULL,128,NULL,'2019-11-24 18:11:02'),(51,'40','Крестовина карданного вала',1,'krestovina-kardannogo-vala',NULL,NULL,NULL,NULL,127,NULL,'2019-11-24 18:11:02'),(52,'41','Крестовина рулевого вала',1,'krestovina-rulevogo-vala',NULL,NULL,NULL,NULL,126,NULL,'2019-11-24 18:11:02'),(53,'42','Шестерня VVTi',4,'shesternya-vvti',NULL,NULL,NULL,NULL,125,NULL,'2019-11-24 18:11:02'),(54,'43','Сальник коленвала',4,'salnik-kolenvala',NULL,NULL,NULL,NULL,124,NULL,'2019-11-24 18:11:02'),(55,'44','Направляющие втулки клапанов',4,'napravlyayushchie-vtulki-klapanov',NULL,NULL,NULL,NULL,123,NULL,'2019-11-24 18:11:02'),(56,'45','Датчик включения вентилятора',2,'datchik-vklyucheniya-ventilyatora',NULL,NULL,NULL,NULL,122,NULL,'2019-11-24 18:11:02'),(57,'46','Крышка радиатора',4,'kryshka-radiatora',NULL,NULL,NULL,NULL,121,NULL,'2019-11-24 18:11:02'),(58,'47','Термостат',2,'termostat',NULL,NULL,NULL,NULL,120,NULL,'2019-11-24 18:11:02'),(59,'48','Компрессор кондиционера',5,'kompressor-konditsionera',NULL,NULL,NULL,NULL,119,NULL,'2019-11-24 18:11:02'),(60,'49','Шкиф компрессора',5,'shkif-kompressora',NULL,NULL,NULL,NULL,118,NULL,'2019-11-24 18:11:02'),(61,'50','Стартер',5,'starter',NULL,NULL,NULL,NULL,117,NULL,'2019-11-24 18:11:02'),(62,'51','Рулевой вал',1,'rulevoy-val',NULL,NULL,NULL,NULL,116,NULL,'2019-11-24 18:11:02'),(63,'52','Направляющая цепи',4,'napravlyayushchaya-tsepi',NULL,NULL,NULL,NULL,115,NULL,'2019-11-24 18:11:02'),(64,'53','Натяжитель масляного насоса',4,'natyazhitel-maslyanogo-nasosa',NULL,NULL,NULL,NULL,114,NULL,'2019-11-24 18:11:02'),(65,'54','Цепь масляного насоса',4,'tsep-maslyanogo-nasosa',NULL,NULL,NULL,NULL,113,NULL,'2019-11-24 18:11:02'),(66,'55','Шестерня коленвала',4,'shesternya-kolenvala',NULL,NULL,NULL,NULL,112,NULL,'2019-11-24 18:11:02'),(67,'56','Шестерня насоса системы смазки',4,'shesternya-nasosa-sistemy-smazki',NULL,NULL,NULL,NULL,111,NULL,'2019-11-24 18:11:02'),(68,'58','Впускной клапан',4,'vpusknoy-klapan',NULL,NULL,NULL,NULL,110,NULL,'2019-11-24 18:11:02'),(69,'59','Выпускной клапан',4,'vypusknoy-klapan',NULL,NULL,NULL,NULL,109,NULL,'2019-11-24 18:11:02'),(70,'260','Масло моторное SN/GF-5 4 л (канистра)',4,'maslo-motornoe-sngf-5-4-l-kanistra',NULL,NULL,'0',NULL,108,NULL,'2019-11-29 06:37:27'),(71,'61','Сайлентблок',1,'saylentblok',NULL,NULL,NULL,NULL,107,NULL,'2019-11-24 18:11:02'),(72,'62','Гидронатяжитель ремня ГРМ',4,'gidronatyazhitel-remnya-grm',NULL,NULL,NULL,NULL,106,NULL,'2019-11-24 18:11:02'),(73,'63','Гидронатяжитель ремня сборе',4,'gidronatyazhitel-remnya-sbore',NULL,NULL,NULL,NULL,105,NULL,'2019-11-24 18:11:02'),(74,'64','Гидронатяжитель ремня только ролик',4,'gidronatyazhitel-remnya-tolko-rolik',NULL,NULL,NULL,NULL,104,NULL,'2019-11-24 18:11:02'),(75,'65','ГУР насос',5,'gur-nasos',NULL,NULL,NULL,NULL,103,NULL,'2019-11-24 18:11:02'),(76,'66','ГУР насос реставрация',5,'gur-nasos-restavratsiya',NULL,NULL,NULL,NULL,102,NULL,'2019-11-24 18:11:02'),(77,'67','Катушка',4,'katushka',NULL,NULL,NULL,NULL,101,NULL,'2019-11-24 18:11:02'),(78,'68','Диодный мост',5,'diodnyy-most',NULL,NULL,NULL,NULL,100,NULL,'2019-11-24 18:11:02'),(79,'69','Регулятор напряжения',5,'regulyator-napryazheniya',NULL,NULL,NULL,NULL,99,NULL,'2019-11-24 18:11:02'),(80,'70','Сальник балансировочного вала',4,'salnik-balansirovochnogo-vala',NULL,NULL,NULL,NULL,98,NULL,'2019-11-24 18:11:02'),(81,'71','Сальник масляного насоса',4,'salnik-maslyanogo-nasosa',NULL,NULL,NULL,NULL,97,NULL,'2019-11-24 18:11:02'),(82,'72','Сальник муфты',4,'salnik-mufty',NULL,NULL,NULL,NULL,96,NULL,'2019-11-24 18:11:02'),(83,'73','Сальник первичного вала',4,'salnik-pervichnogo-vala',NULL,NULL,NULL,NULL,95,NULL,'2019-11-24 18:11:02'),(84,'74','Сальник привода',4,'salnik-privoda',NULL,NULL,NULL,NULL,94,NULL,'2019-11-24 18:11:02'),(85,'75','Сальник раздатки',4,'salnik-razdatki',NULL,NULL,NULL,NULL,93,NULL,'2019-11-24 18:11:02'),(86,'76','Сальник распредвала',4,'salnik-raspredvala',NULL,NULL,NULL,NULL,92,NULL,'2019-11-24 18:11:02'),(87,'77','Сальник редуктора',4,'salnik-reduktora',NULL,NULL,NULL,NULL,91,NULL,'2019-11-24 18:11:02'),(88,'79','Сальник переднего моста',4,'salnik-perednego-mosta',NULL,NULL,NULL,NULL,90,NULL,'2019-11-24 18:11:02'),(89,'80','Втулка уплотнительная клапанной крышки',4,'vtulka-uplotnitelnaya-klapannoy-kryshki',NULL,NULL,NULL,NULL,89,NULL,'2019-11-24 18:11:02'),(90,'81','Герметик силиконовый',6,'germetik-silikonovyy',NULL,NULL,NULL,NULL,88,NULL,'2019-11-24 18:11:02'),(91,'82','Медное кольцо',4,'mednoe-koltso',NULL,NULL,NULL,NULL,87,NULL,'2019-11-24 18:11:02'),(92,'83','Прокладка клапанной крышки',4,'prokladka-klapannoy-kryshki',NULL,NULL,NULL,NULL,86,NULL,'2019-11-24 18:11:02'),(93,'84','Прокладка впускного коллектора',4,'prokladka-vpusknogo-kollektora',NULL,NULL,NULL,NULL,85,NULL,'2019-11-24 18:11:02'),(94,'85','Прокладка выпускного коллектора',4,'prokladka-vypusknogo-kollektora',NULL,NULL,NULL,NULL,84,NULL,'2019-11-24 18:11:02'),(95,'86','Прокладка глушителя',4,'prokladka-glushitelya',NULL,NULL,NULL,NULL,83,NULL,'2019-11-24 18:11:02'),(96,'87','Прокладка масляного поддона',4,'prokladka-maslyanogo-poddona',NULL,NULL,NULL,NULL,82,NULL,'2019-11-24 18:11:02'),(97,'88','Сальник',4,'salnik',NULL,NULL,NULL,NULL,81,NULL,'2019-11-24 18:11:02'),(98,'89','Сальник помпы',4,'salnik-pompy',NULL,NULL,NULL,NULL,80,NULL,'2019-11-24 18:11:02'),(99,'90','Сальник свечного колодца',4,'salnik-svechnogo-kolodtsa',NULL,NULL,NULL,NULL,79,NULL,'2019-11-24 18:11:02'),(100,'91','Мотор печки',3,'motor-pechki',NULL,NULL,NULL,NULL,78,NULL,'2019-11-24 18:11:02'),(101,'92','Резистор',3,'rezistor',NULL,NULL,NULL,NULL,77,NULL,'2019-11-24 18:11:02'),(102,'93','Привод',1,'privod',NULL,NULL,NULL,NULL,76,NULL,'2019-11-24 18:11:02'),(103,'94','Шрус внутренний',1,'shrus-vnutrenniy',NULL,NULL,NULL,NULL,75,NULL,'2019-11-24 18:11:02'),(104,'95','Шрус наружный',1,'shrus-naruzhnyy',NULL,NULL,NULL,NULL,74,NULL,'2019-11-24 18:11:02'),(105,'96','Ремкомплект суппорта',1,'remkomplekt-supporta',NULL,NULL,NULL,NULL,73,NULL,'2019-11-24 18:11:02'),(106,'98','Подшипник ступицы в сборе',1,'podshipnik-stupitsy-v-sbore',NULL,NULL,NULL,NULL,72,NULL,'2019-11-24 18:11:02'),(107,'99','Ступица колеса',1,'stupitsa-kolesa',NULL,NULL,NULL,NULL,71,NULL,'2019-11-24 18:11:02'),(108,'101','ГРМ ремень',4,'grm-remen',NULL,NULL,NULL,NULL,70,NULL,'2019-11-24 18:11:02'),(109,'102','Отбойник амортизатора',1,'otboynik-amortizatora',NULL,NULL,NULL,NULL,69,NULL,'2019-11-24 18:11:02'),(110,'103','Пыльник амортизатора',1,'pylnik-amortizatora',NULL,NULL,NULL,NULL,68,NULL,'2019-11-24 18:11:02'),(111,'104','Пыльник рулевой рейки',1,'pylnik-rulevoy-reyki',NULL,NULL,NULL,NULL,67,NULL,'2019-11-24 18:11:02'),(112,'105','Пыльник шруса',1,'pylnik-shrusa',NULL,NULL,NULL,NULL,66,NULL,'2019-11-24 18:11:02'),(113,'106','Колодки тормозные',1,'kolodki-tormoznye',NULL,NULL,NULL,NULL,65,NULL,'2019-11-24 18:11:02'),(114,'107','Радиатор кондиционера',3,'radiator-konditsionera',NULL,NULL,NULL,NULL,64,NULL,'2019-11-24 18:11:02'),(115,'109','Радиатор охлаждения',3,'radiator-okhlazhdeniya',NULL,NULL,NULL,NULL,63,NULL,'2019-11-24 18:11:02'),(116,'110','Волюметр',2,'volyumetr',NULL,NULL,NULL,NULL,62,NULL,'2019-11-24 18:11:02'),(117,'111','Датчик кислородный (лямбда-зонд)',2,'datchik-kislorodnyy-lyambda-zond',NULL,NULL,NULL,NULL,61,NULL,'2019-11-24 18:11:02'),(118,'112','Датчик положения распредвала',2,'datchik-polozheniya-raspredvala',NULL,NULL,NULL,NULL,60,NULL,'2019-11-24 18:11:02'),(119,'113','Щеткодержатель генератора',2,'shchetkoderzhatel-generatora',NULL,NULL,NULL,NULL,59,NULL,'2019-11-24 18:11:02'),(120,'114','Крестовина рулевой колонки',1,'krestovina-rulevoy-kolonki',NULL,NULL,NULL,NULL,58,NULL,'2019-11-24 18:11:02'),(121,'115','ГУР шланг',5,'gur-shlang',NULL,NULL,NULL,NULL,57,NULL,'2019-11-24 18:11:02'),(122,'116','Генератор',5,'generator',NULL,NULL,NULL,NULL,56,NULL,'2019-11-24 18:11:02'),(123,'117','Диски тормозные',1,'diski-tormoznye',NULL,NULL,NULL,NULL,55,NULL,'2019-11-24 18:11:02'),(124,'118','Фильтр масляный',4,'filtr-maslyanyy',NULL,NULL,NULL,NULL,54,NULL,'2019-11-24 18:11:02'),(125,'119','Кольцо уплотняющее дифференциала',4,'koltso-uplotnyayushchee-differentsiala',NULL,NULL,NULL,NULL,53,NULL,'2019-11-24 18:11:02'),(375,'57','Шестерня распредвала',4,'shesternya-raspredvala',NULL,NULL,NULL,NULL,0,NULL,NULL),(376,'60','Втулка стабилизатора',1,'vtulka-stabilizatora',NULL,NULL,NULL,NULL,0,NULL,NULL),(377,'78','Сальник хвостовика',4,'salnik-khvostovika',NULL,NULL,NULL,NULL,0,NULL,NULL),(378,'97','Патрубок системы охлаждения',3,'patrubok-sistemy-okhlazhdeniya',NULL,NULL,NULL,NULL,0,NULL,NULL),(379,'100','Ступица колеса с подшипником в сборе',1,'stupitsa-kolesa-s-podshipnikom-v-sbore',NULL,NULL,NULL,NULL,0,NULL,NULL),(380,'108','Радиатор отопителя',3,'radiator-otopitelya',NULL,NULL,NULL,NULL,0,NULL,NULL),(381,'120','Сальник гидроусилителя руля',4,'salnik-gidrousilitelya-rulya',NULL,NULL,NULL,NULL,0,NULL,NULL),(382,'121','Сальник дифференциала',4,'salnik-differentsiala',NULL,NULL,NULL,NULL,0,NULL,NULL),(383,'122','Сальник полуоси',4,'salnik-poluosi',NULL,NULL,'1',NULL,0,NULL,'2019-11-29 06:46:12');
/*!40000 ALTER TABLE `part_catalogs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `partner_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partner_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale` tinyint(4) NOT NULL,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partner_groups_sale_unique` (`sale`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `partner_groups` WRITE;
/*!40000 ALTER TABLE `partner_groups` DISABLE KEYS */;
INSERT INTO `partner_groups` VALUES (1,'Новый',0,NULL,'2019-10-22 13:32:52','2019-10-22 13:32:52'),(2,'Стабильный',1,'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>','2019-10-22 13:46:49','2019-10-22 13:46:49'),(3,'Холодный',5,'<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>','2019-10-22 13:48:20','2019-10-22 13:48:20');
/*!40000 ALTER TABLE `partner_groups` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(10) unsigned DEFAULT NULL,
  `sale` int(10) unsigned DEFAULT NULL,
  `count_sale_count` int(10) unsigned DEFAULT NULL,
  `count_sale_percent` tinyint(4) DEFAULT NULL,
  `available` int(10) unsigned DEFAULT NULL,
  `min_count` int(10) unsigned NOT NULL DEFAULT '1',
  `multiplication` int(10) unsigned NOT NULL DEFAULT '1',
  `image` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_image` tinyint(1) NOT NULL DEFAULT '1',
  `oem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_catalog_id` bigint(20) unsigned NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `parts_ref_unique` (`ref`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'123456','test','test',NULL,NULL,NULL,NULL,NULL,1,1,NULL,1,NULL,NULL,'test',383,1,1,1);
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
DROP TABLE IF EXISTS `pickup_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickup_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pickup_points` WRITE;
/*!40000 ALTER TABLE `pickup_points` DISABLE KEYS */;
INSERT INTO `pickup_points` VALUES (2,'11634 VICTORY BLVD UNIT 1 NORTH','50.30351837451636','57.18826293945306',2,0,'2019-11-22 16:27:37','2019-11-28 04:23:05'),(3,'54th house','50.65198486539321','61.251117535034965',1,0,'2019-11-22 17:06:23','2019-11-28 04:23:28'),(4,'Алматы Казахстан, с. Мадениет уч. 383','43.3395259040909','76.83135166938267',2,1,'2019-11-26 08:46:10','2019-11-28 04:23:37');
/*!40000 ALTER TABLE `pickup_points` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `price_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `price_applications` WRITE;
/*!40000 ALTER TABLE `price_applications` DISABLE KEYS */;
INSERT INTO `price_applications` VALUES (1,1,'test','+374553256655','Ереван','Ереван',1,'test','test','2019-11-30 16:10:56','2019-11-30 16:10:56');
/*!40000 ALTER TABLE `price_applications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `recommended_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommended_parts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `part_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recommended_parts_user_id_foreign` (`user_id`),
  KEY `recommended_parts_part_id_foreign` (`part_id`),
  CONSTRAINT `recommended_parts_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recommended_parts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `recommended_parts` WRITE;
/*!40000 ALTER TABLE `recommended_parts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recommended_parts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `restricted_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restricted_brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `restricted_brands_brand_id_foreign` (`brand_id`),
  KEY `restricted_brands_user_id_foreign` (`user_id`),
  CONSTRAINT `restricted_brands_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restricted_brands_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `restricted_brands` WRITE;
/*!40000 ALTER TABLE `restricted_brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `restricted_brands` ENABLE KEYS */;
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
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '-1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_group_id` int(10) unsigned DEFAULT '1',
  `individual_sale` tinyint(4) NOT NULL DEFAULT '0',
  `seen_at` timestamp NULL DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,3,'Айк','Ереван','Ереван','+374553256655','COMPANY','BIN','zakhayko@gmail.com','$2y$10$j13u95VxaZKl89aIQhB26eGb1MKAjLUwzCsR/42r2d8qCl2LoneGq',NULL,1,'4hygOhcnrSGKvQxejkhHFls3rOHY2W23qZLs3m6sskNeXK1jCMpafqfv4sFD',2,0,'2019-11-30 16:20:30','2019-11-30 14:57:43','2019-10-15 15:59:56','2019-11-27 09:47:55'),(2,2,NULL,'Test','Астана','Tera','+444444444','Test','Test','hayko2000@mail.ru','$2y$10$yFSwRaqyA4B3Oi9er1SXaOxWnUSww5iEA7C8RF8BeX5DNILGo2.ca',NULL,1,NULL,1,0,'2019-11-24 16:36:14','2019-11-24 15:25:03','2019-10-15 17:40:38','2019-11-24 15:24:49'),(4,1,NULL,'test','Алматы','Qatar','87715115555',NULL,NULL,'tests@test.com','$2y$10$szHSyORnHvLfe7iayljYU.3pNXrFqjt0Ss8YpW.qlQ4s1kfrzXqU2','$2y$10$H.TLs3QpAn5kHM8zr5hDYeyMWCdCT9qPxyVpAnVUpWQfR86UjZyR.',1,NULL,1,0,NULL,NULL,'2019-10-29 09:36:54','2019-11-07 11:53:17'),(5,2,NULL,'Test 1234','Test1','Test','6666666666','company','123456789012','zakhayko1@gmail.com','$2y$10$yW7oFYmZq2sp/5OQTe1FxexcI5MdutUNknglvDKsy7GBzacyiO28S',NULL,1,NULL,1,0,'2019-11-07 12:09:34','2019-11-07 11:53:49','2019-11-07 11:51:42','2019-11-07 12:07:15'),(6,1,NULL,'Name','Region','City','5555555555',NULL,NULL,'dev@dev.loc','$2y$10$mvcVvvFr1G3YQU1ToNa.IeL3.jGoQWX6YR0rJeHuRKl63g6TOpItK','$2y$10$Oj58/Jw3ieSZ1iHUXoRwxuqlVeJFDg.sRw2DD.E3pVUYi.lix21ci',-1,NULL,NULL,20,NULL,NULL,'2019-11-27 09:33:08','2019-11-27 09:47:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

