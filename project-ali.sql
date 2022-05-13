/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : project-ali

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-06-23 13:24:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ms_module`
-- ----------------------------
DROP TABLE IF EXISTS `ms_module`;
CREATE TABLE `ms_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_user` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_module
-- ----------------------------
INSERT INTO `ms_module` VALUES ('1', '1', '2020-08-14 10:14:44', '1', '2020-08-31 16:39:26', 'DATA KPM', 'Order');
INSERT INTO `ms_module` VALUES ('2', '1', '2020-08-14 10:16:33', '1', '2020-08-31 16:39:18', 'AUDIT TRAIL', 'Audit');
INSERT INTO `ms_module` VALUES ('3', '1', '2020-08-14 10:16:48', '1', '2020-08-31 16:39:00', 'ANTRIAN', 'Queue');
INSERT INTO `ms_module` VALUES ('4', '1', '2020-08-14 10:17:37', '1', '2020-08-14 10:29:13', 'BAST', null);
INSERT INTO `ms_module` VALUES ('5', '1', '2020-08-14 10:17:42', null, null, 'QC', null);
INSERT INTO `ms_module` VALUES ('6', '1', '2020-08-14 10:17:48', '1', '2020-08-14 10:29:21', 'REPORT', null);
INSERT INTO `ms_module` VALUES ('7', '1', '2020-08-14 10:18:00', '1', '2020-08-14 10:29:28', 'MASTER', null);
INSERT INTO `ms_module` VALUES ('8', '1', '2020-08-14 10:18:07', '1', '2020-08-14 11:11:32', 'USER MANAGEMENT', null);
INSERT INTO `ms_module` VALUES ('9', '1', '2020-08-14 18:26:01', '1', '2020-08-31 16:39:09', 'BAST PENGIRIMAN', 'Bastmtg');
INSERT INTO `ms_module` VALUES ('10', '1', '2020-08-18 11:12:41', null, null, 'MODULE', 'Module');
INSERT INTO `ms_module` VALUES ('11', '1', '2020-08-18 11:12:54', null, null, 'MODULE LINK', 'ModuleLink');
INSERT INTO `ms_module` VALUES ('12', '1', '2020-08-18 11:13:55', null, null, 'BAST BANSOS (TTB)', 'BastKelurahan');
INSERT INTO `ms_module` VALUES ('13', '1', '2020-08-18 11:15:54', null, null, 'DRIVER', 'Driver');
INSERT INTO `ms_module` VALUES ('14', '1', '2020-08-18 11:16:05', null, null, 'TRUCK', 'Truck');
INSERT INTO `ms_module` VALUES ('15', '1', '2020-08-18 11:16:31', null, null, 'WAREHOUSE', 'Warehouse');
INSERT INTO `ms_module` VALUES ('16', '1', '2020-08-18 11:17:14', null, null, 'KOORDINATOR', 'Arko');
INSERT INTO `ms_module` VALUES ('18', '1', '2020-08-18 12:28:36', null, null, 'USER', 'Users');
INSERT INTO `ms_module` VALUES ('19', '1', '2020-08-18 12:29:07', null, null, 'USER ROLE', 'Role');
INSERT INTO `ms_module` VALUES ('20', '1', '2020-08-18 14:03:51', '1', '2020-08-31 16:39:42', 'EKSPEDISI', 'Expedition');
INSERT INTO `ms_module` VALUES ('21', '102', '2020-08-27 10:30:19', null, null, 'ZONASI', 'Zonasi');
INSERT INTO `ms_module` VALUES ('22', '1', '2020-08-27 13:55:00', '1', '2020-08-27 17:46:33', 'QC BACK OFFICE', 'QcBackOffice');
INSERT INTO `ms_module` VALUES ('23', '1', '2020-09-04 11:39:06', '102', '2020-09-07 12:57:08', ' BAST - GUDANG PER TANGGAL', 'SummaryDriver');
INSERT INTO `ms_module` VALUES ('24', '102', '2020-09-09 11:12:56', '102', '2020-09-09 18:47:44', 'QC - On The Fly', 'Qc');
INSERT INTO `ms_module` VALUES ('25', '102', '2020-09-10 19:58:58', null, null, 'PENDAMPING PKH', 'Pkh');
INSERT INTO `ms_module` VALUES ('26', '102', '2020-09-20 23:00:36', '102', '2020-09-21 10:01:05', 'WTP (3X)', 'Wtp');
INSERT INTO `ms_module` VALUES ('27', '102', '2020-09-23 21:41:03', null, null, 'PRINT TTB', 'PrintPdf');
INSERT INTO `ms_module` VALUES ('28', '102', '2021-06-23 11:45:59', null, null, 'Data Excel', 'Data');

-- ----------------------------
-- Table structure for `ms_module_link`
-- ----------------------------
DROP TABLE IF EXISTS `ms_module_link`;
CREATE TABLE `ms_module_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_user` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `is_parent` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ms_module_link_FK` (`role_id`),
  KEY `ms_module_link_FK_1` (`module_id`),
  CONSTRAINT `ms_module_link_FK` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id`),
  CONSTRAINT `ms_module_link_FK_1` FOREIGN KEY (`module_id`) REFERENCES `ms_module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_module_link
