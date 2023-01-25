$(document).ready(function () {
  var handleinfo = $("#handleinfo").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "handleinfotable",
    select: "single",
    columnDefs: [
      {
        width: "2%",
        targets: 0,
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
      {
        width: "10%",
        targets: 1,
        data: "peg_akaun",
      },
      {
        width: "10%",
        targets: 2,
        data: "peg_nolot",
      },
      {
        targets: 3,
        data: "pvd_pnama",
      },
      {
        targets: 4,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.adpg1 + "<br/>"
            if (row.adpg2 != null) {
              data += row.adpg2 + "<br/>"
            }
            if (row.adpg3 != null) {
              data += row.adpg3 + "<br/>"
            }
            if (row.adpg4 != null) {
              data += row.adpg4 + "<br/>"
            }
          }

          return data
        },
      },
      {
        targets: 5,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.pvd_almt1 + "<br/>"
            if (row.pvd_almt2 != null) {
              data += row.pvd_almt2 + "<br/>"
            }
            if (row.pvd_almt3 != null) {
              data += row.pvd_almt3 + "<br/>"
            }
            if (row.pvd_almt4 != null) {
              data += row.pvd_almt4 + "<br/>"
            }
            if (row.pvd_almt5 != null) {
              data += row.pvd_almt5 + "<br/>"
            }
            if (row.pvd_notel != null) {
              data += "Telefon : " + row.pvd_notel + "<br/>"
            }
            if (row.pvd_nofax != null) {
              data += "Fax : " + row.pvd_nofax + "<br/>"
            }
            if (row.pvd_email != null) {
              data += "Emel : " + row.pvd_email + "<br/>"
            }
          }

          return data
        },
      },
      {
        targets: 6,
        data: "jpk_jnama",
      },
      {
        targets: 7,
        orderable: false,
        data: "peg_statf",
        render: function (data, type, row, meta) {
          if (row.peg_statf === "Y") {
            data = "Belum Proses Bil"
          }
          if (row.peg_statf === "P") {
            data = "Sudah Proses Bil"
          }
          if (row.peg_statf === "D") {
            data = "Dikenakan denda Lewat"
          }
          if (row.peg_statf === "N") {
            data = "DiKenakan Notis E"
          }
          if (row.peg_statf === "W") {
            data = "Dikenakan Waran F"
          }
          if (row.peg_statf === "H") {
            data = "Akaun Tak Aktif (Hapus)"
          }

          return data
        },
      },
      {
        targets: 8,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(data);
          if (type === "display") {
            data = '<div class="btn-group btn-group-sm" role="group">' + '<a href="javascript:void(0)" class="btn btn-default" type="button" title="Print" id="btn_print" data-akaun="' + row.acct + '"><i class="fa fa-print"></i></a>'
            data += '<a href="investigation/' + row.acct + '" class="btn btn-default" type="button" title="Semakan">Semakan</a>'
            data += '<div class="btn-group dropdown">'
            data += '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Jadual <span class="caret"></span></button>'
            data += '<ul class="dropdown-menu right animated fadeIn" role="menu" style="margin-left: -46.5px;">'
            data += '<li><a href="../Account/eliminated/' + row.acct + '">Jadual A</a></li>'
            data += '<li><a href="../Account/amendaccount/' + row.acct + '">Jadual B</a></li>'
            data += '<li><a href="../Account/evaluation/' + row.acct + '">Jadual B(PS)</a></li>'
            data += "</ul></div></div></div>"
          }

          return data
        },
      },
    ],
    order: [[1, "asc"]],
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
        previous: "Sebelumnya",
      },
    },
  })

  // Add event listener for opening and closing details
  $("#handleinfo tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = handleinfo.row(tr)

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide()
      tr.removeClass("shown")
    } else {
      // Open this row
      row.child(format_pegangan(row.data())).show()
      tr.addClass("shown")
    }
  })
  $("#handleinfo tbody").css("font-size", 13)
})
