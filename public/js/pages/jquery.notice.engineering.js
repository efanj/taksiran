function format_permit(d) {
  // `d` is the original data object for the row
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%;">' + "<tr>" + "<td width='13%'><b>No Akaun:</b></td>" + "<td width='20%'>" + d.prmt_akaun + "</td>" + "<td width='13%'><b>Luas Dibenarkan:</b></td>" + "<td width='20%'>" + d.prmt_lsbgnallow + "</td>" + "<td width='13%'><b>Luas SetBack:</b></td>" + "<td width='21%'>" + d.prmt_lsstbck + "</td>" + "</tr>" + "<tr>" + "<td><b>Jumlah Denda:</b></td>" + "<td>" + d.prmt_amt + "</td>" + "<td><b>Jumlah Denda Tahunan:</b></td>" + "<td colspan='3'>" + d.prmt_amt_thnan + "</td>" + "</tr>" + "</table>"
}

function format_notis(d) {
  // `d` is the original data object for the row
  return (
    '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%;">' +
    "<tr>" +
    "<td colspan='6' style='background-color:#ddd;'><b>NOTIS PENGUBAHSUAIAN</b></td>" +
    "</tr>" +
    "<tr>" +
    "<td><b>Tarikh Notis :</b></td>" +
    "<td>" +
    d.tkpgbh +
    "</td>" +
    "<td><b>Rujukkan Pejabat :</b></td>" +
    "<td>" +
    d.rujpgbh +
    "</td>" +
    "<td></td>" +
    "<td>" +
    "</td>" +
    "</tr>" +
    "<tr>" +
    "<tr>" +
    "<td colspan='6' style='background-color:#ddd;'><b>NOTIS TAHUNAN</b></td>" +
    "</tr>" +
    "<td><b>Rujukkan Pejabat :</b></td>" +
    "<td>" +
    d.rujfilthn +
    "</td>" +
    "<td><b>Rujukkan Pemilik :</b></td>" +
    "<td colspan='3'>" +
    d.rujpegthn +
    "</td>" +
    "</tr>" +
    "<tr>" +
    "<td><b>Tarikh Notis :</b></td>" +
    "<td>" +
    d.tknotisthn +
    "</td>" +
    "<td><b>Tarikh Bermula :</b></td>" +
    "<td>" +
    d.prmt_tkh_bermula +
    "</td>" +
    "<td><b>Tarikh Berakhir :</b></td>" +
    "<td>" +
    d.prmt_tkh_sebelum +
    "</td>" +
    "</tr>" +
    "<tr>" +
    "<td colspan='6'><b>Perkara :</b></td>" +
    "</tr>" +
    "<tr>" +
    "<td colspan='6'>" +
    d.prmt_perkara +
    "</td>" +
    "</tr>" +
    "</table>"
  )
}
function format_notis_tahunan(d) {
  // `d` is the original data object for the row
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%;">' + "<tr>" + "<td colspan='6' style='background-color:#ddd;'><b>NOTIS TAHUNAN</b></td>" + "</tr>" + "<td><b>Rujukkan Pejabat :</b></td>" + "<td>" + d.rujfilthn + "</td>" + "<td><b>Rujukkan Pemilik :</b></td>" + "<td colspan='3'>" + d.rujpegthn + "</td>" + "</tr>" + "<tr>" + "<td><b>Tarikh Notis :</b></td>" + "<td>" + d.tknotisthn + "</td>" + "<td><b>Tarikh Bermula :</b></td>" + "<td>" + d.tkmulathn + "</td>" + "<td><b>Tarikh Berakhir :</b></td>" + "<td>" + d.tksblomthn + "</td>" + "</tr>" + "<tr>" + "<td colspan='6'><b>Perkara :</b></td>" + "</tr>" + "<tr>" + "<td colspan='6'>" + d.perkarathn + "</td>" + "</tr>" + "</table>"
}
$(document).ready(function () {
  var permit = $("#permit").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "getPermit",
    select: "single",
    columnDefs: [
      {
        width: "2%",
        targets: 0,
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: ""
      },
      {
        data: "prmt_permit",
        orderable: false,
        targets: 1,
        render: function (data, type, row, meta) {
          console.log(row)
          if (type === "display") {
            if (data === true) {
              data = "Ada"
            } else {
              data = "Tiada"
            }
          }
          return data
        }
      },
      { data: "prmt_nolot", targets: 2, orderable: false },
      {
        width: "25%",
        targets: 3,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.prmt_nmpmk + "<br/>"
            if (row.prmt_adpg1 != null) {
              data += row.prmt_adpg1 + "<br/>"
            }
            if (row.prmt_adpg2 != null) {
              data += row.prmt_adpg2 + "<br/>"
            }
            if (row.prmt_adpg3 != null) {
              data += row.prmt_adpg3 + "<br/>"
            }
            if (row.prmt_adpg4 != null) {
              data += row.prmt_adpg1
            }
          }

          return data
        }
      },
      { data: "prmt_lstnh", targets: 4, orderable: false },
      {
        data: null,
        orderable: false,
        targets: 5,
        render: function (data, type, row, meta) {
          console.log(row)
          if (type === "display") {
            data = row.prmt_lsbgn_asal + "<br/>" + row.prmt_lsbgn_tmbh
          }
          return data
        }
      },
      {
        data: "prmt_thnan",
        orderable: false,
        targets: 6,
        render: function (data, type, row, meta) {
          if (type === "display") {
            if (data === true) {
              data = "Ada"
            } else {
              data = "Tiada"
            }
          }
          return data
        }
      },
      { data: "prmt_tahun", targets: 7 },
      { data: "name", targets: 8 },
      {
        width: "15%",
        targets: 9,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          console.log(row)
          if (type === "display") {
            data = '<a href="permitView/' + row.id + '" class="btn btn-default btn-alt btn-sm" type="button" title="Maklumat Lengkap"><i class="fa fa-eye"></i></a> '
            data += '<div class="btn-group btn-group-sm" role="group">'
            data += '<a href="createnotice/' + row.id + '" class="btn btn-primary btn-alt btn-sm" type="button" title="Notis Pengubahsuaian">Notis</a>'
            data += '<a href="createyearlynotice/' + row.id + '" class="btn btn-primary btn-alt btn-sm" type="button" title="Notis Tahunan">Notis Tahunan</a>'
            data += "</div>"
          }

          return data
        }
      }
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
        previous: "Sebelumnya"
      }
    }
  })

  // Add event listener for opening and closing details
  $("#permit tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = permit.row(tr)

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide()
      tr.removeClass("shown")
    } else {
      // Open this row
      row.child(format_permit(row.data())).show()
      tr.addClass("shown")
    }
  })
  $("#pegangan tbody").css("font-size", 11)

  var notis = $("#notis").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "getNotice",
    select: "single",
    columnDefs: [
      {
        width: "2%",
        targets: 0,
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: ""
      },
      {
        targets: 1,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.prmt_akaun + "<br/>"
            data += row.prmt_nolot
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
            data = "<b>" + row.pmk_nmbil + "</b><br/>" + row.adpg1 + "<br/>"
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
        }
      },
      {
        targets: 3,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.prmt_lsbgn_asal + "<br/>"
            data += row.prmt_lstnh
          }
          return data
        }
      },
      { data: "prmt_lsbgn_tmbh", targets: 4 },
      {
        targets: 5,
        searchable: false,
        orderable: false,
        data: "prmt_thnan",
        render: function (data, type, row, meta) {
          console.log(data)
          if (type === "display") {
            if (data === true) {
              data = "Ada"
            } else {
              data = "Tiada"
            }
          }
          return data
        }
      },
      { data: "prmt_lsbgnallow", targets: 6 },
      {
        targets: 7,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "RM " + row.prmt_amt + "<br/>"
            if (row.prmt_amt_thnan != "") {
              data += "RM " + row.prmt_amt_thnan
            }
          }
          return data
        }
      },
      {
        targets: 8,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.workerid + " - " + row.name
          }
          return data
        }
      },
      {
        targets: 9,
        orderable: false,
        className: "dt-body-center",
        data: "acct",
        render: function (data, type, row, meta) {
          // console.log(data);
          if (type === "display") {
            data = '<a href="notisView/' + row.idpgbh + '" class="btn btn-sm btn-primary" title="Print Notis Pengubahsuaian" id="view_notis"><i class="glyphicon glyphicon-print"></i> Cetak Notis</a>'
          }
          return data
        }
      }
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
        previous: "Sebelumnya"
      }
    }
  })

  // Add event listener for opening and closing details
  $("#notis tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = notis.row(tr)

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide()
      tr.removeClass("shown")
    } else {
      // Open this row
      row.child(format_notis(row.data())).show()
      tr.addClass("shown")
    }
  })

  var notis_tahunan = $("#notis_tahunan").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: {
      url: "../getTableNoticeYearly",
      type: "POST",
      data: function (d) {
        d.id = $("#file_id").val()
      }
    },
    select: "single",
    columnDefs: [
      {
        width: "2%",
        targets: 0,
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: ""
      },
      {
        targets: 1,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.prmt_akaun + "<br>" + row.prmt_nolot
          }
          return data
        }
      },
      {
        width: "25%",
        targets: 2,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = "<b>" + row.nmbil + "</b><br/>" + row.adpg1 + "<br/>"
            if (row.adpg2 != null) {
              data += row.adpg2 + "<br/>"
            }
            if (row.adpg3 != null) {
              data += row.adpg3 + "<br/>"
            }
            if (row.adpg4 != null) {
              data += row.adpg4
            }
          }
          return data
        }
      },
      {
        targets: 3,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          console.log(row)
          if (type === "display") {
            data = row.prmt_lsbgn_asal + "<br>" + row.prmt_lstnh
          }
          return data
        }
      },
      { data: "prmt_lsbgn_tmbh", targets: 4, orderable: false },
      { data: "prmt_tahun", targets: 5, orderable: false },
      { data: "name", targets: 6, orderable: false },
      {
        targets: 7,
        orderable: false,
        className: "dt-body-center",
        data: "acct",
        render: function (data, type, row, meta) {
          // console.log(data)
          if (type === "display") {
            data = '<div class="btn-group btn-group-xs" role="group">' + '<a href="../notisthnView/' + row.idthn + '" class="btn btn-default" title="Print Notis"><i class="fa fa-print"></i></a>' + "</div>"
          }

          return data
        }
      }
    ],
    order: [[0, "asc"]],
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
  // Add event listener for opening and closing details
  $("#notis_tahunan tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = notis_tahunan.row(tr)

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide()
      tr.removeClass("shown")
    } else {
      // Open this row
      row.child(format_notis_tahunan(row.data())).show()
      tr.addClass("shown")
    }
  })
})
