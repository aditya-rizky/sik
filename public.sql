/*
Navicat PGSQL Data Transfer

Source Server         : server_29.2
Source Server Version : 90320
Source Host           : 192.168.29.2:5432
Source Database       : db_sik.dev
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90320
File Encoding         : 65001

Date: 2018-02-15 15:25:36
*/


-- ----------------------------
-- Sequence structure for migrations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."migrations_id_seq";
CREATE SEQUENCE "public"."migrations_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 31
 CACHE 1;
SELECT setval('"public"."migrations_id_seq"', 31, true);

-- ----------------------------
-- Sequence structure for tbl_agenda_direksi_id_agenda_direksi_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_agenda_direksi_id_agenda_direksi_seq";
CREATE SEQUENCE "public"."tbl_agenda_direksi_id_agenda_direksi_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 21
 CACHE 1;
SELECT setval('"public"."tbl_agenda_direksi_id_agenda_direksi_seq"', 21, true);

-- ----------------------------
-- Sequence structure for tbl_bagian_id_bagian_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_bagian_id_bagian_seq";
CREATE SEQUENCE "public"."tbl_bagian_id_bagian_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 30
 CACHE 1;
SELECT setval('"public"."tbl_bagian_id_bagian_seq"', 30, true);

-- ----------------------------
-- Sequence structure for tbl_disposisi_direksi_id_disposisi_direksi_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_disposisi_direksi_id_disposisi_direksi_seq";
CREATE SEQUENCE "public"."tbl_disposisi_direksi_id_disposisi_direksi_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 10
 CACHE 1;
SELECT setval('"public"."tbl_disposisi_direksi_id_disposisi_direksi_seq"', 10, true);

-- ----------------------------
-- Sequence structure for tbl_golongan_id_golongan_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_golongan_id_golongan_seq";
CREATE SEQUENCE "public"."tbl_golongan_id_golongan_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;
SELECT setval('"public"."tbl_golongan_id_golongan_seq"', 7, true);

-- ----------------------------
-- Sequence structure for tbl_hakakses_id_hakakses_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_hakakses_id_hakakses_seq";
CREATE SEQUENCE "public"."tbl_hakakses_id_hakakses_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."tbl_hakakses_id_hakakses_seq"', 5, true);

-- ----------------------------
-- Sequence structure for tbl_jabatan_id_jabatan_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_jabatan_id_jabatan_seq";
CREATE SEQUENCE "public"."tbl_jabatan_id_jabatan_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 9
 CACHE 1;
SELECT setval('"public"."tbl_jabatan_id_jabatan_seq"', 9, true);

-- ----------------------------
-- Sequence structure for tbl_jenis_surat_id_jenis_surat_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_jenis_surat_id_jenis_surat_seq";
CREATE SEQUENCE "public"."tbl_jenis_surat_id_jenis_surat_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."tbl_jenis_surat_id_jenis_surat_seq"', 5, true);

-- ----------------------------
-- Sequence structure for tbl_karyawan_id_karyawan_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_karyawan_id_karyawan_seq";
CREATE SEQUENCE "public"."tbl_karyawan_id_karyawan_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 13
 CACHE 1;
SELECT setval('"public"."tbl_karyawan_id_karyawan_seq"', 13, true);

-- ----------------------------
-- Sequence structure for tbl_masakerja_id_masakerja_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_masakerja_id_masakerja_seq";
CREATE SEQUENCE "public"."tbl_masakerja_id_masakerja_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11
 CACHE 1;
SELECT setval('"public"."tbl_masakerja_id_masakerja_seq"', 11, true);

-- ----------------------------
-- Sequence structure for tbl_mid_klasifikasi_id_mid_klas_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_mid_klasifikasi_id_mid_klas_seq";
CREATE SEQUENCE "public"."tbl_mid_klasifikasi_id_mid_klas_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 25
 CACHE 1;
SELECT setval('"public"."tbl_mid_klasifikasi_id_mid_klas_seq"', 25, true);

-- ----------------------------
-- Sequence structure for tbl_parent_klasifikasi_id_parent_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_parent_klasifikasi_id_parent_seq";
CREATE SEQUENCE "public"."tbl_parent_klasifikasi_id_parent_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 27
 CACHE 1;
SELECT setval('"public"."tbl_parent_klasifikasi_id_parent_seq"', 27, true);

-- ----------------------------
-- Sequence structure for tbl_pendidikan_id_pendidikan_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_pendidikan_id_pendidikan_seq";
CREATE SEQUENCE "public"."tbl_pendidikan_id_pendidikan_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;
SELECT setval('"public"."tbl_pendidikan_id_pendidikan_seq"', 7, true);

-- ----------------------------
-- Sequence structure for tbl_retensi_aktif_id_retensi_aktif_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_retensi_aktif_id_retensi_aktif_seq";
CREATE SEQUENCE "public"."tbl_retensi_aktif_id_retensi_aktif_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 8
 CACHE 1;
SELECT setval('"public"."tbl_retensi_aktif_id_retensi_aktif_seq"', 8, true);

-- ----------------------------
-- Sequence structure for tbl_retensi_inaktif_id_retensi_inaktif_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_retensi_inaktif_id_retensi_inaktif_seq";
CREATE SEQUENCE "public"."tbl_retensi_inaktif_id_retensi_inaktif_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."tbl_retensi_inaktif_id_retensi_inaktif_seq"', 5, true);

-- ----------------------------
-- Sequence structure for tbl_retensi_keterangan_id_retensi_ket_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_retensi_keterangan_id_retensi_ket_seq";
CREATE SEQUENCE "public"."tbl_retensi_keterangan_id_retensi_ket_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 6
 CACHE 1;
SELECT setval('"public"."tbl_retensi_keterangan_id_retensi_ket_seq"', 6, true);

-- ----------------------------
-- Sequence structure for tbl_sifat_surat_id_sifat_surat_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_sifat_surat_id_sifat_surat_seq";
CREATE SEQUENCE "public"."tbl_sifat_surat_id_sifat_surat_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3
 CACHE 1;
SELECT setval('"public"."tbl_sifat_surat_id_sifat_surat_seq"', 3, true);

-- ----------------------------
-- Sequence structure for tbl_sk_eksternal_id_sk_eksternal_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_sk_eksternal_id_sk_eksternal_seq";
CREATE SEQUENCE "public"."tbl_sk_eksternal_id_sk_eksternal_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4
 CACHE 1;
SELECT setval('"public"."tbl_sk_eksternal_id_sk_eksternal_seq"', 4, true);

-- ----------------------------
-- Sequence structure for tbl_sm_internal_id_sm_internal_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_sm_internal_id_sm_internal_seq";
CREATE SEQUENCE "public"."tbl_sm_internal_id_sm_internal_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 10
 CACHE 1;
SELECT setval('"public"."tbl_sm_internal_id_sm_internal_seq"', 10, true);

-- ----------------------------
-- Sequence structure for tbl_surat_keluar_id_surat_keluar_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_surat_keluar_id_surat_keluar_seq";
CREATE SEQUENCE "public"."tbl_surat_keluar_id_surat_keluar_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 29
 CACHE 1;
SELECT setval('"public"."tbl_surat_keluar_id_surat_keluar_seq"', 29, true);

-- ----------------------------
-- Sequence structure for tbl_surat_masuk_id_surat_masuk_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_surat_masuk_id_surat_masuk_seq";
CREATE SEQUENCE "public"."tbl_surat_masuk_id_surat_masuk_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 29
 CACHE 1;
SELECT setval('"public"."tbl_surat_masuk_id_surat_masuk_seq"', 29, true);

-- ----------------------------
-- Sequence structure for tbl_temp_agenda_langsung_id_temp_agenda_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_temp_agenda_langsung_id_temp_agenda_seq";
CREATE SEQUENCE "public"."tbl_temp_agenda_langsung_id_temp_agenda_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;
SELECT setval('"public"."tbl_temp_agenda_langsung_id_temp_agenda_seq"', 7, true);

-- ----------------------------
-- Sequence structure for tbl_temp_bot_klas_id_bot_klas_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_temp_bot_klas_id_bot_klas_seq";
CREATE SEQUENCE "public"."tbl_temp_bot_klas_id_bot_klas_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4
 CACHE 1;
SELECT setval('"public"."tbl_temp_bot_klas_id_bot_klas_seq"', 4, true);

-- ----------------------------
-- Sequence structure for tbl_temp_mid_klas_id_mid_klas_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_temp_mid_klas_id_mid_klas_seq";
CREATE SEQUENCE "public"."tbl_temp_mid_klas_id_mid_klas_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."tbl_temp_mid_klas_id_mid_klas_seq"', 2, true);

-- ----------------------------
-- Sequence structure for tbl_temp_surat_keluar_id_temp_surat_keluar_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_temp_surat_keluar_id_temp_surat_keluar_seq";
CREATE SEQUENCE "public"."tbl_temp_surat_keluar_id_temp_surat_keluar_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 15
 CACHE 1;
SELECT setval('"public"."tbl_temp_surat_keluar_id_temp_surat_keluar_seq"', 15, true);

-- ----------------------------
-- Sequence structure for tbl_temp_surat_masuk_id_temp_surat_masuk_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."tbl_temp_surat_masuk_id_temp_surat_masuk_seq";
CREATE SEQUENCE "public"."tbl_temp_surat_masuk_id_temp_surat_masuk_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."tbl_temp_surat_masuk_id_temp_surat_masuk_seq"', 2, true);

