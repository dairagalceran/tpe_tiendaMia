-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-11-2021 a las 13:32:15
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'pantalones'),
(2, 'remeras'),
(4, 'sweaters'),
(28, 'camisas'),
(29, 'camperas'),
(34, 'sacones'),
(35, 'Bermudas'),
(37, 'vestidos verano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `score` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `comment`, `score`, `id_product`, `id_user`, `created_at`) VALUES
(2, '2ER Comentario', 5, 37, 38, '2021-11-24 16:46:44'),
(3, '3er Comentario', 2, 22, 39, '2021-11-24 16:46:44'),
(8, 'desde la db', 4, 53, 38, '2021-11-24 16:46:44'),
(9, 'dasdadsa', 1, 22, 39, '2021-11-24 17:01:57'),
(10, 'dasdadsa', 1, 22, 39, '2021-11-24 17:05:24'),
(11, 'dasdadsa', 1, 22, 39, '2021-11-24 17:09:10'),
(12, 'dasdadsa', 1, 22, 39, '2021-11-24 17:09:12'),
(13, 'ssss', 1, 22, 39, '2021-11-24 17:11:33'),
(14, 'ssss', 1, 22, 39, '2021-11-24 17:13:00'),
(15, 'ssss', 4, 22, 39, '2021-11-24 17:20:46'),
(16, 'ssss', 4, 22, 39, '2021-11-24 17:20:56'),
(17, 'ssss', 4, 22, 39, '2021-11-24 17:22:31'),
(18, 'ssss', 4, 22, 39, '2021-11-24 17:25:26'),
(19, 'ssss', 4, 22, 39, '2021-11-24 17:29:00'),
(20, 'ssss', 4, 22, 39, '2021-11-24 17:29:01'),
(21, 'dedede', 1, 22, 39, '2021-11-24 17:29:11'),
(24, 'probando', 2, 22, 39, '2021-11-24 17:38:12'),
(25, 'probando', 2, 22, 39, '2021-11-24 17:38:51'),
(26, 'probando', 2, 22, 39, '2021-11-24 17:40:18'),
(27, 'probando', 2, 22, 39, '2021-11-24 17:40:30'),
(28, 'ale', 1, 22, 33, '2021-11-24 17:49:46'),
(29, 'asdas', 1, 22, 39, '2021-11-24 17:54:24'),
(30, '', 1, 22, 33, '2021-11-24 17:59:21'),
(31, '', 1, 22, 33, '2021-11-24 17:59:23'),
(32, '', 1, 22, 33, '2021-11-24 17:59:50'),
(33, 'aasdasd', 1, 22, 33, '2021-11-24 18:03:49'),
(34, 'aasdasd', 1, 22, 33, '2021-11-24 18:04:05'),
(40, 'adasaaxxx', 3, 27, 33, '2021-11-24 18:52:17'),
(42, 'sasasasasasasasasasasasasasas', 1, 27, 33, '2021-11-24 18:56:37'),
(46, 'dsadadadsas', 1, 27, 33, '2021-11-24 19:04:16'),
(47, 'sddcd ksdskd sldsdsd', 3, 27, 33, '2021-11-24 19:04:58'),
(48, 'desde que te fuite ', 3, 27, 33, '2021-11-24 19:05:30'),
(49, 'dadasdas', 1, 39, 39, '2021-11-24 19:12:34'),
(50, 'ddddddd', 4, 39, 39, '2021-11-24 19:12:47'),
(51, 'rererwrwrwrasfss', 1, 40, 33, '2021-11-24 19:40:24'),
(52, 'dddaszczxczxczxcxz', 1, 58, 39, '2021-11-24 19:45:31'),
(53, 'sssdasdsss', 1, 59, 39, '2021-11-24 20:00:40'),
(54, 'dasasdsasdda', 3, 59, 39, '2021-11-24 20:01:40'),
(55, 'eeeeeeee', 1, 59, 39, '2021-11-24 20:02:51'),
(56, 'estino', 4, 45, 33, '2021-11-24 23:23:07'),
(57, 'destino ', 3, 45, 33, '2021-11-24 23:23:17'),
(58, 'saprarete', 4, 50, 33, '2021-11-25 00:24:11'),
(59, 'rrrrrrrr', 1, 58, 33, '2021-11-25 04:03:28'),
(60, 'rewrwerwerwewer', 4, 58, 33, '2021-11-25 04:03:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `size` varchar(5) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `size`, `image`, `category_id`) VALUES
(22, 'pullover azul', 10101, 'L', NULL, 4),
(23, 'Remera piquet blanca', 2399.54, 'M', NULL, 2),
(27, 'sans days', 5200, 'XL', NULL, 1),
(28, 'chenille escote en V', 3400, 'M', NULL, 34),
(29, 'polar cierre ', 3799, 'XXL', NULL, 4),
(30, 'slim fit hombre blanca a rayas', 3469, 'XS', NULL, 28),
(37, 'valentin beige', 2300, 'XS', NULL, 37),
(38, 'lino rouge', 6599, 'M', NULL, 34),
(39, 'fit denim', 324.45, 'XS', NULL, 28),
(40, 'jean recto  negro ', 4569, 'XS', NULL, 1),
(42, 'winterNow', 3244.5, 'XL', NULL, 4),
(43, 'rompeviento reversible', 5401, 'M', NULL, 29),
(44, 'vanish style', 1790, 'XXL', NULL, 2),
(45, 'sateniers probando modiicar', 2345, 'M', NULL, 1),
(46, 'clasic T-shirt', 2345, 'XS', NULL, 2),
(47, 'tommy recta', 7324.45, 'M', NULL, 35),
(50, 'prune redwine', 12222, 'XXL', NULL, 1),
(53, 'naranja', 6000.78, 'XXL', NULL, 4),
(54, 'das', 2590.98, 'XS', NULL, 29),
(55, 'pantalon', 4343, 'XS', NULL, 1),
(56, 'campera deportiva', 2222, 'XS', NULL, 1),
(58, 'dessasaa', 12, 'XS', NULL, 1),
(59, 'pullover azulino', 34444.6, 'XS', NULL, 1),
(60, 'esperanza', 2000, 'S', NULL, 2),
(61, 'esperanza probando', 2000, 'S', NULL, 2),
(62, 'esperanza', 2000, 'S', NULL, 2),
(66, 'asdasdassa', 2, 'XS', NULL, 2),
(68, 'asdasdassa', 1, 'XS', NULL, 2),
(71, 'pullover azul', 11111, 'XS', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(15) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`) VALUES
(33, 'Daira Galceran', 'daira@gmail.com', '$2y$10$fw3uMeWAMyxsP6ZMv.5nPOadMSqpBR.kx3pJBbvDkvPhNj4aBtLsy', 1),
(38, 'Francisco', 'fran@demo.com', '$2y$10$xD0xbctDToE02u9iuU/4XeREDa5aZWn1X5dKVL9rVYe1CzZAu/UgG', 0),
(39, 'logged', 'loged@demo.com', '$2y$10$v3dECiaPSTtWnN6lIbcjoesLiXSG25pMGiQwnAGHnUE5Cc/9/0Xo2', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_products_fk` (`id_product`),
  ADD KEY `comments_users_fk` (`id_user`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_products_fk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_users_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
