-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 08:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_role`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Create Post', NULL, NULL),
(2, 'Edit Post', NULL, NULL),
(4, 'Delete Post', NULL, NULL),
(5, 'Publish Post', NULL, NULL),
(6, 'All', NULL, NULL);

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_13_154753_alter_users_table', 1),
(6, '2025_04_18_143431_create_role_table', 2),
(7, '2025_04_18_143539_add_role_id_to_users_table', 3),
(8, '2025_04_18_144410_create_action_table', 4),
(9, '2025_04_19_054358_create_post_table', 5),
(10, '2025_04_19_062217_add_status_to_post_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `heading`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'First Blog', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti odit alias recusandae odio rem? Soluta, unde laborum quae ea reiciendis ratione quos dolore, reprehenderit vel, distinctio consequuntur maxime earum labore! Asperiores libero quidem odio obcaecati odit? Amet ipsam blanditiis saepe tempora? Veniam velit sequi enim iure ullam veritatis necessitatibus corrupti sit quisquam repellat repellendus accusantium illo, omnis, facilis eaque distinctio tenetur amet libero. Nesciunt ad labore dolorum. Dolore minus aut ipsam voluptatem in rerum eos, nam libero, temporibus dolorem nisi necessitatibus quo saepe vero eius. Reprehenderit consequuntur totam pariatur ratione beatae ipsam, officiis quia delectus hic debitis, omnis laborum similique!</p>', 0, '2025-04-19 01:30:13', '2025-04-20 01:11:43'),
(4, 'Second Blog', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti odit alias recusandae odio rem? Soluta, unde laborum quae ea reiciendis ratione quos dolore, reprehenderit vel, distinctio consequuntur maxime earum labore! Asperiores libero quidem odio obcaecati odit? Amet ipsam blanditiis saepe tempora? Veniam velit sequi enim iure ullam veritatis necessitatibus corrupti sit quisquam repellat repellendus accusantium illo, omnis, facilis eaque distinctio tenetur amet libero. Nesciunt ad labore dolorum. Dolore minus aut ipsam voluptatem in rerum eos, nam libero, temporibus dolorem nisi necessitatibus quo saepe vero eius. Reprehenderit consequuntur totam pariatur ratione beatae ipsam, officiis quia delectus hic debitis, omnis laborum similique!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti odit alias recusandae odio rem? Soluta, unde laborum quae ea reiciendis ratione quos dolore, reprehenderit vel, distinctio consequuntur maxime earum labore! Asperiores libero quidem odio obcaecati odit? Amet ipsam blanditiis saepe tempora? Veniam velit sequi enim iure ullam veritatis necessitatibus corrupti sit quisquam repellat repellendus accusantium illo, omnis, facilis eaque distinctio tenetur amet libero. Nesciunt ad labore dolorum. Dolore minus aut ipsam voluptatem in rerum eos, nam libero, temporibus dolorem nisi necessitatibus quo saepe vero eius. Reprehenderit consequuntur totam pariatur ratione beatae ipsam, officiis quia delectus hic debitis, omnis laborum similique!</p>', 0, '2025-04-19 01:36:15', '2025-04-20 01:11:55'),
(5, 'Third Blog', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti odit alias recusandae odio rem? Soluta, unde laborum quae ea reiciendis ratione quos dolore, reprehenderit vel, distinctio consequuntur maxime earum labore! Asperiores libero quidem odio obcaecati odit? Amet ipsam blanditiis saepe tempora? Veniam velit sequi enim iure ullam veritatis necessitatibus corrupti sit quisquam repellat repellendus accusantium illo, omnis, facilis eaque distinctio tenetur amet libero. Nesciunt ad labore dolorum. Dolore minus aut ipsam voluptatem in rerum eos, nam libero, temporibus dolorem nisi necessitatibus quo saepe vero eius. Reprehenderit consequuntur totam pariatur ratione beatae ipsam, officiis quia delectus hic debitis, omnis laborum similique!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti odit alias recusandae odio rem? Soluta, unde laborum quae ea reiciendis ratione quos dolore, reprehenderit vel, distinctio consequuntur maxime earum labore! Asperiores libero quidem odio obcaecati odit? Amet ipsam blanditiis saepe tempora? Veniam velit sequi enim iure ullam veritatis necessitatibus corrupti sit quisquam repellat repellendus accusantium illo, omnis, facilis eaque distinctio tenetur amet libero. Nesciunt ad labore dolorum. Dolore minus aut ipsam voluptatem in rerum eos, nam libero, temporibus dolorem nisi necessitatibus quo saepe vero eius. Reprehenderit consequuntur totam pariatur ratione beatae ipsam, officiis quia delectus hic debitis, omnis laborum similique!</p>', 0, '2025-04-19 08:08:10', '2025-04-20 01:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `action`, `created_at`, `updated_at`) VALUES
(1, 'Editor', '2', '2025-04-18 09:54:33', '2025-04-19 01:45:21'),
(4, 'Creator', '1', '2025-04-18 11:16:02', '2025-04-19 15:41:15'),
(5, 'Admin', '6', '2025-04-18 11:16:29', '2025-04-19 07:12:57'),
(8, 'Publisher', '1,5', '2025-04-19 07:13:11', '2025-04-19 07:14:02'),
(9, 'test', '4,5', '2025-04-20 01:09:16', '2025-04-20 01:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 5, 'Admin', 'admin@gmail.com', '$2y$10$x9VwTNpa.oX7qCXyXmJU3uOUbehROUsIxG1pel.78dhmJ/75rwXNu', NULL, '2025-04-19 06:43:35', '2025-04-19 08:01:49'),
(14, 4, 'Robert', 'robert@gmail.com', '$2y$10$ox7vqlAOokRpS1LnlLMw3eFltlfa7YQjsLYjRhjD1ckx07Ol0.Awe', NULL, '2025-04-19 10:55:03', '2025-04-19 10:55:03'),
(15, 1, 'Kelvin', 'kelvin@gmail.com', '$2y$10$/ibP7e6Y0E2/2.Crory0JOqe9FjgKq9uh1gaOlWeZrXz.Gzmit0xG', NULL, '2025-04-19 10:55:27', '2025-04-19 10:55:27'),
(16, 8, 'Mic', 'mic@gmail.com', '$2y$10$EOCwocO2jMOLpNBa/mIUKeQewkg6RNm9ow4/yhdc7SPrSFdcNk1le', NULL, '2025-04-19 11:08:47', '2025-04-19 11:08:47'),
(17, 5, 'John', 'john@gmail.com', '$2y$10$vW7ca1mkFlksarHagsSbju.a6ZrbqyTiS/mKPRLK01jo665f4ocP6', NULL, '2025-04-19 11:09:30', '2025-04-19 11:09:30'),
(18, 9, 'test', 'test@gmail.com', '$2y$10$IqMJc0xy/0N0zqMKrCtDd.RnZ0SxrICtL2nCrP.vcQF.FgQfI84na', NULL, '2025-04-20 01:08:59', '2025-04-20 01:09:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
