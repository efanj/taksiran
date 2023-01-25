$(document).ready(function () {
  function format_ownerinfo(d) {
    // `d` is the original data object for the row
    return (
      '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">' +
      "<tr>" +
      "<td width='13%' style='background-color: #f4f5f5;'><b>Nama Pemilik:</b></td>" +
      "<td width='20%'>" +
      d.pvd_pnama +
      "</td>" +
      "<td width='13%' style='background-color: #f4f5f5;'><b>No. KP / Pendaftaran:</b></td>" +
      "<td width='20%'>" +
      d.pmk_plgid +
      "</td>" +
      "<td width='13%' style='background-color: #f4f5f5;'><b>Bangsa:</b></td>" +
      "<td width='21%'>" +
      d.pvd_wkbgsa +
      "</td>" +
      "</tr>" +
      "<tr>" +
      "<td style='background-color: #f4f5f5;'><b>Rujukan Majlis:</b></td>" +
      "<td>" +
      d.pmk_rujmj +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>No. Jilid:</b></td>" +
      "<td>" +
      d.pmk_jilid +
      "</td>" +
      "<td style='background-color: #f4f5f5;'><b>Dikecualikan Bil:</b></td>" +
      "<td>" +
      d.extn +
      "</td>" +
      "</tr>" +
      "</table>"
    )
  }
  var ownerinfo = $("#ownerinfo").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "ownerinfotable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        width: "2%",
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
      {
        data: "pmk_akaun",
        targets: 1,
      },
      {
        targets: 2,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(data);
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
              data += row.pvd_almt5
            }
          }

          return data
        },
      },
      { data: "pmk_wkdans", targets: 3 },
      { data: "pmk_prtus", targets: 4 },
      { data: "peg_wstatf", targets: 5 },
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
  $("#ownerinfo tbody").on("click", "td.details-control", function () {
    var tr = $(this).closest("tr")
    var row = ownerinfo.row(tr)

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide()
      tr.removeClass("shown")
    } else {
      // Open this row
      row.child(format_ownerinfo(row.data())).show()
      tr.addClass("shown")
    }
  })
  $("#ownerinfo tbody").css("font-size", 13)
})
