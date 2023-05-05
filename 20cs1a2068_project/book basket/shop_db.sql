-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 02:10 PM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `email`, `image`, `password`, `code`, `status`) VALUES
(2, 'Ayush Das Purkayastha', '9954031142', 'ayushdaspurkayastha@gmail.com', '', '4321', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 8, 'Arun Kumar', 'ayushdaspurkayastha@gmail.com', '95412158415', 'Hello, I want to sell a book.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(64, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', 'cash on delivery', 'Bangalore Urban, Kothanur, Silchar, India - 788002', '2', 800, '27-Apr-2023', 'COD'),
(65, 8, 'Rahul', '2147483647', 'ayushdaspurkayastha@gmail.com', 'paypal', 'Cachar, Kothanur, Silchar, India - 788002', '9', 0, '27-Apr-2023', 'COD'),
(66, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', '', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (9) ', 3600, '29-Apr-2023', 'COD'),
(67, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', '', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (15) ', 6000, '29-Apr-2023', 'paid'),
(68, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', '', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (10) ', 4000, '29-Apr-2023', 'paid'),
(69, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', '', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (6) ', 2400, '29-Apr-2023', 'COD'),
(70, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', 'cod', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (7) ', 2800, '29-Apr-2023', 'COD'),
(71, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', 'online', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (9) ', 3600, '29-Apr-2023', 'paid'),
(72, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', 'online', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', Happy Lemons (1) , The World (1) ', 854, '30-Apr-2023', 'pending'),
(73, 8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', 'online', 'Bangalore Urban, Kothanur, Silchar, India - 788002', ', The World (1) ', 454, '30-Apr-2023', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(500) NOT NULL,
  `book_name` varchar(500) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `amount`, `phone`, `email`, `book_name`, `quantity`, `price`, `payment_status`, `payment_id`, `added_on`) VALUES
(30, 'Arun Kumar', 3600, '', '', '', 0, 0, 'pending', '', '2023-04-15 09:34:55'),
(31, 'Arun Kumar', 3600, '', '', '', 0, 0, 'pending', '', '2023-04-15 10:03:33'),
(32, 'Arun Kumar', 3600, '', '', '', 0, 0, 'pending', '', '2023-04-17 04:39:00'),
(33, 'Arun Kumar', 5200, '', '', '', 0, 0, 'complete', 'pay_LeyteDI8h6YQUq', '2023-04-17 09:54:08'),
(34, 'Arun Kumar', 0, '', '', '', 0, 0, 'pending', '', '2023-04-29 05:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `currency` varchar(10) NOT NULL,
  `mobile` int(15) NOT NULL,
  `address` varchar(455) NOT NULL,
  `note` text NOT NULL,
  `payment_date` datetime NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Happy Lemons', 'Good Book', 400, 'the_happy_lemon.jpg'),
(2, 'The World', 'Book about the world', 454, 'the_world.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `sublocation` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `country` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `location`, `sublocation`, `city`, `state`, `pincode`, `country`, `password`, `user_type`, `code`, `status`) VALUES
(8, 'Arun Kumar', '2147483647', 'ayushdaspurkayastha@gmail.com', 'Bangalore Urban', 'Kothanur', 'Silchar', 'Assam', 788002, 'India', '1111', 'user', 819450, ''),
(10, 'Raju', '9954031142', 'ayushdaspurkayastha@gmail.com', 'Bangalore Urban', 'Kothanur', 'Silchar', 'Assam', 788002, 'India', '1111', 'user', 0, 'verified'),
(11, 'Raju', '9954031142', 'ayushdaspurkayastha@gmail.com', 'Bangalore Urban', 'Kothanur', 'Silchar', 'Assam', 788002, 'India', '1111', 'user', 0, 'verified'),
(12, 'Raju', '9954031142', 'ayushdaspurkayastha@gmail.com', 'Bangalore Urban', 'Kothanur', 'Silchar', 'Assam', 78002, 'India', '1111', 'user', 523231, 'notverified');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
