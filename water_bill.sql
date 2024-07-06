-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 04:30 PM
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
  `remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b-house_fam`
--

INSERT INTO `b-house_fam` (`id`, `date`, `total_amount_due`, `date_bill`, `payment_due_date`, `to_date_bill`, `year`, `cu1`, `cu2`, `cu3`, `cu4`, `grand_total_cubic`, `total_cubic`, `1flr_pres_bill`, `1flr_prev_bill`, `1flr_presprev_bill`, `2flr_pres_bill`, `2flr_prev_bill`, `3flr_pres_bill`, `3flr_prev_bill`, `4flr_pres_bill`, `4flr_prev_bill`, `first_floor`, `second_floor`, `third_floor`, `fourth_floor`, `title`, `message`, `remarks`) VALUES
(27, 'Aug 05, 2023', '1179.69', 'Jun', 'Aug 17, 2023', 'Jul', '2023', '7.4', '15.62', '8.92', '10.55', '27.76', '42.49', '110.5', '103.1', '', '823.17', '807.55', '473.18', '464.26', '907.32', '896.77', '205.42', '433.61', '247.62', '292.87', 'Note', 'Pa Gcash nalang po sa number na ito-- 0910-638-8791', 'Paid'),
(67, 'Sep 08, 2023', '616.42', 'Aug', 'Sep 15, 2023', 'Sep', '2023', '4.2', '7.8', '5.54', '5.42', '26.85', '22.96', '114.7', '110.5', '', '830.97', '823.17', '478.72', '473.18', '912.74', '907.32', '112.77', '209.43', '148.75', '145.53', 'Note', 'Pa Gcash nalang po sa number na ito-- 0910-638-8791', 'Paid'),
(69, 'Oct 06, 2023', '669.58', 'Sep', 'Dec 15, 2023', '', '2023', '4.93', '8.13', '6.08', '6.95', '25.66', '26.09', '119.4', '114.47', '', '839.1', '830.97', '484.8', '478.72', '919.69', '912.74', '126.5', '208.62', '156.01', '178.34', '', '', 'Paid'),
(70, 'Nov 06, 2023', '563.27', 'Oct', 'Dec 15, 2023', 'Nov', '2024', '3.8', '7.48', '4.9', '7.19999999', '24.09', '23.38', '123.2', '119.4', '', '846.58', '839.1', '489.7', '484.8', '926.89', '919.69', '91.54', '180.19', '118.04', '173.45', '', '', 'Paid'),
(71, 'Dec 06, 2023', '482.16', 'Dec', 'Dec 15, 2023', '', '2023', '4.4', '6.94999999', '5.4', '6.22', '20.99', '22.97', '127.6', '123.2', '', '853.53', '846.58', '495.1', '489.7', '933.11', '926.89', '92.36', '145.88', '113.35', '130.56', 'Happy Holidays! advance Merry Christmas! ', 'Please po pa Gcash nalang po dito Thank you!. Jerald N. 09053653136', 'Paid'),
(74, 'Jan 08, 2024', '536.13', 'Jan', 'Jan 15, 2024', 'Jan', '2024', '3.2', '5.63', '2.61', '3.46', '35.98', '14.9', '130.8', '127.6', '', '859.16', '853.53', '497.71', '495.1', '936.57', '933.11', '115.14', '202.57', '93.91', '124.49', 'Note', 'Hello po dito nalang po isent sa GCASH 0905-3653-136 Jerald N.', 'Paid'),
(75, 'Feb 15, 2024', '510', 'Feb', 'Feb 15, 2024', 'Feb', '2024', '3.4', '4.09', '3.56', '4.34999999', '33.12', '15.4', '134.2', '130.8', '', '863.25', '859.16', '501.27', '497.71', '940.92', '936.57', '112.61', '135.46', '117.91', '144.07', 'Note:', 'Good day! Pa sent nalang po dito sa GCASH 0905-365-3136 Jerald N.', 'Paid'),
(76, 'Mar 08, 2024', '443.5', 'Mar', 'Mar 15, 2024', 'Mar', '2023', '3', '6.61', '4.44', '7.18000000', '20.89', '21.23', '137.2', '134.2', '', '869.86', '863.25', '505.71', '501.27', '948.1', '940.92', '62.67', '138.08', '92.75', '149.99', 'Note:', 'Good day po B-House Fam. Pa Gcash nalang po ang bayad natin sa tubig. Thanks 09053653136 Jerald N.', 'Paid'),
(77, 'Apr 05, 2024', '610.95', 'Apr', 'Apr 15, 2024', 'Apr', '2024', '7', '14.54', '10.75', '15.15', '12.88', '47.44', '141.2', '134.2', '', '877.79', '863.25', '512.02', '501.27', '956.07', '940.92', '90.16', '187.28', '138.46', '195.13', 'N o t e :', 'Pa Gcash nalang po dito na number - -> 0905-365-3136 Jerald N. ', 'Paid'),
(78, 'May 06, 2024', '647.63', 'May', 'May 15, 2024', 'May', '2024', '3.5', '6.28000000', '4.98', '4.92999999', '32.89', '19.69', '144.7', '141.2', '', '884.07', '877.79', '517', '512.02', '961', '956.07', '115.12', '206.55', '163.79', '162.15', 'Water Billing:', 'Sorry late na nag kwenta sa bill. Pa Gcash nalang dito 09106388791 Charlina R.', 'Unpaid');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
