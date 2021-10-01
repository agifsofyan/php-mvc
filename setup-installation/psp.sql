-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2021 at 03:00 PM
-- Server version: 10.5.11-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psp`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `hp`, `email`, `create_at`, `updated_at`) VALUES
(1, 'Budi', '08987726754', 'budi@gmail.com', '2021-07-15 14:46:57', NULL),
(15, 'Nino', '08123456789', 'nino@gmail.com', '2021-07-15 17:06:11', NULL),
(16, 'Rika', '08989900121', 'rika@gmail.com', '2021-07-20 05:38:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(2) DEFAULT 1,
  `payment_id` int(11) DEFAULT NULL,
  `unique_number` int(3) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `paid_at` datetime DEFAULT NULL,
  `status_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `product_id`, `qty`, `payment_id`, `unique_number`, `total_price`, `status`, `created_at`, `paid_at`, `status_by`) VALUES
(12, 15, 16, 1, 5, 443, 3343433877, 'unpaid', '2021-07-20 22:56:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bank transfer',
  `alias` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BCA',
  `account_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinytext COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `title`, `alias`, `vendor`, `account_name`, `account_number`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'bank transfer', '', 'BNI', 'LARUNO', '8831310000', '1', '2021-07-20 22:42:32', NULL),
(5, 'bank transfer', '', 'BCA', 'LARUNO', '8831310006', '1', '2021-07-20 22:43:09', NULL),
(7, 'bank transfer', '', 'BNIKKL', 'LARUNO', '454545454545454', '1', '2021-07-20 22:51:25', NULL),
(8, 'bank transfer', '', 'BNIKKL', 'IIS DAHLIA', '8676767676769', '1', '2021-07-20 22:54:59', '2021-07-20 22:54:59'),
(9, 'bank transfer', '', 'BNI454545', 'LARUNO', '545454545454', '1', '2021-07-20 22:59:42', NULL),
(10, 'bank transfer', '', 'KBI', 'GDDGDGDGD', '77777888888877', '1', '2021-07-20 23:40:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `slug`, `image`, `description`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'buku', 21000, 'buku', '/assets/images/uploads/240-2408117_marvel-folder-icon-by-andreas86-marvel-ico.png', 'Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32. &nbsp; The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. &nbsp;', 1, 1, '2021-07-12 23:39:42', NULL),
(5, 'sendal ajaib', 123000, 'sendal_ajaib', '/assets/images/uploads/award2.png', '', 5, 1, '2021-07-12 23:39:42', '2021-07-04 18:40:14'),
(6, 'sample product1', 100, 'sample-product1', '/assets/images/uploads/justwait.jpg', 'Discription', 3, 1, '2021-07-12 20:52:41', NULL),
(15, 'new product 123', 120000, 'new-product-123', '/assets/images/uploads/ASEAN.jpeg', 'Ini Deskripsi lagi', 3, 1, '2021-07-18 12:15:32', '2021-07-18 12:15:31'),
(16, 'rika', 3343433434, 'rika', '/assets/images/uploads/cv-poster.png', 'asasasasa', 3, 1, '2021-07-20 22:55:29', NULL),
(20, 'ecourse wordpress anonymous', 1000000, 'ecourse-wordpress-anonymous', '/assets/images/uploads/', '', 3, 1, '2021-07-23 14:55:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `create_at`, `updated_at`, `last_login`, `is_active`) VALUES
(1, 'ninja', '$2y$10$b/7cR0KMIwaWh1xwfFZMJ./4hAcO3kMnswO9amg4pHD2mmHbItmZS', 'cs', '2021-07-20 20:26:52', '2021-07-20 20:26:52', '2021-07-11 10:12:37', 1),
(2, 'admin', '$2y$10$OQcan5i7G7rIl8yu74DIv.0.pCKAAJdSB4q24Ry3VLMFuEo1QRpte', 'admin', '2021-07-20 22:07:28', NULL, '2021-07-20 22:07:28', 1),
(3, 'admin2', '$2y$10$fSAa6AckiznYSZq2eoFNAOLzzLqrcKGWfy42PPB92hHKKRLKS85Yy', 'superadmin', '2021-07-23 16:31:13', NULL, '2021-07-23 16:31:13', 1),
(5, 'superadmin', '$2y$10$gm/gPRUpeZSV9wo1xMfaSOOp2xOknzG9sYsbR5MgSONuhOvRaV/Qe', 'supervisor', '2021-07-11 12:00:10', NULL, NULL, 1),
(6, 'diana', '', 'superadmin', '2021-07-20 21:46:41', '2021-07-20 21:46:41', '2021-07-20 21:21:37', 1),
(7, 'jina', '$2y$10$aPc2srP7A.MbwPplSETzbeGjy1XKQvgSZcJuBj3fJo1t3vETG9no2', 'supervisor', '2021-07-12 12:27:58', NULL, NULL, 1),
(8, 'admin3', '$2y$10$Hdg2f/yl.lXskrM7v6ytN.AY32Y2Y3aONQEtqcrdAQDauEINu5sb.', 'supervisor', '2021-07-20 22:54:40', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hp` (`hp`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `status_by` (`status_by`),
  ADD KEY `FK` (`customer_id`,`product_id`,`payment_id`,`status_by`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`status_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
