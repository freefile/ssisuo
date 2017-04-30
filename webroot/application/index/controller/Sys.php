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
        $this->redirect('Sys/t');
        return "后台主页";
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function t(){
        $file = APP_PATH.request()->module().'/view/header.html';
        $this->user = $this->user->getOne(1);
       // $data['user'] = array();
        $this->user->up('name', 'ff22f');
        $data['user'] = $this->user->getSomes('', '', '');
        return $this->view->fetch($file,$data);
       // return "后台次页";
    }
}
