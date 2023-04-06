$("#tarikh_notis").datepicker()
$("#tarikh_bermula").datepicker()
$("#tarikh_sebelum").datepicker()

$(document).on("click", "#print_notis", function () {
  var btn_print = $(this)
  var id = btn_print.data("id")
  console.log(id)
  createPDFRenoNotice(id)
})

$(document).on("click", "#print_notisthn", function () {
  var btn_print = $(this)
  var id = btn_print.data("id")
  createPDFYearly(id)
})
$(document).on("click", "#export_notisthn", function () {
  Export2Doc("notistahunan", "Notis Tahunan")
})
$(document).on("click", "#print_export", function () {
  Export2Doc("notis", "notis")
})
var today = new Date()
var date = today.getDate() + "/" + (today.getMonth() + 1) + "/" + today.getFullYear()

function createPDFRenoNotice(id) {
  $.ajax({
    async: false,
    url: "../getRenovationNotice",
    type: "POST",
    data: helpers.appendCsrfToken({ id: id }),
    context: this,
    success: function (data) {
      console.log(data)
      var doc = new jsPDF()

      doc.setFontSize(10)
      doc.setFontType("bold")
      doc.text(data.nmbil, 10, 40)
      doc.setFontType("normal")
      doc.text(data.adpg1, 10, 45)
      doc.text(data.adpg2, 10, 50)
      doc.text(data.adpg3, 10, 55)
      doc.text(data.adpg4, 10, 60)

      doc.text(140, 45, "Ruj. Kami")
      doc.text(":", 160, 45, "center")
      doc.text(data.rujfil, 164, 45)

      doc.text("Tarikh", 140, 55)
      doc.text(":", 160, 55, "center")
      doc.text(data.tknotis, 164, 55)

      doc.text("Tuan/puan,", 10, 75)

      doc.setFontType("bold")
      doc.text("NOTIS PENGUBAHSUAIAN/ BINAAN TAMBAHAN BANGUNAN TANPA KELULUSAN BERTULIS DARIPADA YANG", 10, 85)
      doc.text("DIPERTUA MAJLIS PERBANDARAN TELUK INTAN", 10, 90)
      doc.setLineWidth(0.1)
      doc.line(10, 92, 200, 92)

      doc.text("BAHAWASANYA", 10, 100)
      doc.line(10, 101, 39, 101)
      doc.setFontType("normal")
      doc.text("melalui semakan di tapak dan rekod pegangan menunjukkan bahawa kamu adalah pemilik kediaman", 40, 100)
      doc.text("tersebut sekarang.", 10, 104)

      doc.setFontType("bold")
      doc.text("DAN BAHAWASANYA", 10, 110)
      doc.line(10, 111, 47, 111)
      doc.setFontType("normal")
      doc.text("Majlis Perbandaran Teluk Intan selanjutnya berpuas hati dari siasatan yang dijalankan mendapati ", 48, 110)
      doc.text("bahawa kerja- kerja :", 10, 114)

      doc.setFontType("bold")
      doc.text("(1)   PENGUBAHSUAIAN/ BINAAN TAMBAHAN BANGUNAN DIBUAT TANPA KELULUSAN", 30, 122)
      doc.text("YANG DIPERTUA MAJLIS PERBANDARAN TELUK INTAN; atau", 37, 126)
      doc.text("(2)   MELENCONG DARI KELULUSAN ASAL YANG TELAH DILULUSKAN OLEH YANG", 30, 132)
      doc.text("DIPERTUA MAJLIS PERBANDARAN TELUK INTAN", 37, 136)

      doc.setFontType("normal")
      doc.text("dan ini adalah satu perbuatan yang berlawanan dengan seksyen 70 (11) Akta Jalan,Parit & Bangunan 1974 / Akta 133", 10, 145)
      doc.text("dan boleh apabila disabitkan dikenakan denda bagi kesalahan tidak lebih daripada RM25,000.00 (Ringgit Malaysia :", 10, 149)
      doc.text("Dua Puluh Lima Ribu sahaja) atau dipenjarakan selama tempoh tidak melebihi 3 (Tiga) tahun atau kedua-duanya.", 10, 153)

      doc.setFontType("bold")
      doc.text("SILA AMBIL PERHATIAN,", 10, 163)
      doc.line(10, 164, 52, 164)
      doc.setFontType("normal")
      doc.text("kamu dengan ini dikehendaki dalam tempoh 14 (Tujuh) hari dari tarikh notis ini", 54, 163)
      doc.text("disampaikan untuk:", 10, 167)

      doc.text("i.    Mengemukakan pelan permohonan ubahan tambahan", 30, 173)
      doc.text("ii.   Menyertai program pemutihan bangunan", 30, 177)
      doc.text("iii.  Memberitahu Majlis Perbandaran Teluk Intan secara bertulis dengan segera setelah mematuhi kehendak ", 30, 181)
      doc.text("perenggan (i) tersebut di atas;", 35, 185)

      doc.setFontType("bold")
      doc.text("SELANJUTNYA AMBIL PERHATIAN,", 10, 195)
      doc.line(10, 196, 70, 196)
      doc.setFontType("normal")
      doc.text("iaitu sekiranya kamu tidak mematuhi kehendak notis ini kamu adalah bersalah ", 72, 195)
      doc.text("dan boleh dikenakan kompaun sebanyak RM 3,000.00 ( Ringgit Malaysia : Tiga Ribu sahaja) bagi kesalahan", 10, 199)
      doc.text("gagal mematuhi notis serta boleh juga dikenakan tindakan selanjut mengikut undang- undang yang diperuntukkan.", 10, 203)

      doc.text("Sekian,sila ambil perhatian dan patuhi segera kehendak pentadbiran ini.", 10, 212)

      // doc.setFontType("bold")
      // doc.text("“ WAWASAN KEMAKMURAN BERSAMA 2030”", 10, 225)
      // doc.text("“ BERKHIDMAT UNTUK NEGARA”", 10, 230)
      // doc.text("“ KAMPAR BANDAR ILMU”", 10, 235)

      doc.setFontType("normal")
      doc.text("Saya yang menurut perintah,", 10, 245)

      doc.setFontType("bold")
      doc.text("( xxxxxxxxxxxxxxxxxxxxxxx )", 10, 268)
      doc.setFontType("normal")
      doc.text("Pegawai Tadbir ( Kejuruteraan )", 10, 272)
      doc.text("Jabatan Kejuruteraan,", 10, 276)

      window.open(doc.output("bloburl").toString(), "_blank")
    }
  })
}

