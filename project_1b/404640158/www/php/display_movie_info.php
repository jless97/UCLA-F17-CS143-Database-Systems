<!-- TODO: NEED TO ASSOCIATE ACTORS TO MOVIES FROM ACTOR RELATION (NOT JUST MOVIEACTOR RELATION-->
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
  <script src="../js/bootstrap.min.js"></script></head>
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
              <li class="active"><a href="#">Search Movies</a></li>
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
          <li><a href="#">Search Movies</a></li>
        </ul>
      </li>
      <li><a href="search.php">Search Database</a></li>
    </ul>
  </div>
  <div class="container">
    <h3>Search Movie Information:</h3>
    <p>Feel free to search movie names to find out more information about them (i.e. directors, actors, company, MPAA rating, genre, etc.)</p><hr>
    <form action="<?php echo htmlspecialchars("search.php");?>" method="GET"><!-- Form to collect searches for movie information -->
      <div class="form-group"><!-- Movie information -->
        <label for="movie">Movie Search:</label>
        <input type="text" class="form-control" placeholder="Search movies" name="movie">
        <br>
        <button type="submit" class="btn btn-info" name="submitMovieForm">Submit</button>
      </div>
    </form>
  </div>
  <?php
    if(isset($_GET['mid'])) { 
      $mid = $_GET['mid'];
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

    // Print out movie information (i.e. title, company, rating, year, director, and genre)
    echo "<div class='container'>";
    echo "<hr><h4>Movie Results:</h4>";
      // Retrieve title, year, company, and rating
    $query = "SELECT title, company, year, rating FROM Movie WHERE id = $mid;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }

    $row = mysqli_fetch_row($result);
    $title = $row[0];
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-condensed table-hover'>";
    echo "<tbody>";
    echo "<tr><td><strong>Title</strong></td><td>$row[0]</td></tr>";
    echo "<tr><td><strong>User Rating Score</strong></td><td id='rating-avg'>";
      // Compute average user rating
    $query2 = "SELECT rating FROM Review WHERE mid = $mid;";
    $result2 = mysqli_query($conn, $query2);
    if($result2 == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }
    if(!mysqli_num_rows($result2)) {
        echo "This movie has yet to be reviewed.<br>";
        echo "<a href='add_movie_review.php?mid=$mid&title=$title'>Be the first to review!</a>";
    } else {
      $ratingSum = 0;
      while($row2 = mysqli_fetch_row($result2)) {
        $ratingSum += $row2[0];
      }
      $ratingAvg = round(($ratingSum / mysqli_num_rows($result2)), 2);
      echo "$ratingAvg/10";
    }
    echo "</td>";
    echo "<tr><td><strong>Company</strong></td><td>$row[1]</td></tr>";
    echo "<tr><td><strong>Year</strong></td><td>$row[2]</td></tr>";
    echo "<tr><td><strong>MPAA Rating</strong></td><td>$row[3]</td></tr>";
      // Retrieve director
    $query = "SELECT first, last FROM Director, MovieDirector WHERE mid = $mid AND MovieDirector.did = Director.id;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }
    echo "<tr><td><strong>Director</strong></td><td>";
    if(!mysqli_num_rows($result)) {
        echo "Currently not listed.";
    } else {
      while($row = mysqli_fetch_row($result)) {
        echo "$row[0] $row[1]<br>";
      }
    }
    echo "</td></tr>";
      // Retrieve genre of movie
    $query = "SELECT genre FROM MovieGenre WHERE mid = $mid;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }
    echo "<tr><td><strong>Genre</strong></td><td>";
    if(!mysqli_num_rows($result)) {
      echo "Currently not listed.";
    } else {
      while($row = mysqli_fetch_row($result)) {
        echo "$row[0]<br>";
      }
    }
    echo "</td></tr></tbody>";
    echo "</table>";
    echo "</div>";

    // Print out the actors (and their roles) in the movie
    echo "<hr><h4>Actors in the movie:</h4>";
    $query = "SELECT first, last, role, id FROM MovieActor, Actor WHERE mid = $mid AND MovieActor.aid = Actor.id;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-condensed table-hover'>";
    echo "<thead><td>Name</td><td>Role in movie</td></thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_row($result)) {
      $fullName = $row[0] . " " . $row[1];
      $role = $row[2];
      $aid = $row[3];
      echo "<tr><td><a href='display_actor_info.php?aid=$aid'>$fullName</a></td><td>$role</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    // Print out user reviews (i.e. name, time, rating, comment)
    echo "<hr><h4>Reviews and ratings for $title:</h4>";
    echo "<a href='add_movie_review.php?mid=$mid&title=$title'><button type='button' class='btn btn-success'>Write review</button></a>";
    $query = "SELECT name, time, rating, comment FROM Review where mid = $mid;";
    $result = mysqli_query($conn, $query);
    if($result == false) {
        echo "Error: " . mysqli_error();
        exit(1);
    }
    if(!mysqli_num_rows($result)) {
      echo "<br><br>Currently no reviews for this movie.<hr>";
    } else {
      while($row = mysqli_fetch_row($result)) {
        $name = $row[0];
        $time = $row[1];
        $rating = $row[2];
        $comment = $row[3];
        echo "<div class='media'>";
          echo "<div class='media-left'>";
            echo "<img src='../img/review_icon.png' class='media-object' style='width:50px'>";
          echo "</div>"; // Media Icon End
          echo "<div class='media-body'>";
            echo "<h5 id='review-header' class='media-heading'>Rating: $rating/10</h5>";
            echo "<p id='review-name'>User: $name</p>";
            echo "<p id='reviews'>Date: $time</p>";
          echo "</div>"; // Media Body End
        echo "</div>"; // Media End
        echo "<p id='review-comment'>$comment</p>";
        echo "<hr>";
      }
    }

    echo "</div>";
  ?>
</body>
</html>
