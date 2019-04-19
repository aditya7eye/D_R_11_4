@extends('layouts.app') 
@section('title', 'Stock Items') 
@section('content')
<link rel="stylesheet" href="{{ url('css/cropper.min.css') }}">
<link rel="stylesheet" href="{{ url('css/main.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ url('js/cropper.min.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
@php $products = \App\Product::whereis_del(0)->orderBy('id','desc')->get(); 
@endphp
<style>
    .mycard {
        background: white;
        padding: 10px 10px;
    }

    .imgtab {
        height: 100px;
        width: auto;

    }

    .productbox {
        background-color: #ffffff;
        padding: 10px;
        margin-bottom: 10px;
        -webkit-box-shadow: 0 8px 6px -6px #999;
        -moz-box-shadow: 0 8px 6px -6px #999;
        box-shadow: 0 8px 6px -6px #999;
    }

    .producttitle {
        font-weight: bold;
        padding: 5px 0 5px 0;
    }

    .productprice {
        border-top: 1px solid #dadada;
        padding-top: 5px;
    }

    .pricetext {
        font-weight: bold;
        font-size: 1.0em;
    }

    .myresponsive {
        display: block;
        /* max-width: 167px; */
        /* width: 187px; */
        height: 150px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg mybg">
                <h1>
                    <b>Stock</b>
                </h1>
                {{--
                <hr> --}}


                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#store">Stock List &nbsp;
                                <i class="fa fa-trello"></i>
                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#addstore">Stock  &nbsp;<i
                                        class="fa fa-plus"></i></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="store" class="tab-pane "><br>
                        <div class="row">
                            <h1>list</h1>

                        </div>

                    </div>
                    <div id="addstore" class="tab-pane active"><br>
                        <div class="row">
                            <form action="{{ url('addpurchase') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="" class="pull-left">&nbsp;Purchase No.</label>
                                        <input type="text" class="form-control" name="p_no" placeholder="Puchase No.">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="" class="pull-left">&nbsp;Purchase Date.</label>
                                        <input type="text" class="form-control" name="p_date" value="{{ date('d-M-Y') }}" placeholder="Puchase Date" disabled>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="" class="pull-left">&nbsp;Invoice No</label>
                                        <input type="text" class="form-control" name="invoice" placeholder="Invoice No.">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="pull-left">&nbsp;Invoice Date</label>
                                        <input type="text" class="form-control" name="invoice_date" placeholder="Invoice Date">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="pull-left">&nbsp;Vendor</label> {{-- <select class=" typeDD requireDD"
                                            name="vendor" style="width: 100%; height:150%"> --}}
                                    <select class="form-control" name="vendor" style="width: 100%; height:150%">
                                        <option value="">Select Vendor</option>
                                        @foreach ($vendor as $item)
                                        <option value="{{ $item->id }}">{{ ucwords($item->name)}}</option> 
                                        @endforeach
                                       </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="" class="pull-left">&nbsp;Product Name</label>
                                        <input type="text" class="form-control" name="p_name[]" placeholder="Product Name">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="" class="pull-left">&nbsp;Brand</label>
                                        <select class=" typeDD requireDD" name="brand[]" style="width: 100%;">
                                                        <option value="">Select Brand</option>
                                                        @foreach ($brand as $item)
                                                        <option value="{{ $item->id }}">{{ ucwords($item->name)}}</option> 
                                                           @endforeach
                                                       </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Select Category / Sub-Category</label>
                                            <select class=" typeDD requireDD" name="catid[]" style="width: 100%;">
                                                    <option value="">Select Category / Sub-Category</option>
                                                        @foreach ($catlist as $item)
                                                          <option value="{{ $item->id }}"><b>{{ ucwords($item->name)}}</b></option> 
                                                          @php  
                                  $sublist = \App\Category::whereis_del(0)->whereparent_id($item->id)->orderBy('id', 'desc')->get();
                                                            @endphp
                                                @foreach ($sublist as $item1)
                                                <option value="{{ $item1->id }}">&nbsp;&nbsp;-{{ ucwords($item1->name)}}</option> 
                                                @endforeach
                                                         @endforeach
                                        </select>

                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Loose / Pack</label>
                                            <select name="loose_pack[]" id="loose_pack" class="form-control">
                                                        <option value="0">Loose</option>
                                                        <option value="1">Pack</option>
                                                    </select>

                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">CP Excl Tax(₹)</label>
                                            <input type="text" class="form-control numberOnly" onkeyup="totamt(1)" name="unit_price[]" id="unit_price1" placeholder="Enter Price">


                                        </div>

                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">QTY</label>
                                            <input type="text" onkeyup="totamt(1)" class="form-control numberOnly" name="qty[]" id="qty1" placeholder="Enter Qty">


                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Free QTY</label>
                                            <input type="text" class="form-control numberOnly" name="f_qty[]" id="f_qty" placeholder="Enter Free Qty">


                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Unit</label>
                                            <select name="unit[]" id="unit" class="form-control"><option value="">Select unit</option>
                                                                                @foreach ($unit as $item)
                                                                                <option value="{{ $item->id }}">{{ ucwords($item->unit)}}</option> 
                                                                                   @endforeach
                                                                              </select>

                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Total Amount</label>
                                            <input type="text" onkeypress="return false" onkeydown="return false" class="form-control" name="t_amount[]" id="t_amount1" placeholder="Enter Amount">


                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Scheme Discount</label>
                                            <input type="text" class="form-control" onkeyup="totamt(1);" name="s_discount[]" id="s_discount1" placeholder="Enter Scheme Discount">


                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">GST</label>
                                            <input type="text" class="form-control" onkeyup="totamt(1);" name="gst[]" id="gst1" placeholder="Enter GST">


                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">CGST</label>
                                            <input type="text" class="form-control" name="cgst[]" id="cgst1" placeholder="Enter CGST">


                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">SGST</label>
                                            <input type="text" class="form-control" name="sgst[]" id="sgst1" placeholder="Enter SGST">


                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Total Cost Price (All Qty)</label>
                                            <input type="text" class="form-control" name="total_cost_price[]" id="total_cost_price1" placeholder="Enter Cost Price">


                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Cost Price (Per Unit)</label>
                                            <input type="text" class="form-control" name="cost_price[]" id="cost_price1" placeholder="Enter Cost Price">


                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="pull-left" style="align: center">Selling Price (Per Unit)</label>
                                            <input type="text" class="form-control" name="selling_price[]" id="selling_price1" placeholder="Enter Selling Price">

                                        </div>

                                    </div>
                                </div>
                               <hr>
                                <div id="addhere">

                               
                                </div>
                                <button type="button" onclick="addprorow();" class="btn btn-primary btn-sm">+</button>
                                <hr>
                                <button type="submit" class="btn btn-success btn-block">Done & Save</button>
                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>


    </div>
</div>
</div>

<script>
    var uid = 2 ;
function addprorow()
{
    $.get('{{ url('addnewrow') }}', {
                    uid: uid
                }, function (data) {
                    $('#addhere').append(data);
                });
                uid++;
    

}

function removerow(id)
{
    $('#thisis'+id).remove();
}

function totamt(id)
{
    debugger
    var unit_price = $('#unit_price'+id).val()=="" ? 0 : $('#unit_price'+id).val();
    var qty = $('#qty'+id).val()=="" ? 0 : $('#qty'+id).val();
    var s_discount = $('#s_discount'+id).val()=="" ? 0 : $('#s_discount'+id).val();
    var gst = $('#gst'+id).val()=="" ? 0 : $('#gst'+id).val();

    var halfgst = parseFloat(gst)/2;
    $('#cgst'+id).val(halfgst);
    $('#sgst'+id).val(halfgst);

    var amount = parseFloat(unit_price) *  parseFloat(qty) ;
     $('#t_amount'+id).val(amount);
     var gstprice = ( parseFloat(amount) *  parseFloat(gst))/100;
     var cost_price = parseFloat(amount) - parseFloat(s_discount);
      cost_price = parseFloat(cost_price) + parseFloat(gstprice);
      $('#total_cost_price'+id).val(cost_price);
      
      cost_price = parseFloat(cost_price) / qty;
    //  cost_price = cost_price - s_discount;

      $('#cost_price'+id).val(cost_price);
}


</script>
@endsection