<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class JsonController extends Controller
{
    public function get_dashboard_json(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        
        $user_id = $request->session()->get('id');

        $status_response = $http->get('http://localhost:8080/helpdeskApi/rest/tickets_service/status_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]); 

        $status_result = json_decode((string)$status_response->getBody(),true);

        //status count
        $open_ticket_count = $status_result['open_count'];
        $pending_ticket_count = $status_result['pending_count'];
        $on_hold_ticket_count = $status_result['on_hold_count'];
        $solved_ticket_count = $status_result['solved_count'];
        $closed_ticket_count = $status_result['closed_count'];

        //status percentage
        $open_perc = round($status_result['open_percentage'][0]['open_percentage']);
        $pending_perc = round($status_result['pending_percentage'][0]['pending_percentage']);
        $on_hold_perc = round($status_result['on_hold_percentage'][0]['on_hold_percentage']);
        $solved_perc = round($status_result['solved_percentage'][0]['solved_percentage']);
        $closed_perc = round($status_result['closed_percentage'][0]['closed_percentage']);

        //getting status count into session
        $request->session()->put('open_ticket_count',$open_ticket_count);
        $request->session()->put('pending_ticket_count',$pending_ticket_count);
        $request->session()->put('on_hold_ticket_count',$on_hold_ticket_count);
        $request->session()->put('solved_ticket_count',$solved_ticket_count);
        $request->session()->put('closed_ticket_count',$closed_ticket_count);

        //getting status percentage into session
        $request->session()->put('open_perc',$open_perc);
        $request->session()->put('pending_perc',$pending_perc);
        $request->session()->put('on_hold_perc',$on_hold_perc);
        $request->session()->put('solved_perc',$solved_perc);
        $request->session()->put('closed_perc',$closed_perc);


        $dept_count = $http->get('http://localhost:8080/helpdeskApi/rest/tickets_service/dept_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]); 

        $dept_count_result = json_decode((string)$dept_count->getBody(),true);

        $h_pending_ticket_count = $dept_count_result['hardware_pending_count'];
        $h_on_hold_ticket_count = $dept_count_result['hardware_on_hold_count'];
        $h_solved_ticket_count = $dept_count_result['hardware_solved_count'];
        $h_closed_ticket_count = $dept_count_result['hardware_closed_count'];
        $n_pending_ticket_count = $dept_count_result['networking_pending_count'];
        $n_on_hold_ticket_count = $dept_count_result['networking_on_hold_count'];
        $n_solved_ticket_count = $dept_count_result['networking_solved_count'];
        $n_closed_ticket_count = $dept_count_result['networking_closed_count'];
        $s_pending_ticket_count = $dept_count_result['software_pending_count'];
        $s_on_hold_ticket_count = $dept_count_result['software_on_hold_count'];
        $s_solved_ticket_count = $dept_count_result['software_solved_count'];
        $s_closed_ticket_count = $dept_count_result['software_closed_count'];
        $ds_pending_ticket_count = $dept_count_result['desktop_support_pending_count'];
        $ds_on_hold_ticket_count = $dept_count_result['desktop_support_on_hold_count'];
        $ds_solved_ticket_count = $dept_count_result['desktop_support_solved_count'];
        $ds_closed_ticket_count = $dept_count_result['desktop_support_closed_count'];

        $request->session()->put('h_pending_ticket_count',$h_pending_ticket_count);
        $request->session()->put('h_on_hold_ticket_count',$h_on_hold_ticket_count);
        $request->session()->put('h_solved_ticket_count',$h_solved_ticket_count);
        $request->session()->put('h_closed_ticket_count',$h_closed_ticket_count);
        $request->session()->put('n_pending_ticket_count',$n_pending_ticket_count);
        $request->session()->put('n_on_hold_ticket_count',$n_on_hold_ticket_count);
        $request->session()->put('n_solved_ticket_count',$n_solved_ticket_count);
        $request->session()->put('n_closed_ticket_count',$n_closed_ticket_count);
        $request->session()->put('s_pending_ticket_count',$s_pending_ticket_count);
        $request->session()->put('s_on_hold_ticket_count',$s_on_hold_ticket_count);
        $request->session()->put('s_solved_ticket_count',$s_solved_ticket_count);
        $request->session()->put('s_closed_ticket_count',$s_closed_ticket_count);
        $request->session()->put('ds_pending_ticket_count',$ds_pending_ticket_count);
        $request->session()->put('ds_on_hold_ticket_count',$ds_on_hold_ticket_count);
        $request->session()->put('ds_solved_ticket_count',$ds_solved_ticket_count);
        $request->session()->put('ds_closed_ticket_count',$ds_closed_ticket_count);


        $activity_row = $http->get('http://localhost:8080/helpdeskApi/rest/tickets_service/tickets_to_dashboard',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]);

        $activity_row_result = json_decode((string)$activity_row->getBody(),true);

        if ($activity_row_result['data'] !== null )
        {
            $count = count($activity_row_result['data']);

            $ticket_logs_div = '';

            for($i = 0; $i < $count; $i++)
            {
                $ticket_id = $activity_row_result['data'][$i]['id'];
                $code = $activity_row_result['data'][$i]['code'];
                $subject = $activity_row_result['data'][$i]['subject'];
                $priority = $activity_row_result['data'][$i]['priority'];
                $status = $activity_row_result['data'][$i]['status'];
                $date_created = $activity_row_result['data'][$i]['date_created'];

                if ($status == 'Open')
                {
                    if ($priority == 'Low')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary span">'.$code.' :<i class="fas fa-arrow-circle-down text-success small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Medium')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-minus-circle text-warning small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'High')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-arrow-circle-up text-danger small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Urgent')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-exclamation-triangle text-danger small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }
                }

                if ($status !== 'Open')
                {
                    if ($priority == 'Low')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-arrow-circle-down text-success small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Medium')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-minus-circle text-warning small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'High')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-arrow-circle-up text-danger small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Urgent')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-exclamation-triangle small ms-2" style="color: #d63384"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }
                }
            }

            $request->session()->put('ticket_logs_div',$ticket_logs_div);
        }

        if ($activity_row_result['data'] == null)
        {
            $ticket_logs_div = '<span class="text-secondary">No data... </span>';

            $request->session()->put('ticket_logs_div',$ticket_logs_div);
        }


        $user_activity_row = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/user_tickets_to_dashboard',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id'=>$user_id
            ]
        ]);

        $user_activity_row_result = json_decode((string)$user_activity_row->getBody(),true);

        if ($user_activity_row_result['data'] !== null )
        {
            $count = count($user_activity_row_result['data']);

            $ticket_logs_div = '';

            for($i = 0; $i < $count; $i++)
            {
                $ticket_id = $user_activity_row_result['data'][$i]['id'];
                $code = $user_activity_row_result['data'][$i]['code'];
                $subject = $user_activity_row_result['data'][$i]['subject'];
                $priority = $user_activity_row_result['data'][$i]['priority'];
                $status = $user_activity_row_result['data'][$i]['status'];
                $date_created = $user_activity_row_result['data'][$i]['date_created'];

                if ($status == 'Open')
                {
                    if ($priority == 'Low')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary span">'.$code.' :<i class="fas fa-arrow-circle-down text-success small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Medium')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-minus-circle text-warning small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'High')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-arrow-circle-up text-danger small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Urgent')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span><span class="badge pill-badge-primary m-l-10">New</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-exclamation-triangle text-danger small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }
                }

                if ($status !== 'Open')
                {
                    if ($priority == 'Low')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-arrow-circle-down text-success small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Medium')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-minus-circle text-warning small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'High')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-arrow-circle-up text-danger small ms-2"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }

                    if ($priority == 'Urgent')
                    {
                        $ticket_logs_div .= 
                        '<div class="media">
                            <div class="activity-dot-primary mt-n-4"></div>
                            <div class="media-body d-block">
                                <span class="font-primary me-2 small">'.$date_created.'</span>
                                <br>
                                <span class="text-secondary small">'.$code.' :<i class="fas fa-exclamation-triangle small ms-2" style="color: #d63384"></i> [ '.$status.' ]</span>
                                <p class="small">'.$subject.'</p>
                            </div>
                        </div>';
                    }
                }
            }

            $request->session()->put('myticket_logs_div',$ticket_logs_div);
        }

        if ($user_activity_row_result['data'] == null)
        {
            $ticket_logs_div = '<span class="text-secondary">No data... </span>';

            $request->session()->put('myticket_logs_div',$ticket_logs_div);
        }


        $user_performance = $http->get('http://localhost:8080/helpdeskApi/rest/tickets_service/users_ticket_count',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]);

        $user_performance_result = json_decode((string)$user_performance->getBody(),true);

        if ($user_performance_result['data'] !== null )
        {
            $count = count($user_performance_result['data']);

            $performance_span = '';

            for($i = 0; $i < $count; $i++)
            {
                $user_first_name = $user_performance_result['data'][$i]['first_name'];
                $user_surname = $user_performance_result['data'][$i]['surname'];
                $total = $user_performance_result['data'][$i]['total'];
                
                $performance_span .= '<span class="text-secondary"><i class="fas fa-check-square me-2"></i> '.$user_first_name.' '.$user_surname.' : [ <b class="text-success">'.$total.'</b> ]</span>';
            }

            $request->session()->put('performance_span',$performance_span);
        }

        if ($user_performance_result['data'] == null)
        {
            $performance_span = '<span class="text-secondary">No data... </span>';

            $request->session()->put('performance_span',$performance_span);
        }


        $dept_chart = $http->get('http://localhost:8080/helpdeskApi/rest/tickets_service/dept_ticket_per_month',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]); 

        $dept_chart_result = json_decode((string)$dept_chart->getBody(),true);

        $h_jan_ticket_count = $dept_chart_result['hardware_jan_count'];
        $h_feb_ticket_count = $dept_chart_result['hardware_feb_count'];
        $h_mar_ticket_count = $dept_chart_result['hardware_mar_count'];
        $h_apr_ticket_count = $dept_chart_result['hardware_apr_count'];
        $h_may_ticket_count = $dept_chart_result['hardware_may_count'];
        $h_jun_ticket_count = $dept_chart_result['hardware_jun_count'];
        $h_jul_ticket_count = $dept_chart_result['hardware_jul_count'];
        $h_aug_ticket_count = $dept_chart_result['hardware_aug_count'];
        $h_sep_ticket_count = $dept_chart_result['hardware_sep_count'];
        $h_oct_ticket_count = $dept_chart_result['hardware_oct_count'];
        $h_nov_ticket_count = $dept_chart_result['hardware_nov_count'];
        $h_dec_ticket_count = $dept_chart_result['hardware_dec_count'];
        $n_jan_ticket_count = $dept_chart_result['networking_jan_count'];
        $n_feb_ticket_count = $dept_chart_result['networking_feb_count'];
        $n_mar_ticket_count = $dept_chart_result['networking_mar_count'];
        $n_apr_ticket_count = $dept_chart_result['networking_apr_count'];
        $n_may_ticket_count = $dept_chart_result['networking_may_count'];
        $n_jun_ticket_count = $dept_chart_result['networking_jun_count'];
        $n_jul_ticket_count = $dept_chart_result['networking_jul_count'];
        $n_aug_ticket_count = $dept_chart_result['networking_aug_count'];
        $n_sep_ticket_count = $dept_chart_result['networking_sep_count'];
        $n_oct_ticket_count = $dept_chart_result['networking_oct_count'];
        $n_nov_ticket_count = $dept_chart_result['networking_nov_count'];
        $n_dec_ticket_count = $dept_chart_result['networking_dec_count'];
        $s_jan_ticket_count = $dept_chart_result['software_jan_count'];
        $s_feb_ticket_count = $dept_chart_result['software_feb_count'];
        $s_mar_ticket_count = $dept_chart_result['software_mar_count'];
        $s_apr_ticket_count = $dept_chart_result['software_apr_count'];
        $s_may_ticket_count = $dept_chart_result['software_may_count'];
        $s_jun_ticket_count = $dept_chart_result['software_jun_count'];
        $s_jul_ticket_count = $dept_chart_result['software_jul_count'];
        $s_aug_ticket_count = $dept_chart_result['software_aug_count'];
        $s_sep_ticket_count = $dept_chart_result['software_sep_count'];
        $s_oct_ticket_count = $dept_chart_result['software_oct_count'];
        $s_nov_ticket_count = $dept_chart_result['software_nov_count'];
        $s_dec_ticket_count = $dept_chart_result['software_dec_count'];
        $ds_jan_ticket_count = $dept_chart_result['desktop_support_jan_count'];
        $ds_feb_ticket_count = $dept_chart_result['desktop_support_feb_count'];
        $ds_mar_ticket_count = $dept_chart_result['desktop_support_mar_count'];
        $ds_apr_ticket_count = $dept_chart_result['desktop_support_apr_count'];
        $ds_may_ticket_count = $dept_chart_result['desktop_support_may_count'];
        $ds_jun_ticket_count = $dept_chart_result['desktop_support_jun_count'];
        $ds_jul_ticket_count = $dept_chart_result['desktop_support_jul_count'];
        $ds_aug_ticket_count = $dept_chart_result['desktop_support_aug_count'];
        $ds_sep_ticket_count = $dept_chart_result['desktop_support_sep_count'];
        $ds_oct_ticket_count = $dept_chart_result['desktop_support_oct_count'];
        $ds_nov_ticket_count = $dept_chart_result['desktop_support_nov_count'];
        $ds_dec_ticket_count = $dept_chart_result['desktop_support_dec_count'];

        $request->session()->put('h_jan_ticket_count',$h_jan_ticket_count);
        $request->session()->put('h_feb_ticket_count',$h_feb_ticket_count);
        $request->session()->put('h_mar_ticket_count',$h_mar_ticket_count);
        $request->session()->put('h_apr_ticket_count',$h_apr_ticket_count);
        $request->session()->put('h_may_ticket_count',$h_may_ticket_count);
        $request->session()->put('h_jun_ticket_count',$h_jun_ticket_count);
        $request->session()->put('h_jul_ticket_count',$h_jul_ticket_count);
        $request->session()->put('h_aug_ticket_count',$h_aug_ticket_count);
        $request->session()->put('h_sep_ticket_count',$h_sep_ticket_count);
        $request->session()->put('h_oct_ticket_count',$h_oct_ticket_count);
        $request->session()->put('h_nov_ticket_count',$h_nov_ticket_count);
        $request->session()->put('h_dec_ticket_count',$h_dec_ticket_count);
        $request->session()->put('n_jan_ticket_count',$n_jan_ticket_count);
        $request->session()->put('n_feb_ticket_count',$n_feb_ticket_count);
        $request->session()->put('n_mar_ticket_count',$n_mar_ticket_count);
        $request->session()->put('n_apr_ticket_count',$n_apr_ticket_count);
        $request->session()->put('n_may_ticket_count',$n_may_ticket_count);
        $request->session()->put('n_jun_ticket_count',$n_jun_ticket_count);
        $request->session()->put('n_jul_ticket_count',$n_jul_ticket_count);
        $request->session()->put('n_aug_ticket_count',$n_aug_ticket_count);
        $request->session()->put('n_sep_ticket_count',$n_sep_ticket_count);
        $request->session()->put('n_oct_ticket_count',$n_oct_ticket_count);
        $request->session()->put('n_nov_ticket_count',$n_nov_ticket_count);
        $request->session()->put('n_dec_ticket_count',$n_dec_ticket_count);
        $request->session()->put('s_jan_ticket_count',$s_jan_ticket_count);
        $request->session()->put('s_feb_ticket_count',$s_feb_ticket_count);
        $request->session()->put('s_mar_ticket_count',$s_mar_ticket_count);
        $request->session()->put('s_apr_ticket_count',$s_apr_ticket_count);
        $request->session()->put('s_may_ticket_count',$s_may_ticket_count);
        $request->session()->put('s_jun_ticket_count',$s_jun_ticket_count);
        $request->session()->put('s_jul_ticket_count',$s_jul_ticket_count);
        $request->session()->put('s_aug_ticket_count',$s_aug_ticket_count);
        $request->session()->put('s_sep_ticket_count',$s_sep_ticket_count);
        $request->session()->put('s_oct_ticket_count',$s_oct_ticket_count);
        $request->session()->put('s_nov_ticket_count',$s_nov_ticket_count);
        $request->session()->put('s_dec_ticket_count',$s_dec_ticket_count);
        $request->session()->put('ds_jan_ticket_count',$ds_jan_ticket_count);
        $request->session()->put('ds_feb_ticket_count',$ds_feb_ticket_count);
        $request->session()->put('ds_mar_ticket_count',$ds_mar_ticket_count);
        $request->session()->put('ds_apr_ticket_count',$ds_apr_ticket_count);
        $request->session()->put('ds_may_ticket_count',$ds_may_ticket_count);
        $request->session()->put('ds_jun_ticket_count',$ds_jun_ticket_count);
        $request->session()->put('ds_jul_ticket_count',$ds_jul_ticket_count);
        $request->session()->put('ds_aug_ticket_count',$ds_aug_ticket_count);
        $request->session()->put('ds_sep_ticket_count',$ds_sep_ticket_count);
        $request->session()->put('ds_oct_ticket_count',$ds_oct_ticket_count);
        $request->session()->put('ds_nov_ticket_count',$ds_nov_ticket_count);
        $request->session()->put('ds_dec_ticket_count',$ds_dec_ticket_count);


        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/user_tasks',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        $total_count = $result['total_count'];
        $pending_count = $result['pending_count'];
        $on_hold_count = $result['on_hold_count'];
        $solved_count = $result['solved_count'];
        $closed_count = $result['closed_count'];

        $request->session()->put('d_total_ticket_count',$total_count);
        $request->session()->put('d_pending_ticket_count',$pending_count);
        $request->session()->put('d_on_hold_ticket_count',$on_hold_count);
        $request->session()->put('d_solved_ticket_count',$solved_count);
        $request->session()->put('d_closed_ticket_count',$closed_count);

        return $user_id;
    }


    public function get_tasks_json(Request $request)
    { 
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/user_tasks',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        $total_count = $result['total_count'];
        $performance_percentage = $result['user_performance'][0]['performance_percentage'];
        $handle_count = $result['handle_count'];
        $open_count = $result['open_count'];
        $pending_count = $result['pending_count'];
        $on_hold_count = $result['on_hold_count'];
        $solved_count = $result['solved_count'];
        $closed_count = $result['closed_count'];

        $request->session()->put('t_total_ticket_count',$total_count);
        $request->session()->put('t_performance_ticket_result',$performance_percentage);
        $request->session()->put('t_handle_ticket_count',$handle_count);
        $request->session()->put('t_open_ticket_count',$open_count);
        $request->session()->put('t_pending_ticket_count',$pending_count);
        $request->session()->put('t_on_hold_ticket_count',$on_hold_count);
        $request->session()->put('t_solved_ticket_count',$solved_count);
        $request->session()->put('t_closed_ticket_count',$closed_count);

        return $user_id;
    }


    public function get_staff_management_json(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->get('http://localhost:8080/helpdeskApi/rest/users_service/dept_users',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        $hardware_count = $result['hardware_count'];
        $software_count = $result['software_count'];
        $networking_count = $result['networking_count'];
        $desktop_support_count = $result['desktop_support_count'];

        $request->session()->put('hardware_count',$hardware_count);
        $request->session()->put('software_count',$software_count);
        $request->session()->put('networking_count',$networking_count);
        $request->session()->put('desktop_support_count',$desktop_support_count);

        return $result;
    }


    public function get_user_logs_json(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $username = $request->session()->get('username');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/user_logs_count',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'username'=>$username
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        $total_logs_count = $result['total_logs_count'];
        $success_logs_count = $result['success_logs_count'];
        $success_jan_count = $result['success_jan_count'];
        $success_feb_count = $result['success_feb_count'];
        $success_mar_count = $result['success_mar_count'];
        $success_apr_count = $result['success_apr_count'];
        $success_may_count = $result['success_may_count'];
        $success_jun_count = $result['success_jun_count'];
        $success_jul_count = $result['success_jul_count'];
        $success_aug_count = $result['success_aug_count'];
        $success_sep_count = $result['success_sep_count'];
        $success_oct_count = $result['success_oct_count'];
        $success_nov_count = $result['success_nov_count'];
        $success_dec_count = $result['success_dec_count'];
        $failed_logs_count = $result['failed_logs_count'];
        $failed_jan_count = $result['failed_jan_count'];
        $failed_feb_count = $result['failed_feb_count'];
        $failed_mar_count = $result['failed_mar_count'];
        $failed_apr_count = $result['failed_apr_count'];
        $failed_may_count = $result['failed_may_count'];
        $failed_jun_count = $result['failed_jun_count'];
        $failed_jul_count = $result['failed_jul_count'];
        $failed_aug_count = $result['failed_aug_count'];
        $failed_sep_count = $result['failed_sep_count'];
        $failed_oct_count = $result['failed_oct_count'];
        $failed_nov_count = $result['failed_nov_count'];
        $failed_dec_count = $result['failed_dec_count'];

        $request->session()->put('jan_count_s',$success_jan_count);
        $request->session()->put('feb_count_s',$success_feb_count);
        $request->session()->put('mar_count_s',$success_mar_count);
        $request->session()->put('apr_count_s',$success_apr_count);
        $request->session()->put('may_count_s',$success_may_count);
        $request->session()->put('jun_count_s',$success_jun_count);
        $request->session()->put('jul_count_s',$success_jul_count);
        $request->session()->put('aug_count_s',$success_aug_count);
        $request->session()->put('sep_count_s',$success_sep_count);
        $request->session()->put('nov_count_s',$success_nov_count);
        $request->session()->put('dec_count_s',$success_dec_count);
        $request->session()->put('jan_count_f',$failed_jan_count);
        $request->session()->put('feb_count_f',$failed_feb_count);
        $request->session()->put('mar_count_f',$failed_mar_count);
        $request->session()->put('apr_count_f',$failed_apr_count);
        $request->session()->put('may_count_f',$failed_may_count);
        $request->session()->put('jun_count_f',$failed_jun_count);
        $request->session()->put('jul_count_f',$failed_jul_count);
        $request->session()->put('aug_count_f',$failed_aug_count);
        $request->session()->put('sep_count_f',$failed_sep_count);
        $request->session()->put('nov_count_f',$failed_nov_count);
        $request->session()->put('dec_count_f',$failed_dec_count);

        $request->session()->put('success_logs_count',$success_logs_count);
        $request->session()->put('failed_logs_count',$failed_logs_count);

        $success_logs_percentage = round($total_logs_count == 0 ? 0 : $success_logs_count / $total_logs_count * 100);
        $failed_logs_percentage = round($total_logs_count == 0 ? 0 : $failed_logs_count / $total_logs_count * 100);

        $request->session()->put('success_logs_percentage',$success_logs_percentage);
        $request->session()->put('failed_logs_percentage',$failed_logs_percentage);
        
        return $result;
    }


    public function select_option_users(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $selected = $request->input('department_id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/get_users_by_dept',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_dept'=>$selected
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        $count = count($result['data']);

        if ($result['data'] !== null )
        {
            $get_select_option = '<option value="" selected disabled>-- select --</option>';

            for($i = 0; $i < $count; $i++)
            {
                $user_id = $result['data'][$i]['id'];
                $user_first_name = $result['data'][$i]['first_name'];
                $user_surname = $result['data'][$i]['surname'];
                
                $get_select_option .= '<option value='.$user_id.'>'.$user_first_name.' '.$user_surname.'</option>';
            }

            return $get_select_option;
        }

        if ($result['data'] == null)
        {
            $get_select_option = '<option value="" selected disabled>-- select --</option>';

            return $get_select_option;
        }
    }


    public function get_open_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/get_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'statusid'=>1
            ]
        ]);

        $open_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $open_ticket_result;
    }

    public function get_pending_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/get_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'statusid'=>2
            ]
        ]);

        $pending_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $pending_ticket_result;
    }

    public function get_on_hold_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/get_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'statusid'=>3
            ]
        ]);

        $on_hold_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $on_hold_ticket_result;
    }

    public function get_solved_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/get_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'statusid'=>4
            ]
        ]);

        $solved_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $solved_ticket_result;
    }

    public function get_closed_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/get_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'statusid'=>5
            ]
        ]);

        $closed_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $closed_ticket_result;
    }

    public function get_myopen_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/myopen_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $myopen_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $myopen_ticket_result;
    }


    public function get_handle_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/handle_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $handle_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $handle_ticket_result;
    }

    public function get_mypending_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/mypending_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $mypending_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $mypending_ticket_result;
    }

    public function get_myonhold_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/myonhold_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $myonhold_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $myonhold_ticket_result;
    }

    public function get_mysolved_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/mysolved_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $mysolved_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $mysolved_ticket_result;
    }

    public function get_myclosed_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/myclosed_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $myclosed_ticket_result = json_decode((string)$credentials->getBody(),true);
        
        return $myclosed_ticket_result;
    }


    public function get_staff_performance(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->input('user_id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/myclosed_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $myclosed_ticket_result = json_decode((string)$credentials->getBody(),true);

        if ($myclosed_ticket_result['data'] !== null)
        {
            $myclosed_ticket_count = count($myclosed_ticket_result['data']);
            $request->session()->put('p_myclosed_ticket_count',$myclosed_ticket_count);
        }

        if ($myclosed_ticket_result['data'] == null)
        {
            $myclosed_ticket_count = 0;
            $request->session()->put('p_myclosed_ticket_count',$myclosed_ticket_count);
        }

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/performance_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $total_ticket_result = json_decode((string)$credentials->getBody(),true);

        if ($total_ticket_result['data'] !== null)
        {
            $total_ticket_count = count($total_ticket_result['data']);
            $request->session()->put('p_total_ticket_count',$total_ticket_count);
        }

        if ($total_ticket_result['data'] == null)
        {
            $total_ticket_count = 0;
            $request->session()->put('p_total_ticket_count',$total_ticket_count);
        }

        $performance_ticket_result = $request->session()->get('p_total_ticket_count') == 0 ? 0 : ($request->session()->get('p_myclosed_ticket_count') / $request->session()->get('p_total_ticket_count')) * 100;

        $request->session()->put('p_performance_ticket_result', $performance_ticket_result);

        $display_perform = '';

        if($performance_ticket_result <= 30)
        {
            if(($request->session()->get('p_myclosed_ticket_count')) == 0)
            {
                $display_perform = '
                <div class="progress sm-progress-bar mb-1">
                <div class="progress-bar-animated progress-bar-striped bg-danger" role="progressbar" style="width: 2%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h6 class="small">'.$request->session()->get('p_myclosed_ticket_count').' of '.$request->session()->get('p_total_ticket_count').' Task(s) Completed :: '.round($request->session()->get('p_performance_ticket_result')).'%</h6>';
            }

            if(($request->session()->get('p_myclosed_ticket_count')) > 0)
            {
                $display_perform = '
                <div class="progress sm-progress-bar mb-1">
                <div class="progress-bar-animated progress-bar-striped bg-danger" role="progressbar" style="width: '.$request->session()->get('p_performance_ticket_result').'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h6 class="small">'.$request->session()->get('p_myclosed_ticket_count').' of '.$request->session()->get('p_total_ticket_count').' Task(s) Completed :: '.round($request->session()->get('p_performance_ticket_result')).'%</h6>';
            }

            if(($request->session()->get('p_total_ticket_count')) == 0)
            {
                $display_perform = '
                <div class="progress sm-progress-bar mb-1">
                <div class="progress-bar-animated progress-bar-striped bg-danger" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h6 class="small">No data...</h6>';
            }
        }

        if($performance_ticket_result > 30 && $performance_ticket_result < 70)
        {
            $display_perform = '
            <div class="progress sm-progress-bar mb-1">
            <div class="progress-bar-animated progress-bar-striped bg-warning" role="progressbar" style="width: '.$request->session()->get('p_performance_ticket_result').'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h6 class="small">'.$request->session()->get('p_myclosed_ticket_count').' of '.$request->session()->get('p_total_ticket_count').' Task(s) Completed :: '.round($request->session()->get('p_performance_ticket_result')).'%</h6>';
        }

        if($performance_ticket_result >= 70)
        {
            $display_perform = '
            <div class="progress sm-progress-bar mb-1">
            <div class="progress-bar-animated progress-bar-striped bg-success" role="progressbar" style="width: '.$request->session()->get('p_performance_ticket_result').'%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h6 class="small">'.$request->session()->get('p_myclosed_ticket_count').' of '.$request->session()->get('p_total_ticket_count').' Task(s) Completed :: '.round($request->session()->get('p_performance_ticket_result')).'%</h6>';
        }
        
        return $display_perform;
    }

    public function get_user_logs(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->get('http://localhost:8080/helpdeskApi/rest/users_service/get_user_logs',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ]
        ]);

        $user_logs = json_decode((string)$credentials->getBody(),true);
        
        return $user_logs;
    }

    public function get_ticket_logs_ga(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_logs',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'region_id' => 1
            ]
        ]);

        $ticket_logs_ga = json_decode((string)$credentials->getBody(),true);

        if ($ticket_logs_ga['data'] !== null)
        {
            $ticket_logs_ga_count = count($ticket_logs_ga['data']);
            $request->session()->put('ticket_logs_ga_count',$ticket_logs_ga_count);
        }

        if ($ticket_logs_ga['data'] == null)
        {
            $ticket_logs_ga_count = 0;
            $request->session()->put('ticket_logs_ga_count',$ticket_logs_ga_count);
        }
        
        return $ticket_logs_ga;
    }

    public function get_user_tasks(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->input('user_id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/handle_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'user_id' => $user_id
            ]
        ]);

        $user_tasks_result = json_decode((string)$credentials->getBody(),true);

        if ($user_tasks_result['data'] !== null)
        {
            $user_tasks_count = count($user_tasks_result['data']);
            $request->session()->put('user_tasks_count',$user_tasks_count);
        }

        if ($user_tasks_result['data'] == null)
        {
            $user_tasks_count = 0;
            $request->session()->put('user_tasks_count',$user_tasks_count);
        }
        
        return $user_tasks_result;
    }


    public function summary_report(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $from_date = $request->input('from_date');
        $f_date = Carbon::createFromFormat('m/d/Y', $from_date)->format('Y-m-d');
        $to_date = $request->input('to_date');
        $t_date = Carbon::createFromFormat('m/d/Y', $to_date)->format('Y-m-d');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/print_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'from_date' => $f_date,
                'to_date' => $t_date,
                'department_id' => $request->input('department_id'),
                'division_id' => $request->input('division_id'),
                'region_id' => $request->input('region_id')
            ]
        ]);

        $result = json_decode((string)$credentials->getBody(),true);

        if ($result['data'] !== null )
        {
            $count = count($result['data']);

            $print_td = '';

            for($i = 0; $i < $count; $i++)
            {
                $num = $i+1; 
                $ticket_code = $result['data'][$i]['code'];
                $complainant_name = $result['data'][$i]['complainant_name'];
                $subject = $result['data'][$i]['subject'];
                $office = $result['data'][$i]['complainant_office'];
                $priority = $result['data'][$i]['priority'];
                $status = $result['data'][$i]['status'];
                $date_created = $result['data'][$i]['date_created'];
                
                $print_td .= '<tr class="small"><td class="text-secondary">'.$num.'</td><td class="text-secondary">'.$ticket_code.'</td><td class="text-secondary">'.$complainant_name.'</td><td class="text-secondary">'.$subject.'</td><td class="text-secondary">'.$priority.'</td><td class="text-secondary">'.$status.'</td><td class="text-secondary">'.$date_created.'</td></tr>';

                $request->session()->put('print_td',$print_td);
                $request->session()->put('from_date',$f_date);
                $request->session()->put('to_date',$t_date);
                $request->session()->put('division',$result['data'][$i]['division']);
                $request->session()->put('department',$result['data'][$i]['department']);
                $request->session()->put('region',$result['data'][$i]['region']);
            }

            return redirect("summary-reports")->with(['print_msg' => '']);
        }

        if ($result['data'] == null)
        {
            $print_td = '';

            $request->session()->put('print_td',$print_td);

            return redirect("summary-reports")->with(['print_errmsg' => 'No records found']);
        }
    }

    public function generate_print_form(Request $request)
    {
        $ticket_id = $request->input('code');
        $description = $request->input('subject');
        $complainant = $request->input('complainant_name');
        $division = $request->input('division');
        $serial_number = $request->input('serial_no');
        $it_officer = $request->input('assigned_user');
        $authorised_by = $request->input('authorisor');
        $diagnoses = $request->input('details');
        $form_date = $request->input('cur_date');
    
        $complainant_form = '
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Ticket ID:</label>
            <input class="form-control" style="font-size: 13px" value="'.$ticket_id.'" required readonly>
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Description:</label>
            <input class="form-control" style="font-size: 13px" value="'.$description.'">
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Division:</label>
            <input class="form-control" style="font-size: 13px" value="'.$division.'">
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Serial Number:</label>
            <input class="form-control" style="font-size: 13px" value="'.$serial_number.'">
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Complainant:</label>
            <input class="form-control" style="font-size: 13px" value="'.$complainant.'">
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">IT Officer:</label>
            <input class="form-control" style="font-size: 13px" value="'.$it_officer.'">
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Authorised By:</label>
            <input class="form-control" style="font-size: 13px" value="'.$authorised_by.'">
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Diagnoses:</label>
            <textarea class="form-control" style="font-size: 13px" style="height: 200px">'.$diagnoses.'</textarea>
        </div>
        <div class="mb-2">
            <label class="col-form-label pt-0" for="exampleInputEmail1">Date:</label>
            <input class="form-control" style="font-size: 13px" value="'.$form_date.'">
        </div>
        ';
    
        $request->session()->put('complainant_form',$complainant_form);
        $request->session()->put('ticket_id',$ticket_id);
    
        return redirect("my-tasks")->with(['form' => '']);
    }


    public function get_ticket_note(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $ticket_id = $request->input('ticket_id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_note',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'json'=>[
                'ticket_id' => $ticket_id
            ]
        ]);

        $user_tasks_result = json_decode((string)$credentials->getBody(),true);

        if ($user_tasks_result['data'] !== null)
        {
            $user_tasks_count = count($user_tasks_result['data']);
            $request->session()->put('user_tasks_count',$user_tasks_count);
        }

        if ($user_tasks_result['data'] == null)
        {
            $user_tasks_count = 0;
            $request->session()->put('user_tasks_count',$user_tasks_count);
        }
        
        return $user_tasks_result;
    }
}
