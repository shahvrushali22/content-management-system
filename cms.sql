-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2019 at 11:32 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'java'),
(3, 'c'),
(4, 'CSS'),
(6, 'Sports'),
(7, 'Lifestyle'),
(8, 'food');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(50) NOT NULL DEFAULT 'disapproved',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(4, 15, 'Vrushali Atul Shah', 'shahvrushali22@gmail.com', 'hello', 'disapproved', '2019-04-10');

--
-- Triggers `comments`
--
DELIMITER $$
CREATE TRIGGER `before_comment_delete` BEFORE DELETE ON `comments` FOR EACH ROW BEGIN
    INSERT INTO comments_audit
    SET action_performed  = 'Deleted a new comment',
    comment_author = old.comment_author;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_comment_insert` BEFORE INSERT ON `comments` FOR EACH ROW BEGIN
    INSERT INTO comments_audit
    SET action_performed  = 'Inserted a new comment',
    comment_author       =  new.comment_author;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comments_audit`
--

CREATE TABLE `comments_audit` (
  `comment_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `action_performed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments_audit`
--

INSERT INTO `comments_audit` (`comment_id`, `comment_author`, `action_performed`) VALUES
(1, 'RHS Mam', 'Deleted a new comment'),
(2, 'Vrushali Atul Shah', 'Deleted a new comment'),
(3, 'Vrushali Atul Shah', 'Inserted a new comment');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(255) NOT NULL,
  `messenger_name` varchar(255) NOT NULL,
  `messenger_email` varchar(255) NOT NULL,
  `message_content` varchar(255) NOT NULL,
  `message_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `messenger_name`, `messenger_email`, `message_content`, `message_date`) VALUES
