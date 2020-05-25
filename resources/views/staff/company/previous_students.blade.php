@extends('staff.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row ">
                            <div class="col-4">
                                <h4>All Students</h4>
                            </div>
                            <div class="col-6">
                                <input id="search" placeholder="search" type="search" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(count($students) > 0)

                            <table class="table table-hover"  id="table_list">
                                {{--table head--}}
                                <tr>
                                    <th>Name</th>
                                    <th>Score</th>
                                    <th>Index Number</th>
                                    <th>Course</th>
                                </tr>
                                @foreach($students as $student)
                                <!--single employee container-->
                                    <tr class="row_lists">
                                        <td>{{$student->first_name}} {{$student->other_name}} {{$student->second_name}}</td>
                                        <td>{{$student->score}}</td>
                                        <td>0{{$student->index_number}}</td>
                                        <td>{{$student->course}}</td>

                                        <td>
                                            <a href="{{route('staff.single_student', ['id'=>$student->id])}}">
                                                more
                                            </a>
                                        </td>
                                    </tr>
                                    {{--end of single employee container--}}
                                @endforeach
                            </table>
                        @else
                            <h4>No Student Added Yet</h4>
                        @endif

                    </div>
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
