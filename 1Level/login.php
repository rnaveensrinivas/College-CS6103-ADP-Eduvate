<?php
session_start() ; //starting a session because we are going to store the certain details from DB
//for future access. 

include '../config.php'; //here we're including the connection  

if ( isset($_POST['submit'])){ 
    //Getting the form data.

    $em = $conn->real_escape_string($_POST["em"]) ; // Sanitizing upon arrival. 
    $pwd1 = $conn->real_escape_string($_POST["pwd1"]) ;
    $pwd1 = md5($pwd1); //encrypting the password using md5 function.

    //query the database. 
    $resultSet = $conn->query("SELECT * FROM users WHERE Email = '$em' AND Password1 = '$pwd1' LIMIT 1") ; 
    
    if( $resultSet->num_rows ){ 
        //Process Login. 

        //if there exists a row, then fetch the row. Similar to a cursor fetch.
        $row = $resultSet->fetch_assoc() ; 
        $verified = $row['Verified'] ; //if email verification is done or not. 
        $em_database = $row['Email'] ; //if the above is not done then we prompt an error. 
        $CollegeID = $row['CollegeID'] ; //table name is made from collegeID
        $Password1 = $row['Password1'] ; 
        $createdDate = $row['CreatedDate'] ;
        $Category = $row['Category'] ; 
        $FullName = $row['FullName'] ;  

        //Putting all those variables into the session, so that we can use them in upcoming pages. 
        $_SESSION['CollegeID'] = $CollegeID ;
        $_SESSION['Password1'] = $Password1 ; 
        $_SESSION['FullName'] = $FullName ;   
        $_SESSION['Category'] = $Category ; 
    
        if ( $verified ){ // if it is a verifed account.
            header('location:../mainlobby.php');
        }
        else{ 
            $error .= "This account needs to be verified.<br>Mail: '$em_database'<br>Date Created : '$createdDate'. "; 
        }
    }
    else{
        //There exist no combination of username and password. 
        $error .= "Invalid Username or password. Try Again. " ; 
    }
}
$conn->close() ; 
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
        <script src="validation.js"></script>
    </head>

    <body onload="newCaptcha()">
        <form  action="" method="POST" autocomplete="off">
            <!-- Every single page except home is implemented with the help of form box style. -->
            <div class="form">

                <h2>Where Have You Been?</h2>
                <p>Let's continue eduvating!</p>

                <!-- If any error comes up, it will be displayed here. -->
                <p style="color:red; line-height: 120%; "><?php echo $error ; ?></p>
            
                <div class="email">
                    <label for="em">E-mail</label><br>
                    <input type = "email" id="em" name="em" required><br>
                </div>
      
                <label for="pwd1">Password</label><br>
                <input type="password" id="pwd1" name="pwd1" minlength="8" pattern="[0-9a-fA-F!@#$%^&*_-.]" required >
                <a href="resetpassword.php" style="text-decoration:none; font-size: 15px;">Forgot Password?</a><br><br>

                <!-- The below captcha can be copy pasted. -->
                <!-- which beats the purpose of captcha. This is fixed in Hyre.-->
                <button type="button" onclick="newCaptcha()" id="cap" title="Give a new Captcha.">New Captcha</button>
                <input type="text"  id="captcha" class="searchBox" readonly>
                <input type="text" id="enteredCaptcha" placeholder="Enter Above Captcha" style="text-align:center; font-size: 17px;"><br><br>

                
                <!-- There were few bugs here, check Hyre for clean captcha implementation. -->
                <button type="submit" onclick="return validCaptcha()" name="submit" id="submit-button">Login</button>
                <p style="font-size :15px; " >New User ? <a href="signup.php" style="text-decoration:none; font-size: 15px;">Sign-Up</a></p>

                <script>
                    //this is redundacny of code, why it was hardcoded here because there is checkPassowrd in 
                    //validCaptcha in that validation of homepage, 
                    //In the definition of checkCaptcha we had checkPassowrd also, which was exclusive to 
                    //signup page.
                    //Here don't have to check if passwords match. 

                    function validCaptcha(){ 
                        var captcha = document.getElementById('captcha').value ; 
                        var enteredCaptcha = document.getElementById('enteredCaptcha').value ; 
                        
                        if( enteredCaptcha == '' ){ 
                            alert("Enter the captcha.") ; 
                            return false ; 
                        }
                        else if( captcha != enteredCaptcha ){ 
                            alert("Wrong captcha Try again.") ; 
                            return false ; 
                        }
                    }
                </script>
            </div> 
        </form>
    </body>
</html>