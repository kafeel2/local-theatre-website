-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 03:04 PM
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
-- Database: `local_theatre_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_author` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `blog_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','published','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_content`, `blog_author`, `image_url`, `blog_created`, `status`) VALUES
(8, 'A Glimpse Behind the Curtains: Preparing for Hamlet', 'Take a behind-the-scenes look at how our talented cast and crew prepared for our latest production of *Hamlet*. From costume fittings to late-night rehearsals, discover what it takes to bring Shakespeare to life.', 8, 'hamlet.jpg', '2025-06-10 10:33:38', 'published'),
(9, 'Upcoming Show: The Phantom Returns', 'Exciting news! *The Phantom Returns*, a thrilling musical drama, hits the stage this July. Learn more about the story, meet the cast, and find out how to book your tickets early!', 8, 'Phantom-opera.jpg', '2025-06-10 10:33:38', 'published'),
(10, 'Volunteer Spotlight: Meet Emma', 'This week, we feature Emma – one of our amazing volunteers who helps with lighting design. Learn how she got involved and what she loves about being part of the theatre community.', 7, 'Emma1.jpg', '2025-06-10 10:33:38', 'published'),
(11, 'Top 5 Moments from the Winter Festival!!', 'From powerful monologues to unexpected standing ovations, here are the top 5 unforgettable moments from this year’s Winter Theatre Festival.', 6, 'winter-festival.jpg', '2025-06-10 10:33:38', 'published'),
(12, 'New Start 1236', 'Something exciting is coming soon! Stay tuned for full details, cast announcements, and show dates.\nSomething exciting is coming soon! Stay tuned for full details, cast announcements, and show dates.\nSomething exciting is coming soon! Stay tuned for full details, cast announcements, and show dates.\n', 5, 'coming-soon.jpg', '2025-06-10 10:33:38', 'pending'),
(13, 'An Evening with Shakespeare: Celebrating Classics', 'Celebrate the timeless works of William Shakespeare with a night of powerful performances, dramatic monologues, and live music. A tribute to the Bard like never before!', 7, 'Shakespeare.jpg', '2025-06-13 11:11:56', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `status` enum('approved','rejected','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `comment_created`, `user_id`, `blog_id`, `status`) VALUES
(12, 'tryfstyshytrh', '2025-06-13 09:48:50', 9, 8, 'pending'),
(13, 'karen testing lucy account', '2025-06-13 09:52:29', 7, 10, 'pending'),
(14, 'karen testing lucy account 2', '2025-06-13 09:53:18', 7, 10, 'pending'),
(15, 'karen test with no redirect', '2025-06-13 09:54:26', 7, 10, 'pending'),
(16, 'karen test again with user id', '2025-06-13 09:56:22', 9, 10, 'pending'),
(17, 'erwqeeg', '2025-06-13 11:16:06', 7, 12, 'pending'),
(18, 'erwqeeg', '2025-06-13 11:16:29', 7, 12, 'pending'),
(19, 'Looking forward to it.', '2025-06-13 11:17:03', 7, 12, 'pending'),
(20, 'This show was really good.', '2025-06-13 11:44:35', 9, 8, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `news_added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `status` enum('approved','rejected','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_text`, `created_at`, `user_id`, `show_id`, `status`) VALUES
(4, 'It was great', '2025-06-13 11:25:20', 9, 3, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `show_id` int(11) NOT NULL,
  `show_name` varchar(100) NOT NULL,
  `date_shown` date NOT NULL,
  `show_type` enum('theatre','film') NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`show_id`, `show_name`, `date_shown`, `show_type`, `image_url`) VALUES
(1, 'Phantom of the Opera1', '2025-06-15', 'theatre', 'phantom.jpg'),
(2, 'Inception', '2025-07-20', 'film', 'film-inception.jpg'),
(3, 'Lion King Return of Simba3', '2025-06-13', 'film', 'Return-of-the-king.jpg'),
(4, 'Lion King Return of Simba2', '2025-06-14', 'theatre', 'TheLionKing.jpg'),
(7, 'The Mask', '2025-06-13', 'theatre', 'TheMask.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_on`) VALUES
(5, 'Kafeel12567', 'kafeel@email.com', '$2y$10$nOUIs5kJ7naTuTFkBy1veuEvZx5aZpOHmCa87np2uXn3/j5Aq8cWm', 'admin', '2025-02-11 10:00:00'),
(6, 'Azim', 'azim@email.com', '$2y$10$1AjS1UkogZEiW1Y9c.iqL.H.CqI5ufYXraLBFhcflRJ1gMVf3yzpe', 'user', '2025-02-11 10:10:00'),
(7, 'kafeel123', 'kafeel_a_01@hotmail.com', '$2y$10$qNWhmk29.vAmwdCimNhQ5ua/UVWOBjO/HIBZCYNxsyobP.VVH4YDq', 'admin', '2025-06-09 19:07:46'),
(8, 'kafeel125', 'kahmed369@googlemail.com', '$2y$10$1OCnU9eognJbbHAlKnXLd.k4eLY5Ng4uCzC8MzQnmfpAX4sTHnE/G', 'admin', '2025-06-09 19:11:22'),
(9, 'lucy123', 'lucyrafferty@gmail.com', '$2y$10$5/zWq4ADSyscw5/C47a2uOXvbTNoH85N.zDshsEjb18PvpPKYE8nC', 'user', '2025-06-13 09:47:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blog_author` (`blog_author`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `news_added_by` (`news_added_by`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`show_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`blog_author`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`blog_id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`news_added_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`show_id`) REFERENCES `shows` (`show_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
