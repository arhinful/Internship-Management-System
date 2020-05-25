@extends('company.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row card">
                    <div class="card-header">
                        <div class="row ">
                            <div class="col-6">
                                <h4>All Enrolled Student</h4>
                            </div>
                            <div class="col-6">
                                <input id="search" placeholder="search" type="search" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row card-body col-12">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-12">
                            @if(count($students) > 0)

                                <table class="table table-hover"  id="table_list">
                                    <tr>
                                        <th>First name</th>
                                        <th>Other name</th>
                                        <th>Second name</th>
                                        <th>Started On</th>
                                        <th>Ended On</th>
                                        <th></th>
                                    </tr>

                                    @foreach($students as $student)

                                        <tr class="row_lists">
                                            <td>{{$student->first_name}}</td>
                                            <td>{{$student->other_name}}</td>
                                            <td>{{$student->second_name}}</td>
                                            <td>{{date('l, dS F, Y', strtotime($student->attachment_start))}}</td>
                                            <td>{{date('l, dS F, Y', strtotime($student->attachment_end))}}</td>
                                            <td>
                                                <a href="{{route('company.student_details', ['id'=>$student->id])}}" class="btn btn-primary">Details</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>

                            @else
                                <h4>No Student Available</h4>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{route('company.all_enrolled_student')}}" class="btn btn-dark">Current Students</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        //search for an student
        $('#search').on('keyup', function () {
            var value = $(this).val().toLowerCase()

            $('#table_list tr.row_lists').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            })
        })
    </script>
@endsection
