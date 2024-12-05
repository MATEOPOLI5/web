-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 18:38:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hector`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `idDetalleVenta` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `cod_barra` varchar(50) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total_producto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cod_barra` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `especificaciones` text DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `costo_compras` varchar(50) DEFAULT NULL,
  `costo_ventas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProductos`, `nombre`, `cod_barra`, `cantidad`, `proveedor`, `especificaciones`, `fecha_caducidad`, `costo_compras`, `costo_ventas`) VALUES
(1, 'TOTOPOS', 'Sab123', 100, 'Sabrita', 'de 50g', '2024-07-12', '54', '16'),
(4, 'COCA COLA', '505050', 100, 'COCA COLA', '1L', '2024-10-10', '20', '50'),
(6, 'Sabritas 45g', 'A1B2C3', 50, 'Sabritas', 'Bolsa de papas fritas de 45g', '2025-06-15', '10.00', '15.00'),
(7, 'Sabritas 90g', 'D4E5F6', 30, 'Sabritas', 'Bolsa de papas fritas de 90g', '2025-06-15', '18.00', '25.00'),
(8, 'Jugo de Naranja 500ml', 'G7H8I9', 40, 'Del Valle', 'Botella de jugo de naranja de 500ml', '2025-04-20', '12.50', '18.00'),
(9, 'Jugo de Manzana 1L', 'J1K2L3', 25, 'Del Valle', 'Botella de jugo de manzana de 1L', '2025-04-20', '22.00', '30.00'),
(10, 'Coca Cola 600ml', 'M4N5O6', 60, 'Coca Cola', 'Botella de refresco de 600ml', '2025-05-30', '10.50', '15.00'),
(11, 'Coca Cola 2L', 'P7Q8R9', 40, 'Coca Cola', 'Botella de refresco de 2L', '2025-05-30', '18.00', '25.00'),
(12, 'Galletas Oreo 150g', 'S1T2U3', 35, 'Nabisco', 'Paquete de galletas Oreo de 150g', '2025-07-10', '14.00', '20.00'),
(13, 'Galletas Marías 200g', 'V4W5X6', 50, 'Gamesa', 'Paquete de galletas Marías de 200g', '2025-08-01', '12.00', '17.00'),
(14, 'Pepsi 355ml', 'Y7Z8A1', 70, 'Pepsi', 'Lata de refresco de 355ml', '2025-06-15', '7.50', '12.00'),
(15, 'Pepsi 1.5L', 'B2C3D4', 45, 'Pepsi', 'Botella de refresco de 1.5L', '2025-06-15', '15.00', '22.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_p` varchar(100) DEFAULT NULL,
  `apellido_m` varchar(100) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido_p`, `apellido_m`, `clave`, `telefono`, `correo`) VALUES
(4, 'Brenda Azereth', 'Guerrero', 'Portilla', 'Brend@2024', '4831225996', 'brenda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `empleado` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`idDetalleVenta`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProductos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `idDetalleVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
