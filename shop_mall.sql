-- -------------------------------------------------------------
-- TablePlus 6.0.0(550)
--
-- https://tableplus.com/
--
-- Database: shop_mall
-- Generation Time: 2024-04-27 07:30:54.8210
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `ref_category`;
CREATE TABLE `ref_category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `ref_product`;
CREATE TABLE `ref_product` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disc` int DEFAULT '0',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_product_category_id_foreign` (`category_id`),
  CONSTRAINT `ref_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ref_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trans_cart`;
CREATE TABLE `trans_cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `product_id` int unsigned DEFAULT NULL,
  `qty` int DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_cart_user_id_foreign` (`user_id`),
  KEY `trans_cart_product_id_foreign` (`product_id`),
  CONSTRAINT `trans_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `ref_product` (`id`),
  CONSTRAINT `trans_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trans_checkout`;
CREATE TABLE `trans_checkout` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `total_amount` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trans_checkout_detail`;
CREATE TABLE `trans_checkout_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `checkout_id` int unsigned DEFAULT NULL,
  `product_id` int unsigned DEFAULT NULL,
  `qty` bigint DEFAULT NULL,
  `price` bigint DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_checkout_detail_checkout_id_foreign` (`checkout_id`),
  KEY `trans_checkout_detail_product_id_foreign` (`product_id`),
  CONSTRAINT `trans_checkout_detail_checkout_id_foreign` FOREIGN KEY (`checkout_id`) REFERENCES `trans_checkout` (`id`),
  CONSTRAINT `trans_checkout_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `ref_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2024_04_26_155849_create_table_ref_category', 2),
(9, '2024_04_26_155947_create_table_ref_product', 2),
(10, '2024_04_26_160743_create_table_trans_cart', 2),
(11, '2024_04_26_160956_create_table_trans_checkout', 2);

INSERT INTO `ref_category` (`id`, `name`, `desc`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Vegetables', NULL, NULL, NULL, NULL, NULL),
(2, 'Fruits', NULL, NULL, NULL, NULL, NULL),
(3, 'Bread', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `ref_product` (`id`, `category_id`, `name`, `price`, `desc`, `weight`, `country`, `quality`, `check`, `disc`, `url`, `filename`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Broccoli', 20000, 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.\n\nSusp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish', '500gr', 'Indonesian', 'Organic', 'Healty', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Celeriac', 25000, 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.\n\nSusp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish', '500gr', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'Banana', 10000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'Apple', 8000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'Mango', 12000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'Grapes', 15000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, 'Pumpernickel', 8000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 3, 'Rye bread', 5000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, 'Soda bread', 10000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `trans_cart` (`id`, `user_id`, `product_id`, `qty`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(15, 1, 7, 2, NULL, NULL, '2024-04-26 23:28:33', '2024-04-27 06:59:44'),
(18, 1, 4, 1, NULL, NULL, '2024-04-27 06:59:43', '2024-04-27 06:59:43');

INSERT INTO `trans_checkout` (`id`, `user_id`, `total_amount`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, 1, 32000, NULL, NULL, NULL, '2024-04-26 20:31:10', '2024-04-26 23:31:10'),
(5, 1, 100000, NULL, NULL, NULL, '2024-04-27 06:59:53', '2024-04-27 06:59:53');

INSERT INTO `trans_checkout_detail` (`id`, `checkout_id`, `product_id`, `qty`, `price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 4, 1, 1, 20000, NULL, NULL, '2024-04-26 23:31:10', '2024-04-26 23:31:10'),
(4, 4, 5, 1, 12000, NULL, NULL, '2024-04-26 23:31:10', '2024-04-26 23:31:10'),
(5, 5, 3, 7, 10000, NULL, NULL, '2024-04-27 06:59:53', '2024-04-27 06:59:53'),
(6, 5, 9, 1, 10000, NULL, NULL, '2024-04-27 06:59:53', '2024-04-27 06:59:53'),
(7, 5, 1, 1, 20000, NULL, NULL, '2024-04-27 06:59:53', '2024-04-27 06:59:53');

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nuriana', 'admin@email.com', '$2y$10$KFn38SUvo.aQGg8hnKBcxeTy06/wccqmqOIXZJv.YVIVx98fhHsp.', 'V0WoMkSRpPujRmMnopwunOIP5U5EpC5o0sGKyOhdBPU6ktukFMA8gFqsUdx6', '2024-04-26 14:16:00', '2024-04-26 14:16:00');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;