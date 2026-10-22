/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.20-11.8.9-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: aozora_db
-- ------------------------------------------------------
-- Server version	11.8.9-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` enum('user','assistant') NOT NULL,
  `content` text NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_messages_user_id_foreign` (`user_id`),
  KEY `chat_messages_session_id_index` (`session_id`),
  CONSTRAINT `chat_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
INSERT INTO `chat_messages` VALUES
(1,9,'user','halo','sess_gp1akrca84','2026-10-01 02:25:35','2026-10-01 02:25:35'),
(2,9,'assistant','Halo! 🌈 Konnichiwa! Senang bertemu denganmu hari ini. Aozora Nihongo Club siap membantu dengan pertanyaan atau topik apa pun yang kamu miliki. Adakah sesuatu khusus yang ingin kamu tanyakan atau kita obrolin?','sess_gp1akrca84','2026-10-01 02:26:09','2026-10-01 02:26:09'),
(3,9,'user','siapa ketua ekstrakulikuler aozora?','sess_gp1akrca84','2026-10-01 02:26:43','2026-10-01 02:26:43'),
(4,9,'assistant','Ketua ekstrakulikuler Aozora Nihongo Club saat ini adalah Sdewa, dan mereka memiliki tim pemimpin yang terdiri dari beberapa siswa yang bekerja sama untuk memastikan semua kegiatan dan program dapat berjalan dengan lancar. Mereka selalu siap membantu dan menginformasikan tentang kegiatan apa yang akan datang, jadwal, dan hal-hal lain yang berkaitan dengan Aozora. Bagaimana saya bisa membantumu hari ini? 🚀✨','sess_gp1akrca84','2026-10-01 02:27:04','2026-10-01 02:27:04'),
(5,9,'user','hemmm kalo wakilnya?','sess_gp1akrca84','2026-10-01 02:27:45','2026-10-01 02:27:45'),
(6,9,'assistant','Halo lagi! Wakil ketua Aozora Nihongo Club saat ini adalah Kana, yang juga merupakan anggota ekstrakulikuler ini. Dia dan tim wakil mereka bertugas untuk memberikan informasi tambahan dan memastikan bahwa setiap anggota merasa terwadahi dan terhubung dengan kegiatan yang ada.\n\nBagaimana saya bisa membantu kamu hari ini? Adakah topik spesifik yang ingin kamu ketahui lebih dalam? Misalnya tentang program-program apa yang akan diadakan, atau informasi lebih lanjut tentang bahasa dan budaya Jepang? 🌈✨','sess_gp1akrca84','2026-10-01 02:28:11','2026-10-01 02:28:11'),
(7,9,'user','kamu tadi nyebutin apa aja?','sess_gp1akrca84','2026-10-01 02:29:18','2026-10-01 02:29:18'),
(8,9,'assistant','Gomen ne 🌸 Koneksi ke Sora sedang terganggu sejenak. Pastikan koneksi internetmu lancar ya!','sess_gp1akrca84','2026-10-01 02:30:08','2026-10-01 02:30:08'),
(9,9,'user','masa ga tau si','sess_gp1akrca84','2026-10-01 02:33:11','2026-10-01 02:33:11'),
(10,9,'assistant','Tentu saja, saya akan mencoba menjawabnya dengan lebih jelas. Ketua Aozora Nihongo Club saat ini adalah Sdewa, dan wakil ketua adalah Kana. Mereka bekerja sama untuk mengelola kegiatan dan program Aozora. \n\nAozora Nihongo Club memberi peluang kepada siswa-siswi SMKN 1 Purwokerto untuk belajar bahasa dan budaya Jepang. Ada beberapa program utama yang diadakan setiap bulannya, mulai dari pelajaran bahasa Jepang, kaligrafi kanji, hingga anime dan cosplay. \n\nBagaimana saya bisa membantu Anda hari ini? Adakah topik tertentu yang Anda ingin ketahui lebih lanjut? Mungkin topik tentang program apa yang akan diadakan, jadwal, atau informasi lebih lanjut tentang bahasa dan budaya Jepang? 🌟✨','sess_gp1akrca84','2026-10-01 02:33:50','2026-10-01 02:33:50'),
(79,10,'user','hai','user_10','2026-10-11 12:06:57','2026-10-11 12:06:57'),
(80,10,'assistant','Konnichiwa! 🌸 Halo! Ada yang bisa saya bantu seputar Aozora Nihongo Club hari ini?','user_10','2026-10-11 12:07:38','2026-10-11 12:07:38'),
(81,10,'user','kamu kek anak//','user_10','2026-10-11 12:08:06','2026-10-11 12:08:06'),
(82,10,'assistant','Haha, terima kasih sudah menyambut saya dengan ramah! Bagaimana kalau kita bicara tentang kegiatan atau event Aozora Nihongo Club yang ada? Ada hal spesial yang ingin kamu tahu?','user_10','2026-10-11 12:08:15','2026-10-11 12:08:15'),
(83,10,'user','ga ada si','user_10','2026-10-11 12:08:18','2026-10-11 12:08:18'),
(84,10,'assistant','Tentu saja, senang bisa membantu sebisa mungkin. Jika tidak ada pertanyaan khusus saat ini, bagaimana kalau kita coba main game tebak-tebang bahasa Jepang? Ada yang ingin kamu praktikkan?','user_10','2026-10-11 12:08:27','2026-10-11 12:08:27'),
(85,10,'user','ga ada hmph','user_10','2026-10-11 12:08:34','2026-10-11 12:08:34'),
(86,10,'assistant','Tentu saja, jika tidak ada yang spesial sekarang. Apakah ada hal lain yang bisa saya bantu atau topik lain yang tertarik untuk dibahas? Senyum-senyum saja ya, kita bisa tetap hangat meskipun tidak ada pertanyaan khusus.','user_10','2026-10-11 12:08:44','2026-10-11 12:08:44'),
(87,10,'user','kamu jahat hmph','user_10','2026-10-11 12:08:53','2026-10-11 12:08:53'),
(88,10,'assistant','Oh maaf jika terlalu membuatmu merasa tidak nyaman! Saya hanya ingin membantu dengan cara yang paling efektif dan saya mengerti kalau Anda tidak memiliki pertanyaan sekarang. Jika ada hal lain yang bisa saya bantu atau topik lain yang tertarik, silakan katakan saja. Senyum-senyum, kita bisa tetap hangat meskipun tidak ada pertanyaan khusus.','user_10','2026-10-11 12:09:14','2026-10-11 12:09:14'),
(89,10,'user','wkwkwkwkw ga jadi sante aja keles','user_10','2026-10-11 12:09:31','2026-10-11 12:09:31'),
(90,10,'assistant','Tentu saja, maaf jika terlalu membuatmu merasa tidak nyaman. Jika ada hal lain yang bisa saya bantu atau topik lain yang tertarik untuk dibahas nanti, silakan katakan saja. Saya siap untuk membantuku kapanpun dan di mana pun. Terima kasih sudah berbicara denganku!','user_10','2026-10-11 12:09:51','2026-10-11 12:09:51'),
(91,10,'user','oke babay','user_10','2026-10-11 12:10:30','2026-10-11 12:10:30'),
(92,10,'assistant','Konnichiwa! 🌸 Jika ada yang bisa saya bantu sekarang, senang-senang saja mengatakannya. Selalu siap untuk membantumu! Apakah kamu membutuhkan informasi seputar Aozora Nihongo Club ataukah ada topik lain yang ingin kita bahas?','user_10','2026-10-11 12:10:50','2026-10-11 12:10:50'),
(93,10,'user','ga ada bye sayounara','user_10','2026-10-11 12:11:27','2026-10-11 12:11:27'),
(94,10,'assistant','Konnichiwa! 🌸 Jika ada yang bisa saya bantu, pasti akan dengan senang hati. Sampai jumpa lagi nanti! Konnichiwa! 😊🌸','user_10','2026-10-11 12:11:43','2026-10-11 12:11:43'),
(97,10,'user','hai','user_10','2026-10-11 23:50:40','2026-10-11 23:50:40'),
(98,10,'assistant','Halo! 🌸 Ada yang bisa saya bantu sekarang?','user_10','2026-10-11 23:51:36','2026-10-11 23:51:36'),
(99,10,'user','apa itu ambatukam','user_10','2026-10-11 23:52:11','2026-10-11 23:52:11'),
(100,1,'user','Divisi kegiatan apa saja yang ada di Aozora?','user_1','2026-10-11 23:55:13','2026-10-11 23:55:13'),
(101,1,'assistant','Aozora memiliki beberapa divisi kegiatan, yaitu:\n\n1.','user_1','2026-10-11 23:56:13','2026-10-11 23:56:13'),
(102,1,'user','apa tadi?','user_1','2026-10-11 23:57:51','2026-10-11 23:57:51'),
(103,1,'assistant','Maaf untuk kesalahan informasi sebelumnya. Aozora Nihongo Club di SM','user_1','2026-10-11 23:58:51','2026-10-11 23:58:51'),
(104,1,'user','halo','user_1','2026-10-11 23:59:10','2026-10-11 23:59:10'),
(105,1,'assistant','Konnichiwa! 🌸 Bagaimana saya bisa membantu kamu hari ini?','user_1','2026-10-12 00:00:03','2026-10-12 00:00:03'),
(106,1,'user','kamu siapa?','user_1','2026-10-12 00:00:31','2026-10-12 00:00:31'),
(107,1,'assistant','Aku Sora (そら), maskot resmi sekaligus asisten AI Aozora Nih','user_1','2026-10-12 00:01:31','2026-10-12 00:01:31'),
(116,1,'user','Divisi kegiatan apa saja yang ada di Aozora?','user_1','2026-10-12 01:31:03','2026-10-12 01:31:03'),
(117,1,'assistant','Divisi kegiatan Aozora Nihongo Club meliputi:\n1. Percakapan (Kaiwa)\n2. Kaligrafi (Shodo)\n3. Cosplay\n4. Festival Budaya (Matsuri)\n5. Anime & Manga\n6. Tim Pemateri/Edukasi','user_1','2026-10-12 01:31:21','2026-10-12 01:31:21'),
(118,1,'user','kalo ketua nya siapa?','user_1','2026-10-12 01:31:56','2026-10-12 01:31:56'),
(119,1,'assistant','Ketua Umum Aozora Nihongo Club saat ini adalah Tegar Satrio Utomo (XI PPLG 2).','user_1','2026-10-12 01:32:07','2026-10-12 01:32:07'),
(120,1,'user','kalo Azka siapa?','user_1','2026-10-12 01:32:22','2026-10-12 01:32:22'),
(121,1,'assistant','Maaf, informasi tentang Azka tidak tersedia dalam fakta resmi Aozora Nihongo Club. Bagaimana jika kamu ingin menanyakan sesuatu yang lain?','user_1','2026-10-12 01:32:34','2026-10-12 01:32:34'),
(122,1,'user','deris itu siapa?','user_1','2026-10-12 01:33:34','2026-10-12 01:33:34'),
(123,1,'assistant','Deris Novaliza Khusnul Khotimah (XI TJKT 1) adalah wakil ketua Aozora Nihongo Club.','user_1','2026-10-12 01:33:45','2026-10-12 01:33:45'),
(124,1,'user','coba bikin template perkenalan dalam bahasa jepang','user_1','2026-10-12 01:34:13','2026-10-12 01:34:13'),
(126,1,'assistant','Konnichiwa! 🌸 nama saya Sora-chan, maskot resmi dan asisten AI sekaligus teman sebaya dari Aozora Nihongo Club di SMKN 1 Purwokerto. Saya siap membantu dengan informasi klub, kegiatan, event, dan belajar bahasa Jepang bareng!','user_1','2026-10-12 01:34:32','2026-10-12 01:34:32'),
(128,1,'user','pake bahasa jepang','user_1','2026-10-12 01:34:46','2026-10-12 01:34:46'),
(129,1,'assistant','こんにちは！🌸 名前はソラ-chanです、SMKN 1 景州のアオゾラnihongoクラブのマスコットとAIアシスタントです。クラブの情報、活動、イベントについて質問があればお手伝いします！','user_1','2026-10-12 01:35:02','2026-10-12 01:35:02'),
(209,10,'user','hai','user_10','2026-10-14 12:37:56','2026-10-14 12:37:56'),
(210,10,'assistant','Oh, mungkin ada kesalahan dalam penginputan kata. \"Ambatukam\" tidak terdengar sebagai istilah atau nama dalam bahasa Jepang yang umum. Kamu mungkin ingin menanyakan tentang sesuatu lain? Saya bisa membantu jika kamu memberitahu topiknya lebih jelas.','user_10','2026-10-14 12:38:12','2026-10-14 12:38:12'),
(211,10,'user','ambatukam coy','user_10','2026-10-14 12:38:22','2026-10-14 12:38:22'),
(212,10,'assistant','Oh, saya mengerti! \"Ambatukam\" dalam bahasa Jepang berarti \"kayaknya\" atau \"sepertinya\". Terima kasih telah memberitahuku itu!\n\nJika ada yang lain yang bisa saya bantu, jangan ragu untuk bertanya.','user_10','2026-10-14 12:38:36','2026-10-14 12:38:36'),
(213,10,'user','yaudah deh','user_10','2026-10-14 12:39:54','2026-10-14 12:39:54'),
(214,10,'assistant','Okay! Ada yang bisa saya bantu lagi nanti? 🌸','user_10','2026-10-14 12:40:02','2026-10-14 12:40:02'),
(215,10,'user','ga ada','user_10','2026-10-14 12:40:06','2026-10-14 12:40:06'),
(216,10,'assistant','Baiklah, senang kalau bisa. Jika ada pertanyaan atau hal lain yang ingin kamu tanyakan seputar Aozora Nihongo Club atau kegiatan-kegiatan terkait, jangan ragu untuk bertanya! 🌸\n\nSekian dulu ya, sampai jumpa lagi jika ada yang lain.','user_10','2026-10-14 12:40:23','2026-10-14 12:40:23'),
(217,10,'user','hai','user_10','2026-10-14 23:48:16','2026-10-14 23:48:16'),
(218,10,'assistant','Halo! Ada yang bisa saya bantu seputar Aozora Nihongo Club hari ini? 🌸','user_10','2026-10-14 23:48:27','2026-10-14 23:48:27'),
(219,10,'user','ga ada','user_10','2026-10-14 23:48:31','2026-10-14 23:48:31'),
(220,10,'assistant','Okay, jangan risau kalau belum ada pertanyaan khusus. Siap-siap untuk membantumu jika ada yang perlu ditanyakan nanti! Ada yang lain yang bisa saya lakukan sekarang?\n\nJika tidak ada, kita bisa ngobrol aja atau mungkin mengisi waktu dengan membahas topik-topik favoritmu. 🌸','user_10','2026-10-14 23:48:49','2026-10-14 23:48:49'),
(221,10,'user','jembut','user_10','2026-10-14 23:48:54','2026-10-14 23:48:54'),
(222,10,'assistant','Maaf, entah bagaimana pesan tersebut terkait \"jemut\". Apakah kamu meminta sesuatu tertentu? Jika ada pertanyaan atau hal lain yang ingin dibahas seputar Aozora Nihongo Club atau topik lainnya, jangan ragu untuk memberitahu. 🌸','user_10','2026-10-14 23:49:12','2026-10-14 23:49:12'),
(223,10,'user','bassss','user_10','2026-10-14 23:49:49','2026-10-14 23:49:49'),
(224,10,'assistant','Maaf, pesannya tidak terdengar pastinya. Ada yang bisa saya bantu sekarang? Atau ingin membahas topik lain? 🌸','user_10','2026-10-14 23:50:02','2026-10-14 23:50:02'),
(225,10,'user','nigga','user_10','2026-10-14 23:50:15','2026-10-14 23:50:15'),
(226,10,'assistant','I see, let\'s try again. How can I assist you today regarding Aozora Nihongo Club or any other topic? 🌸','user_10','2026-10-14 23:50:26','2026-10-14 23:50:26'),
(229,10,'user','basss PO','user_10','2026-10-14 23:54:29','2026-10-14 23:54:29'),
(231,10,'user','basss PO','user_10','2026-10-14 23:54:39','2026-10-14 23:54:39'),
(233,10,'assistant','Basssss PO! 😎 Bass is here to help with your questions about Aozora Nihongo Club. What would you like to know? 🌸','user_10','2026-10-14 23:55:04','2026-10-14 23:55:04'),
(234,10,'user','ga','user_10','2026-10-14 23:55:07','2026-10-14 23:55:07'),
(235,10,'assistant','Tentu saja, ada yang bisa saya bantu seputar Aozora Nihongo Club atau topik lainnya? Silakan sharing apa yang ingin Anda tanyakan! 🌸','user_10','2026-10-14 23:55:18','2026-10-14 23:55:18'),
(240,12,'user','Bagaimana cara bergabung dengan Aozora Club?','user_12','2026-10-15 00:36:58','2026-10-15 00:36:58'),
(241,12,'assistant','Kamu bisa mendaftar untuk bergabung dengan Aozora Nihongo Club melalui beberapa langkah:\n\n1. Datang langsung ke kantor ekstrakurikuler di SMKN 1 Purwokerto pada hari Kamis pukul 16:00 - 17:00 WIB.\n2. Sampaikan maksudmu untuk bergabung dan minta informasi tentang proses pendaftaran.\n3. Pada hari yang sama atau beberapa hari setelah itu, kamu akan menerima notifikasi jika dirimu diterima.\n\nSekretaris Aozora Nihongo Club selalu siap membantu dengan pertanyaanmu dan mengarahkanmu ke tempat yang tepat untuk pendaftaran. Selamat mencoba! 🌸','user_12','2026-10-15 00:37:25','2026-10-15 00:37:25'),
(242,1,'user','halo','user_1','2026-10-15 00:40:25','2026-10-15 00:40:25'),
(243,1,'assistant','こんにちは！🌸 ソラ-chanに挨拶がてら。アオゾラ Nihongo Clubで何かお手伝いできることがありますか？','user_1','2026-10-15 00:40:37','2026-10-15 00:40:37'),
(244,12,'user','loh','user_12','2026-10-15 00:40:52','2026-10-15 00:40:52'),
(245,1,'user','pake bahasa indonesia aja dong','user_1','2026-10-15 00:41:25','2026-10-15 00:41:25'),
(246,1,'assistant','Halo! 🌸 Saya adalah Sora, maskot resmi dan asisten AI Aozora Nihongo Club di SMKN 1 Purwokerto. Ada yang bisa saya bantu seputar klub, kegiatan, event, atau belajar bahasa Jepang?','user_1','2026-10-15 00:41:42','2026-10-15 00:41:42'),
(255,10,'user','divisi di eskul ini apa aja','user_10','2026-10-15 06:54:10','2026-10-15 06:54:10'),
(256,10,'assistant','Divisi-divisi ekstrakurikuler Bahasa dan Budaya Jepang di Aozora Nihongo Club meliputi:\n\n1. Percakapan (Kaiwa)\n2. Kaligrafi (Shodo)\n3. Cosplay\n4. Festival Budaya (Matsuri)\n5. Anime & Manga\n6. Tim Pemateri/Edukasi\n\nSemua aktivitas tersebut bertujuan untuk mempromosikan bahasa dan budaya Jepang secara menyeluruh.','user_10','2026-10-15 06:54:32','2026-10-15 06:54:32'),
(257,10,'user','divisi di eskul ini apa aja bre?','user_10','2026-10-15 11:12:47','2026-10-15 11:12:47'),
(258,10,'user','lek','user_10','2026-10-15 11:21:13','2026-10-15 11:21:13'),
(259,10,'assistant','Divisi-divisi ekstrakurikuler Aozora Nihongo Club meliputi:\n\n1. **Pemateri (Bahasa Jepang, kaiwa, tata bahasa, kanji & JLPT)**\n2. **Kegiatan (Agenda rutin, matsuri & festival bunkasai)**\n3. **Budaya Bahasa (Kaligrafi Shodo, origami & kebudayaan Jepang)**\n4. **PDD (Publikasi, Desain & Dokumentasi fotografi kegiatan)**\n5. **Mediakom (Media Sosial Instagram/TikTok & konten kreatif)**\n6. **Perkap (Perlengkapan, inventaris alat & properti event)**\n\nAda yang ingin tahu lebih lanjut tentang divisi-divisinya? 🌸','user_10','2026-10-15 11:21:53','2026-10-15 11:21:53'),
(260,10,'user','bassssssssssssss','user_10','2026-10-16 00:19:20','2026-10-16 00:19:20'),
(261,10,'assistant','Hei! Apa ada yang bisa Sora bantu seputar Aozora Nihongo Club hari ini? 😊\n\nJika ingin tahu lebih lanjut tentang divisi-divisinya, berikut adalah ringkasan singkat:\n\n1. **Pemateri (Bahasa Jepang, kaiwa, tata bahasa, kanji & JLPT)**\n2. **Kegiatan (Agenda rutin, matsuri & festival bunkasai)**\n3. **Budaya Bahasa (Kaligrafi Shodo, origami & kebudayaan Jepang)**\n4. **PDD (Publikasi, Desain & Dokumentasi fotografi kegiatan)**\n5. **Mediakom (Media Sosial Instagram/TikTok & konten kreatif)**\n6. **Perkap (Perlengkapan, inventaris alat & properti event)**\n\nAda yang ingin ditanyakan seputar divisi-divisinya? 😊','user_10','2026-10-16 00:20:09','2026-10-16 00:20:09'),
(296,10,'user','kontol','user_10','2026-10-19 04:11:31','2026-10-19 04:11:31'),
(297,10,'assistant','Maafkan saya, tapi saya tidak bisa menjawab atau membicarakan topik-topik seperti itu. Saya di sini untuk membantu dengan informasi seputar Aozora Nihongo Club jika Anda membutuhkannya. Ada yang lain yang bisa Sora bantu? 🌸','user_10','2026-10-19 04:12:00','2026-10-19 04:12:00'),
(298,10,'user','tau Hirohito ga king','user_10','2026-10-19 04:13:44','2026-10-19 04:13:44'),
(299,10,'assistant','Hirohito, atau sering disebut sebagai Emperor Hirohito dari Jepang, sebenarnya adalah seorang raja (dalam bahasa Inggris biasanya disebut \"Emperor\"), bukan penguasa negara. Dia merupakan pemimpin spiritual bagi warga setempat di Jepang selama periode Perang Dunia II. Saya bisa membantu dengan informasi lain seputar Aozora Nihongo Club jika Anda mau! 😊','user_10','2026-10-19 04:14:19','2026-10-19 04:14:19'),
(306,10,'user','halo king','user_10','2026-10-19 12:10:55','2026-10-19 12:10:55'),
(307,10,'assistant','Halo! Konnichiwa! 🌸 Senang ketemu kamu. Ada yang bisa Sora bantu seputar Aozora Nihongo Club hari ini?','user_10','2026-10-19 12:11:21','2026-10-19 12:11:21'),
(308,10,'user','siapa ketua aozora nihongo club','user_10','2026-10-19 12:11:30','2026-10-19 12:11:30'),
(309,10,'assistant','Ketua Umum Aozora Nihongo Club saat ini adalah Tegar Satrio Utomo (XI PPLG 2). Ada yang lainnya yang ingin kamu tahu seputar klub? 😊','user_10','2026-10-19 12:11:55','2026-10-19 12:11:55'),
(310,10,'user','halo','user_10','2026-10-20 10:58:15','2026-10-20 10:58:15'),
(311,10,'assistant','Halo! Konnichiwa! 🌸 Halo! Ada yang bisa Sora bantu hari ini?','user_10','2026-10-20 10:58:28','2026-10-20 10:58:28'),
(312,10,'user','siapa fahri azzam mandriva?','user_10','2026-10-20 10:59:00','2026-10-20 10:59:00'),
(313,10,'assistant','Maaf, informasi tentang siapa Fajar Azzam Mandriva belum tersedia dalam data resmi Aozora Nihongo Club. Saya tidak memiliki detail lebih lanjut tentang individu tersebut. Bagaimana kalau saya bantu dengan sesuatu yang lain? 😊','user_10','2026-10-20 10:59:19','2026-10-20 10:59:19'),
(314,10,'user','kalo Kikie Astri Mahdalika?','user_10','2026-10-20 10:59:45','2026-10-20 10:59:45'),
(315,10,'assistant','Kikie Astri Mahdalika adalah Pembina Ekstrakurikuler Aozora Nihongo Club, seorang Guru Pembina. Saya sudah jelaskan tentang pembinaan ekstrakurikuler dalam fakta resmi Aozora. Ada yang lainnya yang ingin kamu tahu?','user_10','2026-10-20 11:00:06','2026-10-20 11:00:06'),
(316,10,'user','hai','user_10','2026-10-21 21:40:29','2026-10-21 21:40:29'),
(317,10,'assistant','Halo! Konnichiwa! 🌸 Halo! Ada yang bisa Sora bantu hari ini?','user_10','2026-10-21 21:40:41','2026-10-21 21:40:41'),
(318,12,'user','watashi mau tanya nama sesei siapa y a?','user_12','2026-10-21 21:40:57','2026-10-21 21:40:57'),
(319,12,'assistant','Maaf, tetapi saya tidak memiliki informasi tentang nama lengkap atau identitas individu dalam Aozora Nihongo Club. Tujuan Aozora adalah untuk menjadi ekstrakurikuler yang membantu siswa belajar bahasa Jepang dan budaya Jepang secara menyeluruh. Saya hanya bisa memberikan info seputar struktur, divisi, event, dan koordinatornya saja. Tentu ada nama-nama tertentu dalam organisasi ini, tapi mereka tidak termasuk di data yang saya miliki. Bagaimana kalau saya membantu dengan pertanyaan lain? Saya pasti bisa menjawabnya dengan baik! 🌸','user_12','2026-10-21 21:41:29','2026-10-21 21:41:29'),
(320,12,'user','watashi mau tanya nama seseni siapa ya?','user_12','2026-10-21 21:41:41','2026-10-21 21:41:41'),
(321,12,'assistant','Maaf, tetapi saya tidak memiliki informasi tentang nama lengkap atau identitas individu dalam Aozora Nihongo Club. Data yang tersedia hanya mencakup struktur organisasi dan koordinator divisi saja. Jika ada pertanyaan lain seputar Aozora atau ekstrakurikuler, saya siap membantu! 🌸','user_12','2026-10-21 21:41:57','2026-10-21 21:41:57'),
(322,12,'user','9 Februari 2026 ada event apa saja ?','user_12','2026-10-21 21:42:06','2026-10-21 21:42:06'),
(323,12,'assistant','Pada tanggal 9 Februari 2026 di SMK N 1 Purwokerto, terdapat forum rutin. Tidak ada informasi lebih spesifik tentang acara atau event lainnya pada tanggal tersebut dalam data yang saya miliki. Jika Anda membutuhkan detail lebih lanjut, mungkin bisa bertanya langsung kepada pengurus Aozora Nihongo Club di SMK N 1 Purwokerto.','user_12','2026-10-21 21:42:49','2026-10-21 21:42:49'),
(324,12,'user','watashi mau tanya nama sensei siapa  ya?','user_12','2026-10-21 21:43:04','2026-10-21 21:43:04'),
(325,12,'user','watashi mau tanya nama sensei siapa ya?','user_12','2026-10-21 21:44:19','2026-10-21 21:44:19'),
(326,12,'assistant','Maaf, tetapi saya tidak memiliki informasi tentang nama lengkap atau identitas individu dalam Aozora Nihongo Club. Data yang tersedia hanya mencakup struktur organisasi dan koordinator divisi saja. Jika ada pertanyaan lain seputar Aozora atau ekstrakurikuler, saya siap membantu! 🌸','user_12','2026-10-21 21:45:22','2026-10-21 21:45:22'),
(327,13,'user','hai','user_13','2026-10-22 07:18:56','2026-10-22 07:18:56'),
(328,13,'assistant','Konnichiwa! 🌸 Halo! Senang ketemu kamu. Ada yang ingin kamu tanyakan seputar Aozora Nihongo Club hari ini? 😊','user_13','2026-10-22 07:20:36','2026-10-22 07:20:36'),
(329,13,'user','ga ada','user_13','2026-10-22 07:23:18','2026-10-22 07:23:18'),
(330,13,'assistant','Tentu saja, seneng bisa ngobrol bareng. Ingin ngebahas topik apa ya? Misalnya soal divisi apa yang menarik buat kamu, atau event-event eksklusif Aozora Nihongo Club yang pernah dilangsungkan? 🌸','user_13','2026-10-22 07:25:09','2026-10-22 07:25:09'),
(331,13,'user','hai','user_13','2026-10-22 07:30:02','2026-10-22 07:30:02'),
(333,13,'user','hai','user_13','2026-10-22 07:32:10','2026-10-22 07:32:10'),
(335,13,'assistant','Konnichiwa! 🌸 Halo! Ada yang bisa saya bantu hari ini? 😊','user_13','2026-10-22 07:32:20','2026-10-22 07:32:20'),
(336,13,'user','nama sensei siapa?','user_13','2026-10-22 07:32:28','2026-10-22 07:32:28'),
(337,13,'assistant','Sensei Aozora Nihongo Club adalah Bu Kikie Astri Mahdalika S.Pd (Guru Pembina). Tapi jika ada pertanyaan spesifik tentang pengurus, saya bisa bantu menjawabnya dengan lebih detail! 🌸','user_13','2026-10-22 07:32:39','2026-10-22 07:32:39'),
(342,16,'user','halo','user_16','2026-10-22 08:00:39','2026-10-22 08:00:39'),
(343,16,'assistant','Konnichiwa! 🌸 Halo! Senang ketemu kamu. Ada yang ingin kamu tanyakan seputar Aozora Nihongo Club hari ini? 😊','user_16','2026-10-22 08:00:46','2026-10-22 08:00:46'),
(344,16,'user','siapa nama ketua aozora','user_16','2026-10-22 08:00:58','2026-10-22 08:00:58'),
(345,16,'assistant','Ketua Umum Aozora Nihongo Club adalah Tegar Satrio Utomo (XI PPLG 2).','user_16','2026-10-22 08:01:07','2026-10-22 08:01:07'),
(346,18,'user','Divisi kegiatan apa saja yang ada di Aozora?','user_18','2026-10-22 08:21:54','2026-10-22 08:21:54'),
(347,18,'assistant','Dari data yang diberikan, terdapat beberapa divisi khusus untuk ekstrakulikuler Aozora Nihongo Club. Berikut adalah daftar divisi resmi yang disebutkan:\n\n1. Pemateri\n2. Kegiatan\n3. Budaya Bahasa\n4. PDD (Pendidikan dan Daya Dhuwur)\n5. Mediakom\n6. Perkapita\n\nJadi, Aozora Nihongo Club memiliki enam divisi kegiatan yang terdaftar dalam organisasi ini.','user_18','2026-10-22 08:23:06','2026-10-22 08:23:06');
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `event_documentations`
--

DROP TABLE IF EXISTS `event_documentations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_documentations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) unsigned NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) NOT NULL DEFAULT 'image',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_documentations_event_id_foreign` (`event_id`),
  CONSTRAINT `event_documentations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_documentations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `event_documentations` WRITE;
