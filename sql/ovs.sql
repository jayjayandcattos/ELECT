-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 02:23 PM
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
-- Database: `ovs`
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
(1, 3, 'Samantha Queen', 'Jumuad', 'Auditor', 'SLAY Partylist', 'uploads/Screenshot 2024-10-12 230056.png', '2024-10-20 13:44:19'),
(2, 5, 'Axel ', 'Lomigo', 'Vice President', 'MIND Party', 'uploads/Screenshot 2024-10-18 221445.png', '2024-10-20 13:59:48'),
(3, 7, 'Akashi ', 'Seijuro', 'President', 'Generation of Miracles', 'uploads/AKASHI.png', '2024-11-08 22:58:26'),
(4, 8, 'Akashi', 'Seijuro', 'President', 'Generation of Miracles', 'Pics/AKASHI.png', '2024-11-08 23:02:11'),
(5, 9, 'Akashi', 'Seijuro', 'President', 'Generation of Miracles', 'Pics/AKASHI.png', '2024-11-08 23:04:17'),
(6, 10, 'Akashi', 'Seijuro', 'President', 'Generation of Miracles', '../Pics/AKASHI.png', '2024-11-08 23:06:53'),
(7, 11, 'Akashi', 'Seijuro', 'President', 'Generation of Miracles', '../Pics/candidate_picturesAKASHI.png', '2024-11-08 23:09:50'),
(8, 4, 'Samantha Queen', 'Jumuad', 'Auditor', 'SLAY Partylist', 'uploads/Screenshot 2024-09-09 214443.png', '2024-11-15 04:52:53'),
(9, 6, 'jed', 'jed', 'President', 'ausgfhiafha', 'uploads/OIP.jpg', '2024-11-15 05:10:43'),
(10, 1, 'John Carlo', 'Castillano', 'Vice President', 'SLAY Partylist', 'uploads/Screenshot 2024-10-06 220220.png', '2024-11-15 05:20:19'),
(11, 16, 'Erickson', 'Guhilde', 'Secretary', 'October\\\'s Very Own', 'uploads/Screenshot 2024-10-09 214912.png', '2024-11-15 23:08:30'),
(12, 15, 'Erickson', 'Guhilde', 'Secretary', 'October\\\'s Very Own', 'uploads/Screenshot 2024-10-09 214912.png', '2024-11-15 23:09:08'),
(13, 17, 'Erickson', 'Guhilde', 'Public Relations Officer (PRO)', 'Generation of Miracles', '../Pics/candidate_picturesBG.png', '2024-11-15 23:09:47'),
(14, 22, 'Roland', 'Verdan', 'Secretary', 'October\\\'s Very Own', '../Pics/candidate_picturesKSANTEEEEE.png', '2024-11-16 00:45:48');

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
(1, 'MIND', '2024-10-11 16:46:32'),
(2, 'MINDFUL Partylist', '2024-10-11 17:09:21'),
(3, 'DEMURE Partylist', '2024-10-07 15:20:38'),
(4, 'Kill Party', '2024-10-20 14:01:10'),
(5, 'MINDFUL Partylist', '2024-10-20 13:35:57'),
(6, 'SLAY Partylist', '2024-10-07 15:20:38'),
(7, 'MIND Party', '2024-10-20 13:56:57'),
(8, 'asfas', '2024-11-06 10:17:41'),
(9, 'Testing Testing', '2024-11-06 10:17:58'),
(10, 'Generation of Miracles', '2024-11-08 22:28:34'),
(11, 'Generation of Miracles', '2024-11-08 22:39:35'),
(12, 'Test', '2024-11-15 05:09:59'),
(13, 'test', '2024-11-15 05:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `archived_users`
--

CREATE TABLE `archived_users` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_users`
--

INSERT INTO `archived_users` (`id`, `student_id`, `first_name`, `surname`, `role_id`, `deleted_at`) VALUES
(1, 123678, 'Samantha Queen', 'Jumuad', 1, '2024-10-20 13:40:16'),
(2, 123456, '', '', 0, '2024-11-15 01:51:37'),
(3, -999, 'Justin', 'Rivera', 1, '2024-11-16 00:05:43'),
(4, 124356, 'testing', 'testing', 1, '2024-11-16 00:06:21'),
(5, 6969, 'Justin', 'Rivera', 1, '2024-11-16 00:18:42'),
(6, 6969, 'Justin', 'Rivera', 1, '2024-11-16 00:28:49'),
(7, 6969, 'Justin', 'Rivera', 1, '2024-11-16 00:31:37'),
(8, 2143678, 'axel', 'axel', 1, '2024-11-16 02:27:34'),
(9, 1, 'TEST', 'test', 1, '2024-11-16 09:02:39'),
(10, 69, 'Gabriel', 'Chavez', 1, '2024-11-16 09:31:18');

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
(12, 'Akashi', 'Seijuro', 'President', 'Generation of Miracles', '../Pics/candidate_pictures/AKASHI.png', '2024-11-09 00:10:08', 'Winning is Absolute'),
(13, 'Aubrey', 'Graham', 'President', 'October\'s Very Own', '../Pics/candidate_pictures/DRAKE.png', '2024-11-15 02:25:43', 'Top three.'),
(14, 'Kendrick Lamar', 'Duckworth', 'President', 'pgLang', '../Pics/candidate_pictures/KENNY.png', '2024-11-15 02:26:55', 'Meet the Grahams.'),
(18, 'Erickson', 'Guhilde', 'Secretary', 'Generation of Miracles', '../Pics/candidate_picturesScreenshot 2024-04-18 222504.png', '2024-11-16 00:10:40', 'Erm, what the sigmaness?'),
(19, 'Ellizier', 'Patriarca', 'Public Relations Officer (PRO)', 'pgLang', '../Pics/candidate_pictures1by1.png', '2024-11-16 00:41:46', 'Grr imnida!'),
(20, 'Rain', 'Opinion', 'Vice President', 'Generation of Miracles', '../Pics/candidate_pictures1by1.png', '2024-11-16 00:42:07', 'Winning is absolute.'),
(21, 'Adrian', 'Frivaldo', 'Treasurer', 'Generation of Miracles', '../Pics/candidate_picturesScreenshot 2024-05-07 204311.png', '2024-11-16 00:43:09', 'Still Water for Everyone.'),
(23, 'Roland', 'Verdan', 'Event Coordinator', 'Generation of Miracles', '../Pics/candidate_picturesKSANTEEEEE.png', '2024-11-16 00:47:53', 'This is KSante. A champion 👤 with 4700 HP 💪 329 Armor 🤷‍♂  and 201 MR 💦 has Unstoppable🚫, a Shield🛡, and goes over walls 🧱');

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
(9, 'October\'s Very Own', '../Pics/party_lists/OVO.png', '2024-11-15 10:22:31', '2024-11-15 10:22:31', 'A lot - 21 Savage\r\n'),
(10, 'pgLang', '../Pics/party_lists/PGLANG.png', '2024-11-15 10:23:59', '2024-11-15 10:23:59', 'Take off the foo-foo, take off the clout chase, take off the Wi-Fi\r\nTake off the money phone, take off the car loan, take off the flex and the white lies.'),
(11, 'Generation of Miracles', '../Pics/party_lists/GOM.png', '2024-11-15 13:03:18', '2024-11-15 13:03:18', 'Winning is Absolute.');

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
  `student_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `first_name`, `surname`, `name`, `password`, `created_at`, `role_id`) VALUES
