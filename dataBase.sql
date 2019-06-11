create database baseQA;
use baseQA;

create table usuario(
	idUsuario int primary key auto_increment,
    nombreUsuario varchar(50),
    apellidoUsuario varchar(100),
    direccionUsuario varchar(100),
    contrasennaUsuario varchar(256),
    fechaNacimiento date
);
Alter table usuario add column imagen varchar(512) after contrasennaUsuario;
 

create table amigos
(
	idAmigos int primary key auto_increment,
	idAmigo1 int,
    idAmigo2 int,
    foreign key Amigo1 (idAmigo1) references usuario(idUsuario),
    foreign key Amigo2 (idAmigo2) references usuario(idUsuario)
);

create table publicacion
(
	idPublicacion int primary key auto_increment,
    idUsuario int,
    titulo varchar(100),
    visibilidad int,-- Privada 1, publica 0.
    descripcion varchar(2048),
    fecha datetime,
    direccionImagen varchar(200),
    foreign key publicacionDeUsuario (idUsuario) references usuario(idUsuario)
);
alter table publicacion change idUsuario idUsuarioPublicacion int;

create table likes
(
	idLike int primary key auto_increment,
    idPublicacion int,
    idUsuarioLike int,
    foreign key idPublicacionLike (idPublicacion) references publicacion(idPublicacion),
    foreign key idUsuarioDioLike (idUsuarioLike) references usuario(idUsuario)
);

create table comentarios
(
	idComentario int primary key auto_increment,
    idUsuarioComentario int,
    idPublicacionComentario int,
    
    foreign key idUsuarioComentarioComentario (idUsuarioComentario) references usuario(idUsuario),
    foreign key idPublicacionComentarioComentario (idPublicacionComentario) references publicacion(idPublicacion)
);
Alter table comentarios add column imagen varchar(512) after idPublicacionComentario;
Alter table comentarios add column descripcion varchar(1024) after imagen;



create table likeComentario
(
	idLike int primary key auto_increment,
    idComentario int,
    idUsuarioLike int,
    foreign key idPublicacionLike (idComentario) references comentarios(idComentario),
    foreign key idUsuarioDioLike (idUsuarioLike) references usuario(idUsuario)
);

create table comentarioComentario
(
	idComentarioComentario int primary key auto_increment,
    idUsuarioComentario int,
    idComentario int,
    foreign key idcomentarioComentario (idComentario) references comentarios(idComentario),
    foreign key idUsuarioComentario (idUsuarioComentario) references usuario(idUsuario)
);
Alter table comentarioComentario add column descripcionComentario varchar(1024) after idComentario;
