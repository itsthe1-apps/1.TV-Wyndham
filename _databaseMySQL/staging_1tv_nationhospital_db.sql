/*
 Navicat Premium Data Transfer

 Source Server         : Localhost-MySQL
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : localhost
 Source Database       : staging_1tv_nationhospital_db

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : utf-8

 Date: 09/03/2017 17:11:09 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `mw_backgrounds`
-- ----------------------------
DROP TABLE IF EXISTS `mw_backgrounds`;
CREATE TABLE `mw_backgrounds` (
  `background_id` int(10) NOT NULL AUTO_INCREMENT,
  `background_module` enum('HOME','TV','VOD','RADIO','RESTAURANT','SPA','EXPERIENCE','MESSAGES','SERVICES','INFO') NOT NULL,
  `background_image` varchar(100) NOT NULL,
  `language` varchar(20) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`background_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_backgrounds`
-- ----------------------------
BEGIN;
INSERT INTO `mw_backgrounds` VALUES ('19', 'HOME', 'en-Welcome-N-Hotel-Info.png', 'en'), ('20', 'TV', 'en-TV.png', 'en'), ('21', 'RESTAURANT', 'en-Retail-N-Dining.png', 'en'), ('22', 'MESSAGES', 'en-Messages.png', 'en'), ('23', 'INFO', 'en-News-N-Promotion.png', 'en'), ('24', 'HOME', 'ar-Welcome.png', 'ar'), ('25', 'TV', 'ar-TV.png', 'ar'), ('26', 'RESTAURANT', 'ar-Retail-N-Dining.png', 'ar'), ('27', 'MESSAGES', 'ar-Messages.png', 'ar'), ('28', 'INFO', 'ar-News-N-Promotion.png', 'ar');
COMMIT;

-- ----------------------------
--  Table structure for `mw_category`
-- ----------------------------
DROP TABLE IF EXISTS `mw_category`;
CREATE TABLE `mw_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(100) NOT NULL,
  `vod_cat_rating` varchar(50) NOT NULL,
  `UID` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_channel`
-- ----------------------------
DROP TABLE IF EXISTS `mw_channel`;
CREATE TABLE `mw_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `genreName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mrl` varchar(255) CHARACTER SET latin1 NOT NULL,
  `logo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `language` varchar(255) CHARACTER SET latin1 NOT NULL,
  `prLevel` int(10) unsigned NOT NULL,
  `prName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `eitXML` varchar(255) DEFAULT NULL,
  `epgXML` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_channel`
-- ----------------------------
BEGIN;
INSERT INTO `mw_channel` VALUES ('83', 'Al Masriya TV', '5', 'Select', 'udp://225.1.159.5:11111', 'al_masriya_tv.png', '', 'en', '0', 'Select', null, null, '2016-09-19 15:47:02', '2017-07-19 10:06:00'), ('78', 'BBC World', '3', 'Select', 'udp://225.1.159.1:11111', 'bbc_world.png', '', 'en', '0', 'Select', null, null, '2013-02-21 16:12:40', '2017-07-19 10:03:54'), ('73', 'CNN INTL', '2', 'Select', 'udp://239.3.2.2:1234', 'cnn_intl.png', '', 'en', '0', 'Select', null, null, '2013-02-21 15:30:31', '2017-08-03 11:00:44'), ('150', 'Free TV', '12', 'Select', 'udp://225.1.1.65:11111', 'Free_tv.png', '', 'en', '0', 'Select', '', '', '2017-08-07 14:55:34', null), ('72', 'Hotel Video', '1', 'Select', 'udp://239.3.2.1:1234', 'Aldiarsiji.png', '', 'en', '0', 'Select', null, null, '2012-12-19 09:02:08', '2017-07-19 20:05:24'), ('81', 'Al Arabia', '4', 'Select', 'udp://225.1.142.1:11111', 'al_arabia.png', '', 'en', '0', 'Select', null, null, '2016-09-19 15:41:24', '2017-07-19 10:04:53'), ('86', 'Star Movies', '6', 'Select', 'udp://225.20.1.6:1234', 'star_movies.png', '', 'en', '0', 'Select', null, null, '2016-09-19 15:51:06', '2017-07-19 10:08:20'), ('151', 'Dubai Sports', '8', 'Select', 'udp://225.1.1.12:11111', 'dubai_sports1.png', '', 'en', '0', 'Select', '', '', '2017-08-07 14:59:58', null), ('88', 'MBC 1', '7', 'Select', 'udp://225.1.139.11:11111', 'mbc1.png', '', 'en', '0', 'Select', null, null, '2016-09-19 16:03:11', '2017-07-19 10:09:45'), ('90', 'AD Sports2', '9', 'Select', 'udp://225.1.140.1:11111', 'ad_sports2.png', '', 'en', '0', 'Select', null, null, '2016-09-19 16:07:12', '2017-07-19 10:11:09'), ('91', 'STAR WORLD', '10', 'Select', 'udp://225.20.1.4:1234', 'star_world.png', '', 'en', '0', 'Select', null, null, '2016-09-19 16:10:25', '2017-07-19 10:11:36'), ('92', 'MBC 2', '11', 'Select', 'udp://225.1.139.12:11111', 'mbc2.png', '', 'en', '0', 'Select', null, null, '2016-09-19 16:12:30', '2017-07-19 10:12:28'), ('94', 'KUWAIT TV', '13', 'Select', 'udp://225.1.146.3:11111', 'Kuwait_tv.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:27:29', null), ('95', 'Majestic Cinema', '14', 'Select', 'udp://225.1.133.4:11111', 'Majestic_cinema1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:28:18', null), ('96', 'AD Sport1', '15', 'Select', 'udp://225.1.140.7:11111', 'Ad_sports1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:28:56', null), ('97', 'HAWACOM', '16', 'Select', 'udp://225.1.149.2:11111', 'hawacom.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:29:40', null), ('98', 'CNBC Arabiyah', '17', 'Select', 'udp://225.1.134.16:11111', 'cnbc_arabiya.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:30:16', null), ('101', 'MBC 4', '18', 'Select', 'udp://225.1.139.14:11111', 'mbc4.jpg', '', 'en', '0', 'Select', '', '', '2017-07-19 10:32:38', null), ('103', 'City 7', '19', 'Select', 'udp://225.1.3.9:11111', 'city7_tv.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:33:53', null), ('105', 'MBC Action', '20', 'Select', 'udp://225.1.139.18:11111', 'mbc_action.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:37:11', null), ('106', 'Oman', '21', 'Select', 'udp://225.1.18.4:11111', 'Onam_tv.png', '', 'en', '0', 'Select', null, null, '2017-07-19 10:37:43', '2017-07-19 10:41:57'), ('107', 'Saudi 1', '22', 'Select', 'udp://225.1.18.2:11111', 'saudi_11.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:38:24', null), ('108', 'MBC Drama', '23', 'Select', 'udp://225.1.139.17:11111', 'mbc_drama1.png', '', 'en', '0', 'Select', null, null, '2017-07-19 10:39:48', '2017-07-19 10:41:04'), ('109', 'Al Majd Kids', '24', 'Select', 'udp://225.1.140.9:11111', 'Al_majd_kids1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:41:46', null), ('110', 'Fujairah TV', '25', 'Select', 'udp://225.1.140.2:11111', 'Fujairah_tv1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:43:05', null), ('111', 'Nat Geo AD', '26', 'Select', 'udp://225.1.140.3:11111', 'Nat_Geo_adu_dhabi1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:43:52', null), ('112', 'MBC3', '27', 'Select', 'udp://225.1.139.13:11111', 'mbc_31.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:45:08', null), ('113', 'Space Toon', '28', 'Select', 'udp://225.1.134.13:11111', 'space_toon.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:45:42', null), ('114', 'MBC MAX', '29', 'Select', 'udp://225.1.139.15:11111', 'mbc_max.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:46:57', null), ('116', 'NILE CINEMA', '30', 'Select', 'udp://225.1.156.2:11111', 'Nile_Cinema.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:48:35', null), ('117', 'MBC Bollywood', '31', 'Select', 'udp://225.1.139.16:11111', 'mbc_bollywood.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:49:22', null), ('118', 'Cartoon Network', '32', 'Select', 'udp://225.1.143.2:11111', 'Cartoon_Network.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:49:50', null), ('119', 'AD Emarat', '33', 'Select', 'udp://225.1.140.6:11111', 'ad_emarat.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:51:16', null), ('120', 'B4U AFLAM', '34', 'Select', 'udp://225.1.143.3:11111', 'B4U_aflam.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:54:47', null), ('121', 'SKY NEWS ARABIA', '35', 'Select', 'udp://225.1.131.2:11111', 'sky_news_arabia.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:55:22', null), ('122', 'Abudhabi TV', '36', 'Select', 'udp://225.1.138.26:11111', 'Abudhabi.png', '', 'en', '0', 'Select', '', '', '2017-07-19 10:56:19', null), ('125', 'Sharjah TV', '37', 'Select', 'udp://225.1.131.3:11111', 'sharjah_tv.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:02:31', null), ('126', 'LDC', '38', 'Select', 'udp://225.1.135.2:11111', 'ldc.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:03:18', null), ('127', 'MTV lebanon', '39', 'Select', 'udp://225.1.135.3:11111', 'mtv_lebanon1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:03:59', null), ('130', 'Al Hadath', '40', 'Select', 'udp://225.1.142.2:11111', 'al_hadath.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:06:12', null), ('131', 'KARAMEESH', '41', 'Select', 'udp://225.1.148.2:11111', 'karameesh.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:06:51', null), ('132', 'KOKY', '42', 'Select', 'udp://225.1.133.5:11111', 'koky.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:07:45', null), ('133', 'Aghadi Aghadi', '43', 'Select', 'udp://225.1.135.4:11111', 'Aldiarsiji1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:09:35', null), ('134', 'Wanasah', '44', 'Select', 'udp://225.1.138.26:11111', 'wanasah1.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:10:43', null), ('135', 'Dubai Al Aula', '45', 'Select', 'udp://225.1.134.17:11111', 'dubai_al_aula.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:11:24', null), ('138', 'Zee aflam', '46', 'Select', 'udp://225.1.138.27:11111', 'zee_aflam1.jpg', '', 'en', '0', 'Select', '', '', '2017-07-19 11:13:46', null), ('139', 'Nile Sports', '47', 'Select', 'udp://225.1.156.3:11111', 'nile_sports.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:14:26', null), ('144', 'LBC', '48', 'Select', 'udp://225.1.152.3:11111', 'lbc2.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:19:42', null), ('147', 'NILE COMEDY', '49', 'Select', 'udp://225.1.156.4:11111', 'Nile_comedy.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:21:54', null), ('148', 'DUBAI RACING', '50', 'Select', 'udp://225.1.134.80:11111', 'dubai_racing.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:22:57', null), ('149', 'B4U PLUS', '51', 'Select', 'udp://225.1.143.4:11111', 'B4U_plus.png', '', 'en', '0', 'Select', '', '', '2017-07-19 11:23:30', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_channel_group`
-- ----------------------------
DROP TABLE IF EXISTS `mw_channel_group`;
CREATE TABLE `mw_channel_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_channel_group`
-- ----------------------------
BEGIN;
INSERT INTO `mw_channel_group` VALUES ('30', '0', 'Managers'), ('26', '0', 'Default Channels');
COMMIT;

-- ----------------------------
--  Table structure for `mw_channel_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `mw_channel_permissions`;
CREATE TABLE `mw_channel_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=555 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_channel_permissions`
-- ----------------------------
BEGIN;
INSERT INTO `mw_channel_permissions` VALUES ('201', '18', '35'), ('200', '17', '34'), ('145', '24', '21'), ('144', '24', '20'), ('143', '24', '19'), ('140', '24', '16'), ('139', '24', '15'), ('134', '24', '10'), ('133', '24', '53'), ('132', '24', '8'), ('138', '24', '14'), ('137', '24', '49'), ('136', '24', '12'), ('135', '24', '11'), ('131', '19', '49'), ('142', '24', '18'), ('141', '24', '17'), ('197', '25', '68'), ('199', '17', '18'), ('198', '17', '12'), ('146', '24', '22'), ('147', '24', '23'), ('148', '24', '24'), ('149', '24', '25'), ('150', '24', '26'), ('151', '24', '27'), ('152', '24', '28'), ('153', '24', '29'), ('154', '24', '30'), ('155', '24', '31'), ('156', '24', '32'), ('157', '24', '33'), ('158', '24', '34'), ('159', '24', '35'), ('160', '24', '36'), ('161', '24', '37'), ('162', '24', '9'), ('163', '24', '39'), ('164', '24', '40'), ('165', '24', '41'), ('166', '24', '42'), ('167', '24', '43'), ('168', '24', '44'), ('169', '24', '45'), ('170', '24', '46'), ('171', '24', '47'), ('172', '24', '48'), ('173', '24', '13'), ('174', '24', '50'), ('175', '24', '51'), ('176', '24', '52'), ('177', '24', '38'), ('178', '24', '60'), ('179', '24', '68'), ('196', '25', '13'), ('195', '25', '40'), ('194', '25', '39'), ('193', '25', '36'), ('192', '25', '35'), ('191', '25', '34'), ('190', '25', '18'), ('189', '25', '12'), ('202', '18', '36'), ('203', '18', '39'), ('255', '27', '72'), ('266', '29', '72'), ('265', '29', '71'), ('264', '29', '70'), ('254', '27', '71'), ('253', '27', '70'), ('397', '30', '79'), ('507', '26', '102'), ('506', '26', '101'), ('505', '26', '100'), ('504', '26', '99'), ('503', '26', '98'), ('502', '26', '97'), ('501', '26', '96'), ('256', '27', '73'), ('257', '27', '74'), ('258', '27', '75'), ('259', '27', '76'), ('260', '27', '77'), ('261', '27', '78'), ('262', '27', '79'), ('263', '27', '80'), ('267', '29', '73'), ('268', '29', '74'), ('269', '29', '75'), ('270', '29', '76'), ('271', '29', '77'), ('272', '29', '78'), ('273', '29', '79'), ('274', '29', '80'), ('500', '26', '95'), ('499', '26', '94'), ('498', '26', '93'), ('497', '26', '92'), ('496', '26', '91'), ('495', '26', '90'), ('494', '26', '89'), ('493', '26', '88'), ('492', '26', '87'), ('491', '26', '86'), ('490', '26', '85'), ('489', '26', '84'), ('488', '26', '83'), ('487', '26', '82'), ('486', '26', '81'), ('485', '26', '79'), ('484', '26', '78'), ('483', '26', '73'), ('482', '26', '72'), ('508', '26', '103'), ('509', '26', '104'), ('510', '26', '105'), ('511', '26', '106'), ('512', '26', '107'), ('513', '26', '108'), ('514', '26', '109'), ('515', '26', '110'), ('516', '26', '111'), ('517', '26', '112'), ('518', '26', '113'), ('519', '26', '114'), ('520', '26', '115'), ('521', '26', '116'), ('522', '26', '117'), ('523', '26', '118'), ('524', '26', '119'), ('525', '26', '120'), ('526', '26', '121'), ('527', '26', '122'), ('528', '26', '123'), ('529', '26', '124'), ('530', '26', '125'), ('531', '26', '126'), ('532', '26', '127'), ('533', '26', '128'), ('534', '26', '129'), ('535', '26', '130'), ('536', '26', '131'), ('537', '26', '132'), ('538', '26', '133'), ('539', '26', '134'), ('540', '26', '135'), ('541', '26', '136'), ('542', '26', '137'), ('543', '26', '138'), ('544', '26', '139'), ('545', '26', '140'), ('546', '26', '141'), ('547', '26', '142'), ('548', '26', '143'), ('549', '26', '144'), ('550', '26', '145'), ('551', '26', '146'), ('552', '26', '147'), ('553', '26', '148'), ('554', '26', '149');
COMMIT;

-- ----------------------------
--  Table structure for `mw_channel_role_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `mw_channel_role_permissions`;
CREATE TABLE `mw_channel_role_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_channel_role_permissions`
-- ----------------------------
BEGIN;
INSERT INTO `mw_channel_role_permissions` VALUES ('15', '1', '18'), ('185', '7', '17'), ('20', '1', '17'), ('191', '11', '27'), ('184', '2', '25'), ('87', '15', '19'), ('86', '15', '18'), ('85', '15', '17'), ('158', '16', '17'), ('190', '11', '26'), ('192', '10', '26'), ('163', '17', '25'), ('183', '2', '24'), ('182', '2', '18'), ('171', '3', '18'), ('170', '3', '17'), ('181', '2', '17'), ('186', '7', '18'), ('187', '7', '19'), ('188', '7', '24');
COMMIT;

-- ----------------------------
--  Table structure for `mw_ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `mw_ci_sessions`;
CREATE TABLE `mw_ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_ci_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `mw_ci_sessions` VALUES ('69e88d99fc3dcb16411dbc7528befce5', '192.168.1.100', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1;', '1281608222', null), ('779e2769571cfe381afcf10adcf994de', '192.168.1.100', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1;', '1281608225', null), ('e10011b0d10ea409eae3263e82990260', '192.168.1.100', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1;', '1281608810', 'a:9:{s:10:\"DX_user_id\";s:1:\"1\";s:11:\"DX_username\";s:5:\"admin\";s:10:\"DX_role_id\";s:1:\"2\";s:12:\"DX_role_name\";s:5:\"Admin\";s:18:\"DX_parent_roles_id\";a:0:{}s:20:\"DX_parent_roles_name\";a:0:{}s:13:\"DX_permission\";a:1:{s:3:\"uri\";a:1:{i:0;s:14:\"/welcome/index\";}}s:21:\"DX_parent_permissions\";a:0:{}s:12:\"DX_logged_in\";s:1:\"1\";}');
COMMIT;

-- ----------------------------
--  Table structure for `mw_config`
-- ----------------------------
DROP TABLE IF EXISTS `mw_config`;
CREATE TABLE `mw_config` (
  `key` varchar(255) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_config`
-- ----------------------------
BEGIN;
INSERT INTO `mw_config` VALUES ('banner_width', '500'), ('base_url', 'http://www.mbc.com:81/'), ('charset', 'UTF-8'), ('compress_output', 'FALSE'), ('controller_trigger', 'c'), ('cookie_domain', ''), ('cookie_path', '\"/\"'), ('cookie_prefix', ''), ('directory_trigger', 'd'), ('enable_hooks', 'FALSE'), ('enable_query_strings', 'FALSE'), ('encryption_key', ''), ('function_trigger', 'm'), ('global_xss_filtering', 'FALSE'), ('index_page', 'index.php'), ('language', 'english'), ('log_date_format', 'Y-m-d H:i:s'), ('log_threshold', '0'), ('page_height', '250px'), ('page_width', '600px'), ('permitted_uri_chars', 'a-z 0-9~%.:_\\-'), ('rewrite_short_tags', 'FALSE'), ('sess_cookie_name', 'ci_session'), ('sess_encrypt_cookie', 'TRUE'), ('sess_expiration', '7200'), ('sess_match_ip', 'FALSE'), ('sess_match_useragent', 'TRUE'), ('sess_table_name', 'ci_sessions'), ('sess_time_to_update', '300'), ('sess_use_database', 'FALSE'), ('subclass_prefix', 'MY'), ('time_reference', 'local'), ('time_zone', 'Asia/Dubai'), ('tvicon_size', '80px'), ('uri_protocol', 'PATH_INFO'), ('vodalpha_icon_size', '70px'), ('vodgenre_banner_width', '350'), ('vodgenre_icon_size', '100px'), ('vodicon_size', '80px'), ('vod_banner_width', '350');
COMMIT;

-- ----------------------------
--  Table structure for `mw_detail_greeting`
-- ----------------------------
DROP TABLE IF EXISTS `mw_detail_greeting`;
CREATE TABLE `mw_detail_greeting` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting_id` int(10) unsigned NOT NULL,
  `greeting_desc` varchar(100) COLLATE utf8_bin NOT NULL,
  `greeting_language` varchar(3) COLLATE utf8_bin NOT NULL,
  `greeting_title` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_detail_greeting`
-- ----------------------------
BEGIN;
INSERT INTO `mw_detail_greeting` VALUES ('1', '1', 'Thank you for choosing to stay with us, we truly hope you will have a wonderful and memorable time !', 'en', 'Dear');
COMMIT;

-- ----------------------------
--  Table structure for `mw_detail_rest_menutype`
-- ----------------------------
DROP TABLE IF EXISTS `mw_detail_rest_menutype`;
CREATE TABLE `mw_detail_rest_menutype` (
  `rest_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `rest_mtype_id` int(10) unsigned NOT NULL,
  `rest_mtype_desc` varchar(100) COLLATE utf8_bin NOT NULL,
  `rest_mtype_language` varchar(3) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`rest_detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_detail_rest_menutype`
-- ----------------------------
BEGIN;
INSERT INTO `mw_detail_rest_menutype` VALUES ('6', '3', 'This is in arabic text', 'ar'), ('7', '4', 'This is in korean text', 'kr'), ('8', '2', 'test name strusdfsd', 'en'), ('9', '2', 'Korean main course', 'kr'), ('10', '1', 'Starter English', 'en'), ('11', '1', 'Starter Korean', 'kr'), ('12', '1', 'Starter Arabic', 'ar');
COMMIT;

-- ----------------------------
--  Table structure for `mw_device_suite`
-- ----------------------------
DROP TABLE IF EXISTS `mw_device_suite`;
CREATE TABLE `mw_device_suite` (
  `iddevice_suite` int(11) NOT NULL,
  `id_device` varchar(45) DEFAULT NULL,
  `id_suite` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddevice_suite`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_device_types`
-- ----------------------------
DROP TABLE IF EXISTS `mw_device_types`;
CREATE TABLE `mw_device_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `device_type` varchar(100) NOT NULL,
  `device_group` varchar(45) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `mcast_prefix` varchar(45) DEFAULT NULL,
  `transp_level` int(10) unsigned DEFAULT NULL,
  `window_x` int(10) unsigned NOT NULL DEFAULT '0',
  `window_y` int(10) unsigned NOT NULL DEFAULT '0',
  `window_width` int(10) unsigned NOT NULL DEFAULT '0',
  `window_height` int(10) unsigned NOT NULL DEFAULT '0',
  `opaque_level` int(10) unsigned NOT NULL DEFAULT '0',
  `volume_step` int(10) unsigned NOT NULL DEFAULT '0',
  `volume_max` int(10) unsigned NOT NULL DEFAULT '0',
  `volume_min` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_device_types`
-- ----------------------------
BEGIN;
INSERT INTO `mw_device_types` VALUES ('5', 'aminocom1080', null, '2012-12-17 08:29:50', null, '', '100', '1090', '353', '730', '518', '100', '5', '100', '0'), ('6', 'exterity1080', null, '2012-12-30 17:53:11', null, 'udp://', '80', '300', '200', '300', '300', '255', '5', '40', '0'), ('7', 'dunehd1080', null, '2013-01-28 11:57:56', null, '', '153', '1108', '360', '680', '510', '255', '5', '100', '0'), ('9', 'pc720', null, '2013-09-16 08:19:37', '2016-04-21 10:33:11', '', '60', '1079', '353', '730', '518', '255', '5', '100', '0'), ('10', 'dunehd720', null, '2013-09-16 08:19:37', null, '', '102', '710', '240', '453', '340', '255', '5', '100', '0'), ('11', 'aminocom720', null, '2013-09-16 08:19:37', null, '', '60', '710', '235', '487', '345', '255', '5', '100', '0'), ('12', 'pc1080', null, '2016-04-21 10:30:34', null, '', null, '0', '0', '0', '0', '0', '0', '0', '0'), ('13', 'infomir1080', null, '2016-04-21 12:38:17', '2016-04-21 13:35:55', '', '100', '1020', '360', '840', '448', '255', '5', '100', '0'), ('14', 'infomir720', null, '2016-04-21 13:36:09', null, '', '100', '692', '255', '550', '340', '255', '5', '100', '0'), ('15', 'exterity720', null, '2016-07-27 16:47:38', null, 'udp://', '80', '632', '228', '600', '338', '255', '5', '100', '0');
COMMIT;

-- ----------------------------
--  Table structure for `mw_devices`
-- ----------------------------
DROP TABLE IF EXISTS `mw_devices`;
CREATE TABLE `mw_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UID` varchar(50) NOT NULL,
  `mac_address` varchar(100) NOT NULL,
  `device_type` varchar(20) DEFAULT NULL,
  `display_type` varchar(20) DEFAULT NULL,
  `video_type` varchar(50) DEFAULT NULL,
  `purchase_order` varchar(100) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `IAD` varchar(50) DEFAULT NULL,
  `device_mcast` varchar(2) DEFAULT '0',
  `device_rtp` varchar(2) DEFAULT '0',
  `device_dvbc` varchar(2) DEFAULT '0',
  `device_ott` varchar(2) DEFAULT '0',
  `device_status` smallint(2) DEFAULT '1',
  `local_storage` varchar(2) DEFAULT '0',
  `PiP` varchar(2) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `tv_brand_folder` varchar(50) DEFAULT 'pc',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_devices`
-- ----------------------------
BEGIN;
INSERT INTO `mw_devices` VALUES ('14', '00020259be00', '00020259be00', '5', null, null, null, 'itsthe1', null, '0', '0', '0', '0', '1', '0', null, '2017-09-03 15:03:31', null, 'pc'), ('15', 'PC1080', '000000000000', '5', '1', '1', '', 'itsthe1', '', '0', '0', '0', '0', '1', '0', '0', '2017-09-03 15:04:57', '2017-09-03 15:05:37', 'pc'), ('11', '0002025b5a1f', '0002025b5a1f', '11', null, null, null, 'itsthe1', null, '0', '0', '0', '0', '0', '0', null, '2017-04-09 18:00:39', null, 'pc');
COMMIT;

-- ----------------------------
--  Table structure for `mw_epgfiles`
-- ----------------------------
DROP TABLE IF EXISTS `mw_epgfiles`;
CREATE TABLE `mw_epgfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel` int(10) unsigned NOT NULL,
  `path` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_epgfiles`
-- ----------------------------
BEGIN;
INSERT INTO `mw_epgfiles` VALUES ('3', '26', 'www.itsthe1.com/profiles/mbcadmin_v2/xml/mbc3.xml'), ('4', '25', 'www.itsthe1.com/profiles/mbcadmin_v2/xml/mbc4.xml'), ('5', '60', 'www.itsthe1.com/profiles/mbcadmin_v2/xml/mbcaction.xml'), ('6', '35', 'www.itsthe1.com/profiles/mbcadmin_v2/xml/mbcmax.xml'), ('7', '73', 'www.itsthe1.com/profiles/mbcadmin_v2/xml/mbc2.xml');
COMMIT;

-- ----------------------------
--  Table structure for `mw_exit`
-- ----------------------------
DROP TABLE IF EXISTS `mw_exit`;
CREATE TABLE `mw_exit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `rtsp` varchar(120) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_exit`
-- ----------------------------
BEGIN;
INSERT INTO `mw_exit` VALUES ('23', 'Exit Messsage', 'rtsp://server/file.ts', '0', '2015-04-19 15:11:22', '2015-05-01 11:45:53', 'exit2.png');
COMMIT;

-- ----------------------------
--  Table structure for `mw_experience`
-- ----------------------------
DROP TABLE IF EXISTS `mw_experience`;
CREATE TABLE `mw_experience` (
  `experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `experience_type` varchar(255) DEFAULT NULL,
  `experience_img_url` varchar(255) DEFAULT NULL,
  `description` text,
  `date_added` datetime DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`experience_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_experience`
-- ----------------------------
BEGIN;
INSERT INTO `mw_experience` VALUES ('6', 'THE SHEIKH ZAYED GRAND MOSQUE', 'grand-mosque-1.png|grand-mosque-2.png|grand-mosque-3.png', '<p>Clad in Macedonian marble, the beautiful Sheikh Zayed Grand Mosque is Abu Dhabi&#39;s landmark building and one of the largest mosque in the world able to welcome 40,000 worshippers. The mosque fuses Mameluke, Ottoman and Fatamid design elements to create a harmonious and thoroughly modern mosque that celebrates Islamic architecture. Artisans utilised glass-work, mosaic tiling and intricate carvings to spectacular effect on both the interior and exterior.</p>\n\n<p><strong>Hours: Open Sat-Thu 9am-10pm; Fri 4.30pm-10pm</strong></p>\n\n<p><strong>Admission: Entry Free</strong></p>\n', '2016-10-24 04:21:36', 'en'), ('7', 'FERRARI WORLD', 'ferarri-world-1.png|ferarri-world-2.png|ferarri-world-3.png', '<p>Ferrari World, also known under the name &ldquo;Ferrari Experience&rdquo;, is a theme park situated on Yas Island, in Abu Dhabi, near the circuit Yas Marina. It is the first park of this type to use the theme and the Ferrari brand.</p>\n', '2016-10-24 03:11:24', 'en'), ('8', 'HERITAGE VILLAGE', 'heritage-club-1.png|heritage-club-2.png|heritage-club-3.png', '<p>Heritage village is the place to go if you wish to be plunged into the authentic universe of United Arab Emirates. This is the reconstruction of a traditional village in the heart of the desert, as we could find over there in the past. We can see different aspects of the daily life as a campfire with coffee pots, a goats&rsquo; hair tent, and a falaj irrigation system in an open museum.</p>\n', '2016-10-24 03:11:55', 'en'), ('9', 'BEACH', 'corniche-1.png|corniche-2.png|corniche-3.png', '<p>Abu Dhabi counts more than 400 kilometres of coast. Its beaches and its resorts, equipped with areas of picnic and barbecues, lined with cafes and proposing activities of extreme water sports near to the bank, are among the best maintained to the world.</p>\n', '2016-10-24 03:12:37', 'en');
COMMIT;

-- ----------------------------
--  Table structure for `mw_favourites`
-- ----------------------------
DROP TABLE IF EXISTS `mw_favourites`;
CREATE TABLE `mw_favourites` (
  `fav_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fav_user` int(10) unsigned NOT NULL,
  `fav_channel_id` int(10) unsigned NOT NULL,
  `fav_date_added` datetime DEFAULT NULL,
  `fav_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_favourites`
-- ----------------------------
BEGIN;
INSERT INTO `mw_favourites` VALUES ('98', '44', '72', null, null), ('99', '44', '78', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_flag`
-- ----------------------------
DROP TABLE IF EXISTS `mw_flag`;
CREATE TABLE `mw_flag` (
  `localinfo` datetime DEFAULT NULL,
  `radio` datetime DEFAULT NULL,
  `promotions` datetime DEFAULT NULL,
  `tv` datetime DEFAULT NULL,
  `restaurant` datetime DEFAULT NULL,
  `greeting` datetime DEFAULT NULL,
  `vod` datetime DEFAULT NULL,
  `news` datetime DEFAULT NULL,
  `weather` datetime DEFAULT NULL,
  `internet` datetime DEFAULT NULL,
  `spa` datetime DEFAULT NULL,
  `experience` datetime DEFAULT NULL,
  `retail` datetime DEFAULT NULL,
  `newsnpromo` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_flag`
-- ----------------------------
BEGIN;
INSERT INTO `mw_flag` VALUES ('2017-08-01 13:37:58', '2013-04-07 16:13:41', '2017-07-17 09:18:16', '2017-04-26 09:53:57', '2017-08-01 09:39:25', '2016-03-07 13:25:41', '2017-04-30 17:47:46', '2017-09-03 15:17:44', '2013-11-10 17:25:22', '2013-11-10 17:25:22', '2016-08-09 17:58:01', '2016-08-09 00:00:00', '2017-07-17 14:37:33', '2017-08-10 08:59:21');
COMMIT;

-- ----------------------------
--  Table structure for `mw_genre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_genre`;
CREATE TABLE `mw_genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `language` varchar(255) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_genre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_genre` VALUES ('7', 'News', 'welcome/Tv/News/', 'en', '2012-12-17 11:22:35', null), ('8', 'Sports', 'welcome/Tv/Sports/', 'en', '2012-12-17 11:22:43', null), ('9', 'Movies', 'welcome/Tv/Movies/', 'en', '2012-12-17 11:22:52', '2012-12-22 10:12:16'), ('10', 'Music', 'welcome/Tv/Music/', 'en', '2012-12-17 11:23:08', null), ('11', 'Geography', 'welcome/Tv/Geography/', 'en', '2016-09-19 15:54:38', null), ('12', 'Life Style', 'welcome/Tv/LifeStyle/', 'en', '2016-09-19 15:56:02', null), ('13', 'Travel', 'welcome/Tv/Travel/', 'en', '2016-09-19 16:11:01', null), ('14', 'Adult', 'welcome/Tv/Adult/', 'en', '2016-12-08 12:04:31', '2016-12-08 12:49:24');
COMMIT;

-- ----------------------------
--  Table structure for `mw_greeting`
-- ----------------------------
DROP TABLE IF EXISTS `mw_greeting`;
CREATE TABLE `mw_greeting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_greeting`
-- ----------------------------
BEGIN;
INSERT INTO `mw_greeting` VALUES ('1', 'Welcome Message', '2013-03-20 15:02:52', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_group_module`
-- ----------------------------
DROP TABLE IF EXISTS `mw_group_module`;
CREATE TABLE `mw_group_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL,
  `home` int(10) unsigned NOT NULL DEFAULT '1',
  `tv` int(10) unsigned NOT NULL DEFAULT '1',
  `vod` int(10) unsigned NOT NULL DEFAULT '0',
  `radio` int(10) unsigned NOT NULL DEFAULT '0',
  `internet` int(10) unsigned NOT NULL DEFAULT '0',
  `restaurant` int(10) unsigned NOT NULL DEFAULT '0',
  `information` int(10) unsigned NOT NULL DEFAULT '0',
  `messages` int(10) unsigned NOT NULL DEFAULT '0',
  `services` int(10) unsigned NOT NULL DEFAULT '0',
  `weather` int(10) unsigned NOT NULL DEFAULT '1',
  `clock` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_group_module`
-- ----------------------------
BEGIN;
INSERT INTO `mw_group_module` VALUES ('1', '10', '1', '1', '0', '0', '0', '1', '1', '1', '0', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `mw_group_room`
-- ----------------------------
DROP TABLE IF EXISTS `mw_group_room`;
CREATE TABLE `mw_group_room` (
  `gr_group_id` int(10) unsigned NOT NULL,
  `gr_room_id` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_group_room`
-- ----------------------------
BEGIN;
INSERT INTO `mw_group_room` VALUES ('10', '4'), ('10', '3'), ('10', '2'), ('10', '1');
COMMIT;

-- ----------------------------
--  Table structure for `mw_guest`
-- ----------------------------
DROP TABLE IF EXISTS `mw_guest`;
CREATE TABLE `mw_guest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `accessibility` varchar(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `post` varchar(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `fixed_phone` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `job_phone` varchar(50) DEFAULT NULL,
  `FAX` varchar(30) DEFAULT NULL,
  `UID` varchar(10) DEFAULT NULL,
  `auto_sub` varchar(100) DEFAULT NULL,
  `auto_audio` varchar(100) DEFAULT NULL,
  `auto_reminder_time` varchar(100) DEFAULT NULL,
  `parental_pin` varchar(100) DEFAULT NULL,
  `user_pin` varchar(100) DEFAULT NULL,
  `package_id` varchar(10) DEFAULT NULL,
  `skin` varchar(45) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_guest`
-- ----------------------------
BEGIN;
INSERT INTO `mw_guest` VALUES ('4', 'Mr', 'Lakshan', 'Costa', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '26', 'default', '2016-11-06 18:17:06', '2017-09-03 15:02:41');
COMMIT;

-- ----------------------------
--  Table structure for `mw_guest_alarm`
-- ----------------------------
DROP TABLE IF EXISTS `mw_guest_alarm`;
CREATE TABLE `mw_guest_alarm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest` int(11) NOT NULL,
  `alarm_time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `type` varchar(25) DEFAULT 'TV',
  `udp` int(11) DEFAULT '1',
  `tone` varchar(25) DEFAULT 'Default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_guest_name`
-- ----------------------------
DROP TABLE IF EXISTS `mw_guest_name`;
CREATE TABLE `mw_guest_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `surname` varchar(100) COLLATE utf8_bin NOT NULL,
  `language` varchar(3) COLLATE utf8_bin NOT NULL,
  `title` varchar(5) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_guest_name`
-- ----------------------------
BEGIN;
INSERT INTO `mw_guest_name` VALUES ('1', '44', '?????', '????', 'ar', '?????');
COMMIT;

-- ----------------------------
--  Table structure for `mw_guest_stb`
-- ----------------------------
DROP TABLE IF EXISTS `mw_guest_stb`;
CREATE TABLE `mw_guest_stb` (
  `device_id` int(10) unsigned NOT NULL,
  `need_restart` int(10) unsigned NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`device_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_guest_stb`
-- ----------------------------
BEGIN;
INSERT INTO `mw_guest_stb` VALUES ('14', '0', '2017-09-03 15:18:15'), ('15', '0', '2017-09-03 15:18:25'), ('11', '1', '2017-04-19 10:06:55');
COMMIT;

-- ----------------------------
--  Table structure for `mw_history_room_guest`
-- ----------------------------
DROP TABLE IF EXISTS `mw_history_room_guest`;
CREATE TABLE `mw_history_room_guest` (
  `room_id` int(11) NOT NULL,
  `guest_id` int(10) unsigned NOT NULL,
  `greeting_id` int(10) unsigned NOT NULL,
  `theme_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_history_room_guest`
-- ----------------------------
BEGIN;
INSERT INTO `mw_history_room_guest` VALUES ('1', '44', '1', '9', '1', '2016-05-16 16:33:23'), ('1', '44', '1', '1', '1', '2016-07-27 16:49:19'), ('1', '44', '1', '9', '1', '2016-07-27 16:59:36'), ('1', '44', '1', '10', '1', '2016-08-01 11:09:56'), ('1', '44', '1', '11', '1', '2016-10-23 22:26:21'), ('1', '45', '1', '11', '1', '2016-11-06 12:15:10'), ('1', '47', '1', '0', '1', '2016-11-06 16:52:25'), ('1', '48', '1', '0', '1', '2016-11-06 16:59:31'), ('1', '49', '1', '0', '1', '2016-11-06 17:01:44'), ('102', '50', '1', '0', '1', '2016-11-06 17:05:15'), ('105', '51', '1', '0', '1', '2016-11-06 17:19:57'), ('3', '1', '1', '11', '1', '2016-11-06 17:32:58'), ('101', '2', '1', '11', '1', '2016-11-06 17:37:27'), ('101', '1', '1', '11', '1', '2016-11-06 17:57:55'), ('1', '4', '1', '13', '1', '2017-04-04 12:08:41'), ('5', '14', '1', '11', '1', '2017-04-09 17:25:33'), ('5', '15', '1', '11', '1', '2017-04-09 17:28:45'), ('6', '16', '1', '11', '1', '2017-04-09 17:39:04'), ('1', '4', '1', '14', '1', '2017-08-07 09:42:37'), ('1', '4', '1', '11', '1', '2017-08-07 10:45:31'), ('1', '4', '1', '14', '1', '2017-08-07 10:50:09'), ('1', '4', '1', '14', '2', '2017-08-10 08:03:31'), ('1', '4', '1', '14', '1', '2017-08-10 08:04:10'), ('1', '4', '1', '15', '1', '2017-08-10 08:18:56'), ('1', '4', '1', '16', '1', '2017-08-10 09:15:46'), ('1', '4', '1', '10', '1', '2017-08-10 09:19:24'), ('1', '4', '1', '13', '1', '2017-08-10 09:20:10'), ('1', '4', '1', '15', '1', '2017-08-10 09:22:48'), ('1', '4', '1', '15', '2', '2017-09-03 15:02:41');
COMMIT;

-- ----------------------------
--  Table structure for `mw_internets`
-- ----------------------------
DROP TABLE IF EXISTS `mw_internets`;
CREATE TABLE `mw_internets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `language` varchar(255) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_internets`
-- ----------------------------
BEGIN;
INSERT INTO `mw_internets` VALUES ('1', 'http://www.itsthe1.tv', null, '1', '2013-02-20 00:00:00', '2013-02-20 00:00:00', 'youtube.png'), ('2', 'http://www.itsthe1.tv', null, '1', '2013-02-20 00:00:00', '2013-02-20 00:00:00', 'facebook.png'), ('3', 'http://www.itsthe1.tv', null, '1', '2013-02-20 00:00:00', '2013-02-20 00:00:00', 'twitter.png');
COMMIT;

-- ----------------------------
--  Table structure for `mw_itvmovie_bygenre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_itvmovie_bygenre`;
CREATE TABLE `mw_itvmovie_bygenre` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `MovieID` int(4) DEFAULT NULL,
  `GenreID` int(4) DEFAULT NULL,
  `Incr` int(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1062 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_itvmovie_bygenre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_itvmovie_bygenre` VALUES ('838', '5', '5', '0', null, null), ('839', '20', '2', '0', null, null), ('840', '277', '5', '0', null, null), ('841', '280', '3', '0', null, null), ('842', '284', '5', '0', null, null), ('843', '286', '3', '0', null, null), ('844', '287', '3', '0', null, null), ('845', '288', '5', '0', null, null), ('846', '291', '5', '0', null, null), ('847', '294', '3', '0', null, null), ('848', '298', '4', '0', null, null), ('849', '301', '4', '0', null, null), ('850', '305', '5', '0', null, null), ('851', '306', '3', '0', null, null), ('852', '312', '5', '0', null, null), ('853', '313', '3', '0', null, null), ('854', '326', '5', '0', null, null), ('855', '335', '3', '0', null, null), ('856', '340', '5', '0', null, null), ('857', '343', '2', '0', null, null), ('858', '344', '4', '0', null, null), ('859', '345', '5', '0', null, null), ('860', '349', '3', '0', null, null), ('861', '355', '4', '0', null, null), ('862', '358', '5', '0', null, null), ('863', '359', '3', '0', null, null), ('864', '361', '5', '0', null, null), ('865', '362', '3', '0', null, null), ('866', '367', '5', '0', null, null), ('867', '372', '3', '0', null, null), ('868', '378', '3', '0', null, null), ('869', '380', '4', '0', null, null), ('870', '381', '4', '0', null, null), ('871', '382', '5', '0', null, null), ('872', '384', '5', '0', null, null), ('873', '385', '5', '0', null, null), ('874', '387', '5', '0', null, null), ('876', '389', '5', '0', null, null), ('877', '390', '4', '0', null, null), ('881', '394', '5', '0', null, null), ('882', '395', '5', '0', null, null), ('883', '396', '5', '0', null, null), ('884', '397', '5', '0', null, null), ('885', '398', '5', '0', null, null), ('930', '41', '41', null, '2013-03-21 15:25:14', null), ('888', '4', '4', null, null, null), ('889', '5', '5', null, null, null), ('890', '6', '6', null, '2013-03-18 12:57:56', null), ('929', '40', '40', null, '2013-03-21 15:21:48', null), ('934', '45', '45', null, '2013-11-10 15:08:56', null), ('895', '11', '11', null, '2013-03-18 12:59:57', null), ('896', '12', '12', null, '2013-03-18 13:00:13', null), ('897', '13', '13', null, null, null), ('898', '14', '14', null, '2013-03-18 13:00:29', null), ('899', '15', '15', null, null, null), ('900', '15', '15', null, null, null), ('933', '44', '44', null, '2013-11-10 15:08:43', null), ('932', '43', '43', null, '2013-11-13 14:19:05', null), ('912', '23', '23', null, '2013-03-18 13:01:01', null), ('913', '24', '24', null, '2013-03-18 12:54:07', null), ('925', '36', '36', null, '2013-03-21 15:07:46', null), ('935', '46', '46', null, '2013-04-07 16:48:54', null), ('938', '49', '49', null, '2013-05-06 11:06:15', null), ('939', '50', '50', null, '2013-12-31 13:22:37', null), ('940', '51', '51', null, '2014-01-01 17:34:35', null), ('941', '52', '8', null, '2014-01-01 17:42:24', null), ('942', '53', '8', null, '2014-01-01 17:47:01', null), ('943', '54', '8', null, '2014-01-01 17:49:16', null), ('944', '55', '10', null, '2014-01-01 17:54:17', null), ('945', '56', '10', null, '2014-01-01 17:56:57', null), ('946', '57', '10', null, '2014-01-01 17:58:33', null), ('947', '58', '10', null, '2014-01-01 18:01:41', null), ('948', '59', '16', null, '2014-01-01 18:03:36', null), ('949', '60', '16', null, '2014-01-01 18:06:02', null), ('950', '61', '16', null, '2014-01-01 18:09:54', null), ('951', '62', '16', null, '2014-01-01 18:12:45', null), ('952', '63', '16', null, '2014-01-01 18:15:36', null), ('953', '64', '17', null, '2014-01-01 18:21:54', null), ('954', '65', '17', null, '2014-01-01 18:23:39', null), ('955', '66', '17', null, '2014-01-01 18:25:36', null), ('956', '67', '17', null, '2014-01-01 18:27:09', null), ('957', '68', '17', null, '2014-01-01 18:28:24', null), ('958', '69', '18', null, '2014-01-01 18:32:52', null), ('959', '70', '18', null, '2014-01-01 18:34:23', null), ('960', '71', '18', null, '2014-01-01 18:35:55', null), ('961', '72', '18', null, '2014-01-01 18:37:53', null), ('962', '73', '18', null, '2014-01-01 18:39:08', null), ('963', '74', '9', null, '2014-01-01 18:40:40', null), ('964', '75', '75', null, '2014-01-01 18:43:05', null), ('965', '76', '9', null, '2014-01-01 18:44:30', null), ('966', '77', '9', null, '2014-01-01 18:45:51', null), ('967', '78', '9', null, '2014-01-01 18:47:53', null), ('968', '79', '14', null, '2014-01-01 18:49:23', null), ('969', '80', '80', null, '2014-01-01 18:53:21', null), ('970', '81', '81', null, '2014-01-01 18:53:39', null), ('971', '82', '14', null, '2014-01-01 18:55:10', null), ('972', '83', '14', null, '2014-01-01 18:56:23', null), ('973', '84', '13', null, '2014-01-01 18:58:38', null), ('974', '85', '13', null, '2014-01-01 18:59:56', null), ('975', '86', '13', null, '2014-01-01 19:01:25', null), ('976', '87', '13', null, '2014-01-01 19:02:46', null), ('977', '88', '13', null, '2014-01-01 19:05:28', null), ('978', '89', '15', null, '2014-01-01 19:07:08', null), ('979', '90', '15', null, '2014-01-01 19:08:45', null), ('980', '91', '15', null, '2014-01-01 19:10:10', null), ('981', '92', '15', null, '2014-01-01 19:11:25', null), ('982', '93', '15', null, '2014-01-01 19:12:40', null), ('983', '94', '23', null, '2014-01-01 19:41:19', null), ('984', '95', '23', null, '2014-01-01 19:43:31', null), ('985', '96', '23', null, '2014-01-01 19:44:54', null), ('986', '97', '23', null, '2014-01-01 19:46:28', null), ('987', '98', '23', null, '2014-01-01 19:47:34', null), ('988', '99', '24', null, '2014-01-01 19:49:12', null), ('989', '100', '100', null, '2014-01-01 19:52:11', null), ('990', '101', '24', null, '2014-01-01 19:54:43', null), ('991', '102', '24', null, '2014-01-01 19:55:43', null), ('992', '103', '24', null, '2014-01-01 19:56:52', null), ('993', '104', '25', null, '2014-01-01 20:00:38', null), ('994', '105', '25', null, '2014-01-01 20:01:42', null), ('995', '106', '25', null, '2014-01-01 20:02:45', null), ('996', '107', '25', null, '2014-01-01 20:03:47', null), ('997', '108', '25', null, '2014-01-01 20:04:59', null), ('998', '109', '26', null, '2014-01-01 20:06:21', null), ('999', '110', '26', null, '2014-01-01 20:07:37', null), ('1000', '111', '26', null, '2014-01-01 20:08:49', null), ('1001', '112', '26', null, '2014-01-01 20:10:56', null), ('1002', '113', '26', null, '2014-01-01 20:12:10', null), ('1003', '114', '27', null, '2014-01-01 20:16:45', null), ('1004', '115', '27', null, '2014-01-01 20:17:57', null), ('1005', '116', '27', null, '2014-01-01 20:19:12', null), ('1006', '117', '27', null, '2014-01-01 20:21:50', null), ('1007', '118', '27', null, '2014-01-01 20:23:36', null), ('1008', '119', '28', null, '2014-01-01 20:27:10', null), ('1009', '120', '120', null, '2014-01-01 20:32:34', null), ('1010', '121', '121', null, '2014-01-01 20:34:13', null), ('1011', '122', '122', null, '2014-01-01 20:35:18', null), ('1012', '123', '28', null, '2014-01-01 20:36:35', null), ('1013', '124', '29', null, '2014-01-01 20:37:59', null), ('1014', '125', '29', null, '2014-01-01 20:39:54', null), ('1015', '126', '29', null, '2014-01-01 20:43:18', null), ('1016', '127', '29', null, '2014-01-01 20:44:39', null), ('1017', '128', '29', null, '2014-01-01 20:45:55', null), ('1018', '129', '30', null, '2014-01-01 20:47:16', null), ('1019', '130', '30', null, '2014-01-01 20:48:33', null), ('1020', '131', '30', null, '2014-01-01 20:50:58', null), ('1021', '132', '30', null, '2014-01-01 20:52:25', null), ('1022', '133', '30', null, '2014-01-01 20:53:36', null), ('1023', '134', '8', null, '2014-01-01 21:24:37', null), ('1024', '135', '8', null, '2014-01-01 21:25:56', null), ('1025', '136', '8', null, '2014-01-01 21:27:20', null), ('1026', '137', '8', null, '2014-01-01 21:28:24', null), ('1027', '138', '8', null, '2014-01-01 21:31:09', null), ('1028', '139', '8', null, '2014-01-01 21:32:37', null), ('1029', '140', '25', null, '2014-01-01 21:34:47', null), ('1030', '141', '25', null, '2014-01-01 21:36:20', null), ('1031', '142', '25', null, '2014-01-01 21:37:23', null), ('1032', '143', '25', null, '2014-01-01 21:38:45', null), ('1033', '144', '25', null, '2014-01-01 21:39:46', null), ('1034', '145', '27', null, '2014-01-01 21:42:30', null), ('1035', '146', '27', null, '2014-01-01 21:43:50', null), ('1036', '147', '27', null, '2014-01-01 21:45:01', null), ('1037', '148', '27', null, '2014-01-01 21:46:24', null), ('1038', '149', '27', null, '2014-01-01 21:48:14', null), ('1039', '150', '10', null, '2014-01-01 21:50:02', null), ('1040', '151', '10', null, '2014-01-01 21:51:38', null), ('1041', '152', '10', null, '2014-01-01 21:52:50', null), ('1042', '153', '10', null, '2014-01-01 21:54:51', null), ('1043', '154', '10', null, '2014-01-01 21:57:07', null), ('1044', '155', '24', null, '2014-01-01 22:02:05', null), ('1045', '156', '24', null, '2014-01-01 22:03:16', null), ('1046', '157', '24', null, '2014-01-01 22:06:12', null), ('1047', '158', '24', null, '2014-01-01 22:07:24', null), ('1048', '159', '24', null, '2014-01-01 22:08:46', null), ('1049', '160', '30', null, '2014-01-01 22:13:22', null), ('1050', '161', '30', null, '2014-01-01 22:15:06', null), ('1051', '162', '30', null, '2014-01-01 22:16:15', null), ('1052', '163', '15', null, '2014-01-01 22:18:26', null), ('1053', '164', '15', null, '2014-01-01 22:21:21', null), ('1054', '165', '15', null, '2014-01-01 22:24:50', null), ('1055', '166', '15', null, '2014-01-02 08:50:01', null), ('1056', '167', '167', null, '2014-01-02 08:56:05', null), ('1057', '168', '8', null, '2014-01-02 08:57:31', null), ('1058', '169', '30', null, '2014-01-02 08:58:57', null), ('1059', '170', '30', null, '2014-01-02 09:02:59', null), ('1060', '171', '30', null, '2014-01-02 09:04:50', null), ('1061', '172', '30', null, '2014-01-02 09:06:11', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_itvmoviecertificate`
-- ----------------------------
DROP TABLE IF EXISTS `mw_itvmoviecertificate`;
CREATE TABLE `mw_itvmoviecertificate` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `value` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_itvmoviecertificate`
-- ----------------------------
BEGIN;
INSERT INTO `mw_itvmoviecertificate` VALUES ('1', '1         ', 'G'), ('2', '2         ', 'PG'), ('3', '3         ', 'PG-13'), ('4', '4         ', 'PG-15'), ('5', '5         ', 'R');
COMMIT;

-- ----------------------------
--  Table structure for `mw_itvmoviepictures`
-- ----------------------------
DROP TABLE IF EXISTS `mw_itvmoviepictures`;
CREATE TABLE `mw_itvmoviepictures` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `Menuname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `MovieId` int(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_itvmoviepictures`
-- ----------------------------
BEGIN;
INSERT INTO `mw_itvmoviepictures` VALUES ('24', 'Picture1', '555'), ('25', 'Picture2', '551'), ('26', 'Picture3', '552'), ('27', 'Picture4', '558'), ('28', 'Picture5', '557');
COMMIT;

-- ----------------------------
--  Table structure for `mw_itvmovietrailer`
-- ----------------------------
DROP TABLE IF EXISTS `mw_itvmovietrailer`;
CREATE TABLE `mw_itvmovietrailer` (
  `Id` int(4) NOT NULL AUTO_INCREMENT,
  `MovieId` int(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `mw_itvtv_bygenre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_itvtv_bygenre`;
CREATE TABLE `mw_itvtv_bygenre` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `TVChannelID` int(4) DEFAULT NULL,
  `TVGenreID` int(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=459 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_itvtv_bygenre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_itvtv_bygenre` VALUES ('247', '71', '10'), ('246', '70', '7'), ('458', '151', '8'), ('457', '150', '12');
COMMIT;

-- ----------------------------
--  Table structure for `mw_itvtvgenre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_itvtvgenre`;
CREATE TABLE `mw_itvtvgenre` (
  `GndrId` int(4) NOT NULL AUTO_INCREMENT,
  `Code` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `GndrNm` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `LangId` int(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`GndrId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_itvtvgenre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_itvtvgenre` VALUES ('1', 'TVGenreALL', 'All', '1', null, null), ('2', 'TVGenreFavourite', 'Favourite', '1', null, null), ('3', 'TVGenreNews', 'News', '1', null, null), ('4', 'TVGenreSport', 'Sport', '1', null, null), ('5', 'TVGenreMovie', 'Movie', '1', null, null), ('6', 'TVGenreMusics', 'Music', '1', null, null), ('7', 'TVGenreGeneral', 'General', '1', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_language`
-- ----------------------------
DROP TABLE IF EXISTS `mw_language`;
CREATE TABLE `mw_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_label` varchar(20) DEFAULT NULL,
  `desc` text,
  `hotel_lang_tag` varchar(20) DEFAULT NULL,
  `is_activated` varchar(1) DEFAULT NULL,
  `dateformat` varchar(20) DEFAULT NULL,
  `timeformat` varchar(20) DEFAULT NULL,
  `price_decimals` varchar(10) DEFAULT NULL,
  `price_decimal_sign` varchar(10) DEFAULT NULL,
  `price_thousand_sign` varchar(10) DEFAULT NULL,
  `select` varchar(1) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_language`
-- ----------------------------
BEGIN;
INSERT INTO `mw_language` VALUES ('1', 'en', 'English', 'English', '1', 'yy/mm', 'hh/ss', '100', '.', '.', null, null, '2012-11-18 15:00:15'), ('2', 'ar', 'Arabic', 'Arabic', '0', 'mm-dd', 'hh:ss', '10', ',', ',', null, null, null), ('5', 'kr', 'Korean', 'sdfasda', '0', 'dd/mm/yyyy', 'HH:SS', ',', '$', ',', null, '2012-11-18 14:59:45', '2012-11-18 15:01:06');
COMMIT;

-- ----------------------------
--  Table structure for `mw_localinfo`
-- ----------------------------
DROP TABLE IF EXISTS `mw_localinfo`;
CREATE TABLE `mw_localinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_localinfo`
-- ----------------------------
BEGIN;
INSERT INTO `mw_localinfo` VALUES ('13', 'CULTURAL DISTRICT', 'Zaya-IPTV-Concept-Design_R6.jpg', '&lt;p&gt;Saadiyat Cultural District ,a live canvas for global culture, drawing local, regional and international visitors with unique exhibitions, permanent collections, productions and performances.&lt;/p&gt;\n', '2016-09-25 11:56:40', '0000-00-00 00:00:00', 'en'), ('14', 'BOOK', 'mafraq.png', '&lt;p&gt;To book, contact our team by dialling &amp;#39;0&amp;#39; on your villa phone or whatsapp us at &lt;strong&gt;+971 00 000 0000&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n', '2016-09-25 11:58:22', '2016-10-24 03:29:38', 'en'), ('11', 'GOLF', 'Golf.jpg', '&lt;p&gt;The Yas Links Golf Club boasts an 18-hole golf course with ocean views.&lt;/p&gt;\n', '2016-09-25 11:55:35', '2016-10-24 03:30:07', 'en'), ('12', 'WATER PARK', 'Waterpark.jpg', '&lt;p&gt;Spend a day at Yas Waterworld, the biggest water park in the Middle East. Spread over a monstrous 15 hectares, the waterpark features a range of 45 rides and attractions.&lt;/p&gt;\n', '2016-09-25 11:56:07', '0000-00-00 00:00:00', 'en');
COMMIT;

-- ----------------------------
--  Table structure for `mw_localinfo_menus`
-- ----------------------------
DROP TABLE IF EXISTS `mw_localinfo_menus`;
CREATE TABLE `mw_localinfo_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `localinfo` int(10) unsigned NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_localinfo_menus`
-- ----------------------------
BEGIN;
INSERT INTO `mw_localinfo_menus` VALUES ('15', 'GOE Test 1', '&lt;p&gt;lorem ipsum&lt;/p&gt;', '7', '2015-05-21 17:21:49', 'a.png', '2016-08-08 16:08:49'), ('16', 'GOE Test 2', '&lt;p&gt;Lorem ipsum 2&lt;/p&gt;', '7', '2016-08-08 16:09:21', 'a1.png', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `mw_login_attempts`;
CREATE TABLE `mw_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `mw_message`
-- ----------------------------
DROP TABLE IF EXISTS `mw_message`;
CREATE TABLE `mw_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_message`
-- ----------------------------
BEGIN;
INSERT INTO `mw_message` VALUES ('27', 'Welcome to IPTV', '2015-05-21 17:34:42', '2016-03-07 13:21:41');
COMMIT;

-- ----------------------------
--  Table structure for `mw_metadata`
-- ----------------------------
DROP TABLE IF EXISTS `mw_metadata`;
CREATE TABLE `mw_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `director` varchar(255) NOT NULL,
  `cast` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `mw_movie`
-- ----------------------------
DROP TABLE IF EXISTS `mw_movie`;
CREATE TABLE `mw_movie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `genreId` int(10) unsigned NOT NULL,
  `genreName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mrl` varchar(255) CHARACTER SET latin1 NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `language` varchar(255) CHARACTER SET latin1 NOT NULL,
  `prLevel` int(10) unsigned NOT NULL,
  `prAccess` varchar(3) DEFAULT NULL,
  `prName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `metadata` tinytext CHARACTER SET latin1,
  `logo` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `mrl_trailer` varchar(45) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `is_paid` varchar(3) DEFAULT NULL,
  `paid_amount` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_movie`
-- ----------------------------
BEGIN;
INSERT INTO `mw_movie` VALUES ('43', 'Pain and Gain', '10', 'Comedy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '90', 'From acclaimed director Michael Bay comes Pain & Gain, a new action comedy starring Mark Wahlberg, Dwayne Johnson and Anthony Mackie. ', 'en', '0', null, 'Select', null, 'pain_big.png', 'pain_small.png', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2013-04-07 15:53:05', '2013-11-13 14:19:05', null, '0'), ('44', 'G.I. Joe', '17', 'Fantasy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'The G.I. Joes are not only fighting their mortal enemy, Cobra, they are forced to contend with threats from within the government that jeopardize thei', 'en', '0', null, 'Select', null, 'jigeo-big.png', 'jigeo-small.png', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2013-04-07 16:15:00', '2013-11-10 15:08:43', null, '0'), ('45', 'Olympus Has Fallen', '8', 'Action', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'When the President is kidnapped by a terrorist who seizes control of the White House, disgraced former Presidential guard Mike Banning finds himself.', 'en', '0', null, 'Select', null, 'olympus-big.png', 'olympus-small.png', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2013-04-07 16:16:32', '2013-11-10 15:08:56', null, '0'), ('50', 'Secretary', '17', 'Fantasy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'test', 'en', '0', null, 'Select', null, 'sec1.jpg', 'sec2.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2013-12-31 13:14:58', '2013-12-31 13:22:37', null, '0'), ('51', 'The Hunger Games: Catching Fire', '8', 'Action', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Katniss Everdeen and Peeta Mellark become targets of the Capitol after their victory in the 74th Hunger Games sparks a rebellion in the Districts of P', 'en', '0', null, 'Select', null, 'c1.jpg', 'c2.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:34:05', '2014-01-01 17:34:35', null, '0'), ('52', '47 Ronin ', '8', 'Action', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '119', 'A band of samurai set out to avenge the death and dishonor of their master at the hands of a ruthless shogun.', 'en', '0', null, 'Select', null, 'c32.jpg', 'c4.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:42:24', null, null, '0'), ('53', 'Divergent', '8', 'Action', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Beatrice Prior, a teenager with a special mind, finds her life threatened when an authoritarian leader seeks to exterminate her kind in her effort to ', 'en', '0', null, 'Select', null, 'c5.jpg', 'c6.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:47:01', null, null, '0'), ('54', 'Dhoom: 3', '8', 'Action', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '172', 'To avenge his fathers death, a circus entertainer trained in magic and acrobatics turns thief to take down a corrupt bank in Chicago. Two cops from M', 'en', '0', null, 'Select', null, 'c7.jpg', 'c8.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:49:16', null, null, '0'), ('55', 'The Wolf of Wall Street', '10', 'Comedy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '180', 'Based on the true story of Jordan Belfort, from his rise to a wealthy stockbroker living the high life to his fall involving crime, corruption and the', 'en', '0', null, 'Select', null, 'c92.jpg', 'c10.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:54:17', null, null, '0'), ('56', 'Frozen', '10', 'Comedy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '102', 'Fearless optimist Anna teams up with Kristoff in an epic journey, encountering Everest-like conditions, and a hilarious snowman named Olaf in a race..', 'en', '0', null, 'Select', null, 'c11.jpg', 'c12.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:56:57', null, null, '0'), ('57', 'Anchorman 2: The Legend Continues ', '10', 'Comedy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '119', 'With the 70s behind him, San Diegos top rated newsman, Ron Burgundy, returns to take New Yorks first 24-hour news channel by storm', 'en', '0', null, 'Select', null, 'c13.jpg', 'c14.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 17:58:33', null, null, '0'), ('58', 'Saving Mr. Banks ', '10', 'Comedy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '125', 'Author P. L. Travers reflects on her difficult childhood while meeting with filmmaker Walt Disney during production for the adaptation of her novel..', 'en', '0', null, 'Select', null, 'c15.jpg', 'c16.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:01:41', null, null, '0'), ('59', 'Justin Biebers Believe', '16', 'Documentary', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '92', 'A backstage and on-stage look at Justin Bieber during his rise to super stardom.', 'en', '0', null, 'Select', null, 'c17.jpg', 'c18.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:03:36', null, null, '0'), ('60', 'Blackfish', '16', 'Documentary', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '83', 'Notorious killer whale Tilikum is responsible for the deaths of three individuals, including a top killer whale trainer. ', 'en', '0', null, 'Select', null, 'c20.jpg', 'c21.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:06:02', null, null, '0'), ('61', 'One Direction: This Is Us', '16', 'Documentary', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '92', 'A look at Niall, Zayn, Liam, Louis, and Harrys meteoric rise to fame, from their humble hometown beginnings and competing on the X-Factor,', 'en', '0', null, 'Select', null, 'c22.jpg', 'c23.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:09:54', null, null, '0'), ('62', 'Tims Vermeer ', '16', 'Documentary', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '80', 'Inventor Tim Jenison seeks to understand the painting techniques used by Dutch Master Johannes Vermeer.', 'en', '0', null, 'Select', null, 'c24.jpg', 'c25.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:12:45', null, null, '0'), ('63', 'Justin Bieber: Never Say Never', '16', 'Documentary', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '105', 'Follows Justin Bieber with some footage of performances from his 2010 concert tour.', 'en', '0', null, 'Select', null, 'c26.jpg', 'c27.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:15:36', null, null, '0'), ('64', 'The Hobbit: The Desolation of Smaug', '17', 'Fantasy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '161', 'The dwarves, along with Bilbo Baggins and Gandalf the Grey, continue their quest to reclaim Erebor, their homeland, from Smaug. ', 'en', '0', null, 'Select', null, 'c28.jpg', 'c29.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:21:54', null, null, '0'), ('65', 'The Secret Life of Walter Mitty', '17', 'Fantasy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '114', 'A day-dreamer escapes his anonymous life by disappearing into a world of fantasies filled with heroism, romance and action.', 'en', '0', null, 'Select', null, 'c30.jpg', 'c31.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:23:39', null, null, '0'), ('66', 'The Hobbit: An Unexpected Journey', '17', 'Fantasy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '169', 'A younger and more reluctant Hobbit, Bilbo Baggins, sets out on an unexpected journey to the Lonely Mountain with a spirited group of Dwarves..', 'en', '0', null, 'Select', null, 'c321.jpg', 'c33.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:25:36', null, null, '0'), ('67', '	 30 The Amazing Spider-Man 2', '17', 'Fantasy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Peter Parker runs the gauntlet as the mysterious company Oscorp sends up a slew of supervillains against him, impacting on his life.', 'en', '0', null, 'Select', null, 'c34.jpg', 'c35.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:27:09', null, null, '0'), ('68', 'How the Grinch Stole Christmas', '17', 'Fantasy', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '104', 'Big budget remake of the classic cartoon about a creature intent on stealing Christmas.', 'en', '0', null, 'Select', null, 'c36.jpg', 'c37.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:28:24', null, null, '0'), ('69', '12 Years a Slave', '18', 'History', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '134', 'In the antebellum United States, Solomon Northup, a free black man from upstate New York, is abducted and sold into slavery.', 'en', '0', null, 'Select', null, 'c38.jpg', 'c39.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:32:52', null, null, '0'), ('70', 'Mandela: Long Walk to Freedom ', '18', 'History', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '139', 'A chronicle of Nelson Mandelas life journey from his childhood in a rural village through to his inauguration as the first democratically elected..', 'en', '0', null, 'Select', null, 'c40.jpg', 'c41.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:34:23', null, null, '0'), ('71', 'Dallas Buyers Club ', '18', 'History', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '117', 'In 1985 Dallas, electrician and hustler Ron Woodroof works around the system to help AIDS patients get the medication they need after he is himself..', 'en', '0', null, 'Select', null, 'c42.jpg', 'c43.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:35:55', null, null, '0'), ('72', 'Argo ', '18', 'History', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Acting under the cover of a Hollywood producer scouting a location for a science fiction film, a CIA agent launches a dangerous..', 'en', '0', null, 'Select', null, 'c44.jpg', 'c45.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:37:53', null, null, '0'), ('73', '	 Top 500 The Frozen Ground', '18', 'History', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '105', 'An Alaska State Trooper partners with a young woman who escaped the clutches of serial killer Robert Hansen to bring the murderer to justice. ', 'en', '0', null, 'Select', null, 'c46.jpg', 'c47.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:39:08', null, null, '0'), ('74', 'The Conjuring', '9', 'Horror', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '112', 'Paranormal investigators Ed and Lorraine Warren work to help a family terrorized by a dark presence in their farmhouse', 'en', '0', null, 'Select', null, 'c48.jpg', 'c49.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:40:40', null, null, '0'), ('75', 'Insidious: Chapter 2', '9', 'Horror', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '106', 'The haunted Lambert family seeks to uncover the mysterious childhood secret that has left them dangerously connected to the spirit world.', 'en', '0', null, 'Select', null, 'c50.jpg', 'c51.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:41:52', '2014-01-01 18:43:05', null, '0'), ('76', 'Paranormal Activity: The Marked Ones ', '9', 'Horror', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '84', 'After being marked, Jesse begins to be pursued by mysterious forces while his family and friends try to save him.', 'en', '0', null, 'Select', null, 'c12.jpg', 'c22.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:44:30', null, null, '0'), ('77', ' World War Z', '9', 'Horror', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '116', 'United Nations employee Gerry Lane traverses the world in a race against time to stop the Zombie pandemic that is toppling armies and governments,', 'en', '0', null, 'Select', null, 'c33.jpg', 'c42.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:45:51', null, null, '0'), ('78', 'Carrie', '9', 'Horror', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '100', 'A reimagining of the classic horror tale about Carrie White, a shy girl outcast by her peers and sheltered by her deeply religious mother,', 'en', '0', null, 'Select', null, 'c51.jpg', 'c61.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:47:53', null, null, '0'), ('79', 'The Mortal Instruments: City of Bones', '14', 'Mystery', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '130', 'When her mother disappears, Clary Fray learns that she descends from a line of warriors who protect our world from demons.', 'en', '0', null, 'Select', null, 'c71.jpg', 'c81.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:49:23', null, null, '0'), ('80', 'Now You See Me', '14', 'Mystery', 'r rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '115', 'An FBI agent and an Interpol detective track a team of illusionists who pull off bank heists during their performances and reward their audiences..', 'en', '0', null, 'Select', null, 'c93.jpg', 'c101.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:50:53', '2014-01-01 18:53:21', null, '0'), ('81', 'Harry Potter and the Deathly Hallows: Part 2', '14', 'Mystery', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '130', 'Harry, Ron and Hermione search for Voldemorts remaining Horcruxes in their effort to destroy the Dark Lord.', 'en', '0', null, 'Select', null, 'c111.jpg', 'c121.jpg', '  rtsp://10.1.128.11/media/BigBucksBunny_SD.t', '2014-01-01 18:52:15', '2014-01-01 18:53:39', null, '0'), ('82', 'The Prestige ', '14', 'Mystery', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '130', 'The rivalry between two magicians becomes more exacerbated by their attempt to perform the ultimate illusion.', 'en', '0', null, 'Select', null, 'c131.jpg', 'c141.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:55:10', null, null, '0'), ('83', 'Inception', '14', 'Mystery', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '148', 'A skilled extractor is offered a chance to regain his old life as payment for a task considered to be impossible.', 'en', '0', null, 'Select', null, 'c151.jpg', 'c161.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:56:23', null, null, '0'), ('84', 'Divergent ', '13', 'Sci-Fi', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Beatrice Prior, a teenager with a special mind, finds her life threatened when an authoritarian leader seeks to exterminate her kind in her effort..', 'en', '0', null, 'Select', null, 'c171.jpg', 'c181.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:58:38', null, null, '0'), ('85', 'Transformers: Age of Extinction', '13', 'Sci-Fi', 'r rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'A mechanic and his daughter make a discovery that brings down Autobots and Decepticons - and a paranoid government official - on them.', 'en', '0', null, 'Select', null, 'c19.jpg', 'c20.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 18:59:56', null, null, '0'), ('86', 'Dawn of the Planet of the Apes', '13', 'Sci-Fi', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Survivors of the simian plague trigger an all-out war between humanity and Caesars growing forces.', 'en', '0', null, 'Select', null, 'c21.jpg', 'c221.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:01:25', null, null, '0'), ('87', 'Elysium (I)', '13', 'Sci-Fi', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '109', 'In the year 2154, the very wealthy live on a man-made space station while the rest of the population resides on a ruined Earth.', 'en', '0', null, 'Select', null, 'c23.jpg', 'c24.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:02:46', null, null, '0'), ('88', 'Man of Steel', '13', 'Sci-Fi', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '143', 'A young itinerant worker is forced to confront his secret extrastellar origin when Earth is invaded by members of his own race.', 'en', '0', null, 'Select', null, 'c25.jpg', 'c26.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:05:28', null, null, '0'), ('89', 'Prisoners', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '153', 'When Keller Dovers daughter and her friend go missing, he takes matters into his own hands as the police pursue multiple leads and the pressure mount', 'en', '0', null, 'Select', null, 'c27.jpg', 'c28.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:07:08', null, null, '0'), ('90', 'Lone Survivor', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '121', 'Based on the failed June 28, 2005 mission Operation Red Wings. Four members of SEAL Team 10 were tasked with the mission to capture or kill notoriou', 'en', '0', null, 'Select', null, 'c29.jpg', 'c30.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:08:45', null, null, '0'), ('91', 'Out of the Furnace', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '116', 'When Rodney Baze mysteriously disappears and law enforcement doesnt follow through fast enough, his older brother,', 'en', '0', null, 'Select', null, 'c311.jpg', 'c32.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:10:10', null, null, '0'), ('92', 'Gravity ', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '91', 'A medical engineer and an astronaut work together to survive after an accident leaves them adrift in space.', 'en', '0', null, 'Select', null, 'c331.jpg', 'c34.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:11:25', null, null, '0'), ('93', 'Riddick ', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '119', 'Left for dead on a sun-scorched planet, Riddick finds himself up against an alien race of predators. ', 'en', '0', null, 'Select', null, 'c35.jpg', 'c36.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:12:40', null, null, '0'), ('94', 'A Christmas Story', '23', 'Family', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '94', 'Ralphie has to convince his parents, his teacher, and Santa that a Red Ryder B.B. gun really is the perfect gift for the 1940s.', 'en', '0', null, 'Select', null, 'c37.jpg', 'c38.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:41:19', null, null, '0'), ('95', 'The Sound of Music', '23', 'Family', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '174', 'A woman leaves an Austrian convent to become a governess to the children of a Naval officer widower.', 'en', '0', null, 'Select', null, 'c39.jpg', 'c40.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:43:31', null, null, '0'), ('96', 'Home Alone', '23', 'Family', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '103', 'An 8-year-old boy who is accidentally left behind while his family flies to France for Christmas must defend his home against idiotic burglars.', 'en', '0', null, 'Select', null, 'c41.jpg', 'c421.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:44:54', null, null, '0'), ('97', 'Its a Wonderful Life ', '23', 'Family', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '130', 'An angel helps a compassionate but despairingly frustrated businessman by showing what life would have been like if he never existed.', 'en', '0', null, 'Select', null, 'c43.jpg', 'c44.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:46:28', null, null, '0'), ('98', 'Elf ', '23', 'Family', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '97', 'After inadvertently wreaking havoc on the elf community due to his ungainly size, a man raised as an elf at the North Pole is sent to the U.S. in sear', 'en', '0', null, 'Select', null, 'c45.jpg', 'c46.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:47:34', null, null, '0'), ('99', 'American Hustle', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '138', 'A con man, Irving Rosenfeld, along with his seductive British partner, Sydney Prosser, is forced to work for a wild FBI agent,', 'en', '0', null, 'Select', null, 'c47.jpg', 'c48.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:49:12', null, null, '0'), ('100', 'Were the Millers', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '110', 'A veteran pot dealer creates a fake family as part of his plan to move a huge shipment of weed into the U.S. from Mexico.', 'en', '0', null, 'Select', null, 'c49.jpg', 'c50.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:50:22', '2014-01-01 19:52:11', null, '0'), ('101', 'Kick-Ass 2 ', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '103', 'The costumed high-school hero Kick-Ass joins with a group of normal citizens who have been inspired to fight crime in costume.', 'en', '0', null, 'Select', null, 'c14.jpg', 'c210.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:54:43', null, null, '0'), ('102', 'The Family', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '111', 'The Manzoni family, a notorious mafia clan, is relocated to Normandy, France under the witness protection program, ', 'en', '0', null, 'Select', null, 'c310.jpg', 'c410.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:55:43', null, null, '0'), ('103', 'The Best Offer ', '24', 'Crime', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '131', 'A master auctioneer becomes obsessed with an extremely reclusive heiress who collects fine art.', 'en', '0', null, 'Select', null, 'c52.jpg', 'c62.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 19:56:52', null, null, '0'), ('104', 'Despicable Me 2 ', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '98', 'Gru is recruited by the Anti-Villain League to help deal with a powerful new super criminal.', 'en', '0', null, 'Select', null, 'c72.jpg', 'c82.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:00:38', null, null, '0'), ('105', 'How to Train Your Dragon 2', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Its been five years since Hiccup and Toothless successfully united dragons and vikings on the island of Berk. While Astrid,', 'en', '0', null, 'Select', null, 'c94.jpg', 'c102.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:01:42', null, null, '0'), ('106', 'Walking with Dinosaurs 3D', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '87', 'See and feel what it was like when dinosaurs ruled the Earth, in a story where an underdog dino triumphs to become a hero for the ages.', 'en', '0', null, 'Select', null, 'c112.jpg', 'c122.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:02:45', null, null, '0'), ('107', 'The Polar Express ', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '100', 'On Christmas Eve, a doubting boy boards a magical train thats headed to the North Pole and Santa Claus home.', 'en', '0', null, 'Select', null, 'c132.jpg', 'c142.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:03:47', null, null, '0'), ('108', 'A Christmas Carol ', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '96', 'An animated retelling of Charles Dickens classic novel about a Victorian-era miser taken on a journey of self-redemption, ', 'en', '0', null, 'Select', null, 'c152.jpg', 'c162.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:04:59', null, null, '0'), ('109', 'Don Jon', '26', 'Romance', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '90', 'A New Jersey guy dedicated to his family, friends, and church, develops unrealistic expectations from watching porn and works to find happiness..', 'en', '0', null, 'Select', null, 'c172.jpg', 'c182.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:06:21', null, null, '0'), ('110', 'Love Actually ', '26', 'Romance', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '135', 'Follows the lives of eight very different couples in dealing with their love lives in various loosely and interrelated tales all set during a frantic ', 'en', '0', null, 'Select', null, 'c191.jpg', 'c201.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:07:37', null, null, '0'), ('111', 'Her ', '26', 'Romance', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '126', 'A lonely writer develops an unlikely relationship with his newly purchased operating system thats designed to meet his every need.', 'en', '0', null, 'Select', null, 'c211.jpg', 'c222.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:08:49', null, null, '0'), ('112', 'The Great Gatsby ', '26', 'Romance', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '143', 'A Midwestern war veteran finds himself drawn to the past and lifestyle of his millionaire neighbor.', 'en', '0', null, 'Select', null, 'c231.jpg', 'c241.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:10:56', null, null, '0'), ('113', 'The Spectacular Now', '26', 'Romance', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '95', 'A hard-partying high school seniors philosophy on life changes when he meets the not-so-typical nice girl.', 'en', '0', null, 'Select', null, 'c251.jpg', 'c261.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:12:10', null, null, '0'), ('114', 'Thor: The Dark World', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '112', 'Faced with an enemy that even Odin and Asgard cannot withstand, Thor must embark on his most perilous and personal journey yet, ', 'en', '0', null, 'Select', null, 'c271.jpg', 'c281.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:16:45', null, null, '0'), ('115', 'X-Men: Days of Future Past', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'The X-Men send Wolverine to the past in a desperate effort to change history and prevent an event that results in doom for both humans and mutants.', 'en', '0', null, 'Select', null, 'c291.jpg', 'c301.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:17:57', null, null, '0'), ('116', 'Guardians of the Galaxy ', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'A jet pilot gets stranded in space, and must unite a diverse team of aliens to form a squad capable of defeating cosmic threats.', 'en', '0', null, 'Select', null, 'c312.jpg', 'c321.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:19:12', null, null, '0'), ('117', 'The Lone Ranger ', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '149', 'Native American warrior Tonto recounts the untold tales that transformed John Reid, a man of the law, into a legend of justice', 'en', '0', null, 'Select', null, 'c332.jpg', 'c341.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:21:50', null, null, '0'), ('118', 'The Wolverine', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '126', 'When Wolverine is summoned to Japan by an old acquaintance, he is embroiled in a conflict that forces him to confront his own demons.', 'en', '0', null, 'Select', null, 'c351.jpg', 'c371.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:23:36', null, null, '0'), ('119', 'White Christmas', '28', 'Musical', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'A successful song-and-dance team become romantically involved with a sister act and team up to save the failing Vermont inn of their former commanding', 'en', '0', null, 'Select', null, 'c381.jpg', 'c391.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:27:10', null, null, '0'), ('120', 'Les Misérables', '28', 'Musical', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '158', 'In 19th-century France, Jean Valjean, who for decades has been hunted by the ruthless policeman Javert after breaking parole,', 'en', '0', null, 'Select', null, 'c16.jpg', 'c211.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:28:12', '2014-01-01 20:32:34', null, '0'), ('121', 'The Rocky Horror Picture Show', '28', 'Musical', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '100', 'A newly engaged couple have a breakdown in an isolated area and must pay a call to the bizarre residence of Dr. Frank-N-Furter.', 'en', '0', null, 'Select', null, 'c313.jpg', 'c411.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:29:21', '2014-01-01 20:34:13', null, '0'), ('122', 'Meet Me in St. Louis', '28', 'Musical', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '113', 'In the year before the 1904 St Louis Worlds Fair, the four Smith daughters learn lessons of life and love, even as they prepare for a reluctant move ', 'en', '0', null, 'Select', null, 'c53.jpg', 'c63.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:30:38', '2014-01-01 20:35:18', null, '0'), ('123', 'Burlesque (I) ', '28', 'Musical', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '119', 'A small-town girl ventures to Los Angeles and finds her place in a neo-burlesque club run by a former dancer.', 'en', '0', null, 'Select', null, 'c73.jpg', 'c83.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:36:35', null, null, '0'), ('124', 'Grudge Match', '29', 'Sport', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '113', 'A pair of aging boxing rivals are coaxed out of retirement to fight one final bout -- 30 years after their last match.', 'en', '0', null, 'Select', null, 'c95.jpg', 'c103.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:37:59', null, null, '0'), ('125', 'Draft Day', '29', 'Sport', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'The General Manager of the Cleveland Browns struggles to acquire the number one draft pick for his team.', 'en', '0', null, 'Select', null, 'c121.jpg', 'c13.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:39:54', null, null, '0'), ('126', ' Warrior', '29', 'Sport', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '140', 'The youngest son of an alcoholic former boxer returns home, where hes trained by his father for competition in a mixed martial arts tournament..', 'en', '0', null, 'Select', null, 'c141.jpg', 'c15.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:43:18', null, null, '0'), ('127', 'Dodgeball: A True Underdog Story', '29', 'Sport', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '92', 'A group of misfits enter a Las Vegas dodgeball tournament in order to save their cherished local gym from the onslaught of a corporate health fitness ', 'en', '0', null, 'Select', null, 'c161.jpg', 'c17.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:44:39', null, null, '0'), ('128', 'The Fighter (I)', '29', 'Sport', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '116', 'A look at the early years of boxer Irish Micky Ward and his brother who helped train him before going pro in the mid 1980s.', 'en', '0', null, 'Select', null, 'c18.jpg', 'c19.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:45:55', null, null, '0'), ('129', '300: Rise of an Empire', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'The Greek general Themistocles battles an invading army of Persians under the mortal-turned-god, Xerxes.', 'en', '0', null, 'Select', null, 'c201.jpg', 'c212.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:47:16', null, null, '0'), ('130', 'The Book Thief', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '131', 'While subjected to the horrors of World War II Germany, young Liesel finds solace by stealing books and sharing them with others. Under the stairs in ', 'en', '0', null, 'Select', null, 'c221.jpg', 'c231.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:48:33', null, null, '0'), ('131', 'Inglourious Basterds', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '153', 'In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre..', 'en', '0', null, 'Select', null, 'c241.jpg', 'c251.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:50:58', null, null, '0'), ('132', 'Saving Private Ryan', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '169', 'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.', 'en', '0', null, 'Select', null, 'c261.jpg', 'c271.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:52:25', null, null, '0'), ('133', 'Red Dawn', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '93', 'A group of teenagers look to save their town from an invasion of North Korean soldiers.', 'en', '0', null, 'Select', null, 'c281.jpg', 'c291.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 20:53:36', null, null, '0'), ('134', 'Godzilla ', '8', 'Action', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'A giant radioactive monster called Godzilla appears to wreak destruction on mankind.', 'en', '0', null, 'Select', null, 'c301.jpg', 'c311.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:24:37', null, null, '0'), ('135', 'The Lord of the Rings: The Fellowship of the Ring', '8', 'Action', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '178', 'A meek hobbit of The Shire and eight companions set out on a journey to Mount Doom to destroy the One Ring and the dark lord Sauron.', 'en', '0', null, 'Select', null, 'c322.jpg', 'c331.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:25:56', null, null, '0'), ('136', 'Fast & Furious 6', '8', 'Action', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '130', 'Hobbs has Dom and Brian reassemble their crew in order to take down a mastermind who commands an organization of mercenary drivers across 12 countries', 'en', '0', null, 'Select', null, 'c341.jpg', 'c351.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:27:20', null, null, '0'), ('137', '2 Guns', '8', 'Action', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '109', 'A DEA agent and a naval intelligence officer find themselves on the run after a botched attempt to infiltrate a drug cartel.', 'en', '0', null, 'Select', null, 'c361.jpg', 'c372.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:28:24', null, null, '0'), ('138', 'Pitch Black  ', '8', 'Action', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '109', 'A prisoner transport ship and its crew are marooned on a planet full of bloodthirsty creatures that only come out to feast at night. ', 'en', '0', null, 'Select', null, 'c382.jpg', 'c392.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:31:09', null, null, '0'), ('139', 'Aliens', '8', 'Action', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '137', 'The planet from Alien (1979) has been colonized, but contact is lost. This time, the rescue team has impressive firepower, but will it be enough?', 'en', '0', null, 'Select', null, 'c401.jpg', 'c412.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:32:37', null, null, '0'), ('140', 'Tangled', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '100', 'The magically long-haired Rapunzel has spent her entire life in a tower, but now that a runaway thief has stumbled upon her, she is about to discover ', 'en', '0', null, 'Select', null, 'c431.jpg', 'c441.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:34:47', null, null, '0'), ('141', 'Despicable Me', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '95', 'When a criminal mastermind uses a trio of orphan girls as pawns for a grand scheme, he finds their love is profoundly changing him for the better.', 'en', '0', null, 'Select', null, 'c110.jpg', 'c213.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:36:20', null, null, '0'), ('142', 'Finding Nemo', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '100', 'After his son is captured in the Great Barrier Reef and taken to Sydney, a timid clownfish sets out on a journey to bring him home.', 'en', '0', null, 'Select', null, 'c314.jpg', 'c413.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:37:23', null, null, '0'), ('143', 'Monsters University ', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '104', 'A look at the relationship between Mike and Sulley during their days at Monsters University -- when they werent necessarily the best of friends.', 'en', '0', null, 'Select', null, 'c54.jpg', 'c64.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:38:45', null, null, '0'), ('144', 'The Nightmare Before Christmas ', '25', 'Animation', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '76', 'Jack Skellington, king of Halloweentown, discovers Christmas Town, but doesnt quite understand the concept.', 'en', '0', null, 'Select', null, 'c74.jpg', 'c84.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:39:46', null, null, '0'), ('145', 'Percy Jackson: Sea of Monsters', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '106', 'In order to restore their dying safe haven, the son of Poseidon and his friends embark on a quest to the Sea of Monsters to find the mythical Golden..', 'en', '0', null, 'Select', null, 'c96.jpg', 'c104.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:42:30', null, null, '0'), ('146', 'Pacific Rim ', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '131', 'As a war between humankind and monstrous sea creatures wages on, a former pilot and a trainee are paired up to drive a seemingly obsolete special...', 'en', '0', null, 'Select', null, 'c113.jpg', 'c123.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:43:50', null, null, '0'), ('147', 'Oz the Great and Powerful', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '130', 'A small-time magician is swept away to an enchanted land and is forced into a power struggle between three witches.', 'en', '0', null, 'Select', null, 'c133.jpg', 'c143.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:45:01', null, null, '0'), ('148', 'Captain Phillips', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '134', 'The true story of Captain Richard Phillips and the 2009 hijacking by Somali pirates of the US-flagged MV Maersk Alabama, the first American cargo..', 'en', '0', null, 'Select', null, 'c153.jpg', 'c163.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:46:24', null, null, '0'), ('149', 'X-Men: First Class ', '27', 'Adventure', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '132', 'In 1962, the United States government enlists the help of Mutants with superhuman abilities to stop a malicious dictator who is determined to start', 'en', '0', null, 'Select', null, 'c173.jpg', 'c183.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:48:14', null, null, '0'), ('150', 'Christmas Vacation', '10', 'Comedy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '97', 'The Griswold familys plans for a big family Christmas predictably turn into a big disaster.', 'en', '0', null, 'Select', null, 'c192.jpg', 'c202.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:50:02', null, null, '0'), ('151', 'The Santa Clause', '10', 'Comedy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '97', 'When a man inadvertantly kills Santa on Christmas Eve, he finds himself magically recruited to take his place.', 'en', '0', null, 'Select', null, 'c212.jpg', 'c223.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:51:38', null, null, '0'), ('152', 'This Is the End', '10', 'Comedy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '107', 'While attending a party at James Francos house, Seth Rogen, Jay Baruchel and many other celebrities are faced with the apocalypse.', 'en', '0', null, 'Select', null, 'c232.jpg', 'c242.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:52:50', null, null, '0'), ('153', 'Anchorman: The Legend of Ron Burgundy', '10', 'Comedy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '94', 'Ron Burgundy is San Diegos top rated newsman in the male-dominated broadcasting of the 70s, but thats all about to change for Ron and his cronies..', 'en', '0', null, 'Select', null, '', '', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:54:51', null, null, '0'), ('154', 'August: Osage County', '10', 'Comedy', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '121', 'A look at the lives of the strong-willed women of the Weston family, whose paths have diverged until a family crisis brings them back to the Oklahoma', 'en', '0', null, 'Select', null, 'c272.jpg', 'c282.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 21:57:07', null, null, '0'), ('155', 'Home Alone 2: Lost in New York ', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'One year after Kevin was left home alone and had to defeat a pair of bumbling burglars, he accidentally finds himself in New York City,', 'en', '0', null, 'Select', null, 'c292.jpg', 'c302.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:02:05', null, null, '0'), ('156', 'The Shawshank Redemption', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '142', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'en', '0', null, 'Select', null, 'c315.jpg', 'c322.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:03:16', null, null, '0'), ('157', 'Sabotage', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '120', 'Members of an elite DEA task force find themselves being taken down one by one after they rob a drug cartel safe house.', 'en', '0', null, 'Select', null, 'c333.jpg', 'c342.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:06:12', null, null, '0'), ('158', 'RoboCop', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '121', 'In 2028 Detroit, when Alex Murphy (Joel Kinnaman) - a loving husband, father and good cop - is critically injured in the line of duty,', 'en', '0', null, 'Select', null, 'c352.jpg', 'c361.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:07:24', null, null, '0'), ('159', 'The Godfather', '24', 'Crime', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '175', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'en', '0', null, 'Select', null, 'c371.jpg', 'c381.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:08:46', null, null, '0'), ('160', 'Apocalypse Now', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '153', 'During the U.S.-Viet Nam War, Captain Willard is sent on a dangerous mission into Cambodia to assassinate a renegade colonel who has set himself...', 'en', '0', null, 'Select', null, 'c114.jpg', 'c214.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:13:22', null, null, '0'), ('161', 'Gone with the Wind ', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '238', 'A manipulative Southern belle carries on a turbulent affair with a blockade runner during the American Civil War.', 'en', '0', null, 'Select', null, 'c316.jpg', 'c414.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:15:06', null, null, '0'), ('162', 'Full Metal Jacket', '30', 'War', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '116', 'A pragmatic U.S. Marine observes the dehumanizing effects the U.S.-Vietnam War has on his fellow recruits from their brutal boot camp training..', 'en', '0', null, 'Select', null, 'c55.jpg', 'c65.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:16:15', null, null, '0'), ('163', 'Runner Runner', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '91', 'When a poor college student who cracks an online poker game goes bust, he arranges a face-to-face with the man he thinks cheated him, a sly offshore e', 'en', '0', null, 'Select', null, 'c75.jpg', 'c85.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:18:26', null, null, '0'), ('164', 'The Dark Knight Rises', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '165', 'Eight years on, a new evil rises from where the Batman and Commissioner Gordon tried to bury it, causing the Batman to resurface and fight to protect ', 'en', '0', null, 'Select', null, 'c10.jpg', 'c11.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:21:21', null, null, '0'), ('165', 'Red 2', '15', 'Thriller', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '116', 'Retired C.I.A. agent Frank Moses reunites his unlikely team of elite operatives for a global quest to track down a missing portable nuclear device.', 'en', '0', null, 'Select', null, 'c122.jpg', 'c131.jpg', ' rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-01 22:24:50', null, null, '0'), ('166', 'Jack Ryan: Shadow Recruit', '15', 'Thriller', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '105', 'Jack Ryan, as a young covert CIA analyst, uncovers a Russian plot to crash the U.S. economy with a terrorist attack.', 'en', '0', null, 'Select', null, 'c154.jpg', 'c164.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 08:50:00', null, null, '0'), ('167', 'Atonement', '26', 'Romance', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '123', 'Fledgling writer Briony Tallis, as a 13-year-old, irrevocably changes the course of several lives when she accuses her older sisters lover of a crime', 'en', '0', null, 'Select', null, 'c174.jpg', 'c184.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 08:55:52', '2014-01-02 08:56:05', null, '0'), ('168', 'Alexander ', '8', 'Action', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '175', 'Alexander, the King of Macedonia and one of the greatest military leaders in the history of warfare, conquers much of the known world.', 'en', '0', null, 'Select', null, 'c193.jpg', 'c203.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 08:57:31', null, null, '0'), ('169', 'Act of Valor', '30', 'War', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '110', 'An elite team of Navy SEALs embark on a covert mission to recover a kidnapped CIA agent.', 'en', '0', null, 'Select', null, 'c213.jpg', 'c224.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 08:58:57', null, null, '0'), ('170', 'Flags of Our Fathers', '30', 'War', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '132', 'The life stories of the six men who raised the flag at The Battle of Iwo Jima, a turning point in WWII.', 'en', '0', null, 'Select', null, 'c233.jpg', 'c243.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 09:02:59', null, null, '0'), ('171', 'Black Book ', '30', 'War', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '145', 'In the Nazi-occupied Netherlands during World War II, a Jewish singer infiltrates the regional Gestapo headquarters for the Dutch resistance.', 'en', '0', null, 'Select', null, 'c252.jpg', 'c262.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 09:04:50', null, null, '0'), ('172', 'Behind Enemy Lines', '30', 'War', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '106', 'A Navy navigator is shot down over enemy territory and is ruthlessly pursued by a secret police enforcer and the opposing troops.', 'en', '0', null, 'Select', null, 'c273.jpg', 'c283.jpg', 'rtsp://10.1.128.11/media/BigBucksBunny_SD.ts', '2014-01-02 09:06:11', null, null, '0');
COMMIT;

-- ----------------------------
--  Table structure for `mw_news`
-- ----------------------------
DROP TABLE IF EXISTS `mw_news`;
CREATE TABLE `mw_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `summary` text COLLATE utf8_bin,
  `fullnews` text CHARACTER SET utf8,
  `language` varchar(3) COLLATE utf8_bin DEFAULT NULL,
  `date_added` varchar(15) COLLATE utf8_bin NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_news`
-- ----------------------------
BEGIN;
INSERT INTO `mw_news` VALUES ('31', 'Nations Hospital', 'Is a unique gem of the United Arab Emirates, a singular island of natural beauty and elegance surrounded by pristine clear blue waters. Our hosts are dedicated to provide you with the most relevant personalized service in a warm environment.', '', 'en', '1474213885000', '2017-09-03 15:17:44'), ('22', '?????? ????? ??????? ??????? ???? ????? ', '?? ???? ??????? ??????? ???? ???? ??? ???? ??????? ???????? ??? ?? ??????? ?????? ??????? ???? ??? ????? ??? ?????? ??????? ?? ?????? ??????? ??? ?????? ??????? ???? ????? ?? ?????? ?????????? ????? ?????? ???? ??? ???16 ????? ????? ?????? ???? ??', '', 'ar', '1363602323000', '2013-03-29 13:51:18'), ('23', 'Karthick Korean Test', 'Hello world', '', 'kr', '1363607148000', null), ('24', '????? ????????? ??????? ??????? ', '???? ?????? ???????? ????? ?? ?????? ??? ???????? ?? ??????? ??????? ???? ??????? ???? ??????? ????? 37%? ????? ??? ??????? ??? ??? 1500 ????? ?? ??? ??? ???? ??????? ????????? ?? ?????? ??????? ?? ???????? ???? ??? ???? ????? ?? ???? ???? ??????????? ??? ??????? ?? ???.', '', 'ar', '1364545580000', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_newsnpromo`
-- ----------------------------
DROP TABLE IF EXISTS `mw_newsnpromo`;
CREATE TABLE `mw_newsnpromo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `mw_newsnpromo_menus`
-- ----------------------------
DROP TABLE IF EXISTS `mw_newsnpromo_menus`;
CREATE TABLE `mw_newsnpromo_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `newsnpromo` int(10) unsigned NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_newsnpromo_menus`
-- ----------------------------
BEGIN;
INSERT INTO `mw_newsnpromo_menus` VALUES ('15', 'GOE Test 1', '&lt;p&gt;lorem ipsum&lt;/p&gt;', '7', '2015-05-21 17:21:49', 'a.png', '2016-08-08 16:08:49'), ('16', 'GOE Test 2', '&lt;p&gt;Lorem ipsum 2&lt;/p&gt;', '7', '2016-08-08 16:09:21', 'a1.png', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_occation`
-- ----------------------------
DROP TABLE IF EXISTS `mw_occation`;
CREATE TABLE `mw_occation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `occation_name` varchar(45) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_occation`
-- ----------------------------
BEGIN;
INSERT INTO `mw_occation` VALUES ('1', 'Morning', null, '2012-11-18 16:20:25'), ('3', 'Test Meaage', '2012-11-18 16:20:13', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_parentalrating`
-- ----------------------------
DROP TABLE IF EXISTS `mw_parentalrating`;
CREATE TABLE `mw_parentalrating` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `mw_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `mw_permissions`;
CREATE TABLE `mw_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_permissions`
-- ----------------------------
BEGIN;
INSERT INTO `mw_permissions` VALUES ('3', '1', 'a:1:{s:3:\"uri\";a:44:{i:0;s:6:\"/home/\";i:1;s:6:\"/home/\";i:2;s:6:\"/home/\";i:3;s:6:\"/home/\";i:4;s:9:\"messages/\";i:5;s:21:\"/messages/addmessage/\";i:6;s:22:\"/messages/editmessage/\";i:7;s:24:\"/messages/deletemessage/\";i:8;s:7:\"/guest/\";i:9;s:16:\"/guest/addguest/\";i:10;s:17:\"/guest/editguest/\";i:11;s:19:\"/guest/deleteguest/\";i:12;s:11:\"/localinfo/\";i:13;s:24:\"/localinfo/addlocalinfo/\";i:14;s:25:\"/localinfo/editlocalinfo/\";i:15;s:27:\"/localinfo/deletelocalinfo/\";i:16;s:7:\"/radio/\";i:17;s:16:\"/radio/addradio/\";i:18;s:17:\"/radio/editradio/\";i:19;s:19:\"/radio/deleteradio/\";i:20;s:12:\"/promotions/\";i:21;s:26:\"/promotions/addpromotions/\";i:22;s:27:\"/promotions/editpromotions/\";i:23;s:29:\"/promotions/deletepromotions/\";i:24;s:12:\"/welcome/Tv/\";i:25;s:15:\"/welcome/addtv/\";i:26;s:17:\"/welcome/tv_edit/\";i:27;s:18:\"/welcome/deletetv/\";i:28;s:13:\"/restaurants/\";i:29;s:27:\"/restaurants/addrestaurant/\";i:30;s:28:\"/restaurants/editrestaurant/\";i:31;s:26:\"/backend/deleterestaurant/\";i:32;s:6:\"/news/\";i:33;s:14:\"/news/addnews/\";i:34;s:15:\"/news/editnews/\";i:35;s:17:\"/news/deletenews/\";i:36;s:9:\"/backend/\";i:37;s:9:\"/backend/\";i:38;s:9:\"/backend/\";i:39;s:9:\"/backend/\";i:40;s:8:\"/myauth/\";i:41;s:8:\"/myauth/\";i:42;s:8:\"/myauth/\";i:43;s:8:\"/myauth/\";}}'), ('4', '20', 'a:1:{s:3:\"uri\";a:5:{i:0;s:15:\"/welcome/index/\";i:1;s:7:\"/guest/\";i:2;s:16:\"/guest/addguest/\";i:3;s:17:\"/guest/editguest/\";i:4;s:19:\"/guest/deleteguest/\";}}'), ('5', '21', 'a:1:{s:3:\"uri\";a:9:{i:0;s:6:\"/home/\";i:1;s:6:\"/home/\";i:2;s:6:\"/home/\";i:3;s:6:\"/home/\";i:4;s:7:\"/guest/\";i:5;s:16:\"/guest/addguest/\";i:6;s:17:\"/guest/editguest/\";i:7;s:11:\"/localinfo/\";i:8;s:13:\"/restaurants/\";}}'), ('6', '25', 'a:1:{s:3:\"uri\";a:2:{i:0;s:13:\"/restaurants/\";i:1;s:6:\"/news/\";}}');
COMMIT;

-- ----------------------------
--  Table structure for `mw_program`
-- ----------------------------
DROP TABLE IF EXISTS `mw_program`;
CREATE TABLE `mw_program` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `startTime` int(10) unsigned NOT NULL,
  `endTime` int(10) unsigned NOT NULL,
  `genreId` int(10) unsigned NOT NULL,
  `genreName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 NOT NULL,
  `language` varchar(255) CHARACTER SET latin1 NOT NULL,
  `prLevel` int(10) unsigned NOT NULL,
  `prName` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_program`
-- ----------------------------
BEGIN;
INSERT INTO `mw_program` VALUES ('1', 'test_program', '4294967295', '4294967295', '7', 'General', 'Test Description', 'en', '1', 'pr name'), ('3', 'test program', '223', '345', '10', 'Comedy', 'asdfdfsadsf', 'en', '1', 'test_parental');
COMMIT;

-- ----------------------------
--  Table structure for `mw_promotions`
-- ----------------------------
DROP TABLE IF EXISTS `mw_promotions`;
CREATE TABLE `mw_promotions` (
  `pr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pr_type` varchar(10) NOT NULL,
  `pr_width` varchar(10) DEFAULT NULL,
  `pr_height` varchar(10) DEFAULT NULL,
  `pr_url` text,
  `pr_duration` varchar(20) DEFAULT NULL,
  `pr_date_added` datetime DEFAULT NULL,
  `pr_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_promotions`
-- ----------------------------
BEGIN;
INSERT INTO `mw_promotions` VALUES ('79', 'image', '560', '345', '3.png', '6000', '2016-10-25 15:10:38', null), ('78', 'image', '560', '345', '2.png', '6000', '2016-10-25 15:10:24', null), ('77', 'image', '560', '345', '1.png', '6000', '2016-10-25 15:10:04', null), ('76', 'image', '400', '300', 'foot-spa-scrub-angeles-city-philippines-iconv1.jpg', '1000', '2016-09-01 14:10:40', null), ('81', 'video', '', '', 'http://10.0.1.150/1.TV-MediaOne/client/uploads/testvideo.mp4', '10000', '2017-04-10 11:48:17', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_promotions_language`
-- ----------------------------
DROP TABLE IF EXISTS `mw_promotions_language`;
CREATE TABLE `mw_promotions_language` (
  `promotion_id` int(10) unsigned NOT NULL,
  `language` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_promotions_language`
-- ----------------------------
BEGIN;
INSERT INTO `mw_promotions_language` VALUES ('79', 'en'), ('63', 'en'), ('78', 'en'), ('77', 'en'), ('81', 'en');
COMMIT;

-- ----------------------------
--  Table structure for `mw_r_channel`
-- ----------------------------
DROP TABLE IF EXISTS `mw_r_channel`;
CREATE TABLE `mw_r_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `genreName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mrl` varchar(255) CHARACTER SET latin1 NOT NULL,
  `logo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `language` varchar(255) CHARACTER SET latin1 NOT NULL,
  `prLevel` int(10) unsigned NOT NULL,
  `prName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `eitXML` varchar(255) DEFAULT NULL,
  `epgXML` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_r_channel`
-- ----------------------------
BEGIN;
INSERT INTO `mw_r_channel` VALUES ('95', 'BBC Radio 3', '1', 'Select', 'https://www.internet-radio.com/station/dougeasyhits/', 'radio11.png', '', 'en', '0', 'Select', null, null, '2013-04-04 12:51:08', '2016-10-31 15:39:50'), ('96', 'Galaxy', '2', 'Select', 'src=igmp://239.239.239.2:5000', 'radio21.png', 'http://live32.radiostephansdom.at:8000/live32', 'en', '0', 'Select', '', '', '2013-04-04 12:51:18', '2015-05-01 15:17:22'), ('97', 'Gold', '3', 'Select', 'src=igmp://239.239.239.1:5000', 'radio32.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:51:29', '2015-05-01 15:17:29'), ('98', 'Rock', '4', 'Select', 'src=igmp://239.239.239.2:5000', 'radio41.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:51:41', '2015-05-01 15:17:40'), ('99', 'XFM', '5', 'Select', 'src=igmp://239.239.239.1:5000', 'radio51.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:51:53', '2015-05-01 15:17:49'), ('100', 'Traffic Radio', '6', 'Select', ' src=igmp://239.239.239.2:5000', 'radio61.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:52:04', '2015-05-01 15:18:01'), ('101', 'LBC', '7', 'Select', 'http://220.247.227.51/live', 'radio71.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:52:20', '2013-04-04 14:26:16'), ('102', 'KISS', '8', 'Select', 'http://live32.radiostephansdom.at:8000/live32', 'radio81.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:52:33', '2015-05-01 15:01:38'), ('103', 'YORKSHIRE', '9', 'Select', 'http://220.247.227.51/live', 'radio91.png', '', 'en', '0', 'Select', '', '', '2013-04-04 12:52:42', '2013-04-04 14:26:28');
COMMIT;

-- ----------------------------
--  Table structure for `mw_r_favourites`
-- ----------------------------
DROP TABLE IF EXISTS `mw_r_favourites`;
CREATE TABLE `mw_r_favourites` (
  `fav_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fav_user` int(10) unsigned NOT NULL,
  `fav_channel_id` int(10) unsigned NOT NULL,
  `fav_date_added` datetime DEFAULT NULL,
  `fav_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_r_favourites`
-- ----------------------------
BEGIN;
INSERT INTO `mw_r_favourites` VALUES ('84', '44', '95', null, null), ('85', '44', '98', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_r_genre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_r_genre`;
CREATE TABLE `mw_r_genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `language` varchar(255) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_r_genre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_r_genre` VALUES ('19', 'News', 'radio/index/News/', 'en', '2013-03-18 14:08:19', '2013-04-04 11:55:32'), ('20', 'Music', 'radio/index/Music/', 'en', '2013-03-18 14:08:36', '2013-04-04 11:55:46'), ('21', 'Education Plus', 'radio/index/EducationPlus/', 'en', '2013-03-18 14:08:49', '2016-12-08 15:08:39'), ('22', 'Electro Music', 'radio/index/ElectroMusic/', 'en', '2016-12-08 15:05:19', '2016-12-08 15:07:04');
COMMIT;

-- ----------------------------
--  Table structure for `mw_r_itvtv_bygenre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_r_itvtv_bygenre`;
CREATE TABLE `mw_r_itvtv_bygenre` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `TVChannelID` int(4) DEFAULT NULL,
  `TVGenreID` int(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=368 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_r_itvtv_bygenre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_r_itvtv_bygenre` VALUES ('367', '95', '21'), ('362', '96', '21'), ('363', '97', '21'), ('364', '98', '20'), ('365', '99', '20'), ('366', '100', '19'), ('350', '101', '19'), ('357', '102', '19'), ('352', '103', '19');
COMMIT;

-- ----------------------------
--  Table structure for `mw_r_parentalrating`
-- ----------------------------
DROP TABLE IF EXISTS `mw_r_parentalrating`;
CREATE TABLE `mw_r_parentalrating` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` int(10) unsigned NOT NULL,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `mw_radio`
-- ----------------------------
DROP TABLE IF EXISTS `mw_radio`;
CREATE TABLE `mw_radio` (
  `ra_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ra_name` varchar(100) NOT NULL,
  `ra_mrl` varchar(100) DEFAULT NULL,
  `ra_logo` varchar(250) DEFAULT NULL,
  `ra_description` text,
  `ra_language` varchar(2) DEFAULT NULL,
  `ra_date_added` datetime DEFAULT NULL,
  `ra_date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`ra_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_radio`
-- ----------------------------
BEGIN;
INSERT INTO `mw_radio` VALUES ('1', 'BBC Radio 5 live 909 ', 'http://220.247.227.51/live', 'bbc.png', 'Test Description', 'en', null, null), ('2', 'The Game 102.1', 'http://220.247.227.51/live', 'game.png', 'Test Description', 'en', null, null), ('3', 'The Zone 1150', 'http://220.247.227.51/live', 'zone.png', 'Test Description', 'en', null, null), ('4', 'ABC Hiru FM 96.7 ', 'http://220.247.227.51/live', 'hiru.png', 'test', 'fr', null, null), ('6', 'Shakthi FM 105.1', 'http://220.247.227.51/live', 'sakthi.png', 'Test Description', 'fr', null, null), ('7', 'ESPN Radio', 'http://220.247.227.51/live', 'espn.png', 'Test Description', 'en', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_resolution`
-- ----------------------------
DROP TABLE IF EXISTS `mw_resolution`;
CREATE TABLE `mw_resolution` (
  `re_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `re_type` varchar(20) NOT NULL,
  PRIMARY KEY (`re_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_resolution`
-- ----------------------------
BEGIN;
INSERT INTO `mw_resolution` VALUES ('1', '720P');
COMMIT;

-- ----------------------------
--  Table structure for `mw_rest_menus`
-- ----------------------------
DROP TABLE IF EXISTS `mw_rest_menus`;
CREATE TABLE `mw_rest_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(10) unsigned NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(200) DEFAULT NULL,
  `restaurant` int(10) unsigned NOT NULL,
  `to_date` date DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `menu_order` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(200) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_rest_menus`
-- ----------------------------
BEGIN;
INSERT INTO `mw_rest_menus` VALUES ('1', '1', 'Beef Salad', 'Beef taco salad', '130 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '1', 't1.png', '2013-11-13 13:27:38'), ('2', '1', 'Caviar and Toast', 'Caviar and Toast Points', '140 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '2', 't2.png', null), ('3', '1', 'Miso Soup', 'Miso soup with shrimp and Tofu', '110 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '3', 't3.png', null), ('4', '1', 'Raw Vegetables', 'Raw vegetables with vegetable dip', '120 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '4', 't4.png', null), ('5', '1', 'Potato Fries', 'Sweet Potato Fries With Sour Cream Appetizer', '150 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '5', 't5.png', null), ('6', '1', 'Tortilla Soup', 'Tortilla soup in white bowl', '160 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '6', 't6.png', null), ('7', '1', 'Various Antipasti', 'Various antipasti on plate', '120 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '7', 't7.png', null), ('8', '1', 'Caviar and Toast', 'Caviar and Toast Points', '140 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '1', 't2.png', null), ('9', '1', 'Miso Soup', 'Miso soup with shrimp and Tofu', '110 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '2', 't3.png', null), ('10', '1', 'Raw Vegetables', 'Raw vegetables with vegetable dip', '120 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '3', 't4.png', null), ('11', '1', 'Miso Soup', 'Miso soup with shrimp and Tofu', '110 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '1', 't3.png', null), ('12', '1', 'Raw Vegetables', 'Raw vegetables with vegetable dip', '120 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '2', 't4.png', null), ('13', '1', 'Potato Fries', 'Sweet Potato Fries With Sour Cream Appetizer', '150 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '3', 't5.png', null), ('14', '1', 'Beef Salad', 'Beef taco salad', '130 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '1', 't1.png', '2013-11-13 13:28:04'), ('15', '1', 'Caviar and Toast', 'Caviar and Toast Points', '140 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '2', 't2.png', null), ('16', '1', 'Miso Soup', 'Miso soup with shrimp and Tofu', '110 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '3', 't3.png', null), ('17', '2', 'Curry with Rice', 'Curry with rice, yoghurt sauce and poppadom (India)', '120 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '1', 'm1.png', null), ('18', '2', 'Fish Tacos', 'Fish tacos with tempura battered halibut tossed in lime and chile spiked aioli and served with creme fraiche', '130 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '2', 'm2.png', null), ('19', '2', 'Glazed Duck', 'Glazed Duck Magret with pan fried mushrooms', '140 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '3', 'm3.png', null), ('20', '2', 'Potato cake', 'Potato cake, Soft cheese, Chicken-burger', '170 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '4', 'm4.png', null), ('21', '2', 'Kimchi Bowl', 'Kimchi Bowl', '180 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '5', 'm5.png', null), ('22', '2', 'Sahara Falafel', 'Sahara Falafel plate', '160 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '1', 'm6.png', null), ('23', '2', 'Sushi', 'Sushi', '120 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '2', 'm7.png', null), ('24', '2', 'Tabbouleh', 'Tabbouleh with peas', '160 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '3', 'm8.png', null), ('25', '2', 'Teriyaki Fish', 'Teriyaki fish with noodles', '220 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '4', 'm9.png', null), ('26', '2', 'Potato cake', 'Potato cake, Soft cheese, Chicken-burger', '170 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '1', 'm4.png', null), ('27', '2', 'Kimchi Bowl', 'Kimchi Bowl', '180 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '2', 'm5.png', null), ('28', '2', 'Sahara Falafel', 'Sahara Falafel plate', '160 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '3', 'm6.png', null), ('29', '2', 'Sushi', 'Sushi', '120 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '4', 'm7.png', null), ('30', '2', 'Tabbouleh', 'Tabbouleh with peas', '160 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '5', 'm8.png', null), ('31', '2', 'Teriyaki Fish', 'Teriyaki fish with noodles', '220 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '6', 'm9.png', null), ('32', '2', 'Curry with Rice', 'Curry with rice, yoghurt sauce and poppadom (India)', '120 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '1', 'm1.png', null), ('33', '2', 'Fish Tacos', 'Fish tacos with tempura battered halibut tossed in lime and chile spiked aioli and served with creme fraiche', '130 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '2', 'm2.png', null), ('34', '2', 'Glazed Duck', 'Glazed Duck Magret with pan fried mushrooms', '140 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '3', 'm3.png', null), ('35', '2', 'Potato cake', 'Potato cake, Soft cheese, Chicken-burger', '170 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '4', 'm4.png', null), ('36', '2', 'Kimchi Bowl', 'Kimchi Bowl', '180 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '5', 'm5.png', null), ('37', '4', 'Blueberry Martini', 'Blueberry Martini with Lemon Peel Garnish', '90 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '1', 'd1.png', null), ('38', '4', 'Margarita Cocktail', 'Frosted glass of a margarita cocktail served with ice and slice of lime', '80 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '2', 'd2.png', null), ('39', '4', 'Green Tea', 'Glass of green tea', '130 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '3', 'd3.png', null), ('40', '4', 'Glass of Mojito', 'Glass of Mojito at the La Cabrera bar', '120 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '4', 'd4.png', '2012-11-14 16:34:01'), ('41', '4', 'Kiwi Margarita', 'Kiwi Margarita - Close Up with Straw', '70 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '1', 'd5.png', null), ('42', '4', 'Margarita Cocktail', 'Margarita cocktail- green apple mojito and guava smoothie', '85 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '2', 'd6.png', null), ('43', '4', 'Orange Juice', 'Orange Juice with Orange and Glass', '90 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '3', 'd7.png', null), ('44', '4', 'Tea', 'Tea in clear glass cup and saucer', '100 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '4', 'd8.png', null), ('45', '4', 'Colas', 'Two Colas in glasses with ice', '60 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '5', 'd9.png', null), ('46', '4', 'Cosmopolitan Cocktail', 'Two Cosmopolitan cocktails with straws', '120 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '6', 'd10.png', null), ('47', '4', 'Margarita Cocktail', 'Frosted glass of a margarita cocktail served with ice and slice of lime', '80 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '1', 'd2.png', null), ('48', '4', 'Green Tea', 'Glass of green tea', '130 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '2', 'd3.png', null), ('49', '4', 'Glass of Mojito', 'Glass of Mojito at the La Cabrera bar', '120 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '3', 'd4.png', null), ('50', '4', 'Margarita Cocktail', 'Frosted glass of a margarita cocktail served with ice and slice of lime', '80 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '1', 'd2.png', null), ('51', '4', 'Green Tea', 'Glass of green tea', '130 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '2', 'd3.png', null), ('52', '4', 'Tea', 'Tea in clear glass cup and saucer', '100 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '3', 'd8.png', null), ('53', '3', 'Apple Pastries', 'Apple turnover pastries on baking tray', '130 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '1', 's1.png', '2013-11-13 13:25:11'), ('54', '3', 'Christmas Cookies', 'Assorted Christmas cookies with hot chocolate', '120 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '2', 's2.png', null), ('55', '3', 'Chocolate Dessert', 'Chocolate mousse dessert with meringues and bittersweet chocolate lattice', '140 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '3', 's3.png', null), ('56', '3', 'Frozen Berry Souffle', 'Frozen Berry Souffle', '130 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '4', 's4.png', null), ('57', '3', 'Fruit Tart', 'Fruit Tart', '100 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '5', 's5.png', null), ('58', '3', 'Gulab Jamun', 'Gulab jamun (Milk balls in sugar syrup)', '110 AED', '1', '2012-04-01', '2012-04-25 10:47:31', '6', 's6.png', null), ('59', '3', 'Peach Frozen Yogurt', 'Peach frozen yogurt', '140 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '1', 's7.png', null), ('60', '3', 'Pistachio Nest', 'Pistachio bird nests', '140 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '2', 's8.png', null), ('61', '3', 'Fresh Fig Cake', 'Upside Down Fresh Fig Cake', '130 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '3', 's9.png', null), ('62', '3', 'Vanilla Sauce', 'Vanilla Ice Cream with Chocolate Sauce', '110 AED', '2', '2012-04-01', '2012-04-25 10:47:31', '4', 's10.png', null), ('63', '3', 'Chocolate Dessert', 'Chocolate mousse dessert with meringues and bittersweet chocolate lattice', '140 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '1', 's3.png', null), ('64', '3', 'Frozen Berry Souffle', 'Frozen Berry Souffle', '130 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '2', 's4.png', null), ('65', '3', 'Fruit Tart', 'Fruit Tart', '100 AED', '3', '2012-04-01', '2012-04-25 10:47:31', '3', 's5.png', null), ('66', '3', 'Peach Frozen Yogurt', 'Peach frozen yogurt', '140 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '1', 's7.png', null), ('67', '3', 'Pistachio Nest', 'Pistachio bird nests', '140 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '2', 's8.png', null), ('68', '3', 'Fresh Fig Cake', 'Upside Down Fresh Fig Cake', '130 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '3', 's9.png', null), ('69', '3', 'Christmas Cookies', 'Assorted Christmas cookies with hot chocolate', '120 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '4', 's2.png', '2012-11-14 16:33:49'), ('73', '4', 'Tesgts', ' ', '21 AED', '2', '2012-04-21', '2012-12-06 10:57:28', '3', 'interiors.gif', null), ('70', '3', 'Chocolate Dessert', 'Chocolate mousse dessert with meringues and bittersweet chocolate lattice', '140 AED', '4', '2012-04-01', '2012-04-25 10:47:31', '5', 's3.png', null), ('71', '14', 'My Menu', 'mytest', '1200 AED', '1', '2012-12-23', '2012-11-14 16:22:35', '2', 'Bank-256.png', '2012-11-14 16:27:20');
COMMIT;

-- ----------------------------
--  Table structure for `mw_rest_menutype`
-- ----------------------------
DROP TABLE IF EXISTS `mw_rest_menutype`;
CREATE TABLE `mw_rest_menutype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_rest_menutype`
-- ----------------------------
BEGIN;
INSERT INTO `mw_rest_menutype` VALUES ('1', 'Starter', 'starter', null, '2012-11-14 16:50:33'), ('2', 'Main Course', 'maincourse', null, '2012-11-14 16:50:29'), ('3', 'Dessert', 'dessert', null, '2012-12-20 17:34:18'), ('4', 'Drink', 'drink', null, '2012-11-14 16:50:24');
COMMIT;

-- ----------------------------
--  Table structure for `mw_restaurant`
-- ----------------------------
DROP TABLE IF EXISTS `mw_restaurant`;
CREATE TABLE `mw_restaurant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `daliy_time` varchar(45) DEFAULT NULL,
  `breakf_time` varchar(45) DEFAULT NULL,
  `lunch_time` varchar(45) DEFAULT NULL,
  `dinner_time` varchar(45) DEFAULT NULL,
  `dress` varchar(45) DEFAULT NULL,
  `venue` varchar(45) DEFAULT NULL,
  `is_service` int(11) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `language` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_restaurant`
-- ----------------------------
BEGIN;
INSERT INTO `mw_restaurant` VALUES ('23', 'OASIS COURTYARD', 'cortyard-1.png|cortyard-2.png', '&lt;p&gt;Keeping things simple, the Oasis Courtyard Pool bar offers everyday drinks, selection of salads, sandwiches, snacks and dishes designed to keep your hunger at bay in the pool by the sun, Feel the Arabian spirit with our shisha by the pool!&lt;/p&gt;\n', '', '', '', '', '', '', '0', '2016-09-25 16:52:47', '2016-10-24 01:18:04', 'en'), ('21', 'HUNTERS B&R', 'hunters-1.png|hunters-2.png', '&lt;p&gt;Hunter&amp;rsquo;s B&amp;amp;R with that modern twist and one of the newest urban retreats in town is the perfect meeting point for your social gathering.&lt;/p&gt;\n\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Timings: 14:00 until 02:00 hours&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Happy Hours Every Day 14:00- 21:00&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Ladies Night Every Monday 19:00 &amp;ndash; 21:00&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Live Entertainment Every Day except Saturday 22:45 &amp;ndash; 24:45&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Darts competition every Sunday from 19:30pm&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Billiard competition every Wednesday from 19:30pm&lt;/strong&gt;&lt;/p&gt;\n', '', '', '', '', '', '', '0', '2016-09-25 16:42:02', '2016-10-24 01:19:18', 'en'), ('22', 'RIMAL BAR', 'rimal-1.png|rimal-2.png', '&lt;p&gt;The Oriental bar serves up both International and Arabic snacks in an authentic atmosphere.&lt;/p&gt;\n\n&lt;p&gt;Open daily, Rimal Bar is the perfect hideaway for a quiet drink after a long day.&lt;/p&gt;\n', '', '', '', '', '', '', '0', '2016-09-25 16:48:52', '2016-10-24 01:12:28', 'en'), ('18', 'OASIS ORIENTAL', 'oasis-oriantal-1.png|oasis-oriantal-2.png', '&lt;p&gt;From its staggering oasis view by day to the romantic flicker of candlelight by night, serves a tempting blend of Arabic and Oriental specialties including a large selection of mezzeh.&lt;/p&gt;\n\n&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;\n', '', '', '', '', '', '', '0', '2016-09-25 16:26:36', '2016-10-24 00:39:45', 'en'), ('19', 'THE OLIVE BRANCH', 'olive-branch-1.png|olive-branch-2.png', '&lt;p&gt;The Olive Branch restaurant offers an abundance of fresh food from around the Mediterranean and more, satisfying everyone`s palette.&lt;/p&gt;\n\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Breakfast buffet: 06:00 until 10:30 hours&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Lunch buffet: 12:30 until 15:30 hours&lt;/strong&gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;Dinner buffet: 19:00 until 23:00 hours&lt;/strong&gt;&lt;/p&gt;\n', '', '', '', '', '', '', '0', '2016-09-25 16:29:37', '2016-10-24 00:43:30', 'en'), ('20', 'PRIMO DOLCI CAFÉ', 'premio-dolci-cafe-1.png|premio-dolci-cafe-2.png', '&lt;p&gt;Primo Dolci is all set to take you for an aromatic journey to Italy, from freshly brewed coffee beans to classic croissants, succulent sandwiches and luscious Cheese cakes to give the prefect ending to your meals.&lt;/p&gt;\n', '', '', '', '', '', '', '0', '2016-09-25 16:34:31', '2016-10-24 00:55:19', 'en');
COMMIT;

-- ----------------------------
--  Table structure for `mw_restaurant_time`
-- ----------------------------
DROP TABLE IF EXISTS `mw_restaurant_time`;
CREATE TABLE `mw_restaurant_time` (
  `rt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rt_rest_id` int(10) unsigned NOT NULL,
  `rt_rest_time` varchar(10) NOT NULL,
  PRIMARY KEY (`rt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_restaurant_time_tracker`
-- ----------------------------
DROP TABLE IF EXISTS `mw_restaurant_time_tracker`;
CREATE TABLE `mw_restaurant_time_tracker` (
  `rtt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rtt_rest_id` int(10) unsigned DEFAULT NULL,
  `rtt_sh` varchar(40) DEFAULT NULL,
  `rtt_sm` varchar(40) DEFAULT NULL,
  `rtt_eh` varchar(40) DEFAULT NULL,
  `rtt_em` varchar(40) DEFAULT NULL,
  `rtt_interval` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`rtt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_restaurant_time_tracker`
-- ----------------------------
BEGIN;
INSERT INTO `mw_restaurant_time_tracker` VALUES ('107', '20', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15'), ('111', '21', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15'), ('109', '22', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15'), ('106', '19', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15'), ('105', '18', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15'), ('110', '23', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15'), ('88', '24', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00,00,00,00,00,', '00:15');
COMMIT;

-- ----------------------------
--  Table structure for `mw_rgenre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_rgenre`;
CREATE TABLE `mw_rgenre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `language` varchar(255) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_rgenre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_rgenre` VALUES ('7', 'News', 'welcome/Tv/News/', 'en', '2012-12-17 11:22:35', null), ('8', 'Sports', 'welcome/Tv/Sports/', 'en', '2012-12-17 11:22:43', null), ('9', 'Movies', 'welcome/Tv/Movies/', 'en', '2012-12-17 11:22:52', '2012-12-22 10:12:16'), ('10', 'Music', 'welcome/Tv/Music/', 'en', '2012-12-17 11:23:08', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_roles`
-- ----------------------------
DROP TABLE IF EXISTS `mw_roles`;
CREATE TABLE `mw_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_roles`
-- ----------------------------
BEGIN;
INSERT INTO `mw_roles` VALUES ('1', '0', 'Admin'), ('21', '0', 'Reception'), ('25', '0', 'Hotel Staff');
COMMIT;

-- ----------------------------
--  Table structure for `mw_room`
-- ----------------------------
DROP TABLE IF EXISTS `mw_room`;
CREATE TABLE `mw_room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_number` varchar(45) NOT NULL,
  `room_type` varchar(45) NOT NULL,
  `butler_email` varchar(100) DEFAULT NULL,
  `emergency_img` varchar(100) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_room`
-- ----------------------------
BEGIN;
INSERT INTO `mw_room` VALUES ('1', 'NNNNN', '2', 'supportdf@haridraresort.com', '', '2012-12-17 09:04:56', '2016-12-07 13:25:46'), ('2', '101', '1', 'buttler@mafraq-hotel.com', '', '2016-10-24 04:29:30', null), ('3', '105', '4', 'buttlerkt@itsthe1.com', '', '2016-11-06 17:17:32', '2016-12-07 23:32:57'), ('4', '107', '1', 'lakshan@itsthe1.com', '', '2016-12-07 23:33:33', null), ('5', '201', '2', 'lakshan@itsthe1.com', '', '2017-04-09 16:53:42', null), ('6', '110', '2', 'shehan@itsthe1.com', '', '2017-04-09 17:38:58', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_room_device`
-- ----------------------------
DROP TABLE IF EXISTS `mw_room_device`;
CREATE TABLE `mw_room_device` (
  `device_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `device_id_2` (`device_id`),
  KEY `device_id` (`device_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_room_device`
-- ----------------------------
BEGIN;
INSERT INTO `mw_room_device` VALUES ('15', '1');
COMMIT;

-- ----------------------------
--  Table structure for `mw_room_group`
-- ----------------------------
DROP TABLE IF EXISTS `mw_room_group`;
CREATE TABLE `mw_room_group` (
  `rg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rg_name` varchar(100) NOT NULL,
  `rg_date_added` datetime DEFAULT NULL,
  `rg_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`rg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_room_group`
-- ----------------------------
BEGIN;
INSERT INTO `mw_room_group` VALUES ('10', 'Default Room Group', '2012-12-17 08:22:27', '2016-12-15 10:07:58');
COMMIT;

-- ----------------------------
--  Table structure for `mw_room_guest`
-- ----------------------------
DROP TABLE IF EXISTS `mw_room_guest`;
CREATE TABLE `mw_room_guest` (
  `room_id` int(11) NOT NULL,
  `guest_id` int(10) unsigned NOT NULL,
  `greeting_id` int(10) unsigned NOT NULL,
  `theme_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_room_guest`
-- ----------------------------
BEGIN;
INSERT INTO `mw_room_guest` VALUES ('1', '4', '1', '15', '1', '2017-09-03 15:02:41'), ('2', '7', '1', '11', '1', null), ('5', '15', '1', '11', '1', '2017-04-09 17:28:45');
COMMIT;

-- ----------------------------
--  Table structure for `mw_room_status`
-- ----------------------------
DROP TABLE IF EXISTS `mw_room_status`;
CREATE TABLE `mw_room_status` (
  `room_id` int(11) NOT NULL,
  `occupied` int(10) unsigned NOT NULL DEFAULT '0',
  `occupied_request_usr` varchar(30) DEFAULT '',
  `occupied_request_dt` datetime DEFAULT NULL,
  `clean_vacant` int(10) unsigned NOT NULL DEFAULT '0',
  `clean_vacant_usr` varchar(30) DEFAULT '',
  `clean_vacant_dt` datetime DEFAULT NULL,
  `maintenance_request` int(10) unsigned NOT NULL DEFAULT '0',
  `maintenance_request_usr` varchar(30) DEFAULT '',
  `maintenance_request_dt` datetime DEFAULT NULL,
  `extra_bed` int(10) unsigned NOT NULL DEFAULT '0',
  `extra_bed_usr` varchar(30) DEFAULT '',
  `extra_bed_dt` datetime DEFAULT NULL,
  `babycot_request` int(10) unsigned NOT NULL DEFAULT '0',
  `babycot_usr` varchar(30) DEFAULT '',
  `babycot_request_dt` datetime DEFAULT NULL,
  `turndown_done` int(10) unsigned NOT NULL DEFAULT '0',
  `turndown_usr` varchar(30) DEFAULT '',
  `turndown_dt` datetime DEFAULT NULL,
  `under_maintenance` int(10) unsigned NOT NULL DEFAULT '0',
  `under_maintenance_usr` varchar(30) DEFAULT '',
  `under_maintenance_dt` datetime DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `roomcleaning_request` int(10) unsigned NOT NULL DEFAULT '0',
  `roomcleaning_request_usr` varchar(30) DEFAULT NULL,
  `roomcleaning_request_dt` datetime DEFAULT NULL,
  `date_edited` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_room_status`
-- ----------------------------
BEGIN;
INSERT INTO `mw_room_status` VALUES ('101', '1', '123', '2013-02-10 04:11:00', '0', '34343', '2013-02-18 10:50:39', '1', '555555', '2013-02-18 14:04:54', '0', '1414', '2013-02-19 13:31:45', '1', '', null, '0', '08908088999', '2013-02-19 12:56:23', '1', '9999', '2013-02-18 16:20:12', '2013-02-10 16:58:03', '1', '', '0000-00-00 00:00:00', null), ('0', '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '2015-05-10 22:34:21', '0', null, null, null), ('101', '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '2016-10-24 04:29:30', '0', null, null, null), ('105', '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '2016-11-06 17:17:32', '0', null, null, null), ('107', '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '2016-12-07 23:33:33', '0', null, null, null), ('201', '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '2017-04-09 16:53:42', '0', null, null, null), ('110', '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '0', '', null, '2017-04-09 17:38:58', '0', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_room_type`
-- ----------------------------
DROP TABLE IF EXISTS `mw_room_type`;
CREATE TABLE `mw_room_type` (
  `rt_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rt_type` varchar(100) NOT NULL,
  `rt_date_added` datetime DEFAULT NULL,
  `rt_date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`rt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_room_type`
-- ----------------------------
BEGIN;
INSERT INTO `mw_room_type` VALUES ('1', 'Single Room', null, null), ('2', 'Double Room', null, '2016-12-07 23:57:52'), ('3', 'Queen Bed Room', null, '2012-11-19 13:22:26'), ('4', 'King Bed Room', null, null), ('5', 'Suit Room', '2016-12-07 23:58:07', null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_services_data`
-- ----------------------------
DROP TABLE IF EXISTS `mw_services_data`;
CREATE TABLE `mw_services_data` (
  `services_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(255) DEFAULT NULL,
  `service_img_url` varchar(255) DEFAULT NULL,
  `description` text,
  `date_added` datetime DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`services_data_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_services_data`
-- ----------------------------
BEGIN;
INSERT INTO `mw_services_data` VALUES ('1', 'Concearge', 'mens-gym-1.png|mens-gym-2.png|mens-gym-3.png', '<p>Offering coached classes for adults and kids, as well as personal and skill training for individuals and small groups.</p>\n\n<p>With leading coach Mohamed Nafaa the International Bodybuilding Champion, we focus on achieving actual fitness results.</p>\n', '2017-03-17 14:10:23', 'en');
COMMIT;

-- ----------------------------
--  Table structure for `mw_settings`
-- ----------------------------
DROP TABLE IF EXISTS `mw_settings`;
CREATE TABLE `mw_settings` (
  `se_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `se_view_type` enum('ListView','ThumbView') NOT NULL,
  `se_logo` varchar(100) DEFAULT NULL,
  `se_current_theme` varchar(10) DEFAULT NULL,
  `se_weather_rss` varchar(250) DEFAULT NULL,
  `se_news_rss` varchar(100) DEFAULT NULL,
  `se_pin_number` varchar(50) DEFAULT NULL,
  `se_vod_cost` double DEFAULT '0',
  `se_table_booking` varchar(100) DEFAULT NULL,
  `se_wakeup_call` varchar(100) DEFAULT NULL,
  `se_restaurant_booking` varchar(100) DEFAULT NULL,
  `se_order_taxi` varchar(100) DEFAULT NULL,
  `se_room_service` varchar(100) DEFAULT NULL,
  `se_laundery_request` varchar(100) DEFAULT NULL,
  `se_socket_enabled` int(10) unsigned DEFAULT '0',
  `se_tapemarquee_enabled` int(10) unsigned DEFAULT '0',
  `se_fakedata_enabled` int(11) DEFAULT '0',
  `se_internet_enabled` int(11) DEFAULT '1',
  `se_ajaxpull_enabled` int(11) DEFAULT '1',
  `se_exit_enabled` int(11) DEFAULT '1',
  `se_alarm_enabled` int(11) DEFAULT '0',
  `tickertape_enabled` int(11) DEFAULT '1',
  `chfavourite_enabled` int(11) DEFAULT '1',
  `se_guest_title` int(11) DEFAULT '1',
  PRIMARY KEY (`se_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_settings`
-- ----------------------------
BEGIN;
INSERT INTO `mw_settings` VALUES ('4', 'ThumbView', 'Logo11.png', '11', 'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%3D2189783&format=json', '', '', '0', 'admin@itsthe1.com', 'admin@itsthe1.com', '0', 'admin@itsthe1.com', 'admin@itsthe1.com', 'admin@itsthe1.com', '0', '0', '0', '1', '1', '1', '0', '1', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `mw_skin`
-- ----------------------------
DROP TABLE IF EXISTS `mw_skin`;
CREATE TABLE `mw_skin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sk_name` varchar(100) NOT NULL,
  `sk_css` varchar(100) NOT NULL,
  `sk_select` int(10) unsigned DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_skin`
-- ----------------------------
BEGIN;
INSERT INTO `mw_skin` VALUES ('15', 'BirthDay', 'birthday', '0', '2012-12-17 12:16:39', '2012-12-17 12:16:39'), ('11', 'Default', 'default', '0', null, '2012-12-17 12:16:39');
COMMIT;

-- ----------------------------
--  Table structure for `mw_skin_suite`
-- ----------------------------
DROP TABLE IF EXISTS `mw_skin_suite`;
CREATE TABLE `mw_skin_suite` (
  `idskin_suite` int(11) NOT NULL,
  `id_skin` varchar(45) DEFAULT NULL,
  `id_suite` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idskin_suite`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_spa`
-- ----------------------------
DROP TABLE IF EXISTS `mw_spa`;
CREATE TABLE `mw_spa` (
  `spa_id` int(255) NOT NULL AUTO_INCREMENT,
  `spa_type` varchar(255) DEFAULT NULL,
  `spa_img_url` varchar(255) DEFAULT NULL,
  `description` text,
  `date_added` datetime DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`spa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_spa`
-- ----------------------------
BEGIN;
INSERT INTO `mw_spa` VALUES ('18', 'CROSSFIT ', 'mens-gym-1.png|mens-gym-2.png|mens-gym-3.png', '<p>Offering coached classes for adults and kids, as well as personal and skill training for individuals and small groups.</p>\n\n<p>With leading coach Mohamed Nafaa the International Bodybuilding Champion, we focus on achieving actual fitness results.</p>\n', '2016-12-14 16:18:21', 'en'), ('19', 'LADIES GYM', 'ladies-gym-1.png|ladies-gym-2.png', '<p>The facility are open exclusivity to ladies, and offer fully equipped Gym, Jacuzzi, Steam Room, Sauna, Spa and private swimming pool for ladies and kids .<br />\nAfter your training session, enjoy a relaxing therapeutic, sports or chiropractic massage; or a sauna, steam room or Jacuzzi.</p>\n', '2016-10-24 02:17:20', 'en'), ('20', 'WELLBEING', 'spa-1.png|spa-2.png|spa-3.png', '<p>Relaxation is fundamental after physical efforts. This is precisely why we have prepared modern massage rooms in our Serenity Zone, served by highly qualified personnel.</p>\n', '2016-10-24 02:18:22', 'en');
COMMIT;

-- ----------------------------
--  Table structure for `mw_status_text`
-- ----------------------------
DROP TABLE IF EXISTS `mw_status_text`;
CREATE TABLE `mw_status_text` (
  `st_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `st_name` varchar(50) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_status_text`
-- ----------------------------
BEGIN;
INSERT INTO `mw_status_text` VALUES ('1', 'Active'), ('2', 'Inactive'), ('3', 'Prospective');
COMMIT;

-- ----------------------------
--  Table structure for `mw_stb_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `mw_stb_permissions`;
CREATE TABLE `mw_stb_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_stb_permissions`
-- ----------------------------
BEGIN;
INSERT INTO `mw_stb_permissions` VALUES ('4', '1', 'a:1:{s:3:\"uri\";a:1:{i:0;s:2:\"jk\";}}');
COMMIT;

-- ----------------------------
--  Table structure for `mw_suite`
-- ----------------------------
DROP TABLE IF EXISTS `mw_suite`;
CREATE TABLE `mw_suite` (
  `idsuite` int(11) NOT NULL,
  `name_suite` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsuite`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_tabs`
-- ----------------------------
DROP TABLE IF EXISTS `mw_tabs`;
CREATE TABLE `mw_tabs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `parent_id` varchar(10) DEFAULT '0',
  `parent_order` int(10) NOT NULL,
  `is_main` varchar(10) DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `add` varchar(50) NOT NULL,
  `edit` varchar(50) NOT NULL,
  `delete` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_tabs`
-- ----------------------------
BEGIN;
INSERT INTO `mw_tabs` VALUES ('5', 'MESSAGE', '0', '0', '0', 'messages', '/messages/addmessage', '/messages/editmessage', '/messages/deletemessage'), ('10', 'GUEST', '0', '0', '0', '/guest', '/guest/addguest', '/guest/editguest', '/guest/deleteguest'), ('15', 'LOCALINFORMATION', '0', '0', '0', '/localinfo', '/localinfo/addlocalinfo', '/localinfo/editlocalinfo', '/localinfo/deletelocalinfo'), ('20', 'RADIO', '0', '0', '0', '/radio', '/radio/addradio', '/radio/editradio', '/radio/deleteradio'), ('25', 'PROMOTION', '0', '0', '0', '/promotions', '/promotions/addpromotions', '/promotions/editpromotions', '/promotions/deletepromotions'), ('30', 'TV', '0', '0', '0', '/welcome/Tv', '/welcome/addtv', '/welcome/tv_edit', '/welcome/deletetv'), ('35', 'RESTAURANT', '0', '0', '0', '/restaurants', '/restaurants/addrestaurant', '/restaurants/editrestaurant', '/backend/deleterestaurant'), ('40', 'NEWS', '0', '0', '0', '/news', '/news/addnews', '/news/editnews', '/news/deletenews'), ('45', 'SYSTEM', '0', '0', '0', '/backend', '/backend', '/backend', '/backend'), ('50', 'AUTHENTICATION', '0', '0', '0', '/myauth', '/myauth', '/myauth', '/myauth'), ('1', 'HOME', '0', '0', '0', '/home', '/home', '/home', '/home');
COMMIT;

-- ----------------------------
--  Table structure for `mw_test`
-- ----------------------------
DROP TABLE IF EXISTS `mw_test`;
CREATE TABLE `mw_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `11` varchar(45) DEFAULT NULL,
  `12` varchar(45) DEFAULT NULL,
  `122` varchar(45) DEFAULT NULL,
  `211` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_test`
-- ----------------------------
BEGIN;
INSERT INTO `mw_test` VALUES ('1', 'sas', '', '', '', '', ''), ('2', 'ssss', '', '', '', '', ''), ('3', 'gggg', '', '', '', '', ''), ('4', 'qqq', '', '', '', '', ''), ('5', 'dasojojo', '', '', '', '', ''), ('6', 'kfc123456', '', '', '', '', ''), ('7', 'sassassssssssssss', '', '', '', '', ''), ('8', 'sasa', '', '', '', '', ''), ('9', 'wwwwwwwww', '', '', '', '', ''), ('10', 'sssssssss', '', '', '', '', ''), ('11', '0', '', '', '', '', ''), ('12', 'sabran', '', '', '', '', ''), ('13', null, '1', '14', '17', null, ''), ('14', '', null, null, null, null, ''), ('15', '1,14,17,19', null, null, null, null, ''), ('16', null, '19', null, null, null, ''), ('17', null, '1', '14', '17', '19', ''), ('18', null, '19', '16', null, null, ''), ('19', null, '1', '14', '17', null, ''), ('20', null, '19', null, null, null, ''), ('21', null, '', null, null, null, ''), ('22', null, '', null, null, null, ''), ('23', null, '20', null, null, null, ''), ('24', null, '19', null, null, null, ''), ('25', null, '', null, null, null, ''), ('26', null, '14', '19', '2', null, ''), ('27', null, '1', '14', '19', null, ''), ('28', null, '1', '17', '19', null, ''), ('29', null, '17', '19', '2', null, ''), ('30', '1,17,19,16', null, null, null, null, ''), ('31', null, '1', '19', null, null, ''), ('32', null, 'Array', null, null, null, ''), ('33', null, null, null, '', null, ''), ('34', null, '16', '2', null, null, ''), ('35', null, '1', '14', null, null, ''), ('36', null, '1', '19', null, null, ''), ('37', null, '1', '17', null, null, ''), ('38', null, '19', '13', '2', null, ''), ('39', null, '19', '20', '16', null, ''), ('40', '<br/>', null, null, null, null, ''), ('41', '<br/>', null, null, null, null, ''), ('42', null, '1', '13', null, null, ''), ('43', null, '17', '19', '13', null, ''), ('44', null, '17', '2', null, null, ''), ('45', null, '1', '17', '19', null, ''), ('46', null, '1', null, null, null, ''), ('47', null, '19', '13', '20', '16', ''), ('48', null, '19', '13', '20', '16', ''), ('49', null, '19', '13', '20', '16', ''), ('50', null, '19', '13', '20', '16', ''), ('51', null, '17', '13', '20', null, ''), ('52', null, '17', '13', '20', null, ''), ('53', null, '', null, null, null, ''), ('54', null, '17', '13', '20', null, ''), ('55', null, '17', '13', '20', null, ''), ('56', null, '17', '13', '20', null, ''), ('57', null, '17', '13', '20', null, ''), ('58', null, '17', '13', '20', null, ''), ('59', null, '17', '13', '20', null, ''), ('60', null, '17', '13', '20', null, ''), ('61', null, '17', '13', '20', null, ''), ('62', null, '', null, null, null, ''), ('63', null, '', null, null, null, ''), ('64', null, '', null, null, null, ''), ('65', null, '', null, null, null, ''), ('66', null, '', null, null, null, ''), ('67', null, '', null, null, null, ''), ('68', null, '', null, null, null, ''), ('69', null, '', null, null, null, ''), ('70', null, '', null, null, null, ''), ('71', null, '', null, null, null, ''), ('72', null, '17', '2', null, null, ''), ('73', null, '17', '2', null, null, ''), ('74', null, 'Array', null, null, null, ''), ('75', null, '', null, null, null, ''), ('76', null, '17', '2', null, null, ''), ('77', null, '17', '2', null, null, ''), ('78', null, '17', '2', null, null, ''), ('79', null, '14', '19', '13', null, ''), ('80', null, '14', '19', '13', null, ''), ('81', '0', null, null, null, null, ''), ('82', '0', null, null, null, null, ''), ('83', '0', null, null, null, null, ''), ('84', '14,19,13,2', null, null, null, null, ''), ('85', '14,19', null, null, null, null, ''), ('86', '14,19', null, null, null, null, ''), ('87', null, '14', '19', null, null, ''), ('88', null, '1', '17', null, null, ''), ('89', null, '1', '17', null, null, ''), ('90', null, '1', '17', null, null, ''), ('91', null, '1', '17', null, null, ''), ('92', null, '1', '17', null, null, ''), ('93', null, '1', '17', null, null, ''), ('94', null, '1', '17', null, null, ''), ('95', null, '1', '17', null, null, ''), ('96', null, '1', '14', null, null, ''), ('97', null, '1', '14', null, null, ''), ('98', null, '1', '14', null, null, ''), ('99', null, '1', '14', null, null, ''), ('100', null, '1', '14', null, null, ''), ('101', null, '1', '14', null, null, ''), ('102', '1', null, null, null, null, null), ('103', '14', null, null, null, null, null), ('104', '1', null, null, null, null, 'ds'), ('105', '14', null, null, null, null, 'ds'), ('106', '19', null, null, null, null, 'sa'), ('107', '', null, null, null, null, 'sa'), ('108', '', null, null, null, null, ''), ('109', '', null, null, null, null, 'sasa'), ('110', '', null, null, null, null, 'sa'), ('111', '14', null, null, null, null, 'ew'), ('112', '17', null, null, null, null, 'ew'), ('113', '2', null, null, null, null, 'ew'), ('114', '1', null, null, null, null, 'ewew'), ('115', '14', null, null, null, null, 'ewew'), ('116', '19', null, null, null, null, 'ewew'), ('117', '', null, null, null, null, ''), ('118', '1', null, null, null, null, ''), ('119', '17', null, null, null, null, ''), ('120', '19', null, null, null, null, '');
COMMIT;

-- ----------------------------
--  Table structure for `mw_theme_params`
-- ----------------------------
DROP TABLE IF EXISTS `mw_theme_params`;
CREATE TABLE `mw_theme_params` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme` int(10) unsigned NOT NULL,
  `background` varchar(200) NOT NULL,
  `lang_btn_en` varchar(200) NOT NULL,
  `lang_btn_sel_en` varchar(200) NOT NULL,
  `lang_btn_ar` varchar(200) NOT NULL,
  `lang_btn_sel_ar` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_theme_params`
-- ----------------------------
BEGIN;
INSERT INTO `mw_theme_params` VALUES ('1', '2', 'http://www.itsthe1.com/profiles/exterity/itsthe1_mw/themes/default/en/bg.png', 'http://www.itsthe1.com/profiles/exterity/itsthe1_mw/themes/default/en/lang/langEnglishIcon.png', 'http://www.itsthe1.com/profiles/exterity/itsthe1_mw/themes/default/en/lang/langEnglishIconSelected.png', 'http://www.itsthe1.com/profiles/exterity/itsthe1_mw/themes/default/en/lang/langArabicIcon.png', 'http://www.itsthe1.com/profiles/exterity/itsthe1_mw/themes/default/en/lang/langArabicIconSelected.png');
COMMIT;

-- ----------------------------
--  Table structure for `mw_themes`
-- ----------------------------
DROP TABLE IF EXISTS `mw_themes`;
CREATE TABLE `mw_themes` (
  `th_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `th_name` varchar(250) NOT NULL,
  `th_folder` varchar(250) NOT NULL,
  PRIMARY KEY (`th_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_themes`
-- ----------------------------
BEGIN;
INSERT INTO `mw_themes` VALUES ('1', 'Default', 'default'), ('8', 'Hawiyah', 'hawiyah'), ('9', 'Boutique7', 'boutique7'), ('10', 'Nurai', 'nurai'), ('11', 'Mafraq', 'mafraq'), ('13', 'MediaOne', 'mediaone'), ('14', 'AlDiar', 'aldiar'), ('15', 'NationsHospital', 'nationshospital'), ('16', 'TwoFour54', 'twofour54');
COMMIT;

-- ----------------------------
--  Table structure for `mw_ticker_promo`
-- ----------------------------
DROP TABLE IF EXISTS `mw_ticker_promo`;
CREATE TABLE `mw_ticker_promo` (
  `ticker_promo_id` int(10) NOT NULL AUTO_INCREMENT,
  `restaurant_id` varchar(45) NOT NULL,
  `ticker_promo_txt` varchar(255) NOT NULL,
  PRIMARY KEY (`ticker_promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mw_tickertape`
-- ----------------------------
DROP TABLE IF EXISTS `mw_tickertape`;
CREATE TABLE `mw_tickertape` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tickertape_url` text NOT NULL,
  `language` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_tickertape`
-- ----------------------------
BEGIN;
INSERT INTO `mw_tickertape` VALUES ('1', 'http://rss.cnn.com/rss/edition.rss/all.xml', 'en'), ('2', 'http://www.aljazeera.net/AljazeeraRss/3b4f4fec-0a53-4327-a8ed-c8241e8327d2/a55b0587-50e6-411c-886a-b745eb94c280', 'ar');
COMMIT;

-- ----------------------------
--  Table structure for `mw_tvbrand`
-- ----------------------------
DROP TABLE IF EXISTS `mw_tvbrand`;
CREATE TABLE `mw_tvbrand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brnd_name` varchar(100) NOT NULL,
  `brnd_folder` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_tvbrand`
-- ----------------------------
BEGIN;
INSERT INTO `mw_tvbrand` VALUES ('1', 'pc', 'pc'), ('2', 'crop', 'crop');
COMMIT;

-- ----------------------------
--  Table structure for `mw_user`
-- ----------------------------
DROP TABLE IF EXISTS `mw_user`;
CREATE TABLE `mw_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(45) COLLATE utf8_bin NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_user`
-- ----------------------------
BEGIN;
INSERT INTO `mw_user` VALUES ('1', 'admin', 'abc123', 'active');
COMMIT;

-- ----------------------------
--  Table structure for `mw_user_autologin`
-- ----------------------------
DROP TABLE IF EXISTS `mw_user_autologin`;
CREATE TABLE `mw_user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `mw_user_language`
-- ----------------------------
DROP TABLE IF EXISTS `mw_user_language`;
CREATE TABLE `mw_user_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `language` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_user_language`
-- ----------------------------
BEGIN;
INSERT INTO `mw_user_language` VALUES ('1', '13', '1'), ('2', '13', '2');
COMMIT;

-- ----------------------------
--  Table structure for `mw_user_profile`
-- ----------------------------
DROP TABLE IF EXISTS `mw_user_profile`;
CREATE TABLE `mw_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_user_profile`
-- ----------------------------
BEGIN;
INSERT INTO `mw_user_profile` VALUES ('1', '1', null, null), ('2', '3', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `mw_user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `mw_user_roles`;
CREATE TABLE `mw_user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `mw_user_temp`
-- ----------------------------
DROP TABLE IF EXISTS `mw_user_temp`;
CREATE TABLE `mw_user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(34) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activation_key` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_user_temp`
-- ----------------------------
BEGIN;
INSERT INTO `mw_user_temp` VALUES ('1', 'test', '$1$vN5.Mm/.$DqKqmr.DXSOSnNX/xCvJL1', 'jk@jk.com', 'd500799f70c8ab005dbf4738a5fa0630', '192.168.1.100', '2010-08-12 03:41:43');
COMMIT;

-- ----------------------------
--  Table structure for `mw_usermessage`
-- ----------------------------
DROP TABLE IF EXISTS `mw_usermessage`;
CREATE TABLE `mw_usermessage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `message` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_usermessage`
-- ----------------------------
BEGIN;
INSERT INTO `mw_usermessage` VALUES ('86', '44', '27', '1', '2016-03-07 13:21:41');
COMMIT;

-- ----------------------------
--  Table structure for `mw_users`
-- ----------------------------
DROP TABLE IF EXISTS `mw_users`;
CREATE TABLE `mw_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '1',
  `username` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `contact_no` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `newpass` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `newpass_key` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `newpass_time` datetime DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `staff_code` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Records of `mw_users`
-- ----------------------------
BEGIN;
INSERT INTO `mw_users` VALUES ('19', '21', 'reception', '$1$vl0.Me/.$dD/lyn7iOrKlNm0cTc69D0', '123456', 'reception@hotel.com', '0', null, null, null, null, '0000-00-00 00:00:00', '2012-12-20 22:36:08', '2015-10-29 10:19:44', ''), ('18', '1', 'hoteladmin', '$1$35Kct446$H9sGO8FNcNqj3HD1r1LYm1', '23232323', 'hoteladmin@mafraq-hotel.com', '0', null, null, null, null, '0000-00-00 00:00:00', '2012-12-20 18:09:13', '2016-10-24 03:35:49', '123'), ('1', '1', 'admin', 'ZpwL.8b1QOyvE', '2343234', 'development@itsthe1.com', '0', null, null, null, null, '0000-00-00 00:00:00', '2013-05-05 17:22:00', '2015-11-09 10:02:12', ''), ('20', '25', 'staff', '$1$nS..k3..$9CVvGIje2z/7cPKqmfPQ.0', '123654', 'hotelstaff@hotel.com', '0', null, null, null, null, '0000-00-00 00:00:00', '2015-10-29 11:50:29', '2015-10-29 10:20:34', '369');
COMMIT;

-- ----------------------------
--  Table structure for `mw_vod_genre`
-- ----------------------------
DROP TABLE IF EXISTS `mw_vod_genre`;
CREATE TABLE `mw_vod_genre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(100) NOT NULL,
  `language` varchar(255) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_vod_genre`
-- ----------------------------
BEGIN;
INSERT INTO `mw_vod_genre` VALUES ('7', 'General', 'welcome/product/general/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', 'Action', 'welcome/product/Action/', 'en', '0000-00-00 00:00:00', '2012-12-04 13:06:45'), ('9', 'Horror', 'welcome/product/horror/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('10', 'Comedy', 'welcome/product/comedy/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('13', 'Sci-Fi', 'welcome/product/scifi/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('14', 'Mystery', 'welcome/product/mystery/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('15', 'Thriller', 'welcome/product/thriller/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('16', 'Documentary', 'welcome/product/documentary/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('17', 'Fantasy', 'welcome/product/fantasy/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('18', 'History', 'welcome/product/history/', 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('23', 'Family', 'welcome/product/Family/', 'en', '2014-01-01 19:39:03', null), ('24', 'Crime', 'welcome/product/Crime/', 'en', '2014-01-01 19:39:49', null), ('25', 'Animation', 'welcome/product/Animation/', 'en', '2014-01-01 19:57:34', null), ('26', 'Romance', 'welcome/product/Romance/', 'en', '2014-01-01 19:59:12', null), ('27', 'Adventure', 'welcome/product/Adventure/', 'en', '2014-01-01 20:13:06', null), ('28', 'Musical', 'welcome/product/Musical/', 'en', '2014-01-01 20:24:53', null), ('29', 'Sport', 'welcome/product/Sport/', 'en', '2014-01-01 20:25:23', null), ('30', 'War', 'welcome/product/War/', 'en', '2014-01-01 20:25:35', null), ('31', 'Adult', 'welcome/product/Adult/', '0', '2016-12-12 11:06:41', '2016-12-12 11:07:12');
COMMIT;

-- ----------------------------
--  Table structure for `mw_weather`
-- ----------------------------
DROP TABLE IF EXISTS `mw_weather`;
CREATE TABLE `mw_weather` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weather_url` text NOT NULL,
  `language` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `mw_weather`
-- ----------------------------
BEGIN;
INSERT INTO `mw_weather` VALUES ('1', 'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid=%221940330%22%20and%20u=%22c%22%20&format=json&diagnostics=true', 'en'), ('2', 'http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%3D2189783&format=json', 'ar'), ('3', 'dsfdsfdsfdsfdsfskkk', 'kr');
COMMIT;

-- ----------------------------
--  Table structure for `mw_weather_bk`
-- ----------------------------
DROP TABLE IF EXISTS `mw_weather_bk`;
CREATE TABLE `mw_weather_bk` (
  `we_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `we_city` varchar(100) DEFAULT NULL,
  `we_type` varchar(50) DEFAULT NULL,
  `we_image` varchar(250) DEFAULT NULL,
  `we_tmp_high` varchar(10) DEFAULT NULL,
  `we_tmp_low` varchar(10) DEFAULT NULL,
  `we_date` date DEFAULT NULL,
  PRIMARY KEY (`we_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mw_weather_bk`
-- ----------------------------
BEGIN;
INSERT INTO `mw_weather_bk` VALUES ('1', 'Luxor', 'Sunny', 'http://l.yimg.com/a/i/us/nws/weather/gr/32d.png', '33', '16', '2013-03-28'), ('2', 'London', 'Sunny', 'http://l.yimg.com/a/i/us/nws/weather/gr/32d.png', '5', '-3', '2013-03-28'), ('3', 'Glasgow', 'Light Snow Shower', 'http://l.yimg.com/a/i/us/nws/weather/gr/13d.png', '4', '-2', '2013-03-28'), ('4', 'Vancouver', 'Mostly Cloudy', 'http://l.yimg.com/a/i/us/nws/weather/gr/27n.png', '15', '7', '2013-03-28'), ('5', 'Ajman', 'Fair', 'http://l.yimg.com/a/i/us/nws/weather/gr/34d.png', '30', '16', '2013-03-28'), ('6', '', '', '', '', '', '0000-00-00');
COMMIT;

-- ----------------------------
--  Procedure structure for `prc_getRoomStatus`
-- ----------------------------
DROP PROCEDURE IF EXISTS `prc_getRoomStatus`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_getRoomStatus`(IN flag varchar(40))
    COMMENT 'To get the room status based on the occupancy, extrabed etc..'
BEGIN
DECLARE str VARCHAR(255);
SET @str = flag;
CASE @str  
WHEN "occupied" THEN
            select rs.room_id,IF(occupied=1,"Yes","-") as status,g.name as user,rg.date_added as dt from mw_room_status as rs
left join mw_room as r on rs.room_id=r.room_number
left join mw_room_guest as rg on r.id=rg.room_id
left join mw_guest as g on rg.guest_id=g.id;
WHEN "cleanvacant" THEN
            select room_id,IF(clean_vacant=1,"Dirty","Clean") as status,clean_vacant_usr as user,clean_vacant_dt as dt   from mw_room_status;
WHEN "maintenance" THEN
            select room_id,IF(maintenance_request=1,"Required","-") as status,maintenance_request_usr as user,maintenance_request_dt as dt   from mw_room_status;
WHEN "extrabed" THEN       
            select room_id,IF(extra_bed=1,"Yes","-") as status,extra_bed_usr as user,extra_bed_dt as dt   from mw_room_status;
WHEN "babycot" THEN
            select room_id,IF(babycot_request=1,"Yes","-") as status,babycot_usr as user,babycot_request_dt as dt   from mw_room_status;
WHEN "cleaning" THEN
            select room_id,IF(roomcleaning_request=1,"Required","-") as status,roomcleaning_request_usr as user,roomcleaning_request_dt as dt   from mw_room_status;
WHEN "turndown" THEN
            select room_id,IF(turndown_done=1,"Not Done","-") as status,turndown_usr as user,turndown_dt as dt   from mw_room_status;
WHEN "undermaintenance" THEN  
            select room_id,IF(under_maintenance=1,"Yes","-") as status,under_maintenance_usr as user,under_maintenance_dt as dt   from mw_room_status;
ELSe
            select rs.room_id,IF(occupied=1,"Yes","-") as status,g.name as user,rs.occupied_request_dt as dt from mw_room_status as rs
left join mw_room as r on rs.room_id=r.room_number
left join mw_room_guest as rg on r.id=rg.room_id
left join mw_guest as g on rg.guest_id=g.id;
END CASE;
END
 ;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
