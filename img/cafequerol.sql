-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2024 a las 15:29:08
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
  `FECHA_PEDIDO` date NOT NULL DEFAULT current_timestamp(),
  `PRECIO_TOTAL` int(11) NOT NULL,
  `PROPINA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_PEDIDO`, `ID_USUARIO`, `ESTADO`, `FECHA_PEDIDO`, `PRECIO_TOTAL`, `PROPINA`) VALUES
(14, 13, 'Pendiente', '2024-01-08', 0, 0),
(15, 13, 'Pendiente', '2024-01-15', 0, 0),
(16, 13, 'Pendiente', '2024-01-15', 0, 0),
(17, 13, 'Pendiente', '2024-01-15', 0, 0),
(18, 13, 'Pendiente', '2024-02-01', 0, 0),
(19, 13, 'Pendiente', '2024-02-01', 0, 0),
(20, 13, 'Pendiente', '2024-02-01', 0, 0),
(21, 13, 'Pendiente', '2024-02-01', 0, 0),
(22, 13, 'Pendiente', '2024-02-01', 0, 0),
(23, 13, 'Pendiente', '2024-02-01', 0, 0),
(24, 13, 'Pendiente', '2024-02-01', 0, 0),
(25, 13, 'Pendiente', '2024-02-01', 0, 0),
(26, 13, 'Pendiente', '2024-02-01', 0, 0),
(58, 13, 'Pendiente', '2024-02-13', 0, 0),
(59, 13, 'Pendiente', '2024-02-13', 0, 0),
(60, 13, 'Pendiente', '2024-02-13', 0, 0),
(62, 13, 'Pendiente', '2024-02-15', 0, 0),
(63, 13, 'Pendiente', '2024-02-15', 0, 0),
(64, 13, 'Pendiente', '2024-02-15', 0, 0),
(72, 13, 'Pendiente', '2024-02-15', 0, 0),
(73, 13, 'Pendiente', '2024-02-15', 0, 0),
(74, 13, 'Pendiente', '2024-02-15', 0, 0),
(75, 13, 'Pendiente', '2024-02-15', 0, 0),
(76, 13, 'Pendiente', '2024-02-15', 0, 0),
(77, 13, 'Pendiente', '2024-02-15', 0, 0);

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
(33, 14, 2, 1, 3.55),
(34, 14, 13, 1, 1.50),
(35, 14, 9, 1, 3.00),
(36, 15, 3, 2, 3.50),
(37, 15, 29, 1, 2.00),
(38, 15, 5, 1, 4.50),
(39, 16, 42, 1, 12.00),
(40, 16, 3, 1, 3.50),
(41, 17, 7, 1, 2.50),
(42, 17, 3, 1, 3.50),
(43, 18, 4, 1, 4.00),
(44, 18, 5, 1, 4.50),
(45, 19, 11, 1, 2.50),
(46, 19, 13, 1, 1.50),
(47, 20, 25, 1, 3.00),
(48, 20, 4, 1, 4.00),
(49, 20, 3, 1, 3.50),
(50, 21, 2, 1, 3.55),
(51, 22, 3, 1, 3.50),
(52, 22, 4, 1, 4.00),
(53, 23, 3, 1, 3.50),
(54, 23, 4, 1, 4.00),
(55, 23, 5, 1, 4.50),
(56, 24, 3, 1, 3.50),
(57, 24, 4, 1, 4.00),
(58, 25, 3, 1, 3.50),
(59, 25, 4, 1, 4.00),
(60, 26, 3, 1, 3.50),
(107, 58, 5, 1, 4.50),
(108, 58, 4, 1, 4.00),
(109, 58, 6, 1, 5.00),
(110, 59, 5, 1, 4.50),
(111, 59, 6, 1, 5.00),
(112, 59, 7, 1, 2.50),
(113, 60, 4, 1, 4.00),
(114, 60, 5, 1, 4.50),
(115, 62, 3, 1, 3.50),
(116, 63, 4, 1, 4.00),
(117, 63, 5, 1, 4.50),
(118, 64, 3, 2, 3.50),
(119, 72, 3, 1, 3.50),
(120, 72, 4, 1, 4.00),
(121, 73, 3, 1, 3.50),
(122, 73, 4, 1, 4.00),
(123, 74, 3, 1, 3.50),
(124, 75, 2, 1, 3.55),
(125, 76, 3, 1, 3.50),
(126, 76, 4, 1, 4.00),
(127, 77, 3, 1, 3.50);

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
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `ID_RESEÑA` int(11) NOT NULL,
  `ID_PEDIDO` int(11) NOT NULL,
  `ASUNTO_RESEÑA` varchar(50) DEFAULT NULL,
  `COMENTARIO_RESEÑA` varchar(250) DEFAULT NULL,
  `FECHA_RESEÑA` date DEFAULT current_timestamp(),
  `VALORACION_RESEÑA` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reseñas`
--

INSERT INTO `reseñas` (`ID_RESEÑA`, `ID_PEDIDO`, `ASUNTO_RESEÑA`, `COMENTARIO_RESEÑA`, `FECHA_RESEÑA`, `VALORACION_RESEÑA`) VALUES
(30, 14, 'Excelente servicio', 'El café es delicioso y el personal es muy amable. ¡Altamente recomendado!', '2024-02-11', 5),
(31, 15, 'Buen café', 'El café tiene buen sabor pero el servicio es un poco lento.', '2024-02-10', 4),
(32, 16, 'Regular', 'No me impresionó mucho. El café estaba frío y el pastel era seco.', '2024-02-09', 3),
(33, 17, 'Muy malo', 'No volveré. La comida era terrible y el servicio era pésimo.', '2024-02-08', 1),
(34, 18, 'Bueno pero caro', 'El café es bueno pero los precios son demasiado altos.', '2024-02-07', 3),
(35, 19, 'Fantástico', '¡El mejor café que he probado! El ambiente es genial también.', '2024-02-06', 5),
(36, 20, 'Buena experiencia', 'El servicio fue bueno y el café estaba bien. Volveré pronto.', '2024-02-05', 4),
(37, 21, 'Meh', 'Nada especial. El café estaba bien pero no era nada del otro mundo.', '2024-02-04', 2),
(38, 22, 'No tan bueno', 'No lo recomendaría. El café era demasiado amargo para mi gusto.', '2024-02-03', 2),
(39, 23, 'Increíble', 'El mejor café de la ciudad. El personal es amable y el ambiente es acogedor.', '2024-02-02', 5),
(40, 24, '1', 'A', '2024-02-13', 2),
(41, 26, 'hOLA', '111', '2024-02-13', 4),
(42, 25, 'ss', 'aa', '2024-02-13', 3),
(43, 58, 'Hola', 'Hola', '2024-02-13', 5),
(44, 59, 'A', 'A', '2024-02-13', 4);

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
  `PERMISO` int(11) DEFAULT NULL,
  `PUNTOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE`, `APELLIDO`, `PASSWORD`, `CORREO`, `TELEFONO`, `DIRECCION`, `PERMISO`, `PUNTOS`) VALUES
(10, 'Sergi', 'Hernández Miras', '1111', 'sergihernandezfp@ibf.cat', '674309222', 'Castella', 0, 0),
(12, 'Sergi', 'Hernández Miras', '$2y$10$ctyoZu4opo4pXsI/ane15OMeRv1H2Vf3e2.LhorHWTPKjVCVCS/3a', 'sergihernandez@gmail.com', '674309222', 'Castella', 1, 0),
(13, 'Sergi', 'Hernández Miras', '$2y$10$NPpTkwl53FaIir7/k6LIu.HwzkmXwYe9ynKPcPKJHtLmd0fv07fbW', 'sergihm9@gmail.com', '674309222', 'c/ Castella, 5, Vallirana', 0, 0),
(14, 'Sergi', 'Hernández Miras', '$2y$10$D9iFZRSj52lzTjRBB0tEeOAfjnAIdX2hTWjrE8yo0sHQKwTpK7YGG', 'sergi19@gmail.com', '674309222', 'Castella', 1, 0);

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
  ADD KEY `FK_IDPEDIDO3` (`ID_PEDIDO`),
  ADD KEY `FK_IDPRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `FK_IDCATEGORIA` (`ID_CATEGORIA`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`ID_RESEÑA`),
  ADD KEY `FK_IDPEDIDO2` (`ID_PEDIDO`);

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
  MODIFY `ID_PEDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `pedido_articulos`
--
ALTER TABLE `pedido_articulos`
  MODIFY `ID_ARTICULO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `ID_RESEÑA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_IDUSUARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido_articulos`
--
ALTER TABLE `pedido_articulos`
  ADD CONSTRAINT `FK_IDPEDIDO` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedidos` (`ID_PEDIDO`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_IDPEDIDO3` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedidos` (`ID_PEDIDO`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_IDPRODUCTO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`ID_PRODUCTO`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_IDCATEGORIA` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`);

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `FK_IDPEDIDO2` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `pedidos` (`ID_PEDIDO`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
