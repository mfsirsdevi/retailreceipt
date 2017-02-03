<?php
    require_once "retailreceipt.php";

    $database = 'retailreceipt.fmp12';
    $host = '172.16.9.62';
    $username = 'admin';
    $password = 'rsRAJA77352@';

    $retailobj = new RetailReceipt();

    $retailobj->initDB($database, $host, $username, $password);
    $retailobj->DBLogin();