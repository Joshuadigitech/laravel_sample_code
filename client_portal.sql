-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2018 at 02:09 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_company`
--

CREATE TABLE `client_company` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_zip` int(11) NOT NULL,
  `company_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_employees` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_request`
--

CREATE TABLE `client_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `exp_level` int(11) NOT NULL,
  `services_type` int(11) NOT NULL,
  `number_of` int(11) NOT NULL DEFAULT '1',
  `skills` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `WeeklyHours_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `comment_by` int(11) NOT NULL,
  `is_update` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exp_level`
--

CREATE TABLE `exp_level` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exp_level`
--

INSERT INTO `exp_level` (`id`, `name`) VALUES
(1, '1~2 year'),
(2, '2~3 year'),
(3, '3+ year');

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
(138, '2018_04_18_072310_create_users_table', 1),
(139, '2018_04_18_075751_create_roles_table', 1),
(140, '2018_04_25_124644_cm_allocation', 1),
(141, '2018_04_25_125531_service_type', 1),
(142, '2018_04_28_085318_client_request', 1),
(143, '2018_04_28_090013_exp_level', 1),
(144, '2018_05_01_085127_pricing', 1),
(145, '2018_05_03_070348_client_company', 1),
(146, '2018_05_03_103942_project', 1),
(147, '2018_05_03_110503_task', 1),
(148, '2018_05_03_111014_task_allocation', 1),
(149, '2018_05_03_111808_task_working', 1),
(150, '2018_05_03_112839_task_media', 1),
(151, '2018_05_03_114032_comment', 1),
(152, '2018_05_19_052848_weekly_hours', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `id` int(10) UNSIGNED NOT NULL,
  `level_id` int(11) NOT NULL,
  `level_price` int(11) NOT NULL,
  `is_activate` tinyint(4) NOT NULL DEFAULT '1',
  `from` date NOT NULL,
  `to` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `level_id`, `level_price`, `is_activate`, `from`, `to`) VALUES
(1, 1, 8, 1, '2018-06-06', NULL),
(2, 2, 10, 1, '2018-06-06', NULL),
(3, 3, 12, 1, '2018-06-06', NULL),
(4, 4, 15, 1, '2018-06-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT '0',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_allocation`
--

CREATE TABLE `resource_allocation` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '1',
  `allocation_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'client', NULL, NULL),
(2, 'CM', NULL, NULL),
(3, 'HR', NULL, NULL),
(4, 'director', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`) VALUES
(1, 'Ad Hoc'),
(3, 'Full Time'),
(2, 'Part Time');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT '0',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_allocation`
--

CREATE TABLE `task_allocation` (
  `id` int(10) UNSIGNED NOT NULL,
  `cm_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_media`
--

CREATE TABLE `task_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `is_description` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_working`
--

CREATE TABLE `task_working` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `is_break` tinyint(4) NOT NULL DEFAULT '0',
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `role_id`, `avatar`, `phone`, `address`, `city`, `state`, `zip`, `country`, `joining_date`, `is_deleted`, `is_approved`, `bio`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zee', 'HR', 'zee@hr.com', '$2y$10$MgO/idbcp0XUKKLZeAeRauImj8gSfnG9g6Nyq7Roz9PT.iAImYNry', 'male', 3, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, '2018-06-06', 0, 1, NULL, NULL, NULL, NULL),
(2, 'zee', 'admin', 'zee@admin.com', '$2y$10$mqRI1U3hA7wBFU69sWGw0eLQ5zL5EAjh4QCYLN7le5oQqFs8cprLq', 'male', 4, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, '2018-06-06', 0, 1, NULL, NULL, NULL, NULL),
(3, 'zee', 'CM', 'zee@cm.com', '$2y$10$oPFC.n7ohj8eXzQ9E0jhLu3.PQfX6qW6nBU0WWi9.Y3n4XxX.IS0S', 'male', 2, NULL, '123456789', NULL, NULL, NULL, NULL, NULL, '2018-06-06', 0, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weeklyhours`
--

CREATE TABLE `weeklyhours` (
  `id` int(10) UNSIGNED NOT NULL,
  `Monday` int(11) DEFAULT NULL,
  `Tuesday` int(11) DEFAULT NULL,
  `Wednesday` int(11) DEFAULT NULL,
  `Thursday` int(11) DEFAULT NULL,
  `Friday` int(11) DEFAULT NULL,
  `Saturday` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_company`
--
ALTER TABLE `client_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_request`
--
ALTER TABLE `client_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_level`
--
ALTER TABLE `exp_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_allocation`
--
ALTER TABLE `resource_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_allocation`
--
ALTER TABLE `task_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_media`
--
ALTER TABLE `task_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_working`
--
ALTER TABLE `task_working`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weeklyhours`
--
ALTER TABLE `weeklyhours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_company`
--
ALTER TABLE `client_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_request`
--
ALTER TABLE `client_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exp_level`
--
ALTER TABLE `exp_level`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_allocation`
--
ALTER TABLE `resource_allocation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_allocation`
--
ALTER TABLE `task_allocation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_media`
--
ALTER TABLE `task_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_working`
--
ALTER TABLE `task_working`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weeklyhours`
--
ALTER TABLE `weeklyhours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
