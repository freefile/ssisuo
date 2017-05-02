<?php
namespace app\index\controller;
class Sys extends CL
{

    public function index()
    {
        return "后台主页";
    }
    public function t(){
        $this->user = $this->user->getOne(1);
        $data['user'] = $this->user->getSomes('', '', '');
        $data['user_name'] = $this->online->user_id;
        return $this->view->fetch('header',$data);
       // return "后台次页";
    }
}
