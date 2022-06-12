INSERT INTO categoria(tipo)
    VALUES  ('Animales'),
              ('Comidas'),
              ('Objetos'),
              ('Deportes'),
              ('Ropa'),
              ('Instrumentos');

INSERT INTO vocabulario(palabrasEN, palabrasES, idcategoria, Imagen)
    VALUES  ('dog', 'perro', 1, '../img/perro.jpg'),
              ('cat', 'gato', 1, '../img/gato.jpg'),
              ('cow', 'vaca', 1, '../img/vaca.jpg'),
              ('horse', 'caballo', 1 , '../img/caballo.jpg'),
              ('sheep', 'oveja', 1, '../img/oveja.jpg'),
              ('pig', 'cerdo', 1, '../img/cerdo.jpg'),
              ('chicken', 'pollo', 1, '../img/pollo.jpg'),
              ('duck', 'pato', 1, '../img/pato.jpg'),
              ('goose', 'ganso', 1, '../img/ganso.png'),
              ('fish', 'pez', 1, '../img/pez.jpg'),
              ('bird', 'pajaro', 1, '../img/pajaro.png'),
              ('snake', 'serpiente', 1, '../img/serpiente.jpg'),
              ('lion', 'león', 1, '../img/leon.jpg'),
              ('tiger', 'tigre', 1, '../img/tigre.jpg'),
              ('elephant', 'elefante', 1, '../img/elefante.jpg');

INSERT INTO usuario (nombre, contrasenia, tipo)
VALUES ('2dawET', '1234', 'a'),
        ('federico', '12345', 'u'),
        ('Miguel', '1234', 'a'),
        ('Isabel', '12345', 'a'),
        ('Manuel', '1234', 'u');

              