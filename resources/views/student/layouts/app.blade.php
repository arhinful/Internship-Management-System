<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- linking Styles -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    {{--    <script src="/js/plugins/fullclip.js"></script>--}}
    <style>
        body {
            font-size: .875rem;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 48px; /* Height of navbar */
            height: calc(100vh);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }

        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }

        /*
         * Utilities
         */

        .border-top { border-top: 1px solid #e5e5e5; }
        .border-bottom { border-bottom: 1px solid #e5e5e5; }

        .btns:hover{
            background-color: #5a6268;
        }
        #show_nav{
            cursor: pointer;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 col-3 mr-0 bg-primary" href="#">STU</a>
    <span id="show_nav" class="text-white d-block d-md-none w-25 text-center">
            Menu
        </span>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <form method="post" action="{{route('student.logout')}}">
                @csrf
                <button class="text-white btn btn-danger" href="#">Log out</button>
            </form>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="navbar" class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky bg-dark">

                {{--dashboard--}}
                <ul class="nav flex-column mb-2 mt-5">

                    <li class="nav-item">
                        <a class="nav-link text-white btns" href="{{route('student.dashboard')}}">
                            <span data-feather="file-text"></span>
                            <span class="h6 font-weight-bold">Send Report</span>
                        </a>
                    </li>

                </ul>

                {{--profile--}}
                <ul class="nav flex-column mb-2">

                    <li class="nav-item">
                        <a class="nav-link text-white btns" href="{{route('student.profile')}}">
                            <span data-feather="file-text"></span>
                            <span class="h6 font-weight-bold">Profile</span>
                        </a>
                    </li>

                </ul>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2"> @yield('heading') </h1>
                <div class="btn-toolbar mb-2 mb-md-0 font-weight-bold">
                    {{strtoupper($student->first_name)}} {{strtoupper($student->other_name)}} {{strtoupper($student->second_name)}}
                </div>
            </div>

            <div>
                @include('message')
                @yield('content')
            </div>
        </main>
    </div>
</div>


<script>
    $(function () {
        $('#show_nav').click(function () {
            $('#navbar').toggleClass('d-none')
            $('#navbar').toggleClass('col-4')
        })
    })
</script>
</body>
</html>

