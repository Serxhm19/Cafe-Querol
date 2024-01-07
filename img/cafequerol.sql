-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2024 a las 21:17:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafequerol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_CATEGORIA` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `NOMBRE_CATEGORIA`) VALUES
(1, 'Bebidas'),
(2, 'Alimentacion'),
(3, 'Packs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ESTADO` varchar(50) NOT NULL,
  `FECHA_PEDIDO` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_PEDIDO`, `ID_USUARIO`, `ESTADO`, `FECHA_PEDIDO`) VALUES
(2, 10, 'Pendiente', '2023-12-29'),
(3, 10, 'Pendiente', '2023-12-29'),
(4, 10, 'Pendiente', '2023-12-29'),
(5, 10, 'Pendiente', '2023-12-29'),
(6, 10, 'Pendiente', '2023-12-29'),
(7, 10, 'Pendiente', '2023-12-29'),
(8, 10, 'Pendiente', '2023-12-30'),
(9, 10, 'Pendiente', '2024-01-03'),
(10, 10, 'Pendiente', '2024-01-03'),
(11, 10, 'Pendiente', '2024-01-03'),
(12, 13, 'Pendiente', '2024-01-07'),
(13, 13, 'Pendiente', '2024-01-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_articulos`
--

CREATE TABLE `pedido_articulos` (
  `ID_ARTICULO` int(11) NOT NULL,
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_articulos`
--

INSERT INTO `pedido_articulos` (`ID_ARTICULO`, `ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`, `PRECIO`) VALUES
(1, 2, 4, 2, 4.00),
(2, 3, 3, 1, 4.00),
(3, 3, 6, 1, 5.00),
(4, 3, 5, 1, 4.00),
(5, 4, 3, 1, 3.50),
(7, 4, 5, 1, 4.50),
(8, 5, 14, 1, 1.50),
(9, 5, 4, 1, 4.00),
(10, 5, 5, 1, 4.50),
(11, 6, 4, 1, 4.00),
(12, 6, 5, 1, 4.50),
(13, 6, 3, 1, 3.50),
(14, 7, 4, 1, 4.00),
(15, 7, 3, 1, 3.50),
(16, 8, 3, 1, 3.50),
(17, 8, 2, 1, 2.00),
(18, 8, 4, 1, 4.00),
(19, 8, 5, 1, 4.50),
(20, 9, 5, 1, 4.50),
(21, 10, 4, 2, 4.00),
(22, 10, 16, 1, 2.50),
(23, 10, 15, 1, 3.50),
(24, 11, 4, 1, 4.00),
(25, 11, 5, 1, 4.50),
(26, 11, 6, 1, 5.00),
(27, 11, 7, 1, 2.50),
(28, 12, 2, 1, 3.55),
(29, 12, 13, 1, 1.50),
(30, 12, 9, 1, 3.00),
(31, 13, 5, 2, 4.50),
(32, 13, 6, 1, 5.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_PRODUCTO` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(250) NOT NULL,
  `PRECIO` double(5,2) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `IMG` varchar(250) NOT NULL,
  `PRECIO_DESCUENTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_PRODUCTO`, `ID_CATEGORIA`, `NOMBRE_PRODUCTO`, `DESCRIPCION`, `PRECIO`, `CANTIDAD`, `IMG`, `PRECIO_DESCUENTO`) VALUES
