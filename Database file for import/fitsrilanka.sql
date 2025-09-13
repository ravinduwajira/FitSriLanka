-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 08:27 PM
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
-- Database: `fitsrilanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('nbn@gmail.com|127.0.0.1', 'i:1;', 1734047724),
('nbn@gmail.com|127.0.0.1:timer', 'i:1734047724;', 1734047724);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(12, 16, 9, 'Food trends evolve with time.', '2024-12-12 12:04:02', '2024-12-12 12:04:02'),
(13, 16, 7, 'Cooking is both a science and an art.', '2024-12-12 12:04:40', '2024-12-12 12:04:40'),
(15, 16, 9, 'Yep True', '2025-01-24 18:59:59', '2025-01-24 18:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_one_id` bigint(20) UNSIGNED NOT NULL,
  `user_two_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `fastingtrackers`
--

CREATE TABLE `fastingtrackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fasting_plan` varchar(50) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fastingtrackers`
--

INSERT INTO `fastingtrackers` (`id`, `user_id`, `fasting_plan`, `start_time`, `end_time`, `duration`, `created_at`, `updated_at`) VALUES
(9, 9, '16/8 Fasting', '2024-10-01 23:52:38', '2024-10-02 09:12:56', '09:20:03', '2024-10-01 23:52:38', '2024-10-02 09:12:56'),
(11, 16, '16/8 Fasting', '2024-10-07 21:29:12', '2024-10-07 21:29:48', '00:00:34', '2024-10-07 21:29:12', '2024-10-07 21:29:48'),
(12, 9, '16/8 Fasting', '2024-10-09 05:58:25', '2024-10-09 05:58:34', '00:00:06', '2024-10-09 05:58:25', '2024-10-09 05:58:34'),
(13, 9, '16/8 Fasting', '2024-10-09 06:06:15', '2024-10-09 06:06:26', '00:00:08', '2024-10-09 06:06:15', '2024-10-09 06:06:26'),
(14, 9, '12/12 Fasting', '2024-10-09 06:11:49', '2024-10-09 06:11:56', '00:00:05', '2024-10-09 06:11:49', '2024-10-09 06:11:56'),
(15, 9, '14/10 Fasting', '2024-10-09 06:12:04', '2024-10-09 06:12:13', '00:00:07', '2024-10-09 06:12:04', '2024-10-09 06:12:13'),
(16, 9, '18/6 Fasting', '2024-10-09 06:15:57', '2024-10-09 06:16:04', '00:00:06', '2024-10-09 06:15:57', '2024-10-09 06:16:04'),
(17, 9, '20/4 Fasting', '2024-10-09 06:37:41', '2024-10-09 06:38:01', '00:00:18', '2024-10-09 06:37:41', '2024-10-09 06:38:01'),
(18, 9, '20/4 Fasting', '2024-10-09 06:38:09', '2024-10-09 08:31:17', '01:53:02', '2024-10-09 06:38:09', '2024-10-09 08:31:17'),
(19, 9, '14/10 Fasting', '2024-10-09 08:31:44', '2024-10-09 22:34:16', '14:02:29', '2024-10-09 08:31:44', '2024-10-09 22:34:16'),
(20, 9, '16/8 Fasting', '2024-10-10 03:06:06', '2024-10-10 09:11:28', '06:05:13', '2024-10-10 03:06:06', '2024-10-10 09:11:28'),
(22, 9, '16/8 Fasting', '2024-12-09 18:27:58', '2024-12-09 18:29:26', '00:01:26', '2024-12-09 18:27:58', '2024-12-09 18:29:26'),
(25, 9, '16/8 Fasting', '2024-12-12 09:08:03', '2024-12-12 16:15:10', '07:07:05', '2024-12-12 09:08:03', '2024-12-12 16:15:10'),
(28, 9, '16/8 Fasting', '2025-01-24 18:45:30', '2025-01-25 02:51:14', '08:05:37', '2025-01-24 18:45:30', '2025-01-25 02:51:14'),
(29, 9, '16/8 Fasting', '2025-01-25 02:51:45', '2025-01-25 03:41:05', NULL, '2025-01-25 02:51:45', '2025-01-25 03:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `fitness_centers`
--

CREATE TABLE `fitness_centers` (
  `fitnesscenterid` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `monthly_fee` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fitness_centers`
--

INSERT INTO `fitness_centers` (`fitnesscenterid`, `professional_id`, `name`, `address`, `monthly_fee`, `created_at`, `updated_at`) VALUES
(6, 4, 'Power House', 'Hingurakgoda', 3000.00, '2024-09-22 13:45:17', '2024-09-22 13:45:17'),
(8, 4, 'Sky', 'Kandy', 5000.00, '2024-09-22 13:55:12', '2024-09-22 13:55:12'),
(10, 8, 'Fruits', 'abcdfgh', 3500.00, '2024-10-08 03:15:12', '2024-12-10 20:41:45'),
(12, 8, 'BLUE SAPPHIRE new', 'Hingurakgoda', 3000.00, '2024-10-09 08:33:40', '2025-01-25 03:07:11'),
(14, 8, 'test', 'dsvfsdf', 3000.00, '2025-01-25 03:06:39', '2025-01-25 03:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `fitness_center_enrollments`
--

CREATE TABLE `fitness_center_enrollments` (
  `fc_enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `fitness_center_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `enrollment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fitness_center_enrollments`
--

INSERT INTO `fitness_center_enrollments` (`fc_enrollment_id`, `fitness_center_id`, `user_id`, `user_name`, `enrollment_status`, `created_at`, `updated_at`) VALUES
(5, 6, 16, NULL, 'enrolled', '2024-10-07 21:13:01', '2024-10-07 21:13:01'),
(6, 6, 21, NULL, 'enrolled', '2024-10-09 17:54:05', '2024-10-09 17:54:05'),
(7, 6, 14, NULL, 'enrolled', '2024-10-10 04:08:26', '2024-10-10 04:08:26'),
(8, 6, 26, NULL, 'enrolled', '2024-10-10 09:04:16', '2024-10-10 09:04:16'),
(11, 8, 9, NULL, 'enrolled', '2024-12-11 09:36:30', '2024-12-11 09:36:30'),
(12, 8, 35, NULL, 'enrolled', '2025-01-25 02:44:56', '2025-01-25 02:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `health_statuses`
--

CREATE TABLE `health_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blood_glucose` decimal(5,2) DEFAULT NULL,
  `cholesterol_level` decimal(5,2) DEFAULT NULL,
  `sleep` decimal(4,1) DEFAULT NULL,
  `water_intake` decimal(4,2) DEFAULT NULL,
  `start_weight` decimal(5,2) DEFAULT NULL,
  `current_weight` decimal(5,2) DEFAULT NULL,
  `goal_weight` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_statuses`
--

INSERT INTO `health_statuses` (`id`, `user_id`, `blood_glucose`, `cholesterol_level`, `sleep`, `water_intake`, `start_weight`, `current_weight`, `goal_weight`, `created_at`, `updated_at`) VALUES
(1, 9, 116.00, 174.00, 6.0, 4.00, 118.00, 104.00, 72.00, '2024-10-02 20:24:44', '2024-10-02 20:24:44'),
(4, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 103.00, 71.00, '2024-10-02 20:33:40', '2024-10-02 20:33:40'),
(5, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 98.00, 71.00, '2024-10-05 18:12:11', '2024-10-05 18:12:11'),
(6, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 95.00, 71.00, '2024-10-05 20:06:26', '2024-10-05 20:06:26'),
(7, 16, 155.00, 176.00, 5.0, 6.00, 75.00, 75.00, 60.00, '2024-10-07 21:10:23', '2024-10-07 21:10:23'),
(8, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 100.00, 71.00, '2024-10-09 08:20:54', '2024-10-09 08:20:54'),
(9, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 75.00, 71.00, '2024-10-09 08:22:35', '2024-10-09 08:22:35'),
(10, 26, 170.00, 180.00, 5.0, 6.00, 93.00, 93.00, 76.00, '2024-10-10 09:05:09', '2024-10-10 09:05:09'),
(11, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 84.00, 71.00, '2024-10-10 09:13:38', '2024-10-10 09:13:38'),
(17, 9, 117.00, 173.00, 7.0, 5.00, 118.00, 105.00, 71.00, '2024-12-11 09:39:33', '2024-12-11 09:39:33');

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
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_plan_id` bigint(20) UNSIGNED NOT NULL,
  `meal_time` varchar(20) NOT NULL,
  `recipe_name` varchar(150) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ingredients` text NOT NULL,
  `nutritional_value` text NOT NULL,
  `recipe_instructions` text NOT NULL,
  `calorie_count` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `meal_plan_id`, `meal_time`, `recipe_name`, `photo`, `ingredients`, `nutritional_value`, `recipe_instructions`, `calorie_count`, `date`, `created_at`, `updated_at`) VALUES
(400, 23, 'Breakfast', 'Overnight Oats', 'uploads/meal_photos\\1733767825_67573291a0a5b.png', '1/2 cup rolled oats\r\n1/2 cup almond milk\r\n1 tbsp chia seeds\r\n1/2 cup mixed fruits', 'Protein: 6g\r\nCarbs: 30g\r\nFat: 5g', 'In a jar, combine oats, almond milk, and chia seeds.\r\nRefrigerate overnight.\r\nIn the morning, top with mixed fruits.', 600, '2024-12-12', '2024-12-12 11:42:19', '2024-12-12 11:42:19'),
(401, 23, 'Lunch', 'Chickpea Salad', 'uploads/meal_photos\\1733767825_6757329186478.png', '1 cup chickpeas\r\nDiced cucumber\r\nDiced tomatoes\r\nRed onion\r\nOlive oil, lemon juice, salt, and pepper', 'Protein: 10g\r\nCarbs: 35g\r\nFat: 10g', 'In a bowl, combine chickpeas, diced cucumber, tomatoes, and red onion.\r\nDrizzle with olive oil and lemon juice.\r\nSeason with salt and pepper and toss well.', 700, '2024-12-12', '2024-12-12 11:42:19', '2024-12-12 11:42:19'),
(402, 23, 'Dinner', 'Veggie Omelette', 'uploads/meal_photos\\1733937894_6759cae67a551.png', '2 large eggs\r\n1/4 cup diced bell peppers\r\n1/4 cup diced tomatoes\r\n1/4 cup spinach\r\nSalt and pepper to taste', 'Protein: 12g\r\nCarbs: 5g\r\nFat: 14g', 'Beat eggs with salt and pepper.\r\nHeat a non-stick pan, and sauté bell peppers and spinach until tender.\r\nPour the egg mixture over the veggies and cook until eggs are set.\r\nFold and serve.', 550, '2024-12-12', '2024-12-12 11:42:20', '2024-12-12 11:42:20'),
(403, 23, 'Breakfast', 'Quinoa and Black Bean Bowl', NULL, '1/2 cup cooked quinoa\r\n1/2 cup black beans', '1/2 cup cooked quinoa\r\n1/2 cup black beans', 'Combine cooked quinoa, black beans, corn, and diced avocado in a bowl.\r\nTop with salsa and mix well.', 400, '2024-12-13', '2024-12-12 11:42:20', '2024-12-12 11:42:20'),
(404, 23, 'Lunch', 'Stir-fried Tofu', NULL, '1 cup diced tofu\r\nMixed vegetables (broccoli, bell peppers, carrots)\r\nSoy sauce', 'Protein: 15g\r\nCarbs: 25g\r\nFat: 12g', 'Heat olive oil in a pan, and add diced tofu, cooking until golden brown.\r\nAdd mixed vegetables and stir-fry until tender.\r\nAdd soy sauce and mix well.', 650, '2024-12-13', '2024-12-12 11:42:20', '2024-12-12 11:42:20'),
(405, 23, 'Dinner', 'Beef Stir-fry', NULL, '1 cup sliced beef\r\n\r\nMixed vegetables (bell peppers, broccoli, carrots)\r\nSoy sauce, garlic, olive oil', 'Protein: 25g\r\n\r\nCarbs: 30g\r\nFat: 15g', 'Heat olive oil in a pan, and add sliced beef, cooking until browned.\r\nAdd mixed vegetables and stir-fry until tender.\r\nAdd soy sauce and garlic, and mix well.', 600, '2024-12-13', '2024-12-12 11:42:20', '2024-12-12 11:42:20'),
(406, 23, 'Breakfast', 'Berry Smoothie', NULL, '1 cup mixed berries\r\n1/2 cup Greek yogurt', 'Protein: 25g', 'Pour into a bowl and top with granola and sliced fruits.', 500, '2024-12-14', '2024-12-12 11:42:20', '2024-12-12 11:42:20'),
(407, 23, 'Lunch', 'Smoothie Bowl', NULL, '1 banana\r\n1/2 cup spinach', 'Protein: 8g\r\nCarbs: 35g', 'Pour into a bowl and top with granola and sliced fruits.', 550, '2024-12-14', '2024-12-12 11:42:20', '2024-12-12 11:42:20'),
(408, 23, 'Dinner', 'Chickpea Salad', NULL, '1 cup chickpeas', 'Protein: 10g\r\nCarbs: 35g', 'In a bowl, combine chickpeas', 600, '2024-12-14', '2024-12-12 11:42:21', '2024-12-12 11:42:21'),
(409, 23, 'Breakfast', 'Baked Chicken', NULL, '1 chicken breast\r\n1 sweet potato', 'Protein: 25g\r\nCarbs: 40g', 'Preheat oven to 375°F (190°C).', 700, '2024-12-15', '2024-12-12 11:42:21', '2024-12-12 11:42:21'),
(410, 23, 'Lunch', 'Avocado Toast', NULL, '1 slice whole grain bread\r\n1/2 avocado', 'Protein: 10g\r\nCarbs: 25g', 'Toast whole grain bread.', 550, '2024-12-15', '2024-12-12 11:42:21', '2024-12-12 11:42:21'),
(411, 23, 'Dinner', 'Tuna Salad', NULL, '1 can tuna (in water)', 'Protein: 20g', 'In a bowl, mix tuna with diced celery', 560, '2024-12-15', '2024-12-12 11:42:21', '2024-12-12 11:42:21'),
(412, 23, 'Breakfast', 'Veggie Omelette', NULL, '2 large eggs\r\n1/4 cup diced bell peppers', 'Protein: 12g\r\nCarbs: 5g', 'Beat eggs with salt and pepper.', 450, '2024-12-16', '2024-12-12 11:42:21', '2024-12-12 11:42:21'),
(413, 23, 'Lunch', 'Grilled Chicken Salad', NULL, '1 grilled chicken breast\r\nMixed greens', 'Protein: 30g\r\nCarbs: 10g', 'Grill chicken breast seasoned', 650, '2024-12-16', '2024-12-12 11:42:21', '2024-12-12 11:42:21'),
(414, 23, 'Dinner', 'Baked Salmon', NULL, '1 salmon fillet\r\n1/2 cup quinoa', 'Protein: 25g\r\nCarbs: 35g', 'Season salmon with salt', 550, '2024-12-16', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(415, 23, 'Breakfast', 'Greek Yogurt with Berries', NULL, '1 cup Greek yogurt\r\n1/2 cup mixed berries', 'Protein: 12g\r\nCarbs: 20g', 'In a bowl, combine Greek yogurt', 450, '2024-12-17', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(416, 23, 'Lunch', 'Quinoa and Black Bean', NULL, '1/2 cup cooked quinoa\r\n1/2 cup black beans', 'Protein: 12g\r\nCarbs: 45g', 'Combine cooked quinoa, black beans', 450, '2024-12-17', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(417, 23, 'Dinner', 'Stir-fried Tofu', NULL, '1 cup diced tofu\r\nMixed vegetables', 'Protein: 15g\r\nCarbs: 25g', 'Heat olive oil in a pan', 700, '2024-12-17', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(418, 23, 'Breakfast', 'Overnight Oats', NULL, '1/2 cup rolled oats\r\n1/2 cup almond milk', 'Protein: 6g\r\nCarbs: 30g', 'In a jar, combine oats, almond milk', 550, '2024-12-18', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(419, 23, 'Lunch', 'Turkey and Avocado', NULL, 'Whole wheat tortilla\r\nSliced turkey breast', 'Protein: 20g\r\nCarbs: 25g', 'On a whole wheat tortilla', 700, '2024-12-18', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(420, 23, 'Dinner', 'Shrimp and Asparagus Pasta', NULL, '1 cup whole wheat pasta\r\n1 cup shrimp', 'Protein: 20g\r\nCarbs: 50g', 'Cook whole wheat pasta', 600, '2024-12-18', '2024-12-12 11:42:22', '2024-12-12 11:42:22'),
(421, 24, 'Breakfast', 'Scrambled Eggs with Veggies', 'uploads/meal_photos\\1733767825_67573291a0a5b.png', 'Eggs, Spinach, Tomatoes, Onions, Olive Oil', 'High in protein, vitamins A and C, low in carbs', 'Heat olive oil in a pan.\r\nSauté onions and tomatoes until soft.\r\nAdd spinach and cook until wilted.\r\nBeat eggs, add to the pan, and scramble until fully cooked.', 650, '2025-01-25', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(422, 24, 'Lunch', 'Grilled Chicken Salad', 'uploads/meal_photos\\1737743591_6793dce73d15b.jpg', 'Chicken breast, lettuce, cucumber, olive oil, lemon', 'High in protein, low in fat', 'Grill chicken breast until fully cooked.\r\nMix lettuce, cucumber, olive oil, and lemon juice in a bowl.\r\nSlice chicken and place on top of salad.', 850, '2025-01-25', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(423, 24, 'Dinner', 'Baked Salmon with Asparagus', 'uploads/meal_photos\\1734003739_675acc1be8bfb.png', 'Salmon fillet, asparagus, olive oil, garlic', 'Rich in omega-3 fatty acids, vitamins', 'Preheat oven to 375°F.\r\nPlace salmon and asparagus on a baking sheet.\r\nDrizzle with olive oil and sprinkle garlic.\r\nBake for 20 minutes or until cooked.', 750, '2025-01-25', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(424, 24, 'Breakfast', 'Oatmeal with Berries', NULL, 'Oats, almond milk, blueberries, honey', 'High in fiber, antioxidants', 'Cook oats with almond milk.\r\nTop with blueberries and a drizzle of honey.', 550, '2025-01-26', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(425, 24, 'Lunch', 'Turkey Sandwich', NULL, 'Whole wheat bread, turkey breast, lettuce, mustard', 'High in protein, moderate in carbs', 'Layer turkey, lettuce, and mustard on bread.\r\nClose sandwich and serve.', 800, '2025-01-26', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(426, 24, 'Dinner', 'Stir-fried Veggies with Tofu', NULL, 'Tofu, broccoli, bell peppers, soy sauce, garlic', 'High in protein, rich in fiber', 'Stir-fry tofu in soy sauce and garlic.\r\nAdd vegetables and stir-fry until tender.', 500, '2025-01-26', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(427, 24, 'Breakfast', 'Greek Yogurt with Honey and Nuts', NULL, 'Greek yogurt, honey, mixed nuts', 'High in protein and healthy fats', 'Add honey and mixed nuts to Greek yogurt.', 400, '2025-01-27', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(428, 24, 'Lunch', 'Quinoa Salad with Chickpeas', NULL, 'Quinoa, chickpeas, cucumber, lemon, olive oil', 'High in protein, fiber, and vitamins', 'Cook quinoa and cool.\r\nMix quinoa with chickpeas, cucumber, lemon, and olive oil.', 900, '2025-01-27', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(429, 24, 'Dinner', 'Grilled Shrimp with Zucchini Noodles', NULL, 'Shrimp, zucchini, olive oil, garlic', 'Low carb, high protein', 'Grill shrimp with garlic and olive oil.\r\nSpiralize zucchini into noodles.\r\nToss zucchini noodles with shrimp.', 600, '2025-01-27', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(430, 24, 'Breakfast', 'Avocado Toast with Poached Eggs', NULL, 'Whole wheat bread, avocado, eggs, lemon juice', 'Rich in healthy fats, high in protein', 'Toast the bread.\r\nMash avocado and mix with lemon juice.\r\nPoach eggs and place on top of the avocado toast.', 650, '2025-01-28', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(431, 24, 'Lunch', 'Chicken and Veggie Stir-fry', NULL, 'Chicken breast, broccoli, bell peppers, soy sauce', 'High in protein and low in carbs', 'Stir-fry chicken with veggies in soy sauce until cooked.', 870, '2025-01-28', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(432, 24, 'Dinner', 'Grilled Veggie Skewers with Hummus', NULL, 'Zucchini, bell peppers, mushrooms, hummus', 'Low in calories, high in fiber', 'Thread vegetables onto skewers and grill.\r\nServe with a side of hummus.', 680, '2025-01-28', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(433, 24, 'Breakfast', 'Smoothie Bowl with Granola', NULL, 'Banana, berries, almond milk, granola', 'High in antioxidants and fiber', 'Blend banana, berries, and almond milk.\r\nPour into a bowl and top with granola.', 700, '2025-01-29', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(434, 24, 'Lunch', 'Tuna Salad', NULL, 'Canned tuna, lettuce, cucumber, olive oil, lemon', 'High in protein, low in carbs', 'Mix tuna with lettuce, cucumber, olive oil, and lemon juice.', 950, '2025-01-29', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(435, 24, 'Dinner', 'Spaghetti Squash with Marinara Sauce', NULL, 'Spaghetti squash, marinara sauce, garlic', 'Low carb, rich in vitamins', 'Roast spaghetti squash until tender.\r\nTop with marinara sauce and garlic.', 560, '2025-01-29', '2025-01-24 18:33:11', '2025-01-24 18:33:11'),
(436, 24, 'Breakfast', 'Chia Pudding with Almonds', NULL, 'Chia seeds, almond milk, honey, almonds', 'High in fiber and omega-3 fatty acids', 'Combine chia seeds with almond milk and honey, refrigerate overnight.\r\nTop with almonds before serving.', 670, '2025-01-30', '2025-01-24 18:33:12', '2025-01-24 18:33:12'),
(437, 24, 'Lunch', 'Grilled Veggie Wrap', NULL, 'Whole wheat tortilla, grilled vegetables, hummus', 'High in fiber and vitamins', 'Fill tortilla with grilled vegetables and hummus, then roll up.', 890, '2025-01-30', '2025-01-24 18:33:12', '2025-01-24 18:33:12'),
(438, 24, 'Dinner', 'Baked Chicken with Sweet Potato', NULL, 'Chicken breast, sweet potato, olive oil', 'High in protein and complex carbs', 'Bake chicken and sweet potato at 375°F for 30 minutes.', 620, '2025-01-30', '2025-01-24 18:33:12', '2025-01-24 18:33:12'),
(439, 24, 'Breakfast', 'Banana Pancakes', NULL, 'Bananas, eggs, baking powder', 'High in potassium and protein', 'Mash bananas and mix with eggs and baking powder.\r\nCook pancakes on a pan until golden brown.', 530, '2025-01-31', '2025-01-24 18:33:12', '2025-01-24 18:33:12'),
(440, 24, 'Lunch', 'Grilled Chicken Wrap with Avocado', NULL, 'grilled chicken, whole wheat tortilla, avocado, spinach', 'High in protein and healthy fats', 'Wrap grilled chicken, avocado, and spinach in a tortilla.', 940, '2025-01-31', '2025-01-24 18:33:12', '2025-01-24 18:33:12'),
(441, 24, 'Dinner', 'Cauliflower Rice Stir-fry', NULL, 'Cauliflower rice, peas, carrots, soy sauce', 'Low carb, high in fiber', 'Stir-fry cauliflower rice with peas, carrots, and soy sauce.', 770, '2025-01-31', '2025-01-24 18:33:12', '2025-01-24 18:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `meal_plans`
--

CREATE TABLE `meal_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_plans`
--

INSERT INTO `meal_plans` (`id`, `user_id`, `professional_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(23, 9, 8, '2024-12-12', '2024-12-18', '2024-12-12 11:42:19', '2024-12-12 11:42:19'),
(24, 9, 8, '2025-01-25', '2025-01-31', '2025-01-24 18:33:11', '2025-01-24 18:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 9, 8, 'asdfgh', '2024-11-27 01:51:34', '2024-11-27 01:51:34'),
(2, 9, 8, 'asdfgh', '2024-11-27 01:53:38', '2024-11-27 01:53:38'),
(3, 9, 8, 'hii', '2024-11-27 02:04:56', '2024-11-27 02:04:56'),
(4, 9, 8, 'hi 21', '2024-11-27 02:19:28', '2024-11-27 02:19:28'),
(5, 9, 1, 'hi admin', '2024-11-27 02:54:38', '2024-11-27 02:54:38'),
(6, 9, 20, 'hi manula', '2024-11-27 02:55:05', '2024-11-27 02:55:05'),
(7, 9, 20, 'hi manula', '2024-11-27 02:55:07', '2024-11-27 02:55:07'),
(8, 9, 20, 'hi 21', '2024-11-27 02:55:28', '2024-11-27 02:55:28'),
(9, 20, 9, 'hi ravinfu', '2024-11-27 02:59:58', '2024-11-27 02:59:58'),
(10, 9, 8, 'test 123', '2024-11-27 10:59:18', '2024-11-27 10:59:18'),
(11, 9, 20, 'hello', '2024-11-27 10:59:43', '2024-11-27 10:59:43'),
(12, 9, 1, 'hey', '2024-11-27 18:15:11', '2024-11-27 18:15:11'),
(13, 9, 20, 'hi', '2024-11-27 18:20:19', '2024-11-27 18:20:19'),
(14, 9, 1, 'hi', '2024-11-27 18:20:35', '2024-11-27 18:20:35'),
(15, 9, 1, 'hi', '2024-11-27 18:23:33', '2024-11-27 18:23:33'),
(16, 9, 1, 'yoo', '2024-11-27 18:23:45', '2024-11-27 18:23:45'),
(17, 9, 20, 'yooo', '2024-11-27 18:28:07', '2024-11-27 18:28:07'),
(18, 9, 4, '2222', '2024-11-27 18:30:17', '2024-11-27 18:30:17'),
(19, 9, 20, '11111111111111111111111111111111111', '2024-11-27 18:34:40', '2024-11-27 18:34:40'),
(20, 9, 4, 'hi', '2024-11-27 19:31:02', '2024-11-27 19:31:02'),
(21, 9, 4, 'hi', '2024-11-27 19:31:03', '2024-11-27 19:31:03'),
(22, 9, 5, 'hi', '2024-11-27 19:57:30', '2024-11-27 19:57:30'),
(23, 9, 6, 'hi mr', '2024-11-27 20:03:41', '2024-11-27 20:03:41'),
(24, 9, 1, 'hi', '2024-11-27 20:03:58', '2024-11-27 20:03:58'),
(25, 9, 1, 'name check', '2024-11-27 20:09:47', '2024-11-27 20:09:47'),
(26, 9, 4, 'name check 2', '2024-11-27 20:10:12', '2024-11-27 20:10:12'),
(27, 9, 12, 'hii', '2024-11-27 20:42:28', '2024-11-27 20:42:28'),
(28, 9, 12, 'zxzxzx', '2024-11-27 20:52:29', '2024-11-27 20:52:29'),
(29, 9, 15, '11', '2024-11-27 20:59:34', '2024-11-27 20:59:34'),
(30, 7, 9, 'hi', '2024-12-08 15:19:02', '2024-12-08 15:19:02'),
(31, 7, 9, 'test 2', '2024-12-08 15:29:37', '2024-12-08 15:29:37'),
(32, 4, 9, 'Hi Ravindu', '2024-12-08 15:37:59', '2024-12-08 15:37:59'),
(33, 8, 9, 'hello', '2025-01-24 16:29:53', '2025-01-24 16:29:53'),
(34, 9, 8, 'how are you', '2025-01-24 16:30:21', '2025-01-24 16:30:21'),
(66, 9, 12, '11111111111111111111111111111111111', '2025-01-24 17:32:45', '2025-01-24 17:32:45'),
(67, 9, 8, 'test', '2025-01-25 02:54:00', '2025-01-25 02:54:00');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(7, '2024_09_17_182545_create_user_infos_table', 2),
(10, '2024_09_18_081226_create_professional_infos_table', 3),
(11, '2024_09_22_063558_create_professional_enrollments_table', 4),
(12, '2024_09_22_165553_create_fitness_centers_table', 5),
(14, '2024_09_22_200510_create_fitness_center_enrollments_table', 6),
(19, '2024_09_23_185803_create_meal_plans_table', 7),
(20, '2024_09_23_190201_create_meals_table', 7),
(21, '2024_09_24_205158_create_workout_plans_table', 8),
(23, '2024_09_25_212822_create_workout_histories_table', 9),
(24, '2024_10_01_142648_create_fastingtrackers_table', 10),
(26, '2024_10_02_181045_create_events_table', 11),
(27, '2024_10_03_013750_create_health_statuses_table', 12),
(30, '2024_10_09_235618_create_tasks_table', 13),
(33, '2024_11_22_211448_create_messages_table', 15),
(34, '2024_12_04_020615_create_posts_table', 16),
(35, '2024_12_04_020842_create_comments_table', 16),
(36, '2024_12_07_031752_create_payments_table', 17),
(37, '2024_12_07_031810_create_revenues_table', 17),
(40, '2024_12_08_231522_create_user_feedbacks_table', 18),
(41, '2024_12_08_231536_create_professional_feedbacks_table', 18),
(42, '2024_11_22_211414_create_conversations_table', 19);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `admin_charge` decimal(10,2) NOT NULL DEFAULT 300.00,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `professional_id`, `amount`, `admin_charge`, `payment_date`, `created_at`, `updated_at`) VALUES
(6, 9, 8, 2500.00, 300.00, '2024-01-08', '2024-12-07 21:15:22', '2024-12-07 21:15:22'),
(7, 9, 8, 2500.00, 300.00, '2024-02-08', '2024-12-07 21:15:22', '2024-12-07 21:15:22'),
(8, 9, 8, 2500.00, 300.00, '2024-03-08', '2024-12-07 21:15:22', '2024-12-07 21:15:22'),
(9, 9, 8, 2500.00, 300.00, '2024-04-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(10, 9, 8, 2500.00, 300.00, '2024-05-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(11, 9, 8, 2500.00, 300.00, '2024-06-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(12, 9, 8, 2500.00, 300.00, '2024-07-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(13, 9, 8, 2500.00, 300.00, '2024-08-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(14, 9, 8, 2500.00, 300.00, '2024-09-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(15, 9, 8, 2500.00, 300.00, '2024-10-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(16, 9, 8, 2500.00, 300.00, '2024-11-08', '2024-12-07 21:15:23', '2024-12-07 21:15:23'),
(19, 9, 8, 8800.00, 300.00, '2024-12-12', '2024-12-12 17:15:09', '2024-12-12 17:15:09'),
(20, 9, 8, 8800.00, 300.00, '2025-01-25', '2025-01-25 02:59:55', '2025-01-25 02:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `image`, `likes`, `dislikes`, `created_at`, `updated_at`) VALUES
(16, 20, 'Share Your Go-To Nutritious Recipes!', 'Food is such a fascinating and vast topic! It encompasses everything from the nutrients we need to survive, to the diverse flavors and cuisines that bring joy and satisfaction.', '202412121730_article_7866255_foods-you-should-eat-every-week-to-lose-weight_-04-d58e9c481bce4a29b47295baade4072d.jpg', 21, 14, '2024-12-12 12:00:16', '2025-01-23 17:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `professionalinfo`
--

CREATE TABLE `professionalinfo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `certifications` text NOT NULL,
  `experience` int(11) NOT NULL,
  `specializations` text NOT NULL,
  `bio` text NOT NULL,
  `programs` text NOT NULL,
  `monthly_fee` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professionalinfo`
--

INSERT INTO `professionalinfo` (`id`, `birthday`, `age`, `certifications`, `experience`, `specializations`, `bio`, `programs`, `monthly_fee`, `created_at`, `updated_at`) VALUES
(4, '1986-06-10', 38, 'ABC Certified', 5, 'Gym Coach', 'Dedicated Professional', 'Nutritional Guidance', 2500, '2024-09-22 01:48:55', '2024-09-22 01:48:55'),
(8, '1994-05-01', 30, 'NASM Certified', 4, 'Sports Conditioning', 'Passionate Professional', 'Weight Loss Programs', 3700, '2024-09-22 01:51:10', '2025-01-25 03:01:39'),
(22, '2016-02-09', 8, 'EAP Certified', 3, 'Gym Coach', 'New Professional', 'Weight Loss Programs', 2450, '2024-10-10 00:01:22', '2024-10-10 00:01:22'),
(25, '1998-01-29', 26, 'Diploma in Fitness', 5, 'Fitness Workouts', 'Fitness Professional', 'Nutritional Guidance', 3200, '2024-10-10 04:22:13', '2024-10-10 04:22:13'),
(28, '1995-01-01', 29, 'AB certified', 10, 'Gym coach', 'Professional player', 'Fitness Training', 3500, '2024-12-12 16:44:04', '2024-12-12 16:44:04'),
(29, '2001-06-06', 23, 'CC Certified', 4, 'Nutrition Drinks', 'Professional coach', 'Fitness training', 2500, '2024-12-12 16:47:28', '2024-12-12 16:47:28'),
(30, '2024-12-13', 0, 'DA Certified', 2, 'Strength Training', 'Pro level coach.', 'weight loss programme', 2800, '2024-12-12 16:52:46', '2024-12-12 16:52:46'),
(32, '1999-02-10', 25, 'GH Certified', 6, 'Fitness Training', 'Pro professional', 'Strength training', 4000, '2024-12-12 17:01:19', '2024-12-12 17:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `professional_enrollments`
--

CREATE TABLE `professional_enrollments` (
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `professional_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `enrollment_status` enum('enrolled','unenrolled') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_enrollments`
--

INSERT INTO `professional_enrollments` (`enrollment_id`, `professional_id`, `user_id`, `professional_name`, `name`, `enrollment_status`, `created_at`, `updated_at`) VALUES
(1, 4, 9, 'Dr. Elton Nitzsche', 'ravindu wajira', 'unenrolled', '2024-09-22 04:46:47', '2024-09-22 15:17:22'),
(2, 8, 9, 'Miracle Gutmann', 'ravindu wajira', 'enrolled', '2024-09-22 15:08:09', '2024-12-10 18:23:44'),
(3, 4, 16, 'Dr. Elton Nitzsche', 'gggg', 'unenrolled', '2024-10-07 21:12:46', '2024-10-07 21:28:22'),
(4, 4, 21, 'Dr. Elton Nitzsche', 'Anura', 'enrolled', '2024-10-09 17:50:49', '2024-10-09 17:50:49'),
(5, 4, 14, 'Dr. Elton Nitzsche', 'thanuja', 'enrolled', '2024-10-10 04:08:04', '2024-10-10 04:08:04'),
(6, 4, 20, 'Dr. Elton Nitzsche', 'Manula', 'enrolled', '2024-10-10 04:09:37', '2024-10-10 04:09:37'),
(7, 8, 23, 'Miracle Gutmann', 'Rajitha', 'enrolled', '2024-10-10 04:17:13', '2024-10-10 04:17:13'),
(8, 8, 24, 'Miracle Gutmann', 'Pawan', 'enrolled', '2024-10-10 04:19:23', '2024-10-10 04:19:23'),
(9, 8, 26, 'Miracle Gutmann', 'ravi', 'enrolled', '2024-10-10 09:03:43', '2024-10-10 09:03:43'),
(10, 22, 9, 'mmm', 'Ravindu', 'unenrolled', '2024-12-10 18:22:58', '2024-12-10 18:23:41'),
(11, 28, 5, 'Sanath Jayasuriya', 'Ms. Heather Dickens', 'unenrolled', '2025-01-24 19:07:20', '2025-01-24 19:07:36'),
(12, 25, 5, 'Dr. Sachin nimantha', 'Ms. Heather Dickens', 'enrolled', '2025-01-24 19:07:45', '2025-01-24 19:07:45'),
(13, 25, 35, 'Dr. Sachin nimantha', 'newuser', 'unenrolled', '2025-01-25 02:43:47', '2025-01-25 02:44:24'),
(14, 22, 35, 'Sampath Kumara', 'newuser', 'enrolled', '2025-01-25 02:44:33', '2025-01-25 02:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `professional_feedbacks`
--

CREATE TABLE `professional_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `feedback` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_feedbacks`
--

INSERT INTO `professional_feedbacks` (`id`, `user_id`, `professional_id`, `score`, `feedback`, `created_at`, `updated_at`) VALUES
(7, 9, 8, 5, 'He is a Very good professional. Very good communication!', '2024-12-12 14:45:30', '2024-12-12 14:45:30'),
(8, 20, 4, 4, 'Very Good Coach!', '2025-01-24 19:05:44', '2025-01-24 19:05:44'),
(9, 5, 25, 2, 'Noot Good!', '2025-01-24 19:08:12', '2025-01-24 19:08:12'),
(10, 9, 8, 1, 'not good', '2025-01-25 02:58:02', '2025-01-25 02:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0Rf1xj8giuDklnlrIh4AZZ7zzcbR0X2yxlD6GHqy', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidEprY0hDYXpNcTEzaWh0Zkt2ZTRlZzNTbTVzSDRWTk94YnpCckxDNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9Qcm9mZXNzaW9uYWwvY2hhdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==', 1737773653),
('GRjI1VdvJBS7TCUGhrm4PrvAjSvcFMd31LYaJtFj', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidElBN3lZWVloWXltQmt1dHU3MnBwTFhkTDlXNVhzRm13bTZSaU00eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1739212844),
('tjmRyJcemZIx3XWRNUKAxf5TiIdGnaKlb1dIF6NW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVm1kdjdsN3R5ak9WV3VjT0sxQ2s5c1pxRTdqcHllNWJCSnpJTkZGcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739457986),
('tQjqAKR4voRd9gAa81lHL7tChZvAVnR9vTZRN2mP', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSW8zNlRBaDRHeEo5aVhBeHoyNFB0OHIxRWN3VkxsbFU2U2lMbk9vNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kaWV0cGxhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1739474613),
('V2FxR8roSgNjol2r5ibOTih8MItVKXiTuJHTDckx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmxvME1IVUMzZTF0aWc0dkVtZHNLSG40eHY3aHZISVFrZHVSTjZ3SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739430616),
('Yp2pCJR6MzmkDu1ZRZDMVFrkcoF3wICxtZc2R4jY', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWE5JZGpLcXc1M0c3ZUtLVHhzMFNIdENHRWttZzU4VjI4VTZkamdVOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1737776466);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `completed`, `created_at`, `updated_at`) VALUES
(1, 4, 'task 1', 'i have to do these', 1, '2024-10-09 19:13:09', '2024-10-09 20:32:10'),
(2, 4, 't2', 'ttttttttttttt', 1, '2024-10-09 20:02:15', '2024-10-09 20:31:53'),
(5, 8, '111', 'i have to do these', 1, '2024-10-09 21:40:17', '2024-10-09 21:47:45'),
(6, 8, '2', 'nbvjhbhj', 0, '2024-10-09 21:43:41', '2024-10-09 21:43:41'),
(7, 9, 'Review the assigned diet plan for the week.', 'Prepare meals according to the provided recipes and nutritional guidelines.', 0, '2024-10-10 07:12:40', '2024-10-10 07:12:40'),
(8, 9, 'Run!!!', 'Go for a run tomorrow morning!', 1, '2024-10-10 09:14:52', '2024-10-10 09:15:09'),
(10, 9, 'Test Task', 'Prepare meals according to the provided recipes and nutritional guidelines.', 1, '2025-01-25 02:54:48', '2025-01-25 02:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) DEFAULT NULL,
  `height_cm` int(11) NOT NULL,
  `weight_kg` decimal(5,2) NOT NULL,
  `activity_level` enum('Sedentary','Moderate','Active') NOT NULL,
  `fitness_goal` varchar(80) NOT NULL,
  `dietary_preference` enum('None','Vegetarian','Vegan','Keto') NOT NULL,
  `medical_conditions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `birthday`, `age`, `height_cm`, `weight_kg`, `activity_level`, `fitness_goal`, `dietary_preference`, `medical_conditions`, `created_at`, `updated_at`) VALUES
(9, '2016-01-18', 8, 180, 80.00, 'Sedentary', 'weight_loss', 'None', 'No', '2024-09-17 15:32:12', '2024-09-17 15:32:12'),
(16, '2016-01-01', 8, 150, 120.00, 'Sedentary', 'weight_loss', 'Keto', 'no', '2024-10-07 21:08:37', '2024-10-07 21:08:37'),
(20, '2000-02-01', 24, 178, 108.00, 'Sedentary', 'weight_loss', 'Keto', 'none', '2024-10-09 08:16:14', '2024-10-09 08:16:14'),
(21, '2003-01-01', 21, 150, 98.00, 'Sedentary', 'weight_loss', 'Vegan', 'no', '2024-10-09 16:58:53', '2024-10-09 16:58:53'),
(23, '2001-01-01', 23, 165, 79.00, 'Sedentary', 'weight_loss', 'Keto', 'no', '2024-10-10 04:16:58', '2024-10-10 04:16:58'),
(24, '2003-02-05', 21, 188, 92.00, 'Sedentary', 'weight_loss', 'Vegan', 'No', '2024-10-10 04:19:05', '2024-10-10 04:19:05'),
(26, '2000-01-07', 24, 177, 93.00, 'Sedentary', 'weight_loss', 'Vegetarian', 'no', '2024-10-10 09:02:42', '2024-10-10 09:02:42'),
(27, '1999-01-01', 25, 170, 78.00, 'Sedentary', 'weight_loss', 'None', 'no', '2024-12-12 15:52:34', '2024-12-12 15:52:34'),
(31, '2001-06-05', 23, 165, 65.00, 'Sedentary', 'weight_loss', 'None', 'no', '2024-12-12 16:59:07', '2024-12-12 16:59:07'),
(34, '1998-01-07', 27, 170, 80.00, 'Sedentary', 'weight_loss', 'Vegetarian', 'No', '2025-01-25 01:39:29', '2025-01-25 01:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('Admin','Professional','User') NOT NULL DEFAULT 'User',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `photo`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$12$fOPYBmE2lqzQro1y66MkmOD8SA0wTl6Ad5hNKgQ/0XGJPHwndDocG', '202410101258fit-sri-lanka-app.png', '0781234567', 'Fit SriLanka Headquarters', 'Admin', '2024-09-17 19:54:34', '2024-10-10 07:28:14'),
(4, 'Dr. Elton Nitzsche', 'asporer', 'rbarton@example.net', '$2y$12$zXDxw2Bip7ohAkm27bdF.e1/0edNaNqYFm6QdtfqcpN9sUIoKGE9.', '202409220716pexels-photo-771742.jpeg', '1233211233', '248 Zboncak CenterJordyland, ME 86362-7465', 'Professional', '2024-09-05 14:37:44', '2024-09-22 01:46:40'),
(5, 'Ms. Heather Dickens', 'gutkowski.keyon', 'kirstin93@example.com', '$2y$12$zXDxw2Bip7ohAkm27bdF.e1/0edNaNqYFm6QdtfqcpN9sUIoKGE9.', '202410100933esdf.jpg', '7899870980', '43103 Shany Camp Apt. 799North Mikelstad, MA 94609-3872', 'User', '2024-09-05 14:37:44', '2024-10-10 04:03:40'),
(6, 'Mr. Elliot Donnelly', 'monica27', 'bernhard.marvin@example.com', '$2y$12$zXDxw2Bip7ohAkm27bdF.e1/0edNaNqYFm6QdtfqcpN9sUIoKGE9.', '202410100934fgbf.jpg', '4567655897', '7769 Merle FallsPort Milesview, MD 91904', 'Professional', '2024-09-05 14:37:45', '2024-10-10 04:04:21'),
(7, 'Damian Turner', 'swintheiser', 'marco.bauch@example.com', '$2y$12$zXDxw2Bip7ohAkm27bdF.e1/0edNaNqYFm6QdtfqcpN9sUIoKGE9.', '202409162012Changing-the-default-admin-user-in-WordPress1-460x575.jpg', '0771234567', '28636 Rau LodgeEast Alyson, ND 97250-0487', 'Admin', '2024-09-05 14:37:45', '2024-09-16 14:42:40'),
(8, 'Miracle Gutmann', 'jillian59', 'alfonzo.bosco@example.net', '$2y$12$zXDxw2Bip7ohAkm27bdF.e1/0edNaNqYFm6QdtfqcpN9sUIoKGE9.', '2024101009567dba462cf3a3a377782ea9315616d7f4.jpg', '0771238965', '590 Rempel Lakes Apt. 832Houstonburgh, MN 37635-5246', 'Professional', '2024-09-05 14:37:45', '2024-10-10 04:26:31'),
(9, 'Ravindu', 'ravindu', 'ravinduwajira@gmail.com', '$2y$12$70H1fn9r9iPPXwnZ8Gip2OQwZ/R/bomSzQKw.Q37CiX9/11e55esa', '2024101008391718398997595.jpeg', '0771234599', 'Hingurakgoda', 'User', '2024-09-16 16:46:56', '2025-01-25 03:00:39'),
(12, 'sdfs', 'sdfs', '1234@gmail.com', '$2y$12$lAbHNX9pNYVD/xEC71KcweGkIt7xugVP9Kzb/ShtXl0l6xcpRddCG', '202410080150Social Media (38).png', '0771234567', 'D no', 'User', '2024-10-07 20:18:01', '2024-10-07 20:20:41'),
(14, 'thanuja', 'thanujat', 'thanuja123@gmail.com', '$2y$12$3ccQX/Rdsf8Nf2n5ejC/h.qBK2GZiRMdnkM.dfXchZColRhdsmXre', '2024101009374743f767aacfdfad392f14cbd6068eb3.jpg', '0771238965', 'dxf', 'User', '2024-10-07 20:27:38', '2024-10-10 04:07:27'),
(15, 'vishwa mahela', 'vishwa', 'cc@gmail.com', '$2y$12$4yM4g4pXKHDsDvE4s8L6ROBsGvCfNwgeX0RTPbl9WPFTytKr9Pmr6', '202410080204_social-media new.jpg', '0771238965', 'czX', 'User', '2024-10-07 20:34:54', '2024-10-07 20:34:54'),
(16, 'gggg', 'ggg', 'ggg@gmail.com', '$2y$12$9wdpjWUl7yiK/tgnJI2dGOkQlDOlzMBSJykzcXvTR0Jr1mnM9PMfy', '202410080237_Social Media (38).png', '0771238965', 'ggggg', 'User', '2024-10-07 21:07:50', '2024-10-07 21:07:50'),
(20, 'Manula', 'manula@example.net', 'manula@example.net', '$2y$12$SwJyx02vAUl2oFuYTaN7SOvSmJ7WOc1ulHLrBoTRAYvkTawsIjDd6', '202410100936gvbn.jpg', '5555555555', 'D 30', 'User', '2024-10-09 08:07:50', '2024-10-10 04:06:45'),
(21, 'Anura', 'Anura@example.net', 'Anura@example.net', '$2y$12$RKdl7HY/HDVUFfeoSJETLOefsHJxqvzvWATu7mJ26pF5IcDgEaG/.', '202410092039__518eec50-4010-4489-ae4c-32a4cf1e510c.jpeg', '1234567891', 'iijjklj', 'User', '2024-10-09 15:09:01', '2024-10-09 15:09:01'),
(22, 'Sampath Kumara', 'mmm@gmail.com', 'mmm@gmail.com', '$2y$12$p3ymd6th92SjtwPN3bqi.eLrpOiMiO5341eDR5ZoBZLR1tO5sbuZ.', '202410100524_header-app.png', '0771234567', '4erdtfg', 'Professional', '2024-10-09 23:54:11', '2024-10-09 23:54:11'),
(23, 'Rajitha', 'Rajitha viman', 'rajitha@gmail.com', '$2y$12$1syy.vuNNBYWKCS2cpXVw.fElOL4lesw0ah67MlCk95CQYVixWu9u', '202410100946_4af16fc182ed14640525332810a5f345.jpg', '0824356789', 'Kandy, katugasthota', 'User', '2024-10-10 04:16:13', '2024-10-10 04:16:13'),
(24, 'Pawan', 'pawank', 'pawan@gmail.com', '$2y$12$415OIgwRKgJvWVZFj2EMf.l9lt/2aFT2yUK7HuDK1F5Opr1GeVN.e', '202410100948_b94871afc92c928a86f57350d941c231.jpg', '0771234567', 'Kurunagala, wawa rauma', 'User', '2024-10-10 04:18:33', '2024-10-10 04:18:33'),
(25, 'Dr. Sachin nimantha', 'sachinwin', 'sachin@gmail.com', '$2y$12$0opK/ZOtUOhfjaewaCwwFeabBEdFdEDrE991q4UEuAQkIWWGfFh8C', '202410100950_9d887dd74b4f884ea9a911cde6048fa7.jpg', '6784567894', 'Hingurakgoda', 'Professional', '2024-10-10 04:20:38', '2024-10-10 04:20:38'),
(26, 'ravi', 'ravinew', 'ravi@gmail', '$2y$12$6G/uIi/y.lz9/tqTaolEpu3d8zgVXgTtjKvOeRuLdDHSLDCGWXVI2', '202410101431_fit-sri-lanka-app.png', '0771234567', 'sdzsfds', 'User', '2024-10-10 09:01:53', '2024-10-10 09:01:53'),
(27, 'Kamindu Mendis', 'kamindu123', 'kamindu@gmail.com', '$2y$12$P2HqUvzTy9zUQJfJO1G9FetyDV3SZimnqv8HiJr2xd.nRe3fCBDi.', '202412122107_ryan_20230915120925.jpg', '0756464645', 'No 65', 'User', '2024-12-12 15:37:35', '2024-12-12 15:37:35'),
(28, 'Sanath Jayasuriya', 'sanath123', 'sanath@gmail.com', '$2y$12$fnvk6eZMACPWtVtp3fPJtesmSJk0AR.ADJNjIz1GWNHDSbzlwVxH.', '202412122211_684sevmpi8hcb8gtr68eklqncm._SY600_.jpg', '0771234567', 'No 200', 'Professional', '2024-12-12 16:41:47', '2024-12-12 16:41:47'),
(29, 'Kusal Mendis', 'kusal123', 'kusal@gmail.com', '$2y$12$bVSECHT6EnuUBB.vChisF.vSXNTToHsQedUyb.b8czJXj3slUvOC2', '202412122216_pexels-atef-khaled-825144-1816654.jpg', '0771234567', 'no 50', 'Professional', '2024-12-12 16:46:06', '2024-12-12 16:46:06'),
(30, 'Pathum Nissanka', 'pathum123', 'pathum@gmail.com', '$2y$12$uryl9TseD.zioXwoUO4uDewfIWEQ0m3wzopw0hrlqGK1ALzddxFt.', '202412122220_premium_photo-1661637743614-a0aea42073c1.jpeg', '0771234567', 'no 207', 'Professional', '2024-12-12 16:50:42', '2024-12-12 16:50:42'),
(31, 'Matheesha', 'Matheeesha123', 'matheesha@gmail.com', '$2y$12$eFwifMCNaoOfpPH395CALuoK8caNf3HoQnitOwUGC0ERvskdRmZky', '202412122228_ryan_20230915120925.jpg', '0771234567', 'no4', 'User', '2024-12-12 16:58:35', '2024-12-12 16:58:35'),
(32, 'Nipuna ayan', 'nipuna123', 'nipuna@gmail.com', '$2y$12$0QQy4zmqZgvBpDBentB/he1fnHcb2V8rIshVVYRdf/aY/9fLCA5YW', '202412122230_photo-1690037901153-7fd75205941a.jpeg', '0771234569', 'gg 656', 'Professional', '2024-12-12 17:00:21', '2024-12-12 17:00:21'),
(34, 'test', 'test', 'test@gmail.com', '$2y$12$d/BQ/WwvEeYyytuxpzPoEuFG5Nu7fvGn3DatYT06qza4B2oE8sSYK', '202501250708_360_F_608557356_ELcD2pwQO9pduTRL30umabzgJoQn5fnd.jpg', '0771234567', 'abc', 'User', '2025-01-25 01:38:06', '2025-01-25 01:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedbacks`
--

CREATE TABLE `user_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `feedback` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_feedbacks`
--

INSERT INTO `user_feedbacks` (`id`, `professional_id`, `user_id`, `score`, `feedback`, `created_at`, `updated_at`) VALUES
(3, 8, 9, 5, 'Nice client. follows instructions properly.', '2024-12-12 15:19:14', '2024-12-12 15:19:14'),
(4, 8, 24, 5, 'dfgdgdgd', '2025-01-25 03:08:25', '2025-01-25 03:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `workout_histories`
--

CREATE TABLE `workout_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `workout_plan_id` bigint(20) UNSIGNED NOT NULL,
  `workout_schedule` text NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workout_histories`
--

INSERT INTO `workout_histories` (`id`, `user_id`, `workout_plan_id`, `workout_schedule`, `start_time`, `end_time`, `duration`, `created_at`, `updated_at`) VALUES
(2, 9, 3, 'update 3', '2024-09-30 12:46:25', '2024-09-30 12:46:50', '00:00:24', '2024-09-30 18:16:54', '2024-09-30 18:16:54'),
(3, 9, 3, 'update 3', '2024-10-08 23:47:15', '2024-10-08 23:48:01', '00:00:46', '2024-10-09 05:18:02', '2024-10-09 05:18:02'),
(4, 9, 3, 'update 3', '2024-10-08 23:48:42', '2024-10-08 23:48:56', '00:00:14', '2024-10-09 05:18:57', '2024-10-09 05:18:57'),
(5, 9, 3, 'update 3', '2024-10-08 23:56:43', '2024-10-08 23:57:05', '00:00:21', '2024-10-09 05:27:06', '2024-10-09 05:27:06'),
(6, 9, 3, 'update 3', '2024-10-09 00:13:01', '2024-10-09 00:13:13', '00:00:12', '2024-10-09 05:43:14', '2024-10-09 05:43:14'),
(7, 9, 3, 'update 3', '2024-10-09 00:17:24', '2024-10-09 00:17:30', '00:00:05', '2024-10-09 05:47:31', '2024-10-09 05:47:31'),
(8, 9, 3, 'update 3', '2024-10-09 00:17:54', '2024-10-09 00:18:01', '00:00:07', '2024-10-09 05:48:03', '2024-10-09 05:48:03'),
(9, 9, 3, 'Strength Training - Upper Body:\n\nBench Press: 4 sets of 8-12 reps\nDumbbell Shoulder Press: 3 sets of 10 reps\nLat Pulldown: 4 sets of 10-12 reps\nBarbell Bicep Curls: 3 sets of 12-15 reps\nTricep Pushdowns: 3 sets of 12-15 reps\n\nStrength Training - Lower Body:\n\nSquats: 4 sets of 8-10 reps\nLeg Press: 4 sets of 10-12 reps\nDeadlifts: 3 sets of 8 reps\nLunges: 3 sets of 12 reps (each leg)\nCalf Raises: 4 sets of 15-20 reps\n\nCore & Cardio:\n\nPlanks: 3 sets of 1 minute each\nRussian Twists: 3 sets of 20 reps\nBicycle Crunches: 3 sets of 20 reps\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2024-10-09 16:27:05', '2024-10-09 16:28:26', '00:01:05', '2024-10-09 21:58:27', '2024-10-09 21:58:27'),
(10, 9, 3, 'Strength Training - Upper Body:\n\nBench Press: 4 sets of 8-12 reps\nDumbbell Shoulder Press: 3 sets of 10 reps\nLat Pulldown: 4 sets of 10-12 reps\nBarbell Bicep Curls: 3 sets of 12-15 reps\nTricep Pushdowns: 3 sets of 12-15 reps\n\nStrength Training - Lower Body:\n\nSquats: 4 sets of 8-10 reps\nLeg Press: 4 sets of 10-12 reps\nDeadlifts: 3 sets of 8 reps\nLunges: 3 sets of 12 reps (each leg)\nCalf Raises: 4 sets of 15-20 reps\n\nCore & Cardio:\n\nPlanks: 3 sets of 1 minute each\nRussian Twists: 3 sets of 20 reps\nBicycle Crunches: 3 sets of 20 reps\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2024-10-09 17:03:05', '2024-10-09 17:03:17', '00:00:11', '2024-10-09 22:33:17', '2024-10-09 22:33:17'),
(11, 9, 3, 'Strength Training - Upper Body:\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nStrength Training - Lower Body:\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio:\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2024-10-10 03:38:06', '2024-10-10 03:38:18', '00:00:11', '2024-10-10 09:08:21', '2024-10-10 09:08:21'),
(12, 9, 3, 'Strength Training - Upper Body:\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nStrength Training - Lower Body:\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio:\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2024-12-10 17:38:28', '2024-12-10 17:55:44', '00:17:15', '2024-12-10 23:25:45', '2024-12-10 23:25:45'),
(13, 9, 3, 'Strength Training - Upper Body:\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nStrength Training - Lower Body:\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio:\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2024-12-11 18:06:43', '2024-12-11 18:06:56', '00:00:12', '2024-12-11 23:36:57', '2024-12-11 23:36:57'),
(14, 9, 3, 'Upper Body\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nLower Body\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2025-01-23 10:08:57', '2025-01-23 04:38:56', '00:01:53', '2025-01-23 10:08:57', '2025-01-23 10:08:57'),
(15, 9, 3, 'Upper Body\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nLower Body\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2025-01-24 18:46:36', '2025-01-24 13:16:36', '00:00:17', '2025-01-24 18:46:36', '2025-01-24 18:46:36'),
(16, 9, 3, 'Upper Body\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nLower Body\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', '2025-01-25 02:47:55', '2025-01-24 21:17:53', '00:00:10', '2025-01-25 02:47:55', '2025-01-25 02:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professional_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `workout_schedule` text NOT NULL,
  `calorie_burn` int(11) NOT NULL,
  `workout_benefits` text NOT NULL,
  `workout_duration` text NOT NULL,
  `additional_info` text DEFAULT NULL,
  `workout_image` text DEFAULT NULL,
  `workout_video` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`id`, `professional_id`, `client_id`, `workout_schedule`, `calorie_burn`, `workout_benefits`, `workout_duration`, `additional_info`, `workout_image`, `workout_video`, `created_at`, `updated_at`) VALUES
(3, 8, 9, 'Upper Body\r\n\r\nBench Press: 4 sets of 8-12 reps\r\nDumbbell Shoulder Press: 3 sets of 10 reps\r\nLat Pulldown: 4 sets of 10-12 reps\r\nBarbell Bicep Curls: 3 sets of 12-15 reps\r\nTricep Pushdowns: 3 sets of 12-15 reps\r\n\r\nLower Body\r\n\r\nSquats: 4 sets of 8-10 reps\r\nLeg Press: 4 sets of 10-12 reps\r\nDeadlifts: 3 sets of 8 reps\r\nLunges: 3 sets of 12 reps (each leg)\r\nCalf Raises: 4 sets of 15-20 reps\r\n\r\nCore & Cardio\r\n\r\nPlanks: 3 sets of 1 minute each\r\nRussian Twists: 3 sets of 20 reps\r\nBicycle Crunches: 3 sets of 20 reps\r\n15-20 minutes of Cardio (Treadmill, Stairmaster, or Rowing Machine)', 1100, 'Strength Training \r\nBuilds upper body strength, tones muscles, and increases metabolism.\r\nStrengthens legs, improves core stability, and enhances overall functional strength.\r\nImproves core stability, burns fat, and boosts cardiovascular health.', 'Session 1: 45-60 minutes\r\nSession 2: 45-60 minutes\r\nSession 3: 30-45 minutes\r\nTotal Duration: 2-3 hours', 'Warm-up: Spend 5-10 minutes warming up before each session .\r\nRest Between Sets: 1-2 minutes rest between sets, and 2-3 minutes between exercises.\r\nHydration: Drink plenty of water throughout the day.\r\nPost-Workout Nutrition: Consume a high-protein meal or shake.', '202412121436wimg (2).jpg', '202410091233videoplayback.mp4', '2024-09-26 15:01:32', '2025-01-25 03:04:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_user_one_id_foreign` (`user_one_id`),
  ADD KEY `conversations_user_two_id_foreign` (`user_two_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fastingtrackers`
--
ALTER TABLE `fastingtrackers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fastingtrackers_user_id_foreign` (`user_id`);

--
-- Indexes for table `fitness_centers`
--
ALTER TABLE `fitness_centers`
  ADD PRIMARY KEY (`fitnesscenterid`),
  ADD KEY `fitness_centers_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `fitness_center_enrollments`
--
ALTER TABLE `fitness_center_enrollments`
  ADD PRIMARY KEY (`fc_enrollment_id`);

--
-- Indexes for table `health_statuses`
--
ALTER TABLE `health_statuses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meals_meal_plan_id_foreign` (`meal_plan_id`);

--
-- Indexes for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_plans_user_id_foreign` (`user_id`),
  ADD KEY `meal_plans_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `professionalinfo`
--
ALTER TABLE `professionalinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professional_enrollments`
--
ALTER TABLE `professional_enrollments`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `professional_feedbacks`
--
ALTER TABLE `professional_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professional_feedbacks_user_id_foreign` (`user_id`),
  ADD KEY `professional_feedbacks_professional_id_foreign` (`professional_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_feedbacks_professional_id_foreign` (`professional_id`),
  ADD KEY `user_feedbacks_user_id_foreign` (`user_id`);

--
-- Indexes for table `workout_histories`
--
ALTER TABLE `workout_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workout_histories_user_id_foreign` (`user_id`),
  ADD KEY `workout_histories_workout_plan_id_foreign` (`workout_plan_id`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workout_plans_professional_id_foreign` (`professional_id`),
  ADD KEY `workout_plans_client_id_foreign` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fastingtrackers`
--
ALTER TABLE `fastingtrackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `fitness_centers`
--
ALTER TABLE `fitness_centers`
  MODIFY `fitnesscenterid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fitness_center_enrollments`
--
ALTER TABLE `fitness_center_enrollments`
  MODIFY `fc_enrollment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `health_statuses`
--
ALTER TABLE `health_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=472;

--
-- AUTO_INCREMENT for table `meal_plans`
--
ALTER TABLE `meal_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `professionalinfo`
--
ALTER TABLE `professionalinfo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `professional_enrollments`
--
ALTER TABLE `professional_enrollments`
  MODIFY `enrollment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `professional_feedbacks`
--
ALTER TABLE `professional_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workout_histories`
--
ALTER TABLE `workout_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_user_one_id_foreign` FOREIGN KEY (`user_one_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_user_two_id_foreign` FOREIGN KEY (`user_two_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fastingtrackers`
--
ALTER TABLE `fastingtrackers`
  ADD CONSTRAINT `fastingtrackers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fitness_centers`
--
ALTER TABLE `fitness_centers`
  ADD CONSTRAINT `fitness_centers_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_meal_plan_id_foreign` FOREIGN KEY (`meal_plan_id`) REFERENCES `meal_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meal_plans`
--
ALTER TABLE `meal_plans`
  ADD CONSTRAINT `meal_plans_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meal_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `professionalinfo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `professionalinfo`
--
ALTER TABLE `professionalinfo`
  ADD CONSTRAINT `professionalinfo_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `professional_feedbacks`
--
ALTER TABLE `professional_feedbacks`
  ADD CONSTRAINT `professional_feedbacks_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `professional_feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_feedbacks`
--
ALTER TABLE `user_feedbacks`
  ADD CONSTRAINT `user_feedbacks_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_histories`
--
ALTER TABLE `workout_histories`
  ADD CONSTRAINT `workout_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `workout_histories_workout_plan_id_foreign` FOREIGN KEY (`workout_plan_id`) REFERENCES `workout_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD CONSTRAINT `workout_plans_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `workout_plans_professional_id_foreign` FOREIGN KEY (`professional_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
