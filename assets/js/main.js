$(document).ready(function() {

  $(".add-order").on("click", function() {
    var name = $("#name").val();
    var odate = $("#odate").val();
    var phone = $("#phone").val();

    $.post("createOrder.php", {
      name: name,
      odate: odate,
      phone: phone
    }, function(data, status) {
      if (data) {
        $("#add_Order_modal").modal("hide");
        $("#name").val("");
        $("#odate").val("");
        $("#phone").val("");
        location.href = "products.php?id=" + data;
      }
      //location.reload(true);
    });
  });

  $(".delete-btn").on("click", function() {
    var btid = $(this).attr("id");
    $('.deletebt').attr('id', btid);
    $("#delete_user_modal").modal("show");
  });

  $(".deletebt").on("click", function() {
    var conf = true;
    var btid = $(this).attr("id");
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

  $("add-btn").on("click", function(e) {
    e.preventDefault();
    var btid = $(this).attr("id");

  });
});