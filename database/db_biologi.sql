-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2019 at 12:46 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_biologi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_murid`
--

CREATE TABLE IF NOT EXISTS `tbl_murid` (
`id` int(11) NOT NULL,
  `unique_id` varchar(23) NOT NULL,
  `username` varchar(23) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_murid`
--

INSERT INTO `tbl_murid` (`id`, `unique_id`, `username`, `nama`, `password`, `salt`, `kelas`, `mata_pelajaran`) VALUES
(4, '5dd7c5ba0d5440.54065892', 'murid', 'murid', '5N6jmTwUdvobQaUS0cf8xLbtuB8xZmVkMzA0NmQy', '1fed3046d2', 'B', 'IPS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_murid`
--
ALTER TABLE `tbl_murid`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_murid`
--
ALTER TABLE `tbl_murid`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
