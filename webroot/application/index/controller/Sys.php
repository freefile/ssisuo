<?php
namespace app\index\controller;
use think\Url;
use freefile\data\User;
use think\Controller;
use think\View;
class Sys extends Controller
{
    var $user; //用户身份
    var $view;
    public function __construct(){
        $this->user = new User(); //获取用户身份
        $this->view = new View();
    }
    public function index()
    {
        //$this->redirect('Sys/t');
        return "后台主页";
    }
    public function t(){
        $this->user = $this->user->getOne(1);
        $data['user'] = $this->user->getSomes('', '', '');
        return $this->view->fetch('header',$data);
       // return "后台次页";
    }
}
