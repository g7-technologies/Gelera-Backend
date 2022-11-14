@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">
    
    <div class="row" style="margin: 20px">
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
                    <h4 class="header-title mt-0 mb-3">Daily Coins Limit</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/daily_coins_limit_submit')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="daily_coins_limit" class="col-lg-2">Daily Coins Limit<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="daily_coins_limit" name="daily_coins_limit" type="number" class="form-control" required min="1" value="{{$misc->daily_limit}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>
                    
</div>



@endsection
