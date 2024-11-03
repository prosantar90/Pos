-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2024 at 05:53 AM
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
(1, 'Real me', '1'),
(2, 'MANIAC', '1'),
(3, 'Portronics', '1'),
(4, 'Pics', NULL),
(5, 'Brand Name', '1');

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
(1, 'Mobile', '1'),
(2, 'Fruites', '1'),
(3, 'Clothing and Accessories', '1'),
(4, 'Categories', '1');

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
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `cus_updated` datetime DEFAULT NULL,
  `promis_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cum_id`, `customer_name`, `father_name`, `phone_number`, `customer_address`, `order_amount`, `order_amount_paid`, `order_total_amount_due`, `created`, `cus_updated`, `promis_date`) VALUES
(1, 'Abhijit', 'sjkso', '6449564264', 'sjhgj', 77451, '77151', '300', '2024-10-16 04:31:07', '2024-10-27 02:54:48', '2024-10-30'),
(2, 'Joy', 'ah', '614984619', 'sdjasoi', 299, '299', '0', '2024-10-16 03:54:12', '1970-01-01 01:00:00', '0000-00-00'),
(3, 'Joy', 'ah', '614984619', 'sdjasoi', 16769, '16769', '0', '2024-10-16 03:52:54', '2024-10-23 07:22:01', NULL),
(5, 'Prosanta', 'Biswantah', '865757978', 'Jadupur', 45648, '45601', '47', '2024-10-08 11:50:31', '2024-10-26 09:34:27', NULL),
(6, 'prosanta', 'sh', '8767129', 'jsbjh', 5508, '5508', '0', '2024-10-26 04:16:30', NULL, NULL),
(10, 'Niranjan Rajbanshi', 'Biswantah', '865757978', 'Jadupur', 86362, '72900', '13462', '2024-10-27 17:39:41', '2024-10-28 05:28:45', '2024-10-30');

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
  `mrp_price` varchar(255) NOT NULL,
  `wholesale_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `p_image` varchar(255) NOT NULL,
  `p_status` varchar(50) DEFAULT NULL,
  `product_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_code`, `brand`, `p_cat`, `sales_unit`, `stock_alert`, `mrp_price`, `wholesale_price`, `sale_price`, `quantity`, `p_image`, `p_status`, `product_at`) VALUES
(1, 'Men Cargos', 'pr_646946', '2', '3', '5', '25', '1200', 4454, 54, '221', 'uploads/cloths.webp', '', '2024-10-19 04:11:53'),
(2, 'Motorola Edge 50 Fusion', 'moto_548446', '1', '1', '5', '25', '20999', 18000, 1255, '287', 'uploads/mobile.webp', '', '2024-10-19 04:11:53'),
(3, 'Portronics Car Mobile Holder for AC Vent  (Black)', 'port_3298790', '1', '1', '5', '12', '299', 154, 5454, '1471', 'uploads/clamp-z-.webp', '', '2024-10-19 04:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `ID` int(11) NOT NULL,
  `purchase_invoice` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `sales_price` int(11) NOT NULL,
  `wholesale_price` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_total` int(11) NOT NULL,
  `purchase_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`ID`, `purchase_invoice`, `product_id`, `product_qty`, `purchase_price`, `sales_price`, `wholesale_price`, `supplier_id`, `purchase_total`, `purchase_at`) VALUES
(1, 0, 2, 25, 0, 0, 0, 4, 0, '2024-10-06 10:06:40'),
(2, 0, 1, 200, 0, 0, 0, 6, 0, '2024-09-02 11:55:14'),
(3, 0, 3, 120, 0, 0, 0, 4, 0, '2024-02-01 04:49:38'),
(4, 0, 3, 123, 255, 0, 0, 4, 0, '2024-10-13 06:13:14'),
(5, 1, 3, 25, 25, 215, 14, 1, 25, '2024-10-22 02:19:21'),
(6, 1, 3, 245, 4554, 5454, 154, 2, 4554, '2024-10-22 02:52:48'),
(7, 1, 3, 245, 4554, 5454, 154, 2, 4554, '2024-10-22 03:00:26'),
(8, 1, 1, 4, 44, 54, 4454, 2, 4554, '2024-10-22 03:00:26'),
(9, 1, 3, 245, 4554, 5454, 154, 2, 4554, '2024-10-22 03:22:25'),
(10, 1, 3, 245, 4554, 5454, 154, 2, 4554, '2024-10-22 03:25:07'),
(11, 1, 1, 4, 44, 54, 4454, 2, 4554, '2024-10-22 03:25:07'),
(12, 1, 3, 245, 4554, 5454, 154, 2, 4554, '2024-10-22 03:26:05'),
(13, 1, 1, 4, 44, 54, 4454, 2, 4554, '2024-10-22 03:26:05'),
(14, 1, 3, 255, 252, 125, 5421, 1, 252, '2024-10-22 03:30:42'),
(15, 1, 1, 5, 121, 155, 2112, 1, 252, '2024-10-22 03:30:42'),
(16, 2, 3, 245, 4554, 5454, 154, 2, 4554, '2024-10-22 03:40:43'),
(17, 2, 1, 4, 44, 54, 4454, 2, 4554, '2024-10-22 03:40:43'),
(18, 3, 2, 25, 2500, 1255, 2536, 1, 2500, '2024-10-27 17:27:38'),
(19, 4, 2, 4, 2000, 1255, 18000, 1, 2000, '2024-10-27 17:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_invoice` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `salesmanID` int(11) DEFAULT NULL,
  `product_id` varchar(255) NOT NULL,
  `sales_qty` varchar(255) NOT NULL,
  `sales_price` varchar(255) NOT NULL,
  `sales_total_amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_invoice`, `customer_id`, `salesmanID`, `product_id`, `sales_qty`, `sales_price`, `sales_total_amount`, `created_at`) VALUES
