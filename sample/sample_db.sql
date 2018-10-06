SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `symfony` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `symfony`;

DROP TABLE IF EXISTS `snippets`;
CREATE TABLE `snippets` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `private` tinyint(1) NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `snippets` (`id`, `author_id`, `title`, `description`, `language`, `private`, `code`, `create_date`) VALUES
(1, 1, 'AddClassFunction', 'Funkcja dodająca metodę do klasy', 'javascript', 0, 'function addClass(id,new_class){\r\n       var i,n=0;\r\n\r\n       new_class=new_class.split(\",\");\r\n\r\n       for(i=0;i<new_class.length;i++){\r\n               if((\" \"+document.getElementById(id).className+\" \").indexOf(\" \"+new_class[i]+\" \")==-1){\r\n                       document.getElementById(id).className+=\" \"+new_class[i];\r\n                       n++;\r\n               }\r\n       }\r\n\r\n       return n;\r\n}', '2017-10-23 10:37:48'),
(2, 1, 'PHPCleanVariables', 'Funkcja czyszcząca dane wejściowe', 'php', 0, '<?php\r\n\r\nfunction clean($value) {\r\n   // If magic quotes not turned on add slashes.\r\n   if(!get_magic_quotes_gpc())\r\n\r\n   // Adds the slashes.\r\n   { $value = addslashes($value); }\r\n\r\n   // Strip any tags from the value.\r\n   $value = strip_tags($value);\r\n\r\n   // Return the value out of the function.\r\n   return $value;\r\n}', '2017-10-23 10:38:39'),
(3, 1, 'ClapmingNumberSASS', 'Przycinanie wartości metodą clamp', 'sass', 0, '$clamp: clamp(42, $min: 0, $max: 1337);    // 42\r\n$clamp: clamp(42, $min: 1337, $max: 9000); // 1337\r\n$clamp: clamp(42, $min: 0, $max: 1);       // 1', '2017-10-23 10:39:30'),
(4, 1, 'PustaTabelaHTML', 'Wzór pustej tabelki w HTML5', 'html', 1, '<table>\r\n	<thead>\r\n		<tr>\r\n			<th></th>\r\n			<th></th>\r\n			<th></th>\r\n			<th></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td></td>\r\n			<td></td>\r\n			<td></td>\r\n			<td></td>\r\n		</tr>\r\n		<tr>\r\n			<td></td>\r\n			<td></td>\r\n			<td></td>\r\n			<td></td>\r\n		</tr>\r\n		<tr>\r\n			<td></td>\r\n			<td></td>\r\n			<td></td>\r\n			<td></td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '2017-10-23 10:40:25'),
(5, 2, 'HTML5boilerplate2', 'wzór dokumentu html55', 'html', 1, '<!DOCTYPE HTML>\r\n\r\n<html>\r\n\r\n<head>\r\n	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n	<title>Your Website</title>\r\n</head>\r\n\r\n<body>\r\n\r\n	<header>\r\n		<nav>\r\n			<ul>\r\n				<li>Your menu</li>\r\n			</ul>\r\n		</nav>\r\n	</header>\r\n	\r\n	<section>\r\n	\r\n		<article>\r\n			<header>\r\n				<h2>Article title</h2>\r\n				<p>Posted on <time datetime=\"2009-09-04T16:31:24+02:00\">September 4th 2009</time> by <a href=\"#\">Writer</a> - <a href=\"#comments\">6 comments</a></p>\r\n			</header>\r\n			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n		</article>\r\n		\r\n		<article>\r\n			<header>\r\n				<h2>Article title</h2>\r\n				<p>Posted on <time datetime=\"2009-09-04T16:31:24+02:00\">September 4th 2009</time> by <a href=\"#\">Writer</a> - <a href=\"#comments\">6 comments</a></p>\r\n			</header>\r\n			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n		</article>\r\n		\r\n	</section>\r\n\r\n	<aside>\r\n		<h2>About section</h2>\r\n		<p>Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>\r\n	</aside>\r\n\r\n	<footer>\r\n		<p>Copyright 2009 Your name</p>\r\n	</footer>\r\n\r\n</body>\r\n\r\n</html>', '2017-10-23 10:41:43'),
(6, 2, 'TrojkatWCss', 'Generowanie trójkąta za pomocą CSS', 'css', 0, '.arrow-up {\r\n  width: 0; \r\n  height: 0; \r\n  border-left: 5px solid transparent;\r\n  border-right: 5px solid transparent;\r\n  \r\n  border-bottom: 5px solid black;\r\n}\r\n\r\n.arrow-down {\r\n  width: 0; \r\n  height: 0; \r\n  border-left: 20px solid transparent;\r\n  border-right: 20px solid transparent;\r\n  \r\n  border-top: 20px solid #f00;\r\n}\r\n\r\n.arrow-right {\r\n  width: 0; \r\n  height: 0; \r\n  border-top: 60px solid transparent;\r\n  border-bottom: 60px solid transparent;\r\n  \r\n  border-left: 60px solid green;\r\n}\r\n\r\n.arrow-left {\r\n  width: 0; \r\n  height: 0; \r\n  border-top: 10px solid transparent;\r\n  border-bottom: 10px solid transparent; \r\n  \r\n  border-right:10px solid blue; \r\n}', '2017-10-23 10:42:41'),
(7, 3, 'JakisTamKodzik', 'opisek', 'css', 0, '@import url(\'https://fonts.googleapis.com/css?family=Lato:300,400,700&subset=latin-ext\');\r\n\r\nhtml, body {\r\n    font-size: 14px;\r\n    font-family: \'Lato\', sans-serif;\r\n}\r\n\r\nhtml {\r\n    position: relative;\r\n    min-height: 100%;\r\n}', '2017-10-23 11:08:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `username`, `description`, `avatar`, `password`, `email`, `roles`) VALUES
(1, 'Michau', '123', 'blank.png', '$2y$13$9/iapNUXO2ThbU4UDWariehk5sKhCHhoVmt11yrhxt2Lu/xGeUAHu', '3123123@asdas.pl', '[\"ROLE_SUPER_ADMIN\"]'),
(2, 'TestowyUser', 'To jest opis testowego usera...!', 'adb36a0153ea010103d59fbbfee90735.jpeg', '$2y$13$9/iapNUXO2ThbU4UDWariehk5sKhCHhoVmt11yrhxt2Lu/xGeUAHu', 'test@test.pl', '[\"ROLE_USER\"]'),
(3, 'beata', 'jakis opis', '51e0077f4355e601bff4f3103b1bf13f.jpeg', '$2y$13$ama2Eh4tT3IiTgJyvt906.KDFmJayzCKk7ie717WeCXsge.fewJuu', 'beata@pollub.pl', '[\"ROLE_USER\"]');


ALTER TABLE `snippets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED21F5DCF675F31B` (`author_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);


ALTER TABLE `snippets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `snippets`
  ADD CONSTRAINT `FK_ED21F5DCF675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
