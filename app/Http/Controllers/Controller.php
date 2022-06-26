<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCSRFToken(){
        return csrf_token();
    }

    public function user_ip(Request $request)
    {
        $clientIP = $request->ip();   
        return $clientIP;
    }

    public function get_assigned_type(Request $request)
    {
        if($request->input('assigned_type')=='Individual')
        {
            $assigned_form = '
            <div class="mb-3">
                <label class="col-form-label pt-0" for="exampleInputEmail1">Department<span class="text-danger">*</span></label>
                <select class="form-control" id="dept_name" name="department_id" onChange="get_user(this.value);" required>
                    <option value="" disabled selected>-- select --</option>
                    <option value="2">Networking</option>
                    <option value="3">Software</option>
                    <option value="1">Hardware</option>
                    <option value="4">Desktop Support</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="col-form-label pt-0" for="exampleInputEmail1">IT Officer<span class="text-danger">*</span></label>
                <select class="form-control" id="dept_user" name="assigned_user_id" required>
                    <option value="" disabled selected>-- select --</option>
                </select>
            </div>
            ';
        }

        if($request->input('assigned_type')=='Group')
        {
            $assigned_form = '
            <link rel="stylesheet" type="text/css" href="assets/css/select2.css">
            <script src="assets/js/select2/select2.full.min.js"></script>
            <script src="assets/js/select2/select2-custom.js"></script>
            <div class="mb-3">
                <label class="col-form-label pt-0" for="exampleInputEmail1">Department<span class="text-danger">*</span></label>
                <select class="form-control" id="dept_name" name="department_id" onChange="get_users(this.value);" required>
                    <option value="" disabled selected>-- select --</option>
                    <option value="2">Networking</option>
                    <option value="3">Software</option>
                    <option value="1">Hardware</option>
                    <option value="4">Desktop Support</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="col-form-label pt-0" for="exampleInputEmail1">Team Leader<span class="text-danger">*</span></label>
                <select class="form-control" id="team_lead" name="assigned_user_id" required>
                    <option value="" disabled selected>-- select --</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="col-form-label">Members<span class="text-danger">*</span></label>
                <select class="js-example-basic-multiple col-sm-12 small" multiple="" id="dept_users" name="assigned_members[]" required></select>
            </div>
            ';
        }

        return $assigned_form;
    }
}
