-- usuarios iniciais do sistema
INSERT INTO usuario(nome,email,senha,status,perfil)
VALUES ("Aluno","aluno@mail.com","1234",1,1);
INSERT INTO usuario(nome,email,senha,status,perfil)
VALUES ("Professor","professor@mail.com","1234",1,2);
INSERT INTO usuario(nome,email,senha,status,perfil)
VALUES ("Admin","professor@mail.com","1234",1,3);

-- tipos de nomes
INSERT INTO nome_tipo_planta(status,nome)
VALUES(1,"Popular");
INSERT INTO nome_tipo_planta(status,nome)
VALUES(1,"Cientifico");
INSERT INTO nome_tipo_planta(status,nome)
VALUES(1,"Regional");