<?php
    if (isset($_POST['id']) && isset($_POST['tbl'])) {
        // include Database connection file
        include("config/config.php");
        // get user id
        $str = $_POST['id'];
        $tbl = $_POST['tbl'];
        preg_match_all('!\d+!', $str, $matches);
        $var = implode('', $matches[0]);

        // delete User
        $deleteRecords = $retailobj->deleteRecords($tbl, $var);
        echo $deleteRecords;
    }
 ?>