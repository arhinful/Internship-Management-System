@extends('company.layouts.app')

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

                        <form action="#" method="POST" class="col-12">

                            @csrf
                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    First Name
                                </div>
                                <div class="col-6">
                                    {{$student->first_name}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Other Name
                                </div>
                                <div class="col-6">
                                    {{$student->other_name}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Second Name
                                </div>
                                <div class="col-6">
                                    {{$student->second_name}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Index Number
                                </div>
                                <div class="col-6">
                                    0{{$student->index_number}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Course
                                </div>
                                <div class="col-6">
                                    {{$student->course}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Level
                                </div>
                                <div class="col-6">
                                    {{$student->level}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Email
                                </div>
                                <div class="col-6">
                                    {{$student->email}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Started Attachment On
                                </div>
                                <div class="col-6">
                                    {{date('l, dS F, Y', strtotime($student->attachment_start))}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Ending Attachment On
                                </div>
                                <div class="col-6">
                                    {{date('l, dS F, Y', strtotime($student->attachment_end))}}
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







                            {{--form to submit--}}
                            <div class="modal fade" id="score_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  bg-transparent" role="document">
                                    <div class="modal-content  bg-transparent">
                                        <div class="modal-body bg-dark" style="border-radius: 5px">
                                            <!-- Close Button -->
                                            <div class="text-center pb-2 pt-2 mb-4 text-white">
                                                <h4>Give Score to {{strtoupper($student->first_name)}}</h4>
                                            </div>
                                            <form class="row ml-5 mr-2 mt-4" method="post" action="{{route('company.enroll_student')}}">
                                                @csrf
                                                <input type="hidden" value="{{$student->id}}" name="student_id">
                                                <div class="mb-3">
                                                    <label class="text-white h5">Score</label>
                                                    <input type="text" name="score" value="{{$student->score}}" class="form-control w-75">
                                                </div>
                                                <div class="row col-12">
                                                    @if($student->score == null)
                                                        <button class="btn btn-success col-5 mr-2" type="submit">Submit</button>
                                                        @else
                                                            <button class="btn btn-success col-5 mr-2" type="submit">Update</button>
                                                    @endif
                                                    <button class="btn btn-danger col-5 ml-2" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--end of form--}}








                                <div class="col-6 mt-5">
                                    @if($is_current == true)
                                        @if($cgs == true)
                                            @if($student->score == null)
                                                <a data-toggle="modal" data-target="#score_modal" id="update_btn" type="submit" class="text-white btn btn-success ml-3 w-75">Give Score</a>
                                                @else
                                                    <a data-toggle="modal" data-target="#score_modal" id="update_btn" type="submit" class="text-white btn btn-success ml-3 w-75">Update Score</a>
                                            @endif

                                            @else
                                                <a id="update_btn" type="submit" class="disabled text-white btn btn-success ml-3 w-75">Give Score</a><br>
                                                <span class="small text-danger font-italic ml-3">attachment period is not over yet</span>
                                        @endif
                                    @endif
                                </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection
