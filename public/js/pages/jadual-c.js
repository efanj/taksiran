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
    $("#mjc_tkhpl").val(data_meeting.mcm_tkhpl)
    $("#mjc_tkhtk").html(data_meeting.mcm_tkhtk)
    $("#mjcTkhtk").val(data_meeting.mcm_tkhtk)
    $("#mesyuarat_popup").modal("hide")
  })

  var popup_street = $("#popup_street").DataTable({
    processing: true,
    serverSide: true,
    select: "single",
    searching: false,
    serverMethod: "post",
    ajax: config.root + "elements/streettable",
    columnDefs: [
      {
        targets: 0,
        orderable: false,
        data: "jln_jlkod"
      },
      {
        targets: 1,
        orderable: false,
        data: "kws_kwkod"
      },
      {
        targets: 2,
        orderable: false,
        data: "jln_jnama"
      },
      {
        targets: 3,
        orderable: false,
        data: "jln_poskd"
      },
      {
        targets: 4,
        orderable: false,
        data: "kws_knama"
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
  $("#popup_street").css("font-size", 13)

  $("#popup_street tbody").on("click", "tr", function () {
    var data_street = popup_street.row(this).data()
    $("#dummy_mjc_jlkod").val(data_street.jln_jnama)
    $("#mjc_jlkod").val(data_street.jln_jlkod)
    $("#mjc_kwkod").html(data_street.kws_knama)
    $("#kawKwkod").val(data_street.kws_kwkod)
    $("#street_popup").modal("toggle")
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
    $("#mjc_sbkod").val(data_reason.acm_sbkod)
    $("#dummy_mjc_sbkod").val(data_reason.acm_sbktr)
    $("#reason_popup").modal("toggle")
  })

  var popup_customer = $("#popup_customer").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: config.root + "elements/customertable",
    select: "single",
    columns: [
      { data: "pid_plgid", targets: 0 },
      { data: "pid_pnama", targets: 1 }
    ],
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

  $("#popup_customer").css("font-size", 13)

  $("#popup_customer tbody").on("click", "tr", function () {
    var customer = popup_customer.row(this).data()
    $("#mjc_plgid").val()
    $("#mjc_plgid").val(customer["pid_plgid"])
    $("#nama_pemilik").html(customer["pid_pnama"])
    $("#mjc_nmbil").val(customer["pid_pnama"])

    if ($.fn.dataTable.isDataTable("#popup_customeraddress")) {
      $("#popup_customeraddress").DataTable().clear()
      $("#popup_customeraddress").DataTable().destroy()
      $("#popup_customeraddress").empty()
    }

    var table_customeraddress = $("#popup_customeraddress").DataTable({
      ajax: {
        url: config.root + "elements/customeraddtable",
        type: "POST",
        data: function (d) {
          d.id_search = customer["pid_plgid"]
        }
      },
      select: "single",
      columns: [
        { data: "val_amtid", targets: 0 },
        { data: "pid_pnama", targets: 1 },
        {
          targets: 2,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.val_almt1 + "<br/>"
              if (row.val_almt2 != null) {
                data += row.val_almt2 + "<br/>"
              }
              if (row.val_almt3 != null) {
                data += row.val_almt3 + "<br/>"
              }
              if (row.val_almt4 != null) {
                data += row.val_almt4 + "<br/>"
              }
              if (row.val_almt5 != null) {
                data += row.val_almt5
              }
            }

            return data
          }
        }
      ],
      order: [[1, "asc"]],
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
    $("#popup_customer").css("font-size", 13)
    $("#customer_popup").modal("toggle")

    $("#popup_customeraddress tbody").on("click", "tr", function () {
      var data
      var data_custadd = table_customeraddress.row(this).data()
      // console.log(data_custadd);
      $("#mjc_amtid").val(data_custadd["val_amtid"])
      data = data_custadd["val_almt1"] + ","
      if (data_custadd["val_almt2"] != null) {
        data += data_custadd["val_almt2"] + ","
      }
      if (data_custadd["val_almt3"] != null) {
        data += data_custadd["val_almt3"] + ","
      }
      if (data_custadd["val_almt4"] != null) {
        data += data_custadd["val_almt4"] + ","
      }
      if (data_custadd["val_almt5"] != null) {
        data += data_custadd["val_almt5"]
      }
      $("#alamat_pemilik").html(data)
      $("#customeraddress_popup").modal("toggle")
    })
  })

  var $validator = $("#jadualc form").validate({
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
      mjcTkhpl: {
        required: true
      },
      mjcJlkod: {
        required: true
      },
      mjcAdpg1: {
        required: true
      },
      mjcThkod: {
        required: true
      },
      mjcBgkod: {
        required: true
      },
      mjcHtkod: {
        required: true
      },
      mjcStkod: {
        required: true
      },
      mjcJpkod: {
        required: true
      },
      mjcCodex: {
        required: true
      },
      mjcCodey: {
        required: true
      },
      mjcLstnh: {
        required: true
      },
      mjcSbkod: {
        required: true
      },
      mjcNmbil: {
        required: true
      },
      mjcAmtid: {
        required: true
      }
    },
    messages: {
      mjcTkhpl: {
        required: "Sila pilih tarikh"
      },
      mjcJlkod: {
        required: "Sila pilih jalan"
      },
      mjcAdpg1: {
        required: "Sila isi ruangan ini"
      },
      mjcThkod: {
        required: "Sila pilih"
      },
      mjcBgkod: {
        required: "Sila pilih"
      },
      mjcHtkod: {
        required: "Sila pilih"
      },
      mjcStkod: {
        required: "Sila pilih"
      },
      mjcJpkod: {
        required: "Sila pilih"
      },
      mjcCodex: {
        required: "Klik pada map untuk dapatkan koordinat"
      },
      mjcCodey: {
        required: "Klik pada map untuk dapatkan koordinat"
      },
      mjcLstnh: {
        required: "Sila isi ruangan ini"
      },
      mjcSbkod: {
        required: "Sila pilih"
      },
      mjcNmbil: {
        required: "Sila isi ruangan ini"
      },
      mjcAmtid: {
        required: "Sila isi ruangan ini"
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
  $("#jadualc").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      var validated = $("#jadualc form").valid()
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
        $("#jadualc").find(".pager .next").hide()
        $("#jadualc").find(".pager .finish").show()
        $("#jadualc").find(".pager .finish").removeClass("disabled")
      } else {
        $("#jadualc").find(".pager .next").show()
        $("#jadualc").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#jadualc .finish").click(function (e) {
    e.preventDefault()
    var data = $("#jadualC").serialize()
    $.ajax({
      url: config.root + "account/createAcct",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      console.log(result.success)
      if (result.success === true) {
        swal(
          {
            title: "Berjaya!",
            text: "Jadual C, Telah berjaya direkodkan.",
            icon: "success",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Ok",
            closeOnConfirm: false
          },
          function () {
            var calctype
            if (result.calctype === 1) {
              calctype = "calcland"
            } else {
              calctype = "calcbuilding"
            }
            window.location = config.root + "calculator/" + calctype + "/" + result.sirino
          }
        )
      } else {
        swal("Oops...", "Jadual C, tidak berjaya direkodkan!", "error")
      }
    })
  })
})

function semakSumbangan(value) {
  var $jpkod = value
  ajax.send("account/getSumbangan", { jpkod: $jpkod }, getSumbanganCallBack)
}

function getSumbanganCallBack(result) {
  if (result["jpk_stcbk"] === "Y") {
    $("#dummy_mjc_Stcbk").prop("checked", true)
  } else {
    $("#dummy_mjc_Stcbk").prop("checked", false)
  }
  $("#mjc_Stcbk").val(result["jpk_stcbk"])
  // console.log(result)
}
