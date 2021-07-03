<?php

session_start() ; 

include 'config.php' ; 
$conn = NEW mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
    die(" Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){ 
    $TeacherID = $_SESSION['CollegeID'] ; 

    $TeamName = $_POST['TeamName'] ;
    $TeamName .= "_" ; 
    $TeamName .= $TeacherID ; //So that the team names for a teacher remains unique.

    $TeacherName = $_SESSION['FullName']  ; 

    $Keycode = md5(time().$TeamName) ; //Creating an encryption Keycode.
    $Keycode = substr($Keycode,0,10) ; //Taking only the first 10 char of encryption created. 

    $query = "INSERT INTO teams(TeamName, TeacherName , TeacherID , Keycode ) VALUES('$TeamName', '$TeacherName' , '$TeacherID' , '$Keycode')" ; 
    $result = $conn->query($query) ; 

    if( $result ){
        echo"<script>alert('Team channel created succesfully.<br>Redirecting to main lobby.') </script>" ; 
        echo"<script>document.location='mainlobby.php'</script>" ;
    }
    else{ 
        echo mysqli_error($conn);
        echo"<script>alert('Unable to create a team channel.<br>Redirecting to main lobby.') </script>" ; 
        echo"<script>document.location='mainlobby.php'</script>" ; 
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Create Team</title> 
        <link rel="stylesheet" type="text/css" href="1Level/stylesheet.css">
    </head>

    <body>
        <form action="" method="POST" onsubmit="">
            <table>
                <tr>
                    <td><label for="TeamName">Team name : </label></td>
                    <td><input type="Text" id="TeamName" name='TeamName'></td>
                </tr>
        

                <tr>
                    <td colspan="2"><input type="submit" value="Create Team" name="submit"></td>
                </tr>

            </table>
        </form>
    </body>
</html>