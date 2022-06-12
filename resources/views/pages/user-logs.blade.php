@extends('layouts.app')

@section('content')

<div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-3">
                            <h6 class="text-warning mb-0">USER LOGS LIST</h6>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user_logs" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="small">
                                            <th>#</th>
                                            <th>USERNAME</th>
                                            <th>IP ADDRESS</th>
                                            <th>LOGIN DATE/TIME</th>
                                            <th>LOGOUT DATE/TIME</th>
                                            <th>STATUS</th>
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