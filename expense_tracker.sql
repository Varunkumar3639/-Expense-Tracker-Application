-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 06:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `description`, `amount`, `category`, `date`, `created_at`) VALUES
(3, 3, 'govi', 20.00, 'vegitable', '2025-04-26', '2025-04-26 11:02:14'),
(4, 3, 'apple', 56.00, 'fruit', '2025-04-26', '2025-04-26 11:02:33'),
(6, 3, 'patato', 52.00, 'vegitable', '2025-04-27', '2025-04-26 11:03:21'),
(7, 3, 'tamato', 41.00, 'vegitable', '2025-04-27', '2025-04-26 11:03:42'),
(8, 3, 'palak', 20.00, 'vegitable', '2025-04-27', '2025-04-26 11:04:20'),
(9, 4, 'vivo', 10000.00, 'mobile', '2025-04-16', '2025-04-26 11:06:52'),
(10, 4, 'sumsung', 2500.00, 'earbad', '2025-04-16', '2025-04-26 11:07:41'),
(11, 4, 'microphone', 500.00, 'charger', '2025-04-30', '2025-04-26 11:08:27'),
(12, 4, 'leather cover', 400.00, 'mobile cover', '2025-04-30', '2025-04-26 11:09:41'),
(13, 3, 'diesal', 500.00, 'fuel', '2025-04-30', '2025-04-26 11:38:01'),
(14, 3, 'petrol', 400.00, 'fuel', '2025-04-30', '2025-04-26 11:38:31'),
(15, 3, 'cng', 300.00, 'fuel', '2025-04-30', '2025-04-26 11:39:39'),
(16, 4, 'table', 5000.00, 'furnicture', '2025-05-01', '2025-04-26 11:43:25'),
(17, 4, 'chair', 1500.00, 'furnicture', '2025-05-01', '2025-04-26 11:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(3, 'varun kumar', 'varun@gmail.com', '$2y$10$fVCpuTxOj7rlIfHQxC/cxuUQtfB7OgcDbJKvaaw2VKkfoQb5/tiNe', '2025-04-26 10:15:11'),
(4, 'admin', 'admin@gmail.com', '$2y$10$e1f2Hefh.vJOeGRkko8.FeaRY0RQ9aHnnyqvY.rRsu5avckwjIXxS', '2025-04-26 10:18:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