/*!40000 ALTER TABLE `event_documentations` DISABLE KEYS */;
INSERT INTO `event_documentations` VALUES
(1,15,'event-documentations/forum-rutin-18-septermber-2025/001_20250918_155955.jpg',NULL,'image','2025-09-18 23:57:55','2025-09-18 23:57:55'),
(2,15,'event-documentations/forum-rutin-18-septermber-2025/002_20250918_160044.jpg',NULL,'image','2025-09-18 23:57:57','2025-09-18 23:57:57'),
(3,15,'event-documentations/forum-rutin-18-septermber-2025/003_20250918_155514.jpg',NULL,'image','2025-09-18 23:57:58','2025-09-18 23:57:58'),
(4,15,'event-documentations/forum-rutin-18-septermber-2025/004_20250918_155522.jpg',NULL,'image','2025-09-18 23:57:59','2025-09-18 23:57:59'),
(5,15,'event-documentations/forum-rutin-18-septermber-2025/005_20250918_155715.jpg',NULL,'image','2025-09-18 23:58:00','2025-09-18 23:58:00'),
(6,15,'event-documentations/forum-rutin-18-septermber-2025/006_20250918_155755.jpg',NULL,'image','2025-09-18 23:58:01','2025-09-18 23:58:01'),
(7,15,'event-documentations/forum-rutin-18-septermber-2025/007_20250918_155802.jpg',NULL,'image','2025-09-18 23:58:02','2025-09-18 23:58:02'),
(8,15,'event-documentations/forum-rutin-18-septermber-2025/008_20250918_155811.jpg',NULL,'image','2025-09-18 23:58:04','2025-09-18 23:58:04'),
(9,15,'event-documentations/forum-rutin-18-septermber-2025/009_20250918_160953.jpg',NULL,'image','2025-09-18 23:59:25','2025-09-18 23:59:25'),
(10,15,'event-documentations/forum-rutin-18-septermber-2025/010_20250918_160957.jpg',NULL,'image','2025-09-18 23:59:26','2025-09-18 23:59:26'),
(11,15,'event-documentations/forum-rutin-18-septermber-2025/011_20250918_161043.jpg',NULL,'image','2025-09-18 23:59:27','2025-09-18 23:59:27'),
(12,15,'event-documentations/forum-rutin-18-septermber-2025/012_20250918_161254.jpg',NULL,'image','2025-09-18 23:59:28','2025-09-18 23:59:28'),
(13,15,'event-documentations/forum-rutin-18-septermber-2025/013_20250918_161332.jpg',NULL,'image','2025-09-18 23:59:29','2025-09-18 23:59:29'),
(14,15,'event-documentations/forum-rutin-18-septermber-2025/014_20250918_163006.jpg',NULL,'image','2025-09-18 23:59:31','2025-09-18 23:59:31'),
(15,15,'event-documentations/forum-rutin-18-septermber-2025/015_20250918_163012.jpg',NULL,'image','2025-09-18 23:59:32','2025-09-18 23:59:32'),
(16,15,'event-documentations/forum-rutin-18-septermber-2025/016_20250918_163016.jpg',NULL,'image','2025-09-18 23:59:33','2025-09-18 23:59:33'),
(17,15,'event-documentations/forum-rutin-18-septermber-2025/017_20250918_163755.jpg',NULL,'image','2025-09-18 23:59:34','2025-09-18 23:59:34'),
(18,15,'event-documentations/forum-rutin-18-septermber-2025/018_20250918_163953.jpg',NULL,'image','2025-09-18 23:59:35','2025-09-18 23:59:35'),
(19,15,'event-documentations/forum-rutin-18-septermber-2025/019_20250918_164000.jpg',NULL,'image','2025-09-18 23:59:37','2025-09-18 23:59:37'),
(20,15,'event-documentations/forum-rutin-18-septermber-2025/020_20250918_164937.jpg',NULL,'image','2025-09-19 00:04:07','2025-09-19 00:04:07'),
(21,15,'event-documentations/forum-rutin-18-septermber-2025/021_20250918_164945.jpg',NULL,'image','2025-09-19 00:04:08','2025-09-19 00:04:08'),
(22,15,'event-documentations/forum-rutin-18-septermber-2025/022_20250918_165802.jpg',NULL,'image','2025-09-19 00:04:09','2025-09-19 00:04:09'),
(23,15,'event-documentations/forum-rutin-18-septermber-2025/023_20250918_165806.jpg',NULL,'image','2025-09-19 00:04:11','2025-09-19 00:04:11'),
(24,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_161419.mp4',NULL,'video','2025-09-18 23:59:29','2025-09-18 23:59:29'),
(25,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_161447.mp4',NULL,'video','2025-09-18 23:59:30','2025-09-18 23:59:30'),
(26,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_163121.mp4',NULL,'video','2025-09-18 23:59:33','2025-09-18 23:59:33'),
(27,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_163144.mp4',NULL,'video','2025-09-18 23:59:33','2025-09-18 23:59:33'),
(28,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_163233.mp4',NULL,'video','2025-09-18 23:59:33','2025-09-18 23:59:33'),
(29,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_163803.mp4',NULL,'video','2025-09-18 23:59:34','2025-09-18 23:59:34'),
(30,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_163824.mp4',NULL,'video','2025-09-18 23:59:34','2025-09-18 23:59:34'),
(31,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_163852.mp4',NULL,'video','2025-09-18 23:59:34','2025-09-18 23:59:34'),
(32,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_164003.mp4',NULL,'video','2025-09-18 23:59:37','2025-09-18 23:59:37'),
(33,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_170041.mp4',NULL,'video','2025-09-19 00:04:06','2025-09-19 00:04:06'),
(34,15,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_15_-orum--utin-18--eptermber-2025/20250918_165816.mp4',NULL,'video','2025-09-19 00:04:11','2025-09-19 00:04:11'),
(35,16,'event-documentations/orasi-calon-ketua-anc/001_20250925_161752.jpg',NULL,'image','2025-09-28 21:32:35','2025-09-28 21:32:35'),
(36,16,'event-documentations/orasi-calon-ketua-anc/002_20250925_161835.jpg',NULL,'image','2025-09-28 21:32:35','2025-09-28 21:32:35'),
(37,16,'event-documentations/orasi-calon-ketua-anc/003_20250925_161842.jpg',NULL,'image','2025-09-28 21:32:35','2025-09-28 21:32:35'),
(38,16,'event-documentations/orasi-calon-ketua-anc/004__DSC0013.JPG',NULL,'image','2025-09-28 21:54:05','2025-09-28 21:54:05'),
(39,16,'event-documentations/orasi-calon-ketua-anc/005__DSC0015.JPG',NULL,'image','2025-09-28 21:54:06','2025-09-28 21:54:06'),
(40,16,'event-documentations/orasi-calon-ketua-anc/006__DSC0016.JPG',NULL,'image','2025-09-28 21:54:06','2025-09-28 21:54:06'),
(41,16,'event-documentations/orasi-calon-ketua-anc/007__DSC0017.JPG',NULL,'image','2025-09-28 21:54:06','2025-09-28 21:54:06'),
(42,16,'event-documentations/orasi-calon-ketua-anc/008__DSC0018.JPG',NULL,'image','2025-09-28 21:54:07','2025-09-28 21:54:07'),
(43,16,'event-documentations/orasi-calon-ketua-anc/009__DSC0019.JPG',NULL,'image','2025-09-28 21:54:07','2025-09-28 21:54:07'),
(44,16,'event-documentations/orasi-calon-ketua-anc/010__DSC0020.JPG',NULL,'image','2025-09-28 21:54:08','2025-09-28 21:54:08'),
(45,16,'event-documentations/orasi-calon-ketua-anc/011__DSC0021.JPG',NULL,'image','2025-09-28 21:54:08','2025-09-28 21:54:08'),
(46,16,'event-documentations/orasi-calon-ketua-anc/012__DSC0022.JPG',NULL,'image','2025-09-28 21:54:09','2025-09-28 21:54:09'),
(47,16,'event-documentations/orasi-calon-ketua-anc/013__DSC0023.JPG',NULL,'image','2025-09-28 21:54:09','2025-09-28 21:54:09'),
(48,16,'event-documentations/orasi-calon-ketua-anc/014__DSC0024.JPG',NULL,'image','2025-09-28 21:54:10','2025-09-28 21:54:10'),
(49,16,'event-documentations/orasi-calon-ketua-anc/015__DSC0025.JPG',NULL,'image','2025-09-28 21:54:10','2025-09-28 21:54:10'),
(50,16,'event-documentations/orasi-calon-ketua-anc/016__DSC0026.JPG',NULL,'image','2025-09-28 21:54:11','2025-09-28 21:54:11'),
(51,16,'event-documentations/orasi-calon-ketua-anc/017__DSC0027.JPG',NULL,'image','2025-09-28 21:54:11','2025-09-28 21:54:11'),
(52,16,'event-documentations/orasi-calon-ketua-anc/018__DSC0028.JPG',NULL,'image','2025-09-28 21:54:11','2025-09-28 21:54:11'),
(53,16,'event-documentations/orasi-calon-ketua-anc/019__DSC0029.JPG',NULL,'image','2025-09-28 21:54:12','2025-09-28 21:54:12'),
(54,16,'event-documentations/orasi-calon-ketua-anc/020__DSC0030.JPG',NULL,'image','2025-09-28 21:54:12','2025-09-28 21:54:12'),
(55,16,'event-documentations/orasi-calon-ketua-anc/021__DSC0031.JPG',NULL,'image','2025-09-28 21:54:13','2025-09-28 21:54:13'),
(56,16,'event-documentations/orasi-calon-ketua-anc/022__DSC0032.JPG',NULL,'image','2025-09-28 21:54:13','2025-09-28 21:54:13'),
(57,16,'event-documentations/orasi-calon-ketua-anc/023__DSC0033.JPG',NULL,'image','2025-09-28 21:54:14','2025-09-28 21:54:14'),
(58,16,'event-documentations/orasi-calon-ketua-anc/024__DSC0154.JPG',NULL,'image','2025-09-28 21:55:44','2025-09-28 21:55:44'),
(59,16,'event-documentations/orasi-calon-ketua-anc/025__DSC0155.JPG',NULL,'image','2025-09-28 21:55:45','2025-09-28 21:55:45'),
(60,16,'event-documentations/orasi-calon-ketua-anc/026__DSC0156.JPG',NULL,'image','2025-09-28 21:55:46','2025-09-28 21:55:46'),
(61,16,'event-documentations/orasi-calon-ketua-anc/027__DSC0157.JPG',NULL,'image','2025-09-28 21:55:46','2025-09-28 21:55:46'),
(62,16,'event-documentations/orasi-calon-ketua-anc/028__DSC0158.JPG',NULL,'image','2025-09-28 21:55:47','2025-09-28 21:55:47'),
(63,16,'event-documentations/orasi-calon-ketua-anc/029__DSC0159.JPG',NULL,'image','2025-09-28 21:55:47','2025-09-28 21:55:47'),
(64,16,'event-documentations/orasi-calon-ketua-anc/030__DSC0160.JPG',NULL,'image','2025-09-28 21:55:47','2025-09-28 21:55:47'),
(65,16,'event-documentations/orasi-calon-ketua-anc/031__DSC0161.JPG',NULL,'image','2025-09-28 21:55:48','2025-09-28 21:55:48'),
(66,16,'event-documentations/orasi-calon-ketua-anc/032__DSC0162.JPG',NULL,'image','2025-09-28 21:55:48','2025-09-28 21:55:48'),
(67,16,'event-documentations/orasi-calon-ketua-anc/033__DSC0163.JPG',NULL,'image','2025-09-28 21:55:49','2025-09-28 21:55:49'),
(68,16,'event-documentations/orasi-calon-ketua-anc/034__DSC0164.JPG',NULL,'image','2025-09-28 21:55:49','2025-09-28 21:55:49'),
(69,16,'event-documentations/orasi-calon-ketua-anc/035__DSC0168.JPG',NULL,'image','2025-09-28 21:55:50','2025-09-28 21:55:50'),
(70,16,'event-documentations/orasi-calon-ketua-anc/036__DSC0169.JPG',NULL,'image','2025-09-28 21:55:50','2025-09-28 21:55:50'),
(71,16,'event-documentations/orasi-calon-ketua-anc/037__DSC0087.JPG',NULL,'image','2025-09-28 21:55:51','2025-09-28 21:55:51'),
(72,16,'event-documentations/orasi-calon-ketua-anc/038__DSC0088.JPG',NULL,'image','2025-09-28 21:55:51','2025-09-28 21:55:51'),
(73,16,'event-documentations/orasi-calon-ketua-anc/039__DSC0089.JPG',NULL,'image','2025-09-28 21:55:52','2025-09-28 21:55:52'),
(74,16,'event-documentations/orasi-calon-ketua-anc/040__DSC0090.JPG',NULL,'image','2025-09-28 21:55:52','2025-09-28 21:55:52'),
(75,16,'event-documentations/orasi-calon-ketua-anc/041__DSC0091.JPG',NULL,'image','2025-09-28 21:55:52','2025-09-28 21:55:52'),
(76,16,'event-documentations/orasi-calon-ketua-anc/042__DSC0092.JPG',NULL,'image','2025-09-28 21:55:53','2025-09-28 21:55:53'),
(77,16,'event-documentations/orasi-calon-ketua-anc/043__DSC0095.JPG',NULL,'image','2025-09-28 21:55:53','2025-09-28 21:55:53'),
(78,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162321.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(79,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162345.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(80,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162452.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(81,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162514.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(82,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162523.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(83,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162655.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(84,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162753.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(85,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_163043.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(86,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_163049.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(87,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_163200.mp4',NULL,'video','2025-09-28 21:32:33','2025-09-28 21:32:33'),
(88,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_163346.mp4',NULL,'video','2025-09-28 21:32:34','2025-09-28 21:32:34'),
(89,16,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_16_-rasi--alon--etua--/20250925_162153.mp4',NULL,'video','2025-09-28 21:32:35','2025-09-28 21:32:35'),
(90,17,'event-documentations/reorganisasi-anc-2025/001_20251004_145433.jpg',NULL,'image','2025-10-05 17:45:03','2025-10-05 17:45:03'),
(91,17,'event-documentations/reorganisasi-anc-2025/002_20251004_145435.jpg',NULL,'image','2025-10-05 17:45:03','2025-10-05 17:45:03'),
(92,17,'event-documentations/reorganisasi-anc-2025/003_20251004_145444.jpg',NULL,'image','2025-10-05 17:45:04','2025-10-05 17:45:04'),
(93,17,'event-documentations/reorganisasi-anc-2025/004_20251004_145453.jpg',NULL,'image','2025-10-05 17:45:04','2025-10-05 17:45:04'),
(94,17,'event-documentations/reorganisasi-anc-2025/005_20251004_145611.jpg',NULL,'image','2025-10-05 17:45:05','2025-10-05 17:45:05'),
(95,17,'event-documentations/reorganisasi-anc-2025/006_20251004_145632.jpg',NULL,'image','2025-10-05 17:45:05','2025-10-05 17:45:05'),
(96,17,'event-documentations/reorganisasi-anc-2025/007_20251004_145639.jpg',NULL,'image','2025-10-05 17:45:05','2025-10-05 17:45:05'),
(97,17,'event-documentations/reorganisasi-anc-2025/008_20251004_145745.jpg',NULL,'image','2025-10-05 17:45:06','2025-10-05 17:45:06'),
(98,17,'event-documentations/reorganisasi-anc-2025/009_20251004_145850.jpg',NULL,'image','2025-10-05 17:45:06','2025-10-05 17:45:06'),
(99,17,'event-documentations/reorganisasi-anc-2025/010_20251004_145854.jpg',NULL,'image','2025-10-05 17:45:06','2025-10-05 17:45:06'),
(100,17,'event-documentations/reorganisasi-anc-2025/011_20251004_145857.jpg',NULL,'image','2025-10-05 17:45:07','2025-10-05 17:45:07'),
(101,17,'event-documentations/reorganisasi-anc-2025/012_20251004_151429.jpg',NULL,'image','2025-10-05 17:45:07','2025-10-05 17:45:07'),
(102,17,'event-documentations/reorganisasi-anc-2025/013_20251004_151444.jpg',NULL,'image','2025-10-05 17:45:08','2025-10-05 17:45:08'),
(103,17,'event-documentations/reorganisasi-anc-2025/014_20251004_095608.jpg',NULL,'image','2025-10-05 17:45:08','2025-10-05 17:45:08'),
(104,17,'event-documentations/reorganisasi-anc-2025/015_20251004_095613.jpg',NULL,'image','2025-10-05 17:45:08','2025-10-05 17:45:08'),
(105,17,'event-documentations/reorganisasi-anc-2025/016_20251004_095618.jpg',NULL,'image','2025-10-05 17:45:09','2025-10-05 17:45:09'),
(106,17,'event-documentations/reorganisasi-anc-2025/017_20251004_095622.jpg',NULL,'image','2025-10-05 17:45:09','2025-10-05 17:45:09'),
(107,17,'event-documentations/reorganisasi-anc-2025/018_20251004_132859.jpg',NULL,'image','2025-10-05 17:45:09','2025-10-05 17:45:09'),
(108,17,'event-documentations/reorganisasi-anc-2025/019_20251004_132902.jpg',NULL,'image','2025-10-05 17:45:10','2025-10-05 17:45:10'),
(109,17,'event-documentations/reorganisasi-anc-2025/020_20251004_132906.jpg',NULL,'image','2025-10-05 17:45:10','2025-10-05 17:45:10'),
(110,17,'event-documentations/reorganisasi-anc-2025/021__DSC0045.JPG',NULL,'image','2025-10-05 17:51:47','2025-10-05 17:51:47'),
(111,17,'event-documentations/reorganisasi-anc-2025/022__DSC0046.JPG',NULL,'image','2025-10-05 17:51:48','2025-10-05 17:51:48'),
(112,17,'event-documentations/reorganisasi-anc-2025/023__DSC0047.JPG',NULL,'image','2025-10-05 17:51:48','2025-10-05 17:51:48'),
(113,17,'event-documentations/reorganisasi-anc-2025/024__DSC0048.JPG',NULL,'image','2025-10-05 17:51:49','2025-10-05 17:51:49'),
(114,17,'event-documentations/reorganisasi-anc-2025/025__DSC0049.JPG',NULL,'image','2025-10-05 17:51:49','2025-10-05 17:51:49'),
(115,17,'event-documentations/reorganisasi-anc-2025/026__DSC0050.JPG',NULL,'image','2025-10-05 17:51:50','2025-10-05 17:51:50'),
(116,17,'event-documentations/reorganisasi-anc-2025/027__DSC0005.JPG',NULL,'image','2025-10-05 17:51:50','2025-10-05 17:51:50'),
(117,17,'event-documentations/reorganisasi-anc-2025/028__DSC0008.JPG',NULL,'image','2025-10-05 17:51:51','2025-10-05 17:51:51'),
(118,17,'event-documentations/reorganisasi-anc-2025/029__DSC0010.JPG',NULL,'image','2025-10-05 17:51:51','2025-10-05 17:51:51'),
(119,17,'event-documentations/reorganisasi-anc-2025/030__DSC0011.JPG',NULL,'image','2025-10-05 17:51:52','2025-10-05 17:51:52'),
(120,17,'event-documentations/reorganisasi-anc-2025/031__DSC0012.JPG',NULL,'image','2025-10-05 17:51:52','2025-10-05 17:51:52'),
(121,17,'event-documentations/reorganisasi-anc-2025/032__DSC0016.JPG',NULL,'image','2025-10-05 17:51:52','2025-10-05 17:51:52'),
(122,17,'event-documentations/reorganisasi-anc-2025/033__DSC0017.JPG',NULL,'image','2025-10-05 17:51:53','2025-10-05 17:51:53'),
(123,17,'event-documentations/reorganisasi-anc-2025/034__DSC0018.JPG',NULL,'image','2025-10-05 17:51:53','2025-10-05 17:51:53'),
(124,17,'event-documentations/reorganisasi-anc-2025/035__DSC0020.JPG',NULL,'image','2025-10-05 17:51:54','2025-10-05 17:51:54'),
(125,17,'event-documentations/reorganisasi-anc-2025/036__DSC0022.JPG',NULL,'image','2025-10-05 17:51:54','2025-10-05 17:51:54'),
(126,17,'event-documentations/reorganisasi-anc-2025/037__DSC0028.JPG',NULL,'image','2025-10-05 17:51:55','2025-10-05 17:51:55'),
(127,17,'event-documentations/reorganisasi-anc-2025/038__DSC0029.JPG',NULL,'image','2025-10-05 17:51:55','2025-10-05 17:51:55'),
(128,17,'event-documentations/reorganisasi-anc-2025/039__DSC0030.JPG',NULL,'image','2025-10-05 17:51:56','2025-10-05 17:51:56'),
(129,17,'event-documentations/reorganisasi-anc-2025/040__DSC0031.JPG',NULL,'image','2025-10-05 17:51:56','2025-10-05 17:51:56'),
(130,17,'event-documentations/reorganisasi-anc-2025/041__DSC0157.JPG',NULL,'image','2025-10-05 18:00:07','2025-10-05 18:00:07'),
(131,17,'event-documentations/reorganisasi-anc-2025/042__DSC0158.JPG',NULL,'image','2025-10-05 18:00:08','2025-10-05 18:00:08'),
(132,17,'event-documentations/reorganisasi-anc-2025/043__DSC0159.JPG',NULL,'image','2025-10-05 18:00:08','2025-10-05 18:00:08'),
(133,17,'event-documentations/reorganisasi-anc-2025/044__DSC0051.JPG',NULL,'image','2025-10-05 18:00:09','2025-10-05 18:00:09'),
(134,17,'event-documentations/reorganisasi-anc-2025/045__DSC0052.JPG',NULL,'image','2025-10-05 18:00:09','2025-10-05 18:00:09'),
(135,17,'event-documentations/reorganisasi-anc-2025/046__DSC0053.JPG',NULL,'image','2025-10-05 18:00:09','2025-10-05 18:00:09'),
(136,17,'event-documentations/reorganisasi-anc-2025/047__DSC0056.JPG',NULL,'image','2025-10-05 18:00:10','2025-10-05 18:00:10'),
(137,17,'event-documentations/reorganisasi-anc-2025/048__DSC0057.JPG',NULL,'image','2025-10-05 18:00:10','2025-10-05 18:00:10'),
(138,17,'event-documentations/reorganisasi-anc-2025/049__DSC0058.JPG',NULL,'image','2025-10-05 18:00:11','2025-10-05 18:00:11'),
(139,17,'event-documentations/reorganisasi-anc-2025/050__DSC0063.JPG',NULL,'image','2025-10-05 18:00:11','2025-10-05 18:00:11'),
(140,17,'event-documentations/reorganisasi-anc-2025/051__DSC0064.JPG',NULL,'image','2025-10-05 18:00:12','2025-10-05 18:00:12'),
(141,17,'event-documentations/reorganisasi-anc-2025/052__DSC0065.JPG',NULL,'image','2025-10-05 18:00:12','2025-10-05 18:00:12'),
(142,17,'event-documentations/reorganisasi-anc-2025/053__DSC0068.JPG',NULL,'image','2025-10-05 18:00:13','2025-10-05 18:00:13'),
(143,17,'event-documentations/reorganisasi-anc-2025/054__DSC0069.JPG',NULL,'image','2025-10-05 18:00:13','2025-10-05 18:00:13'),
(144,17,'event-documentations/reorganisasi-anc-2025/055__DSC0070.JPG',NULL,'image','2025-10-05 18:00:14','2025-10-05 18:00:14'),
(145,17,'event-documentations/reorganisasi-anc-2025/056__DSC0075.JPG',NULL,'image','2025-10-05 18:00:14','2025-10-05 18:00:14'),
(146,17,'event-documentations/reorganisasi-anc-2025/057__DSC0078.JPG',NULL,'image','2025-10-05 18:00:15','2025-10-05 18:00:15'),
(147,17,'event-documentations/reorganisasi-anc-2025/058__DSC0080.JPG',NULL,'image','2025-10-05 18:00:15','2025-10-05 18:00:15'),
(148,17,'event-documentations/reorganisasi-anc-2025/059__DSC0081.JPG',NULL,'image','2025-10-05 18:00:15','2025-10-05 18:00:15'),
(149,17,'event-documentations/reorganisasi-anc-2025/060__DSC0083.JPG',NULL,'image','2025-10-05 18:00:16','2025-10-05 18:00:16'),
(150,17,'event-documentations/reorganisasi-anc-2025/061__DSC0157_1.JPG',NULL,'image','2025-10-05 18:01:08','2025-10-05 18:01:08'),
(151,17,'event-documentations/reorganisasi-anc-2025/062__DSC0158_1.JPG',NULL,'image','2025-10-05 18:01:08','2025-10-05 18:01:08'),
(152,17,'event-documentations/reorganisasi-anc-2025/063__DSC0159_1.JPG',NULL,'image','2025-10-05 18:01:08','2025-10-05 18:01:08'),
(153,17,'event-documentations/reorganisasi-anc-2025/064__DSC0051_1.JPG',NULL,'image','2025-10-05 18:01:09','2025-10-05 18:01:09'),
(154,17,'event-documentations/reorganisasi-anc-2025/065__DSC0052_1.JPG',NULL,'image','2025-10-05 18:01:09','2025-10-05 18:01:09'),
(155,17,'event-documentations/reorganisasi-anc-2025/066__DSC0053_1.JPG',NULL,'image','2025-10-05 18:01:10','2025-10-05 18:01:10'),
(156,17,'event-documentations/reorganisasi-anc-2025/067__DSC0056_1.JPG',NULL,'image','2025-10-05 18:01:10','2025-10-05 18:01:10'),
(157,17,'event-documentations/reorganisasi-anc-2025/068__DSC0057_1.JPG',NULL,'image','2025-10-05 18:01:11','2025-10-05 18:01:11'),
(158,17,'event-documentations/reorganisasi-anc-2025/069__DSC0058_1.JPG',NULL,'image','2025-10-05 18:01:11','2025-10-05 18:01:11'),
(159,17,'event-documentations/reorganisasi-anc-2025/070__DSC0063_1.JPG',NULL,'image','2025-10-05 18:01:12','2025-10-05 18:01:12'),
(160,17,'event-documentations/reorganisasi-anc-2025/071__DSC0064_1.JPG',NULL,'image','2025-10-05 18:01:12','2025-10-05 18:01:12'),
(161,17,'event-documentations/reorganisasi-anc-2025/072__DSC0065_1.JPG',NULL,'image','2025-10-05 18:01:13','2025-10-05 18:01:13'),
(162,17,'event-documentations/reorganisasi-anc-2025/073__DSC0068_1.JPG',NULL,'image','2025-10-05 18:01:13','2025-10-05 18:01:13'),
(163,17,'event-documentations/reorganisasi-anc-2025/074__DSC0069_1.JPG',NULL,'image','2025-10-05 18:01:13','2025-10-05 18:01:13'),
(164,17,'event-documentations/reorganisasi-anc-2025/075__DSC0070_1.JPG',NULL,'image','2025-10-05 18:01:14','2025-10-05 18:01:14'),
(165,17,'event-documentations/reorganisasi-anc-2025/076__DSC0075_1.JPG',NULL,'image','2025-10-05 18:01:15','2025-10-05 18:01:15'),
(166,17,'event-documentations/reorganisasi-anc-2025/077__DSC0078_1.JPG',NULL,'image','2025-10-05 18:01:15','2025-10-05 18:01:15'),
(167,17,'event-documentations/reorganisasi-anc-2025/078__DSC0080_1.JPG',NULL,'image','2025-10-05 18:01:15','2025-10-05 18:01:15'),
(168,17,'event-documentations/reorganisasi-anc-2025/079__DSC0081_1.JPG',NULL,'image','2025-10-05 18:01:16','2025-10-05 18:01:16'),
(169,17,'event-documentations/reorganisasi-anc-2025/080__DSC0083_1.JPG',NULL,'image','2025-10-05 18:01:16','2025-10-05 18:01:16'),
(170,17,'event-documentations/reorganisasi-anc-2025/081__DSC0272.JPG',NULL,'image','2025-10-05 18:03:01','2025-10-05 18:03:01'),
(171,17,'event-documentations/reorganisasi-anc-2025/082__DSC0273.JPG',NULL,'image','2025-10-05 18:03:02','2025-10-05 18:03:02'),
(172,17,'event-documentations/reorganisasi-anc-2025/083__DSC0274.JPG',NULL,'image','2025-10-05 18:03:02','2025-10-05 18:03:02'),
(173,17,'event-documentations/reorganisasi-anc-2025/084__DSC0275.JPG',NULL,'image','2025-10-05 18:03:03','2025-10-05 18:03:03'),
(174,17,'event-documentations/reorganisasi-anc-2025/085__DSC0276.JPG',NULL,'image','2025-10-05 18:03:03','2025-10-05 18:03:03'),
(175,17,'event-documentations/reorganisasi-anc-2025/086__DSC0278.JPG',NULL,'image','2025-10-05 18:03:04','2025-10-05 18:03:04'),
(176,17,'event-documentations/reorganisasi-anc-2025/087__DSC0168.JPG',NULL,'image','2025-10-05 18:03:04','2025-10-05 18:03:04'),
(177,17,'event-documentations/reorganisasi-anc-2025/088__DSC0169.JPG',NULL,'image','2025-10-05 18:03:05','2025-10-05 18:03:05'),
(178,17,'event-documentations/reorganisasi-anc-2025/089__DSC0170.JPG',NULL,'image','2025-10-05 18:03:05','2025-10-05 18:03:05'),
(179,17,'event-documentations/reorganisasi-anc-2025/090__DSC0172.JPG',NULL,'image','2025-10-05 18:03:05','2025-10-05 18:03:05'),
(180,17,'event-documentations/reorganisasi-anc-2025/091__DSC0173.JPG',NULL,'image','2025-10-05 18:03:06','2025-10-05 18:03:06'),
(181,17,'event-documentations/reorganisasi-anc-2025/092__DSC0182.JPG',NULL,'image','2025-10-05 18:03:06','2025-10-05 18:03:06'),
(182,17,'event-documentations/reorganisasi-anc-2025/093__DSC0183.JPG',NULL,'image','2025-10-05 18:03:07','2025-10-05 18:03:07'),
(183,17,'event-documentations/reorganisasi-anc-2025/094__DSC0184.JPG',NULL,'image','2025-10-05 18:03:07','2025-10-05 18:03:07'),
(184,17,'event-documentations/reorganisasi-anc-2025/095__DSC0185.JPG',NULL,'image','2025-10-05 18:03:08','2025-10-05 18:03:08'),
(185,17,'event-documentations/reorganisasi-anc-2025/096__DSC0186.JPG',NULL,'image','2025-10-05 18:03:08','2025-10-05 18:03:08'),
(186,17,'event-documentations/reorganisasi-anc-2025/097__DSC0187.JPG',NULL,'image','2025-10-05 18:03:09','2025-10-05 18:03:09'),
(187,17,'event-documentations/reorganisasi-anc-2025/098__DSC0188.JPG',NULL,'image','2025-10-05 18:03:09','2025-10-05 18:03:09'),
(188,17,'event-documentations/reorganisasi-anc-2025/099__DSC0190.JPG',NULL,'image','2025-10-05 18:03:10','2025-10-05 18:03:10'),
(189,17,'event-documentations/reorganisasi-anc-2025/100__DSC0191.JPG',NULL,'image','2025-10-05 18:03:10','2025-10-05 18:03:10'),
(190,17,'event-documentations/reorganisasi-anc-2025/101__DSC0349.JPG',NULL,'image','2025-10-05 18:05:59','2025-10-05 18:05:59'),
(191,17,'event-documentations/reorganisasi-anc-2025/102__DSC0286.JPG',NULL,'image','2025-10-05 18:06:00','2025-10-05 18:06:00'),
(192,17,'event-documentations/reorganisasi-anc-2025/103__DSC0288.JPG',NULL,'image','2025-10-05 18:06:00','2025-10-05 18:06:00'),
(193,17,'event-documentations/reorganisasi-anc-2025/104__DSC0291.JPG',NULL,'image','2025-10-05 18:06:01','2025-10-05 18:06:01'),
(194,17,'event-documentations/reorganisasi-anc-2025/105__DSC0292.JPG',NULL,'image','2025-10-05 18:06:01','2025-10-05 18:06:01'),
(195,17,'event-documentations/reorganisasi-anc-2025/106__DSC0293.JPG',NULL,'image','2025-10-05 18:06:02','2025-10-05 18:06:02'),
(196,17,'event-documentations/reorganisasi-anc-2025/107__DSC0294.JPG',NULL,'image','2025-10-05 18:06:02','2025-10-05 18:06:02'),
(197,17,'event-documentations/reorganisasi-anc-2025/108__DSC0295.JPG',NULL,'image','2025-10-05 18:06:03','2025-10-05 18:06:03'),
(198,17,'event-documentations/reorganisasi-anc-2025/109__DSC0296.JPG',NULL,'image','2025-10-05 18:06:03','2025-10-05 18:06:03'),
(199,17,'event-documentations/reorganisasi-anc-2025/110__DSC0297.JPG',NULL,'image','2025-10-05 18:06:04','2025-10-05 18:06:04'),
(200,17,'event-documentations/reorganisasi-anc-2025/111__DSC0298.JPG',NULL,'image','2025-10-05 18:06:04','2025-10-05 18:06:04'),
(201,17,'event-documentations/reorganisasi-anc-2025/112__DSC0309.JPG',NULL,'image','2025-10-05 18:06:05','2025-10-05 18:06:05'),
(202,17,'event-documentations/reorganisasi-anc-2025/113__DSC0310.JPG',NULL,'image','2025-10-05 18:06:05','2025-10-05 18:06:05'),
(203,17,'event-documentations/reorganisasi-anc-2025/114__DSC0311.JPG',NULL,'image','2025-10-05 18:06:06','2025-10-05 18:06:06'),
(204,17,'event-documentations/reorganisasi-anc-2025/115__DSC0332.JPG',NULL,'image','2025-10-05 18:06:06','2025-10-05 18:06:06'),
(205,17,'event-documentations/reorganisasi-anc-2025/116__DSC0333.JPG',NULL,'image','2025-10-05 18:06:07','2025-10-05 18:06:07'),
(206,17,'event-documentations/reorganisasi-anc-2025/117__DSC0337.JPG',NULL,'image','2025-10-05 18:06:07','2025-10-05 18:06:07'),
(207,17,'event-documentations/reorganisasi-anc-2025/118__DSC0340.JPG',NULL,'image','2025-10-05 18:06:08','2025-10-05 18:06:08'),
(208,17,'event-documentations/reorganisasi-anc-2025/119__DSC0341.JPG',NULL,'image','2025-10-05 18:06:09','2025-10-05 18:06:09'),
(209,17,'event-documentations/reorganisasi-anc-2025/120__DSC0348.JPG',NULL,'image','2025-10-05 18:06:09','2025-10-05 18:06:09'),
(210,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_131213.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(211,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_131407.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(212,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_131431.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(213,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_131453.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(214,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_133337.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(215,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_133354.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(216,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_135101.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(217,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_135220.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(218,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_135751.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(219,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_140005.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(220,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_145156.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(221,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_095814.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(222,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_095835.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(223,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_095847.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(224,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_095910.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(225,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_100230.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(226,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_100635.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(227,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_100658.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(228,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_100711.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(229,17,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_17_-eorganisasi---2025/20251004_110833.mp4',NULL,'video','2025-10-05 17:48:15','2025-10-05 17:48:15'),
(230,18,'event-documentations/chanoyu/001_IMG_20251030_185034.jpg',NULL,'image','2025-11-17 17:13:49','2025-11-17 17:13:49'),
(231,18,'event-documentations/chanoyu/002_IMG_20251030_185159_0405.jpg',NULL,'image','2025-11-17 17:13:49','2025-11-17 17:13:49'),
(232,18,'event-documentations/chanoyu/003_IMG_20251030_184226.jpg',NULL,'image','2025-11-17 17:13:49','2025-11-17 17:13:49'),
(233,18,'event-documentations/chanoyu/004_IMG_20251030_184305.jpg',NULL,'image','2025-11-17 17:13:50','2025-11-17 17:13:50'),
(234,18,'event-documentations/chanoyu/005_IMG_20251030_164014 _1_.jpg',NULL,'image','2025-11-17 17:13:50','2025-11-17 17:13:50'),
(235,18,'event-documentations/chanoyu/006_IMG_20251030_184130.jpg',NULL,'image','2025-11-17 17:13:50','2025-11-17 17:13:50'),
(236,18,'event-documentations/chanoyu/007_IMG_20251030_19422525.jpg',NULL,'image','2025-11-17 17:15:04','2025-11-17 17:15:04'),
(237,18,'event-documentations/chanoyu/008_IMG_20251030_195951.jpg',NULL,'image','2025-11-17 17:15:05','2025-11-17 17:15:05'),
(238,18,'event-documentations/chanoyu/009_IMG20251030164204.jpg',NULL,'image','2025-11-17 17:15:05','2025-11-17 17:15:05'),
(239,18,'event-documentations/chanoyu/010_IMG20251030164335 _1_.jpg',NULL,'image','2025-11-17 17:15:05','2025-11-17 17:15:05'),
(240,18,'event-documentations/chanoyu/011_IMG20251030164335.jpg',NULL,'image','2025-11-17 17:15:06','2025-11-17 17:15:06'),
(241,18,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_18_-hanoyu/VID20251030155951_2.mp4',NULL,'video','2025-11-17 17:15:06','2025-11-17 17:15:06'),
(242,18,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_18_-hanoyu/VID20251030161925.mp4',NULL,'video','2025-11-17 18:28:50','2025-11-17 18:28:50'),
(243,18,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_18_-hanoyu/VID20251030164444_2.mp4',NULL,'video','2025-11-17 18:29:03','2025-11-17 18:29:03'),
(244,18,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_18_-hanoyu/VID20251030160612.mp4',NULL,'video','2025-11-17 18:29:17','2025-11-17 18:29:17'),
(245,18,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_18_-hanoyu/VID20251030161153.mp4',NULL,'video','2025-11-17 18:29:41','2025-11-17 18:29:41'),
(246,19,'event-documentations/forum-rutin-23-oktober-2025/001_IMG_20251023_160229.jpg',NULL,'image','2025-11-17 20:36:53','2025-11-17 20:36:53'),
(247,19,'event-documentations/forum-rutin-23-oktober-2025/002_IMG_20251026_163010.jpg',NULL,'image','2025-11-17 20:36:54','2025-11-17 20:36:54'),
(248,19,'event-documentations/forum-rutin-23-oktober-2025/003_IMG_20251026_163618.jpg',NULL,'image','2025-11-17 20:36:54','2025-11-17 20:36:54'),
(249,19,'event-documentations/forum-rutin-23-oktober-2025/004_IMG20251023161802.jpg',NULL,'image','2025-11-17 20:36:55','2025-11-17 20:36:55'),
(250,19,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_19_-orum--utin-23--ktober-2025/VID20251023162006_2.mp4',NULL,'video','2025-11-17 20:41:51','2025-11-17 20:41:51'),
(251,19,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_19_-orum--utin-23--ktober-2025/VID20251023160254_3.mp4',NULL,'video','2025-11-17 20:49:04','2025-11-17 20:49:04'),
(252,20,'event-documentations/forum-rutin-16-oktober-2025/001_IMG_8863.JPG',NULL,'image','2025-11-17 21:02:08','2025-11-17 21:02:08'),
(253,20,'event-documentations/forum-rutin-16-oktober-2025/002_IMG_8861.JPG',NULL,'image','2025-11-17 21:03:06','2025-11-17 21:03:06'),
(254,20,'event-documentations/forum-rutin-16-oktober-2025/003_IMG_8860.JPG',NULL,'image','2025-11-17 21:03:06','2025-11-17 21:03:06'),
(255,20,'event-documentations/forum-rutin-16-oktober-2025/004_IMG_8854.JPG',NULL,'image','2025-11-17 21:05:23','2025-11-17 21:05:23'),
(256,20,'event-documentations/forum-rutin-16-oktober-2025/005_IMG_8858.JPG',NULL,'image','2025-11-17 21:05:24','2025-11-17 21:05:24'),
(257,20,'event-documentations/forum-rutin-16-oktober-2025/006_IMG_8846.JPG',NULL,'image','2025-11-17 21:05:24','2025-11-17 21:05:24'),
(258,20,'event-documentations/forum-rutin-16-oktober-2025/007_IMG_8847.JPG',NULL,'image','2025-11-17 21:05:24','2025-11-17 21:05:24'),
(259,20,'event-documentations/forum-rutin-16-oktober-2025/008_IMG_20251016_181006.jpg',NULL,'image','2025-11-17 21:08:14','2025-11-17 21:08:14'),
(260,20,'event-documentations/forum-rutin-16-oktober-2025/009_IMG_8844.JPG',NULL,'image','2025-11-17 21:46:25','2025-11-17 21:46:25'),
(261,20,'event-documentations/forum-rutin-16-oktober-2025/010_IMG_8846_1.JPG',NULL,'image','2025-11-17 21:46:25','2025-11-17 21:46:25'),
(262,20,'event-documentations/forum-rutin-16-oktober-2025/011_IMG_8847_1.JPG',NULL,'image','2025-11-17 21:46:26','2025-11-17 21:46:26'),
(263,20,'event-documentations/forum-rutin-16-oktober-2025/012_IMG_8854_1.JPG',NULL,'image','2025-11-17 21:46:26','2025-11-17 21:46:26'),
(264,20,'event-documentations/forum-rutin-16-oktober-2025/013_IMG_8858_1.JPG',NULL,'image','2025-11-17 21:46:27','2025-11-17 21:46:27'),
(265,20,'event-documentations/forum-rutin-16-oktober-2025/014_IMG_8841.JPG',NULL,'image','2025-11-17 21:46:31','2025-11-17 21:46:31'),
(266,21,'event-documentations/forum-rutin-6-november-2025/001_IMG_9462.JPG',NULL,'image','2025-11-19 05:42:13','2025-11-19 05:42:13'),
(267,21,'event-documentations/forum-rutin-6-november-2025/002_IMG_9449.jpg',NULL,'image','2025-11-19 05:42:27','2025-11-19 05:42:27'),
(268,21,'event-documentations/forum-rutin-6-november-2025/003_IMG_9443.JPG',NULL,'image','2025-11-19 05:42:27','2025-11-19 05:42:27'),
(269,21,'event-documentations/forum-rutin-6-november-2025/004_IMG_9441.JPG',NULL,'image','2025-11-19 05:42:42','2025-11-19 05:42:42'),
(270,21,'event-documentations/forum-rutin-6-november-2025/005_IMG_20251106_161644_0648.jpg',NULL,'image','2025-11-19 06:11:26','2025-11-19 06:11:26'),
(271,21,'event-documentations/forum-rutin-6-november-2025/006_IMG_20251106_164542_0339 _1_.jpg',NULL,'image','2025-11-19 06:11:26','2025-11-19 06:11:26'),
(272,21,'event-documentations/forum-rutin-6-november-2025/007_IMG_20251106_170117_0123.jpg',NULL,'image','2025-11-19 06:11:27','2025-11-19 06:11:27'),
(273,22,'event-documentations/buka-bersama/001_DSC_0633.JPG',NULL,'image','2026-07-07 08:20:35','2026-07-07 08:20:35'),
(274,22,'event-documentations/buka-bersama/002_DSC_0591.JPG',NULL,'image','2026-07-07 08:20:36','2026-07-07 08:20:36'),
(275,22,'event-documentations/buka-bersama/003_DSC_0597.JPG',NULL,'image','2026-07-07 08:20:36','2026-07-07 08:20:36'),
(276,22,'event-documentations/buka-bersama/004_DSC_0605.JPG',NULL,'image','2026-07-07 08:20:36','2026-07-07 08:20:36'),
(277,22,'event-documentations/buka-bersama/005_DSC_0610.JPG',NULL,'image','2026-07-07 08:20:37','2026-07-07 08:20:37'),
(278,22,'event-documentations/buka-bersama/006_DSC_0612.JPG',NULL,'image','2026-07-07 08:20:37','2026-07-07 08:20:37'),
(279,22,'event-documentations/buka-bersama/007_DSC_0614.JPG',NULL,'image','2026-07-07 08:20:38','2026-07-07 08:20:38'),
(280,24,'event-documentations/ryouri-matsuri/001_IMG_5522.JPG',NULL,'image','2026-07-07 08:45:34','2026-07-07 08:45:34'),
(281,24,'event-documentations/ryouri-matsuri/002_DSC_0002.JPG',NULL,'image','2026-07-07 08:45:34','2026-07-07 08:45:34'),
(282,24,'event-documentations/ryouri-matsuri/003_DSC_0004.JPG',NULL,'image','2026-07-07 08:45:35','2026-07-07 08:45:35'),
(283,24,'event-documentations/ryouri-matsuri/004_DSC_0007.JPG',NULL,'image','2026-07-07 08:45:35','2026-07-07 08:45:35'),
(284,24,'event-documentations/ryouri-matsuri/005_DSC_0016.JPG',NULL,'image','2026-07-07 08:45:36','2026-07-07 08:45:36'),
(285,24,'event-documentations/ryouri-matsuri/006_DSC_0017.JPG',NULL,'image','2026-07-07 08:45:36','2026-07-07 08:45:36'),
(286,24,'event-documentations/ryouri-matsuri/007_DSC_0021.JPG',NULL,'image','2026-07-07 08:45:37','2026-07-07 08:45:37'),
(287,24,'event-documentations/ryouri-matsuri/008_DSC_0029.JPG',NULL,'image','2026-07-07 08:45:37','2026-07-07 08:45:37'),
(288,24,'event-documentations/ryouri-matsuri/009_DSC_0037.JPG',NULL,'image','2026-07-07 08:45:38','2026-07-07 08:45:38'),
(289,24,'event-documentations/ryouri-matsuri/010_DSC_0044.JPG',NULL,'image','2026-07-07 08:45:38','2026-07-07 08:45:38'),
(290,24,'event-documentations/ryouri-matsuri/011_DSC_0052.JPG',NULL,'image','2026-07-07 08:45:39','2026-07-07 08:45:39'),
(291,24,'event-documentations/ryouri-matsuri/012_DSC_0063.JPG',NULL,'image','2026-07-07 08:45:39','2026-07-07 08:45:39'),
(292,24,'event-documentations/ryouri-matsuri/013_DSC_0072.JPG',NULL,'image','2026-07-07 08:45:40','2026-07-07 08:45:40'),
(293,24,'event-documentations/ryouri-matsuri/014_DSC_0080.JPG',NULL,'image','2026-07-07 08:45:40','2026-07-07 08:45:40'),
(294,24,'event-documentations/ryouri-matsuri/015_DSC_0081.JPG',NULL,'image','2026-07-07 08:45:41','2026-07-07 08:45:41'),
(295,24,'event-documentations/ryouri-matsuri/016_DSC_0089.JPG',NULL,'image','2026-07-07 08:45:41','2026-07-07 08:45:41'),
(296,24,'event-documentations/ryouri-matsuri/017_DSC_0096.JPG',NULL,'image','2026-07-07 08:45:42','2026-07-07 08:45:42'),
(297,24,'event-documentations/ryouri-matsuri/018_DSC_0104.JPG',NULL,'image','2026-07-07 08:45:42','2026-07-07 08:45:42'),
(298,24,'event-documentations/ryouri-matsuri/019_DSC_0118.JPG',NULL,'image','2026-07-07 08:45:42','2026-07-07 08:45:42'),
(299,24,'event-documentations/ryouri-matsuri/020_DSC_0119.JPG',NULL,'image','2026-07-07 08:45:43','2026-07-07 08:45:43'),
(300,25,'event-documentations/trilingua/001_IMG_3609.JPG',NULL,'image','2026-07-07 08:55:32','2026-07-07 08:55:32'),
(301,26,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_26_forum-rutin-201125-shodou/VID_20251120_165758.mp4',NULL,'video','2026-07-07 08:49:26','2026-07-07 08:49:26'),
(302,26,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_26_forum-rutin-201125-shodou/VID20251120163737.mp4',NULL,'video','2026-07-07 08:49:27','2026-07-07 08:49:27'),
(303,26,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_26_forum-rutin-201125-shodou/VID_20251120_162022.mp4',NULL,'video','2026-07-07 08:49:27','2026-07-07 08:49:27'),
(304,26,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_26_forum-rutin-201125-shodou/VID_20251120_162818.mp4',NULL,'video','2026-07-07 08:49:27','2026-07-07 08:49:27'),
(305,26,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_26_forum-rutin-201125-shodou/VID_20251120_163557.mp4',NULL,'video','2026-07-07 08:49:27','2026-07-07 08:49:27'),
(306,26,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_26_forum-rutin-201125-shodou/VID_20251120_164314.mp4',NULL,'video','2026-07-07 08:49:27','2026-07-07 08:49:27'),
(307,27,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_27_forum-rutin-80126/VID20260108162021.mp4',NULL,'video','2026-07-07 08:58:31','2026-07-07 08:58:31'),
(308,28,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_28_forum-rutin-220126/video_20260122_160536.mp4',NULL,'video','2026-07-07 08:59:24','2026-07-07 08:59:24'),
(309,28,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_28_forum-rutin-220126/video_20260122_162957.mp4',NULL,'video','2026-07-07 08:59:24','2026-07-07 08:59:24'),
(310,28,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_28_forum-rutin-220126/video_20260122_163557.mp4',NULL,'video','2026-07-07 08:59:24','2026-07-07 08:59:24'),
(311,28,'https://aozora.fahrimandriva.web.id/dokumen/storage/events_28_forum-rutin-220126/video_20260122_163709.mp4',NULL,'video','2026-07-07 08:59:24','2026-07-07 08:59:24');
/*!40000 ALTER TABLE `event_documentations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `event_rundowns`
--

DROP TABLE IF EXISTS `event_rundowns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_rundowns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) unsigned NOT NULL,
  `time` time NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_rundowns_event_id_foreign` (`event_id`),
  CONSTRAINT `event_rundowns_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_rundowns`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `event_rundowns` WRITE;
/*!40000 ALTER TABLE `event_rundowns` DISABLE KEYS */;
INSERT INTO `event_rundowns` VALUES
(1,15,'15:30:00','Persiapan',NULL,'2026-10-22 07:36:24','2026-10-22 07:38:01'),
(2,15,'17:30:00','pulang',NULL,'2026-10-22 07:36:24','2026-10-22 07:38:01'),
(3,16,'15:30:00','Persiapan',NULL,'2026-10-22 07:36:48','2026-10-22 07:38:23'),
(4,16,'17:30:00','Pulang',NULL,'2026-10-22 07:36:48','2026-10-22 07:38:23'),
(5,17,'09:30:00','Persiapan',NULL,'2026-10-22 07:37:27','2026-10-22 07:41:06'),
(6,17,'15:30:00','Pulang',NULL,'2026-10-22 07:37:27','2026-10-22 07:41:06'),
(7,19,'15:30:00','Persiapan',NULL,'2026-10-22 07:39:14','2026-10-22 07:39:14'),
(8,19,'17:30:00','Pulang',NULL,'2026-10-22 07:39:14','2026-10-22 07:39:14'),
(9,20,'15:30:00','Persiapan',NULL,'2026-10-22 07:39:40','2026-10-22 07:39:52'),
(10,20,'17:30:00','Pulang',NULL,'2026-10-22 07:39:40','2026-10-22 07:39:52');
/*!40000 ALTER TABLE `event_rundowns` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `participants_info` varchar(255) DEFAULT NULL,
  `specific_location` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `status` enum('upcoming','completed') NOT NULL DEFAULT 'upcoming',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_aftermovie` tinyint(1) NOT NULL DEFAULT 0,
  `youtube_link` varchar(255) DEFAULT NULL,
  `gdrive_link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `visitor_access_instructions` text DEFAULT NULL,
  `location_assistance` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES
(15,'Forum Rutin 18 Septermber 2025','forum-rutin-18-septermber-2025','Forum & Diskusi','Pada forum kali ini materinya adalah \r\nYocchore（よっちょれ）Sastra Jepang Maranatha','2025-09-18','15:46:00','17:00:00','SMK Negeri 1 Purwokerto',NULL,NULL,'-7.4214266','109.2543831','event-documentations/forum-rutin-18-septermber-2025/001_20250918_155955.jpg','completed',1,1,'https://www.youtube.com/watch?v=JDTp_YQizqE',NULL,'2025-09-18 21:18:30','2026-10-22 07:38:01',NULL,NULL),
(16,'Orasi Calon Ketua ANC','orasi-calon-ketua-anc','Acara Besar','Orasi Calon Ketua ANC untuk melanjutkan ekstrakulier ini','2025-09-25','15:55:00','17:30:00','SMK Negeri 1 Purwokerto',NULL,NULL,'-7.4214266','109.2543831','event-documentations/orasi-calon-ketua-anc/001_20250925_161752.jpg','completed',1,0,NULL,NULL,'2025-09-28 21:30:21','2026-10-22 07:38:23',NULL,NULL),
(17,'Reorganisasi ANC 2025','reorganisasi-anc-2025','Acara Besar','📘 Reorganisasi ANC 2025\r\nSerah terima jabatan pengurus Aozora Nihongo Club, pengumuman ketua dan wakil baru, serta momen kebersamaan melalui games dan tukar kado.','2025-10-04','10:00:00','15:00:00','SMK Negeri 1 Purwokerto',NULL,'AII10','-7.4214266','109.2543831','event-documentations/reorganisasi-anc-2025/001_20251004_145433.jpg','completed',1,0,NULL,NULL,'2025-10-05 17:44:19','2026-10-22 07:41:06','Ketua Panitia Acara','Sebelah WS'),
(18,'Chanoyu','chanoyu','Acara Besar','Pada tanggal 23 Oktober 2025, Aozora Nihongo Club mengadakan forum mengenai Chanoyu. Jadi, apasih Chanoyu itu?? Chanoyu adalah upacara minum teh tradisional Jepang yang juga dikenal sebagai sadō atau chadō. Upacara ini merupakan seni persiapan dan penyajian matcha (teh hijau bubuk) secara seremonial dalam suasana yang tenang dan elegan, serta menekankan nilai-nilai harmoni, hormat, kemurnian, dan ketenangan.','2025-10-23','16:01:00','17:05:00','SMK Negeri 1 Purwokerto',NULL,NULL,'-7.4214266','109.2543831','event-documentations/chanoyu/001_IMG_20251030_185034.jpg','completed',1,0,NULL,NULL,'2025-11-17 17:02:56','2026-10-22 07:37:52',NULL,NULL),
(19,'Forum Rutin 23 Oktober 2025','forum-rutin-23-oktober-2025','Forum & Diskusi','Forum Rutin ekstrakulikuler Aozora Nihongo Club taggal 23 Oktober 2025.','2025-10-23','16:00:00','17:00:00','SMK Negeri 1 Purwokerto',NULL,NULL,'-7.4214266','109.2543831','event-documentations/forum-rutin-23-oktober-2025/001_IMG_20251023_160229.jpg','completed',1,0,NULL,NULL,'2025-11-17 20:27:35','2026-10-22 07:39:14',NULL,NULL),
(20,'Forum Rutin 16 Oktober 2025','forum-rutin-16-oktober-2025','Forum & Diskusi','Selain forum rutin, pada tanggal 16 Oktober juga merupakan hari yang spesial, karena forum pada tanggal ini merupakan forum terakhir para senpai kelas XII di ekstrakulikuler Aozora Nihongo Club.','2025-10-16','16:00:00','17:15:00','SMK Negeri 1 Purwokerto',NULL,NULL,'-7.4214266','109.2543831','event-documentations/forum-rutin-16-oktober-2025/001_IMG_8863.JPG','completed',1,0,NULL,NULL,'2025-11-17 20:55:38','2026-10-22 07:39:52',NULL,NULL),
(21,'Forum Rutin 6 November 2025','forum-rutin-6-november-2025','Forum & Diskusi','Forum Rutin Aozora Nihongo Club tanggal 6 November 2025.','2025-11-06','16:00:00','15:00:00','SMKN 1 Purwokerto',NULL,NULL,NULL,NULL,'event-documentations/forum-rutin-6-november-2025/001_IMG_9462.JPG','completed',1,0,NULL,NULL,'2025-11-19 05:21:21','2026-10-16 04:18:41',NULL,NULL),
(22,'Buka Bersama','buka-bersama','Acara Besar','Buka bersama untuk memperkuat persaudaraan antar anggota','2026-02-28','17:00:00','20:00:00','D\' Best Cafe & Resto mas',NULL,NULL,NULL,NULL,'event-documentations/buka-bersama/001_DSC_0633.JPG','completed',0,0,NULL,NULL,'2026-07-04 12:37:52','2026-10-16 04:18:41',NULL,NULL),
(24,'Ryouri Matsuri','ryouri-matsuri','Acara Besar','Ryouri Matsuri (料理祭り) merujuk pada festival atau kompetisi yang secara khusus merayakan kuliner Jepang. Di Indonesia, acara ini sering diadakan sebagai bagian dari festival budaya Jepang (Bunkasai) atau pentas seni sekolah, di mana para siswa atau peserta berlomba menyajikan kreasi hidangan tradisional dan modern terbaik.','2026-04-04','08:00:00','12:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,'event-documentations/ryouri-matsuri/001_IMG_5522.JPG','completed',0,0,NULL,NULL,'2026-07-04 12:44:01','2026-10-16 04:18:41',NULL,NULL),
(25,'Trilingua','trilingua','Acara Besar','Menyatukan beberapa ekstrakulikuler bahasa di smk','2026-02-09','08:00:00','12:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,'event-documentations/trilingua/001_IMG_3609.JPG','upcoming',0,0,NULL,NULL,'2026-07-04 12:45:40','2026-10-16 04:18:41',NULL,NULL),
(26,'Forum Rutin 20/11/25 Shodou','forum-rutin-20-11-25-shodou','Forum & Diskusi','Forum Rutin','2025-11-20','15:00:00','17:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:30:14','2026-10-16 04:18:41',NULL,NULL),
(27,'Forum Rutin 8/01/26','forum-rutin-8-01-26','Forum & Diskusi','Forum Rutin','2026-01-08','15:00:00','17:31:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:31:45','2026-10-16 04:18:41',NULL,NULL),
(28,'Forum Rutin 22/01/26','forum-rutin-22-01-26','Forum & Diskusi','Forum Rutin','2026-01-22','15:00:00','17:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:32:58','2026-10-16 04:18:41',NULL,NULL),
(29,'Forum Rutin 29/01/26','forum-rutin-29-01-26','Forum & Diskusi','Forum Rutin','2026-01-29','15:00:00','17:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:33:53','2026-10-16 04:18:41',NULL,NULL),
(30,'Forum Rutin 15/01/26','forum-rutin-15-01-26','Forum & Diskusi','Forum Rutin','2026-01-15','15:00:00','15:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:36:34','2026-10-16 04:18:41',NULL,NULL),
(31,'Forum Rutin 12/02/26','forum-rutin-12-02-26','Forum & Diskusi','Forum Rutin','2026-02-12','15:00:00','17:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:37:58','2026-10-16 04:18:41',NULL,NULL),
(32,'Forum Rutin 09/04/26','forum-rutin-09-04-26','Forum & Diskusi','Forum Rutin','2026-04-09','15:00:00','17:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:39:28','2026-10-16 04:18:41',NULL,NULL),
(33,'Forum Rutin 7/05/26','forum-rutin-7-05-26','Forum & Diskusi','Forum Rutin','2026-05-07','15:00:00','17:00:00','SMK N 1 Purwokerto',NULL,NULL,NULL,NULL,NULL,'completed',0,0,NULL,NULL,'2026-07-07 08:40:32','2026-10-16 04:18:41',NULL,NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `inventaris_items`
--

DROP TABLE IF EXISTS `inventaris_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventaris_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT 'lainnya',
  `deskripsi` text DEFAULT NULL,
  `jumlah_total` int(11) NOT NULL DEFAULT 1,
  `jumlah_tersedia` int(11) NOT NULL DEFAULT 1,
  `kondisi` varchar(255) NOT NULL DEFAULT 'baik',
  `lokasi_penyimpanan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inventaris_items_kode_barang_unique` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventaris_items`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `inventaris_items` WRITE;
/*!40000 ALTER TABLE `inventaris_items` DISABLE KEYS */;
INSERT INTO `inventaris_items` VALUES
(1,'Kimono Yukata Wanita (Pink Sakura)','AOZ-CSP-001','cosplay','Yukata wanita motif bunga sakura pink lengkap dengan obi belt merah dan pita.',6,5,'baik','Lemari Kostum Aozora No. 1','inventaris/01M4YFDZM1B4KE9BCAM4GC22M8.jpg','2026-09-28 05:09:02','2026-10-15 00:29:42'),
(2,'Kimono Yukata Pria (Navy Seigaiha)','AOZ-CSP-002','cosplay','Yukata pria motif gelombang tradisional seigaiha navy dengan obi hitam.',4,5,'baik','Lemari Kostum Aozora No. 1','inventaris/01M4YFFHE5PWZ3JN9J2C96QTBD.jpg','2026-09-28 05:09:02','2026-10-19 04:35:45'),
(3,'Set Fude & Suzuri (Kuas & Tinta Shodo)','AOZ-SHD-001','alat_kaligrafi','Paket kuas kaligrafi fude berbagai ukuran dan wadah tinta batu suzuri.',10,8,'baik','Kotak Kaligrafi Rak B2',NULL,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(4,'Lampion Matsuri (Chochin Merah Jepang)','AOZ-MTR-001','properti_matsuri','Lampion gantung merah tulisan kanji Matsuri (祭り) untuk dekorasi stand bunkasai.',12,12,'baik','Gudang Ekstrakurikuler Box C1',NULL,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(5,'Tirai Noren Pintu Aozora (青空)','AOZ-MTR-002','properti_matsuri','Tirai kain belah noren khas kedai Jepang dengan sablon kanji 青空.',3,3,'baik','Gudang Ekstrakurikuler Box C1',NULL,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(6,'Speaker Portable Bluetooth Aozora','AOZ-ELK-001','elektronik','Speaker wireless 40W dengan 2 mic tanpa kabel untuk latihan anisong dan matsuri.',2,1,'baik','Lemari Elektronik Ruang OSIS',NULL,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(7,'Kipas Tari Sensu Tradisional (Emas/Merah)','AOZ-CSP-003','cosplay','Kipas lipat sensu untuk penampilan tarian yosakoi.',8,7,'rusak_ringan','Lemari Kostum Aozora No. 2',NULL,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(9,'Kuas dan Tinta','AOZ-LIRKPB','properti_matsuri','Kuas Shodo',1,1,'baik','BKK','inventaris/01M5GJ8P7K1WX7S6ZC6PGDPNFM.jpg','2026-10-22 08:05:34','2026-10-22 08:05:34');
/*!40000 ALTER TABLE `inventaris_items` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `condition` enum('good','broken') NOT NULL DEFAULT 'good',
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `laporan_kerusakan`
--

DROP TABLE IF EXISTS `laporan_kerusakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporan_kerusakan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inventaris_item_id` bigint(20) unsigned NOT NULL,
  `pelapor_user_id` bigint(20) unsigned NOT NULL,
  `deskripsi_kerusakan` text NOT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `catatan_koordinator` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_kerusakan_inventaris_item_id_foreign` (`inventaris_item_id`),
  KEY `laporan_kerusakan_pelapor_user_id_foreign` (`pelapor_user_id`),
  CONSTRAINT `laporan_kerusakan_inventaris_item_id_foreign` FOREIGN KEY (`inventaris_item_id`) REFERENCES `inventaris_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `laporan_kerusakan_pelapor_user_id_foreign` FOREIGN KEY (`pelapor_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan_kerusakan`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `laporan_kerusakan` WRITE;
/*!40000 ALTER TABLE `laporan_kerusakan` DISABLE KEYS */;
INSERT INTO `laporan_kerusakan` VALUES
(1,7,4,'Bilah bambu kedua dari kiri agak renggang saat dibuka cepat sewaktu latihan tari.',NULL,'pending',NULL,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(2,2,8,'Kimono','laporan_kerusakan/01M4YFMB9VAZF5DY0D2GQWPFR9.jpeg','pending',NULL,'2026-09-30 06:42:44','2026-10-15 00:50:33'),
(3,6,12,'-67','laporan_kerusakan/01M4YG7AMGTA1S8DJ7T70N6JKM.png','pending',NULL,'2026-10-15 00:43:32','2026-10-15 00:43:32'),
(4,2,1,'Otomatis: Barang rusak saat dikembalikan sejumlah 1 unit. Catatan: Kobong jirrrr AWOK AWOK AWOK','proofs/01M4Z81XH4JWRHXSWTX3Z6GM6G.jpg','pending',NULL,'2026-10-15 07:40:01','2026-10-15 07:40:01'),
(6,9,11,'Otomatis: Barang rusak saat dikembalikan sejumlah 1 unit. Catatan: HAncur','proofs/01M5GJDM112JMAP8GK6NBCFQPN.jpeg','selesai','sudah','2026-10-22 08:08:16','2026-10-22 08:08:44'),
(7,9,16,'Kuas nya rusak','laporan_kerusakan/01M5GJWSDNWDQN2VMQDFJ74Q2R.jpeg','pending',NULL,'2026-10-22 08:16:33','2026-10-22 08:16:33');
/*!40000 ALTER TABLE `laporan_kerusakan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `loans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `borrower_type` varchar(255) NOT NULL DEFAULT 'internal',
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `external_borrower_name` varchar(255) DEFAULT NULL,
  `external_borrower_origin` varchar(255) DEFAULT NULL,
  `inventaris_item_id` bigint(20) unsigned NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'borrowed',
  `condition_when_borrowed` varchar(255) NOT NULL DEFAULT 'good',
  `condition_when_returned` varchar(255) DEFAULT NULL,
  `returned_quantity_normal` int(11) DEFAULT 0,
  `returned_quantity_damaged` int(11) DEFAULT 0,
  `returned_quantity_lost` int(11) DEFAULT 0,
  `return_notes` text DEFAULT NULL,
  `borrow_proof_image` varchar(255) DEFAULT NULL,
  `return_proof_image` varchar(255) DEFAULT NULL,
  `recorded_by_id` bigint(20) unsigned DEFAULT NULL,
  `recorder_ip` varchar(255) DEFAULT NULL,
  `recorder_location` varchar(255) DEFAULT NULL,
  `return_recorded_by_id` bigint(20) unsigned DEFAULT NULL,
  `return_recorder_ip` varchar(255) DEFAULT NULL,
  `return_recorder_location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_user_id_foreign` (`user_id`),
  KEY `loans_recorded_by_id_foreign` (`recorded_by_id`),
  KEY `loans_return_recorded_by_id_foreign` (`return_recorded_by_id`),
  KEY `loans_inventaris_item_id_foreign` (`inventaris_item_id`),
  CONSTRAINT `loans_inventaris_item_id_foreign` FOREIGN KEY (`inventaris_item_id`) REFERENCES `inventaris_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `loans_recorded_by_id_foreign` FOREIGN KEY (`recorded_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loans_return_recorded_by_id_foreign` FOREIGN KEY (`return_recorded_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES
(1,'internal',11,NULL,NULL,2,NULL,1,'2026-10-15','2026-10-15','returned','Baik',NULL,0,1,0,'Kobong jirrrr AWOK AWOK AWOK','proofs/01M4Z80H6YEJG4E7ZP1A7A206R.jpg','proofs/01M4Z81XH4JWRHXSWTX3Z6GM6G.jpg',1,'182.2.74.69',NULL,1,'182.2.74.69',NULL,'2026-10-15 07:39:16','2026-10-15 07:40:01'),
(4,'external',NULL,'Galang','XII PPLG 2',9,NULL,1,'2026-10-22','2026-10-22','returned','Baik',NULL,0,1,0,'HAncur','proofs/01M5GJBE32BK77EREX1Q4GXAK2.jpeg','proofs/01M5GJDM112JMAP8GK6NBCFQPN.jpeg',11,'140.213.173.252',NULL,11,'140.213.173.252',NULL,'2026-10-22 08:07:04','2026-10-22 08:08:16');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_09_18_104623_create_events_table',1),
(5,'2026_09_18_104625_create_event_documentations_table',1),
(6,'2026_09_18_112447_add_featured_and_aftermovie_columns_to_events_table',1),
(7,'2026_09_18_115929_create_event_rundowns_table',1),
(8,'2026_09_18_115930_add_location_columns_to_events_table',1),
(9,'2026_09_18_122332_change_google_map_embed_url_to_lat_long_on_events_table',1),
(10,'2026_09_22_053618_create_penguruses_table',1),
(11,'2026_09_22_075402_make_avatar_nullable_in_penguruses_table',1),
(12,'2026_09_28_040942_create_permission_tables',1),
(13,'2026_09_28_041153_create_inventaris_items_table',1),
(14,'2026_09_28_041159_create_transaksi_inventaris_table',1),
(15,'2026_09_28_041203_create_laporan_kerusakan_table',1),
(16,'2026_09_24_013731_add_role_to_users_table',2),
(17,'2026_09_24_013937_create_items_table',2),
(18,'2026_09_24_013938_create_loans_table',2),
(19,'2026_09_24_021738_overhaul_loans_table',2),
(20,'2026_09_29_103106_update_loans_table_for_detailed_returns',2),
(21,'2026_09_29_103707_migrate_and_drop_role_column_from_users',2),
(22,'2026_09_30_061500_add_caption_to_event_documentations_table',3),
(23,'2026_09_30_062000_add_roles_pengurus_and_koordinator_kegiatan',4),
(24,'2026_10_01_020000_create_chat_messages_table',5),
(25,'2026_10_01_120000_create_user_token_usages_table',6),
(26,'2026_10_15_014600_update_loans_to_inventaris_items',7),
(27,'2026_10_19_101500_add_details_and_gdrive_to_events_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES
(1,'App\\Models\\User',1),
(2,'App\\Models\\User',2),
(3,'App\\Models\\User',3),
(4,'App\\Models\\User',4),
(2,'App\\Models\\User',5),
(5,'App\\Models\\User',6),
(7,'App\\Models\\User',7),
(6,'App\\Models\\User',8),
(4,'App\\Models\\User',9),
(1,'App\\Models\\User',10),
(4,'App\\Models\\User',10),
(1,'App\\Models\\User',11),
(4,'App\\Models\\User',11),
(4,'App\\Models\\User',12),
(4,'App\\Models\\User',13),
(4,'App\\Models\\User',14),
(4,'App\\Models\\User',15),
(4,'App\\Models\\User',16),
(4,'App\\Models\\User',17),
(4,'App\\Models\\User',18);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `penguruses`
--

DROP TABLE IF EXISTS `penguruses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `penguruses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `sub_jabatan` varchar(255) DEFAULT NULL,
  `divisi` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penguruses_user_id_foreign` (`user_id`),
  CONSTRAINT `penguruses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penguruses`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `penguruses` WRITE;
/*!40000 ALTER TABLE `penguruses` DISABLE KEYS */;
INSERT INTO `penguruses` VALUES
(1,'Tegar Satrio Utomo','XI PPLG 2','Ketua Umum','Leader / 会長','Pengurus Inti',NULL,NULL,1,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(2,'Deris Novaliza Khusnul Khotimah','XI TJKT 1','Wakil Ketua','Vice Leader / 副部長','Pengurus Inti',NULL,NULL,2,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(3,'Tika Ocha Anindita','XI AKL 2','Sekretaris 1','Pengurus Inti','Pengurus Inti',NULL,NULL,3,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(4,'Amellia Ramdhan Nelista','XI MPLB 2','Sekretaris 2','Pengurus Inti','Pengurus Inti',NULL,NULL,4,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(5,'Zinniroh Al Ashwani','XI AKL 1','Bendahara 1','Pengurus Inti','Pengurus Inti',NULL,NULL,5,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(6,'Fadillah Septi Lintang Ramadhani','XI TF 1','Bendahara 2','Pengurus Inti','Pengurus Inti',NULL,NULL,6,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(7,'Arindhia Syarafana A','XI TF 1','Humas 1','Pengurus Inti','Pengurus Inti',NULL,NULL,7,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(8,'Nur Ngaisatuzzahro','XI AKL 2','Humas 2','Pengurus Inti','Pengurus Inti',NULL,NULL,8,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(9,'Arkazora Abdullah Azzam','XI TJKT 2','Koordinator Pemateri','Koordinator Bidang','Pemateri',NULL,NULL,10,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(10,'Lyana Nur Awaliyah','XI MPLB 2','Koordinator Pemateri','Koordinator Bidang','Pemateri',NULL,NULL,11,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(11,'Faris Ammar Yasin','XI PPLG 3','Koordinator Kegiatan','Koordinator Bidang','Kegiatan',NULL,NULL,12,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(12,'Maghiezta Altha Funnisa','XI AKL 1','Koordinator Kegiatan','Koordinator Bidang','Kegiatan',NULL,NULL,13,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(13,'Naila Ajizah','XI TF 1','Koordinator Budaya Bahasa','Koordinator Bidang','Budaya Bahasa',NULL,NULL,14,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(14,'Zakia Sultonah','XI PM 2','Koordinator Budaya Bahasa','Koordinator Bidang','Budaya Bahasa',NULL,NULL,15,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(15,'Abiyyu Arma Wijaya','XI PM 2','Koordinator PDD','Koordinator Bidang','PDD',NULL,NULL,16,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(16,'Damara Ghivary Abrar','XI PPLG 3','Koordinator PDD','Koordinator Bidang','PDD',NULL,NULL,17,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(17,'Kayla Sandrina H','XI DKV 2','Koordinator Mediakom','Koordinator Bidang','Mediakom',NULL,NULL,18,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(18,'Queena Eksha Putri','XI DKV 1','Koordinator Mediakom','Koordinator Bidang','Mediakom',NULL,NULL,19,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(19,'Kayravinnia Secha Putri','XI PM 2','Koordinator Perkap','Koordinator Bidang','Perkap',NULL,NULL,20,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(20,'Muhammad Fikri Arrasyid','XI TJKT 2','Koordinator Perkap','Koordinator Bidang','Perkap',NULL,NULL,21,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(21,'Nailul Luna','XI MPLB 3','Anggota','Anggota Aktif','Pemateri',NULL,NULL,30,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(22,'Diandrasadhya Pramesti','XI PPLG 3','Anggota','Anggota Aktif','Pemateri',NULL,NULL,31,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(23,'Durotusalisah','XI MPLB 3','Anggota','Anggota Aktif','Pemateri',NULL,NULL,32,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(24,'Angga Riski Adi Pratama','XI TJKT 1','Anggota','Anggota Aktif','Pemateri',NULL,NULL,33,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(25,'Isnaini Ramadani Saputri','XI MPLB 3','Anggota','Anggota Aktif','Pemateri',NULL,NULL,34,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(26,'Hafidz Izaar Wiraaji','XI AKL 5','Anggota','Anggota Aktif','Pemateri',NULL,NULL,35,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(27,'Anisa Nur Hidayah','XI PM 1','Anggota','Anggota Aktif','Kegiatan',NULL,NULL,40,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(28,'Ajeng Aditiya Falsafah','XI AKL 2','Anggota','Anggota Aktif','Kegiatan',NULL,NULL,41,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(29,'Aini Eka Ramadhani','XI MPLB 3','Anggota','Anggota Aktif','Kegiatan',NULL,NULL,42,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(30,'Thaleta Indah Antari','XI AKL 2','Anggota','Anggota Aktif','Kegiatan',NULL,NULL,43,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(31,'Andhika Atha Pramoedya','XI MPLB 1','Anggota','Anggota Aktif','Kegiatan',NULL,NULL,44,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(32,'Reyshafa Armelia Rochmanto','XI MPLB 3','Anggota','Anggota Aktif','Kegiatan',NULL,NULL,45,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(33,'Nezya Eka Aulia','XI PM 1','Anggota','Anggota Aktif','Budaya Bahasa',NULL,NULL,50,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(34,'Nabila Putri Shira Nirbana','XI PM 2','Anggota','Anggota Aktif','Budaya Bahasa',NULL,NULL,51,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(35,'Anggi Novanda Restianti','XI MPLB 3','Anggota','Anggota Aktif','Budaya Bahasa',NULL,NULL,52,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(36,'Khairatul Kantika M','XI MPLB 3','Anggota','Anggota Aktif','Budaya Bahasa',NULL,NULL,53,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(37,'Bilqist Ainur Rokhman','XI AKL 1','Anggota','Anggota Aktif','Budaya Bahasa',NULL,NULL,54,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(38,'Rifki Putra P.','XI PPLG 1','Anggota','Anggota Aktif','PDD',NULL,NULL,60,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(39,'Alinda Salsabila Nadhifah','XI PM 2','Anggota','Anggota Aktif','PDD',NULL,NULL,61,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(40,'Khayati Juliana Putri','XI PM 2','Anggota','Anggota Aktif','PDD',NULL,NULL,62,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(41,'Alfino Nur Rafata','XI TJKT 2','Anggota','Anggota Aktif','PDD',NULL,NULL,63,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(42,'Ghaitsa Anika Zhaiyan','XI MPLB 3','Anggota','Anggota Aktif','Mediakom',NULL,NULL,70,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(43,'Mevin Saktia Ramadhan','XI DKV 2','Anggota','Anggota Aktif','Mediakom',NULL,NULL,71,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(44,'Belinda Jacellyne Queenshaina Indra','XI MPLB 2','Anggota','Anggota Aktif','Mediakom',NULL,NULL,72,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(45,'Thalita Aurelia Shalsavarella','XI DKV','Anggota','Anggota Aktif','Mediakom',NULL,NULL,73,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(46,'Ardyta Weningtyas Syahrien','XI MPLB 3','Anggota','Anggota Aktif','Mediakom',NULL,NULL,74,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(47,'Rafandi Ardiansyah','XI PPLG 1','Anggota','Anggota Aktif','Perkap',NULL,NULL,80,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(48,'Alfeda Faith Manggala Wijaya','XI PPLG 1','Anggota','Anggota Aktif','Perkap',NULL,NULL,81,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(49,'Devita Alviana','XI PM 1','Anggota','Anggota Aktif','Perkap',NULL,NULL,82,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(50,'Fairus Raditya Dananjaya','XI AKL 5','Anggota','Anggota Aktif','Perkap',NULL,NULL,83,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(51,'Deven Hawwary Raysha','XI PPLG 1','Anggota','Anggota Aktif','Perkap',NULL,NULL,84,'2026-09-28 05:09:02','2026-09-28 05:09:02'),
(52,'Akhyar Radithya Cahyadi','XI TJKT 1','Anggota','Anggota Aktif','Perkap',NULL,NULL,85,'2026-09-28 05:09:02','2026-09-28 05:09:02');
/*!40000 ALTER TABLE `penguruses` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,'view_event','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(2,'create_event','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(3,'edit_event','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(4,'delete_event','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(5,'view_user','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(6,'create_user','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(7,'edit_user','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(8,'delete_user','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(9,'view_pengurus','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(10,'create_pengurus','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(11,'edit_pengurus','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(12,'delete_pengurus','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(13,'view_role','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(14,'create_role','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(15,'edit_role','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(16,'delete_role','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(17,'view_inventaris','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(18,'create_inventaris','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(19,'edit_inventaris','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(20,'delete_inventaris','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(21,'view_transaksi','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(22,'create_transaksi','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(23,'view_laporan','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(24,'create_laporan','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(25,'update_status_laporan','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(26,'view_documentation','web','2026-09-29 23:14:10','2026-09-29 23:14:10'),
(27,'create_documentation','web','2026-09-29 23:14:10','2026-09-29 23:14:10'),
(28,'edit_documentation','web','2026-09-29 23:14:10','2026-09-29 23:14:10'),
(29,'delete_documentation','web','2026-09-29 23:14:10','2026-09-29 23:14:10');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(26,1),
(27,1),
(28,1),
(29,1),
(1,2),
(2,2),
(3,2),
(4,2),
(9,2),
(10,2),
(11,2),
(12,2),
(26,2),
(27,2),
(28,2),
(29,2),
(17,3),
(18,3),
(19,3),
(20,3),
(21,3),
(22,3),
(23,3),
(24,3),
(25,3),
(17,4),
(23,4),
(24,4),
(1,5),
(26,5),
(27,5),
(28,5),
(29,5),
(1,6),
(2,6),
(3,6),
(4,6),
(9,6),
(17,6),
(18,6),
(19,6),
(21,6),
(22,6),
(23,6),
(24,6),
(26,6),
(27,6),
(28,6),
(29,6),
(1,7),
(2,7),
(3,7),
(4,7),
(26,7);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'super_admin','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(2,'admin','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(3,'koordinator_inventaris','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(4,'anggota','web','2026-09-28 05:09:01','2026-09-28 05:09:01'),
(5,'pdd','web','2026-09-29 23:14:10','2026-09-29 23:14:10'),
(6,'pengurus','web','2026-09-30 06:18:01','2026-09-30 06:18:01'),
(7,'koordinator_kegiatan','web','2026-09-30 06:18:01','2026-09-30 06:18:01');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('0NAtt95L29w8kIVI1En7duFfJv8MtwraF4eRpvAp',14,'140.213.173.172','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJhMnhTS1FQcmRRa1lpd3dOOHh0bHAwb2RNdGdXUFpITEhCaUZpNkRjIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjE0LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2Fvem9yYS5zeW5jaHJvbGFicy5zaXRlIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1792628121),
('6hyGnptZz1XLApcejPj5aWbTRxrJw8zqeCWqrThQ',12,'114.10.16.96','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJISHlQUUVWblFjR1B3WUppYWJrVzhONVdrWVNXd2I5Ykh2NFlNUTA5IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2Fvem9yYS5zeW5jaHJvbGFicy5zaXRlXC9hbmdnb3RhXC9kYWZ0YXItaW52ZW50YXJpcyIsInJvdXRlIjoiZmlsYW1lbnQuYW5nZ290YS5yZXNvdXJjZXMuZGFmdGFyLWludmVudGFyaXMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEyLCJwYXNzd29yZF9oYXNoX3dlYiI6ImVkZjJlYmYyMjM3MTJhYzRiZGY4ZjkzZmRjZWEzMGUwMzhhM2ZmNWY3OWU3OGIwZTg3OTk1OWNlYzgzYzA3OGEiLCJ0YWJsZXMiOnsiYjIzNTRiYTM4YzRkZjAwYWE2NThiYTU5YjhhZTVhYTZfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmb3RvIiwibGFiZWwiOiJGb3RvIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWFfYmFyYW5nIiwibGFiZWwiOiJOYW1hIEJhcmFuZyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJrYXRlZ29yaSIsImxhYmVsIjoiS2F0ZWdvcmkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoianVtbGFoX3RlcnNlZGlhIiwibGFiZWwiOiJVbml0IFRlcnNlZGlhIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImtvbmRpc2kiLCJsYWJlbCI6IktvbmRpc2kiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibG9rYXNpX3BlbnlpbXBhbmFuIiwibGFiZWwiOiJUZW1wYXQgU2ltcGFuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCIyYmZkYzJkZGEzZGY2ZTNjM2VmZjg2NmNjODEyM2UyOV9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IlRhbmdnYWwgTGFwb3IiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZm90b19idWt0aSIsImxhYmVsIjoiQnVrdGkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaW52ZW50YXJpc0l0ZW0ubmFtYV9iYXJhbmciLCJsYWJlbCI6Ik5hbWEgQmFyYW5nIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN0YXR1cyIsImxhYmVsIjoiU3RhdHVzIExhcG9yYW4iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZGVza3JpcHNpX2tlcnVzYWthbiIsImxhYmVsIjoiS2VsdWhhbiBLZXJ1c2FrYW4iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2F0YXRhbl9rb29yZGluYXRvciIsImxhYmVsIjoiQmFsYXNhbiBLb29yZGluYXRvciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX19',1792631470),
('ahafTQuVpXEucA6cU5ncGiLwXjasbE7qxnqBZLOY',NULL,'64.233.173.238','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','eyJfdG9rZW4iOiJGOUxqbEsyQ3liZzFBUU93ZjZOOU1FT3BlOTdVYTl2MENXWDdFVFlIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvP2NoYXQ9b3BlbiIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792632100),
('AirbAtlWAmQeh0AOmGzD1eVWxz2xbkXoo8HhlzRK',NULL,'103.255.241.107','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiIwVjJsYzJlcFlkWXBkR0Y1NUowTU1JNDRZcEtzR2R1YllwM0NOb3VpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZSIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792631853),
('aUQUCE5PVeyYyvZS5MZSFuloFH8tuR6mhYqeN4Th',NULL,'64.233.173.238','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','eyJfdG9rZW4iOiJpWmxuaXdHcTJqN1BQYWdGTDFFaTE2cFhVNDR5eGRuMmFsVVZIQzVnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvP2NoYXQ9b3BlbiIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792632100),
('gPp5DAu8zPWhAqrmQaxrBPyO0w8GNXdvmWA3PwCW',10,'103.255.241.107','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJERW05YTdGMUpqbEZITjVDNDE2cmljTGdXTjdCMzNWdEpkNExMTkJvIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2Fvem9yYS5zeW5jaHJvbGFicy5zaXRlXC9hZG1pblwvZG9jdW1lbnRhdGlvbnNcL2V2ZW50LWRvY3VtZW50YXRpb25zIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuZG9jdW1lbnRhdGlvbnMuZXZlbnQtZG9jdW1lbnRhdGlvbnMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEwLCJwYXNzd29yZF9oYXNoX3dlYiI6IjU3MzliYTJiNDk2NWIxMDIzZDdjYTYxZjM1YmM5ODcyNjQ1MWIxY2VlNDZiZjNmMzk0YTY1MmM2NDdmMGYwZmEiLCJ0YWJsZXMiOnsiMDQzNGNlN2I2NGU5MWE4NWNhNzdlYjRhMDhkOWRjYjdfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwb3N0ZXJfcGF0aCIsImxhYmVsIjoiUG9zdGVyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRpdGxlIiwibGFiZWwiOiJKdWR1bCBFdmVudCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJldmVudF9kYXRlIiwibGFiZWwiOiJUYW5nZ2FsIFBlbGFrc2FuYWFuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImxvY2F0aW9uIiwibGFiZWwiOiJMb2thc2kiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3RhdHVzIiwibGFiZWwiOiJTdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV0sIjUyZjhiNjQxNDU0YjBmNDcxOTdiMDQ5ODM5NjhhYjFiX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiVGFuZ2dhbCBMYXBvciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmb3RvX2J1a3RpIiwibGFiZWwiOiJGb3RvIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImludmVudGFyaXNJdGVtLm5hbWFfYmFyYW5nIiwibGFiZWwiOiJOYW1hIEJhcmFuZyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwZWxhcG9yLm5hbWUiLCJsYWJlbCI6IlBlbGFwb3IiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3RhdHVzIiwibGFiZWwiOiJTdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZGVza3JpcHNpX2tlcnVzYWthbiIsImxhYmVsIjoiRGV0YWlsIEtlcnVzYWthbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjYXRhdGFuX2tvb3JkaW5hdG9yIiwibGFiZWwiOiJSZXNwb24gS29vcmRpbmF0b3IiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOmZhbHNlfV0sIjNlMzY4NzY4MTUwMWQ0NjU3YTc0ODkzOTcwNDc5ZGFlX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicG9zdGVyX3BhdGgiLCJsYWJlbCI6IlBvc3RlciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0aXRsZSIsImxhYmVsIjoiSnVkdWwgRXZlbnQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZXZlbnRfZGF0ZSIsImxhYmVsIjoiVGFuZ2dhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJsb2NhdGlvbiIsImxhYmVsIjoiTG9rYXNpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN0YXR1cyIsImxhYmVsIjoiU3RhdHVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2ZlYXR1cmVkIiwibGFiZWwiOiJVbmdndWxhbiBTYXR1YW4iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoieW91dHViZV9saW5rIiwibGFiZWwiOiJZb3VUdWJlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IkRpYnVhdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiNzExZDY4Y2I1MmYzMjQ5ZWYwMjBmZmIwOTY5ZGFhMWNfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmb3RvIiwibGFiZWwiOiJGb3RvIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWFfYmFyYW5nIiwibGFiZWwiOiJOYW1hIEJhcmFuZyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJrYXRlZ29yaSIsImxhYmVsIjoiS2F0ZWdvcmkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3Rva19pbmZvIiwibGFiZWwiOiJTdG9rIChUZXJzZWRpYSBcLyBUb3RhbCkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoia29uZGlzaSIsImxhYmVsIjoiS29uZGlzaSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJsb2thc2lfcGVueWltcGFuYW4iLCJsYWJlbCI6Ikxva2FzaSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9XSwiODgxYmQwODllZTVhMjAyODBkNGVlZmFmOWMzZmUxNzhfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJib3Jyb3dfcHJvb2ZfaW1hZ2UiLCJsYWJlbCI6IkJ1a3RpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImJvcnJvd2VyX25hbWUiLCJsYWJlbCI6IlBlbWluamFtIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImludmVudGFyaXNJdGVtLm5hbWFfYmFyYW5nIiwibGFiZWwiOiJCYXJhbmciLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicXVhbnRpdHkiLCJsYWJlbCI6IkptbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJib3Jyb3dfZGF0ZSIsImxhYmVsIjoiVGdsIFBpbmphbSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJyZXR1cm5fZGF0ZSIsImxhYmVsIjoiVGdsIEtlbWJhbGkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiQ3JlYXRlZCBhdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1cGRhdGVkX2F0IiwibGFiZWwiOiJVcGRhdGVkIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX1dLCIwMDBiOTA1ODYyODE4NDg3MTg2NTIyYmZhMjk3YjJmYl9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImJvcnJvd19wcm9vZl9pbWFnZSIsImxhYmVsIjoiQnVrdGkgUGluamFtIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImJvcnJvd2VyX25hbWUiLCJsYWJlbCI6IlBlbWluamFtIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImludmVudGFyaXNJdGVtLm5hbWFfYmFyYW5nIiwibGFiZWwiOiJCYXJhbmciLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicXVhbnRpdHkiLCJsYWJlbCI6IkptbCBEaXBpbmphbSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJib3Jyb3dfZGF0ZSIsImxhYmVsIjoiVGdsIFBpbmphbSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiZjZkYjc0ZGM4OWE1ZGIzNzJiZTc2NDgyNDZiODUzNWJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmaWxlX3BhdGgiLCJsYWJlbCI6IlByZXZpZXciLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZXZlbnQudGl0bGUiLCJsYWJlbCI6Ik5hbWEgRXZlbnQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2FwdGlvbiIsImxhYmVsIjoiS2V0ZXJhbmdhbiBcLyBDYXB0aW9uIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImZpbGVfdHlwZSIsImxhYmVsIjoiVGlwZSBNZWRpYSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJEaXVwbG9hZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiZTY0NDgzM2Y0ZTRlMDg3MTIzMTVkYTcxYjMzZmFjZDJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1hIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImVtYWlsIiwibGFiZWwiOiJFbWFpbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJyb2xlcy5uYW1lIiwibGFiZWwiOiJSb2xlIFwvIFBlcmFuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IlRlcmRhZnRhciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiMzUzMzZhODA4Nzc4ODM0Zjg5NDE3NDcxMTJjMjY0M2VfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1hIFJvbGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGVybWlzc2lvbnNfY291bnQiLCJsYWJlbCI6Ikp1bWxhaCBIYWsgQWtzZXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiRGlidWF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dfX0=',1792630423),
('HH5HaA3HurPSyHnJND2EXtZ6KzBTVzfVYgBhGoXo',18,'112.215.169.204','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJZbXB0U3NESWQ1OFNGV2FJOUFUOGlvMDRuUkhkUFphYkQ5cHVFYzJ2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvYXBpXC9jaGF0XC9oaXN0b3J5P3Nlc3Npb25faWQ9dXNlcl8xOCIsInJvdXRlIjoiY2hhdC5oaXN0b3J5In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjE4fQ==',1792632114),
('IIxqewb8RKDD3bgYkiXwPrhTkblJjVpt72PMx4p4',NULL,'88.99.6.85','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0','eyJfdG9rZW4iOiI0TlVuTTkzSlJnNkRWaW1PdHVlcHdKYkNXTDFyRmtTSDFLT1FMUEx1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZSIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792629875),
('J4NYUvNb2VIiFWpJVNlOgPqa6ZDYGOEYBNkcg9fZ',NULL,'112.215.169.204','Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:24.0) Gecko/20100101 Firefox/24.0 Chrome/80.0.3987.132 Safari/537.36','eyJfdG9rZW4iOiJhRVUzeUNhZFR5NDkxWW9RdURYNWoxZ1Vpc2lCUGxJSUNVekVkcDJKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvP2NoYXQ9b3BlbiIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792632226),
('jIrZ8Do34tZ3p8BMfYHuiNuZICTx9pvvOA5Qjae9',NULL,'140.213.173.252','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Safari/605.1.15','eyJfdG9rZW4iOiJLcEdJNXg2MTRtc2U0QXdLTlRObjRLb3RRZnhVN2lrSDBtd1FlSDByIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1792631661),
('jQ0gYzXIVQ3IhSVHc1l5DRzahRzJe9EUAfdsPccm',16,'140.213.173.252','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Safari/605.1.15','eyJfdG9rZW4iOiJKeUVSN3pybDg3UjBxTEpTZXc0cGZhU0NTeEFPQndWQ0pDbFg0cFJwIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2Fvem9yYS5zeW5jaHJvbGFicy5zaXRlIiwicm91dGUiOiJob21lIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxNiwicGFzc3dvcmRfaGFzaF93ZWIiOiIyZGJlYzQ4ZDU3ZDk3Y2IxNGE1OWNjYjliYzE3NjBiZWVlYTQyMGRiOTU0Y2E2YjQzODcxOGE3MmRhMDI4NGQ4IiwidGFibGVzIjp7ImIyMzU0YmEzOGM0ZGYwMGFhNjU4YmE1OWI4YWU1YWE2X2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZm90byIsImxhYmVsIjoiRm90byIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1hX2JhcmFuZyIsImxhYmVsIjoiTmFtYSBCYXJhbmciLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoia2F0ZWdvcmkiLCJsYWJlbCI6IkthdGVnb3JpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Imp1bWxhaF90ZXJzZWRpYSIsImxhYmVsIjoiVW5pdCBUZXJzZWRpYSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJrb25kaXNpIiwibGFiZWwiOiJLb25kaXNpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Imxva2FzaV9wZW55aW1wYW5hbiIsImxhYmVsIjoiVGVtcGF0IFNpbXBhbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiMmJmZGMyZGRhM2RmNmUzYzNlZmY4NjZjYzgxMjNlMjlfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJUYW5nZ2FsIExhcG9yIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImZvdG9fYnVrdGkiLCJsYWJlbCI6IkJ1a3RpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImludmVudGFyaXNJdGVtLm5hbWFfYmFyYW5nIiwibGFiZWwiOiJOYW1hIEJhcmFuZyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyBMYXBvcmFuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImRlc2tyaXBzaV9rZXJ1c2FrYW4iLCJsYWJlbCI6IktlbHVoYW4gS2VydXNha2FuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNhdGF0YW5fa29vcmRpbmF0b3IiLCJsYWJlbCI6IkJhbGFzYW4gS29vcmRpbmF0b3IiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV19LCJmaWxhbWVudCI6W119',1792631802),
('jQcEfIk0Koc8E8HqxGRyyibnQifaFL0Q07Lt6PpQ',NULL,'64.233.173.224','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','eyJfdG9rZW4iOiJaMDdIRDlVM2ZpNUx4WUJsamNTbG9URjVLTWlOQ0pmS2dXNzdRZ1JxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvP2NoYXQ9b3BlbiIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792632100),
('kZ0LcAlmgSNQPxOBcomr9zkTg34zQyMOWMcVa1Nu',NULL,'103.255.241.107','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI4M0ZIN3E3eEM2S2tCV0t2ZGRVSlo1MUhHalJmV0VCNDVjdW5QR3dPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvZXZlbnRcL2ZvcnVtLXJ1dGluLTYtbm92ZW1iZXItMjAyNSIsInJvdXRlIjoiZXZlbnQuZGV0YWlsIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1792628112),
('nRENev7IKlv82WvwGOa0ZUdIYlrSi5uLaiftLlke',NULL,'103.255.241.107','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJDTVZIVVhYTER6ekNKczE4WkJubzlGbm1RUzdnQkI0MmZKaG9xbE1NIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2Fvem9yYS5zeW5jaHJvbGFicy5zaXRlXC9ldmVudFwvZm9ydW0tcnV0aW4tMTYtb2t0b2Jlci0yMDI1Iiwicm91dGUiOiJldmVudC5kZXRhaWwifX0=',1792628258),
('nRNavU4HabivWlFNV7l0B4WZdCgHhLCJFnXBa7yi',NULL,'103.255.241.107','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Safari/605.1.15','eyJfdG9rZW4iOiJHY3RiVnRhTlRLbmJnQ3JtNWJLYWZ4SGpodVNzdlM5NXVZRmh1bkQ3IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1792629943),
('usjBaTLgqfuL6vMy5gm8h7XwDqRrvciWkFe0N3Og',NULL,'140.213.173.252','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Safari/605.1.15','eyJfdG9rZW4iOiJCWWV6MWl1cEJQaGxSVGsyZWVyd3lleVhKSU5JMFh2SWd1Z25TU0plIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZVwvYWRtaW5cL2xvZ2luIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5hdXRoLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1792631676),
('vohk1D8ib6oGgDvIb9D9SpUyOv6mmr5sd8qkdBF0',NULL,'182.2.51.236','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiIxSnR3QXQ0Q1RvUk96bDkxalZwSzRUUFhtOU5xYmI4RXFzeklJbHZvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZSIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792631899),
('zCAdtOkCnmvZ64Kx5npKIKtvbKwBUMDs3XIflquh',NULL,'103.255.241.107','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJzZktDS1JLcTNUTE5MVU9Pb3J3N2JvM0ZaWks5cElOdGpCMDM1Y1pWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hb3pvcmEuc3luY2hyb2xhYnMuc2l0ZSIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1792630308);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `transaksi_inventaris`
--

DROP TABLE IF EXISTS `transaksi_inventaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi_inventaris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inventaris_item_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `keterangan` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_inventaris_inventaris_item_id_foreign` (`inventaris_item_id`),
  KEY `transaksi_inventaris_user_id_foreign` (`user_id`),
  CONSTRAINT `transaksi_inventaris_inventaris_item_id_foreign` FOREIGN KEY (`inventaris_item_id`) REFERENCES `inventaris_items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_inventaris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_inventaris`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `transaksi_inventaris` WRITE;
/*!40000 ALTER TABLE `transaksi_inventaris` DISABLE KEYS */;
INSERT INTO `transaksi_inventaris` VALUES
(1,1,4,'keluar',1,'Peminjaman untuk sesi photoshoot promosi Matsuri','2026-09-26','2026-09-28 05:09:02','2026-09-28 05:09:02'),
(2,6,3,'keluar',1,'Latihan Anisong persiapan event','2026-09-27','2026-09-28 05:09:02','2026-09-28 05:09:02');
/*!40000 ALTER TABLE `transaksi_inventaris` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `user_token_usages`
--

DROP TABLE IF EXISTS `user_token_usages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_token_usages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `usage_date` date NOT NULL,
  `tokens_used` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_token_usages_user_id_usage_date_unique` (`user_id`,`usage_date`),
  KEY `user_token_usages_usage_date_index` (`usage_date`),
  CONSTRAINT `user_token_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token_usages`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `user_token_usages` WRITE;
/*!40000 ALTER TABLE `user_token_usages` DISABLE KEYS */;
INSERT INTO `user_token_usages` VALUES
(1,10,'2026-10-01',0,'2026-10-01 05:33:28','2026-10-01 05:33:28'),
(2,10,'2026-10-11',2882,'2026-10-11 08:23:56','2026-10-11 23:51:36'),
(3,11,'2026-10-11',350,'2026-10-11 09:35:04','2026-10-11 13:18:53'),
(4,1,'2026-10-11',35,'2026-10-11 23:55:09','2026-10-11 23:58:51'),
(5,1,'2026-10-12',347,'2026-10-12 00:00:03','2026-10-12 01:35:02'),
(6,11,'2026-10-12',1602,'2026-10-12 01:26:42','2026-10-12 13:02:20'),
(7,11,'2026-10-13',74,'2026-10-13 03:27:40','2026-10-13 15:15:15'),
(8,11,'2026-10-14',764,'2026-10-14 03:46:41','2026-10-14 23:57:42'),
(9,10,'2026-10-14',550,'2026-10-14 12:37:51','2026-10-14 23:55:18'),
(10,11,'2026-10-15',0,'2026-10-15 00:06:53','2026-10-15 00:06:53'),
(11,12,'2026-10-15',172,'2026-10-15 00:36:53','2026-10-15 00:37:25'),
(12,1,'2026-10-15',96,'2026-10-15 00:39:03','2026-10-15 00:41:42'),
(13,10,'2026-10-15',299,'2026-10-15 00:42:25','2026-10-15 11:21:53'),
(14,13,'2026-10-15',218,'2026-10-15 02:18:28','2026-10-15 02:43:34'),
(15,10,'2026-10-16',219,'2026-10-16 00:19:10','2026-10-16 00:20:09'),
(16,11,'2026-10-16',148,'2026-10-16 00:24:26','2026-10-16 05:50:22'),
(17,11,'2026-10-19',1086,'2026-10-19 03:31:54','2026-10-19 04:28:14'),
(18,10,'2026-10-19',260,'2026-10-19 04:11:24','2026-10-19 12:11:55'),
(19,14,'2026-10-19',0,'2026-10-19 04:32:01','2026-10-19 04:32:01'),
(20,10,'2026-10-20',154,'2026-10-20 10:58:07','2026-10-20 11:00:06'),
(21,11,'2026-10-20',0,'2026-10-20 12:55:38','2026-10-20 12:55:38'),
(22,15,'2026-10-21',0,'2026-10-21 20:52:19','2026-10-21 20:52:19'),
(23,12,'2026-10-21',402,'2026-10-21 21:40:20','2026-10-21 21:45:22'),
(24,10,'2026-10-21',24,'2026-10-21 21:40:26','2026-10-21 21:40:41'),
(25,13,'2026-10-22',185,'2026-10-22 07:18:47','2026-10-22 07:32:39'),
(26,11,'2026-10-22',135,'2026-10-22 07:30:02','2026-10-22 07:43:14'),
(27,16,'2026-10-22',69,'2026-10-22 07:45:53','2026-10-22 08:01:07'),
(28,17,'2026-10-22',0,'2026-10-22 08:06:31','2026-10-22 08:06:31'),
(29,12,'2026-10-22',0,'2026-10-22 08:10:57','2026-10-22 08:10:57'),
(30,18,'2026-10-22',122,'2026-10-22 08:21:39','2026-10-22 08:23:06');
/*!40000 ALTER TABLE `user_token_usages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Super Admin Aozora','admin@aozora.local',NULL,'$2y$12$OTxXeJM.pKysjTu4y6PZOuASCwDUKkGp/wW7674xbchZWuEsxK.Mq',NULL,'2026-09-28 05:09:01','2026-09-30 06:18:02'),
(2,'Admin Event','admin_event@aozora.local',NULL,'$2y$12$SMGRs830yqItK96POMpUC.FKfQPTauIP3hnLrQ74OArtqChAegOCS',NULL,'2026-09-28 05:09:02','2026-09-30 06:18:02'),
(3,'Koordinator Inventaris','inventaris@aozora.local',NULL,'$2y$12$DWe2S8bQFJVWfIrwFg3vlO3I9RXDN9Em9A5Wbl/vTBK8NXZGLv4fG',NULL,'2026-09-28 05:09:02','2026-09-30 06:18:03'),
(4,'Anggota Aozora','anggota@aozora.local',NULL,'$2y$12$gWw7e7VHN1CDMzytMmXFou4ff3rAL.5.p7uw/CoxE9lQt6q8Xn.Lm',NULL,'2026-09-28 05:09:02','2026-09-30 06:18:04'),
(5,'Admin Biasa','admin.biasa@aozora.local',NULL,'$2y$12$n.OYawN8aCLasGeE221Vue1O2ISygYHX1FDN4.NG/QhAPvuITHxrq',NULL,'2026-09-28 06:06:06','2026-09-30 06:18:03'),
(6,'Koordinator PDD','pdd@aozora.local',NULL,'$2y$12$zedelUubAhPboc4RgUEis.ghtiBHYwXNuusUYM92FytqbZuujeZne',NULL,'2026-09-29 23:14:13','2026-09-30 06:18:03'),
(7,'Koordinator Kegiatan','kegiatan@aozora.local',NULL,'$2y$12$DnDVHBgZahlHrmcjUJJxkuk2Wuh0N4kcEsyhjD1tlYIUHSkSK3Qge',NULL,'2026-09-30 06:18:03','2026-09-30 06:18:03'),
(8,'Pengurus Aozora','pengurus@aozora.local',NULL,'$2y$12$/HV0r8H/0rgASrq30a6VIOe46wjCT0hkUtyJ2dHhpJ.kv2RzpPkga',NULL,'2026-09-30 06:18:04','2026-09-30 06:18:04'),
(9,'noreply aozora','noreplyaozora@gmail.com',NULL,'$2y$12$6dbux7lGoBoiv41L6GzlTumzEjsVSObakDLCB0wpTvuuqUtMreawe','Us5XrvsZuhQVzx0AB7KD40UrRfmUbJqzF7fa0C8pGbR8aWxP694mWSJLBi7I','2026-10-01 02:25:27','2026-10-01 02:25:27'),
(10,'Galang M Sherinian','galangmaruff1@gmail.com',NULL,'$2y$12$TO81U/oeQhuMTwHR/TLveewjdDonzD78L4z7OY4UxSj/uhusTSDRC','NhHqlWssiN1JFljoNp62ku3xhgi8jy3uU9Af3NQxa76PfqWpo4ABqq7yEx0w','2026-10-01 02:35:33','2026-10-01 02:35:33'),
(11,'Fahri Mandriva','fahrimandriva138@gmail.com',NULL,'$2y$12$kqT2UIOhgvyYVBQ/pPWnz.OaZD.IIMGlDxlsGWBZGnlGeI6aIf3eu','J0Z5hVpesXSu3jB9Dq98LecCWV6JNNgTwLPHRzDEKKEHAg912Z8G3JBSjgSh','2026-10-11 09:35:03','2026-10-11 09:35:03'),
(12,'ENDERMAN Gaming','endermangaming066@gmail.com',NULL,'$2y$12$QWdmVsj8J9TwUXxc2C9zU.vVDWhHcS2I6uXFGyw4W5s/wV29NARCi','n9M55Mtct9l8bw801BEuLxHRkg6eoElXe0e73DAUc1RqiqPwkYZhDUQyakgu','2026-10-15 00:36:44','2026-10-15 00:36:44'),
(13,'antigravityradiant01','antigravityradiant01@gmail.com',NULL,'$2y$12$C4qwx.ijugJg0X5kd8mtnuewBc/jdeP/DsKuH2Kbw86/By8DIK7RK','X6p47LaLl3VxMby1RWqFdRTco88Y1tz37zOY4FY5iD6TBmQVCvukitqDYteD','2026-10-15 02:18:27','2026-10-15 02:18:27'),
(14,'Belajar','belajarajayok@gmail.com',NULL,'$2y$12$nBslO5.mmcuW5zR9gEnz2.2cyQ0RglxbSX2yZXZPiZTIfcY5epNQy','Jf6afio5BxP6Tsl45XBwlbEEJLeRmL521UVhTTT8vCmIG4ZUcsLdT2YKF2Uo','2026-10-19 04:31:59','2026-10-19 04:31:59'),
(15,'Amb Pt','ambpt433@gmail.com',NULL,'$2y$12$xotuioNq.nVFKKjyRqt0iOzwLjlvX24n3N//GBlnLxXF5Zj3BYlF.','yBYQ6rWG4zIFbHv0rYttDiFoGyaSDqkNMj5EoV3CkQbtbJyELoWg43nZnvE1','2026-10-21 20:52:16','2026-10-21 20:52:16'),
(16,'popil men07','popilm186@gmail.com',NULL,'$2y$12$FrZZq7yz4DeDOyX7qIMydObxcrrtnaeaWpf/4dCpyp.LjrJ1xcsc6','TxPiTddSKLkn8BbBnlNDaSo0jAi0N5qQHnbPm8eM6l7oga87XGHfIgl8ExEC','2026-10-22 07:45:52','2026-10-22 07:45:52'),
(17,'Amabsing Ar 60','amabsingar@gmail.com',NULL,'$2y$12$aupEkciOSNd8g6FZcnTwOOsV2YHEHVxQPPv0IRPvDwRJVt.Bj0pMG','OhHJQqbcjLAY2iNhAq0225duEbVnxvzn3odnzyhzVfUZR7vIUmnhfztXXgIM','2026-10-22 08:06:29','2026-10-22 08:06:29'),
(18,'Zed Haniin Waafi El Haq','zedhaniin@gmail.com',NULL,'$2y$12$hs//6JfxBhiiHxZRcL2IkO2DsouBODAq666W2L/PPAheK0nMiCt9a','T7SPqPIN5TuZHRxukj3TbqEELOOg7eSjgOtcCjFp8BjUmzr4O3s8ZS1LDz5u','2026-10-22 08:21:38','2026-10-22 08:21:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-10-22  1:24:52
