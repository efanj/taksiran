$(document).ready(function () {
  $("#location").DataTable({
    pageLength: 15,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50]
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "locationtable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "mkm_mkkod"
      },
      {
        targets: 1,
        orderable: false,
        data: "mkm_mnama"
      },
      {
        targets: 2,
        orderable: false,
        data: "kws_kwkod"
      },
      {
        targets: 3,
        orderable: false,
        data: "kws_knama"
      },
      {
        targets: 4,
        orderable: false,
        data: "jln_jlkod"
      },
      {
        targets: 5,
        orderable: false,
        data: "jln_jnama"
      },
      {
        targets: 6,
        orderable: false,
        data: "jln_poskd"
      },
      {
        targets: 7,
        orderable: false,
        data: "jln_negri"
      },
      {
        targets: 8,
        orderable: false,
        data: "pos_pskod"
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
  $("#location tbody").css("font-size", 13)
})
