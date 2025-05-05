<?php
  
  // echo "<pre>";
  // print_r($_GET);
  // echo "</pre>";

  require_once "dbconfig.php";

  $Movie_id = $_GET['Movie_id'];

  $db = new db();
  $db->connect();
  $sql = "SELECT * FROM movie_tbl WHERE Movie_id = $Movie_id";

  $result = $db->get_records($sql);

  if ($result){
    $movie = $result[0];
    $movie->Genre = str_replace(";", ",", $movie->Genre);

  
  } else {
    echo "no movie found";
  }

  $db->close();


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
  <title><?= $movie->Title;?> - FOX cinema</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="css/w3.css" />
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
            <input type="text" class="search-input" placeholder="Search for Movies" name="title"/>
            <button class="search-btn" type="submit">Search</button>
        </form>
      </div>
      <div class="header-actions">
        <div class="location-dropdown"><span>Umlij</span></div>
        <a href="<?php echo $redirect_page;?>" id="signin-button" class="w3-button w3-red w3-round"><?php echo $sign_msg?></a>
        <div class="menu-toggle"></div>
      </div>
    </div>
  </header>

 
  <div class="movie-container">
    <div class="container">
      <div class="w3-row movie-main">
        <!-- Movie Poster -->
        <div class="w3-col l3 m4 s12">
          <div class="movie-poster-large">
            <img src="images/movies/<?php echo $movie->Movie_id?>.jpg" alt="John Wick" class="poster-img">
          </div>
        </div>
        
       
        <div class="w3-col l9 m8 s12">
          <div class="movie-details">
            <input type="hidden" id="movie_id" value="<?php echo $Movie_id?>">
            <h1 class="movie-title"><?php echo $movie->Title?></h1>
            <div class="movie-meta">
              <span class="movie-rating">★ <?php echo $movie->Rating?>/10</span>
              <span class="movie-duration"><?php echo $movie->Runtime?> min</span>
              <span class="movie-genre"><?php echo $movie->Genre?></span>
            </div>
            <p class="movie-description">
            <?php echo $movie->Description?>
            </p>
            <div class="movie-buttons">
              <button class="w3-button w3-red book-btn">Book Tickets</button>
              <button class="w3-button w3-dark-grey trailer-btn" onclick = "window.location.href = '<?php echo $movie->URL?>'">Watch Trailer</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Showtimes -->
      <div class="showtimes-section" id="showtimes">
        <h2 class="section-title">Showtimes</h2>
        <h2 id="ErrMsg">No Available Showtimes</h2>
        <!-- <div class="date-btn active">Today</div>
        <div class="cinema-location">
          <div class="time-slots">
            <button class="time-slot">10:30 AM</button>
            <button class="time-slot">1:45 PM</button>
            <button class="time-slot">5:00 PM</button>
            <button class="time-slot">8:15 PM</button>
            <button class="time-slot">10:30 PM</button>
          </div>
        </div> -->



        
      </div>
    </div>
  </div>

  <!-- Footer -->
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

  <script>
      window.onload = () => {
        let movie_id = document.getElementById("movie_id").value;
        fetch("get.movie.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            movie_id : movie_id
          })
        }).then(res => res.json()).then(data => {
          if (data.error) {
            console.log(data.error)
            return;
          }
          document.getElementById("ErrMsg").remove();
          dates_arr = data.result;
          console.log(dates_arr)
          
          showtimes = document.getElementById("showtimes");


          dates_arr.forEach(date=> {
            dateElement = document.createElement("div");
            dateElement.classList.add("date-btn"); 
            dateElement.classList.add("active");
            dateElement.textContent = date.date;
            
            showtimes.appendChild(dateElement);

            timeSlotsElement = document.createElement("div");
            timeSlotsElement.classList.add("time-slots");
            
            

            
            date.time_arr.forEach(time => {
              timeElement = document.createElement("button");
              timeElement.classList.add("time-slot");
              timeElement.textContent = time.time;

              timeSlotsElement.appendChild(timeElement);


              timeElement.addEventListener("click", () => {
              window.location.href = "booking.php?" + "movie_id=" + movie_id + "&time_id=" + time.time_id
              })
            })

            loctionElement = document.createElement("div");
            loctionElement.classList.add("cinema-location");
            loctionElement.appendChild(timeSlotsElement); 
            showtimes.appendChild(loctionElement)
            
          })


        })
      }
  </script>

</body>
</html>