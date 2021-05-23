@extends('layouts.web')
@section('content')
<div class="content">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Edit Student</h2>
            </div>
            <div class="panel-body">
                <form method="post" action=""  enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 col-md-offset-3">
                        <div class="m-section__content">

                            <div class="form-group row">
                                <label class="col-md-4">
                                    Name <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input  type="text" class="form-control" name="student_name" value="Student one"/>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Mobile <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input  type="text" class="form-control" name="student_mobile"  value="8888989898"/>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Gender <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input  type="radio" value="Male" name="student_gender" checked />Male
                                    <input  type="radio" value="Female" name="student_gender" />Female
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">
                                    Address <span class="red">*</span>
                                </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="student_address" >Test</textarea>

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
    <script type="text/javascript">
        $(document).ready(function () {
            $(".add").click(function () {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".btn-danger", function () {
                $(this).parents(".hdtuto").remove();
            });
        });
            jQuery(document).on('click', '.remove-file', function () {
        jQuery(this).closest('li').remove();
    });

    </script>

    @endsection
