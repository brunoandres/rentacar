-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-09-2019 a las 18:01:51
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
  `observaciones` text NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `adicionales`
--

INSERT INTO `adicionales` (`id`, `nombre`, `tarifa`, `habilitado`, `observaciones`, `create`, `update`) VALUES
(1, 'GPS SATELITAL', '500', 1, '', '2019-09-02 17:37:11', '2019-09-02 17:37:11'),
(2, 'Buster', '500', 1, '', '2019-09-17 15:22:52', '2019-09-17 15:22:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditorias`
--

DROP TABLE IF EXISTS `auditorias`;
CREATE TABLE IF NOT EXISTS `auditorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `query` text COLLATE utf8_spanish2_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `auditorias`
--

INSERT INTO `auditorias` (`id`, `id_usuario`, `query`, `date`) VALUES
(1, 2, 'INSERT INTO `temporadas`(`nombre`,`fecha_desde`, `fecha_hasta`, `activa`, `observaciones`) VALUES (\'test\',\'2019-12-31\',\'2019-09-01\',1,\'\')', '2019-09-17 16:29:20'),
(2, 2, 'INSERT INTO `temporadas`(`nombre`,`fecha_desde`, `fecha_hasta`, `activa`, `observaciones`) VALUES (\'Test\',\'2019-09-17\',\'2019-09-17\',1,\'\')', '2019-09-17 16:32:25'),
(3, 2, 'UPDATE `temporadas` SET `nombre`=\'Test\',`fecha_desde`=\'2019-09-01\',`fecha_hasta`=\'2019-09-30\',`activa`=1,`observaciones`=\'  \' WHERE id = 1', '2019-09-17 16:33:40'),
(4, 2, 'INSERT INTO `temporadas`(`nombre`,`fecha_desde`, `fecha_hasta`, `activa`, `observaciones`) VALUES (\'TEST OCTUBRE\',\'2019-10-01\',\'2019-10-31\',1,\'\')', '2019-09-17 16:33:59'),
(5, 2, 'UPDATE `temporadas` SET `nombre`=\'Test SEPTIEMBRE\',`fecha_desde`=\'2019-09-01\',`fecha_hasta`=\'2019-09-30\',`activa`=1,`observaciones`=\'    \' WHERE id = 1', '2019-09-17 16:34:08'),
(6, 2, 'INSERT INTO `tarifas`(`por_dia`, `por_semana`, `id_temporada`, `id_categoria`, `activa`) VALUES (\'5000\',\'20000\',2,1,1)', '2019-09-17 16:34:24'),
(7, 2, 'UPDATE `tarifas` SET `por_dia`=\'5000\',`por_semana`=\'20000\',`id_temporada`=2,`id_categoria`=1,`activa`=0 WHERE id = 3', '2019-09-17 16:35:08'),
(8, 2, 'UPDATE `tarifas` SET `por_dia`=\'5000\',`por_semana`=\'20000\',`id_temporada`=2,`id_categoria`=1,`activa`=1 WHERE id = 3', '2019-09-17 16:35:43'),
(9, 2, 'UPDATE `tarifas` SET `por_dia`=\'5000\',`por_semana`=\'20000\',`id_temporada`=2,`id_categoria`=1,`activa`=0 WHERE id = 3', '2019-09-17 16:35:53');

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
  `observaciones` text NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_autos_categorias1` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`, `create`, `update`) VALUES
(1, 1, 'Renault', 'Clio', 'AA766KG', 1, 1, '', '2019-09-17 14:47:10', '2019-09-17 14:47:10'),
(2, 1, 'Renault', 'Kwid', 'AC287PN', 1, 0, '', '2019-09-17 14:49:22', '2019-09-17 14:49:22'),
(3, 1, 'Volkswagen', 'Gol Trend', 'AC339UB', 1, 0, '', '2019-09-17 14:49:49', '2019-09-17 14:49:49'),
(4, 1, 'Volkswagen', 'Gol Trend', 'AC179CZ', 1, 0, '', '2019-09-17 14:50:00', '2019-09-17 14:50:00'),
(5, 1, 'Volkswagen', 'Gol Trend', 'AD308NK', 1, 0, '', '2019-09-17 14:50:16', '2019-09-17 14:50:16'),
(6, 1, 'Chevrolet', 'Corsa', 'AA635GB', 1, 1, '', '2019-09-17 14:50:29', '2019-09-17 14:50:29'),
(7, 2, 'Chevrolet', 'Prisma', 'AA983CY', 1, 0, '', '2019-09-17 14:50:49', '2019-09-17 14:50:49'),
(8, 2, 'Volkswagen', 'Voyage', 'AB414LB', 1, 1, '', '2019-09-17 14:51:08', '2019-09-17 14:51:08'),
(9, 2, 'Volkswagen', 'Voyage', 'AA376IF', 1, 0, '', '2019-09-17 14:51:23', '2019-09-17 14:51:23'),
(10, 2, 'Volkswagen', 'Voyage', 'AB808XX', 1, 0, '', '2019-09-17 14:51:35', '2019-09-17 14:51:35'),
(11, 2, 'Volkswagen', 'Voyage', 'AA105WP', 1, 1, '', '2019-09-17 14:51:49', '2019-09-17 14:51:49'),
(12, 2, 'Volkswagen', 'Voyage', 'AB279VX', 1, 1, '', '2019-09-17 14:52:29', '2019-09-17 14:52:29'),
(13, 2, 'Renault', 'Sandero', 'AC530WI', 1, 0, '', '2019-09-17 14:52:42', '2019-09-17 14:52:42'),
(14, 3, 'Fiat', 'Cronos', 'AC781UR', 1, 0, '', '2019-09-17 14:53:55', '2019-09-17 14:53:55'),
(15, 3, 'Volkswagen', 'Suran', 'AB441JF', 1, 1, '', '2019-09-17 14:54:17', '2019-09-17 14:54:17'),
(16, 3, 'Volkswagen', 'Suran', 'AA392NK', 1, 0, '', '2019-09-17 14:54:37', '2019-09-17 14:54:37'),
(17, 4, 'Chevrolet', 'Spin', 'AC882XL', 1, 0, '', '2019-09-17 14:56:36', '2019-09-17 14:56:36'),
(18, 4, 'Chevrolet', 'Spin', 'AD172UZ', 1, 1, '', '2019-09-17 14:56:53', '2019-09-17 14:56:53'),
(19, 4, 'Chevrolet', 'Spin', 'AB574AD', 1, 1, '', '2019-09-17 14:57:11', '2019-09-17 14:57:11'),
(20, 5, 'Hyundai', 'H1', 'OXG978', 1, 1, '', '2019-09-17 14:57:30', '2019-09-17 14:57:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `activa` tinyint(1) NOT NULL,
  `promo` tinyint(1) DEFAULT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activa`, `promo`, `create`, `update`) VALUES
