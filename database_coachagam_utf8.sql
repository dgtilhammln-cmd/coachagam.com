-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: coachagam_db
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ahp_players`
--

DROP TABLE IF EXISTS `ahp_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ahp_players` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_reg` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ahp_players_no_reg_unique` (`no_reg`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ahp_players`
--

LOCK TABLES `ahp_players` WRITE;
/*!40000 ALTER TABLE `ahp_players` DISABLE KEYS */;
INSERT INTO `ahp_players` VALUES (1,'AHP-01','Ilham Maulana','1900-01-02','Goalkeeper','ahp-players/T4uh1pJbrw63ZtWTo3M59YNDerw67Xy7aiLomRez.png','ahp-players/NI27GWQ4tsvRRZplEdnOJJvNmpnl8Bewgl92YZ2v.png',1,'2026-06-27 08:14:03','2026-07-10 04:34:01'),(3,'AHP-02','11','1900-01-22',NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(4,'AHP-03','MARIO KIDANG',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(5,'AHP-04','GIBRAN NUR AZIZ MUNAJID',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(6,'AHP-05','ALEX ALHABIBI',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(7,'AHP-06','ARKAN DAFFA SURYANA',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(8,'AHP-07','ANDISSHAFA MAULANA PUTRA',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(9,'AHP-08','GABRIEL EMPINDONTA',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(10,'AHP-09','DODIK WAHYU PRASTYO',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(11,'AHP-10','AHMAD LAKAL FAUZ FAWA',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(12,'AHP-11','ALVAREZA KINAN SADEWA',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(13,'AHP-12','FAHRI NUR FATIKH',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(14,'AHP-13','DIAN',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(15,'AHP-14','DANU BAGUS FEBRIANO',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(16,'AHP-15','FADAUKAS MUHAMMAD HAQ',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(17,'AHP-16','M. AZIS SYAIFULLAH',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(18,'AHP-17','EXCEL ELRAHMANSYAH RIZAL',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(19,'AHP-18','MUHAMMAD ROBITH AL-HIKAM',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(20,'AHP-19','HUONE FIGO F. H',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(21,'AHP-20','BAMBANG PRASTYO AGUNG',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(22,'AHP-21','YOHANES S.KAKO',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(23,'AHP-22','RADITYA JOVAN P',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(24,'AHP-23','M. ROSYID M',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(25,'AHP-24','YANSA PRASETYA',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(26,'AHP-25','ERICK CAHYADI',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(27,'AHP-26','AHMAD RAFI C',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(28,'AHP-27','ABYAN RIZKY A',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(29,'AHP-28','JEKA MAYA MONTEIRO',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(30,'AHP-29','BAGAS NUR W',NULL,NULL,NULL,NULL,1,'2026-07-10 04:32:54','2026-07-10 04:32:54');
/*!40000 ALTER TABLE `ahp_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ahp_test_results`
--

DROP TABLE IF EXISTS `ahp_test_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ahp_test_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `player_id` bigint unsigned NOT NULL,
  `session_id` bigint unsigned NOT NULL,
  `age` int DEFAULT NULL,
  `height_cm` decimal(5,2) DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `bmi` decimal(5,2) DEFAULT NULL,
  `body_fat_percentage` decimal(5,2) DEFAULT NULL,
  `skeletal_muscle_mass` decimal(5,2) DEFAULT NULL,
  `moca_score` int DEFAULT NULL,
  `total_passing` int DEFAULT NULL,
  `passing_sukses` int DEFAULT NULL,
  `passing_gagal` int DEFAULT NULL,
  `scanning_per_10sec` decimal(5,2) DEFAULT NULL,
  `initial_acceleration` decimal(8,3) DEFAULT NULL,
  `acceleration_phase` decimal(8,3) DEFAULT NULL,
  `maximal_speed` decimal(8,3) DEFAULT NULL,
  `rast_test` decimal(6,2) DEFAULT NULL,
  `yo_yo_level` int DEFAULT NULL,
  `yo_yo_balikan` int DEFAULT NULL,
  `yo_yo_distance` decimal(8,2) DEFAULT NULL,
  `rating_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ahp_test_results_player_id_session_id_unique` (`player_id`,`session_id`),
  KEY `ahp_test_results_session_id_foreign` (`session_id`),
  CONSTRAINT `ahp_test_results_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `ahp_players` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ahp_test_results_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `ahp_test_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ahp_test_results`
--

LOCK TABLES `ahp_test_results` WRITE;
/*!40000 ALTER TABLE `ahp_test_results` DISABLE KEYS */;
INSERT INTO `ahp_test_results` VALUES (1,1,1,3,4.00,5.00,6.00,7.00,8.00,9,10,11,12,13.00,14.000,15.000,16.000,17.00,18,19,20.00,'Kondisi awal cukup baik, ada ruang besar untuk peningkatan stamina dan kecepatan.','2026-07-10 01:45:49','2026-07-10 04:32:54'),(2,1,2,21,172.00,67.80,22.92,14.70,36.80,27,30,27,3,6.80,1.710,2.180,2.890,7.45,13,6,760.00,NULL,'2026-07-10 01:45:49','2026-07-10 04:34:31'),(3,3,1,33,44.00,55.00,66.00,77.00,88.00,99,100,111,122,133.00,144.000,155.000,166.000,177.00,188,199,200.00,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(4,4,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(5,5,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(6,6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(7,7,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(8,8,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(9,9,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(10,10,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(11,11,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(12,12,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(13,13,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(14,14,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(15,15,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(16,16,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(17,17,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(18,18,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(19,19,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(20,20,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(21,21,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(22,22,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(23,23,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(24,24,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(25,25,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(26,26,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(27,27,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(28,28,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(29,29,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(30,30,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:32:54','2026-07-10 04:32:54'),(31,3,2,22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(32,4,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(33,5,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(34,6,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(35,7,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(36,8,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(37,9,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(38,10,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(39,11,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(40,12,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(41,13,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(42,14,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(43,15,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(44,16,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(45,17,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(46,18,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(47,19,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(48,20,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(49,21,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(50,22,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(51,23,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(52,24,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(53,25,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(54,26,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(55,27,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(56,28,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(57,29,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31'),(58,30,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-07-10 04:34:31','2026-07-10 04:34:31');
/*!40000 ALTER TABLE `ahp_test_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ahp_test_sessions`
--

DROP TABLE IF EXISTS `ahp_test_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ahp_test_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_date` date NOT NULL,
  `test_time` time DEFAULT NULL,
  `temperature` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period_week` int DEFAULT NULL,
  `coach_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ahp_test_sessions`
--

LOCK TABLES `ahp_test_sessions` WRITE;
/*!40000 ALTER TABLE `ahp_test_sessions` DISABLE KEYS */;
INSERT INTO `ahp_test_sessions` VALUES (1,'Pre Test — Maret 2025','Lapangan Utama Coach Agam','2025-03-01',NULL,NULL,1,'Sesi evaluasi awal sebelum program AHP Training dimulai.','2026-07-10 01:45:49','2026-07-10 01:45:49'),(2,'Post Test — Mei 2025','Lapangan Utama Coach Agam','2025-05-30',NULL,NULL,8,'Sesi evaluasi akhir setelah 8 minggu program AHP Training.','2026-07-10 01:45:49','2026-07-10 01:45:49');
/*!40000 ALTER TABLE `ahp_test_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `selected_option_id` bigint unsigned DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `score` decimal(8,2) NOT NULL DEFAULT '0.00',
  `essay_answer` longtext COLLATE utf8mb4_unicode_ci,
  `essay_feedback` text COLLATE utf8mb4_unicode_ci,
  `essay_status` enum('pending','graded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `graded_at` datetime DEFAULT NULL,
  `graded_by` bigint unsigned DEFAULT NULL,
  `answered_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `answers_session_id_question_id_unique` (`session_id`,`question_id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_selected_option_id_foreign` (`selected_option_id`),
  KEY `answers_graded_by_foreign` (`graded_by`),
  KEY `answers_session_id_index` (`session_id`),
  KEY `answers_essay_status_index` (`essay_status`),
  CONSTRAINT `answers_graded_by_foreign` FOREIGN KEY (`graded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_selected_option_id_foreign` FOREIGN KEY (`selected_option_id`) REFERENCES `options` (`id`) ON DELETE SET NULL,
  CONSTRAINT `answers_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `exam_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `organizer_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `banner_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('draft','published','ongoing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `settings` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_organizer_id_status_index` (`organizer_id`,`status`),
  CONSTRAINT `events_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_questions`
--

DROP TABLE IF EXISTS `exam_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `display_order` int NOT NULL,
  `shuffled_options` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_questions_session_id_question_id_unique` (`session_id`,`question_id`),
  KEY `exam_questions_question_id_foreign` (`question_id`),
  KEY `exam_questions_session_id_display_order_index` (`session_id`,`display_order`),
  CONSTRAINT `exam_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_questions_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `exam_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_questions`
--

LOCK TABLES `exam_questions` WRITE;
/*!40000 ALTER TABLE `exam_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_sessions`
--

DROP TABLE IF EXISTS `exam_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `participant_id` bigint unsigned NOT NULL,
  `round_id` bigint unsigned NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` datetime DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `status` enum('pending','ongoing','submitted','auto_submitted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `violation_count` int NOT NULL DEFAULT '0',
  `score_pg` decimal(10,2) NOT NULL DEFAULT '0.00',
  `score_essay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_score` decimal(10,2) NOT NULL DEFAULT '0.00',
  `correct_count` int NOT NULL DEFAULT '0',
  `wrong_count` int NOT NULL DEFAULT '0',
  `unanswered_count` int NOT NULL DEFAULT '0',
  `result_status` enum('pending','pg_scored','essay_pending','final') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `result_published_at` datetime DEFAULT NULL,
  `rank` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_sessions_participant_id_round_id_unique` (`participant_id`,`round_id`),
  UNIQUE KEY `exam_sessions_token_unique` (`token`),
  KEY `exam_sessions_round_id_status_index` (`round_id`,`status`),
  KEY `exam_sessions_result_status_index` (`result_status`),
  CONSTRAINT `exam_sessions_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_sessions_round_id_foreign` FOREIGN KEY (`round_id`) REFERENCES `rounds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_sessions`
--

LOCK TABLES `exam_sessions` WRITE;
/*!40000 ALTER TABLE `exam_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `import_logs`
--

DROP TABLE IF EXISTS `import_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `import_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `organizer_id` bigint unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_rows` int NOT NULL DEFAULT '0',
  `success_count` int NOT NULL DEFAULT '0',
  `failed_count` int NOT NULL DEFAULT '0',
  `errors` json DEFAULT NULL,
  `status` enum('processing','done','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `import_logs_event_id_foreign` (`event_id`),
  KEY `import_logs_organizer_id_foreign` (`organizer_id`),
  CONSTRAINT `import_logs_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `import_logs_organizer_id_foreign` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `import_logs`
--

LOCK TABLES `import_logs` WRITE;
/*!40000 ALTER TABLE `import_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `import_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,'ilham maulana','dgt.ilhammln@gmail.com','085162612373','Pelatihan Privat','TEST 123','contacted','2026-06-26 05:32:12','2026-06-26 05:32:19'),(2,'ilham maulana','dgt.ilhammln@gmail.com','085162612373','AHP Training','testing','contacted','2026-07-10 03:30:39','2026-07-10 12:40:54');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024_01_01_000001_create_users_table',1),(2,'2024_01_01_000002_create_events_table',1),(3,'2024_01_01_000003_create_rounds_table',1),(4,'2024_01_01_000004_create_question_banks_table',1),(5,'2024_01_01_000005_create_questions_table',1),(6,'2024_01_01_000006_create_round_banks_table',1),(7,'2024_01_01_000007_create_participants_table',1),(8,'2024_01_01_000008_create_import_logs_table',1),(9,'2024_01_01_000009_create_exam_sessions_table',1),(10,'2024_01_01_000010_create_exam_questions_answers_table',1),(11,'2024_01_01_000011_create_violations_table',1),(12,'2026_06_26_000012_create_site_settings_table',1),(13,'2026_06_26_000013_create_posts_table',1),(14,'2026_06_26_000014_add_administrator_role_to_users',1),(15,'2026_06_26_120520_create_leads_table',2),(16,'2026_06_26_192015_add_keywords_and_faq_to_posts_table',3),(17,'2026_06_27_000020_create_ahp_players_table',4),(18,'2026_06_27_000021_create_ahp_test_sessions_table',4),(19,'2026_06_27_000022_create_ahp_test_results_table',4),(20,'2026_07_10_110057_add_og_image_to_ahp_players_table',5),(21,'2026_07_10_112410_alter_acceleration_columns_in_ahp_test_results_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_image_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `order_index` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `options_question_id_index` (`question_id`),
  CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `participant_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('registered','active','disqualified','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'registered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `participants_event_id_user_id_unique` (`event_id`,`user_id`),
  KEY `participants_user_id_foreign` (`user_id`),
  KEY `participants_event_id_status_index` (`event_id`,`status`),
  CONSTRAINT `participants_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Coach Agam',
  `author_id` bigint unsigned DEFAULT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq` json DEFAULT NULL,
  `read_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'e.g. 5 min baca',
  `views` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_author_id_foreign` (`author_id`),
  KEY `posts_category_index` (`category`),
  KEY `posts_status_index` (`status`),
  KEY `posts_published_at_index` (`published_at`),
  KEY `posts_is_featured_index` (`is_featured`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Pentingnya Periodisasi Latihan untuk Pemain Muda','pentingnya-periodisasi-latihan-untuk-pemain-muda','Periodisasi adalah kunci untuk mengoptimalkan performa atlet muda. Tanpa perencanaan siklus latihan yang tepat, risiko cedera dan overtraining akan meningkat drastis.','<h2>Apa Itu Periodisasi Latihan?</h2>\r\n<p>Periodisasi latihan adalah metode perencanaan program latihan yang membagi siklus latihan menjadi periode-periode yang berbeda, masing-masing dengan fokus dan intensitas yang berbeda. Konsep ini bukan hanya berlaku untuk atlet profesional, tetapi sangat krusial juga untuk diterapkan pada pemain muda.</p>\r\n<h2>Mengapa Pemain Muda Membutuhkan Periodisasi?</h2>\r\n<p>Tubuh pemain muda masih dalam tahap perkembangan. Tulang, ligamen, dan otot mereka belum mencapai kematangan penuh. Oleh karena itu, beban latihan yang terlalu tinggi secara konsisten dapat menghambat pertumbuhan dan meningkatkan risiko cedera.</p>\r\n<blockquote>Latihan yang baik bukan yang paling keras, melainkan yang paling tepat pada waktu yang tepat. - Coach Agam</blockquote>\r\n<h2>Fase-fase dalam Periodisasi</h2>\r\n<ul>\r\n    <li><strong>Fase Persiapan Umum:</strong> Fokus pada peningkatan kapasitas aerobik, kekuatan dasar, dan teknik fundamental.</li>\r\n    <li><strong>Fase Persiapan Khusus:</strong> Latihan lebih spesifik ke tuntutan fisik sepakbola, termasuk sprint pendek, agility, dan power.</li>\r\n    <li><strong>Fase Kompetisi:</strong> Mempertahankan kondisi puncak sambil mengelola kelelahan. Volume latihan dikurangi, intensitas dipertahankan.</li>\r\n    <li><strong>Fase Transisi:</strong> Pemulihan aktif pasca musim. Menjaga kebugaran umum sambil memberikan waktu istirahat mental dan fisik.</li>\r\n</ul>\r\n<h2>Kesimpulan</h2>\r\n<p>Periodisasi yang tepat adalah investasi jangka panjang bagi karier seorang pemain. Kuncinya adalah program yang <strong>terstruktur, progresif, dan disesuaikan dengan usia biologis</strong> sang atlet.</p>','sport-science','uploads/blog/NANktUhIT4JPD8EPe95a177r5sfBEWBkq8sdFDAi.jpg','Coach Agam',NULL,'published','2026-06-19 09:28:00','Periodisasi Latihan Pemain Muda - Coach Agam','Pelajari pentingnya periodisasi latihan untuk mengoptimalkan performa dan mencegah cedera pada pemain sepakbola muda.',NULL,NULL,NULL,179,1,'2026-06-26 09:28:02','2026-07-10 10:07:24',NULL),(2,'Membangun Pressing Tinggi yang Efektif: Prinsip Dasar & Implementasi','membangun-pressing-tinggi-yang-efektif-prinsip-dasar-dan-implementasi','High pressing bukan sekadar berlari kencang mengejar bola. Dibutuhkan koordinasi taktik, pemahaman posisi, dan kondisi fisik yang prima. Berikut panduan implementasinya.','<h2>Mengapa High Pressing?</h2>\n<p>Dalam sepakbola modern, high pressing telah menjadi salah satu senjata paling efektif untuk merebut bola di zona berbahaya lawan. Tim-tim seperti Liverpool era Klopp, RB Leipzig, dan Napoli era Sarri membuktikan betapa dahsyatnya pressing yang terorganisir.</p>\n<h2>5 Prinsip Dasar High Pressing</h2>\n<ol>\n    <li><strong>Pemicu Pressing (Trigger):</strong> Tentukan momen yang tepat untuk memulai pressing - bisa saat umpan balik ke kiper, saat menerima bola dengan punggung menghadap gawang, atau saat kontrol bola yang buruk.</li>\n    <li><strong>Kepadatan Zona (Compactness):</strong> Semua lini harus bergerak bersama untuk mempersempit ruang lawan. Jarak antar lini tidak boleh lebih dari 25 meter.</li>\n    <li><strong>Memotong Passing Lane:</strong> Pemain yang pressing harus memaksa lawan ke arah tertentu, bukan hanya mengejar bola.</li>\n    <li><strong>Counter-press Setelah Kehilangan Bola:</strong> Dalam 5 detik pertama setelah kehilangan bola, lakukan pressing agresif sebelum lawan mengorganisir serangan.</li>\n    <li><strong>Recovering Position:</strong> Jika pressing gagal, seluruh tim harus mundur dengan cepat dan terorganisir.</li>\n</ol>\n<h2>Latihan untuk Membangun Pressing</h2>\n<p>Mulailah dengan <strong>rondo 4v2 dan 6v3</strong> untuk melatih intensitas dan kepadatan. Kemudian progresikan ke skenario pressing 11v11 di lapangan kecil (60x40 meter).</p>\n<h2>Kesalahan Umum yang Harus Dihindari</h2>\n<ul>\n    <li>Pressing individual tanpa koordinasi tim</li>\n    <li>Tidak memiliki pemicu pressing yang jelas</li>\n    <li>Kebugaran yang tidak mendukung intensitas pressing</li>\n</ul>','materi-kepelatihan','uploads/blog/blog-pressing.png','Coach Agam',NULL,'published','2026-06-12 09:28:02','High Pressing Efektif: Prinsip & Implementasi - Coach Agam','Panduan lengkap membangun sistem pressing tinggi yang efektif dalam sepakbola modern. Dari prinsip dasar hingga implementasi latihan.',NULL,NULL,NULL,287,0,'2026-06-26 09:28:02','2026-06-26 09:34:24',NULL),(3,'Mental Juara: Membangun Ketangguhan Psikologis Atlet dari Dalam','mental-juara-membangun-ketangguhan-psikologis-atlet-dari-dalam','Teknik dan fisik yang prima tidak cukup tanpa fondasi mental yang kuat. Inilah filosofi yang selalu saya tanamkan kepada setiap atlet yang saya latih.','<h2>Fisik Kelas Dunia, Mental Biasa-biasa Saja</h2>\n<p>Saya telah menyaksikan banyak pemain berbakat yang gagal mencapai potensi terbaik mereka bukan karena kekurangan fisik atau teknik, melainkan karena mental yang tidak kuat. Ketangguhan psikologis adalah pembeda antara pemain yang baik dan pemain yang hebat.</p>\n<blockquote>Champions are made in the moments when they want to quit, but they do not. - Herb Brooks</blockquote>\n<h2>Tiga Pilar Mental Juara</h2>\n<p>Dalam filosofi kepelatihan saya, ada tiga pilar yang selalu saya bangun bersama setiap atlet:</p>\n<h3>1. Ketenangan di Bawah Tekanan</h3>\n<p>Kemampuan untuk tetap tenang ketika situasi kritis adalah keterampilan yang bisa dilatih. Melalui simulasi tekanan dalam latihan, pemain belajar mengelola adrenalin dan tetap fokus pada tugasnya.</p>\n<h3>2. Growth Mindset</h3>\n<p>Pemain dengan growth mindset melihat kegagalan sebagai pelajaran. Saya selalu mengajarkan: <strong>tidak ada gagal, yang ada hanya belum berhasil</strong>. Setiap kesalahan adalah data, bukan hukuman.</p>\n<h3>3. Kolektivisme di Atas Egoisme</h3>\n<p>Sepakbola adalah olahraga kolektif. Pemain yang menempatkan tim di atas ego pribadi akan jauh lebih berharga daripada pemain dengan kemampuan individual brilian tetapi sulit bekerja sama.</p>\n<h2>Peran Spiritualitas</h2>\n<p>Sebagai seorang Muslim, saya percaya bahwa kedamaian batin yang berasal dari spiritualitas adalah fondasi terkuat dari ketangguhan mental. Keyakinan bahwa setiap usaha terbaik yang kita lakukan tidak akan sia-sia memberikan ketenangan yang mendalam.</p>\n<p>Kombinasi antara latihan psikologis terstruktur dan nilai-nilai spiritual adalah resep untuk mencetak tidak hanya atlet terbaik, tetapi juga manusia terbaik.</p>','filosofi-spiritualitas','uploads/blog/blog-mental.png','Coach Agam',NULL,'published','2026-06-05 09:28:02','Mental Juara: Ketangguhan Psikologis Atlet - Coach Agam','Filosofi Coach Agam tentang membangun mental juara dan ketangguhan psikologis atlet. Tiga pilar yang menjadi fondasi keberhasilan.',NULL,NULL,NULL,398,0,'2026-06-26 09:28:02','2026-06-26 09:34:24',NULL),(4,'Filosofi dan Peran Pelatih','filosofi-dan-peran-pelatih','\n        1. Pengantar Filosofi Kepelatihan\n        Filosofi kepelatihan adalah fondasi dari setiap keputusan yang diambil oleh seorang pelatih, baik di dalam maupun di luar lapanga...','\n        <h2>1. Pengantar Filosofi Kepelatihan</h2>\n        <p>Filosofi kepelatihan adalah fondasi dari setiap keputusan yang diambil oleh seorang pelatih, baik di dalam maupun di luar lapangan. Ini bukan sekadar tentang formasi 4-3-3 atau taktik menekan (pressing), melainkan cerminan dari nilai-nilai inti, keyakinan, dan visi pelatih terhadap sepakbola.</p>\n        \n        <h3>Membangun Filosofi Sepakbola</h3>\n        <ul>\n            <li><strong>Gaya Bermain (Playing Style):</strong> Menentukan identitas tim. Apakah Anda lebih menyukai penguasaan bola progresif (possession-based), serangan balik cepat (counter-attacking), atau gaya direct?</li>\n            <li><strong>Prinsip Inti:</strong> Apa yang tidak bisa ditawar dalam tim Anda? Misalnya: disiplin tinggi, transisi cepat, atau kerja keras tanpa bola.</li>\n            <li><strong>Adaptabilitas:</strong> Filosofi yang baik harus cukup fleksibel untuk disesuaikan dengan materi pemain yang ada.</li>\n        </ul>\n\n        <h2>2. Peran Multidimensional Pelatih</h2>\n        <p>Di era sepakbola modern, peran pelatih telah jauh melampaui batas-batas lapangan hijau. Seorang pelatih adalah pemimpin yang harus memakai banyak \"topi\" secara bersamaan.</p>\n        \n        <h3>A. Sebagai Pemimpin (Leader) & Manajer</h3>\n        <p>Pelatih bertugas menyatukan berbagai individu dengan ego dan latar belakang berbeda menuju satu tujuan bersama. Kepemimpinan yang kuat membutuhkan empati, ketegasan, dan kemampuan komunikasi yang luar biasa.</p>\n        \n        <h3>B. Sebagai Pendidik (Educator)</h3>\n        <p>Terutama pada tingkat akar rumput (grassroots) dan pengembangan usia muda, pelatih adalah seorang guru. Tugas utamanya adalah mengajarkan pemahaman taktis dan keterampilan teknis dengan metode pedagogi yang tepat.</p>\n        \n        <h3>C. Sebagai Psikolog Praktis</h3>\n        <p>Pelatih harus memahami aspek psikologis pemain. Bagaimana membangkitkan motivasi pemain yang sedang turun performanya? Bagaimana mengatasi kecemasan sebelum pertandingan besar? Ini membutuhkan kecerdasan emosional (EQ) yang tinggi.</p>\n\n        <h2>3. Etika dan Kode Etik Kepelatihan</h2>\n        <p>Pelatih adalah *role model*. Perilaku pelatih di pinggir lapangan akan dicontoh oleh pemain dan dinilai oleh publik. Menghormati wasit, staf lawan, dan menjunjung tinggi *fair play* adalah nilai mutlak yang harus tertanam dalam filosofi pelatih profesional.</p>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:06:40',NULL,NULL,NULL,NULL,'3',70,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL),(5,'Karakteristik dan Kebutuhan Pemain','karakteristik-dan-kebutuhan-pemain','\n        1. Pemahaman Individu dalam Tim\n        Sebuah tim sepakbola terdiri dari individu-individu dengan karakteristik unik. Pelatih yang sukses adalah mereka yang tidak memaksa...','\n        <h2>1. Pemahaman Individu dalam Tim</h2>\n        <p>Sebuah tim sepakbola terdiri dari individu-individu dengan karakteristik unik. Pelatih yang sukses adalah mereka yang tidak memaksakan satu pendekatan untuk semua pemain (one-size-fits-all), melainkan mampu menyesuaikan pendekatannya dengan kebutuhan spesifik masing-masing individu.</p>\n        \n        <h2>2. Klasifikasi Karakteristik Pemain</h2>\n        <p>Untuk memahami pemain, pelatih harus menganalisis mereka dari empat dimensi utama (Model 4 Corner):</p>\n        \n        <h3>A. Dimensi Fisik (Physical)</h3>\n        <ul>\n            <li><strong>Pemain Bertipe Kuat/Fisikal:</strong> Membutuhkan latihan pemeliharaan kekuatan dan pencegahan cedera akibat benturan.</li>\n            <li><strong>Pemain Bertipe Cepat/Eksplosif:</strong> Membutuhkan manajemen beban latihan (load management) yang ketat untuk mencegah cedera otot hamstring.</li>\n            <li><strong>Daya Tahan (Endurance):</strong> Kapasitas VO2Max yang berbeda menuntut penyesuaian volume latihan lari.</li>\n        </ul>\n\n        <h3>B. Dimensi Teknis (Technical)</h3>\n        <p>Kebutuhan teknis bervariasi sesuai posisi. Seorang bek tengah membutuhkan penguasaan teknik *heading* dan *tackling* yang presisi, sementara seorang gelandang serang membutuhkan *first touch* yang sempurna dan visi *passing* di ruang sempit.</p>\n\n        <h3>C. Dimensi Taktikal (Tactical)</h3>\n        <p>Beberapa pemain memiliki *game intelligence* yang luar biasa dan mampu memahami instruksi taktis kompleks dengan cepat. Pemain lain mungkin membutuhkan instruksi yang lebih sederhana dan spesifik (task-oriented). Pelatih harus mengenali gaya belajar kognitif setiap pemain.</p>\n\n        <h3>D. Dimensi Psikologis dan Mental (Psychological)</h3>\n        <ul>\n            <li><strong>Introvert vs Ekstrovert:</strong> Pemain introvert mungkin lebih merespons kritik empat mata di ruangan tertutup, sementara pemain ekstrovert mungkin tidak masalah dikritik secara konstruktif di depan tim.</li>\n            <li><strong>Manajemen Tekanan:</strong> Beberapa pemain berkembang di bawah tekanan tinggi, sementara yang lain membutuhkan ketenangan dan afirmasi positif untuk tampil optimal.</li>\n        </ul>\n\n        <h2>3. Pendekatan Berbasis Usia (Age-Specific Needs)</h2>\n        <p>Kebutuhan pemain sangat dipengaruhi oleh fase perkembangan biologis dan psikologis mereka:</p>\n        <ul>\n            <li><strong>Fase Usia Dini (6-12 tahun):</strong> Fokus utama adalah kegembiraan (fun), kebebasan berekspresi, dan penguasaan teknik dasar. Hasil pertandingan tidak boleh menjadi prioritas.</li>\n            <li><strong>Fase Remaja (13-17 tahun):</strong> Masa pertumbuhan (growth spurt). Pemahaman taktis mulai diperkenalkan lebih dalam. Sangat rentan terhadap masalah mental dan cedera fisik (seperti Osgood-Schlatter).</li>\n            <li><strong>Fase Senior (18+ tahun):</strong> Fokus pada optimalisasi performa (performance-oriented), hasil pertandingan, penyempurnaan detail taktik, dan manajemen karir.</li>\n        </ul>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:07:40',NULL,NULL,NULL,NULL,'3',70,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL),(6,'Prinsip Dasar Kepelatihan Sepakbola','prinsip-dasar-kepelatihan-sepakbola','\n        1. Pengantar Prinsip Sepakbola\n        Prinsip sepakbola adalah hukum-hukum fundamental yang berlaku terlepas dari formasi apa yang digunakan (baik itu 4-3-3, 3-5-2, atau...','\n        <h2>1. Pengantar Prinsip Sepakbola</h2>\n        <p>Prinsip sepakbola adalah hukum-hukum fundamental yang berlaku terlepas dari formasi apa yang digunakan (baik itu 4-3-3, 3-5-2, atau 4-4-2). Pemahaman akan prinsip ini membantu tim merespons berbagai situasi di lapangan secara seragam.</p>\n        \n        <h2>2. Prinsip Menyerang (Attacking Principles)</h2>\n        <p>Tujuan utama menyerang adalah menciptakan peluang dan mencetak gol, dengan tetap meminimalkan risiko terkena serangan balik.</p>\n        <ul>\n            <li><strong>Penetrasi (Penetration):</strong> Upaya mematahkan garis pertahanan lawan melalui umpan terobosan (through pass), dribbling membelah pertahanan, atau tembakan jarak jauh.</li>\n            <li><strong>Dukungan (Support):</strong> Memberikan opsi passing (sudut dan jarak yang tepat) bagi pemain yang sedang menguasai bola. Tanpa support, penetrasi tidak mungkin terjadi.</li>\n            <li><strong>Lebar Lapangan (Width):</strong> Merentangkan formasi lawan ke sisi sayap lapangan untuk menciptakan ruang di area tengah (poros).</li>\n            <li><strong>Mobilitas (Mobility):</strong> Pergerakan tanpa bola (off-the-ball movement) yang dinamis untuk menarik pemain lawan keluar dari posisinya dan merusak struktur pertahanan mereka.</li>\n            <li><strong>Kreativitas & Improvisasi:</strong> Penggunaan skill individu tingkat tinggi di sepertiga akhir lapangan untuk menembus pertahanan rapat (deep block).</li>\n        </ul>\n\n        <h2>3. Prinsip Bertahan (Defending Principles)</h2>\n        <p>Fokus utama bertahan adalah memutus aliran serangan lawan, melindungi area gawang, dan merebut kembali penguasaan bola.</p>\n        <ul>\n            <li><strong>Menunda Serangan (Delay):</strong> Tindakan orang pertama (first defender) yang menekan pembawa bola agar serangan lawan melambat, memberi waktu bagi tim untuk membentuk struktur pertahanan.</li>\n            <li><strong>Kerapatan (Compactness):</strong> Mempersempit jarak antar pemain dan antar lini (vertikal dan horizontal) agar lawan tidak memiliki ruang untuk melakukan umpan daerah (through pass).</li>\n            <li><strong>Perlindungan (Cover):</strong> Penempatan posisi pemain kedua (second defender) di belakang pemain pertama untuk mengantisipasi jika pemain pertama berhasil dilewati lawan.</li>\n            <li><strong>Keseimbangan (Balance):</strong> Menjaga bentuk formasi di area yang jauh dari bola (weak side) agar tidak mudah dieksploitasi jika lawan melakukan perpindahan arah serangan (switch play).</li>\n        </ul>\n\n        <h2>4. Fase Transisi (Transition)</h2>\n        <p>Di sepakbola modern, momen paling krusial adalah saat bola berpindah penguasaan.</p>\n        <ul>\n            <li><strong>Transisi Positif (Bertahan ke Menyerang):</strong> Bereaksi secepat mungkin setelah merebut bola. Pilihannya: melakukan counter-attack cepat ke depan, atau mengamankan penguasaan bola terlebih dahulu.</li>\n            <li><strong>Transisi Negatif (Menyerang ke Bertahan):</strong> Respon langsung setelah kehilangan bola. Pilihannya: melakukan pressing tinggi seketika (Gegenpressing), atau segera mundur membentuk blok pertahanan (drop deep).</li>\n        </ul>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:08:40',NULL,NULL,NULL,NULL,'3',54,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL),(7,'Coaching Behavior dan Komunikasi','coaching-behavior-dan-komunikasi','\n        1. Pentingnya Perilaku Pelatih (Coaching Behavior)\n        Apa yang pelatih lakukan di pinggir lapangan dan saat sesi latihan jauh lebih berbicara daripada apa yang ia kat...','\n        <h2>1. Pentingnya Perilaku Pelatih (Coaching Behavior)</h2>\n        <p>Apa yang pelatih lakukan di pinggir lapangan dan saat sesi latihan jauh lebih berbicara daripada apa yang ia katakan. Perilaku pelatih membentuk budaya tim, mempengaruhi tingkat stres pemain, dan menentukan kualitas penyerapan materi latihan.</p>\n        \n        <h2>2. Gaya Kepelatihan (Coaching Styles)</h2>\n        <p>Pelatih yang adaptif tidak hanya berpegang pada satu gaya. Mereka menyesuaikan gaya kepemimpinan dengan situasi yang dihadapi:</p>\n        <ul>\n            <li><strong>Otokratis (Command Style):</strong> Pelatih membuat semua keputusan. Sangat efektif digunakan saat situasi genting di pertandingan, atau ketika memberikan instruksi teknis yang sangat spesifik dan berkaitan dengan keamanan/keselamatan. Namun, jika digunakan terus-menerus, ini akan mematikan kreativitas dan inisiatif pemain.</li>\n            <li><strong>Demokratis (Co-operative Style):</strong> Melibatkan pemain dalam pengambilan keputusan (misalnya membahas taktik atau peraturan tim). Gaya ini membangun rasa memiliki (ownership) yang kuat pada pemain senior.</li>\n            <li><strong>Laissez-Faire (Submissive Style):</strong> Pelatih memberikan kebebasan penuh kepada pemain. Sangat berguna dalam fase permainan bebas (free play) saat latihan untuk mendorong ekspresi dan observasi natural, namun buruk jika tim butuh arahan struktural.</li>\n        </ul>\n\n        <h2>3. Teknik Komunikasi Efektif</h2>\n        <p>Komunikasi adalah kunci mentransfer visi pelatih ke kepala para pemain.</p>\n        \n        <h3>A. Verbal dan Non-Verbal</h3>\n        <p>Bahasa tubuh (postur, kontak mata, ekspresi wajah) menyumbang porsi terbesar dalam komunikasi. Pelatih yang berdiri tegak dengan sikap terbuka memancarkan kepercayaan diri. Nada suara (intonasi) harus bervariasi: tenang saat menjelaskan taktik, dan penuh energi saat memotivasi.</p>\n        \n        <h3>B. Seni Memberikan Umpan Balik (Feedback)</h3>\n        <ul>\n            <li><strong>Metode Sandwich:</strong> Mulai dengan pujian spesifik -> Berikan koreksi yang diperlukan -> Tutup dengan kalimat motivasi positif.</li>\n            <li><strong>Guided Discovery (Penemuan Terbimbing):</strong> Alih-alih berteriak \"Umpan ke kanan!\", cobalah bertanya \"Di mana ruang kosong yang bisa kamu manfaatkan tadi?\". Ini melatih kemampuan pengambilan keputusan (*decision making*) pemain.</li>\n            <li><strong>Waktu yang Tepat (Timing):</strong> Jangan menghentikan latihan (*freeze*) terlalu sering. Berikan instruksi sambil latihan berjalan (coaching in the flow) kecuali ada kesalahan prinsipil yang berulang.</li>\n        </ul>\n\n        <h2>4. Mendengarkan Aktif (Active Listening)</h2>\n        <p>Pelatih hebat adalah pendengar yang baik. Mereka memperhatikan keluhan pemain, membaca bahasa tubuh yang menunjukkan kelelahan atau frustrasi, dan meresponsnya dengan empati.</p>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:09:40',NULL,NULL,NULL,NULL,'3',86,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL),(8,'Pelatih Dasar Sports Science','pelatih-dasar-sports-science','\n        1. Mengapa Pelatih Butuh Sports Science?\n        Sepakbola modern ditandai dengan intensitas yang sangat tinggi. Perbedaan antara kemenangan dan kekalahan seringkali diten...','\n        <h2>1. Mengapa Pelatih Butuh Sports Science?</h2>\n        <p>Sepakbola modern ditandai dengan intensitas yang sangat tinggi. Perbedaan antara kemenangan dan kekalahan seringkali ditentukan oleh detail kecil pada menit ke-89. Pengetahuan dasar *Sports Science* (Ilmu Keolahragaan) memungkinkan pelatih merancang program yang mengoptimalkan fisik pemain tanpa mengorbankan kesehatan mereka.</p>\n        \n        <h2>2. Fisiologi dan Sistem Energi</h2>\n        <p>Sepakbola adalah olahraga olahraga interval (berhenti-jalan) yang menggunakan berbagai sistem energi tubuh:</p>\n        <ul>\n            <li><strong>Sistem Aerobik:</strong> Menyediakan energi untuk lari santai (jogging) dan daya tahan dasar (stamina) sepanjang 90 menit. Dilatih dengan lari jarak jauh atau *Small Sided Games* (SSG) durasi panjang.</li>\n            <li><strong>Sistem Anaerobik Alaktik (ATP-PC):</strong> Energi instan untuk sprint pendek intensitas maksimal (1-10 detik), seperti saat mengejar bola terobosan. Membutuhkan waktu istirahat yang cukup antar set untuk pemulihan optimal.</li>\n            <li><strong>Sistem Anaerobik Laktat:</strong> Energi untuk aksi intensitas tinggi berulang (10-60 detik) yang menghasilkan asam laktat (rasa pegal/terbakar di otot).</li>\n        </ul>\n        <p>Pelatih harus memadukan latihan teknik dengan beban fisik yang tepat (misalnya: latihan pressing intens menggunakan sistem anaerobik).</p>\n\n        <h2>3. Nutrisi dan Hidrasi</h2>\n        <p>Pelatih harus mengedukasi pemain mengenai bahan bakar tubuh:</p>\n        <ul>\n            <li><strong>Karbohidrat:</strong> Sumber energi utama. Pemain butuh asupan tinggi karbohidrat (pasta, nasi, roti) 1-2 hari sebelum hari pertandingan (carbo-loading).</li>\n            <li><strong>Protein:</strong> Esensial untuk perbaikan serat otot yang rusak setelah latihan keras atau pertandingan (ayam, ikan, telur, susu).</li>\n            <li><strong>Hidrasi:</strong> Kehilangan cairan 2% dari berat badan bisa menurunkan performa fisik dan kognitif hingga 20%. Pemain wajib minum sebelum merasa haus.</li>\n        </ul>\n\n        <h2>4. Pencegahan Cedera (Injury Prevention)</h2>\n        <p>Tugas utama pelatih kebugaran adalah menjaga pemain tetap tersedia untuk dipilih (available).</p>\n        <ul>\n            <li><strong>Pemanasan Dinamis (Dynamic Warm-up):</strong> Menggantikan peregangan statis jadul. Fokus pada mobilitas sendi, aktivasi otot *core*, dan protokol FIFA 11+ terbukti secara sains mengurangi risiko cedera ACL dan hamstring secara signifikan.</li>\n            <li><strong>Monitoring Beban (Load Monitoring):</strong> Mengawasi intensitas latihan pemain melalui *Rate of Perceived Exertion* (RPE) harian atau teknologi GPS tracker untuk mencegah *Overtraining Syndrome*.</li>\n        </ul>\n\n        <h2>5. Recovery (Pemulihan)</h2>\n        <p>Adaptasi fisik (peningkatan kebugaran) tidak terjadi saat latihan, melainkan **saat masa istirahat**. Protokol pemulihan pasca-tanding yang efektif meliputi tidur berkualitas (8-10 jam), *ice bath* (cryotherapy), *active recovery* (bersepeda statis), dan asupan nutrisi jendela 30-60 menit pasca-pertandingan.</p>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:10:40',NULL,NULL,NULL,NULL,'3',33,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL),(9,'Perencanaan Program Latihan','perencanaan-program-latihan','\n        1. Konsep Periodisasi\n        Perencanaan program latihan (periodisasi) adalah seni dan sains dalam membagi waktu latihan ke dalam fase-fase spesifik (siklus) dengan tujua...','\n        <h2>1. Konsep Periodisasi</h2>\n        <p>Perencanaan program latihan (periodisasi) adalah seni dan sains dalam membagi waktu latihan ke dalam fase-fase spesifik (siklus) dengan tujuan memanipulasi beban (volume dan intensitas) agar tim mencapai *peak performance* (performa puncak) pada waktu yang tepat (hari pertandingan kompetisi).</p>\n        \n        <h2>2. Struktur Siklus Latihan</h2>\n        <p>Periodisasi disusun dalam tiga tingkatan waktu:</p>\n        <ul>\n            <li><strong>Makrosiklus (Macrocycle):</strong> Rencana jangka panjang (biasanya 1 musim penuh atau 1 tahun). Terdiri dari fase Persiapan (Pre-season), fase Kompetisi (In-season), dan fase Transisi (Off-season).</li>\n            <li><strong>Mesosiklus (Mesocycle):</strong> Rencana jangka menengah (biasanya 3-6 minggu). Memiliki target spesifik, misalnya: \"Mesosiklus Blok 1 fokus pada peningkatan kapasitas aerobik dasar dan pemahaman prinsip bertahan area (zonal marking).\"</li>\n            <li><strong>Mikrosiklus (Microcycle):</strong> Rencana harian dalam kurun waktu 1 minggu (7 hari). Ini adalah rencana operasional yang paling detail, mengatur persis apa yang dilakukan tim dari Senin hingga Minggu menjelang *Matchday*.</li>\n        </ul>\n\n        <h2>3. Tactical Periodization (Periodisasi Taktikal)</h2>\n        <p>Dipopulerkan oleh pelatih asal Portugal (seperti Jose Mourinho), metodologi ini menolak pemisahan antara latihan fisik, teknik, dan taktik. Semua aspek latihan **harus** berpusat pada Modul Taktikal (Game Model) tim.</p>\n        <p>Misalnya, jika tim ingin bermain menekan di area lawan (high pressing), kapasitas fisik (anaerobik) dilatih melalui simulasi taktis ruang sempit, bukan dengan berlari mengelilingi lapangan tanpa bola.</p>\n\n        <h2>4. Komponen Sesi Latihan (Session Plan)</h2>\n        <p>Setiap sesi harian wajib memiliki struktur baku:</p>\n        <ol>\n            <li><strong>Warm-up (Pemanasan):</strong> Aktivasi suhu tubuh dan sendi, disisipkan elemen kognitif (misal: rondo ringan). Durasi: 15-20 menit.</li>\n            <li><strong>Main Theme (Materi Inti):</strong> Fase latihan terstruktur (drill teknikal menuju taktikal) dan Small Sided Games (SSG) yang intensitasnya disesuaikan dengan topik hari itu. Durasi: 50-70 menit.</li>\n            <li><strong>Match Condition:</strong> Bermain 11v11 atau di area besar untuk mengaplikasikan topik latihan dalam situasi nyata. Durasi: 20-30 menit.</li>\n            <li><strong>Cool-down (Pendinginan):</strong> Peregangan statis ringan dan *briefing* evaluasi singkat. Durasi: 10 menit.</li>\n        </ol>\n\n        <h2>5. Manajemen Beban Mingguan (Tapering)</h2>\n        <p>Pelatih harus mengatur \"ombak\" intensitas. Puncak latihan berat (High Intensity) biasanya berada di tengah minggu (Matchday -4 atau -3). Menjelang hari pertandingan (Matchday -1), beban dan volume harus diturunkan secara drastis (Tapering) agar pemain merasa segar dan bertenaga penuh (fresh) saat bertanding.</p>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:11:40',NULL,NULL,NULL,NULL,'3',52,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL),(10,'Proses Melatih (Sebelum Latihan, Saat Latihan, & Setelah Latihan)','proses-melatih-sebelum-latihan-saat-latihan-setelah-latihan','\n        1. Siklus Kepelatihan Paripurna\n        Kepelatihan bukan hanya tentang apa yang diteriakkan pelatih selama 90 menit di lapangan. Ini adalah sebuah siklus panjang yang men...','\n        <h2>1. Siklus Kepelatihan Paripurna</h2>\n        <p>Kepelatihan bukan hanya tentang apa yang diteriakkan pelatih selama 90 menit di lapangan. Ini adalah sebuah siklus panjang yang menuntut persiapan matang, eksekusi presisi, dan evaluasi mendalam.</p>\n        \n        <h2>2. Fase SEBELUM Latihan (Preparation)</h2>\n        <p>Persiapan yang buruk adalah persiapan untuk gagal. Langkah-langkah krusial sebelum peluit dibunyikan:</p>\n        <ul>\n            <li><strong>Menentukan Tujuan (Objective):</strong> Apa fokus utama hari ini? (Contoh: \"Meningkatkan kemampuan penetrasi melalui sayap kanan\").</li>\n            <li><strong>Membuat Rencana Sesi (Session Plan):</strong> Mencatat detail durasi, ukuran lapangan, jumlah pemain, batasan sentuhan (rules/constraints), dan intensitas (work:rest ratio).</li>\n            <li><strong>Menyiapkan Peralatan (Equipment):</strong> Memastikan bola cukup dan dipompa dengan benar, cone (kun), rompi (bibs) warna-warni sudah tersusun rapi di lapangan **sebelum** pemain tiba.</li>\n            <li><strong>Briefing Staf:</strong> Berdiskusi dengan asisten pelatih dan pelatih fisik mengenai peran masing-masing selama sesi.</li>\n        </ul>\n\n        <h2>3. Fase SAAT Latihan (Execution)</h2>\n        <p>Fase di mana rencana diterjemahkan menjadi tindakan nyata.</p>\n        <ul>\n            <li><strong>Ice Breaking & Pengarahan (Briefing):</strong> Mengumpulkan pemain (dalam formasi setengah lingkaran), sampaikan tujuan latihan hari itu dengan singkat dan padat (maksimal 2 menit).</li>\n            <li><strong>Observasi & Fasilitasi:</strong> Pelatih mundur selangkah (step back) untuk mengamati pergerakan makro. Biarkan permainan mengalir. Jangan terlalu sering meniup peluit jika tidak darurat.</li>\n            <li><strong>Intervensi (Coaching Points):</strong> Jika terjadi kesalahan prinsipil secara berulang, bekukan latihan (*freeze!*). Tunjukkan posisi yang salah, tunjukkan posisi yang benar, peragakan (rehearse), lalu lanjutkan (*play!*).</li>\n            <li><strong>Manajemen Dinamika:</strong> Menjaga tempo latihan tetap tinggi, menyemangati pemain yang lesu, dan menenangkan pemain yang terlalu emosional.</li>\n        </ul>\n\n        <h2>4. Fase SETELAH Latihan (Evaluation & Recovery)</h2>\n        <p>Latihan tidak selesai saat bola terakhir ditendang.</p>\n        <ul>\n            <li><strong>Debriefing Singkat:</strong> Sembari pemain melakukan peregangan statis (cooling down), pelatih merangkum esensi latihan hari itu. Ucapkan terima kasih atas usaha mereka.</li>\n            <li><strong>Recovery Fisik:</strong> Memastikan pemain mengonsumsi suplemen/nutrisi pasca latihan atau menuju fasilitas *ice bath* jika diperlukan.</li>\n            <li><strong>Evaluasi Staf (Post-Mortem):</strong> Duduk bersama staf pelatih. Apakah tujuan tercapai? Apakah area latihan terlalu sempit? Pemain mana yang menonjol dan mana yang butuh perhatian ekstra besok? Evaluasi ini menjadi dasar untuk merencanakan latihan berikutnya.</li>\n        </ul>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:12:40',NULL,NULL,NULL,NULL,'3',57,0,'2026-07-11 02:06:40','2026-07-11 02:11:30',NULL),(11,'Refleksi dan Evaluasi','refleksi-dan-evaluasi','\n        1. Signifikansi Refleksi Diri\n        Pengalaman selama 20 tahun melatih tidak akan ada gunanya jika pelatih mengulangi kesalahan yang sama setiap tahunnya. Refleksi dan e...','\n        <h2>1. Signifikansi Refleksi Diri</h2>\n        <p>Pengalaman selama 20 tahun melatih tidak akan ada gunanya jika pelatih mengulangi kesalahan yang sama setiap tahunnya. Refleksi dan evaluasi adalah motor penggerak perbaikan berkelanjutan (continuous improvement). Pelatih hebat selalu memiliki kerendahan hati untuk mengakui bahwa pendekatan mereka mungkin tidak selalu sempurna.</p>\n        \n        <h2>2. Evaluasi Sesi Latihan (Self-Reflection)</h2>\n        <p>Setelah selesai memimpin latihan, seorang pelatih profesional wajib meluangkan waktu 10-15 menit untuk merefleksikan proses pedagoginya:</p>\n        <ul>\n            <li><strong>Keselarasan Tujuan:</strong> Apakah aktivitas yang dirancang benar-benar mencapai target pembelajaran yang ditetapkan sebelumnya?</li>\n            <li><strong>Rasio Berbicara vs Bermain:</strong> Apakah saya terlalu banyak bicara hari ini? (Jika pemain berdiri terlalu lama mendengarkan instruksi, detak jantung mereka akan turun dan latihan menjadi tidak efisien).</li>\n            <li><strong>Ketepatan Intervensi:</strong> Apakah *coaching points* yang saya berikan sudah jelas, ringkas, dan tepat sasaran? Apakah bahasa tubuh saya menunjukkan energi positif?</li>\n        </ul>\n\n        <h2>3. Evaluasi Pertandingan (Match Analysis)</h2>\n        <p>Emosi sesaat pasca-pertandingan (baik saat menang besar maupun kalah telak) seringkali mengaburkan penilaian objektif. Proses evaluasi yang benar melibatkan data dan objektivitas.</p>\n        <ul>\n            <li><strong>Analisis Video (Video Review):</strong> Menonton ulang pertandingan dengan pikiran tenang keesokan harinya. Memotong momen-momen kunci (baik positif maupun negatif) untuk dipertontonkan kepada tim dalam sesi analisis taktik kelas.</li>\n            <li><strong>Analisis Data & Statistik:</strong> Menggunakan data seperti *Expected Goals* (xG), jumlah *key passes*, duel udara yang dimenangkan, hingga jarak tempuh berlari pemain. Data ini melengkapi pengamatan mata (eye-test).</li>\n            <li><strong>Evaluasi Game Model:</strong> Menilai apakah implementasi taktik dan filosofi tim berjalan di lapangan, tanpa terdistraksi sepenuhnya oleh hasil akhir (skor). Kadang tim bermain luar biasa sesuai rencana, namun kalah karena ketidakberuntungan (margin error kecil).</li>\n        </ul>\n\n        <h2>4. Umpan Balik dari Pemain (Player Feedback)</h2>\n        <p>Evaluasi tidak hanya berjalan top-down (dari pelatih ke pemain), tapi juga bottom-up. Membuka saluran komunikasi (misalnya melalui kuesioner anonim atau pertemuan empat mata kapten tim) untuk mengetahui apa yang dirasakan pemain tentang intensitas latihan, kejelasan instruksi, dan suasana ruang ganti. Pemain yang merasa suaranya didengar akan memberikan komitmen ekstra di lapangan.</p>\n    ','modul-kepelatihan',NULL,'Coach Agam',1,'published','2026-07-11 02:13:40',NULL,NULL,NULL,NULL,'3',78,0,'2026-07-11 02:06:40','2026-07-11 02:10:43',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_banks`
--

DROP TABLE IF EXISTS `question_banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_banks_event_id_foreign` (`event_id`),
  CONSTRAINT `question_banks_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_banks`
--

LOCK TABLES `question_banks` WRITE;
/*!40000 ALTER TABLE `question_banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` bigint unsigned NOT NULL,
  `type` enum('multiple_choice','essay') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'multiple_choice',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_image_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` longtext COLLATE utf8mb4_unicode_ci,
  `score` decimal(8,2) NOT NULL DEFAULT '1.00',
  `negative_score` decimal(8,2) NOT NULL DEFAULT '0.00',
  `difficulty` enum('easy','medium','hard') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_bank_id_difficulty_index` (`bank_id`,`difficulty`),
  KEY `questions_bank_id_type_index` (`bank_id`,`type`),
  CONSTRAINT `questions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `question_banks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `round_banks`
--

DROP TABLE IF EXISTS `round_banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `round_banks` (
  `round_id` bigint unsigned NOT NULL,
  `bank_id` bigint unsigned NOT NULL,
  `question_count` int NOT NULL DEFAULT '10',
  PRIMARY KEY (`round_id`,`bank_id`),
  KEY `round_banks_bank_id_foreign` (`bank_id`),
  CONSTRAINT `round_banks_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `question_banks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `round_banks_round_id_foreign` FOREIGN KEY (`round_id`) REFERENCES `rounds` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `round_banks`
--

LOCK TABLES `round_banks` WRITE;
/*!40000 ALTER TABLE `round_banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `round_banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rounds`
--

DROP TABLE IF EXISTS `rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rounds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int NOT NULL DEFAULT '1',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `duration_minutes` int NOT NULL DEFAULT '60',
  `max_questions` int NOT NULL DEFAULT '30',
  `passing_score` decimal(5,2) DEFAULT NULL,
  `randomize_questions` tinyint(1) NOT NULL DEFAULT '1',
  `randomize_options` tinyint(1) NOT NULL DEFAULT '1',
  `allow_review` tinyint(1) NOT NULL DEFAULT '1',
  `warning_threshold` int NOT NULL DEFAULT '3',
  `auto_submit_threshold` int NOT NULL DEFAULT '5',
  `status` enum('upcoming','ongoing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upcoming',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rounds_event_id_sequence_index` (`event_id`,`sequence`),
  CONSTRAINT `rounds_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rounds`
--

LOCK TABLES `rounds` WRITE;
/*!40000 ALTER TABLE `rounds` DISABLE KEYS */;
/*!40000 ALTER TABLE `rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kunci unik setting, e.g. homepage.hero_slides',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general' COMMENT 'Kelompok: general, homepage, seo, contact',
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text' COMMENT 'Tipe: text, textarea, json, boolean, image',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Label untuk tampilan admin',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Apakah setting bisa diakses publik via helper',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`),
  KEY `site_settings_group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'homepage.hero_slides','homepage','[{\"headline\":\"Ahmad Agam Haris Pambudi<br><b>Pelatih Sepakbola Profesional Indonesia<\\/b>\",\"subheadline\":\"LISENSI A - AFC | 4-3-3 ATTACKING\",\"cta_text\":\"Lihat Profil\",\"cta_link\":\"\\/profil-coach-agam\",\"trusted_text\":\"9+ Klub & Tim Nasional Indonesia\",\"image\":\"slides\\/IWrXcyLMWzINDGbLHZpYDGFrtweNqFHTJWsSZkLF.webp\",\"background\":\"slides\\/FEIk7L0fGaw7QCV7IgKt8ARHxYTIq4eVbwbFXtDZ.webp\",\"trusted_image_1\":\"slides\\/corrt0lDjjV4atpaPalmGK2pHdlCCXj3mktDu0qw.webp\",\"trusted_image_2\":\"slides\\/W6j6SwrBmVYFPZ22M3lBfcpi4SREqyV5PQ7yntt9.webp\",\"trusted_image_3\":\"slides\\/PnxRCaIJg4DnXI1LJjsRUViR0Vnvfm7MkfUuzydI.webp\"},{\"headline\":\"Dedikasi, Disiplin,<br><b>& Pengembangan Berkelanjutan<\\/b>\",\"subheadline\":\"BORNEO FC U20 | DELTRAS FC | GARUDAYAKSA FC\",\"cta_text\":\"Riwayat Karir\",\"cta_link\":\"\\/profil-coach-agam\",\"trusted_text\":\"Berkarir sejak 2019 di Liga Sepakbola Indonesia\",\"image\":\"slides\\/2LXezzrAFRUSkMQ3OvMZjGpa33Mj6E2KlnDhCJ5N.webp\",\"background\":\"slides\\/hEBtbieo2trtMVG042A4jemsSJ5UUS3w6pIi0TCE.webp\",\"trusted_image_1\":null,\"trusted_image_2\":null,\"trusted_image_3\":null}]','json','Hero Slides','Array slide hero (JSON). Setiap slide: tagline, title, subtitle, cta_label, cta_href, cta2_label, cta2_href, image_icon, image_text.',1,'2026-06-25 20:22:00','2026-06-26 20:43:58'),(2,'homepage.about_tagline','homepage','Membangun Juara Dari Dalam Lapangan','text','About — Tagline / Heading Utama',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(3,'homepage.about_bio_1','homepage','Coach Agam adalah pelatih sepakbola profesional bersertifikat dengan rekam jejak lebih dari satu dekade dalam mengembangkan pemain dari berbagai tingkatan — dari junior hingga profesional.','textarea','About — Bio Paragraf 1',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(4,'homepage.about_bio_2','homepage','Dengan filosofi \"Develop the Player, Build the Character\", Coach Agam tidak hanya melatih teknik sepakbola, tetapi juga membangun mentalitas juara, kedisiplinan, dan kerja sama tim yang solid.','textarea','About — Bio Paragraf 2 / Filosofi',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(5,'homepage.about_years_exp','homepage','10+','text','About — Tahun Pengalaman',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(6,'homepage.about_athletes_count','homepage','500+','text','About — Jumlah Atlet Dibina',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(7,'homepage.about_certifications','homepage','AFC B License,PSSI Level II,UEFA Pro Certified,S&C Specialist','text','About — Sertifikasi (pisah koma)',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(8,'homepage.cta_heading','homepage','Siap Membawa Tim Anda ke Level Berikutnya?','text','CTA — Judul Utama',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(9,'homepage.cta_description','homepage','Apakah Anda tim sepakbola, akademi, atau sponsor yang ingin berkolaborasi? Coach Agam terbuka untuk berbagai bentuk kerjasama profesional.','textarea','CTA — Deskripsi',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(10,'contact.whatsapp_number','contact','6281234567890','text','Nomor WhatsApp (format internasional)',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(11,'contact.whatsapp_message','contact','Halo Coach Agam, saya ingin mengetahui lebih lanjut tentang program pelatihan.','textarea','Pesan Default WhatsApp',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(12,'contact.email','contact','info@coachagam.com','text','Email Kontak',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(13,'contact.location','contact','Sidoarjo, Jawa Timur','text','Lokasi',NULL,1,'2026-06-25 20:22:00','2026-06-26 16:22:55'),(14,'seo.site_title','seo','Coach Agam | Pelatih Sepakbola Profesional Indonesia','text','Site Title (untuk meta title)',NULL,1,'2026-06-25 20:22:00','2026-07-10 08:56:39'),(15,'seo.site_description','seo','Coach Agam adalah pelatih sepakbola profesional berpengalaman di Indonesia. Spesialisasi pengembangan pemain muda, analisis taktik, dan program latihan berbasis data ilmiah.','textarea','Site Meta Description',NULL,1,'2026-06-25 20:22:00','2026-06-25 20:22:00'),(16,'hero_headline','general',NULL,'text',NULL,NULL,1,'2026-06-25 20:57:49','2026-06-25 20:57:49'),(17,'hero_subheadline','general',NULL,'text',NULL,NULL,1,'2026-06-25 20:57:49','2026-06-25 20:57:49'),(18,'hero_cta_text','general',NULL,'text',NULL,NULL,1,'2026-06-25 20:57:49','2026-06-25 20:57:49'),(19,'hero_cta_link','general',NULL,'text',NULL,NULL,1,'2026-06-25 20:57:49','2026-06-25 20:57:49'),(20,'general.logo','general','settings/XcvvmLiQF4mFFi00yQsPSon6Ty5latJGpdyCqKaf.webp','text',NULL,NULL,1,'2026-06-25 21:13:54','2026-07-10 04:15:29'),(21,'general.favicon','general','settings/KN92Ubw6wamzdbokxGZ6MZ8QZ8AlLdLiJ1HVNIU8.png','text',NULL,NULL,1,'2026-06-25 21:14:13','2026-06-25 21:14:13'),(22,'seo.og_image','general','settings/4hNHaRixHHHu2KZdT1dYc1DOqbjK73CzxRb5suVA.webp','text',NULL,NULL,1,'2026-06-25 21:14:18','2026-06-25 22:40:23'),(23,'page_profile.timelines','page_profile','[{\"year\":\"2026 - 2027\",\"title\":\"Assistant Coach\",\"club_name\":\"PSIS Semarang\",\"description\":\"Liga 1 Indonesia\",\"club_logo\":\"profile\\/zMQxB88WjxPcdcOycYTZkhFWfTXIDmoFfnVMIrH0.webp\"},{\"year\":\"2026\",\"title\":\"Assistant Coach\",\"club_name\":\"Garudyakasa FC\",\"description\":null,\"club_logo\":\"profile\\/5HpZvsEG3UXjwStNuwjcdGMaTEhzjABFmPu5SF3g.webp\"},{\"year\":\"2025 - 2026\",\"title\":\"Direktur Teknik Akademi & Assistant Coach\",\"club_name\":\"Deltras FC\",\"description\":\"Champions Liga 2 Pegadaian Championship 2025-2026\",\"club_logo\":\"profile\\/4W5lVHmjqMmrEgbB0UO60D1pYfEW9M0mP8Q92pvU.webp\"},{\"year\":\"2024 - 2025\",\"title\":\"Head Coach\",\"club_name\":\"Borneo FC Samarinda U20\",\"description\":null,\"club_logo\":\"profile\\/d1jk8eqIyWYcsnSTsscGYNbaoTf1eIQ7mATMW6aa.webp\"},{\"year\":\"2024\",\"title\":\"Assistant Coach\",\"club_name\":\"Football Team PON East Java\",\"description\":\"Champions Gold Medals PON Aceh-Sumut 2024\",\"club_logo\":\"profile\\/qFIgtWAdGrX3D4DUiyoHfc3Ib3jBagtE5fkfjmrr.webp\"},{\"year\":\"2023 - 2024\",\"title\":\"Head Coach & Technical Director\",\"club_name\":\"Al Wehda Womens (Saudi Arabia)\",\"description\":null,\"club_logo\":\"profile\\/eG1yOBPEmcCIw5bPVtjplDPEyke6abD6lNVceTNk.webp\"},{\"year\":\"2023 - 2024\",\"title\":\"Head Coach U10 & U17\",\"club_name\":\"Jeddah Pro Football Academy (Saudi Arabia)\",\"description\":null,\"club_logo\":\"profile\\/AWDS1mu90DhFjZqDKRUGDNf5HCktYaNsBNgv45Sa.webp\"},{\"year\":\"2022 - 2023\",\"title\":\"Assistant Coach\",\"club_name\":\"PERSEWAR Waropen FC\",\"description\":\"Indonesia League 2\",\"club_logo\":\"profile\\/v7k1q8FcBRT2IHcZcUOGoucoOQqtaAgf9uBqpkki.webp\"},{\"year\":\"2021 - 2022\",\"title\":\"Assistant Coach\",\"club_name\":\"Hizbul Wathan FC\",\"description\":\"Indonesia League 2\",\"club_logo\":\"profile\\/bfSXxEERfVLno5iK14Ame1aeTM2janfHvL6aDWSr.webp\"},{\"year\":\"2020 - 2021\",\"title\":\"Physical Coach\",\"club_name\":\"KONI East Java\",\"description\":null,\"club_logo\":\"profile\\/6J7HYdfkbDNqtrvEB3mp4oC5P6QEe1AYUqvgeYKa.webp\"},{\"year\":\"2019\",\"title\":\"Head Coach\",\"club_name\":\"PERSPIN Pinrang\",\"description\":\"Champions Indonesia League 3 South Sulawesi\",\"club_logo\":\"profile\\/8NJcM0NrzhwamjGhSNJEB1B4JdP0pcKxF9ySV0l6.webp\"},{\"year\":\"2013-2015\",\"title\":\"CEO & Founder\",\"club_name\":\"Physical Fitness Test (PFT)\",\"description\":null,\"club_logo\":\"profile\\/Wod0d42jYfaUNibuITZrckK0LADtIfwROuqqZ7Tz.webp\"},{\"year\":\"2015-2017\",\"title\":\"Manager\",\"club_name\":\"PT 20 FIT West Surabaya\",\"description\":null,\"club_logo\":\"profile\\/SJs5A245cz7RqpHuvNvEBbGSRqTuyNzwdOrcrIUQ.webp\"},{\"year\":\"2017-2019\",\"title\":\"Business Partner & Personal Trainer\",\"club_name\":\"Personal Trainer\",\"description\":null,\"club_logo\":\"profile\\/IUY7zdDSVBvXYO9Z0l9B9qETwsw3ZrCArLTXJopY.webp\"},{\"year\":\"2014\",\"title\":\"Head Coach\",\"club_name\":\"Surabaya State University Football Club\",\"description\":null,\"club_logo\":\"profile\\/jn5WWmD4ccn2JHJu1O0U82U4J86Veyk6qEQdqLVS.webp\"},{\"year\":\"2014\",\"title\":\"Head Coach U10\",\"club_name\":\"Realmadrid School Sidoarjo\",\"description\":null,\"club_logo\":\"profile\\/8db7qctv5IN748o1KxZSbrSKGQuoyb5iMZgRkrf7.webp\"},{\"year\":\"2018\",\"title\":\"Head Coach U10\",\"club_name\":\"Surabaya Soccer Academy\",\"description\":null,\"club_logo\":\"profile\\/aq98el2VlMTSvbn4Tt9oUJWi3x09O2NSWMBLIGqF.webp\"},{\"year\":\"2021\",\"title\":\"Physical Coach\",\"club_name\":\"PT Pertamina Marketing Operation Region V Surabaya\",\"description\":null,\"club_logo\":\"profile\\/Sx02IgjM6OPZ6q97Bt3skIIDPOKEVWqEnQpYpjAM.webp\"}]','json',NULL,NULL,1,'2026-06-25 21:41:51','2026-06-26 18:13:59'),(24,'page_profile.meta_title','page_profile','Profil Coach Agam — Agam Haris Pambudi, S.Pd., M.Kes.','text',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-26 16:43:53'),(25,'page_profile.meta_description','page_profile','Profil lengkap Agam Haris Pambudi, S.Pd., M.Kes. Pelatih profesional berlisensi AFC A dengan latar belakang kuat di sport science. Berpengalaman di Liga Indonesia dan Arab Saudi.','text',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-26 16:43:53'),(26,'page_profile.headline','page_profile','Membentuk Karakter & Mental Juara','text',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-25 22:30:08'),(27,'page_profile.subheadline','page_profile','PROFIL PELATIH','text',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-25 21:48:29'),(28,'page_profile.description_1','page_profile','Agam Haris Pambudi, S.Pd., M.Kes. adalah pelatih sepakbola profesional berlisensi AFC A asal Lamongan, Indonesia. Berlatar belakang akademis yang kuat dari S1 hingga S3 (On Going) di bidang Ilmu Keolahragaan dan Kesehatan Olahraga, Coach Agam memadukan sport science modern dengan pengalaman praktis di lapangan.','text',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-26 16:43:53'),(29,'page_profile.description_2','page_profile','Memiliki pengalaman luas mulai dari pembinaan usia muda, asisten pelatih di Liga 2, hingga pelatih kepala di luar negeri (Saudi Arabia). Prestasi terbarunya termasuk medali Emas PON Aceh-Sumut 2024 bersama Timnas PON Jatim dan menjuarai Liga 2 Pegadaian Championship 2025-2026.','text',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-26 16:43:53'),(30,'page_profile.infos','page_profile','[{\"label\":\"Nama Lengkap\",\"value\":\"Agam Haris Pambudi, S.Pd., M.Kes.\"},{\"label\":\"Tempat\\/Tanggal Lahir\",\"value\":\"Lamongan, 18 Juli 1993\"},{\"label\":\"Domisili\",\"value\":\"Balongbendo, Sidoarjo, Jawa Timur\"},{\"label\":\"Lisensi Kepelatihan\",\"value\":\"Lisensi A — AFC (2022)\"},{\"label\":\"Agama\",\"value\":\"Muslim\"},{\"label\":\"Status\",\"value\":\"Menikah\"},{\"label\":\"Pendidikan Terakhir\",\"value\":\"S3 Ilmu Keolahragaan UNESA (On Going)\"},{\"label\":\"Kontak\",\"value\":\"+62857 3041 6157 | agamharis33@gmail.com\"}]','json',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-26 16:43:53'),(31,'page_profile.socials','page_profile','[{\"platform\":\"Instagram\",\"link\":\"https:\\/\\/instagram.com\\/coach.ahp\"}]','json',NULL,NULL,1,'2026-06-25 21:48:29','2026-06-26 17:19:28'),(32,'page_profile.image','page_profile','profile/bpUSxPqlvkOboYtzr9pBaJkyafojzb4ZwFauSpda.webp','text',NULL,NULL,1,'2026-06-25 22:31:10','2026-06-25 22:40:23'),(33,'page_modul.meta_title','page_modul','Modul Kepelatihan | Coach Agam','text',NULL,NULL,1,'2026-06-26 05:23:25','2026-06-26 05:23:25'),(34,'page_modul.meta_description','page_modul',NULL,'text',NULL,NULL,1,'2026-06-26 05:23:25','2026-06-26 05:23:25'),(35,'page_modul.headline','page_modul','Modul Kepelatihan','text',NULL,NULL,1,'2026-06-26 05:23:25','2026-06-26 05:23:25'),(36,'page_modul.subheadline','page_modul',NULL,'text',NULL,NULL,1,'2026-06-26 05:23:25','2026-06-26 05:23:25'),(37,'page_modul.breadcrumb_image','page_modul','pages/0LJ46UPTjfIYruBNHGFEugierG5Sqorn6NNvRdbD.webp','image',NULL,NULL,1,'2026-06-26 05:23:26','2026-06-26 05:23:26'),(38,'general.cta_image','general','settings/t5EyTUPeDXlHWK8IKjZrjtQuxgYzFbbK0Xd8I5Kc.webp','text',NULL,NULL,1,'2026-06-26 05:25:42','2026-06-26 05:28:59'),(39,'blog.categories','blog','[{\"id\":\"6a3ea89289efa\",\"name\":\"Sport Science\",\"slug\":\"sport-science\"},{\"id\":\"6a3ea89289efd\",\"name\":\"Materi Kepelatihan\",\"slug\":\"materi-kepelatihan\"},{\"id\":\"6a3ea89289efe\",\"name\":\"Filosofi & Spiritualitas\",\"slug\":\"filosofi-spiritualitas\"},{\"id\":\"6a520959c2648\",\"name\":\"Modul Kepelatihan\",\"slug\":\"modul-kepelatihan\"}]','json',NULL,NULL,1,'2026-06-26 09:22:14','2026-07-11 02:14:01'),(40,'page_gallery.items','page_gallery','[{\"image\":\"gallery\\/Of58c9kjFez6aUahDA6QRjj8kJwscIDZhkZEfPZF.webp\",\"alt\":\"Garudayaksa FC\",\"caption\":\"Garudayaksa FC\"},{\"image\":\"gallery\\/KlSOUq7de8vlkHBJwBL8RxbEarfqxs2SyAi7qoeB.webp\",\"alt\":\"Garudayaksa FC\",\"caption\":\"Garudayaksa FC\"},{\"image\":\"gallery\\/77NMWI42DLwyE1KLXfvr87V2Zed3XDipnOvVPSOf.webp\",\"alt\":\"Garudayaksa FC\",\"caption\":\"Garudayaksa FC\"},{\"image\":\"gallery\\/yfXFUSZ4ux1SD6IxtKz6EuQeTipTI5C8p85igMYT.webp\",\"alt\":\"Garudayaksa FC\",\"caption\":\"Garudayaksa FC\"}]','json',NULL,NULL,1,'2026-06-26 12:24:30','2026-06-26 14:17:17'),(41,'page_gallery.meta_title','page_gallery',NULL,'text',NULL,NULL,1,'2026-06-26 13:00:56','2026-06-26 13:00:56'),(42,'page_gallery.meta_description','page_gallery',NULL,'text',NULL,NULL,1,'2026-06-26 13:00:56','2026-06-26 13:00:56'),(43,'page_gallery.headline','page_gallery','Galeri Foto','text',NULL,NULL,1,'2026-06-26 13:00:56','2026-06-26 13:00:56'),(44,'page_gallery.subheadline','page_gallery',NULL,'text',NULL,NULL,1,'2026-06-26 13:00:56','2026-06-26 13:00:56'),(45,'page_profile.tm_link','page_profile','https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024','text',NULL,NULL,1,'2026-06-26 14:11:24','2026-06-26 14:11:24'),(46,'page_profile.tm_logo','page_profile','profile/dqPYGUVlrMTQA2mZRalQ8INO9ho2Qzebi0CObyas.webp','text',NULL,NULL,1,'2026-06-26 14:11:25','2026-06-26 14:11:25'),(47,'page_ahp_training.hero_title','page_ahp_training','AHP Training','text',NULL,NULL,1,'2026-06-26 15:14:37','2026-06-26 15:14:37'),(48,'page_ahp_training.hero_subtitle','page_ahp_training','Program Pelatihan Sepakbola Profesional','text',NULL,NULL,1,'2026-06-26 15:14:37','2026-06-26 15:14:37'),(49,'homepage.hero_shape_color1','homepage','#ffffff','text',NULL,NULL,1,'2026-06-26 16:11:49','2026-06-26 16:11:49'),(50,'homepage.hero_shape_color2','homepage','#a1a1a1','text',NULL,NULL,1,'2026-06-26 16:11:49','2026-06-26 20:48:21'),(51,'homepage.hero_star_color','homepage','#a1a1a1','text',NULL,NULL,1,'2026-06-26 16:11:49','2026-06-26 20:48:27'),(52,'page_profile.educations','page_profile','[{\"year\":null,\"institution\":\"Sekolah Dasar Negeri 1 Bakalrejo\",\"degree\":\"SD\",\"logo\":\"profile\\/IIBipApkagIAMNVXnR2C4PDko5VjDmy486Ce4XfW.webp\"},{\"year\":null,\"institution\":\"SMP Negeri 1 Sugio\",\"degree\":\"SMP\",\"logo\":\"profile\\/0XqfTvu0vaqQXRGbr26hDBdWlGrXL1GYFPi9ckdN.webp\"},{\"year\":null,\"institution\":\"SMA Negeri 1 Kedungpring\",\"degree\":\"SMA\",\"logo\":\"profile\\/CYSILMgLRFJTNWRwEQKJ9A0CYua1Js12EiEtNA1o.webp\"},{\"year\":null,\"institution\":\"Universitas Negeri Surabaya\",\"degree\":\"S1 Pendidikan Kepelatihan Olahraga\",\"logo\":\"profile\\/71PAqbe8975pg5kcG8xYu0FcNhLz49vjj27Mfsyy.webp\"},{\"year\":null,\"institution\":\"Universitas Airlangga Surabaya\",\"degree\":\"S2 Ilmu Kesehatan Olahraga\",\"logo\":\"profile\\/e7pIpAgUaEYjA0M1jeur6KZ6x4tFrtRHoJccK9r0.webp\"},{\"year\":\"On Going\",\"institution\":\"Universitas Negeri Surabaya\",\"degree\":\"S3 Ilmu Keolahragaan\",\"logo\":\"profile\\/csJ8EGDmqnWq2QSytuErzrCQ39DnePmaXBxSliSA.webp\"}]','json',NULL,NULL,1,'2026-06-26 16:48:32','2026-06-26 18:15:58'),(53,'page_profile.certifications','page_profile','[{\"year\":\"2012\",\"title\":\"Latihan Keterampilan Managemen Mahasiswa (Tingkat Menengah)\",\"logo\":null},{\"year\":\"2014\",\"title\":\"Latihan Keterampilan Managemen Mahasiswa (Tingkat Atas atau Kader Bangsa)\",\"logo\":null},{\"year\":\"2014\",\"title\":\"Pelatih Sepakbola Lisensi D PSSI\",\"logo\":null},{\"year\":\"2018\",\"title\":\"Pelatih Sepakbola Lisensi C Diploma PSSI \\/ AFC\",\"logo\":null},{\"year\":\"2020\",\"title\":\"Pelatih Sepakbola Lisensi B Diploma PSSI \\/ AFC\",\"logo\":null},{\"year\":\"2022\",\"title\":\"Pelatih Sepakbola Lisensi A Diploma PSSI \\/ AFC\",\"logo\":null},{\"year\":null,\"title\":\"Premier Skills (England) – Supporting Women\'s Football\",\"logo\":null},{\"year\":null,\"title\":\"Harvard Medical School – COVID Safe Sport Coach & Recovery from COVID-19\",\"logo\":null},{\"year\":\"2026\",\"title\":\"FIFA Safeguarding Workshop\",\"logo\":null}]','json',NULL,NULL,1,'2026-06-26 16:48:32','2026-06-26 18:06:56'),(54,'page_profile.organizations','page_profile','[{\"year\":null,\"role\":\"Bidang Olahraga dan Seni\",\"organization\":\"OSIS SMA N 1 Kedungpring\",\"logo\":null},{\"year\":null,\"role\":\"Ketua\",\"organization\":\"Dewan Ambalan Penegak Pramuka SMA N 1 Kedungpring\",\"logo\":null},{\"year\":\"2012\",\"role\":\"Sekretaris\",\"organization\":\"BEM Jurusan Pendidikan Kepelatihan Olahraga\",\"logo\":null},{\"year\":\"2013\",\"role\":\"Ketua\",\"organization\":\"BEM Jurusan Pendidikan Kepelatihan Olahraga\",\"logo\":null},{\"year\":\"2014\",\"role\":\"Ketua\",\"organization\":\"BEM Fakultas Ilmu Keolahragaan\",\"logo\":null},{\"year\":\"2014\",\"role\":\"Ketua\",\"organization\":\"BEM Universitas Negeri Surabaya\",\"logo\":null},{\"year\":\"2025-2026\",\"role\":\"Bidang Kepelatihan\",\"organization\":\"PSSI Kabupaten Sidoarjo\",\"logo\":null},{\"year\":\"2026\",\"role\":\"Bidang Kompetisi\",\"organization\":\"PSSI Propinsi Jawa Timur\",\"logo\":null},{\"year\":\"2024-2027\",\"role\":\"Bendahara\",\"organization\":\"Asosiasi Pelatih Sepakbola Seluruh Indonesia Jawa Timur\",\"logo\":null}]','json',NULL,NULL,1,'2026-06-26 16:48:32','2026-06-26 18:06:56'),(55,'page_profile.achievements','page_profile','[{\"year\":\"2010\",\"title\":\"Runner Up Run 400M\",\"logo\":null},{\"year\":\"2011\",\"title\":\"Runner Up Hockey Piala KONI Surabaya\",\"logo\":null},{\"year\":\"2012\",\"title\":\"Champion of Porkab Lamongan Soccer\",\"logo\":null},{\"year\":\"2014\",\"title\":\"Third Place Jakarta State University National Championship\",\"logo\":null},{\"year\":\"2014\",\"title\":\"Champions Brawijaya National Championship\",\"logo\":null},{\"year\":\"2015\",\"title\":\"Top 3 The Best Graduate Sport Coaching Education\",\"logo\":null},{\"year\":\"2019\",\"title\":\"Champions Indonesia League 3 South Sulawesi\",\"logo\":null},{\"year\":\"2024\",\"title\":\"Champions Gold Medals PON Aceh-Sumut 2024\",\"logo\":null},{\"year\":\"2025-2026\",\"title\":\"Champions Liga 2 Pegadaian Championship\",\"logo\":null}]','json',NULL,NULL,1,'2026-06-26 16:48:32','2026-06-26 18:06:56'),(56,'socials','page_profile','[{\"platform\":\"Instagram\",\"link\":\"https:\\/\\/instagram.com\\/coach.ahp\"}]','text',NULL,NULL,1,'2026-06-26 17:17:51','2026-06-26 17:17:51'),(57,'general.breadcrumb_image','general','settings/VKvrsjCt2aMW8yMPcoIE5PG6VWmG1JFtSae1B1UG.webp','text',NULL,NULL,1,'2026-06-26 17:54:51','2026-06-26 20:46:46'),(58,'general.address','general','Sidoarjo - Jawa Timur','text',NULL,NULL,1,'2026-06-27 06:10:08','2026-07-10 08:42:16'),(59,'page_ahp_training.about_text','page_ahp_training','123','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-07-10 09:09:18'),(60,'page_ahp_training.player_bg','page_ahp_training','uploads/ahp/1UDgk0KAZ1QZjp9aj7vbu4Zyx6jHqNxHBXZ3ErLR.jpg','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(61,'page_ahp_training.pretest_title','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(62,'page_ahp_training.pretest_desc','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(63,'page_ahp_training.volume_title','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(64,'page_ahp_training.volume_desc','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(65,'page_ahp_training.eval_title','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(66,'page_ahp_training.eval_desc','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(67,'page_ahp_training.posttest_title','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(68,'page_ahp_training.posttest_desc','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(69,'page_ahp_training.report_title','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(70,'page_ahp_training.report_desc','page_ahp_training','','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(71,'page_ahp_training.programs','page_ahp_training','[]','text',NULL,NULL,1,'2026-06-27 07:38:33','2026-06-27 07:38:33'),(72,'page_ahp_training.intro_headline_bold','page_ahp_training','Agility. Heading.','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(73,'page_ahp_training.intro_headline_thin','page_ahp_training','Training Terstruktur','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(74,'page_ahp_training.intro_eyebrow_label','page_ahp_training','Overview Program','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(75,'page_ahp_training.intro_badge_text','page_ahp_training','ProgramEksklusif','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(76,'page_ahp_training.about_image','page_ahp_training','uploads/ahp/1gmpodGM88sfRBwp3LcklirFzrwndWMOFvNY3PQM.jpg','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:56'),(77,'page_ahp_training.stat1_value','page_ahp_training','5','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(78,'page_ahp_training.stat1_label','page_ahp_training','Tahapan Terstruktur','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(79,'page_ahp_training.stat2_value','page_ahp_training','100%','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(80,'page_ahp_training.stat2_label','page_ahp_training','Berbasis Data','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(81,'page_ahp_training.stat3_value','page_ahp_training','AFC','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30'),(82,'page_ahp_training.stat3_label','page_ahp_training','Lisensi Pelatih','text',NULL,NULL,1,'2026-07-10 09:08:30','2026-07-10 09:08:30');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participant_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('administrator','organizer','participant') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'participant',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_participant_id_unique` (`participant_id`),
  KEY `users_role_index` (`role`),
  KEY `users_participant_id_index` (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@coachagam.com',NULL,'$2y$12$B3wPcc6W5zgVCkv3WrTCiOew9JehUi7Nj0/EQ1Ui4YFmhh57c9PJG','administrator',1,'2026-07-10 02:04:11','p2qho5vlUj5zT3bHT90kZUrBclnj2bKDVCeehDe7hWulyG83gccR8OVMa7uA','2026-06-25 20:22:00','2026-07-10 02:04:11',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `violations`
--

DROP TABLE IF EXISTS `violations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `violations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` bigint unsigned NOT NULL,
  `type` enum('tab_switch','window_blur','fullscreen_exit','browser_minimize','copy_attempt','paste_attempt','right_click','keyboard_shortcut') COLLATE utf8mb4_unicode_ci NOT NULL,
  `occurred_at` datetime NOT NULL,
  `metadata` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `violations_session_id_type_index` (`session_id`,`type`),
  CONSTRAINT `violations_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `exam_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `violations`
--

LOCK TABLES `violations` WRITE;
/*!40000 ALTER TABLE `violations` DISABLE KEYS */;
/*!40000 ALTER TABLE `violations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-11 16:14:23
