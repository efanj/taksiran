$(document).ready(function () {
  var $validator = $("#calcBuilding form").validate({
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
  $("#calc-building").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      // var validated = $("#calcBuilding form").valid()
      // if (!validated) {
      //   $validator.focusInvalid()
      //   return false
      // }
      return true
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
        $("#calc-building").find(".pager .next").hide()
        $("#calc-building").find(".pager .finish").show()
        $("#calc-building").find(".pager .finish").removeClass("disabled")
      } else {
        $("#calc-building").find(".pager .next").show()
        $("#calc-building").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#calc-building .finish").click(function (e) {
    e.preventDefault()
    var data = $("#calcBuilding").serialize()
    $.ajax({
      url: config.root + "calculator/buildingSubmit",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      // console.log(result.success)
      if (result === true) {
        swal(
          {
            title: "Berjaya!",
            text: "Nilaian Bangunan, Telah berjaya direkodkan.",
            icon: "success",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Ok",
            closeOnConfirm: false
          },
          function () {
            window.location = config.root + "amendment/amendlists"
          }
        )
      } else {
        swal("Oops...", "Nilaian Kediaman, tidak berjaya direkodkan!", "error")
      }
    })
  })

  $("#calc-building #update_rate").click(function (e) {
    e.preventDefault()
    var rate = $("#rate").val()
    var kwkod = $("#kwkod").val()
    var htkod = $("#htkod").val()
    $.ajax({
      url: config.root + "elements/updateRate",
      type: "post",
      dataType: "json",
      data: { rate: rate, kwkod: kwkod, htkod: htkod }
    }).done(function (result) {
      // console.log(result.success)
      if (result === true) {
        swal("Berjaya", "Kemaskini kadar, telah Berjaya direkodkan.", "success")
      } else {
        swal("Oops...", "Kemaskini kadar, tidak berjaya direkodkan!", "error")
      }
    })
  })
})
