# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.25)
# Database: ccp
# Generation Time: 2012-12-11 21:02:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table acos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `acos`;

CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`)
VALUES
	(1,NULL,'',NULL,'controllers',1,720),
	(2,1,'',NULL,'Attachments',2,13),
	(3,2,'',NULL,'admin_index',3,4),
	(4,2,'',NULL,'admin_add',5,6),
	(5,2,'',NULL,'admin_edit',7,8),
	(6,2,'',NULL,'admin_delete',9,10),
	(7,2,'',NULL,'admin_browse',11,12),
	(8,1,'',NULL,'Blocks',14,29),
	(9,8,'',NULL,'admin_index',15,16),
	(10,8,'',NULL,'admin_add',17,18),
	(11,8,'',NULL,'admin_edit',19,20),
	(12,8,'',NULL,'admin_delete',21,22),
	(13,8,'',NULL,'admin_moveup',23,24),
	(14,8,'',NULL,'admin_movedown',25,26),
	(15,8,'',NULL,'admin_process',27,28),
	(16,1,'',NULL,'Comments',30,45),
	(17,16,'',NULL,'admin_index',31,32),
	(18,16,'',NULL,'admin_edit',33,34),
	(19,16,'',NULL,'admin_delete',35,36),
	(20,16,'',NULL,'admin_process',37,38),
	(21,16,'',NULL,'index',39,40),
	(22,16,'',NULL,'add',41,42),
	(23,16,'',NULL,'delete',43,44),
	(24,1,'',NULL,'Contacts',46,57),
	(25,24,'',NULL,'admin_index',47,48),
	(26,24,'',NULL,'admin_add',49,50),
	(27,24,'',NULL,'admin_edit',51,52),
	(28,24,'',NULL,'admin_delete',53,54),
	(29,24,'',NULL,'view',55,56),
	(30,1,'',NULL,'Filemanager',58,79),
	(31,30,'',NULL,'admin_index',59,60),
	(32,30,'',NULL,'admin_browse',61,62),
	(33,30,'',NULL,'admin_editfile',63,64),
	(34,30,'',NULL,'admin_upload',65,66),
	(35,30,'',NULL,'admin_delete_file',67,68),
	(36,30,'',NULL,'admin_delete_directory',69,70),
	(37,30,'',NULL,'admin_rename',71,72),
	(38,30,'',NULL,'admin_create_directory',73,74),
	(39,30,'',NULL,'admin_create_file',75,76),
	(40,30,'',NULL,'admin_chmod',77,78),
	(41,1,'',NULL,'Languages',80,95),
	(42,41,'',NULL,'admin_index',81,82),
	(43,41,'',NULL,'admin_add',83,84),
	(44,41,'',NULL,'admin_edit',85,86),
	(45,41,'',NULL,'admin_delete',87,88),
	(46,41,'',NULL,'admin_moveup',89,90),
	(47,41,'',NULL,'admin_movedown',91,92),
	(48,41,'',NULL,'admin_select',93,94),
	(49,1,'',NULL,'Links',96,111),
	(50,49,'',NULL,'admin_index',97,98),
	(51,49,'',NULL,'admin_add',99,100),
	(52,49,'',NULL,'admin_edit',101,102),
	(53,49,'',NULL,'admin_delete',103,104),
	(54,49,'',NULL,'admin_moveup',105,106),
	(55,49,'',NULL,'admin_movedown',107,108),
	(56,49,'',NULL,'admin_process',109,110),
	(57,1,'',NULL,'Menus',112,121),
	(58,57,'',NULL,'admin_index',113,114),
	(59,57,'',NULL,'admin_add',115,116),
	(60,57,'',NULL,'admin_edit',117,118),
	(61,57,'',NULL,'admin_delete',119,120),
	(62,1,'',NULL,'Messages',122,131),
	(63,62,'',NULL,'admin_index',123,124),
	(64,62,'',NULL,'admin_edit',125,126),
	(65,62,'',NULL,'admin_delete',127,128),
	(66,62,'',NULL,'admin_process',129,130),
	(67,1,'',NULL,'Nodes',132,161),
	(68,67,'',NULL,'admin_index',133,134),
	(69,67,'',NULL,'admin_create',135,136),
	(70,67,'',NULL,'admin_add',137,138),
	(71,67,'',NULL,'admin_edit',139,140),
	(72,67,'',NULL,'admin_update_paths',141,142),
	(73,67,'',NULL,'admin_delete',143,144),
	(74,67,'',NULL,'admin_delete_meta',145,146),
	(75,67,'',NULL,'admin_add_meta',147,148),
	(76,67,'',NULL,'admin_process',149,150),
	(77,67,'',NULL,'index',151,152),
	(78,67,'',NULL,'term',153,154),
	(79,67,'',NULL,'promoted',155,156),
	(80,67,'',NULL,'search',157,158),
	(81,67,'',NULL,'view',159,160),
	(82,1,'',NULL,'Regions',162,171),
	(83,82,'',NULL,'admin_index',163,164),
	(84,82,'',NULL,'admin_add',165,166),
	(85,82,'',NULL,'admin_edit',167,168),
	(86,82,'',NULL,'admin_delete',169,170),
	(87,1,'',NULL,'Roles',172,181),
	(88,87,'',NULL,'admin_index',173,174),
	(89,87,'',NULL,'admin_add',175,176),
	(90,87,'',NULL,'admin_edit',177,178),
	(91,87,'',NULL,'admin_delete',179,180),
	(92,1,'',NULL,'Settings',182,201),
	(93,92,'',NULL,'admin_dashboard',183,184),
	(94,92,'',NULL,'admin_index',185,186),
	(95,92,'',NULL,'admin_view',187,188),
	(96,92,'',NULL,'admin_add',189,190),
	(97,92,'',NULL,'admin_edit',191,192),
	(98,92,'',NULL,'admin_delete',193,194),
	(99,92,'',NULL,'admin_prefix',195,196),
	(100,92,'',NULL,'admin_moveup',197,198),
	(101,92,'',NULL,'admin_movedown',199,200),
	(102,1,'',NULL,'Terms',202,217),
	(103,102,'',NULL,'admin_index',203,204),
	(104,102,'',NULL,'admin_add',205,206),
	(105,102,'',NULL,'admin_edit',207,208),
	(106,102,'',NULL,'admin_delete',209,210),
	(107,102,'',NULL,'admin_moveup',211,212),
	(108,102,'',NULL,'admin_movedown',213,214),
	(109,102,'',NULL,'admin_process',215,216),
	(110,1,'',NULL,'Types',218,227),
	(111,110,'',NULL,'admin_index',219,220),
	(112,110,'',NULL,'admin_add',221,222),
	(113,110,'',NULL,'admin_edit',223,224),
	(114,110,'',NULL,'admin_delete',225,226),
	(115,1,'',NULL,'Users',228,261),
	(116,115,'',NULL,'admin_index',229,230),
	(117,115,'',NULL,'admin_add',231,232),
	(118,115,'',NULL,'admin_edit',233,234),
	(119,115,'',NULL,'admin_reset_password',235,236),
	(120,115,'',NULL,'admin_delete',237,238),
	(121,115,'',NULL,'admin_login',239,240),
	(122,115,'',NULL,'admin_logout',241,242),
	(123,115,'',NULL,'index',243,244),
	(124,115,'',NULL,'add',245,246),
	(125,115,'',NULL,'activate',247,248),
	(126,115,'',NULL,'edit',249,250),
	(127,115,'',NULL,'forgot',251,252),
	(128,115,'',NULL,'reset',253,254),
	(129,115,'',NULL,'login',255,256),
	(130,115,'',NULL,'logout',257,258),
	(131,115,'',NULL,'view',259,260),
	(132,1,'',NULL,'Vocabularies',262,271),
	(133,132,'',NULL,'admin_index',263,264),
	(134,132,'',NULL,'admin_add',265,266),
	(135,132,'',NULL,'admin_edit',267,268),
	(136,132,'',NULL,'admin_delete',269,270),
	(137,1,'',NULL,'AclAcos',272,281),
	(138,137,'',NULL,'admin_index',273,274),
	(139,137,'',NULL,'admin_add',275,276),
	(140,137,'',NULL,'admin_edit',277,278),
	(141,137,'',NULL,'admin_delete',279,280),
	(142,1,'',NULL,'AclActions',282,295),
	(143,142,'',NULL,'admin_index',283,284),
	(144,142,'',NULL,'admin_add',285,286),
	(145,142,'',NULL,'admin_edit',287,288),
	(146,142,'',NULL,'admin_delete',289,290),
	(147,142,'',NULL,'admin_move',291,292),
	(148,142,'',NULL,'admin_generate',293,294),
	(149,1,'',NULL,'AclAros',296,305),
	(150,149,'',NULL,'admin_index',297,298),
	(151,149,'',NULL,'admin_add',299,300),
	(152,149,'',NULL,'admin_edit',301,302),
	(153,149,'',NULL,'admin_delete',303,304),
	(154,1,'',NULL,'AclPermissions',306,311),
	(155,154,'',NULL,'admin_index',307,308),
	(156,154,'',NULL,'admin_toggle',309,310),
	(159,1,'',NULL,'ExtensionsHooks',312,317),
	(160,159,'',NULL,'admin_index',313,314),
	(161,159,'',NULL,'admin_toggle',315,316),
	(162,1,'',NULL,'ExtensionsLocales',318,329),
	(163,162,'',NULL,'admin_index',319,320),
	(164,162,'',NULL,'admin_activate',321,322),
	(165,162,'',NULL,'admin_add',323,324),
	(166,162,'',NULL,'admin_edit',325,326),
	(167,162,'',NULL,'admin_delete',327,328),
	(168,1,'',NULL,'ExtensionsPlugins',330,337),
	(169,168,'',NULL,'admin_index',331,332),
	(170,168,'',NULL,'admin_add',333,334),
	(171,168,'',NULL,'admin_delete',335,336),
	(172,1,'',NULL,'ExtensionsThemes',338,351),
	(173,172,'',NULL,'admin_index',339,340),
	(174,172,'',NULL,'admin_activate',341,342),
	(175,172,'',NULL,'admin_add',343,344),
	(176,172,'',NULL,'admin_editor',345,346),
	(177,172,'',NULL,'admin_save',347,348),
	(178,172,'',NULL,'admin_delete',349,350),
	(348,1,NULL,NULL,'Locations',352,369),
	(349,348,NULL,NULL,'admin_index',353,354),
	(350,348,NULL,NULL,'admin_add',355,356),
	(351,348,NULL,NULL,'admin_edit',357,358),
	(352,348,NULL,NULL,'admin_delete',359,360),
	(353,348,NULL,NULL,'admin_view',361,362),
	(354,348,NULL,NULL,'admin_dates',363,364),
	(355,348,NULL,NULL,'index',365,366),
	(356,348,NULL,NULL,'view',367,368),
	(357,1,NULL,NULL,'LocationReservations',370,393),
	(358,357,NULL,NULL,'admin_index',371,372),
	(359,357,NULL,NULL,'admin_add',373,374),
	(360,357,NULL,NULL,'admin_edit',375,376),
	(361,357,NULL,NULL,'admin_delete',377,378),
	(362,357,NULL,NULL,'admin_view',379,380),
	(363,357,NULL,NULL,'admin_dates',381,382),
	(364,357,NULL,NULL,'index',383,384),
	(365,357,NULL,NULL,'add',385,386),
	(366,357,NULL,NULL,'edit',387,388),
	(367,357,NULL,NULL,'delete',389,390),
	(368,357,NULL,NULL,'view',391,392),
	(369,1,NULL,NULL,'LocationReservationOptions',394,407),
	(370,369,NULL,NULL,'admin_index',395,396),
	(371,369,NULL,NULL,'admin_add',397,398),
	(372,369,NULL,NULL,'admin_edit',399,400),
	(373,369,NULL,NULL,'admin_delete',401,402),
	(374,369,NULL,NULL,'index',403,404),
	(375,369,NULL,NULL,'view',405,406),
	(376,1,NULL,NULL,'LocationPromos',408,421),
	(377,376,NULL,NULL,'admin_index',409,410),
	(378,376,NULL,NULL,'admin_edit',411,412),
	(379,376,NULL,NULL,'admin_delete',413,414),
	(380,376,NULL,NULL,'admin_view',415,416),
	(381,376,NULL,NULL,'index',417,418),
	(382,376,NULL,NULL,'view',419,420),
	(708,1,NULL,NULL,'LocationReservationOptions',692,705),
	(385,1,NULL,NULL,'UserProfiles',422,439),
	(386,385,NULL,NULL,'admin_index',423,424),
	(387,385,NULL,NULL,'admin_add',425,426),
	(388,385,NULL,NULL,'admin_edit',427,428),
	(389,385,NULL,NULL,'admin_delete',429,430),
	(390,385,NULL,NULL,'admin_view',431,432),
	(391,385,NULL,NULL,'add',433,434),
	(392,385,NULL,NULL,'edit',435,436),
	(393,385,NULL,NULL,'view',437,438),
	(394,1,NULL,NULL,'Locations',440,457),
	(395,394,NULL,NULL,'admin_index',441,442),
	(396,394,NULL,NULL,'admin_add',443,444),
	(397,394,NULL,NULL,'admin_edit',445,446),
	(398,394,NULL,NULL,'admin_delete',447,448),
	(399,394,NULL,NULL,'admin_view',449,450),
	(400,394,NULL,NULL,'admin_dates',451,452),
	(401,394,NULL,NULL,'index',453,454),
	(402,394,NULL,NULL,'view',455,456),
	(403,1,NULL,NULL,'LocationDates',458,475),
	(404,403,NULL,NULL,'admin_index',459,460),
	(405,403,NULL,NULL,'admin_add',461,462),
	(406,403,NULL,NULL,'admin_edit',463,464),
	(407,403,NULL,NULL,'admin_delete',465,466),
	(408,403,NULL,NULL,'admin_view',467,468),
	(409,403,NULL,NULL,'admin_dates',469,470),
	(410,403,NULL,NULL,'index',471,472),
	(411,403,NULL,NULL,'view',473,474),
	(412,1,NULL,NULL,'LocationReservations',476,499),
	(413,412,NULL,NULL,'admin_index',477,478),
	(414,412,NULL,NULL,'admin_add',479,480),
	(415,412,NULL,NULL,'admin_edit',481,482),
	(416,412,NULL,NULL,'admin_delete',483,484),
	(417,412,NULL,NULL,'admin_view',485,486),
	(418,412,NULL,NULL,'admin_dates',487,488),
	(419,412,NULL,NULL,'index',489,490),
	(420,412,NULL,NULL,'add',491,492),
	(421,412,NULL,NULL,'edit',493,494),
	(422,412,NULL,NULL,'delete',495,496),
	(423,412,NULL,NULL,'view',497,498),
	(424,1,NULL,NULL,'LocationReservationOptions',500,513),
	(425,424,NULL,NULL,'admin_index',501,502),
	(426,424,NULL,NULL,'admin_add',503,504),
	(427,424,NULL,NULL,'admin_edit',505,506),
	(428,424,NULL,NULL,'admin_delete',507,508),
	(429,424,NULL,NULL,'index',509,510),
	(430,424,NULL,NULL,'view',511,512),
	(431,1,NULL,NULL,'LocationPromos',514,527),
	(432,431,NULL,NULL,'admin_index',515,516),
	(433,431,NULL,NULL,'admin_edit',517,518),
	(434,431,NULL,NULL,'admin_delete',519,520),
	(435,431,NULL,NULL,'admin_view',521,522),
	(436,431,NULL,NULL,'index',523,524),
	(437,431,NULL,NULL,'view',525,526),
	(440,1,NULL,NULL,'UserProfiles',528,545),
	(441,440,NULL,NULL,'admin_index',529,530),
	(442,440,NULL,NULL,'admin_add',531,532),
	(443,440,NULL,NULL,'admin_edit',533,534),
	(444,440,NULL,NULL,'admin_delete',535,536),
	(445,440,NULL,NULL,'admin_view',537,538),
	(446,440,NULL,NULL,'add',539,540),
	(447,440,NULL,NULL,'edit',541,542),
	(448,440,NULL,NULL,'view',543,544),
	(688,686,NULL,NULL,'admin_add',651,652),
	(689,686,NULL,NULL,'admin_edit',653,654),
	(690,686,NULL,NULL,'admin_delete',655,656),
	(691,686,NULL,NULL,'admin_view',657,658),
	(692,686,NULL,NULL,'admin_dates',659,660),
	(693,686,NULL,NULL,'index',661,662),
	(500,495,NULL,NULL,'admin_view',555,556),
	(499,495,NULL,NULL,'admin_delete',553,554),
	(498,495,NULL,NULL,'admin_edit',551,552),
	(497,495,NULL,NULL,'admin_add',549,550),
	(496,495,NULL,NULL,'admin_index',547,548),
	(495,1,NULL,NULL,'UserProfiles',546,563),
	(694,686,NULL,NULL,'view',663,664),
	(695,1,NULL,NULL,'LocationReservations',666,691),
	(550,1,NULL,NULL,'UserProfiles',564,581),
	(551,550,NULL,NULL,'admin_index',565,566),
	(552,550,NULL,NULL,'admin_add',567,568),
	(553,550,NULL,NULL,'admin_edit',569,570),
	(554,550,NULL,NULL,'admin_delete',571,572),
	(555,550,NULL,NULL,'admin_view',573,574),
	(556,550,NULL,NULL,'add',575,576),
	(557,550,NULL,NULL,'edit',577,578),
	(558,550,NULL,NULL,'view',579,580),
	(684,675,NULL,NULL,'index',643,644),
	(685,675,NULL,NULL,'view',645,646),
	(686,1,NULL,NULL,'LocationDates',648,665),
	(687,686,NULL,NULL,'admin_index',649,650),
	(503,495,NULL,NULL,'view',561,562),
	(502,495,NULL,NULL,'edit',559,560),
	(501,495,NULL,NULL,'add',557,558),
	(707,695,NULL,NULL,'confirmation',689,690),
	(607,1,NULL,NULL,'UserProfiles',582,601),
	(608,607,NULL,NULL,'admin_index',583,584),
	(609,607,NULL,NULL,'admin_add',585,586),
	(610,607,NULL,NULL,'admin_edit',587,588),
	(611,607,NULL,NULL,'admin_delete',589,590),
	(612,607,NULL,NULL,'admin_view',591,592),
	(613,607,NULL,NULL,'index',593,594),
	(614,607,NULL,NULL,'add',595,596),
	(615,607,NULL,NULL,'edit',597,598),
	(616,607,NULL,NULL,'view',599,600),
	(706,695,NULL,NULL,'view',687,688),
	(705,695,NULL,NULL,'delete',685,686),
	(704,695,NULL,NULL,'edit',683,684),
	(703,695,NULL,NULL,'add',681,682),
	(702,695,NULL,NULL,'index',679,680),
	(701,695,NULL,NULL,'admin_dates',677,678),
	(700,695,NULL,NULL,'admin_view',675,676),
	(699,695,NULL,NULL,'admin_delete',673,674),
	(698,695,NULL,NULL,'admin_edit',671,672),
	(697,695,NULL,NULL,'admin_add',669,670),
	(696,695,NULL,NULL,'admin_index',667,668),
	(673,665,NULL,NULL,'edit',621,622),
	(672,665,NULL,NULL,'add',619,620),
	(671,665,NULL,NULL,'index',617,618),
	(670,665,NULL,NULL,'admin_view',615,616),
	(669,665,NULL,NULL,'admin_delete',613,614),
	(668,665,NULL,NULL,'admin_edit',611,612),
	(667,665,NULL,NULL,'admin_add',609,610),
	(666,665,NULL,NULL,'admin_index',607,608),
	(663,1,NULL,NULL,'Qparc',602,605),
	(664,663,NULL,NULL,'admin_manage',603,604),
	(665,1,NULL,NULL,'UserProfiles',606,625),
	(683,675,NULL,NULL,'edit_reservation',641,642),
	(682,675,NULL,NULL,'reserve',639,640),
	(681,675,NULL,NULL,'admin_dates',637,638),
	(680,675,NULL,NULL,'admin_view',635,636),
	(679,675,NULL,NULL,'admin_delete',633,634),
	(678,675,NULL,NULL,'admin_edit',631,632),
	(677,675,NULL,NULL,'admin_add',629,630),
	(676,675,NULL,NULL,'admin_index',627,628),
	(675,1,NULL,NULL,'Locations',626,647),
	(674,665,NULL,NULL,'view',623,624),
	(709,708,NULL,NULL,'admin_index',693,694),
	(710,708,NULL,NULL,'admin_add',695,696),
	(711,708,NULL,NULL,'admin_edit',697,698),
	(712,708,NULL,NULL,'admin_delete',699,700),
	(713,708,NULL,NULL,'index',701,702),
	(714,708,NULL,NULL,'view',703,704),
	(715,1,NULL,NULL,'LocationPromos',706,719),
	(716,715,NULL,NULL,'admin_index',707,708),
	(717,715,NULL,NULL,'admin_edit',709,710),
	(718,715,NULL,NULL,'admin_delete',711,712),
	(719,715,NULL,NULL,'admin_view',713,714),
	(720,715,NULL,NULL,'index',715,716),
	(721,715,NULL,NULL,'view',717,718);

/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aros
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`)
VALUES
	(1,NULL,'Role',1,'',1,10),
	(2,NULL,'Role',2,'',11,18),
	(3,NULL,'Role',3,'',19,20),
	(5,1,'User',1,'',4,5),
	(6,1,'User',1,NULL,2,3),
	(7,2,'User',2,NULL,12,13),
	(8,1,'User',3,NULL,6,7),
	(9,2,'User',4,NULL,14,15),
	(10,2,'User',5,NULL,16,17),
	(11,1,'User',6,NULL,8,9);

