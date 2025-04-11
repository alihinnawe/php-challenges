-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 11. Apr 2025 um 15:44
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `rentease`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Electronics', 'Devices such as laptops, cameras, and smartphones available for rent'),
(2, 'Vehicles', 'Cars, motorcycles, and bicycles available for rent'),
(3, 'Furniture', 'Tables, chairs, and sofas for temporary use'),
(4, 'Tools & Equipment', 'Construction and home improvement tools for short-term use'),
(5, 'Clothing & Accessories', 'Special event outfits, costumes, and accessories'),
(6, 'Sports & Outdoors', 'Camping gear, bicycles, and sports equipment'),
(7, 'Photography & Videography', 'Cameras, lenses, drones, and accessories'),
(8, 'Home Appliances', 'Washing machines, refrigerators, and kitchen appliances'),
(9, 'Event & Party Supplies', 'Speakers, tents, chairs, and decorations for events'),
(10, 'Musical Instruments', 'Guitars, keyboards, drums, and other instruments'),
(11, 'Games & Consoles', 'Video game consoles and board games'),
(12, 'Medical Equipment', 'Wheelchairs, crutches, and other healthcare-related items'),
(13, 'Office Equipment', 'Printers, projectors, and office furniture'),
(14, 'Luxury Items', 'Designer bags, watches, and high-end accessories'),
(15, 'Water Sports Equipment', 'Kayaks, paddleboards, and jet skis'),
(16, 'Winter Gear', 'Ski equipment, snowboards, and winter clothing'),
(17, 'Drones & RC Toys', 'Drones, remote-controlled cars, and aircraft'),
(18, 'Pet Supplies', 'Pet carriers, training equipment, and temporary housing');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `price_per_week` decimal(10,2) DEFAULT NULL,
  `price_per_month` decimal(10,2) DEFAULT NULL,
  `availability_status` enum('available','rented','unavailable') DEFAULT 'available',
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `condition_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `item_condition`
--

CREATE TABLE `item_condition` (
  `id` int(11) NOT NULL,
  `condition_type` enum('New','Like New','Used','Damaged') NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `item_location`
--

CREATE TABLE `item_location` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `read_status` enum('read','unread') DEFAULT 'unread',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `card_type` enum('credit','debit','paypal') NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `cardholder_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `weight` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('available','out of stock','discontinued') DEFAULT 'available',
  `rating` decimal(3,2) DEFAULT 0.00,
  `tags` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `product_length` int(11) GENERATED ALWAYS AS (char_length(`product_name`)) STORED,
  `product_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_price`, `sku`, `category`, `stock_quantity`, `weight`, `length`, `width`, `height`, `color`, `size`, `brand`, `image_url`, `discount_price`, `created_at`, `updated_at`, `status`, `rating`, `tags`, `related_products`, `product_image`) VALUES
