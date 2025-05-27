CREATE DATABASE reddit_clone;

USE reddit_clone;


CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);



CREATE TABLE comunidades(
    id_foro INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    administrador INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (administrador) REFERENCES users(id_user)
);

CREATE TABLE posts (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    comun INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id_user),
    FOREIGN KEY (comun) REFERENCES comunidades(id_foro)
);



CREATE TABLE votes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  post_id INT NOT NULL,
  vote_type TINYINT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id_user) ON DELETE CASCADE,
  FOREIGN KEY (post_id) REFERENCES posts(id_post) ON DELETE CASCADE,
  UNIQUE KEY user_post_vote (user_id, post_id)
);

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  post_id INT NOT NULL,
  content TEXT NOT NULL,
  created_at DATETIME NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id_user) ON DELETE CASCADE,
  FOREIGN KEY (post_id) REFERENCES posts(id_post) ON DELETE CASCADE
);


--PROCEDIMIENTOS ALMACENADOS

/*
Por ejemplo creamos el procedimiento almacenado llamado 'pa_libros_autor' que recibe un parámetro de entrada de tipo varchar(30):

 delimiter //
 create procedure pa_libros_autor(in p_autor varchar(30))
 begin
   select titulo, editorial,precio
     from libros
     where autor= p_autor;
 end //
 delimiter ;
Luego para llamar al procedimiento almacenado debemos pasar un valor para el parámetro:

 call pa_libros_autor('Richard Bach');*/

--PROCEDIMIENTO ALMACENADO LOGIN
CREATE PROCEDURE proceso_login (in username_e VARCHAR(50))
BEGIN
SELECT * FROM USERS WHERE username=username_e
END

CALL proceso_login('')


--comunidades
CREATE PROCEDURE comunidades_carga
BEGIN
SELECT id_foro, nombre FROM comunidades LIMIT 3
END

CALL comunidades_carga


--consultar los primeros diez post ultimos
CREATE PROCEDURE ultimos_post
BEGIN
SELECT title, content,username FROM posts JOIN users ON posts.user_id = users.id_user ORDER BY created_at DESC LIMIT 10
END

CALL ultimos_post

--crear comunidad
CREATE PROCEDURE crear_comunidad(IN nombre_foro VARCHAR(30), IN descr VARCHAR(100), IN user INT)
BEGIN
INSERT INTO comunidades (nombre,descripcion,administrador) VALUES (nombre_foro,descr,user)
END

CALL crear_comunidad('','',)


--crear post
CREATE PROCEDURE crear_post(IN user_e INT, IN titulo VARCHAR(255), IN contenido TEXT)
BEGIN
INSERT INTO posts (user_id, title, content) VALUES (user,titulo ,contenido)
END

CALL crear_post('','',)


--consulta de los post de foro
CREATE PROCEDURE post_foro(in foro_s INT)
BEGIN
SELECT title, content,created_at,username FROM posts
INNER JOIN users ON users.id_user=posts.user_id
INNER JOIN comunidades ON comunidades.id_foro=posts.comun
WHERE comunidades.id_foro=foro_s
ORDER BY created_at DESC;
END

CALL post_foro()


--cargar post de perfil
CREATE PROCEDURE post_perfile(in id_usuario INT)
BEGIN
SELECT title, content,created_at,username FROM posts
INNER JOIN users ON users.id_user=posts.user_id WHERE id_user = id_usuario
END

CALL post_perfile()