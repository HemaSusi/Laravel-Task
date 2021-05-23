@extends('layouts.web')
@section('content')
<div class="content">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Create Student</h2>
            </div>
            <div class="panel-body">
                <form method="post" action=""  enctype="multipart/form-data" autocomplete="off"> 
                    @csrf
                    <div class="col-md-6 col-md-offset-3">
                        <div class="m-section__content">

                            <div class="form-group row">
                                <label class="col-md-4">
                                    Name <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input  type="text" class="form-control" name="student_name" />

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Mobile <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input  type="text" class="form-control" name="student_mobile" />

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Gender <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input  type="radio" value="Male" name="student_gender" />Male
                                    <input  type="radio" value="Female" name="student_gender" />Female
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Address <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="student_address" ></textarea>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Profile Image <span class="red">*</span>
                                </label>
                                <div class="col-md-8 ">
                                    <input type="file" name="profile_image" class="myfrm form-control">
                                </div>

                            </div>
                            <div class="form-group text-right">
                                <button  onclick="history.back()" type="button" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                    Back
                                </button>
                                <button type="submit" name="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
