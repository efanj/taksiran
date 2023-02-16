$(document).ready(function () {
  var table = $("#sitereviews").DataTable({
    pageLength: 5,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50]
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "sitereviewtable",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.smk_akaun + "<br>" + row.smk_nolot + "<br>"
          }
          return data
        }
      },
      {
        targets: 1,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.smk_adpg1 + "<br>" + row.smk_adpg2 + "<br>"
          }
          return data
        }
      },
      {
        targets: 2,
        orderable: false,
        data: "jln_jnama"
      },
      {
        targets: 3,
        orderable: false,
        data: "hrt_hnama"
      },
      {
        targets: 4,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.smk_lsbgn + " m&sup2; <br>" + row.smk_lstnh + " m&sup2; <br>" + row.smk_lsans + " m&sup2;"
          }
          return data
        }
      },
      {
        targets: 5,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.smk_lsbgn_tmbh + " m&sup2; <br>" + row.smk_lsans_tmbh + " m&sup2;"
          }
          return data
        }
      },
      {
        targets: 6,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.hadapan + "<br>" + row.belakang
          }
          return data
        }
      },
      {
        targets: 7,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row.smk_type)
          if (type === "display") {
            if (row.smk_type === 1) {
              data = "<span class='label label-default'>Akaun Baru</span>"
            }
            if (row.smk_type === 2) {
              data = "<span class='label label-primary'>Pindaan</span>"
            }
            if (row.smk_type === 3) {
              data = "<span class='label label-success'>KemasKini Data</span>"
            }
          }
          return data
        }
      },
      { targets: 8, orderable: false, data: "smk_datevisit" },
      {
        targets: 9,
        orderable: true,
        data: null,
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = row.workerid + "</br>" + row.name
          }
          return data
        }
      }
    ],
    select: {
      style: "multi"
    },
    order: [[9, "asc"]],
    language: {
      search: "Saring : ",
      lengthMenu: "Paparkan _MENU_ rekod",
      zeroRecords: "Tiada maklumat yang dijumpai",
      info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
      infoEmpty: "Tiada rekod",
      infoFiltered: "(Ditapis daripada _MAX_ rekod)",
      paginate: {
        first: "Pertama",
        last: "Terakhir",
        next: "Seterus",
        previous: "Sebelum"
      }
    }
  })

  $("#sitereviews").css("font-size", 13)
})
