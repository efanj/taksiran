;(function ($) {
  ;("use strict")

  var windowHeight, windowWidth, mapmobileheight, mapmobileheightSmall, mapmobilewidth

  // calculations for elements that changes size on window resize
  var windowResizeHandler = function () {
    windowHeight = window.innerHeight
    windowWidth = $(window).width()
    mapmobileheight = windowHeight - 140
    mapmobileheightSmall = windowHeight - 500
    mapmobilewidth = (windowWidth / 5) * 3

    $("#mapView").css({
      width: "100%",
      height: mapmobileheight
    })
    $("#mapViewSmall").css({
      height: mapmobileheightSmall
    })
  }

  windowResizeHandler()
  $(window).resize(function () {
    windowResizeHandler()
  })

  window.isphone = false
  if (document.URL.indexOf("http://") === -1 && document.URL.indexOf("https://") === -1) {
    window.isphone = true
  }
})(jQuery)

$(".modal.draggable>.modal-dialog").draggable({
  cursor: "move",
  handle: ".modal-header"
})
$(".modal.draggable>.modal-dialog>.modal-content>.modal-header").css("cursor", "move")
