/********************* 所有信息 begin *********************/

$(document).on('click','.remove_tag',remove_tag);  // 移除标签

$(document).on('click','.ajax-follow-add',follow_add)  // 关注

$(document).on('click','.ajax-follow-del',follow_del)	// 取消关注
  
$(document).on('click','.u-profile .sel-sex .btn',sel_sex)  // 选择性别时的动作

$(document).on('click','.ajax_collect',collect);  // 收藏文章操作

$(document).on('click','.edit-comm',toggle_comment);  // 收藏文章操作

$(document).on('click','.cs-sidebar li a',cs_item_click);  // 列表文章查看

/********************* 所有信息 end *********************/


$(window).load(function(){
	// google code 高亮
	if( $("pre").length > 0 ){
    	$("pre").addClass("prettyprint");
    	prettyPrint();
	}
    
    // 为链接添加target="_blank"
    addLinkTarget();
})

// 监听滚动条
$(window).scroll(function(){
	var s_top = Number($(this).scrollTop());  // 获取滚动条，滚动刻度
	// clin_left_affix(s_top); // 右侧菜单栏
	goto_top(s_top); // 顶部菜单栏
})
// 显示top图标
function goto_top(data){
	var aim = $('#goto-top');
	if(data >= 200 ){ aim.slideDown(500); }
	else{ aim.slideUp(500); }
}
// goto top
$("a#goto-top").click(function(){
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
})
// 为链接添加target="_blank"
function addLinkTarget(){
	$('.single-content a').each(function(){
		$(this).attr('target','_blank');
	});
}

/*************  撰写文章  **************/
// 回车监听事件
$('.write-tag #post_tag').bind('keypress',function(event){
    if(event.keyCode == "13"){ add_tag(); }
});

// 添加标签
function add_tag(){
	var str = $.trim($('#post_tag').val());

	if(str == ''){return;}
	str = str.split(',');
	for(var i in str){
		var tmp = '<span class="post-tag"><i>'+str[i]+'</i> <a class="remove_tag"><i class="fa fa-remove"></i></a></span>'
		$('#post_tags').append(tmp);
	}
	$('#post_tag').val('');
	document.getElementById('post_tag').focus();
}
// 移除标签
function remove_tag(){ $(this).parent().remove(); }
// 获取标签
function write_return_tag(){
	var str = '';
	$('#post_tags').children('span').each(function(){
		str += $(this).children('i').html() + ',';
	})
	return str;
}
// 分享文章
function ajax_write(){
	var param = get_auto_param();
	if( param == -1 ){ return; }
	var str = write_return_classify();
	if( str == ''){ clin_alert('请选择<i class="e-hl">分类目录</i>'); return; }

	param.child_id = str;
	param.tags = write_return_tag();
	var obj = {
		url   : '/blog/ajax_write',
		param : param
	}
	ccAjax(obj);
}
// 重写文章
function ajax_rewrite(){
	var param = get_auto_param();
	if( param == -1 ){ return; }
	var str = write_return_classify();
	if( str == ''){ clin_alert('请选择<i class="e-hl">分类目录</i>'); return; }

	param.child_id = str;
	param.tags = write_return_tag();
	var obj = {
		url   : '/blog/ajax_rewrite',
		param : param
	}
	ccAjax(obj);
}
// 获取选择分类
function write_return_classify(){
	var str = '';
	$('.blog-write-classify li input').each(function(){
		if( $(this).prop('checked') == true ){ str += $(this).attr('aim') +','; }
	})
	return str;
}
// 点击样式
$(document).on('click','.write-items .item',function(){
	var type = $(this).attr('role');
})

function item_info(aim,str,href){
	var info = new Array();
	info['a'] = '<a>%s</a>';
	info['b'] = '<strong>%s</strong>';
	info['c'] = '<p style="text-align:center">%s</p>';
	info['i'] = '<em>%s</em>';
	info['l'] = '<p style="text-align:left">%s</p>';
	info['p'] = '<img alt="%s" src="%h">';
	info['q'] = '<blockquote>%s</blockquote>';
	info['r'] = '<p style="text-align:right">%s</p>';
	info['['] = '<pre>%s</pre>';
	var re = info[aim].replace(/%s/g,str);
	re = info[aim].replace(/%h/g,href);
	return re;
}

// 删除文章
function ajax_del_blog(o){
	var obj  = {};
	obj.url  = '/blog/ajax_del_blog';
	obj.param= {'id': o.o.attr('aim') };
	ccAjax(obj);
}

/******************* 用户登录 ********************/
function ajax_get_login(){
	// 已请求登录
	if( $('.login-modal').length > 0 ){
		$('.login-modal').modal('show');
	}else{
		var obj = {
			url: '/user/ajax_get_login',
			func: ajax_get_login_info
		}
		ccAjax(obj);
	}
}
function ajax_get_login_info(data){
	$('body').append(data.info);
	$('.login-modal').modal('show');
}

