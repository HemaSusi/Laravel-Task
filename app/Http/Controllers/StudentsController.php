<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rules\Mobile;
use App\Rules\Email;
use Session;
use DB;
use Redirect;
use App\Student;
use Validator;

class StudentsController extends Controller {

    public function index() {
        return view('/students/index');
    }

    public function add() {
        return view('students/add', []);
    }
    
    public function edit($id = null) {
        return view('/students/edit');
    }
    public function delete(Request $request, $id = null) {
        $data = Product::findOrFail($id);
        $data->status = 'Trash';
        $data->save();
        return \Redirect::route('students.index', []);
    }

}