(2, 1, 'Café Americano', 'Café americano suave y aromático', 3.55, 20, 'img/products/cafeAmericano.png', 0),
(3, 1, 'Cappuccino', 'Café con leche y espuma de leche', 3.50, 80, 'img/products/Capuccino.png', 0),
(4, 1, 'Latte Macchiato', 'Café con leche y manchas de espresso', 4.00, 70, 'img/products/LatteMachiatto.png', 0),
(5, 1, 'Mocha', 'Café con chocolate y leche', 4.50, 60, 'img/products/Mocha.png', 0),
(6, 1, 'Frappé', 'Café helado con leche y hielo', 5.00, 50, 'img/products/Frappe.png', 0),
(7, 1, 'Té Verde', 'Té verde con propiedades antioxidantes', 2.50, 100, 'img/products/TeVerde.png', 0),
(9, 1, 'Chocolate Caliente', 'Chocolate caliente cremoso', 3.00, 80, 'img/products/ChocolateCaliente.png', 0),
(11, 1, 'Zumo de Naranja', 'Zumo de naranja natural', 2.50, 100, 'img/products/ZumoNaranja.png', 0),
(13, 2, 'Croissant', 'Delicioso croissant recién horneado', 1.50, 200, 'img/products/croissant.png', 0),
(14, 2, 'Donut', 'Donut esponjoso con glaseado', 1.50, 200, 'img/products/Donut.png', 0),
(15, 2, 'Tarta de Manzana', 'Tarta de manzana casera', 3.50, 60, 'img/products/TartaManzana.png', 0),
(16, 2, 'Brownie', 'Brownie de chocolate con nueces', 2.50, 80, 'img/products/Brownie.png', 0),
(17, 1, 'Café Latte', 'Café con leche cremoso', 3.00, 90, 'img/products/CaffeLatte.png', 0),
(21, 1, 'Café Helado', 'Café frío con hielo y leche', 3.50, 70, 'img/products/CafeHelado.png', 0),
(22, 1, 'Café Menta', 'Café con sabor a menta', 3.00, 80, 'img/products/CafeMenta.png', 0),
(24, 1, 'Té de Frutas', 'Infusión de frutas frescas', 2.50, 100, 'img/products/TeFrutas.png', 0),
(25, 1, 'Chocolate Blanco', 'Chocolate blanco cremoso', 3.00, 80, 'img/products/ChocolateBlanco.png', 0),
(26, 1, 'Chocolate con Avellanas', 'Chocolate con avellanas', 3.50, 70, 'img/products/Chocolate.png', 0),
(28, 1, 'Zumo de Fresa', 'Zumo de fresa recién exprimido', 2.50, 100, 'img/products/ZumoFresa.png', 0),
(29, 2, 'Croissant de Chocolate', 'Croissant relleno de chocolate', 2.00, 150, 'img/products/croissantChocolate.png', 0),
(30, 2, 'Donut de Vainilla', 'Donut con glaseado de vainilla', 2.00, 150, 'img/products/DonutVainilla.png', 0),
(31, 2, 'Tarta de Chocolate', 'Tarta de chocolate con ganache', 4.00, 70, 'img/products/tartaChocolate.png', 0),
(32, 2, 'Cheesecake', 'Cheesecake clásico con salsa de frutas', 3.50, 80, 'img/products/cheesecake.png', 0),
(33, 1, 'Café Cortado', 'Café con un toque de leche', 2.50, 100, 'img/products/cortado.png', 0),
(34, 1, 'Café Descafeinado', 'Café sin cafeína', 2.00, 150, 'img/products/descafeinado.png', 0),
(42, 3, 'Pack Croissants', '12 U. de croissants', 12.00, 120, 'img/products/packCroissants.png', 0),
(43, 3, 'Pack Donuts', '10 U. de Donuts glaseados', 10.00, 120, 'img/products/packDonuts.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `APELLIDO` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(254) DEFAULT NULL,
  `CORREO` varchar(50) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `DIRECCION` varchar(50) DEFAULT NULL,
  `PERMISO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE`, `APELLIDO`, `PASSWORD`, `CORREO`, `TELEFONO`, `DIRECCION`, `PERMISO`) VALUES
(10, 'Sergi', 'Hernández Miras', '1111', 'sergihernandezfp@ibf.cat', '674309222', 'Castella', 0),
(12, 'Sergi', 'Hernández Miras', '$2y$10$ctyoZu4opo4pXsI/ane15OMeRv1H2Vf3e2.LhorHWTPKjVCVCS/3a', 'sergihernandez@gmail.com', '674309222', 'Castella', 0),
(13, 'Sergi', 'Hernández Miras', '$2y$10$NPpTkwl53FaIir7/k6LIu.HwzkmXwYe9ynKPcPKJHtLmd0fv07fbW', 'sergihm9@gmail.com', '674309222', 'c/ Castella, 5, Vallirana', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_PEDIDO`),
  ADD KEY `FK_IDUSUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `pedido_articulos`
--
ALTER TABLE `pedido_articulos`
  ADD PRIMARY KEY (`ID_ARTICULO`),
  ADD KEY `FK_IDPRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `FK_IDPEDIDO3` (`ID_PEDIDO`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `FK_IDCATEGORIA` (`ID_CATEGORIA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_PEDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pedido_articulos`
--
ALTER TABLE `pedido_articulos`
  MODIFY `ID_ARTICULO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_IDUSUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`);

--
-- Filtros para la tabla `pedido_articulos`
--
ALTER TABLE `pedido_articulos`
  ADD CONSTRAINT `FK_IDPEDIDO` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedidos` (`ID_PEDIDO`),
  ADD CONSTRAINT `FK_IDPEDIDO3` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedidos` (`ID_PEDIDO`),
  ADD CONSTRAINT `FK_IDPRODUCTO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_IDCATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
