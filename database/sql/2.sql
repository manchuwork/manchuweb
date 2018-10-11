-- MySQL dump 10.13  Distrib 5.1.33, for Win32 (ia32)
--
-- Host: localhost    Database: zjwdb_6242570
-- ------------------------------------------------------
-- Server version	5.1.33-community

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `title_mnc` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author` varchar(125) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `translator` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `publisher` varchar(125) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publish_year` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_count` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `binding` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `isbn` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pic` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `brief_intro` text COLLATE utf8_unicode_ci NOT NULL,
  `about_the_author` text COLLATE utf8_unicode_ci NOT NULL,
  `catalogue` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_title_index` (`title`),
  KEY `books_title_mnc_index` (`title_mnc`(255)),
  KEY `books_subtitle_index` (`subtitle`(255)),
  KEY `books_author_index` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'满语读本','ᠮᠠᠨᠵᡠ ᡤᡳᠰᡠᠨ','','爱新觉罗·乌拉熙春&nbsp;','','内蒙古人民出版社','',294,150,'','7089-209','20181009\\bookpic\\TqwYCTyEzeYRwbdoKsdujV7LwLMyx5QZ7i0MxxYI',2,'这是一本学习满语文的初等教科书，可供具有初中汉语水平的读者学习使用。全书共分20课，1-5课是字母的语音，6-20课是文章会话。通过语音的学习，可以达到对任何一个满文单字读写自如，通过文章会话的学习，可以基本掌握满语语法的基础知识和近1000个单词。','乌拉熙春（满语Aisin Gioro Ulhicun；1958－），日本名为吉本智慧子，是一位在北京出生，在日本定居的前清皇族后人，亦是一位语言学家及文学博士，是满语、女真语及契丹语的专家。现时她在日本的立命馆亚洲太平洋大学的亚洲太平洋学部担任教授。她的丈夫是日本的中国史学者吉本道雅。乌拉熙春现任教于日本，曾与父亲合作出版过多部满学著作。','','2018-10-06 06:19:25','2018-10-08 22:51:55');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `post_id` int(10) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,16,'sdd','2018-08-17 14:37:26','2018-08-17 14:37:26');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dicts`
--

