<?php
    session_start();
    $PageTitle = "Items List";
    require_once ("include/header.php");
    require_once "./config/config.php";

    //Finding the data
    $rid = $_GET['rid'];
    $records = $retailobj->findRelatedPortal("order", $rid, "item");
?>

  <div class="container">
      <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td>Item Number</td>
              <td>Name</td>
              <td>Quantity</td>
              <td>Price</td>
            </tr>
            <?php if ($records) {
                foreach ($records as $record) { ?>
                    <tr>
                      <td><?php echo $record->getField("item_number") ?></td>
                      <td><?php echo $record->getField("item::item_name") ?></td>
                      <td><?php echo $record->getField("item::item_qty") ?></td>
                      <td><?php echo $record->getField("item::item_price") ?></td>
                    </tr>
               <?php } ?>
      <?php } ?>
          </table>
      </div>
  </div>
  <?php
      require_once "include/footer.php";
   ?>