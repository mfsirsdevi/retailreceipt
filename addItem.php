<?php
    session_start();
    require_once ("config/config.php");
    $id = $_POST['id'];
    $record = $retailobj->addOrderLine($id);
    if ($record) { ?>
        <tr id="item<?php echo $record[0]->getRecordId() ?>">
            <td contenteditable="true" class="itm-name" id="name<?php echo $record[0]->getRecordId() ?>"></td>
            <td id="rate<?php echo $record[0]->getRecordId() ?>">0</td>
            <td contenteditable="true" class="itm-qty" id="qty<?php echo $record[0]->getRecordId() ?>">
            </td>
            <td>0</td>
            <td id="del<?php echo $record[0]->getRecordId() ?>">
              <button class="btn btn-danger del-row">Delete</button>
            </td>
            <input type="hidden" value="0">
        </tr>
<?php } ?>
 ?>