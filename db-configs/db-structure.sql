-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 15 sep 2015 kl 20:14
-- Serverversion: 5.5.44-0ubuntu0.14.04.1
-- PHP-version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `sportleague`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `arena`
--

CREATE TABLE IF NOT EXISTS `arena` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `arena`
--

INSERT INTO `arena` (`id`, `name`, `adress`, `city`, `owner`) VALUES
(1, 'Rickardhs arena', 'Gustav Lakes väg 5a', 'Skövde', 1),
(2, 'Lillegården', 'Jag vet inte', 'Skövde', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `audience`
--

CREATE TABLE IF NOT EXISTS `audience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `audience`
--

INSERT INTO `audience` (`id`, `total`, `game_id`) VALUES
(1, 9001, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `game_person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `events`
--

INSERT INTO `events` (`id`, `type_id`, `game_person_id`) VALUES
(1, 2, 3),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `event_types`
--

CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `event_types`
--

INSERT INTO `event_types` (`id`, `name`) VALUES
(1, 'Yellow card'),
(2, 'Red card'),
(3, 'Direct free kick'),
(4, 'Penalty kick');

-- --------------------------------------------------------

--
-- Tabellstruktur `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `home_team_id` int(11) NOT NULL,
  `gone_team_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `season_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `game`
--

INSERT INTO `game` (`id`, `start_time`, `home_team_id`, `gone_team_id`, `status_id`, `arena_id`, `season_id`) VALUES
(4, '2015-09-15 08:02:20', 1, 2, 1, 1, 1),
(5, '2015-09-16 04:39:20', 2, 1, 5, 2, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `game_person_link`
--

CREATE TABLE IF NOT EXISTS `game_person_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_person_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `game_person_link`
--

INSERT INTO `game_person_link` (`id`, `team_person_id`, `game_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur `game_status`
--

CREATE TABLE IF NOT EXISTS `game_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `game_status`
--

INSERT INTO `game_status` (`id`, `name`) VALUES
(1, 'Playing'),
(2, 'Cancel'),
(3, 'Moved'),
(4, 'Ended'),
(5, 'Scheduled');

-- --------------------------------------------------------

--
-- Tabellstruktur `goals`
--

CREATE TABLE IF NOT EXISTS `goals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_person_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumpning av Data i tabell `goals`
--

INSERT INTO `goals` (`id`, `game_person_id`, `type`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 2, 1),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `org`
--

CREATE TABLE IF NOT EXISTS `org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `org`
--

INSERT INTO `org` (`id`, `name`) VALUES
(1, 'Rickardhs cool guy club'),
(2, 'IFK'),
(3, 'AIK');

-- --------------------------------------------------------

--
-- Tabellstruktur `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `sname` varchar(40) NOT NULL,
  `social_sec` bigint(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `person`
--

INSERT INTO `person` (`id`, `fname`, `sname`, `social_sec`) VALUES
(1, 'Rickardh', 'Forslund', 123456789),
(2, 'Hannes', 'Kindströmmer', 987654321),
(3, 'Pontus', 'Astanius', 872343618),
(4, 'Pontus', 'Erlandsson', 378912984),
(5, 'Erik', 'Westin', 18928490128);

-- --------------------------------------------------------

--
-- Tabellstruktur `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Forward'),
(2, 'Wing Forward'),
(3, 'Center Forward'),
(4, 'Striker'),
(5, 'Midfielder'),
(6, 'Center Midfielder'),
(7, 'Defender'),
(8, 'Sweeper'),
(9, 'Right'),
(10, 'Left'),
(11, 'Center');

-- --------------------------------------------------------

--
-- Tabellstruktur `season`
--

CREATE TABLE IF NOT EXISTS `season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `season`
--

INSERT INTO `season` (`id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Skövde pros cup', '2015-09-15 07:54:16', '2015-09-22 21:59:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `org_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `team`
--

INSERT INTO `team` (`id`, `name`, `org_id`) VALUES
(1, 'We are the best', 1),
(2, 'Yolo', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `team_person_leave`
--

CREATE TABLE IF NOT EXISTS `team_person_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_person_id` int(11) NOT NULL,
  `leavedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `team_person_leave`
--

INSERT INTO `team_person_leave` (`id`, `team_person_id`, `leavedate`) VALUES
(1, 4, '2015-09-15 08:55:22');

-- --------------------------------------------------------

--
-- Tabellstruktur `team_person_link`
--

CREATE TABLE IF NOT EXISTS `team_person_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `shirt_nr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `team_person_link`
--

INSERT INTO `team_person_link` (`id`, `joindate`, `role_id`, `team_id`, `person_id`, `shirt_nr`) VALUES
(1, '2015-09-15 07:50:53', 1, 1, 1, 1337),
(2, '2015-09-15 07:51:34', 6, 2, 2, 4),
(3, '2015-09-15 07:51:34', 8, 1, 3, 6),
(4, '2015-09-15 07:51:59', 4, 2, 4, 8),
(5, '2015-09-15 07:51:59', 11, 1, 5, 123);

-- --------------------------------------------------------

--
-- Tabellstruktur `team_season_link`
--

CREATE TABLE IF NOT EXISTS `team_season_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `season_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `team_season_link`
--

INSERT INTO `team_season_link` (`id`, `season_id`, `team_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
