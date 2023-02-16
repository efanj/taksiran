/**
 * @class LMap. setLegend
 * @extents {L.Control}
 * @param {object} options - legend incoming parameters
 * @param {string} [options.position] - legend control position
 * @param {string} [options.title] - legend title
 * @param {string} [options.legendType] - Legend type
 * @param {array} [options.imgArr] - graphic legend parameters (object array, including image url and text description)
 * @param {array} [options.colorArr] - color legend parameter array (object array, including color and corresponding text description)
 * @param {string} [options.imgId] - the unique identifier of the added img legend
 * @param {string} [options.colorId] - Unique ID of the color legend to add
 */
L.Control.setLegend = L.Control.extend({
  options: {
    position: "topright",
    title: "Legend",
    legendType: "",
    imgArr: [],
    colorArr: [],
    imgId: "",
    colorId: ""
  },
  initialize: function (options) {
    L.Util.extend(this.options, options)
  },
  onAdd: function (map) {
    // _container is the control container
    this._container = L.DomUtil.create("div", "leaflet-control-clegend")
    this._container.setAttribute("id", "legendContainer") // Set the id for the content to hide the control for convenience

    //////////////////////////////////////////////////// /////////////////////////////////////////////////
    // Create a div container to contain all content
    this.mainDiv = L.DomUtil.create("div", "leaflet-control-max-div")
    this.mainDiv.style.display = "block"
    // create title
    var title = L.DomUtil.create("div", "leaflet-control-clegend-title")
    title.innerHTML = "Legend"
    // this._container.appendChild(title)
    this.mainDiv.appendChild(title)
    // create close button
    var closeBtn = L.DomUtil.create("a", "leaflet-control-legend-close")
    // closeBtn. innerHTML = 'X'
    closeBtn.innerHTML = `<img src="img/leaflet/close.png" style="width:18px;height:18px;">`
    title.appendChild(closeBtn)
    // register close event
    L.DomEvent.on(closeBtn, "click", this._onCloseControl, this)

    // Create the content of the legend
    this.setContent()

    //////////////////////////////////////////////////// ////////////////////////////////////////////////
    // Create a button to expand the hidden legend
    this._showLegendBtn = L.DomUtil.create("select", "show-legend-button")
    this._showLegendBtn.style.display = "none"
    this._showLegendBtn.innerHTML = "Legend"
    var option = L.DomUtil.create("option", "")
    option.innerHTML = "Legend"
    this._showLegendBtn.appendChild(option)
    L.DomEvent.on(this._showLegendBtn, "click", this._showControl, this)

    // Add button and this.mainDiv to the parent container _container
    this._container.appendChild(this._showLegendBtn)
    this._container.appendChild(this.mainDiv)

    return this._container
  },
  // add content
  setContent: function () {
    this.content = L.DomUtil.create("div", "leaflet-control-legend-content")
    this.content.setAttribute("id", "legendMainContent") // Set the id for the content to facilitate the identification and hide the control
    if (this.options.legendType === "imgType") {
      // graphic
      this.setImgContent(this.options.title, this.options.legendType, this.options.imgArr, this.options.imgId)
    }
    if (this.options.legendType === "colorType") {
      // color gradient
      this.setColorContent(this.options.title, this.options.legendType, this.options.colorArr, this.options.colorId)
    }
    this.mainDiv.appendChild(this.content)
  },
  // add imgContent
  /**
   *
   * @param {string} title - legend title
   * @param {string} legendType - legend type
   * @param {array} imgArr - img legend array
   * @param {string} imgId - img unique identifier
   */
  setImgContent: function (title, legendType, imgArr, imgId) {
    this.imgContent = L.DomUtil.create("div", "leaflet-control-legend-imgcontent")
    this.imgContent.setAttribute("id", `${imgId}`) // Set id for imgContent to facilitate control of visibility
    // this.setTitle(title, legendType, imgId) // Add different legend titles
    for (let i = 0; i < imgArr.length; i++) {
      this._addImgItem(imgArr[i])
    }

    // Judgment deduplication
    if (this.content.childNodes.length === 0) {
      // still empty legend
      this.content.appendChild(this.imgContent)
    } else {
      // A legend already exists
      let arr = []
      this.content.childNodes.forEach((item) => {
        arr.push(item.id)
      })
      if (arr.indexOf(imgId) > -1) {
        // the same legend already exists
        return
      } else {
        this.content.appendChild(this.imgContent)
      }
    }
  },
  // add colorContent
  /**
   *
   * @param {string} title - legend title
   * @param {string} legendType - legend type
   * @param {array} colorArr - color legend array
   * @param {string} colorId - the unique identifier of the color
   */
  setColorContent: function (title, legendType, colorArr, colorId) {
    this.colorContent = L.DomUtil.create("div", "leaflet-control-legend-colorContent")
    this.colorContent.setAttribute("id", `${colorId}`) // Set id for colorContent to facilitate control of display
    this.setTitle(title, legendType, colorId)
    for (let i = 0; i < colorArr.length; i++) {
      this._addColorItem(colorArr[i])
    }
    this.content.appendChild(this.colorContent)
  },
  // add legend subtitle
  /**
   *
   * @param {string} title - legend title
   * @param {string} legendType - legend type
   * @param {string} id - unique identification id
   */
  setTitle: function (title, legendType, id) {
    let titleContent = L.DomUtil.create("span", "leaflet-control-legend-content-title")
    if (legendType === "imgType") {
      titleContent.setAttribute("id", `${id}`)
      titleContent.innerHTML = `<strong>${title}</strong>`
      this.imgContent.appendChild(titleContent)
    }
    if (legendType === "colorType") {
      titleContent.setAttribute("id", `${id}`)
      titleContent.innerHTML = `<strong>${title}</strong>`
      this.colorContent.appendChild(titleContent)
    }
  },
  // Add graphic legend line by line
  _addImgItem: function (obj) {
    let imglegend = L.DomUtil.create("div", "legend-imgitem-div")
    imglegend.innerHTML = `<img src="${obj.url}" width="${obj.size[0]}" height="${obj.size[1]}" style="margin:4px 15px 0 15px;" />
                                <span style="position:absolute;margin-top:6px;">${obj.label}</span>
                               `
    this.imgContent.appendChild(imglegend)
  },
  // Add color gradient legend line by line
  _addColorItem: function (obj) {
    let colorlegend = L.DomUtil.create("div", "legend-coloritem-div")
    colorlegend.innerHTML = `<span style="float:left;margin-left:12px;height:${obj.size[0]}px;width:${obj.size[1]}px;background:${obj.color};"></span>
                                 <p style="margin:0;">${obj.label}</p>`
    this.colorContent.appendChild(colorlegend)
  },
  // Hide the corresponding imgContent or colorContent
  hideOneContent: function (id) {
    // console. log('Hide!!!')
    document.getElementById(id).setAttribute("style", "display: none")
    // document.getElementById(id).style.display = 'none'
  },
  // Display the corresponding imgContent or colorContent
  showOneContent: function (id) {
    // console. log('Show!!!')
    document.getElementById(id).setAttribute("style", "display:block")
  },
  // Remove the corresponding imgContent
  removeImgContent: function (imgId) {
    // console. log('remove imgLegend!!!')
    let divobj = document.getElementById(imgId)
    if (divobj === null) return
    divobj.parentNode.removeChild(divobj)
  },
  // Remove the corresponding colorCotent
  removeColorContent: function (colorId) {
    // console. log('remove colorContent!!!')
    let colorDiv = document.getElementById(colorId)
    if (colorDiv === null) return
    colorDiv.parentNode.removeChild(colorDiv)
  },
  // Check if the content is empty
  judgeContent: function () {
    if (this.content.innerHTML === "") {
      return true
    } else {
      return false
    }
  },
  // Empty the content in content
  setContentToNULL: function () {
    this.content.innerHTML = ""
  },
  // hide legend
  _onCloseControl: function () {
    this.mainDiv.style.display = "none"
    this._showLegendBtn.style.display = "block"
  },
  // show hidden legend
  _showControl: function () {
    this.mainDiv.style.display = "block"
    this._showLegendBtn.style.display = "none"
  }
})
