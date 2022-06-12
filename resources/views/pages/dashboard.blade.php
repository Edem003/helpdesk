@extends('layouts.app')

@section('content')

<div class="page-body">
<!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="email-wrap bookmark-wrap">
            <div class="row">
                <div class="col-xl-8">
                    <div class="row">
                      @if (session()->get('role') == 'Administrator')
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="open-ticket" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#93bdc6" value="{{ session()->get('open_perc') }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('open_ticket_count') }}</h6>
                              <p>Open</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="pending-ticket" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#ffc107" value="{{ session()->get('pending_perc') }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('pending_ticket_count') }}</h6>
                              <p>Pending</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="on-hold-ticket" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#dc3545" value="{{ session()->get('on_hold_perc') }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('on_hold_ticket_count') }}</h6>
                              <p>On-Hold</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="solved-ticket" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#24695c" value="{{ session()->get('solved_perc') }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('solved_ticket_count') }}</h6>
                              <p>Solved</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      @endif
                      @if (session()->get('role') !== 'Administrator')
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="tasks" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#ffc107" value="{{ session()->get('d_total_ticket_count') == 0 ? 0 : (session()->get('d_pending_ticket_count')/session()->get('d_total_ticket_count'))*100 }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('d_pending_ticket_count') }}</h6>
                              <p>Pending</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="tasks" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#dc3545" value="{{ session()->get('d_total_ticket_count') == 0 ? 0 : (session()->get('d_onhold_ticket_count')/session()->get('d_total_ticket_count'))*100 }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('d_onhold_ticket_count') }}</h6>
                              <p>On-Hold</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="tasks" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#24695c" value="{{ session()->get('d_total_ticket_count') == 0 ? 0 : (session()->get('d_solved_ticket_count')/session()->get('d_total_ticket_count'))*100 }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('d_solved_ticket_count') }}</h6>
                              <p>Solved</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      <div class="col-xl-3 col-sm-6 box-col-3 chart_data_right">
                      <a href="tasks" style="text-decoration: none;">
                        <div class="card income-card card-secondary">
                          <div class="card-body align-items-center">
                            <div class="round-progress text-center">
                              <div class="progress-circle">
                                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#ba895d" value="{{ session()->get('d_total_ticket_count') == 0 ? 0 : (session()->get('d_closed_ticket_count')/session()->get('d_total_ticket_count'))*100 }}">
                              </div>
                              <h6 class="counter text-secondary">{{ session()->get('d_closed_ticket_count') }}</h6>
                              <p>Closed</p>
                            </div>
                          </div>
                        </div>
                      </a>
                      </div>
                      @endif
                      @if (session()->get('role') == 'Administrator')
                      <div class="col-xl-12">
                        <div class="card">
                          <div class="card-body mb-n-4">
                            <h6 class="small text-warning">TEAM STATISTICS</h6>
                          </div>
                          <div id="column-chart-department"></div>
                        </div>    
                      </div>
                      @endif
                      <div class="col-xl-12">
                        <div class="card">
                          <div class="card-body mb-n-4">
                            <h6 class="small text-warning">MONTHLY SUMMARY</h6>
                          </div>
                          <div id="mixed-dept-chart"></div>
                        </div>    
                      </div>
                  </div>
                </div>
                <div class="col-xl-4">
                  @if (session()->get('role') == 'Administrator')
                  <div class="card">
                    <div class="card-body">
                      <h6 class="small text-warning mb-4">ACTIVITY TIMELINE</h6>
                      <div class="chart-main activity-timeline update-line">
                        {!! session()->get('ticket_logs_div') !!}
                      </div>
                    </div>
                  </div>
                  @endif
                  @if (session()->get('role') !== 'Administrator')
                  <div class="card">
                    <div class="card-body">
                      <h6 class="small text-warning mb-4">ACTIVITY TIMELINE</h6>
                      <div class="chart-main activity-timeline update-line">
                        {!! session()->get('myticket_logs_div') !!}
                      </div>
                    </div>
                  </div>
                  @endif
                  @if (session()->get('role') == 'Administrator')
                  <div class="card">
                    <div class="card-body">
                      <h6 class="small text-warning mb-4">STAFF PERFORMANCE</h6>
                      <div class="chart-main activity-timeline update-line">
                        {!! session()->get('performance_span') !!}
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
<!-- Container-fluid Ends-->
</div>

@endsection