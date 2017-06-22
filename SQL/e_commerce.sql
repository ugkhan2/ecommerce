-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 12:54 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Polo'),
(2, 'Puma'),
(3, 'Levis'),
(4, 'Nike'),
(8, 'Sketchers'),
(9, 'LULUS'),
(10, 'UNKNOWN');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`, `shipped`) VALUES
(7, '[{\"id\":\"14\",\"size\":\"Small\",\"quantity\":2}]', '2017-05-29 12:06:35', 1, 1),
(8, '[{\"id\":\"13\",\"size\":\"wssss\",\"quantity\":\"1\"}]', '2017-05-30 00:28:26', 1, 1),
(9, '[{\"id\":\"14\",\"size\":\"Large\",\"quantity\":\"4\"}]', '2017-05-30 00:29:43', 1, 1),
(10, '[{\"id\":\"9\",\"size\":\"XXXL\",\"quantity\":\"4\"}]', '2017-05-30 00:30:40', 1, 1),
(11, '[{\"id\":\"2\",\"size\":\"small\",\"quantity\":\"3\"},{\"id\":\"1\",\"size\":\"28\",\"quantity\":\"2\"}]', '2017-05-30 16:51:07', 1, 1),
(12, '[{\"id\":\"5\",\"size\":\"Small\",\"quantity\":\"2\"}]', '2017-05-30 16:54:32', 1, 1),
(13, '[{\"id\":\"6\",\"size\":\"Small\",\"quantity\":\"4\"}]', '2017-05-30 16:55:24', 1, 1),
(16, '[{\"id\":\"7\",\"size\":\"Small\",\"quantity\":\"1\"}]', '2017-05-30 18:44:49', 1, 1),
(17, '[{\"id\":\"7\",\"size\":\"Small\",\"quantity\":\"1\"}]', '2017-05-30 18:45:23', 1, 1),
(18, '[{\"id\":\"7\",\"size\":\"Small\",\"quantity\":\"1\"}]', '2017-05-30 18:46:32', 1, 1),
(19, '[{\"id\":\"8\",\"size\":\"u041d/u0410\",\"quantity\":\"1\"}]', '2017-05-30 18:51:45', 1, 1),
(20, '[{\"id\":\"17\",\"size\":\"N/A\",\"quantity\":\"1\"},{\"id\":\"7\",\"size\":\"Medium\",\"quantity\":\"1\"}]', '2017-05-31 12:59:09', 1, 1),
(21, '[{\"id\":\"5\",\"size\":\"Large\",\"quantity\":5}]', '2017-05-31 17:23:09', 1, 1),
(22, '[{\"id\":\"6\",\"size\":\"Large\",\"quantity\":\"5\"}]', '2017-05-31 17:26:55', 1, 1),
(23, '[{\"id\":\"9\",\"size\":\"XXXL\",\"quantity\":\"1\"}]', '2017-05-31 17:27:50', 1, 1),
(24, '[{\"id\":\"16\",\"size\":\"41\",\"quantity\":6}]', '2017-05-31 17:32:20', 1, 1),
(25, '[{\"id\":\"20\",\"size\":\"Smal\",\"quantity\":4}]', '2017-05-31 20:42:26', 1, 0),
(26, '[{\"id\":\"13\",\"size\":\"Yess\",\"quantity\":\"1\"}]', '2017-05-31 20:45:15', 1, 0),
(27, '[{\"id\":\"7\",\"size\":\"Small\",\"quantity\":\"11\"}]', '2017-06-11 21:23:05', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Men', 0),
(2, 'Women', 0),
(3, 'Boys', 0),
(4, 'Girls', 0),
(5, 'Shirts', 1),
(6, 'Pants', 1),
(7, 'Shoes', 1),
(8, 'Accessories', 1),
(9, 'Shirts', 2),
(10, 'Pants', 2),
(11, 'Shoes', 2),
(12, 'Dresses', 2),
(13, 'Shirts', 3),
(14, 'Pants', 3),
(15, 'Dresses', 4),
(16, 'Shoes', 4),
(17, 'Accessories', 2),
(18, 'Computers', 0),
(19, 'Mouse', 18),
(20, 'Keyboard', 18),
(23, 'Belts', 1),
(26, 'Gifts', 0),
(27, 'Home Decor', 26),
(28, 'Shoes', 3),
(29, 'Peripheral Devices', 18);

-- --------------------------------------------------------

--
-- Table structure for table `panelusers`
--

CREATE TABLE `panelusers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `panelusers`
--

