-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 06, 2018 at 02:08 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Braless`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `scope` enum('admin','user','developer') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `scope`, `password`) VALUES
(3, 'azrim', 'mirza@gmail.com', 'user', 'secure'),
(6, 'mirza', 'mirzaoglecevac@gmail.com', 'user', 'secure');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(255) UNSIGNED NOT NULL,
  `add_image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `add_image`, `link`) VALUES
(1, 'ad_one', 'neznam');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `title`, `image_link`, `thumbnail`, `description`, `date`) VALUES
(1, 'kelly', 'nnn', 'nn', 'picka', '2018-05-31 13:08:13'),
(2, 'jenny naked', 'karina', 'karina', 'jenny naked in bath', '2018-05-31 13:08:13'),
(11, 'mia kurava', 'url', 'karina', 'opis', '2018-06-05 13:20:27'),
(12, 'mia kurava', 'url', 'karina', 'opis', '2018-06-05 13:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `image_comments`
--

CREATE TABLE `image_comments` (
  `id` int(255) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `users_id` int(255) UNSIGNED NOT NULL,
  `images_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_comments`
--

INSERT INTO `image_comments` (`id`, `content`, `date`, `users_id`, `images_id`) VALUES
(1, 'novi komenatar', '2018-06-02 17:47:42', 23, 1),
(2, 'dobra picka', '2018-06-01 22:00:00', 2, 1),
(3, 'nesto', '2018-06-01 09:19:12', 5, 5),
(4, 'nesto', '2018-06-01 09:19:12', 5, 5),
(6, 'nesto', '2018-06-01 09:21:34', 5, 5),
(7, 'test', '2018-06-02 17:45:54', 4, 2),
(8, 'test', '2018-06-01 10:22:53', 4, 4),
(9, 'test', '2018-06-01 12:51:23', 4, 4),
(10, 'test', '2018-06-01 12:51:23', 4, 4),
(11, 'test2', '2018-06-02 17:49:37', 4, 4),
(12, 'test2', '2018-06-02 17:49:37', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `image_dislikes`
--

CREATE TABLE `image_dislikes` (
  `id` int(255) NOT NULL,
  `images_id` int(255) NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_dislikes`
--

INSERT INTO `image_dislikes` (`id`, `images_id`, `users_id`) VALUES
(1, 2, 0),
(2, 2, 0),
(3, 2, 0),
(4, 2, 0),
(5, 2, 24),
(6, 2, 24),
(7, 1, 1),
(8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_likes`
--

CREATE TABLE `image_likes` (
  `id` int(255) UNSIGNED NOT NULL,
  `images_id` int(255) UNSIGNED NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_likes`
--

INSERT INTO `image_likes` (`id`, `images_id`, `users_id`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 2, 0),
(4, 1, 0),
(5, 2, 0),
(6, 2, 0),
(7, 2, 0),
(8, 2, 0),
(9, 1, 0),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(13, 2, 0),
(14, 2, 0),
(15, 2, 24),
(16, 2, 24),
(17, 2, 23),
(18, 2, 23),
(19, 23, 23),
(20, 23, 23);

-- --------------------------------------------------------

--
-- Table structure for table `image_tags`
--

CREATE TABLE `image_tags` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `images_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_tags`
--

INSERT INTO `image_tags` (`id`, `name`, `images_id`) VALUES
(1, 'naked', 1),
(2, 'bath', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pornstars`
--

CREATE TABLE `pornstars` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sex` enum('Male','Female','Shemale') NOT NULL,
  `age` int(255) NOT NULL,
  `about` text NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pornstars`
--

INSERT INTO `pornstars` (`id`, `name`, `sex`, `age`, `about`, `banner_image`, `profile_image`) VALUES
(1, 'Miloni picka', 'Female', 40, 'kurva 2', 'baner slika', 'testna slika'),
(2, 'jenny', 'Female', 24, 'kurvica', 'neznam', ''),
(5, 'kelly', 'Female', 35, 'kurvetina', 'karina', ''),
(9, 'Magdalene', 'Female', 40, 'kurva 2', 'baner slika', 'testna slika'),
(10, 'Magdalene St', 'Female', 50, 'kurva 2', 'baner slika', 'testna slika');

-- --------------------------------------------------------

--
-- Table structure for table `pornstars_has_images`
--

CREATE TABLE `pornstars_has_images` (
  `id` int(255) UNSIGNED NOT NULL,
  `pornstars_id` int(255) UNSIGNED NOT NULL,
  `images_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pornstars_has_images`
--

INSERT INTO `pornstars_has_images` (`id`, `pornstars_id`, `images_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 11),
(4, 5, 12),
(5, 4, 17),
(6, 4, 18),
(7, 4, 47),
(8, 4, 48),
(9, 4, 49),
(10, 4, 50),
(11, 4, 51),
(12, 4, 52),
(13, 4, 53),
(14, 4, 54),
(15, 4, 55),
(16, 4, 56),
(17, 4, 57),
(18, 4, 58),
(19, 4, 59),
(20, 4, 60),
(21, 4, 61),
(22, 4, 62),
(23, 4, 63),
(24, 4, 64),
(25, 4, 65),
(26, 4, 66),
(27, 4, 13),
(28, 4, 14),
(29, 4, 15),
(30, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `pornstars_has_videos`
--

CREATE TABLE `pornstars_has_videos` (
  `videos_id` int(11) NOT NULL,
  `pornstars_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pornstars_has_videos`
--

INSERT INTO `pornstars_has_videos` (`videos_id`, `pornstars_id`, `id`) VALUES
(1, 1, 1),
(7, 2, 2),
(5, 1, 3),
(1, 5, 5),
(2, 5, 6),
(12, 7, 7),
(13, 7, 8),
(14, 101, 9),
(15, 101, 10),
(20, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `pornstar_subscribers`
--

CREATE TABLE `pornstar_subscribers` (
  `id` int(255) UNSIGNED NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL,
  `pornstars_id` int(255) UNSIGNED NOT NULL,
  `subscribing` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pornstar_subscribers`
--

INSERT INTO `pornstar_subscribers` (`id`, `users_id`, `pornstars_id`, `subscribing`) VALUES
(1, 3, 1, 'true'),
(2, 5, 1, 'false'),
(3, 1, 2, 'false'),
(18, 39, 1, 'false'),
(19, 39, 5, 'false'),
(20, 30, 5, 'true'),
(21, 30, 1, 'true'),
(22, 100, 5, 'true'),
(23, 150, 5, 'true'),
(24, 24, 1, 'true'),
(25, 50, 3, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `content`) VALUES
(1, 'Terms and conditions... 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profile_image` varchar(255) NOT NULL,
  `is_pornstar` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_of_registration`, `profile_image`, `is_pornstar`) VALUES
(23, 'Sean', 'karina', 'irz@gmail.com', '2018-06-05 08:03:31', 'profil slika', 0),
(24, 'mirzaq', '923352284767451ab158a387a283df26', 'mirzaq@gmail.com', '2018-06-01 14:17:45', 'https://images.pexels.com/photos/160826/girl-dress-bounce-nature-160826.jpeg?auto=compress&cs=tinysrgb&h=350', 0),
(29, 'Picka', 'karina', 'sean@gmail.com', '2018-06-06 11:01:11', 'profil slika', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorite_videos`
--

CREATE TABLE `user_favorite_videos` (
  `id` int(255) UNSIGNED NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL,
  `videos_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_favorite_videos`
--

INSERT INTO `user_favorite_videos` (`id`, `users_id`, `videos_id`) VALUES
(1, 23, 5),
(2, 23, 7),
(4, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_suggested_videos`
--

CREATE TABLE `user_suggested_videos` (
  `id` int(255) UNSIGNED NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL,
  `videos_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_suggested_videos`
--

INSERT INTO `user_suggested_videos` (`id`, `users_id`, `videos_id`) VALUES
(13, 24, 5),
(14, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `download_link` varchar(255) NOT NULL,
  `hd` enum('true','false') NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `views` int(255) UNSIGNED NOT NULL,
  `length` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `thumbnail`, `description`, `category`, `video_url`, `download_link`, `hd`, `date`, `views`, `length`) VALUES
(1, 'big boobs', 'neznam', 'big boobs milf', 'milf', 'neznam', 'neznam', 'true', '2018-06-03 13:35:04', 100093, 12548),
(2, 'karina', 'karina', 'opis', 'kategorija', 'url', 'link2', 'true', '2018-06-02 22:00:00', 500, 520),
(4, 'jenny milf', 'karina', 'karina', 'teen', 'karina', 'karina', 'true', '2018-06-01 13:51:33', 528, 7564),
(5, 'carry', 'karina', 'karina', 'teen', 'karina', 'karina', 'false', '2018-06-03 13:34:54', 8532, 7452),
(7, 'mia kalifa', 'karina', 'karina', 'milf', 'karina', 'karina', 'true', '2018-06-04 15:45:43', 7400, 2587),
(14, 'nasldsdov', 'karina', 'opis', 'kategorija', 'url', 'link', 'true', '2018-06-05 14:02:00', 500, 520),
(15, 'nasldsdov', 'karina', 'opis', 'kategorija', 'url', 'link', 'true', '2018-06-05 14:02:00', 500, 520),
(18, 'nas', 'karina', 'opis', 'kategorija', 'url', 'link', 'true', '2018-06-06 10:16:15', 500, 520),
(19, 'nas', 'karina', 'opis', 'kategorija', 'url', 'link', 'true', '2018-06-06 10:16:45', 500, 520);

-- --------------------------------------------------------

--
-- Table structure for table `video_comments`
--

CREATE TABLE `video_comments` (
  `id` int(255) UNSIGNED NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `videos_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video_comments`
--

INSERT INTO `video_comments` (`id`, `users_id`, `content`, `date`, `videos_id`) VALUES
(1, 23, 'my comment...', '2018-06-02 05:47:31', 1),
(2, 3, 'karinas5', '2018-06-01 22:00:00', 1),
(3, 5, 'my comment...', '2018-05-31 09:15:31', 4),
(4, 5, 'my comment...', '2018-06-05 10:58:43', 2),
(5, 24, 'nesto', '2018-06-03 13:43:25', 5),
(6, 5, 'nesto', '2018-05-31 14:53:21', 5),
(7, 5, 'karina', '2018-06-05 10:08:28', 1),
(8, 5, 'karina', '2018-06-01 07:33:56', 5),
(9, 5, 'pet', '2018-06-05 10:08:30', 1),
(10, 5, 'pet', '2018-06-01 12:23:14', 5),
(11, 5, 'ma nesto', '2018-06-02 16:01:23', 5),
(12, 5, 'ma nesto', '2018-06-02 16:01:23', 5),
(13, 5, 'ma nesto drugo', '2018-06-03 14:15:44', 5);

-- --------------------------------------------------------

--
-- Table structure for table `video_dislikes`
--

CREATE TABLE `video_dislikes` (
  `id` int(255) UNSIGNED NOT NULL,
  `videos_id` int(255) UNSIGNED NOT NULL,
  `users_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video_dislikes`
--

INSERT INTO `video_dislikes` (`id`, `videos_id`, `users_id`) VALUES
(47, 2, 25),
(45, 5, 23),
(49, 20, 25);

-- --------------------------------------------------------

--
-- Table structure for table `video_likes`
--

CREATE TABLE `video_likes` (
  `id` int(255) NOT NULL,
  `videos_id` int(255) NOT NULL,
  `users_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video_likes`
--

INSERT INTO `video_likes` (`id`, `videos_id`, `users_id`) VALUES
(11, 5, 24),
(16, 5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `video_tags`
--

CREATE TABLE `video_tags` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `videos_id` int(255) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video_tags`
--

INSERT INTO `video_tags` (`id`, `name`, `videos_id`) VALUES
(1, 'milf', 1),
(2, 'karina2', 1),
(3, 'homemade', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_comments`
--
ALTER TABLE `image_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_dislikes`
--
ALTER TABLE `image_dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_likes`
--
ALTER TABLE `image_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_tags`
--
ALTER TABLE `image_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pornstars`
--
ALTER TABLE `pornstars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `pornstars_has_images`
--
ALTER TABLE `pornstars_has_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pornstars_has_videos`
--
ALTER TABLE `pornstars_has_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pornstar_subscribers`
--
ALTER TABLE `pornstar_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_favorite_videos`
--
ALTER TABLE `user_favorite_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_suggested_videos`
--
ALTER TABLE `user_suggested_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_comments`
--
ALTER TABLE `video_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_dislikes`
--
ALTER TABLE `video_dislikes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `videos_id` (`videos_id`,`users_id`);

--
-- Indexes for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `like` (`videos_id`,`users_id`);

--
-- Indexes for table `video_tags`
--
ALTER TABLE `video_tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `image_comments`
--
ALTER TABLE `image_comments`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `image_dislikes`
--
ALTER TABLE `image_dislikes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `image_likes`
--
ALTER TABLE `image_likes`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `image_tags`
--
ALTER TABLE `image_tags`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pornstars`
--
ALTER TABLE `pornstars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pornstars_has_images`
--
ALTER TABLE `pornstars_has_images`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pornstars_has_videos`
--
ALTER TABLE `pornstars_has_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pornstar_subscribers`
--
ALTER TABLE `pornstar_subscribers`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_favorite_videos`
--
ALTER TABLE `user_favorite_videos`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_suggested_videos`
--
ALTER TABLE `user_suggested_videos`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `video_comments`
--
ALTER TABLE `video_comments`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `video_dislikes`
--
ALTER TABLE `video_dislikes`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `video_likes`
--
ALTER TABLE `video_likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `video_tags`
--
ALTER TABLE `video_tags`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
