-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-08-2022 a las 05:54:41
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guilleguitar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bass_guitar`
--

CREATE TABLE `bass_guitar` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `caracteristicas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bass_guitar`
--

INSERT INTO `bass_guitar` (`id`, `usuario_id`, `nombre`, `caracteristicas`, `imagen`, `price`) VALUES
(1, 4, 'Zaragoza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 'imagen4.jpg', 155),
(2, 4, 'Marruecos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 'imagen5.jpg', 742),
(3, 4, 'Congo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 'imagen6.jpg', 1555),
(9, 4, 'Denver', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 'imagen7.jpg', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `usuario_id`, `nombre`, `mensaje`, `email`) VALUES
(1, NULL, '1312', '12312312', 'asdasdas@asd.com'),
(2, NULL, 'asdsa', 'hola', 'asdasdas@asd.com'),
(3, NULL, 'dfdsf', 'sdASD', 'ewrqewr@gmsjs.cod'),
(4, NULL, 'Pablo', 'fdg', 'pablo@pablosky.com'),
(5, NULL, 'ADSD', 'SDFGADSFADF', 'SAD@aDS.CPM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220711213813', '2022-07-11 23:38:21', 1511);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guitars`
--

CREATE TABLE `guitars` (
  `id` int NOT NULL,
  `usuarios_id` int DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `caracteristicas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` smallint NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `guitars`
--

INSERT INTO `guitars` (`id`, `usuarios_id`, `nombre`, `caracteristicas`, `price`, `imagen`) VALUES
(4, 4, 'Nashville', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 1507, 'imagen3.jpg'),
(5, 4, 'Alhambra', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 130, 'imagen.jpg'),
(6, 4, 'Tenesse', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 234, 'imagen1.jpg'),
(12, 4, 'Mustang', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia sem nec mattis varius. Suspendisse potenti. Vestibulum in sapien vel dui dapibus bibendum sed nec dolor. Duis non purus congue, blandit mauris quis, condimentum tellus', 123, '62eaf8bcc8d22_imagen-.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refresh_tokens`
--

CREATE TABLE `refresh_tokens` (
  `id` int NOT NULL,
  `refresh_token` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `refresh_tokens`
--

INSERT INTO `refresh_tokens` (`id`, `refresh_token`, `username`, `valid`) VALUES
(2, '8521a26f6b41566584bc4b466d8af4f6904e916e3c9ddef4801b328dc52a2469fb0ac7d6c9d3a0f824f8981ba2f7377b7f5420e63bd107cb92bd3dfe28d13198', 'user@user.com', '2022-08-10 23:54:24'),
(3, '0f8b3f2e5b30740a451677b591f4b740f6ce4cb227cc69bf547730c965b2b0b4dfd02f84bae6755aa81c830e2fab3a4cbbbfc3214791e48aa5c95e49d9ca11e6', 'user@user.com', '2022-08-11 00:01:53'),
(4, '24b47bdf025a4db6bcb82d24869d6516a078c24c117b9a7e23101fa3411ade9244810da013a70bd824b5ebe163d62aa8f6097d70d049771af2bcdf3e2595c24a', 'user@user.com', '2022-08-11 00:54:43'),
(5, '109a9ecf6c948458b2c93915d28a9fd9855ffc1d183700ab95928e545b8c7b8b0635f6e5941e3b063f1420dcd8f410803c233cda234b3e71c5fcff24e780a03b', 'user@user.com', '2022-08-11 10:06:46'),
(6, '39caf8bf0d93eb2d4cd24c5bff3421da9c5c92dbbeea53f6fc4d79dc7abb6b7a8d4cac730bbdd53a83042b8c19bdb9122548899c104d61fa3b3df5668124413c', 'user@user.com', '2022-08-11 10:41:23'),
(7, '0adbbc87d1208fe01849d5d6eb71676ef3ddf1d22e42666c0d1fa108bbe859929a93dbb8ac05c86712f257ccd25aa5dbf7ca87cf4f300ee4b5887c79a5c2393c', 'tudela@tudela.com', '2022-08-11 10:46:10'),
(8, 'f3a921936b04308d42ddf6029002d042496252e3c44783b70ec7ddc34890425a827e0b89b521f37d077beff55d9924aaa0d912670f4e3d435d0b37a1515158e8', 'tudela@tudela.com', '2022-08-11 10:55:26'),
(9, 'eac33285b430850b2c79fabee7a4d40168197d214d7049ce374ce2587b8c9321ba4dc041e0c27fed726fdd2f765b7dc701f6cbb68fbbf24569af60db87ee684e', 'tudela@tudela.com', '2022-08-11 11:31:24'),
(10, 'c3636553dd27f00ccabffb340992cda69d24fd56dff5856e0d11400802b4796323d4fc227e1708f76798391115b787845cb2724942052a610932db7153cc0e7f', 'tudela@tudela.com', '2022-08-11 15:39:08'),
(11, '06c3ac02ea482fa2fbcc9034ff97f91f881dd5bc917fe42294b89da8de08458b13f07fbb74794a9ba82e3ded25eafd785a022a58b8cfebbf4243c1c2379c4677', 'tudela@tudela.com', '2022-08-11 15:39:44'),
(12, 'dde35188e3a47825e9980a25cde3ad46c614d68912972554476f202881d54eea4f1206c9b92ad6c718517d363a8a193f33d64095f72121b08cad48a05911bd2e', 'tudela@tudela.com', '2022-08-11 15:59:24'),
(13, 'de2835af6b8d6db0c8c93afd53ff085cf5429b88b72005dbcab5bbb6fe453e07dc306f5ff30a5234f40332c06cf39f77c376dc68b0c49aba89494b0316e0099b', 'tudela@tudela.com', '2022-08-11 16:00:38'),
(14, '273c5130080c51140b29fc32b091769e75116ccbc915337ccfca8d1d9ad70792487f4c18b739abafa425f66e130fd55543b89e3a913d3c3ae88fe3989301396d', 'tudela@tudela.com', '2022-08-11 17:06:29'),
(15, '9dc6eba30b889733f3c5843f8dd906b4a3deffe00fe1b7969f768168b27bb5b39bd4d62be21e5d3350e46680b9dd8b22f6c8400bd90f7a7aed263a1aec518077', 'tudela@tudela.com', '2022-08-11 19:03:40'),
(16, 'c4cfd5caa460830b957c89bd93305dea94388bd4c23cac034e1e3bfb11cda9e92cf209305d2df87ca25e8cb6b92b76dee5b30bde79ffcab3cd623cde56bef270', 'tudela@tudela.com', '2022-08-11 19:05:13'),
(17, '7ef14ff3ae800ff83c942890c507ddf6b7b68e61a056ae0dc02e8647841c37d029422db5261dc73f464afd0bd6e27d461f30b3d4d2d597a2d0cbb8ba3e3ab8be', 'tudela@tudela.com', '2022-08-11 19:30:18'),
(18, '6ce2f1344f62ca5ff345168173bc2d0f830e5d2cecd72cf04c7f386ffcf8fd80b59b1786b0fc2998d3cb7655ce9a76c74df329bd005260679050d98083bd8b87', 'tudela@tudela.com', '2022-09-01 12:49:49'),
(19, 'fd31d696289a19f5c21c8aa3ffe42d1325be6c80c357acd2e12bdf1ce4d7274c877883c8d680bc58f8635d793d0d377ef9218c3d008d2decaf4dfcfbab81fc4f', 'guillermotudelareyes@gmail.com', '2022-09-02 10:36:22'),
(20, '91d1b67809ba6583c11744ca29ccd961a552969c4801362c6f9e94f242947f867f69ffcff5f8c5b589d04119ae7049e6b43e4ec124f166b65e64955862e17173', 'tudela@tudela.com', '2022-09-02 10:36:51'),
(21, 'bbf05ad48215ca9c9691997c9f8fdebb1355dc98c0cd58405f230076bed5c9cb6f9d8cd3ab815bbbe004231dba747e5431d1e9f52443a76f7587509d0f3ff99e', 'tudela@tudela.com', '2022-09-02 10:38:38'),
(22, '58ac404926139d07ccc4c601faddba225ed9e838e4237584d978e7c690db4bf106169bdc0519e7ae7154b0ff271d5fb594a886d8ac6ee369c467c95460177f40', 'guillermotudelareyes@gmail.com', '2022-09-02 10:43:06'),
(23, '8ce091aa4c2bcbd2805bd5142ad519b62e9f3d266955bd80286027e2588a013f281f168f59ccec6c76483cdbae8626404c43ac12b87e6ea287995392de0749e6', 'tudela@tudela.com', '2022-09-02 10:44:21'),
(24, '98a8ac422d300a9860f131698f4bc3a5a2166c75edf4604e140d76d04687775fcf3d7badf0c654b25659145acb2e9fe4b004029978f06c9fe96a6a1bd38b6b26', 'tudela@tudela.com', '2022-09-02 11:07:42'),
(25, '73e6be42fa7467df129b869aa54dd6d3f4491dabfaec380d8d40e7a5c4d45729393e28445855bf779e2977fbc3512c893dd2c688abe52c0d2b5dffc0886bb0e1', 'tudela@tudela.com', '2022-09-02 11:08:14'),
(26, '0f6e7cb4e673d1dc8e7006f71dbf201a083adf2827e12b7361fc3d4e2b0d11a5891c4094f466066bedbc0f704990bfa91fd22a026bce7e339f0146bbf1db1bf6', 'tudela@tudela.com', '2022-09-02 11:08:40'),
(27, '4631119a9c4b75c9d9f15cd182e2a3445168bc41e01e2d7bc153fe70733e48ddf106a49c77aa108f7b0721a34c43482f924f9ad898b87b5d9a91c5d38b405fa0', 'tudela@tudela.com', '2022-09-02 11:10:05'),
(28, '9566f15a2e50fbddf106eacf8f5a0a78c552204b01755f13629417720175ccafe3e3b087e383e4b7c8fb8155d4cb4b609201c216619f1b9e88c075e76ac38c80', 'pablo@pablo.com', '2022-09-02 11:14:35'),
(29, '884bb0651dc08c3b8d1580a6c78faa96002e0c1e2b67175aaa43e04a288269e10cbead3a69a1727e0b90fb64ad79814a1af6ca96f51207af3a051304c25f7e35', 'tudela@tudela.com', '2022-09-03 00:07:56'),
(30, '9f712746573c5d301e7f5426c2b9decc997afbd4f66906ab61b807f339f366e320ab71af6670f2a2f98e0b0bff698b054fe2e5c0ed469d34c4ee629e616bf1a9', 'tudela@tudela.com', '2022-09-03 05:51:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `roles`, `password`, `nombre`, `perfil`) VALUES
(4, 'tudela@tudela.com', '[]', '$2y$13$oRz0ZfP.k9zpknFCbw7cGeURtM5dM0BrB4JlXbRpyYtTWgFsZNiFG', 'Guille', '62ea3b6c6c93f_piba.jpg'),
(5, 'guillermotudelareyes@gmail.com', '[]', '$2y$13$g.49lTsJmciVJCVQCuOHMOvsJp523a31oPmADEZv/eYagiUctjqOi', '123', '62cd7cee3ee74_background.jpg'),
(6, 'pablo@pablo.com', '[]', '$2y$13$6UxtOtxQJ8Lv/9Spj60vJe399y6joPVN0eW64fiPS9Rrh97bUuF86', 'Pablo', '62ea3c6250065_piba.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bass_guitar`
--
ALTER TABLE `bass_guitar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_908E63C8DB38439E` (`usuario_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2741493CDB38439E` (`usuario_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `guitars`
--
ALTER TABLE `guitars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65FD8975F01D3B25` (`usuarios_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bass_guitar`
--
ALTER TABLE `bass_guitar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `guitars`
--
ALTER TABLE `guitars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `refresh_tokens`
--
ALTER TABLE `refresh_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bass_guitar`
--
ALTER TABLE `bass_guitar`
  ADD CONSTRAINT `FK_908E63C8DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `FK_2741493CDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `guitars`
--
ALTER TABLE `guitars`
  ADD CONSTRAINT `FK_65FD8975F01D3B25` FOREIGN KEY (`usuarios_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
