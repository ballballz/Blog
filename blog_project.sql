-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 01:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` bigint(20) NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `cate_id` bigint(20) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `topic`, `content`, `user_id`, `cate_id`, `create_at`, `update_at`, `img`) VALUES
(1, 'In Midlife, I’m Learning to Sit with Grief', 'Physics is not in a rut – but people writing about physics might be writing about physics', 1, 1, '2022-03-26 08:59:16', '2022-01-28 03:39:10', 'travel-1.jpeg'),
(2, 'Social Media, Like Alcohol, May Be Riskier When You’re Vulnerable', 'Interpersonal skills for a proudly disabled life.', 2, 2, '2022-03-26 08:59:09', '2022-01-28 03:39:17', 'travel-2.jpeg'),
(3, '‘The Gilded Age’ Takes Its Time. That’s a Good Thing.', 'Social media may be uniquely dangerous for those who are struggling.', 19, 1, '2022-03-26 08:59:05', '2022-01-28 03:40:25', 'travel-3.jpeg'),
(4, 'The Answer is Redevelopment, Not Building Schlongs Off Manhattan', 'Before you ask, here are the answers to your four questions about The Gilded Age, which runs Monday nights on HBO.', 4, 2, '2022-03-26 08:59:03', '2022-01-28 03:40:25', 'travel-4.jpeg'),
(5, 'Rereading Georg Lukács’ “The Destruction of Reason” in the Time of Trumpism', 'A blast from the past', 5, 2, '2022-03-26 08:59:00', '2022-01-28 03:40:25', 'travel-5.jpeg'),
(6, 'In Midlife, I’m Learning to Sit with Grief\n', 'How’s your new year’s resolution going? I suggest you quit.', 2, 1, '2022-03-26 08:58:57', '2022-01-28 03:40:25', 'travel-6.jpeg'),
(7, 'Will The Pandemic Upend The Workplace And Our Cities?', 'The past two years could lead to a fundamental change', 3, 2, '2022-03-26 08:58:51', '2022-01-28 03:40:25', 'travel-7.jpeg'),
(8, 'In Midlife, I’m Learning to Sit with Grief', 'How I’ve tried (and failed) to outrun it in the past', 4, 1, '2022-03-26 08:58:44', '2022-01-28 03:40:25', 'travel-8.jpeg'),
(9, 'How to Talk About Sex for the First Time with Your Significant Other', 'Even if you’ve been having sex for a while, the first conversation can be awkward', 5, 1, '2022-03-26 08:58:41', '2022-01-28 03:40:25', 'travel-9.jpeg'),
(10, 'The Self-Care Treats I’d Love to Give Dr. Anthony Fauci', 'The man deserves rest, extravagance, and a basket of time', 2, 2, '2022-03-26 08:58:38', '2022-01-28 03:40:25', 'travel-10.jpeg'),
(11, '24 hours in Ukraine', 'On Tuesday night, I got back from a whirlwind 24-hour visit to Ukraine with six of my ', 3, 2, '2022-03-26 08:58:35', '2022-01-28 03:40:25', 'travel-11.jpg'),
(12, 'Is the WHO Saying the Pandemic Is Almost Over?', 'It sort of looks that way.', 4, 1, '2022-03-26 08:58:32', '2022-01-28 03:40:25', 'travel-12.jpg'),
(13, 'The Uncomfortable Lessons I Learned Playing Office Politics', 'I vowed to never be at the mercy of bullies again. Then I joined the corporate space.', 1, 1, '2022-03-26 08:58:29', '2022-01-28 03:40:25', 'travel-13.jpg'),
(14, 'What Are the Facts on Omicron? The Picture Is Getting Clearer', 'Omicron poses a serious threat, but we’re not back to square one', 5, 2, '2022-03-26 08:58:26', '2022-01-28 03:40:25', 'travel-14.jpg'),
(15, 'Bad Physics takes', 'This trope of gifting flowers to your partner seems rather tired, until it’s not.', 2, 1, '2022-03-26 08:58:23', '2022-01-28 03:40:25', 'travel-15.jpg'),
(16, 'Jules Verne’s Space Gun', 'Ignore the haters and understand the benefits', 3, 1, '2022-03-26 08:58:20', '2022-01-28 03:40:25', 'travel-16.jpg'),
(17, 'Thich Nhat Hanh Taught Us to Live In Midair', 'The Zen Buddhist monk, who died last Saturday, is even more relevant in these deeply', 4, 1, '2022-03-26 08:58:17', '2022-01-28 03:40:25', 'travel-17.jpg'),
(18, 'I’d Like to Make a Case for Permissable Insanity Tempered With Love', 'We are channeling smartphones and laptops to act as surrogates and provide us', 5, 1, '2022-03-26 08:58:13', '2022-01-28 03:40:25', 'travel-18.jpg'),
(19, 'The Fraught Female Author Photo Experience', 'Is it possible for a writer to build her brand without damaging her soul?', 2, 2, '2022-03-26 08:58:10', '2022-01-28 03:40:25', 'travel-19.jpg'),
(20, 'The Top 12 Technologies to Watch in 2022', 'Some will scare you, most will blow your mind\n', 4, 2, '2022-03-26 08:58:07', '2022-01-28 03:40:25', 'travel-20.jpg'),
(22, 'What Are the Facts on Omicron? The Picture Is Getting Clearer', 'The Zen Buddhist monk, who died last Saturday, is even more relevant in these deeply', 19, 1, '2022-03-26 08:58:03', '2022-02-01 10:28:03', 'travel-20.jpg'),
(23, 'What Are the Facts on Omicron? The Picture Is Getting Clearer', 'We are channeling smartphones and laptops to act as surrogates and provide us', 3, 2, '2022-03-26 08:57:59', '2022-02-01 10:28:15', 'travel-18.jpg\n'),
(24, 'What Are the Facts on Omicron? The Picture Is Getting Clearer', 'Some will scare you, most will blow your mind\n', 1, 1, '2022-03-26 08:57:56', '2022-02-01 10:31:43', 'travel-19.jpg'),
(25, 'I’d Like to Make a Case for Permissable Insanity Tempered With Love', 'Social media may be uniquely dangerous for those who are struggling.', 2, 2, '2022-03-26 08:57:50', '2022-02-01 10:48:27', 'travel-2.jpeg'),
(391, 'asdsad', 'dasd', NULL, 1, '2022-03-26 10:01:49', '2022-03-26 10:01:49', '623ee48da1d1f651821407.jpeg'),
(392, 'asdsad', 'dasd', NULL, 1, '2022-03-26 10:01:58', '2022-03-26 10:01:58', '623ee496c6585788207566.jpeg'),
(393, 'asdsad', 'dasd', NULL, 1, '2022-03-26 10:03:09', '2022-03-26 10:03:09', '623ee4ddaad942088675198.jpeg'),
(394, 'dsad', 'dasd', NULL, 1, '2022-03-26 10:03:22', '2022-03-26 10:03:22', '623ee4ea047471965325088.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` bigint(20) NOT NULL,
  `cate_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`) VALUES
