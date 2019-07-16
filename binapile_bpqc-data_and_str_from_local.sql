-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2019 at 02:33 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binapile_bpqc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cementintake`
--

CREATE TABLE `cementintake` (
  `id` int(11) NOT NULL,
  `display_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `silo1` decimal(7,2) NOT NULL DEFAULT '0.00',
  `silo2` decimal(7,2) NOT NULL DEFAULT '0.00',
  `silo3` decimal(7,2) NOT NULL DEFAULT '0.00',
  `summary_status` enum('submitted','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `plant_id` int(11) NOT NULL,
  `is_holiday` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cementintake`
--

INSERT INTO `cementintake` (`id`, `display_date`, `date_created`, `silo1`, `silo2`, `silo3`, `summary_status`, `plant_id`, `is_holiday`) VALUES
(1, '2019-07-13', '2019-07-15 07:33:33', '55.00', '55.00', '55.00', 'pending', 7, 0),
(2, '2019-07-15', '2019-07-15 07:46:45', '2000.00', '100.00', '100.00', 'pending', 7, 0),
(3, '2019-07-11', '2019-07-15 10:17:18', '0.00', '0.00', '0.00', 'pending', 7, 0),
(4, '2019-07-12', '2019-07-15 10:21:38', '0.00', '49860.00', '0.00', 'pending', 7, 0),
(6, '2019-07-01', '2019-07-15 11:37:34', '0.00', '5.00', '0.00', 'pending', 7, 1),
(8, '2019-07-06', '2019-07-15 11:50:45', '0.00', '0.00', '0.00', 'pending', 7, 1),
(9, '2019-07-05', '2019-07-15 13:18:33', '50.00', '50.00', '50.00', 'pending', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Driver',
  `remark` text COLLATE utf8_unicode_ci COMMENT 'Remark',
  `employee_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `remark`, `employee_id`) VALUES
