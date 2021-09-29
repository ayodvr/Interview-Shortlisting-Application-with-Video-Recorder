<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Hr56 Virtual Interview</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.carousel.min.css')}}">

        <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/assets/owl.theme.default.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.15.4/video-js.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/videojs-record/4.5.0/css/videojs.record.min.css" rel="stylesheet">
        <style>
            video {
                width: 820px;
                height: 480px;
                border-radius: 5px;
                border: 1px solid black;       
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
        background: #990000;
        display: inline-block;
        }

        #clockdiv div > span{
        padding: 10px;
        border-radius: 3px;
        background: #ff8080;
        display: inline-block;
        }

        .smalltext{
        padding-top: 5px;
        font-size: 16px;
        }

        /* .startClock {
                
            margin-bottom: 00px;
            } */
        </style>
    </head>
    <body class="auth-body-bg">


        @yield('webcam')



  <!-- JAVASCRIPT -->
  <script src="{{asset('assets/js/pages/webcam.js')}}"></script>
  <footer style="margin-top: 20px; text-align: left;">
    <small id="send-message"></small>
</footer>
<script src="https://www.webrtc-experiment.com/common.js"></script>
  <script src="{{asset('assets/js/pages/pagination.js')}}"></script>
  <script src="{{asset('assets/js/pages/timer.js')}}"></script>
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

  <!-- App js -->
  <script src="{{asset('assets/js/app.js')}}"></script>
  <script src="https://cdn.WebRTC-Experiment.com/RecordRTC.js"></script>
  <script src="https://www.webrtc-experiment.com/EBML.js"></script>           <!-- ../libs/DBML.js -->
  

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