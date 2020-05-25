@extends('company.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="row card-header-pills text-center">
                        <div class="col-6">
                            <h4>Profile</h4>
                        </div>
                        <div class="col-6">
                            <button data-toggle="modal" data-target="#change_password_modal" class="btn btn-light text-primary">Change Password</button>
                        </div>
                    </div>






                    {{--form to submit--}}
                    <div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered bg-transparent" role="document">
                            <div class="modal-content  bg-transparent">
                                <div class="modal-body bg-dark" style="border-radius: 5px">
                                    <!-- Close Button -->
                                    <div class="text-center pb-2 pt-2 mb-4 text-white">
                                        <h4>Change Password</h4>
                                        <hr style="background-color: white">
                                    </div>
                                    <form class="row ml-5 mr-2 mt-3 col-12" method="post" action="{{route('company.change_password')}}">
                                        @csrf
                                        <div class="row col-12">
                                            <input type="hidden" name="id" value="{{$company->id}}">

                                            <div class="col-12 mt-3">
                                                <label class="text-white">Old Password</label>
                                                <input required name="old_password" type="password" class="form-control bg-transparent text-white">
                                            </div>
                                            <div class="col-12 mt-3">
                                                <label class="text-white">New Password</label>
                                                <input required name="new_password" type="password" class="form-control bg-transparent text-white">
                                            </div>
                                            <div class="col-12 mt-3">
                                                <label class="text-white">Confirm Password</label>
                                                <input required name="confirm_password" type="password" class="form-control bg-transparent text-white">
                                            </div>
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






                    <hr>
                    <div class="row card-body">

                        <form action="{{route('company.update')}}" method="POST" class="col-12">

                            @csrf
                            <input type="hidden" name="company_id" value="{{$company->id}}">
                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Company Name
                                </div>
                                <div class="col-6">
                                    <input id="name" name="name" class="form-control" type="text" value="{{$company->name}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Email
                                </div>
                                <div class="col-6">
                                    <input id="email" name="email" class="form-control" type="text" value="{{$company->email}}" >
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Region
                                </div>
                                <div class="col-6">
                                    <select id="region" name="region" class="form-control">
                                        <option>Bono Region</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    District
                                </div>
                                <div class="col-6">
                                    <select id="district" name="district" class="form-control">
                                        <option>Sunyani West</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Department
                                </div>
                                <div class="col-6">
                                    <input id="department" type="text" class="form-control" name="department" value="{{$company->department}}">
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Postal Address
                                </div>
                                <div class="col-6">
                                    <textarea id="postal_address" name="postal_address" cols="30" rows="4">{{$company->postal_address}}</textarea>
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Added On
                                </div>
                                <div class="col-6">
                                    {{date('l, dS F, Y', strtotime($company->created_at))}}
                                </div>
                            </div>

                            <div class="row col-12 mb-3">
                                <div class="col-4">
                                    Last Update
                                </div>
                                <div class="col-6">
                                    {{date('l, dS F, Y', strtotime($company->updated_at))}}
                                </div>
                            </div>

                            <div class="col-6 mt-5">
                                <button id="update_btn" type="submit" class="btn btn-success ml-3 w-75" style="display: none">Update</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var name = $('#name').val()
            var email = $('#email').val()
            var region = $('#region').val()
            var district = $('#district').val()
            var department = $('#department').val()
            var postal_address = $('#postal_address').val()
            var password = $('#password').val()

            setInterval(function () {
                var new_name = $('#name').val()
                var new_email = $('#email').val()
                var new_region = $('#region').val()
                var new_district = $('#district').val()
                var new_department = $('#department').val()
                var new_postal_address = $('#postal_address').val()
                var new_password = $('#password').val()

                if(name != new_name || email != new_email || region != new_region || district != new_district || department != new_department || postal_address != new_postal_address || password != new_password){
                    $('#update_btn').show()
                }
                else {
                    $('#update_btn').hide()
                }
                console.log('good')
            }, 1000)

        })
    </script>
@endsection