(1, 'RAMLIE', '', ''),
(2, 'AH HOCK', '', ''),
(3, 'AH LAM', '', ''),
(4, 'AH BAO', '', ''),
(5, 'ABDEL', '', ''),
(9999, '----------', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `charac_strength28` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cement_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `specified_slump` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `coarse_agg_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fine_agg_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admixture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mix_design_for_cal` decimal(7,2) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rate_prefix` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'RM',
  `rate_number` decimal(7,2) NOT NULL DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `description`, `rate_prefix`, `rate_number`, `deleted`) VALUES
(0, '--------------------', NULL, 'RM', '0.00', 0),
(1, 'KOTA WARISAN', '', 'RM', '18.00', 0),
(2, 'NILAI', '', 'RM', '20.00', 0),
(3, 'CYBERJAYA', '', 'RM', '20.00', 0),
(4, 'PUTRAJAYA', '', 'RM', '22.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materialaudit`
--

CREATE TABLE `materialaudit` (
  `id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `volume` decimal(7,2) NOT NULL DEFAULT '0.00',
  `material_need` decimal(7,2) NOT NULL DEFAULT '0.00',
  `actual_use` decimal(7,2) NOT NULL DEFAULT '0.00',
  `difference_kg` decimal(7,2) NOT NULL DEFAULT '0.00',
  `difference_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `date_calculated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display_date` date NOT NULL,
  `is_holiday` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materialaudit`
--

INSERT INTO `materialaudit` (`id`, `plant_id`, `volume`, `material_need`, `actual_use`, `difference_kg`, `difference_percent`, `date_calculated`, `display_date`, `is_holiday`) VALUES
(1, 7, '109.00', '37710.00', '27972.00', '-9738.00', '-25.82', '2019-07-15 10:54:58', '2019-07-12', 0),
(2, 7, '11.00', '2970.00', '-2000.00', '-4970.00', '-167.34', '2019-07-15 11:02:07', '2019-07-15', 0),
(3, 7, '2.00', '720.00', '-5850.00', '-6570.00', '-912.50', '2019-07-15 13:18:33', '2019-07-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materialending`
--

CREATE TABLE `materialending` (
  `id` int(11) NOT NULL,
  `display_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `silo1` decimal(7,2) NOT NULL DEFAULT '0.00',
  `silo2` decimal(7,2) NOT NULL DEFAULT '0.00',
  `silo3` decimal(7,2) NOT NULL DEFAULT '0.00',
  `summary_status` enum('submitted','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `plant_id` int(11) NOT NULL,
  `is_holiday` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materialending`
--

INSERT INTO `materialending` (`id`, `display_date`, `date_created`, `silo1`, `silo2`, `silo3`, `summary_status`, `plant_id`, `is_holiday`) VALUES
(1, '2019-07-15', '2019-07-15 07:16:03', '2000.00', '2000.00', '2000.00', 'pending', 7, 0),
(4, '2019-07-13', '2019-07-15 07:20:41', '600.00', '600.00', '600.00', 'pending', 7, 0),
(5, '2019-07-11', '2019-07-15 10:17:18', '37359.00', '29593.00', '0.00', 'pending', 7, 0),
(6, '2019-07-12', '2019-07-15 10:21:38', '37359.00', '51481.00', '0.00', 'pending', 7, 0),
(8, '2019-07-01', '2019-07-15 11:37:34', '0.00', '0.00', '0.00', 'pending', 7, 1),
(10, '2019-07-06', '2019-07-15 11:50:45', '0.00', '0.00', '0.00', 'pending', 7, 1),
(11, '2019-07-05', '2019-07-15 13:18:33', '1000.00', '2000.00', '3000.00', 'pending', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL COMMENT 'Name',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` enum('ADMIN','USER') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER',
  `user_id` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Inactive` tinyint(1) NOT NULL DEFAULT '0',
  `last_accessed` datetime DEFAULT CURRENT_TIMESTAMP,
  `plant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `Name`, `date_created`, `Status`, `user_id`, `Username`, `Password`, `Inactive`, `last_accessed`, `plant_id`) VALUES
(1, 'Admin', '2019-06-11 09:28:13', 'ADMIN', 1, 'admin', 'bpadmin1234', 0, '2019-06-11 09:38:50', 0),
(2, 'User', '2019-07-05 03:58:25', 'USER', 2, 'user', 'bpuser1234', 0, '2019-07-05 03:58:25', 1),
(3, 'SEPANG', '2019-07-05 04:31:19', 'USER', 16, 'SEPANG', 'BPSEPANG', 0, '2019-07-05 04:31:19', 4),
(4, 'CHERAS', '2019-07-05 04:35:32', 'USER', 17, 'CHERAS', 'CHERAS11', 0, '2019-07-05 04:35:32', 6),
(5, 'HENG', '2019-07-05 04:38:19', 'ADMIN', 18, 'HENG', 'BINAPILE11', 0, '2019-07-05 04:38:19', 0),
(6, 'JERAM', '2019-07-05 04:48:12', 'USER', 19, 'JERAMHQ', 'BP9999', 0, '2019-07-05 04:48:12', 1),
(7, 'IJOK', '2019-07-05 04:49:25', 'USER', 20, 'IJOK', 'BPIJOK123', 0, '2019-07-05 04:49:25', 3),
(8, 'BG DATOH', '2019-07-05 04:51:06', 'USER', 21, 'BGDATOH', 'BP9999', 0, '2019-07-05 04:51:06', 5),
(9, 'KLANG USER', '2019-07-05 04:52:01', 'USER', 22, 'KLANG', 'PLANT8', 0, '2019-07-05 04:52:01', 7),
(10, 'HQ ADMIN', '2019-07-05 04:53:03', 'ADMIN', 23, 'HQADMIN', 'BPHQADMIN', 0, '2019-07-05 04:53:03', 0),
(11, 'KAJANG ADMIN', '2019-07-12 23:43:07', 'USER', 24, 'KAJANG', '19KAJANG', 0, '2019-07-12 23:43:07', 9);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `location_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revision`
--

CREATE TABLE `revision` (
  `id` int(11) NOT NULL,
  `batch_no` int(8) UNSIGNED ZEROFILL NOT NULL,
  `delivery_order_no` int(8) UNSIGNED ZEROFILL NOT NULL,
  `m3` decimal(5,2) DEFAULT '0.00',
  `summary_status` enum('history') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'history',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plant_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `special_condition` enum('double trip','cancelled','trial mix','rejected') COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `truck_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `display_date` date NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `revision`
--

INSERT INTO `revision` (`id`, `batch_no`, `delivery_order_no`, `m3`, `summary_status`, `date_created`, `plant_id`, `customer_id`, `grade_id`, `special_condition`, `remark`, `deleted`, `truck_id`, `driver_id`, `display_date`, `project_id`) VALUES
(118, 00006461, 00002457, '2.00', 'history', '2019-07-15 14:00:02', 7, 3, 5, '', '', 0, 5, 5, '2019-07-13', 58),
(119, 00006462, 00002458, '6.00', 'history', '2019-07-15 14:00:02', 7, 3, 2, '', '', 0, 5, 5, '2019-07-13', 64),
(331, 00006428, 00002424, '8.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 1, 1, '2019-07-12', 34),
(332, 00006429, 00002425, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 2, 2, '2019-07-12', 34),
(333, 00006431, 00002427, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 4, 4, '2019-07-12', 34),
(334, 00006432, 00002428, '3.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 4, 4, '2019-07-12', 34),
(335, 00006433, 00002429, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 5, 5, '2019-07-12', 34),
(336, 00006434, 00002430, '0.00', 'history', '2019-07-15 15:54:53', 7, 9999, 9999, 'cancelled', 'PRINT D.O. SALAH', 0, 9999, 9999, '2019-07-12', 9999),
(337, 00006435, 00002431, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 1, 1, '2019-07-12', 34),
(338, 00006437, 00002433, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 2, 2, '2019-07-12', 34),
(339, 00006438, 00002434, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 6, '', '', 0, 3, 3, '2019-07-12', 34),
(340, 00006439, 00002435, '6.00', 'history', '2019-07-15 15:54:53', 7, 27, 5, '', '', 0, 4, 4, '2019-07-12', 34),
(341, 00006441, 00002437, '6.00', 'history', '2019-07-15 15:54:54', 7, 27, 5, '', '', 0, 1, 1, '2019-07-12', 34),
(342, 00006442, 00002438, '2.00', 'history', '2019-07-15 15:54:54', 7, 27, 5, '', '', 0, 1, 1, '2019-07-12', 34),
(343, 00006443, 00002439, '6.00', 'history', '2019-07-15 15:54:54', 7, 44, 3, '', '', 0, 2, 2, '2019-07-12', 58),
(344, 00006444, 00002440, '0.00', 'history', '2019-07-15 15:54:54', 7, 9999, 9999, 'cancelled', 'PRINT D.O. SALAH', 0, 9999, 9999, '2019-07-12', 9999),
(345, 00006445, 00002441, '5.00', 'history', '2019-07-15 15:54:54', 7, 41, 5, '', 'RETARDER ADDED FOR 3 HOUR\'S', 0, 3, 3, '2019-07-12', 45),
(346, 00006446, 00002442, '6.00', 'history', '2019-07-15 15:54:54', 7, 44, 3, '', '', 0, 1, 1, '2019-07-12', 58),
(347, 00006447, 00002443, '2.00', 'history', '2019-07-15 15:54:54', 7, 44, 3, '', '', 0, 1, 1, '2019-07-12', 58),
(348, 00006448, 00002444, '6.00', 'history', '2019-07-15 15:54:54', 7, 8, 8, '', '', 0, 4, 4, '2019-07-12', 64),
(349, 00006449, 00002445, '3.00', 'history', '2019-07-15 15:54:54', 7, 8, 8, '', '', 0, 4, 4, '2019-07-12', 64),
(350, 00006450, 00002446, '3.00', 'history', '2019-07-15 15:54:54', 7, 44, 3, '', '', 0, 2, 2, '2019-07-12', 58),
(351, 00006451, 00002447, '6.00', 'history', '2019-07-15 15:54:54', 7, 8, 8, '', '', 0, 1, 1, '2019-07-12', 64),
(352, 00006452, 00002448, '6.00', 'history', '2019-07-15 15:54:54', 7, 65, 5, '', '', 0, 2, 2, '2019-07-12', 58),
(353, 00006453, 00002449, '5.00', 'history', '2019-07-15 15:54:54', 7, 41, 5, '', 'RETARDER ADDED FOR 3 HOUR\'S', 0, 3, 3, '2019-07-12', 45),
(356, 00006463, 00002459, '6.00', 'history', '2019-07-15 16:02:44', 7, 3, 3, '', '', 0, 4, 4, '2019-07-15', 2),
(357, 00006464, 00002460, '5.00', 'history', '2019-07-15 16:02:44', 7, 3, 3, '', '', 0, 5, 4, '2019-07-15', 58);

-- --------------------------------------------------------

--
-- Table structure for table `salerecord`
--

CREATE TABLE `salerecord` (
  `id` int(11) NOT NULL,
  `batch_no` int(8) UNSIGNED ZEROFILL NOT NULL,
  `delivery_order_no` int(8) UNSIGNED ZEROFILL NOT NULL,
  `m3` decimal(5,2) DEFAULT '0.00',
  `summary_status` enum('submitted','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plant_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `special_condition` enum('double trip','cancelled','trial mix','rejected') COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `truck_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `display_date` date NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salerecord`
--

INSERT INTO `salerecord` (`id`, `batch_no`, `delivery_order_no`, `m3`, `summary_status`, `date_created`, `plant_id`, `customer_id`, `grade_id`, `special_condition`, `remark`, `deleted`, `truck_id`, `driver_id`, `display_date`, `project_id`) VALUES
(1, 00006428, 00002424, '8.00', 'submitted', '2019-07-09 10:00:00', 7, 27, 6, '', '', 0, 1, 1, '2019-07-12', 34),
(2, 00006429, 00002425, '6.00', 'submitted', '2019-07-09 10:57:42', 7, 27, 6, '', '', 0, 2, 2, '2019-07-12', 34),
(3, 00006430, 00002426, '6.00', 'pending', '2019-07-09 11:06:14', 7, 27, 6, '', '', 0, 3, 3, '2019-07-04', 34),
(4, 00006431, 00002427, '6.00', 'submitted', '2019-07-09 11:12:03', 7, 27, 6, '', '', 0, 4, 4, '2019-07-12', 34),
(5, 00006432, 00002428, '3.00', 'submitted', '2019-07-09 11:14:43', 7, 27, 6, '', '', 0, 4, 4, '2019-07-12', 34),
(6, 00006433, 00002429, '6.00', 'submitted', '2019-07-09 12:12:28', 7, 27, 6, '', '', 0, 5, 5, '2019-07-12', 34),
(7, 00006434, 00002430, '0.00', 'submitted', '2019-07-09 21:27:25', 7, 9999, 9999, 'cancelled', 'PRINT D.O. SALAH', 0, 9999, 9999, '2019-07-12', 9999),
(8, 00006435, 00002431, '6.00', 'submitted', '2019-07-09 16:07:02', 7, 27, 6, '', '', 0, 1, 1, '2019-07-12', 34),
(9, 00006436, 00002432, '2.00', 'submitted', '2019-07-09 16:12:20', 7, 27, 6, '', '', 0, 1, 1, '2019-07-05', 34),
(10, 00006437, 00002433, '6.00', 'submitted', '2019-07-09 16:16:11', 7, 27, 6, '', '', 0, 2, 2, '2019-07-12', 34),
(11, 00006438, 00002434, '6.00', 'submitted', '2019-07-09 16:18:14', 7, 27, 6, '', '', 0, 3, 3, '2019-07-12', 34),
(12, 00006439, 00002435, '6.00', 'submitted', '2019-07-09 16:20:06', 7, 27, 5, '', '', 0, 4, 4, '2019-07-12', 34),
(13, 00006440, 00002436, '3.00', 'pending', '2019-07-09 16:24:35', 7, 27, 5, '', '', 0, 4, 4, '2019-06-28', 34),
(14, 00006441, 00002437, '6.00', 'submitted', '2019-07-09 16:27:11', 7, 27, 5, '', '', 0, 1, 1, '2019-07-12', 34),
(15, 00006442, 00002438, '2.00', 'submitted', '2019-07-09 16:28:44', 7, 27, 5, '', '', 0, 1, 1, '2019-07-12', 34),
(16, 00006443, 00002439, '6.00', 'submitted', '2019-07-09 16:31:18', 7, 44, 3, '', '', 0, 2, 2, '2019-07-12', 58),
(17, 00006444, 00002440, '0.00', 'submitted', '2019-07-09 21:29:01', 7, 9999, 9999, 'cancelled', 'PRINT D.O. SALAH', 0, 9999, 9999, '2019-07-12', 9999),
(18, 00006445, 00002441, '5.00', 'submitted', '2019-07-09 16:35:10', 7, 41, 5, '', 'RETARDER ADDED FOR 3 HOUR\'S', 0, 3, 3, '2019-07-12', 45),
(19, 00006446, 00002442, '6.00', 'submitted', '2019-07-09 16:37:23', 7, 44, 3, '', '', 0, 1, 1, '2019-07-12', 58),
(20, 00006447, 00002443, '2.00', 'submitted', '2019-07-09 16:39:21', 7, 44, 3, '', '', 0, 1, 1, '2019-07-12', 58),
(21, 00006448, 00002444, '6.00', 'submitted', '2019-07-09 00:00:00', 7, 8, 8, '', '', 0, 4, 4, '2019-07-12', 64),
(22, 00006449, 00002445, '3.00', 'submitted', '2019-07-09 16:56:58', 7, 8, 8, '', '', 0, 4, 4, '2019-07-12', 64),
(23, 00006450, 00002446, '3.00', 'submitted', '2019-07-09 16:58:23', 7, 44, 3, '', '', 0, 2, 2, '2019-07-12', 58),
(24, 00006451, 00002447, '6.00', 'submitted', '2019-07-09 17:00:19', 7, 8, 8, '', '', 0, 1, 1, '2019-07-12', 64),
(25, 00006452, 00002448, '6.00', 'submitted', '2019-07-09 17:07:33', 7, 65, 5, '', '', 0, 2, 2, '2019-07-12', 58),
(26, 00006453, 00002449, '5.00', 'submitted', '2019-07-09 17:10:00', 7, 41, 5, '', 'RETARDER ADDED FOR 3 HOUR\'S', 0, 3, 3, '2019-07-12', 45),
(27, 00006454, 00002450, '5.00', 'pending', '2019-07-09 11:33:02', 1, 65, 5, '', '', 0, 5, 5, '2019-07-12', 58),
(28, 00006455, 00002451, '5.00', 'pending', '2019-07-12 00:28:43', 3, 3, 2, '', '', 0, 5, 5, '2019-07-12', 58),
(29, 00006456, 00002452, '6.00', 'pending', '2019-07-12 01:11:30', 3, 3, 2, '', '', 0, 5, 5, '2019-07-12', 58),
(30, 00006457, 00002453, NULL, 'pending', '2019-07-12 01:21:14', 3, 9999, 9999, 'cancelled', 'Test remark', 0, 9999, 9999, '2019-07-12', 9999),
(31, 00006458, 00002454, '5.00', 'pending', '2019-07-12 01:22:44', 3, 3, 2, '', '', 0, 4, 4, '2019-07-12', 58),
(32, 00006459, 00002455, '7.00', 'pending', '2019-07-12 01:23:27', 3, 3, 2, '', '', 0, 1, 4, '2019-07-12', 84),
(33, 00006460, 00002456, '6.00', 'pending', '2019-07-12 10:14:21', 3, 3, 5, 'trial mix', '', 0, 2, 4, '2019-07-12', 61),
(34, 00006461, 00002457, '2.00', 'pending', '2019-07-13 22:59:47', 7, 3, 5, '', '', 0, 5, 5, '2019-07-13', 58),
(37, 00006463, 00002459, '6.00', 'pending', '2019-07-15 10:11:29', 7, 3, 3, '', '', 0, 4, 4, '2019-07-15', 2),
(39, 00006464, 00002460, '5.00', 'pending', '2019-07-15 15:58:10', 7, 3, 3, '', '', 0, 5, 4, '2019-07-15', 58),
(40, 00006465, 00002461, '6.00', 'pending', '2019-07-15 18:18:55', 0, 63, 2, '', '', 0, 5, 5, '2019-07-08', 58);

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE `truck` (
  `id` int(11) NOT NULL,
  `truck_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`id`, `truck_no`, `remark`) VALUES
(1, 'BPC 3999', ''),
(2, 'WDM 6049', ''),
(3, 'JEK 2769', ''),
(4, 'BMG 7399', ''),
(5, 'BGV 7199', ''),
(9999, '----------', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `truckexpense`
--

CREATE TABLE `truckexpense` (
  `id` int(11) NOT NULL,
  `date_reported` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expenditure` decimal(10,2) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `truck_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` smallint(6) DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '103N2ap-SSBe3siQVVovQmHXaH6ia25G', '$2y$13$3XComH/fQmlycBUZEn6Z8uTs/wXVmToRdOEagyhDAwxzZO4Re6uw2', NULL, 'admin@dss.binapile.com', 10, 9, 1560218314, 1560218314),
(2, 'user', 'y3C18bNiC4sLzEz1Il2_KIi9_Bw1NcPU', '$2y$13$mohhNfcwAPIRUbt6ona3IOztppan8FFJHvKsl9VvgQO/hFKAHNMum', NULL, 'ganis.dyp@gmail.com', 10, 1, 1562273799, 1562273799),
(16, 'SEPANG', '-58RYr8b3GJ7WVec3-8QQy_-Q4wCF8VZ', '$2y$13$D/PluT4TIEDh69da57sFWe/GT3CZ4T7lVR1mRSFGb3/IDCERsg8gS', NULL, 'sepang@dss.binapile.com', 10, 1, 1562275879, 1562275879),
(17, 'CHERAS', '0xTIwHBjm4sxFow7u279FwyNQ305tsrJ', '$2y$13$UNJszzR0pO.pixOSw2VE6uiS.X8s1/7A8aeJ0y1ho2ydqkoq.pcQa', NULL, 'cheras@dss.binapile.com', 10, 1, 1562276132, 1562276132),
(18, 'HENG', 'Spw3foyOLqLjIu94YoRlMrZUTxREIXaf', '$2y$13$cdlFUoY/6BSRDk0XOV3ULuPsrZ8yog8TVlRIJflLHHD2OnEcALuqO', NULL, 'heng@dss.binapile.com', 10, 9, 1562276299, 1562276299),
(19, 'JERAMHQ', 'zR3tWJcCGuS1Ny6-tlBQfDXSvnqJmdui', '$2y$13$MxTHOKtxaOW7z/MHi46Ne.BJ/5E8OGoLN0inCyCS0uV2uNVOpSSsm', NULL, 'jaramhq@dss.binapile.com', 10, 1, 1562276892, 1562276892),
(20, 'IJOK', 'ywnQmUeFO2Z2NuOOQUfaCrVtWqLp1BnG', '$2y$13$cQ8BfJC4/Mgtbqf9pSK4cuIS1OuyX6Iq9LhePPummirU.gos3z7QG', NULL, 'ijok@dss.binapile.com', 10, 1, 1562276965, 1562276965),
(21, 'BGDATOH', 'iYPKLBuLg9QZfisGkK9dI8eiSC2htAcP', '$2y$13$WHJZZd0q.58lyHuUxWLy5eCNq213utwdzk2otJM70oVH9QLP6X9/K', NULL, 'bgdatoh@dss.binapile.com', 10, 1, 1562277066, 1562277066),
(22, 'KLANG', 'cU_ZpzFFql_PfSvZdmzt7L9obVazm9KB', '$2y$13$h26L7lnSxwkK.Bdn4ObiC.gtWYdGEKSXh9Zly9eA2kvSzVKN2HG/i', NULL, 'klang@dss.binapile.com', 10, 1, 1562277121, 1562277121),
(23, 'HQADMIN', 'PoDvolavmoHupEweB8PAKE29nyQkz1a-', '$2y$13$xHQ2YrDRjIGhb9HYxobVXO.4hGrDsIaIpmgqM.oUjZ7EyL.UzOuLO', NULL, 'hqadmin@dss.binapile.com', 10, 5, 1562277183, 1562277183),
(24, 'KAJANG', 'KtrmmZ_ipQ3iiNW4n2_AhsKQJTeKmBnl', '$2y$13$9QGw3tTZcScsTvgVfrELzOz6OQpfymrNEE0Y5KWan/ouCTOzdF7Fm', NULL, 'kajang@dss.binapile.com', 10, 1, 1562949787, 1562949787);

-- --------------------------------------------------------

--
-- Table structure for table `user_bpqc`
--

CREATE TABLE `user_bpqc` (
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `Username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Password` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `Status` enum('ADMIN','USER') CHARACTER SET latin1 NOT NULL DEFAULT 'USER',
  `Inactive` tinyint(1) NOT NULL DEFAULT '0',
  `last_accessed` datetime DEFAULT CURRENT_TIMESTAMP,
  `plant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_bpqc`
--

INSERT INTO `user_bpqc` (`date_created`, `UserID`, `Username`, `Password`, `Name`, `Status`, `Inactive`, `last_accessed`, `plant`) VALUES
('2016-11-12 20:31:51', 0001, 'admin', 'bpadmin1234', 'Admin', 'ADMIN', 0, '2017-01-10 18:01:18', 0),
('2016-11-12 20:31:51', 0002, 'user', 'bpuser1234', 'User', 'USER', 0, '2016-12-19 21:44:05', 1),
('2016-12-19 10:41:33', 0017, 'SEPANG', 'BPSEPANG', 'SEPANG ', 'USER', 0, '2019-05-31 06:54:29', 4),
('2016-12-19 10:46:22', 0018, 'CHERAS', 'CHERAS11', 'CHERAS', 'USER', 0, '2016-12-31 15:13:35', 6),
('2016-12-19 10:47:03', 0019, 'HENG', 'BINAPILE11', 'HENG', 'ADMIN', 0, '2019-05-24 13:31:06', 0),
('2016-12-19 10:49:57', 0020, 'JERAMHQ', 'BP9999', 'JERAM', 'USER', 0, '2018-07-24 01:44:24', 1),
('2016-12-19 10:52:16', 0021, 'IJOK', 'BPIJOK123', 'IJOK', 'USER', 0, '2016-12-19 10:52:16', 3),
('2016-12-19 10:55:49', 0023, 'BGDATOH', 'BP9999', 'BG DATOH', 'USER', 0, '2016-12-19 10:55:49', 5),
('2018-07-27 09:14:49', 0024, 'KLANG', 'PLANT8', 'KLANG', 'USER', 0, '2019-06-10 06:46:43', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cementintake`
--
ALTER TABLE `cementintake`
  ADD PRIMARY KEY (`id`,`plant_id`) USING BTREE,
  ADD UNIQUE KEY `display_date_plant_id` (`display_date`,`plant_id`) USING BTREE,
  ADD KEY `fk_cementintake_plant1_idx` (`plant_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialaudit`
--
ALTER TABLE `materialaudit`
  ADD PRIMARY KEY (`id`,`plant_id`) USING BTREE,
  ADD UNIQUE KEY `display_date_plant_id` (`plant_id`,`display_date`) USING BTREE,
  ADD KEY `fk_materialaudit_plant1_idx` (`plant_id`) USING BTREE;

--
-- Indexes for table `materialending`
--
ALTER TABLE `materialending`
  ADD PRIMARY KEY (`id`,`plant_id`) USING BTREE,
  ADD UNIQUE KEY `display_date_plant_id` (`display_date`,`plant_id`) USING BTREE,
  ADD KEY `fk_materialending_plant1_idx` (`plant_id`) USING BTREE;

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`,`user_id`,`plant_id`) USING BTREE,
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `fk_profile_user_idx` (`user_id`),
  ADD KEY `fk_profile_plant1_idx` (`plant_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project_location1_idx` (`location_id`);

--
-- Indexes for table `revision`
--
ALTER TABLE `revision`
  ADD PRIMARY KEY (`id`,`plant_id`,`customer_id`,`grade_id`),
  ADD KEY `fk_salerecord_plant1_idx` (`plant_id`),
  ADD KEY `fk_salerecord_customer1_idx` (`customer_id`),
  ADD KEY `fk_salerecord_grade1_idx` (`grade_id`),
  ADD KEY `fk_salerecord_truck1_idx` (`truck_id`),
  ADD KEY `fk_salerecord_driver1_idx` (`driver_id`),
  ADD KEY `fk_salerecord_project1_idx` (`project_id`);

--
-- Indexes for table `salerecord`
--
ALTER TABLE `salerecord`
  ADD PRIMARY KEY (`id`,`plant_id`,`customer_id`,`grade_id`),
  ADD KEY `fk_salerecord_plant1_idx` (`plant_id`),
  ADD KEY `fk_salerecord_customer1_idx` (`customer_id`),
  ADD KEY `fk_salerecord_grade1_idx` (`grade_id`),
  ADD KEY `fk_salerecord_truck1_idx` (`truck_id`),
  ADD KEY `fk_salerecord_driver1_idx` (`driver_id`),
  ADD KEY `fk_salerecord_project1_idx` (`project_id`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truckexpense`
--
ALTER TABLE `truckexpense`
  ADD PRIMARY KEY (`id`,`truck_id`),
  ADD KEY `fk_truckexpense_truck1_idx` (`truck_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_bpqc`
--
ALTER TABLE `user_bpqc`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cementintake`
--
ALTER TABLE `cementintake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materialaudit`
--
ALTER TABLE `materialaudit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materialending`
--
ALTER TABLE `materialending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revision`
--
ALTER TABLE `revision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `salerecord`
--
ALTER TABLE `salerecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `truck`
--
ALTER TABLE `truck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT for table `truckexpense`
--
ALTER TABLE `truckexpense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_bpqc`
--
ALTER TABLE `user_bpqc`
  MODIFY `UserID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_plant1` FOREIGN KEY (`plant_id`) REFERENCES `plant` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `truckexpense`
--
ALTER TABLE `truckexpense`
  ADD CONSTRAINT `fk_truckexpense_truck1` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
