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

    static $instance;
    private $conn;
    private $query;

    function __clone() {
        
    }

    function __construct() {
        $this->conn = new mysqli(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
    }
    function getInstance(){
        if(self::$instance instanceof self) {
            self::$instance= new self();

        }
        return self::$instance;
    }
    function setQuery($query) {
        $this->query=$query;
        return self::$instance;
    }
    function row(){
        $result=mysqli_query($this->conn, $this->query);
        $row=mysqli_fetch_array($result);
        return $row;
    }
}
