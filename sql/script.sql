-- BASE DE DATOS
-- ELIMINAR BASE DE DATOS
DROP DATABASE IF EXISTS englishTech;

-- CREAR BASE DE DATOS
CREATE DATABASE englishTech DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- SELECCIONAR LA BASE DE DATOS
USE englishTech;

-- CREACION DE TABLAS
-- TABLA USUARIO
CREATE TABLE usuario(
    idusuario smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(60) NOT NULL,
    apellidos varchar(80) NOT NULL,
    contrasenia varchar(15) NOT NULL,
    tipo char(1) CHECK (tipo in ('a','u')) 
);

-- TABLA CATEGORIA
CREATE TABLE categoria(
    idcategoria smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo varchar(50) NOT NULL UNIQUE
);

-- TABLA VOCABULARIO
CREATE TABLE vocabulario(
    idvocabulario smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idcategoria smallint UNSIGNED NOT NULL,
    palabrasES varchar(100) NOT NULL,
    palabrasEN varchar(100) NOT NULL,
    Imagen varchar(60) NOT NULL UNIQUE,
    CONSTRAINT FK_idcategoria FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria)
);

-- TABLA EJERCICIO
CREATE TABLE ejercicio(
    idejercicio smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descripcion varchar(80) NOT NULL,
    fechahora datetime NOT NULL
);

-- TABLA EJERCICIO_USUARIO
CREATE TABLE ejercicio_usuario(
    idejercicio smallint UNSIGNED NOT NULL AUTO_INCREMENT,
    idusuario smallint UNSIGNED NOT NULL,
    fecharealizado datetime NOT NULL,
    nIntentos tinyint UNSIGNED NOT NULL,
    PRIMARY KEY(idejercicio, idusuario)
);

-- TABLA VOCABULARIO_EJERCICIO
CREATE TABLE vocabulario_ejercicio(
    idvocabulario smallint UNSIGNED NOT NULL AUTO_INCREMENT,
    idejercicio smallint UNSIGNED NOT NULL,
    PRIMARY KEY(idvocabulario, idejercicio)
);