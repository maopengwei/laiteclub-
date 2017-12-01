-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: tuanyuan
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ot_admin`
--

DROP TABLE IF EXISTS `ot_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(30) NOT NULL COMMENT '管理员名',
  `admin_pass` varchar(255) NOT NULL DEFAULT '',
  `group` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理员组',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加管理员时间',
  `salt` varchar(4) DEFAULT NULL COMMENT '密码的盐',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2039 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_admin`
--

LOCK TABLES `ot_admin` WRITE;
/*!40000 ALTER TABLE `ot_admin` DISABLE KEYS */;
INSERT INTO `ot_admin` VALUES (2038,'demo','58a97091929456b49d551a6c9b3ee27c',2,1510276627,'SWc5'),(1,'admin','12a4cd72d33fc80cf50ebae560bf14d7',2,0,'kkkk');
/*!40000 ALTER TABLE `ot_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_auth_group`
--

DROP TABLE IF EXISTS `ot_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'auth_group表 权限组',
  `title` char(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认0',
  `rules` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_auth_group`
--

LOCK TABLES `ot_auth_group` WRITE;
/*!40000 ALTER TABLE `ot_auth_group` DISABLE KEYS */;
INSERT INTO `ot_auth_group` VALUES (1,'超级管理员',1,'7,5,6,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,52,53,54,55,56,57,58,59,60,61,62,63'),(2,'普通管理员',1,'10,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63');
/*!40000 ALTER TABLE `ot_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_auth_rule`
--

DROP TABLE IF EXISTS `ot_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_auth_rule` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则表',
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_auth_rule`
--

LOCK TABLES `ot_auth_rule` WRITE;
/*!40000 ALTER TABLE `ot_auth_rule` DISABLE KEYS */;
INSERT INTO `ot_auth_rule` VALUES (7,'adminadmin_xgcl','管理员修改提交',5),(5,'admin','admin',NULL),(6,'adminadmin','管理员列表',5),(8,'adminadmindel','管理员删除',5),(9,'adminzjmc','添加用户',5),(10,'adminzjmcc','添加用户提交',5),(11,'adminrule','规则列表',5),(12,'adminrule_add','规则添加修改',5),(13,'adminrule_del','规则删除',5),(14,'adminauth_group','权限组列表',5),(15,'adminauth_group_add','权限组添加修改',5),(16,'adminauth_group_del','权限组删除',5),(17,'adminauth_group_edit','授权',5),(18,'adminauth_group_editcl','授权提交',5),(19,'deal','deal',NULL),(20,'deallist_pay','买入单子列表',19),(21,'dealpaycl','添加充值单',19),(22,'deallist_receive','提现单子列表',19),(23,'dealreceivecl','添加提现单',19),(24,'ident','ident',NULL),(25,'identidex','订单列表',24),(26,'identppdd_give_up','放弃订单',24),(27,'identppdd_del','删除订单',24),(28,'identno_pay','放入未收款',24),(29,'identno_pay_list','未打款列表',24),(30,'identno_receive','放入未收款列表',24),(31,'identno_receive_list','未收款列表',24),(32,'identdim','放入模糊',24),(33,'identdim_list','模糊列表',24),(34,'identjywc','加入交易完成',24),(35,'identjywc_list','交易完成列表',24),(36,'index','ident',NULL),(37,'indexshouye','后台首页',36),(38,'indexcounts','信息统计',36),(39,'match','match',NULL),(40,'matchindex','匹配控制器',39),(41,'matchmatchcl','匹配提交',39),(42,'matchmatch_system','系统账号匹配',39),(43,'order','order',NULL),(44,'orderlist_tgbz','提供列表',43),(45,'orderlist_tgbz_sd','提供匹配',43),(46,'orderlist_jsbz','接受列表',43),(47,'orderlist_jsbz_sd','接受匹配',43),(48,'ordertgbz_list_cf','提供拆分',43),(49,'orderjsbz_list_cf','接受拆分',43),(50,'ordertgbz_list_cf_cl','提供拆分提交',43),(51,'orderjsbz_list_cf_cl','接受拆分提交',43),(52,'pdb','pdb',NULL),(53,'pdbindex','排单币列表',52),(54,'pdbpdbcl','排单币增加减少',52),(55,'user','user',NULL),(56,'useruserlist','用户列表',55),(57,'useruser_xg','用户信息',55),(58,'userusercl','用户信息提交',55),(59,'useruser_del','用户删除',55),(60,'useruser_direct','用户直推',55),(61,'indexmain','主页',36),(62,'indextop','右边栏',36),(63,'indexleft','左边栏',36);
/*!40000 ALTER TABLE `ot_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_config`
--

DROP TABLE IF EXISTS `ot_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_config` (
  `id` tinyint(1) NOT NULL,
  `no_payment` decimal(4,2) NOT NULL COMMENT '没有打款冻结时间',
  `no_receive` decimal(4,2) NOT NULL COMMENT '没有收款冻结时间',
  `no_order` decimal(4,2) NOT NULL COMMENT '没有排单时间冻结',
  `forbid_order` enum('2','1') NOT NULL DEFAULT '1' COMMENT '1可以2禁止',
  `signnum_day` int(11) NOT NULL COMMENT '每日注册人数最大',
  `paynum_day` int(11) NOT NULL COMMENT '每日充值金额最大',
  `info_magnify` decimal(5,2) NOT NULL,
  `multiple` decimal(5,2) DEFAULT NULL COMMENT '放大'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_config`
--

LOCK TABLES `ot_config` WRITE;
/*!40000 ALTER TABLE `ot_config` DISABLE KEYS */;
INSERT INTO `ot_config` VALUES (1,12.00,6.00,48.00,'1',100,50000,1.20,1.20);
/*!40000 ALTER TABLE `ot_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_details`
--

DROP TABLE IF EXISTS `ot_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户详情表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_details`
--

LOCK TABLES `ot_details` WRITE;
/*!40000 ALTER TABLE `ot_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `ot_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_info`
--

DROP TABLE IF EXISTS `ot_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_info` (
  `IF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IF_time` datetime NOT NULL,
  `IF_revTime` datetime DEFAULT NULL,
  `IF_type` varchar(50) DEFAULT NULL,
  `IF_type1ID` int(11) DEFAULT '0',
  `IF_type2ID` int(11) DEFAULT '0',
  `IF_theme` varchar(250) DEFAULT NULL,
  `IF_webImg` varchar(255) DEFAULT '',
  `IF_content` longtext,
  `IF_rank` int(11) DEFAULT '0',
  `IF_readNum` int(11) DEFAULT '0',
  `IF_isIndex` smallint(1) DEFAULT '0',
  `IF_seodesc` longtext,
  `IF_seokeyword` longtext,
  `zt` int(8) NOT NULL DEFAULT '0',
  `IF_jianjie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IF_ID`),
  KEY `IF_ID` (`IF_ID`),
  KEY `IF_menu1` (`IF_type1ID`),
  KEY `IF_readNum` (`IF_readNum`),
  KEY `IF_type1ID` (`IF_type`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_info`
--

LOCK TABLES `ot_info` WRITE;
/*!40000 ALTER TABLE `ot_info` DISABLE KEYS */;
INSERT INTO `ot_info` VALUES (124,'2017-10-09 08:55:19',NULL,'news',0,0,'adfaf',NULL,'asdfadddd',0,0,0,NULL,NULL,0,'fasd'),(125,'2017-10-09 10:59:28',NULL,'news',0,0,'1111',NULL,'111111111',0,0,0,NULL,NULL,0,'1111'),(126,'2017-10-09 11:33:26',NULL,'news',0,0,'新闻公告122',NULL,'',0,0,0,NULL,NULL,0,'2221'),(127,'2017-10-09 11:36:39',NULL,'news',0,0,'asdfas',NULL,'七集政论专题片《不忘初心继续前进》第四集《凝心铸魂》10月8日20点在中央电视台综合频道首播。文化是一个民族的精神家园，是一个民族区别于其他民族独特的精神标识。中华民族生生不息，饱受挫折又不断浴火重生，都离不开中华文化的有力支撑。&amp;nbsp;2014年5月4日，习近平总书记在北京大学发表讲话时说：“要实现中华民族伟大复兴，它是中华文化复兴、自信这样一种志向。”为国家立心，为时代铸魂，这是一项久久为功、驰而不息的铸魂工程。社会主义核心价值观凝聚着社会共识的最大公约数，是中华民族赖以维系的精神纽带。',0,0,0,NULL,NULL,0,'afsdfasdfasfd'),(128,'2017-10-09 13:26:12',NULL,'news',0,0,'标题1','','2016年12月12日，习近平总书记在会见第一届全国文明家庭代表时动情地说：“你们以自己的模范行为，弘扬和践行社会主义核心价值观，温暖了人心，诠释了文明，传播了正能量，都是好样的！”社会主义核心价值观凝练着中华文化中革命文化、优秀传统文化和社会主义先进文化的精髓。五年来，习近平总书记的足迹几乎遍布革命老区。他不断强调继承和发扬革命优良传统，并将革命纪念日上升到国家层面，不忘中华民族近现代史中的苦难卓绝和牺牲奋斗。中华文化蕴育了中华民族宝贵的精神品格。自强不息、厚德载物的思想支撑着中华民族生生不息、薪火相传。2014年9月24日，习近平总书记在纪念孔子诞辰2565周年国际学术研讨会上这样表述：“世界上一些有识之士认为，包括儒家思想在内的中国优秀传统文化中，蕴藏着解决当代人类面临的难题的重要启示。”',0,0,0,NULL,NULL,0,'简介111'),(129,'2017-10-09 13:36:12',NULL,'news',0,0,'标题1123','Upload/2017-10-09/59db0acc3d4d5.jpg','',0,0,0,NULL,NULL,0,'简介123213'),(130,'2017-10-09 13:49:36',NULL,'news',0,0,'标题234',NULL,'\r\n	2016年12月12日，\r\n\r\n\r\n	习近平总书记在会见第一届全国文明家庭代表时动情地说：\r\n\r\n\r\n	“你们以自己的模范行为，弘扬和践行社会主义核心价值观，温暖了人心，诠释了文明，传播了正能量，都是好样的！”\r\n\r\n\r\n	社会主义核心价值观凝练着中华文化中革命文化、\r\n\r\n\r\n	优秀传统文化和社会主义先进文化的精髓。\r\n\r\n\r\n	五年来，习近平总书记的足迹几乎遍布革命老区。\r\n\r\n\r\n	他不断强调继承和发扬革命优良传统，并将革命纪念日上升到国家层面，不忘中华民族近现代史中的苦难卓绝和牺牲奋斗。\r\n\r\n\r\n	中华文化蕴育了中华民族宝贵的精神品格。\r\n\r\n\r\n	自强不息、厚德载物的思想支撑着中华民族生生不息、薪火相传。\r\n\r\n\r\n	2014年9月24日，习近平总书记在纪念孔子诞辰2565周年国际学术研讨会上这样表述：“世界上一些有识之士认为，包括儒家思想在内的中国优秀传统文化中，蕴藏着解决当代人类面临的难题的重要启示。”\r\n\r\n\r\n	 \r\n\r\n\r\n\r\n	\r\n',0,0,0,NULL,NULL,0,'简介234'),(131,'2017-10-09 13:55:11',NULL,'news',0,0,'标题3',NULL,'<p style=\"font-size:16px;font-family:Arial, 宋体;color:#333333;background-color:#FFFFFF;\">\r\n	2016年12月12日，习近平总书记在会见第一届全国文明家庭代表时动情地说：“你们以自己的模范行为，弘扬和践行社会主义核心价值观，温暖了人心，诠释了文明，传播了正能量，都是好样的！”\r\n</p>\r\n<p style=\"font-size:16px;font-family:Arial, 宋体;color:#333333;background-color:#FFFFFF;\">\r\n	社会主义核心价值观凝练着中华文化中革命文化、优秀传统文化和社会主义先进文化的精髓。\r\n</p>\r\n<p style=\"font-size:16px;font-family:Arial, 宋体;color:#333333;background-color:#FFFFFF;\">\r\n	五年来，习近平总书记的足迹几乎遍布革命老区。他不断强调继承和发扬革命优良传统，并将革命纪念日上升到国家层面，不忘中华民族近现代史中的苦难卓绝和牺牲奋斗。\r\n</p>\r\n<p style=\"font-size:16px;font-family:Arial, 宋体;color:#333333;background-color:#FFFFFF;\">\r\n	中华文化蕴育了中华民族宝贵的精神品格。自强不息、厚德载物的思想支撑着中华民族生生不息、薪火相传。\r\n</p>\r\n<p style=\"font-size:16px;font-family:Arial, 宋体;color:#333333;background-color:#FFFFFF;\">\r\n	2014年9月24日，习近平总书记在纪念孔子诞辰2565周年国际学术研讨会上这样表述：“世界上一些有识之士认为，包括儒家思想在内的中国优秀传统文化中，蕴藏着解决当代人类面临的难题的重要启示。”\r\n</p>\r\n<p style=\"font-size:16px;font-family:Arial, 宋体;color:#333333;background-color:#FFFFFF;text-align:center;\">\r\n	<img src=\"http://p1.img.cctvpic.com/cportal/img/photoAlbum/page/performance/img/2017/10/8/1507460751855_823_514x286.png\" /> \r\n</p>',0,0,0,NULL,NULL,0,'12');
/*!40000 ALTER TABLE `ot_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_jsbz`
--

DROP TABLE IF EXISTS `ot_jsbz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_jsbz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receive_number` varchar(15) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `jb` decimal(15,0) NOT NULL DEFAULT '0',
  `date` int(10) DEFAULT NULL COMMENT '生成时间',
  `zt` int(8) NOT NULL DEFAULT '0' COMMENT '默认0 匹配为1 ',
  `type` int(11) DEFAULT NULL COMMENT '0系统赠送1静态提现2动态提现3奖励提现',
  `status` tinyint(1) DEFAULT '0' COMMENT '1被拆分默认0没有被拆分',
  `delete` tinyint(1) DEFAULT '0' COMMENT '默认0 1为已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1264 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_jsbz`
--

LOCK TABLES `ot_jsbz` WRITE;
/*!40000 ALTER TABLE `ot_jsbz` DISABLE KEYS */;
INSERT INTO `ot_jsbz` VALUES (1263,'bJO2SYuzf9',35,1000,1511399440,1,NULL,0,0);
/*!40000 ALTER TABLE `ot_jsbz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_message`
--

DROP TABLE IF EXISTS `ot_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言表',
  `add_time` int(10) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `phone` varchar(12) DEFAULT NULL COMMENT '手机号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_message`
--

LOCK TABLES `ot_message` WRITE;
/*!40000 ALTER TABLE `ot_message` DISABLE KEYS */;
INSERT INTO `ot_message` VALUES (1,1510040395,'35','123','18739912355'),(2,1510040511,'ceshi2','12312','18739912355'),(3,1510040533,'ceshi2','1234','18739912355');
/*!40000 ALTER TABLE `ot_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_news`
--

DROP TABLE IF EXISTS `ot_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '新闻表',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `add_time` int(10) DEFAULT NULL COMMENT '添加时间',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_news`
--

LOCK TABLES `ot_news` WRITE;
/*!40000 ALTER TABLE `ot_news` DISABLE KEYS */;
INSERT INTO `ot_news` VALUES (1,'dddddd',1509522330,NULL),(2,'dddddd',1509522604,NULL),(3,'dddddd',1509522681,'<p style=\"text-align: center;\">fdasfas<br/></p><p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20171101/1509521883.jpg\" title=\"1509521883.jpg\" alt=\"3efe7262d88c3e74cfe0c0142d140537.jpg\"/>u</p>');
/*!40000 ALTER TABLE `ot_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_ppdd`
--

DROP TABLE IF EXISTS `ot_ppdd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_ppdd` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单表id字段',
  `pid` int(11) DEFAULT NULL COMMENT '充值单id',
  `gid` int(11) DEFAULT NULL COMMENT '提现单id',
  `p_id` varchar(60) DEFAULT NULL COMMENT '充值单pay_number',
  `g_id` varchar(60) DEFAULT NULL COMMENT '提现单receive_number',
  `p_user` varchar(60) DEFAULT NULL COMMENT '充值人uid',
  `g_user` varchar(60) DEFAULT NULL COMMENT '提现人uid',
  `jb` decimal(15,2) NOT NULL COMMENT '订单金额',
  `add_time` int(10) DEFAULT NULL COMMENT '匹配时间',
  `pay_time` int(10) DEFAULT NULL COMMENT '打款时间',
  `receive_time` int(10) DEFAULT NULL COMMENT '接受时间',
  `end_time` int(10) DEFAULT NULL COMMENT '第一次提款时间',
  `last_time` int(10) DEFAULT NULL COMMENT '第二次提款时间',
  `zt` int(2) NOT NULL DEFAULT '1' COMMENT '默认1已匹配 2已打款 3已收款 4交易完成',
  `ts_zt` int(1) DEFAULT '0' COMMENT '默认0  投诉1',
  `cold` tinyint(1) unsigned DEFAULT '0' COMMENT '默认0正常 1不打款 2不收款   ',
  `cold_time` int(10) DEFAULT NULL COMMENT '冻结时间',
  `number` varchar(65) DEFAULT NULL COMMENT '订单号',
  `delete` tinyint(1) DEFAULT '0' COMMENT '默认0正常 1为已删除',
  `pic` varchar(255) DEFAULT NULL COMMENT '打款截图',
  `message` text COMMENT '留言',
  `status` int(2) DEFAULT '0' COMMENT '默认0  1给过一次收益了',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=981 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_ppdd`
--

LOCK TABLES `ot_ppdd` WRITE;
/*!40000 ALTER TABLE `ot_ppdd` DISABLE KEYS */;
INSERT INTO `ot_ppdd` VALUES (980,1727,1263,'NKriRw0Ggh','bJO2SYuzf9','ceshi','ceshi2',1000.00,1511399448,NULL,NULL,NULL,NULL,1,0,1,1511422348,'7gg0CzIv6jf1QtW',0,NULL,NULL,0);
/*!40000 ALTER TABLE `ot_ppdd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_record_jhm`
--

DROP TABLE IF EXISTS `ot_record_jhm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_record_jhm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '激活码记录表',
  `uid` int(11) DEFAULT NULL COMMENT '账户id1 发起方',
  `uid_two` int(11) DEFAULT NULL COMMENT '账户id2 接受方',
  `num` int(11) DEFAULT NULL COMMENT '数量',
  `add_time` int(10) DEFAULT NULL COMMENT '时间',
  `type` tinyint(1) DEFAULT '0' COMMENT '默认0激活账号   1转让  2系统转让',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_record_jhm`
--

LOCK TABLES `ot_record_jhm` WRITE;
/*!40000 ALTER TABLE `ot_record_jhm` DISABLE KEYS */;
INSERT INTO `ot_record_jhm` VALUES (25,35,36,1,1510042259,1),(24,35,36,1,1510042249,1),(23,35,36,1,1510042148,1),(22,35,38,1,1510036617,0),(21,35,37,1,1510036606,0),(20,35,36,1,1509796036,0),(19,35,36,1,1509795826,1),(18,35,36,1,1509795813,1),(17,35,36,1,1509795784,1);
/*!40000 ALTER TABLE `ot_record_jhm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_record_pay`
--

DROP TABLE IF EXISTS `ot_record_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_record_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_number` varchar(65) NOT NULL COMMENT '唯一单号',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `jb` int(11) NOT NULL COMMENT '金额',
  `date` int(10) NOT NULL COMMENT '时间 ',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型 默认 0会员自己排 1赠送 ',
  `redelivery` int(11) DEFAULT '0' COMMENT '复投判断',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_record_pay`
--

LOCK TABLES `ot_record_pay` WRITE;
/*!40000 ALTER TABLE `ot_record_pay` DISABLE KEYS */;
INSERT INTO `ot_record_pay` VALUES (85,'NKriRw0Ggh',36,1000,1511399431,1,0);
/*!40000 ALTER TABLE `ot_record_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_record_pdb`
--

DROP TABLE IF EXISTS `ot_record_pdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_record_pdb` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '排单币记录表',
  `uid` int(11) NOT NULL COMMENT '发起方用户id',
  `uid_two` int(11) DEFAULT NULL COMMENT '接受用户ID',
  `num` int(5) DEFAULT NULL COMMENT '数量',
  `add_time` int(10) DEFAULT NULL COMMENT '时间',
  `type` tinyint(1) DEFAULT '0' COMMENT '默认0消耗 1转让 2系统赠送',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_record_pdb`
--

LOCK TABLES `ot_record_pdb` WRITE;
/*!40000 ALTER TABLE `ot_record_pdb` DISABLE KEYS */;
INSERT INTO `ot_record_pdb` VALUES (209,35,36,2,1509592809,1),(208,0,35,11,1509527429,2),(207,0,8,5,1509089304,2),(206,0,8,2,1509089287,2),(224,35,NULL,1,1510114230,0),(223,35,36,1,1510043327,1),(222,36,NULL,1,1509951310,0),(221,35,NULL,1,1509951145,0),(220,35,NULL,1,1509950334,0),(219,35,36,1,1509795924,1),(218,45,46,1,1509780453,1),(217,46,NULL,1,1509776267,0),(216,45,NULL,1,1509774743,0),(215,0,43,1000,1509771786,2),(214,0,35,1000,1509769959,2),(213,35,NULL,1,1509767554,0),(212,36,NULL,1,1509767270,0),(211,35,36,1,1509706684,1),(210,35,NULL,1,1509606499,0);
/*!40000 ALTER TABLE `ot_record_pdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_record_receive`
--

DROP TABLE IF EXISTS `ot_record_receive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_record_receive` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `receive_number` varchar(65) NOT NULL COMMENT '接收单单号',
  `jb` int(11) NOT NULL COMMENT '金额',
  `date` int(10) NOT NULL COMMENT '记录时间',
  `zt` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认0  ',
  `type` tinyint(1) DEFAULT '0' COMMENT '默认0后台添加 1静态提现 2动态提现 3奖励提现',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_record_receive`
--

LOCK TABLES `ot_record_receive` WRITE;
/*!40000 ALTER TABLE `ot_record_receive` DISABLE KEYS */;
INSERT INTO `ot_record_receive` VALUES (85,35,'bJO2SYuzf9',1000,1511399440,0,0);
/*!40000 ALTER TABLE `ot_record_receive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_system`
--

DROP TABLE IF EXISTS `ot_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_system` (
  `SYS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SYS_theme` varchar(100) DEFAULT NULL,
  `SYS_address` varchar(200) DEFAULT NULL,
  `SYS_postCode` varchar(50) DEFAULT NULL,
  `SYS_contact` varchar(50) DEFAULT '',
  `SYS_mobile` varchar(50) DEFAULT '',
  `SYS_mail` varchar(80) DEFAULT NULL,
  `SYS_phone` varchar(50) DEFAULT NULL,
  `SYS_hotPhone` varchar(50) DEFAULT NULL,
  `SYS_fax` varchar(50) DEFAULT NULL,
  `SYS_qq` varchar(30) DEFAULT NULL,
  `SYS_banquan` varchar(100) DEFAULT NULL,
  `SYS_seoTitle` varchar(300) DEFAULT '',
  `SYS_seoWord` text,
  `SYS_seoDesc` text,
  `SPS_smtpHost` varchar(80) DEFAULT NULL,
  `SPS_sendMail` varchar(80) DEFAULT NULL,
  `SPS_sendPwd` varchar(80) DEFAULT NULL,
  `SPS_giveMail` varchar(80) DEFAULT NULL,
  `a_ztj` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '直推荐奖',
  `a_ztj2` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '间推奖',
  `a_ztj3` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '间间推奖',
  `a_bdj` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '报单奖',
  `a_ld8` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_ld9` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_ld10` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_kd_zsb` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '钻石币开单数量',
  `a_sxf` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '交易大厅手续费',
  `a_btbjg` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '比特币价格',
  `a_fxzl` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '发行总量',
  `a_fuhuo` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '复活费用',
  `a_mrfh_cj` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `a_ybfxsl` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '銀幣發行數量',
  `a_zsbfxsl` decimal(15,4) NOT NULL,
  `a_ybhuilv` decimal(15,6) NOT NULL,
  `a_zsbhuilv` decimal(15,6) NOT NULL,
  `a_bdzxds` decimal(15,4) NOT NULL,
  `zt` int(8) NOT NULL DEFAULT '0',
  `toggleshop` varchar(15) DEFAULT '0',
  PRIMARY KEY (`SYS_ID`),
  KEY `SYS_postCode` (`SYS_postCode`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_system`
--

LOCK TABLES `ot_system` WRITE;
/*!40000 ALTER TABLE `ot_system` DISABLE KEYS */;
INSERT INTO `ot_system` VALUES (1,NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.000000,0.000000,0.0000,1,'0');
/*!40000 ALTER TABLE `ot_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_tgbz`
--

DROP TABLE IF EXISTS `ot_tgbz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_tgbz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '会员id',
  `pay_number` varchar(65) DEFAULT NULL,
  `jb` int(15) NOT NULL COMMENT '排单金额',
  `zt` int(1) NOT NULL DEFAULT '0' COMMENT '0未匹配1已匹配',
  `date` int(10) DEFAULT NULL COMMENT '排单时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '1拆分了 默认0',
  `delete` int(2) DEFAULT '0' COMMENT '默认0 正常状态 1为已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1728 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_tgbz`
--

LOCK TABLES `ot_tgbz` WRITE;
/*!40000 ALTER TABLE `ot_tgbz` DISABLE KEYS */;
INSERT INTO `ot_tgbz` VALUES (1727,36,'NKriRw0Ggh',1000,1,1511399431,0,0);
/*!40000 ALTER TABLE `ot_tgbz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_user`
--

DROP TABLE IF EXISTS `ot_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `user` varchar(60) NOT NULL DEFAULT '' COMMENT '用户编号',
  `pid` int(11) DEFAULT NULL COMMENT '父账号id',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `theme` varchar(60) DEFAULT NULL COMMENT '真实姓名',
  `user_pass` varchar(255) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `second_pass` varchar(255) DEFAULT NULL COMMENT '二级密码',
  `add_time` int(10) DEFAULT NULL COMMENT '注册时间',
  `wechat` varchar(255) DEFAULT NULL COMMENT '微信号',
  `bank_address` varchar(255) DEFAULT NULL COMMENT '开户行地址',
  `bank_name` varchar(255) DEFAULT NULL COMMENT '银行名称',
  `card_number` varchar(255) DEFAULT NULL COMMENT '银行卡号',
  `alipay` varchar(255) DEFAULT NULL COMMENT '支付宝号',
  `status` smallint(1) DEFAULT '0' COMMENT '默认0未激活 1未审核 2正常 3不打款 4不收款 5封号',
  `cold_time` int(10) DEFAULT NULL COMMENT '冻结时间',
  `address` varchar(255) DEFAULT NULL COMMENT '收货地址',
  `static_wallet` decimal(15,2) DEFAULT '0.00' COMMENT '静态钱包',
  `dynamic_wallet` decimal(15,2) DEFAULT '0.00' COMMENT '动态钱包',
  `awart_wallet` decimal(15,2) DEFAULT '0.00' COMMENT '奖励钱包',
  `shop_wallet` decimal(15,2) DEFAULT '0.00' COMMENT '商城积分',
  `pdb` int(50) DEFAULT '0' COMMENT '排单币',
  `jhm` int(11) DEFAULT '0' COMMENT '激活码',
  `system` int(1) DEFAULT '0' COMMENT '默认0 系统账户1',
  `vaild` int(1) DEFAULT '0' COMMENT '默认0 1为有效会员',
  `vaild_count` int(5) DEFAULT '0' COMMENT '有效下家',
  `tgbz_performance` decimal(10,2) DEFAULT '0.00' COMMENT '总排单',
  `jsbz_performance` decimal(10,2) DEFAULT '0.00' COMMENT '总提现',
  `lx_performance` decimal(10,2) DEFAULT '0.00' COMMENT '总利息',
  `whether` int(11) DEFAULT '0' COMMENT '默认0当前没有排单，1排单中',
  `salt` varchar(4) NOT NULL DEFAULT '' COMMENT '密码盐',
  `path` text COMMENT '全路径',
  `level` int(1) DEFAULT NULL COMMENT '默认1 普通会员 2超级会员',
  `value` int(1) DEFAULT '0' COMMENT '诚信值',
  `six` int(11) DEFAULT '0' COMMENT '默认0 6轮休眠1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_user`
--

LOCK TABLES `ot_user` WRITE;
/*!40000 ALTER TABLE `ot_user` DISABLE KEYS */;
INSERT INTO `ot_user` VALUES (35,'ceshi2',NULL,'18739912538','买买买','8b7c70e09b04fe0f8711caf078253134','32ffa83e17810de00c5c947ed5970ab2',1509426638,'df','','fdas','1111111111111111','dfas',2,1511263061,'dfasd',17400.00,4374.40,2500.00,166.00,1000,987,1,1,12,12000.00,7500.00,0.00,0,'RN0F','0',0,15,1),(36,'ceshi',35,'15906451295','毛','32ffa83e17810de00c5c947ed5970ab2','32ffa83e17810de00c5c947ed5970ab2',1509443323,'dddd','毛毛毛','中国银行','55555555555555555','545456',3,1511422348,'1234',10.00,0.00,1650.00,0.00,3,6,0,1,0,6500.00,11500.00,0.00,0,'RN0F','0,35',0,11,0),(37,'ddddd',35,'15906451295','','fbf61b19d5f457d55917f686e866c077','fbf61b19d5f457d55917f686e866c077',1509945105,'','毛毛毛','','','',1,NULL,NULL,0.00,0.00,0.00,0.00,0,0,0,0,0,0.00,0.00,0.00,0,'yim7','0,35',NULL,0,0),(38,'cece',35,'12345678901','真实','57e16f2a5a446b429f627f375a06fcf8','57e16f2a5a446b429f627f375a06fcf8',1510025595,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0.00,0.00,0.00,0.00,0,0,0,0,0,0.00,0.00,0.00,0,'RnaY','0,35',NULL,0,0);
/*!40000 ALTER TABLE `ot_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_userget`
--

DROP TABLE IF EXISTS `ot_userget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_userget` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商城用户注册登录表',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `type` int(2) DEFAULT NULL COMMENT '1静态一期 \r\n2静态二期 \r\n3动态一代 \r\n4动态二代 \r\n5动态三代 \r\n6奖励钱包\r\n7商城一代\r\n8商城二代\r\n9商城三代',
  `jb` int(10) DEFAULT '0' COMMENT '当前帐户金币余额',
  `add_time` int(10) DEFAULT NULL COMMENT '结算时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5428 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_userget`
--

LOCK TABLES `ot_userget` WRITE;
/*!40000 ALTER TABLE `ot_userget` DISABLE KEYS */;
INSERT INTO `ot_userget` VALUES (5427,35,2,300,1510641818),(5426,35,1,300,1510555418),(5425,35,2,300,1510197805),(5424,35,2,600,1510197805),(5423,35,2,1200,1510197805),(5422,35,1,300,1510195514),(5421,35,1,600,1510195514),(5420,35,1,1200,1510195514);
/*!40000 ALTER TABLE `ot_userget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-01 17:22:16
