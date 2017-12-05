-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: laite
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
) ENGINE=MyISAM AUTO_INCREMENT=2040 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_admin`
--

LOCK TABLES `ot_admin` WRITE;
/*!40000 ALTER TABLE `ot_admin` DISABLE KEYS */;
INSERT INTO `ot_admin` VALUES (2038,'demo','58a97091929456b49d551a6c9b3ee27c',2,1510276627,'SWc5'),(2039,'admin','dc28531e314f200c5b68fa5bc80abc6e',1,1511600888,'ieUK');
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='权限组表';
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
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='权限规则表';
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
-- Table structure for table `ot_detail`
--

DROP TABLE IF EXISTS `ot_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `litecoin_wallet` decimal(10,3) DEFAULT '0.000' COMMENT '莱特币钱包',
  `aftercoin_wallet` decimal(10,3) DEFAULT '0.000' COMMENT '复消币钱包',
  `ico_wallet` decimal(10,3) DEFAULT '0.000' COMMENT 'ICO钱包',
  `stock_wallet` decimal(10,3) DEFAULT '0.000' COMMENT '股权钱包',
  `withdraw_address` varchar(255) DEFAULT NULL COMMENT '提现地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='用户详情表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_detail`
--

LOCK TABLES `ot_detail` WRITE;
/*!40000 ALTER TABLE `ot_detail` DISABLE KEYS */;
INSERT INTO `ot_detail` VALUES (13,16,247.412,2073.239,2.621,9999999.999,'1234567'),(12,15,62.712,1183.839,3.921,9999999.999,'0.000'),(11,14,89200.000,268.000,0.000,0.000,'0.000'),(14,17,1051.912,5.239,2.621,5002.621,'123456'),(15,18,0.000,0.000,0.000,9999999.999,'0.000'),(16,21,-200.000,0.000,0.000,0.000,NULL),(17,22,0.000,0.000,0.000,0.000,NULL),(18,23,52.912,5.239,2.621,2.621,''),(19,24,0.000,0.000,0.000,0.000,''),(20,25,0.000,0.000,0.000,0.000,NULL),(21,26,0.000,0.000,0.000,0.000,NULL);
/*!40000 ALTER TABLE `ot_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_litecoin_cash`
--

DROP TABLE IF EXISTS `ot_litecoin_cash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_litecoin_cash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直推注册领导奖',
  `uid` int(11) DEFAULT NULL COMMENT '账户id1 发起方',
  `num` decimal(10,3) DEFAULT NULL COMMENT '数量',
  `add_time` int(10) DEFAULT NULL COMMENT '时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '0未审核 1审核通过',
  `type` int(11) DEFAULT NULL COMMENT '0提现1充值',
  `user_info` varchar(255) DEFAULT NULL COMMENT '用户充值号信息',
  `gathering_address` varchar(255) DEFAULT NULL COMMENT '充值地址 提现地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='充值提现记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_litecoin_cash`
--

LOCK TABLES `ot_litecoin_cash` WRITE;
/*!40000 ALTER TABLE `ot_litecoin_cash` DISABLE KEYS */;
INSERT INTO `ot_litecoin_cash` VALUES (1,16,1.000,1509795784,0,NULL,NULL,NULL),(2,16,1.000,1509795784,0,NULL,NULL,NULL),(3,16,1.000,1509795784,0,NULL,NULL,NULL),(4,16,1.000,1509795784,0,NULL,NULL,NULL),(5,16,1.000,1509795784,0,NULL,NULL,NULL),(6,16,0.220,1511920475,0,1,'123','5555555555'),(7,16,1.000,1511925740,0,2,NULL,'1234567'),(8,16,1.000,1511925789,0,2,NULL,'1234567'),(9,16,1.000,1511925809,0,2,NULL,'1234567');
/*!40000 ALTER TABLE `ot_litecoin_cash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_litecoin_profit`
--

DROP TABLE IF EXISTS `ot_litecoin_profit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_litecoin_profit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直推注册领导奖',
  `uid` int(11) DEFAULT NULL COMMENT '账户id1 发起方',
  `uid_two` int(11) DEFAULT NULL COMMENT '账户id2 接受方',
  `num` decimal(10,3) DEFAULT NULL COMMENT '数量',
  `add_time` int(10) DEFAULT NULL COMMENT '时间',
  `type` tinyint(1) DEFAULT '0' COMMENT '0直推奖励 2注册奖励 2领导奖励',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COMMENT='直推 注册 领导奖励';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_litecoin_profit`
--

LOCK TABLES `ot_litecoin_profit` WRITE;
/*!40000 ALTER TABLE `ot_litecoin_profit` DISABLE KEYS */;
INSERT INTO `ot_litecoin_profit` VALUES (50,23,0,0.000,1511928061,2),(49,18,0,0.000,1511928061,2),(48,17,0,0.013,1511928061,2),(47,16,0,0.052,1511928061,2),(46,15,0,0.000,1511928061,2),(45,24,0,0.000,1511927966,2),(44,23,0,0.000,1511927966,2),(43,18,0,0.000,1511927966,2),(42,17,0,0.013,1511927966,2),(41,16,0,0.039,1511927966,2),(40,15,0,0.000,1511927966,2),(39,24,0,0.000,1511927780,2),(38,23,0,0.000,1511927780,2),(37,18,0,0.000,1511927780,2),(36,17,0,0.000,1511927780,2),(35,16,0,0.039,1511927780,2),(34,15,0,0.000,1511927780,2),(51,24,0,0.000,1511928061,2),(52,15,0,0.000,1511928071,2),(53,16,0,0.052,1511928071,2),(54,17,0,0.013,1511928071,2),(55,18,0,0.000,1511928071,2),(56,23,0,0.000,1511928071,2),(57,24,0,0.000,1511928071,2),(58,15,0,0.000,1511928081,2),(59,16,0,0.052,1511928081,2),(60,17,0,0.013,1511928081,2),(61,18,0,0.000,1511928081,2),(62,23,0,0.000,1511928081,2),(63,24,0,0.000,1511928081,2),(64,15,0,0.000,1511928134,2),(65,16,0,0.039,1511928134,2),(66,17,0,0.013,1511928134,2),(67,18,0,0.000,1511928134,2),(68,23,0,0.000,1511928134,2),(69,24,0,0.000,1511928134,2),(70,15,0,0.000,1511928144,2),(71,16,0,0.052,1511928144,2),(72,17,0,0.013,1511928144,2),(73,18,0,0.000,1511928144,2),(74,23,0,0.000,1511928144,2),(75,24,0,0.000,1511928144,2),(76,15,0,0.000,1511931055,2),(77,16,0,0.052,1511931055,2),(78,17,0,0.013,1511931055,2),(79,18,0,0.000,1511931055,2),(80,23,0,0.000,1511931055,2),(81,24,0,0.000,1511931055,2),(82,16,24,1.500,1511935327,0),(83,23,24,1.500,1511935327,1),(84,16,24,1.500,1511936272,0),(85,23,24,1.500,1511936272,1),(86,16,24,1.500,1511936417,0),(87,23,24,1.500,1511936417,1),(88,16,24,1.500,1511936545,0),(89,23,24,1.500,1511936545,1);
/*!40000 ALTER TABLE `ot_litecoin_profit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_litecoin_record`
--

DROP TABLE IF EXISTS `ot_litecoin_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_litecoin_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统赠送 激活 转让',
  `uid` int(11) DEFAULT NULL COMMENT '账户1',
  `uid_two` int(11) DEFAULT NULL COMMENT '账户2',
  `num` decimal(10,3) DEFAULT NULL COMMENT '数量',
  `type` int(11) DEFAULT NULL COMMENT '0系统赠送 1报单中心赠送 2激活',
  `add_time` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=188 DEFAULT CHARSET=utf8 COMMENT='系统赠送 激活 转让';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_litecoin_record`
--

LOCK TABLES `ot_litecoin_record` WRITE;
/*!40000 ALTER TABLE `ot_litecoin_record` DISABLE KEYS */;
INSERT INTO `ot_litecoin_record` VALUES (174,0,16,111.000,1,1511597492),(175,0,16,110.000,2,1511597492),(176,0,16,109.000,1,1511597492),(177,0,16,108.000,2,1511597492),(180,0,16,10.000,0,1511934834),(178,0,16,107.000,0,1511597492),(181,0,16,10.000,0,1511934847),(182,0,16,12.000,0,1511934887),(183,0,24,10.000,0,1511935306),(184,0,24,10.000,2,1511935327),(185,16,24,10.000,2,1511936272),(186,16,24,10.000,2,1511936417),(187,16,24,10.500,2,1511936545);
/*!40000 ALTER TABLE `ot_litecoin_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_litecoin_return`
--

DROP TABLE IF EXISTS `ot_litecoin_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_litecoin_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日返',
  `uid` int(11) DEFAULT NULL COMMENT '账户1',
  `litecoin` decimal(10,4) DEFAULT NULL COMMENT '莱特币',
  `after` decimal(10,4) DEFAULT NULL COMMENT '复消币',
  `ico` decimal(10,4) DEFAULT NULL COMMENT 'ICO',
  `stock` decimal(10,4) DEFAULT NULL COMMENT '股份',
  `add_time` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8 COMMENT='日返';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_litecoin_return`
--

LOCK TABLES `ot_litecoin_return` WRITE;
/*!40000 ALTER TABLE `ot_litecoin_return` DISABLE KEYS */;
INSERT INTO `ot_litecoin_return` VALUES (168,15,0.1040,0.0130,0.0065,0.0065,1511927594),(169,16,0.1040,0.0130,0.0065,0.0065,1511927594),(170,17,0.1040,0.0130,0.0065,0.0065,1511927594),(171,23,0.1040,0.0130,0.0065,0.0065,1511927594),(172,15,0.1040,0.0130,0.0065,0.0065,1511927615),(173,16,0.1040,0.0130,0.0065,0.0065,1511927615),(174,17,0.1040,0.0130,0.0065,0.0065,1511927615),(175,23,0.1040,0.0130,0.0065,0.0065,1511927615);
/*!40000 ALTER TABLE `ot_litecoin_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_message`
--

DROP TABLE IF EXISTS `ot_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言表',
  `add_time` int(10) DEFAULT NULL COMMENT '添加时间',
  `uid` int(11) DEFAULT NULL COMMENT '用户名',
  `content` text COMMENT '内容',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `img` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `reply` text COMMENT '回复内容',
  `reply_time` int(11) DEFAULT NULL COMMENT '回复时间',
  `status` int(11) DEFAULT '0' COMMENT '0未回复 1已回复',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='留言表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_message`