/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aros_acos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aros_acos`;

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`)
VALUES
	(1,2,23,'1','1','1','1'),
	(2,2,22,'1','1','1','1'),
	(3,2,21,'1','1','1','1'),
	(4,3,21,'1','1','1','1'),
	(5,3,22,'1','1','1','1'),
	(6,2,29,'1','1','1','1'),
	(7,3,29,'1','1','1','1'),
	(8,2,77,'1','1','1','1'),
	(9,2,78,'1','1','1','1'),
	(10,2,79,'1','1','1','1'),
	(11,2,80,'1','1','1','1'),
	(12,2,81,'1','1','1','1'),
	(13,3,77,'1','1','1','1'),
	(14,3,78,'1','1','1','1'),
	(15,3,79,'1','1','1','1'),
	(16,3,80,'1','1','1','1'),
	(17,3,81,'1','1','1','1'),
	(18,2,123,'1','1','1','1'),
	(19,3,124,'1','1','1','1'),
	(20,3,125,'1','1','1','1'),
	(21,2,126,'1','1','1','1'),
	(22,3,127,'1','1','1','1'),
	(23,3,128,'1','1','1','1'),
	(24,3,129,'1','1','1','1'),
	(25,2,130,'1','1','1','1'),
	(26,2,131,'1','1','1','1'),
	(27,3,131,'1','1','1','1'),
	(126,3,374,'1','1','1','1'),
	(127,2,375,'1','1','1','1'),
	(128,3,375,'1','1','1','1'),
	(129,2,381,'1','1','1','1'),
	(125,2,374,'1','1','1','1'),
	(122,2,366,'1','1','1','1'),
	(123,2,367,'1','1','1','1'),
	(124,2,368,'1','1','1','1'),
	(121,2,365,'1','1','1','1'),
	(118,2,355,'1','1','1','1'),
	(119,2,356,'1','1','1','1'),
	(120,2,364,'1','1','1','1'),
	(130,3,381,'1','1','1','1'),
	(131,2,382,'1','1','1','1'),
	(132,3,382,'1','1','1','1'),
	(133,2,391,'1','1','1','1'),
	(134,2,392,'1','1','1','1'),
	(135,2,393,'1','1','1','1'),
	(136,2,401,'1','1','1','1'),
	(137,2,402,'1','1','1','1'),
	(138,2,410,'1','1','1','1'),
	(139,2,411,'1','1','1','1'),
	(140,2,419,'1','1','1','1'),
	(141,2,420,'1','1','1','1'),
	(142,2,421,'1','1','1','1'),
	(143,2,422,'1','1','1','1'),
	(144,2,423,'1','1','1','1'),
	(145,2,429,'1','1','1','1'),
	(146,3,429,'1','1','1','1'),
	(147,2,430,'1','1','1','1'),
	(148,3,430,'1','1','1','1'),
	(149,2,436,'1','1','1','1'),
	(150,3,436,'1','1','1','1'),
	(151,2,437,'1','1','1','1'),
	(152,3,437,'1','1','1','1'),
	(153,3,355,'1','1','1','1'),
	(154,3,356,'1','1','1','1'),
	(155,3,365,'1','1','1','1'),
	(156,2,446,'1','1','1','1'),
	(157,2,447,'1','1','1','1'),
	(158,2,448,'1','1','1','1'),
	(221,2,613,'1','1','1','1'),
	(178,2,502,'1','1','1','1'),
	(177,2,501,'1','1','1','1'),
	(255,2,702,'1','1','1','1'),
	(222,2,614,'1','1','1','1'),
	(223,2,615,'1','1','1','1'),
	(224,2,616,'1','1','1','1'),
	(258,2,704,'1','1','1','1'),
	(199,2,557,'1','1','1','1'),
	(198,2,556,'1','1','1','1'),
	(254,2,694,'1','1','1','1'),
	(179,2,503,'1','1','1','1'),
	(251,2,684,'1','1','1','1'),
	(252,2,685,'1','1','1','1'),
	(200,2,558,'1','1','1','1'),
	(253,2,693,'1','1','1','1'),
	(257,3,703,'1','1','1','1'),
	(256,2,703,'1','1','1','1'),
	(245,2,671,'1','1','1','1'),
	(246,2,672,'1','1','1','1'),
	(247,2,673,'1','1','1','1'),
	(248,2,674,'1','1','1','1'),
	(249,2,682,'1','1','1','1'),
	(250,2,683,'1','1','1','1'),
	(259,2,705,'1','1','1','1'),
	(260,2,706,'1','1','1','1'),
	(261,2,707,'1','1','1','1'),
	(262,2,713,'1','1','1','1'),
	(263,3,713,'1','1','1','1'),
	(264,2,714,'1','1','1','1'),
	(265,3,714,'1','1','1','1'),
	(266,2,720,'1','1','1','1'),
	(267,3,720,'1','1','1','1'),
	(268,2,721,'1','1','1','1'),
	(269,3,721,'1','1','1','1');

