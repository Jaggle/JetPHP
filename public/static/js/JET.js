var JET =
{
    logout : function(){
        $.ajax({
            type    : 'post',
            'url'   : '/account/logout?r=ajax',
            success : function(data){
                data = $.parseJSON(data);
                if(data.has){
                    window.location.href='/';
                }else{
                    alert("�˳�ʧ��");
                    window.location.reload();
                }
            },
            error   : function(){
                    alert('������ʧ��');
            }

        })
    }
};