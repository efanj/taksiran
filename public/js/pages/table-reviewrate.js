var reviewrate
function add_action(el) {
  var tr_el = el.closest("tr")
  var row = reviewrate.row(tr_el)
  var row_data = row.data()
  $("#kws_kwkod").val(row_data.kws_kwkod)
  $("#area").html(row_data.kws_knama)
  $("#hrt_htkod").val(row_data.hrt_htkod)
  $("#property").html(row_data.hrt_hnama)
  $("#current_rate").html(row_data.kaw_kadar)
  $("#new_rate").val(row_data.kadar_nilai)
}
function initDataTable() {
  reviewrate = $("#reviewrate").DataTable({
    pageLength: 15,
    lengthMenu: [
      [5, 15, 25, 50],
      [5, 15, 25, 50]
    ],
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: "reviewratetable",
    select: "single",
    columnDefs: [
      {
        width: "30%",
        targets: 0,
        orderable: false,
        data: "kws_knama"
      },
      {
        width: "30%",
        targets: 1,
        orderable: false,
        data: "hrt_hnama"
      },
      {
        width: "15%",
        targets: 2,
        orderable: false,
        className: "text-center",
        data: "kaw_kadar"
      },
      { width: "2%", data: "kws_kwkod", targets: 3, visible: false, searchable: false },
      { width: "3%", data: "hrt_htkod", targets: 4, visible: false, searchable: false },
      {
        width: "15%",
        targets: 5,
        orderable: false,
        className: "text-center",
        data: "kadar_nilai"
      },
      {
        width: "10%",
        targets: 6,
        orderable: false,
        className: "text-center",
        data: null,
        render: function (data, type, row, meta) {
          // console.log(data);
          if (type === "display") {
            data = '<button type="button" onclick="add_action(this)" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_add"><i class="fa fa-pencil-square-o"></i> Kemaskini</button>'
          }
          return data
        }
      }
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
        previous: "Sebelumnya"
      }
    }
  })
  return reviewrate
}
$(document).ready(function () {
  var reviewrate = initDataTable()
  $("#add_action").on("click", function (e) {
    e.preventDefault()
    ajax.send(
      "filecode/updateReviewRate",
      {
        kws_kwkod: $("#kws_kwkod").val(),
        hrt_htkod: $("#hrt_htkod").val(),
        new_rate: $("#new_rate").val()
      },
      updateCallBack
    )
  })

  function updateCallBack(result) {
    if (result === true) {
      $("#modal_add").modal("hide")
      reviewrate.ajax.reload(null, false)
      Swal.fire({
        icon: "success",
        title: "Berjaya",
        title: "Data berjaya dikemaskini."
      })
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Data tidak berjaya dikemaskini!"
      })
    }
  }

  $("#modal_add").on("hidden.bs.modal", function () {
    $("#area").html("")
    $("#kws_kwkod").val("")
    $("#property").html("")
    $("#hrt_htkod").val("")
    $("#new_rate").val("")
  })
  $("#reviewrate").css("font-size", 13)
  $("#modal_table").css("font-size", 13)
})
