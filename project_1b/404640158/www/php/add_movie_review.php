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
              <li class="active"><a href="add_movie_review.php">Add Review</a></li>
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
    <h3> Add Movie Review </h3><hr>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET"><!-- Form to collect user input to add movie reviews -->
      <div class="form-group"><!-- Movie rating input -->
        <label for="movie">Movie:</label><!-- Select movie -->
        <select multiple class="form-control" name="movie[]">
          <?php
            if(isset($_GET['title'])) { 
              $title = $_GET['title'];
              $mid = $_GET['mid'];
              echo "<option selected='selected' value=$mid>$title</option>";
            } else {
              // Connect to MySQL DB
              $conn = mysqli_connect("localhost", "cs143", "", "CS143");
              if (mysqli_connect_errno()) {
                echo "Failed to connect: " . mysqli_connect_error();
              }

              // Select default DB
              if (!mysqli_select_db($conn, "CS143")) {
                echo "Failed to select database.";
              }

              $query = "SELECT id, title, year FROM Movie ORDER BY title;";
              $result = mysqli_query($conn, $query);
              if($result == false) {
                echo "Error: " . mysqli_error();
                exit(1);
              }
              while($row = mysqli_fetch_assoc($result)) {
                echo "<option value=" . $row['id'] . ">" . $row['title'] . " (" . $row['year'] . ")</option>";
              }
            }
          ?>
        </select>
      </div>
      <div class="form-group"><!-- User name -->
        <label for="name">Name:</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="name">
      </div>
      <div class="form-group"><!-- Movie rating -->
        <label for="rating">Rating:</label>
        <select class="form-control" name="rating">
          <option>Please select a rating</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
        </select>
      </div>
      <div class="form-group">
        <label for="comment">Comment (Optional):</label>
        <textarea class="form-control" placeholder="Max 500 Characters" rows="5" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-info" name="submitForm">Submit</button>
    </form><hr>
  </div>
  <?php
    $errMsg = "<u>Please correct the following errors:</u><br>"; 
    $isErr = false; 
    if(isset($_GET['submitForm'])) { // If the user submitted the form, check for input errors
      if(!isset($_GET['movie'])) { // User must select a movie
        $errMsg .= "- Select a movie.<br>";
        $isErr = true;
      }
      if(count($_GET['movie']) > 1) { // User must select only 1 movie
        $errMsg .= "- Select only one movie.<br>";
        $isErr = true;
      }
      if(empty($_GET['name'])) { // User must enter their name
        $errMsg .= "- Enter your name.<br>";
        $isErr = true;
      }
      if(strlen($_GET['comment']) > 500) { // Max comment: 500 char
        $errMsg .= "- Comment cannot exceed 500 chracters.<br>";
        $isErr = true;
      }
      if($_GET['movie'] === "Please select a movie") { // User must enter movie
        $errMsg .= "- Select a movie.<br>";
        $isErr = true;
      }
      if($_GET['rating'] === "Please select a rating") { // User must enter rating
        $errMsg .= "- Select a rating.<br>";
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
    if(isset($_GET['title'])) {
      $movie = $title;
    } else { 
      $numMovies = $_GET['movie'];
      foreach($numMovies as $addMovie) {
        $movie = $addMovie;
      } 
    }
    $name = $_GET['name'];
    $rating = $_GET['rating'];
    if(empty($_GET['comment'])) {
      $comment = "";
    }
    else {
      $comment = $_GET['comment'];
    }
    $time = date('Y-m-d H:i:s');

    // Will allow users to add as many reviews for (any movie) as they like
    $query = "INSERT INTO Review (name, mid, rating, comment) SELECT * FROM (SELECT '$name', $movie, '$rating', '$comment') AS tmp WHERE NOT EXISTS (SELECT name, mid, rating, comment FROM Review WHERE  name = '$name' AND mid = $movie AND rating = '$rating' AND comment = '$comment') LIMIT 1;";
    echo "<div class='container'>";
    mysqli_query($conn, $query);
    if(mysqli_affected_rows($conn) === 0) {
      echo "<div id='error-string'>";
      echo "<u>Error: You already left this review for that movie.</u><br>";
      echo "<hr></div>";
    } else {
      echo "<div id='success-string'>Review successfully added!<br></div>";
      echo "<a href='display_movie_info.php?mid=$movie'>Click here to go to the movie</a>";
      echo "<hr></div>";
    }
    echo "</div>";
    
    mysqli_close($conn);
  ?>
</body>
</html>
