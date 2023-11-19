-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Servidor: hl303.dinaserver.com
-- Tiempo de generación: 21-10-2015 a las 17:10:07
-- Versión del servidor: 5.5.44-0ubuntu0.14.04.1-log
-- Versión de PHP: 5.4.45-0+deb7u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dibalneg_plataforma2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivoscliente`
--

CREATE TABLE IF NOT EXISTS `archivoscliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `procesado` int(11) NOT NULL,
  `clientes_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `archivoscliente_name_unique` (`name`),
  KEY `archivoscliente_clientes_id_foreign` (`clientes_id`),
  KEY `archivoscliente_usuario_id_foreign` (`usuario_id`),
  KEY `archivoscliente_grupo_id_foreign` (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=149 ;

--
-- Volcado de datos para la tabla `archivoscliente`
--

INSERT INTO `archivoscliente` (`id`, `name`, `ruta`, `type`, `size`, `procesado`, `clientes_id`, `usuario_id`, `grupo_id`, `created_at`, `updated_at`) VALUES
(106, 'Curriculumjosetaibobueno (2)_45344556S.pdf', '$2y$10$fTxZaIIrTXDdR9lxGcqZWOUKi6.vaSPzJqST9xlyMjXHQgGKjuZYWA.pdf', 'pdf', '466.359375', 1, 16, 1, 1, '2015-09-29 17:50:31', '2015-09-29 17:50:31'),
(111, 'EXAMEN SUPUESTO FINAL_45344556S.pdf', '$2y$10$nMtLyLAfQ3O7BH0SGvnmb.3.BIkGbD7HLegnWmpt3np46ZH.HiAryA.pdf', 'pdf', '536.390625', 0, 16, 18, 2, '2015-09-30 09:32:02', '2015-09-30 09:32:02'),
(112, 'CG--Ficha-valoracion-de-empresas.-Derecho-Concursal-2-_45344556S.pdf', '$2y$10$3jhB8PPTMPuX7cNAnb3zzuao5a6.HRQUR2BRZbNHVNA38mK.A4ATOA.pdf', 'pdf', '59.0986328125', 0, 16, 18, 2, '2015-09-30 09:32:19', '2015-09-30 09:32:19'),
(118, 'ER-Trabajo_45344556S.docx', '$2y$10$A3N.wrzP5hUnV7LKRajmaOkORH25HHJPQPB3krSkTc4CLUigx2UXyA.docx', 'docx', '14.779296875', 0, 16, 1, 2, '2015-09-30 14:21:35', '2015-09-30 14:21:35'),
(121, 'tmp-7530-Copia de The little book of semaphores-1720350600_45344556S.pdf', '$2y$10$43o8PjBcunH9dPLIEXqWPON.zq1GU11Okx.0TQbPoisCvVTBjQjTKA.pdf', 'pdf', '979.4111328125', 1, 16, 18, 5, '2015-09-30 14:45:56', '2015-10-18 13:28:36'),
(123, 'tmp-13877-Horario DAM-735299375_45344556S.pdf', '$2y$10$khnei7ZvVQsbf5s4g5RwsePZAUJG1IlDS10soH6fGxWtBesiG.KMCA.pdf', 'pdf', '86.2490234375', 0, 16, 18, 2, '2015-09-30 14:51:02', '2015-09-30 14:51:02'),
(124, 'tmp-13877-Horario DAM-864765136_65743929I.pdf', '$2y$10$71dAP0a2XpkDpO82KRfWiOUQFU7pDGdi1JPyj6rSeV5.cygfcg8a.A.pdf', 'pdf', '86.2490234375', 0, 18, 1, 2, '2015-09-30 15:08:24', '2015-09-30 15:08:24'),
(125, 'Temario_45344556S.pdf', '$2y$10$8nS5ObIIdm26Z8N.JHNP.eafWAOjSJbVYdRf8V2jXhPCN32hDVu7mA.pdf', 'pdf', '87.8642578125', 1, 16, 1, 1, '2015-09-30 17:05:01', '2015-09-30 17:05:01'),
(126, 'ER-Trabajo_65743929I.docx', '$2y$10$aCgS2iredeNYrMw9N7bYsuR5r.FZDCxsDKtkcY1HFfZiAz7im9VUWA.docx', 'docx', '14.779296875', 0, 18, 1, 2, '2015-09-30 17:06:05', '2015-09-30 17:06:05'),
(127, 'Pantallazos_65743929I.docx', '$2y$10$XRU99lzHx95ZL.rEU64AKul6b1zKacbavAyG4JKFafHgBlwfK.DGyA.docx', 'docx', '940.2685546875', 0, 18, 1, 2, '2015-09-30 17:07:26', '2015-09-30 17:07:26'),
(131, 'Reserva patri_45344556S.pdf', '$2y$10$JakAjoj3pem3qnHoJg36QOqjproiLQ04aDazaFB9KfIs6GovakZICA.pdf', 'pdf', '292.9873046875', 1, 16, 1, 4, '2015-10-02 20:33:08', '2015-10-04 20:39:01'),
(132, 'bis (1)_45344556S.pdf', '$2y$10$kHGfmua88u0gaFOpF1RgtOxVenmpyR9o5QHR4eWSiyOvGzZSv3slmA.pdf', 'pdf', '611.662109375', 0, 16, 1, 4, '2015-10-02 20:34:21', '2015-10-02 20:34:21'),
(133, '14941303842-390226752-entrada_45344556S.pdf', '$2y$10$TVm2AiGYaA55a1dEtKbbouZLMl5cbw4tpaNPstUazRdeNypQBymTCA.pdf', 'pdf', '49.234375', 0, 16, 1, 2, '2015-10-02 20:38:50', '2015-10-02 20:38:50'),
(134, '20141010 SVQBIO Fernandez Florez J9UVKT 20E_45344556S.pdf', '$2y$10$yD2jpQZFbbfKPY1csD7Ri.RSZszxeibqNsDtXajbORc8mHW8fqodSA.pdf', 'pdf', '141.0693359375', 1, 16, 1, 4, '2015-10-02 20:39:36', '2015-10-18 13:27:59'),
(136, 'Chuleta Hibernate (Para consultar libremente)_45344556S.pdf', '$2y$10$Kq1BVjL03rM15FuOxcQmCuYkIJ6oZo1U9Pbrr.PlD4arRMLuxgxAaA.pdf', 'pdf', '183.294921875', 0, 16, 18, 5, '2015-10-02 20:59:06', '2015-10-18 13:28:29'),
(140, 'CAMARA-PS4-2_45344556S.jpeg', '$2y$10$aGWgUcuaup0NGYfhFQuWP.5Gfy2hDVzo.3qTHP1wg73eLlunJuQPeA.jpeg', 'jpeg', '13.0185546875', 0, 16, 18, 2, '2015-10-04 16:19:20', '2015-10-04 16:19:20'),
(141, 'secondarytile_45344556S.png', '$2y$10$9ujmUFrc7R.DkW4r2tsPfOabaTld1gszn7S5ph.A3vO388TCLm5Z2A.png', 'png', '0.6220703125', 0, 16, 18, 2, '2015-10-04 21:09:57', '2015-10-04 21:09:57'),
(145, 'reporteFactura_48557125X.png', '$2y$10$fBhTVzdJUYaXkP8JElFUWu5egakqt5MBsqEvhYbEepwDdhh9ilV.qA.png', 'png', '41.5224609375', 0, 39, 30, 2, '2015-10-21 09:20:55', '2015-10-21 09:20:55'),
(146, 'factura 0001_48557125X.jpeg', '$2y$10$4WQthkwuKJmMUvJYPch.I.ANhJKyS0IIVaP.7WZlMJWJYau2YSV9WA.jpeg', 'jpeg', '93.9169921875', 0, 39, 30, 2, '2015-10-21 09:20:59', '2015-10-21 09:20:59'),
(147, 'factura prueba_48557125X.jpeg', '$2y$10$TrjLxW.cCn012droCcCp.eFkzLE49dlvxS9LDHw6rUEao0WniCvnCA.jpeg', 'jpeg', '8.9521484375', 0, 39, 30, 2, '2015-10-21 09:20:59', '2015-10-21 09:20:59'),
(148, 'images_48557125X.jpeg', '$2y$10$TUS3Yr83y1uztpb9HcPkKeegvt38RYq0z89gT9d.jUfNF75rVFPiqA.jpeg', 'jpeg', '11.8125', 0, 39, 30, 2, '2015-10-21 09:21:02', '2015-10-21 09:21:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gestoria_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_dni_unique` (`dni`),
  KEY `clientes_gestoria_id_foreign` (`gestoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni`, `nombre`, `gestoria_id`, `created_at`, `updated_at`) VALUES
