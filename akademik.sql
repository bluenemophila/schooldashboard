-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2020 at 05:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(12) NOT NULL,
  `nama_dosen` varchar(25) NOT NULL,
  `gambar` blob NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` enum('dosen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama_dosen`, `gambar`, `username`, `password`, `level`) VALUES
('1962010025', 'Ratu Mawardi', 0x356665353862336139653533332e6a7067, 'ratu', '202cb962ac59075b964b07152d234b70', 'dosen'),
('196896022', 'Cipto Mangunkusumo', 0x356665353862303761633162632e6a7067, 'cipto', '202cb962ac59075b964b07152d234b70', 'dosen'),
('1969020023', 'Ni Luh Jayani', 0x3339306365383837663865396638323663343434383836313839396533363432322e6a706567, '', '', ''),
('197274023', 'Muhammad Hatta', 0x356665353863303834366264382e6a7067, 'hatta', '202cb962ac59075b964b07152d234b70', 'dosen'),
('197456020', 'Susi Susanti', 0x356665353865366636643561332e6a7067, 'susi', '202cb962ac59075b964b07152d234b70', 'dosen'),
('197710399', 'Ibnu Supriyadi', 0x356665353839646632316232302e6a7067, 'ibnu', '202cb962ac59075b964b07152d234b70', 'dosen'),
('1979100026', 'Lintang Arkana', 0x356665353863313337333237372e6a7067, 'lintang', '202cb962ac59075b964b07152d234b70', 'dosen'),
('197963024', 'Sri Mulyani', 0x356665353864346233333165632e6a7067, 'sri', '202cb962ac59075b964b07152d234b70', 'dosen'),
('198078021', 'Andi Sulardi', 0x356665353839366238356238302e6a7067, 'andi', '202cb962ac59075b964b07152d234b70', 'dosen');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(9) NOT NULL,
  `nama_mhs` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `image` blob NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` enum('mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhs`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `image`, `username`, `password`, `level`) VALUES
('M10001231', 'Wira Arjuna', '2001-06-10', 'Surakarta, Indonesia', 'Laki-laki', 0x356665353761663538656131342e6a7067, 'wira123', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001232', 'Jelita Putri', '2001-08-17', 'Surakarta, Indonesia', 'Perempuan', 0x356665353765313662656464642e6a7067, 'jelita', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001233', 'Patrick Miranda', '2001-03-17', 'Surabaya, Indonesia', 'Laki-laki', 0x356665353765333239393530382e6a7067, 'patrick', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001234', 'Sahadeva Wijaya', '2001-06-16', 'Semarang, Indonesia', 'Laki-laki', 0x356665353765373033303331382e6a7067, 'sahadeva', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001235', 'Nur Fauzan', '2001-03-30', 'Bandung, Indonesia', 'Laki-laki', 0x356665353831613333656331342e6a7067, 'fauzan', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001236', 'Cantika Abigail', '2000-10-17', 'Jakarta, Indonesia', 'Perempuan', 0x356665353766663136353539342e6a7067, 'cantika', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001237', 'Dinda Kenanga', '2001-02-06', 'Jakarta, Indonesia', 'Perempuan', 0x356665353830313134393764382e6a7067, 'dinda', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001238', 'Aldebaran', '2000-03-04', 'Medan, Indonesia', 'Laki-laki', 0x356665353833366261343664362e6a7067, 'aldebaran', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001239', 'Bunga Melati', '2001-01-01', 'Jakarta, Indonesia', 'Perempuan', 0x356665353830333038613566622e6a7067, 'bunga', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001240', 'Titus Sitanggang', '2000-05-20', 'Medan, Indonesia', 'Laki-laki', 0x356665353833376264653739392e6a7067, 'titus', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001241', 'Bintang Putri', '2000-04-29', 'Makassar, Indonesia', 'Perempuan', 0x356665353830346365316439352e6a7067, 'bintang', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001242', 'Samudera Biru', '2000-03-03', 'Manado, Indonesia', 'Laki-laki', 0x356665353833386462663065302e6a7067, 'samudera', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001243', 'Sekar Mawarni', '2002-01-29', 'Bali, Indonesia', 'Perempuan', 0x356665353832326233633536322e6a7067, 'sekar', '202cb962ac59075b964b07152d234b70', 'mahasiswa'),
('M10001245', 'Hari Prananto', '2001-06-03', 'Boyolali, Indonesia', 'Laki-laki', 0x356665383032393431353734382e6a7067, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` varchar(6) NOT NULL,
  `nama_mk` varchar(20) NOT NULL,
  `sks` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('A03201', 'Analisis Regresi', 3),
('C02120', 'Kalkulus', 2),
('L08221', 'Logika Fuzzy', 2),
('M01364', 'Metode Penelitian', 3),
('M04202', 'Metode Numerik', 2),
('M10033', 'Metode Survey Sampel', 2),
('S05202', 'Sistem Informasi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id` int(11) NOT NULL,
  `nim_mhs` varchar(9) NOT NULL,
  `kode_matkul` varchar(6) NOT NULL,
  `nip_dosen` varchar(12) NOT NULL,
  `nilai` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`id`, `nim_mhs`, `kode_matkul`, `nip_dosen`, `nilai`) VALUES
