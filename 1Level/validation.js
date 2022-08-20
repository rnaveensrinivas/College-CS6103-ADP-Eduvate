function newCaptcha(){ 
    //Here we're manually creating our own 6 letter captcha string using random fucntion. 
    var alphabets = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'.split('');

    var a = alphabets[ Math.floor(Math.random()* 62) ];
    var b = alphabets[ Math.floor(Math.random()* 62) ]; 
    var c = alphabets[ Math.floor(Math.random()* 62) ]; 
    var d = alphabets[ Math.floor(Math.random()* 62) ]; 
    var e = alphabets[ Math.floor(Math.random()* 62) ];
    var f = alphabets[ Math.floor(Math.random()* 62) ];

    var captcha = a + b + c + d + e + f; 

    document.getElementById('captcha').value = captcha ; 
     
}


//Validating captcha checks if user eneterd captcha is correct or not !
function validCaptcha(){ 

    var check = checkPassword() ; // application of stack. 
    if (!check ){ 
        return false ; 
    }

    var captcha = document.getElementById('captcha').value ; 
    var enteredCaptcha = document.getElementById('enteredCaptcha').value ; 

    //User hasn't enetered captcha itself.
    if( enteredCaptcha == '' ){ 
        alert("Enter the captcha.") ; 
        return false ; 
    }//User has enetered wrong captcha. 
    else if( captcha != enteredCaptcha ){ 
        alert("Wrong captcha Try again.") ; 
        return false ; 
    }
}

//below is only for signup page. 
//This is improved in Hyre. 
function checkPassword() {
    
    //We're getting the two passwords an comparing.
    var p1 = document.getElementById("pwd1").value;
    var p2 = document.getElementById("pwd2").value;


    if( p1 && p2 ){ //if both passwords exist. 
        if(p1 != p2) { //if the passwords don't match.
            alert("Passwords don't match");
            return false ; 
        }
        return true ;
    }
    else{ 
        return false ; 
    }
     
}