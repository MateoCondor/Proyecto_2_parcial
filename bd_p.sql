-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-08-2023 a las 21:51:58
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
-- Base de datos: `bd_p`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbladminusers`
--

CREATE TABLE `tbladminusers` (
  `user` varchar(34) NOT NULL,
  `password` varchar(34) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbladminusers`
--

INSERT INTO `tbladminusers` (`user`, `password`) VALUES
('admin1', 'admin1');

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
(1, 'Peperoni', 20, 'Unidades', 1.2, '0'),
(2, 'Queso', 11, 'gr', 1.5, '1'),
(3, 'Harina', 50, 'gr', 1.8, '1'),
(4, 'Mortadela', 70, 'gr', 1.9, '1'),
(5, 'Carne', 2, 'kg', 2, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblingredientes`
--
ALTER TABLE `tblingredientes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblingredientes`
--
ALTER TABLE `tblingredientes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
