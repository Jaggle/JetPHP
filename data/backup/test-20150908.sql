-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-08 02:07:27
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) NOT NULL,
  `author` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `publish_time` varchar(50) NOT NULL,
  `summary` varchar(500) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `author`, `title`, `publish_time`, `summary`, `content`) VALUES
(20, 'admin', '我喜欢这样的天气', '1441641641', '我喜欢这样的天气', '我喜欢这样的天气'),
(21, '', '我喜欢这样的天气', '1441641776', '这真的是一篇心得文章', '这真的是一篇心得文章'),
(22, '', '', '1441642628', '我热爱这样的天气啊', '我热爱这样的天气啊'),
(23, '', '', '1441642755', '', '我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！'),
(24, '', '我喜欢彩虹妹！', '1441642817', '', '我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！我喜欢彩虹妹！');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `user` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pswd` varchar(50) CHARACTER SET utf8 NOT NULL,
  `identity` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `user`, `pswd`, `identity`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'cfcd208495d565ef66e7dff9f98764da'),
(3, 'Jake', 'afadfasfasdfasfasdf', 'afasdfasdfasdfsadfasdfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
