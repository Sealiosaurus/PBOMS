-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 07:12 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `princess_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `back_order_list`
--

CREATE TABLE `back_order_list` (
  `id` int(30) NOT NULL,
  `receiving_id` int(30) NOT NULL,
  `po_id` int(30) NOT NULL,
  `bo_code` varchar(50) NOT NULL,
  `seller_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `back_order_list`
--

INSERT INTO `back_order_list` (`id`, `receiving_id`, `po_id`, `bo_code`, `seller_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(6, 11, 6, 'BO-0001', 4, 2788.73, 5, 142.5, 3, 81.225, NULL, 0, '2022-12-28 00:34:35', '2022-12-28 00:34:35'),
(7, 13, 8, 'BO-0002', 1, 2000, 0, 0, 0, 0, NULL, 2, '2022-12-28 02:06:33', '2022-12-28 02:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `bo_items`
--

CREATE TABLE `bo_items` (
  `bo_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bo_items`
--

INSERT INTO `bo_items` (`bo_id`, `item_id`, `quantity`, `price`, `unit`, `total`) VALUES
(6, 35, 5, 150, 'pcs', 750),
(6, 36, 10, 210, 'pcs', 2100),
(7, 1, 10, 200, 'pcs', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `po_items`
--

CREATE TABLE `po_items` (
  `po_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `unit` varchar(50) NOT NULL,
  `total` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `po_items`
--

INSERT INTO `po_items` (`po_id`, `item_id`, `quantity`, `price`, `unit`, `total`) VALUES
(5, 1, 10, 200, 'pcs', 2000),
(5, 3, 5, 100, 'pcs', 500),
(6, 35, 20, 150, 'pcs', 3000),
(6, 36, 20, 210, 'pcs', 4200),
(7, 1, 20, 200, 'pcs', 4000),
(7, 3, 5, 100, 'pcs', 500),
(8, 1, 30, 200, 'pcs', 6000),
(9, 6, 20, 1000, 'pcs', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `seller_id` int(30) NOT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `seller_id`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Sunny Blocks', 'Assorted Toy Blocks (50pcs.)', 1, 200, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(2, 'Union Toaster', 'Multifunction Bread Toaster', 2, 600, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(3, 'Sunny Mat', 'Rubber Puzzle Mat (4pcs.)', 1, 100, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(4, 'Union Microwave', 'All-in-one Microwave Oven', 2, 950, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(6, 'Dummy Product', 'Dummy Description', 6, 1000, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(24, 'Sunny Ball', 'Rubber Ball', 1, 50, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(25, 'Union Blender', 'Fruit Blender', 2, 900, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(35, 'TBand Shirt', 'Red Shirt w/ Talamband Print', 4, 150, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(36, 'TBand Jeans', 'Unisex Ripped Jeans', 4, 210, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(37, 'TBand Cap', 'Outdoor Sports Cap', 4, 50, 1, '2022-12-28 00:07:22', '2022-12-28 00:07:22'),
(38, 'Test Product 1', 'Test description 1.', 7, 1000, 1, '2022-12-28 02:01:40', '2022-12-28 02:01:40'),
(39, 'Test Product 2', 'Test description 2.', 7, 2000, 0, '2022-12-28 02:01:59', '2022-12-28 02:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_list`
--

CREATE TABLE `purchase_order_list` (
  `id` int(30) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `seller_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order_list`
--

INSERT INTO `purchase_order_list` (`id`, `po_code`, `seller_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(5, 'PO-0001', 1, 2362.5, 10, 250, 5, 112.5, '', 2, '2022-12-28 00:31:30', '2022-12-28 00:32:36'),
(6, 'PO-0002', 4, 7045.2, 5, 360, 3, 205.2, '', 1, '2022-12-28 00:33:52', '2022-12-28 00:34:35'),
(7, 'PO-0003', 1, 4252.5, 10, 450, 5, 202.5, '', 0, '2022-12-28 02:04:28', '2022-12-28 02:05:36'),
(8, 'PO-0004', 1, 6000, 0, 0, 0, 0, '', 2, '2022-12-28 02:06:09', '2022-12-28 02:07:24'),
(9, 'PO-0005', 6, 20000, 0, 0, 0, 0, '', 2, '2022-12-28 02:08:44', '2022-12-28 02:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `receiving_list`
--

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL,
  `form_id` int(30) NOT NULL,
  `from_order` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=PO ,2 = BO',
  `amount` float NOT NULL DEFAULT 0,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `stock_ids` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiving_list`
--

INSERT INTO `receiving_list` (`id`, `form_id`, `from_order`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `stock_ids`, `remarks`, `date_created`, `date_updated`) VALUES
(10, 5, 1, 2362.5, 10, 250, 5, 112.5, '31,32', '', '2022-12-28 00:32:36', '2022-12-28 00:32:36'),
(11, 6, 1, 4256.48, 5, 217.5, 3, 123.975, '33,34', '', '2022-12-28 00:34:35', '2022-12-28 00:34:35'),
(13, 8, 1, 4000, 0, 0, 0, 0, '38', '', '2022-12-28 02:06:33', '2022-12-28 02:06:33'),
(14, 7, 2, 2000, 0, 0, 0, 0, '39', '', '2022-12-28 02:07:24', '2022-12-28 02:07:24'),
(15, 9, 1, 20000, 0, 0, 0, 0, '40', '', '2022-12-28 02:09:08', '2022-12-28 02:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `return_list`
--

CREATE TABLE `return_list` (
  `id` int(30) NOT NULL,
  `return_code` varchar(50) NOT NULL,
  `seller_id` int(30) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `stock_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_list`
--

INSERT INTO `return_list` (`id`, `return_code`, `seller_id`, `amount`, `remarks`, `stock_ids`, `date_created`, `date_updated`) VALUES
(4, 'R-0001', 6, 5000, 'Low quality.', '41', '2022-12-28 02:09:48', '2022-12-28 02:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `location`, `email`, `contact`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Sunny Side Corporation', 'Boracay, Philippines', 'sunnyside@gmail.com', '92839103', 1, '2022-12-28 00:07:12', '2022-12-28 00:07:12'),
(2, 'Union Appliances', 'Fidel Bas St., Mohon, Cebu', 'union_app@gmail.com', '21474836', 0, '2022-12-28 00:07:12', '2022-12-28 02:00:49'),
(4, 'Talamband', 'H. Abellana St., Canduman, Mandaue', 'talamband@gmail.com', '45645464', 1, '2022-12-28 00:07:12', '2022-12-28 00:07:12'),
(6, 'Dummy', 'Dummy Location', 'dummy@dummy.com', '00000000', 1, '2022-12-28 00:07:12', '2022-12-28 00:07:12'),
(7, 'Test Seller', 'Test Location', 'test@gmail.com', '00000000', 1, '2022-12-28 02:00:33', '2022-12-28 02:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `price` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT current_timestamp(),
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=IN , 2=OUT',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`id`, `item_id`, `quantity`, `unit`, `price`, `total`, `type`, `date_created`) VALUES
(31, 1, 10, 'pcs', 200, 2000, 1, '2022-12-28 00:32:36'),
(32, 3, 5, 'pcs', 100, 500, 1, '2022-12-28 00:32:36'),
(33, 35, 15, 'pcs', 150, 2250, 1, '2022-12-28 00:34:35'),
(34, 36, 10, 'pcs', 210, 2100, 1, '2022-12-28 00:34:35'),
(38, 1, 20, 'pcs', 200, 4000, 1, '2022-12-28 02:06:33'),
(39, 1, 10, 'pcs', 200, 2000, 1, '2022-12-28 02:07:24'),
(40, 6, 20, 'pcs', 1000, 20000, 1, '2022-12-28 02:09:08'),
(41, 6, 5, 'pcs', 1000, 5000, 2, '2022-12-28 02:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Princess Bazaar Order Management System'),
(6, 'short_name', 'Princess Bazaar'),
(11, 'logo', 'uploads/1670867400_logo.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1670867460_pbbg.png'),
(15, 'content', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(2, 'Andy', NULL, 'Chiu', 'andrea', '1a1dc91c907325c69271ddf0c944bc72', 'uploads/1670782440_AC.png', NULL, 1, '2021-11-03 14:22:46', '2022-12-28 01:59:33'),
(3, 'Carl', NULL, 'Villaceran', 'carl', '1a1dc91c907325c69271ddf0c944bc72', 'uploads/1670782440_CV.png', NULL, 2, '2022-12-12 01:14:52', '2022-12-12 02:19:49'),
(4, 'Sealtiel', NULL, 'Villegas', 'seal', '1a1dc91c907325c69271ddf0c944bc72', 'uploads/1670782500_SV.png', NULL, 2, '2022-12-12 01:16:22', '2022-12-12 21:35:09'),
(5, 'Lara', NULL, 'Jakosalem', 'lara', '1a1dc91c907325c69271ddf0c944bc72', 'uploads/1670782500_LJ.png', NULL, 1, '2022-12-12 02:15:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `back_order_list`
--
ALTER TABLE `back_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`seller_id`),
  ADD KEY `po_id` (`po_id`),
  ADD KEY `receiving_id` (`receiving_id`);

--
-- Indexes for table `bo_items`
--
ALTER TABLE `bo_items`
  ADD KEY `item_id` (`item_id`),
  ADD KEY `bo_id` (`bo_id`);

--
-- Indexes for table `po_items`
--
ALTER TABLE `po_items`
  ADD KEY `po_id` (`po_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`seller_id`);

--
-- Indexes for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`seller_id`);

--
-- Indexes for table `receiving_list`
--
ALTER TABLE `receiving_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_list`
--
ALTER TABLE `return_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`seller_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `back_order_list`
--
ALTER TABLE `back_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `return_list`
--
ALTER TABLE `return_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `back_order_list`
--
ALTER TABLE `back_order_list`
  ADD CONSTRAINT `back_order_list_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `back_order_list_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `back_order_list_ibfk_3` FOREIGN KEY (`receiving_id`) REFERENCES `receiving_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bo_items`
--
ALTER TABLE `bo_items`
  ADD CONSTRAINT `bo_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bo_items_ibfk_2` FOREIGN KEY (`bo_id`) REFERENCES `back_order_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `po_items`
--
ALTER TABLE `po_items`
  ADD CONSTRAINT `po_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD CONSTRAINT `purchase_order_list_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_list`
--
ALTER TABLE `return_list`
  ADD CONSTRAINT `return_list_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD CONSTRAINT `stock_list_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
