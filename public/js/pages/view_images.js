$(document).ready(function () {
  //check all checkboxes
  // $("#checkAll-active").checkAll({
  //   masterCheckbox: ".check-all",
  //   otherCheckboxes: ".check",
  //   highlightElement: {
  //     active: true,
  //     elementClass: ".panel",
  //     highlightClass: "highlight-panel"
  //   }
  // })
})
$(document).delegate('*[data-toggle="lightbox"]', "click", function (event) {
  event.preventDefault()
  $(this).ekkoLightbox()
})
