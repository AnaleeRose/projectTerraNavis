-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2019 at 10:19 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `analeerose_bpa`
--
CREATE DATABASE IF NOT EXISTS `analeerose_bpa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `analeerose_bpa`;

-- --------------------------------------------------------

--
-- Table structure for table `adminuser`
--

CREATE TABLE `adminuser` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(40) NOT NULL,
  `admin_email` varchar(120) NOT NULL,
  `profilePic_id` int(6) NOT NULL DEFAULT 0,
  `light_mode` enum('lmode','dmode') NOT NULL DEFAULT 'lmode'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuser`
--

INSERT INTO `adminuser` (`admin_id`, `admin_username`, `admin_email`, `profilePic_id`, `light_mode`) VALUES
(22, 'bpaAdmin', 'bpa_admin@email.com', 4, 'lmode'),
(27, 'analeerose', 'analeeskinner@gmail.com', 2, 'lmode');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `article_name` varchar(80) NOT NULL,
  `article_description` mediumtext NOT NULL,
  `article_category` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `error_flag` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `article_name`, `article_description`, `article_category`, `date_added`, `date_modified`, `error_flag`) VALUES
(1, 'Test Article #1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2019-11-07 08:56:13', '2019-11-11 08:56:13', NULL),
(2, 'Test Article #2', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 2, '2019-11-10 08:56:13', '2019-11-11 08:56:13', NULL),
(3, 'Test Article #3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2019-11-11 08:56:13', '2019-11-11 08:56:13', NULL),
(29, 'Hola', 'tho', 2, '2019-11-19 16:30:52', '2019-11-19 16:32:25', 0),
(45, 'Article With Everything', 'This is an article with every type of element except images, just to test it!', 2, '2019-11-20 20:57:51', '2019-11-20 21:14:06', NULL),
(48, 'edit this article', 'edit moiiiiii~~~~', 2, '2019-11-21 16:16:19', '2019-11-21 16:16:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_content`
--

CREATE TABLE `article_content` (
  `content_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `content_type` int(11) NOT NULL,
  `order_of_content` int(11) NOT NULL,
  `element_name` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `is_first_li` tinyint(1) DEFAULT NULL,
  `is_last_li` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_content`
--

INSERT INTO `article_content` (`content_id`, `article_id`, `content_type`, `order_of_content`, `element_name`, `content`, `is_first_li`, `is_last_li`) VALUES
(1, 1, 2, 0, '', 'New Heading', NULL, NULL),
(2, 1, 1, 0, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL),
(24, 29, 1, 1, 'p_1', 'srge', NULL, NULL),
(73, 45, 2, 1, 'heading2_1', 'Heading 2', NULL, NULL),
(74, 45, 3, 2, 'heading3_1', 'Heading 3', NULL, NULL),
(75, 45, 4, 3, 'heading4_1', 'Heading 4', NULL, NULL),
(76, 45, 5, 4, 'heading5_1', 'Heading 5', NULL, NULL),
(77, 45, 1, 5, 'p_1', 'Paragraph', NULL, NULL),
(78, 45, 6, 6, 'hr_1', 'hr_1', NULL, NULL),
(84, 48, 1, 1, 'p_1', 'THis is a para', NULL, NULL),
(85, 48, 6, 2, 'hr_1', 'hr_1', NULL, NULL),
(86, 48, 4, 3, 'heading4_1', 'info', NULL, NULL),
(87, 48, 7, 4, 'ul_1_li_1', '<a href=\"https://www.mylink.com\">My Link</a>', 1, 0),
(88, 48, 7, 5, 'ul_1_li_2', '<a href=\"https://www.mylink.com\">My Link</a>', 0, 0),
(89, 48, 7, 6, 'ul_1_li_3', '<a href=\"https://www.mylink.com\">My Link</a>', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Earthship Construction & Design'),
(2, 'Clean Energy');

-- --------------------------------------------------------

--
-- Table structure for table `content_types`
--

CREATE TABLE `content_types` (
  `content_type_id` int(11) NOT NULL,
  `content_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content_types`
--

INSERT INTO `content_types` (`content_type_id`, `content_type`) VALUES
(1, 'paragraph'),
(2, 'h2'),
(3, 'h3'),
(4, 'h4'),
(5, 'h5'),
(6, 'hr'),
(7, 'link'),
(8, 'list'),
(9, 'img');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL,
  `email_subject` varchar(250) NOT NULL,
  `email_message` longtext NOT NULL,
  `save_for_later` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_sent` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `email_subject`, `email_message`, `save_for_later`, `date_added`, `date_sent`) VALUES
(1, 'Test Email #1', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 0, '2019-11-08 08:55:34', '2019-11-07 18:52:25'),
(2, 'Test Email #2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, '2019-11-10 08:55:34', '2019-11-05 18:52:25'),
(3, 'Test Email #3', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 0, '2019-11-11 08:55:34', '2019-11-02 17:52:25'),
(7, 'New Email', 'THis is my new email\r\n<br>\r\n<br>\r\nLink: <a href=\"egsesg.com\">egs</a>', 0, '2019-11-20 19:20:24', '2019-11-20 19:20:24'),
(8, 'Terra Navis Newsfeed | ygk', 'Terra Navis\r\n<br>\r\nA new article has been posted on the newsfeed!\r\n<br>\r\nCheck out ygk or read more articles about Earthship Construction & Design at <a href=\\\"http://bpa-development.savannahskinner.com/admin/newsfeed.php\">Terra Navis</a>', 0, '2019-11-20 19:21:45', '2019-11-20 19:21:45'),
(9, 'Terra Navis Newsfeed | ygk', 'Terra Navis\r\n<br>\r\nA new article has been posted on the newsfeed!\r\n<br>\r\nCheck out ygk or read more articles about Earthship Construction & Design at <a href=\\\"http://bpa-development.savannahskinner.com/admin/newsfeed.php\">Terra Navis</a>', 0, '2019-11-20 19:22:07', '2019-11-20 19:22:07'),
(10, 'Terra Navis Newsfeed | ygk', 'Terra Navis\r\n<br>\r\nA new article has been posted on the newsfeed!\r\n<br>\r\nCheck out ygk or read more articles about Earthship Construction & Design at <a href=\\\"http://bpa-development.savannahskinner.com/admin/newsfeed.php\">Terra Navis.com</a>!', 0, '2019-11-20 19:30:05', '2019-11-20 19:30:05'),
(11, 'Terra Navis Newsfeed | edit this article', 'Terra Navis\r\n<br>\r\nA new article has been posted on the newsfeed!\r\n<br>\r\nCheck out edit this article or read more articles about Clean Energy at <a href=\\\"http://bpa-development.savannahskinner.com/admin/newsfeed.php\">Terra Navis.com</a>!', 0, '2019-11-21 16:18:06', '2019-11-21 16:18:06'),
(12, 'reedy reeds', 'rdh', 1, '2019-11-21 16:37:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `pwd_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`pwd_id`, `admin_id`, `info`) VALUES
(13, 22, '$2y$10$ojtLGpxbIZtX3W4RXLN8BunxmNdUb5fIWGu1Gsgojuqk/TdB2qoWC'),
(14, 27, '$2y$10$R0kSMuSJo02V0QA3UFFLR.9AldHw2Me5JKLe7MYawl6lkWfaplR8S');

-- --------------------------------------------------------

--
-- Table structure for table `profilepictures`
--

CREATE TABLE `profilepictures` (
  `profilePic_id` int(6) NOT NULL,
  `pic_location` varchar(50) NOT NULL,
  `pic_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilepictures`
--

INSERT INTO `profilepictures` (`profilePic_id`, `pic_location`, `pic_name`) VALUES
(1, 'basic.png', 'Base Profile Picture'),
(2, 'sunset.jpg', 'Sunset'),
(3, 'leaf_girl.jpg', 'Leaf Girl'),
(4, 'rainbow.jpg', 'Rainbow'),
(5, 'rose.jpg', 'Rose');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminuser`
--
ALTER TABLE `adminuser`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `profilePic_id` (`profilePic_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `article_category` (`article_category`);

--
-- Indexes for table `article_content`
--
ALTER TABLE `article_content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `content_type` (`content_type`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `article_id_2` (`article_id`),
  ADD KEY `content_type_2` (`content_type`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `content_types`
--
ALTER TABLE `content_types`
  ADD PRIMARY KEY (`content_type_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`pwd_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `profilepictures`
--
ALTER TABLE `profilepictures`
  ADD PRIMARY KEY (`profilePic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminuser`
--
ALTER TABLE `adminuser`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `article_content`
--
ALTER TABLE `article_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `content_types`
--
ALTER TABLE `content_types`
  MODIFY `content_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `pwd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profilepictures`
--
ALTER TABLE `profilepictures`
  MODIFY `profilePic_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminuser`
--
ALTER TABLE `adminuser`
  ADD CONSTRAINT `adminuser_ibfk_1` FOREIGN KEY (`profilePic_id`) REFERENCES `profilepictures` (`profilePic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`article_category`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_content`
--
ALTER TABLE `article_content`
  ADD CONSTRAINT `article_content_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_content_ibfk_2` FOREIGN KEY (`content_type`) REFERENCES `content_types` (`content_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `adminuser` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
