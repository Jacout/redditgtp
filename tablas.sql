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


 SELECT title, content,created_at,username FROM posts
INNER JOIN users ON users.id_user=posts.user_id
INNER JOIN comunidades ON comunidades.id_foro=posts.comun
WHERE comunidades.id_foro=(SELECT id_foro FROM comunidades WHERE nombre ='Musica')
ORDER BY created_at DESC;