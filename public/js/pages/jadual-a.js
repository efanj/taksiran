$(document).ready(function () {
  var popup_meeting = $("#popup_meeting").DataTable({
    processing: true,
    serverSide: true,
    select: "single",
    searching: false,
    serverMethod: "post",
    ajax: config.root + "elements/meetingtable",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "mcm_blngn"
      },
      {
        targets: 1,
        orderable: false,
        data: "eld3"
      },
      {
        targets: 2,
        orderable: false,
        data: "mcm_tkhpl"
      },
      {
        targets: 3,
        orderable: false,
        data: "mcm_tkhtk"
      },
      {
        targets: 4,
        orderable: false,
        data: "mcm_kkrja"
      }
    ],
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
    $("#mja_tkhpl").val(data_meeting.mcm_tkhpl)
    $("#mja_tkhtk").html(data_meeting.mcm_tkhtk)
    $("#mjaTkhtk").val(data_meeting.mcm_tkhtk)
    $("#mesyuarat_popup").modal("hide")
  })

  var popup_reason = $("#popup_reason").DataTable({
    processing: true,
    serverSide: true,
    select: "single",
    searching: false,
    serverMethod: "post",
    ajax: config.root + "elements/reasontable",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "acm_sbkod"
      },
      {
        targets: 1,
        orderable: false,
        data: "acm_sbktr"
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
  $("#popup_reason").css("font-size", 13)

  $("#popup_reason tbody").on("click", "tr", function () {
    var data_reason = popup_reason.row(this).data()
    console.log(data_reason)
    $("#mja_sbkod").val(data_reason.acm_sbkod)
    $("#dummy_mja_sbkod").val(data_reason.acm_sbktr)
    $("#reason_popup").modal("toggle")
  })
})
