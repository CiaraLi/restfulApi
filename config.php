<?php

define('DBHOST', '127.0.0.1');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', '');

define('WEBURL', 'http://localhost:81/restfulApi/');


$_DATABASE=
<<<mysql
        create database if not exists restful default charset utf8;
        use restful;
        create table  if not exists  products(id int(11) AUTO_INCREMENT primary key ,
            title varchar(50) ,isbn varchar(20),price float(9,2),seller varchar(15),
            createat timestamp);
        insert into products set title='book1',isbn='123456',price='3.50',seller='seller',createat=now();
mysql;
