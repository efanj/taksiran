$(document).ready(function () {
  var siasatan_engineering = $("#siasatan_engineering").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "getSiasatanTapak",
    select: "single",
    columnDefs: [
      { data: "no_akaun", targets: 0 },
      { data: "peg_nolot", targets: 1, orderable: false },
      {
        targets: 2,
        searchable: false,
        orderable: false,
        data: null,
        render: function (data, type, row, meta) {
          // console.log(row);
          if (type === "display") {
            data = row.adpg1
            if (row.adpg2 == null) {
              data += "</br>" + row.adpg2
            }
            if (row.adpg3 == null) {
              data += "</br>" + row.adpg3
            }
            if (row.adpg4 == null) {
              data += "</br>" + row.adpg4
            }
          }
          return data
        }
      },
      { data: "peg_lsbgn", targets: 3, orderable: false },
      { data: "peg_lstnh", targets: 4, orderable: false },
      { data: "peg_lsans", targets: 5, orderable: false },
      { data: "bgn_tmbh", targets: 6, orderable: false },
      { data: "anso_tmbh", targets: 7, orderable: false },
      { data: "entry", targets: 8, orderable: false },
      {
        targets: 9,
        orderable: false,
        className: "dt-body-center",
        data: "akaun",
        render: function (data, type, row, meta) {
          if (type === "display") {
            data = '<div class="btn-group btn-group-sm" role="group">'
            data += '<a href="createPermit/' + row.akaun + '" class="btn btn-default btn-sm" title="View"><i class="fa fa-eye color-dark"></i></a>'
            data += "</div>"
          }

          return data
        }
      }
    ],
    order: [[0, "asc"]],
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
        previous: "Sebelumnya"
      }
    }
  })
  $("#siasatan_engineering tbody").css("font-size", 13)

  var table = $("#popup_mesyuarat").DataTable({
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
        previous: "Sebelumnya"
      }
    }
  })

  var table_jalan = $("#popup_jalan").DataTable({
    columnDefs: [
      {
        targets: [0],
        visible: false,
        searchable: false
      },
      {
        targets: [1],
        visible: false,
        searchable: false
      }
    ],
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
        previous: "Sebelumnya"
      }
    }
  })

  $("#popup_mesyuarat tbody").on("click", "tr", function () {
    var data = table.row(this).data()
    var date_mjc_tkhpl = moment(data[2], "DD-MM-YYYY").format("DD/MM/YYYY")
    $("#mjc_tkhpl").val(date_mjc_tkhpl)
    var date_mjc_tkhtk = moment(data[3], "DD-MM-YYYY").format("DD/MM/YYYY")
    $("#mjc_tkhtk").html(date_mjc_tkhtk)
    // var myModalEl = document.getElementById('staticBackdrop')
    $("#staticBackdrop").modal("toggle")
  })

  $("#popup_jalan tbody").on("click", "tr", function () {
    var data_jalan = table_jalan.row(this).data()
    console.log(data_jalan)
    $("#mjc_jlkod").val(data_jalan[2])

    $("#mjc_kwkod").html(data_jalan[4])
    $("#jalan_popup").modal("toggle")
  })
})
