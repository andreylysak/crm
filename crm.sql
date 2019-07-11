-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 11 2019 г., 16:25
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `crm_id` varchar(500) DEFAULT NULL,
  `name` text NOT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `address` text,
  `position` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `leads` text,
  `company_id` varchar(500) DEFAULT NULL,
  `company_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `crm_id`, `name`, `email`, `phone`, `address`, `position`, `created_at`, `updated_at`, `leads`, `company_id`, `company_name`) VALUES
(46, '16191471', 'Test Contact 1', 'test1@example.com', '0971231212', 'Kiev, Streetname 1', 'Директор', '2019-07-04 07:32:07', '2019-07-04 07:39:41', '[6163911,6164401]', NULL, NULL),
(47, '16192839', 'Test Contact 2', 'test2@gmail.com', '0971234567', 'Kyiv, Streetname 2', 'Администратор', '2019-07-04 07:44:52', '2019-07-04 07:58:26', '[6164039]', NULL, NULL),
(48, '16192933', 'Test Contact 3', 'test3@example.com', '0981234567', 'Kiev, Streetname 3', 'Менеджер', '2019-07-04 07:46:03', '2019-07-04 08:08:50', '[6164161,6164251]', '16195489', 'Test companyname 3'),
(49, '16624371', 'test contact name', NULL, NULL, 'Cityname, Streetname 1', 'manager', '2019-07-05 12:26:24', '2019-07-05 12:26:26', NULL, NULL, NULL),
(50, '16626491', 'Firstname Lastname', NULL, NULL, 'Cityname, Streetname 1', 'manager', '2019-07-05 12:31:52', '2019-07-05 12:31:54', NULL, NULL, NULL),
(51, '16629249', 'John Doe', NULL, NULL, 'Cityname, Streetname 1', 'manager', '2019-07-05 12:39:08', '2019-07-05 12:39:10', NULL, NULL, NULL),
(52, '16648439', 'Ivan', 'test1@123.com', '0981231212', 'Streetname 4', 'manager', '2019-07-05 13:20:48', '2019-07-05 13:20:51', NULL, NULL, NULL),
(53, '16655717', 'Sergey Ivanov', 'testSergey@123.com', '097551212', 'Cityname, Streetname 5', 'administrator', '2019-07-05 14:34:33', '2019-07-05 14:34:41', NULL, NULL, NULL),
(55, '16750001', 'test contact 123', 'qwerty@gmail.com', '12345678', 'Cityname, Streetname 1', 'Manager', '2019-07-06 14:47:43', '2019-07-06 14:47:44', NULL, '16749999', 'Companyname 1'),
(58, '16784567', 'Dan Cedercholm', 'dan@dan.com', '555444', 'Salem', 'Designer', '2019-07-07 09:39:49', '2019-07-07 12:24:03', NULL, NULL, NULL),
(68, '16731609', 'Oleg Ivanov', NULL, '12345', NULL, NULL, '2019-07-06 11:21:20', '2019-07-06 11:34:06', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `leads`
--

CREATE TABLE `leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `crm_id` varchar(500) DEFAULT NULL,
  `name` text NOT NULL,
  `status` varchar(500) DEFAULT NULL,
  `budget` varchar(500) DEFAULT NULL,
  `contact_id` int(10) UNSIGNED DEFAULT NULL,
  `crm_company_id` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `contacts` text,
  `main_contact` text,
  `status_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `leads`
--

INSERT INTO `leads` (`id`, `crm_id`, `name`, `status`, `budget`, `contact_id`, `crm_company_id`, `created_at`, `updated_at`, `contacts`, `main_contact`, `status_name`) VALUES
(6, '6163911', 'Сделка #6163911', '28810627', '20000', NULL, NULL, '2019-07-04 07:56:27', '2019-07-04 07:57:52', NULL, NULL, NULL),
(7, '6164401', 'Сделка #6164401', '142', '20000', NULL, NULL, '2019-07-04 08:03:29', '2019-07-04 08:03:41', NULL, NULL, NULL),
(8, '6164161', 'Закупка материалов', '28810621', '50000', NULL, NULL, '2019-07-04 08:00:16', '2019-07-04 08:08:28', NULL, NULL, NULL),
(9, '6164251', 'Сделка #6164251', '142', '10000', NULL, NULL, '2019-07-04 08:01:26', '2019-07-04 08:08:28', NULL, NULL, NULL),
(10, '6518121', 'Test lead', '28810624', '10000', NULL, NULL, '2019-07-07 13:41:55', '2019-07-07 13:42:54', '[16192839]', '16192839', NULL),
(11, '6164039', 'Сделка #6164039', '28810627', '30000', NULL, NULL, '2019-07-04 07:58:26', '2019-07-07 14:07:21', '[16192839]', '16192839', NULL),
(12, '6519341', 'Test lead status первичный контакт', '28810627', '100', NULL, NULL, '2019-07-07 14:17:20', '2019-07-07 14:26:19', '[16192839]', '16192839', NULL),
(13, '6526785', 'Test lead example', '28810624', '10000', NULL, NULL, '2019-07-07 17:31:23', '2019-07-07 17:31:26', NULL, NULL, NULL),
(14, '6526787', 'Бумага', '28810624', '10000', NULL, NULL, '2011-02-28 14:42:44', '2019-07-07 17:31:26', NULL, NULL, NULL),
(15, '6527177', 'lead zzz', '28810627', '50', NULL, NULL, '2019-07-07 17:33:17', '2019-07-07 17:33:19', NULL, NULL, NULL),
(16, '6527179', 'Бумага', '28810627', '50', NULL, NULL, '2011-02-28 14:42:44', '2019-07-07 17:33:19', NULL, NULL, NULL),
(17, '6527633', 'Products lead', '28810621', '300', NULL, NULL, '2019-07-07 17:37:36', '2019-07-07 17:37:38', NULL, NULL, NULL),
(18, '6527635', 'Бумага', '28810621', '300', NULL, NULL, '2011-02-28 14:42:44', '2019-07-07 17:37:38', NULL, NULL, NULL),
(19, '6527687', 'Paper', '28810621', '400', NULL, NULL, '2019-07-07 17:39:44', '2019-07-07 17:39:46', NULL, NULL, NULL),
(20, '6527689', 'Бумага', '28810621', '400', NULL, NULL, '2011-02-28 14:42:44', '2019-07-07 17:39:46', NULL, NULL, NULL),
(21, '6528393', 'Server order', '28810621', '30000', NULL, NULL, '2019-07-07 18:11:02', '2019-07-07 18:11:05', NULL, NULL, NULL),
(22, '6528465', 'Server hosting', '28810621', '30000', NULL, NULL, '2019-07-07 18:11:54', '2019-07-07 18:11:56', '[16191471]', '16191471', NULL),
(23, '6571137', 'Rent server', '142', '400', NULL, NULL, '2019-07-08 08:27:34', '2019-07-08 08:27:35', NULL, NULL, NULL),
(28, '6571773', 'Order server', '28810624', '5000', NULL, NULL, '2019-07-08 08:32:01', '2019-07-08 08:32:04', '[16192933]', '16192933', NULL),
(29, '6584493', 'Order hosting', '28810624', '20000', NULL, NULL, '2019-07-08 09:33:47', '2019-07-08 09:34:13', '[16191471,16192839,16192933]', '16191471', NULL),
(30, '6660861', 'Order domain', '28810624', '10000', NULL, NULL, '2019-07-08 19:20:36', '2019-07-08 19:20:37', '[16191471]', '16191471', NULL),
(31, '6660909', 'Server order', '28810627', '444', NULL, NULL, '2019-07-08 19:22:30', '2019-07-08 19:22:30', '[16191471]', '16191471', NULL),
(35, '6661407', 'Server order 123', '28810624', '400', NULL, NULL, '2019-07-08 19:44:50', '2019-07-08 19:44:51', NULL, NULL, NULL),
(36, '6661467', 'VPS order', '28810627', '40000', NULL, NULL, '2019-07-08 19:46:49', '2019-07-08 19:46:50', '[16191471]', '16191471', NULL),
(37, '6661565', 'Site development', '28810630', '500000', NULL, NULL, '2019-07-08 19:50:19', '2019-07-08 19:51:11', '[16191471,16192839,16192933,16784567]', '16191471', NULL),
(38, '6661343', 'lead_1', '28810621', '500', NULL, NULL, '2019-07-08 19:42:09', '2019-07-08 19:42:09', '[16191471]', '16191471', 'Первичный контакт'),
(39, '6661351', 'Lead_2', '28810621', '300', NULL, NULL, '2019-07-08 19:42:25', '2019-07-08 19:42:25', '[16191471]', '16191471', 'Первичный контакт'),
(40, '6719993', 'Linux hosting order', '28810630', '400000', NULL, NULL, '2019-07-09 09:16:47', '2019-07-09 09:16:48', '[16784567]', '16784567', 'Согласование договора'),
(41, '6720087', 'Linux hosting order', '28810630', '400000', NULL, NULL, '2019-07-09 09:17:32', '2019-07-09 09:17:34', '[16784567]', '16784567', 'Согласование договора'),
(42, '6720127', 'Ubuntu', '28810621', '123', NULL, NULL, '2019-07-09 09:17:58', '2019-07-09 13:07:05', '[16784567]', '16784567', 'Первичный контакт');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `permissions` varchar(500) DEFAULT '{}',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '{\"read\":\"true\", \"create\":\"true\", \"update\":\"true\", \"delete\":\"true\"}', '2019-07-04 00:00:00', NULL),
(2, 'User', 'user', '{\"read\":\"true\"}', '2019-07-04 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role_users`
--

CREATE TABLE `role_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '2019-07-04 18:11:52', NULL),
(2, 8, 2, '2019-07-04 18:18:32', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Administrator', 'admin@example.com', NULL, '$2y$10$7VEeXnjEd93nMH/u80oXPu7lUguo9f.EOH4Ajaj5LlPus1.uGWD9e', NULL, '2019-07-04 12:11:52', '2019-07-04 12:11:52'),
(8, 'Username', 'user@example.com', NULL, '$2y$10$tfOAZcOtTPZC3RhcY6kIfeUaQKEI95BUuA6VUn5Mm/ejmL61AY10y', NULL, '2019-07-04 12:18:32', '2019-07-04 12:18:32');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`);

--
-- Ограничения внешнего ключа таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