function createPDFYearly(id) {
  $.ajax({
    async: false,
    url: "../getNoticeYearly",
    type: "POST",
    data: helpers.appendCsrfToken({ id: id }),
    context: this,
    success: function (data) {
      console.log(data)
      var doc = new jsPDF()

      doc.setFontSize(10)
      doc.setFontType("bold")
      doc.text(data.nmbil, 15, 40)
      doc.setFontType("normal")
      doc.text(data.adpg1, 15, 45)
      doc.text(data.adpg2, 15, 50)
      doc.text(data.adpg3, 15, 55)
      doc.text(data.adpg4, 15, 60)

      doc.text(140, 40, "Ruj. Tuan")
      doc.text(":", 160, 40, "center")
      doc.text(data.rujpegthn, 164, 40)
      doc.text(140, 45, "Ruj. Kami")
      doc.text(":", 160, 45, "center")
      doc.text(data.rujfilthn, 164, 45)

      doc.text("Tarikh", 140, 55)
      doc.text(":", 160, 55, "center")
      doc.text(data.tknotisthn, 164, 55)

      doc.text("Tuan,", 15, 75)

      doc.setFontType("bold")
      var splitTitle = doc.splitTextToSize(data.perkarathn, 180)
      doc.text(splitTitle, 15, 85)
      doc.setLineWidth(0.5)
      doc.line(15, 101, 195, 101)

      doc.setFontType("normal")
      doc.text("Dengan segala hormatnya perkara di atas dirujuk.", 15, 110)

      doc.text("2.   Dimaklumkan bahawa pihak tuan dikenakan permit tahunan RM " + data.nildedthn + " bermula " + data.tkmulathn + " bagi kelulusan", 15, 122)
      // doc.text(
      //   "Pelan Program Pemutihan Pengubahsuaian Bangunan /Binaan Tambahan Bagi Unit Kediaman. Bayaran permit tersebut",
      //   15,
      //   127
      // )
      var splitTitle = doc.splitTextToSize("Pelan Program Pemutihan Pengubahsuaian Bangunan /Binaan Tambahan Bagi Unit Kediaman. Bayaran permit tersebut perlu dijelaskan sebelum atau pada " + data.tksblomthn + ". Resit bayaran hendaklah dikembalikan semula ke Jabatan Kejuruteraan selepas bayaran dibuat.", 180)
      doc.text(splitTitle, 15, 127)

      doc.text("Sekian harap maklum, Terima kasih", 15, 150)

      // doc.setFontType("bold")
      // doc.text("“ WAWASAN KEMAKMURAN BERSAMA 2030”", 15, 165)
      // doc.text("“ BERKHIDMAT UNTUK NEGARA”", 15, 170)
      // doc.text("“ KAMPAR BANDAR ILMU”", 15, 175)

      doc.setFontType("normal")
      doc.text("Saya yang menurut perintah,", 15, 185)

      doc.setFontType("bold")
      doc.text("( xxxxxxxxxxxxxxxxx )", 15, 210)
      doc.setFontType("normal")
      doc.text("Pegawai Tadbir ( Kejuruteraan )", 15, 215)
      doc.text("Jabatan Kejuruteraan,", 15, 219)

      window.open(doc.output("bloburl").toString(), "_blank")
    }
  })
}

