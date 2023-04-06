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
        Kadlot: kadlotwmsLayer
        // Dilawati: visitwmsLayer,
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

  map.on("overlayadd", function (eventLayer) {
    if (eventLayer.name === "Bayaran") {
      layerLegend.addTo(this)
    }
  })
  map.on("overlayremove", function (eventLayer) {
    if (eventLayer.name === "Bayaran") {
      this.removeControl(layerLegend)
    }
  })

  map.on("click", function (e) {
    $("#codex").val(e.latlng.lat)
    $("#codey").val(e.latlng.lng)
  })

  function addMarker() {
    var lat, lng
    if ($("#codex").val() === "") {
      map.setView(new L.LatLng(4.2738327000745, 100.95737914922), 11)
    } else {
      lat = $("#codex").val()
      lng = $("#codey").val()
      L.marker([lat, lng]).addTo(map)
      map.setView(new L.LatLng(lat, lng), 16)
    }
  }

  addMarker()
})
