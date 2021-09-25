-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2021 at 03:38 PM
-- Server version: 5.7.35
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arindam7_tattoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_module`
--

CREATE TABLE `dashboard_module` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dashboard_module`
--

INSERT INTO `dashboard_module` (`id`, `name`, `order_no`) VALUES
(1, 'Admin Management', 1),
(2, 'Banner Management', 2),
(3, 'CMS Page Management', 3),
(4, 'FAQ Management', 4),
(5, 'Menu Management', 5),
(6, 'Event Management', 7),
(7, 'Career Management', 8),
(8, 'Image Gallery Management', 9),
(9, 'Video Gallery Management', 10),
(10, 'Email Template Management', 11),
(11, 'Social Link Management', 12),
(12, 'General Settings', 13),
(13, 'Project Management', 6),
(14, 'Popup Management', 4);

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_tagline` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_logo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_favicon` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_description` longtext COLLATE utf8_unicode_ci,
  `display_per_page` tinyint(4) NOT NULL DEFAULT '25',
  `site_footer_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_format` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'dd-mm-YY',
  `timezone_id` tinyint(4) NOT NULL DEFAULT '0',
  `search_visibility` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `site_tagline`, `site_logo`, `site_favicon`, `site_description`, `display_per_page`, `site_footer_text`, `date_format`, `timezone_id`, `search_visibility`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Tattoo Express', 'Tattoo Express', 'site_logo_1631789230.png', 'site_favicon_1631789230.png', 'Tattoo Express', 10, 'Copyright © Tattoo Express', 'dd-mm-YY', 0, 0, 0, 0, '2019-01-15 00:26:27', '2021-09-16 15:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` mediumtext COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `size` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `image`, `name`, `alt_title`, `caption`, `title`, `description`, `status`, `size`, `extension`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(21, 'media_74a6e2210d0cc7a5dad819ae1ade41de.png', 'tattoo', 'tattoo', 'tattoo', 'tattoo', 'tattoo', 1, '280912', 'png', '2021-09-17 07:54:29', '2021-09-17 07:54:29', 1, 0),
