-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 12:40 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sos`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'New Brand add', 'new-brand-add', NULL, NULL, NULL, NULL, 'active', 'uploads/brand/1678100887.jpg', '2023-03-06 05:03:43', '2023-03-07 05:47:20', '2023-03-07 05:47:20'),
(2, 'acc', 'acc', NULL, NULL, NULL, NULL, 'active', 'uploads/brand/1678102630.jpg', '2023-03-06 05:37:10', '2023-03-06 07:42:42', NULL),
(3, 'vendor pro v', 'vendor-pro-v', NULL, NULL, NULL, NULL, NULL, 'uploads/brand/1678102870.jpg', '2023-03-06 05:41:10', '2023-03-06 05:41:10', NULL),
(4, 'change', 'change', NULL, NULL, NULL, NULL, 'active', 'uploads/brand/1678108193.jpg', '2023-03-06 07:09:53', '2023-03-06 07:49:57', '2023-03-06 07:49:57'),
(5, 'hfh', 'hfh', NULL, NULL, NULL, NULL, 'active', 'uploads/brand/1678189016.png', '2023-03-07 05:36:56', '2023-03-07 05:37:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `image`, `tags`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'new', 'new', 'new category', 'category', 'category', 'category', 'active', 'uploads/category/1678093849.jpg', 'asdfs,asdfsf', '2023-03-06 03:10:49', '2023-03-06 03:10:49', NULL),
(2, 'category 2', 'category-2', 'new category', 'new category', 'new category', 'new category', 'inActive', 'uploads/category/1678096391.jpg', 'asdfs,asdfsf,asdsd', '2023-03-06 03:53:11', '2023-03-11 03:01:24', NULL),
(3, 'asdfs', 'asdfs', 'fsdfs', 'asdf', 'asdf', 'asdf', 'active', 'uploads/category/1678188989.png', 'asdf,sdfsf,sdfs', '2023-03-07 05:36:29', '2023-03-07 05:36:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `code`) VALUES
(1, 'red', 'red', 'active', '2023-03-13 10:05:39', '2023-03-13 10:05:39', NULL, 2, NULL),
(2, 'blue', 'blue', 'active', '2023-03-13 10:05:39', '2023-03-13 10:05:39', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color_product`
--

