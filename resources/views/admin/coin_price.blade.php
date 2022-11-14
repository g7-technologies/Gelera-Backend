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
                    <h4 class="header-title mt-0 mb-3">Coin Price</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/coin_price_submit')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="coin_price" class="col-lg-2">Coins Price<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="coin_price" name="coin_price" type="number" step="0.1" min="0.1" class="form-control" required value="{{$misc->coin_price}}"/>
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
