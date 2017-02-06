<?php
    $PageTitle = "Order List";
    require_once ("include/header.php");
    require_once "./config/config.php";

    //Initializing the database connection
    $records = $retailobj->findData("order", "date");
    $recordsCount = 0;
?>

  <div class="container">
    <div class="row">
      <h1 class="text-center text-uppercase"><strong>order list</strong></h1>
    </div>
    <hr/>
    <div class="row">
      <a class="btn btn-success pull-right" data-toggle="modal" data-target="#add_new_record_modal" href="#">Create Order</a>
    </div>
    <hr/>
    <div class="row">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <th class="col-xs-2">Date</th>
              <th class="col-xs-2">Order No.</th>
              <th class="col-xs-2">Customer Name</th>
              <th class="col-xs-2">Total Price</th>
              <th class="col-xs-2">Edit</th>
              <th class="col-xs-2">Delete</th>
            </thead>
            <tbody>
            <?php if ($records) {
                foreach ($records as $record) { ?>
                  <tr>
                    <td class="col-xs-2"><?php echo $record->getField("date"); ?></td>
                    <td class="col-xs-2"><?php echo $record->getField("order_number"); ?></td>
                    <td class="col-xs-2"><?php echo $record->getField("customer_name"); ?></td>
                    <td class="col-xs-2"><?php echo $record->getField("total_price"); ?></td>
                    <td class="col-xs-2">
                      <button class="edit<?php echo $record->getRecordId() ?> btn btn-warning edit-btn">Edit</button>
                    </td>
                    <td class="col-xs-2">
                      <button id="delete<?php echo $record->getRecordId() ?>" class="btn btn-danger delete-btn">Delete</button>
                    </td>
                  </tr>
              <?php $recordsCount = 1; } ?>
           <?php } ?>
            </tbody>
          </table>
        </div>
        <?php if ($recordsCount == 0) { ?>
          <p class="col-md-12 col-xs-12 col-sm-12 text-center">No Records Found</p>
        <?php } ?>
    </div>
    <div class="modal fade" id="delete_user_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete User</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete user?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary deletebt">Yes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div>
<?php
    require_once ("include/footer.php");
?>
