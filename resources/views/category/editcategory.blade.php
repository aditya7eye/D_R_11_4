@extends('layouts.app') 
@section('title', 'Edit Category') 
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg mybg">
                <h1>
                    Edit <b>Category</b>
                </h1>
                
                <hr>


                <!-- Nav tabs -->
                <form action="{{ url('update_category').'/'.$edit->id }}" method="GET" id="update_category">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="" class="pull-left">Name</label>
                                    <input type="text" name="name" value="{{ $edit->name }}" autocomplete="off" class="form-control required" placeholder="Enter Name">
                                </div>
                            </div>
                          
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary pull-left">Update Category &nbsp;<i class="fa fa-step-forward"></i></button>
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