$(document).ready(function () {
  fill_datatable()

  function fill_datatable(area = "", street = "") {
    var table = $("#sitereviews").DataTable({
      pageLength: 5,
      lengthMenu: [
        [5, 15, 25, 50],
        [5, 15, 25, 50]
      ],
      processing: true,
      serverSide: true,
      searching: true,
      order: [],
      ajax: {
        url: "sitereviewtable",
        type: "POST",
        data: {
          area: area,
          street: street
        }
      },
      columnDefs: [
        {
          targets: 0,
          data: "sid",
          checkboxes: {
            selectRow: true
          }
        },
        {
          targets: 1,
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
          targets: 2,
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
        {
          targets: 3,
          orderable: false,
          data: "jln_jnama"
        },
        {
          targets: 4,
          orderable: false,
          data: "hrt_hnama"
        },
        {
          targets: 5,
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
          targets: 6,
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
          targets: 7,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.hadapan + "<br>" + row.belakang
            }
            return data
          }
        },
        {
          targets: 8,
          orderable: false,
          data: null,
          render: function (data, type, row, meta) {
            // console.log(row.smk_type)
            if (type === "display") {
              if (row.smk_type === 1) {
                data = "<span class='label label-default'>Akaun Baru</span>"
              }
              if (row.smk_type === 2) {
                data = "<span class='label label-primary'>Pindaan</span>"
              }
              if (row.smk_type === 3) {
                data = "<span class='label label-success'>KemasKini Data</span>"
              }
            }
            return data
          }
        },
        { targets: 9, orderable: false, data: "smk_datevisit" },
        {
          targets: 10,
          orderable: true,
          data: null,
          render: function (data, type, row, meta) {
            if (type === "display") {
              data = row.workerid + "</br>" + row.name
            }
            return data
          }
        },
        {
          targets: 11,
          orderable: false,
          className: "dt-body-center",
          data: null,
          render: function (data, type, row, meta) {
            // console.log(data);
            if (type === "display") {
              data = '<div class="btn-group btn-group-sm" role="group">'
              if (row.sirino != "-") {
                data += '<a href="' + row.calctype + "/" + row.sirino + '" class="btn btn-default btn-sm" title="Borang Nilaian"><i class="fa fa-calculator color-dark"></i></a>'
              } else {
                data += '<a href="' + row.calctype + "/" + row.akaun + '" class="btn btn-default btn-sm" title="Borang Nilaian"><i class="fa fa-calculator color-dark"></i></a>'
              }
              data += '<a href="viewimages/' + row.id + '" class="btn btn-default btn-sm" title="Gambar"><i class="fa  fa-file-photo-o color-dark"></i></a>'
              data += '<a href="viewdocuments/' + row.id + '" class="btn btn-default btn-sm" title="Dokumen"><i class="fa fa-file-pdf-o color-dark"></i></a>'
              data += '<a class="btn btn-danger btn-sm remove" title="Padam" id="remove" data-id="' + row.id + '"><i class="fa fa-trash"></i></a>'
              data += "</div>"
            }
            return data
          }
        }
      ],
      select: {
        style: "multi"
      },
      order: [[9, "asc"]],
      language: {
        search: "Saring : ",
        lengthMenu: "Paparkan _MENU_ rekod",
        zeroRecords: "Tiada maklumat yang dijumpai",
        info: "Memaparkan _START_ sehingga _END_ rekod daripada _TOTAL_ rekod",
        infoEmpty: "Tiada rekod",
        infoFiltered: "(Ditapis daripada _MAX_ rekod)",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Seterus",
          previous: "Sebelum"
        }
      }
    })

    $("#form-verifylists").on("submit", function (e) {
      $("#submit_popup").modal("show")
      var form = this
      var rows_selected = table.column(0).checkboxes.selected()
      console.log(rows_selected)
      // $.each(rows_selected, function (index, rowId) {
      //   data += rowId
      // })
      var data = rows_selected.join(",")
      $("#id").val(data)

      // Prevent actual form submission
      e.preventDefault()
    })
  }

  $("#sitereviews").css("font-size", 13)

  $("#filter").click(function () {
    var area = $("#area").val()
    var street = $("#street").val()
    if (area != "" && street != "") {
      $("#sitereviews").DataTable().destroy()
      fill_datatable(area, street)
    } else {
      alert("Select Both filter option")
      $("#sitereviews").DataTable().destroy()
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

  // $("#sitereviews tbody").on("click", "#remove", function () {
  //   var data = table.row($(this).parents("tr")).data()
  //   alert(data[0] + "'s salary is: " + data[5])
  // })

  // $("#sitereviews tbody tr td #remove").click(function (e) {
  //   e.preventDefault()
  //   if (!confirm("Are you sure?")) {
  //     return
  //   }

  //   var row = $(this).parent().parent()
  //   var fileId = row.attr("id")

  //   ajax.send("Vendor/deletesitereview", { file_id: fileId }, deleteFileCallBack)
  //   function deleteFileCallBack(result) {
  //     if (helpers.validateData(result, row, "after", "row", "success")) {
  //       $(row).remove()
  //     }
  //   }
  // })
})
