<?php
session_start() ; 
include 'config.php' ; 

if( isset($_SESSION['CollegeID'])){
    $teams = $_GET['TeamName'] ;
    $_SESSION['TeamName'] = $_GET['TeamName'] ; // This is for video calling. 

    if( $_SESSION['Category'] == "Teacher"){ 
        $getKeycode = "SELECT * FROM teams WHERE TeamName = '$teams'"; 
        $result = mysqli_query($conn , $getKeycode) ; 
        $row = $result->fetch_assoc() ; 
        $Keycode = $row['Keycode'] ; 
    }

    $PrintTeamName = substr($teams,0,-11) ;
    $conn->close();
}
else{ 
    header("location:index.html") ; 
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $PrintTeamName; ?></title>
        <link rel="stylesheet" type="text/css" href="1Level/style2.css">
    </head>
    <body>
        <button type="button" onclick="location.href='logout.php'" name="Logout" id="submit-button" style="float:right;">Sign Out</button>        <div class="form">
            <h2>Welcome to <?php echo $PrintTeamName; ?> </h2>
            <p style="line-height:120%;"> To allow users to join this channel refer below <br>KeyCode: <?php if( $_SESSION['Category'] == "Teacher"){echo $Keycode ;}?> </p>
            <button type="button" onclick="location.href='2Video/video.php'" id="submit-button" style="width:50% ; height:100% ; float:right; " >Video Call</button>
            <button type="button" onclick="location.href='3Chat/chat.html'" id="submit-button" style="width:50% ; height:100% ; float:left; " >Group Chat</button>
        </div> 
    </body>
 </html> 