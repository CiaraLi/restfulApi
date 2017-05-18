<?php
class Request{
    function getRequest($param=null) {
        return array(
            'all products'=>WEBURL."product",
            'show product'=>WEBURL."/product/1");
    } 
    function postRequest($param=null) {
        return array(
            'all products'=>WEBURL."product",
            'show product'=>WEBURL."/product/1");
    } 
}