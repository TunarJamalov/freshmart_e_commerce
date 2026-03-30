-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2025 at 07:14 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshmart_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_information`
--

CREATE TABLE `additional_information` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_information`
--

INSERT INTO `additional_information` (`id`, `product_id`, `label`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Organic Certified', 'Yes', '2025-11-25 22:37:11', '2025-11-25 22:37:11'),
(2, 1, 'Country Of Origin', 'Bangladesh', '2025-11-25 22:37:44', '2025-11-25 22:37:44'),
(3, 1, 'Calories', '300 kcal', '2025-11-25 22:38:22', '2025-11-25 22:39:09'),
(4, 1, 'Carbohydrates', '80 g', '2025-11-25 22:38:34', '2025-11-25 22:38:34'),
(6, 3, 'Organic Certified', 'Yes', '2025-11-25 22:39:27', '2025-11-25 22:39:27'),
(7, 3, 'Calories', '120 kcal', '2025-11-25 22:39:43', '2025-11-25 22:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Morshedul Arefin', 'admin@example.com', 'admin_1745033547.jpg', '$2y$12$zmOPg93IS5..NdhYAExppO4GQd3An3fM4kYBrvxwwRQq/1NTluKNy', '', '2025-04-18 07:07:42', '2025-04-19 18:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'Zelenia Spencer', 'zelenia@example.com', 'This is a very helpful post and I applied it.', 'Approved', '2025-11-26 02:12:26', '2025-11-26 02:19:41'),
(4, 2, 'Hoyt Mckinney', 'hoyt@example.com', 'WOW!', 'Approved', '2025-11-26 03:06:35', '2025-11-26 03:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `discount` int DEFAULT '0',
  `usage_limit` int DEFAULT '0',
  `times_used` int DEFAULT '0',
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `start_date`, `end_date`, `discount`, `usage_limit`, `times_used`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SPECIAL11', '2025-11-20', '2025-12-05', 10, 5, 4, 'Active', '2025-11-23 19:32:10', '2025-11-24 20:07:11'),
(2, 'VIP11', '2025-11-24', '2025-11-30', 30, 7, 1, 'Active', '2025-11-23 19:33:12', '2025-11-24 11:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_options`
--

CREATE TABLE `delivery_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost` int DEFAULT NULL,
  `is_default` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_options`
--

INSERT INTO `delivery_options` (`id`, `name`, `description`, `cost`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Standard Delivery', 'Delivery in 12 hours', 6, 1, '2025-11-23 20:11:13', '2025-11-24 00:49:16'),
(2, 'Express Delivery', 'Delivery in 6 hours', 10, 0, '2025-11-23 20:11:30', '2025-11-23 20:11:30'),
(3, 'Fast Delivery', 'Delivery in 2 hours', 20, 0, '2025-11-23 20:11:45', '2025-11-23 20:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Are the products fresh and authentic?', 'Yes. We source directly from trusted suppliers, farms, and brands. All perishable items are checked for freshness before delivery.', '2025-11-26 00:26:35', '2025-11-26 00:26:48'),
(2, 'Do you offer cash on delivery (COD)?', 'Yes. We offer Cash on Delivery, Online Payment, and Mobile Banking options for your convenience.', '2025-11-26 00:27:02', '2025-11-26 00:27:02'),
(3, 'How do I track my order?', 'You can track your order in real time from the “My Orders” section. We also send SMS/email updates at every step.', '2025-11-26 00:27:19', '2025-11-26 00:27:19'),
(4, 'What happens if I miss the delivery?', 'Our delivery team will contact you. If unreachable, we will attempt one more delivery or reschedule based on your availability.', '2025-11-26 00:27:29', '2025-11-26 00:27:29'),
(5, 'Are your prices the same as local markets?', 'We strive to offer competitive and reasonable prices. discounts and exclusive online deals are available every week.', '2025-11-26 00:27:39', '2025-11-26 00:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_18_114235_create_admins_table', 1),
(5, '2025_11_22_004656_create_product_categories_table', 2),
(6, '2025_11_22_050823_create_products_table', 3),
(7, '2025_11_22_070701_create_product_variations_table', 4),
(8, '2025_11_24_011734_create_coupons_table', 5),
(9, '2025_11_24_020023_create_delivery_options_table', 6),
(10, '2025_11_24_115927_create_orders_table', 7),
(11, '2025_11_24_120421_create_order_details_table', 8),
(12, '2025_11_25_152148_create_wishlists_table', 9),
(13, '2025_11_26_005517_create_ratings_table', 10),
(14, '2025_11_26_042426_create_additional_informations_table', 11),
(15, '2025_11_26_055402_create_sliders_table', 12),
(16, '2025_11_26_062120_create_faqs_table', 13),
(17, '2025_11_26_065702_create_posts_table', 14),
(18, '2025_11_26_080550_create_comments_table', 15),
(19, '2025_11_26_084749_create_replies_table', 16),
(20, '2025_11_26_093959_create_pages_table', 17),
(21, '2025_11_26_104748_create_subscribers_table', 18),
(22, '2025_11_26_111605_create_settings_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `order_no` text COLLATE utf8mb4_unicode_ci,
  `payment_method` text COLLATE utf8mb4_unicode_ci,
  `currency` text COLLATE utf8mb4_unicode_ci,
  `subtotal_price` decimal(10,2) DEFAULT NULL,
  `delivery_option_cost` decimal(10,2) DEFAULT NULL,
  `coupon_code` text COLLATE utf8mb4_unicode_ci,
  `coupon_discount_percentage` int DEFAULT NULL,
  `coupon_discount_value` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `billing_name` text COLLATE utf8mb4_unicode_ci,
  `billing_email` text COLLATE utf8mb4_unicode_ci,
  `billing_phone` text COLLATE utf8mb4_unicode_ci,
  `billing_address` text COLLATE utf8mb4_unicode_ci,
  `billing_country` text COLLATE utf8mb4_unicode_ci,
  `billing_state` text COLLATE utf8mb4_unicode_ci,
  `billing_city` text COLLATE utf8mb4_unicode_ci,
  `billing_zip` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_status` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_no`, `payment_method`, `currency`, `subtotal_price`, `delivery_option_cost`, `coupon_code`, `coupon_discount_percentage`, `coupon_discount_value`, `total_price`, `billing_name`, `billing_email`, `billing_phone`, `billing_address`, `billing_country`, `billing_state`, `billing_city`, `billing_zip`, `note`, `payment_status`, `delivery_status`, `created_at`, `updated_at`) VALUES
(3, 2, 'ORD-17640063103149', 'PayPal', 'USD', 56.00, 20.00, 'VIP11', 30, 16.80, 59.20, 'Smith Cooper', 'smith@example.com', '111-222-3333', '45 Street', 'USA', 'CA', 'NYC', '91283', 'This is a test note.', 'Paid', 'Delivered', '2025-11-24 11:45:10', '2025-11-24 21:51:37'),
(4, 2, 'ORD-17640100743225', 'PayPal', 'USD', 5.00, 6.00, NULL, NULL, 0.00, 11.00, 'Smith Cooper', 'smith@example.com', '111-222-3333', '45 Street', 'USA', 'CA', 'NYC', '91283', NULL, 'Paid', 'Shipped', '2025-11-24 12:47:54', '2025-11-24 21:53:24'),
(5, 2, 'ORD-17640111718748', 'Stripe', 'USD', 12.00, 10.00, 'SPECIAL11', 10, 1.20, 20.80, 'Smith Cooper', 'smith@example.com', '111-222-3333', '45 Street', 'USA', 'CA', 'NYC', '91283', NULL, 'Paid', 'Processing', '2025-11-24 13:06:11', '2025-11-24 21:53:16'),
(8, 2, 'ORD-17640364315288', 'Cash On Delivery', 'USD', 14.00, 6.00, 'SPECIAL11', 10, 1.40, 18.60, 'Smith Cooper', 'smith@example.com', '111-222-3333', '45 Street', 'USA', 'CA', 'NYC', '91283', NULL, 'Paid', 'Delivered', '2025-11-24 20:07:11', '2025-11-24 21:52:34'),
(10, 2, 'ORD-17640372311711', 'Cash On Delivery', 'USD', 7.00, 6.00, NULL, NULL, 0.00, 13.00, 'Smith Cooper', 'smith@example.com', '111-222-3333', '45 Street', 'USA', 'CA', 'NYC', '91283', NULL, 'Pending', 'Pending', '2025-11-24 20:20:31', '2025-11-24 21:54:16'),
(11, 3, 'ORD-17640375558035', 'Stripe', 'USD', 38.50, 6.00, NULL, NULL, 0.00, 44.50, 'David', 'david@example.com', '302-828-0165', '405 Columbia Road,', 'USA', 'DE', 'Philadelphia', '19146', NULL, 'Paid', 'Pending', '2025-11-24 20:25:55', '2025-11-24 21:53:31'),
(13, 5, 'ORD-17641299091135', 'Stripe', 'USD', 4.50, 6.00, NULL, NULL, 0.00, 10.50, 'William Raby', 'william@example.com', '111-222-3335', '2264 Edsel Road', 'USA', 'CA', 'Irvine', '92614', NULL, 'Paid', 'Pending', '2025-11-25 22:05:09', '2025-11-25 22:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `order_id` bigint DEFAULT NULL,
  `order_no` text COLLATE utf8mb4_unicode_ci,
  `product_id` bigint DEFAULT NULL,
  `product_variation_id` bigint DEFAULT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `user_id`, `order_id`, `order_no`, `product_id`, `product_variation_id`, `label`, `sale_price`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(5, 2, 3, 'ORD-17640063103149', 4, 6, '2 kg', 12.00, 2, 24.00, '2025-11-24 11:45:10', '2025-11-24 11:45:10'),
(6, 2, 3, 'ORD-17640063103149', 4, 5, '1 kg', 7.00, 4, 28.00, '2025-11-24 11:45:10', '2025-11-24 11:45:10'),
(7, 2, 3, 'ORD-17640063103149', 1, 1, '12 piece', 4.00, 1, 4.00, '2025-11-24 11:45:10', '2025-11-24 11:45:10'),
(8, 2, 4, 'ORD-17640100743225', 3, 3, '500 g', 5.00, 1, 5.00, '2025-11-24 12:47:54', '2025-11-24 12:47:54'),
(9, 2, 5, 'ORD-17640111718748', 1, 1, '12 piece', 4.00, 3, 12.00, '2025-11-24 13:06:11', '2025-11-24 13:06:11'),
(14, 2, 8, 'ORD-17640364315288', 1, 2, '6 piece', 2.00, 1, 2.00, '2025-11-24 20:07:11', '2025-11-24 20:07:11'),
(15, 2, 8, 'ORD-17640364315288', 4, 6, '2 kg', 12.00, 1, 12.00, '2025-11-24 20:07:11', '2025-11-24 20:07:11'),
(17, 2, 10, 'ORD-17640372311711', 4, 5, '1 kg', 7.00, 1, 7.00, '2025-11-24 20:20:31', '2025-11-24 20:20:31'),
(18, 3, 11, 'ORD-17640375558035', 3, 3, '500 g', 5.00, 5, 25.00, '2025-11-24 20:25:55', '2025-11-24 20:25:55'),
(19, 3, 11, 'ORD-17640375558035', 4, 8, '500 g', 4.50, 3, 13.50, '2025-11-24 20:25:55', '2025-11-24 20:25:55'),
(21, 5, 13, 'ORD-17641299091135', 4, 8, '500 g', 4.50, 1, 4.50, '2025-11-25 22:05:09', '2025-11-25 22:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `privacy_content` text COLLATE utf8mb4_unicode_ci,
  `terms_content` text COLLATE utf8mb4_unicode_ci,
  `contact_address` text COLLATE utf8mb4_unicode_ci,
  `contact_phone` text COLLATE utf8mb4_unicode_ci,
  `contact_email` text COLLATE utf8mb4_unicode_ci,
  `contact_working_hours` text COLLATE utf8mb4_unicode_ci,
  `contact_map` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `privacy_content`, `terms_content`, `contact_address`, `contact_phone`, `contact_email`, `contact_working_hours`, `contact_map`, `created_at`, `updated_at`) VALUES
(1, '<h3>Heading Here</h3>\r\n<p style=\"font-size: medium; font-weight: 400;\">Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>\r\n<h4>Heading Here</h4>\r\n<p style=\"font-size: medium; font-weight: 400;\">Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<h5>Heading Here</h5>\r\n<p style=\"font-size: medium; font-weight: 400;\">An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<h6>Heading Here</h6>\r\n<p style=\"font-size: medium; font-weight: 400;\">Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>', '<h3>Heading Here</h3>\r\n<p style=\"font-size: medium; font-weight: 400;\">Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>\r\n<h4>Heading Here</h4>\r\n<p style=\"font-size: medium; font-weight: 400;\">Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<h5>Heading Here</h5>\r\n<p style=\"font-size: medium; font-weight: 400;\">An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<h6>Heading Here</h6>\r\n<p style=\"font-size: medium; font-weight: 400;\">Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>', '123 Market Street\r\nCity, State 12345\r\nUnited States', '+1 234 567 8900\r\n+1 234 567 8901', 'support@freshmart.com\r\ninfo@freshmart.com', 'Mon - Sat: 8:00 AM - 10:00 PM\r\nSunday: 9:00 AM - 6:00 PM', '<iframe \r\n                        src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.2412648750455!2d-73.98784368459395!3d40.74844097932847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus\" \r\n                        width=\"100%\" \r\n                        height=\"450\" \r\n                        style=\"border:0;\" \r\n                        allowfullscreen=\"\" \r\n                        loading=\"lazy\">\r\n                    </iframe>', NULL, '2025-11-26 04:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `title` text COLLATE utf8mb4_unicode_ci,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `photo`, `title`, `slug`, `short_description`, `description`, `created_at`, `updated_at`) VALUES
(1, 'post_1764141066.jpg', 'Te legimus denique has in per meis interesset', 'te-legimus-denique-has', 'Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing.', '<p>Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<p>An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<p>Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>\r\n<p>Ad nec nemore electram, sea vero dignissim consequat in. Dolorum vituperata scriptorem eos ei, sed graeci argumentum ut. Pri illum intellegat necessitatibus an, diceret fastidii appareat et usu, sea eius iriure iisque ne. Regione equidem deleniti in pro. Vim labore corpora pertinax in, est altera ancillae id, quod tation id quo. Te utinam volutpat usu.</p>', '2025-11-26 01:09:12', '2025-11-26 01:11:06'),
(2, 'post_1764141113.jpg', 'Mei ut liber maiorum insolens his ea dicta adipiscing', 'mei-ut-liber-maiorum', 'Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing.', '<p>Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<p>An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<p>Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>\r\n<p>Ad nec nemore electram, sea vero dignissim consequat in. Dolorum vituperata scriptorem eos ei, sed graeci argumentum ut. Pri illum intellegat necessitatibus an, diceret fastidii appareat et usu, sea eius iriure iisque ne. Regione equidem deleniti in pro. Vim labore corpora pertinax in, est altera ancillae id, quod tation id quo. Te utinam volutpat usu.</p>', '2025-11-26 01:11:53', '2025-11-26 01:11:53'),
(3, 'post_1764141159.jpg', 'Sed ea omnesque voluptatibus in sit inani mundi', 'sed-ea-omnesque-voluptatibus', 'Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing.', '<p>Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<p>An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<p>Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>\r\n<p>Ad nec nemore electram, sea vero dignissim consequat in. Dolorum vituperata scriptorem eos ei, sed graeci argumentum ut. Pri illum intellegat necessitatibus an, diceret fastidii appareat et usu, sea eius iriure iisque ne. Regione equidem deleniti in pro. Vim labore corpora pertinax in, est altera ancillae id, quod tation id quo. Te utinam volutpat usu.</p>', '2025-11-26 01:12:31', '2025-11-26 01:12:39'),
(4, 'post_1764141190.jpg', 'Vis sumo periculis iui no quis disputando atqui', 'vis-sumo-periculis', 'Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing.', '<p>Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<p>An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<p>Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>\r\n<p>Ad nec nemore electram, sea vero dignissim consequat in. Dolorum vituperata scriptorem eos ei, sed graeci argumentum ut. Pri illum intellegat necessitatibus an, diceret fastidii appareat et usu, sea eius iriure iisque ne. Regione equidem deleniti in pro. Vim labore corpora pertinax in, est altera ancillae id, quod tation id quo. Te utinam volutpat usu.</p>', '2025-11-26 01:13:10', '2025-11-26 01:13:10'),
(5, 'post_1764141221.jpg', 'Ad nec nemore electram sea vero dignissim', 'ad-nec-nemore-electram', 'Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing.', '<p>Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<p>An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<p>Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>\r\n<p>Ad nec nemore electram, sea vero dignissim consequat in. Dolorum vituperata scriptorem eos ei, sed graeci argumentum ut. Pri illum intellegat necessitatibus an, diceret fastidii appareat et usu, sea eius iriure iisque ne. Regione equidem deleniti in pro. Vim labore corpora pertinax in, est altera ancillae id, quod tation id quo. Te utinam volutpat usu.</p>', '2025-11-26 01:13:41', '2025-11-26 01:13:41'),
(6, 'post_1764141252.jpg', 'Nulla option offendit id eum malorum omittam', 'nulla-option-offendit', 'Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing.', '<p>Te legimus denique has, in per meis interesset. Vim id inani petentium, pertinax recteque et mel. At vix aeque vivendo, te minim quodsi fierent pri, mea an case utroque accumsan. Mei ut liber maiorum insolens, his ea dicta adipiscing. Sed ea omnesque voluptatibus. In sit inani mundi luptatum. Partem prompta forensibus cum ad, ut eros ipsum per, nam eius saperet utroque eu.</p>\r\n<p>An bonorum habemus epicuri vis, ne inermis consetetur mel, pro in denique erroribus. Intellegat suscipiantur eos et, ut nostro aperiam eam. Ut probo fabulas officiis pri. Aliquip commune qui ut, ei accumsan dissentiunt sit, pericula consequuntur id sed.</p>\r\n<p>Nulla option offendit id eum. Id malorum omittam appareat sea, id per primis vidisse mnesarchum. Case rebum pri ex, mei cu tritani feugait deterruisset, ut vis alia partem. In eos primis inciderint. Vis sumo periculis in, qui no quis disputando. Mei atqui inimicus erroribus ad, vis no probatus evertitur, appareat praesent interesset nec ea. No usu facer assueverit, enim laboramus disputando nec id, vidisse postulant adversarium ei his.</p>\r\n<p>Ad nec nemore electram, sea vero dignissim consequat in. Dolorum vituperata scriptorem eos ei, sed graeci argumentum ut. Pri illum intellegat necessitatibus an, diceret fastidii appareat et usu, sea eius iriure iisque ne. Regione equidem deleniti in pro. Vim labore corpora pertinax in, est altera ancillae id, quod tation id quo. Te utinam volutpat usu.</p>', '2025-11-26 01:14:12', '2025-11-26 01:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_category_id` bigint UNSIGNED DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `name` text COLLATE utf8mb4_unicode_ci,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `show_on_home` int DEFAULT NULL,
  `total_rating_value` int NOT NULL,
  `total_rating_count` int NOT NULL,
  `average_rating` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `photo`, `name`, `slug`, `short_description`, `description`, `show_on_home`, `total_rating_value`, `total_rating_count`, `average_rating`, `created_at`, `updated_at`) VALUES
(1, 2, 'product_1763789684.jpg', 'Banana', 'banana', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 0, 0, 0.00, '2025-11-21 23:30:06', '2025-11-25 22:03:07'),
(3, 2, 'product_1763796500.jpg', 'Blueberries', 'blueberries', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 4, 1, 4.00, '2025-11-22 01:28:20', '2025-11-25 19:20:17'),
(4, 3, 'product_1763796948.jpg', 'Bell Pepper', 'bell-pepper', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 9, 2, 4.50, '2025-11-22 01:35:48', '2025-11-25 22:06:15'),
(5, 2, 'product_1764181774.jpg', 'Calamansis', 'calamansis', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 0, 0, 0.00, '2025-11-26 12:29:34', '2025-11-26 12:29:34'),
(6, 2, 'product_1764182052.jpg', 'Fresh Citruses', 'fresh-citruses', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 0, 0, 0.00, '2025-11-26 12:34:12', '2025-11-26 12:34:12'),
(7, 2, 'product_1764182159.jpg', 'Green Apple', 'green-apple', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 0, 0, 0.00, '2025-11-26 12:35:59', '2025-11-26 12:35:59'),
(8, 2, 'product_1764182236.jpg', 'Kiwi Fruit', 'kiwi-fruit', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:37:16', '2025-11-26 12:37:26'),
(9, 2, 'product_1764182278.jpg', 'Orange', 'orange', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:37:58', '2025-11-26 12:49:31'),
(10, 2, 'product_1764182346.jpg', 'Papaya', 'papaya', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:39:06', '2025-11-26 13:07:48'),
(11, 2, 'product_1764182496.jpg', 'Peach', 'peach', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:41:36', '2025-11-26 12:41:36'),
(12, 2, 'product_1764182562.jpg', 'Pomegranates', 'pomegranates', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:42:42', '2025-11-26 12:42:42'),
(13, 2, 'product_1764182643.jpg', 'Ripe Melon', 'ripe-melon', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:44:03', '2025-11-26 12:44:03'),
(14, 2, 'product_1764182701.jpg', 'Watermelons', 'watermelons', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:45:01', '2025-11-26 12:45:01'),
(15, 2, 'product_1764182825.jpg', 'Artichokes', 'artichokes', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:47:05', '2025-11-26 12:47:05'),
(16, 3, 'product_1764182950.jpg', 'Chili Pepper', 'chili-pepper', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 0, 0, 0.00, '2025-11-26 12:49:10', '2025-11-26 12:49:10'),
(17, 3, 'product_1764183094.jpg', 'Cucumber', 'cucumber', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:51:34', '2025-11-26 12:51:34'),
(18, 3, 'product_1764183220.jpg', 'Green Asparagus', 'green-asparagus', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:53:40', '2025-11-26 12:53:40'),
(19, 4, 'product_1764183275.jpg', 'Fish', 'fish', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 12:54:35', '2025-11-26 12:54:35'),
(20, 4, 'product_1764183369.jpg', 'Seabass', 'seabass', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 1, 0, 0, 0.00, '2025-11-26 12:56:09', '2025-11-26 13:07:58'),
(21, 5, 'product_1764184040.jpg', 'Brown Rice', 'brown-rice', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:07:20', '2025-11-26 13:07:20'),
(22, 5, 'product_1764184204.jpg', 'Wheat Flour', 'wheat-flour', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:10:04', '2025-11-26 13:10:04'),
(23, 5, 'product_1764184237.jpg', 'Chickpeas', 'chickpeas', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:10:37', '2025-11-26 13:10:37'),
(24, 5, 'product_1764184276.jpg', 'Kidney Bean', 'kidney-bean', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:11:16', '2025-11-26 13:11:16'),
(25, 6, 'product_1764184331.jpg', 'Coconuts', 'coconuts', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:12:11', '2025-11-26 13:12:11'),
(26, 6, 'product_1764184369.jpg', 'Fruit Shake', 'fruit-shake', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:12:49', '2025-11-26 13:12:49'),
(27, 6, 'product_1764184407.jpg', 'Red Apple Vinegar', 'red-apple-vinegar', 'Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.', '<p>Lorem ipsum dolor sit amet, his ei vide nullam inimicus. Movet primis definiebas qui at, cum tempor primis iuvaret id. His odio sumo recteque ad, nec viris disputationi ea. Ex imperdiet abhorreant qui, nominati mediocrem voluptatibus te mea, duo cu illum alienum periculis. Clita signiferumque sea ex, tota hendrerit consequuntur pro te. Vix ad justo nominavi. Novum quidam ne sed, his an iusto dicit bonorum.</p>\r\n<p>Feugiat detracto ei vis. Ad est eirmod disputando, no eam quas consectetuer. Harum dolor interesset sea in. Ea cum postea commune, ne sit porro officiis, aliquid tibique temporibus ne qui.</p>\r\n<p>Ei usu civibus pericula. Postea alienum te mei, id nec mutat corrumpit. Nihil instructior complectitur cu qui, vim stet delenit intellegat at, sed ea tation debitis. Atqui offendit tacimates ne vim. Etiam tritani moderatius vis te, eu idque molestiae nam, vide magna iracundia an mel.</p>', 0, 0, 0, 0.00, '2025-11-26 13:13:27', '2025-11-26 13:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_on_home` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `show_on_home`, `created_at`, `updated_at`) VALUES
(2, 'Fresh Fruits', 1, '2025-11-21 18:58:06', '2025-11-21 22:57:23'),
(3, 'Fresh Vegetables', 1, '2025-11-21 18:58:13', '2025-11-21 22:57:27'),
(4, 'Seafood & Meat', 0, '2025-11-21 18:58:22', '2025-11-21 18:58:22'),
(5, 'Grains & Pulses', 1, '2025-11-21 18:58:30', '2025-11-21 22:57:31'),
(6, 'Beverages', 1, '2025-11-21 18:58:39', '2025-11-21 22:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `label` text COLLATE utf8mb4_unicode_ci,
  `sale_price` decimal(10,2) DEFAULT '0.00',
  `regular_price` decimal(10,2) DEFAULT '0.00',
  `stock` int DEFAULT '0',
  `sort_order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `label`, `sale_price`, `regular_price`, `stock`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '12 piece', 4.00, 7.00, 10, 2, '2025-11-22 01:21:34', '2025-11-24 20:22:54'),
(2, 1, '6 piece', 2.00, 4.00, 30, 1, '2025-11-22 01:29:29', '2025-11-24 20:22:50'),
(3, 3, '500 g', 5.00, 9.00, 19, 1, '2025-11-22 01:34:26', '2025-11-24 21:55:34'),
(4, 3, '1 kg', 9.00, 18.00, 30, 2, '2025-11-22 01:34:42', '2025-11-24 20:23:04'),
(5, 4, '1 kg', 7.00, 11.00, 10, 2, '2025-11-22 01:36:19', '2025-11-24 20:23:20'),
(6, 4, '2 kg', 12.00, 16.00, 20, 3, '2025-11-22 01:36:38', '2025-11-24 20:23:16'),
(8, 4, '500 g', 4.50, 9.00, 18, 1, '2025-11-23 03:09:52', '2025-11-25 22:05:09'),
(9, 5, 'Small Pack (500g)', 4.00, 13.00, 50, 1, '2025-11-26 12:31:14', '2025-11-26 12:31:14'),
(10, 5, 'Large Pack (1kg)', 7.00, 18.00, 20, 2, '2025-11-26 12:31:24', '2025-11-26 12:31:24'),
(11, 6, 'Mixed Citrus Box (1kg)', 5.49, 8.49, 20, 1, '2025-11-26 12:34:53', '2025-11-26 12:34:53'),
(12, 6, 'Premium Citrus Box (2kg)', 9.99, 14.99, 25, 2, '2025-11-26 12:35:12', '2025-11-26 12:35:12'),
(13, 7, '500g', 2.99, 6.99, 20, 1, '2025-11-26 12:36:22', '2025-11-26 12:36:22'),
(14, 7, '1kg', 5.49, 8.49, 18, 2, '2025-11-26 12:36:38', '2025-11-26 12:36:38'),
(15, 9, '1kg', 3.49, 6.49, 20, 1, '2025-11-26 12:38:21', '2025-11-26 12:38:21'),
(16, 9, '2kg', 6.49, 9.49, 20, 2, '2025-11-26 12:38:32', '2025-11-26 12:38:32'),
(17, 10, 'Medium Papaya (1 pc)', 3.49, 6.49, 20, 1, '2025-11-26 12:39:43', '2025-11-26 12:39:43'),
(18, 10, 'Large Papaya (1 pc)', 5.49, 11.49, 20, 2, '2025-11-26 12:39:57', '2025-11-26 12:39:57'),
(19, 8, '3 pcs Pack', 2.79, 5.79, 20, 1, '2025-11-26 12:40:48', '2025-11-26 12:40:48'),
(20, 8, '6 pcs Pack', 4.99, 7.99, 20, 2, '2025-11-26 12:41:00', '2025-11-26 12:41:00'),
(21, 11, '500g', 3.29, 6.29, 20, 1, '2025-11-26 12:41:57', '2025-11-26 12:41:57'),
(22, 11, '1kg', 6.29, 8.29, 20, 2, '2025-11-26 12:42:11', '2025-11-26 12:42:11'),
(23, 12, '1 pc (Regular Size)', 2.99, 4.99, 20, 1, '2025-11-26 12:43:13', '2025-11-26 12:43:13'),
(24, 12, '2 pcs Value Pack', 5.49, 7.49, 20, 2, '2025-11-26 12:43:25', '2025-11-26 12:43:25'),
(25, 14, 'Half Watermelon', 5.99, 7.99, 20, 1, '2025-11-26 12:45:26', '2025-11-26 12:45:26'),
(26, 14, 'Whole Watermelon', 9.99, 13.99, 20, 2, '2025-11-26 12:45:40', '2025-11-26 12:45:40'),
(27, 13, 'Half Melon Cut', 4.49, 6.49, 20, 1, '2025-11-26 12:45:59', '2025-11-26 12:45:59'),
(28, 13, 'Whole Melon', 7.99, 10.99, 20, 2, '2025-11-26 12:46:16', '2025-11-26 12:46:16'),
(29, 15, '2 pcs Pack', 4.49, 6.49, 20, 1, '2025-11-26 12:47:43', '2025-11-26 12:48:07'),
(30, 15, '4 pcs Family Pack', 7.99, 15.99, 20, 2, '2025-11-26 12:48:00', '2025-11-26 12:48:00'),
(31, 16, 'Red Chili (250g)', 1.49, 4.49, 20, 1, '2025-11-26 12:50:08', '2025-11-26 12:50:08'),
(32, 16, 'Green Chili (250g)', 1.29, 4.29, 20, 2, '2025-11-26 12:50:32', '2025-11-26 12:50:32'),
(33, 17, '1kg Pack', 3.49, 5.49, 20, 2, '2025-11-26 12:52:26', '2025-11-26 12:52:46'),
(34, 17, '500g Pack', 1.99, 3.99, 20, 1, '2025-11-26 12:52:40', '2025-11-26 12:52:40'),
(35, 19, 'Cut Pieces (500g)', 4.99, 6.99, 20, 1, '2025-11-26 12:55:14', '2025-11-26 12:55:14'),
(36, 19, 'Whole Fish (1kg)', 8.99, 13.99, 20, 2, '2025-11-26 12:55:27', '2025-11-26 12:55:27'),
(37, 20, 'Whole Seabass (600–800g)', 7.99, 12.99, 20, 1, '2025-11-26 12:56:33', '2025-11-26 12:56:33'),
(38, 20, 'Fillet Pack (400g)', 9.99, 17.99, 20, 2, '2025-11-26 12:56:50', '2025-11-26 12:56:50'),
(39, 18, '250g Bundle', 3.99, 5.99, 20, 1, '2025-11-26 13:09:12', '2025-11-26 13:09:12'),
(40, 18, '500g Bundle', 6.99, 9.99, 20, 2, '2025-11-26 13:09:18', '2025-11-26 13:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `rating` int UNSIGNED NOT NULL DEFAULT '0',
  `review` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(3, 3, 4, 5, 'This is a very nice product, I love it so much.', '2025-11-25 19:19:25', '2025-11-25 19:19:25'),
(4, 3, 3, 4, 'Product was so good, but the delivery was a bit delay. Overall good item.', '2025-11-25 19:20:17', '2025-11-25 19:20:17'),
(6, 2, 4, 4, 'Excellent product. I love it. Each month I order it.', '2025-11-25 19:31:02', '2025-11-25 19:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_type` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Pending','Approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `comment_id`, `name`, `email`, `reply`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Destiny Bernard', 'bernard@example.com', 'You are very correct. I also got help.', 'Visitor', 'Approved', '2025-11-26 02:51:48', '2025-11-26 03:08:03'),
(2, 4, 'Dawn Frederick', 'dawn@example.com', 'Can you please explain, why?', 'Visitor', 'Approved', '2025-11-26 03:07:05', '2025-11-26 03:11:03'),
(3, 4, NULL, NULL, 'Thanks a lot!', 'Admin', 'Approved', '2025-11-26 03:18:04', '2025-11-26 03:18:04'),
(4, 1, NULL, NULL, 'I am happy to know that you applied it.', 'Admin', 'Approved', '2025-11-26 03:20:18', '2025-11-26 03:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rjuEMs7D1qVmjoINgAAr2mlcQRRmk2NGeiw3QHlB', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidnRhYjBXaEE4cDVkM2hCa09tMkhESFB6M1R1MGlZTUQ1MGNPMUdIaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImNhcnQiO2E6Mjp7aToxMDthOjM6e3M6MTA6InByb2R1Y3RfaWQiO3M6MToiNSI7czoyMDoicHJvZHVjdF92YXJpYXRpb25faWQiO3M6MjoiMTAiO3M6ODoicXVhbnRpdHkiO3M6MToiMSI7fWk6OTthOjM6e3M6MTA6InByb2R1Y3RfaWQiO3M6MToiNSI7czoyMDoicHJvZHVjdF92YXJpYXRpb25faWQiO3M6MToiOSI7czo4OiJxdWFudGl0eSI7czoxOiIzIjt9fXM6MTg6ImRlbGl2ZXJ5X29wdGlvbl9pZCI7aToxO3M6MjA6ImRlbGl2ZXJ5X29wdGlvbl9jb3N0IjtpOjY7fQ==', 1764184426);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `favicon` text COLLATE utf8mb4_unicode_ci,
  `top_bar_phone` text COLLATE utf8mb4_unicode_ci,
  `top_bar_email` text COLLATE utf8mb4_unicode_ci,
  `footer_facebook` text COLLATE utf8mb4_unicode_ci,
  `footer_twitter` text COLLATE utf8mb4_unicode_ci,
  `footer_linkedin` text COLLATE utf8mb4_unicode_ci,
  `footer_instagram` text COLLATE utf8mb4_unicode_ci,
  `footer_address` text COLLATE utf8mb4_unicode_ci,
  `footer_phone` text COLLATE utf8mb4_unicode_ci,
  `footer_email` text COLLATE utf8mb4_unicode_ci,
  `footer_working_hours` text COLLATE utf8mb4_unicode_ci,
  `footer_copyright` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `top_bar_phone`, `top_bar_email`, `footer_facebook`, `footer_twitter`, `footer_linkedin`, `footer_instagram`, `footer_address`, `footer_phone`, `footer_email`, `footer_working_hours`, `footer_copyright`, `created_at`, `updated_at`) VALUES
(1, 'logo_1764158021.png', 'favicon_1764158879.png', '+1 234 567 8900', 'support@freshmart.com', '#', '#', '#', '#', '123 Market Street, City, State 12345', '+1 234 567 8900', 'support@freshmart.com', 'Mon - Sat: 8:00 AM - 10:00 PM', '© 2025 FreshMart. All rights reserved.', NULL, '2025-11-26 06:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `title` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `button_text` text COLLATE utf8mb4_unicode_ci,
  `button_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `photo`, `title`, `description`, `button_text`, `button_url`, `created_at`, `updated_at`) VALUES
(1, 'slider_1764137110.png', 'Fresh Organic Vegetables', 'Get up to 50% off on fresh organic produce. Delivered to your doorstep!', 'Shop Now', '#', '2025-11-26 00:03:19', '2025-11-26 00:16:24'),
(2, 'slider_1764137173.png', 'Fresh Organic Vegetables', 'Get up to 50% off on fresh organic produce. Delivered to your doorstep!', 'Shop Now', '#', '2025-11-26 00:06:13', '2025-11-26 00:16:29'),
(3, 'slider_1764137198.png', 'Fresh Organic Vegetables', 'Get up to 50% off on fresh organic produce. Delivered to your doorstep!', 'Shop Now', '#', '2025-11-26 00:06:38', '2025-11-26 00:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci,
  `token` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `token`, `status`, `created_at`, `updated_at`) VALUES
(3, 'test1@example.com', '', 1, '2025-11-26 04:51:26', '2025-11-26 04:56:26'),
(5, 'test2@example.com', '', 1, '2025-11-26 04:52:36', '2025-11-26 04:56:34'),
(6, 'test3@example.com', '25825fe556d2cb7d2a8d840542154f1e384e67b51dca5ca252d5145620a69d00', 0, '2025-11-26 04:56:48', '2025-11-26 04:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=suspended',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `password`, `phone`, `address`, `country`, `state`, `city`, `zip`, `token`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Smith Cooper', 'smith@example.com', 'user_1763717855.png', '$2y$12$IYaJn9FLquE02f61Z2Yhb.C93/1CJgYzisur5ZNIIaH1Yl6aJ6/em', '111-222-3333', '45 Street', 'USA', 'CA', 'NYC', '91283', '', '1', '2025-04-18 20:31:03', '2025-11-25 21:51:51'),
(3, 'David', 'david@example.com', 'user_1763734378.jpg', '$2y$12$L4PXkkzwQFFiBhtEJ1v3..1Dgej0w2LbkVrMOy.hQn.cGn/NxEK4K', '302-828-0165', '405 Columbia Road,', 'USA', 'DE', 'Philadelphia', '19146', '', '1', '2025-04-18 20:33:17', '2025-11-24 20:25:20'),
(5, 'William Raby', 'william@example.com', 'user_1763734346.jpg', '$2y$12$AjlSlLS2ZNYo3Ot37OhKmumuignZG/rYKLPCi28VcWd3AXNvLeTDC', '111-222-3335', '2264 Edsel Road', 'USA', 'CA', 'Irvine', '92614', NULL, '1', '2025-11-21 07:39:00', '2025-11-21 08:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(5, 2, 1, '2025-11-25 09:45:40', '2025-11-25 09:45:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_information`
--
ALTER TABLE `additional_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_options`
--
ALTER TABLE `delivery_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_information`
--
ALTER TABLE `additional_information`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_options`
--
ALTER TABLE `delivery_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
