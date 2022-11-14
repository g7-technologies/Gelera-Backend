-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 04:31 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gelera`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `wallet_address` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `mining_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `referal_code` varchar(255) NOT NULL,
  `total_coins` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invited_by` varchar(255) DEFAULT NULL,
  `notification_number` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `device_ids`
--

CREATE TABLE `device_ids` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_ids`
--

INSERT INTO `device_ids` (`id`, `customer_id`, `device_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'dK39rAwOR0Goc49Za7TSLn:APA91bGSRcy2v6Xodrhv6rB17mE_ifHg9lSNb2_0GrtyoezAMDc7ANokWHYjqud5CZUB7eDdGqL7rQJ7BmArbIywW1WGyQgmCmcg_hYz1XSOfxOqAOi8NWbzWTg4wFDm5cHTnnlleT-d', '2022-10-23 11:01:54', '2022-10-23 11:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(2, 'q', 'a', '2022-10-27 10:34:50', '2022-10-27 10:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `minings`
--

CREATE TABLE `minings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `coins` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `minings`
--

INSERT INTO `minings` (`id`, `customer_id`, `coins`, `created_at`, `updated_at`) VALUES
(1, 1, '200.00', '2022-10-06 20:13:13', '2022-10-06 20:13:13'),
(2, 1, '100.00', '2022-10-06 20:13:13', '2022-10-06 20:13:13'),
(3, 1, '50.00', '2022-10-05 20:13:32', '2022-10-06 20:13:32'),
(4, 2, '300.00', '2022-10-06 20:13:32', '2022-10-06 20:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `miscs`
--

CREATE TABLE `miscs` (
  `id` int(11) NOT NULL,
  `daily_limit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `referal_bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `default_mining_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `coin_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `miscs`
--

INSERT INTO `miscs` (`id`, `daily_limit`, `referal_bonus`, `default_mining_rate`, `coin_price`, `created_at`, `updated_at`) VALUES
(1, '2.00', '3.00', '4.00', '0.10', '2022-10-06 22:58:42', '2022-10-10 09:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `social_media_links`
--

CREATE TABLE `social_media_links` (
  `id` int(11) NOT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `discord` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `vimeo` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_media_links`
--

INSERT INTO `social_media_links` (`id`, `twitter`, `facebook`, `linkedin`, `instagram`, `discord`, `google`, `youtube`, `vimeo`, `pinterest`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-06 23:13:43', '2022-10-06 18:27:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_ids`
--
ALTER TABLE `device_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minings`
--
ALTER TABLE `minings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miscs`
--
ALTER TABLE `miscs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media_links`
--
ALTER TABLE `social_media_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `device_ids`
--
ALTER TABLE `device_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `minings`
--
ALTER TABLE `minings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `miscs`
--
ALTER TABLE `miscs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media_links`
--
ALTER TABLE `social_media_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
