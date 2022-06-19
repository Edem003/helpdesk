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
                      <div class="card">
                        <div class="card-header pb-0 d-flex mb-3">
                          <div class="col-xl-6">
                            <h6 class="text-warning">ALL QUESTIONS<span class="text-secondary small" style="font-size: 15px"> ({{ session()->get('total_count') }})</span></h6>
                          </div>
                          <div class="col-xl-6 text-end">
                            <button class="btn btn-small btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-question-circle small"></i> Ask Question</button>
                            <div class=" text-start modal fade modal-bookmark" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h6 class="modal-title  text-warning" id="exampleModalLabel">ASK A QUESTION</h6>
                                      <span class="text-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></span>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="ask_question" enctype="multipart/form-data" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                      @csrf
                                      <div class="mb-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Title<span class="text-danger">*</span></label>
                                        <input class="form-control" id="exampleInputEmail1" type="text" name="title" required="" placeholder="Your question title">
                                      </div>
                                      <div class="mb-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleInputEmail1" type="text" name="question" required="" style="height: 150px" placeholder="Please specify your question here"></textarea>
                                      </div>
                                      <div class="mb-4">
                                        <label for="sub-task">Attachment<span class="text-success"> (Optional)</span></label>
                                        <input class="form-control" type="file" name="attachment" accept="image/*" id="sub-task" autocomplete="off">
                                      </div>
                                      <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Category<span class="text-danger">*</span></label>
                                        <select class="form-control" name="category" required="">
                                          <option value="" disabled selected>-- select --</option>
                                          <option value="1">Hardware</option>
                                          <option value="2">Networking</option>
                                          <option value="3">Software</option>
                                          <option value="4">Desktop Support</option>
                                        </select>
                                      </div>
                                      <div class="mb-2">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="card-body post-about mt-n-5">
                          @if(session()->has('message'))
                          <div class="text-white alert alert-success dark alert-dismissible fade show mt-5" role="alert"><i data-feather="check-circle"></i>
                            <span class="small ms-4"> {{ session('message') }}</span>
                          </div>
                          @endif
                        </div>
                          {!! session()->get('question_div') !!}
                        <br>
                        <br>
                      </div>    
                    </div>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-body">
                      <form method="POST" action="search_question" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                      @csrf
                      <div class="mb-5 m-form__group small">
                        <div class="input-group"><span class="input-group-text"><i  data-feather="search"></i></span>
                          <input class="form-control" type="text" name="search" style="font-size: 13px" required="" placeholder="Search...">
                        </div>
                      </div>
                      </form>
                      <h6 class="small text-warning mb-3">MY ACTIVITY</h6>
                      <div class="chart-main activity-timeline update-line">
                        <a href="my_questions">
                          <div class="row small mb-2">
                            <div class="col-xl-1 me-n-2">
                              <span><i class="fas fa-arrow-circle-right"></i></span>
                            </div>
                            <div class="col-xl-11">
                              <span class="text-secondary">Questions</span>
                            </div>
                          </div>
                        </a>
                      </div>
                      <h6 class="small text-warning mb-3 mt-5">TRENDING QUESTIONS</h6>
                      <div class="chart-main activity-timeline update-line">
                        {!! session()->get('trending_question_div') !!}
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