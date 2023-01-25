$(document).ready(function () {
  $(".delete-image").click(function (e) {
    var imageId = $(this).data("id")
    bootbox.confirm({
      message: "Gambar atau dokumen dipadamkan.",
      title: "Anda pasti, ingin memadamkannya ?",
      className: "modal-style2",
      callback: function (result) {
        if (result) {
          // panel.remove()
        }
      }
    })
    $("body").data("dynamic").centerModal()
  })
})
$(document).delegate('*[data-toggle="lightbox"]', "click", function (event) {
  event.preventDefault()
  $(this).ekkoLightbox()
})
