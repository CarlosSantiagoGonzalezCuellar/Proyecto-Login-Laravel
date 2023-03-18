-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:33065
-- Tiempo de generación: 18-03-2023 a las 17:24:59
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `loginlaravel`
--
CREATE DATABASE IF NOT EXISTS `loginlaravel` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `loginlaravel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_03_07_165422_create_users_table', 1),
(3, '2023_03_07_165651_create_roles_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '115f3ab07fb6d77daa46f67fa5f820dfc2483e0e7252762f10fcb95e8549febc', '[\"*\"]', '2023-03-18 04:01:07', NULL, '2023-03-18 03:56:49', '2023-03-18 04:01:07'),
(2, 'App\\Models\\User', 1, 'auth_token', 'f47310f4febad6193a2e51c27eb1750c391360148a950c55c90faaf529dc4f2d', '[\"*\"]', '2023-03-18 20:09:46', NULL, '2023-03-18 19:20:18', '2023-03-18 20:09:46'),
(3, 'App\\Models\\User', 1, 'auth_token', '156c1715a294164b3d8f3b0b661a040a6b2b2c2df3224aa401e1e9c9579c132a', '[\"*\"]', NULL, NULL, '2023-03-18 20:53:24', '2023-03-18 20:53:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(20) NOT NULL,
  `nombreRol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombreRol`, `created_at`, `updated_at`) VALUES
(1, 'Usuario', '2023-03-18 03:26:00', '2023-03-18 03:26:00'),
(2, 'Administrador', '2023-03-18 03:26:00', '2023-03-18 03:26:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `rol`, `correo`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Santiago Cuellar', 2, 'santiago@gmail.com', '$2y$10$kmQcShh8x059nVb.1ywh1u8zbcTFFCYl0WRDtsy2iHDcwOuzrcNSe', NULL, '2023-03-18 03:42:27', '2023-03-18 03:42:27'),
(2, 'Andres Escobar', 1, 'andres@gmail.com', '$2y$10$8V3zF372p5BQAT.Hr9UF0uE3PKAmzr7NIbhx5b487hZ6H6dwWqqvK', '2023-03-18 19:26:06', '2023-03-18 03:57:59', '2023-03-18 19:26:06'),
(3, 'Marcela Cuellar', 2, 'marcela@gmail.com', '$2y$10$XM7nQpNcG4u1WgGUoNRkkufZx2pOCm7zAUNygUfNl5AxHxF9FHX/6', NULL, '2023-03-18 19:23:18', '2023-03-18 19:23:18'),
(4, 'Tatay Torres', 1, 'tatay@gmail.com', '$2y$10$mvxnX5pjAYkQqadkEVxtCO4Pbn/.aMTaLuU0mR3bhAxjTBuEZeSAq', '2023-03-18 19:59:34', '2023-03-18 19:23:57', '2023-03-18 19:59:34'),
(5, 'Javier Cuellar', 1, 'javier@gmail.com', '$2y$10$Z0D/L4Kqu6fSobwsztFhlO6/hpIk2VpTv91mgPZqv9OdkGiHZ2NWi', NULL, '2023-03-18 20:05:17', '2023-03-18 20:05:17'),
(6, 'Ronald Perdomo', 1, 'ronald@gmail.com', '$2y$10$GYVfsbuZ.nPvPkcjssuV7.KLOxS4hBacdFMngelBWxcbwrbmhK29O', '2023-03-18 20:09:28', '2023-03-18 20:08:50', '2023-03-18 20:09:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_rol_index` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
