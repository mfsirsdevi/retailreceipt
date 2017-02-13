<?php
    session_start();
    if (isset($_POST['order']) && isset($_POST['items'])) {
        $order = json_decode($_POST['order']);
        $itemdetails = json_decode($_POST['items'], true);
        $_SESSION['order'] = $order;
        $_SESSION['items'] = $itemdetails;

    }
 ?>