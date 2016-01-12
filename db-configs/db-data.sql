-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2015 at 08:23 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sportleague`
--

--
-- Dumping data for table `arena`
--

INSERT INTO `arena` (`id`, `name`, `adress`, `city`, `owner`) VALUES
(1, 'Rickardhs arena', 'Gustav Lakes väg 5a', 'Skövde', 1),
(2, 'Lillegården', 'Jag vet inte', 'Skövde', 2);

--
-- Dumping data for table `audience`
--

INSERT INTO `audience` (`id`, `total`, `game_id`) VALUES
(1, 9001, 4);

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `type_id`, `game_person_id`) VALUES
(1, 2, 3),
(2, 3, 2);

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `name`) VALUES
(1, 'Yellow card'),
(2, 'Red card'),
(3, 'Direct free kick'),
(4, 'Penalty kick');

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `start_time`, `home_team_id`, `gone_team_id`, `status_id`, `arena_id`, `season_id`) VALUES
(4, '2015-09-15 08:02:20', 1, 2, 1, 1, 1),
(5, '2015-09-16 04:39:20', 2, 1, 5, 2, 1);

--
-- Dumping data for table `game_person_link`
--

INSERT INTO `game_person_link` (`id`, `team_person_id`, `game_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4);

--
-- Dumping data for table `game_status`
--

INSERT INTO `game_status` (`id`, `name`) VALUES
(1, 'Playing'),
(2, 'Cancel'),
(3, 'Moved'),
(4, 'Ended'),
(5, 'Scheduled');

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `game_person_id`, `type`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 2, 1),
(6, 2, 1);

--
-- Dumping data for table `org`
--

INSERT INTO `org` (`id`, `name`) VALUES
(1, 'Rickardhs cool guy club'),
(2, 'IFK'),
(3, 'AIK');

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `fname`, `sname`, `social_sec`) VALUES
(1, 'Rickardh', 'Forslund', 123456789),
(2, 'Hannes', 'Kindströmmer', 987654321),
(3, 'Pontus', 'Astanius', 872343618),
(4, 'Pontus', 'Erlandsson', 378912984),
(5, 'Erik', 'Westin', 18928490128);

--
-- Dumping data for table `role`
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

--
-- Dumping data for table `season`
--

INSERT INTO `season` (`id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Skövde pros cup', '2015-09-15 07:54:16', '2015-09-22 21:59:59');

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `org_id`) VALUES
(1, 'We are the best', 1),
(2, 'Yolo', 2);

--
-- Dumping data for table `team_person_leave`
--

INSERT INTO `team_person_leave` (`id`, `team_person_id`, `leavedate`) VALUES
(1, 4, '2015-09-15 08:55:22');

--
-- Dumping data for table `team_person_link`
--

INSERT INTO `team_person_link` (`id`, `joindate`, `role_id`, `team_id`, `person_id`, `shirt_nr`) VALUES
(1, '2015-09-15 07:50:53', 1, 1, 1, 1337),
(2, '2015-09-15 07:51:34', 6, 2, 2, 4),
(3, '2015-09-15 07:51:34', 8, 1, 3, 6),
(4, '2015-09-15 07:51:59', 4, 2, 4, 8),
(5, '2015-09-15 07:51:59', 11, 1, 5, 123);

--
-- Dumping data for table `team_season_link`
--

INSERT INTO `team_season_link` (`id`, `season_id`, `team_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
