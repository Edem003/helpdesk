<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function insert_user(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/insert_user',[
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
                'username' => $request->input('username'),
                'hashed_pass' => md5('Passw0rd'),
                'first_name' => $request->input('first_name'),
                'surname' => $request->input('surname'),
                'department_id' => $request->input('department'),
                'role' => $request->input('role'),
                'region' => $request->input('region'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'status' => 'Offline',
                'login_date' => date('Y-m-d'),
                'color' => 'Auto',
                'lockscreen' => 'Auto'
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("staff-management")->with(['add_user' => 'New account created']);
    }

    public function update_user(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/update_user',[
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
                'user_id' => $request->input('user_id'),
                'first_name' => $request->input('first_name'),
                'surname' => $request->input('surname'),
                'department_id' => $request->input('department_id'),
                'role' => $request->input('role'),
                'region' => $request->input('region'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("staff-management")->with(['update_user' => 'Account updated']);
    }

    public function update_profile(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/update_profile',[
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
                'user_id' => $request->input('user_id'),
                'first_name' => $request->input('first_name'),
                'surname' => $request->input('surname'),
                'department_id' => $request->input('department_id'),
                'region' => $request->input('region'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("manage-profile")->with(['update_profile' => 'Profile details have been updated successfully']);
    }

    public function update_user_personalization(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $user_id = $request->session()->get('id');

        $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/update_user_personalization',[
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
                'user_id' => $user_id,
                'color' => $request->input('color'),
                'lockscreen' => $request->input('lockscreen')
            ])
        ]);

        $response = $credentials->getBody();

        return redirect("manage-profile")->with(['update_system' => 'Personalization updated, restart required.']);
    }
}
