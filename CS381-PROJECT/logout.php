<?php
    session_start();

    session_unset();
    session_destroy();
    session_start();
    $_SESSION['signedin'] = 'no';


    header("Location: homepage.php");
?>