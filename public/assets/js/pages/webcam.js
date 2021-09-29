var video = document.querySelector('video');
  
  function captureStream(callback) {
      navigator.mediaDevices.getUserMedia({video:true,audio:true}).then(function(stream) {
          callback(stream);
      }).catch(function(error) {
          alert('Unable to capture your stream. Please check console logs.');
          console.error(error);
      });
  }
  
  function stopRecordingCallback() {
      video.muted = false;
      video.volume = 1;
  
      video.src = video.srcObject = null;
  
      getSeekableBlob(recorder.getBlob(), function(seekableBlob) {
          video.src = URL.createObjectURL(seekableBlob);
  
          recorder.stream.stop();
          // recorder.destroy();
          // recorder = null;
  
          document.getElementById('btn-start-recording').disabled = true;
  
          //invokeSaveAsDialog(seekableBlob, 'seekable-recordrtc.webm');
  
          // get recorded blob
          var blob = recorder.getBlob();
  
          // generating a random file name
          var fileName = getFileName('webm');
  
          // we need to upload "File" --- not "Blob"
          var fileObject = new File([blob], fileName, {
              type: 'video/webm'
          });
  
          var formData = new FormData();
  
          // recorded data
          formData.append('video-blob', fileObject);
  
          // file name
          formData.append('video-filename', fileObject.name);
  
          document.getElementById('header').innerHTML = 'Uploading to PHP using jQuery.... file size: (' +  bytesToSize(fileObject.size) + ')';
  
          var upload_url = "{{ url('/fileupload/store')}}";
          // var upload_url = 'RecordRTC-to-PHP/save.php';
  
        //   var upload_directory = upload_url;
          // var upload_directory = 'RecordRTC-to-PHP/uploads/';
  
          // upload using jQuery
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: upload_url, // replace with your own server URL
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              method: 'POST',
              success: function(response) {
                  console.log(response);
                  // if (response === 'success') {
                  //     alert('successfully uploaded recorded blob');
  
                  //     // file path on server
                  //     var fileDownloadURL = upload_directory + fileObject.name;
  
                  //     // preview the uploaded file URL
                  //     document.getElementById('header').innerHTML = '<a href="' + fileDownloadURL + '" target="_blank">' + fileDownloadURL + '</a>';
  
                  //     // preview uploaded file in a VIDEO element
                  //     document.getElementById('your-video-id').srcObject = null;
                  //     document.getElementById('your-video-id').src = fileDownloadURL;
  
                  //     // open uploaded file in a new tab
                  //     window.open(fileDownloadURL);
                  // } else {
                  //     alert(response); // error/failure
                  // }
              }
          });
      });
  }
  
  // this function is used to generate random file name
      function getFileName(fileExtension) {
          var d = new Date();
          var year = d.getUTCFullYear();
          var month = d.getUTCMonth();
          var date = d.getUTCDate();
          return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
      }
  
      function getRandomString() {
          if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
              var a = window.crypto.getRandomValues(new Uint32Array(3)),
                  token = '';
              for (var i = 0, l = a.length; i < l; i++) {
                  token += a[i].toString(36);
              }
              return token;
          } else {
              return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
          }
      }
  
  var recorder; // globally accessible
  
  var videoMaxlengthInSeconds = 100000;
  
  document.getElementById('btn-start-recording').onclick = function() {
      this.disabled = true;
      captureStream(function(stream) {
          video.muted = true;
          video.volume = 0;
          video.srcObject = stream;
  
          recorder = RecordRTC(stream, {
              type: 'video'
          });
  
          var recordingDuration = videoMaxlengthInSeconds;
          recorder.setRecordingDuration(recordingDuration).onRecordingStopped(stopRecordingCallback);
  
          recorder.startRecording();
  
          // release stream on stopRecording
          recorder.stream = stream;
  
          document.getElementById('btn-stop-recording').disabled = false;
      });
  };
  
  document.getElementById('btn-stop-recording').onclick = function() {
      this.disabled = true;
      recorder.stopRecording(stopRecordingCallback);
  };
  
  function addStreamStopListener(stream, callback) {
      stream.addEventListener('ended', function() {
          callback();
          callback = function() {};
      }, false);
      stream.addEventListener('inactive', function() {
          callback();
          callback = function() {};
      }, false);
      stream.getTracks().forEach(function(track) {
          track.addEventListener('ended', function() {
              callback();
              callback = function() {};
          }, false);
          track.addEventListener('inactive', function() {
              callback();
              callback = function() {};
          }, false);
      });
  }