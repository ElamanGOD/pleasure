-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 08 2019 г., 18:21
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pleasure`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL DEFAULT 0,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `price`, `type`) VALUES
(1, 'Зеленый листовой салат', 1300, 'Салаты и закуски');

-- --------------------------------------------------------

--
-- Структура таблицы `orderfood`
--

CREATE TABLE `orderfood` (
  `id` int(11) UNSIGNED NOT NULL,
  `dishid` tinyint(1) UNSIGNED DEFAULT NULL,
  `tablenumber` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(11) UNSIGNED DEFAULT NULL,
  `orderedby` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orderfood`
--

INSERT INTO `orderfood` (`id`, `dishid`, `tablenumber`, `quantity`, `orderedby`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 1, 1, 1),
(3, 1, 1, 1, 1),
(4, 1, 1, 1, 1),
(5, 1, 1, 1, 1),
(6, 1, 1, 2, 1),
(7, 1, 1, 2, 1),
(8, 1, 1, 2, 1),
(9, 1, 1, 1, 1),
(10, 1, 1, 1, 1),
(11, 1, 1, 1, 1),
(12, 1, 42, 3, 1),
(13, 1, 1, 1, 1),
(14, 1, 1, 1, 1),
(15, 1, 1, 1, 1),
(16, 1, 1, 2, 1),
(17, 1, 1, 3, 1),
(18, 1, 1, 1, 1),
(19, 1, 1, 1, 1),
(20, 1, 1, 1, 1),
(21, 1, 1, 1, 1),
(22, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ordertable`
--

CREATE TABLE `ordertable` (
  `id` int(11) UNSIGNED NOT NULL,
  `number` int(11) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderedby` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ordertable`
--

INSERT INTO `ordertable` (`id`, `number`, `date`, `time`, `orderedby`) VALUES
(1, 1, '2019-12-09', '19:30', 1),
(2, 42, '2019-12-08', '20:00', 1),
(4, 3, '2019-12-19', '22:02', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `phone`, `admin`) VALUES
(1, 'Еламан', 'Фазыл', 'fazil.el2003@gmail.com', '$2y$10$Rn15Do17R/9B2MTqONSxY.eN1ZmdjSg7i29KqwfpxsnRL8b.G3JnS', '+77752698182', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderfood`
--
ALTER TABLE `orderfood`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `orderfood`
--
ALTER TABLE `orderfood`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
