//------------- charts-flot.js -------------//
$(document).ready(function () {
  var chartColours = {
    teal: "#43aea8",
    red: "#df6a78",
    gridColor: "#bfbfbf",
  }

  //convert the object to array for flot use
  var chartColoursArr = Object.keys(chartColours).map(function (key) {
    return chartColours[key]
  })

  //------------- Ordered bars chart -------------//
  $(function () {
    //some data
    var d1 = []
    for (var i = 0; i <= 20; i += 1)
      d1.push([i, parseInt(Math.random() * 26000)])

    var ds = new Array()

    ds.push({
      label: "Data One",
      data: d1,
      bars: { order: 1 },
    })

    console.log(ds)

    var stack = 0,
      bars = false,
      lines = false,
      steps = false

    var options = {
      bars: {
        show: true,
        barWidth: 0.2,
        fill: 1,
      },
      grid: {
        show: true,
        aboveData: false,
        color: chartColours.gridColor,
        labelMargin: 5,
        axisMargin: 0,
        borderWidth: 0,
        borderColor: null,
        minBorderMargin: 5,
        clickable: true,
        hoverable: true,
        autoHighlight: false,
        mouseActiveRadius: 20,
      },
      series: {
        stack: stack,
      },
      legend: {
        position: "nu",
        margin: [0, -25],
        noColumns: 0,
        labelBoxBorderColor: null,
        labelFormatter: function (label, series) {
          // just add some space to labes
          return "&nbsp;&nbsp;" + label + " &nbsp;&nbsp;"
        },
        width: 30,
        height: 2,
      },
      colors: chartColoursArr,
      tooltip: true, //activate tooltip
      tooltipOpts: {
        content: "%s : %y.0",
        shifts: {
          x: -30,
          y: -50,
        },
      },
    }

    $.plot($("#ordered-bars-chart"), ds, options)
  })
})
