<div class="mb-4 mb-md-5">
    <div id="text" class="tag_container">
        <h2 class="text-primary">Interview Questions</h2>
        <p class="text-muted">Answer all the questions below by clicking the record button to activate your webcam and then press.</p>
        <br><br>
        @foreach($questions as $data)
        <ul>
            <h5>{{ $data->id }}.  {{ $data->question }}</h5>
        </ul>
        @endforeach
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br>
<div  class="d-flex justify-content-center">
    {!! $questions->render() !!} 
</div>
</div> 
<script>
    function injectVoices(voicesElement, voices) {
       voicesElement.innerHTML = voices
          .map(function(voice) {
             var option = document.createElement('option');

             option.value = voice.lang;
             option.textContent = voice.name + (voice.default ? ' (default)' : '');
             option.setAttribute('data-voice-uri', voice.voiceURI);

             return option;
          })
          .map(function(option) {
             return option.outerHTML;
          })
          .join('');
    }

    function logEvent(string) {
       var log = document.getElementById('log');

       log.innerHTML = string + '<br />' + log.innerHTML;
    }

    if (!('SpeechSynthesisUtterance' in window)) {
       document.querySelector('.js-api-support').removeAttribute('hidden');
       [].forEach.call(document.querySelectorAll('form button'), function(button) {
          button.setAttribute('disabled', '');
       });
    } else {
       var text = document.getElementById('text').innerHTML;
       var voices = document.getElementById('voice');
       var rate = document.getElementById('rate');
       var pitch = document.getElementById('pitch');

       injectVoices(voices, speechSynthesis.getVoices());

       speechSynthesis.addEventListener('voiceschanged', function onVoiceChanged() {
          speechSynthesis.removeEventListener('voiceschanged', onVoiceChanged);

          injectVoices(voices, speechSynthesis.getVoices());
       });

       document.getElementById('button-speak').addEventListener('click', function() {
          var selectedOption = voices.options[voices.selectedIndex];
          var selectedVoice = speechSynthesis
             .getVoices()
             .filter(function(voice) {
                return voice.voiceURI === selectedOption.getAttribute('data-voice-uri');
             })
             .pop();

          // Create the utterance object setting the chosen parameters
          var utterance = new SpeechSynthesisUtterance();
          utterance.text = text;
          utterance.voice = selectedVoice;
          utterance.lang = selectedVoice.lang;
          utterance.rate = rate.value;
          utterance.pitch = pitch.value;

          utterance.addEventListener('start', function() {
             logEvent('Speaker started');
          });
          utterance.addEventListener('end', function() {
             logEvent('Speaker finished');
          });

          speechSynthesis.speak(utterance);
       });

    //    document.getElementById('button-stop').addEventListener('click', function() {
    //       speechSynthesis.cancel();
    //       logEvent('Speaker stopped');
    //    });

    //    document.getElementById('button-pause').addEventListener('click', function() {
    //       speechSynthesis.pause();
    //       logEvent('Speaker paused');
    //    });

    //    document.getElementById('button-resume').addEventListener('click', function() {
    //       speechSynthesis.resume();
    //       logEvent('Speaker resumed');
    //    });

    //    document.getElementById('clear-all').addEventListener('click', function() {
    //       document.getElementById('log').textContent = '';
    //    });
    }
 </script>

 <script>
     $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
 </script>
