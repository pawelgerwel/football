DROP TRIGGER goal_tr;
DROP TRIGGER substitute_tr;
DROP TRIGGER card_tr;
DROP TRIGGER match_player_tr;
DROP TRIGGER match_tr;
DROP TRIGGER matchday_tr;
DROP TRIGGER player_tr;
DROP TRIGGER coach_tr;
DROP TRIGGER team_tr;
DROP TRIGGER country_tr;


DROP SEQUENCE goal_seq;
DROP SEQUENCE substitute_seq;
DROP SEQUENCE card_seq;
DROP SEQUENCE match_player_seq;
DROP SEQUENCE match_seq;
DROP SEQUENCE matchday_seq;
DROP SEQUENCE player_seq;
DROP SEQUENCE coach_seq;
DROP SEQUENCE team_seq;
DROP SEQUENCE country_seq;


DROP TABLE goal;
DROP TABLE substitute;
DROP TABLE card;
DROP TABLE match_player;
DROP TABLE match;
DROP TABLE matchday;
DROP TABLE player;
DROP TABLE coach;
DROP TABLE team;
DROP TABLE country;


CREATE TABLE country
(id NUMBER(3) PRIMARY KEY,
 name VARCHAR2(50));

CREATE TABLE matchday
(id NUMBER(2) PRIMARY KEY,
 name VARCHAR2(50));

CREATE TABLE team
(id NUMBER(2) PRIMARY KEY,
 name VARCHAR2(50),
 city VARCHAR2(50),
 stadium VARCHAR2(100));

CREATE TABLE match
(id NUMBER(3) PRIMARY KEY,
 matchday_id NUMBER(2) REFERENCES matchday(id),
 home_team_id NUMBER(2) REFERENCES team(id),
 guest_team_id NUMBER(2) REFERENCES team(id),
 start_time DATE);

CREATE TABLE coach
(id NUMBER(3) PRIMARY KEY,
 first_name VARCHAR2(50),
 last_name VARCHAR2(50),
 country_id NUMBER(3) REFERENCES country(id),
 team_id NUMBER(2) REFERENCES team(id),
 type NUMBER(1));

CREATE TABLE player
(id NUMBER(3) PRIMARY KEY,
 first_name VARCHAR2(50),
 last_name VARCHAR2(50),
 country_id NUMBER(3) REFERENCES country(id),
 team_id NUMBER(2) REFERENCES team(id),
 position NUMBER(1),
 shirt_number NUMBER(2));

CREATE TABLE match_player
(id NUMBER(5) PRIMARY KEY,
 match_id NUMBER(3) REFERENCES match(id),
 player_id NUMBER(3) REFERENCES player(id),
 is_base NUMBER(1));

CREATE TABLE goal
(id NUMBER(4) PRIMARY KEY,
 match_player_id NUMBER(5) REFERENCES match_player(id),
 minute VARCHAR2(10),
 is_penalty NUMBER(1),
 is_own NUMBER(1));

CREATE TABLE substitute
(id NUMBER(4) PRIMARY KEY,
 in_match_player_id NUMBER(5) REFERENCES match_player(id),
 out_match_player_id NUMBER(5) REFERENCES match_player(id),
 minute VARCHAR2(10));

CREATE TABLE card
(id NUMBER(4) PRIMARY KEY,
 match_player_id NUMBER(5) REFERENCES match_player(id),
 minute VARCHAR2(10),
 color NUMBER(1));


CREATE SEQUENCE country_seq;
CREATE SEQUENCE matchday_seq;
CREATE SEQUENCE team_seq;
CREATE SEQUENCE match_seq;
CREATE SEQUENCE coach_seq;
CREATE SEQUENCE player_seq;
CREATE SEQUENCE match_player_seq;
CREATE SEQUENCE goal_seq;
CREATE SEQUENCE substitute_seq;
CREATE SEQUENCE card_seq;


CREATE TRIGGER country_tr
BEFORE INSERT
ON country
FOR EACH ROW
BEGIN
 :NEW.id := country_seq.NEXTVAL;
