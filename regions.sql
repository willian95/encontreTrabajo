-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2020 a las 15:42:52
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deira`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordinal_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `regions`
--

INSERT INTO `regions` (`id`, `name`, `ordinal_symbol`, `order`) VALUES
(1, 'Arica y Parinacota', 'XV', 1),
(2, 'Tarapacá', 'I', 2),
(3, 'Antofagasta', 'II', 3),
(4, 'Atacama', 'III', 4),
(5, 'Coquimbo', 'IV', 5),
(6, 'Valparaiso', 'V', 6),
(7, 'Metropolitana de Santiago', 'RM', 7),
(8, 'Libertador General Bernardo O\'Higgins', 'VI', 8),
(9, 'Maule', 'VII', 9),
(10, 'Ñuble', 'XVI', 10),
(11, 'Biobío', 'VIII', 11),
(12, 'La Araucanía', 'IX', 12),
(13, 'Los Ríos', 'XIV', 13),
(14, 'Los Lagos', 'X', 14),
(15, 'Aisén del General Carlos Ibáñez del Campo', 'XI', 15),
(16, 'Magallanes y de la Antártica Chilena', 'XII', 16);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
