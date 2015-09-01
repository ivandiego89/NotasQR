-- phpMyAdmin SQL Dump
-- version 4.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2015 at 05:46 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbnotasqr`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `CODIGO_ALUMNO` varchar(15) NOT NULL,
  `NOMBRE_ALUMNO` text NOT NULL,
  `APELLIDO_PATERNO` text NOT NULL,
  `APELLIDO_MATERNO` text NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `TELEFONO` varchar(15) NOT NULL,
  `DIRECCION` varchar(100) NOT NULL,
  `SEXO` tinyint(4) NOT NULL,
  `FECHA_NACIMIENTO` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `ANIO_INGRESO` int(11) NOT NULL,
  `SEMESTRE_INGRESO` varchar(10) NOT NULL,
  `CARRERA_PROFESIONAL` varchar(80) NOT NULL,
  `TURNO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`CODIGO_ALUMNO`, `NOMBRE_ALUMNO`, `APELLIDO_PATERNO`, `APELLIDO_MATERNO`, `EMAIL`, `TELEFONO`, `DIRECCION`, `SEXO`, `FECHA_NACIMIENTO`, `DNI`, `ANIO_INGRESO`, `SEMESTRE_INGRESO`, `CARRERA_PROFESIONAL`, `TURNO`) VALUES
