-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2018 at 05:58 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timisha`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` int(11) NOT NULL,
  `bank_pay` int(11) NOT NULL,
  `salaries` int(11) NOT NULL,
  `kitchen` int(11) NOT NULL,
  `bevarage` int(11) NOT NULL,
  `staff_food` int(11) NOT NULL,
  `charcoal` int(11) NOT NULL,
  `gas` int(11) NOT NULL,
  `electricity` int(11) NOT NULL,
  `security` int(11) NOT NULL,
  `house_keeping` int(11) NOT NULL,
  `front_office` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `repairs` int(11) NOT NULL,
  `f_b_restaurant` int(11) NOT NULL,
  `compound` int(11) NOT NULL,
  `water` int(11) NOT NULL,
  `newspaper` int(11) NOT NULL,
  `stationary` int(11) NOT NULL,
  `liquid_soap` int(11) NOT NULL,
  `total_exp` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `bank_pay`, `salaries`, `kitchen`, `bevarage`, `staff_food`, `charcoal`, `gas`, `electricity`, `security`, `house_keeping`, `front_office`, `transport`, `repairs`, `f_b_restaurant`, `compound`, `water`, `newspaper`, `stationary`, `liquid_soap`, `total_exp`, `exp_date`, `created_at`, `created_by`) VALUES
(1, 100000, 2000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017-12-31', '2017-12-31 01:04:03', 0),
(2, 0, 0, 0, 0, 0, 0, 0, 30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017-12-30', '0000-00-00 00:00:00', 0),
(3, 10000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-01-01', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
