<?php

include 'config.php' ; 


$teams = $_GET['TeamName'] ; 

$PrintTeamName = substr($teams,0,-11) ;
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo$PrintTeamName ?></title>
        <link rel="stylesheet" type="text/css" href="1Level/style2.css">
    </head>
    <body>
    
        <div class="form">
            <h2>Welcome to <?php echo $PrintTeamName; ?> </h2>
            <p></p>
            <button type="button" onclick="location.href='2Video/video.php'" id="submit-button" style="width:50% ; height:100% ; float:right; " >Video Call</button>
            <button type="button" onclick="location.href='3Chat/chat.html'" id="submit-button" style="width:50% ; height:100% ; float:left; " >Group Chat</button>

        </div> 
        </form>
    </body>
 </html> 