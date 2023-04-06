$(document).ready(function () {
  $("#list-users").DataTable({
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
  });

  $("#users-activity").DataTable({
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
  });
  // var listusers = $("#list-users").DataTable({
  //   processing: true,
  //   serverSide: true,
  //   serverMethod: "post",
  //   ajax: "getUsers",
  //   select: "single",
  //   columnDefs: [
  //     { data: "name", targets: 0 },
  //     { data: "role", targets: 1 },
  //     {
  //       targets: 2,
  //       orderable: false,
  //       className: "dt-body-center",
  //       data: "department",
  //       render: function (data, type, row, meta) {
  //         //   console.log(row.role);
  //         if (type === "display") {
  //           data = "<span ";
  //           if (row.role === "admin") {
  //             data += 'class="badge rounded-pill bg-primary">';
  //           } else if (row.role === "jurutera") {
  //             data += 'class="badge rounded-pill bg-success">';
  //           } else if (row.role === "penilaian") {
  //             data += 'class="badge rounded-pill bg-info">';
  //           }
  //           data += "</span>";
  //         }

  //         return data;
  //       },
  //     },
  //     { data: "email", targets: 3 },
  //     {
  //       targets: 4,
  //       orderable: false,
  //       className: "dt-body-center",
  //       data: "is_email_activated",
  //       render: function (data, type, row, meta) {
  //         // console.log(data);
  //         if (type === "display") {
  //           if (row.is_email_activated === 1) {
  //             data = '<i class="fas fa-check"></i>';
  //           } else {
  //             data = '<i class="fa fa-times"></i>';
  //           }
  //         }

  //         return data;
  //       },
  //     },
  //     {
  //       targets: 5,
  //       orderable: false,
  //       className: "dt-body-center",
  //       data: "id",
  //       render: function (data, type, row, meta) {
  //         // console.log(data);
  //         if (type === "display") {
  //           data =
  //             '<div class="btn-group btn-group-sm" role="group">' +
  //             '<a href="b/' +
  //             data +
  //             '" class="btn btn-primary" title="Kemas-kini"><i class="fas fa-pencil-alt"></i></a>' +
  //             '<a href="b/' +
  //             data +
  //             '" class="btn btn-danger" title="Padam"><i class="fa fa-times"></i></a>' +
  //             "</div>";
  //         }

  //         return data;
  //       },
  //     },
  //   ],
  //   order: [[2, "asc"]],
  //   language: {
  //     search: "Saring:",
  //     lengthMenu: "Paparkan _MENU_ rekod",
  //     zeroRecords: "Tiada maklumat yang dijumpai",
  //     info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
  //     infoEmpty: "Tiada rekod",
  //     paginate: {
  //       first: "Pertama",
  //       last: "Terakhir",
  //       next: "Seterusnya",
  //       previous: "Sebelumnya",
  //     },
  //   },
  // });
});
