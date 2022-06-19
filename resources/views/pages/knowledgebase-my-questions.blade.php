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
                            <h6 class="text-warning">MY QUESTIONS<span class="text-secondary small" style="font-size: 15px"> ({{ session()->get('my_total_count') }})</span></h6>
                          </div>
                          <div class="col-xl-3 text-end">
                            <a class="btn btn-small btn-danger" type="button" href="knowledgebase"><i class="fas fa-times-circle"></i></a>
                          </div>
                        </div>
                          {!! session()->get('my_question_div') !!}
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