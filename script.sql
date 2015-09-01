/*
SQLyog Trial v12.12 (32 bit)
MySQL - 5.6.24 : Database - dbnotasqr
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbnotasqr` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `dbnotasqr`;

/*Table structure for table `alumnos` */

DROP TABLE IF EXISTS `alumnos`;

CREATE TABLE `alumnos` (
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
  `TURNO` varchar(10) NOT NULL,
  PRIMARY KEY (`CODIGO_ALUMNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumnos` */

insert  into `alumnos`(`CODIGO_ALUMNO`,`NOMBRE_ALUMNO`,`APELLIDO_PATERNO`,`APELLIDO_MATERNO`,`EMAIL`,`TELEFONO`,`DIRECCION`,`SEXO`,`FECHA_NACIMIENTO`,`DNI`,`ANIO_INGRESO`,`SEMESTRE_INGRESO`,`CARRERA_PROFESIONAL`,`TURNO`) values ('','','','','','','',3,0,0,0,'','',''),('200921407F','kokok','JKSHDFKJ','KJSDKJSDJK','juan@perez.com','2345678','23456789',0,2345678,25678,2341,'2015-I','1','M'),('20112345-L','KSJDHFSD','JKSHDFKJ','KJSDKJSDJK','KJDFKJSDF','2345678','23456789',1,2345678,25678,2341,'2015-I','1','T');

/*Table structure for table `asignaturas` */

DROP TABLE IF EXISTS `asignaturas`;

CREATE TABLE `asignaturas` (
  `CODIGO_ASIGNATURA` varchar(8) CHARACTER SET utf8 NOT NULL,
  `NOMBRE_ASIGNATURA` varchar(30) CHARACTER SET utf8 NOT NULL,
  `CATEGORIA` varchar(10) CHARACTER SET utf8 NOT NULL,
  `CODIGO_CARRERA` int(11) NOT NULL,
  `HORAS` int(8) NOT NULL,
  `CREDITOS` int(8) NOT NULL,
  PRIMARY KEY (`CODIGO_ASIGNATURA`),
  KEY `CODIGO_CARRERA` (`CODIGO_CARRERA`),
  CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`CODIGO_CARRERA`) REFERENCES `carreras` (`CODIGO_CARRERA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `asignaturas` */

insert  into `asignaturas`(`CODIGO_ASIGNATURA`,`NOMBRE_ASIGNATURA`,`CATEGORIA`,`CODIGO_CARRERA`,`HORAS`,`CREDITOS`) values ('SI0001','PROGRAMACION I','REGULAR',1,4,4),('SI0002','PROGRAMACION II','REGULAR',1,4,4);

/*Table structure for table `carreras` */

DROP TABLE IF EXISTS `carreras`;

CREATE TABLE `carreras` (
  `CODIGO_CARRERA` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_CARRERA` varchar(255) NOT NULL,
  `FACULTAD` int(11) NOT NULL,
  PRIMARY KEY (`CODIGO_CARRERA`),
  KEY `FACULTAD` (`FACULTAD`),
  CONSTRAINT `carreras_ibfk_1` FOREIGN KEY (`FACULTAD`) REFERENCES `facultad` (`CODIGO_FACULTAD`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `carreras` */

insert  into `carreras`(`CODIGO_CARRERA`,`NOMBRE_CARRERA`,`FACULTAD`) values (1,'INGENIERIA DE SISTEMAS E INFORMÁTICA',1),(2,'CONTABILIDAD',2);

/*Table structure for table `curso_alumno` */

DROP TABLE IF EXISTS `curso_alumno`;

CREATE TABLE `curso_alumno` (
  `CODIGO_MATRICULA` int(11) NOT NULL,
  `CODIGO_ALUMNO` varchar(15) NOT NULL,
  `CODIGO_ASIGNATURA` varchar(8) NOT NULL,
  `SEMESTRE` varchar(10) NOT NULL,
  PRIMARY KEY (`CODIGO_MATRICULA`,`CODIGO_ALUMNO`,`CODIGO_ASIGNATURA`),
  CONSTRAINT `curso_alumno_ibfk_1` FOREIGN KEY (`CODIGO_MATRICULA`) REFERENCES `matriculas` (`CODIGO_MATRICULA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `curso_alumno` */

/*Table structure for table `docente_asignatura` */

DROP TABLE IF EXISTS `docente_asignatura`;

CREATE TABLE `docente_asignatura` (
  `CODIGO_DOCENTE` int(11) NOT NULL,
  `CODIGO_ASIGNATURA` varchar(8) NOT NULL,
  `SEMESTRE` varchar(10) NOT NULL,
  `CODIGO_CARRERA` int(11) NOT NULL,
  PRIMARY KEY (`CODIGO_DOCENTE`,`CODIGO_ASIGNATURA`,`SEMESTRE`),
  KEY `CODIGO_CARRERA` (`CODIGO_CARRERA`),
  CONSTRAINT `docente_asignatura_ibfk_1` FOREIGN KEY (`CODIGO_DOCENTE`) REFERENCES `docentes` (`CODIGO_DOCENTE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `docente_asignatura_ibfk_2` FOREIGN KEY (`CODIGO_CARRERA`) REFERENCES `carreras` (`CODIGO_CARRERA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `docente_asignatura` */

insert  into `docente_asignatura`(`CODIGO_DOCENTE`,`CODIGO_ASIGNATURA`,`SEMESTRE`,`CODIGO_CARRERA`) values (2,'SI0001','2015-0',1),(2,'SI0001','2015-I',1),(2,'SI0002','2015-0',1),(2,'SI0002','2015-I',1);

/*Table structure for table `docentes` */

DROP TABLE IF EXISTS `docentes`;

CREATE TABLE `docentes` (
  `CODIGO_DOCENTE` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_DOCENTE` varchar(30) CHARACTER SET utf8 NOT NULL,
  `AP_DOCENTE` varchar(30) CHARACTER SET utf8 NOT NULL,
  `AM_DOCENTE` varchar(30) CHARACTER SET utf8 NOT NULL,
  `DIRECCION` varchar(30) CHARACTER SET utf8 NOT NULL,
  `TELEFONO` int(11) NOT NULL,
  `SEXO` varchar(30) CHARACTER SET utf8 NOT NULL,
  `DNI` int(11) NOT NULL,
  `EMAIL` varchar(30) CHARACTER SET utf8 NOT NULL,
  `FECHA_INGRESO` int(11) NOT NULL,
  PRIMARY KEY (`CODIGO_DOCENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `docentes` */

insert  into `docentes`(`CODIGO_DOCENTE`,`NOMBRE_DOCENTE`,`AP_DOCENTE`,`AM_DOCENTE`,`DIRECCION`,`TELEFONO`,`SEXO`,`DNI`,`EMAIL`,`FECHA_INGRESO`) values (2,'Juan','Gomez','Perez','su casa',4567890,'Z',42151627,'jossaa',34567890);

/*Table structure for table `facultad` */

DROP TABLE IF EXISTS `facultad`;

CREATE TABLE `facultad` (
  `CODIGO_FACULTAD` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_FACULTAD` varchar(255) NOT NULL,
  PRIMARY KEY (`CODIGO_FACULTAD`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `facultad` */

insert  into `facultad`(`CODIGO_FACULTAD`,`NOMBRE_FACULTAD`) values (1,'INGENIERIA'),(2,'CIENCIAS CONTABLES Y FINANCIERAS');

/*Table structure for table `matriculas` */

DROP TABLE IF EXISTS `matriculas`;

CREATE TABLE `matriculas` (
  `CODIGO_MATRICULA` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_ALUMNO` varchar(15) DEFAULT NULL,
  `FECHA_MATRICULA` int(11) DEFAULT NULL,
  `CODIGO_CARRERA` int(11) DEFAULT NULL,
  PRIMARY KEY (`CODIGO_MATRICULA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `matriculas` */

/*Table structure for table `menu_sistema` */

DROP TABLE IF EXISTS `menu_sistema`;

CREATE TABLE `menu_sistema` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` varchar(50) NOT NULL,
  `IMAGEN` varchar(50) NOT NULL DEFAULT 'imagenes/not_found.png',
  `URL` varchar(50) DEFAULT NULL,
  `ORDENAMIENTO` int(11) NOT NULL DEFAULT '0',
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `menu_sistema` */

insert  into `menu_sistema`(`ID`,`DESCRIPCION`,`IMAGEN`,`URL`,`ORDENAMIENTO`,`ESTATUS`) values (1,'Inicio','imagenes/Customer.png','#',1,0),(2,'Agregar Usuarios','imagenes/Proveedores.png','/usuarios/nuevo',3,0),(3,'Listar Usuarios','imagenes/Product.png','/usuarios',2,0);

/*Table structure for table `notas` */

DROP TABLE IF EXISTS `notas`;

CREATE TABLE `notas` (
  `CODIGO_NOTA` int(11) NOT NULL,
  `CODIGO_ALUMNO` varchar(15) CHARACTER SET utf8 NOT NULL,
  `CODIGO_ASIGNATURA` varchar(8) CHARACTER SET utf8 NOT NULL,
  `PRIMER_PARCIAL` decimal(10,0) NOT NULL,
  `SEGUNDA_PARCIAL` decimal(10,0) NOT NULL,
  `NOTA_FINAL` decimal(10,0) NOT NULL,
  `FECHA_ING_NOTAS` int(11) NOT NULL,
  `SEMESTRE` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `notas` */

/*Table structure for table `permisosmenu` */

DROP TABLE IF EXISTS `permisosmenu`;

CREATE TABLE `permisosmenu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_MENU` int(11) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `permisosmenu` */

insert  into `permisosmenu`(`ID`,`ID_USUARIO`,`ID_MENU`,`ESTATUS`) values (1,1,1,0),(2,1,2,0),(3,1,3,0),(5,2,1,0),(6,2,3,0),(7,2,2,1);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `FECHA_REGISTRO` varchar(20) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  `TIPO` varchar(20) NOT NULL DEFAULT 'Invitado',
  `PASSWORD` varchar(50) DEFAULT '123',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`ID`,`NOMBRE`,`APELLIDOS`,`EMAIL`,`FECHA_REGISTRO`,`ESTATUS`,`TIPO`,`PASSWORD`) values (1,'Juan','Perezsasdasd','elcapo@programando.com','2014-07-30 14:39:06',0,'Administrador','81dc9bdb52d04dc20036dbd8313ed055 '),(2,'Maria','Cortes Crisanto','crisant_89@hotmail.com','2014-07-30 14:39:06',0,'Invitado','263bce650e68ab4e23f28263760b9fa5');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
