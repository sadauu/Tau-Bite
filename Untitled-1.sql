
INSERT INTO `cart` (`id`, `user_id`, `restaurant_id`, `item_id`, `item_name`, `item_price`, `quantity`) VALUES
	(2, 2, 1, 1, 'jollof rice', 900, 3),
	(3, 3, 1, 1, 'jollof rice', 900, 3),
	(5, 1, 1, 1, 'jollof rice', 300, 1),
	(6, 4, 1, 1, 'jollof rice', 900, 3);

INSERT INTO `categories` (`id`, `restaurant_id`, `category_name`, `status`) VALUES
	(3, 1, 'rice dishes', 1);

INSERT INTO `menu` (`id`, `restaurant_id`, `menu_cat`, `menu_name`, `description`, `price`, `menu_image`) VALUES
	(1, 1, 3, 'jollof rice', '300 per spoon', 300, 'jollof rice_1749381297');

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
	(11, '2016_03_01_053529_create_widgets_table', 1),
	(12, '2025_06_11_104343_alter_users_table', 2),
	(13, '2025_06_11_104727_create_wallets_table', 3),
	(14, '2025_06_11_105151_create_wallet_transactions_table', 4),
	(15, '2025_06_10_144341_create_payments_table', 5);

INSERT INTO `restaurants` (`id`, `user_id`, `restaurant_type`, `restaurant_name`, `restaurant_slug`, `restaurant_description`, `restaurant_address`, `delivery_charge`, `restaurant_logo`, `restaurant_bg`, `open_monday`, `open_tuesday`, `open_wednesday`, `open_thursday`, `open_friday`, `open_saturday`, `open_sunday`, `review_avg`) VALUES
	(1, 1, 3, 'Amala', 'ila', 'wmrnkjrgfdksl;m, vsblrdjk,mc wljke,mdsfnd ;ovwlj,mrsd', 'east campus close to the main cafeteria', NULL, NULL, NULL, '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', NULL),
	(2, 1, 1, 'westcampus spot', 'ila', 'good noodles', 'tweiurgehdf', NULL, NULL, NULL, '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', '8:00am - 9:00pm', NULL);

