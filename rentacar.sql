-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-08-2019 a las 18:04:13
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rentacar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adicionales`
--

DROP TABLE IF EXISTS `adicionales`;
CREATE TABLE IF NOT EXISTS `adicionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tarifa` decimal(10,0) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `adicionales`
--

INSERT INTO `adicionales` (`id`, `nombre`, `tarifa`, `habilitado`, `create`, `update`) VALUES
(1, 'GPS', '705', 1, '2019-08-13 12:39:42', '2019-08-13 14:03:58'),
(2, 'Silla Bebé', '600', 1, '2019-08-13 12:39:42', '2019-08-13 12:39:43'),
(3, 'Cadenas para nieve', '1000', 1, '2019-08-13 12:39:42', '2019-08-13 12:39:43'),
(4, 'Buster', '950', 1, '2019-08-13 12:39:42', '2019-08-13 12:39:43'),
(5, 'Permiso Aduana', '800', 1, '2019-08-13 12:39:42', '2019-08-13 12:39:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

DROP TABLE IF EXISTS `autos`;
CREATE TABLE IF NOT EXISTS `autos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `patente` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `viaja_chile` tinyint(1) DEFAULT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_autos_categorias1` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `create`, `update`) VALUES
(1, 1, 'Renault', 'Clio', 's', 1, 1, '2019-08-13 12:39:58', '2019-08-13 16:15:52'),
(2, 1, 'VW', 'Suran', '', 1, 1, '2019-08-13 12:39:58', '2019-08-13 16:16:16'),
(3, 1, 'Ford', 'Focus', 'JEM442', 1, 1, '2019-08-13 15:46:27', '2019-08-13 17:59:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `activa` tinyint(1) NOT NULL,
  `promo` tinyint(1) NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activa`, `promo`, `create`, `update`) VALUES
(1, 'Categoria A', 1, 1, '2019-08-13 12:36:48', '2019-08-13 12:38:01'),
(2, 'Categoria B', 1, 0, '2019-08-13 12:36:48', '2019-08-13 12:37:06'),
(3, 'Categoria C', 1, 0, '2019-08-13 12:36:48', '2019-08-13 12:37:06'),
(4, 'Categoria D', 1, 0, '2019-08-13 12:36:48', '2019-08-13 12:37:06'),
(5, 'Categoria E', 1, 0, '2019-08-13 12:36:48', '2019-08-13 12:37:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `nombre`, `valor`, `activa`, `create`, `update`) VALUES
(1, 'Dolar', '43.50', 1, '2019-08-13 12:38:54', '2019-08-13 12:38:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `hora_desde` time DEFAULT NULL,
  `hora_hasta` time DEFAULT NULL,
  `tarifa` decimal(10,2) DEFAULT NULL,
  `total_dias` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `origen` tinyint(1) DEFAULT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_Reservas_categorias1` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_categoria`, `nombre`, `fecha_desde`, `fecha_hasta`, `hora_desde`, `hora_hasta`, `tarifa`, `total_dias`, `estado`, `origen`, `create`, `update`) VALUES
(1, 1, 'Bruno Andres ', '2019-07-01', '2019-07-08', NULL, NULL, '600.00', 7, 1, 1, '2019-08-13 12:39:23', '2019-08-13 12:39:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_adicionales`
--

DROP TABLE IF EXISTS `reservas_adicionales`;
CREATE TABLE IF NOT EXISTS `reservas_adicionales` (
  `id_reserva` int(11) NOT NULL,
  `id_adicional` int(11) NOT NULL,
  PRIMARY KEY (`id_reserva`,`id_adicional`),
  KEY `fk_adicionales_has_reservas_reservas1` (`id_adicional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_detalle`
--

DROP TABLE IF EXISTS `reservas_detalle`;
CREATE TABLE IF NOT EXISTS `reservas_detalle` (
  `id_reserva` int(11) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `retiro` varchar(100) DEFAULT NULL,
  `entrega` varchar(100) DEFAULT NULL,
  `nro_vuelo` varchar(100) DEFAULT NULL,
  `observaciones` text,
  KEY `fk_Reservas_detalle_Reservas` (`id_reserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas_detalle`
--

INSERT INTO `reservas_detalle` (`id_reserva`, `telefono`, `email`, `retiro`, `entrega`, `nro_vuelo`, `observaciones`) VALUES
(1, '2944636416', 'brunoandres2013@gmail.com', 'aeropuerto', 'aeropuerto', '910', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

DROP TABLE IF EXISTS `tarifas`;
CREATE TABLE IF NOT EXISTS `tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `por_dia` decimal(10,0) DEFAULT NULL,
  `por_semana` decimal(10,0) DEFAULT NULL,
  `id_temporada` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_temporada` (`id_temporada`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `por_dia`, `por_semana`, `id_temporada`, `id_categoria`, `activa`, `create`, `update`) VALUES
(1, '1999', '11999', 1, 1, 1, '2019-08-13 12:40:12', '2019-08-13 12:40:13'),
(2, '2400', '13000', 1, 2, 1, '2019-08-13 12:40:12', '2019-08-13 12:40:13'),
(3, '3000', '13000', 1, 3, 1, '2019-08-13 12:40:12', '2019-08-13 12:40:13'),
(4, '3190', '14008', 1, 4, 1, '2019-08-13 12:40:12', '2019-08-13 12:40:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

DROP TABLE IF EXISTS `temporadas`;
CREATE TABLE IF NOT EXISTS `temporadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `activa` tinyint(1) NOT NULL,
  `observaciones` text,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id`, `nombre`, `fecha_desde`, `fecha_hasta`, `activa`, `observaciones`, `create`, `update`) VALUES
(1, 'Hasta fin de año', '2019-08-01', '2019-12-31', 1, 'Esta temporada incluye desde el 01/08/2019 hasta fin de año 2019', '2019-08-13 12:40:25', '2019-08-13 17:58:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `pass`, `create`, `update`) VALUES
(2, 'administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2019-08-13 12:40:41', '2019-08-13 12:41:54'),
(3, 'Jimena', 'jimena', 'c6b5942a869015c357bff85b5407eb4b', '2019-08-13 12:40:41', '2019-08-13 12:40:41'),
(4, 'Daniel Gonzalez', 'dgonzalez', '18171f36b7205bc7901cd68e4c56f22c', '2019-08-13 12:40:41', '2019-08-13 12:40:41');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autos`
--
ALTER TABLE `autos`
  ADD CONSTRAINT `fk_autos_categorias1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_Reservas_categorias1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas_adicionales`
--
ALTER TABLE `reservas_adicionales`
  ADD CONSTRAINT `fk_adicionales_has_reservas_adicionales1` FOREIGN KEY (`id_reserva`) REFERENCES `adicionales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adicionales_has_reservas_reservas1` FOREIGN KEY (`id_adicional`) REFERENCES `reservas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas_detalle`
--
ALTER TABLE `reservas_detalle`
  ADD CONSTRAINT `fk_Reservas_detalle_Reservas` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD CONSTRAINT `tarifas_ibfk_1` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`),
  ADD CONSTRAINT `tarifas_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
