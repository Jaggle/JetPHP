
// 绑定点击事件
$(document).on('click',".cc-click",HookFunc);
$(document).on('click',".ccc",HookFunc);
// .cce为回车监听事件

// $(document).on('blur',".blur",HookFunc);

// 调用函数
function HookFunc(){
	var tmp = $(this).prop('ccc');
	if ( tmp == 'no') {return;};
	$(this).prop('ccc','no');
	var f = $(this).attr('f'); // 函数名
	var p = $(this).attr('p'); // 参数
	var o = {};
	o.o = $(this);
	o.p = p;
	window[f](o);
	$(this).prop('ccc','');
}

function CO(str){ console.log(str); }

function ccAjax(obj){
	if( !obj.param ){ obj.param = {}; }
	// load_hover();
	if( obj.url.indexOf("?") >= 0 ){
		$.get(obj.url,obj.param,function(data){ ccAjax_info(data,obj); },'json');
	}else{
		$.post(obj.url,obj.param,function(data){ ccAjax_info(data,obj); },'json');
	}
	
}
function ccAjax_info(data,obj){
	if( data.upd_url != 0 ){
		//这里可以是你想给浏览器的一个State对象，为后面的StateEvent做准备。
		var state = {
			title : "Note",
			url : obj.url
		};
		history.pushState(state, "Note", obj.url);
	}

	
	// load_hover_hide();
	if( data.code == 0){ ccalert(data.info); return;}  // 错误
	if( data.code == 2){ clin_login(); return;}           // 未登录
	if( data.code == 'jump'){ location.href = data.info; }  // 跳转
	if( data.code == 'reload'){ location.reload(); return; }  // 跳转
	if( data.code == 'show') { clin_alert(data.info); return; } //直接显示
	if( data.code == 'alert') { ccalert(data.info); return; } //直接显示
	if( obj.func != null){obj.func(data,obj);}
}

function reload(){ location.reload(); }
function ccalert(info){ alert(info); }

// 为指定位置赋值
function SP(str,source,head){
	var aim = str.split(',');
	console.log(aim);
	console.log(source);
	if( !head ){ head = '';}
	for( var i in source){
		if( aim.indexOf(i) <0 ){ continue; }
		var tmp = head+' .'+i;
		$(tmp).val(source[i]);
		// console.log(tmp,i,source[i]);
	}
}
// 指定检查表单是否为空
function GP(str,head){
	var except = str.split(',');
	if( !head ){ head = '';}
	var obj = {};
	for(var i=0; i< except.length; i++){
		var str = head+' .'+except[i];
		// console.log(str);
		var aim = $(str);
		var tmp = $.trim(aim.val());
		if(tmp == ''){
			tmp = $.trim(aim.html());
		}
		if(tmp == ''){
			ccalert(aim.attr('phi')+" -- 不能为空");
			// ccalert(except[i]+' -- '+aim.attr('phi')+" -- 不能为空");
			return -1;
		}
		obj[ except[i] ] = tmp;
	}
	return obj;
}
// flag = 1 allow null
function GP_VAL(str,head,flag){
	var except = str.split(',');
	if( !head ){ head = '';}
	if( !flag ){ flag = 0;}
	var obj = {};
	for(var i=0; i< except.length; i++){
		var str = head+' .'+except[i];
		// console.log(str);
		var aim = $(str);
		var tmp = $.trim(aim.val());
		if(tmp == '' && flag != 1){
			ccalert(except[i]+' -- '+aim.attr('phi')+" -- 不能为空");
			return -1;
		}
		obj[ except[i] ] = tmp;
	}
	return obj;
}

// 自动为指定位置赋值
function set_auto_param(str,source,head){
	var aim = str.split(',');
	if( !head ){ head = '';}
	for( var i in source){
		if( aim.indexOf(i) <0 ){ continue; }
		var tmp = head+' [name='+i+']';
		$(tmp).val(source[i]);
		// console.log(tmp,i,source[i]);
	}
}

// 自动获取带 auto-param 的参数
function get_auto_param(head){
	if( !head){ head=''};
	var obj = {};
	var name = '';
	var value = '';
	var flag = 1;

	$(head + ' .auto-param').each(function(){
		if( flag == -1 ){ return ;}
		name = $(this).attr('name');  // 获取变量
		value = $(this).val();

		if( $(this).attr('type') == 'radio' && $(this).prop('checked') != true ){ return; }
		if( $(this).attr('type') == 'checkbox' && $(this).prop('checked') != true ){ value=''; }

		// an 允许为空
		if( value == '' && !$(this).hasClass('an') ){
			flag = -1;
			clin_alert( $(this).attr('p') +" 不能为空！");
			return;
		}
		obj[name] = value;
	});
	if( flag == -1 ){
		return flag;
	}
	return obj;
}

