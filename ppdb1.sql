-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2023 at 01:44 PM
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
-- Database: `ppdb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nm_dpn` text NOT NULL,
  `nm_blkg` text NOT NULL,
  `adm_email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `tgl_daftar`, `nm_dpn`, `nm_blkg`, `adm_email`, `password`, `foto`) VALUES
(6, '2023-06-13 02:36:21', 'admin', 'kedua', 'admin@admin', '$2y$10$od8JNKEZt7DRR9rAvIFhfe.YqOW7530MjHJzl7Uk7McXkMeeZRgTi', '6479eb6b949ec.png'),
(9, '2023-06-13 02:43:57', 'fwq', 'fwqqwf', 'surya@gmail.com', '$2y$10$J2W/dqdnSaRToyCOHVNMAOZxO3emFCmtU1uYKDCBDXsInUN1wf2qe', '6487757ceaafd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `userid` int(11) NOT NULL,
  `ijazah` text DEFAULT NULL,
  `kk` text DEFAULT NULL,
  `rapor` text DEFAULT NULL,
  `akta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`userid`, `ijazah`, `kk`, `rapor`, `akta`) VALUES
(20, '64877ca4dd4b1.png', '64877ca4dd556.jpg', '64877d303e2b4.jpg', '64877d412c2ca.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `userid` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `npsn` varchar(20) NOT NULL,
  `agama` text DEFAULT NULL,
  `asal_sekolah` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `foto` text DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'Belum Terkonfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`userid`, `id_data`, `nama`, `jk`, `tmp_lahir`, `tgl_lahir`, `npsn`, `agama`, `asal_sekolah`, `alamat`, `foto`, `status`) VALUES
(20, 77, 'Muhammad Surya', 'Laki-Laki', 'Bekasi', '2002-12-28', '2131', 'Islam', 'SMAN 9 BEKASI', 'karawang', '648779f66aed0.jpg', 'Belum Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `nm_dpn` text NOT NULL,
  `nm_blkg` text NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text DEFAULT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `nm_dpn`, `nm_blkg`, `user_email`, `password`, `foto`, `tgl_daftar`) VALUES
(19, 'Muhammad Surya', 'Rusfauzi', 'surya@gmail.com', '$2y$10$od8JNKEZt7DRR9rAvIFhfe.YqOW7530MjHJzl7Uk7McXkMeeZRgTi', NULL, '2023-06-12 19:04:58'),
(20, 'Muhammad Surya', 'Rusfauzi', '2110631170084@student.unsika.a', '$2y$10$osBUwEBW223DVtAghjJGbu.sQhyMthLjOxn4XpEsO9i4mJoNQf.7u', NULL, '2023-06-12 19:56:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
