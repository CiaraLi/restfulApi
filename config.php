<?php

define('DBHOST', '127.0.0.1');
define('DBUSERNAME', 'root');
define('DBPASSWORD', 'root');
define('DBNAME', 'restful');

define('WEBURL', 'http://localhost:81/restfulApi/');
define('HTTP_VERSION', 'HTTP/1.1');
define('AUTHSECRET', 'auth');

define('CREATE_DATABASE', 
<<<mysql
        create database if not exists restful default charset utf8;
        use restful;
        create table if not exists books(
               id int(11) auto_increment primary key,
               title varchar(15),
               user varchar(20),
               isbn varchar(15) unique,
               createat timestamp default now()
        );
        insert into books set title='book1',isbn='111111',user='test';
        create table if not exists users(
               id int(11) auto_increment primary key,
               user varchar(20),
               password varchar(50),
               createat timestamp default now()
        );
        insert into users set user='test',password='111111';
mysql
        );
