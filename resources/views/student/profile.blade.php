@extends('student.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header-pills text-center">
                        <h4>Profile</h4>
                        <hr>
                    </div>
                    <div class="row card-body">

                        <form action="{{route('student.update')}}" method="POST" class="col-12">

                            @csrf
                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    First Name
                                </div>
                                <div class="col-6">
                                    <input id="first_name" name="first_name" class="form-control" type="text" value="{{$student->first_name}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Other Name
                                </div>
                                <div class="col-6">
                                    <input id="other_name" name="other_name" class="form-control" type="text" value="{{$student->other_name}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Second Name
                                </div>
                                <div class="col-6">
                                    <input id="second_name" name="second_name" class="form-control" type="text" value="{{$student->second_name}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Index Number
                                </div>
                                <div class="col-6">
                                    <input id="index_number" name="index_number" class="form-control" type="text" value="0{{$student->index_number}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Course
                                </div>
                                <div class="col-6">
                                    <select disabled="disabled" class="form-control">
                                        <option value="{{$student->course}}">HND IT</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Level
                                </div>
                                <div class="col-6">
                                    <select id="level" name="level" class="form-control">
                                        @if($student->level=='300')
                                            <option selected value="300">300</option>
                                            <option value="200">200</option>
                                            <option value="100">100</option>
                                            @elseif($student->level=='200')
                                                <option value="300">300</option>
                                                <option selected value="200">200</option>
                                                <option value="100">100</option>
                                            @else
                                                <option value="300">300</option>
                                                <option value="200">200</option>
                                                <option selected value="100">100</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Email
                                </div>
                                <div class="col-6">
                                    <input id="email" name="email" class="form-control" type="email" value="{{$student->email}}" >
                                    @if($student->email == null)
                                        <span class="text-danger font-italic small">(you have to provide your email)</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Started Attachment On
                                </div>
                                <div class="col-6">
                                    @if($student->attachment_start != null)
                                        {{date('l, dS F, Y', strtotime($student->attachment_start))}}
                                        @else
                                            <span class="text-danger">Not Yet</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Ending Attachment On
                                </div>
                                <div class="col-6">
                                    @if($student->attachment_end != null)
                                        {{date('l, dS F, Y', strtotime($student->attachment_end))}}
                                    @else
                                        <span class="text-danger">Not Yet</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Score
                                </div>
                                <div class="col-6">
                                    @if($student->score !=null)
                                        <span class="font-weight-bold">{{$student->score}}</span>
                                        @else
                                            <span class="text-danger">Not Yet</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Attachment Company
                                </div>
                                <div class="col-6">
                                    @if($student->attachment_company != null)
                                        {{$student->attachment_company}}
                                        @else
                                            <span class="text-danger">Not Yet</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Password
                                </div>
                                <div class="col-6">
                                    <input id="password" name="password" class="form-control" type="text" value="{{$student->password}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Added On
                                </div>
                                <div class="col-6">
                                    {{date('l, dS F, Y', strtotime($student->created_at))}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Last Update
                                </div>
                                <div class="col-6">
                                    {{date('l, dS F, Y', strtotime($student->updated_at))}}
                                </div>
                            </div>

                            <div class="col-6 mt-5">
                                <button id="update_btn" type="submit" class="btn btn-success ml-3 w-75" style="display: none">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var first_name = $('#first_name').val()
            var other_name = $('#other_name').val()
            var second_name = $('#second_name').val()
            var index_number = $('#index_number').val()
            var level = $('#level').val()
            var email = $('#email').val()
            var password = $('#password').val()

            setInterval(function () {
                var new_first_name = $('#first_name').val()
                var new_other_name = $('#other_name').val()
                var new_second_name = $('#second_name').val()
                var new_index_number = $('#index_number').val()
                var new_level = $('#level').val()
                var new_email = $('#email').val()
                var new_password = $('#password').val()

                if(first_name != new_first_name || other_name != new_other_name || second_name != new_second_name || index_number != new_index_number || level != new_level || email != new_email || password != new_password){
                    $('#update_btn').show()
                }
                else {
                    $('#update_btn').hide()
                }
                console.log('good')
            }, 1000)

        })
    </script>
@endsection
