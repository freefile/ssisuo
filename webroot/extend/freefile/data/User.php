<?php
namespace freefile\data;//位置
use think\Validate; //验证
use think\Debug;//调试
/**
 * 登陆账户数据表
 *
 * @author Administrator
 *        
 */
class User extends G
{
    // 编号id,int,PRIMARY,A_I
    var $id;
    // 用户名name,varchar(32),utf8,index
    var $name;
    // MD5密码mdpsd,char(33),utf8,index
    var $mdpsd;
    // 最后登录时间last_login_time,datetime
    var $last_login_time;
    // 权限等级limit_level,smallint
    var $limit_level;
    // 群组group_name,varchar(32),utf8
    var $group_name;
    // 员工编号member_id,int
    var $member_id;
    // 顾客编号customer_id,int
    var $customer_id;
    // 头像head_icon，varchar(255)
    var $head_icon;

    function __construct($id = null)
    {
        $this->class_name = 'User';
        $this->table_name = 'ssi_user';
        $this->id_name = 'id';
        $this->id = 0;
        $this->name = '游客';
        $this->limit_level = 0;
        $this->group_name = '';
        $this->member_id = 0;
        $this->customer_id = 0;
        $this->head_icon = '[0]';
        if ($id != null) {
            if (intval($id) > 0) {
                $user = $this->getOne($id);
                if ($user == null) {
                    abort(404, 'User->construct参数值$id错：' . $id . '<br />');
                } else {
                    $this->arrayToObj(json_decode(json_encode($user), true), 0);
                }
            }
        }
    }

    protected function arrayToObj($array_, $is_new_obj_)
    {
        $obj = $is_new_obj_ != 0 ? clone $this : $this;
        $obj->id = intval($array_['id']);
        $obj->name = $array_['name'];
        //$obj->mdpsd = $array_['mdpsd'];
        $obj->last_login_time = $array_['last_login_time'];
        $obj->limit_level = intval($array_['limit_level']);
        $obj->group_name = $array_['group_name'];
        $obj->member_id = intval($array_['member_id']);
        $obj->customer_id = intval($array_['customer_id']);
        $obj->head_icon = $array_['head_icon'];
        return $obj;
    }
    public function rule($data_,&$result_msg_){
        $rule = [
            'name'  => 'require|min:4|max:32',
            'psd' =>'require|min:6|max:32',
            'limit_level'   => 'number|between:0,15',
            'group_name' => 'require|max:32',
        ];
        
        $msg = [
            'name.require' => '名称必须',
            'name.max'     => '名称最多不能超过32个字符',
            'name.min' => '名称最短4个字符',
            'psd.require' => '密码必须',
            'psd.min' => '密码最短6个字符',
            'psd.max'     => '密码最多不能超过32个字符',
            'limit_level.number'   => '权限必须是数字',
            'limit_level.between'  => '权限只能在0-15之间',
            'group_name.require'        => '群组必须',
            'group_name.max'     => '群组最多不能超过32个字符',
        ];
        $validate = new Validate($rule, $msg);
        $result = $validate->check($data_);
        $result_msg_ =$validate->getError();
        return $result;
    }

    /**
     * TODO
     * 获取头像的URL地址
     *
     * @return $result="http://xxx……"
     */
    public function getIconUrl()
    {
        
    }
}

?>