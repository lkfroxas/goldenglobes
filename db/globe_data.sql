DROP DATABASE IF EXISTS goldenglobes;
CREATE DATABASE goldenglobes;
USE goldenglobes;

CREATE TABLE person (
	personid SMALLINT NOT NULL IDENTITY PRIMARY KEY,	-- Unique ID for Person
	name VARCHAR(150) NOT NULL,									-- Name of Person
	gender CHAR(1) NOT NULL										-- Gender of Person: 'm'ale, 'f'emale
);

CREATE TABLE production (
	prodid SMALLINT NOT NULL IDENTITY PRIMARY KEY,	-- Unique ID for the Production
	title VARCHAR(150) NOT NULL,								-- Title of Production
	genre CHAR(1) NOT NULL,										-- Genre of Production: 'd'rama, 'c'omedy or musical, 'a'nimation
	type CHAR (1) NOT NULL										-- Type of Production: 'm'otion picture, 't'elevision
);

CREATE TABLE award (
	globeid SMALLINT NOT NULL IDENTITY PRIMARY KEY, 	-- Unique ID for the Award
	name VARCHAR(150) NOT NULL,									-- Name of the award
	genre CHAR(1) NOT NULL,										-- Genre of Production: 'd'rama, 'c'omedy or musical, 'n'one
	type CHAR (1) NOT NULL,										-- Type of Production: 'm'otion picture, 't'elevision
	recipient CHAR(1) NOT NULL									-- Recipient of the award: 'i'ndividual(s), 'p'roduction, 'b'oth
);

CREATE TABLE winner (
	nomid SMALLINT NOT NULL IDENTITY PRIMARY KEY,		-- Unique ID for Nominee
	year INT NOT NULL,									-- Year of nomination
	globeid INT NOT NULL,								-- referenced award(globeid)
	personid INT, 										-- referenced person(personid) if award(recipient) = i
	prodid INT, 										-- referenced production(prodid) if award(recipient) = p
	role VARCHAR(150), 											-- role of nominee if award(recipient) = i; 'a'ctor, 'd'irector
	song VARCHAR(150)											-- Title of song if award(name) = best song
);

INSERT INTO award(name, genre, type, recipient)
	VALUES ('Best Motion Picture - Drama','d','m','p'), 
		('Best Motion Picture - Musical or Comedy','c','m','p'), 
		('Best Director','n','m','b') , 
		('Best Actor - Motion Picture Drama','d','m','b'), 
		('Best Actor - Motion Picture Musical or Comedy','c','m','b'), 
		('Best Actress - Motion Picture Drama','d','m','b'), 
		('Best Actress - Motion Picture Musical or Comedy','c','m','b'), 
		('Best Supporting Actor - Motion Picture','n','m','b'), 
		('Best Supporting Actress - Motion Picture','n','m','b'), 
		('Best Screenplay','n','m','b'), 
		('Best Original Score','n','m','b'), 
		('Best Original Song','n','m','p'), 
		('Best Foreign Language Film','n','m','p'), 
		('Best Animated Feature Film','a','m','p'), 
		('Best Drama Series','d','t','p'), 
		('Best Comedy Series','c','t','p'), 
		('Best Actor in a Television Drama Series','d','t','b'), 
		('Best Actor in a Television Comedy Series','c','t','b'), 
		('Best Actress in a Television Drama Series','d','t','b'), 
		('Best Actress in a Television Comedy Series','c','t','b'), 
		('Best Limited Series or Motion Picture Made for Television','n','t','p'), 
		('Best Actor in a Limited Series or Motion Picture Made for Television','n','t','b'), 
		('Best Actress in a Limited Series or Motion Picture Made for Television','n','t','b'), 
		('Best Supporting Actor in a Series, Limited Series or Motion Picture Made for Television','n','t','b'), 
		('Best Supporting Actress in a Series, Limited Series or Motion Picture Made for Television','n','t','b'), 
		('Cecil B. DeMille Award', 'n', 'm', 'i');

