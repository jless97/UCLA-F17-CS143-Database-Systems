CS 143: Project 1B, Date: 10/28/17
Identification:
  NAME: Jason Less
  EMAIL: jaless1997@gmail.com
  ID: 404640158
Memory Usage: 2.9MB

===================
Comments, Concerns:
(1) Things to Note About My Website:
  - I restricted the input values of each of the forms to more resemble an actual movie database website. Therefore, my website differs from the demo website as the demo allows for actions to take place on a movie database that shouldn’t exist:
    - For example, I don’t allow duplicates of records (e.g. I don’t allow movies with identical attributes (i.e. title, year, company, rating))
      - However, two movies with the same titles can exist (for example), if they have different attributes (i.e. released in different years)
    - For example, I don’t allow actors to be born before the 20th century (i.e. only dates greater than 1900-01-01)
    - There are many other examples, but I was just naming a few
  - The breadcrumb pagination at the top of the page sort of resembles a second navbar. However, the pagination is used when using small website browsers (i.e. shrunk to a small portion of the screen
  - In order to allow movie-actor and movie-director relations, the demo website used single select dropdowns. This method is incredibly inefficient, and doesn’t work well with the large amount of records (for movies and actors), and often led to the page freezing or crashing (for me). I understand that the website was just a demo, but given my skillset with frontend work (i.e. I don’t know how to use js, just html/css), I opted to use a multi-select option (and limiting the user to only selecting one of the options). 
  - Otherwise, I hope you enjoy my website! I spent a lot of time and effort working on it, but it was incredibly rewarding (in terms of gaining new skills and the finished product)! 
(2) Styling aspects:
  - To create my website, I used the Bootstrap framework
    - Thus, I am adding two folders: (1) css and (2) js => containing the .css and .js files used for bootstrap
  - I have a folder containing images that I used to style some of the aspects of my website
  - As I have little experience with js, and wanted to avoid adding more files than needed, my carousel on my homepage doesn’t have the left and right arrows. Thus, I added them as glyphicons (despite not including the proper files), and thus they are just buttons (not the actual arrows)

==============================
Description of included files:
(1) sql: Folder containing the MySQL files
  (a) create.sql: Batch (script) file that was used to create the relations for the Movie Database for this project. This file contains the attributes to include, as well as various constraints for the relations (i.e. Primary Key, Foreign Key, and Check constraints). Note that this database utilizes the InnoDB storage engine to utilize the foreign key (referential integrity) constraint.
  (b) load.sql: File that populated the relations with existing data (which was provided by the instructor)
(2) www: Folder containing all of the files used to create the website (i.e. css, js, php, img)
  (a) index.php: This file is the home page of my movie database website. It consists of a navbar at the top of the screen, which contains dropdown menus to navigate to each of the pages in the website. In addition, the navbar contains a search bar that allows for movie/actor searches. The content of the page consists of the breadcrumb form of pagination (mainly used for smaller browser windows), and a carousel of some images.
  (b) php: Folder containing the php files corresponding to each of the website pages. Note that all php pages consist of the navbar and the pagination.
    (i) add_actor_director.php: This file is the page that allows the user to add actors/directors to the movie database. It consists of a form that allows the user to input the necessary fields to insert a record into either the Actor or Director relation.
    (ii) add_movie.php: This file is the page that allows the user to add movies to the movie database. In addition, the user can add to the MovieGenre relation as well. It consists of a form that allows the user to input the necessary fields to insert a record into either the Movie or MovieGenre relation.
    (iii) add_movie_review.php: This file is the page that allows the user to add reviews to specific movies. It consists of a form that allows the user to input the necessary fields to insert a record into the Review relation. In addition, after submitting a successful review, the user can click on a link to navigate to the movie that he/she left a review for. 
    (iv) add_actor_to_movie.php: This file is the page that allows the user to add records to the MovieActor relation. It consists of the three necessary fields to add records.
    (v) add_director_to_movie.php: This file is the page that allows the user to add records to the MovieDirector relation. It consists of the two fields necessary to add records.
    (vi) display_actor_info.php: This file is the page that allows users to search for actors/actresses via an input search form. After submitting a search, the user is redirected to the search.php page to view the results.
    (vii) display_movie_info.php: This file is the page that allows users to search for movies via an input search form. After submitting a search, the user is redirected to the search.php page to view the results.
    (viii) search.php: This file is the page that allows users to search for movies/actors/actresses (and the results will be displayed below), or to display the results of an actor/actress search or movie search after being redirected to this page. The results allow for the user to click on links to see more details about the given actor/actress/movie.
  (c) css: Folder containing the styling of the website
    (i) bootstrap.min.css: The styling file for the Bootstrap framework used
    (ii) project1b.css: The styling that I added to the page
  (d) js: Folder containing the javascript added for the Bootstrap framework
    (i) bootstrap.min.js
    (ii) jquery.min.js
  (e) img: Folder containing the images used for the website
    (i) icon-logo.jpg: Shortcon icon image
    (ii) img1_movies.jpg: First image in the carousel
    (iii) img2_actors.jpg: Second image in the carousel
    (iv) img3_fast.jpg: Third image in the carousel
    (v) img4.jpg: Fourth image in the carousel
    (vi) img5_rush.jpg: Fifth image in the carousel
    (vii) review_icon.png: Image used for the user pic of those giving reviews of movies
(6) team.txt: Plain-text file that contains my UID. Note that I worked alone for this project (and thus only contains my UID)
