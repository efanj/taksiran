$(document).ready(function () {
  $("#vendorinfo").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "vendorinfotable",
    select: "single",
    columnDefs: [
      {
        width: "10%",
        targets: 0,
        data: "pid_plgid",
      },
      {
        targets: 1,
        data: "pid_pnama",
      },
      {
        targets: 2,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.val_almt1 + "<br/>"
            if (row.val_almt2 != null) {
              data += row.val_almt2 + "<br/>"
            }
            if (row.val_almt3 != null) {
              data += row.val_almt3 + "<br/>"
            }
            if (row.val_almt4 != null) {
              data += row.val_almt4 + "<br/>"
            }
            if (row.val_almt5 != null) {
              data += row.val_almt5 + "<br/>"
            }
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
  $("#vendorinfo tbody").css("font-size", 13)
})
