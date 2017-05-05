<?php
namespace freefile\data;
use think\Db;
use think\Debug;

abstract class G
{

    var $table_name;

    var $class_name;

    var $id_name;

    /**
     * 将SQL查询的数据赋给对象
     *
     * @param $array_          
     * @param is_new_obj_ 0不新建，非0新建
     * @return obj  
     */
    abstract protected function arrayToObj($array_,$is_new_obj_);
    
    /**
     * 设置数据检查
     * @param $obj_ 检查对象
     * @param &result_msg_ 传入参数，将检查结果字符串方式返给该参数
     */
    abstract public function rule($data_,&$result_msg_);


    /**
     * 查询多个数据
     *
     * @param $where_ 仅条件内容本身            
     * @param $limit_ 仅条件内容本身            
     * @param $order_ 仅条件内容本身            
     */
    public function getSomes($where_, $limit_, $order_)
    {
        // 参数判断
        if (! empty($where_)) {
            if (strlen($where_) > 3) {
                $where_ = ' where ' . $where_; // 查询条件字符判断，长度小于3则报错
            } else {
                abort(404, 'G->getSomes参数值where错：' . $where_ . '<br />');
            }
        }
        if (! empty($limit_)) {
            if (strlen($limit_) > 3) {
                $limit_ = ' limit ' . $limit_; // 查询条件字符判断，长度小于3则报错
            } else {
                abort(404, 'G->getSomes参数值limit错：' . $limit_ . '<br />');
            }
        }
        if (! empty($order_)) {
            if (strlen($order_) > 3) {
                $order_ = ' where ' . $order_; // 查询条件字符判断，长度小于3则报错
            } else {
                abort(404, 'G->getSomes参数值order错：' . $order_ . '<br />');
            }
        }
        
        $sql = "select * from {$this->table_name}{$where_}{$limit_}{$order_}";
        $sql_result = Db::query($sql);
        $result = array();
        foreach ($sql_result as $key => $data) {
            $obj = $this->arrayToObj($data,1); // 将查询的数据转换为对象，并加入到输出数组中
            array_push($result, $obj);
        }
        Debug::dump($sql);
        return $result;
    }

    /**
     * 以编号方式从数据库中提取对象
     *
     * @param $id_ 对象在数据库中的编号            
     */
    public function getOne($id_)
    {
        // 参数判断
        if (intval($id_) <= 0) {
            abort(404, 'G->getOne参数值id错：' . $id_);
        }
        $result = null;
        $sql = "select * from {$this->table_name} where {$this->id_name}=$id_";
        $sql_result = Db::query($sql);
        if (count($sql_result) == 1) { // 查询有结果，才可以进行
            $result = $this->arrayToObj($sql_result[0],1); // 将查询的数据转换为输出对象
        }
        Debug::dump($sql);
        return $result;
    }

    /**
     * 将目标对象的数据覆盖当前对象
     * ----使用时先clone 当前对象
     * 
     * @param object $dec_object_
     *            除id外，将一一对比当前对象与目标对象的差异，最终以目标对象的数据覆盖当前数据
     */
    public function upObect($dec_object_)
    {
        $tmp_array = array();
        foreach ($dec_object_ as $key => $val) { // 列举所有数据
            if ($this->$key != $dec_object_->$key && $key != $this->id_name) {
                if (is_int($val) || is_float($val)) { // 如果是数字或浮点数，则不加''
                    array_push($tmp_array, "{$key} = {$val}");
                } else {
                    array_push($tmp_array, "{$key} = '{$val}'");
                }
            }
        }
        $this->upArray($tmp_array);
    }
    public function upSelf(){
        $tmp_array = array();
        foreach ($this as $key => $val) { // 列举所有数据
            if ($key != $this->id_name && $key != 'id_name' && $key != 'table_name' && $key !='class_name') {
                if (is_int($val) || is_float($val)) { // 如果是数字或浮点数，则不加''
                    array_push($tmp_array, "{$key} = {$val}");
                } else {
                    array_push($tmp_array, "{$key} = '{$val}'");
                }
            }
        }
        $this->upArray($tmp_array);
    }

    /**
     * 修正当前对象在SQL中存储的值
     *
     * @param $name_ 存储的名称            
     * @param $value_ 数值            
     */
    public function upOne($name_, $value_)
    {
        if (is_int($value_)) {
            $set = "`{$name_}`={$value_}";
        } else {
            $set = "`{$name_}`='{$value_}'";
        }
        $id_name = $this->id_name;
        Db::query("update {$this->table_name} set {$set} where {$id_name} ={$this->$id_name}");
       // echo "update {$this->table_name} set {$set} where {$id_name} ={$this->$id_name}";
    }

    /**
     * 通过数组数据来更新对象存储在SQL的数据
     * ---该方法不对外开放
     * 
     * @param $array_ 例：（"name='free'","member_id=1"）            
     */
    private function upArray($array_)
    {
        // 大体判断参数类型
        if (! is_array($array_) || count($array_) < 1) {
            abort(404, 'G->upArray参数值$array_错：' . print_r($array_));
        }
        $set = '';
        foreach ($array_ as $key => $val) {
            if (strlen($val) < 3) {
                abort(404, "G->upArray参数值{$array_}的下标[{$key}]错：{$val}");
            } else {
                $set .= ' , ' . $val;
            }
        }
        $set = substr($set, 3);
        $id_name = $this->id_name;
        $sql = "update {$this->table_name} set {$set} where {$id_name} ={$this->$id_name}";
        Debug::dump($sql);
        Db::query($sql);
    }

    /**
     * 通过编号删除数据
     * 
     * @param unknown $id_            
     */
    public function del($id_)
    {
        if (intval($id_) <= 0) {
            abort(404, 'G->del参数值id错：' . $id_);
        }
        $sql ="delete from {$this->table_name} where {$this->id_name} = {$id_}";
        Debug::dump($sql);
        return Db::query($sql);
    }

    /**
     * 通过对象在SQL中新建数据
     * @param $object_
     */
    public function add($object_)
    {
        $array = get_class_vars(get_class($object_));
        $values = '';
        foreach ($object_ as $key => $val) {
            if ($object_->$key === NULL) {
                $values .= ",null";
            } elseif (in_array($key, array(
                'table_name',
                'class_name',
                'id_name'
            ))) {
                continue;
            }elseif($key == $object_->id_name){
                $values .= ',\'\'' ;
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
        $sql = "insert into {$this->table_name} values({$values})";
        Debug::dump($sql);
        Db::query($sql);
    }
    public function query($sql_){
        Debug::dump($sql_);
        Db::query($sql_);
    }
}
?>