(22, 'media_c3ca725502da3b8f6fe304cba1e6e36b.png', 'tattoo', 'tattoo', 'tattoo', 'tattoo', 'tattoo', 1, '697664', 'png', '2021-09-17 07:54:30', '2021-09-17 07:54:30', 1, 0),
(23, 'media_7e2a5af6e378a4f435fde6302a51ef1f.png', 'Ocxlaya expresion', 'tattoo', 'tattoo', 'Ocxlaya expresion tattoo', 'tattoo', 1, '20563', 'png', '2021-09-17 07:54:30', '2021-09-17 07:56:30', 1, 1),
(24, 'media_4fd86c2241d5d8a9c0dd5f75c4dec21c.jpg', 'The rocky man tattoo', 'tattoo', 'tattoo', 'The rocky man tattoo', 'tattoo', 1, '64846', 'jpg', '2021-09-17 07:54:30', '2021-09-17 07:55:56', 1, 1),
(25, 'media_17ca3411b1cbdae51d31cdacd5609849.png', 'Sun power tattoo', 'tattoo', 'tattoo', 'Sun power tattoo', 'tattoo', 1, '34738', 'png', '2021-09-17 07:54:30', '2021-09-17 07:55:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_category`
--

CREATE TABLE `image_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `display_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image_category`
--

INSERT INTO `image_category` (`id`, `name`, `description`, `parent_category_id`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `display_order`) VALUES
(20, 'Realism or Realistic Tattoo Style', '', 0, 1, '2021-09-16 20:38:40', '2021-09-17 09:18:37', 1, 1, 0),
(21, 'Traditional Tattoo Style', '', 0, 1, '2021-09-16 20:38:49', '2021-09-17 09:18:15', 1, 1, 0),
(22, 'Watercolor Tattoo Style', '', 0, 1, '2021-09-17 09:18:53', '2021-09-17 09:18:53', 1, 0, 0),
(23, 'Tribal Tattoo Style', '', 0, 1, '2021-09-17 09:19:05', '2021-09-17 09:19:05', 1, 0, 0),
(24, 'New School Tattoo Style', '', 0, 1, '2021-09-17 09:19:18', '2021-09-17 09:19:18', 1, 0, 0),
(25, 'Neo Traditional Tattoo Style', '', 0, 1, '2021-09-17 09:19:30', '2021-09-17 09:19:30', 1, 0, 0),
(26, 'Japanese Tattoo Style', '', 0, 1, '2021-09-17 09:19:56', '2021-09-17 09:19:56', 1, 0, 0),
(27, 'Blackwork Tattoo Style', '', 0, 1, '2021-09-17 09:20:08', '2021-09-17 09:20:08', 1, 0, 0),
(28, 'Illustrative Tattoo Style', '', 0, 1, '2021-09-17 09:20:20', '2021-09-17 09:20:20', 1, 0, 0),
(29, 'Chicano Tattoo Style', '', 0, 1, '2021-09-17 09:20:32', '2021-09-17 09:20:32', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_category_map`
--

CREATE TABLE `image_category_map` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL DEFAULT '0',
  `image_category_id` int(11) NOT NULL DEFAULT '0',
  `image_subcategory_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image_category_map`
--

INSERT INTO `image_category_map` (`id`, `image_id`, `image_category_id`, `image_subcategory_id`) VALUES
(12, 21, 28, 0),
(13, 22, 28, 0),
(14, 23, 28, 0),
(15, 24, 28, 0),
(16, 25, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_03_05_064612_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(5, 'App\\Models\\Users', 1),
(6, 'App\\Models\\Users', 1),
(7, 'App\\Models\\Users', 1),
(8, 'App\\Models\\Users', 1),
(9, 'App\\Models\\Users', 1),
(10, 'App\\Models\\Users', 1),
(11, 'App\\Models\\Users', 1),
(12, 'App\\Models\\Users', 1),
(13, 'App\\Models\\Users', 1),
(14, 'App\\Models\\Users', 1),
(15, 'App\\Models\\Users', 1),
(16, 'App\\Models\\Users', 1),
(17, 'App\\Models\\Users', 1),
(18, 'App\\Models\\Users', 1),
(19, 'App\\Models\\Users', 1),
(20, 'App\\Models\\Users', 1),
(21, 'App\\Models\\Users', 1),
(22, 'App\\Models\\Users', 1),
(23, 'App\\Models\\Users', 1),
(24, 'App\\Models\\Users', 1),
(25, 'App\\Models\\Users', 1),
(26, 'App\\Models\\Users', 1),
(27, 'App\\Models\\Users', 1),
(28, 'App\\Models\\Users', 1),
(29, 'App\\Models\\Users', 1),
(30, 'App\\Models\\Users', 1),
(31, 'App\\Models\\Users', 1),
(32, 'App\\Models\\Users', 1),
(33, 'App\\Models\\Users', 1),
(34, 'App\\Models\\Users', 1),
(35, 'App\\Models\\Users', 1),
(36, 'App\\Models\\Users', 1),
(37, 'App\\Models\\Users', 1),
(38, 'App\\Models\\Users', 1),
(39, 'App\\Models\\Users', 1),
(40, 'App\\Models\\Users', 1),
(41, 'App\\Models\\Users', 1),
(42, 'App\\Models\\Users', 1),
(43, 'App\\Models\\Users', 1),
(44, 'App\\Models\\Users', 1),
(45, 'App\\Models\\Users', 1),
(46, 'App\\Models\\Users', 1),
(47, 'App\\Models\\Users', 1),
(48, 'App\\Models\\Users', 1),
(49, 'App\\Models\\Users', 1),
(50, 'App\\Models\\Users', 1),
(51, 'App\\Models\\Users', 1),
(52, 'App\\Models\\Users', 1),
(53, 'App\\Models\\Users', 1),
(54, 'App\\Models\\Users', 1),
(55, 'App\\Models\\Users', 1),
(56, 'App\\Models\\Users', 1),
(57, 'App\\Models\\Users', 1),
(59, 'App\\Models\\Users', 1),
(60, 'App\\Models\\Users', 1),
(61, 'App\\Models\\Users', 1),
(62, 'App\\Models\\Users', 1),
(5, 'App\\Models\\Users', 60),
(6, 'App\\Models\\Users', 60),
(7, 'App\\Models\\Users', 60),
(8, 'App\\Models\\Users', 60),
(9, 'App\\Models\\Users', 60),
(10, 'App\\Models\\Users', 60),
(11, 'App\\Models\\Users', 60),
(12, 'App\\Models\\Users', 60),
(13, 'App\\Models\\Users', 60),
(14, 'App\\Models\\Users', 60),
(15, 'App\\Models\\Users', 60),
(16, 'App\\Models\\Users', 60),
(17, 'App\\Models\\Users', 60),
(18, 'App\\Models\\Users', 60),
(19, 'App\\Models\\Users', 60),
(20, 'App\\Models\\Users', 60),
(21, 'App\\Models\\Users', 60),
(22, 'App\\Models\\Users', 60),
(23, 'App\\Models\\Users', 60),
(24, 'App\\Models\\Users', 60),
(25, 'App\\Models\\Users', 60),
(26, 'App\\Models\\Users', 60),
(27, 'App\\Models\\Users', 60),
(28, 'App\\Models\\Users', 60),
(29, 'App\\Models\\Users', 60),
(30, 'App\\Models\\Users', 60),
(31, 'App\\Models\\Users', 60),
(32, 'App\\Models\\Users', 60),
(33, 'App\\Models\\Users', 60),
(34, 'App\\Models\\Users', 60),
(35, 'App\\Models\\Users', 60),
(36, 'App\\Models\\Users', 60),
(37, 'App\\Models\\Users', 60),
(38, 'App\\Models\\Users', 60),
(39, 'App\\Models\\Users', 60),
(40, 'App\\Models\\Users', 60),
(41, 'App\\Models\\Users', 60),
(42, 'App\\Models\\Users', 60),
(43, 'App\\Models\\Users', 60),
(44, 'App\\Models\\Users', 60),
(45, 'App\\Models\\Users', 60),
(46, 'App\\Models\\Users', 60),
(47, 'App\\Models\\Users', 60),
(48, 'App\\Models\\Users', 60),
(49, 'App\\Models\\Users', 60),
(50, 'App\\Models\\Users', 60),
(51, 'App\\Models\\Users', 60),
(52, 'App\\Models\\Users', 60),
(53, 'App\\Models\\Users', 60),
(54, 'App\\Models\\Users', 60),
(55, 'App\\Models\\Users', 60),
(56, 'App\\Models\\Users', 60),
(57, 'App\\Models\\Users', 60),
(15, 'App\\Models\\Users', 61),
(16, 'App\\Models\\Users', 61),
(17, 'App\\Models\\Users', 61),
(18, 'App\\Models\\Users', 61),
(31, 'App\\Models\\Users', 61),
(32, 'App\\Models\\Users', 61),
(33, 'App\\Models\\Users', 61),
(34, 'App\\Models\\Users', 61),
(35, 'App\\Models\\Users', 61),
(36, 'App\\Models\\Users', 61),
(37, 'App\\Models\\Users', 61),
(38, 'App\\Models\\Users', 61),
(6, 'App\\Models\\Users', 62),
(7, 'App\\Models\\Users', 62),
(8, 'App\\Models\\Users', 62),
(9, 'App\\Models\\Users', 62),
(10, 'App\\Models\\Users', 62),
(11, 'App\\Models\\Users', 62),
(12, 'App\\Models\\Users', 62),
(13, 'App\\Models\\Users', 62),
(14, 'App\\Models\\Users', 62),
(31, 'App\\Models\\Users', 62),
(32, 'App\\Models\\Users', 62),
(33, 'App\\Models\\Users', 62),
(34, 'App\\Models\\Users', 62),
(35, 'App\\Models\\Users', 62),
(36, 'App\\Models\\Users', 62),
(37, 'App\\Models\\Users', 62),
(38, 'App\\Models\\Users', 62),
(43, 'App\\Models\\Users', 62),
(44, 'App\\Models\\Users', 62),
(45, 'App\\Models\\Users', 62),
(46, 'App\\Models\\Users', 62),
(56, 'App\\Models\\Users', 62);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\Users', 1),
(1, 'App\\Models\\Users', 57),
(1, 'App\\Models\\Users', 58),
(1, 'App\\Models\\Users', 59);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'sanjoy.das@karmicksolutions.com', 'C1vOuRStyfANunJcTRBw6rEAP9Q1qchudffQVYENkHbdliHyZMx51cQzCor5', '2020-03-27 05:35:38', NULL),
(2, 'sanjoy.das@karmicksolutions.com', 'gq8iv3gDFumRmKWkiUf0YoTLE7jxNVIOBOp0ZEk8GNaLvaNDRzKY21gxqUy0', '2020-03-27 05:53:17', NULL),
(3, 'arindamspon@yopmail.com', 'IquA2ET0xavLRyhXzs3R4k7ZlCHlLpbGV7OrnAXMK6oSw0gnCOAtXE7ZIbQZ', '2020-04-03 01:11:48', NULL),
(4, 'arindamspon@yopmail.com', 'Hr1q1FGHzSqzaLUc9PA78wicHeCmRgaM1eIDiGvpTJrTcD7Lm5sbdukLP4og', '2020-04-03 01:19:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `display_name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(5, 1, 'admin-create', 'Create New Admin', NULL, 'web', '2020-04-20 12:27:38', NULL),
(6, 1, 'admin-view', 'View Admin List', NULL, 'web', '2020-04-20 12:28:34', NULL),
(7, 1, 'admin-edit', 'Edit Admin Details', NULL, 'web', '2020-04-20 12:29:18', NULL),
(8, 1, 'admin-active-inactive', 'Active Inactive Admin Account', NULL, 'web', '2020-04-20 12:29:45', NULL),
(9, 1, 'admin-password-reset', 'Admin Password Reset', NULL, 'web', '2020-04-20 12:31:40', NULL),
(10, 2, 'banner-create', 'Create New Banner', NULL, 'web', '2020-04-20 12:32:11', NULL),
(11, 2, 'banner-view', 'Banner List View', NULL, 'web', '2020-04-20 12:32:23', NULL),
(12, 2, 'banner-edit', 'Edit Banner Details ', NULL, 'web', '2020-04-20 12:32:35', NULL),
(13, 2, 'banner-delete', 'Delete Banner', NULL, 'web', '2020-04-20 12:32:58', NULL),
(14, 1, 'admin-delete', 'Delete Admin', NULL, 'web', '2020-04-20 12:33:05', NULL),
(15, 3, 'cms-page-create', 'Create New CMS Page ', NULL, 'web', '2020-04-20 12:33:42', NULL),
(16, 3, 'cms-page-view', 'CMS Page List View', NULL, 'web', '2020-04-20 12:33:56', NULL),
(17, 3, 'cms-page-edit', 'Edit CMS Page', NULL, 'web', '2020-04-20 12:34:05', NULL),
(18, 3, 'cms-page-delete', 'Delete CMS Page', NULL, 'web', '2020-04-20 12:34:13', NULL),
(19, 4, 'faq-create', 'Create New FAQ', NULL, 'web', '2020-04-20 12:34:24', NULL),
(20, 4, 'faq-view', 'FAQ List View ', NULL, 'web', '2020-04-20 12:34:37', NULL),
(21, 4, 'faq-edit', 'Edit FAQ Details', NULL, 'web', '2020-04-20 12:35:09', NULL),
(22, 4, 'faq-delete', 'Delete FAQ', NULL, 'web', '2020-04-20 12:35:24', NULL),
(23, 5, 'menu-create', 'Create Menu', NULL, 'web', '2020-04-20 12:36:33', NULL),
(24, 5, 'menu-view', 'View Header Menu', NULL, 'web', '2020-04-20 12:36:42', NULL),
(25, 5, 'menu-edit', 'Edit Menu and Submenu', NULL, 'web', '2020-04-20 12:36:55', NULL),
(26, 5, 'menu-delete', 'Delete Menu', NULL, 'web', '2020-04-20 12:37:05', NULL),
(27, 6, 'event-create', 'Create New Event', NULL, 'web', '2020-04-20 12:37:40', NULL),
(28, 6, 'event-view', 'Event List View', NULL, 'web', '2020-04-20 12:37:53', NULL),
(29, 6, 'event-edit', 'Edit Event Details', NULL, 'web', '2020-04-20 12:38:05', NULL),
(30, 6, 'event-delete', 'Delete Events', NULL, 'web', '2020-04-20 12:38:13', NULL),
(31, 13, 'project-create', 'Create New Project', NULL, 'web', '2020-04-20 12:45:15', NULL),
(32, 13, 'project-view', 'Project List View', NULL, 'web', '2020-04-20 12:45:26', NULL),
(33, 13, 'project-edit', 'Edit Project Details', NULL, 'web', '2020-04-20 12:45:42', NULL),
(34, 13, 'project-delete', 'Delete Project', NULL, 'web', '2020-04-20 12:45:51', NULL),
(35, 7, 'job-create', 'Create New Job', NULL, 'web', '2020-04-20 12:46:15', NULL),
(36, 7, 'job-view', 'Job List View', NULL, 'web', '2020-04-20 12:46:25', NULL),
(37, 7, 'job-edit', 'Edit Job', NULL, 'web', '2020-04-20 12:46:35', NULL),
(38, 7, 'job-delete', 'Delete Job', NULL, 'web', '2020-04-20 12:46:47', NULL),
(39, 8, 'image-gallery-create', 'Create New Image Gallery', NULL, 'web', '2020-04-20 12:47:00', NULL),
(40, 8, 'image-gallery-view', 'View Image Gallery List', NULL, 'web', '2020-04-20 12:47:12', NULL),
(41, 8, 'image-gallery-edit', 'Edit Image Gallery', NULL, 'web', '2020-04-20 12:47:24', NULL),
(42, 8, 'image-gallery-delete', 'Delete Image Gallery', NULL, 'web', '2020-04-20 12:47:35', NULL),
(43, 9, 'video-gallery-create', 'Create New Video Gallery', NULL, 'web', '2020-04-20 12:47:46', NULL),
(44, 9, 'video-gallery-view', 'View Video Gallery List', NULL, 'web', '2020-04-20 12:48:11', NULL),
(45, 9, 'video-gallery-edit', 'Edit Video Gallery', NULL, 'web', '2020-04-20 12:48:28', NULL),
(46, 9, 'video-gallery-delete', 'Delete Video Gallery', NULL, 'web', '2020-04-20 12:48:41', NULL),
(47, 10, 'email-template-create', 'Create New Email Template', NULL, 'web', '2020-04-20 12:49:11', NULL),
(48, 10, 'email-template-view', 'Email Template List View', NULL, 'web', '2020-04-20 12:49:23', NULL),
(49, 10, 'email-template-edit', 'Edit Email Template', NULL, 'web', '2020-04-20 12:49:34', NULL),
(50, 10, 'email-template-delete', 'Delete Email Template', NULL, 'web', '2020-04-20 12:49:44', NULL),
(51, 11, 'social-link-create', 'Create New Social Link', NULL, 'web', '2020-04-20 12:49:58', NULL),
(52, 11, 'social-link-view', 'Social Link List View', NULL, 'web', '2020-04-20 12:50:10', NULL),
(53, 11, 'social-link-edit', 'Edit Social Link', NULL, 'web', '2020-04-20 12:50:34', NULL),
(54, 11, 'social-link-delete', 'Delete Social Link', NULL, 'web', '2020-04-20 12:50:44', NULL),
(55, 12, 'general-settings-access', 'Edit and Update General Settings', NULL, 'web', '2020-04-20 12:51:23', NULL),
(56, 1, 'manage-permissions', 'Manage Admin Permissions', NULL, 'web', '2020-04-21 00:02:04', NULL),
(57, 4, 'faq-category', 'Manage FAQ Category', NULL, 'web', '2020-04-21 08:59:01', NULL),
(59, 14, 'popup-create', 'Add New Popup', NULL, 'web', '2020-04-22 00:10:14', NULL),
(60, 14, 'popup-view', 'View All Popups', NULL, 'web', '2020-04-22 00:10:22', NULL),
(61, 14, 'popup-edit', 'Edit Popup', NULL, 'web', '2020-04-22 00:10:32', NULL),
(62, 14, 'popup-delete', 'Delete Popup', NULL, 'web', '2020-04-22 00:10:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'All Access', 'All access to this system.', 'web', '2019-09-12 07:21:48', '2020-01-23 03:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `timestamp_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL COMMENT '1->Super Admin',
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `email_verified_at` datetime DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `timestamp_id`, `user_type`, `first_name`, `last_name`, `email_id`, `contact_no`, `password`, `sex`, `dob`, `image`, `address`, `status`, `email_verified_at`, `last_login`, `created_by`, `updated_by`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'e3a56040f07b19a1585bc0c42b958ed6', 1, 'Super', 'Admin', 'admin@cs.com', '90000000009', 'e10adc3949ba59abbe56e057f20f883e', 'Male', NULL, 'user_1547631159.png', 'Soth Africa', 1, NULL, NULL, 0, 1, '2019-01-15 06:07:54', '2020-06-04 06:25:53', 'C15Z94xO9VjGcHEGv9GchzvmWRK9n3v9CsK1T0fGP5yyevJN0hcxXhwuYx1R'),
(68, '97b7a8444e2cd71edd836948f062460a', 1, 'Avinash', 'Bro', 'avi@yopmail.com', '', '460dde220100078ccffb91446a7696e0', NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 0, '2021-09-17 08:49:35', '2021-09-17 08:49:35', NULL),
(69, '13ece969db5ed2b6af92a61dcc7b9ba2', 5, 'Rahul Sharma', NULL, 'rahul1234@yopmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, '2021-09-23 16:05:39', NULL, NULL),
(70, '9c5c8bdf20f4bbf8a8f47c6fb36b88f6', 5, 'Puja Sharma', NULL, 'puja2020@yopmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, '2021-09-23 16:32:11', NULL, NULL),
(71, '7eacf4e4304923011c36d52a7b43eca9', 5, 'Sayan', NULL, 'sayan@yopmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, '2021-09-23 16:37:09', NULL, NULL),
(72, 'eb430b9df33d7ade7f9a4a148e997099', 5, 'Souvik', NULL, 'souvikdas00007@gmail.com', NULL, '2a6571da26602a67be14ea8c5ab82349', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, '2021-09-23 16:49:29', NULL, NULL),
(73, '65a03043e85104379dd9a34eb1cc1cd8', 5, 'dedipyo ghosh', NULL, 'dedipyoghosh1997@gmail.com', NULL, '22b8a3393771e29e8cd07116f2ca5d9e', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 0, '2021-09-24 12:32:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_tattoo_images`
--

CREATE TABLE `user_tattoo_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash_id` varchar(100) NOT NULL,
  `image_org` text NOT NULL,
  `image_tattoo` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tattoo_images`
--

INSERT INTO `user_tattoo_images` (`id`, `user_id`, `hash_id`, `image_org`, `image_tattoo`, `created_at`, `updated_at`) VALUES
(1, 68, '2454793cc6b0d5645a364d5d98d0f34f', 'media_562955e73918c6be3fdfe334fa5827ba.png', NULL, '2021-09-23 06:14:00', NULL),
(2, 68, 'bbd4173207a7aa0fda5916cf02da5836', 'media_39f56aa5d7e660e0fa0f0884281e7baf.png', NULL, '2021-09-23 06:23:33', NULL),
(3, 68, '6552b140a8244bde0a4e1032a1f7c57d', 'media_c04e068317937d6c59bbe7bb6c92cf6a.png', NULL, '2021-09-23 06:25:08', NULL),
(4, 68, '9bfef88386c3f9105c6f3538ba26b15e', 'media_441290579dce9b2e3b838d8ceb69e088.png', NULL, '2021-09-23 06:50:43', NULL),
(5, 75, '676c8f25cf072c84133b345ff2e60091', 'media_2e1962c2576dfd89fe43399bcb5d1880.jpg', NULL, '2021-09-23 10:35:21', NULL),
(6, 69, 'f51fe657934012fe5ad1e4d1819b2f76', 'media_36039453efe3064e04ee696e3e4f6de9.jpg', NULL, '2021-09-23 18:06:23', NULL),
(7, 70, 'd8a74601a501d7388a1e82dd8e0eeaa0', 'media_5f77686508512236803d1eed09086749.jpg', NULL, '2021-09-23 18:32:51', NULL),
(8, 71, '0a3fc3552ec70b988d3cbee078217e5e', 'media_765284d79178e71e3b37ad49296aa0df.jpg', NULL, '2021-09-23 18:37:32', NULL),
(9, 72, 'e5405148a82bba9697c962584c84c054', 'media_8c3a1a960eb63116142077b08e8b74c2.jpg', NULL, '2021-09-23 18:50:04', NULL),
(10, 69, '273490a090a489a20d28ef5e0942c9af', 'media_2938c12e7ce6fffa8843f268ca943f3c.jpg', NULL, '2021-09-23 19:04:08', NULL),
(11, 69, 'f2d817f1854c158ef5d8083a5ea9887f', 'media_ac4fad76304bce6ebd98688107853836.png', NULL, '2021-09-23 19:10:41', NULL),
(12, 72, 'e3b0c17fefbbce68a6bed023b963b69b', 'media_c1a806112a5424009da1ef4e9c457b55.jpg', NULL, '2021-09-23 23:13:54', NULL),
(13, 73, '8098e8806df8c6f5e7d747e78e0b5113', 'media_c87bdc9d33df00ae52d6598f78371c5d.jpg', NULL, '2021-09-24 14:33:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard_module`
--
ALTER TABLE `dashboard_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_category`
--
ALTER TABLE `image_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_category_map`
--
ALTER TABLE `image_category_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tattoo_images`
--
ALTER TABLE `user_tattoo_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard_module`
--
ALTER TABLE `dashboard_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `image_category`
--
ALTER TABLE `image_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `image_category_map`
--
ALTER TABLE `image_category_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user_tattoo_images`
--
ALTER TABLE `user_tattoo_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
