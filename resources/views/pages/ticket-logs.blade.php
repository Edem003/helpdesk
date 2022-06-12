@extends('layouts.app')

@section('content')

<div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-3 box-col-4 xl-30">
                  <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">Ticket Logs Filter</a>
                    <div class="email-left-aside">
                      <div class="card">
                        <div class="card-body">
                          <div class="email-app-sidebar left-bookmark">
                            <ul class="nav main-menu" role="tablist">
                              <li><h6 class="small mb-1 mt-4 text-warning" style="padding-left:19px">REGIONS</h6></li>
                              <li><a id="pills-accra-tab" data-bs-toggle="pill" href="#pills-accra" role="tab" aria-controls="pills-accra" aria-selected="true"><span class="title text-secondary">Greater Accra</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('ticket_logs_ga_count') }}</span></a></li>
                              <li><a class="show" id="pills-eastern-tab" data-bs-toggle="pill" href="#pills-eastern" role="tab" aria-controls="pills-eastern" aria-selected="false"><span class="title text-secondary">Eastern</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-central-tab" data-bs-toggle="pill" href="#pills-central" role="tab" aria-controls="pills-central" aria-selected="false"><span class="title text-secondary">Central</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-ashanti-tab" data-bs-toggle="pill" href="#pills-ashanti" role="tab" aria-controls="pills-ashanti" aria-selected="false"><span class="title text-secondary">Ashanti</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-western-tab" data-bs-toggle="pill" href="#pills-western" role="tab" aria-controls="pills-western" aria-selected="false"><span class="title text-secondary">Western</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-westernnorth-tab" data-bs-toggle="pill" href="#pills-westernnorth" role="tab" aria-controls="pills-westernnorth" aria-selected="false"><span class="title text-secondary">Western North</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-volta-tab" data-bs-toggle="pill" href="#pills-volta" role="tab" aria-controls="pills-volta" aria-selected="false"><span class="title text-secondary">Volta</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-oti-tab" data-bs-toggle="pill" href="#pills-oti" role="tab" aria-controls="pills-oti" aria-selected="false"><span class="title text-secondary">Oti</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-bono-tab" data-bs-toggle="pill" href="#pills-bono" role="tab" aria-controls="pills-bono" aria-selected="false"><span class="title text-secondary">Bono</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-bonoeast-tab" data-bs-toggle="pill" href="#pills-bonoeast" role="tab" aria-controls="pills-bonoeast" aria-selected="false"><span class="title text-secondary">Bono-East</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-ahafo-tab" data-bs-toggle="pill" href="#pills-ahafo" role="tab" aria-controls="pills-ahafo" aria-selected="false"><span class="title text-secondary">Ahafo</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-savannah-tab" data-bs-toggle="pill" href="#pills-savannah" role="tab" aria-controls="pills-savannah" aria-selected="false"><span class="title text-secondary">Savannah</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-northern-tab" data-bs-toggle="pill" href="#pills-northern" role="tab" aria-controls="pills-northern" aria-selected="false"><span class="title text-secondary">Northern</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-northeast-tab" data-bs-toggle="pill" href="#pills-northeast" role="tab" aria-controls="pills-northeast" aria-selected="false"><span class="title text-secondary">North East</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-upperwest-tab" data-bs-toggle="pill" href="#pills-upperwest" role="tab" aria-controls="pills-upperwest" aria-selected="false"><span class="title text-secondary">Upper West</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li><a class="show" id="pills-uppereast-tab" data-bs-toggle="pill" href="#pills-uppereast" role="tab" aria-controls="pills-uppereast" aria-selected="false"><span class="title text-secondary">Upper East</span><span class="pull-right badge badge-light badge-pill">0</span></a></li>
                              <li>
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
                          <div class="tab-pane fade active show" id="pills-accra" role="tabpanel" aria-labelledby="pills-accra-tab">
                            <div class="card mb-0">
                              <div class="card-header">
                                <h6 class="mb-0 text-warning">TICKET LOGS - GREATER ACCRA</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="ticket_logs_ga" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>TID</th>
                                          <th>SUBJECT</th>
                                          <th>CREATED BY</th>
                                          <th>DATE/TIME</th>
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
                          <div class="fade tab-pane" id="pills-eastern" role="tabpanel" aria-labelledby="pills-eastern-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - EASTERN</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableea" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-central" role="tabpanel" aria-labelledby="pills-central-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - CENTRAL</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablece" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-ashanti" role="tabpanel" aria-labelledby="pills-ashanti-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - ASHANTI</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableas" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-western" role="tabpanel" aria-labelledby="pills-western-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - WESTERN</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablewe" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-westernnorth" role="tabpanel" aria-labelledby="pills-westernnorth-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - WESTERN NORTH</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablewn" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-volta" role="tabpanel" aria-labelledby="pills-volta-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - VOLTA</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablevo" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-oti" role="tabpanel" aria-labelledby="pills-oti-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - OTI</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableot" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-bono" role="tabpanel" aria-labelledby="pills-bono-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - BONO</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablebo" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-bonoeast" role="tabpanel" aria-labelledby="pills-bonoeast-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - BONO EAST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablebe" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-ahafo" role="tabpanel" aria-labelledby="pills-ahafo-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - AHAFO</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableah" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-savannah" role="tabpanel" aria-labelledby="pills-savannah-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - SAVANNAH</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablesa" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-northern" role="tabpanel" aria-labelledby="pills-northern-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - NORTHERN</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableno" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-northeast" role="tabpanel" aria-labelledby="pills-northeast-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - NORTH EAST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablene" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-upperwest" role="tabpanel" aria-labelledby="pills-upperwest-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - UPPER WEST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableuw" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-uppereast" role="tabpanel" aria-labelledby="pills-uppereast-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">TICKET LOGS - UPPER EAST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableue" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="small">
                                            <th>#</th>
                                            <th>TID</th>
                                            <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
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
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @endsection