CREATE DATABASE IF NOT EXISTS fourtwentytime;
USE foutwentyime;

CREATE TABLE IF NOT EXISTS users (
    id              int(255) auto_increment not null,
    role            varchar(20) not null,
    name            varchar(20) not null,
    surname         varchar(100) not null,
    user_name       varchar(15) not null,
    email           varchar(150) not null,
    password        varchar(255) not null,
    image           varchar(255) not null,
    created_at      datetime not null,
    updated_at      datetime not null,
    remember_token  varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES (NULL, 'user', 'Sacha', 'Barragan', 'SachaB', 'barragan.sacha@gmail.com', 'sacha11', '', CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES (NULL, 'user', 'Maria', 'Bastons', 'Mery', 'maria@maria.com', 'maria11', '', CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES (NULL, 'user', 'Nahuel', 'Monsalve', 'Monsalveiton', 'nahuel@nahuel.com', 'nahuel11', '', CURTIME(), CURTIME(), NULL);

CREATE TABLE IF NOT EXISTS weed (
    id          int(255) auto_increment not null,
    user_id     int(255) not null,
    image_path  varchar(255),
    auto        varchar(10),
    breed       varchar(20),
    kind        varchar(150),
    cbd         varchar(100),
    thc         varchar(100),
    veg_time    varchar(50),
    flow_time   varchar(50),
    description text,
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_weed PRIMARY KEY(id),
    CONSTRAINT fk_weed_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO weed VALUES(NULL, 1, 'images/weed01.jpg', 'No','White Skunk', 'Híbrido indica / sativa', 'Medio', 'Alto', 'Corto', 'Corto','Durante años, la White Skunk ha demostrado ser una excelente variedad para los cultivadores noveles, y se ha ganado una merecida reputación entre los conocedores, quienes saben que todavía se puede conseguir cannabis de alta calidad a precios razonables', CURTIME(), CURTIME());

INSERT INTO weed VALUES(NULL, 2, 'images/weed02.jpg', 'No', 'Purple Bud','Indica', 'Alto', 'Medio', 'Largo', 'Corto','Se trata de una Afghanica feminizada de gran potencia, alto rendimiento y con un toque de Sativa, que suele presentar un color púrpura fuerte. Purple Bud es fácil de cultivar en interior, incluso para los principiantes, y en exterior, se desarrolla con fuerza durante la primavera y el verano de los climas templados.', CURTIME(), CURTIME());

INSERT INTO weed VALUES(NULL, 3, 'images/weed03.jpg', 'Si', 'Super Skunk Automatic', 'Indica', 'Alto', 'Medio', 'Corto', 'Corto', '¡Super Skunk automática feminizada! Para los cultivadores que están empezando, la Super Skunk es uno de las mejores variedades en todos los aspectos y una de las más consistentes en el mundo del cultivo del cannabis. Extremadamente potente y rápida en floración; esta variedad prácticamente Indica, compacta y con una alta producción, cumple todos los requisitos para principiantes y cultivadores experimentados por igual.', CURTIME(), CURTIME());



CREATE TABLE IF NOT EXISTS comments (
    id          int(255) auto_increment not null,
    user_id     int(255) not null,
    weed_id    int(255) not null,
    comments    text,
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_weed FOREIGN KEY(weed_id) REFERENCES weed(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 3, 'Esta re piola esto mal', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'Que Esta re piola esto mal', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3, 2, 'Lo Bueno Esta re piola esto mal', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 1, 2, 'Esta re piola esto mal', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 3, 'Que Esta re piola esto mal', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3, 1, 'Lo Bueno Esta re piola esto mal', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes (
    id              int(255) auto_increment not null,
    user_id         int(255) not null,
    weed_id         int(255) not null,
    would_smoke     int(10),
    would_eat       int(10),
    would_plant     int(10),
    it_hits_me      int(10),
    would_share     int(10),
    created_at  datetime,
    updated_at  datetime,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_weed FOREIGN KEY(weed_id) REFERENCES weed(id)
)ENGINE=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 3, 4, 5, 4, 4, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, 3, 9, 7, 5, 8, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 2, 7, 8, 6, 3, 6, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 1, 2, 4, 5, 4, 4, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 3, 3, 9, 7, 5, 8, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 1, 7, 8, 6, 3, 6, CURTIME(), CURTIME());