<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DocManaga | A free document management platform</title>
    <meta name="description" content="DocManaga | A free document management platform">
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{--
    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet"> @yield('styles')

    <style>
        .traffic-chart {
            min-height: 335px;
        }


        .chart-container {
            display: table;
            min-width: 270px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{route('home')}}"><i class="menu-icon fa fa-dashboard" aria-hidden="true"></i>Dashboard </a>
                    </li>
                    <!-- /.menu-title -->
                    <li>
                        <a href="{{route('documents')}}"> <i class="menu-icon fa fa-file" aria-hidden="true"></i>Documents</a>
                    </li>
                    <li>
                        <a href="{{route('users')}}"> <i class="menu-icon fa fa-user" aria-hidden="true"></i>Users</a>
                    </li>
                    <li>
                        <a href="{{route('logs')}}"> <i class="menu-icon fa fa-history" aria-hidden="true"></i>Logs</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/')}}">DocsManaga</a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" id="backup" href="#" data-token="{{csrf_token()}}"><i class="fa fa -cog "></i>Backup</a>

                            <form id="backup-form " action="{{ route( 'backup') }} " method="POST " style="display: none; ">
                                @csrf
                            </form>

                            <a class="nav-link " href="{{ route( 'logout') }} " onclick="event.preventDefault(); document.getElementById(
                                'logout-form').submit(); ">
                             <i class="fa fa-power -off "></i>{{ __('Logout') }}
                         </a>

                            <form id="logout-form " action="{{ route( 'logout') }} " method="POST " style="display: none; ">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->


        @yield('content')

        <!-- Modal - Calendar - Add New Event -->
        <div class="modal fade none-border " id="event-modal ">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <button type="button " class="close " data-dismiss="modal " aria-hidden="true ">&times;</button>
                        <h4 class="modal-title "><strong>Add New Event</strong></h4>
                    </div>
                    <div class="modal-body "></div>
                    <div class="modal-footer ">
                        <button type="button " class="btn btn-default waves-effect " data-dismiss="modal ">Close</button>
                        <button type="button " class="btn btn-success save-event waves-effect waves-light ">Create event</button>
                        <button type="button " class="btn btn-danger delete-event waves-effect waves-light
                                " data-dismiss="modal ">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#event-modal -->
        <!-- Modal - Calendar - Add Category -->
        <div class="modal fade none-border " id="add-category ">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <button type="button " class="close " data-dismiss="modal " aria-hidden="true ">&times;</button>
                        <h4 class="modal-title "><strong>Add a category </strong></h4>
                    </div>
                    <div class="modal-body ">
                        <form>
                            <div class="row ">
                                <div class="col-md-6 ">
                                    <label class="control-label ">Category Name</label>
                                    <input class="form-control form-white " placeholder="Enter name " type="text
                                " name="category-name " />
                                </div>
                                <div class="col-md-6 ">
                                    <label class="control-label ">Choose Category Color</label>
                                    <select class="form-control form-white " data-placeholder="Choose a color...
                                " name="category-color ">
                                                    <option value="success ">Success</option>
                                                    <option value="danger ">Danger</option>
                                                    <option value="info ">Info</option>
                                                    <option value="pink ">Pink</option>
                                                    <option value="primary ">Primary</option>
                                                    <option value="warning ">Warning</option>
                                                </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button " class="btn btn-default waves-effect " data-dismiss="modal ">Close</button>
                        <button type="button " class="btn btn-danger waves-effect waves-light save-category
                                " data-dismiss="modal ">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#add-category -->
    </div>
    <!-- .animated -->
    </div>
    <!-- /.content -->
    <div class="clearfix "></div>

    {{-- MODALS --}}

    <div class="modal fade " id="generatedlinkModal " tabindex="-1 " role="dialog " aria-labelledby="generatedlinkModalLabel
                                " aria-hidden="true ">
        <div class="modal-dialog " role="document ">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title " id="generatedlinkModalLabel ">Generated Share Link</h5>
                </div>
                <div class="modal-body " id="linkBoxDetails ">
                    {{--
                    <p>
                        The link to the document is:
                    </p> --}}
                </div>
                <div class="modal-footer ">
                    <button type="button " class="btn btn-secondary " data-dismiss="modal ">Cancel</button>
                    <button type="button " onclick="copyFunction() " class="btn btn-primary ">Copy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="editModal " tabindex="-1 " role="dialog " aria-labelledby="editModalLabel
                                " aria-hidden="true ">
        <div class="modal-dialog " role="document ">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title " id="editModalLabel ">Edit Documents</h5>
                </div>
                <div class="modal-body " id="editbox ">

                </div>
                <div class="modal-footer ">
                    <button type="button " class="btn btn-secondary " data-dismiss="modal ">Cancel</button>
                    <button type="submit " form="addUser " class="btn btn-primary ">Save</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer ">
        <div class="footer-inner bg-white ">
            <div class="row ">
                <div class="col-sm-6 ">
                    Copyright &copy; 2018 DocsManaga
                </div>
                <div class="col-sm-6 text-right ">
                    Designed by <a href="https://facebook.com/multimegaitschool ">Multimega Groups</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    {{--
    <script src="http://code.jquery.com/jquery-3.3.1.min.js " integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin=" anonymous "></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js "></script>
    <script src="{{asset( 'assets/js/main.js')}} "></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js "></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js "></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js "></script>

    <script src="{{asset( 'assets/js/lib/data-table/datatables.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/dataTables.bootstrap.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/dataTables.buttons.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/buttons.bootstrap.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/jszip.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/vfs_fonts.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/buttons.html5.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/buttons.print.min.js')}} "></script>
    <script src="{{asset( 'assets/js/lib/data-table/buttons.colVis.min.js')}} "></script>
    <script src="{{asset( 'assets/js/init/datatables-init.js')}} "></script>
    @yield('scripts')
    <script>
        $(document).ready(function () {
                    $('body').delegate('#share', 'click', function(){
                        let id = $(this).data('id');
                        var token = $(this).data("token ");
                        $.ajax({
                            url:'/linkBox',
                            type:'get',
                            data:{'id':id, '_token': token},
                            success: function(data) {
                                $('#linkBoxDetails').html(data);
                            }
                        });
                    });
        
                    $('body').delegate('#trash', 'click', function(){
                        let id = $(this).data('id');
                        var token = $(this).data("token");
                        $.ajax({
                            url:'/trash/'+id,
                            type:'DELETE',
                            data:{'_token': token, '_method':'DELETE'},
                            success: function(data) {
                                $('#e').html(data)
                            }
                        });
                    });
        
                    $('body').delegate('#restore', 'click', function(){
                        let id = $(this).data('id');
                        var token = $(this).data("token ");
                        $.ajax({
                            url:'/restore/'+id,
                            type:'GET',
                            data:{'_token': token, '_method':'GET'},
                            success: function(data) {
                                $('#e').html(data)
                            }
                        });
                    });
        
                    $('body').delegate('#remove', 'click', function(){
                        let id = $(this).data('id');
                        var token = $(this).data("token ");
                        $.ajax({
                            url:'/remove/'+id,
                            type:'DELETE',
                            data:{'_token': token, '_method':'DELETE'},
                            success: function(data) {
                                $('#e').html(data)
                            }
                        });
                    });

                    $('body').delegate('#edit', 'click', function(){
                        let id = $(this).data('id');
                        var token = $(this).data("token ");
                        $.ajax({
                            url:'/editBox/'+id,
                            type:'GET',
                            data:{'_token': token, '_method':'GET'},
                            success: function(data) {
                                $('#editbox').html(data)
                            }
                        });
                    });

                    $('body').delegate('#downloadfile', 'click', function(){
                        var url = $(this).data('url');
                        window.location = "/download/ "+url
                    });
        
                });
        
                function copyFunction() {
                    /* Get the text field */
                    var copyText = document.getElementById("linkText ");
                    
                    /* Select the text field */
                    copyText.select();
        
                    /* Copy the text inside the text field */
                    document.execCommand("copy ");
        
                    /* Alert the copied text */
                    alert("Copied the text: " + copyText.value);
                    }
    </script>


</body>

</html>