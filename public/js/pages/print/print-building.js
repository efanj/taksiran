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

        var doc = new jsPDF()
        var sp = 6
        doc.setFontSize(11)
        doc.setFont("helvetica", "normal", "bold")
        doc.text("MAJLIS DAERAH PERAK TENGAH", 107, 14, "center")
        doc.text("KERTAS NILAIAN", 108, 19, "center")
        doc.setFontSize(9)
        doc.setFont("helvetica", "normal", "normal")

        doc.text("No. Fail : KAD/KS/", 130, 28)
        doc.text("No. Bangunan : ", 130, 36)
        doc.text("", 130, 41)
        doc.setFontType("bold")
        doc.text("1. Pemeriksaan telah dibuat keatas :", 14, 33)
        doc.setFontType("normal")
        doc.text("a) Butir-butir ukuran / Keluasan", 17, 40)
        doc.text(": Ya / Tidak", 65, 40)
        doc.text("Surat Hakmilik", 21, 45)
        doc.text(": Ya / Tidak", 65, 45)
        doc.text("Kegunaan", 21, 50)
        doc.text(": Ya / Tidak", 65, 50)
        doc.text("b) Perbandingan : (Hendaklah dimasukkan bukti sewa atau penilaian yang telah dibuat keatas bangunan yang berhampiran)", 17, 58)

        doc.setFontSize(8)
        doc.text("NAMA TAMAN", 28, 70, "center")
        doc.text("JENIS", 62, 68, "center")
        doc.text("BANGUNAN", 62, 72, "center")
        doc.text("LOKASI", 101, 70, "center")
        doc.text("TARIKH", 130, 68, "center")
        doc.text("NILAIAN", 130, 72, "center")
        doc.text("SEWA SMP", 155, 68, "center")
        doc.text("(MFA)", 155, 72, "center")
        doc.text("SEWA SMP", 181, 68, "center")
        doc.text("(AFA)", 181, 72, "center")

        doc.setLineWidth(0.5)
        doc.line(14, 64, 194, 64)
        doc.line(14, 74, 194, 74)
        doc.line(14, 80, 194, 80)
        doc.line(14, 86, 194, 86)
        doc.line(14, 92, 194, 92)
        doc.line(14, 98, 194, 98)

        doc.line(14, 64, 14, 98)
        doc.line(194, 64, 194, 98)

        doc.line(42, 64, 42, 98)
        doc.line(84, 64, 84, 98)
        doc.line(118, 64, 118, 98)
        doc.line(142, 64, 142, 98)
        doc.line(168, 64, 168, 98)

        $.each(data.comparison, function (i, val) {
          var row = 78 + i * sp
          doc.text(val.jln_jnama, 28, row, "center")
          doc.text(val.bgn_bnama, 62, row, "center")
          doc.text(val.jln_jnama, 101, row, "center")
          doc.text(val.year, 130, row, "center")
          doc.text("RM " + val.mfa, 155, row, "center")
          doc.text("RM " + val.afa, 181, row, "center")
        })

        doc.setFontType("bold")
        doc.text("2. NILAIAN BANGUNAN :", 14, 114)
        doc.setFontSize(9)
        doc.setFontType("bold")
        doc.text("Tanah", 17, 122)
        doc.setFontType("normal")
        doc.text("STD", 20, 128)

        doc.text(data.land.breadth + " mp x", 86, 128)
        doc.text("RM " + data.land.price + " smp =", 152, 128)
        doc.text("RM " + data.land.total, 196, 128, "right")

        $.each(data.mfa, function (i, val) {
          var row = 140 + i * sp
          doc.setFontSize(9)
          doc.setFontType("bold")
          doc.text(val.title, 17, 140)
          $.each(val.items, function (k, value) {
            var rowitem = 146 + k * sp
            doc.setFontSize(9)
            doc.setFontType("normal")
            doc.text(value.title, 20, rowitem)
            doc.text(value.breadth + " " + value.breadthtype + " x", 86, rowitem)
            doc.text("RM " + value.price + " " + value.pricetype + " =", 152, rowitem)
            doc.text("RM " + value.total, 196, rowitem, "right")
          })
        })

        $.each(data.afa, function (i, val) {
          var row = 164 + i * sp
          doc.setFontSize(9)
          doc.setFontType("bold")
          doc.text(val.title, 17, 164)
          $.each(val.items, function (k, value) {
            var rowitem = 170 + k * sp
            doc.setFontSize(9)
            doc.setFontType("normal")
            doc.text(value.title, 20, rowitem)
            doc.text(value.breadth + " " + value.breadthtype + " x", 86, rowitem)
            doc.text("RM " + value.price + " " + value.pricetype + " =", 152, rowitem)
            doc.text("RM " + value.total, 196, rowitem, "right")
          })
        })
        doc.setFontType("bold")
        doc.text("Pengurangan/Tambahan", 17, 196)
        doc.setFontType("normal")
        doc.text("ANGGARAN SEWA BULANAN", 60, 202)
        doc.text("SEWA BULANAN DIGENAPKAN", 60, 208)
        doc.text("NILAI TAHUNAN", 60, 214)
        doc.text("% KADARAN", 60, 220)
        doc.text("CUKAI PERLU DIBAYAR", 60, 226)

        doc.text("RM", 162, 202)
        doc.text("RM", 162, 208)
        doc.text("RM", 162, 214)
        doc.text("RM", 162, 226)

        doc.text("Diskaun  %", 136, 202)
        // doc.text(afterdis.toFixed(2), 196, 202, "right")
        // doc.text(data.krn_hgsgp, 196, 208, "right")
        // doc.text(data.krn_nilth, 196, 214, "right")
        // doc.text(data.krn_kadar, 196, 220, "right")
        // doc.text(data.krn_ckthn, 196, 226, "right")

        doc.line(173, 203, 198, 203)
        doc.line(173, 209, 198, 209)
        doc.line(173, 215, 198, 215)
        doc.line(173, 221, 198, 221)
        doc.line(173, 227, 198, 227)

        doc.text("Disediakan oleh :", 22, 250)
        doc.text("Disemak dan disahkan oleh :", 130, 250)
        doc.text("......................................................................", 22, 266)
        doc.text("......................................................................", 130, 266)
        // doc.text(data.penginput, 22, 272)
        // doc.text(data.onama_pos, 22, 277)
        // doc.text(data.penyelia, 130, 272)
        // doc.text(data.verify_pos, 130, 277)
        doc.text("Tarikh : ", 22, 282)
        doc.text("Tarikh : ", 130, 282)
        // doc.text(data.etdate, 35, 282)
        // doc.text(data.vfdate, 142, 282)

        // doc.save(type + ".pdf");
        window.open(doc.output("bloburl").toString(), "_blank")
      }
    })
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