/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blocks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blocks`;

CREATE TABLE `blocks` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `region_id` int(20) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `show_title` tinyint(1) NOT NULL DEFAULT '1',
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `weight` int(11) DEFAULT NULL,
  `element` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visibility_roles` text COLLATE utf8_unicode_ci,
  `visibility_paths` text COLLATE utf8_unicode_ci,
  `visibility_php` text COLLATE utf8_unicode_ci,
  `params` text COLLATE utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `block_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;

INSERT INTO `blocks` (`id`, `region_id`, `title`, `alias`, `body`, `show_title`, `class`, `status`, `weight`, `element`, `visibility_roles`, `visibility_paths`, `visibility_php`, `params`, `updated`, `created`)
VALUES
	(3,4,'About','about','This is a live demonstration of the qParc™ Parking Website Management System.',1,'',0,1,'','','','','','2012-07-01 04:29:46','2009-07-26 17:13:14'),
	(8,8,'Search','search','',0,'',0,2,'search','','','','','2012-12-07 18:04:15','2009-12-20 03:07:27'),
	(5,4,'Meta','meta','[menu:meta]',1,'',0,5,'','[\"1\",\"2\"]','','','','2012-12-07 18:04:24','2009-09-12 06:36:22'),
	(7,4,'Categories','categories','[vocabulary:categories type=\"blog\"]',1,'',0,3,'','[\"1\",\"2\"]','','','','2012-12-07 18:04:20','2009-10-03 16:52:50'),
	(9,4,'Recent Posts','recent_posts','[node:recent_posts conditions=\"Node.type:blog\" order=\"Node.id DESC\" limit=\"5\"]',1,'',0,4,'','[\"1\",\"2\"]','','','','2012-12-07 18:04:22','2009-12-22 05:17:32'),
	(12,0,'Twitter Profile Widget','twitter_profile_widget','[element:twitter_profile_widget plugin=\"seo\"]',0,NULL,0,6,NULL,'[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]','',NULL,NULL,'2012-12-07 18:04:26','2012-06-13 14:10:47'),
	(14,4,'User Registration','registration','',0,'',0,9,'register','[\"3\"]','[\"/qparc/about\",\"/qparc/\",\"/qparc/users/login\"]',NULL,'','2012-12-07 18:05:46','2012-06-22 03:52:27'),
	(15,4,'Reservations','reservations','',1,'',0,7,'Qparc.reservation','','',NULL,'','2012-12-07 18:04:27','2012-06-22 22:50:34'),
	(18,20,'Site Logo','logo','<img src=\"/qparc_web/img/logo-main.png\" />',0,'',1,8,'','','',NULL,'','2012-12-07 18:04:29','2012-06-29 19:20:56'),
	(19,4,'Retail Leasing','retail-leasing','<p>RETAIL LEASING OPPORTUNITY</p>',0,'',1,11,'','','',NULL,'','2012-12-11 19:10:39','2012-12-11 19:08:16'),
	(20,4,'Open','open','<h3>WE\'RE OPEN 24 HOURS A DAY 7 DAYS A WEEK</h3>',0,'',1,10,'','','',NULL,'','2012-12-11 19:10:39','2012-12-11 19:10:04'),
	(21,4,'QRcode','qrcode','DOWNLOAD A QR CODE PARKING PASS TO YOUR MOBILE DEVICE',0,'',1,12,'','','',NULL,'','2012-12-11 19:12:05','2012-12-11 19:12:05'),
	(22,4,'Parking Rates','parking-rates','PARKING RATES & PROGRAMS',0,'',1,13,'','','',NULL,'','2012-12-11 19:13:04','2012-12-11 19:13:04'),
	(23,4,'Preferred Parker','preferred-parker','BECOME A PREFERRED PARKER',0,'',1,14,'','','',NULL,'','2012-12-11 19:14:12','2012-12-11 19:14:12');

/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(20) DEFAULT NULL,
  `node_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'comment',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `address2` text COLLATE utf8_unicode_ci,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message_status` tinyint(1) NOT NULL DEFAULT '1',
  `message_archive` tinyint(1) NOT NULL DEFAULT '1',
  `message_count` int(11) NOT NULL DEFAULT '0',
  `message_spam_protection` tinyint(1) NOT NULL DEFAULT '0',
  `message_captcha` tinyint(1) NOT NULL DEFAULT '0',
  `message_notify` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;

INSERT INTO `contacts` (`id`, `title`, `alias`, `body`, `name`, `position`, `address`, `address2`, `state`, `country`, `postcode`, `phone`, `fax`, `email`, `message_status`, `message_archive`, `message_count`, `message_spam_protection`, `message_captcha`, `message_notify`, `status`, `updated`, `created`)
VALUES
	(1,'Contact','contact','','','','','','','','','','','you@your-site.com',1,0,0,0,0,1,1,'2009-10-07 22:07:49','2009-09-16 01:45:17');

/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table i18n
# ------------------------------------------------------------

DROP TABLE IF EXISTS `i18n`;

CREATE TABLE `i18n` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `native` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `title`, `native`, `alias`, `status`, `weight`, `updated`, `created`)
VALUES
	(1,'English','English','eng',1,1,'2009-11-02 21:37:38','2009-11-02 20:52:00');

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(20) DEFAULT NULL,
  `menu_id` int(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `visibility_roles` text COLLATE utf8_unicode_ci,
  `params` text COLLATE utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;

INSERT INTO `links` (`id`, `parent_id`, `menu_id`, `title`, `class`, `description`, `link`, `target`, `rel`, `status`, `lft`, `rght`, `visibility_roles`, `params`, `updated`, `created`)
VALUES
	(5,NULL,4,'About','about','','controller:nodes/action:view/type:page/slug:about','','',0,3,4,'','','2012-06-29 18:56:51','2009-08-19 12:23:33'),
	(6,NULL,4,'Contact','contact','','controller:contacts/action:view/contact','','',0,5,6,'','','2012-06-29 18:56:35','2009-08-19 12:34:56'),
	(7,NULL,3,'HOME','home','','/','','',1,5,6,'','','2012-12-10 18:25:45','2009-09-06 21:32:54'),
	(8,NULL,3,'About','about','','/about','','',0,7,8,'[\"3\"]','','2012-06-29 19:28:18','2009-09-06 21:34:57'),
	(10,NULL,5,'Site Admin','site-admin','','/admin','','',1,1,2,'','','2009-09-12 06:34:09','2009-09-12 06:34:09'),
	(11,NULL,5,'Log out','log-out','','/users/logout','','',1,7,8,'[\"1\",\"2\"]','','2009-09-12 06:35:22','2009-09-12 06:34:41'),
	(12,NULL,6,'Croogo','croogo','','http://www.croogo.org','','',1,3,4,'','','2009-09-12 23:31:59','2009-09-12 23:31:59'),
	(14,NULL,6,'CakePHP','cakephp','','http://www.cakephp.org','','',1,1,2,'','','2009-10-07 03:25:25','2009-09-12 23:38:43'),
	(15,NULL,3,'Contact Us','contact-us','','/controller:contacts/action:view/contact','','',0,15,16,'[\"1\",\"2\",\"3\"]','','2012-06-29 19:42:50','2009-09-16 07:53:33'),
	(16,NULL,5,'Entries (RSS)','entries-rss','','/nodes/promoted.rss','','',1,3,4,'','','2009-10-27 17:46:22','2009-10-27 17:46:22'),
	(17,NULL,5,'Comments (RSS)','comments-rss','','/comments.rss','','',1,5,6,'','','2009-10-27 17:46:54','2009-10-27 17:46:54'),
	(24,NULL,3,'Reservations','','','/reservations','','',0,9,10,'','','2012-06-22 04:03:33','2012-06-20 20:08:03'),
	(27,NULL,3,'Locations','locations','','/locations','','',0,11,12,'','','2012-06-22 19:36:59','2012-06-22 19:36:59'),
	(29,NULL,3,'My Profile','my-profile','','/profile','','',0,13,14,'[\"1\",\"2\"]','','2012-06-29 00:30:32','2012-06-29 00:30:32'),
	(30,NULL,3,'RATES','rates','','controller:nodes/action:view/type:page/slug:rates','','',1,17,18,'','','2012-12-10 18:23:50','2012-12-06 02:12:52'),
	(31,NULL,3,'DIRECTIONS','directions','','controller:nodes/action:view/type:page/slug:directions','','',1,19,20,'','','2012-12-10 18:24:05','2012-12-06 02:13:18'),
	(32,NULL,3,'RETAIL INFO','retail-info','','controller:nodes/action:view/type:page/slug:retail-leasing-information','','',1,21,22,'','','2012-12-10 18:24:20','2012-12-06 02:13:57'),
	(33,NULL,3,'A GREEN BUILD','a-green-build','','controller:nodes/action:view/type:page/slug:sustainability-and-our-green-building','','',1,23,24,'','','2012-12-10 18:25:25','2012-12-06 02:15:05'),
	(34,NULL,7,'PHILLADELPHIA CONVENTION CENTER','philladelphia-convention-center','','http://www.paconvention.com/','','',1,1,2,'','','2012-12-06 02:18:48','2012-12-06 02:18:48'),
	(35,NULL,7,'AIRPORT','airport','','http://www.phl.org/Pages/HomePage.aspx','','',1,3,4,'','','2012-12-06 02:19:38','2012-12-06 02:19:38'),
	(36,NULL,7,'CAR RENTALs','car-rentals','','http://www.phl.org/passengerinfo/transportationservices/Pages/rental_cars.aspx','','',1,5,6,'','','2012-12-06 02:20:23','2012-12-06 02:20:23'),
	(37,NULL,7,'VISIT PHILLY.com','visit-phillycom','','http://www.visitphilly.com/','','',1,7,8,'','','2012-12-06 02:21:40','2012-12-06 02:21:40');

/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table location_companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location_companies`;

