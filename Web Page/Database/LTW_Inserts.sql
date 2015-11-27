.bail ON
.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;

/*******INCLUDES********/
.read LTW_Database.sql
/***********************/



/*******INSERTS*********/
INSERT INTO User(USERNAME, EMAIL, PASSWORD, DATANASCIMENTO) VALUES('Pigmoth', 'pigmoth@gmail.com', 'qwerty', '1995-01-03');
INSERT INTO User(USERNAME, EMAIL, PASSWORD, DATANASCIMENTO) VALUES('guilhermevpinto', 'guilhermevpinto@gmail.com', '12345', '1994-12-13');
INSERT INTO User(USERNAME, EMAIL, PASSWORD, DATANASCIMENTO) VALUES('Nutil', 'luisfigueiredos@hotmail.com', 'asdasd', '1995-04-20');

INSERT INTO EventPhoto(IDUSER, UPLOADDATE, DESCRIPTION) VALUES(1, '2015-11-17', 'Uma imagem fagoteira');
INSERT INTO EventPhoto(IDUSER, UPLOADDATE, DESCRIPTION) VALUES(2, '2015-10-12', 'Imagem');
INSERT INTO EventPhoto(IDUSER, UPLOADDATE, DESCRIPTION) VALUES(3, '2015-10-17', 'qwerty');

INSERT INTO Location(NAME, ADDRESS, DESCRIPTION) VALUES('FEUP', 'Roberto Frias', 'FEUPCaffe Spot');
INSERT INTO Location(NAME, ADDRESS, DESCRIPTION) VALUES('Estacao de Comboio S. Bento', 'Aliados', 'Pouca Terra');
INSERT INTO Location(NAME, ADDRESS, DESCRIPTION) VALUES('Metro Sto. Ovidio', 'Sto. Ovidio', 'Terminal linha amarela');

INSERT INTO EVENT(IDUSER, IDPHOTO, IDLOCATION, PRIVATE, CREATIONDATE, EVENTDATE) VALUES(1, 1, 2, 0, '2015-11-16', '2015-11-17');
INSERT INTO EVENT(IDUSER, IDPHOTO, IDLOCATION, PRIVATE, CREATIONDATE, EVENTDATE) VALUES(3, 2, 1, 1, '2015-11-10', '2015-11-14');