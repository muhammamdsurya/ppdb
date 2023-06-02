-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2023 at 03:08 PM
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
  `password` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `tgl_daftar`, `nm_dpn`, `nm_blkg`, `adm_email`, `password`, `foto`) VALUES
(3, '2023-05-28 19:19:25', 'Admin', 'Blkg', 'admin@admin', 'admin', '647346cdb271a.png'),
(4, '2023-05-28 03:38:35', 'admin', 'two', 'admintwo@gmail.com', '321', '64726a4bcef0a.jpg'),
(5, '2023-05-28 04:08:22', 'admin', 'two', 'admin@admin', '123', '6472714631f67.jpg');

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
(14, '64726e110dd7b.jpg', '64726e110e1bd.png', '64726e110e275.jpg', '64726e110e30f.jpeg'),
(15, '6473467998a03.jpeg', '6473467998db5.png', '6473467998e4e.jpg', '6473467998edf.jpg');

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
(14, 72, 'Risky Aja', 'Laki-Laki', 'BANYUMAS', '2002-12-28', '23213213123', 'Kristen', 'SMAN 9 BEKASI', 'karawang', '64726dcec2d20.jpg', 'Terkonfirmasi'),
(15, 73, 'Naisya Dilla', 'Perempuan', 'Purwakarta', '2002-01-23', '2312322123', 'Islam', 'SMK Teratai Putih', 'Bekasi', '6473464c53df1.jpg', 'Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `nm_dpn` text NOT NULL,
  `nm_blkg` text NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto` text DEFAULT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `nm_dpn`, `nm_blkg`, `user_email`, `password`, `foto`, `tgl_daftar`) VALUES
(13, 'rojak', 'adi', 'rojak@gmail.com', '123', NULL, '2023-05-27 20:49:18'),
(14, 'Rizky', 'aja', 'riski@gmail.com', '123', NULL, '2023-05-27 20:52:09'),
(15, 'Naisya ', 'Dillaa', 'dillanaisya@gmail.com', 'abijar123', '', '2023-05-28 12:16:10');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
