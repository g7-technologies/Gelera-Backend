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
                    <h4 class="header-title mt-0 mb-3">Update Faq</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/update_faq')}}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="faq_id" value="{{$faq->id}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="question" class="col-lg-2">Question<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <textarea id="question" name="question" class="form-control" required>{{$faq->question}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="answer" class="col-lg-2">Answer<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <textarea id="answer" name="answer" class="form-control" required>{{$faq->answer}}</textarea>
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
