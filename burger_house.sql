-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 28. 13:28
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
-- Adatbázis: `burger_house`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `baskets`
--

CREATE TABLE `baskets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `basket_extras`
--

CREATE TABLE `basket_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `basket_item_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `basket_items`
--

CREATE TABLE `basket_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `basket_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `buying_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'burgerek', '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(2, 'deszertek', '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(3, 'italok', '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(4, 'köretek', '2025-04-28 09:28:12', '2025-04-28 09:28:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `compositions`
--

CREATE TABLE `compositions` (
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `compositions`
--

INSERT INTO `compositions` (`menu_item_id`, `ingredient_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(8, 1, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 2, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 2, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 2, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 2, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 3, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 3, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 3, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 3, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 4, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 4, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 4, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 5, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 5, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 5, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 5, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 6, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 6, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 6, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 6, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 7, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(8, 8, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 9, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 10, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 10, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 10, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 10, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 11, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 11, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(8, 11, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 12, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 13, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 14, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(1, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 15, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(8, 16, '2025-04-28 09:28:13', '2025-04-28 09:28:13');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `extra_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `extra_price`, `created_at`, `updated_at`) VALUES
(1, 'sajt', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(2, 'ketchup', 200, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(3, 'mustár', 100, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(4, 'majonéz', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(5, 'hagyma', 100, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(6, 'uborka', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(7, 'paradicsom', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(8, 'jégsaláta', 150, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(9, 'jalapeno', 200, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(10, 'húspogácsa', 500, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(11, 'bacon', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(12, 'halpogácsa', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(13, 'csirkemell', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(14, 'vega hús', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(15, 'buci', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(16, 'toast kenyér', 300, '2025-04-28 09:28:12', '2025-04-28 09:28:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount_amount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `category_id`, `image_path`, `price`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, 'Sajtburger', 'Marhahúspogácsa zsemlében, ömlesztett cheddar sajtszelettel, savanyú uborkával, hagymával, ketchuppal és mustárral.', 1, 'http://localhost:8000/images/cheeseburger.jpg', 1490, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(2, 'Baconsajtburger', 'Marhahúspogácsa zsemlében, bacon szeletekkel, cheddar sajttal, salátával és BBQ szósszal.', 1, 'http://localhost:8000/images/baconburger.jpg', 1690, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(3, 'Csirkeburger', 'Ropogós csirkemell zsemlében, salátával, paradicsommal és majonézzel.', 1, 'http://localhost:8000/images/chickenburger.jpg', 1390, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(4, 'Vega burger', 'Zöldségpogácsa zsemlében, salátával, paradicsommal, uborkával és vegán majonézzel.', 1, 'http://localhost:8000/images/vegan-burger.jpg', 1290, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(5, 'Dupla sajtburger', 'Két marhahúspogácsa, dupla cheddar sajttal, savanyú uborkával és hagymával.', 1, 'http://localhost:8000/images/double-cheeseburger.jpg', 1990, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(6, 'Chilis burger', 'Marhahúspogácsa, jalapeno paprikával, cheddar sajttal, salátával és csípős szósszal.', 1, 'http://localhost:8000/images/chiliburger.jpg', 1590, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(7, 'Halas burger', 'Ropogós halfilé zsemlében, salátával, tartármártással és citrommal.', 1, 'http://localhost:8000/images/fishburger.jpg', 1490, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(8, 'Grill szendvics', 'Grillezett csirkemell, pirított zsemle, salátával, paradicsommal és majonézzel.', 1, 'http://localhost:8000/images/grill-sandwich.jpg', 1590, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(9, 'Coca-Cola', 'Frissítő szénsavas üdítőital.', 3, 'http://localhost:8000/images/coca-cola.jpg', 490, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(10, 'Narancslé', '100%-os frissen facsart narancslé.', 3, 'http://localhost:8000/images/orange-juice.jpg', 590, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(11, 'Ásványvíz', 'Szénsavmentes ásványvíz.', 3, 'http://localhost:8000/images/mineral-water.jpg', 390, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(12, 'Hasábburgonya', 'Ropogósra sült hasábburgonya.', 4, 'http://localhost:8000/images/french-fries.jpg', 690, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(13, 'Rizs', 'Párolt fehér rizs.', 4, 'http://localhost:8000/images/rice.jpg', 590, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(14, 'Saláta', 'Friss zöldségekből készült saláta.', 4, 'http://localhost:8000/images/salad.jpg', 790, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(15, 'Csokoládétorta', 'Gazdag csokoládés sütemény.', 2, 'http://localhost:8000/images/chocolate-cake.jpg', 990, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(16, 'Fagylaltkehely', 'Három gombóc fagylalt tejszínhabbal.', 2, 'http://localhost:8000/images/ice-cream.jpg', 890, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12'),
(17, 'Gyümölcssaláta', 'Friss gyümölcsökből készült saláta.', 2, 'http://localhost:8000/images/fruit-salad.jpg', 790, 0, '2025-04-28 09:28:12', '2025-04-28 09:28:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_14_105726_create_personal_access_tokens_table', 1),
(5, '2024_12_20_092247_create_baskets_table', 1),
(6, '2024_12_20_092326_create_categories_table', 1),
(7, '2024_12_20_092453_create_basket_items_table', 1),
(8, '2024_12_20_092508_create_orders_table', 1),
(9, '2024_12_20_092636_create_basket_extras_table', 1),
(10, '2024_12_20_094517_create_menu_items_table', 1),
(11, '2024_12_20_095454_create_ingredients_table', 1),
(12, '2024_12_20_095957_create_order_items_table', 1),
(13, '2024_12_20_100743_create_compositions_table', 1),
(14, '2024_12_20_101605_create_order_item_extras_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'készül',
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `delivery_address`, `status`, `total`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'kiszállítva', 1480, '2025-04-14 09:28:12', '2025-04-28 09:28:13'),
(2, 3, 'Budapest, Petőfi Sándor utca 5.', 'kiszállítva', 3170, '2025-04-06 09:28:12', '2025-04-28 09:28:13'),
(3, 3, NULL, 'kiszállítva', 2380, '2025-04-21 09:28:12', '2025-04-28 09:28:13'),
(4, 2, NULL, 'kiszállítva', 3570, '2025-04-26 09:28:12', '2025-04-28 09:28:13'),
(5, 1, 'Diósd, Tisza Lajos körút 8.', 'kiszállítva', 990, '2025-04-11 09:28:12', '2025-04-28 09:28:13'),
(6, 3, 'Budaörs, Baross Gábor utca 3.', 'kiszállítva', 2980, '2025-04-06 09:28:12', '2025-04-28 09:28:13'),
(7, 1, NULL, 'kiszállítva', 2680, '2025-04-22 09:28:12', '2025-04-28 09:28:13'),
(8, 3, NULL, 'kiszállítva', 2380, '2025-04-14 09:28:12', '2025-04-28 09:28:13'),
(9, 3, NULL, 'kiszállítva', 2180, '2025-04-24 09:28:12', '2025-04-28 09:28:13'),
(10, 1, NULL, 'kiszállítva', 1490, '2025-03-29 10:28:12', '2025-04-28 09:28:13'),
(11, 1, 'Érd, Nagyerdei körút 12.', 'kiszállítva', 3070, '2025-04-14 09:28:12', '2025-04-28 09:28:13'),
(12, 1, 'Diósd, Tisza Lajos körút 8.', 'kiszállítva', 1880, '2025-04-08 09:28:12', '2025-04-28 09:28:13'),
(13, 3, NULL, 'kiszállítva', 1390, '2025-04-03 09:28:12', '2025-04-28 09:28:13'),
(14, 3, 'Érd, Nagyerdei körút 12.', 'kiszállítva', 1290, '2025-03-30 09:28:12', '2025-04-28 09:28:13'),
(15, 2, 'Budapest, Kossuth Lajos utca 2.', 'kiszállítva', 1580, '2025-04-05 09:28:12', '2025-04-28 09:28:13'),
(16, 2, 'Budapest, Petőfi Sándor utca 5.', 'kiszállítva', 1490, '2025-04-02 09:28:12', '2025-04-28 09:28:13'),
(17, 1, NULL, 'kiszállítva', 2180, '2025-04-12 09:28:12', '2025-04-28 09:28:13'),
(18, 1, 'Budapest, Kossuth Lajos utca 2.', 'kiszállítva', 1490, '2025-03-31 09:28:12', '2025-04-28 09:28:13'),
(19, 1, NULL, 'kiszállítva', 1580, '2025-04-02 09:28:12', '2025-04-28 09:28:13'),
(20, 3, NULL, 'kiszállítva', 1880, '2025-04-16 09:28:12', '2025-04-28 09:28:13'),
(21, 3, 'Budapest, Petőfi Sándor utca 5.', 'kiszállítva', 690, '2025-04-18 09:28:12', '2025-04-28 09:28:13'),
(22, 2, 'Budaörs, Baross Gábor utca 3.', 'kiszállítva', 1490, '2025-04-13 09:28:12', '2025-04-28 09:28:13'),
(23, 1, 'Budaörs, Baross Gábor utca 3.', 'kiszállítva', 2480, '2025-04-13 09:28:12', '2025-04-28 09:28:13'),
(24, 3, 'Budapest, Petőfi Sándor utca 5.', 'kiszállítva', 2470, '2025-04-21 09:28:12', '2025-04-28 09:28:13'),
(25, 2, NULL, 'kiszállítva', 1590, '2025-04-19 09:28:12', '2025-04-28 09:28:13'),
(26, 3, NULL, 'kiszállítva', 2280, '2025-04-11 09:28:12', '2025-04-28 09:28:13'),
(27, 2, NULL, 'kiszállítva', 2380, '2025-04-12 09:28:12', '2025-04-28 09:28:13'),
(28, 1, NULL, 'kiszállítva', 2480, '2025-04-01 09:28:12', '2025-04-28 09:28:13'),
(29, 3, 'Érd, Nagyerdei körút 12.', 'kiszállítva', 2580, '2025-04-14 09:28:12', '2025-04-28 09:28:13'),
(30, 2, 'Érd, Nagyerdei körút 12.', 'kiszállítva', 980, '2025-04-05 09:28:12', '2025-04-28 09:28:13'),
(31, 2, 'Budapest, Kossuth Lajos utca 2.', 'kiszállítva', 390, '2025-04-27 09:28:12', '2025-04-28 09:28:13'),
(32, 1, 'Budapest, Petőfi Sándor utca 5.', 'kiszállítva', 3280, '2025-04-23 09:28:12', '2025-04-28 09:28:13'),
(33, 1, NULL, 'kiszállítva', 990, '2025-04-21 09:28:12', '2025-04-28 09:28:13'),
(34, 3, 'Budaörs, Baross Gábor utca 3.', 'kiszállítva', 2280, '2025-04-25 09:28:12', '2025-04-28 09:28:13'),
(35, 1, 'Budaörs, Baross Gábor utca 3.', 'kiszállítva', 3270, '2025-04-22 09:28:12', '2025-04-28 09:28:13'),
(36, 2, 'Budapest, Petőfi Sándor utca 5.', 'kiszállítva', 3970, '2025-04-09 09:28:12', '2025-04-28 09:28:13'),
(37, 2, NULL, 'kiszállítva', 2180, '2025-04-02 09:28:12', '2025-04-28 09:28:13'),
(38, 1, 'Budaörs, Baross Gábor utca 3.', 'kiszállítva', 3070, '2025-04-27 09:28:12', '2025-04-28 09:28:13'),
(39, 2, 'Érd, Nagyerdei körút 12.', 'kiszállítva', 1590, '2025-04-14 09:28:12', '2025-04-28 09:28:13'),
(40, 1, NULL, 'kiszállítva', 2870, '2025-04-16 09:28:12', '2025-04-28 09:28:13');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `buying_price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_item_id`, `buying_price`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(2, 1, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(3, 2, 8, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(4, 2, 12, 690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(5, 2, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(6, 3, 2, 1690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(7, 3, 12, 690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(8, 4, 3, 1390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(9, 4, 4, 1290, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(10, 4, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(11, 5, 15, 990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(12, 6, 3, 1390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(13, 6, 8, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(14, 7, 5, 1990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(15, 7, 12, 690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(16, 8, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(17, 8, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(18, 9, 4, 1290, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(19, 9, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(20, 10, 1, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(21, 11, 3, 1390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(22, 11, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(23, 11, 17, 790, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(24, 12, 4, 1290, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(25, 12, 10, 590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(26, 13, 3, 1390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(27, 14, 4, 1290, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(28, 15, 14, 790, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(29, 15, 17, 790, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(30, 16, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(31, 17, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(32, 17, 12, 690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(33, 18, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(34, 19, 10, 590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(35, 19, 15, 990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(36, 20, 15, 990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(37, 20, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(38, 21, 12, 690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(39, 22, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(40, 23, 6, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(41, 23, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(42, 24, 3, 1390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(43, 24, 11, 390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(44, 24, 12, 690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(45, 25, 6, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(46, 26, 1, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(47, 26, 17, 790, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(48, 27, 1, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(49, 27, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(50, 28, 5, 1990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(51, 28, 9, 490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(52, 29, 2, 1690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(53, 29, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(54, 30, 10, 590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(55, 30, 11, 390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(56, 31, 11, 390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(57, 32, 2, 1690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(58, 32, 8, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(59, 33, 15, 990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(60, 34, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(61, 34, 14, 790, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(62, 35, 1, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(63, 35, 3, 1390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(64, 35, 11, 390, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(65, 36, 5, 1990, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(66, 36, 7, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(67, 36, 9, 490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(68, 37, 6, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(69, 37, 10, 590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(70, 38, 2, 1690, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(71, 38, 9, 490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(72, 38, 16, 890, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(73, 39, 8, 1590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(74, 40, 1, 1490, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(75, 40, 10, 590, '2025-04-28 09:28:13', '2025-04-28 09:28:13'),
(76, 40, 14, 790, '2025-04-28 09:28:13', '2025-04-28 09:28:13');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order_item_extras`
--

CREATE TABLE `order_item_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.hu', NULL, '$2y$12$w3.PFHsDuU5yzDrxtfvhh.7/t/fbg/Vd9qJxs8PTP38RocbQDJ6B.', 1, '2040, Budaörs, Lévai utca, 29', NULL, '2025-04-28 09:28:11', '2025-04-28 09:28:11'),
(2, 'User', 'user@user.hu', NULL, '$2y$12$gVEeOb/izFWhyNDF5wQIt.9m.hgL1bPo4oK.nlW.XP8jm5IbN/Ba2', 0, '2000, Budaörs, Lévai utca, 29', NULL, '2025-04-28 09:28:11', '2025-04-28 09:28:11'),
(3, 'Ákos', 'akoskosztolanyi@gmail.com', NULL, '$2y$12$qc7sBvZWZbOd6Z71Y73gf.cTTXIuN6Ojs/puamQC368zoEQqcjQri', 0, '2040, Budaörs, Lévai utca, 29', NULL, '2025-04-28 09:28:12', '2025-04-28 09:28:12');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `basket_extras`
--
ALTER TABLE `basket_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basket_extras_basket_item_id_foreign` (`basket_item_id`);

--
-- A tábla indexei `basket_items`
--
ALTER TABLE `basket_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basket_items_basket_id_foreign` (`basket_id`);

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `compositions`
--
ALTER TABLE `compositions`
  ADD PRIMARY KEY (`ingredient_id`,`menu_item_id`),
  ADD KEY `compositions_menu_item_id_foreign` (`menu_item_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ingredients_name_unique` (`name`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_items_name_unique` (`name`),
  ADD UNIQUE KEY `menu_items_image_path_unique` (`image_path`),
  ADD KEY `menu_items_category_id_foreign` (`category_id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- A tábla indexei `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_item_id_foreign` (`menu_item_id`);

--
-- A tábla indexei `order_item_extras`
--
ALTER TABLE `order_item_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_extras_order_item_id_foreign` (`order_item_id`),
  ADD KEY `order_item_extras_ingredient_id_foreign` (`ingredient_id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `basket_extras`
--
ALTER TABLE `basket_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `basket_items`
--
ALTER TABLE `basket_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT a táblához `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT a táblához `order_item_extras`
--
ALTER TABLE `order_item_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `basket_extras`
--
ALTER TABLE `basket_extras`
  ADD CONSTRAINT `basket_extras_basket_item_id_foreign` FOREIGN KEY (`basket_item_id`) REFERENCES `basket_items` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `basket_items`
--
ALTER TABLE `basket_items`
  ADD CONSTRAINT `basket_items_basket_id_foreign` FOREIGN KEY (`basket_id`) REFERENCES `baskets` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `compositions`
--
ALTER TABLE `compositions`
  ADD CONSTRAINT `compositions_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compositions_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `order_item_extras`
--
ALTER TABLE `order_item_extras`
  ADD CONSTRAINT `order_item_extras_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_extras_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
