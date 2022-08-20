<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eduvate";

//establishing a new connection. 
$conn = NEW mysqli($servername, $username, $password, $dbname);
// Checking connection
//The above is oop type of creating an mysqli object. 

if ($conn->connect_error) {
        //If the DB is not present. 
        die("Connection failed: " . $conn->connect_error);
}

//We are declaring a global error string, for displaying the errors.
$error = " " ; 
?>