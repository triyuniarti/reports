<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reports System</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Datatables -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <link rel="stylesheet" href="{{url('assets/datatables/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/datatables/css/dataTables.bootstrap.min.css')}}">
    <script src="{{ url('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/datatables/js/dataTables.bootstrap.min.js')}}"></script>

    <!-- CKeditor -->
    <script src="{{ url('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('resources/assets/css/style.css')}}">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top nav-cus">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Report System
                </a>
            </div>

            <div class="collapse navbar-collapse" id="spark-navbar-collapse">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                        <li style="font-size: 16px"><a href="{{ url('/login') }}">Welcome, guest !</a></li>
                    </ul>
                @else
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        {{--<li><a href="{{ url('/home') }}">Home</a></li>--}}
                        @if(Auth::user()->admin == 1)
                            <li><a href="{{ url('home/users') }}">Users</a></li>
                            <li><a href="{{ url('home/reports') }}">List Reports</a></li>
                            {{--<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                    Master <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="">Data</a></li>
                                    <li><a href="">Warehouse</a></li>
                                </ul>
                            </li>--}}
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('home/password') }}"><i class="fa fa-btn fa-cog"></i>Change Password</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#reports').DataTable();
        } );

        CKEDITOR.replace('editor');
    </script>
</body>
</html>
