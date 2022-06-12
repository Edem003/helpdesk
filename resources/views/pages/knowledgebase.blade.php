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
                          <div class="card-body mb-n-4">
                            <h6 class="small text-warning">ASK A PUBLIC QUESTION</h6>
                          </div>

                        </div>    
                      </div>
                  </div>
                </div>
                <div class="col-xl-5">
                <div class="card">
                  <div class="card-body">
                    <div class="default-according style-1" id="accordionoc">
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="mb-0">
                            <button class="btn btn-link text-white" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapse11"><i class="icofont icofont-briefcase-alt-2"></i> Collapsible Group Item #<span>1</span></button>
                          </h5>
                        </div>
                        <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordionoc">
                          <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#collapseicon1" aria-expanded="false"><i class="icofont icofont-support"></i> Collapsible Group Item #<span>2</span></button>
                          </h5>
                        </div>
                        <div class="collapse" id="collapseicon1" aria-labelledby="headingeight" data-bs-parent="#accordionoc">
                          <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h6 class="mb-0 small">
                            <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="false" aria-controls="collapseicon2">TEAM STATISTICS</button>
                          </h6>
                        </div>
                        <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                          <div class="card-body">
                            <span class="small mb-4">This is based on questions published per department.</span>
                            <br><br><br>
                            <div id="column-chart-department"></div>
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