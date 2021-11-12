<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Hr56 Virtual Interview Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        <link rel="stylesheet" href="{{ asset('/vendor/zusamarehan/tourify/css/hopscotch.css') }}">
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" /> 

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <style>
            #myVideo {
                background-color: rgb(31, 31, 32);
            }
            body {
            overflow: hidden;
            }


            /* Preloader */

            #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            /* change if the mask should have another color then white */
            z-index: 99;
            /* makes sure it stays on top */
            }

            #status {
            width: 200px;
            height: 200px;
            position: absolute;
            left: 50%;
            /* centers the loading animation horizontally one the screen */
            top: 50%;
            /* centers the loading animation vertically one the screen */
            background-image: url(https://res.cloudinary.com/bridge-gap/image/upload/v1636475845/1495_n7jera.gif);
            /* path to your loading animation */
            background-repeat: no-repeat;
            background-position: center;
            margin: -100px 0 0 -100px;
            /* is width and height divided by two */
            }
        </style>
    </head>
    <body data-sidebar="dark">
        <div id="preloader">
            <div id="status">&nbsp;</div>
          </div>
        <div id="layout-wrapper">
            @include('includes.nav')
            @include('includes.aside')
            @yield('content')
            @include('includes.footer')
        </div>
       
        <!-- JAVASCRIPT -->
        @include('sweetalert::alert')
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script>
            $(window).on('load', function() { // makes sure the whole site is loaded 
            $('#status').fadeOut(); // will first fade out the loading animation 
            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
            $('body').delay(350).css({'overflow':'visible'});
            })
        </script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.js')}}"></script>
        <script src="{{ asset('js/iziToast.js') }}"></script>
        @include('vendor.lara-izitoast.toast')
        <script rel="stylesheet" src="{{ asset('/vendor/zusamarehan/tourify/js/hopscotch.js') }}"></script>
        <!-- form advanced init -->
        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- dashboard init -->
        <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>

         <!-- Required datatable js -->
         <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
         <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
         <!-- Buttons examples -->
         <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
         <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
         <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
         <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
         <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
         <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
         <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
         <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
        
         <!-- form repeater js -->
         <script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
 
         <script src="{{asset('assets/js/pages/form-repeater.int.js')}}"></script>

         <!-- Responsive examples -->
         <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
         <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
 
         <script src="{{asset('assets/js/pages/materialdesign.init.js')}}"></script>

         <!-- Datatable init js -->
         <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> 
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    </body>
</html>