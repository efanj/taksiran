$.ajax({
  url: "User/Statistik",
  async: false,
  success: function (response) {
    console.log(Number(response[0].count))
    var options8 = {
      chart: {
        width: 420,
        type: "pie"
      },
      labels: ["TUNGGAKAN", "LEBIHAN", "SELESAI"],
      series: [Number(response[0].count), Number(response[1].count), Number(response[2].count)],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: "bottom"
            }
          }
        }
      ],
      colors: ["#ff1e1e", "#00aced", "#04be13"]
    }
    var chart8 = new ApexCharts(document.querySelector("#piechart"), options8)

    chart8.render()
  },
  error: function () {
    alert("Error occured")
  }
})

// $.ajax({
//   url: "User/StatistikPenilaian",
//   async: false,
//   success: function (response) {
//     console.log(response.telah)
//     var options3 = {
//       chart: {
//         width: 460,
//         height: 300,
//         type: "bar",
//         toolbar: {
//           show: false
//         }
//       },
//       plotOptions: {
//         bar: {
//           horizontal: false,
//           endingShape: "rounded",
//           columnWidth: "55%"
//         }
//       },
//       dataLabels: {
//         enabled: false
//       },
//       stroke: {
//         show: true,
//         width: 2,
//         colors: ["transparent"]
//       },
//       series: [
//         {
//           name: "Belom Disemak",
//           data: [
//             response.belom[0].count,
//             response.belom[1].count,
//             response.belom[2].count,
//             response.belom[3].count,
//             response.belom[4].count,
//             response.belom[5].count,
//             response.belom[6].count,
//             response.belom[7].count,
//             response.belom[8].count,
//             response.belom[9].count,
//             response.belom[10].count,
//             response.belom[11].count,
//             response.belom[12].count,
//             response.belom[13].count,
//             response.belom[14].count,
//             response.belom[15].count,
//             response.belom[16].count,
//             response.belom[17].count,
//             response.belom[18].count
//           ]
//         },
//         {
//           name: "Telah Disemak",
//           data: [
//             response.telah[0].count,
//             response.telah[1].count,
//             response.telah[2].count,
//             response.telah[3].count,
//             response.telah[4].count,
//             response.telah[5].count,
//             response.telah[6].count,
//             response.telah[7].count,
//             response.telah[8].count,
//             response.telah[9].count,
//             response.telah[10].count,
//             response.telah[11].count,
//             response.telah[12].count,
//             response.telah[13].count,
//             response.telah[14].count,
//             response.telah[15].count,
//             response.telah[16].count,
//             response.telah[17].count,
//             response.telah[18].count
//           ]
//         }
//       ],
//       xaxis: {
//         categories: [
//           response.belom[0].kws_knama,
//           response.belom[1].kws_knama,
//           response.belom[2].kws_knama,
//           response.belom[3].kws_knama,
//           response.belom[4].kws_knama,
//           response.belom[5].kws_knama,
//           response.belom[6].kws_knama,
//           response.belom[7].kws_knama,
//           response.belom[8].kws_knama,
//           response.belom[9].kws_knama,
//           response.belom[10].kws_knama,
//           response.belom[11].kws_knama,
//           response.belom[12].kws_knama,
//           response.belom[13].kws_knama,
//           response.belom[14].kws_knama,
//           response.belom[15].kws_knama,
//           response.belom[16].kws_knama,
//           response.belom[17].kws_knama,
//           response.belom[18].kws_knama
//         ]
//       },
//       yaxis: {
//         title: {
//           text: "(Jumlah Akaun)"
//         }
//       },
//       fill: {
//         opacity: 1
//       },
//       tooltip: {
//         y: {
//           formatter: function (val) {
//             return val
//           }
//         }
//       },
//       colors: [vihoAdminConfig.primary, vihoAdminConfig.secondary, "#222222"]
//     }

//     var chart3 = new ApexCharts(document.querySelector("#column-chart"), options3)

//     chart3.render()
//   },
//   error: function () {
//     alert("Error occured")
//   }
// })
