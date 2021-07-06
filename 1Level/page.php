<?php
include('../config.php') ; 
if(isset($_GET['Vkey'])){
    //Process Verification. 

    $Vkey = $_GET['Vkey'] ; 

    $resultSet = $conn->query("SELECT Verified,Vkey FROM users WHERE Verified = 0 AND Vkey = '$Vkey' LIMIT 1"); 
    

    if( $resultSet->num_rows){ 
        //Validate The email. 
        $update = $conn->query("UPDATE users SET Verified = 1 where Vkey = '$Vkey' LIMIT 1 ") ; 

        if($update){ 
            $resultSet = $conn->query("SELECT * FROM users WHERE Vkey = '$Vkey' LIMIT 1"); 
            $row = mysqli_fetch_assoc($resultSet) ; 
            $tablename = $row["CollegeID"] ; 
            $Category = $row["Category"] ; 

            if( $Category == "Student"){ 
                
                //Creating a dedicated table for the the student only.

                $tablename = "s" . $tablename ; 
                $run1 = mysqli_query($conn,"CREATE TABLE $tablename(TeamName varchar(45) PRIMARY KEY , Keycode varchar(10))");    
                
                if(!$run1){
                    echo mysqli_error($conn);
                } 

            }


             
            $error .=  "Your account has been created successfully, you may now login." ;       

            //$tablename = "P_".$pnum;
            //$sql = "CREATE TABLE $tablename ( sno int(4) NOT NULL,date DATE, filename varchar(100), dname varchar(100), dnum varchar(20), PRIMARY KEY (sno))";
            //$run1 = mysqli_query($conn,$sql);
    
        }
        else{ 
            echo $conn->error ; 
        }
    }else { 
        $error .= "This account invalid or already verified. " ; 
    }

}else{ 
    die("Something went wrong. Invalid access detected.") ; 
}

?>

<!--<!doctype html>
<html>
    <body>
        <button onclick="location.href='login.php'">login</button>
    </body>
</html>-->

<!DOCTYPE html>
<html>
    <head>
        <title>About</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>


    <body>
        <div class="form">
            <h2>Verification Status</h2>
            <p><?php echo $error ?></p>
        
            <button type="button" onclick="location.href='login.php'" id="submit-button">Login</button>
        </div> 
    </body>
</html>
