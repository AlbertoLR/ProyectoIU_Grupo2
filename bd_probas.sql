create database iu_web;

use iu_web;

create table profile (
       id int auto_increment PRIMARY KEY,
       profilename varchar(25)
);

create table user (
       id int auto_increment PRIMARY KEY,
       username varchar(25),
       passwd varchar(15),
       profile varchar(25) references profile(id)
);

create table action (
       id int auto_increment PRIMARY KEY,
       actionname varchar(25)
);

create table controller (
       id int auto_increment PRIMARY KEY,
       controllername varchar(25),
       action varchar(25) references action(actionname)
);

create table user_controller(
       userid int references user(id),
       controllerid int references controller(id),
       PRIMARY KEY(userid, controllerid)
);

create table profile_controller(
       profileid int references profile(id),
       controllerid int references controller(id),
       PRIMARY KEY(profileid, controllerid)
);

INSERT INTO users(username, passwd, profile) values('test', 'abc123.', 'admin');
