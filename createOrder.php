<?php
    session_start();
    if(isset($_POST['name']) && isset($_POST['odate']) && isset($_POST['phone'])) {
        // include Database connection file
        include("./config/config.php");

        // get values
        $name = $retailobj->Sanitize($_POST['name']);
        $odate = $retailobj->Sanitize($_POST['odate']);
        $phone = $retailobj->Sanitize($_POST['phone']);
        $record = $retailobj->createOrder('Order', $name, $odate, $phone);
    }
?>