CREATE TABLE `location_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(150) NOT NULL,
  `company_address` varchar(150) NOT NULL,
  `company_contact_name` varchar(100) NOT NULL,
  `company_contact_email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `number_of_employees` int(11) NOT NULL,
  `estimated_monthly_usage` varchar(150) NOT NULL,
  `comments` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `location_promo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table location_dates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location_dates`;

CREATE TABLE `location_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date DEFAULT NULL,
  `notes` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `location_dates` WRITE;
/*!40000 ALTER TABLE `location_dates` DISABLE KEYS */;

INSERT INTO `location_dates` (`id`, `location_id`, `from`, `to`, `notes`, `status`)
VALUES
	(1,3,'2012-07-14','2012-07-15','',0),
	(2,3,'2012-07-21','2012-07-21','',1),
	(3,3,'2012-06-29','2012-06-29','',1),
	(5,3,'2012-08-04','2012-08-12','',1),
	(6,3,'2012-07-08','2012-07-12','',1),
	(7,8,'2012-08-04','2012-08-12','',1),
	(8,8,'2012-07-08','2012-07-12','',1);

/*!40000 ALTER TABLE `location_dates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table location_promos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location_promos`;

CREATE TABLE `location_promos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(150) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `start` date NOT NULL,
  `expiration` date NOT NULL,
  `number_of_uses` int(11) NOT NULL DEFAULT '1',
  `store` varchar(50) DEFAULT NULL,
  `promote` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `location_promos` WRITE;
/*!40000 ALTER TABLE `location_promos` DISABLE KEYS */;

INSERT INTO `location_promos` (`id`, `location_id`, `name`, `details`, `code`, `status`, `start`, `expiration`, `number_of_uses`, `store`, `promote`, `created`, `modified`)
VALUES
	(1,3,'1/2 Off Full Day Parking','Edit these details in the qParc location manager','http://codecreator.com',1,'2012-08-21','2013-06-21',1,NULL,0,'2012-06-21 04:00:43','2012-06-22 19:38:53'),
	(3,3,'Free 1/2 Day of Parking','Come get a free half day of parking!','http://codecreator.com',1,'2013-06-30','2013-07-22',1,NULL,1,'2012-06-22 18:50:59','2012-06-22 18:50:59'),
	(4,8,'1/2 Off Full Day Parking','Edit these details in the qParc location manager','http://codecreator.com',1,'2012-08-21','2013-06-21',1,NULL,0,'2012-06-21 04:00:43','2012-06-22 19:38:53'),
	(5,8,'Free 1/2 Day of Parking','Come get a free half day of parking!','http://codecreator.com',1,'2013-06-30','2013-07-22',1,NULL,1,'2012-06-22 18:50:59','2012-06-22 18:50:59');

