-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 08:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `shoe_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` enum('men','women','children') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Nike Air Max', 'Running shoes with air cushioning', '99.99', 'resources/shoe1.png', 'men'),
(2, 'Adidas Ultraboost', 'Running shoes with Boost cushioning', '119.99', 'resources/shoe2.png', 'men'),
(3, 'Puma RS-0', 'Retro-inspired running shoes', '79.99', 'resources/shoe3.png', 'women'),
(4, 'Reebok Nano 9', 'Cross-training shoes with flexible sole', '89.99', 'resources/shoe4.png', 'men'),
(5, 'New Balance Fresh Foam', 'Running shoes with fresh foam cushioning', '109.99', 'resources/shoe5.png', 'women'),
(6, 'Jordan 1 Mid', 'Classic basketball shoes with leather upper', '129.99', 'resources/shoe6.png', 'men'),
(7, 'Asics Gel-Kayano', 'Stability running shoes with gel cushioning', '139.99', 'resources/shoe7.png', 'men'),
(8, 'Under Armour HOVR', 'Connected running shoes with bluetooth tracking', '149.99', 'resources/shoe8.png', 'women'),
(9, 'Brooks Ghost', 'Neutral running shoes with DNA cushioning', '119.99', 'resources/shoe9.png', 'men'),
(10, 'Saucony Kinvara', 'Lightweight running shoes with EVA cushioning', '99.99', 'resources/shoe10.png', 'women'),
(11, 'Mizuno Wave Rider', 'Cushioned running shoes with wave technology', '109.99', 'resources/shoe11.png', 'men'),
(12, 'Fila Disruptor', 'Chunky sneakers with retro style', '69.99', 'resources/shoe12.png', 'women'),
(13, 'Vans Old Skool', 'Classic skate shoes with canvas upper', '59.99', 'resources/shoe13.png', 'men'),
(14, 'Converse Chuck Taylor', 'All-purpose canvas sneakers', '49.99', 'resources/shoe14.png', 'women'),
(15, 'Timberland Premium', 'Waterproof boots with leather upper', '179.99', 'resources/shoe15.png', 'men'),
(16, 'Dr. Martens 1460', 'Iconic boots with smooth leather finish', '149.99', 'resources/shoe16.png', 'women'),
(17, 'UGG Classic', 'Sheepskin-lined boots for cold weather', '129.99', 'resources/shoe17.png', 'men'),
(18, 'Hunter Original', 'Rubber rain boots with adjustable strap', '89.99', 'resources/shoe18.png', 'women'),
(19, 'Red Wing Iron Ranger', 'Heritage work boots with double-layer leather toe box', '269.99', 'resources/shoe19.png', 'men'),
(20, 'Sorel Joan of Arctic', 'Weatherproof snow boots with fur cuff', '189.99', 'resources/shoe20.png', 'women'),
(21, 'Nike Star Runner', 'Lightweight running shoes for kids', '59.99', 'resources/shoe21.png', 'children'),
(22, 'Adidas Fortarun', 'Breathable sneakers with a durable outsole', '49.99', 'resources/shoe22.png', 'children'),
(23, 'New Balance FuelCore', 'Performance shoes with cushioned midsole', '69.99', 'resources/shoe23.png', 'children'),
(24, 'Puma Cabana Racer', 'Retro-inspired sneakers with nylon upper', '39.99', 'resources/shoe24.png', 'children'),
(25, 'Vans Sk8-Hi Zip', 'High-top skate shoes with side zipper', '54.99', 'resources/shoe25.png', 'children');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`) VALUES
(1, 'aaa', 'aaa', 'aaa', ''),
(2, 'bbb', 'bbb', 'bbb', '1111'),
(3, 'abc', 'abc', 'abc', '1111'),
(4, 'ppq', 'ppp@ppp.com', 'ppp', '222'),
(5, 'ovi', 'gfo.ovi@gmail.com', '12345', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shoe_id` (`shoe_id`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`shoe_id`) REFERENCES `shoes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
