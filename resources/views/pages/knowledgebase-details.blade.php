@extends('layouts.app')

@section('content')

<div class="page-body">
<!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="email-wrap bookmark-wrap">
            <div class="row">
              <div class="col-xl-7">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-header pb-0 d-flex mb-3">
                          <div class="col-xl-6">
                            <h6 class="text-warning">PUBLIC QUESTION</h6>
                          </div>
                          <div class="col-xl-6 text-end">
                            <button class="btn btn-small btn-primary" type="button" onclick="history.back()"><i class="fas fa-arrow-circle-left small"></i> Go Back</button>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>How to use Metronic with Django Framework?</h6>
                            <span class="text-secondary small">I’ve been doing some ajax request, to populate a inside drawer, the content of that drawer has a sub menu, that you are using in list and all card toolbar.</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-11 ms-n-3">
                                <h5 class="small">Jane Doe</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-06-10 15:08:60</p>
                              </div>
                            </div>
                            <div class="mb-4 mt-5">
                                <textarea class="form-control" id="exampleInputEmail1" type="text" name="question" required="" style="height: 150px" placeholder="Please specify your question here"></textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                            </div>
                            <h6 class="mb-4 mt-5">REPLIES <span class="text-secondary">(3)</span></h6>
                          </div>
                        </div>
                        <br><br>
                      </div>    
                    </div>
                  </div>
                </div>
                <div class="col-xl-5">
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-5 m-form__group small">
                        <div class="input-group"><span class="input-group-text"><i  data-feather="search"></i></span>
                          <input class="form-control" type="text" style="font-size: 13px" placeholder="Search...">
                        </div>
                      </div>
                      <h6 class="small text-warning mb-4">TRENDING QUESTIONS</h6>
                      <div class="chart-main activity-timeline update-line">
                        <a href="">
                          <div class="row small mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-arrow-circle-right"></i></span>
                            </div>
                            <div class="col-xl-11">
                              <span class="text-secondary">How to use Metrponic with Django Framework?</span>
                            </div>
                          </div>
                        </a>
                        <a href="">
                          <div class="row small mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-arrow-circle-right"></i></span>
                            </div>
                            <div class="col-xl-11">
                              <span class="text-secondary">When to expect new version of Metronic Laravel?</span>
                            </div>
                          </div>
                        </a>
                        <a href="">
                          <div class="row small mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-arrow-circle-right"></i></span>
                            </div>
                            <div class="col-xl-11">
                              <span class="text-secondary">Could not get Metronic Demo 7 working</span>
                            </div>
                          </div>
                        </a>
                        <a href="">
                          <div class="row small mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-arrow-circle-right"></i></span>
                            </div>
                            <div class="col-xl-11">
                              <span class="text-secondary">How to use Metrponic with Django Framework?</span>
                            </div>
                          </div>
                        </a>
                        <a href="">
                          <div class="row small mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-arrow-circle-right"></i></span>
                            </div>
                            <div class="col-xl-11">
                              <span class="text-secondary">When to expect new version of Metronic Laravel?</span>
                            </div>
                          </div>
                        </a>
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