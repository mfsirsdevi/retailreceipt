<?php
    session_start();
    require_once ("config/config.php");
    if (isset($_POST['name']) && isset($_POST['rate'])) {
        $name = $_POST['name'];
        $rate = $_POST['rate'];
        $record = $retailobj->readRecord("Products", "==".$name);
        echo '<tr id="row'.$record[0]->getRecordId().'"><td contenteditable id="name'.$record[0]->getRecordId().'" class="data-edit itm-name">'.$record[0]->getField("ProductName_pt").'</td><td id="rate'.$record[0]->getRecordId().'">'.$record[0]->getField("ProductPrice_pn").'</td><td contenteditable id="qty'.$record[0]->getRecordId().'">0</td><td>0</td><td id="'.$record[0]->getRecordId().'"><button id="del'.$record[0]->getRecordId().'" class="btn btn-danger del-row">Delete</button></td></tr>';
    }
?>