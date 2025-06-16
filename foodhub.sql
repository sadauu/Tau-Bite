-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2022 at 05:28 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `restaurant_id`, `item_id`, `item_name`, `item_price`, `quantity`) VALUES
(2, 1, 1, 1, 'Phở bò chín tái', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `restaurant_id` int NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `restaurant_id`, `category_name`, `status`) VALUES
(1, 1, 'Phở bò', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int UNSIGNED NOT NULL,
  `restaurant_id` int NOT NULL,
  `menu_cat` int NOT NULL,
  `menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `menu_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `restaurant_id`, `menu_cat`, `menu_name`, `description`, `price`, `menu_image`) VALUES
(1, 1, 1, 'Phở bò chín tái', 'Phỏ bò chín tái', 15, 'Phở bò chín tái_1668489194');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_03_01_045158_create_cart_table', 1),
(4, '2016_03_01_050539_create_categories_table', 1),
(5, '2016_03_01_050801_create_menu_table', 1),
(6, '2016_03_01_051123_create_restaurants_table', 1),
(7, '2016_03_01_051949_create_restaurant_order_table', 1),
(8, '2016_03_01_052459_create_restaurant_review_table', 1),
(9, '2016_03_01_052824_create_restaurant_types_table', 1),
(10, '2016_03_01_053018_create_settings_table', 1),
(11, '2016_03_01_053529_create_widgets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `restaurant_type` int NOT NULL,
  `restaurant_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` text COLLATE utf8mb4_unicode_ci,
  `restaurant_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_bg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_monday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_tuesday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_wednesday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_thursday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_friday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_saturday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_sunday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_avg` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `user_id`, `restaurant_type`, `restaurant_name`, `restaurant_slug`, `restaurant_description`, `restaurant_address`, `delivery_charge`, `restaurant_logo`, `restaurant_bg`, `open_monday`, `open_tuesday`, `open_wednesday`, `open_thursday`, `open_friday`, `open_saturday`, `open_sunday`, `review_avg`) VALUES
(1, 1, 7, 'Phở Hà Nội', 'pho-ha-noi', 'Ẩm thực phở Hà Nội<br>', 'Hà Nội, Việt Nam', NULL, 'pho-ha-noi_1668489085', NULL, '06h00 - 21h00', '06h00 - 21h00', '06h00 - 21h00', '06h00 - 21h00', '06h00 - 21h00', '06h00 - 21h00', '06h00 - 21h00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_order`
--

CREATE TABLE `restaurant_order` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  `item_id` int NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` int NOT NULL,
  `quantity` int NOT NULL,
  `created_date` int NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_order`
--

INSERT INTO `restaurant_order` (`id`, `user_id`, `restaurant_id`, `item_id`, `item_name`, `item_price`, `quantity`, `created_date`, `status`) VALUES
(1, 1, 1, 1, 'Phở bò chín tái', 15, 1, 1668470400, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_review`
--

CREATE TABLE `restaurant_review` (
  `id` int UNSIGNED NOT NULL,
  `restaurant_id` int NOT NULL,
  `user_id` int NOT NULL,
  `review_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `food_quality` int NOT NULL,
  `price` int NOT NULL,
  `punctuality` int NOT NULL,
  `courtesy` int NOT NULL,
  `date` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_types`
--

CREATE TABLE `restaurant_types` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_types`
--

INSERT INTO `restaurant_types` (`id`, `type`, `type_image`) VALUES
(1, 'American', 'American_1458535213'),
(3, 'Indian', 'Indian_1458535662'),
(4, 'Mexican', 'Mexican_1458535796'),
(5, 'Pizza', 'Sushi_1458535621'),
(6, 'Sushi', 'Thai_1458535292'),
(7, 'Viet Nam', 'Viet Nam_1668489016');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_favicon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_header_code` text COLLATE utf8mb4_unicode_ci,
  `site_footer_code` text COLLATE utf8mb4_unicode_ci,
  `site_copyright` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addthis_share_code` text COLLATE utf8mb4_unicode_ci,
  `disqus_comment_code` text COLLATE utf8mb4_unicode_ci,
  `facebook_comment_code` text COLLATE utf8mb4_unicode_ci,
  `home_slide_image1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_slide_image2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_slide_image3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_bg_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_restaurant` int DEFAULT NULL,
  `total_people_served` int DEFAULT NULL,
  `total_registered_users` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `currency_symbol`, `site_email`, `site_logo`, `site_favicon`, `site_description`, `site_header_code`, `site_footer_code`, `site_copyright`, `addthis_share_code`, `disqus_comment_code`, `facebook_comment_code`, `home_slide_image1`, `home_slide_image2`, `home_slide_image3`, `page_bg_image`, `total_restaurant`, `total_people_served`, `total_registered_users`) VALUES
(1, 'Viavi Food Delivery', '$', 'admin@admin.com', 'logo.png', 'favicon.png', 'Viavi - Food Delivery Script Viavi - Food Delivery is an laravel script for Delivery Restaurants', NULL, NULL, 'Copyright © 2016 Viavi - Food Delivery Script. All Rights Reserved.', NULL, NULL, NULL, 'home_slide_image1.png', 'home_slide_image2.png', 'home_slide_image3.png', 'page_bg_image.png', 2550, 5355, 12454);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `usertype` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `first_name`, `last_name`, `email`, `password`, `image_icon`, `mobile`, `address`, `city`, `postal_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'John', 'Gari', 'admin@admin.com', '$2y$10$G2UMuTBIW5m9P/gvNjDftO8Jct5/BPE9Mt4GX3fp2wuz5joppG6/S', 'admin', '013456789', 'Ho Chi Minh', 'Ho Chi Minh', '08', 'JoaFvm2PTEQzWpVK03R345BB13BkOlgiXf62n0Yb4U7drVTyWiLSTtmjeBEB', '2022-11-14 18:08:00', '2022-11-14 22:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int UNSIGNED NOT NULL,
  `footer_widget1_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget1_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget2_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget2_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_google` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_pinterest` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_vimeo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_help_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_help_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_help_time` text COLLATE utf8mb4_unicode_ci,
  `sidebar_advertise` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `footer_widget1_title`, `footer_widget1_desc`, `footer_widget2_title`, `footer_widget2_desc`, `footer_widget3_title`, `footer_widget3_address`, `footer_widget3_phone`, `footer_widget3_email`, `about_title`, `about_desc`, `social_facebook`, `social_twitter`, `social_google`, `social_instagram`, `social_pinterest`, `social_vimeo`, `social_youtube`, `need_help_title`, `need_help_phone`, `need_help_time`, `sidebar_advertise`) VALUES
(1, 'About Restaurant', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Recent Tweets', '', 'Contact Info', 'Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing', '+01 123 456 78', 'demo@example.com', 'About Us', 'Aenean ultricies mi vitae est. Mauris placerat eleifend leosit amet est.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Need Help?', '+61 3 8376 6284', 'Monday to Friday 9.00am - 7.30pm', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_order`
--
ALTER TABLE `restaurant_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_review`
--
ALTER TABLE `restaurant_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_types`
--
ALTER TABLE `restaurant_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurant_order`
--
ALTER TABLE `restaurant_order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurant_review`
--
ALTER TABLE `restaurant_review`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_types`
--
ALTER TABLE `restaurant_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
