-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 08:06 AM
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
  `bio` varchar(250) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `birth_d` int(7) NOT NULL,
  `birth_m` varchar(7) NOT NULL,
  `birth_y` int(7) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `duedate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `bio`, `gender`, `birth_d`, `birth_m`, `birth_y`, `profession`, `duedate`) VALUES
(1, 12, 'sdf', 'gsdd', 'sdffsdfs', 'male', 23, 'jan', 2003, 'web developer', '2023-09-24 23:23:06'),
(2, 2, 'Motiur', 'Rahman', 'yhjghjhgj', 'male', 19, '1', 1990, 'web_developer', '2023-09-24 23:38:02'),
(3, 3, 'Motiur', 'Rahman', 'yhjghjhgj', 'male', 19, '1', 1990, 'web_developer', '2023-09-24 23:41:47'),
(4, 4, 'Motiur', 'Rahman', 'yhjghjhgj', 'male', 19, '1', 1990, 'web_developer', '2023-09-24 23:41:47'),
(5, 5, 'Motiur', 'Rahman', 'yhjghjhgj', 'male', 19, '1', 1990, 'web_developer', '2023-09-24 23:41:48'),
(6, 6, 'Motiur', 'Rahman', 'yhjghjhgj', 'male', 19, '1', 1990, 'web_developer', '2023-09-24 23:48:26'),
(7, 7, 'Motiur', 'Rahman', 'Motiur Rahman', 'male', 9, 'Mar', 2006, 'web_developer', '2023-09-24 23:48:59'),
(8, 8, 'erere', 'edrer', '1212', 'male', 2, 'Feb', 1995, 'web_developer', '2023-09-25 01:24:55'),
(9, 9, 'Motiur', 'Rahman', 'asd', 'male', 1, 'Feb', 1991, 'web_developer', '2023-09-25 01:32:40'),
(10, 10, 'Motiur', 'Rahman', 'sd', 'male', 2, 'Mar', 1998, 'web_developer', '2023-09-25 01:33:28'),
(11, 11, 'Motiur', 'Rahman', '12', 'Male', 17, 'Jan', 2006, 'web_developer', '2023-09-25 03:31:04'),
(12, 12, 'Motiur', 'Rahman', 'dasdads', 'Male', 17, 'Mar', 2004, 'web_developer', '2023-09-25 03:55:13'),
(13, 13, 'Motiur', 'Rahman', 'qwq', 'Male', 17, 'Jan', 2003, 'web_developer', '2023-09-25 04:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `duedate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `task`, `priority`, `duedate`) VALUES
(1, 12, 'i am rafi', 'high ', '2023-09-25 10:48:08'),
(2, 13, 'wewe', 'How', '2023-09-25 11:00:47'),
(3, 13, 'wewe', 'How', '2023-09-25 11:02:48'),
(4, 13, 'wewe', 'How', '2023-09-25 11:03:56'),
(5, 0, 'wewe', 'How', '2023-09-25 11:07:35'),
(6, 0, 'rrrrrr', 'How', '2023-09-25 11:07:59'),
(7, 13, '4444444', 'Medium', '2023-09-25 11:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `duedate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `duedate`) VALUES
(1, 'Motiur', 'motiurrafi601@gmail.com', 'Motiur Rafi', '2023-09-24 23:15:37'),
(2, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$ftK41Ppv5dJZLgf0dQeJEu7a0d0nfCpHLJQgCJTp1LyiLQcQnRiHa', '2023-09-24 23:38:02'),
(3, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$tH2fHmWKZcpIZL.l6b/ldOZD1HoMQfKnLDpnmkFFHDxnhBnE6wKmu', '2023-09-24 23:41:47'),
(4, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$RpRmkMBmCxz57zzcMDii/OdHJmcOzM5iyRr49yNRnC343phEshoQ6', '2023-09-24 23:41:47'),
(5, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$Mu0NQrOXSuZDhFZIRET0vutmg1woZyrijwr01KUsWuEYGokO6977a', '2023-09-24 23:41:48'),
(6, 'Rafi', 'motiurrafi601@gmail.com', '$2y$10$V5RI1ik5ifqfX.LS/5NRXOTIRmNSFTlXKErLRvq4Vj2ixWfhzXIFe', '2023-09-24 23:48:26'),
(7, 'Rafiii', 'motiurrafi601@gmail.com', '$2y$10$efxLw0WS0KHbVcUOY/goSukKIFEynNPDcdsAChNCwY/Vrk.pvw5S2', '2023-09-24 23:48:59'),
(8, 'Rafii11', 'motiurra12fi601@gmail.com', '$2y$10$WO0jfVAEjBfO1WbNIQf10OU3QfEv9RFf0l88cfv9QEK86H8bt30bG', '2023-09-25 01:24:55'),
(9, 'asas', 'motytiurrafasasi601@gmail.com', '$2y$10$59Y.DtDl8MDUw9PVbv4vtu.FHimjWfhKJSJTqw3KdFRalj7tZFQF2', '2023-09-25 01:32:40'),
(10, 'sd', 'motiurrss12fi601@gmail.com', '$2y$10$u3JoG0GVpsNXww6O0C7pse7UIA9cULcnzBRVJyWUfIf97LioJR7Pu', '2023-09-25 01:33:28'),
(11, 'Rafi11111111', 'moti1221urra12fi601@gmail.com', '$2y$10$UeVDm2d.Tp.3F7Qv0TTjbujw2HJiUn19Q.keWiAHBsVSYAH0iOGqW', '2023-09-25 03:31:04'),
(12, 'rahman', 'motytissurrafi601@gmail.com', '$2y$10$ubKVXn8jNMXn2TzVeq8LdOhkZZiH6zP05NvyttHwJcGrPITDn/Eli', '2023-09-25 03:55:13'),
(13, 'wwww', 'motiurr23afi601@gmail.com', '$2y$10$5oC1OIvxe.SeumJBgP8AfuxqzfBp9QH1JFX2.uNvM0zapKRXumo/m', '2023-09-25 04:03:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
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
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
