<?php
	session_start() ; 
?>
<!-- API GIVES ALL THESE. --> 
<html lang="en">
	<head>
		<title><?php echo $_SESSION['TeamName'];?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body style="background-color: rgb(95, 108, 255);">
		<div class="container-fluid p-0">
			<div id="main-container">
				<div id="screen-share-btn-container" class="col-2 float-right text-right mt-2">
					<button id="screen-share-btn"  type="button" class="btn btn-lg">
						<i id="screen-share-icon" class="fas fa-desktop"></i>
					</button>
				</div>
				<div id="buttons-container" class="row justify-content-center mt-3">
					<div class="col-md-2 text-center">
						<button id="mic-btn" type="button" class="btn btn-block btn-dark btn-lg">
							<i id="mic-icon" class="fas fa-microphone"></i>
						</button>
					</div>
					<div class="col-md-2 text-center">
						<button id="video-btn"  type="button" class="btn btn-block btn-dark btn-lg">
							<i id="video-icon" class="fas fa-video"></i>
						</button>
					</div>
					<div class="col-md-2 text-center">
						<button id="exit-btn"  type="button" class="btn btn-block btn-danger btn-lg">
							<i id="exit-icon" class="fas fa-phone-slash"></i>
						</button>
					</div>
				</div>
				<div id="full-screen-video"></div>
				<div id="lower-video-bar" class="row fixed-bottom mb-1">
					<div id="remote-streams-container" class="container col-9 ml-1">
						<div id="remote-streams" class="row">
							<!-- insert remote streams dynamically -->
						</div>
					</div>
					<div id="local-stream-container" class="col p-0">
						<div id="mute-overlay" class="col">
							<i id="mic-icon" class="fas fa-microphone-slash"></i>
						</div>
						<div id="no-local-video" class="col text-center">
							<i id="user-icon" class="fas fa-user"></i>
						</div>
						<div id="local-video" class="col p-0"></div>
					</div>
				</div>
			</div>
		</div>

    <div class="modal fade" id="modalForm">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">

			<!-- here is where we're telling them to join the teams, like confirmation page.-->
            
			
			<h4 class="modal-title w-100 font-weight-bold">Join Channel</h4>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body mx-3">
            <!--
            <div class="md-form mb-4">
              <input type="number" id="form-uid" class="form-control" value="1001" data-decimals="0"/>
              <label for="form-uid">UID</label>
            </div>
			-->
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button id="join-channel" class="btn btn-default">Join Video Call</button>
          </div>
        </div>
      </div>

    </div>
	</body>
	<script src="AgoraRTCSDK-3.3.1.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- You need ajay for JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- You might need some js for bottstrap. so we're including that also. -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">

		//intially all the properities are disabled. 
		//because first we have join the room with authenticate ourselves. 
		$("#mic-btn").prop("disabled", true);
		$("#video-btn").prop("disabled", true);
		$("#screen-share-btn").prop("disabled", true);
		$("#exit-btn").prop("disabled", true);


		//here is where submit the form.
		//we have a html tag above.
		$(document).ready(function(){
			$("#modalForm").modal("show");
		});
	</script>
	<script type="text/javascript">
		// init the session when user clicks join btn
		$( "#join-channel" ).click(function( event ) {

			//appId and token are taken manually from the site. 
			var agoraAppId = "59254f5c7d294821abdc103716a2417c";
			var token = "59254f5c7d294821abdc103716a2417c";

			//This below room we get from the 
			var channelName = "<?php echo $_SESSION['TeamName'] ; ?>";
			var uid = "<?php echo $_SESSION['CollegeID'] ; ?>";

			//
			//From their home page, they will click join team. 
			//It will redirect them to this video page. 
			//all the things will be in the background, but disabled. 
			//Like an intermediary confirm page similar to teams. 
			//here we can only click the button and join. 
			//check the above html.

			$("#modalForm").modal("hide"); //hiding the join button. 

			//These are the necessary things to join the meet. 
			initClientAndJoinChannel(agoraAppId, token, channelName, uid);
		});
	</script>
	<!--<script src="ui.js"></script>-->
	<?php include('ui.php') ?>

	<script src="agora-interface.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</html>