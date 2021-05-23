<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Http;
use App\Rules\Mobile;
use App\Rules\Email;
use Session;
use DB;
use Redirect;
use App\Admin;
use Validator;

class AdminsController extends Controller {

    public function adminlogin() {
        return view('adminlogin', []);
    }

    public function check(Request $request) {

        if ($request->has('submit')) {
//            $response = Curl::to('http://localhost/api/adminlogin')
//                    ->withData(['username' => $request->username, 'password' => $request->password])
//                    ->put();
//            return $response;
        }
    }

}
