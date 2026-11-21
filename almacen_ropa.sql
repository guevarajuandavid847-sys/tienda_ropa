-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2026 a las 21:44:25
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
-- Base de datos: `almacen_ropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 2, 8, 1, 100000.00),
(2, 2, 5, 1, 120000.00),
(3, 2, 6, 1, 150000.00),
(4, 2, 4, 1, 130000.00),
(5, 3, 4, 1, 130000.00),
(6, 3, 8, 1, 100000.00),
(7, 3, 12, 1, 420000.00),
(8, 3, 16, 1, 90000.00),
(9, 4, 5, 4, 120000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `stock`, `imagen`) VALUES
(1, 'jean Levis Ref 008', 140000.00, 3, 'jean 1.jpg'),
(4, 'Jean Ref 2', 130000.00, 5, 'jean 2.jpg'),
(5, 'Jean Ref 3', 120000.00, 30, 'jean 3.jpg'),
(6, 'Jean Ref 4', 150000.00, 26, 'jean4.jpg'),
(7, 'Camisa Ref1', 90000.00, 25, 'camisa 1.jpg'),
(8, 'Camisa Ref2', 100000.00, 42, 'camisa 2.jpg'),
(9, 'Camisa Ref3', 110000.00, 22, 'camisa 3.jpg'),
(10, 'Camisa Ref4', 80000.00, 31, 'camisa 4.jpg'),
(11, 'Vestido Ref 1', 300000.00, 21, 'vestido 1.jpg'),
(12, 'Vestido Ref 2', 420000.00, 16, 'vestido 2.jpg'),
(13, 'Vestido Ref 3', 200000.00, 19, 'vestido 3.jpg'),
(14, 'Vestido Ref 4', 340000.00, 16, 'vestido 4.webp'),
(15, 'Sudadera Ref 1', 80000.00, 22, 'sudadera 1.jpg'),
(16, 'Sudadera Ref 2', 90000.00, 18, 'sudadera 2.jpg'),
(17, 'Sudadera Ref 3', 100000.00, 24, 'sudadera 3.jpg'),
(19, 'Sudadera 4', 100000.00, 21, 'sudadera 4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','empleado','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `rol`) VALUES
(3, 'Mauricio', 'AdminPC', '$2y$10$tgde6ybDdVW87SACMl9e4.yMTgini22AFLlZrVN5f9Fx59U4Y23eK', 'admin'),
(7, 'Juanita Perez', 'VendedoraSN', '$2y$10$UMYIXBRO5nw9ksXnaE4jCuSkAQrqbJT3UxTw7v4bOM2zjMduKj0Vq', 'empleado'),
(8, 'Jhon Doe', 'VendedorJD', '$2y$10$2ugYkcJuB/TCqO2mZ19yluXjLyCJyAFWXoPhzL7ltOJrdDVdbLb/6', 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `id_vendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`, `id_vendedor`) VALUES
(1, '2026-11-20 01:33:21', 500000.00, 7),
(2, '2026-11-20 01:38:20', 500000.00, 7),
(3, '2026-11-20 01:46:15', 740000.00, 7),
(4, '2026-11-20 02:47:36', 480000.00, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `producto_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ventas` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `vendedor_usuario` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
