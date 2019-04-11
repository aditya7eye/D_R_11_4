@extends('layouts.app')
@section('title', 'Units')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        <b>Units</b>
                    </h1>
                {{--
                                <hr> --}}


                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#store">Unit's List &nbsp;
                            <i class="fa fa-universal-access"></i>
                                </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addstore">Add Unit &nbsp;<i
                                        class="fa fa-plus"></i></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="store" class="tab-pane active"><br>
                            <table class="table table-striped table-bordered">
                                <thead class="thead-inverse">
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    {{--<th style="text-align: center">Created On</th>--}}
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($unit as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ ucwords($item->unit) }}</td>
                                        {{--<td>--}}
                                            {{--{{ date('d-M-Y', strtotime($item->created_date)) }}--}}
                                        {{--</td>--}}
                                        <td>
                                            <a href="{{ url('edit_unit').'/'.base64_encode($item->id)}}">
                                                <button class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                            <button onclick="del_unit({{ $item->id }});"
                                                    class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div id="addstore" class="tab-pane fade"><br>
                            <form action="{{ url('insert_unit') }}" method="GET" id="insert_store">
                                <div class="row">

                                    {{--<div class="col-sm-3"></div>--}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Unit</label>
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control required"
                                                   maxlength="15"
                                                   placeholder="e.g. gram / kilogram etc.">

                                        </div>
                                    </div>
                                    {{--<div class="col-sm-4"></div>--}}

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-left">Create Unit &nbsp;<i
                                                        class="fa fa-universal-access"></i></button>
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
        $("#username").focusout(function () {
            var username = $('#username').val();
            $.get('{{ url('check_store_username') }}', {
                username: username
            }, function (data) {
                if (data == 'Not Available') {
                    $('#username').val('');
                    // return false;
                    setTimeout(function () {
                        Swal.fire({
                            position: 'bottom',
                            title: 'Username Not Available',
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

        function del_unit(id) {
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
                    $.get('{{ url('del_unit') }}', {
                        did: id
                    }, function (data) {
                        // return false;
                        setTimeout(function () {
                            Swal.fire({
                                position: 'bottom',
                                title: 'Vendor information has Been Deleted',
                                showConfirmButton: false,
                                timer: 1200,
                                animation: false,
                                customClass: {
                                    popup: 'animated fadeInDown'
                                }
                            })
                        }, 500);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);

                        //     console.log(data);
                        //    alert(data);
                    });
                }
            })
        }
    </script>
@endsection