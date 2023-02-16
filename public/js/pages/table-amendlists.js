$(document).ready(function () {
  fill_datatable()

  function fill_datatable(area = "", street = "") {
    var table = $("#amendlists").DataTable({
      pageLength: 5,
      lengthMenu: [
        [5, 15, 25, 50],
        [5, 15, 25, 50]
      ],
      processing: true,
      serverSide: true,
      select: "single",
      searching: false,
      order: [],
      ajax: {
        url: "getAmendTable",
        type: "POST",
        data: {
          area: area,
          street: street
        }
      },
      columnDefs: [
        {
          targets: 0,
          orderable: false,
          data: "form"
        },
        {
          targets: 1,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.no_akaun + "<br/>"
              data += row.no_siri
            }
            return data
          }
        },
        {
          targets: 2,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.tkhpl + "<br/>"
              data += row.tkhtk
            }
            return data
          }
        },
        {
          targets: 3,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.tnama + "<br/>"
              data += row.bnama + "<br/>"
              data += row.hnama + "<br/>"
              data += row.snama
            }
            return data
          }
        },
        {
          targets: 4,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.nilth_asal + "<br/>"
              data += row.kadar_asal + "<br/>"
              data += row.cukai_asal
            }
            return data
          }
        },
        {
          targets: 5,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.nilth_baru + "<br/>"
              data += row.kadar_baru + "<br/>"
              data += row.cukai_baru
            }
            return data
          }
        },
        {
          targets: 6,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.status
            }
            return data
          }
        },
        {
          targets: 7,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.sebab + "<br/>"
              data += row.mesej
            }
            return data
          }
        },
        {
          targets: 8,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              if (row.vstatus === 0) {
                data = "Belum Disahkan"
              } else if (row.vstatus === 1) {
                data = "Telah Disahkan"
              }
            }
            return data
          }
        },
        {
          targets: 9,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.entry + "<br/>"
              data += row.verifier
            }
            return data
          }
        },
        {
          targets: 10,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            console.log(row)
            if (type === "display") {
              data = '<div class="btn-group btn-group-sm" role="group">'
              if (row.form === "A") {
                data += '<a href="viewamendAdetail/' + row.noSiri + '" class="btn btn-default btn-sm" type="button" title="Maklumat Lengkap"><i class="fa fa-eye color-dark"></i></a>'
              } else if (row.form === "B") {
                data += '<a href="viewamendBdetail/' + row.noSiri + '" class="btn btn-default btn-sm" type="button" title="Maklumat Lengkap"><i class="fa fa-eye color-dark"></i></a>'
              } else if (row.form === "C") {
                data += '<a href="viewamendCdetail/' + row.noSiri + '" class="btn btn-default btn-sm" type="button" title="Maklumat Lengkap"><i class="fa fa-eye color-dark"></i></a>'
              }
              if (row.calctype === "1") {
                data += '<a href="viewcalcland/' + row.noSiri + '" class="btn btn-default btn-sm" title="Borang Nilaian"><i class="fa fa-calculator color-dark"></i></a>'
              } else if (row.calctype === "2") {
                data += '<a href="viewcalcbuilding/' + row.noSiri + '" class="btn btn-default btn-sm" title="Borang Nilaian"><i class="fa fa-calculator color-dark"></i></a>'
              } else {
                data += '<a href="#" class="btn btn-default btn-sm" title="Borang Nilaian" disabled><i class="fa fa-calculator color-dark"></i></a>'
              }
              data += '<a href="viewimages/' + row.noSiri + '" class="btn btn-default btn-sm" title="Ruangan Gambar"><i class="fa fa-file-image-o color-dark"></i></a>'
              data += '<a href="viewdocuments/' + row.noSiri + '" class="btn btn-default btn-sm" title="Ruangan Dokumen"><i class="fa fa-file-pdf-o color-dark"></i></a>'
              data += "</div>"
            }
            return data
          }
        }
      ],
      order: [[0, "asc"]],
      language: {
        search: "Saring:",
        lengthMenu: "Paparkan _MENU_ rekod",
        zeroRecords: "Tiada maklumat yang dijumpai",
        info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
        infoEmpty: "Tiada rekod",
        infoFiltered: "(Ditapis daripada _MAX_ rekod)",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Seterusnya",
          previous: "Sebelumnya"
        }
      }
    })
  }

  $("#amendlists").css("font-size", 13)

  $("#filter").click(function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      $("#amendlists").DataTable().destroy()
      fill_datatable(area, street)
    } else {
      alert("Select Both filter option")
      $("#amendlists").DataTable().destroy()
      fill_datatable()
    }
  })

  $("#area").change(function () {
    $.ajax({
      type: "POST",
      url: "../Elements/street",
      data: { area: $(this).val() },
      success: function (data) {
        var len = data.length

        $("#street").empty()
        var rows = "<option selected value=''>Sila Pilih Jalan</option>"
        for (var i = 0; i < len; i++) {
          var id = data[i]["jln_jlkod"]
          var name = data[i]["jln_jnama"]
          rows += "<option value='" + id + "'>" + name + "</option>"
        }
        $("#street").append(rows)
      }
    })
  })
})
