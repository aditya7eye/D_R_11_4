@extends('layouts.app') 
@section('title', 'Edit Store') 
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg mybg">
                <h1>
                    <b>Store</b>
                </h1>
                
                <hr>


                <!-- Nav tabs -->
                <form action="{{ url('update_store').'/'.$edit->id }}" method="GET" id="update_store">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Store Name</label>
                                    <input type="text" name="name" value="{{ $edit->name }}" autocomplete="off" class="form-control required" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Location</label>
                                    <input type="text" name="location" value="{{ $edit->location }}" autocomplete="off" class="form-control required" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Username</label>
                                    <input type="text" name="username" value="{{ $edit->username }}" maxlength="25" id="username" autocomplete="off" class="form-control required nospc"  placeholder="Enter Name" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Password</label>
                                    <input type="text" maxlength="25" name="password" autocomplete="off" class="form-control required" value="{{ $edit->password }}" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary pull-left">Update Branch &nbsp;<i class="fa fa-home"></i></button>
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