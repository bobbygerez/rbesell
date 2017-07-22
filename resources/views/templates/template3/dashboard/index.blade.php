<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Juan Merkado Online</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <link href="{{ asset('template3/dashboard/assets/css/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/checkbox-awesome.css') }}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <style type="text/css">
        .user-table tr:hover{
            cursor: pointer;
        }
        .sidebar, .main-panel {
            overflow: visible;
        }

    </style>
</head>
<body>
<div class="wrapper" id="app">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

<!--
Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
-->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    {{ Auth::User()->personalData->firstname . ' ' . Auth::User()->personalData->lastname }}
                </a>
            </div>


            <ul class="nav">

                <li>
                    <router-link to="/positions">
                        <i class="ti-world" aria-hidden="true"></i>
                        <p>Positions</p>
                    </router-link>
                </li>
                <li>
                    <router-link to="/access-rights">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        <p>Access Rights</p>
                    </router-link>
                </li>
                <li>

                    <router-link to="/users">
                        <i class="fa fa-users"></i>
                        <p>Users</p>
                    </router-link>

                </li>


                <li>
                    <router-link to="/user-profile">
                        <i class="ti-user"></i>
                        <p>My Profile</p>
                    </router-link>
                </li>

                <li>
                    <router-link to="/merchant">
                        <i class="fa fa-bank"></i>
                        <p>Merchants</p>
                    </router-link>
                </li>

                
                <li>
                    <router-link to="/branches">
                       <i class="fa fa-th" aria-hidden="true"></i>
                        <p>Branches</p>
                    </router-link>
                </li>
              
                <li>
                    <router-link to="/products">
                        <i class="ti-desktop"></i>
                        <p>Products</p>
                    </router-link>
                </li>
                <li class="active-pro">

                </li>
            </ul>

        </div><!-- sidebar-wrapper -->
    </div><!-- end sidebar -->

    <div class="main-panel">
        <nav class="navbar navbar-default" style="z-index: 1">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">@{{ title }} </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p class="notification">5</p>
                                <p>Notifications</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-settings"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">


                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; , made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer>


    </div>
</div><!-- #app -->


</body>

    <script type="text/javascript">
        window.Laravel = {!!

                json_encode([
                    'csrfToken' => csrf_token()
                  ])

              !!}
    </script>
	<script src="{{ asset('template3/dashboard/assets/js/dashboard.js') }}"></script>


</html>