INSERT INTO `panelusers` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Usman Ghani', 'ugkhan2@gmail.com', '$2y$10$2kJzUlLXALpjZtoJtYN3cO5D1TpZI2aLG5gDkdl7cGs/p6x8SawDm', '2017-04-27 00:40:04', '2017-05-27 11:38:13', 'admin,editor'),
(3, 'test', 'usmanganikhan.khan2@gmail.com', '$2y$10$NC4vroPiwxrZRn/NuUuL1Op2uz70JQg/Q9ySyHEkXouo5W/wORHfu', '2017-04-28 01:27:19', '2017-05-01 13:02:13', 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Levi&#039;s Jeans', '29.99', '39.99', '1', '6', '/e-commerce/img/products/men4.png', 'These jeans are amazing. They are amazing', 1, 'Small:3:3,Medium:15:3,Large:15:4', 0),
(2, 'Beautiful Shirts', '19.99', '24.99', '2', '5', '/e-commerce/img/products/men1.png', 'What a beautiful Shirt...... BLa Blah Blah', 1, 'Small:0:3,Medium:15:1,Large:15:1', 0),
(5, 'Dress', '29.99', '49.99', '3', '14', '/e-commerce/img/products/f6815b3704f3a2a301451ed7e78025cd.png', 'This is a cool Jeans. \r\nPlease buy it....', 1, 'Small:7:2,Medium:5:2,Large:5:3', 0),
(6, 'Girl&#039;s Dream', '49.99', '89.99', '8', '15', '/e-commerce/img/products/7de998f1f7dcfdf7c0754e8d231922ec.jpg', 'Off-The-Shoulder Color Block Fit And Flare Dress WHITE AND BLACK: \r\nExclusive offer, buy it along with the Girl. ;)', 1, 'Small:16:3,Medium:10:2,Large:15:1', 0),
(7, 'HEAVENLY HUES DENIM BLUE MAXI DRESS', '89.99', '109.99', '9', '12', '/e-commerce/img/products/a2770798f33d8b69441922955e92b05d.jpg', 'Lulus Exclusive! You&#039;ll be goddess-like for the entire evening in the Heavenly Hues Denim Blue Maxi Dress! Georgette fabric drapes alongside a V-neck and back, and lays across a banded waist. Full maxi skirt has a sexy side slit. Hidden back zipper with clasp.\r\nFully lined.\r\n100% Polyester.\r\nDry Clean Only.\r\nImported.', 1, 'Small:1:,Medium:13:,Large:15:', 0),
(8, 'ÐŸÐ¸Ñ‡', '0.00', '29.00', '3', '8', '/e-commerce/img/products/e635f60d53eae6c10003c5cbb9a62ba8.jpg', 'Ð¯ÐºÐ¾ Ð¼Ð¾Ð¼Ñ‡Ðµ, Ð¾Ñ‚ Ð¸Ð½Ð´Ð¸Ñ.', 1, 'Big:14:3', 0),
(9, 'SImo', '100.99', '1000.99', '10', '29', '/e-commerce/img/products/ae99921c512fc84f5e69fb8a5b1b4f40.jpg', 'lkdll;klkfdfd', 1, 'XXXL:14:1', 0),
(13, 'This is babygoat', '2.00', '29.00', '3', '28', '/e-commerce/img/products/42641adadb4cf2e5aa786cf209e4df62.jpg', 'YS yss', 1, 'Yess:7:', 0),
(14, 'Levis Jeans', '45.99', '59.99', '3', '6', '/e-commerce/img/products/595224cbb4e2326259e097bee446174d.png', 'Nice pants', 1, 'Small:18:3,Medium:12:3,Large:4:1', 0),
(15, 'Princess Dress', '29.99', '39.99', '8', '15', '/e-commerce/img/products/14729ca494e0901bdbc559b8ed8a0461.png', 'Nice dress. Please buy it.', 1, 'Small:4:1,Medium:3:1', 0),
(16, 'Black', '59.99', '99.99', '1', '28', '/e-commerce/img/products/04dfa56275a8a5c2751e6a0d87c44241.png', 'Shoes', 1, '41:19:1,45:2:1', 0),
(17, 'Man', '10.99', '15.99', '4', '23', '/e-commerce/img/products/423f8f9252ea88b5405cc837fc583657.png', 'Nice belts', 1, 'N/A:14:1', 0),
(19, 'test', '1.00', '155.00', '3', '14', '/e-commerce/img/products/a33e29d80189a5049c9d7f010f9b38d3.jpg,/e-commerce/img/products/4f40a0514dd3b697767890ed4501a60d.jpg,/e-commerce/img/products/c5230ed99441cb7f561e332808cb6735.jpg,/e-commerce/img/products/dcff90ca6257c40e39d5bd79e51ead31.jpg,/e-commerce/img/products/4483b03b42a2156eb6a77a887250864b.jpg', 'Multiupload\r\n', 1, 'Small:4:1', 0),
(20, 'test2', '15.00', '155.00', '9', '27', '/e-commerce/img/products/1995c5470baafeb5034487979fe46ae5.jpg,/e-commerce/img/products/19b7b055ab96a46428caa3851b410e80.jpg,/e-commerce/img/products/6595e1c29efb5d486c890a2d874d103c.jpg,/e-commerce/img/products/0da1571af8a9338808b11a8c428b3c00.jpg,/e-commerce/img/products/032e9ec22c64ad216191fdec4f54cb73.jpg,/e-commerce/img/products/96eb3cbceccedbe3c37bb9b24a0a2780.jpg,/e-commerce/img/products/0aae04a532b167d5a4359e0f5c6c4c09.jpg', 'dddddddddddddddddddddddddddddddddddddd', 1, 'Smal:0:', 0),
(21, 'test', '2.00', '2.00', '3', '14', '/e-commerce/img/products/d395a5e11e4586509ca73a6797e44df6.png,/e-commerce/img/products/ea4c8adb62d1c122c10cf96b7caca435.png,/e-commerce/img/products/1c1488ebc538c025a4f25fd0e9f8b560.png,/e-commerce/img/products/42d715633fb5760c91af59b78266cb3d.png,/e-commerce/img/products/8f7c77f14d268c77689ba271d91b136b.png,/e-commerce/img/products/84d74b9e20ae8b247708485196858f19.png', 'ddddddddddd', 1, 'BIG:25:1', 0),
(22, 'Dress', '15.00', '155.00', '3', '14', '/e-commerce/img/products/cb3afd14ecbcf71360aceaa1e93af1e1.jpg,/e-commerce/img/products/53f5f235cca12d49ef8720f44ddd76b7.jpg,/e-commerce/img/products/1ab5b4c6bfe5b7fa364d02d6eaf84e54.jpg,/e-commerce/img/products/b9bada5714b9cac456767af17f00c3a0.jpg,/e-commerce/img/products/ef273bf757344f8905b5594c0c297c79.jpg,/e-commerce/img/products/95690074bc661d44b2c0dc682d25f2e0.jpg,/e-commerce/img/products/7edb6b6f53095a792b8744e7d687d244.jpg', 'dddddddddd', 1, 's:11:1', 0),
(23, 'Men&#039;s Pants', '25.00', '25.99', '3', '6', '/e-commerce/img/products/2e1db3153993437d0959cd539fd4e993.png,/e-commerce/img/products/339463032d937c60b084e06f36c7ea54.png,/e-commerce/img/products/8e3d7054d067f09ca31a78efcd7dc111.png,/e-commerce/img/products/8992ec6c88e62eaf1bc064b560f3670f.png,/e-commerce/img/products/37215ea94922e5c08b98637a52650487.png', 'All the pants are nice. please buy it.', 1, 'XXL:15:1,Medium:10:1,Small:13:', 0),
(24, 'test', '1.00', '1.00', '3', '14', '/e-commerce/img/products/c21c00e23d2a6a92782887856b3eacf8.png,/e-commerce/img/products/4bb10d2459c87d95e9b6fa6b1e4d5f56.png,/e-commerce/img/products/ce7074776970183419dde7212bc37b2b.png,/e-commerce/img/products/0cf100b3650475f83e8e5c1c58bf8d91.png', 'Girls Dress\r\n', 1, 'Big:11:1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `state`, `zip_code`, `country`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, '1', 10, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '403.96', '35.14', '439.10', '4 items from our shop.', '1', '2017-04-30 01:30:49'),
(2, '1', 11, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '119.95', '10.44', '130.39', '5 items from our shop.', '1', '2017-04-30 17:52:09'),
(3, '1', 11, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '119.95', '10.44', '130.39', '5 items from our shop.', '1', '2017-04-30 17:52:53'),
(4, '1', 11, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '119.95', '10.44', '130.39', '5 items from our shop.', '1', '2017-04-30 17:53:26'),
(5, '1', 11, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '119.95', '10.44', '130.39', '5 items from our shop.', '1', '2017-04-30 17:53:31'),
(6, '1', 12, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '59.98', '5.22', '65.20', '2 items from our shop.', '1', '2017-04-30 17:54:42'),
(7, '1', 13, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '199.96', '17.40', '217.36', '4 items from our shop.', '1', '2017-04-30 17:55:33'),
(8, '1', 0, '', '', '', '', '', '', '', '', '0.00', '0.00', '0.00', '', '1', '2017-04-30 18:30:56'),
(9, '1', 16, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '89.99', '7.83', '97.82', '1 item from our shop.', '1', '2017-04-30 19:45:01'),
(10, '1', 17, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '89.99', '7.83', '97.82', '1 item from our shop.', '1', '2017-04-30 19:45:32'),
(11, '1', 18, 'Vjara Di Giammarino', 'usmanganikhan.khan2@gmail.com', 'Via Luvee, 16A', 'Stabio', 'Ticino', 'Ticino', '6855', 'Switzerland', '89.99', '7.83', '97.82', '1 item from our shop.', '1', '2017-04-30 19:46:43'),
(12, '1', 19, 'Vjara Di Giammarino', 'ugkhan2@gmail.com', 'Via Luvee, 16A', 'Stabio', 'Milano', 'Italy', '20121', 'Italy', '0.00', '0.00', '0.00', '1 item from our shop.', '1', '2017-04-30 19:52:14'),
(13, '1', 20, 'Simeon', 'simo@abv.bg', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '100.98', '8.79', '109.77', '2 items from our shop.', '1', '2017-05-01 13:59:48'),
(14, '1', 21, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '149.95', '13.05', '163.00', '5 items from our shop.', '1', '2017-05-01 18:23:34'),
(15, '1', 21, 'Usman Gani Khan', 'usmanganikhan.khan2@gmail.com', 'Block- Prostor, 4th floor, Ap-8, street- Vucha2, Alei vazrazdane', '', 'Ruse', 'Bulgaria', '7012', 'Bulgaria', '149.95', '13.05', '163.00', '5 items from our shop.', '1', '2017-05-01 18:26:38'),
(16, '1', 22, 'Vjara Di Giammarino', 'usmanganikhan.khan2@gmail.com', 'Via Luvee, 16A', 'Stabio', 'Ticino', 'Ticino', '6855', 'Switzerland', '249.95', '21.75', '271.70', '5 items from our shop.', '1', '2017-05-01 18:27:07'),
(17, '1', 22, 'Vjara Di Giammarino', 'usmanganikhan.khan2@gmail.com', 'Via Luvee, 16A', 'Stabio', 'Ticino', 'Ticino', '6855', 'Switzerland', '249.95', '21.75', '271.70', '5 items from our shop.', '1', '2017-05-01 18:27:07'),
(18, '1', 23, 'Vjara Di Giammarino', 'ugkhan2@gmail.com', 'Via Luvee, 16A', 'Stabio', 'Milano', 'Italy', '20121', 'Italy', '100.99', '8.79', '109.78', '1 item from our shop.', '1', '2017-05-01 18:28:02'),
(19, '1', 24, 'Vjara Di Giammarino', 'ugkhan2@gmail.com', 'Via Luvee, 16A', 'Stabio', 'Milano', 'Italy', '20121', 'Italy', '359.94', '31.31', '391.25', '6 items from our shop.', '1', '2017-05-01 18:32:40'),
(20, '1', 25, 'Something', 'something@something.com', 'dd', 'ssk', 'dkdkjk', 'dkjkdjjdk', '1014', 'dk', '60.00', '5.22', '65.22', '4 items from our shop.', '1', '2017-05-01 21:43:06'),
(21, '1', 26, 'Something', 'something@something.com', 'dd', 'ssk', 'dkdkjk', 'dkjkdjjdk', '1014', 'Denmark', '2.00', '0.17', '2.17', '1 item from our shop.', '1', '2017-05-01 21:45:27'),
(22, '1', 27, 'Something', 'something@something.com', 'dd', 'ssk', 'dkdkjk', 'dkjkdjjdk', '1014', 'Denmark', '989.89', '86.12', '1076.01', '11 items from our shop.', '1', '2017-05-12 22:23:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `panelusers`
--
ALTER TABLE `panelusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `panelusers`
--
ALTER TABLE `panelusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
