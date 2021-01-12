-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2021 at 03:32 PM
-- Server version: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokebr`
--

-- --------------------------------------------------------

--
-- Table structure for table `5050`
--

CREATE TABLE `5050` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `money` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(21) CHARACTER SET utf8 NOT NULL,
  `clanid` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_history`
--

CREATE TABLE `auction_history` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner_username` varchar(200) NOT NULL,
  `winner_id` int(11) NOT NULL,
  `winner_username` varchar(200) NOT NULL,
  `winning_bid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `move1` varchar(200) NOT NULL,
  `move2` varchar(200) NOT NULL,
  `move3` varchar(200) NOT NULL,
  `move4` varchar(200) NOT NULL,
  `num_bids` int(11) NOT NULL,
  `gender` enum('0','1','2') NOT NULL,
  `finish_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_pokemon`
--

CREATE TABLE `auction_pokemon` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner_username` varchar(200) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `bidder_username` varchar(200) NOT NULL,
  `current_bid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `move1` varchar(200) NOT NULL,
  `move2` varchar(200) NOT NULL,
  `move3` varchar(200) NOT NULL,
  `move4` varchar(200) NOT NULL,
  `num_bids` int(11) NOT NULL,
  `gender` enum('0','1','2') NOT NULL,
  `finish_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `avatars`
--

CREATE TABLE `avatars` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avatars`
--

INSERT INTO `avatars` (`ID`, `Name`, `Image`) VALUES
(1, '001', 'images/trainers/000.png'),
(2, '002', 'images/trainers/002.png'),
(3, '004', 'images/trainers/004.png'),
(4, '006', 'images/trainers/006.png'),
(5, '008', 'images/trainers/008.png'),
(6, '010', 'images/trainers/010.png'),
(7, '012', 'images/trainers/012.png'),
(8, '014', 'images/trainers/014.png'),
(9, '016', 'images/trainers/016.png'),
(10, '018', 'images/trainers/018.png'),
(11, '020', 'images/trainers/020.png'),
(12, '022', 'images/trainers/022.png'),
(13, '024', 'images/trainers/024.png'),
(14, '026', 'images/trainers/026.png'),
(15, '028', 'images/trainers/028.png'),
(16, '030', 'images/trainers/030.png'),
(17, '032', 'images/trainers/032.png'),
(18, '034', 'images/trainers/034.png'),
(19, '036', 'images/trainers/036.png'),
(20, '038', 'images/trainers/038.png'),
(21, '040', 'images/trainers/040.png'),
(22, '042', 'images/trainers/042.png'),
(23, '044', 'images/trainers/044.png'),
(24, '046', 'images/trainers/046.png'),
(25, '048', 'images/trainers/048.png'),
(26, '050', 'images/trainers/050.png'),
(27, '052', 'images/trainers/052.png'),
(28, '054', 'images/trainers/054.png'),
(29, '056', 'images/trainers/056.png'),
(30, '058', 'images/trainers/058.png'),
(31, '060', 'images/trainers/060.png'),
(32, '062', 'images/trainers/062.png'),
(33, '064', 'images/trainers/064.png'),
(34, '066', 'images/trainers/066.png'),
(35, '068', 'images/trainers/068.png'),
(36, '070', 'images/trainers/070.png'),
(37, '072', 'images/trainers/072.png'),
(38, '074', 'images/trainers/074.png'),
(39, '076', 'images/trainers/076.png'),
(40, '078', 'images/trainers/078.png'),
(41, '080', 'images/trainers/080.png'),
(42, '082', 'images/trainers/082.png'),
(43, '084', 'images/trainers/084.png'),
(44, '086', 'images/trainers/086.png'),
(45, '088', 'images/trainers/088.png'),
(46, '090', 'images/trainers/090.png'),
(47, '092', 'images/trainers/092.png'),
(48, '094', 'images/trainers/094.png'),
(49, '096', 'images/trainers/096.png'),
(50, '098', 'images/trainers/098.png'),
(51, '100', 'images/trainers/100.png'),
(52, '102', 'images/trainers/102.png'),
(53, '104', 'images/trainers/104.png'),
(54, '106', 'images/trainers/106.png'),
(55, '108', 'images/trainers/108.png'),
(56, '110', 'images/trainers/110.png'),
(57, '112', 'images/trainers/112.png'),
(58, '114', 'images/trainers/114.png'),
(59, '116', 'images/trainers/116.png'),
(60, '118', 'images/trainers/118.png'),
(61, '120', 'images/trainers/120.png'),
(62, '122', 'images/trainers/122.png'),
(63, '156', 'images/trainers/172.png'),
(64, '124', 'images/trainers/126.png'),
(65, '154', 'images/trainers/170.png'),
(66, '126', 'images/trainers/130.png'),
(67, '128', 'images/trainers/132.png'),
(68, '130', 'images/trainers/134.png'),
(69, '132', 'images/trainers/136.png'),
(70, '134', 'images/trainers/138.png'),
(71, '136', 'images/trainers/140.png'),
(72, '138', 'images/trainers/142.png'),
(73, '140', 'images/trainers/144.png'),
(74, '142', 'images/trainers/146.png'),
(75, '152', 'images/trainers/168.png'),
(76, '150', 'images/trainers/166.png'),
(77, '148', 'images/trainers/164.png'),
(78, '146', 'images/trainers/162.png'),
(79, '144', 'images/trainers/160.png'),
(80, '158', 'images/trainers/174.png'),
(81, '160', 'images/trainers/176.png'),
(82, '162', 'images/trainers/178.png'),
(83, '164', 'images/trainers/194.png');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clans`
--

CREATE TABLE `clans` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(155) NOT NULL,
  `time` varchar(255) NOT NULL,
  `exp` bigint(20) NOT NULL DEFAULT '0',
  `members` varchar(255) NOT NULL DEFAULT '1',
  `money` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `newsid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'lottery_next_draw', '1417064400'),
(2, 'lottery_winner_uid', '116024'),
(3, 'lottery_pokemon', 'Arceus (Fighting)'),
(4, 'lottery_pokemon_prefix', ''),
(5, 'lottery_winner_pokemon', 'Arceus (Grass)'),
(6, 'lottery_winner_pokemon_prefix', 'Shiny '),
(7, 'champion_uid', '1'),
(9, 'release_reward', '100'),
(10, 'snow_machine_price', '85000'),
(11, 'snow_machine_pokemon', 'Snow Kyogre'),
(12, 'snow_machine_pokemon_level', '5'),
(13, 'snow_machine_chance', '45'),
(14, 'most_online', '566'),
(15, 'promo_cost_money', '90000'),
(16, 'promo_cost_tokens', '0'),
(17, 'promo_pokemon_name', 'Lugia'),
(18, 'promo_pokemon_level', '5'),
(19, 'promo_last_update', '1416968594'),
(20, 'snow_machine_lost_money', '265765000'),
(22, 'champion_timestamp', '1416402268'),
(23, 'lucky_hour', '1417065166');

-- --------------------------------------------------------

--
-- Table structure for table `demo_twitter_timeline`
--

CREATE TABLE `demo_twitter_timeline` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tweet` varchar(140) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evolution`
--

CREATE TABLE `evolution` (
  `id` int(3) NOT NULL,
  `before` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `after` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `level` int(3) NOT NULL,
  `item` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `evolution`
--

INSERT INTO `evolution` (`id`, `before`, `after`, `level`, `item`) VALUES
(1, 'Bulbasaur', 'Ivysaur', 16, ''),
(2, 'Ivysaur', 'Venusaur', 32, ''),
(3, 'Charmander', 'Charmeleon', 16, ''),
(4, 'Charmeleon', 'Charizard', 36, ''),
(5, 'Squirtle', 'Wartortle', 16, ''),
(6, 'Wartortle', 'Blastoise', 36, ''),
(7, 'Caterpie', 'Metapod', 7, ''),
(8, 'Metapod', 'Butterfree', 10, ''),
(9, 'Weedle', 'Kakuna', 7, ''),
(10, 'Kakuna', 'Beedrill', 10, ''),
(11, 'Pidgey', 'Pidgeotto', 18, ''),
(12, 'Pidgeotto', 'Pidgeot', 36, ''),
(13, 'Rattata', 'Raticate', 20, ''),
(14, 'Spearow', 'Fearow', 20, ''),
(15, 'Ekans', 'Arbok', 18, ''),
(16, 'Pikachu', 'Raichu', 0, 'Thunder Stone'),
(17, 'Sandshrew', 'Sandslash', 22, ''),
(18, 'Nidoran (f)', 'Nidorina', 16, ''),
(19, 'Nidoran (m)', 'Nidorino', 16, ''),
(20, 'Clefairy', 'Clefable', 0, 'Moon Stone'),
(21, 'Vulpix', 'Ninetales', 0, 'Fire Stone'),
(22, 'Jigglypuff', 'Wigglytuff', 0, 'Moon Stone'),
(23, 'Zubat', 'Golbat', 22, ''),
(24, 'Oddish', 'Gloom', 21, ''),
(25, 'Paras', 'Parasect', 24, ''),
(26, 'Venonat', 'Venomoth', 31, ''),
(27, 'Diglett', 'Dugtrio', 26, ''),
(28, 'Meowth', 'Persian', 28, ''),
(29, 'Psyduck', 'Golduck', 33, ''),
(30, 'Mankey', 'Primeape', 28, ''),
(31, 'Growlithe', 'Arcanine', 0, 'Fire Stone'),
(32, 'Poliwag', 'Poliwhirl', 25, ''),
(33, 'Abra', 'Kadabra', 16, ''),
(34, 'Kadabra', 'Alakazam', 16, ''),
(35, 'Machop', 'Machoke', 28, ''),
(36, 'Machoke', 'Machamp', 28, ''),
(37, 'Bellsprout', 'Weepinbell', 21, ''),
(38, 'Tentacool', 'Tentacruel', 30, ''),
(39, 'Geodude', 'Graveler', 25, ''),
(40, 'Graveler', 'Golem', 25, ''),
(41, 'Ponyta', 'Rapidash', 40, ''),
(42, 'Slowpoke', 'Slowbro', 37, ''),
(43, 'Magnemite', 'Magneton', 30, ''),
(44, 'Doduo', 'Dodrio', 31, ''),
(45, 'Seel', 'Dewgong', 34, ''),
(46, 'Grimer', 'Muk', 38, ''),
(47, 'Shellder', 'Cloyster', 0, 'Water Stone'),
(48, 'Gastly', 'Haunter', 25, ''),
(49, 'Haunter', 'Gengar', 25, ''),
(50, 'Drowzee', 'Hypno', 26, ''),
(51, 'Krabby', 'Kingler', 28, ''),
(52, 'Voltorb', 'Electrode', 30, ''),
(53, 'Exeggcute', 'Exeggutor', 0, 'Leaf Stone'),
(54, 'Cubone', 'Marowak', 28, ''),
(55, 'Koffing', 'Weezing', 35, ''),
(56, 'Rhyhorn', 'Rhydon', 42, ''),
(57, 'Horsea', 'Seadra', 32, 'Water Stone'),
(58, 'Goldeen', 'Seaking', 33, ''),
(59, 'Staryu', 'Starmie', 0, 'Water Stone'),
(60, 'Magikarp', 'Gyarados', 20, ''),
(61, 'Eevee', 'Vaporeon', 0, 'Water Stone'),
(62, 'Eevee', 'Jolteon', 0, 'Thunder Stone'),
(63, 'Eevee', 'Flareon', 0, 'Fire Stone'),
(64, 'Omanyte', 'Omastar', 40, ''),
(65, 'Kabuto', 'Kabutops', 40, ''),
(66, 'Dratini', 'Dragonair', 30, ''),
(67, 'Dragonair', 'Dragonite', 55, ''),
(68, 'Nidorina', 'Nidoqueen', 0, 'Moon Stone'),
(69, 'Nidorino', 'Nidoking', 0, 'Moon Stone'),
(70, 'Gloom', 'Vileplume', 0, 'Leaf Stone'),
(71, 'Poliwhirl', 'Poliwrath', 0, 'Water Stone'),
(72, 'Weepinbell', 'Victreebel', 0, 'Leaf Stone'),
(73, 'Chikorita', 'Bayleef', 16, ''),
(74, 'Bayleef', 'Meganium', 32, ''),
(75, 'Cyndaquil', 'Quilava', 14, ''),
(76, 'Quilava', 'Typhlosion', 36, ''),
(77, 'Totodile', 'Croconaw', 18, ''),
(78, 'Croconaw', 'Feraligatr', 30, ''),
(79, 'Sentret', 'Furret', 15, ''),
(80, 'Hoothoot', 'Noctowl', 20, ''),
(81, 'Ledyba', 'Ledian', 18, ''),
(82, 'Spinarak', 'Ariados', 22, ''),
(83, 'Chinchou', 'Lanturn', 27, ''),
(84, 'Natu', 'Xatu', 25, ''),
(85, 'Mareep', 'Flaaffy', 15, ''),
(86, 'Flaaffy', 'Ampharos', 30, ''),
(87, 'Marill', 'Azumarill', 18, ''),
(88, 'Hoppip', 'Skiploom', 18, ''),
(89, 'Skiploom', 'Jumpluff', 27, ''),
(90, 'Wooper', 'Quagsire', 20, ''),
(91, 'Wynaut', 'Wobbuffet', 15, ''),
(92, 'Pineco', 'Forretress', 31, ''),
(93, 'Snubbull', 'Granbull', 23, ''),
(94, 'Teddiursa', 'Ursaring', 30, ''),
(95, 'Slugma', 'Magcargo', 38, ''),
(96, 'Swinub', 'Piloswine', 33, ''),
(97, 'Remoraid', 'Octillery', 25, ''),
(98, 'Houndour', 'Houndoom', 24, ''),
(99, 'Phanpy', 'Donphan', 25, ''),
(100, 'Larvitar', 'Pupitar', 32, ''),
(101, 'Pupitar', 'Tyranitar', 55, ''),
(102, 'Treecko', 'Grovyle', 16, ''),
(103, 'Grovyle', 'Sceptile', 36, ''),
(104, 'Torchic', 'Combusken', 16, ''),
(105, 'Combusken', 'Blaziken', 36, ''),
(106, 'Mudkip', 'Marshtomp', 16, ''),
(107, 'Marshtomp', 'Swampert', 36, ''),
(108, 'Poochyena', 'Mightyena', 18, ''),
(109, 'Zigzagoon', 'Linoone', 20, ''),
(110, 'Wurmple', 'Silcoon', 7, ''),
(111, 'Silcoon', 'Beautifly', 10, ''),
(112, 'Wurmple', 'Cascoon', 7, ''),
(113, 'Cascoon', 'Dustox', 10, ''),
(114, 'Lotad', 'Lombre', 14, ''),
(115, 'Seedot', 'Nuzleaf', 14, ''),
(116, 'Taillow', 'Swellow', 22, ''),
(117, 'Wingull', 'Pelipper', 25, ''),
(118, 'Ralts', 'Kirlia', 20, ''),
(119, 'Kirlia', 'Gardevoir', 30, ''),
(120, 'Surskit', 'Masquerain', 22, ''),
(121, 'Shroomish', 'Breloom', 23, ''),
(122, 'Slakoth', 'Vigoroth', 18, ''),
(123, 'Vigoroth', 'Slaking', 36, ''),
(124, 'Nincada', 'Ninjask', 20, ''),
(125, 'Nincada', 'Shedinja', 20, ''),
(126, 'Whismur', 'Loudred', 20, ''),
(127, 'Loudred', 'Exploud', 40, ''),
(128, 'Makuhita', 'Hariyama', 24, ''),
(129, 'Aron', 'Lairon', 32, ''),
(130, 'Lairon', 'Aggron', 42, ''),
(131, 'Meditite', 'Medicham', 37, ''),
(132, 'Electrike', 'Manectric', 26, ''),
(133, 'Gulpin', 'Swalot', 26, ''),
(134, 'Carvanha', 'Sharpedo', 30, ''),
(135, 'Wailmer', 'Wailord', 40, ''),
(136, 'Numel', 'Camerupt', 33, ''),
(137, 'Spoink', 'Grumpig', 32, ''),
(138, 'Trapinch', 'Vibrava', 35, ''),
(139, 'Vibrava', 'Flygon', 45, ''),
(140, 'Cacnea', 'Cacturne', 32, ''),
(141, 'Swablu', 'Altaria', 35, ''),
(142, 'Barboach', 'Whiscash', 30, ''),
(143, 'Corphish', 'Crawdaunt', 30, ''),
(144, 'Baltoy', 'Claydol', 36, ''),
(145, 'Lileep', 'Cradily', 40, ''),
(146, 'Anorith', 'Armaldo', 40, ''),
(147, 'Shuppet', 'Banette', 37, ''),
(148, 'Duskull', 'Dusclops', 37, ''),
(149, 'Snorunt', 'Glalie', 42, ''),
(150, 'Spheal', 'Sealeo', 32, ''),
(151, 'Sealeo', 'Walrein', 44, ''),
(152, 'Bagon', 'Shelgon', 30, ''),
(153, 'Shelgon', 'Salamence', 50, ''),
(154, 'Beldum', 'Metang', 20, ''),
(155, 'Metang', 'Metagross', 45, ''),
(156, 'Turtwig', 'Grotle', 18, ''),
(157, 'Grotle', 'Torterra', 32, ''),
(158, 'Chimchar', 'Monferno', 14, ''),
(159, 'Monferno', 'Infernape', 36, ''),
(160, 'Piplup', 'Prinplup', 16, ''),
(161, 'Prinplup', 'Empoleon', 36, ''),
(162, 'Starly', 'Staravia', 14, ''),
(163, 'Staravia', 'Staraptor', 34, ''),
(164, 'Bidoof', 'Bibarel', 15, ''),
(165, 'Kricketot', 'Kricketune', 10, ''),
(166, 'Shinx', 'Luxio', 15, ''),
(167, 'Luxio', 'Luxray', 30, ''),
(168, 'Cranidos', 'Rampardos', 30, ''),
(169, 'Shieldon', 'Bastiodon', 30, ''),
(170, 'Burmy', 'Mothim', 20, ''),
(171, 'Burmy', 'Wormadam', 20, ''),
(172, 'Combee', 'Vespiquen', 21, ''),
(173, 'Buizel', 'Floatzel', 26, ''),
(174, 'Cherubi', 'Cherrim', 25, ''),
(176, 'Drifloon', 'Drifblim', 28, ''),
(177, 'Glameow', 'Purugly', 38, ''),
(178, 'Stunky', 'Skuntank', 34, ''),
(179, 'Bronzor', 'Bronzong', 33, ''),
(180, 'Gible', 'Gabite', 24, ''),
(181, 'Gabite', 'Garchomp', 48, ''),
(182, 'Hippopotas', 'Hippowdon', 34, ''),
(183, 'Skorupi', 'Drapion', 40, ''),
(184, 'Croagunk', 'Toxicroak', 37, ''),
(185, 'Finneon', 'Lumineon', 36, ''),
(186, 'Snover', 'Abomasnow', 40, ''),
(187, 'Snivy', 'Servine', 17, ''),
(188, 'Servine', 'Serperior', 36, ''),
(189, 'Tepig', 'Pignite', 17, ''),
(190, 'Pignite', 'Emboar', 36, ''),
(191, 'Oshawott', 'Dewott', 17, ''),
(192, 'Dewott', 'Samurott', 36, ''),
(193, 'Patrat', 'Watchog', 20, ''),
(194, 'Lillipup', 'Herdier', 16, ''),
(195, 'Herdier', 'Stoutland', 32, ''),
(196, 'Purrloin', 'Liepard', 20, ''),
(197, 'Pidove', 'Tranquill', 21, ''),
(198, 'Tranquill', 'Unfezant', 32, ''),
(199, 'Blitzle', 'Zebstrika', 27, ''),
(200, 'Roggenrola', 'Boldore', 25, ''),
(201, 'Drilbur', 'Excadrill', 31, ''),
(202, 'Timburr', 'Gurdurr', 25, ''),
(203, 'Tympole', 'Palpitoad', 25, ''),
(204, 'Palpitoad', 'Seismitoad', 36, ''),
(205, 'Sewaddle', 'Swadloon', 20, ''),
(206, 'Venipede', 'Whirlipede', 22, ''),
(207, 'Whirlipede', 'Scolipede', 30, ''),
(208, 'Sandile', 'Krokorok', 29, ''),
(209, 'Krokorok', 'Krookodile', 40, ''),
(210, 'Darumaka', 'Darmanitan', 35, ''),
(211, 'Dwebble', 'Crustle', 34, ''),
(212, 'Scraggy', 'Scrafty', 39, ''),
(213, 'Yamask', 'Cofagrigus', 34, ''),
(214, 'Tirtouga', 'Carracosta', 37, ''),
(215, 'Archen', 'Archeops', 37, ''),
(216, 'Trubbish', 'Garbodor', 36, ''),
(217, 'Zorua', 'Zoroark', 30, ''),
(218, 'Gothita', 'Gothorita', 32, ''),
(219, 'Gothorita', 'Gothitelle', 41, ''),
(220, 'Solosis', 'Duosion', 32, ''),
(221, 'Duosion', 'Reuniclus', 41, ''),
(222, 'Ducklett', 'Swanna', 35, ''),
(223, 'Vanillite', 'Vanillish', 35, ''),
(224, 'Vanillish', 'Vanilluxe', 47, ''),
(225, 'Deerling', 'Sawsbuck', 34, ''),
(226, 'Foongus', 'Amoonguss', 39, ''),
(227, 'Frillish', 'Jellicent', 40, ''),
(228, 'Joltik', 'Galvantula', 36, ''),
(229, 'Ferroseed', 'Ferrothorn', 40, ''),
(230, 'Klink', 'Klang', 38, ''),
(231, 'Klang', 'Klinklang', 49, ''),
(232, 'Tynamo', 'Eelektrik', 39, ''),
(233, 'Elgyem', 'Beheeyem', 42, ''),
(234, 'Litwick', 'Lampent', 41, ''),
(235, 'Axew', 'Fraxure', 38, ''),
(236, 'Fraxure', 'Haxorus', 48, ''),
(237, 'Cubchoo', 'Beartic', 37, ''),
(238, 'Mienfoo', 'Mienshao', 50, ''),
(239, 'Golett', 'Golurk', 43, ''),
(240, 'Pawniard', 'Bisharp', 52, ''),
(241, 'Rufflet', 'Braviary', 54, ''),
(242, 'Vullaby', 'Mandibuzz', 54, ''),
(243, 'Deino', 'Zweilous', 50, ''),
(244, 'Zweilous', 'Hydreigon', 64, ''),
(245, 'Larvesta', 'Volcarona', 59, ''),
(246, 'Eevee', 'Glaceon', 35, ''),
(247, 'Gloom', 'Bellossom', 0, 'Sun Stone'),
(248, 'Eevee', 'Leafeon', 0, 'Leaf Stone'),
(249, 'Togetic', 'Togekiss', 0, 'Shiny Stone'),
(250, 'Sunkern', 'Sunflora', 0, 'Sun Stone'),
(251, 'Murkrow', 'Honchkrow', 0, 'Dusk Stone'),
(252, 'Misdreavus', 'Mismagius', 0, 'Dusk Stone'),
(253, 'Lombre', 'Ludicolo', 0, 'Water Stone'),
(254, 'Nuzleaf', 'Shiftry', 0, 'Leaf Stone'),
(255, 'Kirlia', 'Gallade', 0, 'Dawn Stone'),
(256, 'Skitty', 'Delcatty', 0, 'Moon Stone'),
(257, 'Roselia', 'Roserade', 0, 'Shiny Stone'),
(258, 'Snorunt', 'Froslass', 0, 'Dawn Stone'),
(259, 'Pansage', 'Simisage', 0, 'Leaf Stone'),
(260, 'Pansear', 'Simisear', 0, 'Fire Stone'),
(261, 'Panpour', 'Simipour', 0, 'Water Stone'),
(262, 'Munna', 'Musharna', 0, 'Moon Stone'),
(263, 'Cottonee', 'Whimsicott', 0, 'Sun Stone'),
(264, 'Petilil', 'Lilligant', 0, 'Sun Stone'),
(265, 'Minccino', 'Cinccino', 0, 'Shiny Stone'),
(266, 'Eelektrik', 'Eelektross', 0, 'Thunderstone'),
(267, 'Lampent', 'Chandelure', 0, 'Dusk Stone'),
(268, 'Piloswine', 'Mamoswine', 33, ''),
(269, 'Eevee', 'Umbreon', 0, 'Dusk Stone'),
(271, 'Eevee', 'Espeon', 0, 'Dawn Stone'),
(272, 'Pichu', 'Pikachu', 16, ''),
(273, 'Shellos (East)', 'Gastrodon (East)', 30, ''),
(274, 'Shellos (West)', 'Gastrodon (West)', 30, ''),
(275, 'Riolu', 'Lucario', 30, ''),
(276, 'Aipom', 'Ambipom', 30, ''),
(278, 'gligar', 'Gliscor', 36, ''),
(279, 'Eternal Growlithe', 'Eternal Arcanine', 0, 'Fire Stone'),
(280, 'Planet Vulpix', 'Planet Ninetales', 0, 'Fire Stone'),
(281, 'Halloween Bellsprout', 'Halloween Weepinbell', 21, ''),
(282, 'Halloween Weepinbell', 'Halloween Victreebel', 0, 'Leaf Stone'),
(283, 'Crystalic Nidoran', 'Crystalic Nidorino', 18, ''),
(284, 'Crystalic Nidorino', 'Crystalic Nidoking', 0, 'Moon Stone'),
(285, 'Halloween Feebas', 'Halloween Milotic', 5, ''),
(286, 'Planet Feebas', 'Planet Milotic', 5, ''),
(287, 'Halloween Dratini', 'Halloween Dragonair', 32, ''),
(288, 'Halloween Dragonair', 'Halloween Dragonite', 55, ''),
(289, 'Crystalic Cyndaquil', 'Crystalic Quilava', 16, ''),
(290, 'Crystalic Quilava', 'Crystalic Typhlosion', 36, ''),
(291, 'Crystalic Wynaut', 'Crystalic Wobbuffet', 20, ''),
(292, 'Onix', 'Steelix', 30, ''),
(293, 'Scyther', 'Scizor', 30, ''),
(294, 'Budew', 'Roselia', 22, ''),
(295, 'Roselia', 'Roserade', 55, ''),
(296, 'Happiny', 'Chansey', 33, ''),
(297, 'Chansey', 'Blissey', 100, ''),
(298, 'Feebas', 'Milotic', 55, ''),
(299, 'Igglybuff', 'Jigglypuff', 5, ''),
(300, 'Karrablast', 'Escavalier', 55, ''),
(301, 'Cleffa', ' Clefairy', 32, ''),
(302, 'Electabuzz', 'Electivire', 100, ''),
(303, 'Magmar', 'Magmortar', 0, ''),
(304, 'Togetic', 'Tokekiss', 0, '55'),
(305, 'Seadra', 'Kingdra', 55, ''),
(306, 'Dusclops', 'Dusknoir', 55, ''),
(307, 'Mantyke', 'Mantine', 32, ''),
(308, 'Sneasel', 'Weavile', 55, ''),
(309, 'Golbat', 'Crobat', 55, ''),
(310, 'Magnemite', 'Magnezone', 55, ''),
(311, 'Rhydon', 'Rhyperior', 55, ''),
(312, 'Tangela', 'Tangrowth', 55, ''),
(313, 'Azurill', 'Marill', 21, ''),
(315, 'Boldore', 'Gigalith', 36, ''),
(316, 'Slowbro', 'Slowking', 55, ''),
(317, 'Yanma', 'Yanmega', 42, ''),
(5080, 'Swadloon', 'Leavanny', 0, 'Rare Candy'),
(318, 'Munchlax', 'Snorlax', 5, ''),
(319, 'Froakie', 'Frogadier', 36, ''),
(320, 'Frogadier', 'Greninja', 36, ''),
(321, 'Goomy', 'Sliggoo', 40, ''),
(322, 'Sliggoo', 'Goodra', 100, ''),
(323, 'Chespin', 'Quilladin', 16, ''),
(324, 'Quilladin', 'Chesnaught', 36, ''),
(325, 'Fennekin', 'Braixen', 16, ''),
(326, 'Braixen', 'Delphox', 40, ''),
(327, 'Bunnelby', 'Diggersby', 20, ''),
(328, 'Fletchling', 'Fletchinder', 18, ''),
(329, 'Fletchinder', 'Talonflame', 40, ''),
(330, 'Scatterbug', 'Spewpa', 5, ''),
(331, 'Spewpa', 'Vivillon', 10, ''),
(332, 'Litleo', 'Pyroar', 35, ''),
(333, 'Flabébé', 'Floette', 10, ''),
(334, 'Floette', 'Florges', 30, ''),
(335, 'Skiddo', 'Gogoat', 46, ''),
(336, 'Pancham', 'Pangoro', 35, ''),
(337, 'Honedge', 'Doublade', 35, ''),
(338, 'Doublade', 'Aegislash', 100, ''),
(339, 'Spritzee', 'Aromatisse', 5, ''),
(340, 'Swirlix', 'Slurpuff', 45, ''),
(341, 'Inkay', 'Malamar', 55, ''),
(342, 'Binacle', 'Barbaracle', 55, ''),
(343, 'Skrelp', 'Dragalge', 55, ''),
(344, 'Clauncher', 'Clawitzer', 55, ''),
(345, 'Helioptile', 'Heliolisk', 55, ''),
(346, 'Tyrunt', 'Tyrantrum', 55, ''),
(347, 'Amaura', 'Aurorus', 44, ''),
(348, 'Phantump', 'Trevenant', 44, ''),
(349, 'Pumpkaboo', 'Gourgeist', 44, ''),
(350, 'Bergmite', 'Avalugg', 55, ''),
(351, 'Noibat', 'Noivern', 55, ''),
(352, 'Espurr', 'Meowstic', 25, ''),
(354, 'Pikakip', 'Pikatomp', 35, ''),
(356, 'Pikatomp', 'Raipert', 55, ''),
(357, 'Togepi', 'Togetic', 5, ''),
(358, 'Togetic', 'Togekiss', 55, ''),
(359, 'Demondile', 'Demonaw', 3000, ''),
(360, 'Demonaw', 'Demonzard', 4000, ''),
(362, 'Slowbro', 'Slowking', 55, ''),
(363, 'Magby', 'Magmar', 30, '');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `uid` bigint(2) NOT NULL,
  `friendid` bigint(2) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`uid`, `friendid`, `id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gym_groups`
--

CREATE TABLE `gym_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `order` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gym_groups`
--

INSERT INTO `gym_groups` (`id`, `group_name`, `order`) VALUES
(7, 'Indigo Gymleaders', 1),
(8, 'Johto Gymleaders', 2),
(9, 'Hoenn Gymleaders', 3),
(10, 'Sinnoh Gymleaders', 4),
(11, 'Champions League', 5),
(12, 'Helios League', 6);

-- --------------------------------------------------------

--
-- Table structure for table `gym_leaders`
--

CREATE TABLE `gym_leaders` (
  `id` int(11) NOT NULL,
  `gid` smallint(6) NOT NULL,
  `order` smallint(6) NOT NULL,
  `leader_name` varchar(50) NOT NULL,
  `badge` varchar(50) NOT NULL,
  `need_for_legend` enum('0','1') NOT NULL,
  `poke1_name` varchar(100) NOT NULL,
  `poke1_level` int(11) NOT NULL,
  `poke2_name` varchar(100) NOT NULL,
  `poke2_level` int(11) NOT NULL,
  `poke3_name` varchar(100) NOT NULL,
  `poke3_level` int(11) NOT NULL,
  `poke4_name` varchar(100) NOT NULL,
  `poke4_level` int(11) NOT NULL,
  `poke5_name` varchar(100) NOT NULL,
  `poke5_level` int(11) NOT NULL,
  `poke6_name` varchar(100) NOT NULL,
  `poke6_level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `link_ref`
--

CREATE TABLE `link_ref` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `ref` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link_ref`
--

INSERT INTO `link_ref` (`id`, `name`, `ref`) VALUES
(1, 'Auctions', 5033),
(2, 'My Profile', 1787),
(3, 'My PokeBox', 5300),
(4, 'Trade Center', 709),
(5, 'Global Buy/Sell', 1631),
(6, 'Battle Training', 1018),
(7, 'ChatRoom', 267),
(8, 'Forums', 0),
(9, 'Online Members', 1094),
(10, 'Member List', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `timesent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lucky_hour`
--

CREATE TABLE `lucky_hour` (
  `id` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `pokemon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `name`) VALUES
(1, 'Snow Kyurem');

-- --------------------------------------------------------

--
-- Table structure for table `medals`
--

CREATE TABLE `medals` (
  `id` smallint(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `autodays` int(255) NOT NULL DEFAULT '0',
  `autorecruits` int(255) NOT NULL DEFAULT '0',
  `outsidelink` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medals`
--

INSERT INTO `medals` (`id`, `name`, `picture`, `description`, `autodays`, `autorecruits`, `outsidelink`) VALUES
(32, 'Army Achievement Medal', '/medals/aa.jpg', '', 150, 0, 0),
(2, 'American Campaign Medal', '/medals/ac.jpg', '', 730, 0, 0),
(3, 'Army Distinguished Cross', '/medals/adc.jpg', '', 20, 0, 0),
(4, 'Armed Forces Services', '/medals/afs.jpg', '', 10, 0, 0),
(5, 'Army Good Conduct Medal', '/medals/agc.jpg', '', 90, 0, 0),
(6, 'Asiatic Pacific Campaign Medal', '/medals/apc.jpg', 'This medal is given to a member who wins an interclan tournament. ', 0, 0, 0),
(7, 'Airman\'s Medal', '/medals/am.jpg', '', 1000, 0, 0),
(8, 'Army Reserve Achievment Medal', '/medals/ara.jpg', '', 210, 0, 0),
(9, 'Bronze Star', '/medals/bs.jpg', '', 30, 0, 0),
(10, 'Defense Distinguished Service Medal', '/medals/ddsm.jpg', 'Awaded for strong activeness on the message board and Battle.net. ', 0, 0, 0),
(11, 'Distinguished Flying Cross', '/medals/dfc.jpg', 'Awarded to anyone who has 0 DSL for a week straight. Ask a general for this medal. ', 0, 0, 0),
(12, 'Distinguished Knowledge Achievement', '/medals/dka.jpg', 'This Medal is awarded to anyone that has a basic knowledge of bots. Must be able to load at least ONE. ', 0, 0, 0),
(13, 'Distinguished Knowledge Commendation', '/medals/dkc.jpg', 'This Medal is awarded to anyone that has an excellent knowledge of bots. Must be able to load at least FOUR. ', 0, 0, 0),
(14, 'Defense Meritorious Service Medal', '/medals/dms.jpg', 'Awarded for Extreme Activeness on Battle.net, AIM and the message board. ', 0, 0, 0),
(15, 'Distinguished Service Cross', '/medals/dsc.jpg', '', 300, 0, 0),
(16, 'Distinguished Service Medal', '/medals/dsm.jpg', '', 180, 0, 0),
(17, 'Defense Superior Service Medal', '/medals/dss.jpg', 'Awarded for High activeness on Battle.net and on message board. Recipient must be on everyday and constantly show support. ', 0, 0, 0),
(18, 'Medal for Humane Action', '/medals/ha.jpg', '', 550, 0, 0),
(19, 'Humanitarian Service Medal', '/medals/hs.jpg', '', 365, 0, 0),
(20, 'Joint Service Commendation Medal', '/medals/jsc.jpg', '', 450, 0, 0),
(21, 'Legion of Merit', '/medals/lom.jpg', 'This medal is given only to members who are competent, loyal, reliable at all times. ', 0, 0, 0),
(22, 'Meritorious Knowledge', '/medals/mka.jpg', 'Achievement\r\nThis Medal is awarded to anyone that has an exceptional knowledge of bots. Must be able to load at least NINE. ', 0, 0, 0),
(23, 'Medal of Honor', '/medals/moh.jpg', 'The Highest ranking medal you can recieve. This medal shows supreme dedication, supreme loyalty, supreme activeness, and supreme helpful to the clan. Can ONLY be awarded by Commanders. ', 0, 0, 0),
(24, 'Meritorious Service Medal', '/medals/ms.jpg', 'This the second Highest medal can be awared. This medal is given only to members who are EXTREMELY loyal, trustworthy, and reliable at all times. Can only be awarded by commanders. ', 0, 0, 0),
(25, 'Navy Achievement', '/medals/na.jpg', 'This medal is awarded to the above average member who has shown his loyalty. ', 0, 0, 0),
(26, 'Navy Cross', '/medals/nc.jpg', 'This medal is given to members who have proven themselves loyal and trustworthy. ', 0, 0, 0),
(27, 'Purple Heart', '/medals/ph.jpg', 'Awarded to member who helps the clan through Web Design/Graphics, etc... ', 0, 0, 0),
(28, 'Prisoner of War', '/medals/pow.jpg', 'Given to a member who helps gain information on another clan during war. Must be approved by general first before spying. ', 0, 0, 0),
(29, 'Silver Star', '/medals/ss.jpg', 'Blah', 120, 0, 0),
(30, 'United Nations Medal', '/medals/un.jpg', 'Awarded for helping set up an alliance. The clan must be active, at least 2 months old, mature leader, at 25 members, and decent website. ', 0, 0, 0),
(31, 'US Service Medal', '/medals/uss.jpg', '', 60, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_uid` int(11) NOT NULL,
  `recipient_uid` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `read` enum('0','1') NOT NULL,
  `deleted_by_sender` enum('0','1') NOT NULL,
  `deleted_by_recipient` enum('0','1') NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mines`
--

CREATE TABLE `mines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ore` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mine_shop`
--

CREATE TABLE `mine_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mine_shop`
--

INSERT INTO `mine_shop` (`id`, `name`, `price`) VALUES
(1, 'Christmas Eevee', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `moves`
--

CREATE TABLE `moves` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `power` int(3) NOT NULL,
  `accuracy` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moves`
--

INSERT INTO `moves` (`id`, `name`, `type`, `category`, `power`, `accuracy`) VALUES
(1, 'Absorb', 'Grass', 'Special', 20, 100),
(2, 'Acid', 'Poison', 'Special', 40, 100),
(3, 'Acid Armor', 'Poison', 'Status', 0, 0),
(4, 'Agility', 'Psychic', 'Status', 0, 0),
(5, 'Amnesia', 'Psychic', 'Status', 0, 0),
(6, 'Aurora Beam', 'Ice', 'Special', 65, 100),
(7, 'Barrage', 'Normal', 'Physical', 15, 85),
(8, 'Barrier', 'Psychic', 'Status', 0, 0),
(9, 'Bide', 'Normal', 'Physical', 0, 0),
(10, 'Bind', 'Normal', 'Physical', 15, 85),
(11, 'Bite', 'Normal', 'Physical', 60, 100),
(12, 'Blizzard', 'Ice', 'Special', 120, 70),
(13, 'Body Slam', 'Normal', 'Physical', 85, 100),
(14, 'Bone Club', 'Ground', 'Physical', 65, 85),
(15, 'Bonemerang', 'Ground', 'Physical', 50, 90),
(16, 'Bubble', 'Water', 'Special', 20, 100),
(17, 'Bubblebeam', 'Water', 'Special', 65, 100),
(18, 'Clamp', 'Water', 'Physical', 35, 75),
(19, 'Comet Punch', 'Normal', 'Physical', 18, 85),
(20, 'Confuse Ray', 'Ghost', 'Status', 0, 100),
(21, 'Confusion', 'Psychic', 'Special', 50, 100),
(22, 'Constrict', 'Normal', 'Physical', 10, 100),
(23, 'Conversion', 'Normal', 'Status', 0, 0),
(24, 'Counter', 'Fighting', 'Physical', 0, 100),
(25, 'Crab Hammer', 'Water', 'Physical', 90, 90),
(26, 'Cut', 'Normal', 'Physical', 50, 95),
(27, 'Defense Curl', 'Normal', 'Status', 0, 0),
(28, 'Dig', 'Ground', 'Physical', 80, 100),
(29, 'Disable', 'Normal', 'Status', 0, 100),
(30, 'Dizzy Punch', 'Normal', 'Physical', 70, 100),
(31, 'Double Kick', 'Fighting', 'Physical', 30, 100),
(32, 'Double Team', 'Normal', 'Status', 0, 0),
(33, 'Double Edge', 'Normal', 'Physical', 120, 100),
(34, 'Doubleslap', 'Normal', 'Physical', 15, 85),
(35, 'Dragon Rage', 'Dragon', 'Special', 40, 100),
(36, 'Dream Eater', 'Psychic', 'Special', 100, 100),
(37, 'Drill Peck', 'Flying', 'Physical', 80, 100),
(38, 'Earthquake', 'Ground', 'Physical', 100, 100),
(39, 'Egg Bomb', 'Normal', 'Physical', 100, 75),
(40, 'Ember', 'Fire', 'Special', 40, 100),
(41, 'Explosion', 'Normal', 'Physical', 250, 100),
(42, 'Fire Blast', 'Fire', 'Special', 120, 85),
(43, 'Fire Punch', 'Fire', 'Physical', 75, 100),
(44, 'Fire Spin', 'Fire', 'Special', 35, 85),
(45, 'Fissure', 'Ground', 'Physical', 0, 30),
(46, 'Flamethrower', 'Fire', 'Special', 95, 100),
(47, 'Flash', 'Normal', 'Status', 0, 100),
(48, 'Fly', 'Flying', 'Physical', 90, 95),
(49, 'Focus Energy', 'Normal', 'Status', 0, 0),
(50, 'Fury Attack', 'Normal', 'Physical', 15, 85),
(51, 'Fury Swipes', 'Normal', 'Physical', 18, 80),
(52, 'Glare', 'Normal', 'Status', 0, 90),
(53, 'Growl', 'Normal', 'Status', 0, 100),
(54, 'Growth', 'Normal', 'Status', 0, 0),
(55, 'Guillotine', 'Normal', 'Physical', 0, 30),
(56, 'Gust', 'Flying', 'Special', 40, 100),
(57, 'Harden', 'Normal', 'Status', 0, 0),
(58, 'Haze', 'Ice', 'Status', 0, 0),
(59, 'Head Butt', 'Normal', 'Physical', 70, 100),
(60, 'Hi Jump Kick', 'Fighting', 'Physical', 0, 0),
(61, 'Horn Attack', 'Normal', 'Physical', 65, 100),
(62, 'Horn Drill', 'Normal', 'Physical', 0, 30),
(63, 'Hydro Pump', 'Water', 'Special', 120, 80),
(64, 'Hyper Beam', 'Normal', 'Special', 150, 90),
(65, 'Hyper Fang', 'Normal', 'Physical', 80, 90),
(66, 'Hypnosis', 'Psychic', 'Status', 0, 60),
(67, 'Ice Beam', 'Ice', 'Special', 95, 100),
(68, 'Ice Punch', 'Ice', 'Physical', 75, 100),
(69, 'Jump Kick', 'Fighting', 'Physical', 85, 95),
(70, 'Karate Chop', 'Fighting', 'Physical', 50, 100),
(71, 'Kinesis', 'Psychic', 'Status', 0, 80),
(72, 'Leech Life', 'Bug', 'Physical', 20, 100),
(73, 'Leech Seed', 'Grass', 'Status', 0, 90),
(74, 'Leer', 'Normal', 'Status', 0, 100),
(75, 'Lick', 'Ghost', 'Physical', 20, 100),
(76, 'Light Screen', 'Psychic', 'Status', 0, 0),
(77, 'Lovely Kiss', 'Normal', 'Status', 0, 75),
(78, 'Low Kick', 'Fighting', 'Physical', 0, 100),
(79, 'Meditate', 'Psychic', 'Status', 0, 0),
(80, 'Mega Drain', 'Grass', 'Special', 40, 100),
(81, 'Mega Kick', 'Normal', 'Physical', 120, 75),
(82, 'Mega Punch', 'Normal', 'Physical', 80, 85),
(83, 'Metronome', 'Normal', 'Status', 0, 0),
(84, 'Mimic', 'Normal', 'Status', 0, 0),
(85, 'Minimize', 'Normal', 'Status', 0, 0),
(86, 'Mirror Move', 'Flying', 'Status', 0, 0),
(87, 'Mist', 'Ice', 'Status', 0, 0),
(88, 'Night Shade', 'Ghost', 'Special', 0, 100),
(89, 'Pay Day', 'Normal', 'Physical', 40, 100),
(90, 'Peck', 'Flying', 'Physical', 35, 100),
(91, 'Petal Dance', 'Grass', 'Special', 120, 100),
(92, 'Pin Missile', 'Bug', 'Physical', 14, 85),
(93, 'Poison Gas', 'Poison', 'Status', 0, 85),
(94, 'Poison Sting', 'Poison', 'Physical', 15, 100),
(95, 'Poison Powder', 'Poison', 'Status', 0, 75),
(96, 'Pound', 'Normal', 'Physical', 40, 100),
(97, 'Psybeam', 'Psychic', 'Special', 65, 100),
(98, 'Psychic', 'Psychic', 'Special', 90, 100),
(99, 'Psywave', 'Psychic', 'Special', 0, 80),
(100, 'Quick Attack', 'Normal', 'Physical', 40, 100),
(101, 'Rage', 'Normal', 'Physical', 20, 100),
(102, 'Razor Leaf', 'Grass', 'Physical', 55, 95),
(103, 'Razor Wind', 'Normal', 'Special', 80, 100),
(104, 'Recover', 'Normal', 'Status', 0, 0),
(105, 'Reflect', 'Psychic', 'Status', 0, 0),
(106, 'Rest', 'Psychic', 'Status', 0, 0),
(107, 'Roar', 'Normal', 'Status', 0, 100),
(108, 'Rock Slide', 'Rock', 'Physical', 75, 90),
(109, 'Rock Throw', 'Rock', 'Physical', 50, 90),
(110, 'Rolling Kick', 'Fighting', 'Physical', 60, 85),
(111, 'Sand Attack', 'Ground', 'Status', 0, 100),
(112, 'Scratch', 'Normal', 'Physical', 40, 100),
(113, 'Screech', 'Normal', 'Status', 0, 85),
(114, 'Seismic Toss', 'Fighting', 'Physical', 0, 100),
(115, 'Self Destruct', 'Normal', 'Physical', 200, 100),
(116, 'Sharpen', 'Normal', 'Status', 0, 0),
(117, 'Sing', 'Normal', 'Status', 0, 55),
(118, 'Skull Bash', 'Normal', 'Physical', 100, 100),
(119, 'Sky Attack', 'Flying', 'Physical', 140, 90),
(120, 'Slam', 'Normal', 'Physical', 80, 75),
(121, 'Slash', 'Normal', 'Physical', 70, 100),
(122, 'Sleep Powder', 'Grass', 'Status', 0, 75),
(123, 'Sludge', 'Poison', 'Special', 65, 100),
(124, 'Smog', 'Poison', 'Special', 20, 70),
(125, 'Smoke Screen', 'Normal', 'Status', 0, 100),
(126, 'Softboiled', 'Normal', 'Status', 0, 0),
(127, 'Solar Beam', 'Grass', 'Special', 120, 100),
(128, 'Sonic Boom', 'Normal', 'Special', 0, 90),
(129, 'Spike Cannon', 'Normal', 'Physical', 20, 100),
(130, 'Splash', 'Normal', 'Status', 0, 0),
(131, 'Spore', 'Grass', 'Status', 0, 100),
(132, 'Stomp', 'Normal', 'Physical', 65, 100),
(133, 'Strength', 'Normal', 'Physical', 80, 100),
(134, 'String Shot', 'Bug', 'Status', 0, 95),
(135, 'Struggle', 'Normal', 'Physical', 50, 100),
(136, 'Stun Spore', 'Grass', 'Status', 0, 75),
(137, 'Submission', 'Fighting', 'Physical', 80, 80),
(138, 'Substitute', 'Normal', 'Status', 0, 0),
(139, 'Super Fang', 'Normal', 'Physical', 0, 90),
(140, 'Supersonic', 'Normal', 'Status', 0, 55),
(141, 'Surf', 'Water', 'Special', 95, 100),
(142, 'Swift', 'Normal', 'Special', 60, 0),
(143, 'Swords Dance', 'Normal', 'Status', 0, 0),
(144, 'Tackle', 'Normal', 'Physical', 50, 100),
(145, 'Tail Whip', 'Normal', 'Status', 0, 100),
(146, 'Take Down', 'Normal', 'Physical', 90, 85),
(147, 'Teleport', 'Psychic', 'Status', 0, 0),
(148, 'Thrash', 'Normal', 'Physical', 120, 100),
(149, 'Thunder', 'Electric', 'Special', 120, 70),
(150, 'Thunder Wave', 'Electric', 'Status', 0, 100),
(151, 'Thunderbolt', 'Electric', 'Special', 95, 100),
(152, 'Thunder Punch', 'Electric', 'Physical', 75, 100),
(153, 'Thundershock', 'Electric', 'Special', 40, 100),
(154, 'Toxic', 'Poison', 'Status', 0, 90),
(155, 'Transform', 'Normal', 'Status', 0, 0),
(156, 'Tri Attack', 'Normal', 'Special', 80, 100),
(157, 'Twineedle', 'Bug', 'Physical', 25, 100),
(158, 'Vice Grip', 'Normal', 'Physical', 55, 100),
(159, 'Vine Whip', 'Grass', 'Physical', 35, 100),
(160, 'Water Gun', 'Water', 'Special', 40, 100),
(161, 'Waterfall', 'Water', 'Physical', 80, 100),
(162, 'Whirlwind', 'Normal', 'Status', 0, 100),
(163, 'Wing Attack', 'Flying', 'Physical', 60, 100),
(164, 'Withdraw', 'Water', 'Status', 0, 0),
(165, 'Wrap', 'Normal', 'Physical', 15, 90),
(166, 'Shadow Armlet', 'Ghost', 'Flying', 100, 50),
(167, 'Heavenly Strike', 'God', 'God', 200, 100),
(168, 'God Armlet', 'God', 'God', 200, 100);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `news` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `bywho` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_images`
--

CREATE TABLE `new_images` (
  `id` int(10) NOT NULL,
  `uid` int(15) NOT NULL,
  `image_data` text NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `comment` varchar(5000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `npc`
--

CREATE TABLE `npc` (
  `id` bigint(20) NOT NULL,
  `npcname` varchar(255) NOT NULL,
  `map_num` int(2) NOT NULL,
  `map_x` int(2) NOT NULL,
  `map_y` int(2) NOT NULL,
  `map_sprite` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `npc`
--

INSERT INTO `npc` (`id`, `npcname`, `map_num`, `map_x`, `map_y`, `map_sprite`) VALUES
(1, 'Edmund', 1, 17, 6, 11);

-- --------------------------------------------------------

--
-- Table structure for table `numbergame`
--

CREATE TABLE `numbergame` (
  `number` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `numbergame`
--

INSERT INTO `numbergame` (`number`, `userid`, `ip`) VALUES
(30, 6469, '121.72.165.62'),
(11, 6710, '151.224.73.250'),
(16, 832, '84.30.47.237'),
(37, 4053, '92.40.255.79'),
(28, 6741, '125.255.32.136'),
(12, 1739, '70.62.136.45'),
(36, 2856, '207.119.216.253'),
(29, 6310, '218.107.49.30'),
(47, 2747, '121.214.110.137'),
(6, 2564, '175.110.78.190'),
(21, 2258, '175.110.78.190'),
(20, 141, '180.234.248.66'),
(24, 6744, '99.139.204.236'),
(26, 2055, '188.26.85.128'),
(13, 6476, '202.72.219.50'),
(5, 441, '82.2.60.174'),
(44, 6562, '86.164.102.225'),
(17, 131, '86.85.76.176'),
(1, 1655, '182.178.9.10'),
(42, 1897, '84.30.44.30'),
(19, 6758, '199.116.199.194'),
(39, 5601, '72.10.123.218'),
(33, 164, '87.112.159.213'),
(15, 2, '204.93.60.68');

-- --------------------------------------------------------

--
-- Table structure for table `offer_pokemon`
--

CREATE TABLE `offer_pokemon` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `move1` varchar(30) NOT NULL,
  `move2` varchar(30) NOT NULL,
  `move3` varchar(30) NOT NULL,
  `move4` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pokedex`
--

CREATE TABLE `pokedex` (
  `id` bigint(60) NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `attack` bigint(60) NOT NULL,
  `spattack` bigint(60) NOT NULL,
  `def` bigint(60) NOT NULL,
  `spdef` bigint(60) NOT NULL,
  `hp` bigint(60) NOT NULL,
  `speed` bigint(60) NOT NULL,
  `evolution` varchar(255) COLLATE latin1_general_ci DEFAULT 'none',
  `level` bigint(60) DEFAULT NULL,
  `type1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `type2` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `exp` int(3) NOT NULL,
  `num` int(11) NOT NULL,
  `move1` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT 'Scratch',
  `move2` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT 'Scratch',
  `move3` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT 'Scratch',
  `move4` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT 'Scratch',
  `gender` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pokedex`
--

INSERT INTO `pokedex` (`id`, `name`, `attack`, `spattack`, `def`, `spdef`, `hp`, `speed`, `evolution`, `level`, `type1`, `type2`, `exp`, `num`, `move1`, `move2`, `move3`, `move4`, `gender`) VALUES
(1, 'Bulbasaur', 49, 65, 49, 65, 45, 45, 'Ivysaur', 16, 'Grass', 'Poison', 64, 1, 'Tackle', 'Growl', 'Leech Seed', 'Vine Whip', 0),
(2, 'Ivysaur', 62, 80, 63, 80, 60, 60, 'Venusaur', 32, 'Grass', 'Poison', 141, 2, 'Vine Whip', 'Poison Powder', 'Razor Leaf', 'Growth', 0),
(3, 'Venusaur', 82, 100, 83, 100, 80, 80, 'Venusaur', 32, 'Grass', 'Poison', 208, 3, 'Razor Leaf', 'Growth', 'Sleep Powder', 'Solar Beam', 0),
(4, 'Charmander', 52, 60, 43, 50, 39, 65, 'Charmeleon', 16, 'Fire', NULL, 65, 4, 'Scratch', 'Growl', 'Ember', 'Leer', 0),
(5, 'Charmeleon', 64, 80, 58, 65, 58, 80, 'Charizard', 36, 'Fire', NULL, 142, 5, 'Leer', 'Rage', 'Slash', 'Flamethrower', 0),
(6, 'Charizard', 84, 109, 78, 85, 78, 100, 'Charizard', 36, 'Fire', 'Flying', 209, 6, 'Rage', 'Slash', 'Flamethrower', 'Fire Spin', 0),
(7, 'Squirtle', 48, 50, 65, 64, 44, 43, 'Wartortle', 16, 'Water', NULL, 66, 7, 'Tackle', 'Tail Whip', 'Bubble', 'Water Gun', 0),
(8, 'Wartortle', 63, 65, 80, 80, 59, 58, 'Blastoise', 32, 'Water', NULL, 143, 8, 'Water Gun', 'Bite', 'Withdraw', 'Skull Bash', 0),
(9, 'Blastoise', 83, 85, 100, 105, 79, 78, 'Blastoise', 32, 'Water', NULL, 210, 9, 'Bite', 'Withdraw', 'Skull Bash', 'Hydro Pump', 0),
(10, 'Caterpie', 30, 20, 35, 20, 45, 45, 'Metapod', 7, 'Bug', NULL, 53, 10, 'Tackle', 'String Shot', 'String Shot', 'String Shot', 0),
(11, 'Metapod', 20, 25, 55, 25, 50, 30, 'Butterfree', 12, 'Bug', NULL, 72, 11, 'Tackle', 'Harden', 'String Shot', 'String Shot', 0),
(12, 'Butterfree', 45, 80, 50, 80, 60, 70, 'Butterfree', 12, 'Bug', 'Flying', 160, 12, 'Sleep Powder', 'Supersonic', 'Whirlwind', 'Psybeam', 0),
(13, 'Weedle', 35, 20, 30, 20, 40, 50, 'Kakuna', 7, 'Bug', 'Poison', 52, 13, 'Poison Sting', 'String Shot', 'String Shot', 'String Shot', 0),
(14, 'Kakuna', 25, 25, 50, 25, 45, 35, 'Beedrill', 12, 'Bug', 'Poison', 71, 14, 'Poison Sting', 'Harden', 'String Shot', 'String Shot', 0),
(15, 'Beedrill', 80, 45, 40, 80, 65, 75, 'Beedrill', 12, 'Bug', 'Poison', 159, 15, 'Twineedle', 'Rage', 'Pin Missile', 'Agility', 0),
(16, 'Pidgey', 45, 35, 40, 35, 40, 56, 'Pidgeotto', 18, 'Normal', 'Flying', 55, 16, 'Gust', 'Sand Attack', 'Quick Attack', 'Whirlwind', 0),
(17, 'Pidgeotto', 60, 50, 55, 50, 63, 71, 'Pidgeot', 36, 'Normal', 'Flying', 113, 17, 'Whirlwind', 'Wing Attack', 'Agility', 'Mirror Move', 0),
(18, 'Pidgeot', 80, 70, 75, 70, 83, 91, 'Pidgeot', 36, 'Normal', 'Flying', 172, 18, 'Whirlwind', 'Wing Attack', 'Agility', 'Mirror Move', 0),
(19, 'Rattata', 56, 25, 35, 35, 30, 72, 'Raticate', 20, 'Normal', NULL, 57, 19, 'Tackle', 'Tail Whip', 'Quick Attack', 'Hyper Fang', 0),
(20, 'Raticate', 81, 50, 60, 70, 55, 97, 'Raticate', 20, 'Normal', NULL, 116, 20, 'Quick Attack', 'Hyper Fang', 'Focus Energy', 'Super Fang', 0),
(21, 'Spearow', 60, 31, 30, 31, 40, 70, 'Fearow', 20, 'Normal', 'Flying', 58, 21, 'Peck', 'Growl', 'Leer', 'Fury Attack', 0),
(22, 'Fearow', 90, 61, 65, 61, 65, 100, 'Fearow', 20, 'Normal', 'Flying', 162, 22, 'Fury Attack', 'Mirror Move', 'Drill Peck', 'Agility', 0),
(23, 'Ekans', 60, 40, 44, 54, 35, 55, 'Arbok', 22, 'Poison', NULL, 62, 23, 'Wrap', 'Leer', 'Poison Sting', 'Bite', 0),
(24, 'Arbok', 85, 65, 69, 79, 60, 80, 'Arbok', 22, 'Poison', NULL, 147, 24, 'Bite', 'Glare', 'Screech', 'Acid', 0),
(25, 'Pikachu', 55, 50, 30, 40, 35, 90, 'Raichu', 45, 'Electric', NULL, 82, 25, 'Thundershock', 'Growl', 'Thunder Wave', 'Quick Attack', 0),
(26, 'Raichu', 90, 90, 55, 80, 60, 100, 'Raichu', 45, 'Electric', NULL, 122, 26, 'Quick Attack', 'Swift', 'Agility', 'Thunder', 0),
(27, 'Sandshrew', 75, 20, 85, 30, 50, 40, 'Sandslash', 22, 'Ground', NULL, 93, 27, 'Scratch', 'Sand Attack', 'Slash', 'Poison Sting', 0),
(28, 'Sandslash', 100, 45, 110, 55, 75, 65, 'Sandslash', 22, 'Ground', NULL, 163, 28, 'Slash', 'Poison Sting', 'Swift', 'Fury Swipes', 0),
(29, 'Nidoran (f)', 47, 40, 52, 40, 55, 41, 'Nidorina', 18, 'Poison', '', 59, 29, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(30, 'Nidorina', 62, 55, 67, 55, 70, 56, 'Nidoqueen', 45, 'Poison', NULL, 117, 30, 'Tail Whip', 'Bite', 'Fury Swipes', 'Double Kick', 0),
(31, 'Nidoqueen', 82, 75, 87, 85, 90, 76, 'Nidoqueen', 45, 'Poison', 'Ground', 194, 31, 'Fury Swipes', 'Double Kick', 'Poison Sting', 'Body Slam', 0),
(32, 'Nidoran (m)', 57, 40, 40, 40, 46, 50, 'Nidorino', 18, 'Poison', '', 60, 32, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(33, 'Nidorino', 72, 55, 57, 55, 61, 65, 'Nidoking', 45, 'Poison', NULL, 118, 33, 'Focus Energy', 'Fury Attack', 'Horn Drill', 'Double Kick', 0),
(34, 'Nidoking', 92, 85, 77, 75, 81, 85, 'Nidoking', 45, 'Poison', 'Ground', 195, 34, 'Fury Attack', 'Horn Drill', 'Double Kick', 'Thrash', 0),
(35, 'Clefairy', 45, 60, 48, 65, 70, 35, 'Clefable', 45, 'Normal', NULL, 68, 35, 'Pound', 'Growl', 'Sing', 'Doubleslap', 0),
(36, 'Clefable', 70, 85, 73, 90, 95, 60, 'Clefable', 45, 'Normal', NULL, 129, 36, 'Minimize', 'Metronome', 'Defense Curl', 'Light Screen', 0),
(37, 'Vulpix', 41, 50, 40, 65, 38, 65, 'Ninetales', 45, 'Fire', NULL, 63, 37, 'Ember', 'Tail Whip', 'Quick Attack', 'Roar', 0),
(38, 'Ninetales', 76, 81, 75, 100, 73, 100, 'Ninetales', 45, 'Fire', NULL, 178, 38, 'Roar', 'Confuse Ray', 'Flamethrower', 'Fire Spin', 0),
(39, 'Jigglypuff', 45, 45, 20, 25, 115, 20, 'Wigglytuff', 45, 'Normal', NULL, 76, 39, 'Sing', 'Pound', 'Disable', 'Defense Curl', 0),
(40, 'Wigglytuff', 70, 75, 45, 50, 140, 45, 'Wigglytuff', 45, 'Normal', NULL, 109, 40, 'Doubleslap', 'Rest', 'Body Slam', 'Double Edge', 0),
(41, 'Zubat', 45, 30, 35, 40, 40, 55, 'Golbat', 22, 'Poison', 'Flying', 54, 41, 'Leech Life', 'Supersonic', 'Bite', 'Confuse Ray', 0),
(42, 'Golbat', 80, 65, 70, 75, 75, 90, 'Golbat', 22, 'Poison', 'Flying', 171, 42, 'Bite', 'Confuse Ray', 'Wing Attack', 'Haze', 0),
(43, 'Oddish', 50, 75, 55, 65, 45, 30, 'Gloom', 26, 'Grass', 'Poison', 78, 43, 'Absorb', 'Poison Powder', 'Stun Spore', 'Sleep Powder', 0),
(44, 'Gloom', 65, 85, 70, 75, 60, 40, 'Vileplume', 45, 'Grass', 'Poison', 132, 44, 'Sleep Powder', 'Acid', 'Petal Dance', 'Solar Beam', 0),
(45, 'Vileplume', 80, 100, 85, 90, 75, 50, 'Vileplume', 45, 'Grass', 'Poison', 184, 45, 'Sleep Powder', 'Acid', 'Petal Dance', 'Solar Beam', 0),
(46, 'Paras', 70, 45, 55, 55, 35, 25, 'Parasect', 24, 'Bug', 'Grass', 70, 46, 'Scratch', 'Stun Spore', 'Leech Life', 'Spore', 0),
(47, 'Parasect', 95, 60, 80, 80, 60, 30, 'Parasect', 24, 'Bug', 'Grass', 128, 47, 'Leech Life', 'Spore', 'Slash', 'Growth', 0),
(48, 'Venonat', 55, 40, 50, 55, 60, 45, 'Venomoth', 31, 'Bug', 'Poison', 75, 48, 'Tackle', 'Disable', 'Poison Powder', 'Leech Life', 0),
(49, 'Venomoth', 65, 90, 60, 75, 70, 90, 'Venomoth', 31, 'Bug', 'Poison', 138, 49, 'Stun Spore', 'Psybeam', 'Sleep Powder', 'Psychic', 0),
(50, 'Diglett', 55, 35, 25, 45, 10, 95, 'Dugtrio', 29, 'Ground', NULL, 81, 50, 'Scratch', 'Growl', 'Dig', 'Sand Attack', 0),
(51, 'Dugtrio', 80, 50, 50, 70, 35, 120, 'Dugtrio', 29, 'Ground', NULL, 153, 51, 'Dig', 'Sand Attack', 'Slash', 'Earthquake', 0),
(52, 'Meowth', 45, 40, 35, 40, 40, 90, 'Persian', 28, 'Normal', NULL, 69, 52, 'Scratch', 'Growl', 'Bite', 'Pay Day', 0),
(53, 'Persian', 70, 65, 60, 65, 65, 115, 'Persian', 28, 'Normal', NULL, 148, 53, 'Pay Day', 'Screech', 'Fury Swipes', 'Slash', 0),
(54, 'Psyduck', 52, 65, 48, 50, 50, 55, 'Golduck', 33, 'Water', NULL, 80, 54, 'Scratch', 'Tail Whip', 'Disable', 'Confusion', 0),
(55, 'Golduck', 82, 95, 78, 80, 80, 85, 'Golduck', 33, 'Water', NULL, 174, 55, 'Disable', 'Confusion', 'Fury Swipes', 'Hydro Pump', 0),
(56, 'Mankey', 80, 35, 35, 45, 40, 70, 'Primeape', 28, 'Fighting', NULL, 74, 56, 'Scratch', 'Leer', 'Karate Chop', 'Fury Attack', 0),
(57, 'Primeape', 105, 60, 60, 70, 65, 95, 'Primeape', 28, 'Fighting', NULL, 149, 57, 'Fury Attack', 'Focus Energy', 'Seismic Toss', 'Thrash', 0),
(58, 'Growlithe', 70, 70, 45, 50, 55, 60, 'Arcanine', 45, 'Fire', NULL, 91, 58, 'Bite', 'Roar', 'Ember', 'Leer', 0),
(59, 'Arcanine', 110, 100, 80, 80, 90, 95, 'Arcanine', 45, 'Fire', NULL, 213, 59, 'Leer', 'Take Down', 'Agility', 'Flamethrower', 0),
(60, 'Poliwag', 50, 40, 40, 40, 40, 90, 'Poliwhirl', 25, 'Water', NULL, 77, 60, 'Bubble', 'Hypnosis', 'Water Gun', 'Doubleslap', 0),
(61, 'Poliwhirl', 65, 50, 65, 50, 65, 90, 'Poliwrath', 45, 'Water', NULL, 131, 61, 'Doubleslap', 'Body Slam', 'Amnesia', 'Hydro Pump', 0),
(62, 'Poliwrath', 85, 70, 95, 90, 90, 70, 'Poliwrath', 45, 'Water', 'Fighting', 185, 62, 'Doubleslap', 'Body Slam', 'Amnesia', 'Hydro Pump', 0),
(63, 'Abra', 20, 105, 15, 55, 25, 90, 'Kadabra', 18, 'Psychic', NULL, 75, 63, 'Teleport', 'Teleport', 'Teleport', 'Teleport', 0),
(64, 'Kadabra', 35, 120, 30, 70, 40, 105, 'Alakazam', 45, 'Psychic', NULL, 145, 64, 'Teleport', 'Confusion', 'Disable', 'Psybeam', 0),
(65, 'Alakazam', 50, 135, 45, 85, 55, 120, 'Alakazam', 45, 'Psychic', NULL, 186, 65, 'Psybeam', 'Recover', 'Psychic', 'Reflect', 0),
(66, 'Machop', 80, 35, 50, 35, 70, 35, 'Machoke', 18, 'Fighting', NULL, 75, 66, 'Karate Chop', 'Low Kick', 'Leer', 'Focus Energy', 0),
(67, 'Machoke', 100, 50, 70, 60, 80, 45, 'Machamp', 45, 'Fighting', NULL, 146, 67, 'Leer', 'Focus Energy', 'Seismic Toss', 'Submission', 0),
(68, 'Machamp', 130, 65, 80, 85, 90, 55, 'Machamp', 45, 'Fighting', NULL, 193, 68, 'Leer', 'Focus Energy', 'Seismic Toss', 'Submission', 0),
(69, 'Bellsprout', 75, 70, 35, 30, 50, 40, 'Weepinbell', 21, 'Grass', 'Poison', 84, 69, 'Vine Whip', 'Growth', 'Wrap', 'Poison Powder', 0),
(70, 'Weepinbell', 90, 85, 50, 45, 65, 55, 'Victreebel', 45, 'Grass', 'Poison', 151, 70, 'Stun Spore', 'Acid', 'Razor Leaf', 'Slam', 0),
(71, 'Victreebel', 105, 100, 65, 60, 80, 70, 'Victreebel', 45, 'Grass', 'Poison', 191, 71, 'Stun Spore', 'Acid', 'Razor Leaf', 'Slam', 0),
(72, 'Tentacool', 40, 50, 35, 100, 40, 70, 'Tentacruel', 30, 'Water', 'Poison', 105, 72, 'Acid', 'Supersonic', 'Wrap', 'Poison Sting', 0),
(73, 'Tentacruel', 70, 80, 65, 120, 80, 100, 'Tentacruel', 30, 'Water', 'Poison', 205, 73, 'Constrict', 'Barrier', 'Screech', 'Hydro Pump', 0),
(74, 'Geodude', 80, 30, 100, 30, 40, 20, 'Graveler', 25, 'Rock', 'Ground', 73, 74, 'Tackle', 'Defense Curl', 'Rock Throw', 'Self Destruct', 0),
(75, 'Graveler', 95, 45, 115, 45, 55, 35, 'Golem', 45, 'Rock', 'Ground', 134, 75, 'Self Destruct', 'Harden', 'Earthquake', 'Explosion', 0),
(76, 'Golem', 110, 55, 130, 65, 80, 45, 'Golem', 45, 'Rock', 'Ground', 177, 76, 'Self Destruct', 'Harden', 'Earthquake', 'Explosion', 0),
(77, 'Ponyta', 85, 65, 55, 65, 50, 90, 'Rapidash', 40, 'Fire', NULL, 152, 77, 'Ember', 'Tail Whip', 'Stomp', 'Growl', 0),
(78, 'Rapidash', 100, 80, 70, 80, 65, 105, 'Rapidash', 40, 'Fire', NULL, 192, 78, 'Growl', 'Fire Spin', 'Take Down', 'Agility', 0),
(79, 'Slowpoke', 65, 40, 65, 40, 90, 15, 'Slowbro', 37, 'Water', 'Psychic', 99, 79, 'Confusion', 'Disable', 'Head Butt', 'Growl', 0),
(80, 'Slowbro', 75, 100, 110, 80, 95, 30, 'Slowking', 45, 'Water', 'Psychic', 164, 80, 'Growl', 'Water Gun', 'Amnesia', 'Psychic', 0),
(81, 'Magnemite', 35, 95, 70, 55, 25, 45, 'Magneton', 30, 'Electric', 'Steel', 89, 81, 'Tackle', 'Sonic Boom', 'Thundershock', 'Supersonic', 0),
(82, 'Magneton', 60, 120, 95, 70, 50, 70, 'Magnezone', 45, 'Electric', 'Steel', 161, 82, 'Supersonic', 'Thunder Wave', 'Swift', 'Screech', 0),
(83, 'Farfetch\'d', 65, 58, 55, 62, 52, 60, 'Farfetch\'d', 1, 'Normal', 'Flying', 94, 83, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(84, 'Doduo', 85, 35, 45, 35, 35, 75, 'Dodrio', 45, 'Normal', 'Flying', 96, 84, 'Peck', 'Growl', 'Fury Attack', 'Drill Peck', 0),
(85, 'Dodrio', 110, 60, 70, 60, 60, 100, 'Dodrio', 45, 'Normal', 'Flying', 158, 85, 'Drill Peck', 'Rage', 'Tri Attack', 'Agility', 0),
(86, 'Seel', 45, 45, 55, 70, 65, 45, 'Dewgong', 40, 'Water', NULL, 100, 86, 'Head Butt', 'Growl', 'Aurora Beam', 'Rest', 0),
(87, 'Dewgong', 70, 70, 80, 95, 90, 70, 'Dewgong', 40, 'Water', 'Ice', 176, 87, 'Aurora Beam', 'Rest', 'Take Down', 'Ice Beam', 0),
(88, 'Grimer', 80, 40, 50, 50, 80, 25, 'Muk', 35, 'Poison', NULL, 90, 88, 'Pound', 'Disable', 'Poison Gas', 'Minimize', 0),
(89, 'Muk', 105, 65, 75, 100, 105, 50, 'Muk', 35, 'Poison', NULL, 157, 89, 'Sludge', 'Harden', 'Screech', 'Acid Armor', 0),
(90, 'Shellder', 65, 45, 100, 25, 30, 40, 'Cloyster', 45, 'Water', NULL, 97, 90, 'Tackle', 'Withdraw', 'Supersonic', 'Clamp', 0),
(91, 'Cloyster', 95, 85, 180, 45, 50, 70, 'Cloyster', 45, 'Water', 'Ice', 203, 91, 'Aurora Beam', 'Leer', 'Ice Beam', 'Spike Cannon', 0),
(92, 'Gastly', 35, 100, 30, 35, 30, 80, 'Haunter', 25, 'Ghost', 'Poison', 95, 92, 'Lick', 'Confuse Ray', 'Night Shade', 'Hypnosis', 0),
(93, 'Haunter', 50, 115, 45, 55, 45, 95, 'Gengar', 45, 'Ghost', 'Poison', 126, 93, 'Confuse Ray', 'Night Shade', 'Hypnosis', 'Dream Eater', 0),
(94, 'Gengar', 65, 130, 60, 75, 60, 110, 'Gengar', 45, 'Ghost', 'Poison', 190, 94, 'Confuse Ray', 'Night Shade', 'Hypnosis', 'Dream Eater', 0),
(95, 'Onix', 45, 30, 160, 45, 35, 70, 'Steelix', 45, 'Rock', 'Ground', 108, 95, 'Rock Throw', 'Rage', 'Slam', 'Harden', 0),
(96, 'Drowzee', 48, 43, 45, 90, 60, 42, 'Hypno', 26, 'Psychic', NULL, 102, 96, 'Pound', 'Hypnosis', 'Disable', 'Confusion', 0),
(97, 'Hypno', 73, 73, 70, 115, 85, 67, 'Hypno', 26, 'Psychic', NULL, 165, 97, 'Head Butt', 'Poison Gas', 'Psychic', 'Meditate', 0),
(98, 'Krabby', 105, 25, 90, 25, 30, 50, 'Kingler', 21, 'Water', NULL, 115, 98, 'Bubble', 'Leer', 'Vice Grip', 'Guillotine', 0),
(99, 'Kingler', 130, 50, 115, 50, 55, 75, 'Kingler', 21, 'Water', NULL, 206, 99, 'Guillotine', 'Stomp', 'Crab Hammer', 'Harden', 0),
(100, 'Voltorb', 30, 55, 50, 55, 40, 100, 'Electrode', 30, 'Electric', NULL, 103, 100, 'Tackle', 'Screech', 'Sonic Boom', 'Self Destruct', 0),
(101, 'Electrode', 50, 80, 70, 80, 60, 140, 'Electrode', 30, 'Electric', NULL, 150, 101, 'Self Destruct', 'Light Screen', 'Swift', 'Explosion', 0),
(102, 'Exeggcute', 40, 60, 80, 45, 60, 40, NULL, NULL, 'Grass', 'Psychic', 98, 102, 'Barrage', 'Hypnosis', 'Reflect', 'Leech Seed', 0),
(103, 'Exeggutor', 95, 125, 85, 65, 95, 55, NULL, NULL, 'Grass', 'Psychic', 212, 103, 'Poison Powder', 'Solar Beam', 'Sleep Powder', 'Stomp', 0),
(104, 'Cubone', 50, 40, 95, 50, 50, 35, NULL, NULL, 'Ground', NULL, 87, 104, 'Bone Club', 'Growl', 'Leer', 'Focus Energy', 0),
(105, 'Marowak', 80, 50, 110, 80, 60, 45, NULL, NULL, 'Ground', NULL, 124, 105, 'Focus Energy', 'Thrash', 'Bonemerang', 'Rage', 0),
(106, 'Hitmonlee', 120, 35, 53, 110, 50, 87, NULL, NULL, 'Fighting', NULL, 139, 106, 'Jump Kick', 'Focus Energy', 'Hi Jump Kick', 'Mega Kick', 0),
(107, 'Hitmonchan', 105, 35, 79, 110, 50, 76, NULL, NULL, 'Fighting', NULL, 140, 107, 'Ice Punch', 'Thunder Punch', 'Mega Punch', 'Counter', 0),
(108, 'Lickitung', 55, 60, 75, 75, 90, 30, NULL, NULL, 'Normal', NULL, 127, 108, 'Disable', 'Defense Curl', 'Slam', 'Screech', 0),
(109, 'Koffing', 65, 60, 95, 45, 40, 35, NULL, NULL, 'Poison', NULL, 114, 109, 'Tackle', 'Smog', 'Sludge', 'Smoke Screen', 0),
(110, 'Weezing', 90, 85, 120, 70, 65, 60, NULL, NULL, 'Poison', NULL, 173, 110, 'Smoke Screen', 'Self Destruct', 'Haze', 'Explosion', 0),
(111, 'Rhyhorn', 85, 30, 95, 30, 80, 25, NULL, NULL, 'Ground', 'Rock', 135, 111, 'Horn Attack', 'Stomp', 'Tail Whip', 'Fury Attack', 0),
(112, 'Rhydon', 130, 45, 120, 45, 105, 40, NULL, NULL, 'Ground', 'Rock', 204, 112, 'Fury Attack', 'Horn Drill', 'Leer', 'Take Down', 0),
(113, 'Chansey', 5, 35, 5, 105, 250, 50, NULL, NULL, 'Normal', NULL, 255, 113, 'Splash', 'Splash', 'Splash', 'Splash', 0),
(114, 'Tangela', 55, 100, 115, 40, 65, 60, NULL, NULL, 'Grass', NULL, 166, 114, 'Stun Spore', 'Sleep Powder', 'Slam', 'Growth', 0),
(115, 'Kangaskhan', 95, 40, 80, 80, 105, 90, NULL, NULL, 'Normal', NULL, 175, 115, 'Tail Whip', 'Mega Punch', 'Leer', 'Dizzy Punch', 0),
(116, 'Horsea', 40, 70, 70, 25, 30, 60, NULL, NULL, 'Water', NULL, 83, 116, 'Bubble', 'Smoke Screen', 'Leer', 'Water Gun', 0),
(117, 'Seadra', 65, 95, 95, 45, 55, 85, NULL, NULL, 'Water', NULL, 155, 117, 'Leer', 'Water Gun', 'Agility', 'Hydro Pump', 0),
(118, 'Goldeen', 67, 35, 60, 50, 45, 63, NULL, NULL, 'Water', NULL, 111, 118, 'Peck', 'Tail Whip', 'Supersonic', 'Horn Attack', 0),
(119, 'Seaking', 92, 65, 65, 80, 80, 68, NULL, NULL, 'Water', NULL, 170, 119, 'Fury Attack', 'Waterfall', 'Horn Drill', 'Agility', 0),
(120, 'Staryu', 45, 70, 55, 55, 30, 85, NULL, NULL, 'Water', NULL, 106, 120, 'Tackle', 'Water Gun', 'Harden', 'Recover', 0),
(121, 'Starmie', 75, 100, 85, 85, 60, 115, NULL, NULL, 'Water', 'Psychic', 207, 121, 'Swift', 'Minimize', 'Light Screen', 'Hydro Pump', 0),
(122, 'Mr. Mime', 45, 100, 65, 120, 40, 90, NULL, NULL, 'Psychic', NULL, 136, 122, 'Light Screen', 'Doubleslap', 'Meditate', 'Substitute', 0),
(123, 'Scyther', 110, 55, 80, 80, 70, 105, NULL, NULL, 'Bug', 'Flying', 187, 123, 'Double Team', 'Slash', 'Swords Dance', 'Agility', 0),
(124, 'Jynx', 50, 115, 35, 95, 65, 95, NULL, NULL, 'Ice', 'Psychic', 137, 124, 'Doubleslap', 'Ice Punch', 'Meditate', 'Blizzard', 0),
(125, 'Electabuzz', 83, 95, 57, 85, 65, 105, NULL, NULL, 'Electric', NULL, 156, 125, 'Screech', 'Thunder Punch', 'Light Screen', 'Thunder', 0),
(126, 'Magmar', 95, 100, 57, 85, 65, 93, NULL, NULL, 'Fire', NULL, 167, 126, 'Fire Punch', 'Smoke Screen', 'Smog', 'Flamethrower', 0),
(127, 'Pinsir', 125, 55, 100, 70, 65, 85, NULL, NULL, 'Bug', NULL, 200, 127, 'Focus Energy', 'Harden', 'Slash', 'Swords Dance', 0),
(128, 'Tauros', 100, 40, 95, 70, 75, 110, NULL, NULL, 'Normal', NULL, 211, 128, 'Tail Whip', 'Leer', 'Rage', 'Take Down', 0),
(129, 'Magikarp', 10, 15, 55, 20, 20, 80, 'Gyarados', 20, 'Water', NULL, 20, 129, 'Tackle', 'Splash', 'Splash', 'Splash', 0),
(130, 'Gyarados', 125, 60, 79, 100, 95, 81, NULL, NULL, 'Water', 'Flying', 214, 130, 'Dragon Rage', 'Leer', 'Hydro Pump', 'Hyper Beam', 0),
(131, 'Lapras', 85, 85, 80, 95, 130, 60, NULL, NULL, 'Water', 'Ice', 219, 131, 'Body Slam', 'Confuse Ray', 'Ice Beam', 'Hydro Pump', 0),
(132, 'Ditto', 48, 48, 48, 48, 48, 48, NULL, NULL, 'Normal', NULL, 61, 132, 'Transform', 'Transform', 'Transform', 'Transform', 0),
(133, 'Eevee', 55, 45, 50, 65, 55, 55, NULL, NULL, 'Normal', NULL, 92, 133, 'Quick Attack', 'Tail Whip', 'Bite', 'Take Down', 0),
(134, 'Vaporeon', 65, 110, 60, 95, 130, 65, NULL, NULL, 'Water', NULL, 196, 134, 'Acid Armor', 'Haze', 'Mist', 'Hydro Pump', 0),
(135, 'Jolteon', 65, 110, 60, 95, 65, 130, NULL, NULL, 'Electric', NULL, 197, 135, 'Double Kick', 'Agility', 'Pin Missile', 'Thunder', 0),
(136, 'Flareon', 130, 95, 60, 110, 65, 65, NULL, NULL, 'Fire', NULL, 198, 136, 'Leer', 'Fire Spin', 'Rage', 'Flamethrower', 0),
(137, 'Porygon', 60, 85, 70, 75, 65, 40, NULL, NULL, 'Normal', NULL, 130, 137, 'Psybeam', 'Recover', 'Agility', 'Tri Attack', 0),
(138, 'Omanyte', 40, 90, 100, 55, 35, 35, NULL, NULL, 'Rock', 'Water', 99, 138, 'Water Gun', 'Withdraw', 'Horn Attack', 'Leer', 0),
(139, 'Omastar', 60, 115, 125, 70, 70, 55, NULL, NULL, 'Rock', 'Water', 199, 139, 'Horn Attack', 'Leer', 'Spike Cannon', 'Hydro Pump', 0),
(140, 'Kabuto', 80, 55, 90, 45, 30, 55, NULL, NULL, 'Rock', 'Water', 99, 140, 'Scratch', 'Harden', 'Absorb', 'Slash', 0),
(141, 'Kabutops', 115, 65, 105, 70, 60, 80, NULL, NULL, 'Rock', 'Water', 199, 141, 'Absorb', 'Slash', 'Leer', 'Hydro Pump', 0),
(142, 'Aerodactyl', 105, 60, 65, 75, 80, 130, NULL, NULL, 'Rock', 'Flying', 202, 142, 'Supersonic', 'Bite', 'Take Down', 'Hyper Beam', 0),
(143, 'Snorlax', 110, 65, 65, 110, 160, 30, NULL, NULL, 'Normal', NULL, 154, 143, 'Body Slam', 'Harden', 'Double Edge', 'Hyper Beam', 0),
(144, 'Articuno', 85, 95, 100, 125, 90, 85, NULL, NULL, 'Ice', 'Flying', 215, 144, 'Ice Beam', 'Blizzard', 'Agility', 'Mist', 0),
(145, 'Zapdos', 90, 125, 85, 90, 90, 100, NULL, NULL, 'Electric', 'Flying', 216, 145, 'Drill Peck', 'Thunder', 'Agility', 'Light Screen', 0),
(146, 'Moltres', 100, 125, 90, 85, 90, 90, 'NULL', 0, 'Fire', 'Flying', 217, 146, 'Fire Spin', 'Leer', 'Agility', 'Sky Attack', 0),
(147, 'Dratini', 64, 50, 45, 50, 41, 50, NULL, NULL, 'Dragon', NULL, 67, 147, 'Wrap', 'Leer', 'Thunder Wave', 'Agility', 0),
(148, 'Dragonair', 84, 70, 65, 70, 61, 70, NULL, NULL, 'Dragon', NULL, 144, 148, 'Agility', 'Slam', 'Dragon Rage', 'Hyper Beam', 0),
(149, 'Dragonite', 134, 100, 95, 100, 91, 80, NULL, NULL, 'Dragon', 'Flying', 218, 149, 'Agility', 'Slam', 'Dragon Rage', 'Hyper Beam', 0),
(150, 'Mewtwo', 110, 154, 90, 90, 106, 130, NULL, NULL, 'Psychic', NULL, 220, 150, 'Psychic', 'Recover', 'Mist', 'Amnesia', 0),
(151, 'Mew', 100, 100, 100, 100, 100, 100, NULL, NULL, 'Psychic', NULL, 64, 151, 'Transform', 'Mega Punch', 'Metronome', 'Psychic', 0),
(152, 'Chikorita', 49, 49, 65, 65, 45, 45, NULL, NULL, 'Grass', NULL, 64, 152, 'Scratch', 'Growl', 'Absorb', 'Tackle', 0),
(153, 'Bayleef', 62, 63, 80, 80, 60, 60, NULL, NULL, 'Grass', NULL, 141, 153, 'Razor Leaf', 'Mega Drain', 'Body Slam', 'Tackle', 0),
(154, 'Meganium', 82, 83, 100, 100, 80, 80, NULL, NULL, 'Grass', NULL, 208, 154, 'Petal Dance', 'Razor Leaf', 'Razor Leaf', 'Solar Beam', 0),
(155, 'Cyndaquil', 52, 60, 43, 50, 39, 65, NULL, NULL, 'Fire', NULL, 65, 155, 'Fire Spin', 'Ember', 'Flamethrower', 'Fire Blast', 0),
(156, 'Quilava', 64, 80, 58, 65, 58, 80, NULL, NULL, 'Fire', NULL, 142, 156, 'Fire Spin', 'Ember', 'Fire Spin', 'Flamethrower', 0),
(157, 'Typhlosion', 84, 109, 78, 85, 78, 100, NULL, NULL, 'Fire', NULL, 209, 157, 'Flamethrower', 'Fire Blast', 'Fire Punch', 'Fire Blast', 0),
(158, 'Totodile', 65, 44, 64, 48, 50, 43, NULL, NULL, 'Water', NULL, 66, 158, 'Surf', 'Surf', 'Hydro Pump', 'Bubblebeam', 0),
(159, 'Croconaw', 80, 59, 80, 63, 65, 58, NULL, NULL, 'Water', NULL, 143, 159, 'Waterfall', 'Bubble', 'Clamp', 'Water Gun', 0),
(160, 'Feraligatr', 105, 79, 100, 83, 85, 78, NULL, NULL, 'Water', NULL, 210, 160, 'Crab Hammer', 'Crab Hammer', 'Hydro Pump', 'Crab Hammer', 0),
(161, 'Sentret', 46, 35, 34, 45, 35, 20, NULL, NULL, 'Normal', NULL, 57, 161, 'Horn Attack', 'Pay Day', 'Struggle', 'Tackle', 0),
(162, 'Furret', 76, 45, 64, 55, 85, 90, NULL, NULL, 'Normal', NULL, 116, 162, 'Quick Attack', 'Tri Attack', 'Comet Punch', 'Head Butt', 0),
(163, 'Hoothoot', 30, 36, 30, 56, 60, 50, NULL, NULL, 'Normal', 'Flying', 58, 163, 'Slam', 'Comet Punch', 'Gust', 'Peck', 0),
(164, 'Noctowl', 50, 76, 50, 96, 100, 70, NULL, NULL, 'Normal', 'Flying', 162, 164, 'Stomp', 'Hyper Fang', 'Gust', 'Sky Attack', 0),
(165, 'Ledyba', 20, 40, 30, 80, 40, 55, NULL, NULL, 'Bug', 'Flying', 54, 165, 'Pin Missile', 'Twineedle', 'Fly', 'Wing Attack', 0),
(166, 'Ledian', 35, 55, 50, 110, 55, 85, NULL, NULL, 'Bug', 'Flying', 134, 166, 'Pin Missile', 'Twineedle', 'Peck', 'Wing Attack', 0),
(167, 'Spinarak', 60, 40, 40, 40, 40, 30, NULL, NULL, 'Bug', 'Poison', 54, 167, 'Leech Life', 'Pin Missile', 'Smog', 'Acid', 0),
(168, 'Ariados', 90, 60, 70, 60, 70, 40, NULL, NULL, 'Bug', 'Poison', 134, 168, 'Leech Life', 'Twineedle', 'Smog', 'Smog', 0),
(169, 'Crobat', 90, 70, 80, 80, 85, 130, NULL, NULL, 'Poison', 'Flying', 204, 169, 'Sludge', 'Sludge', 'Peck', 'Gust', 0),
(170, 'Chinchou', 38, 56, 38, 56, 75, 67, NULL, NULL, 'Water', 'Electric', 90, 170, 'Surf', 'Bubblebeam', 'Thundershock', 'Thunderbolt', 0),
(171, 'Lanturn', 58, 76, 58, 76, 125, 67, NULL, NULL, 'Water', 'Electric', 156, 171, 'Hydro Pump', 'Hydro Pump', 'Thunder', 'Thunderbolt', 0),
(172, 'Pichu', 40, 35, 15, 35, 20, 60, NULL, NULL, 'Electric', NULL, 42, 172, 'Thunderbolt', 'Thunder Punch', 'Thunderbolt', 'Thunder', 0),
(173, 'Cleffa', 25, 45, 28, 55, 50, 15, NULL, NULL, 'Normal', NULL, 37, 173, 'Doubleslap', 'Razor Wind', 'Horn Attack', 'Pound', 0),
(174, 'Igglybuff', 30, 40, 15, 20, 90, 15, NULL, NULL, 'Normal', NULL, 39, 174, 'Doubleslap', 'Strength', 'Egg Bomb', 'Take Down', 0),
(175, 'Togepi', 20, 40, 65, 65, 35, 20, NULL, NULL, 'Normal', NULL, 74, 175, 'Hyper Fang', 'Strength', 'Strength', 'Fury Attack', 0),
(176, 'Togetic', 40, 80, 85, 105, 55, 40, NULL, NULL, 'Normal', 'Flying', 114, 176, 'Wrap', 'Dizzy Punch', 'Wing Attack', 'Wing Attack', 0),
(177, 'Natu', 50, 70, 45, 45, 40, 70, NULL, NULL, 'Psychic', 'Flying', 73, 177, 'Confusion', 'Psybeam', 'Wing Attack', 'Drill Peck', 0),
(178, 'Xatu', 75, 95, 70, 70, 65, 95, NULL, NULL, 'Psychic', 'Flying', 171, 178, 'Psychic', 'Dream Eater', 'Wing Attack', 'Drill Peck', 0),
(179, 'Mareep', 40, 65, 40, 45, 55, 35, NULL, NULL, 'Electric', NULL, 59, 179, 'Thunder Punch', 'Thunderbolt', 'Thundershock', 'Thunder', 0),
(180, 'Flaaffy', 55, 80, 55, 60, 70, 45, NULL, NULL, 'Electric', NULL, 117, 180, 'Thundershock', 'Thunder', 'Thunder Punch', 'Thunder', 0),
(181, 'Ampharos', 75, 115, 75, 90, 90, 55, NULL, NULL, 'Electric', NULL, 194, 181, 'Thundershock', 'Thundershock', 'Thundershock', 'Thunder', 0),
(182, 'Bellossom', 80, 90, 85, 100, 75, 50, NULL, NULL, 'Grass', NULL, 184, 182, 'Absorb', 'Mega Drain', 'Mega Drain', 'Razor Leaf', 0),
(183, 'Marill', 20, 20, 50, 50, 70, 40, NULL, NULL, 'Water', NULL, 58, 183, 'Bubblebeam', 'Bubble', 'Bubble', 'Clamp', 0),
(184, 'Azumarill', 50, 50, 80, 80, 100, 50, NULL, NULL, 'Water', NULL, 153, 184, 'Crab Hammer', 'Clamp', 'Crab Hammer', 'Crab Hammer', 0),
(185, 'Sudowoodo', 100, 30, 115, 65, 70, 30, NULL, NULL, 'Rock', NULL, 135, 185, 'Rock Slide', 'Rock Slide', 'Rock Slide', 'Rock Throw', 0),
(186, 'Politoed', 75, 90, 75, 100, 90, 70, NULL, NULL, 'Water', NULL, 185, 186, 'Bubblebeam', 'Water Gun', 'Crab Hammer', 'Water Gun', 0),
(187, 'Hoppip', 35, 35, 40, 55, 35, 50, NULL, NULL, 'Grass', 'Flying', 74, 187, 'Petal Dance', 'Vine Whip', 'Peck', 'Peck', 0),
(188, 'Skiploom', 45, 45, 50, 65, 55, 80, NULL, NULL, 'Grass', 'Flying', 136, 188, 'Solar Beam', 'Razor Leaf', 'Drill Peck', 'Fly', 0),
(189, 'Jumpluff', 55, 55, 70, 85, 75, 110, NULL, NULL, 'Grass', 'Flying', 176, 189, 'Mega Drain', 'Razor Leaf', 'Fly', 'Fly', 0),
(190, 'Aipom', 70, 40, 55, 55, 55, 85, NULL, NULL, 'Normal', NULL, 94, 190, 'Scratch', 'Self Destruct', 'Head Butt', 'Comet Punch', 0),
(191, 'Sunkern', 30, 30, 30, 30, 30, 30, NULL, NULL, 'Grass', NULL, 52, 191, 'Razor Leaf', 'Razor Leaf', 'Petal Dance', 'Solar Beam', 0),
(192, 'Sunflora', 75, 105, 55, 85, 75, 30, NULL, NULL, 'Grass', NULL, 146, 192, 'Vine Whip', 'Mega Drain', 'Razor Leaf', 'Petal Dance', 0),
(193, 'Yanma', 65, 75, 45, 45, 65, 95, NULL, NULL, 'Bug', 'Flying', 147, 193, 'Twineedle', 'Pin Missile', 'Peck', 'Sky Attack', 0),
(194, 'Wooper', 45, 25, 45, 25, 55, 15, NULL, NULL, 'Water', 'Ground', 52, 194, 'Water Gun', 'Water Gun', 'Earthquake', 'Bone Club', 0),
(195, 'Quagsire', 85, 65, 85, 65, 95, 35, NULL, NULL, 'Water', 'Ground', 137, 195, 'Waterfall', 'Waterfall', 'Dig', 'Bone Club', 0),
(196, 'Espeon', 65, 130, 60, 95, 65, 110, NULL, NULL, 'Psychic', NULL, 197, 196, 'Psychic', 'Psybeam', 'Psybeam', 'Confusion', 0),
(197, 'Umbreon', 65, 60, 110, 130, 95, 65, NULL, NULL, 'Dark', NULL, 197, 197, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(198, 'Murkrow', 85, 85, 42, 42, 60, 91, NULL, NULL, 'Dark', 'Flying', 107, 198, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(199, 'Slowking', 75, 100, 80, 110, 95, 30, NULL, NULL, 'Water', 'Psychic', 164, 199, 'Hydro Pump', 'Bubblebeam', 'Psychic', 'Psychic', 0),
(200, 'Misdreavus', 60, 85, 60, 85, 60, 85, NULL, NULL, 'Ghost', NULL, 147, 200, 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet', 0),
(202, 'Wobbuffet', 33, 33, 58, 58, 190, 33, NULL, NULL, 'Psychic', NULL, 177, 202, 'Psybeam', 'Psychic', 'Confusion', 'Dream Eater', 0),
(203, 'Girafarig', 80, 90, 65, 65, 70, 85, NULL, NULL, 'Normal', 'Psychic', 149, 203, 'Hyper Fang', 'Mega Punch', 'Confusion', 'Psybeam', 0),
(204, 'Pineco', 65, 35, 90, 35, 50, 15, NULL, NULL, 'Bug', NULL, 60, 204, 'Leech Life', 'Leech Life', 'Twineedle', 'Leech Life', 0),
(205, 'Forretress', 90, 60, 140, 60, 75, 40, NULL, NULL, 'Bug', 'Steel', 118, 205, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(206, 'Dunsparce', 70, 65, 70, 65, 100, 45, NULL, NULL, 'Normal', NULL, 125, 206, 'Razor Wind', 'Bite', 'Constrict', 'Wrap', 0),
(207, 'Gligar', 75, 35, 105, 65, 65, 85, NULL, NULL, 'Ground', 'Flying', 108, 207, 'Earthquake', 'Dig', 'Drill Peck', 'Drill Peck', 0),
(208, 'Steelix', 85, 55, 200, 65, 75, 30, NULL, NULL, 'Steel', 'Ground', 196, 208, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(209, 'Snubbull', 80, 40, 50, 40, 60, 30, NULL, NULL, 'Normal', NULL, 63, 209, 'Body Slam', 'Thrash', 'Head Butt', 'Skull Bash', 0),
(210, 'Granbull', 120, 60, 75, 60, 90, 45, NULL, NULL, 'Normal', NULL, 178, 210, 'Rage', 'Tackle', 'Swift', 'Pound', 0),
(211, 'Qwilfish', 95, 55, 75, 55, 65, 85, NULL, NULL, 'Water', 'Poison', 100, 211, 'Surf', 'Clamp', 'Poison Sting', 'Smog', 0),
(212, 'Scizor', 130, 55, 100, 80, 70, 65, NULL, NULL, 'Bug', 'Steel', 200, 212, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(213, 'Shuckle', 10, 10, 230, 230, 20, 5, NULL, NULL, 'Bug', 'Rock', 80, 213, 'Pin Missile', 'Pin Missile', 'Rock Throw', 'Rock Slide', 0),
(214, 'Heracross', 125, 40, 75, 95, 80, 85, NULL, NULL, 'Bug', 'Fighting', 200, 214, 'Twineedle', 'Twineedle', 'Karate Chop', 'Submission', 0),
(215, 'Sneasel', 95, 35, 55, 75, 55, 115, NULL, NULL, 'Dark', 'Ice', 132, 215, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(216, 'Teddiursa', 80, 50, 50, 50, 60, 40, NULL, NULL, 'Normal', NULL, 124, 216, 'Barrage', 'Doubleslap', 'Vice Grip', 'Pay Day', 0),
(217, 'Ursaring', 130, 75, 75, 75, 90, 55, NULL, NULL, 'Normal', NULL, 189, 217, 'Take Down', 'Tackle', 'Thrash', 'Rage', 0),
(218, 'Slugma', 40, 70, 40, 40, 40, 20, NULL, NULL, 'Fire', NULL, 78, 218, 'Ember', 'Fire Spin', 'Fire Spin', 'Flamethrower', 0),
(219, 'Magcargo', 50, 80, 120, 80, 50, 30, NULL, NULL, 'Fire', 'Rock', 154, 219, 'Ember', 'Ember', 'Rock Slide', 'Rock Throw', 0),
(220, 'Swinub', 50, 30, 40, 30, 50, 50, NULL, NULL, 'Ice', 'Ground', 78, 220, 'Ice Punch', 'Ice Beam', 'Dig', 'Bone Club', 0),
(221, 'Piloswine', 100, 60, 80, 60, 100, 50, NULL, NULL, 'Ice', 'Ground', 160, 221, 'Blizzard', 'Aurora Beam', 'Dig', 'Bone Club', 0),
(222, 'Corsola', 55, 65, 85, 85, 55, 35, NULL, NULL, 'Water', 'Rock', 113, 222, 'Bubble', 'Bubblebeam', 'Rock Slide', 'Rock Slide', 0),
(223, 'Remoraid', 65, 65, 35, 35, 35, 65, NULL, NULL, 'Water', NULL, 78, 223, 'Water Gun', 'Bubblebeam', 'Water Gun', 'Bubblebeam', 0),
(224, 'Octillery', 105, 105, 75, 75, 75, 45, NULL, NULL, 'Water', NULL, 164, 224, 'Hydro Pump', 'Hydro Pump', 'Water Gun', 'Surf', 0),
(225, 'Delibird', 55, 65, 45, 45, 45, 75, NULL, NULL, 'Ice', 'Flying', 183, 225, 'Blizzard', 'Ice Punch', 'Gust', 'Wing Attack', 0),
(226, 'Mantine', 40, 80, 70, 140, 65, 70, NULL, NULL, 'Water', 'Flying', 168, 226, 'Bubble', 'Bubble', 'Peck', 'Wing Attack', 0),
(227, 'Skarmory', 80, 40, 140, 70, 65, 70, NULL, NULL, 'Steel', 'Flying', 168, 227, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(228, 'Houndour', 60, 80, 30, 50, 45, 65, NULL, NULL, 'Dark', 'Fire', 114, 228, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(229, 'Houndoom', 90, 110, 50, 80, 75, 95, NULL, NULL, 'Dark', 'Fire', 204, 229, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(230, 'Kingdra', 95, 95, 95, 95, 75, 85, NULL, NULL, 'Water', 'Dragon', 207, 230, 'Waterfall', 'Surf', 'Dragon Rage', 'Dragon Rage', 0),
(231, 'Phanpy', 60, 40, 60, 40, 90, 40, NULL, NULL, 'Ground', NULL, 124, 231, 'Earthquake', 'Bone Club', 'Bonemerang', 'Earthquake', 0),
(232, 'Donphan', 120, 60, 120, 60, 90, 50, NULL, NULL, 'Ground', NULL, 189, 232, 'Earthquake', 'Earthquake', 'Bone Club', 'Bone Club', 0),
(233, 'Porygon2', 80, 105, 90, 95, 85, 60, NULL, NULL, 'Normal', NULL, 180, 233, 'Mega Punch', 'Bind', 'Hyper Fang', 'Fury Swipes', 0),
(234, 'Stantler', 95, 85, 62, 65, 73, 85, NULL, NULL, 'Normal', NULL, 165, 234, 'Head Butt', 'Mega Punch', 'Slash', 'Tri Attack', 0),
(235, 'Smeargle', 20, 20, 35, 45, 55, 75, NULL, NULL, 'Normal', NULL, 106, 235, 'Doubleslap', 'Stomp', 'Strength', 'Doubleslap', 0),
(236, 'Tyrogue', 35, 35, 35, 35, 35, 35, NULL, NULL, 'Fighting', NULL, 91, 236, 'Karate Chop', 'Rolling Kick', 'Karate Chop', 'Rolling Kick', 0),
(237, 'Hitmontop', 95, 35, 95, 110, 50, 70, NULL, NULL, 'Fighting', NULL, 138, 237, 'Karate Chop', 'Jump Kick', 'Double Kick', 'Double Kick', 0),
(238, 'Smoochum', 30, 85, 15, 65, 45, 65, NULL, NULL, 'Ice', 'Psychic', 87, 238, 'Ice Punch', 'Ice Punch', 'Dream Eater', 'Psybeam', 0),
(239, 'Elekid', 63, 65, 37, 55, 45, 95, NULL, NULL, 'Electric', NULL, 106, 239, 'Thundershock', 'Thunder', 'Thunderbolt', 'Thunder Punch', 0),
(240, 'Magby', 75, 70, 37, 55, 45, 83, NULL, NULL, 'Fire', NULL, 117, 240, 'Flamethrower', 'Fire Blast', 'Fire Spin', 'Fire Punch', 0),
(241, 'Miltank', 80, 40, 105, 70, 95, 100, NULL, NULL, 'Normal', NULL, 200, 241, 'Slash', 'Comet Punch', 'Strength', 'Double Edge', 0),
(242, 'Blissey', 120, 120, 150, 135, 255, 55, NULL, NULL, 'Normal', NULL, 255, 242, 'Blizzard', 'Splash', 'Splash', 'Splash', 0),
(243, 'Raikou', 85, 115, 75, 100, 90, 115, NULL, NULL, 'Electric', NULL, 216, 243, 'Thunder', 'Thunderbolt', 'Thundershock', 'Thunder Punch', 0),
(244, 'Entei', 115, 90, 85, 75, 115, 100, NULL, NULL, 'Fire', NULL, 217, 244, 'Fire Spin', 'Flamethrower', 'Ember', 'Fire Punch', 0),
(245, 'Suicune', 75, 90, 115, 115, 100, 85, NULL, NULL, 'Water', NULL, 215, 245, 'Surf', 'Waterfall', 'Water Gun', 'Bubble', 0),
(246, 'Larvitar', 64, 45, 50, 50, 50, 41, 'Pupitar', 30, 'Rock', 'Ground', 67, 246, 'Rock Throw', 'Rock Throw', 'Dig', 'Bone Club', 0),
(247, 'Pupitar', 84, 65, 70, 70, 70, 51, 'Tyranitar', 55, 'Rock', 'Ground', 144, 247, 'Rock Slide', 'Rock Throw', 'Dig', 'Bone Club', 0),
(248, 'Tyranitar', 134, 95, 110, 100, 100, 61, NULL, NULL, 'Rock', 'Dark', 218, 248, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(249, 'Lugia', 90, 90, 130, 154, 106, 110, NULL, NULL, 'Psychic', 'Flying', 220, 249, 'Dream Eater', 'Psychic', 'Drill Peck', 'Drill Peck', 0),
(250, 'Ho-oh', 130, 110, 90, 154, 106, 90, NULL, NULL, 'Fire', 'Flying', 220, 250, 'Ember', 'Fire Blast', 'Drill Peck', 'Sky Attack', 0),
(251, 'Celebi', 100, 100, 100, 100, 100, 100, NULL, NULL, 'Psychic', 'Grass', 64, 251, 'Psybeam', 'Psybeam', 'Solar Beam', 'Razor Leaf', 0),
(252, 'Treecko', 45, 65, 35, 55, 40, 70, NULL, NULL, 'Grass', NULL, 65, 252, 'Solar Beam', 'Petal Dance', 'Petal Dance', 'Mega Drain', 0),
(253, 'Grovyle', 65, 85, 45, 65, 50, 95, NULL, NULL, 'Grass', NULL, 141, 253, 'Solar Beam', 'Razor Leaf', 'Razor Leaf', 'Vine Whip', 0),
(254, 'Sceptile', 85, 105, 65, 85, 70, 120, NULL, NULL, 'Grass', NULL, 208, 254, 'Solar Beam', 'Razor Leaf', 'Solar Beam', 'Absorb', 0),
(255, 'Torchic', 60, 70, 40, 50, 45, 45, NULL, NULL, 'Fire', NULL, 65, 255, 'Fire Spin', 'Fire Blast', 'Fire Punch', 'Fire Spin', 0),
(256, 'Combusken', 85, 85, 60, 60, 60, 55, NULL, NULL, 'Fire', 'Fighting', 142, 256, 'Fire Punch', 'Fire Punch', 'Submission', 'Rolling Kick', 0),
(257, 'Blaziken', 120, 110, 70, 70, 80, 80, NULL, NULL, 'Fire', 'Fighting', 209, 257, 'Fire Spin', 'Fire Punch', 'Karate Chop', 'Submission', 0),
(258, 'Mudkip', 70, 50, 50, 50, 50, 40, NULL, NULL, 'Water', NULL, 65, 258, 'Bubblebeam', 'Bubblebeam', 'Hydro Pump', 'Hydro Pump', 0),
(259, 'Marshtomp', 85, 60, 70, 70, 70, 50, NULL, NULL, 'Water', 'Ground', 143, 259, 'Waterfall', 'Bubble', 'Bone Club', 'Earthquake', 0),
(260, 'Swampert', 110, 85, 90, 90, 100, 60, NULL, NULL, 'Water', 'Ground', 210, 260, 'Bubble', 'Hydro Pump', 'Earthquake', 'Bone Club', 0),
(261, 'Poochyena', 55, 30, 35, 30, 35, 35, NULL, NULL, 'Dark', NULL, 55, 261, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(262, 'Mightyena', 90, 60, 70, 60, 70, 70, NULL, NULL, 'Dark', NULL, 128, 262, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(263, 'Zigzagoon', 30, 30, 41, 41, 38, 60, NULL, NULL, 'Normal', NULL, 60, 263, 'Constrict', 'Dizzy Punch', 'Slash', 'Razor Wind', 0),
(264, 'Linoone', 70, 50, 61, 61, 78, 100, NULL, NULL, 'Normal', NULL, 128, 264, 'Vice Grip', 'Hyper Fang', 'Mega Kick', 'Explosion', 0),
(265, 'Wurmple', 45, 20, 35, 30, 45, 20, NULL, NULL, 'Bug', NULL, 54, 265, 'Leech Life', 'Leech Life', 'Twineedle', 'Twineedle', 0),
(266, 'Silcoon', 35, 25, 55, 25, 50, 15, NULL, NULL, 'Bug', NULL, 72, 266, 'Leech Life', 'Leech Life', 'Pin Missile', 'Twineedle', 0),
(267, 'Beautifly', 70, 90, 50, 50, 60, 65, NULL, NULL, 'Bug', 'Flying', 161, 267, 'Twineedle', 'Twineedle', 'Drill Peck', 'Gust', 0),
(268, 'Cascoon', 35, 25, 55, 25, 50, 15, NULL, NULL, 'Bug', NULL, 72, 268, 'Twineedle', 'Twineedle', 'Pin Missile', 'Leech Life', 0),
(269, 'Dustox', 50, 50, 70, 90, 60, 65, NULL, NULL, 'Bug', 'Poison', 161, 269, 'Leech Life', 'Twineedle', 'Poison Sting', 'Sludge', 0),
(270, 'Lotad', 30, 40, 30, 50, 40, 30, NULL, NULL, 'Water', 'Grass', 74, 270, 'Clamp', 'Bubble', 'Mega Drain', 'Absorb', 0),
(271, 'Lombre', 50, 60, 50, 70, 60, 50, NULL, NULL, 'Water', 'Grass', 141, 271, 'Bubble', 'Surf', 'Solar Beam', 'Petal Dance', 0),
(272, 'Ludicolo', 70, 90, 70, 100, 80, 70, NULL, NULL, 'Water', 'Grass', 181, 272, 'Water Gun', 'Waterfall', 'Petal Dance', 'Absorb', 0),
(273, 'Seedot', 40, 30, 50, 30, 40, 30, NULL, NULL, 'Grass', NULL, 74, 273, 'Mega Drain', 'Mega Drain', 'Absorb', 'Razor Leaf', 0),
(274, 'Nuzleaf', 70, 60, 40, 40, 70, 60, NULL, NULL, 'Grass', 'Dark', 141, 274, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(275, 'Shiftry', 100, 90, 60, 60, 90, 80, NULL, NULL, 'Grass', 'Dark', 181, 275, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(276, 'Taillow', 55, 30, 30, 30, 40, 85, NULL, NULL, 'Normal', 'Flying', 59, 276, 'Quick Attack', 'Slam', 'Gust', 'Drill Peck', 0),
(277, 'Swellow', 85, 50, 60, 50, 60, 125, NULL, NULL, 'Normal', 'Flying', 162, 277, 'Cut', 'Fury Attack', 'Wing Attack', 'Drill Peck', 0),
(278, 'Wingull', 30, 55, 30, 30, 40, 85, NULL, NULL, 'Water', 'Flying', 64, 278, 'Crab Hammer', 'Waterfall', 'Drill Peck', 'Fly', 0),
(279, 'Pelipper', 50, 85, 100, 70, 60, 65, NULL, NULL, 'Water', 'Flying', 164, 279, 'Crab Hammer', 'Clamp', 'Wing Attack', 'Sky Attack', 0),
(280, 'Ralts', 25, 45, 25, 35, 28, 40, NULL, NULL, 'Psychic', NULL, 70, 280, 'Dream Eater', 'Psychic', 'Psybeam', 'Psybeam', 0),
(281, 'Kirlia', 35, 65, 35, 55, 38, 50, NULL, NULL, 'Psychic', NULL, 140, 281, 'Dream Eater', 'Confusion', 'Dream Eater', 'Dream Eater', 0),
(282, 'Gardevoir', 65, 125, 65, 115, 68, 80, NULL, NULL, 'Psychic', NULL, 208, 282, 'Dream Eater', 'Dream Eater', 'Confusion', 'Psybeam', 0),
(283, 'Surskit', 30, 50, 32, 52, 40, 65, NULL, NULL, 'Bug', 'Water', 63, 283, 'Pin Missile', 'Twineedle', 'Bubble', 'Waterfall', 0),
(284, 'Masquerain', 60, 80, 62, 82, 70, 60, NULL, NULL, 'Bug', 'Flying', 128, 284, 'Twineedle', 'Leech Life', 'Wing Attack', 'Drill Peck', 0),
(285, 'Shroomish', 40, 40, 60, 60, 60, 35, NULL, NULL, 'Grass', NULL, 65, 285, 'Absorb', 'Vine Whip', 'Vine Whip', 'Absorb', 0),
(286, 'Breloom', 130, 60, 80, 60, 60, 70, NULL, NULL, 'Grass', 'Fighting', 165, 286, 'Petal Dance', 'Petal Dance', 'Double Kick', 'Jump Kick', 0),
(287, 'Slakoth', 60, 35, 60, 35, 60, 30, NULL, NULL, 'Normal', NULL, 83, 287, 'Mega Punch', 'Hyper Beam', 'Take Down', 'Hyper Fang', 0),
(288, 'Vigoroth', 80, 55, 80, 55, 80, 90, NULL, NULL, 'Normal', NULL, 126, 288, 'Egg Bomb', 'Swift', 'Thrash', 'Razor Wind', 0),
(289, 'Slaking', 160, 95, 100, 65, 150, 100, NULL, NULL, 'Normal', NULL, 210, 289, 'Comet Punch', 'Skull Bash', 'Explosion', 'Quick Attack', 0),
(290, 'Nincada', 45, 30, 90, 30, 31, 40, NULL, NULL, 'Bug', 'Ground', 65, 290, 'Leech Life', 'Twineedle', 'Earthquake', 'Earthquake', 0),
(291, 'Ninjask', 90, 50, 45, 50, 61, 160, NULL, NULL, 'Bug', 'Flying', 155, 291, 'Leech Life', 'Pin Missile', 'Fly', 'Drill Peck', 0),
(292, 'Shedinja', 90, 30, 45, 30, 1, 40, NULL, NULL, 'Bug', 'Ghost', 95, 292, 'Twineedle', 'Pin Missile', 'Lick', 'Shadow Armlet', 0),
(293, 'Whismur', 51, 51, 23, 23, 64, 28, NULL, NULL, 'Normal', NULL, 68, 293, 'Bite', 'Pound', 'Pound', 'Strength', 0),
(294, 'Loudred', 71, 71, 43, 43, 84, 48, NULL, NULL, 'Normal', NULL, 126, 294, 'Quick Attack', 'Tackle', 'Stomp', 'Wrap', 0),
(295, 'Exploud', 91, 91, 63, 63, 104, 68, NULL, NULL, 'Normal', NULL, 184, 295, 'Constrict', 'Fury Swipes', 'Head Butt', 'Fury Swipes', 0),
(296, 'Makuhita', 60, 20, 30, 30, 72, 25, NULL, NULL, 'Fighting', NULL, 87, 296, 'Karate Chop', 'Jump Kick', 'Double Kick', 'Double Kick', 0),
(297, 'Hariyama', 120, 40, 60, 60, 144, 50, NULL, NULL, 'Fighting', NULL, 184, 297, 'Rolling Kick', 'Rolling Kick', 'Double Kick', 'Submission', 0),
(298, 'Azurill', 20, 20, 40, 40, 50, 20, NULL, NULL, 'Normal', NULL, 33, 298, 'Tri Attack', 'Body Slam', 'Struggle', 'Tackle', 0),
(299, 'Nosepass', 45, 45, 135, 90, 30, 30, NULL, NULL, 'Rock', NULL, 108, 299, 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Throw', 0),
(300, 'Skitty', 45, 35, 45, 35, 50, 50, NULL, NULL, 'Normal', NULL, 65, 300, 'Constrict', 'Strength', 'Comet Punch', 'Cut', 0),
(301, 'Delcatty', 65, 55, 65, 55, 70, 70, NULL, NULL, 'Normal', NULL, 138, 301, 'Mega Kick', 'Slam', 'Strength', 'Constrict', 0),
(302, 'Sableye', 75, 65, 75, 65, 50, 50, NULL, NULL, 'Dark', 'Ghost', 98, 302, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(303, 'Mawile', 85, 55, 85, 55, 50, 50, NULL, NULL, 'Steel', NULL, 98, 303, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(304, 'Aron', 70, 40, 100, 40, 50, 30, NULL, NULL, 'Steel', 'Rock', 96, 304, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(305, 'Lairon', 90, 50, 140, 50, 60, 40, NULL, NULL, 'Steel', 'Rock', 152, 305, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(306, 'Aggron', 110, 60, 180, 60, 70, 50, NULL, NULL, 'Steel', 'Rock', 205, 306, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(307, 'Meditite', 40, 40, 55, 55, 30, 60, NULL, NULL, 'Fighting', 'Psychic', 91, 307, 'Karate Chop', 'Jump Kick', 'Dream Eater', 'Dream Eater', 0),
(308, 'Medicham', 60, 60, 75, 75, 60, 80, NULL, NULL, 'Fighting', 'Psychic', 153, 308, 'Jump Kick', 'Double Kick', 'Dream Eater', 'Dream Eater', 0),
(309, 'Electrike', 45, 65, 40, 40, 40, 65, NULL, NULL, 'Electric', NULL, 104, 309, 'Thunder', 'Thundershock', 'Thundershock', 'Thunder Punch', 0),
(310, 'Manectric', 75, 105, 60, 60, 70, 105, NULL, NULL, 'Electric', NULL, 168, 310, 'Thunder Punch', 'Thunder Punch', 'Thunder', 'Thundershock', 0),
(311, 'Plusle', 50, 85, 40, 75, 60, 95, NULL, NULL, 'Electric', NULL, 120, 311, 'Thundershock', 'Thundershock', 'Thunder Punch', 'Thunder Punch', 0),
(312, 'Minun', 40, 75, 50, 85, 60, 95, NULL, NULL, 'Electric', NULL, 120, 312, 'Thunderbolt', 'Thundershock', 'Thunder', 'Thunder Punch', 0),
(313, 'Volbeat', 73, 47, 55, 75, 65, 85, NULL, NULL, 'Bug', NULL, 146, 313, 'Leech Life', 'Pin Missile', 'Pin Missile', 'Leech Life', 0),
(314, 'Illumise', 47, 73, 55, 75, 65, 85, NULL, NULL, 'Bug', NULL, 146, 314, 'Pin Missile', 'Twineedle', 'Pin Missile', 'Pin Missile', 0),
(315, 'Roselia', 60, 100, 45, 80, 50, 65, NULL, NULL, 'Grass', 'Poison', 152, 315, 'Solar Beam', 'Solar Beam', 'Acid', 'Acid', 0),
(316, 'Gulpin', 43, 43, 53, 53, 70, 40, NULL, NULL, 'Poison', NULL, 75, 316, 'Poison Sting', 'Acid', 'Sludge', 'Smog', 0),
(317, 'Swalot', 73, 73, 83, 83, 100, 55, NULL, NULL, 'Poison', NULL, 168, 317, 'Smog', 'Poison Sting', 'Sludge', 'Smog', 0),
(318, 'Carvanha', 90, 65, 20, 20, 45, 65, NULL, NULL, 'Water', 'Dark', 88, 318, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(319, 'Sharpedo', 120, 95, 40, 40, 70, 95, NULL, NULL, 'Water', 'Dark', 175, 319, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(320, 'Wailmer', 70, 70, 35, 35, 130, 60, NULL, NULL, 'Water', NULL, 137, 320, 'Water Gun', 'Clamp', 'Bubblebeam', 'Hydro Pump', 0),
(321, 'Wailord', 90, 90, 45, 45, 170, 60, NULL, NULL, 'Water', NULL, 206, 321, 'Bubble', 'Hydro Pump', 'Crab Hammer', 'Bubble', 0),
(322, 'Numel', 60, 65, 40, 45, 60, 35, NULL, NULL, 'Fire', 'Ground', 88, 322, 'Fire Blast', 'Ember', 'Bonemerang', 'Bone Club', 0),
(323, 'Camerupt', 100, 105, 70, 75, 70, 40, NULL, NULL, 'Fire', 'Ground', 175, 323, 'Fire Blast', 'Ember', 'Dig', 'Bone Club', 0),
(324, 'Torkoal', 85, 85, 140, 70, 70, 20, NULL, NULL, 'Fire', NULL, 161, 324, 'Ember', 'Fire Blast', 'Fire Punch', 'Fire Punch', 0),
(325, 'Spoink', 25, 70, 35, 80, 60, 60, NULL, NULL, 'Psychic', NULL, 89, 325, 'Dream Eater', 'Psybeam', 'Psybeam', 'Dream Eater', 0),
(326, 'Grumpig', 45, 90, 65, 110, 80, 80, NULL, NULL, 'Psychic', NULL, 164, 326, 'Dream Eater', 'Psychic', 'Confusion', 'Dream Eater', 0),
(327, 'Spinda', 60, 60, 60, 60, 60, 60, NULL, NULL, 'Normal', NULL, 85, 327, 'Rage', 'Cut', 'Self Destruct', 'Wrap', 0),
(328, 'Trapinch', 100, 45, 45, 45, 45, 10, NULL, NULL, 'Ground', NULL, 73, 328, 'Bonemerang', 'Dig', 'Bonemerang', 'Bone Club', 0),
(329, 'Vibrava', 70, 50, 50, 50, 50, 70, NULL, NULL, 'Ground', 'Dragon', 126, 329, 'Earthquake', 'Bone Club', 'Dragon Rage', 'Dragon Rage', 0),
(330, 'Flygon', 100, 80, 80, 80, 80, 100, NULL, NULL, 'Ground', 'Dragon', 197, 330, 'Bonemerang', 'Bonemerang', 'Dragon Rage', 'Dragon Rage', 0),
(331, 'Cacnea', 85, 85, 40, 40, 50, 35, NULL, NULL, 'Grass', NULL, 97, 331, 'Vine Whip', 'Vine Whip', 'Vine Whip', 'Razor Leaf', 0),
(332, 'Cacturne', 115, 115, 60, 60, 70, 55, NULL, NULL, 'Grass', 'Dark', 177, 332, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(333, 'Swablu', 40, 40, 60, 75, 45, 50, NULL, NULL, 'Normal', 'Flying', 74, 333, 'Quick Attack', 'Constrict', 'Drill Peck', 'Peck', 0),
(334, 'Altaria', 70, 70, 90, 105, 75, 80, NULL, NULL, 'Dragon', 'Flying', 188, 334, 'Dragon Rage', 'Dragon Rage', 'Wing Attack', 'Gust', 0),
(335, 'Zangoose', 115, 60, 60, 60, 73, 90, NULL, NULL, 'Normal', NULL, 165, 335, 'Scratch', 'Spike Cannon', 'Skull Bash', 'Self Destruct', 0),
(336, 'Seviper', 100, 100, 60, 60, 73, 65, NULL, NULL, 'Poison', NULL, 165, 336, 'Acid', 'Sludge', 'Poison Sting', 'Smog', 0),
(337, 'Lunatone', 55, 95, 65, 85, 70, 70, NULL, NULL, 'Rock', 'Psychic', 150, 337, 'Rock Slide', 'Rock Throw', 'Confusion', 'Psychic', 0),
(338, 'SolRock', 95, 55, 85, 65, 70, 70, NULL, NULL, 'Rock', 'Psychic', 150, 338, 'Rock Throw', 'Rock Throw', 'Psychic', 'Confusion', 0),
(339, 'Barboach', 48, 46, 43, 41, 50, 60, NULL, NULL, 'Water', 'Ground', 92, 339, 'Hydro Pump', 'Bubble', 'Earthquake', 'Bonemerang', 0),
(340, 'Whiscash', 78, 76, 73, 71, 110, 60, NULL, NULL, 'Water', 'Ground', 158, 340, 'Bubble', 'Clamp', 'Earthquake', 'Bone Club', 0),
(341, 'Corphish', 80, 50, 65, 35, 43, 35, NULL, NULL, 'Water', NULL, 111, 341, 'Water Gun', 'Surf', 'Bubblebeam', 'Water Gun', 0),
(342, 'Crawdaunt', 120, 90, 85, 55, 63, 55, NULL, NULL, 'Water', 'Dark', 161, 342, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(343, 'Baltoy', 40, 40, 55, 70, 40, 55, NULL, NULL, 'Ground', 'Psychic', 58, 343, 'Bone Club', 'Bone Club', 'Confusion', 'Confusion', 0),
(344, 'Claydol', 70, 70, 105, 120, 60, 75, NULL, NULL, 'Ground', 'Psychic', 189, 344, 'Bonemerang', 'Dig', 'Psychic', 'Dream Eater', 0),
(345, 'Lileep', 41, 61, 77, 87, 66, 23, NULL, NULL, 'Rock', 'Grass', 99, 345, 'Rock Slide', 'Rock Throw', 'Solar Beam', 'Vine Whip', 0),
(346, 'Cradily', 81, 81, 97, 107, 86, 43, NULL, NULL, 'Rock', 'Grass', 199, 346, 'Rock Slide', 'Rock Throw', 'Solar Beam', 'Petal Dance', 0),
(347, 'Anorith', 95, 40, 50, 50, 45, 75, NULL, NULL, 'Rock', 'Bug', 99, 347, 'Rock Throw', 'Rock Throw', 'Pin Missile', 'Twineedle', 0),
(348, 'Armaldo', 125, 70, 100, 80, 75, 45, NULL, NULL, 'Rock', 'Bug', 199, 348, 'Rock Slide', 'Rock Slide', 'Leech Life', 'Twineedle', 0),
(349, 'Feebas', 15, 10, 20, 55, 20, 80, NULL, NULL, 'Water', NULL, 61, 349, 'Waterfall', 'Waterfall', 'Bubble', 'Bubble', 0),
(350, 'Milotic', 60, 100, 79, 125, 95, 81, NULL, NULL, 'Water', NULL, 213, 350, 'Crab Hammer', 'Bubble', 'Bubblebeam', 'Bubblebeam', 0),
(351, 'Castform', 70, 70, 70, 70, 70, 70, NULL, NULL, 'Normal', NULL, 145, 351, 'Comet Punch', 'Explosion', 'Bite', 'Wrap', 0),
(352, 'Kecleon', 90, 60, 70, 120, 60, 40, NULL, NULL, 'Normal', NULL, 132, 352, 'Doubleslap', 'Stomp', 'Thrash', 'Rage', 0),
(353, 'Shuppet', 75, 63, 35, 33, 44, 45, NULL, NULL, 'Ghost', NULL, 97, 353, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(354, 'Banette', 115, 83, 65, 63, 64, 65, NULL, NULL, 'Ghost', NULL, 179, 354, 'Lick', 'Lick', 'Lick', 'Shadow Armlet', 0),
(355, 'Duskull', 40, 30, 90, 90, 20, 25, NULL, NULL, 'Ghost', NULL, 97, 355, 'Lick', 'Lick', 'Shadow Armlet', 'Lick', 0),
(356, 'Dusclops', 70, 60, 130, 130, 40, 25, NULL, NULL, 'Ghost', NULL, 179, 356, 'Lick', 'Lick', 'Lick', 'Shadow Armlet', 0),
(357, 'Tropius', 68, 72, 83, 87, 99, 51, NULL, NULL, 'Grass', 'Flying', 169, 357, 'Vine Whip', 'Petal Dance', 'Fly', 'Fly', 0),
(358, 'Chimecho', 50, 95, 70, 80, 65, 65, NULL, NULL, 'Psychic', NULL, 147, 358, 'Psybeam', 'Confusion', 'Psybeam', 'Psybeam', 0),
(359, 'Absol', 130, 75, 60, 60, 65, 75, NULL, NULL, 'Dark', NULL, 174, 359, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(360, 'Wynaut', 23, 23, 48, 48, 95, 23, NULL, NULL, 'Psychic', NULL, 44, 360, 'Confusion', 'Psychic', 'Dream Eater', 'Psybeam', 0),
(361, 'Snorunt', 50, 50, 50, 50, 50, 50, NULL, NULL, 'Ice', NULL, 74, 361, 'Ice Punch', 'Blizzard', 'Ice Beam', 'Ice Punch', 0),
(362, 'Glalie', 80, 80, 80, 80, 80, 80, NULL, NULL, 'Ice', NULL, 187, 362, 'Aurora Beam', 'Ice Punch', 'Ice Beam', 'Ice Punch', 0),
(363, 'Spheal', 40, 55, 50, 50, 70, 25, NULL, NULL, 'Ice', 'Water', 75, 363, 'Aurora Beam', 'Ice Beam', 'Bubble', 'Bubble', 0),
(364, 'Sealeo', 60, 75, 70, 70, 90, 45, NULL, NULL, 'Ice', 'Water', 128, 364, 'Ice Punch', 'Ice Punch', 'Crab Hammer', 'Water Gun', 0),
(365, 'Walrein', 80, 95, 90, 90, 110, 65, NULL, NULL, 'Ice', 'Water', 192, 365, 'Aurora Beam', 'Ice Punch', 'Waterfall', 'Crab Hammer', 0),
(366, 'Clamperl', 64, 74, 85, 55, 35, 32, NULL, NULL, 'Water', NULL, 142, 366, 'Water Gun', 'Clamp', 'Bubblebeam', 'Bubblebeam', 0),
(367, 'Huntail', 104, 94, 105, 75, 55, 52, NULL, NULL, 'Water', NULL, 178, 367, 'Hydro Pump', 'Crab Hammer', 'Hydro Pump', 'Clamp', 0),
(368, 'Gorebyss', 84, 114, 105, 75, 55, 52, NULL, NULL, 'Water', NULL, 178, 368, 'Hydro Pump', 'Waterfall', 'Bubble', 'Surf', 0),
(369, 'Relicanth', 90, 45, 130, 65, 100, 55, NULL, NULL, 'Water', 'Rock', 198, 369, 'Surf', 'Water Gun', 'Rock Throw', 'Rock Throw', 0),
(370, 'Luvdisc', 30, 40, 55, 65, 43, 97, NULL, NULL, 'Water', NULL, 110, 370, 'Clamp', 'Water Gun', 'Bubblebeam', 'Hydro Pump', 0),
(371, 'Bagon', 75, 40, 60, 30, 45, 50, NULL, NULL, 'Dragon', NULL, 89, 371, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(372, 'Shelgon', 95, 60, 100, 50, 65, 50, NULL, NULL, 'Dragon', NULL, 144, 372, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(373, 'Salamence', 135, 110, 80, 80, 95, 100, NULL, NULL, 'Dragon', 'Flying', 218, 373, 'Dragon Rage', 'Dragon Rage', 'Fly', 'Gust', 0),
(374, 'Beldum', 55, 35, 80, 60, 40, 30, NULL, NULL, 'Steel', 'Psychic', 103, 374, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(375, 'Metang', 75, 55, 100, 80, 60, 50, NULL, NULL, 'Steel', 'Psychic', 153, 375, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(376, 'Metagross', 135, 95, 130, 90, 80, 70, NULL, NULL, 'Steel', 'Psychic', 210, 376, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0);
INSERT INTO `pokedex` (`id`, `name`, `attack`, `spattack`, `def`, `spdef`, `hp`, `speed`, `evolution`, `level`, `type1`, `type2`, `exp`, `num`, `move1`, `move2`, `move3`, `move4`, `gender`) VALUES
(377, 'RegiRock', 100, 50, 200, 100, 80, 50, NULL, NULL, 'Rock', NULL, 217, 377, 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Slide', 0),
(378, 'RegIce', 50, 100, 100, 200, 80, 50, NULL, NULL, 'Ice', NULL, 216, 378, 'Ice Punch', 'Blizzard', 'Ice Punch', 'Aurora Beam', 0),
(379, 'RegiSteel', 75, 75, 150, 150, 80, 50, NULL, NULL, 'Steel', NULL, 215, 379, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(380, 'Latias', 80, 110, 90, 130, 80, 110, NULL, NULL, 'Dragon', 'Psychic', 211, 380, 'Dragon Rage', 'Dragon Rage', 'Psychic', 'Confusion', 0),
(381, 'Latios', 90, 130, 80, 110, 80, 110, NULL, NULL, 'Dragon', 'Psychic', 211, 381, 'Dragon Rage', 'Dragon Rage', 'Dream Eater', 'Confusion', 0),
(382, 'Kyogre', 100, 150, 90, 140, 100, 90, NULL, NULL, 'Water', NULL, 218, 382, 'Surf', 'Crab Hammer', 'Surf', 'Water Gun', 0),
(383, 'Groudon', 150, 100, 140, 90, 100, 90, NULL, NULL, 'Ground', NULL, 218, 383, 'Dig', 'Bone Club', 'Bonemerang', 'Earthquake', 0),
(384, 'Rayquaza', 150, 150, 90, 90, 105, 95, NULL, NULL, 'Dragon', 'Flying', 220, 384, 'Dragon Rage', 'Dragon Rage', 'Sky Attack', 'Wing Attack', 0),
(385, 'Jirachi', 100, 100, 100, 100, 100, 100, NULL, NULL, 'Steel', 'Psychic', 215, 385, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(386, 'Deoxys', 150, 150, 50, 50, 50, 150, NULL, NULL, 'Psychic', NULL, 215, 386, 'Psybeam', 'Dream Eater', 'Psybeam', 'Psybeam', 0),
(387, 'Turtwig', 68, 45, 64, 55, 55, 31, NULL, NULL, 'Grass', NULL, 64, 387, 'Razor Leaf', 'Solar Beam', 'Solar Beam', 'Solar Beam', 0),
(388, 'Grotle', 89, 55, 85, 65, 75, 36, NULL, NULL, 'Grass', NULL, 141, 388, 'Petal Dance', 'Absorb', 'Absorb', 'Petal Dance', 0),
(389, 'Torterra', 109, 75, 105, 85, 95, 56, NULL, NULL, 'Grass', 'Ground', 208, 389, 'Mega Drain', 'Petal Dance', 'Bonemerang', 'Dig', 0),
(390, 'Chimchar', 58, 58, 44, 44, 44, 61, NULL, NULL, 'Fire', NULL, 65, 390, 'Ember', 'Fire Blast', 'Flamethrower', 'Fire Blast', 0),
(391, 'Monferno', 78, 78, 52, 52, 64, 81, NULL, NULL, 'Fire', 'Fighting', 142, 391, 'Fire Blast', 'Ember', 'Karate Chop', 'Jump Kick', 0),
(392, 'Infernape', 104, 104, 71, 71, 76, 108, NULL, NULL, 'Fire', 'Fighting', 209, 392, 'Fire Spin', 'Fire Punch', 'Karate Chop', 'Double Kick', 0),
(393, 'Piplup', 51, 61, 53, 56, 53, 40, NULL, NULL, 'Water', NULL, 66, 393, 'Hydro Pump', 'Water Gun', 'Surf', 'Clamp', 0),
(394, 'Prinplup', 66, 81, 68, 76, 64, 50, NULL, NULL, 'Water', NULL, 143, 394, 'Surf', 'Waterfall', 'Clamp', 'Water Gun', 0),
(395, 'Empoleon', 86, 111, 88, 101, 84, 60, NULL, NULL, 'Water', 'Steel', 210, 395, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(396, 'Starly', 55, 30, 30, 30, 40, 60, NULL, NULL, 'Normal', 'Flying', 56, 396, 'Wrap', 'Egg Bomb', 'Gust', 'Wing Attack', 0),
(397, 'Staravia', 75, 40, 50, 40, 55, 80, NULL, NULL, 'Normal', 'Flying', 113, 397, 'Head Butt', 'Rage', 'Gust', 'Gust', 0),
(398, 'Staraptor', 120, 50, 70, 50, 85, 100, NULL, NULL, 'Normal', 'Flying', 172, 398, 'Pay Day', 'Bind', 'Drill Peck', 'Fly', 0),
(399, 'Bidoof', 45, 35, 40, 40, 59, 31, NULL, NULL, 'Normal', NULL, 58, 399, 'Dizzy Punch', 'Egg Bomb', 'Take Down', 'Double Edge', 0),
(400, 'Bibarel', 85, 55, 60, 60, 79, 71, NULL, NULL, 'Normal', 'Water', 116, 400, 'Bind', 'Skull Bash', 'Water Gun', 'Crab Hammer', 0),
(401, 'Kricketot', 25, 25, 41, 41, 37, 25, NULL, NULL, 'Bug', NULL, 54, 401, 'Pin Missile', 'Pin Missile', 'Pin Missile', 'Pin Missile', 0),
(402, 'Kricketune', 85, 55, 51, 51, 77, 65, NULL, NULL, 'Bug', NULL, 159, 402, 'Leech Life', 'Leech Life', 'Twineedle', 'Leech Life', 0),
(403, 'Shinx', 65, 40, 34, 34, 45, 45, NULL, NULL, 'Electric', NULL, 60, 403, 'Thundershock', 'Thunder', 'Thunderbolt', 'Thunder', 0),
(404, 'Luxio', 85, 60, 49, 49, 60, 60, NULL, NULL, 'Electric', NULL, 117, 404, 'Thundershock', 'Thunderbolt', 'Thunder', 'Thunder', 0),
(405, 'Luxray', 120, 95, 79, 79, 80, 70, NULL, NULL, 'Electric', NULL, 194, 405, 'Thunderbolt', 'Thunder Punch', 'Thunder', 'Thunder', 0),
(406, 'Budew', 30, 50, 35, 70, 40, 55, NULL, NULL, 'Grass', 'Poison', 68, 406, 'Razor Leaf', 'Razor Leaf', 'Sludge', 'Sludge', 0),
(407, 'Roserade', 70, 125, 55, 105, 60, 90, NULL, NULL, 'Grass', 'Poison', 204, 407, 'Mega Drain', 'Vine Whip', 'Smog', 'Acid', 0),
(408, 'Cranidos', 125, 30, 40, 30, 67, 58, NULL, NULL, 'Rock', NULL, 99, 408, 'Rock Slide', 'Rock Throw', 'Rock Throw', 'Rock Slide', 0),
(409, 'Rampardos', 165, 65, 60, 50, 97, 58, NULL, NULL, 'Rock', NULL, 199, 409, 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Slide', 0),
(410, 'Shieldon', 42, 42, 118, 88, 30, 30, NULL, NULL, 'Rock', 'Steel', 99, 410, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(411, 'Bastiodon', 52, 47, 168, 138, 60, 30, NULL, NULL, 'Rock', 'Steel', 199, 411, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(412, 'Burmy', 29, 29, 45, 45, 40, 36, NULL, NULL, 'Bug', NULL, 61, 412, 'Twineedle', 'Leech Life', 'Leech Life', 'Leech Life', 0),
(413, 'Wormadam', 59, 79, 85, 105, 60, 36, NULL, NULL, 'Bug', 'Grass', 159, 413, 'Twineedle', 'Leech Life', 'Mega Drain', 'Razor Leaf', 0),
(414, 'Mothim', 94, 94, 50, 50, 70, 66, NULL, NULL, 'Bug', 'Flying', 159, 414, 'Twineedle', 'Twineedle', 'Peck', 'Peck', 0),
(415, 'Combee', 30, 30, 42, 42, 30, 70, NULL, NULL, 'Bug', 'Flying', 63, 415, 'Leech Life', 'Leech Life', 'Peck', 'Wing Attack', 0),
(416, 'Vespiquen', 80, 80, 102, 102, 70, 40, NULL, NULL, 'Bug', 'Flying', 188, 416, 'Leech Life', 'Leech Life', 'Sky Attack', 'Fly', 0),
(417, 'Pachirisu', 45, 45, 70, 90, 60, 95, NULL, NULL, 'Electric', NULL, 120, 417, 'Thunderbolt', 'Thunder', 'Thunder', 'Thunder Punch', 0),
(418, 'Buizel', 65, 60, 35, 30, 55, 85, NULL, NULL, 'Water', NULL, 75, 418, 'Surf', 'Surf', 'Clamp', 'Hydro Pump', 0),
(419, 'Floatzel', 105, 85, 55, 50, 85, 115, NULL, NULL, 'Water', NULL, 178, 419, 'Water Gun', 'Surf', 'Surf', 'Crab Hammer', 0),
(420, 'Cherubi', 35, 62, 45, 53, 45, 35, NULL, NULL, 'Grass', NULL, 68, 420, 'Absorb', 'Mega Drain', 'Petal Dance', 'Absorb', 0),
(421, 'Cherrim', 60, 87, 70, 78, 70, 85, NULL, NULL, 'Grass', NULL, 133, 421, 'Vine Whip', 'Vine Whip', 'Vine Whip', 'Solar Beam', 0),
(422, 'Shellos', 48, 57, 48, 62, 76, 34, NULL, NULL, 'Water', '', 73, 422, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(423, 'Gastrodon', 83, 92, 68, 82, 111, 39, NULL, NULL, 'Water', 'Ground', 176, 423, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(424, 'Ambipom', 100, 60, 66, 66, 75, 115, NULL, NULL, 'Normal', NULL, 186, 424, 'Take Down', 'Fury Attack', 'Struggle', 'Horn Attack', 0),
(425, 'Drifloon', 50, 60, 34, 44, 90, 70, NULL, NULL, 'Ghost', 'Flying', 127, 425, 'Shadow Armlet', 'Lick', 'Gust', 'Drill Peck', 0),
(426, 'Drifblim', 80, 90, 44, 54, 150, 80, NULL, NULL, 'Ghost', 'Flying', 204, 426, 'Shadow Armlet', 'Shadow Armlet', 'Drill Peck', 'Sky Attack', 0),
(427, 'Buneary', 66, 44, 44, 56, 55, 85, NULL, NULL, 'Normal', NULL, 84, 427, 'Comet Punch', 'Struggle', 'Self Destruct', 'Double Edge', 0),
(428, 'Lopunny', 76, 54, 84, 96, 65, 105, NULL, NULL, 'Normal', NULL, 178, 428, 'Swift', 'Cut', 'Self Destruct', 'Fury Attack', 0),
(429, 'Mismagius', 60, 105, 60, 105, 60, 105, NULL, NULL, 'Ghost', NULL, 187, 429, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(430, 'Honchkrow', 125, 105, 52, 52, 100, 71, NULL, NULL, 'Dark', 'Flying', 187, 430, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(431, 'Glameow', 55, 42, 42, 37, 49, 85, NULL, NULL, 'Normal', NULL, 71, 431, 'Dizzy Punch', 'Vice Grip', 'Strength', 'Rage', 0),
(432, 'Purugly', 82, 64, 64, 59, 71, 112, NULL, NULL, 'Normal', NULL, 183, 432, 'Cut', 'Barrage', 'Fury Attack', 'Constrict', 0),
(433, 'Chingling', 30, 65, 50, 50, 45, 45, NULL, NULL, 'Psychic', NULL, 74, 433, 'Psychic', 'Dream Eater', 'Confusion', 'Psybeam', 0),
(434, 'Stunky', 63, 41, 47, 41, 63, 74, NULL, NULL, 'Poison', 'Dark', 79, 434, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(435, 'Skuntank', 93, 71, 67, 61, 103, 84, NULL, NULL, 'Poison', 'Dark', 209, 435, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(436, 'Bronzor', 24, 24, 86, 86, 57, 23, NULL, NULL, 'Steel', 'Psychic', 72, 436, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(437, 'Bronzong', 89, 79, 116, 116, 67, 33, NULL, NULL, 'Steel', 'Psychic', 188, 437, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(438, 'Bonsly', 80, 10, 95, 45, 50, 10, NULL, NULL, 'Rock', NULL, 68, 438, 'Rock Slide', 'Rock Slide', 'Rock Slide', 'Rock Throw', 0),
(439, 'Mime Jr.', 25, 70, 45, 90, 20, 60, NULL, NULL, 'Psychic', '', 78, 439, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(440, 'Happiny', 5, 15, 5, 65, 100, 30, NULL, NULL, 'Normal', NULL, 255, 440, 'Quick Attack', 'Hyper Beam', 'Mega Punch', 'Egg Bomb', 0),
(441, 'Chatot', 65, 92, 45, 42, 76, 91, NULL, NULL, 'Normal', 'Flying', 107, 441, 'Mega Kick', 'Comet Punch', 'Peck', 'Wing Attack', 0),
(442, 'Spiritomb', 92, 92, 108, 108, 50, 35, NULL, NULL, 'Ghost', 'Dark', 168, 442, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(443, 'Gible', 70, 40, 45, 45, 58, 42, NULL, NULL, 'Dragon', 'Ground', 67, 443, 'Dragon Rage', 'Dragon Rage', 'Bonemerang', 'Bone Club', 0),
(444, 'Gabite', 90, 50, 65, 55, 68, 82, NULL, NULL, 'Dragon', 'Ground', 144, 444, 'Dragon Rage', 'Dragon Rage', 'Bone Club', 'Bonemerang', 0),
(445, 'Garchomp', 130, 80, 95, 85, 108, 102, NULL, NULL, 'Dragon', 'Ground', 218, 445, 'Dragon Rage', 'Dragon Rage', 'Dig', 'Bonemerang', 0),
(446, 'Munchlax', 85, 40, 40, 85, 135, 5, NULL, NULL, 'Normal', NULL, 94, 446, 'Mega Kick', 'Head Butt', 'Dizzy Punch', 'Hyper Fang', 0),
(447, 'Riolu', 70, 35, 40, 40, 40, 60, NULL, NULL, 'Fighting', NULL, 72, 447, 'Jump Kick', 'Karate Chop', 'Submission', 'Karate Chop', 0),
(448, 'Lucario', 110, 115, 70, 70, 70, 90, NULL, NULL, 'Fighting', 'Steel', 204, 448, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(449, 'Hippopotas', 72, 38, 78, 42, 68, 32, NULL, NULL, 'Ground', NULL, 95, 449, 'Earthquake', 'Earthquake', 'Bonemerang', 'Bone Club', 0),
(450, 'Hippowdon', 112, 68, 118, 72, 108, 47, NULL, NULL, 'Ground', NULL, 198, 450, 'Bone Club', 'Dig', 'Bonemerang', 'Earthquake', 0),
(451, 'Skorupi', 50, 30, 90, 55, 40, 65, NULL, NULL, 'Poison', 'Bug', 114, 451, 'Poison Sting', 'Acid', 'Leech Life', 'Twineedle', 0),
(452, 'Drapion', 90, 60, 110, 75, 70, 95, NULL, NULL, 'Poison', 'Dark', 204, 452, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(453, 'Croagunk', 61, 61, 40, 40, 48, 50, NULL, NULL, 'Poison', 'Fighting', 83, 453, 'Sludge', 'Smog', 'Double Kick', 'Jump Kick', 0),
(454, 'Toxicroak', 106, 86, 65, 65, 83, 85, NULL, NULL, 'Poison', 'Fighting', 181, 454, 'Acid', 'Acid', 'Rolling Kick', 'Rolling Kick', 0),
(455, 'Carnivine', 100, 90, 72, 72, 74, 46, NULL, NULL, 'Grass', NULL, 164, 455, 'Absorb', 'Razor Leaf', 'Solar Beam', 'Petal Dance', 0),
(456, 'Finneon', 49, 49, 56, 61, 49, 66, NULL, NULL, 'Water', NULL, 90, 456, 'Clamp', 'Bubblebeam', 'Hydro Pump', 'Hydro Pump', 0),
(457, 'Lumineon', 69, 69, 76, 86, 69, 91, NULL, NULL, 'Water', NULL, 156, 457, 'Clamp', 'Clamp', 'Waterfall', 'Hydro Pump', 0),
(458, 'Mantyke', 20, 60, 50, 120, 45, 50, NULL, NULL, 'Water', 'Flying', 108, 458, 'Clamp', 'Bubble', 'Wing Attack', 'Fly', 0),
(459, 'Snover', 62, 62, 50, 60, 60, 40, NULL, NULL, 'Grass', 'Ice', 131, 459, 'Vine Whip', 'Absorb', 'Aurora Beam', 'Ice Beam', 0),
(460, 'Abomasnow', 92, 92, 75, 85, 90, 60, NULL, NULL, 'Grass', 'Ice', 214, 460, 'Razor Leaf', 'Petal Dance', 'Blizzard', 'Aurora Beam', 0),
(461, 'Weavile', 120, 45, 65, 85, 70, 125, NULL, NULL, 'Dark', 'Ice', 199, 461, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(462, 'Magnezone', 70, 130, 115, 90, 70, 60, NULL, NULL, 'Electric', 'Steel', 211, 462, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(463, 'Lickilicky', 85, 80, 95, 95, 110, 50, NULL, NULL, 'Normal', NULL, 193, 463, 'Wrap', 'Constrict', 'Double Edge', 'Fury Attack', 0),
(464, 'Rhyperior', 140, 55, 130, 55, 115, 40, NULL, NULL, 'Ground', 'Rock', 217, 464, 'Bonemerang', 'Dig', 'Rock Throw', 'Rock Slide', 0),
(465, 'Tangrowth', 100, 110, 125, 50, 100, 50, NULL, NULL, 'Grass', NULL, 211, 465, 'Vine Whip', 'Razor Leaf', 'Vine Whip', 'Mega Drain', 0),
(466, 'Electivire', 123, 95, 67, 85, 75, 95, NULL, NULL, 'Electric', NULL, 199, 466, 'Thunder Punch', 'Thundershock', 'Thunder', 'Thunder', 0),
(467, 'Magmortar', 95, 125, 67, 95, 75, 83, NULL, NULL, 'Fire', NULL, 199, 467, 'Flamethrower', 'Ember', 'Fire Blast', 'Fire Spin', 0),
(468, 'Togekiss', 50, 120, 95, 115, 85, 80, NULL, NULL, 'Normal', 'Flying', 220, 468, 'Slam', 'Bite', 'Sky Attack', 'Wing Attack', 0),
(469, 'Yanmega', 76, 116, 86, 56, 86, 95, NULL, NULL, 'Bug', 'Flying', 198, 469, 'Leech Life', 'Pin Missile', 'Wing Attack', 'Peck', 0),
(470, 'Leafeon', 110, 60, 130, 65, 65, 95, NULL, NULL, 'Grass', NULL, 196, 470, 'Solar Beam', 'Vine Whip', 'Solar Beam', 'Vine Whip', 0),
(471, 'Glaceon', 60, 130, 110, 95, 65, 65, NULL, NULL, 'Ice', NULL, 196, 471, 'Aurora Beam', 'Blizzard', 'Blizzard', 'Ice Punch', 0),
(472, 'Gliscor', 95, 45, 125, 75, 75, 95, NULL, NULL, 'Ground', 'Flying', 192, 472, 'Dig', 'Dig', 'Fly', 'Sky Attack', 0),
(473, 'Mamoswine', 130, 70, 80, 60, 110, 80, NULL, NULL, 'Ice', 'Ground', 207, 473, 'Ice Punch', 'Ice Beam', 'Bone Club', 'Dig', 0),
(474, 'Porygon-Z', 80, 135, 70, 75, 85, 90, NULL, NULL, 'Normal', NULL, 185, 474, 'Tackle', 'Dizzy Punch', 'Cut', 'Horn Attack', 0),
(475, 'Gallade', 125, 65, 65, 115, 68, 80, NULL, NULL, 'Psychic', 'Fighting', 208, 475, 'Psychic', 'Psybeam', 'Rolling Kick', 'Jump Kick', 0),
(476, 'Probopass', 55, 75, 145, 150, 60, 40, NULL, NULL, 'Rock', 'Steel', 198, 476, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(477, 'Dusknoir', 100, 65, 135, 135, 45, 45, NULL, NULL, 'Ghost', NULL, 210, 477, 'Lick', 'Shadow Armlet', 'Lick', 'Lick', 0),
(478, 'Froslass', 80, 80, 70, 70, 70, 110, NULL, NULL, 'Ice', 'Ghost', 187, 478, 'Blizzard', 'Aurora Beam', 'Lick', 'Shadow Armlet', 0),
(479, 'Rotom', 50, 95, 77, 77, 50, 91, NULL, NULL, 'Electric', 'Ghost', 132, 479, 'Thunder', 'Thunder', 'Shadow Armlet', 'Shadow Armlet', 0),
(480, 'Uxie', 75, 75, 130, 130, 75, 95, NULL, NULL, 'Psychic', NULL, 210, 480, 'Psychic', 'Psychic', 'Psybeam', 'Psychic', 0),
(481, 'Mesprit', 105, 105, 105, 105, 80, 80, NULL, NULL, 'Psychic', NULL, 210, 481, 'Psychic', 'Psybeam', 'Dream Eater', 'Confusion', 0),
(482, 'Azelf', 125, 125, 70, 70, 75, 115, NULL, NULL, 'Psychic', NULL, 210, 482, 'Psychic', 'Psybeam', 'Psychic', 'Confusion', 0),
(483, 'Dialga', 120, 150, 120, 100, 100, 90, NULL, NULL, 'Steel', 'Dragon', 220, 483, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(484, 'Palkia', 120, 150, 100, 120, 90, 100, NULL, NULL, 'Water', 'Dragon', 220, 484, 'Bubble', 'Waterfall', 'Dragon Rage', 'Dragon Rage', 0),
(485, 'Heatran', 90, 130, 106, 106, 91, 77, NULL, NULL, 'Fire', 'Steel', 215, 485, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(486, 'Regigigas', 160, 80, 110, 110, 110, 100, NULL, NULL, 'Normal', NULL, 220, 486, 'Comet Punch', 'Struggle', 'Mega Punch', 'Scratch', 0),
(487, 'Giratina', 100, 100, 120, 120, 150, 90, NULL, NULL, 'Ghost', 'Dragon', 220, 487, 'Lick', 'Shadow Armlet', 'Dragon Rage', 'Dragon Rage', 0),
(488, 'Cresselia', 70, 75, 120, 130, 120, 85, NULL, NULL, 'Psychic', NULL, 210, 488, 'Psybeam', 'Psybeam', 'Psychic', 'Confusion', 0),
(489, 'Phione', 80, 80, 80, 80, 80, 80, NULL, NULL, 'Water', NULL, 165, 489, 'Crab Hammer', 'Bubble', 'Crab Hammer', 'Hydro Pump', 0),
(490, 'Manaphy', 100, 100, 100, 100, 100, 100, NULL, NULL, 'Water', NULL, 215, 490, 'Crab Hammer', 'Hydro Pump', 'Bubble', 'Crab Hammer', 0),
(491, 'Darkrai', 90, 135, 90, 90, 70, 125, NULL, NULL, 'Dark', NULL, 210, 491, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(492, 'Shaymin', 100, 100, 100, 100, 100, 100, NULL, NULL, 'Grass', NULL, 64, 492, 'Petal Dance', 'Petal Dance', 'Petal Dance', 'Mega Drain', 0),
(493, 'Arceus', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Normal', NULL, 255, 493, 'Wrap', 'Comet Punch', 'Take Down', 'Skull Bash', 0),
(494, 'Victini', 100, 100, 100, 100, 100, 100, NULL, NULL, 'Psychic', 'Fire', 100, 494, 'Dream Eater', 'Confusion', 'Fire Blast', 'Fire Spin', 0),
(495, 'Snivy', 45, 45, 55, 55, 45, 63, 'Servine', NULL, 'Grass', NULL, 100, 495, 'Solar Beam', 'Petal Dance', 'Mega Drain', 'Solar Beam', 0),
(496, 'Servine', 60, 60, 75, 75, 60, 83, 'Serperior', 17, 'Grass', NULL, 100, 496, 'Solar Beam', 'Mega Drain', 'Razor Leaf', 'Absorb', 0),
(497, 'Serperior', 75, 75, 95, 95, 75, 113, NULL, 36, 'Grass', NULL, 100, 497, 'Solar Beam', 'Vine Whip', 'Absorb', 'Solar Beam', 0),
(498, 'Tepig', 63, 45, 45, 45, 65, 45, 'Pignite', NULL, 'Fire', NULL, 100, 498, 'Fire Spin', 'Ember', 'Flamethrower', 'Fire Spin', 0),
(499, 'Pignite', 93, 70, 55, 55, 90, 55, 'Emboar', NULL, 'Fire', 'Fightint', 100, 499, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(500, 'Emboar', 123, 100, 65, 65, 110, 65, NULL, NULL, 'Fire', 'Fighting', 100, 500, 'Flamethrower', 'Fire Punch', 'Jump Kick', 'Rolling Kick', 0),
(501, 'Oshawott', 55, 63, 45, 45, 55, 45, 'Dewott', NULL, 'Water', NULL, 100, 501, 'Bubble', 'Crab Hammer', 'Crab Hammer', 'Bubble', 0),
(502, 'Dewott', 75, 83, 60, 60, 75, 60, 'Samurott', NULL, 'Water', NULL, 100, 502, 'Bubble', 'Surf', 'Clamp', 'Water Gun', 0),
(503, 'Samurott', 100, 108, 85, 70, 95, 70, NULL, NULL, 'Water', NULL, 100, 503, 'Water Gun', 'Crab Hammer', 'Clamp', 'Crab Hammer', 0),
(504, 'Patrat', 55, 35, 39, 39, 45, 42, 'Watchog', 20, 'Normal', NULL, 100, 504, 'Pay Day', 'Egg Bomb', 'Mega Kick', 'Self Destruct', 0),
(505, 'Watchog', 85, 60, 69, 69, 60, 77, NULL, NULL, 'Normal', NULL, 100, 505, 'Thrash', 'Bind', 'Self Destruct', 'Struggle', 0),
(506, 'Lillipup', 60, 25, 45, 45, 45, 55, 'Herdier', NULL, 'Normal', NULL, 100, 506, 'Vice Grip', 'Dizzy Punch', 'Fury Attack', 'Strength', 0),
(507, 'Herdier', 80, 35, 65, 65, 65, 60, 'Stoutland', NULL, 'Normal', NULL, 100, 507, 'Comet Punch', 'Horn Attack', 'Fury Swipes', 'Pay Day', 0),
(508, 'Stoutland', 100, 45, 90, 90, 85, 80, NULL, NULL, 'Normal', NULL, 100, 508, 'Skull Bash', 'Bind', 'Comet Punch', 'Constrict', 0),
(509, 'Purrloin', 50, 50, 37, 37, 41, 66, 'Liepard', NULL, 'Dark', NULL, 100, 509, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(510, 'Liepard', 88, 88, 50, 50, 64, 106, NULL, NULL, 'Dark', NULL, 100, 510, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(511, 'Pansage', 53, 53, 48, 48, 50, 64, 'Simisage', NULL, 'Grass', NULL, 100, 511, 'Vine Whip', 'Petal Dance', 'Absorb', 'Mega Drain', 0),
(512, 'Simisage', 98, 98, 63, 63, 75, 101, NULL, NULL, 'Grass', NULL, 100, 512, 'Mega Drain', 'Mega Drain', 'Petal Dance', 'Vine Whip', 0),
(513, 'Pansear', 53, 53, 48, 48, 50, 64, 'Simisear', NULL, 'Fire', NULL, 100, 513, 'Ember', 'Ember', 'Fire Punch', 'Fire Punch', 0),
(514, 'Simisear', 98, 98, 63, 63, 75, 101, NULL, NULL, 'Fire', NULL, 100, 514, 'Fire Punch', 'Flamethrower', 'Fire Spin', 'Fire Punch', 0),
(515, 'Panpour', 53, 53, 48, 48, 50, 64, 'Simipour', NULL, 'Water', NULL, 100, 515, 'Surf', 'Waterfall', 'Bubblebeam', 'Clamp', 0),
(516, 'Simipour', 98, 98, 63, 63, 75, 101, NULL, NULL, 'Water', NULL, 100, 516, 'Crab Hammer', 'Clamp', 'Surf', 'Surf', 0),
(517, 'Munna', 25, 67, 45, 55, 76, 24, 'Musharna', NULL, 'Psychic', NULL, 100, 517, 'Confusion', 'Confusion', 'Psychic', 'Dream Eater', 0),
(518, 'Musharna', 55, 107, 85, 95, 116, 29, NULL, NULL, 'Psychic', NULL, 100, 518, 'Dream Eater', 'Psychic', 'Confusion', 'Psychic', 0),
(519, 'Pidove', 55, 36, 50, 30, 50, 43, 'Tranquill', NULL, 'Normal', 'Flying', 100, 519, 'Vice Grip', 'Thrash', 'Gust', 'Wing Attack', 0),
(520, 'Tranquill', 77, 50, 62, 42, 62, 65, 'Unfezant', NULL, 'Normal', 'Flying', 100, 520, 'Skull Bash', 'Cut', 'Gust', 'Peck', 0),
(521, 'Unfezant', 105, 65, 80, 55, 80, 93, NULL, NULL, 'Normal', 'Flying', 100, 521, 'Slam', 'Quick Attack', 'Wing Attack', 'Sky Attack', 0),
(522, 'Blitzle', 60, 50, 32, 32, 45, 76, 'Zebstrika', NULL, 'Electric', NULL, 100, 522, 'Thunder Punch', 'Thundershock', 'Thunder', 'Thunder Punch', 0),
(523, 'Zebstrika', 100, 80, 63, 63, 75, 116, NULL, NULL, 'Electric', NULL, 100, 523, 'Thunderbolt', 'Thunderbolt', 'Thunder', 'Thunderbolt', 0),
(524, 'Roggenrola', 75, 25, 85, 25, 55, 15, 'Boldore', NULL, 'Rock', NULL, 100, 524, 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Throw', 0),
(525, 'Boldore', 105, 50, 105, 40, 70, 20, 'Gigalith', NULL, 'Rock', NULL, 100, 525, 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Slide', 0),
(526, 'Gigalith', 135, 60, 130, 70, 85, 25, NULL, NULL, 'Rock', NULL, 100, 526, 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Slide', 0),
(527, 'Woobat', 45, 55, 43, 43, 55, 72, 'Swoobat', NULL, 'Psychic', 'Flying', 100, 527, 'Psybeam', 'Confusion', 'Fly', 'Fly', 0),
(528, 'Swoobat', 57, 77, 55, 55, 67, 114, NULL, NULL, 'Psychic', 'Flying', 100, 528, 'Psychic', 'Psychic', 'Gust', 'Gust', 0),
(529, 'Drilbur', 85, 30, 40, 45, 60, 68, 'Excadrill', NULL, 'Ground', NULL, 100, 529, 'Bonemerang', 'Bonemerang', 'Bonemerang', 'Bone Club', 0),
(530, 'Excadrill', 135, 50, 60, 65, 110, 88, NULL, NULL, 'Ground', 'Steel', 100, 530, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(531, 'Audino', 60, 60, 86, 86, 103, 50, NULL, NULL, 'Normal', NULL, 100, 531, 'Slam', 'Explosion', 'Mega Kick', 'Vice Grip', 0),
(532, 'Timburr', 80, 25, 55, 35, 75, 35, 'Gurdurr', NULL, 'Fighting', NULL, 100, 532, 'Karate Chop', 'Submission', 'Submission', 'Double Kick', 0),
(533, 'Gurdurr', 105, 40, 85, 50, 85, 40, 'Conkeldurr', NULL, 'Fighting', NULL, 100, 533, 'Submission', 'Double Kick', 'Rolling Kick', 'Jump Kick', 0),
(534, 'Conkeldurr', 140, 55, 95, 65, 105, 45, NULL, NULL, 'Fighting', NULL, 100, 534, 'Submission', 'Double Kick', 'Jump Kick', 'Jump Kick', 0),
(535, 'Tympole', 50, 50, 40, 40, 50, 64, 'Palpitoad', NULL, 'Water', NULL, 100, 535, 'Bubble', 'Hydro Pump', 'Bubblebeam', 'Hydro Pump', 0),
(536, 'Palpitoad', 65, 65, 55, 55, 75, 69, 'Seismitoad', NULL, 'Water', 'Ground', 100, 536, 'Bubblebeam', 'Crab Hammer', 'Dig', 'Earthquake', 0),
(537, 'Seismitoad', 85, 85, 75, 75, 105, 74, NULL, NULL, 'Water', 'Ground', 100, 537, 'Waterfall', 'Bubble', 'Dig', 'Bonemerang', 0),
(538, 'Throh', 100, 30, 85, 85, 120, 45, NULL, NULL, 'Fighting', NULL, 100, 538, 'Double Kick', 'Double Kick', 'Jump Kick', 'Submission', 0),
(539, 'Sawk', 125, 30, 75, 75, 75, 85, NULL, NULL, 'Fighting', NULL, 100, 539, 'Karate Chop', 'Double Kick', 'Rolling Kick', 'Rolling Kick', 0),
(540, 'Sewaddle', 53, 40, 70, 60, 45, 42, 'Swadloon', NULL, 'Bug', 'Grass', 100, 540, 'Pin Missile', 'Leech Life', 'Absorb', 'Vine Whip', 0),
(541, 'Swadloon', 63, 50, 90, 80, 55, 42, 'Leavanny', NULL, 'Bug', 'Grass', 100, 541, 'Pin Missile', 'Leech Life', 'Petal Dance', 'Vine Whip', 0),
(542, 'Leavanny', 103, 70, 80, 70, 75, 92, NULL, NULL, 'Bug', 'Grass', 100, 542, 'Leech Life', 'Twineedle', 'Absorb', 'Vine Whip', 0),
(543, 'Venipede', 45, 30, 59, 39, 30, 57, 'Whirlipede', NULL, 'Bug', 'Poison', 100, 543, 'Leech Life', 'Twineedle', 'Acid', 'Poison Sting', 0),
(544, 'Whirlipede', 55, 40, 99, 79, 40, 47, 'Scolipede', NULL, 'Bug', 'Poison', 100, 544, 'Pin Missile', 'Twineedle', 'Poison Sting', 'Sludge', 0),
(545, 'Scolipede', 90, 55, 89, 69, 60, 112, NULL, NULL, 'Bug', 'Poison', 100, 545, 'Twineedle', 'Twineedle', 'Poison Sting', 'Sludge', 0),
(546, 'Cottonee', 27, 37, 60, 50, 40, 66, 'Whimsicott', NULL, 'Grass', NULL, 100, 546, 'Vine Whip', 'Vine Whip', 'Mega Drain', 'Absorb', 0),
(547, 'Whimsicott', 67, 77, 85, 75, 60, 116, NULL, NULL, 'Grass', NULL, 100, 547, 'Absorb', 'Vine Whip', 'Absorb', 'Mega Drain', 0),
(548, 'Petilil', 35, 70, 50, 50, 45, 30, 'Lilligant', NULL, 'Grass', NULL, 100, 548, 'Mega Drain', 'Mega Drain', 'Solar Beam', 'Solar Beam', 0),
(549, 'Lilligant', 60, 110, 75, 75, 70, 90, NULL, NULL, 'Grass', NULL, 100, 549, 'Solar Beam', 'Absorb', 'Solar Beam', 'Razor Leaf', 0),
(550, 'Basculin', 92, 80, 65, 55, 70, 98, NULL, NULL, 'Water', NULL, 100, 550, 'Waterfall', 'Hydro Pump', 'Clamp', 'Clamp', 0),
(551, 'Sandile', 72, 35, 35, 35, 50, 65, 'Krokorok', NULL, 'Ground', 'Dark', 100, 551, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(552, 'Krokorok', 82, 45, 45, 45, 60, 74, 'Krookodile', NULL, 'Ground', 'Dark', 100, 552, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(553, 'Krookodile', 117, 65, 70, 70, 95, 92, NULL, NULL, 'Ground', 'Dark', 100, 553, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(554, 'Darumaka', 90, 15, 45, 45, 70, 50, 'Darmanitan', NULL, 'Fire', NULL, 100, 554, 'Flamethrower', 'Fire Punch', 'Fire Spin', 'Fire Punch', 0),
(555, 'Darmanitan', 140, 30, 55, 55, 105, 95, NULL, NULL, 'Fire', NULL, 100, 555, 'Fire Blast', 'Fire Blast', 'Fire Punch', 'Fire Spin', 0),
(556, 'Maractus', 86, 106, 67, 67, 75, 60, NULL, NULL, 'Grass', NULL, 100, 556, 'Solar Beam', 'Petal Dance', 'Solar Beam', 'Mega Drain', 0),
(557, 'Dwebble', 65, 35, 85, 35, 50, 55, 'Crustle', NULL, 'Bug', 'Rock', 100, 557, 'Pin Missile', 'Twineedle', 'Rock Slide', 'Rock Throw', 0),
(558, 'Crustle', 95, 65, 125, 75, 70, 45, NULL, NULL, 'Bug', 'Rock', 100, 558, 'Pin Missile', 'Pin Missile', 'Rock Throw', 'Rock Slide', 0),
(559, 'Scraggy', 75, 35, 70, 70, 50, 45, 'Scrafty', NULL, 'Dark', 'Fighting', 100, 559, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(560, 'Scrafty', 90, 45, 115, 115, 65, 58, NULL, NULL, 'Dark', 'Fighting', 100, 560, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(561, 'Sigilyph', 58, 103, 80, 80, 72, 97, NULL, NULL, 'Psychic', 'Fighting', 100, 561, 'Psybeam', 'Psybeam', 'Double Kick', 'Rolling Kick', 0),
(562, 'Yamask', 30, 55, 85, 65, 38, 30, 'Cofagrigus', NULL, 'Ghost', NULL, 100, 562, 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet', 0),
(563, 'Cofagrigus', 50, 95, 145, 105, 58, 30, NULL, NULL, 'Ghost', NULL, 100, 563, 'Lick', 'Shadow Armlet', 'Lick', 'Lick', 0),
(564, 'Tirtouga', 78, 53, 103, 45, 54, 22, 'Carracosta', NULL, 'Water', 'Rock', 100, 564, 'Crab Hammer', 'Clamp', 'Rock Slide', 'Rock Throw', 0),
(565, 'Carracosta', 108, 83, 133, 65, 74, 32, NULL, NULL, 'Water', 'Rock', 100, 565, 'Clamp', 'Clamp', 'Rock Throw', 'Rock Throw', 0),
(566, 'Archen', 112, 74, 45, 45, 55, 70, 'Archeops', NULL, 'Rock', 'Flying', 100, 566, 'Rock Throw', 'Rock Slide', 'Sky Attack', 'Wing Attack', 0),
(567, 'Archeops', 140, 112, 65, 65, 75, 110, NULL, NULL, 'Rock', 'Flying', 100, 567, 'Rock Throw', 'Rock Throw', 'Peck', 'Wing Attack', 0),
(568, 'Trubbish', 50, 40, 62, 62, 50, 65, 'Garbodor', NULL, 'Poison', NULL, 100, 568, 'Acid', 'Smog', 'Smog', 'Smog', 0),
(569, 'Garbodor', 95, 60, 82, 82, 80, 75, NULL, NULL, 'Poison', NULL, 100, 569, 'Acid', 'Sludge', 'Acid', 'Smog', 0),
(570, 'Zorua', 65, 80, 40, 40, 40, 65, 'Zoroark', NULL, 'Dark', NULL, 100, 570, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(571, 'Zoroark', 105, 120, 60, 60, 60, 105, NULL, NULL, 'Dark', NULL, 100, 571, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(572, 'Minccino', 50, 40, 40, 40, 55, 75, 'Cinccino', NULL, 'Normal', NULL, 100, 572, 'Slash', 'Take Down', 'Swift', 'Vice Grip', 0),
(573, 'Cinccino', 95, 65, 60, 60, 75, 115, NULL, NULL, 'Normal', NULL, 100, 573, 'Cut', 'Strength', 'Scratch', 'Fury Swipes', 0),
(574, 'Gothita', 30, 55, 50, 65, 45, 45, 'Gothorita', NULL, 'Psychic', NULL, 100, 574, 'Confusion', 'Psychic', 'Confusion', 'Psychic', 0),
(575, 'Gothorita', 45, 75, 70, 85, 60, 55, 'Gothitelle', NULL, 'Psychic', NULL, 100, 575, 'Confusion', 'Dream Eater', 'Psybeam', 'Psybeam', 0),
(576, 'Gothitelle', 55, 95, 95, 110, 70, 65, NULL, NULL, 'Psychic', NULL, 100, 576, 'Psychic', 'Confusion', 'Psybeam', 'Confusion', 0),
(577, 'Solosis', 30, 105, 40, 50, 45, 20, 'Duosion', NULL, 'Psychic', NULL, 100, 577, 'Psybeam', 'Psybeam', 'Dream Eater', 'Psychic', 0),
(578, 'Duosion', 40, 125, 50, 60, 65, 30, 'Reuniclus', NULL, 'Psychic', NULL, 100, 578, 'Confusion', 'Psybeam', 'Psychic', 'Confusion', 0),
(579, 'Reuniclus', 65, 125, 75, 85, 110, 30, NULL, NULL, 'Psychic', NULL, 100, 579, 'Psychic', 'Psybeam', 'Confusion', 'Dream Eater', 0),
(580, 'Ducklett', 44, 44, 50, 50, 62, 65, 'Swanna', NULL, 'Water', 'Flying', 100, 580, 'Hydro Pump', 'Crab Hammer', 'Wing Attack', 'Fly', 0),
(581, 'Swanna', 87, 87, 63, 63, 75, 98, NULL, NULL, 'Water', 'Flying', 100, 581, 'Crab Hammer', 'Waterfall', 'Fly', 'Fly', 0),
(582, 'Vanillite', 50, 65, 50, 60, 36, 44, 'Vanillish', NULL, 'Ice', NULL, 100, 582, 'Aurora Beam', 'Blizzard', 'Ice Punch', 'Aurora Beam', 0),
(583, 'Vanillish', 65, 80, 65, 75, 51, 59, 'Vanilluxe', NULL, 'Ice', NULL, 100, 583, 'Blizzard', 'Ice Punch', 'Ice Punch', 'Ice Punch', 0),
(584, 'Vanilluxe', 95, 110, 85, 95, 71, 79, NULL, NULL, 'Ice', NULL, 100, 584, 'Aurora Beam', 'Blizzard', 'Ice Beam', 'Ice Beam', 0),
(585, 'Deerling', 60, 40, 50, 50, 60, 75, 'Sawsbuck', NULL, 'Normal', 'Grass', 100, 585, 'Swift', 'Hyper Beam', 'Mega Drain', 'Mega Drain', 0),
(586, 'Sawsbuck', 100, 60, 70, 70, 80, 95, NULL, NULL, 'Normal', 'Grass', 100, 586, 'Comet Punch', 'Body Slam', 'Petal Dance', 'Petal Dance', 0),
(587, 'Emolga', 75, 75, 60, 60, 55, 103, NULL, NULL, 'Electric', 'Flying', 100, 587, 'Thundershock', 'Thunder Punch', 'Drill Peck', 'Sky Attack', 0),
(588, 'Karrablast', 75, 40, 45, 45, 50, 60, 'Escavalier', NULL, 'Bug', NULL, 100, 588, 'Twineedle', 'Pin Missile', 'Pin Missile', 'Pin Missile', 0),
(589, 'Escavalier', 135, 60, 105, 105, 70, 20, NULL, NULL, 'Bug', 'Steel', 100, 589, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(590, 'Foongus', 55, 55, 45, 55, 69, 15, 'Amoonguss', NULL, 'Grass', 'Poison', 100, 590, 'Mega Drain', 'Mega Drain', 'Acid', 'Sludge', 0),
(591, 'Amoonguss', 85, 85, 70, 80, 114, 30, NULL, NULL, 'Grass', 'Poison', 100, 591, 'Razor Leaf', 'Solar Beam', 'Smog', 'Acid', 0),
(592, 'Frillish', 40, 65, 50, 85, 55, 40, 'Jellicent', NULL, 'Water', 'Ghost', 100, 592, 'Bubble', 'Bubblebeam', 'Shadow Armlet', 'Lick', 0),
(593, 'Jellicent', 60, 85, 70, 105, 100, 60, NULL, NULL, 'Water', 'Ghost', 100, 593, 'Clamp', 'Clamp', 'Lick', 'Lick', 0),
(594, 'Alomomola', 75, 40, 80, 45, 165, 65, NULL, NULL, 'Water', NULL, 100, 594, 'Waterfall', 'Waterfall', 'Surf', 'Crab Hammer', 0),
(595, 'Joltik', 47, 57, 50, 50, 50, 65, 'Galvantula', NULL, 'Bug', 'Electric', 100, 595, 'Leech Life', 'Pin Missile', 'Thunder Punch', 'Thunderbolt', 0),
(596, 'Galvantula', 77, 97, 60, 60, 70, 108, NULL, NULL, 'Bug', 'Electric', 100, 596, 'Twineedle', 'Pin Missile', 'Thunder Punch', 'Thunder Punch', 0),
(597, 'Ferroseed', 50, 24, 91, 86, 44, 10, 'Ferrothorn', NULL, 'Grass', 'Steel', 100, 597, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(598, 'Ferrothorn', 94, 54, 131, 116, 74, 20, NULL, NULL, 'Grass', 'Steel', 100, 598, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(599, 'Klink', 55, 45, 70, 60, 40, 30, 'Klang', NULL, 'Steel', NULL, 100, 599, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(600, 'Klang', 80, 70, 95, 85, 60, 50, 'Klinklang', NULL, 'Steel', NULL, 100, 600, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(601, 'Klinklang', 100, 70, 115, 85, 60, 90, NULL, NULL, 'Steel', NULL, 100, 601, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(602, 'Tynamo', 55, 45, 40, 40, 35, 60, 'Eelektrik', NULL, 'Electric', NULL, 100, 602, 'Thunder Punch', 'Thunder', 'Thunder Punch', 'Thunder Punch', 0),
(603, 'Eelektrik', 85, 75, 70, 70, 65, 40, 'Eelektross', NULL, 'Electric', NULL, 100, 603, 'Thunderbolt', 'Thunderbolt', 'Thundershock', 'Thunder Punch', 0),
(604, 'Eelektross', 115, 105, 80, 80, 85, 50, NULL, NULL, 'Electric', NULL, 100, 604, 'Thundershock', 'Thunder', 'Thunder Punch', 'Thunder', 0),
(605, 'Elgyem', 55, 85, 55, 55, 55, 30, 'Beheeyem', NULL, 'Psychic', NULL, 100, 605, 'Psychic', 'Dream Eater', 'Dream Eater', 'Confusion', 0),
(606, 'Beheeyem', 75, 125, 75, 95, 75, 40, NULL, NULL, 'Psychic', NULL, 100, 606, 'Dream Eater', 'Psychic', 'Psybeam', 'Psychic', 0),
(607, 'Litwick', 30, 65, 55, 55, 50, 20, 'Lampent', NULL, 'Ghost', 'Fire', 100, 607, 'Shadow Armlet', 'Lick', 'Fire Punch', 'Fire Punch', 0),
(608, 'Lampent', 40, 95, 60, 60, 60, 55, 'Chandelure', NULL, 'Ghost', 'Fire', 100, 608, 'Shadow Armlet', 'Lick', 'Fire Spin', 'Fire Blast', 0),
(609, 'Chandelure', 55, 145, 90, 90, 60, 80, NULL, NULL, 'Ghost', 'Fire', 100, 609, 'Lick', 'Shadow Armlet', 'Flamethrower', 'Fire Punch', 0),
(610, 'Axew', 87, 30, 60, 40, 46, 57, 'Fraxure', NULL, 'Dragon', NULL, 100, 610, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(611, 'Fraxure', 117, 40, 70, 50, 66, 67, 'Haxorus', NULL, 'Dragon', NULL, 100, 611, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(612, 'Haxorus', 147, 60, 90, 70, 76, 97, NULL, NULL, 'Dragon', NULL, 100, 612, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(613, 'Cubchoo', 70, 60, 40, 40, 55, 40, 'Beartic', NULL, 'Ice', NULL, 100, 613, 'Ice Punch', 'Ice Punch', 'Aurora Beam', 'Ice Beam', 0),
(614, 'Beartic', 110, 70, 80, 80, 95, 50, 'Cryogonal', NULL, 'Ice', NULL, 100, 614, 'Ice Punch', 'Aurora Beam', 'Blizzard', 'Blizzard', 0),
(615, 'Cryogonal', 50, 95, 30, 135, 70, 105, NULL, NULL, 'Ice', NULL, 100, 615, 'Ice Beam', 'Ice Punch', 'Ice Punch', 'Blizzard', 0),
(616, 'Shelmet', 40, 40, 85, 65, 50, 25, 'Accelgor', NULL, 'Bug', NULL, 100, 616, 'Leech Life', 'Pin Missile', 'Twineedle', 'Twineedle', 0),
(617, 'Accelgor', 70, 100, 40, 60, 80, 145, NULL, NULL, 'Bug', NULL, 100, 617, 'Pin Missile', 'Twineedle', 'Twineedle', 'Leech Life', 0),
(618, 'Stunfisk', 66, 81, 84, 99, 109, 32, NULL, NULL, 'Electric', 'Ground', 100, 618, 'Thunderbolt', 'Thundershock', 'Dig', 'Bone Club', 0),
(619, 'Mienfoo', 85, 55, 50, 50, 45, 65, 'Mienshao', NULL, 'Fighting', NULL, 100, 619, 'Double Kick', 'Submission', 'Double Kick', 'Jump Kick', 0),
(620, 'Mienshao', 125, 95, 60, 60, 65, 105, NULL, NULL, 'Fighting', NULL, 100, 620, 'Double Kick', 'Karate Chop', 'Submission', 'Karate Chop', 0),
(621, 'Druddigon', 120, 60, 90, 90, 77, 48, NULL, NULL, 'Dragon', NULL, 100, 621, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(622, 'Golett', 74, 35, 50, 50, 59, 35, 'Golurk', NULL, 'Ground', 'Ghost', 100, 622, 'Bonemerang', 'Bonemerang', 'Lick', 'Shadow Armlet', 0),
(623, 'Golurk', 124, 55, 80, 80, 89, 55, NULL, NULL, 'Ground', 'Ghost', 100, 623, 'Bonemerang', 'Dig', 'Lick', 'Shadow Armlet', 0),
(624, 'Pawniard', 85, 40, 70, 40, 45, 60, 'Bisharp', NULL, 'Dark', 'Steel', 100, 624, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(625, 'Bisharp', 125, 60, 100, 70, 65, 70, NULL, NULL, 'Dark', 'Steel', 100, 625, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(626, 'Bouffalant', 110, 40, 95, 95, 95, 55, NULL, NULL, 'Normal', NULL, 100, 626, 'Doubleslap', 'Slam', 'Swift', 'Take Down', 0),
(627, 'Rufflet', 83, 37, 50, 50, 70, 60, 'Braviary', NULL, 'Normal', 'Flying', 100, 627, 'Tri Attack', 'Hyper Beam', 'Peck', 'Sky Attack', 0),
(628, 'Braviary', 123, 57, 75, 75, 100, 80, NULL, NULL, 'Normal', 'Flying', 100, 628, 'Tackle', 'Pound', 'Gust', 'Gust', 0),
(629, 'Vullaby', 55, 45, 75, 65, 70, 60, 'Mandibuzz', NULL, 'DarK', 'Flying', 100, 629, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(630, 'Mandibuzz', 65, 55, 105, 95, 110, 80, NULL, NULL, 'Dark', 'Flying', 100, 630, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(631, 'Heatmor', 97, 105, 66, 66, 85, 65, NULL, NULL, 'Fire', NULL, 100, 631, 'Fire Blast', 'Ember', 'Fire Punch', 'Fire Spin', 0),
(632, 'Durant', 109, 48, 112, 48, 58, 109, NULL, NULL, 'Bug', 'Steel', 100, 632, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(633, 'Deino', 65, 45, 50, 50, 52, 38, 'Zweilous', NULL, 'Dark', 'Dragon', 100, 633, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(634, 'Zweilous', 85, 65, 70, 70, 72, 58, 'Hydreigon', NULL, 'Dark', 'Dragon', 100, 634, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(635, 'Hydreigon', 105, 125, 90, 90, 92, 98, NULL, NULL, 'Dark', 'Dragon', 100, 635, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(636, 'Larvesta', 85, 50, 55, 55, 55, 60, 'Volcarona', NULL, 'Bug', 'Fire', 100, 636, 'Pin Missile', 'Pin Missile', 'Ember', 'Fire Punch', 0),
(637, 'Volcarona', 60, 135, 65, 105, 85, 100, NULL, NULL, 'Bug', 'Fire', 100, 637, 'Twineedle', 'Leech Life', 'Fire Blast', 'Fire Spin', 0),
(638, 'Cobalion', 90, 90, 129, 72, 91, 108, NULL, NULL, 'Steel', 'Fighting', 100, 638, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(639, 'Terrakion', 129, 72, 90, 90, 91, 108, NULL, NULL, 'Rock', 'Fighting', 100, 639, 'Rock Slide', 'Rock Slide', 'Jump Kick', 'Double Kick', 0),
(640, 'Virizion', 90, 90, 72, 129, 91, 108, NULL, NULL, 'Grass', 'Fighting', 100, 640, 'Mega Drain', 'Petal Dance', 'Jump Kick', 'Jump Kick', 0),
(641, 'Tornadus', 115, 125, 70, 80, 79, 111, NULL, NULL, 'Flying', NULL, 100, 641, 'Peck', 'Drill Peck', 'Drill Peck', 'Wing Attack', 0),
(642, 'Thundurus', 115, 125, 70, 80, 79, 111, NULL, NULL, 'Electric', 'Flying', 100, 642, 'Thunder', 'Thundershock', 'Wing Attack', 'Fly', 0),
(643, 'Reshiram', 120, 150, 100, 120, 100, 90, NULL, NULL, 'Dragon', 'Fire', 100, 643, 'Dragon Rage', 'Dragon Rage', 'Fire Spin', 'Fire Spin', 0),
(644, 'Zekrom', 150, 120, 120, 100, 100, 90, NULL, NULL, 'Dragon', 'Electric', 100, 644, 'Dragon Rage', 'Dragon Rage', 'Thunderbolt', 'Thunder', 0),
(645, 'Landorus', 125, 115, 90, 80, 89, 101, NULL, NULL, 'Ground', 'Flying', 100, 645, 'Earthquake', 'Bonemerang', 'Gust', 'Fly', 0),
(646, 'Kyurem', 130, 130, 90, 90, 125, 95, NULL, NULL, 'Dragon', 'Ice', 100, 646, 'Dragon Rage', 'Dragon Rage', 'Ice Beam', 'Ice Punch', 0),
(647, 'Keldeo', 72, 129, 90, 90, 91, 108, NULL, NULL, 'Water', 'Fighting', 100, 647, 'Water Gun', 'Surf', 'Rolling Kick', 'Karate Chop', 0),
(648, 'Meloetta', 77, 128, 77, 128, 100, 90, NULL, NULL, 'Normal', 'Psychic', 100, 648, 'Comet Punch', 'Skull Bash', 'Confusion', 'Confusion', 0),
(649, 'Genesect', 120, 120, 95, 95, 71, 99, NULL, NULL, 'Bug', 'Steel', 100, 649, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5095, 'Gyarados (A)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Water', '', 64, 130, 'Water Gun', 'Hydro Pump', 'Bubble', 'Bubble', 0),
(5094, 'Gyarados (M)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Water', '', 64, 130, 'Waterfall', 'Clamp', 'Bubble', 'Hydro Pump', 0),
(5093, 'Gyarados (Z)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Water', 'Flying', 64, 130, 'Hydro Pump', 'Bubblebeam', 'Fly', 'Drill Peck', 0),
(5106, 'Angleos', 150, 155, 150, 155, 142, 144, 'none', NULL, 'Normal', 'Psychic', 64, 5001, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5112, 'Charizard (X)', 100, 100, 100, 100, 100, 100, NULL, 0, 'Fire', 'Flying', 209, 6, 'Fire Blast', 'Body Slam', 'Bite', 'Focus Energy', 0),
(5113, 'Charizard (Y)', 100, 100, 100, 100, 100, 100, NULL, 0, 'Fire', 'Flying', 209, 6, 'Fire Blast', 'Explosion', 'Shadow Armlet', 'Comet Punch', 0),
(5114, 'Deoxys (Attack)', 180, 180, 20, 20, 50, 150, NULL, NULL, 'Psychic', NULL, 215, 386, 'Confusion', 'Confusion', 'Psybeam', 'Psychic', 0),
(5115, 'Deoxys (Defence)', 70, 180, 160, 160, 50, 90, NULL, NULL, 'Psychic', NULL, 215, 386, 'Psybeam', 'Psybeam', 'Dream Eater', 'Psybeam', 0),
(5116, 'Deoxys (Speed)', 95, 95, 90, 90, 50, 180, NULL, NULL, 'Psychic', NULL, 215, 386, 'Psychic', 'Psybeam', 'Psychic', 'Psychic', 0),
(5136, 'Arceus (Unknown)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Unknown', NULL, 255, 493, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5118, 'Arceus (Ground)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Ground', NULL, 255, 493, 'Dig', 'Dig', 'Bonemerang', 'Earthquake', 0),
(5119, 'Arceus (Fire)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Fire', NULL, 255, 493, 'Fire Punch', 'Ember', 'Flamethrower', 'Fire Blast', 0),
(5120, 'Arceus (Water)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Water', NULL, 255, 493, 'Hydro Pump', 'Surf', 'Surf', 'Surf', 0),
(5121, 'Arceus (Electric)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Electric', NULL, 255, 493, 'Thundershock', 'Thunder Punch', 'Thunder', 'Thundershock', 0),
(5122, 'Arceus (Grass)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Grass', NULL, 255, 493, 'Mega Drain', 'Vine Whip', 'Absorb', 'Razor Leaf', 0),
(5123, 'Arceus (Ice)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Ice', NULL, 255, 493, 'Blizzard', 'Aurora Beam', 'Ice Beam', 'Ice Beam', 0),
(5124, 'Arceus (Fighting)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Fighting', NULL, 255, 493, 'Rolling Kick', 'Rolling Kick', 'Karate Chop', 'Double Kick', 0),
(5125, 'Arceus (Poison)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Poison', NULL, 255, 493, 'Poison Sting', 'Smog', 'Poison Sting', 'Smog', 0),
(5126, 'Arceus (Flying)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Flying', NULL, 255, 493, 'Gust', 'Peck', 'Peck', 'Peck', 0),
(5127, 'Arceus (Psychic)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Psychic', NULL, 255, 493, 'Dream Eater', 'Psychic', 'Psybeam', 'Psybeam', 0),
(5128, 'Arceus (Bug)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Bug', NULL, 255, 493, 'Leech Life', 'Leech Life', 'Leech Life', 'Twineedle', 0),
(5129, 'Arceus (Rock)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Rock', NULL, 255, 493, 'Rock Throw', 'Rock Slide', 'Rock Throw', 'Rock Slide', 0),
(5130, 'Arceus (Ghost)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Ghost', NULL, 255, 493, 'Shadow Armlet', 'Lick', 'Shadow Armlet', 'Shadow Armlet', 0),
(5131, 'Arceus (Dragon)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Dragon', NULL, 255, 493, 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 0),
(5132, 'Arceus (Dark)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Dark', NULL, 255, 493, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5133, 'Arceus (Steel)', 120, 120, 120, 120, 120, 120, NULL, NULL, 'Steel', NULL, 255, 493, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5135, 'Giratina (Origin)', 100, 100, 120, 120, 150, 90, NULL, NULL, 'Ghost', 'Dragon', 220, 486, 'Shadow Armlet', 'Blizzard', 'Hydro Pump', 'Hyper Beam', 0),
(5137, 'Absol (Mega)', 150, 150, 100, 100, 100, 100, NULL, NULL, 'Dark', NULL, 174, 359, 'Hyper Beam', 'Bite', 'Bite', 'Bite', 0),
(5139, 'Eevhoom', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Dark', '', 0, 5000, 'Absorb', 'Absorb', 'Absorb', 'Absorb', 0),
(5140, 'Unown (Em)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Psybeam', 'Confusion', 'Dream Eater', 0),
(5141, 'Unown (A)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Psychic', 'Dream Eater', 'Confusion', 0),
(5142, 'Unown (B)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Confusion', 'Psychic', 'Psychic', 0),
(5143, 'Unown (C)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psybeam', 'Psychic', 'Psybeam', 'Dream Eater', 0),
(5144, 'Unown (D)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Confusion', 'Psychic', 'Confusion', 0),
(5145, 'Unown (E)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psybeam', 'Dream Eater', 'Psybeam', 'Psychic', 0),
(5146, 'Unown (F)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Confusion', 'Dream Eater', 'Psychic', 0),
(5147, 'Unown (G)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Dream Eater', 'Psychic', 'Dream Eater', 0),
(5148, 'Unown (H)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psybeam', 'Psybeam', 'Psychic', 'Psychic', 0),
(5149, 'Unown (I)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Dream Eater', 'Confusion', 'Psybeam', 0),
(5150, 'Unown (J)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psychic', 'Dream Eater', 'Dream Eater', 'Psychic', 0),
(5151, 'Unown (K)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Dream Eater', 'Confusion', 'Dream Eater', 0),
(5152, 'Unown (L)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psychic', 'Psychic', 'Dream Eater', 'Dream Eater', 0),
(5153, 'Unown (M)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Psychic', 'Confusion', 'Dream Eater', 0),
(5154, 'Unown (N)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Psychic', 'Psybeam', 'Psychic', 0),
(5155, 'Unown (O)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psybeam', 'Confusion', 'Psychic', 'Confusion', 0),
(5156, 'Unown (P)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Dream Eater', 'Confusion', 'Dream Eater', 0),
(5157, 'Unown (Q)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Confusion', 'Confusion', 'Dream Eater', 0),
(5158, 'Unown (R)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psychic', 'Psychic', 'Confusion', 'Dream Eater', 0),
(5159, 'Unown (S)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Psybeam', 'Confusion', 'Psybeam', 0),
(5160, 'Unown (T)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Psybeam', 'Confusion', 'Dream Eater', 0),
(5161, 'Unown (U)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Psybeam', 'Dream Eater', 'Psybeam', 0),
(5162, 'Unown (V)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psychic', 'Dream Eater', 'Confusion', 'Psybeam', 0),
(5163, 'Unown (W)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Psybeam', 'Dream Eater', 'Dream Eater', 0),
(5164, 'Unown (X)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Confusion', 'Psybeam', 'Dream Eater', 'Confusion', 0),
(5165, 'Unown (Y)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Psybeam', 'Dream Eater', 'Dream Eater', 'Dream Eater', 0),
(5166, 'Unown (Z)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Confusion', 'Confusion', 'Confusion', 0),
(5167, 'Unown (Qm)', 72, 72, 48, 48, 48, 48, NULL, NULL, 'Psychic', NULL, 61, 201, 'Dream Eater', 'Psybeam', 'Psybeam', 'Confusion', 0),
(5168, 'Goomy', 50, 55, 35, 75, 45, 40, 'none', 0, 'Dragon', NULL, 0, 704, 'Body Slam', 'Absorb', 'Tackle', 'Bite', 0),
(5170, 'Goodra', 100, 110, 70, 150, 90, 100, 'none', NULL, 'Dragon', '', 0, 706, 'Earthquake', 'Scratch', 'Bubble', 'Razor Leaf', 0),
(5171, 'Sliggoo', 75, 83, 53, 113, 68, 60, 'none', NULL, 'Dragon', '', 0, 705, 'Dizzy Punch', 'Scratch', 'Bubble', 'Razor Leaf', 0),
(5172, 'Greninja', 95, 103, 67, 71, 72, 122, 'none', NULL, 'Water', 'Dark', 0, 658, 'Fire Blast', 'Scratch', 'Bubble', 'Razor Leaf', 0),
(5173, 'Eevsol', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Normal', '', 0, 5002, 'Fire Blast', 'Scratch', 'Bubble', 'Razor Leaf', 0),
(5174, 'Yvetal', 131, 131, 95, 98, 126, 99, 'none', NULL, 'Dark', 'Flying', 0, 717, 'Fire Blast', 'Scratch', 'Bubble', 'Razor Leaf', 0),
(5175, 'Fennekin', 80, 80, 80, 80, 80, 80, 'Braixen', 36, 'Fire', NULL, 64, 5175, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5176, 'Braixen', 80, 80, 80, 80, 80, 80, 'Delphox', 55, 'Fire', 'Psychic', 64, 5176, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5177, 'Delphox', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Fire', 'Psychic', 64, 5177, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5178, 'Bunnelby', 60, 60, 60, 60, 60, 60, 'Diggersby\r\n', 22, 'Normal', 'Ground', 64, 5178, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5179, 'Diggersby\r\n', 90, 90, 40, 50, 90, 90, 'none', NULL, 'Normal', 'Ground', 64, 5179, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5180, 'Fletchling', 50, 50, 50, 50, 50, 50, 'Fletchinder', 18, 'Fire', NULL, 64, 5180, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5181, 'Fletchinder', 80, 80, 80, 80, 80, 80, 'Talonflame', 55, 'Fire', 'Flying', 64, 5181, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5182, 'Talonflame', 120, 120, 120, 120, 120, 120, 'none', NULL, 'Fire', 'Flying', 64, 5182, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5183, 'Scatterbug', 40, 40, 40, 40, 40, 40, 'Spewpa', 8, 'Bug', NULL, 64, 5183, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5184, 'Spewpa', 70, 70, 70, 70, 70, 70, 'Vivillon', 12, 'Bug', NULL, 64, 5184, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5185, 'Vivillon', 90, 90, 90, 90, 90, 90, 'none', NULL, 'Bug', 'Flying', 64, 5185, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5186, 'Espurr', 75, 55, 83, 44, 80, 56, 'Meowstic', 25, 'Psychic', NULL, 64, 5186, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5187, 'Meowstic', 83, 88, 90, 100, 100, 102, 'none', NULL, 'Psychic', NULL, 64, 5187, 'Psychic', 'Scratch', 'Scratch', 'Scratch', 0),
(5188, 'Eeveon', 100, 120, 90, 90, 88, 120, 'none', NULL, 'Grass', 'Water', 64, 5188, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5189, 'Blaziken (Mega)', 180, 100, 200, 200, 200, 150, 'none', NULL, 'Fire', 'Flying', 64, 5189, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5190, 'Feekarp', 80, 80, 80, 80, 80, 80, 'Gyaratic', 20, 'Water', 'Dragon', 64, 5190, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5191, 'Gyaratic', 180, 120, 150, 120, 180, 130, 'none', NULL, 'Water', 'Dragon', 64, 5191, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5192, 'Mogos', 120, 90, 120, 90, 150, 85, 'none', NULL, 'Fire', 'Dragon', 64, 5192, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5193, 'Zaygos', 120, 90, 120, 100, 150, 100, 'none', 0, 'Dragon', NULL, 64, 5193, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5194, 'Artygos', 120, 100, 90, 90, 180, 120, 'none', NULL, 'Ice', 'Dragon', 64, 5194, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5195, 'Darkcune', 100, 100, 100, 80, 120, 140, 'none', NULL, 'Water', 'Dark', 64, 5195, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5196, 'Mewtwo (Mega)', 140, 150, 150, 150, 150, 150, 'none', NULL, 'Psychic', 'Dark', 64, 5196, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5197, 'Aggron (Mega)', 100, 100, 120, 150, 150, 100, 'none', NULL, 'Rock', 'Steel', 64, 5197, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5199, 'Pikakip', 60, 50, 80, 50, 80, 100, 'Pikatomp', 35, 'Electric', 'Ground', 64, 5199, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5200, 'Pikatomp', 90, 90, 90, 90, 90, 120, 'Raipert', 55, 'Electric', 'Ground', 64, 5200, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5201, 'Raipert', 100, 120, 100, 80, 90, 150, 'none', NULL, '', NULL, 64, 5201, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5202, 'Darkmuj', 130, 100, 90, 130, 100, 180, 'none', NULL, 'Dark', 'Ice', 64, 5202, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5203, 'Alakazam (Mega)', 130, 120, 120, 110, 130, 90, 'none', NULL, 'Psychic', 'Dark', 64, 5203, 'Psychic', 'Shadow Armlet', 'Scratch', 'Scratch', 0);
INSERT INTO `pokedex` (`id`, `name`, `attack`, `spattack`, `def`, `spdef`, `hp`, `speed`, `evolution`, `level`, `type1`, `type2`, `exp`, `num`, `move1`, `move2`, `move3`, `move4`, `gender`) VALUES
(5204, 'Tyrunt', 70, 85, 90, 90, 85, 99, 'Tyrantrum', 55, 'Dragon', 'Rock', 64, 5204, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5205, 'Tyrantrum', 100, 99, 105, 120, 150, 50, 'none', NULL, 'Dragon', 'Rock', 64, 5205, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5206, 'Godtwo', 280, 200, 200, 200, 220, 250, 'none', NULL, 'God', 'God', 64, 5206, 'Heavenly Strike', 'Heavenly Strike', 'God Armlet', 'God Armlet', 0),
(5207, 'Gengar (Mega)', 100, 120, 120, 110, 90, 100, 'none', NULL, 'Ghost', 'Dark', 64, 5207, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5208, 'Tyranita (Mega)', 120, 120, 150, 110, 130, 80, 'none', NULL, 'Dark', 'Rock', 64, 5208, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5209, 'Gyarados (Mega)', 135, 150, 100, 100, 130, 80, 'none', NULL, 'Dark', 'Dragon', 64, 5209, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5210, 'Arceus (God)', 155, 150, 200, 200, 200, 210, 'none', 64, 'God', 'God', 64, 5209, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5211, 'Palkius (God)', 200, 150, 155, 150, 180, 200, 'none', NULL, 'God', 'God', 64, 5211, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5212, 'Alakazam (Mega)', 100, 100, 90, 120, 140, 90, 'none', NULL, 'Psychic', 'Dark', 64, 5212, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5213, 'Banette (Mega)', 90, 100, 120, 120, 90, 90, 'none', NULL, 'Dark', 'Ghost', 64, 5213, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5214, 'Blastoise (Mega)', 120, 120, 100, 80, 130, 80, 'none', NULL, 'Water', 'Water', 0, 5214, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5215, 'Mewtwo (Armor)', 140, 140, 120, 100, 120, 140, 'none', NULL, 'Psychic', 'Dark', 64, 5215, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5216, 'Demondile', 70, 80, 70, 100, 70, 100, 'Demonaw', 3000, 'Fire', 'Water', 64, 5216, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5217, 'Demonaw', 100, 100, 100, 100, 90, 110, 'Demonzard', 3500, 'Fire', 'Dragon', 64, 5217, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5218, 'Demonzard', 120, 120, 140, 120, 120, 150, 'none', NULL, 'Dragon', 'Fire', 65, 5218, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5219, 'Solarsor', 100, 105, 100, 120, 95, 150, 'none', NULL, 'Electric', 'Bug', 64, 5219, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5220, 'Lightsor', 100, 100, 100, 80, 100, 150, 'none', NULL, 'Fire', 'Bug', 64, 5220, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5221, 'Darksor', 120, 90, 120, 90, 95, 180, 'none', NULL, 'Dark', 'Bug', 64, 5221, 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 0),
(5222, 'Ampharos (Mega)', 120, 100, 100, 90, 100, 100, 'none', NULL, 'Electric', 'Normal', 64, 5222, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5223, 'Kyurem (White)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Dragon', 'Ice', 64, 5223, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5224, 'Kyurem (Black)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Dragon', 'Ice', 64, 5224, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5225, 'Yveltal', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Dragon', 'Ice', 64, 5225, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5226, 'Xerneas', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Dragon', 'Ice', 64, 5226, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5227, 'Zygarde', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Dragon', 'Ice', 64, 5227, 'Shadow Armlet', 'Shadow Armlet', 'Scratch', 'Scratch', 0),
(5228, 'Asdd', 40, 40, 40, 40, 40, 40, 'none', NULL, 'Ghost', 'Ghost', 64, 5228, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5229, 'Ghost', 40, 40, 40, 40, 40, 40, 'none', NULL, 'Ghost', 'Ghost', 64, 5229, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5230, 'Tornadus (Therian)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Normal', 'Flying', 64, 5230, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5231, 'Landorus (Therian)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Normal', 'Flying', 64, 5231, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5232, 'Thundurus (Therian)', 100, 100, 100, 100, 100, 100, 'none', NULL, 'Electric', 'Electric', 64, 5232, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5233, 'Aceoxys', 150, 120, 140, 130, 140, 150, 'none', NULL, 'Psychic', 'Normal', 64, 5233, 'Scratch', 'Scratch', 'Scratch', 'Scratch', 0),
(5234, 'Rayquaza (Darkness)', 150, 150, 100, 100, 130, 180, 'none', NULL, 'Dark', 'Dragon', 64, 5234, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5235, 'Rayquaza (Justicar)', 150, 150, 100, 100, 120, 180, 'none', NULL, 'Flying', 'Dragon', 64, 5235, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5236, 'Gardevoir (Mega)', 120, 120, 120, 120, 100, 130, 'none', NULL, 'Psychic', 'Psychic', 64, 5236, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5237, 'Tyranitar (Mega)', 130, 130, 100, 80, 130, 80, 'none', NULL, 'Ground', 'Dragon', 64, 5237, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5238, 'Venasaur (Mega)', 120, 120, 120, 80, 120, 80, 'none', NULL, 'Grass', 'Grass', 64, 5238, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5239, 'Metagross (Mega)', 150, 150, 120, 140, 140, 100, 'none', NULL, 'Psychic', 'Steel', 64, 5239, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5241, 'Heracross (Mega)', 120, 120, 100, 120, 140, 180, 'none', NULL, 'Bug', 'Fighting', 64, 5241, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5242, 'Scizor (Mega)', 140, 140, 100, 120, 100, 180, 'none', NULL, 'Bug', 'Steel', 64, 5242, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5243, 'Deoxys (Mecha)', 180, 180, 180, 180, 250, 180, 'none', NULL, 'Psychic', 'Steel', 64, 5243, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0),
(5244, 'Xsor', 150, 150, 150, 150, 150, 280, 'none', NULL, 'Grass', 'Bug', 64, 5244, 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(3) NOT NULL,
  `num` int(3) NOT NULL,
  `name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `type1` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `type2` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move1` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move2` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move3` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move4` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pokemon`
--

INSERT INTO `pokemon` (`id`, `num`, `name`, `type1`, `type2`, `move1`, `move2`, `move3`, `move4`) VALUES
(1, 113, 'Chansey', 'Normal', '', 'Splash', 'Splash', 'Splash', 'Splash'),
(2, 112, 'Rhydon', 'Ground', 'Rock', 'Fury Attack', 'Horn Drill', 'Leer', 'Take Down'),
(3, 111, 'Rhyhorn', 'Ground', 'Rock', 'Horn Attack', 'Stomp', 'Tail Whip', 'Fury Attack'),
(4, 110, 'Weezing', 'Poison', '', 'Smoke Screen', 'Self Destruct', 'Haze', 'Explosion'),
(5, 109, 'Koffing', 'Poison', '', 'Tackle', 'Smog', 'Sludge', 'Smoke Screen'),
(6, 108, 'Lickitung', 'Normal', '', 'Disable', 'Defense Curl', 'Slam', 'Screech'),
(7, 107, 'Hitmonchan', 'Fighting', '', 'Ice Punch', 'Thunder Punch', 'Mega Punch', 'Counter'),
(8, 106, 'Hitmonlee', 'Fighting', '', 'Jump Kick', 'Focus Energy', 'Hi Jump Kick', 'Mega Kick'),
(9, 105, 'Marowak', 'Ground', '', 'Focus Energy', 'Thrash', 'Bonemerang', 'Rage'),
(10, 104, 'Cubone', 'Ground', '', 'Bone Club', 'Growl', 'Leer', 'Focus Energy'),
(11, 103, 'Exeggutor', 'Grass', 'Psychic', 'Poison Powder', 'Solar Beam', 'Sleep Powder', 'Stomp'),
(12, 102, 'Exeggcute', 'Grass', 'Psychic', 'Barrage', 'Hypnosis', 'Reflect', 'Leech Seed'),
(13, 101, 'Electrode', 'Electric', '', 'Self Destruct', 'Light Screen', 'Swift', 'Explosion'),
(14, 100, 'Voltorb', 'Electric', '', 'Tackle', 'Screech', 'Sonic Boom', 'Self Destruct'),
(15, 99, 'Kingler', 'Water', '', 'Guillotine', 'Stomp', 'Crab Hammer', 'Harden'),
(16, 98, 'Krabby', 'Water', '', 'Bubble', 'Leer', 'Vice Grip', 'Guillotine'),
(17, 97, 'Hypno', 'Psychic', '', 'Head Butt', 'Poison Gas', 'Psychic', 'Meditate'),
(18, 96, 'Drowzee', 'Psychic', '', 'Pound', 'Hypnosis', 'Disable', 'Confusion'),
(19, 95, 'Onix', 'Rock', 'Ground', 'Rock Throw', 'Rage', 'Slam', 'Harden'),
(20, 94, 'Gengar', 'Ghost', 'Poison', 'Confuse Ray', 'Night Shade', 'Hypnosis', 'Dream Eater'),
(21, 93, 'Haunter', 'Ghost', 'Poison', 'Confuse Ray', 'Night Shade', 'Hypnosis', 'Dream Eater'),
(22, 92, 'Gastly', 'Ghost', 'Poison', 'Lick', 'Confuse Ray', 'Night Shade', 'Hypnosis'),
(23, 91, 'Cloyster', 'Water', 'Ice', 'Aurora Beam', 'Leer', 'Ice Beam', 'Spike Cannon'),
(24, 90, 'Shellder', 'Water', '', 'Tackle', 'Withdraw', 'Supersonic', 'Clamp'),
(25, 89, 'Muk', 'Poison', '', 'Sludge', 'Harden', 'Screech', 'Acid Armor'),
(26, 88, 'Grimer', 'Poison', '', 'Pound', 'Disable', 'Poison Gas', 'Minimize'),
(27, 87, 'Dewgong', 'Water', 'Ice', 'Aurora Beam', 'Rest', 'Take Down', 'Ice Beam'),
(28, 86, 'Seel', 'Water', '', 'Head Butt', 'Growl', 'Aurora Beam', 'Rest'),
(29, 85, 'Dodrio', 'Normal', 'Flying', 'Drill Peck', 'Rage', 'Tri Attack', 'Agility'),
(30, 84, 'Doduo', 'Normal', 'Flying', 'Peck', 'Growl', 'Fury Attack', 'Drill Peck'),
(31, 83, 'Farfetch\'d', 'Normal', 'Flying', 'Fury Attack', 'Swords Dance', 'Agility', 'Slash'),
(32, 82, 'Magneton', 'Electric', 'Steel', 'Supersonic', 'Thunder Wave', 'Swift', 'Screech'),
(33, 81, 'Magnemite', 'Electric', 'Steel', 'Tackle', 'Sonic Boom', 'Thundershock', 'Supersonic'),
(34, 80, 'Slowbro', 'Water', 'Psychic', 'Growl', 'Water Gun', 'Amnesia', 'Psychic'),
(35, 79, 'Slowpoke', 'Water', 'Psychic', 'Confusion', 'Disable', 'Head Butt', 'Growl'),
(36, 78, 'Rapidash', 'Fire', '', 'Growl', 'Fire Spin', 'Take Down', 'Agility'),
(37, 77, 'Ponyta', 'Fire', '', 'Ember', 'Tail Whip', 'Stomp', 'Growl'),
(38, 76, 'Golem', 'Rock', 'Ground', 'Self Destruct', 'Harden', 'Earthquake', 'Explosion'),
(39, 75, 'Graveler', 'Rock', 'Ground', 'Self Destruct', 'Harden', 'Earthquake', 'Explosion'),
(40, 74, 'Geodude', 'Rock', 'Ground', 'Tackle', 'Defense Curl', 'Rock Throw', 'Self Destruct'),
(41, 73, 'Tentacruel', 'Water', 'Poison', 'Constrict', 'Barrier', 'Screech', 'Hydro Pump'),
(42, 72, 'Tentacool', 'Water', 'Poison', 'Acid', 'Supersonic', 'Wrap', 'Poison Sting'),
(43, 71, 'Victreebel', 'Grass', 'Poison', 'Stun Spore', 'Acid', 'Razor Leaf', 'Slam'),
(44, 70, 'Weepinbell', 'Grass', 'Poison', 'Stun Spore', 'Acid', 'Razor Leaf', 'Slam'),
(45, 69, 'Bellsprout', 'Grass', 'Poison', 'Vine Whip', 'Growth', 'Wrap', 'Poison Powder'),
(46, 68, 'Machamp', 'Fighting', '', 'Leer', 'Focus Energy', 'Seismic Toss', 'Submission'),
(47, 67, 'Machoke', 'Fighting', '', 'Leer', 'Focus Energy', 'Seismic Toss', 'Submission'),
(48, 66, 'Machop', 'Fighting', '', 'Karate Chop', 'Low Kick', 'Leer', 'Focus Energy'),
(49, 65, 'Alakazam', 'Psychic', '', 'Psybeam', 'Recover', 'Psychic', 'Reflect'),
(50, 64, 'Kadabra', 'Psychic', '', 'Teleport', 'Confusion', 'Disable', 'Psybeam'),
(51, 63, 'Abra', 'Psychic', '', 'Teleport', 'Teleport', 'Teleport', 'Teleport'),
(52, 62, 'Poliwrath', 'Water', 'Fighting', 'Doubleslap', 'Body Slam', 'Amnesia', 'Hydro Pump'),
(53, 61, 'Poliwhirl', 'Water', '', 'Doubleslap', 'Body Slam', 'Amnesia', 'Hydro Pump'),
(54, 60, 'Poliwag', 'Water', '', 'Bubble', 'Hypnosis', 'Water Gun', 'Doubleslap'),
(55, 59, 'Arcanine', 'Fire', '', 'Leer', 'Take Down', 'Agility', 'Flamethrower'),
(56, 58, 'Growlithe', 'Fire', '', 'Bite', 'Roar', 'Ember', 'Leer'),
(57, 57, 'Primeape', 'Fighting', '', 'Fury Attack', 'Focus Energy', 'Seismic Toss', 'Thrash'),
(58, 56, 'Mankey', 'Fighting', '', 'Scratch', 'Leer', 'Karate Chop', 'Fury Attack'),
(59, 55, 'Golduck', 'Water', '', 'Disable', 'Confusion', 'Fury Swipes', 'Hydro Pump'),
(60, 54, 'Psyduck', 'Water', '', 'Scratch', 'Tail Whip', 'Disable', 'Confusion'),
(61, 53, 'Persian', 'Normal', '', 'Pay Day', 'Screech', 'Fury Swipes', 'Slash'),
(62, 52, 'Meowth', 'Normal', '', 'Scratch', 'Growl', 'Bite', 'Pay Day'),
(63, 51, 'Dugtrio', 'Ground', '', 'Dig', 'Sand Attack', 'Slash', 'Earthquake'),
(64, 50, 'Diglett', 'Ground', '', 'Scratch', 'Growl', 'Dig', 'Sand Attack'),
(65, 49, 'Venomoth', 'Bug', 'Poison', 'Stun Spore', 'Psybeam', 'Sleep Powder', 'Psychic'),
(66, 48, 'Venonat', 'Bug', 'Poison', 'Tackle', 'Disable', 'Poison Powder', 'Leech Life'),
(67, 47, 'Parasect', 'Bug', 'Grass', 'Leech Life', 'Spore', 'Slash', 'Growth'),
(68, 46, 'Paras', 'Bug', 'Grass', 'Scratch', 'Stun Spore', 'Leech Life', 'Spore'),
(69, 45, 'Vileplume', 'Grass', 'Poison', 'Sleep Powder', 'Acid', 'Petal Dance', 'Solar Beam'),
(70, 44, 'Gloom', 'Grass', 'Poison', 'Sleep Powder', 'Acid', 'Petal Dance', 'Solar Beam'),
(71, 43, 'Oddish', 'Grass', 'Poison', 'Absorb', 'Poison Powder', 'Stun Spore', 'Sleep Powder'),
(72, 42, 'Golbat', 'Poison', 'Flying', 'Bite', 'Confuse Ray', 'Wing Attack', 'Haze'),
(73, 41, 'Zubat', 'Poison', 'Flying', 'Leech Life', 'Supersonic', 'Bite', 'Confuse Ray'),
(74, 40, 'Wigglytuff', 'Normal', '', 'Doubleslap', 'Rest', 'Body Slam', 'Double Edge'),
(75, 39, 'Jigglypuff', 'Normal', '', 'Sing', 'Pound', 'Disable', 'Defense Curl'),
(76, 38, 'Ninetales', 'Fire', '', 'Roar', 'Confuse Ray', 'Flamethrower', 'Fire Spin'),
(77, 37, 'Vulpix', 'Fire', '', 'Ember', 'Tail Whip', 'Quick Attack', 'Roar'),
(78, 36, 'Clefable', 'Normal', '', 'Minimize', 'Metronome', 'Defense Curl', 'Light Screen'),
(79, 35, 'Clefairy', 'Normal', '', 'Pound', 'Growl', 'Sing', 'Doubleslap'),
(80, 34, 'Nidoking', 'Poison', 'Ground', 'Fury Attack', 'Horn Drill', 'Double Kick', 'Thrash'),
(81, 33, 'Nidorino', 'Poison', '', 'Focus Energy', 'Fury Attack', 'Horn Drill', 'Double Kick'),
(82, 32, 'Nidoran (m)', 'Poison', '', 'Leer', 'Tackle', 'Horn Attack', 'Poison Sting'),
(83, 31, 'Nidoqueen', 'Poison', 'Ground', 'Fury Swipes', 'Double Kick', 'Poison Sting', 'Body Slam'),
(84, 30, 'Nidorina', 'Poison', '', 'Tail Whip', 'Bite', 'Fury Swipes', 'Double Kick'),
(85, 29, 'Nidoran (f)', 'Poison', '', 'Growl', 'Tackle', 'Scratch', 'Poison Sting'),
(86, 28, 'Sandslash', 'Ground', '', 'Slash', 'Poison Sting', 'Swift', 'Fury Swipes'),
(87, 27, 'Sandshrew', 'Ground', '', 'Scratch', 'Sand Attack', 'Slash', 'Poison Sting'),
(88, 26, 'Raichu', 'Electric', '', 'Quick Attack', 'Swift', 'Agility', 'Thunder'),
(89, 25, 'Pikachu', 'Electric', '', 'Thundershock', 'Growl', 'Thunder Wave', 'Quick Attack'),
(90, 24, 'Arbok', 'Poison', '', 'Bite', 'Glare', 'Screech', 'Acid'),
(91, 23, 'Ekans', 'Poison', '', 'Wrap', 'Leer', 'Poison Sting', 'Bite'),
(92, 22, 'Fearow', 'Normal', 'Flying', 'Fury Attack', 'Mirror Move', 'Drill Peck', 'Agility'),
(93, 21, 'Spearow', 'Normal', 'Flying', 'Peck', 'Growl', 'Leer', 'Fury Attack'),
(94, 20, 'Raticate', 'Normal', '', 'Quick Attack', 'Hyper Fang', 'Focus Energy', 'Super Fang'),
(95, 19, 'Rattata', 'Normal', '', 'Tackle', 'Tail Whip', 'Quick Attack', 'Hyper Fang'),
(96, 18, 'Pidgeot', 'Normal', 'Flying', 'Whirlwind', 'Wing Attack', 'Agility', 'Mirror Move'),
(97, 17, 'Pidgeotto', 'Normal', 'Flying', 'Whirlwind', 'Wing Attack', 'Agility', 'Mirror Move'),
(98, 16, 'Pidgey', 'Normal', 'Flying', 'Gust', 'Sand Attack', 'Quick Attack', 'Whirlwind'),
(99, 15, 'Beedrill', 'Bug', 'Poison', 'Twineedle', 'Rage', 'Pin Missile', 'Agility'),
(100, 14, 'Kakuna', 'Bug', 'Poison', 'Poison Sting', 'Harden', 'String Shot', 'String Shot'),
(101, 13, 'Weedle', 'Bug', 'Poison', 'Poison Sting', 'String Shot', 'String Shot', 'String Shot'),
(102, 12, 'Butterfree', 'Bug', 'Flying', 'Sleep Powder', 'Supersonic', 'Whirlwind', 'Psybeam'),
(103, 11, 'Metapod', 'Bug', '', 'Tackle', 'Harden', 'String Shot', 'String Shot'),
(104, 10, 'Caterpie', 'Bug', '', 'Tackle', 'String Shot', 'String Shot', 'String Shot'),
(105, 9, 'Blastoise', 'Water', '', 'Bite', 'Withdraw', 'Skull Bash', 'Hydro Pump'),
(106, 8, 'Wartortle', 'Water', '', 'Water Gun', 'Bite', 'Withdraw', 'Skull Bash'),
(107, 7, 'Squirtle', 'Water', '', 'Tackle', 'Tail Whip', 'Bubble', 'Water Gun'),
(108, 6, 'Charizard', 'Fire', 'Flying', 'Rage', 'Slash', 'Flamethrower', 'Fire Spin'),
(109, 5, 'Charmeleon', 'Fire', '', 'Leer', 'Rage', 'Slash', 'Flamethrower'),
(110, 4, 'Charmander', 'Fire', '', 'Scratch', 'Growl', 'Ember', 'Leer'),
(111, 3, 'Venusaur', 'Grass', 'Poison', 'Razor Leaf', 'Growth', 'Sleep Powder', 'Solar Beam'),
(112, 2, 'Ivysaur', 'Grass', 'Poison', 'Vine Whip', 'Poison Powder', 'Razor Leaf', 'Growth'),
(113, 1, 'Bulbasaur', 'Grass', 'Poison', 'Tackle', 'Growl', 'Leech Seed', 'Vine Whip'),
(114, 114, 'Tangela', 'Grass', '', 'Stun Spore', 'Sleep Powder', 'Slam', 'Growth'),
(115, 115, 'Kangaskhan', 'Normal', '', 'Tail Whip', 'Mega Punch', 'Leer', 'Dizzy Punch'),
(116, 116, 'Horsea', 'Water', '', 'Bubble', 'Smoke Screen', 'Leer', 'Water Gun'),
(117, 117, 'Seadra', 'Water', '', 'Leer', 'Water Gun', 'Agility', 'Hydro Pump'),
(118, 118, 'Goldeen', 'Water', '', 'Peck', 'Tail Whip', 'Supersonic', 'Horn Attack'),
(119, 119, 'Seaking', 'Water', '', 'Fury Attack', 'Waterfall', 'Horn Drill', 'Agility'),
(120, 120, 'Staryu', 'Water', '', 'Tackle', 'Water Gun', 'Harden', 'Recover'),
(121, 121, 'Starmie', 'Water', 'Psychic', 'Swift', 'Minimize', 'Light Screen', 'Hydro Pump'),
(122, 122, 'Mr. Mime', 'Psychic', '', 'Light Screen', 'Doubleslap', 'Meditate', 'Substitute'),
(123, 123, 'Scyther', 'Bug', 'Flying', 'Double Team', 'Slash', 'Swords Dance', 'Agility'),
(124, 124, 'Jynx', 'Ice', 'Psychic', 'Doubleslap', 'Ice Punch', 'Meditate', 'Blizzard'),
(125, 125, 'Electabuzz', 'Electric', '', 'Screech', 'Thunder Punch', 'Light Screen', 'Thunder'),
(126, 126, 'Magmar', 'Fire', '', 'Fire Punch', 'Smoke Screen', 'Smog', 'Flamethrower'),
(127, 127, 'Pinsir', 'Bug', '', 'Focus Energy', 'Harden', 'Slash', 'Swords Dance'),
(128, 128, 'Tauros', 'Normal', '', 'Tail Whip', 'Leer', 'Rage', 'Take Down'),
(129, 129, 'Magikarp', 'Water', '', 'Tackle', 'Splash', 'Splash', 'Splash'),
(130, 130, 'Gyarados', 'Water', 'Flying', 'Dragon Rage', 'Leer', 'Hydro Pump', 'Hyper Beam'),
(131, 131, 'Lapras', 'Water', 'Ice', 'Body Slam', 'Confuse Ray', 'Ice Beam', 'Hydro Pump'),
(132, 132, 'Ditto', 'Normal', '', 'Transform', 'Transform', 'Transform', 'Transform'),
(133, 133, 'Eevee', 'Normal', '', 'Quick Attack', 'Tail Whip', 'Bite', 'Take Down'),
(134, 134, 'Vaporeon', 'Water', '', 'Acid Armor', 'Haze', 'Mist', 'Hydro Pump'),
(135, 135, 'Jolteon', 'Electric', '', 'Double Kick', 'Agility', 'Pin Missile', 'Thunder'),
(136, 136, 'Flareon', 'Fire', '', 'Leer', 'Fire Spin', 'Rage', 'Flamethrower'),
(137, 137, 'Porygon', 'Normal', '', 'Psybeam', 'Recover', 'Agility', 'Tri Attack'),
(138, 138, 'Omanyte', 'Rock', 'Water', 'Water Gun', 'Withdraw', 'Horn Attack', 'Leer'),
(139, 139, 'Omastar', 'Rock', 'Water', 'Horn Attack', 'Leer', 'Spike Cannon', 'Hydro Pump'),
(140, 140, 'Kabuto', 'Rock', 'Water', 'Scratch', 'Harden', 'Absorb', 'Slash'),
(141, 141, 'Kabutops', 'Rock', 'Water', 'Absorb', 'Slash', 'Leer', 'Hydro Pump'),
(142, 142, 'Aerodactyl', 'Rock', 'Flying', 'Supersonic', 'Bite', 'Take Down', 'Hyper Beam'),
(143, 143, 'Snorlax', 'Normal', '', 'Body Slam', 'Harden', 'Double Edge', 'Hyper Beam'),
(144, 144, 'Articuno', 'Ice', 'Flying', 'Ice Beam', 'Blizzard', 'Agility', 'Mist'),
(145, 145, 'Zapdos', 'Electric', 'Flying', 'Drill Peck', 'Thunder', 'Agility', 'Light Screen'),
(146, 146, 'Moltres', 'Fire', 'Flying', 'Fire Spin', 'Leer', 'Agility', 'Sky Attack'),
(147, 147, 'Dratini', 'Dragon', '', 'Wrap', 'Leer', 'Thunder Wave', 'Agility'),
(148, 148, 'Dragonair', 'Dragon', '', 'Agility', 'Slam', 'Dragon Rage', 'Hyper Beam'),
(149, 149, 'Dragonite', 'Dragon', 'Flying', 'Agility', 'Slam', 'Dragon Rage', 'Hyper Beam'),
(150, 150, 'Mewtwo', 'Psychic', '', 'Psychic', 'Recover', 'Mist', 'Amnesia'),
(151, 151, 'Mew', 'Psychic', '', 'Transform', 'Mega Punch', 'Metronome', 'Psychic'),
(158, 152, 'Chikorita', 'Grass', '', 'Scratch', 'Growl', 'Absorb', 'Tackle'),
(159, 153, 'Bayleef', 'Grass', '', 'Razor Leaf', 'Mega Drain', 'Body Slam', 'Tackle'),
(160, 154, 'Meganium', 'Grass', '', 'Solar Beam', 'Vine Whip', 'Razor Leaf', 'Razor Leaf'),
(161, 155, 'Cyndaquil', 'Fire', '', 'Fire Blast', 'Flamethrower', 'Flamethrower', 'Fire Blast'),
(162, 156, 'Quilava', 'Fire', '', 'Fire Blast', 'Fire Blast', 'Ember', 'Ember'),
(163, 157, 'Typhlosion', 'Fire', '', 'Fire Spin', 'Fire Punch', 'Ember', 'Ember'),
(164, 158, 'Totodile', 'Water', '', 'Water Gun', 'Hydro Pump', 'Bubble', 'Waterfall'),
(165, 159, 'Croconaw', 'Water', '', 'Waterfall', 'Water Gun', 'Clamp', 'Bubblebeam'),
(166, 160, 'Feraligatr', 'Water', '', 'Bubblebeam', 'Bubble', 'Waterfall', 'Clamp'),
(167, 161, 'Sentret', 'Normal', '', 'Stomp', 'Scratch', 'Fury Attack', 'Scratch'),
(168, 162, 'Furret', 'Normal', '', 'Double Edge', 'Explosion', 'Fury Attack', 'Take Down'),
(169, 163, 'Hoothoot', 'Normal', '', 'Body Slam', 'Fury Attack', 'Fury Attack', 'Self Destruct'),
(170, 164, 'Noctowl', 'Normal', '', 'Vice Grip', 'Doubleslap', 'Razor Wind', 'Spike Cannon'),
(171, 165, 'Ledyba', 'Bug', '', 'Leech Life', 'Leech Life', 'Leech Life', 'Leech Life'),
(172, 166, 'Ledian', 'Bug', '', 'Leech Life', 'Pin Missile', 'Pin Missile', 'Pin Missile'),
(173, 167, 'Spinarak', 'Bug', '', 'Pin Missile', 'Leech Life', 'Leech Life', 'Twineedle'),
(174, 168, 'Ariados', 'Bug', '', 'Twineedle', 'Twineedle', 'Twineedle', 'Pin Missile'),
(175, 169, 'Crobat', 'Poison', '', 'Smog', 'Sludge', 'Poison Sting', 'Smog'),
(176, 170, 'Chinchou', 'Water', '', 'Bubblebeam', 'Waterfall', 'Hydro Pump', 'Crab Hammer'),
(177, 171, 'Lanturn', 'Water', '', 'Waterfall', 'Surf', 'Surf', 'Bubblebeam'),
(178, 172, 'Pichu', 'Electric', '', 'Thunderbolt', 'Thunderbolt', 'Thunder', 'Thunder'),
(179, 173, 'Cleffa', 'Normal', '', 'Slash', 'Swift', 'Double Edge', 'Strength'),
(180, 174, 'Igglybuff', 'Normal', '', 'Dizzy Punch', 'Egg Bomb', 'Vice Grip', 'Fury Swipes'),
(181, 175, 'Togepi', 'Normal', '', 'Hyper Fang', 'Doubleslap', 'Explosion', 'Slash'),
(182, 176, 'Togetic', 'Normal', '', 'Take Down', 'Skull Bash', 'Pay Day', 'Double Edge'),
(183, 177, 'Natu', 'Psychic', '', 'Psychic', 'Confusion', 'Psychic', 'Psybeam'),
(184, 178, 'Xatu', 'Psychic', '', 'Psychic', 'Dream Eater', 'Psychic', 'Confusion'),
(185, 179, 'Mareep', 'Electric', '', 'Thunderbolt', 'Thunderbolt', 'Thundershock', 'Thundershock'),
(186, 180, 'Flaaffy', 'Electric', '', 'Thundershock', 'Thundershock', 'Thundershock', 'Thunderbolt'),
(187, 181, 'Ampharos', 'Electric', '', 'Thunderbolt', 'Thunder Punch', 'Thundershock', 'Thundershock'),
(188, 182, 'Bellossom', 'Grass', '', 'Solar Beam', 'Solar Beam', 'Absorb', 'Petal Dance'),
(189, 183, 'Marill', 'Water', '', 'Hydro Pump', 'Crab Hammer', 'Clamp', 'Hydro Pump'),
(190, 184, 'Azumarill', 'Water', '', 'Bubblebeam', 'Bubblebeam', 'Waterfall', 'Bubblebeam'),
(191, 185, 'Sudowoodo', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(192, 186, 'Politoed', 'Water', '', 'Hydro Pump', 'Water Gun', 'Crab Hammer', 'Hydro Pump'),
(193, 187, 'Hoppip', 'Grass', '', 'Petal Dance', 'Vine Whip', 'Petal Dance', 'Petal Dance'),
(194, 188, 'Skiploom', 'Grass', '', 'Absorb', 'Absorb', 'Vine Whip', 'Vine Whip'),
(195, 189, 'Jumpluff', 'Grass', '', 'Mega Drain', 'Solar Beam', 'Petal Dance', 'Mega Drain'),
(196, 190, 'Aipom', 'Normal', '', 'Razor Wind', 'Pay Day', 'Thrash', 'Skull Bash'),
(197, 191, 'Sunkern', 'Grass', '', 'Petal Dance', 'Petal Dance', 'Razor Leaf', 'Mega Drain'),
(198, 192, 'Sunflora', 'Grass', '', 'Solar Beam', 'Absorb', 'Absorb', 'Solar Beam'),
(199, 193, 'Yanma', 'Bug', '', 'Twineedle', 'Leech Life', 'Twineedle', 'Twineedle'),
(200, 194, 'Wooper', 'Water', '', 'Clamp', 'Bubble', 'Bubble', 'Clamp'),
(201, 195, 'Quagsire', 'Water', '', 'Bubblebeam', 'Hydro Pump', 'Hydro Pump', 'Bubble'),
(202, 196, 'Espeon', 'Psychic', '', 'Confusion', 'Psychic', 'Psybeam', 'Dream Eater'),
(203, 197, 'Umbreon', 'Dark', '', 'Shadow Armlet', 'Shadow Armlet', 'Lick', 'Lick'),
(204, 198, 'Murkrow', 'Dark', '', 'Lick', 'Lick', 'Lick', 'Lick'),
(205, 199, 'Slowking', 'Water', '', 'Surf', 'Crab Hammer', 'Clamp', 'Surf'),
(206, 200, 'Misdreavus', 'Ghost', '', 'Lick', 'Lick', 'Lick', 'Shadow Armlet'),
(208, 202, 'Wobbuffet', 'Psychic', '', 'Confusion', 'Psybeam', 'Dream Eater', 'Psychic'),
(209, 203, 'Girafarig', 'Normal', '', 'Mega Kick', 'Skull Bash', 'Stomp', 'Explosion'),
(210, 204, 'Pineco', 'Bug', '', 'Pin Missile', 'Leech Life', 'Pin Missile', 'Leech Life'),
(211, 205, 'Forretress', 'Bug', '', 'Leech Life', 'Leech Life', 'Pin Missile', 'Pin Missile'),
(212, 206, 'Dunsparce', 'Normal', '', 'Constrict', 'Cut', 'Mega Punch', 'Mega Kick'),
(213, 207, 'Gligar', 'Ground', '', 'Bonemerang', 'Bonemerang', 'Bonemerang', 'Earthquake'),
(214, 208, 'Steelix', 'Steel', '', 'Rock Slide', 'Rock Slide', 'Rock Throw', 'Rock Throw'),
(215, 209, 'Snubbull', 'Normal', '', 'Barrage', 'Strength', 'Quick Attack', 'Razor Wind'),
(216, 210, 'Granbull', 'Normal', '', 'Cut', 'Vice Grip', 'Cut', 'Take Down'),
(217, 211, 'Qwilfish', 'Water', '', 'Waterfall', 'Bubble', 'Waterfall', 'Bubble'),
(218, 212, 'Scizor', 'Bug', '', 'Leech Life', 'Pin Missile', 'Twineedle', 'Twineedle'),
(219, 213, 'Shuckle', 'Bug', '', 'Twineedle', 'Leech Life', 'Pin Missile', 'Pin Missile'),
(220, 214, 'Heracross', 'Bug', '', 'Twineedle', 'Twineedle', 'Pin Missile', 'Leech Life'),
(221, 215, 'Sneasel', 'Dark', '', 'Shadow Armlet', 'Lick', 'Lick', 'Lick'),
(222, 216, 'Teddiursa', 'Normal', '', 'Bind', 'Hyper Beam', 'Skull Bash', 'Horn Attack'),
(223, 217, 'Ursaring', 'Normal', '', 'Mega Punch', 'Rage', 'Thrash', 'Doubleslap'),
(224, 218, 'Slugma', 'Fire', '', 'Fire Spin', 'Fire Blast', 'Fire Punch', 'Flamethrower'),
(225, 219, 'Magcargo', 'Fire', '', 'Fire Punch', 'Ember', 'Fire Blast', 'Flamethrower'),
(226, 220, 'Swinub', 'Ice', '', 'Blizzard', 'Ice Punch', 'Blizzard', 'Aurora Beam'),
(227, 221, 'Piloswine', 'Ice', '', 'Ice Punch', 'Blizzard', 'Blizzard', 'Aurora Beam'),
(228, 222, 'Corsola', 'Water', '', 'Water Gun', 'Crab Hammer', 'Surf', 'Clamp'),
(229, 223, 'Remoraid', 'Water', '', 'Waterfall', 'Water Gun', 'Bubble', 'Crab Hammer'),
(230, 224, 'Octillery', 'Water', '', 'Bubble', 'Water Gun', 'Crab Hammer', 'Waterfall'),
(231, 225, 'Delibird', 'Ice', '', 'Ice Punch', 'Blizzard', 'Aurora Beam', 'Aurora Beam'),
(232, 226, 'Mantine', 'Water', '', 'Bubblebeam', 'Bubble', 'Bubble', 'Bubblebeam'),
(233, 227, 'Skarmory', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Throw', 'Rock Slide'),
(234, 228, 'Houndour', 'Dark', '', 'Shadow Armlet', 'Lick', 'Shadow Armlet', 'Lick'),
(235, 229, 'Houndoom', 'Dark', '', 'Lick', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(236, 230, 'Kingdra', 'Water', '', 'Waterfall', 'Bubble', 'Hydro Pump', 'Crab Hammer'),
(237, 231, 'Phanpy', 'Ground', '', 'Dig', 'Bone Club', 'Dig', 'Dig'),
(238, 232, 'Donphan', 'Ground', '', 'Dig', 'Dig', 'Earthquake', 'Bone Club'),
(239, 233, 'Porygon2', 'Normal', '', 'Barrage', 'Tackle', 'Mega Kick', 'Double Edge'),
(240, 234, 'Stantler', 'Normal', '', 'Mega Kick', 'Slam', 'Slam', 'Bind'),
(241, 235, 'Smeargle', 'Normal', '', 'Tackle', 'Dizzy Punch', 'Vice Grip', 'Body Slam'),
(242, 236, 'Tyrogue', 'Fighting', '', 'Rolling Kick', 'Submission', 'Rolling Kick', 'Double Kick'),
(243, 237, 'Hitmontop', 'Fighting', '', 'Double Kick', 'Submission', 'Karate Chop', 'Jump Kick'),
(244, 238, 'Smoochum', 'Ice', '', 'Blizzard', 'Blizzard', 'Ice Beam', 'Ice Beam'),
(245, 239, 'Elekid', 'Electric', '', 'Thunderbolt', 'Thundershock', 'Thunder', 'Thunder Punch'),
(246, 240, 'Magby', 'Fire', '', 'Ember', 'Flamethrower', 'Fire Spin', 'Flamethrower'),
(247, 241, 'Miltank', 'Normal', '', 'Swift', 'Wrap', 'Dizzy Punch', 'Mega Kick'),
(248, 242, 'Blissey', 'Normal', '', 'Blizzard', 'Splash', 'Splash', 'Splash'),
(249, 243, 'Raikou', 'Electric', '', 'Thundershock', 'Thunderbolt', 'Thunderbolt', 'Thunderbolt'),
(250, 244, 'Entei', 'Fire', '', 'Ember', 'Fire Blast', 'Flamethrower', 'Fire Blast'),
(251, 245, 'Suicune', 'Water', '', 'Surf', 'Bubblebeam', 'Clamp', 'Clamp'),
(252, 246, 'Larvitar', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(253, 247, 'Pupitar', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(254, 248, 'Tyranitar', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Slide'),
(255, 249, 'Lugia', 'Psychic', '', 'Confusion', 'Confusion', 'Confusion', 'Psybeam'),
(256, 250, 'Ho-oh', 'Fire', '', 'Flamethrower', 'Fire Spin', 'Ember', 'Flamethrower'),
(257, 251, 'Celebi', 'Psychic', '', 'Psychic', 'Confusion', 'Psychic', 'Confusion'),
(258, 252, 'Treecko', 'Grass', '', 'Petal Dance', 'Vine Whip', 'Solar Beam', 'Solar Beam'),
(259, 253, 'Grovyle', 'Grass', '', 'Solar Beam', 'Petal Dance', 'Solar Beam', 'Mega Drain'),
(260, 254, 'Sceptile', 'Grass', '', 'Vine Whip', 'Razor Leaf', 'Solar Beam', 'Mega Drain'),
(261, 255, 'Torchic', 'Fire', '', 'Ember', 'Flamethrower', 'Fire Punch', 'Fire Punch'),
(262, 256, 'Combusken', 'Fire', '', 'Ember', 'Fire Blast', 'Fire Blast', 'Fire Blast'),
(263, 257, 'Blaziken', 'Fire', '', 'Fire Spin', 'Fire Blast', 'Flamethrower', 'Ember'),
(264, 258, 'Mudkip', 'Water', '', 'Waterfall', 'Bubble', 'Bubblebeam', 'Hydro Pump'),
(265, 259, 'Marshtomp', 'Water', '', 'Clamp', 'Water Gun', 'Waterfall', 'Waterfall'),
(266, 260, 'Swampert', 'Water', '', 'Hydro Pump', 'Clamp', 'Clamp', 'Water Gun'),
(267, 261, 'Poochyena', 'Dark', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(268, 262, 'Mightyena', 'Dark', '', 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet'),
(269, 263, 'Zigzagoon', 'Normal', '', 'Swift', 'Cut', 'Doubleslap', 'Swift'),
(270, 264, 'Linoone', 'Normal', '', 'Wrap', 'Spike Cannon', 'Hyper Fang', 'Slam'),
(271, 265, 'Wurmple', 'Bug', '', 'Leech Life', 'Twineedle', 'Pin Missile', 'Leech Life'),
(272, 266, 'Silcoon', 'Bug', '', 'Pin Missile', 'Twineedle', 'Twineedle', 'Pin Missile'),
(273, 267, 'Beautifly', 'Bug', '', 'Pin Missile', 'Pin Missile', 'Pin Missile', 'Leech Life'),
(274, 268, 'Cascoon', 'Bug', '', 'Pin Missile', 'Leech Life', 'Pin Missile', 'Leech Life'),
(275, 269, 'Dustox', 'Bug', '', 'Twineedle', 'Pin Missile', 'Twineedle', 'Pin Missile'),
(276, 270, 'Lotad', 'Water', '', 'Hydro Pump', 'Hydro Pump', 'Bubblebeam', 'Waterfall'),
(277, 271, 'Lombre', 'Water', '', 'Bubble', 'Water Gun', 'Surf', 'Waterfall'),
(278, 272, 'Ludicolo', 'Water', '', 'Hydro Pump', 'Crab Hammer', 'Crab Hammer', 'Crab Hammer'),
(279, 273, 'Seedot', 'Grass', '', 'Solar Beam', 'Absorb', 'Absorb', 'Razor Leaf'),
(280, 274, 'Nuzleaf', 'Grass', '', 'Mega Drain', 'Solar Beam', 'Mega Drain', 'Vine Whip'),
(281, 275, 'Shiftry', 'Grass', '', 'Petal Dance', 'Vine Whip', 'Razor Leaf', 'Razor Leaf'),
(282, 276, 'Taillow', 'Normal', '', 'Horn Attack', 'Vice Grip', 'Rage', 'Comet Punch'),
(283, 277, 'Swellow', 'Normal', '', 'Head Butt', 'Barrage', 'Tackle', 'Constrict'),
(284, 278, 'Wingull', 'Water', '', 'Waterfall', 'Bubble', 'Bubblebeam', 'Surf'),
(285, 279, 'Pelipper', 'Water', '', 'Water Gun', 'Waterfall', 'Waterfall', 'Hydro Pump'),
(286, 280, 'Ralts', 'Psychic', '', 'Psybeam', 'Confusion', 'Dream Eater', 'Dream Eater'),
(287, 281, 'Kirlia', 'Psychic', '', 'Psychic', 'Confusion', 'Dream Eater', 'Dream Eater'),
(288, 282, 'Gardevoir', 'Psychic', '', 'Confusion', 'Dream Eater', 'Dream Eater', 'Confusion'),
(289, 283, 'Surskit', 'Bug', '', 'Twineedle', 'Twineedle', 'Twineedle', 'Pin Missile'),
(290, 284, 'Masquerain', 'Bug', '', 'Pin Missile', 'Leech Life', 'Leech Life', 'Leech Life'),
(291, 285, 'Shroomish', 'Grass', '', 'Petal Dance', 'Vine Whip', 'Solar Beam', 'Razor Leaf'),
(292, 286, 'Breloom', 'Grass', '', 'Absorb', 'Vine Whip', 'Absorb', 'Vine Whip'),
(293, 287, 'Slakoth', 'Normal', '', 'Take Down', 'Skull Bash', 'Head Butt', 'Razor Wind'),
(294, 288, 'Vigoroth', 'Normal', '', 'Struggle', 'Scratch', 'Doubleslap', 'Strength'),
(295, 289, 'Slaking', 'Normal', '', 'Thrash', 'Slam', 'Stomp', 'Barrage'),
(296, 290, 'Nincada', 'Bug', '', 'Leech Life', 'Twineedle', 'Pin Missile', 'Pin Missile'),
(297, 291, 'Ninjask', 'Bug', '', 'Leech Life', 'Leech Life', 'Leech Life', 'Leech Life'),
(298, 292, 'Shedinja', 'Bug', '', 'Leech Life', 'Pin Missile', 'Twineedle', 'Leech Life'),
(299, 293, 'Whismur', 'Normal', '', 'Rage', 'Mega Punch', 'Wrap', 'Stomp'),
(300, 294, 'Loudred', 'Normal', '', 'Cut', 'Razor Wind', 'Tri Attack', 'Strength'),
(301, 295, 'Exploud', 'Normal', '', 'Tri Attack', 'Quick Attack', 'Body Slam', 'Tri Attack'),
(302, 296, 'Makuhita', 'Fighting', '', 'Submission', 'Submission', 'Rolling Kick', 'Jump Kick'),
(303, 297, 'Hariyama', 'Fighting', '', 'Jump Kick', 'Submission', 'Jump Kick', 'Jump Kick'),
(304, 298, 'Azurill', 'Normal', '', 'Skull Bash', 'Bind', 'Barrage', 'Mega Punch'),
(305, 299, 'Nosepass', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(306, 300, 'Skitty', 'Normal', '', 'Bind', 'Bite', 'Struggle', 'Swift'),
(307, 301, 'Delcatty', 'Normal', '', 'Pay Day', 'Tri Attack', 'Barrage', 'Hyper Beam'),
(308, 302, 'Sableye', 'Dark', '', 'Lick', 'Shadow Armlet', 'Shadow Armlet', 'Lick'),
(309, 303, 'Mawile', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Throw', 'Rock Throw'),
(310, 304, 'Aron', 'Steel', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Throw'),
(311, 305, 'Lairon', 'Steel', '', 'Rock Slide', 'Rock Slide', 'Rock Throw', 'Rock Slide'),
(312, 306, 'Aggron', 'Steel', '', 'Rock Slide', 'Rock Slide', 'Rock Slide', 'Rock Throw'),
(313, 307, 'Meditite', 'Fighting', '', 'Rolling Kick', 'Submission', 'Submission', 'Jump Kick'),
(314, 308, 'Medicham', 'Fighting', '', 'Rolling Kick', 'Rolling Kick', 'Submission', 'Jump Kick'),
(315, 309, 'Electrike', 'Electric', '', 'Thunder Punch', 'Thunder Punch', 'Thunder', 'Thundershock'),
(316, 310, 'Manectric', 'Electric', '', 'Thunder', 'Thunder', 'Thundershock', 'Thunder Punch'),
(317, 311, 'Plusle', 'Electric', '', 'Thundershock', 'Thunderbolt', 'Thunder', 'Thunderbolt'),
(318, 312, 'Minun', 'Electric', '', 'Thundershock', 'Thunderbolt', 'Thunder Punch', 'Thunder'),
(319, 313, 'Volbeat', 'Bug', '', 'Leech Life', 'Pin Missile', 'Leech Life', 'Twineedle'),
(320, 314, 'Illumise', 'Bug', '', 'Twineedle', 'Leech Life', 'Leech Life', 'Pin Missile'),
(321, 315, 'Roselia', 'Grass', '', 'Vine Whip', 'Razor Leaf', 'Vine Whip', 'Solar Beam'),
(322, 316, 'Gulpin', 'Poison', '', 'Acid', 'Poison Sting', 'Acid', 'Acid'),
(323, 317, 'Swalot', 'Poison', '', 'Smog', 'Acid', 'Sludge', 'Acid'),
(324, 318, 'Carvanha', 'Water', '', 'Bubble', 'Waterfall', 'Water Gun', 'Surf'),
(325, 319, 'Sharpedo', 'Water', '', 'Hydro Pump', 'Bubblebeam', 'Bubble', 'Bubblebeam'),
(326, 320, 'Wailmer', 'Water', '', 'Waterfall', 'Waterfall', 'Water Gun', 'Waterfall'),
(327, 321, 'Wailord', 'Water', '', 'Waterfall', 'Surf', 'Bubble', 'Water Gun'),
(328, 322, 'Numel', 'Fire', '', 'Flamethrower', 'Fire Punch', 'Fire Spin', 'Fire Spin'),
(329, 323, 'Camerupt', 'Fire', '', 'Fire Spin', 'Fire Spin', 'Flamethrower', 'Fire Blast'),
(330, 324, 'Torkoal', 'Fire', '', 'Ember', 'Flamethrower', 'Fire Spin', 'Fire Punch'),
(331, 325, 'Spoink', 'Psychic', '', 'Psychic', 'Dream Eater', 'Dream Eater', 'Confusion'),
(332, 326, 'Grumpig', 'Psychic', '', 'Dream Eater', 'Psybeam', 'Psychic', 'Dream Eater'),
(333, 327, 'Spinda', 'Normal', '', 'Cut', 'Fury Attack', 'Cut', 'Double Edge'),
(334, 328, 'Trapinch', 'Ground', '', 'Bone Club', 'Bone Club', 'Earthquake', 'Bonemerang'),
(335, 329, 'Vibrava', 'Ground', '', 'Bone Club', 'Earthquake', 'Bone Club', 'Bone Club'),
(336, 330, 'Flygon', 'Ground', '', 'Earthquake', 'Earthquake', 'Bonemerang', 'Bonemerang'),
(337, 331, 'Cacnea', 'Grass', '', 'Mega Drain', 'Razor Leaf', 'Mega Drain', 'Razor Leaf'),
(338, 332, 'Cacturne', 'Grass', '', 'Razor Leaf', 'Razor Leaf', 'Petal Dance', 'Razor Leaf'),
(339, 333, 'Swablu', 'Normal', '', 'Bind', 'Fury Attack', 'Mega Kick', 'Constrict'),
(340, 334, 'Altaria', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(341, 335, 'Zangoose', 'Normal', '', 'Doubleslap', 'Thrash', 'Pay Day', 'Double Edge'),
(342, 336, 'Seviper', 'Poison', '', 'Acid', 'Smog', 'Poison Sting', 'Smog'),
(343, 337, 'Lunatone', 'Rock', '', 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Slide'),
(344, 338, 'Solrock', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Throw', 'Rock Throw'),
(345, 339, 'Barboach', 'Water', '', 'Crab Hammer', 'Clamp', 'Water Gun', 'Waterfall'),
(346, 340, 'Whiscash', 'Water', '', 'Surf', 'Hydro Pump', 'Bubble', 'Surf'),
(347, 341, 'Corphish', 'Water', '', 'Water Gun', 'Waterfall', 'Bubble', 'Surf'),
(348, 342, 'Crawdaunt', 'Water', '', 'Surf', 'Bubble', 'Surf', 'Crab Hammer'),
(349, 343, 'Baltoy', 'Ground', '', 'Earthquake', 'Dig', 'Bonemerang', 'Dig'),
(350, 344, 'Claydol', 'Ground', '', 'Earthquake', 'Dig', 'Dig', 'Dig'),
(351, 345, 'Lileep', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Throw'),
(352, 346, 'Cradily', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Throw', 'Rock Throw'),
(353, 347, 'Anorith', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(354, 348, 'Armaldo', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(355, 349, 'Feebas', 'Water', '', 'Hydro Pump', 'Surf', 'Crab Hammer', 'Bubble'),
(356, 350, 'Milotic', 'Water', '', 'Surf', 'Bubble', 'Bubblebeam', 'Surf'),
(357, 351, 'Castform', 'Normal', '', 'Mega Punch', 'Take Down', 'Cut', 'Body Slam'),
(358, 352, 'Kecleon', 'Normal', '', 'Mega Punch', 'Bind', 'Egg Bomb', 'Tri Attack'),
(359, 353, 'Shuppet', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Lick'),
(360, 354, 'Banette', 'Ghost', '', 'Lick', 'Lick', 'Lick', 'Shadow Armlet'),
(361, 355, 'Duskull', 'Ghost', '', 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet'),
(362, 356, 'Dusclops', 'Ghost', '', 'Lick', 'Shadow Armlet', 'Shadow Armlet', 'Lick'),
(363, 357, 'Tropius', 'Grass', '', 'Absorb', 'Razor Leaf', 'Absorb', 'Absorb'),
(364, 358, 'Chimecho', 'Psychic', '', 'Psybeam', 'Psychic', 'Psychic', 'Psybeam'),
(365, 359, 'Absol', 'Dark', '', 'Shadow Armlet', 'Shadow Armlet', 'Lick', 'Lick'),
(366, 360, 'Wynaut', 'Psychic', '', 'Confusion', 'Psybeam', 'Psychic', 'Psybeam'),
(367, 361, 'Snorunt', 'Ice', '', 'Aurora Beam', 'Ice Beam', 'Blizzard', 'Aurora Beam'),
(368, 362, 'Glalie', 'Ice', '', 'Aurora Beam', 'Ice Punch', 'Ice Punch', 'Aurora Beam'),
(369, 363, 'Spheal', 'Ice', '', 'Aurora Beam', 'Ice Punch', 'Ice Beam', 'Ice Beam'),
(370, 364, 'Sealeo', 'Ice', '', 'Aurora Beam', 'Ice Beam', 'Aurora Beam', 'Ice Beam'),
(371, 365, 'Walrein', 'Ice', '', 'Aurora Beam', 'Ice Beam', 'Ice Punch', 'Blizzard'),
(372, 366, 'Clamperl', 'Water', '', 'Surf', 'Bubble', 'Crab Hammer', 'Waterfall'),
(373, 367, 'Huntail', 'Water', '', 'Crab Hammer', 'Crab Hammer', 'Hydro Pump', 'Bubble'),
(374, 368, 'Gorebyss', 'Water', '', 'Hydro Pump', 'Water Gun', 'Crab Hammer', 'Bubble'),
(375, 369, 'Relicanth', 'Water', '', 'Crab Hammer', 'Bubblebeam', 'Water Gun', 'Waterfall'),
(376, 370, 'Luvdisc', 'Water', '', 'Crab Hammer', 'Bubble', 'Clamp', 'Bubblebeam'),
(377, 371, 'Bagon', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(378, 372, 'Shelgon', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(379, 373, 'Salamence', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(380, 374, 'Beldum', 'Steel', '', 'Rock Slide', 'Rock Slide', 'Rock Slide', 'Rock Slide'),
(381, 375, 'Metang', 'Steel', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(382, 376, 'Metagross', 'Steel', '', 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(383, 377, 'Regirock', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Slide'),
(384, 378, 'Regice', 'Ice', '', 'Aurora Beam', 'Aurora Beam', 'Blizzard', 'Ice Beam'),
(385, 379, 'Registeel', 'Steel', '', 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(386, 380, 'Latias', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(387, 381, 'Latios', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(388, 382, 'Kyogre', 'Water', '', 'Surf', 'Hydro Pump', 'Surf', 'Crab Hammer'),
(389, 383, 'Groudon', 'Ground', '', 'Bone Club', 'Bone Club', 'Bonemerang', 'Dig'),
(390, 384, 'Rayquaza', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(391, 385, 'Jirachi', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Throw', 'Rock Slide'),
(392, 386, 'Deoxys', 'Psychic', '', 'Confusion', 'Psychic', 'Psychic', 'Dream Eater'),
(393, 387, 'Turtwig', 'Grass', '', 'Petal Dance', 'Mega Drain', 'Mega Drain', 'Vine Whip'),
(394, 388, 'Grotle', 'Grass', '', 'Petal Dance', 'Mega Drain', 'Absorb', 'Mega Drain'),
(395, 389, 'Torterra', 'Grass', '', 'Razor Leaf', 'Razor Leaf', 'Absorb', 'Vine Whip'),
(396, 390, 'Chimchar', 'Fire', '', 'Fire Blast', 'Flamethrower', 'Fire Spin', 'Ember'),
(397, 391, 'Monferno', 'Fire', '', 'Flamethrower', 'Fire Spin', 'Fire Spin', 'Fire Blast'),
(398, 392, 'Infernape', 'Fire', '', 'Fire Blast', 'Ember', 'Flamethrower', 'Fire Spin'),
(399, 393, 'Piplup', 'Water', '', 'Crab Hammer', 'Water Gun', 'Bubble', 'Water Gun'),
(400, 394, 'Prinplup', 'Water', '', 'Crab Hammer', 'Surf', 'Surf', 'Bubblebeam'),
(401, 395, 'Empoleon', 'Water', '', 'Surf', 'Crab Hammer', 'Water Gun', 'Bubblebeam'),
(402, 396, 'Starly', 'Normal', '', 'Razor Wind', 'Body Slam', 'Stomp', 'Rage'),
(403, 397, 'Staravia', 'Normal', '', 'Constrict', 'Hyper Fang', 'Thrash', 'Stomp'),
(404, 398, 'Staraptor', 'Normal', '', 'Swift', 'Pay Day', 'Hyper Fang', 'Pound'),
(405, 399, 'Bidoof', 'Normal', '', 'Strength', 'Mega Punch', 'Slam', 'Quick Attack'),
(406, 400, 'Bibarel', 'Normal', '', 'Comet Punch', 'Horn Attack', 'Scratch', 'Rage'),
(407, 401, 'Kricketot', 'Bug', '', 'Leech Life', 'Pin Missile', 'Pin Missile', 'Pin Missile'),
(408, 402, 'Kricketune', 'Bug', '', 'Twineedle', 'Leech Life', 'Pin Missile', 'Pin Missile'),
(409, 403, 'Shinx', 'Electric', '', 'Thunderbolt', 'Thunderbolt', 'Thundershock', 'Thunderbolt'),
(410, 404, 'Luxio', 'Electric', '', 'Thunderbolt', 'Thunder Punch', 'Thundershock', 'Thundershock'),
(411, 405, 'Luxray', 'Electric', '', 'Thundershock', 'Thunderbolt', 'Thundershock', 'Thundershock'),
(412, 406, 'Budew', 'Grass', '', 'Vine Whip', 'Vine Whip', 'Mega Drain', 'Vine Whip'),
(413, 407, 'Roserade', 'Grass', '', 'Solar Beam', 'Petal Dance', 'Mega Drain', 'Absorb'),
(414, 408, 'Cranidos', 'Rock', '', 'Rock Throw', 'Rock Slide', 'Rock Throw', 'Rock Slide'),
(415, 409, 'Rampardos', 'Rock', '', 'Rock Slide', 'Rock Slide', 'Rock Throw', 'Rock Throw'),
(416, 410, 'Shieldon', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(417, 411, 'Bastiodon', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(418, 412, 'Burmy', 'Bug', '', 'Pin Missile', 'Leech Life', 'Twineedle', 'Leech Life'),
(419, 413, 'Wormadam', 'Bug', '', 'Leech Life', 'Twineedle', 'Twineedle', 'Pin Missile'),
(420, 414, 'Mothim', 'Bug', '', 'Leech Life', 'Twineedle', 'Leech Life', 'Twineedle'),
(421, 415, 'Combee', 'Bug', '', 'Pin Missile', 'Twineedle', 'Leech Life', 'Leech Life'),
(422, 416, 'Vespiquen', 'Bug', '', 'Leech Life', 'Twineedle', 'Twineedle', 'Twineedle'),
(423, 417, 'Pachirisu', 'Electric', '', 'Thunder Punch', 'Thundershock', 'Thunder Punch', 'Thunderbolt'),
(424, 418, 'Buizel', 'Water', '', 'Bubblebeam', 'Clamp', 'Surf', 'Water Gun'),
(425, 419, 'Floatzel', 'Water', '', 'Bubble', 'Bubble', 'Bubble', 'Waterfall'),
(426, 420, 'Cherubi', 'Grass', '', 'Razor Leaf', 'Absorb', 'Mega Drain', 'Razor Leaf'),
(427, 421, 'Cherrim', 'Grass', '', 'Absorb', 'Vine Whip', 'Vine Whip', 'Petal Dance'),
(684, 423, 'Gastrodon (East)', 'Water', 'Ground', 'Surf', 'Bubblebeam', 'Dig', 'Bonemerang'),
(430, 424, 'Ambipom', 'Normal', '', 'Cut', 'Struggle', 'Self Destruct', 'Strength'),
(431, 425, 'Drifloon', 'Ghost', '', 'Lick', 'Lick', 'Lick', 'Lick'),
(432, 426, 'Drifblim', 'Ghost', '', 'Lick', 'Shadow Armlet', 'Lick', 'Shadow Armlet'),
(433, 427, 'Buneary', 'Normal', '', 'Constrict', 'Bind', 'Fury Attack', 'Fury Swipes'),
(434, 428, 'Lopunny', 'Normal', '', 'Pound', 'Self Destruct', 'Explosion', 'Wrap'),
(435, 429, 'Mismagius', 'Ghost', '', 'Lick', 'Lick', 'Shadow Armlet', 'Shadow Armlet'),
(436, 430, 'Honchkrow', 'Dark', '', 'Lick', 'Shadow Armlet', 'Lick', 'Lick'),
(437, 431, 'Glameow', 'Normal', '', 'Cut', 'Double Edge', 'Double Edge', 'Swift'),
(438, 432, 'Purugly', 'Normal', '', 'Fury Attack', 'Dizzy Punch', 'Explosion', 'Body Slam'),
(439, 433, 'Chingling', 'Psychic', '', 'Dream Eater', 'Psybeam', 'Psychic', 'Dream Eater'),
(440, 434, 'Stunky', 'Poison', '', 'Acid', 'Poison Sting', 'Poison Sting', 'Poison Sting'),
(441, 435, 'Skuntank', 'Poison', '', 'Sludge', 'Poison Sting', 'Acid', 'Poison Sting'),
(442, 436, 'Bronzor', 'Steel', '', 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Slide'),
(443, 437, 'Bronzong', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Slide'),
(444, 438, 'Bonsly', 'Rock', '', 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Slide'),
(445, 439, 'Mime Jr.', 'Psychic', '', 'Confusion', 'Psychic', 'Dream Eater', 'Confusion'),
(446, 440, 'Happiny', 'Normal', '', 'Strength', 'Double Edge', 'Tackle', 'Slash'),
(447, 441, 'Chatot', 'Normal', '', 'Doubleslap', 'Strength', 'Horn Attack', 'Hyper Fang'),
(448, 442, 'Spiritomb', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Lick', 'Lick'),
(449, 443, 'Gible', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(450, 444, 'Gabite', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(451, 445, 'Garchomp', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(452, 446, 'Munchlax', 'Normal', '', 'Mega Punch', 'Explosion', 'Bite', 'Quick Attack'),
(453, 447, 'Riolu', 'Fighting', '', 'Jump Kick', 'Karate Chop', 'Karate Chop', 'Rolling Kick'),
(454, 448, 'Lucario', 'Fighting', '', 'Double Kick', 'Jump Kick', 'Jump Kick', 'Submission'),
(455, 449, 'Hippopotas', 'Ground', '', 'Dig', 'Dig', 'Dig', 'Earthquake'),
(456, 450, 'Hippowdon', 'Ground', '', 'Dig', 'Bone Club', 'Bonemerang', 'Earthquake'),
(457, 451, 'Skorupi', 'Poison', '', 'Poison Sting', 'Sludge', 'Sludge', 'Poison Sting'),
(458, 452, 'Drapion', 'Poison', '', 'Smog', 'Acid', 'Sludge', 'Smog'),
(459, 453, 'Croagunk', 'Poison', '', 'Poison Sting', 'Smog', 'Sludge', 'Sludge'),
(460, 454, 'Toxicroak', 'Poison', '', 'Poison Sting', 'Smog', 'Smog', 'Sludge'),
(461, 455, 'Carnivine', 'Grass', '', 'Petal Dance', 'Vine Whip', 'Mega Drain', 'Razor Leaf'),
(462, 456, 'Finneon', 'Water', '', 'Water Gun', 'Water Gun', 'Waterfall', 'Water Gun'),
(463, 457, 'Lumineon', 'Water', '', 'Bubblebeam', 'Crab Hammer', 'Crab Hammer', 'Water Gun'),
(464, 458, 'Mantyke', 'Water', '', 'Clamp', 'Water Gun', 'Bubblebeam', 'Bubblebeam'),
(465, 459, 'Snover', 'Grass', '', 'Vine Whip', 'Solar Beam', 'Absorb', 'Absorb'),
(466, 460, 'Abomasnow', 'Grass', '', 'Razor Leaf', 'Petal Dance', 'Razor Leaf', 'Absorb'),
(467, 461, 'Weavile', 'Dark', '', 'Shadow Armlet', 'Lick', 'Lick', 'Lick'),
(468, 462, 'Magnezone', 'Electric', '', 'Thunderbolt', 'Thunder Punch', 'Thundershock', 'Thunder Punch'),
(469, 463, 'Lickilicky', 'Normal', '', 'Dizzy Punch', 'Mega Kick', 'Swift', 'Vice Grip'),
(470, 464, 'Rhyperior', 'Ground', '', 'Bone Club', 'Bonemerang', 'Bonemerang', 'Bone Club'),
(471, 465, 'Tangrowth', 'Grass', '', 'Vine Whip', 'Solar Beam', 'Petal Dance', 'Vine Whip'),
(472, 466, 'Electivire', 'Electric', '', 'Thunder', 'Thundershock', 'Thunder Punch', 'Thunderbolt'),
(473, 467, 'Magmortar', 'Fire', '', 'Fire Blast', 'Flamethrower', 'Fire Spin', 'Fire Punch'),
(474, 468, 'Togekiss', 'Normal', '', 'Horn Attack', 'Stomp', 'Slam', 'Hyper Beam'),
(475, 469, 'Yanmega', 'Bug', '', 'Pin Missile', 'Pin Missile', 'Pin Missile', 'Twineedle'),
(476, 470, 'Leafeon', 'Grass', '', 'Razor Leaf', 'Petal Dance', 'Mega Drain', 'Razor Leaf'),
(477, 471, 'Glaceon', 'Ice', '', 'Blizzard', 'Ice Punch', 'Blizzard', 'Ice Beam'),
(478, 472, 'Gliscor', 'Ground', '', 'Bone Club', 'Bone Club', 'Bone Club', 'Bonemerang'),
(479, 473, 'Mamoswine', 'Ice', '', 'Ice Punch', 'Aurora Beam', 'Blizzard', 'Blizzard'),
(480, 474, 'Porygon-Z', 'Normal', '', 'Constrict', 'Body Slam', 'Slam', 'Swift'),
(481, 475, 'Gallade', 'Psychic', '', 'Dream Eater', 'Psychic', 'Psychic', 'Psybeam'),
(482, 476, 'Probopass', 'Rock', '', 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Throw'),
(483, 477, 'Dusknoir', 'Ghost', '', 'Lick', 'Lick', 'Shadow Armlet', 'Lick'),
(484, 478, 'Froslass', 'Ice', '', 'Blizzard', 'Blizzard', 'Aurora Beam', 'Ice Beam'),
(485, 479, 'Rotom', 'Electric', '', 'Thunder Punch', 'Thunder Punch', 'Thunder', 'Thundershock'),
(486, 480, 'Uxie', 'Psychic', '', 'Confusion', 'Confusion', 'Confusion', 'Dream Eater'),
(487, 481, 'Mesprit', 'Psychic', '', 'Psybeam', 'Dream Eater', 'Psychic', 'Psychic'),
(488, 482, 'Azelf', 'Psychic', '', 'Confusion', 'Psybeam', 'Confusion', 'Psybeam'),
(489, 483, 'Dialga', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Throw', 'Rock Throw'),
(490, 484, 'Palkia', 'Water', '', 'Crab Hammer', 'Bubblebeam', 'Waterfall', 'Surf'),
(491, 485, 'Heatran', 'Fire', '', 'Fire Spin', 'Fire Spin', 'Fire Blast', 'Fire Spin'),
(492, 486, 'Regigigas', 'Normal', '', 'Rage', 'Fury Swipes', 'Thrash', 'Explosion'),
(493, 487, 'Giratina', 'Ghost', '', 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet'),
(494, 488, 'Cresselia', 'Psychic', '', 'Dream Eater', 'Psybeam', 'Psybeam', 'Dream Eater'),
(495, 489, 'Phione', 'Water', '', 'Clamp', 'Bubblebeam', 'Surf', 'Surf'),
(496, 490, 'Manaphy', 'Water', '', 'Clamp', 'Crab Hammer', 'Waterfall', 'Clamp'),
(497, 491, 'Darkrai', 'Dark', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(498, 492, 'Shaymin', 'Grass', '', 'Solar Beam', 'Vine Whip', 'Solar Beam', 'Vine Whip'),
(499, 493, 'Arceus', 'Normal', '', 'Pound', 'Head Butt', 'Vice Grip', 'Bite'),
(500, 494, 'Victini', 'Psychic', '', 'Psybeam', 'Dream Eater', 'Dream Eater', 'Confusion'),
(501, 495, 'Snivy', 'Grass', '', 'Solar Beam', 'Solar Beam', 'Mega Drain', 'Absorb'),
(502, 496, 'Servine', 'Grass', '', 'Vine Whip', 'Solar Beam', 'Vine Whip', 'Solar Beam'),
(503, 497, 'Serperior', 'Grass', '', 'Razor Leaf', 'Mega Drain', 'Petal Dance', 'Mega Drain'),
(504, 498, 'Tepig', 'Fire', '', 'Fire Spin', 'Fire Spin', 'Fire Blast', 'Fire Spin'),
(505, 499, 'Pignite', 'Fire', '', 'Ember', 'Fire Spin', 'Fire Blast', 'Flamethrower'),
(506, 500, 'Emboar', 'Fire', '', 'Fire Spin', 'Fire Blast', 'Fire Blast', 'Fire Blast'),
(507, 501, 'Oshawott', 'Water', '', 'Hydro Pump', 'Bubblebeam', 'Bubblebeam', 'Clamp'),
(508, 502, 'Dewott', 'Water', '', 'Bubblebeam', 'Hydro Pump', 'Bubblebeam', 'Surf'),
(509, 503, 'Samurott', 'Water', '', 'Clamp', 'Bubblebeam', 'Bubblebeam', 'Bubblebeam'),
(510, 504, 'Patrat', 'Normal', '', 'Bind', 'Slam', 'Dizzy Punch', 'Take Down'),
(511, 505, 'Watchog', 'Normal', '', 'Explosion', 'Self Destruct', 'Horn Attack', 'Constrict'),
(512, 506, 'Lillipup', 'Normal', '', 'Stomp', 'Explosion', 'Swift', 'Scratch'),
(513, 507, 'Herdier', 'Normal', '', 'Strength', 'Quick Attack', 'Bind', 'Swift'),
(514, 508, 'Stoutland', 'Normal', '', 'Mega Kick', 'Doubleslap', 'Double Edge', 'Bind'),
(515, 509, 'Purrloin', 'Dark', '', 'Shadow Armlet', 'Lick', 'Lick', 'Lick'),
(516, 510, 'Liepard', 'Dark', '', 'Lick', 'Lick', 'Shadow Armlet', 'Shadow Armlet'),
(517, 511, 'Pansage', 'Grass', '', 'Absorb', 'Absorb', 'Petal Dance', 'Absorb'),
(518, 512, 'Simisage', 'Grass', '', 'Petal Dance', 'Solar Beam', 'Razor Leaf', 'Petal Dance'),
(519, 513, 'Pansear', 'Fire', '', 'Fire Blast', 'Fire Punch', 'Fire Blast', 'Fire Punch'),
(520, 514, 'Simisear', 'Fire', '', 'Flamethrower', 'Ember', 'Fire Punch', 'Fire Blast'),
(521, 515, 'Panpour', 'Water', '', 'Bubble', 'Hydro Pump', 'Surf', 'Hydro Pump'),
(522, 516, 'Simipour', 'Water', '', 'Crab Hammer', 'Clamp', 'Surf', 'Surf'),
(523, 517, 'Munna', 'Psychic', '', 'Dream Eater', 'Psybeam', 'Psybeam', 'Confusion'),
(524, 518, 'Musharna', 'Psychic', '', 'Psybeam', 'Psybeam', 'Psychic', 'Dream Eater'),
(525, 519, 'Pidove', 'Normal', '', 'Head Butt', 'Comet Punch', 'Struggle', 'Doubleslap'),
(526, 520, 'Tranquill', 'Normal', '', 'Take Down', 'Doubleslap', 'Hyper Fang', 'Strength'),
(527, 521, 'Unfezant', 'Normal', '', 'Bind', 'Cut', 'Bite', 'Mega Kick'),
(528, 522, 'Blitzle', 'Electric', '', 'Thundershock', 'Thunderbolt', 'Thundershock', 'Thunder'),
(529, 523, 'Zebstrika', 'Electric', '', 'Thunder', 'Thunder Punch', 'Thunderbolt', 'Thunder Punch'),
(530, 524, 'Roggenrola', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(531, 525, 'Boldore', 'Rock', '', 'Rock Slide', 'Rock Slide', 'Rock Slide', 'Rock Slide'),
(532, 526, 'Gigalith', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Throw'),
(533, 527, 'Woobat', 'Psychic', '', 'Confusion', 'Psychic', 'Psybeam', 'Psybeam'),
(534, 528, 'Swoobat', 'Psychic', '', 'Psychic', 'Confusion', 'Psychic', 'Psychic'),
(535, 529, 'Drilbur', 'Ground', '', 'Bone Club', 'Dig', 'Bonemerang', 'Earthquake'),
(536, 530, 'Excadrill', 'Ground', '', 'Dig', 'Dig', 'Earthquake', 'Dig'),
(537, 531, 'Audino', 'Normal', '', 'Head Butt', 'Bite', 'Struggle', 'Bite'),
(538, 532, 'Timburr', 'Fighting', '', 'Double Kick', 'Double Kick', 'Double Kick', 'Jump Kick'),
(539, 533, 'Gurdurr', 'Fighting', '', 'Rolling Kick', 'Karate Chop', 'Submission', 'Jump Kick'),
(540, 534, 'Conkeldurr', 'Fighting', '', 'Submission', 'Submission', 'Rolling Kick', 'Rolling Kick'),
(541, 535, 'Tympole', 'Water', '', 'Waterfall', 'Crab Hammer', 'Surf', 'Water Gun'),
(542, 536, 'Palpitoad', 'Water', '', 'Bubblebeam', 'Bubblebeam', 'Crab Hammer', 'Waterfall'),
(543, 537, 'Seismitoad', 'Water', '', 'Crab Hammer', 'Crab Hammer', 'Surf', 'Crab Hammer'),
(544, 538, 'Throh', 'Fighting', '', 'Submission', 'Karate Chop', 'Karate Chop', 'Rolling Kick'),
(545, 539, 'Sawk', 'Fighting', '', 'Submission', 'Submission', 'Jump Kick', 'Karate Chop'),
(546, 540, 'Sewaddle', 'Bug', '', 'Leech Life', 'Pin Missile', 'Twineedle', 'Pin Missile'),
(547, 541, 'Swadloon', 'Bug', '', 'Pin Missile', 'Leech Life', 'Leech Life', 'Leech Life'),
(548, 542, 'Leavanny', 'Bug', '', 'Pin Missile', 'Twineedle', 'Twineedle', 'Pin Missile'),
(549, 543, 'Venipede', 'Bug', '', 'Twineedle', 'Twineedle', 'Twineedle', 'Leech Life'),
(550, 544, 'Whirlipede', 'Bug', '', 'Twineedle', 'Pin Missile', 'Leech Life', 'Twineedle'),
(551, 545, 'Scolipede', 'Bug', '', 'Leech Life', 'Twineedle', 'Leech Life', 'Pin Missile'),
(552, 546, 'Cottonee', 'Grass', '', 'Mega Drain', 'Razor Leaf', 'Vine Whip', 'Mega Drain'),
(553, 547, 'Whimsicott', 'Grass', '', 'Absorb', 'Mega Drain', 'Vine Whip', 'Razor Leaf'),
(554, 548, 'Petilil', 'Grass', '', 'Solar Beam', 'Mega Drain', 'Petal Dance', 'Absorb'),
(555, 549, 'Lilligant', 'Grass', '', 'Solar Beam', 'Absorb', 'Petal Dance', 'Absorb'),
(556, 550, 'Basculin', 'Water', '', 'Surf', 'Water Gun', 'Bubble', 'Clamp'),
(557, 551, 'Sandile', 'Ground', '', 'Bone Club', 'Bonemerang', 'Earthquake', 'Dig'),
(558, 552, 'Krokorok', 'Ground', '', 'Bonemerang', 'Dig', 'Bonemerang', 'Bone Club'),
(559, 553, 'Krookodile', 'Ground', '', 'Dig', 'Bonemerang', 'Earthquake', 'Bone Club'),
(560, 554, 'Darumaka', 'Fire', '', 'Fire Punch', 'Fire Spin', 'Fire Blast', 'Flamethrower'),
(561, 555, 'Darmanitan', 'Fire', '', 'Fire Blast', 'Flamethrower', 'Fire Blast', 'Ember'),
(562, 556, 'Maractus', 'Grass', '', 'Vine Whip', 'Razor Leaf', 'Absorb', 'Solar Beam'),
(563, 557, 'Dwebble', 'Bug', '', 'Leech Life', 'Leech Life', 'Leech Life', 'Leech Life'),
(564, 558, 'Crustle', 'Bug', '', 'Pin Missile', 'Pin Missile', 'Leech Life', 'Pin Missile'),
(565, 559, 'Scraggy', 'Dark', '', 'Lick', 'Lick', 'Lick', 'Lick'),
(566, 560, 'Scrafty', 'Dark', '', 'Lick', 'Lick', 'Lick', 'Lick'),
(567, 561, 'Sigilyph', 'Psychic', '', 'Psychic', 'Confusion', 'Dream Eater', 'Psybeam'),
(568, 562, 'Yamask', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(569, 563, 'Cofagrigus', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Lick'),
(570, 564, 'Tirtouga', 'Water', '', 'Water Gun', 'Bubblebeam', 'Waterfall', 'Bubble'),
(571, 565, 'Carracosta', 'Water', '', 'Clamp', 'Surf', 'Bubblebeam', 'Surf'),
(572, 566, 'Archen', 'Rock', '', 'Rock Slide', 'Rock Slide', 'Rock Slide', 'Rock Slide'),
(573, 567, 'Archeops', 'Rock', '', 'Rock Slide', 'Rock Slide', 'Rock Throw', 'Rock Throw'),
(574, 568, 'Trubbish', 'Poison', '', 'Smog', 'Poison Sting', 'Smog', 'Smog'),
(575, 569, 'Garbodor', 'Poison', '', 'Acid', 'Acid', 'Acid', 'Acid'),
(576, 570, 'Zorua', 'Dark', '', 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet'),
(577, 571, 'Zoroark', 'Dark', '', 'Shadow Armlet', 'Shadow Armlet', 'Lick', 'Lick'),
(578, 572, 'Minccino', 'Normal', '', 'Vice Grip', 'Quick Attack', 'Wrap', 'Fury Swipes'),
(579, 573, 'Cinccino', 'Normal', '', 'Tri Attack', 'Comet Punch', 'Mega Punch', 'Spike Cannon'),
(580, 574, 'Gothita', 'Psychic', '', 'Dream Eater', 'Psychic', 'Psybeam', 'Confusion'),
(581, 575, 'Gothorita', 'Psychic', '', 'Confusion', 'Dream Eater', 'Dream Eater', 'Dream Eater'),
(582, 576, 'Gothitelle', 'Psychic', '', 'Psybeam', 'Psybeam', 'Confusion', 'Confusion'),
(583, 577, 'Solosis', 'Psychic', '', 'Confusion', 'Dream Eater', 'Psybeam', 'Psybeam'),
(584, 578, 'Duosion', 'Psychic', '', 'Psychic', 'Confusion', 'Confusion', 'Dream Eater'),
(585, 579, 'Reuniclus', 'Psychic', '', 'Confusion', 'Psybeam', 'Dream Eater', 'Confusion'),
(586, 580, 'Ducklett', 'Water', '', 'Surf', 'Crab Hammer', 'Water Gun', 'Waterfall'),
(587, 581, 'Swanna', 'Water', '', 'Clamp', 'Water Gun', 'Crab Hammer', 'Bubble'),
(588, 582, 'Vanillite', 'Ice', '', 'Ice Beam', 'Ice Beam', 'Ice Beam', 'Ice Beam'),
(589, 583, 'Vanillish', 'Ice', '', 'Aurora Beam', 'Ice Beam', 'Ice Punch', 'Ice Punch');
INSERT INTO `pokemon` (`id`, `num`, `name`, `type1`, `type2`, `move1`, `move2`, `move3`, `move4`) VALUES
(590, 584, 'Vanilluxe', 'Ice', '', 'Ice Punch', 'Aurora Beam', 'Blizzard', 'Aurora Beam'),
(591, 585, 'Deerling', 'Normal', '', 'Horn Attack', 'Take Down', 'Tackle', 'Hyper Fang'),
(592, 586, 'Sawsbuck', 'Normal', '', 'Strength', 'Fury Swipes', 'Pay Day', 'Swift'),
(593, 587, 'Emolga', 'Electric', '', 'Thundershock', 'Thunder', 'Thunder', 'Thunderbolt'),
(594, 588, 'Karrablast', 'Bug', '', 'Leech Life', 'Twineedle', 'Leech Life', 'Pin Missile'),
(595, 589, 'Escavalier', 'Bug', '', 'Twineedle', 'Leech Life', 'Twineedle', 'Leech Life'),
(596, 590, 'Foongus', 'Grass', '', 'Petal Dance', 'Vine Whip', 'Mega Drain', 'Mega Drain'),
(597, 591, 'Amoonguss', 'Grass', '', 'Vine Whip', 'Solar Beam', 'Vine Whip', 'Solar Beam'),
(598, 592, 'Frillish', 'Water', '', 'Crab Hammer', 'Bubble', 'Crab Hammer', 'Crab Hammer'),
(599, 593, 'Jellicent', 'Water', '', 'Surf', 'Waterfall', 'Crab Hammer', 'Bubblebeam'),
(600, 594, 'Alomomola', 'Water', '', 'Clamp', 'Surf', 'Clamp', 'Surf'),
(601, 595, 'Joltik', 'Bug', '', 'Pin Missile', 'Leech Life', 'Pin Missile', 'Leech Life'),
(602, 596, 'Galvantula', 'Bug', '', 'Pin Missile', 'Twineedle', 'Leech Life', 'Twineedle'),
(603, 597, 'Ferroseed', 'Grass', '', 'Absorb', 'Mega Drain', 'Absorb', 'Razor Leaf'),
(604, 598, 'Ferrothorn', 'Grass', '', 'Vine Whip', 'Mega Drain', 'Vine Whip', 'Petal Dance'),
(605, 599, 'Klink', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Throw'),
(606, 600, 'Klang', 'Steel', '', 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Throw'),
(607, 601, 'Klinklang', 'Steel', '', 'Rock Throw', 'Rock Throw', 'Rock Throw', 'Rock Slide'),
(608, 602, 'Tynamo', 'Electric', '', 'Thunder Punch', 'Thunder Punch', 'Thunder Punch', 'Thundershock'),
(609, 603, 'Eelektrik', 'Electric', '', 'Thunder', 'Thunder Punch', 'Thunder', 'Thundershock'),
(610, 604, 'Eelektross', 'Electric', '', 'Thundershock', 'Thunder Punch', 'Thunderbolt', 'Thunder'),
(611, 605, 'Elgyem', 'Psychic', '', 'Psychic', 'Psybeam', 'Psychic', 'Psychic'),
(612, 606, 'Beheeyem', 'Psychic', '', 'Dream Eater', 'Dream Eater', 'Confusion', 'Psybeam'),
(613, 607, 'Litwick', 'Ghost', '', 'Lick', 'Lick', 'Lick', 'Shadow Armlet'),
(614, 608, 'Lampent', 'Ghost', '', 'Lick', 'Shadow Armlet', 'Lick', 'Lick'),
(615, 609, 'Chandelure', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(616, 610, 'Axew', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(617, 611, 'Fraxure', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(618, 612, 'Haxorus', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(619, 613, 'Cubchoo', 'Ice', '', 'Aurora Beam', 'Aurora Beam', 'Blizzard', 'Ice Beam'),
(620, 614, 'Beartic', 'Ice', '', 'Ice Beam', 'Ice Punch', 'Ice Beam', 'Aurora Beam'),
(621, 615, 'Cryogonal', 'Ice', '', 'Ice Punch', 'Aurora Beam', 'Aurora Beam', 'Aurora Beam'),
(622, 616, 'Shelmet', 'Bug', '', 'Twineedle', 'Twineedle', 'Leech Life', 'Twineedle'),
(623, 617, 'Accelgor', 'Bug', '', 'Leech Life', 'Leech Life', 'Leech Life', 'Pin Missile'),
(624, 618, 'Stunfisk', 'Electric', '', 'Thunder Punch', 'Thundershock', 'Thunder', 'Thunderbolt'),
(625, 619, 'Mienfoo', 'Fighting', '', 'Submission', 'Rolling Kick', 'Jump Kick', 'Double Kick'),
(626, 620, 'Mienshao', 'Fighting', '', 'Karate Chop', 'Rolling Kick', 'Double Kick', 'Jump Kick'),
(627, 621, 'Druddigon', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(628, 622, 'Golett', 'Ground', '', 'Dig', 'Earthquake', 'Bonemerang', 'Bonemerang'),
(629, 623, 'Golurk', 'Ground', '', 'Earthquake', 'Dig', 'Bone Club', 'Bonemerang'),
(630, 624, 'Pawniard', 'Dark', '', 'Shadow Armlet', 'Lick', 'Shadow Armlet', 'Lick'),
(631, 625, 'Bisharp', 'Dark', '', 'Lick', 'Shadow Armlet', 'Lick', 'Lick'),
(632, 626, 'Bouffalant', 'Normal', '', 'Head Butt', 'Horn Attack', 'Slash', 'Skull Bash'),
(633, 627, 'Rufflet', 'Normal', '', 'Swift', 'Double Edge', 'Struggle', 'Spike Cannon'),
(634, 628, 'Braviary', 'Normal', '', 'Scratch', 'Slash', 'Tackle', 'Vice Grip'),
(635, 629, 'Vullaby', 'Dark', '', 'Lick', 'Lick', 'Shadow Armlet', 'Shadow Armlet'),
(636, 630, 'Mandibuzz', 'Dark', '', 'Lick', 'Lick', 'Shadow Armlet', 'Shadow Armlet'),
(637, 631, 'Heatmor', 'Fire', '', 'Ember', 'Fire Blast', 'Fire Spin', 'Ember'),
(638, 632, 'Durant', 'Bug', '', 'Leech Life', 'Twineedle', 'Leech Life', 'Pin Missile'),
(639, 633, 'Deino', 'Dark', '', 'Lick', 'Lick', 'Lick', 'Shadow Armlet'),
(640, 634, 'Zweilous', 'Dark', '', 'Shadow Armlet', 'Lick', 'Lick', 'Shadow Armlet'),
(641, 635, 'Hydreigon', 'Dark', '', 'Shadow Armlet', 'Lick', 'Shadow Armlet', 'Lick'),
(642, 636, 'Larvesta', 'Bug', '', 'Leech Life', 'Twineedle', 'Twineedle', 'Twineedle'),
(643, 637, 'Volcarona', 'Bug', '', 'Pin Missile', 'Leech Life', 'Twineedle', 'Twineedle'),
(644, 638, 'Cobalion', 'Steel', '', 'Rock Slide', 'Rock Throw', 'Rock Slide', 'Rock Slide'),
(645, 639, 'Terrakion', 'Rock', '', 'Rock Throw', 'Rock Slide', 'Rock Slide', 'Rock Throw'),
(646, 640, 'Virizion', 'Grass', '', 'Absorb', 'Razor Leaf', 'Vine Whip', 'Petal Dance'),
(647, 641, 'Tornadus', 'Flying', '', 'Fly', 'Peck', 'Drill Peck', 'Drill Peck'),
(648, 642, 'Thundurus', 'Electric', '', 'Thunderbolt', 'Thunder Punch', 'Thunderbolt', 'Thundershock'),
(649, 643, 'Reshiram', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(650, 644, 'Zekrom', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(651, 645, 'Landorus', 'Ground', '', 'Earthquake', 'Earthquake', 'Dig', 'Earthquake'),
(652, 646, 'Kyurem', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(653, 647, 'Keldeo', 'Water', '', 'Water Gun', 'Bubble', 'Clamp', 'Hydro Pump'),
(654, 648, 'Meloetta', 'Normal', '', 'Quick Attack', 'Swift', 'Fury Swipes', 'Mega Punch'),
(655, 649, 'Genesect', 'Bug', '', 'Twineedle', 'Twineedle', 'Pin Missile', 'Pin Missile'),
(657, 493, 'Arceus (Bug)', 'Bug', '', 'Leech Life', 'Leech Life', 'Leech Life', 'Leech Life'),
(658, 493, 'Arceus (Dark)', 'Dark', '', 'Shadow Armlet', 'Shadow Armlet', 'Lick', 'Shadow Armlet'),
(659, 493, 'Arceus (Dragon)', 'Dragon', '', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage', 'Dragon Rage'),
(660, 493, 'Arceus (Electric)', 'Electric', '', 'Thundershock', 'Thunder', 'Thunder', 'Thunder Punch'),
(661, 493, 'Arceus (Fighting)', 'Fighting', '', 'Double Kick', 'Karate Chop', 'Double Kick', 'Double Kick'),
(662, 493, 'Arceus (Fire)', 'Fire', '', 'Fire Blast', 'Fire Blast', 'Fire Punch', 'Fire Punch'),
(663, 493, 'Arceus (Flying)', 'Flying', '', 'Peck', 'Peck', 'Gust', 'Sky Attack'),
(664, 493, 'Arceus (Ghost)', 'Ghost', '', 'Lick', 'Lick', 'Lick', 'Lick'),
(665, 493, 'Arceus (Grass)', 'Grass', '', 'Razor Leaf', 'Razor Leaf', 'Razor Leaf', 'Solar Beam'),
(666, 493, 'Arceus (Ground)', 'Ground', '', 'Earthquake', 'Dig', 'Bonemerang', 'Dig'),
(667, 493, 'Arceus (Ice)', 'Ice', '', 'Ice Beam', 'Aurora Beam', 'Ice Beam', 'Aurora Beam'),
(668, 493, 'Arceus (Poison)', 'Poison', '', 'Smog', 'Sludge', 'Acid', 'Acid'),
(669, 493, 'Arceus (Psychic)', 'Psychic', '', 'Dream Eater', 'Psybeam', 'Psybeam', 'Dream Eater'),
(670, 493, 'Arceus (Rock)', 'Rock', '', 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(671, 493, 'Arceus (Steel)', 'Steel', '', 'Rock Throw', 'Rock Throw', 'Rock Slide', 'Rock Throw'),
(672, 493, 'Arceus (Unknown)', 'Unknown', '', 'Scratch', 'Scratch', 'Scratch', 'Scratch'),
(673, 493, 'Arceus (Water)', 'Water', '', 'Surf', 'Clamp', 'Surf', 'Water Gun'),
(674, 386, 'Deoxys (Attack)', 'Psychic', '', 'Psychic', 'Confusion', 'Psychic', 'Confusion'),
(675, 386, 'Deoxys (Defence)', 'Psychic', '', 'Psybeam', 'Psybeam', 'Psybeam', 'Confusion'),
(676, 386, 'Deoxys (Speed)', 'Psychic', '', 'Confusion', 'Psybeam', 'Psybeam', 'Dream Eater'),
(677, 479, 'Rotom (Cut)', 'Electric', 'Grass', 'Thunderbolt', 'Thunder', 'Razor Leaf', 'Razor Leaf'),
(678, 479, 'Rotom (Frost)', 'Electric', 'Ice', 'Thunder Punch', 'Thunder Punch', 'Aurora Beam', 'Blizzard'),
(679, 479, 'Rotom (Wash)', 'Electric', 'Water', 'Thunder', 'Thundershock', 'Bubble', 'Clamp'),
(680, 479, 'Rotom (Spin)', 'Electric', 'Flying', 'Thunder Punch', 'Thunderbolt', 'Drill Peck', 'Peck'),
(681, 479, 'Rotom (Heat)', 'Electric', 'Fire', 'Thunder', 'Thunderbolt', 'Fire Punch', 'Fire Spin'),
(682, 422, 'Shellos (East)', 'Water', '', 'Bubble', 'Waterfall', 'Hydro Pump', 'Waterfall'),
(683, 422, 'Shellos (West)', 'Water', '', 'Water Gun', 'Water Gun', 'Clamp', 'Water Gun'),
(685, 423, 'Gastrodon (West)', 'Water', 'Ground', 'Crab Hammer', 'Surf', 'Earthquake', 'Dig'),
(686, 201, 'Unown (A)', 'Psychic', '', 'Psybeam', 'Confusion', 'Psychic', 'Psybeam'),
(687, 201, 'Unown (B)', 'Psychic', '', 'Psybeam', 'Dream Eater', 'Confusion', 'Psybeam'),
(688, 201, 'Unown (C)', 'Psychic', '', 'Dream Eater', 'Confusion', 'Psybeam', 'Confusion'),
(689, 201, 'Unown (D)', 'Psychic', '', 'Psychic', 'Psybeam', 'Psybeam', 'Dream Eater'),
(690, 201, 'Unown (E)', 'Psychic', '', 'Psybeam', 'Confusion', 'Dream Eater', 'Psybeam'),
(691, 201, 'Unown (Em)', 'Psychic', '', 'Dream Eater', 'Dream Eater', 'Psychic', 'Confusion'),
(692, 201, 'Unown (F)', 'Psychic', '', 'Dream Eater', 'Dream Eater', 'Confusion', 'Psybeam'),
(693, 201, 'Unown (G)', 'Psychic', '', 'Confusion', 'Psybeam', 'Dream Eater', 'Psybeam'),
(694, 201, 'Unown (H)', 'Psychic', '', 'Dream Eater', 'Psychic', 'Psychic', 'Dream Eater'),
(695, 201, 'Unown (I)', 'Psychic', '', 'Psychic', 'Dream Eater', 'Confusion', 'Psychic'),
(696, 201, 'Unown (J)', 'Psychic', '', 'Psychic', 'Confusion', 'Dream Eater', 'Confusion'),
(697, 201, 'Unown (K)', 'Psychic', '', 'Confusion', 'Psychic', 'Psychic', 'Dream Eater'),
(698, 201, 'Unown (L)', 'Psychic', '', 'Psybeam', 'Psybeam', 'Psybeam', 'Dream Eater'),
(699, 201, 'Unown (M)', 'Psychic', '', 'Dream Eater', 'Confusion', 'Psybeam', 'Psybeam'),
(700, 201, 'Unown (N)', 'Psychic', '', 'Confusion', 'Dream Eater', 'Psychic', 'Confusion'),
(701, 201, 'Unown (O)', 'Psychic', '', 'Dream Eater', 'Dream Eater', 'Psybeam', 'Dream Eater'),
(702, 201, 'Unown (P)', 'Psychic', '', 'Psybeam', 'Confusion', 'Psybeam', 'Psychic'),
(703, 201, 'Unown (Q)', 'Psychic', '', 'Psychic', 'Psybeam', 'Psychic', 'Confusion'),
(704, 201, 'Unown (Qm)', 'Psychic', '', 'Psybeam', 'Psychic', 'Psychic', 'Psychic'),
(705, 201, 'Unown (R)', 'Psychic', '', 'Confusion', 'Psybeam', 'Dream Eater', 'Psybeam'),
(706, 201, 'Unown (S)', 'Psychic', '', 'Dream Eater', 'Psychic', 'Psychic', 'Dream Eater'),
(707, 201, 'Unown (T)', 'Psychic', '', 'Psybeam', 'Psychic', 'Confusion', 'Psybeam'),
(708, 201, 'Unown (U)', 'Psychic', '', 'Confusion', 'Psybeam', 'Psychic', 'Psychic'),
(709, 201, 'Unown (V)', 'Psychic', '', 'Psychic', 'Psychic', 'Psychic', 'Psybeam'),
(710, 201, 'Unown (W)', 'Psychic', '', 'Psybeam', 'Psybeam', 'Psychic', 'Psybeam'),
(711, 201, 'Unown (X)', 'Psychic', '', 'Confusion', 'Dream Eater', 'Dream Eater', 'Psybeam'),
(712, 201, 'Unown (Y)', 'Psychic', '', 'Confusion', 'Dream Eater', 'Confusion', 'Confusion'),
(713, 201, 'Unown (Z)', 'Psychic', '', 'Confusion', 'Confusion', 'Psychic', 'Psychic'),
(5040, 0, 'Umbra Haunter', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5039, 0, 'Umbra Gastly', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5038, 0, 'Umbra Pidgeot', 'Normal', 'Flying', 'Ember', 'Shadow Armlet', 'Ember', 'Hyper Beam'),
(5037, 0, 'Umbra Pidgeotto', 'Normal', 'Flying', 'Ice Beam', 'Ice Beam', 'Ice Beam', 'Ice Beam'),
(5036, 0, 'Umbra Pidgey', 'Normal', 'Flying', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(720, 646, 'Kyurem (Black)', 'Dragon', 'Ice', 'Blizzard', 'Hydro Pump', 'Hyper Beam', 'Earthquake'),
(721, 646, 'Kyurem (White)', 'Dragon', 'Ice', 'Blizzard', 'Hydro Pump', 'Hyper Beam', 'Earthquake'),
(722, 486, 'Giratina (Origin)', 'Ghost', 'Flying', 'Shadow Armlet', 'Blizzard', 'Hydro Pump', 'Hyper Beam'),
(723, 755, 'Halloween Chimchar', 'Fire', '', 'Scratch', 'Ember', 'Fire Blast', 'Scratch'),
(725, 725, 'Halloween Monferno', 'Fire', 'Fighting', 'Ember', 'Fire Blast', 'Ember', 'Scratch'),
(726, 726, 'Halloween Infernape', 'Fire', 'Fighting', 'Ember', 'Scratch', 'Scratch', 'Ember'),
(5001, 5001, 'Halloween Charmander', 'Fire', '', 'Flamethrower', 'Ember', 'Ember', 'Ember'),
(5002, 5002, 'Halloween Charmeleon', 'Fire', '', 'Ember', 'Fire Spin', 'Fire Spin', 'Ember'),
(5003, 5003, 'Halloween Charizard', 'Fire', 'Flying', 'Scratch', 'Ember', 'Ember', 'Ember'),
(5004, 5004, 'Halloween Growlithe', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5005, 5005, 'Halloween Arcanine', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5006, 0, 'Halloween Growlithe', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5007, 0, 'Halloween Arcanine', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5008, 0, 'Halloween Growlithe', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5009, 0, 'Halloween Arcanine', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5010, 5010, 'Planet Pichu', 'Electric', '', 'Thunder Punch', 'Thunderbolt', 'Thunderbolt', 'Thunder'),
(5011, 5011, 'Planet Pikachu', 'Electric', '', 'Thunder', 'Thunder Punch', 'Thundershock', 'Thunderbolt'),
(5012, 5012, 'Planet Raichu', 'Electric', '', 'Thunder Punch', 'Thundershock', 'Thunder', 'Thunder Punch'),
(5013, 5013, 'Planet Rayquaza', 'Dragon', 'Flying', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5014, 5014, 'Halloween Totodile', 'Water', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5015, 5015, 'Halloween Croconaw', 'Water', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5016, 5016, 'Halloween Feraligatr', 'Water', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5017, 5017, 'Planet Moltress', 'Fire', '', 'Shadow Armlet', 'Ember', 'Ember', 'Ember'),
(5018, 5018, 'Eternal Weavile', 'Dark', 'Ice', 'Shadow Armlet', 'Ember', 'Ember', 'Ember'),
(5019, 5019, 'Eternal Latias', 'Dragon', 'Psychic', 'Shadow Armlet', 'Ember', 'Ember', 'Ember'),
(5020, 5020, 'Halloween Mewtwo', 'Psychic', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5021, 5021, 'Planet Deoxys', 'Psychic', '', 'Shadow Armlet', 'Ember', 'Ember', 'Ember'),
(5022, 5022, 'Halloween Raikou', 'Electric', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5023, 5023, 'Halloween Gyarados', 'Water', 'Dragon', 'Shadow Armlet', 'Ember', 'Ember', 'Ember'),
(5024, 5024, 'Ninja Latios', 'Psychic', 'Flying', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5025, 5025, 'Ninja Eevee', 'Normal', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5026, 5026, 'Ninja Heracross', 'Bug', 'Fighting', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5027, 5027, 'Tornadus (Therian)', 'Flying', '', 'Ember', 'Splash', 'Ember', 'Scratch'),
(5028, 5028, 'Landorus (Therian)', 'Ground', '', 'Scratch', 'Ember', 'Ember', 'Ember'),
(5029, 5029, 'Thundurus (Therian)', 'Electric', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5030, 5030, 'Crystalic Pachirichu', 'Electric', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5031, 5031, 'Crystalic Gligar', 'Flying', 'Ground', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5032, 5032, 'Crystalic Gliscor', 'Flying', 'Ground', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5033, 5033, 'Planet Dratini', 'Dragon', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5034, 5034, 'Planet Dragonair', 'Dragon', '', 'Ice Beam', 'Ice Beam', 'Ice Beam', 'Ice Beam'),
(5035, 5035, 'Planet Dragonite', 'Dragon', '', 'Ice Beam', 'Hyper Beam', 'Hyper Beam', 'Hyper Beam'),
(5046, 5046, 'Umbra Pidgey', 'Normal', '', 'Scratch', 'Slam', 'Scratch', 'Scratch'),
(5047, 5047, 'Umbra Pidgeotto', 'Normal', '', 'Fury Attack', 'Bite', 'Swift', 'Wrap'),
(5048, 5048, 'Umbra Pidgeot', 'Normal', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5049, 5049, 'Umbra Gastly', 'Ghost', '', 'Slam', 'Slam', 'Ember', 'Slam'),
(5050, 5050, 'Umbra Haunter', 'Ghost', '', 'Scratch', 'Ember', 'Ice Beam', 'Ember'),
(5051, 5051, 'Umbra Gengar', 'Ghost', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5052, 5052, 'Umbra Tropius', 'Normal', '', 'Shadow Armlet', 'Slam', 'Ember', 'Slam'),
(5053, 5053, 'Umbra Pinsir', 'Normal', '', 'Shadow Armlet', 'Ice Beam', 'Ice Beam', 'Ice Beam'),
(5054, 5054, 'Umbra Tauros', 'Normal', '', 'Shadow Armlet', 'Hyper Beam', 'Shadow Armlet', 'Hyper Beam'),
(5055, 5055, 'Umbra Rayquaza', 'Dragon', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5056, 5056, 'Crystalic Wynaut', 'Normal', '', 'Shadow Armlet', 'Ember', 'Ember', 'Slam'),
(5057, 5057, 'Crystalic Wobbuffet', 'Normal', '', 'Shadow Armlet', 'Ice Beam', 'Scratch', 'Ice Beam'),
(5058, 5058, 'Halloween Heracross', 'Bug', 'Fighting', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5059, 5059, 'Eternal Articuno', 'Ice', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5060, 5060, 'Eternal Delibird', 'Ice', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5061, 5061, 'Eternal Accelgor', 'Normal', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5062, 5062, 'Eternal Aerodactyl', 'Rock', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5063, 5063, 'Eternal Rayquaza', 'Dragon', 'Flying', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5064, 5064, 'Eternal Growlithe', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5065, 5065, 'Eternal Arcanine', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5066, 5066, 'Eternal Vulpix', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5067, 5067, 'Eternal Ninetales', 'Fire', '', 'Ember', 'Ember', 'Ember', 'Ember'),
(5068, 5068, 'Eternal Pichu', 'Electric', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5069, 5069, 'Eternal Pikachu', 'Electric', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5070, 5070, 'Eternal Raichu', 'Electric', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5071, 5071, 'Eternal Caterpie', 'Bug', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5072, 5072, 'Eternal Metapod', 'Bug', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5073, 5073, 'Eternal Butterfree', 'Bug', 'Flying', 'Slam', 'Slam', 'Slam', 'Slam'),
(5074, 5074, 'Eternal Bagon', 'Dragon', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5075, 5075, 'Eternal Shelgon', 'Dragon', '', 'Slam', 'Slam', 'Slam', 'Slam'),
(5076, 5076, 'Eternal Salamence', 'Dragon', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5077, 5077, 'Eternal Heracross', 'Bug', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5078, 5078, 'Eternal Pinsir', 'Bug', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5079, 5079, 'Planet Vulpix', 'Fire', '', 'Scratch', 'Scratch', 'Ember', 'Ember'),
(5080, 5080, 'Planet Ninetales', 'Fire', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5081, 5081, 'Halloween Kyurem', 'Dragon', '', 'Shadow Armlet', 'Ember', 'Scratch', 'Scratch'),
(5082, 5082, 'Halloween Pachirisu', 'Electric', '', 'Thunder Punch', 'Thunder', 'Thunderbolt', 'Thundershock'),
(5083, 5083, 'Halloween Bellsprout', 'Normal', '', 'Fury Attack', 'Thrash', 'Constrict', 'Bite'),
(5084, 5084, 'Halloween Weepinbell', 'Normal', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5085, 5085, 'Halloween Victreebel', 'Normal', '', 'Bind', 'Thrash', 'Mega Punch', 'Wrap'),
(5086, 5086, 'Crystalic Nidoran', 'Normal', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5087, 5087, 'Halloween Feebas', 'Water', 'Dragon', 'Shadow Armlet', 'Ice Beam', 'Ice Beam', 'Shadow Armlet'),
(5088, 5088, 'Planet Feebas', 'Water', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5089, 5089, 'Halloween Milotic', 'Water', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5090, 5090, 'Halloween Dratini', 'Water', 'Dragon', 'Shadow Armlet', 'Scratch', 'Scratch', 'Shadow Armlet'),
(5091, 5091, 'Halloween Dragonair', 'Water', 'Dragon', 'Shadow Armlet', 'Scratch', 'Shadow Armlet', 'Shadow Armlet'),
(5092, 5092, 'Halloween Dragonite', 'Water', 'Dragon', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Scratch'),
(5093, 5093, 'Gyarados (Z)', 'Water', '', 'Crab Hammer', 'Bubblebeam', 'Waterfall', 'Bubblebeam'),
(5094, 5094, 'Gyarados (M)', 'Water', '', 'Hydro Pump', 'Clamp', 'Surf', 'Bubble'),
(5095, 5095, 'Gyarados (A)', 'Water', '', 'Bubble', 'Crab Hammer', 'Water Gun', 'Water Gun'),
(5096, 5096, 'Planet Jirachi', 'Normal', '', 'Shadow Armlet', 'Scratch', 'Ice Beam', 'Shadow Armlet'),
(5097, 5097, 'Crystalic Cyndaquil', 'Fire', '', 'Shadow Armlet', 'Scratch', 'Scratch', 'Scratch'),
(5098, 5098, 'Crystalic Quilava', 'Fire', '', 'Scratch', 'Scratch', 'Shadow Armlet', 'Shadow Armlet'),
(5099, 5099, 'Crystalic Typhlosion', 'Fire', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Scratch'),
(5100, 5100, 'Halloween Lugia', 'Flying', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5101, 5101, 'Rainbow Lapras', 'Water', 'Ice', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Ice Beam'),
(5102, 5102, 'Halloween Mothim', 'Bug', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5103, 5103, 'Rainbow Ponyta', 'Fire', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5104, 5104, 'Halloween Magikarp', 'Water', '', 'Shadow Armlet', 'Splash', 'Splash', 'Splash'),
(5105, 5105, 'Shadow Scyther', 'Grass', 'Flying', 'Shadow Armlet', 'Splash', 'Splash', 'Splash'),
(5106, 5106, 'Angleos', 'Normal', 'Psychic', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5107, 5107, 'Xmas Stantler', 'Normal', 'Psychic', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5108, 5108, 'Xmas Eevee', 'Normal', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5109, 5109, 'Xmas Celebi', 'Bug', 'Psychic', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5110, 5110, 'Rainbow Teddiursa', 'Normal', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5111, 5111, 'Rainbow Ursaring', 'Normal', '', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5112, 704, 'Goomy', 'Dragon', '', 'Body Slam', 'Absorb', 'Tackle', 'Bite'),
(5113, 5113, 'Eeveon', 'Grass', 'Water', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5114, 5114, 'Blaziken (Mega)', 'Fire', 'Flying', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5115, 5115, 'Feekarp', 'Water', 'Dragon', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5116, 5116, 'Gyaratic', 'Water', 'Dragon', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5117, 5117, 'Darkcune', 'Water', 'Dark', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5118, 5118, 'Mewtwo (Mega)', 'Psychic', 'Dark', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5119, 5119, 'Aggron (Mega)', 'Rock', 'Steel', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5120, 5120, 'Pikakip', 'Electric', 'Ground', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5121, 5121, 'Pikatomp', 'Electric', 'Ground', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5122, 5122, 'Raipert', 'Electric', 'Ground', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5123, 5123, 'Darkmuj', 'Dark', 'Ice', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5124, 5124, 'Alakazam (Mega)', 'Dark', 'Psychic', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5125, 5125, 'Tyrunt', 'Dragon', 'Rock', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5126, 5126, 'Tyrantrum', 'Dragon', 'Rock', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5127, 5127, 'Godtwo', 'God', 'God', 'Heavenly Strike', 'Heavenly Strike', 'God Armlet', 'God Armlet'),
(5128, 5128, 'Gengar (Mega)', 'Ghost', 'Dark', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5129, 5129, 'Tyranita (Mega)', 'Dark', 'Rock', 'Shadow Armlet', 'Heavenly Strike', 'Shadow Armlet', 'Shadow Armlet'),
(5130, 5130, 'Gyarados (Mega)', 'Dark', 'Dragon', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5131, 5131, 'Arceus (God)', 'God', 'God', 'Heavenly Strike', 'Heavenly Strike', 'God Armlet', 'God Armlet'),
(5132, 5132, 'Palkius (God)', 'God', 'God', 'Heavenly Strike', 'Heavenly Strike', 'Shadow Armlet', 'Shadow Armlet'),
(5133, 5133, 'Alakazam (Mega)', 'Psychic', 'Dark', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5134, 5134, 'Banette (Mega)', 'Dark', 'Ghost', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5135, 5135, 'Blastoise (Mega)', 'Water', 'Water', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5136, 5136, 'Mewtwo (Armor)', 'Psychic', 'Dark', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5137, 5137, 'Demondile', 'Water', 'Fire', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5138, 5138, 'Demonaw', 'Water', 'Fire', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5139, 5139, 'Demonzard', 'Water', 'Dragon', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5140, 5140, 'Solarsor', 'Electric', 'Bug', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5141, 5141, 'Lightsor', 'Fire', 'Bug', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5142, 5142, 'Darksor', 'Dark', 'Bug', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5143, 5143, 'Ghost', 'Ghost', 'Ghost', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5144, 5144, 'Asdd', 'Ghost', 'Ghost', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5145, 5145, 'Aggron (Mega)', 'Rock', 'Ground', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5146, 5146, 'Gardevoir (Mega)', 'Psychic', 'Psychic', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5147, 5147, 'Tyranitar (Mega)', 'Dragon', 'Ground', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5148, 5148, 'Venasaur (Mega)', 'Grass', 'Psychic', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5149, 5149, 'Metagross (Mega)', 'Psychic', 'Steel', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5150, 5150, 'Heracross (Mega)', 'Bug', 'Fighting', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet'),
(5151, 5151, 'Scizor (Mega)', 'Bug', 'Steel', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet', 'Shadow Armlet');

-- --------------------------------------------------------

--
-- Table structure for table `sale_history`
--

CREATE TABLE `sale_history` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(3) NOT NULL,
  `move1` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move2` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move3` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move4` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `soldto` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `sid` int(11) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `uid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sdeleted` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `udeleted` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `seen` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_pokemon`
--

CREATE TABLE `sale_pokemon` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `move1` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move2` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move3` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move4` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_money_history`
--

CREATE TABLE `send_money_history` (
  `id` int(11) NOT NULL,
  `sender_uid` int(11) NOT NULL,
  `recipient_uid` int(11) NOT NULL,
  `sender` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recipient` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `deleted_by_sender` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `deleted_by_recipient` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `seen_by_recipient` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_pokemon`
--

CREATE TABLE `shop_pokemon` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_pokemon`
--

INSERT INTO `shop_pokemon` (`id`, `name`, `price`, `category`) VALUES
(1, 'Golem', 40000, 'Normal'),
(2, 'Giratina', 145000, 'Legends'),
(3, 'Celebi', 100000, 'Legends'),
(4, 'Deoxys', 100000, 'Legends'),
(5, 'Poliwrath', 35000, 'Normal'),
(6, 'Porygon', 40000, 'Normal'),
(8, 'Charmander', 30000, 'Normal'),
(9, 'Shiny Kyogre', 250000, 'Shiny'),
(10, 'Aipom', 50000, 'Normal'),
(11, 'Shuckle', 50000, 'Normal'),
(12, 'Shiny Groudon', 250000, 'Shiny'),
(13, 'Hitmontop', 55000, 'Normal'),
(20, 'Shiny Palkia', 250000, 'Shiny'),
(15, 'Arceus', 100000, 'Legends'),
(17, 'Shiny Kyurem', 300000, 'Shiny'),
(19, 'Shiny Dialga', 250000, 'Shiny'),
(18, 'Skarmory', 50000, 'Normal'),
(16, 'Shiny Zekrom', 300000, 'Shiny'),
(21, 'Pinsir', 30000, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `shop_ref`
--

CREATE TABLE `shop_ref` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_ref`
--

INSERT INTO `shop_ref` (`id`, `name`, `price`) VALUES
(1, 'Shadow Charmander', 100),
(2, 'Shadow Caterpie', 30),
(3, 'Shiny Giratina', 30),
(4, 'Shiny Mothim', 25),
(5, 'Shadow Weedle', 30);

-- --------------------------------------------------------

--
-- Table structure for table `token_shop`
--

CREATE TABLE `token_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token_shop_pokemon`
--

CREATE TABLE `token_shop_pokemon` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token_shop_pokemon`
--

INSERT INTO `token_shop_pokemon` (`id`, `name`, `price`) VALUES
(185, 'Shiny Absol (Mega)', 50),
(182, 'Rainbow Charizard (X)', 300),
(183, 'Rainbow Charizard (Y)', 300),
(184, 'Absol (Mega)', 30),
(186, 'Rainbow Absol (Mega)', 150),
(187, 'Shiny Metagross (Mega)', 150),
(188, 'Shadow Charizard (X)', 300),
(189, 'Rainbow Blaziken (Mega)', 250);

-- --------------------------------------------------------

--
-- Table structure for table `trade_pokemon`
--

CREATE TABLE `trade_pokemon` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `move1` varchar(30) NOT NULL,
  `move2` varchar(30) NOT NULL,
  `move3` varchar(30) NOT NULL,
  `move4` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `got_promo` enum('0','1') NOT NULL DEFAULT '0',
  `battles` int(11) NOT NULL DEFAULT '0',
  `released` int(11) NOT NULL DEFAULT '0',
  `lottery` enum('0','1') NOT NULL DEFAULT '0',
  `color` varchar(25) NOT NULL,
  `premium` int(11) NOT NULL DEFAULT '0',
  `userbar` varchar(100) NOT NULL DEFAULT 'http://pkmnhelios.net/images/userbars/member.png',
  `password` varchar(255) NOT NULL DEFAULT '',
  `reset_key` varchar(25) NOT NULL,
  `admin` enum('0','1') NOT NULL DEFAULT '0',
  `mod` enum('0','1') NOT NULL DEFAULT '0',
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `ban_reason` varchar(200) NOT NULL,
  `rank` varchar(225) NOT NULL,
  `money` int(11) NOT NULL DEFAULT '10000',
  `post` int(11) NOT NULL DEFAULT '0',
  `map_num` int(2) NOT NULL DEFAULT '0',
  `map_sprite` int(2) NOT NULL DEFAULT '1',
  `map_x` int(2) NOT NULL DEFAULT '0',
  `map_y` int(2) NOT NULL DEFAULT '0',
  `map_lastseen` int(11) NOT NULL DEFAULT '0',
  `won` int(11) NOT NULL DEFAULT '0',
  `lost` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `signup_date` int(10) NOT NULL,
  `last_promo` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  `ip2` varchar(15) NOT NULL,
  `lastseen` bigint(20) NOT NULL DEFAULT '0',
  `signature` varchar(500) NOT NULL DEFAULT 'I can''t think of a signature',
  `poke1` int(11) NOT NULL DEFAULT '0',
  `poke2` int(11) NOT NULL DEFAULT '0',
  `poke3` int(11) NOT NULL DEFAULT '0',
  `poke4` int(11) NOT NULL DEFAULT '0',
  `poke5` int(11) NOT NULL DEFAULT '0',
  `poke6` int(11) NOT NULL DEFAULT '0',
  `bank` bigint(200) NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL,
  `Referals` int(11) NOT NULL DEFAULT '0',
  `token` int(11) NOT NULL DEFAULT '0',
  `fan` enum('0','1') NOT NULL,
  `clan` varchar(255) NOT NULL,
  `clanxp` bigint(20) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'http://pkmnhelios.net/images/Avatars/helios member.png',
  `trainer_exp` int(11) NOT NULL,
  `total_messages` int(11) NOT NULL DEFAULT '0',
  `unread_messages` int(11) NOT NULL DEFAULT '0',
  `total_sale_pokes` int(11) NOT NULL DEFAULT '0',
  `newly_sold_pokes` int(11) NOT NULL DEFAULT '0',
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `register_ip` varchar(15) NOT NULL DEFAULT '0',
  `champ_times` int(11) NOT NULL DEFAULT '0',
  `champ_longest_run` int(11) NOT NULL DEFAULT '0',
  `champ_total_time` int(11) NOT NULL DEFAULT '0',
  `dailyprize` int(11) NOT NULL DEFAULT '0',
  `last_dailyprize` int(11) NOT NULL,
  `lucky_hour` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `got_promo`, `battles`, `released`, `lottery`, `color`, `premium`, `userbar`, `password`, `reset_key`, `admin`, `mod`, `banned`, `ban_reason`, `rank`, `money`, `post`, `map_num`, `map_sprite`, `map_x`, `map_y`, `map_lastseen`, `won`, `lost`, `email`, `signup_date`, `last_promo`, `ip`, `ip2`, `lastseen`, `signature`, `poke1`, `poke2`, `poke3`, `poke4`, `poke5`, `poke6`, `bank`, `reason`, `Referals`, `token`, `fan`, `clan`, `clanxp`, `avatar`, `trainer_exp`, `total_messages`, `unread_messages`, `total_sale_pokes`, `newly_sold_pokes`, `ref_id`, `register_ip`, `champ_times`, `champ_longest_run`, `champ_total_time`, `dailyprize`, `last_dailyprize`, `lucky_hour`) VALUES
(1, 'admin', '0', 15, 0, '0', '', 0, 'http://pkmnhelios.net/images/userbars/member.png', 'c8327a1a070905aeda589bda50fcfaf30127f357', '', '0', '0', '0', '', '', 21568, 0, 1, 1, 16, 6, 1610461649, 15, 0, 'barrosbleo@gmail.com', 1602194917, 0, '::1', '::1', 1610461656, 'I can\'t think of a signature', 1, 0, 0, 0, 0, 0, 50, '', 0, 0, '0', '', 0, 'http://localhost/images/trainers/000.png', 2350, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0),
(2, 'fuladodetal', '0', 0, 0, '0', '', 0, 'http://pkmnhelios.net/images/userbars/member.png', 'b041033233985da27c8e9bf10693c22ff9a2f590', '', '0', '0', '0', '', '', 20000, 0, 1, 1, 0, 0, 0, 0, 0, 'fulano@aaa.xcom', 1610130703, 0, '', '', 0, 'I can\'t think of a signature', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '0', '', 0, 'http://pkmnhelios.net/images/Avatars/helios member.png', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE `user_badges` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `badge` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

CREATE TABLE `user_items` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `poke_ball` int(4) NOT NULL,
  `great_ball` int(4) NOT NULL,
  `ultra_ball` int(4) NOT NULL,
  `master_ball` int(4) NOT NULL,
  `potion` int(4) NOT NULL,
  `super_potion` int(4) NOT NULL,
  `hyper_potion` int(4) NOT NULL,
  `burn_heal` int(4) NOT NULL,
  `full_heal` int(4) NOT NULL,
  `parlyz_heal` int(4) NOT NULL,
  `antidote` int(4) NOT NULL,
  `awakening` int(4) NOT NULL,
  `ice_heal` int(4) NOT NULL,
  `dawn_stone` int(4) NOT NULL,
  `dusk_stone` int(4) NOT NULL,
  `fire_stone` int(4) NOT NULL,
  `leaf_stone` int(4) NOT NULL,
  `moon_stone` int(4) NOT NULL,
  `oval_stone` int(4) NOT NULL,
  `shiny_stone` int(4) NOT NULL,
  `sun_stone` int(4) NOT NULL,
  `thunder_stone` int(4) NOT NULL,
  `water_stone` int(4) NOT NULL,
  `rare_candy` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_items`
--

INSERT INTO `user_items` (`id`, `uid`, `poke_ball`, `great_ball`, `ultra_ball`, `master_ball`, `potion`, `super_potion`, `hyper_potion`, `burn_heal`, `full_heal`, `parlyz_heal`, `antidote`, `awakening`, `ice_heal`, `dawn_stone`, `dusk_stone`, `fire_stone`, `leaf_stone`, `moon_stone`, `oval_stone`, `shiny_stone`, `sun_stone`, `thunder_stone`, `water_stone`, `rare_candy`) VALUES
(1, 1, 21, 15, 10, 5, 20, 10, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 0),
(2, 0, 20, 15, 10, 5, 20, 10, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `uid`, `username`, `ip`, `timestamp`) VALUES
(1, 1, 'admin', '::1', 1602194918),
(2, 1, 'admin', '::1', 1603312661),
(3, 1, 'admin', '::1', 1603314602),
(4, 1, 'admin', '::1', 1603314702),
(5, 1, 'admin', '::1', 1603314904),
(6, 1, 'admin', '::1', 1603315334),
(7, 1, 'admin', '::1', 1603316187),
(8, 1, 'admin', '::1', 1603318786),
(9, 1, 'admin', '::1', 1603319075),
(10, 1, 'admin', '::1', 1605125162),
(11, 1, 'admin', '::1', 1610036022),
(12, 1, 'admin', '::1', 1610036589),
(13, 1, 'admin', '::1', 1610102915),
(14, 1, 'admin', '::1', 1610103067),
(15, 1, 'admin', '::1', 1610106469),
(16, 1, 'admin', '::1', 1610107448),
(17, 1, 'admin', '::1', 1610110228),
(18, 1, 'admin', '::1', 1610113323),
(19, 1, 'admin', '::1', 1610113373),
(20, 1, 'admin', '::1', 1610113566),
(21, 1, 'admin', '::1', 1610113617),
(22, 1, 'admin', '::1', 1610114016),
(23, 1, 'admin', '::1', 1610122009),
(24, 1, 'admin', '::1', 1610124066),
(25, 1, 'admin', '::1', 1610124762),
(26, 1, 'admin', '::1', 1610128418),
(27, 1, 'admin', '', 1610132151),
(28, 1, 'admin', '::1', 1610375124),
(29, 1, 'admin', '::1', 1610379269),
(30, 1, 'admin', '::1', 1610379451),
(31, 1, 'admin', '::1', 1610381287),
(32, 1, 'admin', '::1', 1610391875),
(33, 1, 'admin', '::1', 1610392218),
(34, 1, 'admin', '::1', 1610454320),
(35, 1, 'admin', '::1', 1610456206),
(36, 1, 'admin', '::1', 1610457259),
(37, 1, 'admin', '::1', 1610457535),
(38, 1, 'admin', '::1', 1610459236),
(39, 1, 'admin', '::1', 1610459921),
(40, 1, 'admin', '::1', 1610460715),
(41, 1, 'admin', '::1', 1610461656);

-- --------------------------------------------------------

--
-- Table structure for table `user_pokemon`
--

CREATE TABLE `user_pokemon` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `level` int(255) NOT NULL,
  `exp` int(255) NOT NULL,
  `move1` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move2` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move3` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `move4` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `gender` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `nickname` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT 'None',
  `type` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_pokemon`
--

INSERT INTO `user_pokemon` (`id`, `uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `gender`, `nickname`, `type`) VALUES
(1, 1, 'Charmander', 15, 2350, 'Scratch', 'Growl', 'Ember', 'Leer', '1', 'None', ''),
(2, 0, 'Bulbasaur', 15, 2250, 'Tackle', 'Growl', 'Leech Seed', 'Vine Whip', '1', 'None', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_quests`
--

CREATE TABLE `user_quests` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `progr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_quests`
--

INSERT INTO `user_quests` (`id`, `uid`, `qid`, `progr`) VALUES
(5, 1, 1, 1),
(6, 1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `5050`
--
ALTER TABLE `5050`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction_history`
--
ALTER TABLE `auction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction_pokemon`
--
ALTER TABLE `auction_pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `clans`
--
ALTER TABLE `clans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo_twitter_timeline`
--
ALTER TABLE `demo_twitter_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evolution`
--
ALTER TABLE `evolution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_groups`
--
ALTER TABLE `gym_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gym_leaders`
--
ALTER TABLE `gym_leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_ref`
--
ALTER TABLE `link_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lucky_hour`
--
ALTER TABLE `lucky_hour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medals`
--
ALTER TABLE `medals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mines`
--
ALTER TABLE `mines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mine_shop`
--
ALTER TABLE `mine_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moves`
--
ALTER TABLE `moves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_images`
--
ALTER TABLE `new_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `npc`
--
ALTER TABLE `npc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `numbergame`
--
ALTER TABLE `numbergame`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `offer_pokemon`
--
ALTER TABLE `offer_pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokedex`
--
ALTER TABLE `pokedex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_history`
--
ALTER TABLE `sale_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_pokemon`
--
ALTER TABLE `sale_pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_money_history`
--
ALTER TABLE `send_money_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_pokemon`
--
ALTER TABLE `shop_pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_ref`
--
ALTER TABLE `shop_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_shop`
--
ALTER TABLE `token_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_shop_pokemon`
--
ALTER TABLE `token_shop_pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_pokemon`
--
ALTER TABLE `trade_pokemon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_pokemon`
--
ALTER TABLE `user_pokemon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user_quests`
--
ALTER TABLE `user_quests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `5050`
--
ALTER TABLE `5050`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_history`
--
ALTER TABLE `auction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auction_pokemon`
--
ALTER TABLE `auction_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clans`
--
ALTER TABLE `clans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `demo_twitter_timeline`
--
ALTER TABLE `demo_twitter_timeline`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evolution`
--
ALTER TABLE `evolution`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5081;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gym_groups`
--
ALTER TABLE `gym_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gym_leaders`
--
ALTER TABLE `gym_leaders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `link_ref`
--
ALTER TABLE `link_ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lucky_hour`
--
ALTER TABLE `lucky_hour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medals`
--
ALTER TABLE `medals`
  MODIFY `id` smallint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mines`
--
ALTER TABLE `mines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mine_shop`
--
ALTER TABLE `mine_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `moves`
--
ALTER TABLE `moves`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_images`
--
ALTER TABLE `new_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `npc`
--
ALTER TABLE `npc`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `numbergame`
--
ALTER TABLE `numbergame`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `offer_pokemon`
--
ALTER TABLE `offer_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pokedex`
--
ALTER TABLE `pokedex`
  MODIFY `id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5245;

--
-- AUTO_INCREMENT for table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5152;

--
-- AUTO_INCREMENT for table `sale_history`
--
ALTER TABLE `sale_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_pokemon`
--
ALTER TABLE `sale_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_money_history`
--
ALTER TABLE `send_money_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_pokemon`
--
ALTER TABLE `shop_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `shop_ref`
--
ALTER TABLE `shop_ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `token_shop`
--
ALTER TABLE `token_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token_shop_pokemon`
--
ALTER TABLE `token_shop_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `trade_pokemon`
--
ALTER TABLE `trade_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_pokemon`
--
ALTER TABLE `user_pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_quests`
--
ALTER TABLE `user_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
