@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
  <div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
  </div>

  <div class="content">
    <div class="row">
      <div class="col-lg-4 " >
        <div class="card text-white card-chart bg-info">
          <div class="card-header">
            <h4 class="card-title">Jumlah Pemasukan</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> Rp. {{ number_format($laporan, 0, ',', '.') }}</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 " >
        <div class="card text-white card-chart bg-warning">
          <div class="card-header">
            <h4 class="card-title">Jumlah Pengeluaran</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 " >
        <div class="card text-white card-chart bg-success">
          <div class="card-header">
            <h4 class="card-title">Jumlah Dana Saat Ini</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> Rp. {{ number_format($total, 0, ',', '.') }}</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 " >
        <div class="card text-white card-chart bg-secondary">
          <div class="card-header">
            <h4 class="card-title">Jumlah Mustahik</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> {{ $mustahik }} Orang</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 " >
      <div class="card text-white card-chart bg-primary">
          <div class="card-header">
            <h4 class="card-title">Jumlah Muzzaki</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> {{ $muzzaki }} orang</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 " >
        <div class="card text-white card-chart bg-info">
          <div class="card-header">
            <h4 class="card-title">Penyaluran Beras</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> {{ $penyaluranberas }} Kg</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 " >
        <div class="card text-white card-chart bg-warning">
          <div class="card-header">
            <h4 class="card-title">Jumlah Beras Saat Ini</h4>  
          </div>
          
          <div class="card-body">
          <h6 class="card-title color-white"> {{ $totalberas }} Kg</h5>
          </div>
          <div class="card-footer ">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
      
    </div>
  </div>
@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(document).ready(function() {
      demo.initDashboardPageCharts();
    });

    var demo = {
      initDashboardPageCharts: function() {

        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
          },
          responsive: 1,
          scales: {
            yAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false
              }
            }],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false
              }
            }]
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15
            }
          }
        };

        gradientChartOptionsConfigurationWithNumbersAndGrid = {
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
          },
          responsive: true,
          scales: {
            yAxes: [{
              gridLines: 0,
              gridLines: {
                zeroLineColor: "transparent",
                drawBorder: false
              }
            }],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false
              }
            }]
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15
            }
          }
        };

        var ctx = document.getElementById('bigDashboardChart').getContext("2d");

        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, chartColor);

        var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

        var monthlyIncome = @json(array_values($monthlyIncome));

        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            datasets: [{
              label: "Pemasukan",
              borderColor: chartColor,
              pointBorderColor: chartColor,
              pointBackgroundColor: "#1e3d60",
              pointHoverBackgroundColor: "#1e3d60",
              pointHoverBorderColor: chartColor,
              pointBorderWidth: 1,
              pointHoverRadius: 7,
              pointHoverBorderWidth: 2,
              pointRadius: 5,
              fill: true,
              backgroundColor: gradientFill,
              borderWidth: 2,
              data: monthlyIncome
            }]
          },
          options: {
            layout: {
              padding: {
                left: 20,
                right: 20,
                top: 0,
                bottom: 0
              }
            },
            maintainAspectRatio: false,
            tooltips: {
              backgroundColor: '#fff',
              titleFontColor: '#333',
              bodyFontColor: '#666',
              bodySpacing: 4,
              xPadding: 12,
              mode: "nearest",
              intersect: 0,
              position: "nearest"
            },
            legend: {
              position: "bottom",
              fillStyle: "#FFF",
              display: false
            },
            scales: {
              yAxes: [{
                ticks: {
                  fontColor: "rgba(255,255,255,0.4)",
                  fontStyle: "bold",
                  beginAtZero: true,
                  maxTicksLimit: 5,
                  padding: 10
                },
                gridLines: {
                  drawTicks: true,
                  drawBorder: false,
                  display: true,
                  color: "rgba(255,255,255,0.1)",
                  zeroLineColor: "transparent"
                }

              }],
              xAxes: [{
                gridLines: {
                  zeroLineColor: "transparent",
                  display: false,

                },
                ticks: {
                  padding: 10,
                  fontColor: "rgba(255,255,255,0.4)",
                  fontStyle: "bold"
                }
              }]
            }
          }
        });
      }
    };
  </script>
@endpush