$(document).ready(function () {
  $("#mjc_tkhoc").datepicker()
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
    $("#mjb_tkhpl").val(data_meeting.mcm_tkhpl)
    $("#mjb_tkhtk").html(data_meeting.mcm_tkhtk)
    $("#mjbTkhtk").val(data_meeting.mcm_tkhtk)
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
    $("#mjb_sbkod").val(data_reason.acm_sbkod)
    $("#dummy_mjb_sbkod").val(data_reason.acm_sbktr)
    $("#reason_popup").modal("toggle")
  })

  var $validator = $("#jadualps form").validate({
    errorPlacement: function (error, element) {
      var place = element.closest(".input-group")
      if (!place.get(0)) {
        place = element
      }
      if (place.get(0).type === "checkbox") {
        place = element.parent()
      }
      if (error.text() !== "") {
        place.after(error)
      }
    },
    errorClass: "help-block",
    rules: {
      mjb_tkhpl: {
        required: true
      },
      mjbThkod: {
        required: true
      },
      mjbBgkod: {
        required: true
      },
      mjbHtkod: {
        required: true
      },
      mjbStkod: {
        required: true
      }
    },
    messages: {
      mjb_tkhpl: {
        required: "Sila pilih tarikh"
      },
      mjbThkod: {
        required: "Sila pilih"
      },
      mjbBgkod: {
        required: "Sila pilih"
      },
      mjbHtkod: {
        required: "Sila pilih"
      },
      mjbStkod: {
        required: "Sila pilih"
      }
    },
    highlight: function (label) {
      $(label).closest(".form-group").removeClass("has-success").addClass("has-error")
    },
    success: function (label) {
      $(label).closest(".form-group").removeClass("has-error")
      label.remove()
    }
  })

  //init first wizard
  $("#jadualps").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      var validated = $("#jadualps form").valid()
      if (!validated) {
        $validator.focusInvalid()
        return false
      }
    },
    onTabClick: function (tab, navigation, index, newindex) {
      if (newindex == index + 1) {
        return this.onNext(tab, navigation, index, newindex)
      } else if (newindex > index + 1) {
        return false
      } else {
        return true
      }
    },
    onTabShow: function (tab, navigation, index) {
      tab.prevAll().addClass("completed")
      tab.nextAll().removeClass("completed")
      var $total = navigation.find("li").length
      var $current = index + 1
      // If it's the last tab then hide the last button and show the finish instead
      if ($current >= $total) {
        $("#jadualps").find(".pager .next").hide()
        $("#jadualps").find(".pager .finish").show()
        $("#jadualps").find(".pager .finish").removeClass("disabled")
      } else {
        $("#jadualps").find(".pager .next").show()
        $("#jadualps").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#jadualps .finish").click(function (e) {
    e.preventDefault()
    var data = $("#jadualPS").serialize()
    $.ajax({
      url: config.root + "account/createPS",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      console.log(result.success)
      if (result.success === true) {
        swal(
          {
            title: "Berjaya!",
            text: "Jadual B(PS), Telah berjaya direkodkan.",
            icon: "success",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Ok",
            closeOnConfirm: false
          },
          function () {
            window.location = config.root + "calculator/" + result.calcUrl + "/" + result.sirino
          }
        )
        // $("#calc_button_popup").modal("show")
      } else {
        swal("Oops...", "Jadual B(PS), tidak berjaya direkodkan!", "error")
      }
    })
  })
})
