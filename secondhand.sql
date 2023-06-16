-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 16 jun 2023 kl 08:37
-- Serverversion: 5.7.39
-- PHP-version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `secondhand`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Toppar'),
(2, 'Byxor'),
(3, 'Jackor'),
(5, 'Väskor'),
(6, 'Accessoarer');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `date_received` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_sold` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `seller_id`, `size_id`, `date_received`, `date_sold`) VALUES
(1, 'Glittrig topp', 'Från Zara, perfekt skick!', 60, 1, 4, 3, '2023-05-16 00:00:00', '2023-06-09 16:19:48'),
(2, 'Grå jeans', 'Väl använda, inköpta för ett år sedan.', 100, 2, 1, 2, '2023-05-23 00:00:00', '2023-06-16 09:20:03'),
(3, 'Jeansjacka', 'Snygg jacka i nyskick!', 120, 3, 3, 4, '2023-05-02 00:00:00', '2023-06-09 15:31:49'),
(4, 'Läderväska', 'Läderväska vintage, bra skick.', 150, 5, 2, 8, '2023-05-06 00:00:00', '2023-06-09 11:45:36'),
(5, 'Solglasögon', 'Solglasögon från Prada.', 30, 6, 1, 8, '2023-05-14 00:00:00', '2023-06-09 11:45:36'),
(6, 'Örhängen', 'Fina örhängen i guld från Edblad', 139, 6, 6, 8, '2023-06-02 14:38:07', '2023-06-09 16:20:27'),
(7, 'Lila hoodie', 'I använt skick. Inköpt på Monki för ungefär ett år sen.', 139, 1, 2, 4, '2023-06-08 11:37:06', '2023-06-09 11:45:36'),
(8, 'Vit t-shirt med tryck', 'Snygg t-shirt i nyskick. Köpt på Zara för ett halvår sedan.', 65, 1, 4, 1, '2023-06-13 11:19:12', NULL),
(9, 'Blå t-shirt', 'Snygg t-shirt i nyskick. Köpt på Zara för ett halvår sedan.', 65, 1, 6, 4, '2023-06-16 09:19:37', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `sellers`
--

INSERT INTO `sellers` (`id`, `firstname`, `lastname`, `email_address`) VALUES
(1, 'Ida', 'Danielsson', 'ida.danielsson@medieinstitutet.se'),
(2, 'Cassandra', 'Book', 'cassandra.book@medieinstitutet.se'),
(3, 'Jesper', 'Söderhielm', 'jesper.soderhielm@medieinstitutet.se'),
(4, 'Stina', 'Larsson', 'stina_larsson@gmail.com'),
(5, 'Lasse', 'Larsson', 'lasse.larsson@hej.se'),
(6, 'Lotta', 'Skog', 'lottisskog@hej.se'),
(7, 'Marcus', 'Sandberg', 'm.sandberg@outlook.com'),
(8, 'Calle', 'Andersson', 'c.andersson@outlook.com');

-- --------------------------------------------------------

--
-- Tabellstruktur `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `sizes`
--

INSERT INTO `sizes` (`id`, `name`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(6, 'XL'),
(7, 'XXL'),
(8, 'One size');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_categoryId` (`category_id`),
  ADD KEY `Fk_sizeId` (`size_id`),
  ADD KEY `Fk_sellerId` (`seller_id`);

--
-- Index för tabell `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT för tabell `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Fk_categoryId` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `Fk_sellerId` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`),
  ADD CONSTRAINT `Fk_sizeId` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
