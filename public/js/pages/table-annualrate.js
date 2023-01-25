$(document).ready(function () {
  $("#annualrate").DataTable({
    pageLength: 15,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "annualratetable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "kws_knama",
      },
      {
        targets: 1,
        orderable: false,
        data: "hrt_hnama",
      },
      {
        targets: 2,
        orderable: false,
        data: "kaw_kadar",
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
