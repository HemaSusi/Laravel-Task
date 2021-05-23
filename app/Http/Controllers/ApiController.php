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
use App\Admin;
use App\Student;
use Validator;

class ApiController extends Controller {

    public function adminlogin(Request $request) {
        extract($_REQUEST);
        try {
            $request = json_decode($request->getContent());
            $validator = \Validator::make($request->all(), [
                        'username' => 'required|regex:/^[a-zA-Z]+$/u',
                        'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            ]);
            if ($validator->fails()) {
                $message = $validator->errors();
                $this->SetStatusCode(404);
                return response()->json(["message" => $this->RespondWithError($message)], 0);
            } else {
                $result = DB::table('admin')->where('username', $request->username)->first();
                if (!empty($result)) {
                    if ($result->password == md5($request->password)) {
                        return response()->json(["message" => "Login Successfully!", "data" => array('token' => $result->token)], 200);
                    } else {
                        return response()->json(["message" => "Username & Password mismatch!"], 0);
                    }
                } else {
                    return response()->json(["message" => "Account not found!"], 0);
                }
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//To create a new record: POST Method
    public function createStudent(Request $request) {
        extract($_REQUEST);
        try {
            $admin_id = $request->header('token');
            $request = json_decode($request->getContent());
            $validator = \Validator::make($request->all(), [
                        'student_name' => 'required|regex:/^[a-zA-Z]+$/u',
                        'student_mobile' => 'required|regex:/(01)[0-9]{9}/',
                        'student_gender' => 'required',
                        'student_address' => 'required',
                        'profile_image' => 'required|image|mimes:jpeg,png,jpg',
            ]);
            if ($validator->fails()) {
                $message = $validator->errors();
                $this->SetStatusCode(404);
                return response()->json(["message" => $this->RespondWithError($message)], 0);
            } else {
                $student = new Student;
                $student->student_name = $request->student_name;
                $student->student_mobile = $request->student_mobile;
                $student->student_gender = $request->student_gender;
                $student->student_address = $request->student_address;
                if ($request->hasFile('profile_image')) {
                    $file = $request->file('profile_image');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('profile/');
                    $request->file('profile_image')->move($destinationPath, $filename);
                    $student->profile_image = $filename;
                }
                $student->status = 'Active';
                $student->save();

                return response()->json(["message" => "Student Record created"], 200);
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//To view all records: GET Method
    public function studentsList() {
        extract($_REQUEST);
        try {
            $data = array();
            $students = Student::where('status', '<>', 'Trash')->orderBy('student_id', 'desc')->get();
            if (!empty($students)) {
                foreach ($students as $student) {
                    $data[] = array(
                        'student_id' => $student->student_id,
                        'student_name' => $student->student_name,
                        'student_mobile' => $student->student_mobile,
                        'student_gender' => $student->student_gender,
                        'student_address' => $student->student_address,
                        'profile_image' => asset('profile/' . $student->profile_image),
                    );
                }
                return response()->json(["message" => "Student List", "data" => $data], 200);
            } else {
                return response()->json(["message" => "No Students!"], 0);
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//To view individual records: GET Method
    public function getStudentDetail(Request $request) {
        extract($_REQUEST);
        try {
            $request = json_decode($request->getContent());

            $student = Student::where('student_id', $request->student_id)->where('status', '<>', 'Trash')->first();
            if (!empty($student) && ($student->status == 'Active')) {
                $data = array(
                    'student_id' => $student->student_id,
                    'student_name' => $student->student_name,
                    'student_mobile' => $student->student_mobile,
                    'student_gender' => $student->student_gender,
                    'student_address' => $student->student_address,
                    'profile_image' => asset('profile/' . $student->profile_image),
                );
                return response()->json(["message" => "Student Detail", "data" => $data], 200);
            } else {
                return response()->json(["message" => "Student not exist!"], 0);
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//To update a record by id: PUT Method
    public function updateSTprofile(Request $request, $id) {
        extract($_REQUEST);
        try {
            $request = json_decode($request->getContent());
            $student = Student::where('student_id', $id)->first();
            if (!empty($student) && ($student->status == 'Active')) {
                $validator = \Validator::make($request->all(), [
                            'student_name' => 'regex:/^[a-zA-Z]+$/u',
                            'student_mobile' => 'regex:/(01)[0-9]{9}/',
                            'profile_image' => 'image|mimes:jpeg,png,jpg',
                ]);
                if ($validator->fails()) {
                    $message = $validator->errors();
                    $this->SetStatusCode(404);
                    return response()->json(["message" => $this->RespondWithError($message)], 0);
                } else {
                    $data = array(
                        'student_name' => !empty($request->student_name) ? $request->student_name : $student->student_name,
                        'student_mobile' => !empty($request->student_mobile) ? $request->student_mobile : $student->student_mobile,
                        'student_gender' => !empty($request->student_gender) ? $request->student_gender : $student->student_gender,
                        "student_address" => !empty($request->student_address) ? $request->student_address : $student->student_address,
                    );
                    if ($request->hasFile('profile_image')) {
                        $file = $request->file('profile_image');
                        $filename = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('profile/');
                        $request->file('profile_image')->move($destinationPath, $filename);
                        $data['profile_image'] = $filename;
                    } else {
                        $data['profile_image'] = $student->profile_image;
                    }
                    Student::where('student_id', $id)
                            ->update($data);
                    return response()->json(["message" => "Student Record updated!"], 200);
                }
            } else {
                return response()->json(["message" => "Student not exist!"], 0);
            }
            return response()->json($response);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }
//To delete a record by id: DELETE Method (Using Status field)
    public function deleteStudent(Request $request, $id) {
        extract($_REQUEST);
        try {
            $student = Student::where('student_id', $id)
                            ->where('status', 'Active')->first();
            if (!empty($student)) {
                $data = array(
                    "status" => "Trash",
                );
                Student::where('student_id', $id)->update($data);
                 return response()->json(["message" => "Student Deleted!"], 200);
            } else {
                 return response()->json(["message" => "Student Not Exist!"], 0);
            }
          
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

}
