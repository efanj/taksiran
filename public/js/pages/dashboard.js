//------------- blank.js -------------//
$(document).ready(function () {
  var api_url = "https://perancang.mps.gov.my/geoserver/mdpt/wms?"
  var popup = L.popup()

  var g_roadmap = new L.Google("ROADMAP")
  var g_terrain = new L.Google("TERRAIN")
  var g_satellite = new L.Google("SATELLITE")

  var visitwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "mpti:v_semak",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })
  // var paymentwmsLayer = L.tileLayer.betterWms(api_url, {
  //   layers: "mdpt:v_payment_all",
  //   format: "image/png",
  //   transparent: true,
  //   maxZoom: 25,
  // })
  var kadlotwmsLayer = L.tileLayer.betterWms(api_url, {
    layers: "	mdpt:kadLot",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })
  // var mukimwmsLayer = L.tileLayer.wms(api_url, {
  //   layers: "mdpt:mukim",
  //   format: "image/png",
  //   transparent: true,
  //   maxZoom: 25,
  // })
  var sempadanwmsLayer = L.tileLayer.wms(api_url, {
    layers: "mdpt:daerah",
    format: "image/png",
    transparent: true,
    maxZoom: 25
  })

  var layerLegend = L.Geoserver.legend("https://perancang.mps.gov.my/geoserver", {
    layers: "mdpt:v_payment_all",
    style: `payment_status`
  })

  var map = L.map("mapView", {
    center: [4.2635497, 100.8956734],
    zoom: 10,
    markerZoomAnimation: false,
    zoomControl: false,
    maxZoom: 25
  })
  var zoomControl = new L.Control.Zoom({ position: "topright" })
  zoomControl.addTo(map)

  var baseMaps = [
    {
      groupName: "Base Maps",
      expanded: true,
      layers: {
        "Google Map - Satellite": g_satellite,
        "Google Map - Terrain": g_terrain,
        "Google Map - Road Map": g_roadmap
      }
    }
  ]
  var overlays = [
    {
      groupName: "Overlay",
      expanded: true,
      layers: {
        Sempadan: sempadanwmsLayer,
        Kadlot: kadlotwmsLayer,
        Dilawati: visitwmsLayer
      }
    }
  ]
  var options = {
    container_width: "250px",
    group_maxHeight: "150px",
    exclusive: false,
    collapsed: true,
    position: "topright"
  }

  var control = L.Control.styledLayerControl(baseMaps, overlays, options)
  map.addControl(control)
  control.selectLayer(g_roadmap)
  control.selectLayer(sempadanwmsLayer)
  control.selectLayer(kadlotwmsLayer)
  control.selectLayer(visitwmsLayer)

  // var input = document.getElementById("google_term")
  // var mdptBounds = new google.maps.LatLngBounds(
  //   new google.maps.LatLng(4.584785, 100.699578)
  // )
  // var options = {
  //   bounds: mdptBounds,
  //   // location: new google.maps.LatLng(4.265604, 100.9320657),
  //   // radius: 15000, // (in meters; this is 15Km)
  //   types: ["establishment"],
  //   strictBounds: true,
  //   componentRestrictions: {
  //     country: ["my"],
  //   },
  // }
  // var autocomplete = new google.maps.places.Autocomplete(input, options)
  // autocomplete.addListener("place_changed", function () {
  //   // clearOverlayVector();
  //   var places = autocomplete.getPlace()

  //   if (!places.geometry) {
  //     window.alert("No details available for input: '" + places.name + "'")
  //     return
  //   }

  //   var group = L.featureGroup()

  //   // Create a marker for each place.
  //   var marker = L.marker([
  //     places.geometry.location.lat(),
  //     places.geometry.location.lng(),
  //   ])
  //   group.addLayer(marker)

  //   group.addTo(map)
  //   map.fitBounds(group.getBounds())
  // })

  map.on("overlayadd", function (eventLayer) {
    console.log(eventLayer.name)
    if (eventLayer.name === "Status Bayaran") {
      layerLegend.addTo(this)
    }
    // if (eventLayer.name === "Dilawati") {
    //   layerLegendLawat.addTo(this)
    // }
  })
  map.on("overlayremove", function (eventLayer) {
    if (eventLayer.name === "Status Bayaran") {
      this.removeControl(layerLegend)
    }
    // if (eventLayer.name === "Dilawati") {
    //   this.removeControl(layerLegendLawat)
    // }
  })

  // map.on("click", function (e) {
  //   // console.log(e.latlng)
  //   var url = getFeatureInfoUrl(map, kadlotwmsLayer, e.latlng, {
  //     info_format: "application/json",
  //   })
  //   $.ajax({
  //     url: url,
  //     success: function (data) {
  //       console.log(data)
  //       const mukim = data.features[0].properties.mukim
  //       const nolot = data.features[0].properties.lot
  //       const nopt = data.features[0].properties.no_pt
  //       const lstnh = data.features[0].properties.keluasan_mp
  //       const infodata = JSON.stringify(data.features[0].geometry)
  //       // console.log(infodata)
  //       const coord = convert(infodata)
  //       var lotdata = [nolot, nopt, lstnh]
  //       getAccountInfo(e.latlng, [nolot, mukim, nopt], coord)
  //     },
  //     error: function () {
  //       alert("Error connecting to server")
  //     },
  //   })
  // })

  // $(document).on("click", "#carian_pinda", function () {
  //   // var akaun = $(this).data("akaun")
  //   var coords = $(this).data("coord")
  //   var coord = coords.split(",")
  //   // console.log(coord)
  //   if (coord[1] != "") {
  //     location(coord[1], coord[0])
  //   }
  // })

  // $(document).on("click", "#carian_kemaskini", function () {
  //   // var akaun = $(this).data("akaun")
  //   var coords = $(this).data("coord")
  //   var coord = coords.split(",")
  //   // console.log(coord)
  //   if (coord[1] != "") {
  //     location(coord[1], coord[0])
  //   }
  // })

  // $(document).on("click", "#carian_upload", function () {
  //   // var akaun = $(this).data("akaun")
  //   var coords = $(this).data("coord")
  //   var coord = coords.split(",")
  //   // console.log(coord)
  //   if (coord[1] != "") {
  //     location(coord[1], coord[0])
  //   }
  // })

  // $("#mapView").on("click", "#update", function () {
  //   var akaun = $(this).data("data")
  //   var coords = $(this).data("code")
  //   var coord = coords.split(",")
  //   angular
  //     .element(document.getElementById("container-map"))
  //     .scope()
  //     .klik_update(akaun)
  //   location(coord[0], coord[1])
  // })

  // $("#mapView").on("click", "#pindaan", function ($event) {
  //   $event.stopPropagation()
  //   var akaun = $(this).data("data")
  //   var coords = $(this).data("code")
  //   var coord = coords.split(",")

  //   angular
  //     .element(document.getElementById("container-map"))
  //     .scope()
  //     .klik_pindaan(akaun)

  //   location(coord[0], coord[1])
  // })

  // $("#mapView").on("click", "#padanan", function () {
  //   var infolot = $(this).data("lot")
  //   var info = infolot.split(",")
  //   var akaun = $(this).data("data")

  //   angular
  //     .element(document.getElementById("container-map"))
  //     .scope()
  //     .klik_padanan(info, akaun)
  // })

  // $("#mapView").on("click", "#info_lot", function () {
  //   var infolot = $(this).data("lot")
  //   var info = infolot.split(",")

  //   angular
  //     .element(document.getElementById("container-map"))
  //     .scope()
  //     .klik_info(info)
  // })

  // $("#mapView").on("click", "#koordinat", function () {
  //   var code = $(this).data("code")
  //   angular
  //     .element(document.getElementById("container-map"))
  //     .scope()
  //     .klik_coordinate(code)
  // })

  // function location(lat, lng) {
  //   map.setView([lat, lng], 19, {
  //     animate: true,
  //   })
  //   var marker = L.marker([lat, lng])
  //   marker.bindPopup("Akaun yang dipilih.").openPopup()
  //   marker.addTo(map)
  //   // console.log(lat)
  // }

  // function getAccountInfo(coordinate, features, coord) {
  //   $(".overlay_bg").show()
  //   var coords = [coordinate.lat, coordinate.lng]
  //   // console.log(Number(datalot[0]))
  //   var data_pack = {
  //     coord: coord,
  //   }

  //   fetch(server_url + "searchPolygon", {
  //     method: "POST",
  //     body: JSON.stringify({
  //       coord: coord,
  //     }),
  //     headers: {
  //       "Content-type": "application/json; charset=UTF-8",
  //     },
  //   })
  //     .then(function (response) {
  //       $(".overlay_bg").hide()
  //       return response.json()
  //     })
  //     .then(function (data) {
  //       // console.log(data)
  //       if (data.status === 200) {
  //         var properties =
  //           "<table class='table-info' style='font-size:12px;' width='100%'>"
  //         properties += "<tbody>"
  //         properties +=
  //           "<tr><td width='40%'><b>No.Akaun</b></td><td width='60%'>" +
  //           data.data[0].akaun +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Alamat</b></td><td width='60%'>" +
  //           data.data[0].adpg1 +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'></td><td width='60%'>" +
  //           data.data[0].adpg2 +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'></td><td width='60%'>" +
  //           data.data[0].adpg3 +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'></td><td width='60%'>" +
  //           data.data[0].adpg4 +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>No.Lot</b></td><td width='60%'>" +
  //           data.data[0].nolot +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Jenis Bangunan</b></td><td width='60%'>" +
  //           data.data[0].bnama +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Luas Tanah</b></td><td width='60%'>" +
  //           data.data[0].lstnh +
  //           " mp</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Luas Bgn</b></td><td width='60%'>" +
  //           data.data[0].lsbgn +
  //           " mp</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Luas Ansolari</b></td><td width='60%'>" +
  //           data.data[0].lsans +
  //           " mp</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Nilai Tahunan</b></td><td width='60%'>RM " +
  //           data.data[0].nilth +
  //           "</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Kadar</b></td><td width='60%'>" +
  //           data.data[0].kadar +
  //           " %</td></tr>"
  //         properties +=
  //           "<tr><td width='40%'><b>Taksiran</b></td><td width='60%'>RM " +
  //           data.data[0].tksir +
  //           "</td></tr>"
  //         properties += "<tr><td colspan='2'></td></tr>"
  //         properties += "<tr><td colspan='2' style='text-align:center;'>"
  //         properties +=
  //           "<div class='btn-group btn-group-sm'><button id='update' class='btn btn-primary btn-sm' data-code='" +
  //           coords +
  //           "' data-data='" +
  //           data.data[0].akaun +
  //           "'>Kemaskini</button><button id='pindaan' class='btn btn-danger btn-sm' data-lot='" +
  //           datalot +
  //           "' data-code='" +
  //           coords +
  //           "' data-data='" +
  //           data.data[0].akaun +
  //           "'>Pindaan</button><button id='padanan' class='btn btn-success btn-sm' data-lot='" +
  //           datalot +
  //           "' data-code='" +
  //           coords +
  //           "' data-data='" +
  //           data.data[0].akaun +
  //           "'>Padanan</button><button id='koordinat' class='btn default btn-sm' data-code='" +
  //           coords +
  //           "'>Koordinat</button></div>"
  //         properties += "</td></tr>"
  //         properties += "</tbody></table>"
  //         L.popup().setLatLng(coordinate).setContent(properties).openOn(map)
  //       } else {
  //         var properties =
  //           "<table class='table-info' style='font-size:12px;' width='250px'>"
  //         properties +=
  //           "<tr><td style='text-align:center; font-size:12px;' colspan='3'>Maklumat tidak dijumpai!</td></tr>"
  //         properties +=
  //           "<tr><td style='text-align:center; font-size:12px;'></td></tr>"
  //         properties +=
  //           "<tr><td style='text-align:center; font-size:12px;' colspan='3'><div class='btn-group btn-group-sm'><button id='padanan' class='btn btn-primary btn-sm' data-lot='" +
  //           features +
  //           "'>Padanan</button>"
  //         properties +=
  //           "<button id='info_lot' class='btn btn-success btn-sm' data-lot='" +
  //           features +
  //           "'>Maklumat Lot</button>"
  //         properties +=
  //           "<button id='koordinat' class='btn btn-default btn-sm' data-code='" +
  //           coords +
  //           "'>Koordinat</button></div></td></tr></table>"
  //         L.popup().setLatLng(coordinate).setContent(properties).openOn(map)
  //       }
  //     })
  // }

  // function getFeatureInfoUrl(map, layer, latlng, params) {
  //   var point = map.latLngToContainerPoint(latlng, map.getZoom()),
  //     size = map.getSize(),
  //     params = {
  //       request: "GetFeatureInfo",
  //       service: "WMS",
  //       srs: "EPSG:4326",
  //       styles: "",
  //       version: layer._wmsVersion,
  //       format: layer.options.format,
  //       bbox: layer._map.getBounds().toBBoxString(),
  //       // bbox: sw.x + "," + sw.y + "," + ne.x + "," + ne.y,
  //       // bbox: [sw.join(","), ne.join(",")].join(","),
  //       height: size.y,
  //       width: size.x,
  //       layers: layer.options.layers,
  //       query_layers: layer.options.layers,
  //       info_format: "application/json",
  //     }
  //   var pointX = point.x
  //   var pointY = point.y
  //   params[params.version === "1.3.0" ? "i" : "x"] = Math.round(point.x)
  //   params[params.version === "1.3.0" ? "j" : "y"] = Math.round(point.y)

  //   return layer._url + L.Util.getParamString(params, layer._url, true)
  // }

  // function convert(value) {
  //   var input_json = JSON.parse(value)
  //   var wkt_type = input_json.type
  //   var wkt_str =
  //     wkt_type.toUpperCase() +
  //     "(" +
  //     input_json.coordinates
  //       .map(function (ring) {
  //         return (
  //           "(" +
  //           ring
  //             .map(function (p) {
  //               return p[0] + " " + p[1]
  //             })
  //             .join(", ") +
  //           ")"
  //         )
  //       })
  //       .join(", ") +
  //     ")"
  //   return wkt_str
  // }

  // function ConvertCoordinate(coord) {
  //   const e_value = 2.7182818284
  //   const X = 20037508.34

  //   const lat3857 = coord.lat
  //   const long3857 = coord.lng

  //   //converting the longitute from epsg 3857 to 4326
  //   const long4326 = (long3857 * 180) / X

  //   //converting the latitude from epsg 3857 to 4326 split in multiple lines for readability
  //   let lat4326 = lat3857 / (X / 180)
  //   const exponent = (Math.PI / 180) * lat4326

  //   lat4326 = Math.atan(Math.pow(e_value, exponent))
  //   lat4326 = lat4326 / (Math.PI / 360) // Here is the fixed line
  //   lat4326 = lat4326 - 90

  //   return { lat: lat4326, lng: long4326 }
  // }
  // function successCallback(result) {
  //   console.log(result)
  // }
  // function errorCallback(result) {
  //   console.log(result)
  // }

  // var removeFlag = false
  // /**
  //  * Legend API has deduplication function
  //  * @param {string} [position] - legend control position
  //  * @param {string} [title] - legend title
  //  * @param {string} [legendType] - legend type
  //  * @param {array} [imgArr] - graphic legend parameter (object array, including image url and text description)
  //  * @param {array} [colorArr] - color legend parameter array (object array, including color and corresponding text description)
  //  * @param {string} [imgId] - the unique identification id corresponding to img legend
  //  * @param {string} [colorId] - the unique identification id corresponding to the color legend
  //  * @param {bool} [isShow] - show hide
  //  */
  // function legendfn(position, title, legendType, imgArr, colorArr, imgId, colorId, isShow) {
  //   // imgType graphic legend
  //   if (legendType === "imgType") {
  //     if (isShow) {
  //       // show
  //       if (!this.legendCtrl) {
  //         // Determine whether the control is initialized No create a new control
  //         this.legendCtrl = new L.Control.setLegend({
  //           position: position,
  //           title: title,
  //           legendType: legendType,
  //           imgArr: imgArr,
  //           colorArr: colorArr,
  //           imgId: imgId,
  //           colorId: colorId
  //         })
  //         this.legendCtrl.addTo(map)
  //       } else {
  //         // control legendCtrl has been initialized, only add the corresponding imgContent
  //         // legendCtrl has been removed, so it needs to addTo(map) again
  //         // But because legendCtrl is not automatically updated, the last div before remove remains
  //         // So after addTo(map), you need to empty the content of the control, and then add the corresponding legend
  //         if (this.removeFlag) {
  //           this.legendCtrl.addTo(map)
  //           // Here should add a this.legendCtrl with empty content
  //           this.legendCtrl.setContentToNULL()
  //           this.removeFlag = false
  //         }
  //         this.legendCtrl.setImgContent(title, legendType, imgArr, imgId)
  //       }
  //     } else {
  //       // hide
  //       // Delete the corresponding imgContent div
  //       this.legendCtrl.removeImgContent(imgId)
  //       // Remove the control when it is judged that the control is empty
  //       let judgeContent = this.legendCtrl.judgeContent()
  //       if (judgeConetent) {
  //         this.legendCtrl.remove()
  //         // Set the flag to remember the content state
  //         this.removeFlag = true
  //       }
  //     }
  //   }
  //   // colorType legend of color type of thematic map
  //   if (legendType === "colorType") {
  //     if (isShow) {
  //       // show
  //       if (!this.legendCtrl) {
  //         // Determine whether the control is initialized No create a new control
  //         this.legendCtrl = new L.Control.setLegend({
  //           position: position,
  //           title: title,
  //           legendType: legendType,
  //           imgArr: imgArr,
  //           colorArr: colorArr,
  //           imgId: imgId,
  //           colorId: colorId
  //         })
  //         this.legendCtrl.addTo(map)
  //       } else {
  //         // already initialized, only add the corresponding colorContent
  //         // Add the corresponding colorContent div
  //         if (this.removeFlag) {
  //           this.legendCtrl.addTo(map)
  //           this.legendCtrl.setContentToNULL()
  //           this.removeFlag = false
  //         }
  //         this.legendCtrl.setColorContent(title, legendType, colorArr, colorId)
  //       }
  //     } else {
  //       // hide
  //       // Delete the corresponding colorContent div
  //       this.legendCtrl.removeColorContent(colorId)
  //       // Remove the control when it is judged that the control is empty
  //       let judgeContent = this.legendCtrl.judgeContent()
  //       if (judgeConetent) {
  //         this.legendCtrl.remove()
  //         this.removeFlag = true
  //       }
  //     }
  //   }

  //   return this.legendCtrl
  // }

  // /**
  //  * legend
  //  * @param: {layerName} (String) layer name
  //  * @param: {isShow} (Boolean) show hide
  //  * @param: {position} (String) Legend control position
  //  */
  // // icon array
  // var imgArr = [
  //   {
  //     url: "img/icons/legend.png",
  //     size: [150, 322],
  //     label: "Legend"
  //   }
  // ]
  // setLegend = function (layerName, isShow, position) {
  //   // console.log('Add legend:', layerName)
  //   for (let i = 0; i < imgArr.length; i++) {
  //     if (layerName === imgArr[i].label) {
  //       let imgToArr = []
  //       imgToArr.push(imgArr[i])
  //       legendfn(position, "", "imgType", imgToArr, [], layerName, "", isShow)
  //     }
  //   }
  //   return layerName
  // }

  // // Example
  // setLegend("Legend", true, "bottomleft")
  // setLegend("emergency supplies", true, "bottomleft")
  // setLegend("where the incident happened", true, "bottomleft")

  // var showExpert = false
  // function addExpert() {
  //   showExpert = !showExpert
  //   setLegend("Emergency Expert", showExpert, "bottomleft")
  // }
  // var showDanger = false
  // function addDanger() {
  //   showDanger = !showDanger
  //   setLegend("Danger source", showDanger, "bottomleft")
  // }
})
