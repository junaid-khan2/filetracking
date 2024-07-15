(function ($) {
  "use strict";

  /*-------------------------------------
      Sidebar Toggle Menu
    -------------------------------------*/
  $('.sidebar-toggle-view').on('click', '.sidebar-nav-item .nav-link', function (e) {
    if (!$(this).parents('#wrapper').hasClass('sidebar-collapsed')) {
      var animationSpeed = 300,
        subMenuSelector = '.sub-group-menu',
        $this = $(this),
        checkElement = $this.next();
      if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
        checkElement.slideUp(animationSpeed, function () {
          checkElement.removeClass('menu-open');
        });
        checkElement.parent(".sidebar-nav-item").removeClass("active");
      } else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
        var parent = $this.parents('ul').first();
        var ul = parent.find('ul:visible').slideUp(animationSpeed);
        ul.removeClass('menu-open');
        var parent_li = $this.parent("li");
        checkElement.slideDown(animationSpeed, function () {
          checkElement.addClass('menu-open');
          parent.find('.sidebar-nav-item.active').removeClass('active');
          parent_li.addClass('active');
        });
      }
      if (checkElement.is(subMenuSelector)) {
        e.preventDefault();
      }
    } else {
      if ($(this).attr('href') === "#") {
        e.preventDefault();
      }
    }
  });

  /*-------------------------------------
      Sidebar Menu Control
    -------------------------------------*/
  $(".sidebar-toggle").on("click", function () {
    window.setTimeout(function () {
      $("#wrapper").toggleClass("sidebar-collapsed");
    }, 500);
  });

  /*-------------------------------------
      Sidebar Menu Control Mobile
    -------------------------------------*/
  $(".sidebar-toggle-mobile").on("click", function () {
    $("#wrapper").toggleClass("sidebar-collapsed-mobile");
    if ($("#wrapper").hasClass("sidebar-collapsed")) {
      $("#wrapper").removeClass("sidebar-collapsed");
    }
  });

  /*-------------------------------------
      jquery Scollup activation code
   -------------------------------------*/
  $.scrollUp({
    scrollText: '<i class="fa fa-angle-up"></i>',
    easingType: "linear",
    scrollSpeed: 900,
    animation: "fade"
  });

  /*-------------------------------------
      jquery Scollup activation code
    -------------------------------------*/
  $("#preloader").fadeOut("slow", function () {
    $(this).remove();
  });

  $(function () {
    /*-------------------------------------
          Data Table init
      -------------------------------------*/
    if ($.fn.DataTable !== undefined) {
      $('.data-table').DataTable({
        paging: true,
        searching: false,
        info: false,
        lengthChange: false,
        lengthMenu: [20, 50, 75, 100],
        columnDefs: [{
          targets: [0, -1], // column or columns numbers
          orderable: false // set orderable for selected columns
        }],
      });
    }

    /*-------------------------------------
          All Checkbox Checked
      -------------------------------------*/
    $(".checkAll").on("click", function () {
      $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
    });

    /*-------------------------------------
          Tooltip init
      -------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();



    /*-------------------------------------
          Date Picker
      -------------------------------------*/
    if ($.fn.datepicker !== undefined) {
      $('.air-datepicker').datepicker({
        language: {
          days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
          daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          today: 'Today',
          clear: 'Clear',
          dateFormat: 'dd/mm/yyyy',
          firstDay: 0
        }
      });
    }

    /*-------------------------------------
          Counter
      -------------------------------------*/
    var counterContainer = $(".counter");
    if (counterContainer.length) {
      counterContainer.counterUp({
        delay: 50,
        time: 1000
      });
    }

    /*-------------------------------------
          Vector Map
      -------------------------------------*/
    if ($.fn.vectorMap !== undefined) {
      $('#world-map').vectorMap({
        map: 'world_mill',
        zoomButtons: false,
        backgroundColor: 'transparent',

        regionStyle: {
          initial: {
            fill: '#0070ba'
          }
        },
        focusOn: {
          x: 0,
          y: 0,
          scale: 1
        },
        series: {
          regions: [{
            values: {
              CA: '#41dfce',
              RU: '#f50056',
              US: '#f50056',
              IT: '#f50056',
              AU: '#fbd348'
            }
          }]
        }
      });
    }

    /*-------------------------------------
          Line Chart
      -------------------------------------*/
      if ($("#earning-line-chart").length) {

        var lineChartData = {
          labels: ["", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun", "", ],
          datasets: [
            {
              data: [0, 4e4, 5e4, 3e4, 6e4, 4e4, 7e4, 5e4, 6e4, 5e4, 6e4, 4e4, 5e4], // Files
              backgroundColor: '#00ff00',
              borderColor: '#00ff00',
              borderWidth: 1,
              pointRadius: 0,
              pointBackgroundColor: '#00ff00',
              pointBorderColor: '#ffffff',
              pointHoverRadius: 6,
              pointHoverBorderWidth: 3,
              fill: 'origin',
              label: "Files"
            },
            {
              data: [0, 6e4, 5e4, 7e4, 4e4, 5e4, 6e4, 7e4, 4e4, 6e4, 4e4, 5e4, 7e4], // Letters
              backgroundColor: '#ff00ff',
              borderColor: '#ff00ff',
              borderWidth: 1,
              pointRadius: 0,
              pointBackgroundColor: '#ff00ff',
              pointBorderColor: '#ffffff',
              pointHoverRadius: 6,
              pointHoverBorderWidth: 3,
              fill: 'origin',
              label: "Letters"
            },
            {
              data: [0, 5e4, 6e4, 4e4, 7e4, 6e4, 5e4, 6e4, 4e4, 5e4, 6e4, 4e4, 5e4], // Note Sheets
              backgroundColor: '#ffff00',
              borderColor: '#ffff00',
              borderWidth: 1,
              pointRadius: 0,
              pointBackgroundColor: '#ffff00',
              pointBorderColor: '#ffffff',
              pointHoverRadius: 6,
              pointHoverBorderWidth: 3,
              fill: 'origin',
              label: "Note Sheets"
            },
            {
              data: [0, 4e4, 5e4, 6e4, 4e4, 5e4, 6e4, 5e4, 4e4, 5e4, 6e4, 4e4, 5e4], // Replays
              backgroundColor: '#00ffff',
              borderColor: '#00ffff',
              borderWidth: 1,
              pointRadius: 0,
              pointBackgroundColor: '#00ffff',
              pointBorderColor: '#ffffff',
              pointHoverRadius: 6,
              pointHoverBorderWidth: 3,
              fill: 'origin',
              label: "Replays"
            }
          ]
        };

        var lineChartOptions = {
          responsive: true,
          maintainAspectRatio: false,
          animation: {
            duration: 2000
          },
          scales: {
            xAxes: [{
              display: true,
              ticks: {
                display: true,
                fontColor: "#222222",
                fontSize: 16,
                padding: 20
              },
              gridLines: {
                display: true,
                drawBorder: true,
                color: '#cccccc',
                borderDash: [5, 5]
              }
            }],
            yAxes: [{
              display: true,
              ticks: {
                display: true,
                autoSkip: true,
                maxRotation: 0,
                fontColor: "#646464",
                fontSize: 16,
                stepSize: 25000,
                padding: 20,
                callback: function (value) {
                  var ranges = [{
                      divider: 1e6,
                      suffix: 'M'
                    },
                    {
                      divider: 1e3,
                      suffix: 'k'
                    }
                  ];

                  function formatNumber(n) {
                    for (var i = 0; i < ranges.length; i++) {
                      if (n >= ranges[i].divider) {
                        return (n / ranges[i].divider).toString() + ranges[i].suffix;
                      }
                    }
                    return n;
                  }
                  return formatNumber(value);
                }
              },
              gridLines: {
                display: true,
                drawBorder: false,
                color: '#cccccc',
                borderDash: [5, 5],
                zeroLineBorderDash: [5, 5],
              }
            }]
          },
          legend: {
            display: true,
            position: 'bottom',
            labels: {
              fontColor: '#333',
              fontSize: 14,
              boxWidth: 20,
              usePointStyle: true
            }
          },
          tooltips: {
            mode: 'index',
            intersect: false,
            enabled: true
          },
          elements: {
            line: {
              tension: .35
            },
            point: {
              pointStyle: 'circle'
            }
          }
        };

        var earningCanvas = $("#earning-line-chart").get(0).getContext("2d");
        var earningChart = new Chart(earningCanvas, {
          type: 'line',
          data: lineChartData,
          options: lineChartOptions
        });
      }

    /*-------------------------------------
          Bar Chart
      -------------------------------------*/
    if ($("#expense-bar-chart").length) {

      var barChartData = {
        labels: ["Jan", "Feb", "Mar"],
        datasets: [{
          backgroundColor: ["#40dfcd", "#417dfc", "#ffaa01"],
          data: [125000, 100000, 75000, 50000, 150000],
          label: "Expenses (millions)"
        }, ]
      };
      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 2000
        },
        scales: {

          xAxes: [{
            display: false,
            maxBarThickness: 100,
            ticks: {
              display: false,
              padding: 0,
              fontColor: "#646464",
              fontSize: 14,
            },
            gridLines: {
              display: true,
              color: '#e1e1e1',
            }
          }],
          yAxes: [{
            display: true,
            ticks: {
              display: true,
              autoSkip: false,
              fontColor: "#646464",
              fontSize: 14,
              stepSize: 25000,
              padding: 20,
              beginAtZero: true,
              callback: function (value) {
                var ranges = [{
                    divider: 1e6,
                    suffix: 'M'
                  },
                  {
                    divider: 1e3,
                    suffix: 'k'
                  }
                ];

                function formatNumber(n) {
                  for (var i = 0; i < ranges.length; i++) {
                    if (n >= ranges[i].divider) {
                      return (n / ranges[i].divider).toString() + ranges[i].suffix;
                    }
                  }
                  return n;
                }
                return formatNumber(value);
              }
            },
            gridLines: {
              display: true,
              drawBorder: true,
              color: '#e1e1e1',
              zeroLineColor: '#e1e1e1'

            }
          }]
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        elements: {}
      };
      var expenseCanvas = $("#expense-bar-chart").get(0).getContext("2d");
      var expenseChart = new Chart(expenseCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      });
    }

    /*-------------------------------------
          Doughnut Chart
      -------------------------------------*/
    if ($("#student-doughnut-chart").length) {

      var doughnutChartData = {
        labels: ["Female Students", "Male Students"],
        datasets: [{
          backgroundColor: ["#304ffe", "#ffa601"],
          data: [45000, 105000],
          label: "Total Students"
        }, ]
      };
      var doughnutChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 65,
        rotation: -9.4,
        animation: {
          duration: 2000
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
      };
      var studentCanvas = $("#student-doughnut-chart").get(0).getContext("2d");
      var studentChart = new Chart(studentCanvas, {
        type: 'doughnut',
        data: doughnutChartData,
        options: doughnutChartOptions
      });
    }

    /*-------------------------------------
          Calender initiate
      -------------------------------------*/
    // if ($.fn.fullCalendar !== undefined) {
    //   $('#fc-calender').fullCalendar({
    //     header: {
    //       center: 'basicDay,basicWeek,month',
    //       left: 'title',
    //       right: 'prev,next',
    //     },
    //     fixedWeekCount: false,
    //     navLinks: true, // can click day/week names to navigate views
    //     editable: true,
    //     eventLimit: true, // allow "more" link when too many events
    //     aspectRatio: 1.8,
    //     events: [{
    //         title: 'All Day Event',
    //         start: '2024-07-01'
    //       },

    //       {
    //         title: 'Meeting',
    //         start: '2024-07-12T14:30:00'
    //       },

    //       {
    //         title: 'Other Event',
    //         start: '2024-07-12T14:30:00'
    //       },
    //       {
    //         title: 'Happy Hour',
    //         start: '2024-07-15T17:30:00'
    //       },
    //       {
    //         title: 'Birthday Party',
    //         start: '2024-07-20T07:00:00'
    //       }
    //     ]
    //   });
    // }
  });

})(jQuery);
