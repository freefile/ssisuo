<?php
namespace app\index\controller;

use think\Debug;
use think\Request;

class Users extends CL
{

    /**
     * 用户首页
     */
    public function index()
    {
        return $this->view->fetch(Request::instance()->action(), $this->data);
    }

    /**
     * 用户登陆
     */
    public function login()
    {
        $this->data['msg'] = '';
        $time_now = $this->time_now;
        // 判断是否登陆，返回上一页面
        if ($this->online->user_id > 0) {
            $this->error('已经登陆','/index');
        } elseif ($this->online->lock_time >= $time_now) {
            // 未达到解锁时间
            $this->error('为了让账号更安全，请稍等' . ($this->online->lock_time - $time_now) . '秒','/index/users/login');
        }
        // echo $this->online->lock_time . ' - ' . date('Y-m-d H:i:s', $time_now) . ' = ' . (strtotime($this->online->lock_time) - $time_now) . '秒';
        // 如果需要判断用户密码，则进入判断
        if (Request::instance()->isPost() && Request::instance()->has('name') && Request::instance()->has('psd')) {
            $users = $this->user->getSomes('name=\'' . Request::instance()->post('name') . '\' and mdpsd=\'' . md5(Request::instance()->post('psd')) . '\'', '', '');
            if (count($users) < 1) {
                // 没有找到匹配的账户
                $this->online->error_count ++;
                if ($this->online->error_count > 3) {
                    // 重试次数大于3次，登陆间隔时间为30秒
                    $this->online->lock_time = $time_now + 30;
                } else {
                    $this->online->lock_time = $time_now + 3;
                }
                $this->data['msg'] = "用户名或密码错";
                $this->online->upSelf();
            } elseif (count($users) == 1) {
                // 找到唯一账户
                // 查询登陆用户是否已登陆
                $same_onlines = $this->online->getSomes('user_id = ' . $users[0]->id, '', '');
                if (count($same_onlines) > 0) {
                    // 有超过1人已经登陆
                    foreach ($same_onlines as $online) {
                        // 超过半小时未登陆
                        if ($time_now - strtotime($online->last_link_time) < 1800) {
                            // 给半小时以内登陆的online对象发送消息
                            $online->msg = "IP{$online->ip1}.{$online->ip2}.{$online->ip3}.{$online->ip4}使用本账户登陆，导致本机退出登陆。对方信息：{$_SERVER['HTTP_USER_AGENT']}";
                        }
                        $online->user_id = 0;
                        $online->upSelf();
                    }
                }
                // TODO
                $this->online->user_id = $users[0]->id;
                $this->online->error_count = 0;
                $this->online->lock_time = 0;
                $this->online->upSelf();
                $this->success('登陆成功', '/index/sys/index');
            } else {
                // 找到多个账户
                // TODO
                $this->data['msg'] = "系统出错";
                $this->online->upSelf();
            }
            // $this->online->upSelf();
        }
        return $this->view->fetch(Request::instance()->action(), $this->data);
    }

    public function logout()
    {
        $this->online->upOne('user_id', 0);
        $this->error('注销成功','/index');
    }

    /**
     * 添加用户
     */
    public function addUser()
    {
        if (! Request::instance()->isPost()) {
            // abort(404, '/index/users/addUser->请求非法');
        }
        $input = array();
        $input['name'] = '用户名';
        $input['psd'] = '密码';
        $input['limit_level'] = '权限';
        $input['group_name'] = '群组';
        $check_msg = '';
        if (Request::instance()->isPost()) {
            // abort(404, '/index/users/addUser->请求非法');
            $input['name'] = Request::instance()->post('name');
            $input['psd'] = Request::instance()->post('psd');
            $input['limit_level'] = Request::instance()->post('limit_level');
            $input['group_name'] = Request::instance()->post('group_name');
            $this->data['input'] = $input;
            if (! $this->user->rule($input, $check_msg)) {
                // 检查内容
                $this->data['check_msg'] = $check_msg;
                Debug::dump($this->data['check_msg']);
                return $this->view->fetch(Request::instance()->action(), $this->data);
            } elseif (count($this->user->getSomes('name=\'' . $input['name'] . '\'', '', '')) > 0) {
                // 检查是否有重名
                $this->data['check_msg'] = '有重名';
                return $this->view->fetch(Request::instance()->action(), $this->data);
            } else {
                // 通过检查
                $user = clone $this->user;
                $user->id = '';
                $user->name = $input['name'];
                $user->mdpsd = md5($input['psd']);
                $user->limit_level = intval($input['limit_level']);
                $user->group_name = $input['group_name'];
                $user->member_id = 0;
                $user->customer_id = 0;
                $user->head_icon = '[1]';
                $this->user->add($user);
                $this->success('添加成功', '/index/users/index');
            }
        } else {
            $this->data['input'] = $input;
            $this->data['check_msg'] = $check_msg;
            Debug::dump($this->data['check_msg']);
            return $this->view->fetch(Request::instance()->action(), $this->data);
        }
    }

    /**
     * 删除用户
     */
    public function delUser()
    {
        if (Request::instance()->isPost() && Request::instance()->has('del_user_ids')) {
            $del_user_ids = $_POST['del_user_ids'];
            foreach ($del_user_ids as $id) {
                if($id != $this->online->user_id){
                    $this->user->del($id);
                }
            }
            $this->success('操作成功', 'index/users/index');
        } else {
            $this->data['users'] = $this->user->getSomes('', '', '');
            $this->data['check_msg'] = '';
            return $this->view->fetch(Request::instance()->action(), $this->data);
        }
    }
}
