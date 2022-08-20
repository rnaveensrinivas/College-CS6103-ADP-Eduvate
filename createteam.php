<?php
session_start() ; 
include 'config.php' ; 

if( isset($_SESSION['Category'])){ //making sure only a valid person can access. 
    //But not checking if it is a student or teacher. 
    //This has to be fixed. 

    if(isset($_POST['submit'])){ 

        $TeacherID = $_SESSION['CollegeID'] ; 
        $TeamName = $_POST['TeamName'] ;
        $TeamName .= "_" ; 
        $TeamName .= $TeacherID ; //So that the team names for a teacher remains unique.
        //Since there is a possibility that multiple teacher can handle the same course.

        //Checking if the class exists or not. 
        $query = "SELECT * FROM teams WHERE TeamName = '$TeamName' " ; 
        $result = $conn->query($query) ; 

        if( $result->num_rows ){
            //Team already exists.
            $error .= "This team Name already exists.Try again." ; 
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
    $conn->close();
}
else{ 
    //invalid access detected. 
    header("location:index.html") ; 
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Create Team</title>
        <link rel="stylesheet" type="text/css" href="1Level/style2.css">
    </head>

    <body>
        
        <div class="logout">
            <button type="button" onclick="location.href='logout.php'" name="Logout" id="submit-button" style="background-color: white; color:rgb(95, 108, 255);">Sign Out</button>
        </div>
        <form method="POST" action="" autocomplete="off">
            <div class="form">
                <h2>Create Team</h2>
                <p style="color:red; line-height: 120%;"> <?php echo $error ; ?></p>

                <div class="email">
                    <label for="TeamName">Team name</label><br>
                    <input type="Text" id="TeamName" name='TeamName' required placeholder="Eg: CS6103"><br>
                </div>

                <button type="submit" name="submit" id="submit-button">Create Team</button>
            </div> 
        </form>
    </body>
 </html> 