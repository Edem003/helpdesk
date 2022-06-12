 @extends('layouts.app')

 @section('content')

 <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-3 box-col-4 xl-30">
                  <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">Task filter</a>
                    <div class="email-left-aside">
                      <div class="card">
                        <div class="card-body">
                          <div class="email-app-sidebar left-bookmark">
                            <ul class="nav main-menu" role="tablist">
                              <li>
                                @if(session()->has('update_ticket_message'))
                                <div class="text-white alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                                  <span class="small ms-4"> {{ session('update_ticket_message') }}</span>
                                </div>
                                <br>
                                @endif
                              </li>
                              <li><a id="pills-alltickets-tab" data-bs-toggle="pill" href="#pills-alltickets" role="tab" aria-controls="pills-alltickets" aria-selected="true"><span class="title text-secondary">Tickets to handle</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('t_handle_ticket_count') }}</span></a></li>
                              <li><a class="show" id="pills-myopentickets-tab" data-bs-toggle="pill" href="#pills-myopentickets" role="tab" aria-controls="pills-myopentickets" aria-selected="false"><span class="title text-secondary">My Open Tickets</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('t_open_ticket_count') }}</span></a></li>
                              <li><h6 class="small mb-1 mt-4 text-warning" style="padding-left:19px">STATUS</h6></li>
                              <li><a class="show" id="pills-pending-tab" data-bs-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-pending" aria-selected="false"><span class="title text-secondary">Pending</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('t_pending_ticket_count') }}</span></a></li>
                              <li><a class="show" id="pills-onhold-tab" data-bs-toggle="pill" href="#pills-onhold" role="tab" aria-controls="pills-onhold" aria-selected="false"><span class="title text-secondary">On Hold</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('t_on_hold_ticket_count') }}</span></a></li>
                              <li><a class="show" id="pills-solved-tab" data-bs-toggle="pill" href="#pills-solved" role="tab" aria-controls="pills-solved" aria-selected="false"><span class="title text-secondary">Solved</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('t_solved_ticket_count') }}</span></a></li>
                              <li><a class="show" id="pills-closed-tab" data-bs-toggle="pill" href="#pills-closed" role="tab" aria-controls="pills-closed" aria-selected="false"><span class="title text-secondary">Closed</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('t_closed_ticket_count') }}</span></a></li>
                              @if(session()->has('form'))
                              <li><a class="show" id="pills-form-tab" data-bs-toggle="pill" href="#pills-form" role="tab" aria-controls="pills-form" aria-selected="false"><span class="title text-danger"><i class="fas fa-hand-point-right me-2"></i>Complainant Form</span></a></li>
                              @endif
                              <li>
                                <div class="card card-body  m-t-15" style="border-radius: 5px;">
                                <div class="text-warning">
                                  <h6 class="small">PERFORMANCE</h6>
                                </div>
                                <div class="m-t-15">
                                  <div class="progress sm-progress-bar mb-1">
                                    @if(session()->get('t_performance_ticket_result') <= 30)
                                      @if(session()->get('t_closed_ticket_count') == 0 && session()->get('t_total_ticket_count') > 0)
                                      <div class="progress-bar bg-danger" role="progressbar" style="width: 2%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif(session()->get('t_closed_ticket_count') > 0)
                                      <div class="progress-bar bg-warning" role="progressbar" style="width: {{ session()->get('t_performance_ticket_result') }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif(session()->get('t_closed_ticket_count') == 0 && session()->get('t_total_ticket_count') == 0)
                                      <div class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                      @endif
                                    @endif
                                    @if((session()->get('t_performance_ticket_result') > 30) && (session()->get('t_performance_ticket_result') < 70))
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ session()->get('t_performance_ticket_result') }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                    @if(session()->get('t_performance_ticket_result') >= 70)
                                    <div class="progress-bar-animated progress-bar-striped bg-success" role="progressbar" style="width: {{ session()->get('t_performance_ticket_result') }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                  </div>
                                  @if(session()->get('t_total_ticket_count') == 0)
                                  <h6 class="small">No data...</h6>
                                  @else
                                  <h6 class="small">{{ session()->get('t_closed_ticket_count') }} of {{ session()->get('t_total_ticket_count') }} Task(s) Completed :: {{ round(session()->get('t_performance_ticket_result')) }}%</h6>
                                  @endif
                                </div>
                              </div>
                              </li>
                             </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-md-12 box-col-8 xl-70">
                  <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                      <div class="ps-0">
                        <div class="tab-content">
                          <div class="tab-pane fade active show" id="pills-alltickets" role="tabpanel" aria-labelledby="pills-alltickets-tab">
                            <div class="card mb-0">
                              <div class="card-header">
                                <h6 class="mb-0 text-warning">TICKETS TO HANDLE</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="handle_ticket" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th >PRIORITY</th>
                                          <th >STATUS</th>
                                          <th class="text-center">ACTION</th>
                                        </tr>
                                      </thead>
                                      <tbody class='small'>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-myopentickets" role="tabpanel" aria-labelledby="pills-myopentickets-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">MY OPEN TICKETS</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="myopen_ticket" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th>COMPLAINANT</th>
                                          <th>OFFICE</th>
                                          <th >PRIORITY</th>
                                          <th class="text-center">ACTION</th>
                                        </tr>
                                      </thead>
                                      <tbody class='small'>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">PENDING TICKETS</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="mypending_ticket" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th>COMPLAINANT</th>
                                          <th>OFFICE</th>
                                          <th >PRIORITY</th>
                                          <th class="text-center">ACTION</th>
                                        </tr>
                                      </thead>
                                      <tbody class='small'>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-onhold" role="tabpanel" aria-labelledby="pills-onhold-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">ON HOLD TICKETS</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="myonhold_ticket" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th>COMPLAINANT</th>
                                          <th>OFFICE</th>
                                          <th >PRIORITY</th>
                                          <th class="text-center">ACTION</th>
                                        </tr>
                                      </thead>
                                      <tbody class='small'>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-solved" role="tabpanel" aria-labelledby="pills-solved-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">SOLVED TICKETS</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="mysolved_ticket" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th>COMPLAINANT</th>
                                          <th>OFFICE</th>
                                          <th >PRIORITY</th>
                                          <th class="text-center">ACTION</th>
                                        </tr>
                                      </thead>
                                      <tbody class='small'>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-closed" role="tabpanel" aria-labelledby="pills-closed-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">CLOSED TICKETS</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="myclosed_ticket" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th>COMPLAINANT</th>
                                          <th>OFFICE</th>
                                          <th >PRIORITY</th>
                                          <th class="text-center">ACTION</th>
                                        </tr>
                                      </thead>
                                      <tbody class='small'>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-form" role="tabpanel" aria-labelledby="pills-form-tab">
                            <div class="card mb-0">
                              <div class="card-header">
                                <div class="row">
                                  <a class="end" href="javascript:void(0)" type="button" onclick="printDiv('printableArea')"><i class="fas fa-print me-2"></i>Print</a>
                                </div>
                              </div>
                              <div class="card-body" id="printableArea"> 
                                <div class="card">
                                  <div class="card-body small">
                                    <img class="mb-3" src="assets/images/lc_icon.jpg" style="width: 90px; height: 90px; display: block; margin-left: auto; margin-right: auto;">
                                    <h6 class="text-center"><b>IT CORPORATE  - LANDS COMMISSION</b></h6>
                                    <h6 class="text-center small mb-3" style="font-weight: lighter; font-size: 14px">COMPLAINANT FORM</h6>  
                                    <div class="text-center small mb-3">
                                      <div>{!! '<img style="background-color: #ffff" src="data:image/png;base64,' . DNS1D::getBarcodePNG(session()->get('ticket_id'), 'C39', true) . '" alt="barcode"   />'; !!}</div>
                                      <span>{{ session()->get('ticket_id') }}</span>  
                                    </div>
                                    {!! session()->get('complainant_form') !!}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
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