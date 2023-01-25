$(document).ready(function () {
  var maxField = 4
  var lineNo = 1
  var markup = "<tr><td><input type='text' class='form-control input-sm'></td>"
  markup += "<td><input type='text' class='form-control input-sm'></td>"
  markup += "<td><select class='form-control input-sm' name='mjbBgkod'>"
  markup += "<option selected>Sila Pilih</option>"
  markup += "</select></td>"
  markup += "<td style='text-align:center'>X</td>"
  markup += "<td><input type='text' class='form-control input-sm'></td>"
  markup += "<td><select class='form-control input-sm' name='mjbBgkod'>"
  markup += "<option selected>Sila Pilih</option>"
  markup += "</select></td>"
  markup += "<td><input type='text' class='form-control input-sm'></td>"
  markup += "<td><button class='btn btn-danger btn-xs' id='DeleteRow' type='button'><i class='fa fa-trash'></i></button></td></tr>"
  $("#add-one").click(function () {
    tableBody = $("table.one tbody")
    tableBody.append(markup)
    lineNo++
  })
  $("#add-two").click(function () {
    tableBody = $("table.two tbody")
    tableBody.append(markup)
    lineNo++
  })
  $("#DeleteRow").click(function () {
    $(this).parents("#row").remove()
  })

  var $validator = $("#calc-factory form").validate({
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
  $("#calc-factory").bootstrapWizard({
    tabClass: "bwizard-steps",
    nextSelector: "ul.pager li.next",
    previousSelector: "ul.pager li.previous",
    firstSelector: null,
    lastSelector: null,
    onNext: function (tab, navigation, index, newindex) {
      // var validated = $("#calc-factory form").valid()
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
        $("#calc-factory").find(".pager .next").hide()
        $("#calc-factory").find(".pager .finish").show()
        $("#calc-factory").find(".pager .finish").removeClass("disabled")
      } else {
        $("#calc-factory").find(".pager .next").show()
        $("#calc-factory").find(".pager .finish").hide()
      }
    }
  })

  //wizard is finish
  $("#calc-factory .finish").click(function (e) {
    e.preventDefault()
    var data = $("#calcFactory").serialize()
    $.ajax({
      url: config.root + "calculator/factory",
      type: "post",
      dataType: "json",
      data: data
    }).done(function (result) {
      console.log(result.success)
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
            window.location = config.root + "calculator/" + result.calctype + "/" + result.sirino
          }
        )
        // $("#calc_button_popup").modal("show")
      } else {
        swal("Oops...", "Nilaian, tidak berjaya direkodkan!", "error")
      }
    })
  })
})
