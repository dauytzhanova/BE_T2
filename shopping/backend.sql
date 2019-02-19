-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 08, 2019 at 12:11 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `back`
--

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `id` int(100) NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `balance` int(100) NOT NULL,
  `img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`id`, `gender`, `name`, `size`, `balance`, `img`, `price`) VALUES
(1, 'Male', 'Ride Burnout Snowboard', '165cm', 24, 'css/images/img1.png', 18500),
(2, 'Female', 'Burton Clash Wide Snowboard', 'L', 20, 'css/images/img1.png', 14500),
(3, 'Kids', 'Ride Burnout Snowboard', '155cm', 28, 'css/images/img1.png', 18000),
(4, 'Kids', 'Ride Burnout Snowboard', '115cm', 22, 'css/images/img1.png', 19500),
(5, 'Kids', 'Firefly Beacon Snowboard', '115cm', 9, 'css/images/img1.png', 16500),
(6, 'Female', 'Burton Clash Wide Snowboard', '145cm', 28, 'css/images/img1.png', 14500),
(7, 'Male', 'Ride Burnout Snowboard', '155cm', 24, 'css/images/img1.png', 18500),
(8, 'Female', 'Burton Clash Snowboard', '155cm', 20, 'css/images/img1.png', 14500),
(9, 'Male', 'xdhfcjgvh', '5', 76, 'no', 6579);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(35) NOT NULL,
  `FullName` text NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `FullName`, `admin`) VALUES
('botakoz', 'botakoz', 'tcvghbjnk', 'bedfrbhonwrjwe', 0),
('sekerbekova', '070400', 'sekerbekova00@gmail.com', 'Sekerbekova Ainur', 1),
('sekerbekova00', 'ekzamen55', 'rdcbfijhcner', 'ervejbrnehj', 0),
('sekerbekova09', 'ekzamen', 'xdcfvgjbhj', 'tcvyghbjnk', 0),
('symbat', 'symbat', 'efcs', 'sad', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