(1, 2, '1', 0, '2', '1', '20999', '20999', '2024-10-20 15:52:48'),
(6, 3, '4', 0, '2', '2', '299', '598', '2024-10-20 15:52:56'),
(7, 3, '4', 0, '3', '1', '20999', '20999', '2024-10-20 15:53:00'),
(11, 4, '5', NULL, '3', '1', '299', '299', '2024-10-20 05:20:17'),
(12, 4, '5', NULL, '1', '1', '1200', '1200', '2024-10-20 05:20:17'),
(13, 5, '5', NULL, '2', '1', '20999', '20999', '2024-10-22 14:47:14'),
(14, 5, '5', NULL, '1', '1', '1200', '1200', '2024-10-22 14:47:14'),
(15, 6, '1', NULL, '1', '1', '1200', '1200', '2024-10-22 14:54:44'),
(16, 6, '1', NULL, '2', '2', '20999', '41998', '2024-10-22 14:54:44'),
(17, 7, '3', NULL, '1', '2', '54', '108', '2024-10-23 01:51:26'),
(18, 7, '3', NULL, '3', '1', '5454', '5454', '2024-10-23 01:51:26'),
(19, 8, '3', NULL, '3', '2', '5454', '10908', '2024-10-23 01:52:01'),
(20, 9, '1', NULL, '1', '2', '54', '108', '2024-10-23 02:19:53'),
(21, 9, '1', NULL, '3', '1', '5454', '5454', '2024-10-23 02:19:53'),
(22, 9, '1', NULL, '1', '2', '54', '108', '2024-10-23 02:20:55'),
(23, 9, '1', NULL, '3', '1', '5454', '5454', '2024-10-23 02:20:55'),
(24, 9, '1', NULL, '1', '2', '54', '108', '2024-10-23 02:25:02'),
(25, 9, '1', NULL, '3', '1', '5454', '5454', '2024-10-23 02:25:02'),
(26, 10, '1', NULL, '3', '1', '5454', '5454', '2024-10-23 02:25:42'),
(27, 10, '1', NULL, '3', '1', '5454', '5454', '2024-10-23 02:32:00'),
(28, 10, '1', NULL, '3', '1', '5454', '5454', '2024-10-23 02:33:09'),
(29, 11, '5', NULL, '1', '1', '54', '54', '2024-10-26 04:04:27'),
(30, 12, '6', NULL, '1', '1', '54', '54', '2024-10-26 04:16:30'),
(31, 12, '6', NULL, '3', '1', '154', '5454', '2024-10-26 04:16:30'),
(32, 13, '1', NULL, '3', '2', '154', '308', '2024-10-26 04:17:54'),
(39, 14, '10', NULL, '1', '2', '4454', '8908', '2024-10-27 17:39:41'),
(40, 14, '10', NULL, '2', '2', '18000', '36000', '2024-10-27 17:39:41'),
(41, 15, '10', NULL, '2', '2', '18000', '36000', '2024-10-27 17:52:25'),
(42, 15, '10', NULL, '3', '1', '5454', '5454', '2024-10-27 17:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `ID` int(11) NOT NULL,
  `salesman_name` varchar(255) NOT NULL,
  `salesman_f_name` varchar(255) NOT NULL,
  `salesman_phone` varchar(255) NOT NULL,
  `salesman_address` varchar(255) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `due_amount` int(11) DEFAULT NULL,
  `salesman_acc` varchar(255) NOT NULL,
  `salesman_ifsc` varchar(255) NOT NULL,
  `salesman_bank` varchar(255) NOT NULL,
  `salesman_img` varchar(255) NOT NULL,
  `salesman_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`ID`, `salesman_name`, `salesman_f_name`, `salesman_phone`, `salesman_address`, `balance`, `paid_amount`, `due_amount`, `salesman_acc`, `salesman_ifsc`, `salesman_bank`, `salesman_img`, `salesman_at`) VALUES
(1, 'Sukumar', 'Abc', '9800484589', 'abc', 21420, 3400, -200, '19933010030872', 'PNB0193320', 'Punjub National Bank Of India', '', '2024-10-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sup_ID` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `sup_phone` varchar(255) NOT NULL,
  `sup_address` varchar(255) NOT NULL,
  `sup_img` varchar(255) NOT NULL,
  `sup_total_amount` int(11) NOT NULL,
  `sup_ad_amount` int(11) NOT NULL,
  `sup_due_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sup_ID`, `supplier_name`, `sup_phone`, `sup_address`, `sup_img`, `sup_total_amount`, `sup_ad_amount`, `sup_due_amount`, `status`, `created_at`) VALUES
