$(document).ready(function () {
  var popup_comparison = $("#popup_comparison").DataTable({
    language: {
      search: "Saring : ",
      lengthMenu: "Paparkan _MENU_ rekod",
      zeroRecords: "Tiada maklumat yang dijumpai",
      info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
      infoEmpty: "Tiada rekod",
      paginate: {
        first: "Pertama",
        last: "Terakhir",
        next: "Seterusnya",
        previous: "Sebelumnya"
      }
    }
  })
  $("#popup_comparison").css("font-size", 13)
  popup_comparison.columns(0).visible(false)

  var maxField = 4
  var x = 1
  var rowAmmount = 1

  $("#add-comparison").click(function () {
    var added = document.querySelectorAll("tbody#comparison_table tr").length
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      if (x < maxField) {
        x++
        var row_comparison = '<tr id="' + rowId++ + '"><td><button class="btn btn-primary btn-xs" id="add" type="button"><i class="fa fa-plus"></i></button></td>'
        row_comparison += '<td><input type="hidden" name="comparison[]" id="comparison"><div class="control-label tal" id="jlname"></div></td>'
        row_comparison += "<td><div class='control-label tal' id='bgtype'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='breadth'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='nilth'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='mfa'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='afa'></div></td>"
        row_comparison += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      }
    }

    tableBody = $("table.comparison tbody")
    tableBody.append(row_comparison)
  })

  $("#add-one").click(function () {
    var added = document.querySelectorAll("tbody#one_table tr").length
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row_one = '<tr id="' + rowId + '"><td><input type="text" class="form-control input-sm" name="item_one[' + rowId + '][title_one]"></td>'
      row_one += '<td><input type="number" class="form-control input-sm" name="item_one[' + rowId + '][breadth_one]" id="breadth_one" value="0"></td>'
      row_one += '<td><select class="form-control input-sm" name="item_one[' + rowId + '][breadthtype_one]">'
      row_one += "<option value=''>Sila Pilih</option>"
      row_one += '<option value="mp" selected>Meter</option>'
      row_one += '<option value="ft">Kaki</option>'
      row_one += '<option value="unit">Unit</option>'
      row_one += "</select></td>"
      row_one += '<td style="text-align:center">X</td>'
      row_one += '<td><input type="number" class="form-control input-sm" name="item_one[' + rowId + '][price_one]" id="price_one" value="0"></td>'
      row_one += '<td><select class="form-control input-sm" name="item_one[' + rowId + '][pricetype_one]">'
      row_one += "<option value=''>Sila Pilih</option>"
      row_one += '<option value="smp" selected>Meter Persegi</option>'
      row_one += '<option value="sft">Kaki Persegi</option>'
      row_one += '<option value="p/unit">Per-Unit</option>'
      row_one += "</select></td>"
      row_one += '<td><input type="number" class="form-control input-sm ttl_partly" name="item_one[' + rowId + '][total_one]" id="total_one" readonly></td>'
      row_one += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_one" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }

    tableBody = $("table.one tbody")
    tableBody.append(row_one)
  })

  $("#add-two").click(function () {
    var added = document.querySelectorAll("tbody#two_table tr").length
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row_two = "<tr id='" + rowId + "'><td><input type='text' class='form-control input-sm' name='item_two[" + rowId + "][title_two]'></td>"
      row_two += "<td><input type='number' class='form-control input-sm' name='item_two[" + rowId + "][breadth_two]' id='breadth_two' value='0'></td>"
      row_two += "<td><select class='form-control input-sm' name='item_two[" + rowId + "][breadthtype_two]'>"
      row_two += "<option selected>Sila Pilih</option>"
      row_two += "<option value='mp'>Meter</option>"
      row_two += "<option value='ft'>Kaki</option>"
      row_two += "<option value='unit'>Unit</option>"
      row_two += "</select></td>"
      row_two += "<td style='text-align:center'>X</td>"
      row_two += "<td><input type='number' class='form-control input-sm' name='item_two[" + rowId + "][price_two]' id='price_two' value='0'></td>"
      row_two += "<td><select class='form-control input-sm' name='item_two[" + rowId + "][pricetype_two]'>"
      row_two += "<option selected>Sila Pilih</option>"
      row_two += "<option value='smp'>Meter Persegi</option>"
      row_two += "<option value='sft'>Kaki Persegi</option>"
      row_two += "<option value='p/unit'>Per-Unit</option>"
      row_two += "</select></td>"
      row_two += "<td><input type='number' class='form-control input-sm ttl_partly' name='item_two[" + rowId + "][total_two]' id='total_two' readonly></td>"
      row_two += "<td><a href='javascript:void(0);' class='btn btn-danger btn-xs' id='delete_two' type='button'><i class='fa fa-trash'></i></a></td></tr>"
    }

    tableBody = $("table.two tbody")
    tableBody.append(row_two)
  })
  $("body").on("click", "#delete_one", function (e) {
    e.preventDefault()
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
  })
  $("body").on("click", "#delete_two", function (e) {
    e.preventDefault()
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
  })

  $("body").on("click", "#delete", function (e) {
    e.preventDefault()
    console.log("test")
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
  })

  $("#dummy_corner").change(function () {
    if (this.checked) {
      $(this).prop("checked", true)
    } else {
      $(this).prop("checked", false)
    }
    $("#corner").val(this.checked)
  })

  $("body").on("click", "#add", function (e) {
    e.preventDefault()
    var row = $(this).parent().parent()
    var rowId = row.attr("id")

    $("#comparison_popup").modal("show")
    console.log(rowId)

    $("#popup_comparison tbody").on("click", "tr", function () {
      var data_comparison = popup_comparison.row(this).data()
      $("#" + rowId + " #comparison").val(data_comparison[0])
      $("#" + rowId + " #jlname").html(data_comparison[1])
      $("#" + rowId + " #bgtype").html(data_comparison[2])
      $("#" + rowId + " #breadth").html(data_comparison[3])
      $("#" + rowId + " #nilth").html("RM " + data_comparison[4])
      $("#" + rowId + " #mfa").html("RM " + data_comparison[5])
      $("#" + rowId + " #afa").html("RM " + data_comparison[6])
      $("#comparison_popup").modal("hide")
    })
  })
})

