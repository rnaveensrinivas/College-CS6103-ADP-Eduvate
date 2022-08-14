<?php
//session_start();
//comes with api.
//for session variable we named this file as .php
//But this is just full of js. 

//Below is JQuery
?>

<html>

<script>

function enableUiControls(localStream) {
  //local instrance is an instance of video call. 
  //each of the room is an instance. 
  //we can have multiple rooms right. 
  //In a nutshell local stream is an instance of a meeting room. 

  //initializing the buttons. 
  //The prop() method sets or returns properties and values of the selected elements.
  //disable means it is unusable / unclickable. 
  //here we're enabling it, hence making it usuable. 
  // Disable #x
  //$( "#x" ).prop( "disabled", true );
 
  // Enable #x
  //$( "#x" ).prop( "disabled", false );


  //we are enabling various buttons we have. 
  $("#mic-btn").prop("disabled", false);
  $("#video-btn").prop("disabled", false);
  $("#screen-share-btn").prop("disabled", false);
  $("#exit-btn").prop("disabled", false);

  //it unmutes and does the necessary CSS.
  $("#mic-btn").click(function(){
    toggleMic(localStream);
  });

  //it controls visibility and its associated CSS. 
  $("#video-btn").click(function(){
    toggleVideo(localStream);
  });


  $("#screen-share-btn").click(function(){
    toggleScreenShareBtn(); // set screen share button icon

    //disabling the button. 
    //if you're already screen sharing no point of screen sharing again. 
    $("#screen-share-btn").prop("disabled",true); // disable the button on click

    //multiple people can't screen share at a time. 
    if(screenShareActive){
      stopScreenShare(); //an agora function, some else is already screen sharing to stop them, so that you can start. 
    } else {
      //This is expired IT. 
      var agoraAppId = "59254f5c7d294821abdc103716a2417c";
			var channelName = "<?php echo $_SESSION['TeamName'] ; ?>";
      initScreenShare(agoraAppId, channelName);  //screen share starts. 
    }
  });

  $("#exit-btn").click(function(){
    console.log("so sad to see you leave the channel");//It will be there console section in inspect page.
    leaveChannel(); //API funtion that helps us leave the room. 
  });

  // keyboard listeners 
  //For keyboard shortcuts. 
  //document involves all the button. 
  $(document).keypress(function(e) {

    switch (e.key) {
      case "m":
        console.log("squick toggle the mic");
        toggleMic(localStream); //same thing as manual button clicks. 
        break;
      case "v":
        console.log("quick toggle the video");
        toggleVideo(localStream);
        break; 
      case "s":
        console.log("initializing screen share");
        toggleScreenShareBtn(); // set screen share button icon
        $("#screen-share-btn").prop("disabled",true); // disable the button on click
        if(screenShareActive){
          stopScreenShare();
        } else {
          initScreenShare(); 
        }
        break;  
      case "q":
        console.log("so sad to see you quit the channel");
        leaveChannel(); 
        break;   
      default:  // do nothing
    }

    // (for testing) reloads the page. 
    if(e.key === "r") { 
      window.history.back(); // quick reset
    }
  });
}

//Below does CSS work on the button. 
function toggleBtn(btn){
  //predefined variables in bootstrap. 
  //ui.php is included in video.php , hence we are kind of improting bootstrap and ui in video. 
  //hence it will work .

  //here it will keep swapping between the below to class at each call. 
  btn.toggleClass('btn-dark').toggleClass('btn-danger');
}

function toggleScreenShareBtn() {
  //Deals with CSS of screen share button. 
  //screen-share-btn defines the class, it is present in CSS.
  $('#screen-share-btn').toggleClass('btn-danger');

  //keeps switching between sqare and circle. 
  //So that we know who is screen sharing. 
  //everyhas a circle, when they start screen sharing it becomes a square. 
  $('#screen-share-icon').toggleClass('fa-share-square').toggleClass('fa-times-circle');
}

function toggleVisibility(elementID, visible) {

  //go to toggleMic and toggleVideo from there trace the function call, to understand the function. 
  //It's just for CSS. 
  if (visible) {
    $(elementID).attr("style", "display:block");
  } else {
    $(elementID).attr("style", "display:none");
  }
}

//this will take care of css and also unmuting. 
function toggleMic(localStream) {
  toggleBtn($("#mic-btn")); // toggle button colors

  //toggle is for swtiching between class. 

  //it just loops around the two classes. 
  //if initially it is fa-microphone then it changes to fa-microphone-slash
  //if initially it is fa-microphone-slash then it changes to fa-microphone
  $("#mic-icon").toggleClass('fa-microphone').toggleClass('fa-microphone-slash'); // toggle the mic icon
  
  //if it has fa-microphone then it has to be unmuted. 
  if ($("#mic-icon").hasClass('fa-microphone')) {
    localStream.unmuteAudio(); // enable the local mic
    toggleVisibility("#mute-overlay", false); // hide the muted mic icon
  } else {
    localStream.muteAudio(); // mute the local mic
    toggleVisibility("#mute-overlay", true); // show the muted mic icon
  }

}

function toggleVideo(localStream) {

  toggleBtn($("#video-btn")); // toggle button colors

  //this basically loops in these two options. 
  $("#video-icon").toggleClass('fa-video').toggleClass('fa-video-slash'); // toggle the video icon
  
  if ($("#video-icon").hasClass('fa-video')) {
    localStream.unmuteVideo(); // enable the local video
    toggleVisibility("#no-local-video", false); // hide the user icon when video is enabled
  } else {
    localStream.muteVideo(); // disable the local video
    toggleVisibility("#no-local-video", true); // show the user icon when video is disabled
  }
}
</script>

</html>