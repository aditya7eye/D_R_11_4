@extends('layouts.app')
@section('title', 'Staff')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        <b>Staff</b>
                    </h1>
                {{--
                                <hr> --}}


                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#store">Staff Member List &nbsp;<i class="fa fa-user-md"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addstore">Add Staff &nbsp;<i class="fa fa-plus"></i></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="store" class="tab-pane active"><br>
                            <table class="table table-striped table-bordered">
                                <thead class="thead-inverse">
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Branch Name</th>
                                    <th style="text-align: center">Staff Name</th>
                                    <th style="text-align: center">Contact</th>
                                    <th style="text-align: center">Email Address</th>
                                    <th style="text-align: center">Username</th>
                                    <th style="text-align: center">Password</th>
                                    <th style="text-align: center">Joined On</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($stafflist as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ ucwords($item->branch->name) }}</td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>{{ $item->contact }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td><b>{{ $item->username }}</b></td>
                                        <td><b>{{ $item->password }}</b></td>
                                        <td>{{ date('d-M-Y', strtotime($item->created_date)) }}</td>
                                        <td>
                                            <a href="{{ url('edit_staff').'/'.base64_encode($item->id)}}">
                                                <button class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                            <button onclick="del_staff({{ $item->id }});" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <div id="addstore" class="tab-pane fade"><br>
                            <form action="{{ url('insert_staff') }}" method="GET" id="insert_store">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="username" class="pull-left">Username *</label>
                                            <input type="text"
                                                   name="username"
                                                   maxlength="25"
                                                   id="username"
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
                                                   autocomplete="off"
                                                   class="form-control required"
                                                   placeholder="Enter Email ID">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-left">Register Staff Member&nbsp;
                                                <i class="fa fa-user-md"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
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

        function del_staff(id)
        {
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Store",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    $.get('{{ url('del_staff') }}', {
                        did: id
                    }, function (data) {


                        // return false;
                        setTimeout(function () {
                            Swal.fire({
                                position: 'bottom',
                                title: 'Store has Been Deleted',
                                showConfirmButton: false,
                                timer: 1200,
                                animation: false,
                                customClass: {
                                    popup: 'animated fadeInDown'
                                }
                            })
                        }, 500);
                        setTimeout(function(){ location.reload(); }, 1000);

                        //     console.log(data);
                        //    alert(data);
                    });
                }
            })
        }
    </script>
@endsection