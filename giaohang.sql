/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.7.23-log : Database - wt_giaohang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`wt_giaohang` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `wt_giaohang`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_google` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `depth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/',
  `level` smallint(6) NOT NULL DEFAULT '1',
  `position` smallint(6) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AVAILABLE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

/*Table structure for table `categories_translation` */

DROP TABLE IF EXISTS `categories_translation`;

CREATE TABLE `categories_translation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories_translation` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_vip` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_display` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AVAILABLE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `languages` */

/*Table structure for table `ltm_translations` */

DROP TABLE IF EXISTS `ltm_translations`;

CREATE TABLE `ltm_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ltm_translations` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (33,'2014_04_02_193005_create_translations_table',1),(34,'2014_10_12_000000_create_users_table',1),(35,'2014_10_12_100000_create_password_resets_table',1),(36,'2018_06_28_033913_create_roles_table',1),(37,'2018_06_28_034036_create_role_user_table',1),(38,'2018_06_28_034231_create_permission_table',1),(39,'2018_06_28_034308_create_permission_role_table',1),(40,'2018_06_28_034418_create_permission_group_table',1),(41,'2018_07_12_040234_create_languages_table',1),(42,'2018_07_14_011435_create_categories_table',1),(43,'2018_07_14_011927_create_categories_translation_table',1),(44,'2019_04_04_034245_create_setting_table',1),(45,'2019_04_16_032855_create_customers_table',1),(46,'2019_04_29_042953_create_orders_table',1),(47,'2019_04_29_065442_create_prices_table',1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `shipper` int(11) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` double(8,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`code`,`customer_id`,`address1`,`address2`,`name`,`phone`,`email`,`updated_by`,`shipper`,`price`,`long`,`status`,`created_at`,`updated_at`) values (1,'OQPZDH',4,'Long Biên, Hà Nội, Việt Nam','Việt Hưng, Hà Nội, Viêt Nam','Đặng Kiên','01659901941','dangtrungkien96@gmail.com',1,3,'980,000',98.00,3,'2019-05-02 09:04:59','2019-05-03 03:33:58'),(2,'F7MNHV',4,'Long Biên, Hà Nội, Việt Nam','Việt Hưng, Hà Nội, Viêt Nam','Đặng Trung Kiên 1','01659901211','dangtrungkien1996@gmail.com',3,3,'770,000',77.00,2,'2019-05-02 09:09:48','2019-05-03 04:11:44'),(3,'MUCT31',2,'Long Biên, Hà Nội, Việt Nam','Việt Hưng, Hà Nội, Viêt Nam','Đặng Kiên','01659901211','dev@transoftvietnam.com',3,3,'920,000',46.00,2,'2019-05-02 09:12:24','2019-05-03 04:11:44'),(4,'KUEMM9',4,'Long Biên, Hà Nội, Việt Nam','Cầu giấy',NULL,NULL,NULL,NULL,NULL,'151,250',7.56,1,'2019-05-03 08:16:28','2019-05-03 08:16:28');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_group` */

DROP TABLE IF EXISTS `permission_group`;

CREATE TABLE `permission_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_group_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_group` */

insert  into `permission_group`(`id`,`name`,`display_name`,`created_at`,`updated_at`) values (1,'user','User Manager',NULL,NULL),(2,'role','Role',NULL,NULL),(3,'user_permission','Add permission',NULL,NULL),(4,'units','Units Manager',NULL,NULL),(5,'orders','Orders Manager',NULL,NULL),(6,'setting','Setting',NULL,NULL),(7,'customer','Active customer',NULL,NULL);

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`id`,`permission_id`,`role_id`,`created_at`,`updated_at`) values (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL),(5,5,1,NULL,NULL),(6,6,1,NULL,NULL),(7,7,1,NULL,NULL),(8,8,1,NULL,NULL),(9,9,1,NULL,NULL),(10,10,1,NULL,NULL),(11,1,2,NULL,NULL),(12,2,2,NULL,NULL),(13,3,2,NULL,NULL),(14,4,2,NULL,NULL),(15,9,2,NULL,NULL),(16,10,2,NULL,NULL),(17,11,2,NULL,NULL),(18,12,2,NULL,NULL),(19,13,2,NULL,NULL),(20,14,2,NULL,NULL),(21,15,2,NULL,NULL),(23,17,2,NULL,NULL),(24,18,2,NULL,NULL),(25,19,2,NULL,NULL),(26,20,2,NULL,NULL),(27,11,1,NULL,NULL),(28,12,1,NULL,NULL),(29,13,1,NULL,NULL),(30,14,1,NULL,NULL),(31,15,1,NULL,NULL),(33,17,1,NULL,NULL),(34,18,1,NULL,NULL),(35,19,1,NULL,NULL),(36,20,1,NULL,NULL),(37,16,3,NULL,NULL),(39,21,1,NULL,NULL),(40,21,2,NULL,NULL),(41,22,2,NULL,NULL),(42,22,1,NULL,NULL),(43,23,3,NULL,NULL);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`display_name`,`permission_group_id`,`description`,`created_at`,`updated_at`) values (1,'user.read','Read','1',NULL,NULL,NULL),(2,'user.create','Create','1',NULL,NULL,NULL),(3,'user.update','Update','1',NULL,NULL,NULL),(4,'user.delete','Delete','1',NULL,NULL,NULL),(5,'role.read','Read','2',NULL,NULL,NULL),(6,'role.create','Create','2',NULL,NULL,NULL),(7,'role.update','Update','2',NULL,NULL,NULL),(8,'role.delete','Delete','2',NULL,NULL,NULL),(9,'permission.add_role','Add permission for Role','3',NULL,NULL,NULL),(10,'permission.add_permission','Add role User','3',NULL,NULL,NULL),(11,'units.read','Read','4',NULL,NULL,NULL),(12,'units.create','Create units','4',NULL,NULL,NULL),(13,'units.update','Update units','4',NULL,NULL,NULL),(14,'units.delete','Delete units','4',NULL,NULL,NULL),(15,'order.approve','Approve','5',NULL,NULL,NULL),(16,'order.shipped','Shipped','5',NULL,NULL,NULL),(17,'setting.contact.read','Setting contact','6',NULL,NULL,NULL),(18,'setting.seoDefault.read','Setting Seo','6',NULL,NULL,NULL),(19,'customer.active','Active customer','7',NULL,NULL,NULL),(20,'customer.read','Read customer','7',NULL,NULL,NULL),(21,'order.pick_shipper','Pick Shipper','5',NULL,'2019-05-03 03:40:21','2019-05-03 03:40:21'),(22,'order.view_all','Order View ALL','5',NULL,'2019-05-03 03:48:56','2019-05-03 03:48:56'),(23,'order.view_shipper_personal','Order view personal','5',NULL,'2019-05-03 03:49:56','2019-05-03 03:49:56');

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`id`,`user_id`,`role_id`) values (1,1,1),(2,2,2),(3,3,3);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (1,'superadmin','Super Admin','Super admin',NULL,NULL),(2,'admin','Quản trị viên','Quản trị viên','2019-05-02 08:48:26','2019-05-02 08:48:26'),(3,'staff','Nhân viên giao hàng','Nhân viên giao hàng','2019-05-02 08:49:12','2019-05-02 08:49:12');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `units` */

