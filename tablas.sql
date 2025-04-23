CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    comunidad_per INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (comunidad_per) REFERENCES c_info(ID_C)
);

CREATE TABLE friends(
    id_user INT NOT NULL,
    id_amigo INT NOT NULL,
    FOREIGN KEY (id_1) REFERENCES users(id),
    FOREIGN KEY (id_2) REFERENCES users(id),
);

--COMUNIDAD
CREATE TABLE c_info(
    ID_C INT AUTO_INCREMENT PRIMARY KEY,
    nombre_c VARCHAR(50) NOT NULL,
    descripcion VARCHAR(200) NOT NULL
);

--integrantes de cada comunidad
CREATE TABLE comunidades(
    ID_integrante INTEGER NOT NULL,
    ID_Community INTEGER NOT NULL,
    FOREIGN KEY (ID_integrante) REFERENCES users(id),
    FOREIGN KEY (ID_Community) REFERENCES c_info(ID_C)
);

--likes
CREATE TABLE likes(
    id_persona INTEGER NOT NULL,
    id_post INTEGER NOT NULL,
    FOREIGN KEY (id_persona) REFERENCES users(id),
    FOREIGN KEY (id_post) REFERENCES posts(id)
);


--comentarios
CREATE TABLE comentarios(
    id_persona_c INTEGER NOT NULL,
    id_post_c INTEGER NOT NULL,
    FOREIGN KEY (id_persona_c) REFERENCES users(id),
    FOREIGN KEY (id_post_c) REFERENCES posts(id)
);