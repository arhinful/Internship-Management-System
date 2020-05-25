@extends('staff.layouts.app')

@section('content')
    <div class="container" style="overflow-scrolling: auto;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">SETTINGS</div>

                    <div class="row card-body">

                        <form method="POST" action="{{route('staff.update_settings')}}" class="row col-12 mb-3">
                            @csrf
                            <div class="row col-12">
                                <label class="col-6">Attachment Period</label>
                                <select name="attachment_period" class="col-6 form-control">
                                    <option value="30" {{ $settings->attachment_period == 30 ? 'selected' : '' }} >1 Month (30 days)</option>
                                    <option value="45" {{ $settings->attachment_period == 45 ? 'selected' : '' }} >1 and half Month (45 days)</option>
                                    <option value="60" {{ $settings->attachment_period == 60 ? 'selected' : '' }} >2 Months (60 days)</option>
                                    <option value="75" {{ $settings->attachment_period == 75 ? 'selected' : '' }}>2 and half Months (75 days)</option>
                                    <option value="120" {{ $settings->attachment_period == 120 ? 'selected' : '' }} >3 Months (120 days)</option>
                                </select>
                            </div>
                            <div class="row col-12 mt-4">
                                <label class="col-6">Students Per Page</label>
                                <select name="students_pp" class="col-6 form-control">
                                    <option value="8" {{ $settings->students_pp == 8 ? 'selected' : '' }} >8</option>
                                    <option value="15" {{ $settings->students_pp == 15 ? 'selected' : '' }} >15</option>
                                    <option value="25" {{ $settings->students_pp == 25 ? 'selected' : '' }}>25</option>
                                    <option value="40" {{ $settings->students_pp == 40 ? 'selected' : '' }} >40</option>
                                    <option value="50" {{ $settings->students_pp == 50 ? 'selected' : '' }} >50</option>
                                    <option value="100" {{ $settings->students_pp == 100 ? 'selected' : '' }} >100</option>
                                </select>
                            </div>
                            <div class="row col-12 mt-3">
                                <button type="submit" class="btn btn-success w-25">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
