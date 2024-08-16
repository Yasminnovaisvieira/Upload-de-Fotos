create database fotos;
use fotos;

create table foto(
    id int(4) auto_increment primary key,
    foto longblob,
    fotoTipo varchar(30),
    caminhoFoto VARCHAR(255)
);