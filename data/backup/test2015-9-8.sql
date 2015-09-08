-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-08 11:58:23
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
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) NOT NULL,
  `author` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `publish_time` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'published',
  `summary` varchar(500) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `author`, `title`, `publish_time`, `status`, `summary`, `content`) VALUES
(20, 'admin', '我喜欢这样的天气', '1441641641', 'published', '我喜欢这样的天气', '我喜欢这样的天气'),
(21, 'admin', '我喜欢这样的天气', '1441641776', 'published', '这真的是一篇心得文章', '这真的是一篇心得文章'),
(22, '', '今天是星期二', '1441642628', 'published', '我热爱这样的天气啊', '我热爱这样的天气啊'),
(33, 'admin', '发布新的文章6', '1441698753', 'published', '<div style="text-align: right;"><span style="line-height: 1.5;">发布新的文章6发<u><i><b>布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布', '<div style="text-align: right;"><span style="line-height: 1.5;">发布新的文章6发<u><i><b>布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6发布新的文章6</b></i></u></span></div>'),
(34, 'admin', '发布新的文章8', '1441698904', 'published', '<font face="Comic Sans MS" size="5"><font color="#9fc6e7">发布新的文章8发布新的文章8发布新的文章8发<u><strike><b>布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的</b></strike></u></font><u><strik', '<font face="Comic Sans MS" size="5"><font color="#9fc6e7">发布新的文章8发布新的文章8发布新的文章8发<u><strike><b>布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的</b></strike></u></font><u><strike><b><font color="#b3dc6c">文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章sd<a href="sdssdd">sdssdd</a></font><font color="#9fe1e7">文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8发布新的文章8\n\n								</font></b></strike></u></font><div><font color="#9fc6e7" face="Comic Sans MS" size="5">发布新的文章8<br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5"><br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5">发布新的文章8发布新的文章8发布新的文章8发布新的文章8<br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5"><br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5"><br></font></div><div><font color="#9fc6e7" face="Comic Sans MS" size="5">发布新的文章8发布新的文章8发布新的文章8</font><br></div>'),
(35, 'admin', 'dsd', '1441699060', 'published', 'sdsddsd', 'sdsddsd'),
(36, 'admin', '添加失败！', '1441699060', 'draft', '添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失', '<ul><li><b style="line-height: normal; font-family: Arial; font-size: x-small;"><font color="#b3dc6c">添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！添加失败！</font></b><br></li></ul>'),
(37, 'admin', '', '1441706144', 'published', '这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲', '这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊这真是一个悲伤的故事啊\r\n\r\n								'),
(38, 'admin', '', '1441706278', 'published', '这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想', '这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的这是想你的v');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
