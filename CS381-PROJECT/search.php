<?php
    require_once "dbconfig.php";
    $title = "";
    $year = false;
    $genre = false;
    $language = false;
    $format = false;
    $age_rating = false;

    $result = false;
    
    if (isset($_GET)) {
        
        $title = $_GET["title"];

        $db = new db();
        $db->connect();

        $sql = "SELECT * FROM movie_tbl WHERE Title LIKE '%$title%'";
        if (isset($_GET["year"])) {
          $year = $_GET['year'];
          $sql = $sql . " AND year LIKE $year";
        }
        if (isset($_GET["genre"])) {
          $genre = $_GET['genre'];
          $sql = $sql . " AND genre LIKE '%$genre%'";
        }
        if (isset($_GET["age_rating"])) {
          $age_rating = $_GET['age_rating'];
          $sql = $sql . " AND Certificate LIKE '$age_rating'";
        }
        if (isset($_GET["format"])) {
          $format = $_GET['format'];
          // $sql = $sql . " AND format LIKE $format";
        }
        if (isset($_GET["language"])) {
          $language = $_GET['language'];
          // $sql = $sql . " AND language LIKE $language";
        }

        
        // echo $sql;
        $result = $db->get_records($sql);

    }

    function selectdCheck($value1,$value2)
    {
      if ($value1 == $value2) 
      {
        echo 'selected';
      } else 
      {
        echo '';
      }
      return;
    }




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
  <title>FOX cinema - Search</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="CSS/style.css">
  <link rel="stylesheet" href="CSS/w3.css"/>
  <link rel="website icon" href="images/logo.png">
</head>
<body>

  <!-- Header -->
  <header class="main-header">
    <div class="container">
      <div class="logo">
        <a href="homepage.php">
          <img src="images/logo.png" alt="FOXcinema Logo" class="logo-image" />
        </a>
      </div>
      <div class="search-container">
        <div class="search-icon"></div>
        <form action="search.php" method="GET">
            <input type="text" class="search-input" name="title" placeholder="Search for Movies" value="<?php echo $title?>"/>
            <button class="search-btn" type="submit">Search</button>
        </form>
      </div> 
      <div class="header-actions">
        <div class="location-dropdown"><span>Riyadh</span></div>
        <a href="<?php echo $redirect_page;?>" id="signin-button" class="w3-button w3-red w3-round"><?php echo $sign_msg?></a>
        <div class="menu-toggle"></div>
      </div>
    </div>
  </header>

  <!-- Filters -->
<div class="w3-container w3-padding-32 backgroundBlack">
    <h4 class="w3-text-white">Search Filters</h4>
    <form action="search.php" method="GET">
    <input type="hidden"  name="title" value="<?php echo $title?>"/>
      <div class="w3-row-padding w3-margin-top">
        <div class="w3-third">
          <label class="w3-text-white">Release Date</label>
          <select class="w3-select w3-round w3-dark-grey w3-border-0" name="year" >
            <option value="" disabled selected>Select Date</option>
            <option value="2025" <?php selectdCheck($year, '2025')?>>2025</option>
            <option value="2024" <?php selectdCheck($year, '2024')?>>2024</option>
            <option value="2023" <?php selectdCheck($year, '2023')?>>2023</option>
            <option value="2022" <?php selectdCheck($year, '2022')?>>2022</option>
            <option value="2021" <?php selectdCheck($year, '2021')?>>2021</option>
            <option value="2020" <?php selectdCheck($year, '2020')?>>2020</option>
          </select>
        </div>
        
    
        <div class="w3-third">
          <label class="w3-text-white">Genre</label>
          <select class="w3-select w3-round w3-dark-grey w3-border-0" name="genre">
            <option value="" disabled selected>Choose genre</option>
            <option value="action" <?php selectdCheck($genre, 'action')?>>Action</option>
            <option value="adventure" <?php selectdCheck($genre, 'adventure')?>>Adventure</option>
            <option value="animation" <?php selectdCheck($genre, 'animation')?>>Animation</option>
            <option value="biography" <?php selectdCheck($genre, 'biography')?>>Biography</option>
            <option value="comedy" <?php selectdCheck($genre, 'comedy')?>>Comedy</option>
            <option value="crime" <?php selectdCheck($genre, 'crime')?>>Crime</option>
            <option value="drama" <?php selectdCheck($genre, 'drama')?>>Drama</option>
            <option value="fantasy" <?php selectdCheck($genre, 'fantasy')?>>Fantasy</option>
            <option value="horror" <?php selectdCheck($genre, 'horror')?>>Horror</option>
            <option value="history" <?php selectdCheck($genre, 'history')?>>History</option>
            <option value="mystery" <?php selectdCheck($genre, 'mystery')?>>Mystery</option>
            <option value="romance" <?php selectdCheck($genre, 'romance')?>>Romance</option>
            <option value="sci-fi" <?php selectdCheck($genre, 'sci-fi')?>>Sci-Fi</option>
            <option value="sport" <?php selectdCheck($genre, 'sport')?>>Sport</option>
            <option value="thriller" <?php selectdCheck($genre, 'thriller')?>>Thriller</option>
          </select>
        </div>
    
        <div class="w3-third">
          <label class="w3-text-white">Language</label>
          <select class="w3-select w3-round w3-dark-grey w3-border-0" name="language">
            <option value="" disabled selected>Choose language</option>
            <option value="arabic" <?php selectdCheck($language, 'arabic')?>>Arabic</option>
            <option value="english" <?php selectdCheck($language, 'english')?>>English</option>
          </select>
        </div>
      </div>
    
      <div class="w3-row-padding w3-margin-top">
        <div class="w3-half">
          <label class="w3-text-white">Format</label>
          <select class="w3-select w3-round w3-dark-grey w3-border-0" name="format">
            <option value="" disabled selected>Choose format</option>
            <option value="2d" <?php selectdCheck($format, '2d')?> >2D</option>
            <option value="3d" <?php selectdCheck($format, '3d')?>>3D</option>
            <option value="imax" <?php selectdCheck($format, 'imax')?>>IMAX</option>
          </select>
        </div>
        <div class="w3-third">
          <label class="w3-text-white">Age Rating</label>
          <select class="w3-select w3-round w3-dark-grey w3-border-0" name="age_rating">
            <option value="" disabled selected>Select Rating</option>
            <option value="G" <?php selectdCheck($age_rating, 'G')?>>G</option>
            <option value="PG-13" <?php selectdCheck($age_rating, 'PG-13')?>>PG-13</option>
            <option value="R" <?php selectdCheck($age_rating, 'R')?> >R</option>
          </select>
        </div>
        
    
        <div class="w3-half w3-padding-top">
          <button class="w3-button w3-red w3-round-large w3-margin-top filters-button fullwidth">Apply Filters</button>
        </div>
      </div>
    </form>
  </div>
  
  <section class="w3-container recommended-movies">
    <div class="w3-panel">
<!-- movies area -->
      
        <?php
            if ($result) {
                 foreach ($result as $movie) {
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
        }else {
                echo "<h1>No Results</h1>";
            }
        ?>

      
    </div>
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

</body>
</html>
