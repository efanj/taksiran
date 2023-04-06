//------------- charts-flot.js -------------//
$(document).ready(function () {
  //------------- Flot charts -------------//

  //define chart colours first
  var chartColours = {
    gray: "#bac3d2",
    teal: "#43aea8",
    blue: "#00aced",
    red: "#ff1e1e",
    green: "#04be13",
    gray_lighter: "#e8ecf1",
    gray_light: "#777777",
    gridColor: "#bfbfbf"
  }

  //------------- Pie chart -------------//
  var options = {
    series: {
      pie: {
        show: true,
        innerRadius: 0,
        radius: 1,
        label: {
          show: true,
          radius: 2 / 3,
          formatter: labelFormatter,
          threshold: 0.1
        }
      }
    },
    legend: {
      show: true,
      labelFormatter: function (label, series) {
        return '<div style="font-weight:bold;font-size:13px;">&nbsp;' + label + "</div>"
      },
      labelBoxBorderColor: null,
      margin: 50,
      width: 20,
      padding: 1
    }
  }
  $.ajax({
    url: "User/Statistik",
    async: false,
    success: function (response) {
      // console.log(Number(response[0].count))
      var data = [
        { label: "TUNGGAKAN", data: Number(response[0].count), color: chartColours.red },
        { label: "SELESAI", data: Number(response[1].count), color: chartColours.green },
        { label: "LEBIHAN", data: Number(response[2].count), color: chartColours.blue }
      ]
      $.plot($("#pie-chart"), data, options)
    },
    error: function () {
      alert("Error occured")
    }
  })

  function labelFormatter(label, series) {
    return "<div style='font-weight:bold;font-size:10pt; text-align:center; padding:2px; color:white;'>" + series.data[0][1] + "</div>"
  }
})
