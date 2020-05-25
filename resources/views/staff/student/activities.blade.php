@extends('staff.layouts.app')

@section('content')
    <div class="container" style="overflow-scrolling: auto;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{strtoupper($student->first_name)}} {{strtoupper($student->other_name)}} {{strtoupper($student->second_name)}}'S ACTIVITIES</div>

                    <div class="row card-body">

                        @if(count($activities) > 0)
                            <table class="table table-hover"  id="table_list">
                                {{--table head--}}
                                <tr>
                                    <th>Date</th>
                                    <th>Activity</th>
                                    <th>
                                        <a href="{{route('staff.single_student', ['id'=>$student->id])}}">
                                            More About {{$student->first_name}}
                                        </a>
                                    </th>
                                </tr>
                                @foreach($activities as $activity)
                                <!--single employee container-->
                                    <tr class="row_lists">
                                        <td>{{ date('l, dS F, Y', strtotime($activity->created_at)) }}</td>
                                        <td>{{$activity->act_assigned}}</td>
                                        <td></td>
                                    </tr>
                                    {{--end of single employee container--}}
                                @endforeach
                            </table>
                            @else
                                <span>No Activity Yet</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
