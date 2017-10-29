/* Project Information: (10/12/17)
CS143: Project 1 (Movie Database)
Part 1A: violate.sql => Sample database modifications that violate the constraints I added to create.sql
*/

-- 1. Constraint: PRIMARY KEY(id) from Movie relation
INSERT INTO Movie VALUES(2, 'Rush Hour', 1998, 'PG-13', 'Roger Birnbaum Productions');
  -- ERROR 1062 (23000): Duplicate entry '2' for key 'PRIMARY'
  -- This statement violates the Primary Key constraint as the ID should be unique (and ID: 2 already exists)

-- 2. Constraint: CHECK(year > 1880) from Movie relation
INSERT INTO Movie VALUES(5000, 'Rush Hour', 1600, 'PG-13', 'Roger Birnbaum Productions');
  -- Note: This statement doesn't violate an error as MySQL doesn't support CHECK constraints
  -- This statement should be a violation as the CHECK constraint makes it so that movies must have the year field to be after the year 1800

-- 3. Constraint: PRIMARY KEY(id) from Actor relation
INSERT INTO Actor VALUES(68635, 'Chan', 'Jackie', 'Male', '1954-04-07', NULL);
  -- ERROR 1062 (23000): Duplicate entry '68635' for key 'PRIMARY'
  -- This statement violates the Primary Key constraint as the ID should be unique (and ID: 68635 already exists)

-- 4. Constraint: CHECK(dob < dod) from Actor relation
INSERT INTO Actor VALUES(70000, 'Sanchez', 'Rick', 'Male', '1960-01-01', '1959-01-01');
  -- Note: This statement doesn't violate an error as MySQL doesn't support CHECK constraints
  -- This statement should be a violation as the CHECK constraint makes it so that actors must have a dod (if deceased) that occurs after dob

-- 5. Constraint: FOREIGN KEY(mid) REFERENCES Movie(id) from Sales relation
INSERT INTO Sales VALUES(5001, '1', '10');
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`Sales`, CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
  -- THis statement violates the Foreign Key constraint because it is attempting to add a movie (with ID: 5001) into the Sales relation, but a movie with this ID doesn't exist in the Movie relation (which it is referencing)

-- 6. Constraint: CHECK(ticketsSold > -1) from Sales relation
INSERT INTO Sales VALUES(5002, '-10', '10');
  -- Note: This statement doesn't violate an error as MySQL doesn't support CHECK constraints
  -- This statement should be a violation as the CHECK constraint makes it so that records added to the Sales relation must have a valid number of tickets sold (i.e. > -1)

-- 7. Constraint: PRIMARY KEY(ID) from Director relation
INSERT INTO Director VALUES(68626 , 'Chan', 'Jackie', '1954-04-07', NULL);
  -- ERROR 1062 (23000): Duplicate entry '68626' for key 'PRIMARY'
  -- This statement violates the Primary Key constraint as the ID should be unique (and ID: 68626 already exists)

-- 8. Constraint: CHECK(dob < dod) from Director relation
INSERT INTO Actor VALUES(70000, 'Sanchez', 'Rick', 'Male', '1960-01-01', '1959-01-01');
  -- Note: This statement doesn't violate an error as MySQL doesn't support CHECK constraints
  -- This statement should be a violation as the CHECK constraint makes it so that actors must have a dod (if deceased) that occurs after dob

-- 9. Constraint: FOREIGN KEY(mid) REFERENCES Movie(id) from MovieGenre relation
INSERT INTO MovieGenre VALUES(5001, 'Comedy');
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
  -- This statement violates the Foreign Key constraint because it is attempting to add a movie (with ID: 5001) into the MovieGenre relation, but a movie with this ID doesn't exist in the Movie relation (which it is referencing)

-- 10. Constraint: FOREIGN KEY(mid) REFERENCES Movie(id) from MovieDirector relation
INSERT INTO MovieDirector VALUES(5001, 68626);
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
  -- This statement violates the Foreign Key constraint because it is attempting to add a movie-director (with mid: 5001) into the MovieDirector relation, but a movie with this ID doesn't exist in the Movie relation (which it is referencing)

-- 11. Constraint: FOREIGN KEY(did) REFERENCES Director(id) from MovieDirector relation
INSERT INTO MovieDirector VALUES(2, 70000);
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))
  -- This statement violates the Foreign Key constraint because it is attempting to add a movie-director pair (with did: 70000) into the MovieDirector relation, but a director with this ID doesn't exist in the Movie relation (which it is referencing)

-- 12. Constraint: FOREIGN KEY(mid) REFERENCES Movie(id) from MovieActor relation
INSERT INTO MovieActor VALUES(5001, 68635, 'Space Invader');
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
  -- This statement violates the Foreign Key constraint because it is attempting to add a tuple (with mid: 5001) into the MovieActor relation, but a movie with this ID doesn't exist in the Movie relation (which it is referencing)

-- 13. Constraint: FOREIGN KEY(aid) REFERENCES Actor(id) from MovieActor relation
INSERT INTO MovieActor VALUES(2, 70003, 'Space Invader');
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))
  -- This statement violates the Foreign Key constraint because it is attempting to add a tuple (with did: 70003) into the MovieActor relation, but an actor with this ID doesn't exist in the Actor relation (which it is referencing)

-- 14. Constraint: FOREIGN KEY(mid) REFERENCES Movie(id) from MovieRating relation
INSERT INTO MovieRating VALUES(5001, 99, 99);
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieRating`, CONSTRAINT `MovieRating_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
  -- This statement violates the Foreign Key constraint because it is attempting to add a review (with ID: 5001) into the MovieRating relation, but a movie with this ID doesn't exist in the Movie relation (which it is referencing)

-- 15. Constraint: FOREIGN KEY(mid) REFERENCES Movie(id) from Review relation
INSERT INTO Review VALUES('Jackie', '2017-10-12', 5001, 99, 'Excellent movie!');
  -- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
  -- THis statement violates the Foreign Key constraint because it is attempting to add a movie (with ID: 5001) into the Review relation, but a movie with this ID doesn't exist in the Movie relation (which it is referencing)


