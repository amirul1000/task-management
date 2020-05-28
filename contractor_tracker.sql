-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 10:31 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contractor_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`, `created_at`, `lastlogin_at`) VALUES
(1, 'Admin', 'admin', 'admin', 'admin@admin.com', '2014-11-25 11:57:28', '2016-07-19 17:13:45'),
(2, 'Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', '2014-11-25 11:57:28', '2016-07-19 17:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `no` varchar(64) NOT NULL,
  `company_name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `users_id`, `no`, `company_name`, `description`, `date_time_created`, `date_time_updated`) VALUES
(3, 2, '3', 'Fairy Tale Farm', 'Horse Farm', '2016-01-30 21:35:26', '2016-01-30 21:35:26'),
(16, 15, '16', 'Fairy Tale Farm', 'FTF', '2016-03-10 20:06:11', '2016-03-10 20:06:11'),
(17, 22, '17', 'AA', 'AA', '2016-06-20 20:40:06', '0000-00-00 00:00:00'),
(18, 22, '18', 'BB', 'BB', '2016-06-22 05:57:34', '0000-00-00 00:00:00'),
(19, 37, '19', 'PRECISE ELITE BUILDERS INC', '#LICENSE 1010168', '2016-06-24 08:08:37', '2016-06-24 08:08:37'),
(20, 38, '20', 'Jonetta Moyo Unlimited,  LLC', 'Group Coaching and Facilitator', '2016-06-25 00:36:24', '2016-06-25 00:36:24'),
(21, 41, '21', 'FTF Hauling', 'Fairy Tale Farm Hauling', '2016-07-01 02:44:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_register`
--

CREATE TABLE `company_register` (
  `id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `status` enum('accept','deny') NOT NULL,
  `register_status` enum('register','unregister') NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_register`
--

INSERT INTO `company_register` (`id`, `company_id`, `users_id`, `status`, `register_status`, `date_created`) VALUES
(4, 3, 3, 'accept', 'register', '2016-03-18'),
(6, 3, 8, 'accept', 'register', '2016-05-19'),
(9, 3, 13, 'accept', 'register', '2016-03-09'),
(10, 3, 14, 'accept', 'register', '2016-03-15'),
(13, 3, 23, 'accept', 'register', '2016-05-10'),
(17, 16, 8, 'accept', 'register', '2016-05-19'),
(18, 3, 24, 'accept', 'register', '2016-05-22'),
(19, 3, 25, 'accept', 'unregister', '2016-05-22'),
(20, 27, 8, 'accept', 'register', '2016-05-22'),
(21, 16, 25, 'accept', 'register', '2016-05-23'),
(22, 16, 26, 'accept', 'register', '2016-06-12'),
(23, 16, 27, 'accept', 'register', '2016-06-12'),
(24, 16, 28, 'accept', 'register', '2016-06-12'),
(25, 16, 31, 'accept', 'register', '2016-06-15'),
(26, 16, 32, 'accept', 'register', '2016-06-15'),
(27, 16, 33, 'accept', 'register', '2016-06-15'),
(28, 16, 35, 'accept', 'register', '2016-06-20'),
(29, 16, 34, 'accept', 'register', '2016-06-20'),
(30, 17, 4, 'accept', 'register', '2016-06-20'),
(31, 16, 36, 'accept', 'register', '2016-06-21'),
(32, 18, 4, 'accept', 'register', '2016-06-22'),
(33, 20, 39, 'accept', 'register', '2016-06-25'),
(34, 16, 40, 'accept', 'register', '2016-06-27'),
(35, 21, 42, 'accept', 'register', '2016-07-02'),
(36, 21, 44, 'accept', 'register', '2016-07-07'),
(37, 21, 43, 'accept', 'register', '2016-07-10'),
(38, 21, 31, 'accept', 'register', '2016-07-16'),
(39, 16, 44, 'accept', 'register', '2016-07-16'),
(40, 16, 43, 'accept', 'register', '2016-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `payment_key`
--

CREATE TABLE `payment_key` (
  `id` int(10) NOT NULL,
  `secret_key` varchar(256) NOT NULL,
  `publishable_key` varchar(256) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_key`
--

INSERT INTO `payment_key` (`id`, `secret_key`, `publishable_key`, `status`) VALUES
(1, 'sk_live_D7C2TzCSlTtO2ZSka7dO4lvV', 'pk_live_NjmNQCYYhQwktJg0BDoeu767', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(10) NOT NULL,
  `plan_name` varchar(64) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `no_of_company_allow` int(10) NOT NULL,
  `no_of_tasks_allow` int(10) NOT NULL,
  `no_of_contractor_report` int(10) NOT NULL,
  `subscription_duration_days` int(10) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_name`, `price`, `no_of_company_allow`, `no_of_tasks_allow`, `no_of_contractor_report`, `subscription_duration_days`, `description`, `status`) VALUES
(1, 'basic', '0.00', 1, 3, 1, 30, 'The basic service allows the owner to list 1 company and 3 tasks, and have 1 contractor report time is FREE', 'active'),
(2, 'plus', '2.99', 1, 10, 10, 30, 'The plus service allows the owner to list 1 company and 10 tasks and have up to 10 contractors report time 2.99 a month', 'active'),
(3, 'premium', '5.99', 10000, 10000, 10000, 30, 'The premium service allows unlimited services and is 5.99 a month', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `current_period_start` bigint(20) NOT NULL,
  `current_period_end` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `users_id`, `plan_id`, `current_period_start`, `current_period_end`) VALUES
(5, 1, 3, 1456654907, 1464430907),
(11, 12, 1, 1462665600, 1465344000),
(12, 12, 3, 1456826993, 1464602993),
(13, 9, 1, 1456790400, 1459468800),
(14, 2, 1, 1590616800, 1593295200),
(15, 8, 1, 1462665600, 1465344000),
(16, 3, 1, 1462233600, 1464912000),
(18, 13, 1, 1457481600, 1460160000),
(19, 14, 1, 1457568000, 1460246400),
(20, 15, 1, 1457568000, 1460246400),
(21, 15, 2, 1457640816, 1460319216),
(22, 16, 1, 1458259200, 1460937600),
(23, 17, 1, 1459296000, 1461974400),
(24, 18, 1, 1459468800, 1462060800),
(25, 21, 1, 1460678400, 1463270400),
(26, 0, 1, 1464048000, 1466726400),
(27, 22, 1, 1466380800, 1468972800),
(28, 37, 1, 1466726400, 1469318400),
(29, 38, 1, 1466812800, 1469404800),
(30, 38, 1, 1466815365, 1469407365),
(31, 39, 1, 1466812800, 1469404800),
(32, 41, 1, 1467331200, 1470009600),
(33, 43, 1, 1468627200, 1471305600);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_type`
--

CREATE TABLE `subscription_type` (
  `id` int(10) NOT NULL,
  `subscription_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `plan` varchar(20) NOT NULL,
  `susbcription` varchar(256) NOT NULL,
  `customers` varchar(256) NOT NULL,
  `cards` varchar(256) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_type`
--

INSERT INTO `subscription_type` (`id`, `subscription_id`, `users_id`, `plan_id`, `plan`, `susbcription`, `customers`, `cards`, `status`) VALUES
(3, 3, 1, 3, 'premium', 'sub_7z2aqkE8Ax3Qle', 'cus_7z2abDKEj5H0Cb', 'card_17j4V9DxLziL25PlekJXVFxO', 'active'),
(4, 4, 1, 3, 'premium', 'sub_7zQM6MTFBWcJkU', 'cus_7zQMpPAXScx0P8', 'card_17jRVlDxLziL25Pl5RY9dPYb', 'active'),
(5, 5, 1, 3, 'premium', 'sub_7zQXsT9BYO6sGk', 'cus_7zQXbjN1RZY5L9', 'card_17jRgNDxLziL25PlmEtr4Igl', 'active'),
(6, 12, 12, 3, 'premium', 'sub_80AnlEKI3OUYp9', 'cus_80An2TPzVsgqGc', 'card_17kARxDxLziL25PljOUaPC4I', 'active'),
(7, 21, 15, 2, 'plus', 'sub_83hZo79uS0f3gq', 'cus_83hZwOkBkkOGoX', 'card_17naA8DxLziL25PltKzZopIP', 'active'),
(8, 30, 38, 1, 'basic', 'sub_8hTqWVdETnGt5y', 'cus_8hTqZg6yJ3huba', 'card_18Q4sjDxLziL25Pl6C4QvdgT', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `posted_date_time` datetime NOT NULL,
  `task_name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `rate` varchar(64) NOT NULL,
  `perday_type` varchar(64) DEFAULT NULL,
  `unit_type` enum('Day','Hour','Minute') NOT NULL,
  `max_units_per_day` varchar(20) NOT NULL,
  `approx_completed_no_unit` varchar(64) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `company_id`, `users_id`, `posted_date_time`, `task_name`, `description`, `rate`, `perday_type`, `unit_type`, `max_units_per_day`, `approx_completed_no_unit`, `status`) VALUES
(36, 3, 2, '2016-01-30 00:00:00', 'Clean Stalls', 'Clean, Bed, and  Rake Aisle', '2.10', NULL, 'Day', '30', '30', 'active'),
(37, 3, 2, '2016-02-02 00:00:00', 'AM Feed', 'Feed and Water AM shift', '8', NULL, 'Hour', '1', '1', 'active'),
(38, 3, 2, '2016-01-30 00:00:00', 'PM Feed1', 'Feed and Water PM', '10', NULL, 'Day', '1', '1', 'active'),
(40, 1, 1, '2016-03-07 10:06:38', '333', '3434', '2.00', NULL, 'Hour', '44', '', 'active'),
(41, 1, 1, '2016-03-07 05:28:01', '3232', 'Note\n23232', '33.33', NULL, 'Hour', '333', '', 'active'),
(79, 15, 12, '2016-03-01 12:34:37', 'ttrtr', '4545', '545.00', NULL, '', '545', '545', 'active'),
(80, 15, 12, '2016-03-01 12:34:44', '55', '55', '55.00', NULL, '', '55', '55', 'active'),
(81, 15, 12, '2016-03-01 12:34:52', '55', '55', '55.00', NULL, 'Minute', '55', '55', 'active'),
(83, 2, 1, '2016-03-07 05:36:13', '2', '2', '2.00', NULL, 'Hour', '22', '', 'active'),
(84, 1, 1, '2016-03-07 07:05:08', 'Test', 'Note\n', '1.00', NULL, 'Hour', '10', '', 'active'),
(85, 2, 1, '2016-03-09 06:41:08', '1', '1', '1.00', NULL, 'Hour', '1', '', 'active'),
(86, 16, 15, '2016-05-23 20:00:43', 'Clean Stalls', 'Report Number\r\n\r\n - Remove ALL soiled bedding and manure from stall\r\n- Spread Manure, leave spreader by big barn empty for next use\r\n- Rake Aisles\r\n- Add Bedding as necessary\r\n- Dump water bucket if necessary\r\n\r\n', '2.10', NULL, 'Day', '27', '', 'active'),
(88, 20, 0, '0000-00-00 00:00:00', '11', '11', '11', NULL, 'Day', '11', '', 'active'),
(89, 20, 0, '0000-00-00 00:00:00', '11', '11', '11', NULL, 'Hour', '11', '', 'active'),
(90, 20, 22, '2016-05-09 10:38:10', '1144', '11', '11', NULL, 'Minute', '11', '', 'active'),
(91, 20, 22, '2016-05-08 07:46:20', '11', '11', '11', NULL, 'Hour', '11', '', 'active'),
(93, 19, 22, '2016-05-08 07:47:10', '11', 'blue', '11', NULL, 'Minute', '11', '', 'active'),
(96, 24, 1, '2016-05-13 09:12:42', '1144', '11', '11', NULL, 'Day', '11', '', 'active'),
(97, 24, 1, '2016-05-13 09:26:52', '34343', '43434', '43434', NULL, 'Day', '434', '', 'active'),
(98, 23, 1, '2016-05-13 09:21:51', '43434', '343434', '3434', NULL, 'Day', '3434', '', 'active'),
(100, 25, 1, '2016-05-13 09:38:53', '2343434', '3434343', '43434', NULL, 'Day', '34343', '', 'active'),
(105, 16, 15, '2016-06-07 02:02:29', 'AM Feed and Water', '- Hay\r\n- Grain (see chart)\r\n- Clean Feed Bin Area (both barns)\r\n- Water  - Fill all buckets\r\n', '10', NULL, 'Day', '1', '', 'active'),
(106, 16, 15, '2016-06-07 02:02:37', 'PM Feed and Water', '- Hay\r\n- Grain (see chart)\r\n- Supplements (see chart)\r\n- Clean Feed Bin Area (both barns)\r\n- Water  - Fill all buckets\r\n', '12', NULL, 'Day', '1', '', 'active'),
(108, 16, 15, '2016-05-23 20:07:39', 'Turnout (full)', 'Bring horses in and turn horses out - Fill Water', '10', NULL, 'Day', '2', '', 'active'),
(109, 16, 15, '2016-05-23 20:28:43', 'Private Lesson ', 'Private Lesson, please indicate students First AND Last Name in comments', '22.5', NULL, 'Day', '50', '', 'active'),
(110, 16, 15, '2016-05-23 20:30:35', 'Semi Private Lesson', 'Semi Private lesson - please indicate Students First AND Last Names', '15', NULL, 'Day', '50', '', 'active'),
(115, 27, 1, '2016-05-24 03:44:24', '54545', '4545', '5454', NULL, 'Day', '1', '', 'active'),
(116, 27, 1, '2016-05-24 03:44:31', '54545', '4545', '5454', NULL, 'Day', '1', '', 'active'),
(117, 27, 1, '2016-05-24 03:45:48', '54545', '4545', '5454', NULL, 'Day', '1', '', 'active'),
(118, 16, 15, '2016-06-09 18:22:01', 'Bleach Water Buckets', 'Bleach all buckets and troughs', '15', NULL, 'Day', '1', '', 'active'),
(119, 16, 15, '2016-06-20 18:36:25', 'Show Coaching', 'Coaching - You MUST indicate rider and Show', '30', NULL, 'Day', '50', '', 'active'),
(120, 16, 15, '2016-06-20 18:37:35', 'Holding for Vet/Farrier', 'You MUST indicate what horse and for what service', '5', NULL, 'Day', '50', '', 'active'),
(121, 17, 22, '2016-06-20 20:40:33', 'AA', 'AA', '11', NULL, 'Day', '10', '', 'active'),
(122, 18, 22, '2016-06-22 05:58:03', 'BB', 'BB', '10', NULL, 'Hour', '100', '', 'active'),
(123, 20, 38, '2016-06-25 00:45:09', 'Paper rod relocation', 'Note\n', '8.00', NULL, 'Hour', '2', '', 'active'),
(124, 21, 41, '2016-07-01 02:49:46', 'Delaware 6/30 - 7/3', '1 way only.\r\nEnter Horse Names and count for each day', '50', NULL, 'Day', '30', '', 'active'),
(125, 16, 15, '2016-07-11 01:52:06', 'Camp Counselor', 'For Adult Camp Workers', '50', NULL, 'Day', '1', '', 'active'),
(126, 16, 15, '2016-07-11 01:54:18', 'Camp CIT', 'For Youth Assistants', '20', NULL, 'Day', '2', '', 'active'),
(127, 16, 15, '2016-07-11 02:03:17', 'Show - Barn Manager', 'General Assistant at Show away from Farm, including AM feed, water throughout day and assistance with client scheduling and showing.', '50', NULL, 'Day', '1', '', 'active'),
(128, 21, 41, '2016-07-17 00:42:01', '7/16 Rocky Fork', 'Log ROUND TRIP', '10', NULL, 'Day', '20', '', 'active'),
(129, 3, 2, '2020-05-28 10:30:28', 'bvbvb', 'vbvb', 'bvbvbv', 'limited', 'Day', '11', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `task_performed`
--

CREATE TABLE `task_performed` (
  `id` int(10) NOT NULL,
  `task_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL,
  `date_time` date NOT NULL,
  `description` text NOT NULL,
  `no_of_units_completed` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_performed`
--

INSERT INTO `task_performed` (`id`, `task_id`, `users_id`, `date_time`, `description`, `no_of_units_completed`) VALUES
(18, 36, 3, '2016-01-31', ',', '4'),
(19, 36, 3, '2016-01-31', 'dd', '4'),
(20, 38, 3, '2016-01-31', 'sss', '2'),
(26, 40, 5, '2016-01-31', 'fhfhh', '3'),
(27, 40, 5, '2016-01-14', 'fgfg', '4'),
(28, 36, 3, '2016-02-04', 'o', '7'),
(33, 41, 4, '2016-01-31', '545345', '555'),
(34, 41, 4, '2016-01-13', '434', '434'),
(36, 41, 4, '2016-02-05', '3323', '3'),
(37, 41, 4, '2016-02-07', '333', '33'),
(38, 41, 4, '2016-02-18', '333', '333'),
(39, 41, 4, '2016-02-08', '343', '3434'),
(40, 36, 3, '2016-02-05', '', '5'),
(41, 37, 3, '2016-02-12', '', '4'),
(42, 37, 3, '2016-02-12', '', '4'),
(43, 38, 3, '2016-02-12', '', '1'),
(44, 37, 3, '2016-02-11', '', '3'),
(45, 36, 3, '2016-02-09', '', '3'),
(46, 36, 3, '2016-02-05', '', '60'),
(47, 36, 3, '2016-02-05', '', '14'),
(48, 37, 3, '2016-02-05', '', '1'),
(50, 41, 4, '2016-02-24', '555', '5'),
(51, 41, 4, '2016-02-24', 'hhh', '3'),
(52, 36, 3, '2016-02-23', '', '3'),
(55, 36, 3, '2016-03-04', '', '10'),
(70, 84, 4, '2016-03-07', '44', '2'),
(72, 84, 4, '2016-03-07', '3', '3'),
(73, 84, 4, '2016-03-07', 'test', '1'),
(75, 84, 4, '2016-03-07', '1', '1'),
(76, 84, 4, '2016-03-07', '3', '3'),
(78, 83, 4, '2016-03-07', '2', '2'),
(79, 84, 4, '2016-03-08', '1111', '1'),
(80, 83, 4, '2016-03-08', '2', '2'),
(82, 38, 3, '2016-03-08', '', '1'),
(92, 40, 4, '2016-03-11', '44', '4'),
(93, 40, 4, '2016-03-11', '4', '4'),
(94, 40, 4, '2016-03-13', '11', '11'),
(95, 84, 4, '2016-03-13', '3', '3'),
(96, 36, 14, '2016-03-15', 'Sfffgh', '2'),
(97, 36, 14, '2016-03-14', 'Vhhg', '5'),
(98, 37, 14, '2016-03-13', 'Ghbh', '1'),
(99, 38, 14, '2016-03-15', '', '1'),
(100, 36, 3, '2016-03-18', '', '3'),
(102, 87, 8, '2016-05-08', '23232', '1'),
(103, 87, 8, '2016-05-08', '2323', '3'),
(104, 87, 8, '2016-05-08', '33', '3'),
(105, 87, 8, '2016-05-10', '32 ', '3'),
(108, 87, 8, '2016-05-12', 'wewe', '4'),
(109, 94, 8, '2016-05-12', 'wrrrew', '11'),
(110, 94, 8, '2016-05-13', '11', '11'),
(111, 94, 8, '2016-05-13', '11', '11'),
(112, 87, 8, '2016-05-13', '2323', '2'),
(113, 87, 8, '2016-05-13', '4434', '2'),
(114, 94, 8, '2016-05-13', '3433', '11'),
(115, 94, 8, '2016-05-13', '33', '3'),
(116, 100, 8, '2016-05-13', '344', '434'),
(117, 93, 8, '2016-05-16', 'Test', '2'),
(118, 36, 23, '2016-05-16', '', '6'),
(119, 92, 8, '2016-05-16', 'Gg', '2'),
(120, 92, 8, '2016-05-16', 'Gg', '2'),
(121, 37, 23, '2016-05-16', '', '1'),
(139, 36, 8, '2016-05-19', '1', '1'),
(140, 37, 23, '2016-05-21', '', '1'),
(148, 101, 8, '2016-05-24', 'sasa', '34'),
(150, 36, 23, '2016-05-23', '', '2'),
(151, 86, 25, '2016-05-07', '', '14'),
(152, 86, 25, '2016-05-21', '', '17'),
(153, 106, 25, '2016-05-19', '', '1'),
(154, 106, 25, '2016-05-17', '', '1'),
(155, 106, 25, '2016-05-12', '', '1'),
(156, 106, 25, '2016-05-03', '', '1'),
(157, 108, 25, '2016-05-03', '', '1'),
(158, 108, 25, '2016-05-12', '', '1'),
(159, 108, 25, '2016-05-17', '', '1'),
(160, 108, 25, '2016-05-19', '', '1'),
(162, 108, 25, '2016-05-21', '', '1'),
(163, 86, 25, '2016-05-28', '', '17'),
(164, 86, 25, '2016-06-04', '', '14'),
(165, 106, 25, '2016-06-02', '', '1'),
(166, 108, 25, '2016-06-02', '', '1'),
(167, 86, 30, '2016-06-12', '', '13'),
(168, 86, 30, '2016-06-05', '', '14'),
(169, 106, 30, '2016-06-11', '', '1'),
(170, 108, 30, '2016-06-11', '', '1'),
(171, 86, 33, '2016-05-26', '', '27'),
(172, 109, 33, '2016-05-26', 'Lesson with Lily', '1'),
(173, 110, 33, '2016-05-26', 'Lesson with Claire, ', '1'),
(174, 109, 33, '2016-05-26', 'Lesson with Nyla', '1'),
(176, 86, 33, '2016-05-31', '', '13'),
(177, 109, 33, '2016-05-31', 'Lesson with Averi', '1'),
(178, 86, 33, '2016-06-02', '', '27'),
(179, 109, 33, '2016-05-31', 'Lesson with Aubrie', '1'),
(180, 109, 33, '2016-06-02', 'Lesson with Lily', '1'),
(181, 109, 33, '2016-06-02', 'Lesson with Alexis', '1'),
(182, 86, 33, '2016-06-03', '', '27'),
(183, 106, 33, '2016-06-03', '', '1'),
(184, 108, 33, '2016-06-03', '', '1'),
(185, 86, 33, '2016-06-04', '', '14'),
(187, 109, 33, '2016-06-04', 'Lesson with Averi', '1'),
(188, 109, 33, '2016-06-04', 'Lesson with Nyla', '1'),
(189, 109, 33, '2016-06-04', 'Lesson with Aubrie', '1'),
(190, 86, 33, '2016-06-06', '', '14'),
(191, 86, 33, '2016-06-07', '', '13'),
(192, 109, 33, '2016-06-07', 'Lesson with Lily', '1'),
(193, 86, 33, '2016-06-09', '', '27'),
(194, 109, 33, '2016-06-09', 'Lesson with Alexis', '1'),
(195, 110, 33, '2016-06-09', 'Lesson with Aubrie and Jade', '2'),
(196, 86, 33, '2016-06-10', '', '27'),
(197, 106, 33, '2016-06-10', '', '1'),
(198, 108, 33, '2016-06-10', '', '1'),
(199, 86, 31, '2016-06-18', 'Stalls cleaned', '13'),
(200, 86, 31, '2016-06-19', 'Cleaned stalls', '17'),
(201, 86, 27, '2016-06-15', '', ''),
(202, 105, 34, '2016-06-19', 'no turnout( too hot)', '1'),
(204, 86, 26, '2016-06-05', 'Cleaned 13 Stalls', '13'),
(205, 86, 26, '2016-06-12', 'Cleaned 14 Stalls', '14'),
(206, 105, 35, '2016-06-04', '', '1'),
(207, 106, 35, '2016-06-05', '', '1'),
(208, 105, 35, '2016-06-11', '', '1'),
(209, 106, 35, '2016-06-12', '', '1'),
(210, 105, 35, '2016-06-18', '', '1'),
(211, 106, 35, '2016-06-19', '', '1'),
(213, 109, 33, '2016-06-12', 'Lesson with London', '1'),
(214, 86, 33, '2016-06-13', '', '14'),
(215, 86, 33, '2016-06-14', '', '13'),
(216, 86, 33, '2016-06-16', '', '27'),
(217, 109, 33, '2016-06-16', 'Lesson with Lily', '1'),
(218, 109, 33, '2016-06-16', 'Lesson with Alexis', '1'),
(219, 86, 33, '2016-06-17', '', '27'),
(220, 106, 33, '2016-06-17', '', '1'),
(221, 108, 33, '2016-06-17', '', '1'),
(222, 86, 33, '2016-06-18', '', '5'),
(223, 109, 33, '2016-06-18', 'Lesson with Averi', '1'),
(224, 109, 33, '2016-06-18', 'Lesson with Nyla', '1'),
(225, 86, 33, '2016-06-19', '', '10'),
(226, 108, 35, '2016-06-04', '', '1'),
(227, 108, 35, '2016-06-05', '', '1'),
(228, 108, 35, '2016-06-11', '', '1'),
(229, 108, 35, '2016-06-12', '', '1'),
(230, 108, 35, '2016-06-18', '', '1'),
(231, 108, 35, '2016-06-19', '', '1'),
(238, 106, 25, '2016-06-20', '', '1'),
(239, 108, 25, '2016-06-20', '', '1'),
(240, 106, 25, '2016-06-09', '', '1'),
(241, 108, 25, '2016-06-09', '', '1'),
(242, 122, 4, '2016-06-22', '33', '33'),
(243, 106, 34, '2016-06-22', '', '1'),
(244, 123, 39, '2016-06-24', '', '1'),
(245, 105, 34, '2016-06-26', '', '1'),
(246, 105, 35, '2016-06-25', '', '1'),
(247, 108, 35, '2016-06-25', '', '1'),
(248, 106, 35, '2016-06-26', '', '1'),
(249, 108, 35, '2016-06-27', '', '1'),
(251, 106, 40, '2016-06-21', '', '1'),
(252, 108, 40, '2016-06-21', '', '1'),
(253, 106, 40, '2016-06-23', '', '1'),
(254, 108, 40, '2016-06-23', '', '1'),
(255, 106, 40, '2016-06-06', '', '1'),
(256, 108, 40, '2016-06-06', '', '1'),
(257, 106, 40, '2016-06-07', '', '1'),
(258, 108, 40, '2016-06-07', '', '1'),
(259, 106, 40, '2016-06-13', '', '1'),
(260, 108, 40, '2016-06-13', '', '1'),
(261, 106, 40, '2016-06-14', '', '1'),
(262, 108, 40, '2016-06-14', '', '1'),
(263, 108, 40, '2016-06-16', '', '1'),
(264, 86, 26, '2016-06-26', 'Cleaned 13 Stalls', '13'),
(265, 86, 33, '2016-06-20', '', '13'),
(266, 86, 33, '2016-06-21', '', '13'),
(268, 86, 33, '2016-06-22', '', '27'),
(269, 86, 33, '2016-06-23', '', '27'),
(270, 109, 33, '2016-06-21', 'Lesson with Alexis', '1'),
(271, 109, 33, '2016-06-23', 'Private lesson with Lily', '1'),
(272, 86, 33, '2016-06-24', '', '27'),
(273, 106, 33, '2016-06-24', '', '1'),
(274, 108, 33, '2016-06-24', '', '1'),
(275, 86, 33, '2016-06-25', '', '13'),
(276, 109, 33, '2016-06-28', 'Lesson with Averi', '1'),
(277, 109, 33, '2016-06-25', 'Lesson with Nyla', '1'),
(278, 106, 33, '2016-06-25', 'Fed for Savannah', '1'),
(279, 108, 33, '2016-06-25', '', '1'),
(280, 110, 33, '2016-06-26', 'Lesson with Cheyenne, Bella, Zoe and Caroline', '4'),
(281, 109, 33, '2016-06-26', 'Lesson with London', '1'),
(282, 120, 33, '2016-06-15', 'Held horses for Farrier \r\n\r\nDenton, Finn, Buttercup, Bubba, Gus, Trudy, Lites, Major, Sadie.', '1'),
(283, 119, 33, '2016-06-11', 'Aubrie at Empress Valley Show', '1'),
(285, 106, 40, '2016-06-27', '', '1'),
(286, 108, 40, '2016-06-27', '', '1'),
(287, 106, 25, '2016-06-30', 'Only 10 horses', '1'),
(288, 108, 25, '2016-06-30', 'Only 10 horses', '1'),
(289, 124, 42, '2016-06-30', ' Dreamer, Missy, Blake, Q, Scooby ', '5'),
(290, 105, 35, '2016-07-02', '', '1'),
(291, 108, 35, '2016-07-02', '', '1'),
(292, 124, 42, '2016-07-03', 'Lady, Denton, Scooby, Blade, Missy, Leo, Mac', '7'),
(293, 106, 25, '2016-07-03', '', '1'),
(294, 108, 25, '2016-07-03', '', '1'),
(295, 105, 34, '2016-07-03', '', '1'),
(296, 106, 34, '2016-07-06', '', '1'),
(297, 108, 34, '2016-07-06', '', '1'),
(298, 124, 44, '2016-06-30', 'Maggie\r\nGrim\r\nHolly\r\nLeo\r\nDenton', '5'),
(299, 124, 44, '2016-07-03', 'Maggie\r\nDreamer\r\nHolly\r\nEugene\r\nBlake\r\nKimber', '6'),
(300, 124, 43, '2016-06-30', 'Q \r\nScooby\r\nLady\r\nDreamer \r\nEugene \r\nBlade \r\nRiley\r\nDwayne', '8'),
(301, 124, 43, '2016-07-03', 'Riley\r\nGrimm\r\nQ \r\nDwayne\r\nBuddy', '5'),
(302, 86, 26, '2016-07-10', '', '19'),
(303, 105, 35, '2016-07-09', '', '1'),
(304, 108, 35, '2016-07-09', '', '1'),
(305, 106, 35, '2016-07-10', '', '1'),
(307, 86, 25, '2016-07-09', '', '17'),
(308, 106, 25, '2016-07-12', '', '1'),
(309, 108, 25, '2016-07-12', '', '1'),
(311, 125, 33, '2016-06-27', '', '1'),
(312, 86, 33, '2016-06-27', '', '7'),
(313, 86, 33, '2016-06-28', '', '5'),
(314, 125, 33, '2016-06-28', '', '1'),
(315, 109, 33, '2016-06-28', 'Lesson with Lily', '1'),
(316, 125, 33, '2016-06-29', '', '1'),
(317, 86, 33, '2016-06-30', '', '13'),
(318, 125, 33, '2016-06-30', '', '1'),
(319, 86, 33, '2016-07-01', '', '27'),
(320, 106, 33, '2016-07-01', '', '1'),
(321, 127, 33, '2016-07-02', '', '1'),
(322, 86, 33, '2016-07-04', '', '13'),
(323, 86, 33, '2016-07-05', '', '13'),
(324, 109, 33, '2016-07-05', 'Lesson with Alexis', '1'),
(325, 125, 33, '2016-07-01', '', '1'),
(326, 86, 33, '2016-07-07', '', '27'),
(327, 86, 33, '2016-07-08', '', '27'),
(328, 106, 33, '2016-07-08', '', '1'),
(329, 108, 33, '2016-07-08', '', '1'),
(330, 109, 33, '2016-07-09', 'Lesson with Nyla', '1'),
(331, 109, 33, '2016-07-10', 'Lesson with London', '1'),
(332, 106, 34, '2016-07-13', '', '1'),
(333, 108, 34, '2016-07-13', '', '1'),
(334, 106, 31, '2016-07-14', '', '1'),
(335, 108, 31, '2016-07-14', '', '1'),
(336, 86, 25, '2016-07-16', '', '13'),
(337, 128, 43, '2016-07-16', 'Gus for Mary. My other horse was the one I brought', '1'),
(338, 105, 35, '2016-07-16', '', '1'),
(339, 108, 35, '2016-07-16', '', '1'),
(340, 106, 35, '2016-07-17', '', '1'),
(341, 108, 35, '2016-07-17', '', '1'),
(342, 86, 44, '2016-07-09', 'Minnie\r\nOliver\r\nHolly\r\nBuddy\r\nDwayne\r\nMac\r\nKarma\r\nButtercup\r\nDenton\r\nFinn\r\nGus\r\nBubba', '10'),
(343, 105, 34, '2016-07-17', '', '1'),
(344, 128, 31, '2016-07-18', 'Hauled Denton', '1'),
(345, 86, 31, '2016-07-17', 'Cleaned all stalls in big barn', '19'),
(346, 106, 40, '2016-06-28', '', '1'),
(347, 108, 40, '2016-06-28', '', '1'),
(348, 106, 40, '2016-07-04', '', '1'),
(349, 108, 40, '2016-07-04', '', '1'),
(350, 106, 40, '2016-07-05', '', '1'),
(351, 108, 40, '2016-07-05', '', '1'),
(352, 108, 40, '2016-07-07', '', '1'),
(353, 106, 40, '2016-07-11', '', '1'),
(354, 108, 40, '2016-07-11', '', '1'),
(355, 106, 40, '2016-05-02', '', '1'),
(356, 108, 40, '2016-05-02', '', '1'),
(357, 106, 40, '2016-05-09', '', '1'),
(358, 108, 40, '2016-05-09', '', '1'),
(359, 106, 40, '2016-05-10', '', '1'),
(360, 108, 40, '2016-05-10', '', '1'),
(361, 106, 40, '2016-05-16', '', '1'),
(362, 108, 40, '2016-05-16', '', '1'),
(363, 106, 40, '2016-05-24', '', '1'),
(364, 108, 40, '2016-05-24', '', '1'),
(365, 106, 40, '2016-05-26', '', '1'),
(366, 108, 40, '2016-05-26', '', '1'),
(367, 106, 40, '2016-05-30', '', '1'),
(368, 108, 40, '2016-05-30', '', '1'),
(369, 106, 40, '2016-05-31', '', '1'),
(370, 108, 40, '2016-05-31', '', '1'),
(371, 106, 40, '2016-07-18', '', '1'),
(372, 108, 40, '2016-07-18', '', '1'),
(373, 106, 40, '2016-07-19', '', '1'),
(374, 108, 40, '2016-07-19', '', '1'),
(375, 86, 31, '2016-07-20', '', '13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `avatar` varchar(30) DEFAULT 'noimage.gif',
  `address` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('enable','disable') NOT NULL DEFAULT 'disable',
  `user_type` enum('employer','employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `avatar`, `address`, `created_at`, `status`, `user_type`) VALUES
(2, 'Noah', 'Swad', 'Noah.swad@gmail.com', '123456', 'noimage.gif', NULL, '2016-01-30 21:34:54', 'disable', 'employer'),
(3, 'john', 'worker', 'worker@worker.com', '123456', 'noimage.gif', NULL, '2016-01-30 21:38:54', 'disable', 'employee'),
(4, 'Test1', 'Test', 'test@test.com', '123456', 'noimage.gif', 'C/20,Jakir Hossain Road', '2016-01-31 03:25:52', 'disable', 'employee'),
(14, 'Lee', 'Swad', 'leeswad@yahoo.com', 'test', 'noimage.gif', NULL, '2016-03-10 18:23:24', 'disable', 'employee'),
(15, 'Meghan', 'Swad', 'meghan@fairytalehorsefarm.com', 'orange11', 'noimage.gif', NULL, '2016-03-10 20:04:54', 'disable', 'employer'),
(16, 'Vadim', 'Marina', 'vadim333@gmail.com', 'rootroot123', 'noimage.gif', NULL, '2016-03-18 22:55:29', 'disable', 'employee'),
(18, 'Johnny', 'Holmes', 'delriogal57@gmail.com', 'trinket11', 'noimage.gif', NULL, '2016-04-01 08:59:05', 'disable', 'employee'),
(19, 'Robert', 'Kostoski', 'robert_f-f@hotmail.com', 'asdqwe', 'noimage.gif', NULL, '2016-04-11 16:34:43', 'disable', 'employee'),
(20, 'Roki', 'Kostoski', 'kostoski.r@gmail.com', 'roki123', 'noimage.gif', NULL, '2016-04-11 16:35:32', 'disable', 'employee'),
(22, 'AA1', 'AA', 'amirrucst@gmail.com', '123456', 'noimage.gif', NULL, '2016-05-07 11:02:46', 'disable', 'employer'),
(23, 'John', 'Smith', 'John@john.com', '123456', 'noimage.gif', NULL, '2016-05-10 19:46:36', 'disable', 'employee'),
(25, 'kaitlin', 'young', 'kaitlin.e.johnson@gmail.com', 'horse', 'noimage.gif', NULL, '2016-05-22 17:23:19', 'disable', 'employee'),
(26, 'Eve', 'Reynolds', 'eveabreyno@gmail.com', 'Super713', 'noimage.gif', NULL, '2016-06-09 18:45:19', 'disable', 'employee'),
(27, 'Savannah', 'Keen', 'SavannahB112@yahoo.com', 'Sophie2011', 'noimage.gif', NULL, '2016-06-09 18:48:16', 'disable', 'employee'),
(30, 'anna', 'kohler', '20akohler@northridgevikings.org', 'horse1', 'noimage.gif', '', '2016-06-12 17:29:42', 'disable', 'employee'),
(31, 'Kaitlyn', 'Vorbroker', 'kaity.vorbroker@otterbein.edu', 'WilliamTell2012', 'noimage.gif', NULL, '2016-06-15 01:12:52', 'disable', 'employee'),
(33, 'kayla', 'williams', 'kayla.williams64@gmail.com', 'buba15', 'noimage.gif', NULL, '2016-06-15 01:18:09', 'disable', 'employee'),
(34, 'Maya', 'Tipton', 'mr4girls@outlook.com', 'Keystonebay1', 'noimage.gif', NULL, '2016-06-17 18:35:44', 'disable', 'employee'),
(35, 'Courtney', 'Padrutt', 'cpadrutt727@yahoo.com', 'Major2007', 'noimage.gif', NULL, '2016-06-20 01:06:29', 'disable', 'employee'),
(36, 'Manager', '', 'Manager@fairytalehorsefarm.com', 'orange11', 'noimage.gif', NULL, '2016-06-21 15:06:02', 'disable', 'employee'),
(37, 'Misael', 'ESPINOZA', 'preciseelitebuilders@gmail.com', 'sugoi123', 'noimage.gif', NULL, '2016-06-24 08:07:31', 'disable', 'employer'),
(38, 'Jonetta', 'Moyo', 'Jonetta@jonettamoyo.com', 'seekingandknowing2016', 'noimage.gif', NULL, '2016-06-25 00:34:08', 'disable', 'employer'),
(39, 'Caleb', 'Moyo', 'caleb.b.moyo@gmail.com', 'ther3mix', 'noimage.gif', NULL, '2016-06-25 00:51:33', 'disable', 'employee'),
(40, 'Jill', 'Frost', 'jfrost@glasfloss.com', 'frosty12774', 'noimage.gif', NULL, '2016-06-27 14:05:21', 'disable', 'employee'),
(41, 'Noah', 'Swad', 'Noah@fairytalehorsefarm.com', '455ttg', 'noimage.gif', NULL, '2016-07-01 02:42:11', 'disable', 'employer'),
(42, 'Benjamin', 'Young', 'ffemtyoung@yahoo.com', 'Fordf350!', 'noimage.gif', NULL, '2016-07-02 00:24:02', 'disable', 'employee'),
(43, 'Joshua', 'Branch', 'branch.joshua@gmail.com', 'SIH86r90_', 'noimage.gif', NULL, '2016-07-04 01:57:12', 'disable', 'employee'),
(44, 'Georgia', 'Hellinger', 'treasurer@horsesandhounds.org', 'aLbert026!', 'noimage.gif', NULL, '2016-07-07 14:26:20', 'disable', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_register`
--
ALTER TABLE `company_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_key`
--
ALTER TABLE `payment_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_type`
--
ALTER TABLE `subscription_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_performed`
--
ALTER TABLE `task_performed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `company_register`
--
ALTER TABLE `company_register`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `payment_key`
--
ALTER TABLE `payment_key`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `subscription_type`
--
ALTER TABLE `subscription_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `task_performed`
--
ALTER TABLE `task_performed`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
