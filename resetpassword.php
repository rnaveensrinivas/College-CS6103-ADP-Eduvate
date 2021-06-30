<!DOCTYPE html>
<html>
    <body>
        Please check your mail to proceed with password reset. 
    </body>
</html>

<?php
    $em = $_POST['em'] ; 
    mail($em, 'subject : Hello' , 'message : Hello there.' ,'From: appeduvate@gmail.com');

?>