<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mysql
 *
 * @author chenglongliu
 */
class Mysql {

    private static $instance;
    private static $conn;
    private static $stmt;
    private static $id;
    private $query;

    private function __clone() {
        
    }

    private function __construct() {
        
    }

    function __destruct() {
//        mysqli_stmt_close(self::$stmt);
        mysqli_close(self::$conn);
    }

    static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
            self::$conn = new mysqli(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
            if (mysqli_connect_errno()) {
                echo "连接数据库失败：" . mysqli_connect_error();
                self::$conn = null;
                exit;
            }
            $tables=<<<sql
                    create table if not exists books(id int(11) auto_increment primary key,title varchar(15),isbn varchar(15) unique);
sql;
            $table=mysqli_query(self::$conn, $tables); 
//            self::$stmt = mysqli_stmt_init(self::$conn);
        }
        return self::$instance;
    }

    /**
     * 
     * @param type $query
     * @param type $param
     * $params = array(  
     *      'ids',            // 第一个参数为参数表类型串, 其中 i:整型 d:双精度 s:表示字符串 b:BLOG  
     *      1000,  
     *      200.00,  
     *      'string value'  
     *  );  
     * @return type
     */
    public function setQuery($query, $params = array()) {
       $this->query=$query;
//        $stmt=mysqli_stmt_prepare(self::$stmt, $query); 
//        if ($stmt) {
//            foreach ($params as $k => $v) {
//                $array[] = &$params[$k]; //注意此处的引用  
//            }
//            call_user_func_array(array(self::$stmt, 'bind_param'), $array); // 魔术方法直接call  
//        } 
        return self::$instance;
    }

    function getbyid($table,$id="") {
        if(empty($id)){
            $id=  self::$id;
        }
        $this->setQuery('select * from '.$table.' where id="'.$id.'"');
        return $this->row();
    }
    
    public function run() {
//        mysqli_stmt_execute(self::$stmt); 
//        self::$id= mysqli_insert_id(self::$stmt);
//        return mysql_stmt_affected_rows(); 
        mysqli_query(self::$conn, $this->query);
        self::$id= mysqli_insert_id(self::$conn);
        return mysqli_affected_rows(self::$conn);
        
    }

    public function row() { 
        $array = array();
//        mysqli_stmt_bind_result(self::$stmt, $array);
//        mysqli_stmt_fetch(self::$stmt);
        $result = mysqli_query(self::$conn, $this->query);
        while ($row = mysqli_fetch_array($result)) {
            array_push($array, $row);
        }
        return $array;
    }

    public function first() {
        $result = mysqli_query(self::$conn, $this->query); 
        $row = mysqli_fetch_array($result);
        return $row;
    }

}