INSERT INTO person(name, gender) -- (name, 'm' / 'f')
	VALUES 
		('Damien Chazelle','m'), 
		('Casey Affleck','m'), 
		('Ryan Gosling','m'), 
		('Isabelle Huppert','f'), 
		('Emma Stone','f'), 
		('Aaron Taylor-Johnson','m'), 
		('Viola Davis','f'), 
		('Damien Chazelle','m'), 
		('Billie Bob Thornton','m'), 
		('Donald Glover','m'), 
		('Claire Foy','f'), 
		('Tracee Ellis Ross','f'), 
		('Tom Hiddleson','m'), 
		('Sarah Paulson','f'), 
		('Hugh Laurie','m'), 
		('Olivia Colman','f'), 
		('Meryl Streep','f'), 
		('Alejandro Inarritu','m'), 
		('Leonardo DiCaprio','m'), 
		('Matt Damon','m'), 
		('Brie Larson','f'), 
		('Jennifer Lawrence','f'), 
		('Sylvester Stallone','m'), 
		('Kate Winslet','f'), 
		('Aaron Sorkin','m'), 
		('Ennio Morricone','m'), 
		('Oscar Isaac', 'm'), 
		('Gael Garcia Bernal', 'm'), 
		('Taraji P. Henson','f'), 
		('Rachel Bloom','f'), 
		('John Hamm', 'm'), 
		('Lady Gaga','f'), 
		('Christian Slator','m'), 
		('Maura Tierney','f'), 
		('Denzel Washington','m'), 
		('Eddie Redmayne','m'),
		('Julianne Moore','f'),
		('Michael Keaton','m'),
		('Amy Adams','f'),
		('J. K. Simmons','m'),
		('Patricia Arquette','f'),
		('Richard Linklater','m'),
		('Kevin Spacey','m'),
		('Ruth Wilson','f'),
		('Jeffrey Tambor','m'),
		('Gina Rodriguez','f'),
		('Maggie Gyllenhaal','f'),
		('Matt Bomer','m'),
		('Joanne Froggatt','f'),
		('George Clooney','m'),
		('Justin Hurwitz','m'),
		('Alexandre Desplat','m');

INSERT INTO production(title, genre, type) -- (title, 'd' / 'c' / 'n', 'm' / 't')
	VALUES 
		('Moonlight','d','m'), 
		('La La Land','c','m'), 
		('Manchester By The Sea','d','m'), 
		('Elle','d','m'), 
		('Nocturnal Animals','d','m'), 
		('Fences','d','m'), 
		('Zootopia','a','m'), 
		('The Crown','d','t'), 
		('Atlanta','c','t'), 
		('Goliath', 'd','t'), 
		('Black-ish', 'c','t'), 
		('The People v. O.J. Simpson: American Crime Story','d','t'), 
		('The Night Manager','d','t'), 
		('The Revenant','d','m'), 
		('The Martian','c','m'), 
		('Joy','d','m'), 
		('Creed','d','m'), 
		('Steve Jobs','d','m'), 
		('The Hateful Eight','d','m'), 
		('Spectre','d','m'), 
		('Son of Saul','d','m'), 
		('Inside Out','a','m'), 
		('Mr. Robert','d','t'), 
		('Mozart in the Jungle','c','t'), 
		('Show Me a Hero','d','t'),  
		('Empire','d','t'), 
		('Crazy Ex-Girlfriend','d','t'), 
		('Wolf Hall','t','p'),  
		('Mad Men','d','t'), 
		('American Horror Story: Hotel','d','t'), 
		('The Affair','d','t'), 
		('The Grand Budapest Hotel','c','m'),
		('The Theory of Everything','d','m'),
		('Still Alice','d','m'),
		('Birdman','c','m'),
		('Big Eyes','c','m'),
		('Whiplash','d','m'),
		('Selma','d','m'),
		('How to Train Your Dragon 2','a','m'),
		('Leviathan','d','m'),
		('Transparent','c','t'),
		('House of Cards','d','t'),
		('Jane the Virgin','c','t'),
		('Fargo','d','t'),
		('The Honourable Woman','d','t'),
		('The Normal Heart','d','t'),
		('Downton Abbey','d','t'),
		('Boyhood','d','m');

