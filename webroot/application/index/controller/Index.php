<?php
namespace app\index\controller;
use think\Request;
class Index extends CL
{
    public function index()
    {
        $this->data['users'] = $this->user->getSomes('', '', '');
        return $this->view->fetch(Request::instance()->action(), $this->data);
    }
}
