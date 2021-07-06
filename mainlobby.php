<!DOCTYPE html>
<html>
    <head>
        <title>About</title>
        <link rel="stylesheet" type="text/css" href="1Level/style2.css">
    </head>


    <body>
        <div class="form">
            <h2>Welcome to your online classroom</h2>
            <p></p>
        
            <!--<button type="button" onclick="location.href='../index.html'" id="submit-button">Homepage</button> -->
   



<?php

session_start() ; 
include 'config.php' ; 

// Displaying student main lobby
if( $_SESSION['Category'] == "Student"){ 

    //To get the student table name. 
    $tablename = $_SESSION['CollegeID'] ; 
    $tablename = "s" . $tablename ; 
    $_SESSION['studenttablename'] = $tablename ; 

    //For displaying all the teams they have enrolled in. 
    $selectAllTeamNames = "SELECT * FROM $tablename " ; 
    if ( $result = mysqli_query( $conn, $selectAllTeamNames ) ) { 
        while ( $row = mysqli_fetch_assoc($result) ) { 
            $teams = $row['TeamName'] ; 
            $PrintTeamName = substr($teams,0,-11) ;
            echo "<h3>Team : $PrintTeamName "; 
            echo "<a href='teams.php?TeamName=$teams' id='submit-button'><button> Join </button></a></h3>" ;
            //Joining a specific team page. And we are passing the team name using GET to that teams page.
        }
    }
    else{ 
        //echo "<script>alert('You have to join a new team.')</script>" ; 
    }

    // Creating 

?>

    <button onclick="location.href='jointeam.php'" id="submit-button">Join Team</button>
    

<?php

}   // Displaying teacher main lobby
else { 
      
    $CollegeID  = $_SESSION['CollegeID'] ; 

    // Trying to display all the teams teacher has created.
    $selectAllTeam = "SELECT * FROM teams where TeacherID = '$CollegeID' " ; 
    if ( $result = mysqli_query( $conn, $selectAllTeam ) ) { 
        while ( $row = mysqli_fetch_assoc($result) ) { 
            $teams = $row['TeamName'] ; 
            $PrintTeamName = substr($teams,0,-11) ;
            echo "<h3>Team : $PrintTeamName "; 
            echo "<a href='teams.php?TeamName=$teams' id='submit-button'><button> Join </button></a></h3>" ;
            //Joining a specific team page. And we are passing the team name using GET to that teams page.
        }
    }

?>

    <button onclick="location.href='createteam.php'" id='submit-button'>Create Team</a></button>

<?php

}

?>

<!--<!DOCTYPE html>
<html>
    <body>
        <h1>Welcome to your online classroom</h1>
    </body>
</html>-->


        </div> 
    </body>
</html>