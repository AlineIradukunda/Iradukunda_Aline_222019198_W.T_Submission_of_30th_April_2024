-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 11:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(10) NOT NULL,
  `Customer_name` varchar(453) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `Telephone` varchar(200) DEFAULT NULL,
  `Email` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Customer_name`, `Address`, `Telephone`, `Email`) VALUES
(2, 'ALICE', 'huye', '7891865', 'aSDFGHJK'),
(3, 'ANGE', 'HUYE', '078999999', 'angeitagrd'),
(5, 'ddddddd', 'aaaaaa', '111111', 'angelab@gmail.com'),
(7, 'alliane', 'kigali', '789999999', 'alinei@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_id` int(10) NOT NULL,
  `Employee_name` varchar(450) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `Telephone` varchar(200) DEFAULT NULL,
  `Email` varchar(450) DEFAULT NULL,
  `Position` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_id`, `Employee_name`, `Address`, `Telephone`, `Email`, `Position`) VALUES
(3, 'hddhd', 'gdgdgd', '12345', '0', 'aline'),
(9, 'aline', 'dueue', '098766', 'aline@gmail.com', 'oieid'),
(10, 'noble', 'asdd', '0792332222', 'noble@gmail.com', 'u3uuu');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `Item_id` int(11) NOT NULL,
  `Item_Name` varchar(100) DEFAULT NULL,
  `Price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Item_id`, `Item_Name`, `Price`) VALUES
(1, 'aline', 3400),
(3, 'yum', 700),
(8, 'pizza', 122333000),
(9, 'hdheh', 22000),
(10, 'ututut', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `order_time` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `item_id`, `customer_id`, `employee_id`, `quantity`, `order_time`) VALUES
(11, 1, 2, 3, 1233, '1234'),
(12, 3, 2, 3, 234, '234'),
(13, 3, 2, 3, 13456, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `reservation_time` varchar(45) DEFAULT NULL,
  `table_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `reservation_time`, `table_number`) VALUES
(2, 3, '100', 1000),
(8, 2, '122', 122),
(9, 3, '12', 122),
(11, 5, '223', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `fname` varchar(155) NOT NULL,
  `lname` varchar(155) NOT NULL,
  `username` varchar(155) NOT NULL,
  `gend` varchar(23) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telephone` varchar(40) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `activation_co` varchar(123) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`fname`, `lname`, `username`, `gend`, `email`, `telephone`, `password`, `activation_co`) VALUES
('qqqqq', 'qwwww', 'aline@gmail.com', 'female', 'eee@gmail.com', '123456', '$2y$10$b9ugepfVCfNps1VWoEF75ukkYmhslUrFij6NOheNrn2MXSFYh9OOS', ''),
('noble', 'man', 'man@gmail.com', 'male', 'man@gmail.com', '09090099', '$2y$10$YKOyiZs5hPBOwZB7a/r14uRo4VSRV0PNewRJZQpYaD1SGT9ugndsC', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `Item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `menu` (`Item_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`Employee_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
