<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM movie_tbl";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    echo "<table border='1'><tbody>";
    echo "<tr> <th>Title</th> <th>Rating</th> <th>Genre</th> <th>Runtime</th> <th>Certificate</th>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Rating'] . "</td>";
        echo "<td>" . $row['Genre'] . "</td>";
        echo "<td>" . $row['Runtime'] . "</td>";
        echo "<td>" . $row['Certificate'] . "</td>";
        echo "</tr>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();


?>