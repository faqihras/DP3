/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.6.30-0ubuntu0.15.10.1 : Database - rumahsakit
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rumahsakit` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rumahsakit`;

/*Table structure for table `admin_access` */

DROP TABLE IF EXISTS `admin_access`;

CREATE TABLE `admin_access` (
  `adacAdmnId` int(10) unsigned NOT NULL DEFAULT '0',
  `adacMenuId` int(10) unsigned NOT NULL DEFAULT '0',
  `adacView` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `adacNew` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `adacEdit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `adacDelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `adacConfirm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `adacVoid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`adacAdmnId`,`adacMenuId`),
  KEY `adacMenuId` (`adacMenuId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=41 COMMENT='Daftar Akses User Admin';

/*Table structure for table `admin_company` */

DROP TABLE IF EXISTS `admin_company`;

CREATE TABLE `admin_company` (
  `adcoAdmnId` int(10) unsigned NOT NULL DEFAULT '0',
  `adcoCompId` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`adcoAdmnId`,`adcoCompId`),
  KEY `adcoCompId` (`adcoCompId`) USING BTREE,
  CONSTRAINT `admin_company_ibfk_1` FOREIGN KEY (`adcoAdmnId`) REFERENCES `admin_users` (`ausrId`),
  CONSTRAINT `admin_company_ibfk_2` FOREIGN KEY (`adcoCompId`) REFERENCES `company` (`compId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 COMMENT='Daftar Akses User Admin ke Company';

/*Table structure for table `admin_logs` */

DROP TABLE IF EXISTS `admin_logs`;

CREATE TABLE `admin_logs` (
  `alogAdminId` int(10) unsigned DEFAULT NULL,
  `alogAdminLogin` varchar(50) NOT NULL,
  `alogTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alogIP` varchar(100) NOT NULL,
  `alogStatus` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0:Success; 1:Failed; 2:Banned; 3:Doubled',
  KEY `admin` (`alogAdminId`,`alogTime`) USING BTREE,
  KEY `ip` (`alogIP`,`alogTime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Admin Log';

/*Table structure for table `admin_sessions` */

DROP TABLE IF EXISTS `admin_sessions`;

CREATE TABLE `admin_sessions` (
  `asesAdminId` int(10) unsigned NOT NULL DEFAULT '0',
  `asesSessionId` varchar(50) NOT NULL,
  `asesModule` varchar(255) NOT NULL,
  `asesLastAccess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`asesAdminId`),
  UNIQUE KEY `asesSessionId` (`asesSessionId`) USING BTREE,
  KEY `asesModule` (`asesModule`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Daftar Session User';

/*Table structure for table `admin_user_sessions` */

DROP TABLE IF EXISTS `admin_user_sessions`;

CREATE TABLE `admin_user_sessions` (
  `usesUserId` int(10) unsigned NOT NULL,
  `usesSessionId` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `usesComp` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `usesLastAccess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usesUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 COMMENT='Daftar User Session';

/*Table structure for table `admin_users` */

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `ausrId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ausrUsername` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `ausrPassword` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `ausrName` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ausrActive` tinyint(1) NOT NULL DEFAULT '0',
  `ausrLastLogin` datetime NOT NULL,
  `ausrCreated` datetime NOT NULL,
  `ausrRolhId` int(10) NOT NULL DEFAULT '0',
  `ausrFirstLogin` tinyint(4) NOT NULL DEFAULT '0',
  `ausrBannedTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ausrId`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=910 COMMENT='Daftar Table User';

/*Table structure for table `admin_users_access` */

DROP TABLE IF EXISTS `admin_users_access`;

CREATE TABLE `admin_users_access` (
  `auacAusrId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID Admin User',
  `auacMenuId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ID Menu',
  `auacView` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `auacNew` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `auacEdit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `auacDelete` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`auacAusrId`,`auacMenuId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Daftar Akses User Admin';

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `compId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `compNick` varchar(10) NOT NULL,
  `compName` varchar(35) NOT NULL,
  `compAddress` varchar(75) NOT NULL,
  `compPostCode` varchar(5) NOT NULL,
  `compCity` varchar(50) NOT NULL,
  `compTelp` varchar(15) NOT NULL,
  `compTelp2` varchar(15) NOT NULL,
  `compFax` varchar(15) NOT NULL,
  `compFax2` varchar(15) NOT NULL,
  `compEmail` varchar(25) NOT NULL,
  `compNonActiveFlag` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0: Active | 1: Non Active',
  `compStatusAnggaran` tinyint(1) NOT NULL DEFAULT '1',
  `comWorkingDate` date NOT NULL DEFAULT '0000-00-00',
  `compCreatedTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `compCreatedUserId` int(11) NOT NULL,
  `compUpdatedTime` datetime DEFAULT NULL,
  `compUpdatedUserId` int(11) DEFAULT NULL,
  `compDeletedTime` datetime DEFAULT NULL,
  `compDeletedUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`compId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 COMMENT='Daftar Company';

/*Table structure for table `homepage` */

DROP TABLE IF EXISTS `homepage`;

CREATE TABLE `homepage` (
  `hpid` int(2) NOT NULL AUTO_INCREMENT,
  `hpNama` varchar(50) NOT NULL,
  `hpKonten1` varchar(255) NOT NULL,
  `hpTglTrans` date NOT NULL,
  `hpNoApotek` int(10) NOT NULL,
  `hpCreateTime` datetime DEFAULT NULL,
  `hpCreateUser` varchar(25) DEFAULT NULL,
  `hpUpdateTime` datetime DEFAULT NULL,
  `hpUpdateUser` varchar(25) DEFAULT NULL,
  `hpDeleteTime` datetime DEFAULT NULL,
  `hpDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`hpid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menuId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menuScope` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1: admin; 2: user; 3: public',
  `menuName` varchar(50) NOT NULL,
  `menuNameInd` varchar(50) DEFAULT NULL,
  `menuNameEng` varchar(50) DEFAULT NULL,
  `apiLangGrid` varchar(255) DEFAULT NULL,
  `apiLangForm` varchar(255) DEFAULT NULL,
  `apiData` varchar(255) DEFAULT NULL,
  `menuLink` varchar(100) DEFAULT NULL COMMENT 'Jika modal=1, maka link datanya null',
  `htmlLink` varchar(200) DEFAULT '#',
  `menuModal` tinyint(4) DEFAULT '0',
  `menuParentId` int(10) DEFAULT '0',
  `menuIcon` varchar(100) DEFAULT NULL,
  `menuOrder` tinyint(4) DEFAULT '0',
  `menuLevel` tinyint(3) DEFAULT '0',
  `menuHeader` tinyint(3) DEFAULT '0' COMMENT '1: Header; 0: Detail',
  `menuFormCode` int(11) DEFAULT NULL,
  `menuNonActive` tinyint(4) DEFAULT '0',
  `menuCreatedTime` datetime DEFAULT '0000-00-00 00:00:00',
  `menuCreatedUserId` int(11) DEFAULT '2',
  `menuUpdatedTime` datetime DEFAULT NULL,
  `menuUpdatedUserId` int(11) DEFAULT NULL,
  `menuDeletedTime` datetime DEFAULT NULL,
  `menuDeletedUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`menuId`),
  KEY `menuParentId` (`menuParentId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=780 COMMENT='Daftar Menu';

/*Table structure for table `msAgama` */

DROP TABLE IF EXISTS `msAgama`;

CREATE TABLE `msAgama` (
  `agamaId` int(11) NOT NULL AUTO_INCREMENT,
  `agamaNama` varchar(200) NOT NULL,
  `agamaCreateTime` datetime DEFAULT NULL,
  `agamaCreateUser` varchar(25) DEFAULT NULL,
  `agamaUpdateTime` datetime DEFAULT NULL,
  `agamaUpdateUser` varchar(25) DEFAULT NULL,
  `agamaDeleteTime` datetime DEFAULT NULL,
  `agamaDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`agamaId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `msBarangProdUnit` */

DROP TABLE IF EXISTS `msBarangProdUnit`;

CREATE TABLE `msBarangProdUnit` (
  `prodUId` int(11) NOT NULL AUTO_INCREMENT,
  `prodUKode` varchar(50) DEFAULT NULL,
  `prodUNama` varchar(200) DEFAULT NULL,
  `prodUSatuan` varchar(100) DEFAULT NULL,
  `prodUHarga` decimal(15,3) DEFAULT NULL,
  `prodUBarang1` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang2` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang3` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang4` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang5` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang6` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang7` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang8` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang9` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang10` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang11` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang12` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang13` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang14` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang15` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang16` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang17` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang18` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang19` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang20` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang21` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang22` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang23` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang24` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang25` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang26` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang27` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang28` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang29` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUBarang30` varchar(20) NOT NULL DEFAULT 'xxxxx',
  `prodUButuh1` decimal(15,3) DEFAULT NULL,
  `prodUButuh2` decimal(15,3) DEFAULT NULL,
  `prodUButuh3` decimal(15,3) DEFAULT NULL,
  `prodUButuh4` decimal(15,3) DEFAULT NULL,
  `prodUButuh5` decimal(15,3) DEFAULT NULL,
  `prodUButuh6` decimal(15,3) DEFAULT NULL,
  `prodUButuh7` decimal(15,3) DEFAULT NULL,
  `prodUButuh8` decimal(15,3) DEFAULT NULL,
  `prodUButuh9` decimal(15,3) DEFAULT NULL,
  `prodUButuh10` decimal(15,3) DEFAULT NULL,
  `prodUButuh11` decimal(15,3) DEFAULT NULL,
  `prodUButuh12` decimal(15,3) DEFAULT NULL,
  `prodUButuh13` decimal(15,3) DEFAULT NULL,
  `prodUButuh14` decimal(15,3) DEFAULT NULL,
  `prodUButuh15` decimal(15,3) DEFAULT NULL,
  `prodUButuh16` decimal(15,3) DEFAULT NULL,
  `prodUButuh17` decimal(15,3) DEFAULT NULL,
  `prodUButuh18` decimal(15,3) DEFAULT NULL,
  `prodUButuh19` decimal(15,3) DEFAULT NULL,
  `prodUButuh20` decimal(15,3) DEFAULT NULL,
  `prodUButuh21` decimal(15,3) DEFAULT NULL,
  `prodUButuh22` decimal(15,3) DEFAULT NULL,
  `prodUButuh23` decimal(15,3) DEFAULT NULL,
  `prodUButuh24` decimal(15,3) DEFAULT NULL,
  `prodUButuh25` decimal(15,3) DEFAULT NULL,
  `prodUButuh26` decimal(15,3) DEFAULT NULL,
  `prodUButuh27` decimal(15,3) DEFAULT NULL,
  `prodUButuh28` decimal(15,3) DEFAULT NULL,
  `prodUButuh29` decimal(15,3) DEFAULT NULL,
  `prodUButuh30` decimal(15,3) DEFAULT NULL,
  `prodUStok` decimal(15,3) NOT NULL DEFAULT '0.000',
  `prodUCreateTime` datetime DEFAULT NULL,
  `prodUCreateUser` varchar(25) DEFAULT NULL,
  `prodUUpdateTime` datetime DEFAULT NULL,
  `prodUUpdateUser` varchar(25) DEFAULT NULL,
  `prodUDeleteTime` datetime DEFAULT NULL,
  `prodUDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`prodUId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `msJaminanHeader` */

DROP TABLE IF EXISTS `msJaminanHeader`;

CREATE TABLE `msJaminanHeader` (
  `msjHeadId` int(10) NOT NULL AUTO_INCREMENT,
  `msjHeadNama` varchar(255) NOT NULL,
  `msjHeadCreateTime` datetime DEFAULT NULL,
  `msjHeadCreateUser` varchar(25) DEFAULT NULL,
  `msjHeadUpdateTime` datetime DEFAULT NULL,
  `msjHeadUpdateUser` varchar(25) DEFAULT NULL,
  `msjHeadDeleteTime` datetime DEFAULT NULL,
  `msjHeadDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`msjHeadId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `msKab` */

DROP TABLE IF EXISTS `msKab`;

CREATE TABLE `msKab` (
  `kabId` int(11) NOT NULL AUTO_INCREMENT,
  `kabProv` int(11) NOT NULL,
  `kabNama` varchar(200) NOT NULL,
  `kabCreateTime` datetime DEFAULT NULL,
  `kabCreateUser` varchar(25) DEFAULT NULL,
  `kabUpdateTime` datetime DEFAULT NULL,
  `kabUpdateUser` varchar(25) DEFAULT NULL,
  `kabDeleteTime` datetime DEFAULT NULL,
  `kabDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`kabId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `msKec` */

DROP TABLE IF EXISTS `msKec`;

CREATE TABLE `msKec` (
  `kecId` int(11) NOT NULL AUTO_INCREMENT,
  `kecKab` int(11) NOT NULL,
  `kecNama` varchar(100) NOT NULL,
  `kecCreateTime` datetime DEFAULT NULL,
  `kecCreateUser` varchar(25) DEFAULT NULL,
  `kecUpdateTime` datetime DEFAULT NULL,
  `kecUpdateUser` varchar(25) DEFAULT NULL,
  `kecDeleteTime` datetime DEFAULT NULL,
  `kecDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`kecId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `msKel` */

DROP TABLE IF EXISTS `msKel`;

CREATE TABLE `msKel` (
  `kelId` int(11) NOT NULL AUTO_INCREMENT,
  `kelKec` int(11) NOT NULL,
  `kelNama` varchar(100) NOT NULL,
  `kelCreateTime` datetime DEFAULT NULL,
  `kelCreateUser` varchar(25) DEFAULT NULL,
  `kelUpdateTime` datetime DEFAULT NULL,
  `kelUpdateUser` varchar(25) DEFAULT NULL,
  `kelDeleteTime` datetime DEFAULT NULL,
  `kelDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`kelId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `msPasien` */

DROP TABLE IF EXISTS `msPasien`;

CREATE TABLE `msPasien` (
  `msPasId` int(10) NOT NULL AUTO_INCREMENT,
  `msPasRm` varchar(20) NOT NULL,
  `msPasKtp` varchar(50) NOT NULL,
  `msPasNama` varchar(200) NOT NULL,
  `msPasLahir` date NOT NULL,
  `msPasGender` char(1) NOT NULL,
  `msPasTinggi` decimal(5,2) NOT NULL,
  `msPasBerat` decimal(5,2) NOT NULL,
  `msPasGolDarah` char(2) NOT NULL,
  `msPasAlamat` varchar(200) NOT NULL,
  `msPasKelurahan` int(11) NOT NULL,
  `msPasKecamatan` int(11) NOT NULL,
  `msPasKab` int(11) NOT NULL,
  `msPasProv` int(11) NOT NULL,
  `msPasTlp` varchar(50) DEFAULT NULL,
  `msPasOrtu` varchar(100) DEFAULT NULL,
  `msPasPekerjaan` varchar(100) DEFAULT NULL,
  `msPasStatusKawin` int(11) DEFAULT NULL,
  `msPasPendidikan` int(11) DEFAULT NULL,
  `msPasAgama` int(11) DEFAULT NULL,
  `msPasTgJawab` varchar(100) DEFAULT NULL,
  `msPasTgHubungan` varchar(100) DEFAULT NULL,
  `msPasTgAlamat` varchar(100) DEFAULT NULL,
  `msPasTgTlp` varchar(100) DEFAULT NULL,
  `msPasTglDaftar` date DEFAULT NULL,
  `msPasJenis` int(11) DEFAULT NULL,
  `msPasRuangan` int(11) DEFAULT NULL,
  `msPasPoli` int(11) DEFAULT NULL,
  `msPasDokterId` int(11) DEFAULT NULL,
  `msPasUrutDaftar` int(11) DEFAULT NULL,
  `msPasJaminanId` int(11) DEFAULT NULL,
  `msPasNoKartu` varchar(100) DEFAULT NULL,
  `msPasAsalRujukan` varchar(200) DEFAULT NULL,
  `msPasNoRujukan` varchar(100) DEFAULT NULL,
  `msPasTglRujukan` date DEFAULT NULL,
  `method` int(1) NOT NULL DEFAULT '2',
  `msPasCreateTime` datetime DEFAULT NULL,
  `msPasCreateUser` varchar(25) DEFAULT NULL,
  `msPasUpdateTime` datetime DEFAULT NULL,
  `msPasUpdateUser` varchar(25) DEFAULT NULL,
  `msPasDeleteTime` datetime DEFAULT NULL,
  `msPasDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`msPasId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `msPendidikan` */

DROP TABLE IF EXISTS `msPendidikan`;

CREATE TABLE `msPendidikan` (
  `PendId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PendNama` varchar(100) DEFAULT NULL,
  `PendCreatedTime` datetime DEFAULT '0000-00-00 00:00:00',
  `PendCreatedUserId` int(11) DEFAULT '2',
  `PendUpdatedTime` datetime DEFAULT NULL,
  `PendUpdatedUserId` int(11) DEFAULT NULL,
  `PendDeletedTime` datetime DEFAULT NULL,
  `PendDeletedUserId` int(11) DEFAULT NULL,
  PRIMARY KEY (`PendId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Daftar Menu';

/*Table structure for table `msProv` */

DROP TABLE IF EXISTS `msProv`;

CREATE TABLE `msProv` (
  `provId` int(11) NOT NULL AUTO_INCREMENT,
  `provNama` varchar(100) NOT NULL,
  `provCreateTime` datetime DEFAULT NULL,
  `provCreateUser` varchar(25) DEFAULT NULL,
  `provUpdateTime` datetime DEFAULT NULL,
  `provUpdateUser` varchar(25) DEFAULT NULL,
  `provDeleteTime` datetime DEFAULT NULL,
  `provDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`provId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `msTarif` */

DROP TABLE IF EXISTS `msTarif`;

CREATE TABLE `msTarif` (
  `tarifId` int(10) NOT NULL AUTO_INCREMENT,
  `tarifKode` varchar(10) NOT NULL,
  `tarifNilai` decimal(15,0) NOT NULL,
  `tarifCreateTime` datetime DEFAULT NULL,
  `tarifCreateUser` varchar(25) DEFAULT NULL,
  `tarifUpdateTime` datetime DEFAULT NULL,
  `tarifUpdateUser` varchar(25) DEFAULT NULL,
  `tarifDeleteTime` datetime DEFAULT NULL,
  `tarifDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`tarifId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `msbarang` */

DROP TABLE IF EXISTS `msbarang`;

CREATE TABLE `msbarang` (
  `barangId` int(10) NOT NULL AUTO_INCREMENT,
  `barangKode` varchar(40) DEFAULT NULL,
  `barangNama` varchar(500) DEFAULT NULL,
  `tipeObat` varchar(40) DEFAULT NULL,
  `klasifikasi` varchar(40) DEFAULT NULL,
  `golongan` varchar(40) DEFAULT NULL,
  `barangJenis` varchar(50) NOT NULL,
  `barangBesar` varchar(20) DEFAULT NULL,
  `barangKecil` varchar(100) DEFAULT NULL,
  `barangIsiBesar` decimal(10,0) DEFAULT NULL,
  `barangPenjualan` varchar(20) DEFAULT NULL,
  `barangIsiKecil` decimal(10,0) DEFAULT NULL,
  `barangHargaBesar` decimal(10,2) NOT NULL DEFAULT '0.00',
  `barangHarga` decimal(10,2) DEFAULT NULL,
  `barangMinimum` int(11) DEFAULT NULL,
  `barangRange` int(11) DEFAULT NULL,
  `barangGudang` varchar(10) DEFAULT '',
  `barangStokGudang` int(11) NOT NULL DEFAULT '0',
  `barangStokUnit` int(11) NOT NULL DEFAULT '0',
  `barangStokTotal` int(11) NOT NULL DEFAULT '0',
  `barangDosisRacik` decimal(5,2) NOT NULL,
  `barangNarkotik` int(1) NOT NULL DEFAULT '0',
  `barangPsikotropik` int(1) NOT NULL DEFAULT '0',
  `barangGenerik` int(1) NOT NULL DEFAULT '0',
  `barangMorfin` int(1) NOT NULL DEFAULT '0',
  `barangFormularium` int(1) NOT NULL DEFAULT '0',
  `barangAturanPakai` varchar(200) NOT NULL,
  `barangCreateTime` datetime DEFAULT NULL,
  `barangCreateUser` varchar(25) DEFAULT NULL,
  `barangUpdateTime` datetime DEFAULT NULL,
  `barangUpdateUser` varchar(25) DEFAULT NULL,
  `barangDeleteTime` datetime DEFAULT NULL,
  `barangDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`barangId`)
) ENGINE=InnoDB AUTO_INCREMENT=2162 DEFAULT CHARSET=latin1;

/*Table structure for table `msdokter` */

DROP TABLE IF EXISTS `msdokter`;

CREATE TABLE `msdokter` (
  `dokId` int(10) NOT NULL AUTO_INCREMENT,
  `dokNama` varchar(100) NOT NULL,
  `dokAlamat` varchar(100) NOT NULL,
  `dokSpesialis` varchar(100) NOT NULL,
  `doklogin` int(11) NOT NULL,
  `dokCreateTime` datetime DEFAULT NULL,
  `dokCreateUser` varchar(25) DEFAULT NULL,
  `dokUpdateTime` datetime DEFAULT NULL,
  `dokUpdateUser` varchar(25) DEFAULT NULL,
  `dokDeleteTime` datetime DEFAULT NULL,
  `dokDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`dokId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `mspaketlab` */

DROP TABLE IF EXISTS `mspaketlab`;

CREATE TABLE `mspaketlab` (
  `mslabId` int(10) NOT NULL AUTO_INCREMENT,
  `mslabPaket` varchar(200) NOT NULL,
  `mslabTarif` decimal(15,0) NOT NULL,
  `mslabCreateTime` datetime DEFAULT NULL,
  `mslabCreateUser` varchar(25) DEFAULT NULL,
  `mslabUpdateTime` datetime DEFAULT NULL,
  `mslabUpdateUser` varchar(25) DEFAULT NULL,
  `mslabDeleteTime` datetime DEFAULT NULL,
  `mslabDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`mslabId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `mspegawai` */

DROP TABLE IF EXISTS `mspegawai`;

CREATE TABLE `mspegawai` (
  `pgwId` int(10) NOT NULL AUTO_INCREMENT,
  `pgwNopeg` varchar(50) NOT NULL,
  `pgwNama` varchar(200) NOT NULL,
  `pgwJenis` int(5) NOT NULL,
  `pgwSpesialis` varchar(50) NOT NULL DEFAULT '''Umum''',
  `pgwCreateUser` varchar(25) DEFAULT NULL,
  `pgwCreateTime` datetime DEFAULT NULL,
  `pgwUpdateUser` varchar(25) DEFAULT NULL,
  `pgwUpdateTime` datetime DEFAULT NULL,
  `pgwDeleteUser` varchar(25) DEFAULT NULL,
  `pgwDeleteTime` datetime DEFAULT NULL,
  PRIMARY KEY (`pgwId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `msperawat` */

DROP TABLE IF EXISTS `msperawat`;

CREATE TABLE `msperawat` (
  `perawatId` int(10) NOT NULL AUTO_INCREMENT,
  `perawatNama` varchar(200) NOT NULL,
  `perawatCreateUser` varchar(25) DEFAULT NULL,
  `perawatCreateTime` datetime DEFAULT NULL,
  `perawatUpdateUser` varchar(25) DEFAULT NULL,
  `perawatUpdateTime` datetime DEFAULT NULL,
  `perawatDeleteUser` varchar(25) DEFAULT NULL,
  `perawatDeleteTime` datetime DEFAULT NULL,
  PRIMARY KEY (`perawatId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `msradiology` */

DROP TABLE IF EXISTS `msradiology`;

CREATE TABLE `msradiology` (
  `radioId` int(10) NOT NULL AUTO_INCREMENT,
  `radioPaket` varchar(200) NOT NULL,
  `radioTarif` decimal(15,0) NOT NULL,
  `radioCreateTime` datetime DEFAULT NULL,
  `radioCreateUser` varchar(25) DEFAULT NULL,
  `radioUpdateTime` datetime DEFAULT NULL,
  `radioUpdateUser` varchar(25) DEFAULT NULL,
  `radioDeleteTime` datetime DEFAULT NULL,
  `radioDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`radioId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `msruangan` */

DROP TABLE IF EXISTS `msruangan`;

CREATE TABLE `msruangan` (
  `ruangId` int(10) NOT NULL AUTO_INCREMENT,
  `ruangNama` varchar(100) NOT NULL,
  `ruangInstalasi` int(10) NOT NULL,
  `ruangJenis` int(10) NOT NULL,
  `ruangTarif` decimal(15,0) NOT NULL,
  `ruangStatus` smallint(1) NOT NULL DEFAULT '0',
  `ruangCreateTime` datetime DEFAULT NULL,
  `ruangCreateUser` varchar(25) DEFAULT NULL,
  `ruangUpdateTime` datetime DEFAULT NULL,
  `ruangUpdateUser` varchar(25) DEFAULT NULL,
  `ruangDeleteTime` datetime DEFAULT NULL,
  `ruangDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ruangId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `mstindakan` */

DROP TABLE IF EXISTS `mstindakan`;

CREATE TABLE `mstindakan` (
  `mstindId` int(10) NOT NULL AUTO_INCREMENT,
  `mstindJenis` int(10) NOT NULL,
  `mstindNama` varchar(200) NOT NULL,
  `mstindTarif` decimal(15,0) NOT NULL,
  `mstindCreateTime` datetime DEFAULT NULL,
  `mstindCreateUser` varchar(25) DEFAULT NULL,
  `mstindUpdateTime` datetime DEFAULT NULL,
  `mstindUpdateUser` varchar(25) DEFAULT NULL,
  `mstindDeleteTime` datetime DEFAULT NULL,
  `mstindDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`mstindId`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=latin1;

/*Table structure for table `nomorconfig` */

DROP TABLE IF EXISTS `nomorconfig`;

CREATE TABLE `nomorconfig` (
  `confId` int(11) NOT NULL AUTO_INCREMENT,
  `confNorm` int(11) NOT NULL,
  PRIMARY KEY (`confId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `roleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  `roleNonActive` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `roleCreatedUserId` varchar(25) DEFAULT NULL,
  `roleCreatedTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `roleUpdatedUserId` varchar(25) DEFAULT NULL,
  `roleUpdatedTime` datetime DEFAULT NULL,
  `roleDeletedUserId` varchar(25) DEFAULT NULL,
  `roleDeletedTime` datetime DEFAULT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192 COMMENT='Daftar Role';

/*Table structure for table `role_menu` */

DROP TABLE IF EXISTS `role_menu`;

CREATE TABLE `role_menu` (
  `rolmId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rolmRoleId` int(10) unsigned DEFAULT NULL,
  `rolmMenuId` int(10) unsigned DEFAULT NULL,
  `rolmView` tinyint(3) NOT NULL DEFAULT '0',
  `rolmNew` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolmEdit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolmDelete` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolmConfirm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolmApprove` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolmVoid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rolmCreatedUserId` varchar(25) DEFAULT NULL,
  `rolmCreatedTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rolmUpdatedUserId` varchar(25) DEFAULT NULL,
  `rolmUpdatedTime` datetime DEFAULT NULL,
  `rolmDeletedUserId` varchar(25) DEFAULT NULL,
  `rolmDeletedTime` datetime DEFAULT NULL,
  PRIMARY KEY (`rolmId`)
) ENGINE=InnoDB AUTO_INCREMENT=4258 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=630 COMMENT='Daftar Role Menu';

/*Table structure for table `trRawat` */

DROP TABLE IF EXISTS `trRawat`;

CREATE TABLE `trRawat` (
  `rawatId` int(10) NOT NULL AUTO_INCREMENT,
  `rawatPasId` int(10) NOT NULL,
  `rawatRm` varchar(20) NOT NULL,
  `rawatKtp` varchar(50) NOT NULL,
  `rawatNama` varchar(200) NOT NULL,
  `rawatLahir` date NOT NULL,
  `rawatGender` char(1) NOT NULL,
  `rawatTinggi` decimal(5,2) NOT NULL,
  `rawatBerat` decimal(5,2) NOT NULL,
  `rawatGolDarah` char(2) NOT NULL,
  `rawatTekDarah` varchar(10) NOT NULL,
  `rawatAlamat` varchar(100) NOT NULL,
  `rawatProv` int(11) NOT NULL,
  `rawatKab` int(11) NOT NULL,
  `rawatKec` int(11) NOT NULL,
  `rawatKel` int(11) NOT NULL,
  `rawatTlp` varchar(11) NOT NULL,
  `rawatStatusKawin` int(1) NOT NULL,
  `rawatAgama` int(11) NOT NULL,
  `rawatPendidikan` int(11) NOT NULL,
  `rawatOrtu` varchar(100) NOT NULL,
  `rawatPekerjaan` varchar(100) NOT NULL,
  `rawatTgJawab` varchar(100) NOT NULL,
  `rawatTgHubungan` varchar(100) NOT NULL,
  `rawatTgAlamat` varchar(100) NOT NULL,
  `rawatTgTlp` varchar(100) NOT NULL,
  `rawatTglDaftar` date NOT NULL,
  `rawatJenis` smallint(1) NOT NULL,
  `rawatRuangan` int(10) NOT NULL,
  `rawatPoli` int(10) NOT NULL,
  `rawatDokterId` int(10) NOT NULL,
  `rawatUrutDaftar` int(10) NOT NULL,
  `rawatJaminanId` int(10) NOT NULL,
  `rawatNoKartu` varchar(50) NOT NULL,
  `rawatTarifDokter` varchar(20) NOT NULL,
  `rawatStatus` smallint(1) NOT NULL DEFAULT '0',
  `rawatStatusAsisten` smallint(1) NOT NULL DEFAULT '0',
  `rawatGejalaAwal` text NOT NULL,
  `rawatAsalRujukan` varchar(200) NOT NULL,
  `rawatNoRujukan` varchar(100) NOT NULL,
  `rawatTglRujukan` date NOT NULL,
  `rawatBaru` int(1) NOT NULL DEFAULT '0',
  `rawatTglPindah` date NOT NULL,
  `rawatTujuanPindah` int(10) NOT NULL,
  `rawatDokterRekomen` int(10) NOT NULL,
  `rawatTglKeluarRanap` date NOT NULL,
  `rawatTujuanKeluarRanap` int(10) NOT NULL,
  `rawatDokterRekomenRanap` int(10) NOT NULL,
  `rawatStatusKeluar` int(10) NOT NULL DEFAULT '0',
  `rawatCreateTime` datetime DEFAULT NULL,
  `rawatCreateUser` varchar(25) DEFAULT NULL,
  `rawatUpdateTime` datetime DEFAULT NULL,
  `rawatUpdateUser` varchar(25) DEFAULT NULL,
  `rawatDeleteTime` datetime DEFAULT NULL,
  `rawatDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`rawatId`),
  KEY `rawatPasId` (`rawatPasId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `trRawatDiagnosa` */

DROP TABLE IF EXISTS `trRawatDiagnosa`;

CREATE TABLE `trRawatDiagnosa` (
  `diagId` int(10) NOT NULL AUTO_INCREMENT,
  `diagRawatId` int(10) NOT NULL,
  `diagRawatPasId` int(10) NOT NULL,
  `diagDiagnosa` text NOT NULL,
  `diagTanggal` date NOT NULL DEFAULT '0000-00-00',
  `diagDokter` int(10) NOT NULL,
  `diagCreateTime` datetime DEFAULT NULL,
  `diagCreateUser` varchar(25) DEFAULT NULL,
  `diagUpdateTime` datetime DEFAULT NULL,
  `diagUpdateUser` varchar(25) DEFAULT NULL,
  `diagDeleteTime` datetime DEFAULT NULL,
  `diagDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`diagId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `trRawatLab` */

DROP TABLE IF EXISTS `trRawatLab`;

CREATE TABLE `trRawatLab` (
  `trlabId` int(10) NOT NULL AUTO_INCREMENT,
  `trlabRawatId` int(10) NOT NULL,
  `trlabPasId` int(10) NOT NULL,
  `trlabMsId` int(10) NOT NULL,
  `trlabPaket` varchar(255) NOT NULL,
  `trlabTarif` decimal(15,0) NOT NULL,
  `trlabTanggal` date NOT NULL DEFAULT '0000-00-00',
  `trlabHasil` varchar(255) NOT NULL,
  `trlabCreateTime` datetime DEFAULT NULL,
  `trlabCreateUser` varchar(25) DEFAULT NULL,
  `trlabUpdateTime` datetime DEFAULT NULL,
  `trlabUpdateUser` varchar(25) DEFAULT NULL,
  `trlabDeleteTime` datetime DEFAULT NULL,
  `trlabDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`trlabId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `trRawatNutrisi` */

DROP TABLE IF EXISTS `trRawatNutrisi`;

CREATE TABLE `trRawatNutrisi` (
  `nutrisiId` int(10) NOT NULL AUTO_INCREMENT,
  `nutrisiRawatId` int(10) NOT NULL,
  `nutrisiPasId` int(10) NOT NULL,
  `nutrisiUraian` varchar(255) NOT NULL,
  `nutrisiMenu` varchar(255) NOT NULL,
  `nutrisiTanggal` date NOT NULL DEFAULT '0000-00-00',
  `nutrisiCreateTime` datetime DEFAULT NULL,
  `nutrisiCreateUser` varchar(25) DEFAULT NULL,
  `nutrisiUpdateTime` datetime DEFAULT NULL,
  `nutrisiUpdateUser` varchar(25) DEFAULT NULL,
  `nutrisiDeleteTime` datetime DEFAULT NULL,
  `nutrisiDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nutrisiId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `trRawatPindahKamar` */

DROP TABLE IF EXISTS `trRawatPindahKamar`;

CREATE TABLE `trRawatPindahKamar` (
  `pkamarId` int(10) NOT NULL AUTO_INCREMENT,
  `pkamarRawatId` int(10) NOT NULL,
  `pkamarPasId` int(10) NOT NULL,
  `pkamarHari` int(10) NOT NULL,
  `pkamarTarif` decimal(15,0) NOT NULL,
  `pkamarCreateTime` datetime DEFAULT NULL,
  `pkamarCreateUser` varchar(25) DEFAULT NULL,
  `pkamarUpdateTime` datetime DEFAULT NULL,
  `pkamarUpdateUser` varchar(25) DEFAULT NULL,
  `pkamarDeleteTime` datetime DEFAULT NULL,
  `pkamarDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`pkamarId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `trRawatRadiology` */

DROP TABLE IF EXISTS `trRawatRadiology`;

CREATE TABLE `trRawatRadiology` (
  `trRadioId` int(10) NOT NULL AUTO_INCREMENT,
  `trRadioRawatId` int(10) NOT NULL,
  `trRadioPasId` int(10) NOT NULL,
  `trRadioMsId` int(10) NOT NULL,
  `trRadioPaket` varchar(255) NOT NULL,
  `trRadioTarif` decimal(15,0) NOT NULL,
  `trRadioTanggal` date NOT NULL DEFAULT '0000-00-00',
  `trRadioHasil` varchar(255) NOT NULL,
  `trRadioCreateTime` datetime DEFAULT NULL,
  `trRadioCreateUser` varchar(25) DEFAULT NULL,
  `trRadioUpdateTime` datetime DEFAULT NULL,
  `trRadioUpdateUser` varchar(25) DEFAULT NULL,
  `trRadioDeleteTime` datetime DEFAULT NULL,
  `trRadioDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`trRadioId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `trRawatTindakan` */

DROP TABLE IF EXISTS `trRawatTindakan`;

CREATE TABLE `trRawatTindakan` (
  `tindakId` int(10) NOT NULL AUTO_INCREMENT,
  `tindakRawatId` int(10) NOT NULL,
  `tindakRawatPasId` int(10) NOT NULL,
  `tindakMsId` int(10) NOT NULL,
  `tindakTindakan` text NOT NULL,
  `tindakTanggal` date NOT NULL DEFAULT '0000-00-00',
  `tindakTarif` decimal(15,0) NOT NULL,
  `tindakDokter` int(11) NOT NULL,
  `tindakCreateTime` datetime DEFAULT NULL,
  `tindakCreateUser` varchar(25) DEFAULT NULL,
  `tindakUpdateTime` datetime DEFAULT NULL,
  `tindakUpdateUser` varchar(25) DEFAULT NULL,
  `tindakDeleteTime` datetime DEFAULT NULL,
  `tindakDeleteUser` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`tindakId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/* Trigger structure for table `msPasien` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `msPasien_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'lenovo'@'%' */ /*!50003 TRIGGER `msPasien_insert` AFTER INSERT ON `msPasien` FOR EACH ROW BEGIN
	DECLARE idruang INT(10);
	set idruang=0;
	
	if (new.method=1)then
		
	    if (new.msPasJenis=3) then
		select ruangId into idruang from msruangan where ruangJenis=3 limit 1;	
		
		
		INSERT INTO trRawat(rawatPasId,rawatRm,rawatKtp,rawatNama,rawatLahir,rawatGender,rawatTglDaftar,rawatJenis,rawatRuangan,rawatPoli,rawatDokterId,rawatUrutDaftar,rawatJaminanId,rawatNoKartu,rawatBaru,rawatAsalRujukan,rawatNoRujukan,rawatTglRujukan,
				rawatAlamat,rawatTlp,rawatStatusKawin,rawatAgama,rawatPendidikan,rawatOrtu,rawatPekerjaan,rawatTgJawab,rawatTgHubungan,rawatTgAlamat,rawatTgTlp)
		VALUE(new.msPasId,new.msPasRm,new.msPasKtp,new.msPasNama,new.msPasLahir,new.msPasGender,new.msPasTglDaftar,new.msPasJenis,new.msPasRuangan,idruang,new.msPasDokterId,new.msPasUrutDaftar,new.msPasJaminanId,new.msPasNoKartu,1,new.msPasAsalRujukan,new.msPasNoRujukan,new.msPasTglRujukan,
				new.msPasAlamat,new.msPasTlp,new.msPasStatusKawin,new.msPasAgama,new.msPasPendidikan,new.msPasOrtu,new.msPasPekerjaan,new.msPasTgJawab,new.msPasTgHubungan,new.msPasTgAlamat,new.msPasTgTlp);
	    
	    else 
		INSERT INTO trRawat(rawatPasId,rawatRm,rawatKtp,rawatNama,rawatLahir,rawatGender,rawatTglDaftar,rawatJenis,rawatRuangan,rawatPoli,rawatDokterId,rawatUrutDaftar,rawatJaminanId,rawatNoKartu,rawatBaru,rawatAsalRujukan,rawatNoRujukan,rawatTglRujukan,
				rawatAlamat,rawatTlp,rawatStatusKawin,rawatAgama,rawatPendidikan,rawatOrtu,rawatPekerjaan,rawatTgJawab,rawatTgHubungan,rawatTgAlamat,rawatTgTlp)
		VALUE(new.msPasId,new.msPasRm,new.msPasKtp,new.msPasNama,new.msPasLahir,new.msPasGender,new.msPasTglDaftar,new.msPasJenis,new.msPasRuangan,new.msPasPoli,new.msPasDokterId,new.msPasUrutDaftar,new.msPasJaminanId,new.msPasNoKartu,1,new.msPasAsalRujukan,new.msPasNoRujukan,new.msPasTglRujukan,
				new.msPasAlamat,new.msPasTlp,new.msPasStatusKawin,new.msPasAgama,new.msPasPendidikan,new.msPasOrtu,new.msPasPekerjaan,new.msPasTgJawab,new.msPasTgHubungan,new.msPasTgAlamat,new.msPasTgTlp);	    
	    end if;
	
	end if; 
    END */$$


DELIMITER ;

/* Trigger structure for table `msPasien` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `msPasien_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `msPasien_update` AFTER UPDATE ON `msPasien` FOR EACH ROW BEGIN
	update trRawat set rawatRm=new.msPasRm,rawatKtp=new.msPasKtp,rawatLahir=new.msPasLahir,
	rawatGender=new.msPasGender,rawatTinggi=new.msPasTinggi,rawatBerat=new.msPasBerat,rawatGolDarah=new.msPasGolDarah,rawatNama=new.msPasNama	
	 where rawatPasId=old.msPasId;
    END */$$


DELIMITER ;

/* Trigger structure for table `trRawat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trRawat_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trRawat_insert` AFTER INSERT ON `trRawat` FOR EACH ROW BEGIN
	if new.rawatJenis=2 then 
	   update msruangan set ruangStatus=1 where ruangId=new.rawatRuangan;		
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `trRawat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trRawat_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trRawat_update` AFTER UPDATE ON `trRawat` FOR EACH ROW BEGIN
	
	if new.rawatStatus=0 then
		UPDATE msruangan SET ruangStatus=1 WHERE ruangId=old.rawatRuangan;	 	
	else 
		update msruangan set ruangStatus=0 where ruangId=old.rawatRuangan;	 
	end if;
	 
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
