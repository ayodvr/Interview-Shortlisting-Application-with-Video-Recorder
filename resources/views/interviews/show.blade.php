<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Register 2 | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.15.4/video-js.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/videojs-record/4.5.0/css/videojs.record.min.css" rel="stylesheet">
        <style>
            #myVideo {
                background-color: rgb(26, 27, 27);
            }
        </style>
    </head>

    <body class="auth-body-bg">
        
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    
                    <div class="col-xl-8">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-90">
                                <div class="bg-overlay"></div>
                                <video id="myVideo" class="video-js vjs-default-skin"></video>
                                <br><br>
                                {{-- <h1>I'm Here!</h1> --}}
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-4">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        <div>
                                            <h2 class="text-primary">Interview Questions</h2>
                                            <p class="text-muted">Answer all the questions below by clicking the camera icon then press record to answer your questions.</p>
                                            @if (is_array($questions) || is_object($questions))
                                            @foreach ($questions as $question)
                                            <ul>
                                                <li><h5>{{$question}}</h5></li>
                                            </ul>
                                            @endforeach 
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="my-auto">
                                       
                                    </div> --}}
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        <!-- JAVASCRIPT -->
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.15.4/video.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/8.1.0/adapter.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-record/4.5.0/videojs.record.min.js"></script>
        @tour
<script>

    var videoMaxlengthInSeconds = 60;

    var player = videojs("myVideo", {
        controls : true,
        width    :  820,
        height   :  480,
        fluid    : false,
        plugins  : {
            record : {
                audio : true,
                video : true,
                maxLength : videoMaxlengthInSeconds,
                debug : true,
                videoMimeType : "video/webm;codecs=H264"
            }
        }
        
    }, function () {

        videojs.log(
            'using video.js', videojs.VERSION,
            'and recordrtc', RecordRTC.version
        );
    });

    player.on('deviceError', function () {
        console.log('device error:', player.deviceErrorCode)
    });

    player.on('error', function () {
        console.log('error:', error)
    });

    player.on('startRecord', function () {
        console.log('started recording! Do whatever you need to')
    });

    player.on('finishRecord', function() {

        var videoBlob = player.recordedData.video;

        console.log('finished recording: ', videoBlob);

        // window.location.href = "http://127.0.0.1:8000/session_ended";
    });

</script>

</body>
</html>