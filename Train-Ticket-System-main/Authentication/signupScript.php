<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require_once('function.php');

if(isset($_POST['register'])){

    //Grabing the data from users input
    $fname = htmlspecialchars($_POST["first_name"]);
    $lname = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email_address"]);
    $pwd = htmlspecialchars($_POST["password"]);
    $pwdRepeat = htmlspecialchars($_POST["passwordRepeat"]);
  
    //calling the validation functions for error handlers from function.php
    if(emptyUserInput($fname, $lname, $email, $pwd, $pwdRepeat) == true){
        echo "<script> 
                alert('Form cannot be empty!');
                window.location.href='../signup.php';
            </script>";
            exit();
        
    }
    if(validName($fname, $lname) == false){
        echo "<script> 
                alert('Only letters allowed for name!');
                window.location.href='../signup.php';
            </script>";
            exit();
        
    }
    if(validEmail($email) == false){
        echo "<script> 
                alert('Email is Invalid!');
                window.location.href='../signup.php';
            </script>";
            exit();
    
    }
    if(passwordRule($pwd) == false){
        echo "<script> 
                alert('Password must contain at least one capital letter, one number, and more than 6 in length.');
                window.location.href='../signup.php';
            </script>";
        exit();
        
    }

    if(confirmPwd($pwd, $pwdRepeat) == false){
        echo "<script> 
                alert('Password does not match!');
                window.location.href='../signup.php';
            </script>";
        exit();
        
    }
    if(checkEmailExist($dbConnect, $email) == true){
        echo "<script> 
                alert('Email already taken. Please try different email address to register.');
                window.location.href='../signup.php';
            </script>"; 
        exit();
    }
    if(registerUser($dbConnect, $fname, $lname, $email, $pwd) == false){
        echo "<script> 
                alert('User Registration Failed!'); 
                window.location.href='../signup.php';
            </script>";
        exit();
        
    }else{
        echo "<script> 
                alert('User Register Successful!'); 
                window.location.href='../login.php';
            </script>";
        exit();
    }
}else{
        echo "<script> 
                alert('Registration button is not working!'); 
                window.location.href='../index.php';
            </script>";
        exit();
    }

?>