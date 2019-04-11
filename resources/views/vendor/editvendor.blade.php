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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="" class="pull-left">Vendor Name *</label>
                                    <input type="text"
                                           name="name"
                                           value="{{$edit->name}}"
                                           autocomplete="off"
                                           class="form-control required"
                                           placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="" class="pull-left">Contact *</label>
                                    <input type="tel"
                                           name="contact"
                                           value="{{$edit->contact}}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter Mobile Number">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="address" class="pull-left">Full Address *</label>
                                    <input type="text"
                                           name="address"
                                           maxlength="25"
                                           id="address"
                                           value="{{$edit->address}}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter Vendor's Full Address">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bank" class="pull-left">Bank Name *</label>
                                    <input type="text"
                                           name="bank"
                                           maxlength="25"
                                           id="bank"
                                           value="{{$edit->bank}}"
                                           autocomplete="off"
                                           class="form-control required"
                                           placeholder="Enter Bank Name">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="account" class="pull-left">Bank Account Number *</label>
                                    <input type="text"
                                           name="account"
                                           maxlength="25"
                                           id="account"
                                           value="{{$edit->account}}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter Account Number">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="gst_no" class="pull-left">GST Number *</label>
                                    <input type="text"
                                           name="gst_no"
                                           maxlength="20"
                                           id="gst_no"
                                           value="{{$edit->gst_no}}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter GST Number">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="amount" class="pull-left">Opening Amount *</label>
                                    <input type="text"
                                           name="amount"
                                           maxlength="25"
                                           id="amount"
                                           value="{{$edit->amount}}"
                                           autocomplete="off"
                                           class="form-control required nospc"
                                           placeholder="Enter Opening Amount">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="" class="pull-left">Transaction Type *</label>
                                    <select name="ttype" id="ttype" class="form-control required">
                                        <option value="{{$edit->ttype}}">{{$edit->ttype}}</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Debit">Debit</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
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