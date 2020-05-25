<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- linking Styles -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    <script src="/js/plugins/fullclip.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .fullBackground {
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
        }

        .content {
            position: absolute;
            top: 30%;
        }
        .btn_container{
        }
        .icons{
            width: 20%;
        }

    </style>
</head>
<body>

<div>


    <!-- staff login start -->
    <div class="modal fade" id="staff_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  bg-transparent" role="document">
            <div class="modal-content  bg-transparent">
                <div class="modal-body bg-dark" style="border-radius: 5px">
                    <!-- Close Button -->
                    <div class="bg-primary text-white text-center pb-2 pt-2 mb-4"><h3>Staff Login</h3></div>
                    <form class="row pl-5 pr-5" method="post" action="{{ route('staff.login') }} ">
                        @csrf
                        <label class="col-12 text-center text-white" style="font-size: 16px">Email</label>
                        <input type="email" name="email" class="form-control mb-4">

                        <label class="col-12 text-center text-white" style="font-size: 16px">Password</label>
                        <input type="password" name="password" class="form-control mb-4">

                        <div class="col-12 mb-4">
                            <label class="mr-1 text-white">Remember me</label>
                            <input type="checkbox" name="remember">
                        </div>

                        <button class="col-6 btn btn-success mb-2">Login</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- staff login End -->


    <!-- company login start -->
    <div class="modal fade" id="company_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  bg-transparent" role="document">
            <div class="modal-content  bg-transparent">
                <div class="modal-body bg-dark" style="border-radius: 5px">
                    <!-- Close Button -->
                    <div class="bg-primary text-white text-center pb-2 pt-2 mb-4"><h3>Company Login</h3></div>
                    <form method="POST" action="{{ route('company.login') }}" class="row pl-5 pr-5">
                        @csrf
                        <label class="col-12 text-center text-white" style="font-size: 16px">Email</label>
                        <input type="email" name="email" class="form-control mb-4">

                        <label class="col-12 text-center text-white" style="font-size: 16px">Password</label>
                        <input type="password" name="password" class="form-control mb-4">

                        <div class="col-12 mb-4">
                            <label class="mr-1 text-white">Remember me</label>
                            <input type="checkbox" name="remember">
                        </div>

                        <button class="col-6 btn btn-success mb-4">Login</button>

                        <div class="col-12 nav-link">
                            <a href="{{route('company.register')}}">Register Company Here</a>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- company login End -->


    <!-- student login start -->
    <div class="modal fade" id="student_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-body" style="border-radius: 5px">
                    <!-- Close Button -->
                    <div class="bg-primary text-white text-center pb-2 pt-2 mb-4"><h3>Student Login</h3></div>
                    <form class="row pl-5 pr-5" method="POST" action="{{ route('student.login') }}">
                        @csrf
                        <label class="col-12 text-center" style="font-size: 16px">Index Number</label>
                        <input type="number" name="index_number" class="form-control mb-4">

                        <label class="col-12 text-center" style="font-size: 16px">Password</label>
                        <input type="password" name="password" class="form-control mb-4">

                        <div class="col-12 mb-4">
                            <label class="mr-1">Remember me</label>
                            <input type="checkbox" name="remember">
                        </div>

                        <button class="col-6 btn btn-success mb-2">Login</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!-- student login End -->


    <div class="fullBackground">
        <div class="intro pt-2 bg-dark text-white text-center">
            <img class="col-4" src="images/bg/stu_logo.png" style="width: 100px">
            <span class="h2">Welcome to STU Internship Management System</span>
        </div>
        <div class="content row ml-1" style="width: 99%">

            <div class="btn_container col-12 text-center text-md-right col-md-4 col-sm-12" data-toggle="modal" data-target="#staff_form">
                <img class="icons" src="images/bg/stu_logo.png"><br>
                <button class="btn btn-primary mt-2 w-50 font-weight-bold" style="font-size: 150%">
                    Staff >>
                </button>

            </div>

            <div class="btn_container col-12 text-center text col-md-4 col-sm-12" data-toggle="modal" data-target="#company_form">
                <img class="icons" src="images/bg/stu_logo.png"><br>
                <button class="btn btn-primary mt-2 w-50 font-weight-bold" style="font-size: 150%">
                    Company >>
                </button>
            </div>

            <div class="btn_container col-12 text-center text-md-left col-md-4 col-sm-12" data-toggle="modal" data-target="#student_form">
                <img class="icons" src="images/bg/stu_logo.png"><br>
                <button class="btn btn-primary mt-2 w-50 font-weight-bold" style="font-size: 150%">
                    Student >>
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {

        $('.fullBackground').fullClip({
            images: ['/images/bg/1.jpg', '/images/bg/2.jpg', '/images/bg/3.jpg', '/images/bg/4.jpg'],
            transitionTime: 2000,
            wait: 5000
        })
    })
</script>
</body>
</html>
