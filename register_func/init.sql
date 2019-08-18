create database register_func
default character
set utf8
collate utf8_general_ci;
create table register_func. users
(
  user_id int( 5 ) not null
  auto_increment primary key ,
username varchar
  ( 25 ) not null ,
email varchar
  ( 35 ) not null ,
password varchar
  ( 60 ) not null ,
unique
  (email)
);
