DROP TABLE SERVICE_REQUEST;
DROP TABLE TICKET;
DROP TABLE PERSON;
DROP TABLE CATEGORY;

-- create
CREATE TABLE PERSON (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  PW_HASH binary(64) NOT NULL,
  first_name varchar(32),
  last_name varchar(32),
  email varchar(255) NOT NULL,
  phone varchar(20),
  role varchar(20) NOT NULL
);

CREATE TABLE CATEGORY (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  description varchar(64)
);

CREATE TABLE TICKET (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  category INTEGER NOT NULL,
  foreign key (category) references CATEGORY(id),
  submitted_by INTEGER NOT NULL,
  foreign key (submitted_by) references PERSON(id),
  photo varchar(255),
  lng float(10,6) NOT NULL, 
  lat float(10,6) NOT NULL,
  state_from_manager INTEGER NOT NULL,
  msg_from_manager varchar(255),
  time_created timestamp NOT NULL,
  time_modified timestamp NOT NULL
);

CREATE TABLE SERVICE_REQUEST(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  worker_id INTEGER NOT NULL,
  foreign key (worker_id) references PERSON(id),
  for_ticket INTEGER NOT NULL,
  foreign key (for_ticket) references TICKET(id),
  description_from_manager varchar(255),
  expected_date date,
  state INTEGER NOT NULL,
  date_fixed date,
  comment_from_worker varchar(255),
  price float(10,2)
);


INSERT INTO CATEGORY (description) VALUES ("Odpadky");
INSERT INTO CATEGORY (description) VALUES ("Lampa nesvieti");
INSERT INTO CATEGORY (description) VALUES ("Poškodený chodník");
INSERT INTO CATEGORY (description) VALUES ("Poškodená cesta");
INSERT INTO CATEGORY (description) VALUES ("Spadnutý strom");
INSERT INTO CATEGORY (description) VALUES ("Problém s kanalizáciou");
INSERT INTO CATEGORY (description) VALUES ("Vrak auta");
INSERT INTO CATEGORY (description) VALUES ("Iné");


INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Anonymny","Uzivatel","user@user.com","04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb",0);
INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Jozko","Obycajny","user@fit.com","04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb",0);
INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Danko","Bezny","user2@fit.com","04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb",0);
INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Zdena","Neaktivna","user3@fit.com","04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb",0);
INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Admin","","admin@fit.com","8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918",1);
INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Petra","Veduca","manager@fit.com","6ee4a469cd4e91053847f5d3fcb61dbcc91e8f0ef10be7748da4c4a1ba382d17",2);
INSERT INTO PERSON (first_name,last_name,email,PW_HASH,role) VALUES ("Stefan","Pracujuci","worker@fit.com","87eba76e7f3164534045ba922e7770fb58bbd14ad732bbf5ba6f11cc56989e6e",3);

INSERT INTO TICKET (category,submitted_by,photo,lng,lat,state_from_manager,time_created,time_modified,msg_from_manager) VALUES (1,1,'../img/trash.jpeg',16.596216,49.225684,2,'2022-11-21 12:44:46','2022-11-23 19:01:43','Dakujeme za nahlásenie. Odpadky boli upratané.');
INSERT INTO TICKET (category,submitted_by,photo,lng,lat,state_from_manager,time_created,time_modified,msg_from_manager) VALUES (4,2,'../img/road.jpg',16.605272,49.227512,1,'2022-11-22 15:42:46','2022-11-23 19:02:13','Technik obhliadol miesto. Práca na opravách zacne zajtra.');
INSERT INTO TICKET (category,submitted_by,photo,lng,lat,state_from_manager,time_created,time_modified) VALUES (2,1,'../img/lamp.jpg',16.612346,49.231412,0,'2022-11-23 12:44:46','2022-11-23 19:03:27');

INSERT INTO SERVICE_REQUEST (worker_id,for_ticket,description_from_manager,expected_date,state,date_fixed,comment_from_worker,price)
  VALUES (6,1,'Prosím upracte smeti, ktoré sú rozsypané na ulici.','2022-11-23',2,'2022-11-23','Upratal som to.',200);
INSERT INTO SERVICE_REQUEST (worker_id,for_ticket,description_from_manager,expected_date,state,comment_from_worker)
  VALUES (6,2,'Prosím skontrolujte stav vozovky. Ak je v zlom stave, opravte ju.','2022-11-29',1,'Cesta vyžaduje opravu. Zajtra sa do toho pustím.');

 