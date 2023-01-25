$(document).ready(function () {
  var $validator = $("#calc-oilstation form").validate({
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
  $("#calc-oilstation").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      // var validated = $("#calc-oilstation form").valid()
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
        $("#calc-oilstation").find(".pager .next").hide()
        $("#calc-oilstation").find(".pager .finish").show()
        $("#calc-oilstation").find(".pager .finish").removeClass("disabled")
      } else {
        $("#calc-oilstation").find(".pager .next").show()
        $("#calc-oilstation").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#calc-oilstation .finish").click(function (e) {
    e.preventDefault()
    var data = $("#calcOilStation").serialize()
    $.ajax({
      url: config.root + "calculator/oilStationSubmit",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      // console.log(result.success)
      if (result.success === true) {
        swal(
          {
            title: "Berjaya!",
            text: "Nilaian, Telah berjaya direkodkan.",
            icon: "success",
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Ok",
            closeOnConfirm: false
          },
          function () {
            // window.location = config.root + "calculator/" + result.calctype + "/" + result.sirino
          }
        )
      } else {
        swal("Oops...", "Nilaian, tidak berjaya direkodkan!", "error")
      }
    })
  })
})
