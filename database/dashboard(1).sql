-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2024 at 01:12 PM
-- Server version: 10.11.8-MariaDB-1
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `navbar`
--

CREATE TABLE `navbar` (
  `id` int(250) NOT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `physical_address` varchar(250) DEFAULT NULL,
  `logoName` varchar(250) DEFAULT NULL,
  `logoType` varchar(250) DEFAULT NULL,
  `logoSize` varchar(250) DEFAULT NULL,
  `logoDestination` varchar(250) DEFAULT NULL,
  `logoActualExt` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`id`, `phone`, `email`, `physical_address`, `logoName`, `logoType`, `logoSize`, `logoDestination`, `logoActualExt`) VALUES
(1, '0768540720', 'admin@gmail.com', 'Tudor', 'logo.png', 'image/png', '4353', 'uploads/logo.png', 'png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `first_name`, `last_name`) VALUES
(1, 'dan@gmail.com', 'dan', 'dan', 'dan'),
(2, '$email', '$pass', '$first_name', '$last_name'),
(3, '$email', '$pass', '$first_name', '$last_name'),
(4, 'root@gmail.com', '', 'dan', 'dan'),
(5, 'root@gmail.com', '', 'dan', 'dan'),
(6, 'root@gmail.com', 'pass', 'dan', 'dan'),
(7, 'ongudidan@gmail.com', 'ongudidan', 'dan', 'ongudi'),
(8, 'dan@gmail.com', 'test', 'dan', 'ongudi'),
(9, 'danny@gmail.com', 'test', 'dan', 'ongudi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
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
-- AUTO_INCREMENT for table `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
