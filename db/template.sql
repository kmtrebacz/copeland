-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 09:20 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `copeland`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'drum set'),
(2, 'snare'),
(3, 'drumsticks'),
(4, 'bass drum pedal'),
(5, 'drum throne'),
(6, 'straight stand'),
(7, 'boom stand'),
(8, 'snare stand'),
(9, 'hi hat stand'),
(10, 'combined stand'),
(11, 'tom stand'),
(12, 'multi clamp'),
(13, 'tom holder'),
(14, 'drum racks'),
(15, 'snare drumhead'),
(16, 'tom drumhead'),
(17, 'bass drum drumhead'),
(18, 'splash cymbal'),
(19, 'crash cymbal'),
(20, 'ride cymbal'),
(21, 'hi hat cymbal'),
(22, 'china_cymbal'),
(23, 'bell cymbal'),
(24, 'fx cymbal'),
(25, 'gong cymbal');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `size` varchar(100) NOT NULL,
  `items_view_count` int(11) NOT NULL DEFAULT 1,
  `img_src` varchar(255) DEFAULT 'noitem.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `category_id`, `size`, `items_view_count`, `img_src`) VALUES
(1, 'PDP Concept Maple CM7 Silver to Black Fade', 1, '22 14 8,10,12,14,16', 39, 'pdp-concept-maple-cm7-silver-to-black-fade.png'),
(2, 'Zildjian K Custom Dark Hi-Hat', 21, '14', 9, 'Zildjian_K_Custom_Dark_Hi-Hat_14.jpg'),
(3, 'Zildjian K Custom Dark Crash', 19, '16', 19, 'Zildjian_K_Custom_Dark_Crash_16.jpg'),
(4, 'Zildjian K Custom Dark Ride', 20, '20', 10, 'Zildjian_K_Custom_Dark_Ride_20.jpg'),
(5, 'Zildjian K Custom Dark Crash', 19, '18', 9, 'Zildjian_K_Custom_Dark_Crash_18.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lists`
--

CREATE TABLE `lists` (
  `list_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_name` varchar(100) NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lists_view_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`list_id`, `user_id`, `list_name`, `is_public`, `created_at`, `lists_view_count`) VALUES
(17, 1, 'lukasz tatarek', 0, '2023-12-19 08:10:45', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `list_items`
--

CREATE TABLE `list_items` (
  `id_list_items` int(11) NOT NULL,
  `list_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_view_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`, `updated_at`, `user_view_count`) VALUES
(1, 'kt', '$2y$10$YlKGc43p1opiTyJ0cswgl.w0k9eC7uezru40.Q0HG4esrD6.nXp3S', 'kt@kt.kt', '2023-12-19 07:33:11', '2023-12-19 07:33:11', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `list_items`
--
ALTER TABLE `list_items`
  ADD PRIMARY KEY (`id_list_items`),
  ADD KEY `list_id` (`list_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `list_items`
--
ALTER TABLE `list_items`
  MODIFY `id_list_items` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `list_items`
--
ALTER TABLE `list_items`
  ADD CONSTRAINT `list_items_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`),
  ADD CONSTRAINT `list_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
