<!DOCTYPE html>
<html lang="en">
<head>
  <title>IMDB Clone</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/icon-logo.jpg">
  <link rel="stylesheet" href="../css/project1b.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">IMDB Clone</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="../index.php">Home</a></li><!-- Home Page -->
          <li class="dropdown"><!-- Add Info To DB -->
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add To Database <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="php/add_actor_director.php">Add Actor/Director</a></li>
              <li class="active"><a href="add_movie.php">Add Movie</a></li>
              <li><a href="add_movie_review.php">Add Review</a></li>
              <li><a href="add_actor_to_movie.php">Add Actor To Movie</a></li>
              <li><a href="add_director_to_movie.php">Add Director To Movie</a></li>
            </ul>
          </li>
          <li class="dropdown"><!-- Search for Actors and Movies in DB -->
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search For Actors/Movies <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="display_actor_info.php">Search Actors</a></li>
              <li><a href="display_movie_info.php">Search Movies</a></li>
            </ul>
          </li>
          <li><a href="search.php">Search Database</a></li>
        </ul>
        <form action="<?php echo htmlspecialchars("search.php");?>" method="GET" class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default" name="submitSearchForm">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container"><!-- Links to the other pages -->
    <ul class="breadcrumb">
      <li><a href="../index.php">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add Items <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="add_actor_director.php">Add Actor/Director</a></li>
          <li><a href="add_movie.php">Add Movie</a></li>
          <li><a href="add_movie_review.php">Add Review</a></li>
          <li><a href="add_actor_to_movie.php">Add Actor To Movie</a></li>
          <li><a href="add_director_to_movie.php">Add Director To Movie</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search For Actors/Movies <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="display_actor_info.php">Search Actors</a></li>
          <li><a href="display_movie_info.php">Search Movies</a></li>
        </ul>
      </li>
      <li><a href="search.php">Search Database</a></li>
    </ul>
  </div>
  <div class="container"><!-- Header Container -->
    <h3> Add New Movie </h3><hr>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET"><!-- Form to collect user input to add movie -->
      <div class="form-group"><!-- Movie name input -->
        <label for="title">Title:</label>
        <input type="text" class="form-control" placeholder="Enter title" name="title">
      </div>
      <div class="form-group"><!-- Movie company input -->
        <label for="company">Company:</label>
        <input type="text" class="form-control" placeholder="Enter movie's company" name="company">
      </div>
      <div class="form-group"><!-- Movie year input -->
        <label for="year">Year:</label>
        <input type="text" class="form-control" placeholder="Enter movie's year of release" name="year">
      </div>
      <div class="form-group"><!-- Movie rating input -->
        <label for="rating">MPAA Rating:</label>
        <select class="form-control" name="rating">
          <option>Please select a rating</option>
          <option>G</option>
          <option>PG</option>
          <option>PG-13</option>
          <option>R</option>
          <option>NC-17</option>
        </select>
        <label for="genre">Genre (select all that apply using ctrl/shift):</label>
        <select multiple class="form-control" name="genre[]">
          <option>Action</option>
          <option>Adult</option>
          <option>Adventure</option>
          <option>Animation</option>
          <option>Comedy</option>
          <option>Crime</option>
          <option>Documentary</option>
          <option>Drama</option>
          <option>Family</option>
          <option>Fantasy</option>
          <option>Horror</option>
          <option>Musical</option>
          <option>Mystery</option>
          <option>Romance</option>
          <option>Sci-Fi</option>
          <option>Short</option>
          <option>Thriller</option>
          <option>War</option>
          <option>Western</option>
        </select>
      </div>
      <button type="submit" class="btn btn-info" name="submitForm">Submit</button>
    </form><hr>
  </div>
  <?php
    $errMsg = "<u>Please correct the following errors:</u><br>"; 
    $isErr = false; 
    if(isset($_GET['submitForm'])) { // If the user submitted the form, check for input errors
      if(empty($_GET['title'])) { // User must enter valid movie title
        $errMsg .= "- Enter movie title.<br>";
        $isErr = true;
      }
      if(empty($_GET['company'])) { // User must enter valid company name
        $errMsg .= "- Enter movie company name.<br>";
        $isErr = true;
      }
      $regex = "/(19|20)\d\d/";
      if(empty($_GET['year'])) { // User must enter valid movie year
        $errMsg .= "- Enter year movie came out.<br>";
        $isErr = true;
      }
      else { 
        if(!preg_match($regex, $_GET['year'], $results)) {
          $errMsg .= "- Enter valid year (i.e. yyyy) from 20th/21st century.<br>";
          $isErr = true;
        }
      }
      if($_GET['movie'] === "Please select a movie") {
        $errMsg .= "- Enter movie rating.<br>";
      }
      if(!isset($_GET['genre'])) {
        $errMsg .= "- Enter movie genre.<br>";
        $isErr = true;
      }
    } else {
      exit();
    }

    if($isErr == true) { // Print out the error message
      echo "<div class='container' id='error-string'>";
      echo $errMsg;
      echo "<hr></div>";
      exit(1);
    }

    // Connect to MySQL DB
    $conn = mysqli_connect("localhost", "cs143", "", "CS143");
    if (mysqli_connect_errno()) {
      echo "Failed to connect: " . mysqli_connect_error();
    }

    // Select default DB
    if (!mysqli_select_db($conn, "CS143")) {
      echo "Failed to select database.";
    }

    // Populate query attributes
    $title = $_GET['title'];
    $company = $_GET['company'];
    $year = $_GET['year'];
    $rating = $_GET['rating'];
    $genre = $_GET['genre'];

    // Acquire the current ID of the Max Person in the DB
    $query = "SELECT id FROM MaxMovieID";
    $result = mysqli_query($conn, $query);
    if($result == false) {
      echo "Error: " . mysqli_error();
      exit(1);
    }
    $maxMovieID = mysqli_fetch_row($result);
    $newID = $maxMovieID[0] + 1;

    // If the given record doesn't already exist, then insert into Movie relation
    $updateMaxMovieID = true;
    $query = "INSERT INTO Movie (id, title, year, rating, company) SELECT * FROM (SELECT $newID, '$title', '$year', '$rating', '$company') AS tmp WHERE NOT EXISTS ( SELECT title, year, rating, company FROM Movie WHERE title = '$title' AND year = '$year' AND rating = '$rating' AND company = '$company') LIMIT 1;";
    mysqli_query($conn, $query);
    echo "<div class='container'>";
    if(mysqli_affected_rows($conn) === 0) {
      $updateMaxMovieID = false;
      echo "<div id='error-string'>";
      echo "<u>Error: The movie you are trying to add already exists in our database.</u><br>";
      echo "Movie: " . $title . " | Company: " . $company . " | Year: " . $year . " | MPAA Rating: " . $rating;
      echo "</div><hr>";
    } else {
      echo "<div id='success-string'>";
      echo "Successfully added " . "(" . $newID . ") Movie: " . $title . " | Company: " . $company . " | Year: " . $year . " | MPAA Rating: " . $rating;
      echo "</div><hr>";
    }
    echo "</div>";

    // Update MovieGenre relation
    echo "<div class='container'>";
    foreach($genre as $addGenre) {
      // Movie insertion failed, so check to see if we can add genres to the existing movie
      if($updateMaxMovieID === false) {
        $query = "SELECT id FROM Movie WHERE title = '$title' AND company = '$company' AND year = '$year' AND rating = '$rating';";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $mid = $row[0];
        $query = "INSERT INTO MovieGenre (mid, genre) SELECT * FROM (SELECT $mid, '$addGenre') AS tmp WHERE NOT EXISTS (SELECT mid, genre FROM MovieGenre WHERE mid = $mid AND genre = '$addGenre') LIMIT 1;";
      } else { // Movie insertion succeeded, add new genre relations
        $query = "INSERT INTO MovieGenre (mid, genre) SELECT * FROM (SELECT $newID, '$addGenre') AS tmp WHERE NOT EXISTS (SELECT mid, genre FROM MovieGenre WHERE mid = $newID AND genre = '$addGenre') LIMIT 1;";
      }
      mysqli_query($conn, $query);
      if(mysqli_affected_rows($conn) === 0) {
        echo "<div id='error-string'>";
        echo "<u>Error: The movie you are trying to add is already related to the following genre.</u><br>";
        echo $addGenre . "<br>";
        echo "</div>";
      } else {
        echo "<div id='success-string'>";
        if($updateMaxMovieID === false) {
          echo "Successfully associated " . "(" . $mid . ") Movie: " . $title . " to " . $addGenre;
        } else {
          echo "Successfully associated " . "(" . $newID . ") Movie: " . $title . " to Genre: " . $addGenre;
        }
        echo "</div>";
      }
    }
    echo "<hr></div>";

    // Update MaxMovieID 
    if ($updateMaxMovieID === true) {
      $query = "update MaxMovieID set id=$newID;";
      mysqli_query($conn, $query);
    }

    mysqli_close($conn);
  ?>
</body>
</html>
