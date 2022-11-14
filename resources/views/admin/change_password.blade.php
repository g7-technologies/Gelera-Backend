@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">

    <div class="row" style="margin: 20px;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div id="alertDiv">
                        @if (session('error_msg'))
                            <div class="alert alert-danger">
                                {{ session('error_msg') }}
                            </div>
                        @endif
                        @if (session('success_msg'))
                            <div class="alert alert-success">
                                {{ session('success_msg') }}
                            </div>
                        @endif
                    </div>
                    <h4 class="header-title mt-0 mb-3">Change Password</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/change_password_submit')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="notification" class="col-lg-2">Current Password<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="current_password" type="password" class="form-control" name="current_password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="notification" class="col-lg-2">New Password<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="new_password" type="password" class="form-control" name="new_password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="notification" class="col-lg-2">Confirm New Password<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection