<?php

include 'config.php' ; 

$conn = NEW mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
    die(" Connection failed: " . $conn->connect_error);
}


$_SESSION['TeamName'] = $_GET['TeamName'] ; 
?>

<button onclick="location.href='3Chat/chat.html'">Chat</button>
<button onclick="location.href='2Video/video.php'">Video</button>
