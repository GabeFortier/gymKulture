-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 07:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `testtable`
--

CREATE TABLE `testtable` (
  `productName` varchar(56) NOT NULL,
  `tag` varchar(16) DEFAULT NULL,
  `DISC` varchar(256) DEFAULT NULL,
  `picturePath` varchar(56) NOT NULL,
  `price` int(20) NOT NULL,
  `id` int(11) NOT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `category` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testtable`
--

INSERT INTO `testtable` (`productName`, `tag`, `DISC`, `picturePath`, `price`, `id`, `imagePath`, `category`) VALUES
('mensTop', 'mens', 'This is the first description added, and is pulling from the DB!', 'assets/menTop1.jpg', 25, 2, NULL, 'shirt'),
('Women\'s Shorts', 'womens', 'This description also is coming from the DB!', 'assets/womensShorts.jpg', 32, 3, NULL, 'pants'),
('Men\'s Shorts', 'mens', 'Short desc but from DB!', 'assets/mensShorts.jpg', 15, 4, NULL, 'pants'),
('Women\'s Top', 'womens', 'You are probably getting the idea, we pull from the DB!', 'assets/womensTop.jpg', 13, 5, NULL, 'shirt'),
('Women\'s Leggings', 'womens', 'Last disc I\'m adding for now more to come!', 'assets/leggings.jpg', 22, 6, NULL, 'pants'),
('Sweat Pants', 'mens', 'These are sweat pants for men.', 'assets/mensSweats.jpg', 22, 9, 'assets/mensSweats.jpg', 'pants'),
('Fitted Top', 'mens', 'A top that hugs the body and will have you ready for anything.', 'assets/fitMensTop.jpg', 20, 10, 'assets/fitMensTop.jpg', 'shirt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `testtable`
--
ALTER TABLE `testtable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `testtable`
--
ALTER TABLE `testtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
