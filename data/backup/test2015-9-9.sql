-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-09 11:57:24
-- 服务器版本： 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `jet_comment`
--

CREATE TABLE IF NOT EXISTS `jet_comment` (
  `id` int(10) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8 NOT NULL,
  `author` varchar(20) CHARACTER SET utf8 NOT NULL,
  `publish_time` varchar(20) CHARACTER SET utf8 NOT NULL,
  `attach` int(5) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `jet_comment`
--

INSERT INTO `jet_comment` (`id`, `content`, `author`, `publish_time`, `attach`, `status`) VALUES
(1, '这是一条评论', 'Jake', '2015/9/9', 34, 'pending'),
(2, '这是一条评论颠三倒四', 'Jake', '2015/9/9', 34, 'pending'),
(3, '这是一条评论颠三倒四', 'Jakd', '2015/9/9', 34, 'pending');

-- --------------------------------------------------------

--
-- 表的结构 `jet_post`
--

CREATE TABLE IF NOT EXISTS `jet_post` (
  `id` int(10) NOT NULL,
  `author` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `publish_time` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'published',
  `summary` varchar(500) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jet_post`
--

INSERT INTO `jet_post` (`id`, `author`, `title`, `publish_time`, `status`, `summary`, `content`) VALUES
(34, 'admin', '发布新的文章8', '1441698904', 'published', '<font face="Comic Sans MS" size="5"><font color="#9fc6e7">发布新的文章8发布新的文章8发布新的文章8发<u><strike><b>布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的</b></strike></u></font><u><strik', '<font face="Comic Sans MS" size="5"><font color="#9fc6e7">发布新的文章8发布新的文章8发布新的文章8发<u><strike><b>布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的</b></strike></u></font><u><strike><b><font color="#b3dc6c">文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章sd<a href="sdssdd">sdssdd</a></font><font color="#9fe1e7">文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8\n\n								</font></b></strike></u></font><div><font color="#9fc6e7" face="Comic Sans MS" size="5">发布新的文章8<br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5"><br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5">发布新的文章8发布新的文章8发布新的文章8发布新的文章8<br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5"><br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5"><br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5">发布新的文章8发布新的文章8发布新的文章8</font><br></div>'),
(41, 'admin', '这里是文章标题', '1441781502', 'published', '这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题\r\n\r\n								', '<font color="#7bd148">这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题\r\n\r\n								</font>'),
(43, 'admin', '新的文章 ''', '1441786088', 'published', '哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈', '哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说'),
(46, 'admin', '发生', '1441790923', 'published', '冯绍峰 大方式父安抚 安抚发', '冯绍峰 大方式父安抚 安抚发');

-- --------------------------------------------------------

--
-- 表的结构 `jet_user`
--

CREATE TABLE IF NOT EXISTS `jet_user` (
  `id` int(10) NOT NULL,
  `user` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pswd` varchar(50) CHARACTER SET utf8 NOT NULL,
  `identity` varchar(50) NOT NULL,
  `fans` text NOT NULL,
  `fans_num` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `jet_user`
--

INSERT INTO `jet_user` (`id`, `user`, `pswd`, `identity`, `fans`, `fans_num`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'cfcd208495d565ef66e7dff9f98764da', 'admin||jake||nity', 3),
(3, 'Jake', 'afadfasfasdfasfasdf', 'afasdfasdfasdfsadfasdfa', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jet_comment`
--
ALTER TABLE `jet_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jet_post`
--
ALTER TABLE `jet_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jet_user`
--
ALTER TABLE `jet_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jet_comment`
--
ALTER TABLE `jet_comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jet_post`
--
ALTER TABLE `jet_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `jet_user`
--
ALTER TABLE `jet_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
