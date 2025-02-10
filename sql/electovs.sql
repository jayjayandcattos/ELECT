-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 05:16 AM
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
-- Database: `electovs`
--

-- --------------------------------------------------------

--
-- Table structure for table `archived_candidates`
--

CREATE TABLE `archived_candidates` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `party_list` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `archived_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_candidates`
--

INSERT INTO `archived_candidates` (`id`, `candidate_id`, `first_name`, `surname`, `position`, `party_list`, `picture`, `archived_at`) VALUES
(1, 12, 'Akashi', 'Seijuro', 'President', 'Generation of Miracles', '../Pics/candidate_pictures/AKASHI.png', '2024-12-05 15:38:25'),
(2, 13, 'Aubrey', 'Graham', 'President', 'October\'s Very Own', '../Pics/candidate_pictures/DRAKE.png', '2024-12-05 15:38:28'),
(3, 14, 'Kendrick Lamar', 'Duckworth', 'President', 'pgLang', '../Pics/candidate_pictures/KENNY.png', '2024-12-05 15:38:29'),
(4, 18, 'Erickson', 'Guhilde', 'Secretary', 'Generation of Miracles', '../Pics/candidate_picturesScreenshot 2024-04-18 222504.png', '2024-12-05 15:38:31'),
(5, 19, 'Ellizier', 'Patriarca', 'Public Relations Officer (PRO)', 'pgLang', '../Pics/candidate_pictures1by1.png', '2024-12-05 15:38:32'),
(6, 20, 'Rain', 'Opinion', 'Vice President', 'Generation of Miracles', '../Pics/candidate_pictures1by1.png', '2024-12-05 15:38:33'),
(7, 21, 'Adrian', 'Frivaldo', 'Treasurer', 'Generation of Miracles', '../Pics/candidate_picturesScreenshot 2024-05-07 204311.png', '2024-12-05 15:38:35'),
(8, 23, 'Roland', 'Verdan', 'Event Coordinator', 'Generation of Miracles', '../Pics/candidate_picturesKSANTEEEEE.png', '2024-12-05 15:38:37'),
(9, 25, 'Rain', 'Rojo', 'Councilor for Logistics & Events', 'SLAY Partylist', '6751cb3079184.png', '2024-12-05 15:48:08'),
(10, 24, 'Rain', 'Rojo', 'Councilor for Logistics & Events', 'SLAY Partylist', '6751cae96ce38.png', '2024-12-05 15:49:37'),
(11, 26, 'Rain', 'Rojo', 'Councilor for Logistics & Events', 'SLAY Partylist', '6751cbb79fb8c.png', '2024-12-05 15:50:22'),
(12, 27, 'Rain', 'Rojo', 'Councilor for Logistics & Events', 'SLAY Partylist', '6751ccccf2234.png', '2024-12-05 16:00:41'),
(13, 29, 'Lester', 'Gabitan', 'Councilor for External Affairs', 'SLAY Partylist', '../Pics/candidate_pictures/LESTER.png', '2024-12-05 16:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `archived_party_lists`
--

CREATE TABLE `archived_party_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_party_lists`
--

INSERT INTO `archived_party_lists` (`id`, `name`, `created_at`) VALUES
(1, 'October\'s Very Own', '2024-11-15 02:22:31'),
(2, 'pgLang', '2024-11-15 02:23:59'),
(3, 'Generation of Miracles', '2024-11-15 05:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `archived_users`
--

CREATE TABLE `archived_users` (
  `archive_id` int(11) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_users`
--

INSERT INTO `archived_users` (`archive_id`, `student_id`, `first_name`, `surname`, `role_id`, `deleted_at`) VALUES
(1, '231933', 'Admin', 'sads', 1, '2024-11-30 15:40:51'),
(2, '23-1933', 'Samantha', 'Jumuad', 1, '2024-12-01 13:28:04'),
(3, '23-1840', 'Justin Christopher', 'Rivera', 1, '2024-12-05 16:09:43'),
(4, '12-3456', 'Test', 'Test', 1, '2024-12-05 16:11:16'),
(5, '12-3456', 'Test', 'Test', 1, '2024-12-05 16:12:25'),
(6, '23-1840', 'Justin Christopher', 'Rivera', 1, '2024-12-05 16:17:51'),
(7, '23-1933', 'Samantha Queen', 'Jumuad', 1, '2024-12-05 16:17:51'),
(9, '1-800', 'Admin', 'ADMIN', 0, '2024-12-05 16:57:56'),
(10, '66-6666', 'Justin Christopher', 'Rivera', 0, '2024-12-05 18:37:49'),
(11, '66-6666', 'Justin Christopher', 'Rivera', 0, '2024-12-05 18:39:26'),
(12, '23-2253', 'Winston', 'Bautista', 1, '2024-12-06 17:33:09'),
(13, '66-6666', 'Justin Christopher', 'Rivera', 1, '2024-12-06 17:33:14'),
(14, '98-7654', 'TEST', 'TEST', 1, '2024-12-06 17:33:19'),
(15, '23-9999', 'Testy', 'Test', 1, '2024-12-06 17:33:21'),
(16, '23-1840', 'Justin Christopher', 'Rivera', 1, '2024-12-07 03:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `party_list` varchar(50) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `platform` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `first_name`, `surname`, `position`, `party_list`, `picture`, `timestamp`, `platform`) VALUES
(2, 'Brienna', 'Santos', 'President', 'SLAY Partylist', '../Pics/candidate_pictures/Brienna.png', '2024-12-05 17:26:16', 'Slay.'),
(3, 'Axle Dred', 'Agustin', 'Vice President for Operations', 'SLAY Partylist', '../Pics/candidate_pictures/AGUSTIN.png', '2024-12-05 17:25:51', 'Slay.'),
(4, 'Geovhan', 'Magdadaro', 'Vice President for Internal Affairs', 'SLAY Partylist', '../Pics/candidate_pictures/MAGDARABAO.png', '2024-12-05 17:25:18', 'Slay.'),
(5, 'MJ', 'Ibo', 'Vice President for External Affairs', 'SLAY Partylist', '../Pics/candidate_pictures/IBO.png', '2024-12-05 17:24:32', 'Slay.'),
(6, 'Reynalyn', 'Dela Cruz', 'Executive Secretary', 'SLAY Partylist', '../Pics/candidate_pictures/REYNALYN.png', '2024-12-05 17:23:51', 'Slay.'),
(7, 'Chate', 'Del Carmen', 'Auditor', 'SLAY Partylist', '../Pics/candidate_pictures/CHATE.png', '2024-12-05 17:23:03', 'Slay.'),
(8, 'Hannah', 'Macatangay', 'Treasurer', 'SLAY Partylist', '../Pics/candidate_pictures/HANNAH.png', '2024-12-05 17:21:10', 'Slay.'),
(9, 'Althea', 'Llantino', 'Councilor for Information Dissemination', 'SLAY Partylist', '../Pics/candidate_pictures/ALTHEA.png', '2024-12-05 17:20:30', 'Slay.'),
(10, 'Patricia', 'Arroyo', 'Councilor for Documentaries and Reports', 'SLAY Partylist', '../Pics/candidate_pictures/KONSIPAT.png', '2024-12-05 17:17:29', 'Slay.'),
(11, 'Rod', 'Deniega', 'Councilor for Membership', 'SLAY Partylist', '../Pics/candidate_pictures/ROD.png', '2024-12-05 17:05:33', 'Slay.'),
(12, 'Vincent', 'Cabuslay', 'Councilor for Internal Affairs', 'SLAY Partylist', '../Pics/candidate_pictures/VINCENT.png', '2024-12-05 17:05:08', 'Slay.'),
(13, 'Lester', 'Gabitan', 'Councilor for External Affairs', 'SLAY Partylist', '../Pics/candidate_pictures/LESTER.png', '2024-12-05 17:04:32', 'Slay.'),
(14, 'Rain', 'Rojo', 'Councilor for Logistics & Events', 'SLAY Partylist', '../Pics/candidate_pictures/RAIN.png', '2024-12-05 17:00:30', 'Slay.'),
(42, 'Julius', 'Laguna', 'President', 'Enigma Partylist', '../Pics/candidate_pictures/JULLYUS.png', '2024-12-06 19:07:33', 'AMGINE.'),
(43, 'Roland', 'Verdan', 'Vice President for Operations', 'Enigma Partylist', '../Pics/candidate_pictures/VERDAN.png', '2024-12-06 19:07:50', 'AMGINE.'),
(44, 'John Andrei', 'Bondilles', 'Vice President for External Affairs', 'Enigma Partylist', '../Pics/candidate_pictures/BONDI.png', '2024-12-06 19:08:24', 'AMGINE.'),
(45, 'Louise', 'Moreno', 'Councilor for Membership', 'Enigma Partylist', '../Pics/candidate_pictures/MORENO.png', '2024-12-06 19:08:43', 'AMGINE.'),
(46, 'Christian Jay', 'Malong', 'Vice President for Internal Affairs', 'Enigma Partylist', '../Pics/candidate_pictures/CJMALONG.png', '2024-12-06 19:09:14', 'AMGINE.'),
(47, 'Ellizier', 'Patriarca', 'Councilor for Logistics & Events', 'Enigma Partylist', '../Pics/candidate_pictures/ELLI.png', '2024-12-06 19:09:35', 'AMGINE.');

-- --------------------------------------------------------

--
-- Table structure for table `party_lists`
--

CREATE TABLE `party_lists` (
  `party_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `platform` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `party_lists`
--

INSERT INTO `party_lists` (`party_id`, `name`, `picture`, `timestamp`, `created_at`, `platform`) VALUES
(14, 'SLAY Partylist', '../Pics/party_lists/SLAY.png', '2024-12-05 23:40:13', '2024-12-05 23:40:13', 'Student Leaders Advocating for Empowerment.'),
(15, 'Akatsuki', '../Pics/party_lists/AKATSUKI.png', '2024-12-06 02:09:34', '2024-12-06 02:09:34', 'The revival of the god.'),
(16, 'Phantom Troupe', '../Pics/party_lists/PHANTOMTROUPE.png', '2024-12-06 02:13:54', '2024-12-06 02:13:54', 'To wreak havoc.'),
(17, 'Enigma Partylist', '../Pics/party_lists/Enigma Partylist.png', '2024-12-07 01:59:46', '2024-12-07 01:59:46', 'Ang samahang tunay, 2-I.');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'voter');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `first_name`, `surname`, `password`, `created_at`, `role_id`) VALUES
(10, '23-1933', 'Samantha', 'Jumuad', '$2y$10$oY9CKKRn2aEWXrcSz3HSPeynk58sx75B3wuNlSlZJ3gW4cAxKkDM2', '2024-12-05 18:37:26', 1),
(15, '55-5555', 'Justin Christopher', 'Rivera', '$2y$10$JnI5lVa9QQEsx5Rk9DLxc.4i1sBXIFWDRPOpRPTOwBGYgmqoZIvv2', '2024-12-05 18:40:00', 0),
(17, '23-1900', 'Heila', 'Longaquit', '$2y$10$zHCR/0.e8G9X6v/BXcAxn.SetriqfdT4g5qfGH3n/KKc1rF5jqPBS', '2024-12-06 17:02:28', 1),
(19, '23-9875', 'Carlo', 'Castillano', '$2y$10$CDtcIBoYKd9e5Wl41DAwy.VZ6KMZr9pU/DTwleOBESgsq45UWm7ku', '2024-12-07 03:27:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  `vote_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `student_id`, `candidate_id`, `vote_timestamp`) VALUES
(1, '23-1840', 2, '2024-12-07 01:02:03'),
(2, '23-1840', 3, '2024-12-07 01:02:03'),
(3, '23-1840', 4, '2024-12-07 01:02:03'),
(4, '23-1840', 5, '2024-12-07 01:02:03'),
(5, '23-1840', 6, '2024-12-07 01:02:03'),
(6, '23-1840', 7, '2024-12-07 01:02:03'),
(7, '23-1840', 8, '2024-12-07 01:02:03'),
(8, '23-1840', 9, '2024-12-07 01:02:03'),
(9, '23-1840', 10, '2024-12-07 01:02:03'),
(10, '23-1840', 11, '2024-12-07 01:02:03'),
(11, '23-1840', 12, '2024-12-07 01:02:03'),
(12, '23-1840', 13, '2024-12-07 01:02:03'),
(13, '23-1840', 47, '2024-12-07 01:02:03'),
(14, '23-1933', 42, '2024-12-07 03:17:03'),
(15, '23-1933', 3, '2024-12-07 03:17:03'),
(16, '23-1933', 46, '2024-12-07 03:17:03'),
(17, '23-1933', 5, '2024-12-07 03:17:03'),
(18, '23-1933', 6, '2024-12-07 03:17:03'),
(19, '23-1933', 7, '2024-12-07 03:17:03'),
(20, '23-1933', 8, '2024-12-07 03:17:03'),
(21, '23-1933', 9, '2024-12-07 03:17:03'),
(22, '23-1933', 10, '2024-12-07 03:17:03'),
(23, '23-1933', 11, '2024-12-07 03:17:03'),
(24, '23-1933', 12, '2024-12-07 03:17:03'),
(25, '23-1933', 13, '2024-12-07 03:17:03'),
(26, '23-1933', 47, '2024-12-07 03:17:03'),
(27, '23-1900', 2, '2024-12-07 04:05:01'),
(28, '23-1900', 43, '2024-12-07 04:05:01'),
(29, '23-1900', 46, '2024-12-07 04:05:01'),
(30, '23-1900', 44, '2024-12-07 04:05:01'),
(31, '23-1900', 6, '2024-12-07 04:05:01'),
(32, '23-1900', 7, '2024-12-07 04:05:01'),
(33, '23-1900', 8, '2024-12-07 04:05:01'),
(34, '23-1900', 9, '2024-12-07 04:05:01'),
(35, '23-1900', 10, '2024-12-07 04:05:01'),
(36, '23-1900', 11, '2024-12-07 04:05:01'),
(37, '23-1900', 12, '2024-12-07 04:05:01'),
(38, '23-1900', 13, '2024-12-07 04:05:01'),
(39, '23-1900', 47, '2024-12-07 04:05:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archived_candidates`
--
ALTER TABLE `archived_candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_party_lists`
--
ALTER TABLE `archived_party_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archived_users`
--
ALTER TABLE `archived_users`
  ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `party_lists`
--
ALTER TABLE `party_lists`
  ADD PRIMARY KEY (`party_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `student_id_2` (`student_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archived_candidates`
--
ALTER TABLE `archived_candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `archived_party_lists`
--
ALTER TABLE `archived_party_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `archived_users`
--
ALTER TABLE `archived_users`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `party_lists`
--
ALTER TABLE `party_lists`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
