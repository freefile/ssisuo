<?php
namespace app\index\controller;
use freefile\data\User;
use freefile\data\Online;
use think\Controller;
use think\View;
class CL extends Controller{
    var $online;//在线身份证
    var $user; //用户身份
    var $view;
    public function __construct(){
        $this->online = new Online();
        $this->user = new User(); //获取用户身份
        $this->view = new View();
    }
}