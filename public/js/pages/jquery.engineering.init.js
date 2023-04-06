$(document).ready(function () {
  var popup = L.popup()

  var g_roadmap = new L.Google("ROADMAP")
  var g_terrain = new L.Google("TERRAIN")
  var g_satellite = new L.Google("SATELLITE")

  var visitwmsLayer = L.tileLayer.betterWms("https://perancang.mps.gov.my/geoserver/mpti/wms?", {
    layers: "mpti:v_semak",
    format: "image/png",
    transparent: true,
    maxZoom: 25,
    attribution: "Kadlot Terkini © 2022 Majlis Perbandaran Teluk Intan"
  })
  // var paymentwmsLayer = L.tileLayer.betterWms("https://perancang.mps.gov.my/geoserver/mdpt/wms?", {
  //   layers: "mdpt:v_payment_all",
  //   format: "image/png",
  //   transparent: true,
  //   maxZoom: 25,
  //   attribution: "Kadlot Terkini © 2022 Majlis Perbandaran Teluk Intan"
  // })
  var kadlotwmsLayer = L.tileLayer.betterWms("https://perancang.mps.gov.my/geoserver/mpti/wms?", {
    layers: "mpti:lot",
    format: "image/png",
    transparent: true,
    maxZoom: 25,
    attribution: "Kadlot Terkini © 2022 Majlis Perbandaran Teluk Intan"
  })
  // var mukimwmsLayer = L.tileLayer.wms("https://perancang.mps.gov.my/geoserver/mdpt/wms?", {
  //   layers: "mdpt:mukim",
  //   format: "image/png",
  //   transparent: true,
  //   maxZoom: 25,
  //   attribution: "Kadlot Terkini © 2022 Majlis Perbandaran Teluk Intan"
  // })
  var sempadanwmsLayer = L.tileLayer.wms("https://perancang.mps.gov.my/geoserver/mpti/wms?", {
    layers: "mpti:sempadan",
    format: "image/png",
    transparent: true,
    maxZoom: 25,
    attribution: "Kadlot Terkini © 2022 Majlis Perbandaran Teluk Intan"
  })
  var map = L.map("mapView", {
    center: [3.9451963, 100.9629367],
    zoom: 10.5,
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
    group_maxHeight: "120px",
    exclusive: false,
    collapsed: true,
    position: "topright"
  }

  var control = L.Control.styledLayerControl(baseMaps, overlays, options)
  map.addControl(control)
  // map.addLayer(g_roadmap)
  control.selectLayer(g_roadmap)
  control.selectLayer(sempadanwmsLayer)
  control.selectLayer(kadlotwmsLayer)
  control.selectLayer(visitwmsLayer)

  // var GooglePlacesSearchBox = L.Control.extend({
  //   onAdd: function () {
  //     var element = document.createElement("input")
  //     ;(element.id = "searchBox"),
  //       (element.className = "form-control form-control-sm")
  //     return element
  //   },
  // })
  // new GooglePlacesSearchBox({ position: "topleft" }).addTo(map)

  // var input = document.getElementById("searchBox")
  // var kamparBounds = new google.maps.LatLngBounds(
  //   new google.maps.LatLng(4.152675899261355, 100.95722858989261),
  //   new google.maps.LatLng(4.476880623191109, 101.42586414897464)
  // )
  // var options = {
  //   bounds: kamparBounds,
  //   strictBounds: true,
  //   componentRestrictions: {
  //     country: ["my"],
  //   },
  // }
  // var autocomplete = new google.maps.places.Autocomplete(input, options)
  // autocomplete.addListener("place_changed", function () {
  //   // clearOverlayVector();
  //   var place = autocomplete.getPlace()

  //   if (places.length == 0) {
  //     return
  //   }

  //   var group = L.featureGroup()

  //   places.forEach(function (place) {
  //     // Create a marker for each place.
  //     var marker = L.marker([
  //       place.geometry.location.lat(),
  //       place.geometry.location.lng(),
  //     ])
  //     group.addLayer(marker)
  //   })

  //   group.addTo(map)
  //   map.fitBounds(group.getBounds())
  // })

  map.on("click", function (e) {
    // Build the URL for a GetFeatureInfo
    var url = getFeatureInfoUrl(map, kadlotwmsLayer, e.latlng, {
      info_format: "application/json"
    })

    // Send the request and create a popup showing the response
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        const nolot = data.features[0].properties.lot
        $("#no_lot").val(nolot)
      })
  })

  function getFeatureInfoUrl(map, layer, latlng, params) {
    var point = map.latLngToContainerPoint(latlng, map.getZoom()),
      size = map.getSize(),
      bounds = map.getBounds(),
      sw = bounds.getSouthWest(),
      ne = bounds.getNorthEast(),
      crs = layer.options.crs || layer._map.options.crs,
      sw = crs.project(layer._map.getBounds().getSouthWest()),
      ne = crs.project(layer._map.getBounds().getNorthEast()),
      params = {
        request: "GetFeatureInfo",
        service: "WMS",
        srs: layer._crs.code,
        styles: "",
        version: layer._wmsVersion,
        format: layer.options.format,
        bbox: sw.x + "," + sw.y + "," + ne.x + "," + ne.y,
        // bbox: [sw.join(","), ne.join(",")].join(","),
        height: size.y,
        width: size.x,
        layers: layer.options.layers,
        query_layers: layer.options.layers,
        info_format: "application/json"
      }

    params[params.version === "1.3.0" ? "i" : "x"] = point.x
    params[params.version === "1.3.0" ? "j" : "y"] = point.y

    return layer._url + L.Util.getParamString(params, layer._url, true)
  }

  window.onload = function () {
    var $codex = $("#codex").val()
    var $codey = $("#codey").val()

    if ($codex.length >= 6) {
      var iconFeature = L.icon({
        iconUrl: "../../img/leaflet/marker-icon.png",
        iconSize: [25, 41],
        iconAnchor: [13, 41],
        popupAnchor: [0, -28]
      })

      L.marker([$codey, $codex], { icon: iconFeature }).addTo(map)
      map.setView([$codey, $codex], 20)
    }
  }

  $("input[name=permit]").on("change", function () {
    setCalc()
  })
  $("input[name=luas_dibenarkan]").on("keyup", function () {
    setCalc()
  })

  function setCalc() {
    var p = document.getElementById("permit").value
    var lbt = document.getElementById("luasbgntamb").value
    var la = document.getElementById("luas_dibenarkan").value
    var lsb = document.getElementById("luas_stbck").value
    var ttl_denda, ttlSetbck
    if (Number(la) != "") {
      if (Number(la) < Number(lbt)) {
        var split = Number(lbt) - Number(la)
        $("#luas_stbck").val(split.toFixed(2))
        $("#denda_tahunan").val("true")
        $("#dummy_tahunan").prop("checked", true)
      } else {
        $("#luas_stbck").val("0")
        $("#dummy_tahunan").prop("checked", false)
      }
    }
    if (Number(lbt) != "") {
      var ttlDenda = (Number(lbt) * 7) / 9

      if (ttlDenda <= 50) {
        ttl_denda = 50
      } else if (ttlDenda > 50) {
        ttl_denda = ttlDenda
      }
      yearly(ttl_denda)
      $("#jumlah_denda").val(ttl_denda.toFixed(2))
    } else {
      var ttlAllow = (Number(lbt) * 7) / 9
      yearly(ttlAllow)
      $("#jumlah_denda").val(ttlAllow.toFixed(2))
    }
  }

  function yearly(jumlah_denda) {
    var lsb = document.getElementById("luas_stbck").value
    var ttl_setback
    if (Number(lsb) != 0) {
      var ttlSetbck = (Number(lsb) * 5) / 9
      if (ttlSetbck <= 50) {
        ttl_setback = Number(50)
      } else if (ttlSetbck > 50) {
        ttl_setback = Number(ttlSetbck)
      } else if (ttlSetbck === 0) {
        ttl_setback = Number(0)
      }
    } else {
      ttl_setback = Number(0)
    }
    $("#jumlah_tahunan").val(ttl_setback.toFixed(2))
    jumlahkeseluruhan(jumlah_denda, ttl_setback)
  }

  function jumlahkeseluruhan(denda, tahanan) {
    var overall_ttl = Number(denda) + Number(tahanan)
    console.log(overall_ttl)
    $("#jumlah_keseluruhan").val(overall_ttl.toFixed(2))
  }
})
