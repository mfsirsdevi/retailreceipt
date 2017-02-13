<?php
    session_start();
    require_once ("config/config.php");
    if (isset($_POST['order']) && isset($_POST['items'])) {
        $order = json_decode($_POST['order']);
        $itemdetails = json_decode($_POST['items'], true);
        $_SESSION['order'] = $order;
        $_SESSION['items'] = $itemdetails;
        // $result = 0;
        // $result = $retailobj->updateField($order[0],"Order", "Ordername_ot", $order[1]) ? $result++ : $result;
        // $result = $retailobj->updateField($order[0],"Order", "PhoneNum_on", $order[2]) ? $result++ : $result;
        // $result = $retailobj->updateField($order[0],"Order", "OrderTotal_ct", $order[3]) ? $result++ : $result;
        // $onum = $retailobj->getFieldData("Order",$order[0], "___kp_OrderId_on");
        // foreach ($itemdetails as $row) {
        //     $var = $row[0];
        //     $records = $retailobj->readRecord("Products", $name);
        //     $rid = $records[0]->getField("___kp_ProductId_pn");
        //     $result = $retailobj->updateField($var, "DisplayDetails", "__kf_PId_oln", $rid) ? $result++ : $result;
        //     $result = $retailobj->updateField($var, "DisplayDetails", "__kf_OId_oln", $onum) ? $result++ : $result;
        //     $result = $retailobj->updateField($var, "DisplayDetails", "Qty_oln", $row[3]) ? $result++ : $result;
        //     $result = $retailobj->updateField($var, "DisplayDetails", "TotalPrice_ct", $row[4]) ? $result++ : $result;
        // }
            echo true;
    }
 ?>