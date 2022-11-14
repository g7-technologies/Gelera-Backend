@extends('layouts.admin_master')

@section('content')

<div class="container-fluid">
    <div class="row" style="margin: 20px;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body order-list">
                    
                    <div id="alertDiv">
                        @if(session('success_msg'))
                             <p class="alert alert-success">{{session('success_msg')}}</p> 
                        @endif
                        @if(session('error_msg'))
                             <p class="alert alert-danger">{{session('error_msg')}}</p> 
                        @endif
                    </div>
                    
                    <h4 class="header-title mt-0 mb-3">Blocked Users</h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr align="center">
                                   <th>Sr#</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Wallet Address</th>
                                   <th>Coins per click</th>
                                   <th>Total Coins</th>
                                   <th>Status</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;?>
                                @foreach($users as $user)
                                <?php $i = $i + 1;?>
                                <tr align="center">
                                    <td>{{$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->wallet_address}}</td>
                                    <td>{{$user->mining_rate}}</td>
                                    <td>{{$user->total_coins}}</td>
                                    <td>
                                        @if($user->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @elseif($user->status == 0)
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status == 1)
                                        <a href="{{url('/disable_user/'.$user->id)}}" title="Disable User" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                        @elseif($user->status == 0)
                                        <a href="{{url('/activate_user/'.$user->id)}}" title="Activate User" class="btn btn-outline-success"><i class="fas fa-check"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
    $(document).ready( function() {
        $('#alertDiv').delay(3000).slideUp(1200);
    });
    
</script>

@endpush