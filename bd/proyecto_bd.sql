-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-08-2023 a las 03:02:37
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
-- Estructura de tabla para la tabla `datos_receta`
--

CREATE TABLE `datos_receta` (
  `Codigo` int(100) NOT NULL,
  `NombreReceta` varchar(100) NOT NULL,
  `PrecioReceta` float NOT NULL,
  `FechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `datos_receta`
--

INSERT INTO `datos_receta` (`Codigo`, `NombreReceta`, `PrecioReceta`, `FechaCreacion`, `Active`) VALUES
(1, 'Pizza peperoni', 6.65, '2023-08-27 17:16:11', 1),
(2, 'Pizza Mundo', 15.48, '2023-08-27 17:38:54', 1),
(3, 'Pizza hawaiana', 8.15, '2023-08-27 17:59:18', 1),
(5, 'Pizza jamon', 8.85, '2023-08-27 19:40:41', 1),
(6, 'Pizza margarita', 28.75, '2023-08-27 20:37:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes_receta`
--

CREATE TABLE `ingredientes_receta` (
  `Codigo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Cantidad` float NOT NULL,
  `PrecioUnidad` float NOT NULL,
  `PrecioTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ingredientes_receta`
--

INSERT INTO `ingredientes_receta` (`Codigo`, `Nombre`, `Cantidad`, `PrecioUnidad`, `PrecioTotal`) VALUES
('1', 'Peperoni', 2, 1, 2),
('1', 'Leche', 1, 0.9, 0.9),
('1', 'Queso', 1, 3.75, 3.75),
('2', 'Harina', 2, 2.4, 2.4),
('2', 'Queso', 2, 3.75, 7.5),
('2', 'Jamon', 2, 18, 5.58),
('3', 'Piña', 2, 1, 2),
('3', 'Queso', 1, 3.75, 3.75),
('3', 'Harina', 1, 2.4, 2.4),
('5', 'Jamon', 0.15, 18, 2.7),
('5', 'Harina', 1, 2.4, 2.4),
('5', 'Queso', 1, 3.75, 3.75),
('6', 'Queso', 1, 3.75, 3.75),
('6', 'Harina', 1, 2.4, 2.4),
('6', 'Jamon', 1, 18, 18),
('6', 'Huevos', 2, 0.2, 0.4),
('6', 'Mozarrella', 1, 4.2, 4.2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mainlogin`
--

CREATE TABLE `mainlogin` (
  `id` int(10) NOT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `mainlogin`
--

INSERT INTO `mainlogin` (`id`, `username`, `email`, `password`, `role`, `Active`) VALUES
(1, 'Administrador', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 'admin', 1),
(2, 'bodega1', 'bodega1@bodega.com', '9413b2ec11165b54fcbcc9ea60ada2d8', 'bodega', 1),
(3, 'produccion1', 'prod1@prod.com', 'a220a758ba49c02182c149281844037f', 'produccion', 1),
(4, 'ventas1', 'ventas1@ventas.com', '45b0af22e7f541882f31aba445e13617', 'ventas', 1),
(5, 'reportes1', 'report1@report.com', 'b1fb16165c08b317a4bc538ad3076f54', 'reportes', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_prod`
--

CREATE TABLE `orden_prod` (
  `NumeroOrden` int(10) NOT NULL,
  `FechaGeneracion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NombrePizza` varchar(50) NOT NULL,
  `Cantidad_Pizza` int(11) NOT NULL,
  `Total_Pizza` float NOT NULL,
  `Precio_Orden` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `orden_prod`
--

INSERT INTO `orden_prod` (`NumeroOrden`, `FechaGeneracion`, `NombrePizza`, `Cantidad_Pizza`, `Total_Pizza`, `Precio_Orden`) VALUES
(1, '2023-08-27 19:41:36', 'Pizza hawaiana', 1, 8.15, 8.15),
(2, '2023-08-27 19:41:41', 'Pizza jamon', 2, 8.85, 17.7),
(3, '2023-08-27 19:41:46', 'Pizza peperoni', 1, 6.65, 6.65),
(4, '2023-08-27 20:25:08', 'Pizza jamon', 2, 8.85, 17.7),
(5, '2023-08-27 20:41:22', 'Pizza margarita', 3, 28.75, 86.25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_is`
--

CREATE TABLE `registro_is` (
  `ID` int(10) NOT NULL,
  `FechaIng` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `registro_is`
--

INSERT INTO `registro_is` (`ID`, `FechaIng`, `UserName`, `Email`) VALUES
(1, '2023-08-26 19:47:14', 'admin1', 'admin1@admin.com'),
(2, '2023-08-26 19:48:17', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-26 19:49:01', 'mateo', 'condormateo00@gmail.com'),
(6, '2023-08-26 19:50:16', 'reportes1', 'report1@report.com'),
(1, '2023-08-26 19:54:45', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:04:38', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:14:11', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:35:55', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:36:05', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:43:38', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:43:51', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:44:35', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:44:55', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:45:06', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 20:54:05', 'admin1', 'admin1@admin.com'),
(2, '2023-08-26 20:55:18', 'bodega', 'bodega1@bodega.com'),
(1, '2023-08-26 20:57:23', 'admin1', 'admin1@admin.com'),
(2, '2023-08-26 20:59:08', 'bodega', 'bodega1@bodega.com'),
(2, '2023-08-26 21:03:02', 'bodega', 'bodega1@bodega.com'),
(1, '2023-08-26 21:03:11', 'admin1', 'admin1@admin.com'),
(2, '2023-08-26 21:09:53', 'bodega', 'bodega1@bodega.com'),
(2, '2023-08-26 21:57:41', 'bodega', 'bodega1@bodega.com'),
(1, '2023-08-26 22:05:50', 'admin1', 'admin1@admin.com'),
(1, '2023-08-26 22:08:21', 'Administrador', 'admin@admin.com'),
(2, '2023-08-26 22:09:12', 'bodega', 'bodega1@bodega.com'),
(2, '2023-08-26 22:09:43', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-26 22:53:44', 'produccion1', 'prod1@prod.com'),
(1, '2023-08-26 22:55:02', 'Administrador', 'admin@admin.com'),
(3, '2023-08-26 22:55:32', 'produccion1', 'prod1@prod.com'),
(2, '2023-08-26 22:56:58', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-26 23:03:25', 'produccion1', 'prod1@prod.com'),
(2, '2023-08-27 09:12:20', 'bodega1', 'bodega1@bodega.com'),
(1, '2023-08-27 14:53:00', 'Administrador', 'admin@admin.com'),
(2, '2023-08-27 14:53:14', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 14:53:26', 'produccion1', 'prod1@prod.com'),
(4, '2023-08-27 14:53:40', 'ventas1', 'ventas1@ventas.com'),
(4, '2023-08-27 14:54:05', 'ventas1', 'ventas1@ventas.com'),
(2, '2023-08-27 15:06:19', 'bodega1', 'bodega1@bodega.com'),
(1, '2023-08-27 15:06:36', 'Administrador', 'admin@admin.com'),
(2, '2023-08-27 15:11:26', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 15:12:54', 'produccion1', 'prod1@prod.com'),
(1, '2023-08-27 15:14:55', 'Administrador', 'admin@admin.com'),
(3, '2023-08-27 15:15:24', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 15:15:34', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 17:09:20', 'produccion1', 'prod1@prod.com'),
(2, '2023-08-27 17:32:31', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 17:38:35', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 18:53:28', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 19:20:40', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 19:29:40', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 19:30:11', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 19:31:06', 'produccion1', 'prod1@prod.com'),
(1, '2023-08-27 19:32:15', 'Administrador', 'admin@admin.com'),
(3, '2023-08-27 19:32:24', 'produccion1', 'prod1@prod.com'),
(3, '2023-08-27 19:41:31', 'produccion1', 'prod1@prod.com'),
(1, '2023-08-27 19:50:57', 'Administrador', 'admin@admin.com'),
(1, '2023-08-27 20:11:44', 'Administrador', 'admin@admin.com'),
(2, '2023-08-27 20:12:51', 'bodega1', 'bodega1@bodega.com'),
(2, '2023-08-27 20:16:21', 'bodega1', 'bodega1@bodega.com'),
(2, '2023-08-27 20:18:03', 'bodega1', 'bodega1@bodega.com'),
(1, '2023-08-27 20:19:59', 'Administrador', 'admin@admin.com'),
(1, '2023-08-27 20:20:15', 'Administrador', 'admin@admin.com'),
(2, '2023-08-27 20:20:26', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 20:25:02', 'produccion1', 'prod1@prod.com'),
(1, '2023-08-27 20:31:18', 'Administrador', 'admin@admin.com'),
(4, '2023-08-27 20:31:39', 'ventas1', 'ventas1@ventas.com'),
(4, '2023-08-27 20:31:42', 'ventas1', 'ventas1@ventas.com'),
(1, '2023-08-27 20:31:59', 'Administrador', 'admin@admin.com'),
(5, '2023-08-27 20:35:46', 'reportes1', 'report1@report.com'),
(5, '2023-08-27 20:35:53', 'reportes1', 'report1@report.com'),
(1, '2023-08-27 20:36:07', 'Administrador', 'admin@admin.com'),
(2, '2023-08-27 20:37:03', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 20:37:13', 'produccion1', 'prod1@prod.com'),
(2, '2023-08-27 20:38:31', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 20:40:32', 'produccion1', 'prod1@prod.com'),
(4, '2023-08-27 20:45:34', 'ventas1', 'ventas1@ventas.com'),
(4, '2023-08-27 21:13:40', 'ventas1', 'ventas1@ventas.com'),
(1, '2023-08-27 21:14:33', 'Administrador', 'admin@admin.com'),
(3, '2023-08-27 21:15:53', 'produccion1', 'prod1@prod.com'),
(2, '2023-08-27 21:21:58', 'bodega1', 'bodega1@bodega.com'),
(3, '2023-08-27 21:51:19', 'produccion1', 'prod1@prod.com');

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
  `FechaIngreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tblingredientes`
--

INSERT INTO `tblingredientes` (`ID`, `Descripcion`, `Cantidad`, `Unidad`, `Precio`, `FechaIngreso`, `Active`) VALUES
(1, 'Peperoni', 2, 'Unidades', 1, '2023-08-26 17:17:12', '1'),
(2, 'Leche', 12, 'Litro/s', 0.9, '2023-08-26 17:21:23', '1'),
(3, 'Carne', 2, 'Kilogramo/s', 6.99, '2023-08-26 22:10:54', '1'),
(4, 'Queso', 5, 'Unidad/es', 3.75, '2023-08-26 22:12:46', '1'),
(5, 'Harina', 2, 'Kilogramo/s', 2.4, '2023-08-26 22:15:29', '1'),
(6, 'Jamon', 9, 'Kilogramo/s', 18, '2023-08-26 22:18:13', '1'),
(7, 'Piña', 2, 'Unidad/es', 1, '2023-08-27 17:34:25', '1'),
(8, 'Mozarrella', 3, 'Kilogramo/s', 4.2, '2023-08-27 20:39:07', '1'),
(9, 'Tomate', 10, 'Unidad/es', 0.15, '2023-08-27 20:39:32', '1'),
(10, 'Huevos', 36, 'Kilogramo/s', 0.2, '2023-08-27 20:39:53', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblingreso`
--

CREATE TABLE `tblingreso` (
  `ID` int(10) NOT NULL,
  `FechaIngreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CantIngresada` int(10) NOT NULL,
  `UnidadIng` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tblingreso`
--

INSERT INTO `tblingreso` (`ID`, `FechaIngreso`, `CantIngresada`, `UnidadIng`) VALUES
(4, '2023-08-26 22:25:25', 5, 'Unidad/es'),
(6, '2023-08-26 22:25:37', 7, 'kg'),
(2, '2023-08-26 22:57:11', 12, 'Litro/s'),
(6, '2023-08-27 15:11:41', 9, 'kg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_receta`
--
ALTER TABLE `datos_receta`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `mainlogin`
--
ALTER TABLE `mainlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden_prod`
--
ALTER TABLE `orden_prod`
  ADD PRIMARY KEY (`NumeroOrden`);

--
-- Indices de la tabla `tblingredientes`
--
ALTER TABLE `tblingredientes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_receta`
--
ALTER TABLE `datos_receta`
  MODIFY `Codigo` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mainlogin`
--
ALTER TABLE `mainlogin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orden_prod`
--
ALTER TABLE `orden_prod`
  MODIFY `NumeroOrden` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblingredientes`
--
ALTER TABLE `tblingredientes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
