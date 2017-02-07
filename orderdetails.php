<?php
    session_start();
    $PageTitle = "Items List";
    require_once ("include/header.php");
    require_once "./config/config.php";

    //Finding the data
    $rid = $_GET['rid'];
    $records = $retailobj->findRelatedPortal("Order", $rid, "List_ODL");
    $totalPrice = $retailobj->getFieldData("Order", $rid, "OrderTotal_ct");
?>

  <div class="container">
      <div class="row"><h2 class="text-uppercase text-center">Order Details</h2></div>
      <div class="row">
        <hr>
      </div>
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <th>Item Number</th>
              <th>Quantity</th>
              <th>Price</th>
            </thead>
            <?php if ($records) {
                foreach ($records as $record) { ?>
                    <tr>
                      <td><?php echo $record->getField("List_ODL::__kf_PId_oln") ?></td>
                      <td><?php echo $record->getField("List_ODL::Qty_oln") ?></td>
                      <td><?php echo $record->getField("List_ODL::TotalPrice_ct") ?></td>
                    </tr>
               <?php } ?>
      <?php } ?>
          </table>
      </div>
      <div class="row">
        <p>Total Price:
        <span>
          <?php if ($totalPrice) {
            echo "$totalPrice";
          } else {
            echo "0";
            } ?>
        </span>
        </p>
      </div>
  </div>
  <?php
      require_once "include/footer.php";
   ?>