-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-08-2023 a las 06:46:55
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
-- Estructura de tabla para la tabla `tblingredientesinit`
--

CREATE TABLE `tblingredientesinit` (
  `ID` int(10) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Cantidad` int(10) NOT NULL,
  `Unidad` varchar(200) DEFAULT NULL,
  `Precio` float DEFAULT NULL,
  `FechaIngreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tblingredientesinit`
--

INSERT INTO `tblingredientesinit` (`ID`, `Descripcion`, `Cantidad`, `Unidad`, `Precio`, `FechaIngreso`, `Active`) VALUES
(1, 'Peperoni', 2, 'Unidades', 1, '2023-08-26 17:17:12', '1'),
(2, 'Leche', 12, 'Litro/s', 0.9, '2023-08-26 17:21:23', '1'),
(3, 'Carne', 2, 'Kilogramo/s', 6.99, '2023-08-26 22:10:54', '1'),
(4, 'Queso', 5, 'Unidad/es', 3.75, '2023-08-26 22:12:46', '1'),
(5, 'Harina', 2, 'Kilogramo/s', 2.4, '2023-08-26 22:15:29', '1'),
(6, 'Jamon', 9, 'Kilogramo/s', 18, '2023-08-26 22:18:13', '1'),
(7, 'Piña', 2, 'Unidad/es', 1, '2023-08-27 17:34:25', '1'),
(8, 'Mozarrella', 3, 'Kilogramo/s', 4.2, '2023-08-27 20:39:07', '1'),
(9, 'Tomate', 10, 'Unidad/es', 0.15, '2023-08-27 20:39:32', '1'),
(10, 'Huevos', 36, 'Kilogramo/s', 0.2, '2023-08-27 20:39:53', '1'),
(11, 'papas', 2, 'Gramos', 2, '2023-08-30 01:46:15', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblingredientesinit`
--
ALTER TABLE `tblingredientesinit`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblingredientesinit`
--
ALTER TABLE `tblingredientesinit`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
