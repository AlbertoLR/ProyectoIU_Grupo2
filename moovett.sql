-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2016 at 01:02 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iu_web`
--
CREATE DATABASE IF NOT EXISTS `iu_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `iu_web`;

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
`id` int(11) NOT NULL,
  `actionname` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE `actividad` (
`id` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` smallint(6) NOT NULL,
  `precio` smallint(6) NOT NULL,
  `descuento_id` int(11) NOT NULL,
  `espacio_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `alerta`
--

DROP TABLE IF EXISTS `alerta`;
CREATE TABLE `alerta` (
`id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `pago_id` int(11) NULL,
  `asistencia_id_cliente` int(11) NULL,
  `asistencia_sesion_id` int(11) NULL,
  `user_id` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `aplica`
--

DROP TABLE IF EXISTS `aplica`;
CREATE TABLE `aplica` (
  `descuento_id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `id_cliente` int(11) NOT NULL,
  `asiste` tinyint(1) DEFAULT NULL,
  `sesion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE `caja` (
`id` int(11) NOT NULL,
  `efectivo_inicial` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `efectivo_final` int(11) NOT NULL,
  `pago_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
`id` int(11) NOT NULL,
  `tipo` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
`id` int(11) NOT NULL,
  `dni_c` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_c` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos_c` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `profesion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alerta_falta` tinyint(1) NOT NULL DEFAULT '0',
  `desempleado` tinyint(1) NOT NULL DEFAULT '0',
  `estudiante` tinyint(1) NOT NULL DEFAULT '0',
  `familiar` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `cliente_externo`
--

DROP TABLE IF EXISTS `cliente_externo`;
CREATE TABLE `cliente_externo` (
`id` int(11) NOT NULL,
  `dni_nif` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

DROP TABLE IF EXISTS `controller`;
CREATE TABLE `controller` (
`id` int(11) NOT NULL,
  `controllername` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `descuento`
--

DROP TABLE IF EXISTS `descuento`;
CREATE TABLE `descuento` (
`id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` float NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE `documento` (
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni_c` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
`id` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `empleado_mira`
--

DROP TABLE IF EXISTS `empleado_mira`;
CREATE TABLE `empleado_mira` (
  `lesion_cliente_id_lesion` int(11) NOT NULL,
  `lesion_cliente_cliente_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha_vista` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `espacio`
--

DROP TABLE IF EXISTS `espacio`;
CREATE TABLE `espacio` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE `evento` (
`id` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `precio` smallint(6) NOT NULL,
  `espacio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `pago_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `horario_temporada`
--

DROP TABLE IF EXISTS `horario_temporada`;
CREATE TABLE `horario_temporada` (
`id` int(11) NOT NULL,
  `dia_inicio` date NOT NULL,
  `dia_fin` date NOT NULL,
  `nombre_temp` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `horas_posibles`
--

DROP TABLE IF EXISTS `horas_posibles`;
CREATE TABLE `horas_posibles` (
  `id` int(11) NOT NULL,
  `dia` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `rango_horario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `hora_fisio`
--

DROP TABLE IF EXISTS `hora_fisio`;
CREATE TABLE `hora_fisio` (
`id` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `dia_f` date NOT NULL,
  `hora_i` time NOT NULL,
  `hora_f` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE `inscripcion` (
`id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `particular_externo_id` int(11) DEFAULT NULL,
  `evento_id` int(11) NULL,
  `reserva_id` int(11) NULL,
  `cliente_dni_c` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `id_actividad` int(11) NULL,
  `id_descuento` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `lesiones`
--

DROP TABLE IF EXISTS `lesiones`;
CREATE TABLE `lesiones` (
`id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- Table structure for table `lesion_cliente`
--

DROP TABLE IF EXISTS `lesion_cliente`;
CREATE TABLE `lesion_cliente` (
  `id_lesion` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `lesion_empleado`
--

DROP TABLE IF EXISTS `lesion_empleado`;
CREATE TABLE `lesion_empleado` (
  `lesiones_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `linea_factura`
--

DROP TABLE IF EXISTS `linea_factura`;
CREATE TABLE `linea_factura` (
`id` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `producto` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` smallint(6) DEFAULT NULL,
  `precio` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE `notificacion` (
`id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
CREATE TABLE `pago` (
`id` int(11) NOT NULL,
  `metodo_pago` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `periodicidad` varchar(45) COLLATE utf8_spanish_ci NULL,
  `cantidad` smallint(6) NOT NULL,
  `reserva_id` int(11) NULL,
  `inscripcion_id` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `particular_externo`
--

DROP TABLE IF EXISTS `particular_externo`;
CREATE TABLE `particular_externo` (
`id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `percibe`
--

DROP TABLE IF EXISTS `percibe`;
CREATE TABLE `percibe` (
  `user_id` int(11) NOT NULL,
  `alerta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
`id` int(11) NOT NULL,
  `controller` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `action` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
`id` int(11) NOT NULL,
  `profilename` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `profile_perms`
--

DROP TABLE IF EXISTS `profile_perms`;
CREATE TABLE `profile_perms` (
`id` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `rango_horario`
--

DROP TABLE IF EXISTS `rango_horario`;
CREATE TABLE `rango_horario` (
  `id` int(11) NOT NULL,
  `dia_s` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `horario_temporada_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `recibe`
--

DROP TABLE IF EXISTS `recibe`;
CREATE TABLE `recibe` (
  `notificacion_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `recibo`
--

DROP TABLE IF EXISTS `recibo`;
CREATE TABLE `recibo` (
`id` int(11) NOT NULL,
  `producto` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `precio` smallint(6) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `pago_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
  `id_espacio` int(11) NULL,
  `dni_c` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
`id` int(11) NOT NULL,
  `precio_espacio` smallint(6) DEFAULT NULL,
  `precio_fisio` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `coste` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `pago_id` int(11) NOT NULL,
  `cliente_externo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `sesion`
--

DROP TABLE IF EXISTS `sesion`;
CREATE TABLE `sesion` (
`id` int(11) NOT NULL,
  `actividad_id` int(11),
  `horas_posibles_id` int(11) NOT NULL,
  `evento_id` int(11) NULL,
  `user_id` int(11) NOT NULL,
  `espacio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`id` int(11) NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_cuenta` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_contrato` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `passwd` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profile` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `user_perms`
--

DROP TABLE IF EXISTS `user_perms`;
CREATE TABLE `user_perms` (
`id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `actionname_unique` (`actionname`);

--
-- Indexes for table `actividad`
--
ALTER TABLE `actividad`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_actividad_descuento1_idx` (`descuento_id`), ADD KEY `fk_actividad_espacio1_idx` (`espacio_id`), ADD KEY `fk_actividad_categoria1_idx` (`categoria_id`);

--
-- Indexes for table `alerta`
--
ALTER TABLE `alerta`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_alerta_pago1_idx` (`pago_id`), ADD KEY `fk_alerta_asistencia1_idx` (`asistencia_id_cliente`,`asistencia_sesion_id`), ADD KEY `fk_alerta_user1_idx` (`user_id`);

--
-- Indexes for table `aplica`
--
ALTER TABLE `aplica`
 ADD PRIMARY KEY (`descuento_id`,`actividad_id`), ADD KEY `fk_aplica_descuento1_idx` (`descuento_id`), ADD KEY `fk_aplica_actividad1_idx` (`actividad_id`);

--
-- Indexes for table `asistencia`
--
ALTER TABLE `asistencia`
 ADD PRIMARY KEY (`id_cliente`,`sesion_id`), ADD KEY `fk_asistencia_sesion1_idx` (`sesion_id`);

--
-- Indexes for table `caja`
--
ALTER TABLE `caja`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_caja_pago1_idx` (`pago_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `dni_c_unique` (`dni_c`);

--
-- Indexes for table `cliente_externo`
--
ALTER TABLE `cliente_externo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controller`
--
ALTER TABLE `controller`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `controllername_unique` (`controllername`);

--
-- Indexes for table `descuento`
--
ALTER TABLE `descuento`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_descuento_categoria1_idx` (`categoria_id`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
 ADD PRIMARY KEY (`id`), ADD KEY `dni_c_idx` (`dni_c`), ADD KEY `id_inscripcion_idx` (`id_inscripcion`), ADD KEY `dni_idx` (`dni`);

--
-- Indexes for table `empleado_mira`
--
ALTER TABLE `empleado_mira`
 ADD PRIMARY KEY (`lesion_cliente_id_lesion`,`lesion_cliente_cliente_id`,`user_id`,`fecha_vista`), ADD KEY `fk_empleado_mira_lesion_cliente1_idx` (`lesion_cliente_id_lesion`,`lesion_cliente_cliente_id`), ADD KEY `fk_empleado_mira_user1_idx` (`user_id`);

--
-- Indexes for table `espacio`
--
ALTER TABLE `espacio`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_evento_espacio1_idx` (`espacio_id`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_factura_pago1_idx` (`pago_id`);

--
-- Indexes for table `horario_temporada`
--
ALTER TABLE `horario_temporada`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horas_posibles`
--
ALTER TABLE `horas_posibles`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_horas_posibles_rango_horario1_idx` (`rango_horario_id`);

--
-- Indexes for table `hora_fisio`
--
ALTER TABLE `hora_fisio`
 ADD PRIMARY KEY (`id`), ADD KEY `id_reserva_idx` (`id_reserva`);

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_inscripcion_particular_externo1_idx` (`particular_externo_id`), ADD KEY `fk_inscripcion_evento1_idx` (`evento_id`), ADD KEY `fk_inscripcion_reserva1_idx` (`reserva_id`),ADD KEY `fk_inscripcion_actividad1_idx` (`id_actividad`),ADD KEY `fk_inscripcion_descuento1_idx` (`id_descuento`),ADD KEY `fk_inscripcion_cliente1_idx` (`cliente_dni_c`);

--
-- Indexes for table `lesiones`
--
ALTER TABLE `lesiones`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesion_cliente`
--
ALTER TABLE `lesion_cliente`
 ADD PRIMARY KEY (`id_lesion`,`cliente_id`), ADD KEY `fk_lesion_cliente_cliente1_idx` (`cliente_id`),ADD KEY `fk_lesion_cliente_lesion1_idx` (`id_lesion`);

--
-- Indexes for table `lesion_empleado`
--
ALTER TABLE `lesion_empleado`
 ADD PRIMARY KEY (`user_id`,`lesiones_id`), ADD KEY `fk_lesion_empleado_lesiones1_idx` (`lesiones_id`),ADD KEY `fk_lesion_empleado_user1_idx` (`user_id`);

--
-- Indexes for table `linea_factura`
--
ALTER TABLE `linea_factura`
 ADD PRIMARY KEY (`id`,`id_factura`), ADD KEY `id_factura_idx` (`id_factura`);

--
-- Indexes for table `notificacion`
--
ALTER TABLE `notificacion`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_notificacion_user1_idx` (`user_id`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pago_reserva1_idx` (`reserva_id`), ADD KEY `fk_pago_inscripcion1_idx` (`inscripcion_id`);

--
-- Indexes for table `particular_externo`
--
ALTER TABLE `particular_externo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `percibe`
--
ALTER TABLE `percibe`
 ADD PRIMARY KEY (`user_id`,`alerta_id`), ADD KEY `fk_percibe_user1_idx` (`user_id`), ADD KEY `fk_percibe_alerta1_idx` (`alerta_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_permission_controller1_idx` (`controller`), ADD KEY `fk_permission_action1_idx` (`action`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `profilename_unique` (`profilename`);

--
-- Indexes for table `profile_perms`
--
ALTER TABLE `profile_perms`
 ADD PRIMARY KEY (`id`), ADD KEY `profileid_idx` (`profile`), ADD KEY `fk_profile_perms_permission1_idx` (`permission`);

--
-- Indexes for table `rango_horario`
--
ALTER TABLE `rango_horario`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_rango_horario_horario_temporada1_idx` (`horario_temporada_id`);

--
-- Indexes for table `recibe`
--
ALTER TABLE `recibe`
 ADD PRIMARY KEY (`notificacion_id`,`cliente_id`), ADD KEY `fk_recibe_notificacion1_idx` (`notificacion_id`), ADD KEY `fk_recibe_cliente1_idx` (`cliente_id`);

--
-- Indexes for table `recibo`
--
ALTER TABLE `recibo`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_recibo_pago1_idx` (`pago_id`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
 ADD PRIMARY KEY (`id`), ADD KEY `id_espacio_idx` (`id_espacio`),ADD KEY `fk_reserva_cliente1_idx` (`dni_c`);

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_servicio_pago1_idx` (`pago_id`), ADD KEY `fk_servicio_cliente_externo1_idx` (`cliente_externo_id`);

--
-- Indexes for table `sesion`
--
ALTER TABLE `sesion`
-- ADD PRIMARY KEY (`id`,`actividad_id`,`horas_posibles_id`,`evento_id`,`user_id`,`espacio_id`), ADD KEY `fk_sesion_actividad1_idx` (`actividad_id`), ADD KEY `fk_sesion_horas_posibles1_idx` (`horas_posibles_id`), ADD KEY `fk_sesion_evento1_idx` (`evento_id`), ADD KEY `fk_sesion_user1_idx` (`user_id`), ADD KEY `fk_sesion_espacio1_idx` (`espacio_id`);
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sesion_actividad1_idx` (`actividad_id`), ADD KEY `fk_sesion_horas_posibles1_idx` (`horas_posibles_id`), ADD KEY `fk_sesion_evento1_idx` (`evento_id`), ADD KEY `fk_sesion_user1_idx` (`user_id`), ADD KEY `fk_sesion_espacio1_idx` (`espacio_id`);
--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `dni_unique` (`dni`), ADD KEY `fk_user_profile1_idx` (`profile`);

--
-- Indexes for table `user_perms`
--
ALTER TABLE `user_perms`
 ADD PRIMARY KEY (`id`), ADD KEY `userid_idx` (`user`), ADD KEY `fk_user_perms_permission1_idx` (`permission`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `actividad`
--
ALTER TABLE `actividad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alerta`
--
ALTER TABLE `alerta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `caja`
--
ALTER TABLE `caja`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cliente_externo`
--
ALTER TABLE `cliente_externo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `controller`
--
ALTER TABLE `controller`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `descuento`
--
ALTER TABLE `descuento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `espacio`
--
ALTER TABLE `espacio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horario_temporada`
--
ALTER TABLE `horario_temporada`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horas_posibles`
--
ALTER TABLE `horas_posibles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hora_fisio`
--
ALTER TABLE `hora_fisio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lesiones`
--
ALTER TABLE `lesiones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `linea_factura`
--
ALTER TABLE `linea_factura`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notificacion`
--
ALTER TABLE `notificacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `particular_externo`
--
ALTER TABLE `particular_externo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `profile_perms`
--
ALTER TABLE `profile_perms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `recibo`
--
ALTER TABLE `recibo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rango_horario`
--
ALTER TABLE `rango_horario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servicio`
--
ALTER TABLE `servicio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sesion`
--
ALTER TABLE `sesion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_perms`
--
ALTER TABLE `user_perms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividad`
--
ALTER TABLE `actividad`
ADD CONSTRAINT `fk_actividad_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_actividad_descuento1` FOREIGN KEY (`descuento_id`) REFERENCES `descuento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_actividad_espacio1` FOREIGN KEY (`espacio_id`) REFERENCES `espacio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `alerta`
--


ALTER TABLE `alerta`
ADD CONSTRAINT `fk_alerta_asistencia1` FOREIGN KEY (`asistencia_id_cliente`, `asistencia_sesion_id`) REFERENCES `asistencia` (`id_cliente`,`sesion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_alerta_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_alerta_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `aplica`
--
ALTER TABLE `aplica`
ADD CONSTRAINT `fk_aplica_actividad1` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_aplica_descuento1` FOREIGN KEY (`descuento_id`) REFERENCES `descuento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `asistencia`
--

ALTER TABLE `asistencia`
ADD CONSTRAINT `fk_asistencia_sesion1` FOREIGN KEY (`sesion_id`) REFERENCES `sesion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `caja`
--
ALTER TABLE `caja`
ADD CONSTRAINT `fk_caja_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `descuento`
--
ALTER TABLE `descuento`
ADD CONSTRAINT `fk_descuento_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `documento`
--
ALTER TABLE `documento`
ADD CONSTRAINT `dni` FOREIGN KEY (`dni`) REFERENCES `user` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `dni_c` FOREIGN KEY (`dni_c`) REFERENCES `cliente` (`dni_c`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `id_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `empleado_mira`
--
ALTER TABLE `empleado_mira`
ADD CONSTRAINT `fk_empleado_mira_lesion_cliente1` FOREIGN KEY (`lesion_cliente_id_lesion`, `lesion_cliente_cliente_id`) REFERENCES `lesion_cliente` (`id_lesion`, `cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_empleado_mira_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evento`
--
ALTER TABLE `evento`
ADD CONSTRAINT `fk_evento_espacio1` FOREIGN KEY (`espacio_id`) REFERENCES `espacio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
ADD CONSTRAINT `fk_factura_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `horas_posibles`
--
ALTER TABLE `horas_posibles`
ADD CONSTRAINT `fk_horas_posibles_rango_horario1` FOREIGN KEY (`rango_horario_id`) REFERENCES `rango_horario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hora_fisio`
--
ALTER TABLE `hora_fisio`
ADD CONSTRAINT `id_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
ADD CONSTRAINT `fk_inscripcion_cliente1` FOREIGN KEY (`cliente_dni_c`) REFERENCES `cliente` (`dni_c`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inscripcion_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inscripcion_particular_externo1` FOREIGN KEY (`particular_externo_id`) REFERENCES `particular_externo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inscripcion_reserva1` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inscripcion_actividad1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_inscripcion_descuento1` FOREIGN KEY (`id_descuento`) REFERENCES `descuento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


--
-- Constraints for table `lesion_cliente`
--
ALTER TABLE `lesion_cliente`
ADD CONSTRAINT `fk_lesion_cliente_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `id_lesion` FOREIGN KEY (`id_lesion`) REFERENCES `lesiones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lesion_empleado`
--
ALTER TABLE `lesion_empleado`
ADD CONSTRAINT `fk_lesion_empleado_lesiones1` FOREIGN KEY (`lesiones_id`) REFERENCES `lesiones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_lesion_empleado_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `linea_factura`
--
ALTER TABLE `linea_factura`
ADD CONSTRAINT `id_factura` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notificacion`
--
ALTER TABLE `notificacion`
ADD CONSTRAINT `fk_notificacion_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
ADD CONSTRAINT `fk_pago_inscripcion1` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pago_reserva1` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `percibe`
--
ALTER TABLE `percibe`
ADD CONSTRAINT `fk_percibe_alerta1` FOREIGN KEY (`alerta_id`) REFERENCES `alerta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_percibe_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
ADD CONSTRAINT `fk_permission_action1` FOREIGN KEY (`action`) REFERENCES `action` (`actionname`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_permission_controller1` FOREIGN KEY (`controller`) REFERENCES `controller` (`controllername`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile_perms`
--
ALTER TABLE `profile_perms`
ADD CONSTRAINT `fk_profile_perms_permission1` FOREIGN KEY (`permission`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `profileid` FOREIGN KEY (`profile`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rango_horario`
--
ALTER TABLE `rango_horario`
ADD CONSTRAINT `fk_rango_horario_horario_temporada1` FOREIGN KEY (`horario_temporada_id`) REFERENCES `horario_temporada` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recibe`
--
ALTER TABLE `recibe`
ADD CONSTRAINT `fk_recibe_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_recibe_notificacion1` FOREIGN KEY (`notificacion_id`) REFERENCES `notificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recibo`
--
ALTER TABLE `recibo`
ADD CONSTRAINT `fk_recibo_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
ADD CONSTRAINT `id_espacio` FOREIGN KEY (`id_espacio`) REFERENCES `espacio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reserva_cliente1` FOREIGN KEY (`dni_c`) REFERENCES `cliente` (`dni_c`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `servicio`
--
ALTER TABLE `servicio`
ADD CONSTRAINT `fk_servicio_cliente_externo1` FOREIGN KEY (`cliente_externo_id`) REFERENCES `cliente_externo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_servicio_pago1` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sesion`
--
ALTER TABLE `sesion`
ADD CONSTRAINT `fk_sesion_actividad1` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sesion_espacio1` FOREIGN KEY (`espacio_id`) REFERENCES `espacio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sesion_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sesion_horas_posibles1` FOREIGN KEY (`horas_posibles_id`) REFERENCES `horas_posibles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sesion_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fk_user_profile1` FOREIGN KEY (`profile`) REFERENCES `profile` (`profilename`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_perms`
--
ALTER TABLE `user_perms`
ADD CONSTRAINT `fk_user_perms_permission1` FOREIGN KEY (`permission`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `userid` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- ---------------------------------------------------

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `profilename`) VALUES
(1, 'admin');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `dni`, `username`, `name`, `surname`, `fecha_nac`, `direccion`, `comentario`, `num_cuenta`, `tipo_contrato`, `email`, `foto`, `activo`, `passwd`, `profile`) VALUES
(1, '44849254q', 'admin', 'administrador', 'administrador', '2016-11-01', 'calle emilia pardo bazán 5,5ºd, ourense', 'un saludo', 'es648654684654', 'indefinido', 'jfsantiago2@gmail.com', '', 1, 'admin', 'admin'),
(2, '44849299Y', 'jfsantiago2', 'Javier', 'Fernández López', '2015-12-24', 'Calle falsa 123, Ourense', '', 'ES9287423222928374923847', 'Indefinido', 'jfsantiago2@esei.uvigo.es', '', 0, 'abc123.', 'admin');


--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `actionname`) VALUES
(3, 'add'),
(5, 'delete'),
(1, 'show'),
(2, 'showone'),
(4, 'edit');

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id`, `controllername`) VALUES
(5, 'action'),
(2, 'controller'),
(3, 'permission'),
(4, 'profile'),
(1, 'user'),
(6, 'userperm'),
(7, 'profileperm');


--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `controller`, `action`) VALUES
(1, 'user', 'show'),
(2, 'user', 'showone'),
(3, 'user', 'add'),
(4, 'user', 'delete'),
(5, 'user', 'edit'),
(6, 'controller', 'add'),
(7, 'controller', 'delete'),
(8, 'controller', 'show'),
(9, 'controller', 'showone'),
(10, 'controller', 'edit'),
(11, 'permission', 'add'),
(12, 'permission', 'add'),
(13, 'permission', 'show'),
(14, 'permission', 'showone'),
(15, 'permission', 'edit'),
(16, 'profile', 'add'),
(17, 'profile', 'delete'),
(18, 'profile', 'show'),
(19, 'profile', 'showone'),
(20, 'profile', 'edit'),
(21, 'action', 'add'),
(22, 'action', 'delete'),
(23, 'action', 'show'),
(24, 'action', 'showone'),
(25, 'action', 'edit'),
(26, 'userperm', 'add'),
(27, 'userperm', 'delete'),
(28, 'userperm', 'show'),
(29, 'userperm', 'showone'),
(30, 'userperm', 'edit'),
(31, 'profileperm', 'add'),
(32, 'profileperm', 'delete'),
(33, 'profileperm', 'show'),
(34, 'profileperm', 'showone'),
(35, 'profileperm', 'edit');

--
-- Dumping data for table `cliente`
--
INSERT INTO `cliente` (`id`, `dni_c`, `nombre_c`, `apellidos_c`, `fecha_nac`, `profesion`, `telefono`, `direccion`, `comentario`, `email`, `alerta_falta`, `desempleado`, `estudiante`, `familiar`) VALUES 
(1, '12345678C', 'Nombre3', 'Aellidos3', '1999-11-11', 'Programador', 666666666, 'Calle2,numero2,piso2', 'Es un negado', 'cliente1@gym.com', true, DEFAULT, true, DEFAULT),
(2, '13245678D', 'Nombre4', 'Apellidos4', '1999-12-12', 'Ingeniero', 777777777, 'Calle3,numero3,piso3', 'Está calvo', 'cliente2@gym.com', false, DEFAULT, DEFAULT, DEFAULT);

--
-- Dumping data for table `particular_externo`
--
INSERT INTO `particular_externo` (`id`, `nombre`, `apellidos`, `telefono`) VALUES (1, 'NombreExt', 'ApellidosExt', 111222333);

--
-- Dumping data for table `espacio`
--
INSERT INTO `espacio` (`id`, `nombre`) VALUES (1, 'AULA1'),(2, 'AULA2');

--
-- Dumping data for table `reserva`
--
INSERT INTO `reserva` (`id`, `id_espacio`, `dni_c`, `precio_espacio`, `precio_fisio`) VALUES (1, 1, '12345678C', 13, NULL),(2, NULL, '13245678D', NULL, 25);

--
-- Dumping data for table `categoria`
--
INSERT INTO `categoria` (`id`, `tipo`) VALUES (1, 'AZUL'),(2, 'ROSA');

--
-- Dumping data for table `descuento`
--
INSERT INTO `descuento` (`id`, `descripcion`,`categoria_id`, `cantidad`) VALUES (1, 'AZUL', 1, 10),(2, 'ROSA', 2, 20);

--
-- Dumping data for table `evento`
--
INSERT INTO `evento` (`id`, `nombre`, `espacio_id`, `precio`) VALUES (1, 'Halloween', 1, 5),(2, 'Magosto', 2, 7);

--
-- Dumping data for table `actividad`
--
INSERT INTO `actividad` (`id`, `nombre`, `espacio_id`, `descuento_id`, `capacidad`, `precio`, `categoria_id`) VALUES
(1, 'Zumba', 1, 1, 20, 20, 1),
(2, 'Salsa', 2, 2, 13, 50, 2);

--
-- Dumping data for table `inscripcion`
--
INSERT INTO `inscripcion` (`id`, `particular_externo_id`, `evento_id`, `id_actividad`, `reserva_id`, `cliente_dni_c`, `fecha`, `id_descuento`) VALUES 
(1, NULL, NULL, 1, NULL, '12345678C', '2016-5-6', 1),
(2, 1, 1, NULL, NULL, '13245678D', '2016-4-3', NULL);

--
-- Dumping data for table `documento`
--
INSERT INTO `documento` (`dni`, `dni_c`, `id_inscripcion`, `id`, `tipo`, `documento`) VALUES 
(NULL, '12345678C', NULL, 1, 'LESION', 'lesion1.pdf'),
('44849254q', NULL, NULL, 2, 'SEPA', 'sepa1.pdf');

--
-- Dumping data for table `lesiones`
--
INSERT INTO `lesiones` (`id`, `descripcion`) VALUES (1, 'Rodilla de golfista'),(2, 'Codo de tenista');

--
-- Dumping data for table `lesion_cliente`
--
INSERT INTO `lesion_cliente` (`id_lesion`, `cliente_id`) VALUES (1, 1);

--
-- Dumping data for table `lesion_empleado`
--
INSERT INTO `lesion_empleado` ( `lesiones_id`,  `user_id`) VALUES (2, 1);

--
-- Dumping data for table `empleado_mira`
--
INSERT INTO `empleado_mira` (`user_id`, `lesion_cliente_cliente_id`, `lesion_cliente_id_lesion`, `fecha_vista`) VALUES (1, 1, 1, '2016-11-4');

--
-- Dumping data for table `horario_temporada`
--
INSERT INTO `horario_temporada` (`id`, `dia_inicio`, `dia_fin`, `nombre_temp`) VALUES (1, '2016-6-15', '2016-9-15', 'Verano');

--
-- Dumping data for table `rango_horario`
--
INSERT INTO `rango_horario` (`id`, `dia_s`, `hora_apertura`, `hora_cierre`, `horario_temporada_id`) VALUES (1, 'Lunes', '9:00', '15:00', 1);

--
-- Dumping data for table `horas_posibles`
--
INSERT INTO `horas_posibles` (`id`,`dia`, `hora_inicio`, `hora_fin`,`rango_horario_id`) VALUES 
(1,'Lunes', '9:00', '10:00', 1),
(2,'Lunes', '10:00', '11:00', 1),
(3,'Lunes', '11:00', '12:00', 1);

--
-- Dumping data for table `sesion`
--
INSERT INTO `sesion` (`id`, `espacio_id`, `evento_id`, `actividad_id`, `user_id`,`horas_posibles_id`) VALUES (1, 1, NULL, 1, 1, 1),(2, 1, NULL, 1, 1, 2);

--
-- Dumping data for table `pago`
--
INSERT INTO `pago` (`id`, `metodo_pago`, `fecha`, `periodicidad`, `cantidad`, `inscripcion_id`, `reserva_id`) VALUES 
(1, 'Tarjeta', '2016-3-2', NULL, 25, NULL, NULL),
(2, 'Transferencia', '2016-4-9', 'Anual', 100, 1, NULL),
(3, 'Tarjeta', '2016-2-3', NULL, 300, NULL, NULL);

--
-- Dumping data for table `asistencia`
--
INSERT INTO `asistencia` (`id_cliente`, `sesion_id`, `asiste`) VALUES (1, 1, false),(2, 2, true);


--
-- Dumping data for table `alerta`
--
INSERT INTO `alerta` (`id`, `descripcion`, `user_id`, `pago_id`, `asistencia_id_cliente`,`asistencia_sesion_id`) VALUES 
(1, 'No acude',NULL,NULL, 1, 1),
(2, 'No paga', NULL, 1, 1, NULL);

--
-- Dumping data for table `notificacion`
--
INSERT INTO `notificacion` (`id`, `descripcion`, `user_id`) VALUES (1, 'Notifiacion1', 1);

--
-- Dumping data for table `recibe`
--
INSERT INTO `recibe` (`notificacion_id`, `cliente_id`) VALUES (1, 1);

--
-- Dumping data for table `percibe`
--
INSERT INTO `percibe` ( `alerta_id`, `user_id`) VALUES (1, 1);

--
-- Dumping data for table `hora_fisio`
--
INSERT INTO `hora_fisio` (`id`, `id_reserva`, `dia_f`, `hora_i`, `hora_f`) VALUES (1, 2, '2016-11-11', '17:00', '18:00');

--
-- Dumping data for table `factura`
--
INSERT INTO `factura` (`id`, `pago_id`, `fecha`) VALUES (1, 1, '2016-10-5');

--
-- Dumping data for table `linea_factura`
--
INSERT INTO `linea_factura` (`id`, `id_factura`, `producto`, `cantidad`, `precio`) VALUES (1, 1, 'Batido Proteinas', 1, 10),(2, 1, 'Anabolizantes', 2, 30);

--
-- Dumping data for table `recibo`
--
INSERT INTO `recibo` (`id`, `pago_id`, `producto`, `precio`, `cantidad`) VALUES (1, 2, 'Clase ZUmba Anual', 100, 1);

--
-- Dumping data for table `caja`
--
INSERT INTO `caja` (`pago_id`, `id`, `efectivo_inicial`, `cantidad`, `efectivo_final`) VALUES (1, 1, 0, 20, 20),(2, 2, 20, -10, 10);

--
-- Dumping data for table `cliente_externo`
--
INSERT INTO `cliente_externo` (`id`, `dni_nif`, `nombre`, `apellido`, `telefono`, `email`) VALUES
(1, '12345678F', 'Externo', 'ApellidoExt', 888888888, 'exte@rno.com');

--
-- Dumping data for table `servicio`
--
INSERT INTO `servicio` (`id`, `fecha`, `coste`, `pago_id`,  `cliente_externo_id`, `descripcion`) VALUES (1, '2016-12-3', 300, 3, 1, 'Boda');

--
-- Dumping data for table `aplica`
--
INSERT INTO `aplica` (`descuento_id`,`actividad_id`) VALUES (1, 1),(2,2);

--
-- Dumping data for table `user_perms`
--

INSERT INTO `user_perms` (`id`, `user`, `permission`) VALUES
(1, 1, 1);

--
-- Dumping data for table `profile_perms`
--

INSERT INTO `profile_perms` (`id`, `profile`, `permission`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 11),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7),
(9, 1, 8),
(10, 1, 9),
(11, 1, 10),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30),
(31, 1, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 1, 35);


CREATE USER 'moovett'@'localhost' IDENTIFIED BY '***';GRANT ALL PRIVILEGES ON *.* TO 'moovett'@'localhost' 
								  IDENTIFIED BY '***' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
								  GRANT ALL PRIVILEGES ON `iu_web`.* TO 'moovett'@'localhost';
								  
								  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
