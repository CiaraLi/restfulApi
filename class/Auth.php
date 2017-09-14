<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author chenglongliu
 */
class Auth extends Request{
    //put your code here
    public static function make(){
        $data=[
            'code'=>1,
            'token'=> self::token(true)
        ];
        return $this->postData($data);
    }
    public static function auth(){
        $this->makeToken(1);
    }
    private static function token($encode) {
        $scrt=AUTHSECRET; 
        if($encode){
           $token= md5($username.$password.date('yyyy').date('mm').$client_key.$salt);
        }else{
            $this->postData('key');
        }
    }
}
