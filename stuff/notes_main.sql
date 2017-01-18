-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2017 at 04:34 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes_main`
--

CREATE TABLE `notes_main` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `notes` longtext COLLATE latin1_german2_ci,
  `urls` longtext COLLATE latin1_german2_ci,
  `date_modified` datetime DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `type` smallint(6) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes_main`
--
ALTER TABLE `notes_main`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `parent` (`parent`),
  ADD KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes_main`
--
ALTER TABLE `notes_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
