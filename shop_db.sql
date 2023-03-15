-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023 年 05 月 30 日 14:33
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shop_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(10, 10, 3, 'Vivo V21e', 900, 3, '0000696_vivo-v21e-128gb-8gb-ram-original-malaysia-set_625.jpeg'),
(11, 10, 2, 'Oppo A95', 800, 1, 'a95-black-silver-1920.png'),
(22, 7, 6, 'Iphone 14 Pro Max', 5574, 1, '596688-Product-0-I-637982218040540343.webp');

-- --------------------------------------------------------

--
-- 資料表結構 `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `delivery_status` varchar(20) NOT NULL DEFAULT 'packing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `delivery_status`) VALUES
(4, 2, 'yang', '0111056058', 'tankaiyang225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Vivo V27 (1799 x 1) - ', 1799, '2023-05-10', 'completed', 'packing'),
(5, 2, 'yang', '0111056058', 'tankaiyang225@hotmail.com', 'touchngo', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Vivo V21e (900 x 1) - ', 900, '2023-05-10', 'completed', 'shipped'),
(6, 2, 'yang', '0111056058', 'tankaiyang225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Oppo A95 (800 x 1) - ', 800, '2023-05-16', 'pending', 'packing'),
(7, 9, 'yang', '0111056058', 'tankaiyang225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Oppo A95 (800 x 1) - ', 800, '2023-05-19', 'pending', 'packing'),
(8, 9, 'yang', '01110560583', 'tankaiyang225@hotmail.com', 'touchngo', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Vivo V27 (1799 x 1) - ', 1799, '2023-05-19', 'pending', 'packing'),
(9, 9, 'yang', '01110560583', 'tankaiyang225@hotmail.com', 'paypal', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Oppo A91 (500 x 1) - ', 500, '2023-05-19', 'pending', 'packing'),
(10, 9, 'teok', '01110560583', 'teok225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Oppo A95 (800 x 1) - Vivo V27 (1799 x 1) - ', 2599, '2023-05-26', 'pending', 'packing'),
(11, 7, 'yang', '01110560583', 'tankaiyang225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - ', 'Vivo V27 (1799 x 1) - Honor Magic 5 (3109 x 1) - ', 4908, '2023-05-30', 'pending', 'packing'),
(12, 7, 'yang', '01110560583', 'tankaiyang225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Huawei P60 (3169 x 1) - ', 3169, '2023-05-30', 'pending', 'packing'),
(13, 7, 'yang', '01110560583', 'tankaiyang225@hotmail.com', 'credit card', 'flat no. 123, 123, Melaka Tengah, Melaka, Malaysia - 75400', 'Huawei Y90 (849 x 1) - Iphone 14 (3749 x 1) - ', 4598, '2023-05-30', 'pending', 'packing');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'Vivo V27', 'The Vivo V27 is a smartphone model produced by Vivo, a Chinese electronics company. It was released in December 2021 and is a mid-range device that offers several notable features.\r\n\r\nThe Vivo V27 comes with a 6.44-inch full-HD+ AMOLED display with a resolution of 1080x2400 pixels. It is powered by a MediaTek Dimensity 900 SoC and runs on the Android 11-based Funtouch OS 12.5 operating system. The device has a 64-megapixel primary camera, an 8-megapixel ultra-wide-angle lens, and a 2-megapixel d', 1550, 'V27.jpg', 'Vivo-V27.jpg', 'Vivo-V27-Noble-Black.jpg'),
(2, 'Oppo A95', 'The Oppo A95 is a mid-range smartphone model produced by Oppo, a Chinese electronics company. It was released in November 2021 and offers several notable features.\r\n\r\nThe Oppo A95 comes with a 6.43-inch full-HD+ AMOLED display with a resolution of 1080x2400 pixels. It is powered by a MediaTek Helio P95 SoC and runs on the Android 11-based ColorOS 11.1 operating system. The device has a triple camera setup on the rear, consisting of a 64-megapixel primary camera', 944, 'a95-black-silver-1920.png', 'Oppo-A95-4G-image.jpg', 'oppo-a95-5g.jpg'),
(3, 'Vivo V21e', 'The Vivo V21e comes with a 6.44-inch full-HD+ AMOLED display with a resolution of 1080x2400 pixels. It is powered by a Qualcomm Snapdragon 720G SoC and runs on the Android 11-based Funtouch OS 11.1 operating system. The device has a dual camera setup on the rear, consisting of a 64-megapixel primary camera and an 8-megapixel ultra-wide-angle lens. On the front, it has a 44-megapixel selfie camera.', 889, 'vivo-v21e-5g-1.jpg', '0000696_vivo-v21e-128gb-8gb-ram-original-malaysia-set_625.jpeg', '792c5acb8066810465e50339245e1b47.png'),
(5, 'Oppo A91', 'The OPPO A91 is a smartphone model produced by the Chinese electronics company, OPPO. Here are some details about the OPPO A91 based on information available up until my knowledge cutoff in September 2021. Please note that there might have been newer models released since then, so it&#39;s advisable to check for the latest information from official sources.', 749, 'oppoa91.png', 'oppo91.jpg', '0000427_oppo-a91-2020-128gb-8gb-ram-malaysia-set_625.jpeg'),
(6, 'Iphone 14 Pro Max', 'The iPhone 14 pro max may introduce a new design language, potentially featuring a refined form factor with a sleeker profile and improved build materials. Apple tends to make design updates every few years, so it&#39;s possible that the iPhone 14 pro max could feature a fresh aesthetic.It&#39;s expected that the iPhone 14 pro max will have an improved display with enhanced resolution, color accuracy, and possibly a higher refresh rate. Apple has been gradually adopting OLED technology for its i', 5574, '596688-Product-0-I-637982218040540343.webp', 'iphone-14-pro_overview__3dn6st99cpea_og.png', 'iphone-14-pro-model-unselect-gallery-2-202209.jpeg'),
(7, 'Iphone 14', 'The iPhone 14 may introduce a new design language, potentially featuring a refined form factor with a sleeker profile and improved build materials. Apple tends to make design updates every few years, so it&#39;s possible that the iPhone 14 could feature a fresh aesthetic.', 3749, 'Apple-iPhone-14-iPhone-14-Plus-yellow-2up-230307_inline.jpg.large.jpg', '0150311_smartphone-apple-iphone-14-6-1-6-gb-128-gb-ios-plavi-010301122.jpg', 'iphone-14-finish-select-202209-6-1inch-purple.jpeg'),
(8, 'Huawei P60', 'The P60 series has already been revealed in China, where it launched on 23 March alongside the Mate X3 foldable phone. The Pro model was given an international launch on 9 May, and is available now direct from Huawei in the UK and Europe.', 3169, 'azure-blue.png', 'HUAWEI-P60-Art-05-635x635.webp', 'huawei-p60-art-kv.jpg'),
(9, 'Huawei Y90', 'Huge battery capacity. Comes with 40W fast charging support. Side-mounted fingerprint scanner. Tall IPS LCD display with 90Hz refresh rate.', 849, 'huawei-nova-y90-colour2.png', 'huawei-nova-y90-colour3.png', 'blue.png'),
(10, 'Honor Magic VS', 'Foldable phones are the latest innovation in the smartphone industry, offering a new form factor that combines a traditional smartphone’s portability with a tablet’s screen real estate. With foldable phones, users can enjoy larger displays and improved device flexibility. The HONOR Magic Vs device offers a large, foldable OLED display and high-end features. This article will explore the potential advantages of foldable phones like the HONOR Magic Vs, including their large screen size.', 5249, 'gsmarena_003.jpg', '0020740_honor-magic-vs-12gb-ram-512gb-rom-original-honor-malaysia_511.png', 'magic-kv-mob.jpg'),
(11, 'Honor Magic 5', 'Honor Magic5 Pro comes with connectivity options such as Wi-Fi, Bluetooth, GPS, USB, 3G, 4G & 5G, It has cameras with many features, The quality of the produced photos is very good in both natural & low light conditions, It offers better viewing angles & lower power consumption.', 3109, '202302280114242719.jpg', 'fb.jpg', 'honor-magic5-series-my01.webp');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `contact`) VALUES
(7, 'yang', 'tankaiyang225@hotmail.com', '28f6cbf2da9e2776bef90cf6ea6e055087be563b', ''),
(8, 'teok', 'xiaoxuan6857@gmail.com', '28f6cbf2da9e2776bef90cf6ea6e055087be563b', ''),
(9, 'teok', 'teok225@hotmail.com', '28f6cbf2da9e2776bef90cf6ea6e055087be563b', ''),
(10, 'pot', 'iwer232@gmail.com', '28f6cbf2da9e2776bef90cf6ea6e055087be563b', '');

-- --------------------------------------------------------

--
-- 資料表結構 `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
