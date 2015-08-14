/**
 * Created by Jake on 2015/8/11.
 */

$(function(){
    $(".searchtype li").click(function(){
        $(this).css('background','coral').siblings().css('background','white');
        $(this).css('color','white').siblings().css('color','coral');
    });
    $(".hotsearch ul li").click(function(){

      $("#s").val($(this).html());
    });
    
    var t = n = 0, count;


        $(document).ready(function(){
            //获取图片的数量
            count=$("#banner_list a").length;
            //隐藏除了第一张图片的其他图片
            $("#banner_list a:not(:first-child)").hide();

            //打开图片a标签所带的链接
            $("#banner_info").click(function(){window.open($("#banner_list a:first-child").attr('href'), "_blank")});
            //给li标签添加click事件
            $("#banner li").click(function() {
                //当前li中的数字-1
                var i = $(this).attr("flag") - 1;//获取Li元素内的值，即1，2，3，4
                //赋值i给n
                n = i;
                //if语句为假，则不执行return语句。
                if (i >= count) return;
                //$("#banner_info").html($("#banner_list a").eq(i).find("img").attr('alt'));
                $("#banner_info").unbind().click(function(){window.open($("#banner_list a").eq(i).attr('href'), "_blank")})
                $("#banner_list a").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
                document.getElementById("banner").style.background="";
                $(this).addClass("on");
                //$(this).toggleClass("on");
                $(this).siblings().removeAttr("class");
            });
            t = setInterval("showAuto()", 4000);
            $("#banner").hover(function(){clearInterval(t)}, function(){t = setInterval("showAuto()", 4000);});
        })

        function showAuto()
        {
            n = n >=(count - 1) ? 0 : ++n;
            $("#banner li").eq(n).trigger('click');
        }
})