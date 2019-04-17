<!DOCTYPE html>
<html lang="en">
<head>
  <title>IMDB Clone</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/icon-logo.jpg">
  <link rel="stylesheet" href="css/project1b.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-inverse"><!-- Navigation Bar -->
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
          <li class="active"><a href="index.php">Home</a></li><!-- Home Page -->
          <li class="dropdown"><!-- Add Info To DB -->
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add To Database <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="php/add_actor_director.php">Add Actor/Director</a></li>
              <li><a href="php/add_movie.php">Add Movie</a></li>
              <li><a href="php/add_movie_review.php">Add Review</a></li>
              <li><a href="php/add_actor_to_movie.php">Add Actor To Movie</a></li>
              <li><a href="php/add_director_to_movie.php">Add Director To Movie</a></li>
            </ul>
          </li>
          <li class="dropdown"><!-- Search for Actors and Movies in DB -->
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search For Actors/Movies <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="php/display_actor_info.php">Search Actors</a></li>
              <li><a href="php/display_movie_info.php">Search Movies</a></li>
            </ul>
          </li>
          <li><a href="php/search.php">Search Database</a></li>
        </ul>
        <form action="<?php echo htmlspecialchars("php/search.php");?>" method="GET" class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default" name="submitSearchForm">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container"><!-- Carousel of Images -->
    <h2>CS143 Movie Database System</h2><hr>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>
      <!-- Warpper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="img/img1_movies.jpg" alt="Tons of movies" style="width:100%;">
          <div class="carousel-caption">
            <h3>Browse</h3>
            <p>the wide variety of movies we have to offer.</p>
          </div>
        </div>
        <div class="item">
          <img src="img/img2_actors.jpg" alt="Famous actors" style="width:100%;">
          <div class="carousel-caption">
            <h3>Skim</h3>
            <p>through our database of famous actors.</p>
          </div>
        </div>
        <div class="item">
          <img src="img/img3_fast.jpg" alt="Fast 6" style="width:100%;">
          <div class="carousel-caption">
            <h3>Contribute</h3>
            <p>by adding reviews of movies.</p>
          </div>
        </div>
        <div class="item">
          <img src="img/img4.jpg" alt="Expendables" style="width:100%;">
          <div class="carousel-caption">
            <h3>Learn</h3>
            <p>which movies your favorite actors are in.</p>
          </div>
        </div>
        <div class="item">
          <img src="img/img5_rush.jpg" alt="Rush Hour" style="width:100%;">
          <div class="carousel-caption">
            <h3>Check out</h3>
            <p>who directed your favorite movies.</p>
          </div>
        </div>
      </div>
      <!-- Left and Right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="container"><!-- Links to the other pages -->
    <ul class="breadcrumb">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Add Items <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="php/add_actor_director.php">Add Actor/Director</a></li>
          <li><a href="php/add_movie.php">Add Movie</a></li>
          <li><a href="php/add_movie_review.php">Add Review</a></li>
          <li><a href="php/add_actor_to_movie.php">Add Actor To Movie</a></li>
          <li><a href="php/add_director_to_movie.php">Add Director To Movie</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search For Actors/Movies <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="php/display_actor_info.php">Search Actors</a></li>
          <li><a href="php/display_movie_info.php">Search Movies</a></li>
        </ul>
      </li>
      <li><a href="php/search.php">Search Database</a></li>
    </ul>
  </div>
</body>
</html>
