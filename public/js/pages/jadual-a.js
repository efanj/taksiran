$(document).ready(function () {
  var popup_meeting = $("#popup_meeting").DataTable({
    order: [[0, "desc"]],
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
  $("#popup_meeting").css("font-size", 13)

  $("#popup_meeting tbody").on("click", "tr", function () {
    var data_meeting = popup_meeting.row(this).data()
    $("#mja_tkhpl").val(data_meeting[2])
    $("#mja_tkhtk").html(data_meeting[3])
    $("#mjaTkhtk").val(data_meeting[3])
    $("#mesyuarat_popup").modal("hide")
  })

  var popup_reason = $("#popup_reason").DataTable({
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
  $("#popup_reason").css("font-size", 13)

  $("#popup_reason tbody").on("click", "tr", function () {
    var data_reason = popup_reason.row(this).data()
    console.log(data_reason)
    $("#mja_sbkod").val(data_reason[0])
    $("#dummy_mja_sbkod").val(data_reason[1])
    $("#reason_popup").modal("toggle")
  })
})
