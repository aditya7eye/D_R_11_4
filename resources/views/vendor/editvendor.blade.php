@extends('layouts.app')
@section('title', 'Edit Vendor')
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
                    <form action="{{ url('update_vendor').'/'.$edit->id }}" method="GET" id="update_vendor">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Vendor Name</label>
                                    <input type="text" name="name" value="{{ $edit->name }}"
                                           autocomplete="off"
                                           class="form-control required"
                                           placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="pull-left">Contact</label>
                                    <input type="tel" name="contact" autocomplete="off"
                                           class="form-control required"
                                           value="{{ $edit->contact }}"
                                           placeholder="Enter Mobile Number">
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
                                           value="{{ $edit->gst_no }}"
                                           class="form-control required nospc"
                                           placeholder="Enter GST Number">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="" class="pull-left">IGST %</label>
                                    <input type="text" name="igst"
                                           maxlength="25"
                                           id="igst"
                                           autocomplete="off"
                                           value="{{ $edit->igst }}"
                                           class="form-control required nospc" placeholder="Enter IGST %">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="" class="pull-left">SGST %</label>
                                    <input type="text" name="sgst" maxlength="25"
                                           id="sgst"
                                           value="{{ $edit->sgst }}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter SGST %">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="" class="pull-left">CGST %</label>
                                    <input type="text" name="cgst"
                                           maxlength="25"
                                           id="cgst"
                                           value="{{ $edit->cgst }}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter CGST %">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-left">Update Vendor &nbsp;<i class="fa fa-users"></i></button>
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