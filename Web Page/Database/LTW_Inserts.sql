.bail ON
.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;

/*******INCLUDES********/
.read LTW_Database.sql
/***********************/


CREATE TRIGGER connectEventUser
	AFTER INSERT ON Event
	BEGIN
	INSERT INTO EventUser(idEvent, idUser) VALUES(New.id, New.idHost);
	END;

CREATE TRIGGER deleteUser
	BEFORE DELETE ON User
	BEGIN
	DELETE FROM EventUser WHERE EventUser.idEvent = Event.id AND Event.idHost = old.id;
	DELETE FROM EventUser WHERE EventUser.idUser = old.id;
	DELETE FROM Event WHERE Event.idHost = old.id;
	END;



/*******INSERTS*********/
/*passwords: qwerty, 12345, asdasd*/
INSERT INTO Photo(URL) VALUES('../Resources/ProfilePics/defaultProfilePic.png');
INSERT INTO Photo(URL) VALUES('../Resources/ProfilePics/gustavo.jpg');
INSERT INTO Photo(URL) VALUES('../Resources/ProfilePics/eunasciaqui.png');
INSERT INTO Photo(URL) VALUES('../Resources/ProfilePics/carreira.png');

/*passwords: qwerty, 12345, asdasd*/
INSERT INTO User(USERNAME, FULLNAME, EMAIL, PASSWORD, DATANASCIMENTO, IDPHOTO) VALUES('Pigmoth', 'Daniel Silva Reis', 'pigmoth@gmail.com', '$2y$10$Pjnde6rRKvo4mDaQmWNYme1K6wqWbeoM/Asq6uGLMvqm4ms1eOqyq', '1995-01-03', 1); 
INSERT INTO User(USERNAME, FULLNAME, EMAIL, PASSWORD, DATANASCIMENTO, IDPHOTO) VALUES('guilhermevpinto', 'Guilherme Vieira Pinto', 'guilhermevpinto@gmail.com', '$2y$10$x7HX5nnwJaOhNfmEL5irx.dEnhmapRMzcS.76hC2H.dDTXmW8EpSG', '1994-12-13', 1);
INSERT INTO User(USERNAME, FULLNAME, EMAIL, PASSWORD, DATANASCIMENTO, IDPHOTO) VALUES('Nutil', 'Luis Ramos Pinto de Figueiredo', 'luisfigueiredos@hotmail.com', '$2y$10$ZOAtLO0TM04rgulbkuXcJO3AciQSc7blNs.ThNs81jUPm.uUuGNAu', '1995-04-20', 1);



/*eventos publicos*/
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(1,'Publico1', 'Evento Awesome1', 1, 'jardim', 0, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Publico2', 'Evento Awesome2', 1, 'jardim1', 0, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Publico3', 'Evento Awesome3', 1, 'jardim2', 0, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Publico4', 'Evento Awesome4', 1, 'jardim3', 0, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Publico5', 'Evento Awesome5', 1, 'jardim4', 0, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Publico6', 'Evento Awesome6', 1, 'jardim5', 0, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Publico7', 'Evento Awesome7', 1, 'jardim6', 0, '2015-11-16', '2015-11-17', 'Party');

/*eventos privados*/
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(3,'Privado1', 'Evento Awesome8', 1, 'jardim7', 1, '2015-11-10', '2015-11-14', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Privado2', 'Evento Awesome9', 1, 'jardim8', 1, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Privado3', 'Evento Awesome10', 1, 'jardim9', 1, '2015-11-16', '2015-11-17', 'Party');
INSERT INTO Event(IDHOST,DESCRIPTION, NAME, IDPHOTO, LOCATION, PRIVATE, CREATIONDATE, EVENTDATE, TYPE) VALUES(2,'Privado4', 'Evento Awesome11', 1, 'jardim10', 1, '2015-11-16', '2015-11-17', 'Party');

/*pigmoth*/
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(2, 1);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(3, 1);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(8, 1);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(9, 1);

/*guilhermevpinto*/
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(1, 2);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(8, 2);

/*Nutil*/
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(1, 3);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(5, 3);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(9, 3);
INSERT INTO EventUser(IDEVENT, IDUSER) VALUES(10, 3);