@extends('layouts.app')
@section('title', 'Barcode List')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        <b>Barcode</b>
                    </h1>
                {{--
                                <hr> --}}


                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#store">Barcode List &nbsp;<i class="fa fa-barcode"></i></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addstore">Add Staff &nbsp;<i class="fa fa-plus"></i></a>
                        </li> --}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="store" class="tab-pane active"><br>
                            <table class="table table-striped table-bordered">
                                <thead class="thead-inverse">
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Product Name</th>
                                    <th style="text-align: center">QTY</th>
                                    <th style="text-align: center">Cost Price</th>
                                    <th style="text-align: center">Selling Price</th>
                                    <th style="text-align: center">Barcode No.</th>
                                    <th style="text-align: center">Download</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($barcode as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td><b>{{ ucwords($item->product->name) }}</b></td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->cp }}</td>
                                        <td><b>{{ $item->sp }}</b></td>
                                        <td><b>{{ $item->barcode }}</b></td>
                                        <td><a target="_blank" href="{{ url('allbarcode').'/'.$item->pdf }}"><button class="btn btn-success btn-sm btn-block">Download</button></a></td>
                                        {{-- <td>{{ date('d-M-Y', strtotime($item->created_date)) }}</td>
                                        <td>
                                            <a href="{{ url('edit_staff').'/'.base64_encode($item->id)}}">
                                                <button class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                            <button onclick="del_staff({{ $item->id }});" class="btn btn-danger btn-sm">Delete</button>
                                        </td> --}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
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