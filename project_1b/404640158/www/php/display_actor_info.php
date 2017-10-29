<!-- TODO: ADD MOVIES THAT THE ACTOR HAS DIRECTED --> 
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
              <li class="active"><a href="display_actor_info.php">Search Actors</a></li>
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
  <div class="container">
    <h3>Search Actor Information:</h3>
    <p>Feel free to search actor names to find out more information about them (i.e. roles in movies, date of birth, etc.)</p><hr>
    <form action="<?php echo htmlspecialchars("search.php");?>" method="GET"><!-- Form to collect searches for actor information -->
      <div class="form-group"><!-- Actor information -->
        <label for="actor">Actor Search:</label>
        <p>Please search in the form first-name last-name (i.e. Tom Cruise)</p>
        <input type="text" class="form-control" placeholder="Search actors" name="actor">
        <br>
        <button type="submit" class="btn btn-info" name="submitActorForm">Submit</button>
      </div>
    </form>
  </div>
  <?php
    if(isset($_GET['aid'])) { 
      $aid = $_GET['aid'];
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

    // Print out actor information (i.e. name, sex, dob, dod)
    echo "<div class='container'>";
    echo "<hr><h4>Actor Results:</h4>";
    $query = "SELECT first, last, sex, dob, dod FROM Actor WHERE id = $aid;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }

    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-condensed table-hover'>";
    echo "<thead><tr><td>Name</td><td>Sex</td><td>Date of Birth</td><td>Date of Death</td></tr></thead>";
    echo "<tbody>";
    $row = mysqli_fetch_row($result);
    $fullName = $row[0] . " " . $row[1];
    $sex = $row[2];
    $dateOfBirth = $row[3];
    if (empty($row[4])) {
      $dateOfDeath = "N/A";
    } else {
      $dateOfDeath = $row[4];
    }
    echo "<tr><td>$fullName</td><td>$sex</td><td>$dateOfBirth</td><td>$dateOfDeath</td></tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    // Print out actor's relations to movies (i.e. movies and roles)
    echo "<hr><h4>Movies that $fullName appears in:</h4>";
      // Retrieve movie id and actor's role in the movie
    $query = "SELECT mid, role FROM MovieActor WHERE aid = $aid;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-condensed table-hover'>";
    echo "<thead><tr><td>Movie</td><td>MPAA Rating</td><td>Year</td><td>Company</td><td>Role in Movie</td></tr></thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_row($result)) {
      $mid = $row[0];
      $role = $row[1];
      // Retrieve movie title, rating, year, and company
      $query = "SELECT title, rating, year, company FROM Movie WHERE id = $mid;";
      $result2 = mysqli_query($conn, $query);
      if($result2 == false) {
        echo "Error: " . mysqli_error();
        exit(1);
      }
      while($row2 = mysqli_fetch_row($result2)) {
        $title = $row2[0];
        $rating = $row2[1];
        $year = $row2[2];
        $company = $row2[3];
        echo "<tr><td><a href='display_movie_info.php?mid=$mid'>$title</td><td>$rating</td><td>$year</td><td>$company</td><td>$role</td></tr>";
      }
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<br>";

    // Print out actor's relations to directing (i.e. movies and if they directed it)
    // echo "<h4>Movies that $fullName has directed:</h4>";
    //   // Retrieve movie id of movies the actor has directed (if any)
    // $query = "SELECT mid FROM MovieDirector WHERE did = $aid;";
    // $result = mysqli_query($conn, $query);
    // if($result == false) {
    //     echo "Error: " . mysqli_error();
    //     exit(1);
    // }
    //   echo "</table>";
    // echo "<br>";

    echo "</div>";

    mysqli_close($conn);
  ?>
</body>
</html>
