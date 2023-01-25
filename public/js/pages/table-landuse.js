$(document).ready(function () {
  $("#landuse").DataTable({
    pageLength: 10,
    lengthMenu: [
      [5, 10, 20, 50],
      [5, 10, 20, 50],
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "landusetable",
    select: "single",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "tnh_thkod",
      },
      {
        targets: 1,
        orderable: false,
        data: "tnh_tnama",
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
