-- ============================================================
-- Coach Agam Database — Complete Install Script
-- Generated: 2026-09-03
-- Compatible: MySQL 5.7+ / MariaDB 10.3+
-- ============================================================
-- CARA PAKAI:
-- 1. Buat database baru di cPanel → MySQL Databases
-- 2. Buka phpMyAdmin → pilih database baru
-- 3. Tab Import → pilih file ini → klik Go
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- ── migrations (Laravel tracking) ─────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── users ──────────────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin default: email=admin@coachagam.com | password=Admin@2025
-- GANTI PASSWORD SEGERA SETELAH PERTAMA LOGIN!
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Admin Coach Agam', 'admin@coachagam.com', '$2y$12$gvPfuEzVEg6LQnk2S5hyjuM8L6RtBsWrUO149onXwJSrbcYUGFGw2', 'administrator', NOW(), NOW());

-- ── site_settings ──────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `value` text,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) DEFAULT NULL,
  `description` text,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`),
  KEY `site_settings_group_index` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── posts ──────────────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `excerpt` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `category_slug` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `meta_description` varchar(500) DEFAULT NULL,
  `meta_keywords` varchar(500) DEFAULT NULL,
  `faq` text DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── leads (CRM) ────────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `leads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── analytics_logs ─────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `analytics_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `page` varchar(500) DEFAULT NULL,
  `referrer` varchar(500) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'pageview',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `analytics_logs_page_index` (`page`(191)),
  KEY `analytics_logs_type_index` (`type`),
  KEY `analytics_logs_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── ahp_players ────────────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `ahp_players` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_reg` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ahp_players_no_reg_unique` (`no_reg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── ahp_test_sessions ──────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `ahp_test_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `test_date` date NOT NULL,
  `test_time` time DEFAULT NULL,
  `temperature` varchar(50) DEFAULT NULL,
  `period_week` int(11) DEFAULT NULL,
  `coach_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── ahp_test_results ───────────────────────────────────────────────────────────

CREATE TABLE IF NOT EXISTS `ahp_test_results` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `player_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `age` int(11) DEFAULT NULL,
  `height_cm` decimal(5,2) DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `bmi` decimal(5,2) DEFAULT NULL,
  `body_fat_percentage` decimal(5,2) DEFAULT NULL,
  `skeletal_muscle_mass` decimal(5,2) DEFAULT NULL,
  `moca_score` int(11) DEFAULT NULL,
  `total_passing` int(11) DEFAULT NULL,
  `passing_sukses` int(11) DEFAULT NULL,
  `passing_gagal` int(11) DEFAULT NULL,
  `scanning_per_10sec` decimal(5,2) DEFAULT NULL,
  `initial_acceleration` decimal(5,3) DEFAULT NULL,
  `acceleration_phase` decimal(5,3) DEFAULT NULL,
  `maximal_speed` decimal(5,3) DEFAULT NULL,
  `rast_test` decimal(6,2) DEFAULT NULL,
  `yo_yo_level` int(11) DEFAULT NULL,
  `yo_yo_balikan` int(11) DEFAULT NULL,
  `yo_yo_distance` decimal(8,2) DEFAULT NULL,
  `vo2max` decimal(5,2) DEFAULT NULL,
  `rating_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ahp_results_player_session_unique` (`player_id`,`session_id`),
  KEY `ahp_test_results_session_id_foreign` (`session_id`),
  CONSTRAINT `ahp_test_results_player_id_foreign`
    FOREIGN KEY (`player_id`) REFERENCES `ahp_players` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ahp_test_results_session_id_foreign`
    FOREIGN KEY (`session_id`) REFERENCES `ahp_test_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ── Migration tracking rows ────────────────────────────────────────────────────

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_01_01_000001_create_users_table', 1),
('2026_06_26_000012_create_site_settings_table', 1),
('2026_06_26_000013_create_posts_table', 1),
('2026_06_26_000014_add_administrator_role_to_users', 1),
('2026_06_26_120520_create_leads_table', 1),
('2026_06_26_192015_add_keywords_and_faq_to_posts_table', 1),
('2026_06_27_000020_create_ahp_players_table', 1),
('2026_06_27_000021_create_ahp_test_sessions_table', 1),
('2026_06_27_000022_create_ahp_test_results_table', 1),
('2026_07_10_110057_add_og_image_to_ahp_players_table', 1),
('2026_07_10_112410_alter_acceleration_columns_in_ahp_test_results_table', 1),
('2026_07_11_122034_insert_ahp_training_default_settings', 1),
('2026_08_30_142025_create_analytics_logs_table', 1),
('2026_08_30_152020_add_vo2max_to_ahp_test_results_table', 1);

-- ============================================================
-- SELESAI.
-- Login admin: admin@coachagam.com / Admin@2025
-- WAJIB ganti password setelah pertama kali login!
-- ============================================================
