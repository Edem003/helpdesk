@extends('layouts.app')

@section('content')

<div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-3 box-col-4 xl-30">
                  <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">Staff Filter</a>
                    <div class="email-left-aside">
                      <div class="card">
                        <div class="card-body">
                          <div class="email-app-sidebar left-bookmark">
                            <ul class="nav main-menu" role="tablist">
                              <li class="nav-item">
                                <button class="badge-light btn-block btn-mail" type="button" data-bs-toggle="modal" data-bs-target="#addModal"><i class="me-2" data-feather="user-plus"></i>Add New Staff</button>
                                <div class="modal fade modal-bookmark" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h6 class="modal-title  text-warning" id="exampleModalLabel">ADD NEW  STAFF</h6>
                                        <span class="text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></span>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="insert_user" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                        @csrf
                                          <div class="form-row">
                                              <div class="form-group col-md-12">
                                                <label for="sub-task">Username<span class="text-danger">*</span></label>
                                                <input class="form-control" id="sub-task" type="text" name="username" required="" autocomplete="off">
                                              </div>
                                              <label for="task-title">Full Name<span class="text-danger">*</span></label>
                                              <div class="row">
                                                <div class="form-group col">
                                                  <input class="form-control" id="task-title" type="text" name="first_name" required="" placeholder="First Name" autocomplete="off">
                                                </div>
                                                <div class="form-group col">
                                                  <input class="form-control" id="task-title" type="text" name="surname" required="" placeholder="Surname" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                              <label for="sub-task">Department<span class="text-danger">*</span></label>
                                              <select class="form-control" name="department" required="">
                                                <option value="" disabled selected>-- select --</option>
                                                <option value="2">Networking</option>
                                                <option value="3">Software</option>
                                                <option value="1">Hardware</option>
                                                <option value="4">Desktop Support</option>
                                            </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                              <label for="sub-task">Role<span class="text-danger">*</span></label>
                                              <select class="form-control" name="role" required="">
                                                <option value="" disabled selected>-- select --</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Staff">Staff</option>
                                                <option value="National Service Personnel">National Service Personnel</option>
                                            </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                              <label for="sub-task">Region<span class="text-danger">*</span></label>
                                              <select class="form-control" name="region" required="">
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
                                            <div class="form-group col-md-12">
                                              <label for="sub-task">E-mail</label>
                                              <input class="form-control" id="sub-task" type="email" name="email" placeholder="user@example.com" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-12">
                                              <label for="sub-task">Telephone<span class="text-danger">*</span></label>
                                              <input class="form-control" id="sub-task" type="tel" name="phone" required="" placeholder="+233..." autocomplete="off">
                                            </div>
                                          </div>
                                          <input id="index_var" type="hidden" value="6">
                                          <button class="btn btn-primary btn-save" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-save small"></i> Save</button>
                                          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal"><i class="fas fa-times small"></i> Cancel</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                              <li>
                                @if(session()->has('add_user'))
                                <div class="text-white alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                                  <span class="small ms-4"> {{ session('add_user') }}</span>
                                </div>
                                <br>
                                @endif
                                @if(session()->has('update_user'))
                                <div class="text-white alert alert-warning dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                                  <span class="small ms-4"> {{ session('update_user') }}</span>
                                </div>
                                <br>
                                @endif
                              </li>
                              <li><h6 class="small mb-1 text-warning" style="padding-left:19px">DEPARTMENTS</h6></li>
                              @if (session()->get('role') == 'Administrator')
                              <li><a id="pills-desktopsupport-tab" data-bs-toggle="pill" href="#pills-desktopsupport" role="tab" aria-controls="pills-desktopsupport" aria-selected="true"><span class="title text-secondary">Desktop Support</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('desktop_support_count') }}</span></a></li>
                              <li><a class="show" id="pills-software-tab" data-bs-toggle="pill" href="#pills-software" role="tab" aria-controls="pills-software" aria-selected="false"><span class="title text-secondary">Software</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('software_count') }}</span></a></li>
                              <li><a class="show" id="pills-hardware-tab" data-bs-toggle="pill" href="#pills-hardware" role="tab" aria-controls="pills-hardware" aria-selected="false"><span class="title text-secondary">Hardware</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('hardware_count') }}</span></a></li>
                              <li><a class="show" id="pills-networking-tab" data-bs-toggle="pill" href="#pills-networking" role="tab" aria-controls="pills-networking" aria-selected="false"><span class="title text-secondary">Networking</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('networking_count') }}</span></a></li>
                              @endif
                              @if (session()->get('role') == 'Super Administrator')
                              <li><a id="pills-desktopsupport-tab" data-bs-toggle="pill" href="#pills-desktopsupport" role="tab" aria-controls="pills-desktopsupport" aria-selected="true"><span class="title text-secondary">Desktop Support</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('desktop_support_count_sa') }}</span></a></li>
                              <li><a class="show" id="pills-software-tab" data-bs-toggle="pill" href="#pills-software" role="tab" aria-controls="pills-software" aria-selected="false"><span class="title text-secondary">Software</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('software_count_sa') }}</span></a></li>
                              <li><a class="show" id="pills-hardware-tab" data-bs-toggle="pill" href="#pills-hardware" role="tab" aria-controls="pills-hardware" aria-selected="false"><span class="title text-secondary">Hardware</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('hardware_count_sa') }}</span></a></li>
                              <li><a class="show" id="pills-networking-tab" data-bs-toggle="pill" href="#pills-networking" role="tab" aria-controls="pills-networking" aria-selected="false"><span class="title text-secondary">Networking</span><span class="pull-right badge badge-light badge-pill">{{ session()->get('networking_count_sa') }}</span></a></li>
                              @endif
                              <!--li><h6 class="small mb-1 mt-4 text-warning" style="padding-left:19px">OFFICES</h6></li>
                              <li><a class="show" id="pills-accra-tab" data-bs-toggle="pill" href="#pills-accra" role="tab" aria-controls="pills-accra" aria-selected="false"><span class="title text-secondary">Greater Accra</span><span class="pull-right badge badge-light badge-pill">9</span></a></li>
                              <li><a class="show" id="pills-eastern-tab" data-bs-toggle="pill" href="#pills-eastern" role="tab" aria-controls="pills-eastern" aria-selected="false"><span class="title text-secondary">Eastern</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-central-tab" data-bs-toggle="pill" href="#pills-central" role="tab" aria-controls="pills-central" aria-selected="false"><span class="title text-secondary">Central</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-ashanti-tab" data-bs-toggle="pill" href="#pills-ashanti" role="tab" aria-controls="pills-ashanti" aria-selected="false"><span class="title text-secondary">Ashanti</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-western-tab" data-bs-toggle="pill" href="#pills-western" role="tab" aria-controls="pills-western" aria-selected="false"><span class="title text-secondary">Western</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-westernnorth-tab" data-bs-toggle="pill" href="#pills-westennorth" role="tab" aria-controls="pills-westernnorth" aria-selected="false"><span class="title text-secondary">Western North</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-volta-tab" data-bs-toggle="pill" href="#pills-volta" role="tab" aria-controls="pills-volta" aria-selected="false"><span class="title text-secondary">Volta</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-oti-tab" data-bs-toggle="pill" href="#pills-oti" role="tab" aria-controls="pills-oti" aria-selected="false"><span class="title text-secondary">Oti</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-bono-tab" data-bs-toggle="pill" href="#pills-bono" role="tab" aria-controls="pills-bono" aria-selected="false"><span class="title text-secondary">Bono</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-bonoeast-tab" data-bs-toggle="pill" href="#pills-bonoeast" role="tab" aria-controls="pills-bonoeast" aria-selected="false"><span class="title text-secondary">Bono-East</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-ahafo-tab" data-bs-toggle="pill" href="#pills-ahafo" role="tab" aria-controls="pills-ahafo" aria-selected="false"><span class="title text-secondary">Ahafo</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-savannah-tab" data-bs-toggle="pill" href="#pills-savannah" role="tab" aria-controls="pills-savannah" aria-selected="false"><span class="title text-secondary">Savannah</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-northern-tab" data-bs-toggle="pill" href="#pills-northern" role="tab" aria-controls="pills-northern" aria-selected="false"><span class="title text-secondary">Northern</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-northeast-tab" data-bs-toggle="pill" href="#pills-northeast" role="tab" aria-controls="pills-northeast" aria-selected="false"><span class="title text-secondary">North East</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-upperwest-tab" data-bs-toggle="pill" href="#pills-upperwest" role="tab" aria-controls="pills-upperwest" aria-selected="false"><span class="title text-secondary">Upper West</span><span class="pull-right badge badge-light badge-pill">3</span></a></li>
                              <li><a class="show" id="pills-uppereast-tab" data-bs-toggle="pill" href="#pills-uppereast" role="tab" aria-controls="pills-uppereast" aria-selected="false"><span class="title text-secondary">Upper East</span><span class="pull-right badge badge-light badge-pill">3</span></a></li-->
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
                          <div class="tab-pane fade active show" id="pills-desktopsupport" role="tabpanel" aria-labelledby="pills-desktopsupport-tab">
                            <div class="card mb-0">
                              <div class="card-header">
                                <h6 class="mb-0 text-warning">DESKTOP SUPPORT</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="desk_support_users" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-software" role="tabpanel" aria-labelledby="pills-software-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">SOFTWARE</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="software_users" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-hardware" role="tabpanel" aria-labelledby="pills-hardware-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">HARDWARE</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="hardware_users" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-networking" role="tabpanel" aria-labelledby="pills-networking-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">NETWORKING</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="networking_users" width="100%" cellspacing="0">
                                      <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-accra" role="tabpanel" aria-labelledby="pills-accra-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">GREATER ACCRA</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablega" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-eastern" role="tabpanel" aria-labelledby="pills-eastern-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">EASTERN</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableea" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-central" role="tabpanel" aria-labelledby="pills-central-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">CENTRAL</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablece" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
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
                          <div class="fade tab-pane" id="pills-ashanti" role="tabpanel" aria-labelledby="pills-ashanti-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0 text-warning">ASHANTI</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableas" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">WESTERN</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablewe" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">WESTERN NORTH</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablewn" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">VOLTA</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablevo" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">OTI</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableot" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">BONO</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablebo" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">BONO EAST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablebe" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">AHAFO</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableah" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">SAVANNAH</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablesa" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">NORTHERN</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableno" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">NORTH EAST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTablene" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">UPPER WEST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableuw" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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
                                <h6 class="mb-0 text-warning">UPPER EAST</h6>
                              </div>
                              <div class="card-body">
                                <div class="">
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTableue" width="100%" cellspacing="0">
                                        <thead>
                                        <tr class="small">
                                          <th>#</th>
                                          <th>NAME</th>
                                          <th>DEPARTMENT</th>
                                          <th>ROLE</th>
                                          <th>REGION</th>
                                          <th class="text-center">ACTION</th>
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