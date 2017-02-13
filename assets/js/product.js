$(document).ready(function() {

  // function to update the invoice whenever a change occurs and update proper values.
  function updateInvoice() {
    var total = 0, cells, price, i;
    $("#item-details tr").each( function(index, element) {
      cells = $(element).children().toArray();
      price = parseFloat($(cells[1]).html()) * parseFloat($(cells[2]).html());
      total += price;
      if (!isNaN(price)) {
        $(cells[3]).html(price);
      } else {
        $(cells[3]).html(0);
      }
    });
    if (!isNaN(total)) {
      $("#total-price").html(total);
    }
  }

  /* Update Number - To update the qty field of item table
  /*  ====================================================================== */

  function updateNumber(e) {
    var activeElement = $(document.activeElement);
    var value = parseFloat(activeElement.html());

    if(!isNaN(value) && (e.keyCode == 38 || e.keyCode == 40 || e.wheelDeltaY)){
      e.preventDefault();
      value += e.keyCode == 38 ? 1 : e.keyCode == 40 ? -1 : Math.round(e.wheelDelta * 0.025);
      value = Math.max(value, 0);
      activeElement.html(value);
    }

    updateInvoice();
  }

  // Calling updateNumber method on key and mouse actions

  $(document).on("input keyup mousewheel", updateNumber);


  // Toggle contenteditable attribute from the data-edit class
  $(document).on("click", ".data-edit", function() {
    if ($(this).attr("contenteditable")) {
        $(this).removeAttr("contenteditable");
    } else {
        $(this).attr("contenteditable", true);
        $(this).focus();
    }
  });

  // Calling updateInvoice function on each data input
  $(document).on("input", ".data-edit", updateInvoice);

  // Adding row at the end of the item table
  $(".add-row").on("click", function(){
    $.post("addItem.php", {}, function(data, success) {
      $("#item-details").append(data);
      updateInvoice();
    });
  });

  // Deleting row from the item table

  $(document).on("click", ".del-row", function(){
    var btid = $(this).parent().attr("id");
    var tbl = "DisplayDetails";
    var trd = $(this).parent().parent();
    $.post("deleteRecord.php", {
        id: btid,
        tbl: tbl
      },
      function (data, status) {
        if (data) {
          $(trd).remove();
          updateInvoice();
        }
      }
    );
  });

  // Remove contenteditable attribute on blur from all the elements
  $(document).on("blur", ".data-edit", function(){
    $(this).removeAttr("contenteditable");
    updateInvoice();
  });

  // Under progress - checkout mechanism
  $(document).on("click", "#checkout", function(){
    var oid = $.trim($("#custId input").val());
    var oname = $.trim($("#cust-name").text());
    var onum = $.trim($("#cust-num").text());
    var total = $.trim($("#total-price").text());
    var orderDetails = [oid, oname, onum, total];
    var order = JSON.stringify(orderDetails);
    var tbl = [];
    $("#item-details tr").each(function(index, element) {
      //var itid = $(element).attr("id");
      var cells = $(element).children().toArray();
      var data = [$.trim($(cells[0]).text()), $.trim($(cells[1]).text()), $.trim($(cells[2]).text()), $.trim($(cells[3]).text())];
      tbl.push(data);
    });
    var itemData = JSON.stringify(tbl);

    $.post("printRecords.php", {
        order: order,
        items: itemData
      },function(data, success) {
        if (data) {
          location.href = "test.php";
        }
      });
  });

  // ajax call to add items to the list - under progress
  $(document).on("input", ".itm-name", function(){
    $(this).addClass("isActive");
    $.ajax({
    type: "POST",
    url: "readRecord.php",
    data:'keyword='+$(this).text(),
    beforeSend: function(){
      $('.suggesstion-box').attr('readonly', 'true');
    },
    success: function(data){
      $(".suggesstion-box").show();
      $(".suggesstion-box").html(data);
    }
    });
  });

  // Adding data to the item on click of auto generated list
  $(document).on("click", ".it-name", function(){
    var val1 = $.trim($(this).text());
    var val2 = parseFloat($.trim($(this).find("input").val()));
    selectValue(val1, val2);
  });

  var table = $("#item-details");

  function selectValue(val1, val2) {
    $(table).find(".isActive").html(val1);
    $(table).find(".isActive").next().html(val2);
    $(".suggesstion-box").hide();
    $(table).find(".isActive").removeClass("isActive");
    updateInvoice();
  }
});