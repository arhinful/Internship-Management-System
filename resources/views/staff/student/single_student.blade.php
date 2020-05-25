@extends('staff.layouts.app')

@section('content')
    <div class="container" style="overflow-scrolling: auto;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{strtoupper($student->first_name)}} {{strtoupper($student->other_name)}} {{strtoupper($student->second_name)}}'S DETAILS</div>

                    <div class="row card-body">

                        <div class="row col-12 mb-3">
                            <label class="col-6">First Name</label>
                            <span class="col-6">{{$student->first_name}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Other Name</label>
                            <span class="col-6">{{$student->other_name}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Second Name</label>
                            <span class="col-6">{{$student->second_name}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Index Number</label>
                            <span class="col-6">0{{$student->index_number}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Level</label>
                            <span class="col-6">{{$student->level}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Course</label>
                            <span class="col-6">{{$student->course}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Email</label>
                            @if($student->email == null)
                                <span class="col-6">---------------------</span>
                                @else
                                    <span class="col-6">{{$student->email}}</span>
                            @endif
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Started Attachment On</label>
                            @if($student->attachment_start == null)
                                <span class="col-6">---------------------</span>
                                @else
                                    <span class="col-6">{{date('l, dS F, Y', strtotime($student->attachment_start))}}</span>
                            @endif
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Ending Attachment On</label>
                            @if($student->attachment_end == null)
                                <span class="col-6">---------------------</span>
                                @else
                                    <span class="col-6">{{date('l, dS F, Y', strtotime($student->attachment_end))}}</span>
                            @endif
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Added On</label>
                            <span class="col-6">{{date('l, dS F, Y', strtotime($student->created_at))}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Made an Update On</label>
                            <span class="col-6">{{date('l, dS F, Y', strtotime($student->updated_at))}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Score</label>
                            @if($student->score == null)
                                <span class="col-6">---------------------</span>
                                @else
                                    <span class="col-6">{{$student->score}} ( A+ )</span>
                            @endif
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Attachment Company</label>
                            @if($student->attachment_company == null)
                                <span class="col-6">---------------------</span>
                                @else
                                    <span class="col-6">{{$student->attachment_company}}</span>
                            @endif
                        </div>

                        <div class="row col-12">
                            <div class="col-6">
                                <a href="{{route('staff.activities', ['id'=>$student->id])}}" class="btn btn-warning border border-dark">Activities</a>
                            </div>

                            <div class="col-6">
                                <a href="{{url('storage/reports/'.$student->report) }}" disabled class="btn btn-success">View Report (pdf)</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
