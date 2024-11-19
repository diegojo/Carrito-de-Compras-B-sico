-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2024 a las 19:23:59
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
-- Base de datos: `carrito_basico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guardicion`
--

CREATE TABLE `guardicion` (
  `idguardicion` int(11) NOT NULL,
  `descripcion_guardicion` varchar(200) NOT NULL,
  `estado_guardicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guardicion`
--

INSERT INTO `guardicion` (`idguardicion`, `descripcion_guardicion`, `estado_guardicion`) VALUES
(1, 'PATACONES', 1),
(2, 'PLATANO FRITO', 1),
(3, 'PAPAS FRITAS', 1),
(4, 'ARROZ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preventa`
--

CREATE TABLE `preventa` (
  `idpreventa` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `guardicion` varchar(200) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `totalcobrar` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `tipo_servicio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `descripcion`, `precio`, `tipo_servicio`) VALUES
(1, 'POLLO AL HORNO', 13.00, 'COMIDA'),
(2, 'ARROZ CON POLLO', 12.00, 'COMIDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `cantidad_stock` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`idstock`, `idservicio`, `cantidad_stock`) VALUES
(1, 1, '10'),
(2, 2, '10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `guardicion`
--
ALTER TABLE `guardicion`
  ADD PRIMARY KEY (`idguardicion`);

--
-- Indices de la tabla `preventa`
--
ALTER TABLE `preventa`
  ADD PRIMARY KEY (`idpreventa`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idstock`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `guardicion`
--
ALTER TABLE `guardicion`
  MODIFY `idguardicion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preventa`
--
ALTER TABLE `preventa`
  MODIFY `idpreventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `idstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