CREATE TABLE `color_product` (
  `id` int(11) NOT NULL,
  `product_id` int(199) DEFAULT NULL,
  `color_id` int(199) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color_product`
--

INSERT INTO `color_product` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2023-03-13 04:13:49', '2023-03-13 04:13:49'),
(2, 3, 2, '2023-03-13 04:13:49', '2023-03-13 04:13:49'),
(3, 4, 1, '2023-03-13 04:17:43', '2023-03-13 04:17:43'),
(4, 4, 2, '2023-03-13 04:17:43', '2023-03-13 04:17:43'),
(5, 5, 1, '2023-03-13 04:21:26', '2023-03-13 04:21:26'),
(6, 5, 2, '2023-03-13 04:21:26', '2023-03-13 04:21:26'),
(7, 6, 1, '2023-03-13 04:22:47', '2023-03-13 04:22:47'),
(8, 6, 2, '2023-03-13 04:22:47', '2023-03-13 04:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_28_174300_create_categories_table', 1),
(6, '2023_02_01_111724_create_brands_table', 1),
(7, '2023_02_18_051712_create_subcategories_table', 1),
(8, '2023_02_18_051747_create_products_table', 1),
(9, '2023_02_28_052500_create_product_images_table', 1),
(10, '2023_03_05_053821_create_colors_table', 1),
(11, '2023_03_05_053934_create_sizes_table', 1),
(12, '2023_03_05_071119_create_recharges_table', 1),
(13, '2023_03_05_110402_create_carts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(36, 'App\\Models\\User', 9, 'a@gmail.com_Token', '78dcb30be83dbde2bf7583ec70240e5cb821efa89306674ba7adef1119ec219e', '[\"*\"]', NULL, NULL, '2023-03-11 01:00:20', '2023-03-11 01:00:20'),
(37, 'App\\Models\\User', 9, 'a@gmail.com_AdminToken', 'b2660ac37822f2c62b1fab9b5130b086391ec7e2b7f2f8b12ee11d486d0fc810', '[\"server:admin\"]', NULL, NULL, '2023-03-11 01:00:27', '2023-03-11 01:00:27'),
(38, 'App\\Models\\User', 10, 'v@gmail.com_Token', 'ee9692c86b5ce39b7ddbd9359a58ea37798b80b244248fdfe151104e20d71647', '[\"*\"]', NULL, NULL, '2023-03-11 01:06:47', '2023-03-11 01:06:47'),
(39, 'App\\Models\\User', 10, 'v@gmail.com_VendorToken', 'a97c4de262a5395d85a05086ce207c152e3cc0a02e2b338146400af8d14da5f2', '[\"server:vendor\"]', '2023-03-11 01:06:54', NULL, '2023-03-11 01:06:53', '2023-03-11 01:06:54'),
(45, 'App\\Models\\User', 1, 'admin@gmail.com_AdminToken', 'dfe720a4e8a6acf7c889cb6bae97f04a743921770a9e18f28219f89af070281b', '[\"server:admin\"]', '2023-03-12 01:02:44', NULL, '2023-03-12 00:39:31', '2023-03-12 01:02:44'),
(46, 'App\\Models\\User', 3, 'vendor2@gmail.com_VendorToken', '60bc6b12eb41fbf5eaa30c7395563b917db941fad2340fd35d5d8964d6d12231', '[\"server:vendor\"]', '2023-03-12 22:33:15', NULL, '2023-03-12 05:05:51', '2023-03-12 22:33:15'),
(47, 'App\\Models\\User', 2, 'vendor@gmail.com_VendorToken', '0ece5acf430289e5abe5cc5c8b0c8c8c8dbd85bb9105e2915ba223f3a5cb748b', '[\"server:vendor\"]', '2023-03-13 05:30:36', NULL, '2023-03-13 04:07:38', '2023-03-13 05:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commision_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `specification` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification_ans` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `brand_id`, `user_id`, `slug`, `name`, `short_description`, `long_description`, `selling_price`, `original_price`, `qty`, `image`, `status`, `meta_title`, `meta_keyword`, `meta_description`, `tags`, `commision_type`, `request`, `user_type`, `created_at`, `updated_at`, `deleted_at`, `specification`, `specification_ans`) VALUES
(4, 1, 1, 1, 2, 'vendor-product', 'Vendor Product', 'dfdddd', 'dddddd', '12', '10', '20', 'uploads/product/1678702663.jpg', 'active', NULL, NULL, NULL, 'new,old', NULL, NULL, NULL, '2023-03-13 04:17:43', '2023-03-13 04:17:43', NULL, NULL, ''),
(5, 1, 1, 1, 2, 'vendor-product-2', 'Vendor Product  2', 'dfdddd', 'dddddd', '12', '10', '20', NULL, 'active', NULL, NULL, NULL, 'new,old', NULL, NULL, NULL, '2023-03-13 04:21:26', '2023-03-13 04:21:26', NULL, '', ''),
(6, 1, 1, 1, 2, 'vendor-product-3', 'Vendor Product  3', 'dfdddd', 'dddddd', '12', '10', '20', NULL, 'active', NULL, NULL, NULL, 'new,old', NULL, NULL, NULL, '2023-03-13 04:22:47', '2023-03-13 04:22:47', NULL, '[\"gg\"]', '[\"gg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'uploads/product/1678702967-329774697_956246102040444_6215959066218091745_n.jpg', '2023-03-13 04:22:47', '2023-03-13 04:22:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int(11) NOT NULL,
  `product_id` int(199) DEFAULT NULL,
  `size_id` int(199) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `product_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2023-03-13 04:17:43', '2023-03-13 04:17:43'),
(2, 4, 2, '2023-03-13 04:17:43', '2023-03-13 04:17:43'),
(3, 5, 1, '2023-03-13 04:21:26', '2023-03-13 04:21:26'),
(4, 5, 2, '2023-03-13 04:21:26', '2023-03-13 04:21:26'),
(5, 6, 1, '2023-03-13 04:22:47', '2023-03-13 04:22:47'),
(6, 6, 2, '2023-03-13 04:22:47', '2023-03-13 04:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `recharges`
--

CREATE TABLE `recharges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(1, 'xl', 'xl', 'pending', '2023-03-12 05:06:37', '2023-03-12 05:06:37', NULL, 3),
(2, '2xl', '2xl', 'pending', '2023-03-12 05:07:51', '2023-03-12 05:07:51', NULL, 3),
(3, 'MLX', 'mlx', 'pending', '2023-03-12 22:33:15', '2023-03-12 22:33:15', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'sdf bvhg', 'sdf-bvhg', 'active', '2023-03-07 05:36:38', '2023-03-11 02:59:24', NULL),
(4, 2, 'Abdur Shoburjhkj', 'abdur-shoburjhkj', 'active', '2023-03-11 02:59:00', '2023-03-11 02:59:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_as` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_as`, `image`, `number`, `status`, `balance`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '1', NULL, NULL, 'active', NULL, '$2y$10$SRls1QAH1nf.J5LPaw6Sfu9.qt4wN6rkD20CwCYFoyuGf/qWCv9wa', NULL, '2023-03-06 06:29:48', '2023-03-06 06:29:48', NULL),
(2, 'vendor pro', 'vendor@gmail.com', NULL, '2', 'uploads/vendor/1678085750.jpg', '1234566234', 'inActive', NULL, '$2y$10$SRls1QAH1nf.J5LPaw6Sfu9.qt4wN6rkD20CwCYFoyuGf/qWCv9wa', NULL, '2023-03-06 00:55:50', '2023-03-11 00:20:07', NULL),
(3, 'vendor2', 'vendor2@gmail.com', NULL, '2', 'uploads/vendor/1678089407.jpg', '32423424', 'active', NULL, '$2y$10$SRls1QAH1nf.J5LPaw6Sfu9.qt4wN6rkD20CwCYFoyuGf/qWCv9wa', NULL, '2023-03-06 01:56:47', '2023-03-11 00:36:45', NULL),
(4, 'new name', 'new@gmail.com', NULL, '2', 'uploads/vendor/1678188936.png', '1234566', 'inActive', NULL, '$2y$10$.8kU78cckKQydvXPj.bHoeHOie0RHpxEYIVfHy/83Nt8fPwHkSC52', NULL, '2023-03-07 05:35:36', '2023-03-11 00:36:39', NULL),
(5, 'new name', 'user@gmail.com', NULL, '3', 'uploads/vendor/1678188962.png', '32423424', 'active', NULL, '$2y$10$7QMZta6JUu2ZoTX2y5VrzeVcJnZ86Npm3.lI.lYUw43m/3bEMxN9S', NULL, '2023-03-07 05:36:02', '2023-03-07 05:36:02', NULL),
(6, 'af', 'af@gmail.com', NULL, '3', 'uploads/vendor/1678189897.png', '321234', 'inActive', NULL, '$2y$10$JdrqUr14Y2be7QNmLRTcG.s4vgbX.z6vaBrx/3mAmnK5hamr3aUFi', NULL, '2023-03-07 05:51:37', '2023-03-11 00:46:47', NULL),
(7, 'af', 'afi@gmail.com', NULL, '3', 'uploads/vendor/1678513528.jpg', '321234', 'active', NULL, '$2y$10$r3iYXeFJup/lGVDe21JlmuN3lWOwNS8BS.18mlu.mFan/Jth952cu', NULL, '2023-03-10 23:45:28', '2023-03-10 23:45:28', NULL),
(8, 'afa', 'afa@gmail.com', NULL, '3', 'uploads/affiliator/1678516266.jpg', '01231321', 'inActive', NULL, '$2y$10$h0wfqQnl7FW33Fb42ZUige/WfhEvK82DQYuBRNUWy7yeqI3X9ym8K', NULL, '2023-03-11 00:25:55', '2023-03-11 00:31:06', NULL),
(9, 'Abdur Shobur', 'a@gmail.com', NULL, '3', NULL, '01818321271', 'active', NULL, '$2y$10$pJgLutvMBkbq38Ag5n32a.iD4CYCndbMhTibqddeNMegIFUESM.re', NULL, '2023-03-11 01:00:20', '2023-03-11 01:01:56', NULL),
(10, 'Abdur', 'v@gmail.com', NULL, '2', NULL, '01818321271', 'pending', NULL, '$2y$10$RpEvmZT5EySBko3Rfd00YOYIwMkD7zh.DjzpmNxamzfxxtFWWrS8e', NULL, '2023-03-11 01:06:47', '2023-03-11 01:06:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_product`
--
ALTER TABLE `color_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recharges`
--
ALTER TABLE `recharges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color_product`
--
ALTER TABLE `color_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recharges`
--
ALTER TABLE `recharges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
