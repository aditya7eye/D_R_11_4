@extends('layouts.app')
@section('title', 'Edit Store')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        Edit <b>Staff</b>
                    </h1>

                    <hr>


                    <!-- Nav tabs -->
                    <form action="{{ url('update_staff').'/'.$edit->id }}" method="GET" id="update_store">
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="username" class="pull-left">Username *</label>
                                        <input type="text"
                                               name="username"
                                               maxlength="25"
                                               id="username"
                                               value="{{$edit->username}}"
                                               autocomplete="off"
                                               class="form-control required nospc"
                                               placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password" class="pull-left">Password *</label>
                                        <input type="password"
                                               maxlength="25"
                                               name="password"
                                               value="{{$edit->password}}"
                                               autocomplete="off"
                                               class="form-control required"
                                               placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name" class="pull-left">Staff Name *</label>
                                        <input type="text"
                                               maxlength="25"
                                               name="name"
                                               value="{{$edit->name}}"
                                               autocomplete="off"
                                               class="form-control required"
                                               placeholder="Enter Staff Name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="contact" class="pull-left">Contact Number *</label>
                                        <input type="text"
                                               maxlength="25"
                                               name="contact"
                                               value="{{$edit->contact}}"
                                               autocomplete="off"
                                               class="form-control required"
                                               placeholder="Enter Mobile Number">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email" class="pull-left">Email Address *</label>
                                        <input type="text"
                                               maxlength="25"
                                               name="email"
                                               value="{{$edit->email}}"
                                               autocomplete="off"
                                               class="form-control required"
                                               placeholder="Enter Email ID">
                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-left">Update Staff Member Detail &nbsp;<i class="fa fa-user-md"></i></button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
    <script>
        $("#username").focusout(function(){
            var username = $('#username').val();
            $.get('{{ url('check_staff_username') }}', {
                username: username
            }, function (data) {
                if(data == 'Not Available')
                {
                    $('#username').val('');
                    // return false;
                    setTimeout(function () {
                        Swal.fire({
                            position: 'bottom',
                            title: 'Username Not Available:(<br>Please Try New Username!',
                            showConfirmButton: false,
                            timer: 1200,
                            animation: false,
                            customClass: {
                                popup: 'animated fadeInDown'
                            }
                        })
                    }, 500);
                }
                //     console.log(data);
                //    alert(data);
            });
        });

    </script>
@endsection