-- ----------------------------
-- Sequence structure for users_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_id_seq";
CREATE SEQUENCE "public"."users_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4
 CACHE 1;
SELECT setval('"public"."users_id_seq"', 4, true);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS "public"."migrations";
CREATE TABLE "public"."migrations" (
"id" int4 DEFAULT nextval('migrations_id_seq'::regclass) NOT NULL,
"migration" varchar(255) COLLATE "default" NOT NULL,
"batch" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO "public"."migrations" VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO "public"."migrations" VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO "public"."migrations" VALUES ('3', '2017_11_03_234559_create_table_bagian', '2');
INSERT INTO "public"."migrations" VALUES ('4', '2017_11_05_050122_create_table_jabatan', '3');
INSERT INTO "public"."migrations" VALUES ('5', '2017_11_05_121347_create_table_golongan', '4');
INSERT INTO "public"."migrations" VALUES ('6', '2017_11_05_123222_create_table_masakerja', '5');
INSERT INTO "public"."migrations" VALUES ('7', '2017_11_06_041453_create_table_pendidikan', '6');
INSERT INTO "public"."migrations" VALUES ('8', '2017_11_06_043241_create_table_hakakses', '7');
INSERT INTO "public"."migrations" VALUES ('9', '2017_11_07_053147_create_table_karyawan', '8');
INSERT INTO "public"."migrations" VALUES ('10', '2017_11_11_231419_create_table_parent_klasifikasi', '9');
INSERT INTO "public"."migrations" VALUES ('11', '2017_11_13_075039_create_table_surat_keluar', '10');
INSERT INTO "public"."migrations" VALUES ('12', '2017_12_12_031756_create_table_suratmasuk', '11');
INSERT INTO "public"."migrations" VALUES ('13', '2017_12_14_072019_create_table_jenis_surat', '12');
INSERT INTO "public"."migrations" VALUES ('14', '2017_12_15_004345_create_table_sifat_surat', '13');
INSERT INTO "public"."migrations" VALUES ('15', '2017_12_18_014747_create_table_temp_agenda_langsung', '14');
INSERT INTO "public"."migrations" VALUES ('16', '2017_12_18_081326_create_table_temp_surat_keluar', '15');
INSERT INTO "public"."migrations" VALUES ('17', '2017_12_18_081713_create_table_temp_surat_masuk', '16');
INSERT INTO "public"."migrations" VALUES ('18', '2017_12_28_065514_create_table_agenda_direksi', '17');
INSERT INTO "public"."migrations" VALUES ('19', '2017_12_28_074235_create_table_disposisi_direksi', '18');
INSERT INTO "public"."migrations" VALUES ('20', '2018_01_28_021346_create_table_temp_mid_klasifikasi', '19');
INSERT INTO "public"."migrations" VALUES ('21', '2018_01_29_031315_create_table_temp_mid_klasifikasi_ulang', '20');
INSERT INTO "public"."migrations" VALUES ('22', '2018_01_29_050751_create_table_mid_kklasifikasi', '21');
INSERT INTO "public"."migrations" VALUES ('23', '2018_01_31_071630_create_table_retensi_aktif', '22');
INSERT INTO "public"."migrations" VALUES ('24', '2018_01_31_071809_create_table_retensi_inaktif', '22');
INSERT INTO "public"."migrations" VALUES ('25', '2018_01_31_072421_create_table_sifat_klasifikasi', '22');
INSERT INTO "public"."migrations" VALUES ('26', '2018_01_31_072634_create_table_retensi_keterangan', '22');
INSERT INTO "public"."migrations" VALUES ('27', '2018_02_01_044749_create_table_keterangan_retensi', '23');
INSERT INTO "public"."migrations" VALUES ('28', '2018_02_01_064405_create_table_bottom_klasifikasi', '23');
INSERT INTO "public"."migrations" VALUES ('29', '2018_02_01_065810_create_table_temp_bot_klasifikasi', '24');
INSERT INTO "public"."migrations" VALUES ('30', '2018_02_05_020039_create_table_sk_eksternal', '25');
INSERT INTO "public"."migrations" VALUES ('31', '2018_02_05_075146_create_table_sm_internal', '26');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS "public"."password_resets";
CREATE TABLE "public"."password_resets" (
"email" varchar(255) COLLATE "default" NOT NULL,
"token" varchar(255) COLLATE "default" NOT NULL,
"created_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_agenda_direksi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_agenda_direksi";
CREATE TABLE "public"."tbl_agenda_direksi" (
"id_agenda_direksi" int4 DEFAULT nextval('tbl_agenda_direksi_id_agenda_direksi_seq'::regclass) NOT NULL,
"id_jenis_surat" int4 NOT NULL,
"id_tujuan" int4 NOT NULL,
"tanggal_agenda" date NOT NULL,
"id_surat_masuk" int4 NOT NULL,
"nomor_agenda" varchar(50) COLLATE "default" NOT NULL,
"tujuan_disposisi" varchar(100) COLLATE "default",
"disposisi_direksi" varchar(100) COLLATE "default",
"uraian_disposisi" text COLLATE "default",
"created_at" timestamp(0),
"updated_at" timestamp(0),
"tahun_agenda" int4,
"tanggal_bagian" date,
"nomor_surat" varchar(100) COLLATE "default",
"tipe_surat" int4
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."tbl_agenda_direksi"."tipe_surat" IS 'internal 0, eksternal 1';

-- ----------------------------
-- Records of tbl_agenda_direksi
-- ----------------------------
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('14', '2', '16', '2018-02-09', '26', 'D.U/10/X', '19', '10', '323123123123123', '2018-02-09 06:16:37', '2018-02-14 01:52:56', '2018', '2018-02-14', 'TN', '1');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('15', '2', '16', '2018-02-09', '24', 'D.U/11/X', ',19', ',4', 'QWEASD', '2018-02-09 06:19:36', '2018-02-15 04:47:50', '2018', '2018-02-15', 'UPT.01/1/9.0SL/2018', '0');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('16', '2', '16', '2018-02-09', '27', 'D.U/12/X', null, null, null, '2018-02-09 06:19:51', '2018-02-09 06:19:51', '2018', null, 'TN/123', '1');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('17', '2', '16', '2018-02-09', '28', 'D.U/13/X', null, null, null, '2018-02-09 06:19:58', '2018-02-09 06:19:58', '2018', null, 'TES/001/20171111111111111', '1');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('18', '2', '16', '2018-02-09', '19', 'D.U/14/X', '', '', null, '2018-02-09 06:22:45', '2018-02-13 00:27:18', '2018', null, 'UPT.02/1/9.0SL/2018', '0');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('19', '2', '16', '2018-02-09', '20', 'D.U/15/X', '5,6', '1', 'ASDASDASD', '2018-02-09 06:23:28', '2018-02-14 08:23:14', '2018', '2018-02-14', 'UPT.02/2/9.0SL/2018', '0');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('20', '2', '16', '2018-02-09', '25', 'D.U/16/X', null, null, null, '2018-02-09 06:24:18', '2018-02-09 06:24:18', '2018', null, 'UPT.01/4/9.0SL/2018', '0');
INSERT INTO "public"."tbl_agenda_direksi" VALUES ('21', '2', '16', '2018-02-09', '29', 'D.U/17/X', '', '', null, '2018-02-09 06:25:35', '2018-02-13 00:23:56', '2018', null, 'SEKO NJOBO', '1');

-- ----------------------------
-- Table structure for tbl_bagian
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_bagian";
CREATE TABLE "public"."tbl_bagian" (
"id_bagian" int4 DEFAULT nextval('tbl_bagian_id_bagian_seq'::regclass) NOT NULL,
"nama_bagian" varchar(100) COLLATE "default" NOT NULL,
"kode_bagian" varchar(15) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"tindasan" int4,
"grup_bagian" int4,
"status_bagian" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_bagian
-- ----------------------------
INSERT INTO "public"."tbl_bagian" VALUES ('1', 'SEKRETARIS PERUSAHAAN - DTS', '9.0SL', null, '2018-01-18 04:46:23', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('2', 'SEKRETARIS PERUSAHAAN - DTT', '9.0SM', '2017-11-04 15:51:13', '2018-01-01 05:55:27', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('3', 'SATUAN PENGAWAS INTERNAL', 'SPI', '2017-11-04 15:57:46', '2018-01-01 05:56:08', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('4', 'TANAMAN', '9.2S', '2017-11-04 15:58:03', '2018-01-01 05:56:15', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('5', 'TEKNIK', '9.3S', '2017-11-04 15:58:09', '2017-11-04 15:58:09', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('6', 'PENGOLAHAN', '9.4S', '2017-11-04 15:58:24', '2017-11-04 15:58:24', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('7', 'PEMBIAYAAN', '9.5S', '2017-11-04 15:58:31', '2017-11-04 15:58:31', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('8', 'SDM DAN UMUM', '9.7SL', '2017-11-04 15:58:41', '2017-11-04 15:58:41', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('9', 'TRANSFORMASI BISNIS', '9.8S', '2017-11-04 15:58:54', '2017-11-04 15:58:54', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('10', 'MANAJEMEN RISIKO', '9.9S', '2017-11-04 15:59:10', '2017-11-04 15:59:10', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('11', 'QUALITY CONTROL', '9.10S', '2017-11-04 15:59:21', '2017-11-04 15:59:21', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('12', 'ERP', '9.11SL', '2017-11-04 15:59:32', '2017-11-04 15:59:32', '1', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('16', 'DIREKTUR UTAMA', 'D.U', '2017-11-09 00:24:50', '2017-11-23 06:53:40', '1', '0', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('17', 'LAIN-LAIN', 'XX', '2017-11-20 03:24:31', '2017-11-20 03:24:31', '0', '4', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('18', 'DIREKTUR KOMERSIL', 'D.K', '2017-11-23 06:54:02', '2017-11-23 06:54:02', '1', '0', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('19', 'DIREKTUR OPERASIONAL', 'D.O', '2017-11-23 06:54:10', '2017-11-23 06:54:10', '1', '0', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('20', 'PG. JATIBARANG', 'JAB', '2017-11-23 07:14:44', '2017-11-23 07:14:44', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('21', 'PG. PANGKA', 'PAN', '2017-11-23 07:15:00', '2017-11-23 07:15:00', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('22', 'PG. SUMBERHARJO', 'SBJ', '2017-11-23 07:15:12', '2017-11-23 07:15:12', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('23', 'PG. SRAGI', 'SRA', '2017-11-23 07:15:21', '2017-11-23 07:15:21', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('24', 'PG. RENDENG', 'REN', '2017-11-23 07:15:35', '2017-11-23 07:15:35', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('25', 'PG. MOJO', 'MJO', '2017-11-23 07:15:42', '2017-11-23 07:15:42', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('26', 'PG. TASIKMADU', 'TAS', '2017-11-23 07:15:50', '2017-11-23 07:15:50', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('27', 'PG. GONDANG BARU', 'GDB', '2017-11-23 07:15:58', '2017-11-23 07:15:58', '1', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('28', 'KEPALA BAGIAN KANTOR DIREKSI', 'PJP', '2018-01-18 02:35:53', '2018-01-18 02:35:53', '0', '1', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('29', 'MANAGER PG', 'MGR.PG', '2018-01-18 02:37:16', '2018-01-18 02:37:16', '0', '2', 'Y');
INSERT INTO "public"."tbl_bagian" VALUES ('30', 'KARYAWAN/KARYAWATI PTPN IX', 'ALL', '2018-01-18 02:38:19', '2018-01-18 02:38:19', '0', '4', 'Y');

-- ----------------------------
-- Table structure for tbl_disposisi_direksi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_disposisi_direksi";
CREATE TABLE "public"."tbl_disposisi_direksi" (
"id_disposisi_direksi" int4 DEFAULT nextval('tbl_disposisi_direksi_id_disposisi_direksi_seq'::regclass) NOT NULL,
"nama_disposisi" varchar(100) COLLATE "default" NOT NULL,
"status_aktif" char(1) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_disposisi_direksi
-- ----------------------------
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('1', 'DISETUJUI', 'Y', '2017-12-28 08:14:15', '2018-01-18 04:52:10');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('2', 'MENDAPAT PERHATIAN', 'Y', '2017-12-28 08:14:31', '2017-12-28 08:14:31');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('3', 'TIDAK DISETUJUI / DIMAKLUMI', 'Y', '2017-12-28 08:14:50', '2017-12-28 08:14:50');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('4', 'DIHADIRI', 'Y', '2017-12-28 08:14:59', '2017-12-28 08:14:59');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('5', 'DITELITI LEBIH LANJUT', 'Y', '2017-12-28 08:15:07', '2017-12-28 08:15:07');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('6', 'SELANJUTNYA DISELESAIKAN', 'Y', '2017-12-28 08:15:20', '2017-12-28 08:15:20');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('7', 'PERTIMBANGAN / SARAN', 'Y', '2017-12-28 08:15:35', '2017-12-28 08:15:35');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('8', 'BAHAS DENGAN KAMI', 'Y', '2017-12-28 08:15:45', '2017-12-28 08:15:45');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('9', 'DIEDARKAN', 'Y', '2017-12-28 08:15:50', '2017-12-28 08:15:50');
INSERT INTO "public"."tbl_disposisi_direksi" VALUES ('10', 'FILE', 'Y', '2017-12-28 08:15:56', '2017-12-28 08:15:56');

-- ----------------------------
-- Table structure for tbl_golongan
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_golongan";
CREATE TABLE "public"."tbl_golongan" (
"id_golongan" int4 DEFAULT nextval('tbl_golongan_id_golongan_seq'::regclass) NOT NULL,
"nama_golongan" varchar(100) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_golongan" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_golongan
-- ----------------------------
INSERT INTO "public"."tbl_golongan" VALUES ('1', 'BOD', '2017-11-09 00:32:13', '2018-01-18 04:48:38', 'Y');
INSERT INTO "public"."tbl_golongan" VALUES ('2', 'IV A - IV D', '2017-11-05 12:29:28', '2018-01-01 06:44:43', 'Y');
INSERT INTO "public"."tbl_golongan" VALUES ('3', 'III A - III D', '2017-11-05 12:29:36', '2018-01-01 06:44:46', 'Y');
INSERT INTO "public"."tbl_golongan" VALUES ('4', 'II A - II D', '2017-11-05 12:29:43', '2018-01-01 06:44:50', 'Y');
INSERT INTO "public"."tbl_golongan" VALUES ('5', 'I A - I D', '2017-12-14 08:06:42', '2018-01-01 06:44:54', 'Y');

-- ----------------------------
-- Table structure for tbl_hakakses
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_hakakses";
CREATE TABLE "public"."tbl_hakakses" (
"id_hakakses" int4 DEFAULT nextval('tbl_hakakses_id_hakakses_seq'::regclass) NOT NULL,
"nama_hakakses" varchar(100) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_hakakses" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_hakakses
-- ----------------------------
INSERT INTO "public"."tbl_hakakses" VALUES ('1', 'ADMINISTRATOR', '2017-11-07 05:14:36', '2018-01-01 07:32:58', 'Y');
INSERT INTO "public"."tbl_hakakses" VALUES ('2', 'SEKPER', '2017-11-07 05:14:47', '2018-01-01 07:33:04', 'Y');
INSERT INTO "public"."tbl_hakakses" VALUES ('3', 'PENGGUNA', '2017-11-07 05:14:53', '2018-01-01 07:33:07', 'Y');
INSERT INTO "public"."tbl_hakakses" VALUES ('4', 'UMUM', '2017-11-07 05:14:56', '2018-01-01 07:33:12', 'Y');
INSERT INTO "public"."tbl_hakakses" VALUES ('5', 'PERSONALIA', '2017-12-21 06:56:27', '2018-01-01 07:33:16', 'Y');

-- ----------------------------
-- Table structure for tbl_jabatan
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_jabatan";
CREATE TABLE "public"."tbl_jabatan" (
"id_jabatan" int4 DEFAULT nextval('tbl_jabatan_id_jabatan_seq'::regclass) NOT NULL,
"nama_jabatan" varchar(50) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_jabatan" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_jabatan
-- ----------------------------
INSERT INTO "public"."tbl_jabatan" VALUES ('2', 'DIREKTUR UTAMA', '2017-11-05 05:09:03', '2018-01-18 04:47:56', 'Y');
INSERT INTO "public"."tbl_jabatan" VALUES ('3', 'DIREKTUR KOMERSIL', '2017-11-05 05:10:55', '2018-01-01 06:27:38', 'Y');
INSERT INTO "public"."tbl_jabatan" VALUES ('4', 'DIREKTUR OPERASIONAL', '2017-11-05 12:10:21', '2018-01-01 06:27:44', 'Y');
INSERT INTO "public"."tbl_jabatan" VALUES ('5', 'KEPALA BAGIAN', '2017-11-05 12:10:33', '2018-01-01 06:27:50', 'Y');
INSERT INTO "public"."tbl_jabatan" VALUES ('6', 'KEPALA SUB BAGIAN / ASISTEN KEPALA', '2017-11-05 12:10:51', '2018-01-01 06:27:58', 'Y');
INSERT INTO "public"."tbl_jabatan" VALUES ('7', 'ASISTEN', '2017-11-05 12:11:13', '2018-01-01 06:28:08', 'Y');
INSERT INTO "public"."tbl_jabatan" VALUES ('8', 'PELAKSANA', '2017-11-05 12:11:19', '2018-01-01 06:28:12', 'Y');

-- ----------------------------
-- Table structure for tbl_jenis_surat
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_jenis_surat";
CREATE TABLE "public"."tbl_jenis_surat" (
"id_jenis_surat" int4 DEFAULT nextval('tbl_jenis_surat_id_jenis_surat_seq'::regclass) NOT NULL,
"nama_jenis" varchar(100) COLLATE "default" NOT NULL,
"kode_jenis" varchar(20) COLLATE "default" NOT NULL,
"deskripsi" varchar(150) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_jenis" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_jenis_surat
-- ----------------------------
INSERT INTO "public"."tbl_jenis_surat" VALUES ('2', 'EKSTERNAL', 'X', 'SURAT MASUK LANGSUNG KEPADA DIREKSI YANG BERASAL DARI EKSTERNAL PERUSAHAAN', '2017-12-14 08:01:23', '2018-01-18 04:51:06', 'Y');
INSERT INTO "public"."tbl_jenis_surat" VALUES ('3', 'LAIN-LAIN', 'L', 'SURAT KELUAR DIREKSI', '2017-12-14 08:01:53', '2018-01-01 07:49:09', 'Y');
INSERT INTO "public"."tbl_jenis_surat" VALUES ('4', 'MEMO', 'M', 'SURAT MASUK LANGSUNG KEPADA DIREKSI YANG BERASAL DARI INTERNAL', '2017-12-14 08:05:27', '2018-01-01 07:49:00', 'Y');

-- ----------------------------
-- Table structure for tbl_karyawan
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_karyawan";
CREATE TABLE "public"."tbl_karyawan" (
"id_karyawan" int4 DEFAULT nextval('tbl_karyawan_id_karyawan_seq'::regclass) NOT NULL,
"nama_karyawan" varchar(150) COLLATE "default" NOT NULL,
"tanggal_lahir" date NOT NULL,
"tanggal_karyawan" date NOT NULL,
"jenis_kelamin" int4 NOT NULL,
"id_bagian" int4 NOT NULL,
"id_jabatan" int4 NOT NULL,
"id_golongan" int4 NOT NULL,
"id_pendidikan" int4 NOT NULL,
"status_karyawan" int4 NOT NULL,
"status_konseptor" int4 NOT NULL,
"foto" text COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"email" varchar(150) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_karyawan
-- ----------------------------
INSERT INTO "public"."tbl_karyawan" VALUES ('9', 'BUDI ADI PRABOWO', '2017-11-10', '2017-11-10', '1', '16', '2', '1', '5', '2', '2', 'BUDIADIPRABOWO@PTPN09COM.jpg', '2017-11-10 03:54:20', '2017-11-10 03:54:20', 'BUDIADIPRABOWO@PTPN09.COM');
INSERT INTO "public"."tbl_karyawan" VALUES ('10', 'HERRY TRIYATNO', '2017-11-10', '2017-11-10', '1', '16', '3', '1', '5', '1', '2', 'HERRYTRIYATNO@PTPN09COM.jpg', '2017-11-10 04:13:17', '2017-11-10 04:13:17', 'HERRYTRIYATNO@PTPN09.COM');
INSERT INTO "public"."tbl_karyawan" VALUES ('11', 'ADITYA RIZKY DINNA CAHYA', '1991-08-07', '2014-04-01', '1', '1', '7', '3', '4', '1', '1', 'rizky791@gmailcom.png', '2017-11-10 04:18:16', '2017-11-10 04:18:16', 'rizky791@gmail.com');
INSERT INTO "public"."tbl_karyawan" VALUES ('12', 'ALFIAN ANGGA PRADIKA', '2017-12-14', '2017-12-14', '1', '12', '7', '3', '4', '2', '1', 'alfian@gmailcom.png', '2017-12-14 08:27:05', '2017-12-14 08:27:05', 'alfian@gmail.com');
INSERT INTO "public"."tbl_karyawan" VALUES ('13', 'SAIFUL M MUTTAQIEN', '2018-02-15', '2018-02-15', '1', '9', '7', '3', '4', '1', '1', 'saiful@gmailcom.png', '2018-02-15 01:32:01', '2018-02-15 01:32:01', 'saiful@gmail.com');

-- ----------------------------
-- Table structure for tbl_klasifikasi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_klasifikasi";
CREATE TABLE "public"."tbl_klasifikasi" (
"id_klas" int4 DEFAULT nextval('tbl_mid_klasifikasi_id_mid_klas_seq'::regclass) NOT NULL,
"id_top_klas" int4 NOT NULL,
"kode_klas" varchar(10) COLLATE "default" NOT NULL,
"nama_klas" text COLLATE "default" NOT NULL,
"status_klas" varchar(1) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"id_retensi_aktif" int4,
"id_retensi_inaktif" int4,
"id_retensi_ket" int4,
"id_level" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_klasifikasi
-- ----------------------------
INSERT INTO "public"."tbl_klasifikasi" VALUES ('1', '26', 'UPT.01', '<p>Laporan Keuangan dan Kinerja Bulanan :</p><ol><li>Perusahaan Patungan</li><li>Anak Perusahaan<br></li></ol>', 'Y', '2018-02-02 03:24:11', '2018-02-02 03:24:11', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('2', '26', 'UPT.02', 'Laporan Evaluasi Keuangan dan Kinerja :<br><ol><li>Perusahaan Patungan</li><li>Anak Perusahaan<br></li></ol>', 'Y', '2018-02-02 03:24:45', '2018-02-02 03:24:45', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('3', '26', 'UPT.03', 'Pra Rapat Umum Pemegang Saham (RUPS) :<br><ol><li>Risalah RUPS<br></li></ol>', 'Y', '2018-02-02 03:25:10', '2018-02-02 03:25:10', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('4', '26', 'UPT.04', '<p>Rapat Umum Pemegang Saham (RUPS) :</p><ol><li>Daftar Hadir</li><li>Risalah RUPS</li><li>Keputusan Pemegang Saham<br></li></ol>', 'Y', '2018-02-02 03:35:30', '2018-02-02 03:35:30', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('5', '26', 'UPT.05', 'Rapat Umum Pemegang Saham Luar Biasa (RUPS LB)<br>', 'Y', '2018-02-02 03:36:09', '2018-02-02 03:36:09', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('6', '26', 'UPT.06', 'Buku Evaluasi Kinerja Usaha Patungan Tahunan<br>', 'Y', '2018-02-02 03:36:23', '2018-02-02 03:36:23', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('7', '27', 'HMS.01', 'Keorganisasian', 'Y', '2018-02-02 03:36:58', '2018-02-02 03:36:58', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('8', '27', 'HMS.01.01', '<p>Struktur Organisasi<br></p>', 'Y', '2018-02-02 03:43:10', '2018-02-02 03:43:10', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('9', '27', 'HMS.01.02', 'Dewan Komisaris<br>', 'Y', '2018-02-02 03:43:19', '2018-02-02 03:43:19', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('10', '27', 'HMS.02', 'Atribut Perusahaan<br>', 'Y', '2018-02-02 03:43:43', '2018-02-02 03:43:43', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('11', '27', 'HMS.02.01', 'Logo dan Papan Nama<br>', 'Y', '2018-02-02 03:43:59', '2018-02-02 03:43:59', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('12', '27', 'HMS.02.02', 'Visi, Misi dan Budaya Perusahaan<br>', 'Y', '2018-02-02 03:44:11', '2018-02-02 03:44:11', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('13', '27', 'HMS.03', '<p>Dokumentasi, Publikasi, dan Penerbitan<br></p>', 'Y', '2018-02-02 03:58:25', '2018-02-02 03:58:25', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('14', '27', 'HMS.03.01', '<p>Audio Visual<br></p>', 'Y', '2018-02-02 03:59:03', '2018-02-02 03:59:03', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('15', '27', 'HMS.03.02', 'Media Internal :<br><ol><li>Majalah info 9</li><li>dll<br></li></ol>', 'Y', '2018-02-02 03:59:35', '2018-02-02 03:59:35', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('16', '27', 'HMS.03.03', 'Promosi :<br><ol><li>Company Profile</li><li>Brosur</li><li>dll<br></li></ol>', 'Y', '2018-02-02 04:00:26', '2018-02-02 04:00:26', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('17', '27', 'HMS.03.04', 'Peliputan :<br><ol><li>Internal</li><li>Eksternal<br></li></ol>', 'Y', '2018-02-02 04:00:47', '2018-02-02 04:00:47', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('18', '27', 'HMS.03.05', 'Hosting (website)<br>', 'Y', '2018-02-02 04:01:01', '2018-02-02 04:01:01', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('19', '27', 'HMS.03.06', 'Pameran', 'Y', '2018-02-02 04:01:06', '2018-02-02 04:01:06', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('20', '27', 'HMS.03.07', 'Sponsorship', 'Y', '2018-02-02 04:01:18', '2018-02-02 04:01:18', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('21', '27', 'HMS.04', '<p>Laporan Kegiatan Sekretaris Perusahaan<br></p>', 'Y', '2018-02-02 04:05:33', '2018-02-02 04:05:33', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('22', '27', 'HMS.05', 'Rapat', 'Y', '2018-02-02 04:05:44', '2018-02-02 04:05:44', null, null, null, '1');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('23', '27', 'HMS.05.01', '<p>Rapat Direksi / Dewan Komisaris<br></p>', 'Y', '2018-02-02 04:06:22', '2018-02-02 04:06:22', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('24', '27', 'HMS.05.02', 'Rapat Dengar Pendapat / Hearing DPR<br>', 'Y', '2018-02-02 04:06:41', '2018-02-02 04:06:41', '1', '1', '1', '2');
INSERT INTO "public"."tbl_klasifikasi" VALUES ('25', '27', 'HMS.05.03', 'Rapat Kerja / Rapat Dinas / Rapat<br>', 'Y', '2018-02-02 04:06:55', '2018-02-02 04:06:55', '1', '1', '1', '2');

-- ----------------------------
-- Table structure for tbl_masakerja
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_masakerja";
CREATE TABLE "public"."tbl_masakerja" (
"id_masakerja" int4 DEFAULT nextval('tbl_masakerja_id_masakerja_seq'::regclass) NOT NULL,
"nama_masakerja" varchar(100) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_masakerja" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_masakerja
-- ----------------------------
INSERT INTO "public"."tbl_masakerja" VALUES ('1', '< 3 TAHUN1', '2017-11-05 12:46:39', '2018-01-18 04:49:15', 'Y');
INSERT INTO "public"."tbl_masakerja" VALUES ('2', '3 - 5 TAHUN', '2017-11-05 12:46:47', '2018-01-01 06:52:38', 'Y');
INSERT INTO "public"."tbl_masakerja" VALUES ('3', '6 - 10 TAHUN', '2017-11-05 12:46:55', '2018-01-01 06:52:43', 'Y');
INSERT INTO "public"."tbl_masakerja" VALUES ('4', '11 - 15 TAHUN', '2017-11-05 12:47:06', '2018-01-01 06:52:48', 'Y');
INSERT INTO "public"."tbl_masakerja" VALUES ('5', '16 - 20 TAHUN', '2017-11-05 12:47:12', '2018-01-01 06:52:52', 'Y');
INSERT INTO "public"."tbl_masakerja" VALUES ('6', '> 20 TAHUN', '2017-11-05 12:47:18', '2018-01-01 06:52:56', 'Y');

-- ----------------------------
-- Table structure for tbl_pendidikan
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_pendidikan";
CREATE TABLE "public"."tbl_pendidikan" (
"id_pendidikan" int4 DEFAULT nextval('tbl_pendidikan_id_pendidikan_seq'::regclass) NOT NULL,
"nama_pendidikan" varchar(50) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_pendidikan" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_pendidikan
-- ----------------------------
INSERT INTO "public"."tbl_pendidikan" VALUES ('1', 'SD', '2017-11-06 04:28:57', '2018-01-18 04:49:46', 'Y');
INSERT INTO "public"."tbl_pendidikan" VALUES ('2', 'SMP', '2017-11-06 04:29:08', '2018-01-01 07:19:17', 'Y');
INSERT INTO "public"."tbl_pendidikan" VALUES ('3', 'SMA', '2017-11-06 04:29:11', '2018-01-01 07:19:21', 'Y');
INSERT INTO "public"."tbl_pendidikan" VALUES ('4', 'SARJANA (S1)', '2017-11-06 04:29:28', '2018-01-01 07:19:26', 'Y');
INSERT INTO "public"."tbl_pendidikan" VALUES ('5', 'MAGISTER (S2)', '2017-11-06 04:29:44', '2018-01-01 07:19:30', 'Y');
INSERT INTO "public"."tbl_pendidikan" VALUES ('6', 'DOKTOR (S3)', '2017-11-06 04:29:53', '2018-01-01 07:19:34', 'Y');

-- ----------------------------
-- Table structure for tbl_retensi_aktif
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_retensi_aktif";
CREATE TABLE "public"."tbl_retensi_aktif" (
"id_retensi_aktif" int4 DEFAULT nextval('tbl_retensi_aktif_id_retensi_aktif_seq'::regclass) NOT NULL,
"nama_retensi" varchar(150) COLLATE "default" NOT NULL,
"status_retensi" varchar(1) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_retensi_aktif
-- ----------------------------
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('1', '1 TAHUN', 'Y', '2018-01-31 07:54:38', '2018-01-31 07:54:38');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('2', '2 TAHUN', 'Y', '2018-01-31 07:54:51', '2018-01-31 07:54:51');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('3', '3 TAHUN', 'Y', '2018-01-31 07:55:06', '2018-01-31 07:55:06');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('4', '4 TAHUN', 'Y', '2018-01-31 07:55:26', '2018-01-31 07:56:36');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('5', '5 TAHUN', 'Y', '2018-01-31 07:56:41', '2018-01-31 07:56:41');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('6', '10 TAHUN', 'Y', '2018-01-31 08:00:29', '2018-01-31 08:00:29');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('7', 'SETELAH DIUPDATE KEMBALI', 'Y', '2018-01-31 08:01:21', '2018-01-31 08:01:21');
INSERT INTO "public"."tbl_retensi_aktif" VALUES ('8', 'SELAMA BERLAKU', 'Y', '2018-01-31 08:01:37', '2018-01-31 08:01:37');

-- ----------------------------
-- Table structure for tbl_retensi_inaktif
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_retensi_inaktif";
CREATE TABLE "public"."tbl_retensi_inaktif" (
"id_retensi_inaktif" int4 DEFAULT nextval('tbl_retensi_inaktif_id_retensi_inaktif_seq'::regclass) NOT NULL,
"nama_retensi" varchar(150) COLLATE "default" NOT NULL,
"status_retensi" varchar(1) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_retensi_inaktif
-- ----------------------------
INSERT INTO "public"."tbl_retensi_inaktif" VALUES ('1', '1 TAHUN', 'Y', '2018-01-31 08:16:41', '2018-01-31 08:16:41');
INSERT INTO "public"."tbl_retensi_inaktif" VALUES ('2', '2 TAHUN', 'Y', '2018-01-31 08:16:49', '2018-01-31 08:16:49');
INSERT INTO "public"."tbl_retensi_inaktif" VALUES ('3', '3 TAHUN', 'Y', '2018-01-31 08:16:52', '2018-01-31 08:16:52');
INSERT INTO "public"."tbl_retensi_inaktif" VALUES ('4', '4 TAHUN', 'Y', '2018-01-31 08:16:56', '2018-01-31 08:16:56');
INSERT INTO "public"."tbl_retensi_inaktif" VALUES ('5', '5 TAHUN', 'Y', '2018-01-31 08:17:00', '2018-01-31 08:18:33');

-- ----------------------------
-- Table structure for tbl_retensi_keterangan
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_retensi_keterangan";
CREATE TABLE "public"."tbl_retensi_keterangan" (
"id_retensi_ket" int4 DEFAULT nextval('tbl_retensi_keterangan_id_retensi_ket_seq'::regclass) NOT NULL,
"nama_ket" varchar(150) COLLATE "default" NOT NULL,
"status_ket" varchar(1) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_retensi_keterangan
-- ----------------------------
INSERT INTO "public"."tbl_retensi_keterangan" VALUES ('1', 'MUSNAH', 'Y', '2018-02-01 05:01:00', '2018-02-01 05:04:07');
INSERT INTO "public"."tbl_retensi_keterangan" VALUES ('2', 'PERMANAN', 'Y', '2018-02-01 05:01:06', '2018-02-01 05:01:06');
INSERT INTO "public"."tbl_retensi_keterangan" VALUES ('3', 'DINILAI KEMBALI', 'Y', '2018-02-01 05:01:25', '2018-02-01 05:01:25');
INSERT INTO "public"."tbl_retensi_keterangan" VALUES ('4', 'MUSNAH KECUALI DESEMBER (DEFINITIF PERMANEN)', 'Y', '2018-02-01 05:02:15', '2018-02-01 05:02:15');
INSERT INTO "public"."tbl_retensi_keterangan" VALUES ('5', 'SK MASUK BERKAS PERSEORANGAN', 'Y', '2018-02-01 05:02:46', '2018-02-01 05:02:46');
INSERT INTO "public"."tbl_retensi_keterangan" VALUES ('6', 'MUSNAH KECUALI DIREKTUR DAN PEGAWAI YANG BERJASA TERLIBAT PERISTIWA BERSKALA NASIONAL DISIMPAN PERMANEN', 'Y', '2018-02-01 05:03:51', '2018-02-01 05:03:51');

-- ----------------------------
-- Table structure for tbl_sifat_surat
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_sifat_surat";
CREATE TABLE "public"."tbl_sifat_surat" (
"id_sifat_surat" int4 DEFAULT nextval('tbl_sifat_surat_id_sifat_surat_seq'::regclass) NOT NULL,
"nama_sifat" varchar(100) COLLATE "default" NOT NULL,
"kode_sifat" varchar(20) COLLATE "default" NOT NULL,
"deskripsi" varchar(150) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"status_sifat" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_sifat_surat
-- ----------------------------
INSERT INTO "public"."tbl_sifat_surat" VALUES ('1', 'BIASA', 'BSA', 'SURAT YANG BERSIFAT UMUM', '2017-12-15 01:14:50', '2018-01-01 08:04:24', 'Y');
INSERT INTO "public"."tbl_sifat_surat" VALUES ('2', 'RAHASIA', 'RHS', 'SURAT YANG BERSIFAT UMUM', '2017-12-15 01:15:04', '2018-01-01 08:04:19', 'Y');

-- ----------------------------
-- Table structure for tbl_sk_eksternal
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_sk_eksternal";
CREATE TABLE "public"."tbl_sk_eksternal" (
"id_sk_eksternal" int4 DEFAULT nextval('tbl_sk_eksternal_id_sk_eksternal_seq'::regclass) NOT NULL,
"id_bagian" int4 NOT NULL,
"id_klasifikasi" int4 NOT NULL,
"nomor_surat" varchar(100) COLLATE "default" NOT NULL,
"tanggal_surat" date NOT NULL,
"sifat_surat" varchar(3) COLLATE "default" NOT NULL,
"nama_tujuan" text COLLATE "default" NOT NULL,
"perihal" text COLLATE "default" NOT NULL,
"id_pembuat" int4 NOT NULL,
"id_konseptor" int4 NOT NULL,
"tindasan" varchar(50) COLLATE "default" NOT NULL,
"path_surat" text COLLATE "default",
"hak_akses" int4 NOT NULL,
"tahun_surat" int4 NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_sk_eksternal
-- ----------------------------
INSERT INTO "public"."tbl_sk_eksternal" VALUES ('1', '1', '1', 'UPT.01/2/9.0SL/2018', '2018-02-05', '1', 'ASD1232132131', 'ASDASDASDASD', '1', '11', '4', null, '1', '2018', '2018-02-05 04:32:41', '2018-02-05 04:56:43');
INSERT INTO "public"."tbl_sk_eksternal" VALUES ('2', '1', '1', 'UPT.01/3/9.0SL/2018', '2018-02-05', '1', 'JGHJGHJ', 'GHJGHJGHJ', '1', '11', '1,4,7', null, '1', '2018', '2018-02-05 05:27:49', '2018-02-05 05:27:49');
INSERT INTO "public"."tbl_sk_eksternal" VALUES ('3', '1', '2', 'UPT.02/5/9.0SL/2018', '2018-02-05', '1', 'AS', 'AS', '1', '11', '', null, '1', '2018', '2018-02-05 05:29:09', '2018-02-05 05:30:23');
INSERT INTO "public"."tbl_sk_eksternal" VALUES ('4', '1', '2', 'UPT.02/6/9.0SL/2018', '2018-02-05', '1', '123', '1231231231231', '1', '11', '19', null, '1', '2018', '2018-02-05 05:51:27', '2018-02-05 05:51:45');

-- ----------------------------
-- Table structure for tbl_sk_internal
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_sk_internal";
CREATE TABLE "public"."tbl_sk_internal" (
"id_surat_keluar" int4 DEFAULT nextval('tbl_surat_keluar_id_surat_keluar_seq'::regclass) NOT NULL,
"id_bagian" int4 NOT NULL,
"id_klasifikasi" int4 NOT NULL,
"nomor_surat" varchar(100) COLLATE "default" NOT NULL,
"tanggal_surat" date NOT NULL,
"sifat_surat" varchar(3) COLLATE "default" NOT NULL,
"id_tujuan" varchar(70) COLLATE "default" NOT NULL,
"perihal" text COLLATE "default" NOT NULL,
"id_pembuat" int4 NOT NULL,
"id_konseptor" int4 NOT NULL,
"tindasan" varchar(50) COLLATE "default",
"path_surat" text COLLATE "default",
"created_at" timestamp(0),
"updated_at" timestamp(0),
"hak_akses" int4,
"status_agenda" char(1) COLLATE "default",
"tahun_surat" int4,
"status_agenda_dir" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_sk_internal
-- ----------------------------
INSERT INTO "public"."tbl_sk_internal" VALUES ('19', '1', '2', 'UPT.02/1/9.0SL/2018', '2018-02-02', '1', '16,18', 'ASD', '1', '11', '', null, '2018-02-02 07:09:55', '2018-02-09 06:22:45', '1', 'Y', '2018', '1');
INSERT INTO "public"."tbl_sk_internal" VALUES ('20', '1', '2', 'UPT.02/2/9.0SL/2018', '2018-02-02', '1', '16,18', 'ASDADS', '1', '11', '5,6', null, '2018-02-02 07:11:53', '2018-02-09 06:23:28', '1', 'Y', '2018', '1');
INSERT INTO "public"."tbl_sk_internal" VALUES ('21', '1', '2', 'UPT.02/3/9.0SL/2018', '2018-02-02', '1', ',4', 'ASDASD2313123213', '1', '11', '', null, '2018-02-02 07:12:06', '2018-02-06 01:05:18', '1', 'Y', '2018', '0');
INSERT INTO "public"."tbl_sk_internal" VALUES ('22', '1', '4', 'UPT.04/1/9.0SL/2018', '2018-02-05', '1', '5', '123213213', '1', '11', '', null, '2018-02-05 01:51:43', '2018-02-05 08:24:19', '1', 'Y', '2018', '0');
INSERT INTO "public"."tbl_sk_internal" VALUES ('23', '1', '2', 'UPT.02/4/9.0SL/2018', '2018-02-05', '1', '3', '6867876', '1', '11', '3,4', null, '2018-02-05 01:52:19', '2018-02-05 08:26:48', '1', 'Y', '2018', '0');
INSERT INTO "public"."tbl_sk_internal" VALUES ('24', '1', '1', 'UPT.01/1/9.0SL/2018', '2018-02-05', '1', '18,27', 'ASDASDASDAS', '1', '11', ',19', null, '2018-02-05 01:53:48', '2018-02-09 06:19:36', '1', 'Y', '2018', '1');
INSERT INTO "public"."tbl_sk_internal" VALUES ('25', '1', '1', 'UPT.01/4/9.0SL/2018', '2018-02-06', '1', '16,18,19,1', 'ASDASDASDAS', '1', '11', '2', null, '2018-02-06 01:08:19', '2018-02-09 06:24:18', '1', 'Y', '2018', '1');
INSERT INTO "public"."tbl_sk_internal" VALUES ('26', '1', '2', 'UPT.02/7/9.0SL/2018', '2018-02-09', '1', '19', 'ASDASD', '1', '11', '19,3', null, '2018-02-09 06:26:13', '2018-02-09 06:32:08', '1', 'Y', '2018', '0');
INSERT INTO "public"."tbl_sk_internal" VALUES ('27', '1', '1', 'UPT.01/5/9.0SL/2018', '2018-02-09', '1', '16', 'ASDASD', '1', '11', '2', null, '2018-02-09 06:28:20', '2018-02-09 06:32:27', '1', 'Y', '2018', '0');
INSERT INTO "public"."tbl_sk_internal" VALUES ('28', '1', '4', 'UPT.04/2/9.0SL/2018', '2018-02-09', '1', '16,19', 'ADADS', '1', '11', '18', null, '2018-02-09 06:30:50', '2018-02-09 06:32:32', '1', 'Y', '2018', '0');
INSERT INTO "public"."tbl_sk_internal" VALUES ('29', '1', '2', 'UPT.02/8/9.0SL/2018', '2018-02-15', '1', '3', 'ASD', '1', '11', '16', null, '2018-02-15 07:12:46', '2018-02-15 07:12:46', '1', 'N', '2018', '0');

-- ----------------------------
-- Table structure for tbl_sm_eksternal
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_sm_eksternal";
CREATE TABLE "public"."tbl_sm_eksternal" (
"id_sm_eksternal" int4 DEFAULT nextval('tbl_surat_masuk_id_surat_masuk_seq'::regclass) NOT NULL,
"tanggal_agenda" date NOT NULL,
"nomor_agenda" int4 NOT NULL,
"nomor_surat" varchar(100) COLLATE "default" NOT NULL,
"tanggal_surat" date NOT NULL,
"pengirim" text COLLATE "default" NOT NULL,
"id_tujuan" varchar(50) COLLATE "default" NOT NULL,
"perihal" text COLLATE "default" NOT NULL,
"id_klasifikasi" int4 NOT NULL,
"tindasan" varchar(50) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"tahun_surat" int4,
"status_agenda_dir" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_sm_eksternal
-- ----------------------------
INSERT INTO "public"."tbl_sm_eksternal" VALUES ('26', '2018-02-05', '2', 'TN', '2018-02-05', 'ASDASD', '16', 'ASDASDASDASDADASDASDAS', '2', '1,5', '2018-02-05 06:46:45', '2018-02-09 06:16:37', '2018', '1');
INSERT INTO "public"."tbl_sm_eksternal" VALUES ('27', '2018-02-05', '3', 'TN/123', '2018-02-05', '123213', '18', '123213213', '1', '19', '2018-02-05 06:47:51', '2018-02-09 06:19:51', '2018', '1');
INSERT INTO "public"."tbl_sm_eksternal" VALUES ('28', '2018-02-05', '4', 'TES/001/20171111111111111', '2018-02-05', 'DFGDFGDFGDF121212', '16,18,5', 'GHFGHFGHFHGH', '2', '18', '2018-02-05 06:55:46', '2018-02-09 06:19:58', '2018', '1');
INSERT INTO "public"."tbl_sm_eksternal" VALUES ('29', '2018-02-09', '12', 'SEKO NJOBO', '2018-02-09', 'ASDASDASDAD123', '16', 'ASDASDASDA1213213213213213', '2', '18', '2018-02-09 06:25:19', '2018-02-09 06:25:35', '2018', '1');

-- ----------------------------
-- Table structure for tbl_sm_internal
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_sm_internal";
CREATE TABLE "public"."tbl_sm_internal" (
"id_sm_internal" int4 DEFAULT nextval('tbl_sm_internal_id_sm_internal_seq'::regclass) NOT NULL,
"id_sk_internal" int4 NOT NULL,
"tanggal_agenda" date NOT NULL,
"status_agenda_dir" varchar(1) COLLATE "default" NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"nomor_agenda" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_sm_internal
-- ----------------------------
INSERT INTO "public"."tbl_sm_internal" VALUES ('1', '22', '2018-02-05', 'N', '2018-02-05 08:24:19', '2018-02-05 08:24:19', '5');
INSERT INTO "public"."tbl_sm_internal" VALUES ('2', '23', '2018-02-05', 'N', '2018-02-05 08:26:48', '2018-02-05 08:26:48', '6');
INSERT INTO "public"."tbl_sm_internal" VALUES ('3', '24', '2018-02-06', 'N', '2018-02-06 01:05:03', '2018-02-06 01:05:03', '7');
INSERT INTO "public"."tbl_sm_internal" VALUES ('4', '19', '2018-02-06', 'N', '2018-02-06 01:05:08', '2018-02-06 01:05:08', '8');
INSERT INTO "public"."tbl_sm_internal" VALUES ('5', '20', '2018-02-06', 'N', '2018-02-06 01:05:13', '2018-02-06 01:05:13', '9');
INSERT INTO "public"."tbl_sm_internal" VALUES ('6', '21', '2018-02-06', 'N', '2018-02-06 01:05:18', '2018-02-06 01:05:18', '10');
INSERT INTO "public"."tbl_sm_internal" VALUES ('7', '25', '2018-02-06', 'N', '2018-02-06 01:08:50', '2018-02-06 01:08:50', '11');
INSERT INTO "public"."tbl_sm_internal" VALUES ('8', '26', '2018-02-09', 'N', '2018-02-09 06:32:08', '2018-02-09 06:32:08', '13');
INSERT INTO "public"."tbl_sm_internal" VALUES ('9', '27', '2018-02-09', 'N', '2018-02-09 06:32:27', '2018-02-09 06:32:27', '14');
INSERT INTO "public"."tbl_sm_internal" VALUES ('10', '28', '2018-02-09', 'N', '2018-02-09 06:32:32', '2018-02-09 06:32:32', '15');

-- ----------------------------
-- Table structure for tbl_temp_agenda_direksi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_temp_agenda_direksi";
CREATE TABLE "public"."tbl_temp_agenda_direksi" (
"id_temp_agenda" int4 DEFAULT nextval('tbl_temp_agenda_langsung_id_temp_agenda_seq'::regclass) NOT NULL,
"id_direksi" int4 NOT NULL,
"id_jenis_surat" int4 NOT NULL,
"nomor_urut" int4 NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0),
"tahun" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_temp_agenda_direksi
-- ----------------------------
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('1', '16', '4', '4', '2017-12-18 03:49:28', '2017-12-29 07:59:57', '2017');
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('2', '18', '3', '1', '2017-12-18 03:56:54', '2017-12-18 03:56:54', '2017');
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('3', '16', '3', '2', '2017-12-18 04:00:27', '2017-12-29 08:00:13', '2017');
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('4', '18', '2', '2', '2017-12-18 04:00:42', '2017-12-29 07:59:34', '2017');
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('5', '19', '4', '1', '2017-12-29 07:58:14', '2017-12-29 07:58:14', '2017');
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('6', '16', '2', '17', '2018-01-04 04:09:32', '2018-02-09 06:25:35', '2018');
INSERT INTO "public"."tbl_temp_agenda_direksi" VALUES ('7', '18', '4', '2', '2018-01-04 04:50:53', '2018-01-04 05:47:02', '2018');

-- ----------------------------
-- Table structure for tbl_temp_bot_klas
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_temp_bot_klas";
CREATE TABLE "public"."tbl_temp_bot_klas" (
"id_bot_klas" int4 DEFAULT nextval('tbl_temp_bot_klas_id_bot_klas_seq'::regclass) NOT NULL,
"id_mid_klas" int4 NOT NULL,
"urutan" int4 NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_temp_bot_klas
-- ----------------------------
INSERT INTO "public"."tbl_temp_bot_klas" VALUES ('1', '7', '2', '2018-02-02 03:43:10', '2018-02-02 03:43:19');
INSERT INTO "public"."tbl_temp_bot_klas" VALUES ('2', '10', '2', '2018-02-02 03:43:59', '2018-02-02 03:44:11');
INSERT INTO "public"."tbl_temp_bot_klas" VALUES ('3', '13', '7', '2018-02-02 03:59:03', '2018-02-02 04:01:18');
INSERT INTO "public"."tbl_temp_bot_klas" VALUES ('4', '22', '3', '2018-02-02 04:06:22', '2018-02-02 04:06:55');

-- ----------------------------
-- Table structure for tbl_temp_mid_klas
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_temp_mid_klas";
CREATE TABLE "public"."tbl_temp_mid_klas" (
"id_mid_klas" int4 DEFAULT nextval('tbl_temp_mid_klas_id_mid_klas_seq'::regclass) NOT NULL,
"id_top_klas" int4 NOT NULL,
"urutan" int4 NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_temp_mid_klas
-- ----------------------------
INSERT INTO "public"."tbl_temp_mid_klas" VALUES ('1', '26', '6', '2018-02-02 03:24:11', '2018-02-02 03:36:23');
INSERT INTO "public"."tbl_temp_mid_klas" VALUES ('2', '27', '5', '2018-02-02 03:36:58', '2018-02-02 04:05:44');

-- ----------------------------
-- Table structure for tbl_temp_surat_keluar
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_temp_surat_keluar";
CREATE TABLE "public"."tbl_temp_surat_keluar" (
"id_temp_surat_keluar" int4 DEFAULT nextval('tbl_temp_surat_keluar_id_temp_surat_keluar_seq'::regclass) NOT NULL,
"id_klasifikasi" int4 NOT NULL,
"tahun" int4 NOT NULL,
"nomor_urut" int4 NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_temp_surat_keluar
-- ----------------------------
INSERT INTO "public"."tbl_temp_surat_keluar" VALUES ('12', '2', '2018', '8', '2018-02-02 07:09:55', '2018-02-15 07:12:46');
INSERT INTO "public"."tbl_temp_surat_keluar" VALUES ('13', '4', '2018', '2', '2018-02-05 01:51:43', '2018-02-09 06:30:50');
INSERT INTO "public"."tbl_temp_surat_keluar" VALUES ('14', '1', '2018', '5', '2018-02-05 01:53:48', '2018-02-09 06:28:20');
INSERT INTO "public"."tbl_temp_surat_keluar" VALUES ('15', '7', '2018', '1', '2018-02-05 04:29:31', '2018-02-05 04:29:31');

-- ----------------------------
-- Table structure for tbl_temp_surat_masuk
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_temp_surat_masuk";
CREATE TABLE "public"."tbl_temp_surat_masuk" (
"id_temp_surat_masuk" int4 DEFAULT nextval('tbl_temp_surat_masuk_id_temp_surat_masuk_seq'::regclass) NOT NULL,
"tahun" int4 NOT NULL,
"nomor_urut" int4 NOT NULL,
"created_at" timestamp(0),
"updated_at" timestamp(0)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_temp_surat_masuk
-- ----------------------------
INSERT INTO "public"."tbl_temp_surat_masuk" VALUES ('2', '2018', '15', '2018-02-05 06:45:21', '2018-02-09 06:32:32');

-- ----------------------------
-- Table structure for tbl_top_klasifikasi
-- ----------------------------
DROP TABLE IF EXISTS "public"."tbl_top_klasifikasi";
CREATE TABLE "public"."tbl_top_klasifikasi" (
"id_parent" int4 DEFAULT nextval('tbl_parent_klasifikasi_id_parent_seq'::regclass) NOT NULL,
"kode_parent" varchar(10) COLLATE "default" NOT NULL,
"deskripsi_parent" varchar(150) COLLATE "default" NOT NULL,
"status_top_klas" char(1) COLLATE "default",
"created_at" timestamp(6),
"updated_at" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tbl_top_klasifikasi
-- ----------------------------
INSERT INTO "public"."tbl_top_klasifikasi" VALUES ('26', 'UPT', 'USAHA PATUNGAN', 'Y', '2018-02-02 03:22:36', '2018-02-02 03:22:36');
INSERT INTO "public"."tbl_top_klasifikasi" VALUES ('27', 'HMS', 'HUMAS', 'Y', '2018-02-02 03:23:14', '2018-02-02 03:23:14');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
"id" int4 DEFAULT nextval('users_id_seq'::regclass) NOT NULL,
"name" varchar(255) COLLATE "default" NOT NULL,
"email" varchar(255) COLLATE "default" NOT NULL,
"password" varchar(255) COLLATE "default" NOT NULL,
"remember_token" varchar(100) COLLATE "default",
"created_at" timestamp(0),
"updated_at" timestamp(0),
"id_role" int4,
"id_karyawan" int4,
"id_bagian" int4,
"status_pengguna" char(1) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES ('1', 'ADITYA RIZKY DINNA CAHYA', 'rizky791@gmail.com', '$2y$10$NlaqEBs4T/Cv0MogmuKM2O298LGqYNnOZFONOU99nMKwBZXXj3erW', 'pOcsw4aZlHdylDCGH4bjfarhfgKQSHpCDjPGMCprZ9muyiJWU5A93BwSGA7b', '2017-11-03 04:03:00', '2017-11-03 04:03:00', '1', '11', '1', 'Y');
INSERT INTO "public"."users" VALUES ('3', 'ALFIAN ANGGA PRADIKA', 'alfian@gmail.com', '$2y$10$IbODoGHCO3ZjWAkCAytqWunMfMO5cwsAjSeL3wN8IDLo/hHrUojuu', 'obP9ENxXCtfallC66vJCTnQrXspjB7fmUyEJFbui8XQRLxirl2YZNRfnmfTm', '2017-12-22 06:29:23', '2017-12-22 06:29:23', '3', '12', '12', 'Y');
INSERT INTO "public"."users" VALUES ('4', 'SAIFUL M MUTTAQIEN', 'saiful@gmail.com', '$2y$10$Bi3SDp9Yu9HD8zQA3IfZyu3h1vW5saYK3ZAOlEzq/BPy6qn35scbS', '9k3c5P9TusPiV1PUwgEWOC2e9hgU9gx8iHGLAOqNo8kX1G7eNyCGb555mxDd', '2018-02-15 01:33:10', '2018-02-15 01:33:10', '3', '13', '9', null);

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "public"."migrations_id_seq" OWNED BY "migrations"."id";
ALTER SEQUENCE "public"."tbl_agenda_direksi_id_agenda_direksi_seq" OWNED BY "tbl_agenda_direksi"."id_agenda_direksi";
ALTER SEQUENCE "public"."tbl_bagian_id_bagian_seq" OWNED BY "tbl_bagian"."id_bagian";
ALTER SEQUENCE "public"."tbl_disposisi_direksi_id_disposisi_direksi_seq" OWNED BY "tbl_disposisi_direksi"."id_disposisi_direksi";
ALTER SEQUENCE "public"."tbl_golongan_id_golongan_seq" OWNED BY "tbl_golongan"."id_golongan";
ALTER SEQUENCE "public"."tbl_hakakses_id_hakakses_seq" OWNED BY "tbl_hakakses"."id_hakakses";
ALTER SEQUENCE "public"."tbl_jabatan_id_jabatan_seq" OWNED BY "tbl_jabatan"."id_jabatan";
ALTER SEQUENCE "public"."tbl_jenis_surat_id_jenis_surat_seq" OWNED BY "tbl_jenis_surat"."id_jenis_surat";
ALTER SEQUENCE "public"."tbl_karyawan_id_karyawan_seq" OWNED BY "tbl_karyawan"."id_karyawan";
ALTER SEQUENCE "public"."tbl_masakerja_id_masakerja_seq" OWNED BY "tbl_masakerja"."id_masakerja";
ALTER SEQUENCE "public"."tbl_mid_klasifikasi_id_mid_klas_seq" OWNED BY "tbl_klasifikasi"."id_klas";
ALTER SEQUENCE "public"."tbl_parent_klasifikasi_id_parent_seq" OWNED BY "tbl_top_klasifikasi"."id_parent";
ALTER SEQUENCE "public"."tbl_pendidikan_id_pendidikan_seq" OWNED BY "tbl_pendidikan"."id_pendidikan";
ALTER SEQUENCE "public"."tbl_retensi_aktif_id_retensi_aktif_seq" OWNED BY "tbl_retensi_aktif"."id_retensi_aktif";
ALTER SEQUENCE "public"."tbl_retensi_inaktif_id_retensi_inaktif_seq" OWNED BY "tbl_retensi_inaktif"."id_retensi_inaktif";
ALTER SEQUENCE "public"."tbl_retensi_keterangan_id_retensi_ket_seq" OWNED BY "tbl_retensi_keterangan"."id_retensi_ket";
ALTER SEQUENCE "public"."tbl_sifat_surat_id_sifat_surat_seq" OWNED BY "tbl_sifat_surat"."id_sifat_surat";
ALTER SEQUENCE "public"."tbl_sk_eksternal_id_sk_eksternal_seq" OWNED BY "tbl_sk_eksternal"."id_sk_eksternal";
ALTER SEQUENCE "public"."tbl_sm_internal_id_sm_internal_seq" OWNED BY "tbl_sm_internal"."id_sm_internal";
ALTER SEQUENCE "public"."tbl_surat_keluar_id_surat_keluar_seq" OWNED BY "tbl_sk_internal"."id_surat_keluar";
ALTER SEQUENCE "public"."tbl_surat_masuk_id_surat_masuk_seq" OWNED BY "tbl_sm_eksternal"."id_sm_eksternal";
ALTER SEQUENCE "public"."tbl_temp_agenda_langsung_id_temp_agenda_seq" OWNED BY "tbl_temp_agenda_direksi"."id_temp_agenda";
ALTER SEQUENCE "public"."tbl_temp_bot_klas_id_bot_klas_seq" OWNED BY "tbl_temp_bot_klas"."id_bot_klas";
ALTER SEQUENCE "public"."tbl_temp_mid_klas_id_mid_klas_seq" OWNED BY "tbl_temp_mid_klas"."id_mid_klas";
ALTER SEQUENCE "public"."tbl_temp_surat_keluar_id_temp_surat_keluar_seq" OWNED BY "tbl_temp_surat_keluar"."id_temp_surat_keluar";
ALTER SEQUENCE "public"."tbl_temp_surat_masuk_id_temp_surat_masuk_seq" OWNED BY "tbl_temp_surat_masuk"."id_temp_surat_masuk";
ALTER SEQUENCE "public"."users_id_seq" OWNED BY "users"."id";

-- ----------------------------
-- Primary Key structure for table migrations
-- ----------------------------
ALTER TABLE "public"."migrations" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table password_resets
-- ----------------------------
CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree ("email");

-- ----------------------------
-- Primary Key structure for table tbl_agenda_direksi
-- ----------------------------
ALTER TABLE "public"."tbl_agenda_direksi" ADD PRIMARY KEY ("id_agenda_direksi");

-- ----------------------------
-- Primary Key structure for table tbl_bagian
-- ----------------------------
ALTER TABLE "public"."tbl_bagian" ADD PRIMARY KEY ("id_bagian");

-- ----------------------------
-- Primary Key structure for table tbl_disposisi_direksi
-- ----------------------------
ALTER TABLE "public"."tbl_disposisi_direksi" ADD PRIMARY KEY ("id_disposisi_direksi");

-- ----------------------------
-- Primary Key structure for table tbl_golongan
-- ----------------------------
ALTER TABLE "public"."tbl_golongan" ADD PRIMARY KEY ("id_golongan");

-- ----------------------------
-- Primary Key structure for table tbl_hakakses
-- ----------------------------
ALTER TABLE "public"."tbl_hakakses" ADD PRIMARY KEY ("id_hakakses");

-- ----------------------------
-- Primary Key structure for table tbl_jabatan
-- ----------------------------
ALTER TABLE "public"."tbl_jabatan" ADD PRIMARY KEY ("id_jabatan");

-- ----------------------------
-- Primary Key structure for table tbl_jenis_surat
-- ----------------------------
ALTER TABLE "public"."tbl_jenis_surat" ADD PRIMARY KEY ("id_jenis_surat");

-- ----------------------------
-- Primary Key structure for table tbl_karyawan
-- ----------------------------
ALTER TABLE "public"."tbl_karyawan" ADD PRIMARY KEY ("id_karyawan");

-- ----------------------------
-- Primary Key structure for table tbl_klasifikasi
-- ----------------------------
ALTER TABLE "public"."tbl_klasifikasi" ADD PRIMARY KEY ("id_klas");

-- ----------------------------
-- Primary Key structure for table tbl_masakerja
-- ----------------------------
ALTER TABLE "public"."tbl_masakerja" ADD PRIMARY KEY ("id_masakerja");

-- ----------------------------
-- Primary Key structure for table tbl_pendidikan
-- ----------------------------
ALTER TABLE "public"."tbl_pendidikan" ADD PRIMARY KEY ("id_pendidikan");

-- ----------------------------
-- Primary Key structure for table tbl_retensi_aktif
-- ----------------------------
ALTER TABLE "public"."tbl_retensi_aktif" ADD PRIMARY KEY ("id_retensi_aktif");

-- ----------------------------
-- Primary Key structure for table tbl_retensi_inaktif
-- ----------------------------
ALTER TABLE "public"."tbl_retensi_inaktif" ADD PRIMARY KEY ("id_retensi_inaktif");

-- ----------------------------
-- Primary Key structure for table tbl_retensi_keterangan
-- ----------------------------
ALTER TABLE "public"."tbl_retensi_keterangan" ADD PRIMARY KEY ("id_retensi_ket");

-- ----------------------------
-- Primary Key structure for table tbl_sifat_surat
-- ----------------------------
ALTER TABLE "public"."tbl_sifat_surat" ADD PRIMARY KEY ("id_sifat_surat");

-- ----------------------------
-- Primary Key structure for table tbl_sk_eksternal
-- ----------------------------
ALTER TABLE "public"."tbl_sk_eksternal" ADD PRIMARY KEY ("id_sk_eksternal");

-- ----------------------------
-- Primary Key structure for table tbl_sk_internal
-- ----------------------------
ALTER TABLE "public"."tbl_sk_internal" ADD PRIMARY KEY ("id_surat_keluar");

-- ----------------------------
-- Primary Key structure for table tbl_sm_eksternal
-- ----------------------------
ALTER TABLE "public"."tbl_sm_eksternal" ADD PRIMARY KEY ("id_sm_eksternal");

-- ----------------------------
-- Primary Key structure for table tbl_sm_internal
-- ----------------------------
ALTER TABLE "public"."tbl_sm_internal" ADD PRIMARY KEY ("id_sm_internal");

-- ----------------------------
-- Primary Key structure for table tbl_temp_agenda_direksi
-- ----------------------------
ALTER TABLE "public"."tbl_temp_agenda_direksi" ADD PRIMARY KEY ("id_temp_agenda");

-- ----------------------------
-- Primary Key structure for table tbl_temp_bot_klas
-- ----------------------------
ALTER TABLE "public"."tbl_temp_bot_klas" ADD PRIMARY KEY ("id_bot_klas");

-- ----------------------------
-- Primary Key structure for table tbl_temp_mid_klas
-- ----------------------------
ALTER TABLE "public"."tbl_temp_mid_klas" ADD PRIMARY KEY ("id_mid_klas");

-- ----------------------------
-- Primary Key structure for table tbl_temp_surat_keluar
-- ----------------------------
ALTER TABLE "public"."tbl_temp_surat_keluar" ADD PRIMARY KEY ("id_temp_surat_keluar");

-- ----------------------------
-- Primary Key structure for table tbl_temp_surat_masuk
-- ----------------------------
ALTER TABLE "public"."tbl_temp_surat_masuk" ADD PRIMARY KEY ("id_temp_surat_masuk");

-- ----------------------------
-- Primary Key structure for table tbl_top_klasifikasi
-- ----------------------------
ALTER TABLE "public"."tbl_top_klasifikasi" ADD PRIMARY KEY ("id_parent");

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD PRIMARY KEY ("id");
