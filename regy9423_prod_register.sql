/*
 Navicat Premium Data Transfer

 Source Server         : Register.co.id
 Source Server Type    : MySQL
 Source Server Version : 101109 (10.11.9-MariaDB-cll-lve)
 Source Host           : localhost:3306
 Source Schema         : regy9423_prod_register

 Target Server Type    : MySQL
 Target Server Version : 101109 (10.11.9-MariaDB-cll-lve)
 File Encoding         : 65001

 Date: 15/11/2024 14:02:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_akun
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akun`;
CREATE TABLE `tbl_akun`  (
  `idAkun` int NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hakAkses` int NOT NULL,
  PRIMARY KEY (`idAkun`) USING BTREE,
  INDEX `hakAkses`(`hakAkses` ASC) USING BTREE,
  CONSTRAINT `tbl_akun_ibfk_1` FOREIGN KEY (`hakAkses`) REFERENCES `tbl_hak_akses` (`idHakAkses`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_akun
-- ----------------------------
INSERT INTO `tbl_akun` VALUES (22, '8308396115', '$2y$10$d32rTorO2oeY8/4oa7ypHO93re3qcQBG/PlcBu9098d66TiXxp3di', 3);
INSERT INTO `tbl_akun` VALUES (25, '4692649494', '$2y$10$pMcQWD4STPBvQOmi1jeq8.kiMenMEag63HnbfIf3fz4r1c1WVaIwq', 4);
INSERT INTO `tbl_akun` VALUES (28, '8167329660', '$2y$10$LdS9C0KuFrrXtEALhbbPg.1jVwrYa0rN13WEe8D4XnynPkFI4k7tu', 4);
INSERT INTO `tbl_akun` VALUES (29, '1973250833', '$2y$10$wEV3RGkWIBhLpvb82couee6.1LwKjdGvpYb6s8Ka4vmNUMMSAQRje', 4);
INSERT INTO `tbl_akun` VALUES (30, '8308394343', '$2y$10$d32rTorO2oeY8/4oa7ypHO93re3qcQBG/PlcBu9098d66TiXxp3di', 2);
INSERT INTO `tbl_akun` VALUES (31, '7389426444', '$2y$10$/Rccc.5MRTRfYm.ngizymeLpluK796kefLURt5pMsVvF9yeNvitHW', 4);
INSERT INTO `tbl_akun` VALUES (32, '3014039371', '$2y$10$uSti7BQwfb/juoZLXy.b4eV3vt1uU8zoF/ZHWjpIrdTRdmoyxPj.C', 4);
INSERT INTO `tbl_akun` VALUES (33, '7738034675', '$2y$10$KFtcplIHn7NvTzQPUwHsOOg/UuVSrQDw78VT25shgvZwzJRFnZJSS', 4);
INSERT INTO `tbl_akun` VALUES (34, '5745348375', '$2y$10$Mo9Jcf7xyaYZmpfApiY.S.IGNdmJf2JZDPNG32ENs/q.pCQa4SCWC', 4);
INSERT INTO `tbl_akun` VALUES (35, '1975142806', '$2y$10$TQ1p.1znHlhKoEaiqD7da.vDcP8YVREo1P8nPNJm7nmR78gphQ5Ia', 4);

-- ----------------------------
-- Table structure for tbl_berita
-- ----------------------------
DROP TABLE IF EXISTS `tbl_berita`;
CREATE TABLE `tbl_berita`  (
  `idBerita` int NOT NULL AUTO_INCREMENT,
  `tanggalBerita` datetime NOT NULL,
  `berita` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idBerita`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_berita
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_event
-- ----------------------------
DROP TABLE IF EXISTS `tbl_event`;
CREATE TABLE `tbl_event`  (
  `idEvent` int NOT NULL AUTO_INCREMENT,
  `subdomain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaEvent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggalEvent` date NOT NULL,
  `tanggalPendaftaranEvent` date NOT NULL,
  `lokasiEvent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomorRekeningEvent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaRekeningEvent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomorRekeningPembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaRekeningPembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linkMap` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linkMateri` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linkMedia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `templateSertifikat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `buktiBayarEvent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statusPembayaranEvent` int NOT NULL,
  `statusEvent` int NOT NULL,
  PRIMARY KEY (`idEvent`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_event
-- ----------------------------
INSERT INTO `tbl_event` VALUES (1, 'indaac2025-sumut', 'Indaac Sumut 2025', '2025-02-15', '2024-11-15', 'Santika Dyandra Hotel Dan Convention Medan', '8250505079', 'PT Sukseskan Perdaweri Sumut', '0', '-', '-', '-', '-', '-', '0', 0, 0);

-- ----------------------------
-- Table structure for tbl_hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hak_akses`;
CREATE TABLE `tbl_hak_akses`  (
  `idHakAkses` int NOT NULL AUTO_INCREMENT,
  `namaHakAkses` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idHakAkses`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_hak_akses
-- ----------------------------
INSERT INTO `tbl_hak_akses` VALUES (1, 'Admin');
INSERT INTO `tbl_hak_akses` VALUES (2, 'Operator');
INSERT INTO `tbl_hak_akses` VALUES (3, 'Validator');
INSERT INTO `tbl_hak_akses` VALUES (4, 'Peserta');
INSERT INTO `tbl_hak_akses` VALUES (5, 'Panitia');
INSERT INTO `tbl_hak_akses` VALUES (6, 'Stand');

-- ----------------------------
-- Table structure for tbl_log
-- ----------------------------
DROP TABLE IF EXISTS `tbl_log`;
CREATE TABLE `tbl_log`  (
  `idLog` int NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idLog`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 164 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_log
-- ----------------------------
INSERT INTO `tbl_log` VALUES (1, 'Peserta', '2024-11-04 02:20:32', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (2, 'Peserta', '2024-11-04 02:21:48', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (3, 'Peserta', '2024-11-04 02:22:27', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (4, 'Peserta', '2024-11-04 02:22:47', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (5, 'Peserta', '2024-11-04 02:24:31', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (6, 'Peserta', '2024-11-04 02:26:38', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (7, 'Tidak Diketahui', '2024-11-04 03:04:38', 'Berhasil penambahan event dengan nama event tester');
INSERT INTO `tbl_log` VALUES (8, 'Tidak Diketahui', '2024-11-04 03:04:50', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (9, 'Tidak Diketahui', '2024-11-04 03:06:07', 'Berhasil penambahan event dengan nama event tester');
INSERT INTO `tbl_log` VALUES (10, 'Tidak Diketahui', '2024-11-04 03:07:56', 'Berhasil penambahan event dengan nama event tester');
INSERT INTO `tbl_log` VALUES (11, 'Tidak Diketahui', '2024-11-04 03:09:43', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (12, 'Tidak Diketahui', '2024-11-04 03:10:16', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (13, 'Peserta', '2024-11-04 03:23:39', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (14, '9963061793', '2024-11-04 03:24:23', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (15, 'Tidak Diketahui', '2024-11-04 03:25:22', 'Username admin tidak ditemukan dalam databases');
INSERT INTO `tbl_log` VALUES (16, '9963061793', '2024-11-04 03:25:38', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (17, '9963061793', '2024-11-04 03:27:14', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (18, '9963061793', '2024-11-04 03:28:16', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (19, '9963061793', '2024-11-04 03:28:48', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (20, '9963061793', '2024-11-04 03:32:20', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (21, '9963061793', '2024-11-04 03:33:17', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (22, '9963061793', '2024-11-04 03:33:44', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (23, '9963061793', '2024-11-04 03:34:00', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (24, '9963061793', '2024-11-04 03:35:20', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (25, '9963061793', '2024-11-04 03:35:39', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (26, '9963061793', '2024-11-04 03:36:05', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (27, '9963061793', '2024-11-04 03:36:48', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (28, '9963061793', '2024-11-04 03:37:01', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (29, '', '2024-11-04 03:51:20', 'Melakukan Konfirmasi data atas nama ajsdkjabskdjbakjsdb');
INSERT INTO `tbl_log` VALUES (30, '', '2024-11-04 03:53:53', 'Melakukan Konfirmasi data atas nama ajsdkjabskdjbakjsdb');
INSERT INTO `tbl_log` VALUES (31, '9963061793', '2024-11-04 03:55:20', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (32, '9963061793', '2024-11-04 04:12:05', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (33, '8308396115', '2024-11-04 04:14:52', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (34, '8308396115', '2024-11-04 04:15:19', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (35, '8308396115', '2024-11-04 04:15:32', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (36, '8308396115', '2024-11-04 04:16:11', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (37, '8308396115', '2024-11-04 04:18:23', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (38, '8308396115', '2024-11-04 04:19:45', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (39, '9963061793', '2024-11-04 07:03:32', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (40, '9963061793', '2024-11-04 07:31:33', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (41, '9963061793', '2024-11-04 07:36:26', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (42, '9963061793', '2024-11-04 07:36:45', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (43, '9963061793', '2024-11-04 07:42:26', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (44, '8308396115', '2024-11-04 07:47:33', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (45, '8308396115', '2024-11-04 07:47:43', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (46, 'tester', '2024-11-04 07:53:45', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (47, 'tester', '2024-11-04 07:53:57', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (48, '8308396115', '2024-11-04 07:57:54', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (49, '8308396115', '2024-11-04 07:58:25', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (50, '9963061793', '2024-11-04 07:58:58', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (51, '9963061793', '2024-11-04 07:59:13', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (52, '9963061793', '2024-11-04 08:01:32', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (53, '9963061793', '2024-11-04 08:01:46', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (54, '8308396115', '2024-11-04 08:03:08', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (55, '8308396115', '2024-11-04 08:06:24', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (56, '8308396115', '2024-11-04 08:06:25', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (57, '8308396115', '2024-11-04 08:07:21', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (58, '8308396115', '2024-11-04 08:08:11', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (59, '8308396115', '2024-11-04 08:08:29', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (60, '9963061793', '2024-11-04 08:08:50', '9963061793Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (61, '8308396115', '2024-11-04 08:09:12', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (62, '8308396115', '2024-11-04 08:10:14', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (63, '8308396115', '2024-11-04 08:12:07', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (64, '8308396115', '2024-11-04 08:15:22', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (65, '8308396115', '2024-11-04 08:16:46', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (66, '8308396115', '2024-11-04 08:17:27', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (67, '8308396115', '2024-11-04 08:18:21', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (68, '8308396115', '2024-11-04 08:18:36', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (69, '8308396115', '2024-11-04 08:20:05', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (70, '8308396115', '2024-11-04 08:24:43', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (71, '8308396115', '2024-11-04 08:24:56', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (72, '8308396115', '2024-11-04 08:32:41', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (73, '8308396115', '2024-11-04 08:44:18', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (74, '8308396115', '2024-11-04 08:44:54', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (75, 'Peserta', '2024-11-04 08:47:47', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (76, '1471620469', '2024-11-04 08:48:08', '1471620469Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (77, '', '2024-11-04 08:48:16', 'Melakukan Konfirmasi data atas nama lkasdlknds');
INSERT INTO `tbl_log` VALUES (78, '', '2024-11-04 08:50:13', 'Melakukan Konfirmasi data atas nama lkasdlknds');
INSERT INTO `tbl_log` VALUES (79, '', '2024-11-04 08:53:02', 'Melakukan Konfirmasi data atas nama lkasdlknds');
INSERT INTO `tbl_log` VALUES (80, '8308396115', '2024-11-04 08:53:22', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (81, '8308396115', '2024-11-04 08:59:17', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (82, '8308396115', '2024-11-04 08:59:26', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (83, '8308396115', '2024-11-04 09:00:10', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (84, '1471620469', '2024-11-04 09:00:40', '1471620469Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (85, '8308396115', '2024-11-04 09:02:44', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (86, '8308396115', '2024-11-04 09:02:59', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (87, '8308396115', '2024-11-04 09:06:59', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (88, '8308396115', '2024-11-04 09:07:45', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (89, '8308396115', '2024-11-04 09:08:12', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (90, 'Tidak Diketahui', '2024-11-05 01:17:53', 'Username 1471620469 tidak ditemukan dalam databases');
INSERT INTO `tbl_log` VALUES (91, 'Peserta', '2024-11-05 01:19:36', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (92, '4692649494', '2024-11-05 01:21:12', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (93, '4692649494', '2024-11-05 01:21:44', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (94, '4692649494', '2024-11-05 01:27:22', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (95, '4692649494', '2024-11-05 01:27:38', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (96, '4692649494', '2024-11-05 01:28:10', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (97, '4692649494', '2024-11-05 01:31:32', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (98, '4692649494', '2024-11-05 01:31:51', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (99, '', '2024-11-05 01:33:14', 'Melakukan Konfirmasi data atas nama pengujian');
INSERT INTO `tbl_log` VALUES (100, '8308396115', '2024-11-05 01:33:52', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (101, '8308396115', '2024-11-05 01:34:31', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (102, '8308396115', '2024-11-05 01:36:17', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (103, '8308396115', '2024-11-05 01:37:13', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (104, '8308396115', '2024-11-05 01:40:33', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (105, '8308396115', '2024-11-05 01:40:47', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (106, '8308396115', '2024-11-05 01:43:37', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (107, '4692649494', '2024-11-05 01:44:17', '4692649494Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (108, '8308396115', '2024-11-05 01:51:31', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (109, '8308396115', '2024-11-05 01:52:12', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (110, '8308396115', '2024-11-05 01:52:15', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (111, 'Tidak Diketahui', '2024-11-05 02:55:01', 'Berhasil penambahan event dengan nama event tester');
INSERT INTO `tbl_log` VALUES (112, 'Tidak Diketahui', '2024-11-05 02:57:41', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (113, 'Tidak Diketahui', '2024-11-05 03:49:34', 'Berhasil penambahan event dengan nama event ini uji coba');
INSERT INTO `tbl_log` VALUES (114, '8308396115', '2024-11-05 04:10:12', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (115, 'Tidak Diketahui', '2024-11-05 04:43:50', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (116, '8308396115', '2024-11-05 04:48:04', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (117, '8308396115', '2024-11-05 07:47:38', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (118, 'Tidak Diketahui', '2024-11-05 07:57:21', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (119, 'Tidak Diketahui', '2024-11-05 08:19:42', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (120, 'Tidak Diketahui', '2024-11-05 08:21:19', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (121, 'Tidak Diketahui', '2024-11-05 08:21:30', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (122, 'Tidak Diketahui', '2024-11-05 08:21:54', 'testersudah terdaftar dalam database');
INSERT INTO `tbl_log` VALUES (123, 'Peserta', '2024-11-06 01:02:28', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (124, '8167329660', '2024-11-06 01:02:48', '8167329660Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (125, '', '2024-11-06 01:03:05', 'Melakukan Konfirmasi data atas nama Dico Triyadi');
INSERT INTO `tbl_log` VALUES (126, '8308396115', '2024-11-06 01:03:32', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (127, '8308396115', '2024-11-06 01:03:50', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (128, '8167329660', '2024-11-06 01:04:34', '8167329660Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (129, '8308396115', '2024-11-09 10:43:14', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (130, '8308396115', '2024-11-14 13:56:56', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (131, '8167329660', '2024-11-14 13:58:20', '8167329660Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (132, 'Peserta', '2024-11-14 14:07:32', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (133, '1973250833', '2024-11-14 14:08:36', '1973250833Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (134, '', '2024-11-14 14:11:59', 'Melakukan Konfirmasi data atas nama Tester');
INSERT INTO `tbl_log` VALUES (135, '1973250833', '2024-11-14 14:12:15', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (136, '8308394343', '2024-11-14 14:18:12', '8308394343Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (137, 'Peserta', '2024-11-14 14:56:15', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (138, '7389426444', '2024-11-14 14:57:08', '7389426444Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (139, '7389426444', '2024-11-14 15:00:11', '7389426444Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (140, '8308396115', '2024-11-14 15:01:52', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (141, '', '2024-11-14 15:05:49', 'Melakukan Konfirmasi data atas nama Irsad');
INSERT INTO `tbl_log` VALUES (142, '8308396115', '2024-11-14 15:07:21', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (143, '8308396115', '2024-11-14 15:07:55', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (144, '8308396115', '2024-11-14 15:10:22', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (145, '8308396115', '2024-11-14 15:18:26', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (146, '8308396115', '2024-11-14 15:18:35', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (147, '8308396115', '2024-11-15 02:53:31', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (148, '8308396115', '2024-11-15 04:39:38', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (149, '8308396115', '2024-11-15 04:39:50', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (150, 'Peserta', '2024-11-15 04:40:39', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (151, '3014039371', '2024-11-15 04:41:13', '3014039371Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (152, '', '2024-11-15 04:42:47', 'Melakukan Konfirmasi data atas nama Fahmi');
INSERT INTO `tbl_log` VALUES (153, '8308396115', '2024-11-15 04:46:50', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (154, '8308396115', '2024-11-15 04:47:55', '8308396115Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (155, 'Peserta', '2024-11-15 04:53:46', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (156, 'Peserta', '2024-11-15 04:53:51', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (157, 'Peserta', '2024-11-15 04:53:55', 'Berhasil melakukan pendaftaran ');
INSERT INTO `tbl_log` VALUES (158, '1975142806', '2024-11-15 05:03:29', '1975142806Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (159, '8308396115', '2024-11-15 05:04:39', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (160, '', '2024-11-15 05:05:15', 'Melakukan Konfirmasi data atas nama dr.Susi');
INSERT INTO `tbl_log` VALUES (161, '8308396115', '2024-11-15 05:06:50', 'Melakukan Konfirmasi Pembayaran');
INSERT INTO `tbl_log` VALUES (162, '1975142806', '2024-11-15 05:07:40', '1975142806Berhasil Login ke dalam Aplikasi');
INSERT INTO `tbl_log` VALUES (163, '3014039371', '2024-11-15 05:10:05', '3014039371Berhasil Login ke dalam Aplikasi');

-- ----------------------------
-- Table structure for tbl_operator
-- ----------------------------
DROP TABLE IF EXISTS `tbl_operator`;
CREATE TABLE `tbl_operator`  (
  `idOperator` int NOT NULL AUTO_INCREMENT,
  `akun` int NOT NULL,
  `event` int NOT NULL,
  `namaOperator` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomorTeleponOperator` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamatOperator` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idOperator`) USING BTREE,
  INDEX `akun`(`akun` ASC) USING BTREE,
  INDEX `event`(`event` ASC) USING BTREE,
  CONSTRAINT `tbl_operator_ibfk_1` FOREIGN KEY (`akun`) REFERENCES `tbl_akun` (`idAkun`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_operator_ibfk_2` FOREIGN KEY (`event`) REFERENCES `tbl_event` (`idEvent`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_operator
-- ----------------------------
INSERT INTO `tbl_operator` VALUES (6, 22, 1, 'Validator', '6282275849670', '-');
INSERT INTO `tbl_operator` VALUES (7, 30, 1, 'Operator', '6282275849670', '-');

-- ----------------------------
-- Table structure for tbl_peserta
-- ----------------------------
DROP TABLE IF EXISTS `tbl_peserta`;
CREATE TABLE `tbl_peserta`  (
  `idPeserta` int NOT NULL AUTO_INCREMENT,
  `event` int NOT NULL,
  `akun` int NOT NULL,
  `kodePeserta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nikPeserta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaPeserta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamatPeserta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomorTeleponPeserta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomorRekeningPeserta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaRekeningPeserta` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `buktiBayar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statusPembayaranPeserta` int NOT NULL,
  `kehadiran` int NOT NULL,
  `foto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idPeserta`) USING BTREE,
  INDEX `akun`(`akun` ASC) USING BTREE,
  INDEX `event`(`event` ASC) USING BTREE,
  CONSTRAINT `tbl_peserta_ibfk_1` FOREIGN KEY (`akun`) REFERENCES `tbl_akun` (`idAkun`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_peserta_ibfk_2` FOREIGN KEY (`event`) REFERENCES `tbl_event` (`idEvent`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_peserta
-- ----------------------------
INSERT INTO `tbl_peserta` VALUES (16, 1, 25, '4692649494', '1234567890', 'pengujian', '', '6282275849670', '', '', '1730770394_bde2bbde14a1a2e615d4.jpeg', 2, 0, '1730769573_4eb6be5083b56a795c4e.jpeg');
INSERT INTO `tbl_peserta` VALUES (17, 1, 28, '8167329660', '1234567890', 'Dico Triyadi', '', '6282275849670', '', '', '1730854985_c932cb5258ac8034eaa6.jpeg', 2, 0, '1730854945_62bbbcb4ccd820d93ca6.jpeg');
INSERT INTO `tbl_peserta` VALUES (18, 1, 29, '1973250833', '87439874398757983', 'Tester', '', '6282275849670', '', '', '1731593519_b0ab87914efdf4760d9e.jpg', 2, 0, '1731593247_e5185ef591724836f434.jpg');
INSERT INTO `tbl_peserta` VALUES (19, 1, 31, '7389426444', '23478', 'Irsad', '', '6281390081122', '', '', '1731596749_a33ad371a6f9ec4eb0ac.jpg', 2, 0, '1731596170_2ab930f14930c148fd73.jpg');
INSERT INTO `tbl_peserta` VALUES (20, 1, 32, '3014039371', '7834', 'Fahmi', '', '6283165103631', '', '', '1731645767_819e53619cbb71f7c8ee.jpg', 2, 0, '1731645635_71bbdbf896c503034c0f.jpg');
INSERT INTO `tbl_peserta` VALUES (21, 1, 33, '7738034675', '1092867890009876', 'dr.Susi', '', '628116092388', '', '', '', 0, 0, '1731646421_ac07156d1ba09c1a1128.jpg');
INSERT INTO `tbl_peserta` VALUES (22, 1, 34, '5745348375', '1092867890009876', 'dr.Susi', '', '628116092388', '', '', '', 0, 0, '1731646427_6f69f7e699601a6cdaf3.jpg');
INSERT INTO `tbl_peserta` VALUES (23, 1, 35, '1975142806', '1092867890009876', 'dr.Susi', '', '628116092388', '', '', '1731647115_683d1e90b78b0eac4eb7.jpg', 2, 0, '1731646431_465a17a75bf76f7a4fe4.jpg');

SET FOREIGN_KEY_CHECKS = 1;
