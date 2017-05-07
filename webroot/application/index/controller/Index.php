<?php
namespace app\index\controller;
use think\Request;
class Index extends CL
{
    public function index()
    {
        $this->data['isMobile'] = 'PC登陆';
        if(Request::instance()->isMobile()){
            $this->data['isMobile'] = '手机登陆';
        }
        $this->data['users'] = $this->user->getSomes('', '', '');
        return $this->view->fetch(Request::instance()->action(), $this->data);
    }
}
