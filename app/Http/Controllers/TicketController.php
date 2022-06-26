<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function w_send_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_insert',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'body'=>json_encode([
                'complainant_name' => $request->input('complainant_name'),
                'complainant_number' => $request->input('complainant_number'),
                'division_id' => $request->input('division_id'),
                'complainant_office' => $request->input('complainant_office'),
                'region_id' => $request->input('region_id'),
                'subject' => $request->input('subject'),
                'details' => $request->input('details'),
                'priority_id' => $request->input('priority_id'),
                'is_assigned' => 0,
                'status_id' => 1,
                'pin' => date('Y'),
                'open_id' => 0,
                'created_by' => $request->input('complainant_name'),
                'date_created' => date('Y-m-d H:i:s')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("welcome")->with(['send_ticket_message' => 'Complaint has been lodged successfully.']);
    }

    public function n_send_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_insert',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'body'=>json_encode([
                'complainant_name' => $request->input('complainant_name'),
                'complainant_number' => $request->input('complainant_number'),
                'division_id' => $request->input('division_id'),
                'complainant_office' => $request->input('complainant_office'),
                'region_id' => $request->input('region_id'),
                'subject' => $request->input('subject'),
                'details' => $request->input('details'),
                'priority_id' => $request->input('priority_id'),
                'is_assigned' => 0,
                'status_id' => 1,
                'pin' => date('Y'),
                'open_id' => $request->session()->get('id'),
                'created_by' => $request->input('user_name'),
                'date_created' => date('Y-m-d H:i:s')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("new-ticket")->with(['send_ticket_message' => 'Complaint has been lodged successfully.']);
    }

    public function update_open_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $members = implode(", ", $request->input('assigned_members'));

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_update',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'complainant_name' => $request->input('complainant_name'),
                'complainant_number' => $request->input('complainant_number'),
                'division_id' => $request->input('division_id'),
                'complainant_office' => $request->input('complainant_office'),
                'region_id' => $request->input('region_id'),
                'subject' => $request->input('subject'),
                'details' => $request->input('details'),
                'priority_id' => $request->input('priority_id'),
                'department_id' => $request->input('department_id'),
                'assigned_userid' => $request->input('assigned_user_id'),
                'assigned_groupid' => $members,
                'date_assigned' => date('Y-m-d'),
                'is_assigned' => 1,
                'status_id' => 2
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("open-ticket")->with(['update_ticket_message' => 'Ticket has been updated successfully.']);
    }

    public function update_on_hold_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/re_assign_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'priority_id' => $request->input('priority_id'),
                'department_id' => $request->input('department_id'),
                'assigned_userid' => $request->input('assigned_userid'),
                'date_assigned' => date('Y-m-d'),
                'status_id' => 2
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("on-hold-ticket")->with(['update_ticket_message' => 'Ticket has been re-assigned successfully.']);
    }

    public function update_solved_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/re_assign_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'priority_id' => $request->input('priority_id'),
                'department_id' => $request->input('department_id'),
                'assigned_userid' => $request->input('assigned_userid'),
                'date_assigned' => date('Y-m-d'),
                'status_id' => 2
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("solved-ticket")->with(['update_ticket_message' => 'Ticket has been re-assigned successfully.']);
    }

    public function close_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/close_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'status_id' => 5
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("solved-ticket")->with(['update_ticket_message' => 'Ticket has been closed successfully.']);
    }

    public function update_pending_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/re_assign_ticket',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'priority_id' => $request->input('priority_id'),
                'department_id' => $request->input('department_id'),
                'assigned_userid' => $request->input('assigned_userid'),
                'date_assigned' => date('Y-m-d'),
                'status_id' => 2
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("pending-ticket")->with(['update_ticket_message' => 'Ticket has been re-assigned successfully.']);
    }

    public function update_myopen_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_update_myopen',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'complainant_name' => $request->input('complainant_name'),
                'complainant_number' => $request->input('complainant_number'),
                'division_id' => $request->input('division_id'),
                'complainant_office' => $request->input('complainant_office'),
                'region_id' => $request->input('region_id'),
                'subject' => $request->input('subject'),
                'details' => $request->input('details'),
                'priority_id' => $request->input('priority_id')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("my-tasks")->with(['update_ticket_message' => 'Ticket updated.']);
    }

    public function update_handle_ticket(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/ticket_update_handle',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive'
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'status_id' => $request->input('status_id')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("my-tasks")->with(['update_ticket_message' => 'Ticket updated.']);
    }

    public function add_note(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/tickets_service/add_note',[
            'headers'=>[
                'Authorization'=>'Bearer'.session()->get('token.access_token'),
                'Content-Type'  => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With',
                'Access-Control-Max-Age' => '1728000',
                'Connection' => 'Keep-Alive',
            ],
            'body'=>json_encode([
                'code' => $request->input('code'),
                'note' => $request->input('note'),
                'user_id' => $request->session()->get('id'),
                'note_date' => date('Y-m-d H:i:s')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("my-tasks")->with(['update_ticket_message' => 'Note submitted.']);
    }

    
}
