-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 01:52 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yayasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `nama_kk` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `status` varchar(55) NOT NULL,
  `no_kk` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `nama_kk`, `alamat`, `tgl_lahir`, `telepon`, `status`, `no_kk`) VALUES
(1, 'Dopi', 'Ucok', 'Cikampek', '2022-07-03', '085817073610', 'Nonaktif', '32151865234511'),
(2, 'Krisna', 'Ucok', 'Boyolali', '2022-07-01', '089877654432', 'Aktif', '321515123451');

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id_keluarga` int(11) NOT NULL,
  `nama_kk` varchar(50) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `tgl_lahir` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id_keluarga`, `nama_kk`, `alamat`, `tgl_lahir`, `telepon`, `no_kk`, `status`) VALUES
(1, 'Ucok', 'Tanjung Barat, Cikampek Selatan', '2022-07-04', '081398013736', '3215152212990001', 'Aktif'),
(7, 'Yonathan ', 'Kp marga mulya no 4 rt 2 rt 1', '2022-07-01', '089877654432', '32151865234511', 'Aktif'),
(10, 'gigi', 'Cikampek', '2022-07-06', '089877654432', '321515123451', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pb` int(11) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `jatuh_tempo` varchar(50) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `nobayar` varchar(50) NOT NULL,
  `tglbayar` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `ket` enum('LUNAS','HUTANG') DEFAULT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id_tahun` int(11) NOT NULL,
  `nama_tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `nama_tahun`) VALUES
(1, '2022'),
(3, '2023'),
(4, '2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pb`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
