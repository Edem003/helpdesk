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
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

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
        var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-fw"></i> Logging...</span>';
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

    <script>
      $(document).ready(function() {
      $('.btn-submit').on('click', function() {
        var $this = $(this);
        var loadingText = '<span class="small"><i class="fa fa-spinner fa-spin fa-fw"></i> Submitting...</span>';
        if ($(this).html() !== loadingText) {
          $this.data('original-text', $(this).html());
          $this.html(loadingText);
        }
        setTimeout(function() {
          $this.html($this.data('original-text'));
        }, 5000);
      });
    })
    </script>

    <script>
      $(document).ready(function() {
      $('.btn-reset').on('click', function() {
        var $this = $(this);
        var loadingText = '<span class="small"><i class="fa fa-undo fa-spin fa-bw"></i> Resetting...</span>';
        if ($(this).html() !== loadingText) {
          $this.data('original-text', $(this).html());
          $this.html(loadingText);
        }
        setTimeout(function() {
          $this.html($this.data('original-text'));
        }, 500);
      });
    })
    </script>

  </head>

  <!-- Loader ends-->
<!-- page-wrapper Start-->
  <body class="custom-scrollbar" style="font-family: SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; background-color: #e9ecec;">
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <section>
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-xl-4" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;"><img class="bg-img-cover" src="assets/images/index.gif" alt="loginpage"></div>
          <div class="col-xl-8 p-4">
          <div class="row justify-content-center" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
                  <div class="col-xl-10">
                      <div class="card shadow">
                          <div class="card-body d-flex justify-content-center">
                          <form class="form-bookmark needs-validation col-md-10" method="POST" action="w_send_ticket" id="bookmark-form" novalidate="">
                          @csrf
                            <h6>WELCOME TO IT HELPDESK!!</h6>
                            <p class="">Do you have any issue? Lodge a complaint in the form below.</p>
                            <br>
                            @if(session()->has('send_ticket_message'))
                            <div class="text-white alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                              <span class="small ms-4"> {{ session('send_ticket_message') }}</span>
                            </div>
                            <br>
                            @endif
                                <div class="mb-3">
                                  <label class="col-form-label pt-0" for="exampleInputPassword1">Complainant<span class="text-danger">*</span></label>
                                  <div class="row row-cols-sm-2 theme-form form-bottom">
                                    <div class="d-flex mb-3">
                                      <input class="form-control" type="text" name="complainant_name" required="" placeholder="Name" autocomplete="off">
                                    </div>
                                    <div class="d-flex mb-3">
                                      <input class="form-control" id="inputUnlabelPassword" type="tel" name="complainant_number" required="" placeholder="Telephone">
                                    </div>
                                  </div>
                                  <div class="row row-cols-sm-2 theme-form form-bottom">
                                    <div class="d-flex mb-3">
                                        <select class="form-control" name="division_id" required="">
                                            <option value="" disabled selected>-- division/unit --</option>
                                            <option value="1">LVD</option>
                                            <option value="2">PVLMD</option>
                                            <option value="4">SMD</option>
                                            <option value="3">LRD</option>
                                            <option value="5">IT Unit</option>
                                            <option value="6">Audit Unit</option>
                                        </select>
                                    </div>
                                    <div class="d-flex mb-3">
                                      <input class="form-control" id="inputUnlabelPassword" type="tel" name="complainant_office" required="" placeholder="Office">
                                    </div>
                                  </div>
                                  <div class="row row-cols-sm-2 theme-form form-bottom">
                                    <div class="d-flex">
                                        <select class="form-control" name="region_id" required="">
                                            <option value="" disabled selected>-- select region --</option>
                                            <option value="1">Greater  Accra</option>
                                            <option value="2">Eastern</option>
                                            <option value="3">Ashanti</option>
                                            <option value="16">Central</option>
                                            <option value="4">Western</option>
                                            <option value="7">Western  North</option>
                                            <option value="5">Volta</option>
                                            <option value="6">Oti</option>
                                            <option value="8">Bono</option>
                                            <option value="9">Bono East</option>
                                            <option value="10">Ahafo</option>
                                            <option value="11">Savannah</option>
                                            <option value="12">Northern</option>
                                            <option value="13">North East</option>
                                            <option value="14">Upper East</option>
                                            <option value="15">Upper West</option>
                                        </select>
                                    </div>
                                    <div class="d-flex">
                                      
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-3">
                                  <label class="col-form-label pt-0" for="exampleInputEmail1">Subject<span class="text-danger">*</span></label>
                                  <input class="form-control" id="exampleInputEmail1" type="text" name="subject" required="" placeholder="Subject">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" type="text" name="details" placeholder="Please enter further details here."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Priority<span class="text-danger">*</span></label>
                                    <select class="form-control" name="priority_id" required="">
                                        <option value="" disabled selected>-- select --</option>
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">High</option>
                                        <option value="4">Urgent</option>
                                    </select>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <button class="btn btn-primary btn-submit" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                                    <button class="btn btn-secondary btn-reset" type="reset"><i class="fas fa-undo small"></i> Reset</button>
                                  </div>
                                  <div class="col-md-6" style="padding-top: 30px">
                                    <p>Do you have an account?<a class="ms-2" href="#" data-bs-toggle="modal" data-bs-target=".bd-example-modal-login" style="text-decoration: underline"><b>Login Here</b></a></p>
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

    <div class="modal fade bd-example-modal-login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content modal-dialog-centered">
              <div class="modal-body">                                    
                  <form method="POST" action="login" class="form-bookmark needs-validation" novalidate="">
                  @csrf
                      <h6>LOGIN</h6>
                      <h6 class="small">Welcome back! Login to your account.</h6>
                      @if(session()->has('error_message'))
                        <div class="text-white alert alert-danger dark alert-dismissible fade show" role="alert"><i data-feather="alert-triangle"></i>
                        <span class="small"> {{ session('error_message') }}</span>
                        </div>
                      @endif
                      <br>
                      <div class="form-group">
                      <label>Username<span class="text-danger">*</span></label>
                      <div class="input-group"><span class="input-group-text"><i class="fas fa-user small"></i></span>
                          <input class="form-control" type="text" name="username" required="" placeholder="">
                      </div>
                      </div>
                      <div class="form-group">
                      <label>Password<span class="text-danger">*</span></label>
                      <div class="input-group"><span class="input-group-text"><i class="fas fa-lock small"></i></span>
                          <input class="form-control" type="password" name="password" required="" placeholder="*********">
                          <div class="show-hide"><span class="show">                         </span></div>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="animate-chk">
                          <input class="checkbox_animated" id="chk-ani" type="checkbox" name="remember_me">
                          <label class="text-muted" for="checkbox1" name="remember">Remember password</label>
                      </div>
                      </div>
                      <div class="form-group">
                        <input id="index_var" type="hidden" value="6">
                        <button class="btn btn-primary btn-login w-100"><i class="fas fa-sign-in-alt small"></i> Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>

    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
     <!-- feather icon js-->
     <script src="assets/js/icons/feather-icon/feather.min.js"></script>
     <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
     <!-- Sidebar jquery-->
     <script src="assets/js/config.js"></script>
     <!-- Bootstrap js-->
     <script src="assets/js/bootstrap/popper.min.js"></script>
     <script src="assets/js/bootstrap/bootstrap.min.js"></script>
     <!-- Plugins JS start-->
     <script src="assets/js/form-validation-custom.js"></script>
     <!-- Plugins JS Ends-->
     <!-- Theme js-->
     <script src="assets/js/script.js"></script>
     <!-- login js--> 
     <!-- Plugin used-->
    <script src="js/app.js"></script>
    
  </body>
</html>