/*!40000 ALTER TABLE `location_promos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table location_reservation_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location_reservation_options`;

CREATE TABLE `location_reservation_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `cost` varchar(50) NOT NULL,
  `terms` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `promote` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `location_reservation_options` WRITE;
/*!40000 ALTER TABLE `location_reservation_options` DISABLE KEYS */;

INSERT INTO `location_reservation_options` (`id`, `location_id`, `name`, `description`, `cost`, `terms`, `status`, `promote`, `created`, `modified`)
VALUES
	(1,3,'INDOOR VALET','Premium indoor parking in our state-of-the-art facility. Please be our guest and receive concierge treatment.','18.00',1,1,0,'2012-06-21 15:53:17','2012-06-21 16:09:27'),
	(2,3,'COVERED SELF-PARK','Park under the canopy and rest assured that your vehicle is protected from the elements.','14.00',1,1,0,'2012-06-21 16:03:15','2012-06-21 16:12:38'),
	(3,3,'OPEN-AIR PARK','Low price parking with the same fast service.','8.00',1,1,0,'2012-06-21 16:13:09','2012-06-21 16:14:09'),
	(10,8,'OPEN-AIR PARK','Low price parking with the same fast service.','8.00',1,1,0,'2012-06-21 16:13:09','2012-06-21 16:14:09'),
	(9,8,'COVERED SELF-PARK','Park under the canopy and rest assured that your vehicle is protected from the elements.','14.00',1,1,0,'2012-06-21 16:03:15','2012-06-21 16:12:38'),
	(11,9,'Early Bird','(in by 9:00am out by 6:00pm)','16.00',1,0,0,'2012-12-10 16:44:16','2012-12-10 16:47:10');

/*!40000 ALTER TABLE `location_reservation_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table location_reservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location_reservations`;

CREATE TABLE `location_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `location_reservation_option_id` int(11) NOT NULL,
  `location_promo_id` int(11) NOT NULL,
  `entrance` datetime DEFAULT NULL,
  `exit` datetime DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `instructions` text,
  `qrcode` text NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `prepaid` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `location_reservations` WRITE;
/*!40000 ALTER TABLE `location_reservations` DISABLE KEYS */;

INSERT INTO `location_reservations` (`id`, `location_id`, `location_reservation_option_id`, `location_promo_id`, `entrance`, `exit`, `length`, `instructions`, `qrcode`, `transaction_id`, `user_id`, `prepaid`, `status`, `created`, `modified`)
VALUES
	(93,8,9,4,'2012-07-01 17:56:00','2012-07-02 00:00:00',NULL,'testing ','ja0fesnqn40t084',NULL,1,0,1,'2012-06-28 21:57:16','2012-06-28 21:57:16'),
	(92,3,3,0,'2012-07-01 17:55:00','2012-07-02 00:00:00',NULL,'','a0uehujg5rmria5',NULL,1,0,1,'2012-06-28 21:55:49','2012-06-28 21:55:49'),
	(91,3,1,0,'2012-07-22 17:54:00','2012-07-23 00:00:00',NULL,'testing','8j9413bsv5ey4l7',NULL,1,0,1,'2012-06-28 21:55:12','2012-06-28 21:55:12'),
	(83,3,1,0,'2012-06-23 00:00:00','2012-06-24 00:00:00',NULL,'','',NULL,1,0,1,'2012-06-23 16:47:44','2012-06-23 16:47:44'),
	(84,3,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'Test','',NULL,1,0,1,'2012-06-23 18:00:36','2012-06-23 18:00:36'),
	(85,3,1,0,'2012-06-28 14:02:00','2012-06-30 00:00:00',NULL,'','',NULL,1,0,1,'2012-06-23 18:07:17','2012-06-23 18:07:17'),
	(88,3,2,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'','',NULL,1,0,1,'2012-06-24 22:30:51','2012-06-24 22:30:51'),
	(89,3,3,1,'2012-06-30 18:40:00','2012-07-01 00:00:00',NULL,'special instructions...','',NULL,1,0,1,'2012-06-24 22:38:04','2012-06-24 22:41:03'),
	(94,8,10,4,'2012-07-18 10:23:00','2012-07-19 08:00:00',NULL,'','j69b6454ffllqh0',NULL,1,0,1,'2012-07-13 14:23:33','2012-07-13 14:23:33'),
	(95,8,10,4,'2012-07-18 18:33:00','2012-07-19 00:00:00',NULL,'','583zdyuepog2zai',NULL,2,1,1,'2012-07-17 22:34:04','2012-07-17 22:34:04');