// 提交表单
function ajax_auto_add(o){
	var tmp = '';
	if ( o.o.attr('aim') ) { tmp = o.o.attr('aim'); }
	var param = get_auto_param(tmp);
	var url = o.o.attr('url');
	if( param == -1 ){ return; }
	var obj = {
		url: url,
		param: param
	}
	// if ( o.o.attr('cb') ) { obj.func = o.o.attr('cb'); }
	if ( o.o.attr('cb') ) { 
		f = o.o.attr('cb');
		obj.func = window[f]; 
	}
	ccAjax(obj);
}

// 加载等待
function load_hover(){
	$('body').append('<div class="hover-div no-select"> <i class="icon-spinner icon-spin"></i> 加载中，请稍等 · · · · </div>');
}

function load_hover_hide(){
	$('.hover-div').remove();
	// $('.hover-div').hide();
}


/********************* 所有信息 begin *********************/
$(document).on('click','.load-hover',load_hover); // 加载信息

/* 导航下拉展示 */
$("ul.info li").hover(function(){
		// $(this).find('ul').slideDown(100);	
		$(this).find('ul').fadeIn();	
	},function(){
		// $(this).find('ul').slideUp(80);	
		$(this).find('ul').hide();	
	});

// 滑动效果切换
function slide(aim,time){
	if( !time ){time = 500;}
	if( aim.css('display') != "block"){ aim.slideDown(time);}
	else{  aim.slideUp(time); }
}
// 渐变显示
function clin_show(aim,info){
	var dt = 600;
	aim.hide();
	aim.html(info);
	aim.fadeIn(dt);
}
function clin_toggle(aim){
	if( $(aim).css('display') == 'block' ){ $(aim).slideUp(); }
	else{ $(aim).slideDown(); }
}


function clin_alert(info,title){
	if( title == '' || title == null){title='Cleey 信息';}
	if( $('#clin_alert').length == 1 ){ $('#clin_alert').remove(); }
	var s='';
	s+='<div class="modal fade clin_alert" id="clin_alert">';
	s+='<div class="modal-dialog">';
	s+='<div class="modal-content">';
	s+='<div class="modal-header">';
	s+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	s+='<h4 class="modal-title" id="myModalLabel">'+title+'</h4>';
	s+='</div>';
	s+='<div class="modal-body">';
	s+= info;
	s+='</div>';
	s+='</div><!-- /.modal-content -->';
	s+='</div><!-- /.modal-dialog -->';
	s+='</div><!-- /.modal -->';
	$('body').append(s);
	$('#clin_alert').modal('show');
}

function clin_login(){
	if( $('#clin_alert').length == 1 ){ $('#clin_login').remove(); }
	var s='';
	s+='<div class="modal fade clin_alert" id="clin_login" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">';
	s+='<div class="modal-dialog">';
	s+='<div class="modal-content">';
	s+='<div class="modal-header">';
	s+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	s+='<h4 class="modal-title" id="myModalLabel"><span class="icon-magnet icon-space"></span> Cleey 欢迎您</h4>';
	s+='</div>';
	s+='<div class="modal-body">';
	s+='你还未登录 <a href="http://www.cleey.com/user/login" class="btn btn-success btn-sm">登录</a> ';
	s+='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	s+='3秒注册 <a href="http://www.cleey.com/user/register"  class="btn btn-primary btn-sm">注册</a> ';
	s+='</div>';
	// s+='<div class="modal-footer">';
	// s+='<button type="button" class="btn btn-primary">登录</button>';
	// s+='</div>';
	s+='</div><!-- /.modal-content -->';
	s+='</div><!-- /.modal-dialog -->';
	s+='</div><!-- /.modal -->';
	$('body').append(s);
	$('#clin_login').modal('show');
}

// 转换为树形结构
function aim2tree_bak(aim,offset){
	if( !offset ){ offset = 19; }
	aim.children().each(function(){
		var inc = 0;
		var pid = $(this).attr('dt-pid');
		var str = '.tree-child[dt-id='+pid+']';

		// 有父ID
		if( aim.children(str).length != 0 ){
			inc = aim.children('.tree-child[dt-id='+pid+']').children('i.indenter').attr('aim');
			inc = Number(inc) + offset;
		}
		$(this).children('i.indenter').attr('aim',inc);
		$(this).children('i.indenter').css('margin-left',inc+'px');
	})
}
function aim2tree(aim,offset){
	if( !offset ){ offset = 19; }
	aim.children().each(function(){
		var inc = 0;
		var pid = $(this).attr('dt-pid');
		var str = '.tree-child[dt-id='+pid+']';

		// 有父ID
		if( aim.children(str).length != 0 ){
			inc = aim.children('.tree-child[dt-id='+pid+']').attr('lvl');
			inc = Number(inc) + 1;
		}
		$(this).attr('lvl',inc);
		$(this).css('margin-left',inc*offset);
	})
}

