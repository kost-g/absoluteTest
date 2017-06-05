-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2017 г., 01:56
-- Версия сервера: 5.7.13-log
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `absoluteTest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_path` text
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`file_id`, `date`, `file_path`) VALUES
(17, '2017-06-05 23:25:22', 'G:/IT/OpenServer_5/domains/absoluteTest/uploads/1496694322.txt'),
(18, '2017-06-06 01:00:15', 'G:/IT/OpenServer_5/domains/absoluteTest/uploads/1496700015.txt'),
(19, '2017-06-06 01:00:22', 'G:/IT/OpenServer_5/domains/absoluteTest/uploads/1496700022.txt');

-- --------------------------------------------------------

--
-- Структура таблицы `housework`
--

CREATE TABLE IF NOT EXISTS `housework` (
  `housework_id` int(10) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `responsible` varchar(255) DEFAULT NULL,
  `done` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `housework`
--

INSERT INTO `housework` (`housework_id`, `content`, `responsible`, `done`) VALUES
(1, 'wash dishes', 'child2', 0),
(2, 'clean desk', 'mom', 0),
(3, 'fix furniture', 'dad', 0),
(4, 'fix door', 'dad', 0),
(5, 'clean flour', 'child3', 0),
(6, 'wash\r\n', 'child1', 0),
(7, 'fix', 'dad', 1),
(12, 'teach', 'child1', 1),
(13, 'wash\r\n', 'dad', 1),
(14, 'fix\r\n', 'child1', 0),
(15, 'teach', 'child1', 1),
(16, 'wash\r\n', 'child1', 1),
(17, 'fix\r\n', 'dad', 1),
(18, 'teach', 'mom', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `premission`
--

CREATE TABLE IF NOT EXISTS `premission` (
  `id` int(10) unsigned NOT NULL,
  `role` varchar(255) NOT NULL,
  `upload_files` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `distribute_tasks` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `view_tasks` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mark_done_tasks` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `premission`
--

INSERT INTO `premission` (`id`, `role`, `upload_files`, `distribute_tasks`, `view_tasks`, `mark_done_tasks`) VALUES
(1, 'admin', 1, 1, 1, 1),
(2, 'mother', 1, 0, 1, 1),
(3, 'father', 0, 1, 1, 1),
(4, 'child', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `name`, `password`, `role`) VALUES
(1, 'mom', 'e5e0213249cd5bd8fb9d09bb50854072d3dfa7db', 'mother'),
(2, 'dad', '0da19b540f7c3526f24acba988b03df43b3c5cf3', 'father'),
(3, 'child1', '821c07a03badb405e8ccaea45217e56e69e4f6e0', 'child'),
(4, 'child2', '821c07a03badb405e8ccaea45217e56e69e4f6e0', 'child'),
(6, 'child3', 'e6339c2ed81bebfdeff82d941f056f5886ead16b', 'child');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Индексы таблицы `housework`
--
ALTER TABLE `housework`
  ADD PRIMARY KEY (`housework_id`),
  ADD KEY `responsible` (`responsible`);

--
-- Индексы таблицы `premission`
--
ALTER TABLE `premission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role` (`role`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `housework`
--
ALTER TABLE `housework`
  MODIFY `housework_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT для таблицы `premission`
--
ALTER TABLE `premission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `housework`
--
ALTER TABLE `housework`
  ADD CONSTRAINT `housework_ibfk_1` FOREIGN KEY (`responsible`) REFERENCES `user` (`name`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `premission` (`role`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
