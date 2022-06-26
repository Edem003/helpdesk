<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Session;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        if (($request->input('password')) == 'Passw0rd')
        {
            $username = $request->input('username');
            $password = $request->input('password');

            $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/login',[
                'headers'=>[
                    'Authorization'=>'Bearer'.session()->get('token.access_token'),
                    'content-type'  => 'application/json',
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => 'GET,PUT,POST,DELETE',
                    'Access-Control-Allow-Headers' => 'X-Requested-With',
                    'Access-Control-Max-Age' => '1728000',
                    'Connection' => 'Keep-Alive',
                ],
                'json'=>[
                    'username' => $username,
                    'password' => md5($password)
                ]
            ]); 

            $result = json_decode((string)$credentials->getBody(),true);

            if ($result['data'] !== null ) {
                // getting user details
                $user_id = $result['data'][0]['id'];
                $username = $result['data'][0]['username'];
                $user_first_name = $result['data'][0]['first_name'];

                $request->session()->put('id',$user_id);
                $request->session()->put('username',$username);
                $request->session()->put('first_name',$user_first_name);

                //check login
                $check_login = $result['data'];
                $request->session()->put('check_login',$check_login);

                $response = $credentials->getBody();

                // redirecting to dashboard page if user credentials are valid
                return redirect()->intended('change-password');
            }

            if ($result['data'] == null) {

                $clientIP = $request->ip(); 

                $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/insert_user_logs',[
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
                        'user_ip' => $clientIP,
                        'status' => 0,
                        'login_date' => date('Y-m-d H:i:s')
                    ])
                ]);

                // redirecting to welcome page if user credentials are invalid
                return redirect("welcome")->with(['error_message' => 'Incorrect Login Credentials!!']);;
            }
        }

        if (($request->input('password')) !== 'Passw0rd')
        {
            $username = $request->input('username');
            $password = $request->input('password');

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
                // getting user details
                $user_id = $result['data'][0]['id'];
                $username = $result['data'][0]['username'];
                $user_first_name = $result['data'][0]['first_name'];
                $user_surname = $result['data'][0]['surname'];
                $user_role = $result['data'][0]['role'];
                $user_department = $result['data'][0]['department'];
                $user_email = $result['data'][0]['email'];
                $user_phone = $result['data'][0]['phone'];
                $user_region = $result['data'][0]['region'];
                $user_region_id = $result['data'][0]['region_id'];
                $user_status = $result['data'][0]['status'];
                $user_color = $result['data'][0]['color'];
                $user_lockscreen = $result['data'][0]['lockscreen'];

                $request->session()->put('id',$user_id);
                $request->session()->put('username',$username);
                $request->session()->put('first_name',$user_first_name);
                $request->session()->put('surname',$user_surname);
                $request->session()->put('role',$user_role);
                $request->session()->put('department',$user_department);
                $request->session()->put('email',$user_email);
                $request->session()->put('phone',$user_phone);
                $request->session()->put('region',$user_region);
                $request->session()->put('region_id',$user_region_id);
                $request->session()->put('status',$user_status);
                $request->session()->put('color',$user_color);
                $request->session()->put('lockscreen',$user_lockscreen);

                //check login
                $check_login = $result['data'];
                $request->session()->put('check_login',$check_login);

                $clientIP = $request->ip(); 

                $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/insert_user_logs',[
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
                        'user_ip' => $clientIP,
                        'status' => 1,
                        'login_date' => date('Y-m-d H:i:s')
                    ])
                ]);

                $response = $credentials->getBody();

                // redirecting to dashboard page if user credentials are valid
                return redirect()->intended('dashboard');
            }
            
            if ($result['data'] == null) {

                $clientIP = $request->ip(); 

                $credentials = $http->post('http://localhost:8080/helpdeskApi/rest/users_service/insert_user_logs',[
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
                        'user_ip' => $clientIP,
                        'status' => 0,
                        'login_date' => date('Y-m-d H:i:s')
                    ])
                ]);

                // redirecting to welcome page if user credentials are invalid
                return redirect("welcome")->with(['error_message' => 'Incorrect Login Credentials!!']);
            }
        }  
    }


    public function unlock(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $username = $request->input('username');
        $password = $request->input('password');

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
            // redirecting to dashboard page if user credentials are valid
            return redirect()->intended('dashboard');
        }
        
        if ($result['data'] == null) {
            // redirecting to lockscreen page if user credentials are invalid
            return redirect("lockscreen")->with(['error_message' => 'Incorrect Password!!']);
        }
         
    }
    
}
