-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 08:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`) VALUES
(95, 'Smith Dainielle L Romero', 'Block 30 Lot 9 Gold Street, Phase 1 Sapang Biabas');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total_amount` double NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_number`, `customer_id`, `payment_method`, `total_amount`, `order_date`) VALUES
(85, 'ORDER-67e2bb4b6d5db2.37110743', 95, 'COD', 99, '2025-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `orders_product`
--

CREATE TABLE `orders_product` (
  `order_qty_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_product`
--

INSERT INTO `orders_product` (`order_qty_id`, `orders_id`, `product_id`, `quantity`, `price`) VALUES
(89, 85, 5, 1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_category`, `product_price`) VALUES
(1, 'Meow-Nat', 'Our adorable cat-shaped donut!', 'Best_Seller', 59),
(2, 'Cloud Cake', 'Fluffy layers of our Cloud Cake, a heavenly chocolate treat that melts in your mouth.', 'Best_Seller', 119),
(3, 'Cafe-Chino', 'Sip into perfection with our Cafe-Chino, a smooth and creamy cappuccino that\'s just right.', 'Best_Seller', 109),
(4, 'Mel-Drizzle', 'Enjoy the rich, buttery sweetness of our Mel-Drizzle! A perfect caramel touch to elevate your coffee or desert.', 'Best_Seller', 109),
(5, 'AMERICANO', 'Simple, bold, and classic. Our Americano is a smooth black coffee that delivers rich flavor with every sip.', 'Coffee', 99),
(6, 'SALTED CARAMEL', 'A rich, buttery caramel flavor with a hint of sea salt for a delicious twist on your favorite treat!\r\n\r\n', 'Coffee', 129),
(7, 'CARAMEL CHOCO', 'A perfect blend of bold coffee and smooth chocolate. Every sip is a delicious mix of rich flavors!', 'Coffee', 119),
(8, 'MACHA FOAM', 'Smooth matcha topped with creamy foam—light, flavorful, and refreshing!', 'Matcha', 129),
(9, 'MACHA CHINO', 'A frothy, creamy matcha drink, just like a cappuccino. Warm and delicious!', 'Matcha', 109),
(10, 'BERRY-BATH', 'Dive into the refreshing taste of Berry Bath—a bubbly mix of sweet strawberry and soda for a fruity, fizzy delight!', 'Fruit_Drinks', 139),
(11, 'BLUE WINTER', 'Chill out with Blue Winter—a refreshing blend of zesty lemonade and soda with a cool blue twist!', 'Fruit_Drinks', 139),
(12, 'JUNGLE BASE', 'Cool off with Jungle\'s Base—an irresistible avocado shake that\'s creamy, smooth, and refreshingly unique!', 'Fruit_Drinks', 139),
(13, 'HEAVY BFAST', 'Start your day with Heavy Bfast—a thick, fluffy pancake drizzled with rich chocolate syrup.', 'Snacks', 139),
(14, 'CHEESY TATOES BALLS', 'Crispy, gooey cheesy potato balls—pure deliciousness in every bite!', 'Snacks', 99),
(15, 'Meow-Nat', 'Our adorable cat-shaped donut!', 'Snacks', 59),
(16, 'Cloud Cake', 'Fluffy layers of our Cloud Cake, a heavenly chocolate treat that melts in your mouth.', 'Snacks', 119),
(17, 'Cafe-Chino', 'Sip into perfection with our Cafe-Chino, a smooth and creamy cappuccino that\'s just right.', 'Coffee', 109),
(18, 'Mel-Drizzle', 'Enjoy the rich, buttery sweetness of our Mel-Drizzle! A perfect caramel touch to elevate your coffee or desert.', 'Coffee', 109),
(19, 'Iced Mocha', 'Indulge in the perfect harmony of rich espresso and velvety chocolate syrup, blended with creamy milk and served over ice.', 'Best_Seller', 110),
(25, 'Cascade Special', 'This is one of the most popular products of Cascade it is Mocha de Matcha with its aroma that makes you addicted.', 'Best_Seller', 69);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(6, 'admin123', '$2y$10$QzoX2YecAdlwtpLVPj/5e.05Ye7k/q/AY/2qZvClmxfFKGjQZ8QVG'),
(7, 'Mika', '$2y$10$feXmPq/Zr2QcmmTW0AdzAuFNwXso2fhXE7FBkAUWDjRPrGuy0rdCO'),
(8, 'Smith', '$2y$10$Fz7i2AdzYuoBXMEDsw5tSOH2MvOwTlqHGJQgTtE4Hix3JrBQK4O7C'),
(9, 'Kenneth', '$2y$10$en0YDIYMlIQ8IR.LzpnW9e6oZEWTmCF8H.JAxYPn2GhoLKMfw6D66'),
(10, 'Jaren', '$2y$10$zzVd0MwmnOeI66Y94EDECOIWFL49xinbaXdUEwOQOlfE2KEaXLZYO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD PRIMARY KEY (`order_qty_id`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `orders_product`
--
ALTER TABLE `orders_product`
  MODIFY `order_qty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD CONSTRAINT `orders_product_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`orders_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
