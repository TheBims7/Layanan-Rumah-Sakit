-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 04:40 PM
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
-- Database: `layanan_rs`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `NIP` varchar(50) DEFAULT NULL,
  `status_dokter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama_dokter`, `NIP`, `status_dokter`) VALUES
(1, 'dr. Prasetya, Sp.B', '196404251993031249', 'Dokter Spesialis Bedah'),
(2, 'dr. Mahesti, Sp.A', '197102132002092016', 'Dokter Spesialis Anak'),
(3, 'dr. William Pambudi, Sp.PD', '198208062007051152', 'Dokter Spesialis Dalam'),
(4, 'dr. Fatimah, Sp.Jp', '196404251993009218', 'Dokter Spesialis Jantung'),
(5, 'dr. Ahmad, Sp.KJ', '197505291999100419', 'Spesialis Dokter Jiwa'),
(7, 'dr. Gama Putra, Sp.B', '196404251993031221', 'Dokter Spesialis Bedah'),
(8, 'dr. Zahra Anggraini, Sp.M', '198405292005100459', 'Spesialis Dokter Mata');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('pasien','admin','dokter') DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `username`, `email`, `role`, `login_time`) VALUES
(1, 1, 'Armiza', 'miza12@gmail.com', 'pasien', '2026-01-30 13:36:23'),
(2, 2, 'bima', 'bims@gmail.com', 'dokter', '2026-01-30 13:38:52'),
(3, 3, 'prayoga', 'pra@go.id', 'admin', '2026-01-30 13:40:27'),
(4, 5, 'Muhammad Ibrahim Malik', 'ibrahim@gmail.com', 'pasien', '2026-01-30 13:46:17'),
(7, 2, 'bima', 'bims@gmail.com', 'dokter', '2026-01-30 13:59:28'),
(9, 4, 'albi', 'albi@yahoo.id', 'pasien', '2026-01-30 15:28:50'),
(10, 1, 'Armiza', 'miza12@gmail.com', 'pasien', '2026-01-30 16:04:50'),
(11, 6, 'Permana', 'mana@co.id', 'dokter', '2026-01-30 16:07:16'),
(12, 3, 'prayoga', 'pra@go.id', 'admin', '2026-01-30 16:08:30'),
(13, 5, 'Muhammad Ibrahim Malik', 'ibrahim@gmail.com', 'pasien', '2026-01-31 03:25:40'),
(14, 2, 'bima', 'bims@gmail.com', 'dokter', '2026-01-31 03:27:22'),
(15, 3, 'prayoga', 'pra@go.id', 'admin', '2026-01-31 03:28:17'),
(16, 2, 'bima', 'bims@gmail.com', 'dokter', '2026-01-31 03:47:14'),
(17, 3, 'prayoga', 'pra@go.id', 'admin', '2026-01-31 04:16:48'),
(18, 1, 'Armiza', 'miza12@gmail.com', 'pasien', '2026-01-31 04:53:53'),
(19, 6, 'Permana', 'mana@co.id', 'dokter', '2026-01-31 05:23:34'),
(20, 9, 'William Saputra', 'william81@gmail.com', 'pasien', '2026-01-31 08:09:12'),
(21, 4, 'albi', 'albi@yahoo.id', 'pasien', '2026-01-31 08:22:44'),
(22, 5, 'Muhammad Ibrahim Malik', 'ibrahim@gmail.com', 'pasien', '2026-01-31 08:25:59'),
(23, 1, 'Armiza', 'miza12@gmail.com', 'pasien', '2026-01-31 08:27:59'),
(24, 7, 'Udin', 'udin@gmail.com', 'admin', '2026-01-31 08:31:07'),
(25, 8, 'Cleopatra', 'cleo21@yahoo.com', 'dokter', '2026-01-31 08:34:30'),
(26, 10, 'Zera Zahra', 'Zera79@google.com', 'pasien', '2026-01-31 08:39:02'),
(27, 4, 'albi', 'albi@yahoo.id', 'pasien', '2026-01-31 08:40:39'),
(28, 8, 'Cleopatra', 'cleo21@yahoo.com', 'dokter', '2026-01-31 08:43:24'),
(29, 4, 'albi', 'albi@yahoo.id', 'pasien', '2026-01-31 08:45:07'),
(30, 7, 'Udin', 'udin@gmail.com', 'admin', '2026-01-31 08:45:57'),
(31, 2, 'bima', 'bims@gmail.com', 'dokter', '2026-01-31 09:05:05'),
(32, 2, 'bima', 'bims@gmail.com', 'dokter', '2026-01-31 09:11:03'),
(33, 3, 'prayoga', 'pra@go.id', 'admin', '2026-01-31 09:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dokter_id` int(11) DEFAULT NULL,
  `poli_id` int(11) DEFAULT NULL,
  `no_rm` varchar(50) DEFAULT NULL,
  `antrian` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('perempuan','laki-laki') DEFAULT NULL,
  `tanggal_periksa` date DEFAULT NULL,
  `no_telepon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `user_id`, `dokter_id`, `poli_id`, `no_rm`, `antrian`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `tanggal_periksa`, `no_telepon`) VALUES
(1, 1, 1, 1, 'RM 9822', 2, 'Armiza Al Fattah', '2002-07-20', 'laki-laki', '2026-01-31', '085722391754'),
(2, 5, 3, 3, 'RM 0987', 17, 'Muhammad Ibrahim Malik', '1998-05-18', 'laki-laki', '2026-02-07', '086712256790'),
(3, NULL, 2, 2, 'RM 1123', 21, 'Zahra Putri', '2026-01-01', 'perempuan', '2026-01-21', '085876990326'),
(5, 4, 7, 1, 'RM 8723', 37, 'Albi Magenta', '1993-11-17', 'perempuan', '2026-02-04', '089433285551'),
(7, 1, 2, 2, 'RM 9812', 6, 'Muhammad Putra Malik IBrahim Permana Adinata', '2018-06-13', 'laki-laki', '2026-02-05', '085856221976'),
(8, 1, 3, 3, 'RM 9822', 29, 'Albita Maharani Putri Fatimah Zahratul Fathonah  Az Zahra', '1997-06-12', 'perempuan', '2026-02-12', '085722119827'),
(13, 9, 1, 1, 'RM 7721', 13, 'William Saputra', '2004-10-31', 'laki-laki', '2026-02-18', '0859772576599'),
(15, 4, 3, 3, 'RM 8725', 31, 'Albi Magenta', '1996-09-12', 'perempuan', '2026-02-09', '085322875931'),
(16, 5, 8, 6, 'RM 5211', 16, 'Malik Ahmad', '2001-04-10', 'laki-laki', '2026-02-06', '087922561230'),
(17, 1, 4, 5, 'RM 3874', 8, 'Boim', '1978-01-18', 'laki-laki', '2026-01-31', '085711659087'),
(18, 1, 5, 4, 'RM 6197', 3, 'Juki', '1995-08-22', 'laki-laki', '2026-02-12', '083199287655'),
(19, 10, 8, 6, 'RM 4987', 1, 'Zera Az Zahra', '2009-06-30', 'perempuan', '2026-02-06', '089921765984'),
(20, 4, 1, 1, 'RM 8662', 27, 'Albita Magenta', '2002-03-13', 'perempuan', '2026-02-18', '082177658791');

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

CREATE TABLE `poliklinik` (
  `id` int(11) NOT NULL,
  `poli` varchar(100) DEFAULT NULL,
  `gedung` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`id`, `poli`, `gedung`) VALUES
(1, 'Poli Bedah', 'Lantai 1'),
(2, 'Poli Anak', 'Lantai 2'),
(3, 'Poli Dalam', 'Lantai 2'),
(4, 'Poli Jiwa', 'Lantai 0'),
(5, 'Poli Jantung', 'Lantai 1'),
(6, 'Poli Mata', 'Lantai 3'),
(7, 'Poli Saraf', 'Lantai 1'),
(8, 'Poli Paru', 'Lantai 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('pasien','admin','dokter') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Armiza', 'miza12@gmail.com', '$2y$10$ecpz9a8Uh4/708MJz.qsRuQysKzqZsj6lgme/0dWM/JPNska/r3Je', 'pasien'),
(2, 'bima', 'bims@gmail.com', '$2y$10$IQvVIcErAZXtKd81HowkjeK8j.1ibLX/HigGQs3QI7P3DA36DxC2e', 'dokter'),
(3, 'prayoga', 'pra@go.id', '$2y$10$eOT.ktfG0FzkfzIsnDwb4.d/129zS7pq3aWfo1z9gbkTeXEsIBSI.', 'admin'),
(4, 'albi', 'albi@yahoo.id', '$2y$10$e/4Mtj/Vax9xmllyxNK6dOtHjp6x0tf5JSal/ZCPTMbJlTaMQJpGK', 'pasien'),
(5, 'Muhammad Ibrahim Malik', 'ibrahim@gmail.com', '$2y$10$tLequXGP5dV4tctW3ZvMbeb2QJM5BazuFIS1pYJCd1XXZvzLZvqqi', 'pasien'),
(6, 'Permana', 'mana@co.id', '$2y$10$JBuXiEHiN.GZMdyJvKd3YuBL6c0B0/Pt5D1i3eNMGTDnP3GKbO3j6', 'dokter'),
(7, 'Udin', 'udin@gmail.com', '$2y$10$9JKTEdAVkG.TjH4IJWjRm.5ZZzO87ujQKgSdniBuW0VXg21QJUVj.', 'admin'),
(8, 'Cleopatra', 'cleo21@yahoo.com', '$2y$10$rn/fpvYR.aSiP4TUmNg63OHwNJxQEKGDV0x8quTqPEwzz0C7JI4R6', 'dokter'),
(9, 'William Saputra', 'william81@gmail.com', '$2y$10$rGbGLrS3mb4RJKiwH2Dk4OmGsxQ1vFAOuRHFHWt232aVKv4fX3MSW', 'pasien'),
(10, 'Zera Zahra', 'Zera79@google.com', '$2y$10$SKoAfLmb0p59nsoMwhKPVuDjnL3DQzsovJDxMAz.6hi.xkdbook76', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_dokter` (`nama_dokter`),
  ADD UNIQUE KEY `NRP` (`NIP`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dokter_id` (`dokter_id`),
  ADD KEY `poli_id` (`poli_id`);

--
-- Indexes for table `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `poli` (`poli`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`dokter_id`) REFERENCES `dokter` (`id`),
  ADD CONSTRAINT `pendaftaran_ibfk_3` FOREIGN KEY (`poli_id`) REFERENCES `poliklinik` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
