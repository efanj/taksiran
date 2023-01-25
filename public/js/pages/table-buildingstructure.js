$(document).ready(function () {
  $("#buildingstructure").DataTable({
    pageLength: 15,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "buildingstructuretable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "stb_stkod",
      },
      {
        targets: 1,
        orderable: false,
        data: "stb_snama",
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
