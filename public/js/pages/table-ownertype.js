$(document).ready(function () {
  $("#ownertype").DataTable({
    pageLength: 15,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "ownertypetable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "jpk_jpkod",
      },
      {
        targets: 1,
        orderable: false,
        data: "jpk_jnama",
      },
      {
        targets: 2,
        orderable: false,
        data: "jpk_itkod",
      },
      {
        targets: 3,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            if (row.jpk_stcbk === "Y") {
              data = "YA"
            }
            if (row.jpk_stcbk === "T") {
              data = "TIDAK"
            }
          }

          return data
        },
      },
    ],
    order: [[0, "asc"]],
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
        previous: "Sebelumnya",
      },
    },
  })
})
