@extends('layouts.web')
@section('content')
<div class="content">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-flat login">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Admin Login</h2>
            </div>
            <div id="login">
                    <div id="login-row" class="justify-content-center align-items-center">
                        <div id="login-column" >
                            <div id="login-box">
                                <form method="post" action="{{ route('admin.check') }}" id="upload" class="validation_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username" class="text-info">Username:</label><br>
                                        <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-info">Password:</label><br>
                                        <input type="text" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    @endsection
