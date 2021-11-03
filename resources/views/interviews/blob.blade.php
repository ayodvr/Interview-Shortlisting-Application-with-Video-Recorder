@extends('layouts.Blob')
@section('blob')
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

                <?php
                    $cand_id = $interview["newuser_id"];
                ?>
<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-xl-8">
                {{-- <h1 id="header" hidden>RecordRTC Upload to PHP</h1> --}}
                <div class="auth-full-bg pt-lg-5 p-4">
                    
                    <div>
                        <video id="gum" controls playsinline autoplay muted></video>
                        {{-- <video id="recorded" playsinline loop></video> --}}
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{-- data-toggle="tooltip" 
                        data-placement="top" title="Enable Camera" --}}
                        <button id="start" class="btn btn-dark" hidden>Record</button>

                        <button  id="record" data-toggle="tooltip" data-placement="top" title="Start your session" class="btn btn-dark">Start</button>
                        <button style="float: right" id="button-speak" data-toggle="tooltip" data-placement="top" title="Press to listen" class="btn btn-dark mb-3" style="border-radius:40px"><i class="fas fa-microphone-alt"></i></button>

                        {{-- <button id="play" disabled>Play</button> --}}
                        <div>
                            {{-- Recording format: --}}
                         <select id="codecPreferences" disabled hidden></select>
                        </div>
                        <div>
                            {{-- <h4>Media Stream Constraints options</h4> --}}
                            {{-- Echo cancellation: --}}
                            <p><input type="checkbox" id="echoCancellation" hidden></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                
            <div class="auth-full-page-content p-md-5 p-4">
                <div class="d-flex flex-column h-100">
                    <div class="d-flex justify-content-center">
                        <div id="clockdiv" style="text-align: center">
                            <div>
                              <span id="countdown" >00 : 10</span>
                              {{-- <div class="smalltext">Seconds</div> --}}
                            </div>
                        </div>
                    </div>
                        <div class="w-100">     
                        <br>
                            <div class="mb-4 mb-md-5">
                                <div class="tag_container">
                                    @include('interviews.questions')
                                    <button id="save" style="margin-left:150px;" data-toggle="tooltip" data-placement="top" title="Click to submit" class="btn btn-dark">Finish</button>
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
<script>
    window.onload = function(){
   document.getElementById('start').click();
 }
 </script>