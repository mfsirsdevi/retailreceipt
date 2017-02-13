<?php
  session_start();
  require_once ("config/config.php");

  $name = $_POST['keyword'];
  $records = $retailobj->readRecord("Products", $name);
 ?>

  <ul style="list-style: none;">
    <?php if ($records) {
        foreach ($records as $record) { ?>
          <li class="it-name">
            <?php echo $record->getField("ProductName_pt") ?>
            <input type="hidden" value="<?php echo $record->getField("ProductPrice_pn") ?>">
          </li>
        <?php } ?>
    <?php } ?>
  </ul>