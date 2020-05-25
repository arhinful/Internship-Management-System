@extends('staff.layouts.app')

@section('content')
    <div class="container" style="overflow-scrolling: auto;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{strtoupper($company->name)}}'S DETAILS</div>

                    <div class="row card-body">

                        <div class="row col-12 mb-3">
                            <label class="col-6">Company Name</label>
                            <span class="col-6">{{$company->name}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Email</label>
                            <span class="col-6">{{$company->email}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Region</label>
                            <span class="col-6">{{$company->region}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">District</label>
                            <span class="col-6">{{$company->district}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Department</label>
                            <span class="col-6">{{$company->department}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Postal Address</label>
                            <span class="col-6">{{$company->postal_address}}</span>
                        </div>

                        <div class="row col-12 mb-3">
                            <label class="col-6">Joined On</label>
                            <span class="col-6">{{date('l, dS F, Y', strtotime($company->created_at))}}</span>
                        </div>

                        <div class="row col-12">
                            <div class="col-6">
                                <a href="{{route('staff.previous_students', ['company_id'=>$company->id])}}" class="btn btn-success">Previous Enrolled Students</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('staff.current_students', ['company_id'=>$company->id])}}" class="btn btn-primary">Currently Enrolled Students</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