(5, 'Running Shoes Speed v', 'Lightweight running shoes designed for speed and comfort.', 120.00, 'SKU12349', 'Footwear', 100, 0.80, 28.00, 10.00, 12.00, 'Red', '10', 'SportsGear', 'images/running-shoes.jpg', 110.00, '2025-03-14 10:53:30', '2025-04-11 15:09:48', 'available', 4.60, 'shoes, running, sports', '14,15,16', 'images/running_shoes_speed.jpg'),
(6, 'Electric Kettle Pro', 'A fast-boiling electric kettle with a stainless steel body and auto-shutoff feature.', 39.99, 'SKU12350', 'Home Appliances', 75, 1.20, 25.00, 18.00, 10.00, 'Silver', 'N/A', 'HomeTech', 'images/electric-kettle.jpg', 29.99, '2025-03-14 10:53:30', '2025-04-03 14:17:41', 'available', 4.40, 'kettle, home, appliances', '17,18,19', 'images/electric_kettle_pro.jpg'),
(7, 'Organic Green Tea ali', 'A box of premium organic green tea with soothing properties.', 15.99, 'SKU12351', 'Food & Beverages', 300, 0.05, 10.00, 10.00, 5.00, 'Green', 'N/A', 'TeaCo', 'images/green-tea.jpg', 12.99, '2025-03-14 10:53:30', '2025-04-11 14:42:29', 'available', 4.80, 'tea, organic, beverages', '20,21,22', 'images/organic_green_tea.jpg'),
(8, 'Gaming Laptop Z500', 'A high-performance laptop for gaming with advanced cooling system and great graphics.', 1499.99, 'SKU12352', 'Electronics', 15, 2.50, 35.00, 25.00, 2.00, 'Black', 'N/A', 'GameMaster', 'images/gaming-laptop.jpg', 1399.99, '2025-03-14 10:53:30', '2025-04-03 14:17:41', 'available', 4.90, 'laptop, gaming, high-performance', '23,24,25', 'images/gaming_laptop_z500.jpg'),
(12, 'Blue Jeans', 'Stylish blue jeans with a slim fit. Perfect for everyday wear.', 49.99, 'JEANS001', 'Clothing', 40, 1.00, 30.00, 40.00, 5.00, 'Blue', '32', 'BrandY', 'https://cdn03.plentymarkets.com/0f5s7pecmais/item/images/45031/middle/45031-Mustang--Oregon-Boot-1006280-5000-682-vo-1-.jpg.avif', 39.99, '2023-02-10 00:00:00', '2025-04-03 14:17:41', 'available', 4.00, 'denim, slim fit, blue', 'JEANS002,TSHIRT001', 'images/blue_jeans.jpg'),
(13, 'Sports Watch', 'Water-resistant sports watch with multiple features like step count and heart rate monitoring.', 129.99, 'WATCH001', 'Accessories', 30, 0.30, 10.00, 10.00, 2.00, 'Black', 'One Size', 'BrandZ', 'https://www.switchbacktravel.com/sites/default/files/articles%20/GPS%20watch%20%28closeup%20of%20Coros%20Apex%20screen%20-%20m%29.jpg', 119.99, '2023-01-01 00:00:00', '2025-04-03 14:17:41', 'available', 4.80, 'sports, watch, fitness', 'WATCH002,TSHIRT003', 'images/sports_watch.jpg'),
(14, 'Running Shoes ali', 'Comfortable running shoes designed for high performance and durability.', 89.99, 'SHOES001', 'Footwear', 25, 0.80, 28.00, 12.00, 10.00, 'Red', '10', 'BrandA', 'https://www.melbournepodiatryclinic.net.au/wp-content/uploads/2023/01/asics-choose-running-shoes-lp-article-06032022-2.jpg', 79.99, '2023-03-01 00:00:00', '2025-04-11 14:42:19', 'available', 4.60, 'sports, shoes, red', 'SHOES002,JEANS001', 'images/running_shoes.jpg'),
(15, 'Leather Wallet', 'Premium leather wallet with multiple card slots and a sleek design.', 39.99, 'WALLET001', 'Accessories', 50, 0.20, 9.00, 12.00, 2.00, 'Brown', 'One Size', 'BrandB', 'https://memoriesmade.ca/cdn/shop/files/WalletCustomEngraved65465d.jpg', 34.99, '2023-02-20 00:00:00', '2025-04-03 14:17:41', 'available', 4.70, 'leather, wallet, brown', 'WALLET002,TSHIRT001', 'images/leather_wallet.jpg'),
(16, 'Smartphone Case', 'Durable phone case that fits your smartphone perfectly and protects from drops.', 15.99, 'CASE001', 'Accessories', 70, 0.10, 5.00, 10.00, 1.00, 'Black', 'One Size', 'BrandC', 'https://oceanmata.com/cdn/shop/products/Turtle_neu_13Pro_max_031f5bcf-b370-48ec-a36e-8a6e31d79408.jpg', 12.99, '2023-03-05 00:00:00', '2025-04-03 14:17:41', 'available', 4.20, 'phone, case, black', 'CASE002,SHOES001', 'images/smartphone_case.jpg'),
(17, 'Portable Speaker', 'Wireless portable speaker with high-quality sound and long battery life.', 49.99, 'SPEAKER001', 'Electronics', 60, 0.50, 18.00, 18.00, 8.00, 'Grey', 'One Size', 'BrandD', 'https://www.hifi-im-hinterhof.de/media/catalog/product/cache/e3585bf58f69aba2423741932ec44869/i/m/img141677_60436.jpg', 44.99, '2023-02-01 00:00:00', '2025-04-03 14:17:41', 'available', 4.40, 'electronics, speaker, portable', 'SPEAKER002,WALLET001', 'images/portable_speaker.jpg'),
(18, 'Bluetooth Headphones', 'Noise-cancelling Bluetooth headphones for clear sound and comfort.', 79.99, 'HEADPHONES001', 'Electronics', 35, 0.30, 15.00, 18.00, 8.00, 'Black', 'One Size', 'BrandE', 'https://www.einrichten-design.de/thumbnail/da/4a/01/1597941857/Kreafunk_aHEAD%20Bluetooth%20Headphones%20Kopfhoerer_12_1920x1920.jpg', 69.99, '2023-01-10 00:00:00', '2025-04-03 14:17:41', 'available', 4.60, 'electronics, headphones, bluetooth', 'HEADPHONES002,CASE001', 'images/bluetooth_headphones.jpg'),
(19, 'Desk Lamp', 'Adjustable desk lamp with LED light and touch controls.', 29.99, 'LAMP001', 'Furniture', 20, 1.50, 15.00, 10.00, 25.00, 'White', 'One Size', 'BrandF', 'https://www.dusklights.co.uk/images/mantra-looker-adjustable-desk-lamp-in-white-and-beech-wood-p9798-102623_medium.jpg', 24.99, '2023-03-01 00:00:00', '2025-04-03 14:17:41', 'available', 4.30, 'furniture, lamp, white', 'LAMP002,SHOES001', 'images/desk_lamp.jpg'),
(20, 'Office Chair', 'Ergonomic office chair with lumbar support and adjustable height.', 199.99, 'CHAIR001', 'Furniture', 15, 10.00, 60.00, 60.00, 100.00, 'Black', 'One Size', 'BrandG', 'https://example.com/images/chair1.jpg', 179.99, '2023-01-20 00:00:00', '2025-04-03 14:17:41', 'available', 4.90, 'furniture, office, chair', 'CHAIR002,LAMP001', 'images/office_chair.jpg'),
(21, 'Digital Camera', 'High-resolution digital camera with multiple lenses and autofocus.', 299.99, 'CAMERA001', 'Electronics', 12, 1.20, 20.00, 20.00, 15.00, 'Black', 'One Size', 'BrandH', 'https://example.com/images/camera1.jpg', 279.99, '2023-02-25 00:00:00', '2025-04-03 14:17:41', 'available', 4.70, 'electronics, camera, black', 'CAMERA002,HEADPHONES001', 'images/digital_camera.jpg'),
(22, 'Smartwatch', 'Fitness smartwatch with heart rate monitoring and sleep tracking features.', 159.99, 'SMARTWATCH001', 'Accessories', 40, 0.40, 5.00, 5.00, 1.00, 'Silver', 'One Size', 'BrandI', 'https://example.com/images/smartwatch1.jpg', 149.99, '2023-01-12 00:00:00', '2025-04-03 14:17:41', 'available', 4.80, 'accessories, smartwatch, silver', 'SMARTWATCH002,SHOES001', 'images/smartwatch.jpg'),
(23, 'Laptop Sleeve', 'Slim and durable laptop sleeve to protect your laptop from scratches and damage.', 29.99, 'SLEEVE001', 'Accessories', 45, 0.30, 40.00, 30.00, 1.00, 'Black', '13 inch', 'BrandJ', 'https://example.com/images/sleeve1.jpg', 24.99, '2023-02-15 00:00:00', '2025-04-03 14:17:41', 'available', 4.20, 'accessories, sleeve, laptop', 'SLEEVE002,JEANS001', 'images/laptop_sleeve.jpg'),
(24, 'Winter Jacket', 'Warm and stylish winter jacket with a waterproof layer.', 89.99, 'JACKET001', 'Clothing', 20, 1.50, 60.00, 50.00, 10.00, 'Navy Blue', 'L', 'BrandK', 'https://example.com/images/jacket1.jpg', 79.99, '2023-01-05 00:00:00', '2025-04-03 14:17:41', 'available', 4.60, 'clothing, winter, jacket', 'JACKET002,T-SHIRT001', 'images/winter_jacket.jpg'),
(25, 'Travel Backpack', 'Large and durable travel backpack with multiple compartments.', 69.99, 'BACKPACK001', 'Accessories', 35, 0.80, 40.00, 20.00, 50.00, 'Black', 'One Size', 'BrandL', 'https://example.com/images/backpack1.jpg', 59.99, '2023-02-05 00:00:00', '2025-04-03 14:17:41', 'available', 4.50, 'accessories, backpack, travel', 'BACKPACK002,SHOES001', 'images/travel_backpack.jpg'),
(26, 'Guitar', 'Acoustic guitar with great sound quality and easy-to-play strings.', 149.99, 'GUITAR001', 'Music', 15, 3.00, 100.00, 40.00, 10.00, 'Natural Wood', 'One Size', 'BrandM', 'https://example.com/images/guitar1.jpg', 139.99, '2023-02-12 00:00:00', '2025-04-03 14:17:41', 'available', 4.70, 'music, guitar, acoustic', 'GUITAR002,HEADPHONES001', 'images/guitar.jpg'),
(27, 'Smart Home Hub', 'Control your home appliances with this smart hub. Compatible with all smart devices.', 199.99, 'HUB001', 'Electronics', 10, 1.00, 15.00, 15.00, 5.00, 'White', 'One Size', 'BrandN', 'https://example.com/images/hub1.jpg', 179.99, '2023-03-10 00:00:00', '2025-04-03 14:17:41', 'available', 4.90, 'electronics, smart home, hub', 'HUB002,SMARTWATCH001', 'images/smart_home_hub.jpg'),
(28, 'Electric Kettle', 'Fast-boiling electric kettle with an automatic shut-off feature for safety.', 34.99, 'KETTLE001', 'Home Appliances', 55, 1.00, 25.00, 25.00, 30.00, 'Stainless Steel', 'One Size', 'BrandO', 'https://example.com/images/kettle1.jpg', 29.99, '2023-02-28 00:00:00', '2025-04-03 14:17:41', 'available', 4.50, 'home appliances, kettle, electric', 'KETTLE002,TSHIRT001', 'images/electric_kettle.jpg'),
(29, 'Tennis Racket', 'High-quality tennis racket designed for performance and control.', 79.99, 'RACKET001', 'Sports', 18, 0.50, 70.00, 30.00, 5.00, 'Black', 'One Size', 'BrandP', 'https://example.com/images/racket1.jpg', 69.99, '2023-01-30 00:00:00', '2025-04-03 14:17:41', 'available', 4.40, 'sports, racket, tennis', 'RACKET002,SHOES001', 'images/tennis_racket.jpg'),
(1, 'Smartphone X100', 'A high-end smartphone with a sleek design and powerful features.', 799.99, 'SKU12345', 'Electronics', 50, 0.20, 15.00, 7.50, 0.80, 'Black', 'N/A', 'TechBrand', 'images/smartphone-x100.jpg', 699.99, '2025-03-14 10:53:30', '2025-04-03 14:17:41', 'available', 4.50, 'smartphone, android, tech', '2,3,4', 'images/smartphone_x100.jpg'),
(2, 'Wireless Headphones Pro', 'Noise-canceling over-ear headphones with premium sound quality.', 199.99, 'SKU12346', 'Electronics', 120, 0.40, 20.00, 15.00, 5.00, 'White', 'One Size', 'SoundMaster', 'images/wireless-headphones.jpg', 179.99, '2025-03-14 10:53:30', '2025-04-03 14:17:41', 'available', 4.70, 'headphones, audio, wireless', '5,6,7', 'images/wireless_headphones_pro.jpg'),
(3, 'Bluetooth Speaker Xtreme', 'Portable Bluetooth speaker with deep bass and waterproof design.', 99.99, 'SKU12347', 'Electronics', 200, 1.00, 25.00, 10.00, 10.00, 'Blue', 'N/A', 'BassTech', 'images/bluetooth-speaker.jpg', 89.99, '2025-03-14 10:53:30', '2025-04-03 14:17:41', 'available', 4.30, 'speaker, bluetooth, portable', '8,9,10', 'images/bluetooth_speaker_xtreme.jpg'),
(0, 'pencil', 'school pencil', 0.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-11 15:04:32', '2025-04-11 15:07:34', 'available', 0.00, NULL, NULL, 'pencil.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `renter_id` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `rental_status` enum('active','completed','cancelled','returned') DEFAULT 'active',
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','pending','failed') DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  `payment_method` enum('credit_card','paypal','bank_transfer') NOT NULL,
  `status` enum('success','failed','pending') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_type` enum('admin','user') DEFAULT 'user',
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `full_name`, `phone_number`, `address`, `user_type`, `profile_picture_url`, `created_at`, `updated_at`) VALUES
(1, 'ali_hinnawe', 'ali@example.com', '$2b$12$TtJnPJ9I.j9T8RuYp/wLgu7a1zu5sMXbnJ/9QH25qy4QHEXasYu9u', 'Ali Hinnawe', '1234567890', 'Berlin 1', 'admin', 'ali.jpg', '2025-04-11 10:47:30', '2025-04-11 13:57:48'),
(2, 'sandra_user', 'sandra@example.com', '$2y$10$EHFWDs0VL0frDdX3ul0.LOmfrW6bVxMsqkM1Yi9Y4ZMDU4fbrRPRq', 'Sandra Casper', '0987654321', 'Berlin 2', 'user', 'sandra.jpg', '2025-04-11 10:47:42', '2025-04-11 15:38:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