INSERT INTO winner(year, globeid, personid, prodid, role, song)
	VALUES
		(2017,1,NULL,1,NULL,NULL), 
		(2017,2,NULL,2,NULL,NULL), 
		(2017,3,1,2,'d',NULL), 
		(2017,4,2,3,'a',NULL), 
		(2017,5,3,2,'a',NULL), 
		(2017,6,4,4,'a',NULL), 
		(2017,7,5,2,'a',NULL), 
		(2017,8,6,5,'a',NULL), 
		(2017,9,7,6,'a',NULL), 
		(2017,10,8,2,NULL,NULL), 
		(2017,11,51,2,NULL,NULL), 
		(2017,12,NULL,2,NULL,'City of Stars'), 
		(2017,13,NULL,4,NULL,NULL), 
		(2017,14,NULL,7,NULL,NULL), 
		(2017,15,NULL,8,NULL,NULL), 
		(2017,16,NULL,9,NULL,NULL), 
		(2017,17,9,10,'a',NULL), 
		(2017,18,10,9,'a',NULL), 
		(2017,19,11,8,'a',NULL), 
		(2017,20,12,11,'a',NULL), 
		(2017,21,NULL,12,NULL,NULL), 
		(2017,22,13,13,'a',NULL), 
		(2017,23,14,12,'a',NULL), 
		(2017,24,15,13,'a',NULL), 
		(2017,25,16,13,'a',NULL), 
		(2017,26,17,NULL,'a',NULL), 
		(2016,1,NULL,14,NULL,NULL), 
		(2016,2,NULL,15,NULL,NULL), 
		(2016,3,18,15,'d',NULL), 
		(2016,4,19,14,'a',NULL), 
		(2016,5,20,15,'a',NULL), 
		(2016,6,21,16,'a',NULL), 
		(2016,7,22,16,'a',NULL), 
		(2016,8,23,17,'a',NULL), 
		(2016,9,24,18,'a',NULL), 
		(2016,10,25,18,NULL,NULL), 
		(2016,11,26,19,NULL,NULL), 
		(2016,12,NULL,20,NULL,"Writing's on the Wall"), 
		(2016,13,NULL,21,NULL,NULL), 
		(2016,14,NULL,22,NULL,NULL), 
		(2016,15,NULL,23,NULL,NULL), 
		(2016,16,NULL,24,NULL,NULL), 
		(2016,17,31,29,'a',NULL), 
		(2016,18,28,24,'a',NULL), 
		(2016,19,29,26,'a',NULL), 
		(2016,20,30,27,'a',NULL), 
		(2016,21,NULL,28,NULL,NULL), 
		(2016,22,27,25,'a',NULL), 
		(2016,23,32,30,'a',NULL), 
		(2016,24,33,23,'a',NULL), 
		(2016,25,34,31,'a',NULL), 
		(2016,26,35,NULL,'a',NULL), 
		(2015,1,NULL,48,NULL,NULL), 
		(2015,2,NULL,32,NULL,NULL), 
		(2015,3,42,48,'d',NULL), 
		(2015,4,36,33,'a',NULL), 
		(2015,5,38,35,'a',NULL), 
		(2015,6,37,34,'a',NULL), 
		(2015,7,39,36,'a',NULL), 
		(2015,8,40,37,'a',NULL), 
		(2015,9,41,48,'a',NULL), 
		(2015,10,18,35,NULL,NULL), 
		(2015,11,52,33,NULL,NULL), 
		(2015,12,NULL,38,NULL,'Glory'), 
		(2015,13,NULL,40,NULL,NULL), 
		(2015,14,NULL,39,NULL,NULL), 
		(2015,15,NULL,31,NULL,NULL), 
		(2015,16,NULL,41,NULL,NULL), 
		(2015,17,43,42,'a',NULL), 
		(2015,18,45,41,'a',NULL), 
		(2015,19,44,31,'a',NULL), 
		(2015,20,46,43,'a',NULL), 
		(2015,21,NULL,44,NULL,NULL), 
		(2015,22,9,44,'a',NULL), 
		(2015,23,47,45,'a',NULL), 
		(2015,24,48,46,'a',NULL), 
		(2015,25,49,47,'a',NULL), 
		(2015,26,50,NULL,'a',NULL);

DROP USER IF EXISTS globesearch;
CREATE LOGIN globesearch WITH PASSWORD = 'Turtledove1';
CREATE USER globesearch;

GRANT SELECT ON DATABASE::goldenglobes
TO globesearch;