INSERT INTO `restaurant_order` (`id`, `user_id`, `restaurant_id`, `item_id`, `item_name`, `item_price`, `quantity`, `created_date`, `status`) VALUES
	(1, 1, 1, 1, 'jollof rice', 600, 2, 1749340800, 'Pending'),
	(2, 2, 1, 1, 'jollof rice', 600, 2, 1749340800, 'Pending'),
	(3, 2, 1, 1, 'jollof rice', 600, 2, 1749340800, 'Pending'),
	(4, 2, 1, 1, 'jollof rice', 600, 2, 1749340800, 'Pending'),
	(5, 3, 1, 1, 'jollof rice', 900, 3, 1749340800, 'Pending'),
	(6, 3, 1, 1, 'jollof rice', 900, 3, 1749340800, 'Completed'),
	(7, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(8, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(9, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(10, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(11, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(12, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(13, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(14, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(15, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(16, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(17, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(18, 1, 1, 1, 'jollof rice', 600, 2, 1749600000, 'Pending'),
	(19, 1, 1, 1, 'jollof rice', 300, 1, 1749600000, 'Pending'),
	(20, 1, 1, 1, 'jollof rice', 300, 1, 1749600000, 'Pending'),
	(21, 1, 1, 1, 'jollof rice', 300, 1, 1749600000, 'Pending');

INSERT INTO `restaurant_types` (`id`, `type`, `type_image`) VALUES
	(1, 'Noodle\'s', 'Noodle\'s_1749066127'),
	(2, 'Soups', 'Soups_1749065304'),
	(3, 'Rice Dishes', 'Rice Dishes_1749063522'),
	(4, 'Swallows', 'Swallows_1749064069'),
	(5, 'Bean-Based Meals', 'Bean-Based Meals_1749065913'),
	(6, 'Proteins & Meats', 'Proteins & Meats_1749065678');

INSERT INTO `settings` (`id`, `site_name`, `currency_symbol`, `site_email`, `site_logo`, `site_favicon`, `site_description`, `site_header_code`, `site_footer_code`, `site_copyright`, `addthis_share_code`, `disqus_comment_code`, `facebook_comment_code`, `home_slide_image1`, `home_slide_image2`, `home_slide_image3`, `page_bg_image`, `total_restaurant`, `total_people_served`, `total_registered_users`) VALUES
	(1, 'Tau Bite', '₦', 'admin@admin.com', 'logo.png', 'favicon.png', 'Sir Ahmadu - Food Delivery web app  Sir Ahmadu - Food Delivery is an laravel script for Delivery of Food', NULL, NULL, 'Copyright © 2025 Sir Ahmadu - Food Delivery Script. All Rights Reserved.', NULL, NULL, NULL, 'home_slide_image1.png', 'home_slide_image2.png', 'home_slide_image3.png', 'page_bg_image.png', 2550, 5355, 12454);

INSERT INTO `users` (`id`, `usertype`, `first_name`, `last_name`, `email`, `campus`, `password`, `image_icon`, `mobile`, `address`, `city`, `postal_code`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Ahmed', 'Maiyaki', 'admin@admin.com', 'West Hostel', '$2y$10$SFodWEJNWkXYZygg2ljbPu9XsA6OucQ93sIU2ZiTkR/9aoOTQOKzC', 'ahmed-95b4b1ff97d37e4f2903aa7913d0d7ff', '26456374854', 'sdfdkhddnsmnc zksjxmdb cv zj', 'djjkfslkdfknf', '23454', 'gGPti0Ys0FhpnlRSp1W9JOeOrxh9y45jlEUuxvFKdVIG68l8BrsdQaSikLVr', '2025-05-25 07:24:48', '2025-06-11 10:30:51'),
	(2, 'User', 'sadiq', 'enaah', 'enaah@gmail.com', NULL, '$2y$10$zBG5aLYTmJlU7w/MkGGT/.YUdL96.Plcy7tWqWk0D6P/zIi7tLcCO', NULL, '123454321', 'dzdfxccgfdf', 'xfcxvvxcv', '23432', 'EJlffln7tqP73ijpGzgoyw8McdCPimc1yAqDlDbaxLGh1kgbX4vuELpRa3MP', '2025-06-08 10:19:05', '2025-06-08 10:20:01'),
	(3, 'User', 'sadua', 'namma', 'mss.ahmed.maiyaki@tau.edu.ng', NULL, '$2y$10$bkp7AadbqRSrWur8BdKUyusGDkka.umMUVlOkwabk7YQOHA3Arhe.', NULL, '08027249106', 'faculty library.', 'east campus', '23432', 'ExKBNWahpbP8xVto5wGo0tXwRtGNUmzm86vglDXxIjt0lbrgjzV9wOhX26Sb', '2025-06-08 13:21:16', '2025-06-08 13:24:07'),
	(4, 'User', 'ahmed', 'sadiq', 'sadiq@gmail.com', NULL, '$2y$10$wgppU/JIwm0nD5.0K6Q6ReRjQodzz9W94bbYoWbFTEffERw6wWphi', NULL, NULL, NULL, NULL, NULL, '04AdXwDBemEYX7R0DL2qGOTpqKdLyZyPe8UbNpl8QndD16fGX5xcyOrMgRn2', '2025-06-12 12:39:56', '2025-06-12 12:39:56');

INSERT INTO `widgets` (`id`, `footer_widget1_title`, `footer_widget1_desc`, `footer_widget2_title`, `footer_widget2_desc`, `footer_widget3_title`, `footer_widget3_address`, `footer_widget3_phone`, `footer_widget3_email`, `about_title`, `about_desc`, `social_facebook`, `social_twitter`, `social_google`, `social_instagram`, `social_pinterest`, `social_vimeo`, `social_youtube`, `need_help_title`, `need_help_phone`, `need_help_time`, `sidebar_advertise`) VALUES
	(1, 'About Restaurant', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Recent Tweets', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Contact us', 'Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing', '+234 123 456 789', 'demo@example.com', 'About Us', 'Aenean ultricies mi vitae est. Mauris placerat eleifend leosit amet est.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Need Help?', '+234 1234567890', 'Monday to Friday 9.00am - 7.30pm', NULL);
