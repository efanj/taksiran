$(document).ready(function () {
  $(document).on("click", "#print_calc", function () {
    var btn_print = $(this)
    var form = btn_print.data("form")
    var siri = btn_print.data("siri")
    generateCalc(form, siri)
  })

  function generateCalc(form, siri) {
    $.ajax({
      async: false,
      url: config.root + "Informations/getCalculationInfo",
      type: "POST",
      data: helpers.appendCsrfToken({ siri: siri }),
      context: this,
      success: function (data) {
        console.log(data)
        var sp = 6
        var mfalength = length(data.mfa)
        var afalength = length(data.afa)
        var mfa_section = mfalength[0]
        var mfa_items = mfalength[1]
        var mfa_count = mfa_items * sp
        var afa_section = afalength[0]
        var afa_items = afalength[1]
        console.log(mfalength, afalength, mfa_section, mfa_items, afa_section, afa_items)
        var afterdis = parseFloat(data.rental) - parseFloat(data.rental) * (data.discount / 100)

        var doc = new jsPDF()
        doc.setFont("helvetica").setFontSize(11).setFontType("bold")
        doc.text("MAJLIS DAERAH PERAK TENGAH", 107, 14, "center")
        doc.text("KERTAS NILAIAN", 108, 19, "center")

        doc.setFont("helvetica").setFontSize(9).setFontType("bold")
        doc.text("No. Akaun : ", 14, 28)
        doc.text("No. Bangunan : ", 118, 28)
        doc.text("Nama Pemilik :", 14, 34)
        doc.text("ID Pemilik : ", 118, 34)
        doc.text("Plot :", 14, 40)
        doc.text("No. lot :", 118, 40)
        doc.text("Alamat Harta :", 14, 46)
        doc.text("Alamat surat : ", 118, 46)

        doc.setFont("helvetica").setFontSize(9).setFontType("normal")
        doc.text(data.account_no, 38, 28)
        doc.text(data.bnama, 143, 28)
        doc.text(data.pmk_nmbil, 38, 34)
        doc.text(data.pmk_plgid, 143, 34)
        doc.text(data.peg_nompt, 38, 40)
        doc.text(data.peg_nolot, 143, 40)

        var splitProperty = doc.setFontSize(9).splitTextToSize(data.address, 65)
        doc.text(splitProperty, 38, 46)
        var splitPostal = doc.setFontSize(9).splitTextToSize(data.postal, 55)
        doc.text(splitPostal, 143, 46)

        doc.setDrawColor(0)
        doc.setFillColor(239, 239, 239)
        doc.rect(14, 58, 182, 10, "FD")
        doc.line(14, 74, 196, 74)
        doc.line(14, 80, 196, 80)
        doc.line(14, 86, 196, 86)
        doc.line(14, 92, 196, 92)

        doc.line(14, 58, 14, 92)
        doc.line(196, 58, 196, 92)

        doc.line(42, 58, 42, 92)
        doc.line(84, 58, 84, 92)
        doc.line(118, 58, 118, 92)
        doc.line(144, 58, 144, 92)
        doc.line(170, 58, 170, 92)
        doc.setFont("helvetica").setFontSize(8).setFontType("normal")
        doc.text("NAMA TAMAN", 28, 64, "center")
        doc.text("JENIS", 63, 62, "center")
        doc.text("BANGUNAN", 63, 66, "center")
        doc.text("LOKASI", 101, 64, "center")
        doc.text("TARIKH", 131, 62, "center")
        doc.text("NILAIAN", 131, 66, "center")
        doc.text("SEWA SMP", 157, 62, "center")
        doc.text("(MFA)", 157, 66, "center")
        doc.text("SEWA SMP", 183, 62, "center")
        doc.text("(AFA)", 183, 66, "center")

        doc.setFont("helvetica").setFontSize(8).setFontType("normal")
        $.each(data.comparison, function (i, val) {
          var row = 72 + i * sp
          doc.text(val.jln_jnama, 28, row, "center")
          doc.text(val.bgn_bnama, 63, row, "center")
          doc.text(val.jln_jnama, 101, row, "center")
          doc.text(val.year, 131, row, "center")
          doc.text("RM " + val.mfa, 157, row, "center")
          doc.text("RM " + val.afa, 183, row, "center")
        })
        doc.setFontSize(10).setFontType("bold")
        doc.text("NILAIAN BANGUNAN :", 14, 100)
        doc.setFontSize(9).setFontType("bold")
        doc.text("a) Tanah", 17, 108)
        doc.setFontSize(9).setFontType("normal")
        doc.text("STD", 20, 114)

        doc.text(data.land.breadth + " mp x", 86, 114)
        doc.text("RM " + data.land.price + " smp =", 152, 114)
        doc.text("RM " + data.land.total, 196, 114, "right")

        doc.setFontSize(9).setFontType("bold")
        doc.text("b) Pengurangan/Tambahan", 17, 130)

        doc.setFontSize(9).setFontType("normal")
        doc.text("ANGGARAN SEWA BULANAN", 60, 136)
        doc.text("DISKAUN", 60, 142)
        doc.text("SEWA BULANAN DIGENAPKAN", 60, 148)
        doc.text("NILAI TAHUNAN", 60, 154)
        doc.text("KADARAN", 60, 160)
        doc.text("CUKAI PERLU DIBAYAR", 60, 166)

        doc.text("RM", 162, 136)
        doc.text("RM", 162, 142)
        doc.text("RM", 162, 148)
        doc.text("RM", 162, 154)

        doc.text(data.rental, 196, 136, "right")
        doc.text("Diskaun  " + data.discount + "%", 136, 142)
        doc.text(afterdis.toFixed(2), 196, 142, "right")
        doc.text(data.even, 196, 148, "right")
        doc.text(data.yearly_price, 196, 154, "right")
        doc.text(data.rate + "%", 196, 160, "right")

        doc.setFontSize(9).setFontType("bold")
        doc.text("RM", 162, 166)
        doc.text(data.assessment_tax, 196, 166, "right")

        doc.line(173, 137, 198, 137)
        doc.line(173, 143, 198, 143)
        doc.line(173, 149, 198, 149)
        doc.line(173, 155, 198, 155)
        doc.line(173, 161, 198, 161)
        doc.line(173, 167, 198, 167)

        doc.setFontSize(9).setFontType("normal")
        doc.text("Disediakan oleh :", 17, 184)
        doc.text("Disemak dan disahkan oleh :", 130, 184)
        doc.text("......................................................................", 17, 200)
        doc.text("......................................................................", 130, 200)
        doc.text(data.clerk, 17, 206)
        doc.text(data.clerk_pos, 17, 212)
        doc.text(data.verifier, 130, 206)
        doc.text(data.verifier_pos, 130, 212)
        doc.text("Tarikh : ", 17, 220)
        doc.text("Tarikh : ", 130, 220)
        doc.text(data.etdate, 30, 220)
        doc.text(data.vfdate, 143, 220)

        // doc.setFontSize(9).setFontType("bold")
        // doc.text("b) Bangunan", 17, 124)

        // $.each(data.mfa, function (i, val) {
        //   var countTitle = i + 1
        //   var row = 130 + i * sp
        //   doc.setFontSize(9).setFontType("bold")
        //   doc.text(countTitle + ". " + val.title, 20, 130)
        //   $.each(val.items, function (k, value) {
        //     var rowitem = 136 + k * sp
        //     doc.setFontSize(9).setFontType("normal")
        //     doc.text(value.title, 24, rowitem)
        //     doc.text(value.breadth + " " + value.breadthtype + " x", 86, rowitem)
        //     doc.text("RM " + value.price + " " + value.pricetype + " =", 152, rowitem)
        //     doc.text("RM " + value.total, 196, rowitem, "right")
        //   })
        // })
        // doc.setFontType("bold")
        // doc.text("c) Pengurangan/Tambahan", 17, 196)

        // doc.setFontSize(9).setFontType("normal")
        // doc.text("ANGGARAN SEWA BULANAN", 60, 202)
        // doc.text("DISKAUN", 60, 208)
        // doc.text("SEWA BULANAN DIGENAPKAN", 60, 214)
        // doc.text("NILAI TAHUNAN", 60, 220)
        // doc.text("KADARAN", 60, 226)
        // doc.text("CUKAI PERLU DIBAYAR", 60, 232)

        // doc.text("RM", 162, 202)
        // doc.text("RM", 162, 208)
        // doc.text("RM", 162, 214)
        // doc.text("RM", 162, 220)

        // doc.text(data.rental, 196, 202, "right")
        // doc.text("Diskaun  " + data.discount + "%", 136, 208)
        // doc.text(afterdis.toFixed(2), 196, 208, "right")
        // doc.text(data.even, 196, 214, "right")
        // doc.text(data.yearly_price, 196, 220, "right")
        // doc.text(data.rate + "%", 196, 226, "right")

        // doc.setFontSize(9).setFontType("bold")
        // doc.text("RM", 162, 232)
        // doc.text(data.assessment_tax, 196, 232, "right")

        // doc.line(173, 203, 198, 203)
        // doc.line(173, 209, 198, 209)
        // doc.line(173, 215, 198, 215)
        // doc.line(173, 221, 198, 221)
        // doc.line(173, 227, 198, 227)
        // doc.line(173, 233, 198, 233)

        // doc.setFontSize(9).setFontType("normal")
        // doc.text("Disediakan oleh :", 17, 250)
        // doc.text("Disemak dan disahkan oleh :", 130, 250)
        // doc.text("......................................................................", 17, 266)
        // doc.text("......................................................................", 130, 266)
        // doc.text(data.clerk, 17, 272)
        // doc.text(data.clerk_pos, 17, 277)
        // doc.text(data.verifier, 130, 272)
        // doc.text(data.verifier_pos, 130, 277)
        // doc.text("Tarikh : ", 17, 282)
        // doc.text("Tarikh : ", 130, 282)
        // doc.text(data.etdate, 30, 282)
        // doc.text(data.vfdate, 143, 282)

        // doc.save(type + ".pdf");
        window.open(doc.output("bloburl").toString(), "_blank")
      }
    })
  }

  function length(a) {
    var mainLen = 0
    var subLen = 0
    mainLen = a.length
    for (var i = 0; i < mainLen; i++) {
      var len = a[i].items.length
      subLen = len > subLen ? len : subLen
    }
    return [mainLen, subLen]
  }

  function firstUpperCase(str) {
    var text
    if (str != null) {
      var string = str.toLowerCase()
      var arr = string.split(" ")
      for (var i = 0; i < arr.length; i++) {
        arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1)
      }
      text = arr.join(" ")
    } else {
      text = ""
    }
    return text
  }

  function getFormattedDate(date) {
    let year = date.getFullYear()
    let month = (1 + date.getMonth()).toString().padStart(2, "0")
    let day = date.getDate().toString().padStart(2, "0")

    return day + "/" + month + "/" + year
  }

  function formatAMPM() {
    var currentdate = new Date()
    var date = currentdate.getDate()
    var month = currentdate.getMonth() + 1
    var year = currentdate.getFullYear()
    var hours = currentdate.getHours()
    var minutes = currentdate.getMinutes()
    var ampm = hours >= 12 ? "PM" : "AM"
    hours = hours % 12
    hours = hours ? hours : 12 // the hour '0' should be '12'
    minutes = minutes < 10 ? "0" + minutes : minutes
    var strTime = date + "/" + month + "/" + year + " " + hours + ":" + minutes + " " + ampm
    return strTime
  }

  function numFormatter(value) {
    var parts = value.toFixed(2).split(".")
    var num = parts[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (parts[1] ? "." + parts[1] : "")

    return num
  }
})
