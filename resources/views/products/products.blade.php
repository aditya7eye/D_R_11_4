@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        <b>Products</b>
                    </h1>
                {{--
                                <hr> --}}


                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#store">Products List &nbsp;
                                <i class="fa fa-trello"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addstore">Add Products &nbsp;<i
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
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- @foreach ($brand as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>
                                            <a href="{{ url('edit_brand').'/'.base64_encode($item->id)}}">
                                                <button class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                            <button onclick="del_brand({{ $item->id }});"
                                                    class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                            </table>

                        </div>
                        <div id="addstore" class="tab-pane fade"><br>
                            <form action="{{ url('insert_products') }}" method="GET" id="insert_products">
                                <div class="row">

                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Category / Sub-Category</label>
                                            <select class=" typeDD requireDD" name="brand" style="width: 100%;">
                                                <option value="">Select Category / Sub-Category</option>
                                                @foreach ($subcatlist as $item)
                                                <option value="{{ $item->id }}">{{ ucwords($item->name)}}</option> 
                                                   @endforeach
                                               </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Brand Name</label>
                                            <select class=" typeDD requireDD" name="brand" style="width: 100%;">
                                                <option value="">Select Brand</option>
                                                @foreach ($brand as $item)
                                                <option value="{{ $item->id }}">{{ ucwords($item->name)}}</option> 
                                                   @endforeach
                                               </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">product Name</label>
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control required"
                                                   maxlength="15"
                                                   placeholder="Enter Brand Name">

                                        </div>
                                    </div>
                                
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Purchase Price</label>
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control required"
                                                   maxlength="15"
                                                   placeholder="Enter Brand Name">

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Selling Price</label>
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control required"
                                                   maxlength="15"
                                                   
                                                   placeholder="Enter Brand Name">

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Loose / Pack</label>
                                          <select name="loose_pack" id="loose_pack" class="form-control">
                                              <option value="0">Loose</option>
                                              <option value="1">Pcak</option>
                                          </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Stock</label>
                                            <input type="text" name="name" autocomplete="off"
                                                   class="form-control required"
                                                   maxlength="15"
                                                   
                                                   placeholder="Enter Brand Name">

                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Unit</label>
                                          <select name="unit" id="unit" class="form-control">   <option value="">Select unit</option>
                                            @foreach ($unit as $item)
                                            <option value="{{ $item->id }}">{{ ucwords($item->unit)}}</option> 
                                               @endforeach
                                          </select>

                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-left">Create Products &nbsp;<i
                                                        class="fa fa-trello"></i></button>
                                        </div>
                                    </div> --}}
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

        function del_brand(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Brand",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.get('{{ url('del_brand') }}',{
                        did: id
                    }, function (data) {
                        // return false;
                        setTimeout(function () {
                            Swal.fire({
                                position: 'bottom',
                                title: 'Brand has Been Deleted',
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