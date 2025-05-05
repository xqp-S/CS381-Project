<?php

require_once "dbconfig.php";

$db = new db();
$conn = $db->connect();

if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $data = (object) json_decode($data, true);

    $username = $data->username;
    $email = $data->email;
    $password = $data->password;

    $sql = "INSERT INTO user_tbl (username, email, password) Values ('$username', '$email', '$password')";

    $result = $conn->query($sql);

    if ($result) {
        session_start();
        $_SESSION['signedin'] = 'yes';
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        
        echo json_encode(["msg_num" => "0", "msg" => "account registered succesfully"]);
    } else {
        echo json_encode(["msg_num" => "1", "msg" => "error"]);
    }
}


$db->close();
