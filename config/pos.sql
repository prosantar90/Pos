-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2024 at 04:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `b_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`b_id`, `brand_name`, `brand_status`) VALUES
(1, 'Real me', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `cat_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `category_name`, `cat_status`) VALUES
(1, 'Mobile', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cum_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `order_amount` int(11) DEFAULT NULL,
  `order_amount_paid` varchar(255) DEFAULT NULL,
  `order_total_amount_due` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cum_id`, `customer_name`, `father_name`, `phone_number`, `customer_address`, `order_amount`, `order_amount_paid`, `order_total_amount_due`, `created`) VALUES
(1, 'Niranjan Raj', 'Biswanath Rajbanshi', '99332258', 'asaf', 320, '300', '20', '2023-06-06 10:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `p_cat` varchar(255) NOT NULL,
  `sales_unit` varchar(255) NOT NULL,
  `stock_alert` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_code`, `brand`, `p_cat`, `sales_unit`, `stock_alert`, `price`, `quantity`, `p_image`, `p_status`) VALUES
(6, 'Vivo v25', 'PR490', '1', '1', '5', '12', '120', '250', 'uploads/build custom website using html and bootstrap.png', ''),
(7, 'Vivo v25', 'PR490', '1', '1', '5', '12', '1200', '250', 'uploads/IMG_20190815_082936.jpg', '0'),
(8, 'Vivo v25', 'PR490', '2', '10', '5', '3', '200', '25', 'uploads/realme-9-4g.jpg', '1'),
(9, 'Samsumg', 'vivo25', '1', '1', '5', '10', '200', '25', 'uploads/realme-9-4g.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `sales_qty` varchar(255) NOT NULL,
  `sales_price` varchar(255) NOT NULL,
  `sales_total_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `customer_id`, `product_id`, `sales_qty`, `sales_price`, `sales_total_amount`) VALUES
(1, '6', 'Vivo v25', '1', '1200', '1200'),
(2, '7', 'Vivo v25', '1', '120', '120'),
(3, '1', 'Vivo v25', '1', '120', '120'),
(4, '1', 'Samsumg', '1', '200', '200');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `test` varchar(255) NOT NULL,
  `test1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `test`, `test1`) VALUES
(1, 'pro', 'santa'),
(2, 'Raj', 'banshi');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_status`) VALUES
(5, 'Pics', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `ufname` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `u_photo` varchar(255) NOT NULL,
  `u_com` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `com_reg` varchar(255) DEFAULT NULL,
  `U_address` varchar(255) DEFAULT NULL,
  `u_country` varchar(255) DEFAULT NULL,
  `u_about` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `ufname`, `user_pass`, `user_email`, `user_role`, `u_photo`, `u_com`, `phone`, `com_reg`, `U_address`, `u_country`, `u_about`) VALUES
(1, 'prosanta', 'Prosanta Rajbanshi', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'prosantar90@gmail.com', 'admin', 'uploads/prosantarajbanshi.png', 'Shop Management', '8170903678', 'xyz', 'Jadupur, Dhumadighi, Malda', 'India', 'afswg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cum_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
