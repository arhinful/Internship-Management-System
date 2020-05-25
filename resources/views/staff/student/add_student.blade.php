@extends('staff.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add New Student</div>

                    <div class="card-body">

                        <form method="post" action="{{route('staff.register_student')}}">
                            @csrf
                            {{--first name--}}
                            <label for="first_name">First Name</label>
                            <input name="first_name" type="text" class="form-control w-75 mb-4" name="" id="first_name">

                            {{--second name--}}
                            <label for="second_name">Second Name</label>
                            <input name="second_name" type="text" class="form-control w-75 mb-4" name="" id="second_name">

                            {{--other name--}}
                            <label for="other_name">Other Name</label>
                            <input name="other_name" type="text" class="form-control w-75 mb-4" name="" id="other_name">

                            {{--index number--}}
                            <label for="other_name">Index Number</label>
                            <input name="index_number" type="text" class="form-control w-75 mb-4" name="" id="index_number">

                            {{--level--}}
                            <label>Level</label>
                            <select class="form-control w-75 mb-4" name="level">
                                <option value="300">300</option>
                                <option value="200">200</option>
                                <option value="100">100</option>
                            </select>

                            {{--course--}}
                            <label>Course</label>
                            <select class="form-control w-75 mb-4" name="course">
                                <option value="HND IT">HND IT</option>
                            </select>

                            <button type="submit" class="btn btn-success btn-lg w-50">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
