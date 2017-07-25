/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.1.16-MariaDB : Database - joyerias
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`joyerias` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `joyerias`;

/*Table structure for table `abonocp` */

DROP TABLE IF EXISTS `abonocp`;

CREATE TABLE `abonocp` (
  `idabonocp` int(255) NOT NULL AUTO_INCREMENT,
  `idcuenta` int(255) NOT NULL,
  `cantidadabono` int(255) NOT NULL,
  `fechaabono` varchar(255) NOT NULL,
  PRIMARY KEY (`idabonocp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `abonocp` */

insert  into `abonocp`(`idabonocp`,`idcuenta`,`cantidadabono`,`fechaabono`) values 
(1,1,1000,'12 enero 2017'),
(2,2,2000,'12 febrero 2017');

/*Table structure for table `abonoscc` */

DROP TABLE IF EXISTS `abonoscc`;

CREATE TABLE `abonoscc` (
  `idabonos` int(255) NOT NULL AUTO_INCREMENT,
  `idcuentacobrar` int(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `cantidad` int(255) NOT NULL,
  PRIMARY KEY (`idabonos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `abonoscc` */

insert  into `abonoscc`(`idabonos`,`idcuentacobrar`,`fecha`,`cantidad`) values 
(1,1,'12 enero 2017',200),
(2,2,'20 marzo 2017',100);

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `idcliente` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `rcf1` varchar(255) NOT NULL,
  `telefonocasa` varchar(255) NOT NULL,
  `telefonocel` varchar(255) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

/*Table structure for table `compra` */

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `idcompra` int(100) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(80) NOT NULL,
  `idproveedores` int(100) NOT NULL,
  `tipodepago` int(30) NOT NULL,
  `idempleado` int(100) NOT NULL,
  PRIMARY KEY (`idcompra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `compra` */

/*Table structure for table `cuentacobrar` */

DROP TABLE IF EXISTS `cuentacobrar`;

CREATE TABLE `cuentacobrar` (
  `idcuentacobrar` int(255) NOT NULL AUTO_INCREMENT,
  `idventa` int(255) NOT NULL,
  `fechaven` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  `abonos` int(255) NOT NULL,
  PRIMARY KEY (`idcuentacobrar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuentacobrar` */

/*Table structure for table `cuentapagar` */

DROP TABLE IF EXISTS `cuentapagar`;

CREATE TABLE `cuentapagar` (
  `idcuentapagar` int(255) NOT NULL AUTO_INCREMENT,
  `idcompra` int(255) NOT NULL,
  `fechaven` varchar(255) NOT NULL,
  `total` int(255) NOT NULL,
  PRIMARY KEY (`idcuentapagar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cuentapagar` */

/*Table structure for table `detallecompra` */

DROP TABLE IF EXISTS `detallecompra`;

CREATE TABLE `detallecompra` (
  `iddetalle` int(25) NOT NULL AUTO_INCREMENT,
  `idcompras` int(100) NOT NULL,
  `idproducto` int(100) NOT NULL,
  `cantidad` int(255) NOT NULL,
  `preciocosto` int(255) NOT NULL,
  PRIMARY KEY (`iddetalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detallecompra` */

/*Table structure for table `detalleventa` */

DROP TABLE IF EXISTS `detalleventa`;

CREATE TABLE `detalleventa` (
  `iddetalleventa` int(34) NOT NULL AUTO_INCREMENT,
  `idventa` int(34) NOT NULL,
  `idproducto` int(34) NOT NULL,
  `precioventa` int(45) NOT NULL,
  `cantidad` int(46) NOT NULL,
  `preciocosto` int(50) NOT NULL,
  PRIMARY KEY (`iddetalleventa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detalleventa` */

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `idempleado` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `numempreado` int(10) NOT NULL,
  `domicilio` varchar(78) NOT NULL,
  `telefonocasa` int(8) NOT NULL,
  `fechaingreso` varchar(56) NOT NULL,
  `puesto` varchar(56) NOT NULL,
  `sueldo` int(56) NOT NULL,
  PRIMARY KEY (`idempleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `empleados` */

/*Table structure for table `lineas` */

DROP TABLE IF EXISTS `lineas`;

CREATE TABLE `lineas` (
  `idlineas` int(255) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idlineas`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `lineas` */

insert  into `lineas`(`idlineas`,`descripcion`) values 
(1,'Relojes'),
(2,'Anillos'),
(3,'Pulseras'),
(4,'aretes'),
(5,'collares'),
(6,'esclavas'),
(7,'juegos'),
(8,'estensibles'),
(9,'pilas'),
(10,'coquetas'),
(11,'argollas'),
(12,'anillos en general'),
(13,'pulceras'),
(14,'medallas en general'),
(15,'crucifijos'),
(16,'caja regalo');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idproductos` int(255) NOT NULL AUTO_INCREMENT,
  `idlinea` int(11) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `precioventa` float NOT NULL,
  `stackmax` int(255) NOT NULL,
  `stackmin` int(255) NOT NULL,
  PRIMARY KEY (`idproductos`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`idproductos`,`idlinea`,`descripcion`,`marca`,`precio`,`precioventa`,`stackmax`,`stackmin`) values 
(1,5,'modeloX','CASIO',50,100,50,10),
(2,1,'modeloX2','CASIO',50,100,50,10),
(3,1,'modeloX','asus',10,50,50,10),
(4,1,'ModeloX3','asd',45,45,10,10),
(5,3,'asda','asd',40,40,70,40),
(6,3,'otro','asd',5,5,5,5),
(7,1,'mujer ','casio ',50,120,20,10),
(8,5,'guchi','95',100,200,20,10);

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `idproveedores` int(45) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) NOT NULL,
  `domicilio` varchar(90) NOT NULL,
  `telefono` int(90) NOT NULL,
  `empresa` varchar(90) NOT NULL,
  `status` varchar(90) NOT NULL,
  PRIMARY KEY (`idproveedores`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proveedores` */

/*Table structure for table `tipodepago` */

DROP TABLE IF EXISTS `tipodepago`;

CREATE TABLE `tipodepago` (
  `idtipo` int(100) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tipodepago` */

insert  into `tipodepago`(`idtipo`,`descripcion`) values 
(1,'contado'),
(2,'credito'),
(3,'contado'),
(4,'credito');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` int(100) NOT NULL AUTO_INCREMENT,
  `idempleado` int(15) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `tipodecuenta` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`idusuario`,`idempleado`,`usuario`,`tipodecuenta`,`password`,`status`) values 
(1,1,'jimmy','admin','123',1);

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `idventa` int(45) NOT NULL AUTO_INCREMENT,
  `idempleado` int(45) NOT NULL,
  `fecha` varchar(56) NOT NULL,
  `tipopago` int(23) NOT NULL,
  `idclientes` int(23) NOT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ventas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
