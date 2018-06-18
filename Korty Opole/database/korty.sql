-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Чрв 18 2018 р., 18:13
-- Версія сервера: 10.1.32-MariaDB
-- Версія PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `korty`
--

-- --------------------------------------------------------

--
-- Структура таблиці `korty`
--

CREATE TABLE `korty` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп даних таблиці `korty`
--

INSERT INTO `korty` (`id`, `name`, `is_available`) VALUES
(1, '1', 1),
(2, 'nowy', 1),
(3, 'trzeci', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `id` int(11) NOT NULL,
  `kort` int(11) NOT NULL,
  `date` date NOT NULL,
  `uzytkownik` int(11) NOT NULL,
  `czas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп даних таблиці `rezerwacje`
--

INSERT INTO `rezerwacje` (`id`, `kort`, `date`, `uzytkownik`, `czas`) VALUES
(1, 1, '2018-06-11', 2, 17),
(2, 1, '2018-06-11', 1, 8),
(5, 2, '2018-06-12', 12, 18),
(6, 3, '2018-06-11', 16, 19),
(7, 6, '2018-06-11', 17, 8),
(8, 1, '2018-06-11', 17, 8),
(11, 1, '2018-06-18', 12, 8),
(13, 1, '2018-06-18', 12, 9),
(14, 1, '2018-06-19', 12, 8);

-- --------------------------------------------------------

--
-- Структура таблиці `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `surname` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(24) COLLATE utf8mb4_bin NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп даних таблиці `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `name`, `surname`, `email`, `password`, `city`, `phone`, `state`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 1),
(2, 'ad', 'Bilaniuk', 'sviatoslavbilaniuk@gmail.com', '123', 'opole', '881340235', 2),
(4, 'Sas', 'Bilaniuk', 'sviatoslavbilaniuk@gmail.com123', '21232f297a57a5a743894a0e4a801fc3', 'opole', '881340235', 2),
(7, 'admin', 'admin', 'admin_bog@g.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 1),
(11, 'asd', 'asd', 'asd@i.i', '7815696ecbf1c96e6894b779456d330e', '', '', 2),
(12, '123', '123', '123@a.a', '202cb962ac59075b964b07152d234b70', '123', '123', 3),
(16, 'tu', 'tam', '123@1.pl', '202cb962ac59075b964b07152d234b70', '', '', 3),
(17, 'Adam', 'ZZZz', 'aaaa@aaa.com', '62f2596b743b732c244ca5451a334b4f', 'opole', '11222233344', 3),
(18, 'adam', 'tak', 'i@i.i', 'c20ad4d76fe97759aa27a0c99bff6710', 'tu', '', 1),
(19, 'alalal', 'mfoe', 'lalal@ll.co', '81dc9bdb52d04dc20036dbd8313ed055', 'doekfo', 'saaoddd', 3);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `korty`
--
ALTER TABLE `korty`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `korty`
--
ALTER TABLE `korty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблиці `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
