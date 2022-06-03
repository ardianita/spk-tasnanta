-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 09:45 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tasnanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nm_kriteria` varchar(100) NOT NULL,
  `j_kriteria` varchar(100) NOT NULL,
  `bobot_kriteria` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nm_kriteria`, `j_kriteria`, `bobot_kriteria`) VALUES
(1, 'Kondisi jalan menuju tempat wisata', 'Cost', 5),
(2, 'Banyaknya pengunjung per hari', 'Benefit', 35),
(3, 'Fasilitas Pendukung (Toilet/Area Ibadah/Area Parkir)', 'Cost', 8),
(4, 'Jarak tempuh ke penginapan', 'Cost', 5),
(5, 'Akses internet', 'Cost', 7),
(6, 'Jumlah acara yang diselenggarakan per bulan', 'Benefit', 5),
(7, 'Jarak tempuh dari pariwisata ke rumah sakit', 'Cost', 5),
(9, 'Jarak tempuh dari pariwisata ke pom bensin', 'Cost', 5),
(10, 'Penerangan di malam hari', 'Cost', 3),
(11, 'Waktu aktif tempat wisata', 'Cost', 4),
(12, 'Spot foto', 'Benefit', 10),
(13, 'Media promosi tempat wisata', 'Benefit', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(1, 'dinas'),
(2, 'desa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_pariwisata` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `id_pariwisata`, `kriteria_id`, `id_subkriteria`) VALUES
(15, 15, 1, 3),
(16, 15, 2, 8),
(17, 15, 3, 10),
(18, 15, 4, 14),
(19, 15, 5, 17),
(20, 15, 6, 40),
(21, 15, 7, 25),
(22, 15, 9, 28),
(23, 15, 10, 43),
(24, 15, 11, 32),
(25, 15, 12, 23),
(26, 15, 13, 38),
(63, 19, 1, 3),
(64, 19, 2, 8),
(65, 19, 3, 10),
(66, 19, 4, 12),
(67, 19, 5, 17),
(68, 19, 6, 40),
(69, 19, 7, 26),
(70, 19, 9, 29),
(71, 19, 10, 43),
(72, 19, 11, 33),
(73, 19, 12, 21),
(74, 19, 13, 37),
(87, 21, 1, 20),
(88, 21, 2, 9),
(89, 21, 3, 11),
(90, 21, 4, 13),
(91, 21, 5, 18),
(92, 21, 6, 42),
(93, 21, 7, 26),
(94, 21, 9, 28),
(95, 21, 10, 44),
(96, 21, 11, 32),
(97, 21, 12, 23),
(98, 21, 13, 38),
(99, 22, 1, 3),
(100, 22, 2, 8),
(101, 22, 3, 7),
(102, 22, 4, 12),
(103, 22, 5, 17),
(104, 22, 6, 40),
(105, 22, 7, 25),
(106, 22, 9, 30),
(107, 22, 10, 43),
(108, 22, 11, 33),
(109, 22, 12, 22),
(110, 22, 13, 37),
(147, 26, 1, 2),
(148, 26, 2, 9),
(149, 26, 3, 10),
(150, 26, 4, 12),
(151, 26, 5, 18),
(152, 26, 6, 41),
(153, 26, 7, 25),
(154, 26, 9, 31),
(155, 26, 10, 44),
(156, 26, 11, 32),
(157, 26, 12, 22),
(158, 26, 13, 36);

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif`
--

CREATE TABLE `tb_notif` (
  `id_notif` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_notif`
--

INSERT INTO `tb_notif` (`id_notif`, `from_user_id`, `user_id`, `title`, `description`, `created_at`, `is_read`) VALUES
(4, 23, 19, 'Persetujuan Pembangunan', 'Pembangunan wisata Air Terjun Slamir disetujui.', '2022-06-02 06:05:39', 1),
(5, 23, 19, 'Persetujuan Pembangunan', 'Pembangunan wisata Nongko Ijo disetujui.', '2022-06-02 06:33:30', 1),
(6, 23, 24, 'Persetujuan Pembangunan', 'Pembangunan wisata Air Terjun Krecekan Denu disetujui.', '2022-06-02 08:44:31', 1),
(7, 23, 24, 'Persetujuan Pembangunan', 'Pembangunan wisata Air Terjun Banyulawe Dong disetujui.', '2022-06-02 09:16:01', 1),
(8, 23, 19, 'Persetujuan Pembangunan', 'Pembangunan wisata Sarangan disetujui.', '2022-06-02 09:17:36', 1),
(13, 23, 19, 'Pemberitahuan Pembangunan', 'Pembangunan wisata Sarangan sudah selesai. <br>Apabila desa ingin melakukan pembangunan lagi pada pariwisata ini silahkan masukkan ulang data destinasi Sarangan', '2022-06-03 02:15:07', 1),
(14, 23, 19, 'Pemberitahuan Pembangunan', 'Pembangunan wisata Nongko Ijo sudah selesai. <br>Apabila desa ingin melakukan pembangunan lagi pada pariwisata ini silahkan masukkan ulang data destinasi Nongko Ijo', '2022-06-03 02:16:43', 1),
(15, 23, 19, 'Pemberitahuan Pembangunan', 'Pembangunan wisata Air Terjun Slamir sudah selesai. <br>Apabila desa ingin melakukan pembangunan lagi pada pariwisata ini silahkan masukkan ulang data destinasi Air Terjun Slamir', '2022-06-03 14:38:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pariwisata`
--

CREATE TABLE `tb_pariwisata` (
  `id_pariwisata` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp(),
  `nm_pariwisata` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  `built_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pariwisata`
--

INSERT INTO `tb_pariwisata` (`id_pariwisata`, `id_user`, `tgl`, `nm_pariwisata`, `id_status`, `built_status`) VALUES
(15, 19, '2022-04-28', 'Nongko Ijo', 1, 2),
(19, 24, '2022-05-08', 'Air Terjun Banyulawe Dong', 1, 1),
(21, 19, '2022-05-09', 'Air Terjun Slamir', 1, 2),
(22, 24, '2022-05-10', 'Air Terjun Krecekan Denu', 1, 1),
(26, 19, '2022-06-02', 'Sarangan', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `status`) VALUES
(0, 'Tidak Valid'),
(1, 'Valid');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sts_pemb`
--

CREATE TABLE `tb_sts_pemb` (
  `id_sts_pemb` int(11) NOT NULL,
  `sts_pemb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sts_pemb`
--

INSERT INTO `tb_sts_pemb` (`id_sts_pemb`, `sts_pemb`) VALUES
(0, 'Belum Dibangun'),
(1, 'Sedang Dibangun'),
(2, 'Telah Dibangun');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `nm_subkriteria` varchar(100) NOT NULL,
  `nilai` int(50) NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_subkriteria`, `nm_subkriteria`, `nilai`, `id_kriteria`) VALUES
(1, 'Sangat Baik', 1, 1),
(2, 'Baik', 2, 1),
(3, 'Buruk', 3, 1),
(4, '&lt; 20 orang', 1, 2),
(7, 'Lengkap', 1, 3),
(8, '20 - 50 orang', 2, 2),
(9, '> 50 orang', 3, 2),
(10, 'Ada lebih dari 1', 2, 3),
(11, 'Salah satu ada', 3, 3),
(12, '500m - 2km', 3, 4),
(13, '> 5km', 1, 4),
(14, '2 - 5km', 2, 4),
(15, 'Tidak Ada', 4, 3),
(16, 'Mudah Ditemukan', 1, 5),
(17, 'Jarang Ditemukan', 2, 5),
(18, 'Tidak Ada', 3, 5),
(19, '&lt; 500m', 4, 4),
(20, 'Sangat Buruk', 4, 1),
(21, 'Mudah Ditemukan', 3, 12),
(22, 'Jarang Ditemukan', 2, 12),
(23, 'Tidak Ada', 1, 12),
(24, '< 500m', 4, 7),
(25, '500m - 2km', 3, 7),
(26, '2 - 5km', 2, 7),
(27, '> 5km', 1, 7),
(28, '< 500m', 4, 9),
(29, '500m - 2km', 3, 9),
(30, '2 - 5km', 2, 9),
(31, '> 5km', 1, 9),
(32, 'Malam Hari', 2, 11),
(33, 'Siang Hari', 3, 11),
(34, 'Malam Hari dan Siang Hari', 1, 11),
(35, 'Tidak Ada', 1, 13),
(36, 'Website', 2, 13),
(37, 'Sosial Media', 3, 13),
(38, 'Sosial Media dan Website', 4, 13),
(39, 'Tidak Ada', 1, 6),
(40, '1', 2, 6),
(41, '2 - 3', 3, 6),
(42, 'Lebih dari 3', 4, 6),
(43, 'Tidak Ada', 4, 10),
(44, 'Buruk', 3, 10),
(45, 'Bagus', 2, 10),
(46, 'Sangat Bagus', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `id_level` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `name`, `email`, `password`, `telp`, `id_level`, `foto`) VALUES
(18, 'Admin2', 'Muhammad Kalandra', 'dispar@yahoo.com', '$2y$10$oiM4dOO1nWdcY/9a.ghWsO8LE218s2.qq/ecv6P8XtDOeyKvi5BIK', '0878347863546', 1, 'default.png'),
(19, 'Ardianita', 'Kare', 'desa@yahoo.com', '$2y$10$lytQUT6oNR7iI8vVptmxSuTfZc8fOT7xlFKt1xNiFZ3BslFxVW.je', '0878347863546', 2, 'default.png'),
(23, 'Administrator', 'Zahid Azmi', 'dinas@gmail.com', '$2y$10$wifMwXXL1DoaXJ9qmQWxB.J676BkLQUMh2Yq2Q/7GJpRl59n5Mjae', '087834528312', 1, 'dinas@gmailcom.png'),
(24, 'Arsenio', 'Kepel', 'madi@gmail.com', '$2y$10$wAIeHpyY2nKQmVJAljYVt.uvqzsxSUz39FYPIXasph.AT6B42iJuy', '083874858555', 2, 'default.png'),
(39, 'Admin', 'Ardianita Fauziyah', 'ardianitaf@student.uns.ac.id', '$2y$10$IYPIsh671QE3t5HEBWWbt.70HQ7g4i4pKpu2dSotgBEhq2Em4/Hkm', '083874858873', 1, 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `kriteria_id` (`kriteria_id`),
  ADD KEY `id_pariwisata` (`id_pariwisata`),
  ADD KEY `id_subkriteria` (`id_subkriteria`);

--
-- Indexes for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `id_user` (`from_user_id`),
  ADD KEY `id_pariwisata` (`user_id`);

--
-- Indexes for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  ADD PRIMARY KEY (`id_pariwisata`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `built_status` (`built_status`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_sts_pemb`
--
ALTER TABLE `tb_sts_pemb`
  ADD PRIMARY KEY (`id_sts_pemb`);

--
-- Indexes for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  MODIFY `id_pariwisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `tb_nilai_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_2` FOREIGN KEY (`id_pariwisata`) REFERENCES `tb_pariwisata` (`id_pariwisata`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_3` FOREIGN KEY (`id_subkriteria`) REFERENCES `tb_subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD CONSTRAINT `tb_notif_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_notif_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  ADD CONSTRAINT `tb_pariwisata_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pariwisata_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pariwisata_ibfk_3` FOREIGN KEY (`built_status`) REFERENCES `tb_sts_pemb` (`id_sts_pemb`);

--
-- Constraints for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD CONSTRAINT `tb_subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
