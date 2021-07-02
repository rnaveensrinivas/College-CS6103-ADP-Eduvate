<?php

$error = NULL ; 

include '../config.php'   ; 

if ( isset($_POST['submit'])){ 

    $conn = NEW mysqli($servername, $username, $password, $dbname);
      // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //Getting the form data.
    $em = $conn->real_escape_string($_POST["em"]) ; // Sanitizing upon arrival. 
    $pwd1 = $conn->real_escape_string($_POST["pwd1"]) ;
    $pwd1 = md5($pwd1); 

    //query the database. 
    $resultSet = $conn->query("SELECT * FROM users WHERE Email = '$em' AND Password1 = '$pwd1' LIMIT 1") ; 
    
    if( $resultSet->num_rows != 0 ){ 
        //Process Login. 
        $row = $resultSet->fetch_assoc() ; 
        $verified = $row['Verified'] ; 
        $em_database = $row['Email'] ; 
        $createdDate = $row['CreatedDate']; 
    
        if ( $verified){ 
            header('location:../mainlobby.php');
        }
        else{ 
            echo "This account needs to be verified. Mail : '$em_database' Date Created : '$createdDate'."; 
        }
    }
    else{
        echo "<script>alert('Invalid Username or password.')</script>" ; 
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title> 
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script src="valid.js"></script>
    </head>

    <body onload="newCaptcha()">

        <form action="" method="POST" onsubmit="return validCaptcha();">
            <table>
                <tr>
                    <td><label for="email">Email : </label></td>
                    <td><input type="email" id="em" name='em'></td>
                </tr>
                <tr>
                    <td><label for="pwd1">Password : </label></td>
                    <td><input type="password" id="pwd1" name="pwd1"></td>
                </tr>

                <tr>
                    <td>
                        <button type="submit" onclick="newCaptcha()">New Captcha</button><br>
                        <input type="text" readonly id="captcha" size="9" style="text-align: center;"> 
                    </td>
                    <td><input type="text" id="enteredCaptcha"></td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="submit" value="Login" name="submit"><br>
                    <a href="resetpassword.php">Forgot Password ? </a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>