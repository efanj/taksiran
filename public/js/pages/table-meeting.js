$(document).ready(function () {
  $("#meeting").DataTable({
    pageLength: 15,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "meetingtable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "mcm_blngn",
      },
      {
        targets: 1,
        orderable: false,
        data: "mcm_bulan",
      },
      {
        targets: 2,
        orderable: false,
        data: "mcm_tkhpl",
      },
      {
        targets: 3,
        orderable: false,
        data: "mcm_tkhtk",
      },
      {
        targets: 4,
        orderable: false,
        data: "mcm_kkrja",
      },
      {
        targets: 5,
        orderable: false,
        data: "mcm_statf",
      },
    ],
    order: [[0, "desc"]],
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
