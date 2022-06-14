<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\CheckLoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//index
Route::get('/welcome', function () {
    return view('pages.welcome', ['page_name' => 'Welcome Form']);
});

//Authentication links
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/unlock', [LoginController::class, 'unlock'])->name('unlock');
Route::get('/unlock', [LoginController::class, 'unlock'])->name('unlock');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

//sidebars
Route::get('/dashboard', [CheckLoginController::class, 'dashboard']);
Route::get('/new-ticket', [CheckLoginController::class, 'new_ticket']);
Route::get('/open-ticket', [CheckLoginController::class, 'open_ticket']);
Route::get('/pending-ticket', [CheckLoginController::class, 'pending_ticket']);
Route::get('/on-hold-ticket', [CheckLoginController::class, 'on_hold_ticket']);
Route::get('/solved-ticket', [CheckLoginController::class, 'solved_ticket']);
Route::get('/closed-ticket', [CheckLoginController::class, 'closed_ticket']);
Route::get('/my-tasks', [CheckLoginController::class, 'my_tasks']);
Route::get('/staff-management', [CheckLoginController::class, 'staff_management']);
Route::get('/summary-reports', [CheckLoginController::class, 'summary_reports']);
Route::get('/knowledgebase', [CheckLoginController::class, 'knowledgebase']);
Route::get('/settings', [CheckLoginController::class, 'settings']);
Route::get('/ticket-logs', [CheckLoginController::class, 'ticket_logs']);
Route::get('/user-logs', [CheckLoginController::class, 'user_logs']);
Route::get('/change-password', [CheckLoginController::class, 'change_password']);
Route::get('/manage-profile', [CheckLoginController::class, 'manage_profile']);

//lockscreen
Route::get('/lockscreen', [CheckLoginController::class, 'lockscreen']);

//User IP Address
Route::post('/user_ip', [Controller::class, 'user_ip']);
Route::get('/user_ip', [Controller::class, 'user_ip']);

//insert staff
Route::post('/insert_user', [UserController::class, 'insert_user']);
Route::get('/insert_user', [UserController::class, 'insert_user']);

//update staff
Route::post('/update_user', [UserController::class, 'update_user']);
Route::get('/update_user', [UserController::class, 'update_user']);

//update profile
Route::post('/update_profile', [UserController::class, 'update_profile']);
Route::get('/update_profile', [UserController::class, 'update_profile']);

//update password
Route::post('/change_password', [PasswordController::class, 'change_password']);
Route::get('/change_password', [PasswordController::class, 'change_password']);
Route::post('/n_change_password', [PasswordController::class, 'n_change_password']);
Route::get('/n_change_password', [PasswordController::class, 'n_change_password']);

//send ticket on welcome page
Route::post('/w_send_ticket', [TicketController::class, 'w_send_ticket']);
Route::get('/w_send_ticket', [TicketController::class, 'w_send_ticket']);

//send ticket on new ticket page
Route::post('/n_send_ticket', [TicketController::class, 'n_send_ticket']);
Route::get('/n_send_ticket', [TicketController::class, 'n_send_ticket']);

//update ticket
Route::post('/update_open_ticket', [TicketController::class, 'update_open_ticket']);
Route::get('/update_open_ticket', [TicketController::class, 'update_open_ticket']);
Route::post('/update_pending_ticket', [TicketController::class, 'update_pending_ticket']);
Route::get('/update_pending_ticket', [TicketController::class, 'update_pening_ticket']);
Route::post('/update_on_hold_ticket', [TicketController::class, 'update_on_hold_ticket']);
Route::get('/update_on_hold_ticket', [TicketController::class, 'update_on_hold_ticket']);
Route::post('/update_solved_ticket', [TicketController::class, 'update_solved_ticket']);
Route::get('/update_solved_ticket', [TicketController::class, 'update_solved_ticket']);
Route::post('/close_ticket', [TicketController::class, 'close_ticket']);
Route::get('/close_ticket', [TicketController::class, 'close_ticket']);
Route::post('/update_myopen_ticket', [TicketController::class, 'update_myopen_ticket']);
Route::get('/update_myopen_ticket', [TicketController::class, 'update_myopen_ticket']);
Route::post('/update_handle_ticket', [TicketController::class, 'update_handle_ticket']);
Route::get('/update_handle_ticket', [TicketController::class, 'update_handle_ticket']);

