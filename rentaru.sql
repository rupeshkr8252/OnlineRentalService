-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 01:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('ashu', 'Ashutosh Kumar', '9672836723', 'ashu@gmail.com', 'Gadhwa', 'root'),
('fahim', 'Fahim Ahmad', '9672836728', 'fahim@gmail.com', 'Patna', 'root'),
('ganpat', 'Ganpat Patel', '9672836724', 'ganpat@gmail.com', 'Brahmavara', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `custpro`
--

CREATE TABLE `custpro` (
  `pro_id` int(20) NOT NULL,
  `customer_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custpro`
--

INSERT INTO `custpro` (`pro_id`, `customer_username`) VALUES
(7, 'rupesh'),
(4, 'prakash'),
(5, 'krishna'),
(6, 'neeraj'),
(1, 'deepankan'),
(2, 'abhishek'),
(3, 'raja');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(20) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_des` varchar(5000) NOT NULL,
  `pro_img` varchar(50) DEFAULT 'NA',
  `pro_city` varchar(50) NOT NULL,
  `pro_cat` varchar(50) NOT NULL,
  `pro_rent_per_month` varchar(20) NOT NULL DEFAULT 'NA',
  `pro_rent_per_day` varchar(20) NOT NULL DEFAULT 'NA',
  `pro_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_des`, `pro_img`, `pro_city`, `pro_cat`, `pro_rent_per_month`, `pro_rent_per_day`, `pro_availability`) VALUES
(1, 'Mission 2020', 'Nice book, You should read it once', 'assets/img/products/mission2020.jpg', 'Udupi', 'Books', '100', '10', 'yes'),
(2, 'TV LCD', 'Best LCD TV you can find on Rantaru. 32 inch wide and perfect for your family.', 'assets/img/products/tv.jpg', 'Manglore', 'Electronics & Appliances', '1000', '100', 'yes'),
(3, 'Vivo V17', 'If You want a second hand phone, this will be the best for you. Trust me!', 'assets/img/products/v17.jpg', 'Mysore', 'Mobiles', '500', '50', 'yes'),
(4, 'Washing Machine', 'Rest your hand and wash your cloths smartly.', 'assets/img/products/washing-machine.jpg', 'Banglore', 'Electronics & Appliances', '600', '60', 'yes'),
(5, 'Fridge', 'Cool is your right and no one can take it from you.', 'assets/img/products/fridge.jpg', 'Udupi', 'Electronics & Appliances', '1200', '120', 'yes'),
(6, 'Rich Dad Poor Dad', 'I Know You want it', 'assets/img/products/rdpd.jpg', 'Mysore', 'Books', '200', '8', 'yes'),
(7, 'Activa 125cc', 'Ride Way You want', 'assets/img/products/activa.webp', 'Banglore', 'Vehicle', '3000', '400', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `rentedpro`
--

CREATE TABLE `rentedpro` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `pro_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `pro_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `alt_fare` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `no_of_months` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `custpro`
--
ALTER TABLE `custpro`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `customer_username` (`customer_username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `pro_id` (`pro_id`);

--
-- Indexes for table `rentedpro`
--
ALTER TABLE `rentedpro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `pro_id` (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rentedpro`
--
ALTER TABLE `rentedpro`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custpro`
--
ALTER TABLE `custpro`
  ADD CONSTRAINT `custpro_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`),
  ADD CONSTRAINT `custpro_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `rentedpro`
--
ALTER TABLE `rentedpro`
  ADD CONSTRAINT `rentedpro_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`),
  ADD CONSTRAINT `rentedpro_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
