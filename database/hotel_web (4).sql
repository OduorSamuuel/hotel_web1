-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 04:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `verification_code`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 26, 'tNev3e2B7JZeSzAO', '2023-11-12 12:22:45', '2023-11-12 11:52:45', '2023-11-12 11:52:45'),
(4, 25, 'dvpxlT7rrYmEnZW61gasv6o2jek9CXuA', '2023-11-12 13:37:31', '2023-11-12 13:07:31', '2023-11-12 13:07:31'),
(6, 25, 'PzgVjhxkZN96ojDCQz7G8d3RjFVrNJUp7u5jktuRepx4hEiWLBEuP0zbcKcySBJM', '2023-11-12 13:43:26', '2023-11-12 13:13:26', '2023-11-12 13:13:26'),
(11, 25, 'FkHuv2jRs2OrQ66ezHfJPPy2QPCSaFV8FAqB0sNZ6kHQSr1CR2S0112v35Sl536Z', '2023-11-12 13:55:32', '2023-11-12 13:25:32', '2023-11-12 13:25:32'),
(16, 25, 'i4NAUHtztTgr9zXAwxfGpuekCh6hiCfuSBeCswLfCazt2u59jAOG8UzpHJ2rCEek', '2023-11-12 15:21:36', '2023-11-12 14:51:36', '2023-11-12 14:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `user_id`, `name`, `email`, `dob`, `phone_no`, `country`, `bio`, `photo_path`, `created_at`, `updated_at`) VALUES
(2, 26, 'sam', 'onyangos949@gmail.com', '2023-11-16', '0567774787', 'Kenya', 'uj9jk9', 'profile_photos/profile_photo_1700146953.jpg', '2023-11-16 08:34:08', '2023-11-16 12:02:33'),
(3, 1, 'Nelius', 'nelius.ndung\'u@strathmore.edu', '2023-11-16', '0567774789', 'Tanzania', 'Its me now', 'profile_photos/profile_photo_1700145998.jpg', '2023-11-16 11:17:09', '2023-11-16 11:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomId` int(11) NOT NULL,
  `RoomNumber` int(20) DEFAULT NULL,
  `RoomType` varchar(50) DEFAULT NULL,
  `image_data` longblob DEFAULT NULL,
  `PricePerNight` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomId`, `RoomNumber`, `RoomType`, `image_data`, `PricePerNight`, `Status`) VALUES
(1, 10, 'Double', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c446f75626c652e6a7067, '100', 'Not Booked'),
(2, 11, 'Double', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c446f75626c65312e6a7067, '100', 'Booked'),
(3, 15, 'Suite', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c53756974652e6a7067, '150', 'Booked'),
(4, 20, 'Suite', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c5375697465312e6a7067, '150', 'Not Booked'),
(5, 21, 'Suite', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c5375697465322e6a7067, '150', 'Not Booked'),
(6, 25, 'Suite', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c5375697465332e6a7067, '150', 'Not Booked'),
(7, 30, 'Executive', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c4578656375746976652e6a7067, '200', 'Not Booked'),
(8, 31, 'Executive', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c457865637574697665312e6a7067, '200', 'Booked'),
(9, 32, 'Executive', 0x433a5c55736572735c4b696d6265726c792057616e6775695c50696374757265735c457865637574697665322e6a7067, '200', 'Not Booked');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `token_expiration_time` datetime DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `verification_token`, `token_expiration_time`, `is_verified`, `role`, `created_at`, `updated_at`) VALUES
(1, 'nelius.ndung\'u@strathmore.edu', '$2y$10$wT2DtFFb/EQbVn9BqTkTBu95fZKppDirtoVAWwID9jsLuUHvNbJJi', 'Enu2jkmW4kg69kT0jCKDzlj6Svq3mlQeVAmBv0Nf', '2023-11-10 03:15:52', 1, 'user', '2023-11-09 00:15:52', '2023-11-09 00:15:52'),
(5, 'catherine.gitahi@strathmore.edu', '$2y$10$YT95TUJ5KkxGhFL8rKv4.Oj8M2QT1w799ivsBYugQM.fY7kqXUZtu', 'c2vK3GVVeDp79UcI9gbI8B8Mm8e9EJYoVYUI1BBi', '2023-11-10 07:36:31', 0, 'user', '2023-11-09 04:36:31', '2023-11-09 04:36:31'),
(6, 'rogitomarilyn@gmail.com', '$2y$10$uT5xj2Jjhv0UsZqWBr7.0uG2rkW7ifmF.L09S2K/6hFVCpEvfQI1G', 'ky6drX9sRqgCmeMCVkMb9VuALGXtQ6YwZafTNhmy', '2023-11-10 11:43:31', 0, 'user', '2023-11-09 08:43:31', '2023-11-09 08:43:31'),
(10, 'Gideon.dev9@gmail.com', '$2y$10$a2itxJkxVvHrV/oatp.tVe7U3I0FpL5t5GrgA8OQXuA8Y7mdRYI4C', 'F8YAKIKjsMhIsHVW18hSWM8Q5ldw6jgjEvaDznym', '2023-11-12 11:02:34', 0, 'user', '2023-11-11 08:02:34', '2023-11-11 08:02:34'),
(25, 'onyangos949@gmail.com', '$2y$10$ZABEtPQ9SC.J3RGo3IgsQOTLyttJH2mltKTT5QKELP6dXo.4MaWNW', NULL, '2023-11-12 16:42:13', 1, '1', '2023-11-11 13:42:13', '2023-11-15 08:34:23'),
(26, 'samuel.onyango@strathmore.edu', '$2y$10$2V0YQ19JDDyOv/Jx5uEVze.Sil6UU2vZLCG.OntVxLZvXTcEr7a.y', NULL, '2023-11-13 06:23:38', 1, 'user', '2023-11-12 03:23:38', '2023-11-15 08:46:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
