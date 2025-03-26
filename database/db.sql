create database tiendaropa;
use tiendaropa;

create table productos (
id 			int 		primary key auto_increment,
tipo 		varchar(20) not null,
genero 		enum("F","M","U") 		not null,
talla 		varchar(12) 		not null,
precio 		decimal(10,2) 		not null
)engine =innodb;

create table usuarios(
idusuario int primary key auto_increment,
nombre 	varchar(100) 	not null,
usuario varchar(50) 		not null,
userpass varchar(50) 		not null,
create_at datetime not null default now(),
constraint uk_usuario unique (usuario)
)engine = innodb;