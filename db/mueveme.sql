------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
    id         BIGSERIAL    PRIMARY KEY
  , nombre     VARCHAR(32)  NOT NULL UNIQUE
  , password   VARCHAR(60)  NOT NULL
  , email      VARCHAR(255) NOT NULL
  , created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
  , token      VARCHAR(32)
);

DROP TABLE IF EXISTS categorias CASCADE;

CREATE TABLE categorias
(
    id        BIGSERIAL    PRIMARY KEY
  , categoria VARCHAR(255) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS noticias CASCADE;

CREATE TABLE noticias
(
    id           BIGSERIAL    PRIMARY KEY
  , titulo       VARCHAR(255) NOT NULL
  , enlace       VARCHAR(255) NOT NULL
  , cuerpo       TEXT         NOT NULL
  , categoria_id BIGINT       NOT NULL REFERENCES categorias (id)
  , usuario_id   BIGINT       NOT NULL REFERENCES usuarios (id)
  , movimientos  INTEGER      NOT NULL DEFAULT 0
  , created_at   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_noticias_categoria_id ON noticias (categoria_id);
CREATE INDEX idx_noticias_usuario_id ON noticias (usuario_id);

INSERT INTO usuarios (nombre, password, email)
VALUES ('pepe', crypt('pepe', gen_salt('bf')), 'pepe@pepe.com');
