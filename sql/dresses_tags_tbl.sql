-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 04:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `dresses_tags_tbl`
--

CREATE TABLE `dresses_tags_tbl` (
  `id` int(11) NOT NULL,
  `tag` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dresses_tags_tbl`
--

INSERT INTO `dresses_tags_tbl` (`id`, `tag`) VALUES
(1, 'Sheroes'),
(2, 'Heroes'),
(3, 'Sarees'),
(4, 'Weddings'),
(5, 'Traditions'),
(6, 'Womenswear'),
(7, 'Menswear'),
(8, 'Folk'),
(9, 'Dances'),
(10, 'Costumes'),
(11, 'Professions'),
(12, 'Scientists'),
(13, 'Changemakers'),
(14, 'Freedom Fighters'),
(15, 'Armed Forces'),
(16, 'Characters');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dresses_tags_tbl`
--
ALTER TABLE `dresses_tags_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dresses_tags_tbl`
--
ALTER TABLE `dresses_tags_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
