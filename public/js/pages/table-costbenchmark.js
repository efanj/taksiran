$(document).ready(function () {
  function format(data) {
    var child = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">'
    $.each(data, function (i, item) {
      child += "<tr>"
      child += "<td style='width:3.3%'></td>"
      child += "<td style='width:17.5%'></td>"
      child += "<td style='width:17%'></td>"
      child += "<td style='width:18%'></td>"
      child += "<td style='width:18%'>"
      child += "- " + item.bgn_bnama + "<br>- " + item.bgside
      child += "</td>"
      child += "<td style='width:8.3%'>RM " + item.nilai + "</td>"
      child += "<td style='width:20%'>" + item.nota + "</td>"
      child += "<td style='width:9%'></td>"
      child += "</tr>"
    })
    child += "</table>"
    return child
  }
  var benchmark = $("#cost-benchmark").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50]
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "costbenchmarktable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: ""
      },
      {
        targets: 1,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "- " + row.akaun + "</br>"
            data += "- " + row.nmbil
          }
          return data
        }
      },
      {
        targets: 2,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "- " + row.jln_jnama + "</br>"
            data += "- " + row.kws_knama
          }
          return data
        }
      },
      {
        targets: 3,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "- " + row.hrt_hnama
          }
          return data
        }
      },
      {
        targets: 4,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "- " + row.bgn_bnama + "</br>"
            data += "- " + row.bgside
          }
          return data
        }
      },
      {
        targets: 5,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "RM " + row.nilai
          }
          return data
        }
      },
      {
        targets: 6,
        orderable: false,
        data: "nota"
      },
      {
        targets: 7,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(data);
          if (type === "display") {
            data = '<a href="viewbenchmark/' + row.id + '" class="btn btn-default btn-sm" title="Dokumen"><i class="fa fa-file color-dark"></i></a>'
          }
          return data
        }
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
        next: "Seterus",
        previous: "Sebelum"
      }
    }
  })

  $("#cost-benchmark tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = benchmark.row(tr)

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide()
      tr.removeClass("shown")
    } else {
      // Open this row
      row.child(format(row.data().childs)).show()
      tr.addClass("shown")
    }
  })

  $("#cost-benchmark").css("font-size", 13)

  var account = $("#popup_account").DataTable({
    language: {
      search: "Saring : ",
      lengthMenu: "Paparkan _MENU_ rekod",
      zeroRecords: "Tiada maklumat yang dijumpai",
      info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
      infoEmpty: "Tiada rekod",
      paginate: {
        first: "Pertama",
        last: "Terakhir",
        next: "Seterus",
        previous: "Sebelum"
      }
    }
  })
  account.columns([4, 5, 6, 7]).visible(false)
  $("#popup_account").css("font-size", 13)

  $("#popup_account tbody").on("click", "tr", function () {
    var data = account.row(this).data()
    $("#akaun").val(data[0])
    $("#dummy_akaun").val(data[0])
    $("#pemilik").val(data[1])
    $("#jlkod").val(data[4])
    $("#dummy_jlkod").val(data[2])
    $("#kwkod").val(data[5])
    $("#dummy_kwkod").val(data[6])
    $("#htkod").val(data[7])
    $("#dummy_htkod").val(data[3])

    $("#akaun_popup").modal("toggle")
  })

  $("#form-cost-benchmark").submit(function (e) {
    e.preventDefault()
    ajax.send("Vendor/insertcostbenchmark", helpers.serialize(this), costBenchMarkCallBack)
  })
  function costBenchMarkCallBack(result) {
    if (result.success === true) {
      swal(
        {
          title: "Berjaya!",
          text: "Telah berjaya direkodkan, Sila muatnaik dokumen sokongan.",
          icon: "success",
          button: true
        },
        function () {
          $("#cost-benchmark").DataTable().ajax.reload()
        }
      )
    } else {
      swal("Oops...", "Tidak berjaya direkodkan!", "error")
    }
  }
})
