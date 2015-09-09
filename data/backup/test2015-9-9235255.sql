-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-09 17:52:51
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
-- 表的结构 `jet_category`
--

CREATE TABLE IF NOT EXISTS `jet_category` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `father` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jet_category`
--

INSERT INTO `jet_category` (`id`, `name`, `type`, `father`) VALUES
(1, '大师之路', 'first', ''),
(2, '前端思想', 'first', ''),
(3, '行业新闻', 'first', ''),
(4, '闲聊之笔', 'first', '');

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
  `category` varchar(20) NOT NULL DEFAULT '闲聊之笔',
  `status` varchar(20) NOT NULL DEFAULT 'published',
  `comment_num` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '19',
  `summary` varchar(500) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jet_post`
--

INSERT INTO `jet_post` (`id`, `author`, `title`, `publish_time`, `category`, `status`, `comment_num`, `views`, `summary`, `content`) VALUES
(41, 'admin', '这里是文章标题', '1441781502', '闲聊之笔', 'published', 0, 409, '这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题\r\n\r\n								', '<font color="#7bd148">这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题这里是文章标题\r\n\r\n								</font>'),
(43, 'admin', '新的文章 ''', '1441786088', '闲聊之笔', 'published', 0, 409, '哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈', '哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说哈哈哈说'),
(46, 'admin', '发生', '1441790923', '闲聊之笔', 'published', 0, 409, '冯绍峰 大方式父安抚 安抚发', '冯绍峰 大方式父安抚 安抚发'),
(47, 'admin', '程序员的激情其实是一种痛苦', '1441809888', '闲聊之笔', 'published', 0, 66, '我不是一个“充满激情的程序员”。我觉得，固定8小时工作之后，就应该去做点别的事情，比如说看看科幻小说，和我亲爱的妻子聊聊天等等。当别人问起，我会正儿八经地这么回答，“这', '<span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">我不是一个“充满激情的程序员”。我觉得，固定8小时工作之后，就应该去做点别的事情，比如说看看科幻小说，和我亲爱的妻子聊聊天等等。当别人问起，我会正儿八经地这么回答，“这才是所谓的生活。你也应该试一试”。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">其实我内心非常看不上那些充满激情的程序员，他们所谓的激情就是一天花上12甚至16个小时坐在电脑前写代码，或者为了写代码而牺牲了自己的爱好、睡眠以及人际交往，有时候甚至连基本的生活自理都无暇顾及。这哪还是激情啊，这分明是一种强迫症。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><div style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; text-align: center; background-color: rgb(247, 247, 247);"><br><div class="ui-wrapper" style="overflow: hidden; position: static; width: 650px; height: 371px; top: auto; left: auto; margin: 0px;"><img src="http://dl2.iteye.com/upload/attachment/0111/5653/f0838541-d56c-3d80-9b70-9ec74a5228b4.jpg" title="点击查看原始大小图片" class="magplus ui-resizable" width="650" height="371" style="cursor: url(http://www.iteye.com/images/magplus.gif), pointer; margin: 0px; resize: none; position: static; zoom: 1; display: block; height: 369px; width: 648px;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div>&nbsp;<br></div><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><strong style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">大男子主义亦或是偏执狂？</strong><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">我们的文化不对劲。如果我们迷恋上一个女子，用类似于在公司工作时孜孜不倦奉献的方式去追求她，会被当成是疯子！&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">然而，这种疯狂放到工作中就成为榜样了，只要能孜孜不倦勤勤恳恳地专注于写代码——哪怕你严重内向甚至有着自闭障碍，也会成为雇主们的最爱。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">更糟糕的是，太多太多的男性程序员因此而心甘情愿地牺牲其他时间，用于写代码，并以此为荣。然后，这种工作至上的潮流驱使高科技领域的女性人员也不得不随波逐流。程序员就像是受虐狂一样，在被揍了之后，乐呵呵地说：“Thank you，sir。我能不能再要一个？”&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">从我的经验来看，真正的问题是，那些将所有醒着的时间全都奉献给工作的程序员尽写一些低劣的代码，害人害己。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><strong style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">技术高手表示要累死了</strong><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">我是从一段惨痛的经历之后才了解了此基本真理。这也是我被一家现已解散的机构——Conduit Internet Technologies解雇的原因。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">每天工作12到14个小时，如果幸运的话，周日的时候才可以休息。突然某一天，管理层发现我们有一项工作没有做好，于是能干的我奉命在第二天早上之前一定要干完它。我不得不熬夜赶工。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">整整一个晚上我都在工作。但是在这个过程中我破坏了一个提供给产品使用的数据库，虽然有自动备份，但是我太累了——一直工作到清晨5点钟，以至于并没有发现这个情况。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">直到当天下午我才意识到我的错误，然后马上开始在家里修复，但是管理层已经切断了远程访问。他们以为我已经彻底搞定了数据库，然后覆盖了。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">……&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">我并没有刻意去抗议，但是他们还是多付了我一个月的薪资，并允许我找到工作后再离开办公室，怎么说呢，这做法明显比他们在这件事的责任认定中要显得宽容得多。不过，话又说回来，对于这份工作，我真的是要累死了，被炒鱿鱼更像是一个解脱。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><strong style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">Passion==痛苦</strong><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">这里有一个小插曲。当雇主告诉你他们看重于开发人员的passion时，其实是在告诫你。听到这个词，那你就马上掉头跑吧，因为后面有老虎在追着咬你。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">很多人并不知道，“passion”这个词是希腊语πάσχειν（paschein）翻译过来的，原意是“忍受痛苦”。其实，这才是工作的实质。但是我们没必要因为一份薪水而承受痛苦，除非你是CEO。否则，你的薪水是不足以支付你需要面对的各种狗屎。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><strong style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">当鼻子遇到磨刀石（埋头苦干）</strong><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">但是，上面我所说的这些都不应该成为工作偷懒的借口。如果你在工作，那就好好工作。干好每天八小时的活，然后立马就走。对得起雇主发的薪水，就成了。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">怎么才算是对得起雇主发的薪水呢？专心，避免一切不必要的分心。进入状态，写出你最好的代码。避免毫无意义的会议。避免干重复的活。将工作中的空余时间用于学习新的技术和设计模式上，提高自己的技巧。就像让程序员失去编程激情的5件事这篇文章中说的那样，不要经常做无用功。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">然后八小时之后，你就可以手机静音，潇洒地离开办公室了。Email、通知和语音邮件通通抛之脑后，等到了第二天的工作时间再继续埋头苦干，但是可千万不要将自己榨干了。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">你可以去做别的事情：喝点小酒、发呆、祈祷、做爱、和孩子嬉戏、遛狗、给喵星人挠肚皮、搞艺术、去搏击俱乐部和陌生人pk、阅读、手淫、做音乐、甚至是跳伞。只要不是写代码就行。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><strong style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">一切都是因为人性</strong><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">你只是个人，不是神仙，所以没有必要舍身忘己榨干自己，为资本家创造财富。你创造的价值越高，他们在支付了你薪资之后所能获得的差额就越多。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">保证每天的休息时间不但可以为第二天的工作提供充沛的精力，而且也是你的权力。所以，该休息时就休息，不要管雇主对你朝九晚五的工作时间的抱怨。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">因为这些雇主是不会顾及你的健康和快乐的。但是健康和快乐才是我们人之所以为人首先应该为自己做的事情。如果你们国家的文化不是这样说的，那就是在骗你，亲。&nbsp;</span><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><br style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);"><span style="color: rgb(0, 0, 0); font-family: Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 25.2000007629395px; background-color: rgb(247, 247, 247);">你在办公室中的所作所为只是一个手段而不是目的。如果你将过程当作了目标，那只会让你忽略生活中最美好的事情。并且，如果你不能得到喘息的机会，只会让你渐渐地讨厌这份工作，乃至厌恶编程。</span>');

-- --------------------------------------------------------

--
-- 表的结构 `jet_user`
--

CREATE TABLE IF NOT EXISTS `jet_user` (
  `id` int(10) NOT NULL,
  `user` varchar(20) CHARACTER SET utf8 NOT NULL,
  `pswd` varchar(50) CHARACTER SET utf8 NOT NULL,
  `identity` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'member',
  `fans` text NOT NULL,
  `fans_num` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `jet_user`
--

INSERT INTO `jet_user` (`id`, `user`, `pswd`, `identity`, `type`, `fans`, `fans_num`) VALUES
(2, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'cfcd208495d565ef66e7dff9f98764da', 'admin', 'admin||jake||nity', 3),
(3, 'Jake', 'afadfasfasdfasfasdf', 'afasdfasdfasdfsadfasdfa', 'member', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jet_category`
--
ALTER TABLE `jet_category`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `jet_category`
--
ALTER TABLE `jet_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jet_comment`
--
ALTER TABLE `jet_comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jet_post`
--
ALTER TABLE `jet_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `jet_user`
--
ALTER TABLE `jet_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
