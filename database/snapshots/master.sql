
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `criteria` VALUES (1,1,'Руль',0,'2019-10-08 16:42:13','2019-11-25 08:30:43'),(2,1,'Салон',0,'2019-10-08 16:42:17','2019-11-25 08:30:58'),(3,1,'Criterion 3',0,'2019-10-08 16:42:22','2019-10-08 16:42:22'),(4,4,'Criterion 1',2,'2019-10-08 16:42:34','2019-10-09 14:45:52'),(5,4,'Criterion 2',1,'2019-10-08 16:42:38','2019-10-09 14:45:52');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engine_part` WRITE;
/*!40000 ALTER TABLE `engine_part` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `engines` WRITE;
/*!40000 ALTER TABLE `engines` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `filters` VALUES (1,'Назначение',NULL,1,1,'2019-10-08 15:26:34','2019-11-25 08:30:26'),(4,'Filter 2',NULL,3,1,'2019-10-08 16:42:28','2019-10-10 15:50:55'),(6,'Filter 3',NULL,2,1,'2019-10-08 17:16:36','2019-10-10 15:50:55');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
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
  `cid` int(10) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modification_part` WRITE;
/*!40000 ALTER TABLE `modification_part` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `modifications` WRITE;
/*!40000 ALTER TABLE `modifications` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `part_catalogs` WRITE;
/*!40000 ALTER TABLE `part_catalogs` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
INSERT INTO `users` VALUES (1,2,3,'Айк','Ереван','Ереван','+374553256655','COMPANY','BIN','zakhayko@gmail.com','$2y$10$j13u95VxaZKl89aIQhB26eGb1MKAjLUwzCsR/42r2d8qCl2LoneGq',NULL,1,'4hygOhcnrSGKvQxejkhHFls3rOHY2W23qZLs3m6sskNeXK1jCMpafqfv4sFD',2,0,'2019-12-03 05:59:06','2019-12-03 05:56:29','2019-10-15 15:59:56','2019-11-27 09:47:55'),(2,2,NULL,'Test','Астана','Tera','+444444444','Test','Test','hayko2000@mail.ru','$2y$10$yFSwRaqyA4B3Oi9er1SXaOxWnUSww5iEA7C8RF8BeX5DNILGo2.ca',NULL,1,NULL,1,0,'2019-11-24 16:36:14','2019-11-24 15:25:03','2019-10-15 17:40:38','2019-11-24 15:24:49'),(4,1,NULL,'test','Алматы','Qatar','87715115555',NULL,NULL,'tests@test.com','$2y$10$szHSyORnHvLfe7iayljYU.3pNXrFqjt0Ss8YpW.qlQ4s1kfrzXqU2','$2y$10$H.TLs3QpAn5kHM8zr5hDYeyMWCdCT9qPxyVpAnVUpWQfR86UjZyR.',1,NULL,1,0,NULL,NULL,'2019-10-29 09:36:54','2019-11-07 11:53:17'),(5,2,NULL,'Test 1234','Test1','Test','6666666666','company','123456789012','zakhayko1@gmail.com','$2y$10$yW7oFYmZq2sp/5OQTe1FxexcI5MdutUNknglvDKsy7GBzacyiO28S',NULL,1,NULL,1,0,'2019-11-07 12:09:34','2019-11-07 11:53:49','2019-11-07 11:51:42','2019-11-07 12:07:15'),(6,1,NULL,'Name','Region','City','5555555555',NULL,NULL,'dev@dev.loc','$2y$10$mvcVvvFr1G3YQU1ToNa.IeL3.jGoQWX6YR0rJeHuRKl63g6TOpItK','$2y$10$Oj58/Jw3ieSZ1iHUXoRwxuqlVeJFDg.sRw2DD.E3pVUYi.lix21ci',-1,NULL,NULL,20,NULL,NULL,'2019-11-27 09:33:08','2019-11-27 09:47:42');
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

