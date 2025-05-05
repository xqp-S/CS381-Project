<?php
session_start();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== 'Admin') {
    echo '<script>alert("Admins only. Please log in as admin."); window.location.href = "login.php";</script>';
    exit;
}

    


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinema_db";

$conn = new mysqli($servername, $username, $password, $dbname);

$test = false;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['action']) && $_POST['action'] == 'add_movie') {
    $test = true;
    $stmt = $conn->prepare("INSERT INTO movie_tbl (Title, Rating, Year, Month, Certificate, Runtime, Directors, Stars, Genre, Image_path, Description, Language, Format, URL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssssssssssss", $_POST['title'], $_POST['rating'], $_POST['year'], $_POST['month'], $_POST['certificate'], $_POST['runtime'], $_POST['directors'], $_POST['stars'], $_POST['genre'], $_POST['image_path'], $_POST['description'], $_POST['language'], $_POST['format'], $_POST['url']);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}


if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM movie_tbl WHERE Movie_id = $id");
    header("Location: admin.php");
    exit();
}


if (isset($_POST['action']) && $_POST['action'] == 'update_movie') {
    $stmt = $conn->prepare("UPDATE movie_tbl SET Title=?, Rating=?, Year=?, Month=?, Certificate=?, Runtime=?, Directors=?, Stars=?, Genre=?, Image_path=?, Description=?, Language=?, Format=?, URL=? WHERE Movie_id=?");
    $stmt->bind_param("sdssssssssssssi", $_POST['title'], $_POST['rating'], $_POST['year'], $_POST['month'], $_POST['certificate'], $_POST['runtime'], $_POST['directors'], $_POST['stars'], $_POST['genre'], $_POST['image_path'], $_POST['description'], $_POST['language'], $_POST['format'], $_POST['url'], $_POST['movie_id']);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}


$result = $conn->query("SELECT * FROM movie_tbl");


$edit_movie = null;
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $res = $conn->query("SELECT * FROM movie_tbl WHERE Movie_id = $edit_id");
    $edit_movie = $res->fetch_assoc();
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="CSS/style.css">
  <link rel="stylesheet" href="CSS/admin.css">
  <link rel="website icon" href="images/logo.png">
</head>
<body>
<header class="main-header">
    <div class="container">
      <span class="w3-bar-item w3-bold"> <a href="homepage.php"><img src="images/logo.png" class="logo-img" alt="Logo"></a> Admin Dashboard</span>
      <div class="search-container">
        <div class="search-icon"></div>
        <form action="search.php" method="GET">
            <input type="text" class="search-input" placeholder="Search for Movies" name="title"/>
            <button class="search-btn" type="submit">Search</button>
        </form>
      </div>
      <div class="header-actions">
        <div class="location-dropdown"><span>Umlij</span></div>
        <div class="header-actions">
        <a href="logout.php" class="w3-button w3-red w3-round">Sign out</a>
        <div class="menu-toggle"></div>
         </div>
        <div class="menu-toggle"></div>
      </div>
    </div>
  </header>
<div class="w3-bar-item w3-padding admin-header">
    <a href="homepage.php" style="text-decoration: none;">
    
    </a> 
    
</div>

<div class="w3-container admin-section">
    <h2 class="w3-border-bottom w3-padding">Manage Movies</h2>

    
    <div id="formSection" class="w3-card w3-white w3-padding form-container">
        <h3 id="formTitle"><?= $edit_movie ? "Update Movie" : "Add New Movie" ?></h3>
        <form method="POST" action="admin.php" id = "myForm">
            <?php if ($edit_movie): ?>
                <input type="hidden" name="action" value="update_movie">
                <input type="hidden" name="movie_id" value="<?= $edit_movie['Movie_id'] ?>">
            <?php else: ?>
                <input type="hidden" name="action" value="add_movie">
            <?php endif; ?>

            <label>Title</label>
            <input type="text" name="title" value="<?= $edit_movie['Title'] ?? '' ?>" required>

            <label>Rating</label>
            <input type="number" step="0.1" name="rating" value="<?= $edit_movie['Rating'] ?? '' ?>" required>

            <label>Year</label>
            <input type="text" name="year" value="<?= $edit_movie['Year'] ?? '' ?>" required>

            <label>Month</label>
            <input type="text" name="month" value="<?= $edit_movie['Month'] ?? '' ?>" required>

            <label>Certificate</label>
            <input type="text" name="certificate" value="<?= $edit_movie['Certificate'] ?? '' ?>" required>

            <label>Runtime</label>
            <input type="text" name="runtime" value="<?= $edit_movie['Runtime'] ?? '' ?>" required>

            <label>Directors</label>
            <input type="text" name="directors" value="<?= $edit_movie['Directors'] ?? '' ?>" required>

            <label>Stars</label>
            <input type="text" name="stars" value="<?= $edit_movie['Stars'] ?? '' ?>" required>

            <label>Genre</label>
            <input type="text" name="genre" value="<?= $edit_movie['Genre'] ?? '' ?>" required>

            <label>Image Path</label>
            <input type="text" name="image_path" value="<?= $edit_movie['Image_path'] ?? '' ?>" required>

            <label>Description</label>
            <input name="description" required value = "<?= $edit_movie['Description'] ?? '' ?>">

            <label>Language</label>
            <input type="text" name="language" value="<?= $edit_movie['Language'] ?? '' ?>" required>

            <label>Format</label>
            <input type="text" name="format" value="<?= $edit_movie['Format'] ?? '' ?>" required>

            <label>URL</label>
            <input type="text" name="url" value="<?= $edit_movie['URL'] ?? '' ?>" required>

            <label>Price</label>
            <input type="text" name="url" value="<?= $edit_movie['Price'] ?? '' ?>" required>

            <button type="submit" class="w3-button <?= $edit_movie ? 'w3-orange' : 'w3-green' ?>">
                <?= $edit_movie ? 'Update Movie' : 'Add Movie' ?>
            </button>
        </form>
    </div>

    
    <div class="w3-card w3-white w3-padding">
        <table class="w3-table-all admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $result = $conn->query("SELECT * FROM movie_tbl");
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Movie_id'] ?></td>
                    <td><?= htmlspecialchars($row['Title']) ?></td>
                    <td><?= htmlspecialchars($row['Rating']) ?></td>
                    <td><?= htmlspecialchars($row['Year']) ?></td>
                    <td class="action-buttons">
                        <a href="admin.php?edit_id=<?= $row['Movie_id'] ?>" class="edit-btn">Edit</a>
                        <a href="admin.php?delete_id=<?= $row['Movie_id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    
    <div class="w3-center add-button">
        <button onclick="showForm()" class="w3-button w3-blue">Add New Movie</button>
    </div>

</div>

<script>

window.addEventListener('DOMContentLoaded', () => {
    <?php if ($edit_movie): ?>
    document.getElementById('formSection').style.display = 'block';
    <?php endif; ?>
    
});

function showForm() {
    
    document.getElementById('formSection').style.display = 'block';
    document.getElementById('formTitle').innerText = 'Add New Movie';
    document.getElementById('formSection').scrollIntoView({ behavior: 'smooth' });
    document.getElementById('myForm').querySelectorAll("input").forEach(i => {
        i.value = ""
    })
    document.querySelector("input[name='action']").value = "add_movie"
    console.log("test")
    

}
</script>

</body>
</html>
