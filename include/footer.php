<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <?php if (isset($customjs)) { ?>
        <script type="text/javascript" src="<?php echo $customjs; ?>"></script>
    <?php } ?>
  </body>
</html>