<?php

session_start() ; 

include 'config.php' ; 

if(isset($_POST['submit'])){ 
    $TeacherID = $_SESSION['CollegeID'] ; 

    $TeamName = $_POST['TeamName'] ;
    $TeamName .= "_" ; 
    $TeamName .= $TeacherID ; //So that the team names for a teacher remains unique.

    //Checking if the class exists or not. 
    $query = "SELECT * FROM teams WHERE TeamName = '$TeamName' " ; 
    $result = $conn->query($query) ; 

    if( $result->num_rows ){
        //Team already exists.
        
        echo"<script>alert('This team Name already exists.Try again.') </script>" ; 
        echo"<script>document.location='mainlobby.php'</script>" ;
    }
    else{
        $TeacherName = $_SESSION['FullName']  ;
        

        $Keycode = md5(time().$TeamName) ; //Creating an encryption Keycode.
        $Keycode = substr($Keycode,0,10) ; //Taking only the first 10 char of encryption created. 

        $query = "INSERT INTO teams(TeamName, TeacherName , TeacherID , Keycode ) VALUES('$TeamName', '$TeacherName' , '$TeacherID' , '$Keycode')" ; 
        $result = $conn->query($query) ; 

        if( $result ){
            echo"<script>alert('Team channel created succesfully.Redirecting to main lobby.') </script>" ; 
            echo"<script>document.location='mainlobby.php'</script>" ;
        }
        else{ 
            //echo mysqli_error($conn);
            echo"<script>alert('Unable to create team channel.Redirecting to main lobby.') </script>" ; 
            echo"<script>document.location='mainlobby.php'</script>" ; 
        }
    }
}

?>

<!--

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
-->


<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" type="text/css" href="1Level/style2.css">
    </head>
    <body>
        <?php 
         // echo $error ; 
        ?>
        <form method="POST" action="" autocomplete="off">
        <div class="form">
            <h2>Create Team</h2>
            <p></p>
            <div class="email">
            <label for="TeamName">Team name</label><br>
            <input type="Text" id="TeamName" name='TeamName' required placeholder="Eg: CS6103"><br>
            </div>
            <button type="submit" name="submit" id="submit-button">Create Team</button>
        </div> 
        </form>
    </body>
 </html> 