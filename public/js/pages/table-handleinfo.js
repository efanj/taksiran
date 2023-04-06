$(document).ready(function () {
  fill_datatable()

  function fill_datatable(area = "", street = "") {
    function format_handleinfo(d) {
      // `d` is the original data object for the row
      return (
        '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;width:100%;">' +
        "<tr>" +
        "<td width='10%' style='background-color: #f4f5f5;'><b>Nama Bil:</b></td>" +
        "<td width='15%'>" +
        d.pmk_nmbil +
        "</td>" +
        "<td width='10%' style='background-color: #f4f5f5;'><b>ID/No. Syarikat:</b></td>" +
        "<td width='15%'>" +
        d.pmk_plgid +
        "</td>" +
        "<td width='10%' style='background-color: #f4f5f5;'><b>No. Hakmilik:</b></td>" +
        "<td width='15%'>" +
        d.pmk_hkmlk +
        "</td>" +
        "<td width='10%' style='background-color: #f4f5f5;'><b>No. PT:</b></td>" +
        "<td width='15%'>" +
        d.peg_nompt +
        "</td>" +
        "</tr>" +
        "<tr>" +
        "<td style='background-color: #f4f5f5;'><b>Jalan:</b></td>" +
        "<td>" +
        d.jln_jnama +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Kawasan:</b></td>" +
        "<td>" +
        d.jln_kname +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>No. Pelan:</b></td>" +
        "<td>" +
        d.peg_pelan +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Rujukan MMK:</b></td>" +
        "<td>" +
        d.peg_rjmmk +
        "</td>" +
        "</tr>" +
        "<tr>" +
        "<td style='background-color: #f4f5f5;'><b>Kegunaan Tanah:</b></td>" +
        "<td>" +
        d.tnh_tnama +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Jenis Bangunan:</b></td>" +
        "<td>" +
        d.bgn_bnama +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Kegunaan Hartanah:</b></td>" +
        "<td>" +
        d.hrt_hnama +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Struktur Bangunan:</b></td>" +
        "<td>" +
        d.stb_snama +
        "</td>" +
        "</tr>" +
        "<tr>" +
        "<td style='background-color: #f4f5f5;'><b>Luas Tanah:</b></td>" +
        "<td>" +
        d.peg_lstnh +
        " mp</td>" +
        "<td style='background-color: #f4f5f5;'><b>Luas Bangunan:</b></td>" +
        "<td>" +
        d.peg_lsbgn +
        " mp</td>" +
        "<td style='background-color: #f4f5f5;'><b>Luas Ansolari:</b></td>" +
        "<td>" +
        d.peg_lsans +
        " mp</td>" +
        "<td style='background-color: #f4f5f5;'><b>Sumbangan Membantu Kadar:</b></td>" +
        "<td>" +
        d.jpk_stcbk +
        "</td>" +
        "</tr>" +
        "<tr>" +
        "<td style='background-color: #f4f5f5;'><b>Nilai Tahunan:</b></td>" +
        "<td>RM " +
        d.peg_nilth +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Kadar:</b></td>" +
        "<td>" +
        d.kaw_kadar +
        "%</td>" +
        "<td style='background-color: #f4f5f5;'><b>Cukai Tahunan:</b></td>" +
        "<td>RM " +
        d.peg_tksir +
        "</td>" +
        "<td style='background-color: #f4f5f5;'><b>Status Pegangan</b></td>" +
        "<td>" +
        d.peg_wstatf +
        "</td>" +
        "</tr>" +
        "</table>"
      )
    }

    var handleinfo = $("#handleinfo").DataTable({
      pageLength: 5,
      lengthMenu: [
        [5, 15, 25, 50],
        [5, 15, 25, 50]
      ],
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: "handleinfotable",
        type: "POST",
        data: {
          area: area,
          street: street
        }
      },
      searching: true,
      select: "single",
      columnDefs: [
        {
          width: "3%",
          targets: 0,
          className: "details-control",
          orderable: false,
          data: null,
          defaultContent: ""
        },
        {
          width: "5%",
          targets: 1,
          data: "peg_akaun"
        },
        {
          width: "5%",
          targets: 2,
          data: "peg_nolot"
        },
        {
          width: "15%",
          targets: 3,
          data: "pvd_pnama"
        },
        {
          width: "18%",
          targets: 4,
          searchable: false,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.adpg1 + "<br/>"
              if (row.adpg2 != null) {
                data += row.adpg2 + "<br/>"
              }
              if (row.adpg3 != null) {
                data += row.adpg3 + "<br/>"
              }
              if (row.adpg4 != null) {
                data += row.adpg4 + "<br/>"
              }
            }

            return data
          }
        },
        {
          width: "18%",
          targets: 5,
          searchable: false,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.pvd_almt1 + "<br/>"
              if (row.pvd_almt2 != null) {
                data += row.pvd_almt2 + "<br/>"
              }
              if (row.pvd_almt3 != null) {
                data += row.pvd_almt3 + "<br/>"
              }
              if (row.pvd_almt4 != null) {
                data += row.pvd_almt4 + "<br/>"
              }
              if (row.pvd_almt5 != null) {
                data += row.pvd_almt5 + "<br/>"
              }
              if (row.pvd_notel != null) {
                data += "Telefon : " + row.pvd_notel + "<br/>"
              }
              if (row.pvd_nofax != null) {
                data += "Fax : " + row.pvd_nofax + "<br/>"
              }
              if (row.pvd_email != null) {
                data += "Emel : " + row.pvd_email + "<br/>"
              }
            }

            return data
          }
        },
        {
          width: "12%",
          targets: 6,
          data: "jpk_jnama"
        },
        {
          width: "12%",
          targets: 7,
          orderable: false,
          data: "peg_statf",
          render: function (data, type, row, meta) {
            if (row.peg_statf === "Y") {
              data = "Belum Proses Bil"
            }
            if (row.peg_statf === "P") {
              data = "Sudah Proses Bil"
            }
            if (row.peg_statf === "D") {
              data = "Dikenakan denda Lewat"
            }
            if (row.peg_statf === "N") {
              data = "DiKenakan Notis E"
            }
            if (row.peg_statf === "W") {
              data = "Dikenakan Waran F"
            }
            if (row.peg_statf === "H") {
              data = "Akaun Tak Aktif (Hapus)"
            }

            return data
          }
        },
        {
          width: "12%",
          targets: 8,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(data);
            if (type === "display") {
              data = '<div class="btn-group btn-group-sm" role="group">'
              data += '<a href="javascript:void(0)" class="btn btn-default btn-sm" type="button" title="Print" id="btn_print" data-akaun="' + row.acct + '"><i class="fa fa-print"></i></a>'
              data += '<a href="investigation/' + row.acct + '" class="btn btn-default btn-sm" type="button" title="Semakan">Semakan</a>'
              data += '<div class="btn-group dropdown">'
              data += '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Jadual <span class="caret"></span></button>'
              data += '<ul class="dropdown-menu right animated fadeIn" role="menu" style="margin-left: -46.5px;">'
              data += '<li><a href="../Account/eliminated/' + row.acct + '">Jadual A</a></li>'
              data += '<li><a href="../Account/amendaccount/' + row.acct + '">Jadual B</a></li>'
              data += '<li><a href="../Account/evaluation/' + row.acct + '">Jadual B(PS)</a></li>'
              data += "</ul></div></div></div>"
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

    // Add event listener for opening and closing details
    $("#handleinfo tbody").on("click", "td.details-control", function () {
      var tr = $(this).closest("tr")
      var row = handleinfo.row(tr)

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide()
        tr.removeClass("shown")
      } else {
        // Open this row
        row.child(format_handleinfo(row.data())).show()
        tr.addClass("shown")
      }
    })
    $("#handleinfo tbody").css("font-size", 13)
  }

  $("#filter").click(function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      $("#handleinfo").DataTable().destroy()
      fill_datatable(area, street)
    } else {
      alert("Select Both filter option")
      $("#handleinfo").DataTable().destroy()
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
