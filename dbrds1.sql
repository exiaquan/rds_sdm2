/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.1.72-community : Database - rds1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rds1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rds1`;

/*Table structure for table `akun_bank` */

DROP TABLE IF EXISTS `akun_bank`;

CREATE TABLE `akun_bank` (
  `id_akun` bigint(5) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(4) DEFAULT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL,
  `departemen` varchar(8) DEFAULT NULL,
  `divisi` varchar(20) DEFAULT NULL,
  `no_rekening` varchar(15) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `nama_akun` varchar(100) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_akun`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `akun_bank` */

insert  into `akun_bank`(`id_akun`,`id_pegawai`,`nama_pegawai`,`departemen`,`divisi`,`no_rekening`,`nama_bank`,`nama_akun`,`keterangan`) values 
(1,1200,'BERNADETE SEPTIANA','ALZ','SPV','2460603440','BANK BCA','BERNADETE SEPTIANA KURNIA SARI','bank pertama sejak masuk');

/*Table structure for table `departemen` */

DROP TABLE IF EXISTS `departemen`;

CREATE TABLE `departemen` (
  `id_departemen` varchar(3) NOT NULL,
  `departemen` varchar(100) DEFAULT NULL,
  `kpl_departemen` varchar(255) DEFAULT NULL,
  `divisi` varchar(10) DEFAULT NULL,
  `shift` varchar(5) NOT NULL,
  PRIMARY KEY (`id_departemen`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `departemen` */

insert  into `departemen`(`id_departemen`,`departemen`,`kpl_departemen`,`divisi`,`shift`) values 
('ALZ','ALLIANZ','SELA DAMIRIA','INDEXING',''),
('PHS','PRUDENTIAL PHS','DIAH AYU','INDEXING',''),
('PNB','PRUDENTIAL NB','PUNGKY PUTRA','INDEXING',''),
('BNC','BANK NEO COMMERCE','DEVI RATNA','INDEXING',''),
('RDS','STAFF RDS','JAJANG NURJAMAN','MANAGER',''),
('UNA','UNAKI','BERN','COBA','');

/*Table structure for table `gaji` */

DROP TABLE IF EXISTS `gaji`;

CREATE TABLE `gaji` (
  `kode_slip_gaji` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(4) DEFAULT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `departemen` varchar(20) DEFAULT NULL,
  `penunjukan` varchar(30) DEFAULT NULL,
  `tgl1` date DEFAULT NULL COMMENT 'tgl absen',
  `tgl2` date DEFAULT NULL COMMENT 'tgl absen',
  `jml_hari_kerja` double DEFAULT '0',
  `jml_hari_tdkmsk` double DEFAULT '0',
  `gaji_pokok` double DEFAULT '0',
  `gaji_tunjangan` double DEFAULT '0',
  `gaji_lembur` double DEFAULT '0',
  `jamsostek` double DEFAULT '0',
  `potongan_absensi` double DEFAULT '0',
  `potongan_terlambat` double DEFAULT '0',
  `pajak_penghasilan` double DEFAULT '0',
  `total_potongan` double DEFAULT '0',
  `gaji_bersih_sebelum_potongan` double DEFAULT '0',
  `total_gaji_diterima` double DEFAULT '0',
  PRIMARY KEY (`kode_slip_gaji`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `gaji` */

/*Table structure for table `ijin_cuti` */

DROP TABLE IF EXISTS `ijin_cuti`;

CREATE TABLE `ijin_cuti` (
  `kode_perijinan` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(4) DEFAULT NULL,
  `nama_pegawai` varchar(50) DEFAULT NULL,
  `departemen` varchar(10) DEFAULT NULL,
  `penunjukan` varchar(20) DEFAULT NULL,
  `keterangan_ijin` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `sisa_cuti` int(2) DEFAULT NULL,
  `alasan` text,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_perijinan`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `ijin_cuti` */

insert  into `ijin_cuti`(`kode_perijinan`,`id_pegawai`,`nama_pegawai`,`departemen`,`penunjukan`,`keterangan_ijin`,`tgl_mulai`,`tgl_akhir`,`durasi`,`sisa_cuti`,`alasan`,`file`) values 
(2,1200,'BERNADETE SEPTIANA','ALZ','SPV','PENELITIAN','2023-03-21','2023-03-23',3,NULL,NULL,'contoh_kehadiran.xlsx'),
(3,1203,'BERNADETE KURNIA','ALZ','SPV','UJIAN','2023-03-04','2023-03-04',1,NULL,NULL,NULL),
(4,1200,'BERNADETE SEPTIANA','ALZ','SPV','FSAA','2023-03-01','2023-03-09',9,NULL,NULL,''),
(5,1200,'BERNADETE SEPTIANA','ALZ','SPV','ADASASDD','2023-03-03','2023-03-18',16,NULL,NULL,''),
(6,1200,'BERNADETE SEPTIANA','ALZ','SPV','DASDAS','2023-03-10','2023-04-01',23,NULL,NULL,''),
(7,1200,'BERNADETE SEPTIANA','ALZ','SPV','RQWRQW','2023-03-15','2023-03-30',16,NULL,NULL,''),
(8,1200,'BERNADETE SEPTIANA','ALZ','SPV','FASFAF','2023-03-08','2023-02-28',9,NULL,NULL,''),
(9,1200,'BERNADETE SEPTIANA','ALZ','SPV','ZXCZXCZXCZXC','2023-03-01','2023-03-01',1,NULL,NULL,''),
(10,1202,'SARI','RDS','IT','KJBJKLHKJHJKHJKHJKHJKHH','2023-03-03','2023-03-03',1,NULL,NULL,'DOC-20230221-WA0001.-6.pdf');

/*Table structure for table `kehadiran` */

DROP TABLE IF EXISTS `kehadiran`;

CREATE TABLE `kehadiran` (
  `id_pegawai` char(4) DEFAULT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `status_kehadiran` varchar(20) DEFAULT NULL,
  `waktu_kehadiran` date DEFAULT NULL,
  `masuk` varchar(5) DEFAULT '00:00',
  `keluar` varchar(5) DEFAULT '00:00',
  `terlambat` double DEFAULT '0',
  `status_perijinan` varchar(5) DEFAULT NULL,
  `shift` varchar(5) DEFAULT NULL,
  `status_masuk` int(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `kehadiran` */

insert  into `kehadiran`(`id_pegawai`,`nama_pegawai`,`status_kehadiran`,`waktu_kehadiran`,`masuk`,`keluar`,`terlambat`,`status_perijinan`,`shift`,`status_masuk`) values 
('1202','SARI','HADIR','2022-02-01','08:45','17:00',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-02','08:57','17:04',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-03','08:40','17:01',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-06','08:35','17:05',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-07','08:20','17:06',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-08','08:49','17:10',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-09','08:34','17:32',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-10','08:33','17:20',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-13','08:31','17:16',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-14','08:30','17:15',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-15','08:55','17:08',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-16','09:00','17:11',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-17','08:48','17:01',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-20','08:00','17:21',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-21','09:01','17:25',1,'','pagi',1),
('1202','SARI','HADIR','2022-02-22','08:57','17:00',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-23','08:50','17:14',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-24','08:53','17:17',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-26','08:27','17:19',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-27','08:58','17:04',0,'','pagi',1),
('1202','SARI','HADIR','2022-02-28','09:02','17:03',1,'','pagi',1);

/*Table structure for table `klien` */

DROP TABLE IF EXISTS `klien`;

CREATE TABLE `klien` (
  `id_klien` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_departemen` varchar(3) DEFAULT NULL,
  `nama_departemen` varchar(100) DEFAULT NULL,
  `nama_klien` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` text,
  PRIMARY KEY (`id_klien`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `klien` */

insert  into `klien`(`id_klien`,`id_departemen`,`nama_departemen`,`nama_klien`,`telepon`,`email`,`website`) values 
(1,'ALZ','ALLIANZ','RIAN SATRIA','081238173555','RIAN.SATRIA@PRU.PHS.COM','WWW.PRUDENTIAL.COM'),
(4,'PHS','PRUDENTIAL PHS','SURONO SUGIMIN','0183264286321','SURONO@GMAIL.COM','WWW.PRUDENTIAL.COM');

/*Table structure for table `lembur` */

DROP TABLE IF EXISTS `lembur`;

CREATE TABLE `lembur` (
  `kode_lembur` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(4) DEFAULT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL,
  `departemen` varchar(10) DEFAULT NULL,
  `penunjukan` varchar(50) DEFAULT NULL,
  `tgl_lembur` date DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`kode_lembur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `lembur` */

insert  into `lembur`(`kode_lembur`,`id_pegawai`,`nama_pegawai`,`departemen`,`penunjukan`,`tgl_lembur`,`keterangan`) values 
(1,1200,'BERNADETE SEPTIANA','ALZ','SPV','2023-03-25','LEMBUR BULAN FEBRUARI'),
(2,1200,'BERNADETE SEPTIANA','ALZ','SPV','2023-03-25','LEMBUR HARI SABTTU'),
(3,1202,'SARI','RDS','IT','2023-04-01','DINAS');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id_pegawai` char(4) NOT NULL,
  `nama_pegawai` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `hak_akses` char(1) DEFAULT '3' COMMENT '0=hrd,1=manajer,2=pegawai,3=null'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`id_pegawai`,`nama_pegawai`,`username`,`pass`,`hak_akses`) values 
('0001','superuser','superuser','superuser','0'),
('1201','KURNIA','kurnia','kurnia','2'),
('1202','SARI','sari','sari','1'),
('1203','BERNADETE KURNIA','1234','1234','2');

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(4) NOT NULL,
  `nama_pegawai` varchar(50) DEFAULT NULL,
  `jns_kel_pegawai` varchar(15) DEFAULT NULL,
  `tmp_lhr_pegawai` varchar(10) DEFAULT NULL,
  `tgl_lhr_pegawai` date DEFAULT NULL,
  `agama_pegawai` varchar(8) DEFAULT NULL,
  `status_pegawai` varchar(13) DEFAULT NULL,
  `pendidikan_pegawai` varchar(50) DEFAULT NULL,
  `alamat_pegawai` varchar(255) DEFAULT NULL,
  `no_telefon` varchar(15) NOT NULL,
  `nama_departemen` varchar(20) DEFAULT NULL,
  `id_departemen` varchar(3) DEFAULT NULL,
  `penunjukan` varchar(20) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `jatah_cuti` double DEFAULT '12',
  PRIMARY KEY (`id_pegawai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pegawai` */

insert  into `pegawai`(`id_pegawai`,`nama_pegawai`,`jns_kel_pegawai`,`tmp_lhr_pegawai`,`tgl_lhr_pegawai`,`agama_pegawai`,`status_pegawai`,`pendidikan_pegawai`,`alamat_pegawai`,`no_telefon`,`nama_departemen`,`id_departemen`,`penunjukan`,`file`,`jatah_cuti`) values 
('1200','BERNADETE SEPTIANA','WANITA','SEMARANG','2023-03-01','KATOLIK','BELUM MENIKAH','SMA/SMK','BROTOJOYO','','ALLIANZ','ALZ','SPV','use_case_revisi_skripsi.pdf.png',-65),
('1201','KURNIA','PRIA','SEMARANG','2023-03-23','KATOLIK','MENIKAH','D3','INDRAPRASTA','','PRUDENTIAL PHS','PHS','OPT1','contoh_kehadiran.xlsx',11),
('1202','SARI','WANITA','JAKARTA','2019-01-29','HINDU','BELUM MENIKAH','SMA/SMK','SINI','','STAFF RDS','RDS','IT','2064-5729-1-SP_(1).docx',11),
('1203','BERNADETE KURNIA','WANITA','SEMARANG','1998-09-27','KATOLIK','BELUM MENIKAH','SMA/SMK','SEMARANG','','ALLIANZ','ALZ','SPV','2022-06-22.jpg',11);

/*Table structure for table `penunjukan` */

DROP TABLE IF EXISTS `penunjukan`;

CREATE TABLE `penunjukan` (
  `kode_penunjukan` varchar(4) NOT NULL,
  `id_departemen` varchar(3) DEFAULT NULL,
  `departemen` varchar(15) DEFAULT NULL,
  `penunjukan` varchar(20) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`kode_penunjukan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `penunjukan` */

insert  into `penunjukan`(`kode_penunjukan`,`id_departemen`,`departemen`,`penunjukan`,`keterangan`) values 
('SPV','ALZ','ALLIANZ','SPV.INDEX','SUPERVISOR INDEXING DEPARTEMEN ALLIANZ'),
('SPV1','PHS','PRUDENTIAL PHS','SPV.INDEX','SUPERVISOR INDEXING DEPARTEMEN PRUDENTIAL PHS'),
('SPV2','PHS','PRUDENTIAL PHS','SPV.CAPTURE','SUPERVISOR CAPTURE DEPARTEMEN PRUDENTIAL PHS'),
('SPV3','PNB','PRUDENTIAL NB','SPV.INDEX','SUPERVISOR INDEXING DEPARTEMEN PRUDENTIAL NEW BUSINESS'),
('SPV4','PNB','PRUDENTIAL NB','SPV.CAPTURE','SUPERVISOR CAPTURE DEPARTEMEN PRUDENTIAL NEW BUSINESS'),
('SPV5','BNC','BANK NEO COMMER','SPV.ALL','SUPERVISOR DEPARTEMEN SEMUA DIVISI BANK NEO COMMERCE'),
('HRD','RDS','STAFF RDS','STAFF HR','STAFF HUMAN RESOURCES PERUSAHAAN REYCOM DOCUMENT SOLUSI'),
('IT','RDS','STAFF RDS','STAFF IT','STAFF PENGURUS BAGIAN IT'),
('UPL1','PHS','PRUDENTIAL PHS','UPL.INDEX','UPLOADER INDEXING DEPARTEMEN PRUDENTIAL PHS'),
('UPL2','PHS','PRUDENTIAL PHS','UPL.CAPTURE','UPLOADER CAPTURE DEPARTEMEN PRUDENTIAL PHS'),
('OPT','ALZ','ALLIANZ','OPT.INDEXING','OPERATOR INDEXING DEPARTEMEN ALLIANZ'),
('OPT1','PHS','PRUDENTIAL PHS','OPT.INDEXING','OPERATOR INDEXING DEPARTEMEN PRUDENTIAL'),
('OPT2','PHS','PRUDENTIAL PHS','OPT.CAPTURE','OPERATOR CAPTURE DEPARTEMEN PRUDENTIAL');

/*Table structure for table `resign` */

DROP TABLE IF EXISTS `resign`;

CREATE TABLE `resign` (
  `kode_resign` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(4) DEFAULT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `departemen` varchar(20) DEFAULT NULL,
  `penunjukan` varchar(20) DEFAULT NULL,
  `jenis_resign` varchar(15) DEFAULT NULL,
  `per_tanggal` date DEFAULT NULL,
  `keterangan` text,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_resign`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `resign` */

insert  into `resign`(`kode_resign`,`id_pegawai`,`nama_pegawai`,`departemen`,`penunjukan`,`jenis_resign`,`per_tanggal`,`keterangan`,`file`) values 
(2,1200,'BERNADETE SEPTIANA','ALZ','SPV',NULL,'2023-03-24','HABIS KONTRAK','DOC-20230221-WA0001.-61.pdf'),
(3,1203,'BERNADETE KURNIA','BNC','SPV2',NULL,'2023-03-25','MENIKAH',NULL),
(4,1200,'BERNADETE SEPTIANA','ALZ','SPV',NULL,'2023-03-08','EQEQQEQEQ','DOC-20230221-WA0001.-5.pdf'),
(5,1200,'BERNADETE SEPTIANA','ALZ','SPV',NULL,'2023-03-08','DASDASDA','7d28c351eecb8e08d695d8b36c25de3f.png'),
(6,1200,'BERNADETE SEPTIANA','ALZ','SPV',NULL,'2023-03-10','JHKJHJKHJKHKJHJKHJKH','DOC-20230221-WA0001.-61.pdf');

/*Table structure for table `shift` */

DROP TABLE IF EXISTS `shift`;

CREATE TABLE `shift` (
  `id_shift` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` char(4) DEFAULT NULL,
  `nama_shift` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_shift`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `shift` */

insert  into `shift`(`id_shift`,`id_pegawai`,`nama_shift`) values 
(1,'1200','SHIFT PAGI'),
(2,'1201','SHIFT PAGI'),
(3,'1202','SHIFT SIANG'),
(4,'1203','SHIFT MALAM');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
