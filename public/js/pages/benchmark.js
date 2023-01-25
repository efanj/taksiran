$(document).ready(function () {
  var maxField = 4
  var x = 1
  var rowAmmount = 1

  $("#add-rent").click(function () {
    var resrent = addBgTypeOption()
    var added = document.querySelectorAll("tbody#rent-table tr").length
    var i
    for (i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row_one = '<tr id="' + rowId + '">'
      row_one += '<td><select class="form-control input-sm" name="items_rent[' + rowId + '][bgtype]" id="bgtype">'
      row_one += "<option selected>Sila Pilih</option>"
      $.each(resrent, function (i, item) {
        row_one += '<option value="' + item.bgn_bgkod + '">' + item.bgn_bnama + "</option>"
      })
      row_one += "</select></td>"
      row_one += '<td><select class="form-control input-sm" name="items_rent[' + rowId + '][bgside]" id="bgside" required>'
      row_one += "<option value='0' selected>Sila Pilih</option>"
      row_one += "<option value='1'>MFA</option>"
      row_one += "<option value='2'>AFA</option>"
      row_one += "</select></td>"
      row_one += '<td><input type="number" class="form-control input-sm" name="items_rent[' + rowId + '][rentprice]" value="0" min="0.00" max="10000.00" step="0.01"></td>'
      row_one += '<td><input type="text" class="form-control input-sm" name="items_rent[' + rowId + '][rentnote]" value=""></td>'
      row_one += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_rent" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }

    tableBody = $("table.rent tbody")
    tableBody.append(row_one)
  })

  $("#add-cost").click(function () {
    var rescost = addBgTypeOption()
    var added = document.querySelectorAll("tbody#cost-table tr").length
    for (var i = 0; i < rowAmmount; i++) {
      var rowId = i + added
      var row_one = '<tr id="' + rowId + '">'
      row_one += '<td><select class="form-control input-sm" name="items_cost[' + rowId + '][bgtype]" id="bgtype">'
      row_one += "<option selected>Sila Pilih</option>"
      $.each(rescost, function (i, item) {
        row_one += '<option value="' + item.bgn_bgkod + '">' + item.bgn_bnama + "</option>"
      })
      row_one += "</select></td>"
      row_one += '<td><select class="form-control input-sm" name="items_cost[' + rowId + '][bgside]" id="bgside" required>'
      row_one += "<option value='0' selected>Sila Pilih</option>"
      row_one += "<option value='1'>MFA</option>"
      row_one += "<option value='2'>AFA</option>"
      row_one += "</select></td>"
      row_one += '<td><input type="number" class="form-control input-sm" name="items_cost[' + rowId + '][costprice]" value="0" min="0.00" max="10000.00" step="0.01"></td>'
      row_one += '<td><input type="text" class="form-control input-sm" name="items_cost[' + rowId + '][costnote]" value=""></td>'
      row_one += '<td><a href="javascript:void(0);" class="btn btn-danger btn-xs" id="delete_cost" type="button"><i class="fa fa-trash"></i></a></td></tr>'
    }

    tableBody = $("table.cost tbody")
    tableBody.append(row_one)
  })
  $("body").on("click", "#delete_rent", function (e) {
    e.preventDefault()
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
  })
  $("body").on("click", "#delete_cost", function (e) {
    e.preventDefault()
    if (!confirm("Are you sure?")) {
      return
    }
    var row = $(this).parents("tr")
    $(row).remove()
  })

  function addBgTypeOption() {
    var xmlHttp = new XMLHttpRequest()
    xmlHttp.open("POST", config.root + "Elements/hbangn", false) // false for synchronous request
    xmlHttp.send(null)
    res = JSON.parse(xmlHttp.responseText)
    return res
  }
})
