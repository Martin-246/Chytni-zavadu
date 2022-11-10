DROP TABLE PERSON;
DROP TABLE SERVICE_REQUEST;
DROP TABLE TICKET;
DROP TABLE CATEGORY;

-- create
CREATE TABLE PERSON (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  PW_HASH binary(32) NOT NULL,
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
  photo varchar(255),
  lng float(10,6) NOT NULL, 
  lat float(10,6) NOT NULL,
  state_from_manager INTEGER NOT NULL,
  msg_from_manager varchar(255),
  time_created timestamp NOT NULL,
  time_modified timestamp
);

CREATE TABLE SERVICE_REQUEST(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  for_ticket INTEGER NOT NULL,
  foreign key (for_ticket) references TICKET(id),
  expected_date date,
  state INTEGER NOT NULL,
  time_spent INTEGER,
  comment_from_technic varchar(255),
  price float(10,2)
);