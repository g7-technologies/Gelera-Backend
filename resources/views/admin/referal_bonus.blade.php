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
                    <h4 class="header-title mt-0 mb-3">Referal Bonus</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/referal_bonus_submit')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="referal_bonus" class="col-lg-2">Referal Bonus<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="referal_bonus" name="referal_bonus" type="number" class="form-control" required min="1" max="100" value="{{$misc->referal_bonus}}"/>
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
