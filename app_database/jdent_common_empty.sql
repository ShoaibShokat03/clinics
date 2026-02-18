-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 03, 2026 at 01:05 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u793579029_marwadental`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_headers`
--

CREATE TABLE `account_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Debit','Credit') NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_headers`
--

INSERT INTO `account_headers` (`id`, `company_id`, `name`, `type`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'Debit Account', 'Debit', '<p>abc</p>', '1', '2024-04-29 02:07:38', '2024-07-05 13:12:08', NULL, NULL, NULL),
(2, 1, 'Credit Account', 'Credit', '<p><br></p>', '1', '2024-07-05 13:12:16', '2024-07-05 13:12:16', NULL, NULL, NULL),
(3, 1, 'Test Account', 'Credit', NULL, '1', '2025-02-11 16:13:23', '2025-02-11 16:58:43', NULL, NULL, NULL),
(4, 1, 'Account Name', 'Debit', NULL, '1', '2025-02-13 11:53:53', '2025-02-13 11:53:53', NULL, NULL, NULL),
(5, 1, 'hbl', 'Credit', NULL, '0', '2025-02-14 15:19:20', '2025-03-25 15:33:50', '2025-03-25 15:33:50', NULL, NULL),
(6, 1, 'DR Usama', 'Credit', NULL, '1', '2025-10-30 09:49:43', '2025-10-30 09:49:43', NULL, NULL, NULL),
(7, 1, 'Test acc', 'Debit', NULL, '1', '2025-10-30 10:55:37', '2025-12-31 17:54:04', '2025-12-31 17:54:04', NULL, NULL),
(8, 1, 'xyz', 'Credit', 'xyz', '1', '2025-11-11 11:23:49', '2025-12-31 17:53:59', '2025-12-31 17:53:59', NULL, NULL),
(9, 1, 'rehman', 'Debit', 'qwerty', '1', '2025-11-14 09:19:14', '2025-11-14 09:19:14', NULL, NULL, NULL),
(10, 1, 'zain', 'Debit', 'qwertyu', '1', '2025-11-20 10:51:36', '2025-11-20 10:51:36', NULL, NULL, NULL),
(11, 1, 'qazi', 'Credit', NULL, '1', '2025-12-01 09:59:22', '2025-12-01 09:59:22', NULL, NULL, NULL),
(12, 1, 'new', 'Credit', 'xx', '1', '2026-01-27 16:01:06', '2026-01-27 16:01:06', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_contact_mangs`
--

CREATE TABLE `admin_contact_mangs` (
  `id` int(11) NOT NULL,
  `software_name` varchar(150) NOT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `logo_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE `application_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_short_name` varchar(255) NOT NULL,
  `item_version` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `developed_by` varchar(255) DEFAULT NULL,
  `developed_by_href` varchar(255) DEFAULT NULL,
  `developed_by_title` varchar(255) DEFAULT NULL,
  `developed_by_prefix` varchar(255) DEFAULT NULL,
  `support_email` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `is_demo` enum('0','1') NOT NULL DEFAULT '0',
  `time_zone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_settings`
--

INSERT INTO `application_settings` (`id`, `item_name`, `item_short_name`, `item_version`, `company_name`, `company_email`, `company_address`, `developed_by`, `developed_by_href`, `developed_by_title`, `developed_by_prefix`, `support_email`, `logo`, `favicon`, `language`, `is_demo`, `time_zone`, `created_at`, `updated_at`, `created_by`, `updated_by`, `contact`) VALUES
(1, 'Marwat Dental', 'Marwat Dental', '2.0', 'Marwat Dental', 'jdent@gmail.com', 'Ghauri, Town, Islamabad', 'TEST', 'info', 'Your hope our goal', 'Developed by', 'info@jantrah.com', 'uploads/marwadental/assets/logo.png', 'uploads/marwadental/assets/favicon.png', 'en', '0', 'Asia/Yekaterinburg', '2024-04-29 01:37:38', '2026-02-03 17:53:29', NULL, NULL, '0510000000');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_status`
--

CREATE TABLE `appointment_status` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `domain` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `domain`, `enabled`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 'hostpital', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consultancey_fees`
--

CREATE TABLE `consultancey_fees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(40) NOT NULL,
  `created_at` date NOT NULL DEFAULT curdate(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Maths', '2024-05-01', NULL, NULL, NULL),
(2, 'AI', '2024-05-01', NULL, NULL, NULL),
(3, 'DBMS', '2024-05-01', NULL, NULL, NULL),
(4, 'DS', '2024-05-01', NULL, NULL, NULL),
(5, 'OS', '2024-05-01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `rate` double(15,8) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT 0,
  `precision` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `symbol_first` varchar(255) DEFAULT NULL,
  `decimal_mark` varchar(255) DEFAULT NULL,
  `thousands_separator` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `company_id`, `name`, `code`, `rate`, `enabled`, `precision`, `symbol`, `symbol_first`, `decimal_mark`, `thousands_separator`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 2, 'US Dollar', 'USD', 1.00000000, 1, '2', '$', '1', '.', ',', '2024-04-29 01:39:40', '2024-04-29 01:39:40', NULL, NULL),
(6, 2, 'Euro', 'EUR', 1.25000000, 0, '2', '€', '1', ',', '.', '2024-04-29 01:39:40', '2024-04-29 01:39:40', NULL, NULL),
(7, 2, 'British Pound', 'GBP', 1.60000000, 0, '2', '£', '1', '.', ',', '2024-04-29 01:39:40', '2024-04-29 01:39:40', NULL, NULL),
(8, 2, 'Turkish Lira', 'TRY', 0.80000000, 0, '2', '₺', '1', ',', '.', '2024-04-29 01:39:40', '2024-04-29 01:39:40', NULL, NULL),
(9, 3, 'US Dollar', 'USD', 1.00000000, 1, '2', '$', '1', '.', ',', '2024-04-29 01:40:20', '2024-04-29 01:40:20', NULL, NULL),
(10, 3, 'Euro', 'EUR', 1.25000000, 0, '2', '€', '1', ',', '.', '2024-04-29 01:40:20', '2024-04-29 01:40:20', NULL, NULL),
(11, 3, 'British Pound', 'GBP', 1.60000000, 0, '2', '£', '1', '.', ',', '2024-04-29 01:40:20', '2024-04-29 01:40:20', NULL, NULL),
(12, 3, 'Turkish Lira', 'TRY', 0.80000000, 0, '2', '₺', '1', ',', '.', '2024-04-29 01:40:20', '2024-04-29 01:40:20', NULL, NULL),
(13, 4, 'US Dollar', 'USD', 1.00000000, 1, '2', '$', '1', '.', ',', '2024-04-29 01:42:25', '2024-04-29 01:42:25', NULL, NULL),
(14, 4, 'Euro', 'EUR', 1.25000000, 0, '2', '€', '1', ',', '.', '2024-04-29 01:42:25', '2024-04-29 01:42:25', NULL, NULL),
(15, 4, 'British Pound', 'GBP', 1.60000000, 0, '2', '£', '1', '.', ',', '2024-04-29 01:42:25', '2024-04-29 01:42:25', NULL, NULL),
(16, 4, 'Turkish Lira', 'TRY', 0.80000000, 0, '2', '₺', '1', ',', '.', '2024-04-29 01:42:25', '2024-04-29 01:42:25', NULL, NULL),
(17, 1, 'PKR', 'PKR', 12.00000000, 1, '12', '₨', '0', '.', ',', '2024-04-29 02:34:10', '2024-04-29 02:34:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dd_blood_groups`
--

CREATE TABLE `dd_blood_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_blood_groups`
--

INSERT INTO `dd_blood_groups` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'A+', NULL, NULL, '2024-06-21 04:09:23', NULL, '2024-06-21 04:09:23'),
(2, 'B+', NULL, NULL, '2024-06-21 04:09:30', NULL, '2024-06-21 04:09:30'),
(3, 'AB+', '1', NULL, '2024-06-24 06:43:37', 1, '2024-09-23 00:10:50'),
(4, 'O+', '1', 1, '2024-09-23 00:11:07', NULL, '2024-09-23 00:11:07'),
(5, 'O-', '1', 1, '2024-09-23 00:11:17', NULL, '2024-09-23 00:11:17'),
(6, 'A-', '1', 1, '2024-09-23 00:11:32', NULL, '2024-09-23 00:11:32'),
(7, 'B-', '1', 1, '2024-09-23 00:11:44', NULL, '2024-09-23 00:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `dd_categories`
--

CREATE TABLE `dd_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_categories`
--

INSERT INTO `dd_categories` (`id`, `title`, `description`, `created_at`, `updated_at`, `updated_by`, `created_by`, `status`) VALUES
(39, 'ENDODONTICS', 'ENDODONTICS', '2024-09-17 08:30:02', '2024-09-17 13:14:48', 76, 76, '1'),
(40, 'ROOT CANAL MATERIALS', 'ROOT CANAL MATERIALS', '2024-09-17 12:04:05', '2024-09-17 12:04:08', 76, 76, '1'),
(41, 'FILLINGS MATERIAL', 'FILLINGS MATERIAL', '2024-09-17 12:04:22', '2024-09-17 12:04:24', 76, 76, '1'),
(42, 'IMPRESSION MATERIAL', 'IMPRESSION MATERIAL', '2024-09-17 12:04:36', '2024-09-17 12:04:38', 76, 76, '1'),
(43, 'TEMPERYORY CROWN', 'TEMPERYORY CROWN', '2024-09-17 12:04:49', '2024-09-17 13:15:01', 76, 76, '1'),
(44, 'Personal protection equipment', 'Personal protection equipment', '2024-09-17 12:05:10', '2024-09-17 12:05:20', 76, 76, '1'),
(45, 'SURGERY MATERIALS', 'SURGERY MATERIALS', '2024-09-17 12:05:28', '2024-09-17 12:05:31', 76, 76, '1'),
(58, 'teeth process', 'abcc', '2026-01-30 18:41:49', '2026-01-30 18:42:22', 2442, 2442, '1');

-- --------------------------------------------------------

--
-- Table structure for table `dd_dental_histories`
--

CREATE TABLE `dd_dental_histories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `dd_dental_history_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_dental_histories`
--

INSERT INTO `dd_dental_histories` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `dd_dental_history_id`) VALUES
(1, 'Floss daily', NULL, '0', 1, '2024-07-02 06:06:04', 1, '2025-12-26 00:33:57', NULL),
(2, 'Allergies', NULL, '0', 1, '2024-07-02 06:06:10', 1, '2025-12-26 00:33:39', NULL),
(3, 'Recent dental pain', NULL, '0', 1, '2024-07-05 13:45:36', 1, '2025-12-26 00:33:22', NULL),
(5, 'Oral Hygiene Habits', NULL, '1', 1, '2024-07-05 13:46:28', 1, '2025-12-26 00:32:34', NULL),
(6, 'Any Pain Medication', NULL, '1', 1, '2024-07-05 13:46:44', 1, '2025-12-26 00:31:49', NULL),
(7, 'Crown or Bridge', NULL, '1', 1, '2024-07-05 13:47:04', 1, '2025-12-26 00:30:51', NULL),
(8, 'History of Pain', NULL, '1', 1, '2024-07-05 13:47:39', 1, '2025-12-26 00:30:26', NULL),
(14, 'Past Treatment', NULL, '1', 1, '2025-11-11 11:03:54', 1, '2025-12-26 00:30:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dd_diagnoses`
--

CREATE TABLE `dd_diagnoses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_diagnoses`
--

INSERT INTO `dd_diagnoses` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Acute Apical Periodontitis', 1, NULL, '2024-07-06 10:31:07', 67, '2024-09-13 12:10:22'),
(2, 'Acute Periapical Abscess', 1, NULL, '2024-07-06 10:31:18', 67, '2024-09-13 12:10:07'),
(3, 'Irreversible Pulpitis', 1, NULL, '2024-07-06 10:31:26', 67, '2024-09-13 12:09:44'),
(4, 'Reversible Pulpitis', 1, NULL, '2024-07-06 10:31:40', 67, '2024-09-13 12:09:24'),
(5, 'Dental Caries (Tooth Decay)', 1, 67, '2024-09-13 12:07:50', 67, '2024-09-13 12:08:13'),
(6, 'Periodontitis', 1, 67, '2024-09-13 12:08:27', 67, '2024-09-13 12:08:45'),
(7, 'Chronic periapical Abscess (Sinus Tract)', 1, 67, '2024-09-13 12:10:33', 67, '2024-09-13 12:10:53'),
(8, 'Pyogenic granuloma', 1, 67, '2024-09-13 12:11:11', 67, '2024-09-13 12:11:21'),
(9, 'Temporomandibular Joint Disorder (TMD/TMJ)', 1, 67, '2024-09-13 12:11:31', 67, '2024-09-13 12:11:49'),
(10, 'Impacted Tooth', 1, 67, '2024-09-13 12:12:00', 67, '2024-09-13 12:12:10'),
(11, 'Dental Trauma lateral luxation', 1, 67, '2024-09-13 12:12:31', 67, '2024-09-13 12:12:44'),
(12, 'Dental Trauma Avulsion', 1, 67, '2024-09-13 12:13:44', 67, '2024-09-13 12:13:56'),
(13, 'Dental Trauma intrusion', 1, 67, '2024-09-13 12:14:01', 67, '2024-09-13 12:14:06'),
(14, 'Tooth Erosion', 1, 67, '2024-09-13 12:14:21', 67, '2024-09-13 12:14:24'),
(15, 'Tooth Sensitivity', 1, 67, '2024-09-13 12:14:36', 67, '2024-09-13 12:14:38'),
(16, 'Oral Candidiasis (Thrush)', 1, 67, '2024-09-13 12:14:49', 67, '2024-09-13 12:14:52'),
(17, 'Dental Fluorosis', 1, 67, '2024-09-13 12:15:05', 67, '2024-09-13 12:15:20'),
(18, 'Cleft Lip and Palate', 1, 67, '2024-09-13 12:15:37', 67, '2024-09-13 12:15:40'),
(19, 'Diastema', 1, 67, '2024-09-13 12:15:52', 67, '2024-09-13 12:16:30'),
(20, 'Pericoronitis', 1, 67, '2024-09-13 12:16:43', 67, '2024-09-13 12:16:47'),
(21, 'Enamel Hypoplasia', 1, 67, '2024-09-13 12:17:01', 67, '2024-09-13 12:17:04'),
(22, 'Ankylosis of Teeth', 1, 67, '2024-09-13 12:17:20', 67, '2024-09-13 12:17:22'),
(23, 'Retained deciduous tooth', 1, 67, '2024-09-13 12:17:33', 67, '2024-09-13 12:17:35'),
(24, 'Tooth abrasion', 1, 67, '2024-09-13 12:17:55', 67, '2024-09-13 12:17:57'),
(25, 'Gingival recession', 1, 67, '2024-09-13 12:18:13', 67, '2024-09-13 12:18:16'),
(26, 'Tooth mobility', 1, 67, '2024-09-13 12:18:31', 67, '2024-09-13 12:18:34'),
(27, 'Broken down root', 1, 67, '2024-09-13 12:18:47', 67, '2024-09-13 12:18:49'),
(28, 'Previously filled secondary caries', 1, 67, '2024-09-13 12:19:01', 67, '2024-09-13 12:19:04'),
(29, 'Previously RCT treated with apical infection', 1, 67, '2024-09-13 12:19:17', 67, '2024-09-13 12:19:28'),
(30, 'Previously RCT treated', 1, 67, '2024-09-13 12:19:43', 67, '2024-09-13 12:19:47'),
(31, 'Ill fitting crown margins', 1, 67, '2024-09-13 12:20:01', 67, '2024-09-13 12:20:04'),
(32, 'Fractured crown', 1, 67, '2024-09-13 12:20:45', 67, '2024-09-13 12:20:50'),
(33, 'Faulty bridge', 1, 67, '2024-09-13 12:21:04', 67, '2024-09-13 12:21:07'),
(34, 'Fractured filled', 1, 67, '2024-09-13 12:21:19', 67, '2024-09-13 12:21:22'),
(35, 'Increased Probing Depth', 1, 67, '2024-09-13 12:21:45', 2442, '2026-01-03 21:41:04'),
(36, 'Horizontal Root fracture', 1, 67, '2024-09-13 12:21:59', 67, '2024-09-13 12:22:01'),
(37, 'Vertical Root fracture', 1, 67, '2024-09-13 12:22:23', 67, '2024-09-13 12:22:26'),
(38, 'Root Caries', 1, 67, '2024-09-13 12:22:35', 2442, '2026-01-03 21:40:43'),
(39, 'Black triangle', 1, 67, '2024-09-13 12:22:49', 67, '2024-09-13 12:22:53'),
(40, 'Tooth Discoloration', 1, 67, '2024-09-13 12:23:05', 2442, '2026-01-03 21:40:32'),
(41, 'Dry Socket (Alveolar Osteitis)', 1, 67, '2024-09-13 16:09:16', 67, '2024-09-13 16:09:19'),
(42, 'Dental Trauma Concussion', 1, 67, '2024-09-13 16:09:57', 67, '2024-09-13 16:09:59'),
(43, 'Tooth Attrition (Bruxism)', 1, 67, '2024-09-13 16:11:03', 67, '2024-09-13 16:11:50'),
(44, 'Malocclusion', 1, 67, '2024-09-13 16:11:12', 67, '2024-09-13 16:11:41'),
(45, 'Pulp Polyp', 1, 67, '2024-09-13 16:11:31', 67, '2024-09-13 16:11:33'),
(46, 'Gingivitis', 1, 67, '2024-09-13 16:19:58', 67, '2024-09-13 16:20:01'),
(47, 'Chronic Apical Periodontitis', 1, 67, '2024-09-13 16:20:49', 2442, '2026-01-03 21:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `dd_drug_histories`
--

CREATE TABLE `dd_drug_histories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_drug_histories`
--

INSERT INTO `dd_drug_histories` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Already taking medications', NULL, '0', 1, '2024-07-05 13:49:52', 1, '2025-12-26 01:14:10'),
(2, 'over the counter drugs regularly', NULL, '0', 1, '2024-07-05 13:50:17', 1, '2025-12-26 01:12:16'),
(3, 'Have taken antibiotics', NULL, '0', 1, '2024-07-05 13:50:36', 1, '2025-12-26 01:11:51'),
(4, 'Herbal remedies', NULL, '0', 1, '2024-07-05 13:51:09', 1, '2025-12-26 01:11:34'),
(5, 'BISPHOSPONATES', NULL, '0', 67, '2024-09-22 21:03:13', 1, '2025-12-26 01:11:17'),
(9, 'Allergies', NULL, '1', 1, '2025-10-30 09:33:04', 1, '2025-12-26 00:45:00'),
(10, 'Any Current Medication', NULL, '1', 1, '2025-11-11 11:03:08', 1, '2025-12-26 00:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `dd_examinations`
--

CREATE TABLE `dd_examinations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dd_findings`
--

CREATE TABLE `dd_findings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dd_findings`
--

INSERT INTO `dd_findings` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Percussion Positive', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(2, 'Mobility Grade I', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(3, 'Mobility Grade II', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(4, 'Mobility Grade III', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(5, 'Extrinsic staining', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(6, 'Intrinsic staining', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(7, 'Cracks', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(8, 'Chip offs', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(9, 'Fractured', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(10, 'Carious lesions Class I', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(11, 'Carious lesions Class II', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(12, 'Carious lesions Class III', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(13, 'Carious lesions Class IV', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(14, 'Carious lesions Class V', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(15, 'Carious lesions Class VI', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(16, 'Carious lesions MOD', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(17, 'Grossly caries', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(18, 'Broken down roots', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(19, 'Missing', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(20, 'Restored teeth', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(21, 'Failing restoration', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(22, 'Crowns', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(23, 'Bridges', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(24, 'Prosthesis', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(25, 'Endodontically treated', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(26, 'Supra-erupted', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(27, 'Infraoccluded', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(28, 'Rotated', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(29, 'Root caries', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(30, 'Hypoplasia', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(31, 'Supernumerary', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(32, 'Odontome', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(33, 'Impacted', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(34, 'Retained deciduous', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(35, 'Removable partial denture', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(36, 'NCCLs', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(37, 'Spacing', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(38, 'Open contacts', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(39, 'Ankylosis', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(40, 'Wear Facets', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(41, 'Abfraction', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(42, 'Erosion', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(43, 'Abrasion', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11'),
(44, 'Attrition', '1', NULL, NULL, '2026-01-04 12:16:11', '2026-01-04 12:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `dd_investigations`
--

CREATE TABLE `dd_investigations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dd_medical_histories`
--

CREATE TABLE `dd_medical_histories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_medical_histories`
--

INSERT INTO `dd_medical_histories` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Allergies', NULL, '1', 1, '2024-06-27 07:04:31', NULL, '2025-12-26 00:28:26'),
(2, 'Blood Disorders', NULL, '1', 1, '2024-06-27 07:04:39', NULL, '2025-12-26 00:26:58'),
(3, 'Any Neurological Condition', NULL, '1', 1, '2024-07-05 10:18:15', NULL, '2025-12-26 00:26:38'),
(4, 'Any Bone Condition', NULL, '1', 1, '2024-07-05 13:55:05', NULL, '2025-12-26 00:26:12'),
(10, 'Heart Conditions', NULL, '1', 1, '2025-10-30 07:56:15', NULL, '2025-12-26 00:25:30'),
(11, 'Diabetes Mellitus', NULL, '1', 1, '2025-11-11 10:48:18', NULL, '2025-12-26 00:24:45'),
(12, 'Hypertension', NULL, '1', 321, '2025-11-20 10:26:25', NULL, '2025-12-26 00:25:02'),
(13, 'Hepatitis', NULL, '1', 1, '2025-12-26 00:27:38', NULL, '2025-12-26 00:28:41'),
(14, 'Past Hospitalization', NULL, '1', 1, '2025-12-26 00:28:56', NULL, '2025-12-26 00:28:56'),
(15, 'Any Medication', NULL, '1', 1, '2025-12-26 00:29:08', NULL, '2025-12-26 00:29:08'),
(16, 'Disease', NULL, '1', 2442, '2026-01-26 13:00:24', NULL, '2026-01-26 13:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `dd_medicines`
--

CREATE TABLE `dd_medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `dd_medicine_type` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_medicines`
--

INSERT INTO `dd_medicines` (`id`, `name`, `description`, `status`, `dd_medicine_type`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(6, 'Tab augmentin 375mg', '1+1+1 for 5 days', 1, 17, 67, '2024-09-13 12:54:55', 67, '2024-09-13 12:55:00'),
(7, 'Tab augmentin 625mg', '1+1+1 for 5days', 1, 17, 67, '2024-09-13 12:55:47', 67, '2024-09-13 12:56:07'),
(8, 'Augmentin 1g', '1g 1+1 for', 1, 17, 67, '2024-09-13 14:20:04', 67, '2024-09-13 14:48:56'),
(9, 'Flagyl 400mg', '1+1+1', 1, 17, 67, '2024-09-13 14:20:41', 67, '2024-09-13 14:49:49'),
(10, 'Flagyl 200mg', '1+1+1', 1, 17, 67, '2024-09-13 14:21:43', 67, '2024-09-13 14:50:21'),
(11, 'Caflam 50mg', '1+1+1', 1, 17, 67, '2024-09-13 14:22:54', 67, '2024-09-13 14:50:51'),
(12, 'Panadol 500mg', '2+2+2', 1, 17, 67, '2024-09-13 14:24:07', 67, '2024-09-13 14:51:38'),
(13, 'Panadol Extend', '1+1+1', 1, 17, 67, '2024-09-13 14:24:40', 67, '2024-09-13 14:52:29'),
(14, 'Synflex 550mg', '1+1', 1, 17, 67, '2024-09-13 14:25:11', 67, '2024-09-13 14:52:58'),
(15, 'Chymoral Forte', '1+1+1', 1, 17, 67, '2024-09-13 14:26:41', 67, '2024-09-13 14:54:05'),
(16, 'Danzen ds', '1+1+1', 1, 17, 67, '2024-09-13 14:27:21', 67, '2024-09-13 14:54:36'),
(17, 'Amoxil 500mg', '1+1+1', 1, 12, 67, '2024-09-13 14:27:54', 67, '2024-09-13 14:55:04'),
(18, 'Cefspan 400mg', '1 daily', 1, 12, 67, '2024-09-13 14:28:12', 67, '2024-09-13 14:55:43'),
(19, 'Clindamycin 300mg', '1+1+1', 1, 12, 67, '2024-09-13 14:28:51', 67, '2024-09-13 14:56:13'),
(20, 'Brufen 400mg', '1+1+1', 1, 17, 67, '2024-09-13 14:29:32', 67, '2024-09-13 14:56:44'),
(21, 'Brufen 200mg', '1+1+1', 1, 17, 67, '2024-09-13 14:30:46', 67, '2024-09-13 14:57:16'),
(22, 'Enziclor', '1+1+1', 1, 13, 67, '2024-09-13 14:31:30', 67, '2024-09-13 14:31:32'),
(23, 'Clinica', '1+1+1', 1, 13, 67, '2024-09-13 14:32:09', 67, '2024-09-13 14:32:14'),
(24, 'Niflam', '1+1+1', 1, 13, 67, '2024-09-13 14:32:51', 67, '2024-09-13 14:59:02'),
(25, 'Dexamethasone 0.5mg', '2+2+2+ for 4 weeks and then 2+2 for 2 weeks', 1, 17, 67, '2024-09-13 14:34:00', 67, '2024-09-13 15:00:08'),
(26, 'Ponston Forte', '1+1+1', 1, 17, 67, '2024-09-13 14:35:03', 67, '2024-09-13 15:01:53'),
(27, 'Nystatin Drops', '1+1+1', 1, 19, 67, '2024-09-13 14:35:41', 67, '2024-09-13 15:02:17'),
(28, 'Tramadol Plus', '1+1+1', 1, 17, 67, '2024-09-13 14:40:27', 67, '2024-09-13 15:03:25'),
(29, 'Augmentin DS 156 5ml', '1+1+1', 1, 18, 67, '2024-09-13 14:41:22', 67, '2024-09-13 15:04:07'),
(30, 'Augmentin DS 5ml', '1+1+1', 1, 18, 67, '2024-09-13 14:42:11', 67, '2024-09-13 15:05:13'),
(31, 'Flyagyl 200mg 5ml', '1+1+1', 1, 18, 67, '2024-09-13 14:42:37', 67, '2024-09-13 15:07:23'),
(32, 'Panadol 5ml', '1+1+1', 1, 18, 67, '2024-09-13 14:44:06', 67, '2024-09-13 15:08:09'),
(33, 'Brufen 100mg 5ml', '1+1+1', 1, 18, 67, '2024-09-13 15:09:18', NULL, '2024-09-13 15:09:18'),
(34, 'Brufen 200mg 5ml', '1+1+1', 1, 18, 67, '2024-09-13 15:10:34', NULL, '2024-09-13 15:10:34'),
(35, 'Parodontax', '1+1', 1, 16, 67, '2024-09-13 15:52:16', 67, '2024-09-13 15:52:22'),
(36, 'Sensodyne Rapid action', '1+1', 1, 16, 67, '2024-09-13 15:52:39', NULL, '2024-09-13 15:52:39'),
(39, 'sensodine', 'Tooth wash', 1, 16, 1, '2025-10-30 10:22:04', NULL, '2025-10-30 10:22:04'),
(42, 'qwerty', 'ererrr', 1, 16, 1, '2025-11-14 09:15:02', NULL, '2025-11-14 09:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `dd_medicine_types`
--

CREATE TABLE `dd_medicine_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_medicine_types`
--

INSERT INTO `dd_medicine_types` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`, `description`) VALUES
(12, 'Cab', 1, 67, '2024-09-13 11:53:43', 67, '2024-09-13 14:47:44', '1 a Day'),
(13, 'Mouthwash', 1, 67, '2024-09-13 11:56:16', 67, '2024-09-13 14:47:18', '3 Times'),
(16, 'Tooth Paste', 1, 67, '2024-09-13 12:01:37', 67, '2024-09-13 14:46:55', '2 Times'),
(17, 'Tab', 1, 67, '2024-09-13 12:03:06', 67, '2024-09-13 14:46:23', '1+1+1'),
(18, 'Syp', 1, 67, '2024-09-13 12:04:00', 67, '2024-09-13 14:46:07', '1 Time'),
(19, 'Drops', 1, 67, '2024-09-13 14:37:14', 67, '2024-09-13 14:45:46', '1+1+1');

-- --------------------------------------------------------

--
-- Table structure for table `dd_procedures`
--

CREATE TABLE `dd_procedures` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `sr_no` varchar(30) DEFAULT NULL,
  `procedure_code` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `dd_procedure_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_procedures`
--

INSERT INTO `dd_procedures` (`id`, `title`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `sr_no`, `procedure_code`, `price`, `dd_procedure_id`) VALUES
(10, 'Root Canal Treatment', 'Root Canal Treatment', '2024-09-15 12:43:15', '2026-01-03 22:10:12', 76, 2442, 'ENDO-1', 'Root Canal-1', 18000, 6),
(11, 'Root Canal Treatment', 'Root Canal Treatment', '2024-09-15 12:51:42', '2026-01-03 22:11:01', 76, 2442, 'ENDO-2', 'Root Canal-2', 8000, 6),
(156, 'Fixed Comprehensive Orthodontic Treatment', 'Extraction', '2025-12-27 20:32:41', '2025-12-27 20:32:41', 2442, NULL, '1', 'ORTHO-1', 180000, 21),
(157, 'Fixed Comprehensive Orthodontic Treatment', 'Non-Extraction', '2025-12-27 20:33:29', '2025-12-27 20:33:29', 2442, NULL, '2', 'ORTHO-2', 150000, 21),
(158, 'Conultation Fees', 'Consultation Fees', '2026-01-02 20:14:48', '2026-01-02 20:14:48', 2442, NULL, '1', 'OPD-1', 1500, 22),
(159, 'Composite Filling', 'Composite Filling', '2026-01-02 21:35:16', '2026-01-02 21:35:16', 2442, NULL, '1', 'COMPOSITE-1', 8000, 23),
(160, 'SCALING & POLISHING', 'Scaling & Polishing', '2026-01-03 19:00:42', '2026-01-03 19:00:42', 2442, NULL, '1', 'Scaling-1', 15000, 24),
(161, 'SCALING & POLISHING', 'Scaling & Polishing', '2026-01-03 19:02:13', '2026-01-03 19:02:13', 2442, NULL, '2', 'Scaling-2', 8000, 24),
(162, 'PFM Crown', 'PFM Crown', '2026-01-03 22:12:19', '2026-01-03 22:12:19', 2442, NULL, 'PFM-1', 'PFM-1', 15000, 25),
(163, 'PFM Crown', 'PFM Crown', '2026-01-03 22:12:47', '2026-01-03 22:12:47', 2442, NULL, 'PFM-2', 'PFM-2', 15000, 25),
(164, 'Zirconia Crown', 'Zirconia Crown', '2026-01-03 22:13:37', '2026-01-03 22:13:37', 2442, NULL, 'ZIRCONIA-1', 'ZIRCONIA-1', 30000, 25),
(165, 'Zirconia Crown', 'Zirconia Crown', '2026-01-03 22:14:30', '2026-01-03 22:14:30', 2442, NULL, 'ZIRCONIA-2', 'ZIRCONIA-2', 20000, 25),
(166, 'Surgical procedures', 'Simple extraction', '2026-01-15 02:34:56', '2026-01-15 02:34:56', 2442, NULL, '1', '1', 4000, 26),
(167, 'Extraction', 'Deciduous', '2026-01-15 02:35:38', '2026-01-15 02:36:03', 2442, 2442, '3', '3', 2000, 26);

-- --------------------------------------------------------

--
-- Table structure for table `dd_procedure_categories`
--

CREATE TABLE `dd_procedure_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_procedure_categories`
--

INSERT INTO `dd_procedure_categories` (`id`, `title`, `description`, `created_at`, `updated_at`, `updated_by`, `created_by`, `status`) VALUES
(6, 'ENDODONTIC PROCEDURES', 'ENDODONTIC PROCEDURES', '2024-09-15 12:41:02', '2024-09-15 12:49:02', 76, 76, 1),
(21, 'ORTHODONTIC', 'ORTHO', '2025-12-27 20:30:58', '2025-12-27 20:31:22', 2442, 2442, 1),
(22, 'OUTDOOR', NULL, '2026-01-02 20:12:57', '2026-01-02 20:12:57', NULL, 2442, 1),
(23, 'RESTORATIVE PROCEDURES', NULL, '2026-01-02 21:34:28', '2026-01-02 21:34:28', NULL, 2442, 1),
(24, 'PERIODONTAL PROCEDURES', NULL, '2026-01-03 18:59:39', '2026-01-03 18:59:39', NULL, 2442, 1),
(25, 'PROSTHODONTIC PROCEDURES', NULL, '2026-01-03 22:11:27', '2026-01-03 22:11:27', NULL, 2442, 1),
(26, 'Surgical procedures', NULL, '2026-01-15 02:33:06', '2026-01-15 02:33:06', NULL, 2442, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dd_social_histories`
--

CREATE TABLE `dd_social_histories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_social_histories`
--

INSERT INTO `dd_social_histories` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'Alcohol Consumption', NULL, '1', 1, '2024-07-02 04:54:54', NULL, '2025-12-26 00:38:31'),
(3, 'Paan or Betel Nut Chewing', NULL, '1', 1, '2024-07-02 04:54:59', NULL, '2025-12-26 00:38:10'),
(4, 'Smoking', NULL, '1', 1, '2024-07-02 04:55:04', NULL, '2025-12-26 00:37:49'),
(9, 'Children', NULL, '1', 1, '2025-10-30 09:26:37', NULL, '2025-12-26 00:37:31'),
(10, 'Married', NULL, '1', 1, '2025-11-11 11:01:57', NULL, '2025-12-26 00:37:12'),
(12, 'Unmarried', NULL, '1', 321, '2025-11-20 10:27:24', NULL, '2025-12-26 00:36:52'),
(13, 'Any Other Narcotics', NULL, '1', 1, '2025-12-26 00:38:51', NULL, '2025-12-26 00:38:51'),
(14, 'ABC', 'abcde', '1', 2442, '2026-01-27 14:44:21', NULL, '2026-01-27 14:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `dd_subcategories`
--

CREATE TABLE `dd_subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_subcategories`
--

INSERT INTO `dd_subcategories` (`id`, `category_id`, `title`, `description`, `created_at`, `updated_at`, `updated_by`, `created_by`, `status`) VALUES
(29, 39, 'PAPER POINTS', 'PAPER POINTS', '2024-09-17 08:30:43', '2024-09-17 08:30:43', NULL, 76, 1),
(30, 39, 'GP POINTS', 'GP POINTS', '2024-09-17 13:02:54', '2024-09-17 13:02:54', NULL, 76, 1),
(31, 39, 'ENDODONTIC FILES', 'ENDODONTIC FILES 25mm', '2024-09-17 13:03:29', '2024-09-17 13:04:02', 76, 76, 1),
(32, 39, 'ENDODONTIC FILES', 'ENDODONTIC FILES 21mm', '2024-09-17 13:04:20', '2024-09-17 13:04:20', NULL, 76, 1),
(33, 39, 'K FILES', 'K FILES', '2024-09-17 13:04:48', '2024-09-17 13:04:48', NULL, 76, 1),
(34, 39, 'H File', 'H-File', '2024-09-17 13:05:15', '2024-09-17 13:05:15', NULL, 76, 1),
(35, 41, 'COMPOSITE PACKABLE', 'COMPOSITE PACKABLE', '2024-09-17 13:07:14', '2024-09-17 13:07:14', NULL, 76, 1),
(36, 41, 'FLOWABLE COMPOSITE', 'FLOWABLE COMPOSITE', '2024-09-17 13:07:33', '2024-09-17 13:07:33', NULL, 76, 1),
(37, 41, 'MATRIX BAND', 'MATRIX BAND', '2024-09-17 13:07:51', '2024-09-17 13:07:51', NULL, 76, 1),
(38, 41, 'RETRACTION CORD', 'RETRACTION CORD', '2024-09-17 13:08:12', '2024-09-17 13:08:12', NULL, 76, 1),
(39, 46, 'IMPLANCE IMPLANT', 'IMPLANCE IMPLANT', '2024-09-17 13:09:05', '2024-09-17 13:09:05', NULL, 76, 1),
(40, 46, 'SWISS IMPLANT', 'SWISS IMPLANT', '2024-09-17 13:09:19', '2024-09-17 13:09:19', NULL, 76, 1),
(41, 40, 'ROOT CANAL MATERIALS', 'ROOT CANAL MATERIALS', '2024-09-18 12:03:58', '2024-09-18 12:03:58', NULL, 76, 1),
(42, 42, 'IMPRESSION MATERIAL', 'IMPRESSION MATERIAL', '2024-09-18 12:36:03', '2024-09-18 12:36:03', NULL, 76, 1),
(43, 43, 'TEMPERYORY CROWN', 'TEMPERYORY CROWN', '2024-09-18 12:36:34', '2024-09-18 12:36:34', NULL, 76, 1),
(44, 44, 'PERSONAL PROTECTION EQUIPMENT', 'PERSONAL PROTECTION EQUIPMENT', '2024-09-18 12:37:16', '2024-09-18 12:37:16', NULL, 76, 1),
(45, 45, 'SURGERY MATERIALS', 'SURGERY MATERIALS', '2024-09-18 12:37:33', '2024-09-18 12:37:33', NULL, 76, 1),
(46, 47, 'Dental Burs', 'Dental Burs', '2024-09-19 10:59:27', '2024-09-19 10:59:27', NULL, 76, 1),
(50, 47, 'Gums', NULL, '2025-10-30 07:42:02', '2025-10-30 07:42:02', NULL, 1, 1),
(54, 43, 'HZ', 'qwertyuiasdfghj', '2025-11-20 10:24:54', '2025-11-20 10:24:54', NULL, 321, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dd_task_actions`
--

CREATE TABLE `dd_task_actions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dd_task_priorities`
--

CREATE TABLE `dd_task_priorities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_task_priorities`
--

INSERT INTO `dd_task_priorities` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Urgent', NULL, '1', 1, '2024-07-15 04:46:00', NULL, '2024-07-15 04:46:00'),
(2, 'High', NULL, '1', 1, '2024-07-15 04:46:07', NULL, '2024-07-15 04:46:07'),
(3, 'Medium', NULL, '1', 1, '2024-07-15 04:46:14', NULL, '2024-07-15 04:46:14'),
(4, 'Low', NULL, '1', 1, '2024-07-15 04:46:20', NULL, '2024-07-15 04:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `dd_task_status`
--

CREATE TABLE `dd_task_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_task_status`
--

INSERT INTO `dd_task_status` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'New', NULL, '1', 1, '2024-07-15 05:36:55', NULL, '2024-07-15 05:36:55'),
(2, 'In Progress', NULL, '1', 1, '2024-07-15 05:37:04', NULL, '2024-07-15 05:37:04'),
(3, 'Pending', NULL, '1', 1, '2024-07-15 05:37:09', NULL, '2024-07-15 05:37:09'),
(4, 'Completed', NULL, '1', 1, '2024-07-15 05:37:15', NULL, '2024-07-15 05:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `dd_task_types`
--

CREATE TABLE `dd_task_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dd_task_types`
--

INSERT INTO `dd_task_types` (`id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'General', NULL, '1', 1, '2024-07-15 05:37:31', NULL, '2024-07-15 05:37:31'),
(2, 'Query', NULL, '1', 1, '2024-07-15 05:37:36', NULL, '2024-07-15 05:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `dd_treatment_plans`
--

CREATE TABLE `dd_treatment_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dental_lab_order`
--

CREATE TABLE `dental_lab_order` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `sending_date` date DEFAULT NULL,
  `returning_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `zirconia_mono` tinyint(1) DEFAULT NULL,
  `zirconia_layered` tinyint(1) DEFAULT NULL,
  `zirconia_non_pre_veneers` tinyint(1) DEFAULT NULL,
  `zirconia_veneers` tinyint(1) DEFAULT NULL,
  `zirconia_crown` tinyint(1) DEFAULT NULL,
  `zirconia_bridges` tinyint(1) DEFAULT NULL,
  `shade_left_1_3a` varchar(10) DEFAULT NULL,
  `shade_left_2_3a` varchar(10) DEFAULT NULL,
  `shade_left_2_3b` varchar(10) DEFAULT NULL,
  `shade_main_1` varchar(10) DEFAULT NULL,
  `shade_left_1_1` varchar(10) DEFAULT NULL,
  `shade_left_1_2` varchar(10) DEFAULT NULL,
  `shade_left_1_3` varchar(10) DEFAULT NULL,
  `shade_right_1_1` varchar(10) DEFAULT NULL,
  `shade_right_1_2` varchar(10) DEFAULT NULL,
  `shade_right_1_3` varchar(10) DEFAULT NULL,
  `shade_main_2` varchar(10) DEFAULT NULL,
  `shade_left_2_1` varchar(10) DEFAULT NULL,
  `shade_left_2_2` varchar(10) DEFAULT NULL,
  `shade_left_2_3` varchar(10) DEFAULT NULL,
  `shade_right_2_1` varchar(10) DEFAULT NULL,
  `shade_right_2_2` varchar(10) DEFAULT NULL,
  `shade_right_2_3` varchar(10) DEFAULT NULL,
  `shade_right_2_4` varchar(10) DEFAULT NULL,
  `shade_d_top_8` varchar(255) DEFAULT NULL,
  `shade_d_top_7` varchar(255) DEFAULT NULL,
  `shade_d_top_6` varchar(255) DEFAULT NULL,
  `shade_d_top_5` varchar(255) DEFAULT NULL,
  `shade_d_top_4` varchar(255) DEFAULT NULL,
  `shade_d_top_3` varchar(255) DEFAULT NULL,
  `shade_d_top_2` varchar(255) DEFAULT NULL,
  `shade_d_top_1` varchar(255) DEFAULT NULL,
  `shade_d_bottom_1` varchar(255) DEFAULT NULL,
  `shade_d_bottom_2` varchar(255) DEFAULT NULL,
  `shade_d_bottom_3` varchar(255) DEFAULT NULL,
  `shade_d_bottom_4` varchar(255) DEFAULT NULL,
  `shade_d_bottom_5` varchar(255) DEFAULT NULL,
  `shade_d_bottom_6` varchar(255) DEFAULT NULL,
  `shade_d_bottom_7` varchar(255) DEFAULT NULL,
  `shade_d_bottom_8` varchar(255) DEFAULT NULL,
  `shade_m_top_8` varchar(255) DEFAULT NULL,
  `shade_m_top_7` varchar(255) DEFAULT NULL,
  `shade_m_top_6` varchar(255) DEFAULT NULL,
  `shade_m_top_5` varchar(255) DEFAULT NULL,
  `shade_m_top_4` varchar(255) DEFAULT NULL,
  `shade_m_top_3` varchar(255) DEFAULT NULL,
  `shade_m_top_2` varchar(255) DEFAULT NULL,
  `shade_m_top_1` varchar(255) DEFAULT NULL,
  `shade_m_bottom_1` varchar(255) DEFAULT NULL,
  `shade_m_bottom_2` varchar(255) DEFAULT NULL,
  `shade_m_bottom_3` varchar(255) DEFAULT NULL,
  `shade_m_bottom_4` varchar(255) DEFAULT NULL,
  `shade_m_bottom_5` varchar(255) DEFAULT NULL,
  `shade_m_bottom_6` varchar(255) DEFAULT NULL,
  `shade_m_bottom_7` varchar(255) DEFAULT NULL,
  `shade_m_bottom_8` varchar(255) DEFAULT NULL,
  `e_max_milled` tinyint(1) DEFAULT NULL,
  `e_max_pressed` tinyint(1) DEFAULT NULL,
  `e_max_non_pre_veneers` tinyint(1) DEFAULT NULL,
  `e_max_veneers` tinyint(1) DEFAULT NULL,
  `e_max_crown` tinyint(1) DEFAULT NULL,
  `e_max_bridges` tinyint(1) DEFAULT NULL,
  `pfm_porcelain` tinyint(1) DEFAULT NULL,
  `pfm_non_pres` tinyint(1) DEFAULT NULL,
  `pfm_implant` tinyint(1) DEFAULT NULL,
  `pfm_post_and_core` tinyint(1) DEFAULT NULL,
  `pfm_crown` tinyint(1) DEFAULT NULL,
  `pfm_bridges` tinyint(1) DEFAULT NULL,
  `peek_removable_partial_denture` tinyint(1) DEFAULT NULL,
  `peek_fixed_prosthetic_framework` tinyint(1) DEFAULT NULL,
  `peek_attachment_restorations` tinyint(1) DEFAULT NULL,
  `peek_supported` tinyint(1) DEFAULT NULL,
  `peek_screw` tinyint(1) DEFAULT NULL,
  `peek_retained` tinyint(1) DEFAULT NULL,
  `peek_implant` tinyint(1) DEFAULT NULL,
  `peek_superstructures` tinyint(1) DEFAULT NULL,
  `removable_diagnostic_wax_up` tinyint(1) DEFAULT NULL,
  `removable_hybrid_denture` tinyint(1) DEFAULT NULL,
  `removable_tooth_addition` tinyint(1) DEFAULT NULL,
  `removable_over_denture` tinyint(1) DEFAULT NULL,
  `removable_relining_hard_soft` tinyint(1) DEFAULT NULL,
  `removable_veneers` tinyint(1) DEFAULT NULL,
  `removable_flexible` tinyint(1) DEFAULT NULL,
  `removable_crown` tinyint(1) DEFAULT NULL,
  `removable_bridges` tinyint(1) DEFAULT NULL,
  `removable_screw` varchar(10) DEFAULT NULL,
  `removable_implant` tinyint(1) DEFAULT NULL,
  `removable_retained` tinyint(1) DEFAULT NULL,
  `items_imp` tinyint(1) DEFAULT NULL,
  `items_partial` tinyint(1) DEFAULT NULL,
  `items_bite` tinyint(1) DEFAULT NULL,
  `items_photo` varchar(10) DEFAULT NULL,
  `items_study_models` varchar(10) DEFAULT NULL,
  `items_shade_tab` tinyint(1) DEFAULT NULL,
  `items_digital_impression` tinyint(1) DEFAULT NULL,
  `items_further` tinyint(1) DEFAULT NULL,
  `items_furthers` text DEFAULT NULL,
  `appliance_ortho` varchar(10) DEFAULT NULL,
  `appliance_retainer` varchar(10) DEFAULT NULL,
  `appliance_night_guard` tinyint(1) DEFAULT NULL,
  `appliance_occlusal_splint` tinyint(1) DEFAULT NULL,
  `appliance_sheet_press_retainer` tinyint(1) DEFAULT NULL,
  `appliance_wire` tinyint(1) DEFAULT NULL,
  `appliance_hyrax` tinyint(1) DEFAULT NULL,
  `appliance_tpa` tinyint(1) DEFAULT NULL,
  `appliance_obturator` tinyint(1) DEFAULT NULL,
  `appliance_space_maintainer` tinyint(1) DEFAULT NULL,
  `further_instructions` text DEFAULT NULL,
  `instructions_from_lab` text DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_token` text NOT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `app_version` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialist` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `timing` varchar(100) DEFAULT NULL,
  `day_from` varchar(25) DEFAULT NULL,
  `day_to` varchar(25) DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctor_biography` text DEFAULT NULL,
  `commission` int(3) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `weekday` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `avg_appointment_duration` int(11) DEFAULT 15,
  `serial_type` enum('Social','Sequential') DEFAULT 'Sequential',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_campaigns`
--

CREATE TABLE `email_campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `campaign_name` varchar(255) NOT NULL,
  `email_template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `schedule_time` datetime NOT NULL,
  `contact_type` varchar(255) NOT NULL,
  `status` enum('Pending','Processing','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_campaign_logs`
--

CREATE TABLE `email_campaign_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email_campaign_id` bigint(20) UNSIGNED NOT NULL,
  `smtp_configuration_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_sources`
--

CREATE TABLE `enquiry_sources` (
  `id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry_sources`
--

INSERT INTO `enquiry_sources` (`id`, `source_name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Facebook', '2024-06-27 15:36:24', 1, '2024-06-27 15:36:24', NULL),
(2, 'Google', '2024-06-27 15:36:33', 1, '2024-06-27 15:36:33', NULL),
(3, 'By Referance', '2024-06-27 15:36:42', 1, '2024-06-27 15:36:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `eventtype` varchar(20) DEFAULT NULL,
  `assign_to` int(10) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `task_assign_to` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_investigations`
--

CREATE TABLE `exam_investigations` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `patient_appointment_id` int(10) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `jaw_type` varchar(20) NOT NULL DEFAULT 'mixed',
  `comments` text DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `chief_complaints` text DEFAULT NULL,
  `history_chief_complaint_id` int(20) DEFAULT NULL,
  `extra_oral` int(10) DEFAULT NULL,
  `intra_oral_id` int(20) DEFAULT NULL,
  `soft_tissue_id` int(11) DEFAULT NULL,
  `hard_tissue_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `examination_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_orals`
--

CREATE TABLE `extra_orals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `extra_oral_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_orals`
--

INSERT INTO `extra_orals` (`id`, `extra_oral_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Face Scar marks of trauma', 'active', 67, NULL, '2024-09-21 19:46:06', '2024-09-21 19:46:06'),
(2, 'Face Swellings', 'active', 67, NULL, '2024-09-21 19:46:26', '2024-09-21 19:46:26'),
(3, 'Facial  Asymmetry', 'active', 67, NULL, '2024-09-21 19:46:39', '2024-09-21 19:46:39'),
(4, 'Face Buccal corridors', 'active', 67, NULL, '2024-09-21 19:46:52', '2024-09-21 19:46:52'),
(16, 'tissues', 'active', 2442, 2442, '2026-01-26 18:40:53', '2026-01-30 17:50:45'),
(18, 'brush', 'active', 2442, NULL, '2026-01-30 17:51:29', '2026-01-30 17:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `extra_oral_exam_investigations`
--

CREATE TABLE `extra_oral_exam_investigations` (
  `id` int(11) NOT NULL,
  `exam_investigation_id` int(11) NOT NULL,
  `extra_oral_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `extra_oral_exam_investigations`
--

INSERT INTO `extra_oral_exam_investigations` (`id`, `exam_investigation_id`, `extra_oral_id`, `comments`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(41, 20, 1, 'xyzzz', 2442, '2026-02-02 10:26:11', NULL, '2026-02-02 10:26:11'),
(42, 21, 1, 'fff', 2442, '2026-02-02 14:31:19', NULL, '2026-02-02 14:31:19'),
(43, 23, 2, '', 2442, '2026-02-03 12:39:22', NULL, '2026-02-03 12:39:22'),
(44, 25, 2, 'xyz', 2442, '2026-02-03 15:07:23', NULL, '2026-02-03 15:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `child_table_name` varchar(255) DEFAULT NULL,
  `record_id` int(11) NOT NULL,
  `child_record_id` int(11) DEFAULT NULL,
  `record_type` varchar(100) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_ends`
--

CREATE TABLE `front_ends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hard_tissues`
--

CREATE TABLE `hard_tissues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hard_tissue_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_of_chief_complaints`
--

CREATE TABLE `history_of_chief_complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaint_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_departments`
--

CREATE TABLE `hospital_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `specialization` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_departments`
--

INSERT INTO `hospital_departments` (`id`, `company_id`, `name`, `description`, `specialization`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Outpatient department (OPD)', '<p>An&nbsp;outpatient department&nbsp;or&nbsp;outpatient clinic&nbsp;is the part of a hospital&nbsp;designed for the treatment of outpatients, people with health problems who visit the hospital for diagnosis or treatment, but do not at this time require a bed or to be admitted for overnight care. Modern outpatient departments offer a wide range of treatment services, diagnostic tests and minor surgical procedures.</p>', 'OPD', '1', '2021-12-02 06:17:52', '2024-06-20 06:21:19', NULL),
(2, 1, 'Inpatient Service (IP)', '<p>Inpatient care requires overnight hospitalization. Patients must stay at the medical facility where their procedure was done (which is usually a hospital) for at least one night. During this time, they remain under the supervision of a nurse or doctor.</p>', 'Admissions', '1', '2021-12-02 06:20:55', '2024-05-01 02:45:36', NULL),
(3, 1, 'Medical Department', '<p><span style=\"color: rgb(32, 33, 36);\">Medical Department. The medical department has within it the various clinical services. They are:&nbsp;medicine, surgery, gynaecology, obstetrics, paediatrics, eye, ENT, dental, orthopaedics, neurology, cardiology, psychiatry, skin, V.D., plastic surgery, nuclear medicine, infectious disease etc.</span></p>', 'Medical', '1', '2021-12-02 06:54:29', '2021-12-02 06:54:29', NULL),
(4, 1, 'Nursing Department', '<p><span style=\"color: rgb(0, 0, 0);\">Medical-surgical nursing is one of the most common types of nursing. Not so long ago, all nursing grads started out as a medical-surgical nurse. However, today the nursing specialty path is not so straight forward. A medical-surgical nurse typically manages a patient load of five to seven patients throughout their shift.</span></p>', 'Caretaking', '1', '2021-12-02 06:57:47', '2021-12-02 06:57:47', NULL),
(5, 1, 'Paramedical Department', '<p><span style=\"color: rgb(32, 33, 34);\">A&nbsp;paramedic&nbsp;is a health care professional whose primary role is to provide advanced&nbsp;</span>emergency medical care<span style=\"color: rgb(32, 33, 34);\">&nbsp;for critical and emergent patients who access the emergency medical system.</span></p>', 'Parameds', '1', '2021-12-02 06:59:24', '2021-12-02 06:59:24', NULL),
(6, 1, 'Operation Theatre Complex (OT)', '<p><span style=\"color: rgb(51, 51, 51);\">An operation theatre complex is the \"heart\" of any major surgical hospital. An operating theatre, operating room, surgery suite or a surgery centre is a room within a hospital within which surgical and other operations are carried out. Operating theatres were so-called in the United Kingdom because they traditionally consisted of semi-cir-cular amphitheatres to allow students to observe the medi-cal procedures</span></p>', 'Surgery', '1', '2021-12-02 07:01:17', '2021-12-02 07:01:17', NULL),
(7, 1, 'Pharmacy Department', '<p><span style=\"color: rgb(5, 5, 5);\">The Department of Pharmacy at Southeast University was established in May, 2002. The aim of the introduction of Pharmacy program in Southeast University is to prepare students to be the most competent, responsible and caring Pharmacist/Pharmaceutical Scientist. The curriculum is designed to produce skilled and efficient professionals to manage pharmaceutical industries, hospital pharmacy, community pharmacy service and other government bodies related to health service and to be very competitive with other national and international universities.</span></p>', 'Drugs', '1', '2021-12-02 07:02:25', '2021-12-02 07:02:25', NULL),
(8, 1, 'Radiology Department (X-ray)', '<p>Although better known as the ‘X-ray Department’, we do a lot more than just take X-rays! We offer almost all of the latest types of medical imaging techniques to support Doctors, Nurses and other Healthcare Professional to diagnose and work with you to treat you in the best possible way. We are located on the ground floor of the main hospital building.</p>', 'Labs', '1', '2021-12-02 07:03:54', '2025-11-11 11:26:09', '2025-11-11 11:26:09'),
(10, 1, 'Oncology', '<p>Deals with Cancer patients.</p>', 'Leukemia', '1', '2024-05-01 02:39:02', '2024-07-02 06:08:13', '2024-07-02 06:08:13'),
(11, 1, 'xyz', 'xyz', 'xyz', '1', '2025-11-11 11:24:22', '2025-11-11 11:24:22', NULL),
(12, 1, 'labs', NULL, 'labs', '1', '2025-11-11 11:26:21', '2025-11-11 11:26:21', NULL),
(13, 1, 'bac', NULL, 'xyz', '1', '2026-01-27 16:27:08', '2026-01-27 16:27:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `service_tax` double DEFAULT 0,
  `discount` double DEFAULT 0,
  `description` text DEFAULT NULL,
  `insurance_no` varchar(255) DEFAULT NULL,
  `insurance_code` varchar(255) DEFAULT NULL,
  `disease_charge` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`disease_charge`)),
  `hospital_rate` double DEFAULT 0,
  `insurance_rate` double DEFAULT 0,
  `total` double DEFAULT 0,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_providers`
--

CREATE TABLE `insurance_providers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` bigint(16) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rating` int(16) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `co_percentage` int(12) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intra_orals`
--

CREATE TABLE `intra_orals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intra_oral_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intra_orals`
--

INSERT INTO `intra_orals` (`id`, `intra_oral_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Done fresh  golves', 'active', 67, NULL, '2024-09-21 19:44:39', '2024-09-21 19:44:39'),
(2, 'Take consent', 'active', 67, NULL, '2024-09-21 19:45:05', '2024-09-21 19:45:05'),
(3, 'Examine mouth opening with 3 finger method', 'active', 67, NULL, '2024-09-21 19:45:15', '2024-09-21 19:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `intra_oral_exam_investigations`
--

CREATE TABLE `intra_oral_exam_investigations` (
  `id` int(11) NOT NULL,
  `exam_investigation_id` int(11) NOT NULL,
  `intra_oral_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unitprice` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_additions`
--

CREATE TABLE `inventory_additions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `unitprice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_consumeds`
--

CREATE TABLE `inventory_consumeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `insurance_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patient_treatment_plan_id` int(11) DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `total` double NOT NULL DEFAULT 0,
  `vat_percentage` double NOT NULL DEFAULT 0,
  `total_vat` double NOT NULL DEFAULT 0,
  `discount_percentage` double NOT NULL DEFAULT 0,
  `total_discount` double NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL DEFAULT 0,
  `paid` double NOT NULL DEFAULT 0,
  `due` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `commission_percentage` int(3) DEFAULT NULL,
  `total_commission` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `patient_treatment_plan_procedure_id` int(10) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `account_type` enum('Debit','Credit') NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `treatment_process_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `procedure_id` int(11) DEFAULT NULL,
  `procedure_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `insurance_id` int(11) DEFAULT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `comments` text DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `subcategory_id`, `title`, `description`, `item_code`, `quantity`, `created_at`, `updated_at`, `updated_by`, `created_by`, `status`) VALUES
(4, 40, 30, 'abc', 'acx', NULL, 0, '2026-02-01 13:04:23', '2026-02-01 13:07:11', 2442, 2442, 1),
(5, 39, 29, 'G46', NULL, NULL, 0, '2026-02-01 13:07:59', '2026-02-01 13:07:59', NULL, 2442, 1),
(6, 41, 35, 'HG4', NULL, NULL, 0, '2026-02-01 13:08:10', '2026-02-01 13:08:10', NULL, 2442, 1),
(7, 42, 42, 'U56', NULL, NULL, 0, '2026-02-01 13:08:18', '2026-02-01 13:08:18', NULL, 2442, 1),
(8, 43, 43, 'JHR5', NULL, NULL, 0, '2026-02-01 13:08:27', '2026-02-01 13:08:27', NULL, 2442, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int(11) NOT NULL,
  `lab_number` varchar(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `lab_number`, `title`, `description`, `user_id`, `address`, `phone_no`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 'LB26013', 'lab1', 'LAB1', '2461', 'khanna pull', '030200000', '2026-01-03 14:29:52', 2442, '2026-01-26 09:08:19', 2442),
(4, 'LB26014', 'R1', 'New Lab', '2492', 'Khanna Pull', '03020000001', '2026-01-26 09:09:44', 2442, '2026-01-26 09:10:14', 2442),
(5, 'LB26015', 'xyz', 'xyz', '2496', 'xyz', '000000000', '2026-01-27 10:58:50', 2442, '2026-01-27 10:58:50', NULL),
(6, 'LB26026', 'jdent', 'xyz', '2507', 'xyz', '00000', '2026-02-02 05:46:50', 2442, '2026-02-02 05:46:59', 2442);

-- --------------------------------------------------------

--
-- Table structure for table `lab_reports`
--

CREATE TABLE `lab_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lab_report_template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report` text NOT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_report_templates`
--

CREATE TABLE `lab_report_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marital_statuses`
--

CREATE TABLE `marital_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marital_statuses`
--

INSERT INTO `marital_statuses` (`id`, `name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Single', NULL, NULL, '2024-06-21 04:08:15', NULL, '2024-06-21 04:08:15'),
(2, 'Married', NULL, NULL, '2024-06-21 04:08:36', NULL, '2024-06-21 04:08:36'),
(3, 'Divorced', NULL, NULL, '2024-06-24 06:44:13', NULL, '2024-06-24 06:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(6, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 34),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(2, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 40),
(3, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 42),
(2, 'App\\Models\\User', 46),
(3, 'App\\Models\\User', 48),
(3, 'App\\Models\\User', 49),
(3, 'App\\Models\\User', 50),
(3, 'App\\Models\\User', 51),
(2, 'App\\Models\\User', 55),
(2, 'App\\Models\\User', 57),
(2, 'App\\Models\\User', 59),
(3, 'App\\Models\\User', 61),
(2, 'App\\Models\\User', 62),
(2, 'App\\Models\\User', 63),
(3, 'App\\Models\\User', 64),
(3, 'App\\Models\\User', 65),
(3, 'App\\Models\\User', 66),
(2, 'App\\Models\\User', 70),
(2, 'App\\Models\\User', 71),
(2, 'App\\Models\\User', 72),
(2, 'App\\Models\\User', 73),
(2, 'App\\Models\\User', 74),
(2, 'App\\Models\\User', 77),
(2, 'App\\Models\\User', 78),
(2, 'App\\Models\\User', 79),
(2, 'App\\Models\\User', 80),
(3, 'App\\Models\\User', 81),
(3, 'App\\Models\\User', 82),
(3, 'App\\Models\\User', 83),
(3, 'App\\Models\\User', 84),
(3, 'App\\Models\\User', 85),
(3, 'App\\Models\\User', 86),
(3, 'App\\Models\\User', 87),
(3, 'App\\Models\\User', 88),
(3, 'App\\Models\\User', 89),
(3, 'App\\Models\\User', 90),
(3, 'App\\Models\\User', 91),
(2, 'App\\Models\\User', 92),
(3, 'App\\Models\\User', 93),
(3, 'App\\Models\\User', 94),
(3, 'App\\Models\\User', 95),
(3, 'App\\Models\\User', 96),
(5, 'App\\Models\\User', 97),
(2, 'App\\Models\\User', 101),
(3, 'App\\Models\\User', 119),
(2, 'App\\Models\\User', 123),
(3, 'App\\Models\\User', 127),
(2, 'App\\Models\\User', 129),
(3, 'App\\Models\\User', 133),
(2, 'App\\Models\\User', 135),
(3, 'App\\Models\\User', 136),
(2, 'App\\Models\\User', 137),
(5, 'App\\Models\\User', 139),
(5, 'App\\Models\\User', 140),
(2, 'App\\Models\\User', 142),
(3, 'App\\Models\\User', 143),
(5, 'App\\Models\\User', 144),
(2, 'App\\Models\\User', 145),
(2, 'App\\Models\\User', 146),
(2, 'App\\Models\\User', 147),
(2, 'App\\Models\\User', 148),
(3, 'App\\Models\\User', 153),
(3, 'App\\Models\\User', 154),
(3, 'App\\Models\\User', 156),
(3, 'App\\Models\\User', 157),
(3, 'App\\Models\\User', 158),
(3, 'App\\Models\\User', 161),
(3, 'App\\Models\\User', 163),
(3, 'App\\Models\\User', 164),
(3, 'App\\Models\\User', 165),
(3, 'App\\Models\\User', 166),
(3, 'App\\Models\\User', 168),
(3, 'App\\Models\\User', 171),
(3, 'App\\Models\\User', 172),
(3, 'App\\Models\\User', 173),
(3, 'App\\Models\\User', 176),
(3, 'App\\Models\\User', 185),
(3, 'App\\Models\\User', 186),
(3, 'App\\Models\\User', 187),
(3, 'App\\Models\\User', 189),
(3, 'App\\Models\\User', 190),
(3, 'App\\Models\\User', 191),
(2, 'App\\Models\\User', 197),
(3, 'App\\Models\\User', 211),
(2, 'App\\Models\\User', 214),
(3, 'App\\Models\\User', 216),
(3, 'App\\Models\\User', 217),
(3, 'App\\Models\\User', 220),
(3, 'App\\Models\\User', 221),
(3, 'App\\Models\\User', 222),
(3, 'App\\Models\\User', 223),
(3, 'App\\Models\\User', 224),
(2, 'App\\Models\\User', 225),
(3, 'App\\Models\\User', 227),
(2, 'App\\Models\\User', 228),
(3, 'App\\Models\\User', 229),
(2, 'App\\Models\\User', 230),
(3, 'App\\Models\\User', 231),
(2, 'App\\Models\\User', 232),
(2, 'App\\Models\\User', 233),
(2, 'App\\Models\\User', 235),
(3, 'App\\Models\\User', 236),
(3, 'App\\Models\\User', 237),
(3, 'App\\Models\\User', 238),
(2, 'App\\Models\\User', 239),
(3, 'App\\Models\\User', 240),
(3, 'App\\Models\\User', 243),
(3, 'App\\Models\\User', 245),
(2, 'App\\Models\\User', 246),
(3, 'App\\Models\\User', 247),
(3, 'App\\Models\\User', 249),
(3, 'App\\Models\\User', 250),
(3, 'App\\Models\\User', 251),
(3, 'App\\Models\\User', 253),
(3, 'App\\Models\\User', 254),
(2, 'App\\Models\\User', 256),
(3, 'App\\Models\\User', 257),
(3, 'App\\Models\\User', 258),
(3, 'App\\Models\\User', 259),
(2, 'App\\Models\\User', 260),
(3, 'App\\Models\\User', 262),
(3, 'App\\Models\\User', 263),
(3, 'App\\Models\\User', 264),
(3, 'App\\Models\\User', 266),
(3, 'App\\Models\\User', 268),
(3, 'App\\Models\\User', 269),
(2, 'App\\Models\\User', 270),
(3, 'App\\Models\\User', 271),
(5, 'App\\Models\\User', 272),
(1, 'App\\Models\\User', 273),
(2, 'App\\Models\\User', 276),
(5, 'App\\Models\\User', 277),
(3, 'App\\Models\\User', 278),
(2, 'App\\Models\\User', 279),
(3, 'App\\Models\\User', 280),
(3, 'App\\Models\\User', 281),
(3, 'App\\Models\\User', 283),
(5, 'App\\Models\\User', 284),
(3, 'App\\Models\\User', 285),
(3, 'App\\Models\\User', 286),
(3, 'App\\Models\\User', 287),
(3, 'App\\Models\\User', 288),
(5, 'App\\Models\\User', 291),
(3, 'App\\Models\\User', 292),
(3, 'App\\Models\\User', 294),
(2, 'App\\Models\\User', 295),
(2, 'App\\Models\\User', 296),
(2, 'App\\Models\\User', 297),
(2, 'App\\Models\\User', 298),
(2, 'App\\Models\\User', 299),
(2, 'App\\Models\\User', 301),
(2, 'App\\Models\\User', 302),
(2, 'App\\Models\\User', 303),
(2, 'App\\Models\\User', 304),
(2, 'App\\Models\\User', 305),
(2, 'App\\Models\\User', 306),
(2, 'App\\Models\\User', 307),
(3, 'App\\Models\\User', 312),
(3, 'App\\Models\\User', 313),
(3, 'App\\Models\\User', 314),
(3, 'App\\Models\\User', 315),
(3, 'App\\Models\\User', 316),
(3, 'App\\Models\\User', 317),
(2, 'App\\Models\\User', 318),
(1, 'App\\Models\\User', 319),
(1, 'App\\Models\\User', 320),
(1, 'App\\Models\\User', 321),
(3, 'App\\Models\\User', 322),
(5, 'App\\Models\\User', 323),
(2, 'App\\Models\\User', 324),
(3, 'App\\Models\\User', 325),
(3, 'App\\Models\\User', 326),
(3, 'App\\Models\\User', 327),
(3, 'App\\Models\\User', 328),
(3, 'App\\Models\\User', 329),
(2, 'App\\Models\\User', 330),
(3, 'App\\Models\\User', 331),
(3, 'App\\Models\\User', 333),
(3, 'App\\Models\\User', 334),
(2, 'App\\Models\\User', 335),
(3, 'App\\Models\\User', 336),
(3, 'App\\Models\\User', 337),
(3, 'App\\Models\\User', 338),
(2, 'App\\Models\\User', 339),
(3, 'App\\Models\\User', 340),
(3, 'App\\Models\\User', 341),
(3, 'App\\Models\\User', 342),
(3, 'App\\Models\\User', 343),
(3, 'App\\Models\\User', 344),
(3, 'App\\Models\\User', 345),
(3, 'App\\Models\\User', 346),
(3, 'App\\Models\\User', 347),
(3, 'App\\Models\\User', 348),
(3, 'App\\Models\\User', 349),
(3, 'App\\Models\\User', 350),
(3, 'App\\Models\\User', 351),
(3, 'App\\Models\\User', 352),
(3, 'App\\Models\\User', 353),
(3, 'App\\Models\\User', 354),
(3, 'App\\Models\\User', 355),
(3, 'App\\Models\\User', 356),
(3, 'App\\Models\\User', 357),
(3, 'App\\Models\\User', 358),
(3, 'App\\Models\\User', 359),
(3, 'App\\Models\\User', 360),
(3, 'App\\Models\\User', 361),
(3, 'App\\Models\\User', 362),
(3, 'App\\Models\\User', 363),
(3, 'App\\Models\\User', 364),
(3, 'App\\Models\\User', 365),
(3, 'App\\Models\\User', 366),
(3, 'App\\Models\\User', 367),
(3, 'App\\Models\\User', 368),
(3, 'App\\Models\\User', 369),
(3, 'App\\Models\\User', 370),
(3, 'App\\Models\\User', 371),
(3, 'App\\Models\\User', 372),
(3, 'App\\Models\\User', 373),
(3, 'App\\Models\\User', 374),
(3, 'App\\Models\\User', 375),
(3, 'App\\Models\\User', 376),
(3, 'App\\Models\\User', 377),
(3, 'App\\Models\\User', 378),
(3, 'App\\Models\\User', 379),
(3, 'App\\Models\\User', 380),
(3, 'App\\Models\\User', 381),
(3, 'App\\Models\\User', 382),
(3, 'App\\Models\\User', 383),
(3, 'App\\Models\\User', 384),
(3, 'App\\Models\\User', 385),
(3, 'App\\Models\\User', 386),
(3, 'App\\Models\\User', 387),
(3, 'App\\Models\\User', 388),
(3, 'App\\Models\\User', 389),
(3, 'App\\Models\\User', 390),
(3, 'App\\Models\\User', 391),
(3, 'App\\Models\\User', 392),
(3, 'App\\Models\\User', 393),
(3, 'App\\Models\\User', 394),
(3, 'App\\Models\\User', 395),
(3, 'App\\Models\\User', 396),
(3, 'App\\Models\\User', 397),
(3, 'App\\Models\\User', 398),
(3, 'App\\Models\\User', 399),
(3, 'App\\Models\\User', 400),
(3, 'App\\Models\\User', 401),
(3, 'App\\Models\\User', 402),
(3, 'App\\Models\\User', 403),
(3, 'App\\Models\\User', 404),
(3, 'App\\Models\\User', 405),
(3, 'App\\Models\\User', 406),
(3, 'App\\Models\\User', 407),
(3, 'App\\Models\\User', 408),
(3, 'App\\Models\\User', 409),
(3, 'App\\Models\\User', 410),
(3, 'App\\Models\\User', 411),
(3, 'App\\Models\\User', 412),
(3, 'App\\Models\\User', 413),
(3, 'App\\Models\\User', 414),
(3, 'App\\Models\\User', 415),
(3, 'App\\Models\\User', 416),
(3, 'App\\Models\\User', 417),
(3, 'App\\Models\\User', 418),
(3, 'App\\Models\\User', 419),
(3, 'App\\Models\\User', 420),
(3, 'App\\Models\\User', 421),
(3, 'App\\Models\\User', 422),
(3, 'App\\Models\\User', 423),
(3, 'App\\Models\\User', 424),
(3, 'App\\Models\\User', 425),
(3, 'App\\Models\\User', 426),
(3, 'App\\Models\\User', 427),
(3, 'App\\Models\\User', 428),
(3, 'App\\Models\\User', 429),
(3, 'App\\Models\\User', 430),
(3, 'App\\Models\\User', 431),
(3, 'App\\Models\\User', 432),
(3, 'App\\Models\\User', 433),
(3, 'App\\Models\\User', 434),
(3, 'App\\Models\\User', 435),
(3, 'App\\Models\\User', 436),
(3, 'App\\Models\\User', 437),
(3, 'App\\Models\\User', 438),
(3, 'App\\Models\\User', 439),
(3, 'App\\Models\\User', 440),
(3, 'App\\Models\\User', 441),
(3, 'App\\Models\\User', 442),
(3, 'App\\Models\\User', 443),
(3, 'App\\Models\\User', 444),
(3, 'App\\Models\\User', 445),
(3, 'App\\Models\\User', 446),
(3, 'App\\Models\\User', 447),
(3, 'App\\Models\\User', 448),
(3, 'App\\Models\\User', 449),
(3, 'App\\Models\\User', 450),
(3, 'App\\Models\\User', 451),
(3, 'App\\Models\\User', 452),
(3, 'App\\Models\\User', 453),
(3, 'App\\Models\\User', 454),
(3, 'App\\Models\\User', 455),
(3, 'App\\Models\\User', 456),
(3, 'App\\Models\\User', 457),
(3, 'App\\Models\\User', 458),
(3, 'App\\Models\\User', 459),
(3, 'App\\Models\\User', 460),
(3, 'App\\Models\\User', 461),
(3, 'App\\Models\\User', 462),
(3, 'App\\Models\\User', 463),
(3, 'App\\Models\\User', 464),
(3, 'App\\Models\\User', 465),
(3, 'App\\Models\\User', 466),
(3, 'App\\Models\\User', 467),
(3, 'App\\Models\\User', 468),
(3, 'App\\Models\\User', 469),
(3, 'App\\Models\\User', 470),
(3, 'App\\Models\\User', 471),
(3, 'App\\Models\\User', 472),
(3, 'App\\Models\\User', 473),
(3, 'App\\Models\\User', 474),
(3, 'App\\Models\\User', 475),
(3, 'App\\Models\\User', 476),
(3, 'App\\Models\\User', 477),
(3, 'App\\Models\\User', 478),
(3, 'App\\Models\\User', 479),
(3, 'App\\Models\\User', 480),
(3, 'App\\Models\\User', 481),
(3, 'App\\Models\\User', 482),
(3, 'App\\Models\\User', 483),
(3, 'App\\Models\\User', 484),
(3, 'App\\Models\\User', 485),
(3, 'App\\Models\\User', 486),
(3, 'App\\Models\\User', 487),
(3, 'App\\Models\\User', 488),
(3, 'App\\Models\\User', 489),
(3, 'App\\Models\\User', 490),
(3, 'App\\Models\\User', 491),
(3, 'App\\Models\\User', 492),
(3, 'App\\Models\\User', 493),
(3, 'App\\Models\\User', 494),
(3, 'App\\Models\\User', 495),
(3, 'App\\Models\\User', 496),
(3, 'App\\Models\\User', 497),
(3, 'App\\Models\\User', 498),
(3, 'App\\Models\\User', 499),
(3, 'App\\Models\\User', 500),
(3, 'App\\Models\\User', 501),
(3, 'App\\Models\\User', 502),
(3, 'App\\Models\\User', 503),
(3, 'App\\Models\\User', 504),
(3, 'App\\Models\\User', 505),
(3, 'App\\Models\\User', 506),
(3, 'App\\Models\\User', 507),
(3, 'App\\Models\\User', 508),
(3, 'App\\Models\\User', 509),
(3, 'App\\Models\\User', 510),
(3, 'App\\Models\\User', 511),
(3, 'App\\Models\\User', 512),
(3, 'App\\Models\\User', 513),
(3, 'App\\Models\\User', 514),
(3, 'App\\Models\\User', 515),
(3, 'App\\Models\\User', 516),
(3, 'App\\Models\\User', 517),
(3, 'App\\Models\\User', 518),
(3, 'App\\Models\\User', 519),
(3, 'App\\Models\\User', 520),
(3, 'App\\Models\\User', 521),
(3, 'App\\Models\\User', 522),
(3, 'App\\Models\\User', 523),
(3, 'App\\Models\\User', 524),
(3, 'App\\Models\\User', 525),
(3, 'App\\Models\\User', 526),
(3, 'App\\Models\\User', 527),
(3, 'App\\Models\\User', 528),
(3, 'App\\Models\\User', 529),
(3, 'App\\Models\\User', 530),
(3, 'App\\Models\\User', 531),
(3, 'App\\Models\\User', 532),
(3, 'App\\Models\\User', 533),
(3, 'App\\Models\\User', 534),
(3, 'App\\Models\\User', 535),
(3, 'App\\Models\\User', 536),
(3, 'App\\Models\\User', 537),
(3, 'App\\Models\\User', 538),
(3, 'App\\Models\\User', 539),
(3, 'App\\Models\\User', 540),
(3, 'App\\Models\\User', 541),
(3, 'App\\Models\\User', 542),
(3, 'App\\Models\\User', 543),
(3, 'App\\Models\\User', 544),
(3, 'App\\Models\\User', 545),
(3, 'App\\Models\\User', 546),
(3, 'App\\Models\\User', 547),
(3, 'App\\Models\\User', 548),
(3, 'App\\Models\\User', 549),
(3, 'App\\Models\\User', 550),
(3, 'App\\Models\\User', 551),
(3, 'App\\Models\\User', 552),
(3, 'App\\Models\\User', 553),
(3, 'App\\Models\\User', 554),
(3, 'App\\Models\\User', 555),
(3, 'App\\Models\\User', 556),
(3, 'App\\Models\\User', 557),
(3, 'App\\Models\\User', 558),
(3, 'App\\Models\\User', 559),
(3, 'App\\Models\\User', 560),
(3, 'App\\Models\\User', 561),
(3, 'App\\Models\\User', 562),
(3, 'App\\Models\\User', 563),
(3, 'App\\Models\\User', 564),
(3, 'App\\Models\\User', 565),
(3, 'App\\Models\\User', 566),
(3, 'App\\Models\\User', 567),
(3, 'App\\Models\\User', 568),
(3, 'App\\Models\\User', 569),
(3, 'App\\Models\\User', 570),
(3, 'App\\Models\\User', 571),
(3, 'App\\Models\\User', 572),
(3, 'App\\Models\\User', 573),
(3, 'App\\Models\\User', 574),
(3, 'App\\Models\\User', 575),
(3, 'App\\Models\\User', 576),
(3, 'App\\Models\\User', 577),
(3, 'App\\Models\\User', 578),
(3, 'App\\Models\\User', 579),
(3, 'App\\Models\\User', 580),
(3, 'App\\Models\\User', 581),
(3, 'App\\Models\\User', 582),
(3, 'App\\Models\\User', 583),
(3, 'App\\Models\\User', 584),
(3, 'App\\Models\\User', 585),
(3, 'App\\Models\\User', 586),
(3, 'App\\Models\\User', 587),
(3, 'App\\Models\\User', 588),
(3, 'App\\Models\\User', 589),
(3, 'App\\Models\\User', 590),
(3, 'App\\Models\\User', 591),
(3, 'App\\Models\\User', 592),
(3, 'App\\Models\\User', 593),
(3, 'App\\Models\\User', 594),
(3, 'App\\Models\\User', 595),
(3, 'App\\Models\\User', 596),
(3, 'App\\Models\\User', 597),
(3, 'App\\Models\\User', 598),
(3, 'App\\Models\\User', 599),
(3, 'App\\Models\\User', 600),
(3, 'App\\Models\\User', 601),
(3, 'App\\Models\\User', 602),
(3, 'App\\Models\\User', 603),
(3, 'App\\Models\\User', 604),
(3, 'App\\Models\\User', 605),
(3, 'App\\Models\\User', 606),
(3, 'App\\Models\\User', 607),
(3, 'App\\Models\\User', 608),
(3, 'App\\Models\\User', 609),
(3, 'App\\Models\\User', 610),
(3, 'App\\Models\\User', 611),
(3, 'App\\Models\\User', 612),
(3, 'App\\Models\\User', 613),
(3, 'App\\Models\\User', 614),
(3, 'App\\Models\\User', 615),
(3, 'App\\Models\\User', 616),
(3, 'App\\Models\\User', 617),
(3, 'App\\Models\\User', 618),
(3, 'App\\Models\\User', 619),
(3, 'App\\Models\\User', 620),
(3, 'App\\Models\\User', 621),
(3, 'App\\Models\\User', 622),
(3, 'App\\Models\\User', 623),
(3, 'App\\Models\\User', 624),
(3, 'App\\Models\\User', 625),
(3, 'App\\Models\\User', 626),
(3, 'App\\Models\\User', 627),
(3, 'App\\Models\\User', 628),
(3, 'App\\Models\\User', 629),
(3, 'App\\Models\\User', 630),
(3, 'App\\Models\\User', 631),
(3, 'App\\Models\\User', 632),
(3, 'App\\Models\\User', 633),
(3, 'App\\Models\\User', 634),
(3, 'App\\Models\\User', 635),
(3, 'App\\Models\\User', 636),
(3, 'App\\Models\\User', 637),
(3, 'App\\Models\\User', 638),
(3, 'App\\Models\\User', 639),
(3, 'App\\Models\\User', 640),
(3, 'App\\Models\\User', 641),
(3, 'App\\Models\\User', 642),
(3, 'App\\Models\\User', 643),
(3, 'App\\Models\\User', 644),
(3, 'App\\Models\\User', 645),
(3, 'App\\Models\\User', 646),
(3, 'App\\Models\\User', 647),
(3, 'App\\Models\\User', 648),
(3, 'App\\Models\\User', 649),
(3, 'App\\Models\\User', 650),
(3, 'App\\Models\\User', 651),
(3, 'App\\Models\\User', 652),
(3, 'App\\Models\\User', 653),
(3, 'App\\Models\\User', 654),
(3, 'App\\Models\\User', 655),
(3, 'App\\Models\\User', 656),
(3, 'App\\Models\\User', 657),
(3, 'App\\Models\\User', 658),
(3, 'App\\Models\\User', 659),
(3, 'App\\Models\\User', 660),
(3, 'App\\Models\\User', 661),
(3, 'App\\Models\\User', 662),
(3, 'App\\Models\\User', 663),
(3, 'App\\Models\\User', 664),
(3, 'App\\Models\\User', 665),
(3, 'App\\Models\\User', 666),
(3, 'App\\Models\\User', 667),
(3, 'App\\Models\\User', 668),
(3, 'App\\Models\\User', 669),
(3, 'App\\Models\\User', 670),
(3, 'App\\Models\\User', 671),
(3, 'App\\Models\\User', 672),
(3, 'App\\Models\\User', 673),
(3, 'App\\Models\\User', 674),
(3, 'App\\Models\\User', 675),
(3, 'App\\Models\\User', 676),
(3, 'App\\Models\\User', 677),
(3, 'App\\Models\\User', 678),
(3, 'App\\Models\\User', 679),
(3, 'App\\Models\\User', 680),
(3, 'App\\Models\\User', 681),
(3, 'App\\Models\\User', 682),
(3, 'App\\Models\\User', 683),
(3, 'App\\Models\\User', 684),
(3, 'App\\Models\\User', 685),
(3, 'App\\Models\\User', 686),
(3, 'App\\Models\\User', 687),
(3, 'App\\Models\\User', 688),
(3, 'App\\Models\\User', 689),
(3, 'App\\Models\\User', 690),
(3, 'App\\Models\\User', 691),
(3, 'App\\Models\\User', 692),
(3, 'App\\Models\\User', 693),
(3, 'App\\Models\\User', 694),
(3, 'App\\Models\\User', 695),
(3, 'App\\Models\\User', 696),
(3, 'App\\Models\\User', 697),
(3, 'App\\Models\\User', 698),
(3, 'App\\Models\\User', 699),
(3, 'App\\Models\\User', 700),
(3, 'App\\Models\\User', 701),
(3, 'App\\Models\\User', 702),
(3, 'App\\Models\\User', 703),
(3, 'App\\Models\\User', 704),
(3, 'App\\Models\\User', 705),
(3, 'App\\Models\\User', 706),
(3, 'App\\Models\\User', 707),
(3, 'App\\Models\\User', 708),
(3, 'App\\Models\\User', 709),
(3, 'App\\Models\\User', 710),
(3, 'App\\Models\\User', 711),
(3, 'App\\Models\\User', 712),
(3, 'App\\Models\\User', 713),
(3, 'App\\Models\\User', 714),
(3, 'App\\Models\\User', 715),
(3, 'App\\Models\\User', 716),
(3, 'App\\Models\\User', 717),
(3, 'App\\Models\\User', 718),
(3, 'App\\Models\\User', 719),
(3, 'App\\Models\\User', 720),
(3, 'App\\Models\\User', 721),
(3, 'App\\Models\\User', 722),
(3, 'App\\Models\\User', 723),
(3, 'App\\Models\\User', 724),
(3, 'App\\Models\\User', 725),
(3, 'App\\Models\\User', 726),
(3, 'App\\Models\\User', 727),
(3, 'App\\Models\\User', 728),
(3, 'App\\Models\\User', 729),
(3, 'App\\Models\\User', 730),
(3, 'App\\Models\\User', 731),
(3, 'App\\Models\\User', 732),
(3, 'App\\Models\\User', 733),
(3, 'App\\Models\\User', 734),
(3, 'App\\Models\\User', 735),
(3, 'App\\Models\\User', 736),
(3, 'App\\Models\\User', 737),
(3, 'App\\Models\\User', 738),
(3, 'App\\Models\\User', 739),
(3, 'App\\Models\\User', 740),
(3, 'App\\Models\\User', 741),
(3, 'App\\Models\\User', 742),
(3, 'App\\Models\\User', 743),
(3, 'App\\Models\\User', 744),
(3, 'App\\Models\\User', 745),
(3, 'App\\Models\\User', 746),
(3, 'App\\Models\\User', 747),
(3, 'App\\Models\\User', 748),
(3, 'App\\Models\\User', 749),
(3, 'App\\Models\\User', 750),
(3, 'App\\Models\\User', 751),
(3, 'App\\Models\\User', 752),
(3, 'App\\Models\\User', 753),
(3, 'App\\Models\\User', 754),
(3, 'App\\Models\\User', 755),
(3, 'App\\Models\\User', 756),
(3, 'App\\Models\\User', 757),
(3, 'App\\Models\\User', 758),
(3, 'App\\Models\\User', 759),
(3, 'App\\Models\\User', 760),
(3, 'App\\Models\\User', 761),
(3, 'App\\Models\\User', 762),
(3, 'App\\Models\\User', 763),
(3, 'App\\Models\\User', 764),
(3, 'App\\Models\\User', 765),
(3, 'App\\Models\\User', 766),
(3, 'App\\Models\\User', 767),
(3, 'App\\Models\\User', 768),
(3, 'App\\Models\\User', 769),
(3, 'App\\Models\\User', 770),
(3, 'App\\Models\\User', 771),
(3, 'App\\Models\\User', 772),
(3, 'App\\Models\\User', 773),
(3, 'App\\Models\\User', 774),
(3, 'App\\Models\\User', 775),
(3, 'App\\Models\\User', 776),
(3, 'App\\Models\\User', 777),
(3, 'App\\Models\\User', 778),
(3, 'App\\Models\\User', 779),
(3, 'App\\Models\\User', 780),
(3, 'App\\Models\\User', 781),
(3, 'App\\Models\\User', 782),
(3, 'App\\Models\\User', 783),
(3, 'App\\Models\\User', 784),
(3, 'App\\Models\\User', 785),
(3, 'App\\Models\\User', 786),
(3, 'App\\Models\\User', 787),
(3, 'App\\Models\\User', 788),
(3, 'App\\Models\\User', 789),
(3, 'App\\Models\\User', 790),
(3, 'App\\Models\\User', 791),
(3, 'App\\Models\\User', 792),
(3, 'App\\Models\\User', 793),
(3, 'App\\Models\\User', 794),
(3, 'App\\Models\\User', 795),
(3, 'App\\Models\\User', 796),
(3, 'App\\Models\\User', 797),
(3, 'App\\Models\\User', 798),
(3, 'App\\Models\\User', 799),
(3, 'App\\Models\\User', 800),
(3, 'App\\Models\\User', 801),
(3, 'App\\Models\\User', 802),
(3, 'App\\Models\\User', 803),
(3, 'App\\Models\\User', 804),
(3, 'App\\Models\\User', 805),
(3, 'App\\Models\\User', 806),
(3, 'App\\Models\\User', 807),
(3, 'App\\Models\\User', 808),
(3, 'App\\Models\\User', 809),
(3, 'App\\Models\\User', 810),
(3, 'App\\Models\\User', 811),
(3, 'App\\Models\\User', 812),
(3, 'App\\Models\\User', 813),
(3, 'App\\Models\\User', 814),
(3, 'App\\Models\\User', 815),
(3, 'App\\Models\\User', 816),
(3, 'App\\Models\\User', 817),
(3, 'App\\Models\\User', 818),
(3, 'App\\Models\\User', 819),
(3, 'App\\Models\\User', 820),
(3, 'App\\Models\\User', 821),
(3, 'App\\Models\\User', 822),
(3, 'App\\Models\\User', 823),
(3, 'App\\Models\\User', 824),
(3, 'App\\Models\\User', 825),
(3, 'App\\Models\\User', 826),
(3, 'App\\Models\\User', 827),
(3, 'App\\Models\\User', 828),
(3, 'App\\Models\\User', 829),
(3, 'App\\Models\\User', 830),
(3, 'App\\Models\\User', 831),
(3, 'App\\Models\\User', 832),
(3, 'App\\Models\\User', 833),
(3, 'App\\Models\\User', 834),
(3, 'App\\Models\\User', 835),
(3, 'App\\Models\\User', 836),
(3, 'App\\Models\\User', 837),
(3, 'App\\Models\\User', 838),
(3, 'App\\Models\\User', 839),
(3, 'App\\Models\\User', 840),
(3, 'App\\Models\\User', 841),
(3, 'App\\Models\\User', 842),
(3, 'App\\Models\\User', 843),
(3, 'App\\Models\\User', 844),
(3, 'App\\Models\\User', 845),
(3, 'App\\Models\\User', 846),
(3, 'App\\Models\\User', 847),
(3, 'App\\Models\\User', 848),
(3, 'App\\Models\\User', 849),
(3, 'App\\Models\\User', 850),
(3, 'App\\Models\\User', 851),
(3, 'App\\Models\\User', 852),
(3, 'App\\Models\\User', 853),
(3, 'App\\Models\\User', 854),
(3, 'App\\Models\\User', 855),
(3, 'App\\Models\\User', 856),
(3, 'App\\Models\\User', 857),
(3, 'App\\Models\\User', 858),
(3, 'App\\Models\\User', 859),
(3, 'App\\Models\\User', 860),
(3, 'App\\Models\\User', 861),
(3, 'App\\Models\\User', 862),
(3, 'App\\Models\\User', 863),
(3, 'App\\Models\\User', 864),
(3, 'App\\Models\\User', 865),
(3, 'App\\Models\\User', 866),
(3, 'App\\Models\\User', 867),
(3, 'App\\Models\\User', 868),
(3, 'App\\Models\\User', 869),
(3, 'App\\Models\\User', 870),
(3, 'App\\Models\\User', 871),
(3, 'App\\Models\\User', 872),
(3, 'App\\Models\\User', 873),
(3, 'App\\Models\\User', 874),
(3, 'App\\Models\\User', 875),
(3, 'App\\Models\\User', 876),
(3, 'App\\Models\\User', 877),
(3, 'App\\Models\\User', 878),
(3, 'App\\Models\\User', 879),
(3, 'App\\Models\\User', 880),
(3, 'App\\Models\\User', 881),
(3, 'App\\Models\\User', 882),
(3, 'App\\Models\\User', 883),
(3, 'App\\Models\\User', 884),
(3, 'App\\Models\\User', 885),
(3, 'App\\Models\\User', 886),
(3, 'App\\Models\\User', 887),
(3, 'App\\Models\\User', 888),
(3, 'App\\Models\\User', 889),
(3, 'App\\Models\\User', 890),
(3, 'App\\Models\\User', 891),
(3, 'App\\Models\\User', 892),
(3, 'App\\Models\\User', 893),
(3, 'App\\Models\\User', 894),
(3, 'App\\Models\\User', 895),
(3, 'App\\Models\\User', 896),
(3, 'App\\Models\\User', 897),
(3, 'App\\Models\\User', 898),
(3, 'App\\Models\\User', 899),
(3, 'App\\Models\\User', 900),
(3, 'App\\Models\\User', 901),
(3, 'App\\Models\\User', 902),
(3, 'App\\Models\\User', 903),
(3, 'App\\Models\\User', 904),
(3, 'App\\Models\\User', 905),
(3, 'App\\Models\\User', 906),
(3, 'App\\Models\\User', 907),
(3, 'App\\Models\\User', 908),
(3, 'App\\Models\\User', 909),
(3, 'App\\Models\\User', 910),
(3, 'App\\Models\\User', 911),
(3, 'App\\Models\\User', 912),
(3, 'App\\Models\\User', 913),
(3, 'App\\Models\\User', 914),
(3, 'App\\Models\\User', 915),
(3, 'App\\Models\\User', 916),
(3, 'App\\Models\\User', 917),
(3, 'App\\Models\\User', 918),
(3, 'App\\Models\\User', 919),
(3, 'App\\Models\\User', 920),
(3, 'App\\Models\\User', 921),
(3, 'App\\Models\\User', 922),
(3, 'App\\Models\\User', 923),
(3, 'App\\Models\\User', 924),
(3, 'App\\Models\\User', 925),
(3, 'App\\Models\\User', 926),
(3, 'App\\Models\\User', 927),
(3, 'App\\Models\\User', 928),
(3, 'App\\Models\\User', 929),
(3, 'App\\Models\\User', 930),
(3, 'App\\Models\\User', 931),
(3, 'App\\Models\\User', 932),
(3, 'App\\Models\\User', 933),
(3, 'App\\Models\\User', 934),
(3, 'App\\Models\\User', 935),
(3, 'App\\Models\\User', 936),
(3, 'App\\Models\\User', 937),
(3, 'App\\Models\\User', 938),
(3, 'App\\Models\\User', 939),
(3, 'App\\Models\\User', 940),
(3, 'App\\Models\\User', 941),
(3, 'App\\Models\\User', 942),
(3, 'App\\Models\\User', 943),
(3, 'App\\Models\\User', 944),
(3, 'App\\Models\\User', 945),
(3, 'App\\Models\\User', 946),
(3, 'App\\Models\\User', 947),
(3, 'App\\Models\\User', 948),
(3, 'App\\Models\\User', 949),
(3, 'App\\Models\\User', 950),
(3, 'App\\Models\\User', 951),
(3, 'App\\Models\\User', 952),
(3, 'App\\Models\\User', 953),
(3, 'App\\Models\\User', 954),
(3, 'App\\Models\\User', 955),
(3, 'App\\Models\\User', 956),
(3, 'App\\Models\\User', 957),
(3, 'App\\Models\\User', 958),
(3, 'App\\Models\\User', 959),
(3, 'App\\Models\\User', 960),
(3, 'App\\Models\\User', 961),
(3, 'App\\Models\\User', 962),
(3, 'App\\Models\\User', 963),
(3, 'App\\Models\\User', 964),
(3, 'App\\Models\\User', 965),
(3, 'App\\Models\\User', 966),
(3, 'App\\Models\\User', 967),
(3, 'App\\Models\\User', 968),
(3, 'App\\Models\\User', 969),
(3, 'App\\Models\\User', 970),
(3, 'App\\Models\\User', 971),
(3, 'App\\Models\\User', 972),
(3, 'App\\Models\\User', 973),
(3, 'App\\Models\\User', 974),
(3, 'App\\Models\\User', 975),
(3, 'App\\Models\\User', 976),
(3, 'App\\Models\\User', 977),
(3, 'App\\Models\\User', 978),
(3, 'App\\Models\\User', 979),
(3, 'App\\Models\\User', 980),
(3, 'App\\Models\\User', 981),
(3, 'App\\Models\\User', 982),
(3, 'App\\Models\\User', 983),
(3, 'App\\Models\\User', 984),
(3, 'App\\Models\\User', 985),
(3, 'App\\Models\\User', 986),
(3, 'App\\Models\\User', 987),
(3, 'App\\Models\\User', 988),
(3, 'App\\Models\\User', 989),
(3, 'App\\Models\\User', 990),
(3, 'App\\Models\\User', 991),
(3, 'App\\Models\\User', 992),
(3, 'App\\Models\\User', 993),
(3, 'App\\Models\\User', 994),
(3, 'App\\Models\\User', 995),
(3, 'App\\Models\\User', 996),
(3, 'App\\Models\\User', 997),
(3, 'App\\Models\\User', 998),
(3, 'App\\Models\\User', 999),
(3, 'App\\Models\\User', 1000),
(3, 'App\\Models\\User', 1001),
(3, 'App\\Models\\User', 1002),
(3, 'App\\Models\\User', 1003),
(3, 'App\\Models\\User', 1004),
(3, 'App\\Models\\User', 1005),
(3, 'App\\Models\\User', 1006),
(3, 'App\\Models\\User', 1007),
(3, 'App\\Models\\User', 1008),
(3, 'App\\Models\\User', 1009),
(3, 'App\\Models\\User', 1010),
(3, 'App\\Models\\User', 1011),
(3, 'App\\Models\\User', 1012),
(3, 'App\\Models\\User', 1013),
(3, 'App\\Models\\User', 1014),
(3, 'App\\Models\\User', 1015),
(3, 'App\\Models\\User', 1016),
(3, 'App\\Models\\User', 1017),
(3, 'App\\Models\\User', 1018),
(3, 'App\\Models\\User', 1019),
(3, 'App\\Models\\User', 1020),
(3, 'App\\Models\\User', 1021),
(3, 'App\\Models\\User', 1022),
(3, 'App\\Models\\User', 1023),
(3, 'App\\Models\\User', 1024),
(3, 'App\\Models\\User', 1025),
(3, 'App\\Models\\User', 1026),
(3, 'App\\Models\\User', 1027),
(3, 'App\\Models\\User', 1028),
(3, 'App\\Models\\User', 1029),
(3, 'App\\Models\\User', 1030),
(3, 'App\\Models\\User', 1031),
(3, 'App\\Models\\User', 1032),
(3, 'App\\Models\\User', 1033),
(3, 'App\\Models\\User', 1034),
(3, 'App\\Models\\User', 1035),
(3, 'App\\Models\\User', 1036),
(3, 'App\\Models\\User', 1037),
(3, 'App\\Models\\User', 1038),
(3, 'App\\Models\\User', 1039),
(3, 'App\\Models\\User', 1040),
(3, 'App\\Models\\User', 1041),
(3, 'App\\Models\\User', 1042),
(3, 'App\\Models\\User', 1043),
(3, 'App\\Models\\User', 1044),
(3, 'App\\Models\\User', 1045),
(3, 'App\\Models\\User', 1046),
(3, 'App\\Models\\User', 1047),
(3, 'App\\Models\\User', 1048),
(3, 'App\\Models\\User', 1049),
(3, 'App\\Models\\User', 1050),
(3, 'App\\Models\\User', 1051),
(3, 'App\\Models\\User', 1052),
(3, 'App\\Models\\User', 1053),
(3, 'App\\Models\\User', 1054),
(3, 'App\\Models\\User', 1055),
(3, 'App\\Models\\User', 1056),
(3, 'App\\Models\\User', 1057),
(3, 'App\\Models\\User', 1058),
(3, 'App\\Models\\User', 1059),
(3, 'App\\Models\\User', 1060),
(3, 'App\\Models\\User', 1061),
(3, 'App\\Models\\User', 1062),
(3, 'App\\Models\\User', 1063),
(3, 'App\\Models\\User', 1064),
(3, 'App\\Models\\User', 1065),
(3, 'App\\Models\\User', 1066),
(3, 'App\\Models\\User', 1067),
(3, 'App\\Models\\User', 1068),
(3, 'App\\Models\\User', 1069),
(3, 'App\\Models\\User', 1070),
(3, 'App\\Models\\User', 1071),
(3, 'App\\Models\\User', 1072),
(3, 'App\\Models\\User', 1073),
(3, 'App\\Models\\User', 1074),
(3, 'App\\Models\\User', 1075),
(3, 'App\\Models\\User', 1076),
(3, 'App\\Models\\User', 1077),
(3, 'App\\Models\\User', 1078),
(3, 'App\\Models\\User', 1079),
(3, 'App\\Models\\User', 1080),
(3, 'App\\Models\\User', 1081),
(3, 'App\\Models\\User', 1082),
(3, 'App\\Models\\User', 1083),
(3, 'App\\Models\\User', 1084),
(3, 'App\\Models\\User', 1085),
(3, 'App\\Models\\User', 1086),
(3, 'App\\Models\\User', 1087),
(3, 'App\\Models\\User', 1088),
(3, 'App\\Models\\User', 1089),
(3, 'App\\Models\\User', 1090),
(3, 'App\\Models\\User', 1091),
(3, 'App\\Models\\User', 1092),
(3, 'App\\Models\\User', 1093),
(3, 'App\\Models\\User', 1094),
(3, 'App\\Models\\User', 1095),
(3, 'App\\Models\\User', 1096),
(3, 'App\\Models\\User', 1097),
(3, 'App\\Models\\User', 1098),
(3, 'App\\Models\\User', 1099),
(3, 'App\\Models\\User', 1100),
(3, 'App\\Models\\User', 1101),
(3, 'App\\Models\\User', 1102),
(3, 'App\\Models\\User', 1103),
(3, 'App\\Models\\User', 1104),
(3, 'App\\Models\\User', 1105),
(3, 'App\\Models\\User', 1106),
(3, 'App\\Models\\User', 1107),
(3, 'App\\Models\\User', 1108),
(3, 'App\\Models\\User', 1109),
(3, 'App\\Models\\User', 1110),
(3, 'App\\Models\\User', 1111),
(3, 'App\\Models\\User', 1112),
(3, 'App\\Models\\User', 1113),
(3, 'App\\Models\\User', 1114),
(3, 'App\\Models\\User', 1115),
(3, 'App\\Models\\User', 1116),
(3, 'App\\Models\\User', 1117),
(3, 'App\\Models\\User', 1118),
(3, 'App\\Models\\User', 1119),
(3, 'App\\Models\\User', 1120),
(3, 'App\\Models\\User', 1121),
(3, 'App\\Models\\User', 1122),
(3, 'App\\Models\\User', 1123),
(3, 'App\\Models\\User', 1124),
(3, 'App\\Models\\User', 1125),
(3, 'App\\Models\\User', 1126),
(3, 'App\\Models\\User', 1127),
(3, 'App\\Models\\User', 1128),
(3, 'App\\Models\\User', 1129),
(3, 'App\\Models\\User', 1130),
(3, 'App\\Models\\User', 1131),
(3, 'App\\Models\\User', 1132),
(3, 'App\\Models\\User', 1133),
(3, 'App\\Models\\User', 1134),
(3, 'App\\Models\\User', 1135),
(3, 'App\\Models\\User', 1136),
(3, 'App\\Models\\User', 1137),
(3, 'App\\Models\\User', 1138),
(3, 'App\\Models\\User', 1139),
(3, 'App\\Models\\User', 1140),
(3, 'App\\Models\\User', 1141),
(3, 'App\\Models\\User', 1142),
(3, 'App\\Models\\User', 1143),
(3, 'App\\Models\\User', 1144),
(3, 'App\\Models\\User', 1145),
(3, 'App\\Models\\User', 1146),
(3, 'App\\Models\\User', 1147),
(3, 'App\\Models\\User', 1148),
(3, 'App\\Models\\User', 1149),
(3, 'App\\Models\\User', 1150),
(3, 'App\\Models\\User', 1151),
(3, 'App\\Models\\User', 1152),
(3, 'App\\Models\\User', 1153),
(3, 'App\\Models\\User', 1154),
(3, 'App\\Models\\User', 1155),
(3, 'App\\Models\\User', 1156),
(3, 'App\\Models\\User', 1157),
(3, 'App\\Models\\User', 1158),
(3, 'App\\Models\\User', 1159),
(3, 'App\\Models\\User', 1160),
(3, 'App\\Models\\User', 1161),
(3, 'App\\Models\\User', 1162),
(3, 'App\\Models\\User', 1163),
(3, 'App\\Models\\User', 1164),
(3, 'App\\Models\\User', 1165),
(3, 'App\\Models\\User', 1166),
(3, 'App\\Models\\User', 1167),
(3, 'App\\Models\\User', 1168),
(3, 'App\\Models\\User', 1169),
(3, 'App\\Models\\User', 1170),
(3, 'App\\Models\\User', 1171),
(3, 'App\\Models\\User', 1172),
(3, 'App\\Models\\User', 1173),
(3, 'App\\Models\\User', 1174),
(3, 'App\\Models\\User', 1175),
(3, 'App\\Models\\User', 1176),
(3, 'App\\Models\\User', 1177),
(3, 'App\\Models\\User', 1178),
(3, 'App\\Models\\User', 1179),
(3, 'App\\Models\\User', 1180),
(3, 'App\\Models\\User', 1181),
(3, 'App\\Models\\User', 1182),
(3, 'App\\Models\\User', 1183),
(3, 'App\\Models\\User', 1184),
(3, 'App\\Models\\User', 1185),
(3, 'App\\Models\\User', 1186),
(3, 'App\\Models\\User', 1187),
(3, 'App\\Models\\User', 1188),
(3, 'App\\Models\\User', 1189),
(3, 'App\\Models\\User', 1190),
(3, 'App\\Models\\User', 1191),
(3, 'App\\Models\\User', 1192),
(3, 'App\\Models\\User', 1193),
(3, 'App\\Models\\User', 1194),
(3, 'App\\Models\\User', 1195),
(3, 'App\\Models\\User', 1196),
(3, 'App\\Models\\User', 1197),
(3, 'App\\Models\\User', 1198),
(3, 'App\\Models\\User', 1199),
(3, 'App\\Models\\User', 1200),
(3, 'App\\Models\\User', 1201),
(3, 'App\\Models\\User', 1202),
(3, 'App\\Models\\User', 1203),
(3, 'App\\Models\\User', 1204),
(3, 'App\\Models\\User', 1205),
(3, 'App\\Models\\User', 1206),
(3, 'App\\Models\\User', 1207),
(3, 'App\\Models\\User', 1208),
(3, 'App\\Models\\User', 1209),
(3, 'App\\Models\\User', 1210),
(3, 'App\\Models\\User', 1211),
(3, 'App\\Models\\User', 1212),
(3, 'App\\Models\\User', 1213),
(3, 'App\\Models\\User', 1214),
(3, 'App\\Models\\User', 1215),
(3, 'App\\Models\\User', 1216),
(3, 'App\\Models\\User', 1217),
(3, 'App\\Models\\User', 1218),
(3, 'App\\Models\\User', 1219),
(3, 'App\\Models\\User', 1220),
(3, 'App\\Models\\User', 1221),
(3, 'App\\Models\\User', 1222),
(3, 'App\\Models\\User', 1223),
(3, 'App\\Models\\User', 1224),
(3, 'App\\Models\\User', 1225),
(3, 'App\\Models\\User', 1226),
(3, 'App\\Models\\User', 1227),
(3, 'App\\Models\\User', 1228),
(3, 'App\\Models\\User', 1229),
(3, 'App\\Models\\User', 1230),
(3, 'App\\Models\\User', 1231),
(3, 'App\\Models\\User', 1232),
(3, 'App\\Models\\User', 1233),
(3, 'App\\Models\\User', 1234),
(3, 'App\\Models\\User', 1235),
(3, 'App\\Models\\User', 1236),
(3, 'App\\Models\\User', 1237),
(3, 'App\\Models\\User', 1238),
(3, 'App\\Models\\User', 1239),
(3, 'App\\Models\\User', 1240),
(3, 'App\\Models\\User', 1241),
(3, 'App\\Models\\User', 1242),
(3, 'App\\Models\\User', 1243),
(3, 'App\\Models\\User', 1244),
(3, 'App\\Models\\User', 1245),
(3, 'App\\Models\\User', 1246),
(3, 'App\\Models\\User', 1247),
(3, 'App\\Models\\User', 1248),
(3, 'App\\Models\\User', 1249),
(3, 'App\\Models\\User', 1250),
(3, 'App\\Models\\User', 1251),
(3, 'App\\Models\\User', 1252),
(3, 'App\\Models\\User', 1253),
(3, 'App\\Models\\User', 1254),
(3, 'App\\Models\\User', 1255),
(3, 'App\\Models\\User', 1256),
(3, 'App\\Models\\User', 1257),
(3, 'App\\Models\\User', 1258),
(3, 'App\\Models\\User', 1259),
(3, 'App\\Models\\User', 1260),
(3, 'App\\Models\\User', 1261),
(3, 'App\\Models\\User', 1262),
(3, 'App\\Models\\User', 1263),
(3, 'App\\Models\\User', 1264),
(3, 'App\\Models\\User', 1265),
(3, 'App\\Models\\User', 1266),
(3, 'App\\Models\\User', 1267),
(3, 'App\\Models\\User', 1268),
(3, 'App\\Models\\User', 1269),
(3, 'App\\Models\\User', 1270),
(3, 'App\\Models\\User', 1271),
(3, 'App\\Models\\User', 1272),
(3, 'App\\Models\\User', 1273),
(3, 'App\\Models\\User', 1274),
(3, 'App\\Models\\User', 1275),
(3, 'App\\Models\\User', 1276),
(3, 'App\\Models\\User', 1277),
(3, 'App\\Models\\User', 1278),
(3, 'App\\Models\\User', 1279),
(3, 'App\\Models\\User', 1280),
(3, 'App\\Models\\User', 1281),
(3, 'App\\Models\\User', 1282),
(3, 'App\\Models\\User', 1283),
(3, 'App\\Models\\User', 1284),
(3, 'App\\Models\\User', 1285),
(3, 'App\\Models\\User', 1286),
(3, 'App\\Models\\User', 1287),
(3, 'App\\Models\\User', 1288),
(3, 'App\\Models\\User', 1289),
(3, 'App\\Models\\User', 1290),
(3, 'App\\Models\\User', 1291),
(3, 'App\\Models\\User', 1292),
(3, 'App\\Models\\User', 1293),
(3, 'App\\Models\\User', 1294),
(3, 'App\\Models\\User', 1295),
(3, 'App\\Models\\User', 1296),
(3, 'App\\Models\\User', 1297),
(3, 'App\\Models\\User', 1298),
(3, 'App\\Models\\User', 1299),
(3, 'App\\Models\\User', 1300),
(3, 'App\\Models\\User', 1301),
(3, 'App\\Models\\User', 1302),
(3, 'App\\Models\\User', 1303),
(3, 'App\\Models\\User', 1304),
(3, 'App\\Models\\User', 1305),
(3, 'App\\Models\\User', 1306),
(3, 'App\\Models\\User', 1307),
(3, 'App\\Models\\User', 1308),
(3, 'App\\Models\\User', 1309),
(3, 'App\\Models\\User', 1310),
(3, 'App\\Models\\User', 1311),
(3, 'App\\Models\\User', 1312),
(3, 'App\\Models\\User', 1313),
(3, 'App\\Models\\User', 1314),
(3, 'App\\Models\\User', 1315),
(3, 'App\\Models\\User', 1316),
(3, 'App\\Models\\User', 1317),
(3, 'App\\Models\\User', 1318),
(3, 'App\\Models\\User', 1319),
(3, 'App\\Models\\User', 1320),
(3, 'App\\Models\\User', 1321),
(3, 'App\\Models\\User', 1322),
(3, 'App\\Models\\User', 1323),
(3, 'App\\Models\\User', 1324),
(3, 'App\\Models\\User', 1325),
(3, 'App\\Models\\User', 1326),
(3, 'App\\Models\\User', 1327),
(3, 'App\\Models\\User', 1328),
(3, 'App\\Models\\User', 1329),
(3, 'App\\Models\\User', 1330),
(3, 'App\\Models\\User', 1331),
(3, 'App\\Models\\User', 1332),
(3, 'App\\Models\\User', 1333),
(3, 'App\\Models\\User', 1334),
(3, 'App\\Models\\User', 1335),
(3, 'App\\Models\\User', 1336),
(3, 'App\\Models\\User', 1337),
(3, 'App\\Models\\User', 1338),
(3, 'App\\Models\\User', 1339),
(3, 'App\\Models\\User', 1340),
(3, 'App\\Models\\User', 1341),
(3, 'App\\Models\\User', 1342),
(3, 'App\\Models\\User', 1343),
(3, 'App\\Models\\User', 1344),
(3, 'App\\Models\\User', 1345),
(3, 'App\\Models\\User', 1346),
(3, 'App\\Models\\User', 1347),
(3, 'App\\Models\\User', 1348),
(3, 'App\\Models\\User', 1349),
(3, 'App\\Models\\User', 1350),
(3, 'App\\Models\\User', 1351),
(3, 'App\\Models\\User', 1352),
(3, 'App\\Models\\User', 1353),
(3, 'App\\Models\\User', 1354),
(3, 'App\\Models\\User', 1355),
(3, 'App\\Models\\User', 1356),
(3, 'App\\Models\\User', 1357),
(3, 'App\\Models\\User', 1358),
(3, 'App\\Models\\User', 1359),
(3, 'App\\Models\\User', 1360),
(3, 'App\\Models\\User', 1361),
(3, 'App\\Models\\User', 1362),
(3, 'App\\Models\\User', 1363),
(3, 'App\\Models\\User', 1364),
(3, 'App\\Models\\User', 1365),
(3, 'App\\Models\\User', 1366),
(3, 'App\\Models\\User', 1367),
(3, 'App\\Models\\User', 1368),
(3, 'App\\Models\\User', 1369),
(3, 'App\\Models\\User', 1370),
(3, 'App\\Models\\User', 1371),
(3, 'App\\Models\\User', 1372),
(3, 'App\\Models\\User', 1373),
(3, 'App\\Models\\User', 1374),
(3, 'App\\Models\\User', 1375),
(3, 'App\\Models\\User', 1376),
(3, 'App\\Models\\User', 1377),
(3, 'App\\Models\\User', 1378),
(3, 'App\\Models\\User', 1379),
(3, 'App\\Models\\User', 1380),
(3, 'App\\Models\\User', 1381),
(3, 'App\\Models\\User', 1382),
(3, 'App\\Models\\User', 1383),
(3, 'App\\Models\\User', 1384),
(3, 'App\\Models\\User', 1385),
(3, 'App\\Models\\User', 1386),
(3, 'App\\Models\\User', 1387),
(3, 'App\\Models\\User', 1388),
(3, 'App\\Models\\User', 1389),
(3, 'App\\Models\\User', 1390),
(3, 'App\\Models\\User', 1391),
(3, 'App\\Models\\User', 1392),
(3, 'App\\Models\\User', 1393),
(3, 'App\\Models\\User', 1394),
(3, 'App\\Models\\User', 1395),
(3, 'App\\Models\\User', 1396),
(3, 'App\\Models\\User', 1397),
(3, 'App\\Models\\User', 1398),
(3, 'App\\Models\\User', 1399),
(3, 'App\\Models\\User', 1400),
(3, 'App\\Models\\User', 1401),
(3, 'App\\Models\\User', 1402),
(3, 'App\\Models\\User', 1403),
(3, 'App\\Models\\User', 1404),
(3, 'App\\Models\\User', 1405),
(3, 'App\\Models\\User', 1406),
(3, 'App\\Models\\User', 1407),
(3, 'App\\Models\\User', 1408),
(3, 'App\\Models\\User', 1409),
(3, 'App\\Models\\User', 1410),
(3, 'App\\Models\\User', 1411),
(3, 'App\\Models\\User', 1412),
(3, 'App\\Models\\User', 1413),
(3, 'App\\Models\\User', 1414),
(3, 'App\\Models\\User', 1415),
(3, 'App\\Models\\User', 1416),
(3, 'App\\Models\\User', 1417),
(3, 'App\\Models\\User', 1418),
(3, 'App\\Models\\User', 1419),
(3, 'App\\Models\\User', 1420),
(3, 'App\\Models\\User', 1421),
(3, 'App\\Models\\User', 1422),
(3, 'App\\Models\\User', 1423),
(3, 'App\\Models\\User', 1424),
(3, 'App\\Models\\User', 1425),
(3, 'App\\Models\\User', 1426),
(3, 'App\\Models\\User', 1427),
(3, 'App\\Models\\User', 1428),
(3, 'App\\Models\\User', 1429),
(3, 'App\\Models\\User', 1430),
(3, 'App\\Models\\User', 1431),
(3, 'App\\Models\\User', 1432),
(3, 'App\\Models\\User', 1433),
(3, 'App\\Models\\User', 1434),
(3, 'App\\Models\\User', 1435),
(3, 'App\\Models\\User', 1436),
(3, 'App\\Models\\User', 1437),
(3, 'App\\Models\\User', 1438),
(3, 'App\\Models\\User', 1439),
(3, 'App\\Models\\User', 1440),
(3, 'App\\Models\\User', 1441),
(3, 'App\\Models\\User', 1442),
(3, 'App\\Models\\User', 1443),
(3, 'App\\Models\\User', 1444),
(3, 'App\\Models\\User', 1445),
(3, 'App\\Models\\User', 1446),
(3, 'App\\Models\\User', 1447),
(3, 'App\\Models\\User', 1448),
(3, 'App\\Models\\User', 1449),
(3, 'App\\Models\\User', 1450),
(3, 'App\\Models\\User', 1451),
(3, 'App\\Models\\User', 1452),
(3, 'App\\Models\\User', 1453),
(3, 'App\\Models\\User', 1454),
(3, 'App\\Models\\User', 1455),
(3, 'App\\Models\\User', 1456),
(3, 'App\\Models\\User', 1457),
(3, 'App\\Models\\User', 1458),
(3, 'App\\Models\\User', 1459),
(3, 'App\\Models\\User', 1460),
(3, 'App\\Models\\User', 1461),
(3, 'App\\Models\\User', 1462),
(3, 'App\\Models\\User', 1463),
(3, 'App\\Models\\User', 1464),
(3, 'App\\Models\\User', 1465),
(3, 'App\\Models\\User', 1466),
(3, 'App\\Models\\User', 1467),
(3, 'App\\Models\\User', 1468),
(3, 'App\\Models\\User', 1469),
(3, 'App\\Models\\User', 1470),
(3, 'App\\Models\\User', 1471),
(3, 'App\\Models\\User', 1472),
(3, 'App\\Models\\User', 1473),
(3, 'App\\Models\\User', 1474),
(3, 'App\\Models\\User', 1475),
(3, 'App\\Models\\User', 1476),
(3, 'App\\Models\\User', 1477),
(3, 'App\\Models\\User', 1478),
(3, 'App\\Models\\User', 1479),
(3, 'App\\Models\\User', 1480),
(3, 'App\\Models\\User', 1481),
(3, 'App\\Models\\User', 1482),
(3, 'App\\Models\\User', 1483),
(3, 'App\\Models\\User', 1484),
(3, 'App\\Models\\User', 1485),
(3, 'App\\Models\\User', 1486),
(3, 'App\\Models\\User', 1487),
(3, 'App\\Models\\User', 1488),
(3, 'App\\Models\\User', 1489),
(3, 'App\\Models\\User', 1490),
(3, 'App\\Models\\User', 1491),
(3, 'App\\Models\\User', 1492),
(3, 'App\\Models\\User', 1493),
(3, 'App\\Models\\User', 1494),
(3, 'App\\Models\\User', 1495),
(3, 'App\\Models\\User', 1496),
(3, 'App\\Models\\User', 1497),
(3, 'App\\Models\\User', 1498),
(3, 'App\\Models\\User', 1499),
(3, 'App\\Models\\User', 1500),
(3, 'App\\Models\\User', 1501),
(3, 'App\\Models\\User', 1502),
(3, 'App\\Models\\User', 1503),
(3, 'App\\Models\\User', 1504),
(3, 'App\\Models\\User', 1505),
(3, 'App\\Models\\User', 1506),
(3, 'App\\Models\\User', 1507),
(3, 'App\\Models\\User', 1508),
(3, 'App\\Models\\User', 1509),
(3, 'App\\Models\\User', 1510),
(3, 'App\\Models\\User', 1511),
(3, 'App\\Models\\User', 1512),
(3, 'App\\Models\\User', 1513),
(3, 'App\\Models\\User', 1514),
(3, 'App\\Models\\User', 1515),
(3, 'App\\Models\\User', 1516),
(3, 'App\\Models\\User', 1517),
(3, 'App\\Models\\User', 1518),
(3, 'App\\Models\\User', 1519),
(3, 'App\\Models\\User', 1520),
(3, 'App\\Models\\User', 1521),
(3, 'App\\Models\\User', 1522),
(3, 'App\\Models\\User', 1523),
(3, 'App\\Models\\User', 1524),
(3, 'App\\Models\\User', 1525),
(3, 'App\\Models\\User', 1526),
(3, 'App\\Models\\User', 1527),
(3, 'App\\Models\\User', 1528),
(3, 'App\\Models\\User', 1529),
(3, 'App\\Models\\User', 1530),
(3, 'App\\Models\\User', 1531),
(3, 'App\\Models\\User', 1532),
(3, 'App\\Models\\User', 1533),
(3, 'App\\Models\\User', 1534),
(3, 'App\\Models\\User', 1535),
(3, 'App\\Models\\User', 1536),
(3, 'App\\Models\\User', 1537),
(3, 'App\\Models\\User', 1538),
(3, 'App\\Models\\User', 1539),
(3, 'App\\Models\\User', 1540),
(3, 'App\\Models\\User', 1541),
(3, 'App\\Models\\User', 1542),
(3, 'App\\Models\\User', 1543),
(3, 'App\\Models\\User', 1544),
(3, 'App\\Models\\User', 1545),
(3, 'App\\Models\\User', 1546),
(3, 'App\\Models\\User', 1547),
(3, 'App\\Models\\User', 1548),
(3, 'App\\Models\\User', 1549),
(3, 'App\\Models\\User', 1550),
(3, 'App\\Models\\User', 1551),
(3, 'App\\Models\\User', 1552),
(3, 'App\\Models\\User', 1553),
(3, 'App\\Models\\User', 1554),
(3, 'App\\Models\\User', 1555),
(3, 'App\\Models\\User', 1556),
(3, 'App\\Models\\User', 1557),
(3, 'App\\Models\\User', 1558),
(3, 'App\\Models\\User', 1559),
(3, 'App\\Models\\User', 1560),
(3, 'App\\Models\\User', 1561),
(3, 'App\\Models\\User', 1562),
(3, 'App\\Models\\User', 1563),
(3, 'App\\Models\\User', 1564),
(3, 'App\\Models\\User', 1565),
(3, 'App\\Models\\User', 1566),
(3, 'App\\Models\\User', 1567),
(3, 'App\\Models\\User', 1568),
(3, 'App\\Models\\User', 1569),
(3, 'App\\Models\\User', 1570),
(3, 'App\\Models\\User', 1571),
(3, 'App\\Models\\User', 1572),
(3, 'App\\Models\\User', 1573),
(3, 'App\\Models\\User', 1574),
(3, 'App\\Models\\User', 1575),
(3, 'App\\Models\\User', 1576),
(3, 'App\\Models\\User', 1577),
(3, 'App\\Models\\User', 1578),
(3, 'App\\Models\\User', 1579),
(3, 'App\\Models\\User', 1580),
(3, 'App\\Models\\User', 1581),
(3, 'App\\Models\\User', 1582),
(3, 'App\\Models\\User', 1583),
(3, 'App\\Models\\User', 1584),
(3, 'App\\Models\\User', 1585),
(3, 'App\\Models\\User', 1586),
(3, 'App\\Models\\User', 1587),
(3, 'App\\Models\\User', 1588),
(3, 'App\\Models\\User', 1589),
(3, 'App\\Models\\User', 1590),
(3, 'App\\Models\\User', 1591),
(3, 'App\\Models\\User', 1592),
(3, 'App\\Models\\User', 1593),
(3, 'App\\Models\\User', 1594),
(3, 'App\\Models\\User', 1595),
(3, 'App\\Models\\User', 1596),
(3, 'App\\Models\\User', 1597),
(3, 'App\\Models\\User', 1598),
(3, 'App\\Models\\User', 1599),
(3, 'App\\Models\\User', 1600),
(3, 'App\\Models\\User', 1601),
(3, 'App\\Models\\User', 1602),
(3, 'App\\Models\\User', 1603),
(3, 'App\\Models\\User', 1604),
(3, 'App\\Models\\User', 1605),
(3, 'App\\Models\\User', 1606),
(3, 'App\\Models\\User', 1607),
(3, 'App\\Models\\User', 1608),
(3, 'App\\Models\\User', 1609),
(3, 'App\\Models\\User', 1610),
(3, 'App\\Models\\User', 1611),
(3, 'App\\Models\\User', 1612),
(3, 'App\\Models\\User', 1613),
(3, 'App\\Models\\User', 1614),
(3, 'App\\Models\\User', 1615),
(3, 'App\\Models\\User', 1616),
(3, 'App\\Models\\User', 1617),
(3, 'App\\Models\\User', 1618),
(3, 'App\\Models\\User', 1619),
(3, 'App\\Models\\User', 1620),
(3, 'App\\Models\\User', 1621),
(3, 'App\\Models\\User', 1622),
(3, 'App\\Models\\User', 1623),
(3, 'App\\Models\\User', 1624),
(3, 'App\\Models\\User', 1625),
(3, 'App\\Models\\User', 1626),
(3, 'App\\Models\\User', 1627),
(3, 'App\\Models\\User', 1628),
(3, 'App\\Models\\User', 1629),
(3, 'App\\Models\\User', 1630),
(3, 'App\\Models\\User', 1631),
(3, 'App\\Models\\User', 1632),
(3, 'App\\Models\\User', 1633),
(3, 'App\\Models\\User', 1634),
(3, 'App\\Models\\User', 1635),
(3, 'App\\Models\\User', 1636),
(3, 'App\\Models\\User', 1637),
(3, 'App\\Models\\User', 1638),
(3, 'App\\Models\\User', 1639),
(3, 'App\\Models\\User', 1640),
(3, 'App\\Models\\User', 1641),
(3, 'App\\Models\\User', 1642),
(3, 'App\\Models\\User', 1643),
(3, 'App\\Models\\User', 1644),
(3, 'App\\Models\\User', 1645),
(3, 'App\\Models\\User', 1646),
(3, 'App\\Models\\User', 1647),
(3, 'App\\Models\\User', 1648),
(3, 'App\\Models\\User', 1649),
(3, 'App\\Models\\User', 1650),
(3, 'App\\Models\\User', 1651),
(3, 'App\\Models\\User', 1652),
(3, 'App\\Models\\User', 1653),
(3, 'App\\Models\\User', 1654),
(3, 'App\\Models\\User', 1655),
(3, 'App\\Models\\User', 1656),
(3, 'App\\Models\\User', 1657),
(3, 'App\\Models\\User', 1658),
(3, 'App\\Models\\User', 1659),
(3, 'App\\Models\\User', 1660),
(3, 'App\\Models\\User', 1661),
(3, 'App\\Models\\User', 1662),
(3, 'App\\Models\\User', 1663),
(3, 'App\\Models\\User', 1664),
(3, 'App\\Models\\User', 1665),
(3, 'App\\Models\\User', 1666),
(3, 'App\\Models\\User', 1667),
(3, 'App\\Models\\User', 1668),
(3, 'App\\Models\\User', 1669),
(3, 'App\\Models\\User', 1670),
(3, 'App\\Models\\User', 1671),
(3, 'App\\Models\\User', 1672),
(3, 'App\\Models\\User', 1673),
(3, 'App\\Models\\User', 1674),
(3, 'App\\Models\\User', 1675),
(3, 'App\\Models\\User', 1676),
(3, 'App\\Models\\User', 1677),
(3, 'App\\Models\\User', 1678),
(3, 'App\\Models\\User', 1679),
(3, 'App\\Models\\User', 1680),
(3, 'App\\Models\\User', 1681),
(3, 'App\\Models\\User', 1682),
(3, 'App\\Models\\User', 1683),
(3, 'App\\Models\\User', 1684),
(3, 'App\\Models\\User', 1685),
(3, 'App\\Models\\User', 1686),
(3, 'App\\Models\\User', 1687),
(3, 'App\\Models\\User', 1688),
(3, 'App\\Models\\User', 1689),
(3, 'App\\Models\\User', 1690),
(3, 'App\\Models\\User', 1691),
(3, 'App\\Models\\User', 1692),
(3, 'App\\Models\\User', 1693),
(3, 'App\\Models\\User', 1694),
(3, 'App\\Models\\User', 1695),
(3, 'App\\Models\\User', 1696),
(3, 'App\\Models\\User', 1697),
(3, 'App\\Models\\User', 1698),
(3, 'App\\Models\\User', 1699),
(3, 'App\\Models\\User', 1700),
(3, 'App\\Models\\User', 1701),
(3, 'App\\Models\\User', 1702),
(3, 'App\\Models\\User', 1703),
(3, 'App\\Models\\User', 1704),
(3, 'App\\Models\\User', 1705),
(3, 'App\\Models\\User', 1706),
(3, 'App\\Models\\User', 1707),
(3, 'App\\Models\\User', 1708),
(3, 'App\\Models\\User', 1709),
(3, 'App\\Models\\User', 1710),
(3, 'App\\Models\\User', 1711),
(3, 'App\\Models\\User', 1712),
(3, 'App\\Models\\User', 1713),
(3, 'App\\Models\\User', 1714),
(3, 'App\\Models\\User', 1715),
(3, 'App\\Models\\User', 1716),
(3, 'App\\Models\\User', 1717),
(3, 'App\\Models\\User', 1718),
(3, 'App\\Models\\User', 1719),
(3, 'App\\Models\\User', 1720),
(3, 'App\\Models\\User', 1721),
(3, 'App\\Models\\User', 1722),
(3, 'App\\Models\\User', 1723),
(3, 'App\\Models\\User', 1724),
(3, 'App\\Models\\User', 1725),
(3, 'App\\Models\\User', 1726),
(3, 'App\\Models\\User', 1727),
(3, 'App\\Models\\User', 1728),
(3, 'App\\Models\\User', 1729),
(3, 'App\\Models\\User', 1730),
(3, 'App\\Models\\User', 1731),
(3, 'App\\Models\\User', 1732),
(3, 'App\\Models\\User', 1733),
(3, 'App\\Models\\User', 1734),
(3, 'App\\Models\\User', 1735),
(3, 'App\\Models\\User', 1736),
(3, 'App\\Models\\User', 1737),
(3, 'App\\Models\\User', 1738),
(3, 'App\\Models\\User', 1739),
(3, 'App\\Models\\User', 1740),
(3, 'App\\Models\\User', 1741),
(3, 'App\\Models\\User', 1742),
(3, 'App\\Models\\User', 1743),
(3, 'App\\Models\\User', 1744),
(3, 'App\\Models\\User', 1745),
(3, 'App\\Models\\User', 1746),
(3, 'App\\Models\\User', 1747),
(3, 'App\\Models\\User', 1748),
(3, 'App\\Models\\User', 1749),
(3, 'App\\Models\\User', 1750),
(3, 'App\\Models\\User', 1751),
(3, 'App\\Models\\User', 1752),
(3, 'App\\Models\\User', 1753),
(3, 'App\\Models\\User', 1754),
(3, 'App\\Models\\User', 1755),
(3, 'App\\Models\\User', 1756),
(3, 'App\\Models\\User', 1757),
(3, 'App\\Models\\User', 1758),
(3, 'App\\Models\\User', 1759),
(3, 'App\\Models\\User', 1760),
(3, 'App\\Models\\User', 1761),
(3, 'App\\Models\\User', 1762),
(3, 'App\\Models\\User', 1763),
(3, 'App\\Models\\User', 1764),
(3, 'App\\Models\\User', 1765),
(3, 'App\\Models\\User', 1766),
(3, 'App\\Models\\User', 1767),
(3, 'App\\Models\\User', 1768),
(3, 'App\\Models\\User', 1769),
(3, 'App\\Models\\User', 1770),
(3, 'App\\Models\\User', 1771),
(3, 'App\\Models\\User', 1772),
(3, 'App\\Models\\User', 1773),
(3, 'App\\Models\\User', 1774),
(3, 'App\\Models\\User', 1775),
(3, 'App\\Models\\User', 1776),
(3, 'App\\Models\\User', 1777),
(3, 'App\\Models\\User', 1778),
(3, 'App\\Models\\User', 1779),
(3, 'App\\Models\\User', 1780),
(3, 'App\\Models\\User', 1781),
(3, 'App\\Models\\User', 1782),
(3, 'App\\Models\\User', 1783),
(3, 'App\\Models\\User', 1784),
(3, 'App\\Models\\User', 1785),
(3, 'App\\Models\\User', 1786),
(3, 'App\\Models\\User', 1787),
(3, 'App\\Models\\User', 1788),
(3, 'App\\Models\\User', 1789),
(3, 'App\\Models\\User', 1790),
(3, 'App\\Models\\User', 1791),
(3, 'App\\Models\\User', 1792),
(3, 'App\\Models\\User', 1793),
(3, 'App\\Models\\User', 1794),
(3, 'App\\Models\\User', 1795),
(3, 'App\\Models\\User', 1796),
(3, 'App\\Models\\User', 1797),
(3, 'App\\Models\\User', 1798),
(3, 'App\\Models\\User', 1799),
(3, 'App\\Models\\User', 1800),
(3, 'App\\Models\\User', 1801),
(3, 'App\\Models\\User', 1802),
(3, 'App\\Models\\User', 1803),
(3, 'App\\Models\\User', 1804),
(3, 'App\\Models\\User', 1805),
(3, 'App\\Models\\User', 1806),
(3, 'App\\Models\\User', 1807),
(3, 'App\\Models\\User', 1808),
(3, 'App\\Models\\User', 1809),
(3, 'App\\Models\\User', 1810),
(3, 'App\\Models\\User', 1811),
(3, 'App\\Models\\User', 1812),
(3, 'App\\Models\\User', 1813),
(3, 'App\\Models\\User', 1814),
(3, 'App\\Models\\User', 1815),
(3, 'App\\Models\\User', 1816),
(3, 'App\\Models\\User', 1817),
(3, 'App\\Models\\User', 1818),
(3, 'App\\Models\\User', 1819),
(3, 'App\\Models\\User', 1820);
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1821),
(3, 'App\\Models\\User', 1822),
(3, 'App\\Models\\User', 1823),
(3, 'App\\Models\\User', 1824),
(3, 'App\\Models\\User', 1825),
(3, 'App\\Models\\User', 1826),
(3, 'App\\Models\\User', 1827),
(3, 'App\\Models\\User', 1828),
(3, 'App\\Models\\User', 1829),
(3, 'App\\Models\\User', 1830),
(3, 'App\\Models\\User', 1831),
(3, 'App\\Models\\User', 1832),
(3, 'App\\Models\\User', 1833),
(3, 'App\\Models\\User', 1834),
(3, 'App\\Models\\User', 1835),
(3, 'App\\Models\\User', 1836),
(3, 'App\\Models\\User', 1837),
(3, 'App\\Models\\User', 1838),
(3, 'App\\Models\\User', 1839),
(3, 'App\\Models\\User', 1840),
(3, 'App\\Models\\User', 1841),
(3, 'App\\Models\\User', 1842),
(3, 'App\\Models\\User', 1843),
(3, 'App\\Models\\User', 1844),
(3, 'App\\Models\\User', 1845),
(3, 'App\\Models\\User', 1846),
(3, 'App\\Models\\User', 1847),
(3, 'App\\Models\\User', 1848),
(3, 'App\\Models\\User', 1849),
(3, 'App\\Models\\User', 1850),
(3, 'App\\Models\\User', 1851),
(3, 'App\\Models\\User', 1852),
(3, 'App\\Models\\User', 1853),
(3, 'App\\Models\\User', 1854),
(3, 'App\\Models\\User', 1855),
(3, 'App\\Models\\User', 1856),
(3, 'App\\Models\\User', 1857),
(3, 'App\\Models\\User', 1858),
(3, 'App\\Models\\User', 1859),
(3, 'App\\Models\\User', 1860),
(3, 'App\\Models\\User', 1861),
(3, 'App\\Models\\User', 1862),
(3, 'App\\Models\\User', 1863),
(3, 'App\\Models\\User', 1864),
(3, 'App\\Models\\User', 1865),
(3, 'App\\Models\\User', 1866),
(3, 'App\\Models\\User', 1867),
(3, 'App\\Models\\User', 1868),
(3, 'App\\Models\\User', 1869),
(3, 'App\\Models\\User', 1870),
(3, 'App\\Models\\User', 1871),
(3, 'App\\Models\\User', 1872),
(3, 'App\\Models\\User', 1873),
(3, 'App\\Models\\User', 1874),
(3, 'App\\Models\\User', 1875),
(3, 'App\\Models\\User', 1876),
(3, 'App\\Models\\User', 1877),
(3, 'App\\Models\\User', 1878),
(3, 'App\\Models\\User', 1879),
(3, 'App\\Models\\User', 1880),
(3, 'App\\Models\\User', 1881),
(3, 'App\\Models\\User', 1882),
(3, 'App\\Models\\User', 1883),
(3, 'App\\Models\\User', 1884),
(3, 'App\\Models\\User', 1885),
(3, 'App\\Models\\User', 1886),
(3, 'App\\Models\\User', 1887),
(3, 'App\\Models\\User', 1888),
(3, 'App\\Models\\User', 1889),
(3, 'App\\Models\\User', 1890),
(3, 'App\\Models\\User', 1891),
(3, 'App\\Models\\User', 1892),
(3, 'App\\Models\\User', 1893),
(3, 'App\\Models\\User', 1894),
(3, 'App\\Models\\User', 1895),
(3, 'App\\Models\\User', 1896),
(3, 'App\\Models\\User', 1897),
(3, 'App\\Models\\User', 1898),
(3, 'App\\Models\\User', 1899),
(3, 'App\\Models\\User', 1900),
(3, 'App\\Models\\User', 1901),
(3, 'App\\Models\\User', 1902),
(3, 'App\\Models\\User', 1903),
(3, 'App\\Models\\User', 1904),
(3, 'App\\Models\\User', 1905),
(3, 'App\\Models\\User', 1906),
(3, 'App\\Models\\User', 1907),
(3, 'App\\Models\\User', 1908),
(3, 'App\\Models\\User', 1909),
(3, 'App\\Models\\User', 1910),
(3, 'App\\Models\\User', 1911),
(3, 'App\\Models\\User', 1912),
(3, 'App\\Models\\User', 1913),
(3, 'App\\Models\\User', 1914),
(3, 'App\\Models\\User', 1915),
(3, 'App\\Models\\User', 1916),
(3, 'App\\Models\\User', 1917),
(3, 'App\\Models\\User', 1918),
(3, 'App\\Models\\User', 1919),
(3, 'App\\Models\\User', 1920),
(3, 'App\\Models\\User', 1921),
(3, 'App\\Models\\User', 1922),
(3, 'App\\Models\\User', 1923),
(3, 'App\\Models\\User', 1924),
(3, 'App\\Models\\User', 1925),
(3, 'App\\Models\\User', 1926),
(3, 'App\\Models\\User', 1927),
(3, 'App\\Models\\User', 1928),
(3, 'App\\Models\\User', 1929),
(3, 'App\\Models\\User', 1930),
(3, 'App\\Models\\User', 1931),
(3, 'App\\Models\\User', 1932),
(3, 'App\\Models\\User', 1933),
(3, 'App\\Models\\User', 1934),
(3, 'App\\Models\\User', 1935),
(3, 'App\\Models\\User', 1936),
(3, 'App\\Models\\User', 1937),
(3, 'App\\Models\\User', 1938),
(3, 'App\\Models\\User', 1939),
(3, 'App\\Models\\User', 1940),
(3, 'App\\Models\\User', 1941),
(3, 'App\\Models\\User', 1942),
(3, 'App\\Models\\User', 1943),
(3, 'App\\Models\\User', 1944),
(3, 'App\\Models\\User', 1945),
(3, 'App\\Models\\User', 1946),
(3, 'App\\Models\\User', 1947),
(3, 'App\\Models\\User', 1948),
(3, 'App\\Models\\User', 1949),
(3, 'App\\Models\\User', 1950),
(3, 'App\\Models\\User', 1951),
(3, 'App\\Models\\User', 1952),
(3, 'App\\Models\\User', 1953),
(3, 'App\\Models\\User', 1954),
(3, 'App\\Models\\User', 1955),
(3, 'App\\Models\\User', 1956),
(3, 'App\\Models\\User', 1957),
(3, 'App\\Models\\User', 1958),
(3, 'App\\Models\\User', 1959),
(3, 'App\\Models\\User', 1960),
(3, 'App\\Models\\User', 1961),
(3, 'App\\Models\\User', 1962),
(3, 'App\\Models\\User', 1963),
(3, 'App\\Models\\User', 1964),
(3, 'App\\Models\\User', 1965),
(3, 'App\\Models\\User', 1966),
(3, 'App\\Models\\User', 1967),
(3, 'App\\Models\\User', 1968),
(3, 'App\\Models\\User', 1969),
(3, 'App\\Models\\User', 1970),
(3, 'App\\Models\\User', 1971),
(3, 'App\\Models\\User', 1972),
(3, 'App\\Models\\User', 1973),
(3, 'App\\Models\\User', 1974),
(3, 'App\\Models\\User', 1975),
(3, 'App\\Models\\User', 1976),
(3, 'App\\Models\\User', 1977),
(3, 'App\\Models\\User', 1978),
(3, 'App\\Models\\User', 1979),
(3, 'App\\Models\\User', 1980),
(3, 'App\\Models\\User', 1981),
(3, 'App\\Models\\User', 1982),
(3, 'App\\Models\\User', 1983),
(3, 'App\\Models\\User', 1984),
(3, 'App\\Models\\User', 1985),
(3, 'App\\Models\\User', 1986),
(3, 'App\\Models\\User', 1987),
(3, 'App\\Models\\User', 1988),
(3, 'App\\Models\\User', 1989),
(3, 'App\\Models\\User', 1990),
(3, 'App\\Models\\User', 1991),
(3, 'App\\Models\\User', 1992),
(3, 'App\\Models\\User', 1993),
(3, 'App\\Models\\User', 1994),
(3, 'App\\Models\\User', 1995),
(3, 'App\\Models\\User', 1996),
(3, 'App\\Models\\User', 1997),
(3, 'App\\Models\\User', 1998),
(3, 'App\\Models\\User', 1999),
(3, 'App\\Models\\User', 2000),
(3, 'App\\Models\\User', 2001),
(3, 'App\\Models\\User', 2002),
(3, 'App\\Models\\User', 2003),
(3, 'App\\Models\\User', 2004),
(3, 'App\\Models\\User', 2005),
(3, 'App\\Models\\User', 2006),
(3, 'App\\Models\\User', 2007),
(3, 'App\\Models\\User', 2008),
(3, 'App\\Models\\User', 2009),
(3, 'App\\Models\\User', 2010),
(3, 'App\\Models\\User', 2011),
(3, 'App\\Models\\User', 2012),
(3, 'App\\Models\\User', 2013),
(3, 'App\\Models\\User', 2014),
(3, 'App\\Models\\User', 2015),
(3, 'App\\Models\\User', 2016),
(3, 'App\\Models\\User', 2017),
(3, 'App\\Models\\User', 2018),
(3, 'App\\Models\\User', 2019),
(3, 'App\\Models\\User', 2020),
(3, 'App\\Models\\User', 2021),
(3, 'App\\Models\\User', 2022),
(3, 'App\\Models\\User', 2023),
(3, 'App\\Models\\User', 2024),
(3, 'App\\Models\\User', 2025),
(3, 'App\\Models\\User', 2026),
(3, 'App\\Models\\User', 2027),
(3, 'App\\Models\\User', 2028),
(3, 'App\\Models\\User', 2029),
(3, 'App\\Models\\User', 2030),
(3, 'App\\Models\\User', 2031),
(3, 'App\\Models\\User', 2032),
(3, 'App\\Models\\User', 2033),
(3, 'App\\Models\\User', 2034),
(3, 'App\\Models\\User', 2035),
(3, 'App\\Models\\User', 2036),
(3, 'App\\Models\\User', 2037),
(3, 'App\\Models\\User', 2038),
(3, 'App\\Models\\User', 2039),
(3, 'App\\Models\\User', 2040),
(3, 'App\\Models\\User', 2041),
(3, 'App\\Models\\User', 2042),
(3, 'App\\Models\\User', 2043),
(3, 'App\\Models\\User', 2044),
(3, 'App\\Models\\User', 2045),
(3, 'App\\Models\\User', 2046),
(3, 'App\\Models\\User', 2047),
(3, 'App\\Models\\User', 2048),
(3, 'App\\Models\\User', 2049),
(3, 'App\\Models\\User', 2050),
(3, 'App\\Models\\User', 2051),
(3, 'App\\Models\\User', 2052),
(3, 'App\\Models\\User', 2053),
(3, 'App\\Models\\User', 2054),
(3, 'App\\Models\\User', 2055),
(3, 'App\\Models\\User', 2056),
(3, 'App\\Models\\User', 2057),
(3, 'App\\Models\\User', 2058),
(3, 'App\\Models\\User', 2059),
(3, 'App\\Models\\User', 2060),
(3, 'App\\Models\\User', 2061),
(3, 'App\\Models\\User', 2062),
(3, 'App\\Models\\User', 2063),
(3, 'App\\Models\\User', 2064),
(3, 'App\\Models\\User', 2065),
(3, 'App\\Models\\User', 2066),
(3, 'App\\Models\\User', 2067),
(3, 'App\\Models\\User', 2068),
(3, 'App\\Models\\User', 2069),
(3, 'App\\Models\\User', 2070),
(3, 'App\\Models\\User', 2071),
(3, 'App\\Models\\User', 2072),
(3, 'App\\Models\\User', 2073),
(3, 'App\\Models\\User', 2074),
(3, 'App\\Models\\User', 2075),
(3, 'App\\Models\\User', 2076),
(3, 'App\\Models\\User', 2077),
(3, 'App\\Models\\User', 2078),
(3, 'App\\Models\\User', 2079),
(3, 'App\\Models\\User', 2080),
(3, 'App\\Models\\User', 2081),
(3, 'App\\Models\\User', 2082),
(3, 'App\\Models\\User', 2083),
(3, 'App\\Models\\User', 2084),
(3, 'App\\Models\\User', 2085),
(3, 'App\\Models\\User', 2086),
(3, 'App\\Models\\User', 2087),
(3, 'App\\Models\\User', 2088),
(3, 'App\\Models\\User', 2089),
(3, 'App\\Models\\User', 2090),
(3, 'App\\Models\\User', 2091),
(3, 'App\\Models\\User', 2092),
(3, 'App\\Models\\User', 2093),
(3, 'App\\Models\\User', 2094),
(3, 'App\\Models\\User', 2095),
(3, 'App\\Models\\User', 2096),
(3, 'App\\Models\\User', 2097),
(3, 'App\\Models\\User', 2098),
(3, 'App\\Models\\User', 2099),
(3, 'App\\Models\\User', 2100),
(3, 'App\\Models\\User', 2101),
(3, 'App\\Models\\User', 2102),
(3, 'App\\Models\\User', 2103),
(3, 'App\\Models\\User', 2104),
(3, 'App\\Models\\User', 2105),
(3, 'App\\Models\\User', 2106),
(3, 'App\\Models\\User', 2107),
(3, 'App\\Models\\User', 2108),
(3, 'App\\Models\\User', 2109),
(3, 'App\\Models\\User', 2110),
(3, 'App\\Models\\User', 2111),
(3, 'App\\Models\\User', 2112),
(3, 'App\\Models\\User', 2113),
(3, 'App\\Models\\User', 2114),
(3, 'App\\Models\\User', 2115),
(3, 'App\\Models\\User', 2116),
(3, 'App\\Models\\User', 2117),
(3, 'App\\Models\\User', 2118),
(3, 'App\\Models\\User', 2119),
(3, 'App\\Models\\User', 2120),
(3, 'App\\Models\\User', 2121),
(3, 'App\\Models\\User', 2122),
(3, 'App\\Models\\User', 2123),
(3, 'App\\Models\\User', 2124),
(3, 'App\\Models\\User', 2125),
(3, 'App\\Models\\User', 2126),
(3, 'App\\Models\\User', 2127),
(3, 'App\\Models\\User', 2128),
(3, 'App\\Models\\User', 2129),
(3, 'App\\Models\\User', 2130),
(3, 'App\\Models\\User', 2131),
(3, 'App\\Models\\User', 2132),
(3, 'App\\Models\\User', 2133),
(3, 'App\\Models\\User', 2134),
(3, 'App\\Models\\User', 2135),
(3, 'App\\Models\\User', 2136),
(3, 'App\\Models\\User', 2137),
(3, 'App\\Models\\User', 2138),
(3, 'App\\Models\\User', 2139),
(3, 'App\\Models\\User', 2140),
(3, 'App\\Models\\User', 2141),
(3, 'App\\Models\\User', 2142),
(3, 'App\\Models\\User', 2143),
(3, 'App\\Models\\User', 2144),
(3, 'App\\Models\\User', 2145),
(3, 'App\\Models\\User', 2146),
(3, 'App\\Models\\User', 2147),
(3, 'App\\Models\\User', 2148),
(3, 'App\\Models\\User', 2149),
(3, 'App\\Models\\User', 2150),
(3, 'App\\Models\\User', 2151),
(3, 'App\\Models\\User', 2152),
(3, 'App\\Models\\User', 2153),
(3, 'App\\Models\\User', 2154),
(3, 'App\\Models\\User', 2155),
(3, 'App\\Models\\User', 2156),
(3, 'App\\Models\\User', 2157),
(3, 'App\\Models\\User', 2158),
(3, 'App\\Models\\User', 2159),
(3, 'App\\Models\\User', 2160),
(3, 'App\\Models\\User', 2161),
(3, 'App\\Models\\User', 2162),
(3, 'App\\Models\\User', 2163),
(3, 'App\\Models\\User', 2164),
(3, 'App\\Models\\User', 2165),
(3, 'App\\Models\\User', 2166),
(3, 'App\\Models\\User', 2167),
(3, 'App\\Models\\User', 2168),
(3, 'App\\Models\\User', 2169),
(3, 'App\\Models\\User', 2170),
(3, 'App\\Models\\User', 2171),
(3, 'App\\Models\\User', 2172),
(3, 'App\\Models\\User', 2173),
(3, 'App\\Models\\User', 2174),
(3, 'App\\Models\\User', 2175),
(3, 'App\\Models\\User', 2176),
(3, 'App\\Models\\User', 2177),
(3, 'App\\Models\\User', 2178),
(3, 'App\\Models\\User', 2179),
(3, 'App\\Models\\User', 2180),
(3, 'App\\Models\\User', 2181),
(3, 'App\\Models\\User', 2182),
(3, 'App\\Models\\User', 2183),
(3, 'App\\Models\\User', 2184),
(3, 'App\\Models\\User', 2185),
(3, 'App\\Models\\User', 2186),
(3, 'App\\Models\\User', 2187),
(3, 'App\\Models\\User', 2188),
(3, 'App\\Models\\User', 2189),
(3, 'App\\Models\\User', 2190),
(3, 'App\\Models\\User', 2191),
(3, 'App\\Models\\User', 2192),
(3, 'App\\Models\\User', 2193),
(3, 'App\\Models\\User', 2194),
(3, 'App\\Models\\User', 2195),
(3, 'App\\Models\\User', 2196),
(3, 'App\\Models\\User', 2197),
(3, 'App\\Models\\User', 2198),
(3, 'App\\Models\\User', 2199),
(3, 'App\\Models\\User', 2200),
(3, 'App\\Models\\User', 2201),
(3, 'App\\Models\\User', 2202),
(3, 'App\\Models\\User', 2203),
(3, 'App\\Models\\User', 2204),
(3, 'App\\Models\\User', 2205),
(3, 'App\\Models\\User', 2206),
(3, 'App\\Models\\User', 2207),
(3, 'App\\Models\\User', 2208),
(3, 'App\\Models\\User', 2209),
(3, 'App\\Models\\User', 2210),
(3, 'App\\Models\\User', 2211),
(3, 'App\\Models\\User', 2212),
(3, 'App\\Models\\User', 2213),
(3, 'App\\Models\\User', 2214),
(3, 'App\\Models\\User', 2215),
(3, 'App\\Models\\User', 2216),
(3, 'App\\Models\\User', 2217),
(3, 'App\\Models\\User', 2218),
(3, 'App\\Models\\User', 2219),
(3, 'App\\Models\\User', 2220),
(3, 'App\\Models\\User', 2221),
(3, 'App\\Models\\User', 2222),
(3, 'App\\Models\\User', 2223),
(3, 'App\\Models\\User', 2224),
(3, 'App\\Models\\User', 2225),
(3, 'App\\Models\\User', 2226),
(3, 'App\\Models\\User', 2227),
(3, 'App\\Models\\User', 2228),
(3, 'App\\Models\\User', 2229),
(3, 'App\\Models\\User', 2230),
(3, 'App\\Models\\User', 2231),
(3, 'App\\Models\\User', 2232),
(3, 'App\\Models\\User', 2233),
(3, 'App\\Models\\User', 2234),
(3, 'App\\Models\\User', 2235),
(3, 'App\\Models\\User', 2236),
(3, 'App\\Models\\User', 2237),
(3, 'App\\Models\\User', 2238),
(3, 'App\\Models\\User', 2239),
(3, 'App\\Models\\User', 2240),
(3, 'App\\Models\\User', 2241),
(3, 'App\\Models\\User', 2242),
(3, 'App\\Models\\User', 2243),
(3, 'App\\Models\\User', 2244),
(3, 'App\\Models\\User', 2245),
(3, 'App\\Models\\User', 2246),
(3, 'App\\Models\\User', 2247),
(3, 'App\\Models\\User', 2248),
(3, 'App\\Models\\User', 2249),
(3, 'App\\Models\\User', 2250),
(3, 'App\\Models\\User', 2251),
(3, 'App\\Models\\User', 2252),
(3, 'App\\Models\\User', 2253),
(3, 'App\\Models\\User', 2254),
(3, 'App\\Models\\User', 2255),
(3, 'App\\Models\\User', 2256),
(3, 'App\\Models\\User', 2257),
(3, 'App\\Models\\User', 2258),
(3, 'App\\Models\\User', 2259),
(3, 'App\\Models\\User', 2260),
(3, 'App\\Models\\User', 2261),
(3, 'App\\Models\\User', 2262),
(3, 'App\\Models\\User', 2263),
(3, 'App\\Models\\User', 2264),
(3, 'App\\Models\\User', 2265),
(3, 'App\\Models\\User', 2266),
(3, 'App\\Models\\User', 2267),
(3, 'App\\Models\\User', 2268),
(3, 'App\\Models\\User', 2269),
(3, 'App\\Models\\User', 2270),
(3, 'App\\Models\\User', 2271),
(3, 'App\\Models\\User', 2272),
(3, 'App\\Models\\User', 2273),
(3, 'App\\Models\\User', 2274),
(3, 'App\\Models\\User', 2275),
(3, 'App\\Models\\User', 2276),
(3, 'App\\Models\\User', 2277),
(3, 'App\\Models\\User', 2278),
(3, 'App\\Models\\User', 2279),
(3, 'App\\Models\\User', 2280),
(3, 'App\\Models\\User', 2281),
(3, 'App\\Models\\User', 2282),
(3, 'App\\Models\\User', 2283),
(3, 'App\\Models\\User', 2284),
(3, 'App\\Models\\User', 2285),
(3, 'App\\Models\\User', 2286),
(3, 'App\\Models\\User', 2287),
(3, 'App\\Models\\User', 2288),
(3, 'App\\Models\\User', 2289),
(3, 'App\\Models\\User', 2290),
(3, 'App\\Models\\User', 2291),
(3, 'App\\Models\\User', 2292),
(3, 'App\\Models\\User', 2293),
(3, 'App\\Models\\User', 2294),
(3, 'App\\Models\\User', 2295),
(3, 'App\\Models\\User', 2296),
(3, 'App\\Models\\User', 2297),
(3, 'App\\Models\\User', 2298),
(3, 'App\\Models\\User', 2299),
(3, 'App\\Models\\User', 2300),
(3, 'App\\Models\\User', 2301),
(3, 'App\\Models\\User', 2302),
(3, 'App\\Models\\User', 2303),
(3, 'App\\Models\\User', 2304),
(3, 'App\\Models\\User', 2305),
(3, 'App\\Models\\User', 2306),
(3, 'App\\Models\\User', 2307),
(3, 'App\\Models\\User', 2308),
(3, 'App\\Models\\User', 2309),
(3, 'App\\Models\\User', 2310),
(3, 'App\\Models\\User', 2311),
(3, 'App\\Models\\User', 2312),
(3, 'App\\Models\\User', 2313),
(3, 'App\\Models\\User', 2314),
(3, 'App\\Models\\User', 2315),
(3, 'App\\Models\\User', 2316),
(3, 'App\\Models\\User', 2317),
(3, 'App\\Models\\User', 2318),
(3, 'App\\Models\\User', 2319),
(3, 'App\\Models\\User', 2320),
(3, 'App\\Models\\User', 2321),
(3, 'App\\Models\\User', 2322),
(3, 'App\\Models\\User', 2323),
(3, 'App\\Models\\User', 2324),
(3, 'App\\Models\\User', 2325),
(3, 'App\\Models\\User', 2326),
(3, 'App\\Models\\User', 2327),
(3, 'App\\Models\\User', 2328),
(3, 'App\\Models\\User', 2329),
(3, 'App\\Models\\User', 2330),
(3, 'App\\Models\\User', 2331),
(3, 'App\\Models\\User', 2332),
(3, 'App\\Models\\User', 2333),
(3, 'App\\Models\\User', 2334),
(3, 'App\\Models\\User', 2335),
(3, 'App\\Models\\User', 2336),
(3, 'App\\Models\\User', 2337),
(3, 'App\\Models\\User', 2338),
(3, 'App\\Models\\User', 2339),
(3, 'App\\Models\\User', 2340),
(3, 'App\\Models\\User', 2341),
(3, 'App\\Models\\User', 2342),
(3, 'App\\Models\\User', 2343),
(3, 'App\\Models\\User', 2344),
(3, 'App\\Models\\User', 2345),
(3, 'App\\Models\\User', 2346),
(3, 'App\\Models\\User', 2347),
(3, 'App\\Models\\User', 2348),
(3, 'App\\Models\\User', 2349),
(3, 'App\\Models\\User', 2350),
(3, 'App\\Models\\User', 2351),
(3, 'App\\Models\\User', 2352),
(3, 'App\\Models\\User', 2353),
(3, 'App\\Models\\User', 2354),
(3, 'App\\Models\\User', 2355),
(3, 'App\\Models\\User', 2356),
(3, 'App\\Models\\User', 2357),
(3, 'App\\Models\\User', 2358),
(3, 'App\\Models\\User', 2359),
(3, 'App\\Models\\User', 2360),
(3, 'App\\Models\\User', 2361),
(3, 'App\\Models\\User', 2362),
(3, 'App\\Models\\User', 2363),
(3, 'App\\Models\\User', 2364),
(3, 'App\\Models\\User', 2365),
(3, 'App\\Models\\User', 2366),
(3, 'App\\Models\\User', 2367),
(3, 'App\\Models\\User', 2368),
(3, 'App\\Models\\User', 2369),
(3, 'App\\Models\\User', 2370),
(3, 'App\\Models\\User', 2371),
(3, 'App\\Models\\User', 2372),
(3, 'App\\Models\\User', 2373),
(3, 'App\\Models\\User', 2374),
(3, 'App\\Models\\User', 2375),
(3, 'App\\Models\\User', 2376),
(3, 'App\\Models\\User', 2377),
(3, 'App\\Models\\User', 2378),
(3, 'App\\Models\\User', 2379),
(3, 'App\\Models\\User', 2380),
(3, 'App\\Models\\User', 2381),
(3, 'App\\Models\\User', 2382),
(3, 'App\\Models\\User', 2383),
(3, 'App\\Models\\User', 2384),
(3, 'App\\Models\\User', 2385),
(3, 'App\\Models\\User', 2386),
(3, 'App\\Models\\User', 2387),
(3, 'App\\Models\\User', 2388),
(3, 'App\\Models\\User', 2389),
(3, 'App\\Models\\User', 2390),
(3, 'App\\Models\\User', 2391),
(3, 'App\\Models\\User', 2392),
(3, 'App\\Models\\User', 2393),
(3, 'App\\Models\\User', 2394),
(3, 'App\\Models\\User', 2395),
(3, 'App\\Models\\User', 2396),
(3, 'App\\Models\\User', 2397),
(3, 'App\\Models\\User', 2398),
(3, 'App\\Models\\User', 2399),
(3, 'App\\Models\\User', 2400),
(3, 'App\\Models\\User', 2401),
(3, 'App\\Models\\User', 2402),
(3, 'App\\Models\\User', 2403),
(3, 'App\\Models\\User', 2404),
(3, 'App\\Models\\User', 2405),
(3, 'App\\Models\\User', 2406),
(3, 'App\\Models\\User', 2407),
(3, 'App\\Models\\User', 2408),
(3, 'App\\Models\\User', 2409),
(3, 'App\\Models\\User', 2410),
(3, 'App\\Models\\User', 2411),
(3, 'App\\Models\\User', 2412),
(3, 'App\\Models\\User', 2413),
(3, 'App\\Models\\User', 2414),
(3, 'App\\Models\\User', 2415),
(3, 'App\\Models\\User', 2416),
(3, 'App\\Models\\User', 2417),
(3, 'App\\Models\\User', 2418),
(3, 'App\\Models\\User', 2419),
(3, 'App\\Models\\User', 2420),
(3, 'App\\Models\\User', 2421),
(3, 'App\\Models\\User', 2422),
(3, 'App\\Models\\User', 2423),
(3, 'App\\Models\\User', 2424),
(3, 'App\\Models\\User', 2425),
(3, 'App\\Models\\User', 2426),
(3, 'App\\Models\\User', 2427),
(3, 'App\\Models\\User', 2428),
(3, 'App\\Models\\User', 2429),
(3, 'App\\Models\\User', 2430),
(3, 'App\\Models\\User', 2431),
(3, 'App\\Models\\User', 2432),
(3, 'App\\Models\\User', 2433),
(3, 'App\\Models\\User', 2434),
(3, 'App\\Models\\User', 2435),
(2, 'App\\Models\\User', 2438),
(2, 'App\\Models\\User', 2439),
(1, 'App\\Models\\User', 2442),
(3, 'App\\Models\\User', 2454),
(3, 'App\\Models\\User', 2455),
(3, 'App\\Models\\User', 2456),
(3, 'App\\Models\\User', 2457),
(5, 'App\\Models\\User', 2458),
(5, 'App\\Models\\User', 2459),
(3, 'App\\Models\\User', 2460),
(5, 'App\\Models\\User', 2461),
(3, 'App\\Models\\User', 2462),
(3, 'App\\Models\\User', 2463),
(3, 'App\\Models\\User', 2468),
(3, 'App\\Models\\User', 2470),
(3, 'App\\Models\\User', 2471),
(3, 'App\\Models\\User', 2472),
(3, 'App\\Models\\User', 2473),
(3, 'App\\Models\\User', 2475),
(3, 'App\\Models\\User', 2476),
(3, 'App\\Models\\User', 2478),
(3, 'App\\Models\\User', 2479),
(3, 'App\\Models\\User', 2480),
(3, 'App\\Models\\User', 2481),
(2, 'App\\Models\\User', 2484),
(3, 'App\\Models\\User', 2485),
(3, 'App\\Models\\User', 2486),
(1, 'App\\Models\\User', 2490),
(3, 'App\\Models\\User', 2491),
(5, 'App\\Models\\User', 2492),
(3, 'App\\Models\\User', 2494),
(3, 'App\\Models\\User', 2495),
(5, 'App\\Models\\User', 2496),
(3, 'App\\Models\\User', 2497),
(3, 'App\\Models\\User', 2498),
(3, 'App\\Models\\User', 2500),
(3, 'App\\Models\\User', 2501),
(3, 'App\\Models\\User', 2502),
(2, 'App\\Models\\User', 2503),
(2, 'App\\Models\\User', 2504),
(3, 'App\\Models\\User', 2505),
(2, 'App\\Models\\User', 2506),
(5, 'App\\Models\\User', 2507),
(3, 'App\\Models\\User', 2509),
(2, 'App\\Models\\User', 2510),
(2, 'App\\Models\\User', 2511),
(3, 'App\\Models\\User', 2512),
(2, 'App\\Models\\User', 2513),
(2, 'App\\Models\\User', 2514),
(3, 'App\\Models\\User', 2515);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification_from` int(11) NOT NULL,
  `notification_to` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `url` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'new',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification_from`, `notification_to`, `text`, `url`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(47, 2442, 1, 'New patient has been registered', 'https://jantrah.io/jdent/patient-details/2487', 'new', '2026-01-22 12:34:06', '2026-01-22 12:34:06', NULL, NULL),
(48, 2442, 1, 'New patient has been registered', 'https://jantrah.io/jdent/patient-details/2488', 'new', '2026-01-22 14:28:20', '2026-01-22 14:28:20', NULL, NULL),
(49, 2442, 1, 'New patient has been registered', 'https://jantrah.io/jdent/patient-details/2489', 'new', '2026-01-23 19:26:24', '2026-01-23 19:26:24', NULL, NULL),
(50, 2442, 1, 'New patient has been registered', 'https://jantrah.io/jdent/patient-details/2491', 'new', '2026-01-26 13:03:15', '2026-01-26 13:03:15', NULL, NULL),
(51, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/project/project-1/doctor-details/109', 'new', '2026-01-27 11:46:07', '2026-01-27 11:46:07', NULL, NULL),
(52, 2442, 1, 'New patient has been registered', 'https://jantrah.io/project/project-1/patient-details/2494', 'new', '2026-01-27 12:10:05', '2026-01-27 12:10:05', NULL, NULL),
(53, 2442, 1, 'New patient has been registered', 'https://jantrah.io/project/project-1/patient-details/2495', 'new', '2026-01-27 12:19:08', '2026-01-27 12:19:08', NULL, NULL),
(54, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2497', 'new', '2026-01-29 18:54:17', '2026-01-29 18:54:17', NULL, NULL),
(55, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2498', 'new', '2026-01-30 10:42:53', '2026-01-30 10:42:53', NULL, NULL),
(56, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/110', 'new', '2026-01-30 14:16:54', '2026-01-30 14:16:54', NULL, NULL),
(57, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2500', 'new', '2026-02-01 12:11:08', '2026-02-01 12:11:08', NULL, NULL),
(58, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinic/project-1/patient-details/2501', 'new', '2026-02-01 12:14:53', '2026-02-01 12:14:53', NULL, NULL),
(59, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2502', 'new', '2026-02-01 14:25:25', '2026-02-01 14:25:25', NULL, NULL),
(60, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/111', 'new', '2026-02-02 09:44:21', '2026-02-02 09:44:21', NULL, NULL),
(61, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/112', 'new', '2026-02-02 10:15:05', '2026-02-02 10:15:05', NULL, NULL),
(62, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2505', 'new', '2026-02-02 10:16:36', '2026-02-02 10:16:36', NULL, NULL),
(63, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/113', 'new', '2026-02-02 10:23:37', '2026-02-02 10:23:37', NULL, NULL),
(64, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2508', 'new', '2026-02-02 11:28:04', '2026-02-02 11:28:04', NULL, NULL),
(65, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2509', 'new', '2026-02-02 18:31:53', '2026-02-02 18:31:53', NULL, NULL),
(66, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/114', 'new', '2026-02-02 19:44:14', '2026-02-02 19:44:14', NULL, NULL),
(67, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/115', 'new', '2026-02-03 11:38:47', '2026-02-03 11:38:47', NULL, NULL),
(68, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2512', 'new', '2026-02-03 11:40:52', '2026-02-03 11:40:52', NULL, NULL),
(69, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/116', 'new', '2026-02-03 12:01:48', '2026-02-03 12:01:48', NULL, NULL),
(70, 2442, 1, 'New Doctor Has been registered', 'https://jantrah.io/clinics/project-1/doctor-details/117', 'new', '2026-02-03 12:47:35', '2026-02-03 12:47:35', NULL, NULL),
(71, 2442, 1, 'New patient has been registered', 'https://jantrah.io/clinics/project-1/patient-details/2515', 'new', '2026-02-03 16:57:46', '2026-02-03 16:57:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_settings`
--

CREATE TABLE `page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(191) NOT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`settings`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_settings`
--

INSERT INTO `page_settings` (`id`, `page_name`, `settings`, `created_at`, `updated_at`) VALUES
(1, 'treatment_plan_show', '{\"show_header\":\"1\",\"margin_top\":\"0\",\"margin_left\":\"1\",\"font_size\":\"12\"}', '2026-01-30 16:18:32', '2026-01-30 16:18:32'),
(2, 'prescription_show', '{\"show_header\":\"1\",\"margin_top\":\"0\",\"margin_left\":\"0\",\"font_size\":\"15\"}', '2026-01-30 16:28:39', '2026-01-30 16:28:39'),
(3, 'invoice_show', '{\"show_header\":\"1\",\"margin_top\":\"14\",\"margin_left\":\"0\",\"font_size\":\"15\"}', '2026-01-30 16:43:52', '2026-02-02 11:11:21'),
(4, 'patient_history_print', '{\"show_header\":\"1\",\"margin_top\":\"10\",\"margin_left\":\"10\",\"font_size\":\"14\"}', '2026-02-02 15:06:09', '2026-02-02 15:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_appointments`
--

CREATE TABLE `patient_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_number` varchar(25) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `appointment_date` date NOT NULL,
  `problem` text DEFAULT NULL,
  `whatsapp_sent` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT 1,
  `appointment_status_id` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `last_email_sent_at` date DEFAULT NULL,
  `email_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_case_studies`
--

CREATE TABLE `patient_case_studies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `food_allergy` varchar(255) DEFAULT NULL,
  `heart_disease` varchar(255) DEFAULT NULL,
  `high_blood_pressure` varchar(255) DEFAULT NULL,
  `diabetic` varchar(255) DEFAULT NULL,
  `surgery` varchar(255) DEFAULT NULL,
  `accident` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `family_medical_history` varchar(255) DEFAULT NULL,
  `current_medication` varchar(255) DEFAULT NULL,
  `pregnancy` varchar(255) DEFAULT NULL,
  `breastfeeding` varchar(255) DEFAULT NULL,
  `health_insurance` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_dental_histories`
--

CREATE TABLE `patient_dental_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(11) NOT NULL,
  `dd_dental_history_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mrn_number` varchar(20) DEFAULT NULL,
  `marital_status` int(10) DEFAULT NULL,
  `insurance_number` varchar(100) DEFAULT NULL,
  `insurance_provider` varchar(255) DEFAULT NULL,
  `cnic` varchar(15) DEFAULT NULL,
  `other_details` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `enquirysource` int(11) DEFAULT NULL,
  `credit_balance` int(10) DEFAULT NULL,
  `insurance_provider_id` int(11) DEFAULT NULL,
  `insurance_verified` varchar(10) DEFAULT 'no',
  `insurance_verified_by` int(11) DEFAULT NULL,
  `insurance_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis_items`
--

CREATE TABLE `patient_diagnosis_items` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `instruction` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_drug_histories`
--

CREATE TABLE `patient_drug_histories` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `dd_drug_history_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_medical_histories`
--

CREATE TABLE `patient_medical_histories` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `dd_medical_history_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comments` longtext DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `doctor_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_medicine_items`
--

CREATE TABLE `patient_medicine_items` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `medicine_type_id` int(11) DEFAULT NULL,
  `instruction` text DEFAULT NULL,
  `day` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `days` varchar(3) DEFAULT NULL,
  `weeks` varchar(2) DEFAULT NULL,
  `months` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_social_histories`
--

CREATE TABLE `patient_social_histories` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `dd_social_history_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_teeths`
--

CREATE TABLE `patient_teeths` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `tooth_number` varchar(10) NOT NULL,
  `tooth_condition` varchar(200) DEFAULT NULL,
  `treatment_plan` text DEFAULT NULL,
  `severity` varchar(200) DEFAULT NULL,
  `procedure_performed` text DEFAULT NULL,
  `tooth_position` varchar(200) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `examination_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_treatment_plans`
--

CREATE TABLE `patient_treatment_plans` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `comments` longtext DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `doctor_id` int(11) NOT NULL,
  `tooth_id` int(11) DEFAULT NULL,
  `examination_id` int(11) DEFAULT NULL,
  `treatment_plan_number` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_treatment_plan_procedures`
--

CREATE TABLE `patient_treatment_plan_procedures` (
  `id` int(11) NOT NULL,
  `patient_treatment_plan_id` int(11) NOT NULL,
  `ready_to_start` varchar(100) DEFAULT 'no',
  `is_procedure_started` varchar(30) DEFAULT 'no',
  `is_procedure_finished` varchar(30) DEFAULT 'no',
  `show_price` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tooth_number` int(11) DEFAULT NULL,
  `all_teeth` varchar(10) NOT NULL DEFAULT 'no',
  `dd_procedure_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_treatment_process`
--

CREATE TABLE `patient_treatment_process` (
  `id` int(11) NOT NULL,
  `patient_treatment_plan_id` int(11) NOT NULL,
  `comments` longtext DEFAULT NULL,
  `status` enum('1','0') DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `process_started_at` datetime DEFAULT NULL,
  `process_completed_at` datetime DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_type` enum('Credit','Debit') NOT NULL,
  `payment_date` date NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `paid_by` varchar(150) DEFAULT NULL,
  `material_name` varchar(150) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-read', 'Role', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(2, 'role-create', 'Role', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(3, 'role-update', 'Role', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(4, 'role-delete', 'Role', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(5, 'user-read', 'User', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(6, 'user-create', 'User', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(7, 'user-update', 'User', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(8, 'user-delete', 'User', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(9, 'smtp-read', 'SMTP', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(10, 'smtp-create', 'SMTP', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(11, 'smtp-update', 'SMTP', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(12, 'smtp-delete', 'SMTP', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(13, 'company-read', 'Company', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(14, 'company-create', 'Company', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(15, 'company-update', 'Company', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(16, 'company-delete', 'Company', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(17, 'currencies-read', 'Currencies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(18, 'currencies-create', 'Currencies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(19, 'currencies-update', 'Currencies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(20, 'currencies-delete', 'Currencies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(21, 'tax-rate-read', 'Tax Rate', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(22, 'tax-rate-create', 'Tax Rate', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(23, 'tax-rate-update', 'Tax Rate', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(24, 'tax-rate-delete', 'Tax Rate', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(25, 'profile-read', 'Profile', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(26, 'profile-update', 'Profile', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(27, 'hospital-department-read', 'Hospital Department', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(28, 'hospital-department-create', 'Hospital Department', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(29, 'hospital-department-update', 'Hospital Department', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(30, 'hospital-department-delete', 'Hospital Department', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(31, 'doctor-detail-read', 'Doctor Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(32, 'doctor-detail-create', 'Doctor Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(33, 'doctor-detail-update', 'Doctor Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(34, 'doctor-detail-delete', 'Doctor Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(35, 'patient-detail-read', 'Patient Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(36, 'patient-detail-create', 'Patient Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(37, 'patient-detail-update', 'Patient Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(38, 'patient-detail-delete', 'Patient Detail', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(39, 'patient-case-studies-read', 'Patient Case Studies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(40, 'patient-case-studies-create', 'Patient Case Studies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(41, 'patient-case-studies-update', 'Patient Case Studies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(42, 'patient-case-studies-delete', 'Patient Case Studies', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(43, 'insurance-read', 'Insurance', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(44, 'insurance-create', 'Insurance', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(45, 'insurance-update', 'Insurance', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(46, 'insurance-delete', 'Insurance', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(47, 'lab-report-read', 'Lab Report', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(48, 'lab-report-create', 'Lab Report', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(49, 'lab-report-update', 'Lab Report', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(50, 'lab-report-delete', 'Lab Report', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(51, 'lab-report-template-read', 'Lab Report Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(52, 'lab-report-template-create', 'Lab Report Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(53, 'lab-report-template-update', 'Lab Report Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(54, 'lab-report-template-delete', 'Lab Report Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(55, 'sms-template-read', 'SMS Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(56, 'sms-template-create', 'SMS Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(57, 'sms-template-update', 'SMS Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(58, 'sms-template-delete', 'SMS Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(59, 'email-template-read', 'Email Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(60, 'email-template-create', 'Email Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(61, 'email-template-update', 'Email Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(62, 'email-template-delete', 'Email Template', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(63, 'email-campaign-read', 'Email Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(64, 'email-campaign-create', 'Email Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(65, 'email-campaign-update', 'Email Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(66, 'email-campaign-delete', 'Email Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(67, 'doctor-schedule-read', 'Doctor Schedule', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(68, 'doctor-schedule-create', 'Doctor Schedule', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(69, 'doctor-schedule-update', 'Doctor Schedule', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(70, 'doctor-schedule-delete', 'Doctor Schedule', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(71, 'patient-appointment-read', 'Patient Appointment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(72, 'patient-appointment-create', 'Patient Appointment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(73, 'patient-appointment-update', 'Patient Appointment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(74, 'patient-appointment-delete', 'Patient Appointment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(75, 'prescription-read', 'Prescription', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(76, 'prescription-create', 'Prescription', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(77, 'prescription-update', 'Prescription', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(78, 'prescription-delete', 'Prescription', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(79, 'sms-api-read', 'SMS Api', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(80, 'sms-api-update', 'SMS Api', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(81, 'sms-campaign-read', 'SMS Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(82, 'sms-campaign-create', 'SMS Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(83, 'sms-campaign-update', 'SMS Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(84, 'sms-campaign-delete', 'SMS Campaign', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(85, 'account-header-read', 'Account Header', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(86, 'account-header-create', 'Account Header', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(87, 'account-header-update', 'Account Header', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(88, 'account-header-delete', 'Account Header', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(89, 'invoice-read', 'Invoice', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(90, 'invoice-create', 'Invoice', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(91, 'invoice-update', 'Invoice', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(92, 'invoice-delete', 'Invoice', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(93, 'payment-read', 'Payment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(94, 'payment-create', 'Payment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(95, 'payment-update', 'Payment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(96, 'payment-delete', 'Payment', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(97, 'financial-report-read', 'Financial Report', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(98, 'front-end-read', 'Front End', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(99, 'front-end-create', 'Front End', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(100, 'front-end-update', 'Front End', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(101, 'front-end-delete', 'Front End', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(102, 'contact-us-read', 'Contact Us', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(103, 'contact-us-delete', 'Contact Us', 'web', '2024-04-29 01:37:38', '2024-04-29 01:37:38'),
(104, 'blood-group-read', 'Blood Group', 'web', '2024-06-21 14:03:59', NULL),
(105, 'blood-group-create', 'Blood Group', 'web', '2024-06-21 14:03:59', NULL),
(106, 'blood-group-update', 'Blood Group', 'web', '2024-06-21 14:03:59', NULL),
(107, 'blood-group-delete', 'Blood Group', 'web', '2024-06-21 14:03:59', NULL),
(108, 'marital-status-read', 'Marital Status', 'web', '2024-06-21 14:03:59', NULL),
(109, 'marital-status-create', 'Marital Status', 'web', '2024-06-21 14:03:59', NULL),
(110, 'marital-status-update', 'Marital Status', 'web', '2024-06-21 14:03:59', NULL),
(111, 'marital-status-delete', 'Marital Status', 'web', '2024-06-21 14:03:59', NULL),
(112, 'dropdown-read', 'Dropdowns', 'web', '2024-06-21 14:03:59', NULL),
(113, 'dropdown-create', 'Dropdowns', 'web', '2024-06-21 14:03:59', NULL),
(114, 'dropdown-update', 'Dropdowns', 'web', '2024-06-21 14:03:59', NULL),
(115, 'dropdown-delete', 'Dropdowns', 'web', '2024-06-21 14:03:59', NULL),
(116, 'inventory-read', 'Inventory', 'web', '2024-06-21 14:03:59', NULL),
(117, 'inventory-create', 'Inventory', 'web', '2024-06-21 14:03:59', NULL),
(118, 'inventory-update', 'Inventory', 'web', '2024-06-21 14:03:59', NULL),
(120, 'inventory-delete', 'Inventory', 'web', '2024-06-21 14:03:59', NULL),
(121, 'consultancey-read', 'Consultancy', 'web', '2024-06-21 14:03:59', NULL),
(122, 'consultancey-create', 'Consultancy', 'web', '2024-06-21 14:03:59', NULL),
(123, 'consultancey-update', 'Consultancy', 'web', '2024-06-21 14:03:59', NULL),
(124, 'consultancey-delete', 'Consultancy', 'web', '2024-06-21 14:03:59', NULL),
(125, 'exam-investigation-read', 'Exam & Investigation', 'web', '2024-06-21 14:03:59', NULL),
(126, 'exam-investigation-create', 'Exam & Investigation', 'web', '2024-06-21 14:03:59', NULL),
(127, 'exam-investigation-update', 'Exam & Investigation', 'web', '2024-06-21 14:03:59', NULL),
(128, 'exam-investigation-delete', 'Exam & Investigation', 'web', '2024-06-21 14:03:59', NULL),
(129, 'dashboard-read', 'Dashboard', 'web', '2024-06-21 14:03:59', NULL),
(130, 'labs-read', 'Lab', 'web', '2024-06-21 14:03:59', NULL),
(131, 'labs-create', 'Lab', 'web', '2024-06-21 14:03:59', NULL),
(132, 'labs-update', 'Lab', 'web', '2024-06-21 14:03:59', NULL),
(133, 'labs-delete', 'Lab', 'web', '2024-06-21 14:03:59', NULL),
(134, 'userlog-read', 'User Logs', 'web', '2024-06-21 14:03:59', NULL),
(135, 'patient-dental-histories-delete', 'Delete Patient Dental Histories', 'web', '2024-07-30 11:17:59', '2024-07-30 11:17:59'),
(136, 'patient-treatment-plans-delete', 'Patient Treatment Plans', 'web', '2024-07-30 11:28:15', '2024-07-30 11:28:15'),
(137, 'task-delete', 'Task', 'web', '2024-07-30 11:32:19', '2024-07-30 11:32:19'),
(138, 'insurance-providers-delete', 'Insurance Provider', 'web', '2024-07-30 11:37:32', '2024-07-30 11:37:32'),
(139, 'patient-medical-histories-read', 'Patient Medical Histories', 'web', NULL, NULL),
(140, 'patient-medical-histories-create', 'Patient Medical Histories', 'web', NULL, NULL),
(141, 'patient-medical-histories-update', 'Patient Medical Histories', 'web', NULL, NULL),
(142, 'patient-medical-histories-delete', 'Patient Medical Histories', 'web', NULL, NULL),
(143, 'patient-dental-histories-read', 'Patient Dental Histories', 'web', NULL, NULL),
(144, 'patient-dental-histories-create', 'Patient Dental Histories', 'web', NULL, NULL),
(145, 'patient-dental-histories-update', 'Patient Dental Histories', 'web', NULL, NULL),
(146, 'patient-dental-histories-delete', 'Patient Dental Histories', 'web', NULL, NULL),
(147, 'patient-drug-histories-read', 'Patient Drug Histories', 'web', NULL, NULL),
(148, 'patient-drug-histories-create', 'Patient Drug Histories', 'web', NULL, NULL),
(149, 'patient-drug-histories-update', 'Patient Drug Histories', 'web', NULL, NULL),
(150, 'patient-drug-histories-delete', 'Patient Drug Histories', 'web', NULL, NULL),
(151, 'patient-social-histories-read', 'Patient Social Histories', 'web', NULL, NULL),
(152, 'patient-social-histories-create', 'Patient Social Histories', 'web', NULL, NULL),
(153, 'patient-social-histories-update', 'Patient Social Histories', 'web', NULL, NULL),
(154, 'patient-social-histories-delete', 'Patient Social Histories', 'web', NULL, NULL),
(155, 'patient-treatment-plans-read', 'Patient Treatment Plans', 'web', NULL, NULL),
(156, 'patient-treatment-plans-create', 'Patient Treatment Plans', 'web', NULL, NULL),
(157, 'patient-treatment-plans-update', 'Patient Treatment Plans', 'web', NULL, NULL),
(158, 'patient-treatment-plans-delete', 'Patient Treatment Plans', 'web', NULL, NULL),
(159, 'apsetting-read', 'App Settings', 'web', NULL, NULL),
(160, 'apsetting-create', 'App Settings', 'web', NULL, NULL),
(161, 'apsetting-update', 'App Settings', 'web', NULL, NULL),
(162, 'apsetting-delete', 'App Settings', 'web', NULL, NULL),
(163, 'exam-investigations-read', 'Exam Investigations', 'web', NULL, NULL),
(164, 'exam-investigations-create', 'Exam Investigations', 'web', NULL, NULL),
(165, 'exam-investigations-update', 'Exam Investigations', 'web', NULL, NULL),
(166, 'exam-investigations-delete', 'Exam Investigations', 'web', NULL, NULL),
(167, 'task-read', 'Task', 'web', '2024-07-30 11:32:19', '2024-07-30 11:32:19'),
(168, 'task-create', 'Task', 'web', '2024-07-30 11:32:19', '2024-07-30 11:32:19'),
(169, 'task-update', 'Task', 'web', '2024-07-30 11:32:19', '2024-07-29 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `chief_complaint` text DEFAULT NULL,
  `medicine_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`medicine_info`)),
  `diagnosis_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`diagnosis_info`)),
  `note` text DEFAULT NULL,
  `prescription_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `teeth_procedure_id` int(11) DEFAULT NULL,
  `prs_number` varchar(50) DEFAULT NULL,
  `examination_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `validity` varchar(255) DEFAULT NULL,
  `is_default` enum('0','1') NOT NULL DEFAULT '0',
  `role_for` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `price`, `validity`, `is_default`, `role_for`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '1', '90000', '1', '0', '2024-04-29 01:37:38', '2024-07-16 11:08:18'),
(2, 'Doctor', 'web', '1', '100000000', '1', '0', '2024-04-29 01:37:39', '2025-12-27 22:35:41'),
(3, 'Patient', 'web', NULL, NULL, '1', '1', '2024-04-29 01:37:39', '2024-04-29 01:37:39'),
(4, 'Accountant', 'web', NULL, NULL, '1', '1', '2024-04-29 01:37:39', '2024-04-29 01:37:39'),
(5, 'Laboratorist', 'web', NULL, NULL, '1', '1', '2024-04-29 01:37:39', '2024-04-29 01:37:39'),
(6, 'Receptionist', 'web', '', '', '1', '1', '2024-04-29 01:37:39', '2024-09-17 09:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(67, 2),
(71, 2),
(75, 2),
(76, 2),
(77, 2),
(125, 2),
(126, 2),
(127, 2),
(147, 2),
(148, 2),
(149, 2),
(150, 2),
(151, 2),
(152, 2),
(153, 2),
(155, 2),
(156, 2),
(157, 2),
(163, 2),
(164, 2),
(165, 2),
(166, 2),
(31, 3),
(35, 3),
(39, 3),
(43, 3),
(47, 3),
(67, 3),
(71, 3),
(75, 3),
(89, 3),
(85, 4),
(86, 4),
(87, 4),
(88, 4),
(89, 4),
(90, 4),
(91, 4),
(92, 4),
(93, 4),
(94, 4),
(95, 4),
(96, 4),
(97, 4),
(31, 5),
(35, 5),
(39, 5),
(47, 5),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(31, 6),
(35, 6),
(36, 6),
(37, 6),
(39, 6),
(40, 6),
(41, 6),
(47, 6),
(67, 6),
(68, 6),
(69, 6),
(71, 6),
(72, 6),
(73, 6),
(75, 6);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'general.company_name', 'J Dent Clinic', '2024-04-28 20:37:38', '2025-11-06 12:05:04'),
(2, 1, 'general.company_email', 'info@jantrah.com', '2024-04-28 20:37:38', '2025-11-06 12:05:04'),
(3, 1, 'general.default_locale', 'en-GB', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(4, 1, 'general.financial_start', '29-04', '2024-04-28 20:37:38', '2024-04-28 21:34:35'),
(5, 1, 'general.timezone', 'Kwajalein', '2024-04-28 20:37:38', '2024-04-28 21:34:35'),
(6, 1, 'general.date_format', 'd M Y', '2024-04-28 20:37:38', '2024-04-28 21:34:35'),
(7, 1, 'general.date_separator', 'space', '2024-04-28 20:37:38', '2024-04-28 21:34:35'),
(8, 1, 'general.percent_position', 'after', '2024-04-28 20:37:38', '2024-04-28 21:34:35'),
(9, 1, 'general.default_payment_method', 'offlinepayment.cash.1', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(10, 1, 'general.email_protocol', 'mail', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(11, 1, 'general.email_sendmail_path', '/usr/sbin/sendmail -bs', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(12, 1, 'general.send_item_reminder', '0', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(13, 1, 'general.schedule_time', '09:00', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(14, 1, 'general.admin_theme', 'skin-green-light', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(15, 1, 'general.list_limit', '25', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(16, 1, 'general.use_gravatar', '0', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(17, 1, 'general.session_handler', 'file', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(18, 1, 'general.session_lifetime', '30', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(19, 1, 'general.file_size', '2', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(20, 1, 'general.file_types', 'pdf,jpeg,jpg,png', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(21, 1, 'general.wizard', '0', '2024-04-28 20:37:38', '2024-04-28 20:37:38'),
(22, 1, 'general.company_address', '<p>Islamabad,Pakistan</p>', '2024-04-28 20:37:38', '2025-11-06 12:05:04'),
(23, 1, 'general.company_logo', 'lara/companies/1755977292advance-dental.png', '2024-04-28 20:37:38', '2025-08-23 19:28:12'),
(45, 2, 'general.company_address', 'Natore, Bangladesh<br>', '2024-04-28 20:39:40', '2024-04-28 20:39:40'),
(94, 1, 'general.company_phone', '0516655667', '2024-04-28 21:34:38', '2025-11-06 12:05:04'),
(95, 1, 'general.company_description', 'Creating healthy, confident smiles every day!', '2025-08-12 12:16:05', '2025-08-12 12:16:05'),
(96, 1, 'general.company_tax_number', '23232323', '2025-08-23 19:28:12', '2025-11-06 12:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `sms_apis`
--

CREATE TABLE `sms_apis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `gateway` enum('twilio','nexmo','plivo','clickatell') NOT NULL,
  `auth_id` varchar(255) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `api_id` varchar(255) DEFAULT NULL,
  `sender_number` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_campaigns`
--

CREATE TABLE `sms_campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `campaign_name` varchar(255) NOT NULL,
  `sms_template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `schedule_time` datetime NOT NULL,
  `contact_type` varchar(255) NOT NULL,
  `status` enum('Pending','Processing','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_campaign_logs`
--

CREATE TABLE `sms_campaign_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sms_campaign_id` bigint(20) UNSIGNED NOT NULL,
  `sms_api_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE `sms_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smtp_configurations`
--

CREATE TABLE `smtp_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_type` enum('default','tls','ssl') NOT NULL DEFAULT 'default',
  `smtp_password` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soft_tissues`
--

CREATE TABLE `soft_tissues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soft_tissues_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soft_tissues`
--

INSERT INTO `soft_tissues` (`id`, `soft_tissues_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Dry /wipe tissues', 'active', 67, NULL, '2024-09-21 19:47:38', '2024-09-21 19:47:38'),
(2, 'Perform Visual exam', 'active', 67, NULL, '2024-09-21 19:47:47', '2024-09-21 19:47:47'),
(3, 'Perform Palpation', 'active', 67, NULL, '2024-09-21 19:47:58', '2024-09-21 19:47:58'),
(9, 'Gingiva (Gums) Surround and protect the teeth and bone.', 'active', 1, NULL, '2025-10-27 09:58:24', '2025-10-27 09:58:24'),
(10, 'Gingiva (Gums)', 'active', 1, 1, '2025-10-30 06:01:17', '2025-11-11 10:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `soft_tissues_exam_investigations`
--

CREATE TABLE `soft_tissues_exam_investigations` (
  `id` int(11) NOT NULL,
  `exam_investigation_id` int(11) NOT NULL,
  `soft_tissue_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soft_tissues_exam_investigations`
--

INSERT INTO `soft_tissues_exam_investigations` (`id`, `exam_investigation_id`, `soft_tissue_id`, `comments`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(10, 20, 1, 'xyz', 2442, '2026-02-02 10:26:22', NULL, '2026-02-02 10:26:22'),
(11, 21, 3, 'xyz', 2442, '2026-02-02 14:59:29', NULL, '2026-02-02 14:59:29'),
(12, 25, 1, 'xyz', 2442, '2026-02-03 15:07:36', NULL, '2026-02-03 15:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `department`, `gender`) VALUES
(1, 'Umer Fayyaz', 'Archeology', 'M'),
(2, 'Attique', 'Maths', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `title`, `description`, `created_at`, `updated_at`, `updated_by`, `created_by`, `status`) VALUES
(1, 1, 'M1', 'M1 Medical', '2024-06-23 14:58:01', '2024-06-23 14:58:01', NULL, NULL, '1'),
(2, 1, 'M2', 'M2 Medical', '2024-06-23 14:58:15', '2024-06-23 14:58:15', NULL, NULL, '1'),
(3, 2, 'D1', 'D1 Dental', '2024-06-23 14:58:28', '2024-06-23 14:58:28', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assign_to` bigint(20) UNSIGNED NOT NULL,
  `assign_by` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `task_action_id` int(11) DEFAULT NULL,
  `task_type_id` int(11) DEFAULT NULL,
  `task_priority_id` int(11) NOT NULL,
  `task_status_id` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_notifications`
--

CREATE TABLE `task_notifications` (
  `id` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `url` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'new',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` double(15,4) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT curdate(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Pablo Escobar', 'Islamabad', '2024-05-01', NULL),
(2, 'Gustavo', 'Lahore', '2024-05-01', NULL),
(3, 'Rodriguez Gacha', 'Medelin', '2024-05-01', NULL),
(4, 'Miguel Rodriguez', 'Cali', '2024-05-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT curdate(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`course_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-05-01', NULL),
(1, 2, '2024-05-01', NULL),
(1, 4, '2024-05-01', NULL),
(2, 1, '2024-05-01', NULL),
(2, 2, '2024-05-01', NULL),
(3, 1, '2024-05-01', NULL),
(3, 2, '2024-05-01', NULL),
(3, 3, '2024-05-01', NULL),
(4, 1, '2024-05-01', NULL),
(4, 3, '2024-05-01', NULL),
(5, 1, '2024-05-01', NULL),
(5, 3, '2024-05-01', NULL),
(5, 4, '2024-05-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_files`
--

CREATE TABLE `test_files` (
  `id` int(11) NOT NULL,
  `pr_number` varchar(20) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tooth_issues`
--

CREATE TABLE `tooth_issues` (
  `id` int(11) NOT NULL,
  `p_teeth_id` int(11) DEFAULT NULL,
  `tooth_number` varchar(255) DEFAULT NULL,
  `tooth_issue` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diagnosis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tooth_issues`
--

INSERT INTO `tooth_issues` (`id`, `p_teeth_id`, `tooth_number`, `tooth_issue`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `diagnosis_id`) VALUES
(1, 1, '16', 'Chip offs', '', NULL, '2025-12-31 12:25:45', NULL, '2025-12-31 12:25:45', 2),
(2, 2, '15', 'Carious lesions Class I', '', NULL, '2026-01-01 07:56:55', NULL, '2026-01-01 07:56:55', 12),
(3, 3, '46', 'Carious lesions Class I', '', NULL, '2026-01-02 16:31:55', NULL, '2026-01-02 16:31:55', 5),
(4, 4, '36', 'Carious lesions Class I', '', NULL, '2026-01-02 16:32:18', NULL, '2026-01-02 16:32:18', 5),
(5, 5, '16', 'Carious lesions Class I', '', NULL, '2026-01-02 16:32:29', NULL, '2026-01-02 16:32:29', 5),
(6, 6, '31', 'Mobility Grade I', '', NULL, '2026-01-03 16:46:15', NULL, '2026-01-03 16:46:15', 46),
(7, 7, '14', 'Carious lesions Class II', '', NULL, '2026-01-03 17:05:58', NULL, '2026-01-03 17:05:58', 3),
(8, 8, '15', 'Carious lesions Class II', '', NULL, '2026-01-03 17:06:12', NULL, '2026-01-03 17:06:12', 3),
(9, 9, '46', 'Carious lesions Class II', '', NULL, '2026-01-03 17:06:43', NULL, '2026-01-03 17:06:43', 3),
(10, 10, '36', 'Carious lesions Class II', '', NULL, '2026-01-03 17:06:57', NULL, '2026-01-03 17:06:57', 2),
(11, 11, '22', 'Carious lesions Class III', '', NULL, '2026-01-03 17:07:17', NULL, '2026-01-03 17:07:17', 3),
(12, 12, '21', 'Carious lesions Class III', '', NULL, '2026-01-03 17:07:33', NULL, '2026-01-03 17:07:33', 5),
(13, 13, '11', 'Carious lesions Class III', '', NULL, '2026-01-03 17:07:41', NULL, '2026-01-03 17:07:41', 5),
(14, 14, '23', 'Carious lesions Class III', '', NULL, '2026-01-03 17:08:05', NULL, '2026-01-03 17:08:05', 5),
(15, 15, '24', 'Carious lesions Class II', '', NULL, '2026-01-03 17:08:15', NULL, '2026-01-03 17:08:15', 5),
(16, 16, '26', 'Extrinsic staining', '', NULL, '2026-01-03 17:22:53', NULL, '2026-01-03 17:22:53', 46),
(17, 17, '46', 'Mobility Grade I', '', 2442, '2026-01-14 23:19:18', NULL, '2026-01-14 23:19:18', 3),
(18, 18, '16', 'Missing', '', 2442, '2026-01-15 09:35:27', NULL, '2026-01-15 09:35:27', 12),
(19, 19, '47', 'Mobility Grade I', '', 2442, '2026-01-15 09:47:06', NULL, '2026-01-15 09:47:06', 3),
(20, 20, '41', 'Percussion Positive', '', 2442, '2026-01-15 09:47:54', NULL, '2026-01-15 09:47:54', 2),
(21, 21, '16', 'Impacted', '', 2442, '2026-01-15 16:24:27', NULL, '2026-01-15 16:24:27', 10),
(23, 23, '47', 'Chip offs', '', 2442, '2026-01-20 18:43:27', NULL, '2026-01-20 18:43:27', 10),
(24, 22, '11', 'Mobility Grade I', 'ljkk lkj lkj lkjk', 1, '2026-01-21 12:35:54', NULL, '2026-01-21 12:35:54', 2),
(25, 22, '11', 'Carious lesions Class I', 'iuy iuyiy u', 1, '2026-01-21 12:35:54', NULL, '2026-01-21 12:35:54', 14),
(26, 24, '18', 'Fractured', '', 2442, '2026-01-22 14:49:51', NULL, '2026-01-22 14:49:51', 3),
(27, 25, '17', 'Mobility Grade I', 'SADFSDF', 2442, '2026-01-22 15:49:46', NULL, '2026-01-22 15:49:46', 2),
(28, 25, '17', 'Supra-erupted', 'SDFSDFSDF', 2442, '2026-01-22 15:49:46', NULL, '2026-01-22 15:49:46', 14),
(29, 26, '16', 'Mobility Grade I', '', 2442, '2026-01-22 15:50:45', NULL, '2026-01-22 15:50:45', 4),
(30, 27, '15', 'Mobility Grade II', '', 2442, '2026-01-22 15:51:32', NULL, '2026-01-22 15:51:32', 4),
(31, 28, '25', 'Percussion Positive', '', 2442, '2026-01-22 17:17:48', NULL, '2026-01-22 17:17:48', 2),
(32, 29, '27', 'Mobility Grade I', '', 2442, '2026-01-22 17:18:31', NULL, '2026-01-22 17:18:31', 4),
(33, 30, '17', 'Mobility Grade I', '', 2442, '2026-01-22 17:22:17', NULL, '2026-01-22 17:22:17', 4),
(34, 31, '48', 'Mobility Grade III', '', 2442, '2026-01-22 17:26:28', NULL, '2026-01-22 17:26:28', 3),
(35, 32, '18', 'Extrinsic staining', '', 2442, '2026-01-22 17:28:36', NULL, '2026-01-22 17:28:36', 5),
(36, 33, '47', 'Mobility Grade II', '', 2442, '2026-01-22 17:31:01', NULL, '2026-01-22 17:31:01', 5),
(37, 34, '12', 'Mobility Grade III', '', 2442, '2026-01-22 17:31:41', NULL, '2026-01-22 17:31:41', 4),
(38, 35, '11', 'Mobility Grade II', '', 2442, '2026-01-22 17:34:24', NULL, '2026-01-22 17:34:24', 3),
(39, 36, '28', 'Mobility Grade III', '', 2442, '2026-01-22 17:45:18', NULL, '2026-01-22 17:45:18', 4),
(40, 37, '46', 'Mobility Grade III', '', 2442, '2026-01-22 17:46:30', NULL, '2026-01-22 17:46:30', 5),
(41, 38, '44', 'Mobility Grade III', '', 2442, '2026-01-22 17:47:26', NULL, '2026-01-22 17:47:26', 5),
(42, 39, '43', 'Mobility Grade III', '', 2442, '2026-01-22 17:48:36', NULL, '2026-01-22 17:48:36', 6),
(43, 40, '45', 'Mobility Grade II', '', 2442, '2026-01-22 17:48:55', NULL, '2026-01-22 17:48:55', 5),
(44, 41, '41', 'Mobility Grade II', '', 2442, '2026-01-22 17:50:28', NULL, '2026-01-22 17:50:28', 6),
(45, 42, '11', 'Mobility Grade II', '', 2442, '2026-01-22 17:52:46', NULL, '2026-01-22 17:52:46', 3),
(46, 43, '37', 'Mobility Grade II', '', 2442, '2026-01-22 17:52:48', NULL, '2026-01-22 17:52:48', 4),
(47, 44, '34', 'Mobility Grade II', '', 2442, '2026-01-22 17:52:55', NULL, '2026-01-22 17:52:55', 3),
(48, 45, '21', 'Intrinsic staining', '', 2442, '2026-01-22 17:53:30', NULL, '2026-01-22 17:53:30', 4),
(49, 46, '22', 'Extrinsic staining', '', 2442, '2026-01-22 17:53:36', NULL, '2026-01-22 17:53:36', 4),
(50, 47, '26', 'Cracks', '', 2442, '2026-01-22 17:53:42', NULL, '2026-01-22 17:53:42', 8),
(51, 48, '24', 'Intrinsic staining', '', 2442, '2026-01-22 17:53:48', NULL, '2026-01-22 17:53:48', 6),
(52, 49, '23', 'Chip offs', '', 2442, '2026-01-22 17:53:53', NULL, '2026-01-22 17:53:53', 8),
(53, 50, '38', 'Intrinsic staining', '', 2442, '2026-01-22 17:53:59', NULL, '2026-01-22 17:53:59', 7),
(54, 51, '15', 'Intrinsic staining', '', 2442, '2026-01-22 17:54:04', NULL, '2026-01-22 17:54:04', 6),
(56, 52, '14', 'Intrinsic staining', '', 2442, '2026-01-22 17:54:16', NULL, '2026-01-22 17:54:16', 6),
(57, 53, '13', 'Extrinsic staining', '', 2442, '2026-01-22 17:54:22', NULL, '2026-01-22 17:54:22', 8),
(58, 54, '18', 'Mobility Grade III', '', 2442, '2026-01-22 19:07:31', NULL, '2026-01-22 19:07:31', 5),
(59, 55, '26', 'Intrinsic staining', '', 2442, '2026-01-22 19:07:36', NULL, '2026-01-22 19:07:36', 6),
(60, 56, '38', 'Intrinsic staining', '', 2442, '2026-01-22 19:07:41', NULL, '2026-01-22 19:07:41', 5),
(61, 57, '37', 'Extrinsic staining', '', 2442, '2026-01-22 19:07:47', NULL, '2026-01-22 19:07:47', 5),
(62, 58, '17', 'Mobility Grade I', '', 2442, '2026-01-26 13:05:19', NULL, '2026-01-26 13:05:19', 2),
(63, 59, '11', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(64, 60, '12', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(65, 61, '13', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(66, 62, '14', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(67, 63, '15', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(68, 64, '16', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(69, 58, '17', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(70, 54, '18', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(71, 65, '21', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(72, 66, '22', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(73, 67, '23', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(74, 68, '24', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(75, 69, '25', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(76, 55, '26', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(77, 70, '27', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(78, 71, '28', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(79, 72, '31', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(80, 73, '32', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(81, 74, '33', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(82, 75, '34', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(83, 76, '35', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(84, 77, '36', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(85, 57, '37', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(86, 56, '38', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(87, 78, '41', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(88, 79, '42', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(89, 80, '43', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(90, 81, '44', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(91, 82, '45', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(92, 83, '46', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(93, 84, '47', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(94, 85, '48', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(95, 86, '51', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(96, 87, '52', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(97, 88, '53', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(98, 89, '54', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(99, 90, '55', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(100, 91, '61', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(101, 92, '62', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(102, 93, '63', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(103, 94, '64', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(104, 95, '65', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(105, 96, '71', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(106, 97, '72', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(107, 98, '73', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(108, 99, '74', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(109, 100, '75', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(110, 101, '81', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(111, 102, '82', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(112, 103, '83', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(113, 104, '84', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(114, 105, '85', 'Cracks', '', 2442, '2026-01-26 15:31:57', NULL, '2026-01-26 15:31:57', 2),
(115, 106, '11', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(116, 107, '12', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(117, 108, '13', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(118, 109, '14', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(119, 110, '15', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(121, 112, '17', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(122, 113, '18', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(123, 114, '21', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(124, 115, '22', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(125, 116, '23', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(126, 117, '24', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(127, 118, '25', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(128, 119, '26', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(129, 120, '27', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(130, 121, '28', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(131, 122, '31', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(132, 123, '32', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(133, 124, '33', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(134, 125, '34', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(135, 126, '35', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(136, 127, '36', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(137, 128, '37', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(138, 129, '38', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(139, 130, '41', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(140, 131, '42', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(141, 132, '43', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(142, 133, '44', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(143, 134, '45', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(144, 135, '46', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(145, 136, '47', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(146, 137, '48', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(147, 138, '51', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(148, 139, '52', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(149, 140, '53', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(150, 141, '54', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(151, 142, '55', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(152, 143, '61', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(153, 144, '62', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(154, 145, '63', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(155, 146, '64', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(156, 147, '65', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(157, 148, '71', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(158, 149, '72', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(159, 150, '73', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(160, 151, '74', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(161, 152, '75', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(162, 153, '81', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(163, 154, '82', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(164, 155, '83', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(165, 156, '84', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(166, 157, '85', 'Cracks', '', 2442, '2026-01-26 18:01:08', NULL, '2026-01-26 18:01:08', 1),
(167, 158, '21', 'Extrinsic staining', 'xyz', 2442, '2026-01-27 12:38:17', NULL, '2026-01-27 12:38:17', 3),
(168, 159, '16', 'Mobility Grade III', 'xyz', 2442, '2026-01-27 12:40:32', NULL, '2026-01-27 12:40:32', 4),
(169, 160, '11', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(170, 161, '12', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(171, 162, '13', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(172, 163, '14', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(173, 164, '15', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(174, 159, '16', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(175, 165, '17', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(176, 166, '18', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(177, 158, '21', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(178, 167, '22', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(179, 168, '23', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(180, 169, '24', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(181, 170, '25', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(182, 171, '26', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(183, 172, '27', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(184, 173, '28', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(185, 174, '31', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(186, 175, '32', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(187, 176, '33', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(188, 177, '34', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(189, 178, '35', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(190, 179, '36', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(191, 180, '37', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(192, 181, '38', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(193, 182, '41', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(194, 183, '42', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(195, 184, '43', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(196, 185, '44', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(197, 186, '45', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(198, 187, '46', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(199, 188, '47', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(200, 189, '48', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(201, 190, '51', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(202, 191, '52', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(203, 192, '53', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(204, 193, '54', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(205, 194, '55', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(206, 195, '61', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(207, 196, '62', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(208, 197, '63', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(209, 198, '64', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(210, 199, '65', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(211, 200, '71', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(212, 201, '72', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(213, 202, '73', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(214, 203, '74', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(215, 204, '75', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(216, 205, '81', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(217, 206, '82', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(218, 207, '83', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(219, 208, '84', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(220, 209, '85', 'Extrinsic staining', '', 2442, '2026-01-30 14:42:51', NULL, '2026-01-30 14:42:51', 1),
(221, 1, '14', 'Percussion Positive', 'cccc', 2442, '2026-02-02 10:27:49', NULL, '2026-02-02 10:27:49', 2),
(222, 2, '31', 'Mobility Grade I', 'bnbbb', 2442, '2026-02-02 10:28:01', NULL, '2026-02-02 10:28:01', 3),
(224, 3, '13', 'Carious lesions Class I', '', 2442, '2026-02-02 15:00:00', NULL, '2026-02-02 15:00:00', 5),
(225, 3, '13', 'Percussion Positive', 'xyz', 2442, '2026-02-02 15:00:00', NULL, '2026-02-02 15:00:00', 2),
(226, 4, '44', 'Grossly caries', '', 2442, '2026-02-02 18:37:37', NULL, '2026-02-02 18:37:37', 5),
(227, 5, '11', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(228, 6, '12', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(229, 7, '13', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(230, 8, '14', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(231, 9, '15', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(232, 10, '16', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(233, 11, '17', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(234, 12, '18', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(235, 13, '21', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(236, 14, '22', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(237, 15, '23', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(238, 16, '24', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(239, 17, '25', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(240, 18, '26', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(241, 19, '27', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(242, 21, '31', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(243, 22, '32', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(244, 23, '33', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(245, 24, '34', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(246, 25, '35', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(247, 26, '36', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(248, 27, '37', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(249, 29, '41', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(250, 30, '42', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(251, 31, '43', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(252, 4, '44', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(253, 32, '45', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(254, 33, '46', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(255, 34, '47', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(256, 35, '48', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(257, 36, '51', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(258, 37, '52', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(259, 38, '53', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(260, 39, '54', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(261, 40, '55', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(262, 41, '61', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(263, 42, '62', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(264, 43, '63', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(265, 44, '64', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(266, 45, '65', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(267, 46, '71', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(268, 47, '72', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(269, 48, '73', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(270, 49, '74', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(271, 50, '75', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(272, 51, '81', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(273, 52, '82', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(274, 53, '83', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(275, 54, '84', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(276, 55, '85', 'Percussion Positive', 'xyz', 2442, '2026-02-02 18:40:00', NULL, '2026-02-02 18:40:00', 2),
(277, 56, '11', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(278, 57, '12', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(279, 58, '13', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(280, 59, '14', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(281, 60, '15', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(282, 61, '16', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(283, 62, '17', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(284, 63, '18', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(285, 64, '21', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(286, 65, '22', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(287, 66, '23', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(288, 67, '24', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(289, 68, '25', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(290, 69, '26', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(291, 70, '27', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(292, 71, '28', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(293, 72, '31', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(294, 73, '32', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(295, 74, '33', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(296, 75, '34', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(297, 76, '35', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(298, 77, '36', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(299, 78, '37', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(300, 79, '38', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(301, 80, '41', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(302, 81, '42', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(303, 82, '43', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(304, 83, '44', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(305, 84, '45', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(306, 85, '46', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(307, 86, '47', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(308, 87, '48', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(309, 88, '51', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(310, 89, '52', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(311, 90, '53', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(312, 91, '54', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(313, 92, '55', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(314, 93, '61', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(315, 94, '62', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(316, 95, '63', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(317, 96, '64', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(318, 97, '65', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(319, 98, '71', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(320, 99, '72', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(321, 100, '73', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(322, 101, '74', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(323, 102, '75', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(324, 103, '81', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(325, 104, '82', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(326, 105, '83', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(327, 106, '84', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(328, 107, '85', 'Percussion Positive', 'xyzzz', 2442, '2026-02-02 19:40:00', NULL, '2026-02-02 19:40:00', 3),
(332, 108, '18', 'Cracks', '', 2442, '2026-02-03 11:54:50', NULL, '2026-02-03 11:54:50', 1),
(333, 108, '18', 'Cracks', '', 2442, '2026-02-03 11:54:50', NULL, '2026-02-03 11:54:50', 1),
(334, 108, '18', 'Mobility Grade I', 'xxxxxxx', 2442, '2026-02-03 11:54:50', NULL, '2026-02-03 11:54:50', 2),
(335, 109, '55', 'Restored teeth', 'nnnnnnnnn', 2442, '2026-02-03 12:01:07', NULL, '2026-02-03 12:01:07', 2),
(337, 110, '65', 'Ankylosis', 'bbbbbbbbbbbbbbbbbbb', 2442, '2026-02-03 12:01:35', NULL, '2026-02-03 12:01:35', 3),
(338, 111, '16', 'Mobility Grade II', '', 2442, '2026-02-03 13:14:19', NULL, '2026-02-03 13:14:19', 4);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_plan_notes`
--

CREATE TABLE `treatment_plan_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_treatment_plan_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tooth_number` int(11) NOT NULL,
  `patient_treatment_plan_procedure_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treatment_plan_notes`
--

INSERT INTO `treatment_plan_notes` (`id`, `patient_treatment_plan_id`, `datetime`, `username`, `created_at`, `updated_at`, `tooth_number`, `patient_treatment_plan_procedure_id`) VALUES
(5, 26, '2024-09-14 13:31:22', 'WORKING LENGTH 21mm FILE F3\r\nCALCIUM HYDROXIDE PLACED AND CAVIT FILLING', '2024-09-14 18:31:22', '2024-09-14 18:31:22', 0, NULL),
(6, 28, '2025-02-10 05:21:40', 'cfds fsdfsdfsdf', '2025-02-10 10:21:40', '2025-02-10 10:21:40', 11, NULL),
(7, 30, '2025-02-10 15:03:11', 'kjhff', '2025-02-10 20:03:11', '2025-02-10 20:03:11', 15, NULL),
(8, 30, '2025-02-10 15:06:01', 'fghjjk', '2025-02-10 20:06:01', '2025-02-10 20:06:01', 18, NULL),
(9, 34, '2025-03-17 09:22:19', 'notes', '2025-03-17 14:22:19', '2025-03-17 14:22:19', 14, NULL),
(10, 37, '2025-04-11 15:00:00', 'notes 1', '2025-04-11 10:00:00', '2025-04-11 10:00:00', 18, NULL),
(11, 37, '2025-04-11 15:00:14', 'notes2', '2025-04-11 10:00:14', '2025-04-11 10:00:14', 18, NULL),
(12, 38, '2025-04-11 17:48:30', 'test', '2025-04-11 12:48:30', '2025-04-11 12:48:30', 18, NULL),
(13, 37, '2025-04-28 02:09:50', 'asdfsdaf', '2025-04-27 21:09:50', '2025-04-27 21:09:50', 18, 78),
(14, 37, '2025-04-28 02:09:55', 'ggdssdgsdg', '2025-04-27 21:09:55', '2025-04-27 21:09:55', 18, 78),
(15, 39, '2025-04-28 14:26:41', 'after break continue', '2025-04-28 09:26:41', '2025-04-28 09:26:41', 16, 82),
(16, 39, '2025-04-28 14:26:50', 'restart', '2025-04-28 09:26:50', '2025-04-28 09:26:50', 16, 82),
(17, 39, '2025-04-28 14:27:09', 'completed', '2025-04-28 09:27:09', '2025-04-28 09:27:09', 16, 82),
(18, 38, '2025-04-30 15:09:36', 'completed', '2025-04-30 10:09:36', '2025-04-30 10:09:36', 18, 80),
(19, 47, '2025-09-01 19:35:02', 'dsf safsdafsadfsadfsd', '2025-09-01 14:35:02', '2025-09-01 14:35:02', 45, 89),
(20, 47, '2025-09-01 19:35:11', 'asd fsadfsadfasd', '2025-09-01 14:35:11', '2025-09-01 14:35:11', 45, 90),
(21, 9, '2026-01-21 07:37:43', 'hj kjh kh khkj hkjh kj', '2026-01-21 12:37:43', '2026-01-21 12:37:43', 11, 24),
(22, 9, '2026-01-21 07:37:52', 'j kjh kjh kjh kh jh jh', '2026-01-21 12:37:52', '2026-01-21 12:37:52', 11, 24),
(23, 11, '2026-01-23 14:43:13', 'sad fsafsdaf sadfsadfsda', '2026-01-23 19:43:13', '2026-01-23 19:43:13', 16, 28),
(24, 11, '2026-01-23 14:43:23', 'sadf safsadfsadf asdfasdfsadf', '2026-01-23 19:43:23', '2026-01-23 19:43:23', 16, 28),
(25, 11, '2026-01-26 10:44:39', 'fever', '2026-01-26 15:44:39', '2026-01-26 15:44:39', 16, 28),
(26, 14, '2026-01-27 07:41:37', 'new problem', '2026-01-27 12:41:37', '2026-01-27 12:41:37', 21, 31),
(27, 14, '2026-01-27 07:41:46', 'new poblem', '2026-01-27 12:41:46', '2026-01-27 12:41:46', 16, 32);

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `launched` varchar(255) NOT NULL,
  `old_version` varchar(255) DEFAULT NULL,
  `new_version` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mrn` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `locale` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `blood_group` int(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `access_token` varchar(100) DEFAULT NULL,
  `refresh_token` varchar(100) DEFAULT NULL,
  `expirre_access` timestamp NULL DEFAULT NULL,
  `access_expire` timestamp NULL DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `mrn`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `photo`, `locale`, `date_of_birth`, `gender`, `blood_group`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `access_token`, `refresh_token`, `expirre_access`, `access_expire`, `age`) VALUES
(2442, 1, NULL, 'Admin', 'admin@MWD.com', NULL, '$2y$12$uOIxF45JitEjFVwRqqUeh.Dssrmsa7o0KQTEYopLBEvYyl.0WW6HK', '12121212', '<p>Karachi pak</p>', 'public/uploads/project-1/profile/17699509051.png', NULL, NULL, NULL, NULL, '1', 'TQsdsjUFEJcAk2YtvH92ShRF83AXZrccaohHFVJ1c8KVx3jOF6rXpNst3Lfb', '2025-12-26 12:26:24', '2026-02-03 18:03:17', NULL, '87vyCwup3Ejq6TuNG4mFCcBCxT7Wd4kqqIz4HcXx1vKkeZXSyZvzFF8hPNdZX4Ayaz19UbcpbW2uRoo1C8JqzASaCx', 'xKXo1mLq86StBBUGwe5RogviYOHFhbdpjvqTdCMc3q4zIbXVAdavLfQyngnhwIxZZTRSqvxvZMkw2e5YI7fv2lbz0z', NULL, '2026-02-03 19:03:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_companies`
--

CREATE TABLE `user_companies` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_companies`
--

INSERT INTO `user_companies` (`user_id`, `company_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 1, 'App\\Models\\User'),
(3, 1, 'App\\Models\\User'),
(4, 1, 'App\\Models\\User'),
(5, 1, 'App\\Models\\User'),
(6, 1, 'App\\Models\\User'),
(7, 1, 'App\\Models\\User'),
(8, 1, 'App\\Models\\User'),
(9, 1, 'App\\Models\\User'),
(10, 1, 'App\\Models\\User'),
(11, 1, 'App\\Models\\User'),
(12, 1, 'App\\Models\\User'),
(13, 1, 'App\\Models\\User'),
(14, 1, 'App\\Models\\User'),
(15, 1, 'App\\Models\\User'),
(16, 1, 'App\\Models\\User'),
(17, 1, 'App\\Models\\User'),
(18, 1, 'App\\Models\\User'),
(19, 1, 'App\\Models\\User'),
(20, 1, 'App\\Models\\User'),
(21, 1, 'App\\Models\\User'),
(22, 1, 'App\\Models\\User'),
(23, 1, 'App\\Models\\User'),
(24, 1, 'App\\Models\\User'),
(25, 1, 'App\\Models\\User'),
(26, 1, 'App\\Models\\User'),
(34, 1, 'App\\Models\\User'),
(35, 1, 'App\\Models\\User'),
(36, 1, 'App\\Models\\User'),
(37, 1, 'App\\Models\\User'),
(38, 1, 'App\\Models\\User'),
(39, 1, 'App\\Models\\User'),
(40, 1, 'App\\Models\\User'),
(41, 1, 'App\\Models\\User'),
(42, 1, 'App\\Models\\User'),
(43, 1, ''),
(44, 1, 'App\\Models\\User'),
(46, 1, 'App\\Models\\User'),
(48, 1, 'App\\Models\\User'),
(49, 1, 'App\\Models\\User'),
(50, 1, 'App\\Models\\User'),
(51, 1, 'App\\Models\\User'),
(55, 1, 'App\\Models\\User'),
(57, 1, 'App\\Models\\User'),
(59, 1, 'App\\Models\\User'),
(61, 1, 'App\\Models\\User'),
(62, 1, 'App\\Models\\User'),
(63, 1, 'App\\Models\\User'),
(64, 1, 'App\\Models\\User'),
(65, 1, 'App\\Models\\User'),
(66, 1, 'App\\Models\\User'),
(67, 1, 'App\\Models\\User'),
(70, 1, 'App\\Models\\User'),
(71, 1, 'App\\Models\\User'),
(72, 1, 'App\\Models\\User'),
(73, 1, 'App\\Models\\User'),
(74, 1, 'App\\Models\\User'),
(75, 1, 'App\\Models\\User'),
(76, 1, 'App\\Models\\User'),
(77, 1, 'App\\Models\\User'),
(78, 1, 'App\\Models\\User'),
(79, 1, 'App\\Models\\User'),
(80, 1, 'App\\Models\\User'),
(81, 1, 'App\\Models\\User'),
(82, 1, 'App\\Models\\User'),
(83, 1, 'App\\Models\\User'),
(84, 1, 'App\\Models\\User'),
(85, 1, 'App\\Models\\User'),
(86, 1, 'App\\Models\\User'),
(87, 1, 'App\\Models\\User'),
(88, 1, 'App\\Models\\User'),
(89, 1, 'App\\Models\\User'),
(90, 1, 'App\\Models\\User'),
(91, 1, 'App\\Models\\User'),
(92, 1, 'App\\Models\\User'),
(93, 1, 'App\\Models\\User'),
(94, 1, 'App\\Models\\User'),
(95, 1, 'App\\Models\\User'),
(96, 1, 'App\\Models\\User'),
(98, 1, 'App\\Models\\User'),
(99, 1, 'App\\Models\\User'),
(101, 1, 'App\\Models\\User'),
(104, 1, 'App\\Models\\User'),
(105, 1, 'App\\Models\\User'),
(106, 1, 'App\\Models\\User'),
(114, 1, 'App\\Models\\User'),
(115, 1, 'App\\Models\\User'),
(116, 1, 'App\\Models\\User'),
(117, 1, 'App\\Models\\User'),
(119, 1, 'App\\Models\\User'),
(120, 1, 'App\\Models\\User'),
(121, 1, 'App\\Models\\User'),
(122, 1, 'App\\Models\\User'),
(123, 1, 'App\\Models\\User'),
(124, 1, 'App\\Models\\User'),
(127, 1, 'App\\Models\\User'),
(129, 1, 'App\\Models\\User'),
(130, 1, 'App\\Models\\User'),
(131, 1, 'App\\Models\\User'),
(133, 1, 'App\\Models\\User'),
(135, 1, 'App\\Models\\User'),
(136, 1, 'App\\Models\\User'),
(137, 1, 'App\\Models\\User'),
(138, 1, 'App\\Models\\User'),
(141, 1, 'App\\Models\\User'),
(142, 1, 'App\\Models\\User'),
(143, 1, 'App\\Models\\User'),
(145, 1, 'App\\Models\\User'),
(146, 1, 'App\\Models\\User'),
(147, 1, 'App\\Models\\User'),
(148, 1, 'App\\Models\\User'),
(149, 1, 'App\\Models\\User'),
(150, 1, 'App\\Models\\User'),
(151, 1, 'App\\Models\\User'),
(152, 1, 'App\\Models\\User'),
(153, 1, 'App\\Models\\User'),
(154, 1, 'App\\Models\\User'),
(156, 1, 'App\\Models\\User'),
(157, 1, 'App\\Models\\User'),
(158, 1, 'App\\Models\\User'),
(160, 1, 'App\\Models\\User'),
(161, 1, 'App\\Models\\User'),
(162, 1, 'App\\Models\\User'),
(163, 1, 'App\\Models\\User'),
(164, 1, 'App\\Models\\User'),
(165, 1, 'App\\Models\\User'),
(166, 1, 'App\\Models\\User'),
(167, 1, 'App\\Models\\User'),
(168, 1, 'App\\Models\\User'),
(171, 1, 'App\\Models\\User'),
(172, 1, 'App\\Models\\User'),
(173, 1, 'App\\Models\\User'),
(176, 1, 'App\\Models\\User'),
(185, 1, 'App\\Models\\User'),
(186, 1, 'App\\Models\\User'),
(187, 1, 'App\\Models\\User'),
(189, 1, 'App\\Models\\User'),
(190, 1, 'App\\Models\\User'),
(191, 1, 'App\\Models\\User'),
(197, 1, 'App\\Models\\User'),
(200, 1, 'App\\Models\\User'),
(201, 1, 'App\\Models\\User'),
(203, 1, 'App\\Models\\User'),
(204, 1, 'App\\Models\\User'),
(208, 1, 'App\\Models\\User'),
(210, 1, 'App\\Models\\User'),
(211, 1, 'App\\Models\\User'),
(214, 1, 'App\\Models\\User'),
(216, 1, 'App\\Models\\User'),
(217, 1, 'App\\Models\\User'),
(220, 1, 'App\\Models\\User'),
(221, 1, 'App\\Models\\User'),
(222, 1, 'App\\Models\\User'),
(223, 1, 'App\\Models\\User'),
(224, 1, 'App\\Models\\User'),
(225, 1, 'App\\Models\\User'),
(226, 1, 'App\\Models\\User'),
(227, 1, 'App\\Models\\User'),
(228, 1, 'App\\Models\\User'),
(229, 1, 'App\\Models\\User'),
(230, 1, 'App\\Models\\User'),
(231, 1, 'App\\Models\\User'),
(232, 1, 'App\\Models\\User'),
(233, 1, 'App\\Models\\User'),
(234, 1, 'App\\Models\\User'),
(235, 1, 'App\\Models\\User'),
(236, 1, 'App\\Models\\User'),
(237, 1, 'App\\Models\\User'),
(238, 1, 'App\\Models\\User'),
(239, 1, 'App\\Models\\User'),
(240, 1, 'App\\Models\\User'),
(243, 1, 'App\\Models\\User'),
(245, 1, 'App\\Models\\User'),
(246, 1, 'App\\Models\\User'),
(247, 1, 'App\\Models\\User'),
(248, 1, 'App\\Models\\User'),
(249, 1, 'App\\Models\\User'),
(250, 1, 'App\\Models\\User'),
(251, 1, 'App\\Models\\User'),
(252, 1, 'App\\Models\\User'),
(253, 1, 'App\\Models\\User'),
(254, 1, 'App\\Models\\User'),
(255, 1, 'App\\Models\\User'),
(256, 1, 'App\\Models\\User'),
(257, 1, 'App\\Models\\User'),
(258, 1, 'App\\Models\\User'),
(259, 1, 'App\\Models\\User'),
(260, 1, 'App\\Models\\User'),
(262, 1, 'App\\Models\\User'),
(263, 1, 'App\\Models\\User'),
(264, 1, 'App\\Models\\User'),
(265, 1, 'App\\Models\\User'),
(266, 1, 'App\\Models\\User'),
(268, 1, 'App\\Models\\User'),
(269, 1, 'App\\Models\\User'),
(270, 1, 'App\\Models\\User'),
(271, 1, 'App\\Models\\User'),
(273, 1, 'App\\Models\\User'),
(274, 1, 'App\\Models\\User'),
(275, 1, 'App\\Models\\User'),
(276, 1, 'App\\Models\\User'),
(278, 1, 'App\\Models\\User'),
(279, 1, 'App\\Models\\User'),
(280, 1, 'App\\Models\\User'),
(281, 1, 'App\\Models\\User'),
(283, 1, 'App\\Models\\User'),
(285, 1, 'App\\Models\\User'),
(286, 1, 'App\\Models\\User'),
(287, 1, 'App\\Models\\User'),
(288, 1, 'App\\Models\\User'),
(292, 1, 'App\\Models\\User'),
(293, 1, 'App\\Models\\User'),
(294, 1, 'App\\Models\\User'),
(295, 1, 'App\\Models\\User'),
(296, 1, 'App\\Models\\User'),
(297, 1, 'App\\Models\\User'),
(298, 1, 'App\\Models\\User'),
(299, 1, 'App\\Models\\User'),
(300, 1, 'App\\Models\\User'),
(301, 1, 'App\\Models\\User'),
(302, 1, 'App\\Models\\User'),
(303, 1, 'App\\Models\\User'),
(304, 1, 'App\\Models\\User'),
(305, 1, 'App\\Models\\User'),
(306, 1, 'App\\Models\\User'),
(307, 1, 'App\\Models\\User'),
(310, 1, 'App\\Models\\User'),
(311, 1, 'App\\Models\\User'),
(312, 1, 'App\\Models\\User'),
(313, 1, 'App\\Models\\User'),
(314, 1, 'App\\Models\\User'),
(315, 1, 'App\\Models\\User'),
(316, 1, 'App\\Models\\User'),
(317, 1, 'App\\Models\\User'),
(318, 1, 'App\\Models\\User'),
(321, 1, 'App\\Models\\User'),
(322, 1, 'App\\Models\\User'),
(324, 1, 'App\\Models\\User'),
(325, 1, 'App\\Models\\User'),
(326, 1, 'App\\Models\\User'),
(327, 1, 'App\\Models\\User'),
(328, 1, 'App\\Models\\User'),
(329, 1, 'App\\Models\\User'),
(330, 1, 'App\\Models\\User'),
(331, 1, 'App\\Models\\User'),
(332, 1, 'App\\Models\\User'),
(333, 1, 'App\\Models\\User'),
(334, 1, 'App\\Models\\User'),
(335, 1, 'App\\Models\\User'),
(336, 1, 'App\\Models\\User'),
(337, 1, 'App\\Models\\User'),
(338, 1, 'App\\Models\\User'),
(339, 1, 'App\\Models\\User'),
(340, 1, 'App\\Models\\User'),
(341, 1, 'App\\Models\\User'),
(342, 1, 'App\\Models\\User'),
(343, 1, 'App\\Models\\User'),
(344, 1, 'App\\Models\\User'),
(345, 1, 'App\\Models\\User'),
(346, 1, 'App\\Models\\User'),
(347, 1, 'App\\Models\\User'),
(348, 1, 'App\\Models\\User'),
(349, 1, 'App\\Models\\User'),
(350, 1, 'App\\Models\\User'),
(351, 1, 'App\\Models\\User'),
(352, 1, 'App\\Models\\User'),
(353, 1, 'App\\Models\\User'),
(354, 1, 'App\\Models\\User'),
(355, 1, 'App\\Models\\User'),
(356, 1, 'App\\Models\\User'),
(357, 1, 'App\\Models\\User'),
(358, 1, 'App\\Models\\User'),
(359, 1, 'App\\Models\\User'),
(360, 1, 'App\\Models\\User'),
(361, 1, 'App\\Models\\User'),
(362, 1, 'App\\Models\\User'),
(363, 1, 'App\\Models\\User'),
(364, 1, 'App\\Models\\User'),
(365, 1, 'App\\Models\\User'),
(366, 1, 'App\\Models\\User'),
(367, 1, 'App\\Models\\User'),
(368, 1, 'App\\Models\\User'),
(369, 1, 'App\\Models\\User'),
(370, 1, 'App\\Models\\User'),
(371, 1, 'App\\Models\\User'),
(372, 1, 'App\\Models\\User'),
(373, 1, 'App\\Models\\User'),
(374, 1, 'App\\Models\\User'),
(375, 1, 'App\\Models\\User'),
(376, 1, 'App\\Models\\User'),
(377, 1, 'App\\Models\\User'),
(378, 1, 'App\\Models\\User'),
(379, 1, 'App\\Models\\User'),
(380, 1, 'App\\Models\\User'),
(381, 1, 'App\\Models\\User'),
(382, 1, 'App\\Models\\User'),
(383, 1, 'App\\Models\\User'),
(384, 1, 'App\\Models\\User'),
(385, 1, 'App\\Models\\User'),
(386, 1, 'App\\Models\\User'),
(387, 1, 'App\\Models\\User'),
(388, 1, 'App\\Models\\User'),
(389, 1, 'App\\Models\\User'),
(390, 1, 'App\\Models\\User'),
(391, 1, 'App\\Models\\User'),
(392, 1, 'App\\Models\\User'),
(393, 1, 'App\\Models\\User'),
(394, 1, 'App\\Models\\User'),
(395, 1, 'App\\Models\\User'),
(396, 1, 'App\\Models\\User'),
(397, 1, 'App\\Models\\User'),
(398, 1, 'App\\Models\\User'),
(399, 1, 'App\\Models\\User'),
(400, 1, 'App\\Models\\User'),
(401, 1, 'App\\Models\\User'),
(402, 1, 'App\\Models\\User'),
(403, 1, 'App\\Models\\User'),
(404, 1, 'App\\Models\\User'),
(405, 1, 'App\\Models\\User'),
(406, 1, 'App\\Models\\User'),
(407, 1, 'App\\Models\\User'),
(408, 1, 'App\\Models\\User'),
(409, 1, 'App\\Models\\User'),
(410, 1, 'App\\Models\\User'),
(411, 1, 'App\\Models\\User'),
(412, 1, 'App\\Models\\User'),
(413, 1, 'App\\Models\\User'),
(414, 1, 'App\\Models\\User'),
(415, 1, 'App\\Models\\User'),
(416, 1, 'App\\Models\\User'),
(417, 1, 'App\\Models\\User'),
(418, 1, 'App\\Models\\User'),
(419, 1, 'App\\Models\\User'),
(420, 1, 'App\\Models\\User'),
(421, 1, 'App\\Models\\User'),
(422, 1, 'App\\Models\\User'),
(423, 1, 'App\\Models\\User'),
(424, 1, 'App\\Models\\User'),
(425, 1, 'App\\Models\\User'),
(426, 1, 'App\\Models\\User'),
(427, 1, 'App\\Models\\User'),
(428, 1, 'App\\Models\\User'),
(429, 1, 'App\\Models\\User'),
(430, 1, 'App\\Models\\User'),
(431, 1, 'App\\Models\\User'),
(432, 1, 'App\\Models\\User'),
(433, 1, 'App\\Models\\User'),
(434, 1, 'App\\Models\\User'),
(435, 1, 'App\\Models\\User'),
(436, 1, 'App\\Models\\User'),
(437, 1, 'App\\Models\\User'),
(438, 1, 'App\\Models\\User'),
(439, 1, 'App\\Models\\User'),
(440, 1, 'App\\Models\\User'),
(441, 1, 'App\\Models\\User'),
(442, 1, 'App\\Models\\User'),
(443, 1, 'App\\Models\\User'),
(444, 1, 'App\\Models\\User'),
(445, 1, 'App\\Models\\User'),
(446, 1, 'App\\Models\\User'),
(447, 1, 'App\\Models\\User'),
(448, 1, 'App\\Models\\User'),
(449, 1, 'App\\Models\\User'),
(450, 1, 'App\\Models\\User'),
(451, 1, 'App\\Models\\User'),
(452, 1, 'App\\Models\\User'),
(453, 1, 'App\\Models\\User'),
(454, 1, 'App\\Models\\User'),
(455, 1, 'App\\Models\\User'),
(456, 1, 'App\\Models\\User'),
(457, 1, 'App\\Models\\User'),
(458, 1, 'App\\Models\\User'),
(459, 1, 'App\\Models\\User'),
(460, 1, 'App\\Models\\User'),
(461, 1, 'App\\Models\\User'),
(462, 1, 'App\\Models\\User'),
(463, 1, 'App\\Models\\User'),
(464, 1, 'App\\Models\\User'),
(465, 1, 'App\\Models\\User'),
(466, 1, 'App\\Models\\User'),
(467, 1, 'App\\Models\\User'),
(468, 1, 'App\\Models\\User'),
(469, 1, 'App\\Models\\User'),
(470, 1, 'App\\Models\\User'),
(471, 1, 'App\\Models\\User'),
(472, 1, 'App\\Models\\User'),
(473, 1, 'App\\Models\\User'),
(474, 1, 'App\\Models\\User'),
(475, 1, 'App\\Models\\User'),
(476, 1, 'App\\Models\\User'),
(477, 1, 'App\\Models\\User'),
(478, 1, 'App\\Models\\User'),
(479, 1, 'App\\Models\\User'),
(480, 1, 'App\\Models\\User'),
(481, 1, 'App\\Models\\User'),
(482, 1, 'App\\Models\\User'),
(483, 1, 'App\\Models\\User'),
(484, 1, 'App\\Models\\User'),
(485, 1, 'App\\Models\\User'),
(486, 1, 'App\\Models\\User'),
(487, 1, 'App\\Models\\User'),
(488, 1, 'App\\Models\\User'),
(489, 1, 'App\\Models\\User'),
(490, 1, 'App\\Models\\User'),
(491, 1, 'App\\Models\\User'),
(492, 1, 'App\\Models\\User'),
(493, 1, 'App\\Models\\User'),
(494, 1, 'App\\Models\\User'),
(495, 1, 'App\\Models\\User'),
(496, 1, 'App\\Models\\User'),
(497, 1, 'App\\Models\\User'),
(498, 1, 'App\\Models\\User'),
(499, 1, 'App\\Models\\User'),
(500, 1, 'App\\Models\\User'),
(501, 1, 'App\\Models\\User'),
(502, 1, 'App\\Models\\User'),
(503, 1, 'App\\Models\\User'),
(504, 1, 'App\\Models\\User'),
(505, 1, 'App\\Models\\User'),
(506, 1, 'App\\Models\\User'),
(507, 1, 'App\\Models\\User'),
(508, 1, 'App\\Models\\User'),
(509, 1, 'App\\Models\\User'),
(510, 1, 'App\\Models\\User'),
(511, 1, 'App\\Models\\User'),
(512, 1, 'App\\Models\\User'),
(513, 1, 'App\\Models\\User'),
(514, 1, 'App\\Models\\User'),
(515, 1, 'App\\Models\\User'),
(516, 1, 'App\\Models\\User'),
(517, 1, 'App\\Models\\User'),
(518, 1, 'App\\Models\\User'),
(519, 1, 'App\\Models\\User'),
(520, 1, 'App\\Models\\User'),
(521, 1, 'App\\Models\\User'),
(522, 1, 'App\\Models\\User'),
(523, 1, 'App\\Models\\User'),
(524, 1, 'App\\Models\\User'),
(525, 1, 'App\\Models\\User'),
(526, 1, 'App\\Models\\User'),
(527, 1, 'App\\Models\\User'),
(528, 1, 'App\\Models\\User'),
(529, 1, 'App\\Models\\User'),
(530, 1, 'App\\Models\\User'),
(531, 1, 'App\\Models\\User'),
(532, 1, 'App\\Models\\User'),
(533, 1, 'App\\Models\\User'),
(534, 1, 'App\\Models\\User'),
(535, 1, 'App\\Models\\User'),
(536, 1, 'App\\Models\\User'),
(537, 1, 'App\\Models\\User'),
(538, 1, 'App\\Models\\User'),
(539, 1, 'App\\Models\\User'),
(540, 1, 'App\\Models\\User'),
(541, 1, 'App\\Models\\User'),
(542, 1, 'App\\Models\\User'),
(543, 1, 'App\\Models\\User'),
(544, 1, 'App\\Models\\User'),
(545, 1, 'App\\Models\\User'),
(546, 1, 'App\\Models\\User'),
(547, 1, 'App\\Models\\User'),
(548, 1, 'App\\Models\\User'),
(549, 1, 'App\\Models\\User'),
(550, 1, 'App\\Models\\User'),
(551, 1, 'App\\Models\\User'),
(552, 1, 'App\\Models\\User'),
(553, 1, 'App\\Models\\User'),
(554, 1, 'App\\Models\\User'),
(555, 1, 'App\\Models\\User'),
(556, 1, 'App\\Models\\User'),
(557, 1, 'App\\Models\\User'),
(558, 1, 'App\\Models\\User'),
(559, 1, 'App\\Models\\User'),
(560, 1, 'App\\Models\\User'),
(561, 1, 'App\\Models\\User'),
(562, 1, 'App\\Models\\User'),
(563, 1, 'App\\Models\\User'),
(564, 1, 'App\\Models\\User'),
(565, 1, 'App\\Models\\User'),
(566, 1, 'App\\Models\\User'),
(567, 1, 'App\\Models\\User'),
(568, 1, 'App\\Models\\User'),
(569, 1, 'App\\Models\\User'),
(570, 1, 'App\\Models\\User'),
(571, 1, 'App\\Models\\User'),
(572, 1, 'App\\Models\\User'),
(573, 1, 'App\\Models\\User'),
(574, 1, 'App\\Models\\User'),
(575, 1, 'App\\Models\\User'),
(576, 1, 'App\\Models\\User'),
(577, 1, 'App\\Models\\User'),
(578, 1, 'App\\Models\\User'),
(579, 1, 'App\\Models\\User'),
(580, 1, 'App\\Models\\User'),
(581, 1, 'App\\Models\\User'),
(582, 1, 'App\\Models\\User'),
(583, 1, 'App\\Models\\User'),
(584, 1, 'App\\Models\\User'),
(585, 1, 'App\\Models\\User'),
(586, 1, 'App\\Models\\User'),
(587, 1, 'App\\Models\\User'),
(588, 1, 'App\\Models\\User'),
(589, 1, 'App\\Models\\User'),
(590, 1, 'App\\Models\\User'),
(591, 1, 'App\\Models\\User'),
(592, 1, 'App\\Models\\User'),
(593, 1, 'App\\Models\\User'),
(594, 1, 'App\\Models\\User'),
(595, 1, 'App\\Models\\User'),
(596, 1, 'App\\Models\\User'),
(597, 1, 'App\\Models\\User'),
(598, 1, 'App\\Models\\User'),
(599, 1, 'App\\Models\\User'),
(600, 1, 'App\\Models\\User'),
(601, 1, 'App\\Models\\User'),
(602, 1, 'App\\Models\\User'),
(603, 1, 'App\\Models\\User'),
(604, 1, 'App\\Models\\User'),
(605, 1, 'App\\Models\\User'),
(606, 1, 'App\\Models\\User'),
(607, 1, 'App\\Models\\User'),
(608, 1, 'App\\Models\\User'),
(609, 1, 'App\\Models\\User'),
(610, 1, 'App\\Models\\User'),
(611, 1, 'App\\Models\\User'),
(612, 1, 'App\\Models\\User'),
(613, 1, 'App\\Models\\User'),
(614, 1, 'App\\Models\\User'),
(615, 1, 'App\\Models\\User'),
(616, 1, 'App\\Models\\User'),
(617, 1, 'App\\Models\\User'),
(618, 1, 'App\\Models\\User'),
(619, 1, 'App\\Models\\User'),
(620, 1, 'App\\Models\\User'),
(621, 1, 'App\\Models\\User'),
(622, 1, 'App\\Models\\User'),
(623, 1, 'App\\Models\\User'),
(624, 1, 'App\\Models\\User'),
(625, 1, 'App\\Models\\User'),
(626, 1, 'App\\Models\\User'),
(627, 1, 'App\\Models\\User'),
(628, 1, 'App\\Models\\User'),
(629, 1, 'App\\Models\\User'),
(630, 1, 'App\\Models\\User'),
(631, 1, 'App\\Models\\User'),
(632, 1, 'App\\Models\\User'),
(633, 1, 'App\\Models\\User'),
(634, 1, 'App\\Models\\User'),
(635, 1, 'App\\Models\\User'),
(636, 1, 'App\\Models\\User'),
(637, 1, 'App\\Models\\User'),
(638, 1, 'App\\Models\\User'),
(639, 1, 'App\\Models\\User'),
(640, 1, 'App\\Models\\User'),
(641, 1, 'App\\Models\\User'),
(642, 1, 'App\\Models\\User'),
(643, 1, 'App\\Models\\User'),
(644, 1, 'App\\Models\\User'),
(645, 1, 'App\\Models\\User'),
(646, 1, 'App\\Models\\User'),
(647, 1, 'App\\Models\\User'),
(648, 1, 'App\\Models\\User'),
(649, 1, 'App\\Models\\User'),
(650, 1, 'App\\Models\\User'),
(651, 1, 'App\\Models\\User'),
(652, 1, 'App\\Models\\User'),
(653, 1, 'App\\Models\\User'),
(654, 1, 'App\\Models\\User'),
(655, 1, 'App\\Models\\User'),
(656, 1, 'App\\Models\\User'),
(657, 1, 'App\\Models\\User'),
(658, 1, 'App\\Models\\User'),
(659, 1, 'App\\Models\\User'),
(660, 1, 'App\\Models\\User'),
(661, 1, 'App\\Models\\User'),
(662, 1, 'App\\Models\\User'),
(663, 1, 'App\\Models\\User'),
(664, 1, 'App\\Models\\User'),
(665, 1, 'App\\Models\\User'),
(666, 1, 'App\\Models\\User'),
(667, 1, 'App\\Models\\User'),
(668, 1, 'App\\Models\\User'),
(669, 1, 'App\\Models\\User'),
(670, 1, 'App\\Models\\User'),
(671, 1, 'App\\Models\\User'),
(672, 1, 'App\\Models\\User'),
(673, 1, 'App\\Models\\User'),
(674, 1, 'App\\Models\\User'),
(675, 1, 'App\\Models\\User'),
(676, 1, 'App\\Models\\User'),
(677, 1, 'App\\Models\\User'),
(678, 1, 'App\\Models\\User'),
(679, 1, 'App\\Models\\User'),
(680, 1, 'App\\Models\\User'),
(681, 1, 'App\\Models\\User'),
(682, 1, 'App\\Models\\User'),
(683, 1, 'App\\Models\\User'),
(684, 1, 'App\\Models\\User'),
(685, 1, 'App\\Models\\User'),
(686, 1, 'App\\Models\\User'),
(687, 1, 'App\\Models\\User'),
(688, 1, 'App\\Models\\User'),
(689, 1, 'App\\Models\\User'),
(690, 1, 'App\\Models\\User'),
(691, 1, 'App\\Models\\User'),
(692, 1, 'App\\Models\\User'),
(693, 1, 'App\\Models\\User'),
(694, 1, 'App\\Models\\User'),
(695, 1, 'App\\Models\\User'),
(696, 1, 'App\\Models\\User'),
(697, 1, 'App\\Models\\User'),
(698, 1, 'App\\Models\\User'),
(699, 1, 'App\\Models\\User'),
(700, 1, 'App\\Models\\User'),
(701, 1, 'App\\Models\\User'),
(702, 1, 'App\\Models\\User'),
(703, 1, 'App\\Models\\User'),
(704, 1, 'App\\Models\\User'),
(705, 1, 'App\\Models\\User'),
(706, 1, 'App\\Models\\User'),
(707, 1, 'App\\Models\\User'),
(708, 1, 'App\\Models\\User'),
(709, 1, 'App\\Models\\User'),
(710, 1, 'App\\Models\\User'),
(711, 1, 'App\\Models\\User'),
(712, 1, 'App\\Models\\User'),
(713, 1, 'App\\Models\\User'),
(714, 1, 'App\\Models\\User'),
(715, 1, 'App\\Models\\User'),
(716, 1, 'App\\Models\\User'),
(717, 1, 'App\\Models\\User'),
(718, 1, 'App\\Models\\User'),
(719, 1, 'App\\Models\\User'),
(720, 1, 'App\\Models\\User'),
(721, 1, 'App\\Models\\User'),
(722, 1, 'App\\Models\\User'),
(723, 1, 'App\\Models\\User'),
(724, 1, 'App\\Models\\User'),
(725, 1, 'App\\Models\\User'),
(726, 1, 'App\\Models\\User'),
(727, 1, 'App\\Models\\User'),
(728, 1, 'App\\Models\\User'),
(729, 1, 'App\\Models\\User'),
(730, 1, 'App\\Models\\User'),
(731, 1, 'App\\Models\\User'),
(732, 1, 'App\\Models\\User'),
(733, 1, 'App\\Models\\User'),
(734, 1, 'App\\Models\\User'),
(735, 1, 'App\\Models\\User'),
(736, 1, 'App\\Models\\User'),
(737, 1, 'App\\Models\\User'),
(738, 1, 'App\\Models\\User'),
(739, 1, 'App\\Models\\User'),
(740, 1, 'App\\Models\\User'),
(741, 1, 'App\\Models\\User'),
(742, 1, 'App\\Models\\User'),
(743, 1, 'App\\Models\\User'),
(744, 1, 'App\\Models\\User'),
(745, 1, 'App\\Models\\User'),
(746, 1, 'App\\Models\\User'),
(747, 1, 'App\\Models\\User'),
(748, 1, 'App\\Models\\User'),
(749, 1, 'App\\Models\\User'),
(750, 1, 'App\\Models\\User'),
(751, 1, 'App\\Models\\User'),
(752, 1, 'App\\Models\\User'),
(753, 1, 'App\\Models\\User'),
(754, 1, 'App\\Models\\User'),
(755, 1, 'App\\Models\\User'),
(756, 1, 'App\\Models\\User'),
(757, 1, 'App\\Models\\User'),
(758, 1, 'App\\Models\\User'),
(759, 1, 'App\\Models\\User'),
(760, 1, 'App\\Models\\User'),
(761, 1, 'App\\Models\\User'),
(762, 1, 'App\\Models\\User'),
(763, 1, 'App\\Models\\User'),
(764, 1, 'App\\Models\\User'),
(765, 1, 'App\\Models\\User'),
(766, 1, 'App\\Models\\User'),
(767, 1, 'App\\Models\\User'),
(768, 1, 'App\\Models\\User'),
(769, 1, 'App\\Models\\User'),
(770, 1, 'App\\Models\\User'),
(771, 1, 'App\\Models\\User'),
(772, 1, 'App\\Models\\User'),
(773, 1, 'App\\Models\\User'),
(774, 1, 'App\\Models\\User'),
(775, 1, 'App\\Models\\User'),
(776, 1, 'App\\Models\\User'),
(777, 1, 'App\\Models\\User'),
(778, 1, 'App\\Models\\User'),
(779, 1, 'App\\Models\\User'),
(780, 1, 'App\\Models\\User'),
(781, 1, 'App\\Models\\User'),
(782, 1, 'App\\Models\\User'),
(783, 1, 'App\\Models\\User'),
(784, 1, 'App\\Models\\User'),
(785, 1, 'App\\Models\\User'),
(786, 1, 'App\\Models\\User'),
(787, 1, 'App\\Models\\User'),
(788, 1, 'App\\Models\\User'),
(789, 1, 'App\\Models\\User'),
(790, 1, 'App\\Models\\User'),
(791, 1, 'App\\Models\\User'),
(792, 1, 'App\\Models\\User'),
(793, 1, 'App\\Models\\User'),
(794, 1, 'App\\Models\\User'),
(795, 1, 'App\\Models\\User'),
(796, 1, 'App\\Models\\User'),
(797, 1, 'App\\Models\\User'),
(798, 1, 'App\\Models\\User'),
(799, 1, 'App\\Models\\User'),
(800, 1, 'App\\Models\\User'),
(801, 1, 'App\\Models\\User'),
(802, 1, 'App\\Models\\User'),
(803, 1, 'App\\Models\\User'),
(804, 1, 'App\\Models\\User'),
(805, 1, 'App\\Models\\User'),
(806, 1, 'App\\Models\\User'),
(807, 1, 'App\\Models\\User'),
(808, 1, 'App\\Models\\User'),
(809, 1, 'App\\Models\\User'),
(810, 1, 'App\\Models\\User'),
(811, 1, 'App\\Models\\User'),
(812, 1, 'App\\Models\\User'),
(813, 1, 'App\\Models\\User'),
(814, 1, 'App\\Models\\User'),
(815, 1, 'App\\Models\\User'),
(816, 1, 'App\\Models\\User'),
(817, 1, 'App\\Models\\User'),
(818, 1, 'App\\Models\\User'),
(819, 1, 'App\\Models\\User'),
(820, 1, 'App\\Models\\User'),
(821, 1, 'App\\Models\\User'),
(822, 1, 'App\\Models\\User'),
(823, 1, 'App\\Models\\User'),
(824, 1, 'App\\Models\\User'),
(825, 1, 'App\\Models\\User'),
(826, 1, 'App\\Models\\User'),
(827, 1, 'App\\Models\\User'),
(828, 1, 'App\\Models\\User'),
(829, 1, 'App\\Models\\User'),
(830, 1, 'App\\Models\\User'),
(831, 1, 'App\\Models\\User'),
(832, 1, 'App\\Models\\User'),
(833, 1, 'App\\Models\\User'),
(834, 1, 'App\\Models\\User'),
(835, 1, 'App\\Models\\User'),
(836, 1, 'App\\Models\\User'),
(837, 1, 'App\\Models\\User'),
(838, 1, 'App\\Models\\User'),
(839, 1, 'App\\Models\\User'),
(840, 1, 'App\\Models\\User'),
(841, 1, 'App\\Models\\User'),
(842, 1, 'App\\Models\\User'),
(843, 1, 'App\\Models\\User'),
(844, 1, 'App\\Models\\User'),
(845, 1, 'App\\Models\\User'),
(846, 1, 'App\\Models\\User'),
(847, 1, 'App\\Models\\User'),
(848, 1, 'App\\Models\\User'),
(849, 1, 'App\\Models\\User'),
(850, 1, 'App\\Models\\User'),
(851, 1, 'App\\Models\\User'),
(852, 1, 'App\\Models\\User'),
(853, 1, 'App\\Models\\User'),
(854, 1, 'App\\Models\\User'),
(855, 1, 'App\\Models\\User'),
(856, 1, 'App\\Models\\User'),
(857, 1, 'App\\Models\\User'),
(858, 1, 'App\\Models\\User'),
(859, 1, 'App\\Models\\User'),
(860, 1, 'App\\Models\\User'),
(861, 1, 'App\\Models\\User'),
(862, 1, 'App\\Models\\User'),
(863, 1, 'App\\Models\\User'),
(864, 1, 'App\\Models\\User'),
(865, 1, 'App\\Models\\User'),
(866, 1, 'App\\Models\\User'),
(867, 1, 'App\\Models\\User'),
(868, 1, 'App\\Models\\User'),
(869, 1, 'App\\Models\\User'),
(870, 1, 'App\\Models\\User'),
(871, 1, 'App\\Models\\User'),
(872, 1, 'App\\Models\\User'),
(873, 1, 'App\\Models\\User'),
(874, 1, 'App\\Models\\User'),
(875, 1, 'App\\Models\\User'),
(876, 1, 'App\\Models\\User'),
(877, 1, 'App\\Models\\User'),
(878, 1, 'App\\Models\\User'),
(879, 1, 'App\\Models\\User'),
(880, 1, 'App\\Models\\User'),
(881, 1, 'App\\Models\\User'),
(882, 1, 'App\\Models\\User'),
(883, 1, 'App\\Models\\User'),
(884, 1, 'App\\Models\\User'),
(885, 1, 'App\\Models\\User'),
(886, 1, 'App\\Models\\User'),
(887, 1, 'App\\Models\\User'),
(888, 1, 'App\\Models\\User'),
(889, 1, 'App\\Models\\User'),
(890, 1, 'App\\Models\\User'),
(891, 1, 'App\\Models\\User'),
(892, 1, 'App\\Models\\User'),
(893, 1, 'App\\Models\\User'),
(894, 1, 'App\\Models\\User'),
(895, 1, 'App\\Models\\User'),
(896, 1, 'App\\Models\\User'),
(897, 1, 'App\\Models\\User'),
(898, 1, 'App\\Models\\User'),
(899, 1, 'App\\Models\\User'),
(900, 1, 'App\\Models\\User'),
(901, 1, 'App\\Models\\User'),
(902, 1, 'App\\Models\\User'),
(903, 1, 'App\\Models\\User'),
(904, 1, 'App\\Models\\User'),
(905, 1, 'App\\Models\\User'),
(906, 1, 'App\\Models\\User'),
(907, 1, 'App\\Models\\User'),
(908, 1, 'App\\Models\\User'),
(909, 1, 'App\\Models\\User'),
(910, 1, 'App\\Models\\User'),
(911, 1, 'App\\Models\\User'),
(912, 1, 'App\\Models\\User'),
(913, 1, 'App\\Models\\User'),
(914, 1, 'App\\Models\\User'),
(915, 1, 'App\\Models\\User'),
(916, 1, 'App\\Models\\User'),
(917, 1, 'App\\Models\\User'),
(918, 1, 'App\\Models\\User'),
(919, 1, 'App\\Models\\User'),
(920, 1, 'App\\Models\\User'),
(921, 1, 'App\\Models\\User'),
(922, 1, 'App\\Models\\User'),
(923, 1, 'App\\Models\\User'),
(924, 1, 'App\\Models\\User'),
(925, 1, 'App\\Models\\User'),
(926, 1, 'App\\Models\\User'),
(927, 1, 'App\\Models\\User'),
(928, 1, 'App\\Models\\User'),
(929, 1, 'App\\Models\\User'),
(930, 1, 'App\\Models\\User'),
(931, 1, 'App\\Models\\User'),
(932, 1, 'App\\Models\\User'),
(933, 1, 'App\\Models\\User'),
(934, 1, 'App\\Models\\User'),
(935, 1, 'App\\Models\\User'),
(936, 1, 'App\\Models\\User'),
(937, 1, 'App\\Models\\User'),
(938, 1, 'App\\Models\\User'),
(939, 1, 'App\\Models\\User'),
(940, 1, 'App\\Models\\User'),
(941, 1, 'App\\Models\\User'),
(942, 1, 'App\\Models\\User'),
(943, 1, 'App\\Models\\User'),
(944, 1, 'App\\Models\\User'),
(945, 1, 'App\\Models\\User'),
(946, 1, 'App\\Models\\User'),
(947, 1, 'App\\Models\\User'),
(948, 1, 'App\\Models\\User'),
(949, 1, 'App\\Models\\User'),
(950, 1, 'App\\Models\\User'),
(951, 1, 'App\\Models\\User'),
(952, 1, 'App\\Models\\User'),
(953, 1, 'App\\Models\\User'),
(954, 1, 'App\\Models\\User'),
(955, 1, 'App\\Models\\User'),
(956, 1, 'App\\Models\\User'),
(957, 1, 'App\\Models\\User'),
(958, 1, 'App\\Models\\User'),
(959, 1, 'App\\Models\\User'),
(960, 1, 'App\\Models\\User'),
(961, 1, 'App\\Models\\User'),
(962, 1, 'App\\Models\\User'),
(963, 1, 'App\\Models\\User'),
(964, 1, 'App\\Models\\User'),
(965, 1, 'App\\Models\\User'),
(966, 1, 'App\\Models\\User'),
(967, 1, 'App\\Models\\User'),
(968, 1, 'App\\Models\\User'),
(969, 1, 'App\\Models\\User'),
(970, 1, 'App\\Models\\User'),
(971, 1, 'App\\Models\\User'),
(972, 1, 'App\\Models\\User'),
(973, 1, 'App\\Models\\User'),
(974, 1, 'App\\Models\\User'),
(975, 1, 'App\\Models\\User'),
(976, 1, 'App\\Models\\User'),
(977, 1, 'App\\Models\\User'),
(978, 1, 'App\\Models\\User'),
(979, 1, 'App\\Models\\User'),
(980, 1, 'App\\Models\\User'),
(981, 1, 'App\\Models\\User'),
(982, 1, 'App\\Models\\User'),
(983, 1, 'App\\Models\\User'),
(984, 1, 'App\\Models\\User'),
(985, 1, 'App\\Models\\User'),
(986, 1, 'App\\Models\\User'),
(987, 1, 'App\\Models\\User'),
(988, 1, 'App\\Models\\User'),
(989, 1, 'App\\Models\\User'),
(990, 1, 'App\\Models\\User'),
(991, 1, 'App\\Models\\User'),
(992, 1, 'App\\Models\\User'),
(993, 1, 'App\\Models\\User'),
(994, 1, 'App\\Models\\User'),
(995, 1, 'App\\Models\\User'),
(996, 1, 'App\\Models\\User'),
(997, 1, 'App\\Models\\User'),
(998, 1, 'App\\Models\\User'),
(999, 1, 'App\\Models\\User'),
(1000, 1, 'App\\Models\\User'),
(1001, 1, 'App\\Models\\User'),
(1002, 1, 'App\\Models\\User'),
(1003, 1, 'App\\Models\\User'),
(1004, 1, 'App\\Models\\User'),
(1005, 1, 'App\\Models\\User'),
(1006, 1, 'App\\Models\\User'),
(1007, 1, 'App\\Models\\User'),
(1008, 1, 'App\\Models\\User'),
(1009, 1, 'App\\Models\\User'),
(1010, 1, 'App\\Models\\User'),
(1011, 1, 'App\\Models\\User'),
(1012, 1, 'App\\Models\\User'),
(1013, 1, 'App\\Models\\User'),
(1014, 1, 'App\\Models\\User'),
(1015, 1, 'App\\Models\\User'),
(1016, 1, 'App\\Models\\User'),
(1017, 1, 'App\\Models\\User'),
(1018, 1, 'App\\Models\\User'),
(1019, 1, 'App\\Models\\User'),
(1020, 1, 'App\\Models\\User'),
(1021, 1, 'App\\Models\\User'),
(1022, 1, 'App\\Models\\User'),
(1023, 1, 'App\\Models\\User'),
(1024, 1, 'App\\Models\\User'),
(1025, 1, 'App\\Models\\User'),
(1026, 1, 'App\\Models\\User'),
(1027, 1, 'App\\Models\\User'),
(1028, 1, 'App\\Models\\User'),
(1029, 1, 'App\\Models\\User'),
(1030, 1, 'App\\Models\\User'),
(1031, 1, 'App\\Models\\User'),
(1032, 1, 'App\\Models\\User'),
(1033, 1, 'App\\Models\\User'),
(1034, 1, 'App\\Models\\User'),
(1035, 1, 'App\\Models\\User'),
(1036, 1, 'App\\Models\\User'),
(1037, 1, 'App\\Models\\User'),
(1038, 1, 'App\\Models\\User'),
(1039, 1, 'App\\Models\\User'),
(1040, 1, 'App\\Models\\User'),
(1041, 1, 'App\\Models\\User'),
(1042, 1, 'App\\Models\\User'),
(1043, 1, 'App\\Models\\User'),
(1044, 1, 'App\\Models\\User'),
(1045, 1, 'App\\Models\\User'),
(1046, 1, 'App\\Models\\User'),
(1047, 1, 'App\\Models\\User'),
(1048, 1, 'App\\Models\\User'),
(1049, 1, 'App\\Models\\User'),
(1050, 1, 'App\\Models\\User'),
(1051, 1, 'App\\Models\\User'),
(1052, 1, 'App\\Models\\User'),
(1053, 1, 'App\\Models\\User'),
(1054, 1, 'App\\Models\\User'),
(1055, 1, 'App\\Models\\User'),
(1056, 1, 'App\\Models\\User'),
(1057, 1, 'App\\Models\\User'),
(1058, 1, 'App\\Models\\User'),
(1059, 1, 'App\\Models\\User'),
(1060, 1, 'App\\Models\\User'),
(1061, 1, 'App\\Models\\User'),
(1062, 1, 'App\\Models\\User'),
(1063, 1, 'App\\Models\\User'),
(1064, 1, 'App\\Models\\User'),
(1065, 1, 'App\\Models\\User'),
(1066, 1, 'App\\Models\\User'),
(1067, 1, 'App\\Models\\User'),
(1068, 1, 'App\\Models\\User'),
(1069, 1, 'App\\Models\\User'),
(1070, 1, 'App\\Models\\User'),
(1071, 1, 'App\\Models\\User'),
(1072, 1, 'App\\Models\\User'),
(1073, 1, 'App\\Models\\User'),
(1074, 1, 'App\\Models\\User'),
(1075, 1, 'App\\Models\\User'),
(1076, 1, 'App\\Models\\User'),
(1077, 1, 'App\\Models\\User'),
(1078, 1, 'App\\Models\\User'),
(1079, 1, 'App\\Models\\User'),
(1080, 1, 'App\\Models\\User'),
(1081, 1, 'App\\Models\\User'),
(1082, 1, 'App\\Models\\User'),
(1083, 1, 'App\\Models\\User'),
(1084, 1, 'App\\Models\\User'),
(1085, 1, 'App\\Models\\User'),
(1086, 1, 'App\\Models\\User'),
(1087, 1, 'App\\Models\\User'),
(1088, 1, 'App\\Models\\User'),
(1089, 1, 'App\\Models\\User'),
(1090, 1, 'App\\Models\\User'),
(1091, 1, 'App\\Models\\User'),
(1092, 1, 'App\\Models\\User'),
(1093, 1, 'App\\Models\\User'),
(1094, 1, 'App\\Models\\User'),
(1095, 1, 'App\\Models\\User'),
(1096, 1, 'App\\Models\\User'),
(1097, 1, 'App\\Models\\User'),
(1098, 1, 'App\\Models\\User'),
(1099, 1, 'App\\Models\\User'),
(1100, 1, 'App\\Models\\User'),
(1101, 1, 'App\\Models\\User'),
(1102, 1, 'App\\Models\\User'),
(1103, 1, 'App\\Models\\User'),
(1104, 1, 'App\\Models\\User'),
(1105, 1, 'App\\Models\\User'),
(1106, 1, 'App\\Models\\User'),
(1107, 1, 'App\\Models\\User'),
(1108, 1, 'App\\Models\\User'),
(1109, 1, 'App\\Models\\User'),
(1110, 1, 'App\\Models\\User'),
(1111, 1, 'App\\Models\\User'),
(1112, 1, 'App\\Models\\User'),
(1113, 1, 'App\\Models\\User'),
(1114, 1, 'App\\Models\\User'),
(1115, 1, 'App\\Models\\User'),
(1116, 1, 'App\\Models\\User'),
(1117, 1, 'App\\Models\\User'),
(1118, 1, 'App\\Models\\User'),
(1119, 1, 'App\\Models\\User'),
(1120, 1, 'App\\Models\\User'),
(1121, 1, 'App\\Models\\User'),
(1122, 1, 'App\\Models\\User'),
(1123, 1, 'App\\Models\\User'),
(1124, 1, 'App\\Models\\User'),
(1125, 1, 'App\\Models\\User'),
(1126, 1, 'App\\Models\\User'),
(1127, 1, 'App\\Models\\User'),
(1128, 1, 'App\\Models\\User'),
(1129, 1, 'App\\Models\\User'),
(1130, 1, 'App\\Models\\User'),
(1131, 1, 'App\\Models\\User'),
(1132, 1, 'App\\Models\\User'),
(1133, 1, 'App\\Models\\User'),
(1134, 1, 'App\\Models\\User'),
(1135, 1, 'App\\Models\\User'),
(1136, 1, 'App\\Models\\User'),
(1137, 1, 'App\\Models\\User'),
(1138, 1, 'App\\Models\\User'),
(1139, 1, 'App\\Models\\User'),
(1140, 1, 'App\\Models\\User'),
(1141, 1, 'App\\Models\\User'),
(1142, 1, 'App\\Models\\User'),
(1143, 1, 'App\\Models\\User'),
(1144, 1, 'App\\Models\\User'),
(1145, 1, 'App\\Models\\User'),
(1146, 1, 'App\\Models\\User'),
(1147, 1, 'App\\Models\\User'),
(1148, 1, 'App\\Models\\User'),
(1149, 1, 'App\\Models\\User'),
(1150, 1, 'App\\Models\\User'),
(1151, 1, 'App\\Models\\User'),
(1152, 1, 'App\\Models\\User'),
(1153, 1, 'App\\Models\\User'),
(1154, 1, 'App\\Models\\User'),
(1155, 1, 'App\\Models\\User'),
(1156, 1, 'App\\Models\\User'),
(1157, 1, 'App\\Models\\User'),
(1158, 1, 'App\\Models\\User'),
(1159, 1, 'App\\Models\\User'),
(1160, 1, 'App\\Models\\User'),
(1161, 1, 'App\\Models\\User'),
(1162, 1, 'App\\Models\\User'),
(1163, 1, 'App\\Models\\User'),
(1164, 1, 'App\\Models\\User'),
(1165, 1, 'App\\Models\\User'),
(1166, 1, 'App\\Models\\User'),
(1167, 1, 'App\\Models\\User'),
(1168, 1, 'App\\Models\\User'),
(1169, 1, 'App\\Models\\User'),
(1170, 1, 'App\\Models\\User'),
(1171, 1, 'App\\Models\\User'),
(1172, 1, 'App\\Models\\User'),
(1173, 1, 'App\\Models\\User'),
(1174, 1, 'App\\Models\\User'),
(1175, 1, 'App\\Models\\User'),
(1176, 1, 'App\\Models\\User'),
(1177, 1, 'App\\Models\\User'),
(1178, 1, 'App\\Models\\User'),
(1179, 1, 'App\\Models\\User'),
(1180, 1, 'App\\Models\\User'),
(1181, 1, 'App\\Models\\User'),
(1182, 1, 'App\\Models\\User'),
(1183, 1, 'App\\Models\\User'),
(1184, 1, 'App\\Models\\User'),
(1185, 1, 'App\\Models\\User'),
(1186, 1, 'App\\Models\\User'),
(1187, 1, 'App\\Models\\User'),
(1188, 1, 'App\\Models\\User'),
(1189, 1, 'App\\Models\\User'),
(1190, 1, 'App\\Models\\User'),
(1191, 1, 'App\\Models\\User'),
(1192, 1, 'App\\Models\\User'),
(1193, 1, 'App\\Models\\User'),
(1194, 1, 'App\\Models\\User'),
(1195, 1, 'App\\Models\\User'),
(1196, 1, 'App\\Models\\User'),
(1197, 1, 'App\\Models\\User'),
(1198, 1, 'App\\Models\\User'),
(1199, 1, 'App\\Models\\User'),
(1200, 1, 'App\\Models\\User'),
(1201, 1, 'App\\Models\\User'),
(1202, 1, 'App\\Models\\User'),
(1203, 1, 'App\\Models\\User'),
(1204, 1, 'App\\Models\\User'),
(1205, 1, 'App\\Models\\User'),
(1206, 1, 'App\\Models\\User'),
(1207, 1, 'App\\Models\\User'),
(1208, 1, 'App\\Models\\User'),
(1209, 1, 'App\\Models\\User'),
(1210, 1, 'App\\Models\\User'),
(1211, 1, 'App\\Models\\User'),
(1212, 1, 'App\\Models\\User'),
(1213, 1, 'App\\Models\\User'),
(1214, 1, 'App\\Models\\User'),
(1215, 1, 'App\\Models\\User'),
(1216, 1, 'App\\Models\\User'),
(1217, 1, 'App\\Models\\User'),
(1218, 1, 'App\\Models\\User'),
(1219, 1, 'App\\Models\\User'),
(1220, 1, 'App\\Models\\User'),
(1221, 1, 'App\\Models\\User'),
(1222, 1, 'App\\Models\\User'),
(1223, 1, 'App\\Models\\User'),
(1224, 1, 'App\\Models\\User'),
(1225, 1, 'App\\Models\\User'),
(1226, 1, 'App\\Models\\User'),
(1227, 1, 'App\\Models\\User'),
(1228, 1, 'App\\Models\\User'),
(1229, 1, 'App\\Models\\User'),
(1230, 1, 'App\\Models\\User'),
(1231, 1, 'App\\Models\\User'),
(1232, 1, 'App\\Models\\User'),
(1233, 1, 'App\\Models\\User'),
(1234, 1, 'App\\Models\\User'),
(1235, 1, 'App\\Models\\User'),
(1236, 1, 'App\\Models\\User'),
(1237, 1, 'App\\Models\\User'),
(1238, 1, 'App\\Models\\User'),
(1239, 1, 'App\\Models\\User'),
(1240, 1, 'App\\Models\\User'),
(1241, 1, 'App\\Models\\User'),
(1242, 1, 'App\\Models\\User'),
(1243, 1, 'App\\Models\\User'),
(1244, 1, 'App\\Models\\User'),
(1245, 1, 'App\\Models\\User'),
(1246, 1, 'App\\Models\\User'),
(1247, 1, 'App\\Models\\User'),
(1248, 1, 'App\\Models\\User'),
(1249, 1, 'App\\Models\\User'),
(1250, 1, 'App\\Models\\User'),
(1251, 1, 'App\\Models\\User'),
(1252, 1, 'App\\Models\\User'),
(1253, 1, 'App\\Models\\User'),
(1254, 1, 'App\\Models\\User'),
(1255, 1, 'App\\Models\\User'),
(1256, 1, 'App\\Models\\User'),
(1257, 1, 'App\\Models\\User'),
(1258, 1, 'App\\Models\\User'),
(1259, 1, 'App\\Models\\User'),
(1260, 1, 'App\\Models\\User'),
(1261, 1, 'App\\Models\\User'),
(1262, 1, 'App\\Models\\User'),
(1263, 1, 'App\\Models\\User'),
(1264, 1, 'App\\Models\\User'),
(1265, 1, 'App\\Models\\User'),
(1266, 1, 'App\\Models\\User'),
(1267, 1, 'App\\Models\\User'),
(1268, 1, 'App\\Models\\User'),
(1269, 1, 'App\\Models\\User'),
(1270, 1, 'App\\Models\\User'),
(1271, 1, 'App\\Models\\User'),
(1272, 1, 'App\\Models\\User'),
(1273, 1, 'App\\Models\\User'),
(1274, 1, 'App\\Models\\User'),
(1275, 1, 'App\\Models\\User'),
(1276, 1, 'App\\Models\\User'),
(1277, 1, 'App\\Models\\User'),
(1278, 1, 'App\\Models\\User'),
(1279, 1, 'App\\Models\\User'),
(1280, 1, 'App\\Models\\User'),
(1281, 1, 'App\\Models\\User'),
(1282, 1, 'App\\Models\\User'),
(1283, 1, 'App\\Models\\User'),
(1284, 1, 'App\\Models\\User'),
(1285, 1, 'App\\Models\\User'),
(1286, 1, 'App\\Models\\User'),
(1287, 1, 'App\\Models\\User'),
(1288, 1, 'App\\Models\\User'),
(1289, 1, 'App\\Models\\User'),
(1290, 1, 'App\\Models\\User'),
(1291, 1, 'App\\Models\\User'),
(1292, 1, 'App\\Models\\User'),
(1293, 1, 'App\\Models\\User'),
(1294, 1, 'App\\Models\\User'),
(1295, 1, 'App\\Models\\User'),
(1296, 1, 'App\\Models\\User'),
(1297, 1, 'App\\Models\\User'),
(1298, 1, 'App\\Models\\User'),
(1299, 1, 'App\\Models\\User'),
(1300, 1, 'App\\Models\\User'),
(1301, 1, 'App\\Models\\User'),
(1302, 1, 'App\\Models\\User'),
(1303, 1, 'App\\Models\\User'),
(1304, 1, 'App\\Models\\User'),
(1305, 1, 'App\\Models\\User'),
(1306, 1, 'App\\Models\\User'),
(1307, 1, 'App\\Models\\User'),
(1308, 1, 'App\\Models\\User'),
(1309, 1, 'App\\Models\\User'),
(1310, 1, 'App\\Models\\User'),
(1311, 1, 'App\\Models\\User'),
(1312, 1, 'App\\Models\\User'),
(1313, 1, 'App\\Models\\User'),
(1314, 1, 'App\\Models\\User'),
(1315, 1, 'App\\Models\\User'),
(1316, 1, 'App\\Models\\User'),
(1317, 1, 'App\\Models\\User'),
(1318, 1, 'App\\Models\\User'),
(1319, 1, 'App\\Models\\User'),
(1320, 1, 'App\\Models\\User'),
(1321, 1, 'App\\Models\\User'),
(1322, 1, 'App\\Models\\User'),
(1323, 1, 'App\\Models\\User'),
(1324, 1, 'App\\Models\\User'),
(1325, 1, 'App\\Models\\User'),
(1326, 1, 'App\\Models\\User'),
(1327, 1, 'App\\Models\\User'),
(1328, 1, 'App\\Models\\User'),
(1329, 1, 'App\\Models\\User'),
(1330, 1, 'App\\Models\\User'),
(1331, 1, 'App\\Models\\User'),
(1332, 1, 'App\\Models\\User'),
(1333, 1, 'App\\Models\\User'),
(1334, 1, 'App\\Models\\User'),
(1335, 1, 'App\\Models\\User'),
(1336, 1, 'App\\Models\\User'),
(1337, 1, 'App\\Models\\User'),
(1338, 1, 'App\\Models\\User'),
(1339, 1, 'App\\Models\\User'),
(1340, 1, 'App\\Models\\User'),
(1341, 1, 'App\\Models\\User'),
(1342, 1, 'App\\Models\\User'),
(1343, 1, 'App\\Models\\User'),
(1344, 1, 'App\\Models\\User'),
(1345, 1, 'App\\Models\\User'),
(1346, 1, 'App\\Models\\User'),
(1347, 1, 'App\\Models\\User'),
(1348, 1, 'App\\Models\\User'),
(1349, 1, 'App\\Models\\User'),
(1350, 1, 'App\\Models\\User'),
(1351, 1, 'App\\Models\\User'),
(1352, 1, 'App\\Models\\User'),
(1353, 1, 'App\\Models\\User'),
(1354, 1, 'App\\Models\\User'),
(1355, 1, 'App\\Models\\User'),
(1356, 1, 'App\\Models\\User'),
(1357, 1, 'App\\Models\\User'),
(1358, 1, 'App\\Models\\User'),
(1359, 1, 'App\\Models\\User'),
(1360, 1, 'App\\Models\\User'),
(1361, 1, 'App\\Models\\User'),
(1362, 1, 'App\\Models\\User'),
(1363, 1, 'App\\Models\\User'),
(1364, 1, 'App\\Models\\User'),
(1365, 1, 'App\\Models\\User'),
(1366, 1, 'App\\Models\\User'),
(1367, 1, 'App\\Models\\User'),
(1368, 1, 'App\\Models\\User'),
(1369, 1, 'App\\Models\\User'),
(1370, 1, 'App\\Models\\User'),
(1371, 1, 'App\\Models\\User'),
(1372, 1, 'App\\Models\\User'),
(1373, 1, 'App\\Models\\User'),
(1374, 1, 'App\\Models\\User'),
(1375, 1, 'App\\Models\\User'),
(1376, 1, 'App\\Models\\User'),
(1377, 1, 'App\\Models\\User'),
(1378, 1, 'App\\Models\\User'),
(1379, 1, 'App\\Models\\User'),
(1380, 1, 'App\\Models\\User'),
(1381, 1, 'App\\Models\\User'),
(1382, 1, 'App\\Models\\User'),
(1383, 1, 'App\\Models\\User'),
(1384, 1, 'App\\Models\\User'),
(1385, 1, 'App\\Models\\User'),
(1386, 1, 'App\\Models\\User'),
(1387, 1, 'App\\Models\\User'),
(1388, 1, 'App\\Models\\User'),
(1389, 1, 'App\\Models\\User'),
(1390, 1, 'App\\Models\\User'),
(1391, 1, 'App\\Models\\User'),
(1392, 1, 'App\\Models\\User'),
(1393, 1, 'App\\Models\\User'),
(1394, 1, 'App\\Models\\User'),
(1395, 1, 'App\\Models\\User'),
(1396, 1, 'App\\Models\\User'),
(1397, 1, 'App\\Models\\User'),
(1398, 1, 'App\\Models\\User'),
(1399, 1, 'App\\Models\\User'),
(1400, 1, 'App\\Models\\User'),
(1401, 1, 'App\\Models\\User'),
(1402, 1, 'App\\Models\\User'),
(1403, 1, 'App\\Models\\User'),
(1404, 1, 'App\\Models\\User'),
(1405, 1, 'App\\Models\\User'),
(1406, 1, 'App\\Models\\User'),
(1407, 1, 'App\\Models\\User'),
(1408, 1, 'App\\Models\\User'),
(1409, 1, 'App\\Models\\User'),
(1410, 1, 'App\\Models\\User'),
(1411, 1, 'App\\Models\\User'),
(1412, 1, 'App\\Models\\User'),
(1413, 1, 'App\\Models\\User'),
(1414, 1, 'App\\Models\\User'),
(1415, 1, 'App\\Models\\User'),
(1416, 1, 'App\\Models\\User'),
(1417, 1, 'App\\Models\\User'),
(1418, 1, 'App\\Models\\User'),
(1419, 1, 'App\\Models\\User'),
(1420, 1, 'App\\Models\\User'),
(1421, 1, 'App\\Models\\User'),
(1422, 1, 'App\\Models\\User'),
(1423, 1, 'App\\Models\\User'),
(1424, 1, 'App\\Models\\User'),
(1425, 1, 'App\\Models\\User'),
(1426, 1, 'App\\Models\\User'),
(1427, 1, 'App\\Models\\User'),
(1428, 1, 'App\\Models\\User'),
(1429, 1, 'App\\Models\\User'),
(1430, 1, 'App\\Models\\User'),
(1431, 1, 'App\\Models\\User'),
(1432, 1, 'App\\Models\\User'),
(1433, 1, 'App\\Models\\User'),
(1434, 1, 'App\\Models\\User'),
(1435, 1, 'App\\Models\\User'),
(1436, 1, 'App\\Models\\User'),
(1437, 1, 'App\\Models\\User'),
(1438, 1, 'App\\Models\\User'),
(1439, 1, 'App\\Models\\User'),
(1440, 1, 'App\\Models\\User'),
(1441, 1, 'App\\Models\\User'),
(1442, 1, 'App\\Models\\User'),
(1443, 1, 'App\\Models\\User'),
(1444, 1, 'App\\Models\\User'),
(1445, 1, 'App\\Models\\User'),
(1446, 1, 'App\\Models\\User'),
(1447, 1, 'App\\Models\\User'),
(1448, 1, 'App\\Models\\User'),
(1449, 1, 'App\\Models\\User'),
(1450, 1, 'App\\Models\\User'),
(1451, 1, 'App\\Models\\User'),
(1452, 1, 'App\\Models\\User'),
(1453, 1, 'App\\Models\\User'),
(1454, 1, 'App\\Models\\User'),
(1455, 1, 'App\\Models\\User'),
(1456, 1, 'App\\Models\\User'),
(1457, 1, 'App\\Models\\User'),
(1458, 1, 'App\\Models\\User'),
(1459, 1, 'App\\Models\\User'),
(1460, 1, 'App\\Models\\User'),
(1461, 1, 'App\\Models\\User'),
(1462, 1, 'App\\Models\\User'),
(1463, 1, 'App\\Models\\User'),
(1464, 1, 'App\\Models\\User'),
(1465, 1, 'App\\Models\\User'),
(1466, 1, 'App\\Models\\User'),
(1467, 1, 'App\\Models\\User'),
(1468, 1, 'App\\Models\\User'),
(1469, 1, 'App\\Models\\User'),
(1470, 1, 'App\\Models\\User'),
(1471, 1, 'App\\Models\\User'),
(1472, 1, 'App\\Models\\User'),
(1473, 1, 'App\\Models\\User'),
(1474, 1, 'App\\Models\\User'),
(1475, 1, 'App\\Models\\User'),
(1476, 1, 'App\\Models\\User'),
(1477, 1, 'App\\Models\\User'),
(1478, 1, 'App\\Models\\User'),
(1479, 1, 'App\\Models\\User'),
(1480, 1, 'App\\Models\\User'),
(1481, 1, 'App\\Models\\User'),
(1482, 1, 'App\\Models\\User'),
(1483, 1, 'App\\Models\\User'),
(1484, 1, 'App\\Models\\User'),
(1485, 1, 'App\\Models\\User'),
(1486, 1, 'App\\Models\\User'),
(1487, 1, 'App\\Models\\User'),
(1488, 1, 'App\\Models\\User'),
(1489, 1, 'App\\Models\\User'),
(1490, 1, 'App\\Models\\User'),
(1491, 1, 'App\\Models\\User'),
(1492, 1, 'App\\Models\\User'),
(1493, 1, 'App\\Models\\User'),
(1494, 1, 'App\\Models\\User'),
(1495, 1, 'App\\Models\\User'),
(1496, 1, 'App\\Models\\User'),
(1497, 1, 'App\\Models\\User'),
(1498, 1, 'App\\Models\\User'),
(1499, 1, 'App\\Models\\User'),
(1500, 1, 'App\\Models\\User'),
(1501, 1, 'App\\Models\\User'),
(1502, 1, 'App\\Models\\User'),
(1503, 1, 'App\\Models\\User'),
(1504, 1, 'App\\Models\\User'),
(1505, 1, 'App\\Models\\User'),
(1506, 1, 'App\\Models\\User'),
(1507, 1, 'App\\Models\\User'),
(1508, 1, 'App\\Models\\User'),
(1509, 1, 'App\\Models\\User'),
(1510, 1, 'App\\Models\\User'),
(1511, 1, 'App\\Models\\User'),
(1512, 1, 'App\\Models\\User'),
(1513, 1, 'App\\Models\\User'),
(1514, 1, 'App\\Models\\User'),
(1515, 1, 'App\\Models\\User'),
(1516, 1, 'App\\Models\\User'),
(1517, 1, 'App\\Models\\User'),
(1518, 1, 'App\\Models\\User'),
(1519, 1, 'App\\Models\\User'),
(1520, 1, 'App\\Models\\User'),
(1521, 1, 'App\\Models\\User'),
(1522, 1, 'App\\Models\\User'),
(1523, 1, 'App\\Models\\User'),
(1524, 1, 'App\\Models\\User'),
(1525, 1, 'App\\Models\\User'),
(1526, 1, 'App\\Models\\User'),
(1527, 1, 'App\\Models\\User'),
(1528, 1, 'App\\Models\\User'),
(1529, 1, 'App\\Models\\User'),
(1530, 1, 'App\\Models\\User'),
(1531, 1, 'App\\Models\\User'),
(1532, 1, 'App\\Models\\User'),
(1533, 1, 'App\\Models\\User'),
(1534, 1, 'App\\Models\\User'),
(1535, 1, 'App\\Models\\User'),
(1536, 1, 'App\\Models\\User'),
(1537, 1, 'App\\Models\\User'),
(1538, 1, 'App\\Models\\User'),
(1539, 1, 'App\\Models\\User'),
(1540, 1, 'App\\Models\\User'),
(1541, 1, 'App\\Models\\User'),
(1542, 1, 'App\\Models\\User'),
(1543, 1, 'App\\Models\\User'),
(1544, 1, 'App\\Models\\User'),
(1545, 1, 'App\\Models\\User'),
(1546, 1, 'App\\Models\\User'),
(1547, 1, 'App\\Models\\User'),
(1548, 1, 'App\\Models\\User'),
(1549, 1, 'App\\Models\\User'),
(1550, 1, 'App\\Models\\User'),
(1551, 1, 'App\\Models\\User'),
(1552, 1, 'App\\Models\\User'),
(1553, 1, 'App\\Models\\User'),
(1554, 1, 'App\\Models\\User'),
(1555, 1, 'App\\Models\\User'),
(1556, 1, 'App\\Models\\User'),
(1557, 1, 'App\\Models\\User'),
(1558, 1, 'App\\Models\\User'),
(1559, 1, 'App\\Models\\User'),
(1560, 1, 'App\\Models\\User'),
(1561, 1, 'App\\Models\\User'),
(1562, 1, 'App\\Models\\User'),
(1563, 1, 'App\\Models\\User'),
(1564, 1, 'App\\Models\\User'),
(1565, 1, 'App\\Models\\User'),
(1566, 1, 'App\\Models\\User'),
(1567, 1, 'App\\Models\\User'),
(1568, 1, 'App\\Models\\User'),
(1569, 1, 'App\\Models\\User'),
(1570, 1, 'App\\Models\\User'),
(1571, 1, 'App\\Models\\User'),
(1572, 1, 'App\\Models\\User'),
(1573, 1, 'App\\Models\\User'),
(1574, 1, 'App\\Models\\User'),
(1575, 1, 'App\\Models\\User'),
(1576, 1, 'App\\Models\\User'),
(1577, 1, 'App\\Models\\User'),
(1578, 1, 'App\\Models\\User'),
(1579, 1, 'App\\Models\\User'),
(1580, 1, 'App\\Models\\User'),
(1581, 1, 'App\\Models\\User'),
(1582, 1, 'App\\Models\\User'),
(1583, 1, 'App\\Models\\User'),
(1584, 1, 'App\\Models\\User'),
(1585, 1, 'App\\Models\\User'),
(1586, 1, 'App\\Models\\User'),
(1587, 1, 'App\\Models\\User'),
(1588, 1, 'App\\Models\\User'),
(1589, 1, 'App\\Models\\User'),
(1590, 1, 'App\\Models\\User'),
(1591, 1, 'App\\Models\\User'),
(1592, 1, 'App\\Models\\User'),
(1593, 1, 'App\\Models\\User'),
(1594, 1, 'App\\Models\\User'),
(1595, 1, 'App\\Models\\User'),
(1596, 1, 'App\\Models\\User'),
(1597, 1, 'App\\Models\\User'),
(1598, 1, 'App\\Models\\User'),
(1599, 1, 'App\\Models\\User'),
(1600, 1, 'App\\Models\\User'),
(1601, 1, 'App\\Models\\User'),
(1602, 1, 'App\\Models\\User'),
(1603, 1, 'App\\Models\\User'),
(1604, 1, 'App\\Models\\User'),
(1605, 1, 'App\\Models\\User'),
(1606, 1, 'App\\Models\\User'),
(1607, 1, 'App\\Models\\User'),
(1608, 1, 'App\\Models\\User'),
(1609, 1, 'App\\Models\\User'),
(1610, 1, 'App\\Models\\User'),
(1611, 1, 'App\\Models\\User'),
(1612, 1, 'App\\Models\\User'),
(1613, 1, 'App\\Models\\User'),
(1614, 1, 'App\\Models\\User'),
(1615, 1, 'App\\Models\\User'),
(1616, 1, 'App\\Models\\User'),
(1617, 1, 'App\\Models\\User'),
(1618, 1, 'App\\Models\\User'),
(1619, 1, 'App\\Models\\User'),
(1620, 1, 'App\\Models\\User'),
(1621, 1, 'App\\Models\\User'),
(1622, 1, 'App\\Models\\User'),
(1623, 1, 'App\\Models\\User'),
(1624, 1, 'App\\Models\\User'),
(1625, 1, 'App\\Models\\User'),
(1626, 1, 'App\\Models\\User'),
(1627, 1, 'App\\Models\\User'),
(1628, 1, 'App\\Models\\User'),
(1629, 1, 'App\\Models\\User'),
(1630, 1, 'App\\Models\\User'),
(1631, 1, 'App\\Models\\User'),
(1632, 1, 'App\\Models\\User'),
(1633, 1, 'App\\Models\\User'),
(1634, 1, 'App\\Models\\User'),
(1635, 1, 'App\\Models\\User'),
(1636, 1, 'App\\Models\\User'),
(1637, 1, 'App\\Models\\User'),
(1638, 1, 'App\\Models\\User'),
(1639, 1, 'App\\Models\\User'),
(1640, 1, 'App\\Models\\User'),
(1641, 1, 'App\\Models\\User'),
(1642, 1, 'App\\Models\\User'),
(1643, 1, 'App\\Models\\User'),
(1644, 1, 'App\\Models\\User'),
(1645, 1, 'App\\Models\\User'),
(1646, 1, 'App\\Models\\User'),
(1647, 1, 'App\\Models\\User'),
(1648, 1, 'App\\Models\\User'),
(1649, 1, 'App\\Models\\User'),
(1650, 1, 'App\\Models\\User'),
(1651, 1, 'App\\Models\\User'),
(1652, 1, 'App\\Models\\User'),
(1653, 1, 'App\\Models\\User'),
(1654, 1, 'App\\Models\\User'),
(1655, 1, 'App\\Models\\User'),
(1656, 1, 'App\\Models\\User'),
(1657, 1, 'App\\Models\\User'),
(1658, 1, 'App\\Models\\User'),
(1659, 1, 'App\\Models\\User'),
(1660, 1, 'App\\Models\\User'),
(1661, 1, 'App\\Models\\User'),
(1662, 1, 'App\\Models\\User'),
(1663, 1, 'App\\Models\\User'),
(1664, 1, 'App\\Models\\User'),
(1665, 1, 'App\\Models\\User'),
(1666, 1, 'App\\Models\\User'),
(1667, 1, 'App\\Models\\User'),
(1668, 1, 'App\\Models\\User'),
(1669, 1, 'App\\Models\\User'),
(1670, 1, 'App\\Models\\User'),
(1671, 1, 'App\\Models\\User'),
(1672, 1, 'App\\Models\\User'),
(1673, 1, 'App\\Models\\User'),
(1674, 1, 'App\\Models\\User'),
(1675, 1, 'App\\Models\\User'),
(1676, 1, 'App\\Models\\User'),
(1677, 1, 'App\\Models\\User'),
(1678, 1, 'App\\Models\\User'),
(1679, 1, 'App\\Models\\User'),
(1680, 1, 'App\\Models\\User'),
(1681, 1, 'App\\Models\\User'),
(1682, 1, 'App\\Models\\User'),
(1683, 1, 'App\\Models\\User'),
(1684, 1, 'App\\Models\\User'),
(1685, 1, 'App\\Models\\User'),
(1686, 1, 'App\\Models\\User'),
(1687, 1, 'App\\Models\\User'),
(1688, 1, 'App\\Models\\User'),
(1689, 1, 'App\\Models\\User'),
(1690, 1, 'App\\Models\\User'),
(1691, 1, 'App\\Models\\User'),
(1692, 1, 'App\\Models\\User'),
(1693, 1, 'App\\Models\\User'),
(1694, 1, 'App\\Models\\User'),
(1695, 1, 'App\\Models\\User'),
(1696, 1, 'App\\Models\\User'),
(1697, 1, 'App\\Models\\User'),
(1698, 1, 'App\\Models\\User'),
(1699, 1, 'App\\Models\\User'),
(1700, 1, 'App\\Models\\User'),
(1701, 1, 'App\\Models\\User'),
(1702, 1, 'App\\Models\\User'),
(1703, 1, 'App\\Models\\User'),
(1704, 1, 'App\\Models\\User'),
(1705, 1, 'App\\Models\\User'),
(1706, 1, 'App\\Models\\User'),
(1707, 1, 'App\\Models\\User'),
(1708, 1, 'App\\Models\\User'),
(1709, 1, 'App\\Models\\User'),
(1710, 1, 'App\\Models\\User'),
(1711, 1, 'App\\Models\\User'),
(1712, 1, 'App\\Models\\User'),
(1713, 1, 'App\\Models\\User'),
(1714, 1, 'App\\Models\\User'),
(1715, 1, 'App\\Models\\User'),
(1716, 1, 'App\\Models\\User'),
(1717, 1, 'App\\Models\\User'),
(1718, 1, 'App\\Models\\User'),
(1719, 1, 'App\\Models\\User'),
(1720, 1, 'App\\Models\\User'),
(1721, 1, 'App\\Models\\User'),
(1722, 1, 'App\\Models\\User'),
(1723, 1, 'App\\Models\\User'),
(1724, 1, 'App\\Models\\User'),
(1725, 1, 'App\\Models\\User'),
(1726, 1, 'App\\Models\\User'),
(1727, 1, 'App\\Models\\User'),
(1728, 1, 'App\\Models\\User'),
(1729, 1, 'App\\Models\\User'),
(1730, 1, 'App\\Models\\User'),
(1731, 1, 'App\\Models\\User'),
(1732, 1, 'App\\Models\\User'),
(1733, 1, 'App\\Models\\User'),
(1734, 1, 'App\\Models\\User'),
(1735, 1, 'App\\Models\\User'),
(1736, 1, 'App\\Models\\User'),
(1737, 1, 'App\\Models\\User'),
(1738, 1, 'App\\Models\\User'),
(1739, 1, 'App\\Models\\User'),
(1740, 1, 'App\\Models\\User'),
(1741, 1, 'App\\Models\\User'),
(1742, 1, 'App\\Models\\User'),
(1743, 1, 'App\\Models\\User'),
(1744, 1, 'App\\Models\\User'),
(1745, 1, 'App\\Models\\User'),
(1746, 1, 'App\\Models\\User'),
(1747, 1, 'App\\Models\\User'),
(1748, 1, 'App\\Models\\User'),
(1749, 1, 'App\\Models\\User'),
(1750, 1, 'App\\Models\\User'),
(1751, 1, 'App\\Models\\User'),
(1752, 1, 'App\\Models\\User'),
(1753, 1, 'App\\Models\\User'),
(1754, 1, 'App\\Models\\User'),
(1755, 1, 'App\\Models\\User'),
(1756, 1, 'App\\Models\\User'),
(1757, 1, 'App\\Models\\User'),
(1758, 1, 'App\\Models\\User'),
(1759, 1, 'App\\Models\\User'),
(1760, 1, 'App\\Models\\User'),
(1761, 1, 'App\\Models\\User'),
(1762, 1, 'App\\Models\\User'),
(1763, 1, 'App\\Models\\User'),
(1764, 1, 'App\\Models\\User'),
(1765, 1, 'App\\Models\\User'),
(1766, 1, 'App\\Models\\User'),
(1767, 1, 'App\\Models\\User'),
(1768, 1, 'App\\Models\\User'),
(1769, 1, 'App\\Models\\User'),
(1770, 1, 'App\\Models\\User'),
(1771, 1, 'App\\Models\\User'),
(1772, 1, 'App\\Models\\User'),
(1773, 1, 'App\\Models\\User'),
(1774, 1, 'App\\Models\\User'),
(1775, 1, 'App\\Models\\User'),
(1776, 1, 'App\\Models\\User'),
(1777, 1, 'App\\Models\\User'),
(1778, 1, 'App\\Models\\User'),
(1779, 1, 'App\\Models\\User'),
(1780, 1, 'App\\Models\\User'),
(1781, 1, 'App\\Models\\User'),
(1782, 1, 'App\\Models\\User'),
(1783, 1, 'App\\Models\\User'),
(1784, 1, 'App\\Models\\User');
INSERT INTO `user_companies` (`user_id`, `company_id`, `user_type`) VALUES
(1785, 1, 'App\\Models\\User'),
(1786, 1, 'App\\Models\\User'),
(1787, 1, 'App\\Models\\User'),
(1788, 1, 'App\\Models\\User'),
(1789, 1, 'App\\Models\\User'),
(1790, 1, 'App\\Models\\User'),
(1791, 1, 'App\\Models\\User'),
(1792, 1, 'App\\Models\\User'),
(1793, 1, 'App\\Models\\User'),
(1794, 1, 'App\\Models\\User'),
(1795, 1, 'App\\Models\\User'),
(1796, 1, 'App\\Models\\User'),
(1797, 1, 'App\\Models\\User'),
(1798, 1, 'App\\Models\\User'),
(1799, 1, 'App\\Models\\User'),
(1800, 1, 'App\\Models\\User'),
(1801, 1, 'App\\Models\\User'),
(1802, 1, 'App\\Models\\User'),
(1803, 1, 'App\\Models\\User'),
(1804, 1, 'App\\Models\\User'),
(1805, 1, 'App\\Models\\User'),
(1806, 1, 'App\\Models\\User'),
(1807, 1, 'App\\Models\\User'),
(1808, 1, 'App\\Models\\User'),
(1809, 1, 'App\\Models\\User'),
(1810, 1, 'App\\Models\\User'),
(1811, 1, 'App\\Models\\User'),
(1812, 1, 'App\\Models\\User'),
(1813, 1, 'App\\Models\\User'),
(1814, 1, 'App\\Models\\User'),
(1815, 1, 'App\\Models\\User'),
(1816, 1, 'App\\Models\\User'),
(1817, 1, 'App\\Models\\User'),
(1818, 1, 'App\\Models\\User'),
(1819, 1, 'App\\Models\\User'),
(1820, 1, 'App\\Models\\User'),
(1821, 1, 'App\\Models\\User'),
(1822, 1, 'App\\Models\\User'),
(1823, 1, 'App\\Models\\User'),
(1824, 1, 'App\\Models\\User'),
(1825, 1, 'App\\Models\\User'),
(1826, 1, 'App\\Models\\User'),
(1827, 1, 'App\\Models\\User'),
(1828, 1, 'App\\Models\\User'),
(1829, 1, 'App\\Models\\User'),
(1830, 1, 'App\\Models\\User'),
(1831, 1, 'App\\Models\\User'),
(1832, 1, 'App\\Models\\User'),
(1833, 1, 'App\\Models\\User'),
(1834, 1, 'App\\Models\\User'),
(1835, 1, 'App\\Models\\User'),
(1836, 1, 'App\\Models\\User'),
(1837, 1, 'App\\Models\\User'),
(1838, 1, 'App\\Models\\User'),
(1839, 1, 'App\\Models\\User'),
(1840, 1, 'App\\Models\\User'),
(1841, 1, 'App\\Models\\User'),
(1842, 1, 'App\\Models\\User'),
(1843, 1, 'App\\Models\\User'),
(1844, 1, 'App\\Models\\User'),
(1845, 1, 'App\\Models\\User'),
(1846, 1, 'App\\Models\\User'),
(1847, 1, 'App\\Models\\User'),
(1848, 1, 'App\\Models\\User'),
(1849, 1, 'App\\Models\\User'),
(1850, 1, 'App\\Models\\User'),
(1851, 1, 'App\\Models\\User'),
(1852, 1, 'App\\Models\\User'),
(1853, 1, 'App\\Models\\User'),
(1854, 1, 'App\\Models\\User'),
(1855, 1, 'App\\Models\\User'),
(1856, 1, 'App\\Models\\User'),
(1857, 1, 'App\\Models\\User'),
(1858, 1, 'App\\Models\\User'),
(1859, 1, 'App\\Models\\User'),
(1860, 1, 'App\\Models\\User'),
(1861, 1, 'App\\Models\\User'),
(1862, 1, 'App\\Models\\User'),
(1863, 1, 'App\\Models\\User'),
(1864, 1, 'App\\Models\\User'),
(1865, 1, 'App\\Models\\User'),
(1866, 1, 'App\\Models\\User'),
(1867, 1, 'App\\Models\\User'),
(1868, 1, 'App\\Models\\User'),
(1869, 1, 'App\\Models\\User'),
(1870, 1, 'App\\Models\\User'),
(1871, 1, 'App\\Models\\User'),
(1872, 1, 'App\\Models\\User'),
(1873, 1, 'App\\Models\\User'),
(1874, 1, 'App\\Models\\User'),
(1875, 1, 'App\\Models\\User'),
(1876, 1, 'App\\Models\\User'),
(1877, 1, 'App\\Models\\User'),
(1878, 1, 'App\\Models\\User'),
(1879, 1, 'App\\Models\\User'),
(1880, 1, 'App\\Models\\User'),
(1881, 1, 'App\\Models\\User'),
(1882, 1, 'App\\Models\\User'),
(1883, 1, 'App\\Models\\User'),
(1884, 1, 'App\\Models\\User'),
(1885, 1, 'App\\Models\\User'),
(1886, 1, 'App\\Models\\User'),
(1887, 1, 'App\\Models\\User'),
(1888, 1, 'App\\Models\\User'),
(1889, 1, 'App\\Models\\User'),
(1890, 1, 'App\\Models\\User'),
(1891, 1, 'App\\Models\\User'),
(1892, 1, 'App\\Models\\User'),
(1893, 1, 'App\\Models\\User'),
(1894, 1, 'App\\Models\\User'),
(1895, 1, 'App\\Models\\User'),
(1896, 1, 'App\\Models\\User'),
(1897, 1, 'App\\Models\\User'),
(1898, 1, 'App\\Models\\User'),
(1899, 1, 'App\\Models\\User'),
(1900, 1, 'App\\Models\\User'),
(1901, 1, 'App\\Models\\User'),
(1902, 1, 'App\\Models\\User'),
(1903, 1, 'App\\Models\\User'),
(1904, 1, 'App\\Models\\User'),
(1905, 1, 'App\\Models\\User'),
(1906, 1, 'App\\Models\\User'),
(1907, 1, 'App\\Models\\User'),
(1908, 1, 'App\\Models\\User'),
(1909, 1, 'App\\Models\\User'),
(1910, 1, 'App\\Models\\User'),
(1911, 1, 'App\\Models\\User'),
(1912, 1, 'App\\Models\\User'),
(1913, 1, 'App\\Models\\User'),
(1914, 1, 'App\\Models\\User'),
(1915, 1, 'App\\Models\\User'),
(1916, 1, 'App\\Models\\User'),
(1917, 1, 'App\\Models\\User'),
(1918, 1, 'App\\Models\\User'),
(1919, 1, 'App\\Models\\User'),
(1920, 1, 'App\\Models\\User'),
(1921, 1, 'App\\Models\\User'),
(1922, 1, 'App\\Models\\User'),
(1923, 1, 'App\\Models\\User'),
(1924, 1, 'App\\Models\\User'),
(1925, 1, 'App\\Models\\User'),
(1926, 1, 'App\\Models\\User'),
(1927, 1, 'App\\Models\\User'),
(1928, 1, 'App\\Models\\User'),
(1929, 1, 'App\\Models\\User'),
(1930, 1, 'App\\Models\\User'),
(1931, 1, 'App\\Models\\User'),
(1932, 1, 'App\\Models\\User'),
(1933, 1, 'App\\Models\\User'),
(1934, 1, 'App\\Models\\User'),
(1935, 1, 'App\\Models\\User'),
(1936, 1, 'App\\Models\\User'),
(1937, 1, 'App\\Models\\User'),
(1938, 1, 'App\\Models\\User'),
(1939, 1, 'App\\Models\\User'),
(1940, 1, 'App\\Models\\User'),
(1941, 1, 'App\\Models\\User'),
(1942, 1, 'App\\Models\\User'),
(1943, 1, 'App\\Models\\User'),
(1944, 1, 'App\\Models\\User'),
(1945, 1, 'App\\Models\\User'),
(1946, 1, 'App\\Models\\User'),
(1947, 1, 'App\\Models\\User'),
(1948, 1, 'App\\Models\\User'),
(1949, 1, 'App\\Models\\User'),
(1950, 1, 'App\\Models\\User'),
(1951, 1, 'App\\Models\\User'),
(1952, 1, 'App\\Models\\User'),
(1953, 1, 'App\\Models\\User'),
(1954, 1, 'App\\Models\\User'),
(1955, 1, 'App\\Models\\User'),
(1956, 1, 'App\\Models\\User'),
(1957, 1, 'App\\Models\\User'),
(1958, 1, 'App\\Models\\User'),
(1959, 1, 'App\\Models\\User'),
(1960, 1, 'App\\Models\\User'),
(1961, 1, 'App\\Models\\User'),
(1962, 1, 'App\\Models\\User'),
(1963, 1, 'App\\Models\\User'),
(1964, 1, 'App\\Models\\User'),
(1965, 1, 'App\\Models\\User'),
(1966, 1, 'App\\Models\\User'),
(1967, 1, 'App\\Models\\User'),
(1968, 1, 'App\\Models\\User'),
(1969, 1, 'App\\Models\\User'),
(1970, 1, 'App\\Models\\User'),
(1971, 1, 'App\\Models\\User'),
(1972, 1, 'App\\Models\\User'),
(1973, 1, 'App\\Models\\User'),
(1974, 1, 'App\\Models\\User'),
(1975, 1, 'App\\Models\\User'),
(1976, 1, 'App\\Models\\User'),
(1977, 1, 'App\\Models\\User'),
(1978, 1, 'App\\Models\\User'),
(1979, 1, 'App\\Models\\User'),
(1980, 1, 'App\\Models\\User'),
(1981, 1, 'App\\Models\\User'),
(1982, 1, 'App\\Models\\User'),
(1983, 1, 'App\\Models\\User'),
(1984, 1, 'App\\Models\\User'),
(1985, 1, 'App\\Models\\User'),
(1986, 1, 'App\\Models\\User'),
(1987, 1, 'App\\Models\\User'),
(1988, 1, 'App\\Models\\User'),
(1989, 1, 'App\\Models\\User'),
(1990, 1, 'App\\Models\\User'),
(1991, 1, 'App\\Models\\User'),
(1992, 1, 'App\\Models\\User'),
(1993, 1, 'App\\Models\\User'),
(1994, 1, 'App\\Models\\User'),
(1995, 1, 'App\\Models\\User'),
(1996, 1, 'App\\Models\\User'),
(1997, 1, 'App\\Models\\User'),
(1998, 1, 'App\\Models\\User'),
(1999, 1, 'App\\Models\\User'),
(2000, 1, 'App\\Models\\User'),
(2001, 1, 'App\\Models\\User'),
(2002, 1, 'App\\Models\\User'),
(2003, 1, 'App\\Models\\User'),
(2004, 1, 'App\\Models\\User'),
(2005, 1, 'App\\Models\\User'),
(2006, 1, 'App\\Models\\User'),
(2007, 1, 'App\\Models\\User'),
(2008, 1, 'App\\Models\\User'),
(2009, 1, 'App\\Models\\User'),
(2010, 1, 'App\\Models\\User'),
(2011, 1, 'App\\Models\\User'),
(2012, 1, 'App\\Models\\User'),
(2013, 1, 'App\\Models\\User'),
(2014, 1, 'App\\Models\\User'),
(2015, 1, 'App\\Models\\User'),
(2016, 1, 'App\\Models\\User'),
(2017, 1, 'App\\Models\\User'),
(2018, 1, 'App\\Models\\User'),
(2019, 1, 'App\\Models\\User'),
(2020, 1, 'App\\Models\\User'),
(2021, 1, 'App\\Models\\User'),
(2022, 1, 'App\\Models\\User'),
(2023, 1, 'App\\Models\\User'),
(2024, 1, 'App\\Models\\User'),
(2025, 1, 'App\\Models\\User'),
(2026, 1, 'App\\Models\\User'),
(2027, 1, 'App\\Models\\User'),
(2028, 1, 'App\\Models\\User'),
(2029, 1, 'App\\Models\\User'),
(2030, 1, 'App\\Models\\User'),
(2031, 1, 'App\\Models\\User'),
(2032, 1, 'App\\Models\\User'),
(2033, 1, 'App\\Models\\User'),
(2034, 1, 'App\\Models\\User'),
(2035, 1, 'App\\Models\\User'),
(2036, 1, 'App\\Models\\User'),
(2037, 1, 'App\\Models\\User'),
(2038, 1, 'App\\Models\\User'),
(2039, 1, 'App\\Models\\User'),
(2040, 1, 'App\\Models\\User'),
(2041, 1, 'App\\Models\\User'),
(2042, 1, 'App\\Models\\User'),
(2043, 1, 'App\\Models\\User'),
(2044, 1, 'App\\Models\\User'),
(2045, 1, 'App\\Models\\User'),
(2046, 1, 'App\\Models\\User'),
(2047, 1, 'App\\Models\\User'),
(2048, 1, 'App\\Models\\User'),
(2049, 1, 'App\\Models\\User'),
(2050, 1, 'App\\Models\\User'),
(2051, 1, 'App\\Models\\User'),
(2052, 1, 'App\\Models\\User'),
(2053, 1, 'App\\Models\\User'),
(2054, 1, 'App\\Models\\User'),
(2055, 1, 'App\\Models\\User'),
(2056, 1, 'App\\Models\\User'),
(2057, 1, 'App\\Models\\User'),
(2058, 1, 'App\\Models\\User'),
(2059, 1, 'App\\Models\\User'),
(2060, 1, 'App\\Models\\User'),
(2061, 1, 'App\\Models\\User'),
(2062, 1, 'App\\Models\\User'),
(2063, 1, 'App\\Models\\User'),
(2064, 1, 'App\\Models\\User'),
(2065, 1, 'App\\Models\\User'),
(2066, 1, 'App\\Models\\User'),
(2067, 1, 'App\\Models\\User'),
(2068, 1, 'App\\Models\\User'),
(2069, 1, 'App\\Models\\User'),
(2070, 1, 'App\\Models\\User'),
(2071, 1, 'App\\Models\\User'),
(2072, 1, 'App\\Models\\User'),
(2073, 1, 'App\\Models\\User'),
(2074, 1, 'App\\Models\\User'),
(2075, 1, 'App\\Models\\User'),
(2076, 1, 'App\\Models\\User'),
(2077, 1, 'App\\Models\\User'),
(2078, 1, 'App\\Models\\User'),
(2079, 1, 'App\\Models\\User'),
(2080, 1, 'App\\Models\\User'),
(2081, 1, 'App\\Models\\User'),
(2082, 1, 'App\\Models\\User'),
(2083, 1, 'App\\Models\\User'),
(2084, 1, 'App\\Models\\User'),
(2085, 1, 'App\\Models\\User'),
(2086, 1, 'App\\Models\\User'),
(2087, 1, 'App\\Models\\User'),
(2088, 1, 'App\\Models\\User'),
(2089, 1, 'App\\Models\\User'),
(2090, 1, 'App\\Models\\User'),
(2091, 1, 'App\\Models\\User'),
(2092, 1, 'App\\Models\\User'),
(2093, 1, 'App\\Models\\User'),
(2094, 1, 'App\\Models\\User'),
(2095, 1, 'App\\Models\\User'),
(2096, 1, 'App\\Models\\User'),
(2097, 1, 'App\\Models\\User'),
(2098, 1, 'App\\Models\\User'),
(2099, 1, 'App\\Models\\User'),
(2100, 1, 'App\\Models\\User'),
(2101, 1, 'App\\Models\\User'),
(2102, 1, 'App\\Models\\User'),
(2103, 1, 'App\\Models\\User'),
(2104, 1, 'App\\Models\\User'),
(2105, 1, 'App\\Models\\User'),
(2106, 1, 'App\\Models\\User'),
(2107, 1, 'App\\Models\\User'),
(2108, 1, 'App\\Models\\User'),
(2109, 1, 'App\\Models\\User'),
(2110, 1, 'App\\Models\\User'),
(2111, 1, 'App\\Models\\User'),
(2112, 1, 'App\\Models\\User'),
(2113, 1, 'App\\Models\\User'),
(2114, 1, 'App\\Models\\User'),
(2115, 1, 'App\\Models\\User'),
(2116, 1, 'App\\Models\\User'),
(2117, 1, 'App\\Models\\User'),
(2118, 1, 'App\\Models\\User'),
(2119, 1, 'App\\Models\\User'),
(2120, 1, 'App\\Models\\User'),
(2121, 1, 'App\\Models\\User'),
(2122, 1, 'App\\Models\\User'),
(2123, 1, 'App\\Models\\User'),
(2124, 1, 'App\\Models\\User'),
(2125, 1, 'App\\Models\\User'),
(2126, 1, 'App\\Models\\User'),
(2127, 1, 'App\\Models\\User'),
(2128, 1, 'App\\Models\\User'),
(2129, 1, 'App\\Models\\User'),
(2130, 1, 'App\\Models\\User'),
(2131, 1, 'App\\Models\\User'),
(2132, 1, 'App\\Models\\User'),
(2133, 1, 'App\\Models\\User'),
(2134, 1, 'App\\Models\\User'),
(2135, 1, 'App\\Models\\User'),
(2136, 1, 'App\\Models\\User'),
(2137, 1, 'App\\Models\\User'),
(2138, 1, 'App\\Models\\User'),
(2139, 1, 'App\\Models\\User'),
(2140, 1, 'App\\Models\\User'),
(2141, 1, 'App\\Models\\User'),
(2142, 1, 'App\\Models\\User'),
(2143, 1, 'App\\Models\\User'),
(2144, 1, 'App\\Models\\User'),
(2145, 1, 'App\\Models\\User'),
(2146, 1, 'App\\Models\\User'),
(2147, 1, 'App\\Models\\User'),
(2148, 1, 'App\\Models\\User'),
(2149, 1, 'App\\Models\\User'),
(2150, 1, 'App\\Models\\User'),
(2151, 1, 'App\\Models\\User'),
(2152, 1, 'App\\Models\\User'),
(2153, 1, 'App\\Models\\User'),
(2154, 1, 'App\\Models\\User'),
(2155, 1, 'App\\Models\\User'),
(2156, 1, 'App\\Models\\User'),
(2157, 1, 'App\\Models\\User'),
(2158, 1, 'App\\Models\\User'),
(2159, 1, 'App\\Models\\User'),
(2160, 1, 'App\\Models\\User'),
(2161, 1, 'App\\Models\\User'),
(2162, 1, 'App\\Models\\User'),
(2163, 1, 'App\\Models\\User'),
(2164, 1, 'App\\Models\\User'),
(2165, 1, 'App\\Models\\User'),
(2166, 1, 'App\\Models\\User'),
(2167, 1, 'App\\Models\\User'),
(2168, 1, 'App\\Models\\User'),
(2169, 1, 'App\\Models\\User'),
(2170, 1, 'App\\Models\\User'),
(2171, 1, 'App\\Models\\User'),
(2172, 1, 'App\\Models\\User'),
(2173, 1, 'App\\Models\\User'),
(2174, 1, 'App\\Models\\User'),
(2175, 1, 'App\\Models\\User'),
(2176, 1, 'App\\Models\\User'),
(2177, 1, 'App\\Models\\User'),
(2178, 1, 'App\\Models\\User'),
(2179, 1, 'App\\Models\\User'),
(2180, 1, 'App\\Models\\User'),
(2181, 1, 'App\\Models\\User'),
(2182, 1, 'App\\Models\\User'),
(2183, 1, 'App\\Models\\User'),
(2184, 1, 'App\\Models\\User'),
(2185, 1, 'App\\Models\\User'),
(2186, 1, 'App\\Models\\User'),
(2187, 1, 'App\\Models\\User'),
(2188, 1, 'App\\Models\\User'),
(2189, 1, 'App\\Models\\User'),
(2190, 1, 'App\\Models\\User'),
(2191, 1, 'App\\Models\\User'),
(2192, 1, 'App\\Models\\User'),
(2193, 1, 'App\\Models\\User'),
(2194, 1, 'App\\Models\\User'),
(2195, 1, 'App\\Models\\User'),
(2196, 1, 'App\\Models\\User'),
(2197, 1, 'App\\Models\\User'),
(2198, 1, 'App\\Models\\User'),
(2199, 1, 'App\\Models\\User'),
(2200, 1, 'App\\Models\\User'),
(2201, 1, 'App\\Models\\User'),
(2202, 1, 'App\\Models\\User'),
(2203, 1, 'App\\Models\\User'),
(2204, 1, 'App\\Models\\User'),
(2205, 1, 'App\\Models\\User'),
(2206, 1, 'App\\Models\\User'),
(2207, 1, 'App\\Models\\User'),
(2208, 1, 'App\\Models\\User'),
(2209, 1, 'App\\Models\\User'),
(2210, 1, 'App\\Models\\User'),
(2211, 1, 'App\\Models\\User'),
(2212, 1, 'App\\Models\\User'),
(2213, 1, 'App\\Models\\User'),
(2214, 1, 'App\\Models\\User'),
(2215, 1, 'App\\Models\\User'),
(2216, 1, 'App\\Models\\User'),
(2217, 1, 'App\\Models\\User'),
(2218, 1, 'App\\Models\\User'),
(2219, 1, 'App\\Models\\User'),
(2220, 1, 'App\\Models\\User'),
(2221, 1, 'App\\Models\\User'),
(2222, 1, 'App\\Models\\User'),
(2223, 1, 'App\\Models\\User'),
(2224, 1, 'App\\Models\\User'),
(2225, 1, 'App\\Models\\User'),
(2226, 1, 'App\\Models\\User'),
(2227, 1, 'App\\Models\\User'),
(2228, 1, 'App\\Models\\User'),
(2229, 1, 'App\\Models\\User'),
(2230, 1, 'App\\Models\\User'),
(2231, 1, 'App\\Models\\User'),
(2232, 1, 'App\\Models\\User'),
(2233, 1, 'App\\Models\\User'),
(2234, 1, 'App\\Models\\User'),
(2235, 1, 'App\\Models\\User'),
(2236, 1, 'App\\Models\\User'),
(2237, 1, 'App\\Models\\User'),
(2238, 1, 'App\\Models\\User'),
(2239, 1, 'App\\Models\\User'),
(2240, 1, 'App\\Models\\User'),
(2241, 1, 'App\\Models\\User'),
(2242, 1, 'App\\Models\\User'),
(2243, 1, 'App\\Models\\User'),
(2244, 1, 'App\\Models\\User'),
(2245, 1, 'App\\Models\\User'),
(2246, 1, 'App\\Models\\User'),
(2247, 1, 'App\\Models\\User'),
(2248, 1, 'App\\Models\\User'),
(2249, 1, 'App\\Models\\User'),
(2250, 1, 'App\\Models\\User'),
(2251, 1, 'App\\Models\\User'),
(2252, 1, 'App\\Models\\User'),
(2253, 1, 'App\\Models\\User'),
(2254, 1, 'App\\Models\\User'),
(2255, 1, 'App\\Models\\User'),
(2256, 1, 'App\\Models\\User'),
(2257, 1, 'App\\Models\\User'),
(2258, 1, 'App\\Models\\User'),
(2259, 1, 'App\\Models\\User'),
(2260, 1, 'App\\Models\\User'),
(2261, 1, 'App\\Models\\User'),
(2262, 1, 'App\\Models\\User'),
(2263, 1, 'App\\Models\\User'),
(2264, 1, 'App\\Models\\User'),
(2265, 1, 'App\\Models\\User'),
(2266, 1, 'App\\Models\\User'),
(2267, 1, 'App\\Models\\User'),
(2268, 1, 'App\\Models\\User'),
(2269, 1, 'App\\Models\\User'),
(2270, 1, 'App\\Models\\User'),
(2271, 1, 'App\\Models\\User'),
(2272, 1, 'App\\Models\\User'),
(2273, 1, 'App\\Models\\User'),
(2274, 1, 'App\\Models\\User'),
(2275, 1, 'App\\Models\\User'),
(2276, 1, 'App\\Models\\User'),
(2277, 1, 'App\\Models\\User'),
(2278, 1, 'App\\Models\\User'),
(2279, 1, 'App\\Models\\User'),
(2280, 1, 'App\\Models\\User'),
(2281, 1, 'App\\Models\\User'),
(2282, 1, 'App\\Models\\User'),
(2283, 1, 'App\\Models\\User'),
(2284, 1, 'App\\Models\\User'),
(2285, 1, 'App\\Models\\User'),
(2286, 1, 'App\\Models\\User'),
(2287, 1, 'App\\Models\\User'),
(2288, 1, 'App\\Models\\User'),
(2289, 1, 'App\\Models\\User'),
(2290, 1, 'App\\Models\\User'),
(2291, 1, 'App\\Models\\User'),
(2292, 1, 'App\\Models\\User'),
(2293, 1, 'App\\Models\\User'),
(2294, 1, 'App\\Models\\User'),
(2295, 1, 'App\\Models\\User'),
(2296, 1, 'App\\Models\\User'),
(2297, 1, 'App\\Models\\User'),
(2298, 1, 'App\\Models\\User'),
(2299, 1, 'App\\Models\\User'),
(2300, 1, 'App\\Models\\User'),
(2301, 1, 'App\\Models\\User'),
(2302, 1, 'App\\Models\\User'),
(2303, 1, 'App\\Models\\User'),
(2304, 1, 'App\\Models\\User'),
(2305, 1, 'App\\Models\\User'),
(2306, 1, 'App\\Models\\User'),
(2307, 1, 'App\\Models\\User'),
(2308, 1, 'App\\Models\\User'),
(2309, 1, 'App\\Models\\User'),
(2310, 1, 'App\\Models\\User'),
(2311, 1, 'App\\Models\\User'),
(2312, 1, 'App\\Models\\User'),
(2313, 1, 'App\\Models\\User'),
(2314, 1, 'App\\Models\\User'),
(2315, 1, 'App\\Models\\User'),
(2316, 1, 'App\\Models\\User'),
(2317, 1, 'App\\Models\\User'),
(2318, 1, 'App\\Models\\User'),
(2319, 1, 'App\\Models\\User'),
(2320, 1, 'App\\Models\\User'),
(2321, 1, 'App\\Models\\User'),
(2322, 1, 'App\\Models\\User'),
(2323, 1, 'App\\Models\\User'),
(2324, 1, 'App\\Models\\User'),
(2325, 1, 'App\\Models\\User'),
(2326, 1, 'App\\Models\\User'),
(2327, 1, 'App\\Models\\User'),
(2328, 1, 'App\\Models\\User'),
(2329, 1, 'App\\Models\\User'),
(2330, 1, 'App\\Models\\User'),
(2331, 1, 'App\\Models\\User'),
(2332, 1, 'App\\Models\\User'),
(2333, 1, 'App\\Models\\User'),
(2334, 1, 'App\\Models\\User'),
(2335, 1, 'App\\Models\\User'),
(2336, 1, 'App\\Models\\User'),
(2337, 1, 'App\\Models\\User'),
(2338, 1, 'App\\Models\\User'),
(2339, 1, 'App\\Models\\User'),
(2340, 1, 'App\\Models\\User'),
(2341, 1, 'App\\Models\\User'),
(2342, 1, 'App\\Models\\User'),
(2343, 1, 'App\\Models\\User'),
(2344, 1, 'App\\Models\\User'),
(2345, 1, 'App\\Models\\User'),
(2346, 1, 'App\\Models\\User'),
(2347, 1, 'App\\Models\\User'),
(2348, 1, 'App\\Models\\User'),
(2349, 1, 'App\\Models\\User'),
(2350, 1, 'App\\Models\\User'),
(2351, 1, 'App\\Models\\User'),
(2352, 1, 'App\\Models\\User'),
(2353, 1, 'App\\Models\\User'),
(2354, 1, 'App\\Models\\User'),
(2355, 1, 'App\\Models\\User'),
(2356, 1, 'App\\Models\\User'),
(2357, 1, 'App\\Models\\User'),
(2358, 1, 'App\\Models\\User'),
(2359, 1, 'App\\Models\\User'),
(2360, 1, 'App\\Models\\User'),
(2361, 1, 'App\\Models\\User'),
(2362, 1, 'App\\Models\\User'),
(2363, 1, 'App\\Models\\User'),
(2364, 1, 'App\\Models\\User'),
(2365, 1, 'App\\Models\\User'),
(2366, 1, 'App\\Models\\User'),
(2367, 1, 'App\\Models\\User'),
(2368, 1, 'App\\Models\\User'),
(2369, 1, 'App\\Models\\User'),
(2370, 1, 'App\\Models\\User'),
(2371, 1, 'App\\Models\\User'),
(2372, 1, 'App\\Models\\User'),
(2373, 1, 'App\\Models\\User'),
(2374, 1, 'App\\Models\\User'),
(2375, 1, 'App\\Models\\User'),
(2376, 1, 'App\\Models\\User'),
(2377, 1, 'App\\Models\\User'),
(2378, 1, 'App\\Models\\User'),
(2379, 1, 'App\\Models\\User'),
(2380, 1, 'App\\Models\\User'),
(2381, 1, 'App\\Models\\User'),
(2382, 1, 'App\\Models\\User'),
(2383, 1, 'App\\Models\\User'),
(2384, 1, 'App\\Models\\User'),
(2385, 1, 'App\\Models\\User'),
(2386, 1, 'App\\Models\\User'),
(2387, 1, 'App\\Models\\User'),
(2388, 1, 'App\\Models\\User'),
(2389, 1, 'App\\Models\\User'),
(2390, 1, 'App\\Models\\User'),
(2391, 1, 'App\\Models\\User'),
(2392, 1, 'App\\Models\\User'),
(2393, 1, 'App\\Models\\User'),
(2394, 1, 'App\\Models\\User'),
(2395, 1, 'App\\Models\\User'),
(2396, 1, 'App\\Models\\User'),
(2397, 1, 'App\\Models\\User'),
(2398, 1, 'App\\Models\\User'),
(2399, 1, 'App\\Models\\User'),
(2400, 1, 'App\\Models\\User'),
(2401, 1, 'App\\Models\\User'),
(2402, 1, 'App\\Models\\User'),
(2403, 1, 'App\\Models\\User'),
(2404, 1, 'App\\Models\\User'),
(2405, 1, 'App\\Models\\User'),
(2406, 1, 'App\\Models\\User'),
(2407, 1, 'App\\Models\\User'),
(2408, 1, 'App\\Models\\User'),
(2409, 1, 'App\\Models\\User'),
(2410, 1, 'App\\Models\\User'),
(2411, 1, 'App\\Models\\User'),
(2412, 1, 'App\\Models\\User'),
(2413, 1, 'App\\Models\\User'),
(2414, 1, 'App\\Models\\User'),
(2415, 1, 'App\\Models\\User'),
(2416, 1, 'App\\Models\\User'),
(2417, 1, 'App\\Models\\User'),
(2418, 1, 'App\\Models\\User'),
(2419, 1, 'App\\Models\\User'),
(2420, 1, 'App\\Models\\User'),
(2421, 1, 'App\\Models\\User'),
(2422, 1, 'App\\Models\\User'),
(2423, 1, 'App\\Models\\User'),
(2424, 1, 'App\\Models\\User'),
(2425, 1, 'App\\Models\\User'),
(2426, 1, 'App\\Models\\User'),
(2427, 1, 'App\\Models\\User'),
(2428, 1, 'App\\Models\\User'),
(2429, 1, 'App\\Models\\User'),
(2430, 1, 'App\\Models\\User'),
(2431, 1, 'App\\Models\\User'),
(2432, 1, 'App\\Models\\User'),
(2433, 1, 'App\\Models\\User'),
(2434, 1, 'App\\Models\\User'),
(2435, 1, 'App\\Models\\User'),
(2436, 1, 'App\\Models\\User'),
(2437, 1, 'App\\Models\\User'),
(2438, 1, 'App\\Models\\User'),
(2439, 1, 'App\\Models\\User'),
(2441, 1, 'App\\Models\\User'),
(2443, 1, 'App\\Models\\User'),
(2446, 1, 'App\\Models\\User'),
(2447, 1, 'App\\Models\\User'),
(2448, 1, 'App\\Models\\User'),
(2450, 1, 'App\\Models\\User'),
(2451, 1, 'App\\Models\\User'),
(2453, 1, 'App\\Models\\User'),
(2454, 1, 'App\\Models\\User'),
(2455, 1, 'App\\Models\\User'),
(2456, 1, 'App\\Models\\User'),
(2457, 1, 'App\\Models\\User'),
(2460, 1, 'App\\Models\\User'),
(2462, 1, 'App\\Models\\User'),
(2463, 1, 'App\\Models\\User'),
(2465, 1, 'App\\Models\\User'),
(2466, 1, 'App\\Models\\User'),
(2467, 1, 'App\\Models\\User'),
(2468, 1, 'App\\Models\\User'),
(2469, 1, 'App\\Models\\User'),
(2470, 1, 'App\\Models\\User'),
(2471, 1, 'App\\Models\\User'),
(2472, 1, 'App\\Models\\User'),
(2473, 1, 'App\\Models\\User'),
(2474, 1, 'App\\Models\\User'),
(2475, 1, 'App\\Models\\User'),
(2476, 1, 'App\\Models\\User'),
(2477, 1, 'App\\Models\\User'),
(2478, 1, 'App\\Models\\User'),
(2479, 1, 'App\\Models\\User'),
(2480, 1, 'App\\Models\\User'),
(2481, 1, 'App\\Models\\User'),
(2482, 1, 'App\\Models\\User'),
(2483, 1, 'App\\Models\\User'),
(2484, 1, 'App\\Models\\User'),
(2485, 1, 'App\\Models\\User'),
(2486, 1, 'App\\Models\\User'),
(2487, 1, 'App\\Models\\User'),
(2488, 1, 'App\\Models\\User'),
(2489, 1, 'App\\Models\\User'),
(2491, 1, 'App\\Models\\User'),
(2493, 1, 'App\\Models\\User'),
(2494, 1, 'App\\Models\\User'),
(2495, 1, 'App\\Models\\User'),
(2497, 1, 'App\\Models\\User'),
(2498, 1, 'App\\Models\\User'),
(2499, 1, 'App\\Models\\User'),
(2500, 1, 'App\\Models\\User'),
(2501, 1, 'App\\Models\\User'),
(2502, 1, 'App\\Models\\User'),
(2503, 1, 'App\\Models\\User'),
(2504, 1, 'App\\Models\\User'),
(2505, 1, 'App\\Models\\User'),
(2506, 1, 'App\\Models\\User'),
(2508, 1, 'App\\Models\\User'),
(2509, 1, 'App\\Models\\User'),
(2510, 1, 'App\\Models\\User'),
(2511, 1, 'App\\Models\\User'),
(2512, 1, 'App\\Models\\User'),
(2513, 1, 'App\\Models\\User'),
(2514, 1, 'App\\Models\\User'),
(2515, 1, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `table_name` varchar(100) NOT NULL,
  `action` varchar(50) NOT NULL,
  `field_name` varchar(100) DEFAULT NULL,
  `old_value` longtext DEFAULT NULL,
  `new_value` longtext DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_headers`
--
ALTER TABLE `account_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_contact_mangs`
--
ALTER TABLE `admin_contact_mangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_status`
--
ALTER TABLE `appointment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultancey_fees`
--
ALTER TABLE `consultancey_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_company_id_code_unique` (`company_id`,`code`),
  ADD KEY `currencies_company_id_index` (`company_id`);

--
-- Indexes for table `dd_blood_groups`
--
ALTER TABLE `dd_blood_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `dd_categories`
--
ALTER TABLE `dd_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_dental_histories`
--
ALTER TABLE `dd_dental_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_diagnoses`
--
ALTER TABLE `dd_diagnoses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_drug_histories`
--
ALTER TABLE `dd_drug_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_examinations`
--
ALTER TABLE `dd_examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_findings`
--
ALTER TABLE `dd_findings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_investigations`
--
ALTER TABLE `dd_investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_medical_histories`
--
ALTER TABLE `dd_medical_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_medicines`
--
ALTER TABLE `dd_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_medicine_types`
--
ALTER TABLE `dd_medicine_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_procedures`
--
ALTER TABLE `dd_procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_procedure_categories`
--
ALTER TABLE `dd_procedure_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_social_histories`
--
ALTER TABLE `dd_social_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_subcategories`
--
ALTER TABLE `dd_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_task_actions`
--
ALTER TABLE `dd_task_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_task_priorities`
--
ALTER TABLE `dd_task_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_task_status`
--
ALTER TABLE `dd_task_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_task_types`
--
ALTER TABLE `dd_task_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dd_treatment_plans`
--
ALTER TABLE `dd_treatment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dental_lab_order`
--
ALTER TABLE `dental_lab_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_campaigns`
--
ALTER TABLE `email_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_campaign_logs`
--
ALTER TABLE `email_campaign_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_name_unique` (`name`);

--
-- Indexes for table `enquiry_sources`
--
ALTER TABLE `enquiry_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_investigations`
--
ALTER TABLE `exam_investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_orals`
--
ALTER TABLE `extra_orals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_oral_exam_investigations`
--
ALTER TABLE `extra_oral_exam_investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_ends`
--
ALTER TABLE `front_ends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `front_ends_page_unique` (`page`);

--
-- Indexes for table `hard_tissues`
--
ALTER TABLE `hard_tissues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_of_chief_complaints`
--
ALTER TABLE `history_of_chief_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_departments`
--
ALTER TABLE `hospital_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hospital_departments_name_unique` (`name`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `insurances_name_unique` (`name`);

--
-- Indexes for table `insurance_providers`
--
ALTER TABLE `insurance_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intra_orals`
--
ALTER TABLE `intra_orals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intra_oral_exam_investigations`
--
ALTER TABLE `intra_oral_exam_investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_additions`
--
ALTER TABLE `inventory_additions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_consumeds`
--
ALTER TABLE `inventory_consumeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_report_templates`
--
ALTER TABLE `lab_report_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lab_report_templates_name_unique` (`name`);

--
-- Indexes for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_settings`
--
ALTER TABLE `page_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_settings_page_name_unique` (`page_name`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_case_studies`
--
ALTER TABLE `patient_case_studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_dental_histories`
--
ALTER TABLE `patient_dental_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_diagnosis_items`
--
ALTER TABLE `patient_diagnosis_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_drug_histories`
--
ALTER TABLE `patient_drug_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_medical_histories`
--
ALTER TABLE `patient_medical_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_medicine_items`
--
ALTER TABLE `patient_medicine_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_social_histories`
--
ALTER TABLE `patient_social_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_teeths`
--
ALTER TABLE `patient_teeths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_treatment_plans`
--
ALTER TABLE `patient_treatment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_treatment_plan_procedures`
--
ALTER TABLE `patient_treatment_plan_procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_treatment_process`
--
ALTER TABLE `patient_treatment_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_company_id_key_unique` (`company_id`,`key`),
  ADD KEY `settings_company_id_index` (`company_id`);

--
-- Indexes for table `sms_apis`
--
ALTER TABLE `sms_apis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_campaigns`
--
ALTER TABLE `sms_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_campaign_logs`
--
ALTER TABLE `sms_campaign_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_templates`
--
ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_templates_name_unique` (`name`);

--
-- Indexes for table `smtp_configurations`
--
ALTER TABLE `smtp_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soft_tissues`
--
ALTER TABLE `soft_tissues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soft_tissues_exam_investigations`
--
ALTER TABLE `soft_tissues_exam_investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_coznstraint` (`department_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_notifications`
--
ALTER TABLE `task_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxes_company_id_index` (`company_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`course_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `test_files`
--
ALTER TABLE `test_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tooth_issues`
--
ALTER TABLE `tooth_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment_plan_notes`
--
ALTER TABLE `treatment_plan_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_companies`
--
ALTER TABLE `user_companies`
  ADD PRIMARY KEY (`user_id`,`company_id`,`user_type`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_headers`
--
ALTER TABLE `account_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `application_settings`
--
ALTER TABLE `application_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_status`
--
ALTER TABLE `appointment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultancey_fees`
--
ALTER TABLE `consultancey_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dd_blood_groups`
--
ALTER TABLE `dd_blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dd_categories`
--
ALTER TABLE `dd_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `dd_dental_histories`
--
ALTER TABLE `dd_dental_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dd_diagnoses`
--
ALTER TABLE `dd_diagnoses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dd_drug_histories`
--
ALTER TABLE `dd_drug_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dd_examinations`
--
ALTER TABLE `dd_examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dd_findings`
--
ALTER TABLE `dd_findings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `dd_investigations`
--
ALTER TABLE `dd_investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dd_medical_histories`
--
ALTER TABLE `dd_medical_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dd_medicines`
--
ALTER TABLE `dd_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `dd_medicine_types`
--
ALTER TABLE `dd_medicine_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `dd_procedures`
--
ALTER TABLE `dd_procedures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `dd_procedure_categories`
--
ALTER TABLE `dd_procedure_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dd_social_histories`
--
ALTER TABLE `dd_social_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dd_subcategories`
--
ALTER TABLE `dd_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `dd_task_actions`
--
ALTER TABLE `dd_task_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dd_task_priorities`
--
ALTER TABLE `dd_task_priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dd_task_status`
--
ALTER TABLE `dd_task_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dd_task_types`
--
ALTER TABLE `dd_task_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dd_treatment_plans`
--
ALTER TABLE `dd_treatment_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dental_lab_order`
--
ALTER TABLE `dental_lab_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_details`
--
ALTER TABLE `doctor_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_campaigns`
--
ALTER TABLE `email_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_campaign_logs`
--
ALTER TABLE `email_campaign_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry_sources`
--
ALTER TABLE `enquiry_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_investigations`
--
ALTER TABLE `exam_investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra_orals`
--
ALTER TABLE `extra_orals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `extra_oral_exam_investigations`
--
ALTER TABLE `extra_oral_exam_investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_ends`
--
ALTER TABLE `front_ends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hard_tissues`
--
ALTER TABLE `hard_tissues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_of_chief_complaints`
--
ALTER TABLE `history_of_chief_complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital_departments`
--
ALTER TABLE `hospital_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_providers`
--
ALTER TABLE `insurance_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intra_orals`
--
ALTER TABLE `intra_orals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intra_oral_exam_investigations`
--
ALTER TABLE `intra_oral_exam_investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_additions`
--
ALTER TABLE `inventory_additions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_consumeds`
--
ALTER TABLE `inventory_consumeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lab_reports`
--
ALTER TABLE `lab_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_report_templates`
--
ALTER TABLE `lab_report_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `page_settings`
--
ALTER TABLE `page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_appointments`
--
ALTER TABLE `patient_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_case_studies`
--
ALTER TABLE `patient_case_studies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_dental_histories`
--
ALTER TABLE `patient_dental_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_diagnosis_items`
--
ALTER TABLE `patient_diagnosis_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_drug_histories`
--
ALTER TABLE `patient_drug_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_medical_histories`
--
ALTER TABLE `patient_medical_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_medicine_items`
--
ALTER TABLE `patient_medicine_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_social_histories`
--
ALTER TABLE `patient_social_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_teeths`
--
ALTER TABLE `patient_teeths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_treatment_plans`
--
ALTER TABLE `patient_treatment_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_treatment_plan_procedures`
--
ALTER TABLE `patient_treatment_plan_procedures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_treatment_process`
--
ALTER TABLE `patient_treatment_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `sms_apis`
--
ALTER TABLE `sms_apis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sms_campaigns`
--
ALTER TABLE `sms_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_campaign_logs`
--
ALTER TABLE `sms_campaign_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smtp_configurations`
--
ALTER TABLE `smtp_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soft_tissues`
--
ALTER TABLE `soft_tissues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `soft_tissues_exam_investigations`
--
ALTER TABLE `soft_tissues_exam_investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_notifications`
--
ALTER TABLE `task_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_files`
--
ALTER TABLE `test_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tooth_issues`
--
ALTER TABLE `tooth_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `treatment_plan_notes`
--
ALTER TABLE `treatment_plan_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2516;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `Fk_coznstraint` FOREIGN KEY (`department_id`) REFERENCES `hospital_departments` (`id`),
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD CONSTRAINT `teacher_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `teacher_courses_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
