@extends('layouts.app')

@section('content')

<div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-secondary">
                        <div class="card-header pb-0 d-flex justify-content-center">
                            <div class="col-md-6">
                                <h6 class="text-warning">ADD NEW TICKET</h6>
                            </div>
                          </div>
                        <div class="card-body d-flex justify-content-center">
                          <form class="form-bookmark needs-validation col-md-6" method="POST" action="n_send_ticket" id="bookmark-form" novalidate="">
                          @csrf
                          @if(session()->has('send_ticket_message'))
                            <div class="text-white alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                              <span class="small ms-4"> {{ session('send_ticket_message') }}</span>
                            </div>
                            <br>
                            @endif
                                <div class="mb-3">
                                <input class="form-control" type="text" name="user_name" required="" value="{{ session('first_name') }} {{ session('surname') }}" autocomplete="off" hidden>
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
                                <div class="mb-0">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                                    <button class="btn btn-secondary" type="reset"><i class="fas fa-undo small"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @endsection