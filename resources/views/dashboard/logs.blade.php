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
                        <h1>Logs</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="active">Logs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row no-gutters">
        <div class="col-12 col-sm-6 col-md-8"></div>
        <div class="col-6 col-md-4">
            <a href="{{route('clear')}}" class="btn btn-danger btn-lg btn-block">Clear Logs</a>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All logs</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Message</th>
                                    <th>Level</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <td>{{!is_null($log->user) ? $log->user->name: 'Anonymous'}}</td>
                                    <td>{{$log->description}}</td>
                                    <td>{{$log->level}}</td>
                                    <td>{{date_format($log->created_at, 'jS M, Y')}}</td>
                                    <td>{{time_ago($log->created_at)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- .animated -->
</div>
<!-- .content -->
<div class="clearfix"></div>
@endsection
 
@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );

</script>
@endsection