--

LOCK TABLES `ot_message` WRITE;
/*!40000 ALTER TABLE `ot_message` DISABLE KEYS */;
INSERT INTO `ot_message` VALUES (1,1512004357,16,'1234','','','<p>fsadf</p>',1512007746,1),(2,1512004381,16,'fdsafa','1234','/uploads/20171130\\91f4fd78672b4b56ecf814a3078e08d7.jpg','<p>ddddddd</p>',1512007725,1),(3,1512202474,16,'暗室逢灯发送','大师傅的','/uploads/20171202\\2b1d11dea8d2d6b784321751c22b7c3e.jpg',NULL,NULL,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻公告表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_news`
--

LOCK TABLES `ot_news` WRITE;
/*!40000 ALTER TABLE `ot_news` DISABLE KEYS */;
INSERT INTO `ot_news` VALUES (1,'dddddd',1509522330,'<p style=\"text-align:center\"><img src=\"/ueditor/php/upload/image/20171127/1511758939134142.jpg\" title=\"1511758939134142.jpg\" alt=\"3efe7262d88c3e74cfe0c0142d140537.jpg\"/></p><p style=\"text-align: center;\">想不想</p><p><br/></p>'),(2,'dddddd',1509522604,NULL),(3,'dddddd',1509522681,'');
/*!40000 ALTER TABLE `ot_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_system`
--

DROP TABLE IF EXISTS `ot_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统配置表',
  `zt` varchar(255) DEFAULT '1' COMMENT '默认0开启1关闭',
  `litecoin` int(11) DEFAULT NULL COMMENT '莱特币',
  `after` int(11) DEFAULT NULL COMMENT '复消币',
  `ico` int(11) DEFAULT NULL COMMENT 'ICO',
  `stock` int(11) DEFAULT NULL COMMENT '股权',
  `back` decimal(10,3) DEFAULT NULL COMMENT '日返总金额',
  `service_charge` int(11) DEFAULT NULL COMMENT '手续费',
  `gathering_address` varchar(255) DEFAULT NULL COMMENT '充值地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_system`
--

LOCK TABLES `ot_system` WRITE;
/*!40000 ALTER TABLE `ot_system` DISABLE KEYS */;
INSERT INTO `ot_system` VALUES (1,'1',80,10,5,5,0.130,10,'55555555');
/*!40000 ALTER TABLE `ot_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ot_user`
--

DROP TABLE IF EXISTS `ot_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ot_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) DEFAULT NULL COMMENT '父id',
  `zid` int(11) DEFAULT NULL COMMENT '注册人',
  `user` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `theme` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `identity` varchar(255) DEFAULT NULL COMMENT '身份证号',
  `status` int(11) DEFAULT '0' COMMENT '状态0未激活 1正常 2封号',
  `level` int(11) DEFAULT '0' COMMENT '等级',
  `user_pass` varchar(255) DEFAULT NULL COMMENT '登录密码',
  `second_pass` varchar(255) DEFAULT NULL COMMENT '二级密码',
  `path` text COMMENT '全路径',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `salt` varchar(5) DEFAULT NULL COMMENT '密码盐',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='用户基本信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ot_user`
--

LOCK TABLES `ot_user` WRITE;
/*!40000 ALTER TABLE `ot_user` DISABLE KEYS */;
INSERT INTO `ot_user` VALUES (15,'0',0,'cece1','18739912538',NULL,'测测',NULL,1,0,'8aa9e77b3178d7663f9af65c53f8b0da','8aa9e77b3178d7663f9af65c53f8b0da','0',1510899513,'BJ7J'),(16,'0',15,'cece2','18739912540','','测测尔',NULL,1,1,'256a77badbbf7bd17134ee7c07dc6dea','4b310aaf79ba2b6d1658c0ac64726f0d','0',1510906140,'44so'),(17,'16',16,'cece3','18739912541','5555@qq.com','测测三',NULL,1,1,'4bd706ced9a23bda2a9caf06278a0782','4bd706ced9a23bda2a9caf06278a0782','0,16',1510907719,'M6uE'),(18,'16',16,'cece4','18739912542',NULL,'测测四',NULL,1,0,'5e0fa7d941c740882fda9970fa4903c5','5e0fa7d941c740882fda9970fa4903c5','0,16',1510918277,'LJgW'),(23,'17',16,'ceshi','13345678925','2@qq.com','毛毛朋',NULL,1,0,'28cf7fec4466c41f0639d83fd7d5f8fe','28cf7fec4466c41f0639d83fd7d5f8fe','0,16,17',1511509713,'Oz3O'),(24,'16',23,'fdas','18839912538','fads@qq.com','毛毛毛毛',NULL,1,0,'92bd3ba176e45e5d2a52fb64838286a1','92bd3ba176e45e5d2a52fb64838286a1','0,16',1511767915,'U64T'),(25,'23',16,'1234','18739912536','qq@qq.com','毛毛毛鹏',NULL,0,0,'399e4fcbe0e34eef9200108e902fc953','399e4fcbe0e34eef9200108e902fc953','0,16,17,23',1511938318,'gcup'),(26,'16',NULL,'abcabc','18739912225',NULL,'maomao',NULL,0,0,'f7a8dae5c786f16fc8502faee92d7911','f7a8dae5c786f16fc8502faee92d7911','0,16',1511953397,'Ae69');
/*!40000 ALTER TABLE `ot_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-05  9:07:10
