<?php
namespace freefile\data;

class User extends G
{

    var $id;

    var $name;

    var $mdpsd;

    var $last_login_time;

    var $limit_level;

    var $group_name;

    var $member_id;

    var $customer_id;

    var $head_icon;

    function __construct()
    {
        $this->class_name = 'User';
        $this->table_name = 'ssi_user';
        $this->id_name = 'id';
    }

    protected function arrayToObj($array_,$is_new_obj_){
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
 

}

?>