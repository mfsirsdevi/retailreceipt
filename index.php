<?php
    $PageTitle = "Order List";
    require_once ("include/header.php");
    require_once "./config/config.php";

    //Initializing the database connection
    $result = $retailobj->findData("order", "date");
?>

  <div class="container">
    <div class="row">
      <h1 class="text-center text-uppercase"><strong>order list</strong></h1>
    </div>
    <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <th>Date</th>
              <th>Order No.</th>
              <th>Customer Name</th>
              <th>Total Price</th>
            </thead>
            <?php if ($result) {
                $records = $result->getRecords();
                foreach ($records as $record) { ?>
                  <tr>
                    <td><?php echo $record->getField("date"); ?></td>
                    <td><?php echo $record->getField("order_number"); ?></td>
                    <td><?php echo $record->getField("customer_name"); ?></td>
                    <td><?php echo $record->getField("total_price"); ?></td>
                  </tr>
              <?php } ?>
           <?php } ?>
          </table>
        </div>
    </div>
  </div>
<?php
    require_once ("include/footer.php");
?>
