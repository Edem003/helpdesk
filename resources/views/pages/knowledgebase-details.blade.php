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
                          <div class="col-xl-9">
                            <h6 class="text-warning">PUBLIC QUESTION</h6>
                          </div>
                          <div class="col-xl-3 text-end">
                            <button class="btn btn-small btn-primary" type="button" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i></button>
                          </div>
                        </div>
                        <div class="gallery my-gallery card-body post-about row" itemscope="">
                          <div class="mb-n-4">
                            {!! session()->get('question_details_div') !!}
                            @if(session()->has('message'))
                            <div class="text-white alert alert-success dark alert-dismissible fade show mt-3" role="alert"><i data-feather="check-circle"></i>
                              <span class="small ms-4"> {{ session('message') }}</span>
                            </div>
                            @endif
                            <form method="POST" action="reply_question" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                             @csrf
                            <div class="mb-3 mt-5">
                                <textarea class="form-control" id="exampleInputEmail1" type="text" name="answer" required="" style="height: 150px" placeholder="Your reply here" required=""></textarea>
                            </div>
                            <div class="mb-0">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                            </div>
                            </form>
                            <h6 class="mb-4 mt-5">ANSWERS <span class="text-secondary">({{ session()->get('total_answer_count') }})</span></h6>
                            <div class="chat-history chat-msg-box custom-scrollbar small">
                             {!! session()->get('answers_div') !!}
                            </div>
                          </div>
                        </div>
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
                        <div class="job-filter">
                          <div class="faq-form">
                            <input class="form-control" type="text" name="search" style="font-size: 13px" required="" placeholder="Search.."><i class="search-icon" data-feather="search"></i>
                          </div>
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
                      <h6 class="small text-warning mb-3 mt-5">POPULAR QUESTIONS</h6>
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