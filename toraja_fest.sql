-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 09:36 PM
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
-- Database: `toraja_fest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_events` int(255) NOT NULL,
  `jumlah_events` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `nama`, `harga_events`, `jumlah_events`, `image`) VALUES
(14, 0, '', 100000, 1, 'rambu solo1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_events` int(100) NOT NULL,
  `nama_events` varchar(255) NOT NULL,
  `deskripsi_event` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `harga_events` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_events`, `nama_events`, `deskripsi_event`, `image`, `harga_events`) VALUES
(37, 'Rambu Solo\'', 'Rambu Solo is a ceremony aimed at escorting the spirit of someone who has passed away to the spiritual realm.', 'rambu solo1.jpeg', 0),
(39, 'Barana\' Choir', 'The captivating choir from Barana Christian High School blending the harmonies of traditional Torajan melodies with modern choral arrangements, showcasing the rich cultural heritage of Toraja.', 'barana.png', 0),
(42, 'Manganda\'', 'The Manganda dance reflects prayer, gratitude, and rejection of evil spirits, while symbolizing values such as masculinity, prosperity, sanctity, cultural awareness, hard work, and bravery.', 'manganda.jpg', 0),
(44, 'Pa\'gellu', 'The Pagellu Dance is a joyful dance typically performed during traditional ceremonies in Toraja, South Sulawesi. This dance exudes a sense of joy and celebration.', 'pagellu.jpg', 0),
(46, 'Kada Tomina', 'Kada tominaa reflects Toraja culture, conveying advice, emotions, apologies, and reminding of noble values ​​to be upheld and respected in Torajas sociocultural life.', 'kada tominaa.jpg', 0),
(47, 'Ma\'lambuk', 'One of the rituals found in Toraja is a collective activity of pounding the longshaped rice mortar using wood or bamboo, performed by several people together.', 'malambukk.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rate_view`
--

CREATE TABLE `rate_view` (
  `id_rate` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_tlpn` varchar(15) NOT NULL,
  `komentar` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate_view`
--

INSERT INTO `rate_view` (`id_rate`, `id_user`, `nama`, `email`, `no_tlpn`, `komentar`) VALUES
(8, 29, 'owen', 'owen@gmail.com', '09876', 'cobaaa');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_tlpn` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `total_events` varchar(500) NOT NULL,
  `total_harga` int(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL DEFAULT 'pending',
  `tgl_transaksi` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `nama`, `no_tlpn`, `email`, `metode_pembayaran`, `total_events`, `total_harga`, `alamat`, `status_pembayaran`, `tgl_transaksi`) VALUES
(24, 29, 'owen', '09876', 'owen@gmail.com', 'Cash on delivery', '0', 0, 'Makassar', 'Update', '13-Apr-2024');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_tlpn` int(15) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_type`, `jenis_kelamin`, `nama`, `email`, `no_tlpn`, `password`) VALUES
(25, 'admin', 'perempuan', 'sani', 'sani@gmail.com', 111, '202cb962ac59075b964b07152d234b70'),
(29, 'costumer', 'laki-laki', 'owen', 'owen@gmail.com', 19876, '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_cart` (`id_cart`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_events`),
  ADD KEY `id_events` (`id_events`),
  ADD KEY `id_events_2` (`id_events`);

--
-- Indexes for table `rate_view`
--
ALTER TABLE `rate_view`
  ADD PRIMARY KEY (`id_rate`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `rate_view`
--
ALTER TABLE `rate_view`
  MODIFY `id_rate` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