('200921407F', 'JORGE', 'GOMEZ', 'PEREZ', 'juan@perez.com', '2345678', '23456789', 0, 2345678, 25678, 2341, '2015-I', '1', 'M'),
('20112345-L', 'RAUL', 'FRANCO', 'GUZMAN', 'KJDFKJSDF', '2345678', '23456789', 1, 2345678, 25678, 2341, '2015-I', '1', 'T'),
('201507193-e', 'ROGER', 'MORGAN', 'RED', 'roger@pontiac.edu.pe', '2345678', 'cusco', 0, 2345678, 11111111, 2341, '2015-I', '1', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `alumno_asignatura`
--

CREATE TABLE IF NOT EXISTS `alumno_asignatura` (
  `CODIGO_MATRICULA` int(11) NOT NULL,
  `CODIGO_ALUMNO` varchar(15) NOT NULL,
  `CODIGO_ASIGNATURA` varchar(8) NOT NULL,
  `SEMESTRE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumno_asignatura`
--

INSERT INTO `alumno_asignatura` (`CODIGO_MATRICULA`, `CODIGO_ALUMNO`, `CODIGO_ASIGNATURA`, `SEMESTRE`) VALUES
(3, '200921407F', 'SI0001', '2015-II'),
(3, '20112345-L', 'SI0001', '2015-II'),
(3, '20112345-L', 'SI0002', '2015-II');

-- --------------------------------------------------------

--
-- Table structure for table `alumno_tokens`
--

CREATE TABLE IF NOT EXISTS `alumno_tokens` (
  `TOKEN` varchar(255) NOT NULL,
  `CODIGO_ALUMNO` varchar(15) NOT NULL,
  `SEMESTRE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumno_tokens`
--

INSERT INTO `alumno_tokens` (`TOKEN`, `CODIGO_ALUMNO`, `SEMESTRE`) VALUES
('Ip2--NPlnH1nPwHQWLS-Gnv45_2~php9OSqjHx)B=Pi(WzZbAucxpTKVXG+*', '20112345-L', '2015-II');

-- --------------------------------------------------------

--
-- Table structure for table `asignaturas`
--

CREATE TABLE IF NOT EXISTS `asignaturas` (
  `CODIGO_ASIGNATURA` varchar(8) NOT NULL,
  `NOMBRE_ASIGNATURA` varchar(30) NOT NULL,
  `CATEGORIA` varchar(10) NOT NULL,
  `CODIGO_CARRERA` int(11) NOT NULL,
  `HORAS` int(8) NOT NULL,
  `CREDITOS` int(8) NOT NULL,
  `CICLO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asignaturas`
--

INSERT INTO `asignaturas` (`CODIGO_ASIGNATURA`, `NOMBRE_ASIGNATURA`, `CATEGORIA`, `CODIGO_CARRERA`, `HORAS`, `CREDITOS`, `CICLO`) VALUES
('SI0001', 'PROGRAMACION I', 'REGULAR', 1, 4, 4, 1),
('SI0002', 'PROGRAMACION II', 'REGULAR', 1, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `CODIGO_CARRERA` int(11) NOT NULL,
  `NOMBRE_CARRERA` varchar(255) NOT NULL,
  `FACULTAD` int(11) NOT NULL,
  `SEMESTRES` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carreras`
--

INSERT INTO `carreras` (`CODIGO_CARRERA`, `NOMBRE_CARRERA`, `FACULTAD`, `SEMESTRES`) VALUES
(1, 'INGENIERIA DE SISTEMAS E INFORMÁTICA', 1, 10),
(2, 'CONTABILIDAD', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `docentes`
--

CREATE TABLE IF NOT EXISTS `docentes` (
  `CODIGO_DOCENTE` int(11) NOT NULL,
  `NOMBRE_DOCENTE` varchar(30) NOT NULL,
  `AP_DOCENTE` varchar(30) NOT NULL,
  `AM_DOCENTE` varchar(30) NOT NULL,
  `DIRECCION` varchar(30) NOT NULL,
  `TELEFONO` int(11) NOT NULL,
  `SEXO` varchar(30) NOT NULL,
  `DNI` int(11) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `FECHA_INGRESO` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docentes`
--

INSERT INTO `docentes` (`CODIGO_DOCENTE`, `NOMBRE_DOCENTE`, `AP_DOCENTE`, `AM_DOCENTE`, `DIRECCION`, `TELEFONO`, `SEXO`, `DNI`, `EMAIL`, `FECHA_INGRESO`) VALUES
(2, 'Juan', 'Gomez', 'Perez', 'su casa', 4567890, 'Z', 42151627, 'jossaa', 34567890);

-- --------------------------------------------------------

--
-- Table structure for table `docente_asignatura`
--

CREATE TABLE IF NOT EXISTS `docente_asignatura` (
  `CODIGO_DOCENTE` int(11) NOT NULL,
  `CODIGO_ASIGNATURA` varchar(8) NOT NULL,
  `SEMESTRE` varchar(10) NOT NULL,
  `CODIGO_CARRERA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `docente_asignatura`
--

INSERT INTO `docente_asignatura` (`CODIGO_DOCENTE`, `CODIGO_ASIGNATURA`, `SEMESTRE`, `CODIGO_CARRERA`) VALUES
(2, 'SI0001', '2015-I', 1),
(2, 'SI0001', '2015-II', 1),
(2, 'SI0002', '2015-I', 1),
(2, 'SI0002', '2015-II', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facultad`
--

CREATE TABLE IF NOT EXISTS `facultad` (
  `CODIGO_FACULTAD` int(11) NOT NULL,
  `NOMBRE_FACULTAD` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facultad`
--

INSERT INTO `facultad` (`CODIGO_FACULTAD`, `NOMBRE_FACULTAD`) VALUES
(1, 'INGENIERIA'),
(2, 'CIENCIAS CONTABLES Y FINANCIERAS');

-- --------------------------------------------------------

--
-- Table structure for table `matriculas`
--

CREATE TABLE IF NOT EXISTS `matriculas` (
  `CODIGO_MATRICULA` int(11) NOT NULL,
  `CODIGO_ALUMNO` varchar(15) DEFAULT NULL,
  `FECHA_MATRICULA` int(11) DEFAULT NULL,
  `CODIGO_CARRERA` int(11) DEFAULT NULL,
  `SEMESTRE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matriculas`
--

INSERT INTO `matriculas` (`CODIGO_MATRICULA`, `CODIGO_ALUMNO`, `FECHA_MATRICULA`, `CODIGO_CARRERA`, `SEMESTRE`) VALUES
(3, '20112345-L', 1440834311, 1, '2015-0');

-- --------------------------------------------------------

--
-- Table structure for table `menu_sistema`
--

CREATE TABLE IF NOT EXISTS `menu_sistema` (
  `ID` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL,
  `IMAGEN` varchar(50) NOT NULL DEFAULT 'imagenes/not_found.png',
  `URL` varchar(50) DEFAULT NULL,
  `ORDENAMIENTO` int(11) NOT NULL DEFAULT '0',
  `ESTATUS` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_sistema`
--

INSERT INTO `menu_sistema` (`ID`, `DESCRIPCION`, `IMAGEN`, `URL`, `ORDENAMIENTO`, `ESTATUS`) VALUES
(1, 'Inicio', 'imagenes/Customer.png', '#', 1, 0),
(2, 'Agregar Usuarios', 'imagenes/Proveedores.png', '/usuarios/nuevo', 3, 0),
(3, 'Listar Usuarios', 'imagenes/Product.png', '/usuarios', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `CODIGO_ALUMNO` varchar(15) NOT NULL,
  `CODIGO_ASIGNATURA` varchar(8) NOT NULL,
  `SEMESTRE` varchar(50) NOT NULL,
  `PRIMER_PARCIAL` decimal(10,0) DEFAULT NULL,
  `SEGUNDA_PARCIAL` decimal(10,0) DEFAULT NULL,
  `NOTA_FINAL` decimal(10,0) DEFAULT NULL,
  `FECHA_ING_NOTAS` int(11) NOT NULL,
  `FECHA_MODIFICACION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notas`
--

INSERT INTO `notas` (`CODIGO_ALUMNO`, `CODIGO_ASIGNATURA`, `SEMESTRE`, `PRIMER_PARCIAL`, `SEGUNDA_PARCIAL`, `NOTA_FINAL`, `FECHA_ING_NOTAS`, `FECHA_MODIFICACION`) VALUES
('200921407F', 'SI0001', '2015-II', '0', '0', '0', 1440990329, 1440990637),
('20112345-L', 'SI0001', '2015-II', '12', '12', '12', 1440988661, 1440990660);

-- --------------------------------------------------------

--
-- Table structure for table `permisosmenu`
--

CREATE TABLE IF NOT EXISTS `permisosmenu` (
  `ID` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_MENU` int(11) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permisosmenu`
--

INSERT INTO `permisosmenu` (`ID`, `ID_USUARIO`, `ID_MENU`, `ESTATUS`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(5, 2, 1, 0),
(6, 2, 3, 0),
(7, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `FECHA_REGISTRO` varchar(20) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  `TIPO` varchar(20) NOT NULL DEFAULT 'Invitado',
  `PASSWORD` varchar(50) DEFAULT '123'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `APELLIDOS`, `EMAIL`, `FECHA_REGISTRO`, `ESTATUS`, `TIPO`, `PASSWORD`) VALUES
(1, 'Juan', 'Perezsasdasd', 'elcapo@programando.com', '2014-07-30 14:39:06', 0, 'Administrador', '81dc9bdb52d04dc20036dbd8313ed055 '),
(2, 'Maria', 'Cortes Crisanto', 'crisant_89@hotmail.com', '2014-07-30 14:39:06', 0, 'Invitado', '263bce650e68ab4e23f28263760b9fa5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`CODIGO_ALUMNO`);

--
-- Indexes for table `alumno_asignatura`
--
ALTER TABLE `alumno_asignatura`
  ADD PRIMARY KEY (`CODIGO_MATRICULA`,`CODIGO_ALUMNO`,`CODIGO_ASIGNATURA`),
  ADD KEY `CODIGO_ASIGNATURA` (`CODIGO_ASIGNATURA`),
  ADD KEY `curso_alumno_ibfk_2` (`CODIGO_ALUMNO`);

--
-- Indexes for table `alumno_tokens`
--
ALTER TABLE `alumno_tokens`
  ADD PRIMARY KEY (`TOKEN`);

--
-- Indexes for table `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`CODIGO_ASIGNATURA`),
  ADD KEY `CODIGO_CARRERA` (`CODIGO_CARRERA`);

--
-- Indexes for table `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`CODIGO_CARRERA`),
  ADD KEY `FACULTAD` (`FACULTAD`);

--
-- Indexes for table `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`CODIGO_DOCENTE`);

--
-- Indexes for table `docente_asignatura`
--
ALTER TABLE `docente_asignatura`
  ADD PRIMARY KEY (`CODIGO_DOCENTE`,`CODIGO_ASIGNATURA`,`SEMESTRE`),
  ADD KEY `CODIGO_CARRERA` (`CODIGO_CARRERA`);

--
-- Indexes for table `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`CODIGO_FACULTAD`);

--
-- Indexes for table `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`CODIGO_MATRICULA`);

--
-- Indexes for table `menu_sistema`
--
ALTER TABLE `menu_sistema`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`CODIGO_ALUMNO`,`CODIGO_ASIGNATURA`,`SEMESTRE`),
  ADD KEY `CODIGO_ASIGNATURA` (`CODIGO_ASIGNATURA`);

--
-- Indexes for table `permisosmenu`
--
ALTER TABLE `permisosmenu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carreras`
--
ALTER TABLE `carreras`
  MODIFY `CODIGO_CARRERA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `docentes`
--
ALTER TABLE `docentes`
  MODIFY `CODIGO_DOCENTE` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `facultad`
--
ALTER TABLE `facultad`
  MODIFY `CODIGO_FACULTAD` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `CODIGO_MATRICULA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu_sistema`
--
ALTER TABLE `menu_sistema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permisosmenu`
--
ALTER TABLE `permisosmenu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumno_asignatura`
--
ALTER TABLE `alumno_asignatura`
  ADD CONSTRAINT `alumno_asignatura_ibfk_1` FOREIGN KEY (`CODIGO_MATRICULA`) REFERENCES `matriculas` (`CODIGO_MATRICULA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_asignatura_ibfk_2` FOREIGN KEY (`CODIGO_ALUMNO`) REFERENCES `alumnos` (`CODIGO_ALUMNO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_asignatura_ibfk_3` FOREIGN KEY (`CODIGO_ASIGNATURA`) REFERENCES `asignaturas` (`CODIGO_ASIGNATURA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`CODIGO_CARRERA`) REFERENCES `carreras` (`CODIGO_CARRERA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carreras`
--
ALTER TABLE `carreras`
  ADD CONSTRAINT `carreras_ibfk_1` FOREIGN KEY (`FACULTAD`) REFERENCES `facultad` (`CODIGO_FACULTAD`);

--
-- Constraints for table `docente_asignatura`
--
ALTER TABLE `docente_asignatura`
  ADD CONSTRAINT `docente_asignatura_ibfk_1` FOREIGN KEY (`CODIGO_DOCENTE`) REFERENCES `docentes` (`CODIGO_DOCENTE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `docente_asignatura_ibfk_2` FOREIGN KEY (`CODIGO_CARRERA`) REFERENCES `carreras` (`CODIGO_CARRERA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`CODIGO_ALUMNO`) REFERENCES `alumno_asignatura` (`CODIGO_ALUMNO`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`CODIGO_ASIGNATURA`) REFERENCES `alumno_asignatura` (`CODIGO_ASIGNATURA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
