<?php
include 'restful/Request.php';
include 'restful/Response.php';

var_dump('hello'.(isset($_REQUESR['name'])?$_REQUESR['name']:'')); 



