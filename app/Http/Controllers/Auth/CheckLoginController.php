<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonController;

class CheckLoginController extends Controller
{
    public function dashboard()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return redirect()->action('App\Http\Controllers\JsonController@dashboard');
        }
    }

    public function new_ticket()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.new-ticket', ['page_name' => 'Add Ticket']);
        }
    }

    public function open_ticket()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.open-ticket', ['page_name' => 'Open Ticket']);
        }
    }

    public function pending_ticket()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.pending-ticket', ['page_name' => 'Pending Ticket']);
        }
    }

    public function on_hold_ticket()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.on-hold-ticket', ['page_name' => 'On-Hold Ticket']);
        }
    }

    public function solved_ticket()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.solved-ticket', ['page_name' => 'Solved Ticket']);
        }
    }

    public function closed_ticket()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.closed-ticket', ['page_name' => 'Closed Ticket']);
        }
    }

    public function my_tasks()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return redirect()->action('App\Http\Controllers\JsonController@my-tasks');
        }
    }

    public function staff_management()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return redirect()->action('App\Http\Controllers\JsonController@gstaff-management');
        }
    }

    public function summary_reports()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.summary-reports', ['page_name' => 'Summary Reports']);
        }
    }

    public function knowledgebase()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return redirect()->action('App\Http\Controllers\JsonController@knowledgebase');
        }
    }

    public function settings()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.settings', ['page_name' => 'Settings']);
        }
    }

    public function ticket_logs()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.ticket-logs', ['page_name' => 'Ticket Logs']);
        }
    }

    public function user_logs()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.user-logs', ['page_name' => 'User Logs']);
        }
    }

    public function manage_profile()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return redirect()->action('App\Http\Controllers\JsonController@manage-profile');
        }
    }

    public function change_password()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.change-password', ['page_name' => 'Change Password']);
        }
    }

    public function lockscreen()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.lockscreen', ['page_name' => 'Account Locked']);
        }
    }

    public function knowledgebase_details()
    {
        if (session()->get('check_login') == null)
        {
            return redirect("welcome");
        }
        else
        {
            return view('pages.knowledgebase-details', ['page_name' => 'Knowledgebase']);
        }
    }
}
