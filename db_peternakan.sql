/*
 Navicat Premium Data Transfer

 Source Server         : lnpp-8-mysql
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : 17.17.17.5:3306
 Source Schema         : db_gis

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 01/05/2023 17:27:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis
-- ----------------------------
DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `kecamatan`;
CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `polygon` text NOT NULL,
  `setsementara` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for keterangan
-- ----------------------------
DROP TABLE IF EXISTS `keterangan`;
CREATE TABLE `keterangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tahun` int(255) NOT NULL,
  `id_jenis` int(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `c1` varchar(255) DEFAULT NULL,
  `c2` varchar(255) DEFAULT NULL,
  `c3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `keterangan_id_tahun_foreign` (`id_tahun`),
  KEY `keterangan_id_jenis` (`id_jenis`),
  CONSTRAINT `keterangan_id_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keterangan_id_tahun_foreign` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for peternakan
-- ----------------------------
DROP TABLE IF EXISTS `peternakan`;
CREATE TABLE `peternakan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(255) NOT NULL,
  `id_ternak` int(255) NOT NULL,
  `id_tahun` int(255) NOT NULL,
  `id_jenis` int(255) NOT NULL,
  `jumlah_ternak` int(255) NOT NULL,
  `normalisasi` double(10,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peternakan_id_kecamatan_foreign` (`id_kecamatan`),
  KEY `peternakan_id_tahun_foreign` (`id_tahun`),
  KEY `peternakan_id_ternak_foreign` (`id_ternak`),
  KEY `peternakan_id_jenis_foreign` (`id_jenis`),
  CONSTRAINT `peternakan_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peternakan_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peternakan_id_tahun_foreign` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peternakan_id_ternak_foreign` FOREIGN KEY (`id_ternak`) REFERENCES `ternak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tahun
-- ----------------------------
DROP TABLE IF EXISTS `tahun`;
CREATE TABLE `tahun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for ternak
-- ----------------------------
DROP TABLE IF EXISTS `ternak`;
CREATE TABLE `ternak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ternak` varchar(255) NOT NULL,
  `centro_1` double(10,4) DEFAULT NULL,
  `centro_2` double(10,4) DEFAULT NULL,
  `centro_3` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;