/*!40000 ALTER TABLE `location_reservations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `terms` text NOT NULL,
  `promote` tinyint(1) NOT NULL,
  `comment_status` tinyint(1) NOT NULL,
  `comment_count` int(11) DEFAULT NULL,
  `lot_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;

INSERT INTO `locations` (`id`, `name`, `address`, `lat`, `lon`, `status`, `featured`, `terms`, `promote`, `comment_status`, `comment_count`, `lot_id`, `created`, `modified`)
VALUES
	(9,'Convention Center Parking Facility','1324 Arch Street, Philadelphia, PA 19107',0,0,1,0,'',1,0,NULL,NULL,'2012-12-10 16:39:16','2012-12-10 16:39:16');

/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) DEFAULT NULL,
  `link_count` int(11) NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `title`, `alias`, `class`, `description`, `status`, `weight`, `link_count`, `params`, `updated`, `created`)
VALUES
	(3,'Main Menu','main','','',1,NULL,10,'','2009-08-19 12:21:06','2009-07-22 01:49:53'),
	(4,'Footer','footer','','',1,NULL,2,'','2009-08-19 12:22:42','2009-08-19 12:22:42'),
	(5,'Meta','meta','','',1,NULL,4,'','2009-09-12 06:33:29','2009-09-12 06:33:29'),
	(6,'Blogroll','blogroll','','',1,NULL,2,'','2009-09-12 23:30:24','2009-09-12 23:30:24'),
	(7,'TopNav','topnav','','',1,NULL,4,'','2012-12-06 02:17:03','2012-12-06 02:17:03');

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `message_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meta`;

CREATE TABLE `meta` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Node',
  `foreign_key` int(20) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;

INSERT INTO `meta` (`id`, `model`, `foreign_key`, `key`, `value`, `weight`)
VALUES
	(4,'Node',6,'','',NULL),
	(3,'Node',5,'','',NULL),
	(5,'Node',7,'','',NULL),
	(6,'Node',8,'','',NULL),
	(7,'Node',9,'','',NULL),
	(8,'Node',10,'','',NULL);

/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nodes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nodes`;

CREATE TABLE `nodes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(20) DEFAULT NULL,
  `user_id` int(20) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `mime_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_status` int(1) NOT NULL DEFAULT '1',
  `comment_count` int(11) DEFAULT '0',
  `promote` tinyint(1) NOT NULL DEFAULT '0',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms` text COLLATE utf8_unicode_ci,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `visibility_roles` text COLLATE utf8_unicode_ci,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'node',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `nodes` WRITE;
/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;

INSERT INTO `nodes` (`id`, `parent_id`, `user_id`, `title`, `slug`, `body`, `excerpt`, `status`, `mime_type`, `comment_status`, `comment_count`, `promote`, `path`, `terms`, `sticky`, `lft`, `rght`, `visibility_roles`, `type`, `updated`, `created`)
VALUES
	(6,NULL,5,'Contact Us','contact-us','<p><strong>Convention Center Parking Facility</strong><br /><span>1324-42 Arch Street Philadelphia, PA 19107</span><br /><a href=\"mailto:info@conventioncenterparking.com\">info@conventioncenterparking.com</a></p>\r\n<p><img src=\"http://www.conventioncenterparking.com/images/Contact-Us.jpg\" alt=\"Contact Us\" width=\"505\" height=\"347\" /></p>','',1,NULL,1,0,0,'/page/contact-us',NULL,0,3,4,'','page','2012-12-10 17:04:50','2012-12-10 17:03:00'),
	(7,NULL,5,'Retail Leasing Information','retail-leasing-information','<p><strong>Get in on the ground floor!</strong><br />Our attractive new facility offers the perfect location for your retail business.</p>\r\n<p>Prime New Construction +/-16,250 SF of retail space available at the Convention<br />Center Parking Facility&reg;. This is contemporary, dramatic high-ceiling space - a rarity<br />in Center City. There is a 540-car parking garage above the space.</p>\r\n<p>Neighboring tenants include Maggiano\'s, Hard Rock Cafe, Chili\'s and the Reading<br />Terminal Market.</p>\r\n<p>This prime, new construction is easily divisible and is directly across the street from the<br />Pennsylvania Convention Center and steps from City Hall, Philadelphia\'s historic district,&nbsp;<br />hotels, and tourist destinations.</p>\r\n<p><strong>Highlights</strong><br />- Restaurant Space Available<br />- Easily Divisible<br />- Contemporary, Dramatic High Ceiling Space<br />- On-Site 540-Car Parking Garage<br />- Outdoor Seating Available</p>\r\n<p><strong>To request additional information&nbsp;</strong><br />Michael Gorman&nbsp;<br />Metro Commercial Real Estate&nbsp;<br />215-893-0300<br /><a href=\"mailto:mgorman@metrocommercial.com\">mgorman@metrocommercial.com</a></p>\r\n<div id=\"slideshow\"><img src=\"http://www.conventioncenterparking.com/fader/image1_lease.jpg\" alt=\"\" width=\"631\" height=\"421\" /> <img src=\"http://www.conventioncenterparking.com/fader/image2_lease.jpg\" alt=\"\" width=\"631\" height=\"421\" /> <img src=\"http://www.conventioncenterparking.com/fader/image3_lease.jpg\" alt=\"\" width=\"631\" height=\"421\" /> <img src=\"http://www.conventioncenterparking.com/fader/image4_lease.jpg\" alt=\"\" width=\"631\" height=\"421\" /> <img src=\"http://www.conventioncenterparking.com/fader/image5_lease.jpg\" alt=\"\" width=\"631\" height=\"421\" /></div>','',1,NULL,1,0,0,'/page/retail-leasing-information',NULL,0,5,6,'','page','2012-12-11 20:04:42','2012-12-10 17:09:00'),
	(3,NULL,0,'aws-marketplace','aws-marketplace.png','',NULL,0,'image/png',1,0,0,'/uploads/aws-marketplace.png',NULL,0,1,2,NULL,'attachment','2012-06-29 20:20:53','2012-06-29 20:20:53'),
	(8,NULL,5,'Sustainability and our Green Building','sustainability-and-our-green-building','<p><strong>What does it mean for a garage to be green?</strong><br />It means we\'re doing the right thing for our environment and our city.</p>\r\n<p><strong>Green Roof</strong><br />The Convention Center Parking Facility&reg; utilizes a progressive green roof technology in its construction. This system is designed to combine beauty and intelligence&mdash;it manages stormwater and provides a growing medium for plants, flowers and eye-catching seasonal displays.</p>\r\n<p>The benefits of this technology are many: reduced energy consumption, filtration of acid rain and air pollutants, noise pollution reduction and those intangible effects gained from being in the presence of a more beautiful, pleasing, livable urban landscape.</p>\r\n<p>Whether it\'s crocuses in spring or evergreens in winter, our \"green garage\" will be givinga boost to nature all year long.</p>\r\n<p>Philadelphia has been at the forefront of supporting green roof technology with one of themost progressive programs in the country. We are proud to be part of this effort.</p>\r\n<p><strong>LED Lighting.</strong>&nbsp;<br />As part of our green initiative, we\'ve installed LED lighting throughout the parking facility.&nbsp;LEDs consume far less energy than incandescent lamps, and achieve<br />energy efficiency that rivals or surpasses fluorescent sources.&nbsp;</p>\r\n<p>LED lighting contains nolead or mercury and lasts 100,000 hours or more without failure.&nbsp;Best of all, along with providing green, sustainable solutions, LEDs illuminate our facility with bright, quality light&mdash;helping to create an inviting, well-lit, comfortable environment.</p>\r\n<p><strong>EV Charging stations<br /></strong>PEP Electric vehicle charging stations are another sustainable amenity that the Convention Center Parking Facility&reg; is proud to offer as a &nbsp;more environmentally friendly garage.</p>\r\n<p>providing a smart, stylish, user-friendly charging station for the electric vehicle driver of today and tomorrow. Equipped with a magnetic strip card reader a driver can simply swipe their card and recharge while helping support the electric vehicle movement, assisting us to lead sustainable, healthier lives.</p>\r\n<p>Re-charge your electric car battery while you work or play!</p>','',1,NULL,1,0,0,'/page/sustainability-and-our-green-building',NULL,0,7,8,'','page','2012-12-10 17:13:20','2012-12-10 17:12:00'),
	(5,NULL,5,'Directions','directions','<div id=\"map\"><a href=\"http://maps.google.com/maps?q=1324 Arch Street, Philadelphia, PA 19107\" target=\"_blank\"> <img src=\"http://maps.googleapis.com/maps/api/staticmap?center=1324 Arch Street, Philadelphia, PA 19107&amp;zoom=18&amp;size=500x400&amp;maptype=roadmap 				&amp;markers=color:blue%7Clabel:X%7C0,0&amp;sensor=false\" alt=\"\" width=\"500\" height=\"400\" /> </a></div>\r\n<div>\r\n<p><a href=\"/conventionParking/admin/nodes/add/pdf/directions.pdf\">Printer Friendly Directions</a></p>\r\n<p><strong>Directions to the Convention Center Parking Facility&reg;<br /> 1324 Arch Street, Philadelphia, PA 19107</strong><br /><br /> <strong>From the Northern and Western Suburbs</strong><br /> Take I-76 East to Exit 344 for I-676 East.<br /> Follow signs for Central Philadelphia.<br /> From I-676 East, exit at Broad Street/Rt. 611 (2nd exit).  You will be on Vine Street.<br /> At the 4th traffic light, turn right onto N. 12th Street.<br /> At the 2nd traffic light, turn right onto Arch Street.<br /> Proceed two blocks. The garage entrance is on your left.<br /><br /> <strong>From I-95 Northbound and Philadelphia International Airport</strong><br /> Take 1-95 North to Exit 22 for Central Philadelphia and I-676. Stay in left lane.<br /> Follow signs for I-676 West. Exit at Broad Street/Rt. 611 (1st exit). <br /> This exit brings you onto 15th Street. <br /> Stay in left lane and follow sign for Broad Street/Rt. 611. <br /> Turn left onto Vine Street. Follow signs for Vine Street/PA Convention Center.<br /> Turn right onto N. 12th Street. <br /> At the 2nd traffic light, turn right onto Arch Street. <br /> Proceed two blocks. The garage entrance is on your left. <br /><br /> <strong>From I-95 Southbound</strong><br /> Take I-95 South to Exit 22 for Central Philadelphia and I-676. Stay in left lane.<br /> Follow signs for I-676 West. Exit at Broad Street/Rt. 611 (1st exit).<br /> This exit brings you onto 15th Street.<br /> Stay in left lane and follow sign for Broad Street/Rt. 611. <br /> Turn left onto Vine Street. Follow signs for Vine Street/PA Convention Center.<br /> Turn right onto N. 12th Street. <br /> At the 2nd traffic light, turn right onto Arch Street.  <br /> Proceed two blocks. The garage entrance is on your left.<br /> <strong><br /> From the Pennsylvania Turnpike</strong><br /> Follow Pennsylvania Turnpike to Exit 20 for I-476 (Mid-County Interchange).<br /> Take I-476 South to Exit 16 for I-76 East.<br /> Stay on I-76 East for approximately 12 miles.<br /> Take exit 344 on the left and merge onto I-676 East toward Central Philadelphia.<br /> Take I-676 East. Exit at Broad Street/Rt. 611 (2nd exit). You will be on Vine Street.<br /> At the 4th traffic light, turn right onto N. 12th Street. <br /> At the 2nd traffic light, turn right onto Arch Street.<br /> Proceed two blocks. The garage entrance is on your left.<br /> <strong><br /> From the New Jersey Turnpike</strong><br /> Take New Jersey Turnpike to Exit 4 (Philadelphia/Camden) and Rt. 73 North.<br /> Follow Rt. 73 North to Rt. 38 West.<br /> Follow Rt. 38 West to the Benjamin Franklin Bridge and Rt. 30 West. <br /> Follow the signs for PA Convention Center. You will be on Vine Street. <br /> Proceed  approximately 6 blocks and turn left turn onto N. 12th Street.<br /> At the 2nd traffic light, turn right onto Arch Street.  <br /> Proceed two blocks. The garage entrance is on your left.</p>\r\n</div>','',1,NULL,1,0,0,'/page/directions',NULL,0,1,2,'','page','2012-12-10 17:01:28','2012-12-10 16:49:00'),
	(9,NULL,5,'Rates','rates','<p>Up to 1 hour $6.00<br />Each Additional hour $12.00</p>\r\n<p><strong>Early Bird</strong><br />(in by 9:00am out by 6pm) $16.00<br /><br /><strong>Daily Maximums:</strong><br />Up to 12 hours $25.00<br />Up to 24 hours</p>','',1,NULL,1,0,0,'/page/rates',NULL,0,9,10,'','page','2012-12-10 17:55:39','2012-12-10 17:13:00'),
	(10,NULL,5,'Home','home','<div id=\"homepage\">\r\n<div id=\"upperPanel\">\r\n<div id=\"homeSlider\"><img src=\"http://www.conventioncenterparking.com/fader/image1_dev_n.jpg\" alt=\"\" width=\"500\" /> <img src=\"http://www.conventioncenterparking.com/fader/image2_dev_n.jpg\" alt=\"\" width=\"500\" /> <img src=\"http://www.conventioncenterparking.com/fader/image3_dev_n.jpg\" alt=\"\" width=\"500\" /> <img src=\"http://www.conventioncenterparking.com/fader/image4_dev_n.jpg\" alt=\"\" width=\"500\" /> <img src=\"http://www.conventioncenterparking.com/fader/image5_dev_n.jpg\" alt=\"\" width=\"500\" /> <img src=\"http://www.conventioncenterparking.com/fader/image6_dev_n.jpg\" alt=\"\" width=\"500\" /> <img src=\"http://www.conventioncenterparking.com/fader/image7_dev_n.jpg\" alt=\"\" width=\"500\" /></div>\r\n<!--homeSlider -->\r\n<div id=\"sliderCompanion\">\r\n<p>Convenience isn\'t all our garage has to offer. New construction also means new amenities</p>\r\n<ul>\r\n<li>Energy Efficent LED Lighting</li>\r\n<li>Electric Vehicle Charging Stations</li>\r\n<li>Glass Backed Elevators: Better to see and be seen!</li>\r\n<li>Street Level Shops and Restaurants</li>\r\n<li>Green Roof Technology</li>\r\n</ul>\r\n<button>Learn More</button></div>\r\n<!--sliderCompanion-->\r\n<div class=\"clear\">&nbsp;</div>\r\n</div>\r\n<!--upperPanel -->\r\n<div id=\"lowerPanel\"><img src=\"http://www.conventioncenterparking.com/images/park_with_us.png\" alt=\"Please come park with us!  Parking in the heart of Philadelphia just got better!\" />\r\n<h4>It\'s NEW. It\'s Convenient. It\'s Green... and More!</h4>\r\n<p>Our new 540-car parking garage is adjacent to the recently expanded Pennsylvania Convention Center and just steps from the Masonic Temple, Criminal Justice Center, City Hall, Municipal Services Building, Market Street office buildings, hotels, restaurants, and more. With convenient entrances on Juniper and Arch Streets and convenient to I-676, I-95 and I-76 and we\'re open 24 hours a day 7 days a week.</p>\r\n</div>\r\n<!--lowerPanel--></div>\r\n<!--homepage -->','',1,NULL,1,0,1,'/page/home',NULL,0,11,12,'','page','2012-12-11 21:45:49','2012-12-11 20:43:00');

/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nodes_taxonomies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nodes_taxonomies`;

CREATE TABLE `nodes_taxonomies` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `node_id` int(20) NOT NULL DEFAULT '0',
  `taxonomy_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table regions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `regions`;

CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `block_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `region_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;

INSERT INTO `regions` (`id`, `title`, `alias`, `description`, `block_count`)
VALUES
	(3,'none','none','',0),
	(4,'right','right','',4),
	(6,'left','left','',0),
	(7,'header','header','',0),
	(8,'footer','footer','',0),
	(9,'region1','region1','',0),
	(10,'region2','region2','',0),
	(11,'region3','region3','',0),
	(12,'region4','region4','',0),
	(13,'region5','region5','',0),
	(14,'region6','region6','',0),
	(15,'region7','region7','',0),
	(16,'region8','region8','',0),
	(17,'region9','region9','',0),
	(20,'Logo','logo',NULL,1);

/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `title`, `alias`, `created`, `updated`)
VALUES
	(1,'Admin','admin','2009-04-05 00:10:34','2009-04-05 00:10:34'),
	(2,'Registered','registered','2009-04-05 00:10:50','2009-04-06 05:20:38'),
	(3,'Public','public','2009-04-05 00:12:38','2009-04-07 01:41:45');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seos`;

CREATE TABLE `seos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `node_id` int(10) DEFAULT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `meta_robots` text COLLATE utf8_unicode_ci,
  `changefreq` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `seos` WRITE;
/*!40000 ALTER TABLE `seos` DISABLE KEYS */;

