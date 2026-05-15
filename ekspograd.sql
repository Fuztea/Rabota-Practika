-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 18 2026 г., 09:35
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ekspograd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ekspograd.com', '2026-04-18 06:31:08', '2026-04-18 06:31:08');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `start_date`, `end_date`, `location`, `capacity`, `image_url`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tech Expo 2026', 'Выставка новейших технологий и инноваций', '2026-05-10 09:00:00', '2026-05-12 18:00:00', 'Зал А, 5000 кв.м', 2000, 'images/tech-expo.jpg', '500.00', 1, '2026-04-18 06:31:08', '2026-04-18 06:31:08'),
(2, 'Business Conference', 'Международная конференция по развитию бизнеса', '2026-05-20 08:30:00', '2026-05-21 17:00:00', 'Конференц-зал, 1000 кв.м', 500, 'images/business-conf.jpg', '3000.00', 1, '2026-04-18 06:31:08', '2026-04-18 06:31:08'),
(3, 'Design Festival', 'Фестиваль дизайна и креативных идей', '2026-06-05 10:00:00', '2026-06-07 19:00:00', 'Зал Б, 3000 кв.м', 1500, 'images/design-fest.jpg', '400.00', 1, '2026-04-18 06:31:08', '2026-04-18 06:31:08'),
(4, 'Art Expo', 'Выставка современного искусства', '2026-06-15 11:00:00', '2026-06-20 20:00:00', 'Галерея, 2000 кв.м', 800, 'images/art-expo.jpg', '250.00', 1, '2026-04-18 06:31:08', '2026-04-18 06:31:08'),
(5, 'Science Symposium', 'Научный форум с участием ведущих ученых', '2026-07-01 09:00:00', '2026-07-03 17:00:00', 'Аудитория, 1500 кв.м', 600, 'images/science-symp.jpg', '1500.00', 1, '2026-04-18 06:31:08', '2026-04-18 06:31:08'),
(6, 'CyberSecurity Summit', 'Саммит по безопасности в интернете', '2026-07-15 08:00:00', '2026-07-16 18:00:00', 'Конференц-зал, 1000 кв.м', 400, 'images/cyber-summit.jpg', '2500.00', 1, '2026-04-18 06:31:08', '2026-04-18 06:31:08');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) NOT NULL,
  `event_id` int DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'company_phone', '+7 (999) 876-54-32', '2026-04-18 06:31:08'),
(2, 'company_email', 'info@ekspograd.com', '2026-04-18 06:31:08'),
(3, 'company_address', 'Центр выставок и конференций, Центральная улица, д.1', '2026-04-18 06:31:08'),
(4, 'working_hours', 'Пн-Пт 09:00 - 18:00', '2026-04-18 06:31:08'),
(5, 'total_area', '25000', '2026-04-18 06:31:08'),
(6, 'founded_year', '2016', '2026-04-18 06:31:08');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
