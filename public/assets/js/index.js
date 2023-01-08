$(function () {
  "use strict";

  var vs = [];
  var ss = [];
  var ct = [];
  var cts = [];

  for (const e in tab) {

    vs.push(tab[e]);
    cts.push(e);
  }

  for (const c in tab1) {
    ss.push(tab1[c]);
    ct.push(c);
  }

  var options = {

    series: [
      {
        name: "Sessions",
        data: vs,
      },
      {
        name: "Visiteurs",
        data: ss,
        // [9,0,0,0,0,0,0,0,0,0,0,0],
      }
    ],
    chart: {
      foreColor: '#9a9797',
      type: "area",
      // width: 350,
      height: 370,
      toolbar: {
        show: !1
      },
      zoom: {
        enabled: !1
      },
      dropShadow: {
        enabled: 0,
        top: 3,
        left: 14,
        blur: 4,
        opacity: .12,
        color: "#3461ff"
      },
      sparkline: {
        enabled: !1
      }
    },
    markers: {
      size: 0,
      colors: ["#3461ff", "#12bf24"],
      strokeColors: "#fff",
      strokeWidth: 2,
      hover: {
        size: 7
      }
    },
    plotOptions: {
      bar: {
        horizontal: !1,
        columnWidth: "35%",
        endingShape: "rounded"
      }
    },
    legend: {
      show: false,
      position: 'top',
      horizontalAlign: 'left',
      offsetX: -20
    },
    dataLabels: {
      enabled: !1,
    },
    grid: {
      show: true,
      // borderColor: '#eee',
      // strokeDashArray: 4,
    },
    stroke: {
      show: !0,
      width: 3,
      curve: "smooth"
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "vertical",
        shadeIntensity: 0.5,
        gradientToColors: ["#3461ff", "#12bf24"],
        inverseColors: true,
        opacityFrom: 0.8,
        opacityTo: 0.2,
      }
    },
    colors: ["#3461ff", "#12bf24"],
    xaxis: {
      categories: cts
    },
    yaxist: {
      title: {
        Text: "Courbe d'évolution des visiteurs et sessions"
      }
    },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: function (val) {
          return "" + val + ""
        }
      }
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart1"), options);
  chart.render();


  // chart 2
  var options = {
    series: [160, 60, 35],
    chart: {
      height: 250,
      type: 'pie',
    },
    labels: ['New Orders', 'Pending', 'Completed'],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "vertical",
        shadeIntensity: 0.5,
        gradientToColors: ["#00c6fb", "#ff6a00", "#98ec2d"],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        //stops: [0, 50, 100],
        //colorStops: []
      }
    },
    colors: ["#005bea", "#ee0979", "#17ad37"],
    legend: {
      show: false,
      position: 'top',
      horizontalAlign: 'left',
      offsetX: -20
    },
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          height: 270
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  var chart = new ApexCharts(document.querySelector("#chart2"), options);
  chart.render();

  // chart 3
  var options = {
    series: [7, 4],
    chart: {
      width: 360,
      type: 'donut',
    },

    labels: ["Sessions", "Visiteurs"],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "vertical",
        shadeIntensity: 0.5,
        gradientToColors: ["#00BFFF", "#ff0080"],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,

      }
    },

    colors: ["#00BFFF", "#ff0080"],
    legend: {
      show: false,
      position: 'top',
      horizontalAlign: 'left',
      offsetX: -20
    },
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          height: 260
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
  };

  var chart = new ApexCharts(document.querySelector("#chart3"), options);
  chart.render();

  // chart 4

  let mois = [];
  let sessions = [];
  async function apiData() {

    const apilink = document.location.origin + "/guests/connexion-chart";
    const response = await fetch(apilink);
    return await response.json();

  }



  async function drawChart() {
    var options = {
      series: [{
        labels: mois,
        name: "Sessions",
        data: sessions,
      }],

      chart: {
        foreColor: '#9a9797',
        type: "bar",
        height: 280,
        toolbar: {
          show: !1
        },
        zoom: {
          enabled: !1
        },

        dropShadow: {
          enabled: 0,
          top: 3,
          left: 14,
          blur: 4,
          opacity: .12,
          color: "#3361ff"
        },

        sparkline: {
          enabled: !1
        }
      },

      markers: {
        size: 0,
        colors: ["#3361ff"],
        strokeColors: "#fff",
        strokeWidth: 2,
        hover: {
          size: 7
        }
      },

      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "40%",
          endingShape: "rounded"
        }
      },

      legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left',
        offsetX: -20
      },

      dataLabels: {
        enabled: !1
      },

      stroke: {
        show: !0,
        width: 0,
        curve: "smooth"
      },

      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: "vertical",
          shadeIntensity: 0.5,
          gradientToColors: ["#005bea", "#ff0080"],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          //stops: [0, 50, 100],
          //colorStops: []
        }
      },

      colors: ["#348bff", "#ff00ab"],
      xaxis: {
        categories: mois,
      },

      tooltip: {
        theme: 'dark',
        y: {
          formatter: function (val) {
            return "" + val + ""
          }
        }
      }

    };

    var chart = new ApexCharts(document.querySelector("#chart4"), options);
    chart.render();
  }

  drawChart();

  jQuery('#geographic-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: false,
    color: '#009efb',
    regionStyle: {
      initial: {
        fill: '#6c757d'
      }
    },
    markerStyle: {
      initial: {
        r: 9,
        'fill': '#fff',
        'fill-opacity': 1,
        'stroke': '#000',
        'stroke-width': 5,
        'stroke-opacity': 0.4
      },
    },
    enableZoom: true,
    hoverColor: '#009efb',
    markers: [{
      latLng: [21.00, 78.00],
      name: 'I Love My India'
    }],
    series: {
      regions: [{
        values: {
          IN: '#8833ff',
          US: '#3461ff',
          RU: '#12bf24',
          AU: '#ffb207'
        }
      }]
    },
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
    onRegionClick: function (element, code, region) {
      var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
      alert(message);
    }
  });

  $(document).ready(function () {
    $('#Transaction-History').DataTable({
      lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']]
    });
  });

  new PerfectScrollbar(".new-customer-list")

});