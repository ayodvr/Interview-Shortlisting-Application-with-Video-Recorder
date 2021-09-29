@extends('layouts.webCam')
@section('webcam')
{{-- <div class="field-wrapper"> --}}
                {{-- <label for="voice">Voice:</label> --}}
                <select id="voice" hidden="hidden"></select>
                {{-- </div> --}}
                {{-- <div class="field-wrapper"> --}}
                {{-- <label for="rate">Rate (0.1 - 10):</label> --}}
                <input type="number" id="rate" min="0.1" max="10" value="1" step="any" hidden="hidden"/>
                {{-- </div> --}}
                {{-- <div class="field-wrapper"> --}}
                {{-- <label for="pitch">Pitch (0.1 - 2):</label> --}}
                <input type="number" id="pitch" min="0.1" max="2" value="1" step="any" hidden="hidden" />
                {{-- </div> --}}

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-xl-8">
                <h1 id="header" hidden>RecordRTC Upload to PHP</h1>
                <div class="auth-full-bg pt-lg-5 p-4">
                    
                    <div class="w-90">
                        <video controls autoplay playsinline></video>
                        &nbsp;&nbsp;
                        <input type="button" value="Start" style="border-radius:40px" id="btn-start-recording" 
                        data-toggle="tooltip" data-placement="top" title="Press to record" class="btn btn-danger startClock">
                        <button id="btn-stop-recording" disabled hidden="hidden">Submit</button>
                        <input type="text" id="txt-recording-duration" value="5000" hidden="hidden">
                        <button style="float: right" id="button-speak" data-toggle="tooltip" data-placement="top" title="Press to listen" class="btn btn-success mb-3" style="margin-left:100px; padding:10px;width:50px;border-radius:40px"><i class="fas fa-microphone-alt"></i></button>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                
            <div class="auth-full-page-content p-md-5 p-4">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex justify-content-center">
                        {{-- {{}} --}}
                        {{-- <h3 id="cd-minutes" style="color:red">00</h3>
                        <h3 id="cd-minutes" style="color:red">:</h3>
                        <h3 id="cd-seconds" style="color:red">00</h3>  --}}
                        <div id="clockdiv" style="text-align: center">
                            <div>
                              <span class="minutes">00</span>
                              {{-- <div class="smalltext">Minutes</div> --}}
                            </div>
                            <div>
                              <span class="seconds">00</span>
                              {{-- <div class="smalltext">Seconds</div> --}}
                            </div>
                        </div>
                    </div>
                        <div class="w-100">     
                        <br>
                            <div class="mb-4 mb-md-5">
                                <div id="text" class="tag_container">
                                    @include('interviews.questions')
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>
@endsection
      