(1, 'M10001231', 'A03201', '196896022', 'A'),
(2, 'M10001232', 'C02120', '197274023', 'A'),
(3, 'M10001233', 'L08221', '197456020', 'A'),
(4, 'M10001234', 'M01364', '197963024', 'A'),
(5, 'M10001235', 'M04202', '198078021', 'B'),
(7, 'M10001237', 'S05202', '198078021', 'A'),
(8, 'M10001242', 'M04202', '197963024', 'A'),
(9, 'M10001236', 'S05202', '1962010025', 'A'),
(10, 'M10001239', 'M04202', '1979100026', 'A'),
(11, 'M10001240', 'C02120', '198078021', 'A'),
(12, 'M10001241', 'L08221', '197456020', 'A'),
(13, 'M10001239', 'A03201', '197274023', 'A'),
(14, 'M10001238', 'M10033', '197710399', 'A'),
(15, 'M10001238', 'S05202', '1979100026', 'A'),
(16, 'M10001238', 'C02120', '197456020', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `level` enum('admin','dosen','mahasiswa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `level`) VALUES
(11, 'admin', '202cb962ac59075b964b07152d234b70', 'Julienne', 'admin'),
(19, 'wira123', '202cb962ac59075b964b07152d234b70', 'Wira Arjuna', 'mahasiswa'),
(20, 'jelita', '202cb962ac59075b964b07152d234b70', 'Jelita Putri', 'mahasiswa'),
(21, 'patrick', '202cb962ac59075b964b07152d234b70', 'Patrick Miranda', 'mahasiswa'),
(22, 'sahadeva', '202cb962ac59075b964b07152d234b70', 'Sahadeva Wijaya', 'mahasiswa'),
(23, 'fauzan', '202cb962ac59075b964b07152d234b70', 'Nur Fauzan', 'mahasiswa'),
(24, 'cantika', '202cb962ac59075b964b07152d234b70', 'Cantika Abigail', 'mahasiswa'),
(25, 'dinda', '202cb962ac59075b964b07152d234b70', 'Dinda Kenanga', 'mahasiswa'),
(26, 'aldebaran', '202cb962ac59075b964b07152d234b70', 'Aldebaran', 'mahasiswa'),
(27, 'bunga', '202cb962ac59075b964b07152d234b70', 'Bunga Melati', 'mahasiswa'),
(28, 'titus', '202cb962ac59075b964b07152d234b70', 'Titus Sitanggang', 'mahasiswa'),
(29, 'bintang', '202cb962ac59075b964b07152d234b70', 'Bintang Putri', 'mahasiswa'),
(30, 'samudera', '202cb962ac59075b964b07152d234b70', 'Samudera Biru', 'mahasiswa'),
(31, 'sekar', '202cb962ac59075b964b07152d234b70', 'Sekar Mawarni', 'mahasiswa'),
(32, 'ratu', '202cb962ac59075b964b07152d234b70', 'Ratu Mawardi', 'dosen'),
(33, 'cipto', '202cb962ac59075b964b07152d234b70', 'Cipto Mangunkusumo', 'dosen'),
(34, 'hatta', '202cb962ac59075b964b07152d234b70', 'Muhammad Hatta', 'dosen'),
(35, 'susi', '202cb962ac59075b964b07152d234b70', 'Susi Susanti', 'dosen'),
(36, 'ibnu', '202cb962ac59075b964b07152d234b70', 'Ibnu Supriyadi', 'dosen'),
(37, 'lintang', '202cb962ac59075b964b07152d234b70', 'Lintang Arkana', 'dosen'),
(38, 'sri', '202cb962ac59075b964b07152d234b70', 'Sri Mulyani', 'dosen'),
(39, 'andi', '202cb962ac59075b964b07152d234b70', 'Andi Sulardi', 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim_mhs`),
  ADD KEY `kode_mk` (`kode_matkul`),
  ADD KEY `nip` (`nip_dosen`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `kode_mk` FOREIGN KEY (`kode_matkul`) REFERENCES `matakuliah` (`kode_mk`),
  ADD CONSTRAINT `nim` FOREIGN KEY (`nim_mhs`) REFERENCES `mahasiswa` (`nim`),
  ADD CONSTRAINT `nip` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
