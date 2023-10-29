<?php


include('../Authentication/connection.php');
include('../Authentication/function.php');

if($_SESSION['type'] == 'user'){
    
    if(isset($_POST['updateProfile'])) {
        $user_id = $_SESSION['user_id'];
        $user_fname = htmlspecialchars($_POST['fname']);
        $user_lname = htmlspecialchars($_POST['lname']);
        $user_email = htmlspecialchars($_POST['email']);
        $user_pwd = htmlspecialchars($_POST['pwd']);
        

        //Calling the validation functions for error handlers from function.php
        if(emptyUserInputUpdate($user_fname, $user_lname, $user_email, $user_pwd) == true){
            echo "<script> 
                    alert('Form cannot be empty!');
                    window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
                exit();
            
        }
        if(validName($user_fname, $user_lname) == false){
            echo "<script> 
                    alert('Only letters allowed for name!');
                    window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
                exit();
            
        }
        if(validEmail($user_email) == false){
            echo "<script> 
                    alert('Email is Invalid!');
                    window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
            
            exit();
        
        }
        if(passwordRule($user_pwd) == false){
            echo "<script> 
                    alert('Password must contain at least one capital letter, one number, and more than 6 in length.');
                    window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
            
            exit();
            
        }
        if(checkEmailTaken($dbConnect, $user_email, $user_id) == true){
           echo "<script> 
                    alert('Email already taken by other user!');
                    window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
           
            exit();
        }

        if(updateProfile($dbConnect, $user_id, $user_fname, $user_lname, $user_email, $user_pwd) == true){
            echo "<script> 
                        alert('User Update Successful!');
                        window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
            
            exit();
        }else{
            echo "<script> 
                        alert('Update User Failure!');
                        window.location.href='/TrainTicketWebApp/User/myUserProfile.php';
                </script>";
            
            exit();
        }
    }
    if(isset($_POST['cancel'])){
        header('Location: /TrainTicketWebApp/User/book.php');
        exit();
    }
}

?>