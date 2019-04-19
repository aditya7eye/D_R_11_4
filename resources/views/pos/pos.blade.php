<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Rashan POS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




    <style>
        .mybg {
            /* background-color: #fff !important; */
            padding: 15px 20px !important;
        }

        .form-control {
            border-radius: 0 !important;
        }
    </style>
</head>

<body style="background-color: #e4dedec2;">
    <div class="row">

        <div class="col-sm-8">
            <div class="mybg">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" maxlength="10" onkeyup="mobileCheck()" name="mobile" id="mobile" class="form-control" placeholder="Customer Mobile">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="cname" id="cname" placeholder="Customer Name">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="barcode" id="barcode" onchange="findBarCode();"class="form-control" placeholder="Scan Barcode or Enter Manual">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="tags" onchange="productdata();" placeholder="Search Product Name">
                        </div>
                    </div>
                </div>



                {{--
                <hr> --}}
                <table class="table table-striped mybg">
                    <thead>
                        <tr>

                            <th>Product Name</th>
                            <th>Price <small>(Per Unit)</small> </th>
                            <th>QTY</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="products_here">

                    </tbody>

                    <tr>
                        <td></td>
                        <td></td>
                        <td>Grand Total:</td>
                        <td id="gt">0</td>
                        <td></td>
                    </tr>
                </table>
                {{--
                <hr>

                <hr> --}}

                <button type="button" class="btn btn-primary btn-block" onclick="Save" style="" data-dismiss="modal">Checkout</button>
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="mybg">
                
            </div>
        </div>

    </div>

</body>
<script>
    var grandTotal = 0;
    var u_id = 1;


    // document.onkeydown=function(){
    //     if(window.event.keyCode=='13'){
    //         findBarCode();
    //     }
    // }
    function findBarCode()
    {
        var barcode = $('#barcode').val();
        $.get('{{ url('getBarcodeProducts') }}',{barcode:barcode}, function (data) {
            if(data == 'Product Not Found')
            {
                $('#barcode').val('');
                alert(data);
            }
            else{
            var sp = data['product'].sp;
               var p_id = data['product'].p_id;
            //    var u_id = data['product'].id;
               var pname = data['productdata'].name;
            //    debugger;
               var str = "<tr id='row"+u_id+"'><td>"+pname+"</td><td id='sp"+u_id+"'>"+sp+"</td><td><input onkeyup='totalAmout("+u_id+")' style='width: 100px;' name='qty"+u_id+"' id='qty"+u_id+"' class='form-control' type='text' value='1'>";
               str +="</td><td class='alltotals' id='total"+u_id+"'>"+sp+"</td><td><button class='fa fa-times' style='font-size:20px;color:red' aria-hidden='true' onclick='delRow("+u_id+")'></button></td></tr>";
               $('#products_here').append(str);
               $('#barcode').val('');
            totalAmout(u_id);
            }            
            });
    }

    $(function () {
            var availableTags = [];
            
            $.get('{{ url('getproducts') }}', function (data) {
                for (var i = 0; i < data.length; i++) {
                    availableTags[i] = data[i].name;
                }
            });
            $("#tags").autocomplete({
                source: availableTags,
            });
        });
        function productdata() {
            var name = $('#tags').val();
            $.get('{{ url('productdata') }}', {name: name}, function (data) {
               console.log(data);
               var sp = data['product'].sp;
               var p_id = data['product'].p_id;
            //    var u_id = data['product'].id;
               var pname = data['productdata'].name;
            //    debugger;
               var str = "<tr id='row"+u_id+"'><td>"+pname+"</td><td id='sp"+u_id+"'>"+sp+"</td><td><input onkeyup='totalAmout("+u_id+")' style='width: 100px;' name='qty"+u_id+"' id='qty"+u_id+"' class='form-control' type='text' value='1'>";
               str +="</td><td class='alltotals' id='total"+u_id+"'>"+sp+"</td><td><button class='fa fa-times' style='font-size:20px;color:red' aria-hidden='true' onclick='delRow("+u_id+")'></button></td></tr>";
               $('#products_here').append(str);
               $('#tags').val('');
            totalAmout(u_id);
            });
            // alert(name);
            // console.log(name);
           
        }

</script>
<script>
    function delRow(u_id)
    {
        var qty = parseInt($('#qty'+u_id).val('0'));
        $('#row'+u_id).remove();
        totalAmout();
    }
    function totalAmout(productID)
    {
        // debugger;
        var grandTotal = 0;
        var qty = parseInt($('#qty'+productID).val());
        var sellingPrice = parseInt($('#sp'+productID).html());
        // alert(sellingPrice);
        var total = parseFloat(qty*sellingPrice);
        $('#total'+productID).html(total);

        $('.alltotals').each(function () {
                if ($(this).html() != '') {
                    grandTotal = grandTotal + parseFloat($(this).html());
                }
            });
        $('#gt').html(grandTotal);
        u_id++;
    }

function mobileCheck()
{
    var mobile = $('#mobile').val();
    $.get('{{ url('mobileCheck') }}', {
                    mobile: mobile
                }, function (data) {
                    $('#cname').val(data.name);
                });
}
</script>

</html>