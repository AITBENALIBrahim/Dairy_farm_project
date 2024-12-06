-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 06 déc. 2024 à 22:02
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `auth`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal_vaccines`
--

CREATE TABLE `animal_vaccines` (
  `id` int(11) UNSIGNED NOT NULL,
  `animal_id` int(11) UNSIGNED NOT NULL,
  `animal_type` enum('cow','calf') NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `vaccination_date` date NOT NULL,
  `next_vaccine_date` date DEFAULT NULL,
  `administered_by` varchar(100) DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal_vaccines`
--

INSERT INTO `animal_vaccines` (`id`, `animal_id`, `animal_type`, `vaccine_name`, `vaccination_date`, `next_vaccine_date`, `administered_by`, `created_by`, `employee_id`, `notes`, `created_at`, `updated_at`) VALUES
(2, 2, 'cow', 'test', '2024-11-30', NULL, NULL, NULL, NULL, NULL, '2024-11-30 07:25:02', '2024-11-30 07:25:02'),
(3, 2, 'cow', 'test', '2024-11-30', NULL, NULL, NULL, NULL, NULL, '2024-11-30 08:08:31', '2024-11-30 08:08:31');

-- --------------------------------------------------------

--
-- Structure de la table `assistants`
--

CREATE TABLE `assistants` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `role` enum('assistant') NOT NULL DEFAULT 'assistant',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expires_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `assistants`
--

