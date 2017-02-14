<?php
    session_start();
    require_once ("config/config.php");
    if (isset($_POST['pid']) && isset($_POST['qty']) && isset($_POST['id'])) {
        $str = $_POST['id'];
        $pid = $_POST['pid'];
        $qty = $_POST['qty'];
        preg_match_all('!\d+!', $str, $matches);
        $id = implode('', $matches[0]);
        $record = $retailobj->updateField($id, "DisplayDetails", "__kf_PId_oln", $pid);
        $records = $retailobj->updateField($id, "DisplayDetails", "Qty_oln", $qty);
        $retailobj->writeLog($qty, $retailobj->logFile);
    }
?>