-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 02:56 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fatafut-mangwaen`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` int(10) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `business_name` text NOT NULL,
  `city` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `business_Type` text NOT NULL,
  `business_category` text NOT NULL,
  `business_reg_date` date NOT NULL,
  `user_role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `first_name`, `last_name`, `username`, `email`, `phone`, `password`, `business_name`, `city`, `address`, `business_Type`, `business_category`, `business_reg_date`, `user_role`) VALUES
(1, 'Ubaid', 'awan', 'ubaid', 'ubaid@gmail.com', 2147483647, '6c474b7fe72b60d28857f5ee1d300045', 'Tahzeeb', 1, 'Rawalpindi', '1', '1', '2022-02-07', 1),
(2, 'Junaid', 'akram', 'junaid', 'junaid@gmail.com', 2147483647, 'd2bf9130317bba494fc4b5b28837b525', 'Junaid Sports', 2, 'lahore', '2', '7', '2022-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `business_cat_id` int(11) NOT NULL,
  `business_cat_title` varchar(30) NOT NULL,
  `business_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`business_cat_id`, `business_cat_title`, `business_date`) VALUES
(1, 'Restaurant', '2022-01-26'),
(2, 'Street foods', '2022-01-26'),
(3, 'Home Based Kitchen', '2022-01-26'),
(4, 'Beauty', '2022-01-26'),
(5, 'Electronics', '2022-01-26'),
(6, 'Flowers', '2022-01-26'),
(7, 'Games', '2022-01-26'),
(8, 'Health', '2022-01-26'),
(10, 'Vehicles', '2022-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `business_type`
--

CREATE TABLE `business_type` (
  `business_type_id` int(11) NOT NULL,
  `business_type_name` varchar(20) NOT NULL,
  `business_type_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`business_type_id`, `business_type_name`, `business_type_date`) VALUES
(1, 'Restaurant', '2022-01-26'),
(2, 'Shop', '2022-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `city_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `city_date`) VALUES
(1, 'rawalpindi', '2022-02-02'),
(2, 'lahore', '2022-02-02'),
(5, 'karachi', '2022-02-02'),
(6, 'islamabad', '2022-02-02'),
(7, 'Gujrat', '2022-02-02'),
(8, 'Murree', '2022-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(60) NOT NULL,
  `coupon_desc` varchar(100) NOT NULL,
  `coupon_value` int(20) NOT NULL,
  `cart_min_value` int(20) NOT NULL,
  `coupon_expired` date NOT NULL,
  `coupon_status` int(11) NOT NULL,
  `coupon_added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_fname` varchar(60) NOT NULL,
  `customer_lname` varchar(60) NOT NULL,
  `customer_email` varchar(60) NOT NULL,
  `customer_password` varchar(10) NOT NULL,
  `customer_orders` int(10) NOT NULL,
  `customer_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(10) NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text NOT NULL,
  `product_price` int(20) NOT NULL,
  `discount` int(20) NOT NULL,
  `product_category` varchar(30) NOT NULL,
  `product_image` varchar(30) NOT NULL,
  `product_tax` int(10) NOT NULL,
  `product_addons` varchar(20) NOT NULL,
  `product_attr` varchar(20) NOT NULL,
  `pro_date` date NOT NULL,
  `business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `product_name`, `product_description`, `product_price`, `discount`, `product_category`, `product_image`, `product_tax`, `product_addons`, `product_attr`, `pro_date`, `business_id`) VALUES
(1, 'Bat', 'description for Bat', 500, 100, '9', '1644242123-bat.jpg', 0, '', '4', '2022-02-07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_addons`
--

CREATE TABLE `product_addons` (
  `addon_ID` int(11) NOT NULL,
  `addon_name` varchar(60) NOT NULL,
  `addon_price` int(11) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_addons`
--

INSERT INTO `product_addons` (`addon_ID`, `addon_name`, `addon_price`, `add_date`) VALUES
(1, 'Pop corns', 10, '2022-01-26'),
(2, 'Extra noodles', 10, '2022-01-26'),
(3, 'Cheese', 3, '2022-01-26'),
(4, 'Coke', 1, '2022-01-26'),
(7, 'Onions', 1, '2022-01-26'),
(8, 'Ketchup', 1, '2022-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `attr_ID` int(11) NOT NULL,
  `attr_Name` varchar(60) NOT NULL,
  `attr_price` int(10) NOT NULL,
  `attr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`attr_ID`, `attr_Name`, `attr_price`, `attr_date`) VALUES
(1, 'Large size', 2, '2022-01-26'),
(2, 'Small Size', 30, '2022-01-26'),
(3, 'Medium', 10, '2022-01-26'),
(4, 'Red color', 12, '2022-01-26'),
(5, 'Blue', 10, '2022-01-26'),
(7, 'Black', 10, '2022-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `cart_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE `product_cat` (
  `product_cat_id` int(11) NOT NULL,
  `product_cat_title` varchar(60) NOT NULL,
  `cat_date` date NOT NULL,
  `pro_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_cat_id`, `product_cat_title`, `cat_date`, `pro_id`) VALUES
(1, 'Pizza', '2022-01-23', 2),
(2, 'Burger', '2022-01-24', 4),
(3, 'Chair', '2022-01-24', 0),
(8, 'Baskets', '2022-01-24', 0),
(9, 'Furniture', '2022-01-24', 1),
(10, 'Shwarma', '2022-01-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `product_order_ID` int(11) NOT NULL,
  `product_ID` int(30) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `product_order_variations` int(10) NOT NULL,
  `total_amount` int(30) NOT NULL,
  `product_payment_method` varchar(10) NOT NULL,
  `product_payment_status` varchar(10) NOT NULL,
  `product_customer` varchar(100) NOT NULL,
  `product_order_date` varchar(100) NOT NULL,
  `product_order_pending` tinyint(4) NOT NULL,
  `product_order_cancel` tinyint(4) NOT NULL,
  `product_order_completed` tinyint(4) NOT NULL,
  `product_order_processing` tinyint(4) NOT NULL,
  `product_order_returned` tinyint(4) NOT NULL,
  `order_rider` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `rider_ID` int(11) NOT NULL,
  `rider_name` varchar(60) NOT NULL,
  `rider_mobile` varchar(60) NOT NULL,
  `rider_password` varchar(60) NOT NULL,
  `rider_CNIC` varchar(60) NOT NULL,
  `rider_address` varchar(100) NOT NULL,
  `rider_city` varchar(70) NOT NULL,
  `rider_orders` int(20) NOT NULL,
  `riders_payment` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `address` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`business_cat_id`);

--
-- Indexes for table `business_type`
--
ALTER TABLE `business_type`
  ADD PRIMARY KEY (`business_type_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `product_addons`
--
ALTER TABLE `product_addons`
  ADD PRIMARY KEY (`addon_ID`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`attr_ID`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `product_cat`
--
ALTER TABLE `product_cat`
  ADD PRIMARY KEY (`product_cat_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`product_order_ID`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`rider_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `business_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `business_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `business_type`
--
ALTER TABLE `business_type`
  MODIFY `business_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_addons`
--
ALTER TABLE `product_addons`
  MODIFY `addon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `attr_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `cart_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_cat`
--
ALTER TABLE `product_cat`
  MODIFY `product_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `product_order_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `rider_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
