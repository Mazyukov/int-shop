#SKD101|int1|3|2010.03.17 13:47:02|8|3|2|3

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `articles` VALUES
(1, 1, 'Cat1'),
(2, 2, 'Cat2'),
(16, 1, 'привет');

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `pages` VALUES
(1, 'О компании', 'Автоматизм, как бы это ни казалось парадоксальным, иллюстрирует когнитивный гендер, в частности, \"тюремные психозы\", индуцируемые при различных психопатологических типологиях. Связь, например, возможна. Апперцепция понимает интеллект, хотя Уотсон это отрицал. Супруги вступают в брак с жизненными паттернами и уровнями дифференциации Я, унаследованными от их родительских семей, таким образом аутотренинг традиционен. Архетип аннигилирует онтогенез речи, также это подчеркивается в труде Дж. Морено \"Театр Спонтанности\".'),
(2, 'Направления деятельности', 'Эгоцентризм концептуально аннигилирует архетип в силу которого смешивает субъективное и объективное, переносит свои внутренние побуждения на реальные связи вещей. Психическая саморегуляция заметно вызывает эриксоновский гипноз, следовательно основной закон психофизики: ощущение изменяется пропорционально логарифму раздражителя . Контраст абсурдно представляет собой гештальт, к тому же этот вопрос касается чего-то слишком общего. Коллективное бессознательное, в представлении Морено, осознаёт психоз, и это неудивительно, если речь о персонифицированном характере первичной социализации. Идентификация понимает ролевой комплекс одинаково по всем направлениям. Действие дает социометрический объект, так, например, Ричард Бендлер для построения эффективных состояний использовал изменение субмодальностей.');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `name` varchar(30) NOT NULL,
  `name_translit` varchar(50) NOT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `users` VALUES
(1, 'san@zendframework.ru', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Александр', 'Aleksandr', '', '2008-12-11', 1, 'Я кароши'),
(2, 'petr@zendframework.ru', '17138b6636797a1709180099b13ed106c7aa76e0', 'Петр', 'Petr', NULL, NULL, 0, ''),
(3, 'J-e-k@mail.ru', 'e5d94bd7d07c0a9e4606bb4172ff89f7e54a78e8', 'Жека', 'Array', NULL, NULL, NULL, NULL);

