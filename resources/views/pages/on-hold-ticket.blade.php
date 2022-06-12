@extends('layouts.app')

@section('content')

<div class="page-body">
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="email-wrap bookmark-wrap">
    <div class="row">
      <div class="col-xl-12 box-col-12 xl-120">
          <div class="card mb-0">
              <div class="card-header">
                <h6 class="mb-0 text-warning">ON-HOLD  TICKETS</h6>
              </div>
              <hr>
              <div class="card-body">
                <div class="row">
                <div class="col-xl-6">
                @if(session()->has('update_ticket_message'))
                <div class="text-white alert alert-success dark alert-dismissible fade show" role="alert"><i data-feather="check-circle"></i>
                  <span class="small ms-4"> {{ session('update_ticket_message') }}</span>
                </div>
                <br>
                @endif
                </div>
              </div>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="on_hold_ticket" width="100%" cellspacing="0">
                        <thead>
                          <tr class="small">
                            <th>#</th>
                            <th>TID</th>
                            <th>SUBJECT</th>
                            <th>COMPLAINANT</th>
                            <th>OFFICE</th>
                            <th>ASSIGNED TO</th>
                            <th>PRIORITY</th>
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
  </div>
</div>
<!-- Container-fluid Ends-->
</div>

@endsection