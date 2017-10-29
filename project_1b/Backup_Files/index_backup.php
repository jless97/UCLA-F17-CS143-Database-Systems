<!DOCTYPE html>
<html lang="en">
<head>
  <title>IMDB Clone</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="bootstrap.min.js"></script>
  <script src="jquery.min.js"></script>
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
        <a class="navbar-brand" href="index.php">IMDB Clone</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li><!-- Home Page -->
          <li class="dropdown"><!-- Add Info To DB -->
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add To Database <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="add_actor_director.php">Add Actor/Director</a></li>
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
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>
