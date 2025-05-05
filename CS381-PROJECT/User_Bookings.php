<?php

session_start();
if (!isset($_SESSION['user_id'])) {
  echo '
  <script>
      alert("Please log in to view your bookings.");
      window.location.href = "login.php";
  </script>
  ';
  exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

$sql = "SELECT b.booking_id, m.Title AS movie_title, t.time, b.seat_num
        FROM booking_tbl b
        JOIN movie_tbl m ON b.movie_id = m.Movie_id
        JOIN available_booking_time_tbl t ON b.time_id = t.time_id
        WHERE b.user_id = $user_id";


$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>User Bookings</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="CSS/User_Bookings.css">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="website icon" href="images/logo.png">
</head>
<body>

  <div class="w3-bar-item w3-padding admin-header">
    <span class="w3-bar-item"> <a href="homepage.php an" class="aNoDecoration"> <img src="images/logo.png" class="logo-img" alt="Logo"> </a></span>
    <a href="logout.php" id="signin-button" class="w3-button w3-red w3-round">Sign out</a>
  </div>

  <div class="w3-container booking-section">
    <h2 class="w3-border-bottom w3-padding">My Bookings</h2>

    <div class="w3-card w3-white booking-card">
      <table class="w3-table-all booking-table">
        <thead>
          <tr>
            <th>Movie</th>
            <th>Time</th>
            <th>Seats</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo htmlspecialchars($row['movie_title']); ?></td>
                <td><?php echo htmlspecialchars($row['time']); ?></td>
                <td><?php echo htmlspecialchars($row['seat_num']); ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No bookings found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>

</body>

</html>

<?php
$conn->close();
?>