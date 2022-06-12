   @extends('layouts.app')

   @section('content')
  
   <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-3 box-col-4 xl-30">
                  <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">Report Filter</a>
                    <div class="email-left-aside">
                      <div class="card">
                        <div class="card-body">
                          <div class="email-app-sidebar left-bookmark">
                            <h6 class="small mb-4 text-warning">GENERATE REPORT</h6>
                            <form method="POST" action="summary_report" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                            @csrf
                            <div class="form-group col-md-12">
                              <label for="sub-task">From<span class="text-danger">*</span></label>
                              <input class="datepicker-here form-control digits" type="text" name="from_date" data-language="en" required>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="sub-task">To<span class="text-danger">*</span></label>
                              <input class="datepicker-here form-control digits" type="text" name="to_date" data-language="en" required>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="sub-task">Department<span class="text-danger">*</span></label>
                              <select class="form-control" name="department_id" required="">
                                <option value="" disabled selected>-- select --</option>
                                <option value="2">Networking</option>
                                <option value="3">Software</option>
                                <option value="1">Hardware</option>
                                <option value="4">Desktop Support</option>
                              </select>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="sub-task">Division/Unit<span class="text-danger">*</span></label>
                              <select class="form-control" name="division_id" required="">
                                <option value="" disabled selected>-- select --</option>
                                <option value="1">LVD</option>
                                <option value="2">PVLMD</option>
                                <option value="4">SMD</option>
                                <option value="3">LRD</option>
                                <option value="5">IT Unit</option>
                                <option value="6">Audit Unit</option>
                              </select>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="sub-task">Region<span class="text-danger">*</span></label>
                              <select class="form-control" name="region_id" required="">
                                <option value="" disabled selected>-- select --</option>
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
                          </div>
                          <input id="index_var" type="hidden" value="6">
                          <button class="btn btn-primary-light btn-preview w-100" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-eye"></i> Preview</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-md-12 box-col-8 xl-70">
                  <div class="card mb-3">
                    <div class="card-header mb-0">
                      <div class="row">
                        <div class="col-xl-9">
                          <h6 class="mb-0 text-warning">REPORTS</h6>
                        </div>
                        <div class="col-xl-3 text-end">
                          <a class="f-w-600" href="javascript:void(0)" type="button" onclick="printDiv('printableArea')"><i class="fas fa-print me-2"></i>Print</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-xl-9">
                          @if(session()->has('print_errmsg'))
                          <div class="text-white alert alert-danger dark alert-dismissible fade show" role="alert"><i data-feather="alert-triangle"></i>
                            <span class="ms-4"> {{ session('print_errmsg') }}</span>
                          </div>
                          <br>
                          @endif
                        </div>
                      </div>
                      <div class="" id="printableArea">
                      <img class="mb-3" src="assets/images/lc_icon.jpg" style="width: 90px; height: 90px; display: block; margin-left: auto; margin-right: auto;">
                      <h6 class="text-center"><b>IT CORPORATE  - LANDS COMMISSION</b></h6>
                      <h6 class="text-center mb-5" style="font-weight: lighter;">TICKET REPORTS</h6>
                      <ul class="mb-3">
                        @if(session()->has('print_msg'))
                        <li><span><b>From:</b>  <span class="small">{{ session()->get('from_date') }}</span></span></li>
                        <li><span><b>To:</b>  <span class="small">{{ session()->get('to_date') }}</span></span></li>
                        <li><span><b>Department:</b>  <span class="small">{{ session()->get('department') }}</span></span></li>
                        <li><span><b>Division/Unit:</b>  <span class="small">{{ session()->get('division') }}</span></span></li>
                        <li><span><b>Region:</b>  <span class="small">{{ session()->get('region') }}</span></span></li>
                        @endif
                      </ul>
                        <div class="table-responsive">
                          <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                              <tr class="small">
                                <th>#</th>
                                <th>TID</th>
                                <th>COMPLAINANT</th>
                                <th>SUBJECT</th>
                                <th>PRIORITY</th>
                                <th>STATUS</th>
                                <th>DATE/TIME</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if(session()->has('print_msg'))
                                {!! session()->get('print_td') !!}
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
    </div>

    @endsection