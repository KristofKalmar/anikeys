-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 21. 19:54
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
  `username` varchar(255) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `username`, `added_at`) VALUES
(5, 8, 1, 'Teszt', '2024-04-21 19:45:10');

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
  `CPU` int(11) DEFAULT 0,
  `GPU` int(11) DEFAULT 0,
  `MEMORY` int(11) DEFAULT 0,
  `OPSYSTEM` int(11) DEFAULT 0,
  `STORAGE_GB` int(11) DEFAULT 0,
  `creationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `imageURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `sale`, `category_id`, `CPU`, `GPU`, `MEMORY`, `OPSYSTEM`, `STORAGE_GB`, `creationDate`, `imageURL`) VALUES
(1, 'Super Mario Bros.™', 7904, 'Super Mario Bros.™ a videojáték történelem egyik legikonikusabb platformjátéka, melyben a játékosok Mario szerepében különböző világokat járhatnak be, akadályokat ugrálva, ellenségeket legyőzve, hogy megmenthessék a hercegnőt a gonosz Bowser karmai közül.', 3, 4, 0, 0, 0, 0, 6, '2024-04-21 19:35:23', 'uploads/SuperMarioBrosWonder.jpg'),
(2, 'Star Wars Outlaws 2', 31499, 'Han Solo női verziójával a főszerepben érkezik az Ubisoft-féle, Star Wars Outlaws című nyílt világú sci-fi – és már azt is tudjuk, hogy mikor. Augusztus 30-án kerül polcokra a videójáték, mely PlayStation 5 mellett Xbox Series X/S-en és PC-n is elérhető lesz. Valamilyen szinten a mai napig eseményjellege van, amikor egy új, a messzi-messzi galaxisba kalauzoló produktum napvilágot lát, de a Disney által birtokolt kultikus franchise mostanra lesüllyedt arra a szintre, hogy egyre kevésbé üti át a mainstream ingerküszöbét. Kivéve persze, amikor az utálkozásról van szó, ez utóbbi fronton a Star Wars Outlaws éppen nagyot megy az interneten.', 5, 1, 2, 3, 4, 2, 80, '2024-04-21 19:35:23', 'uploads/star-wars-outlaws-2-scaled.jpg'),
(3, 'Hogwarts Legacy', 18299, 'Hogwarts Legacy egy varázslatos akció-szerepjáték, amely lehetővé teszi a játékosoknak, hogy felfedezzék a varázsvilágot, kalandokban vegyenek részt, és saját útjukat járják az ikonikus Roxfort Varázslóképző Iskolában.', 10, 2, 0, 0, 0, 0, 160, '2024-04-21 19:35:23', 'uploads/3XopdGAJGRy3xNQKnQDvaCRs.webp'),
(4, 'Prince of Persia: The Lost Crown', 28480, 'A Perzsa Birodalomban nehéz idők járnak. A kiszáradt földekre már 30 éve nem hullott eső, az éhező népet pedig a hódító kusánok támadják, akiket az utolsó csatában csakis a hét legkiválóbb perzsa harcosnak, a Halhatatlanoknak köszönhetően sikerült legyőzni. És a helyzet ezután sem fordul jobbra. A herceget ismeretlen okból a mitikus Qaf-hegyre cipelik, ahol egykor Szimurg, a madáristen áldását adta Perzsia soron következő uralkodóira.', 25, 1, 4, 9, 5, 3, 230, '2024-04-21 19:35:23', 'uploads/EGST_StoreLandscape_2560x1440_2560x1440-d49d4862a0e1a243638d5f95517ed205.jfif'),
(5, 'Sons Of The Forest', 11450, 'Sons of the Forest egy izgalmas túlélő-horror játék, melyben a játékosok egy elhagyatott erdőben találják magukat, ahol vadállatok, rejtélyes lények és más veszélyek fenyegetik őket. A túlélés érdekében építeniük kell, erőforrásokat gyűjteniük, és szembeszállniuk kell az ismeretlen veszélyekkel, miközben megpróbálják kideríteni az erdő rejtélyeit.', 5, 1, 2, 1, 3, 2, 16, '2024-04-21 19:35:23', 'uploads/sons-of-the-forest-blank.png'),
(6, 'Baldur\'s Gate 3', 15650, 'Baldur\'s Gate 3 egy epikus szerepjáték, melyben a játékosok egy izgalmas és veszélyekkel teli fantasy világban kalandozhatnak, különféle szörnyekkel és kihívásokkal szembesülve, miközben saját karakterük fejlődését irányíthatják és döntéseket hozhatnak, amelyek befolyásolják a történetet.', 11, 3, 0, 0, 0, 0, 135, '2024-04-21 19:35:23', 'uploads/bg3_logo_HD.jpg'),
(7, 'Horizon Focus Forbidden West', 24500, 'A Horizon: Zero Dawn közvetlen folytatásában Aloy visszatér és a kaliforniai Nyugati Part misztikummal átszőtt vidékére téved - ahol a világ jövőjét befolyásoló kalandba keveredik.', 25, 1, 2, 3, 4, 2, 140, '2024-04-21 19:35:23', 'uploads/HO8vkO9pfXhwbHi5WHECQJdN.webp'),
(8, 'Grand Theft Auto VI', 33599, 'A Grand Theft Auto VI a Rockstar Games által készített akció-kalandjáték, melyben a játékosok egy lenyűgöző, nyílt világú városban kalandozhatnak, és bűnözői utat járhatnak be, miközben újabb történeteket fedeznek fel és különféle küldetéseket teljesítenek.', 15, 1, 4, 7, 5, 3, 300, '2024-04-21 19:35:23', 'uploads/71d4d17edcd49703a5ea446cc0e588e6.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `purchasedproducts`
--

CREATE TABLE `purchasedproducts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `added_at` datetime DEFAULT current_timestamp(),
  `code` varchar(255) NOT NULL,
  `revealed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `purchasedproducts`
--

INSERT INTO `purchasedproducts` (`id`, `product_id`, `username`, `added_at`, `code`, `revealed`) VALUES
(1, 1, 'admin', '2024-04-21 19:36:03', '8c0be6da-be6a-4d49-a5e0-162509a14b16', 0),
(2, 4, 'admin', '2024-04-21 19:36:15', '5895451f-af57-419f-a6f9-31e42ae28a43', 1),
(3, 1, 'Teszt', '2024-04-21 19:45:04', '5aa5d3f8-716b-4cf4-91c3-99dde12907b7', 0),
(4, 3, 'Teszt', '2024-04-21 19:45:04', '9002e394-bf98-45c1-89ef-5c7b375f6c00', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL,
  `emailtoken` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `CPU` int(11) DEFAULT 0,
  `GPU` int(11) DEFAULT 0,
  `MEMORY` int(11) DEFAULT 0,
  `OPSYSTEM` int(11) DEFAULT 0,
  `birthday` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `token`, `role`, `name`, `username`, `email`, `imageURL`, `emailtoken`, `hashed_password`, `address`, `phone`, `CPU`, `GPU`, `MEMORY`, `OPSYSTEM`, `birthday`, `created_at`) VALUES
(1, '64287111ef4c821ef8ffc75eb88bab20942287cc9e452fb85946eeb791f19386', 'admin', 'Tóth Martin Erik', 'admin', 'martintoth9@gmail.com', 'uploads/blog-2.jpg', NULL, '$2y$10$md295Oo7p2R.eSAl1yFpruSQUJMXlZsh11kFyBqEtbRO5QjuYs3fK', 'Pécs, xxxxxxxxx', '+3620 111 1111', 3, 4, 6, 3, '2004-04-29', '2024-04-21 19:25:09'),
(2, '4acdc3c978b8be5a9e549d7ed648efd04ab64b0ee2ffc59b51f480058e798d69', NULL, 'Teszt Elek', 'Teszt', 'teszt@gmail.com', 'uploads/bg3_logo_HD.jpg', NULL, '$2y$10$/fqRifq2QWI9JgS3566gveWMMjt4EXlWC6tw3ImuR01MqBPUAnx3a', 'Pécs, tesztelek utca 1', '+3620 1 111 111', 0, 0, 0, 0, '2024-04-03', '2024-04-21 19:36:59');

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
-- A tábla indexei `purchasedproducts`
--
ALTER TABLE `purchasedproducts`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `purchasedproducts`
--
ALTER TABLE `purchasedproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
