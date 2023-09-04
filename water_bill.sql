-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2023 at 07:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water_bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `b-house_fam`
--

CREATE TABLE `b-house_fam` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `total_amount_due` varchar(100) NOT NULL,
  `date_bill` text NOT NULL,
  `payment_due_date` varchar(20) NOT NULL,
  `to_date_bill` text NOT NULL,
  `year` text NOT NULL,
  `cu1` varchar(10) NOT NULL,
  `cu2` varchar(10) NOT NULL,
  `cu3` varchar(10) NOT NULL,
  `cu4` varchar(10) NOT NULL,
  `grand_total_cubic` varchar(100) NOT NULL,
  `total_cubic` varchar(10) NOT NULL,
  `1flr_pres_bill` varchar(100) NOT NULL,
  `1flr_prev_bill` varchar(100) NOT NULL,
  `1flr_presprev_bill` varchar(100) NOT NULL,
  `2flr_pres_bill` varchar(100) NOT NULL,
  `2flr_prev_bill` varchar(100) NOT NULL,
  `3flr_pres_bill` varchar(100) NOT NULL,
  `3flr_prev_bill` varchar(100) NOT NULL,
  `4flr_pres_bill` varchar(100) NOT NULL,
  `4flr_prev_bill` varchar(100) NOT NULL,
  `first_floor` varchar(100) NOT NULL,
  `second_floor` varchar(100) NOT NULL,
  `third_floor` varchar(100) NOT NULL,
  `fourth_floor` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `remarks` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b-house_fam`
--

INSERT INTO `b-house_fam` (`id`, `date`, `total_amount_due`, `date_bill`, `payment_due_date`, `to_date_bill`, `year`, `cu1`, `cu2`, `cu3`, `cu4`, `grand_total_cubic`, `total_cubic`, `1flr_pres_bill`, `1flr_prev_bill`, `1flr_presprev_bill`, `2flr_pres_bill`, `2flr_prev_bill`, `3flr_pres_bill`, `3flr_prev_bill`, `4flr_pres_bill`, `4flr_prev_bill`, `first_floor`, `second_floor`, `third_floor`, `fourth_floor`, `title`, `message`, `remarks`) VALUES
(27, 'Aug 05, 2023', '1179.69', 'Jun', 'Aug 17, 2023', 'Jul', '2023', '7.4', '15.62', '8.92', '10.55', '27.76', '42.49', '110.5', '103.1', '', '823.17', '807.55', '473.18', '464.26', '907.32', '896.77', '205.42', '433.61', '247.62', '292.87', 'Important Note:', 'Paki Gcash nalang po dito sa 09106388791', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `cpass` varchar(100) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `name`, `email`, `password`, `cpass`, `time_stamp`) VALUES
(1, '', 'jeraldnellas@gmail.com', '123', '123', '2023-08-25 17:33:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b-house_fam`
--
ALTER TABLE `b-house_fam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b-house_fam`
--
ALTER TABLE `b-house_fam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
