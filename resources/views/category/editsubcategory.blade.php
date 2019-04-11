@extends('layouts.app') 
@section('title', 'Edit Category') 
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg mybg">
                <h1>
                    Edit <b>Sub-Category</b>
                </h1>
                
                <hr>


                <!-- Nav tabs -->
                <form action="{{ url('update_sub_category').'/'.$edit->id }}" method="GET" id="update_sub_category">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Category</label>
                                    {{-- <input type="text" name="name" autocomplete="off" class="form-control required" placeholder="Enter Category Name"> --}}
                                    <select name="p_id" id="p_id" class="form-control requiredDD">
                                        <option value="">Select Category</option>
                                        @foreach ($catlist as $obj)
                                        @if($obj->id == $edit->parent_id)
                                        <option value="{{ $obj->id }}" selected>{{ ucwords($obj->name) }}</option>
                                        @else
                                        <option value="{{ $obj->id }}">{{ ucwords($obj->name) }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Name</label>
                                    <input type="text" name="name" value="{{ $edit->name }}" autocomplete="off" class="form-control required" placeholder="Enter Name">
                                </div>
                            </div>
                          
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary pull-left">Update Sub-Category &nbsp;<i class="fa fa-step-forward"></i></button>
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