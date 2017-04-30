<?php
namespace freefile\data;

use \think\Db;

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

    /**
     *
     * {@inheritdoc}
     *
     * @see \freefile\data\G::arrayToObj()
     */
    protected function arrayToObj($array_)
    {
        $this->id = intval($array_['id']);
        $this->name = $array_['name'];
        $this->mdpsd = $array_['mdpsd'];
        $this->last_login_time = $array_['last_login_time'];
        $this->limit_level = intval($array_['limit_level']);
        $this->group_name = $array_['group_name'];
        $this->member_id = intval($array_['member_id']);
        $this->customer_id = intval($array_['customer_id']);
        $this->head_icon = $array_['head_icon'];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \freefile\data\G::getNewObj()
     */
    protected function getNewObj($array_)
    {
        // TODO 自动生成的方法存根
        $result = new User();
        $result->id = intval($array_['id']);
        $result->name = $array_['name'];
        $result->mdpsd = $array_['mdpsd'];
        $result->last_login_time = $array_['last_login_time'];
        $result->limit_level = intval($array_['limit_level']);
        $result->group_name = $array_['group_name'];
        $result->member_id = intval($array_['member_id']);
        $result->customer_id = intval($array_['customer_id']);
        $result->head_icon = $array_['head_icon'];
        return $result;
    }
}
// class Users{
// static function getObjs($where_,$limit_,$order_){
// $where_ = strlen($where_) < 3 ? '' : ' where '.$where_;
// $limit_ = strlen($limit_) < 2 ? '' : ' limit '.$limit_;
// $order_ = strlen($order_) < 2 ? '' : ' order by '.$order_;
// $sql = "select * from {$this->table_name}{$where_}{$limit_}{$order_}";
// $sql_result = Db::query($sql);
// $result = array();
// foreach ($sql_result as $key=>$data){
// $obj = new $this->class_name();
// $obj->arrayToObject($data);
// array_push($result, $obj);
// }
// return $result;
// }
// }
?>
<!-- 
class User extends G
{

    private $table_name = 'ssi_user';

    private $class_name = 'User';

    private $id_name = 'id';


    var $id;

    var $name;

    var $mdpsd;

    var $last_login_time;

    var $limit_level;

    var $gourp_name;

    var $member_id;

    var $customer_id;

    var $head_icon;

    function __construct()
    {
    }
    protected function arrayToObject ($array)
    {
        $i = 0;
        $this->id = intval($array[$i++]);
        $this->name = $array[$i++];
        $this->mdpsd = $array[$i++];
        $this->last_login_time = $array[$i++];
        $this->limit_level = intval($array[$i++]);
        $this->gourp = $array[$i++];
        $this->member_id = intval($array[$i++]);
        $this->customer_id = intval($array[$i++]);
        $this->head_icon = $array[$i++];
    }

    static public function getObject($id_)
    {
        return parent::getOne('Send', 'hs_send', 'send_id', $id_);
    }

    public function getObjects($where_, $limit_, $order_ = null)
    {
        $result = parent::getSomes($this->class_name, $this->table_name, $this->id_name, $where_, $limit_, $order_);
        foreach ($result as $key => $item) {
             //$result[$key] =(object)$item;
        }
        return $result;
        return parent::getSomes($this->class_name, $this->table_name, $this->id_name, $where_, $limit_, $order_);
    }

    static public function getObjectsOrder($where_, $order_, $limit_)
    {
        return parent::getSomesOrder('Send', 'hs_send', $where_, $order_, $limit_);
    }

    static public function insert($object_)
    {
        return parent::in('hs_send', $object_);
    }

    static public function del($id_)
    {
        return parent::de('hs_send', 'send_id', $id_);
    }

    static public function update($id_, $name_, $value_)
    {
        return parent::up('hs_send', 'send_id', $id_, $name_, $value_);
    }

    static public function updateObect($src_object_, $dec_object_)
    {
        parent::upObect('hs_send', 'send_id', $src_object_, $dec_object_);
    }

    public function setContext()
    {
        $this->send_context = serialize($this->send_context);
    }
}
-->