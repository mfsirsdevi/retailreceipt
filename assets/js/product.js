$(document).ready(function() {

  // function to update the invoice whenever a change occurs and update proper values.
  function updateInvoice() {
    var total = 0, cells, price, i;
    for(var a = $(".item tbody tr"), i = 0; a[i]; ++i) {
      cells = $(a[i]).children().toArray();
      price = parseFloat($(cells[1]).html()) * parseFloat($(cells[2]).html());
      total += price;
      if (!isNaN(price)) {
        $(cells[3]).html(price);
      } else {
        $(cells[3]).html(0);
      }
    }
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

  $(document).on("keydown mousewheel", updateNumber);


  // Toggle contenteditable attribute from the data-edit class
  $(document).on("click", ".data-edit", function() {
    if ($(this).attr("contenteditable")) {
        $(this).removeAttr("contenteditable");
    } else {
        $(this).attr("contenteditable", true);
        $(this).focus();
    }
  });

  // function to create a new row and add it to the end of item table

  function generateTableRow() {
    var emptyRow = $("<tr>");
    $(emptyRow).append('<td class="data-edit itm-name"><div contenteditable="false"><span contenteditable="false" class="suggesstion-box"></span></div></td>');
    $(emptyRow).append('<td class="itm-rate"></td>');
    $(emptyRow).append('<td class="data-edit itm-qty"></td>');
    $(emptyRow).append('<td class="itm-price"></td>');
    $(emptyRow).append('<td><button class="btn btn-danger del-row">Delete</button></td>');
    return emptyRow;
  }

  // Calling updateInvoice function on each data input
  $(document).on("input", ".data-edit", updateInvoice);

  // Adding row at the end of the item table
  $(".add-row").on("click", function(){
    $(".item tbody").append(generateTableRow());
    updateInvoice();
  });

  // Deleting row from the item table

  $(document).on("click", ".del-row", function(){
    if (!$(this).find("id")) {
      $(this).parent().parent().remove();
      updateInvoice();
    }
    var btid = $(this).attr("id");
    var tbl = "DisplayDetails";
    $.post("deleteRecord.php", {
                id: btid,
                tbl: tbl
            },
            function (data, status) {
              if (data) {
                console.log(data);
                $(this).parent().parent().remove();
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

    console.log(onum);
    console.log(oname);
    console.log(oid);
  });

  // ajax call to add items to the list - under progress
  $(".itm-name").keyup(function(){
    $.ajax({
    type: "POST",
    url: "readRecord.php",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $('.suggesstion-box').attr('readonly', 'true');
    },
    success: function(data){
      $(".suggesstion-box").show();
      $(".suggesstion-box").html(data);
      $('.suggesstion-box').attr('readonly', 'true');
      $(".itm-name").removeAttr("contenteditable");
    }
    });
  });

  function selectValue(val1, val2) {
    $(".itm-name").html(val1);
    $(".itm-name").parent().find(".itm-rate").html(val2);
    $(".suggesstion-box").hide();
    updateInvoice();
  }

  // Adding data to the item on click of auto generated list
  $(document).on("click", ".it-name", function(){
    var val1 = $.trim($(this).text());
    var val2 = parseFloat($.trim($(this).find("input").val()));
    selectValue(val1, val2);
  });


});