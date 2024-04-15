-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3325
-- Время создания: Апр 12 2024 г., 13:19
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `authors_books`
--

CREATE TABLE `authors_books` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bookinstance`
--

CREATE TABLE `bookinstance` (
  `book_id` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `price` int(11) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `annotation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `readers`
--

CREATE TABLE `readers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `readers_books`
--

CREATE TABLE `readers_books` (
  `id` int(11) NOT NULL,
  `get_back` date NOT NULL,
  `get_out` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `book_instance` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `librarian` int(11) NOT NULL,
  `reader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Админ'),
(2, 'Библиотекарь');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `login`, `password`, `role`) VALUES
(2, 'Надежда', 'Барчугова', 'Дмитриевна', 'pipi', 'ec94f05fa41c14680ec73c34a8e44285', 1),
(3, 'Иван', 'Иванов', 'Иванович', 'lll', 'bf083d4ab960620b645557217dd59a49', 2),
(5, 'ыфвыфв', 'фывыв', 'фыв', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(7, 'asd', 'sd', 'asd', '123', '202cb962ac59075b964b07152d234b70', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `authors_books`
--
ALTER TABLE `authors_books`
  ADD KEY `author_id` (`author_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Индексы таблицы `bookinstance`
--
ALTER TABLE `bookinstance`
  ADD PRIMARY KEY (`book_id`,`ISBN`),
  ADD KEY `book_id` (`book_id`,`ISBN`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `readers`
--
ALTER TABLE `readers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `readers_books`
--
ALTER TABLE `readers_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_instance` (`book_instance`,`status`,`librarian`,`reader`),
  ADD KEY `librarian` (`librarian`),
  ADD KEY `status` (`status`),
  ADD KEY `reader` (`reader`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `readers_books`
--
ALTER TABLE `readers_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`id`) REFERENCES `authors_books` (`author_id`);

--
-- Ограничения внешнего ключа таблицы `authors_books`
--
ALTER TABLE `authors_books`
  ADD CONSTRAINT `authors_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Ограничения внешнего ключа таблицы `bookinstance`
--
ALTER TABLE `bookinstance`
  ADD CONSTRAINT `bookinstance_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `readers_books` (`book_instance`);

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bookinstance` (`book_id`);

--
-- Ограничения внешнего ключа таблицы `readers_books`
--
ALTER TABLE `readers_books`
  ADD CONSTRAINT `readers_books_ibfk_1` FOREIGN KEY (`librarian`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `readers_books_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `readers_books_ibfk_3` FOREIGN KEY (`reader`) REFERENCES `readers` (`id`);

--
-- Ограничения внешнего ключа таблицы `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`id`) REFERENCES `readers_books` (`status`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
