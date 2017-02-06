$(document).ready(function() {
  $(".delete-btn").on("click", function() {
    var btid = $(this).attr('id');
    $('.deletebt').attr('id', btid);
    $("#delete_user_modal").modal("show");
  });

  $(".deletebt").on("click", function() {
    var conf = true;
    var btid = $(this).attr('id');
    if (conf == true) {
        $.post("deleteRecord.php", {
                id: btid
            },
            function (data, status) {
                // reload Users by using readRecords();
                if (data) {
                  location.reload(true);
                }
                else {
                    console.log("Error in deletion");
                }
            }
        );
    }
  });
});