<?php
include('../config.php') ; 
if(isset($_GET['Vkey'])){
    //Process Verification. 

    $Vkey = $_GET['Vkey'] ; 

    $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


    $resultSet = $conn->query("SELECT Verified,Vkey FROM users WHERE Verified = 0 AND Vkey = '$Vkey' LIMIT 1"); 

    if( $resultSet->num_rows){ 
        //Validate The email. 
        $update = $conn->query("UPDATE users SET Verified = 1 where Vkey = '$Vkey' LIMIT 1 ") ; 

        if($update){ 
            echo "Your account has been created successfully, you may now login." ; 
        }
        else{ 
            echo $conn->error ; 
        }
    }else { 
        echo "This account invalid or already verified. " ; 
    }

}else{ 
    die("Something went wrong. Invalid access detected.") ; 
}

?>

<!doctype html>
<html>
    <body>
        <button onclick="location.href='login.html'">login</button> verified.
    </body>
</html>