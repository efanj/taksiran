$(document).ready(function () {
  var popup_comparison = $("#popup_comparison").DataTable({
    language: {
      search: "Saring:",
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
        row_comparison += '<td><input type="hidden" name="comparison[]" id="comparison"><div class="control-label tal" id="noakaun"></div></td>'
        row_comparison += "<td><div class='control-label tal' id='nolot'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='keluasan'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='hargasmp'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='nilaitahunan'></div></td>"
        row_comparison += "<td></td>"
        row_comparison += "<td></td>"
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
      row_one += "<option selected>Sila Pilih</option>"
      row_one += '<option value="mp">Meter</option>'
      row_one += '<option value="ft">Kaki</option>'
      row_one += '<option value="unit">Unit</option>'
      row_one += "</select></td>"
      row_one += '<td style="text-align:center">X</td>'
      row_one += '<td><input type="number" class="form-control input-sm" name="item_one[' + rowId + '][price_one]" id="price_one" value="0"></td>'
      row_one += '<td><select class="form-control input-sm" name="item_one[' + rowId + '][pricetype_one]">'
      row_one += "<option selected>Sila Pilih</option>"
      row_one += '<option value="smp">Meter Persegi</option>'
      row_one += '<option value="sft">Kaki Persegi</option>'
      row_one += '<option value="p/unit">Per-Unit</option>'
      row_one += "</select></td>"
      row_one += '<td><input type="number" class="form-control input-sm ttl_partly" name="item_one[' + rowId + '][total_one]" id="total_one" readonly></td>'
      row_one += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_one" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }

    tableBody = $("table.one tbody")
    tableBody.append(row_one)
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

  $("body").on("click", "#add", function (e) {
    e.preventDefault()
    var row = $(this).parent().parent()
    var rowId = row.attr("id")

    $("#comparison_popup").modal("show")
    console.log(rowId)

    $("#popup_comparison tbody").on("click", "tr", function () {
      var data_comparison = popup_comparison.row(this).data()
      console.log(rowId + "#noakaun")
      $("#" + rowId + " #comparison").val(data_comparison[0])
      $("#" + rowId + " #noakaun").html(data_comparison[0])
      $("#" + rowId + " #nolot").html(data_comparison[1])
      $("#" + rowId + " #keluasan").html(data_comparison[2])
      $("#" + rowId + " #hargasmp").html(data_comparison[3])
      $("#" + rowId + " #nilaitahunan").html(data_comparison[4])
      $("#comparison_popup").modal("hide")
    })
  })
})

$("body").on("keyup", "#land_breadth, #land_price", function () {
  var row = $(this).closest("tr")
  var breadth = parseFloat(row.find("#land_breadth").val())
  var price = parseFloat(row.find("#land_price").val())
  var total = parseFloat(breadth * price)
  row.find("#land_total").val(total.toFixed(2))
  sumTotal()
})

$("body").on("keyup", "#breadth_one, #price_one", function () {
  var row = $(this).closest("tr")
  var breadth = parseFloat(row.find("#breadth_one").val())
  var price = parseFloat(row.find("#price_one").val())
  var total = parseFloat(breadth * price)
  row.find("#total_one").val(total.toFixed(2))
  overall_one()
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
  sumTotal()
}

function sumTotal() {
  var current_value = 0
  $(".ttl_partly").each(function () {
    current_value += +$(this).val()
  })
  $("#current").val(current_value.toFixed(2))
  $("#dummy_current").html(current_value.toFixed(2))

  var year_value = parseFloat(current_value) * 0.08
  $("#yearly").val(year_value.toFixed(2))
  $("#dummy_yearly").html(year_value.toFixed(2))
  $("#even").val(year_value.toFixed(2))

  generateTax()
}

function generateTax() {
  var even = $("#even").val()

  var rate = $("#dummy_rate").html()
  var tax = (parseFloat(rate) / 100) * even

  $("#tax").val(tax.toFixed(2))
  $("#dummy_tax").html(tax.toFixed(2))
}
