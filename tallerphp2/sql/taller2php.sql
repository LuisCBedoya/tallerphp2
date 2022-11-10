-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2022 a las 22:16:47
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taller2php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla1`
--

CREATE TABLE `tabla1` (
  `id` int(15) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla1`
--

INSERT INTO `tabla1` (`id`, `nombre`, `apellido`, `sexo`) VALUES
(3, 'Luis', 'Bedoya', 'M'),
(4, 'Mandy', 'Gonzales', 'M'),
(5, 'Nando', 'Julio', 'M'),
(35, 'Camila', 'perez', 'F'),
(36, 'Francisco', 'Martinez', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla2`
--

CREATE TABLE `tabla2` (
  `id` int(15) NOT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `ciudad` varchar(20) DEFAULT NULL,
  `fecha_ped` datetime DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `fecha` date NOT NULL,
  `valor` int(20) DEFAULT NULL,
  `cantidad_prod` float DEFAULT NULL,
  `correo` varchar(20) DEFAULT NULL,
  `fk_tabla_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tabla2`
--

INSERT INTO `tabla2` (`id`, `departamento`, `ciudad`, `fecha_ped`, `fecha_nac`, `fecha`, `valor`, `cantidad_prod`, `correo`, `fk_tabla_1`) VALUES
(15, 'Sucre', 'Sincelejo', '2022-07-20 07:26:13', '2022-09-26', '2022-09-26', 234700, 3, 'merry@gmail.com', 35),
(16, 'Cordoba', 'Monteria', '2022-07-29 08:26:22', '1998-08-24', '2022-07-16', 312000, 2, 'correo', 36),
(17, 'Bolivar', 'Cartagena', '2022-06-30 10:25:17', '1997-05-27', '2022-08-26', 432000, 4, 'Elcorreo', 5),
(18, 'Valle del cauca', 'Cali', '2022-07-12 07:31:18', '1995-07-16', '2022-01-26', 734000, 5, 'CORREOOO', 4),
(19, 'Antioquia', 'Medellin', '2022-05-24 16:20:25', '1994-06-18', '2022-03-01', 598000, 5, 'Correo.correo', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tabla1`
--
ALTER TABLE `tabla1`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla2`
--
ALTER TABLE `tabla2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tabla_1` (`fk_tabla_1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tabla1`
--
ALTER TABLE `tabla1`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tabla2`
--
ALTER TABLE `tabla2`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tabla2`
--
ALTER TABLE `tabla2`
  ADD CONSTRAINT `tabla2_ibfk_1` FOREIGN KEY (`fk_tabla_1`) REFERENCES `tabla1` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
