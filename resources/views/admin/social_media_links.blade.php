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
                    <h4 class="header-title mt-0 mb-3">Social Media Links</h4> 
                    
                    <form id="form" class="form" method="post" action="{{url('/social_media_links_submit')}}" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="twitter" class="col-lg-2">Twitter<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="twitter" name="twitter" type="url" class="form-control" value="{{$social_media_link->twitter}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="facebook" class="col-lg-2">Facebook<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="facebook" name="facebook" type="url" class="form-control" value="{{$social_media_link->facebook}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="linkedin" class="col-lg-2">Linkedin<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="linkedin" name="linkedin" type="url" class="form-control" value="{{$social_media_link->linkedin}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="instagram" class="col-lg-2">Instagram<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="instagram" name="instagram" type="url" class="form-control" value="{{$social_media_link->instagram}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="discord" class="col-lg-2">Discord<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="discord" name="discord" type="url" class="form-control" value="{{$social_media_link->discord}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="google" class="col-lg-2">Google<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="google" name="google" type="email" class="form-control" value="{{$social_media_link->google}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="youtube" class="col-lg-2">Youtube<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="youtube" name="youtube" type="url" class="form-control" value="{{$social_media_link->youtube}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="vimeo" class="col-lg-2">Vimeo<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="vimeo" name="vimeo" type="url" class="form-control" value="{{$social_media_link->vimeo}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="pinterest" class="col-lg-2">Pinterest<span style="color:red">*</span></label>
                                    <div class="col-lg-10">
                                        <input id="pinterest" name="pinterest" type="url" class="form-control" value="{{$social_media_link->pinterest}}"/>
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
