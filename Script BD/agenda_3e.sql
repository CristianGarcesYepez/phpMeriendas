/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - agenda_3e
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`agenda_3e` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `agenda_3e`;

/*Table structure for table `actividad` */

DROP TABLE IF EXISTS `actividad`;

CREATE TABLE `actividad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fec_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fec_actualizacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `actividad` */

insert  into `actividad`(`id`,`nombre`,`descripcion`,`fec_creacion`,`fec_actualizacion`) values 
(1,'Levantarme Temprano','Salir de la cama a la 5am','2025-02-03 00:02:50','2025-02-03 00:02:50'),
(2,'Desayuno','Tomar Desayuno Continental.','2025-02-03 00:04:19','2025-02-03 00:04:19'),
(5,'Dormir la siesta','Descansar al medio día.','2025-02-03 00:56:32','0000-00-00 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
