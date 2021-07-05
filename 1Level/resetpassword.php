<?php

include '../config.php';

if( isset($_POST['submit'])){ //Checking if the form is submitted. 

    $em= $conn->real_escape_string($_POST["em"]); //getting the mail and sanitiziing it.
  

    $checkMailIfExists = "SELECT * FROM users WHERE Email = '$em'" ; //Checking if email already exists. 
    $mailResult = mysqli_query($conn , $checkMailIfExists) ; 


    if( $mailResult->fetch_assoc()){
        $to = $em ; 
        $subject = "Reset Password." ; 
        // I am sending $vkey along with the page in mail.
        $message = "<p>Hi thanks for approaching Eduvate support to change account password please click <a href='http://localhost/Eduvate-app/1Level/password.php?em=$em'>Here</a></p>" ; 
        $headers = "From: appeduvate@gmail.com \r\n" ; //App i am send form. 
        $headers .= "MIME-Version: 1.0" . "\r\n" ; // \r - return carriage || \n - newline 
        $headers .= "Content-type:text/html;charset=UTF-8". "\r\n" ; 

        mail($to , $subject , $message, $headers) ; 

        header('location:thankyou.php');
    } 
    else{    
        echo "<script>alert('This Email invalid. Go to Signup page.')</script>" ; 
    }  
  $conn->close();
}


?>


<!--<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <form action="" method="POST">
            <table>
                <tr>
                    <td colspan = "2">Enter your email address to<br> verify and change password.</td>
                </tr>
                <tr>
                    <td>
                        Email : 
                    </td>
                    <td>
                        <input type="email" name="em" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="submit">Send Mail</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>-->

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>
        <?php 
          echo $error ; 
        ?>
        <form method="POST" action="" autocomplete="off">
        <div class="form">
            <h2>Reset Password</h2>
            <p>Enter your registered email address</p>
            <div class="email">
            <label for="em">E-mail</label><br>
            <input type = "email" id="em" name="em" required placeholder="abcd@gmail.com"><br>
            </div>
            <button type="submit" name="submit" id="submit-button">Send Mail</button>
        </div> 
        </form>
    </body>
 </html> 