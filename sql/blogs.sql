-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 07:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abcd_db`
--
-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `Blog_Id` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Author` varchar(50) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Video_Link` varchar(200) DEFAULT NULL,
  `Modified_Time` datetime DEFAULT NULL,
  `Created_Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`Blog_Id`, `Title`, `Author`, `Description`, `Video_Link`, `Modified_Time`, `Created_Time`) VALUES
(1, 'asd', 'asdf', 'asdf', '', '2023-07-16 20:25:14', '2023-07-16 20:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `blog_pictures`
--

CREATE TABLE `blog_pictures` (
  `Picture_Id` int(11) NOT NULL,
  `Blog_Id` int(11) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`Blog_Id`);

--
-- Indexes for table `blog_pictures`
--
ALTER TABLE `blog_pictures`
  ADD PRIMARY KEY (`Picture_Id`),
  ADD KEY `Blog_Id` (`Blog_Id`);

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `Blog_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  ADD `Video_Link2` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `Video_Link`;
  ADD `Video_Link3` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL AFTER `Video_Link2`;

--
-- AUTO_INCREMENT for table `blog_pictures`
--
ALTER TABLE `blog_pictures`
  MODIFY `Picture_Id` int(11) NOT NULL AUTO_INCREMENT;