insert  into `units`(`id`,`price`,`status`,`created_by`,`updated_by`,`deleted_at`,`created_at`,`updated_at`) values (1,'10,000',1,1,1,NULL,'2019-05-02 09:04:13','2019-05-02 09:04:13'),(2,'20,000',1,2,2,NULL,'2019-05-02 09:12:04','2019-05-02 09:12:04');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_vip` int(11) NOT NULL DEFAULT '0',
  `is_customer` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AVAILABLE',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`code`,`name`,`email`,`phone`,`address`,`atm`,`company`,`company_address`,`company_email`,`company_phone`,`note`,`is_vip`,`is_customer`,`avatar`,`password`,`status`,`remember_token`,`created_at`,`updated_at`) values (1,'AD','Dev Transoft','admin@gmail.com','0123456789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'1.png','$2y$10$DjhS2AWiRoe6aj/LoAlbluDvU7bIiqhL4VyKqXYTO82VM86FUnIOe','AVAILABLE','yECqK8Iy62zNYXcAcJtMIxrv8q5CoJO0qNtG4ZfXvt0KPda0uhuS3kBXdR2K',NULL,NULL),(2,NULL,'Quản trị viên','quantrivien@gmail.com','0165555555',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'images/avatars/1.png','$2y$10$FO.iNX4vjDSDpYssTRyzgOz7dYK4f01bk15PqaRcT/VNCFR4rFeSe','AVAILABLE','wOaImWv7l2y8xgQv2MZxtPew8YxXMomseg6TqhlFWKed0xmGtztazfecEirG','2019-05-02 08:52:03','2019-05-02 08:52:03'),(3,NULL,'Nhân viên giao hàng','nhanviengiaohang@gmail.com','01659901941',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'images/avatars/1.png','$2y$10$vol/QEdf0YXpbKFLI1Nkue8tltaSTJWYR2lE00ReFzgoBKJrCBP8a','AVAILABLE','oW7mGEJXfFVNvpngZoi8N7OEMlVEo5yCndWsCQr7oF14STzQF4zI1Kj1VnTy','2019-05-02 08:52:34','2019-05-02 08:52:34'),(4,'DR9X5','Khách hàng A','khachhang@gmail.com','015654616116','Hà Nội',NULL,NULL,'Hà Nội','transoft@gmail.com','0165233512','edsas',0,1,NULL,'$2y$10$dWdu2//RvPklhGyiSVPOP.KVPCOU52uZ8ODmaq7kMsybbDSHMevrC','AVAILABLE','zlzjnu0ylnLcE0viwVn5ogN8ik9bpe1sAQCuh4GfkSONDC85cHhSRDuDl79e','2019-05-02 08:54:13','2019-05-02 09:09:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
