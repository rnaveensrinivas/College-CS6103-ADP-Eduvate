<?php
include('../config.php') ; 

if(isset($_POST['submit'])){

    $em = $_GET['em'] ; 

    $conn = NEW mysqli($servername, $username, $password, $dbname);
      // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


    $checkMailIfExists = "SELECT * FROM users WHERE Email = '$em' LIMIT 1"; 
    $mailResult = mysqli_query($conn , $checkMailIfExists) ; 

    if( $mailResult->fetch_assoc() ){ 
        //Valid email. 
        $pwd1 = $_POST['pwd1'] ; 
        $pwd2 = $_POST['pwd2'] ; 

        if( $pwd1 != $pwd2){ 
            echo "<script>alert('The Passwords do not match. Try again.')</script>" ; 
        }
        else{ 
            $pwd1= $conn->real_escape_string($pwd1);//sanitizing
            $pwd1 = md5($pwd1); //encrypting
  
            $updatePassword = "UPDATE users SET Password1 = '$pwd1' where Email = '$em' " ; 
            $result = mysqli_query($conn , $updatePassword) ; 

            if($result){ 
                echo "<script>alert('The password has been changed succefully you may now login.'); document.location='login.php'</script>" ;
            }
            else{ 
            echo "<script>alert('Something went wrong. Try again.')</script>" ; 
            header('location:password.php') ; 
            }
        }
    }
    else { 
        echo "<script>alert('The account doesn't seem to exist.')</script>" ;
        header('location:resetpassword.php') ; 
    }
}


?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script src="valid.js"></script>
    </head>
    <body>
        <table>
            <form action="" method="POST" onsubmit="return checkPassword()">
                <tr>
                    <td><label for="pwd1">Password</label></td>
                    <td><input type="password" id="pwd1" name="pwd1"></td>
                </tr>

                <tr>
                    <td><label for="pwd2">Confirm Password</label></td>
                    <td><input type="password" id="pwd2" name="pwd2"></td>
                </tr>

                <tr>
                <td colspan="2"><input type="submit" value='Reset Password' name="submit"></td>
                </tr>
            </form>
        </table>    
    </body>
</html>