INSERT INTO `seos` (`id`, `node_id`, `meta_keywords`, `meta_description`, `meta_robots`, `changefreq`, `priority`)
VALUES
	(1,2,'','','','','');

/*!40000 ALTER TABLE `seos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `input_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'text',
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  `weight` int(11) DEFAULT NULL,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `key`, `value`, `title`, `description`, `input_type`, `editable`, `weight`, `params`)
VALUES
	(6,'Site.title','qParc Parking Website','','','',1,1,''),
	(7,'Site.tagline','A qParc powered Content Management System.','','','textarea',1,2,''),
	(8,'Site.email','you@your-site.com','','','',1,3,''),
	(9,'Site.status','1','','','checkbox',1,5,''),
	(12,'Meta.robots','index, follow','','','',1,6,''),
	(13,'Meta.keywords','qparc, quikparc, online parking','','','textarea',1,7,''),
	(14,'Meta.description','qParc - A Parking Website Content Management System','','','textarea',1,8,''),
	(15,'Meta.generator','Croogo - Content Management System','','','',0,9,''),
	(16,'Service.akismet_key','your-key','','','',1,11,''),
	(17,'Service.recaptcha_public_key','your-public-key','','','',1,12,''),
	(18,'Service.recaptcha_private_key','your-private-key','','','',1,13,''),
	(19,'Service.akismet_url','http://your-blog.com','','','',1,10,''),
	(20,'Site.theme','','','','',0,14,''),
	(21,'Site.feed_url','','','','',0,15,''),
	(22,'Reading.nodes_per_page','5','','','',1,16,''),
	(23,'Writing.wysiwyg','1','Enable WYSIWYG editor','','checkbox',1,17,''),
	(24,'Comment.level','1','','levels deep (threaded comments)','',1,18,''),
	(25,'Comment.feed_limit','10','','number of comments to show in feed','',1,19,''),
	(26,'Site.locale','eng','','','text',0,20,''),
	(27,'Reading.date_time_format','D, M d Y H:i:s','','','',1,21,''),
	(28,'Comment.date_time_format','M d, Y','','','',1,22,''),
	(29,'Site.timezone','0','','zero (0) for GMT','',1,4,''),
	(32,'Hook.bootstraps','Tinymce,SocialBookmarks,Amazon,Qparc','','','',0,23,''),
	(33,'Comment.email_notification','1','Enable email notification','','checkbox',1,24,''),
	(34,'Croogo.version','1.4.3\n','','','',0,25,''),
	(35,'Seo.remove_settings_on_deactivate','NO','','Remove settings on deactivate','',1,26,''),
	(36,'Seo.changefreq','weekly','','Default Changefeq of the SEO Sitemap entries','',1,27,''),
	(37,'Seo.priority','0.8','','Default Priority of the SEO Sitemap entries','',1,28,''),
	(38,'Seo.organize_by_vocabulary','1','','Organize the public sitemap by vocabulary?','',1,29,''),
	(39,'Seo.homepage_title','qParc Parking Website','','Homepage Title ','',1,30,''),
	(40,'Seo.homepage_description','A qParc powered Content Management System.','','Default Homepage META Description','',1,31,''),
	(41,'Seo.show_per_page_stats','0','','Show Page Stats','',1,32,''),
	(42,'Seo.hook_google','0','','Provide Hook to Google','',1,33,''),
	(43,'Seo.hook_twitter','0','','Provide Hook to Twitter','',1,34,''),
	(44,'Seo.hook_facebook','0','','Provide Hook to Facebook','',1,35,''),
	(45,'Seo.alexa_verification_key','','','Alexa Verification Key','',1,36,''),
	(46,'Seo.bing_webmaster_tools_key','','','Bing Webmaster Tools Key','',1,37,''),
	(47,'Seo.google_adwords_tracking_for_messages','','','Google AdWords Tracking for Messages','',1,38,''),
	(48,'Seo.google_webmaster_tools_key','','','Google Webmaster Tools Key','',1,39,''),
	(49,'Seo.google_analytics_ua','UA-1-XXXXXXXXX','','Google Analytics UA Property','',1,40,''),
	(50,'Seo.google_analytics_domain','your-site.com','','Google Analytics Domain','',1,41,''),
	(51,'Seo.google_places_cid','','','Google Places CID','',1,42,''),
	(52,'Seo.google_plus_cid','','','Google Plus CID','',1,43,''),
	(53,'Seo.meta_robots_default','INDEX, FOLLOW','','Default robots entry for individual pages','',1,44,''),
	(54,'Seo.insert_meta_description','1','','Insert META Description tag?','',1,45,''),
	(55,'Seo.insert_meta_robots','1','','Insert META Robots tag?','',1,46,''),
	(56,'Seo.insert_meta_keywords','1','','Insert META Keywords tag?','',1,47,''),
	(57,'Seo.turn_off_promote_by_default','1','','Turn OFF \"Promoted\" by default','',1,48,''),
	(58,'Seo.add_rss_ga_campaign_tags','1','','Add Google Analytics Campaign Trackers to link?','',1,49,''),
	(59,'Seo.rss_ga_medium','rssfeed','','Campaign Medium','',1,50,''),
	(60,'Seo.rss_ga_campaign_name','RSSFeed','','Campaign Name','',1,51,''),
	(61,'Seo.rss_before','','','RSS Post Prefix','',1,52,''),
	(62,'Seo.rss_after','','','RSS Post Suffix','',1,53,''),
	(63,'Seo.add_copy_link','1','','Add page link when copied?','',1,54,''),
	(64,'Seo.add_copy_link_ga_campaign_tags','1','','Add Google Analytics Campaign Trackers to link?','',1,55,''),
	(65,'Seo.copy_link_ga_medium','copylink','','Campaign Medium','',1,56,''),
	(66,'Seo.copy_link_ga_campaign_name','CutNPaste','','Campaign Name','',1,57,''),
	(67,'Seo.copy_link_text','Read more at: {{current_page}} Copyright &copy; {{site_title}}','','Text to add when copied.','',1,58,''),
	(68,'Seo.facebook_link','','','Facebook Page','',1,59,''),
	(69,'Seo.facebook_app_key','','','Facebook App Key','',1,60,''),
	(70,'Seo.facebook_app_secret','','','Facebook App Secret','',1,61,''),
	(71,'Seo.twitter_username','','','Twitter Username','',1,62,''),
	(72,'Seo.twitter_consumer_key','','','Twitter Consumer Key','',1,63,''),
	(73,'Seo.twitter_consumer_secret','','','Twitter Consumer Secret','',1,64,''),
	(74,'Seo.twitter_access_token','','','Twitter Access Token','',1,65,''),
	(75,'Seo.twitter_access_token_secret','','','Twitter Access Secret','',1,66,''),
	(76,'Seo.version','1.0','Version','','',0,67,''),
	(77,'Seo.adwords_conversion_key_contact','','','Conversion ID','',1,68,''),
	(78,'Seo.adwords_conversion_language_contact','','','Conversion Language','',1,69,''),
	(79,'Seo.adwords_conversion_format_contact','','','Conversion Format','',1,70,''),
	(80,'Seo.adwords_conversion_color_contact','','','Conversion Color','',1,71,''),
	(81,'Seo.adwords_conversion_label_contact','','','Conversion Label','',1,72,''),
	(82,'Seo.adwords_conversion_value_contact','','','Conversion Value','',1,73,''),
	(83,'Qparc.authnet_login','5tjjBv7z3SM','','Authorize.net Login','',1,74,''),
	(84,'Qparc.authnet_transaction_key','2U5b5T7L7zg9Eu4H','','Authorize.net Transaction Key','',1,75,''),
	(85,'Qparc.iparc_enabled','1','','iParc Integration','',1,76,''),
	(86,'Qparc.iparc_site_id','','','iParc Site ID','',1,77,''),
	(90,'Qparc.iparc_identifier','','','Identifier','',1,78,''),
	(91,'Qparc.iparc_validation','','','Store Validation Number','',1,79,''),
	(92,'Qparc.email_enabled','1','','Enable Email Reservation Reports','',1,80,''),
	(93,'Qparc.email_addresses','','','Email Address to send Reservation Reports.','',1,81,''),
	(94,'Qparc.email_frequency','1','','Frequency to email reports','',1,82,''),
	(95,'Qparc.reservations_public','1','','Reservations Public/Private','',1,83,''),
	(102,'Qparc.reservations_show_promos','1','','Show Promotions when Reserving','',1,84,''),
	(103,'Qparc.reservations_show_payment','1','','Show Payment when Reserving (Prepaid Reservations)','',1,85,''),
	(104,'Amazon.key','AKIAIZTBS37SXIWIF23A','','Amazon API Key','',1,86,''),
	(105,'Amazon.secret','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','','Amazon API Secret','',1,87,''),
	(106,'Amazon.sns_host','ssl://email-smtp.us-east-1.amazonaws.com','','Amazon SNS Host','',1,88,''),
	(107,'Amazon.sns_username','AKIAIFUYHWDOM7XTDV6A','','Amazon SNS Username','',1,89,''),
	(108,'Amazon.sns_password','AivaM89vZEq8/fj4cJd95spzr44UlN0uc9JYk3fXLZ3V','','Amazon SNS Password','',1,90,''),
	(109,'Amazon.sns_port','465','','Amazon SNS Port','',1,91,''),
	(136,'Qparc.authnet_test','1','','Authorize.net Login','',1,92,''),
	(137,'Qparc9.authnet_use_global','1','','Individual Location setting to use Authorize.net','',1,93,''),
	(138,'Qparc9.iparc_use_global','1','','Individual Location setting to use iParc Integration','',1,94,''),
	(139,'Qparc9.reservations_use_global','1','','Individual Location setting to use Reservations Settings','',1,95,''),
	(140,'Qparc9.email_use_global','1','','Individual Location setting to use Email Settings','',1,96,''),
	(141,'Qparc9.authnet_transaction_key','','','Authorize.net Login for location 9','',1,97,''),
	(142,'Qparc9.authnet_login','','','Authorize.net Transaction Key for location 9','',1,98,''),
	(143,'Qparc9.reservations_show_promos','','','Show Promotions on reservation for location 9','',1,99,''),
	(144,'Qparc9.reservations_show_payment','','','Show Payment option on reservation for location 9','',1,100,''),
	(145,'Qparc9.iparc_enabled','0','','Enable iParc for location 9','',1,101,''),
	(146,'Qparc9.iparc_validation','','','iParc Store Validation Number for location 9','',1,102,''),
	(147,'Qparc9.email_enabled','0','','Enable Email Reporting for location 9','',1,103,''),
	(148,'Qparc9.email_frequency','','','Email Frequency for location 9','',1,104,''),
	(149,'Qparc9.email_addresses','','','Email Addresses for location 9','',1,105,'');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table taxonomies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `taxonomies`;

CREATE TABLE `taxonomies` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(20) DEFAULT NULL,
  `term_id` int(10) NOT NULL,
  `vocabulary_id` int(10) NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `taxonomies` WRITE;
/*!40000 ALTER TABLE `taxonomies` DISABLE KEYS */;

