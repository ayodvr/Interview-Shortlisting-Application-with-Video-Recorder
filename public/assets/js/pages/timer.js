$(".startClock").click( function(){  
  var seconds;
var temp;
var GivenTime = document.getElementById('countdown').innerHTML

function countdown() {
  time = document.getElementById('countdown').innerHTML;
  timeArray = time.split(':')
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
  var timeoutMyOswego = setTimeout(countdown, 1000);
  // var x = document.getElementById("clockdiv");
  if (secondsToTime(seconds) == '00:00') {
    clearTimeout(timeoutMyOswego); //stop timer
    // x.style.display === "none"
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
});