@extends('layouts.app')
@section('title', 'Vendor')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        <b>Vendor</b>
                    </h1>
                {{--
                                <hr> --}}


                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#store">Vendor List &nbsp;<i
                                        class="fa fa-users"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addstore">Add Vendor &nbsp;<i
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
                                    <th style="text-align: center">Contact</th>
                                    <th style="text-align: center">GST No.</th>
                                    <th style="text-align: center">IGST</th>
                                    <th style="text-align: center">SGST</th>
                                    <th style="text-align: center">CGST</th>
                                    {{--<th style="text-align: center">Created On</th>--}}
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($vendorlist as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>{{ $item->contact }}</td>
                                        <td>{{ $item->gst_no }}</td>
                                        <td>
                                            {{ $item->igst }} %
                                        </td>
                                        <td>{{ $item->sgst }} %</td>
                                        <td>{{ $item->cgst }} %</td>
                                        {{--<td>--}}
                                            {{--{{ date('d-M-Y', strtotime($item->created_date)) }}--}}
                                        {{--</td>--}}
                                        <td>
                                            <a href="{{ url('edit_vendor').'/'.base64_encode($item->id)}}">
                                                <button class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                            <button onclick="del_vendor({{ $item->id }});"
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
                            <form action="{{ url('insert_vendor') }}" method="GET" id="insert_store">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="pull-left">Vendor Name</label>
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control required" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="pull-left">Contact</label>
                                            <input type="tel" name="contact" autocomplete="off"
                                                   class="form-control required" placeholder="Enter Mobile Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="" class="pull-left">GST No.</label>
                                            <input type="text"
                                                   name="gst_no"
                                                   maxlength="25"
                                                   id="gst_no"
                                                   autocomplete="off"
                                                   class="form-control required nospc"
                                                   placeholder="Enter GST Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" class="pull-left">IGST %</label>
                                            <input type="text" name="igst" maxlength="25" id="igst" autocomplete="off"
                                                   class="form-control required nospc" placeholder="Enter IGST %">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" class="pull-left">SGST %</label>
                                            <input type="text" name="sgst" maxlength="25" id="sgst"
                                                   autocomplete="off" class="form-control required nospc"
                                                   placeholder="Enter SGST %">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="" class="pull-left">CGST %</label>
                                            <input type="text" name="cgst" maxlength="25" id="cgst" autocomplete="off"
                                                   class="form-control required nospc" placeholder="Enter CGST %">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-left">Create Vendor &nbsp;<i
                                                        class="fa fa-users"></i></button>
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

        function del_vendor(id) {
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
                    $.get('{{ url('del_vendor') }}', {
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