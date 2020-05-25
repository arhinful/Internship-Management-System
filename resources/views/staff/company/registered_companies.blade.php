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

                        @if(count($companies) > 0)

                            <table class="table table-hover"  id="table_list">
                                {{--table head--}}
                                <tr>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Region</th>
                                </tr>
                                @foreach($companies as $company)
                                <!--single employee container-->
                                    <tr class="row_lists">
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->department}}</td>
                                        <td>{{$company->region}}</td>

                                        <td>
                                            <a href="{{route('staff.single_company', ['id'=>$company->id])}}">
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
