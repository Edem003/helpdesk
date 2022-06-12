@extends('layouts.app')

@section('content')

<div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="mb-4 text-warning">MANAGE PROFILE</h6>
                                    <div class="row">
                                        <div class="col-xl-9">
                                            <span class="text-secondary mb-1">{{ session()->get('first_name') }} {{ session()->get('surname') }}</span><br>
                                            <span class="text-secondary mb-1">{{ session()->get('email') }}</span><br>
                                            <span class="text-secondary mb-1 small"><i class="fas fa-check-circle text-success"></i> Online</span><br>
                                            <a class="small text-info" href="#" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-picture" style="text-decoration: underline">Change picture</a>
                                            <div class="modal fade bd-example-modal-picture" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="text-warning small mb-3">CHANGE PICTURE</h6>
                                                        <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-danger"></i></a>
                                                    </div>
                                                    <div class="modal-body">                                    
                                                        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Select Image<span class="text-danger">*</span></label>
                                                                    <input class="form-control" type="file" accept="image/*" id="sub-task" type="" required="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <input id="index_var" type="hidden" value="6">
                                                            <button class="btn btn-primary btn-upload" type="submit"><i class="fas fa-upload small"></i> Upload</button>
                                                        </form>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <button class="btn btn-primary-light btn-sm w-100 mb-1" href="#" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-profile"><i class="fas fa-pen-alt"></i> Edit Profile</button>
                                            <div class="modal fade bd-example-modal-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="text-warning small mb-3">EDIT INFO</h6>
                                                        <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-danger"></i></a>
                                                    </div>
                                                    <div class="modal-body">                                    
                                                        <form class="form-bookmark needs-validation" method="POST" action="update_profile" id="bookmark-form" novalidate="">
                                                            @csrf
                                                            <input class="form-control" id="sub-task" type="text" required="" name="user_id" value="{{ session()->get('id') }}" hidden>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Firstname<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="sub-task" type="text" required="" name="first_name" value="{{ session()->get('first_name') }}" autocomplete="off">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Surname<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="sub-task" type="text" required="" name="surname" value="{{ session()->get('surname') }}" autocomplete="off">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Department<span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="department_id" required="">
                                                                        <option value="{{ session()->get('department') }}">{{ session()->get('department') }}</option>
                                                                        @if(session()->get('department') == 'Networking')
                                                                            <option value="Software">Software</option>
                                                                            <option value="Hardware">Hardware</option>
                                                                            <option value="Desktop Support">Desktop Support</option>
                                                                        @endif
                                                                        @if(session()->get('department') == 'Software')
                                                                            <option value="Networking">Networking</option>
                                                                            <option value="Hardware">Hardware</option>
                                                                            <option value="Desktop Support">Desktop Support</option>
                                                                        @endif
                                                                        @if(session()->get('department') == 'Hardware')
                                                                            <option value="Networking">Networking</option>
                                                                            <option value="Software">Software</option>
                                                                            <option value="Desktop Support">Desktop Support</option>
                                                                        @endif
                                                                        @if(session()->get('department') == 'Desktop Support')
                                                                            <option value="Networking">Networking</option>
                                                                            <option value="Software">Software</option>
                                                                            <option value="Hardware">Hardware</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Region<span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="region" required="">
                                                                        <option value="{{ session()->get('region') }}">{{ session()->get('region') }}</option>
                                                                        <option value="Greater Accra">Greater Accra</option>
                                                                        <option value="Eastern">Eastern</option>
                                                                        <option value="Ashanti">Ashanti</option>
                                                                        <option value="Central">Central</option>
                                                                        <option value="Volta">Volta</option>
                                                                        <option value="Oti">Oti</option>
                                                                        <option value="Western">Westen</option>
                                                                        <option value="Western North">Western North</option>
                                                                        <option value="Ahafo">Ahafo</option>
                                                                        <option value="Bono">Bono</option>
                                                                        <option value="Bono East">Bono East</option>
                                                                        <option value="Northern">Northern</option>
                                                                        <option value="North East">North East</option>
                                                                        <option value="Savannah">Savannah</option>
                                                                        <option value="Upper East">Upper East</option>
                                                                        <option value="Upper West">Upper West</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">E-mail</label>
                                                                    <input class="form-control" id="sub-task" type="email" name="email" value="{{ session()->get('email') }}" autocomplete="off">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Telephone<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="sub-task" type="tel" name="phone" required="" value="{{ session()->get('phone') }}" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <input id="index_var" type="hidden" value="6">
                                                            <button class="btn btn-primary btn-update" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-refresh small"></i> Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                            <button class="btn btn-primary-light btn-sm w-100 mb-1" href="#" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-password"><i class="fas fa-key"></i> Password</button>
                                            <div class="modal fade bd-example-modal-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="text-warning small mb-3">CHANGE PASSWORD</h6>
                                                        <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times text-danger"></i></a>
                                                    </div>
                                                    <div class="modal-body">                                    
                                                        <form class="form-bookmark needs-validation" method="POST" action="change_password" id="bookmark-form" id="bookmark-form" novalidate="">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Current Password<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="sub-task" type="password" name="c_pass" required="" minlength="8" autocomplete="off">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">New Password<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="sub-task" type="password" name="n_pass" required="" minlength="8" autocomplete="off">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="sub-task">Confirm Password<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="sub-task" type="password" name="cf_pass" required="" minlength="8" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <input id="index_var" type="hidden" value="6">
                                                            <button class="btn btn-primary btn-update" id="Bookmark" onclick="submitBookMark()" type="submit"><i class="fas fa-refresh small"></i> Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                <h6 class="mb-3 text-warning small">PROFILE DETAILS</h6>
                                    <div class="row">
                                        <div class="col-xl-8">
                                        @if(session()->has('update_profile'))
                                            <div class="text-white alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                                                <span class="small ms-4"> {{ session('update_profile') }}</span>
                                            </div>
                                            <br>
                                        @endif
                                        @if(session()->has('error_message'))
                                            <div class="text-white alert alert-danger dark alert-dismissible fade show" role="alert"><i data-feather="alert-triangle"></i>
                                                <span class="small ms-4"> {{ session('error_message') }}</span>
                                            </div>
                                            <br>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>Username: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('username') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>Name: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('first_name') }} {{ session()->get('surname') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>Role: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('role') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>Department: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('department') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>Region: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('region') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>E-Mail: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('email') }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <span class="text-secondary small"><b>Telephone: </b></span>
                                        </div>
                                        <div class="col-md-10">
                                        <span class="text-secondary">{{ session()->get('phone') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                  <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="mb-4 text-warning small">USER LOGS</h6>
                        <div class="row mb-2">
                            <div class="col-md-5">
                            <span class="text-secondary mb-1 small"><i class="fas fa-check-circle text-success"></i> Success</span><br>
                            </div>
                            <div class="col-md-4">
                                <div class="progress sm-progress-bar mt-2">
                                    <div class="progress-bar-animated progress-bar-striped bg-success" role="progressbar" style="width: {{ session()->get('success_logs_percentage') }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="text-secondary">{{ session()->get('success_logs_count') }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <span class="text-secondary mb-1 small"><i class="fas fa-times-circle text-danger"></i> Failed</span><br>
                            </div>
                            <div class="col-md-4">
                                <div class="progress sm-progress-bar mt-2">
                                    <div class="progress-bar-animated progress-bar-striped bg-danger" role="progressbar" style="width: {{ session()->get('failed_logs_percentage') }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <span class="text-secondary">{{ session()->get('failed_logs_count') }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="column-chart-login"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
    </div>

@endsection