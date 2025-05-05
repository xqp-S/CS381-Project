<?php
require_once "dbconfig.php";
session_start();
header('Content-Type: application/json');


if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['seat_num'], $data['movie_id'], $data['time_id'])) {
        echo json_encode(["success" => false, "message" => "Missing required data"]);
        exit;
    }

    $seat = $data['seat_num'];
    $movie_id = intval($data['movie_id']);
    $time_id = intval($data['time_id']);
    $user_id = $_SESSION['user_id'];

    $db = new db();
    $conn = $db->connect();

    
    $check = $conn->prepare("SELECT * FROM booking_tbl WHERE time_id = ? AND seat_num = ?");
    $check->bind_param("is", $time_id, $seat);
    $check->execute();
    $res = $check->get_result();
    if ($res->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Seat already booked"]);
        exit;
    }

    
    $stmt = $conn->prepare("INSERT INTO booking_tbl (movie_id, user_id, time_id, seat_num) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $movie_id, $user_id, $time_id, $seat);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error"]);
    }

    $db->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
