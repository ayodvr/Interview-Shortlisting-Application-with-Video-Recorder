/*
*  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
*
*  Use of this source code is governed by a BSD-style license
*  that can be found in the LICENSE file in the root of the source
*  tree.
*/

// This code is adapted from
// https://rawgit.com/Miguelao/demos/master/mediarecorder.html

'use strict';

/* globals MediaRecorder */

let mediaRecorder;
let recordedBlobs;

const codecPreferences = document.querySelector('#codecPreferences');

const errorMsgElement = document.querySelector('span#errorMsg');
const recordedVideo = document.querySelector('video#recorded');
let recordButton = document.querySelector('button#record');
recordButton.addEventListener('click', () => {
  if (recordButton.textContent === 'Start') {
    startRecording();
  } else {
    stopRecording();
    recordButton.disabled = true;
    // playButton.disabled = false;
    submitButton.disabled = false;
    codecPreferences.disabled = false;
  }
});


// const playButton = document.querySelector('button#play');
// playButton.addEventListener('click', () => {
//   const mimeType = codecPreferences.options[codecPreferences.selectedIndex].value.split(';', 1)[0];
//   const superBuffer = new Blob(recordedBlobs, {type: mimeType});
//   recordedVideo.src = null;
//   recordedVideo.srcObject = null;
//   recordedVideo.src = window.URL.createObjectURL(superBuffer);
//   recordedVideo.controls = true;
//   recordedVideo.play();
// });

// const downloadButton = document.querySelector('button#download');
// downloadButton.addEventListener('click', () => {
//   const blob = new Blob(recordedBlobs, {type: 'video/webm'});
//   const url = window.URL.createObjectURL(blob);
//   const a = document.createElement('a');
//   a.style.display = 'none';
//   a.href = url;
//   a.download = 'test.webm';
//   document.body.appendChild(a);
//   a.click();
//   setTimeout(() => {
//     document.body.removeChild(a);
//     window.URL.revokeObjectURL(url);
//   }, 100);
// });


const submitButton = document.querySelector('button#save');
submitButton.addEventListener('click', () => {
  const blob = new Blob(recordedBlobs, {type: 'video/webm'});
//   const url = window.URL.createObjectURL(blob);

    var fileName = 'session.webm';  // or "wav"
    var fileObject = new File([blob], fileName, {
        type: 'video/webm'
    });

    var formData = new FormData();

    formData.append('video-blob', fileObject);
    formData.append('video-filename', fileObject.name);
    formData.append('candidate_id', cand_id);
    formData.append('interview_id', id);
    formData.append('client_id', client_id);

    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/blob-upload",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) { 
          //console.log(data);
            $('.alert-success').show();
            $('.alert-success').html(data.success_info);
              // window.location = 'http://127.0.0.1:8000/index';
          },error: function (request, status, error) {
            var json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('.alert-danger').show();
                $('.alert-danger').append('<h6>'+value+'</h6>').delay(10000).fadeOut();
            });
         }
      });
});


function handleDataAvailable(event) {
  console.log('handleDataAvailable', event);
  if (event.data && event.data.size > 0) {
    recordedBlobs.push(event.data);
  }
}

function getSupportedMimeTypes() {
  const possibleTypes = [
    'video/webm;codecs=vp9,opus',
    'video/webm;codecs=vp8,opus',
    'video/webm;codecs=h264,opus',
    'video/mp4;codecs=h264,aac',
  ];
  return possibleTypes.filter(mimeType => {
    return MediaRecorder.isTypeSupported(mimeType);
  });
}

function startRecording() {

  triggerTime();
  recordedBlobs = [];
  const mimeType = codecPreferences.options[codecPreferences.selectedIndex].value;
  const options = {mimeType};

  try {
    mediaRecorder = new MediaRecorder(window.stream, options);
  } catch (e) {
    console.error('Exception while creating MediaRecorder:', e);
    errorMsgElement.innerHTML = `Exception while creating MediaRecorder: ${JSON.stringify(e)}`;
    return;
  }

  console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
  recordButton.textContent = 'Stop';
//   playButton.disabled = true;
  submitButton.disabled = true;
  codecPreferences.disabled = true;
  mediaRecorder.onstop = (event) => {
    console.log('Recorder stopped: ', event);
    console.log('Recorded Blobs: ', recordedBlobs);
  };
  mediaRecorder.ondataavailable = handleDataAvailable;
  mediaRecorder.start();
  console.log('MediaRecorder started', mediaRecorder);
}

function stopRecording() {
  mediaRecorder.stop();
  alert('Session stopped!');
  clearTimeout(timeoutMyOswego);
}

function handleSuccess(stream) {
  recordButton.disabled = false;
  console.log('getUserMedia() got stream:', stream);
  window.stream = stream;

  const gumVideo = document.querySelector('video#gum');
  gumVideo.srcObject = stream;

  getSupportedMimeTypes().forEach(mimeType => {
    const option = document.createElement('option');
    option.value = mimeType;
    option.innerText = option.value;
    codecPreferences.appendChild(option);
  });
  codecPreferences.disabled = false;
}

async function init(constraints) {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    console.error('navigator.getUserMedia error:', e);
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

document.querySelector('button#start').addEventListener('click', async () => {
  document.querySelector('button#start').disabled = true;
  const hasEchoCancellation = document.querySelector('#echoCancellation').checked;
  const constraints = {
    audio: {
      echoCancellation: {exact: hasEchoCancellation}
    },
    video: {
      width: 1280, height: 720
    }
  };
  console.log('Using media constraints:', constraints);
  await init(constraints);
});

function triggerTime() { 

  var seconds;
  var temp;
  var GivenTime = document.getElementById('countdown').innerHTML
  
  function countdown() {
   var time = document.getElementById('countdown').innerHTML;
   var timeArray = time.split(':')
    seconds = timeToSeconds(timeArray);
    if (seconds == '') {
      temp = document.getElementById('countdown');
      temp.innerHTML = GivenTime;
      time = document.getElementById('countdown').innerHTML;
      timeArray = time.split(':')
      seconds = timeToSeconds(timeArray);
    }
    seconds--;
    temp = document.getElementById('countdown');
    temp.innerHTML = secondsToTime(seconds);
    globalThis.timeoutMyOswego = setTimeout(countdown, 1000);
    // var x = document.getElementById("clockdiv");
    if (secondsToTime(seconds) == '00:00') {
      clearTimeout(timeoutMyOswego);
      alert('Time up!');
        stopRecording();
        recordButton.disabled = true;
        submitButton.disabled = false;
    }
  }
  
  function timeToSeconds(timeArray) {
    var minutes = (timeArray[0] * 1);
    var seconds = (minutes * 60) + (timeArray[1] * 1);
    return seconds;
  }
  
  function secondsToTime(secs) {
    var hours = Math.floor(secs / (60 * 60));
    hours = hours < 10 ? '0' + hours : hours;
    var divisor_for_minutes = secs % (60 * 60);
    var minutes = Math.floor(divisor_for_minutes / 60);
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var divisor_for_seconds = divisor_for_minutes % 60;
    var seconds = Math.ceil(divisor_for_seconds);
    seconds = seconds < 10 ? '0' + seconds : seconds;
  
    return minutes + ':' + seconds;
    //hours + ':' + 
  
  }
  countdown();

  };