$("body").on("keyup", "#breadth_one, #price_one", function () {
  var row = $(this).closest("tr")
  var breadth = parseFloat(row.find("#breadth_one").val())
  var price = parseFloat(row.find("#price_one").val())
  var total = parseFloat(breadth * price)
  row.find("#total_one").val(total.toFixed(2))
  overall_one()
})

$("body").on("keyup", "#breadth_two, #price_two", function () {
  var row = $(this).closest("tr")
  var breadth_two = parseFloat(row.find("#breadth_two").val())
  var price_two = parseFloat(row.find("#price_two").val())
  var total_two = parseFloat(breadth_two * price_two)
  row.find("#total_two").val(total_two.toFixed(2))
  overall_two()
})

$("body").on("keyup", "#discount", function () {
  var rental = 0
  $(".ttl_partly").each(function () {
    rental += +$(this).val()
  })
  var discount = $(this).val()
  var rent_value
  if (discount === 0 || discount === 0.0) {
    rent_value = parseFloat(rental)
  } else {
    rent_value = parseFloat(rental) - parseFloat(rental) * (discount / 100)
  }
  $("#rental").val(rent_value.toFixed(2))
  $("#dummy_rental").html(rent_value.toFixed(2))
  $("#value_corner").html(rent_value.toFixed(2))
  $("#even").val(rent_value.toFixed(2))

  generateTax()
})

$("body").on("change", "#dummy_corner", function () {
  // console.log(this.checked)
  var corner
  var rental = $("#rental").val()
  if (this.checked === true) {
    corner = (parseFloat(rental) / 100) * 10 + parseFloat(rental)
  } else {
    corner = parseFloat(rental)
  }
  console.log(corner)
  $("#value_corner").html(corner.toFixed(2))
  $("#even").val(corner.toFixed(2))
  generateTax()
})

$("body").on("keyup", "#even", function () {
  generateTax()
})

function overall_one() {
  var overall_one = 0
  $("#table_one tbody tr").each(function () {
    var total_one = $(this).find("#total_one").val()
    if (total_one.length != 0) {
      overall_one += parseFloat(total_one)
    }
  })
  $("#overall_one").val(overall_one.toFixed(2))
  sumOneTwo()
}

function overall_two() {
  var overall_two = 0
  $("#table_two tbody tr").each(function () {
    var total_two = $(this).find("#total_two").val()
    if (total_two.length != 0) {
      overall_two += parseFloat(total_two)
    }
  })
  $("#overall_two").val(overall_two.toFixed(2))
  sumOneTwo()
}

function sumOneTwo() {
  var rental_value = 0
  $(".ttl_partly").each(function () {
    rental_value += +$(this).val()
  })
  $("#rental").val(rental_value.toFixed(2))
  $("#dummy_rental").html(rental_value.toFixed(2))
  $("#value_corner").html(rental_value.toFixed(2))
  $("#even").val(rental_value.toFixed(2))
  generateTax()
}

function generateTax() {
  var year_value
  var corner = $("#value_corner").html()
  var even = $("#even").val()
  if (even === parseFloat(corner)) {
    year_value = parseFloat(corner) * 12
  } else {
    year_value = parseFloat(even) * 12
  }

  var rate = $("#dummy_rate").html()
  var tax = (parseFloat(rate) / 100) * year_value

  $("#yearly").val(year_value.toFixed(2))
  $("#dummy_yearly").html(year_value.toFixed(2))

  $("#tax").val(tax.toFixed(2))
  $("#dummy_tax").html(tax.toFixed(2))
}
