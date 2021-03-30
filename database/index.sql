1)

CREATE DATABASE `briefphp2`

2)

CREATE TABLE IF NOT EXISTS `users` (
ID int(11) NULL AUTO_INCREMENT,
NAME varchar(50)  NULL,
FAMILYNAME varchar(50)  NULL,
PASSWORD varchar(255)  NULL,
EMAIL varchar(100) NULL,
ROLE text NOT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

3) 

CREATE TABLE IF NOT EXISTS `technos` (
id int(11) NOT NULL AUTO_INCREMENT,
html INTEGER NULL,
cgi  INTEGER NULL,
js  INTEGER NULL,
ajax INTEGER NULL,
php INTEGER NULL,
id_users INTEGER NULL,
Foreign Key(id_users) references users (ID),
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

4)

CREATE TABLE IF NOT EXISTS `formations` (
id int(11)  NULL AUTO_INCREMENT,
Foreign Key(id) references users ( ID),
NAME varchar(50) NULL,
FAMILYNAME varchar(50)  NULL,
TCHNOLOGIE INTEGER  NULL,
DATE DATE INTEGER  NULL,
id_users INTEGER NULL,
Foreign Key(id_users) references users (ID),
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



  


