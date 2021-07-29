/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.19-MariaDB : Database - db_simpertanian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simpertanian` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_simpertanian`;

/*Table structure for table `table_anggota` */

DROP TABLE IF EXISTS `table_anggota`;

CREATE TABLE `table_anggota` (
  `anggota_id` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_nama` varchar(100) DEFAULT NULL,
  `anggota_jabatan` varchar(100) DEFAULT NULL,
  `anggota_nik` varchar(100) DEFAULT NULL,
  `anggota_jenkel` varchar(10) DEFAULT NULL,
  `anggota_kelompok` int(11) DEFAULT NULL,
  PRIMARY KEY (`anggota_id`),
  KEY `anggota_kelompok` (`anggota_kelompok`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `table_anggota` */

insert  into `table_anggota`(`anggota_id`,`anggota_nama`,`anggota_jabatan`,`anggota_nik`,`anggota_jenkel`,`anggota_kelompok`) values 
(6,'Eri','Ketua','18378787429','Laki-laki',4),
(7,'Puan','Bendahara','18378787428','Laki-laki',4),
(8,'Rusdi','Ketua','18378787426','Laki-laki',7);

/*Table structure for table `table_bantuan` */

DROP TABLE IF EXISTS `table_bantuan`;

CREATE TABLE `table_bantuan` (
  `bantuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `bantuan_tanggal` date DEFAULT NULL,
  `bantuan_nama` varchar(255) DEFAULT NULL,
  `bantuan_qty` int(11) DEFAULT NULL,
  `bantuan_keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bantuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `table_bantuan` */

insert  into `table_bantuan`(`bantuan_id`,`bantuan_tanggal`,`bantuan_nama`,`bantuan_qty`,`bantuan_keterangan`) values 
(1,'2021-07-23','Mesin',1,'Sudah diterima'),
(2,'2021-07-26','Alat berat',2,'Sudah diterima');

/*Table structure for table `table_hasil` */

DROP TABLE IF EXISTS `table_hasil`;

CREATE TABLE `table_hasil` (
  `hasil_id` int(11) NOT NULL AUTO_INCREMENT,
  `hasil_pelatihan` int(11) DEFAULT NULL,
  `hasil_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`hasil_id`),
  KEY `hasil_pelatihan` (`hasil_pelatihan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `table_hasil` */

insert  into `table_hasil`(`hasil_id`,`hasil_pelatihan`,`hasil_status`) values 
(7,4,'Terlaksana'),
(8,7,'Batal');

/*Table structure for table `table_kecamatan` */

DROP TABLE IF EXISTS `table_kecamatan`;

CREATE TABLE `table_kecamatan` (
  `kecamatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kecamatan_nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kecamatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `table_kecamatan` */

insert  into `table_kecamatan`(`kecamatan_id`,`kecamatan_nama`) values 
(1,'Bungus Teluk Kabung'),
(2,'Koto Tangah'),
(3,'Kuranji'),
(4,'Lubuk Begalung'),
(5,'Lubuk Kilangan'),
(6,'Nanggalo'),
(7,'Padang Barat'),
(8,'Padang Selatan'),
(9,'Padang Timur'),
(10,'Padang Utara'),
(11,'Pauh');

/*Table structure for table `table_kelompok` */

DROP TABLE IF EXISTS `table_kelompok`;

CREATE TABLE `table_kelompok` (
  `kelompok_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelompok_nama` varchar(100) DEFAULT NULL,
  `kelompok_kecamatan` int(11) DEFAULT NULL,
  `kelompok_kelurahan` int(11) DEFAULT NULL,
  `kelompok_keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kelompok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `table_kelompok` */

insert  into `table_kelompok`(`kelompok_id`,`kelompok_nama`,`kelompok_kecamatan`,`kelompok_kelurahan`,`kelompok_keterangan`) values 
(4,'Gajah Mada',7,58,'Tidak Aktif'),
(7,'Lunox',10,89,'Aktif'),
(8,'Bactrack',2,17,'Tidak Aktif'),
(9,'Gloo',2,16,'Aktif'),
(10,'Belerick',7,58,'Aktif');

/*Table structure for table `table_kelurahan` */

DROP TABLE IF EXISTS `table_kelurahan`;

CREATE TABLE `table_kelurahan` (
  `kelurahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelurahan_nama` varchar(100) DEFAULT NULL,
  `kelurahan_kecamatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`kelurahan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

/*Data for the table `table_kelurahan` */

insert  into `table_kelurahan`(`kelurahan_id`,`kelurahan_nama`,`kelurahan_kecamatan`) values 
(1,'Bungus Barat',1),
(2,'Bungus Selatan',1),
(3,'Bungus Timur',1),
(4,'Teluk Kabung Selatan',1),
(5,'Teluk Kabung Tengah',1),
(6,'Teluk Kabung Utara',1),
(7,'Air Pacah',2),
(8,'Balai Gadang',2),
(9,'Batang Kabung Ganting',2),
(10,'Batipuh Panjang',2),
(11,'Bungo Pasang',2),
(12,'Dadok Tunggul Hitam',2),
(13,'Koto Panjang Ikua Koto',2),
(14,'Koto Pulai',2),
(15,'Lubuk Buaya',2),
(16,'Lubuk Minturun',2),
(17,'Padang Sarai',2),
(18,'Parupuk Tabing',2),
(19,'Pasir Nan Tigo',2),
(20,'Ampang',3),
(21,'Anduring',3),
(22,'Gunung Sarik',3),
(23,'Kalumpuk',3),
(24,'Korong Gadang',3),
(25,'Kuranji',3),
(26,'Lubuk Lintah',3),
(27,'Pasar Ambacang',3),
(28,'Sungai Sapih',3),
(29,'Banuaran Nan XX',4),
(30,'Batung Taba Nan XX',4),
(31,'Cengkeh Nan XX',4),
(32,'Gates Nan XX',4),
(33,'Gurun Laweh Nan XX',4),
(34,'Kampung Baru Nan XX',4),
(35,'Kampung Jua Nan XX',4),
(36,'Koto Baru Nan XX',4),
(37,'Lubuk Begalung Nan XX',4),
(38,'Pagambiran Ampalu Nan XX',4),
(39,'Pampangan Nan XX',4),
(40,'Parak Laweh Pulau Air Nan XX',4),
(41,'Pitameh Tanjung Saba Nan XX',4),
(42,'Tanah Sirah Piai Nan XX',4),
(43,'Tanjung Aur Nan XX',4),
(44,'Bandar Buat',5),
(45,'Batu Gadang',5),
(46,'Beringin',5),
(47,'Indarung',5),
(48,'Koto Lalang',5),
(49,'Padang Besi',5),
(50,'Tarantang',5),
(51,'Gurun Laweh',6),
(52,'Kampung Lapai',6),
(53,'Kampung Olo',6),
(54,'Kurao Pagang',6),
(55,'Surau Gadang',6),
(56,'Tabing Banda Gadang',6),
(57,'Belakang Tangsi',7),
(58,'Berok Nipah',7),
(59,'Flamboyan Baru',7),
(60,'Kampung Jao',7),
(61,'Kampung Pondok',7),
(62,'Olo',7),
(63,'Padang Pasir',7),
(64,'Purus',7),
(65,'Rimbo Kaluang',7),
(66,'Ujung Gurun',7),
(67,'Air Manis',8),
(68,'Alang Laweh',8),
(69,'Batang Arau',8),
(70,'Belakang Pondok',8),
(71,'Bukit Gado-Gado',8),
(72,'Mato Aie',8),
(73,'Pasa Gadang',8),
(74,'Ranah Parak Rumbio',8),
(75,'Rawang',8),
(76,'Seberang Padang',8),
(77,'Seberang Palinggam',8),
(78,'Teluk Bayur',8),
(79,'Andalas',9),
(80,'Ganting Parak Gadang',9),
(81,'Jati',9),
(82,'Jati Baru',9),
(83,'Kubu Dalam Parak Karakah',9),
(84,'Kubu Marapalam',9),
(85,'Parak Gadang Timur',9),
(86,'Sawahan',9),
(87,'Sawahan Timur',9),
(88,'Simpang Haru',9),
(89,'Air Tawar Barat',10),
(90,'Air Tawar Timur',10),
(91,'Alai Parak Kopi',10),
(92,'Gunung Pangilun',10),
(93,'Lolong Belanti',10),
(94,'Ulak Karang Selatan',10),
(95,'Ulak Karang Utara',10),
(96,'Binuang Kampuang Dalam',11),
(97,'Cupak Tangah',11),
(98,'Kapalo Koto',11),
(99,'Koto Luar',11),
(100,'Lambung Bukit',11),
(101,'Limau Manis',11),
(102,'Limau Manis Selatan',11),
(103,'Piai Tangah',11),
(104,'Pisang',11);

/*Table structure for table `table_lahan` */

DROP TABLE IF EXISTS `table_lahan`;

CREATE TABLE `table_lahan` (
  `lahan_id` int(11) NOT NULL AUTO_INCREMENT,
  `lahan_kecamatan` int(11) DEFAULT NULL,
  `lahan_kelurahan` int(11) DEFAULT NULL,
  `lahan_luas` int(11) DEFAULT NULL,
  `lahan_luas_kosong` int(11) DEFAULT NULL,
  PRIMARY KEY (`lahan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `table_lahan` */

insert  into `table_lahan`(`lahan_id`,`lahan_kecamatan`,`lahan_kelurahan`,`lahan_luas`,`lahan_luas_kosong`) values 
(2,7,58,10,7),
(3,5,48,12,10),
(6,7,1,10,2);

/*Table structure for table `table_pelatihan` */

DROP TABLE IF EXISTS `table_pelatihan`;

CREATE TABLE `table_pelatihan` (
  `pelatihan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelatihan_tanggal` date DEFAULT NULL,
  `pelatihan_kecamatan` varchar(100) DEFAULT NULL,
  `pelatihan_kelurahan` varchar(100) DEFAULT NULL,
  `pelatihan_agenda` varchar(255) DEFAULT NULL,
  `pelatihan_hasil` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pelatihan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `table_pelatihan` */

insert  into `table_pelatihan`(`pelatihan_id`,`pelatihan_tanggal`,`pelatihan_kecamatan`,`pelatihan_kelurahan`,`pelatihan_agenda`,`pelatihan_hasil`) values 
(4,'2021-07-26','10','91','Seminar Kewirausahaan','Terlaksana'),
(7,'2021-07-28','11','103','Seminar Pengelolaan Limbah','Batal');

/*Table structure for table `table_penerima` */

DROP TABLE IF EXISTS `table_penerima`;

CREATE TABLE `table_penerima` (
  `penerima_id` int(11) NOT NULL AUTO_INCREMENT,
  `penerima_kelompok` int(11) DEFAULT NULL,
  `penerima_bantuan` int(11) DEFAULT NULL,
  `penerima_qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`penerima_id`),
  KEY `penerima_kelompok` (`penerima_kelompok`),
  KEY `penerima_bantuan` (`penerima_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `table_penerima` */

insert  into `table_penerima`(`penerima_id`,`penerima_kelompok`,`penerima_bantuan`,`penerima_qty`) values 
(2,4,1,1),
(7,7,2,1),
(8,8,2,1);

/*Table structure for table `table_user` */

DROP TABLE IF EXISTS `table_user`;

CREATE TABLE `table_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_level` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `table_user` */

insert  into `table_user`(`user_id`,`user_email`,`user_name`,`user_password`,`user_level`) values 
(2,'adminsatu@gmail.com','Admin Satu','$2y$10$iKOHQWNuTlWjBTlr7vsEr.daTYZNGpSBQCc7XqtalJVkZHa2Gc6Pi',1),
(4,'superadmin@gmail.com','Super Admin','$2y$10$FPiOM0siebKzJ7x2ldqQWuI5ipxWqfhPjLhSawPU86OvZ.rtT.Nhy',0),
(6,'kelompoktani@gmail.com','Kelompok Tani ','$2y$10$x8IBVDKkjsGSv8QbiPWl1.sNTdLfBPctNS.B34qBrJzqa05CXcjKC',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
