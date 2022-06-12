<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class LogoutController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $http = new \GuzzleHttp\Client;
        
        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/update_user_logs',[
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
                'username' => $request->session()->get('username'),
                'logout_date' => date('Y-m-d H:i:s')
            ])
        ]);

        session::flush();
        Auth::logout();

        return redirect()->intended("welcome");
    }
}