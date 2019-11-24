-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 03:41 AM
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
-- Table structure for table `tbl_guru`
--

CREATE TABLE IF NOT EXISTS `tbl_guru` (
`id_guru` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `unique_id` varchar(23) NOT NULL,
  `salt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_praktikum`
--

CREATE TABLE IF NOT EXISTS `tb_hasil_praktikum` (
`id_hasil_praktikum` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `foto_pengamatan_akar` varchar(50) NOT NULL,
  `foto_pengamatan_batang` varchar(50) NOT NULL,
  `foto_pengamatan_daun` varchar(50) NOT NULL,
  `foto_jaringan_akar` varchar(50) NOT NULL,
  `foto_jaringan_batang` varchar(50) NOT NULL,
  `foto_jaringan_daun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE IF NOT EXISTS `tb_soal` (
`id_soal` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `pertanyaan1` varchar(100) NOT NULL,
  `jawaban1` varchar(100) NOT NULL,
  `pertanyaan2` varchar(100) NOT NULL,
  `jawaban2` varchar(100) NOT NULL,
  `pertanyaan3` varchar(100) NOT NULL,
  `jawaban3` int(100) NOT NULL,
  `pertanyaan4` int(100) NOT NULL,
  `jawaban4` int(100) NOT NULL,
  `pertanyaan5` int(100) NOT NULL,
  `jawaban5` int(100) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
 ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tbl_murid`
--
ALTER TABLE `tbl_murid`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_hasil_praktikum`
--
ALTER TABLE `tb_hasil_praktikum`
 ADD PRIMARY KEY (`id_hasil_praktikum`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
 ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_murid`
--
ALTER TABLE `tbl_murid`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_hasil_praktikum`
--
ALTER TABLE `tb_hasil_praktikum`
MODIFY `id_hasil_praktikum` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
