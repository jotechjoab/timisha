-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2017 at 09:44 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(15) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'unique acct name',
  `category_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='ERP - accounts';

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `category_id`, `description`, `status`, `email`, `phone`, `address`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Walkins', 1, 'For All one Offs', 0, 'info@timishahotel.co.ug', '09839849', 'Soroti', 1, '2017-10-22 07:10:01', '2017-10-22 16:17:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_categories`
--

CREATE TABLE `account_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_categories`
--

INSERT INTO `account_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Clients', 'This is for all incomes', '2017-10-22 14:39:05', '2017-10-22 14:39:05'),
(2, 'Suppliers', 'All supplying agents', '2017-10-22 14:39:32', '2017-10-22 14:39:32'),
(3, 'Internal', 'This is for all accounts that belong to timisha', '2017-10-22 14:40:22', '2017-10-22 14:40:22'),
(4, 'walkin', 'for all One Offs', '2017-10-22 16:11:44', '2017-10-22 16:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `acct_clients`
--

CREATE TABLE `acct_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `excerpt` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date DEFAULT NULL,
  `guest_id` int(11) NOT NULL,
  `no_of_guests` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clientdeposits`
--

CREATE TABLE `clientdeposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `clientid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_deposits` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_used` bigint(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costgroups`
--

CREATE TABLE `costgroups` (
  `id` int(10) UNSIGNED NOT NULL,
  `cgcode` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costparameters`
--

CREATE TABLE `costparameters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `batch_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `margin` bigint(100) NOT NULL,
  `floor` bigint(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Bar', '2017-10-14 13:03:36', '2017-10-14 13:03:36', 0),
(2, 'Restaurant', '2017-10-14 13:05:59', '2017-10-14 13:05:59', 0),
(3, 'Kitchen', '2017-10-14 13:07:32', '2017-10-14 13:07:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_received` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `destination` text NOT NULL,
  `occupation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `batch_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'part_of_PK',
  `item_code` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'pdt_code or srv_code',
  `purchase_date` datetime NOT NULL COMMENT 'As per purchase receipts',
  `qty_purchased` int(11) NOT NULL,
  `qty_in_store` int(11) NOT NULL,
  `purchased_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `po_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Purchase Order ID',
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'under review' COMMENT '"Ready for Sell" or "Under Review/Pricing"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='items in store';

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `batch_no`, `item_code`, `purchase_date`, `qty_purchased`, `qty_in_store`, `purchased_by`, `po_id`, `status`, `created_at`, `created_by`, `updated_at`, `deleted`) VALUES
(1, 'TH2-001_171020061056', 'TH2-001', '2017-10-20 12:10:00', 10, 10, 'Obot Ali', 'po_20171017111020', 'Ready', '2017-10-20 15:40:56', 1, '2017-10-20 15:40:56', 0),
(2, 'TH-2002_171020061056', 'TH-2002', '2017-10-20 12:10:00', 20, 20, 'Obot Ali', 'po_20171017111020', 'Ready', '2017-10-20 15:40:56', 1, '2017-10-20 15:40:56', 0),
(3, 'TH-2001_171020061056', 'TH-2001', '2017-10-20 12:10:00', 50, 50, 'Obot Ali', 'po_20171017111020', 'Ready', '2017-10-20 15:40:56', 1, '2017-10-20 15:40:56', 0),
(4, 'TH-2002_171020061043', 'TH-2002', '2017-10-03 12:10:00', 20, 20, 'Obot Ali', 'po_20171019071008', 'Ready', '2017-10-20 15:57:43', 1, '2017-10-20 15:57:43', 0),
(5, 'TH-2001_171020061043', 'TH-2001', '2017-10-03 12:10:00', 20, 20, 'Obot Ali', 'po_20171019071008', 'Ready', '2017-10-20 15:57:43', 1, '2017-10-20 15:57:43', 0),
(6, 'TH2-001_171021111013', 'TH2-001', '2017-10-21 12:10:00', 4, 4, 'gdghgf', 'po_20171021111000', 'Ready', '2017-10-21 08:55:13', 1, '2017-10-21 08:55:13', 0),
(7, 'TH-2002_171021111013', 'TH-2002', '2017-10-21 12:10:00', 25, 25, 'gdghgf', 'po_20171021111000', 'Ready', '2017-10-21 08:55:13', 1, '2017-10-21 08:55:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(15) NOT NULL,
  `details_grp_id` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `billing_period` varchar(30) NOT NULL,
  `next_billing_date` datetime NOT NULL,
  `billing_method` varchar(10) NOT NULL COMMENT 'auto, manual',
  `payment_status` varchar(30) NOT NULL COMMENT 'Full, Partial, None',
  `created_at` datetime NOT NULL,
  `created_by` int(15) NOT NULL,
  `approval_status` varchar(20) NOT NULL COMMENT 'Approved, Pending, Rejected, Cancelled',
  `approved_by` int(15) NOT NULL,
  `last_printed_by` int(15) NOT NULL,
  `last_printed_on` datetime NOT NULL,
  `dispatch_status` varchar(50) NOT NULL,
  `dispatched_on` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(15) NOT NULL,
  `details_grp_id` varchar(30) NOT NULL,
  `pdt_code` varchar(30) NOT NULL,
  `batch_no` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `unit_of_measure` varchar(30) NOT NULL,
  `quantity` double(15,1) DEFAULT NULL,
  `rate` double(15,2) NOT NULL,
  `discount` bigint(100) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(32,2) NOT NULL,
  `amount` float(32,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `cart_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date_created',
  `posted_by` int(15) NOT NULL COMMENT 'created_by',
  `due_date` datetime NOT NULL,
  `account_dr` int(15) NOT NULL COMMENT 'account_id',
  `account_cr` int(15) NOT NULL COMMENT 'account_id',
  `journal_type` varchar(30) NOT NULL COMMENT 'Invoice or PO',
  `journal_type_id` varchar(30) NOT NULL COMMENT 'Invoice or PO table id',
  `description` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `created_at`) VALUES
(1, 'BREAKFAST', '2017-10-21 10:48:28'),
(2, 'COLD STATERS /<br> SALADS ', '2017-10-21 10:56:52'),
(3, 'HOT STARTERS / <br> SOUPS', '2017-10-21 11:20:25'),
(4, 'SOFT DRINKS', '2017-10-21 11:52:08'),
(5, 'JUICES', '2017-10-21 11:52:32'),
(6, 'WINES', '2017-10-21 11:52:59'),
(7, 'BY BOTTLES', '2017-10-21 11:53:27'),
(8, 'WHISKEYS', '2017-10-21 11:53:40'),
(9, 'ENTREE S /<br> MAIN COURSE', '2017-10-21 12:31:12'),
(10, 'CHINESE / <br> ASIAN CUISINE', '2017-10-21 12:32:03'),
(11, 'VEGETARIAN <br> CORNER', '2017-10-21 12:32:37'),
(12, 'PASTA CORNER', '2017-10-21 12:33:20'),
(13, 'UGANDAN <br>PRIDE', '2017-10-21 12:33:45'),
(14, 'DESSERT', '2017-10-21 12:34:03'),
(15, 'PIZAA <br> CORNER', '2017-10-21 12:34:23'),
(16, 'SPECIALS', '2017-10-21 12:34:38'),
(17, 'SNACKS <br> CENTRE', '2017-10-21 12:35:06'),
(18, 'BURGERS', '2017-10-21 12:35:34'),
(19, 'SANDWICHES', '2017-10-21 12:36:12'),
(20, 'BREAKTEAS', '2017-10-21 14:03:47'),
(21, 'BUFFEETS', '2017-10-21 14:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` double NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `menu_id`, `created_at`) VALUES
(1, 'Continental Breakfast', 'Tropical fruit6 bklkzakhbzsdk ', 20000, 1, '2017-10-21 11:18:19'),
(2, 'Timisha treat salad', '(diced beetroot,potetoes,carrots)', 10000, 2, '2017-10-21 11:49:35'),
(3, 'Avocado tarter', '(cubes of fresh avocado,tomatoes,onions,)', 6000, 2, '2017-10-21 11:51:09'),
(4, 'Sodas - 300ml', '', 2000, 4, '2017-10-21 11:55:13'),
(5, 'Mineral', 'H20 500ml', 2000, 4, '2017-10-21 11:57:16'),
(6, 'Alvaro', '', 3000, 4, '2017-10-21 11:57:39'),
(7, 'Passion ', '', 5000, 5, '2017-10-21 11:58:52'),
(8, 'Cocktail', '', 8000, 5, '2017-10-21 11:59:21'),
(9, 'Lemon / Oranges', '', 5000, 5, '2017-10-21 11:59:55'),
(10, 'Red Wines', 'Dry or sweet', 10000, 6, '2017-10-21 12:02:17'),
(12, 'Gold', '', 40000, 21, '2017-10-21 14:12:41'),
(13, 'Silver', '', 30000, 21, '2017-10-21 14:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pcategories`
--

CREATE TABLE `pcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pdts_services`
--

CREATE TABLE `pdts_services` (
  `id` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `id` int(15) NOT NULL,
  `details_grp_id` varchar(30) NOT NULL,
  `supplier_id` int(3) NOT NULL COMMENT 'number of days',
  `payment_status` varchar(30) DEFAULT NULL COMMENT 'Full, Partial, None',
  `created_at` datetime NOT NULL,
  `created_by` int(15) NOT NULL,
  `approval_status` varchar(20) DEFAULT NULL COMMENT 'Approved, Pending, Rejected, Cancelled',
  `approved_by` int(15) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Not Cleared',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `details_grp_id`, `supplier_id`, `payment_status`, `created_at`, `created_by`, `approval_status`, `approved_by`, `amount`, `status`, `last_updated`, `updated_by`, `deleted`) VALUES
(1, 'po_20171017111020', 1, 'Full', '2017-10-17 11:10:20', 1, 'Approved', 1, 164000, 'Cleared', '2017-10-20 15:40:56', '1', 0),
(2, 'po_20171019111001', 2, NULL, '2017-10-19 11:10:01', 1, NULL, NULL, 0, 'Not Cleared', '2017-10-19 08:16:01', NULL, 0),
(3, 'po_20171019071008', 2, 'Full', '2017-10-19 07:10:08', 1, 'Approved', 1, 64000, 'Cleared', '2017-10-20 15:57:43', '1', 0),
(4, 'po_20171021081029', 3, 'Full', '2017-10-21 08:10:29', 1, 'Approved', 1, 150000, 'Not Cleared', '2017-10-21 05:51:19', '1', 0),
(5, 'po_20171021111000', 1, 'Full', '2017-10-21 11:10:00', 1, 'Approved', 1, 56500, 'Cleared', '2017-10-21 08:55:13', NULL, 0),
(6, 'po_20171022021002', 2, 'None', '2017-10-22 02:10:02', 1, 'Pending', NULL, 17500, 'Not Cleared', '2017-10-22 11:35:02', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `po_details`
--

CREATE TABLE `po_details` (
  `id` int(15) NOT NULL,
  `details_grp_id` varchar(30) NOT NULL,
  `pdt_code` varchar(30) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `unit_of_measure` varchar(30) NOT NULL,
  `quantity` int(15) NOT NULL,
  `rate` double(15,2) NOT NULL,
  `discount` bigint(100) DEFAULT NULL,
  `created_by` int(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_details`
--

INSERT INTO `po_details` (`id`, `details_grp_id`, `pdt_code`, `description`, `unit_of_measure`, `quantity`, `rate`, `discount`, `created_by`, `created_at`, `updated_at`, `updated_by`, `deleted`) VALUES
(1, 'po_20171017111020', 'TH2-001', '', 'pieces', 10, 5000.00, 0, 1, '2017-10-17 11:10:20', '2017-10-20 12:36:42', 1, 0),
(2, 'po_20171017111020', 'TH-2002', '', 'Bottles', 20, 700.00, 0, 1, '2017-10-17 11:10:20', '2017-10-20 12:36:42', 1, 0),
(3, 'po_20171017111020', 'TH-2001', '', 'Bottles', 50, 2000.00, 0, 1, '2017-10-17 11:10:20', '2017-10-20 12:36:42', 1, 0),
(4, 'po_20171019111001', 'TH2-001', '', 'pieces', 46, 0.00, 0, 1, '2017-10-19 11:10:01', '2017-10-19 08:16:01', NULL, 0),
(5, 'po_20171019111001', 'TH-2002', '', 'Bottles', 56, 0.00, 0, 1, '2017-10-19 11:10:01', '2017-10-19 08:16:01', NULL, 0),
(6, 'po_20171019111001', 'TH-2001', '', 'Bottles', 565, 0.00, 0, 1, '2017-10-19 11:10:01', '2017-10-19 08:16:01', NULL, 0),
(7, 'po_20171019071008', 'TH-2002', '', 'Bottles', 20, 700.00, 0, 1, '2017-10-19 07:10:08', '2017-10-20 08:54:42', 1, 0),
(8, 'po_20171019071008', 'TH-2001', '', 'Bottles', 20, 2500.00, 0, 1, '2017-10-19 07:10:08', '2017-10-20 08:54:42', 1, 0),
(9, 'po_20171021081029', 'TH-3001', '', 'ltrs', 50, 3000.00, 0, 1, '2017-10-21 08:10:29', '2017-10-21 05:24:08', 1, 0),
(10, 'po_20171021111000', 'TH2-001', '', 'pieces', 4, 3500.00, 0, 1, '2017-10-21 11:10:00', '2017-10-21 08:53:00', NULL, 0),
(11, 'po_20171021111000', 'TH-2002', '', 'Bottles', 25, 1700.00, 0, 1, '2017-10-21 11:10:00', '2017-10-21 08:53:00', NULL, 0),
(12, 'po_20171022021002', 'TH-2002', '', 'Bottles', 25, 700.00, 0, 1, '2017-10-22 02:10:02', '2017-10-22 11:35:02', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `privilleges`
--

CREATE TABLE `privilleges` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(11) NOT NULL,
  `all_routes` int(11) NOT NULL DEFAULT '0',
  `acc_categories` int(11) NOT NULL DEFAULT '0',
  `hello` int(11) NOT NULL DEFAULT '0',
  `accounts` int(11) NOT NULL DEFAULT '0',
  `author` int(11) NOT NULL DEFAULT '0',
  `contact` int(11) NOT NULL DEFAULT '0',
  `products` int(11) NOT NULL DEFAULT '0',
  `register_product` int(11) NOT NULL DEFAULT '0',
  `suppliers` int(11) NOT NULL DEFAULT '0',
  `clients` int(11) NOT NULL DEFAULT '0',
  `invoices` int(11) NOT NULL DEFAULT '0',
  `save_invoice` int(11) NOT NULL DEFAULT '0',
  `supplier_products` int(11) NOT NULL DEFAULT '0',
  `register_supplier` int(11) NOT NULL DEFAULT '0',
  `register_client` int(11) NOT NULL DEFAULT '0',
  `assign_supplier_products` int(11) NOT NULL DEFAULT '0',
  `add_invoice_item` int(11) NOT NULL DEFAULT '0',
  `account_category_enteries` int(11) NOT NULL DEFAULT '0',
  `inv_details` int(11) NOT NULL DEFAULT '0',
  `proceed_account_entries` int(11) NOT NULL DEFAULT '0',
  `record_income` int(11) NOT NULL DEFAULT '0',
  `record_income_save` int(11) NOT NULL DEFAULT '0',
  `record_invoice_payment` int(11) NOT NULL DEFAULT '0',
  `print_receipt` int(11) NOT NULL DEFAULT '0',
  `login_form` int(11) NOT NULL DEFAULT '0',
  `logout` int(11) NOT NULL DEFAULT '0',
  `users` int(11) NOT NULL DEFAULT '0',
  `register_users` int(11) NOT NULL DEFAULT '0',
  `create_user_profile` int(11) NOT NULL DEFAULT '0',
  `user_profiles` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quotation` int(11) NOT NULL,
  `account_category_enteries_del` int(11) NOT NULL,
  `acc_cat_delete` int(11) NOT NULL,
  `acc_cat_edit` int(11) NOT NULL,
  `save_acc_cat_edit` int(11) NOT NULL,
  `account_category_edit` int(11) NOT NULL,
  `account_category_save_edit` int(11) NOT NULL,
  `del_shlf` int(11) NOT NULL,
  `save_edited_shelf` int(11) NOT NULL,
  `edit_shlf` int(11) NOT NULL,
  `delete_user` int(11) NOT NULL,
  `save_edited_users` int(11) NOT NULL,
  `edit_user` int(11) NOT NULL,
  `delete_supplier_product` int(11) NOT NULL,
  `supplier_products_edit` int(11) NOT NULL,
  `supplier_products_save_edit` int(11) NOT NULL,
  `invoice_print` int(11) NOT NULL,
  `print_deposit_reciept` int(11) NOT NULL,
  `print_deposit_details` int(11) NOT NULL,
  `inv_delete` int(11) NOT NULL,
  `del_quotation` int(11) NOT NULL,
  `delete_costing_param` int(11) NOT NULL,
  `edit_costing_param` int(11) NOT NULL,
  `save_edit_cost_param` int(11) NOT NULL,
  `print_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Product/Service Code',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'supplier_code',
  `size` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_of_measure` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Piece',
  `dept` int(2) NOT NULL COMMENT 'Department',
  `min_threshold` int(6) NOT NULL COMMENT 'X unit_of_measure',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive' COMMENT 'Active, Inactive, Suspended, etc',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 or 1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL COMMENT 'Staff_ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='items'' list';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_code`, `name`, `description`, `supplier_id`, `size`, `unit_of_measure`, `dept`, `min_threshold`, `status`, `deleted`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'TH2-001', 'Fish', 'Fish For Cooking', 002, 'Tilapia', 'pieces', 1, 1, 'Inactive', 0, '2017-10-14 03:10:23', '2017-10-14 15:45:23', NULL),
(2, '', 'Nile Special', 'For Drinkinh', 001, '500 ml', 'Bottles', 2, 10, 'Inactive', 0, '2017-10-14 03:10:24', '2017-10-20 11:04:34', NULL),
(3, 'TH-2001', 'Bell', 'swdw', 002, '500 ml', 'Bottles', 1, 10, 'Inactive', 0, '2017-10-14 04:10:00', '2017-10-20 11:04:38', NULL),
(4, 'TH-2002', 'Coke Cola', 'dwdd', 002, '300 ml', 'Bottles', 1, 10, 'Inactive', 0, '2017-10-14 04:10:34', '2017-10-20 11:04:52', NULL),
(5, 'TH-3001', 'Cooking oil', 'For frying', 003, '20ltrs', 'ltrs', 3, 5, 'Inactive', 0, '2017-10-21 05:10:25', '2017-10-21 05:13:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_old`
--

CREATE TABLE `products_old` (
  `id` int(10) UNSIGNED NOT NULL,
  `pdt_code` int(9) NOT NULL COMMENT 'new item code to be effected soon',
  `item_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Product/Service Code',
  `barcode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `size` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_of_measure` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Piece',
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Product or Service',
  `category` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'UNDEFINED' COMMENT 'Hardware, Plumbing, Cosmetics, Electronics, etc',
  `dept` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'GENERAL' COMMENT 'Department',
  `min_threshold` int(6) NOT NULL COMMENT 'X unit_of_measure',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive' COMMENT 'Active, Inactive, Suspended, etc',
  `shelf_id` int(10) NOT NULL COMMENT 'Items Location',
  `max_shelf_capacity` int(10) NOT NULL COMMENT 'Maximum number of this item that can be contained in this shelf',
  `deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 or 1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL COMMENT 'Staff_ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='items'' list';

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowed_paths` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(15) NOT NULL,
  `details_grp_id` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(15) NOT NULL,
  `approval_status` varchar(20) NOT NULL COMMENT 'Approved, Pending, Rejected, Cancelled',
  `approved_by` int(15) NOT NULL,
  `client_id` int(11) NOT NULL,
  `last_printed_by` int(15) NOT NULL,
  `last_printed_on` datetime NOT NULL,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE `quotation_details` (
  `id` int(15) NOT NULL,
  `details_grp_id` varchar(30) NOT NULL,
  `pdt_code` varchar(30) NOT NULL,
  `batch_no` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `unit_of_measure` varchar(30) NOT NULL,
  `quantity` int(15) NOT NULL,
  `rate` double(15,2) NOT NULL,
  `discount` bigint(100) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(15) NOT NULL COMMENT 'Revenue / Cash-Inflow',
  `trans_code` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `paymt_mode` varchar(20) NOT NULL COMMENT 'cash, cheque, EFT, RTGS, bank draft',
  `cash_tendered` decimal(15,2) NOT NULL COMMENT 'total given by client',
  `amount_paid` decimal(15,2) NOT NULL COMMENT 'payment for pdt or service',
  `change_returned` decimal(15,2) NOT NULL COMMENT 'balance to client',
  `balance_due` decimal(15,2) NOT NULL COMMENT 'amount left for client to pay',
  `received_by` int(15) NOT NULL,
  `created_by` int(15) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='inflow, account receivables';

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `room_name` text NOT NULL,
  `room_type` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `room_name`, `room_type`, `created_at`, `status`) VALUES
(1, '101', 'Lilac', '1', '2017-10-22 13:39:30', 0),
(2, '102', 'Berkley', '2', '2017-10-22 13:41:45', 0),
(3, '105', 'Cairo', '3', '2017-10-22 13:45:58', 0),
(4, '', 'Clients', '', '2017-10-22 14:37:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `amount`, `created`) VALUES
(1, 'Single', 75000, '2017-10-22 13:26:00'),
(2, 'Standard Double', 110000, '2017-10-22 13:26:00'),
(3, 'Executives', 120000, '2017-10-22 13:26:39'),
(4, 'Twin', 140000, '2017-10-22 13:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `shelves`
--

CREATE TABLE `shelves` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Vacant or Occupied',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_code` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'can repeat',
  `batch_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'unique',
  `qty_in_stock` int(11) NOT NULL,
  `qty_sold` int(11) NOT NULL,
  `shelf_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Category/Dept plus number',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`, `status`, `deleted`) VALUES
(1, 'Jotechnologies Uganda', 'Diss Office Makerere University<br> Cocis Level 6 Blcok B', '0703729371', 'jotechjoab@gmail.com', '2017-10-14 01:10:03', '2017-10-18 13:19:27', 0, 0),
(2, 'Total Soroti', 'Kyoga Road', '0938988378', 'info@total.co.ug', '2017-10-14 01:10:32', '2017-10-14 13:45:32', 0, 0),
(3, 'Systems Master', 'Makerere University Kampala', '7876543', 'jmumbere@cis.mak.ac.ug', '2017-10-19 04:10:00', '2017-10-19 16:51:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplierid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_inv`
--

CREATE TABLE `temp_inv` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `Name` varchar(202) NOT NULL,
  `qty` double(11,1) NOT NULL,
  `price` int(11) NOT NULL,
  `batch_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_order`
--

CREATE TABLE `temp_order` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_order`
--

INSERT INTO `temp_order` (`id`, `item`, `qty`, `session_id`) VALUES
(17, 2, 1, 3),
(20, 6, 3, 3),
(21, 10, 3, 3),
(22, 1, 2, 1),
(24, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_po`
--

CREATE TABLE `temp_po` (
  `id` int(11) NOT NULL,
  `pdt_code` varchar(255) NOT NULL,
  `rate` double NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_po`
--

INSERT INTO `temp_po` (`id`, `pdt_code`, `rate`, `qty`, `session`) VALUES
(6, 'TH-2002', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `temp_quote`
--

CREATE TABLE `temp_quote` (
  `id` int(11) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `Name` varchar(202) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `batch_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(15) NOT NULL,
  `trans_code` varchar(30) NOT NULL COMMENT 'Inflow or Outflow',
  `trans_type` varchar(15) NOT NULL COMMENT 'Inflow or Outflow table id',
  `trans_date` datetime NOT NULL,
  `transacted_by` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `account_dr` int(20) NOT NULL,
  `account_cr` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Pending or Complete',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(15) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `journal_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `staff_id` varchar(15) DEFAULT NULL COMMENT 'FK from Employee tbl',
  `fname` varchar(60) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `other_name` varchar(30) DEFAULT NULL,
  `phone_no` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `lastlogin_date` datetime DEFAULT NULL,
  `avater_path` varchar(100) DEFAULT 'images/logo.png',
  `creator_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `profile_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `staff_id`, `fname`, `lname`, `other_name`, `phone_no`, `status`, `lastlogin_date`, `avater_path`, `creator_id`, `created_at`, `updated_at`, `deleted`, `profile_id`) VALUES
(1, 'jotechjoab', 'jotechjoab@gmail.com', 'maatejoel', NULL, 'Joab', 'Mumbere', 'techman', '0703729371', 1, '2017-10-22 06:10:24', 'images/FB_IMG_1484365941487.jpg', 1, '2017-10-11 01:03:01', '2017-10-22 15:44:24', '0', 1),
(3, 'ayiko', 'ayikomoses@gmail.com', 'adriano', NULL, 'Ayiko', 'Moses', 'Adriano', '0771984852', 1, '2017-10-22 04:10:42', 'images/VOK LOGO.jpg', 1, '2017-10-21 07:10:56', '2017-10-22 13:48:42', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(15) NOT NULL COMMENT 'Revenue / Cash-Inflow',
  `trans_code` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `paymt_mode` varchar(20) NOT NULL COMMENT 'cash, cheque, EFT, RTGS, bank draft',
  `cash_tendered` decimal(15,2) NOT NULL COMMENT 'total given',
  `amount_paid` decimal(15,2) NOT NULL COMMENT 'payment for pdt or service',
  `change_returned` decimal(15,2) NOT NULL COMMENT 'balance',
  `balance_due` decimal(15,2) NOT NULL COMMENT 'amount left for client to pay',
  `approved_by` int(15) NOT NULL COMMENT 'staff ID',
  `issued_by` int(15) NOT NULL COMMENT 'staff ID',
  `created_by` int(15) NOT NULL COMMENT 'staff ID',
  `date_created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='inflow, account receivables';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `account_categories`
--
ALTER TABLE `account_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acct_clients`
--
ALTER TABLE `acct_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientdeposits`
--
ALTER TABLE `clientdeposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costgroups`
--
ALTER TABLE `costgroups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `costparameters`
--
ALTER TABLE `costparameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pcategories`
--
ALTER TABLE `pcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdts_services`
--
ALTER TABLE `pdts_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_details`
--
ALTER TABLE `po_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilleges`
--
ALTER TABLE `privilleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`item_code`);

--
-- Indexes for table `products_old`
--
ALTER TABLE `products_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`item_code`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_details`
--
ALTER TABLE `quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `romm_no` (`room_no`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shelves`
--
ALTER TABLE `shelves`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_inv`
--
ALTER TABLE `temp_inv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_order`
--
ALTER TABLE `temp_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_po`
--
ALTER TABLE `temp_po`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pdt_code` (`pdt_code`);

--
-- Indexes for table `temp_quote`
--
ALTER TABLE `temp_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `acct_clients`
--
ALTER TABLE `acct_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientdeposits`
--
ALTER TABLE `clientdeposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `costgroups`
--
ALTER TABLE `costgroups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `costparameters`
--
ALTER TABLE `costparameters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pcategories`
--
ALTER TABLE `pcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdts_services`
--
ALTER TABLE `pdts_services`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `po_details`
--
ALTER TABLE `po_details`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `privilleges`
--
ALTER TABLE `privilleges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products_old`
--
ALTER TABLE `products_old`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotation_details`
--
ALTER TABLE `quotation_details`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'Revenue / Cash-Inflow';
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shelves`
--
ALTER TABLE `shelves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_inv`
--
ALTER TABLE `temp_inv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_order`
--
ALTER TABLE `temp_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `temp_po`
--
ALTER TABLE `temp_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `temp_quote`
--
ALTER TABLE `temp_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'Revenue / Cash-Inflow';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
