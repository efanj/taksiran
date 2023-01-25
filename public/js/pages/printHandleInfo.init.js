$(document).ready(function () {
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

  $("#handleinfo tbody").on("click", "#btn_print", function () {
    var btn_print = $(this)
    var noakaun = btn_print.data("akaun")
    console.log(noakaun)
    createPDFPegangan(noakaun)
  })

  function createPDFPegangan(noAkaun) {
    $.ajax({
      async: false,
      url: "getDetailsHandle",
      type: "POST",
      data: helpers.appendCsrfToken({ noAkaun: noAkaun }),
      context: this,
      success: function (data) {
        var imgData =
          "data:image/png;base64,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"
        var doc = new jsPDF()

        doc.setFontSize(9)
        doc.addImage(imgData, "PNG", 66, 8, 80, 18)
        doc.setDrawColor(0)
        doc.setFillColor(192, 192, 192)
        doc.rect(8, 36, 194, 8, "F")
        doc.setFontType("bold")
        doc.text("MAKLUMAT PEMILIK", 12, 41)

        doc.setFontSize(9)
        doc.setFontType("normal")
        doc.text("NO. AKAUN", 12, 50)
        doc.text(":", 52, 50, "center")
        doc.text(data.peg_akaun, 54, 50)
        doc.text("AKAUN LAMA", 122, 50)
        doc.text(":", 168, 50, "center")
        doc.text(data.peg_oldac, 170, 50)

        doc.text("NO. K/P / PENDAFTARAN", 12, 56)
        doc.text(":", 52, 56, "center")
        doc.text(data.pmk_plgid, 54, 56)

        doc.text("NAMA PEMILIK", 12, 62)
        doc.text(":", 52, 62, "center")
        doc.text(data.pvd_pnama, 54, 62)
        doc.text("BANGSA", 122, 62)
        doc.text(":", 168, 62, "center")
        doc.text(data.pvd_wkbgsa, 170, 62)

        doc.text("ALAMAT PEMILIK", 12, 68)
        doc.text(":", 52, 68, "center")
        doc.text(data.pvd_almt1, 54, 68)
        doc.text(data.pvd_almt2, 54, 74)
        doc.text(data.pvd_almt3, 54, 80)

        doc.text("STATUS", 122, 68)
        doc.text(":", 168, 68, "center")
        doc.text(data.peg_statf, 170, 68)

        doc.text("BIL. PEMILIK", 12, 90)
        doc.text(":", 52, 90, "center")
        doc.text(data.pmk_blpmk, 54, 90)
        doc.text("NO. HAKMILIK", 122, 90)
        doc.text(":", 168, 90, "center")
        doc.text(data.pmk_hkmlk, 170, 90)

        doc.text("KOD ANSURAN", 12, 96)
        doc.text(":", 52, 96, "center")
        doc.text(data.pmk_kdans, 54, 96)
        doc.text("TAKSIRAN (%)", 122, 96)
        doc.text(":", 168, 96, "center")
        doc.text(data.pmk_prtus, 170, 96)

        doc.text("RUJUKAN FAIL", 12, 102)
        doc.text(":", 52, 102, "center")
        doc.text(data.peg_rjfil, 54, 102)
        doc.text("RUJUKAN MAJLIS", 122, 102)
        doc.text(":", 168, 102, "center")
        doc.text(data.pmk_rujmj, 170, 102)

        doc.text("NO. JILID", 12, 108)
        doc.text(":", 52, 108, "center")
        doc.text(data.pmk_jilid, 54, 108)
        doc.text("DIKECUALIKAN BIL", 122, 108)
        doc.text(":", 168, 108, "center")
        doc.text("-", 170, 108)

        doc.setDrawColor
        doc.setFillColor(192, 192, 192)
        doc.rect(8, 114, 194, 8, "F")
        doc.setFontSize(9)
        doc.setFontType("bold")
        doc.text("MAKLUMAT PEGANGAN", 12, 119)

        doc.setFontSize(9)
        doc.setFontType("normal")
        doc.text("ALAMAT HARTA", 12, 128)
        doc.text(":", 52, 128, "center")
        doc.text(data.adpg1, 54, 128)
        doc.text(data.adpg2, 54, 134)
        doc.text(data.adpg3, 54, 140)
        doc.text(data.adpg4, 54, 146)

        doc.text("KEGUNAAN HARTANAH", 12, 154)
        doc.text(":", 52, 154, "center")
        doc.text(data.hrt_hnama, 54, 154)
        doc.text("JENIS PEMILIK", 122, 154)
        doc.text(":", 168, 154, "center")
        doc.text(data.jpk_jnama, 170, 154)

        doc.text("KEGUNAAN TANAH", 12, 160)
        doc.text(":", 52, 160, "center")
        doc.text(data.tnh_tnama, 54, 160)
        doc.text("STRUKTUR BANGUNAN", 122, 160)
        doc.text(":", 168, 160, "center")
        doc.text(data.stb_snama, 170, 160)

        doc.text("JENIS BANGUNAN", 12, 166)
        doc.text(":", 52, 166, "center")
        doc.text(data.bgn_bnama, 54, 166)

        doc.text("STATUS PEGANGAN", 12, 172)
        doc.text(":", 52, 172, "center")
        doc.text("-", 54, 172)
        doc.text("NILAI TAHUNAN (RM)", 122, 172)
        doc.text(":", 168, 172, "center")
        doc.text(data.peg_nilth, 170, 172)

        doc.text("NO. P.T", 12, 178)
        doc.text(":", 52, 178, "center")
        doc.text(data.peg_nompt, 54, 178)
        doc.text("KADAR PERATUS (%)", 122, 178)
        doc.text(":", 168, 178, "center")
        doc.text(data.kaw_kadar, 170, 178)

        doc.text("NO. PELAN", 12, 184)
        doc.text(":", 52, 184, "center")
        doc.text(data.peg_pelan, 54, 184)
        doc.text("TAKSIRAN TAHUNAN (RM)", 122, 184)
        doc.text(":", 168, 184, "center")
        doc.text(data.peg_tksir, 170, 184)

        doc.text("TARIKH O.C.", 12, 190)
        doc.text(":", 52, 190, "center")
        doc.text(data.peg_tkhoc, 54, 190)
        doc.text("LUAS BANGUNAN (m²)", 122, 190)
        doc.text(":", 168, 190, "center")
        doc.text(data.peg_lsbgn, 170, 190)

        doc.text("TARIKH KUATKUASA", 12, 196)
        doc.text(":", 52, 196, "center")
        doc.text(data.peg_tkhtk, 54, 196)
        doc.text("LUAS TANAH (m²)", 122, 196)
        doc.text(":", 168, 196, "center")
        doc.text(data.peg_lstnh, 170, 196)

        doc.text("RUJUKAN MMK", 12, 202)
        doc.text(":", 52, 202, "center")
        doc.text(data.peg_rjmmk, 54, 202)
        doc.text("LUAS ANSOLARI (m²)", 122, 202)
        doc.text(":", 168, 202, "center")
        doc.text(data.peg_lsans, 170, 202)

        doc.text("NO. LOT", 12, 208)
        doc.text(":", 52, 208, "center")
        doc.text(data.peg_nolot, 54, 208)
        // doc.text("LUAS BANGUNAN TAMB. (m²)", 122, 208)
        // doc.text(":", 168, 208, "center")
        // doc.text(data.peg_lstnh, 170, 208)

        doc.text("KOD JALAN", 12, 214)
        doc.text(":", 52, 214, "center")
        doc.text(data.jln_jlkod + "-" + data.jln_jnama, 54, 214)
        // doc.text("LUAS ANSOLARI TAMB. (m²)", 122, 214)
        // doc.text(":", 168, 214, "center")
        // doc.text(data.peg_lstnh, 170, 214)

        doc.text("BIL. LOT", 12, 220)
        doc.text(":", 52, 220, "center")
        doc.text(data.peg_bllot, 54, 220)
        doc.text("CAJ PERKHIDMATAN", 122, 220)
        doc.text(":", 168, 220, "center")
        doc.text("-", 170, 220)

        // doc.save("pegangan_" + noAkaun + ".pdf");
        window.open(doc.output("bloburl").toString(), "_blank")
      },
    })
  }
})
