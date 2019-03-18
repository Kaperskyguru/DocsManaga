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
                        <h1>Documents</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="active">Documents</li>
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
            <button data-toggle="modal" data-target="#addDocumentModal" class="btn btn-success btn-lg btn-block">Upload Documents</button>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3 nav-fill nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Documents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-trash-tab" data-toggle="pill" href="#pills-trash" role="tab" aria-controls="pills-trash" aria-selected="false">Trash</a>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="table-stats order-table ov-h">
                                    <table class="table" id="bootstrap-data-table-export">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Uploader</th>
                                                <th>Description</th>
                                                <th>Access</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Actions</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1); @foreach ($documents as $document)

                                            <tr>
                                                <td class="avatar">{{$document->title}}</td>
                                                <td> <span class="name">{{$document->user == null ? "Anonymous" :$document->user->name}} </span></td>
                                                <td> <span class="name">{{str_limit($document->description, 100)}}</span> </td>
                                                <td>
                                                    <span class="product">{{($document->access==1)?'Public':'Private'}}</span>
                                                </td>
                                                <td>{{$document->category}}</td>
                                                <td>{{$document->type}}</td>
                                                <td>
                                                    <span id="downloadfile" data-url="{{extractFileFromPath($document->filename)}}" class="badge badge-complete"><i class="fa fa-download" data-toggle="tooltip" title="Download!" aria-hidden="true"></i></span>

                                                    <span data-toggle="modal" id="share" data-id="{{$document->id}}" data-token="{{csrf_token()}}" data-target="#generatedlinkModal"
                                                        data-toggle="tooltip" title="Share!" class="badge badge-complete"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                                </td>
                                                <td>
                                                    <span data-toggle="modal" data-target="#editModal" data-id="{{$document->id}}" data-token="{{csrf_token()}}" id="edit" data-toggle="tooltip"
                                                        title="Edit!" class="badge badge-complete"><i class="fa fa-edit" aria-hidden="true"></i></span>
                                                    <span class="badge badge-complete" id="trash" data-id="{{$document->id}}" data-token="{{csrf_token()}}" data-toggle="tooltip"
                                                        title="Trash!"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-stats -->
                            </div>



                            <div class="tab-pane fade show" id="pills-trash" role="tabpanel" aria-labelledby="pills-trash-tab">
                                <div class="table-stats order-table ov-h">
                                    <table class="table" id="bootstrap-data-table-export1">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Uploader</th>
                                                <th>Description</th>
                                                <th>Access</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trashes as $trash)
                                            <tr>
                                                <td class="avatar">{{$trash->title}}</td>
                                                <td> <span class="name">{{$document->user == null ? "Anonymous" :$document->user->name}} </span></td>
                                                <td> <span class="name">{{$trash->description}}</span> </td>
                                                <td> <span class="product">{{($trash->access==1)?'Public':'Private'}}</span> </td>
                                                <td>{{$trash->category}}</td>
                                                <td>{{$trash->type}}</td>
                                                <td>
                                                    <span class="badge badge-complete" id="restore" data-id="{{$trash->id}}" data-token="{{csrf_token()}}" data-toggle="tooltip"
                                                        title="Restore!"><i class="fa fa-window-restore" aria-hidden="true"></i></span>
                                                    <span class="badge badge-complete" id="remove" data-id="{{$trash->id}}" data-token="{{csrf_token()}}" data-toggle="tooltip"
                                                        title="Delete!"><i class="fa fa-remove" aria-hidden="true"></i></span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-stats -->
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-8 -->
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="modal fade" id="addDocumentModal" tabindex="-1" role="dialog" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Add New Documents</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('documents')}}" id="addDocument" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class=" form-control-label">Document title</label>
                        <input type="text" id="title" name="title" placeholder="Enter your title" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="desc" class=" form-control-label">Description</label>
                        <textarea id="desc" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category" class=" form-control-label">Category</label>
                        <input type="text" name="category" placeholder="Enter category here" list="category" class="form-control" />
                        <datalist id="category">
                            <option value="Unknown">
                            <option value="Auto & Vehicles">
                            <option value="Business & Marketing">
                            <option value="Creative">
                            <option value="Film & Music">
                            <option value="Fun & Entertainment">
                            <option value="Hobby & Home">
                            <option value="Knowledge & Resources">
                            <option value="Nature & Animals">
                            <option value="News & Politics">
                            <option value="Nonprofits & Activism">
                            <option value="Religion & Philosophy">
                            <option value="Sports">
                            <option value="Technology & Internet">
                            <option value="Travel & Events">
                            <option value="Weird & Bizarre">
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="access" class=" form-control-label">Access</label>
                        <select id="access" name="access" class="form-control">
                                <option value="1">Public</option>
                                <option value="2">Private</option>
                            </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control" />
                    <div class="form-group">
                        <label for="document" class=" form-control-label">Documents</label>
                        <input type="file" id="document" name="file" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="addDocument" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>
@endsection
 
@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
        $('#bootstrap-data-table-export1').DataTable();
    });

</script>
@endsection