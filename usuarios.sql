create database productos;
use productos
CREATE TABLE Usuarios (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Contraseña VARCHAR(255)
);
insert into Usuarios (nombre,Contraseña) values ("diego","123456");
create table productos(
id int not null primary key,
nombre varchar(25),
cantidad int
); 
insert into product values ( 1,"pan","comestible", "x10", 1000);
insert into product values ( 2,"jamon","comestible", "x10", 2000);
insert into product values ( 3,"queso","comestible", "x10", 3000);
insert into product values ( 4,"queso_crema","comestible", "x10", 4000);
insert into product values ( 5,"palta","comestible", "x10", 5000);
insert into product values ( 6,"mermelada","comestible", "x10", 6000);