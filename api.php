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

    $class = $request->postData('class');
    if (file_exists($path . $class . 'Request.php')) {
        include_once $path . $class . 'Request.php';
        $classname = $class . "Request";
    } else {

        $class = $classname = 'Request';
    }
    $c = new $classname();
     $param = $request->postData('param');
    if (method_exists($classname, $method . $class)) {
        if (!empty($param)) {
            $data = $c->{$method . $class}($param);
        } else {
            $data = $c->{$method . $class}();
        }

        return $response->parseData($data);
    } else {
        $data='error method';
        return $response->parseData($data,'404');
    }
}

