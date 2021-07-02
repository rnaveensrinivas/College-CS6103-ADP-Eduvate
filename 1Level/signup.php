<?php

include '../config.php';

$error = " " ;

if( isset($_POST['submit'])){ //Checking if the form is submitted. 

  $em=$_POST["em"];
  $uid=$_POST["uid"];
  $pwd1=$_POST["pwd1"]; 
  $pwd2=$_POST["pwd2"];


  $conn = NEW mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 


  $checkMailIfExists = "SELECT * FROM users WHERE Email = '$em'" ; //Checking if email already exists. 
  $checkCollegeIDIfExists = "SELECT * FROM users WHERE CollegeID = '$uid'" ; //Checking if College ID already exists. 
  $mailResult = mysqli_query($conn , $checkMailIfExists) ; 
  $collegeIDResult =  mysqli_query($conn , $checkCollegeIDIfExists) ; 



  if( $mailResult->fetch_assoc()){
    echo "<script>alert('This Email already exists. Go to login page.')</script>" ; 
  }
  else if( $collegeIDResult->fetch_assoc()){
    echo "<script>alert('This College Id already exists. Go to login page.')</script>" ; 
  }
  else if( $pwd1 != $pwd2 ){ 
    echo "<script>alert('Passwords do not match.')</script>";
  }
  else{    //Server Side validation is done. 

    //Getting rest of the details here. 
    $fname=$_POST["fname"];
    $lname= $_POST["lname"];
    $col=$_POST["col"];
    $categ=$_POST["categ"];
    $dept=$_POST["dept"];

    //sanitize form data. - removes all illegal form data.
    $em= $conn->real_escape_string($em);
    $fname=$conn->real_escape_string($fname);
    $lname=$conn->real_escape_string($lname);
    $col=$conn->real_escape_string($col);
    $categ=$conn->real_escape_string($categ);
    $uid=$conn->real_escape_string($uid);
    $dept=$conn->real_escape_string($dept);
    $pwd1=$conn->real_escape_string($pwd1); 
      
    //encrypting the password. 
    $pwd1 = md5($pwd1) ; //md5() is an encrypting function. 

    //generate Vkey
    $Vkey = md5(time().$fname) ; // based on timestamp.  
      
    $insert = "INSERT INTO Users (Email,FirstName,LastName,College,Category,CollegeID,Department,Password1,Vkey) VALUES ('$em','$fname','$lname','$col','$categ','$uid','$dept','$pwd1','$Vkey')";

    if ($conn->query($insert)) { 

      //Now that necessary emails are sent. We are going to start with verification.
    
      $to = $em ; 
      $subject = "Email Verification." ; 
      // I am sending $vkey along with the page in mail.
      $message = "<p> Hi thanks for signing up with Eduvate to Verify your account please click <a href='http://localhost/Eduvate-app/1Level/page.php?Vkey=$Vkey'>Here</a></p>" ; 
      $headers = "From: appeduvate@gmail.com \r\n" ; //App i am send form. 
      $headers .= "MIME-Version: 1.0" . "\r\n" ; // \r - return carriage || \n - newline 
      $headers .= "Content-type:text/html;charset=UTF-8". "\r\n" ; 

      mail($to , $subject , $message, $headers) ; 

      header('location:thankyou.php');//Where do you want to send them to after verification. 

    }  
  }
  $conn->close();
}


?>




<!DOCTYPE html>
<html>
    <head>
        <title>Signup page</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script src="valid.js"></script>
    </head>


    <body onload="newCaptcha()">
        <h3 style="text-align: center;">Sign up page</h3>

        <?php 
          echo $error ; 
        ?>

        <table>
        <form method="POST" action="" onsubmit="return validCaptcha()">

            <tr>
                <td><label for="em">E-mail</label></td>
                <td><input type = "email" id="em" name="em" required></td>
            </tr>

            <tr>
                <td><label for="fname">First Name</label></td>
                <td><input type = "text" id="fname" name="fname"></td>
            </tr>

            <tr>
                <td><label for="lname">Last Name</label></td>
                <td><input type = "text" id="lname" name="lname"></td>

            </tr>
            
            <tr>
                <td><label for="col">College</label></td>
                <td><input type = "text" id="col" name="col"></td>
            </tr>

            <tr>
                <td>Choose</td>
                <td>
                    <input type="radio" name="categ" id="student" value="student">
                    <label for='student'>Student</label>
                    <input type="radio" name="categ" id="teacher" value="teacher">
                    <label for='teacher'>Teacher</label>
                </td>
            </tr>

            <tr>
                <td><label for="uid">College ID</label></td>
                <td><input type="number" name="uid" min="1000000000" max="9999999999"></td>

            </tr>

            <tr>
                <td><label for="dept">Department</label></td>
                <td><input type ="text" name="dept" id="dept"></td>
            </tr>

            <tr>
                <td><label for="pwd1">Password</label></td>
                <td><input type="password" id="pwd1" name="pwd1"></td>
            </tr>

            <tr>
                <td><label for="pwd2">Confirm Password</label></td>
                <td><input type="password" id="pwd2" name="pwd2"></td>
            </tr>

            <tr>
                <td>
                    <button type="button" onclick="newCaptcha()">New Captcha</button><br>
                    <input type="text" readonly id="captcha" size="9" style="text-align: center;"> 
                </td>
                <td><input type="text" id="enteredCaptcha"></td>
            </tr>

            <tr>
                <td colspan="2"><input type="submit" value='Create Account' name="submit"></td>
            </tr>

        </form>
        </table>
    </body>
</html>