DROP TABLE IF EXISTS `dicts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dicts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manchu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trans` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chinese` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `pic` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dicts_manchu_unique` (`manchu`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dicts`
--

LOCK TABLES `dicts` WRITE;
/*!40000 ALTER TABLE `dicts` DISABLE KEYS */;
INSERT INTO `dicts` VALUES (3,'ᡝᠮᡠ','Emu','一',1,'','2018-07-31 11:54:34','2018-07-31 11:54:34'),(4,'ᠵᡠᠸᡝ','Juwe','二',1,'','2018-07-31 11:57:07','2018-07-31 11:57:07'),(5,'ᡠᠯᠠᠪᡠᠨ','ulabun','乌勒本。满族传统口头文化“乌勒本”（，转写：ulabun，意为“传”或“传记”），亦称“满族说部”，是满族的长篇说唱艺术，类似于蒙古族的“乌力格尔”、“江格尔”和藏族的“格萨尔王”等民间文学艺术形式。2006年5月20日， 满族说部经国务院批准列入第一批国家级非物质文化遗产名录。',2,'','2018-08-11 23:20:06','2018-08-11 23:20:06'),(6,'ᠰᡳᡥᠣᡨᡝ','sihote','斯霍特(出自--锡霍特山洞窟乌布西奔妈妈长歌)',2,'','2018-08-11 23:28:59','2018-08-11 23:28:59'),(7,'ᠠᠯᡳᠨ','alin','山',2,'','2018-08-11 23:29:55','2018-08-11 23:29:55'),(8,'ᡩᡠᠨᡤᡤᡠ','dunggu','洞窟。 摘自&nbsp;sihote alin dunggu umesiben mama i golmin ucun（锡霍特山洞窟乌布西奔妈妈长歌）',2,'','2018-08-11 23:52:32','2018-08-11 23:52:32'),(9,'ᡠᠮᡝᠰᡳᠪᡝᠨ','umesiben','乌布西奔 按满洲话解释就是最聪明，最有本事的人。',2,'','2018-08-11 23:56:26','2018-08-11 23:56:26'),(10,'ᠮᠠᠮᠠ','mama','奶奶',2,'','2018-08-11 23:57:34','2018-08-11 23:57:34'),(56,'ᠨᡳᠩᡤᡠᠴᡳ','ningguci','第六',2,'','2018-08-29 05:30:34','2018-08-29 05:30:34'),(57,'ᠣᠴᡳ','oci','语气助词',2,'','2018-08-29 05:32:49','2018-08-29 05:32:49'),(58,'ᡠᠯᠠ','ula','江',2,'','2018-08-29 05:33:33','2018-08-29 05:33:33'),(59,'ᠪᡳᡵᠠ','bira','河',2,'','2018-08-29 05:34:39','2018-08-29 05:34:39'),(60,'ᡝᡵᡝ','ere','这个',2,'','2018-08-29 05:35:55','2018-08-29 05:35:55'),(61,'ᡨᡝᡵᡝ','tere','那个',2,'','2018-08-29 05:37:15','2018-08-29 05:37:15'),(62,'ᠠᡳ','ai','什么',2,'','2018-08-29 05:38:32','2018-08-29 05:38:32'),(63,'ᠣᡵᡥᠣ','orho','草',2,'','2018-08-29 05:40:18','2018-08-29 05:40:18'),(64,'ᡳᠯᡥᠠ','ilha','花',2,'','2018-08-29 05:41:19','2018-08-29 05:41:19'),(65,'ᡤᠣᠯᠮᡳᠨ','golmin','长',2,'','2018-08-29 05:42:30','2018-08-29 05:42:30'),(66,'ᠠᠵᡳᡤᡝ','ajige','小',2,'','2018-08-29 05:43:17','2018-08-29 05:43:17'),(67,'ᡶᡠᠯᡤᡳᠶᠠᠨ','fulgiyan','红',2,'','2018-08-29 05:44:18','2018-08-29 05:44:18'),(68,'ᠨᡳᡠᠸᠠᠩᡤᡳᠶᠠᠨ','niowanggiyan','绿',2,'','2018-08-29 05:46:07','2018-08-29 05:46:07'),(69,'ᠮᠠᠨᠵᡠ','manju','满洲',2,'','2018-08-29 05:47:45','2018-08-29 05:47:45');
/*!40000 ALTER TABLE `dicts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fans`
--

DROP TABLE IF EXISTS `fans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fan_id` int(10) NOT NULL DEFAULT '0',
  `star_id` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fans`
--

LOCK TABLES `fans` WRITE;
/*!40000 ALTER TABLE `fans` DISABLE KEYS */;
/*!40000 ALTER TABLE `fans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_resets_table',1),(9,'2018_02_21_000924_create_posts_table',1),(10,'2018_04_15_110615_create_comments_table',1),(11,'2018_05_01_114748_create_zans_table',1),(12,'2018_05_04_001241_create_fans_table',1),(13,'2018_07_31_100000_create_dicts_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manchu` text COLLATE utf8_unicode_ci NOT NULL,
  `trans` text COLLATE utf8_unicode_ci NOT NULL,
  `chinese` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pic` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'ᠰᡳ ᠰᠠᡳᠶᡡᠨ᠉','si saiyvn?','你好！',2,'','2018-08-09 16:11:13','2018-08-09 16:11:13'),(2,'ᠰᠠᡳᠨ ᠰᡳ ᠰᠠᡳᠨ ᠨᡳᠣ᠉','sain, si sain nio?','好。你好吗！',2,'','2018-08-09 16:12:56','2018-08-09 16:12:56'),(3,'ᠪᠣᠣᡳ ᡤᡠᠪᠴᡳ ᡤᡝᠮᡠ ᡝᠯᡥᡝᠣ᠉','booi gubci gemu elheo?','全家人都好吧！',2,'','2018-08-09 16:18:50','2018-08-09 16:18:50'),(4,'ᡤᡝᠮᡠ ᡝᠯᡥᡝ ᠪᠠᠨᡳᡥᠠ᠉','gemu elhe baniha.','你好！谢谢。',2,'','2018-08-09 18:02:35','2018-08-09 18:02:35'),(5,'ᡤᠣᡳᡩᠠᠮᡝ ᠰᠠᠪᡠᡥᠠᡴᡡ ᠪᡳᡥᡝ᠉','goidame sabuhakv bihe.','好久不见了。',2,'','2018-08-09 18:07:41','2018-08-09 18:07:41'),(6,'ᡥᠠᠨᠴᡳᡴᡳ ᡩᡝ ᠰᠠᡳᠨ ᠶᠠᠪᡠᠮᡝ ᠪᡳᡥᡝᠣ᠉','hanciki de sain yabume biheo?','最近过得好吗？',2,'','2018-08-09 18:09:57','2018-08-09 18:09:57'),(7,'ᠮᠠᠵᡳᡤᡝ ᡝᡴᡧᡝᡵᡝ ᡩᠠᠪᠠᠯᠠ᠉','majige ekxere dabala.','只是有点忙。',2,'','2018-08-09 18:15:10','2018-08-09 18:15:10'),(8,'ᠪᡝᠶᡝ ᡩᡠᡵᠰᡠᠨ ᠰᠠᡳᠨ ᠨᡳᡠ᠉','beye dursun sain nio?','身体好吗?',2,'','2018-08-16 17:04:39','2018-08-16 17:04:39'),(9,'ᡠᠮᡝᠰᡳ ᠰᠠᡳᠨ᠉','umesi sain.','很好。',2,'','2018-08-16 17:05:37','2018-08-16 17:05:37'),(10,'ᠪᡳ ᠶᠠᠪᡠᠮᡝ ᠣᡥᠣ᠉','bi yabume oho.','我要走了。',2,'','2018-08-16 17:06:46','2018-08-16 17:06:46'),(11,'ᠰᡳᡵᠠᠮᡝ ᠠᠴᠠᡴᡳ','sirame acaki.','再见。',2,'','2018-08-16 17:08:10','2018-08-16 17:08:10'),(12,'ᠴᡳᠮᠠᡵᡳ ᠵᡳᠮᠪᡳᠣ᠉','cimari jimbio?','明天来吗？',2,'','2018-08-16 17:10:53','2018-08-16 17:10:53'),(13,'ᡧᠣᠯᠣ ᠪᠠᡥᠠᠴᡳ ᠵᡳᡴᡳ᠉','xolo bahaci jiki.','有空就过来。',2,'','2018-08-16 17:13:30','2018-08-16 17:13:30'),(14,'ᠴᡳᠮᠠᡵᡳ ᡧᠣᠯᠣ ᠪᠠᡳᡶᡳ ᠵᡳᠣ᠉','cimari xolo baifi jio.','（你）明天抽空过来。',2,'','2018-08-16 17:15:39','2018-08-16 17:15:39'),(15,'ᠴᡳᠮᠠᡵᡳ ᠠᠴᠠᡴᡳ᠉','cimari acaki.','明天见。',2,'','2018-08-16 17:16:41','2018-08-16 17:16:41'),(16,'ᡝᡵᡝᠨᡤᡤᡝ ᠰᡳᠨᡳ ᡝᠮᡤᡳ ᠵᠠᡳ ᠮᡠᡩᡝᠨ᠉','ererengge sini emgi jzai mudan acaki.','希望再见到您。',2,'','2018-08-16 17:29:02','2018-08-16 17:51:24');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'a@a.a','a@a.a','$2y$10$ODlDsFtMI06sb4ZOY/h9IuZuk6DyHcSlEwFwZwQxZP4.Oi3rCM432',NULL,'2018-07-31 05:21:54','2018-07-31 05:21:54'),(2,'ᡠᠯᠠᠨ','asdcls@163.com','$2y$10$stX3gpmahaI5w.Pt/12.H.vtxHfwbOLBW0PKOfuDIuATM5t0zfyWe',NULL,'2018-08-09 16:08:18','2018-08-09 16:08:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zans`
--

DROP TABLE IF EXISTS `zans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `post_id` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zans`
--

LOCK TABLES `zans` WRITE;
/*!40000 ALTER TABLE `zans` DISABLE KEYS */;
INSERT INTO `zans` VALUES (1,2,3,'2018-08-09 16:19:15','2018-08-09 16:19:15');
/*!40000 ALTER TABLE `zans` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-08 23:25:39
