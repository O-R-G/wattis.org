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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,1,'2014-07-09 18:09:36','2014-07-09 18:09:36',22,NULL,NULL,'jpg',''),(2,1,'2014-07-09 19:17:49','2014-07-09 19:18:20',32,NULL,1,'jpg',''),(3,1,'2014-07-09 19:18:20','2014-07-09 19:18:27',32,NULL,2,'jpg','');
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
INSERT INTO `objects` VALUES (1,1,'2014-06-08 22:15:31','2014-06-08 22:35:07',NULL,'_Home',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(2,1,'2014-06-08 22:15:42','2014-06-08 22:34:51',2000,'_Settings',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(3,1,'2014-06-08 22:15:57','2014-07-09 16:43:47',100,'Main',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(4,1,'2014-06-08 22:16:07','2014-06-08 22:16:07',200,'Gallery',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(5,1,'2014-06-08 22:16:16','2014-06-08 22:16:16',300,'Apartment',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(6,1,'2014-06-08 22:16:31','2014-06-08 22:34:27',400,'On Our Mind',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(7,1,'2014-06-08 22:16:42','2014-06-08 22:16:42',500,'Next Door',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(8,1,'2014-06-08 22:17:03','2014-06-08 22:28:54',10,'The Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"wattisContainer\"><canvas id=\"canvas0\" width=\"60\" height=\"22\" class=\"show\" onclick=\"showBones();\">\\\\\\\\*</canvas><span id=\"sentence0\">. . . This is <a href=\"main.php\">The Wattis</a><canvas id=\"canvas13\" width=\"10\" height=\"22\">.</canvas></span><br /><span id=\"sentence1\">We<canvas id=\"canvas12\" width=\"12\" height=\"22\">’</canvas>re in San Francisco,</span> <span id=\"sentence2\">a few blocks away from <a href=\"http://www.cca.edu\" target=\"new\">California College of the Arts</a> <canvas id=\"canvas7\" width=\"50\" height=\"22\"><<⅂</canvas></span></div>',NULL),(9,1,'2014-06-08 22:17:17','2014-06-09 00:45:22',20,'Program',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"programContainer\"><a href=\"artist.php\">Markus Schinwald</a> <i>is in the gallery</i>,<canvas id=\"canvas4\" width=\"0\" height=\"22\">[*!#]</canvas> <a href=\"\">Nairy Baghramian</a> <i>is in the apartment</i>, <canvas id=\"canvas5\" width=\"0\" height=\"22\">. . .</canvas> <canvas id=\"canvas6\" width=\"0\" height=\"22\">;></canvas>and <a href=\"\">Joan Jonas</a> <i>is on our mind</i>.<canvas id=\"canvas3\" width=\"50\" height=\"22\">*!*</canvas></div>\r\n\r\n\r\n<!--\r\n<div class=\"programContainer\"><a href=\"artist.php\">Markus Schinwald</a> <i>is in the gallery</i>,<canvas id=\"canvas4\" width=\"90\" height=\"22\">[*!#]</canvas> <a href=\"\">Nairy Baghramian</a> <i>is in the\r\napartment</i>, <canvas id=\"canvas5\" width=\"80\" height=\"22\">. . .</canvas> <canvas id=\"canvas6\" width=\"32\" height=\"22\">;></canvas> and, <a href=\"\">Joan Jonas</a> <i>is on our mind</i>.<canvas id=\"canvas3\" width=\"50\" height=\"22\">*!*</canvas></div>\r\n-->',NULL),(10,1,'2014-06-08 22:17:32','2014-06-09 01:21:34',30,'News',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div id=\"news\" class=\"newsContainer\"><span class=\"red\">#_# Friday, we are showing Joan Jonas films. Come.<canvas id=\"canvas14\" width=\"20\" height=\"24\">!</canvas></span><canvas id=\"canvas11\" width=\"12\" height=\"24\">!</canvas></div>',NULL),(11,1,'2014-06-08 22:17:50','2014-06-08 23:19:01',40,'Next Door',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"nextdoorContainer\">On <a href=\"\">Tuesday, October 12</a>, philosopher \\ : | Michel Serres talks about the body.  <canvas id=\"canvas8\" width=\"80\" height=\"22\" style=\"top:-0px;\">(...)</canvas> Also, here is a <a href=\"\">full schedule</a> of upcoming events.</div>\r\n\r\n',NULL),(12,1,'2014-06-08 22:18:03','2014-06-08 23:11:23',50,'By Appointment',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"byappointmentContainer\"><canvas id=\"canvas9\" width=\"120\" height=\"22\">. . .</canvas><a href=\"\">By appointment</a>, there is a video by Rache Ruepke, a painting by Avery Singer, drawings by Henrik Oleson, a book by Luz Bacher, a recent Kompakt record, and a bar by Oscar Tuazon.</div>',NULL),(13,1,'2014-06-08 22:18:20','2014-06-09 17:09:04',60,'Location',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"weatherContainer\">We’re <a href=\"\">at</a> 360 Kansas Street (between 16th & 17th).<i> *weatherstring*</i><canvas id=\"canvas1\" width=\"150\" height=\"22\">/////////////////////////</canvas> We are open until 7pm. <canvas id=\"canvas2\" width=\"200\" height=\"22\">(())</canvas></div>',NULL),(14,1,'2014-06-08 22:18:35','2014-06-08 22:30:41',70,'Upcoming',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"scheduleContainer\"><span id=\"sentence10\">In the next three months, there are <a href=\"calendar.php\">six events</a> planned. <canvas id=\"canvas15\" width=\"20\" height=\"22\">6</canvas></span></div>',NULL),(15,1,'2014-06-08 22:19:04','2014-06-08 22:30:58',80,'Elsewhere',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"meanwhileContainer\"><span id=\"sentence11\"><i><a href=\"\">Meanwhile</a>, an exhibition by Marie Angeletti opened four days ago at Castillo Corrales</a>.</i></span></div>',NULL),(16,1,'2014-06-08 22:19:27','2014-06-08 23:23:48',90,'Archive',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"archiveContainer\"><span class=\"monaco\">o-o</span> <i>We keep <a href=\"\">an archive</a> (of exhibitions and events).</i></div>',NULL),(17,1,'2014-06-08 22:19:36','2014-06-08 22:32:18',110,'Newsletter',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"newsletterContainer\"><span id=\"sentence11\"><i>Our newsletter</i> . . . <br /><form enctype=\'multipart/form-data\' action=\'\'method=\'post\' style=\'margin: 0; padding: 0;\'><textarea name=\'sender\' cols=\'30\' rows=\'1\'class=\'Mono\'></textarea><input name=\'subscribe\' type=\'submit\' value=\'Subscribe\' /></form></span></div>\r\n',NULL),(18,1,'2014-06-08 22:19:57','2014-06-08 22:31:46',100,'Social',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','<div class=\"socialContainer\"><span id=\"sentence12\"><img src=\"MEDIA/fti.gif\"> here.<canvas id=\"canvas10\" width=\"50\" height=\"22\">. . .</canvas> </span></div>',NULL),(19,1,'2014-06-13 04:55:10','2014-06-13 04:55:10',NULL,'_Dev',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'','',NULL),(20,1,'2014-06-13 04:55:22','2014-07-06 15:22:55',NULL,'Punctuation',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,' Markus Schinwald (b. 1973, Austria) presents an * installation of new work, on view September 11–December 13, 2014 + + + x x x + + + - - - = = = + + +','People like to sit still, but bodies don’t — mirrors have a way of putting the arm where the leg should be ... and the arm where the leg should be.  { Joan Jonas } has been spent a lot of time taking herself apart and putting herself back together again in the company of others. + * - ?\r\n\r\n()()(){}{}{??+\r\n\r\nJoan Jonas, Vertical Roll from >1971, and Standing Sideways, >1978. Both deal with the way the body conforms to story telling. Art historian {Pamela Lee} hosts a conversation before and after the screening. Drinks will be served. \r\n\r\nNext Tuesday, September 24\r\n>7pm\r\n\r\nThe Wattis\r\n360 Kansas Street\r\nSF, CA 94013\r\n\r\n\r\n',NULL),(21,1,'2014-06-23 16:44:10','2014-06-28 11:40:01',NULL,'Sign',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'//* . . . This is <a href=\'\'>The Wattis</a>. We’re a few blocks away from California College of the Arts, <<⅂ at 360 Kansas Street (between 16th & 17th), SF, CA 94013. Today, it is kind of foggy and currently 78° F. II, III, IV, V: 12–7; VI : 12–5. ((())) www.wattis.org\r\n\r\nWe are open T-F 12 to 7 / S 12 to 5.','//* . . . This is <a href=\'\'>The Wattis<\\/a>. We’re a few blocks away from California College of the Arts, <<⅂ at 360 Kansas Street (b/t 16th & 17th), SF, CA 94013. Today, it is kind of foggy and currently 78° F. ((())) www.wattis.org\r\n\r\nWe are open T-F 12 to 7 / S 12 to 5. ',NULL),(22,1,'2014-07-09 16:47:13','2014-07-09 18:09:36',10,'About the Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . what we do here.','<a href=\'\'>The CCA Wattis Institute</a> is a nonprofit exhibition venue and research institute dedicated to contemporary art. It was founded in 1998, at the <a href=\"http://www.cca.edu\">California College of the Arts</a> in San Francisco.\r\n\r\nThe Wattis asks itself three (related) questions: What are artists making today? What are artists thinking about today? And how do artists inform (or disrupt) the way we think today?\r\n\r\nThese are not easy questions, and to address each one requires time, attention, risk, and commitment. And so we prefer to work through them by working with one artist at a time. \r\n\r\nThe gallery presents exhibitions of one artist’s work, or that are curated by one artist. The apartment hosts one artist on a research residency. And the work of one artist inspires a year-long program of events and a publication.\r\n\r\nWith that, we know we can contribute something meaningful to the local, national, and international conversation about art and contemporary culture.\r\n\r\nAnd for the arts community in the Bay Area, we also opened *Next Door* in 2014, a place for discussions, events, and drinks.\r\n\r\n<i> Our main idea is to spend more time with art, more time with artists, and more time with each other.</i>\r\n',NULL),(23,1,'2014-07-09 16:51:05','2014-07-09 17:15:15',20,'Visit the Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . address, hours, and directions.','The Wattis Institute is located in San Francisco. It is open and free to \r\nthe public. The address is:<br/> <br/>\r\n\r\n<span class=\"monaco medium\">\r\nCCA Wattis Institute<br/> \r\nKent and Vicki Logan Gallery<br/> \r\n360 Kansas Street<br/> \r\n(between 16th & 17th Streets)<br/> \r\nSan Francisco, CA 94013<br/> \r\nUSA<br/> <br/>\r\nTuesday–Friday noon-7pm<br/> \r\nSaturday noon–5pm<br/> Closed Sunday & Monday<br/> <br/> \r\n+1 415 355 9670<br/>\r\n</span> \r\n\r\n|\r\n\r\nDirections:<br/><br/>\r\n\r\n<span class=\"monaco medium\">\r\nBUS 22 (to 16th & Kansas)<br/>\r\nBUS 19 (to 16th & Rhode Island)<br/>\r\nBART (to 16th & Mission, then transfer to BUS 22 towards \r\nPotrero Hill)<br/><br/> \r\n\r\nStreet parking is available and a parking lot is also located across the \r\nroad.<br/><br/>\r\n<img src=\"IMAGES/map.jpg\">\r\n\r\n</span>\r\n\r\n<span class=\"listContainer times show comment\"> \r\n<i>Please book a guided tour with \r\nRita Souther at 415.355.9673 or <a href=\"\">rsouther@cca.edu</a>.</i></span>',NULL),(24,1,'2014-07-09 16:53:39','2014-07-09 17:15:23',30,'Contact the Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . get in touch with the staff and find our mailing address.','Please address all postal and FedEx mail to:<br/> <br/>\r\n\r\n<span class=\"monaco medium\">\r\nCCA Wattis Institute<br/> \r\n1111 Eighth Street<br/>\r\nSan Francisco, CA 94107<br/> \r\n<br/>\r\nPhone +1 415 355 9670<br/>\r\nFax +1 415 355 9676<br/>\r\nE-mail wattis@cca.edu<br/>\r\n</span>\r\n\r\n|\r\n\r\n<span class=\"monaco medium\">\r\n\r\nAnthony Huberman\r\nDirector and Chief Curator\r\n\r\nMicki Meng\r\nAssistant Director\r\nmmeng@cca.edu\r\n\r\nJamie Stevens\r\nCurator and Head of Programs\r\njstevens@cca.edu\r\n\r\nRita Souther\r\nHead of Operations\r\nrsouther@cca.edu\r\n\r\nJustin Limoges\r\nHead of Installation\r\njlimoges@cca.edu\r\n\r\nBrooke Henrickson\r\nIndividual Gifts\r\nCCA Associate VP for Advancement\r\nbhenrickson@cca.edu\r\n\r\nKaren Weber\r\nFoundation and Institutional Gifts\r\nCCA Senior Director of Institutional Giving\r\nkweber@cca.edu\r\n\r\nBrenda Tucker\r\nCCA Director of Communications\r\nbtucker@cca.edu\r\n415-703-9548\r\n\r\nLindsey Westbrook\r\nCCA Editor\r\nlwestbrook@cca.edu\r\n\r\nElsa Delage\r\nIntern\r\nwattisintern@cca.edu\r\n\r\nMona Varichon\r\nIntern\r\nwattisintern@cca.edu\r\n\r\nDavid Reinfurt\r\nGraphic design\r\n\r\n</span>\r\n\r\n\r\n<span class=\"listContainer times show comment\"> \r\n<i>Please book a guided tour with \r\nRita Souther at 415.355.9673 or <a href=\"\">rsouther@cca.edu</a>.</i></span>\r\n</span>',NULL),(25,1,'2014-07-09 16:54:39','2014-07-09 16:54:39',40,'Support the Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . become a member or make a donation. This really helps us do what we do. Thank you.','',NULL),(26,1,'2014-07-09 16:54:58','2014-07-09 16:54:58',50,'Buy Limited Editions',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . for an affordable price, own a work of art by major national and international artists.','',NULL),(27,1,'2014-07-09 16:55:20','2014-07-09 16:55:20',60,'Buy Catalogues',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . shop for books and exhibition catalogues related to past exhibitions.','',NULL),(28,1,'2014-07-09 16:55:42','2014-07-09 16:55:42',70,'Follow the Wattis',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . on Twitter, Facebook, Instagram, and Tumblr.','',NULL),(29,1,'2014-07-09 16:56:13','2014-07-09 16:56:13',80,'Intern at the Watts',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . get hands-on experience working in a contemporary art center.','',NULL),(30,1,'2014-07-09 16:56:31','2014-07-09 17:15:43',90,'Consult the Archive',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . information on past exhibition and past events (1998 – present).','',NULL),(31,1,'2014-07-09 16:56:53','2014-07-09 16:56:53',100,'Capp Street Project',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,'. . . founded by Ann Hatch in 1983, Capp Street Project became part of the Wattis in 1998.','',NULL),(32,1,'2014-07-09 19:17:49','2014-07-09 19:18:37',10,'Markus Schinwald',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,'2014-09-09 00:00:00',NULL,NULL,'','<a href=\"\">Markus Schinwald</a> gives inanimate objects a personality of their own: they have good moods, bad moods, nervous tics, and psychological baggage. His paintings, sculptures, and installations have *issues*, in the way that most relationships do. Conversely, he also imagines a world where a state of mind could give rise to an object. *What if*, the work asks, *a moment of anxiety could generate a neck brace*. Clearly, this gives a whole new meaning to what we say when we talk about prosthetics.\r\n\r\n<i>Markus Schinwald (b. 1973, Austria) presents an installation of new work, on view September 11–December 13, 2014</i>',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wires`
--

LOCK TABLES `wires` WRITE;
/*!40000 ALTER TABLE `wires` DISABLE KEYS */;
INSERT INTO `wires` VALUES (1,1,'2014-06-08 22:15:31','2014-06-08 22:15:31',0,1,1,NULL),(2,1,'2014-06-08 22:15:42','2014-06-08 22:15:42',0,2,1,NULL),(3,1,'2014-06-08 22:15:57','2014-06-08 22:15:57',0,3,1,NULL),(4,1,'2014-06-08 22:16:07','2014-06-08 22:16:07',0,4,1,NULL),(5,1,'2014-06-08 22:16:17','2014-06-08 22:16:17',0,5,1,NULL),(6,1,'2014-06-08 22:16:31','2014-06-08 22:16:31',0,6,1,NULL),(7,1,'2014-06-08 22:16:42','2014-06-08 22:16:42',0,7,1,NULL),(8,1,'2014-06-08 22:17:03','2014-06-08 22:17:03',1,8,1,NULL),(9,1,'2014-06-08 22:17:17','2014-06-08 22:17:17',1,9,1,NULL),(10,1,'2014-06-08 22:17:32','2014-06-08 22:17:32',1,10,1,NULL),(11,1,'2014-06-08 22:17:50','2014-06-08 22:17:50',1,11,1,NULL),(12,1,'2014-06-08 22:18:03','2014-06-08 22:18:03',1,12,1,NULL),(13,1,'2014-06-08 22:18:20','2014-06-08 22:18:20',1,13,1,NULL),(14,1,'2014-06-08 22:18:35','2014-06-08 22:18:35',1,14,1,NULL),(15,1,'2014-06-08 22:19:04','2014-06-08 22:19:04',1,15,1,NULL),(16,1,'2014-06-08 22:19:27','2014-06-08 22:19:27',1,16,1,NULL),(17,1,'2014-06-08 22:19:36','2014-06-08 22:19:36',1,17,1,NULL),(18,1,'2014-06-08 22:19:57','2014-06-08 22:19:57',1,18,1,NULL),(19,1,'2014-06-13 04:55:10','2014-06-13 04:55:10',0,19,1,NULL),(20,1,'2014-06-13 04:55:22','2014-06-13 04:55:22',19,20,1,NULL),(21,1,'2014-06-23 16:44:10','2014-06-23 16:44:10',19,21,1,NULL),(22,1,'2014-07-09 16:47:13','2014-07-09 16:47:13',3,22,1,NULL),(23,1,'2014-07-09 16:51:05','2014-07-09 16:51:05',3,23,1,NULL),(24,1,'2014-07-09 16:53:39','2014-07-09 16:53:39',3,24,1,NULL),(25,1,'2014-07-09 16:54:39','2014-07-09 16:54:39',3,25,1,NULL),(26,1,'2014-07-09 16:54:58','2014-07-09 16:54:58',3,26,1,NULL),(27,1,'2014-07-09 16:55:20','2014-07-09 16:55:20',3,27,1,NULL),(28,1,'2014-07-09 16:55:42','2014-07-09 16:55:42',3,28,1,NULL),(29,1,'2014-07-09 16:56:13','2014-07-09 16:56:13',3,29,1,NULL),(30,1,'2014-07-09 16:56:31','2014-07-09 16:56:31',3,30,1,NULL),(31,1,'2014-07-09 16:56:53','2014-07-09 16:56:53',3,31,1,NULL),(32,1,'2014-07-09 19:17:49','2014-07-09 19:17:49',4,32,1,NULL);
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

-- Dump completed on 2014-07-12 13:46:19