(15, 91892, 'Samantha', 'Jumuad', '', '$2y$10$EJjTjjCsfKpQ.8PP9u/TjeA4dUYwF21.wt.e5Bfh83iA7Hrx212kS', '2024-10-07 14:04:53', 1),
(21, 123489, 'Daniella', 'Jhasmin', '', '$2y$10$YP3hUCxdUN3hVznHyfvRa.FmtLJdkuESIm4DQKbsKAGx9rR9FaXn2', '2024-10-11 16:20:05', 0),
(23, 123, 'John', 'Doe', '', '$2y$10$mKoAJ7tdG1djK/Yn27kiF.QA8E6pRvnXIE8kgVDQsL2gpXfwHLicG', '2024-10-20 13:40:32', 1),
(70, 1234, 'Jed', 'Balita', '', '$2y$10$2h/21Bekk5roJ7Ij.zN/8OOhw3pvoq/Vb6aDosXqGvBo0XGWGikeW', '2024-11-04 13:03:28', 0),
(73, 232008, 'Dan Matthew', 'Sebastian', '', '$2y$10$RVvxngNLubaYidZDJ2OtA.9KbaZtRJv4LnUTeUS./euOOBgVeknTC', '2024-11-09 04:32:44', 1),
(74, 555, 'Julius', 'Laguna', '', '$2y$10$mGnpf53RW63LYagqzLRVL.iqqSm9/tcWBQrEv7A6WjccU384Xk2Tq', '2024-11-09 09:17:16', 1),
(75, 1010, 'Heila', 'Longaquit', '', '$2y$10$lhOVKcSpQDBr2mOIxLcFqejY.2aTyjm5j/3E/qRsV3Og.1LfaGkmy', '2024-11-15 23:11:33', 1),
(90, 444, 'John Carlo', 'Castillano', '', '$2y$10$nnBnUa.TSmVVfliWUVG/auH6NRz42t.iWnmC4hw0dtKJfnPAGBEVm', '2024-11-16 00:39:22', 1),
(91, 5555, 'Christian Joy', 'Baria', '', '$2y$10$xxcy46fQtRWn9UTAo6SZs.JvyWxOgq1TDNcYvEj3TAcc6laZVh.Ai', '2024-11-16 01:14:53', 1),
(92, 8888, 'Nick', 'Jonas', '', '$2y$10$23lwRDr/jIf7thDTeYj7cuO7OtZ5ZNmA8wCGr5jHEKf4kNdSqna7m', '2024-11-16 02:30:27', 1),
(93, 666, 'Justin Christopher', 'Rivera', '', '$2y$10$kedL5oIw7lkwynYdzQgxTOzVZWnt5i1Ty7wcn31RU5HW2OsY6EzGi', '2024-11-16 02:35:27', 0),
(94, 123123, 'Andrew', 'Miranda', '', '$2y$10$HVACv9zgZN..Nurx3BVfKeJq2lA6D/DbPfEota5UhCia5T.zEIw0e', '2024-11-16 08:42:33', 1),
(96, 23, 'Louise', 'Moreno', '', '$2y$10$OYSs6Gh7tiTbV/rgmtQ.yer3w7HnunAukj5j8iGXsmXpR7Ow6zqRe', '2024-11-16 09:06:39', 1),
(97, 24, 'Ellizier', 'Patriarca', '', '$2y$10$M98KPPE4KfVu5uuN9dTb.uRoDj5jfwbPUZmazz286zk.mAI8y9KZq', '2024-11-16 09:10:41', 1),
(99, 456, 'Roncake', 'Miel', '', '$2y$10$6ETs9eLPo3JPuvmlbPfFaOB4EcA93qUUAuJv4GT.oApVWS2aFDWTW', '2024-11-16 09:32:31', 1),
(101, 4567, 'Lanz', 'Rivera', '', '$2y$10$xyOHkEh9e3.ALkfQPw3rXeTXj/8Tz1EfBsA3et69BtIwh3N/uiWDC', '2024-11-17 12:54:39', 1),
(102, 7894, 'Frederick', 'Leonen', '', '$2y$10$BMunUjKbGhRyOzv7FBvKXONZJKYW71OGpuJklR5IXx0/5soRIQWZe', '2024-11-17 13:03:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `vote_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `student_id`, `candidate_id`, `vote_timestamp`) VALUES
(82, 232008, 12, '2024-11-09 04:41:49'),
(83, 123, 14, '2024-11-15 14:33:49'),
(84, 91892, 13, '2024-11-15 14:36:04'),
(85, 555, 14, '2024-11-15 14:36:47'),
(86, 1010, 14, '2024-11-15 23:45:07'),
(87, 1010, 18, '2024-11-15 23:45:07'),
(90, 444, 12, '2024-11-16 00:48:55'),
(91, 444, 18, '2024-11-16 00:48:55'),
(92, 444, 19, '2024-11-16 00:48:55'),
(93, 444, 20, '2024-11-16 00:48:55'),
(94, 444, 21, '2024-11-16 00:48:55'),
(95, 444, 23, '2024-11-16 00:48:55'),
(96, 5555, 13, '2024-11-16 02:17:49'),
(97, 5555, 18, '2024-11-16 02:17:49'),
(98, 5555, 19, '2024-11-16 02:17:49'),
(99, 5555, 20, '2024-11-16 02:17:49'),
(100, 5555, 21, '2024-11-16 02:17:49'),
(101, 5555, 23, '2024-11-16 02:17:49'),
(102, 8888, 13, '2024-11-16 02:31:02'),
(103, 8888, 18, '2024-11-16 02:31:02'),
(104, 8888, 19, '2024-11-16 02:31:02'),
(105, 8888, 20, '2024-11-16 02:31:02'),
(106, 8888, 21, '2024-11-16 02:31:02'),
(107, 8888, 23, '2024-11-16 02:31:02'),
(108, 123123, 12, '2024-11-16 08:44:08'),
(109, 123123, 18, '2024-11-16 08:44:08'),
(110, 123123, 19, '2024-11-16 08:44:08'),
(111, 123123, 20, '2024-11-16 08:44:08'),
(112, 123123, 21, '2024-11-16 08:44:08'),
(113, 123123, 23, '2024-11-16 08:44:08'),
(114, 23, 12, '2024-11-16 09:09:42'),
(115, 23, 18, '2024-11-16 09:09:42'),
(116, 23, 19, '2024-11-16 09:09:42'),
(117, 23, 20, '2024-11-16 09:09:42'),
(118, 23, 21, '2024-11-16 09:09:42'),
(119, 23, 23, '2024-11-16 09:09:42'),
(126, 4567, 14, '2024-11-17 12:56:42'),
(127, 4567, 18, '2024-11-17 12:56:42'),
(128, 4567, 19, '2024-11-17 12:56:42'),
(129, 4567, 20, '2024-11-17 12:56:42'),
(130, 4567, 21, '2024-11-17 12:56:42'),
(131, 4567, 23, '2024-11-17 12:56:42');

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
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `student_id` (`student_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `archived_party_lists`
--
ALTER TABLE `archived_party_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `archived_users`
--
ALTER TABLE `archived_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `party_lists`
--
ALTER TABLE `party_lists`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
