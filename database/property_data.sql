-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mydb
-- Generation Time: Mar 12, 2024 at 02:25 PM
-- Server version: 8.0.32
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luxus`
--

-- --------------------------------------------------------

--
-- Table structure for table `property_data`
--

CREATE TABLE `property_data` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `bedrooms` int UNSIGNED NOT NULL,
  `bathrooms` int UNSIGNED NOT NULL,
  `storeys` int UNSIGNED NOT NULL,
  `garages` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_data`
--

INSERT INTO `property_data` (`id`, `name`, `price`, `bedrooms`, `bathrooms`, `storeys`, `garages`, `created_at`, `updated_at`) VALUES
(1, 'The Victoria', 374662, 4, 2, 2, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(2, 'The Xavier', 513268, 4, 2, 1, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(3, 'The Como', 454990, 4, 3, 2, 3, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(4, 'The Aspen', 384356, 4, 2, 2, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(5, 'The Lucretia', 572002, 4, 3, 2, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(6, 'The Toorak', 521951, 5, 2, 1, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(7, 'The Skyscape', 263604, 3, 2, 2, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(8, 'The Clifton', 386103, 3, 2, 1, 1, '2024-03-12 12:53:38', '2024-03-12 12:53:38'),
(9, 'The Geneva', 390600, 4, 3, 2, 2, '2024-03-12 12:53:38', '2024-03-12 12:53:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property_data`
--
ALTER TABLE `property_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property_data`
--
ALTER TABLE `property_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
