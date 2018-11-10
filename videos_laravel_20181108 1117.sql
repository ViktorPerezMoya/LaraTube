-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.32-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema videoslaravel
--

CREATE DATABASE IF NOT EXISTS videoslaravel;
USE videoslaravel;

--
-- Definition of table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(255) NOT NULL,
  `video_id` int(255) NOT NULL,
  `texto` text,
  `liked` int(11) DEFAULT NULL,
  `disliked` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comentario_video` (`video_id`),
  KEY `FK_comentario_ft_usuario` (`usuario_id`),
  CONSTRAINT `FK_comentario_ft_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_comentario_video` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comentario`
--

/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` (`id`,`usuario_id`,`video_id`,`texto`,`liked`,`disliked`,`created_at`,`updated_at`) VALUES 
 (3,1,4,'Un comentario',0,0,'2018-11-08 04:12:13','2018-11-08 04:12:13'),
 (4,2,4,'Me llamo luciano',0,0,'2018-11-08 04:36:46','2018-11-08 04:36:46');
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;


--
-- Definition of table `likecoentario`
--

DROP TABLE IF EXISTS `likecoentario`;
CREATE TABLE `likecoentario` (
  `comentario_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `like` tinyint(1) DEFAULT '0',
  `dislike` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`comentario_id`,`usuario_id`),
  KEY `FK_likecoentario_usuario` (`usuario_id`),
  CONSTRAINT `FK_likecoentario_comentario` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`id`),
  CONSTRAINT `FK_likecoentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likecoentario`
--

/*!40000 ALTER TABLE `likecoentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `likecoentario` ENABLE KEYS */;


--
-- Definition of table `likevideo`
--

DROP TABLE IF EXISTS `likevideo`;
CREATE TABLE `likevideo` (
  `video_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `like` tinyint(1) DEFAULT NULL,
  `dislike` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`video_id`,`usuario_id`),
  KEY `FK_likevideo_user` (`usuario_id`),
  CONSTRAINT `FK_likevideo_user` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_likevideo_video` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likevideo`
--

/*!40000 ALTER TABLE `likevideo` DISABLE KEYS */;
/*!40000 ALTER TABLE `likevideo` ENABLE KEYS */;


--
-- Definition of table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE `playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_playlist_rel_usuario` (`usuario_id`),
  CONSTRAINT `FK_playlist_rel_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_playlist_usaurio` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`rol`,`nombre`,`email`,`password`,`imagen`,`created_at`,`updated_at`,`remember_token`) VALUES 
 (1,'Admin','Victor Perez','victor.ariel.perez@gmail.com','$2y$10$P9kpx8r5HgoCHot1aVDId.//9/g.ip/dJ2s6tMBbqPOr4KkMb6A.S',NULL,'2018-11-04 14:51:34','2018-11-04 14:51:34','S22KkLYcnkNUnIMFo3ptcdWNC4sKEuimzNxrFqedgqhtZflA8StwZ15hzu8H'),
 (2,NULL,NULL,'luciano@gmail.com','$2y$10$SioeevN5ZYq5b432nqjyIuxNJWudky6PU0Y7HI/65zoeP2Qz9fHrm',NULL,'2018-11-08 04:36:26','2018-11-08 04:36:26',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Definition of table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_videos_usuarios` (`usuario_id`),
  KEY `fk_videos_playlist` (`playlist_id`),
  CONSTRAINT `fk_videos_playlist` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`),
  CONSTRAINT `fk_videos_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` (`id`,`usuario_id`,`titulo`,`descripcion`,`estado`,`imagen`,`video_path`,`playlist_id`,`created_at`,`updated_at`) VALUES 
 (1,1,'Video 1','Saludo',NULL,'1541632197goku_freezer.JPG','1541632197saludo_17_picoro.mp4',NULL,'2018-11-07 23:09:57','2018-11-07 23:09:57'),
 (2,1,'Video 2','dfasfd',NULL,'1541633741facebook_logo.png','1541633741saludo_17_picoro.mp4',NULL,'2018-11-07 23:35:41','2018-11-07 23:35:41'),
 (3,1,'Video 3','saadfas',NULL,'1541633792imagen1.jpg','1541633792saludo_17_picoro.mp4',NULL,'2018-11-07 23:36:32','2018-11-07 23:36:32'),
 (4,1,'17 se une al equipo del universo 7','A la espera del torneo los participantes del u 7 le dan la bienvenida a A17 y esperan nerviosos la llegada del decimo integrante.',NULL,'1541659026video_4.jpg','1541633849saludo_17_picoro.mp4',NULL,'2018-11-07 23:37:29','2018-11-08 06:37:06');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
