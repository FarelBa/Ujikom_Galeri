-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 08:22 AM
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
-- Database: `ujikom_frel`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` date NOT NULL DEFAULT current_timestamp(),
  `lokasi_file` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `user_id`) VALUES
(25, 'playing ball in water', 'para manusia tersebut sedang bermain bola air ', '2024-04-23', '6628523f1c254.jpg', 2),
(27, 'man playing football', 'man and his friend playing fun football', '2024-04-23', '6628532ae9044.jpg', 2),
(29, 'women and mother', 'women and mother take a picture without father', '2024-04-23', '6628545b292f2.jpg', 2),
(30, 'women jogging', 'women and his friend morning jogging', '2024-04-23', '6628549285337.jpg', 2),
(31, 'man playing ball', 'man and his friend playing ball with women', '2024-04-23', '66285ab1616f7.jpg', 2),
(32, 'nice mountain', 'view mountain with camera sony pro', '2024-04-23', '66285dc271814.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(37, 32, 3, 'lalu jika sudah user dapat mengganti akun dengan cara memencet tombol logout pada navbar di halaman utama', '2024-04-24'),
(38, 25, 5, 'keren', '2024-04-24'),
(39, 25, 2, 'menyala abangku', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(135, 32, 3, '2024-04-24'),
(143, 30, 3, '2024-04-24'),
(145, 32, 6, '2024-04-24'),
(158, 30, 5, '2024-04-24'),
(160, 31, 5, '2024-04-24'),
(168, 25, 5, '2024-04-24'),
(170, 32, 5, '2024-04-24'),
(174, 31, 2, '2024-04-24'),
(175, 25, 2, '2024-04-24'),
(177, 29, 2, '2024-04-24'),
(178, 27, 2, '2024-04-24'),
(179, 30, 2, '2024-04-24'),
(180, 32, 2, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(2, 'farel', '$2y$10$KRAIPFvczZgWmNp7ePoLMuIOucEYOMkhXG38ygXsEmsD9x.waJaLK', 'fadel@gmail.com', 'muhamad fadel', 'bandung'),
(3, 'adel123', '$2y$10$.THw9sj6lhmKzH6U6.3FTufwoap3nlOBpc5MOhC9gEacr3U.iYCOK', 'adel@gmail.com', 'adel', 'depok'),
(4, 'hilda', '$2y$10$.mXdocR7GYrTJS/uVUmmBeMojf3PgyWBTHJmYqNRd/PEoNCvfh1aq', 'hilda@gmail.com', 'hilda dinarti', 'majalengka'),
(5, 'adminskuy', '$2y$10$ywCn/ATsSXYK.nB4sWYPZeYNBoQJxhVPXkswmiwYgEEbhb5oS/AaK', 'admin@gmail.com', 'adminganteng', 'jaksel'),
(6, 'zahra', '$2y$10$mUZhE5MYp4GepfYUFaVKw.PoQKI4K60.wp7DUjw.1psH9Xy8kiiua', 'zahra@gmail.com', 'zahra cuantik', 'jepang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `foto_id` (`foto_id`);

--
-- Indexes for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `foto_id` (`foto_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komentar_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`);

--
-- Constraints for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `like_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
