@extends('layouts.app') 
@section('title', 'Products') 
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
<script type="text/javascript">
    $(document).ready(function () {
        var result = $('.result'),
                img_result = $('.img-result'),
                img_w = $('.img-w'),
                img_h = $('.img-h'),
                options = $('.options'),
                save = $('.save'),
                cropped = $('.cropped'),
                dwn = $('.download'),
                upload = $('#file-input'),
                cropper = '';
        var roundedCanvas;

        $('#file-input').change(function (e) {
            if (e.target.files.length) {
                // start file reader
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (e.target.result) {
                        // create new image
                        var img = document.createElement('img');
                        img.id = 'image';
                        img.src = e.target.result;
                        // clean result before
                        //result.innerHTML = '';
                        result.children().remove();
                        // append new image
                        result.append(img);
                        // show save btn and options
                        // save.removeClass('hide');
                        options.removeClass('hide');
                        // init cropper
                        cropper = new Cropper(img);
                        // cropbtn setting enabled
                        $('#cropbtn_setting').find('.btn').removeAttr("disabled");
                        $('#btncrop_download').attr("disabled", "true");
                        $('#save_toserver').attr("disabled", "true");
                        save.removeAttr("disabled");

                        $('#btn_RotateLeft').click(function () {
                            cropper.rotate(90);
                        });
                        $('#btn_RotateRight').click(function () {
                            cropper.rotate(-90);
                        });
                        $('#btn_RotateReset').click(function () {
                            cropper.reset();
                        });
                        $('#btn_Compresed').click(function () {
                            /*     cropper.(UMD, compressed);*/
                        });
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        $('#save').click(function (e) {
            e.preventDefault();
            // get result to data uri
            var imgSrc = cropper.getCroppedCanvas({
                width: img_w.value // input value
            }).toDataURL();
            // remove hide class of img
            cropped.removeClass('hide');
            img_result.removeClass('hide');
            // show image cropped
            cropped.attr('src', imgSrc);
            dwn.removeClass('hide');
            dwn.download = 'imagename.png';
            dwn.attr('href', imgSrc);
            // download button enabled
            $('#btncrop_download').removeAttr("disabled");
            $('#save_toserver').removeAttr("disabled");
        });
      
    });

</script>
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
                    <div id="store" class="tab-pane"><br>
                        <div class="row">
                            @foreach ($products as $item)
                            <div class="col-md-2 column productbox">
                                <div class="producttitle">{{ ucwords($item->b_name->name) }} - {{ ucwords($item->name) }}</div>
                                <img src="{{ url('product_image').'/'.$item->image }}" class="myresponsive">
                                <div class="producttitle">Stock - {{ ucwords($item->stock) }}</div>
                                <div class="productprice">
                                    <div class="pricetext"> CP- ₹ {{ $item->cost_price}} | SP- ₹ {{ $item->selling_price}}</div>
                                </div>
                                <div class="productprice" style="margin-top: 5px;">

                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>
                    <div id="addstore" class="tab-pane active"><br>
                        <form action="{{ url('insert_products') }}" method="post" id="createpost" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="pull-left">&nbsp;Product Name</label>
                                    <input type="text" class="form-control required" autocomplete="off" name="p_name" id="p_name" onkeyup="findsuggetion();" placeholder="Product Name">
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="pull-left">&nbsp;Brand</label>
                                    <select class=" typeDD requireDD" name="brand" style="width: 100%;">
                                                        {{-- <option value="">Select Brand</option> --}}
                                                        @foreach ($brand as $item)
                                                        <option value="{{ $item->id }}">{{ ucwords($item->name)}}</option> 
                                                           @endforeach
                                                       </select>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Select Category / Sub-Category</label>
                                        <select class=" typeDD requireDD" name="catid[]" style="width: 100%;" multiple>
                                                    {{-- <option value="">Select Category / Sub-Category</option> --}}
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
                                        <select name="loose_pack" id="loose_pack" class="form-control">
                                                        <option value="0">Loose</option>
                                                        <option value="1">Pack</option>
                                                    </select>

                                    </div>

                                </div>
                            </div>

                            <div align="left">
                                <hr>
                                <div id="resultdiv">

                                </div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">CP Excl Tax(₹)</label>
                                        <input type="text" class="form-control numberOnly required" onkeyup="totamt(1)" name="unit_price" id="unit_price1" placeholder="Enter Price">


                                    </div>

                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">QTY</label>
                                        <input type="text" onkeyup="totamt(1)" class="form-control numberOnly required" name="qty" id="qty1" placeholder="Enter Qty">


                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Free QTY</label>
                                        <input type="text" class="form-control numberOnly" name="f_qty" id="f_qty" placeholder="Enter Free Qty">


                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Unit</label>
                                        <select name="unit" id="unit" class="form-control requiredDD"><option value="">Select unit</option>
                                                                                @foreach ($unit as $item)
                                                                                <option value="{{ $item->id }}">{{ ucwords($item->unit)}}</option> 
                                                                                   @endforeach
                                                                              </select>

                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Total Amount</label>
                                        <input type="text" onkeypress="return false" onkeydown="return false" class="form-control" name="t_amount" id="t_amount1"
                                            placeholder="Enter Amount">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Product Discount (₹)</label>
                                        <input type="text" class="form-control" onkeyup="totamt(1);" name="s_discount" id="s_discount1" placeholder="Enter Scheme Discount">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">GST (%)</label>
                                        <input type="text" class="form-control required" onkeyup="totamt(1);" name="gst" id="gst1" placeholder="Enter GST">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">CGST (%)</label>
                                        <input type="text" class="form-control" name="cgst" id="cgst1" placeholder="Enter CGST">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">SGST (%)</label>
                                        <input type="text" class="form-control" name="sgst" id="sgst1" placeholder="Enter SGST">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Total Cost Price (All Qty)</label>
                                        <input type="text" class="form-control" name="total_cost_price" id="total_cost_price1" placeholder="Enter Cost Price">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Cost Price (Per Unit)</label>
                                        <input type="text" class="form-control" name="cost_price" id="cost_price1" placeholder="Enter Cost Price">


                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Selling Price (Per Unit)</label>
                                        <input type="text" class="form-control required" name="selling_price" id="selling_price1" placeholder="Enter Selling Price">

                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="name" class="pull-left" style="align: center">Selling Price (Per Unit)</label>
                                        <select class="form-control requiredDD" name="vendor" style="width: 100%; height:150%">
                                                    <option value="">Select Vendor</option>
                                                    @foreach ($vendor as $item)
                                                    <option value="{{ $item->id }}">{{ ucwords($item->name)}}</option> 
                                                    @endforeach
                                                   </select>


                                    </div>

                                </div>
                               

                                <input type="hidden" name="myimage" id="myimage">
                                <div class="col-sm-6">
                                    <div class="upload_image_box">
                                        <div class="upload_caption">
                                            Upload photos from your computer
                                        </div>
                                        <div class="btn-group" data-toggle="modal" data-target="#modal_crop">

                                            <button type="button" class="btn btn-primary btn-sm res_btn">Browse Photo
                                                            </button>
                                        </div>
                                        <!-- <input type="file" name="profile_pic" id="recend_select_file" class="profile-upload-pic"
                                                                onchange="ChangeSetImage(this, _UserProfile);"/>-->
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="upload_image_box">
                                        <div class="upload_caption">
                                            <b> Uploaded Photo </b>
                                        </div>
                                        <div class="btn-group" data-toggle="modal" data-target="#modal_crop">

                                            <img style="height:300px; width:auto;" src="" alt="" id="myresultimage">
                                        </div>

                                    </div>
                                </div>
                                <p></p>
                                <hr>
                                <div class="col-sm-12" style="padding-top: 10px;">
                                        <div class="form-group">
                                            <label for="" class="pull-left">Scan / Enter Your Barcoad No</label>
                                            <input type="text" value="{{ time() }}" name="barcode" id="barcode" class="form-control" placeholder="Scan / Enter Your Barcoad No">
                                        </div>
    
                                    </div>

                                <div class="col-sm-12" style="padding-top: 10px;">

                                    <div class="form-group">

                                        <button onclick="enterthis();" class="btn btn-success  btn-block">Upload &nbsp;
                                                                        <i class="fa fa-trello"></i></button>
                                        <button class="btn btn-primary hide" type="submit" id="theButton">ADD</button>
                                    </div>

                                </div>
                            </div>

                    </div>





                </div>

            </div>
        </div>


    </div>
</div>
</div>
<div id="modal_crop" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crop and Download your image</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <main class="page">
                    <div class="box">
                        <div class="input-group">
                            {{-- <span class="input-group-btn">
                                <span class="btn btn-default btn-btn-primary">
                                    Click Here <input type="file" id="file-input"
                                                   "/>
                                </span>
                            </span> --}}
                            <input type="file" class="form-control" id="file-input" name="file+" onchange="ChangeSetImage(this, image_frout, file_text_frount);">                            {{-- <input type="text" id="file_text_frount" class="form-control" readonly=""> --}}
                        </div>
                        <p class="note_forcrop">

                        </p>
                    </div>
                    <div class="box-2">
                        <div class="result">
                            {{-- <img class="cropped" id="image_frout1" src="assets/images/NoPreview_CropImg.png" alt="">                            --}}
                            <img class="cropped" id="image_frout1" src="http://lagnphere.com/assets/images/NoPreview_CropImg.png" alt="">
                        </div>
                    </div>
                    <div class="box-2 img-result hide">
                        <img class="cropped" id="image_frout" src="" alt="">
                    </div>
                    <div class="box" id="cropbtn_setting">
                        <!--<div class="options hide">
                            <label> Width</label>
                            <input type="text" class="img-w" value="300" min="100" max="1200"/>
                        </div>-->
                        <button class="btn btn-info btn-sm" disabled="disabled" id="btn_RotateLeft">
                            <i class="mdi mdi-format-rotate-90 basic_icon_margin"></i>Rotate Left
                        </button>
                        <button class="btn btn-warning btn-sm center_btnmargin" disabled="disabled" id="btn_RotateRight">
                            <i class="mdi mdi-rotate-right basic_icon_margin"></i>Rotate Right
                        </button>
                        <button class="btn btn-danger btn-sm" disabled="disabled" id="btn_RotateReset">
                            <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Reset
                        </button>
                        <!-- <button class="btn btn-success" id="btn_getRounded">
                             <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Rounded</button>-->
                    </div>
                </main>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-default download" disabled="disabled" id="btncrop_download" download="croped_image.png">
                    <i class="mdi mdi-folder-download basic_icon_margin"></i>Download</a>
                <button type="button" class="btn btn-success save" id="save" disabled="disabled"><i
                            class="mdi mdi-crop basic_icon_margin"></i>Cropped
                </button>
                <button type="button" onclick="upload_profile();" class="btn btn-primary" disabled="disabled" id="save_toserver" disabled="disabled"><i
                            class="mdi mdi-account-check basic_icon_margin"></i>Set
                </button>
            </div>
        </div>

    </div>
</div>
<script>
    document.getElementById("barcode").onclick = function() {
  this.select();
  document.execCommand('copy');
//   alert('This is a test...');
}
    function findsuggetion()
    {
        var p_name = $('#p_name').val();
        $.get('{{ url('findsuggetion') }}', {
            p_name: p_name
            }, function (data) {
                    console.log(data);
                    $('#resultdiv').html('');
                    for (var i=0;i<data.length;i++) {
                        $('#resultdiv').append('<button type="button" onclick="getallrecord('+ data[i].id +')" class="btn btn-success">' + data[i].name + '</button> ');
                    }
                    //  alert(data);
            });
    }
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
            function getallrecord(id)
            {
                $.get('{{ url('getallrecord') }}',{
                        pid: id
                    }, function (data) {
                            console.log(data.name);
                            $('#p_name').val(data.name);
                        //    alert(data);
                    });  
            }
   
          function enterthis() {

//        var all = $('#cke_1_contents').parent('body').html();
//        alert(all);
//        $('#description').val(all);

        var p_name = $('#page').val();
        var title = $('#title').val();
        if (p_name == "") {
            $('#page').focus();
            return false;
        }
        else if (title == "") {
            $('#title').focus();
            return false;
        }
        else {
            $("#theButton").click();
            // document.getElementById("createpost").submit();
        }

    }



    $("#userprofilepic").on('submit', function (e) {
//                var textval = $('#post_text').text();
//                $('#posttext').val(textval);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{ url('formpicpost') }}",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function (data) {
                console.log(data);
                location.reload();


//
            },
            error: function (xhr, status, error) {
//                    console.log('Error:', data);
//                    ShowErrorPopupMsg('Error in uploading...');
                $('#err1').html(xhr.responseText);
            }
        });
//                }
    });

    $(document).ready(function () {
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                    log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    });
    function upload_profile() {
        var file = $('#image_frout').attr('src');
        $('#myresultimage').attr('src', file);
        $('#myimage').val(file);
        $('#modal_crop').modal('hide');
        // alert(file);

        // $.post('{{url('fileupload')}}', {file: file}, function (data) {

        //     ShowSuccessPopupMsg('Profile Picture Successfull Change');
        //     location.reload();
        // });
    }
    function show_data(image, id) {
        var imagem = image;
        var myid = id;


        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this image",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('{{url('deletepic')}}', {imagem: imagem, myid: myid}, function (data) {
                            location.reload();
                        });


                        swal(" Your image has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your image is safe!");
                    }
                });
    }


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