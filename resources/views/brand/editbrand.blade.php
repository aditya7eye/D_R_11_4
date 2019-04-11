@extends('layouts.app')
@section('title', 'Edit Brand')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center m-t-lg mybg">
                    <h1>
                        <b>Vendor</b>
                    </h1>

                    <hr>


                    <!-- Nav tabs -->
                    <form action="{{ url('update_brand').'/'.$edit->id }}" method="GET" id="update_vendor">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" class="pull-left">Brand Name</label>
                                    <input type="text" name="name"
                                           value="{{ $edit->name }}"
                                           autocomplete="on"
                                           class="form-control required"
                                           placeholder="Enter Brand Name">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-left">Update Brand &nbsp;<i class="fa fa-thumbs-up"></i></button>
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
            $.get('{{ url('check_store_username') }}', {
                username: username
            }, function (data) {
                if(data == 'Not Available')
                {
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

    </script>
@endsection