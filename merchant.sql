-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2020 at 01:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merchant`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `cupon_code` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` float NOT NULL,
  `us_tax` float NOT NULL,
  `shipping_cost` float NOT NULL,
  `first_exchange_rate` float NOT NULL,
  `commission` float NOT NULL,
  `product_weight` float NOT NULL,
  `weight_cost` float NOT NULL,
  `mm_tax` float NOT NULL,
  `second_exchange_rate` float NOT NULL,
  `is_deliver` tinyint(1) NOT NULL,
  `delivery_fee` float NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `has_viewed_admin` tinyint(1) NOT NULL,
  `has_viewed_customer` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `customer_id`, `product_link`, `remark`, `cupon_code`, `quantity`, `price`, `us_tax`, `shipping_cost`, `first_exchange_rate`, `commission`, `product_weight`, `weight_cost`, `mm_tax`, `second_exchange_rate`, `is_deliver`, `delivery_fee`, `order_status`, `has_viewed_admin`, `has_viewed_customer`, `created_date`) VALUES
(1, 2, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark', '98IHIEKHIEN', 2, 500, 20, 20, 1500, 0, 0, 0, 0, 0, 0, 0, 3, 1, 0, '2020-06-18 16:32:52'),
(2, 3, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'SS98IHIEKHIEN', 3, 400, 100, 100, 1500, 9, 2, 5, 0, 0, 0, 1000, 2, 1, 0, '2020-06-18 16:32:52'),
(3, 4, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWEEWHIEN', 2, 300, 100, 100, 1500, 10, 5, 2, 5, 0, 0, 0, 3, 1, 0, '2020-06-18 16:32:52'),
(4, 5, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWERRTRHIEN', 3, 300, 100, 100, 1500, 5, 0, 0, 10, 0, 0, 9000, 3, 1, 0, '2020-06-18 16:32:52'),
(5, 6, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWERRTRHIEN', 3, 300, 100, 100, 1500, 8, 3, 5, 0, 1505, 0, 0, 4, 1, 0, '2020-06-18 16:32:52'),
(6, 7, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWERRTRHIEN', 3, 300, 100, 100, 1500, 0, 0, 0, 0, 0, 0, 0, 3, 1, 0, '2020-06-18 16:32:52'),
(7, 8, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWERRTRHIEN', 3, 50, 100, 100, 1500, 10, 10, 10, 0, 1505, 0, 0, 4, 1, 0, '2020-06-18 16:32:52'),
(8, 9, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWERRTRHIEN', 2, 500, 100, 100, 1500, 10, 5, 2, 0, 1505, 0, 0, 4, 1, 0, '2020-06-18 16:32:52'),
(9, 10, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.3eb34174G8Pc45&id=605150240460', 'some remark, many remark, pretty much remark, more remark', 'TWERRTRHIEN', 3, 350, 100, 100, 1500, 0, 0, 0, 0, 0, 0, 0, 3, 1, 0, '2020-06-18 16:32:52'),
(10, 13, 'http://localhost/merchant_customer/home', 'Sth', 'UPDATE', 4, 2000, 0, 0, 1506, 0, 0, 0, 0, 0, 0, 0, 8, 1, 1, '2020-06-20 21:34:55'),
(11, 13, 'http://localhost/merchant_customer/home', 'remark', '', 3, 200, 60, 50, 1506, 0, 0, 0, 0, 0, 0, 0, 8, 1, 1, '2020-06-20 21:35:54'),
(12, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.32204174xCYJy7&id=605150240460', 'green', 'HEINKAUNG', 5, 200, 100, 50, 1506, 0, 0, 0, 0, 0, 0, 0, 2, 1, 1, '2020-06-21 17:03:51'),
(13, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.248b4174FNlGc3&id=525604511983', 'black', 'HEINKHANT', 1, 50, 5, 100, 1506, 0, 0, 0, 0, 0, 0, 0, 3, 1, 1, '2020-06-21 17:04:35'),
(14, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.27.32204174xCYJy7&id=543806079090', 'sth', '', 2, 200, 40, 0, 1506, 10, 2, 3, 0, 1506, 0, 0, 4, 1, 1, '2020-06-21 17:05:12'),
(15, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.34.32204174xCYJy7&id=521994200736', 'green', '', 5, 200, 100, 0, 1506, 10, 5, 2, 0, 1506, 0, 0, 5, 1, 1, '2020-06-21 17:05:56'),
(16, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.48.32204174xCYJy7&id=41696382378', 'remark', '', 3, 1000, 300, 0, 1506, 10, 4, 5, 0, 1506, 0, 0, 6, 1, 1, '2020-06-21 17:06:53'),
(17, 13, 'https://item.taobao.com/item.htm?spm=a21wu.241046-global.4691948847.13.41cab6cbg3Wcnn&scm=1007.15423.84311.100200300000005&id=982675461&pvid=410bc389-461d-4b66-b37d-8042cc9c4b14', 'LED', '', 5, 500, 250, 0, 1506, 10, 1, 2, 3, 1506, 0, 3000, 7, 1, 1, '2020-06-21 17:07:39'),
(18, 13, 'https://item.taobao.com/item.htm?spm=a21wu.241046-global.4691948847.25.41cab6cbg3Wcnn&scm=1007.15423.84311.100200300000005&id=565932463881&pvid=410bc389-461d-4b66-b37d-8042cc9c4b14', 'RBG', '', 4, 200, 80, 50, 1506, 10, 2, 8, 0, 1506, 0, 2000, 8, 1, 1, '2020-06-21 17:08:32'),
(19, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.48.32204174xCYJy7&id=41696382378', 'green', 'HEINKAUNG', 1, 20, 0, 0, 1506, 0, 0, 0, 0, 0, 0, 0, 2, 0, 1, '2020-06-21 17:52:58'),
(20, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.27.32204174xCYJy7&id=543806079090', 'sth', 'HEINKAUNG', 2, 2000, 10, 10, 1506, 0, 0, 0, 0, 0, 0, 0, 2, 0, 1, '2020-06-21 21:28:14'),
(21, 13, 'https://item.taobao.com/item.htm?spm=a21bo.7929913.198967.13.32204174xCYJy7&id=605150240460', 'www', 'update', 3, 4, 10, 10, 1506, 0, 0, 0, 0, 0, 0, 0, 2, 0, 1, '2020-06-21 21:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer_statement`
--

CREATE TABLE `customer_statement` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `amount_status` int(1) NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_statement`
--

INSERT INTO `customer_statement` (`id`, `customer_id`, `amount`, `amount_status`, `about`, `created_date`) VALUES
(1, 2, '1000', 1, 'Deposit', '2020-06-04 12:15:02'),
(2, 2, '500', 0, 'buyproduct', '2020-06-04 12:15:29'),
(3, 2, '1000', 1, 'bonus', '2020-06-04 12:16:08'),
(4, 2, '10000', 1, 'Deposit', '2020-06-11 15:18:43'),
(5, 2, '99000', 1, 'cashback', '2020-06-11 15:19:02'),
(6, 2, '9000', 0, 'Tax', '2020-06-11 15:19:26'),
(7, 2, '5000', 0, 'BuyProduct', '2020-06-11 15:19:52'),
(8, 2, '20000', 0, 'BuyProduct', '2020-06-11 15:20:27'),
(9, 2, '100000', 1, 'Deposit', '2020-06-11 15:21:04'),
(10, 2, '1000000', 1, 'Deposit', '2020-06-11 15:21:19'),
(11, 5, '10000', 1, 'Initial', '2020-06-13 19:05:39'),
(12, 5, '1000', 1, 'Deposit\n', '2020-06-15 22:03:20'),
(13, 5, '10000', 1, 'test', '2020-06-15 22:04:21'),
(14, 5, '99.99', 1, 'Deposite', '2020-06-15 22:08:48'),
(15, 5, '1.11', 1, 'fraction', '2020-06-15 22:12:26'),
(16, 5, '100000', 1, 'deposite', '2020-06-20 15:32:20'),
(17, 5, '50000', 1, 'deposite', '2020-06-20 15:34:06'),
(18, 5, '50000', 1, 'deposite', '2020-06-20 15:34:08'),
(19, 5, '200000', 0, 'withdraw', '2020-06-20 15:34:37'),
(20, 5, '100.30', 1, 'add', '2020-06-20 15:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rate`
--

CREATE TABLE `exchange_rate` (
  `id` int(11) NOT NULL,
  `mmk` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exchange_rate`
--

INSERT INTO `exchange_rate` (`id`, `mmk`, `created_date`) VALUES
(1, 1500, '2020-06-12 21:09:28'),
(2, 1501, '2020-06-12 21:10:04'),
(3, 1502, '2020-06-12 21:10:20'),
(4, 1503, '2020-06-17 12:04:01'),
(5, 1504, '2020-06-17 12:04:43'),
(6, 1505, '2020-06-17 12:09:28'),
(7, 1506, '2020-06-20 11:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `login_record`
--

CREATE TABLE `login_record` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_type` enum('no','yes') COLLATE utf8_unicode_ci NOT NULL,
  `to_whom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login_record`
--

INSERT INTO `login_record` (`id`, `user_id`, `active_activity`, `is_type`, `to_whom_id`) VALUES
(1, 3, '2020-06-04 15:06:43', 'no', 0),
(2, 4, '2020-06-05 04:30:52', 'no', 0),
(3, 5, '2020-06-05 04:36:07', 'no', 0),
(4, 6, '2020-06-05 13:40:06', 'yes', 0),
(5, 7, '2020-06-05 13:57:52', 'no', 0),
(6, 8, '2020-06-05 13:35:10', 'no', 0),
(7, 1, '2020-06-22 08:42:44', 'no', 10),
(8, 9, '2020-06-13 10:40:58', 'no', 0),
(9, 10, '2020-06-20 12:02:06', 'no', 1),
(10, 11, '2020-06-13 10:43:10', 'no', 0),
(11, 12, '2020-06-13 10:43:57', 'no', 0),
(12, 13, '2020-06-22 08:42:45', 'no', 0),
(13, 14, '2020-06-15 12:25:45', 'no', 0),
(14, 15, '2020-06-15 12:28:31', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `definition` text COLLATE utf8_unicode_ci NOT NULL,
  `percentage` float NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `name`, `definition`, `percentage`, `modified_date`) VALUES
(1, 'Silver', 'GU GU', 10, '2020-06-19 15:07:24'),
(2, 'Gold', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, cons gu gu gu gu gu gu gu gu ectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', 9, '2020-06-06 13:17:52'),
(3, 'Platinum', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. gi gi git i gi gi gi Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 8, '2020-06-06 13:18:18'),
(4, 'Diamond', 'wai linn phyoe', 5, '2020-06-01 17:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `message_record`
--

CREATE TABLE `message_record` (
  `id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `messages` text NOT NULL,
  `is_image` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `arrived_time` datetime NOT NULL,
  `admin_has_viewed` tinyint(1) NOT NULL,
  `customer_has_viewed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_record`
--

INSERT INTO `message_record` (`id`, `to_user_id`, `from_user_id`, `messages`, `is_image`, `arrived_time`, `admin_has_viewed`, `customer_has_viewed`) VALUES
(1, 2, 1, 'Hello David', 'no', '2020-06-19 15:35:59', 1, 0),
(2, 10, 1, 'Hello Taylor', 'no', '2020-06-19 15:38:27', 1, 1),
(3, 10, 1, 'Welcome to my page!', 'no', '2020-06-19 15:38:38', 1, 1),
(4, 10, 1, 'How can I help you', 'no', '2020-06-19 15:38:46', 1, 1),
(5, 1, 10, 'Hello The Best Shop!', 'no', '2020-06-19 20:30:29', 1, 1),
(6, 1, 10, 'Hello Admin', 'no', '2020-06-19 20:47:59', 1, 1),
(7, 1, 10, 'Hello Admin 2', 'no', '2020-06-19 20:52:15', 1, 1),
(8, 1, 10, '🙃🙃🙃', 'no', '2020-06-19 20:52:21', 1, 1),
(9, 1, 10, 'user_1_img_mss_9.png', 'yes', '2020-06-19 20:57:17', 1, 1),
(10, 1, 10, 'Hi Admin', 'no', '2020-06-19 21:43:38', 1, 1),
(11, 10, 1, 'Hi Taylor', 'no', '2020-06-19 21:47:06', 1, 1),
(12, 1, 10, '😌😌😌', 'no', '2020-06-19 22:09:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_request`
--

CREATE TABLE `password_request` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requested_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_request`
--

INSERT INTO `password_request` (`id`, `phone`, `requested_date`, `status`) VALUES
(1, '09260968601', '2020-06-11 05:39:54', 0),
(2, '909090', '2020-06-11 05:44:03', 1),
(4, '09765920059', '2020-06-11 05:52:37', 1),
(5, '09457503263', '2020-06-11 06:03:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(41) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `activate_status` tinyint(1) NOT NULL,
  `point` int(11) NOT NULL,
  `balance` float NOT NULL,
  `membership_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_status`, `phone`, `address`, `activate_status`, `point`, `balance`, `membership_id`, `created_date`, `modified_date`) VALUES
(1, 'Anna', '*7E21CC99D9B70D2E149B59EC60007E3D5DECCC37', 1, '09260968600', 'nth', 1, 0, 0, 1, '2020-06-07 19:07:11', '0000-00-00 00:00:00'),
(2, 'David', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09765920059', '104Marlamyine3rdstreetHlaing16QtrYangon', 1, 1000, 1176500, 3, '2020-06-07 19:07:11', '2020-06-09 13:56:13'),
(3, 'Masha', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09793530085', 'London', 1, 1000, 0, 2, '2020-06-07 19:07:11', '2020-06-09 13:54:36'),
(4, 'Pete', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09765920059', 'WashitonDC', 1, 0, 0, 1, '2020-06-07 19:07:11', '2020-06-05 04:40:47'),
(5, 'Lavenda', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09965343432', 'NewYork', 1, 50, 21200.3, 4, '2020-06-07 19:07:11', '2020-06-15 15:17:17'),
(6, 'Chocotaco', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09457503263', 'Paris', 1, 0, 0, 3, '2020-06-07 19:07:11', '2020-06-13 12:46:11'),
(7, 'Joe', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09765920059', 'yangon', 1, 0, 0, 1, '2020-06-07 19:07:11', '2020-06-05 09:10:59'),
(8, 'GuGu', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09793530086', 'yangon', 1, 0, 0, 1, '2020-06-07 19:07:11', '2020-06-05 13:35:56'),
(9, 'Shoud', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09793530086', 'NewYork', 1, 0, 0, 1, '2020-06-13 17:10:58', '2020-06-13 10:56:43'),
(10, 'Taylor', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09457503263', 'mathi', 1, 0, 0, 1, '2020-06-13 17:11:46', '2020-06-13 10:56:45'),
(11, 'Obama', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09223454322', 'WashitonDC', 1, 0, 0, 1, '2020-06-13 17:13:10', '2020-06-13 10:56:47'),
(12, 'Jack', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09765920059', 'Myanmar', 1, 0, 0, 1, '2020-06-13 17:13:57', '2020-06-13 10:56:48'),
(13, 'Ozil', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09260968600', 'Germany', 1, 0, 0, 1, '2020-06-15 18:50:38', '2020-06-15 12:25:55'),
(14, 'Sanchez', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09260968601', 'Chilli', 1, 0, 0, 1, '2020-06-15 18:55:45', '2020-06-15 12:25:56'),
(15, 'Pepe', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09260968603', 'a, b-c_d', 1, 0, 0, 1, '2020-06-15 18:58:31', '2020-06-20 04:46:07'),
(16, 'Chez', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09260968610', 'Germany', 1, 0, 0, 1, '2020-06-17 17:24:43', '2020-06-20 04:46:07'),
(17, 'Ronny', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 0, '09260968611', 'England', 1, 0, 0, 1, '2020-06-17 17:26:19', '2020-06-18 07:51:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_statement`
--
ALTER TABLE `customer_statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_record`
--
ALTER TABLE `login_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_record`
--
ALTER TABLE `message_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_request`
--
ALTER TABLE `password_request`
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
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_statement`
--
ALTER TABLE `customer_statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exchange_rate`
--
ALTER TABLE `exchange_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_record`
--
ALTER TABLE `login_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message_record`
--
ALTER TABLE `message_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_request`
--
ALTER TABLE `password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