//getting csrf token
Route::get('/get-csrf-token', [Controller::class, 'getCSRFToken']);

//Get Json data to specific pages
Route::get('/get_dashboard_json', [JsonController::class, 'get_dashboard_json']);
Route::get('/get_tasks_json', [JsonController::class, 'get_tasks_json']);
Route::post('/get_tasks_json', [JsonController::class, 'get_tasks_json']);
Route::get('/get_staff_management_json', [JsonController::class, 'get_staff_management_json']);
Route::post('/get_user_logs_json', [JsonController::class, 'get_user_logs_json']);
Route::get('/get_user_logs_json', [JsonController::class, 'get_user_logs_json']);

//generate complainant form
Route::post('/generate_print_form', [JsonController::class, 'generate_print_form']);

//staff performance
Route::post('/get_staff_performance', [JsonController::class, 'get_staff_performance']);
Route::get('/get_staff_performance', [JsonController::class, 'get_staff_performance']);

//sending note
Route::post('/add_note', [TicketController::class, 'add_note']);
Route::get('/add_note', [TicketController::class, 'add_note']);

//load ticket note
Route::post('/get_ticket_note', [JsonController::class, 'get_ticket_note']);
Route::get('/get_ticket_note', [JsonController::class, 'get_ticket_note']);

//print ticket
Route::post('/summary_report', [JsonController::class, 'summary_report']);
Route::get('/summary_report', [JsonController::class, 'summary_report']);

//load ticket
Route::get('/get_open_ticket', [JsonController::class, 'get_open_ticket']);
Route::get('/get_pending_ticket', [JsonController::class, 'get_pending_ticket']);
Route::get('/get_on_hold_ticket', [JsonController::class, 'get_on_hold_ticket']);
Route::get('/get_solved_ticket', [JsonController::class, 'get_solved_ticket']);
Route::get('/get_closed_ticket', [JsonController::class, 'get_closed_ticket']);

//load staff
Route::get('/hardware_users', [JsonController::class, 'hardware_users']);
Route::get('/networking_users', [JsonController::class, 'networking_users']);
Route::get('/software_users', [JsonController::class, 'software_users']);
Route::get('/desk_support_users', [JsonController::class, 'desk_support_users']);
Route::get('/select_option_users', [JsonController::class, 'select_option_users']);

Route::get('/get_myopen_ticket', [JsonController::class, 'get_myopen_ticket']);
Route::get('/get_handle_ticket', [JsonController::class, 'get_handle_ticket']);
Route::get('/get_mypending_ticket', [JsonController::class, 'get_mypending_ticket']);
Route::get('/get_myonhold_ticket', [JsonController::class, 'get_myonhold_ticket']);
Route::get('/get_mysolved_ticket', [JsonController::class, 'get_mysolved_ticket']);
Route::get('/get_myclosed_ticket', [JsonController::class, 'get_myclosed_ticket']);
Route::get('/get_performance_ticket', [JsonController::class, 'get_performance_ticket']);
Route::get('/get_ticket_logs_ga', [JsonController::class, 'get_ticket_logs_ga']);
Route::post('/get_user_tasks', [JsonController::class, 'get_user_tasks']);
Route::get('/get_total_ticket', [JsonController::class, 'get_total_ticket']);

//user logs
Route::get('/get_user_logs', [JsonController::class, 'get_user_logs']);
Route::get('/get_user_performance', [JsonController::class, 'get_user_performance']);

Route::get('barcode', function () {
  
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
    $image = $generatorPNG->getBarcode('000005263635', $generatorPNG::TYPE_CODE_128);

    return response($image)->header('Content-type','image/png');
});

Route::get('/phpinfo', function() {
    return phpinfo();
});

//other links
Route::get('/knowledgebase-details', [CheckLoginController::class, 'knowledgebase_details']);