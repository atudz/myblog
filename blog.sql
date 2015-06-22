-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2015 at 08:48 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE IF NOT EXISTS `blog_post` (
  `blog_post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blog_post_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_post_last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_post_body` text NOT NULL,
  `blog_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `blog_post_topic` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`blog_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_archive`
--

CREATE TABLE IF NOT EXISTS `blog_post_archive` (
  `blog_post_archive_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blog_post_archive_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_post_archive_last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_post_archive_tag` varchar(255) NOT NULL DEFAULT '',
  `blog_post_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_post_archive_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_comment`
--

CREATE TABLE IF NOT EXISTS `blog_post_comment` (
  `blog_post_comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blog_post_comment_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_post_comment_last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_post_comment_text` text NOT NULL,
  `blog_post_id` int(11) unsigned NOT NULL DEFAULT '0',
  `blog_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `blog_post_comment_reply_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_post_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_user`
--

CREATE TABLE IF NOT EXISTS `blog_user` (
  `blog_user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_user_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_user_last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_user_firstname` varchar(255) NOT NULL DEFAULT '',
  `blog_user_lastname` varchar(255) NOT NULL DEFAULT '',
  `blog_user_email` varchar(255) NOT NULL DEFAULT '',
  `blog_user_password` varchar(255) NOT NULL DEFAULT '',
  `blog_user_session_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`blog_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE FULLTEXT INDEX idx ON blog_post(blog_post_topic, blog_post_body);
