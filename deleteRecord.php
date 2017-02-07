<?php

    // include Database connection file
    include("config/config.php");
    // get user id
    $str = $_POST['id'];
    preg_match_all('!\d+!', $str, $matches);
    $var = implode('', $matches[0]);

    // delete User
    $deleteRecords = $retailobj->deleteRecord('Order', $var);
    echo $deleteRecords;
 ?>