<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daily Rashan - @yield('title') </title>
        
        
        <link rel="stylesheet" href="{{ url('css/vendor.css') }}" />
        <link rel="stylesheet" href="{{ url('css/app.css') }}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <style>
        .myheading {
            border-bottom: 1px solid #00000038;
            padding-left: 30px;
            padding-right: 30px;
        }
        .mybg{
            padding: 20px 25px;
            background: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15), 0 6px 6px rgba(0,0,0,0.16);
        }
        .errorClass {
            border: red 1px solid;
        }
    </style>

</head>

<body>

    <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
    @include('layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" style="background: #e8dede !important;">

            <!-- Page wrapper -->
    @include('layouts.topnavbar')

            <!-- Main view  -->
            @if(session()->has('message'))
            <script type="text/javascript">
                setTimeout(function () {
                    Swal.fire({
                        position: 'bottom',
                        title: '{{ session()->get('message') }}',
                        showConfirmButton: false,
                        timer: 1200,
                        animation: false,
                        customClass: {
                            popup: 'animated fadeInDown'
                        }
                    })
                }, 500);
            </script>
            @endif
            @yield('content')
       
            <!-- Footer -->
    @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->
    <script src="{{ url('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/validate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    
@section('scripts') @show

</body>

</html>