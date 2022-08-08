-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 03:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hall_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `md_cancel_plan`
--

CREATE TABLE `md_cancel_plan` (
  `id` int(11) NOT NULL,
  `from_day` int(11) NOT NULL,
  `to_day` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_cancel_plan`
--

INSERT INTO `md_cancel_plan` (`id`, `from_day`, `to_day`, `percentage`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 31, 60, 0, '1', '1', '2022-05-25 07:47:37', '2022-08-03 01:03:52'),
(2, 16, 30, 20, '1', NULL, '2022-08-03 01:04:17', '2022-08-03 01:04:17'),
(3, 7, 15, 30, '1', NULL, '2022-08-03 01:04:33', '2022-08-03 01:04:33'),
(4, 1, 6, 100, '1', NULL, '2022-08-03 01:05:18', '2022-08-03 01:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `md_caution_money`
--

CREATE TABLE `md_caution_money` (
  `id` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_caution_money`
--

INSERT INTO `md_caution_money` (`id`, `effective_date`, `room_type_id`, `percentage`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2022-05-26', 1, 21, '1', '1', '2022-05-25 23:27:36', '2022-05-25 23:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `md_documents`
--

CREATE TABLE `md_documents` (
  `id` int(11) NOT NULL,
  `document` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_documents`
--

INSERT INTO `md_documents` (`id`, `document`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test1', '1', '1', '2022-05-26 00:06:12', '2022-05-26 00:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `md_hall_rent`
--

CREATE TABLE `md_hall_rent` (
  `id` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `location_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `normal_rate` decimal(10,2) NOT NULL,
  `holiday_rate` decimal(10,2) NOT NULL,
  `book_flag` enum('H','B','W') NOT NULL COMMENT 'H->hourly, B->Per Bed, W->Whole Room',
  `caution_money` int(20) NOT NULL,
  `cgst_rate` int(11) NOT NULL,
  `sgst_rate` int(11) NOT NULL,
  `check_in_time` varchar(10) NOT NULL,
  `period` int(11) NOT NULL COMMENT 'hourly',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_hall_rent`
--

INSERT INTO `md_hall_rent` (`id`, `effective_date`, `location_id`, `room_type_id`, `room_id`, `normal_rate`, `holiday_rate`, `book_flag`, `caution_money`, `cgst_rate`, `sgst_rate`, `check_in_time`, `period`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2022-06-02', 1, 6, 14, '6000.00', '7000.00', 'W', 20, 5, 5, '10', 8, 1, 1, '2022-06-02 06:47:29', '2022-06-23 01:22:00'),
(2, '2022-06-02', 1, 6, 15, '7000.00', '8000.00', 'W', 20, 5, 5, '10', 8, 1, NULL, '2022-06-02 06:53:20', '2022-06-02 06:53:20'),
(3, '2022-06-03', 1, 6, 16, '6500.00', '7000.00', 'W', 20, 5, 5, '10', 8, 1, NULL, '2022-06-03 02:15:35', '2022-06-03 02:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `md_location`
--

CREATE TABLE `md_location` (
  `id` bigint(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_location`
--

INSERT INTO `md_location` (`id`, `location`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'ICMARD', '1', '1', '2022-05-25 06:27:53', '2022-05-25 06:32:38'),
(2, 'RICMARD', '1', NULL, '2022-05-26 02:04:13', '2022-05-26 02:04:13'),
(3, 'Head Office', '1', NULL, '2022-05-26 02:05:55', '2022-05-26 02:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `md_menu`
--

CREATE TABLE `md_menu` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` double(100,2) NOT NULL,
  `cgst` int(11) NOT NULL,
  `sgst` int(11) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_menu`
--

INSERT INTO `md_menu` (`id`, `item_name`, `price`, `cgst`, `sgst`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Tea, Biscuits', 8.00, 0, 0, '1', '1', '2022-07-28 07:56:39', '2022-07-28 02:26:39'),
(2, 'Lunch - Non Vej', 154.00, 0, 0, '1', '1', '2022-07-28 07:57:30', '2022-07-28 02:27:30'),
(3, 'Lunch - Non Vej', 134.00, 0, 0, '1', '', '2022-07-28 02:27:52', '2022-07-28 02:27:52'),
(4, 'Evening Tea', 8.00, 0, 0, '1', '', '2022-07-28 02:28:21', '2022-07-28 02:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `md_params`
--

CREATE TABLE `md_params` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_params`
--

INSERT INTO `md_params` (`id`, `description`, `value`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Maximum advance booking period (in months) for User', 2, '1', '1', '2022-05-25 06:48:01', '2022-07-26 23:57:47'),
(2, 'Advance booking percentage', 50, '1', NULL, '2022-05-26 02:00:35', '2022-05-26 02:00:35'),
(3, 'Cutoff time per booking (in hours)', 16, '1', NULL, '2022-05-26 02:01:32', '2022-05-26 02:01:32'),
(4, 'Check in time (24 hours)', 10, '1', NULL, '2022-05-26 02:02:46', '2022-05-26 02:02:46'),
(5, 'Check out time (24 hours)', 10, '1', NULL, '2022-05-26 02:03:08', '2022-05-26 02:03:08'),
(6, 'Hall advance booking', 7, '1', NULL, '2022-05-26 02:03:29', '2022-05-26 02:03:29'),
(7, 'No. of room advance needed for booking', 5, '1', '1', '2022-05-26 02:03:54', '2022-07-27 00:39:47'),
(9, 'Maximum advance booking period (in months) for Admin', 12, '1', NULL, '2022-07-26 23:58:12', '2022-07-26 23:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `md_room`
--

CREATE TABLE `md_room` (
  `id` bigint(20) NOT NULL,
  `location_id` int(11) NOT NULL,
  `room_no` varchar(100) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `no_person` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_room`
--

INSERT INTO `md_room` (`id`, `location_id`, `room_no`, `room_type_id`, `room_name`, `no_person`, `floor`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '10', 1, 'Dormitory Room', 2, 1, '1', '1', '2022-05-25 07:21:01', '2022-05-27 00:23:37'),
(2, 1, '101', 3, 'AC Double Bed', 2, 1, '1', NULL, '2022-05-27 00:24:18', '2022-05-27 00:24:18'),
(3, 1, '102', 3, 'AC Double Bed', 2, 1, '1', NULL, '2022-05-27 00:24:38', '2022-05-27 00:24:38'),
(4, 1, '103', 3, 'AC Double Bed', 2, 1, '1', NULL, '2022-05-27 00:25:32', '2022-05-27 00:25:32'),
(5, 1, '104', 3, 'AC Double Bed', 2, 1, '1', NULL, '2022-05-27 00:26:09', '2022-05-27 00:26:09'),
(6, 1, '105', 3, 'AC Double Bed', 2, 1, '1', NULL, '2022-05-27 00:26:28', '2022-05-27 00:26:28'),
(7, 1, '110', 2, 'Non AC Double Bed', 2, 2, '1', NULL, '2022-05-27 00:27:12', '2022-05-27 00:27:12'),
(8, 1, '111', 2, 'Non AC Double Bed', 2, 2, '1', NULL, '2022-05-27 00:27:12', '2022-05-27 00:27:12'),
(9, 1, '112', 2, 'Non AC Double Bed', 2, 2, '1', NULL, '2022-05-27 00:27:12', '2022-05-27 00:27:12'),
(10, 1, '120', 4, 'AC Deluxe Double Bed', 2, 3, '1', '1', '2022-05-27 00:28:28', '2022-05-27 00:29:18'),
(11, 1, '121', 4, 'AC Deluxe Double Bed', 2, 3, '1', NULL, '2022-05-27 00:28:28', '2022-05-27 00:28:28'),
(12, 1, '150', 5, 'VVIP Room', 2, 1, '1', NULL, '2022-05-27 00:30:59', '2022-05-27 00:30:59'),
(13, 1, '151', 5, 'VVIP Room', 2, 1, '1', NULL, '2022-05-27 00:30:59', '2022-05-27 00:30:59'),
(14, 1, '301', 6, 'Conference Hall', 1, 1, '1', NULL, '2022-06-01 04:31:20', '2022-06-01 04:31:20'),
(15, 1, '305', 6, 'Conference Hall', 1, 1, '1', NULL, '2022-06-01 04:31:52', '2022-06-01 04:31:52'),
(16, 1, '201', 6, 'Conference Hall', 1, 3, '1', NULL, '2022-06-01 04:32:29', '2022-06-01 04:32:29'),
(17, 1, '306', 7, 'Auditorium', 1, 3, '1', NULL, '2022-06-01 04:33:29', '2022-06-01 04:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `md_room_charge`
--

CREATE TABLE `md_room_charge` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `hour_flag` enum('Y','N') NOT NULL,
  `per_bed_flag` enum('Y','N') NOT NULL,
  `amount` double(10,2) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `holiday_amount` double(10,2) NOT NULL,
  `cgst_rate` int(11) NOT NULL,
  `sgst_rate` int(11) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_room_charge`
--

INSERT INTO `md_room_charge` (`id`, `room_type_id`, `effective_date`, `hour_flag`, `per_bed_flag`, `amount`, `discount_percentage`, `holiday_amount`, `cgst_rate`, `sgst_rate`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-26', 'N', 'Y', 100.00, 15, 100.00, 6, 5, '1', '1', '2022-05-26 01:04:10', '2022-05-26 01:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `md_room_rent`
--

CREATE TABLE `md_room_rent` (
  `id` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `location_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `normal_rate` int(11) NOT NULL,
  `book_flag` enum('H','B','W') NOT NULL COMMENT 'H->hourly, B->Per Bed, W->Whole Room',
  `discount_percentage` int(11) NOT NULL,
  `cgst_rate` int(11) NOT NULL,
  `sgst_rate` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_room_rent`
--

INSERT INTO `md_room_rent` (`id`, `effective_date`, `location_id`, `room_type_id`, `normal_rate`, `book_flag`, `discount_percentage`, `cgst_rate`, `sgst_rate`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2022-06-02', 1, 2, 600, 'W', 5, 5, 5, 1, 1, '2022-06-02 06:23:43', '2022-06-03 04:27:39'),
(2, '2022-06-03', 1, 3, 1000, 'W', 5, 5, 5, 1, 1, '2022-06-03 02:10:08', '2022-06-03 02:10:20'),
(3, '2022-06-03', 1, 5, 3000, 'W', 0, 0, 0, 1, 1, '2022-06-03 02:12:15', '2022-06-03 02:13:12'),
(4, '2022-06-03', 1, 4, 1500, 'W', 0, 0, 0, 1, NULL, '2022-06-03 02:21:08', '2022-06-03 02:21:08'),
(5, '2022-05-02', 1, 2, 500, 'W', 5, 5, 5, 1, 1, '2022-06-02 06:23:43', '2022-06-03 04:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `md_room_type`
--

CREATE TABLE `md_room_type` (
  `id` bigint(20) NOT NULL,
  `type` varchar(100) NOT NULL,
  `location_id` int(11) NOT NULL,
  `max_accomodation_number` int(11) NOT NULL,
  `max_child_number` int(11) NOT NULL,
  `code` enum('R','H') NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_room_type`
--

INSERT INTO `md_room_type` (`id`, `type`, `location_id`, `max_accomodation_number`, `max_child_number`, `code`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Dormitory', 1, 30, 0, 'R', '1', '1', '2022-05-25 06:39:20', '2022-05-26 02:06:34'),
(2, 'Non AC Double Bed', 1, 2, 2, 'R', '1', '1', '2022-05-26 02:06:46', '2022-06-16 07:15:07'),
(3, 'AC Double Bed', 1, 2, 2, 'R', '1', NULL, '2022-05-26 02:06:55', '2022-05-26 02:06:55'),
(4, 'AC Deluxe Double Bed', 1, 4, 4, 'R', '1', NULL, '2022-05-26 02:07:05', '2022-05-26 02:07:05'),
(5, 'VVIP Room', 1, 1, 0, 'R', '1', NULL, '2022-05-26 02:07:13', '2022-05-26 02:07:13'),
(6, 'Conference Hall', 1, 9999, 0, 'H', '1', NULL, '2022-05-26 02:07:29', '2022-05-26 02:07:29'),
(7, 'Auditorium', 1, 9999, 0, 'H', '1', NULL, '2022-05-26 02:07:52', '2022-05-26 02:07:52'),
(8, 'Lounge', 1, 9999, 0, 'H', '1', NULL, '2022-05-26 02:08:06', '2022-05-26 02:08:06'),
(9, 'NON AC Room', 2, 2, 0, 'R', '1', NULL, '2022-05-26 02:09:41', '2022-05-26 02:09:41'),
(10, 'Training Hall', 2, 9999, 0, 'H', '1', '1', '2022-05-26 02:10:00', '2022-06-02 05:57:18'),
(11, 'Dormitory', 2, 30, 0, 'R', '1', '1', '2022-05-25 06:39:20', '2022-05-26 02:06:34'),
(12, 'AC Double Bed', 2, 2, 2, 'R', '1', '1', '2022-05-26 02:06:55', '2022-06-29 07:19:35'),
(13, 'AC Double Bed', 3, 2, 2, 'R', '1', '1', '2022-05-26 02:06:55', '2022-06-29 07:20:02'),
(14, 'Non AC Double Bed', 3, 2, 2, 'R', '1', '1', '2022-05-26 02:06:46', '2022-06-29 07:20:42'),
(15, 'Dormitory', 3, 30, 0, 'R', '1', '1', '2022-05-25 06:39:20', '2022-05-26 02:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `md_rules`
--

CREATE TABLE `md_rules` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `rules` longtext NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_rules`
--

INSERT INTO `md_rules` (`id`, `room_type_id`, `rules`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'my test rule test', '1', '1', '2022-05-25 07:01:12', '2022-05-25 07:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `md_states`
--

CREATE TABLE `md_states` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_states`
--

INSERT INTO `md_states` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', NULL, NULL, NULL, NULL),
(2, 'Arunachal Pradesh', NULL, NULL, NULL, NULL),
(3, 'Assam', NULL, NULL, NULL, NULL),
(4, 'Bihar', NULL, NULL, NULL, NULL),
(5, 'Chhattisgarh', NULL, NULL, NULL, NULL),
(6, 'Goa', NULL, NULL, NULL, NULL),
(7, 'Gujarat', NULL, NULL, NULL, NULL),
(8, 'Haryana', NULL, NULL, NULL, NULL),
(9, 'Himachal Pradesh', NULL, NULL, NULL, NULL),
(10, 'Jharkhand', NULL, NULL, NULL, NULL),
(11, 'Karnataka', NULL, NULL, NULL, NULL),
(12, 'Kerala', NULL, NULL, NULL, NULL),
(13, 'Madhya Pradesh', NULL, NULL, NULL, NULL),
(14, 'Maharashtra', NULL, NULL, NULL, NULL),
(15, 'Manipur', NULL, NULL, NULL, NULL),
(16, 'Meghalaya', NULL, NULL, NULL, NULL),
(17, 'Mizoram', NULL, NULL, NULL, NULL),
(18, 'Nagaland', NULL, NULL, NULL, NULL),
(19, 'Odisha', NULL, NULL, NULL, NULL),
(20, 'Punjab', NULL, NULL, NULL, NULL),
(21, 'Rajasthan', NULL, NULL, NULL, NULL),
(22, 'Sikkim', NULL, NULL, NULL, NULL),
(23, 'Tamil Nadu', NULL, NULL, NULL, NULL),
(24, 'Telangana', NULL, NULL, NULL, NULL),
(25, 'Tripura', NULL, NULL, NULL, NULL),
(26, 'Uttar Pradesh', NULL, NULL, NULL, NULL),
(27, 'Uttarakhand', NULL, NULL, NULL, NULL),
(28, 'West Bengal', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_hall_book`
--

CREATE TABLE `td_hall_book` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `all_dates` varchar(100) NOT NULL,
  `no_room` int(11) NOT NULL,
  `no_adult` int(11) DEFAULT NULL,
  `no_child` int(11) DEFAULT NULL,
  `room_type_id` int(11) NOT NULL,
  `booking_time` datetime NOT NULL,
  `laptop_projector` enum('Y','N') DEFAULT NULL,
  `sound_system` enum('Y','N') DEFAULT NULL,
  `catering_service` enum('Y','N') DEFAULT NULL,
  `booking_status` varchar(100) NOT NULL,
  `amount` double(100,2) NOT NULL,
  `total_cgst_amount` int(11) NOT NULL COMMENT 'In Percentage',
  `total_sgst_amount` int(11) NOT NULL COMMENT 'In Percentage',
  `final_amount` double(100,2) NOT NULL,
  `discount_amount` double(100,2) NOT NULL,
  `total_amount` double(100,2) NOT NULL,
  `paid_amount` double(100,2) DEFAULT NULL,
  `full_paid` enum('N','Y') NOT NULL,
  `final_bill_flag` enum('N','Y') NOT NULL DEFAULT 'N',
  `remark` text DEFAULT NULL,
  `payment_status` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_hall_book`
--

INSERT INTO `td_hall_book` (`id`, `booking_id`, `location_id`, `user_id`, `from_date`, `to_date`, `all_dates`, `no_room`, `no_adult`, `no_child`, `room_type_id`, `booking_time`, `laptop_projector`, `sound_system`, `catering_service`, `booking_status`, `amount`, `total_cgst_amount`, `total_sgst_amount`, `final_amount`, `discount_amount`, `total_amount`, `paid_amount`, `full_paid`, `final_bill_flag`, `remark`, `payment_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BKI20220801053738', 1, 2, NULL, NULL, '[\"30-08-2022\"]', 1, NULL, NULL, 6, '2022-08-01 05:37:38', 'Y', 'Y', 'Y', 'Confirm', 6000.00, 5, 5, 6600.00, 0.00, 6600.00, 3300.00, 'N', 'N', NULL, '', '1', NULL, '2022-08-01 00:07:38', '2022-08-01 00:07:38'),
(2, 'BKI20220801100952', 1, 2, NULL, NULL, '[\"11-08-2022\"]', 1, NULL, NULL, 6, '2022-08-01 10:09:52', 'Y', 'Y', 'Y', 'Confirm', 6000.00, 5, 5, 6600.00, 0.00, 6600.00, 3300.00, 'Y', 'Y', NULL, '', NULL, NULL, '2022-08-01 04:39:52', '2022-08-03 00:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `td_hall_book_details`
--

CREATE TABLE `td_hall_book_details` (
  `id` bigint(20) NOT NULL,
  `customer_type_flag` enum('I','O') NOT NULL COMMENT 'I=Individual,O=Organisation',
  `booking_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `child_flag` enum('Y','N') NOT NULL COMMENT 'Y=Yes , N=No',
  `age` int(11) DEFAULT NULL,
  `organisation_name` varchar(100) DEFAULT NULL,
  `organisation_gst_no` varchar(100) DEFAULT NULL,
  `pan` varchar(100) DEFAULT NULL,
  `tan` varchar(100) DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_hall_book_details`
--

INSERT INTO `td_hall_book_details` (`id`, `customer_type_flag`, `booking_id`, `first_name`, `middle_name`, `last_name`, `address`, `child_flag`, `age`, `organisation_name`, `organisation_gst_no`, `pan`, `tan`, `registration_no`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'O', 'BKI20220801053738', 'vvfdvg', NULL, 'vgdvfr', 'esvb fdbfdbdeb,West Bengal,700107', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-01 00:07:38', '2022-08-01 00:07:38'),
(2, 'I', 'BKI20220801100952', 'fvfd', NULL, 'dfvdf', 'dfgvdgg,West Bengal,700107', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-01 04:39:52', '2022-08-01 04:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `td_hall_lock`
--

CREATE TABLE `td_hall_lock` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status` enum('L','U') NOT NULL COMMENT 'L=lock,U=Unlock',
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_hall_lock`
--

INSERT INTO `td_hall_lock` (`id`, `date`, `booking_id`, `room_id`, `room_type_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2022-08-30', 'BKI20220801053738', 14, 6, 'L', NULL, NULL, '2022-08-01 00:07:38', '2022-08-01 00:07:38'),
(2, '2022-08-11', 'BKI20220801100952', 14, 6, 'L', NULL, NULL, '2022-08-01 04:39:52', '2022-08-01 04:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `td_hall_menu`
--

CREATE TABLE `td_hall_menu` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `menu_id` varchar(100) NOT NULL,
  `no_of_head` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` double(100,2) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_hall_menu`
--

INSERT INTO `td_hall_menu` (`id`, `booking_id`, `menu_id`, `no_of_head`, `rate`, `amount`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BKI20220801100952', '1', 4, 8, 32.00, NULL, NULL, '2022-08-01 04:39:52', '2022-08-01 04:39:52'),
(2, 'BKI20220801100952', '2', 5, 154, 770.00, NULL, NULL, '2022-08-01 04:39:52', '2022-08-01 04:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `td_hall_payment`
--

CREATE TABLE `td_hall_payment` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `amount` double(100,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_made_by` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_hall_payment`
--

INSERT INTO `td_hall_payment` (`id`, `booking_id`, `amount`, `payment_date`, `payment_made_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BKI20220801053738', 3300.00, '2022-08-01 05:37:38', 'Payment', NULL, NULL, '2022-08-01 00:07:38', '2022-08-01 00:07:38'),
(2, 'BKI20220801100952', 3300.00, '2022-08-01 10:09:52', 'Payment', NULL, NULL, '2022-08-01 04:39:52', '2022-08-01 04:39:52'),
(5, 'BKI20220801100952', 4142.10, '2022-08-03 05:59:47', 'Cash', NULL, NULL, '2022-08-03 00:29:47', '2022-08-03 00:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `td_room_book`
--

CREATE TABLE `td_room_book` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `no_room` int(11) NOT NULL,
  `no_adult` int(11) NOT NULL,
  `no_child` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `laptop_projector` enum('Y','N') DEFAULT NULL,
  `sound_system` enum('Y','N') DEFAULT NULL,
  `catering_service` enum('Y','N') DEFAULT NULL,
  `booking_time` datetime NOT NULL,
  `booking_status` enum('A','C') NOT NULL COMMENT 'A=Accept,C=cancel',
  `amount` double(100,2) NOT NULL,
  `total_cgst_amount` int(11) NOT NULL COMMENT 'In Percentage',
  `total_sgst_amount` int(11) NOT NULL COMMENT 'In Percentage',
  `final_amount` double(100,2) NOT NULL,
  `discount_amount` double(100,2) NOT NULL,
  `total_amount` double(100,2) NOT NULL,
  `paid_amount` double(100,2) DEFAULT NULL,
  `full_paid` enum('N','Y') NOT NULL,
  `final_bill_flag` enum('N','Y') NOT NULL DEFAULT 'N',
  `payment_status` varchar(100) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_room_book`
--

INSERT INTO `td_room_book` (`id`, `booking_id`, `location_id`, `user_id`, `from_date`, `to_date`, `no_room`, `no_adult`, `no_child`, `room_type_id`, `laptop_projector`, `sound_system`, `catering_service`, `booking_time`, `booking_status`, `amount`, `total_cgst_amount`, `total_sgst_amount`, `final_amount`, `discount_amount`, `total_amount`, `paid_amount`, `full_paid`, `final_bill_flag`, `payment_status`, `remark`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BKI20220801091456', 1, 42, '2022-08-26', '2022-08-27', 1, 1, 0, 3, NULL, NULL, NULL, '2022-08-01 09:14:56', 'A', 1000.00, 5, 5, 1100.00, 0.00, 1100.00, NULL, 'N', 'N', NULL, NULL, NULL, NULL, '2022-08-01 03:44:56', '2022-08-01 03:44:56'),
(2, 'BKI20220802060750', 1, 42, '2022-09-15', '2022-09-16', 1, 1, 0, 3, NULL, NULL, NULL, '2022-08-02 06:07:50', 'A', 1000.00, 5, 5, 1100.00, 0.00, 1100.00, NULL, 'Y', 'Y', NULL, NULL, NULL, NULL, '2022-08-02 00:37:50', '2022-08-02 05:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `td_room_book_details`
--

CREATE TABLE `td_room_book_details` (
  `id` bigint(20) NOT NULL,
  `customer_type_flag` enum('I','O') NOT NULL COMMENT 'I=Individual,O=Organisation',
  `booking_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `child_flag` enum('Y','N') NOT NULL COMMENT 'Y=Yes , N=No',
  `age` int(11) DEFAULT NULL,
  `organisation_name` varchar(100) DEFAULT NULL,
  `organisation_gst_no` varchar(100) DEFAULT NULL,
  `pan` varchar(100) DEFAULT NULL,
  `tan` varchar(100) DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_room_book_details`
--

INSERT INTO `td_room_book_details` (`id`, `customer_type_flag`, `booking_id`, `first_name`, `middle_name`, `last_name`, `address`, `child_flag`, `age`, `organisation_name`, `organisation_gst_no`, `pan`, `tan`, `registration_no`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'I', 'BKI20220801091456', 'sdfsd', NULL, 'sfsfsff', 'sdfsf,West Bengal,700107', 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-01 03:44:56', '2022-08-01 03:44:56'),
(2, 'O', 'BKI20220802060750', 'chittaranjan', NULL, 'Maity', 'cc-20,West Bengal,700107', 'N', NULL, NULL, '12345687', '12475842', NULL, 'fr5esrftde', NULL, NULL, '2022-08-02 00:37:50', '2022-08-02 00:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `td_room_lock`
--

CREATE TABLE `td_room_lock` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `status` enum('L','U') NOT NULL COMMENT 'L=lock,U=Unlock',
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_room_lock`
--

INSERT INTO `td_room_lock` (`id`, `date`, `booking_id`, `room_id`, `room_type_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2022-08-26', 'BKI20220801091456', 2, 3, 'L', NULL, NULL, '2022-08-01 03:44:56', '2022-08-01 03:44:56'),
(2, '2022-09-15', 'BKI20220802060750', 2, 3, 'L', NULL, NULL, '2022-08-02 00:37:50', '2022-08-02 00:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `td_room_menu`
--

CREATE TABLE `td_room_menu` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `menu_id` varchar(100) NOT NULL,
  `no_of_head` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` double(100,2) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_room_menu`
--

INSERT INTO `td_room_menu` (`id`, `booking_id`, `menu_id`, `no_of_head`, `rate`, `amount`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BKI20220801091456', '1', 5, 8, 40.00, NULL, NULL, '2022-08-01 03:44:56', '2022-08-01 03:44:56'),
(2, 'BKI20220801091456', '2', 5, 154, 770.00, NULL, NULL, '2022-08-01 03:44:56', '2022-08-01 03:44:56'),
(3, 'BKI20220802060750', '1', 2, 8, 16.00, NULL, NULL, '2022-08-02 00:37:50', '2022-08-02 00:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `td_room_payment`
--

CREATE TABLE `td_room_payment` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(100) NOT NULL,
  `amount` double(100,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_made_by` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_room_payment`
--

INSERT INTO `td_room_payment` (`id`, `booking_id`, `amount`, `payment_date`, `payment_made_by`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'BKI20220802060750', 1100.00, '2022-08-02 10:53:18', 'Cash', NULL, NULL, '2022-08-02 05:23:18', '2022-08-02 05:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `td_users`
--

CREATE TABLE `td_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `active` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `td_users`
--

INSERT INTO `td_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile_no`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Chittaranjan  Maity', 'demo@gmail.com', NULL, '$2y$10$jf07lz9h.QSgZw86UZ1PFOdpdApptuo.hj2/xvaS9C5aE9Y3rf2YC', 1245789852, 'A', NULL, '2022-05-31 06:26:24', '2022-05-31 06:26:24'),
(2, 'Chittaranjan  Maity', 'test@gmail.com', NULL, '$2y$10$6koKaiGZpRSCVHqmZHjlTuC4D0063KNI4osBQEDJ2F8D/mn4mWGFu', 1245789852, 'A', NULL, '2022-05-31 06:28:20', '2022-05-31 06:28:20'),
(3, 'Chittaranjan  Maity', 'chittaranjan@synergicsoftek.com', NULL, '$2y$10$Syx5nr3Cwb4smEIo8vuV4OhvBPEYNg1ChAnaLHd6AipW/7lnA965y', 1245789852, 'A', NULL, '2022-05-31 06:33:51', '2022-05-31 06:33:51'),
(4, 'Chittaranjan  Maity', 'chittaranjan+1@synergicsoftek.com', NULL, '$2y$10$XMfDYZOiHeUz4Q2FRTFRauaOs0EB5F.qzqCgRybXWLmqIY3lNjyAi', 1245789852, 'A', NULL, '2022-06-01 05:41:40', '2022-06-01 05:41:40'),
(5, 'test  test', 'cmaity905@gmail.com', NULL, '$2y$10$XBs14FMrCcsGF4uiiiQ6J.lOVbGGAZXW5F7N5NtuPuRk9TZlxgKWC', 1234567895, 'A', NULL, '2022-06-06 01:17:15', '2022-06-06 01:17:15'),
(7, 'gbtrg  gfbfft', 'dfg@dgherh.drte', NULL, '$2y$10$9gqFvxKFmphOf8anvY2mfud.8FAkpv5yVELNd0mZJ5m13Zz5XUH02', 3434343434, 'A', NULL, '2022-06-13 03:55:12', '2022-06-13 03:55:12'),
(8, 'dfgd gfbfb gfbngdb', 'fdfdgd@estyedu.tttr', NULL, '$2y$10$r3J5XbvaIbj/3f1ZHOJ3euKs3V7ZUtgRO7f1S4pCTzBKGPR6tpYP.', 1212121212, 'A', NULL, '2022-06-17 00:28:19', '2022-06-17 00:28:19'),
(9, 'dzvfdzbv dfzbvfdzgvfd gvdfzgvf', 'dsvgdf@exdghj.hhfh', NULL, '$2y$10$8dipef5f0uY0my6qzI.Ry.wCfVcM9ZiEwuCFvyJqiVajyefmr4SXG', 1212121212, 'A', NULL, '2022-06-17 06:14:53', '2022-06-17 06:14:53'),
(10, 'dfvgb gfbgfbgf bgfbf', 'gfbgsvg', NULL, '$2y$10$C9.OJNf5O.L8U2OW1kv68uGqrJHFwdvERPEtYgbv6I4pTc3lO9wAq', 0, 'A', NULL, '2022-06-21 07:37:05', '2022-06-21 07:37:05'),
(11, 'rfgvregvre gvregvergrae gregfe', 'dfbgb@egddj.fghgh', NULL, '$2y$10$NMwf9KQd6eAjB9Gc5alZtuoGKbVkbqt3EycUWqOfntsBvTI/RZuua', 1234567898, 'A', NULL, '2022-06-27 01:42:43', '2022-06-27 01:42:43'),
(12, 'fdbdfb dfbb fdbfdb', 'dfbdge@xhdh.vhft', NULL, '$2y$10$SUplI084GrmYEsoM8Fz4l.cNKy.iqPE6yhrm59hVYHTwet8V9cy2G', 1212121212, 'A', NULL, '2022-07-27 00:09:19', '2022-07-27 00:09:19'),
(13, 'fdbdfbd fdfbdb brdfd', 'dfbdf@bdg.yg', NULL, '$2y$10$idlSTLz5sbDaX7tLRz4KmuHAof33KEAPqzRk0DmSCJwXCFag3cckG', 8989898989, 'A', NULL, '2022-07-27 04:34:43', '2022-07-27 04:34:43'),
(14, 'sg bvfdbdfbfd bdfbdfvdf', 'bb@dxzgderg.tht', NULL, '$2y$10$BV/GrqcH0JR8NiBDgyzrjOlJgDiQr2ZmUq2FKIUBit090WQEhSO5e', 7878787890, 'A', NULL, '2022-07-27 04:44:15', '2022-07-27 04:44:15'),
(15, 'vzdfvv  fxvdv', 'cbdfbd@asgreh.frtd', NULL, '$2y$10$VpA/uHn7cnbeFRf9FVa5geKf7Q9uJOBaEpRu5306XC7O6rNjcTkSS', 6777777788, 'A', NULL, '2022-07-27 04:54:00', '2022-07-27 04:54:00'),
(16, 'vsd  sfgvsfg', 'dfbdf@fdhdtj.fesf', NULL, '$2y$10$rCQ3tx0TXuK7iEjY9mx0gu8TxrdQQz5uNwhB1R3HVKjS3Cr0sHoSW', 1423521414, 'A', NULL, '2022-07-27 05:03:27', '2022-07-27 05:03:27'),
(17, 'svdfrgvg  fbfb', 'ddsgdsg@wshdej.gjyfj', NULL, '$2y$10$ResKbYOLdY3F5DwJA5rUyeQDLiOCtNjw5oLyVEbfbSOk6VSnmBySq', 1212121212, 'A', NULL, '2022-07-27 05:07:05', '2022-07-27 05:07:05'),
(18, 'dfbgfbgfb  gfbfgb', 'fgbndfsnd@awgseh.ghd', NULL, '$2y$10$ga93GSPIACC5qJV0eZPTs.X.DFxvlevNKl/wWmvRt0tpbvLZW/fYa', 1212121212, 'A', NULL, '2022-07-27 05:09:22', '2022-07-27 05:09:22'),
(19, 'dgfdbb fxbdb fbb', 'dfbdgtnb@fdgreb.tf', NULL, '$2y$10$xSYmiPBK8s9mDe2nxo4zXeK6DwW9iWfaVcXhmwrlXz.6eqwSmgDEu', 1212121212, 'A', NULL, '2022-07-27 05:30:05', '2022-07-27 05:30:05'),
(20, 'asfsdv vdfvd', 'test02@gmail.com', NULL, '$2y$10$Jbec0QROfJtstWF3LmF0pebUOQ9bWLK7ObPl4quMJEO0QDaoYMMde', 1212121212, 'A', NULL, '2022-07-27 05:39:23', '2022-07-27 05:39:23'),
(21, 'xdvfxv dvdfsvdsv', 'dsgraga@htj.ghft', NULL, '$2y$10$Nm2MNhYQEeCG3OvfqEEKv.iK/0qCBYoDtFTHsp4IxJ8uK.hvPz5xy', 2323232334, 'A', NULL, '2022-07-27 23:46:38', '2022-07-27 23:46:38'),
(22, 'afwaf  dfgrsg', 'hyfctuti@zsfgss.hfdh', NULL, '$2y$10$AhvC0eL6Xbfp7sVnAwcBneSzs/VcHtixrjB1AbKzZJeZsY0KkHV7a', 1212121212, 'A', NULL, '2022-07-28 23:58:50', '2022-07-28 23:58:50'),
(23, 'bfdbvdb dfbdb bd', 'dvfdbd@egeh.fghh', NULL, '$2y$10$u/630ujfdxjbFEo/Ml013O1Ln6/NJwaWeXHHz91oNssjSPQUlmcx6', 1212121245, 'A', NULL, '2022-07-29 00:03:16', '2022-07-29 00:03:16'),
(24, 'dvsvv fdbfdb', 'admin@gmail.com', NULL, '$2y$10$zLOQkMoOSDKZtGJtYznEeuxSH.wLd87ESvLQdHjCwnnUU/oO1bbIy', 121212121, 'A', NULL, '2022-07-29 00:18:35', '2022-07-29 00:18:35'),
(25, 'sdvds vsvs', 'fvfvs@dgerh.yhfhf', NULL, '$2y$10$KnN1JH5iTCpwtFDTD5qsM.HlKhjx.QWSIRYzTYjuRVVqeAvswbyI.', 1212121212, 'A', NULL, '2022-07-29 00:20:41', '2022-07-29 00:20:41'),
(26, 'ftdft  ftftyf', 'drydd@vghfty.hgh', NULL, '$2y$10$8tplr2Au2jB.5Fs3h1LlXOGeAUX057z.fB3vQQvftRB.poVZTiFPm', 1212121212, 'A', NULL, '2022-07-29 03:55:17', '2022-07-29 03:55:17'),
(36, 'Chitta', 'cmaity905+3@gmail.com', NULL, '$2y$10$qOWIhcY0hb3TxvDp6DIzoOsf2BFxO5vLVrm2Y8QZnBqc8ZkP5rXpy', 0, 'A', NULL, '2022-08-03 02:15:54', '2022-08-03 02:15:54'),
(42, 'Chitta', 'cmaity905+10@gmail.com', NULL, '$2y$10$P0aIehGec0wOfvawcnrOqeNmTI2gJB5gGsPmkm5dJ1HQ2yBocD.fq', 0, 'A', NULL, '2022-08-03 02:23:23', '2022-08-03 02:23:23'),
(43, 'Chitta', 'cmaity905+5@gmail.com', NULL, '$2y$10$N5zvv8nB8y9ZERF6Y7qaVuMW2LEv1qjYDbDQAX5LyCAPSz3vJuFym', 0, 'A', NULL, '2022-08-03 04:08:46', '2022-08-03 04:08:46'),
(44, 'Chitta', 'cmaity905+7@gmail.com', NULL, '$2y$10$pSqJBD6v2rWiE.9AZrRzMO.sXZXwVy2gKPVBPBU.OxASoY14SNLGe', 0, 'A', NULL, '2022-08-03 04:26:09', '2022-08-03 04:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('S','A') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, '$2y$10$p7jZ.aXyiEZj7/DzRX/v8edDi9l7ClNRKG2XEEtE2IOirR.PaieXS', 'S', 'A', NULL, '2022-05-25 04:08:13', '2022-05-25 04:08:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `md_cancel_plan`
--
ALTER TABLE `md_cancel_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_caution_money`
--
ALTER TABLE `md_caution_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_documents`
--
ALTER TABLE `md_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_hall_rent`
--
ALTER TABLE `md_hall_rent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_location`
--
ALTER TABLE `md_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_menu`
--
ALTER TABLE `md_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_params`
--
ALTER TABLE `md_params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_room`
--
ALTER TABLE `md_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_room_charge`
--
ALTER TABLE `md_room_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_room_rent`
--
ALTER TABLE `md_room_rent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_room_type`
--
ALTER TABLE `md_room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_rules`
--
ALTER TABLE `md_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_states`
--
ALTER TABLE `md_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `td_hall_book`
--
ALTER TABLE `td_hall_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_hall_book_details`
--
ALTER TABLE `td_hall_book_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_hall_lock`
--
ALTER TABLE `td_hall_lock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_hall_menu`
--
ALTER TABLE `td_hall_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_hall_payment`
--
ALTER TABLE `td_hall_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_room_book`
--
ALTER TABLE `td_room_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_room_book_details`
--
ALTER TABLE `td_room_book_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_room_lock`
--
ALTER TABLE `td_room_lock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_room_menu`
--
ALTER TABLE `td_room_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_room_payment`
--
ALTER TABLE `td_room_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_users`
--
ALTER TABLE `td_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `md_cancel_plan`
--
ALTER TABLE `md_cancel_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `md_caution_money`
--
ALTER TABLE `md_caution_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `md_documents`
--
ALTER TABLE `md_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `md_hall_rent`
--
ALTER TABLE `md_hall_rent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `md_location`
--
ALTER TABLE `md_location`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `md_menu`
--
ALTER TABLE `md_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `md_params`
--
ALTER TABLE `md_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `md_room`
--
ALTER TABLE `md_room`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `md_room_charge`
--
ALTER TABLE `md_room_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `md_room_rent`
--
ALTER TABLE `md_room_rent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `md_room_type`
--
ALTER TABLE `md_room_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `md_rules`
--
ALTER TABLE `md_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `md_states`
--
ALTER TABLE `md_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_hall_book`
--
ALTER TABLE `td_hall_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_hall_book_details`
--
ALTER TABLE `td_hall_book_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_hall_lock`
--
ALTER TABLE `td_hall_lock`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_hall_menu`
--
ALTER TABLE `td_hall_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_hall_payment`
--
ALTER TABLE `td_hall_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `td_room_book`
--
ALTER TABLE `td_room_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_room_book_details`
--
ALTER TABLE `td_room_book_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_room_lock`
--
ALTER TABLE `td_room_lock`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_room_menu`
--
ALTER TABLE `td_room_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `td_room_payment`
--
ALTER TABLE `td_room_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_users`
--
ALTER TABLE `td_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
