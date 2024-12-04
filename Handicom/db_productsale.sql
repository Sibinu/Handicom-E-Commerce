-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 04:58 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_productsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_email`, `admin_password`, `admin_id`) VALUES
('admin@gmail.com', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_totalamt` bigint(20) NOT NULL,
  `booking_nos` bigint(20) NOT NULL,
  `booking_deliveryaddress` varchar(5000) NOT NULL,
  `booking_status` int(11) DEFAULT '0',
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`product_id`, `user_id`, `booking_date`, `booking_totalamt`, `booking_nos`, `booking_deliveryaddress`, `booking_status`, `booking_id`) VALUES
(1, 1, '2022-11-06', 90, 2, 'MPA', 2, 1),
(2, 1, '2022-11-07', 800, 2, 'MPA', 1, 2),
(3, 1, '2022-12-13', 400, 1, 'MPA', 1, 4),
(2, 1, '2022-12-13', 1000, 2, 'mpa', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(1, 'Electronics'),
(2, 'Toys');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'Ernakulam'),
(2, 'Idukki');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(5000) NOT NULL,
  `place_pincode` varchar(5000) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `place_pincode`, `district_id`) VALUES
(1, 'Muvattupuzha', '686671', 1),
(2, 'Thodupuzha', '686671', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_name` varchar(5000) NOT NULL,
  `product_rate` bigint(20) NOT NULL,
  `product_details` varchar(5000) NOT NULL,
  `product_photo` varchar(5000) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_name`, `product_rate`, `product_details`, `product_photo`, `category_id`, `supplier_id`, `product_id`) VALUES
('A', 45, 'dfdf', 'Icondrawer-Gifts-Bouquet.ico', 1, 1, 1),
('Product -1', 500, 'Good', 'Dapino-Office-Women-Eyes-office-women-red.ico', 1, 1, 2),
('Toys-1', 400, 'Good', 'Notebook-Photo-Class.ico', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productfield`
--

CREATE TABLE `tbl_productfield` (
  `field_name` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productfield`
--

INSERT INTO `tbl_productfield` (`field_name`, `product_id`, `field_id`) VALUES
('Width', 3, 1),
('Height', 3, 2),
('Length', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productfielduser`
--

CREATE TABLE `tbl_productfielduser` (
  `booking_id` int(11) NOT NULL,
  `userfield_name` varchar(5000) NOT NULL,
  `field_id` int(11) NOT NULL,
  `userfield_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_productfielduser`
--

INSERT INTO `tbl_productfielduser` (`booking_id`, `userfield_name`, `field_id`, `userfield_id`) VALUES
(4, '10', 1, 1),
(4, '20', 2, 2),
(5, '20', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_date` date NOT NULL,
  `review_comment` varchar(5000) NOT NULL,
  `review_rate` bigint(20) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`booking_id`, `user_id`, `review_date`, `review_comment`, `review_rate`, `review_id`) VALUES
(1, 1, '2022-11-07', 'Good', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_name` varchar(5000) NOT NULL,
  `supplier_contact` varchar(5000) NOT NULL,
  `supplier_email` varchar(5000) NOT NULL,
  `supplier_address` varchar(5000) NOT NULL,
  `supplier_proof` varchar(5000) NOT NULL,
  `place_id` int(11) NOT NULL,
  `supplier_password` varchar(5000) NOT NULL,
  `supplier_photo` varchar(5000) NOT NULL,
  `supplier_doj` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_name`, `supplier_contact`, `supplier_email`, `supplier_address`, `supplier_proof`, `place_id`, `supplier_password`, `supplier_photo`, `supplier_doj`, `supplier_id`, `supplier_status`) VALUES
('SR Traders', '9448563221', 'srt@gmail.com', 'MPA', 'Icondrawer-Gifts-Rose.ico', 1, '123456', 'Gaia.ico', '2022-11-06', 1, 1),
('Bismi Traders', '9446528778', 'bismi@gmail.com', 'MPA', 'Icondrawer-Gifts-Rose.ico', 2, '123456', 'Icondrawer-Gifts-Bouquet.ico', '2022-11-07', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_name` varchar(5000) NOT NULL,
  `user_contact` varchar(500) NOT NULL,
  `user_gender` varchar(500) NOT NULL,
  `user_email` varchar(5000) NOT NULL,
  `user_address` varchar(5000) NOT NULL,
  `user_proof` varchar(5000) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_photo` varchar(5000) NOT NULL,
  `user_doj` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_name`, `user_contact`, `user_gender`, `user_email`, `user_address`, `user_proof`, `place_id`, `user_password`, `user_photo`, `user_doj`, `user_id`) VALUES
('Praveen', '9446418552', 'Male', 'praveen@gmail.com', 'MPA', 'Icondrawer-Gifts-Rose.ico', 1, '123456', 'Gaia.ico', '2022-11-06', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_productfield`
--
ALTER TABLE `tbl_productfield`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `tbl_productfielduser`
--
ALTER TABLE `tbl_productfielduser`
  ADD PRIMARY KEY (`userfield_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_productfield`
--
ALTER TABLE `tbl_productfield`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_productfielduser`
--
ALTER TABLE `tbl_productfielduser`
  MODIFY `userfield_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
