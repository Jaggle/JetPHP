<?php /* Smarty version 3.1.27, created on 2015-08-14 03:11:55
         compiled from "D:\server\www\jetstar\views\default\index.html" */ ?>
<?php
/*%%SmartyHeaderCode:267455cd405b801b81_90626008%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '587441d76ae5276508561b7715ae7bfa7c6e6da7' => 
    array (
      0 => 'D:\\server\\www\\jetstar\\views\\default\\index.html',
      1 => 1439514714,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267455cd405b801b81_90626008',
  'variables' => 
  array (
    'TPL_URI' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55cd405b882a24_18671313',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55cd405b882a24_18671313')) {
function content_55cd405b882a24_18671313 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '267455cd405b801b81_90626008';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
css/css.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
css/index.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
css/banner.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
css/quickgate.css">
    	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
css/sideblock.css" />
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
js/jquery.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        
    <?php echo '</script'; ?>
>
</head>
<body>
<div class="head">
    <div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/logo238.png" alt=""></div>
    <div class="searchbar">
        <ul class="searchtype">
            <li style="background: coral;color: white;">老师</li>
            <li>课程</li>
            <li>机构</li>
        </ul>
        <div class="searchform">
           <input type="text" name="s" id="s"  placeholder="搜索你想学的科目，老师试试，例如“吉他”" >
          <input type="button" value="搜索">
        </div>
        <div class="hotsearch">
            <ul>
                <li>钢琴</li>
                <li>声乐</li>
                <li>绘画</li>
                <li>舞蹈</li>
                <li>吉他</li>
                <li>书法</li>
                <li>托福</li>
                <li>语文</li>
                <li>数学</li>
                <li>英语</li>
            </ul>
        </div>
    </div>
    <div class="usercenter">
        <a href="#">会员中心</a> |
        <a href="#">登陆</a> |
        <a href="#">注册</a> |
        <a href="#">帮助我们</a>
    </div>
   <div class="nav">
        <ul>
            <li><a href="#" style="border-left: none;">首页</a></li>
            <li><a href="#">行业新闻</a></li>
            <li><a href="#">热门回答</a></li>
            <li><a href="#">精选资料</a></li>
            <li><a href="#">最新经验</a></li>
            <li><a href="#">专题</a></li>
        </ul>
    </div>
</div>
<!--幻灯片开始-->
<div id="banner">
    <div id="banner_bg"></div>
    <!--标题背景-->
    <div id="banner_info"></div>
    <!--标题-->
    <ul>
        <li class="on" flag="1">当教育互联网+遇上了平台？</li>
        <li flag="2">当教育互联网+遇上了平台？</li>
        <li flag="3">当教育互联网+遇上了平台？</li>
        <li flag="4">当教育互联网+遇上了平台？</li>
    </ul>
    <div id="banner_list">
        <a href="#" target="_blank">
            <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/sample-pic-1000.jpg" title="夜色空凝www.yeskn.com" alt="夜色空凝www.yeskn.com"  width="1230px" height="auto"/>
        </a>
        <a href="#" target="_blank">
            <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/sample-pic-1000.jpg" title="夜色空凝www.yeskn.com" alt="夜色空凝www.yeskn.com"  width="1230px" height="auto"/>
        </a>
        <a href="#" target="_blank">
            <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/sample-pic-1000.jpg" title="夜色空凝www.yeskn.com" alt="夜色空凝www.yeskn.com"  width="1230px" height="auto"/>
        </a>
        <a href="#" target="_blank">
            <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/sample-pic-1000.jpg" title="夜色空凝www.yeskn.com" alt="夜色空凝www.yeskn.com"  width="1230px" height="auto"/>
        </a>
    </div>
</div>
<!--快捷通道开始-->
<div class="quickgate">
    <div class="notice">
        <ul>
            <li><a href="#" >绘画精英在线讲堂</a></li>
            <li><a href="#" >小鲜肉带你背单词</a></li>
            <li><a href="#" >程序员入门必杀技</a></li>
            <li><a href="#" >睡衣脱口秀</a></li>
            <li><a href="#" >绘画精英在线讲堂</a></li>
            <li><a href="#" >绘画精英在线讲堂</a></li>
            <li><a href="#" >绘画精英在线讲堂</a></li>
        </ul>
        <h2>最新公告</h2>
    </div>
    <div class="center-area">
        <div class="center-left">
            <div class="slice hot-qa">
            <h3>热门回答</h3>
            <div class="pic-qa">
                <div class="imgpis">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                    <div>雅思听力的评分标准</div>
                </div>
                <div class="imgpis">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                    <div>雅思听力的评分标准</div>
                </div>
            </div>
            <div class="list">
                <ul>
                    <li><a href="#" >托福和雅思的区别</a></li>
                    <li><a href="#" >雅思和托福哪个难</a></li>
                    <li><a href="#" >雅思和托福哪个难</a></li>
                    <li><a href="#" >雅思和托福哪个难</a></li>
                    <li><a href="#" >雅思和托福哪个难</a></li>
                    
                </ul>
            </div>
        </div>
            <div class="slice new-exp">
            <h3>最新经验</h3>
            <div class="imgpis">
                <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                <div>雅思听力的评分标准</div>
            </div>
            <div class="list">
                <ul>
                    <li><a href="#">托福和雅思的区别</a></li>
                    <li><a href="#">雅思和托福哪个难</a></li>
                    <li><a href="#">雅思和托福哪个难</a></li>
                    <li><a href="#">雅思和托福哪个难</a></li>
                </ul>
            </div>
        </div>
            <div class="slice cos-rank">
            <h3>课程排行</h3>
            <div class="cos-type">
                <span>英语培训</span><span>高中</span><span>小学</span>
            </div>
            <div class="more">更多&gt;&gt;</div>
            <div class="imgpis">
                <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                <div>雅思听力的评分标准</div>
                <div class="cos-price">￥9800</div>

            </div>
            <div class="imgpis">
                <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                <div>雅思听力的评分标准</div>
                <div class="cos-price">￥9800</div>
            </div>
            <div class="imgpis">
                <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                <div>雅思听力的评分标准</div>
                <div class="cos-price">￥9800</div>
            </div>
            <div class="imgpis">
                <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                <div>雅思听力的评分标准</div>
                <div class="cos-price">￥9800</div>
            </div>

        </div>
        </div>
        <div class="slice chs-resource">
            <h3>精选资料</h3>
            <div class="chs-img-list">
                <div class="imgpis">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                    <div>雅思听力的评分标准</div>
                </div>
                <div class="imgpis">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png" alt="">
                    <div>雅思听力的评分标准</div>
                </div>
            </div>
            <div class="list">
                <ul>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                    <li><a href="#">GRE考试真题回忆</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="exam-calender">
        <div class="exam-title">
            <h3>考试日历</h3>
            <a class="next-month-btn"></a>
            <a class="prev-month-btn prev-month-disable"></a>
        </div>
        <div class="month-slider">
            <ul class="month-list">

                <li class="month-item current-month"><i>1</i>月</li>
                <li class="month-item"><i>2</i>月</li>
                <li class="month-item"><i>3</i>月</li>
                <li class="month-item"><i>4</i>月</li>
                <li class="month-item"><i>5</i>月</li>
                <li class="month-item"><i>6</i>月</li>
                <li class="month-item"><i>7</i>月</li>
                <li class="month-item"><i>8</i>月</li>
                <li class="month-item"><i>9</i>月</li>
                <li class="month-item"><i>10</i>月</li>
                <li class="month-item"><i>11</i>月</li>
                <li class="month-item"><i>12</i>月</li>
            </ul>
        </div>
        <div class="exam-viewport">
            <ul class="exam-list">
                <li class="exam-item"><a href="#"><span>托福考试</span><i class="c-text c-text-danger icon-hui">热</i><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>雅思考试</span><i class="c-text c-text-danger icon-hui">热</i><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>注册灰机师考试</span><i class="c-text c-text-danger icon-hui">热</i><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>GMAT</span><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>GMAT</span><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>GMAT</span><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>GMAT</span><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>GMAT</span><span class="exam-time">8月每周一至周五</span></a></li>
                <li class="exam-item"><a href="#"><span>GMAT</span><span class="exam-time">8月每周一至周五</span></a></li>
                
            </ul>
        </div>
    </div>
</div>
<!--热门回答开始-->
<div class="main-area">
<div class="content">
    <h2>热门回答</h2>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <h2>小组热帖</h2>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>
    <div class="q-slice">
        <h3>科学·技术</h3>
        <ol>
            <li class="firstli">
                <div class="">
                    <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/pic-sample-155x90.png " alt=""></a>
                    <div class="title-link"><a href="#">MH370或经历僵尸飞行，什么是僵尸飞行</a></div>
                    <div class="summary">“僵尸飞行”是指本来应有人驾驶的飞机因为某种原因...<a href="#">详细</a></div>
                </div>
            </li>
            <li><i class="dot"></i><a  href="#">光的实质是什么?</a></li>
            <li><i class="dot"></i><a href="#">颜色只是我们大脑的一种幻觉吗？</a></li>
            <li><i class="dot"></i><a href="#">中国油气，矿业公司的评估和勘探开采水平如何？</a></li>
            <li><i class="dot"></i><a href="#">黄金分割法和二分法哪个快？</a></li>
        </ol>
    </div>

</div><!--content end-->
<!--热门回答结束-->
<!--边栏开始-->
	<div class="sidebar">
		<div class="side-block side-resource">
			<h2>精选资料</h2>
			<div class="change">换一换</div>
				<div class="type type1">
					<div class="resource-list">
						<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
					</div>
					<div class="resource-list">
						<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
					</div>
					<div class="resource-list">
						<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
					</div>
				</div>
				<div class="type hide type2">
					<div class="resource-list">
			<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
			<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
			<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
				</div>
				<div class="type hide type3">
					<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
			<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
			<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
				</div>
				<div class="type hide type4">
					<div class="resource-list">
			<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
			<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
			<div class="resource-list">
				<img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/avatar-sample-200x200.jpeg" alt="" />
						<div class="text">
							<div class="title"><a href="#">此处是标题</a></div>
							<div class="summary">此处是摘要，大概有20字左右的摘要</div>
						</div>
			</div>
				</div>
		</div>
		<div class="side-block side-hot">
			<h2>资料热点</h2>
			<ul>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
				<li><a href="#">对于锲而不舍的传教行为，建议封号</a></li>
			</ul>
		</div>
		<div class="side-block side-special">
			<h2>阿拉专区</h2>
			<div class="change">更多专区</div>
			<ul>
				<li><a href="#">做人这件事你知道多少？</a></li>
				<li><a href="#">做人这件事你知道多少？</a></li>
				<li><a href="#">做人这件事你知道多少？</a></li>
				<li><a href="#">做人这件事你知道多少？</a></li>
				<li><a href="#">做人这件事你知道多少？</a></li>
				<li><a href="#">做人这件事你知道多少？</a></li>
				<li><a href="#">做人这件事你知道多少？</a></li>
				
			</ul>
		</div>
		<div class="side-link">
                <a class="weixin" href="javascript:void(0)">微信公众号<span></span></a>
                <a class="weibo" href="http://weibo.com/edskt" target="_blank">关注微博<span></span></a>
                <div class="dimensions-code">
                    <span class="arrow">
                        <i></i>
                    </span>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
images/weixin-code.png">
                </div>
        </div>
	</div><!--边栏结束-->
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['TPL_URI']->value;?>
js/index.js" tyle="text/javascript"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>