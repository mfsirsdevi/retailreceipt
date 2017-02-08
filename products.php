<?php
    session_start();
    $PageTitle = "Products";
    require_once ("include/header.php");
    require_once ("config/config.php");

    $orid = $_GET['id'];
    $hasOrder = false;
    $records = $retailobj->findData("Products", "ProductName_pt");
 ?>
  <div class="container">
    <div class="row">
      <h1 class="text-uppercase text-center">build your order</h1>
    </div>
    <div id="action-div" class="row">
      <div id="product-list" class="pull-left col-xs-6">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <th class="col-xs-3">Name</th>
              <th class="col-xs-3">Price</th>
              <th class="col-xs-3">Quantity</th>
              <th class="col-xs-3">Action</th>
            </thead>
            <tbody>
              <?php if ($records) {
                  foreach ($records as $record) { ?>
                    <tr>
                        <td class="col-xs-3"><?php echo $record->getField("ProductName_pt"); ?></td>
                        <td class="col-xs-3"><?php echo $record->getField("ProductPrice_pn"); ?></td>
                        <td class="col-xs-3">
                          <?php echo '<input id="qty'.$record->getRecordId().'" type="number" />'; ?>
                        </td>
                        <td class="col-xs-3">
                          <?php echo '<button class="btn btn-primary add-btn" id="btn'.$record->getRecordId().'" >Add</button>'; ?>
                        </td>
                    </tr>
                 <?php } ?>
             <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="order-details" class="pull-right col-xs-6">
        <?php if (!$hasOrder) { ?>
            <p>Cart is Empty</p>
        <?php } else { ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <td class="col-xs-4">Name</td>
              <td class="col-xs-4">Price</td>
              <td class="col-xs-4">Action</td>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php
    require_once ("include/footer.php");
  ?>