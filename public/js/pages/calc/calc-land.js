$(document).ready(function () {
  var popup_comparison = $("#popup_comparison").DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    order: [],
    ajax: {
      url: config.root + "informations/comparison",
      type: "POST",
      data: {
        type: 1,
        kwkod: $("#kwkod").val(),
        htkod: $("#htkod").val()
      }
    },
    columnDefs: [
      {
        targets: 0,
        data: "id"
      },
      {
        targets: 1,
        orderable: false,
        data: "jln_jnama"
      },
      {
        targets: 2,
        orderable: false,
        data: "bgn_bnama"
      },
      {
        targets: 3,
        orderable: false,
        data: "peg_lsbgn"
      },
      {
        targets: 4,
        orderable: false,
        data: "peg_nilth"
      },
      {
        targets: 5,
        orderable: false,
        data: "mfa"
      },
      {
        targets: 6,
        orderable: false,
        data: "afa"
      }
    ],
    order: [[1, "asc"]],
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
        var row_comparison = '<tr id="' + rowId + '"><td><button class="btn btn-primary btn-xs" id="add" type="button"><i class="fa fa-plus"></i></button></td>'
        row_comparison += '<td><input type="hidden" name="comparison[]" id="comparison"><div class="control-label tal" id="jlname"></div></td>'
        row_comparison += "<td><div class='control-label tal' id='bgtype'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='breadth'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='nilth'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='mfa'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='afa'></div></td>"
        row_comparison += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      } else {
        $(this).prop("disabled", true)
      }
    }

    tableBody = $("table.comparison tbody")
    tableBody.append(row_comparison)
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
    var row = $(this).parent().parent()
    var rowId = row.attr("id")

    $("#comparison_popup").modal("show")
    console.log(rowId)

    popup_comparison.on("click", "tr", function () {
      var data_comparison = popup_comparison.row(this).data()
      console.log(data_comparison)
      $(".comparison #comparison_" + rowId).val(data_comparison.id)
      $(".comparison #jlname_" + rowId).html(data_comparison.jln_jnama)
      $(".comparison #bgtype_" + rowId).html(data_comparison.bgn_bnama)
      $(".comparison #breadth_" + rowId).html(data_comparison.peg_lsbgn)
      $(".comparison #nilth_" + rowId).html(data_comparison.peg_nilth)
      $(".comparison #mfa_" + rowId).html(data_comparison.mfa)
      $(".comparison #afa_" + rowId).html(data_comparison.afa)
      $("#comparison_popup").on("hidden.bs.modal", function (e) {
        rowId = ""
      })
      $("#comparison_popup").modal("hide")
    })
  })
})

$("body").on("keyup", "#breadth_land, #price_land", function () {
  var row = $(this).closest("tr")
  var breadth_land = parseFloat(row.find("#breadth_land").val())
  var price_land = parseFloat(row.find("#price_land").val())
  var total_land = parseFloat(breadth_land * price_land)
  row.find("#total_land").val(total_land.toFixed(2))
  $("#current").val(total_land.toFixed(2))
  $("#dummy_current").html(total_land.toFixed(2))
  $("#after_discount").html(total_land.toFixed(2))

  sumTotal()
})

$("body").on("keyup", "#discount", function () {
  var current = $("#current").val()
  var discount = $(this).val()
  console.log(current, discount)
  var current_value
  if (discount < 1 || discount == "") {
    current_value = parseFloat(current)
  } else {
    current_value = parseFloat(current) - parseFloat(current) * (discount / 100)
  }
  $("#after_discount").html(current_value.toFixed(2))

  sumTotal()
})

$("body").on("keyup", "#even", function () {
  generateTax()
})

function sumTotal() {
  var after_discount = $("#after_discount").html()

  var year_value = parseFloat(after_discount) * 12
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