function login_do(){
	
	var email = $.trim( $('#email').val() );
	var pass  = $.trim(  $('#pass').val() );
	var verify  = $.trim(  $('#verify').val() );
	if( email == '' ){ $('.login-center .info').html( '<i class="icon-remove"></i> 请填写邮箱'); return; }
	if( pass  == '' ){ $('.login-center .info').html( '<i class="icon-remove"></i> 请填写密码'); return; }
	if( verify  == '' ){ $('.login-center .info').html( '<i class="icon-remove"></i> 请填写验证码'); return; }
	remember  = $.trim(  $('#remember').val() );

	var obj  = {};
	obj.url  = '/user/ajax_login_do';
	obj.param= {'email':email,'pass':pass,'verify':verify,'remember':remember};
	obj.func = login_do_info;

	ccAjax(obj);
	
}
function login_do_info(data,obj){
	if( data.code == '1'){location.assign(data.info);}
	else{ $('.login-center .info').html( '<i class="icon-remove"></i>'+data.info); }
}

/******************* 用户注册 ********************/
function register_do(){
	
	var nice = $('#nice').val();
	var email = $('#email').val();
	var pass = $('#pass').val();
	if( nice  == '' ){ $('.login-center .info').html( '<i class="icon-remove"></i> 请填写昵称'); return; }
	if( email == '' ){ $('.login-center .info').html( '<i class="icon-remove"></i> 请填写邮箱'); return; }
	if( pass  == '' ){ $('.login-center .info').html( '<i class="icon-remove"></i> 请填写密码'); return; }


	var obj  = {};
	obj.url  = '/user/ajax_register_do';
	obj.param= {'email':email,'pass':pass,'nice':nice};
	obj.func = register_do_info;

	ccAjax(obj);
	
}
function register_do_info(data,obj){
	if( data.code == '1'){location.assign(data.info);}
	else{ $('.login-center .info').html( '<i class="icon-remove"></i>'+data.info); }
}


/******************* 用户关注管理 ********************/
// 关注
function follow_add(){
	var tid  = $(this).attr('tid');
	var obj  = {};
	obj.aim = $(this);
	obj.url  = '/user/ajax_follow_add';
	obj.param= {'tid':tid};
	obj.func = follow_info;
	ccAjax(obj);
}

// 取消关注
function follow_del(){
	var tid  = $(this).attr('tid');
	var obj  = {};
	obj.aim = $(this);
	obj.url  = '/user/ajax_follow_del';
	obj.param= {'tid':tid};
	obj.func = follow_info;
	ccAjax(obj);
}

function follow_info(data,obj){
	clin_alert(data.info);
	follow_change(obj.aim,obj.param.tid);
}

function follow_change(aim,tid){
	var str = aim.hasClass('ajax-follow-add');
	var html = '';
	if( str){html = '<a class="btn btn-xs btn-default ajax-follow-del" tid="'+tid+'"><span class="icon-check"></span> 取消关注</a>';}
	else{html = '<a class="btn btn-success btn-xs ajax-follow-add" tid="'+tid+'"><span class="icon-check"></span> 关注</a>';}
	aim = aim.parent();
	aim.html(html);
}

/********************用户个人信息修改*********************/ 

// 选择性别时的动作
function sel_sex(){
	$('.u-profile .sel-sex .active').removeClass('active');
	$(this).addClass('active');
	$('.u-profile #tsex').val($(this).attr('v'));
}

// 更新个人信息
function update_info(){
	var param = GP('tname,tdesc,tsex','#home');
	param.id = GP('id');
	param.user_img = $('#home .user_img').attr('src');
	param.tbirthday = GP_VAL('tbirthday','#home',1);
	if( param == -1){return;}
	var obj  = {};
	obj.url  = '/user/ajax_update_info';
	obj.param= param;
	ccAjax(obj);
}

// 更新密码
function update_pwd(){
	var icpwd = $('.u-body .u-safe .icpwd').val();
	var inpwd = $('.u-body .u-safe .inpwd').val();
	var irpwd = $('.u-body .u-safe .irpwd').val();
	var id = GP('id');

	if( icpwd == '' ){ clin_alert('<span class="e-hl">当前密码</span>不能为空'); return;}
	if( inpwd == '' ){ clin_alert('<span class="e-hl">新密码</span>不能为空'); return;}
	if( inpwd != irpwd ){ clin_alert('<span class="e-hl">新密码</span>和<span class="e-hl">再次输入</span>不一致'); return;}

	var obj  = {};
	obj.url  = '/user/ajax_update_pwd';
	obj.param= {'icpwd':icpwd,'inpwd':inpwd,'id':id};
	ccAjax(obj);
	$('.u-body .u-safe .icpwd').val('');
	$('.u-body .u-safe .inpwd').val('');
	$('.u-body .u-safe .irpwd').val('');
}


