<?php
namespace app\index\controller;

use freefile\data\User;
use freefile\data\Online;
use think\Controller;
use think\View;
use freefile\data\Member;
use freefile\data\Customer;

class CL extends Controller
{
    // 在线身份证
    var $online;
    // 用户身份
    var $user;
    //成员身份
    var $member;
    //顾客身份
    var $customer;

    var $view;
    var $time_now;
 // 当前时间
    var $data;
 // 模板使用的数据
    public function __construct()
    {
        $this->online = new Online();
        $this->user = new User($this->online->user_id); // 获取用户身份
        $this->member = new Member($this->user->member_id);//获取成员身份
        $this->customer = new Customer($this->user->customer_id);//获取顾客身份
        $this->view = new View();
        $this->time_now = time();
        $this->data = array(
            'online' => $this->online,
            'user' => $this->user
        );
    }
}