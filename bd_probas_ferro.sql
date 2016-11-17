-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2016 at 12:35 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
`id` int(11) NOT NULL,
  `actionname` varchar(25) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `actionname`) VALUES
(1, 'show'),
(2, 'borrar');

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE `controller` (
`id` int(11) NOT NULL,
  `controllername` varchar(25) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id`, `controllername`) VALUES
(1, 'user'),
(2, 'Controlador');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
`id` int(11) NOT NULL,
  `controller` varchar(25) DEFAULT NULL,
  `action` varchar(25) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `controller`, `action`) VALUES
(1, 'user', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
`id` int(11) NOT NULL,
  `profilename` varchar(25) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `profilename`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `profile_perms`
--

CREATE TABLE `profile_perms` (
`id` int(11) NOT NULL,
  `profileid` int(11) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_perms`
--

INSERT INTO `profile_perms` (`id`, `profileid`, `permission`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
`id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `passwd` varchar(15) DEFAULT NULL,
  `profile` varchar(25) DEFAULT NULL,
  `dni` varchar(9) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `num_cuenta` varchar(24) NOT NULL,
  `tipo_contrato` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `passwd`, `profile`, `dni`, `name`, `surname`, `fecha_nac`, `direccion`, `comentario`, `num_cuenta`, `tipo_contrato`, `email`, `foto`, `activo`) VALUES
(1, 'test', 'abc123.', 'admin', '44849234Q', 'José Ángel', 'Ferro Santiago', '2016-11-15', 'Calle Emilia Pardo Bazán 5, 5ªD, 32004, Ourense', 'Hoy nos toca explorar los comentarios nativos de WordPress, las opciones que nos dan y aprender a activarlos y desactivarlos correctamente. Si tienes una web desde hace tiempo, sabrás lo importante que son los comentarios para cualquier blog, y si eres nuevo en esto del blogging, no desesperes, seguro que en breve comenzarán a llegar cientos de comentarios ', 'ES9121000418450200051332', 'Indefinido', 'jfsantiago2@esei.uvigo.es', '', 1),
(7, 'user', 'abc123.', 'admin', '44849234L', 'Nombre', 'Apellido 1', '2016-11-08', 'Calle falsa 123, Ourense', 'Un saludo', 'ES1287491287319283', 'Indefinido', 'email@esei.uvigo.es', 'profile_image.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_perms`
--

CREATE TABLE `user_perms` (
`id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controller`
--
ALTER TABLE `controller`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_perms`
--
ALTER TABLE `profile_perms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `DNI` (`dni`);

--
-- Indexes for table `user_perms`
--
ALTER TABLE `user_perms`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `controller`
--
ALTER TABLE `controller`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `profile_perms`
--
ALTER TABLE `profile_perms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_perms`
--
ALTER TABLE `user_perms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