(16, '45344556S', 'Manuel Gonzalez', 3, '2015-09-29 17:42:20', '2015-09-29 17:42:20'),
(18, '65743929I', 'Silvia Garcia', 3, '2015-09-29 19:47:18', '2015-09-29 19:47:18'),
(19, '57483920O', 'Carlos Romero Plaza', 3, '2015-09-29 19:47:44', '2015-09-29 19:47:44'),
(20, 'A42658598', 'ACERON SA', 3, '2015-09-30 08:44:48', '2015-09-30 08:44:48'),
(21, '124567543', 'PANA', 3, '2015-09-30 16:24:50', '2015-09-30 16:24:50'),
(22, '124567546', 'RLCKL', 3, '2015-09-30 16:25:02', '2015-09-30 16:25:02'),
(23, '124567541', 'JAUN', 3, '2015-09-30 16:25:13', '2015-09-30 16:25:13'),
(24, '124567549', 'ASDA', 3, '2015-09-30 16:25:24', '2015-09-30 16:25:24'),
(25, '124567512', 'SASAFSAFF', 3, '2015-09-30 16:26:18', '2015-09-30 16:26:18'),
(26, '86758576W', 'DFGSDFGD', 3, '2015-09-30 16:26:15', '2015-09-30 16:26:15'),
(27, '54565654Q', 'DFGDFGJHGFHJ', 3, '2015-09-30 16:26:28', '2015-09-30 16:26:28'),
(28, '34345456C', 'FGHDFGH', 3, '2015-09-30 16:26:43', '2015-09-30 16:26:43'),
(29, '124567513', 'SADDSD', 3, '2015-09-30 16:27:41', '2015-09-30 16:27:41'),
(30, '45456567z', 'sICRE', 3, '2015-09-30 16:27:58', '2015-09-30 16:27:58'),
(33, '87678787E', 'FHDFGHDF', 3, '2015-09-30 16:28:31', '2015-09-30 16:28:31'),
(34, '123432134', 'Ritenti', 3, '2015-09-30 16:28:59', '2015-09-30 16:28:59'),
(35, '45434565G', 'asasad', 3, '2015-09-30 16:28:48', '2015-09-30 16:28:48'),
(39, '48557125X', 'Bar Paquito', 25, '2015-10-21 08:50:33', '2015-10-21 08:50:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `usuario_id` int(10) unsigned NOT NULL,
  `archivo_id` int(10) unsigned NOT NULL,
  `comentario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `comentarios_usuario_id_foreign` (`usuario_id`),
  KEY `comentarios_archivo_id_foreign` (`archivo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestoria`
--

CREATE TABLE IF NOT EXISTS `gestoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clave_clientes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `gestoria`
--

INSERT INTO `gestoria` (`id`, `dni`, `clave`, `nombre`, `clave_clientes`, `created_at`, `updated_at`) VALUES
(3, '45456545S', '09Gilinamat25', 'Gestoria A', '09Cuqozarol25', '2015-09-24 22:06:42', '2015-09-29 19:48:47'),
(7, '454345456', '10Guwoserej01', 'sdggds', '09Cehazehim26', '2015-09-26 16:42:04', '2015-10-01 15:06:38'),
(12, 'h65434565', '10Goqijohux01', 'vhfgjhdf', '10Ceziwelon01', '2015-10-01 14:14:13', '2015-10-01 14:14:13'),
(15, 'v54323432', '10Ganapiqiq01', 'tyertu', '10Cutuzilil01', '2015-10-01 14:14:47', '2015-10-01 14:14:47'),
(18, 'i87876765', '10Geluhirub01', 'bncfgn', '10Cadureveq01', '2015-10-01 14:15:24', '2015-10-01 14:15:24'),
(19, 'b65678767', '10Goqaxidih01', 'asdfasdf', '10Caresetis01', '2015-10-01 14:15:56', '2015-10-01 14:15:56'),
(20, 'x34545456', '10Gufufubuf01', 'asdasd', '10Ceqabirep01', '2015-10-01 14:16:06', '2015-10-01 14:16:06'),
(21, '5tgfrdedf', '10Gugejapeq01', 'iuoiupoiu', '10Cexenimeb01', '2015-10-01 14:16:16', '2015-10-01 14:16:16'),
(25, 'B12465751', '10Gadeliwul21', 'IGLESIAS & ASOC', '10Cuwanacej21', '2015-10-21 08:36:42', '2015-10-21 08:36:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_archivos`
--

CREATE TABLE IF NOT EXISTS `grupos_archivos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `grupos_archivos`
--

INSERT INTO `grupos_archivos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Estados Contables', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Facturas Recibidas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Facturas Emitidas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Documentos Bancarios', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Otros Documentos', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2015_06_08_135914_create_roles_table', 1),
('2015_08_03_154419_create_grupos_archivos_table', 1),
('2015_08_03_200510_create_gestoria_table', 1),
('2015_08_04_194234_create_clientes_table', 1),
('2015_08_04_194235_create_users_table', 1),
('2015_08_04_194306_create_archivoscliente_table', 1),
('2015_08_06_181830_create_comentarios_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('patricio.fernandez.florez@gmail.com', '99aff320732d23a32489c85975f2cdc845cf9c793d9cdcb751767b9cf3eaea00', '2015-09-26 17:19:36'),
('pruebalaravel@gmail.com', '5c6eab93d0849cb73f4becb127f43c5ab757536e2a4af82265b2777196527888', '2015-10-03 08:51:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Gestoria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Cliente', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `gestoria_id` int(10) unsigned DEFAULT NULL,
  `rol_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_gestoria_id_foreign` (`gestoria_id`),
  KEY `users_dni_foreign` (`dni`),
  KEY `users_rol_id_foreign` (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `dni`, `name`, `email`, `password`, `gestoria_id`, `rol_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin@gmail.com', '$2y$10$wPKyCj6Q2UIfy8QYWJ5IcuvABocgD4tPOrdht6nPqav6xalDErlz2', NULL, 1, 'MuZlHuj35v8ZBzGUvzy62xCbgLk7cqlre5Gl78TfUzo1bOwTRtPgiqT5SZ5R', '0000-00-00 00:00:00', '2015-10-21 14:50:43'),
(18, '45344556S', 'ManuelG', 'manuel@gmail.com', '$2y$10$dHOQUwQr4yq0Ed22eJhWvukF9tIDWHhtYuvGHIAwathS4e.wl7kr2', NULL, 3, 'OwHVCpGljkXfCnI85M9x30EAkhsKtdUbbUcvWybojtYqpwQJwRgIzsMQfGru', '2015-09-29 19:40:05', '2015-10-18 13:30:54'),
(28, NULL, 'Ivan Moreno', 'ivanmoreno@gmail.com', '$2y$10$Ze8ycc1BU2M9fUA7kfiLmuNVDX9r9u4msASc8ScY9iyChkTeuPOK6', 3, 2, '8S9Hp7qEZnFbQMWCst8Uw3yW23AUhYAYLNaiUfKfNRwzxj9hJvYvh9yUebj5', '2015-10-18 12:22:42', '2015-10-21 15:00:36'),
(29, NULL, 'Miguel Iglesias Morales', 'miguel.iglesiasmorales@yahoo.es', '$2y$10$.oRJlW/0ycr2DCqejoSI2.271TSVTYHs0jVg81XW1tGoiqAH3l6Z.', 25, 2, 'BE8CrmPdBH0HbcFOObRW3111OobeMEonkqKzRltcJk3FIKxDwbJdIo7zC1iu', '2015-10-21 08:41:13', '2015-10-21 08:54:29'),
(30, '48557125X', 'Bar Paquito', 'paco@barpaquito.com', '$2y$10$/evTEJEDoftQxxRcsq76XupvroGNvmS4qr/ctfKs0f9OVwS4Dz7S.', NULL, 3, '7vTC3EqU6r5RWgJy3H2QIcT1F6rNjzlQE5Ob13UUoUdUenUMQS34bRrsUF6i', '2015-10-21 08:58:36', '2015-10-21 09:32:59');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivoscliente`
--
ALTER TABLE `archivoscliente`
  ADD CONSTRAINT `archivoscliente_clientes_id_foreign` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivoscliente_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos_archivos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivoscliente_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_gestoria_id_foreign` FOREIGN KEY (`gestoria_id`) REFERENCES `gestoria` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_archivo_id_foreign` FOREIGN KEY (`archivo_id`) REFERENCES `archivoscliente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_dni_foreign` FOREIGN KEY (`dni`) REFERENCES `clientes` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_gestoria_id_foreign` FOREIGN KEY (`gestoria_id`) REFERENCES `gestoria` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
