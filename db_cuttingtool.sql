/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.11.4-MariaDB : Database - db_cuttingtool
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_cuttingtool` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `db_cuttingtool`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(169,'2014_10_12_000000_create_users_table',1),
(170,'2014_10_12_100000_create_password_reset_tokens_table',1),
(171,'2019_08_19_000000_create_failed_jobs_table',1),
(172,'2019_12_14_000001_create_personal_access_tokens_table',1),
(173,'2024_01_19_162714_create_mst_plant_table',1),
(174,'2024_01_20_113055_create_mst_line_table',1),
(175,'2024_01_21_114200_create_mst_model_table',1),
(176,'2024_01_21_123748_create_mst_part_table',1),
(177,'2024_01_21_215612_create_mst_holder_table',1),
(178,'2024_01_21_223752_create_mst_tool_table',1),
(179,'2024_01_22_000533_create_mst_material_table',1),
(180,'2024_01_22_210157_create_mst_accesories_table',1),
(181,'2024_01_23_004213_create_mst_bat_table',1),
(182,'2024_01_23_090544_create_mst_tolerance_table',1),
(183,'2024_02_10_222909_create_mst_maker_tool_table',1),
(184,'2024_02_11_001851_create_mst_maker_machine_table',1),
(185,'2024_02_11_105807_create_mst_machine_regrind_table',1),
(186,'2024_02_11_220301_create_mst_marking_program_table',1),
(187,'2024_02_11_222803_create_mst_unit_table',1),
(188,'2024_02_12_003058_create_mst_holder_regis_table',1),
(189,'2024_02_16_222248_create_mst_tool_regis_table',1),
(191,'2024_02_19_101801_create_mst_accesories_regis_table',1),
(192,'2024_02_22_000708_create_mst_machine_regis_table',1),
(193,'2024_02_23_001058_create_mst_assy_tool_port_regis_table',1),
(194,'2024_02_25_144252_create_mst_list_machine_table',1),
(195,'2024_02_26_004854_create_mst_marking_holder_table',1),
(196,'2024_02_26_221029_create_mst_marking_tool_table',1),
(197,'2024_03_02_223950_create_trx_assy_table',1),
(198,'2024_03_02_230322_create_mst_status_assy_table',1),
(199,'2024_02_18_093959_create_mst_regrind_inspection_record_table',2),
(201,'2024_03_09_120310_create_mst_location_table',3),
(202,'2024_03_10_094638_create_trx_machine_assy_tool_table',4);

/*Table structure for table `mst_accesories` */

DROP TABLE IF EXISTS `mst_accesories`;

CREATE TABLE `mst_accesories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_accesories` varchar(255) NOT NULL,
  `accesories_type` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_accesories_id_accesories_unique` (`id_accesories`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_accesories` */

insert  into `mst_accesories`(`id`,`id_accesories`,`accesories_type`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','Acc 1',1,'1','2024-05-02 20:46:56','2024-05-02 20:46:56'),
(2,'2','Acc 2',1,'1','2024-05-02 20:47:01','2024-05-02 20:47:01'),
(3,'3','Acc 3',1,'1','2024-05-02 20:47:22','2024-05-02 20:47:22'),
(4,'4','Acc 4',1,'1','2024-05-02 20:48:31','2024-05-02 20:48:31');

/*Table structure for table `mst_accesories_regis` */

DROP TABLE IF EXISTS `mst_accesories_regis`;

CREATE TABLE `mst_accesories_regis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_accesories` varchar(255) NOT NULL,
  `id_maker` varchar(255) NOT NULL,
  `id_material` varchar(255) NOT NULL,
  `id_unit` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `engineering_no` varchar(255) NOT NULL,
  `hes_no` varchar(255) NOT NULL,
  `spesification` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `lifetime` varchar(255) NOT NULL,
  `drawing` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_accesories_regis` */

insert  into `mst_accesories_regis`(`id`,`id_accesories`,`id_maker`,`id_material`,`id_unit`,`part_no`,`engineering_no`,`hes_no`,`spesification`,`price`,`lifetime`,`drawing`,`qty`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1','1','2','11-30-0001','-','JC547','W0003S-WRENCH 1','1000','10000','cnc-cutting-tool-holder.jpg',10,1,'1','2024-05-02 21:25:49',NULL),
(2,'2','2','2','1','12-31-0002','-','JC548','W0003S-WRENCH 2','4000','20000','cnc-cutting-tool-holder.jpg',10,1,'1','2024-05-02 21:27:28',NULL),
(3,'2','2','2','1','12-31-0002','-','JC548','W0003S-WRENCH 2','4000','20000','cnc-cutting-tool-holder.jpg',NULL,0,'1','2024-05-02 21:27:28','2024-05-02 21:27:34');

/*Table structure for table `mst_assy_tool_port_regis` */

DROP TABLE IF EXISTS `mst_assy_tool_port_regis`;

CREATE TABLE `mst_assy_tool_port_regis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_machine_regis` varchar(255) NOT NULL,
  `id_cutting_tool_regis` varchar(255) NOT NULL,
  `id_holder_regis` varchar(255) NOT NULL,
  `id_accesories_regis` varchar(255) NOT NULL,
  `tool_port` varchar(255) NOT NULL,
  `sigma_process` varchar(255) NOT NULL,
  `macro_address` varchar(255) NOT NULL,
  `min_value` varchar(255) NOT NULL,
  `max_value` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_assy_tool_port_regis` */

insert  into `mst_assy_tool_port_regis`(`id`,`id_machine_regis`,`id_cutting_tool_regis`,`id_holder_regis`,`id_accesories_regis`,`tool_port`,`sigma_process`,`macro_address`,`min_value`,`max_value`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1,2','1','1,2','01','10','D100','5','10',1,'1','2024-05-02 21:32:51',NULL),
(2,'1','3,4','2','1','02','10','D200','5','10',1,'1','2024-05-02 21:33:37',NULL),
(3,'1','3,4','2','1','02','10','D200','5','10',0,'1','2024-05-02 21:33:37','2024-05-02 21:33:46'),
(4,'2','2,3,4','2','1,2','01','5','D300','5','10',1,'1','2024-05-02 21:34:51',NULL);

/*Table structure for table `mst_bat` */

DROP TABLE IF EXISTS `mst_bat`;

CREATE TABLE `mst_bat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bat_desc` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_bat` */

insert  into `mst_bat`(`id`,`bat_desc`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'Patah',1,'1','2024-05-02 20:49:36','2024-05-02 20:49:36'),
(2,'Bengkok',1,'1','2024-05-02 20:49:42','2024-05-02 20:49:42'),
(3,'Berkarat',1,'1','2024-05-02 20:49:48','2024-05-02 20:49:48');

/*Table structure for table `mst_holder` */

DROP TABLE IF EXISTS `mst_holder`;

CREATE TABLE `mst_holder` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_holder` varchar(255) NOT NULL,
  `holder_type` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_holder_id_holder_unique` (`id_holder`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_holder` */

insert  into `mst_holder`(`id`,`id_holder`,`holder_type`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','HLDR 1',1,'1','2024-05-02 20:40:29','2024-05-02 20:40:29'),
(2,'2','HLDR 2',1,'1','2024-05-02 20:41:10','2024-05-02 20:41:10');

/*Table structure for table `mst_holder_regis` */

DROP TABLE IF EXISTS `mst_holder_regis`;

CREATE TABLE `mst_holder_regis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_holder` varchar(255) NOT NULL,
  `id_maker` varchar(255) NOT NULL,
  `id_material` varchar(255) NOT NULL,
  `id_marking` varchar(255) NOT NULL,
  `id_unit` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `engineering_no` varchar(255) NOT NULL,
  `hes_no` varchar(255) NOT NULL,
  `spesification` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `lifetime` varchar(255) NOT NULL,
  `drawing` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_holder_regis` */

insert  into `mst_holder_regis`(`id`,`id_holder`,`id_maker`,`id_material`,`id_marking`,`id_unit`,`part_no`,`engineering_no`,`hes_no`,`spesification`,`price`,`lifetime`,`drawing`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1','1','1','1','05-24-0001','-','JC541','Holder C4-PSSNL Sandvik','100000','1000000','cnc-cutting-tool-holder.jpg',1,'1','2024-05-02 21:04:53',NULL),
(2,'1','2','2','2','1','06-25-0002','-','JC542','Holder C4-PSSNL SandVik 2','50000','1000000','cnc-cutting-tool-holder.jpg',1,'1','2024-05-02 21:06:54',NULL),
(3,'2','1','2','1','1','07-26-0003','-','JC543','Holder C4-PSSNL Sandvik','75000','2000000','',1,'1','2024-05-02 21:07:44','2024-05-02 21:10:26'),
(4,'2','1','2','1','1','07-26-0003','-','JC541','Holder C4-PSSNL Sandvik','75000','2000000','cnc-cutting-tool-holder.jpg',0,'1','2024-05-02 21:07:44','2024-05-02 21:07:52');

/*Table structure for table `mst_holder_register` */

DROP TABLE IF EXISTS `mst_holder_register`;

CREATE TABLE `mst_holder_register` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tool` varchar(255) NOT NULL,
  `id_maker` varchar(255) NOT NULL,
  `id_material` varchar(255) NOT NULL,
  `id_marking` varchar(255) NOT NULL,
  `id_unit` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `engineering_no` varchar(255) NOT NULL,
  `hes_no` varchar(255) NOT NULL,
  `spesification` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `lifetime` varchar(255) NOT NULL,
  `drawing` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_holder_register` */

/*Table structure for table `mst_line` */

DROP TABLE IF EXISTS `mst_line`;

CREATE TABLE `mst_line` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_plant` varchar(255) NOT NULL,
  `id_wct` varchar(255) NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_line_id_wct_unique` (`id_wct`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_line` */

insert  into `mst_line`(`id`,`id_plant`,`id_wct`,`line_name`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1','Cylinder Comp',1,'1','2024-05-02 20:27:07','2024-05-02 20:27:07'),
(2,'1','2','Cylinder Head',1,'1','2024-05-02 20:27:22','2024-05-02 20:27:22'),
(3,'1','3','Crank Case',1,'1','2024-05-02 20:27:31','2024-05-02 20:27:31'),
(4,'1','4','Crank Shaft',1,'1','2024-05-02 20:27:38','2024-05-02 20:27:38');

/*Table structure for table `mst_list_machine` */

DROP TABLE IF EXISTS `mst_list_machine`;

CREATE TABLE `mst_list_machine` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_machine_regis` varchar(255) NOT NULL,
  `asset_id` varchar(255) NOT NULL,
  `machine_name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_list_machine_id_machine_regis_unique` (`id_machine_regis`),
  UNIQUE KEY `mst_list_machine_asset_id_unique` (`asset_id`),
  UNIQUE KEY `mst_list_machine_ip_address_unique` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_list_machine` */

insert  into `mst_list_machine`(`id`,`id_machine_regis`,`asset_id`,`machine_name`,`ip_address`,`port`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','100054255','MC OP 10 A','192.168.10.11','5000',1,'1','2024-05-02 21:40:37',NULL),
(12,'2','9999999','MC OP 10 B','192.168.10.14','2000',1,'1','2024-05-02 21:43:39',NULL);

/*Table structure for table `mst_location` */

DROP TABLE IF EXISTS `mst_location`;

CREATE TABLE `mst_location` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_location` */

/*Table structure for table `mst_machine_regis` */

DROP TABLE IF EXISTS `mst_machine_regis`;

CREATE TABLE `mst_machine_regis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_plant` varchar(255) NOT NULL,
  `id_wct` varchar(255) NOT NULL,
  `id_maker_machine` varchar(255) NOT NULL,
  `op_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_machine_regis` */

insert  into `mst_machine_regis`(`id`,`id_plant`,`id_wct`,`id_maker_machine`,`op_name`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1','1','10',1,'1','2024-05-02 21:28:42',NULL),
(2,'1','1','1','11',1,'1','2024-05-02 21:29:15',NULL);

/*Table structure for table `mst_machine_regrind` */

DROP TABLE IF EXISTS `mst_machine_regrind`;

CREATE TABLE `mst_machine_regrind` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_plant` varchar(255) NOT NULL,
  `no_asset` varchar(255) NOT NULL,
  `machine_regrind` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_machine_regrind` */

insert  into `mst_machine_regrind`(`id`,`id_plant`,`no_asset`,`machine_regrind`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1001','MC RGND 1',1,'1','2024-05-02 20:54:40','2024-05-02 20:54:40'),
(2,'1','1002','MC RGRND 2',1,'1','2024-05-02 20:54:50','2024-05-02 20:54:50');

/*Table structure for table `mst_maker_machine` */

DROP TABLE IF EXISTS `mst_maker_machine`;

CREATE TABLE `mst_maker_machine` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_maker_machine` varchar(255) NOT NULL,
  `machine_name` varchar(255) NOT NULL,
  `suplier_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_maker_machine_id_maker_machine_unique` (`id_maker_machine`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_maker_machine` */

insert  into `mst_maker_machine`(`id`,`id_maker_machine`,`machine_name`,`suplier_name`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','Fanuc','Yuasa',1,'1','2024-05-02 20:53:49','2024-05-02 20:53:49'),
(2,'2','Sakurai','HTI',1,'1','2024-05-02 20:54:06','2024-05-02 20:54:06');

/*Table structure for table `mst_maker_tool` */

DROP TABLE IF EXISTS `mst_maker_tool`;

CREATE TABLE `mst_maker_tool` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_maker` varchar(255) NOT NULL,
  `maker_name` varchar(255) NOT NULL,
  `suplier_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_maker_tool_id_maker_unique` (`id_maker`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_maker_tool` */

insert  into `mst_maker_tool`(`id`,`id_maker`,`maker_name`,`suplier_name`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','Kawanobe','Komita',1,'1','2024-05-02 20:52:52','2024-05-02 20:52:52'),
(2,'2','OSG','Somagede',1,'1','2024-05-02 20:53:21','2024-05-02 20:53:21');

/*Table structure for table `mst_marking_holder` */

DROP TABLE IF EXISTS `mst_marking_holder`;

CREATE TABLE `mst_marking_holder` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_holder_register` varchar(255) NOT NULL,
  `id_wct` varchar(255) NOT NULL,
  `id_machine_regis` varchar(255) NOT NULL,
  `id_assy_tool_port_regis` varchar(255) NOT NULL,
  `id_location` int(4) DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL,
  `status_qr_code` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_stock` tinyint(1) DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_marking_holder` */

insert  into `mst_marking_holder`(`id`,`id_holder_register`,`id_wct`,`id_machine_regis`,`id_assy_tool_port_regis`,`id_location`,`qr_code`,`status_qr_code`,`is_active`,`is_stock`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1','1','1',NULL,'1.JC541.24.1;11001','1',1,1,'1','2024-05-02 21:48:14',NULL),
(2,'1','1','1','2',NULL,'1.JC541.24.2;11002','1',1,1,'1','2024-05-02 21:52:37',NULL),
(3,'2','1','1','1',NULL,'1.JC542.24.3;11001','1',1,1,'1','2024-05-02 21:58:45',NULL),
(4,'3','1','1','1',NULL,'1.JC543.24.001;11001','1',1,1,'1','2024-05-27 08:43:46',NULL),
(5,'1','1','1','1',NULL,'1.JC541.24.003;11001','1',1,1,'1','2024-05-27 08:44:09',NULL),
(6,'1','1','1','1',NULL,'1.JC541.24.004;11001','1',1,1,'1','2024-05-27 09:25:28',NULL);

/*Table structure for table `mst_marking_program` */

DROP TABLE IF EXISTS `mst_marking_program`;

CREATE TABLE `mst_marking_program` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `program_no` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_marking_program` */

insert  into `mst_marking_program`(`id`,`program_no`,`description`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','MRK 1',1,'1','2024-05-02 20:55:21','2024-05-02 20:55:21'),
(2,'2','MRK 2',1,'1','2024-05-02 20:55:28','2024-05-02 20:55:28');

/*Table structure for table `mst_marking_tool` */

DROP TABLE IF EXISTS `mst_marking_tool`;

CREATE TABLE `mst_marking_tool` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tool_regis` varchar(255) NOT NULL,
  `id_wct` varchar(255) NOT NULL,
  `id_location` int(10) DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL,
  `status_qr_code` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_stock` tinyint(1) NOT NULL DEFAULT 0,
  `total_regrind_indexing` int(5) DEFAULT 0,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_marking_tool` */

insert  into `mst_marking_tool`(`id`,`id_tool_regis`,`id_wct`,`id_location`,`qr_code`,`status_qr_code`,`is_active`,`is_stock`,`total_regrind_indexing`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1',NULL,'1.JC544.24.1','1',1,0,0,'1','2024-05-02 21:59:20',NULL),
(2,'2','1',NULL,'1.JC545.24.2','1',1,0,0,'1','2024-05-02 22:02:17',NULL),
(3,'3','1',NULL,'1.JC546.24.3','1',1,1,0,'1','2024-05-02 22:05:35',NULL),
(4,'4','2',NULL,'2.JC547.24.1','1',1,1,0,'1','2024-05-02 22:05:57',NULL),
(5,'1','1',NULL,'1.JC544.24.002','1',1,0,0,'1','2024-05-27 08:45:07',NULL),
(6,'2','1',NULL,'1.JC545.24.002','1',1,0,0,'1','2024-05-27 08:45:20',NULL),
(7,'1','1',NULL,'1.JC544.24.003','1',1,0,0,'1','2024-05-27 09:26:08',NULL),
(8,'2','1',NULL,'1.JC545.24.003','1',1,0,0,'1','2024-05-27 09:26:19',NULL);

/*Table structure for table `mst_material` */

DROP TABLE IF EXISTS `mst_material`;

CREATE TABLE `mst_material` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_material` varchar(255) NOT NULL,
  `material_type` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_material_id_material_unique` (`id_material`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_material` */

insert  into `mst_material`(`id`,`id_material`,`material_type`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','MTRL 1',1,'1','2024-05-02 20:45:14','2024-05-02 20:45:14'),
(2,'2','MTRL 2',1,'1','2024-05-02 20:45:24','2024-05-02 20:45:24');

/*Table structure for table `mst_model` */

DROP TABLE IF EXISTS `mst_model`;

CREATE TABLE `mst_model` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_model` varchar(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_model_id_model_unique` (`id_model`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_model` */

insert  into `mst_model`(`id`,`id_model`,`model_name`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','K2S',1,'1','2024-05-02 20:30:30','2024-05-02 20:33:00'),
(2,'2','K0J',1,'1','2024-05-02 20:30:40','2024-05-02 20:33:09');

/*Table structure for table `mst_part` */

DROP TABLE IF EXISTS `mst_part`;

CREATE TABLE `mst_part` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_part` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_part_id_part_unique` (`id_part`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_part` */

insert  into `mst_part`(`id`,`id_part`,`part_name`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','Crank Case L',1,'1','2024-05-02 20:34:01','2024-05-02 20:34:01'),
(2,'2','Crank Case R',1,'1','2024-05-02 20:34:08','2024-05-02 20:34:08');

/*Table structure for table `mst_plant` */

DROP TABLE IF EXISTS `mst_plant`;

CREATE TABLE `mst_plant` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_plant` varchar(255) NOT NULL,
  `plant_name` varchar(255) NOT NULL,
  `plant_description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_plant_id_plant_unique` (`id_plant`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_plant` */

insert  into `mst_plant`(`id`,`id_plant`,`plant_name`,`plant_description`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','Plant NP','New Plant Deltamas',1,'1','2024-05-02 20:21:48','2024-05-02 20:21:48');

/*Table structure for table `mst_regrind_inspection_record` */

DROP TABLE IF EXISTS `mst_regrind_inspection_record`;

CREATE TABLE `mst_regrind_inspection_record` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_register_tool` varchar(255) NOT NULL,
  `eng_no` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `max_regrind` varchar(255) NOT NULL,
  `dimension` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dimension`)),
  `inspection_record` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`inspection_record`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_regrind_inspection_record` */

insert  into `mst_regrind_inspection_record`(`id`,`id_register_tool`,`eng_no`,`code`,`image`,`max_regrind`,`dimension`,`inspection_record`,`created_at`,`updated_at`) values 
(1,'3','','',NULL,'10','[[\"D1\",\"0.1\",\"0.05\"],[\"D2\",\"0.2\",\"0.06\"],[\"D4\",\"0.3\",\"0.05\"]]','[[\"0.02\",\"0.03\",\"0.02\"]]','2024-05-02 21:15:44',NULL),
(2,'4','','',NULL,'5','[[\"D1\",\"0.1\",\"0.05\"],[\"D2\",\"0.2\",\"0.06\"],[\"D3\",\"0.1\",\"0.08\"]]','[[\"0.07\",\"0.08\",\"0.09\"]]','2024-05-02 21:18:41',NULL);

/*Table structure for table `mst_status_assy` */

DROP TABLE IF EXISTS `mst_status_assy`;

CREATE TABLE `mst_status_assy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status_assy` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_status_assy` */

/*Table structure for table `mst_tolerance` */

DROP TABLE IF EXISTS `mst_tolerance`;

CREATE TABLE `mst_tolerance` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tolerance` varchar(255) NOT NULL,
  `tolerance_type` varchar(255) NOT NULL,
  `tolerance_length` double(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_tolerance_id_tolerance_unique` (`id_tolerance`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_tolerance` */

insert  into `mst_tolerance`(`id`,`id_tolerance`,`tolerance_type`,`tolerance_length`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','TLRC A',0.05,1,'1','2024-05-02 20:50:35','2024-05-02 20:50:35'),
(2,'2','TLRC B',0.04,1,'1','2024-05-02 20:50:46','2024-05-02 20:50:46'),
(3,'3','TLRC C',0.03,1,'1','2024-05-02 20:50:58','2024-05-02 20:50:58');

/*Table structure for table `mst_tool` */

DROP TABLE IF EXISTS `mst_tool`;

CREATE TABLE `mst_tool` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tool` varchar(255) NOT NULL,
  `tool_type` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_tool_id_tool_unique` (`id_tool`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_tool` */

insert  into `mst_tool`(`id`,`id_tool`,`tool_type`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','Tool 1',1,'1','2024-05-02 20:42:28','2024-05-02 20:42:28'),
(2,'2','Tool 2',1,'1','2024-05-02 20:42:35','2024-05-02 20:42:35');

/*Table structure for table `mst_tool_regis` */

DROP TABLE IF EXISTS `mst_tool_regis`;

CREATE TABLE `mst_tool_regis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tool` varchar(255) NOT NULL,
  `id_maker` varchar(255) NOT NULL,
  `id_material` varchar(255) NOT NULL,
  `id_marking` varchar(255) NOT NULL,
  `id_unit` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `engineering_no` varchar(255) NOT NULL,
  `hes_no` varchar(255) NOT NULL,
  `spesification` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `replacement` varchar(255) NOT NULL,
  `judgement` varchar(255) NOT NULL,
  `max_regrind` int(11) NOT NULL,
  `max_indexing` int(11) NOT NULL,
  `drawing` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_tool_regis` */

insert  into `mst_tool_regis`(`id`,`id_tool`,`id_maker`,`id_material`,`id_marking`,`id_unit`,`part_no`,`engineering_no`,`hes_no`,`spesification`,`price`,`replacement`,`judgement`,`max_regrind`,`max_indexing`,`drawing`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'1','1','2','1','2','08-27-0001','-','JC544','SPMR 12304EN','900000','1000','indexing',0,5,'cnc-cutting-tool-holder.jpg',1,'1','2024-05-02 21:12:31',NULL),
(2,'2','1','1','2','1','09-28-0002','-','JC545','SPMR 12304EN 1','5000','2000','indexing',0,5,'cnc-cutting-tool-holder.jpg',1,'1','2024-05-02 21:13:42',NULL),
(3,'2','1','2','1','1','10-29-0003','-','JC546','SPMR 12304EN 3','100000','3000','regrind',10,0,'cnc-cutting-tool-holder.jpg',1,'1','2024-05-02 21:15:44',NULL),
(4,'2','1','2','2','1','11-30-0004','-','JC547','SPMR 12304EN 4','25000','3000','regrind',5,0,'cnc-cutting-tool-holder.jpg',1,'1','2024-05-02 21:18:41',NULL);

/*Table structure for table `mst_unit` */

DROP TABLE IF EXISTS `mst_unit`;

CREATE TABLE `mst_unit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_unit` */

insert  into `mst_unit`(`id`,`description`,`is_active`,`created_by`,`created_at`,`updated_at`) values 
(1,'PCS',1,'1','2024-05-02 20:55:48','2024-05-02 20:55:48'),
(2,'KG',1,'1','2024-05-02 20:55:55','2024-05-02 20:55:55');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `trx_analyze` */

DROP TABLE IF EXISTS `trx_analyze`;

CREATE TABLE `trx_analyze` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `id_assy` varchar(255) DEFAULT NULL,
  `id_bat` int(4) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `value` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `trx_analyze` */

/*Table structure for table `trx_assy` */

DROP TABLE IF EXISTS `trx_assy`;

CREATE TABLE `trx_assy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `holder_qr_code` varchar(255) NOT NULL,
  `id_assy` varchar(255) NOT NULL,
  `id_plant` varchar(255) NOT NULL,
  `id_wct` varchar(255) NOT NULL,
  `id_machine_regis` varchar(255) NOT NULL,
  `id_assy_tool_port_regis` varchar(255) NOT NULL,
  `id_user_install` int(11) DEFAULT NULL,
  `id_user_uninstall` int(11) DEFAULT NULL,
  `json_tool` text NOT NULL,
  `json_holder` text NOT NULL,
  `json_acc` text NOT NULL,
  `status_assy` text NOT NULL,
  `start_install` datetime DEFAULT NULL,
  `end_install` datetime DEFAULT NULL,
  `total_inject` int(11) DEFAULT NULL,
  `zoller_z_value` varchar(255) DEFAULT NULL,
  `zoller_x_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  `actual_lifetime` varchar(255) DEFAULT NULL,
  `id_user_tool_analyze` varchar(10) DEFAULT NULL,
  `id_user_regrind_process` int(11) DEFAULT NULL,
  `id_user_regrind_check` int(11) DEFAULT NULL,
  `start_regrind` timestamp NULL DEFAULT NULL,
  `end_regrind` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trx_assy` */

insert  into `trx_assy`(`id`,`holder_qr_code`,`id_assy`,`id_plant`,`id_wct`,`id_machine_regis`,`id_assy_tool_port_regis`,`id_user_install`,`id_user_uninstall`,`json_tool`,`json_holder`,`json_acc`,`status_assy`,`start_install`,`end_install`,`total_inject`,`zoller_z_value`,`zoller_x_value`,`created_at`,`updated_at`,`id_location`,`actual_lifetime`,`id_user_tool_analyze`,`id_user_regrind_process`,`id_user_regrind_check`,`start_regrind`,`end_regrind`) values 
(1,'1.JC541.24.003;11001','1.10.01.24.001','1','1','1','1',1,1,'[\"1.JC544.24.002\",\"1.JC545.24.002\"]','[\"1.JC541.24.003;11001\"]','[\"11-30-0001\",\"12-31-0002\"]','1','2024-05-27 09:20:34','2024-05-27 16:27:45',NULL,'130.069','4.996','2024-05-27 09:06:32',NULL,4,'1000',NULL,NULL,NULL,NULL,NULL),
(2,'1.JC541.24.004;11001','1.10.01.24.002','1','1','1','1',1,NULL,'[\"1.JC544.24.003\",\"1.JC545.24.003\"]','[\"1.JC541.24.004;11001\"]','[\"11-30-0001\",\"12-31-0002\"]','1','2024-05-27 16:27:45',NULL,NULL,'130.069','4.996','2024-05-27 09:28:20',NULL,3,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `trx_machine_assy_tool` */

DROP TABLE IF EXISTS `trx_machine_assy_tool`;

CREATE TABLE `trx_machine_assy_tool` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_list_machine` varchar(255) NOT NULL,
  `id_trx_assy_old` varchar(255) DEFAULT NULL,
  `id_trx_assy_new` varchar(255) DEFAULT NULL,
  `start_install` timestamp NULL DEFAULT NULL,
  `end_install` timestamp NULL DEFAULT NULL,
  `id_user_install` varchar(255) DEFAULT NULL,
  `id_user_uninstall` varchar(255) DEFAULT NULL,
  `flag_desktop` tinyint(1) DEFAULT NULL,
  `flag_transaction` tinyint(1) DEFAULT NULL COMMENT '0 = baru insert, 1 = butuh write machine bridge, 2 = sudah di write, posisi closed transaction',
  `total_inject` int(10) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `trx_machine_assy_tool` */

insert  into `trx_machine_assy_tool`(`id`,`id_list_machine`,`id_trx_assy_old`,`id_trx_assy_new`,`start_install`,`end_install`,`id_user_install`,`id_user_uninstall`,`flag_desktop`,`flag_transaction`,`total_inject`,`created_at`,`updated_at`) values 
(1,'1','1.10.01.24.001','1.10.01.24.002','2024-05-27 09:20:34','2024-05-27 16:27:45','1','1',2,2,1000,'2024-05-27 09:20:34','2024-05-27 16:27:45'),
(6,'1','1.10.01.24.002',NULL,'2024-05-27 09:51:40',NULL,'1',NULL,0,0,0,'2024-05-27 09:51:40','2024-05-27 09:51:40'),
(7,'1','1.10.01.24.002',NULL,'2024-05-27 16:10:53',NULL,'1',NULL,0,0,0,'2024-05-27 16:10:53','2024-05-27 16:10:53'),
(8,'1','1.10.01.24.002',NULL,'2024-05-27 16:12:00',NULL,'1',NULL,0,0,0,'2024-05-27 16:12:00','2024-05-27 16:12:00'),
(9,'1','1.10.01.24.002',NULL,'2024-05-27 16:12:12',NULL,'1',NULL,0,0,0,'2024-05-27 16:12:12','2024-05-27 16:12:12'),
(10,'1','1.10.01.24.002',NULL,'2024-05-27 16:12:21',NULL,'1',NULL,0,0,0,'2024-05-27 16:12:21','2024-05-27 16:12:21'),
(11,'1','1.10.01.24.002',NULL,'2024-05-27 16:14:53',NULL,'1',NULL,0,0,0,'2024-05-27 16:14:53','2024-05-27 16:14:53'),
(12,'1','1.10.01.24.002',NULL,'2024-05-27 16:15:15',NULL,'1',NULL,0,0,0,'2024-05-27 16:15:15','2024-05-27 16:15:15'),
(13,'1','1.10.01.24.002',NULL,'2024-05-27 16:16:00',NULL,'1',NULL,0,0,0,'2024-05-27 16:16:00','2024-05-27 16:16:00'),
(14,'1','1.10.01.24.002',NULL,'2024-05-27 16:16:59',NULL,'1',NULL,0,0,0,'2024-05-27 16:16:59','2024-05-27 16:16:59'),
(15,'1','1.10.01.24.002',NULL,'2024-05-27 16:17:15',NULL,'1',NULL,0,0,0,'2024-05-27 16:17:15','2024-05-27 16:17:15'),
(16,'1','1.10.01.24.002',NULL,'2024-05-27 16:17:25',NULL,'1',NULL,0,0,0,'2024-05-27 16:17:25','2024-05-27 16:17:25'),
(17,'1','1.10.01.24.002',NULL,'2024-05-27 16:19:28',NULL,'1',NULL,0,0,0,'2024-05-27 16:19:28','2024-05-27 16:19:28'),
(18,'1','1.10.01.24.002',NULL,'2024-05-27 16:19:55',NULL,'1',NULL,0,0,0,'2024-05-27 16:19:55','2024-05-27 16:19:55'),
(19,'1','1.10.01.24.002',NULL,'2024-05-27 16:21:53',NULL,'1',NULL,0,0,0,'2024-05-27 16:21:53','2024-05-27 16:21:53'),
(20,'1','1.10.01.24.002',NULL,'2024-05-27 16:22:21',NULL,'1',NULL,0,0,0,'2024-05-27 16:22:21','2024-05-27 16:22:21'),
(21,'1','1.10.01.24.002',NULL,'2024-05-27 16:22:42',NULL,'1',NULL,0,0,0,'2024-05-27 16:22:42','2024-05-27 16:22:42'),
(22,'1','1.10.01.24.002',NULL,'2024-05-27 16:23:06',NULL,'1',NULL,0,0,0,'2024-05-27 16:23:06','2024-05-27 16:23:06'),
(23,'1','1.10.01.24.002',NULL,'2024-05-27 16:23:47',NULL,'1',NULL,0,0,0,'2024-05-27 16:23:47','2024-05-27 16:23:47'),
(24,'1','1.10.01.24.002',NULL,'2024-05-27 16:23:57',NULL,'1',NULL,0,0,0,'2024-05-27 16:23:57','2024-05-27 16:23:57'),
(25,'1','1.10.01.24.002',NULL,'2024-05-27 16:24:10',NULL,'1',NULL,0,0,0,'2024-05-27 16:24:10','2024-05-27 16:24:10'),
(26,'1','1.10.01.24.002',NULL,'2024-05-27 16:24:19',NULL,'1',NULL,0,0,0,'2024-05-27 16:24:19','2024-05-27 16:24:19'),
(27,'1','1.10.01.24.002',NULL,'2024-05-27 16:24:55',NULL,'1',NULL,0,0,0,'2024-05-27 16:24:55','2024-05-27 16:24:55'),
(28,'1','1.10.01.24.002',NULL,'2024-05-27 16:25:00',NULL,'1',NULL,0,0,0,'2024-05-27 16:25:00','2024-05-27 16:25:00'),
(29,'1','1.10.01.24.002',NULL,'2024-05-27 16:25:12',NULL,'1',NULL,0,0,0,'2024-05-27 16:25:12','2024-05-27 16:25:12'),
(30,'1','1.10.01.24.002',NULL,'2024-05-27 16:25:40',NULL,'1',NULL,0,0,0,'2024-05-27 16:25:40','2024-05-27 16:25:40'),
(31,'1','1.10.01.24.002',NULL,'2024-05-27 16:26:17',NULL,'1',NULL,0,0,0,'2024-05-27 16:26:17','2024-05-27 16:26:17'),
(32,'1','1.10.01.24.002',NULL,'2024-05-27 16:27:20',NULL,'1',NULL,0,0,0,'2024-05-27 16:27:20','2024-05-27 16:27:20'),
(33,'1','1.10.01.24.002',NULL,'2024-05-27 16:27:45',NULL,'1',NULL,0,0,0,'2024-05-27 16:27:45','2024-05-27 16:27:45');

/*Table structure for table `trx_regrind` */

DROP TABLE IF EXISTS `trx_regrind`;

CREATE TABLE `trx_regrind` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `id_assy` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `id_machine_regrind` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT NULL COMMENT '0 = baru keluar dari tool analyz, 1 =  process, 2 = stop, 3 = qc, 4 = close transaction',
  `start_regrind` timestamp NULL DEFAULT NULL,
  `end_regrind` timestamp NULL DEFAULT NULL,
  `time_qc` timestamp NULL DEFAULT NULL,
  `json_dimension` longtext DEFAULT NULL,
  `json_inspection_record` longtext DEFAULT NULL,
  `id_user_start` int(11) DEFAULT NULL,
  `id_user_stop` int(11) DEFAULT NULL,
  `id_user_qc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `trx_regrind` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `rfid` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_nrp_unique` (`nrp`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`nrp`,`rfid`,`role`,`password`,`user_photo`,`remember_token`,`is_active`,`created_at`,`updated_at`) values 
(1,'admin','admin',NULL,'admin','$2y$12$VVQgRDLl3x.06ZKaltF.Aeej/MYw4GRXo2hLrkOM9MwD4KAi9ZCgm',NULL,NULL,1,'2024-03-06 07:35:01','2024-03-06 07:35:01'),
(2,'user','user',NULL,'user','$2y$12$5mQnBm/D1PWr4oknkTFBgOnnK/frfnS7tQSl3bWlCVUKWd5RnTNU.',NULL,NULL,0,'2024-03-06 07:35:01','2024-03-06 07:35:01'),
(3,'Lucie Dare','8253524707',NULL,'user','$2y$12$WQekifIFb1dkx1edFy4ME.REOd44bpgo3SJuL1AJIOgCgNWyFhpR6',NULL,NULL,0,'2024-03-06 07:35:02','2024-03-06 07:35:02'),
(4,'Weldon Weber','3648272328',NULL,'user','$2y$12$PNe1XJSOAXAV6jPKSx8H0O0aKAPMjtpFcPLNdUk1t9mMWUPyGiGRi',NULL,NULL,0,'2024-03-06 07:35:02','2024-03-06 07:35:02'),
(5,'Mrs. Ernestine Nienow','7744176527',NULL,'user','$2y$12$ZsS36a/PptbDx5RovUDKYuchDoR8EZy9zOg9wkP2Oa6aSPp2xlIg.',NULL,NULL,0,'2024-03-06 07:35:02','2024-03-06 07:35:02'),
(6,'Mr. Rickey Ullrich Sr.','4041621610',NULL,'user','$2y$12$O1WRtIGXvrgSmtJudSCN8OttuzIrIsjsCZgBJrHQqZGT7xfN7l7a2',NULL,NULL,0,'2024-03-06 07:35:02','2024-03-06 07:35:02'),
(7,'Green Kutch','7037512204',NULL,'user','$2y$12$14cdXyiEFcYOokO7VfpLs.jWmwCCABqNF02ig5BhGblgkR9xmO4dC',NULL,NULL,1,'2024-03-06 07:35:02','2024-03-06 07:35:02'),
(8,'Javier Hintz','2171437534',NULL,'user','$2y$12$dl1SXCfHJ9rgekAcv1qUl.3YBBea18q1nVWs0HBViboJkHJ3/LwaW',NULL,NULL,1,'2024-03-06 07:35:02','2024-03-06 07:35:02'),
(9,'Soledad Farrell','1309158407',NULL,'user','$2y$12$9pXgsyNoqkRTUfdF.R92m.Poi.0R9pZzXMmDXjDrW178WQ.65QFgO',NULL,NULL,1,'2024-03-06 07:35:03','2024-03-06 07:35:03'),
(10,'Cleve Huel','9037622312',NULL,'user','$2y$12$/sLj1qh.hBKNhJT349UNoOhAeMG.aX6DWP.aYg5RA85F54XZb73Iq',NULL,NULL,1,'2024-03-06 07:35:03','2024-03-06 07:35:03'),
(11,'Bernadine McDermott','6925316471',NULL,'user','$2y$12$PPf90wb8rt8.MRK6rgHBiuR59kbVpy/IUbSScGpqTffDI9EIK2Pwi',NULL,NULL,1,'2024-03-06 07:35:03','2024-03-06 07:35:03'),
(12,'Eliezer Haley','2317188244',NULL,'user','$2y$12$Y5CytBscSCeRHfRf3699hOIwPGIbSIqPRTE3uoyLb1W9ScFGoPbsm',NULL,NULL,1,'2024-03-06 07:35:03','2024-03-06 07:35:03'),
(13,'paijo2','12342','12342','eng','$2y$12$pDFq.715Ye5ydBfFuULaUOvJk/tbss49Uj30F8Mc/HEoH5wViLm0C','Screenshot from 2024-03-10 22-17-12.png',NULL,1,'2024-03-12 09:46:18','2024-03-12 10:12:46'),
(14,'paijah','234','234','admin','$2y$12$NsXocqqNR2R7cbnl7ze4ROaTKZW49hYVha6OS0jdlTKxkxjmMO79C','Screenshot from 2024-03-12 02-46-12.png',NULL,1,'2024-03-12 09:47:36',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
