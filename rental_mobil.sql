-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 04:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` int(11) NOT NULL,
  `id_kembali` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `total_bayar` decimal(10,2) DEFAULT NULL,
  `status` enum('lunas','belum lunas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kembali`
--

CREATE TABLE `tb_kembali` (
  `id_kembali` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `kondisi_mobil` text DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `nik` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`nik`, `nama`, `jk`, `telp`, `alamat`, `username`, `pass`) VALUES
(100, 'isal', 'L', '0858056787', 'pucang', 'isal', '43c2a5745cd71241f50207cbfa266fd3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `nopol` varchar(10) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tahun` date NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `status` enum('tersedia','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`nopol`, `brand`, `type`, `tahun`, `harga`, `foto`, `status`) VALUES
('AA1234B', 'Toyota', 'a', '2024-10-08', '100000.00', 'mobil.jpg', 'tersedia'),
('B 1122 YZA', 'Daihatsu', 'Terios', '2020-09-12', '370000.00', 'Daihatsu_Terios_2018.jpg', 'tersedia'),
('B 1234 ABC', 'Toyota', 'Avanza', '2020-01-01', '300000.00', 'avanza2020.jpg', 'tersedia'),
('B 3344 MNO', 'Mitsubishi', 'Xpander', '2021-05-05', '400000.00', 'xpander.jpg', 'tersedia'),
('D 3344 ZBC', 'Honda', 'BR-V', '2021-12-01', '380000.00', 'Honda_BR-V_2019.jpg', 'tersedia'),
('D 5566 PQR', 'Nissan', 'Livina', '2019-11-20', '340000.00', 'nisanlivina.jpg', 'tersedia'),
('D 5678 DEF', 'Honda', 'Mobilio', '2019-06-15', '350000.00', 'hondamobilio.jpg', 'tersedia'),
('H 7788 STU', 'Wuling', 'Confero', '2020-03-18', '310000.00', 'confero.png', 'tersedia'),
('H 9101 GHI', 'Suzuki', 'Ertiga', '2021-08-25', '320000.00', 'suzukiertiga.jpg', 'tersedia'),
('L 1122 JKL', 'Daihatsu', 'Xenia', '2020-10-10', '280000.00', 'Xenia2019.jpg', 'tersedia'),
('L 9900 VWX', 'Toyota', 'Rush', '2021-07-30', '360000.00', 'rush.png', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nik` int(11) DEFAULT NULL,
  `nopol` varchar(10) DEFAULT NULL,
  `tgl_booking` date DEFAULT NULL,
  `tgl_ambil` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `supir` tinyint(1) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `downpayment` decimal(10,2) DEFAULT 100000.00,
  `kekurangan` decimal(10,2) DEFAULT NULL,
  `status` enum('booking','approve','ambil','kembali') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `pass`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_kembali`
--
ALTER TABLE `tb_kembali`
  ADD PRIMARY KEY (`id_kembali`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`nopol`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kembali`
--
ALTER TABLE `tb_kembali`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
