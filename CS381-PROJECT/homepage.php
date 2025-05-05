<?php
require_once "dbconfig.php";

session_start();

$sign_msg = "Sign in";
$redirect_page = "login.php";

 if (isset($_SESSION['signedin'])) {
    if ( $_SESSION['signedin'] == 'yes') {
      $sign_msg = "Sign out";
      $redirect_page = "logout.php";
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FOX cinema</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="css/w3.css" />
  <link rel="website icon" href="images/logo.png">
</head>
<body>
  <header class="main-header">
    <div class="container">
      <div class="logo">
        <a href="homepage.php">
          <img src="images/logo.png" alt="FOXcinema Logo" class="logo-image" />
        </a>
      </div>
      <div class ="My_Booking">
      <h5><a href="User_Bookings.php" class="aNoDecoration">My booking</a></h5>
      
      </div>
      <div class="search-container">
        <div class="search-icon"></div>
        <form action="search.php" method="GET">
            <input type="text" class="search-input" placeholder="Search for Movies" name="title"/>
            <button class="search-btn" type="submit">Search</button>
        </form>
      </div>
      <div class="header-actions">
        <div class="location-dropdown"><span><notsorry>Yemen</notsorry></span></div>
        <a href="<?php echo $redirect_page;?>" id="signin-button" class="w3-button w3-red w3-round"><?php echo $sign_msg?></a>
        <div class="menu-toggle"></div>
      </div>
    </div>
  </header>


  <section class="hero-banner">
    <div class="hero-slide">
      <img src="images\movies\mufasa_banner.jpg" alt="Featured Movie" class="hero-image" />
      <div class="hero-content">
        <h1 class="hero-title">Mufsa: The Lion King</h1>
        <p class="hero-description">Mufasa, a cub lost and alone, meets a sympathetic lion named Taka, the heir to a royal bloodline. The chance meeting sets in motion an expansive journey of a group of misfits searching for their destiny.</p>
        <a href="movie.php?Movie_id=130"><button class="hero-cta" >Book Now</button></a>
      </div>
    </div>
  </section>

<!-- 
  <section class="w3-container quick-booking">
    <div class="w3-panel">
      <h2>Quick Ticket Booking</h2>
      <form class="booking-form">
        <select class="booking-input">
          <option>Select Movie</option>
          <option>Avengers: Endgame</option>
          <option>John Wick</option>
          <option>The Lion King</option>
        </select>
        <select class="booking-input">
          <option>Select Date</option>
          <option>Today</option>
          <option>Tomorrow</option>
          <option>Apr 23, 2025</option>
        </select>
        <select class="booking-input">
          <option>Select Time</option>
          <option>10:00 AM</option>
          <option>1:30 PM</option>
          <option>7:00 PM</option>
        </select>
        <button class="booking-btn">Find Tickets</button>
      </form>
    </div>
  </section> -->

 
  <section class="w3-container recommended-movies" id="nowplaying-movies">
    <div class="w3-panel">
      <div class="section-header">
        <h2 class="section-title" >Now Playing</h2>
      </div>
  

     
      <div class="w3-row-padding">

        <?php
          
          $db = new db();
          $conn = $db->connect();

          $sql = "SELECT Movie_id, Title, Genre, Image_path from movie_tbl LIMIT 7";
          $array = $db->get_records($sql);

          // echo "<pre>";
          // print_r($array);
          // echo "</pre>";

          foreach ($array as $movie) {
            $movie->Genre = str_replace(";", ",", $movie->Genre);
            $genres = explode(",", $movie->Genre);
             $firstGenre = trim($genres[0]);
        ?>
        <div class="w3-col l2 m3 s6">
          <div class="movie-card-container">
          <a href="movie.php?Movie_id=<?php echo $movie->Movie_id?>" class="movie-link">
            <div class="w3-card movie-card">
              <div class="movie-poster">
                <img src="images/movies/<?php echo $movie->Movie_id?>.jpg" alt="Movie Poster" class="movie-poster-img" />
              </div>
              <div class="w3-container movie-info">
                <h3 class="movie-title"><?php echo $movie->Title?></h3>
                <p class="movie-genre">Genre: <?php echo $firstGenre?></p>
              </div>
            </div>
          </a>
          </div>
        </div>

        <?php
          }
        ?>
        
      </div>
  

      <div class="w3-container w3-center">
        <button class="w3-button w3-grey prev-arrow nav-button" onclick="slideMovies('nowplaying-movies','<')">&lt;</button>
        <button class="w3-button w3-grey next-arrow nav-button" onclick="slideMovies('nowplaying-movies','>')">&gt;</button>
      </div>
    </div>
  </section>
  
  
  <section class="w3-container recommended-movies"  id="comingsoon-movies">
    <div class="w3-panel">
      <div class="section-header">
        <h2 class="section-title">Coming Soon</h2>
      </div>
      

      <div class="w3-row-padding">

      <?php
          
          $db = new db();
          $conn = $db->connect();

          $sql = "SELECT Movie_id, Title, Genre from movie_tbl LIMIT 7 OFFSET 7";
          $array = $db->get_records($sql);

          // echo "<pre>";
          // print_r($array);
          // echo "</pre>";

          foreach ($array as $movie) {
            $movie->Genre = str_replace(";", ",", $movie->Genre);

            $genres = explode(",", $movie->Genre);
            $firstGenre = trim($genres[0]);
        ?>
        <div class="w3-col l2 m3 s6">
          <div class='movie-card-container'>
          <a href="movie.php?Movie_id=<?php echo $movie->Movie_id?>" class="movie-link">
            <div class="w3-card movie-card">
              <div class="movie-poster">
                <img src="images/movies/<?php echo $movie->Movie_id?>.jpg" alt="Movie Poster" class="movie-poster-img" />
              </div>
              <div class="w3-container movie-info">
                <h3 class="movie-title"><?php echo $movie->Title?></h3>
                <p class="movie-genre">Genre: <?php echo $firstGenre;?></p>
              </div>
            </div>
          </a>
          </div>
        </div>

        <?php
          }
        ?>

        
      </div>
      
      <div class="w3-container w3-center">
        <button class="w3-button w3-grey prev-arrow nav-button" onclick="slideMovies('comingsoon-movies','<')">&lt;</button>
        <button class="w3-button w3-grey next-arrow" onclick="slideMovies('comingsoon-movies','>')">&gt;</button>
      </div>
    </div>
  </section>

  
  <section class="newsletter">
    <h2>Stay Updated</h2>
    <p>Subscribe to our newsletter for exclusive offers, movie news, and special screenings.</p>
    <form class="newsletter-form">
      <input type="email" placeholder="Your Email Address" class="newsletter-input" required />
      <button type="submit" class="newsletter-btn">Subscribe</button>
    </form>
  </section>

  <footer class="main-footer">
    <div class="container">
      <div class="footer-content">
        <p>&copy; FOXcinema.</p>
        <ul class="footer-links">
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
        
        
        <div class="social-links">
          <a href="https://www.facebook.com/" class="social-icon"><img src="images/facebook.png" alt="facebook"></a>
          <a href="https://www.instagram.com/" class="social-icon"><img src="images/instagram.png" alt="instagram"></a>
          <a href="https://x.com/" class="social-icon"><img src="images/twitter.png" alt="x"></i></a>
          <a href="https://www.youtube.com/" class="social-icon"><img src="images/youtube.png" alt="youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <script src="JS/slide.js"></script>

</body>
</html>
<?php
$conn->close();
?>