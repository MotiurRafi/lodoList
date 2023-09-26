-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 09:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `gender` varchar(11) NOT NULL,
  `birth_d` int(7) NOT NULL,
  `birth_m` varchar(7) NOT NULL,
  `birth_y` int(7) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `duedate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `bio`, `gender`, `birth_d`, `birth_m`, `birth_y`, `profession`, `duedate`) VALUES
(1, 16, 'Motiur', 'Rahman', '', 'Male', 4, 'Aug', 2007, 'web_developer', '2023-09-27 00:37:40'),
(2, 17, 'Motiur', 'Rahman', '12', 'Male', 18, 'Jan', 2005, 'web_developer', '2023-09-27 01:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `duedate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `task`, `priority`, `duedate`) VALUES
(1, 16, 'i should complete my homework!!!!!!!!!!!!!!!!!!!!!!', 'High', '2023-09-27 00:43:34'),
(2, 17, 'i should do my homework !!!!!!!!!!!!!!!!!!', 'High', '2023-09-27 01:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `duedate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `duedate`) VALUES
(1, 'Motiur', 'motiurrafi601@gmail.com', 'Motiur Rafi', '2023-09-24 23:15:37'),
(3, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$tH2fHmWKZcpIZL.l6b/ldOZD1HoMQfKnLDpnmkFFHDxnhBnE6wKmu', '2023-09-24 23:41:47'),
(5, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$Mu0NQrOXSuZDhFZIRET0vutmg1woZyrijwr01KUsWuEYGokO6977a', '2023-09-24 23:41:48'),
(6, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$V5RI1ik5ifqfX.LS/5NRXOTIRmNSFTlXKErLRvq4Vj2ixWfhzXIFe', '2023-09-24 23:48:26'),
(8, 'Rafii11', 'motiurra12fi601@gmail.com', '$2y$10$WO0jfVAEjBfO1WbNIQf10OU3QfEv9RFf0l88cfv9QEK86H8bt30bG', '2023-09-25 01:24:55'),
(9, 'asas', 'motytiurrafasasi601@gmail.com', '$2y$10$59Y.DtDl8MDUw9PVbv4vtu.FHimjWfhKJSJTqw3KdFRalj7tZFQF2', '2023-09-25 01:32:40'),
(12, 'rahman', 'motytissurrafi601@gmail.com', '$2y$10$ubKVXn8jNMXn2TzVeq8LdOhkZZiH6zP05NvyttHwJcGrPITDn/Eli', '2023-09-25 03:55:13'),
(13, 'wwww', 'motiurr23afi601@gmail.com', '$2y$10$5oC1OIvxe.SeumJBgP8AfuxqzfBp9QH1JFX2.uNvM0zapKRXumo/m', '2023-09-25 04:03:44'),
(14, '12', 'motytiugfgfgfgrrafi601@gmail.com', '$2y$10$G11S8mgABqj0.sOr1eNqH.h7pWk7eJR3Tjq6sgdm3EYK64mUqPuYC', '2023-09-26 02:13:29'),
(15, 'ra', 'sdsdsd@gmail.com', '$2y$10$1zBd.awFEe4d/uTim2plFuwqty2TK0SqU.cYAVDjX4BTt3SJuL/sC', '2023-09-27 00:14:26'),
(16, 'Motiur Rahman', 'motiurrafi6012@gmail.com', '$2y$10$jhn46SuW11diryuEqVoy/OwtP6CNjdSPKgT3CMqp9EGHPD1fYRtfq', '2023-09-27 00:37:39'),
(17, 'Coder', 'mmotiurrafi601@gmail.com', '$2y$10$ycue5kGsxqNlIKZP8wMIsOdp7ASfwRWv28bLfT2C7g7Sc1qPM4QNO', '2023-09-27 01:17:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
