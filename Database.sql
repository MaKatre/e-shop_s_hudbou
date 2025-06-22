-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2025 at 02:36 AM
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
-- Database: `Database`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `idform` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(90) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`idform`, `name`, `email`, `subject`, `message`) VALUES
(1, 'James', 'james@gmail.com', 'New Metallica album distribution', 'Good day.\r\nI looked at your site and two months before you were able to ship albums even to my country, but now your website doesn\'t give the option when selecting a destination. And I have to ask, why? '),
(2, 'Test User', 'test@example.com', 'Test Subject', 'Test message content'),
(3, 'martin', 'martin@gmail.com', 'Test', 'Testing test.'),
(7, 'tina', 'tina123@gmail.com', 'G-M-A boys', 'Prepáčte ale kedy '),
(8, 'tina', 'tina123@gmail.com', 'G-M-A boys', 'Prepáčte ale kedy '),
(9, 'martina', 'martina@gmail.com', 'Test', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `path_picture` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `num_of_pieces` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `name`, `email`, `password`, `role`) VALUES
(4, 'admin', 'admin@gmail.com', '$2y$10$oh2vq4lJ2uziyCOtsahv6O7L/LyfF5X9G7MdEfrsS.9VC9vFuGPWq', 1),
(5, 'admin_testing', 'admintest@gmail.com', '$2y$10$HPRfuHqjoZ32KUYgam4Q.OQmMqGTqIQ.pPKFTj5aEPkLQttQ5LAHK', 1),
(6, 'martina', 'martina@gmail.com', '$2y$10$P3p6jX2z8jqBoCBHJrpY5ePxFrkKKodGldtHrzoTQSlQl.yFGjQXS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `idwishlist` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`idform`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`idwishlist`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idproduct` (`idproduct`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `idform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `idwishlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
