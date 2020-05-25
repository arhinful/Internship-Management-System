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
                                        <th>Index Number</th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                                    @foreach($students as $student)

                                        <tr class="row_lists">
                                            <td>{{$student->first_name}}</td>
                                            <td>{{$student->other_name}}</td>
                                            <td>{{$student->second_name}}</td>
                                            <td>0{{$student->index_number}}</td>
                                            <td>
                                                <a href="{{route('company.student_details', ['id'=>$student->id])}}" class="btn btn-primary">Details</a>
                                            </td>
                                            <td>
                                                @if($student->act_taken == true)
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#{{$student->first_name.$student->index_number}}">Update Act.</button>

                                                    {{--form to submit--}}
                                                    <div class="modal fade" id="{{$student->first_name.$student->index_number}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered bg-transparent" role="document">
                                                            <div class="modal-content  bg-transparent">
                                                                <div class="modal-body bg-dark" style="border-radius: 5px">
                                                                    <!-- Close Button -->
                                                                    <div class="text-center pb-2 pt-2 mb-4 text-white">
                                                                        <h4>Update Today's Act. Assigned to {{$student->first_name}}</h4>
                                                                        <hr style="background-color: white">
                                                                    </div>
                                                                    <form class="row ml-5 mr-2 mt-4 col-12" method="post" action="{{route('company.update_act')}}">
                                                                        @csrf
                                                                        <div class="row col-12">
                                                                            <div class="col-12 text-white"><h5>Update Act. assigned to student</h5></div>
                                                                            <input type="hidden" name="act_id" value="{{$student->activity_id}}">
                                                                            <textarea rows="6" name="act_assigned" class="col-12 form-control">{{$student->activity_done}}</textarea>
                                                                        </div>
                                                                        <div class="mt-5 col-12">
                                                                            <button type="submit" class="btn btn-success w-50">Save</button>
                                                                        </div>
                                                                    </form>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--end of form--}}

                                                    @else
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#{{$student->first_name.$student->index_number}}">Act.</button>

                                                    {{--form to submit--}}
                                                    <div class="modal fade" id="{{$student->first_name.$student->index_number}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered bg-transparent" role="document">
                                                            <div class="modal-content  bg-transparent">
                                                                <div class="modal-body bg-dark" style="border-radius: 5px">
                                                                    <!-- Close Button -->
                                                                    <div class="text-center pb-2 pt-2 mb-4 text-white">
                                                                        <h4>Today's Act. Assigned to {{$student->first_name}}</h4>
                                                                        <hr style="background-color: white">
                                                                    </div>
                                                                    <form class="row ml-5 mr-2 mt-4 col-12" method="post" action="{{route('company.add_act')}}">
                                                                        @csrf
                                                                        <div class="row col-12">
                                                                            <div class="col-12 text-white"><h5>Act. assigned to student</h5></div>
                                                                            <input type="hidden" name="student_id" value="{{$student->id}}">
                                                                            <input type="hidden" name="company_id" value="{{$company->id}}">
                                                                            <textarea rows="6" name="act_assigned" class="col-12 form-control"></textarea>
                                                                        </div>
                                                                        <div class="mt-5 col-12">
                                                                            <button type="submit" class="btn btn-success w-50">Save</button>
                                                                        </div>
                                                                    </form>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--end of form--}}

                                                @endif
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
                    <a href="{{route('company.previous_students')}}" class="btn btn-dark">Previous Students</a>
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
