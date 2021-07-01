<?php

include "../config.php";
// Create connection

$error = NULL ;

if( isset($_POST['submit'])){

  $em=$_POST["em"];
  $fname=$_POST["fname"];
  $lname= $_POST["lname"];
  $col=$_POST["col"];
  $categ=$_POST["categ"];
  $uid=$_POST["uid"];
  $dept=$_POST["dept"];
  $pwd1=$_POST["pwd1"];
  $pwd2=$_POST["pwd2"];

  if( $pwd1 != $pwd2 ){ 
    $error = "<p>Passwords don't match.</p>";
  }
  else{ 
    //else most are valid. 

      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 

      //generate Vkey

      $Vkey = md5(time().$fname) ; // based on time.

      
      $sql = "INSERT INTO Users (Email,FirstName,LastName,College,Role,CollegeID,Department,Password,Vkey) VALUES ('$em','$fname','$lname','$col','$categ','$uid','$dept','$pwd1','$Vkey')";

      if ($conn->query($sql)) {


        $to = $em ; 
        $subject = "Email Verification." ; 
        $message = "<a href='http://localhost/Eduvate-app/1Level/page.php?Vkey=$Vkey'>Verify Account</a>" ; 
        $headers = "From: appeduvate@gmail.com " ; 
        $headers .= "MIME-Version: 1.0" . "\r\n" ; 
        $headers .= "Content-type:text/html;charset=UTF-8". "\r\n" ; 

        mail($to , $subject , $message, $headers ) ; 

        header('location:thankyou.php');


      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      } 

  }


}





 

/*if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}*/


/* displays message in alert box and on clicking ok you can view your appointments*/
$conn->close();
?>

