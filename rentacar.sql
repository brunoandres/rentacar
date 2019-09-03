-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-09-2019 a las 18:00:49
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `adicionales`
--

INSERT INTO `adicionales` (`id`, `nombre`, `tarifa`, `habilitado`, `observaciones`, `create`, `update`) VALUES
(1, 'GPS SATELITAL', '500', 1, '', '2019-09-02 17:37:11', '2019-09-02 17:37:11');

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
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `auditorias`
--

INSERT INTO `auditorias` (`id`, `id_usuario`, `query`, `date`) VALUES
(1, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=1,`viaja_chile`=0 WHERE id = 3', '2019-08-15 20:49:41'),
(2, 2, 'UPDATE `temporadas` SET `nombre`=\'Hasta fin de año\',`fecha_desde`=\'2019-08-01\',`fecha_hasta`=\'2019-12-31\',`activa`=0,`observaciones`=\' Esta temporada incluye desde el 01/08/2019 hasta fin de año 2019 \' WHERE id = 1', '2019-08-15 20:54:09'),
(3, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=1,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-15 21:02:04'),
(4, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'S\',`estado`=1,`viaja_chile`=1, `observaciones`=\'pequeño rayon lateral detecho \' WHERE id = 1', '2019-08-15 21:02:21'),
(5, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=1,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-15 21:03:01'),
(6, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'S\',`estado`=1,`viaja_chile`=1, `observaciones`=\'pequeño rayon lateral detecho \' WHERE id = 1', '2019-08-15 21:03:04'),
(7, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'VW\',`modelo`=\'Suran\',`patente`=\'\',`estado`=1,`viaja_chile`=1, `observaciones`=\'\' WHERE id = 2', '2019-08-15 21:03:09'),
(8, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'VW\',`modelo`=\'Suran\',`patente`=\'AA123AA\',`estado`=1,`viaja_chile`=1, `observaciones`=\'\' WHERE id = 2', '2019-08-15 21:03:45'),
(9, 2, 'INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`) VALUES (2,\'Renault\',\'Sandero\',\'1\',1,0,\'\')', '2019-08-15 21:05:08'),
(10, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'VW\',`modelo`=\'Suran\',`patente`=\'AA123A\',`estado`=1,`viaja_chile`=1, `observaciones`=\'\' WHERE id = 2', '2019-08-15 21:09:49'),
(11, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'VW\',`modelo`=\'Suran\',`patente`=\'AB123CD\',`estado`=1,`viaja_chile`=1, `observaciones`=\'\' WHERE id = 2', '2019-08-15 21:10:09'),
(12, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'S\',`estado`=1,`viaja_chile`=1, `observaciones`=\'pequeño rayon lateral detecho \' WHERE id = 1', '2019-08-15 21:10:13'),
(13, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'ABC123\',`estado`=1,`viaja_chile`=1, `observaciones`=\'pequeño rayon lateral detecho \' WHERE id = 1', '2019-08-15 21:10:31'),
(14, 2, 'UPDATE `autos` SET `id_categoria`=2,`marca`=\'Renault\',`modelo`=\'Sandero\',`patente`=\'ABD696\',`estado`=1,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 8', '2019-08-15 21:10:39'),
(15, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM4427\',`estado`=1,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-15 21:10:50'),
(16, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=1,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-15 21:10:54'),
(17, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=0,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-15 21:11:29'),
(18, 2, 'INSERT INTO `adicionales`(`nombre`, `tarifa`, `habilitado`) VALUES (\'Equipo celular\',\'1300\',1)', '2019-08-15 21:16:41'),
(19, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=1, `observaciones`=\'nada de nada!\' WHERE id = 4', '2019-08-15 21:22:51'),
(20, 2, 'UPDATE `adicionales` SET `nombre`=\'Cadenas para nieve\',`tarifa`=\'1000\',`habilitado`=1, `observaciones`=\'cadenas para nieve el par\' WHERE id = 3', '2019-08-15 21:23:00'),
(21, 2, 'UPDATE `adicionales` SET `nombre`=\'Equipo celular\',`tarifa`=\'1300\',`habilitado`=1, `observaciones`=\'chip movistar o a eleccion\' WHERE id = 6', '2019-08-15 21:23:13'),
(22, 2, 'UPDATE `adicionales` SET `nombre`=\'GPS\',`tarifa`=\'705\',`habilitado`=1, `observaciones`=\'gps\' WHERE id = 1', '2019-08-15 21:23:20'),
(23, 2, 'UPDATE `adicionales` SET `nombre`=\'Permiso Aduana\',`tarifa`=\'800\',`habilitado`=1, `observaciones`=\'formulario necesario para pasar a chile\' WHERE id = 5', '2019-08-15 21:23:40'),
(24, 2, 'UPDATE `adicionales` SET `nombre`=\'Silla Bebé\',`tarifa`=\'600\',`habilitado`=1, `observaciones`=\'silla para bebes\' WHERE id = 2', '2019-08-15 21:23:46'),
(25, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=1, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-08-15 21:27:37'),
(26, 2, 'UPDATE `adicionales` SET `nombre`=\'GPS\',`tarifa`=\'705\',`habilitado`=1, `observaciones`=\'gps gps gps gps gps gps gps gps\' WHERE id = 1', '2019-08-15 21:27:55'),
(27, 2, 'UPDATE `tarifas` SET `por_dia`=\'2400\',`por_semana`=\'12999\',`id_temporada`=1,`id_categoria`=2,`activa`=1 WHERE id = 2', '2019-08-16 15:56:41'),
(28, 2, 'UPDATE `tarifas` SET `por_dia`=\'2000\',`por_semana`=\'12000\',`id_temporada`=1,`id_categoria`=1,`activa`=1 WHERE id = 1', '2019-08-16 15:58:03'),
(29, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria B\',`activa`=1,`promo`=1 WHERE id = 2', '2019-08-16 15:58:29'),
(30, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria C\',`activa`=1,`promo`=1 WHERE id = 3', '2019-08-16 15:58:32'),
(31, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria D\',`activa`=1,`promo`=1 WHERE id = 4', '2019-08-16 15:58:36'),
(32, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria E\',`activa`=1,`promo`=1 WHERE id = 5', '2019-08-16 15:58:39'),
(33, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60\',`activa`=0 WHERE id = 1', '2019-08-16 16:00:49'),
(34, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'62\',`activa`=0 WHERE id = 1', '2019-08-16 16:01:48'),
(35, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'62,5\',`activa`=0 WHERE id = 1', '2019-08-16 16:01:54'),
(36, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'62.5\',`activa`=0 WHERE id = 1', '2019-08-16 16:01:59'),
(37, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60\',`activa`=0 WHERE id = 1', '2019-08-16 16:02:14'),
(38, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60\',`activa`=0 WHERE id = 1', '2019-08-16 16:03:54'),
(39, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60\',`activa`=0 WHERE id = 1', '2019-08-16 16:04:05'),
(40, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'asd\',`activa`=0 WHERE id = 1', '2019-08-16 16:04:11'),
(41, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'8\',`activa`=0 WHERE id = 1', '2019-08-16 16:04:24'),
(42, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=0 WHERE id = 1', '2019-08-16 16:05:22'),
(43, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=0 WHERE id = 1', '2019-08-16 16:05:28'),
(44, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=0 WHERE id = 1', '2019-08-16 16:05:31'),
(45, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=0 WHERE id = 1', '2019-08-16 16:05:36'),
(46, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=0 WHERE id = 1', '2019-08-16 16:05:51'),
(47, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=1 WHERE id = 1', '2019-08-16 16:07:03'),
(48, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=0 WHERE id = 1', '2019-08-16 16:07:06'),
(49, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=1 WHERE id = 1', '2019-08-16 16:07:09'),
(50, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'1\',`activa`=1 WHERE id = 1', '2019-08-16 16:08:01'),
(51, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'13\',`activa`=1 WHERE id = 1', '2019-08-16 16:08:05'),
(52, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'13\',`activa`=1 WHERE id = 1', '2019-08-16 16:08:11'),
(53, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'13\',`activa`=1 WHERE id = 1', '2019-08-16 16:14:23'),
(54, 2, 'INSERT INTO `configuraciones`(`nombre`, `valor`,`activa`) VALUES (\'\',\'5\',1)', '2019-08-16 16:15:42'),
(55, 2, 'INSERT INTO `configuraciones`(`nombre`, `valor`,`activa`) VALUES (\'Porcentaje Adicional\',\'5\',1)', '2019-08-16 16:16:00'),
(56, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'0\',`activa`=1 WHERE id = 3', '2019-08-16 16:16:38'),
(57, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'0\',`activa`=1 WHERE id = 3', '2019-08-16 16:16:42'),
(58, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'0.05\',`activa`=1 WHERE id = 3', '2019-08-16 16:17:05'),
(59, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'0.06\',`activa`=1 WHERE id = 3', '2019-08-16 16:17:19'),
(60, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'89\',`activa`=1 WHERE id = 3', '2019-08-16 16:17:27'),
(61, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'15\',`activa`=1 WHERE id = 3', '2019-08-16 16:17:52'),
(62, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60\',`activa`=1 WHERE id = 1', '2019-08-16 16:18:17'),
(63, 2, 'UPDATE `configuraciones` SET `nombre`=\'Porcentaje Adicional\',`valor`=\'80\',`activa`=1 WHERE id = 3', '2019-08-16 16:18:26'),
(64, 2, 'INSERT INTO `configuraciones`(`nombre`, `valor`,`activa`) VALUES (\'Porcentaje Descuento\',\'12\',1)', '2019-08-16 16:18:37'),
(65, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60.00\',`activa`=0 WHERE id = 1', '2019-08-16 16:19:46'),
(66, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60.00\',`activa`=1 WHERE id = 1', '2019-08-16 16:19:51'),
(67, 2, 'INSERT INTO `categorias`(`nombre`, `activa`, `promo`) VALUES (\'23\',1,1)', '2019-08-16 16:26:12'),
(68, 2, 'UPDATE `categorias` SET `nombre`=\'23\',`activa`=0,`promo`=0 WHERE id = 6', '2019-08-16 16:26:36'),
(69, 2, 'UPDATE `temporadas` SET `nombre`=\'Hasta fin de año\',`fecha_desde`=\'2019-08-01\',`fecha_hasta`=\'2019-12-31\',`activa`=1,`observaciones`=\'  Esta temporada incluye desde el 01/08/2019 hasta fin de año 2019  \' WHERE id = 1', '2019-08-16 16:28:01'),
(70, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60.00\',`activa`=0 WHERE id = 1', '2019-08-16 16:29:14'),
(71, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Aeropuerto\',1,\'\')', '2019-08-16 17:08:13'),
(72, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Centro Civico\',1,\'\')', '2019-08-19 14:40:05'),
(73, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Terminal ómnibus Bariloche\',1,\'\')', '2019-08-19 14:40:47'),
(74, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Hotel Llao Llao\',0,\'\')', '2019-08-19 14:41:06'),
(75, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'ABC123\',`estado`=1,`viaja_chile`=1, `observaciones`=\'pequeño rayon lateral derecho \' WHERE id = 1', '2019-08-19 14:59:01'),
(76, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=0,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-19 15:01:42'),
(77, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Ford\',`modelo`=\'Focus\',`patente`=\'JEM442\',`estado`=1,`viaja_chile`=0, `observaciones`=\'auto de bruno!\' WHERE id = 3', '2019-08-19 15:01:46'),
(78, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-08-20 15:09:30'),
(79, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=1 WHERE id = 1', '2019-08-20 15:18:02'),
(80, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-08-20 15:18:49'),
(81, 2, 'INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`) VALUES (2,\'Renault\',\'Duster\',\'AAAAAAA\',1,0,\'\')', '2019-08-23 15:54:07'),
(82, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria C\',`activa`=1,`promo`=0 WHERE id = 3', '2019-08-23 16:23:30'),
(83, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria D\',`activa`=1,`promo`=0 WHERE id = 4', '2019-08-23 16:23:34'),
(84, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria E\',`activa`=1,`promo`=0 WHERE id = 5', '2019-08-23 16:23:37'),
(85, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria B\',`activa`=1,`promo`=1 WHERE id = 2', '2019-08-23 16:23:45'),
(86, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria B\',`activa`=1,`promo`=1 WHERE id = 2', '2019-08-23 16:23:48'),
(87, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria B\',`activa`=1,`promo`=0 WHERE id = 2', '2019-08-23 16:23:59'),
(88, 2, 'INSERT INTO `reservas`(`id_categoria`, `codigo`, `nombre`, `apellido`, `fecha_desde`, `fecha_hasta`, `hora_desde`, `hora_hasta`, `tarifa`, `total_dias`, `estado`, `origen`) VALUES (2,\'EWR8I\',\'bruno\',\'ovando\',\'2019-08-23\',\'2019-08-27\',\'\',\'\',\'9600\',4,1,1)', '2019-08-23 16:39:07'),
(89, 2, 'INSERT INTO `reservas_detalle`(`id_reserva`, `telefono`, `email`, `retiro`, `entrega`, `nro_vuelo`, `observaciones`) VALUES (7,\'2944636416\',\'andres.92013@hotmail.com\',1,1,\'\',\'\')', '2019-08-23 16:39:07'),
(90, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=0, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-08-23 17:23:41'),
(91, 2, 'UPDATE `adicionales` SET `nombre`=\'Cadenas para nieve\',`tarifa`=\'1000\',`habilitado`=0, `observaciones`=\'cadenas para nieve el par\' WHERE id = 3', '2019-08-23 17:23:46'),
(92, 2, 'UPDATE `adicionales` SET `nombre`=\'Equipo celular\',`tarifa`=\'1300\',`habilitado`=0, `observaciones`=\'chip movistar o a eleccion\' WHERE id = 6', '2019-08-23 17:23:50'),
(93, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=1, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-08-28 14:40:19'),
(94, 2, 'UPDATE `adicionales` SET `nombre`=\'Cadenas para nieve\',`tarifa`=\'1000\',`habilitado`=1, `observaciones`=\'cadenas para nieve el par\' WHERE id = 3', '2019-08-28 14:40:28'),
(95, 2, 'UPDATE `lugares` SET `lugar`=\'Terminal ómnibus Bariloche\',`activo`=1, `observaciones`=\'estacionamiento terminal\' WHERE id = 3', '2019-08-28 15:01:01'),
(96, 2, 'UPDATE `lugares` SET `lugar`=\'Terminal ómnibus Bariloche\',`activo`=0, `observaciones`=\'estacionamiento terminal\' WHERE id = 3', '2019-08-28 15:01:07'),
(97, 2, 'UPDATE `lugares` SET `lugar`=\'Terminal ómnibus Bariloche\',`activo`=1, `observaciones`=\'estacionamiento terminal\' WHERE id = 3', '2019-08-28 15:01:24'),
(98, 2, 'UPDATE `lugares` SET `lugar`=\'Aeropuerto\',`activo`=0, `observaciones`=\'estacionamiento aeropuerto\' WHERE id = 1', '2019-08-28 15:01:32'),
(99, 2, 'UPDATE `lugares` SET `lugar`=\'Centro Civico\',`activo`=0, `observaciones`=\'centro civico plaza\' WHERE id = 2', '2019-08-28 15:01:36'),
(100, 2, 'UPDATE `configuraciones` SET `nombre`=\'Dolar\',`valor`=\'60.00\',`activa`=1 WHERE id = 1', '2019-08-28 15:02:01'),
(101, 2, 'UPDATE `adicionales` SET `nombre`=\'Equipo celular\',`tarifa`=\'1300\',`habilitado`=1, `observaciones`=\'chip movistar o a eleccion\' WHERE id = 6', '2019-08-28 15:02:16'),
(102, 2, 'UPDATE `autos` SET `id_categoria`=3,`marca`=\'OTRO DE CAT C\',`modelo`=\'NO SE\',`patente`=\'1\',`estado`=0,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 13', '2019-08-28 16:40:23'),
(103, 2, 'UPDATE `autos` SET `id_categoria`=3,`marca`=\'CATE C\',`modelo`=\'NI IDEA\',`patente`=\'PIRULO\',`estado`=0,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 12', '2019-08-28 16:48:49'),
(104, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'CATEGORIA A\',`modelo`=\'NULO\',`patente`=\'NULO\',`estado`=0,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 11', '2019-08-28 16:48:53'),
(105, 2, 'UPDATE `autos` SET `id_categoria`=2,`marca`=\'CUALQUIERA\',`modelo`=\'TAMBIEN\',`patente`=\'NOSE\',`estado`=0,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 10', '2019-08-28 16:48:57'),
(106, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'ABC123\',`estado`=0,`viaja_chile`=0, `observaciones`=\'pequeño rayon lateral derecho \' WHERE id = 1', '2019-08-28 16:49:01'),
(107, 2, 'UPDATE `autos` SET `id_categoria`=2,`marca`=\'Renault\',`modelo`=\'Duster\',`patente`=\'AAAAAAA\',`estado`=0,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 9', '2019-08-28 16:49:05'),
(108, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'CATEGORIA A\',`modelo`=\'NULO\',`patente`=\'NULO\',`estado`=1,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 11', '2019-08-28 16:49:20'),
(109, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'CATEGORIA A\',`modelo`=\'NULO\',`patente`=\'NULO\',`estado`=0,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 11', '2019-08-28 16:49:34'),
(110, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'CATEGORIA A\',`modelo`=\'NULO\',`patente`=\'NULO\',`estado`=1,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 11', '2019-08-28 16:49:48'),
(111, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'ABC123\',`estado`=1,`viaja_chile`=0, `observaciones`=\'pequeño rayon lateral derecho \' WHERE id = 1', '2019-08-28 16:51:03'),
(112, 2, 'INSERT INTO `configuraciones`(`nombre`, `valor`,`activa`) VALUES (\'Margen Horario\',\'2\',1)', '2019-08-29 12:04:40'),
(113, 2, 'INSERT INTO `configuraciones`(`nombre`, `valor`,`activa`) VALUES (\'Cantidad de Dias\',\'5\',1)', '2019-08-29 12:04:58'),
(114, 2, 'UPDATE `configuraciones` SET `nombre`=\'Cantidad Dias\',`valor`=\'5.00\',`activa`=1 WHERE id = 6', '2019-08-29 12:06:21'),
(115, 2, 'UPDATE `configuraciones` SET `nombre`=\'Cantidad Dias\',`valor`=\'1\',`activa`=1 WHERE id = 6', '2019-08-29 12:23:07'),
(116, 2, 'UPDATE `configuraciones` SET `nombre`=\'Margen Horario\',`valor`=\'1\',`activa`=1 WHERE id = 5', '2019-08-29 17:02:34'),
(117, 2, 'UPDATE `configuraciones` SET `nombre`=\'Margen Horario\',`valor`=\'1.00\',`activa`=0 WHERE id = 5', '2019-08-29 17:02:43'),
(118, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'Renault\',`modelo`=\'Clio\',`patente`=\'ABC123\',`estado`=0,`viaja_chile`=0, `observaciones`=\'pequeño rayon lateral derecho \' WHERE id = 1', '2019-08-29 17:26:36'),
(119, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=1 WHERE id = 1', '2019-09-01 15:51:13'),
(120, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=0,`promo`=0 WHERE id = 1', '2019-09-01 15:51:20'),
(121, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-09-01 15:53:00'),
(122, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=0,`promo`=0 WHERE id = 1', '2019-09-01 15:53:06'),
(123, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=0, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-09-01 15:55:00'),
(124, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-09-01 15:58:44'),
(125, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'CATEGORIA A\',`modelo`=\'NULO\',`patente`=\'NULO\',`estado`=1,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 11', '2019-09-01 15:59:28'),
(126, 2, 'UPDATE `autos` SET `id_categoria`=1,`marca`=\'CATEGORIA A\',`modelo`=\'NULO\',`patente`=\'JEM442\',`estado`=1,`viaja_chile`=0, `observaciones`=\'\' WHERE id = 11', '2019-09-01 15:59:38'),
(127, 2, 'UPDATE `tarifas` SET `por_dia`=\'4150\',`por_semana`=\'6900\',`id_temporada`=1,`id_categoria`=5,`activa`=1 WHERE id = 5', '2019-09-01 16:01:03'),
(128, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=1 WHERE id = 1', '2019-09-01 16:02:08'),
(129, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-09-01 16:09:24'),
(130, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=1 WHERE id = 1', '2019-09-01 16:09:38'),
(131, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-09-01 16:22:27'),
(132, 2, 'UPDATE `configuraciones` SET `nombre`=\'Margen Horario\',`valor`=\'1.00\',`activa`=0 WHERE id = 5', '2019-09-01 17:18:21'),
(133, 2, 'UPDATE `configuraciones` SET `nombre`=\'Margen Horario\',`valor`=\'1.00\',`activa`=0 WHERE id = 5', '2019-09-01 17:37:03'),
(134, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=1, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-09-02 11:42:13'),
(135, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=0, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-09-02 11:42:56'),
(136, 2, 'UPDATE `adicionales` SET `nombre`=\'Buster\',`tarifa`=\'950\',`habilitado`=1, `observaciones`=\'nada de nada! buster buster\' WHERE id = 4', '2019-09-02 11:43:03'),
(137, 2, 'UPDATE `lugares` SET `lugar`=\'Aeropuerto\',`activo`=1, `observaciones`=\'estacionamiento aeropuerto\' WHERE id = 1', '2019-09-02 15:57:09'),
(138, 2, 'UPDATE `lugares` SET `lugar`=\'Centro Civico\',`activo`=1, `observaciones`=\'centro civico plaza\' WHERE id = 2', '2019-09-02 15:57:17'),
(139, 2, 'INSERT INTO `categorias`(`nombre`, `activa`, `promo`) VALUES (\'CATEGORIA A\',1,0)', '2019-09-02 17:20:51'),
(140, 2, 'INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`) VALUES (1,\'Renault \',\'Clio\',\'PPH852\',1,0,\'\')', '2019-09-02 17:21:26'),
(141, 2, 'UPDATE `categorias` SET `nombre`=\'CATEGORIA A\',`activa`=0,`promo`=0 WHERE id = 1', '2019-09-02 17:21:46'),
(142, 2, 'UPDATE `categorias` SET `nombre`=\'CATEGORIA A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-09-02 17:29:41'),
(143, 2, 'INSERT INTO `temporadas`(`nombre`,`fecha_desde`, `fecha_hasta`, `activa`, `observaciones`) VALUES (\'HASTA FIN DE AÑO\',\'2019-12-31\',\'2019-09-01\',1,\'\')', '2019-09-02 17:31:06'),
(144, 2, 'UPDATE `temporadas` SET `nombre`=\'HASTA FIN DE AÑO\',`fecha_desde`=\'2019-12-31\',`fecha_hasta`=\'2019-09-01\',`activa`=0,`observaciones`=\'  \' WHERE id = 1', '2019-09-02 17:31:17'),
(145, 2, 'UPDATE `temporadas` SET `nombre`=\'HASTA FIN DE AÑO\',`fecha_desde`=\'2019-12-31\',`fecha_hasta`=\'2019-09-01\',`activa`=1,`observaciones`=\'    \' WHERE id = 1', '2019-09-02 17:31:34'),
(146, 2, 'INSERT INTO `tarifas`(`por_dia`, `por_semana`, `id_temporada`, `id_categoria`, `activa`) VALUES (\'1900\',\'5500\',1,1,1)', '2019-09-02 17:35:41'),
(147, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Cerro Catedral\',1,\'\')', '2019-09-02 17:35:58'),
(148, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Aeropuerto Bariloche\',1,\'\')', '2019-09-02 17:36:09'),
(149, 2, 'INSERT INTO `adicionales`(`nombre`, `tarifa`, `habilitado`, `observaciones`) VALUES (\'GPS SATELITAL\',\'500\',1,\'\')', '2019-09-02 17:37:11'),
(150, 2, 'UPDATE `categorias` SET `nombre`=\'Categoria A\',`activa`=1,`promo`=0 WHERE id = 1', '2019-09-03 17:18:34'),
(151, 2, 'INSERT INTO `categorias`(`nombre`, `activa`, `promo`) VALUES (\'Categoria B\',1,0)', '2019-09-03 17:18:41'),
(152, 2, 'INSERT INTO `categorias`(`nombre`, `activa`, `promo`) VALUES (\'Categoria C\',1,0)', '2019-09-03 17:18:51'),
(153, 2, 'INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`) VALUES (2,\'Volkswagen \',\'Voyage\',\'AA225BV\',1,0,\'\')', '2019-09-03 17:19:43'),
(154, 2, 'INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`) VALUES (3,\'Volkswagen\',\'Suran\',\'AD888YT\',1,0,\'\')', '2019-09-03 17:20:33'),
(155, 2, 'INSERT INTO `autos`(`id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`) VALUES (1,\'Chevrolet\',\'Corsa\',\'AC999TE\',1,0,\'\')', '2019-09-03 17:21:07'),
(156, 2, 'INSERT INTO `lugares`(`lugar`, `activo`, `observaciones`) VALUES (\'Terminal Omnibus\',1,\'\')', '2019-09-03 17:21:20');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `id_categoria`, `marca`, `modelo`, `patente`, `estado`, `viaja_chile`, `observaciones`, `create`, `update`) VALUES
(1, 1, 'Renault ', 'Clio', 'PPH852', 1, 0, '', '2019-09-02 17:21:26', '2019-09-02 17:21:26'),
(2, 2, 'Volkswagen ', 'Voyage', 'AA225BV', 1, 0, '', '2019-09-03 17:19:43', '2019-09-03 17:19:43'),
(3, 3, 'Volkswagen', 'Suran', 'AD888YT', 1, 0, '', '2019-09-03 17:20:33', '2019-09-03 17:20:33'),
(4, 1, 'Chevrolet', 'Corsa', 'AC999TE', 1, 0, '', '2019-09-03 17:21:07', '2019-09-03 17:21:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activa`, `promo`, `create`, `update`) VALUES
(1, 'Categoria A', 1, 0, '2019-09-02 17:20:51', '2019-09-03 17:18:34'),
(2, 'Categoria B', 1, 0, '2019-09-03 17:18:41', '2019-09-03 17:18:41'),
(3, 'Categoria C', 1, 0, '2019-09-03 17:18:51', '2019-09-03 17:18:51');

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
(1, 'Dolar', '60.00', 1, '2019-08-13 15:38:54', '2019-08-28 18:02:01'),
(3, 'Porcentaje Adicional', '80.00', 1, '2019-08-16 19:16:00', '2019-08-16 19:18:26'),
(4, 'Porcentaje Descuento', '12.00', 1, '2019-08-16 19:18:37', '2019-08-16 19:18:37'),
(5, 'Margen Horario', '1.00', 0, '2019-08-29 15:04:40', '2019-09-01 20:18:21'),
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id`, `lugar`, `activo`, `observaciones`, `create`, `update`) VALUES
(1, 'Cerro Catedral', 1, '', '2019-09-02 17:35:58', '2019-09-02 17:35:58'),
(2, 'Aeropuerto Bariloche', 1, '', '2019-09-02 17:36:09', '2019-09-02 17:36:09'),
(3, 'Terminal Omnibus', 1, '', '2019-09-03 17:21:20', '2019-09-03 17:21:20');

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
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_Reservas_categorias1` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `por_dia`, `por_semana`, `id_temporada`, `id_categoria`, `activa`, `create`, `update`) VALUES
(1, '1900', '5500', 1, 1, 1, '2019-09-02 17:35:41', '2019-09-02 17:35:41');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id`, `nombre`, `fecha_desde`, `fecha_hasta`, `activa`, `observaciones`, `create`, `update`) VALUES
(1, 'HASTA FIN DE AÑO', '2019-12-31', '2019-09-01', 1, '    ', '2019-09-02 17:31:06', '2019-09-02 17:31:34');

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
