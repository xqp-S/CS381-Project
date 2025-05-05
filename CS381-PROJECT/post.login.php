<?php
    session_start();
    $email = false;
    $password = false;

    require_once "dbconfig.php";
        
    $db = new db();
    $db->connect();


    if (isset($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM user_tbl WHERE email = '$email' and password = '$password'";
        $result = $db->get_records($sql);
        // echo var_dump($result);
        if ($result) {
            // header('Location: homepage.php');
            // echo "asd";
            $_SESSION['usertype'] = $result[0]->user_type;
            $_SESSION['form_error'] = "nice email or password";
        } else {
            // echo "incorrect";
            $_SESSION['form_error'] = "incorrect email or password";
        }
    }




    $db->close();


?>