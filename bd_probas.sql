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
       profile varchar(25) references profile(profilename)
);

create table action (
       id int auto_increment PRIMARY KEY,
       actionname varchar(25)
);

create table controller (
       id int auto_increment PRIMARY KEY,
       controllername varchar(25)
);

create table permission (
       id int auto_increment PRIMARY KEY,
       controller varchar(25) references controller(controllername),
       action varchar(25) references action(actionname)
);

create table user_perms(
       id int auto_increment PRIMARY KEY,
       userid int references user(id),
       permission int references permission(id)
);

create table profile_perms(
       id int auto_increment PRIMARY KEY,
       profileid int references profile(id),
       permission int references permission(id)
);

INSERT INTO profile(profilename) values ('admin');
INSERT INTO users(username, passwd, profile) values('test', 'abc123.', 'admin');
INSERT INTO action(actionname) values('show');
INSERT INTO controller(controllername) values('user');
INSERT INTO permission(controller, action) values ('user', 'show');
INSERT INTO profile_perms(profileid, permission) values(1,1);
