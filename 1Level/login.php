<?php

session_start() ; 

$error = NULL ; 

include '../config.php'   ; 

if ( isset($_POST['submit'])){ 

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
        $CollegeID = $row['CollegeID'] ; 
        $Password1 = $row['Password1'] ; 
        $createdDate = $row['CreatedDate'] ;
        $Category = $row['Category'] ; 

        $LastName = $row['LastName'] ;
        $FirstName = $row['FirstName'] ;  

        $FullName = $FirstName ; 
        $FullName .= '_' ; 
        $FullName .= $LastName ;

        $_SESSION['CollegeID'] = $CollegeID ;
        $_SESSION['Password1'] = $Password1 ; 
        $_SESSION['FullName'] = $FullName ;   
        $_SESSION['Category'] = $Category ; 
    
        if ( $verified ){ // if it is a verifed account.
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

<!--<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title> 
        <link rel="stylesheet" type="text/css" href="style2.css">
        <script src="valid.js"></script>
    </head>

    <body onload="newCaptcha()">
   
        <form action="" method="POST" onsubmit="return validCaptcha();">
        <div class="form">
            <h2>Where Have You Been?<h2>
            <p>Let's continue eduvating!</p>
                    <label for="email">Email : </label>
                    <input type="email" id="em" name='em'>
                    <label for="pwd1">Password : </label>
                    <input type="password" id="pwd1" name="pwd1">
    
                        <button type="button" onclick="newCaptcha()" id="cap">New Captcha</button><br>
                        <input type="text" readonly id="captcha" size="9" style="text-align: center;"> 
                        <input type="text" id="enteredCaptcha"></td>

                    <input type="submit" value="Login" name="submit"><br>
                    <a href="resetpassword.php">Forgot Password ? </a>
        </form>
    </body>
</html>-->
<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
        <script src="valid.js"></script>
    </head>


    <body onload="newCaptcha()">
        

        <?php 
          echo $error ; 
        ?>
        <form method="POST" action="" autocomplete="off" onsubmit="return validCaptcha()">
        <div class="form">
            <h2>Where Have You Been?</h2>
            <p>Let's continue eduvating!</p>
            <div class="email">
            <label for="em">E-mail</label><br>
            <input type = "email" id="em" name="em" required placeholder="abcd@gmail.com"><br>
            </div>
      
                <label for="pwd1">Password</label><br>
                <input type="password" id="pwd1" name="pwd1" minlength="8" pattern="[0-9a-fA-F!@#$%^&*_-.]">
                <a href="resetpassword.php" style="text-decoration:none; font-size: 15px;">Forgot Password?</a><br><br>

                <button type="button" onclick="newCaptcha()" id="cap">New Captcha</button>
                <input type="text"  id="captcha" class="searchBox" readonly>
               

                <input type="text" id="enteredCaptcha" placeholder="Enter Above Captcha" style="text-align:center; font-size: 17px;"><br><br>
                <button type="submit" name="submit" id="submit-button">Login</button>
         
        
        </div> 
        </form>
    </body>
</html>