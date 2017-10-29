/* Project Information: (10/11/17)
CS143: Project 1 (Movie Database)
Part 1A: create.sql => Batch (script) file to create relations
*/

CREATE TABLE Movie(
	id INT NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INT, 
	rating VARCHAR(10), 
	company VARCHAR(50),
	PRIMARY KEY(id),
	CHECK(year > 1880)) ENGINE=INNODB; -- As movies didn't exist before the last decade or so of the 19th century

CREATE TABLE Actor(
	id INT NOT NULL,  
	last VARCHAR(20), 
	first VARCHAR(20), 
	sex VARCHAR(6), 
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY(id),
	CHECK(dob < dod)) ENGINE=INNODB; -- DOB must be before DOD

CREATE TABLE Sales(
	mid INT,
	ticketsSold INT,
	totalIncome INT,
	FOREIGN KEY(mid) REFERENCES Movie(id),
	CHECK(ticketsSold > -1)) ENGINE=INNODB; -- Must be a positive number of tickets that are sold (a movie could potentially sell 0 tickets)

CREATE TABLE Director(
	id INT NOT NULL,
	last VARCHAR(20), 
	first VARCHAR(20), 
	dob DATE, 
	dod DATE,
	PRIMARY KEY(id),
	CHECK(dob < dod)) ENGINE=INNODB; -- DOB must be before DOD

CREATE TABLE MovieGenre(
	mid INT, 
	genre VARCHAR(20),
	FOREIGN KEY(mid) REFERENCES Movie(id)) ENGINE=INNODB;

CREATE TABLE MovieDirector(
	mid INT, 
	did INT,
	FOREIGN KEY(mid) REFERENCES Movie(id),
	FOREIGN KEY(did) REFERENCES Director(id)) ENGINE=INNODB;

CREATE TABLE MovieActor(
	mid INT, 
	aid INT, 
	role VARCHAR(50),
	FOREIGN KEY(mid) REFERENCES Movie(id),
	FOREIGN KEY(aid) REFERENCES Actor(id)) ENGINE=INNODB;

CREATE TABLE MovieRating(
	mid INT, 
	imdb INT, 
	rot INT,
	FOREIGN KEY(mid) REFERENCES Movie(id)) ENGINE=INNODB;

CREATE TABLE Review(
	name VARCHAR(20), 
	time TIMESTAMP, 
	mid INT,
	rating INT, 
	comment VARCHAR(500),
	FOREIGN KEY(mid) REFERENCES Movie(id)) ENGINE=INNODB;

CREATE TABLE MaxPersonID(
	id INT) ENGINE=INNDOB;

CREATE TABLE MaxMovieID(
	id INT) ENGINE=INNODB;