(1, 'Categoria A', 1, 1, '2019-09-17 14:42:12', '2019-09-17 15:15:18'),
(2, 'Categoria B', 1, 0, '2019-09-17 14:42:23', '2019-09-17 14:42:23'),
(3, 'Categoria C', 1, 0, '2019-09-17 14:42:30', '2019-09-17 14:42:30'),
(4, 'Categoria D', 1, 0, '2019-09-17 14:42:36', '2019-09-17 14:42:49'),
(5, 'Categoria E', 1, 0, '2019-09-17 14:42:58', '2019-09-17 14:42:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `activa` tinyint(1) DEFAULT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `nombre`, `valor`, `activa`, `create`, `update`) VALUES
(1, 'Dolar', '60.00', 1, '2019-08-13 15:38:54', '2019-09-17 15:25:52'),
(3, 'Porcentaje Adicional', '80.00', 0, '2019-08-16 19:16:00', '2019-09-17 15:25:07'),
(4, 'Porcentaje Descuento', '12.00', 0, '2019-08-16 19:18:37', '2019-09-17 15:25:10'),
(5, 'Margen Horario', '1.00', 1, '2019-08-29 15:04:40', '2019-09-11 13:58:15'),
(6, 'Cantidad Dias', '1.00', 1, '2019-08-29 15:04:58', '2019-08-29 15:23:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

DROP TABLE IF EXISTS `lugares`;
CREATE TABLE IF NOT EXISTS `lugares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lugar` varchar(200) COLLATE utf32_spanish2_ci NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `observaciones` text COLLATE utf32_spanish2_ci NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id`, `lugar`, `activo`, `observaciones`, `create`, `update`) VALUES
(1, 'Cerro Catedral', 1, '', '2019-09-02 17:35:58', '2019-09-02 17:35:58'),
(2, 'Aeropuerto Bariloche', 1, '', '2019-09-02 17:36:09', '2019-09-02 17:36:09'),
(3, 'Terminal Omnibus', 1, '', '2019-09-03 17:21:20', '2019-09-03 17:21:20'),
(4, 'Centro Bariloche', 1, '', '2019-09-17 15:21:19', '2019-09-17 15:21:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `hora_desde` time DEFAULT NULL,
  `hora_hasta` time DEFAULT NULL,
  `tarifa` decimal(10,2) DEFAULT NULL,
  `total_dias` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `origen` tinyint(1) DEFAULT NULL COMMENT 'reserva desde el panel = null, 1 es desde la web',
  `exterior` tinyint(1) DEFAULT NULL COMMENT 'para saber si viaja a chile',
  `adicionales` tinyint(1) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `retiro` tinyint(1) NOT NULL,
  `entrega` tinyint(1) NOT NULL,
  `nro_vuelo` varchar(50) NOT NULL,
  `observaciones` text NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `color` varchar(15) DEFAULT NULL,
  `id_auto` int(11) DEFAULT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_Reservas_categorias1` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_categoria`, `codigo`, `nombre`, `apellido`, `fecha_desde`, `fecha_hasta`, `hora_desde`, `hora_hasta`, `tarifa`, `total_dias`, `estado`, `origen`, `exterior`, `adicionales`, `telefono`, `email`, `retiro`, `entrega`, `nro_vuelo`, `observaciones`, `start`, `end`, `color`, `id_auto`, `create`, `update`) VALUES
(1, 1, '79510', 'Andres', 'Ovando', '2019-09-17', '2019-09-24', '12:00:00', '12:00:00', '7500.00', 7, 1, 1, NULL, 0, '2944636416', 'brunoandres2013@gmail.com', 2, 2, '', '', '2019-09-17 15:00:00', '2019-09-24 15:00:00', '#FF0000', NULL, '2019-09-17 15:17:05', '2019-09-17 15:17:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `por_dia`, `por_semana`, `id_temporada`, `id_categoria`, `activa`, `create`, `update`) VALUES
(1, '2500', '7500', 1, 1, 1, '2019-09-17 15:12:51', '2019-09-17 15:12:51'),
(2, '3000', '8900', 1, 2, 1, '2019-09-17 15:14:14', '2019-09-17 15:14:14'),
(3, '5000', '20000', 2, 1, 0, '2019-09-17 16:34:24', '2019-09-17 16:35:53');

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
(1, 'Test SEPTIEMBRE', '2019-09-01', '2019-09-30', 1, '    ', '2019-09-17 16:32:25', '2019-09-17 16:34:08'),
(2, 'TEST OCTUBRE', '2019-10-01', '2019-10-31', 1, '', '2019-09-17 16:33:59', '2019-09-17 16:33:59');

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
  `admin` tinyint(1) NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `pass`, `admin`, `create`, `update`) VALUES
(2, 'administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-08-13 12:40:41', '2019-09-02 15:58:15'),
(3, 'Jimena', 'jimena', 'c6b5942a869015c357bff85b5407eb4b', 0, '2019-08-13 12:40:41', '2019-08-13 12:40:41'),
(4, 'Daniel Gonzalez', 'dgonzalez', '18171f36b7205bc7901cd68e4c56f22c', 0, '2019-08-13 12:40:41', '2019-08-13 12:40:41');

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
-- Filtros para la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD CONSTRAINT `tarifas_ibfk_1` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`),
  ADD CONSTRAINT `tarifas_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
