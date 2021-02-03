-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Feb 2021 um 15:11
-- Server-Version: 10.4.16-MariaDB
-- PHP-Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `retrospex`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

CREATE TABLE `answer` (
  `user_id` int(255) NOT NULL,
  `meeting_id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `category_id` int(255) DEFAULT NULL,
  `content` varchar(1023) COLLATE utf8mb4_bin NOT NULL,
  `number_of_points` int(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `answer_state` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`user_id`, `meeting_id`, `question_id`, `category_id`, `content`, `number_of_points`, `id`, `answer_state`) VALUES
(11, 3, 3, 1, 'Meetings kürzer halten', 5, 1, 2),
(13, 3, 2, 3, 'Buttons mit CSS stylen', 2, 2, 2),
(1, 5, 5, NULL, 'k', NULL, 3, 0),
(1, 5, 5, NULL, 'k2', NULL, 4, 0),
(1, 5, 6, NULL, '+', NULL, 5, 0),
(1, 5, 7, NULL, 'QueryBuilder', NULL, 6, 0),
(1, 5, 8, NULL, 'Database', NULL, 7, 0),
(1, 3, 1, 4, 'a1', NULL, 8, 2),
(1, 3, 2, 4, 'a2', NULL, 9, 2),
(1, 3, 3, NULL, 'a3', NULL, 10, 2),
(1, 3, 4, NULL, 'a4', NULL, 11, 2),
(1, 9, 1, 5, 'b2', NULL, 12, 2),
(1, 9, 2, 6, 'c2', NULL, 13, 2),
(1, 9, 3, NULL, 'd2', NULL, 14, 2),
(1, 9, 4, NULL, 'e2', NULL, 15, 2),
(1, 10, 9, 7, 'f', NULL, 16, 1),
(1, 10, 10, 8, 'ff', NULL, 17, 1),
(1, 10, 11, 9, 'fff', NULL, 18, 1),
(1, 11, 1, 10, 'safd', NULL, 19, 1),
(1, 11, 2, 11, 'asf', NULL, 20, 1),
(1, 11, 3, NULL, 'asdf', NULL, 21, 1),
(1, 12, 1, 12, 'sdfasfdafsda', NULL, 22, 1),
(1, 12, 2, 13, 'asdf', NULL, 23, 1),
(1, 12, 3, NULL, 'dsf', NULL, 24, 1),
(1, 12, 4, NULL, 'sd', NULL, 25, 1),
(1, 13, 9, 15, 'a', NULL, 26, 1),
(1, 13, 10, 16, 'b', NULL, 27, 1),
(1, 13, 11, NULL, 'c', NULL, 28, 1),
(1, 13, 9, 14, 'aa', NULL, 29, 1),
(1, 13, 10, NULL, 'ce', NULL, 30, 1),
(1, 13, 11, NULL, 'ddee', NULL, 31, 1),
(1, 14, 9, 17, 'fef', NULL, 32, 1),
(1, 14, 10, 18, 'wewe', NULL, 33, 1),
(1, 14, 11, 18, '12', NULL, 34, 1),
(1, 15, 12, 20, 'a', NULL, 35, 1),
(1, 15, 13, 19, 'b', NULL, 36, 1),
(1, 15, 14, NULL, 'c', NULL, 37, 1),
(1, 15, 15, NULL, 'd', NULL, 38, 1),
(1, 15, 16, NULL, 'e', NULL, 39, 1),
(1, 16, 5, NULL, 'k', NULL, 40, 1),
(1, 16, 7, NULL, 'm', NULL, 41, 1),
(1, 16, 8, NULL, 'mm', NULL, 42, 1),
(1, 18, 12, 23, 'aq', NULL, 43, 1),
(1, 18, 12, 23, 'a2', NULL, 44, 1),
(1, 18, 12, 25, 'a3', NULL, 45, 1),
(1, 18, 12, 23, 'a4', NULL, 46, 1),
(1, 18, 13, 24, 'b1', NULL, 47, 1),
(1, 18, 13, 24, 'b3', NULL, 48, 1),
(1, 18, 13, 25, 'b4', NULL, 49, 1),
(1, 18, 13, 25, 'b5', NULL, 50, 1),
(1, 18, 14, 25, 'c1', NULL, 51, 1),
(1, 18, 14, 24, 'c2', NULL, 52, 1),
(1, 18, 14, 23, 'c3', NULL, 53, 1),
(1, 18, 14, 25, 'c5', NULL, 54, 1),
(1, 18, 15, 25, 'd1', NULL, 55, 1),
(1, 18, 15, 23, 'd2', NULL, 56, 1),
(1, 18, 15, 25, 'd3', NULL, 57, 1),
(1, 18, 15, 25, 'd45', NULL, 58, 1),
(1, 18, 16, 23, 'e', NULL, 59, 1),
(1, 18, 16, 23, 'fefwewef', NULL, 60, 1),
(1, 18, 16, 24, 'd3', NULL, 61, 1),
(1, 18, 16, 24, 'e4', NULL, 62, 1),
(1, 21, 2, NULL, 'asdf', NULL, 63, 1),
(1, 21, 3, 26, 'sdf', NULL, 64, 1),
(1, 21, 4, NULL, 'sdf', NULL, 65, 1),
(1, 21, 2, NULL, 'pü', NULL, 66, 1),
(1, 21, 3, 26, 'äo', NULL, 67, 1),
(1, 21, 4, NULL, 'äoä', NULL, 68, 1),
(1, 25, 1, 27, 'a', NULL, 69, 1),
(1, 25, 2, 28, 'b', NULL, 70, 1),
(1, 25, 3, NULL, 'c', NULL, 71, 1),
(1, 25, 4, NULL, 'd', NULL, 72, 1),
(1, 27, 12, 30, 'asdfdde', NULL, 73, 1),
(1, 27, 12, 29, 'asdffdsaxcxc', NULL, 74, 1),
(1, 27, 13, NULL, 'asdfe', NULL, 75, 1),
(1, 27, 13, 30, 'weew', NULL, 76, 1),
(1, 27, 14, NULL, 'yxxy', NULL, 77, 1),
(1, 27, 15, 29, 'vsds', NULL, 78, 1),
(1, 27, 16, NULL, 'vasd', NULL, 79, 1),
(1, 31, 2, NULL, '3ffew', NULL, 80, 0),
(1, 31, 2, NULL, 'fsewf', NULL, 81, 0),
(1, 31, 3, NULL, 'sfsdf', NULL, 82, 0),
(1, 31, 4, NULL, 'as', NULL, 83, 0),
(10, 34, 5, 32, 'cvvds', NULL, 84, 1),
(10, 34, 6, 31, 'svdsvdsqwerq', NULL, 85, 1),
(10, 34, 7, NULL, 'fafa', NULL, 86, 1),
(10, 36, 1, 33, 'afd', NULL, 87, 1),
(10, 36, 2, 34, 'wefwef', NULL, 88, 1),
(10, 36, 3, NULL, 'asdf', NULL, 89, 1),
(10, 36, 4, NULL, 'wef', NULL, 90, 1),
(1, 37, 8, NULL, 'vdsgverg', NULL, 91, 0),
(1, 37, 8, NULL, 'weew', NULL, 92, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `meeting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `meeting_id`) VALUES
(3, 'sdaf', 3),
(4, 'asdfdfs', 3),
(5, 'okidoki', 9),
(6, 'hm ja ok', 9),
(7, 'f', 10),
(8, 'Kat2', 10),
(9, 'Kat3', 10),
(10, 'asdf', 11),
(11, 'fdsfsd', 11),
(12, 'fdsafds', 12),
(13, 'sdafasfasdsda', 12),
(14, 'kat1fff', 13),
(15, 'kat2fff', 13),
(16, 'k3', 13),
(17, 'asdfwefew', 14),
(18, '4tt44', 14),
(19, 'asf', 15),
(20, 'bsf', 15),
(21, 'afd', 16),
(22, 'weertw', 16),
(23, 'Kat 1', 18),
(24, 'Kat 2', 18),
(25, 'Kat 3', 18),
(26, 'sadf', 21),
(27, 'asdf', 25),
(28, 'bla', 25),
(29, 'uuii', 27),
(30, 'buhu kat2', 27),
(31, 'kat1', 34),
(32, 'kat2', 34),
(33, 'eins', 36),
(34, 'zwei', 36);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE `login` (
  `id` int(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `login`
--

INSERT INTO `login` (`id`, `password`) VALUES
(2, '$2y$10$aqGXgRg0V.vmEttMzYLPK..c8EWguVTQKOLDHeDYdpWNPgFLZt22S'),
(3, '$2y$10$DBCvz45fArGJ4B3zOdAKo.ImRbJ8AI1dWTu6XHEYGumoEUHRixO5'),
(4, '$2y$10$1EoEkLvdF8tTQI6zpqbakuoPrc1GV0laIB32RYK0WTJ.TMaXHrBGe'),
(5, '$2y$10$a.JZQG5cfZLmGZXhwwYpT.XQgEuGX25zMgtP7FvDPDYHYZC/.xbxm'),
(6, '$2y$10$aXLxFDH7VQwPU7VB.GYvmO7xMxxTuUKm1knUekAFxyNblUBNHKyVi'),
(7, '$2y$10$aCXKTVpaOktHl.JGHj2slePDXLxS/uJLoWY/uvLA/8klR/g/Od4we');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `meeting`
--

CREATE TABLE `meeting` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL,
  `retrotype_id` int(255) NOT NULL,
  `team_id` int(255) NOT NULL,
  `current_state` int(11) NOT NULL DEFAULT 0,
  `number_of_cards` int(11) NOT NULL,
  `tmp_mod` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `meeting`
--

INSERT INTO `meeting` (`id`, `name`, `date`, `retrotype_id`, `team_id`, `current_state`, `number_of_cards`, `tmp_mod`) VALUES
(1, 'Kickoff Meeting', '2020-12-06 09:00:00', 1, 1, 7, 2, NULL),
(2, 'UI Design', '2020-12-19 13:30:00', 2, 2, 7, 4, NULL),
(3, 'Future Meeting', '2021-01-30 17:01:56', 1, 3, 8, 3, NULL),
(4, 'Past meeting', '2021-01-13 06:00:00', 4, 3, 0, 5, NULL),
(9, 'Meeting2', '2021-01-30 18:01:07', 1, 3, 8, 1, NULL),
(10, 'M3', '2021-01-30 18:01:29', 3, 3, 8, 1, NULL),
(11, 'sfdasfd', '2021-01-30 18:01:46', 1, 3, 8, 1, NULL),
(12, 'sfaddfsafsda', '2021-01-30 18:01:53', 1, 3, 5, 2, 9),
(13, 'ulala', '2021-01-31 09:01:33', 3, 3, 8, 2, NULL),
(14, 'dsfafda', '2021-01-31 09:01:17', 3, 3, 8, 1, NULL),
(16, 'boiboi', '2021-01-31 09:20:10', 2, 3, 8, 1, NULL),
(17, 'gre', '2021-01-31 09:25:42', 1, 3, 8, 1, NULL),
(18, 'ttttt', '2021-01-31 09:01:13', 4, 3, 8, 4, NULL),
(19, 'retr', '2021-01-31 14:28:24', 1, 3, 8, 3, NULL),
(21, 'sdf', '2021-01-31 10:01:32', 1, 2, 8, 1, NULL),
(22, 'TestNachwefwefw', '2021-01-31 10:09:00', 1, 2, 0, 2, NULL),
(23, 'grf', '2021-01-31 10:55:21', 1, 1, 4, 2, NULL),
(24, 'M1', '2021-01-31 10:56:27', 3, 16, 8, 1, NULL),
(25, 'm2', '2021-01-31 10:57:09', 1, 16, 8, 2, NULL),
(26, 'm3', '2021-01-31 10:57:59', 1, 16, 8, 2, NULL),
(27, 'TTeam', '2021-01-31 14:33:43', 4, 1, 8, 2, NULL),
(28, 'dfqwe', '2021-01-31 15:37:15', 3, 3, 8, 1, NULL),
(30, 'TestNachdsfffew', '2021-01-31 18:03:13', 1, 3, 8, 2, 16),
(31, 'TestNach', '2021-01-31 18:13:04', 1, 1, 3, 4, NULL),
(34, 'ftet', '2021-01-31 18:26:58', 2, 3, 8, 1, NULL),
(35, 'TestMeeting', '2021-01-31 18:28:30', 1, 3, 8, 1, NULL),
(36, 'TestZWEI', '2021-01-31 18:29:04', 1, 3, 8, 1, NULL),
(38, 'Testnach', '2021-02-02 13:39:54', 3, 1, 3, 2, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `metaanswer`
--

CREATE TABLE `metaanswer` (
  `id` int(11) NOT NULL,
  `selection` int(11) NOT NULL,
  `metaquestion_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `metaanswer`
--

INSERT INTO `metaanswer` (`id`, `selection`, `metaquestion_id`, `meeting_id`, `user_id`) VALUES
(1, 10, 3, 11, 1),
(2, 5, 4, 11, 1),
(3, 10, 5, 19, 1),
(4, 5, 6, 19, 1),
(5, 9, 7, 30, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `metaquestion`
--

CREATE TABLE `metaquestion` (
  `id` int(255) NOT NULL,
  `question` varchar(1023) COLLATE utf8mb4_bin NOT NULL,
  `team_id` int(255) DEFAULT NULL,
  `meeting_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `metaquestion`
--

INSERT INTO `metaquestion` (`id`, `question`, `team_id`, `meeting_id`) VALUES
(1, 'War der Kaffee stark genug?', 1, 0),
(2, 'Ist 6 Uhr zu früh für die Retro?', 3, 4),
(3, 'saf', NULL, 11),
(4, 'fds', NULL, 11),
(5, 'bla', NULL, 19),
(6, 'blabla', NULL, 19),
(7, 'gfdgd', NULL, 30);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE `question` (
  `id` int(255) NOT NULL,
  `retrotype_id` int(255) NOT NULL,
  `question` varchar(1023) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`id`, `retrotype_id`, `question`) VALUES
(1, 1, 'Was haben wir so gut gemacht, dass wir darüber reden müssen, um es nicht zu vergessen und weiter aufrecht zu erhalten?'),
(2, 1, 'Was haben wir gelernt?'),
(3, 1, 'Was müssen wir künftig anders machen?'),
(4, 1, 'Was haben wir noch nicht verstanden?'),
(5, 2, 'Keep'),
(6, 2, 'Add'),
(7, 2, 'Less'),
(8, 2, 'More'),
(9, 3, 'Funktioniert einigermaßen'),
(10, 3, 'Funktioniert gut'),
(11, 3, 'Funktioniert nicht gut'),
(12, 4, 'Was müssen wir intensivieren?'),
(13, 4, 'Was müssen wir zurückfahren?'),
(14, 4, 'Womit müssen wir aufhören?'),
(15, 4, 'Womit müssen wir beginnen?'),
(16, 4, 'Was müssen wir fortsetzen?');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `retrotype`
--

CREATE TABLE `retrotype` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `retrotype`
--

INSERT INTO `retrotype` (`id`, `name`) VALUES
(1, 'Standard'),
(2, 'KALM'),
(3, 'FFF'),
(4, 'Seestern');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `summary`
--

CREATE TABLE `summary` (
  `id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `meeting_id` int(255) NOT NULL,
  `target_state` varchar(1023) NOT NULL,
  `todo` varchar(1023) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `summary`
--

INSERT INTO `summary` (`id`, `category_id`, `meeting_id`, `target_state`, `todo`) VALUES
(4, 4, 3, 'fafa', 'fafa'),
(5, 6, 9, 'hm ja', 'hm ja'),
(6, 5, 9, 'oki', 'doki'),
(10, 7, 10, 'f', 'f'),
(11, 9, 10, 'fff', 'fff'),
(12, 8, 10, 'ff', 'ff'),
(13, 11, 11, 'sadf', 'afds'),
(14, 12, 12, 'asdfsdffds', 'dsfsfd'),
(15, 16, 13, '', ''),
(16, 18, 14, '', ''),
(17, 20, 15, '', ''),
(18, 23, 18, 'gfgfdgf', 'ggdg'),
(19, 25, 18, 'sdfsdf', 'sdfsdf'),
(20, 24, 18, 'asdf', 'fdsa'),
(21, 26, 21, 'asdf', 'fds'),
(22, 28, 25, 'a', 'a'),
(23, 27, 25, 's', 's'),
(24, 30, 27, '', ''),
(25, 32, 34, 'kat1', 'kat 1'),
(26, 33, 36, 'eins', 'eins'),
(27, 34, 36, 'zwei', 'zwei');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teams`
--

CREATE TABLE `teams` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `deactivated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `teams`
--

INSERT INTO `teams` (`id`, `name`, `deactivated`) VALUES
(1, 'Test Team', 0),
(2, 'Design Team', 0),
(3, 'Front End Dev', 0),
(4, 'Back End Dev Team', 0),
(5, 'WI Verzweiflung', 1),
(7, 'Mailing Team', 1),
(8, 'Test2', 0),
(12, 'dfs', 1),
(16, 'NEUES TEAM', 0),
(17, 'NEUES TEAM', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teams_users`
--

CREATE TABLE `teams_users` (
  `user_id` int(255) NOT NULL,
  `team_id` int(255) NOT NULL,
  `local_role` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `teams_users`
--

INSERT INTO `teams_users` (`user_id`, `team_id`, `local_role`) VALUES
(1, 3, 'mitarbeiter'),
(1, 8, 'moderator'),
(1, 16, 'mitarbeiter'),
(1, 17, 'moderator'),
(9, 2, 'moderator'),
(9, 3, 'mitarbeiter'),
(9, 16, 'moderator'),
(9, 17, 'mitarbeiter'),
(10, 2, 'mitarbeiter'),
(10, 3, 'moderator'),
(10, 17, 'mitarbeiter'),
(11, 2, 'mitarbeiter'),
(11, 3, 'mitarbeiter'),
(11, 4, 'moderator'),
(11, 16, 'mitarbeiter'),
(12, 1, 'moderator'),
(12, 3, 'mitarbeiter'),
(12, 4, 'mitarbeiter'),
(12, 17, 'mitarbeiter'),
(13, 1, 'mitarbeiter'),
(13, 3, 'mitarbeiter'),
(13, 4, 'mitarbeiter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `global_role` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `global_role`, `login_id`) VALUES
(1, 'System', 'Admin', 'sysadmin@retrospex.com', 'admin', 2),
(9, 'Tobias', 'Mueller', 'tobias.mueller@retrospex.com', 'user', 3),
(10, 'Fynn', 'Meier', 'fynn.meier@retrospex.com', 'user', 4),
(11, 'Michael', 'Stohler', 'michael.stohler@retrospex.com', 'user', 5),
(12, 'Alice', 'Wunderland', 'alice.wunderland@retrospex.com', 'user', 6),
(13, 'Peter', 'Lankton', 'peter.lankton@retrospex.com', 'user', 7);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `retroID` (`id`);

--
-- Indizes für die Tabelle `metaanswer`
--
ALTER TABLE `metaanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `metaquestion`
--
ALTER TABLE `metaquestion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metafragenID` (`id`);

--
-- Indizes für die Tabelle `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fragenID` (`id`);

--
-- Indizes für die Tabelle `retrotype`
--
ALTER TABLE `retrotype`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `TeamID` (`id`),
  ADD UNIQUE KEY `TeamID_2` (`id`);

--
-- Indizes für die Tabelle `teams_users`
--
ALTER TABLE `teams_users`
  ADD PRIMARY KEY (`user_id`,`team_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nutzerID` (`id`),
  ADD UNIQUE KEY `nutzerID_2` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT für Tabelle `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT für Tabelle `metaanswer`
--
ALTER TABLE `metaanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `metaquestion`
--
ALTER TABLE `metaquestion`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `question`
--
ALTER TABLE `question`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `retrotype`
--
ALTER TABLE `retrotype`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `teams_users`
--
ALTER TABLE `teams_users`
  ADD CONSTRAINT `teams_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teams_users_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
