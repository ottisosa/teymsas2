-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 19:11:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `description_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `description_category`) VALUES
(4, 'Pared'),
(5, 'Techo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL,
  `name_city` varchar(30) NOT NULL,
  `id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id_city`, `name_city`, `id_department`) VALUES
(4, 'Colonia del sacramento', 3),
(5, 'Tarariras', 3),
(6, 'Juan lacaze', 3),
(7, 'Rafael peraza', 6),
(8, 'las piedras', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id_user_customer` int(11) NOT NULL,
  `document_customer` varchar(15) NOT NULL,
  `address_customer` varchar(255) NOT NULL,
  `business_name_customer` varchar(255) DEFAULT NULL,
  `rut_customer` varchar(50) DEFAULT NULL,
  `id_city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id_user_customer`, `document_customer`, `address_customer`, `business_name_customer`, `rut_customer`, `id_city`) VALUES
(5, '55377465', 'manuel De lobo 674', 'Complex', '92837465', 4),
(6, '45677654', 'magallanes de jose', '', '', 7),
(7, '54635241', 'piedras de la batalla 321', 'sheimsas', '', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_orders`
--

CREATE TABLE `customer_orders` (
  `id_customer_order` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `total_order` decimal(10,2) NOT NULL,
  `id_payment_method` int(11) NOT NULL,
  `id_order_status` int(11) NOT NULL,
  `updated_at_order` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deliveries`
--

CREATE TABLE `deliveries` (
  `id_delivery` int(11) NOT NULL,
  `id_customer_order` int(11) NOT NULL,
  `address_delivery` varchar(255) NOT NULL,
  `date_delivery` date NOT NULL,
  `status_delivery` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id_department` int(11) NOT NULL,
  `name_department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id_department`, `name_department`) VALUES
(3, 'colonia'),
(4, 'montevideo'),
(5, 'maldonado'),
(6, 'san jose'),
(7, 'canelones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images_product`
--

CREATE TABLE `images_product` (
  `id_image_product` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `description_image_product` varchar(100) NOT NULL,
  `url_image_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_products_customers`
--

CREATE TABLE `order_products_customers` (
  `id_order_product_customer` int(11) NOT NULL,
  `id_customer_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity_order_product_customer` int(11) NOT NULL,
  `unit_price_order_product_customer` decimal(10,2) NOT NULL,
  `total_order_product_customer` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_products_purchases`
--

CREATE TABLE `order_products_purchases` (
  `id_order_product_purchase` int(11) NOT NULL,
  `id_purchase_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity_order_product_purchase` int(11) NOT NULL,
  `unit_price_order_product_purchase` decimal(10,2) NOT NULL,
  `total_order_product_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_status`
--

CREATE TABLE `order_status` (
  `id_order_status` int(11) NOT NULL,
  `description_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_status`
--

INSERT INTO `order_status` (`id_order_status`, `description_status`) VALUES
(1, 'Pendiente'),
(2, 'En revision'),
(3, 'Cancelada'),
(4, 'En reparto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id_payment_method` int(11) NOT NULL,
  `name_payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_methods`
--

INSERT INTO `payment_methods` (`id_payment_method`, `name_payment_method`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta de credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `description_product` varchar(100) NOT NULL,
  `details_product` text DEFAULT NULL,
  `price_product` decimal(10,2) NOT NULL,
  `thumbnail_product` varchar(255) DEFAULT NULL,
  `stock_product` int(11) DEFAULT 0,
  `measures_product` varchar(255) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `updated_at_product` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `description_product`, `details_product`, `price_product`, `thumbnail_product`, `stock_product`, `measures_product`, `id_category`, `updated_at_product`, `updated_by_product`) VALUES
(18, 'Techo de isopanel blanco', 'Techo de isopanel con excelente aislamiento térmico y durabilidad. Fácil de instalar y mantener, ideal para proyectos residenciales, comerciales e industriales.', 10000.00, 'imagen', 15, '15cm', 5, '2024-11-11 14:27:21', 8),
(20, 'Pared isopanel blanca', 'Pared de isopanel con gran aislamiento térmico y acústico, ideal para proyectos rápidos y duraderos en entornos residenciales, comerciales e industriales.', 20000.00, 'imagen', 20, '15cm', 4, '2024-11-11 14:58:40', 10),
(21, 'Pared isopanel terracota', 'Pared de isopanel con gran aislamiento térmico y acústico, ideal para proyectos rápidos y duraderos en entornos residenciales, comerciales e industriales.', 20000.00, 'imagen', 15, '15cm', 4, '2024-11-11 15:02:33', 10),
(22, 'Pared isopanel gris', 'Pared de isopanel con gran aislamiento térmico y acústico, ideal para proyectos rápidos y duraderos en entornos residenciales, comerciales e industriales.', 20000.00, 'imagen', 20, '15cm', 4, '2024-11-11 14:59:05', 10),
(23, 'Techo de isopanel terracota', 'Techo de isopanel con excelente aislamiento térmico y durabilidad. Fácil de instalar y mantener, ideal para proyectos residenciales, comerciales e industriales.', 10000.00, 'imagen', 23, '15cm', 5, '2024-11-11 15:02:25', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id_review` int(11) NOT NULL,
  `id_customer_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `rating_review` tinyint(4) DEFAULT NULL CHECK (`rating_review` between 1 and 5),
  `comment_review` text DEFAULT NULL,
  `created_at_review` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id_provider` int(11) NOT NULL,
  `name_provider` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id_purchase_order` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `date_purchase_order` date NOT NULL,
  `total_purchase_order` decimal(10,2) NOT NULL,
  `id_payment_method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `complete_name_user` varchar(100) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `phone_user` varchar(50) NOT NULL,
  `role_user` char(1) NOT NULL,
  `created_at_user` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `complete_name_user`, `email_user`, `password_user`, `phone_user`, `role_user`, `created_at_user`) VALUES
(5, 'user', 'user@user.com', '$2y$10$uZWGs26wDryKwqjhb3w3H.YNyMNdBoQVQmS78g9WxT5Y0v.FOxK.m', '99827336', 'C', '2024-11-11 13:40:35'),
(6, 'user2', 'user2@user.com', '$2y$10$jGzB0AfFgzCf96T4m6Qv7.Zyar0SnqIg/LC7nKcn1pK9Ssqy1VVGy', '99837264', 'C', '2024-11-11 13:41:29'),
(7, 'user3', 'user3@user.com', '$2y$10$a7e4h4nc/dWnnHkiJpVzr.pajvuKQIKIHJn704zfV9Tfj/n3ZT5pi', '99037263', 'C', '2024-11-11 13:41:48'),
(8, 'admin', 'admin@admin.com', '$2y$10$DMIVFJdN4kFvp20umkuUUuZDr1bb5/RkgDeg0W.b.pheJRy7M5eOO', '98372635', 'A', '2024-11-11 13:42:27'),
(9, 'admin2', 'admin2@admin.com', '$2y$10$E8QVjfR0lfeBFzAGIPNvRuTlnaI8Wa//GY8.coA2CWweP8.k7TVty', '99827364', 'A', '2024-11-11 13:42:41'),
(10, 'root', 'root@root.com', '$2y$10$QvgIujo1QVFwCxl.T9xv8uQmD6DUPpti4IFsLllVTDdRiUvwCHTvu', '99283947', 'A', '2024-11-11 13:43:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id_city`),
  ADD KEY `fk_id_department_city` (`id_department`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_user_customer`),
  ADD KEY `fk_id_city_customer` (`id_city`);

--
-- Indices de la tabla `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`id_customer_order`),
  ADD KEY `fk_id_customer_customer_order` (`id_customer`),
  ADD KEY `fk_id_payment_method_customer_order` (`id_payment_method`),
  ADD KEY `fk_id_order_stauts_customer_order` (`id_order_status`),
  ADD KEY `fk_updated_by_customer_order` (`updated_by_order`);

--
-- Indices de la tabla `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id_delivery`),
  ADD KEY `fk_id_customer_order_delivery` (`id_customer_order`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id_department`);

--
-- Indices de la tabla `images_product`
--
ALTER TABLE `images_product`
  ADD PRIMARY KEY (`id_image_product`),
  ADD KEY `fk_id_product_id_image_product` (`id_product`);

--
-- Indices de la tabla `order_products_customers`
--
ALTER TABLE `order_products_customers`
  ADD PRIMARY KEY (`id_order_product_customer`),
  ADD KEY `fk_id_customer_order_order_product_customer` (`id_customer_order`),
  ADD KEY `fk_id_product_order_product_customer` (`id_product`);

--
-- Indices de la tabla `order_products_purchases`
--
ALTER TABLE `order_products_purchases`
  ADD PRIMARY KEY (`id_order_product_purchase`),
  ADD KEY `fk_id_purchase_order_order_product_purchase` (`id_purchase_order`),
  ADD KEY `fk_id_product_order_product_purchase` (`id_product`);

--
-- Indices de la tabla `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id_order_status`);

--
-- Indices de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id_payment_method`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_id_category_product` (`id_category`),
  ADD KEY `fk_updated_by_product` (`updated_by_product`);

--
-- Indices de la tabla `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_id_customer_review` (`id_customer`),
  ADD KEY `fk_id_order_product_review` (`id_customer_order`),
  ADD KEY `fk_id_product_product_review` (`id_product`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id_provider`);

--
-- Indices de la tabla `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id_purchase_order`),
  ADD KEY `fk_id_provider_purchase_order` (`id_provider`),
  ADD KEY `fk_id_payment_method_purchase_order` (`id_payment_method`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_user` (`email_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `id_customer_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `images_product`
--
ALTER TABLE `images_product`
  MODIFY `id_image_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `order_products_customers`
--
ALTER TABLE `order_products_customers`
  MODIFY `id_order_product_customer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `order_products_purchases`
--
ALTER TABLE `order_products_purchases`
  MODIFY `id_order_product_purchase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id_order_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id_payment_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id_provider` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id_purchase_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_id_department_city` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id_department`);

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_id_city_customer` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`),
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user_customer`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD CONSTRAINT `fk_id_customer_customer_order` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_user_customer`),
  ADD CONSTRAINT `fk_id_order_stauts_customer_order` FOREIGN KEY (`id_order_status`) REFERENCES `order_status` (`id_order_status`),
  ADD CONSTRAINT `fk_id_payment_method_customer_order` FOREIGN KEY (`id_payment_method`) REFERENCES `payment_methods` (`id_payment_method`),
  ADD CONSTRAINT `fk_updated_by_customer_order` FOREIGN KEY (`updated_by_order`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `fk_id_customer_order_delivery` FOREIGN KEY (`id_customer_order`) REFERENCES `customer_orders` (`id_customer_order`);

--
-- Filtros para la tabla `images_product`
--
ALTER TABLE `images_product`
  ADD CONSTRAINT `fk_id_product_id_image_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Filtros para la tabla `order_products_customers`
--
ALTER TABLE `order_products_customers`
  ADD CONSTRAINT `fk_id_customer_order_order_product_customer` FOREIGN KEY (`id_customer_order`) REFERENCES `customer_orders` (`id_customer_order`),
  ADD CONSTRAINT `fk_id_product_order_product_customer` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Filtros para la tabla `order_products_purchases`
--
ALTER TABLE `order_products_purchases`
  ADD CONSTRAINT `fk_id_product_order_product_purchase` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `fk_id_purchase_order_order_product_purchase` FOREIGN KEY (`id_purchase_order`) REFERENCES `purchase_orders` (`id_purchase_order`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_id_category_product` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`),
  ADD CONSTRAINT `fk_updated_by_product` FOREIGN KEY (`updated_by_product`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `fk_id_customer_review` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_user_customer`),
  ADD CONSTRAINT `fk_id_order_product_review` FOREIGN KEY (`id_customer_order`) REFERENCES `order_products_customers` (`id_customer_order`),
  ADD CONSTRAINT `fk_id_product_product_review` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Filtros para la tabla `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `fk_id_payment_method_purchase_order` FOREIGN KEY (`id_payment_method`) REFERENCES `payment_methods` (`id_payment_method`),
  ADD CONSTRAINT `fk_id_provider_purchase_order` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id_provider`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
