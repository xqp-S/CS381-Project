<?php
    
    require_once "dbconfig.php";
    
    $db = new db();
    $db->connect();

    if (isset($_POST))
    {
        $data = file_get_contents("php://input");
        $data = (object) json_decode($data, true);
        $movie_id = $data->movie_id;

        $sql = "SELECT * From available_booking_date_tbl WHERE movie_id = '$movie_id'";
        $result = $db->get_records($sql);

        if ($result) {
            
            foreach ($result as $movie_date) {
                $sql = "SELECT * From available_booking_time_tbl WHERE date_id = '$movie_date->date_id'";
                
                $movie_date->time_arr = $db->get_records($sql);
            }

            echo json_encode([ 'result' => $result]);

        } else {
            echo json_encode([ 'error' => 'no result']);
        }
    }


    $db->close();

    // echo json_encode(['test' => 'hello']);

?>