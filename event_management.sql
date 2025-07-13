-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 10:51 AM
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
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `event_date`) VALUES
(1, 'Spandan', 'Spandan is the cultural heartbeat of XIE, celebrating creativity and talent in music, dance, drama, and art. With vibrant performances, energetic competitions, and enthusiastic participation from students across colleges, Spandan brings the campus to life. It fosters a spirit of unity and provides a platform for students to showcase their artistic side beyond academics.', '2025-02-02'),
(2, 'Transmission', 'Transmission is XIE’s flagship technical festival, packed with coding challenges, project exhibitions, robotics contests, and expert talks. It brings together tech enthusiasts to explore innovations, engage in knowledge sharing, and compete in a variety of brain-teasing events. Transmission is where ideas meet implementation.', '2025-02-02'),
(3, 'Sparx', 'Sparx is the annual sports fest of XIE, promoting physical fitness, teamwork, and competitive spirit. From cricket and football to indoor games like chess and table tennis, Sparx brings together athletes from various streams to battle it out for glory. It’s a celebration of strength, stamina, and sportsmanship.', '2025-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `name`, `email`, `event_id`) VALUES
(1, 'Aniruddha kule', 'aniruddhakule@gmail.com', 1),
(2, 'pusshkar ghag', 'pusshkar@gmail.com', 3),
(3, 'pusshkar ghag', 'pusshkar@gmail.com', 3),
(4, 'pusshkar ghag', 'pusshkar@gmail.com', 3),
(5, 'ansh mishra', 'ansh@example.com', 2),
(6, 'ansh mishra', 'ansh@example.com', 2),
(7, 'ansh mishra', 'ansh@example.com', 2),
(8, 'ansh mishra', 'ansh@example.com', 2),
(9, 'mihir', 'mihir@gmail.conm', 3),
(10, 'rajeev dudhasagare', 'rajeev@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'shahid mulla', 'shahid', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `winner_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`id`, `event_id`, `winner_name`) VALUES
(1, 1, 'aniruddha'),
(2, 3, 'pusshkar'),
(3, 1, 'shivam gupta'),
(4, 3, 'piyusha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `winners`
--
ALTER TABLE `winners`
  ADD CONSTRAINT `winners_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