INSERT INTO `assistants` (`id`, `username`, `email`, `password`, `photo`, `birth`, `gender`, `role`, `created_by`, `reset_token`, `token_expires_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 'ffff', 'ddd@gg.co', '$2y$10$yasAl0bfeP8h8gszrld4x.BddPXO5HmUulCYPz6iFjgPcSNC1PHC.', 'uploads/profile_photos/1732489629_73fea946f9a1e9deabe2.jpg', '2024-11-01', 'female', 'assistant', 6, NULL, NULL, '2024-11-24 22:30:51', '2024-11-24 23:07:09', NULL),
(20, 'world', 'helloworld99@gmail.com', '$2y$10$WDXI/3m7RoE9wx2q1jOmpObHdDeS7zRf16r.1yL8IKe0oXawrUQV.', NULL, NULL, NULL, 'assistant', 7, NULL, NULL, '2024-11-29 15:44:57', '2024-11-29 15:44:57', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `calves`
--

CREATE TABLE `calves` (
  `id` int(11) UNSIGNED NOT NULL,
  `cow_id` int(11) UNSIGNED NOT NULL,
  `tag_number` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `health_status` varchar(50) NOT NULL DEFAULT 'healthy',
  `stall_id` int(11) UNSIGNED DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `sale_status` enum('available','sold') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cows`
--

CREATE TABLE `cows` (
  `id` int(11) UNSIGNED NOT NULL,
  `tag_number` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `health_status` varchar(50) NOT NULL DEFAULT 'healthy',
  `stall_id` int(11) UNSIGNED DEFAULT NULL,
  `sale_status` enum('available','sold') NOT NULL DEFAULT 'available',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cows`
--

INSERT INTO `cows` (`id`, `tag_number`, `date_of_birth`, `health_status`, `stall_id`, `sale_status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, '444', '2024-11-12', 'sick', 2, 'sold', NULL, '2024-11-29 15:29:33', '2024-11-29 15:29:33'),
(3, '1', '2024-11-30', 'YYY', 2, '', NULL, '2024-11-30 07:13:32', '2024-11-30 07:13:32'),
(4, '44', '2024-11-30', 'test', 2, '', NULL, '2024-11-30 08:07:58', '2024-11-30 08:07:58');

-- --------------------------------------------------------

--
-- Structure de la table `cow_pregnancies`
--

CREATE TABLE `cow_pregnancies` (
  `id` int(11) UNSIGNED NOT NULL,
  `cow_id` int(11) UNSIGNED NOT NULL,
  `pregnancy_start_date` date DEFAULT NULL,
  `expected_delivery_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cow_pregnancies`
--

INSERT INTO `cow_pregnancies` (`id`, `cow_id`, `pregnancy_start_date`, `expected_delivery_date`, `notes`, `created_by`, `employee_id`, `created_at`) VALUES
(1, 2, '2024-11-30', '2024-11-30', 'test', NULL, NULL, '2024-11-30 07:25:25');

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `name`, `position`, `salary`, `hire_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'hassan', 'back', 1999.99, '2023-11-11', 'active', 6, '2024-11-26 18:03:09', '2024-11-26 18:33:34'),
(3, 'gg', 'gg', 554.00, '1111-11-11', 'active', 6, '2024-11-26 18:35:01', '2024-11-26 18:35:01'),
(4, 'uuu', 'hhh', 55.00, '2222-02-22', 'inactive', 6, '2024-11-26 18:35:20', '2024-11-26 18:35:49'),
(5, 'dd', 'dd', 22.00, '2222-02-22', 'inactive', 6, '2024-11-26 18:38:50', '2024-11-26 18:38:50'),
(7, 'gogo', 'cc', 88.00, '2009-12-23', 'inactive', 6, '2024-11-26 18:43:37', '2024-11-26 21:44:13'),
(8, 'hicham', 'front', 999.00, '3333-03-31', 'inactive', 6, '2024-11-26 21:43:25', '2024-11-26 21:43:25'),
(9, 'holand', 'back', 3000.00, '2020-11-01', 'active', 7, '2024-11-29 14:53:04', '2024-11-29 14:53:04');

-- --------------------------------------------------------

--
-- Structure de la table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) UNSIGNED NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employee_salaries`
--

INSERT INTO `employee_salaries` (`id`, `employee_id`, `amount_paid`, `payment_date`, `payment_method`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 8, 85.00, '2024-07-31', 'card', 'hello 2', 6, '2024-11-26 21:50:10', '2024-11-26 21:50:57'),
(4, 9, 2000.00, '2024-01-30', 'virement', 'ok', 7, '2024-11-29 14:56:55', '2024-11-29 14:56:55'),
(5, 4, 333.00, '2023-11-11', 'virement', 'hi', 6, '2024-11-29 16:21:11', '2024-11-29 16:21:11');

-- --------------------------------------------------------

--
-- Structure de la table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED NOT NULL,
  `expense_date` date DEFAULT NULL,
  `expense_type` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_date`, `expense_type`, `amount`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2024-02-22', 'food', 120.00, 'food', 6, '2024-11-24 20:33:40', '2024-11-24 20:33:40'),
(8, '2024-02-22', 'water', 44.00, 'carterpillar', 6, '2024-11-24 22:05:50', '2024-11-24 22:05:50'),
(9, '0222-02-22', 'dog cat', 22222.00, '2222', 6, '2024-11-26 21:51:43', '2024-11-26 21:51:57'),
(10, '2024-02-05', 'Food', 1400.00, 'none', 7, '2024-11-29 14:50:48', '2024-11-29 14:50:48');

-- --------------------------------------------------------

--
-- Structure de la table `feed_chart`
--

CREATE TABLE `feed_chart` (
  `id` int(11) UNSIGNED NOT NULL,
  `cow_id` int(11) UNSIGNED NOT NULL,
  `feed_time` time NOT NULL,
  `feed_type` varchar(100) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `feed_chart`
--

INSERT INTO `feed_chart` (`id`, `cow_id`, `feed_time`, `feed_type`, `quantity`, `date`, `created_by`, `employee_id`, `created_at`) VALUES
(1, 2, '14:22:00', 'rr', 1.00, '2020-11-11', NULL, NULL, NULL),
(2, 2, '09:27:00', 'tset', 111.00, '2024-11-30', NULL, NULL, NULL),
(3, 2, '10:13:00', 'tst', 43.00, '2024-11-30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-11-01-142410', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1731001409, 1),
(2, '2024-11-13-151348', 'App\\Database\\Migrations\\CreateAssistantsTable', 'default', 'App', 1731511335, 2),
(3, '2024-11-21-163438', 'App\\Database\\Migrations\\CreateEmployeesTable', 'default', 'App', 1732207365, 3),
(5, '2024-11-21-165559', 'App\\Database\\Migrations\\CreateStallsTable', 'default', 'App', 1732208709, 4),
(8, '2024-11-21-171230', 'App\\Database\\Migrations\\CreateCowsTable', 'default', 'App', 1732209194, 7),
(9, '2024-11-21-171359', 'App\\Database\\Migrations\\CreateCalvesTable', 'default', 'App', 1732209285, 8),
(10, '2024-11-21-171650', 'App\\Database\\Migrations\\CreateMilkCollectionTable', 'default', 'App', 1732209453, 9),
(11, '2024-11-21-171808', 'App\\Database\\Migrations\\CreateFeedChartTable', 'default', 'App', 1732209518, 10),
(12, '2024-11-21-172042', 'App\\Database\\Migrations\\CreateCowPregnanciesTable', 'default', 'App', 1732209687, 11),
(13, '2024-11-21-172540', 'App\\Database\\Migrations\\CreateAnimalVaccinesTable', 'default', 'App', 1732209977, 12),
(14, '2024-11-21-172721', 'App\\Database\\Migrations\\CreateSalesTable', 'default', 'App', 1732210079, 13),
(15, '2024-11-21-172850', 'App\\Database\\Migrations\\CreateRoutinesTable', 'default', 'App', 1732210166, 14),
(17, '2024-11-21-170722', 'App\\Database\\Migrations\\CreateSuppliersTable', 'default', 'App', 1732473275, 15),
(18, '2024-11-21-170855', 'App\\Database\\Migrations\\CreateExpensesTable', 'default', 'App', 1732478911, 16),
(19, '2024-11-21-163439', 'App\\Database\\Migrations\\CreateEmployeeSalariesTable', 'default', 'App', 1732658957, 17);

-- --------------------------------------------------------

--
-- Structure de la table `milk_collection`
--

CREATE TABLE `milk_collection` (
  `id` int(11) UNSIGNED NOT NULL,
  `cow_id` int(11) UNSIGNED NOT NULL,
  `collection_date` date NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `milk_type` varchar(50) NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `milk_collection`
--

INSERT INTO `milk_collection` (`id`, `cow_id`, `collection_date`, `quantity`, `milk_type`, `created_by`, `employee_id`, `created_at`, `updated_at`) VALUES
(2, 2, '0000-00-00', 111.00, 'cow', NULL, 2, '2024-11-30 08:06:22', '2024-11-30 08:06:22');

-- --------------------------------------------------------

--
-- Structure de la table `routines`
--

CREATE TABLE `routines` (
  `id` int(11) UNSIGNED NOT NULL,
  `animal_id` int(11) UNSIGNED NOT NULL,
  `animal_type` enum('cow','calf') NOT NULL,
  `routine_type` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `frequency` enum('daily','monthly') NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `routines`
--

INSERT INTO `routines` (`id`, `animal_id`, `animal_type`, `routine_type`, `description`, `frequency`, `created_by`, `employee_id`, `created_at`, `updated_at`) VALUES
(3, 2, 'cow', 'test', 'test', '', NULL, 2, '2024-11-30 07:26:20', '2024-11-30 07:26:20'),
(4, 2, 'cow', 'test', 'test', '', NULL, 2, '2024-11-30 08:09:46', '2024-11-30 08:09:46');

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_type` enum('milk','cow','calf') NOT NULL,
  `animal_id` int(11) UNSIGNED DEFAULT NULL,
  `sale_date` date NOT NULL,
  `quantity_liters` decimal(10,2) DEFAULT NULL,
  `price_per_liter` decimal(10,2) DEFAULT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `payment_status` enum('paid','due') NOT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `sale_type`, `animal_id`, `sale_date`, `quantity_liters`, `price_per_liter`, `sale_price`, `buyer_name`, `invoice_number`, `payment_status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, '', 2, '2024-11-30', 22222.00, 22.00, 0.00, 'qqq', '11', '', NULL, '2024-11-30 07:53:46', '2024-11-30 07:53:46'),
(3, '', 2, '2024-11-30', 22.00, 1.99, 0.00, 'test', '2', '', NULL, '2024-11-30 08:07:05', '2024-11-30 08:07:05');

-- --------------------------------------------------------

--
-- Structure de la table `stalls`
--

CREATE TABLE `stalls` (
  `id` int(11) UNSIGNED NOT NULL,
  `stall_number` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `occupied` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `employee_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `stall_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stalls`
--

INSERT INTO `stalls` (`id`, `stall_number`, `capacity`, `occupied`, `created_by`, `employee_id`, `created_at`, `stall_name`) VALUES
(2, '5', 100, 0, NULL, 2, NULL, NULL),
(3, '44', 1000, 0, NULL, 3, NULL, NULL),
(5, '1', 100, 0, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `supplied_items` text DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_number`, `address`, `supplied_items`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'hassan hello', '0641414177', 'drarga 333', 'pes, hello, cat, dodge', 6, '2024-11-24 17:34:54', '2024-11-24 22:04:58'),
(13, 'brahim', '55555', 'fffff', 'ddddd', 6, '2024-11-24 22:04:15', '2024-11-24 22:04:15'),
(14, 'Jack', '0681846536', 'Agadir', 'Food', 7, '2024-11-29 14:48:02', '2024-11-29 14:48:02');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `role` enum('admin','secretary') NOT NULL DEFAULT 'admin',
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expires_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `photo`, `birth`, `gender`, `role`, `reset_token`, `token_expires_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'brahim12346', 'brahimnissan01@gmail.com', '$2y$10$lR8ol8QvsFnYs8G4ausKE.M1U9NVZn6txLPxiyb1cGo0O2dGLAubK', 'uploads/profile_photos/1732352898_862ad0103eee2d139d6c.jpg', '2000-12-05', 'male', 'admin', NULL, NULL, '2024-11-21 12:37:32', '2024-11-23 09:08:18', NULL),
(7, 'hicham', 'brahimbureau01@gmail.com', '$2y$10$tvKmil0JF9Q2b..shzHmd.nUUoYiltzoUvfjV0rIrUbd7rZ1LOFni', NULL, NULL, NULL, 'admin', NULL, NULL, '2024-11-29 15:41:49', '2024-11-29 15:43:04', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal_vaccines`
--
ALTER TABLE `animal_vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_vaccines_animal_id_foreign` (`animal_id`),
  ADD KEY `animal_vaccines_created_by_foreign` (`created_by`),
  ADD KEY `animal_vaccines_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `assistants_created_by_foreign` (`created_by`);

--
-- Index pour la table `calves`
--
ALTER TABLE `calves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_number` (`tag_number`),
  ADD KEY `calves_cow_id_foreign` (`cow_id`),
  ADD KEY `calves_stall_id_foreign` (`stall_id`),
  ADD KEY `calves_created_by_foreign` (`created_by`),
  ADD KEY `calves_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `cows`
--
ALTER TABLE `cows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_number` (`tag_number`),
  ADD KEY `cows_stall_id_foreign` (`stall_id`),
  ADD KEY `cows_created_by_foreign` (`created_by`);

--
-- Index pour la table `cow_pregnancies`
--
ALTER TABLE `cow_pregnancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cow_pregnancies_cow_id_foreign` (`cow_id`),
  ADD KEY `cow_pregnancies_created_by_foreign` (`created_by`),
  ADD KEY `cow_pregnancies_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_created_by_foreign` (`created_by`);

--
-- Index pour la table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_salaries_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_salaries_created_by_foreign` (`created_by`);

--
-- Index pour la table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_created_by_foreign` (`created_by`);

--
-- Index pour la table `feed_chart`
--
ALTER TABLE `feed_chart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feed_chart_cow_id_foreign` (`cow_id`),
  ADD KEY `feed_chart_created_by_foreign` (`created_by`),
  ADD KEY `feed_chart_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `milk_collection`
--
ALTER TABLE `milk_collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milk_collection_cow_id_foreign` (`cow_id`),
  ADD KEY `milk_collection_created_by_foreign` (`created_by`),
  ADD KEY `milk_collection_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routines_animal_id_foreign` (`animal_id`),
  ADD KEY `routines_created_by_foreign` (`created_by`),
  ADD KEY `routines_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_animal_id_foreign` (`animal_id`),
  ADD KEY `sales_created_by_foreign` (`created_by`);

--
-- Index pour la table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stalls_created_by_foreign` (`created_by`),
  ADD KEY `stalls_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_created_by_foreign` (`created_by`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal_vaccines`
--
ALTER TABLE `animal_vaccines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `calves`
--
ALTER TABLE `calves`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cows`
--
ALTER TABLE `cows`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cow_pregnancies`
--
ALTER TABLE `cow_pregnancies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `feed_chart`
--
ALTER TABLE `feed_chart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `milk_collection`
--
ALTER TABLE `milk_collection`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal_vaccines`
--
ALTER TABLE `animal_vaccines`
  ADD CONSTRAINT `animal_vaccines_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `animal_vaccines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `animal_vaccines_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `calves`
--
ALTER TABLE `calves`
  ADD CONSTRAINT `calves_cow_id_foreign` FOREIGN KEY (`cow_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calves_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calves_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cows`
--
ALTER TABLE `cows`
  ADD CONSTRAINT `cows_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cows_stall_id_foreign` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cow_pregnancies`
--
ALTER TABLE `cow_pregnancies`
  ADD CONSTRAINT `cow_pregnancies_cow_id_foreign` FOREIGN KEY (`cow_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_pregnancies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_pregnancies_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD CONSTRAINT `employee_salaries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `feed_chart`
--
ALTER TABLE `feed_chart`
  ADD CONSTRAINT `feed_chart_cow_id_foreign` FOREIGN KEY (`cow_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feed_chart_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feed_chart_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `milk_collection`
--
ALTER TABLE `milk_collection`
  ADD CONSTRAINT `milk_collection_cow_id_foreign` FOREIGN KEY (`cow_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `milk_collection_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `milk_collection_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `routines`
--
ALTER TABLE `routines`
  ADD CONSTRAINT `routines_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routines_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_animal_id_foreign` FOREIGN KEY (`animal_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `stalls_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stalls_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
