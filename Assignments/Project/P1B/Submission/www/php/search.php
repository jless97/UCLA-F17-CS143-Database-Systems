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
              <li><a href="add_actor_director.php">Add Actor/Director</a></li>
              <li><a href="add_movie.php">Add Movie</a></li>
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
          <li class="active"><a href="search.php">Search Database</a></li>
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
  <div class="container">
    <h3>Search Results:</h3><hr>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET"><!-- Form to collect search information -->
      <div class="form-group"><!-- Search information -->
        <label for="search">Search:</label>
        <input type="text" class="form-control" placeholder="Search actors/movies" name="search">
        <br>
        <button type="submit" class="btn btn-info" name="submitSearchForm">Submit</button>
      </div>
    </form>
  </div>
  <?php
    $processActor = $processMovie = $processSearch = false;
    $displayActor = $displayMovie = true;
    // Check if any of the three forms were submitted
    if(isset($_GET['submitActorForm'])) { 
      $processActor = true;
    } else if (isset($_GET['submitMovieForm'])) { 
      $processMovie = true;
    } else if (isset($_GET['submitSearchForm'])) {
      $processSearch = true;
    } else {
      exit();
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

    // Process-handling depending on which search was made
    if($processActor === true || $processSearch === true) {
      // Find matching actors (either first name, last name, or both)
      if($processSearch === true) {
        $result = explode(" ", $_GET['search']);
      } else {
        $result = explode(" ", $_GET['actor']);
        $displayMovie = false;
      }
      $name1 = $result[0];
      $name2 = $result[1];
      if(empty($name2)) {
        $query = "SELECT first, last, dob, dod, id FROM Actor WHERE first LIKE LOWER('%$name1%') OR last LIKE LOWER('%$name1%') ORDER BY last, first ASC, dob ASC, dod ASC;";
      } else {
        $query = "SELECT first, last, dob, dod, id FROM Actor WHERE (first LIKE LOWER('%$name1%') AND last LIKE LOWER('%$name2%')) OR (first LIKE LOWER('%$name2%') AND last LIKE LOWER('%$name1%')) ORDER BY last, first ASC, dob ASC, dod ASC;";
      }
      $actorResult = mysqli_query($conn, $query);
      if($actorResult == false) {
        echo "Error: " . mysqli_error();
        exit(1);
      }
    } 
    if ($processMovie === true || $processSearch === true) {
      // Find matching movies
      if($processSearch === true) {
        $movie = $_GET['search'];
      } else {
        $movie = $_GET['movie'];
        $displayActor = false;
      }
      $result = explode(" ", $movie);
      //$query = "SELECT title, year, id FROM Movie WHERE title LIKE LOWER('%$movie%') ORDER BY title;";
      $query = "SELECT title, year, id FROM Movie WHERE title LIKE LOWER(";
      for ($i = 0; $i < count($result); $i++) {
        if($i < (count($result) - 1)) {
          $query .= "'%" . $result[$i] . "%') AND title LIKE LOWER(";
        } else {
          $query .= "'%" . $result[$i];
        }
      }
      $query .= "%') ORDER BY title;";
      $movieResult = mysqli_query($conn, $query);
      if($movieResult == false) {
        echo "Error: " . mysqli_error();
        exit(1);
      }
    }

    /*
    <div class="container">
      <div class="row">
        <div class="col-*-*"></div>
        <div class="col-*-*"></div>
      </div>
      <div class="row">
        <div class="col-*-*"></div>
        <div class="col-*-*"></div>
        <div class="col-*-*"></div>
      </div>
      <div class="row">
        ...
      </div>
    </div>
    */

    // Print out actor information
    echo "<div class='container'>";

    if($displayActor === true) {
      echo "<hr><h4>Matching Actor Results:</h4>";
      echo "<div class='table-responsive'>";
      echo "<table class='table table-bordered table-condensed table-hover'>";
      echo "<thead><tr><td>Name</td><td>Date of Birth</td><td>Date of Death</td></tr></thead>";
      echo "<tbody>";
      while($row = mysqli_fetch_row($actorResult)) {
        $fullName = $row[0] . " " . $row[1];
        $dateOfBirth = $row[2];
        if(empty($row[3])) {
          $dateOfDeath = "N/A";
        } else {
          $dateOfDeath = $row[3];
        }
        $aid = $row[4];
        echo "<tr><td><a href='display_actor_info.php?aid=$aid'>$fullName</a></td><td>$dateOfBirth</td><td>$dateOfDeath</td>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div><hr>";
    }

    // Print out movie information
    if($displayMovie === true) {
      echo "<hr><h4>Matching Movie Results:</h4>";
      echo "<div class='table-responsive'>";
      echo "<table class='table table-bordered table-condensed table-hover'>";
      echo "<thead><tr><td>Title</td><td>Year</td></tr></thead>";
      echo "<tbody>";
      while($row = mysqli_fetch_row($movieResult)) {
        $title = $row[0];
        $year = $row[1];
        $mid = $row[2];
        echo "<tr><td><a href='display_movie_info.php?mid=$mid'>$title</a></td><td>$year</td></tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div><hr>";
    }

    echo "</div>";

    mysqli_close($conn);
  ?>  
</body>
</html>
