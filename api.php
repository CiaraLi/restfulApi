<?php

include 'config.php';
include 'class/Mysql.php';
include 'restful/Request.php';
include 'restful/Response.php';

$path = './class/';
$array = ['post', 'get', 'put', 'delete', 'patch'];

$request = new Request();
$response = new Response(); 

$method = strtolower($_SERVER['REQUEST_METHOD']);

if (in_array($method, $array)) {
    $class = empty($_REQUEST['class'])?"":ucwords($_REQUEST['class']);
    if (file_exists($path . $class . 'Request.php')) {
        include_once $path . $class . 'Request.php';
    } else {
        $class = 'Request';
    }
    $c=new $class();
    $param = empty($_REQUEST['param'])?"":ucwords($_REQUEST['param']);
    if (method_exists($c,$method . $class)) {
        if (isset($param)) {
            $data = $c->{$method . $class}($param);
        } else {
            $data = $c->{$method . $class}();
        }

        return $response->parseJson($data);
    } else {
        return $response->showerror('404');
    }
}

