-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 18. 17:17
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `anikeys`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `user_id`, `added_at`) VALUES
(5, 8, 1, 'asd', '2024-04-17 22:11:49'),
(30, 41, 1, 'admin', '2024-04-18 12:36:20'),
(32, 0, 2, 'admin', '2024-04-18 16:58:25'),
(36, 37, 1, 'Teszt', '2024-04-18 17:14:28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `sale` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `imageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `sale`, `category_id`, `creationDate`, `imageURL`) VALUES
(33, 'Hogwarts Legacy', 29000, 'Hogwarts Legacy', 5, 1, '2024-04-18 12:27:14', 'uploads/3XopdGAJGRy3xNQKnQDvaCRs.webp'),
(35, 'Horizon Forbidden West', 31600, 'Ismertető: A Horizon Forbidden West a Guerrilla Games által fejlesztett PlayStation exkluzív akció-kaland játék, amely a Horizon Zero Dawn folytatása. A játék egy post-apokaliptikus világban játszódik, ahol a főhős, Aloy egy nyitott világban próbálja felfedezni a rejtélyeket és a túlélésért folytatott harcot. A játékban számos új helyszín, lény és küldetés várható, valamint további történetfejlemények Aloy karakterével. Rendszerkövetelmények: PlayStation 4: Platform: PlayStation 4 vagy PlayStation 4 Pro Tárhely: Minimum 100 GB szabad tárhely Egyéb: PlayStation Plus előfizetés lehet szükséges a multiplayer módokhoz PlayStation 5: Platform: PlayStation 5 Tárhely: Minimum 100 GB szabad tárhely Egyéb: A játék kihasználja a PlayStation 5 teljesítményét és funkcióit, például a gyorsbetöltést és a DualSense vezérlő speciális funkcióit. PC (Amennyiben elérhető lesz PC-re is): Platform: Windows 10 Processzor: Intel Core i5-2500K vagy AMD FX-6300 Memória: 8 GB RAM Grafikus kártya: NVIDIA GeForce GTX 780 vagy AMD Radeon', 25, 2, '2024-04-18 12:27:59', 'uploads/HO8vkO9pfXhwbHi5WHECQJdN.webp'),
(37, 'Vampire: The Masquerade – Bloodlines 2', 29559, '', 5, 2, '2024-04-18 12:35:08', 'uploads/bloodlines2-phyre-keyart-1698768010178.png'),
(38, 'Prince of Persia: The Lost Crown', 13499, '', 5, 1, '2024-04-18 12:35:08', 'uploads/prince-of-persia-the-lost-crown-review-cover.webp'),
(39, 'warhammer 40k space marine 2', 46799, '', 3, 1, '2024-04-18 12:35:08', 'uploads/section1-1.jpg'),
(40, 'warhammer 40k space marine 2', 46799, '', 3, 1, '2024-04-18 12:35:08', 'uploads/section1-1.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `imageURL` varchar(255) NOT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emailtoken` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `imageURL`, `token`, `role`, `name`, `username`, `email`, `emailtoken`, `hashed_password`, `address`, `phone`, `birthday`, `created_at`) VALUES
(1, '', '539a71cdcd3309e6e4bba6605de142ba3b33938c7fbf5c354282f944dc150410', NULL, NULL, 'asd', 'tofi04@icloud.com', NULL, '$2y$10$Rwa3xVR05J1YhruXoDKBxOQVXJ427yYL1ySLQEAjLmwKHBjUlDAua', NULL, NULL, NULL, '2024-04-17 17:49:30'),
(2, '', '42f0e8d9023e5b40cda73c334068a4102aaec1472c1acec61b34b7134d0f621a', NULL, 'Tóth Martin Erik', 'Hiimmartin', 'martintoth9@gmail.com', NULL, '$2y$10$1Oc95Ph9YdVfNckLASpgaeQZ7tx0sVOSUjwlQVTqdy2ZgFz5l7kKu', 'Pécs, Kertváros utca 56.', '60 20 281 6005', '2004-04-29', '2024-04-18 11:02:12'),
(3, 'uploads\\3XopdGAJGRy3xNQKnQDvaCRs.webp', NULL, NULL, 'Tóth Martin Erik', 'admin', 'admin@gmail.com', NULL, '$2y$10$aXyI8soOPY2xZdtBgKJh7uFtVRBfjVv2l5u1qKWwWKO/3kxqEEg/e', 'asd', '06202816005', '2024-04-17', '2024-04-18 12:24:49'),
(4, '', 'b764ff94e9217169675cc5e34e0a7dde68e22da351f918d8607fa70a66921cff', NULL, NULL, 'Teszt', 'teszt@gmail.com', NULL, '$2y$10$R0.sw4vyfi8EvVnnJuIXEOcpX3vker2dws80bZMCNPXY5e2cV0wCu', NULL, NULL, NULL, '2024-04-18 17:04:20');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
