CS 143: Project 1A, Date: 10/11/17
Identification:
  NAME: Jason Less
  EMAIL: jaless1997@gmail.com
  ID: 404640158

Description of included files:
(1) create.sql: Batch (script) file that was used to create the relations for the Movie Database for this project. This file contains the attributes to include, as well as various
    		constraints for the relations (i.e. Primary Key, Foreign Key, and Check constraints). Note that this database utilizes the InnoDB storage engine to utilize the
		foreign key (referential integrity) constraint.
(2) load.sql: File that populated the relations with existing data (which was provided by the instructor)
(3) queries.sql: File that contains several SQL queries to answer certain query requests.
(4) query.php: File that contains the code for the PHP page that provides the Web Query Interface to a user. This page includes an HTML form that retrieves the information from the
    	       user using the HTTP GET Method. The form is simple and contains a text area (to enter the query) and a button to submit the query request. If a valid query is input,
	       then a table containing the desired information is returned. 
(5) violate.sql: File that contains several SQL statements to insert a tuple into the already existing databases. The purpose of these statements are to violate the constraints
    		 that I put in place on the relations. Note that MySQL doesn't provide support for the CHECK constraint, so the related statements don't generate an error message.
(6) team.txt: Plain-text file that contains my UID. Note that I worked alone for this project (and thus only contains my UID)
