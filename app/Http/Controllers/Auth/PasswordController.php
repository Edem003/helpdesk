<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class PasswordController extends Controller
{
    //change password
    public function change_password(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        if (($request->input('cf_pass')) == ($request->input('n_pass'))) {

            $username = $request->session()->get('username');
            $password = $request->input('c_pass');

            $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/login',[
                'headers'=>[
                    'Authorization'=>'Bearer'.session()->get('token.access_token'),
                    'content-type'  => 'application/json',
                ],
                'json'=>[
                    'username' => $username,
                    'password' => md5($password)
                ]
            ]); 

            $result = json_decode((string)$credentials->getBody(),true);

            if ($result['data'] !== null ) {

                $password = $request->input('n_pass');

                $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/change_password',[
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
                        'username' => $username,
                        'n_pass' => md5($password)
                    ])
                ]);
        
                $response = $credentials->getBody();
        
                return redirect("manage-profile")->with(['update_profile' => 'Password has been changed successfully']);
            }
            
            if ($result['data'] == null) {
                return redirect("manage-profile")->with(['error_message' => 'Incorrect password!!']);;
            }
        } 

        if (($request->input('cf_pass')) !== ($request->input('n_pass'))) {
            return redirect("manage-profile")->with(['error_message' => 'Passwords do not match!!']);;  
        } 
    }

    //change password
    public function n_change_password(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        if (($request->input('cf_pass')) == ($request->input('n_pass'))) {

            $username = $request->session()->get('username');
            $password = $request->input('c_pass');

            $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/login',[
                'headers'=>[
                    'Authorization'=>'Bearer'.session()->get('token.access_token'),
                    'content-type'  => 'application/json',
                ],
                'json'=>[
                    'username' => $username,
                    'password' => md5($password)
                ]
            ]); 

            $result = json_decode((string)$credentials->getBody(),true);

            if ($result['data'] !== null ) {

                $password = $request->input('n_pass');

                $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/change_password',[
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
                        'username' => $username,
                        'n_pass' => md5($password)
                    ])
                ]);
        
                $response = $credentials->getBody();
        
                return redirect("welcome")->with(['success_message' => 'Password has been changed successfully']);
            }
            
            if ($result['data'] == null) {
                return redirect("change-password")->with(['error_message' => 'Incorrect password!!']);;
            }
        } 

        if (($request->input('cf_pass')) !== ($request->input('n_pass'))) {
            return redirect("change-password")->with(['error_message' => 'Passwords do not match!!']);;  
        } 
    }
}
