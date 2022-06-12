<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>IT Helpdesk :: {{ $page_name }}</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="css2.css?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="css2-1.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="css2-2.css?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

    <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
    $(document).ready(function(){
         $(function(){
            $("#login").submit(function(event){
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('login') }}',
                    dataType: "json",
                    contentType: "application/json",
                    data : $('#login').serialize(),
                    success: function(data){
                        alert(data);
                    },
                    error: function(xhr, desc, err){
                        console.log(err);
                    }
                });
            });
        });
    });
    </script>

    <script>
      $(document).ready(function() {
      $('.btn-login').on('click', function() {
        var $this = $(this);
        var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-fw"></i> Unlocking...</span>';
        if ($(this).html() !== loadingText) {
          $this.data('original-text', $(this).html());
          $this.html(loadingText);
        }
        setTimeout(function() {
          $this.html($this.data('original-text'));
        }, 10000);
      });
    })
    </script>

    <script type="text/javascript">
    (function(global) {
        if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
        }

        var _hash = "!";
        var noBackPlease = function () {
        global.location.href += "#";

        // Making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
        };

        global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
        };
        global.onload = function () {
        noBackPlease();

        //Disables backspace on page except on input fields and textarea...
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elms !== 'input' && elms !== 'textarea')) {
            e.preventDefault();
            }
            // stopping the event bubbling up the Dom tree...
            e.stopPropagation();
        };
        }
    })(window);

    </script>

  </head>

  <!-- Loader ends-->
<!-- page-wrapper Start-->
  <body class="custom-scrollbar" style="font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; background-color: #e9ecec;">
  <img class="bg-img-cover" src="assets/images/background.jpg" alt="loginpage">
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <section>
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-xl-12 p-4">
          <div class="row" style="display: flex; justify-content: center; align-items: center; min-height: 90vh;">
                  <div class="col-xl-6">
                      <div class="card shadow" style="">
                          <div class="card-body d-flex justify-content-center">
                          <form class="form-bookmark needs-validation col-md-10" method="POST" action="unlock" id="bookmark-form" novalidate="">
                          @csrf
                            <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="assets/images/male.png" alt="">
                                <h6 class="mt-3 f-14 f-w-600"> {{ session()->get('first_name') }} {{ session()->get('surname') }} <i class="fas fa-check-circle small text-warning"></i></h6></a>
                                <p class="mb-0 font-roboto" style="font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ session()->get('role') }}</p>
                            </div>
                            <br>
                            @if(session()->has('error_message'))
                            <div class="text-white alert alert-danger dark alert-dismissible fade show" role="alert"><i data-feather="alert-triangle"></i>
                                <span class="small ms-4"> {{ session('error_message') }}</span>
                            </div>
                            @endif
                                
                                <div class="mb-3">
                                    <input class="form-control" id="exampleInputEmail1" type="text" name="username" required="" value="{{ session('username') }}" hidden>
                                    <br>
                                    <input class="form-control" id="exampleInputEmail1" type="password" name="password" required="" placeholder="*************">
                                </div>
                                <div class="row">
                                  <div class="col-md-5">
                                    <button class="btn btn-primary btn-login" type="submit"><i class="fas fa-unlock small"></i> Unlock</button>
                                  </div>
                                  <div class="col-md-7" style="padding-top: 30px">
                                    <p>Do you want to sign in with different account?<a class="ms-2" href="logout" style="text-decoration: underline"><b>Click Here</b></a></p>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-7 mt-4">
                                    <p class="mb-0 small">&copy;  <script>
                                      document.write(new Date().getFullYear())
                                    </script>.  IT Corporate, Lands Commission. </p>
                                  </div>
                                </div>
                            </form>
                          </div>
                      </div>
                  </div>   
          </div>
        </div>
      </div>
    </section>

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
     <!-- Plugins JS start-->
     <script src="assets/js/datepicker/date-picker/datepicker.js"></script>
     <script src="assets/js/datepicker/date-picker/datepicker.en.js"></script>
     <script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>
     <script src="assets/js/select2/select2.full.min.js"></script>
     <script src="assets/js/select2/select2-custom.js"></script>
     <script src="assets/js/form-validation-custom.js"></script>
     <script src="assets/js/task/custom.js"></script>
     <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
     <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
     <script src="assets/js/chart/apex-chart/chart-custom.js"></script>
     <script src="assets/js/scrollable/perfect-scrollbar.min.js"></script>
     <script src="assets/js/scrollable/scrollable-custom.js"></script>
     <script src="assets/js/editor/summernote/summernote.js"></script>
     <script src="assets/js/editor/summernote/summernote.custom.js"></script>
     <!-- Plugins JS Ends-->
     <!-- Theme js-->
     <script src="assets/js/script.js"></script>
     <!-- login js-->
     <!-- Plugin used-->
    <script src="js/app.js"></script>

    <!--DataTables JS Start-->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
  </body>
</html>