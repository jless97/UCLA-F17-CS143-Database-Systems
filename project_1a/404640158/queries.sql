/* Project Information: (10/11/17)
CS143: Project 1 (Movie Database)
File: queries.sql => SQL sample queries to test the database (CS143)
*/

-- Query 1: Names of all actors in the movie 'Death to Smoochy':
SELECT CONCAT(Actor.first, ' ', Actor.last)
FROM Actor, MovieActor, Movie
WHERE Movie.title = 'Death to Smoochy' AND Movie.id = MovieActor.mid AND Actor.id = MovieActor.aid;

-- Query 2: Count of all directors who directed at least 4 movies:
SELECT COUNT(DISTINCT md1.did) 
FROM MovieDirector AS md1, MovieDirector AS md2
WHERE md1.mid <> md2.mid AND md1.did = md2.did;

-- Additional Query 1: Names of all actors (first and last names) that were in movies with box office (i.e. totalIncome) > $17,500,000:
SELECT DISTINCT CONCAT(Actor.first, ' ', Actor.last)
FROM Sales, MovieActor, Actor
WHERE Sales.totalIncome > 17500000 AND Sales.mid = MovieActor.mid AND MovieActor.aid = Actor.id;

-- Additional Query 2: Count of female actors that have acted in Romance movies:
SELECT count(DISTINCT MovieActor.aid)
FROM MovieGenre, MovieActor, Actor
WHERE genre = 'Romance' AND MovieGenre.mid = MovieActor.mid AND MovieActor.aid = Actor.id AND Actor.sex = 'Female';
