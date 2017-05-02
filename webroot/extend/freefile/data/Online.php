<?php
namespace freefile\data;

use think\Session;

/**
 * 在线数据
 *
 * @author Administrator
 *        
 */
class Online extends G
{
    // 编号id,int,PRIMARY,A_I
    var $id;
    // 临时身份card,varchar(65),index
    var $card;
    // 对应用户编号user_id,int
    var $user_id;
    // 来源ip1,smallint
    var $ip1;
    // 来源ip2,smallint
    var $ip2;
    // 来源ip3,smallint
    var $ip3;
    // 来源ip4,smallint
    var $ip4;
    // 来源域名domain,varchar(32)
    var $domain;
    // 锁定时间lock_time,timestamp
    var $lock_time;
    // 连续错误次数error_count,int
    var $error_count;
    // 身份持续的截止时间end_time，datetime
    var $end_time;
    // 上次连接时间last_link_time,datetime
    var $last_link_time;

    function __construct()
    {
        $this->class_name = 'Online';
        $this->table_name = 'ssi_online';
        $this->id_name = 'id';
        $this->user_id = 0;
        $this->getIP();
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->lock_time = 0;
        $this->error_count = 0;
        $this->end_time = date('Y-m-d H:i:s', time() + 3600);
        $this->last_link_time = date('Y-m-d H:i:s', time());
        $this->getSaveInfo();
    }

    protected function arrayToObj($array_, $is_new_obj_)
    {
        $obj = $is_new_obj_ != 0 ? clone $this : $this;
        $obj->id = intval($array_['id']);
        $obj->card = $array_['card'];
        $obj->user_id = intval($array_['user_id']);
        $obj->ip1 = intval($array_['ip1']);
        $obj->ip2 = intval($array_['ip2']);
        $obj->ip3 = intval($array_['ip3']);
        $obj->ip4 = intval($array_['ip4']);
        $obj->domain = $array_['domain'];
        $obj->lock_time = $array_['lock_time'];
        $obj->error_count = intval($array_['error_count']);
        $obj->end_time = $array_['end_time'];
        $obj->last_link_time = $array_['last_link_time'];
        return $obj;
    }

    /**
     * 创建一个card——算法
     * 如果本地存在创建时间，则意味着可能是已知用户，否则创建新的KEY
     */
    private function createCard()
    {
        if (Session::has('create_time')) {
            $timestamp = Session::get('create_time');
        } else {
            list ($usec, $sec) = explode(" ", microtime());
            $timestamp = ((float) $usec + (float) $sec);
            $timestamp = str_replace('.', '', $timestamp);
            Session::set('create_time', $timestamp);
        }
        $ip = strlen(dechex($this->ip3)) < 2 ? '0' . dechex($this->ip3) : dechex($this->ip3);
        $ip .= strlen(dechex($this->ip1)) < 2 ? '0' . dechex($this->ip1) : dechex($this->ip1);
        $ip .= strlen(dechex($this->ip4)) < 2 ? '0' . dechex($this->ip4) : dechex($this->ip4);
        $ip .= strlen(dechex($this->ip2)) < 2 ? '0' . dechex($this->ip2) : dechex($this->ip2);
        $httpinfo = $_SERVER['HTTP_USER_AGENT'];
        $card = md5($httpinfo);
        return substr($card, 0, 8) . $ip . substr($card, 8, 16) . $timestamp . substr($card, 16);
    }

    /**
     * 从服务器获取身份信息
     * 如果服务器没有，则创建新的信息
     * 返回服务器的身份信息，并赋值给本地对象
     */
    private function getSaveInfo()
    {
        $card = $this->createCard();
        $result = parent::getSomes("card ='{$card}'", '', '');
        if (count($result) < 1) {
            // 没有找到数据库中的记录
            $this->card = $card;
            parent::add($this);
        } elseif (count($result) == 1) {
            // 找到了记录
            $serverObj = $result[0];
            $this->id = $serverObj->id;
            // 如果服务器记录的IP与当前获取的IP不同
            if ($this->ip1 != $serverObj->ip1) {
                $this->upOne('ip1', $this->ip1);
            }
            if ($this->ip2 != $serverObj->ip2) {
                $this->upOne('ip2', $this->ip2);
            }
            if ($this->ip3 != $serverObj->ip3) {
                $this->upOne('ip3', $this->ip3);
            }
            if ($this->ip4 != $serverObj->ip4) {
                $this->upOne('ip4', $this->ip4);
            }
            
            // 如果服务器记录的域名与当前获取的域名不同
            if ($this->domain != $serverObj->domain) {
                // TODO
                $this->upOne('domain', $this->domain);
            }
            $this->user_id = $serverObj->user_id;
            $this->lock_time = $serverObj->lock_time;
            $this->error_count = $serverObj->error_count;
            $this->end_time = $serverObj->end_time;
            $this->last_link_time = $serverObj->last_link_time;
        } else {
            // 数据库中有相同KEY存在，必须要记录处理
            //TODO
        }
    }

    /**
     * 将IP数据记录到在线对象中
     */
    private function getIP()
    {
        $ip = '';
        if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            if (@$_SERVER["HTTP_CLIENT_IP"]) {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                if (@$_SERVER["REMOTE_ADDR"]) {
                    $ip = $_SERVER["REMOTE_ADDR"];
                } else {
                    if (@getenv("HTTP_X_FORWARDED_FOR")) {
                        $ip = getenv("HTTP_X_FORWARDED_FOR");
                    } else {
                        if (@getenv("HTTP_CLIENT_IP")) {
                            $ip = getenv("HTTP_CLIENT_IP");
                        } else {
                            if (@getenv("REMOTE_ADDR")) {
                                $ip = getenv("REMOTE_ADDR");
                            } else {
                                $ip = "0.0.0.0";
                            }
                        }
                    }
                }
            }
        }
        $tmp_array = explode('.', $ip);
        $this->ip1 = intval($tmp_array[0]);
        $this->ip2 = intval($tmp_array[1]);
        $this->ip3 = intval($tmp_array[2]);
        $this->ip4 = intval($tmp_array[3]);
        return $ip;
    }
}

?>