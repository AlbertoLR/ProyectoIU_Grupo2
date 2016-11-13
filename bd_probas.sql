-- host 127.0.0.1
-- dbuser root (By the moment)
-- dbpass iu
-- dbname iu_web

-- profile will be FK from profile
-- users has rights over controllers N:M with controllers
-- users could have a profile N:1
-- profile N:M with controllers
-- Controllers N:1 with actions


create database iu_web;

use iu_web;

create table users (
       id int auto_increment PRIMARY KEY,
       username varchar(25),
       passwd varchar(15),
       profile varchar(25)
);

INSERT INTO users(username, passwd, profile) values('test', 'abc123.', 'admin');
