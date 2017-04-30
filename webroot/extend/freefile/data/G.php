<?php
namespace freefile\data;

use think\Db;

abstract class G
{

    var $table_name;

    var $class_name;

    var $id_name;

    /**
     * 将SQL查询的数据赋给原对象
     * @param unknown $array_
     */
    abstract protected function arrayToObj($array_);

    /**
     * 用SQL查询的数据新建一个对象
     * @param unknown $array_
     */
    abstract protected function getNewObj($array_);

    /**
     * 查询多个数据
     * @param $where_ 仅条件内容本身
     * @param $limit_    仅条件内容本身
     * @param $order_   仅条件内容本身
     */
    public function getSomes($where_, $limit_, $order_)
    {
        $where_ = strlen($where_) < 3 ? '' : ' where ' . $where_;
        $limit_ = strlen($limit_) < 2 ? '' : ' limit ' . $limit_;
        $order_ = strlen($order_) < 2 ? '' : ' order by ' . $order_;
        $sql = "select * from {$this->table_name}{$where_}{$limit_}{$order_}";
        $sql_result = Db::query($sql);
        $result = array();
        foreach ($sql_result as $key => $data) {
            $obj = $this->getNewObj($data);
            array_push($result, $obj);
        }
        return $result;
    }
    /**
     * 以编号方式从数据库中提取对象
     * @param  $id_ 对象在数据库中的编号
     */
    public function getOne($id_)
    {
        if (intval($id_) <= 0) {
            return null;
        }
        $result = array();
        $sql = "select * from {$this->table_name} where {$this->id_name}=$id_";
        $sql_result = Db::query($sql);
        if(count($sql_result) == 1){
            $result = $this->getNewObj($sql_result[0]);
        }
        return $result;
    }
    /**
     * 将目标对象的数据覆盖当前对象
     * @param unknown $dec_object_
     */
    public function upObect( $dec_object_)
    {
        $array = get_class_vars(get_class($dec_object_));
        foreach ($array as $key => $val) {
            if ($this->$key != $dec_object_->$key && $key != $this->id_name) {
                $this->up($key, $dec_object_->$key);
            }
        }
    }
    /**
     * 
     * @param unknown $id_
     * @param unknown $name_
     * @param unknown $value_
     */
    public function up($name_, $value_)
    {
        if (is_int($value_)) {
            $set = "`{$name_}`={$value_}";
        } else {
            $set = "`{$name_}`='{$value_}'";
        }
        if (is_array($value_)) {
            $set = '';
            foreach ($value_ as $val) {
                $set .= ';' . $val;
            }
            if (strlen($set) > 0) {
                $set = "`{$name_}`='" . substr($set, 1) . "'";
            } else {
                $set = "`{$name_}`=''";
            }
        }
        $id_name = $this->id_name;
        echo $this->$id_name."<br />";
        print_r($this);
        Db::query("update {$this->table_name} set {$set} where {$id_name} ={$this->$id_name}");
    }
}

?>
<!-- 
use \think\Db;

/**
 * 数据基础类
 * 用于MYSQL表数据转换为PHP对象
 *  * @author Administrator
 * *
 *
 */
class G
{
    //abstract protected function arrayToObject($array_);    
       
    /**
     * 从MYSQL中获取数据
     * @param varchar $class_name_ 类名
     * @param varchar $table_name_ 表名
     * @param varchar $id_name_ 编号命名
     * @param varchar $where_ 查询条件
     * @param varchar $limit_ 限制条件
     * @param varchar $order_ 排序条件
     */
    static public function getSomes($class_name_, $table_name_, $id_name_, $where_, $limit_,$order_)
    {
        $where_ = strlen($where_) < 3 ? '' : ' where '.$where_;
        $limit_ = strlen($limit_) < 2 ? '' : ' limit '.$limit_;
        $order_ = strlen($order_) < 2 ? '' : ' order by '.$order_;
        $sql = "select * from {$table_name_}{$where_}{$limit_}{$order_}";
        $sql_result = Db::query($sql);
        $result = array();
        foreach ($sql_result as $key=>$data){
            $obj = new $class_name_();
            $obj->arrayToObject($data);
            array_push($result, $obj);
        }
        return $result;
    }

    static public function getSomesOrder($class_name_, $table_name_, $where_, $order_, $limit_)
    {
        global $DB;
        $sql = "select * from {$table_name_}{$where_}{$order_}{$limit_}";
        $result = $DB->getArrayResult($sql);
        $tmp_array = array();
        foreach ($result as $item) {
            $object = new $class_name_();
            $object->arrayToObject($item);
            array_push($tmp_array, $object);
        }
        return $tmp_array;
    }

    static public function getOne($class_name_, $table_name_, $id_name_, $id_)
    {
        global $DB;
        $case = NULL;
        $sql = "select * from {$table_name_} where {$id_name_} ={$id_}";
        $result = $DB->getFirstResult($sql);
        if (count($result) > 0) {
            $object = new $class_name_();
            $object->arrayToObject($result);
            return $object;
        } else {
            return NULL;
        }
    }

    static public function in($table_name_, $object_)
    {
        global $DB;
        $array = get_class_vars(get_class($object_));
        $values = '';
        foreach ($array as $key => $val) {
            if ($object_->$key === NULL) {
                $values .= ",null";
            } elseif (is_int($object_->$key)) {
                $values .= ",{$object_->$key}";
            } elseif (is_array($object_->$key)) {
                $set = '';
                foreach ($object_->$key as $subval) {
                    $set .= ';' . $subval;
                }
                if (strlen($set) > 0) {
                    $set = ",'" . substr($set, 1) . "'";
                } else {
                    $set = ",''";
                }
                $values .= $set;
            } else {
                $values .= ",'{$object_->$key}'";
            }
        }
        $values = substr($values, 1);
        $sql = "insert into {$table_name_} values({$values})";
        $DB->execSql($sql);
    }

    static public function de($table_name_, $id_name_, $id_)
    {
        global $DB;
        $sql = "delete from {$table_name_} where {$id_name_} = {$id_}";
        $DB->execSql($sql);
    }

    static public function up($table_name_, $id_name_, $id_, $name_, $value_)
    {
        global $DB;
        if (is_int($value_)) {
            $set = "`{$name_}`={$value_}";
        } else {
            $set = "`{$name_}`='{$value_}'";
        }
        if (is_array($value_)) {
            $set = '';
            foreach ($value_ as $val) {
                $set .= ';' . $val;
            }
            if (strlen($set) > 0) {
                $set = "`{$name_}`='" . substr($set, 1) . "'";
            } else {
                $set = "`{$name_}`=''";
            }
        }
        $DB->execSql("update {$table_name_} set {$set} where {$id_name_} ={$id_}");
    }

    static public function upObect($table_name_, $id_name_, $src_object_, $dec_object_)
    {
        $array = get_class_vars(get_class($dec_object_));
        if ($dec_object_->$id_name_ != $dec_object_->$id_name_) {
            return;
        }
        foreach ($array as $key => $val) {
            if ($src_object_->$key != $dec_object_->$key && $key != $id_name_) {
                self::up($table_name_, $id_name_, $dec_object_->$id_name_, $key, $dec_object_->$key);
            }
        }
    }

    static public function getSameObject($object_)
    {
        $array = get_class_vars(get_class($object_));
        $class_name = get_class($object_);
        $result = new $class_name();
        foreach ($array as $key => $val) {
            $result->$key = $object_->$key;
        }
        return $result;
    }

    static public function execSql($sql_)
    {
        global $DB;
        $DB->execSql($sql_);
    }
}
?>
-->