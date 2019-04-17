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
              <li class="active"><a href="add_actor_director.php">Add Actor/Director</a></li>
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
    <h3> Add New Actor/Director </h3><hr>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET"><!-- Form to collect user input to add actor/director -->
      <label class="radio-inline">
        <input type="radio" name="optradio1" value="Actor">Actor
      </label>
      <label class="radio-inline">
        <input type="radio" name="optradio1" value="Director">Director
      </label>
      <div class="form-group">
        <label for="firstName">First Name:</label>
        <input type="text" class="form-control" placeholder="Enter first name" name="firstName">
      </div>
      <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input type="text" class="form-control" placeholder="Enter last name" name="lastName">
      </div>
      <label class="radio-inline">
        <input type="radio" name="optradio2" value="Male">Male
      </label>
      <label class="radio-inline">
        <input type="radio" name="optradio2" value="Female">Female
      </label>
      <div class="form-group"><!-- Date of birth input -->
        <label for="dateOfBirth">Date of birth:</label>
        <input type="text" class="form-control" placeholder="Enter date of birth" name="dateOfBirth">yyyy-mm-dd<br>
      </div>
      <div class="form-group"><!-- Date of death input -->
        <label for="dateOfDeath">Date of death:</label>
        <input type="text" class="form-control" placeholder="Enter date of death" name="dateOfDeath">yyyy-mm-dd (Note: leave blank if still alive)<br>
      </div>
      <button type="submit" class="btn btn-info" name="submitForm">Submit</button>
    </form><hr>
  </div>
  <?php
    $errMsg = "<u>Please correct the following errors:</u><br>"; 
    $isErr = false; 
    if(isset($_GET['submitForm'])) { // If the user submitted the form, check for input errors
      if(!isset($_GET['optradio1'])) { // User must choose Actor or Director
        $errMsg .= "- Select whether person is an actor or director.<br>";
        $isErr = true;
      }
      $regex = "/^[a-zA-Z0-9. -]+$/";
      if(empty($_GET['firstName'])) { // User must enter valid first name
        $errMsg .= "- Enter first name.<br>";
        $isErr = true;
      }
      else if (!preg_match($regex, $_GET['firstName'], $results)) {
        $errMsg .= "- Enter valid first name (i.e. containing these characters [A-Za-z0-9.- ]).<br>";
        $isErr = true;
      }
      if(empty($_GET['lastName'])) { // User must enter valid last name
        $errMsg .= "- Enter last name.<br>";
        $isErr = true;
      }
      else if(!preg_match($regex, $_GET['lastName'], $results)) {
        $errMsg .= "- Enter valid last name (i.e. containing these characters [A-Za-z0-9.- ]).<br>";
        $isErr = true;
      }
      if(!isset($_GET['optradio2'])) { // User must choose sex of the person
        $errMsg .= "- Select whether the person is male or female.<br>";
        $isErr = true;
      }
      $regex = "/(19|20)\d\d-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])/";
      if(empty($_GET['dateOfBirth'])) { // User must enter valid DOB
        $errMsg .= "- Enter date of birth.<br>";
        $isErr = true;
      }
      else { 
        if(!preg_match($regex, $_GET['dateOfBirth'], $results)) {
          $errMsg .= "- Enter valid date of birth (i.e. yyyy-mm-dd) from 1900-01-01 to present.<br>";
          $isErr = true;
        }
      }
      if(!empty($_GET['dateOfDeath'])) { // User must enter valid DOD or leave empty
        if(!preg_match($regex, $_GET['dateOfDeath'], $results)) {
          $errMsg .= "- Enter valid date of death (i.e. yyyy-mm-dd) from 1900-01-01 to present.<br>";
          $isErr = true;
        }
        if($_GET['dateOfBirth'] === $_GET['dateOfDeath']) {
          $errMsg .= "- Date of birth and date of death cannot be the same date.<br>";
          $isErr = true;
        }
      }
    }
    else { 
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
    $position = $_GET['optradio1'];
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $sex = $_GET['optradio2'];
    $dateOfBirth = $_GET['dateOfBirth'];
    if(empty($_GET['dateOfDeath'])) {
      $dateOfDeath = "NULL";
    } else {
      $dateOfDeath = $_GET['dateOfDeath'];
    }

    // Acquire the current ID of the Max Person in the DB
    $query = "SELECT id FROM MaxPersonID";
    $result = mysqli_query($conn, $query);
    if($result == false) {
      echo "Error: " . mysqli_error();
      exit(1);
    }
    $maxPersonID = mysqli_fetch_row($result);
    $newID = $maxPersonID[0] + 1;

    // If the given record doesn't already exist, then insert into the proper relation
    $updateMaxMovieID = true;
    if ($position === "Actor") {
      if ($dateOfDeath === "NULL") {
        $query = "INSERT INTO Actor (id, last, first, sex, dob, dod) SELECT * FROM (SELECT $newID, '$lastName', '$firstName', '$sex', '$dateOfBirth', NULL) as tmp WHERE NOT EXISTS ( SELECT first, last, sex, dob FROM Actor WHERE first = '$firstName' AND last = '$lastName' AND sex = '$sex' AND dob = '$dateOfBirth') LIMIT 1;";
      } 
      else {
        $query = "INSERT INTO Actor (id, last, first, sex, dob, dod) SELECT * FROM (SELECT $newID, '$lastName', '$firstName', '$sex', '$dateOfBirth', '$dateOfDeath') as tmp WHERE NOT EXISTS ( SELECT first, last, sex, dob FROM Actor WHERE first = '$firstName' AND last = '$lastName' AND sex = '$sex' AND dob = '$dateOfBirth') LIMIT 1;";
      }
    } 
    else if ($position === "Director") {
      if ($dateOfDeath === "NULL") {
        $query = "INSERT INTO Director (id, last, first, dob, dod) SELECT * FROM (SELECT $newID, '$lastName', '$firstName', '$dateOfBirth', NULL) as tmp WHERE NOT EXISTS ( SELECT first, last, dob FROM Director WHERE first = '$firstName' AND last = '$lastName' AND dob = '$dateOfBirth') LIMIT 1;";
      } 
      else {
        $query = "INSERT INTO Director (id, last, first, dob, dod) SELECT * FROM (SELECT $newID, '$lastName', '$firstName', '$dateOfBirth', '$dateOfDeath') as tmp WHERE NOT EXISTS ( SELECT first, last, dob FROM Director WHERE first = '$firstName' AND last = '$lastName' AND dob = '$dateOfBirth') LIMIT 1;";
      }
    } 
    mysqli_query($conn, $query);
    echo "<div class='container'>";
    if(mysqli_affected_rows($conn) === 0) {
      $updateMaxMovieID = false;
      echo "<div id='error-string'>";
      echo "<u>Error: The person you are trying to add already exists in our database.</u><br>";
      echo "Position: " . $position . " | Name: " . $firstName . " " . $lastName . " | Sex: " . $sex . " | Date of birth: " . $dateOfBirth . " | Date of death: " . $dateOfDeath;
      echo "</div><hr>";
    } else {
      echo "<div id='success-string'>";
      echo "Successfully added " . "(" . $newID . ") " . $sex . " " . $position . " " . $firstName . " " . $lastName . " born on " . $dateOfBirth . " died on " . $dateOfDeath . " to the " . $position . " relation.";
      echo "</div><hr>";
    }
    echo "</div>";

    if($updateMaxMovieID === true) {
      $query = "update MaxPersonID set id=$newID;";
      mysqli_query($conn, $query);
    }

    mysqli_close($conn);
  ?>
</body>
</html>