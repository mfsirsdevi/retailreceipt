<?php
    session_start();
    /*
     * Product catalog page to visit add and delete items before checkout
     */
    $PageTitle = "Products";
    require_once ("include/header.php");
    require_once ("config/config.php");

    $id = $_GET['id'];
    $record = $retailobj->getRecord("Order", $id);
    $records = $retailobj->findRelatedPortal("Order", $id, "List_ODL");

 ?>
  <div id="wrapper" class="container">
    <div class="row">
      <h3 class="text-uppercase text-center invoice-title">invoice</h3>
    </div>
    <div class="row">
      <div class="pull-left address-details">
        <p>Mindfire</p>
        <p>Dlf cybercity</p>
        <p>Bhubaneswar</p>
      </div>
      <div class="pull-right">
        <a href="index.php">
          <img class="img-responsive img-thumbnail" src="assets/images/google.png" alt="logo">
        </a>
      </div>
    </div>
    <div class="row">
      <h4>Order Details</h4>
    </div>
    <div class="table-responsive row">
      <table class="table table-bordered">
        <thead>
          <th>Invoice #</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Date</th>
        </thead>
        <tbody>
          <tr>
            <td id="custId"><?php echo $record->getField("___kp_OrderId_on"); ?>
              <input type="hidden" value="<?php echo $record->getRecordId() ?>">
            </td>
            <td id="cust-name" class="data-edit">
              <?php echo $record->getField("OrderName_ot"); ?>
            </td>
            <td id="cust-num" class="data-edit">
              <?php echo $record->getField("PhoneNum_on"); ?>
            </td>
            <td>
              <?php echo $record->getField("OrderDate_od"); ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <h4>Item Details</h4>
    </div>
    <div class="table-responsive row">
      <table class="table table-bordered item">
        <thead>
          <th>Name</th>
          <th>Rate</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Action</th>
        </thead>
        <tbody id="item-details">
          <?php if ($records) {
              foreach ($records as $row) { ?>
          <tr id="item <?php echo $row->getRecordId() ?>">
            <td contenteditable="true" class="itm-name" id="name<?php $row->getRecordId() ?>"><?php echo $row->getField("List_ODL::ProductName_olt") ?></td>
            <td id="rate<?php $row->getRecordId() ?>">
              <?php
                  $pid = $row->getField("List_ODL::__kf_PId_oln");
                  $prodRate = $retailobj->findField("Products", $pid);
                  echo $prodRate[0]->getField("ProductPrice_pn");
               ?>
            </td>
            <td contenteditable="true" id="qty<?php $row->getRecordId() ?>">
              <?php echo $row->getField("List_ODL::Qty_oln") ?>
            </td>
            <td>
              <?php echo $row->getField("List_ODL::TotalPrice_ct") ?>
            </td>
            <td id="del<?php echo $row->getRecordId() ?>">
              <button class="btn btn-danger del-row">Delete</button>
            </td>
          </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
      <div>
        <span class="suggesstion-box"></span>
      </div>
    </div>
    <div class="row">
      <div class="pull-left">
        <button class="btn btn-primary add-row">Add Item</button>
      </div>
      <div class="pull-right">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <th>Total</th>
              <td id="total-price">
                <?php echo !$record->getField("OrderTotal_ct") ? 0 : $record->getField("OrderTotal_ct"); ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <button id="checkout" href="#" class="center-block btn btn-primary">Check Out</button>
  </div>
<?php
    $customjs = "assets/js/product.js";
    require_once ("include/footer.php");
?>