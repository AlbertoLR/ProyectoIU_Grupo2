-- phpmyadmin sql dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- host: 127.0.0.1:3306
-- generation time: nov 20, 2016 at 01:02 am
-- server version: 5.5.39
-- php version: 5.4.33

set sql_mode = "no_auto_value_on_zero";
set time_zone = "+00:00";


/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!40101 set names utf8 */;

--
-- database: `iu_web`
--
create database if not exists `moovett` default character set utf8 collate utf8_spanish_ci;
use `moovett`;

-- --------------------------------------------------------

--
-- table structure for table `action`
--

drop table if exists `action`;
create table `action` (
`id` int(11) not null,
  `actionname` varchar(25) collate utf8_spanish_ci not null
) engine=innodb auto_increment=6 default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `actividad`
--

drop table if exists `actividad`;
create table `actividad` (
`id` int(11) not null,
  `nombre` varchar(10) collate utf8_spanish_ci not null,
  `capacidad` smallint(6) not null,
  `precio` smallint(6) not null,
  `espacio_id` int(11) not null,
  `categoria_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- table structure for table `alerta`
--

drop table if exists `alerta`;
create table `alerta` (
`id` int(11) not null,
  `descripcion` text collate utf8_spanish_ci not null,
  `pago_id` int(11) null,
  `asistencia_id_cliente` int(11) null,
  `asistencia_sesion_id` int(11) null,
  `user_id` int(11) null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `aplica`
--

drop table if exists `aplica`;
create table `aplica` (
  `descuento_id` int(11) not null,
  `actividad_id` int(11) not null,
  `extra` int(11) default null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `asistencia`
--

drop table if exists `asistencia`;
create table `asistencia` (
  `id_cliente` int(11) not null,
  `asiste` tinyint(1) default null,
  `sesion_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `caja`
--

drop table if exists `caja`;
create table `caja` (
`id` int(11) not null,
  `efectivo_inicial` int(11) not null,
  `cantidad` int(11) not null,
  `efectivo_final` int(11) not null,
  `pago_id` int(11) not null,
  `tipo` varchar(11) collate utf8_spanish_ci not null,
  `descripcion` varchar(90) collate utf8_spanish_ci not null,
  `fecha` date not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `categoria`
--

drop table if exists `categoria`;
create table `categoria` (
`id` int(11) not null,
  `tipo` varchar(10) collate utf8_spanish_ci not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `cliente`
--

drop table if exists `cliente`;
create table `cliente` (
`id` int(11) not null,
  `dni_c` varchar(9) collate utf8_spanish_ci not null,
  `nombre_c` varchar(15) collate utf8_spanish_ci not null,
  `apellidos_c` varchar(40) collate utf8_spanish_ci not null,
  `fecha_nac` date default null,
  `profesion` varchar(20) collate utf8_spanish_ci default null,
  `telefono` int(11) default null,
  `direccion` varchar(50) collate utf8_spanish_ci default null,
  `comentario` varchar(500) collate utf8_spanish_ci default null,
  `email` varchar(30) collate utf8_spanish_ci default null,
  `alerta_falta` tinyint(1) not null default '0',
  `desempleado` tinyint(1) not null default '0',
  `estudiante` tinyint(1) not null default '0',
  `familiar` tinyint(1) not null default '0',
  `num_cuenta` varchar(24) collate utf8_spanish_ci not null,
  `activo` tinyint(1) not null default '0',
  `foto` varchar(15) collate utf8_spanish_ci not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `cliente_externo`
--

drop table if exists `cliente_externo`;
create table `cliente_externo` (
`id` int(11) not null,
  `dni_nif` varchar(9) collate utf8_spanish_ci not null,
  `nombre` varchar(80) collate utf8_spanish_ci not null,
  `apellido` varchar(40) collate utf8_spanish_ci default null,
  `telefono` int(11) default null,
  `email` varchar(30) collate utf8_spanish_ci default null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `controller`
--

drop table if exists `controller`;
create table `controller` (
`id` int(11) not null,
  `controllername` varchar(25) collate utf8_spanish_ci not null
) engine=innodb auto_increment=7 default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `descuento`
--

drop table if exists `descuento`;
create table `descuento` (
`id` int(11) not null,
  `descripcion` text collate utf8_spanish_ci not null,
  `cantidad` float not null,
  `categoria_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `documento`
--

drop table if exists `documento`;
create table `documento` (
  `dni` varchar(9) collate utf8_spanish_ci default null,
  `dni_c` varchar(9) collate utf8_spanish_ci default null,
  `id` int(11) not null,
  `tipo` varchar(50) collate utf8_spanish_ci not null,
  `documento` varchar(50) collate utf8_spanish_ci not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `empleado_mira`
--

drop table if exists `empleado_mira`;
create table `empleado_mira` (
  `lesion_cliente_id_lesion` int(11) not null,
  `lesion_cliente_cliente_id` int(11) not null,
  `user_id` int(11) not null,
  `fecha` date not null,
  `hora` time not null

) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `espacio`
--

drop table if exists `espacio`;
create table `espacio` (
`id` int(11) not null,
  `nombre` varchar(45) collate utf8_spanish_ci not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- table structure for table `evento`
--

drop table if exists `evento`;
create table `evento` (
`id` int(11) not null,
  `nombre` varchar(10) collate utf8_spanish_ci not null,
  `precio` smallint(6) not null,
  `espacio_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `factura`
--

drop table if exists `factura`;
create table `factura` (
`id` int(11) not null,
  `fecha` date not null,
  `pago_id` int(11) not null,
  `precio_total` int(8) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `horario_temporada`
--

drop table if exists `horario_temporada`;
create table `horario_temporada` (
`id` int(11) not null,
  `dia_inicio` date not null,
  `dia_fin` date not null,
  `nombre_temp` varchar(30) collate utf8_spanish_ci not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `horas_posibles`
--

drop table if exists `horas_posibles`;
create table `horas_posibles` (
  `id` int(11) not null,
  `dia` date not null,
  `hora_inicio` time not null,
  `hora_fin` time not null,
  `rango_horario_id` int(11) not null,
  `active` tinyint(1) not null default '0'
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `hora_fisio`
--

drop table if exists `hora_fisio`;
create table `hora_fisio` (
`id` int(11) not null,
  `id_reserva` int(11) not null,
  `dia_f` date not null,
  `hora_i` time not null,
  `hora_f` time not null,
  `asistencia` tinyint(1) not null default '0'
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `inscripcion`
--

drop table if exists `inscripcion`;
create table `inscripcion` (
`id` int(11) not null,
  `fecha` date default null,
  `particular_externo_id` int(11) default null,
  `evento_id` int(11) null,
  `reserva_id` int(11) null,
  `cliente_dni_c` varchar(9) collate utf8_spanish_ci not null,
  `id_actividad` int(11) null,
  `id_descuento` int(11) null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `lesion`
--

drop table if exists `lesion`;
create table `lesion` (
`id` int(11) not null,
  `descripcion` text collate utf8_spanish_ci not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- table structure for table `lesion_cliente`
--

drop table if exists `lesion_cliente`;
create table `lesion_cliente` (
  `id_lesion` int(11) not null,
  `cliente_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `lesion_empleado`
--

drop table if exists `lesion_empleado`;
create table `lesion_empleado` (
  `lesion_id` int(11) not null,
  `user_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `linea_factura`
--

drop table if exists `linea_factura`;
create table `linea_factura` (
`id` int(11) not null,
  `id_factura` int(11) not null,
  `producto` varchar(40) collate utf8_spanish_ci default null,
  `cantidad` smallint(6) default null,
  `precio` smallint(6) default null,
  `iva` smallint(6) default null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `notificacion`
--

drop table if exists `notificacion`;
create table `notificacion` (
`id` int(11) not null,
  `descripcion` text collate utf8_spanish_ci not null,
  `user_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `pago`
--

drop table if exists `pago`;
create table `pago` (
`id` int(11) not null,
  `metodo_pago` varchar(20) collate utf8_spanish_ci not null,
  `fecha` date not null,
  `periodicidad` varchar(45) collate utf8_spanish_ci null,
  `cantidad` smallint(6) not null,
  `reserva_id` int(11) null,
  `inscripcion_id` int(11) null,
  `realizado` tinyint(1) not null default '0'
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `particular_externo`
--

drop table if exists `particular_externo`;
create table `particular_externo` (
`id` int(11) not null,
  `nombre` varchar(20) collate utf8_spanish_ci not null,
  `apellidos` varchar(30) collate utf8_spanish_ci not null,
  `telefono` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `percibe`
--

drop table if exists `percibe`;
create table `percibe` (
  `user_id` int(11) not null,
  `alerta_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `permission`
--

drop table if exists `permission`;
create table `permission` (
`id` int(11) not null,
  `controller` varchar(25) collate utf8_spanish_ci not null,
  `action` varchar(25) collate utf8_spanish_ci not null
) engine=innodb auto_increment=31 default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `profile`
--

drop table if exists `profile`;
create table `profile` (
`id` int(11) not null,
  `profilename` varchar(25) collate utf8_spanish_ci not null
) engine=innodb auto_increment=2 default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `profile_perms`
--

drop table if exists `profile_perms`;
create table `profile_perms` (
`id` int(11) not null,
  `profile` int(11) not null,
  `permission` int(11) not null
) engine=innodb auto_increment=31 default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `rango_horario`
--

drop table if exists `rango_horario`;
create table `rango_horario` (
  `id` int(11) not null,
  `dia_s` varchar(10) collate utf8_spanish_ci not null,
  `hora_apertura` time not null,
  `hora_cierre` time not null,
  `horario_temporada_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `recibe`
--

drop table if exists `recibe`;
create table `recibe` (
  `notificacion_id` int(11) not null,
  `cliente_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `recibo`
--

drop table if exists `recibo`;
create table `recibo` (
`id` int(11) not null,
  `producto` varchar(40) collate utf8_spanish_ci not null,
  `precio` smallint(6) not null,
  `cantidad` smallint(6) not null,
  `pago_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `reserva`
--

drop table if exists `reserva`;
create table `reserva` (
  `id_espacio` int(11) null,
  `dni_c` varchar(9) collate utf8_spanish_ci default null,
`id` int(11) not null,
  `precio_espacio` smallint(6) default null,
  `precio_fisio` smallint(6) default null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `servicio`
--

drop table if exists `servicio`;
create table `servicio` (
`id` int(11) not null,
  `fecha` date not null,
  `coste` int(11) not null,
  `descripcion` text collate utf8_spanish_ci,
  `pago_id` int(11) not null,
  `cliente_externo_id` int(11) default null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `sesion`
--

drop table if exists `sesion`;
create table `sesion` (
`id` int(11) not null,
  `actividad_id` int(11),
  `horas_posibles_id` int(11) not null,
  `evento_id` int(11) null,
  `user_id` int(11) not null,
  `espacio_id` int(11) not null
) engine=innodb default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `user`
--

drop table if exists `user`;
create table `user` (
`id` int(11) not null,
  `dni` varchar(9) collate utf8_spanish_ci not null,
  `username` varchar(25) collate utf8_spanish_ci not null,
  `name` varchar(15) collate utf8_spanish_ci not null,
  `surname` varchar(40) collate utf8_spanish_ci not null,
  `fecha_nac` date not null,
  `direccion` varchar(50) collate utf8_spanish_ci not null,
  `comentario` varchar(500) collate utf8_spanish_ci default null,
  `num_cuenta` varchar(24) collate utf8_spanish_ci not null,
  `tipo_contrato` varchar(20) collate utf8_spanish_ci not null,
  `email` varchar(40) collate utf8_spanish_ci not null,
  `foto` varchar(50) collate utf8_spanish_ci not null,
  `activo` tinyint(1) not null default '1',
  `passwd` varchar(15) collate utf8_spanish_ci default null,
  `profile` varchar(25) collate utf8_spanish_ci default null
) engine=innodb auto_increment=3 default charset=utf8 collate=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- table structure for table `user_perms`
--

drop table if exists `user_perms`;
create table `user_perms` (
`id` int(11) not null,
  `user` int(11) not null,
  `permission` int(11) not null
) engine=innodb auto_increment=31 default charset=utf8 collate=utf8_spanish_ci;


--
-- indexes for dumped tables
--

--
-- indexes for table `action`
--
alter table `action`
 add primary key (`id`), add unique key `actionname_unique` (`actionname`);

--
-- indexes for table `actividad`
--
alter table `actividad`
 add primary key (`id`), add key `fk_actividad_espacio1_idx` (`espacio_id`), add key `fk_actividad_categoria1_idx` (`categoria_id`);

--
-- indexes for table `alerta`
--
alter table `alerta`
 add primary key (`id`), add key `fk_alerta_pago1_idx` (`pago_id`), add key `fk_alerta_asistencia1_idx` (`asistencia_id_cliente`,`asistencia_sesion_id`), add key `fk_alerta_user1_idx` (`user_id`);

--
-- indexes for table `aplica`
--
alter table `aplica`
 add primary key (`descuento_id`,`actividad_id`), add key `fk_aplica_descuento1_idx` (`descuento_id`), add key `fk_aplica_actividad1_idx` (`actividad_id`);

--
-- indexes for table `asistencia`
--
alter table `asistencia`
 add primary key (`id_cliente`,`sesion_id`), add key `fk_asistencia_sesion1_idx` (`sesion_id`);

--
-- indexes for table `caja`
--
alter table `caja`
 add primary key (`id`), add key `fk_caja_pago1_idx` (`pago_id`);

--
-- indexes for table `categoria`
--
alter table `categoria`
 add primary key (`id`);

--
-- indexes for table `cliente`
--
alter table `cliente`
 add primary key (`id`), add unique key `dni_c_unique` (`dni_c`);

--
-- indexes for table `cliente_externo`
--
alter table `cliente_externo`
 add primary key (`id`);

--
-- indexes for table `controller`
--
alter table `controller`
 add primary key (`id`), add unique key `controllername_unique` (`controllername`);

--
-- indexes for table `descuento`
--
alter table `descuento`
 add primary key (`id`), add key `fk_descuento_categoria1_idx` (`categoria_id`);

--
-- indexes for table `documento`
--
alter table `documento`
 add primary key (`id`), add key `dni_c_idx` (`dni_c`), add key `dni_idx` (`dni`);

--
-- indexes for table `empleado_mira`
--
alter table `empleado_mira`
 add primary key (`lesion_cliente_id_lesion`,`lesion_cliente_cliente_id`,`user_id`,`fecha`,`hora`), add key `fk_empleado_mira_lesion_cliente1_idx` (`lesion_cliente_id_lesion`,`lesion_cliente_cliente_id`), add key `fk_empleado_mira_user1_idx` (`user_id`);

--
-- indexes for table `espacio`
--
alter table `espacio`
 add primary key (`id`);

--
-- indexes for table `evento`
--
alter table `evento`
 add primary key (`id`), add key `fk_evento_espacio1_idx` (`espacio_id`);

--
-- indexes for table `factura`
--
alter table `factura`
 add primary key (`id`), add key `fk_factura_pago1_idx` (`pago_id`);

--
-- indexes for table `horario_temporada`
--
alter table `horario_temporada`
 add primary key (`id`);

--
-- indexes for table `horas_posibles`
--
alter table `horas_posibles`
 add primary key (`id`), add key `fk_horas_posibles_rango_horario1_idx` (`rango_horario_id`);

--
-- indexes for table `hora_fisio`
--
alter table `hora_fisio`
 add primary key (`id`), add key `id_reserva_idx` (`id_reserva`);

--
-- indexes for table `inscripcion`
--
alter table `inscripcion`
 add primary key (`id`), add key `fk_inscripcion_particular_externo1_idx` (`particular_externo_id`), add key `fk_inscripcion_evento1_idx` (`evento_id`), add key `fk_inscripcion_reserva1_idx` (`reserva_id`),add key `fk_inscripcion_actividad1_idx` (`id_actividad`),add key `fk_inscripcion_descuento1_idx` (`id_descuento`),add key `fk_inscripcion_cliente1_idx` (`cliente_dni_c`);

--
-- indexes for table `lesion`
--
alter table `lesion`
 add primary key (`id`);

--
-- indexes for table `lesion_cliente`
--
alter table `lesion_cliente`
 add primary key (`id_lesion`,`cliente_id`), add key `fk_lesion_cliente_cliente1_idx` (`cliente_id`),add key `fk_lesion_cliente_lesion1_idx` (`id_lesion`);

--
-- indexes for table `lesion_empleado`
--
alter table `lesion_empleado`
 add primary key (`user_id`,`lesion_id`), add key `fk_lesion_empleado_lesion1_idx` (`lesion_id`),add key `fk_lesion_empleado_user1_idx` (`user_id`);

--
-- indexes for table `linea_factura`
--
alter table `linea_factura`
 add primary key (`id`,`id_factura`), add key `id_factura_idx` (`id_factura`);

--
-- indexes for table `notificacion`
--
alter table `notificacion`
 add primary key (`id`), add key `fk_notificacion_user1_idx` (`user_id`);

--
-- indexes for table `pago`
--
alter table `pago`
 add primary key (`id`), add key `fk_pago_reserva1_idx` (`reserva_id`), add key `fk_pago_inscripcion1_idx` (`inscripcion_id`);

--
-- indexes for table `particular_externo`
--
alter table `particular_externo`
 add primary key (`id`);

--
-- indexes for table `percibe`
--
alter table `percibe`
 add primary key (`user_id`,`alerta_id`), add key `fk_percibe_user1_idx` (`user_id`), add key `fk_percibe_alerta1_idx` (`alerta_id`);

--
-- indexes for table `permission`
--
alter table `permission`
 add primary key (`id`), add key `fk_permission_controller1_idx` (`controller`), add key `fk_permission_action1_idx` (`action`);

--
-- indexes for table `profile`
--
alter table `profile`
 add primary key (`id`), add unique key `profilename_unique` (`profilename`);

--
-- indexes for table `profile_perms`
--
alter table `profile_perms`
 add primary key (`id`), add key `profileid_idx` (`profile`), add key `fk_profile_perms_permission1_idx` (`permission`);

--
-- indexes for table `rango_horario`
--
alter table `rango_horario`
 add primary key (`id`), add key `fk_rango_horario_horario_temporada1_idx` (`horario_temporada_id`);

--
-- indexes for table `recibe`
--
alter table `recibe`
 add primary key (`notificacion_id`,`cliente_id`), add key `fk_recibe_notificacion1_idx` (`notificacion_id`), add key `fk_recibe_cliente1_idx` (`cliente_id`);

--
-- indexes for table `recibo`
--
alter table `recibo`
 add primary key (`id`), add key `fk_recibo_pago1_idx` (`pago_id`);

--
-- indexes for table `reserva`
--
alter table `reserva`
 add primary key (`id`), add key `id_espacio_idx` (`id_espacio`),add key `fk_reserva_cliente1_idx` (`dni_c`);

--
-- indexes for table `servicio`
--
alter table `servicio`
 add primary key (`id`), add key `fk_servicio_pago1_idx` (`pago_id`), add key `fk_servicio_cliente_externo1_idx` (`cliente_externo_id`);

--
-- indexes for table `sesion`
--
alter table `sesion`
-- add primary key (`id`,`actividad_id`,`horas_posibles_id`,`evento_id`,`user_id`,`espacio_id`), add key `fk_sesion_actividad1_idx` (`actividad_id`), add key `fk_sesion_horas_posibles1_idx` (`horas_posibles_id`), add key `fk_sesion_evento1_idx` (`evento_id`), add key `fk_sesion_user1_idx` (`user_id`), add key `fk_sesion_espacio1_idx` (`espacio_id`);
 add primary key (`id`), add key `fk_sesion_actividad1_idx` (`actividad_id`), add key `fk_sesion_horas_posibles1_idx` (`horas_posibles_id`), add key `fk_sesion_evento1_idx` (`evento_id`), add key `fk_sesion_user1_idx` (`user_id`), add key `fk_sesion_espacio1_idx` (`espacio_id`);
--
-- indexes for table `user`
--
alter table `user`
 add primary key (`id`), add unique key `dni_unique` (`dni`), add key `fk_user_profile1_idx` (`profile`);

--
-- indexes for table `user_perms`
--
alter table `user_perms`
 add primary key (`id`), add key `userid_idx` (`user`), add key `fk_user_perms_permission1_idx` (`permission`);

--
-- auto_increment for dumped tables
--

--
-- auto_increment for table `action`
--
alter table `action`
modify `id` int(11) not null auto_increment,auto_increment=6;
--
-- auto_increment for table `actividad`
--
alter table `actividad`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `alerta`
--
alter table `alerta`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `caja`
--
alter table `caja`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `categoria`
--
alter table `categoria`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `cliente`
--
alter table `cliente`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `cliente_externo`
--
alter table `cliente_externo`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `controller`
--
alter table `controller`
modify `id` int(11) not null auto_increment,auto_increment=7;
--
-- auto_increment for table `descuento`
--
alter table `descuento`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `documento`
--
alter table `documento`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `espacio`
--
alter table `espacio`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `evento`
--
alter table `evento`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `factura`
--
alter table `factura`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `horario_temporada`
--
alter table `horario_temporada`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `horas_posibles`
--
alter table `horas_posibles`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `hora_fisio`
--
alter table `hora_fisio`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `inscripcion`
--
alter table `inscripcion`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `lesion`
--
alter table `lesion`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `linea_factura`
--
alter table `linea_factura`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `notificacion`
--
alter table `notificacion`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `pago`
--
alter table `pago`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `particular_externo`
--
alter table `particular_externo`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `permission`
--
alter table `permission`
modify `id` int(11) not null auto_increment,auto_increment=31;
--
-- auto_increment for table `profile`
--
alter table `profile`
modify `id` int(11) not null auto_increment,auto_increment=2;
--
-- auto_increment for table `profile_perms`
--
alter table `profile_perms`
modify `id` int(11) not null auto_increment,auto_increment=31;
--
-- auto_increment for table `recibo`
--
alter table `recibo`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `rango_horario`
--
alter table `rango_horario`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `reserva`
--
alter table `reserva`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `servicio`
--
alter table `servicio`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `sesion`
--
alter table `sesion`
modify `id` int(11) not null auto_increment;
--
-- auto_increment for table `user`
--
alter table `user`
modify `id` int(11) not null auto_increment,auto_increment=3;
--
-- auto_increment for table `user_perms`
--
alter table `user_perms`
modify `id` int(11) not null auto_increment,auto_increment=31;
--
-- constraints for dumped tables
--

--
-- constraints for table `actividad`
--
alter table `actividad`
add constraint `fk_actividad_categoria1` foreign key (`categoria_id`) references `categoria` (`id`)  on delete cascade on update cascade,
add constraint `fk_actividad_espacio1` foreign key (`espacio_id`) references `espacio` (`id`)  on delete cascade on update cascade;

--
-- constraints for table `alerta`
--


alter table `alerta`
add constraint `fk_alerta_asistencia1` foreign key (`asistencia_id_cliente`, `asistencia_sesion_id`) references `asistencia` (`id_cliente`,`sesion_id`) on delete cascade on update cascade,
add constraint `fk_alerta_pago1` foreign key (`pago_id`) references `pago` (`id`)  on delete cascade on update cascade,
add constraint `fk_alerta_user1` foreign key (`user_id`) references `user` (`id`)  on delete cascade on update cascade;

--
-- constraints for table `aplica`
--
alter table `aplica`
add constraint `fk_aplica_actividad1` foreign key (`actividad_id`) references `actividad` (`id`)  on delete cascade on update cascade,
add constraint `fk_aplica_descuento1` foreign key (`descuento_id`) references `descuento` (`id`)  on delete cascade on update cascade;

--
-- constraints for table `asistencia`
--

alter table `asistencia`
add constraint `fk_asistencia_sesion1` foreign key (`sesion_id`) references `sesion` (`id`)  on delete cascade on update cascade,
add constraint `id_cliente` foreign key (`id_cliente`) references `cliente` (`id`)  on delete cascade on update cascade;

--
-- constraints for table `caja`
--
alter table `caja`
add constraint `fk_caja_pago1` foreign key (`pago_id`) references `pago` (`id`)  on delete cascade on update cascade;

--
-- constraints for table `descuento`
--
alter table `descuento`
add constraint `fk_descuento_categoria1` foreign key (`categoria_id`) references `categoria` (`id`)  on delete cascade on update cascade;

--
-- constraints for table `documento`
--
alter table `documento`
add constraint `dni` foreign key (`dni`) references `user` (`dni`) on delete cascade on update cascade,
add constraint `dni_c` foreign key (`dni_c`) references `cliente` (`dni_c`) on delete cascade on update cascade;

--
-- constraints for table `evento`
--
alter table `evento`
add constraint `fk_evento_espacio1` foreign key (`espacio_id`) references `espacio` (`id`) on delete cascade on update cascade;

--
-- constraints for table `factura`
--
alter table `factura`
add constraint `fk_factura_pago1` foreign key (`pago_id`) references `pago` (`id`) on delete cascade on update cascade;

--
-- constraints for table `horas_posibles`
--
alter table `horas_posibles`
add constraint `fk_horas_posibles_rango_horario1` foreign key (`rango_horario_id`) references `rango_horario` (`id`) on delete cascade on update cascade;

--
-- constraints for table `hora_fisio`
--
alter table `hora_fisio`
add constraint `id_reserva` foreign key (`id_reserva`) references `reserva` (`id`) on delete cascade on update cascade;

--
-- constraints for table `inscripcion`
--
alter table `inscripcion`
add constraint `fk_inscripcion_cliente1` foreign key (`cliente_dni_c`) references `cliente` (`dni_c`) on delete cascade on update cascade,
add constraint `fk_inscripcion_evento1` foreign key (`evento_id`) references `evento` (`id`) on delete cascade on update cascade,
add constraint `fk_inscripcion_particular_externo1` foreign key (`particular_externo_id`) references `particular_externo` (`id`) on delete cascade on update cascade,
add constraint `fk_inscripcion_reserva1` foreign key (`reserva_id`) references `reserva` (`id`) on delete cascade on update cascade,
add constraint `fk_inscripcion_actividad1` foreign key (`id_actividad`) references `actividad` (`id`) on delete cascade on update cascade,
add constraint `fk_inscripcion_descuento1` foreign key (`id_descuento`) references `descuento` (`id`) on delete cascade on update cascade;


--
-- constraints for table `lesion_cliente`
--
alter table `lesion_cliente`
add constraint `fk_lesion_cliente_cliente1` foreign key (`cliente_id`) references `cliente` (`id`) on delete cascade on update cascade,
add constraint `id_lesion` foreign key (`id_lesion`) references `lesion` (`id`) on delete cascade on update cascade;

--
-- constraints for table `lesion_empleado`
--
alter table `lesion_empleado`
add constraint `fk_lesion_empleado_lesion1` foreign key (`lesion_id`) references `lesion` (`id`) on delete cascade on update cascade,
add constraint `fk_lesion_empleado_user1` foreign key (`user_id`) references `user` (`id`) on delete cascade on update cascade;

--
-- constraints for table `linea_factura`
--
alter table `linea_factura`
add constraint `id_factura` foreign key (`id_factura`) references `factura` (`id`) on delete cascade on update cascade;

--
-- constraints for table `notificacion`
--
alter table `notificacion`
add constraint `fk_notificacion_user1` foreign key (`user_id`) references `user` (`id`) on delete cascade on update cascade;

--
-- constraints for table `pago`
--
alter table `pago`
add constraint `fk_pago_inscripcion1` foreign key (`inscripcion_id`) references `inscripcion` (`id`) on delete cascade on update cascade,
add constraint `fk_pago_reserva1` foreign key (`reserva_id`) references `reserva` (`id`) on delete cascade on update cascade;

--
-- constraints for table `percibe`
--
alter table `percibe`
add constraint `fk_percibe_alerta1` foreign key (`alerta_id`) references `alerta` (`id`) on delete cascade on update cascade,
add constraint `fk_percibe_user1` foreign key (`user_id`) references `user` (`id`) on delete cascade on update cascade;

--
-- constraints for table `permission`
--
alter table `permission`
add constraint `fk_permission_action1` foreign key (`action`) references `action` (`actionname`) on delete cascade on update cascade,
add constraint `fk_permission_controller1` foreign key (`controller`) references `controller` (`controllername`) on delete cascade on update cascade;

--
-- constraints for table `profile_perms`
--
alter table `profile_perms`
add constraint `fk_profile_perms_permission1` foreign key (`permission`) references `permission` (`id`) on delete cascade on update cascade,
add constraint `profileid` foreign key (`profile`) references `profile` (`id`) on delete cascade on update cascade;

--
-- constraints for table `rango_horario`
--
alter table `rango_horario`
add constraint `fk_rango_horario_horario_temporada1` foreign key (`horario_temporada_id`) references `horario_temporada` (`id`) on delete cascade on update cascade;

--
-- constraints for table `recibe`
--
alter table `recibe`
add constraint `fk_recibe_cliente1` foreign key (`cliente_id`) references `cliente` (`id`) on delete cascade on update cascade,
add constraint `fk_recibe_notificacion1` foreign key (`notificacion_id`) references `notificacion` (`id`) on delete cascade on update cascade;

--
-- constraints for table `recibo`
--
alter table `recibo`
add constraint `fk_recibo_pago1` foreign key (`pago_id`) references `pago` (`id`) on delete cascade on update cascade;

--
-- constraints for table `reserva`
--
alter table `reserva`
add constraint `id_espacio` foreign key (`id_espacio`) references `espacio` (`id`) on delete cascade on update cascade,
add constraint `fk_reserva_cliente1` foreign key (`dni_c`) references `cliente` (`dni_c`) on delete cascade on update cascade;

--
-- constraints for table `servicio`
--
alter table `servicio`
add constraint `fk_servicio_cliente_externo1` foreign key (`cliente_externo_id`) references `cliente_externo` (`id`) on delete set null on update set null,
add constraint `fk_servicio_pago1` foreign key (`pago_id`) references `pago` (`id`) on delete cascade on update cascade;

--
-- constraints for table `sesion`
--
alter table `sesion`
add constraint `fk_sesion_actividad1` foreign key (`actividad_id`) references `actividad` (`id`) on delete cascade on update cascade,
add constraint `fk_sesion_espacio1` foreign key (`espacio_id`) references `espacio` (`id`) on delete cascade on update cascade,
add constraint `fk_sesion_evento1` foreign key (`evento_id`) references `evento` (`id`) on delete cascade on update cascade,
add constraint `fk_sesion_horas_posibles1` foreign key (`horas_posibles_id`) references `horas_posibles` (`id`) on delete cascade on update cascade,
add constraint `fk_sesion_user1` foreign key (`user_id`) references `user` (`id`) on delete cascade on update cascade;

--
-- constraints for table `user`
--
alter table `user`
add constraint `fk_user_profile1` foreign key (`profile`) references `profile` (`profilename`) on delete set null on update cascade;

--
-- constraints for table `user_perms`
--
alter table `user_perms`
add constraint `fk_user_perms_permission1` foreign key (`permission`) references `permission` (`id`) on delete cascade on update cascade,
add constraint `userid` foreign key (`user`) references `user` (`id`) on delete cascade on update cascade;

-- ---------------------------------------------------

--
-- dumping data for table `profile`
--

insert into `profile` (`id`, `profilename`) values
(1, 'admin'),
(2, 'monitor');

--
-- dumping data for table `user`
--

insert into `user` (`id`, `dni`, `username`, `name`, `surname`, `fecha_nac`, `direccion`, `comentario`, `num_cuenta`, `tipo_contrato`, `email`, `foto`, `activo`, `passwd`, `profile`) values
(1, '28955163A', 'admin', 'administrador', 'administrador', '1991-11-01', 'Calle Emilia Pardo Bazán 5,5ºD, Ourense', 'Un saludo', 'ES9287423222928374923847', 'indefinido', 'usuario@gmail.com', '', 1, 'admin', 'admin'),
(2, '44326119J', 'usuario', 'javier', 'Fernández López', '1992-12-24', 'Calle Falsa 123, Ourense', '', 'ES9287423222928374923848', 'indefinido', 'javi.f@gmail.com', '', 0, 'abc123.', 'admin'),
(3, '34137683W', 'rosaM', 'Rosa', 'Martinez Pereira', '1990-12-25', 'Pasadizo Gaspassin, 188A 17ºE', '', 'ES9287423222928374923849', 'indefinido', 'rosa@esei.uvigo.es', '', 1, 'abc123.', 'monitor'),
(4, '44787624T', 'fernandoC', 'Fernando', 'Castelo Castelo', '1980-06-05', 'Calle Noriega Alonso, 7 7ºA, Santiago, A Coruña', '', 'ES9287423222928370000000', 'indefinido', 'fernando@esei.uvigo.es', '', 1, 'abc123.', 'monitor');


--
-- dumping data for table `action`
--

insert into `action` (`id`, `actionname`) values
(3, 'add'),
(5, 'delete'),
(1, 'show'),
(2, 'showone'),
(4, 'edit');

--
-- dumping data for table `controller`
--

insert into `controller` (`id`, `controllername`) values
(5, 'action'),
(2, 'controller'),
(3, 'permission'),
(4, 'profile'),
(1, 'user'),
(6, 'userperm'),
(7, 'profileperm'),
(8, 'injury'),
(9, 'activity'),
(10, 'client'),
(11, 'cash'),
(12, 'externalcustomer'),
(13, 'season'),
(14, 'rankhour'),
(15, 'hour'),
(16, 'session');




--
-- dumping data for table `permission`
--

insert into `permission` (`id`, `controller`, `action`) values
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
(12, 'permission', 'delete'),
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
(35, 'profileperm', 'edit'),
(36, 'injury', 'add'),
(37, 'injury', 'delete'),
(38, 'injury', 'show'),
(39, 'injury', 'showone'),
(40, 'injury', 'edit'),
(41, 'activity', 'delete'),
(42, 'activity', 'show'),
(43, 'activity', 'showone'),
(44, 'activity', 'add'),
(45, 'activity', 'edit'),
(46, 'client', 'delete'),
(47, 'client', 'show'),
(48, 'client', 'showone'),
(49, 'client', 'add'),
(50, 'client', 'edit'),
(51, 'cash', 'delete'),
(52, 'cash', 'show'),
(53, 'cash', 'showone'),
(54, 'cash', 'add'),
(55, 'cash', 'edit'),
(56, 'externalcustomer', 'delete'),
(57, 'externalcustomer', 'show'),
(58, 'externalcustomer', 'showone'),
(59, 'externalcustomer', 'add'),
(60, 'externalcustomer', 'edit'),
(61, 'season', 'show'),
(62, 'season', 'add'),
(63, 'season', 'edit'),
(64, 'season', 'delete'),
(65, 'rankhour', 'add'),
(66, 'rankhour', 'show'),
(67, 'rankhour', 'delete'),
(68, 'hour', 'add'),
(69, 'hour', 'delete'),
(70, 'hour', 'show'),
(71, 'session', 'delete'),
(72, 'session', 'show'),
(73, 'session', 'showone'),
(74, 'session', 'add'),
(75, 'session', 'edit');

--
-- dumping data for table `cliente`
--
insert into `cliente` (`id`, `dni_c`, `nombre_c`, `apellidos_c`, `fecha_nac`,`num_cuenta`, `profesion`, `telefono`, `direccion`, `comentario`, `email`, `alerta_falta`, `desempleado`, `estudiante`, `familiar`,`activo`,`foto`) values
(1, '65417959W', 'Jose', 'Lopez Antelo', '1993-11-11','ES928742322292837492384', 'Programador', 695478210, 'Alameda Estucava parietària emmarciria, 276B 2ºA', 'Muy activo', 'jose.lopez@gmail.com', true, default, true, default,false,null),
(2, '81974662V', 'Elena', 'Nito Del Bosque', '1988-12-12','ES9287423222928374923847', 'Ingeniero', 632588745, 'Pasaje Remosquejades, 300A 4ºD', 'Le encanta Pilates', 'elena.nito@delbosque.com', false, default, default, default,false,null),
(3, '68942909H', 'Manuel', 'López Fernández', '1968-11-12','ES9287423332928374923847', 'Pastelero', 698523147, 'Avenida Debanaries Enllatin Renillin, 59', 'Soy pastelero', 'manu@gmail.com', false, false, false, true,true,null),
(4, '51453544Z', 'Antonio', 'Míguez Calvo', '1995-01-06','ES9287423332928371259682', null, 635921362, 'C/ Nº, Rúa Alcalde Lorenzo, 6, 15220 Bertamiráns, A Coruña', 'Pasota', 'antonio@gmail.com', false, true, true, true,true,null),
(5, '61682944A', 'Carla', 'González González', '1994-12-28','ES1256987458965230000025', null, 698377781, 'Ronda de Outeiro, 306 - 15011 - A Coruña', 'Vaga', 'carla@gmail.com', false, true, true, true,true,null);


--
-- dumping data for table `particular_externo`
--
insert into `particular_externo` (`id`, `nombre`, `apellidos`, `telefono`) values (1, 'nombreext', 'apellidosext', 111222333);

--
-- dumping data for table `espacio`
--
insert into `espacio` (`id`, `nombre`) values
(1, 'Sala 1'),
(2, 'Sala 2'),
(3, 'Sala cardio'),
(4, 'Sala fitness'),
(5, 'Sala baile 1'),
(6, 'Sala baile 2');


--
-- dumping data for table `reserva`
--
insert into `reserva` (`id`, `id_espacio`, `dni_c`, `precio_espacio`, `precio_fisio`) values (1, 1, '65417959W', 13, null),(2, null, '81974662V', null, 25);

--
-- dumping data for table `categoria`
--
insert into `categoria` (`id`, `tipo`) values (1, 'azul'),(2, 'rosa');

--
-- dumping data for table `descuento`
--
insert into `descuento` (`id`, `descripcion`,`categoria_id`, `cantidad`) values (1, 'azul', 1, 10),(2, 'rosa', 2, 20);

--
-- dumping data for table `evento`
--
insert into `evento` (`id`, `nombre`, `espacio_id`, `precio`) values (1, 'halloween', 1, 5),(2, 'magosto', 2, 7);

--
-- dumping data for table `actividad`
--
insert into `actividad` (`id`, `nombre`, `espacio_id`, `capacidad`, `precio`, `categoria_id`) values
(1, 'zumba', 5, 20, 4, 1),
(2, 'salsa', 6, 20, 4, 2),
(3, 'pilates', 2, 15, 5, 1),
(4, 'spinning', 3, 25, 3, 2),
(5, 'step', 4, 10, 4, 2),
(6, 'hiit', 1, 20, 3, 2);



--
-- dumping data for table `inscripcion`
--
insert into `inscripcion` (`id`, `particular_externo_id`, `evento_id`, `id_actividad`, `reserva_id`, `cliente_dni_c`, `fecha`, `id_descuento`) values
(1, 1, 1, null, null, '65417959W', '2016-4-3', null),
(2, null, null, 1, null, '68942909H', '2016-4-3', null),
(3, null, null, 2, null, '68942909H', '2016-4-4', null);

--
-- dumping data for table `documento`
--
insert into `documento` (`dni`, `dni_c`, `id`, `tipo`, `documento`) values
(null, '65417959W', 1, 'lesion', 'lesion1.pdf'),
('28955163A', null, 2, 'sepa', 'sepa1.pdf');

--
-- dumping data for table `lesion`
--
insert into `lesion` (`id`, `descripcion`) values
  (1, 'Esguince de tobillo'),
  (2, 'Distension de biceps'),
  (3, 'Fractura de tibia'),
  (4, 'Fractura de escafoides '),
  (5, 'Distension de cuadriceps'),
  (6, 'Contractura omoplato');

--
-- dumping data for table `lesion_cliente`
--
insert into `lesion_cliente` (`id_lesion`, `cliente_id`) values
  (1, 1),
  (1, 3),
  (2, 4);


--
-- dumping data for table `lesion_empleado`
--
insert into `lesion_empleado` ( `lesion_id`,  `user_id`) values (2, 1);

--
-- dumping data for table `empleado_mira`
--
insert into `empleado_mira` (`user_id`, `lesion_cliente_cliente_id`, `lesion_cliente_id_lesion`, `fecha`,`hora`) values
  (1, 1, 1, '2016-11-4','12:00:22'),
  (1, 3, 1, '2016-08-28','11:04:33'),
  (2, 4, 2, '2016-11-4','19:05:01');

--
-- dumping data for table `horario_temporada`
--
insert into `horario_temporada` (`id`, `dia_inicio`, `dia_fin`, `nombre_temp`) values
(1, '2016-6-15', '2016-9-15', 'Verano'),
(2, '2016-9-16', '2017-6-15', 'Invierno');

--
-- dumping data for table `rango_horario`
--
insert into `rango_horario` (`id`, `dia_s`, `hora_apertura`, `hora_cierre`, `horario_temporada_id`) values
(1, 'Monday', '9:00', '15:00', 1),
(2, 'Tuesday', '9:00', '15:00', 1),
(3, 'Wednesday', '9:00', '15:00', 1),
(4, 'Thursday', '9:00', '15:00', 1),
(5, 'Friday', '9:00', '15:00', 1);


--
-- dumping data for table `horas_posibles`
--
insert into `horas_posibles` (`id`,`dia`, `hora_inicio`, `hora_fin`,`rango_horario_id`,`active`) values
(1,'2016-09-05', '9:00', '10:00', 1,1),
(2,'2016-09-05', '10:00', '11:00', 1,1),
(3,'2016-09-05', '11:00', '12:00', 1,1),
(4,'2016-09-05', '12:00', '13:00', 1,1),
(5,'2016-09-05', '13:00', '14:00', 1,1),
(6,'2016-09-05', '14:00', '15:00', 1,1),
(7,'2016-09-06', '9:00', '10:00', 2,1),
(8,'2016-09-06', '10:00', '11:00', 2,1),
(9,'2016-09-06', '11:00', '12:00', 2,1),
(10,'2016-09-06', '12:00', '13:00', 2,1),
(11,'2016-09-06', '13:00', '14:00', 2,1),
(12,'2016-09-06', '14:00', '15:00', 2,1),
(13,'2016-09-07', '9:00', '10:00', 3,0),
(14,'2016-09-07', '10:00', '11:00', 3,0),
(15,'2016-09-07', '11:00', '12:00', 3,0),
(16,'2016-09-07', '12:00', '13:00', 3,0),
(17,'2016-09-07', '13:00', '14:00', 3,0),
(18,'2016-09-07', '14:00', '15:00', 3,0),
(19,'2016-09-08', '9:00', '10:00', 4,0),
(20,'2016-09-08', '10:00', '11:00', 4,0),
(21,'2016-09-08', '11:00', '12:00', 4,0),
(22,'2016-09-08', '12:00', '13:00', 4,0),
(23,'2016-09-08', '13:00', '14:00', 4,0),
(24,'2016-09-08', '14:00', '15:00', 4,0);

--
-- dumping data for table `sesion`
--
insert into `sesion` (`id`, `espacio_id`, `evento_id`, `actividad_id`, `user_id`,`horas_posibles_id`) values
  (1, 5, null, 1, 3, 1),
  (2, 6, null, 2, 4, 2),
  (3, 2, null, 3, 3, 3),
  (4, 3, null, 4, 4, 4),
  (5, 4, null, 5, 3, 5),
  (6, 1, null, 6, 4, 6),
  (7, 5, null, 1, 3, 7),
  (8, 6, null, 2, 4, 8),
  (9, 2, null, 3, 3, 9),
  (10, 3, null, 4, 4, 10),
  (11, 4, null, 5, 3, 11),
  (12, 1, null, 6, 4, 12);



--
-- dumping data for table `pago`
--
insert into `pago` (`id`, `metodo_pago`, `fecha`, `periodicidad`, `cantidad`, `inscripcion_id`, `reserva_id`,`realizado`) values
(1, 'tarjeta', '2016-3-2', null, 20, null, null,true),
(2, 'transferencia', '2016-4-9', 'anual', 100, 1, null,true),
(3, 'tarjeta', '2016-2-3', null, 300, null, null,false);

--
-- dumping data for table `asistencia`
--
insert into `asistencia` (`id_cliente`, `sesion_id`, `asiste`) values (1, 1, false),(2, 2, true);


--
-- dumping data for table `alerta`
--
insert into `alerta` (`id`, `descripcion`, `user_id`, `pago_id`, `asistencia_id_cliente`,`asistencia_sesion_id`) values
(1, 'no acude',null,null, 1, 1),
(2, 'no paga', null, 1, 1, null);

--
-- dumping data for table `notificacion`
--
insert into `notificacion` (`id`, `descripcion`, `user_id`) values (1, 'notifiacion1', 1);

--
-- dumping data for table `recibe`
--
insert into `recibe` (`notificacion_id`, `cliente_id`) values (1, 1);

--
-- dumping data for table `percibe`
--
insert into `percibe` ( `alerta_id`, `user_id`) values (1, 1);

--
-- dumping data for table `hora_fisio`
--
insert into `hora_fisio` (`id`, `id_reserva`, `dia_f`, `hora_i`, `hora_f`,`asistencia`) values (1, 2, '2016-11-11', '17:00', '18:00',true);

--
-- dumping data for table `factura`
--
insert into `factura` (`id`, `pago_id`, `fecha`,`precio_total`) values (1, 1, '2016-10-5',40);

--
-- dumping data for table `linea_factura`
--
insert into `linea_factura` (`id`, `id_factura`, `producto`, `cantidad`, `precio`,`iva`) values (1, 1, 'batido proteinas', 1, 10,21),(2, 1, 'guantes', 2, 30,21);

--
-- dumping data for table `recibo`
--
insert into `recibo` (`id`, `pago_id`, `producto`, `precio`, `cantidad`) values (1, 2, 'clase zumba anual', 100, 1);

--
-- dumping data for table `caja`
--
insert into `caja` (`pago_id`, `id`, `efectivo_inicial`, `cantidad`, `efectivo_final`,`descripcion`,`tipo`,`fecha`) values
(1, 1, 0, 20, 20,'Pagar pagaron','cash income','2016-11-11'),
(2, 2, 20, -10, 10,'Estos tambien pagaron','payment','2016-11-11');

--
-- dumping data for table `cliente_externo`
--
insert into `cliente_externo` (`id`, `dni_nif`, `nombre`, `apellido`, `telefono`, `email`) values
(1, '12345678f', 'externo', 'apellidoext', 888888888, 'exte@rno.com');

--
-- dumping data for table `servicio`
--
insert into `servicio` (`id`, `fecha`, `coste`, `pago_id`,  `cliente_externo_id`, `descripcion`) values (1, '2016-12-3', 300, 3, 1, 'boda');

--
-- dumping data for table `aplica`
--
insert into `aplica` (`descuento_id`,`actividad_id`,`extra`) values (1, 1,2),(2,2,null);

--
-- dumping data for table `user_perms`
--

insert into `user_perms` (`id`, `user`, `permission`) values
(1, 1, 1);

--
-- dumping data for table `profile_perms`
--

insert into `profile_perms` (`id`, `profile`, `permission`) values
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
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
(35, 1, 35),
(36, 1, 36),
(37, 1, 37),
(38, 1, 38),
(39, 1, 39),
(40, 1, 40),
(41, 1, 41),
(42, 1, 42),
(43, 1, 43),
(44, 1, 44),
(45, 1, 45),
(46, 1, 46),
(47, 1, 47),
(48, 1, 48),
(49, 1, 49),
(50, 1, 50),
(51, 1, 51),
(52, 1, 52),
(53, 1, 53),
(54, 1, 54),
(55, 1, 55),
(56, 1, 56),
(57, 1, 57),
(58, 1, 58),
(59, 1, 59),
(60, 1, 60),
(61, 2, 43),
(62, 2, 42),
(63, 2, 50),
(64, 2, 47),
(65, 2, 48),
(66, 2, 39),
(67, 2, 38),
(68, 1, 61),
(69, 1, 62),
(70, 1, 63),
(71, 1, 64),
(72, 1, 65),
(73, 1, 66),
(74, 1, 67),
(75, 1, 68),
(76, 1, 69),
(77, 1, 70),
(78, 1, 71),
(79, 1, 72),
(80, 1, 73),
(81, 1, 74),
(82, 1, 75);





GRANT USAGE ON *.* TO 'moovett'@'localhost';
DROP USER 'moovett'@'localhost';

CREATE USER 'moovett'@'localhost' IDENTIFIED BY 'moovett';
GRANT ALL PRIVILEGES ON * . * TO 'moovett'@'localhost';

/*!40101 set character_set_client=@old_character_set_client */;
/*!40101 set character_set_results=@old_character_set_results */;
/*!40101 set collation_connection=@old_collation_connection */;
