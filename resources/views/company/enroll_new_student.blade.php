@extends('company.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row card">
                    <div class="card-header">
                        <div class="row ">
                            <div class="col-6">
                                <h4>Enroll New Student</h4>
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
                                    </tr>

                                    @foreach($students as $student)

                                        {{--form to submit--}}
                                        <div class="modal fade" id="{{$student->first_name.$student->index_number}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered  bg-transparent" role="document">
                                                <div class="modal-content  bg-transparent">
                                                    <div class="modal-body bg-dark" style="border-radius: 5px">
                                                        <!-- Close Button -->
                                                        <div class="text-center pb-2 pt-2 mb-4 text-white">
                                                            <h4>Enroll {{$student->first_name}} {{$student->other_name}} {{$student->second_name}}?</h4>
                                                        </div>
                                                        <form class="row ml-5 mr-2 mt-4" method="post" action="{{route('company.enroll_student')}}">
                                                            @csrf
                                                            <input type="hidden" value="{{$student->id}}" name="student_id">
                                                            <input type="hidden" value="{{$company->name}}" name="attachment_company_name">
                                                            <input type="hidden" value="{{$company->id}}" name="attachment_company_id">
                                                            <div class="row col-12">
                                                                <button class="btn btn-success col-5 mr-2" type="submit">Yes</button>
                                                                <button class="btn btn-danger col-5 ml-2" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </form>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--end of form--}}

                                        <tr class="row_lists">
                                            <td>{{$student->first_name}}</td>
                                            <td>{{$student->other_name}}</td>
                                            <td>{{$student->second_name}}</td>
                                            <td>0{{$student->index_number}}</td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#{{$student->first_name.$student->index_number}}">Enroll</button>
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
