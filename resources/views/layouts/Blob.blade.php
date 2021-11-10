<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Hr56 Virtual Interview</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />

        <meta charset="utf-8">
        <meta name="description" content="WebRTC code samples">
        <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
        <meta itemprop="description" content="Client-side WebRTC code samples">
        <meta itemprop="name" content="WebRTC code samples">
        <meta name="mobile-web-app-capable" content="yes">
        <meta id="theme-color" name="theme-color" content="#000">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <base target="_blank">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" type="text/css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">
        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <style>
            video {
                width: 820px;
                height: 480px;
                border-radius: 5px;
                border: 1px solid black;  
                pointer-events: none;     
        }

        #clockdiv{
        font-family: sans-serif;
        color: #fff;
        display: inline-block;
        font-weight: 80;
        text-align: center;
        font-size: 20px;
        }

        #clockdiv > div{
        padding: 5px;
        border-radius: 3px;
        background: #f00707;
        display: inline-block;
        }

        #clockdiv div > span{
        padding: 10px;
        border-radius: 3px;
        background: #832f2f;
        display: inline-block;
        }

        .smalltext{
        padding-top: 5px;
        font-size: 16px;
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

        /* .startClock {
                
            margin-bottom: 00px;
            } */
        </style>
    </head>
    <body class="auth-body-bg">
      <div id="preloader">
        <div id="status">&nbsp;</div>
      </div>
        @yield('blob')



  <!-- JAVASCRIPT -->
  <footer style="margin-top: 20px; text-align: left;">
    <small id="send-message"></small>
</footer>
{{-- <script src="https://www.webrtc-experiment.com/common.js"></script> --}}
  <script src="{{asset('assets/js/pages/pagination.js')}}"></script>
  <script>
    $(window).on('load', function() { // makes sure the whole site is loaded 
    $('#status').fadeOut(); // will first fade out the loading animation 
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
    $('body').delay(350).css({'overflow':'visible'});
    })
</script>
  <script type="text/javascript">
    var cand_id = '<?= $cand_id ?>';
    var id      = '<?= $id ?>';
    var client_id  = '<?= $client_id ?>';
 </script>
 <script src="{{ asset('js/iziToast.js') }}"></script>
 @include('vendor.lara-izitoast.toast')
  <script src="{{asset('assets/js/index.js')}}" async></script>
  {{-- <script src="{{asset('assets/js/pages/timer.js')}}"></script> --}}
  <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

  <!-- owl.carousel js -->
  <script src="{{asset('assets/libs/owl.carousel/owl.carousel.min.js')}}"></script>

  <!-- validation init -->
  <script src="{{asset('assets/js/pages/validation.init.js')}}"></script>

  <!-- auth-2-carousel init -->
  <script src="{{asset('assets/js/pages/auth-2-carousel.init.js')}}"></script>
  <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
  <script src="{{asset('assets/js/ga.js')}}"></script>

  <!-- App js -->
  <script src="{{asset('assets/js/app.js')}}"></script>
          <!-- ../libs/DBML.js -->
  

  {{-- <script>
      window.onload = function(){
  
      document.getElementById('btn-start-recording').click();
  }
  </script> --}}
  <script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>
</html>