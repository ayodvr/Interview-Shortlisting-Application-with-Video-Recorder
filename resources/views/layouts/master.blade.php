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
        </style>
    </head>
    <body data-sidebar="dark">
        <div id="layout-wrapper">
            @include('includes.nav')
            @include('includes.aside')
            @yield('content')
            @include('includes.footer')
        </div>

    
       
        <!-- JAVASCRIPT -->
        @include('sweetalert::alert')
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
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
 
         <!-- Datatable init js -->
         <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> 
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js')}}"></script>
        <script src="{{asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
        <script>
            $('.destroy-confirm').on('click', function (event) {
              var name = $(this).data("name");
              event.preventDefault();
              const url = $(this).attr('href');
                swal({
                    title:  `Are you sure you want to delete ${name}?`,
                    text: 'This will be permanantly deleted!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = url;
                    }
              });
        });
        </script> 
        <script>
             $(document).ready(function(){
            $('#sessionEnded').on('submit', function(){
                event.preventDefault();
                console.log("i got here")
                $.ajax({
                    url: "{{ url('/blog-upload') }}",
                    method: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                      success: function(response) {
                          console.log(response);
                          if (response === 'success') {
                              alert('successfully uploaded recorded blob');
                          } else {
                              console.log('upload failed');
                          }
                      },
                      error: function (error) {
                       console.log("error uploadig ", error)
                     }
                });
             });
          });
        </script>
    </body>
</html>