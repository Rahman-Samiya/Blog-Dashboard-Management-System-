-- phpMyAdmin SQL Dump
-- version 5.2.0-dev+20220214.de0244b3e6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 11:42 PM
-- Server version: 10.4.17-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subTitle` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `short_description` varchar(355) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `subTitle`, `slug`, `featured_image`, `short_description`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum dolor sit amet elit vitae porta diam', 'Lorem ipsum dolor sit amet elit', 'lorem-ipsum-dolor-sit-amet-elit-vitae-porta-diam', 'uploads/1745960228_photo1.png', 'Clita dolor amet dolor ipsum vero ea ea eos. Invidunt sed diam dolores takimata dolor dolore dolore sit. ', '<p><span style=\"color: rgb(154, 157, 162); font-family: Montserrat, sans-serif;\">Diam dolor est labore duo invidunt ipsum clita et, sed et lorem voluptua tempor invidunt at est sanctus sanctus. Clita dolores sit kasd diam takimata justo diam lorem sed. Magna amet sed rebum eos. Clita no magna no dolor erat diam tempor rebum consetetur, sanctus labore sed nonumy diam lorem amet eirmod. No at tempor sea diam kasd, takimata ea nonumy elitr sadipscing gubergren erat. Gubergren at lorem invidunt sadipscing rebum sit amet ut ut, voluptua diam dolores at sadipscing stet. Clita dolor amet dolor ipsum vero ea ea eos. Invidunt sed diam dolores takimata dolor dolore dolore sit. Sit ipsum erat amet lorem et, magna sea at sed et eos. Accusam eirmod kasd lorem clita sanctus ut consetetur et. Et duo tempor sea kasd clita ipsum et. Takimata kasd diam justo est eos erat aliquyam et ut.</span></p>', 4, '2025-04-29 22:57:08', NULL),
(2, 'Second Blog ', 'Lorem ipsum dolor sit amet elit', 'second-blog-', 'uploads/1745960976_photo4.jpg', 'Accusam eirmod kasd lorem clita sanctus ut consetetur et. Et duo tempor sea kasd clita ipsum et.', '<p style=\"color: rgb(154, 157, 162); font-family: Montserrat, sans-serif;\">Sadipscing labore amet rebum est et justo gubergren. Et eirmod ipsum sit diam ut magna lorem. Nonumy vero labore lorem sanctus rebum et lorem magna kasd, stet amet magna accusam consetetur eirmod. Kasd accusam sit ipsum sadipscing et at at sanctus et. Ipsum sit gubergren dolores et, consetetur justo invidunt at et aliquyam ut et vero clita. Diam sea sea no sed dolores diam nonumy, gubergren sit stet no diam kasd vero.</p><p style=\"color: rgb(154, 157, 162); font-family: Montserrat, sans-serif;\">Voluptua est takimata stet invidunt sed rebum nonumy stet, clita aliquyam dolores vero stet consetetur elitr takimata rebum sanctus. Sit sed accusam stet sit nonumy kasd diam dolores, sanctus lorem kasd duo dolor dolor vero sit et. Labore ipsum duo sanctus amet eos et. Consetetur no sed et aliquyam ipsum justo et, clita lorem sit vero amet amet est dolor elitr, stet et no diam sit. Dolor erat justo dolore sit invidunt.</p>', 5, '2025-04-29 23:09:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag`
--

CREATE TABLE `blog_tag` (
  `blog_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_tag`
--

INSERT INTO `blog_tag` (`blog_id`, `tag_id`) VALUES
(1, 3),
(1, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Business', 'business', NULL, NULL),
(3, 'Food', 'food', NULL, NULL),
(4, 'Food', 'food', NULL, NULL),
(5, 'LifeSyle', 'lifesyle', NULL, NULL),
(6, 'Education', 'education', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Political', 'political', NULL, NULL),
(3, 'Traveler', 'traveler', NULL, NULL),
(4, 'Bloager', 'bloager', NULL, NULL),
(5, 'Religious', 'relagious', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES

(1, 'Samiya', 'samiya@gmail.com', '$2y$10$YihxRtHU5vyDz11IPgLhY.1dfoQS6YrOV3nlRrUKN6BxWpgKjv8Ou');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`blog_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD CONSTRAINT `blog_tag_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
