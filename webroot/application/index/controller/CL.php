<?php
namespace app\index\controller;

use freefile\data\User;
use freefile\data\Online;
use think\Controller;
use think\View;

class CL extends Controller
{

    var $online;
 // 在线身份证
    var $user;
 // 用户身份
    var $view;

    var $time_now;
 // 当前时间
    var $data;
 // 模板使用的数据
    public function __construct()
    {
        $this->online = new Online();
        $this->user = new User($this->online->user_id); // 获取用户身份
        $this->view = new View();
        $this->time_now = time();
        $this->data = array(
            'online' => $this->online,
            'user' => $this->user
        );
    }
}