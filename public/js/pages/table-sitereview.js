$(document).ready(function () {
  fill_datatable()

  function fill_datatable(area = "", street = "") {
    var sitereview = $("#sitereview").DataTable({
      pageLength: 5,
      lengthMenu: [
        [5, 15, 25, 50],
        [5, 15, 25, 50]
      ],
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: "sitereviewtable",
        type: "POST",
        data: {
          area: area,
          street: street
        }
      },
      searching: false,
      select: "single",
      columnDefs: [
        {
          targets: 0,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(row);
            if (type === "display") {
              data = row.smk_akaun + "<br>" + row.smk_nolot + "<br>"
            }
            return data
          }
        },
        {
          targets: 1,
          searchable: false,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(row);
            if (type === "display") {
              data = row.smk_adpg1 + "<br>" + row.smk_adpg2 + "<br>"
            }
            return data
          }
        },
        { data: "jln_jnama", orderable: false, targets: 2 },
        {
          data: "hrt_hnama",
          targets: 3,
          orderable: false,
          render: function (data, type, row, meta) {
            // console.log(row.smk_type)
            if (data === "KEDIAMAN" || data === "KEDIAMAN-STRATEGIK" || data === "KEDIAMAN-KWSN BARU" || data === "KEDIAMAN-ZON 1" || data === "KEDIAMAN-ZON 2" || data === "KEDIAMAN-ZON 3") {
              data = "<span class='badge rounded-pill badge-primary'>" + data + "</span>"
            }
            if (data === "PERNIAGAAN") {
              data = "<span class='badge rounded-pill badge-secondary'>" + data + "</span>"
            }
            if (data === "TANAH LOT KOSONG (P)" || data === "TANAH LOT KOSONG (B)") {
              data = "<span class='badge rounded-pill badge-success'>" + data + "</span>"
            }
            if (data === "PERINDUSTRIAN") {
              data = "<span class='badge rounded-pill badge-info'>" + data + "</span>"
            }
            if (data === "RANC RUMAH AWAM") {
              data = "<span class='badge rounded-pill badge-warning text-dark'>" + data + "</span>"
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
              data = row.smk_lsbgn + " m&sup2; <br>" + row.smk_lstnh + " m&sup2; <br>" + row.smk_lsans + " m&sup2;"
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
              data = row.smk_lsbgn_tmbh + " m&sup2; <br>" + row.smk_lsans_tmbh + " m&sup2;"
            }
            return data
          }
        },
        {
          targets: 6,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(row.smk_type)
            if (row.smk_type === 1) {
              data = "Akaun Baru"
            }
            if (row.smk_type === 2) {
              data = "Pindaan"
            }
            if (row.smk_type === 3) {
              data = "KemasKini Data"
            }
            return data
          }
        },
        { data: "smk_datevisit", orderable: false, targets: 7 },
        {
          data: null,
          orderable: false,
          targets: 8,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.workerid + " - " + row.name
            }
            return data
          }
        },
        {
          targets: 9,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(data);
            if (type === "display") {
              data = '<a class="btn btn-danger btn-sm remove" title="Delete" id="remove" data-id="' + row.id + '"><i class="fa fa-trash"></i></a> '
              data += '<div class="btn-group" role="group">'
              if (row.smk_type === 1) {
                data += '<a href="JadualcSemak/' + row.id + '" class="btn btn-primary btn-sm" title="Siasatan Tapak">Jadual C</a>'
              }
              if (row.smk_type === 2) {
                data += '<a href="JadualbSemak/' + row.id + '" class="btn btn-primary btn-sm" title="Siasatan Tapak">Jadual B</a>' + '<a href="../Evaluate/jadualbSemak/' + row.id + '" class="btn btn-primary btn-sm" title="Siasatan Tapak">Jadual B(PS)</a>'
              }
              if (row.smk_type === 3) {
                data += '<a href="kemaskini/' + row.id + '" class="btn btn-primary btn-sm" title="Siasatan Tapak">KemasKini Data</a>'
              }
              data += "</div>"
            }

            return data
          }
        }
      ],
      order: [[0, "asc"]],
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
    $("#sitereview tbody").css("font-size", 13)
  }

  $("#filter").click(function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      $("#sitereview").DataTable().destroy()
      fill_datatable(area, street)
    } else {
      alert("Select Both filter option")
      $("#sitereview").DataTable().destroy()
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
