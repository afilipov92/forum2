SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `catText` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `catName`, `catText`) VALUES
(1, 'cat1', 'моя первая категория'),
(2, 'cat2', 'моя вторая категория');

CREATE TABLE IF NOT EXISTS `status` (
`id` int(2) NOT NULL,
  `nameStatus` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `status` (`id`, `nameStatus`) VALUES
(1, 'admin'),
(2, 'user');

CREATE TABLE IF NOT EXISTS `themes` (
`id` int(16) unsigned NOT NULL,
  `themeName` varchar(255) DEFAULT NULL,
  `themeText` text,
  `id_cat` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `themes` (`id`, `themeName`, `themeText`, `id_cat`) VALUES
(1, 'Тестовая тема', 'Тестовое сообщение\r\n', 1),
(4, 'Тема 2', 'ффффффффффффффффффф', 1),
(5, 'Тема 3', 'Привет я медвед', 2);

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_status` int(2) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `extInfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `userName`, `userEmail`, `password`, `id_status`, `hash`, `extInfo`) VALUES
(1, 'administrator', 'afilipov92@gmail.com', '1c03086b5e9170031973682be9e35ec5', 1, 'actived', NULL),
(9, 'liluoz', 'liluoz@mail.ru', 'd6d386f34344727e12de86881571a77f', 2, 'actived', NULL);


ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `themes`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_themes_categories` (`id_cat`);

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_users_status` (`id_status`);


ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `status`
MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `themes`
MODIFY `id` int(16) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;

ALTER TABLE `themes`
ADD CONSTRAINT `fk_themes_categories` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id`);

ALTER TABLE `users`
ADD CONSTRAINT `fk_users_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
