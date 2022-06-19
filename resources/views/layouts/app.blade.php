<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="900;url=lockscreen" />
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>IT Helpdesk :: {{ $page_name }}</title>
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="vendor/fontawesome-free/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/scrollable.css">
    <link rel="stylesheet" type="text/css" href="assets/css/summernote.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/prism.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/photoswipe.css">
    <!-- Plugins css Ends-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

  </head>
  
  @if((date('H') >= 10) AND (date('H') <= 15))
  <body class="custom-scrollbar" style="font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">
  @else
  <body class="custom-scrollbar dark-only" style="font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">
  @endif
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper"><a href=""></a></div>
            <div class="dark-logo-wrapper"><a href=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
          </div>
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li><a class="text-dark" href="lockscreen"><i data-feather="lock"></i></a></li>
              <li>
                @if((date('H') >= 10) && (date('H') <= 15))
                <div class="mode"><i class="fa fa-moon-o"></i></div>
                @else
                <div class="mode"><i class="fa fa-lightbulb-o"></i></div>
                @endif
              </li>
              <li class="onhover-dropdown p-0">
                <button class="btn btn-primary-light" href="#" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-logout"><i data-feather="log-out"></i>Log out</a></button>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>  
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="assets/images/male.png" alt="">
            <h6 class="mt-3 f-14 f-w-600"> {{ session()->get('first_name') }} {{ session()->get('surname') }} <i class="fas fa-check-circle small text-success"></i></h6></a>
            <p class="mb-0 font-roboto" style="font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ session()->get('role') }}</p>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="dashboard"><i data-feather="home"></i><span>Dashboard</span></a></li>
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="new-ticket"><i data-feather="edit"></i><span>Add Ticket</span></a></li>
                  @if (session()->get('role') == 'Administrator')
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="zap"></i><span>Tickets</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="open-ticket">Open</a></li>
                      <li><a href="pending-ticket">Pending</a></li>
                      <li><a href="on-hold-ticket">On Hold</a></li>
                      <li><a href="solved-ticket">Solved</a></li>
                      <li><a href="closed-ticket">Closed</a></li>
                    </ul>
                  </li>
                  @endif
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="my-tasks"><i data-feather="check-square"></i><span>My Tasks</span></a></li>
                  @if (session()->get('role') == 'Administrator')
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="staff-management"><i data-feather="users"></i><span>Staff Management</span></a></li>
                  @endif
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="summary-reports"><i data-feather="pie-chart"></i><span>Summary Reports</span></a></li>
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="knowledgebase"><i data-feather="book-open"></i><span>Knowledgebase</span></a></li>
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="settings"></i><span>Settings</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="manage-profile">Manage Profile</a></li>
                    </ul>
                  </li>
                  @if (session()->get('role') == 'Administrator')
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="list"></i><span>System Logs</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="ticket-logs">Ticket Logs</a></li>
                      <li><a href="user-logs">User Logs</a></li>
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
        <!-- Page Sidebar Ends-->

        @yield('content')

       <!-- footer start-->
       <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0 small">Copyright &copy;
                  <script>
                  document.write(new Date().getFullYear())
                  </script>.
                  IT Corporate, Lands Commission
                </p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0 small">Developed by Software Engineering Team</p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <div class="modal fade bd-example-modal-logout" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-warning small mb-3">LOGGING OUT...</h6>
                <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-danger"></i></a>
            </div>
            <div class="modal-body">                                    
                <form method="GET" action="{{ route('logout') }}" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                    <p>Are you sure to end your session?</p>
                    <div class="text-start mt-n-4">
                      <input id="index_var" type="hidden" value="6">
                      <button class="btn btn-primary" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle small"></i> No</button>
                      <button class="btn btn-secondary"><i class="fas fa-sign-out-alt small"></i> Yes</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
     </div>

    <!-- PAGE SCRIPTS -->

    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/config.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Plugins js-->
    <script src="assets/js/form-validation-custom.js"></script>
    <script src="assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="assets/js/owlcarousel/owl-custom.js"></script>
    <script src="assets/js/general-widget.js"></script>
    <script src="assets/js/height-equal.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
    <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatables/datatable.custom.js"></script>
    <script src="assets/js/clipboard/clipboard.min.js"></script>
    <script src="assets/js/chart/chartist/chartist.js"></script>
    <script src="assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="assets/js/chart/knob/knob.min.js"></script>
    <script src="assets/js/chart/knob/knob-chart.js"></script>
    <script src="assets/js/dashboard/default.js"></script>
    <script src="assets/js/prism/prism.min.js"></script>
    <script src="assets/js/clipboard/clipboard.min.js"></script>
    <script src="assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="assets/js/counter/jquery.counterup.min.js"></script>
    <script src="assets/js/counter/counter-custom.js"></script>
    <script src="assets/js/custom-card/custom-card.js"></script>
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="assets/js/owlcarousel/owl-custom.js"></script>
    <script src="assets/js/dashboard/dashboard_2.js"></script>
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/notify/notify-script.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
    <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assets/js/chart/apex-chart/chart-custom.js"></script>

    <!--Theme js-->
    <script src="assets/js/script.js"></script>

    <!--App js-->
    <script src="js/app.js"></script>

    @if ($page_name == 'Dashboard')
    <script type="text/javascript">
      var options3 = {
          chart: {
              height:350,
              type: 'bar',
              fontFamily: ' SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
              toolbar:{
              show: false
              }
          },
          plotOptions: {
              bar: {
                  horizontal: false,
                  endingShape: 'rounded',
                  columnWidth: '55%',
              },
          },
          dataLabels: {
              enabled: false
          },
          stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
          },
          series: [{
              name: 'Pending',
              data: ["{{ session()->get('ds_pending_ticket_count') }}", "{{ session()->get('s_pending_ticket_count') }}", "{{ session()->get('h_pending_ticket_count') }}", "{{ session()->get('n_pending_ticket_count') }}"]
          },
          {
              name: 'On-Hold',
              data: ["{{ session()->get('ds_on_hold_ticket_count') }}", "{{ session()->get('s_on_hold_ticket_count') }}", "{{ session()->get('h_on_hold_ticket_count') }}", "{{ session()->get('n_on_hold_ticket_count') }}"]
          },
          {
              name: 'Solved',
              data: ["{{ session()->get('ds_solved_ticket_count') }}", "{{ session()->get('s_solved_ticket_count') }}", "{{ session()->get('h_solved_ticket_count') }}", "{{ session()->get('n_solved_ticket_count') }}"]
          },
          {
              name: 'Closed',
              data: ["{{ session()->get('ds_closed_ticket_count') }}", "{{ session()->get('s_closed_ticket_count') }}", "{{ session()->get('h_closed_ticket_count') }}", "{{ session()->get('n_closed_ticket_count') }}"]
          }],
          xaxis: {
              categories: ['Desktop Support', 'Software', 'Hardware', 'Networking'],
          },
          yaxis: {
              title: {
                  text: ''
              }
          },
          fill: {
              opacity: 1

          },
          tooltip: {
              y: {
                  formatter: function (val) {
                      return val
                  }
              }
          },
          colors:["#FFC107", "#A52835", vihoAdminConfig.primary, vihoAdminConfig.secondary]
      }

      var chart3 = new ApexCharts(
          document.querySelector("#column-chart-department"),
          options3
      );

      chart3.render();

    </script>
    <script type="text/javascript">
      var options7 = {
        chart: {
            height: 350,
            type: 'line',
            fontFamily: ' SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
            stacked: false,
            toolbar:{
              show: false
            }
        },
        stroke: {
            width: [0, 2, 5],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },
        colors: ['#3A5794', '#A5C351', '#E14A84'],
        series: [{
            name: 'Desktop Support',
            type: 'column',
            data: ["{{ session()->get('ds_jan_ticket_count') }}", "{{ session()->get('ds_feb_ticket_count') }}", "{{ session()->get('ds_mar_ticket_count') }}", "{{ session()->get('ds_apr_ticket_count') }}", "{{ session()->get('ds_may_ticket_count') }}", "{{ session()->get('ds_jun_ticket_count') }}", "{{ session()->get('ds_jul_ticket_count') }}", "{{ session()->get('ds_aug_ticket_count') }}", "{{ session()->get('ds_sep_ticket_count') }}", "{{ session()->get('ds_oct_ticket_count') }}", "{{ session()->get('ds_nov_ticket_count') }}", "{{ session()->get('ds_dec_ticket_count') }}"]
        }, {
            name: 'Software',
            type: 'area',
            data: ["{{ session()->get('s_jan_ticket_count') }}", "{{ session()->get('s_feb_ticket_count') }}", "{{ session()->get('s_mar_ticket_count') }}", "{{ session()->get('s_apr_ticket_count') }}", "{{ session()->get('s_may_ticket_count') }}", "{{ session()->get('s_jun_ticket_count') }}", "{{ session()->get('s_jul_ticket_count') }}", "{{ session()->get('s_aug_ticket_count') }}", "{{ session()->get('s_sep_ticket_count') }}", "{{ session()->get('s_oct_ticket_count') }}", "{{ session()->get('s_nov_ticket_count') }}", "{{ session()->get('s_dec_ticket_count') }}"]
        }, {
            name: 'Hardware',
            type: 'line',
            data: ["{{ session()->get('h_jan_ticket_count') }}", "{{ session()->get('h_feb_ticket_count') }}", "{{ session()->get('h_mar_ticket_count') }}", "{{ session()->get('h_apr_ticket_count') }}", "{{ session()->get('h_may_ticket_count') }}", "{{ session()->get('h_jun_ticket_count') }}", "{{ session()->get('h_jul_ticket_count') }}", "{{ session()->get('h_aug_ticket_count') }}", "{{ session()->get('h_sep_ticket_count') }}", "{{ session()->get('h_oct_ticket_count') }}", "{{ session()->get('h_nov_ticket_count') }}", "{{ session()->get('h_dec_ticket_count') }}"]
        }, {
            name: 'Networking',
            type: 'area',
            data: ["{{ session()->get('n_jan_ticket_count') }}", "{{ session()->get('n_feb_ticket_count') }}", "{{ session()->get('n_mar_ticket_count') }}", "{{ session()->get('n_apr_ticket_count') }}", "{{ session()->get('n_may_ticket_count') }}", "{{ session()->get('n_jun_ticket_count') }}", "{{ session()->get('n_jul_ticket_count') }}", "{{ session()->get('n_aug_ticket_count') }}", "{{ session()->get('n_sep_ticket_count') }}", "{{ session()->get('n_oct_ticket_count') }}", "{{ session()->get('n_nov_ticket_count') }}", "{{ session()->get('n_dec_ticket_count') }}"]
        }],
        fill: {
            opacity: [0.85,0.25,1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ["01/01/{{ date('Y') }}","02/01/{{ date('Y') }}","03/01/{{ date('Y') }}","04/01/{{ date('Y') }}","05/01/{{ date('Y') }}","06/01/{{ date('Y') }}","07/01/{{ date('Y') }}","08/01/{{ date('Y') }}","09/01/{{ date('Y') }}","10/01/{{ date('Y') }}","11/01/{{ date('Y') }}","12/01/{{ date('Y') }}"],
        markers: {
            size: 0
        },
        xaxis: {
            type:'datetime'
        },
        yaxis: {
            min: 0
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if(typeof y !== "undefined") {
                        return  y.toFixed(0) + " Ticket(s)";
                    }
                    return y;

                }
            }
        },
        legend: {
            labels: {
                useSeriesColors: true
            },
        },
        colors:[vihoAdminConfig.primary,"#A52835",vihoAdminConfig.secondary,"#FFC107"]
    }

    var chart7 = new ApexCharts(
        document.querySelector("#mixed-dept-chart"),
        options7
    );

    chart7.render();
    </script>
    @endif

    @if ($page_name == 'Staff Management')
    <script src="js/staff-management.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Open Ticket')
    <script src="js/open-tickets.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Pending Ticket')
    <script src="js/pending-tickets.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'On-Hold Ticket')
    <script src="js/on-hold-tickets.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Solved Ticket')
    <script src="js/solved-tickets.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Closed Ticket')
    <script src="js/closed-tickets.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif
    
    @if ($page_name == 'My Tasks')
    <script src="js/handle-tickets.js"></script>
    <script src="js/myclosed-tickets.js"></script>
    <script src="js/myonhold-tickets.js"></script>
    <script src="js/myopen-tickets.js"></script>
    <script src="js/mypending-tickets.js"></script>
    <script src="js/mysolved-tickets.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Ticket Logs')
    <script src="js/ticket-logs-ga.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Knowledgebase')
    <!-- Plugins JS start-->
    <script src="js/photoswipe/photoswipe.min.js"></script>
    <script src="js/photoswipe/photoswipe-ui-default.min.js"></script>
    <script src="js/photoswipe/photoswipe.js"></script>
    <!-- Plugins JS Ends-->
    @endif

    @if ($page_name == 'Manage Profile')
    <script type="text/javascript">
      var options3 = {
          chart: {
              height:350,
              type: 'bar',
              fontFamily: ' SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
              toolbar:{
              show: false
              }
          },
          plotOptions: {
              bar: {
                  horizontal: false,
                  endingShape: 'rounded',
                  columnWidth: '55%',
              },
          },
          dataLabels: {
              enabled: false
          },
          stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
          },
          series: [{
              name: 'Success',
              data: ["{{ session()->get('jan_count_s') }}", "{{ session()->get('feb_count_s') }}", "{{ session()->get('mar_count_s') }}", "{{ session()->get('apr_count_s') }}", "{{ session()->get('may_count_s') }}", "{{ session()->get('jun_count_s') }}", "{{ session()->get('jul_count_s') }}", "{{ session()->get('aug_count_s') }}", "{{ session()->get('sep_count_s') }}", "{{ session()->get('oct_count_s') }}", "{{ session()->get('nov_count_s') }}", "{{ session()->get('dec_count_s') }}"]
          }, {
              name: 'Failed',
              data: ["{{ session()->get('jan_count_f') }}", "{{ session()->get('feb_count_f') }}", "{{ session()->get('mar_count_f') }}", "{{ session()->get('apr_count_f') }}", "{{ session()->get('may_count_f') }}", "{{ session()->get('jun_count_f') }}", "{{ session()->get('jul_count_f') }}", "{{ session()->get('aug_count_f') }}", "{{ session()->get('sep_count_f') }}", "{{ session()->get('oct_count_f') }}", "{{ session()->get('nov_count_f') }}", "{{ session()->get('dec_count_f') }}"]
          }],
          xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          },
          yaxis: {
              title: {
                  text: ''
              }
          },
          fill: {
              opacity: 1

          },
          tooltip: {
              y: {
                  formatter: function (val) {
                      return val
                  }
              }
          },
          colors:[vihoAdminConfig.primary, "#a52835"]
      }

      var chart3 = new ApexCharts(
          document.querySelector("#column-chart-login"),
          options3
      );

      chart3.render();

    </script>
    @endif

    @if ($page_name == 'User Logs')
    <script src="js/user-logs.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    @endif

    @if ($page_name == 'Summary Reports')
    <script src="assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/datatables.js"></script>
    <script src="assets/js/scrollable/perfect-scrollbar.min.js"></script>
    <script src="assets/js/scrollable/scrollable-custom.js"></script>
    @endif
    
  </body>
</html>