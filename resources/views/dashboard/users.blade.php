@extends('dashboard.layouts.app') 
@section('styles')
<link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
@endsection
 
@section('content')


<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row no-gutters">
        <div class="col-12 col-sm-6 col-md-8" id="e">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="col-6 col-md-4">
            <button data-toggle="modal" data-target="#addUserModal" class="btn btn-success btn-lg btn-block">Add User</button>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Users</strong>
                    </div>
                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table id="bootstrap-data-table-export" class="table ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{($user->role==1)?'Admin':'User'}}</td>
                                        <td>
                                            <span>{{date_format($user->created_at, 'jS M, Y')}}</span>,
                                            <span style="color:forestgreen">{{time_ago($user->created_at)}}</span>
                                        </td>
                                        <td>
                                            <span id="approveUser" data-value="{{$user->status == 1 ? 'Pending':'Approve'}}" data-id="{{$user->id}}" data-token="{{csrf_token()}}"
                                                class="badge {{$user->status == 1 ? 'badge-pending' : 'badge-success'}}" data-toggle="tooltip"
                                                title="{{$user->status == 1 ? 'Activate user':'Disactivate user'}}"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                            <span data-id="{{$user->id}}" id="deleteUser" data-token="{{csrf_token()}}" class="badge badge-pending" data-toggle="tooltip"
                                                title="Delete!"><i class="fa fa-remove" aria-hidden="true"></i></span>
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
    <!-- .animated -->
</div>
<!-- .content -->

<div class="clearfix"></div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('users')}}" id="addUser1" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class=" form-control-label">Name</label>
                        <input type="text" name="name" placeholder="Enter your name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email" class=" form-control-label">Email</label>
                        <input type="email" name="email" placeholder="Enter your email address" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="password" class=" form-control-label">Password</label>
                        <input type="password" name="password" placeholder="Enter password here" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="confirm-password" class=" form-control-label">Confirm password</label>
                        <input type="password" name="password_confirmation" placeholder="Enter your confirm-password" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="role" class=" form-control-label">Role</label>
                        <select name="role" class="form-control">
                            <option value="1">User</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="addUser1" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>
@endsection
 
@section('scripts')


<script type="text/javascript">
    $(document).ready(function() {
        //   $('#bootstrap-data-table-export').DataTable();
      

      $('body').delegate('#approveUser', 'click', function(){
            let id = $(this).data('id');
            var token = $(this).data("token");
            let value = $(this).data("value");
            if(value == "Pending"){
                let status = 2;
                $.ajax({
                    url:'/approveUser',
                    type:'PATCH',
                    data:{'id':id, 'status':status,'_token': token, '_method':'PATCH'},
                    success: function(data) {
                        $('#e').html(data)
                    }
                });
            } else {
                let status = 1;
                $.ajax({
                    url:'/approveUser',
                    type:'PATCH',
                    data:{'id':id, 'status':status, '_token': token, '_method':'PATCH'},
                    success: function(data) {
                        $('#e').html(data)
                    }
                });
            }
        });

        $('body').delegate('#deleteUser', 'click', function(){
            let id = $(this).data('id');
            var token = $(this).data("token");
            $.ajax({
                url:'/deleteUser/'+id,
                type:'DELETE',
                data:{'_token': token, '_method':'DELETE'},
                success: function(data) {
                    $('#e').html(data)
                }
            });
        });

    });

</script>
@endsection