// 更新邮箱
function update_email(){
	var cemail = $('.u-body .u-email .cemail').val();
	if( cemail == '' ){ clin_alert('<span class="e-hl">邮箱</span>不能为空'); return;}
	var id = GP('id');
	var obj  = {};
	obj.url  = '/user/ajax_update_email';
	obj.param= {'cemail':cemail,'id':id};
	ccAjax(obj);
}

// 收藏文章
function collect(){
	var pid = $(this).attr('aim');
	var obj = {};
	obj.param = {pid:pid};
	obj.url   = '/blog/ajax_collect';
	obj.func  = collect_info;
	ccAjax(obj);
}
function collect_info(data){
	$('.ajax_collect').addClass('disabled');
	var aim = $('.ajax_collect').children('span:last-child'); //数量改变
	var num = Number(aim.html());
	aim.html( num+1 );
	$('.ajax_collect').removeClass('.ajax_collect');
}

// 取消收藏文章
function ajax_cancel_collect(o){
	var pid = o.o.attr('aim');
	// CO(pid);return;
	var obj = {
		url   : '/blog/ajax_cancel_collect',
		param : {pid:pid}
	};
	ccAjax(obj);
}

// 显示或隐藏评论框
function toggle_comment(){
	var id = $(this).attr('aim');
	slide($('#comment-'+id+" .cm"));
}

// 评论文章
function ajax_add_comment(o){

	var aim = o.o;
	var pid = $('#post_pid').val();
	var par = aim.attr('par');
	var comm = aim.next().val();

	if( comm == "" ){ clin_alert('<span class="e-hl">评论</span>不能为空'); return; }
	var obj = {};
	obj.param = {'pid':pid,'comm':comm,'par':par};
	obj.url   = '/blog/ajax_add_comment';
	// obj.func  = ajax_add_comment_info;
	ccAjax(obj);
}


// 列表文章查看
function cs_item_click(){
	$('.cs-sidebar li.active').removeClass('active');
	$(this).parent().addClass('active');

	var obj = {};
	obj.param = {'id': $(this).attr('aim') };
	obj.url   = '/book/ajax_single';
	obj.func  = ajax_single_info;
	ccAjax(obj);
}
function ajax_single_info(data){
	$('.cs-content').html(data.info);
}

// 添加分类
function ajax_add_category(){
        var param = get_auto_param('#categoryModal');
        if( param == -1 ){ return; }
        var obj = {
                url   : '/book/ajax_add_category',
                param : param,
                func : ajax_add_category_more
        }
        ccAjax(obj);
}
function ajax_add_category_more(data){
        reload();
}

// 添加分类
function ajax_write_add_category(){
	var param = get_auto_param('.group-classify-add');
	if( param == -1 ){ return; }
	var obj = {
		url   : '/book/ajax_write_add_category',
		param : param,
		func : ajax_add_category_info
	}
	ccAjax(obj);
}
function ajax_add_category_info(data){
	var html = "";
	html += '<li class="tree-child">';
	html += '<i class="indenter"></i> ';
	html += '<label><input type="checkbox" aim="'+data.info+'" checked>'+data.more+'</label>';
	html += '</li>';
	$('.blog-write-classify').prepend(html);
}

// 修改分类
function classify_upd_modal(o){
	var id = o.o.attr('aim');
	var obj = {
		url   : '/book/ajax_get_category',
		param : {id:id},
		func : ajax_get_category_info
	}
	ccAjax(obj);
}
function ajax_get_category_info(data){
	data = data.info;
	
	set_auto_param('id,name,desc,img',data,'#categoryUpdModal');
	$('#categoryUpdModal .book-img-id').attr('src','/Public/image/book/'+data.img);
	$('#categoryUpdModal .parent option[dt-id='+data.parent+']').attr('selected','true');
	CO( $('#categoryUpdModal option[dt-id='+data.parent+']') );
	$('#categoryUpdModal').modal('show');
}

function ajax_upd_category(){
	var param = get_auto_param('#categoryUpdModal');
	if( param == -1 ){ return; }
	var obj = {
		url   : '/book/ajax_upd_category',
		param : param
	}
	ccAjax(obj);
}

function ajax_add_classify(){
	var param = get_auto_param('.group-classify-add');
	if( param == -1 ){ return; }
	var obj = {
		url   : '/book/ajax_upd_category',
		param : param
	}
	ccAjax(obj);
}

// 用户切换
// 展示用户切换框
function show_change_user(){
	var obj = {
		url   : '/user/ajax_show_change_user',
		func : show_change_user_info
	}
	ccAjax(obj);
}
function show_change_user_info(data){
	$('body').append(data.info);
	$('#tmpModal').modal('show');
}

// 用户切换操作
function ajax_change_user(o){
	var id = o.o.attr('aim');
	var obj = {
		url   : '/user/ajax_change_user',
		param : {id:id}
	}
	ccAjax(obj);
}