<?php
namespace freefile\data;

/**
 * 登陆账户数据表
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

    function __construct()
    {
        $this->class_name = 'User';
        $this->table_name = 'ssi_user';
        $this->id_name = 'id';
    }

    protected function arrayToObj($array_, $is_new_obj_)
    {
        $obj = $is_new_obj_ != 0 ? clone $this : $this;
        $obj->id = intval($array_['id']);
        $obj->name = $array_['name'];
        $obj->mdpsd = $array_['mdpsd'];
        $obj->last_login_time = $array_['last_login_time'];
        $obj->limit_level = intval($array_['limit_level']);
        $obj->group_name = $array_['group_name'];
        $obj->member_id = intval($array_['member_id']);
        $obj->customer_id = intval($array_['customer_id']);
        $obj->head_icon = $array_['head_icon'];
        return $obj;
    }
    /**
     * TODO
     * 获取头像的URL地址
     * @return $result="http://xxx……"
     */
    public function getIconUrl(){
        
    }
}

?>