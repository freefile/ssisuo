<?php
namespace app\index\controller;

use think\Request;

class Sys extends CL
{

    public function index()
    {
        $this->data['users'] = $this->user->getSomes('', '', '');
        return $this->view->fetch(Request::instance()->action(), $this->data);
    }

    public function test()
    {        
        // $this->user = $this->user->getOne(1);
        $this->data['users'] = $this->user->getSomes('', '', '');
        return $this->view->fetch(Request::instance()->action(), $this->data);
        // return "后台次页";
    }
}
