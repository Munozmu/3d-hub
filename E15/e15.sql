-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2021 at 09:14 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e15`
--

-- --------------------------------------------------------

--
-- Table structure for table `asks`
--

CREATE TABLE `asks` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asks`
--

INSERT INTO `asks` (`id`, `title`, `description`, `user`) VALUES
(1, 'Voici le titre de la première demande', 'Voici la description', 'le_utilisateur'),
(15, 'title', 'descr', 'user'),
(16, 'tiztle', 'descr', 'user'),
(17, 'titre de la demande', 'dee', 'e'),
(18, 'zdz', 'dd', ''),
(19, 'zdzqd', 'qzd', 'munozmu'),
(20, 'Demande impression pièce auto', 'bonjour, pouvez-vous blahbkah', 'munozmu');

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mdp`, `mail`) VALUES
(3, 'munozmu', '7ef0242fceeabbc1c36a3ac7f5d668d3', 'munozgabinmg8@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asks`
--
ALTER TABLE `asks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asks`
--
ALTER TABLE `asks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