(1, 'Travel'),
(2, 'Game');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Jonhson Waliey', 'johnson@gmail.com', '12345678', 'img/avatar/ava-1.jpeg', '2022-01-27 20:58:26', '2022-01-27 20:58:26'),
(2, 'Mendy Lopawa', 'mendy@gmail.com', '12345678', 'img/avatar/ava-2.jpeg', '2022-01-27 20:58:26', '2022-01-27 20:58:26'),
(3, 'Sammy Welable', 'sammy@hotmail.com', '12345678', 'img/avatar/ava-3.jpeg', '2022-01-27 20:58:26', '2022-01-27 20:58:26'),
(4, 'Hokbie Gegey', 'hokbie@gmail.com', '12345678', 'img/avatar/ava-4.jpeg', '2022-01-27 21:00:56', '2022-01-27 21:00:56'),
(5, 'Apisit Luttapap', 'eieiball@gmail.com', '12345678', 'img/avatar/ava-5.jpeg', '2022-01-27 20:58:26', '2022-01-27 20:58:26'),
(6, 'Jojo Macingee', 'jojo@gmmail.com', '12345678', 'img/avatar/ava-4.jpeg', '2022-01-27 21:47:09', '2022-01-27 21:47:09'),
(19, 'Lobert', 'ballbobor@gmail.com', '$2y$10$oNDD9gVxqgY4CHONgBL5d.3RsUe6OPOV1LI90nEzEyp7Jt27ZPA8a', 'img/avatar/ava-4.jpeg', '2022-01-28 01:08:55', '2022-01-28 01:08:55'),
(80, 'bebe', 'bebe@gmail.com', '$2y$10$LrI/OEDkLaYIQ8KbCuUYp.OSq7uegKcwP0Burg/lRL83zhoXkZCwW', 'img/avatar.jpg', '2022-02-10 20:04:58', '2022-02-10 20:04:58'),
(92, 'dsadasd', 'dsadas@gmail.com', '$2y$10$Jno1V.UtGTXZ08SWkl/QMOuMOQmk1F0Pswr3MK.kqNpLtMms8ybTS', 'img/avatar/profile.png', '2022-03-26 10:24:07', '2022-03-26 10:24:07'),
(93, 'Apisit Luttapap', 'eieiball1@gmail.com', '$2y$10$8e90KT5AyUkBp0UHIfEVt.RsrrMDfVktJcyFco8Z/OODkFbLesH7G', 'img/avatar/profile.png', '2022-03-26 11:03:04', '2022-03-26 11:03:04'),
(94, 'Apisit Luttapap', 'eieiball2@gmail.com', '$2y$10$N1s0lOi5G25OJm51a7YlqOrkV6Bq.SAXHHImLdnXz.migkBd.76XC', 'img/avatar/profile.png', '2022-04-22 16:40:38', '2022-04-22 16:40:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_cate_id` (`cate_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `idex_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