function Export2Doc(element, filename = "") {
  //  _html_ will be replace with custom html
  var meta = "Mime-Version: 1.0\nContent-Base: " + location.href + '\nContent-Type: Multipart/related; boundary="NEXT.ITEM-BOUNDARY";type="text/html"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset="utf-8"\nContent-Location: ' + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>"
  //  _styles_ will be replaced with custome css
  var head = '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<style>\n_styles_\n</style>\n</head>\n'

  var html = document.getElementById(element).innerHTML

  var blob = new Blob(["\ufeff", html], {
    type: "application/msword"
  })

  var css = "<style>" + "img {width:300px;}table {border-collapse: collapse; border-spacing: 0;}td{padding: 6px;}" + "</style>"
  //  Image Area %%%%
  var options = { maxWidth: 624 }
  var images = Array()
  var img = $("#" + element).find("img")
  for (var i = 0; i < img.length; i++) {
    // Calculate dimensions of output image
    var w = Math.min(img[i].width, options.maxWidth)
    var h = img[i].height * (w / img[i].width)
    // Create canvas for converting image to data URL
    var canvas = document.createElement("CANVAS")
    canvas.width = w
    canvas.height = h
    // Draw image to canvas
    var context = canvas.getContext("2d")
    context.drawImage(img[i], 0, 0, w, h)
    // Get data URL encoding of image
    var uri = canvas.toDataURL("image/png")
    $(img[i]).attr("src", img[i].src)
    img[i].width = w
    img[i].height = h
    // Save encoded image to array
    images[i] = {
      type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
      encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
      location: $(img[i]).attr("src"),
      data: uri.substring(uri.indexOf(",") + 1)
    }
  }

  // Prepare bottom of mhtml file with image data
  var imgMetaData = "\n"
  for (var i = 0; i < images.length; i++) {
    imgMetaData += "--NEXT.ITEM-BOUNDARY\n"
    imgMetaData += "Content-Location: " + images[i].location + "\n"
    imgMetaData += "Content-Type: " + images[i].type + "\n"
    imgMetaData += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n"
    imgMetaData += images[i].data + "\n\n"
  }
  imgMetaData += "--NEXT.ITEM-BOUNDARY--"
  // end Image Area %%

  var output = meta.replace("_html_", head.replace("_styles_", css) + html) + imgMetaData

  var url = "data:application/vnd.ms-word;charset=utf-8," + encodeURIComponent(output)

  filename = filename ? filename + ".doc" : "document.doc"

  var downloadLink = document.createElement("a")

  document.body.appendChild(downloadLink)

  if (navigator.msSaveOrOpenBlob) {
    navigator.msSaveOrOpenBlob(blob, filename)
  } else {
    downloadLink.href = url
    downloadLink.download = filename
    downloadLink.click()
  }

  document.body.removeChild(downloadLink)
}