INSERT INTO `taxonomies` (`id`, `parent_id`, `term_id`, `vocabulary_id`, `lft`, `rght`)
VALUES
	(1,NULL,1,1,1,2),
	(2,NULL,2,1,3,4),
	(3,NULL,3,2,1,2);

/*!40000 ALTER TABLE `taxonomies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table terms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `terms`;

CREATE TABLE `terms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;

INSERT INTO `terms` (`id`, `title`, `slug`, `description`, `updated`, `created`)
VALUES
	(1,'Uncategorized','uncategorized','','2009-07-22 03:38:43','2009-07-22 03:34:56'),
	(2,'Announcements','announcements','','2010-05-16 23:57:06','2009-07-22 03:45:37'),
	(3,'mytag','mytag','','2009-08-26 14:42:43','2009-08-26 14:42:43');

/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_reservations_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transId` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `format_show_author` tinyint(1) NOT NULL DEFAULT '1',
  `format_show_date` tinyint(1) NOT NULL DEFAULT '1',
  `comment_status` int(1) NOT NULL DEFAULT '1',
  `comment_approve` tinyint(1) NOT NULL DEFAULT '1',
  `comment_spam_protection` tinyint(1) NOT NULL DEFAULT '0',
  `comment_captcha` tinyint(1) NOT NULL DEFAULT '0',
  `params` text COLLATE utf8_unicode_ci,
  `plugin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;

INSERT INTO `types` (`id`, `title`, `alias`, `description`, `format_show_author`, `format_show_date`, `comment_status`, `comment_approve`, `comment_spam_protection`, `comment_captcha`, `params`, `plugin`, `updated`, `created`)
VALUES
	(1,'Page','page','A page is a simple method for creating and displaying information that rarely changes, such as an \"About us\" section of a website. By default, a page entry does not allow visitor comments.',0,0,0,1,0,0,'','','2012-12-07 18:36:50','2009-09-02 18:06:27'),
	(2,'Blog','blog','A blog entry is a single post to an online journal, or blog.',1,1,1,1,0,0,'','','2012-12-07 18:36:11','2009-09-02 18:20:44'),
	(4,'Node','node','Default content type.',1,1,1,1,0,0,'','','2012-12-07 18:36:34','2009-09-05 23:51:56');

/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table types_vocabularies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `types_vocabularies`;

CREATE TABLE `types_vocabularies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type_id` int(10) NOT NULL,
  `vocabulary_id` int(10) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `types_vocabularies` WRITE;
/*!40000 ALTER TABLE `types_vocabularies` DISABLE KEYS */;

INSERT INTO `types_vocabularies` (`id`, `type_id`, `vocabulary_id`, `weight`)
VALUES
	(33,2,2,NULL),
	(32,2,1,NULL),
	(35,4,2,NULL),
	(34,4,1,NULL);

/*!40000 ALTER TABLE `types_vocabularies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_profiles`;

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `vehicle` varchar(20) NOT NULL,
  `plate` varchar(40) NOT NULL,
  `cim` int(50) DEFAULT NULL,
  `paymentProfileId` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;

INSERT INTO `user_profiles` (`id`, `user_id`, `phone`, `vehicle`, `plate`, `cim`, `paymentProfileId`, `created`, `modified`)
VALUES
	(34,1,'8608182360','','',8235834,NULL,'2012-06-29 00:13:21','2012-06-29 20:24:53'),
	(35,2,'','','',NULL,NULL,'2012-07-01 04:56:36','2012-07-01 04:56:36');

/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `name`, `email`, `website`, `activation_key`, `image`, `bio`, `timezone`, `status`, `updated`, `created`)
VALUES
	(1,1,'admin','04fdbd54a69566dcad1d369b92f47b245ff1eb93','Code Creator','michael@codecreator.com','http://codecreator.com','571066c56a0a61c1d36c7072e9c834be',NULL,NULL,'0',1,'2012-06-29 20:24:53','2012-06-09 18:56:40'),
	(2,2,'demonstration','3ef8626f68e161b17aad417533065238f2ca3ae9','The Amazing qParc™','info@qparc.net','http://www.qparc.net','97aa2e48125345ea73b8e9381e4323bc',NULL,NULL,'0',1,'2012-07-01 04:56:36','2012-07-01 04:42:24'),
	(5,1,'jmsprowles','924e7890e8f1c00edfa11a69f4f7fcc6ab744881','Jer','jmsprowles@codecreator.com','www.codecreator.com','02dfd73a087c2b734bd2ce0493cf55de',NULL,NULL,'0',1,'2012-12-06 01:08:08','2012-12-06 01:08:08'),
	(6,1,'ccpAdmin','6458af4541c4a31357993ec4ae4e289b3ca036b1','ccpAdmin','youremail@youremail.com','','90e7515ee62f73f4fcb08e0e568fd034',NULL,NULL,'0',1,'2012-12-11 20:40:29','2012-12-11 20:29:34');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vocabularies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vocabularies`;

CREATE TABLE `vocabularies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `tags` tinyint(1) NOT NULL DEFAULT '0',
  `plugin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vocabulary_alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `vocabularies` WRITE;
/*!40000 ALTER TABLE `vocabularies` DISABLE KEYS */;

INSERT INTO `vocabularies` (`id`, `title`, `alias`, `description`, `required`, `multiple`, `tags`, `plugin`, `weight`, `updated`, `created`)
VALUES
	(1,'Categories','categories','',0,1,0,'',1,'2010-05-17 20:03:11','2009-07-22 02:16:21'),
	(2,'Tags','tags','',0,1,0,'',2,'2010-05-17 20:03:11','2009-07-22 02:16:34');

/*!40000 ALTER TABLE `vocabularies` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
