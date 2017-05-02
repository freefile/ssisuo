<?php
namespace app\index\controller;
use think\Request;

class User extends CL
{

    public function index()
    {
        $this->redirect('user/login');
    }

    public function login()
    {
        $user = $this->user->getSomes('name=\''.Request::instance()->get('name').'\' and mdpsd=\''.md5(Request::instance()->get('psd')).'\'','','');
        if(count($user) < 1){
            //没有找到匹配的账户
            //TODO
            echo "用户名或密码错";  
            
        }elseif(count($user) == 1){
            //找到唯一账户
            //TODO
            $this->online->user_id = $user[0]->id;
            $this->online->upOne('user_id', $user[0]->id);
            $this->success('登陆成功', '/index/sys/index');
        }else{
            //找到多个账户
            //TODO
        }
        return $this->view->fetch('login');
    }
}
