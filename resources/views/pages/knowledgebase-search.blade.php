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
                            <form method="POST" action="search_question" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                            @csrf
                            <div class="mb-n-4 m-form__group small">
                                <div class="input-group"><span class="input-group-text"><i  data-feather="search"></i></span>
                                    <input class="form-control" type="text" name="search" style="font-size: 13px" required="" placeholder="Search...">
                                </div>
                                <br>
                                <span class="text-secondary">{{ session()->get('total_search') }} result(s) found for keyword “{{ session()->get('keyword') }}”</span>
                            </div>
                            </form>
                          </div>
                          <div class="col-xl-3 text-end">
                            <a class="btn btn-small btn-danger" type="button" href="knowledgebase"><i class="fas fa-times-circle"></i></a>
                          </div>
                        </div>
                          {!! session()->get('search_div') !!}
                        <br>
                        <br>
                      </div>    
                    </div>
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-body">
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