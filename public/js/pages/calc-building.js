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

  $("#add-section-one").click(function () {
    var added = document.querySelectorAll(".section_one section").length
    // console.log(added)
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      if (rowId === 1) {
        tableName = "one"
      } else if (rowId === 2) {
        tableName = "two"
      } else if (rowId === 3) {
        tableName = "three"
      } else if (rowId === 4) {
        tableName = "four"
      }
      if (x < maxField) {
        x++
        var section_one = '<hr><section id="' + rowId + '"><div class="form-group"><label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>'
        section_one += '<div class="col-lg-10 col-md-9"><input type="text" class="form-control input-sm" name="section_one[' + rowId + '][main_title]"></div></div>'
        section_one += '<div><div style="width:100px;display:inline-flex">'
        section_one += '<button id="' + rowId + '" class="btn btn-primary btn-sm add-one mb5" type="button">Add Row</button></div>'
        section_one += '<div style="width:100px; float:right; display:inline-block">'
        section_one += '<button id="' + rowId + '" class="btn btn-danger btn-sm section-one" type="button">Delete Section</button></div></div>'
        section_one += '<table class="table table-bordered one" id="' + tableName + '" style="font-size:13px;">'
        section_one += '<thead><tr><th style="width:30%">Perkara</th><th style="width:15%">Keluasan/Kuantiti</th><th style="width:10%">Jenis</th><th></th>'
        section_one += '<th style="width:15%">Nilai Unit</th><th style="width:10%">Jenis</th><th style="width:15%">Jumlah</th><th></th></tr></thead>'
        section_one += '<tbody id="' + tableName + '"><tr id="' + rowId + '"><td>'
        section_one += '<input type="text" class="form-control input-sm" name="section_one[' + rowId + '][item][0][title_one]"></td>'
        section_one += '<td><input type="number" class="form-control input-sm" name="section_one[' + rowId + '][item][0][breadth_one]" id="breadth_one"></td>'
        section_one += '<td><select class="form-control input-sm" name="section_one[' + rowId + '][item][0][breadthtype_one]">'
        section_one += "<option value=''>Sila Pilih</option>"
        section_one += '<option value="mp" selected>Meter</option>'
        section_one += '<option value="ft">Kaki</option>'
        section_one += '<option value="unit">Unit</option>'
        section_one += "</select></td>"
        section_one += '<td style="text-align:center">X</td>'
        section_one += '<td><input type="number" class="form-control input-sm" name="section_one[' + rowId + '][item][0][price_one]" id="price_one" value="0"></td>'
        section_one += '<td><select class="form-control input-sm" name="section_one[' + rowId + '][item][0][pricetype_one]">'
        section_one += "<option value=''>Sila Pilih</option>"
        section_one += '<option value="smp" selected>Meter Persegi</option>'
        section_one += '<option value="sft">Kaki Persegi</option>'
        section_one += '<option value="p/unit">Per-Unit</option>'
        section_one += "</select></td>"
        section_one += '<td><input type="number" class="form-control input-sm ttl_partly" name="section_one[' + rowId + '][item][0][total_one]" id="total_one" readonly></td>'
        section_one += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_one" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      } else {
        $(this).prop("disabled", true)
      }
    }

    var divBody = $(".section_one")
    divBody.append(section_one)
  })

  $("#add-section-two").click(function () {
    var added = document.querySelectorAll(".section_two section").length
    // console.log(added)
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      if (rowId === 1) {
        tableName = "one"
      } else if (rowId === 2) {
        tableName = "two"
      } else if (rowId === 3) {
        tableName = "three"
      } else if (rowId === 4) {
        tableName = "four"
      }
      if (x < maxField) {
        x++
        var section_two = '<hr><section id="' + rowId + '"><div class="form-group"><label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>'
        section_two += '<div class="col-lg-10 col-md-9"><input type="text" class="form-control input-sm" name="section_two[' + rowId + '][external_title]"></div></div>'
        section_two += '<div><div style="width:100px;display:inline-flex">'
        section_two += '<button id="' + rowId + '" class="btn btn-primary btn-sm add-two mb5" type="button">Add Row</button></div>'
        section_two += '<div style="width:100px; float:right; display:inline-block">'
        section_two += '<button id="' + rowId + '" class="btn btn-danger btn-sm section-two" type="button">Delete Section</button></div></div>'
        section_two += '<table class="table table-bordered two" id="' + tableName + '" style="font-size:13px;">'
        section_two += '<thead><tr><th style="width:30%">Perkara</th><th style="width:15%">Keluasan/Kuantiti</th><th style="width:10%">Jenis</th><th></th>'
        section_two += '<th style="width:15%">Nilai Unit</th><th style="width:10%">Jenis</th><th style="width:15%">Jumlah</th><th></th></tr></thead>'
        section_two += '<tbody id="' + tableName + '"><tr id="' + rowId + '"><td>'
        section_two += '<input type="text" class="form-control input-sm" name="section_two[' + rowId + '][item][0][title_two]"></td>'
        section_two += '<td><input type="number" class="form-control input-sm" name="section_two[' + rowId + '][item][0][breadth_two]" id="breadth_two"></td>'
        section_two += '<td><select class="form-control input-sm" name="section_two[' + rowId + '][item][0][breadthtype_two]">'
        section_two += "<option value=''>Sila Pilih</option>"
        section_two += '<option value="mp" selected>Meter</option>'
        section_two += '<option value="ft">Kaki</option>'
        section_two += '<option value="unit">Unit</option>'
        section_two += "</select></td>"
        section_two += '<td style="text-align:center">X</td>'
        section_two += '<td><input type="number" class="form-control input-sm" name="section_two[' + rowId + '][item][0][price_two]" id="price_two" value="0"></td>'
        section_two += '<td><select class="form-control input-sm" name="section_two[' + rowId + '][item][0][pricetype_two]">'
        section_two += "<option value=''>Sila Pilih</option>"
        section_two += '<option value="smp" selected>Meter Persegi</option>'
        section_two += '<option value="sft">Kaki Persegi</option>'
        section_two += '<option value="p/unit">Per-Unit</option>'
        section_two += "</select></td>"
        section_two += '<td><input type="number" class="form-control input-sm ttl_partly" name="section_two[' + rowId + '][item][0][total_two]" id="total_two" readonly></td>'
        section_two += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_one" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      } else {
        $(this).prop("disabled", true)
      }
    }

    var divBody = $(".section_two")
    divBody.append(section_two)
  })

  $("#add-comparison").click(function () {
    var added = document.querySelectorAll("tbody#comparison_table tr").length
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      if (x < maxField) {
        x++
        var row_comparison = '<tr id="' + rowId + '"><td><button class="btn btn-primary btn-xs" id="add" type="button"><i class="fa fa-plus"></i></button></td>'
        row_comparison += '<td><input type="hidden" name="comparison[]" id="comparison_' + rowId + '"><div class="control-label tal" id="jlname_' + rowId + '"></div></td>'
        row_comparison += "<td><div class='control-label tal' id='bgtype_" + rowId + "'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='breadth_" + rowId + "'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='nilth_" + rowId + "'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='mfa_" + rowId + "'></div></td>"
        row_comparison += "<td><div class='control-label tal' id='afa_" + rowId + "'></div></td>"
        row_comparison += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete" type="button"><i class="fa fa-trash"></i></a></td></tr>'
      } else {
        $(this).prop("disabled", true)
      }
    }

    tableBody = $("table.comparison tbody")
    tableBody.append(row_comparison)
  })

  $("body").on("click", ".add-one", function (e) {
    var Id = $(this).attr("id")
    var tableId = $(this)
      .closest("section#" + Id)
      .find("table")
      .attr("id")
    var added = document.querySelectorAll("tbody#" + tableId + " tr").length
    console.log(tableId)
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row_one = '<tr id="' + rowId + '"><td><input type="text" class="form-control input-sm" name="section_one[' + Id + "][item][" + rowId + '][title_one]"></td>'
      row_one += '<td><input type="number" class="form-control input-sm" name="section_one[' + Id + "][item][" + rowId + '][breadth_one]" id="breadth_one" value="0"></td>'
      row_one += '<td><select class="form-control input-sm" name="section_one[' + Id + "][item][" + rowId + '][breadthtype_one]">'
      row_one += "<option value=''>Sila Pilih</option>"
      row_one += '<option value="mp" selected>Meter</option>'
      row_one += '<option value="ft">Kaki</option>'
      row_one += '<option value="unit">Unit</option>'
      row_one += "</select></td>"
      row_one += '<td style="text-align:center">X</td>'
      row_one += '<td><input type="number" class="form-control input-sm" name="section_one[' + Id + "][item][" + rowId + '][price_one]" id="price_one" value="0"></td>'
      row_one += '<td><select class="form-control input-sm" name="section_one[' + Id + "][item][" + rowId + '][pricetype_one]">'
      row_one += "<option value=''>Sila Pilih</option>"
      row_one += '<option value="smp" selected>Meter Persegi</option>'
      row_one += '<option value="sft">Kaki Persegi</option>'
      row_one += '<option value="p/unit">Per-Unit</option>'
      row_one += "</select></td>"
      row_one += '<td><input type="number" class="form-control input-sm ttl_partly" name="section_one[' + Id + "][item][" + rowId + '][total_one]" id="total_one" readonly></td>'
      row_one += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_one" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }

    tableBody = $(".section_one table#" + tableId + " tbody")
    tableBody.append(row_one)
  })

  $("body").on("click", ".add-two", function (e) {
    var Id = $(this).attr("id")
    var tableId = $(this)
      .closest("section#" + Id)
      .find("table")
      .attr("id")
    var added = document.querySelectorAll("tbody#" + tableId + " tr").length
    console.log(added)
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row_two = '<tr id="' + rowId + '"><td><input type="text" class="form-control input-sm" name="section_two[' + Id + "][item][" + rowId + '][title_two]"></td>'
      row_two += '<td><input type="number" class="form-control input-sm" name="section_two[' + Id + "][item][" + rowId + '][breadth_two]" id="breadth_two" value="0"></td>'
      row_two += '<td><select class="form-control input-sm" name="section_two[' + Id + "][item][" + rowId + '][breadthtype_two]">'
      row_two += "<option value=''>Sila Pilih</option>"
      row_two += '<option value="mp" selected>Meter</option>'
      row_two += '<option value="ft">Kaki</option>'
      row_two += '<option value="unit">Unit</option>'
      row_two += "</select></td>"
      row_two += '<td style="text-align:center">X</td>'
      row_two += '<td><input type="number" class="form-control input-sm" name="section_two[' + Id + "][item][" + rowId + '][price_two]" id="price_two" value="0"></td>'
      row_two += '<td><select class="form-control input-sm" name="section_two[' + Id + "][item][" + rowId + '][pricetype_two]">'
      row_two += "<option value=''>Sila Pilih</option>"
      row_two += '<option value="smp" selected>Meter Persegi</option>'
      row_two += '<option value="sft">Kaki Persegi</option>'
      row_two += '<option value="p/unit">Per-Unit</option>'
      row_two += "</select></td>"
      row_two += '<td><input type="number" class="form-control input-sm ttl_partly" name="section_two[' + Id + "][item][" + rowId + '][total_two]" id="total_two" readonly></td>'
      row_two += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_one" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }

    tableBody = $(".section_two table#" + tableId + " tbody")
    tableBody.append(row_two)
  })

  $("body").on("click", ".section-one", function (e) {
    e.preventDefault()
    // if (!confirm("Are you sure?")) {
    //   return
    // }
    var id = $(this).attr("id")
    console.log(id)
    $("section#" + id).remove()
  })
  $("body").on("click", ".section-two", function (e) {
    e.preventDefault()
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
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
    var row = $(this).parent().parent()
    var rowId = row.attr("id")

    $("#comparison_popup").modal("show")
    console.log(rowId)

    popup_comparison.on("click", "tr", function () {
      var data_comparison = popup_comparison.row(this).data()
      $(".comparison #comparison_" + rowId).val(data_comparison[0])
      $(".comparison #jlname_" + rowId).html(data_comparison[1])
      $(".comparison #bgtype_" + rowId).html(data_comparison[2])
      $(".comparison #breadth_" + rowId).html(data_comparison[3])
      $(".comparison #nilth_" + rowId).html(data_comparison[4])
      $(".comparison #mfa_" + rowId).html(data_comparison[5])
      $(".comparison #afa_" + rowId).html(data_comparison[6])
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
})

$("body").on("keyup", "#breadth_one, #price_one", function () {
  var row = $(this).closest("tr")
  var breadth_one = parseFloat(row.find("#breadth_one").val())
  var price_one = parseFloat(row.find("#price_one").val())
  var total_one = parseFloat(breadth_one * price_one)
  row.find("#total_one").val(total_one.toFixed(2))
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
  var rental = $("#rental").val()
  var discount = $(this).val()
  console.log(rental, discount)
  var rent_value
  if (discount < 1 || discount == "") {
    rent_value = parseFloat(rental)
  } else {
    rent_value = parseFloat(rental) - parseFloat(rental) * (discount / 100)
  }
  $("#dummy_discount").html(rent_value.toFixed(2))
  $("#even").val(rent_value.toFixed(2))

  generateTax()
})

// $("body").on("change", "#dummy_corner", function () {
//   // console.log(this.checked)
//   var corner
//   var rental = $("#rental").val()
//   if (this.checked === true) {
//     corner = (parseFloat(rental) / 100) * 10 + parseFloat(rental)
//   } else {
//     corner = parseFloat(rental)
//   }
//   console.log(corner)
//   $("#value_corner").html(corner.toFixed(2))
//   $("#even").val(corner.toFixed(2))
//   generateTax()
// })

$("body").on("keyup", "#even", function () {
  generateTax()
})

function overall_one() {
  var overall_one = 0
  $(".one").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find("#total_one")
          .each(function () {
            var val_one = parseFloat($(this).val())
            if (!isNaN(val_one)) overall_one += val_one
          })
      })
  })
  $("#overall_one").val(overall_one.toFixed(2))
  sumOneTwo()
}

function overall_two() {
  var overall_two = 0
  $(".two").each(function () {
    $(this)
      .find("tr")
      .each(function () {
        $(this)
          .find("#total_two")
          .each(function () {
            var val_two = parseFloat($(this).val())
            if (!isNaN(val_two)) overall_two += val_two
          })
      })
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
  $("#even").val(rental_value.toFixed(2))
  generateTax()
}

function generateTax() {
  var year_value
  var even = $("#even").val()
  year_value = parseFloat(even) * 12

  var rate = $("#dummy_rate").html()
  var tax = (parseFloat(rate) / 100) * year_value

  $("#yearly").val(year_value.toFixed(2))
  $("#dummy_yearly").html(year_value.toFixed(2))

  $("#tax").val(tax.toFixed(2))
  $("#dummy_tax").html(tax.toFixed(2))
}
