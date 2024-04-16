-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 16. 11:44
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `anikeys-logreg`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailtoken` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `token`, `name`, `username`, `email`, `emailtoken`, `password`, `hashed_password`, `address`, `phone`, `birthday`, `created_at`) VALUES
(1, '', '', 'root', 'root@gmail.com', '', 'root', '', '', '', '2024-04-15', '2024-03-26 13:51:54'),
(11, '', '', 'Martin', '', '', '', '$2y$10$nSVSCIUGBK2DOcwg.VSwMOXq1K.clJ0xYmMbicd8IenV/Y2gudfRu', '', '', '2024-04-15', '2024-03-26 15:05:43'),
(12, '', '', 'Kristóf', '', '', '', '$2y$10$bVQW/XuFotWV3S1LYtMawOglkFrHky.5wYIetO3.OlMqOdqA5gCve', '', '', '2024-04-15', '2024-03-26 15:22:55'),
(13, '', 'Tóth Martin Erik', 'admin', 'martintoth9@gmail.com', '58d2d99c9170d5f2131c06e9ce994f8be9357e68024fafe2a138997505f2d732240535ef358b432aa1e396eca123418c0a2b', '', '$2y$10$y78yqBM7gbLXfOxeINwAo.cfMBfqgnY0eL2FKm/sk6fXibgq1aDY2', 'o', '06202816005', '2034-09-12', '2024-04-09 19:22:17'),
(14, '', '', 'helobello', 'helobello@gmail.com', '', '', '$2y$10$8IyfugoOqBJA6I0HSoa7EOabkAEctF5dAU7fu8l4vTSD9chza5h7K', '', '', '2024-04-15', '2024-04-09 19:25:36'),
(15, '', '', 'teszt', '', '', '', '$2y$10$YazBd/xXeQYgUzXt0MKgFOpgVxe5fsyWtkQ0nBR0rmvCGDd2A7J3S', '', '', '2024-04-15', '2024-04-09 20:18:04'),
(16, '', '', '123', '', '', '', '$2y$10$b6e9UedcAPJf/X/5148rs.RKQRO7ArBE.1qk2G7iAuA2O4CPulO9u', '', '', '2024-04-15', '2024-04-09 20:18:55'),
(17, '', '', 'helo', 'kraphexe@gmail.com', '', '', '$2y$10$jzPmKxua.X4VzIv5OssY/e//2U24UjywDA5pOQsKhMYVcIlpGLen.', '', '', '2024-04-15', '2024-04-09 20:24:43'),
(18, '', '', 'kezdovagyok', 'kezdo@gmail.com', '', '', '$2y$10$qnMt2W.1IvSL8mTEmRPl/.Qw2uw1rYng4OBpBDTtL3rAs8GS98Pye', '', '', '2024-04-15', '2024-04-09 20:31:07'),
(19, '2044714291571a965a8828eb936b1f163bec514ed2f5bf81cb302f981cc3970c', '', 'test', 'test@gmail.com', '', '', '$2y$10$ZOuuQioF3GM223hhmZwKbOvFbOp3/FO1GzwGX6o.T090tcad0NxRC', '', '', '2024-04-15', '2024-04-09 20:31:34'),
(20, 'f8620bc34e1eede0b04bbfbae89e57565ca648751c551e612d2095351916610d', '', 'nemtudom', 'nemtudom@gmail.com', '', '', '$2y$10$t/WAvXY93bnNbNVSFBktOeNbGhGCTHzdgbO1zUGVaZpCrhnJJUZVm', '', '', '2024-04-15', '2024-04-09 20:34:53'),
(21, '', 'Super Admin', '', '', '', '', '$2y$10$TNsdHK6I9IPTPUoOiygeTe1zNkG/jc1zYI39Sw7pqObT7GSP9Gdby', 'London, GB', '111111111', '2024-04-16', '2024-04-15 23:19:57');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
