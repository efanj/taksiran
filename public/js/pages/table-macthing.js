$(document).ready(function () {
  $("#macthing").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 10, 15, 20],
      [5, 10, 15, 20],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "macthingtable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.peg_akaun + "<br/>" + row.peg_nompt
          }
          return data
        },
      },
      {
        targets: 1,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.pmk_nmbil + "<br/>"
            if (row.pvd_almt1 != null) {
              data += row.pvd_almt1 + "<br/>"
            }
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
      {
        targets: 2,
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
              data += row.adpg4
            }
          }
          return data
        },
      },
      {
        targets: 3,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.jln_knama + "<br/>" + row.jln_jnama
          }
          return data
        },
      },
      {
        targets: 4,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.jpk_jnama + "<br/>" + row.hrt_hnama
          }
          return data
        },
      },
      {
        targets: 5,
        orderable: false,
        className: "text-center",
        data: null,
        render: function (data, type, row, meta) {
          console.log(data)
          if (type === "display") {
            data = '<a href="macthaccount/' + row.id + '" class="btn btn-primary btn-sm mr5 mb10">Padan</a>'
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
  $("#macthing tbody").css("font-size", 13)
})
