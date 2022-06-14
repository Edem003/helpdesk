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
                            <h6 class="text-warning">ALL QUESTIONS<span class="text-secondary small" style="font-size: 15px"> (53)</span></h6>
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
                                      <form method="POST" action="insert_user" class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                      @csrf
                                      <div class="mb-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Title<span class="text-danger">*</span></label>
                                        <input class="form-control" id="exampleInputEmail1" type="text" name="title" required="" placeholder="Your question title">
                                      </div>
                                      <div class="mb-4">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleInputEmail1" type="text" name="question" required="" style="height: 250px" placeholder="Please specify your question here"></textarea>
                                      </div>
                                      <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Category<span class="text-gray small"> (Optional)</span></label>
                                        <select class="form-control" name="priority_id" required="">
                                          <option value="" disabled selected>-- select --</option>
                                          <option value="1">Hardware</option>
                                          <option value="2">Networking</option>
                                          <option value="3">Software</option>
                                          <option value="4">Desktop Support</option>
                                        </select>
                                      </div>
                                      <div class="mb-3">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right small"></i> Submit</button>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>How to use Metronic with Django Framework?</h6>
                            <span class="text-secondary small">I’ve been doing some ajax request, to populate a inside drawer, the content of that drawer has a sub menu, that you are using in list and all card toolbar.</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-3 ms-n-3">
                                <h5 class="small">Jane Doe</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-06-10 15:08:60</p>
                              </div>
                              <div class="col-md-8 text-end small">
                                <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px">16 Answer(s)</button>
                                <a class="btn btn-light btn-sm text-secondary small" type="submit" href="/knowledgebase-details" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>When to expect new version of Laravel?</h6>
                            <span class="text-secondary small">When approx. is the next update for the Laravel version planned? Waiting for the CRUD, 2nd factor etc. features before starting my project. Also can we expect the Laravel + Vue version in the next update?</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-3 ms-n-3">
                                <h5 class="small">Mary Arthur</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-05-19 10:15:57</p>
                              </div>
                              <div class="col-md-8 text-end small">
                                <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px">5 Answer(s)</button>
                                <button class="btn btn-light btn-sm text-secondary small" type="submit" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>How to use Metronic with Django Framework?</h6>
                            <span class="text-secondary small">I’ve been doing some ajax request, to populate a inside drawer, the content of that drawer has a sub menu, that you are using in list and all card toolbar.</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-3 ms-n-3">
                                <h5 class="small">Jane Doe</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-06-10 15:08:60</p>
                              </div>
                              <div class="col-md-8 text-end small">
                                <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px">16 Answer(s)</button>
                                <button class="btn btn-light btn-sm text-secondary small" type="submit" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>When to expect new version of Laravel?</h6>
                            <span class="text-secondary small">When approx. is the next update for the Laravel version planned? Waiting for the CRUD, 2nd factor etc. features before starting my project. Also can we expect the Laravel + Vue version in the next update?</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-5 ms-n-3">
                                <h5 class="small">Mary Arthur</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-05-19 10:15:57</p>
                              </div>
                              <div class="col-md-6 text-end small">
                                <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px">5 Answer(s)</button>
                                <button class="btn btn-light btn-sm text-secondary small" type="submit" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>How to use Metronic with Django Framework?</h6>
                            <span class="text-secondary small">I’ve been doing some ajax request, to populate a inside drawer, the content of that drawer has a sub menu, that you are using in list and all card toolbar.</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-3 ms-n-3">
                                <h5 class="small">Jane Doe</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-06-10 15:08:60</p>
                              </div>
                              <div class="col-md-8 text-end small">
                                <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px">16 Answer(s)</button>
                                <button class="btn btn-light btn-sm text-secondary small" type="submit" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body post-about">
                          <div class="mb-n-4">
                            <h6>When to expect new version of Laravel?</h6>
                            <span class="text-secondary small">When approx. is the next update for the Laravel version planned? Waiting for the CRUD, 2nd factor etc. features before starting my project. Also can we expect the Laravel + Vue version in the next update?</span>
                            <div class="row mt-4">
                              <div class="col-md-1 me-n-4"><div class="icon text-center text-success" style="background-color: #e0f7ec; padding: 4px 2px 0px 2px; border-radius: 5px"><i data-feather="user"></i></div></div>
                              <div class="col-md-3 ms-n-3">
                                <h5 class="small">Mary Arthur</h5>
                                <p class="small mt-n-2" style="font-size: 10px">2021-05-19 10:15:57</p>
                              </div>
                              <div class="col-md-8 text-end small">
                                <button class="btn btn-outline-light btn-sm text-secondary" type="submit" style="font-size: 12px">5 Answer(s)</button>
                                <button class="btn btn-light btn-sm text-secondary small" type="submit" style="font-size: 12px"><i class="fas fa-comment-alt"></i> Reply</button>
                              </div>
                            </div>
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