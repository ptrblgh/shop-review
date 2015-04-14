# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.13)
# Database: shop-review
# Generation Time: 2015-04-14 14:28:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table shop-review_review
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop-review_review`;

CREATE TABLE `shop-review_review` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `review_body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `review_rating` tinyint(1) unsigned NOT NULL,
  `review_edit_date` timestamp NULL DEFAULT NULL,
  `review_add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'user.username',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `review_add_date` (`review_add_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `shop-review_review` WRITE;
/*!40000 ALTER TABLE `shop-review_review` DISABLE KEYS */;

INSERT INTO `shop-review_review` (`id`, `review_body`, `review_rating`, `review_edit_date`, `review_add_date`, `username`)
VALUES
	(1,'A short one.',5,'2015-04-14 14:46:45','2015-04-13 13:10:20','testuser'),
	(2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',2,'2015-04-01 13:11:00','2015-04-01 13:11:00','testuser1'),
	(3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',4,'2015-04-03 13:11:00','2015-04-03 13:11:00','testuser2'),
	(4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',3,'2015-04-03 17:11:00','2015-04-03 17:11:00','testuser3'),
	(5,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',3,'2015-04-04 17:11:00','2015-04-04 17:11:00','testuser4'),
	(6,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',2,'2015-04-05 17:11:00','2015-04-05 17:11:00','testuser5'),
	(7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',1,'2015-04-06 17:11:00','2015-04-06 17:11:00','testuser6'),
	(8,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia nulla at tempus volutpat. Pellentesque pharetra vulputate mauris vitae dapibus. Proin lorem tortor, facilisis in mi non, posuere euismod lacus. Ut non venenatis metus. Vivamus ultrices odio quis elit finibus, nec hendrerit neque tincidunt. Duis eleifend venenatis metus nec viverra. Fusce non ex tincidunt, sodales dolor in, cursus tortor.\r\n\r\nMorbi auctor maximus purus, vitae faucibus massa vehicula nec. Fusce lacinia et massa nec tincidunt. Donec dapibus augue sapien, ut commodo urna tempus nec. Proin porttitor aliquam maximus. Phasellus eu ex dapibus, finibus nunc at, tincidunt turpis. Duis congue, lectus quis porttitor porttitor, diam massa vehicula ante, at aliquam quam orci eu massa. Vivamus sed volutpat sem. Aliquam erat volutpat. Vivamus fermentum est in libero laoreet, et bibendum felis sodales. In dapibus erat vitae facilisis porta. Quisque orci tellus, gravida vitae lectus et, euismod sagittis mi. Nulla molestie gravida diam. Praesent dignissim vel sem eget convallis. Donec tristique eget magna vitae venenatis. Etiam eu risus nec felis auctor tempor. Mauris ac mi vulputate, efficitur purus ut, auctor nunc.',3,'2015-04-07 17:11:00','2015-04-07 17:11:00','testuser7');

/*!40000 ALTER TABLE `shop-review_review` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop-review_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop-review_user`;

CREATE TABLE `shop-review_user` (
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` char(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `shop-review_user` WRITE;
/*!40000 ALTER TABLE `shop-review_user` DISABLE KEYS */;

INSERT INTO `shop-review_user` (`username`, `password`, `email`)
VALUES
	('testuser','$2y$08$8MOFSW4PmX3aqMwyrIuqjO4jiyZSmfKplSnJkA9v21D5Yu0Bxka3O','testuser@testuser.hu');

/*!40000 ALTER TABLE `shop-review_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
