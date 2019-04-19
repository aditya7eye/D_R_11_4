<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Barcode</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <style type="text/css">
        .row {
            margin: 0px;
        }

        h2 {
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <div class="row">
            @php $b_id = session('bar_id'); $data = \App\BarcodeModel::find($b_id); $mqty = $data->qty; @endphp 
            @for($i = 1; $i<=$mqty; $i++) 
            <div class="col-sm-2" style="margin-bottom: 15px;">
              
                
            </div>
            <div class="col-sm-8" style="margin-bottom: 15px;">
                    <b>{{$data->product->name}}</b>
                    {!! \Milon\Barcode\DNS1D::getBarcodeHTML($data->barcode, 'C128A') !!} 
                    <b>{{$data->barcode}} - MRP: {{ $data->sp }} Rs.</b>
                    
            </div>
            <div class="col-sm-2" style="margin-bottom: 15px;">
              
                
            </div>
        
            @endfor
    </div>
       
    

  



</body>

</html>