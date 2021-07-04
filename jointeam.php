<?php

session_start() ; 
include 'config.php' ; 


if(isset($_POST['submit'])){ 

    $Keycode = $_POST['Keycode'] ;
    

    
    $query = "SELECT * FROM teams WHERE Keycode = '$Keycode' " ; 
    $result = $conn->query($query) ; 

    if( $result->num_rows ){ // ($resultSet->num_rows != 0)
        //If there exist a team like that, then process.

        $row = mysqli_fetch_assoc($result) ; 
        $TeamName = $row['TeamName'] ; 

        $tablename = $_SESSION['studenttablename'] ; 


        //Going to check if the student already enrolled in that particular team or not. 
        $query = "SELECT * FROM $tablename WHERE Keycode = '$Keycode' " ; 
        $result = $conn->query($query) ; 

        if( $result->num_rows ){
            //Student has already enrolled.
            echo"<script>alert('You have already enrolled in this team channel.Redirecting to main lobby.') </script>" ; 
            echo"<script>document.location='mainlobby.php'</script>" ;
        }
        else{
            $query = "INSERT INTO $tablename VALUES('$TeamName' , '$Keycode') " ; 
            $result = mysqli_query($conn, $query);

            if( $result ){ 
                echo"<script>alert('Joined team succesfully.Redirecting to main lobby.') </script>" ; 
                echo"<script>document.location='mainlobby.php'</script>" ;

            }else{ 
                echo"<script>alert('Unable to join team. Try again Late.Redirecting to main lobby.')</script>" ; 
                echo"<script>document.location='mainlobby.php'</script>" ;
            }
        }
        

    }
    else{ 
        echo mysqli_error($conn);
        echo"<script>alert('Invalid Team Name. Try again.')</script>" ; 
        echo"<script>document.location='jointeam.php'</script>" ; 
    }
}


?>


<html>
<!DOCTYPE html>
<html>
    <head>
        <title>Join Team</title> 
        <link rel="stylesheet" type="text/css" href="1Level/stylesheet.css">
    </head>

    <body>
        <form action="" method="POST" onsubmit="">
            <table>
                
                <tr>
                    <td><label for="Keycode">Keycode : </label></td>
                    <td><input type="text" id="Keycode" name='Keycode'></td>
                </tr>
        

                <tr>
                    <td colspan="2"><input type="submit" value="Join Team" name="submit"></td>
                </tr>

            </table>
        </form>
    </body>
</html>