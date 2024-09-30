-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 sep 2024 om 16:23
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pit landing-page`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `apps`
--

INSERT INTO `apps` (`id`, `title`, `description`, `image`, `created_at`, `link`) VALUES
(2, 'EHBO VR game', 'Ontdek een nieuwe dimensie van gaming met mijn VR-game! Stap in een adembenemende wereld vol uitdagingen en unieke personages. Gebruik innovatieve gameplay-mechanismen om puzzels op te lossen en vijanden te verslaan. Deze meeslepende ervaring laat je vergeten dat je in de echte wereld bent, terwijl je je vaardigheden test en nieuwe avonturen beleeft. Ben jij klaar voor de uitdaging?', 'EHBO_VR_game.png', '2024-09-24 11:05:51', 'https://www.mensura.be/nl/learn-and-connect/opleidingen/play-it-safe-game-based-learning-over-welzijn-en-veiligheid-op-het-werk'),
(3, 'Politie VR Game', 'Betreed de wereld van rechtvaardigheid met mijn politie VR-game! In deze meeslepende ervaring word je een agent die misdaden oplost, getuigen ondervraagt en criminelen achtervolgt in een dynamische stad. Gebruik tactische vaardigheden en teamwerk om situaties te beheersen en de orde te handhaven. Elk besluit telt, en jij bepaalt het verloop van het verhaal. Durf jij de uitdaging aan?', 'Politie_VR_Game.jpg', '2024-09-24 11:11:08', 'https://www.vrowl.nl/hoe-de-politie-virtual-reality-inzet-voor-trainen-en-opleiden/'),
(4, 'Brandweer VR Game', 'yap yap yap', 'Brandweer_VR_Game.jpg', '2024-09-24 11:12:00', 'https://media1.tenor.com/m/c5a_h8U1MzkAAAAC/nuh-uh-beocord.gif'),
(5, 'test', 'test', 'test.jpg', '2024-09-24 11:22:38', 'https://www.yonder.nl/'),
(6, 'test aaaa', 'bbb', 'test_aaaa.png', '2024-09-24 12:44:17', 'https://www.kaasje.nl/'),
(7, 'Quandan Dingle', 'Quandan', 'Quandan_Dingle.jpg', '2024-09-26 13:37:01', 'https://www.yonder.nl/');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