(1, 'Adhunik', '0', 'saas', '', 20004, 39064, 0, 1, '2024-09-29 07:36:09'),
(2, 'Birla', '8170903678', 'sdas', '', 32078, -31856, 0, 1, '2024-09-29 07:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_type` enum('sales_payment','customers_payment','suppliers_payment','purchase_payment','salesman_payment') DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `chequeOraccNo` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_type`, `entity_id`, `amount`, `payment_mode`, `chequeOraccNo`, `payment_date`) VALUES
(1, 'customers_payment', 1, '999.00', '', 0, '2024-10-17'),
(2, 'customers_payment', 1, '999.00', '', 0, '2024-10-17'),
(3, 'customers_payment', 1, '999.00', '', 0, '2024-10-17'),
(4, 'customers_payment', 1, '900.00', '', 0, '2024-10-17'),
(5, 'customers_payment', 1, '50.00', 'hand_cash', 0, '2024-10-17'),
(6, 'purchase_payment', 1, '4554.00', 'bycheque', NULL, '2024-10-22'),
(7, 'purchase_payment', 1, '4554.00', 'bycheque', NULL, '2024-10-22'),
(8, 'purchase_payment', 1, '4554.00', 'bycheque', 146485, '2024-10-22'),
(9, 'purchase_payment', 1, '4554.00', 'bycheque', 146485, '2024-10-22'),
(10, 'purchase_payment', 1, '252.00', 'byaccounts', 54145644, '2024-10-22'),
(11, 'purchase_payment', 1, '252.00', 'byaccounts', 54145644, '2024-10-22'),
(12, 'purchase_payment', 2, '4554.00', 'bycheque', 146485, '2024-10-22'),
(13, 'purchase_payment', 2, '4554.00', 'bycheque', 146485, '2024-10-22'),
(14, 'suppliers_payment', 1, '23435.00', 'bycheque', 345345, '2024-10-22'),
(15, 'sales_payment', 5, '22000.00', '', 35346456, '2024-10-22'),
(16, 'sales_payment', 5, '22000.00', '', 35346456, '2024-10-22'),
(17, 'sales_payment', 6, '40000.00', '', 378498327, '2024-10-22'),
(18, 'customers_payment', 5, '300.00', 'bycheque', NULL, '2024-10-22'),
(19, 'sales_payment', 11, '54.00', 'bycheque', 234534, '2024-10-26'),
(20, 'sales_payment', 12, '5508.00', 'byaccounts', 3435, '2024-10-26'),
(21, 'sales_payment', 13, '250.00', 'hand_cash', NULL, '2024-10-26'),
(22, 'customers_payment', 1, '3000.00', 'bycheque', 2423, '2024-10-27'),
(23, 'customers_payment', 1, '54.00', 'hand_cash', NULL, '2024-10-27'),
(24, 'purchase_payment', 4, '2000.00', 'bycheque', 34534, '2024-10-27'),
(25, 'sales_payment', 15, '36162.00', 'bycheque', 3543, '2024-10-27'),
(26, 'sales_payment', 10, '40000.00', 'hand_cash', NULL, '2024-10-27'),
(27, 'customers_payment', 10, '3000.00', 'hand_cash', NULL, '2024-10-27'),
(28, 'sales_payment', 10, '4000.00', 'hand_cash', NULL, '2024-10-27'),
(29, 'customers_payment', 10, '3000.00', 'hand_cash', NULL, '2024-10-27'),
(30, 'customers_payment', 10, '20000.00', 'hand_cash', NULL, '2024-10-27'),
(31, 'salesman_payment', 1, NULL, 'hand_cash', NULL, '2024-10-28'),
(32, 'salesman_payment', 1, '200.00', 'hand_cash', NULL, '2024-10-28'),
(33, 'customers_payment', 10, '300.00', 'hand_cash', NULL, '2024-10-28'),
(34, 'customers_payment', 10, '1500.00', 'hand_cash', NULL, '2024-10-28'),
(35, 'customers_payment', 10, '100.00', 'bycheque', NULL, '2024-10-28'),
(36, 'customers_payment', 10, '1000.00', 'bycheque', 54689414, '2024-10-28'),
(37, 'salesman_payment', 1, '1000.00', 'hand_cash', NULL, '2024-10-28'),
(38, 'salesman_payment', 1, '1000.00', 'bycheque', NULL, '2024-10-28'),
(39, 'salesman_payment', 1, '1000.00', 'bycheque', 5466, '2024-10-28');

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
(5, 'Pics', '1'),
(7, 'abc', '1'),
(8, '272', '1'),
(9, '123', '1'),
(10, 'Product Unit', '1');

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
(2, 'prosanta', 'suvasisis', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@gmail.com', 'admin', 'uploads/user1.png', 'Kadmi Enterprise', '8170903678', 'Reg', 'Aat, Dhumadighi, Malda', '', ''),
(3, 'abhijit', 'abhijit', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'abhjit@gmail.com', 'staf', 'uploads/user1.png', NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sup_ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

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
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
