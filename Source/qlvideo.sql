-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 05:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlvideo`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `id_video` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `username`, `content`, `id_video`) VALUES
(12345, 'nguyenbathanh1', 'Hay quá', 11),
(12346, 'voluyen2', 'Dở tệ', 21),
(12347, 'nguyentanthanh3', 'Bình thường', 31),
(12350, 'voluyen2', 'hay quá', 41),
(12351, 'voluyen2', 'iu vo luyen\r\n', 42),
(12352, 'voluyen2', 'hihi', 41);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id_feature` int(11) NOT NULL,
  `id_video` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id_feature`, `id_video`) VALUES
(1, 11),
(3, 31),
(4, 41),
(5, 42),
(6, 43),
(7, 44);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `date_watch` date NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_video`, `date_watch`, `username`) VALUES
(1234, 21, '2022-10-27', 'nguyenbathanh1'),
(1235, 31, '2022-10-27', 'voluyen2'),
(1236, 11, '2022-10-27', 'nguyentanthanh3');

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `id_video` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`id_video`, `username`) VALUES
(21, 'nguyenbathanh1'),
(31, 'voluyen2'),
(11, 'nguyentanthanh3');

-- --------------------------------------------------------

--
-- Table structure for table `nameplaylist`
--

CREATE TABLE `nameplaylist` (
  `id_playlist` int(11) NOT NULL,
  `name_playlist` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nameplaylist`
--

INSERT INTO `nameplaylist` (`id_playlist`, `name_playlist`) VALUES
(123, 'Playlist 1'),
(124, 'Playlist 2'),
(125, 'Playlist 3');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `id_video`, `username`) VALUES
(123, 11, 'nguyenbathanh1'),
(124, 21, 'voluyen2'),
(125, 31, 'nguyentanthanh3');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `registered_account` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`registered_account`, `username`) VALUES
('luphu5', 'nguyenbathanh1'),
('lehaitien4', 'voluyen2'),
('luphu5', 'nguyentanthanh3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `fullname` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`fullname`, `username`, `password`, `email`, `img`) VALUES
('Nguyễn Bá Thành', 'nguyenbathanh1', '123456', 'nbt1@gmail.com', 'assets/images/thumbnail1.png'),
('Võ Luyện', 'voluyen2', '123456', 'vl2@gmail.com234', 'assets/images/thumbnail1.png'),
('Nguyễn Tấn Thành', 'nguyentanthanh3', '123456', 'ntt3@gmail.com', 'assets/images/thumbnail1.png'),
('Lê Hải Tiến', 'lehaitien4', '123456', 'lht4@gmail.com', 'assets/images/thumbnail1.png'),
('Lữ Phú', 'luphu5', '123456', 'lp5@gmail.com', 'assets/images/thumbnail1.png');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `namevideo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(15) NOT NULL,
  `dayupload` date NOT NULL,
  `thumbnail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mode` tinyint(1) DEFAULT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `namevideo`, `view`, `dayupload`, `thumbnail`, `mode`, `username`, `link`) VALUES
(11, 'hello', 123823912, '2022-10-18', 'assets/images/thumbnail1.png', 0, 'voluyen123', 'assets/videos/video1.mp4'),
(21, 'hello', 123823912, '2022-10-18', 'assets/images/thumbnail1.png', 0, 'voluyen123', 'assets/videos/video2.mp4'),
(31, 'hello', 123823912, '2022-10-18', 'assets/images/thumbnail1.png', 0, 'voluyen123', 'assets/videos/video3.mp4'),
(32, 'hello', 123823912, '2022-10-18', 'assets/images/thumbnail1.png', 0, 'voluyen123', 'assets/videos/video4.mp4'),
(33, 'hello', 123823912, '2022-10-18', 'assets/images/thumbnail1.png', 0, 'voluyen123', 'assets/videos/video5.mp4'),
(34, 'hello', 238239123, '2022-10-18', 'assets/images/thumbnail1.png', 0, 'voluyen123', 'assets/videos/video6.mp4'),
(35, 'Let Her Go', 125522, '2022-12-16', 'assets/images/thumbnail1.png', 0, 'nguyenbathanh1', 'https://www.youtube.com/embed/RBumgq5yVrA'),
(36, 'Home', 2312456, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyenbathanh1', 'https://www.youtube.com/embed/ZAYZmIfHEiU'),
(37, 'Roar', 11214, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyenbathanh1', 'https://www.youtube.com/embed/CevxZvSJLk8'),
(38, 'Old Town Road', 238951, '2022-10-27', 'assets/images/user.png', 0, 'nguyenbathanh1', 'https://www.youtube.com/embed/r7qovpFAGrQ'),
(39, 'Road So Far', 189247, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyentanthanh3', 'https://www.youtube.com/embed/MVMIwIJtMdU'),
(40, 'There no one at all', 2387567, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyentanthanh3', 'https://www.youtube.com/embed/JHSRTU31T14'),
(41, 'Remember me', 293857, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyentanthanh3', 'https://www.youtube.com/embed/6Edc6xxV93M'),
(42, 'Hãy trao cho anh', 9238759, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyentanthanh3', 'https://www.youtube.com/embed/knW7-x7Y7RE'),
(43, 'Muộn rồi mà sao còn', 237569, '2022-10-27', 'assets/images/thumbnail1.png', 0, 'nguyentanthanh3', 'https://www.youtube.com/embed/xypzmu5mMPY'),
(111, '12345', 0, '2022-12-18', 'assets/images/thumnail.png', 1, 'voluyen2', 'assets/videos/video.mp4'),
(112, 'sao cũng được', 0, '2022-12-18', '/assets/images/thumnail.png', 0, 'voluyen2', 'https://www.youtube.com/embed/j4T0-huYsW4');

-- --------------------------------------------------------

--
-- Table structure for table `vipham`
--

CREATE TABLE `vipham` (
  `id_vipham` int(11) NOT NULL,
  `id_video` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id_feature`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- Indexes for table `vipham`
--
ALTER TABLE `vipham`
  ADD PRIMARY KEY (`id_vipham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12353;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
