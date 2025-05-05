<?php

    require_once "dbconfig.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["time_id"])) {

        $db = new db(); 
        $db->connect();

        $time_id = $_GET["time_id"];

        $sql = "SELECT * FROM booking_tbl WHERE time_id = '$time_id'";

        $result = $db->get_records($sql);

        if ($result) {
            $arr = array();
            foreach ($result as $row) {
                $arr[] = $row->seat_num;
            }
            echo json_encode(['result' => $arr]);
        } else {
            echo json_encode(['result' => ""]);
        }
        $db->close();
    }


?>