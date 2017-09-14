<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductRequest
 *
 * @author chenglongliu
 */
class ProductRequest extends Request {

    function getProduct($param = null) {
        $mysql = Mysql::getInstance();
        $sql = 'select * from books';
        if (!empty($param)) {
            $sql.=' where id ="' . intval($param) . '"';
        }
        return $mysql->setQuery($sql)->row();
    }

    function postProduct() {
        $mysql = Mysql::getInstance();
        if (!empty($this->postData('title')) && !empty($this->postData('isbn'))) {
            $title = addslashes($this->postData('title'));
            $isbn = addslashes($this->postData('isbn'));
            $success = $mysql->setQuery('insert into books set isbn="' . $isbn . '" ,title="' . $title . '"')->run();

            return $success < 0 ? ['code' => -1, 'error' => 'failed'] :
                    $mysql->getbyid('books');
        } else {
            return ['code' => -1, 'error' => 'invalid params'];
        }
    }

    /**
     * 更改全部信息
     * @param type $param
     * @return type
     */
    function putProduct($param = null) {
        $mysql = Mysql::getInstance();
        $put = self::$postData;
        if (!empty($param) && !empty($put['title']) && !empty($put['isbn'])) {
            $title = addslashes($put['title']);
            $isbn = addslashes($put['isbn']);
            $success = $mysql->setQuery('update books set isbn="' . $isbn . '" ,title="' . $title . '"'
                            . ' where id="' . intval($param) . '"')->run();
            return $success < 0 ? ['code' => -1, 'error' => 'failed'] :
                    $mysql->getbyid('books', intval($param));
        } else {
            return ['code' => -1, 'error' => 'invalid params'];
        }
    }

    function patchProduct($param = null) {
        $mysql = Mysql::getInstance();
        $put = self::$postData;
        $update = [];
        empty($put['title']) ? null : $update[] = ' title="' . addslashes($put['title']) . '"';
        empty($put['isbn']) ? null : $update[] = ' isbn="' . addslashes($put['isbn']) . '"';
        if (!empty($update)) {
            $success = $mysql->setQuery('update books set ' . implode(' and ', $update)
                            . ' where id="' . intval($param) . '"')->run();
            return $success < 0 ? ['code' => -1, 'error' => 'failed'] :
                    $mysql->getbyid('books', intval($param));
        } else {
            return ['code' => -1, 'error' => 'invalid params'];
        }
    }

    function deleteProduct($param = null) {
        $mysql = Mysql::getInstance();
        $sql = 'delete  from books';
        $sql.=' where id ="' . intval($param) . '"';

        return $mysql->setQuery($sql)->run();
    }

}