function select2tree (aim) {
	aim2tree( aim ); // 生成树
	$('#categoryModal .parent option').each(function(){
		var str = '';
		var tmp = Number( $(this).attr('lvl') );
		for(i= 0; i< tmp; i++){
			str += '&nbsp;&nbsp;&nbsp;';
		}
		$(this).prepend(str);
	})
}

/*
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
*/

$(function(){
	$('.cce').bind('keypress',function(event){
	    if(event.keyCode == "13"){
			var tmp = $(this).prop('ccc');
			if ( tmp == 'no') {return;};
			$(this).prop('ccc','no');
			var f = $(this).attr('f'); // 函数名
			var o = {};
			o.o = $(this);
			window[f](o);
			$(this).prop('ccc','');
	    }
	});
})


// 两个时间间隔几天
// 2013-03-02
function  DateDiff(sDate1,  sDate2){    //sDate1和sDate2是2006-12-18格式  
	var  aDate,  oDate1,  oDate2,  iDays  
	aDate  =  sDate1.split("-")  
	oDate1  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])    //转换为12-18-2006格式  
	aDate  =  sDate2.split("-")  
	oDate2  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])  
	iDays  =  parseInt(Math.abs(oDate1  -  oDate2)  /  1000  /  60  /  60  /24)    //把相差的毫秒数转换为天数  
	return  iDays  
}   

// 比较两个时间大小
function dateCompare(date1,date2){
	date1 = date1.replace(/\-/gi,"/");
	date2 = date2.replace(/\-/gi,"/");
	var time1 = new Date(date1).getTime();
	var time2 = new Date(date2).getTime();
	if(time1 > time2){
		return 1;
	}else if(time1 == time2){
		return 2;
	}else{
		return 3;
	}
}

/****************************************** cookie **********************************************/
// 获取所有cookie
function getAllCookie(){
	var allstr = document.cookie;
	return allstr;
}

// 获取指定cookie
function getCookie(c_name){
	if (document.cookie.length>0){
		c_start=document.cookie.indexOf(c_name + "=")
		if (c_start!=-1){ 
			c_start=c_start + c_name.length+1 
			c_end=document.cookie.indexOf(";",c_start)
			if (c_end==-1) c_end=document.cookie.length
			return unescape(document.cookie.substring(c_start,c_end))
		} 
	}
	return ""
}

// 添加cookie
function setCookie(objName,objValue,expiredays){
	var exdate=new Date()
	exdate.setDate(exdate.getDate()+expiredays)
	document.cookie=objName+ "=" +escape(objValue)+ ((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

// 删除cookie
function delCookie(objName){
	var date = new Date(); 
	date.setTime(date.getTime() - 10000); 
	document.cookie = objName + "=a; expires=" + date.toGMTString(); 
}

/****************************************** bootstrap **********************************************/
// bootstrap响应式导航条
;(function($, window, undefined) {
    // outside the scope of the jQuery plugin to
    // keep track of all dropdowns
    var $allDropdowns = $();
    // if instantlyCloseOthers is true, then it will instantly
    // shut other nav items when a new one is hovered over
    $.fn.dropdownHover = function(options) {

        // the element we really care about
        // is the dropdown-toggle's parent
        $allDropdowns = $allDropdowns.add(this.parent());

        return this.each(function() {
            var $this = $(this).parent(),
                defaults = {
                    delay: 300,
                    instantlyCloseOthers: true
                },
                data = {
                    delay: $(this).data('delay'),
                    instantlyCloseOthers: $(this).data('close-others')
                },
                options = $.extend(true, {}, defaults, options, data),
                timeout;

            $this.hover(function() {
                if(options.instantlyCloseOthers === true)
                    $allDropdowns.removeClass('open');

                window.clearTimeout(timeout);
                $(this).addClass('open');
            }, function() {
                timeout = window.setTimeout(function() {
                    $this.removeClass('open');
                }, options.delay);
            });
        });
    };

    $('[data-hover="dropdown"]').dropdownHover();
})(jQuery, this);