<?php
include "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$mail=$_POST["em"];
$fname=$_POST["fname"];
$lname= $_POST["lname"];
$col=$_POST["col"];
$categ=$_POST["categ"];
$uid=$_POST["uid"];
$dept=$_POST["dept"];
$pw=$_POST["pwd1"];





$sql = "INSERT INTO Users (Email,FirstName,LastName,College,Role,CollegeID,Department,Password)
VALUES ('$mail','$fname','$lname','$col','$categ','$uid','$dept','$pw')";

/*if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}*/

if ($conn->query($sql) === TRUE) {
  echo '<script type = "text/javascript">
            alert("Your entry has been saved");
            </script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
/* displays message in alert box and on clicking ok you can view your appointments*/
$conn->close();
?>

