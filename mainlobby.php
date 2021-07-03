<?php

session_start() ; 
include 'config.php' ; 

$conn = NEW mysqli($servername, $username, $password, $dbname);
      // Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

if( $_SESSION['Category'] == "Student"){ 

    $tablename = "s".$_SESSION['CollegeID'] ; 
    $result = mysqli_query( $conn, "SELECT * FROM '$tablename' LIMIT 1"); 
    while ( $row = mysqli_fetch_array($result) ) { 
        $teams = $row['TeamName'] ; 
        echo "Team : '$teams' \n"; 
    }

    echo "<a link ='jointeam.php'> Join Team</a>"  ;


}
else { 
    
    $CollegeID  = $_SESSION['CollegeID'] ; 

    $resultSet = $conn->query("SELECT * FROM teams where CollegeID = '$CollegeID' LIMIT 1"); 
    while ( $row = mysqli_fetch_array($resultSet) ) { 
        $teams = $row['TeamName'] ; 
        echo "Team : '$teams' \n"; 
    }

    echo "<a link ='createteam.php'>Create Team</a>"  ;



}



session_close() ; 
?>




<!DOCTYPE html>
<html>
    <body>
        <h1>Welcome to your online classroom</h1>
    </body>
</html>