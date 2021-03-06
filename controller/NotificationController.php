<?php

namespace Jet\Controller;
use Jet\Core\Controller;

class NotificationController extends Controller
{

    function __call($name, $args)
    {
        jet_log('尝试访问NotificationController的不存在的方法'.$name);
    }

    /**
     * 通过id设置消息为已读
     * 这个方法用于ajax请求
     */
    public function setread()
    {
        $id = jet_Post('id');
        if(!empty($id)){
            $flag = $this->model('notification')->where($id)->setField('is_read',1);
            if($flag){
                echo jet_JSON(array('message' => '设置已读成功!','has' => 1));

                return;
            }
            else
            {
                echo jet_JSON(array('message' => '设置已读失败!','has' => 0));
                return;
            }
        }


    }

    /**
     * 抓取新的消息
     */
    public function get()
    {

    }
}