(2, 'vrushali', 'shahvrushali22@gmail.com', 'HELLO BYEE!', '2019-04-08'),
(11, 'Nisarg Shah', 'shahnisarg@gmail.com', 'Team-mate says hi!', '2019-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_cat_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) NOT NULL,
  `post_views_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(3, 4, 'CSS TRICKS', 'Reyna', '2019-04-02', 'team-1.jpg', '<h1>CSS MARGIN TRICKS</h1>\r\n<p>use margin&nbsp; 0 auto to center a a element using css.</p>', 'css tricks', 0, 'draft', 0),
(4, 1, 'Multithreading', '7', '2019-04-02', 'multithreading.jpeg', '<p>loremm&nbsp;<strong> this is just to test this tiny mce</strong></p>', 'java oop', 0, 'draft', 0),
(12, 3, 'Pointers', '18', '2019-04-06', 'bg_2.jpg', '<p>POINTERS !! EVERYTHING IS SO FUN WHEN PLAYING WUTH POINTERS!!!</p>', 'c pointers', 0, 'published', 0),
(13, 3, 'python', '18', '2019-04-06', 'bg_3.jpg', '<p>PYTHON!!</p>', 'python py', 0, 'published', 0),
(14, 1, 'Multithreading', '15', '2019-04-06', 'multithreading.jpeg', '<p><strong>Multithreading!!!</strong></p>', 'multithreading java', 0, 'draft', 0),
(15, 8, 'Indian Cuisine', '19', '2019-04-08', 'blog-post-1.jpeg', '<p>FOOD IS LIFE!! WITHOUT FOOD I DONT WHAT WOULD I DO.</p>\r\n<p><strong style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">Indian cuisine</strong><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;consists of a wide variety of regional and traditional cuisines native to the Indian subcontinent. Given the range of diversity in soil type, climate, culture, ethnic groups, and occupations, these cuisines vary substantially from each other and use locally available&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Spice\" href=\"https://en.wikipedia.org/wiki/Spice\">spices</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">,&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Herb\" href=\"https://en.wikipedia.org/wiki/Herb\">herbs</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">,&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Vegetable\" href=\"https://en.wikipedia.org/wiki/Vegetable\">vegetables</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">, and&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Fruit\" href=\"https://en.wikipedia.org/wiki/Fruit\">fruits</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">. Indian food is also heavily influenced by religion, in particular Hindu, cultural choices and traditions.</span><sup id=\"cite_ref-Dias1996_1-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px; color: #222222; font-family: sans-serif; background-color: #ffffff;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-Dias1996-1\">[1]</a></sup><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;The cuisine is also influenced by centuries of Islamic rule, particularly the&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Mughal Empire\" href=\"https://en.wikipedia.org/wiki/Mughal_Empire\">Mughal</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;rule.&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Samosa\" href=\"https://en.wikipedia.org/wiki/Samosa\">Samosas</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;and&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background: none #ffffff; font-family: sans-serif; font-size: 14px;\" title=\"Pilaf\" href=\"https://en.wikipedia.org/wiki/Pilaf\">pilafs</a><span style=\"color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;can be regarded as examples.</span><sup id=\"cite_ref-GestelandGesteland2010_2-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px; color: #222222; font-family: sans-serif; background-color: #ffffff;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-GestelandGesteland2010-2\">[2]</a></sup></p>\r\n<p><sup class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px; color: #222222; font-family: sans-serif; background-color: #ffffff;\"><span style=\"font-size: 14px; white-space: normal;\">Historical events such as foreign invasions, trade relations, and colonialism have played a role in introducing certain foods to this country. For instance,&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Potato\" href=\"https://en.wikipedia.org/wiki/Potato\">potato</a><span style=\"font-size: 14px; white-space: normal;\">, a staple of the diet in some regions of India, was brought to India by the&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Portuguese people\" href=\"https://en.wikipedia.org/wiki/Portuguese_people\">Portuguese</a><span style=\"font-size: 14px; white-space: normal;\">, who also introduced&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Chili pepper\" href=\"https://en.wikipedia.org/wiki/Chili_pepper\">chillies</a><span style=\"font-size: 14px; white-space: normal;\">&nbsp;and&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Breadfruit\" href=\"https://en.wikipedia.org/wiki/Breadfruit\">breadfruit</a><span style=\"font-size: 14px; white-space: normal;\">.</span><sup id=\"cite_ref-3\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-3\">[3]</a></sup><span style=\"font-size: 14px; white-space: normal;\">&nbsp;Indian cuisine has shaped the history of&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"International relations\" href=\"https://en.wikipedia.org/wiki/International_relations\">international relations</a><span style=\"font-size: 14px; white-space: normal;\">; the&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Spice trade\" href=\"https://en.wikipedia.org/wiki/Spice_trade\">spice trade</a><span style=\"font-size: 14px; white-space: normal;\">&nbsp;between India and&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Europe\" href=\"https://en.wikipedia.org/wiki/Europe\">Europe</a><span style=\"font-size: 14px; white-space: normal;\">&nbsp;was the primary catalyst for Europe\'s&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Age of Discovery\" href=\"https://en.wikipedia.org/wiki/Age_of_Discovery\">Age of Discovery</a><span style=\"font-size: 14px; white-space: normal;\">.</span><sup id=\"cite_ref-cornillez1999_4-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-cornillez1999-4\">[4]</a></sup><span style=\"font-size: 14px; white-space: normal;\">&nbsp;Spices were bought from India and traded around Europe and Asia. Indian cuisine has influenced other cuisines across the world, especially those from&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Europe\" href=\"https://en.wikipedia.org/wiki/Europe\">Europe</a><span style=\"font-size: 14px; white-space: normal;\">, the&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Middle Eastern cuisine\" href=\"https://en.wikipedia.org/wiki/Middle_Eastern_cuisine\">Middle East</a><span style=\"font-size: 14px; white-space: normal;\">,&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"North African cuisine\" href=\"https://en.wikipedia.org/wiki/North_African_cuisine\">North Africa</a><span style=\"font-size: 14px; white-space: normal;\">,&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"African cuisine\" href=\"https://en.wikipedia.org/wiki/African_cuisine\">sub-Saharan Africa</a><span style=\"font-size: 14px; white-space: normal;\">,&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Southeast Asian cuisine\" href=\"https://en.wikipedia.org/wiki/Southeast_Asian_cuisine\">Southeast Asia</a><span style=\"font-size: 14px; white-space: normal;\">, the&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"British cuisine\" href=\"https://en.wikipedia.org/wiki/British_cuisine\">British Isles</a><span style=\"font-size: 14px; white-space: normal;\">,&nbsp;</span><a class=\"mw-redirect\" style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Fijian cuisine\" href=\"https://en.wikipedia.org/wiki/Fijian_cuisine\">Fiji</a><span style=\"font-size: 14px; white-space: normal;\">, and the&nbsp;</span><a style=\"text-decoration-line: none; color: #0b0080; background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 14px; white-space: normal;\" title=\"Caribbean cuisine\" href=\"https://en.wikipedia.org/wiki/Caribbean_cuisine\">Caribbean</a><span style=\"font-size: 14px; white-space: normal;\">.</span><sup id=\"cite_ref-vegvoyages.com_5-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-vegvoyages.com-5\">[5]</a></sup><sup id=\"cite_ref-6\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-6\">[6]</a></sup></sup></p>\r\n<h3 style=\"background: none #ffffff; margin: 0.3em 0px 0px; overflow: hidden; padding-top: 0.5em; padding-bottom: 0px; border-bottom: 0px; font-size: 1.2em; line-height: 1.6; font-family: sans-serif;\"><span id=\"Foods_Mentioned_in_Ancient_Indian_Scripture\" class=\"mw-headline\">Foods Mentioned in Ancient Indian Scripture</span></h3>\r\n<p style=\"margin: 0.5em 0px; line-height: inherit; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">While many Ancient Indian recipes have been lost one can look at ancient texts to see what was eaten in Ancient and pre historic India.</p>\r\n<p>&nbsp;</p>\r\n<ul style=\"margin: 0.3em 0px 0px 1.6em; padding: 0px; color: #222222; font-family: sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Rice\" href=\"https://en.wikipedia.org/wiki/Rice\">Rice</a>&nbsp;<sup id=\"cite_ref-16\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-16\">[16]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\">Rice Cake&nbsp;<sup id=\"cite_ref-17\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-17\">[17]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Curd\" href=\"https://en.wikipedia.org/wiki/Curd\">Curd</a>&nbsp;<sup id=\"cite_ref-18\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-18\">[18]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Sugar\" href=\"https://en.wikipedia.org/wiki/Sugar\">Sugar</a>&nbsp;<sup id=\"cite_ref-19\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-19\">[19]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Ghee\" href=\"https://en.wikipedia.org/wiki/Ghee\">Ghee</a>&nbsp;<sup id=\"cite_ref-20\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-20\">[20]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Cashew\" href=\"https://en.wikipedia.org/wiki/Cashew\">Cashew</a>&nbsp;nut&nbsp;<sup id=\"cite_ref-21\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-21\">[21]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\">Bread Fruit&nbsp;<sup id=\"cite_ref-22\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-22\">[22]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Pomegranate\" href=\"https://en.wikipedia.org/wiki/Pomegranate\">Pomegranate</a>&nbsp;<sup id=\"cite_ref-23\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-23\">[23]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" title=\"Mango\" href=\"https://en.wikipedia.org/wiki/Mango\">Mango</a>&nbsp;<sup id=\"cite_ref-24\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-24\">[24]</a></sup></li>\r\n<li style=\"margin-bottom: 0.1em;\">Rose Apple&nbsp;<sup id=\"cite_ref-25\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; white-space: nowrap; font-size: 11.2px;\"><a style=\"text-decoration-line: none; color: #0b0080; background: none;\" href=\"https://en.wikipedia.org/wiki/Indian_cuisine#cite_note-25\">[25]</a></sup></li>\r\n</ul>\r\n<p>&nbsp;</p>', 'pav bhaji, pani puri', 0, 'published', 0);

--
-- Triggers `posts`
--
DELIMITER $$
CREATE TRIGGER `before_posts_delete` BEFORE DELETE ON `posts` FOR EACH ROW BEGIN
    INSERT INTO posts_audit
    SET action_performed  = 'Deleted a new post',
    post_author       =  old.post_author;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_posts_insert` BEFORE INSERT ON `posts` FOR EACH ROW BEGIN
    INSERT INTO posts_audit
    SET action_performed  = 'Inserted a new post',
    post_author       =  new.post_author;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `posts_audit`
--

CREATE TABLE `posts_audit` (
  `post_audit_id` int(255) NOT NULL,
  `post_author` int(255) NOT NULL,
  `action_performed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_audit`
--

INSERT INTO `posts_audit` (`post_audit_id`, `post_author`, `action_performed`) VALUES
(1, 14, 'Deleted a new post');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ratings` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`userid`, `username`, `email`, `phone`, `profession`, `image`, `ratings`) VALUES
(18, 'shahvrushali22', 'shahvrushali22@gmail.com', 2147483647, 'Web Developer', 'bg_6.jpg', 10),
(19, 'dikshita', 'dikshipatel@gmail.com', 23456789, 'Android Developer', 'avatar-3.jpg', 8),
(20, 'abc', 'abc@gmail.com', 22134567, 'developer', 'mcqer.jpg', 9),
(21, 'abc', 'abc@gmail.com', 2456789, 'java developer', '', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `image`, `role`, `token`) VALUES
(15, 'vru', '$2y$10$hB/zkelPpT.XmIU8kSJCX.DzjPxJ6tVR.nLPUQHckuGkJKZp5YtNe', 'vru', 'shah', 'shahvrushali@gmail.com', 'IMG_0001.JPG', 'super_admin', ''),
(18, 'shahvrushali22', '$2y$10$uTm4cl4ZeeH04AECFxqTiObGP03aMu7ZjF0Ac62tbEOAipzJSPnnW', 'Vrushali', 'Shah', 'shahvrushali22@gmail.com', 'bg_6.jpg', 'super_admin', ' '),
(19, 'dikshita', '$2y$10$hb/sc2GEaq9JbdX4RAKpcedIc2G9rn.pme2dBLdLbDJBQH6aEmx0y', 'dikshita', 'patel', 'dikshipatel@gmail.com', 'avatar-3.jpg', 'super_admin', ''),
(21, 'abc', '$2y$10$JyVnUms7SjS8sQrXewF1QOps6j1pJRaL63lycWZunB2h0YAJ4nEJW', 'abc', 'shah', 'abc@gmail.com', 'mcqer.jpg', 'admin', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view1`
-- (See below for the actual view)
--
CREATE TABLE `view1` (
`user_id` int(11)
,`username` varchar(255)
,`password` varchar(255)
,`first_name` varchar(255)
,`last_name` varchar(255)
,`email` varchar(255)
,`image` text
,`role` varchar(255)
,`token` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view1`
--
DROP TABLE IF EXISTS `view1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view1`  AS  select `users`.`user_id` AS `user_id`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`image` AS `image`,`users`.`role` AS `role`,`users`.`token` AS `token` from `users` where (`users`.`role` = 'admin') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `comments_audit`
--
ALTER TABLE `comments_audit`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `posts_audit`
--
ALTER TABLE `posts_audit`
  ADD PRIMARY KEY (`post_audit_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments_audit`
--
ALTER TABLE `comments_audit`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts_audit`
--
ALTER TABLE `posts_audit`
  MODIFY `post_audit_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
