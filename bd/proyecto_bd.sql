-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-08-2023 a las 19:38:22
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mainlogin`
--

CREATE TABLE `mainlogin` (
  `id` int(10) NOT NULL,
  `username` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `mainlogin`
--

INSERT INTO `mainlogin` (`id`, `username`, `email`, `password`, `role`, `Active`) VALUES
(1, 'admin1', 'admin1@admin.com', 'admin123', 'admin', 1),
(2, 'bodega1', 'bodega1@bodega.com', 'bodega123', 'bodega', 1),
(3, 'mateo', 'condormateo00@gmail.com', 'mj241726', 'bodega', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblingredientes`
--

CREATE TABLE `tblingredientes` (
  `ID` int(10) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Cantidad` int(10) NOT NULL,
  `Unidad` varchar(200) DEFAULT NULL,
  `Precio` float DEFAULT NULL,
  `Active` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tblingredientes`
--

INSERT INTO `tblingredientes` (`ID`, `Descripcion`, `Cantidad`, `Unidad`, `Precio`, `Active`) VALUES
(1, 'Peperoni', 0, '', 0, '1'),
(2, 'Queso', 4, 'kg', 1.5, '1'),
(3, 'Harina', 50, 'gr', 1.8, '1'),
(4, 'Mortadela', 70, 'gr', 1.9, '1'),
(5, 'Carne', 2, 'kg', 2, '1'),
(6, 'Zanahoria', 2, 'unidad', 2.3, '1'),
(7, 'Jamon', 5, 'kg', 2.6, '1'),
(9, 'Leche', 2, 'l', 0.9, '1'),
(11, 'Piña', 2, 'unidad', 1.5, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mainlogin`
--
ALTER TABLE `mainlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblingredientes`
--
ALTER TABLE `tblingredientes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mainlogin`
--
ALTER TABLE `mainlogin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblingredientes`
--
ALTER TABLE `tblingredientes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
