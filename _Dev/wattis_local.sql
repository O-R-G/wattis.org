-- MySQL dump 10.13  Distrib 5.6.16, for osx10.9 (x86_64)
--
-- Host: localhost    Database: wattis_local
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `object` int(10) unsigned DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'jpg',
  `caption` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `name1` tinytext,
  `name2` tinytext,
  `address1` text,
  `address2` text,
  `city` tinytext,
  `state` tinytext,
  `zip` tinytext,
  `country` tinytext,
  `phone` tinytext,
  `fax` tinytext,
  `url` tinytext,
  `email` tinytext,
  `begin` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `head` tinytext,
  `deck` blob,
  `body` blob,
  `notes` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
INSERT INTO `objects` VALUES (1,1,'2014-06-08 22:15:31','2014-06-08 22:35:07',NULL,'_Home',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(2,1,'2014-06-08 22:15:42','2014-06-08 22:34:51',2000,'_Settings',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(3,1,'2014-06-08 22:15:57','2014-06-08 22:15:57',100,'About',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(4,1,'2014-06-08 22:16:07','2014-06-08 22:16:07',200,'Gallery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(5,1,'2014-06-08 22:16:16','2014-06-08 22:16:16',300,'Apartment',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(6,1,'2014-06-08 22:16:31','2014-06-08 22:34:27',400,'On Our Mind',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(7,1,'2014-06-08 22:16:42','2014-06-08 22:16:42',500,'Next Door',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(8,1,'2014-06-08 22:17:03','2014-06-08 22:28:54',10,'The Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"wattisContainer\"><canvas id=\"canvas0\" width=\"60\" height=\"22\" class=\"show\" onclick=\"showBones();\">\\\\\\\\*</canvas><span id=\"sentence0\">. . . This is <a href=\"main.php\">The Wattis</a><canvas id=\"canvas13\" width=\"10\" height=\"22\">.</canvas></span><br /><span id=\"sentence1\">We<canvas id=\"canvas12\" width=\"12\" height=\"22\">’</canvas>re in San Francisco,</span> <span id=\"sentence2\">a few blocks away from <a href=\"http://www.cca.edu\" target=\"new\">California College of the Arts</a> <canvas id=\"canvas7\" width=\"50\" height=\"22\"><<⅂</canvas></span></div>',NULL),(9,1,'2014-06-08 22:17:17','2014-06-09 00:45:22',20,'Program',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"programContainer\"><a href=\"artist.php\">Markus Schinwald</a> <i>is in the gallery</i>,<canvas id=\"canvas4\" width=\"0\" height=\"22\">[*!#]</canvas> <a href=\"\">Nairy Baghramian</a> <i>is in the apartment</i>, <canvas id=\"canvas5\" width=\"0\" height=\"22\">. . .</canvas> <canvas id=\"canvas6\" width=\"0\" height=\"22\">;></canvas>and <a href=\"\">Joan Jonas</a> <i>is on our mind</i>.<canvas id=\"canvas3\" width=\"50\" height=\"22\">*!*</canvas></div>\r\n\r\n\r\n<!--\r\n<div class=\"programContainer\"><a href=\"artist.php\">Markus Schinwald</a> <i>is in the gallery</i>,<canvas id=\"canvas4\" width=\"90\" height=\"22\">[*!#]</canvas> <a href=\"\">Nairy Baghramian</a> <i>is in the\r\napartment</i>, <canvas id=\"canvas5\" width=\"80\" height=\"22\">. . .</canvas> <canvas id=\"canvas6\" width=\"32\" height=\"22\">;></canvas> and, <a href=\"\">Joan Jonas</a> <i>is on our mind</i>.<canvas id=\"canvas3\" width=\"50\" height=\"22\">*!*</canvas></div>\r\n-->',NULL),(10,1,'2014-06-08 22:17:32','2014-06-09 01:21:34',30,'News',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div id=\"news\" class=\"newsContainer\"><span class=\"red\">#_# Friday, we are showing Joan Jonas films. Come.<canvas id=\"canvas14\" width=\"20\" height=\"24\">!</canvas></span><canvas id=\"canvas11\" width=\"12\" height=\"24\">!</canvas></div>',NULL),(11,1,'2014-06-08 22:17:50','2014-06-08 23:19:01',40,'Next Door',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"nextdoorContainer\">On <a href=\"\">Tuesday, October 12</a>, philosopher \\ : | Michel Serres talks about the body.  <canvas id=\"canvas8\" width=\"80\" height=\"22\" style=\"top:-0px;\">(...)</canvas> Also, here is a <a href=\"\">full schedule</a> of upcoming events.</div>\r\n\r\n',NULL),(12,1,'2014-06-08 22:18:03','2014-06-08 23:11:23',50,'By Appointment',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"byappointmentContainer\"><canvas id=\"canvas9\" width=\"120\" height=\"22\">. . .</canvas><a href=\"\">By appointment</a>, there is a video by Rache Ruepke, a painting by Avery Singer, drawings by Henrik Oleson, a book by Luz Bacher, a recent Kompakt record, and a bar by Oscar Tuazon.</div>',NULL),(13,1,'2014-06-08 22:18:20','2014-06-09 17:09:04',60,'Location',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"weatherContainer\">We’re <a href=\"\">at</a> 360 Kansas Street (between 16th & 17th).<i> *weatherstring*</i><canvas id=\"canvas1\" width=\"150\" height=\"22\">/////////////////////////</canvas> We are open until 7pm. <canvas id=\"canvas2\" width=\"200\" height=\"22\">(())</canvas></div>',NULL),(14,1,'2014-06-08 22:18:35','2014-06-08 22:30:41',70,'Upcoming',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"scheduleContainer\"><span id=\"sentence10\">In the next three months, there are <a href=\"calendar.php\">six events</a> planned. <canvas id=\"canvas15\" width=\"20\" height=\"22\">6</canvas></span></div>',NULL),(15,1,'2014-06-08 22:19:04','2014-06-08 22:30:58',80,'Elsewhere',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"meanwhileContainer\"><span id=\"sentence11\"><i><a href=\"\">Meanwhile</a>, an exhibition by Marie Angeletti opened four days ago at Castillo Corrales</a>.</i></span></div>',NULL),(16,1,'2014-06-08 22:19:27','2014-06-08 23:23:48',90,'Archive',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"archiveContainer\"><span class=\"monaco\">o-o</span> <i>We keep <a href=\"\">an archive</a> (of exhibitions and events).</i></div>',NULL),(17,1,'2014-06-08 22:19:36','2014-06-08 22:32:18',110,'Newsletter',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"newsletterContainer\"><span id=\"sentence11\"><i>Our newsletter</i> . . . <br /><form enctype=\'multipart/form-data\' action=\'\'method=\'post\' style=\'margin: 0; padding: 0;\'><textarea name=\'sender\' cols=\'30\' rows=\'1\'class=\'Mono\'></textarea><input name=\'subscribe\' type=\'submit\' value=\'Subscribe\' /></form></span></div>\r\n',NULL),(18,1,'2014-06-08 22:19:57','2014-06-08 22:31:46',100,'Social',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"socialContainer\"><span id=\"sentence12\"><img src=\"MEDIA/fti.gif\"> here.<canvas id=\"canvas10\" width=\"50\" height=\"22\">. . .</canvas> </span></div>',NULL),(19,1,'2014-06-13 04:55:10','2014-06-13 04:55:10',NULL,'_Dev',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(20,1,'2014-06-13 04:55:22','2014-07-06 15:22:55',NULL,'Punctuation',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,' Markus Schinwald (b. 1973, Austria) presents an * installation of new work, on view September 11–December 13, 2014 + + + x x x + + + - - - = = = + + +','People like to sit still, but bodies don’t — mirrors have a way of putting the arm where the leg should be ... and the arm where the leg should be.  { Joan Jonas } has been spent a lot of time taking herself apart and putting herself back together again in the company of others. + * - ?\r\n\r\n()()(){}{}{??+\r\n\r\nJoan Jonas, Vertical Roll from >1971, and Standing Sideways, >1978. Both deal with the way the body conforms to story telling. Art historian {Pamela Lee} hosts a conversation before and after the screening. Drinks will be served. \r\n\r\nNext Tuesday, September 24\r\n>7pm\r\n\r\nThe Wattis\r\n360 Kansas Street\r\nSF, CA 94013\r\n\r\n\r\n',NULL),(21,1,'2014-06-23 16:44:10','2014-06-28 11:40:01',NULL,'Sign',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'//* . . . This is <a href=\'\'>The Wattis</a>. We’re a few blocks away from California College of the Arts, <<⅂ at 360 Kansas Street (between 16th & 17th), SF, CA 94013. Today, it is kind of foggy and currently 78° F. II, III, IV, V: 12–7; VI : 12–5. ((())) www.wattis.org\r\n\r\nWe are open T-F 12 to 7 / S 12 to 5.','//* . . . This is <a href=\'\'>The Wattis<\\/a>. We’re a few blocks away from California College of the Arts, <<⅂ at 360 Kansas Street (b/t 16th & 17th), SF, CA 94013. Today, it is kind of foggy and currently 78° F. ((())) www.wattis.org\r\n\r\nWe are open T-F 12 to 7 / S 12 to 5. ',NULL);
/*!40000 ALTER TABLE `objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wires`
--

DROP TABLE IF EXISTS `wires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `fromid` int(10) unsigned DEFAULT NULL,
  `toid` int(10) unsigned DEFAULT NULL,
  `weight` float NOT NULL DEFAULT '1',
  `notes` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wires`
--

LOCK TABLES `wires` WRITE;
/*!40000 ALTER TABLE `wires` DISABLE KEYS */;
INSERT INTO `wires` VALUES (1,1,'2014-06-08 22:15:31','2014-06-08 22:15:31',0,1,1,NULL),(2,1,'2014-06-08 22:15:42','2014-06-08 22:15:42',0,2,1,NULL),(3,1,'2014-06-08 22:15:57','2014-06-08 22:15:57',0,3,1,NULL),(4,1,'2014-06-08 22:16:07','2014-06-08 22:16:07',0,4,1,NULL),(5,1,'2014-06-08 22:16:17','2014-06-08 22:16:17',0,5,1,NULL),(6,1,'2014-06-08 22:16:31','2014-06-08 22:16:31',0,6,1,NULL),(7,1,'2014-06-08 22:16:42','2014-06-08 22:16:42',0,7,1,NULL),(8,1,'2014-06-08 22:17:03','2014-06-08 22:17:03',1,8,1,NULL),(9,1,'2014-06-08 22:17:17','2014-06-08 22:17:17',1,9,1,NULL),(10,1,'2014-06-08 22:17:32','2014-06-08 22:17:32',1,10,1,NULL),(11,1,'2014-06-08 22:17:50','2014-06-08 22:17:50',1,11,1,NULL),(12,1,'2014-06-08 22:18:03','2014-06-08 22:18:03',1,12,1,NULL),(13,1,'2014-06-08 22:18:20','2014-06-08 22:18:20',1,13,1,NULL),(14,1,'2014-06-08 22:18:35','2014-06-08 22:18:35',1,14,1,NULL),(15,1,'2014-06-08 22:19:04','2014-06-08 22:19:04',1,15,1,NULL),(16,1,'2014-06-08 22:19:27','2014-06-08 22:19:27',1,16,1,NULL),(17,1,'2014-06-08 22:19:36','2014-06-08 22:19:36',1,17,1,NULL),(18,1,'2014-06-08 22:19:57','2014-06-08 22:19:57',1,18,1,NULL),(19,1,'2014-06-13 04:55:10','2014-06-13 04:55:10',0,19,1,NULL),(20,1,'2014-06-13 04:55:22','2014-06-13 04:55:22',19,20,1,NULL),(21,1,'2014-06-23 16:44:10','2014-06-23 16:44:10',19,21,1,NULL);
/*!40000 ALTER TABLE `wires` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-07 11:08:52
