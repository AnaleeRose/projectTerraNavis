-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2020 at 09:08 PM
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
(22, 'bpaAdmin', 'bpa_admin@email.com', 16, 'dmode'),
(27, 'AnaleeRose', 'analeeskinner@gmail.com', 16, 'dmode');

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
  `img_name` varchar(250) DEFAULT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `error_flag` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `article_name`, `article_description`, `article_category`, `date_added`, `date_modified`, `img_name`, `caption`, `error_flag`) VALUES
(1, 'Test Article #1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2019-11-07 08:56:13', '2019-11-11 08:56:13', NULL, NULL, NULL),
(2, 'Test Article #2', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 2, '2019-11-10 08:56:13', '2019-11-11 08:56:13', NULL, NULL, NULL),
(3, 'Test Article #3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2019-11-11 08:56:13', '2019-11-11 08:56:13', NULL, NULL, NULL),
(70, 'Lorem Ipsum', 'This is an article about lorem ipsum. It\'s a test of this applications abilities so far.', 4, '2019-12-06 15:43:21', '2019-12-06 15:43:21', 'resized_LoremIpsum_603.png', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur ma', NULL),
(76, 'Lorem Ipsum', 'This is an article about lorem ipsum. It\'s a test of this applications abilities so far.', 4, '2019-12-06 16:05:46', '2019-12-06 16:05:46', 'resized_LoremIpsum_603.png', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur ma', NULL),
(77, 'New Article', 'Admin', 3, '2019-12-06 17:06:54', '2019-12-06 17:06:54', 'resized_NewArticle_603.jpg', 'Cappo', 1),
(98, 'Rigorous Testing', 'I\'m probably gonna regret testing this hard, let\'s see where it breaks! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ull', 4, '2019-12-10 20:35:20', '2019-12-19 17:08:27', 'resized_RigorousTesting_512.png', 'My code when i beg it to function for 30 seconds straight:', NULL),
(105, 'Ayyye', 'lost in my thoughts on the daillllllly', 4, '2019-12-19 18:56:47', '2020-01-09 14:53:39', 'resized_Ayyye_495.jpg', 'cant sleep, cant eat kinda love, please save me, kinda love', NULL);

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
(153, 70, 1, 1, 'p_1', '&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;', NULL, NULL),
(154, 70, 1, 2, 'p_2', '&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;', NULL, NULL),
(155, 70, 1, 3, 'p_3', '&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;', NULL, NULL),
(156, 70, 7, 4, 'ul_1_li_1', '&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;', 1, 0),
(157, 70, 7, 5, 'ul_1_li_2', '&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;', 0, 0),
(158, 70, 7, 6, 'ul_1_li_3', '::empty::', 0, 1),
(159, 76, 3, 1, 'heading3_1', 'The standard Lorem Ipsum passage, used since the 1500s', NULL, NULL),
(160, 76, 1, 2, 'p_1', '&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;', NULL, NULL),
(161, 76, 1, 3, 'p_2', '&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;', NULL, NULL),
(162, 76, 3, 4, 'heading3_2', '1914 translation by H. Rackham', NULL, NULL),
(163, 76, 1, 5, 'p_3', '&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;', NULL, NULL),
(164, 77, 3, 1, 'heading3_1', 'Heading 3', NULL, NULL),
(165, 77, 1, 2, 'p_1', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', NULL, NULL),
(166, 77, 7, 3, 'ul_1_li_1', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', 1, 0),
(167, 77, 7, 4, 'ul_1_li_2', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', 0, 0),
(168, 77, 7, 5, 'ul_1_li_3', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', 0, 1),
(169, 77, 8, 6, 'ol_1_li_1', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', 1, 0),
(170, 77, 8, 7, 'ol_1_li_2', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', 0, 0),
(171, 77, 8, 8, 'ol_1_li_3', 'ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ParagraphParagraphParagraphParagraphParagraph ', 0, 1),
(294, 98, 2, 1, 'heading2_1', 'This Is A Heading 2', NULL, NULL),
(295, 98, 3, 2, 'heading3_1', 'This Is A Heading 3', NULL, NULL),
(296, 98, 4, 3, 'heading4_1', 'This Is A Heading 4', NULL, NULL),
(297, 98, 5, 4, 'heading5_1', 'This Is A Heading 5', NULL, NULL),
(298, 98, 7, 5, 'ul_1_li_1', '<a href=\"https://www.mylink.com\">My Link 1</a>', 1, 0),
(299, 98, 7, 6, 'ul_1_li_2', '<a href=\"https://www.mylink.com\">My Link 2</a>', 0, 0),
(300, 98, 7, 7, 'ul_1_li_3', '<a href=\"https://www.mylink.com\">My Link 3</a>', 0, 1),
(301, 98, 8, 8, 'ol_1_li_1', '<a href=\"https://www.mylink.com\">My Link o1</a>', 1, 0),
(302, 98, 8, 9, 'ol_1_li_2', '<a href=\"https://www.mylink.com\">My Link o2</a>', 0, 0),
(303, 98, 8, 10, 'ol_1_li_3', '<a href=\"https://www.mylink.com\">My Link o3</a>', 0, 1),
(304, 98, 1, 11, 'p_1', 'Ignoring paragraphs are we?', NULL, NULL),
(319, 105, 1, 1, 'p_1', 'p1', NULL, NULL),
(320, 105, 1, 2, 'p_3', 'p2', NULL, NULL),
(321, 105, 1, 3, 'p_4', 'oh noews', NULL, NULL);

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
(2, 'Clean Energy'),
(3, 'General'),
(4, 'Random');

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
(17, 'Terra Navis Newsfeed | Ayyye', 'Terra Navis\r\n<br>\r\nA new article has been posted on the newsfeed!\r\n<br>\r\nCheck out Ayyye or read more articles about Random at <a href=\\\"http://bpa-development.savannahskinner.com/admin/newsfeed.php\">Terra Navis.com</a>!', 1, '2019-12-19 19:47:04', NULL),
(18, 'm,y new email :D', 'new email', 0, '2020-01-09 14:58:49', '2020-01-09 14:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_list`
--

INSERT INTO `email_list` (`id`, `email`) VALUES
(1, 'analeeskinner@gmail.com'),
(2, 'kaiasnowsteam@gmail.com');

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
(1, 'basic.jpg', 'Default Image'),
(9, 'f_light.jpg', 'Female - Light'),
(10, 'f_med.jpg', 'Female - Medium'),
(11, 'f_dark.jpg', 'Female - Dark'),
(12, 'm_light.jpg', 'Male - Light'),
(13, 'm_med.jpg', 'Male - Medium'),
(14, 'm_dark.jpg', 'Male - Dark'),
(15, 'f_light_alt.jpg', 'Female - Light -Alt ver.'),
(16, 'f_med_alt.jpg', 'Female - Med - Alt ver.'),
(17, 'f_dark_alt.jpg', 'Female - Dark-Alt ver.'),
(18, 'earthship.jpg', 'Earth & A Ship'),
(19, 'sunny_mount.jpg', 'Sunny Mountain');

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
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `article_content`
--
ALTER TABLE `article_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `content_types`
--
ALTER TABLE `content_types`
  MODIFY `content_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `pwd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profilepictures`
--
ALTER TABLE `profilepictures`
  MODIFY `profilePic_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

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
