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
class ProductRequest extends Request{
     
    function getProduct($param=null) {
        return array(
            'all products'=>WEBURL."product",
            'show product'=>WEBURL."/product/1");
    } 
    function postProduct($param=null) {
        return array(
            'all products'=>WEBURL."product",
            'show product'=>WEBURL."/product/1");
    } 
}