-- ----------------------------
INSERT INTO `ms_module_link` VALUES ('1', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '1', '10', '1', '0');
INSERT INTO `ms_module_link` VALUES ('2', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '4', '20', '1', '0');
INSERT INTO `ms_module_link` VALUES ('3', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '9', '30', '0', '0');
INSERT INTO `ms_module_link` VALUES ('4', '102', '2020-09-09 11:17:13', '102', '2021-03-12 11:03:07', '3', '12', '40', '0', '0');
INSERT INTO `ms_module_link` VALUES ('5', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '23', '50', '0', '0');
INSERT INTO `ms_module_link` VALUES ('6', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '5', '60', '1', '0');
INSERT INTO `ms_module_link` VALUES ('7', '102', '2020-09-09 11:17:13', '102', '2020-09-16 11:17:48', '3', '24', '70', '0', '0');
INSERT INTO `ms_module_link` VALUES ('8', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '22', '80', '0', '0');
INSERT INTO `ms_module_link` VALUES ('9', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:19', '3', '7', '90', '1', '1');
INSERT INTO `ms_module_link` VALUES ('10', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '13', '100', '0', '0');
INSERT INTO `ms_module_link` VALUES ('11', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '14', '110', '0', '0');
INSERT INTO `ms_module_link` VALUES ('12', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '20', '120', '0', '0');
INSERT INTO `ms_module_link` VALUES ('13', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '15', '130', '0', '0');
INSERT INTO `ms_module_link` VALUES ('14', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:19', '3', '28', '140', '0', '1');
INSERT INTO `ms_module_link` VALUES ('15', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:19', '3', '8', '150', '1', '1');
INSERT INTO `ms_module_link` VALUES ('16', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:20', '3', '18', '160', '0', '1');
INSERT INTO `ms_module_link` VALUES ('17', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:20', '3', '19', '170', '0', '1');
INSERT INTO `ms_module_link` VALUES ('18', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '16', '180', '0', '0');
INSERT INTO `ms_module_link` VALUES ('19', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:20', '3', '10', '190', '0', '1');
INSERT INTO `ms_module_link` VALUES ('20', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:46:20', '3', '11', '200', '0', '1');
INSERT INTO `ms_module_link` VALUES ('21', '102', '2020-09-09 11:17:13', '102', '2021-06-23 11:07:43', '3', '2', '210', '0', '0');
INSERT INTO `ms_module_link` VALUES ('22', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:03', '1', '1', '10', '1', '0');
INSERT INTO `ms_module_link` VALUES ('23', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '4', '20', '1', '0');
INSERT INTO `ms_module_link` VALUES ('24', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '9', '30', '0', '0');
INSERT INTO `ms_module_link` VALUES ('25', '102', '2020-09-09 11:20:15', '102', '2021-03-12 11:02:33', '1', '12', '40', '0', '0');
INSERT INTO `ms_module_link` VALUES ('26', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '23', '50', '0', '0');
INSERT INTO `ms_module_link` VALUES ('27', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '5', '60', '1', '0');
INSERT INTO `ms_module_link` VALUES ('28', '102', '2020-09-09 11:20:15', '102', '2020-09-16 11:16:25', '1', '24', '70', '0', '0');
INSERT INTO `ms_module_link` VALUES ('29', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '22', '80', '0', '0');
INSERT INTO `ms_module_link` VALUES ('30', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '7', '90', '1', '1');
INSERT INTO `ms_module_link` VALUES ('31', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '28', '100', '0', '1');
INSERT INTO `ms_module_link` VALUES ('32', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '14', '110', '0', '0');
INSERT INTO `ms_module_link` VALUES ('33', '102', '2020-09-09 11:20:15', '102', '2021-06-23 12:42:04', '1', '15', '120', '0', '0');
INSERT INTO `ms_module_link` VALUES ('35', '102', '2020-09-09 11:20:15', '102', '2020-09-18 11:06:02', '1', '16', '140', '0', '0');
INSERT INTO `ms_module_link` VALUES ('36', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '1', '10', '1', '0');
INSERT INTO `ms_module_link` VALUES ('37', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '4', '20', '1', '0');
INSERT INTO `ms_module_link` VALUES ('38', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '9', '30', '0', '0');
INSERT INTO `ms_module_link` VALUES ('39', '102', '2020-09-09 11:22:34', '102', '2021-03-12 11:03:33', '4', '12', '40', '0', '0');
INSERT INTO `ms_module_link` VALUES ('40', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '23', '50', '0', '0');
INSERT INTO `ms_module_link` VALUES ('41', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '5', '60', '1', '0');
INSERT INTO `ms_module_link` VALUES ('42', '102', '2020-09-09 11:22:34', '102', '2020-09-16 11:16:35', '4', '24', '70', '0', '0');
INSERT INTO `ms_module_link` VALUES ('43', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '22', '80', '0', '0');
INSERT INTO `ms_module_link` VALUES ('44', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '7', '90', '1', '0');
INSERT INTO `ms_module_link` VALUES ('45', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:05', '4', '13', '100', '0', '0');
INSERT INTO `ms_module_link` VALUES ('46', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:06', '4', '14', '110', '0', '0');
INSERT INTO `ms_module_link` VALUES ('47', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:06', '4', '16', '120', '0', '0');
INSERT INTO `ms_module_link` VALUES ('48', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:06', '4', '21', '130', '0', '0');
INSERT INTO `ms_module_link` VALUES ('49', '102', '2020-09-09 11:22:34', '102', '2021-06-23 11:08:06', '4', '15', '140', '0', '0');
INSERT INTO `ms_module_link` VALUES ('50', '102', '2020-09-09 18:47:03', '102', '2021-06-23 12:42:04', '1', '3', '25', '0', '0');
INSERT INTO `ms_module_link` VALUES ('51', '102', '2020-09-10 19:59:29', '102', '2021-03-12 11:03:07', '3', '25', '95', '0', '0');
INSERT INTO `ms_module_link` VALUES ('52', '102', '2020-09-10 20:05:17', '102', '2021-03-12 11:02:33', '1', '25', '95', '0', '0');
INSERT INTO `ms_module_link` VALUES ('53', '102', '2020-09-16 15:38:40', '102', '2021-06-23 11:07:43', '3', '3', '25', '0', '0');
INSERT INTO `ms_module_link` VALUES ('54', '102', '2020-09-20 23:01:10', '102', '2021-03-12 11:03:07', '3', '26', '142', '0', '0');
INSERT INTO `ms_module_link` VALUES ('55', '102', '2020-09-21 10:02:18', '102', '2021-03-12 11:03:34', '4', '26', '150', '0', '0');
INSERT INTO `ms_module_link` VALUES ('56', '102', '2020-09-22 17:38:22', '102', '2021-06-23 11:08:05', '4', '3', '25', '0', '0');
INSERT INTO `ms_module_link` VALUES ('57', '102', '2020-09-23 21:41:49', '102', '2021-03-12 11:03:07', '3', '27', '55', '0', '0');
INSERT INTO `ms_module_link` VALUES ('58', '102', '2020-09-23 21:42:06', '102', '2021-03-12 11:03:33', '4', '27', '55', '0', '0');

-- ----------------------------
-- Table structure for `ms_role`
-- ----------------------------
DROP TABLE IF EXISTS `ms_role`;
CREATE TABLE `ms_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_user` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_role
-- ----------------------------
INSERT INTO `ms_role` VALUES ('1', '1', '2020-08-14 11:49:27', null, null, 'ADMIN');
INSERT INTO `ms_role` VALUES ('2', '1', '2020-08-14 12:58:09', null, null, 'PIC-GUDANG');
INSERT INTO `ms_role` VALUES ('3', '1', '2020-08-14 12:59:10', null, null, 'SUPER ADMIN');
INSERT INTO `ms_role` VALUES ('4', '1', '2020-08-14 12:59:32', null, null, 'BACK-OFFICE');
INSERT INTO `ms_role` VALUES ('5', '1', '2020-08-31 15:32:29', null, null, 'DASHBOARD');
INSERT INTO `ms_role` VALUES ('6', '1', '2020-09-02 20:54:39', null, null, 'MANAGER-GUDANG');
INSERT INTO `ms_role` VALUES ('7', '1', '2020-10-09 18:24:39', null, null, 'BACK-OFFICE-HO');
INSERT INTO `ms_role` VALUES ('8', '1', '2020-11-24 14:01:00', null, null, 'BACK-OFFICE-FINANCE');

-- ----------------------------
-- Table structure for `ms_user`
-- ----------------------------
DROP TABLE IF EXISTS `ms_user`;
CREATE TABLE `ms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `create_user` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_user` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ms_user_FK` (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1338 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_user
-- ----------------------------
INSERT INTO `ms_user` VALUES ('102', 'super-admin', 'SUPER ADMIN', 'f18b479e973746066ba7a0bec85181a3', '0', '2020-08-12 12:19:43', null, '0000-00-00 00:00:00', '1', '', '', null);
INSERT INTO `ms_user` VALUES ('106', 'admin-toko', 'ADMIN', 'f18b479e973746066ba7a0bec85181a3', '0', '2020-09-03 11:26:15', null, '0000-00-00 00:00:00', '1', '', 'BALI', '0');
INSERT INTO `ms_user` VALUES ('1337', 'adistya', 'ADMIN', 'e10adc3949ba59abbe56e057f20f883e', '0', '2021-06-23 13:16:03', null, null, '1', null, '0', '0');

-- ----------------------------
-- Table structure for `tbl_data`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_data`;
CREATE TABLE `tbl_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `name_file` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `create_user` int(11) DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_data
-- ----------------------------
INSERT INTO `tbl_data` VALUES ('1', 'aaa', 'aaa', 'a.xls', '0', '2021-06-23 13:04:50', '2021-06-23 13:04:50', null, null);
INSERT INTO `tbl_data` VALUES ('2', 'sfdfs', 'dfdsf', 'SOAL_TEST_BIG.docx', '1', '2021-06-23 12:28:06', null, '102', null);
