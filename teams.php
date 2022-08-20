<?php
session_start() ; 
include 'config.php' ; 

if( isset($_SESSION['CollegeID'])){
    $teams = $_GET['TeamName'] ; //we came to this page from mainlobby. So, when an user clicks a particular team, they're redirected here. 
    $_SESSION['TeamName'] = $_GET['TeamName'] ; // This is for video calling. so we're passing it as session variable.

    if( $_SESSION['Category'] == "Teacher"){ 

        //If the user is a teacher, then display the keycode for this team using which students can enroll here. 
        $getKeycode = "SELECT * FROM teams WHERE TeamName = '$teams'"; 
        $result = mysqli_query($conn , $getKeycode) ; 
        $row = $result->fetch_assoc() ; 
        $Keycode = $row['Keycode'] ; //We're just getting the keycode here. 
    }

    $PrintTeamName = substr($teams,0,-11) ; //getting the team variable ready, we will be putting this in HTML below. 
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
        <div class="logout">
            <button type="button" onclick="location.href='logout.php'" name="Logout" id="submit-button" style="background-color: white; color:rgb(95, 108, 255);">Sign Out</button>
        </div>
        <div class="form">
            <h2>Welcome to <?php echo $PrintTeamName; ?> </h2>
            <?php if( $_SESSION['Category'] == "Teacher"){ ?>
                <p style="line-height:120%;"> To allow users to join this channel refer below <br>KeyCode:  </p>
            <?php echo $Keycode ;}?>
            
            <button type="button" onclick="location.href='2Video/video.php'" id="submit-button" style="width:50% ; height:100% ; float:right; " >Video Call</button>
            <a href="https://60ea725ba5133508bfa1b273--ecstatic-galileo-ebbce8.netlify.app/"> <button type="button"  id="submit-button" style="width:50% ; height:100% ; float:left; " >Group Chat</button></a>
        </div>
    </body>
 </html> 