END;
/

CREATE TRIGGER matchday_tr
BEFORE INSERT
ON matchday
FOR EACH ROW
BEGIN
 :NEW.id := matchday_seq.NEXTVAL;
END;
/

CREATE TRIGGER team_tr
BEFORE INSERT
ON team
FOR EACH ROW
BEGIN
 :NEW.id := team_seq.NEXTVAL;
END;
/

CREATE TRIGGER match_tr
BEFORE INSERT
ON match
FOR EACH ROW
BEGIN
 :NEW.id := match_seq.NEXTVAL;
END;
/

CREATE TRIGGER coach_tr
BEFORE INSERT
ON coach
FOR EACH ROW
BEGIN
 :NEW.id := coach_seq.NEXTVAL;
END;
/

CREATE TRIGGER player_tr
BEFORE INSERT
ON player
FOR EACH ROW
BEGIN
 :NEW.id := player_seq.NEXTVAL;
END;
/

CREATE TRIGGER match_player_tr
BEFORE INSERT
ON match_player
FOR EACH ROW
BEGIN
 :NEW.id := match_player_seq.NEXTVAL;
END;
/

CREATE TRIGGER goal_tr
BEFORE INSERT
ON goal
FOR EACH ROW
BEGIN
 :NEW.id := goal_seq.NEXTVAL;
END;
/

CREATE TRIGGER substitute_tr
BEFORE INSERT
ON substitute
FOR EACH ROW
BEGIN
 :NEW.id := substitute_seq.NEXTVAL;
END;
/

CREATE TRIGGER card_tr
BEFORE INSERT
ON card
FOR EACH ROW
BEGIN
 :NEW.id := card_seq.NEXTVAL;
END;
/

INSERT INTO country (name)
VALUES ('Hiszpania');
INSERT INTO country (name)
VALUES ('Włochy');
INSERT INTO country (name)
VALUES ('Francja');
INSERT INTO country (name)
VALUES ('Niemcy');
INSERT INTO country (name)
VALUES ('Anglia');
INSERT INTO country (name)
VALUES ('Brazylia');
INSERT INTO country (name)
VALUES ('Argentyna');
INSERT INTO country (name)
VALUES ('Portugalia');
INSERT INTO country (name)
VALUES ('Polska');
INSERT INTO country (name)
VALUES ('Belgia');

INSERT INTO matchday (name)
VALUES ('Kolejka 1');
INSERT INTO matchday (name)
VALUES ('Kolejka 2');
INSERT INTO matchday (name)
VALUES ('Kolejka 3');
INSERT INTO matchday (name)
VALUES ('Kolejka 4');
INSERT INTO matchday (name)
VALUES ('Kolejka 5');
INSERT INTO matchday (name)
VALUES ('Kolejka 6');
INSERT INTO matchday (name)
VALUES ('Kolejka 7');
INSERT INTO matchday (name)
VALUES ('Kolejka 8');
INSERT INTO matchday (name)
VALUES ('Kolejka 9');
INSERT INTO matchday (name)
VALUES ('Kolejka 10');

INSERT INTO team (name, city, stadium)
VALUES ('Real Madryt', 'Madryt', 'Estadio Santiago Bernabeu');
INSERT INTO team (name, city, stadium)
VALUES ('FC Barcelona', 'Barcelona', 'Camp Nou');
INSERT INTO team (name, city, stadium)
VALUES ('Atletico Madryt', 'Madryt', 'Estadio Vicente Calderon');
INSERT INTO team (name, city, stadium)
VALUES ('Arsenal Londyn', 'Londyn', 'Emirates Stadium');
INSERT INTO team (name, city, stadium)
VALUES ('Manchester United', 'Manchester', 'Old Trafford');
INSERT INTO team (name, city, stadium)
VALUES ('Chelsea Londyn', 'Londyn', 'Stamford Bridge');
INSERT INTO team (name, city, stadium)
VALUES ('Bayern Monachium', 'Monachium', 'Allianz Arena');
INSERT INTO team (name, city, stadium)
VALUES ('Juventus Turyn', 'Turyn', 'Juventus Stadium');
INSERT INTO team (name, city, stadium)
VALUES ('Paris Saint Germain', 'Paryż', 'Parc des Princes');
INSERT INTO team (name, city, stadium)
VALUES ('Borussia Dortmund', 'Dortmund', 'Signal Iduna Park');

INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (1, 1, 2, TO_DATE('2017-04-08 18:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (1, 3, 4, TO_DATE('2017-04-08 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (1, 5, 6, TO_DATE('2017-04-08 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (1, 7, 8, TO_DATE('2017-04-09 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (1, 9, 10, TO_DATE('2017-04-09 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (2, 1, 3, TO_DATE('2017-04-15 18:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (2, 2, 4, TO_DATE('2017-04-15 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (2, 5, 7, TO_DATE('2017-04-15 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (2, 6, 9, TO_DATE('2017-04-16 20:00', 'yyyy-mm-dd hh24:mi'));
INSERT INTO match (matchday_id, home_team_id, guest_team_id, start_time)
VALUES (2, 8, 10, TO_DATE('2017-04-16 20:00', 'yyyy-mm-dd hh24:mi'));

INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Zinedine', 'Zidane', 3, 1, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Luis', 'Enrique', 1, 2, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Diego', 'Simeone', 7, 3, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Arsene', 'Wenger', 3, 4, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Jose', 'Mourinho', 8, 5, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Antonio', 'Conte', 2, 6, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Carlo', 'Ancelotti', 2, 7, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Massimiliano', 'Allegri', 2, 8, 0);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Hermann', 'Gerland', 4, 7, 1);
INSERT INTO coach (first_name, last_name, country_id, team_id, type)
VALUES ('Paul', 'Clement', 5, 7, 1);

INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Cristiano', 'Ronaldo', 8, 1, 3, 7);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Karim', 'Benzema', 3, 1, 3, 9);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Toni', 'Kroos', 4, 1, 2, 8);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Alvaro', 'Morata', 1, 1, 3, 21);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Sergio', 'Ramos', 1, 1, 1, 4);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Leo', 'Messi', 7, 2, 3, 10);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Neymar', 'da Silva', 6, 2, 3, 11);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Andres', 'Iniesta', 1, 2, 2, 8);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Marc-Andre', 'ter Stegen', 4, 2, 0, 1);
INSERT INTO player (first_name, last_name, country_id, team_id, position, shirt_number)
VALUES ('Javier', 'Mascherano', 7, 2, 1, 14);

INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 1, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 2, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 3, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 4, 0);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 5, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 6, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 7, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 8, 0);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 9, 1);
INSERT INTO match_player (match_id, player_id, is_base)
VALUES (1, 10, 1);

INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (1, '5', 0, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (1, '17', 1, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (5, '21', 0, 1);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (6, '35', 0, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (6, '45+1', 0, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (7, '50', 1, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (2, '59', 0, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (1, '76', 0, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (4, '87', 0, 0);
INSERT INTO goal (match_player_id, minute, is_penalty, is_own)
VALUES (4, '90+2', 0, 0);

INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (4, 1, '15');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (1, 4, '17');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (4, 2, '26');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (2, 4, '30');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (8, 2, '33');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (2, 8, '38');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (8, 10, '51');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (10, 8, '57');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (8, 9, '84');
INSERT INTO substitute (in_match_player_id, out_match_player_id, minute)
VALUES (4, 3, '84');

INSERT INTO card (match_player_id, minute, color)
VALUES (1, '14', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (2, '19', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (3, '28', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (4, '35', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (5, '50', 1);
INSERT INTO card (match_player_id, minute, color)
VALUES (6, '61', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (7, '69', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (8, '73', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (9, '80', 0);
INSERT INTO card (match_player_id, minute, color)
VALUES (9, '82', 0);

COMMIT;
